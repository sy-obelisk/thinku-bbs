<?php
/**
 * 全局模块管理
 * Created by PhpStorm.
 * User: obelisk
 * Date: 15-6-17
 * Time: 下午2:37
 */
namespace app\modules\basic\controllers;

use yii;
use app\libs\AppControl;
use app\modules\basic\models\Block;
use app\modules\user\models\UserBlock;
class BlockController extends AppControl {
    public $enableCsrfValidation = false;
    public function actionIndex()
    {
       return $this->render('index');
    }
    /**
     * 添加资源与其基本信息
     * @return string
     * @Obelisk
     */
    public function actionAdd(){
        if($_POST){
            $model = new Block();
            $blockData = Yii::$app->request->post('block');
            $id = Yii::$app->request->post('id');
            if($id){
                $re = $model->updateAll($blockData,'id = :id',[':id' => $id]);
            }else{
                $model->pid = $blockData['pid'];
                $model->name = $blockData['name'];
                $model->value = $blockData['value'];
                $model->status = $blockData['status'];
                $re = $model->save();
            }
            if($re){
                echo '<script>alert("成功")</script>';
                $this->redirect('/basic/block/index');
            }else{
                die( '<script>alert("失败，请重试");history.go(-1);</script>');
            }
        }
        return $this->render('add');
    }

    /**
     * 修改资源
     * @return string
     * @Obelisk
     */

    public function actionUpdate(){
        $id = Yii::$app->request->get('id');
        $model = new Block();
        $data = $model->findOne($id);
        $pName = $model->find()->where("id=".$data->pid)->one();
        return $this->render('add',array('data'=> $data,'pName'=>$pName->name ,'id' => $id));
    }

    /**
     * 删除资源
     * @return string
     * @Obelisk
     */
    public function actionDelete(){
        $id = Yii::$app->request->get('id');
        UserBlock::deleteAll("blockId = $id");
        $model = new Block();
        if($model->findOne($id)->delete()){
            $this->redirect('/basic/block/index');
        }else{
            echo '<script>alert("失败，请重试");history.go(-1);</script>';
            die;
        }

    }
}