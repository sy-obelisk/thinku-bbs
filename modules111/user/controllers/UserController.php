<?php
/**
 * 分类管理
 * Created by PhpStorm.
 * User: Administrator
 * Date: 15-6-17
 * Time: 下午2:37
 */
namespace app\modules\user\controllers;


use yii;
use app\libs\ApiControl;
use app\modules\user\models\User;
use app\modules\basic\models\Role;
class UserController extends ApiControl {
    public $enableCsrfValidation = false;
    function init (){
        parent::init();
        include_once($_SERVER['DOCUMENT_ROOT'].'/../libs/ucenter/ucenter.php');
    }

    public function actionIndex()
    {
        $session  = Yii::$app->session;
        $userId = $session->get('adminId');
        $adminData = $session->get('adminData');
        if(!$userId){
            $this->redirect('/user/login/index');
        } else{
            $uid  = Yii::$app->request->get('uid','');    //UID
            $userName  = Yii::$app->request->get('userName','');   //用户名
            $nickName = Yii::$app->request->get('nickName','');    //昵称
            $role = Yii::$app->request->get('role','');       //角色
            $email = Yii::$app->request->get('email','');     //邮箱
            $phone = Yii::$app->request->get('phone','');     //电话
            $page = Yii::$app->request->get('page',1);
            $where="1=1";
            if($uid){
                $where .= " AND u.uid ='$uid'";
            }
            if($userName){
                $where .= " AND u.username like '%".$userName."%'";
            }
            if($nickName){
                $where .= " AND u.nickname like '%".$nickName."%'";
            }
            if($role){
                $where .= " AND u.roleId ='$role'";
            }
            if($email){
                $where .= " AND u.email like '%".$email."%'";
            }
            if($phone){
                $where .= " AND u.phone like '%".$phone."%'";
            }
            $model = new User();
            $order = ' ORDER BY u.createTime DESC';
            if($where == "1=1"){
                $data = [];
            }else{
                $data = $model->getAllUser($where,$order,$page,25);
            }
            $role = Role::find()->asArray()->select(['id','name'])->all();
            return $this->render('index',['data'=>$data,'role'=>$role,'roleId' => $adminData['roleId']]);
//            var_dump($where);die;
        }
    }

    /**
     * 添加用户
     * by Yanni
     */
    public function actionAddUser(){
        if($_POST){
            $userName = Yii::$app->request->post('userName','lgw'.time());
            $email = Yii::$app->request->post('email');
            $phone = Yii::$app->request->post('phone');
            $passWord = Yii::$app->request->post('passWord');
            $url = Yii::$app->request->post('url');
            if($email || $phone){
                $uid = uc_user_register($userName,$passWord,$email,$phone,"社区后台",time());
                if($uid <0) {
                    if ($uid == -1) {
                        die( '<script>alert("用户名已经被注册");history.go(-1);</script>');
//                        $res['code'] = 0;
//                        $res['message'] = '用户名已经被注册';
                    } elseif ($uid == -2) {
                        die( '<script>alert("包含要允许注册的词语");history.go(-1);</script>');
//                        $res['code'] = 0;
//                        $res['message'] = '包含要允许注册的词语';
                    } elseif ($uid == -3) {
                        die( '<script>alert("用户名已经存在");history.go(-1);</script>');
//                        $res['code'] = 0;
//                        $res['message'] = '用户名已经存在';
                    } elseif ($uid == -4) {
                        die( '<script>alert("Email 格式有误");history.go(-1);</script>');
//                        $res['code'] = 0;
//                        $res['message'] = 'Email 格式有误';
                    } elseif ($uid == -5) {
                        die( '<script>alert("Email 不允许注册");history.go(-1);</script>');
//                        $res['code'] = 0;
//                        $res['message'] = 'Email 不允许注册';
                    } elseif ($uid == -6) {
                        die( '<script>alert("该 Email 已经被注册");history.go(-1);</script>');
//                        $res['code'] = 0;
//                        $res['message'] = '该 Email 已经被注册';
                    } elseif ($uid == -7) {
                        die( '<script>alert("电话已被注册");history.go(-1);</script>');
//                        $res['code'] = 0;
//                        $res['message'] = '电话已被注册';
                    }
                } else {
                    $model = new User();
                    $model->uid = $uid;
                    $model->phone = $phone;
                    $model->email = $email;
                    $model->createTime = time();
                    $model->username = 'lgw'.$uid;
                    $model->password = md5($passWord);
                    $model->roleId = 4;
                    $res = $model->save();
                    if($res>0){
                        echo '<script>alert("注册成功")</script>';
                        return $this->redirect("/user/user/index?uid=$uid&userName=&nickName=&role=&email=&phone=");
                    }
                }
            } else {
                die( '<script>alert("邮箱或手机不能全部为空");history.go(-1);</script>');
            }
        } else {
            return $this->render('add_user');
        }
    }
    /**
 * 修改用户积分
 * by Yanni
 */
    public function actionUpdateIntegral(){
        if($_POST){
            $uid = Yii::$app->request->post('uid');
            $number = Yii::$app->request->post('integral');
            $type = Yii::$app->request->post('type');
            $url = Yii::$app->request->post('url');
            uc_user_edit_integral1($uid,'论坛管理员直接调整',$type,$number);
            return $this->redirect($url);
        }else{
            $uid = Yii::$app->request->get('id');
            $model = new User();
            $userData = $model->findOne($uid);
            $data = uc_user_integral1($uid,"","");
            return $this->render('integral',['data'=>$data,'userData'=>$userData]);
        }
    }

    /**
     * 修改密码
     *
     */
    public function actionUpdatePass(){
        if($_POST){
            $uid = Yii::$app->request->post('uid');
            $pass = Yii::$app->request->post('pass');;
            $url = Yii::$app->request->post('url');
            uc_user_edit_by_uid($uid,'',$pass,'','',2);
            User::updateAll(['password' => md5($pass)],"uid = $uid");
            return $this->redirect($url);
        }else{
            $uid = Yii::$app->request->get('id');
            $model = new User();
            $userData = $model->findOne($uid);
            return $this->render('pass',['userData' => $userData]);
        }
    }

    /**
     * 修改用户角色
     * by Yanni
     */
    public function actionUpdate(){
        $uid = Yii::$app->request->get('id');
        $model = new User();
        $data = $model->findOne($uid);
        $role = Role::find()->asArray()->select(['id','name'])->all();
//            var_dump($data['nickname']);die;
        return $this->render('update',['data'=>$data,'role'=>$role]);
    }

    public function actionUpdateRole(){
        $session  = Yii::$app->session;
        $userData = $session->get('adminData');
        if($userData['roleId']==1){
            $uid = Yii::$app->request->post('uid');
            $roleId = Yii::$app->request->post('role');
            $url = Yii::$app->request->post('url');
            $model = new User();
            $res = $model->findOne($uid);
            $res->roleId = $roleId;
            $re = $res->save();
            if($re){
                return $this->redirect($url);
            } else {
                die( '<script>alert("修改失败");history.go(-1);</script>');
            }
        } else {
            die( '<script>alert("你还不是管理员不能修改用户角色");history.go(-1);</script>');
        }
    }
}