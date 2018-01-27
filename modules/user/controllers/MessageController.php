<?php
/**
 * 分类管理
 * Created by PhpStorm.
 * User: Administrator
 * Date: 15-6-17
 * Time: 下午2:37
 */
namespace app\modules\user\controllers;


use yii;
use app\libs\Method;
use app\libs\AppControl;
use app\modules\user\models\UserSuggestion;

class MessageController extends AppControl
{
    public $enableCsrfValidation = false;
    //用户列表
//    function init (){
//        parent::init();
//        include_once($_SERVER['DOCUMENT_ROOT'].'/../libs/ucenter/ucenter.php');
//    }
    public function actionIndex()
    {
        $pagesize = 20;
        $page = Yii::$app->request->get('page', 1);
        $offset = $pagesize * ($page - 1);
        $data = Yii::$app->db->createCommand("select id,identity,contact,time,isSolve,message,type from {{%user_suggestion}} order by id desc limit $offset,$pagesize")->queryALL();
        $count = count(Yii::$app->db->createCommand("select id from {{%user_suggestion}} ")->queryALL());
        $page = Method::getPagedRows(['count' => $count, 'pageSize' => $pagesize, 'rows' => 'models']);
        return $this->render('index', ['page' => $page, 'data' => $data]);
    }

    public function actionCheck()
    {

        $data['isSolve'] = Yii::$app->request->post('flag', '');
        $data['id'] = Yii::$app->request->post('id', '');
        $model = new UserSuggestion();
        $re = $model->updateAll($data, 'id=:id', array(':id' => $data['id']));
        if ($re) {
            $res['code'] = 1;
            $res['message'] = '修改成功';
        } else {
            $res['code'] = 0;
            $res['message'] = '修改失败';
        }
        die(json_encode($res));
    }

}