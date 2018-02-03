<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/4/21 0021
 * Time: 10:40
 */
namespace app\modules\cn\controllers;

use app\modules\content\models\Category;
use yii;
use yii\web\Controller;
use app\modules\content\models\Content;
use app\modules\content\models\ExtendData;
use app\modules\content\models\ContentExtend;
use app\modules\content\models\CategoryContent;

class ArticleController extends Controller
{
    public $layout = 'cn.php';
    public $enableCsrfValidation = false;

    public function actionDetails()
    {
        return $this->render('details');
    }

    public function actionNew()
    {
        if ($_POST) {
            $model = new content();
            $contentData = Yii::$app->request->post('content');
            $id = Yii::$app->request->post('id');
            $url = Yii::$app->request->post('url');
            $extendId = Yii::$app->request->post('key', []);
            $extendValue = Yii::$app->request->post('value');
            $category = explode(",", Yii::$app->request->post('category'));
            $content = explode(",", Yii::$app->request->post('con'));
            if (empty($contentData['name'])) {
                die('<script>alert("请输入内容名称");history.go(-1);</script>');
            }
            if (!in_array($contentData['catId'], $category)) {
                die('<script>alert("主分类必须在副分类中");history.go(-1);</script>');
            }
            if ($id) {
                $re = $model->updateAll($contentData, 'id = :id', [':id' => $id]);
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
                CategoryContent::deleteAll('contentId = :contentId', array(':contentId' => $id));
                $categoryContent=new CategoryContent();
                $categoryContent->secondClass($id, $category);
            } else {
                $addtime = date("Y-m-d H:i:s");
                $model->createTime = $addtime;
                $model->userId = Yii::$app->session->get('adminId');
                $model->name = $contentData['name'];
                $model->abstract = $contentData['abstract'];
                $model->pid = $contentData['pid'];
                $model->image = $contentData['image'];
                $model->catId = $contentData['catId'];
                $model->viewCount = $contentData['viewCount'];
                $re = $model->save();
                Content::updateAll(['sort' => $model->primaryKey], "id=$model->primaryKey");
                //将分类的内容属性，转移到内容本身的扩展属性中
                $contentExtend=new ContentExtend();
                $contentExtend->shiftExtend($model->primaryKey, $contentData['catId'], $extendValue, $contentData['pid']);
                //将分类的内容的副分类存储
                $categoryContent=new CategoryContent();
                $categoryContent->secondClass($model->primaryKey, $category);
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
            return $this->render('new');
        }

    }


}