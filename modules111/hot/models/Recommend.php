<?php
namespace app\modules\hot\models;
use yii\db\ActiveRecord;
use app\libs\GoodsPager;
class Recommend extends ActiveRecord {
    public static function tableName(){
        return '{{%recommend}}';
    }
    public function getRecommendModel($pid){
        $sql = "select r.id,r.name,r.image,r.url,u.username from {{%recommend}} as r LEFT JOIN {{%user}} as u on r.uid=u.uid where pid=$pid";
        $data = \Yii::$app->db->createCommand($sql)->queryAll();
//        var_dump($data);die;
        return $data;
    }
}