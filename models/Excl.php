<?php
namespace app\models;

use yii\db\ActiveRecord;

class Excl extends ActiveRecord{

    public static function tableName(){
        return '{{%excl}}';
    }
}