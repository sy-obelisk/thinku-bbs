<?php
/**
 * 分类管理
 * Created by PhpStorm.
 * User: Administrator
 * Date: 15-6-17
 * Time: 下午2:37
 */
namespace app\modules\hot\controllers;


use yii;
use app\libs\ApiControl;
use app\modules\hot\models\Recommend;
use app\modules\basic\models\Role;
class RecommendController extends ApiControl {
    public $enableCsrfValidation = false;
    public function actionIndex()
    {
        $pid  = Yii::$app->request->get('id',0);
        $model = new Recommend();
        $data = $model->getRecommendModel($pid);
//        var_dump($data);die;
        return $this->render('index',['data'=>$data]);
    }

    public function actionAddHot(){
        $session  = Yii::$app->session;
        $userId = $session->get('adminId');
        $pid  = Yii::$app->request->get('id',0);
        $model = new Recommend();
        if($_POST){
            $id = Yii::$app->request->post('id','');
            $name = Yii::$app->request->post('name','');
            $img = Yii::$app->request->post('img','');
            $url = Yii::$app->request->post('url','');
            if($id){
                $res = $model->findOne($id);
                $res->name = $name;
                $res->image = $img;
                $res->url = $url;
                $re = $res->save();
            } else {
                $model->pid = $pid;
                $model->name = $name;
                $model->image = $img;
                $model->uid = $userId;
                $model->url = $url;
                $re = $model->save();
            }

            if($re){
                echo '<script>alert("操作成功")</script>';
                return $this->redirect('/hot/recommend/index');
            }
        } else{
            return $this->render('add');
        }
    }

    public function actionUpdateRecommend(){
        $id = Yii::$app->request->get('id');
        $model = new Recommend();
        $data = $model->findOne($id);
//        var_dump($data);die;
        return $this->render('add',['data'=>$data]);
    }

    public function actionDelete(){
        $id = Yii::$app->request->get('id');
        $model = new Recommend();
        $re = $model->findOne($id)->delete();
        if($re){
            die( '<script>alert("删除成功");history.go(-1);</script>');
        } else {
            die( '<script>alert("失败，请重试");history.go(-1);</script>');
        }
    }
}