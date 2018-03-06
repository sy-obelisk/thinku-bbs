<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/4/21 0021
 * Time: 10:40
 */
namespace app\modules\cn\controllers;

use app\modules\cn\models\UserDiscuss;
use yii;
use yii\web\Controller;
use app\modules\cn\models\Content;

class IndexController extends Controller
{
    public $layout = 'cn.php';
    public $enableCsrfValidation = false;

    public function actionIndex()
    {
        $model = new Content();
        $first = '2,3,4,5,14';
        $data = $model->getList($first);
        $page = $data['page'];
        $data = $data['list'];
        return $this->render('index', ['data' => $data, 'page' => $page]);
    }

    public function actionQuestion()
    {
        $model = new Content();
        $pageSize = 15;
        $page = 1;
        $recommend = $model->getClass(['count' => 1, 'fields' => 'listeningFile', 'category' => 119, 'order' => ' viewCount desc', 'pageSize' => $pageSize, 'page' => 1]);
        $p1['count']=$recommend['count'];
        $p1['pageCount']=$recommend['count']/$pageSize;
        $p1['page']=1;
        unset($recommend['count']);
        $new = $model->getClass(['count' => 1, 'fields' => 'listeningFile', 'category' => 119, 'order' => ' c.id desc', 'pageSize' => $pageSize, 'page' => 1]);
        $p2['count']=$new['count'];
        $p2['pageCount']=$new['count']/$pageSize;
        $p2['page']=1;
        unset($new['count']);
        //等你回答，即没有答案的问题
        $data = $model->getClass([ 'fields' => 'listeningFile', 'category' => 119, 'order' => ' c.id desc', 'limit' => 200]);
        $question = array();
        foreach ($data as $k => $v) {
            $re = UserDiscuss::find()->select('id')->distinct()->where("contentId= ". $v['id'])->limit(1)->one();
            if($re==false){
                $question[] = $data[$k];
            }
        }
        $p3['count']=count($question);
        $p3['pageCount']=$p3['count']/$pageSize;
        $p3['page']=1;
        if($p3['count']>15){
            $question=array_slice($question,0,15);
        }
        return $this->render('question', ['recommend' => $recommend, 'new' => $new, 'question' => $question,'p1'=>$p1,'p2'=>$p2,'p3'=>$p3]);
    }

}