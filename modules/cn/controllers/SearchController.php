<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/4/21 0021
 * Time: 10:40
 */
namespace app\modules\cn\controllers;

use yii;
use yii\web\Controller;
use app\libs\Pager;

class SearchController extends Controller
{
    public $layout = 'cn.php';
    public $enableCsrfValidation = false;
    public function actionIndex()
    {
        $keyword = Yii::$app->request->get('keyword', '');
        $integral = Yii::$app->session->get('integral', '');
        $page = Yii::$app->request->get('page', 1);
        if($integral<10){
            echo '<script>alert("您的等级太低，努力升级吧，少年！")</script>';die;
        }
        $keyword  =addslashes($keyword);
        $keyword  =strip_tags($keyword);
        $pagesize=15;
        $offset=$pagesize*($page-1);
        $data = Yii::$app->db->createCommand("select c.id,c.name,c.abstract,c.viewCount,c.createTime,u.userName,u.nickname,u.image,(SELECT CONCAT_WS(' ',ce.value,ed.value) From {{%content_extend}} ce left JOIN {{%extend_data}} ed ON ed.extendId=ce.id WHERE ce.contentId=c.id AND ce.code='99b3cc02b18ec45447bd9fd59f1cd655')  as listeningFile from {{%content}} c LEFT JOIN {{%user}} u ON u.id=c.userId where name like '%$keyword%' order by id desc limit $offset,$pagesize")->queryAll();
        return $this->render('search',$data);
    }
}