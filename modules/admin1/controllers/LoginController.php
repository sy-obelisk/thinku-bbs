<?php
/**
 * 登录管理
 * Created by PhpStorm.
 * User: Administrator
 * Date: 15-6-17
 * Time: 下午2:37
 */
namespace app\modules\admin\controllers;

use yii;
use app\modules\admin\models\Admin;
use yii\web\Controller;
class LoginController extends Controller
{
    public $enableCsrfValidation = false;

    /**
     * 登陆界面
     * @return string
     */
    public function actionIndex()
    {
        $session = Yii::$app->session;
        $userId = $session->get('adminId');
        if ($userId) {
            $this->redirect('admin/index/index');
        } else {
            return $this->renderPartial('index');
        }
    }


    /**
     * 登陆验证
     * @return string
     * */
    public function actionCheck()
    {
        header('Content-Type:text/html;charset=utf-8');
        $apps = Yii::$app->request;
        $session = Yii::$app->session;
        $logins = new Admin();
        if ($apps->isPost) {
            $userName = $apps->post('userName');
            $userPass = md5($apps->post('userPass'));
            $loginsdata = $logins->find()->where(['userName' => $userName, 'userPass' => $userPass])->one();
            if (!empty($loginsdata['id'])) {
                $session->set('adminId', $loginsdata['id']);
                $session->set('userName', $loginsdata['userName']);
                $session->set('rid', $loginsdata['roleId']);
                $this->redirect('/index/index');
            } else {
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
        $session = Yii::$app->session;
        $session->remove('adminData');
        $session->remove('adminId');
        $this->redirect('/admin/login');
    }
}