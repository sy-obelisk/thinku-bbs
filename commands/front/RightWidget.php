<?php
/**
 * 主导航菜单组件
 */
namespace app\commands\front;
use yii\base\Widget;
use yii;

;

class RightWidget extends Widget
{

    public $number;
    public $isSign;
    public $time;
    /**
     * 定义函数
     * */
    public function init()
    {//这个可以取侧边栏数
        $this->number();
        $this->isSignIn();
    }

    /**
     * 运行覆盖程序
     * */
    public function run()
    {
        return $this->render('right',['number'=>$this->number,'isSign'=>$this->isSign]);
    }

    public function number()
    {
        $this->time=date('Y-m-d',time());
        $this->number= count(Yii::$app->db->createCommand("SELECT id from {{%dailytask}} where time=$this->time" )->queryAll());
    }

    public function isSignIn()
    {
        $userId = Yii::$app->session->get('userId','');
        $this->isSign= Yii::$app->db->createCommand("SELECT id from {{%dailytask}} where userId=$userId and time=$this->time" )->queryOne();
    }
}

?>

