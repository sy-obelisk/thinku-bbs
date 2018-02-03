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


}