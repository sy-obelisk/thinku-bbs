<?php
namespace app\modules\basic\controllers;


use yii;
use yii\web\Controller;
use app\libs\ApiControl;
use app\modules\basic\models\Role;
use app\modules\basic\models\Modular;
use app\modules\basic\models\UserControl;

class RoleController extends ApiControl
{
    public $enableCsrfValidation = false;
    public function actionIndex()
    {
        $model = new Role();
        $role = $model->find()->all();
        return $this->render('index',['role'=>$role]);
    }
    public function actionAdd(){
        if($_POST){
            $id = Yii::$app->request->post('id');
            $name = Yii::$app->request->post('roleName');
            $model = new Role();
            if($id){
                $role = $model->findOne($id);
                $role->name = $name;
                $re = $role->save();
            } else {
                $model->name = $name;
                $model->createTime = time();
                $re = $model->save();
            }
            if($re){
                return $this->actionIndex();
            } else{
                die( '<script>alert("失败，请重试");history.go(-1);</script>');
            }
        } else {
            return $this->render('add');
        }
    }
    /**
     * 修改角色页面
     * by yanni
     */
    public function actionUpdate(){
        $id = Yii::$app->request->get('id');
        $model = new Role();
        $data = $model->findOne($id);
        return $this->render('add',['data'=>$data]);
    }

    public function actionDelete(){
        $id = Yii::$app->request->get('id');
        $model = new Role();
        $re = $model->findOne($id)->delete();
        if($re){
            return $this->actionIndex();
        } else {
            die( '<script>alert("失败，请重试");history.go(-1);</script>');
        }
    }
    public function actionLimit(){
        $id = Yii::$app->request->get('id');
        $model = new Role();
        $res = $model->findOne($id);
        $name = $res['name'];   //角色名
        $data = Modular::find()->asArray()->select(['id','name'])->where('pid=0')->all(); //所有权限
        $power = $model->getPower($id);         //已有权限
        foreach($data as $key=>$d){
            foreach($power as $p){
                if($d['id']==$p['id']){
                    $data[$key]['checked'] = 1;
                }
            }
        }
        return $this->render('limit',['name'=>$name,'data'=>$data,'power'=>$power]);
    }

    public function actionUpdateQx(){
        $content = Yii::$app->request->post('content');
        $role = Yii::$app->request->post('role');
        $model = new Role();
        $power = $model->getPower($role);         //已有权限
        if($content){
            foreach($power as $v){
                if(!in_array($v['id'],$content)){
                    $modele = new UserControl();
                    $modele->deleteAll('controlId='.$v['id'].' and roleId='.$role);
                }
            }
            foreach($content as $a){
                $res = UserControl::find()->where('controlId='.$a.' and roleId='.$role)->all();
                if(!$res){
                    $modele = new UserControl();
                    $modele->roleId = $role;
                    $modele->controlId = $a;
                    $modele->save();
                }
            }
        } else {
            $modele = new UserControl();
            $modele->deleteAll('roleId='.$role);
        }
        header("Location:limit?id=".$role);
    }
}