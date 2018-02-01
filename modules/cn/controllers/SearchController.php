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
        $keyword  =addslashes($keyword);
        $keyword  =strip_tags($keyword);
        $cate = Yii::$app->request->get('c');
        $page = Yii::$app->request->get('p', '1');
        if($keyword){
            $pagesize = 15;
            $p = Yii::$app->request->get('p', 1);
            $offset= $pagesize * ($p - 1);
            if($cate=='i'){
                $data = Yii::$app->db->createCommand("select id,title,summary from {{%info}} where title like '%$keyword%' limit $offset,$pagesize")->queryAll();
                $count= count(Yii::$app->db->createCommand("select id,title,summary from {{%info}} where title like '%$keyword%'")->queryAll());
                $page= new Pager("/search.html?c=i&keyword=$keyword&p", $count,$page, $pagesize);
                $str = $page->GetPager();
            }elseif($cate=='q'){
                $data= Yii::$app->db->createCommand("select q.content,qe.essay,q.id as qid,t.name,t.time,q.number,q.major from {{%questions}} q left join {{%questions_extend}} qe on  qe.id=q.essayId left join {{%testpaper}} t on q.tpId=t.id where content like '%$keyword%' order by q.id desc limit $offset,$pagesize")->queryAll();
                $count= count(Yii::$app->db->createCommand("select q.content,qe.essay,q.id as qid from {{%questions}} q left join {{%questions_extend}} qe on  qe.id=q.essayId where content like '%$keyword%'")->queryAll());
                $page= new Pager("/search.html?c=q&keyword=$keyword&p", $count,$page, $pagesize);
                $str = $page->GetPager();
            }else{
                $data=array();
                $count=0;
            }
        }else{
            $data=array();
            $count='';
            $str='';
        }
        if($count==0)$str='';
        return $this->render('index',['data'=>$data,'str'=>$str]);
    }
}