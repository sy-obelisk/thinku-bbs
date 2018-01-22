<?php
/**
 * 首页
 * Created by PhpStorm.
 * User: obelisk
 */
namespace app\modules\cn\controllers;
use app\libs\Method;
use app\modules\cn\models\Banner;
use app\modules\cn\models\Category;
use app\modules\cn\models\Post;
use app\modules\cn\models\PostReply;
use app\modules\cn\models\Recommend;
use app\modules\user\models\User;
use yii;
use yii\web\Controller;
use app\libs\Jpush;

class PostController extends Controller {
    function init (){
        parent::init();
        include_once($_SERVER['DOCUMENT_ROOT'].'/../libs/ucenter/ucenter.php');
    }
    public $enableCsrfValidation = false;
    public $layout=false;

    /**
     * 帖子详情
     * @Obelisk
     */
    public function actionIndex(){
        $id = Yii::$app->request->get('id');
        $model = new Post();
        $data = $model->getPostDetails($id);
        $cat = $model->findOne($id);
        $catId = $cat['catId'];
        $sign = Category::findOne($cat['catId']);
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
        $catModel = new Category();
        $parent = $catModel->getCategory($cat['catId']);
        $data['parent'] = $parent;
        $uid = Yii::$app->session->get('uid');
        if($uid){
            $sign = PostReply::find()->where("postId = $id AND uid = $uid")->one();
            if($sign || $uid == $data['data']['uid']){
                $sign = 1;
            }else{
                $sign = 0;
            }
        }else{
            $sign = 0;
        }
        $data['sign'] = $sign;
        return $this->renderPartial('details',$data);
    }

    /**
     * 帖子修改
     * by  yanni
     */
    public function actionUpdatePost(){
        $contentId = Yii::$app->request->post('contentId');
        $title = Yii::$app->request->post('title');
        $content = Yii::$app->request->post('content');
        $cnContent = strip_tags($content);
        $sign1 = Method::sensitiveWords($cnContent);
        $sign2 = Method::sensitiveWords($title);
        if($sign1['code'] == 0 || $sign2['code' ==0]){
            die(json_encode(['code' => 0,'message' => '请勿输入敏感词汇']));
        }
        $imageContent = Method::getStrImage($content);
        $model = new Post();
        $res = $model->findOne($contentId);
        $res->title = $title;
        $res->imageContent = serialize($imageContent);
        $res->cnContent = $cnContent;
        $res->content = $content;
        $re = $res->save();
        if($re>0){
            die( '<script>alert("修改成功");history.go(-1);</script>');
        } else {
            die( '<script>alert("修改失败");history.go(-1);</script>');
        }
    }

    /**
     * 发布帖子
     * @Obelisk
     */
    public function actionAddPost(){
        if($_POST){
            $data = Yii::$app->request->post('data');
            $cnContent = strip_tags($data['content']);
            $sign1 = Method::sensitiveWords($cnContent);
            $sign2 = Method::sensitiveWords($data['title']);
            if($sign1['code'] == 0 || $sign2['code' ==0]){

            }
            $imageContent = Method::getStrImage($data['content']);
            $model = new Post();
            $model->title = $data['title'];
            $model->content = $data['content'];
            $model->cnContent = $cnContent;
            $model->imageContent = serialize($imageContent);
            $model->datum = serialize($data['datum']);
            $model->radio = serialize($data['radio']);
            $model->createTime = time();
            $model->dateTime = date("Y-m-d");
            $model->hot = 0;
            $model->catId = $data['catId'];
            $model->sort = 99999;
            $model->viewCount = 0;
            $model->save();
        }else{
            $postId = Yii::$app->request->get('id');
            $model = new Category();
            if($postId){
                $modelPost = new Post();
                $data = $modelPost->getPostDetails($postId);
                $cat = $modelPost->findOne($postId);
                $parent = $model->getCategory($cat['catId']);
            }
            $firstCategory = $model->getAllCatArr(0);
            $modelRe = new Recommend();
            $recommend = $modelRe->getRecommend();
            return $this->renderPartial('add',['firstCategory' => $firstCategory,'recommend'=>$recommend,'data'=>$data['data'],'parent'=>$parent]);
        }
    }
}