<?php
/**
 * 分类管理
 * Created by PhpStorm.
 * User: Administrator
 * Date: 15-6-17
 * Time: 下午2:37
 */
namespace app\modules\user\controllers;


use app\modules\user\models\News;
use app\modules\user\models\User;
use yii;
use app\libs\AppControl;
use app\libs\Method;


class NewsController extends AppControl
{
    public $enableCsrfValidation = false;

    /**
     * 系统消息列表
     * @return string
     * @Obelisk
     */
    public function actionIndex()
    {
        $page = Yii::$app->request->get('page', 1);
        $beginTime = strtotime(Yii::$app->request->get('beginTime', ''));
        $endTime = strtotime(Yii::$app->request->get('endTime', ''));
        $sendId = Yii::$app->request->get('sendId', '');
        $userId = Yii::$app->request->get('userId', '');
        $id = Yii::$app->request->get('id', '');
        $where = "n.type=1";
        if ($beginTime) {
            $where .= " AND n.createTime>=$beginTime";
        }
        if ($endTime) {
            $where .= " AND n.createTime<=$endTime";
        }
        if ($id) {
            $where .= " AND n.id = $id";
        }
        if ($sendId) {
            $where .= " AND n.sendId = $sendId";
        }
        if ($userId) {
            $where .= " AND n.userId = $userId";
        }
        $model = new News();
        $data = $model->getAllNews($where, 10, $page);
        $page = Method::getPagedRows(['count' => $data['count'], 'pageSize' => 20, 'rows' => 'models']);
        return $this->render('news', ['page' => $page, 'data' => $data['data'], 'block' => $this->block]);
    }

    /**
     * 添加消息
     * @return string
     * @Obelisk
     */
    public function actionAdd()
    {
        if ($_POST) {
            $userId = Yii::$app->request->post('userId');
            $beginTime = strtotime(Yii::$app->request->post('beginTime'));
            $endTime = strtotime(Yii::$app->request->post('endTime'));
            $news = Yii::$app->request->post('news', '');
            $adminId = Yii::$app->session->get('adminId');
            if (!$news) {
                die('<script>alert("信息内容不能为空");history.go(-1);</script>');
            }
            $where = "1=1";
            if ($beginTime) {
                $where .= " AND createTime>=$beginTime";
            }
            if ($endTime) {
                $where .= " AND createTime<=$endTime";
            }
            if ($userId) {
                $where .= " AND id = $userId";
            }
            $users = User::find()->where($where)->all();
            foreach ($users as $v) {
                $model = new News();
                $model->news = $news;
                $model->userId = $v['id'];
                $model->status = 1;
                $model->type = 1;
                $model->createTime = time();
                $model->sendId = $adminId;
                $model->save();
            }
            $this->redirect("/user/news/index");
        } else {
            return $this->render('add');
        }
    }


    /**
     * 删除消息
     * @return string
     * @Obelisk
     */
    public function actionDelete()
    {
        $id = Yii::$app->request->get('id');
        $url = $_GET['url'];
        News::findOne($id)->delete();
        $this->redirect($url);
    }
}