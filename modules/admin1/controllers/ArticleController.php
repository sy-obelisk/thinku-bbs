<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/4/11 0011
 * Time: 14:04
 */
namespace app\modules\admin\controllers;

use yii;
use app\libs\ApiControl;
use app\modules\admin\models\Article;
use app\libs\GetData;
use app\libs\Pager;

class ArticleController extends ApiControl
{
    public $enableCsrfValidation = false;

    public function actionIndex()
    {
        $pagesize = 15;
        $page = Yii::$app->request->get('p', 1);
        $offset = $pagesize * ($page - 1);
        $count = Yii::$app->db->createCommand("select count(*) as count from {{%article}} ")->queryOne();
        $data= Yii::$app->db->createCommand("select * from {{%article}} order by id desc limit $offset,$pagesize")->queryAll();
        $url='/admin/article/index?p';
        $count = $count['count'];
        $page = new Pager("$url", $count, $page, $pagesize);
        $str = $page->GetPager();
        return $this->render('index', ['str' => $str,'data'=>$data]);
    }

    public function actionAdd()
    {
        $apps = Yii::$app->request;
        if (!$_POST) {
            $id = Yii::$app->request->get('id', '');
            // 取出试卷的名称
//            $arr = Yii::$app->db->createCommand("select * from {{%testpaper}}")->queryAll();
//            var_dump($arr);die;
            if ($id == '') {
                return $this->render('add');
            } else {
                $data= Yii::$app->db->createCommand("select * from {{%article}} where id=" . $id)->queryOne();
                return $this->render('add',['data'=>$data]);
            }
        } else {
            // 添加数据到数据
            $model = new Article();
//            var_dump($_FILES);die;
            $getdata = new GetData();
            $must = array('content' => '内容','title'=>'标题');
            $data = $getdata->PostData($must);
            $data['time']=time();
            $data['hits']=rand(10,100);
            $data['uid']=Yii::$app->session->get('uid','');
            $data['uid']=1;

            if ($data['id'] == '') {
                $re = Yii::$app->db->createCommand()->insert("{{%article}}", $data)->execute();
            } else {
                $re = $model->updateAll($data, 'id=:id', array(':id' => $data['id']));
            }
            if ($re) {
                echo '<script>alert("数据\修改成功")</script>';
                $this->redirect('index');
            } else {
                echo '<script>alert("数据添加\修改失败，请重试");history.go(-1);</script>';
                die;
            }
        }
    }

    // ajax删除数据
    public function actionDel()
    {
        $id = Yii::$app->request->get('id', '');
        $re = Article::deleteAll("id=:id", array(':id' => $id));
        if ($re) {
            echo true;
        }
    }
}
