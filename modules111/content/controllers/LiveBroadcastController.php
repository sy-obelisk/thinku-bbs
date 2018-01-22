<?php
namespace app\modules\content\controllers;
use app\modules\cn\models\TopicQuestion;
use app\modules\content\models\Topic;
use yii;
use yii\web\Controller;
use app\libs\ApiControl;
use app\modules\content\models\Live;
use app\modules\content\models\Answer;
use app\modules\content\models\AnswerReply;

class LiveBroadcastController extends ApiControl
{
    public $enableCsrfValidation = false;

    /**
     * 直播
     * by yanni
     */
    public function actionIndex()
    {
        $page = Yii::$app->request->get('page',1);
        $where="1=1";
        $model = new Live();
        $order = ' ORDER BY l.id DESC';
        $data = $model->getLiveBroadcast($where,$order,$page,20);
        return $this->render('index',['data'=>$data]);
    }
    /**
     * 添加直播
     * by Yanni
     */
    public function actionAdd()
    {
        if ($_POST) {
            $liveId = Yii::$app->request->post('liveId', '');
            $title = Yii::$app->request->post('title', '');
            $startTime = Yii::$app->request->post('startTime', '');
            $endTime = Yii::$app->request->post('endTime', '');
            $psvTime = Yii::$app->request->post('psvTime', '');
            $img = Yii::$app->request->post('img', '');
            $img1 = Yii::$app->request->post('img1', '');
            $img2 = Yii::$app->request->post('img2', '');
            if($liveId){
                $model = new Live();
                $res = $model->findOne($liveId);
                $res->title = $title;
                $res->image = $img;
                $res->startTime = isset($startTime)?strtotime($startTime):'';
                $res->endTime = isset($endTime)?strtotime($endTime):'';
                $res->psvTime =  isset($psvTime)?strtotime($psvTime):'';
                $res->createTime = time();
                $res->psvImage = $img1;
                $res->backImage = $img2;
                $re = $res->save();
            } else {
                $model = new Live();
                $model->title = $title;
                $model->image = $img;
                $model->startTime = strtotime($startTime);
                $model->endTime = strtotime($endTime);
                $model->psvTime = strtotime($psvTime);
                $model->createTime = time();
                $model->psvImage = $img1;
                $model->backImage = $img2;
                $re = $model->save();
            }
            if ($re) {
                return $this->redirect('/content/live-broadcast/index');
            } else {
                die('<script>alert("失败，请重试");history.go(-1);</script>');
            }
        } else {
            $id = Yii::$app->request->get('id', '');
            $data = '';
            if($id){
                $model = new Live();
                $data = $model->findOne($id);
            }
            return $this->render('add',['data'=>$data]);
        }
    }
    public function actionDelete(){
        $id = Yii::$app->request->get('id', '');
        $res = Live::deleteAll('id='.$id);
        if($res){
            die( '<script>alert("删除成功");history.go(-1);</script>');
        } else {
            die( '<script>alert("删除失败");history.go(-1);</script>');
        }
    }
}