<?php
namespace app\modules\cn\models;
use yii\db\ActiveRecord;
class LiveActivity extends ActiveRecord {
    public $cateData;

    public static function tableName(){
        return '{{%live_activity}}';
    }


}