<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/4/21 0021
 * Time: 10:40
 */
namespace app\modules\cn\controllers;

use yii;
use yii\web\Controller;
use app\modules\cn\models\Login;
use app\modules\cn\models\Content;

class LoginController extends Controller
{
    public $layout = 'cn1.php';
    public $enableCsrfValidation = false;

    public function actionLogin()
    {
        if(isset($_SERVER['HTTP_REFERER'])){
            if(strpos($_SERVER['HTTP_REFERER'], 'register.html') !== false || $_SERVER['HTTP_REFERER']==false){
                Yii::$app->session->set('url','/index.html');
            }else{
                Yii::$app->session->set('url',$_SERVER['HTTP_REFERER']);
            }
        }else{
            Yii::$app->session->set('url','http://bbs.com');
        }
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
        return $re;
    }


}