<?php
/**
 * 分类管理
 * Created by PhpStorm.
 * User: Administrator
 * Date: 15-6-17
 * Time: 下午2:37
 */
namespace app\modules\user\controllers;


use app\modules\content\models\Content;
use app\modules\user\models\UserAnswer;
use yii;
use app\libs\AppControl;
use app\libs\Method;


class ShareController extends AppControl {
    public $enableCsrfValidation = false;

    /**
     * 用户分享列表
     * @return string
     * @Obelisk
     */
    public function actionIndex()
    {
        $page = Yii::$app->request->get('page',1);
        $questionId = Yii::$app->request->get('questionId','');
        $userId = Yii::$app->request->get('userId','');
        $belong = Yii::$app->request->get('belong','');
        $teacher = Yii::$app->request->get('teacher','');
        $beginTime = strtotime(Yii::$app->request->get('beginTime',''));
        $endTime = strtotime(Yii::$app->request->get('endTime',''));
        $id  = Yii::$app->request->get('id','');
        $where="ua.share=1";
        if($id){
            $where .= " AND ua.id = $id";
        }
        if($beginTime){
            $where .= " AND ua.shareTime>=$beginTime";
        }
        if($endTime){
            $where .= " AND ua.shareTime<=$endTime";
        }
        if($questionId){
            $where .= " AND ua.contentId = $questionId";
        }
        if($userId){
            $where .= " AND ua.userId = $userId";
        }
        if($belong){
            if($belong == 1){
                $where .= " AND (ua.belong='writingIndependent' or ua.belong='writingTpo')";
            }
            if($belong == 2){
                $where .= " AND ua.belong='spoken'";
            }
        }
        if($teacher){
            if($teacher == 1){
                $where .= " AND ua.teacher = $teacher";
            }
            if($teacher == 2){
                $where .= " AND ua.teacher = 0";
            }
        }
        $model = new Content();
//        $data = $model->getAllShare($where,20,$page);
        $data=array();
//        $page = Method::getPagedRows(['count'=>$data['count'],'pageSize'=>20, 'rows'=>'models']);
        return $this->render('share',['data'=>$data,'block' => $this->block]);
    }

    /**
     * 去点评
     * @return string
     * @Obelisk
     */
    public function actionReply(){
        $userId = Yii::$app->request->get('userId','');
        $this->redirect("/user/news/add?userId=$userId");
    }

}