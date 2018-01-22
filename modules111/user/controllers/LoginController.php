<?php
/**
 * 登录管理
 * Created by PhpStorm.
 * User: Administrator
 * Date: 15-6-17
 * Time: 下午2:37
 */
namespace app\modules\user\controllers;
use yii;
use yii\web\Controller;
use app\modules\user\models\User;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
class LoginController extends Controller {
    public $enableCsrfValidation = false;
    /**
     * 登录界面
     * @return string
     */
    public function actionIndex(){
        $session  = Yii::$app->session;
        $userId = $session->get('adminId');
        if($userId)
        {
            $this->redirect('/index/index');
        }else{
            return $this->renderPartial('index');
        }
    }


    /**
     * 登录验证
     * @return string
     * */
    public function actionCheck()
    {

        header('Content-Type:text/html;charset=utf-8');
        $apps       = Yii::$app->request;
        $session    = Yii::$app->session;
        $logins     = new User();
        if($apps->isPost)
        {
            $userName   = $apps->post('userName');
            $userPass   = $apps->post('userPass');
            $userPass = md5($userPass);
//            var_dump($userPass);die;
            $roleArr = "1,2";
            $loginsdata =  $logins->findBySql('SELECT * FROM {{%user}} where userName="'.$userName.'" and userPass="'.$userPass.'"')->one();
//            $loginsdata =  $logins->findBySql("SELECT * FROM {{%user}} where userName='".$userName."' and userPass='".$userPass."' and roleId in ($roleArr) ")->one();
            if(!empty($loginsdata['uid']))
            {
                $session->set('adminId',$loginsdata['uid']);
//                if ($loginsdata['image'] == null) {
//                    $loginsdata['image'] = '';
//                }
                $session->set('adminData', $loginsdata);
                $session->set('userName', $loginsdata['userName']);
                $this->redirect('/user/index');
            }
            else
            {
                echo '<script>alert("帐号或密码不正确");history.go(-1);</script>';
                exit;
            }
        }
    }
    /**
     * 注销账户
     * @return string
     * */
    public function actionLoginOut()
    {
        $session    = Yii::$app->session;
        $session->remove('adminData');
        $session->remove('adminId');
        $session->remove('userName');
        $this->redirect('/user/login');
    }

    /**生成静态页
     * @Obelisk
     */
    public function actionHtml(){
        if(@unlink("html\cn\heard.html")){
            die("<script>history.go(-1) </script>");
        }
    }
}