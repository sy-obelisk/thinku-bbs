<?php
/**
 * 主导航菜单组件
 */
namespace app\commands\background;

use yii\base\Widget;
use yii;

;
use app\models\Block;

class NavWidget extends Widget
{
    public $data;
    public $navData;
    public $blockArr = [];

    /**
     * 定义函数
     * */
    public function init()
    {
        $userId = Yii::$app->session->get('adminId');
        $model = new Block();
        $this->navData = $model->find()->where("pid = 1 AND status = 1")->orderBy('id')->all();
        $userBlock = Yii::$app->db->createCommand("select ub.blockId from {{%user_block}} ub LEFT JOIN {{%block}} b ON ub.blockId = b.id WHERE ub.userId = $userId AND b.pid=1")->queryAll();
        foreach ($userBlock as $v) {
            $this->blockArr[] = $v['blockId'];
        }
    }

    /**
     * 运行覆盖程序
     * */
    public function run()
    {
        return $this->render('nav', ['data' => $this->data, 'navData' => $this->navData, 'blockArr' => $this->blockArr]);
    }
}

?>