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

class IndexController extends Controller
{
    public $layout='cn.php';
    public $enableCsrfValidation = false;
    public function actionIndex()
    {
        $data= Yii::$app->db->createCommand("select * from {{%article}} ")->queryAll();
//        var_dump($data);die;
        return $this->render('index',['data'=>$data]);
    }
    public function actionDownload()
    {

        //根据内容的id，查找文件的地址
        // 再判断下载
        $id = Yii::$app->request->get('id', '');
        $f= 'http://www.lx.com'.Yii::$app->db->createCommand("select file from {{%article}} where id=$id")->queryOne()['file'];
        $n=strrpos($f,'/')+1;
        $fileName=substr($f,$n);
//        var_dump($fileName);die;
//        $file_name = "info_check.exe";
//        $file_dir = "/public/www/download/";
//        if (!file_exists($file_dir . $file_name)) { //检查文件是否存在
//            echo "文件找不到";
//            exit;
//        } else {
//            $file = fopen($file_dir . $file_name,"r"); //打开文件
//        //输入文件标签
//            Header("Content-type: application/octet-stream");
//            Header("Accept-Ranges: bytes");
//            Header("Accept-Length: ".filesize($file_dir . $file_name));
//            Header("Content-Disposition: attachment; filename=" . $file_name);
//        //输出文件内容
//            echo fread($file,filesize($file_dir . $file_name));
//            fclose($file);
//            exit;
//        }
        //而如果文件路径是"http"或者"ftp"网址的话，则源代码会有少许改变，程序如下：
//        $fileDir = "/Upload/file/";
//        var_dump($fileDir . $fileName);die;
        $file =  fopen($f,"r");
//        var_dump($file);die;
        if (!$file) {
            echo "文件找不到";
        } else {
            header("Content-type:application/octet-stream");	//输入文件类型
            header("Accept-Ranges:bytes");
            Header("Content-Disposition: attachment; filename=" . $fileName);
            ob_clean();
            flush();

            while (!feof ($file)) {
                echo fread($file,50000);
            }
            fclose ($file);
        }

    }

}