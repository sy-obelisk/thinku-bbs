<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/4/21 0021
 * Time: 10:40
 */
namespace app\modules\cn\controllers;

use app\modules\cn\models\Collect;
use yii;
use yii\web\Controller;
use app\modules\cn\models\Content;

class PersonController extends Controller
{
    public $layout = 'cn.php';
    public $enableCsrfValidation = false;

    public function actionIndex()
    {
        $userId = Yii::$app->session->get('userId', '');
        $userId = 1;
        if (!$userId) {
            echo "<script>alert('未登录')</script>";
            die;
        }
        $data = Yii::$app->db->createCommand("select u.userName,u.nickname,u.phone,u.email,ue.bathday,ue.address,ue.education,ue.school,ue.id as eid From {{%user}} u left join {{%user_extend}} ue on u.id=ue.userId where u.id=$userId ")->queryOne();
        return $this->render('index', $data);
    }

    // 我的收藏
    public function actionCollect()
    {
        $userId = Yii::$app->session->get('userId', '');
        $userId = 1;
        $page = Yii::$app->request->get('page', 1);
        $pageSize = 15;
        if (!$userId) {
            echo "<script>alert('未登录')</script>";
            die;
        }
        $collect = new Collect();
        $data = $collect->CollectionList($page, $pageSize);
        return $this->render('collect', $data);
    }

    //我的文章
    public function actionArticle()
    {
        $userId = Yii::$app->session->get('userId', '');
        $userId = 1;
        $page = Yii::$app->request->get('page', 1);
        $pageSize = 15;
        if (!$userId) {
            echo "<script>alert('未登录')</script>";
            die;
        }
        $offset = $pageSize * ($page - 1);
        $sql = "select id,name,abstract,viewCount,createTime,(SELECT CONCAT_WS(' ',ce.value,ed.value) From {{%content_extend}} ce left JOIN {{%extend_data}} ed ON ed.extendId=ce.id WHERE ce.contentId=c.id AND ce.code='99b3cc02b18ec45447bd9fd59f1cd655')  as listeningFile from {{%content}} c where userId=$userId order by id DESC,sort ASC";
        $data['count'] = count(Yii::$app->db->createCommand($sql)->queryAll());
        $data['data'] = Yii::$app->db->createCommand($sql . " limit $offset,$pageSize")->queryAll();
        $data['page'] = $page;
        $data['pageCount'] = ceil($data['count'] / $pageSize);
        return $this->render('article', $data);

    }

    //我的消息
    public function actionInfo()
    {
        $userId = Yii::$app->session->get('userId', '');
        $userId = 1;
        $page = Yii::$app->request->get('page', 1);
        $pageSize = 15;
        $offset = $pageSize * ($page - 1);
        if (!$userId) {
            echo "<script>alert('未登录')</script>";
            die;
        }
        $arr = Yii::$app->db->createCommand("select news,sendId,n.createTime,status from {{%news}} n left join {{%user}} u on n.sendId=u.id where userId=$userId order by status asc,n.id DESC limit $offset,$pageSize")->queryAll();
//var_dump($arr);die;

        return $this->render('information', $arr);
    }

    // 留言板
    public function actionLeave()
    {
        $userId = Yii::$app->request->get('userId');
        $userId = 1;
        if (!$userId) {
            $data['code'] = 2;
            $data['message'] = '未登录';
            die(json_encode($data));
        }
        $arr = Yii::$app->db->createCommand("select id from {{%content}} where userId=$userId")->queryAll();
        $str = '';
        foreach ($arr as $k => $v) {
            foreach ($v as $val) {
                $str .= $val . ',';
            }
        }
        $page = Yii::$app->request->get('page', 1);
        $pageSize = 15;
        $offset = $pageSize * ($page - 1);
        $str = rtrim($str, ',');
        $sql = "select c.id,comment,ud.createTime,c.name,u.nickname,u.userName From {{%user_discuss}} ud left join {{%content}} c on ud.contentId=c.id left join {{%user}} u on ud.userId=u.id where c.id in ($str) order by ud.id desc";
        $data['count'] = Yii::$app->db->createCommand("$sql")->queryAll();
        $data['data'] = Yii::$app->db->createCommand("$sql limit $offset")->queryAll();
        return $this->render('leave', $data);
    }

    public function actionShare()
    {
        return $this->render('share');
    }

    public function actionHead()
    {
        $userId = Yii::$app->request->get('userId');
        $userId = 1;
        if (!$userId) {
            $data['code'] = 2;
            $data['message'] = '未登录';
            die(json_encode($data));
        }
        $data = Yii::$app->db->createCommand("select image From {{%user}} where id=$userId ")->queryOne();
        return $this->render('head', $data);
    }

    public function actionIntegral()
    {
        $userId = Yii::$app->request->get('userId');
        $userId = 1;
        if (!$userId) {
            $data['code'] = 2;
            $data['message'] = '未登录';
            die(json_encode($data));
        }
        $data = Yii::$app->db->createCommand("select integral From {{%user}} where id=$userId ")->queryOne();
        $data['datails'] = Yii::$app->db->createCommand("select id,score,message,createTime From {{%integral_details}} where userId=$userId order by id desc limit 10")->queryAll();
        return $this->render('score', $data);
    }

}