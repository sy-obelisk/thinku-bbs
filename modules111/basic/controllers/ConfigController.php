<?php
namespace app\modules\basic\controllers;

use yii;
use app\modules\basic\models\Configure;
use app\libs\ApiControl;
class ConfigController extends ApiControl {
    public $enableCsrfValidation = false;
    public function actionIndex()
    {
        $model = new Configure();
        $paramsData = $model->find()->orderBy("id DESC")->all();
       return $this->render('index',['data' => $paramsData]);
    }

    /**
     * 添加配置
     * @return string
     * by yanni
     */
    public function actionAdd(){
        if($_POST){
            $model = new Configure();
            $data = Yii::$app->request->post('params');
            $value = Yii::$app->request->post('value');
            $id = Yii::$app->request->post('id','');
            if($id){
                $re = $model->findOne($id);
                $re->key = $data['key'];
                $re->value = $data['value'];
                $re->save();
            }else{
                $model->key = $data;
                $model->value = $value;
                $model->createTime = date("Y-m-d H:i:s");
                $model->uid = Yii::$app->session->get('adminId');
                $re = $model->save();
            }
            if($re){
                $this->redirect("/basic/config/index");
            }else{
                die( '<script>alert("失败，请重试");history.go(-1);</script>');
            }
        }else{
            $title = '添加配置';
            return $this->render('add',['title'=>$title]);
        }
    }

    /**
     * 修改配置
     * @return string
     * @Obelisk
     */
    public function actionUpdate(){
        $id = Yii::$app->request->get('id');
        $model = new Configure();
        $data = $model->findOne($id);
        $title = '修改配置';
        return $this->render('add',array('data'=> $data ,'id' => $id,'title'=>$title));
    }
}