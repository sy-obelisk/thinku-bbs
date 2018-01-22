<?php
/**
 * 全局API
 * Created by PhpStorm.
 * User: Administrator
 * Date: 15-6-17
 * Time: 下午2:37
 */
namespace app\modules\content\controllers;


use app\modules\basic\models\Role;
use yii;
use yii\web\Controller;
use app\libs\ApiControl;
use app\modules\content\models\Category;

class ApiController extends ApiControl {
    public $enableCsrfValidation = false;
    /**
     * 获取分类
     * by  yanni
     */
    public function actionCat()
    {
        $model = new Category();
        $category = $model->getCategory();
        echo json_encode($category);

    }

    /**
     * 获取分类
     * by  yanni
     */
    public function actionGetRole()
    {
        $model = new Role();
        $role = $model->find()->asArray()->all();
        echo json_encode($role);

    }
    /**
     * 获取分类树包括一级分类
     * by yanni
     */
    public function actionTree(){
        $model = new Category();
        $id = Yii::$app->request->get('id','');
        $pid = Yii::$app->request->get('pid','');
        $data = $model->getParentCat($pid,$id);
        echo json_encode($data);
    }

    /**
     * 排序
     * by yanni
     */
    public function actionChangeSort()
    {
        $id = Yii::$app->request->post('id');
        $sort = Yii::$app->request->post('sort');
        $sql = "UPDATE {{%post}} SET sort = '$sort' WHERE id = $id";
        $re = Yii::$app->db->createCommand($sql)->query();
        if($re){
            die(json_encode(['code' =>1]));
        }else{
            die(json_encode(['code' =>0]));
        }
    }
}