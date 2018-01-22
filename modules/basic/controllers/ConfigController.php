<?php
/**
 * 全局配置
 * Created by PhpStorm.
 * User: obelisk
 * Date: 15-10-26
 * Time: 下午2:37
 */
namespace app\modules\basic\controllers;

use yii;
use app\modules\basic\models\Params;
use app\libs\AppControl;
class ConfigController extends AppControl {
    public $enableCsrfValidation = false;
    public function actionIndex()
    {
        $model = new Params();
        $paramsData = $model->find()->orderBy("id DESC")->all();
       return $this->render('index',['data' => $paramsData,'block' => $this->block]);
    }

    /**
     * 添加配置
     * @return string
     * @Obelisk
     */
    public function actionAdd(){
        if($_POST){
            $model = new Params();
            $data = Yii::$app->request->post('params');
            $id = Yii::$app->request->post('id','');
            if($id){
                $re = $model->updateAll($data,'id = :id',[':id' => $id]);
            }else{
                $model->key = $data['key'];
                $model->value = $data['value'];
                $model->createTime = date("Y-m-d H:i:s");
                $model->userId = Yii::$app->session->get('adminId');
                $re = $model->save();
            }
            if($re){
                $this->redirect("/basic/config/index");
            }else{
                die( '<script>alert("失败，请重试");history.go(-1);</script>');
            }
        }else{
            return $this->render('add');
        }
    }

    /**
     * 修改配置
     * @return string
     * @Obelisk
     */
    public function actionUpdate(){
        $id = Yii::$app->request->get('id');
        $model = new Params();
        $data = $model->findOne($id);
        return $this->render('add',array('data'=> $data ,'id' => $id));
    }
    /**
     * 删除配置
     * @return string
     * @Obelisk
     */
    public function actionDelete(){
        $id = Yii::$app->request->get('id');
        $model = new Params();
        $re = $model->findOne($id)->delete();
        if($re){
            $this->redirect('/basic/config/index');
        }else{
            echo '<script>alert("失败，请重试");history.go(-1);</script>';
            die;
        }

    }
}