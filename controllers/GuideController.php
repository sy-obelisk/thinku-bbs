<?php

namespace app\controllers;

use app\modules\content\models\Content;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\Excl;
use app\modules\content\models\Category;
use app\modules\content\models\CategoryContent;


class GuideController extends Controller
{
    public function actionIndex()
    {
        $session = Yii::$app->session;
        $data = Yii::$app->db->createCommand("Select * From x2_excl")->queryAll();

        foreach ($data as $v) {
            if ($v['id']) {
                $model = new Content();
                $catName = substr($v['number'], 0, 6);
                $catId = Category::find()->where("name='$catName'")->one();
                $vice1 = Category::find()->where("name='{$v['vice1']}'")->one();
                $vice2 = Category::find()->where("name='{$v['vice2']}'")->one();
                $catId = $catId->id;
                $vice1 = $vice1->id;
                $vice2 = $vice2->id;
                $model->pid = 0;
                $model->catId = $catId;
                $model->name = $v['name'];
                $model->title = substr($v['number'], 7);
                $model->image = '/files/guide/TPO 11/TFindex_boPart.png';
                $model->createTime = date("Y-m-d H:i:s");
                $model->userId = 1;
                $model->save();
                $contentId = $model->primaryKey;
                $model = new CategoryContent();
                $saveData = [
                    'contentId' => $contentId,
                    'catId' => 38,
                ];
                $model->setAttributes($saveData);
                $model->save();
                $this->addSecondClass($contentId, $catId);
                $this->addSecondClass($contentId, $vice1);
                $this->addSecondClass($contentId, $vice2);
                $session->set('contentId', $contentId);
                $this->addContentExtend($contentId, $catId, $v, $catName);
                $this->addChildQuestion($contentId, $v, $catName);
                $this->addChildText($contentId, $v);
            } else {
                $contentId = $session->get('contentId');
                if ($v['questionNumber']) {
                    $this->addChildQuestion($contentId, $v, $catName);
                    $this->addChildText($contentId, $v);
                } else if ($v['section']) {
                    $this->addChildText($contentId, $v);

                }
            }
        }
        echo '导入结束';
    }

    public function addContentExtend($contentId, $catId, $val, $catName)
    {
        $cateExtend = Yii::$app->db->createCommand("select * from x2_category_extend WHERE catId=$catId AND belong='content' ORDER by id ASC")->queryAll();
        foreach ($cateExtend as $k => $v) {
            $saveData = $v;
            $saveData['catExtendId'] = $v['id'];
            unset($saveData['id']);
            unset($saveData['belong']);
            unset($saveData['catId']);
            unset($saveData['pid']);
            unset($saveData['deleteType']);
            if ($k == 0) {
                $saveData['value'] = "";
            }
            if ($k == 1) {
                $saveData['value'] = "";
            }
            if ($k == 2) {
                $saveData['value'] = "/files/guide/" . $catName . "/" . $val['textUrl'];
            }
            if ($k == 3) {
                $saveData['value'] = file_get_contents("files/guide/" . $catName . "/" . $val['textContent']);
            }
            if ($k == 4) {
                $saveData['value'] = $val['cnName'];
            }
            $saveData['contentId'] = $contentId;
            Yii::$app->db->createCommand()->insert('x2_content_extend', $saveData)->execute();
        }
    }

    public function addChildQuestion($contentId, $val, $catName)
    {
        $model = new Content();
        $model->pid = $contentId;
        $model->catId = 48;
        $model->name = $val['questionText'];
        $model->createTime = date("Y-m-d H:i:s");
        $model->userId = 1;
        $model->save();
        $contentId = $model->primaryKey;
        $this->addSecondClass($contentId, 48);
        $cateExtend = Yii::$app->db->createCommand("select * from x2_category_extend WHERE catId=48 AND belong='content' ORDER by id ASC")->queryAll();
        foreach ($cateExtend as $k => $v) {
            $saveData = $v;
            $saveData['catExtendId'] = $v['id'];
            unset($saveData['id']);
            unset($saveData['belong']);
            unset($saveData['catId']);
            unset($saveData['pid']);
            unset($saveData['deleteType']);
            if ($k == 0) {
                $saveData['value'] = $val['selectText'];
            }
            if ($k == 1) {
                $saveData['value'] = $val['answer'];
            }
            if ($k == 2) {
                $saveData['value'] = "/files/guide/" . $catName . "/" . $val['questionUrl'];
            }
            if ($k == 3) {
                $saveData['value'] = !empty($val['questionUrl2']) ? "/files/guide/" . $catName . "/" . $val['questionUrl2'] : '';
            }
            if ($k == 4) {
                $saveData['value'] = $val['questionType'];
            }
            $saveData['contentId'] = $contentId;
            Yii::$app->db->createCommand()->insert('x2_content_extend', $saveData)->execute();
        }
    }

    public function addChildText($contentId, $val)
    {
        $model = new Content();
        $model->pid = $contentId;
        $model->catId = 49;
        $model->name = 'childText';
        $model->createTime = date("Y-m-d H:i:s");
        $model->userId = 1;
        $model->save();
        $contentId = $model->primaryKey;
        $this->addSecondClass($contentId, 49);
        $cateExtend = Yii::$app->db->createCommand("select * from x2_category_extend WHERE catId=49 AND belong='content' ORDER by id ASC")->queryAll();
        foreach ($cateExtend as $k => $v) {
            $saveData = $v;
            $saveData['catExtendId'] = $v['id'];
            unset($saveData['id']);
            unset($saveData['belong']);
            unset($saveData['catId']);
            unset($saveData['pid']);
            unset($saveData['deleteType']);
            if ($k == 0) {
                $saveData['value'] = $val['section'];
            }
            if ($k == 1) {
                $saveData['value'] = $val['sentence'];
            }
            if ($k == 2) {
                $saveData['value'] = $val['sentenceText'];
            }
            if ($k == 3) {
                $saveData['value'] = $val['time'];
            }
            if ($k == 4) {
                $saveData['value'] = $val['sentenceCnText'];
            }
            $saveData['contentId'] = $contentId;
            Yii::$app->db->createCommand()->insert('x2_content_extend', $saveData)->execute();
        }
    }

    public function addSecondClass($contentId, $catId)
    {
        $model = new CategoryContent();
        $saveData = [
            'contentId' => $contentId,
            'catId' => $catId,
        ];
        $model->setAttributes($saveData);
        $model->save();
    }
}
