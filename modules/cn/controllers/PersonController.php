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
        $model = new Content();
        $data = $model->getList(2);
        $pageStr = $data['pageStr'];
        unset($data['pageStr']);
//        var_dump($data);die;
        return $this->render('index', ['data' => $data, 'pageStr' => $pageStr]);
    }

    // 我的收藏
    public function actionCollect()
    {
//        $userId = Yii::$app->session->get('userId','');
//        $userId = 1;
//        $page=Yii::$app->request->get('page',1);
//        $pageSize= 15;
//        if(!$userId){
//            echo "<script>alert('未登录')</script>";
//            die;
//        }
//        $collect=new Collect();
//        $list=$collect->CollectionList($page,$pageSize);
//        return $this->render('collect',$list);
        return $this->render('collect');
    }

    //我的文章
    public function actionArticle(){
//        $userId=Yii::$app->session->get('userId','');
//        $userId=1;
//        $page=Yii::$app->request->get('page',1);
//        $pageSize= 15;
//        if(!$userId){
//            echo "<script>alert('未登录')</script>";
//            die;
//        }
//        $sql = "select id,name,abstract,viewCount,createTime,(SELECT CONCAT_WS(' ',ce.value,ed.value) From {{%content_extend}} ce left JOIN {{%extend_data}} ed ON ed.extendId=ce.id WHERE ce.contentId=c.id AND ce.code='99b3cc02b18ec45447bd9fd59f1cd655')  as listeningFile from {{%content}} c where userId=$userId order by id DESC,sort ASC";
//        $data['count'] = count(Yii::$app->db->createCommand($sql)->queryAll());
//        $data['data']=Yii::$app->db->createCommand($sql." limit ($page-1)*$pageSize,$pageSize")->queryAll();
//        $data['page']=$page;
//        $data['pageCount']=ceil($data['count']/$pageSize);
//        return $this->render('article',$data);
        return $this->render('article');

    }

    //我的消息
    public function actionInfo(){
        $userId=Yii::$app->session->get('userId','');
        $page=Yii::$app->request->get('page',1);
//        $pageSize= 15;
//        if(!$userId){
//            echo "<script>alert('未登录')</script>";
//            die;
//        }
        return $this->render('information');
    }

    public function actionLeave(){
        return $this->render('leave');
    }
    public function actionShare(){
        return $this->render('share');
    }
    public function actionHead(){
        return $this->render('head');
    }
    public function actionIntegral(){
        return $this->render('score');
    }

}