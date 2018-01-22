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
use app\modules\basic\models\Block;

class ApiController extends ApiControl {
    public $enableCsrfValidation = false;
    /**
     * 获取所有在用模块
     * @Obelisk
     */
    public function actionBlock()
    {
        $pid = Yii::$app->request->get('pid',0);
        $status = Yii::$app->request->get('status',1);
        $model = new Block();
        $data = $model->getAllBlock($pid,$status);
        echo json_encode($data);

    }

    /**
     * 获取分类树包括一级分类
     * @Obelisk
     */
    public function actionTree(){
        $model = new Block();
        $pid = Yii::$app->request->get('pid','');
        $id = Yii::$app->request->get('id','');
        $data = $model->getTree($pid,$id);
        echo json_encode($data);
    }
}