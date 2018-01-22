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
use app\modules\content\models\ContentExtend;
use app\modules\content\models\ContentTag;
use yii;
use app\libs\AppControl;
use app\modules\content\models\CategoryTag;
use app\modules\content\models\ExtendInvoke;


class TagController extends AppControl {
    public $enableCsrfValidation = false;

    /**
     * 标签组
     * @return string
     * @Obelisk
     */
    public function actionIndex()
    {
        $catId = Yii::$app->request->get('catId');
        $data = CategoryTag::getCatTag($catId);
        return $this->render('index',['data' => $data]);
    }

    /**
     * 添加标签
     * @return string
     * @Obelisk
     */
    public function actionAdd(){
        if($_POST){
            $catId = Yii::$app->request->post('catId');
            $type = Yii::$app->request->post('type');
            $tag = Yii::$app->request->post('tag');
            $sign = CategoryTag::find()->where("catId=$catId AND tagCatId=$tag")->one();
            if($sign){
                echo '<script>alert("标签类已经存在");history.go(-1);</script>';
                die;
            }
            $model = new CategoryTag();
            $model->catId = $catId;
            $model->tagCatId = $tag;
            $model->userId = Yii::$app->session->get('adminId');
            $model->createTime = time();
            $model->save();
            $sql = "select ct.contentId from {{%content_tag}} ct LEFT JOIN {{%content}} c ON ct.contentId=c.id WHERE c.catId=$catId GROUP BY ct.contentId";
            $data = Yii::$app->db->createCommand($sql)->queryAll();
            foreach($data as $v){
                $model = new ContentTag();
                $model->contentId = $v['contentId'];
                $model->tagCatId = $tag;
                $model->showd = 0;
                $model->createTime = time();
                $model->save();
            }
            $this->redirect('/content/category/tag?id='.$catId);
        }else{
            $catId = Yii::$app->request->get('catId');
            $type = Yii::$app->request->get('type');
            return $this->render('add',['type' => $type,'catId' => $catId,'block' => $this->block]);
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
            $pName = $model->find()->where("id=$data->pid")->one();
            if(!$data['inheritId']){
                $inherit = 1;
            }else{
                $inherit = 0;
            }
            return $this->render('add',['extendInvoke' => $extendInvoke,'data' => $data,'pName' => $pName->name,'belong' => $data->belong,'catName' => $catId->name,'inheritId' => $inherit,'catId' => $data->catId,'id' => $id]);
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
            $data['inheritId'] = $inheritId;
            $data['canDelete'] = $catDelete;
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

}