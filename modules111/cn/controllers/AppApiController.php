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
use app\modules\cn\models\Live;
use app\modules\cn\models\LiveActivity;
use app\modules\cn\models\LiveLike;
use app\modules\cn\models\LiveLook;
use app\modules\cn\models\LiveReply;
use app\modules\cn\models\LiveUser;
use app\modules\cn\models\Look;
use app\modules\cn\models\Reply;
use app\modules\cn\models\ReplyLike;
use app\modules\cn\models\User;
use app\modules\cn\models\Post;
use app\modules\content\models\PostReply;
use yii;
use app\libs\ToeflApiControl;
use app\libs\VerificationCode;
use app\libs\Sms;
use UploadFile;



class AppApiController extends ToeflApiControl
{
    function init (){
        parent::init();
        include_once($_SERVER['DOCUMENT_ROOT'].'/../libs/ucenter/ucenter.php');
    }
    public $enableCsrfValidation = false;

    /**
     * 总调度
     * @Obelisk
     */
    public function actionUnifyLogin(){
        $session = Yii::$app->session;
        $model = new User();
        $uid = Yii::$app->request->get('uid');
        $username = Yii::$app->request->get('username');
        $nickname = Yii::$app->request->get('nickname');
        $phone = Yii::$app->request->get('phone');
        $email =Yii::$app->request->get('email');
        $loginsdata = $model->find()->where("uid = $uid")->one();
        if (empty($loginsdata['uid'])) {
            $login = clone $model;
            $login->phone = $phone;

            $login->email = $email;

            $login->createTime = time();

            $login->username = $username;

            $login->nickname = $nickname;

            $login->uid = $uid;

            $login->roleId = 4;
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
            if($nickname != $loginsdata['nickname']){
                User::updateAll(['nickname' => "$nickname"],"uid=$uid");
            }
            if($loginsdata['roleId'] == ''){
                User::updateAll(['roleId' => 4],"uid=$uid");
            }
        }
        $session->set('uid', $uid);
    }

    /**
     * 添加八卦
     * @Obelisk
     */

    public function actionAddGossip(){
        $session = Yii::$app->session;
        $uid = $session->get('uid');
        if(!$uid){
            die(json_encode(['code' => 0,'message' =>'未登录']));
        }
        $title = Yii::$app->request->post('title');//标题
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
        $publisher = $publisher->nickname?$publisher->nickname:$publisher->username;
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
            Jpush::androidPush(1,'发帖成功','发帖','','','',$belong);
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
     * 添加直播
     * @Obelisk
     */

    public function actionAddLive(){
        $session = Yii::$app->session;
        $uid = $session->get('uid');
        $activityId = $session->get('liveActivityId');
        if(!$uid){
            die(json_encode(['code' => 0,'message' =>'未登录']));
        }
        $title = Yii::$app->request->post('title');//标题
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
        $publisher = $publisher->nickname?$publisher->nickname:$publisher->username;
        $time = time();
        $model = new Live();
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
        $model->activityId = $activityId;
        $re = $model->save();
        if($re){
            Jpush::push(1,'发帖成功','发帖','','','',$belong);
            Jpush::androidPush(1,'发帖成功','发帖','','','',$belong);
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
        $session = Yii::$app->session;
        $uid = $session->get('uid');
        $page = Yii::$app->request->post('page',1);//页数
        $pageSize = Yii::$app->request->post('pageSize',10);//每页数
        $belong = Yii::$app->request->post('belong',1);//帖子来源
        $model = new Gossip();
        $data = $model->getAllGossip($page,$pageSize,$uid,$belong);
        if($uid){
            $num = Look::find()->where("receiverId = $uid")->count();
            $integral = uc_user_integral1($uid);
            $integral = $integral['integral'];
        }else{
            $num = 0;
            $integral = 0;
        }
        $time = time();
        $startTime = $time+1800;
        $switch  = 0;
        if($switch == 0){
            $live = 0;
            $isPay = 0;
            $sign = null;
        }else{
            $sign = LiveActivity::find()->asArray()->where("startTime<=$startTime AND endTime>=$time")->orderBy("id DESC")->one();//是否有直播
            if($sign){
                if(!$uid) {
                    $uid = 0;
                }
                $isPay = LiveUser::find()->where("uid=$uid AND liveActivityId={$sign['id']}")->one();
                if($isPay){
                    $isPay = 1;
                }else{
                    $isPay = 0;
                }
                $live = 2;
                Yii::$app->session->set('liveActivityId',$sign['id']);
            }else{
                $sign = LiveActivity::find()->asArray()->where("psvTime<=$time AND startTime>$startTime")->orderBy("id DESC")->one();//是否有宣传
                if($sign){
                    $live = 1;
                    $isPay = 0;
                }else{
                    $sign = LiveActivity::find()->asArray()->orderBy("id DESC")->one();//是否有回放
                    if($sign){
                        $live = 3;
                        if(!$uid) {
                            $uid = 0;
                        }
                        $isPay = LiveUser::find()->where("uid=$uid AND liveActivityId={$sign['id']}")->one();
                        if($isPay){
                            $isPay = 1;
                        }else{
                            $isPay = 0;
                        }
                        Yii::$app->session->set('liveActivityId',$sign['id']);
                    }else{
                        $live = 0;
                        $isPay = 0;
                    }
                }

//            $sign = [];
            }
        }
        die(json_encode(['data' => $data,'num' => $num,'live' => $live,'isPay' => $isPay,'integral' => $integral,'signLive' => $sign,'needNum' => 10000,'QQ' => 1843106032]));
    }

    /**
     * 去支付
     * @Obelisk
     */
    public function actionToPay(){
        $session = Yii::$app->session;
        $uid = $session->get('uid');
        $liveActivityId = Yii::$app->session->get('liveActivityId');
        if($liveActivityId){
            $integral = uc_user_integral1($uid);
            $integral = $integral['integral'];
            if($integral>=10000){
                uc_user_edit_integral1($uid,'参加雷哥直播',2,10000);
                $model = new LiveUser();
                $model->uid = $uid;
                $model->liveActivityId = $liveActivityId;
                $model->save();
                die(json_encode(['code' => 1,'message' => '支付雷豆成功']));
            }else{
                die(json_encode(['code' => 2,'message' => '雷豆不足请充值']));
            }
        }else{
            die(json_encode(['code' => 0,'message' => '现在没有直播']));
        }
    }

    /**
     *直播列表
     * @Obelisk
     */
    public function actionLiveList(){
        $session = Yii::$app->session;
        $uid = $session->get('uid');
        $activityId = $session->get('liveActivityId');
        $page = Yii::$app->request->post('page');//页数
        $pageSize = Yii::$app->request->post('pageSize');//每页数
        $belong = Yii::$app->request->post('belong',1);//直播来源
        $model = new Live();
        $data = $model->getAllLive($page,$pageSize,$uid,$belong,$activityId);
        $userNumber = LiveUser::find()->where("liveActivityId = $activityId")->count();
        if($uid){
            $num = LiveLook::find()->where("receiverId = $uid")->count();
            $integral = uc_user_integral1($uid);
            $integral = $integral['integral'];
        }else{
            $num = 0;
            $integral = 0;
        }
        die(json_encode(['data' => $data,'num' => $num,'integral' => $integral,'userNumber' => $userNumber]));
    }

    /**
     * 帖子列表
     * by obelisk
     */
    public function actionPostList(){
        $selectId = Yii::$app->request->post('selectId',1);//页数
        $page = Yii::$app->request->post('page',1);//页数
        $pageSize = Yii::$app->request->post('pageSize',10);//每页数
        $model = new Post();
        $data = $model->getAllTestPost($page,$pageSize,$selectId);
        die(json_encode($data));
    }

    /**
     * 帖子列表
     * by obelisk
     */
    public function actionPostTestList(){
        $selectId = Yii::$app->request->post('selectId',1);//页数
        $page = Yii::$app->request->post('page',1);//页数
        $pageSize = Yii::$app->request->post('pageSize',10);//每页数
        $model = new Post();
        $data = $model->getAllTestPost($page,$pageSize,$selectId);
        die(json_encode($data));
    }

    /**
     *回复列表
     * @Obelisk
     */
    public function actionReplyList(){
        $uid = Yii::$app->request->get('uid');
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
     *直播回复列表
     * @Obelisk
     */
    public function actionLiveReplyList(){
        $uid = Yii::$app->request->get('uid');
        if(!$uid){
            die(json_encode(['code' => 0,'message' =>'未登录']));
        }
        $data = LiveLook::find()->asArray()->where("receiverId = $uid")->all();
        foreach($data as $k=>$v){
            $data[$k]['content'] = base64_decode($v['content']) ;
            $data[$k]['liveContent'] = base64_decode($v['liveContent']) ;
        }
        LiveLook::deleteAll("receiverId = $uid");
        die(json_encode($data));
    }

    /**
     * 回复
     * @Obelisk
     */
    public function actionReply(){
        $session = Yii::$app->session;
        $uid = $session->get('uid');//回复人uid
        $content = Yii::$app->request->post('content');//回复内容
        $type = Yii::$app->request->post('type');//回复类型
        $id = Yii::$app->request->post('id');//帖子Id
        $gossipUser = Yii::$app->request->post('gossipUser');//帖子拥有者
        $replyUser = Yii::$app->request->post('replyUser');//被回复者Id
        $belong = Yii::$app->request->post('belong',1);//回复来源
        $userImage = Yii::$app->request->post('userImage');//回复人头像
        $uName = User::findOne($uid);//回复人昵称
        $uName = $uName->nickname?$uName->nickname:$uName->username;//回复人昵称
        $time = time();
        if($type == 1){
            $replyUser = '';
            $replyUserName = '';
        }else{
            $replyUserName = User::findOne($replyUser);
            $replyUserName = $replyUserName->nickname?$replyUserName->nickname:$replyUserName->username;
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
                    Jpush::androidPush(2,'您有新的回复','回复成功',$audience,$num,'',$belong);
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
                    Jpush::androidPush(2,'您有新的回复','回复成功','lgw'.$gossipUser,$num,'',$belong);
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
                    Jpush::androidPush(2,'您有新的回复','回复成功','lgw'.$replyUser,$num,'',$belong);
                }
            }
            $re = [
                'code' => 1,
                'message' => '回复成功',
            ];
        }else{
            $re = [
                'code' => 1,
                'message' => '回复失败',
            ];
        }
        die(json_encode($re));
    }

    /**
     * 直播回复
     * @Obelisk
     */
    public function actionLiveReply(){
        $session = Yii::$app->session;
        $uid = $session->get('uid');//回复人uid
        $content = Yii::$app->request->post('content');//回复内容
        $type = Yii::$app->request->post('type');//回复类型
        $id = Yii::$app->request->post('id');//帖子Id
        $liveUser = Yii::$app->request->post('liveUser');//直播问题拥有者
        $replyUser = Yii::$app->request->post('replyUser');//被回复者Id
        $belong = Yii::$app->request->post('belong',1);//回复来源
        $userImage = Yii::$app->request->post('userImage');//回复人头像
        $pid = Yii::$app->request->post('pid',0);//回复评论ID
        $uName = User::findOne($uid);//回复人昵称
        $uName = $uName->nickname?$uName->nickname:$uName->username;//回复人昵称
        $time = time();
        if($type == 1){
            $replyUser = '';
            $replyUserName = '';
        }else{
            $replyUserName = User::findOne($replyUser);
            $replyUserName = $replyUserName->nickname?$replyUserName->nickname:$replyUserName->username;
        }
        if(!$uid){
            die(json_encode(['code' => 0,'message' =>'未登录']));
        }
        $model = new LiveReply();
        $model->content = base64_encode($content);
        $model->replyUser = $replyUser;
        $model->createTime = $time;
        $model->type = $type;
        $model->liveId = $id;
        $model->userImage = $userImage;
        $model->uid = $uid;
        $model->uName = $uName;
        $model->pid = $pid;
        $model->replyUserName = $replyUserName;
        $re = $model->save();
        $replyId = $model->primaryKey;
        $live = Live::findOne($id);
        if($re){
            if($type == 1){
                $audience = 'lgw'.$liveUser;
                if($liveUser != $uid){
                    $model = new LiveLook();
                    $model->content = base64_encode($content);;
                    $model->createTime = $time;
                    $model->uid = $uid;
                    $model->receiverId = $liveUser;
                    $model->userName = $uName;
                    $model->userImage = $userImage;
                    $model->liveContent = $live->content;
                    $model->liveId = $id;
                    $model->save();
                    $num = LiveLook::find()->where("receiverId = $liveUser")->count();
                    Jpush::push(2,'您有新的回复','回复成功',$audience,$num,'',$belong,2);
                    Jpush::androidPush(2,'您有新的回复','回复成功',$audience,$num,'',$belong,2);
                }
            }else{
//                $audience = ['lgw'.$gossipUser,'lgw'.$replyUser];
                if($liveUser != $uid){
                    $model = new LiveLook();
                    $model->content = base64_encode($content);
                    $model->createTime = $time;
                    $model->uid = $uid;
                    $model->receiverId = $liveUser;
                    $model->userName = $uName;
                    $model->userImage = $userImage;
                    $model->liveContent = $live->content;
                    $model->liveId = $id;
                    $model->save();
                    $num = LiveLook::find()->where("receiverId = $liveUser")->count();
                    Jpush::push(2,'您有新的回复','回复成功','lgw'.$liveUser,$num,'',$belong,2);
                    Jpush::androidPush(2,'您有新的回复','回复成功','lgw'.$liveUser,$num,'',$belong,2);
                }
                if($replyUser != $uid && $replyUser !=$liveUser){
                    $model = new LiveLook();
                    $model->content = base64_encode($content);;
                    $model->createTime = $time;
                    $model->uid = $uid;
                    $model->receiverId = $replyUser;
                    $model->userName = $uName;
                    $model->userImage = $userImage;
                    $model->liveContent = $live->content;
                    $model->liveId = $id;
                    $model->save();
                    $num = LiveLook::find()->where("receiverId = $replyUser")->count();
                    Jpush::push(2,'您有新的回复','回复成功','lgw'.$replyUser,$num,'',$belong,2);
                    Jpush::androidPush(2,'您有新的回复','回复成功','lgw'.$replyUser,$num,'',$belong,2);
                }
            }
            $reply = LiveReply::find()->asArray()->where("id=$replyId")->one();
            $reply['content'] = base64_decode($reply['content']);
            $re = [
                'code' => 1,
                'message' => '回复成功',
                'data' => $reply
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
     * 添加回复
     * by  yanni
     */
    public function actionPostReply(){
        $session = Yii::$app->session;
        $uid = $session->get('uid');
        if (!$uid) {
            die(json_encode(['code' => 0, 'message' => '未登录']));
        }
        $postId = Yii::$app->request->post('postId');// 帖子Id
        $content = Yii::$app->request->post('content');//内容
        if($postId && $content ){
            $model = new PostReply();
            $model->uid = $uid;
            $model->content = $content;
            $model->createTime = time();
            $model->pid = 0;
            $model->postId = $postId;
            $re = $model->save();
            Post::updateAll(array('lastReplayTime'=>time()),'id='.$postId);
            if($re>0){
                die(json_encode(['code' => 1, 'message' => '回复成功']));
            } else {
                die(json_encode(['code' => 0, 'message' => '回复失败请重试']));
            }
        } else {

            die(json_encode(['code' => 0, 'message' => '内容不能为空']));
        }
    }

    /**
     * 添加帖子
     * by  yanni
     */

    public function actionAddPost()
    {
        $session = Yii::$app->session;
        $uid = $session->get('uid');
        if (!$uid) {
            die(json_encode(['code' => 0, 'message' => '未登录']));
        }
        $title = Yii::$app->request->post('title');//标题
        if(!$title){
            die(json_encode(['code' => 0,'message' => '请添加标题']));
        }
        $content = Yii::$app->request->post('content');//内容
        if(!$content){
            die(json_encode(['code' => 0,'message' => '请添加内容']));
        }
        $catId = Yii::$app->request->post('catId',1);//分类
        $radio = [];
        $datum = [];
        $radioTitle = [];
        $datumTitle = [];
        $imageContent = [];
        $sign1 = Method::sensitiveWords($content);
        $sign2 = Method::sensitiveWords($title);
        if ($sign1['code'] == 0 || $sign2['code' == 0]) {
            die(json_encode(['code' => 0, 'message' => '请勿输入敏感词汇:' . $sign1['info'] . '-' . $sign2['info']]));
        }
        if($title && $content){
            $model = new Post();
            $model->title = $title;
            $model->content = $content;
            $model->cnContent = $content;
            $model->imageContent = serialize($imageContent);
            $model->datum = serialize($datum);
            $model->datumTitle = serialize($datumTitle);
            $model->radio = serialize($radio);
            $model->radioTitle = serialize($radioTitle);
            $model->createTime = time();
            $model->dateTime = date("Y-m-d");
            $model->hot = 0;
            $model->catId = $catId;
            $model->viewCount = 0;
            $model->uid = $uid;
            $model->lastReplayTime = time();
            $re = $model->save();
            if($re>0){
                die(json_encode(['code' => 1, 'message' => '发表成功']));
            } else {
                die(json_encode(['code' => 0, 'message' => '发表失败请重试']));
            }
        } else {
            die(json_encode(['code' => 0, 'message' => '标题和内容不能为空']));
        }
    }
    /**
     * 帖子详情
     * @Obelisk
     */
    public function actionPostDetails(){
        $session = Yii::$app->session;
        $uid = $session->get('uid');
        $postId = Yii::$app->request->post('postId',15);//帖子ID
        $model = new Post();
        $post = $model->getPostDetail($postId);
        $count = $post['viewCount'];
        $model->updateAll(['viewCount' => ($count+1)],"id=$postId");
        die(json_encode($post));
    }
    /**
     * 八卦详情
     * @Obelisk
     */
    public function actionGossipDetails(){
        $session = Yii::$app->session;
        $uid = $session->get('uid');
        $gossipId = Yii::$app->request->post('gossipId');//帖子ID
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

    /**
     * 直播详情
     * @Obelisk
     */
    public function actionLiveDetails(){
        $session = Yii::$app->session;
        $uid = $session->get('uid');
        $liveId = Yii::$app->request->post('liveId');//帖子ID
        $live = Live::find()->asArray()->where("id=$liveId")->one();
        if($uid){
            $sign = LiveLike::find()->where("liveId=$liveId AND uid=$uid")->one();
            if($sign){
                $live['likeId'] = true;
            }else{
                $live['likeId'] = false;
            }
            $integral = uc_user_integral1($uid);
            $integral = $integral['integral'];
        }else{
            $live['likeId'] = false;
            $integral = 0;
        }
        $reply = LiveReply::find()->asArray()->where("liveId=$liveId AND pid=0")->all();
        foreach($reply as $k => $v){
            $reply[$k]['content'] = base64_decode($v['content']);
            $asked = LiveReply::find()->asArray()->where("liveId=$liveId AND pid={$v['id']}")->all();
            foreach($asked as $key =>$val){
                $asked[$key]['content'] = base64_decode($val['content']);
            }
            $reply[$k]['asked'] = $asked;
            $reply[$k]['likeNum'] = ReplyLike::find()->where("replyId={$v['id']} AND replyType=2")->count();
            if(!$uid){
                $reply[$k]['likeSign'] = 0;
            }else{
                $sign = ReplyLike::find()->where("replyId={$v['id']} AND replyType=2 AND uid=$uid")->one();
                if($sign){
                    $reply[$k]['likeSign'] = 1;
                }else{
                    $reply[$k]['likeSign'] = 0;
                }
            }
        }
        $live['reply'] = $reply;
        $live['image'] = json_decode($live['image'],'true');
        $live['title'] = base64_decode($live['title']);
        $live['content'] = base64_decode($live['content']);
        $live['video'] = json_decode($live['video'],'true');
        $live['audio'] = json_decode($live['audio'],'true');
        $likeNum = LiveLike::find()->where("liveId=$liveId")->count();
        $live['likeNum'] = $likeNum;
        $live['integral'] = $integral;
        die(json_encode($live));
    }

    /**
     * 点赞
     * @Obelisk
     */
    public function actionAddLike(){
        $gossipId = Yii::$app->request->post('gossipId');//帖子ID
        $belong = Yii::$app->request->post('belong',1);//帖子来源
        $session = Yii::$app->session;
        $uid = $session->get('uid');
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
                Jpush::androidPush(2,'有人给你点赞','点赞成功','lgw'.$gossip->uid,0,2,$belong);
            }
        }
        $likeNum = Like::find()->where("gossipId=$gossipId")->count();
        $re['likeNum'] = $likeNum;
        die(json_encode($re));
    }

    /**
     * 评论点赞
     * @Obelisk
     */
    public function actionAddReplyLike(){
        $replyId = Yii::$app->request->post('replyId');//回复ID
        $replyType = Yii::$app->request->post('replyType',1);//回复ID
        $belong = Yii::$app->request->post('belong',1);//回复来源
        $session = Yii::$app->session;
        $uid = $session->get('uid');
        if(!$uid){
            die(json_encode(['code' => 0,'message' =>'未登录']));
        }
        $model = new ReplyLike();
        $sign = $model->find()->where("uid=$uid AND replyId=$replyId")->one();
        if($sign){
            ReplyLike::deleteAll("uid=$uid AND replyId=$replyId");
            $re = [
                'code' => 2,
                'message' => '取消点赞',
            ];
        }else{
            $model->replyId = $replyId;
            $model->replyType = $replyType;
            $model->uid = $uid;
            $model->createTime = time();
            $model->save();
            $re = [
                'code' => 1,
                'message' => '点赞成功',
            ];
            if($replyType == 2){
                $reply = LiveReply::findOne($replyId);
            }else{
                $reply = Reply::findOne($replyId);
            }
            if($reply->uid != $uid){
                Jpush::push(2,'有人给你点赞','点赞成功','lgw'.$reply->uid,0,2,$belong,2);
                Jpush::androidPush(2,'有人给你点赞','点赞成功','lgw'.$reply->uid,0,2,$belong,2);
            }
        }
        die(json_encode($re));
    }

    /**
     * 直播点赞
     * @Obelisk
     */
    public function actionAddLiveLike(){
        $liveId = Yii::$app->request->post('liveId');//帖子ID
        $belong = Yii::$app->request->post('belong',1);//帖子来源
        $session = Yii::$app->session;
        $uid = $session->get('uid');
        if(!$uid){
            die(json_encode(['code' => 0,'message' =>'未登录']));
        }
        $model = new LiveLike();
        $sign = $model->find()->where("uid=$uid AND liveId=$liveId")->one();
        if($sign){
            LiveLike::deleteAll("uid=$uid AND liveId=$liveId");
            $re = [
                'code' => 2,
                'message' => '取消点赞',
            ];
        }else{
            $model->liveId = $liveId;
            $model->uid = $uid;
            $model->createTime = time();
            $model->save();
            $re = [
                'code' => 1,
                'message' => '点赞成功',
            ];
            $live = Live::findOne($liveId);
            if($live->uid != $uid){
                Jpush::push(2,'有人给你点赞','点赞成功','lgw'.$live->uid,0,2,$belong,2);
                Jpush::androidPush(2,'有人给你点赞','点赞成功','lgw'.$live->uid,0,2,$belong,2);
            }
        }
        $likeNum = LiveLike::find()->where("liveId=$liveId")->count();
        $re['likeNum'] = $likeNum;
        die(json_encode($re));
    }

    /**
     * 直播打赏
     * @Obelisk
     */
    public function actionAddReward(){
        $replyId = Yii::$app->request->post('replyId');//评论ID
        $belong = Yii::$app->request->post('belong',1);//帖子来源
        $number = Yii::$app->request->post('number');//雷豆数量
        $session = Yii::$app->session;
        $uid = $session->get('uid');
        if(!$uid){
            die(json_encode(['code' => 0,'message' =>'未登录']));
        }
        $reply = LiveReply::findOne($replyId);
        if(!$reply){
            $re = [
                'code' => 0,
                'message' => '没有此评论',
            ];
        }else{
            if($uid == $reply->uid){
                $re = [
                    'code' => 0,
                    'message' => '自己不能给自己打赏',
                ];
            }else{
                $integral = uc_user_integral1($uid);
                $integral = $integral['integral'];
                if($integral < $number){
                    $re = [
                        'code' => 0,
                        'message' => '雷豆不足',
                    ];
                }else{
                    uc_user_edit_integral1($uid,'打赏雷豆',2,$number);
                    uc_user_edit_integral1($reply->uid,'收到打赏雷豆',1,$number);
                    LiveReply::updateAll(['reward' => $reply->reward+1],"id=$reply->id");
                    Jpush::push(2,'有人给你打赏','打赏成功','lgw'.$reply->uid,0,2,$belong,2);
                    Jpush::androidPush(2,'有人给你打赏','打赏成功','lgw'.$reply->uid,0,2,$belong,2);
                    $re = [
                        'code' => 1,
                        'message' => '打赏成功',
                    ];
                }
            }
        }
        die(json_encode($re));
    }

    /**
     *删除直播
     * @Obelisk
     */
    public function actionDeleteLive(){
        $liveId = Yii::$app->request->get('liveId');
        Live::deleteAll("id=$liveId");
        LiveReply::deleteAll("liveId=$liveId");
        LiveLook::deleteAll("liveId=$liveId");
        LiveLike::deleteAll("liveId=$liveId");
        die(json_encode(['code' => 1,'message' => '删除成功']));
    }

    /**
     *删除八卦
     * @Obelisk
     */
    public function actionDeleteGossip(){
        $gossipId = Yii::$app->request->get('gossipId');
        Gossip::deleteAll("id=$gossipId");
        Reply::deleteAll("gossipId=$gossipId");
        Look::deleteAll("gossipId=$gossipId");
        Like::deleteAll("gossipId=$gossipId");
        die(json_encode(['code' => 1,'message' => '删除成功']));
    }

}