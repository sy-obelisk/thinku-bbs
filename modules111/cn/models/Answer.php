<?php 
namespace app\modules\cn\models;
use yii\db\ActiveRecord;
use app\libs\Method;
use app\libs\Pager;
use app\modules\cn\models\HistoryRecord;
use app\modules\cn\models\Content;
class Answer extends ActiveRecord {
    public $cateData;

    public static function tableName(){
            return '{{%answer}}';
    }
    /**
     * 问题回答
     * @return string
     * by yanni
     */
    public function getAnswer($id){
        $data = \Yii::$app->db->createCommand("select u.username,u.image,a.* from {{%answer}} as a LEFT JOIN {{%user}} as u on a.uid=u.uid where id= $id")->queryOne();
        return $data;
    }
}
