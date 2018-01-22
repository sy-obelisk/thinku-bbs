<?php

/**
 * toefl API
 * Created by PhpStorm.
 * User: obelisk
 */

namespace app\modules\cn\controllers;


use app\libs\Jpush;
use app\libs\Method;
use app\modules\cn\models\Answer;
use app\modules\cn\models\Category;
use app\modules\cn\models\Gossip;
use app\modules\cn\models\UserCategory;
use app\modules\cn\models\Look;
use app\modules\cn\models\Post;
use app\modules\cn\models\PostReply;
use app\modules\cn\models\Question;
use app\modules\cn\models\Reply;
use app\modules\cn\models\Topic;
use app\modules\cn\models\TopicQuestion;
use app\modules\cn\models\AnswerReply;
use app\modules\cn\models\User;
use yii;

use app\libs\ToeflApiControl;

use app\libs\VerificationCode;

class ApiController extends ToeflApiControl
{
    function init (){
        parent::init();
        include_once($_SERVER['DOCUMENT_ROOT'].'/../libs/ucenter/ucenter.php');
    }
    public $enableCsrfValidation = false;
    /**
     * 帖子,八卦加载更多接口
     * by  yanni
     */
    public function actionLoadPost(){
        $userId = Yii::$app->session->get('uid');
        $type = Yii::$app->request->get('type',1);
        $page = Yii::$app->request->get('page',1);
        if($type==1){
            $model = new Post();
            $data = $model->getUserPost($userId,$page,6);
            if($data){
                $res = [
                    'code' => 1,
                    'message' => '获取帖子成功',
                    'data' =>$data,
                ];
            } else {
                $res = [
                    'code' => 0,
                    'message' => '帖子失败',
                ];
            }
        } else{
            $model = new Gossip();
            $data = $model->getUserGossip($userId,$page,6);
            if($data){
                $res = [
                    'code' => 1,
                    'message' => '获取八卦成功',
                    'data' =>$data,
                ];
            } else {
                $res = [
                    'code' => 0,
                    'message' => '八卦失败',
                ];
            }
        }
        die(json_encode($res));
    }
    /**
     * 总调度
     * @Obelisk
     */
    public function actionUnifyLogin(){
        $session = Yii::$app->session;
        $model = new User();
        $uid = Yii::$app->request->get('uid');
        $username = Yii::$app->request->get('username');
        $phone = Yii::$app->request->get('phone');
        $email =Yii::$app->request->get('email');
        $password =Yii::$app->request->get('password');
        $loginsdata = $model->find()->where("uid = $uid")->one();
        if (empty($loginsdata['uid'])) {
            $login = clone $model;
            $login->phone = $phone;

            $login->email = $email;

            $login->createTime = time();

            $login->username = $username;

            $login->password = md5($password);

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
            if(md5($password) != $loginsdata['password']){
                $password = md5($password);
                User::updateAll(['password' => "$password"],"uid=$uid");
            }
        }
        $session->set('uid', $uid);
        $data = User::find()->asArray()->where("uid=$uid")->one();
        $session->set('userData', $data);
    }

    /**
     * 回复
     * @Obelisk
     */
    public function actionReply(){
        $session = Yii::$app->session;
        $uid = $session->get('uid');
        if(!$uid){
            die(json_encode(['code' => 0,'message' =>'未登录']));
        }
        $user = User::findOne($uid);
        $content = Yii::$app->request->post('content');//回复内容
        $type = Yii::$app->request->post('type');//回复类型
        $id = Yii::$app->request->post('id');
        if($type == 2){
            $signReply = Reply::findOne($id);
            $id = $signReply->gossipId;
            $signGossip = Gossip::findOne($id);
            $gossipUser = $signGossip->uid;
            $replyUser = $signReply->uid;
            $belong = $signGossip->belong;
            $userImage = $user->image?$user->image:'';
            $uName = $user->nickname?$user->nickname:$user->username;
            $replyUserName = $signReply->uName;
        }else{
            $signGossip = Gossip::findOne($id);
            $gossipUser = $signGossip->uid;
            $replyUser = 0;
            $belong = $signGossip->belong;
            $userImage = $user->image?$user->image:'';
            $uName = $user->nickname?$user->nickname:$user->username;
            $replyUserName = '';
        }
        $time = time();
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
//                    Jpush::push(2,'您有新的回复','回复成功',$audience,$num,'',$belong);
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
//                    Jpush::push(2,'您有新的回复','回复成功','lgw'.$gossipUser,$num,'',$belong);
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
//                    Jpush::push(2,'您有新的回复','回复成功','lgw'.$replyUser,$num,'',$belong);
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
     * 帖子回复
     * @Obelisk
     */
    public function actionPostReply(){
        $session = Yii::$app->session;
        $uid = $session->get('uid');
        if(!$uid){
            die(json_encode(['code' => 0,'message' =>'未登录']));
        }
        $content = Yii::$app->request->post('content');//回复内容
        $type = Yii::$app->request->post('type');//回复类型
        $id = Yii::$app->request->post('id');
        if($type == 2){
            $signReply = PostReply::findOne($id);
            $pid = $id;
            $postId = $signReply->postId;
        }else{
            $postId = $id;
            $pid = 0;
        }
        $model = new PostReply();
        $model->content = $content;
        $model->createTime = time();
        $model->uid = $uid;
        $model->pid = $pid;
        $model->postId = $postId;
        $re = $model->save();
        Post::updateAll(array('lastReplayTime'=>time()),'id='.$postId);
        if($re){
            die(json_encode(['code' => 1,'message' => '发表成功']));
        }else{
            die(json_encode(['code' => 0,'message' => '发表失败，请稍后在试']));
        }
    }

    /**
     * 改变分类
     * @Obelisk
     */
    public function actionChangeCat(){
        $model = new Category();
        $id = Yii::$app->request->post('id');
        $category = $model->getAllCatArr($id);
        die(json_encode($category));
    }

    public function actionAddPost(){
        $uid = Yii::$app->session->get('uid');
        $userData = Yii::$app->session->get('userData');
        if(!$uid){
            die(json_encode(['code' => 0,'message' =>'未登录']));
        }
        $username = $userData['nickname']?$userData['nickname']:$userData['username'];
        $title = Yii::$app->request->post('title');
        if(!$title){
            die(json_encode(['code' => 0,'message' => '请添加标题']));
        }
        $catId = Yii::$app->request->post('catId');
        $content = Yii::$app->request->post('content');
        if(!$content){
            die(json_encode(['code' => 0,'message' => '请添加内容']));
        }
        $postId = Yii::$app->request->post('postId');
        $radio = Yii::$app->request->post('radio');
        if($radio == null){
            $radio = [];
        }
        $datum = Yii::$app->request->post('datum');
        if($datum == null){
            $datum = [];
        }
        $radioTitle = Yii::$app->request->post('radioTitle');
        if($radioTitle == null){
            $radioTitle = [];
        }
        $datumTitle = Yii::$app->request->post('datumTitle');
        if($datumTitle == null){
            $datumTitle = [];
        }
        $sign = Category::findOne($catId);
        $cnContent = strip_tags($content);
        if($userData['roleId'] > 2) {
            $sign1 = Method::sensitiveWords($cnContent);
            $sign2 = Method::sensitiveWords($title);
            if ($sign1['code'] == 0 || $sign2['code' == 0]) {
                die(json_encode(['code' => 0, 'message' => '请勿输入敏感词汇:' . $sign1['info'] . '-' . $sign2['info']]));
            }
        }
        $integral = uc_user_integral1($uid);
        $integral = $integral['totalIntegral'];
        if($sign->keyTag == 2){
            if($userData['roleId'] > 3 && $integral < 10000) {
                die(json_encode(['code' => 0, 'message' => 'Hi，该答疑版块仅对雷哥网学员开放哟，详询老师QQ 2095453331']));
            }
        }
        $imageContent = Method::getStrImage($content);
        foreach($imageContent as $k => $v){
            if($v[0] != '/'){
                $imageContent[$k] = '/'.$v;
            }
        }
        if(!$sign->gossipType) {
            if($postId){
                $models = new Post();
                $model = $models->findOne($postId);
                $model->title = $title;
                $model->content = $content;
                $model->cnContent = $cnContent;
                $model->imageContent = serialize($imageContent);
                $model->datum = serialize($datum);
                $model->datumTitle = serialize($datumTitle);
                $model->radio = serialize($radio);
                $model->radioTitle = serialize($radioTitle);
                $model->catId = $catId;
                $re = $model->save();
            } else{
                $model = new Post();
                $model->title = $title;
                $model->content = $content;
                $model->cnContent = $cnContent;
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
                $model->sort = 99999;
                $model->uid = $uid;
                $model->lastReplayTime = time();
                $re = $model->save();
            }

            $type = 1;
        }else{
            $time = time();
            $model = new Gossip();
            $model->title = base64_encode($title);
            $model->content = base64_encode($cnContent);
            $model->image = json_encode($imageContent);
            $model->video = '';
            $model->audio = '';
            $model->createTime = $time;
            $model->uid = $uid;
            $model->icon = '';
            $model->publisher = $username;
            $model->belong = $sign->gossipType;
            $re = $model->save();
            $type = 2;
        }
        if($re){
            die(json_encode(['code' => 1,'type' => $type,'id' => $model->primaryKey,'message' => '发表成功']));
        }else{
            die(json_encode(['code' => 0,'message' => '发表失败，请稍后在试']));
        }
    }

    /**
     * 签到
     * @Obelisk
     */
    public function actionSignIn(){
        $uid = Yii::$app->session->get('uid');
        if(!$uid){
            die(json_encode(['code' => 0,'message' =>'未登录']));
        }
        $time = date("Y-m-d");
        $sign = User::find()->where("uid=$uid AND lastSignIn = '$time'")->one();
        if($sign){
            die(json_encode(['code' => 2,'message' =>'你已签到']));
        }else{
            User::updateAll(['lastSignIn' => $time,'countSign' => $sign->countSign+1,'continuousSign' => $sign->continuousSign+1],"uid=$uid");
            uc_user_edit_integral1($uid,'社区签到',1,10);
            die(json_encode(['code' => 1,'message' =>'签到成功,系统赠送你10雷豆']));
        }
    }

    /**
     * 密码锁
     * @Obelisk
     */
    public function actionLock(){
        $catId = Yii::$app->request->post('catId');
        $pass = Yii::$app->request->post('pass');
        $data = Category::findOne($catId);
        if($data->passKey == $pass){
            Yii::$app->session->set("category$catId",1);
            die(json_encode(['code' => 1,'message' =>'密码正确']));
        }else{
            die(json_encode(['code' => 0,'message' =>'密码错误']));
        }
    }

    /**
     * 修改角色
     * @Obelisk
     *
     */
    public function actionEditRole(){
        $uid = Yii::$app->request->get('uid');
        $integral = Yii::$app->request->get('integral');
        if($integral>=10000){
            $data = User::find()->asArray()->where("uid = $uid")->one();
            if($data['roleId'] >2){
                    User::updateAll(['roleId' => 3],"uid=$uid");
            }
        }
    }

    /**
     * 搜索问题
     * @return string
     * @Obelisk
     */
    public function actionSelectQuestion(){
        $keywords = Yii::$app->request->post('keywords');
        $question = Question::find()->asArray()->where("title like '%$keywords%'")->all();
        foreach($question as $k => $v){
            $question[$k]['answer'] = Answer::find()->where('questionId='.$v['id'])->count();
        }
        return json_encode($question);
    }

    /**
     * 搜索话题
     * @return string
     * @Obelisk
     */
    public function actionSelectTopic(){
        $keywords = Yii::$app->request->post('keywords');
        $category = Yii::$app->request->post('category');
        $topic = Topic::find()->asArray()->where("name like '%$keywords%'")->all();
        if(count($topic)>0){
            if($category){
                $where = "name like '%$keywords%' AND id not in ($category)";
            }else{
                $where = "name like '%$keywords%'";
            }
            $topic = Topic::find()->asArray()->where($where)->all();
            if(count($topic)>0){
                $re = ['code' => 1,'message' => '有话题','data' => $topic];
            }else{
                $re = ['code' => 2,'message' => '请不要输入重复话题'];
            }
        }else{
            $re = ['code' => 0,'message' => '暂无此话题'];
        }
        return json_encode($re);
    }

    /**
     * 加载更多问题
     * @return string
     * by yanni
     */
    public function actionLoadQuestion(){
        $topicId = Yii::$app->request->post('topicId',1);
        $page = Yii::$app->request->post('page',8);
        $model = new TopicQuestion();
        $data = $model->getTopicQuestion($topicId,$page,8);
        foreach($data['data'] as $k=>$v){
            $model = new TopicQuestion();
            $data['data'][$k]['commentNum'] = count($model->getAnswer($v['questionId']));
            $data['data'][$k]['answer'] = Answer::find()->asArray()->where("questionId=".$v['questionId'])->orderBy("id asc")->one();
            $data['data'][$k]['user'] = User::find()->asArray()->where("uid=".$v['uid'])->select(['username'])->one();
        }
        if(!empty($data['data'])){
            die(json_encode(['code' => 1,'message' =>'加载成功','data'=>$data,'page'=>$page+8]));
        } else{
            die(json_encode(['code' => 0,'message' =>'未加载到数据']));
        }
    }

    /**
     * 话题更多
     * @return string
     * by yanni
     */
    public function actionLoadTopic(){
        $page = Yii::$app->request->post('page',10);
        $model = new Topic();
        $data = $model->getTopic($page,'10');
        $num = count($data);
        if($num<10)
        {
            $pa = 10-$num;
            $res = $model->getTopic('0',$pa);
            $data = array_merge($data,$res);
        }
        if($pa){
            die(json_encode(['code'=>2,'data'=>$data,'page'=>$pa]));
        } else {
            die(json_encode(['code'=>1,'data'=>$data,'page'=>$page+10]));
        }
    }

    /**
     * 回复分页接口
     * @return string
     * by yanni
     */
    public function actionReplyPage(){
        $answerId = Yii::$app->request->post('answerId',1);
        $page = Yii::$app->request->post('page',1);
        $model = new AnswerReply();
        $data = $model->getReplyUser($answerId,$page,5);
        die(json_encode($data));
    }

    /**
     * 添加问题
     * @return string
     * @Obelisk
     */
    public function actionAddQuestion(){
        $uid = Yii::$app->session->get('uid');
        if(!$uid){
            die(json_encode(['code' => 0,'message' =>'未登录']));
        }
        $title = Yii::$app->request->post('title');
        $content = Yii::$app->request->post('content');
        $topic = Yii::$app->request->post('topic');
        $topic = explode(",",$topic);
        $model = new Question();
        $model->title = $title;
        $model->content = $content;
        $model->createTime = time();
        $model->uid = $uid;
        $re = $model->save();
        $id = $model->primaryKey;
        foreach($topic as $v){
            $model = new TopicQuestion();
            $model->topicId = $v;
            $model->questionId = $id;
            $model->save();
            Topic::updateAll(['type' => 1],"id=$v");
        }
        if($re){
            die(json_encode(['code' => 1,'id' => $id,'message' =>'发表成功']));
        }else{
            die(json_encode(['code' => 0,'message' =>'发表失败']));
        }
    }

    /**
     * 回答问题
     * @return string
     * by  yanni
     */
    public function actionAddAnswer(){
        $uid = Yii::$app->session->get('uid');
        if(!$uid){
            die(json_encode(['code' => 0,'message' =>'未登录']));
        }
        $content = Yii::$app->request->post('content');
        $questionId = Yii::$app->request->post('questionId');
        $cnContent = strip_tags($content);
        $sign1 = Method::sensitiveWords($cnContent);
        if($sign1['code'] == 0){
            die(json_encode(['code' => 0,'message' => '请勿输入敏感词汇']));
        }
        $imageContent = Method::getStrImage($content);
        $model = new Answer();
        $model->content = $content;
        $model->createTime = time();
        $model->uid = $uid;
        $model->questionId = $questionId;
        $model->cnContent = $cnContent;
        $model->imageContent = serialize($imageContent);
        $re = $model->save();
        $data = $model->getAnswer($model->primaryKey);
        if($re){
            die(json_encode(['code' => 1,'message' =>'发表成功','data'=>$data]));
        }else{
            die(json_encode(['code' => 0,'message' =>'发表失败']));
        }
    }

    /**
     * 添加回答评论
     * @return string
     * by  yanni
     */
    public function actionAddAnswerReply(){
        $uid = Yii::$app->session->get('uid');
        if(!$uid){
            die(json_encode(['code' => 0,'message' =>'未登录']));
        }
        $content = Yii::$app->request->post('content');
        $answerId = Yii::$app->request->post('answerId');
        $content = strip_tags($content);
        $sign1 = Method::sensitiveWords($content);
        if($sign1['code'] == 0){
            die(json_encode(['code' => 0,'message' => '请勿输入敏感词汇']));
        }
        $model = new AnswerReply();
        $model->content = $content;
        $model->createTime = time();
        $model->uid = $uid;
        $model->pid = 0;
        $model->answerId = $answerId;
        $re = $model->save();
        $replyModel = new AnswerReply();
        $data = $replyModel->getReplyUser($answerId,1,1);
        if($re){
            die(json_encode(['code' => 1,'message' =>'发表成功','data'=>$data]));
        }else{
            die(json_encode(['code' => 0,'message' =>'发表失败']));
        }
    }

    /**
     * 加入社团
     * @return string
     * by  yanni
     */
    public function actionJoinClub(){
        $uid = Yii::$app->session->get('uid');
        if(!$uid){
            die(json_encode(['code' => 0,'message' =>'未登录']));
        }
        $inspect = UserCategory::find()->asArray()->where("uid=".$uid." and catId=1")->one();
        if(count($inspect)>0){
            die(json_encode(['code' => 2,'message' =>'你已加入了此社团']));
        } else{
            $model = new UserCategory();
            $model->uid = $uid;
            $model->catId = 1;
            $model->createTime = time();
            $res = $model->save();
            if($res>0){
                die(json_encode(['code' => 1,'message' =>'加入社团成功']));
            } else{
                die(json_encode(['code' => 3,'message' =>'加入社团失败']));
            }
        }
    }
    /**
     * 社团团员
     * @return string
     * by  yanni
     */
    public function actionGetMembers(){
        $catId = Yii::$app->request->post('catId');
        $model = new UserCategory();
        $data = $model->getMembers($catId);
        if(!empty($data)){
            die(json_encode(['code' => 1,'message' =>'获取团员成功','data'=>$data]));
        } else{
            die(json_encode(['code' => 0,'message' =>'获取团员失败','data'=>$data]));
        }
    }
    /**
     * 添加话题
     * @return string
     * @Obelisk
     */
    public function actionAddTopic(){
        $uid = Yii::$app->session->get('uid');
        $name = Yii::$app->request->post('name');
        if(!$uid){
            die(json_encode(['code' => 0,'message' =>'未登录']));
        }
        $model = new Topic();
        $model->name = $name;
        $model->type = 0;
        $model->createTime = time();
        $model->uid = $uid;
        $re = $model->save();
        if($re){
            die(json_encode(['code' => 1,'id' => $model->primaryKey,'message' =>'添加成功']));
        }else{
            die(json_encode(['code' => 0,'message' =>'添加失败']));
        }
    }

    /**
     * 注销账户
     * @return string
     * */

    public function actionLoginOut()

    {
        $session = Yii::$app->session;
        $session->removeAll();
        $loginOut = uc_user_synlogout();
        $session->set('loginOut',$loginOut);
        die(json_encode(['code' => 1]));

    }
}