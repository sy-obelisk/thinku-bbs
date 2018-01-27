<?php
/**
 * 后台控制器基础类
 * by Obelisk
 */
namespace app\libs;

use yii;
use yii\web\Controller;
use app\modules\basic\models\Params;
use app\modules\user\models\UserBlock;
use app\modules\basic\models\Block;

class AppControl extends Controller
{
    public $block;

    /**
     * 权限控制器初始化
     * @Obelisk
     */
    public function init()
    {
        $session = Yii::$app->session;
        $userId = $session->get('adminId');
        if (!$userId) {
            $this->redirect('/user/login/index');
        } else {
            $sign = $this->limitBlock();
            if (!$sign) {
                die('<script>alert("您没有此访问权限");history.go(-1);</script>');
            }
        }
        $this->config();
    }

    /**
     * 定义配置
     * @Obelisk
     */
    public function config()
    {
        define('baseUrl', Yii::$app->params['baseUrl']);
        define('tablePrefix', Yii::$app->db->tablePrefix);
//            $data = Params::find()->all();
//            foreach($data as $v){
//                define($v->key,$v->value);
//            }
    }

    /**
     * 权限拦截
     * @Obelisk
     */
    public function limitBlock()
    {
        $root = Yii::$app->requestedRoute;
        if (substr($root, -1) == "/") {
            $root = substr($root, 0, -1);
        }
        $start = stripos($root, "/");
        $end = strripos($root, "/");
        $session = Yii::$app->session;
        $userId = $session->get('adminId');
        $module = substr($root, 0, $start);
        $controller = substr($root, $start + 1, $end - $start - 1);
        $action = substr($root, $end + 1);
        $module = Block::find()->where("value='$module'")->one();
        $controller = Block::find()->where("value='$controller' AND pid=$module->id")->one();
        if ($action == "index") {
            $sign = UserBlock::find()->where("userId=$userId AND blockId=$controller->id")->one();
        } else {
            $action = Block::find()->where("value='$action' AND pid=$controller->id")->one();
            $sign = UserBlock::find()->where("userId=$userId AND blockId=$action->id")->one();
        }
        $this->block = Yii::$app->db->createCommand("select b.* from {{%user_block}} ub LEFT JOIN {{%block}} b ON ub.blockId = b.id WHERE ub.userId = $userId AND b.status=1 AND b.pid=$controller->id")->queryAll();
        return $sign;
    }
}

?>