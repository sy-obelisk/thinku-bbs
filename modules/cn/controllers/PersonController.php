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
use app\libs\Pager;
use app\modules\cn\models\Content;

class PersonController extends Controller
{
    public $layout = 'cn.php';
    public $enableCsrfValidation = false;

    public function actionIndex()
    {
        $userId = Yii::$app->session->get('userId', '');
        $page = Yii::$app->request->get('page', 1);
        $pageSize = 10;
        $offset = $pageSize*($page-1);
        if (!$userId) {
            echo "<script>alert('未登录')</script>";
            die;
        }
        $data = Yii::$app->db->createCommand("select u.userName,u.nickname,u.phone,u.email,ue.bathday,ue.address,ue.education,ue.school,ue.id as eid,ue.name From {{%user}} u left join {{%user_extend}} ue on u.id=ue.userId where u.id=$userId ")->queryOne();
        $integral['details'] = Yii::$app->db->createCommand("select id,score,message,createTime,type From {{%integral_details}} where userId=$userId order by id desc limit $offset,$pageSize")->queryAll();
        $integral['count'] = count(Yii::$app->db->createCommand("select id From {{%integral_details}} where userId=$userId")->queryAll());
        $page=$this->actionPage($integral['count'],'/person/',$page,$pageSize);
        $integral['integral'] = Yii::$app->db->createCommand("select integral From {{%user}} where id=$userId")->queryOne()['integral'];
//        var_dump($data);die;
        return $this->render('index', ['data'=>$data,'integral'=>$integral,'page'=>$page]);
    }

    // 我的收藏
    public function actionCollect()
    {
        $userId = Yii::$app->session->get('userId', '');
        $page = Yii::$app->request->get('page', 1);
        $pageSize = 15;
        if (!$userId) {
            echo "<script>alert('未登录')</script>";
            die;
        }
        $collect = new Collect();
        $data = $collect->CollectionList($page, $pageSize);
        $page=$this->actionPage($data['count'],'/collection/',$page,$pageSize);
        return $this->render('collect',['data'=>$data,'page'=>$page]);
    }

    //我的文章
    public function actionArticle()
    {
        $userId = Yii::$app->session->get('userId', '');
        $page = Yii::$app->request->get('page', 1);
        $pageSize = 15;
        if (!$userId) {
            echo "<script>alert('未登录')</script>";
            die;
        }
        $offset = $pageSize * ($page - 1);
        $sql = "select id,name,abstract,viewCount,createTime,image,(SELECT CONCAT_WS(' ',ce.value,ed.value) From {{%content_extend}} ce left JOIN {{%extend_data}} ed ON ed.extendId=ce.id WHERE ce.contentId=c.id AND ce.code='99b3cc02b18ec45447bd9fd59f1cd655')  as listeningFile from {{%content}} c where userId=$userId and catId!=119 order by id DESC,sort ASC";
        $data['count'] = count(Yii::$app->db->createCommand($sql)->queryAll());
        $data['data'] = Yii::$app->db->createCommand($sql . " limit $offset,$pageSize")->queryAll();
        $data['page'] = $page;
        $data['pageCount'] = ceil($data['count'] / $pageSize);
        foreach ($data['data'] as $k => $v) {
            $data['data'][$k]['count'] = count(Yii::$app->db->createCommand("select id from {{%user_discuss}}  where contentId=" . $v['id'] . " and pid=0")->queryAll());
        }
        $page=$this->actionPage($data['count'],'/article/',$page,$pageSize);
        return $this->render('article', ['data'=>$data,'page'=>$page]);

    }

    //我的消息
    public function actionInfo()
    {
        $userId = Yii::$app->session->get('userId', '');
        $page = Yii::$app->request->get('page', 1);
        $pageSize = 15;
        $offset = $pageSize * ($page - 1);
        if (!$userId) {
            echo "<script>alert('未登录')</script>";
            die;
        }
        $arr = Yii::$app->db->createCommand("select news,sendId,n.createTime,status,u.nickname,u.userName,u.image from {{%news}} n left join {{%user}} u on n.sendId=u.id where userId=$userId order by n.id DESC limit $offset,$pageSize")->queryAll();
        $count= count(Yii::$app->db->createCommand("select n.id from {{%news}} n left join {{%user}} u on n.sendId=u.id where userId=$userId order by n.id DESC ")->queryAll());
        $page=$this->actionPage($count,'/info/',$page,$pageSize);
        return $this->render('information', ['arr'=>$arr,'page'=>$page]);
    }

    // 留言板
    public function actionLeave()
    {
        $userId = Yii::$app->request->get('userId');
        $page = Yii::$app->request->get('page',1);
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
        $data['count'] = count(Yii::$app->db->createCommand("$sql")->queryAll());
        $data['data'] = Yii::$app->db->createCommand("$sql limit $offset,$pageSize")->queryAll();
        $page=$this->actionPage($data['count'],'/message-board/',$page,$pageSize);
//        var_dump($data['data']);die;
        return $this->render('leave', ['page'=>$page,'data'=>$data]);
    }

    public function actionShare()
    {
        return $this->render('share');
    }

    public function actionHead()
    {
        $userId = Yii::$app->session->get('userId');
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
        if (!$userId) {
            $data['code'] = 2;
            $data['message'] = '未登录';
            die(json_encode($data));
        }
        $data = Yii::$app->db->createCommand("select integral From {{%user}} where id=$userId ")->queryOne();
        $data['details'] = Yii::$app->db->createCommand("select id,score,message,createTime,type From {{%integral_details}} where userId=$userId order by id desc limit 10")->queryAll();
        return $this->render('score', $data);
    }

    public function actionPage($count,$u,$page,$pageSize=15){
        if ($count != false) {
            $pager = new Pager($count, $page, $pageSize);
            $url = "http://" . $_SERVER['HTTP_HOST'] . "$u" ;
            $page = $pager->GetPager($url);
        } else {
            $page = '';
        }
        return $page;
    }

    public function actionQuestion()
    {
        $userId = Yii::$app->session->get('userId', '');
        $page = Yii::$app->request->get('page', 1);
        $pageSize = 15;
        if (!$userId) {
            echo "<script>alert('未登录')</script>";
            die;
        }
        $model=new Content();
        $list= $model->getClass(['count'=>1,'fields' => 'description','category' =>119,'order'=>'id desc','pageSize' => $pageSize,'page'=>$page]);
        $data['count'] =$list['count'];
        unset($list['count']);
        foreach ($list as $k => $v) {
            $data[$k]['count'] = count(Yii::$app->db->createCommand("select id from {{%user_discuss}}  where contentId=" . $v['id'] . " and pid=0 order by model desc,liked desc ")->queryAll());

            $u = Yii::$app->db->createCommand("select userName,nickname,image from {{%user}}  where id=" . $v['userId'] )->queryOne();
            $data[$k]['comment'] = Yii::$app->db->createCommand("select comment from {{%user_discuss}}  where contentId=" . $v['id'] . " and pid=0 order by model desc,liked desc limit 1")->queryOne()['comment'];
            $data[$k]['userName']=$u['nickname']?$u['nickname']:$u['userName'];
            $data[$k]['image']=$u['image'];
        }
        $page=$this->actionPage($data['count'],'/question/',$page,$pageSize);
//        echo '<pre>';
//        var_dump($data);die;
        return $this->render('question', ['data'=>$data,'page'=>$page,'list'=>$list]);

    }


}