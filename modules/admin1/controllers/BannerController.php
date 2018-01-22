<?php
/**
 * 权限管理
 * Created by PhpStorm.
 * User: Administrator
 * Date: 15-6-17
 * Time: 下午2:37
 */
namespace app\modules\admin\controllers;

use yii;
use app\libs\ApiControl;
use app\modules\admin\models\Banner;
use app\libs\GetData;
class BannerController extends ApiControl
{
    public $enableCsrfValidation = false;
    public function actionIndex()
    {
        $data = Yii::$app->db->createCommand("select * from {{%banner}}")->queryAll();
        return $this->render('index', ['data' => $data]);
    }

    public function actionAdd()
    {
        if (!$_POST) {
            $id=Yii::$app->request->get('id', '');
            if(empty($id)){
                return $this->render('add');
            }else{
                $data  = Yii::$app->db->createCommand("select * from {{%banner}} where id=".$id)->queryOne();
                return $this->render('add', ['data'=>$data]);
            }

        } else {
            $banner=new Banner();
            $getdata=new GetData();
            $must=array('module'=>'模块','url'=>'地址','alt'=>'说明');
            $data=$getdata->PostData($must,'banner');
            $data['time']=date("Y-m-d",time());
            if(empty($data['id'])){
                $re = Yii::$app->db->createCommand()->insert("{{%banner}}", $data)->execute();
            }else{
                $re = $banner->updateAll($data,'id=:id',array(':id'=>$data['id']));
            }
            if ($re) {
                $this->redirect('index');
            } else {
                echo '<script>alert("数据修改/添加失败，请重试");history.go(-1);</script>';
                die;
            }
        }

    }

    public function actionDel()
    {
        $id = Yii::$app->request->get('id', '');
        $re = Banner::deleteAll("id=:id", array(':id' => $id));
        if ($re) {
            echo true;
        }

    }
}