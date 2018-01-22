<?php
namespace app\modules\hot\models;
use yii\db\ActiveRecord;
use app\libs\GoodsPager;
class Hot extends ActiveRecord {
    public static function tableName(){
        return '{{%hot}}';
    }
    public function getHotModel(){
        $sql = "select h.id,h.name,h.image,h.url,u.username from {{%hot}} as h LEFT JOIN {{%user}} as u on h.uid=u.uid";
        $data = \Yii::$app->db->createCommand($sql)->queryAll();
//        var_dump($data);die;
        return $data;
    }
}
