<?php
/**
 * 全局API
 * Created by PhpStorm.
 * User: Administrator
 * Date: 15-6-17
 * Time: 下午2:37
 */
namespace app\modules\basic\controllers;


use yii;
use yii\web\Controller;
use app\libs\ApiControl;
use app\modules\basic\models\Modular;
use app\modules\basic\models\User;

class ApiController extends ApiControl {
    public $enableCsrfValidation = false;
    /**
     * 获取所有在用模块
     * @Obelisk
     */
    public function actionBlock()
    {
        $userId = Yii::$app->session->get('adminId');
        $data = User::findOne($userId);
        $model = new Modular();
        $category = $model->getModular($data['roleId']);
        echo json_encode($category);

    }

    /**
     * 获取分类树包括一级分类
     * @Obelisk
     */
    public function actionTree(){
        $model = new Modular();
        $id = Yii::$app->request->get('id','');
        $pid = Yii::$app->request->get('pid','');
        $data = $model->getParentModular($pid,$id);
        echo json_encode($data);
    }
}