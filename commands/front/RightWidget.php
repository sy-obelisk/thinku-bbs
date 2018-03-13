<?php
/**
 * 主导航菜单组件
 */
namespace app\commands\front;
use yii;
use yii\base\Widget;
use app\modules\cn\models\Content;

class RightWidget extends Widget
{

    public $number;
    public $isSign;
    public $time;
    public $dayHot;
    public $weekHot;

    /**
     * 定义函数
     * */
    public function init()
    {//这个可以取侧边栏数
        $this->number();
        $this->isSignIn();
        $this->Hot();
    }

    /**
     * 运行覆盖程序
     * */
    public function run()
    {
        return $this->render('right', ['number' => $this->number, 'isSign' => $this->isSign, 'dayHot' => $this->dayHot, 'weekHot' => $this->weekHot]);
    }

    public function number()
    {
        $this->time = date('Y-m-d', time());
        $this->number = count(Yii::$app->db->createCommand("SELECT id from {{%dailytask}} where time='$this->time' and signIn=1")->queryAll());
    }

    public function isSignIn()
    {
        $userId = Yii::$app->session->get('userId', '');
        if($userId){
            $this->isSign = Yii::$app->db->createCommand("SELECT id from {{%dailytask}} where userId=$userId and time='$this->time' and signIn=1")->queryOne();
        }else{
            $this->isSign = 0;
        }

    }

    public function Hot()
    {
        $model = new Content();
        $this->dayHot = $model->getClass(['fields' => 'listeningFile', 'where' => "c.createTime>'" . date('Y-m-d', time())."'", 'order' => ' viewCount desc', 'pageSize' => 15]);
        $this->weekHot = $model->getClass(['fields' => 'listeningFile', 'where' => "c.createTime>'" . date('Y-m-d', mktime(0, 0, 0, date('m'), date('d') - date('w') + 1, date('Y')))."'", 'order' => ' viewCount desc', 'pageSize' => 15]);

    }
}

?>

