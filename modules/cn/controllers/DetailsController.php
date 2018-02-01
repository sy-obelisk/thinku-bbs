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
use app\modules\cn\models\Article;

class DetailsController extends Controller
{
  public $layout='cn.php';
  public $enableCsrfValidation = false;
  public function actionDetails()
  {
    return $this->render('index');
  }

}