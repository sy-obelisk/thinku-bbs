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
use app\modules\basic\models\Modular;
use app\modules\basic\models\User;
class IndexController extends ApiControl {
    public function actionIndex()
    {
        $session  = Yii::$app->session;
        $userId = $session->get('adminId');
        if(!$userId){
            $this->redirect('/user/login/index');
        } else {
            $data = User::findOne($userId);
            $model = new Modular();
            $Modular = $model->getModular($data['roleId']);
            return $this->render('index',['Modular'=>$Modular]);
        }
    }

}