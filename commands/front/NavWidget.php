<?php
/**
 * 主导航菜单组件
 */
namespace app\commands\front;
use yii\base\Widget;
use yii;

;

class NavWidget extends Widget
{
    public $session;
    public $userId;
    public $user;
    public $now_path;
    public $url;

    /**
     * 定义函数
     * */
    public function init()
    {//这个可以取侧边栏数
        $this->udata();
        $this->url();
    }

    /**
     * 运行覆盖程序
     * */
    public function run()
    {
        return $this->render('nav', ['user' => $this->user, 'path' => $this->now_path, 'userId' => $this->userId]);
    }

    public function udata()
    {
        $this->session = Yii::$app->session;
        $this->userId = $this->session->get('userId');
        $this->user = $this->session->get('userData');
    }

    public function url()
    {
        $this->now_path = ltrim($_SERVER['REQUEST_URI'], '/');
    }

}

?>

