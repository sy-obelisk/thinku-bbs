<?php
/**
 * 登录管理
 * Created by PhpStorm.
 * User: Administrator
 * Date: 15-6-17
 * Time: 下午2:37
 */
namespace app\modules\user\controllers;

use yii;
use app\libs\ApiControl;
use app\modules\user\models\User;
use app\modules\user\models\Admin;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;

class LoginController extends ApiControl
{
  public $enableCsrfValidation = false;

  /**
   * 登录界面
   * @return string
   */
  public function actionIndex()
  {
    $session = Yii::$app->session;
    $userId = $session->get('adminId');
    if ($userId) {
      $this->redirect('/index/index');
    } else {
//      return $this->renderPartial('index');die;
      var_dump($this->renderPartial('index'));die;

//      return $this->render('index');

    }
  }



/**
 * 登录验证
 * @return string
 * */
public
function actionCheck()
{
  header('Content-Type:text/html;charset=utf-8');
  $apps = Yii::$app->request;
  $session = Yii::$app->session;
  $logins = new Admin();

  if ($apps->isPost) {
    $userName = $apps->post('userName');
    $userPass = md5($apps->post('userPass'));

    $loginsdata = $logins->find()->where(['userName' => $userName, 'userPass' => $userPass])->one();
    if (!empty($loginsdata['id'])) {
      $session->set('adminId', $loginsdata['id']);
      if ($loginsdata['image'] == null) {
        $loginsdata['image'] = '';
      }
      $session->set('adminData', $loginsdata);
      $this->redirect('/index/index');
    } else {
      echo '<script>alert("帐号或密码不正确");history.go(-1);</script>';
      exit;
    }
  }
}

/**
 * 注销账户
 * @return string
 * */
public
function actionLoginOut()
{
  $session = Yii::$app->session;
  $session->remove('adminData');
  $session->remove('adminId');
  $this->redirect('/user/login');
}

/**生成静态页
 * @Obelisk
 */
public
function actionHtml()
{
  if (@unlink("html\cn\heard.html")) {
    die("<script>history.go(-1) </script>");
  }
}
}