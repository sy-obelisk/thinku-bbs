<?php
/**
 * 后台用户接口
 * Created by PhpStorm.
 * User: Administrator
 * Date: 15-6-17
 * Time: 下午2:37
 */
namespace app\modules\user\controllers;


use app\modules\user\models\Report;
use yii;
use yii\web\Controller;
use app\libs\ApiControl;
use app\modules\cn\models\User;

class ApiController extends ApiControl
{
    public $enableCsrfValidation = false;

    public function  actionCheck()
    {
        $data['status']= Yii::$app->request->post('status', '');
        $data['id'] = Yii::$app->request->post('id', '');
        $contentId = Yii::$app->request->post('contentId', '');
        $userId = Yii::$app->request->post('userId', '');
        $author = Yii::$app->db->createCommand("select userId From {{%content}} where id=$contentId ")->queryOne()['userId'];
        if($data['status']==1){
            $user = new User();
            $user->integral($userId,5, '举报获取积分',1);
            $user->integral($author,5, '文章不合法扣除积分',2);
        }
        $model = new Report();
        $re = $model->updateAll($data,'id=:id', array(':id'=> $data['id']));
        if($re){
            $res['code'] = 1;
            $res['message'] = '修改成功';
        } else {
            $res['code'] = 0;
            $res['message'] = '修改失败';
        }
        die(json_encode($res));
    }
}