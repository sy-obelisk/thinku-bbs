<?php
/**
 * 后台接口基础类
 * by Obelisk
 */
namespace app\libs;

use yii;
use yii\web\Controller;

class ApiControl extends Controller
{
    public function init()
    {
        $this->config();
        $session = Yii::$app->session;
        $userId = $session->get('adminId');
        // 无登录无法进入后台
        if (!$userId) {
            $this->redirect('/user/login/index');
        }
//               $this->role();
    }

    public function config()
    {
        define('baseUrl', Yii::$app->params['baseUrl']);
        define('tablePrefix', Yii::$app->db->tablePrefix);
    }

    // @$position 使用的位置
    public function upImage($position)
    {
        // 允许上传的图片格式
        $config = array('arr_allow_exts' => array('gif', 'jpg', 'jpeg', 'bmp', 'png'),);
        $up = new \UploadFile($config);
        $savePath = "./Upload/images/" . $position . "/";
        $file = $_FILES['up'];
        $data = $up->uploadOne($file, $savePath);
        // 包含错误信息
        if ($data['arr_data']['int_error']) {
            die('<script>alert("上传文件失败");history.go(-1);</script>');
        } else {
            $a = $data['arr_data']['arr_data'][0];
            $path = ltrim($a['savepath'] . $a['savename'], '.');
            return $path;
        }

    }
}

?>