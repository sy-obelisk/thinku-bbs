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
        $page = (int)Yii::$app->request->get('page', 1);
        if ($integral < 10) {
            echo '<script>alert("您的等级太低，努力升级吧，少年！")</script>';
            die;
        }
        $keyword = addslashes($keyword);
        $keyword = strip_tags($keyword);
        $pageSize = 15;
        $offset = $pageSize * ($page - 1);
        $data = Yii::$app->db->createCommand("select c.id,c.name,c.abstract,c.viewCount,c.createTime,u.userName,u.nickname,u.image,(SELECT CONCAT_WS(' ',ce.value,ed.value) From {{%content_extend}} ce left JOIN {{%extend_data}} ed ON ed.extendId=ce.id WHERE ce.contentId=c.id AND ce.code='99b3cc02b18ec45447bd9fd59f1cd655')  as listeningFile from {{%content}} c LEFT JOIN {{%user}} u ON u.id=c.userId where name like '%$keyword%' order by id desc limit $offset,$pageSize")->queryAll();
        $count = count(Yii::$app->db->createCommand("select c.id from {{%content}} c LEFT JOIN {{%user}} u ON u.id=c.userId where name like '%$keyword%' order by id desc ")->queryAll());
        foreach ($data as $k => $v) {
            $arr = Yii::$app->db->createCommand("select userName,nickname,ud.createTime from {{%user_discuss}} ud left join {{%user}} u on u.id=ud.userId where ud.contentId=" . $v['id'] . " and ud.pid=0 order by ud.id desc limit 1")->queryOne();
            $data[$k]['last']['name'] = $arr['nickname'] == false ? $arr['userName'] : $arr['nickname'];
            $data[$k]['last']['time'] = substr($arr['createTime'], 0, 10);
            $data[$k]['count'] = count(Yii::$app->db->createCommand("select id from {{%user_discuss}}  where contentId=" . $v['id'] . " and pid=0")->queryAll());

        }
        if ($count != false) {
            $pager = new Pager($count, $page, $pageSize);
            $url = "http://" . $_SERVER['HTTP_HOST'] . "/search.html?keyword=" . $keyword . "&page=";
            $page = $pager->GetPager($url);
        } else {
            $page = '';
        }
        return $this->render('search', ['data' => $data, 'page' => $page]);
    }
}