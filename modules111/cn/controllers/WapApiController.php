<?php

/**
 * toefl API
 * Created by PhpStorm.
 * User: obelisk
 */

namespace app\modules\cn\controllers;


use app\libs\Jpush;
use app\libs\Method;
use app\modules\cn\models\Gossip;
use app\modules\cn\models\Like;
use app\modules\cn\models\Look;
use app\modules\cn\models\Reply;
use app\modules\cn\models\User;
use yii;
use app\libs\ToeflApiControl;
use app\libs\VerificationCode;
use app\libs\Sms;
use UploadFile;


header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: X-Requested-With');
header('P3P: CP="CURa ADMa DEVa PSAo PSDo OUR BUS UNI PUR INT DEM STA PRE COM NAV OTC NOI DSP COR"');
class WapApiController extends ToeflApiControl
{
    public $enableCsrfValidation = false;

    /**
     * 总调度
     * @Obelisk
     */
    public function actionUnifyLogin(){
        $model = new User();
        $uid = Yii::$app->request->get('uid');
        $username = Yii::$app->request->get('username');
        $phone = Yii::$app->request->get('phone');
        $email =Yii::$app->request->get('email');
        $loginsdata = $model->find()->where("uid = $uid")->one();
        if (empty($loginsdata['uid'])) {
            $login = clone $model;
            $login->phone = $phone;

            $login->email = $email;

            $login->createTime = time();

            $login->username = $username;

            $login->roleId = 4;

            $login->uid = $uid;
            $login->save();
        }else{
            if($phone != $loginsdata['phone']){
                User::updateAll(['phone' => $phone],"uid=$uid");
            }
            if($email != $loginsdata['email']){
                User::updateAll(['email' => "$email"],"uid=$uid");
            }
            if($username != $loginsdata['username']){
                User::updateAll(['username' => "$username"],"uid=$uid");
            }
            if($loginsdata['roleId'] == ''){
                User::updateAll(['roleId' => 4],"uid=$uid");
            }
        }
    }

    /**
     * 添加八卦
     * @Obelisk
     */

    public function actionAddGossip(){
        $input = json_decode(file_get_contents('php://input'),true);
        $uid = Yii::$app->request->post('uid');
        if(!$uid){
            die(json_encode(['code' => 0,'message' =>'未登录']));
        }
        $title = Yii::$app->request->post('title');//
        if(!$title){
            die(json_encode(['code' => 0,'message' => '请添加标题']));
        }
        $content = Yii::$app->request->post('content');//内容
        if(!$content){
            die(json_encode(['code' => 0,'message' => '请添加内容']));
        }
        $image = Yii::$app->request->post('image');//图片数组
        $video =Yii::$app->request->post('video');//视频数组
        $audio =Yii::$app->request->post('audio');//音频数组
        $belong = Yii::$app->request->post('belong',1);//帖子来源
        $icon = Yii::$app->request->post('icon');//发布人头像
        $publisher = User::findOne($uid);
        $publisher = $publisher->username;
        $time = time();
        $model = new Gossip();
        $model->title = base64_encode($title);
        $model->content = base64_encode($content);
        $model->image = json_encode($image);
        $model->video = json_encode($video);
        $model->audio = json_encode($audio);
        $model->createTime = $time;
        $model->uid = $uid;
        $model->icon = $icon;
        $model->publisher = $publisher;
        $model->belong = $belong;
        $re = $model->save();
        if($re){
            Jpush::push(1,'发帖成功','发帖','','','',$belong);
            $re = [
                'code' => 1,
                'message' => '发帖成功',
            ];
            die(json_encode($re));
        }else{
            $re = [
                'code' => 0,
                'message' => '发帖失败',
            ];
            die(json_encode($re));
        }
    }

    /**
     * 上传图片
     * @Obelisk
     */

    public function actionAppImage()
    {
        $file = $_FILES['upload'];

        $upload = new UploadFile();

        $upload->int_max_size = 3145728;

        $upload->arr_allow_exts = array('jpg', 'gif', 'png', 'jpeg');

        $upload->str_save_path = Yii::$app->params['upImage'];

        $arr_rs = $upload->upload($file);

        if ($arr_rs['int_code'] == 1) {
            $filePath = '/' . Yii::$app->params['upImage'] . $arr_rs['arr_data']['arr_data'][0]['savename'];
                $res['code'] = 1;

                $res['message'] = '上传成功';

                $res['image'] = $filePath;

        } else {

            $res['code'] = 0;

            $res['message'] = '上传失败，请重试';

        }

        die(json_encode($res));
    }

    /**
     *八卦列表
     * @Obelisk
     */
    public function actionGossipList(){
        $input = json_decode(file_get_contents('php://input'),true);
        $uid = $input['uid'];
        $page = $input['page'];//页数
        $pageSize = $input['pageSize'];//每页数
        $belong = $input['belong'];
        if(!$belong){
            $belong = 1;
        }
        $model = new Gossip();
        $data = $model->getAllGossip($page,$pageSize,$uid,$belong);
        if($uid){
            $num = Look::find()->where("receiverId = $uid")->count();
        }else{
            $num = 0;
        }
        die(json_encode(['data' => $data,'num' => $num]));
    }

    /**
     *回复列表
     * @Obelisk
     */
    public function actionReplyList(){
        $input = json_decode(file_get_contents('php://input'),true);
        $uid = $input['uid'];
        if(!$uid){
            die(json_encode(['code' => 0,'message' =>'未登录']));
        }
        $data = Look::find()->asArray()->where("receiverId = $uid")->all();
        foreach($data as $k=>$v){
           $data[$k]['content'] = base64_decode($v['content']) ;
           $data[$k]['gossipContent'] = base64_decode($v['gossipContent']) ;
        }
        Look::deleteAll("receiverId = $uid");
        die(json_encode($data));
    }

    /**
     * 回复
     * @Obelisk
     */
    public function actionReply(){
        $uid = Yii::$app->request->post('uid');
        $content = Yii::$app->request->post('content');//回复内容
        $type = Yii::$app->request->post('type');//回复类型
        $id = Yii::$app->request->post('id');//帖子Id
        $gossipUser = Yii::$app->request->post('gossipUser');//帖子拥有者
        $replyUser = Yii::$app->request->post('replyUser');//被回复者Id
        $userImage = Yii::$app->request->post('userImage');//回复人头像
        $belong = Yii::$app->request->post('belong',1);//帖子来源
        $uName = User::findOne($uid);//回复人昵称
        $uName = $uName->username;//回复人昵称
        $time = time();
        if($type == 1){
            $replyUser = '';
            $replyUserName = '';
        }else{
            $replyUserName = User::findOne($replyUser);
            $replyUserName = $replyUserName->username;
        }
        if(!$uid){
            die(json_encode(['code' => 0,'message' =>'未登录']));
        }
        $model = new Reply();
        $model->content = base64_encode($content);
        $model->replyUser = $replyUser;
        $model->createTime = $time;
        $model->type = $type;
        $model->gossipId = $id;
        $model->userImage = $userImage;
        $model->uid = $uid;
        $model->uName = $uName;
        $model->replyUserName = $replyUserName;
        $re = $model->save();
        $gossip = Gossip::findOne($id);
        if($re){
            if($type == 1){
                $audience = 'lgw'.$gossipUser;
                if($gossipUser != $uid){
                    $model = new Look();
                    $model->content = base64_encode($content);;
                    $model->createTime = $time;
                    $model->uid = $uid;
                    $model->receiverId = $gossipUser;
                    $model->userName = $uName;
                    $model->userImage = $userImage;
                    $model->gossipContent = $gossip->content;
                    $model->gossipId = $id;
                    $model->save();
                    $num = Look::find()->where("receiverId = $gossipUser")->count();
                    Jpush::push(2,'您有新的回复','回复成功',$audience,$num,'',$belong);
                }
            }else{
//                $audience = ['lgw'.$gossipUser,'lgw'.$replyUser];
                if($gossipUser != $uid){
                    $model = new Look();
                    $model->content = base64_encode($content);
                    $model->createTime = $time;
                    $model->uid = $uid;
                    $model->receiverId = $gossipUser;
                    $model->userName = $uName;
                    $model->userImage = $userImage;
                    $model->gossipContent = $gossip->content;
                    $model->gossipId = $id;
                    $model->save();
                    $num = Look::find()->where("receiverId = $gossipUser")->count();
                    Jpush::push(2,'您有新的回复','回复成功','lgw'.$gossipUser,$num,'',$belong);
                }
                if($replyUser != $uid && $replyUser !=$gossipUser){
                    $model = new Look();
                    $model->content = base64_encode($content);;
                    $model->createTime = $time;
                    $model->uid = $uid;
                    $model->receiverId = $replyUser;
                    $model->userName = $uName;
                    $model->userImage = $userImage;
                    $model->gossipContent = $gossip->content;
                    $model->gossipId = $id;
                    $model->save();
                    $num = Look::find()->where("receiverId = $replyUser")->count();
                    Jpush::push(2,'您有新的回复','回复成功','lgw'.$replyUser,$num,'',$belong);
                }
            }
            $re = [
                'code' => 1,
                'message' => '回复成功',
            ];
        }else{
            $re = [
                'code' => 0,
                'message' => '回复失败',
            ];
        }
        die(json_encode($re));
    }

    /**
     * 帖子详情
     * @Obelisk
     */
    public function actionGossipDetails(){
        $input = json_decode(file_get_contents('php://input'),true);
        $uid = $input['uid'];
        $gossipId = $input['gossipId'];//帖子ID
        $gossip = Gossip::find()->asArray()->where("id=$gossipId")->one();
        if($uid){
            $sign = Like::find()->where("gossipId=$gossipId AND uid=$uid")->one();
            if($sign){
                $gossip['likeId'] = true;
            }else{
                $gossip['likeId'] = false;
            }
        }else{
            $gossip['likeId'] = false;
        }
        $reply = Reply::find()->asArray()->where("gossipId=$gossipId")->all();
        foreach($reply as $k => $v){
            $reply[$k]['content'] = base64_decode($v['content']);
        }
        $gossip['reply'] = $reply;
        $gossip['image'] = json_decode($gossip['image'],'true');
        $gossip['title'] = base64_decode($gossip['title']);
        $gossip['content'] = base64_decode($gossip['content']);
        $gossip['video'] = json_decode($gossip['video'],'true');
        $gossip['audio'] = json_decode($gossip['audio'],'true');
        $likeNum = Like::find()->where("gossipId=$gossipId")->count();
        $gossip['likeNum'] = $likeNum;
        die(json_encode($gossip));
    }

    public function actionAddLike(){
        $gossipId = Yii::$app->request->post('gossipId');//帖子ID
        $belong = Yii::$app->request->post('belong',1);//帖子来源
        $uid = Yii::$app->request->post('uid');
        if(!$uid){
            die(json_encode(['code' => 0,'message' =>'未登录']));
        }
        $model = new Like();
        $sign = $model->find()->where("uid=$uid AND gossipId=$gossipId")->one();
        if($sign){
            Like::deleteAll("uid=$uid AND gossipId=$gossipId");
            $re = [
                'code' => 2,
                'message' => '取消点赞',
            ];
        }else{
            $model->gossipId = $gossipId;
            $model->uid = $uid;
            $model->createTime = time();
            $model->save();
            $re = [
                'code' => 1,
                'message' => '点赞成功',
            ];
            $gossip = Gossip::findOne($gossipId);
            if($gossip->uid != $uid){
                Jpush::push(2,'有人给你点赞','点赞成功','lgw'.$gossip->uid,0,2,$belong);
            }
        }
        $likeNum = Like::find()->where("gossipId=$gossipId")->count();
        $re['likeNum'] = $likeNum;
        die(json_encode($re));

    }

}