<?php
/**
 * 内容管理控制器
 * @return string
 * @Obelisk
 */

namespace app\modules\content\controllers;

use app\modules\content\models\Category;
use app\modules\content\models\Content;
use app\modules\content\models\CategoryExtend;
use app\modules\content\models\ContentExtend;
use app\modules\content\models\ExtendData;
use app\modules\content\models\CategoryContent;
use app\modules\content\models\RelatedContent;
use yii;
use app\libs\Method;
use app\libs\AppControl;
use app\libs\PHPExcelclass;

class ContentController extends AppControl
{
    public $layout = 'content';
    public $enableCsrfValidation = false;

    /**
     * 内容列表
     * @return string
     * @Obelisk
     */
    public function actionIndex()
    {
        $catId = Yii::$app->request->get('catId', '');
        $beginTime = Yii::$app->request->get('beginTime', '');
        $endTime = Yii::$app->request->get('endTime', '');
        $id = Yii::$app->request->get('id', '');
        $userId = Yii::$app->request->get('userId', '');
        $showId = Yii::$app->request->get('showId', '');
        $questionType = Yii::$app->request->get('questionType', '');
        $pid = Yii::$app->request->get('pid', 0);
        $show = Yii::$app->request->get('show', '');  //内容隐藏显示标记
        if ($show) {
            if ($show == 1) {
                $show = 2;
            } else {
                $show = 1;
            }
            $model = new Content();
            $model->updateAll(array('show' => $show), 'id=' . $pid);
            exit ("<script>history.go(-1);</script>");
        }
        if ($id || $questionType) {
            $where = "1=1";
        } else {
            $where = "a.pid=$pid";
        }
        $extendData = [];
        if ($showId) {
            $where .= " AND a.id in (select contentId from {{%category_content}} WHERE catId=$showId)";
            $extendData = CategoryExtend::find()->where("catId = $showId AND belong='content'")->orderBy('id ASC')->all();
        } elseif ($catId) {
            $where .= " AND a.id in (select contentId from {{%category_content}} WHERE catId=$catId)";
            $extendData = CategoryExtend::find()->where("catId = $catId AND belong='content'")->orderBy('id ASC')->all();
        }
        if ($beginTime) {
            $where .= " AND DATEDIFF(a.createTime,'$beginTime')>0";
        }
        if ($endTime) {
            $where .= " AND DATEDIFF(a.createTime,'$endTime')<0";
        }
        if ($id) {
            $where .= " AND a.id = $id";
        }

        if ($userId) {
            $where .= " AND a.userId = $userId";
        }
        if ($questionType) {
            $where .= " AND a.id in (select contentId from {{%content_extend}} ces where ces.value=$questionType AND ces.code='1837da083c9ba84649782cda5d7b2cd9')";
        }
        $fields = "";
        foreach ($extendData as $k => $v) {
            $name = chr(ord('A') + intval($k));
            $fields .= ",(SELECT  CONCAT_WS(' ',ce.value,ed.value) From {{%content_extend}} ce left JOIN {{%extend_data}} ed ON ed.extendId=ce.id WHERE ce.contentId=a.id AND ce.code='$v->code') as $name";
        }
        $page = Yii::$app->request->get('page', 1);
        $pageSize = 10;
        $limit = " limit " . ($page - 1) * $pageSize . "," . $pageSize;
        $order = " order by a.createTime DESC";
        $data = Yii::$app->db->createCommand("select a.*,n.caName$fields from {{%content}} a LEFT JOIN (SELECT cc.contentId,GROUP_CONCAT(ca.`name`) caName  FROM {{%category_content}} cc LEFT JOIN {{%category}} ca on ca.id=cc.catId GROUP BY cc.contentId ) n ON n.contentId = a.id WHERE " . $where . $order . $limit)->queryAll();
        $count = count(Yii::$app->db->createCommand("select a.*,n.caName from {{%content}} a LEFT JOIN (SELECT cc.contentId,GROUP_CONCAT(ca.`name`) caName  FROM {{%category_content}} cc LEFT JOIN {{%category}} ca on ca.id=cc.catId GROUP BY cc.contentId ) n ON n.contentId = a.id WHERE " . $where)->queryAll());
        $page = Method::getPagedRows(['count' => $count, 'pageSize' => $pageSize, 'rows' => 'models']);
        return $this->render('index', ['extendData' => $extendData, 'content' => $data, 'page' => $page, 'block' => $this->block]);
    }

//    /**
//     * 批量添加
//     * @return string
//     * @Obelisk
//     */
//    public function actionBatch()
//    {
//        $schools = file_get_contents("http://schools.smartapply.cn/cn/api/select-schools");
//        $schools = json_decode($schools,true);
//        $filePath = (__DIR__."/daxuep.xlsx"); // 要读取的文件的路径
//        $PHPExcel = new \PHPExcel();
//        $PHPReader = new \PHPExcel_Reader_Excel2007(); // Reader很关键，用来读excel文件
//        if (!$PHPReader->canRead($filePath)) { // 这里是用Reader尝试去读文件，07不行用05，05不行就报错。注意，这里的return是Yii框架的方式。
//            $PHPReader = new \PHPExcel_Reader_Excel5();
//            if (!$PHPReader->canRead($filePath)) {
//                $errorMessage = "Can not read file.";
//                return $this->render('error', ['errorMessage' => $errorMessage]);
//            }
//        }
//        $PHPExcel = $PHPReader->load($filePath); // Reader读出来后，加载给Excel实例
//        $allSheet = $PHPExcel->getSheetCount(); // sheet数
//        $currentSheet = $PHPExcel->getSheet(4); // 拿到第一个sheet（工作簿？）
//        $allColumn = $currentSheet->getHighestColumn(); // 最高的列，比如AU. 列从A开始
//        $allRow = $currentSheet->getHighestRow(); // 最大的行，比如12980. 行从0开始
////        $result = new ReadFileResult(); // result是我自己写的一个存放结果的实体类
//        $arrVal=[];
//        for ($currentRow = 1; $currentRow <= $allRow; $currentRow++) {
//            echo $currentRow;
//            $lineVal = [];
//            for ($currentColumn="A"; $currentColumn <= $allColumn; $currentColumn++) {
//                $val = $currentSheet->getCellByColumnAndRow(ord($currentColumn) - 65, $currentRow)->getValue(); // ord把字母转为ascii码，A->65, B->66....这儿的坑在于AU->65, 后面的U没有计算进去，所以用索引方式遍历是有缺陷的。
//                array_push($lineVal, $val);
//            }
//            $data = $this->clBlork($lineVal);
//            $this->insertAll($data,$schools);
////            $res = $this->insertAll($data);
//        }
//        die;
//    }
//
//    public function clBlork($arr)
//    {
//        $data = array_filter($arr);
//        return $data;
//    }
//    public function insertAll($data,$schools){
//        $school_id ='';
//        foreach($schools as $v){
//            if($v['title']==$data[2]){
//                $school_id =$v['id'];
//            }
//        }
//        $category = [292,293,308];  //分类
//        $extendValue =['',$school_id,$data[0]];  //属性值
//        $addtime = date("Y-m-d H:i:s");
//        $model = new content();
//        $model->createTime = $addtime;
//        $model->userId = Yii::$app->session->get('adminId');
//        $model->name = $data[1];           //名字
//        $model->title = $data[2];         //标题
//        $model->pid = 0;
//        $model->catId = 292;         //分类ID
//        $model->viewCount = 0;      //浏览量
//        $re = $model->save();
//        //将分类的内容属性，转移到内容本身的扩展属性中
//        $this->shiftExtend($model->primaryKey,292,$extendValue,0);
//        //将分类的内容的副分类存储
//        $this->secondClass($model->primaryKey,$category);
//    }
    /**
     * 添加内容与其基本信息
     * @return string
     * @Obelisk
     */
    public function actionAdd()
    {
        if ($_POST) {
            $model = new content();
            $contentData = Yii::$app->request->post('content');
            $id = Yii::$app->request->post('id');
            $url = Yii::$app->request->post('url');
            $extendId = Yii::$app->request->post('key', []);
            $extendValue = Yii::$app->request->post('value');
            $tagValue = Yii::$app->request->post('tagValue');
            $tagKey = Yii::$app->request->post('tagKey', []);
            $category = explode(",", Yii::$app->request->post('category'));
            $content = explode(",", Yii::$app->request->post('con'));
            if (empty($contentData['name'])) {
                die('<script>alert("请输入内容名称");history.go(-1);</script>');
            }
            if (!in_array($contentData['catId'], $category)) {
                die('<script>alert("主分类必须在副分类中");history.go(-1);</script>');
            }
            if ($id) {
                $this->verifyTag($contentData['pid'], $tagValue, $id);
                $re = $model->updateAll($contentData, 'id = :id', [':id' => $id]);
                if (implode(',', $content)) {
                    foreach ($content as $v) {
                        $relModel = new RelatedContent;
                        $relModel->contentId = $id;
                        $relModel->relatedContentId = $v;
                        $relModel->save();
                    }
                }
                foreach ($extendId as $k => $v) {
                    $required = ContentExtend::findOne($v);
                    if ($required->required == 1) {
                        if (empty($extendValue[$k])) {
                            die('<script>alert("属性值必填");history.go(-1);</script>');
                        }
                        if (!empty($required->requiredValue)) {
                            if (!preg_match("$required->requiredValue", $extendValue[$k])) {
                                die('<script>alert("请输入合法值");history.go(-1);</script>');
                            }
                        }
                    }
                    if (!isset($extendValue[$k]{255})) {
                        ContentExtend::updateAll(['value' => $extendValue[$k]], 'id = :id', [':id' => $v]);
                        ExtendData::updateAll(['value' => ""], "extendId = $v");
                    } else {
                        ContentExtend::updateAll(['value' => ""], 'id = :id', [':id' => $v]);
                        $sign = ExtendData::find()->where("extendId = $v")->one();
                        if ($sign) {
                            ExtendData::updateAll(['value' => $extendValue[$k]], "extendId = $v");
                        } else {
                            $dataModel = new ExtendData();
                            $dataModel->extendId = $v;
                            $dataModel->value = $extendValue[$k];
                            $dataModel->save();
                        }
                    }
                }
                foreach ($tagKey as $k => $v) {
                    ContentTag::updateAll(['tagContentId' => $tagValue[$k]], 'id = :id', [':id' => $v]);
                }
                CategoryContent::deleteAll('contentId = :contentId', array(':contentId' => $id));
                $this->secondClass($id, $category);
            } else {
                $addtime = date("Y-m-d H:i:s");
                $this->verifyTag($contentData['pid'], $tagValue);
                $model->createTime = $addtime;
                $model->userId = Yii::$app->session->get('adminId');
                $model->name = $contentData['name'];
                $model->title = $contentData['title'];
                $model->pid = $contentData['pid'];
                $model->image = $contentData['image'];
                $model->catId = $contentData['catId'];
                $model->viewCount = $contentData['viewCount'];
                $re = $model->save();
                Content::updateAll(['sort' => $model->primaryKey], "id=$model->primaryKey");
                if (implode(',', $content)) {
                    foreach ($content as $v) {
                        $relModel = new RelatedContent;
                        $relModel->contentId = $model->primaryKey;
                        $relModel->relatedContentId = $v;
                        $relModel->save();
                    }
                }
                //将分类的内容属性，转移到内容本身的扩展属性中
                $this->shiftExtend($model->primaryKey, $contentData['catId'], $extendValue, $contentData['pid']);
                //将分类的内容的副分类存储
                $this->secondClass($model->primaryKey, $category);

                if ($contentData['pid'] != 0) {
                    $this->addTag($model->primaryKey, $contentData['catId'], $tagValue);
                }
            }
            if ($re = 1) {
                $key = $model->primaryKey;
                echo '<script>alert("成功")</script>';
                $this->redirect($url);
            } else {
                echo '<script>alert("失败，请重试");history.go(-1);</script>';
                die;
            }
        } else {
            $catId = Yii::$app->request->get('id', '');//判断是否选择了主分类
            $pid = Yii::$app->request->get('pid', 0);
            $url = Yii::$app->request->get('url', '');
            $showId = Yii::$app->request->get('showId', '');
            if (!empty($url) && !empty($showId)) {
                $url .= "&showId=$showId";
            }
            if ($pid != 0) {
                $p = Content::findOne($pid);
                $can = Category::findOne($p->catId);
                if ($can->can == 2) {
                    $catId = $p->catId;
                }
            }
            if ($catId) {
                $model = new CategoryExtend();
//                $tagModel = new CategoryTag();
                $cateModel = new Category();
                $cateName = $cateModel->findOne($catId);
                if ($pid != 0) {
                    $where = "AND used = 1";
                } else {
                    $where = "";
                }
                $catContent = $model->find()->where("catId=$catId AND belong='content' $where")->orderBy('id ASC')->all();
                $relatedCentent = $cateModel->find()->where(['id' => $cateName['Relatedcatid']])->all();
//                $catTag =$tagModel->getAllTag($catId);
//                return $this->render('add',['relCentent' =>$relatedCentent,'tag' => $catTag,'url' => $url,'pid' => $pid,'catId' => $catId,'catContent' => $catContent,'catName' => $cateName->name]);
                return $this->render('add', ['relCentent' => $relatedCentent, 'url' => $url, 'pid' => $pid, 'catId' => $catId, 'catContent' => $catContent, 'catName' => $cateName->name]);
            } else {
                return $this->render('add', ['url' => $url]);
            }
        }
    }

    /**
     * 修改内容
     * @return string
     * @Obelisk
     */
    public function actionUpdate()
    {
//        var_dump(1);die;
        $id = Yii::$app->request->get('id');
        $url = Yii::$app->request->get('url');
        $showId = Yii::$app->request->get('showId', '');
        if (!empty($url) && !empty($showId)) {
            $url .= "&showId=$showId";
        }
        $model = new Content();
        $contentData = $model->findOne($id);
        $catName = Category::findOne($contentData->catId);
        $relatedCentent = Category::find()->where(['id' => $catName->Relatedcatid])->all();
        $extendData = Yii::$app->db->createCommand("select ce.name,ce.type,ce.id,ce.value,ed.value as dataValue,ce.typeValue from {{%content_extend}} ce LEFT JOIN {{%extend_data}} ed ON ce.id=ed.extendId WHERE contentId = $id")->queryAll();
        $category = Yii::$app->db->createCommand("select catId from {{%category_content}} WHERE contentId = $id")->queryAll();
        foreach ($category as $v) {
            $catId[] = $v['catId'];
        }
        $catId = implode(",", $catId);
        return $this->render('add', ['relCentent' => $relatedCentent, 'pid' => $contentData->pid, 'url' => $url, 'data' => $contentData, 'catContent' => $extendData, 'catId' => $catId, 'id' => $id, 'catName' => $catName->name]);
    }

    /**
     * 删除内容，关联删除内容属性，内容副分类
     * @Obelisk
     */

    public function actionDelete()
    {
        $id = Yii::$app->request->get('id');
        $url = Yii::$app->request->get('url');
        $showId = Yii::$app->request->get('showId', '');
        if (!empty($url) && !empty($showId)) {
            $url .= "&showId=$showId";
        }
        $arr = Content::find()->asArray()->where("pid = $id")->all();
        foreach ($arr as $v) {
            CategoryContent::deleteAll('contentId = :contentId', array(':contentId' => $v['id']));
            Content::deleteAll('id = :id', array(':id' => $v['id']));
            ContentExtend::deleteAll('contentId = :contentId', array(':contentId' => $v['id']));
        }
        CategoryContent::deleteAll('contentId = :contentId', array(':contentId' => $id));
        Content::deleteAll('id = :id', array(':id' => $id));
        ContentExtend::deleteAll('contentId = :contentId', array(':contentId' => $id));
        $this->redirect($url);
    }


    /**
     * 展示内容的属性
     * @Obelisk
     */

    public function actionExtend()
    {
        $id = Yii::$app->request->get('id');
        $catId = Yii::$app->request->get('catId');
        $data = Yii::$app->db->createCommand("select a.*,b.name as contName from x2_content_extend a LEFT JOIN x2_content b ON a.contentId=b.id WHERE a.contentId=" . $id)->queryAll();
        return $this->render('extend', ['id' => $id, 'data' => $data, 'catId' => $catId]);
    }


    /**
     * 标签管理
     * @return string
     * @Obelisk
     */

    public function actionTag()
    {
        $id = Yii::$app->request->get('id');
        $sql = "select ct.id,ct.showd,ca.name from {{%content_tag}} ct LEFT JOIN {{%category}} ca ON ct.tagCatId=ca.id WHERE ct.contentId=$id";
        $data = \Yii::$app->db->createCommand($sql)->queryAll();
        return $this->render('tag', ['data' => $data, 'contentId' => $id]);
    }

    /**
     * 标签展示
     * @return string
     * @Obelisk
     */

    public function actionTagShow()
    {
        $id = Yii::$app->request->get('id');
        $contentId = Yii::$app->request->get('contentId');
        $sign = ContentTag::findOne($id);
        if ($sign->showd) {
            $showd = 0;
        } else {
            $showd = 1;
        }
        ContentTag::updateAll(['showd' => $showd], "id=$id");
        $this->redirect('/content/content/tag?id=' . $contentId);
    }

    /**
     * 内容排序
     * @Obelisk
     */

    public function actionSort()
    {
        $id = Yii::$app->request->post('id');
        $sort = Yii::$app->request->post('sort');
        $url = Yii::$app->request->post('url');
        foreach ($id as $k => $v) {
            Content::updateAll(['sort' => $sort[$k]], "id=$v");
        }
        $this->redirect($url);
    }

    /**
     * 修改主分类
     * @Obelisk
     */

    public function actionChangeCategory()
    {
        if ($_POST) {
            $catId = Yii::$app->request->post('catId');
            $url = Yii::$app->request->post('url');
            $contentId = Yii::$app->request->post('id');
            Content::updateAll(['catId' => $catId], "id=$contentId");
            $this->redirect($url);
        } else {
            $id = Yii::$app->request->get('id');
            $url = Yii::$app->request->get('url');
            return $this->render('changeCategory', ['contentId' => $id, 'url' => $url]);
        }
    }

    /**
     * 分类内容模板copy
     * @param $contentId 内容ID
     * @param $catId 分类ID
     * @param $extendValue 属性的值
     * @Obelisk
     */
    public function shiftExtend($contentId, $catId, $extendValue, $pid)
    {
        $where = '';
        if ($pid != 0) {
            $where = "AND used = 1";
        }
        $cateExtend = Yii::$app->db->createCommand("select * from {{%category_extend}} WHERE catId=$catId AND belong='content' $where ORDER by id ASC")->queryAll();
        foreach ($cateExtend as $k => $v) {
            $contExtendModel = new ContentExtend();
            $contExtendModel->catExtendId = $v['id'];
            $contExtendModel->contentId = $contentId;
            $contExtendModel->name = $v['name'];
            $contExtendModel->title = $v['title'];
            $contExtendModel->image = $v['image'];
            $contExtendModel->description = $v['description'];
            $contExtendModel->type = $v['type'];
            $contExtendModel->userId = $v['userId'];
            $contExtendModel->createTime = $v['createTime'];
            $contExtendModel->inheritId = $v['inheritId'];
            $contExtendModel->canDelete = $v['canDelete'];
            $contExtendModel->code = $v['code'];
            $contExtendModel->typeValue = $v['typeValue'];
            $contExtendModel->required = $v['required'];
            $contExtendModel->requiredValue = $v['requiredValue'];
            if ($v['required'] == 1) {
                if (empty($extendValue[$k])) {
                    die('<script>alert("属性值必填");history.go(-1);</script>');
                }
                if (!empty($contExtendModel->requiredValue)) {
                    if (!preg_match("{$v['requiredValue']}", $extendValue[$k])) {
                        die('<script>alert("请输入合法值");history.go(-1);</script>');
                    }
                }
            }
            if (!isset($extendValue[$k]{255})) {
                $contExtendModel->value = $extendValue[$k];
            }
            $contExtendModel->save();
            if (isset($extendValue[$k]{255})) {
                $dataModel = new ExtendData();
                $dataModel->extendId = $contExtendModel->primaryKey;
                $dataModel->value = $extendValue[$k];
                $dataModel->save();
            }
        }
    }

    /**
     * 将分类的内容的副分类存储
     * @param $contentId 内容ID
     * @param $category 副分类
     * @Obelisk
     */
    public function secondClass($contentId, $category)
    {
        foreach ($category as $v) {
            $model = new CategoryContent();
            $saveData = [
                'contentId' => $contentId,
                'catId' => $v
            ];
            $model->setAttributes($saveData);
            $model->save();
        }

        return $model->primaryKey;
    }

    /**
     * 添加标签
     * @param $contentId
     * @param $catId
     * @param $tagValue
     * @Obelisk
     */
    public function addTag($contentId, $catId, $tagValue)
    {
        $cateExtend = Yii::$app->db->createCommand("select * from {{%category_tag}} WHERE catId=$catId ORDER by id ASC")->queryAll();
        foreach ($cateExtend as $k => $v) {
            $contExtendModel = new ContentTag();
            $contExtendModel->contentId = $contentId;
            $contExtendModel->tagCatId = $v['tagCatId'];
            $contExtendModel->tagContentId = $tagValue[$k] ? $tagValue[$k] : '';
            $contExtendModel->createTime = time();
            $contExtendModel->save();
        }
    }

    /**
     * 验证标签是否可添加；
     * @Obelisk
     */
    public function verifyTag($pid, $tagValue, $id = "")
    {
        if (count($tagValue) > 0) {
            $tagStr = implode(",", $tagValue);
            $count = count($tagValue);
            if ($id) {
                $sql = "select ct.id from {{%content_tag}} ct LEFT JOIN {{%content}} c ON c.id=ct.contentId WHERE ct.contentId != $id AND c.pid = $pid AND c.id IN (select ct.contentId from {{%content_tag}} ct where ct.tagContentId in(" . $tagStr . ") group by ct.contentId having count(1)=$count )";
                $sign = Yii::$app->db->createCommand($sql)->queryOne();
            } else {
                $sql = "select ct.id from {{%content_tag}} ct LEFT JOIN {{%content}} c ON c.id=ct.contentId WHERE c.pid = $pid AND c.id IN (select m.contentId from {{%content_tag}} m where m.tagContentId in(" . $tagStr . ") group by m.contentId having count(1)=$count )";
                $sign = Yii::$app->db->createCommand($sql)->queryOne();
            }
            if ($sign) {
                die('<script>alert("该套标签的商品已存在");history.go(-1);</script>');
            }
        }

    }
}