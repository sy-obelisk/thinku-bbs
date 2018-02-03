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

class ArticleController extends Controller
{
    public $layout = 'cn.php';
    public $enableCsrfValidation = false;

    public function actionDetails()
    {
        return $this->render('details');
    }

    public function actionNew()
    {
        return $this->render('new');
    }


}