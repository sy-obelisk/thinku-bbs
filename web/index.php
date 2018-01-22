<?php
header("Content-Type:text/html;charset=utf-8");
defined('YII_DEBUG') or define('YII_DEBUG', 1);
defined('YII_ENV') or define('YII_ENV', '1');
//
require(__DIR__ . '/../vendor/autoload.php');
require(__DIR__ . '/../vendor/yiisoft/yii2/Yii.php');
$config = require(__DIR__ . '/../config/web.php');

//增加移动端访问代码
//require(__DIR__ . '/../libs/Mobile_Detect.php');
//$detect = new Mobile_Detect;
//$deviceType = ($detect->isMobile() ? ($detect->isTablet() ? 'tablet' : 'phone') : 'computer');
//switch ($deviceType){
//    case 'tablet':
//        header('Location: http://m.thinkwithu.com/');die;
//        break;
//
//    case 'phone':
//        header('Location: http://m.thinkwithu.com/');die;
//        break;
//
//    default:
//        break;
//}

error_reporting(E_ALL);
(new yii\web\Application($config))->run();
