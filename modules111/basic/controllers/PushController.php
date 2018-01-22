<?php
namespace app\modules\basic\controllers;


use yii;
use yii\web\Controller;
use app\libs\ApiControl;
use app\modules\basic\models\Role;
use app\modules\basic\models\Modular;
use app\libs\Jpush;

class PushController extends ApiControl
{
    public $enableCsrfValidation = false;

    public function actionIndex(){
        return $this->render('index');
    }

    public function actionPush(){
        $content = Yii::$app->request->post('content');
        $url = Yii::$app->request->post('url');
        var_dump($content);
        var_dump($url);die;
    }
}