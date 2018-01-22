<?php
/**
 * 全局首页
 * Created by PhpStorm.
 * User: obelisk
 * Date: 15-6-17
 * Time: 下午2:37
 */
namespace app\modules\basic\controllers;

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