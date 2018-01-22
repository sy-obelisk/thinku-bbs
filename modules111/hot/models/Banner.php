<?php
namespace app\modules\hot\models;
use yii\db\ActiveRecord;
use app\libs\GoodsPager;
class Banner extends ActiveRecord {
    public static function tableName(){
        return '{{%banner}}';
    }
    public function getBanner(){
        $sql = "select b.*,u.username from {{%banner}} as b LEFT JOIN {{%user}} as u on b.uid=u.uid";
        $data = \Yii::$app->db->createCommand($sql)->queryAll();
//        var_dump($data);die;
        return $data;
    }
}