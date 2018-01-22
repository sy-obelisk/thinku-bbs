<?php

/**
 *
 *参数说明：
 *
 *  $file_name  文件名（中英文）
 *  $_SERVER['DOCUMENT_ROOT']  获取apache所在路径
 *
 */
namespace app\modules\cn\models;

use yii\db\ActiveRecord;

class Article extends ActiveRecord
{
    public static function tableName()
    {
        return '{{%article}}';
    }

    function download($file_name)
    {
        //对中文文件名进行转码
        $file_name = iconv("UTF-8", "GB2312", $file_name);
        //文件绝对路径：E:/wamp/www."/Demo/Object/DownfileSource/".qq.txt
        $filepath = $_SERVER['DOCUMENT_ROOT'] . "/Upload/file/" . $file_name;

        if (!file_exists($filepath)) { //检查文件是否存在
            echo "该文件不存在！";
            return;
        }
        $fp = fopen($filepath, 'r');  //打开文件
        $file_size = filesize($filepath);  //计算文件大小
        if ($file_size > 1) {
            echo "<script>window.alert('文件过大，您没权限下载')</script>";
            return;
        }

        //HTTP头部信息
        header("Content-type: application/octet-stream");
        header("Accept-Ranges: bytes");
        header("Accept-Length: " . $file_size);
        header("Content-Disposition: attachment; filename=" . $file_name);

        //输出文件内容 echo fread($fp, $file_size);

        $buffer = 1024;
        //为了下载安全，做一个文件字节读取计数器
        $file_count = 0;
        //判断文件是否结束 feof
        while (!feof($fp) && ($file_size - $file_count > 0)) {

            $file_data = fread($fp, $buffer); //统计读了多少字节
            $file_count += $buffer;

            echo "$file_data"; //把数据会送给浏览器
        }
        fclose($fp);
    }
//调用
//download("qq.txt"); //只需填写文件名即可
}
?>