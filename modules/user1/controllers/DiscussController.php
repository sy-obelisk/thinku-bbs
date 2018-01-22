<?php
/**
 * 讨论管理
 * Created by obelisk.
 * Date: 15-6-17
 * Time: 下午2:37
 */
namespace app\modules\user\controllers;


use app\modules\user\models\User;
use yii;
use app\libs\AppControl;
use app\modules\content\models\Content;
use app\modules\user\models\UserDiscuss;
use app\libs\Method;
class DiscussController extends  AppControl{
    public $enableCsrfValidation = false;
    function init (){
        parent::init();
        include_once($_SERVER['DOCUMENT_ROOT'].'/../libs/ucenter/ucenter.php');
    }

    /**
     * 讨论列表
     * @return string
     * @Obelisk
     */
    public function actionIndex()
    {
        $model = new UserDiscuss();
        $page = Yii::$app->request->get('page',1);
        $beginTime = Yii::$app->request->get('beginTime','');
        $endTime = Yii::$app->request->get('endTime','');
        $id  = Yii::$app->request->get('id','');
        $userId  = Yii::$app->request->get('userId','');
        $type  = Yii::$app->request->get('type','');
        $where = "1=1";
        if($beginTime){
            $where .= " AND DATEDIFF(d.createTime,'$beginTime')>0";
        }
        if($endTime){
            $where .= " AND DATEDIFF(d.createTime,'$endTime')<0";
        }
        if($id){
            $where .= " AND d.id = $id";
        }
        if($userId){
            $where .= " AND d.userId = $userId";
        }
        if($type){
            $where .= " AND d.type = $type";
        }
        $discussData = $model->getAllDiscuss($where,20,$page);
        $page = Method::getPagedRows(['count'=>$discussData['count'],'pageSize'=>20, 'rows'=>'models']);
        return $this->render('index',['data' => $discussData['data'],'page' => $page,'block' => $this->block]);
    }

    /**
     * 讨论发布
     * @return string
     * @Obelisk
     */
    public function actionPublish(){
        $idArr  = Yii::$app->request->post('pushId');
        $url = Yii::$app->request->post('url');
        $status = 1;
        $idStr = implode(",",$idArr);
        if($idArr == null){
            die( '<script>alert("请选择讨论");history.go(-1);</script>');
        }
        foreach($idArr as $k=>$v){
            $sign = UserDiscuss::findOne($v);
            if($sign->status != 1 && $sign->type == 1){
                $sign = User::findOne($sign->userId);
                uc_user_edit_integral($sign->userName,'解析被采纳',1,2);
            }
        }
        UserDiscuss::updateAll(['status' => $status],"id in($idStr) AND status != $status");
        $this->redirect($url);

    }

    /**
     * 讨论取消
     * @return string
     * @Obelisk
     */
    public function actionNoPublish(){
        $idArr  = Yii::$app->request->post('pushId');
        $url = Yii::$app->request->post('url');
        $status = 0;
        $idStr = implode(",",$idArr);
        if($idArr == null){
            die( '<script>alert("请选择讨论");history.go(-1);</script>');
        }
        UserDiscuss::updateAll(['status' => $status],"id in($idStr) AND status != $status");
        $this->redirect($url);

    }

    /**
     * 讨论修改
     * @return string
     * @Obelisk
     */
    public function actionUpdate(){
        if($_POST){
            $id = Yii::$app->request->post('id');
            $content = Yii::$app->request->post('content');
            $url = Yii::$app->request->post('url');
            UserDiscuss::updateAll(['discussContent' => $content],"id = $id");
            $this->redirect($url);
        }else{
            $id = Yii::$app->request->get('id');
            $url = $_GET['url'];
            $data = UserDiscuss::findOne($id);
            return $this->render('update',['data' => $data,'url' => $url]);
        }
    }

    /**
     * 讨论删除
     * @return string
     * @Obelisk
     */
    public function actionDelete(){
        $id = Yii::$app->request->get('id');
        $url = $_GET['url'];
        UserDiscuss::findOne($id)->delete();
        $this->redirect($url);

    }



}