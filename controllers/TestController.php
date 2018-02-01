<?php

namespace app\controllers;

use Yii;

use yii\web\Controller;


class TestController extends Controller
{
    public function actionIndex()
    {

//        var_dump($_GET);die;
//        $userId = Yii::$app->session->get('userId');
//        if(!$userId){
//            $this->redirect('/user/login/index');
//        }else{
        return $this->renderPartial('index');
//        }
    }

}
