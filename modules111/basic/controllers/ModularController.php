<?php
namespace app\modules\basic\controllers;


use yii;
use yii\web\Controller;
use app\libs\ApiControl;
use app\modules\basic\models\Modular;

class ModularController extends ApiControl
{
    public $enableCsrfValidation = false;
    public function actionIndex()
    {
        $userId = Yii::$app->session->get('adminId');
        $model = new Modular();
        $Modular = $model->getModular($userId,0);
        return $this->render('index',['Modular'=>$Modular]);
    }


    public function actionAdd(){
        $session  = Yii::$app->session;
        $userId = $session->get('adminId');
        $model = new Modular();
        if($_POST){
            $id = Yii::$app->request->post('id');
            $uid = Yii::$app->request->post('uid');
            $path = Yii::$app->request->post('modularUrl');
            $pid = Yii::$app->request->post('pid');
            $name = Yii::$app->request->post('modularName');
            if($id){
                $res = $model->findOne($id);
                $res->path = $path;
                $res->pid = $pid;
                $res->name = $name;
                $re = $res->save();
            } else {
                $model->ceateId = $uid;
                $model->path = $path;
                $model->pid = $pid;
                $model->name = $name;
                $model->createTime = time();
                $re = $model->save();
            }

            if($re){
                echo '<script>alert("操作成功");history.go(-1);</script>';
                return $this->redirect('/basic/index/index');
            }
        } else{
            $modular = $model->find()->asArray()->where('pid=0')->all();
            return $this->render('add',['modular'=>$modular,'uid'=>$userId]);
        }
    }

    public function actionUpdate(){
        $pid = Yii::$app->request->get('id');
        $userId = Yii::$app->session->get('adminId');
        $model = new Modular();
        $res = $model->findOne($pid);
        $parent = $model->find()->asArray()->where('id='.$res['pid'])->one();
        return $this->render('add',['uid'=>$userId,'parent'=>$parent,'data'=>$res]);
    }

    public function actionDelete(){
        $id = Yii::$app->request->get('id');
        $model = new Modular();
        $re = $model->findOne($id)->delete();
        if($re){
            die( '<script>alert("删除成功");history.go(-1);</script>');
        } else {
            die( '<script>alert("失败，请重试");history.go(-1);</script>');
        }
    }
}