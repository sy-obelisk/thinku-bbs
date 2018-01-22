<?php

namespace app\controllers;

use Yii;
use app\libs\ApiControl;


class IndexController extends ApiControl
{

    public function actionIndex()
    {
        $userId = Yii::$app->session->get('adminId');
        if(!$userId){
            $this->redirect('/user/login/index');
        }else{
            return $this->render('index');
        }
    }
    
    public function actionDown()
    {
        $file_name = "info_check.exe";
        $file_dir = "/public/www/download/";
        if (!file_exists($file_dir . $file_name)) { //检查文件是否存在 
        echo "文件找不到";
        exit;
        } else {
            $file = fopen($file_dir . $file_name,"r"); //打开文件
            //输入文件标签
            Header("Content-type: application/octet-stream");
            Header("Accept-Ranges: bytes");
            Header("Accept-Length: ".filesize($file_dir . $file_name));
            Header("Content-Disposition: attachment; filename=" . $file_name);
            //输出文件内容
            echo fread($file,filesize($file_dir . $file_name));
            fclose($file);
            exit;
        }
        //而如果文件路径是"http"或者"ftp"网址的话，则源代码会有少许改变，程序如下：
        $file_name = "info_check.exe";
        $file_dir = "www.easycn.net/";
        $file = @ fopen($file_dir . $file_name,"r");
        if (!$file) {
            echo "文件找不到";
        } else {
            Header("Content-type: application/octet-stream");
            Header("Content-Disposition: attachment; filename=" . $file_name);
            while (!feof ($file)) {
                echo fread($file,50000);
            }
        fclose ($file);
        }
    }

//    public function actionIndex()
//    {
////        $userId = Yii::$app->session->get('adminId');
////        if(!$userId){
////            $this->redirect('/user/login/index');
////        }else{
////            return $this->render('index');
////        }
//         return $this->renderPartial('index');
//    }
//
//    public function actionAbout()
//    {
////        $userId = Yii::$app->session->get('adminId');
////        if(!$userId){
////            $this->redirect('/user/login/index');
////        }else{
////            return $this->render('index');
////        }
//        return $this->renderPartial('about');
//    }
//
//    public function actionContact()
//    {
////        $userId = Yii::$app->session->get('adminId');
////        if(!$userId){
////            $this->redirect('/user/login/index');
////        }else{
////            return $this->render('index');
////        }
//        return $this->renderPartial('contact');
//    }

}
