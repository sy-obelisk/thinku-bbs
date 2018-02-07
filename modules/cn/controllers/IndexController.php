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
use app\modules\cn\models\Content;

class IndexController extends Controller
{
    public $layout = 'cn.php';
    public $enableCsrfValidation = false;

    public function actionIndex()
    {
        $model=new Content();
        $first='2,3,4,5';
        $data=$model->getList($first);
        $pageStr=$data['pageStr'];
        unset($data['pageStr']);
//        echo '<pre>';
//        var_dump($data);die;
        return $this->render('index',['data'=>$data,'pageStr'=>$pageStr]);
    }

}