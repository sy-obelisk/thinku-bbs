<?php
namespace app\modules\content\controllers;
use app\modules\cn\models\TopicQuestion;
use app\modules\content\models\Topic;
use yii;
use yii\web\Controller;
use app\libs\ApiControl;
use app\modules\content\models\Question;
use app\modules\content\models\Answer;
use app\modules\content\models\AnswerReply;

class QuestionController extends ApiControl
{
    public $enableCsrfValidation = false;

    /**
     * 问题展示
     * by yanni
     */
    public function actionIndex()
    {
        $uid  = Yii::$app->request->get('uid','');    //UID
        $words = Yii::$app->request->get('words','');    //关键词
        $beginTime = Yii::$app->request->get('beginTime','');    //开始时间
        $endTime = Yii::$app->request->get('endTime','');       //结束时间
        $topic = Yii::$app->request->get('topic','');
        $page = Yii::$app->request->get('page',1);
        $where="1=1";
        if($topic){
            $where .= " AND tq.topicId ='$topic'";
        }
        if($uid){
            $where .= " AND q.uid ='$uid'";
        }
        if($beginTime){
            $beginTime = strtotime($beginTime);
            $where .= " AND q.createTime>='$beginTime'";
        }
        if($endTime){
            $endTime = strtotime($endTime);
            $where .= " AND q.createTime<='$endTime'";
        }
        if($words){
            $where .= " AND (q.title like '%".$words."%' or q.content like '%".$words."%')";
        }
        $model = new Question();
        $order = ' ORDER BY q.id DESC';
        $data = $model->getQuestionList($where,$order,$page,20);
        $topic = Topic::find()->asArray()->all();
        return $this->render('index',['data'=>$data,'topic'=>$topic]);
    }

    /**
     * 问题删除
     * by yanni
     */
    public function actionDelete(){
        $id = Yii::$app->request->get('id');
        $data = Answer::find()->where('questionId='.$id)->one(); //检查问题下是否存在回答
        if($data){
            die( '<script>alert("请先删除此问题的回答");history.go(-1);</script>');
        }
        $model = new Question();
        $re = $model->findOne($id)->delete();
        $res = TopicQuestion::deleteAll('questionId='.$id);
        if($re && $res){
            die( '<script>alert("删除成功");history.go(-1);</script>');
        } else {
            die( '<script>alert("删除失败，请重试");history.go(-1);</script>');
        }
    }
    /**
     * 问题回答展示
     * by yanni
     */
    public function actionAnswer(){
        $id = Yii::$app->request->get('id');
        $model = new Answer();
        $where = " questionId=".$id;
        $order = ' ORDER BY a.id DESC';
        $data = $model->getAnswerList($where,$order);
        return $this->render('answer',['data'=>$data]);
    }

    /**
     * 问题回答删除
     * by yanni
     */
    public function actionAnswerDelete(){
        $id = Yii::$app->request->get('id');
        $model = new Answer();
        $re = $model->findOne($id)->delete();
        if($re){
            $data = AnswerReply::find()->where('answerId='.$id)->one(); //检查问题下是否存在回答
            if($data){
                $res = AnswerReply::deleteAll('answerId='.$id);
                if($res){
                    die( '<script>alert("删除成功");history.go(-1);</script>');
                } else {
                    die( '<script>alert("话题关联的问题删除失败");history.go(-1);</script>');
                }
            }
            die( '<script>alert("删除成功");history.go(-1);</script>');
        } else {
            die( '<script>alert("删除失败，请重试");history.go(-1);</script>');
        }
    }

    /**
     * 回复展示
     * by yanni
     */
    public function actionReply(){
        $id = Yii::$app->request->get('id');
        $model = new AnswerReply();
        $where = " answerId=".$id;
        $order = ' ORDER BY ar.id DESC';
        $data = $model->getReplyList($where,$order);
        return $this->render('reply',['data'=>$data]);
    }
    /**
     * 回复删除
     * by yanni
     */
    public function actionReplyDelete(){
        $id = Yii::$app->request->get('id');
        $model = new AnswerReply();
        $re = $model->findOne($id)->delete();
        if($re){
            die( '<script>alert("删除成功");history.go(-1);</script>');
        } else {
            die( '<script>alert("删除失败，请重试");history.go(-1);</script>');
        }
    }
}