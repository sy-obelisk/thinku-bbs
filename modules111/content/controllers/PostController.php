<?php
namespace app\modules\content\controllers;


use yii;
use yii\web\Controller;
use app\libs\Method;
use app\libs\ApiControl;
use app\modules\content\models\Post;
use app\modules\content\models\PostReply;

class PostController extends ApiControl
{
    public $enableCsrfValidation = false;
    public function actionIndex()
    {
        $uid  = Yii::$app->request->get('uid','');    //UID
        $title  = Yii::$app->request->get('title',''); //类型
        $beginTime = Yii::$app->request->get('beginTime','');    //开始时间
        $endTime = Yii::$app->request->get('endTime','');       //结束时间
        $type = Yii::$app->request->get('type','');
        $page = Yii::$app->request->get('page',1);
        $where="1=1";
        if($uid){
            $where .= " AND p.uid ='$uid'";
        }
        if($type){
            $where .= " AND p.catId='$type'";
        }
        if($title){
            $where .= " AND p.title like '%".$title."%'";
        }
        if($beginTime){
            $beginTime = strtotime($beginTime);
            $where .= " AND p.createTime>='$beginTime'";
        }
        if($endTime){
            $endTime = strtotime($endTime);
            $where .= " AND p.createTime<='$endTime'";
        }
        $model = new Post();
        $order = ' ORDER BY p.hot DESC,p.sort ASC,p.id DESC';
        $data = $model->getPostList($where,$order,$page,10);
//        var_dump($data);die;
        return $this->render('index',['data'=>$data]);
    }
    public function actionHot(){
        $id= Yii::$app->request->get('id','');
        $model = new Post();
        $sign = $model->findOne($id);
        if($sign['hot']==1){
            $res = $model->updateAll(array('hot'=>0),'id='.$id);
        } else {
            $res = $model->updateAll(array('hot'=>1),'id='.$id);
        }
        if($res>0){
            die( '<script>alert("设置成功");history.go(-1);</script>');
        } else {
            die( '<script>alert("设置失败请重试");history.go(-1);</script>');
        }
    }

    /**
     * 帖子修改
     * by yanni
     */
    public function actionUpdate(){
        $postId = Yii::$app->request->get('id');
        if($_POST){
            $contentId = Yii::$app->request->post('contentId');
            $content = Yii::$app->request->post('content');
            $title = Yii::$app->request->post('title');
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
        } else {
            $data = Post::findOne($postId);
            return $this->render('add',['data'=>$data]);
        }
    }

    /**
     * 帖子删除
     * by yanni
     */
    public function actionDelete(){
        $id = Yii::$app->request->get('id');
        $model = new Post();
        $re = $model->findOne($id)->delete();
        if($re){
            $data = PostReply::findOne('postId='.$id); //检查是否存在回复
            if($data){
                $res = PostReply::deleteAll('postId='.$id);
                if($res){
                    die( '<script>alert("删除成功");history.go(-1);</script>');
                } else {
                    die( '<script>alert("回复删除失败");history.go(-1);</script>');
                }
            }
            die( '<script>alert("删除成功");history.go(-1);</script>');
        } else {
            die( '<script>alert("删除失败，请重试");history.go(-1);</script>');
        }
    }

    /**
     * 帖子回复展示
     * by yanni
     */
    public function actionPostReply(){
        $id = Yii::$app->request->get('id');
        $model = new PostReply();
        $data = $model->getPostReply($id);
        return $this->render('reply',['data'=>$data]);
//        var_dump($data);die;
    }
    /**
     * 回复添加
     * by yanni
     */
    public function actionReplyAdd(){
        $id = Yii::$app->request->get('id');
        if($_POST){
            $postId = Yii::$app->request->post('postId');
            $content= Yii::$app->request->post('content');
            if($content){
                $userId  = Yii::$app->session->get('adminId');
                $model = new PostReply();
                $model->uid = $userId;
                $model->content = $content;
                $model->createTime = time();
                $model->pid = 0;
                $model->postId = $postId;
                $res = $model->save();
                if($res){
                    header("Location:post-reply?id=".$postId);
                } else {
                    die( '<script>alert("回复失败");history.go(-1);</script>');
                }
            } else {
                die( '<script>alert("请输入回复内容");history.go(-1);</script>');
            }
        } else {
            return $this->render('reply_add');
        }
    }
    /**
     * 回复删除
     * by yanni
     */
    public function actionReplyDelete(){
        $replyId = Yii::$app->request->get('id');
        $model = new PostReply();
        $re = $model->findOne($replyId)->delete();
        if($re){
            die( '<script>alert("删除成功");history.go(-1);</script>');
        } else {
            die( '<script>alert("失败，请重试");history.go(-1);</script>');
        }
    }
    /**
     * 移动帖子
     * by yanni
     */
    public function actionMobileContents(){
        $contents = Yii::$app->request->get('contents');
        $catid = Yii::$app->request->get('catid');
        if(!$catid){
            die(json_encode(['code' => 0,'message' => '请选择移动分类']));
        }
        for($i=0;$i<count($contents);++$i){
            $model = new Post();
            $res = $model->findOne($contents[$i]);
            $res->catId = $catid;
            $re[] = $res->save();
        }
        if(!empty($re)){
            die(json_encode(['code' => 1,'message' => '移动成功']));
        } else {
            die(json_encode(['code' => 0,'message' => '移动失败']));
        }
    }

}