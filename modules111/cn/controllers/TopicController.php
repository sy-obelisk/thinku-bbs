<?php
/**
 * 首页
 * Created by PhpStorm.
 * User: obelisk
 */
namespace app\modules\cn\controllers;
use app\libs\Method;
use app\modules\cn\models\Category;
use app\modules\cn\models\Post;
use app\modules\cn\models\TopicQuestion;
use app\modules\cn\models\Topic;
use app\modules\cn\models\Question;
use app\modules\cn\models\Answer;
use app\modules\cn\models\User;
use app\modules\cn\models\AnswerReply;
use app\modules\cn\models\Banner;
use app\modules\cn\models\Recommend;
use yii;
use yii\web\Controller;
use app\libs\Jpush;

class TopicController extends Controller {
    public $enableCsrfValidation = false;
    public $layout=false;

    /**
     * 话题->问题列表页
     * @Obelisk
     */
    public function actionIndex(){
        $topicId = Yii::$app->request->get('topicId',1);
        $uid = Yii::$app->session->get('uid');
        $topic = Topic::findOne($topicId);
        $model = new TopicQuestion();
        $data = $model->getTopicQuestion($topicId,1,8);
        if($uid){
            $userTopic = $model->getUserTopic($uid);
        }else{
            $userTopic = [];
        }
        foreach($data['data'] as $k=>$v){
            $model = new TopicQuestion();
//            $data['data'][$k]['commentNum'] = count($model->getAnswer($v['questionId']));
            $sign = $model->getAnswer($v['questionId'],3);
            foreach($sign as $key=>$va){
                $sign[$key]['commentNum'] = AnswerReply::find()->where("answerId=".$va['id'])->count();
                $sign[$key]['user'] = User::find()->asArray()->where("uid=".$va['uid'])->select(['username'])->one();
            }
            $data['data'][$k]['answer'] = $sign;
        }
//        var_dump($data['data']);die;
        $model = new Topic();
        $hotTopic = $model->find()->asArray()->where('hot=1')->all();
        $qr_code = Banner::find()->asArray()->where("tag=1")->all();  //二维码
        $models = new Recommend();
        $curriculum = $models->getRecommend();   //热门课程推荐展示
        return $this->renderPartial('index',['hotTopic' => $hotTopic,'userTopic' => $userTopic,'topic'=>$topic,'data'=>$data,'qr_code'=>$qr_code,'curriculum'=>$curriculum]);
    }

    /**
     * 话题列表
     * @Obelisk
     */
    public function actionTopicList(){
        $topic = Topic::find()->asArray()->where('type=1')->all();
        $model = new Topic();
        $hotTopic = $model->find()->asArray()->where('hot=1')->all();
        $qr_code = Banner::find()->asArray()->where("tag=1")->all();  //二维码
        $models = new Recommend();
        $curriculum = $models->getRecommend();   //热门课程推荐展示
        return $this->renderPartial('topicList',['topic'=>$topic,'hotTopic'=>$hotTopic,'qr_code'=>$qr_code,'curriculum'=>$curriculum]);
    }
    /**
     * 问题详情
     * @Obelisk
     */
    public function actionQuestion(){
        $questionId = Yii::$app->request->get('questionId',1);
        $topicId = Yii::$app->request->get('topicId');
        $postModel = new Post();
        $hotPost = $postModel->getPost(1,8,'',1);
        $question = Question::findOne($questionId);  //问题
        Question::updateAll(array('viewCount'=>$question['viewCount']+1),'id='.$questionId);  //浏览量加1
        $model = new TopicQuestion();
        $data = $model->getAnswer($questionId);      //问题回答
        if($topicId){
            $topic = Topic::findOne($topicId);
            $hotQuestion = $model->getHotQuestion($topicId,$questionId);      //相关问题
            $topics = $model->getAllTopic($questionId);
        } else{
            $res = TopicQuestion::find()->asArray()->where('questionId='.$questionId)->orderBy('id asc')->one();
            $topic = Topic::findOne($res['topicId']);
            $hotQuestion = $model->getHotQuestion($res['topicId'],$questionId);      //相关问题
            $topics = $model->getAllTopic($questionId);
        }
        foreach($data as $k=>$v){
            $replyModel = new AnswerReply();
            $data[$k]['reply'] = $replyModel->getReplyUser($v['id'],1,5);  //回答回复
        }
        $qr_code = Banner::find()->asArray()->where("tag=1")->all();  //二维码
        $models = new Recommend();
        $curriculum = $models->getRecommend();   //热门课程推荐展示
        return $this->renderPartial('question',['topicId' => $topicId,'hotQuestion' => $hotQuestion,'topic' => $topic,'topics' => $topics,'data'=>$data,'question'=>$question,'hotPost'=>$hotPost['data'],'curriculum'=>$curriculum,'qr_code'=>$qr_code]);
    }
}