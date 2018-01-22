<?php
/**
 * 内容首页
 * Created by PhpStorm.
 * User: Administrator
 * Date: 15-6-17
 * Time: 下午2:37
 */
namespace app\modules\content\controllers;


use yii;
use app\libs\ApiControl;

class IndexController extends ApiControl {
    public function actionIndex()
    {
        $session  = Yii::$app->session;
        $userId = $session->get('adminId');
        if(!$userId){
            $this->redirect('/user/login/index');
        }
        return $this->render('index');
    }


}