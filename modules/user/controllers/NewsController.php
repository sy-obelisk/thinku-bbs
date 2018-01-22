<?php
/**
 * 分类管理
 * Created by PhpStorm.
 * User: Administrator
 * Date: 15-6-17
 * Time: 下午2:37
 */
namespace app\modules\user\controllers;


use app\modules\user\models\News;
use app\modules\user\models\User;
use yii;
use app\libs\AppControl;
use app\libs\Method;


class NewsController extends AppControl {
    public $enableCsrfValidation = false;

    /**
     * 系统消息列表
     * @return string
     * @Obelisk
     */
    public function actionIndex()
    {
        $page = Yii::$app->request->get('page',1);
        $beginTime = strtotime(Yii::$app->request->get('beginTime',''));
        $endTime = strtotime(Yii::$app->request->get('endTime',''));
        $sendId = Yii::$app->request->get('sendId','');
        $userId = Yii::$app->request->get('userId','');
        $id  = Yii::$app->request->get('id','');
        $where="n.type=1";
        if($beginTime){
            $where .= " AND n.createTime>=$beginTime";
        }
        if($endTime){
            $where .= " AND n.createTime<=$endTime";
        }
        if($id){
            $where .= " AND n.id = $id";
        }
        if($sendId){
            $where .= " AND n.sendId = $sendId";
        }
        if($userId){
            $where .= " AND n.userId = $userId";
        }
        $model = new News();
        $data = $model->getAllNews($where,10,$page);
        $page = Method::getPagedRows(['count'=>$data['count'],'pageSize'=>20, 'rows'=>'models']);
        return $this->render('news',['page' => $page,'data' => $data['data'],'block' => $this->block]);
    }

    /**
     * 添加资源
     * @return string
     * @Obelisk
     */
    public function actionAdd(){
        if($_POST){
            $userId = Yii::$app->request->post('userId');
            $beginTime = strtotime(Yii::$app->request->post('beginTime'));
            $endTime = strtotime(Yii::$app->request->post('endTime'));
            $news = Yii::$app->request->post('news','');
            $adminId = Yii::$app->session->get('adminId');
            if(!$news){
                die('<script>alert("信息内容不能为空");history.go(-1);</script>');
            }
            $where="1=1";
            if($beginTime){
                $where .= " AND createTime>=$beginTime";
            }
            if($endTime){
                $where .= " AND createTime<=$endTime";
            }
            if($userId){
                $where .= " AND id = $userId";
            }
            $users = User::find()->where($where)->all();
            foreach($users as $v){
                $model = new News();
                $model->news = $news;
                $model->userId = $v['id'];
                $model->status = 1;
                $model->type = 1;
                $model->createTime = time();
                $model->sendId = $adminId;
                $model->save();
            }
            $this->redirect("/user/news/index");
        }else{
            return $this->render('add');
        }
    }


    /**
     * 删除用户
     * @return string
     * @Obelisk
     */
    public function actionDelete(){
        $id = Yii::$app->request->get('id');
        $url = $_GET['url'];
        User::findOne($id)->delete();
        $this->redirect($url);
    }

    /**
     * 修改用户信息
     * @return string
     * @Obelisk
     */
    public function actionUpdate(){
        if($_POST){
            $user = Yii::$app->request->post('user');
            $id = Yii::$app->request->post('id');
            foreach($user as $k=>$v){
                if($k != 'image' && $v != ''){
                    $sign = User::find()->where("$k='$v' AND id!=$id")->one();
                    if($sign){
                        die('<script>alert("'.$k.'已被使用");history.go(-1);</script>');
                    }
                }
            }
            $sign = User::find()->where("phone='{$user['phone']}' AND id=$id")->one();
            if(!$sign){
                $status = uc_user_checkphone($user['phone']);
                if ($status == -7) {
                    die('<script>alert("该手机已被绑定");history.go(-1);</script>');
                }
            }
            $sign = User::find()->where("email='{$user['email']}' AND id=$id")->one();
            if(!$sign){
                $sign = uc_user_checkemail($user['email']);
                if ($sign == -6) {
                    die('<script>alert("该邮箱已被绑定");history.go(-1);</script>');
                }
            }
            $sign = User::findOne($id);
            $userPass = Yii::$app->request->post('userPass');
            $remark = Yii::$app->request->post('remark');
            $user['remark'] = $remark;
            if($sign->userPass != $userPass){
                $user['userPass'] = md5($userPass);
            }
            uc_user_edit($sign->userName,'',$user['userPass'],$user['email'],$user['phone'],1);
            $sign = User::updateAll($user,"id=$id");
            if($sign){
                $this->redirect('/user/user/index');
            }else{
                die('<script>alert("保存失败，请重试");history.go(-1);</script>');
            }
        }else{
            $id = Yii::$app->request->get('id');
            $data = User::findOne($id);
            return $this->render('update',['data' => $data,'id' => $id]);
        }
    }

    /**
     * 积分详情
     * @Obelisk
     */
    public function actionIntegral(){
        $id = Yii::$app->request->get('id');
        $user = User::findOne($id);
        $integral = uc_user_integral($user->userName);
        return $this->render('integral',['integral' => $integral,'id' => $id]);
    }

    /**
     * 积分详情
     * @Obelisk
     */
    public function actionIntegralEdit(){
        if($_POST){
            $userName = Yii::$app->request->post('userName');
            $url = Yii::$app->request->post('url');
            $number = Yii::$app->request->post('number');
            $type = Yii::$app->request->post('type');
            uc_user_edit_integral($userName,'管理员直接调整',$type,$number);
            $this->redirect($url);
        }else{
            $id = Yii::$app->request->get('id');
            $url = Yii::$app->request->get('url');
            $user = User::findOne($id);
            return $this->render('integralEdit',['userName' => $user->userName,'url' => $url]);
        }
    }
}