<?php
namespace app\modules\content\controllers;


use yii;
use yii\web\Controller;
use app\libs\ApiControl;
use app\modules\content\models\Gossip;
use app\modules\content\models\Reply;

class GossipController extends ApiControl
{
    public $enableCsrfValidation = false;
    public function actionIndex()
    {
        $uid  = Yii::$app->request->get('uid','');    //UID
        $type  = Yii::$app->request->get('type',''); //类型
        $beginTime = Yii::$app->request->get('beginTime','');    //开始时间
        $endTime = Yii::$app->request->get('endTime','');       //结束时间
        $page = Yii::$app->request->get('page',1);
        $where="1=1";
        if($uid){
            $where .= " AND g.uid ='$uid'";
        }
        if($type){
            $where .= " AND g.belong='$type'";
        }
        if($beginTime){
            $beginTime = strtotime($beginTime);
            $where .= " AND g.createTime>='$beginTime'";
        }
        if($endTime){
            $endTime = strtotime($endTime);
            $where .= " AND g.createTime<='$endTime'";
        }
        $model = new Gossip();
        $order = ' ORDER BY id DESC';
        $data = $model->getGossipList($where,$order,$page,20);
        return $this->render('index',['data'=>$data]);
    }
    /**
     * 添加八卦
     * by Yanni
     */
    public function actionAdd(){
        $user  = Yii::$app->session->get('adminData');
//        var_dump($user);die;
        if($user['uid']){
            if($_POST){
                $title= Yii::$app->request->post('title','');
                $content = Yii::$app->request->post('content','');
                $img = Yii::$app->request->post('img','');
                $viewCount = Yii::$app->request->post('viewCount','');
                $type = Yii::$app->request->post('type','');
                $img = rtrim($img, ',');
                $img = explode(',',$img);
                if($viewCount==''){
                    die( '<script>alert("浏览量不能为空");history.go(-1);</script>');
                }
                $model = new Gossip();
                $model->title = base64_encode($title);
                $model->content = base64_encode($content);
                $model->image = json_encode($img);;
                $model->createTime = time();
                $model->uid = $user['uid'];
                $model->publisher = $user['nickname'];
                $model->viewCount = $viewCount;
                $model->belong = $type;
                $re = $model->save();
                if($re){
                    return $this->redirect('/content/gossip/index');
                } else{
                    die( '<script>alert("失败，请重试");history.go(-1);</script>');
                }
            } else {
                return $this->render('add');
            }
        } else{
            $this->redirect('/user/login/index');
        }
    }
    /**
     * 添加回复
     * by Yanni
     */
    public function actionAllReply(){
        $user  = Yii::$app->session->get('adminData');
        $replyId  = Yii::$app->request->post('replyId','');  //回复ID
        if($replyId){        //当回复ID存在时，就获取该回复的信息
            $gossipId  = Yii::$app->request->post('gossipId','');    //八卦ID
            $content  = Yii::$app->request->post('content','');
            $replyData = Reply::findOne($replyId);       //回复信息
            $model = new Reply();
            $model->content = base64_encode($content);
            $model->replyUser = $replyData['uid'];
            $model->createTime = time();
            $model->type = 2;
            $model->gossipId = $gossipId;
            $model->uid = $user['uid'];
            $model->isLook = 1;
            $model->uName = isset($user['nickname'])?$user['nickname']:$user['username'];
            $model->replyUserName = $replyData['uName'];
            $model->userImage = isset($user['image'])?$user['image']:'';
            $add = $model->save();
        } else {
            $gossipId1  = Yii::$app->request->post('gossipId-1','');    //八卦ID
            $contentPost  = Yii::$app->request->post('contentPost','');
            $model = new Reply();
            $model->content = base64_encode($contentPost);
            $model->replyUser = 0;
            $model->createTime = time();
            $model->type = 1;
            $model->gossipId = $gossipId1;
            $model->uid = $user['uid'];
            $model->isLook = 1;
            $model->uName = isset($user['nickname'])?$user['nickname']:$user['username'];
            $model->replyUserName = '';
            $model->userImage = isset($user['image'])?$user['image']:'';
            $add = $model->save();
        }
        if($add){
            die( '<script>alert("回复成功");history.go(-1);</script>');
        } else{
            die( '<script>alert("回复失败");history.go(-1);</script>');
        }
    }
    /**
     * 查看回复
     * by Yanni
     */
    public function actionReply(){
        $gossipId  = Yii::$app->request->get('id','1');    //八卦ID
        $model = new Reply();
        $data = $model->find()->asArray()->where('gossipId='.$gossipId)->all();
        return $this->render('reply',['data'=>$data]);
    }
    public function actionReplyDelete(){
        $reolyId = Yii::$app->request->get('id');
        $model = new Reply();
        $re = $model->findOne($reolyId)->delete();
        if($re){
            die( '<script>alert("删除成功");history.go(-1);</script>');
        } else {
            die( '<script>alert("失败，请重试");history.go(-1);</script>');
        }
    }
    public function actionDelete(){
        $id = Yii::$app->request->get('id');
        $model = new Gossip();
        $re = $model->findOne($id)->delete();
        if($re){
            $data = Reply::findOne('gossipId='.$id); //检查是否存在回复
            if($data){
                $res = Reply::deleteAll('gossipId='.$id);
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

}