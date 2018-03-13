<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/4/21 0021
 * Time: 10:40
 */
namespace app\modules\cn\controllers;

use yii;
use app\libs\Pager;
use yii\web\Controller;
use app\modules\cn\models\Content;
use app\modules\cn\models\UserDiscuss;

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
        $offer = json_decode(file_get_contents("http://www.thinkwithu.com/cn/api/offer"), true);
        $score = json_decode(file_get_contents("http://www.thinkwithu.com/cn/api/score"), true);
        $report = json_decode(file_get_contents("http://www.thinkwithu.com/cn/api/list?category='178'"), true);
        $info = json_decode(file_get_contents("http://www.thinkwithu.com/cn/api/list?category='88'"), true);
        $question = json_decode(file_get_contents("http://www.thinkwithu.com/cn/api/question"), true);
        $banner = $model->getClass(['fields' => 'url', 'category' => '118,120', 'order' => ' c.id desc', 'limit' => 10]);
//        $class = json_decode(file_get_contents("http://www.shenyou.com/cn/api/public-class"), true);
        return $this->render('index', ['data' => $data, 'page' => $page, 'offer' => $offer, 'score' => $score, 'report' => $report, 'info' => $info, 'question' => $question, 'banner' => $banner]);
//        return $this->render('index', ['data' => $data, 'page' => $page, 'offer' => $offer, 'score' => $score, 'report' => $report, 'info' => $info, 'question' => $question, 'banner' => $banner,'class'=>$class]);
    }

    public function actionQuestion()
    {
        $model = new Content();
        $pageSize = 15;
        $page = 1;
        $recommend = $model->getClass(['count' => 1, 'fields' => 'listeningFile', 'category' => 119, 'order' => ' viewCount desc', 'pageSize' => $pageSize, 'page' => 1]);
        $p1['count'] = $recommend['count'];
        $p1['pageCount'] = $recommend['count'] / $pageSize;
        $p1['page'] = 1;
        unset($recommend['count']);
        $new = $model->getClass(['count' => 1, 'fields' => 'listeningFile', 'category' => 119, 'order' => ' c.id desc', 'pageSize' => $pageSize, 'page' => 1]);
        $p2['count'] = $new['count'];
        $p2['pageCount'] = $new['count'] / $pageSize;
        $p2['page'] = 1;
        unset($new['count']);
        //等你回答，即没有答案的问题
        $data = $model->getClass(['fields' => 'listeningFile', 'category' => 119, 'order' => ' c.id desc', 'limit' => 200]);
        $question = array();
        foreach ($data as $k => $v) {
            $re = UserDiscuss::find()->select('id')->distinct()->where("contentId= " . $v['id'])->limit(1)->one();
            if ($re == false) {
                $question[] = $data[$k];
            }
        }
        $p3['count'] = count($question);
        $p3['pageCount'] = $p3['count'] / $pageSize;
        $p3['page'] = 1;
        if ($p3['count'] > 15) {
            $question = array_slice($question, 0, 15);
        }
        return $this->render('question', ['recommend' => $recommend, 'new' => $new, 'question' => $question, 'p1' => $p1, 'p2' => $p2, 'p3' => $p3]);
    }

    //     下载列表页
    public function actionDown()
    {
        $model = new Content();
        $id = Yii::$app->request->get('cate', '');
        $page = Yii::$app->request->get('page', 1);
        $pageSize = 15;
        $data = $model->getClass(['count' => 1, 'fields' => 'listeningFile,url', 'category' => "$id", 'order' => ' c.id desc', 'page' => $page, 'pageSize' => $pageSize]);
        $count = $data['count'];
        unset($data['count']);

        foreach ($data as $k => $v) {
            $arr = Yii::$app->db->createCommand("select userName,nickname,ud.createTime from {{%user_discuss}} ud left join {{%user}} u on u.id=ud.userId where ud.contentId=" . $v['id'] . " and ud.pid=0 order by ud.id desc limit 1")->queryOne();
            $user = Yii::$app->db->createCommand("select userName,nickname,image from  {{%user}} where id=" . $v['userId'] . " limit 1")->queryOne();
            $data[$k]['userName'] = $user['nickname'] == false ? $user['userName'] : $user['nickname'];
            $data[$k]['image'] = $user['image'];
            $data[$k]['last']['name'] = $arr['nickname'] == false ? $arr['userName'] : $arr['nickname'];
            $data[$k]['last']['time'] = substr($arr['createTime'], 0, 10);
            $data[$k]['count'] = count(Yii::$app->db->createCommand("select id from {{%user_discuss}}  where contentId=" . $v['id'] . " and pid=0")->queryAll());

        }
        if($count!=false){
            $pager = new Pager($count, $page, $pageSize);
            $u = '/down/' . $id . '/';
            $url = "http://" . $_SERVER['HTTP_HOST'] . "$u";
            $p = $pager->GetPager($url);
        }else{
            $p='';
        }
        $nav = array();
        foreach (explode(',', $id) as $k => $v) {
            $nav[$k] = Yii::$app->db->createCommand("SELECT name from  {{%category}} where id=$v order by createTime asc limit 1")->queryOne()['name'];
        }
        return $this->render('downList', ['data' => $data, 'page' => $p, 'nav' => $nav]);
    }

}