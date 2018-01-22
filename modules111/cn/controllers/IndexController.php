<?php
/**
 * 首页
 * Created by PhpStorm.
 * User: obelisk
 */
namespace app\modules\cn\controllers;
use app\modules\cn\models\Category;
use app\modules\cn\models\Gossip;
use app\modules\cn\models\Post;
use app\modules\cn\models\Banner;
use app\modules\cn\models\Question;
use app\modules\cn\models\User;
use app\modules\cn\models\Topic;
use yii;
use yii\web\Controller;
use app\libs\Jpush;

class IndexController extends Controller {
    function init (){
        parent::init();
        include_once($_SERVER['DOCUMENT_ROOT'].'/../libs/ucenter/ucenter.php');
    }
    public $enableCsrfValidation = false;
    public $layout=false;

    /**
     * 帖子展示
     * @Obelisk
     */
    public function actionIndex()
    {
        $selectId = Yii::$app->request->get('selectId', 0);
        $hot = Yii::$app->request->get('hot', '');
        $uid = Yii::$app->session->get('uid');
        $user = User::findOne($uid);
//        $sign = Category::findOne($selectId);
//        Yii::$app->session->set('lockUrl',Yii::$app->request->url);
//        if ($sign->keyTag == 2 && !$uid) {
//            header("Location:http://login.gmatonline.cn/cn/index?source=8&url=http://bbs.viplgw.cn".Yii::$app->request->url);
//            die;
//        }
//        if (($sign->keyTag == 1) || ($sign->keyTag == 2 && $sign->passKey < $user->roleId)) {
//            if($sign->keyTag == 2){
//                $integral = uc_user_integral1($uid);
//                $integral = $integral['totalIntegral'];
//                if($integral>=10000){
//                    User::updateAll(['roleId' => 3],"uid=$uid");
//                }else{
//                    return $this->redirect("/lock/$selectId.html");
//                }
//            }else{
//                $sign = Yii::$app->session->get('category'.$selectId);
//                if(!$sign ) {
//                    return $this->redirect("/lock/$selectId.html");
//                }
//            }
//        }
//        if ($selectId) {
//            $sign = Category::findOne($selectId);
//            if ($sign->gossipType) {
//                header("Location:/gossip/$selectId.html");
//                die;
//            }
//            if ($sign->pid == 0) {
//                $pid = $selectId;
//                $catId = 0;
//                $secondCategory = Category::find()->asArray()->where("pid=$selectId")->orderBy("sort ASC")->all();
//            } else {
//                $pid = $sign->pid;
//                $catId = $selectId;
//                $secondCategory = Category::find()->asArray()->where("pid=$sign->pid")->orderBy("sort ASC")->all();
//            }
//        } else {
//            $pid = 0;
//            $catId = 0;
//            $secondCategory = [];
//        }
        $firstCategory = Category::find()->asArray()->where("pid=0")->orderBy("sort ASC")->all();
        $banner = Banner::find()->asArray()->where("tag=0")->limit(4)->all();  //页面banner图
        $model = new Post();
        $modelg = new Gossip();
        $gossip = $modelg->getAllGossipDetail();  //最新八卦
        $newTopic = Topic::find()->asArray()->where("type=1")->orderBy("createTime DESC")->limit(20)->all();  //最新话题
        $queModel = new Question();
        $hotQuestion = $queModel->getHotQuestion();
        $count = Post::find()->count();  //总话题
        $today = date("Y-m-d");
        $today = Post::find()->where("dateTime='$today'")->count();
        $lastDay = date("Y-m-d",time()-86400);
        $lastDay = Post::find()->where("dateTime='$lastDay'")->count();
        $allRow = [];
        $dataCategory = Category::find()->asArray()->where("pid=0 AND gossipType=0")->orderBy("sort ASC")->all();
        foreach($dataCategory as $k => $v) {
            $data = $model->getPost(1, 10,$v['id']);
            $allRow[$k]['catId'] = $v['id'];
            $allRow[$k]['data'] = $data['data'];
            $allRow[$k]['second'] = Category::find()->asArray()->where("pid={$v['id']} AND id !=8 AND id !=29")->orderBy("sort ASC")->all();
        }
        $indexData = $model->getPost(1, 10, 0);
        $model = new Gossip();
        $gossipCategory = Category::find()->asArray()->where("pid=24")->orderBy("sort ASC")->all();
        $gossipData = $model->getGossip(1,10,0);
        return $this->renderPartial('index', ['gossipCategory' => $gossipCategory,'gossipData' => $gossipData,'count' => $count,'today' => $today,'lastDay' => $lastDay,'selectId' => $selectId, 'allRow' => $allRow, 'firstCategory' => $firstCategory, 'gossip' => $gossip, 'newTopic' => $newTopic, 'banner' => $banner,'hotQuestion'=>$hotQuestion,'indexData' => $indexData['data']]);

    }

    /**
     * 备考八卦展示
     * @Obelisk
     */
    public function actionGossip(){

        $selectId = Yii::$app->request->get('selectId',0);
        if($selectId){
            $sign = Category::findOne($selectId);
            if($sign->pid == 0){
                $pid =  $selectId;
                $catId = 0;
                $secondCategory = Category::find()->asArray()->where("pid=$selectId")->orderBy("sort ASC")->all();
            }else{
                $pid = $sign->pid;
                $catId = $selectId;
                $secondCategory = Category::find()->asArray()->where("pid=$sign->pid")->orderBy("sort ASC")->all();
            }
        }else{
            $pid = 0;
            $catId = 0;
            $secondCategory = [];
        }
        $firstCategory = Category::find()->asArray()->where("pid=0")->orderBy("sort ASC")->all();
        $banner = Banner::find()->asArray()->where("tag=0")->limit(4)->all();  //页面banner图
        $model = new Gossip();
        $data = $model->getGossip(1,10,$sign->gossipType);
        $gossip = $model->getAllGossipDetail();  //最新八卦
        $model = new Post();
        $queModel = new Question();
        $hotQuestion = $queModel->getHotQuestion();
        $newTopic = Topic::find()->asArray()->orderBy("createTime DESC")->limit(20)->all();  //最新话题
        return $this->renderPartial('gossip',['selectId' => $selectId,'data' => $data,'pid' => $pid,'catId' => $catId,'firstCategory' => $firstCategory,'secondCategory' => $secondCategory,'gossip'=>$gossip,'newTopic'=>$newTopic,'banner'=>$banner,'hotQuestion'=>$hotQuestion]);
    }

    /**
     * 帖子列表页
     * by  obelisk
     */
    public function actionPostList(){
        $catId = Yii::$app->request->get('catId',0);
        if ($catId == 7) {
            header("Location:http://www.gmatonline.cn/question_index.html");
            die;
        }
        $hot = Yii::$app->request->get('hot', '');
        $page = Yii::$app->request->get('page',1);
        $sign = Category::findOne($catId);
        $uid = Yii::$app->session->get('uid');
        $user = User::findOne($uid);
        Yii::$app->session->set('lockUrl',Yii::$app->request->url);
        if ($sign->keyTag == 2 && !$uid) {
            header("Location:http://login.gmatonline.cn/cn/index?source=8&url=http://bbs.viplgw.cn".Yii::$app->request->url);
            die;
        }
        if (($sign->keyTag == 1) || ($sign->keyTag == 2 && $sign->passKey < $user->roleId)) {
            if($sign->keyTag == 2){
                $integral = uc_user_integral1($uid);
                $integral = $integral['totalIntegral'];
                if($integral>=10000){
                    User::updateAll(['roleId' => 3],"uid=$uid");
                }else{
                    return $this->redirect("/lock/$catId.html");
                }
            }else{
                $sign = Yii::$app->session->get('category'.$catId);
                if(!$sign ) {
                    return $this->redirect("/lock/$catId.html");
                }
            }
        }
        if($sign->gossipType){
            header("Location:/gossip/list/$catId.html");die;
        }
        $model = new  Post();
        $data = $model->getPost($page,15,$catId,$hot);
        $count = $data['count'];
        $data = $data['data'];
        $catModel = new Category();
        $pageStr = $model->getPage($page,15,$catId,$hot);
        $category = Category::find()->asArray()->where("id=$catId")->one();
        $today = date("Y-m-d");
        $today = Post::find()->where("dateTime='$today' AND catId=$catId")->count();
        $parent = $catModel->getCategory($catId);
        if($catId!=0){
            $catChild = $catModel->getCatChild($catId);
        }
        return $this->renderPartial('postList',['today' => $today,'count' => $count,'category' => $category,'parent' =>$parent,'catId' => $catId,'data' => $data,'category' => $sign,'pageStr' => $pageStr,'catChild'=>$catChild]);
    }

    public function actionLock(){
        $catId = Yii::$app->request->get('catId');
        $data = Category::find()->asArray()->where("id=$catId")->one();
        if($data['keyTag'] == 2){
            $uid = Yii::$app->session->get('uid');
            $integral = uc_user_integral1($uid);
            return $this->renderPartial('lock',['data' => $data,'integral' => $integral['integral']]);
        }else{
            return $this->renderPartial('lock',['data' => $data]);
        }
    }

    /**
     * 帖子列表页
     * by  obelisk
     */
    public function actionSearchList(){
        $keywords = Yii::$app->request->get('keywords');
        $page = Yii::$app->request->get('page',1);
        $model = new  Post();
        if($keywords == '鸡精' || $keywords == '机经'){
            $data = [];
            $pageStr = "";
        }else{
            $data = $model->searchPost($page,10,$keywords);
            $pageStr = $model->searchPage($page,10,$keywords);
        }
        return $this->renderPartial('searchList',['keywords' => $keywords,'data' => $data,'pageStr' => $pageStr]);
    }

    /**
     * 八卦列表页
     * by  obelisk
     */
    public function actionGossipList(){
        $catId = Yii::$app->request->get('catId');
        $page = Yii::$app->request->get('page',1);
        if($catId){
            $category = Category::findOne($catId);
            $model = new Gossip();
            $data = $model->getGossip($page,10,$category->gossipType);
            $pageStr = $model->getPage($page,10,$category->gossipType);
        } else {
            $model = new Gossip();
            $data = $model->getGossip($page,10,'');
            $pageStr = $model->getPage($page,10,'');
        }
        return $this->renderPartial('gossipList',['catId' => $catId,'data' => $data,'category' => $category,'pageStr' => $pageStr]);
    }
}