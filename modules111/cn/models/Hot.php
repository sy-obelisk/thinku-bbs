<?php
namespace app\modules\cn\models;
use yii\db\ActiveRecord;
class Hot extends ActiveRecord {
    public $cateData;

    public static function tableName(){
        return '{{%hot}}';
    }


}