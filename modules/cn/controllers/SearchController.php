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
        if($integral<10){
            echo '<script>alert("您的等级太低，努力升级吧，少年！")</script>';die;
        }
        $keyword  =addslashes($keyword);
        $keyword  =strip_tags($keyword);
        return $this->render('search');
    }
}