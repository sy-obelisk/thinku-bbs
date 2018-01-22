<?php 
namespace app\modules\cn\models;
use yii\db\ActiveRecord;
class LiveLike extends ActiveRecord {
    public $cateData;

    public static function tableName(){
            return '{{%live_like}}';
    }

}
