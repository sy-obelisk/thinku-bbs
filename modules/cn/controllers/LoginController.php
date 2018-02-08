<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/4/21 0021
 * Time: 10:40
 */
namespace app\modules\cn\controllers;

use app\modules\cn\models\Login;
use yii;
use yii\web\Controller;
use app\modules\cn\models\Content;

class LoginController extends Controller
{
    public $layout = 'cn.php';
    public $enableCsrfValidation = false;

    public function actionLogin()
    {
        return $this->render('login');
    }

    public function actionRegister()
    {
        return $this->render('register');
    }

    public function actionFindKey()
    {
        return $this->render('key');
    }

    public function actionVerifyCode()
    {
        $login=new Login();
        $re=$login->verifyCode();
        var_dump($re);die;
//        session_start();
//        getCode(4,60,20);


    }


}