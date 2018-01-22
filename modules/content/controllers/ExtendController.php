<?php
/**
 * 属性管理
 * Created by PhpStorm.
 * User: Administrator
 * Date: 15-6-17
 * Time: 下午2:37
 */
namespace app\modules\content\controllers;

use app\modules\content\models\Category;
use app\modules\content\models\CategoryContent;
use app\modules\content\models\Content;
use app\modules\content\models\ContentExtend;
use yii;
use app\libs\AppControl;
use app\modules\content\models\CategoryExtend;
use app\modules\content\models\ExtendInvoke;


class ExtendController extends AppControl {
    public $enableCsrfValidation = false;

    /**
     * 属性列表
     * @return string
     * @Obelisk
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    /**
     * 添加属性
     * @return string
     * @Obelisk
     */
    public function actionAdd(){
        if($_POST){
            $model = new CategoryExtend();
            $data = Yii::$app->request->post('extend');
            $type = Yii::$app->request->post('type','');
            $id = Yii::$app->request->post('id','');
            $back = Yii::$app->request->post('back');
            $canDelete = Yii::$app->request->post('canDelete',0);
            //判断是修改
            if($id){
                if($type){
                    $sign = ContentExtend::find()->where("id != $id AND contentId = {$data['contentId']} AND code='{$data['code']}'")->one();
                    if($sign){
                        die('<script>alert("调用码，重复");history.go(-1);</script>');
                    }
                }else{
                    $sign = CategoryExtend::find()->where("id != $id AND catId = {$data['catId']} AND code='{$data['code']}' AND belong='{$data['belong']}'")->one();
                    if($sign){
                        die('<script>alert("调用码，重复");history.go(-1);</script>');
                    }
                }
                $sign = $this->extendUpdate($id,$data,$type,$canDelete);//使用另外方法进行属性的修改，避免方法过长
                if($sign){
                    if($type){
                        $this->redirect('/content/content/extend?id='.$data['contentId']);
                    }else{
                        $this->redirect('/content/category/'.$data["belong"].'?id='.$data['catId']);
                    }
                }else{
                    echo '<script>alert("失败，请重试");history.go(-1);</script>';
                    die;
                }
            }
            //判断是添加
            else{
                if($type){
                    $sign = ContentExtend::find()->where("contentId = {$data['contentId']} AND code='{$data['code']}'")->one();
                    if($sign){
                        die('<script>alert("调用码，重复");history.go(-1);</script>');
                    }
                }else{
                    $sign = CategoryExtend::find()->where("catId = {$data['catId']} AND code='{$data['code']}' AND belong='{$data['belong']}'")->one();
                    if($sign){
                        die('<script>alert("调用码，重复");history.go(-1);</script>');
                    }
                }
                $data['createTime'] = date("Y-m-d H:i:s");
                $data['userId'] = Yii::$app->session->get('adminId');
                $url = Yii::$app->request->post('url','');
                if($type){ //添加内容属性
                    $data['value'] = "";
                    $data['catExtendId'] = "";
                    $re = Yii::$app->db->createCommand()->insert('{{%content_extend}}',$data)->execute();
                    if($re){
                        if($back == 1){
                            $this->redirect('/content/content/update?id='.$data['contentId']."&url=".$url);
                        }else{
                            $this->redirect('/content/content/extend?id='.$data['contentId']);
                        }
                    }else{
                        echo '<script>alert("失败，请重试");history.go(-1);</script>';
                        die;
                    }
                }else{
                    //添加分类属性
                    $status = Yii::$app->request->post('status','');
                    if(!empty($status) && $canDelete == 1){
                        $deleteType = 1;
                    }else{
                        $deleteType = 0;
                    }
                    $model->pid = 1;
                    $model->catId = $data['catId'];
                    $model->name = $data['name'];
                    $model->title = $data['title'];
                    $model->image = $data['image'];
                    $model->description = $data['description'];
                    $model->type = $data['type'];
                    $model->userId = $data['userId'];
                    $model->createTime = $data['createTime'];
                    $model->belong = $data['belong'];
                    $model->code = $data['code'];
                    $model->deleteType = $deleteType;
                    $model->typeValue = $data['typeValue'];
                    $model->required = isset($data['required'])?$data['required']:2;
                    $model->requiredValue = $data['requiredValue'];
                    $model->used = isset($data['used'])?$data['used']:1;
                    $re = $model->save();
                    if($status == '1'){
                        $this->addChildExtend($data,$canDelete,$model->primaryKey);//子类添加属性
                    }elseif($status == '2'){
                        $this->addRecursionExtend($data,$canDelete,$model->primaryKey);//递归添加属性
                    }
                    if($data['belong'] = 'content'){
                        $this->shiftExtend($data['catId'],$model->primaryKey);//为其中内容添加属性
                    }
                    if($re){
                        if($back == 1){
                            $this->redirect('/content/category/update?id='.$data['catId']);
                        }else{
                            $this->redirect('/content/category/'.$data["belong"].'?id='.$data['catId']);
                        }

                    }else{
                        echo '<script>alert("失败，请重试");history.go(-1);</script>';
                        die;
                    }
                }
            }
        }
        //初次添加加载数据
        $id = Yii::$app->request->get('id');
        $type = Yii::$app->request->get('type','');
        $back = Yii::$app->request->get('back');
        $url = Yii::$app->request->get('url','');
        $extendInvoke = ExtendInvoke::find()->all();
        if($type){
            return $this->render('add',['url'=>$url,'extendInvoke' => $extendInvoke,'back' => $back,'type' => $type,'catId' => $id]);
        }else{
            $belong = Yii::$app->request->get('belong','');
            $cateArr = Category::findOne($id);
            return $this->render('add',array('url'=>$url,'extendInvoke' => $extendInvoke,'back'=> $back,'catId' => $id,'belong' => $belong,'catName' => $cateArr->name));
        }
    }

    /**
     * 删除属性
     * @return string
     * @Obelisk
     */

    public function actionDelete(){
        $id = Yii::$app->request->get('id');
        $type = Yii::$app->request->get('type','');
        if($type){
            $data = ContentExtend::findOne($id);
            $re = ContentExtend::deleteAll("id=$id");
            if($re){
                $this->redirect('/content/content/extend?id='.$data['contentId']);
            }else{
                echo '<script>alert("失败，请重试");history.go(-1);</script>';
                die;
            }
        }else{
            $status = $type = Yii::$app->request->get('status',1);
            $data = CategoryExtend::findOne($id);
            if($data['inheritId']){
                $this->deleteExtend($data['inheritId'],$status,$data['catId']);
            }else{
                $this->deleteExtend($id,$status,$data['catId']);
            }
            ContentExtend::updateAll(['canDelete' => 0],"canDelete=1 AND catExtendId = $id");
            $re = CategoryExtend::deleteAll("id=$id");
            if($re){
                $this->redirect('/content/category/'.$data["belong"].'?id='.$data['catId']);
            }else{
                echo '<script>alert("失败，请重试");history.go(-1);</script>';
                die;
            }
        }
    }

    /**
     * 修改属性
     * @return string
     * @Obelisk
     */

    public function actionUpdate(){
        $id = Yii::$app->request->get('id');
        $type = Yii::$app->request->get('type','');
        $extendInvoke = ExtendInvoke::find()->all();
        if($type){
            $model = new ContentExtend();
        }else{
            $model = new CategoryExtend();
        }
        $data = $model->findOne($id);
        if($type){
            return $this->render('add',['extendInvoke' => $extendInvoke,'data' => $data,'id' => $id,'catId' => $data->contentId,'type' => $type]);
        }else{
            $catId = Category::findOne($data->catId);
//            $pName = $model->find()->where("id=$data->pid")->one();
            if(!$data['inheritId']){
                $inherit = 1;
            }else{
                $inherit = 0;
            }
            return $this->render('add',['extendInvoke' => $extendInvoke,'data' => $data,'belong' => $data->belong,'catName' => $catId->name,'inheritId' => $inherit,'catId' => $data->catId,'id' => $id]);
        }

    }

    /**
     * 修改属性
     * @param $id 属性ID
     * @param $data 属性数据
     * @param $type 属性来源
     * @Obelisk
     */
    public function extendUpdate($id,$data,$type,$canDelete){
        if($type){
            $model = new ContentExtend();
            $re = $model->updateAll($data,"id=$id");
        }else{
            $status = Yii::$app->request->post('status','');
            $model = new CategoryExtend();
            $inheritId = CategoryExtend::findOne($id);
            if(!$inheritId['inheritId'] && $canDelete==1 && $status == 2){
                $data['deleteType'] = 1;
            }
            if(!$inheritId['inheritId'] && $canDelete==0 && $status == 2){
                $data['deleteType'] = 0;
            }
            $model->updateAll($data,"id=$id");
            $re = 1;
            unset($data['deleteType']);
            if(!empty($status)) {
                if ($status == 1) {
                    $child = Category::find()->where('pid = ' . $data['catId'])->all();
                } elseif ($status == 2) {
                    $categoryModel = new Category();
                    $child = $categoryModel->getChildAll($data['catId']);
                }
                if ($inheritId['inheritId']) {
                    $inheritId = $inheritId['inheritId'];
                } else {
                    $inheritId = $inheritId['id'];
                }
                foreach ($child as $v) {
                    unset($data['catId']);
                    $data['canDelete'] = $canDelete;
                    $model->updateAll($data, 'catId=' . $v['id'] . ' AND inheritId=' . $inheritId);
                }
            }
        }
        return $re;
    }

    /**
     * 子类添加属性
     * @param $data 属性信息
     * @param $catDelete 是否能删除
     * @param $inheritId 继承Id
     * @throws yii\db\Exception
     * @Obelisk
     */
    public function addChildExtend($data,$catDelete,$inheritId){
        $child = Category::find()->where('pid = '.$data['catId'])->all();
        foreach($child as $v){
            $data['catId'] = $v['id'];
            $data['pid'] = 1;
            $data['inheritId'] = $inheritId;
            $data['canDelete'] = $catDelete;
            if($data['belong'] == 'content'){
                $content = Content::find()->asArray()->where("catId = {$v['id']}")->all();
                $cateExtend = Yii::$app->db->createCommand("select * from {{%category_extend}} WHERE id=$inheritId")->queryOne();
                foreach($content as $val){
                    $sign = ContentExtend::find()->where("code='{$cateExtend['code']}' AND contentId={$val['id']}")->one();
                    if(!$sign){
                        $contExtendModel = new ContentExtend();
                        $contExtendModel->catExtendId = $cateExtend['id'];
                        $contExtendModel->contentId = $val['id'];
                        $contExtendModel->name = $cateExtend['name'];
                        $contExtendModel->title = $cateExtend['title'];
                        $contExtendModel->image = $cateExtend['image'];
                        $contExtendModel->description = $cateExtend['description'];
                        $contExtendModel->type = $cateExtend['type'];
                        $contExtendModel->userId = $cateExtend['userId'];
                        $contExtendModel->createTime = $cateExtend['createTime'];
                        $contExtendModel->inheritId = $cateExtend['inheritId'];
                        $contExtendModel->canDelete = $cateExtend['canDelete'];
                        $contExtendModel->code = $cateExtend['code'];
                        $contExtendModel->typeValue = $cateExtend['typeValue'];
                        $contExtendModel->required = $cateExtend['required'];
                        $contExtendModel->requiredValue = $cateExtend['requiredValue'];
                        $contExtendModel->value = '';
                        $contExtendModel->save();
                    }
                }
            }
            Yii::$app->db->createCommand()->insert('{{%category_extend}}',$data)->execute();
        }
    }

    /**
     * 递归添加属性
     * @param $data 属性信息
     * @param $catDelete 是否能删除
     * @param $inheritId 继承Id
     * @throws yii\db\Exception
     * @Obelisk
     */
    public function addRecursionExtend($data,$catDelete,$inheritId){
        $model = new Category();
        $recursion = $model->getChildAll($data['catId']);
        foreach($recursion as $v){
            $data['catId'] = $v['id'];
            $data['pid'] = 1;
            $data['inheritId'] = $inheritId;
            $data['canDelete'] = $catDelete;
            Yii::$app->db->createCommand()->insert('{{%category_extend}}',$data)->execute();
        }
    }

    /**根据$status 进行子类删除与递归删除
     * @param $id
     * @param $status
     * @Obelisk
     */
    public function deleteExtend($id,$status,$catId){
        $model = new Category();
        if($status == 1){
            return true;
        }elseif($status == 2){
            $child = Category::find()->where('pid = '.$catId)->all();
        }else{
            $child = $model->getChildAll($catId);
        }
        foreach($child as $v){
            $extendId = CategoryExtend::find()->where('catId='.$v['id'].' AND inheritId='.$id)->one();
            if($extendId){
                ContentExtend::updateAll(['canDelete' => 0],"canDelete=1 AND catExtendId = $extendId->id");
            }
            CategoryExtend::deleteAll('catId='.$v['id'].' AND inheritId='.$id);
        }
    }

    /**
     * 内容添加属性
     * @param $extendId 内容ID
     * @param $catId 分类ID
     * @Obelisk
     */
    public function shiftExtend($catId,$extendId){
        $cateExtend = Yii::$app->db->createCommand("select * from {{%category_extend}} WHERE id=$extendId")->queryOne();
        if($cateExtend['used'] == 1){
            $content = Content::find()->asArray()->where("catId = $catId")->all();
        }else{
            $content = Content::find()->asArray()->where("catId = $catId AND pid = 0")->all();
        }
        foreach($content as $v){
            $sign = ContentExtend::find()->where("code='{$cateExtend['code']}' AND contentId={$v['id']}")->one();
            if(!$sign){
                $contExtendModel = new ContentExtend();
                $contExtendModel->catExtendId = $cateExtend['id'];
                $contExtendModel->contentId = $v['id'];
                $contExtendModel->name = $cateExtend['name'];
                $contExtendModel->title = $cateExtend['title'];
                $contExtendModel->image = $cateExtend['image'];
                $contExtendModel->description = $cateExtend['description'];
                $contExtendModel->type = $cateExtend['type'];
                $contExtendModel->userId = $cateExtend['userId'];
                $contExtendModel->createTime = $cateExtend['createTime'];
                $contExtendModel->inheritId = $cateExtend['inheritId'];
                $contExtendModel->canDelete = $cateExtend['canDelete'];
                $contExtendModel->code = $cateExtend['code'];
                $contExtendModel->typeValue = $cateExtend['typeValue'];
                $contExtendModel->required = $cateExtend['required'];
                $contExtendModel->requiredValue = $cateExtend['requiredValue'];
                $contExtendModel->value = '';
                $contExtendModel->save();
            }
        }
    }

}