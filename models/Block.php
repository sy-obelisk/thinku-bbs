<?php

namespace app\models;

use yii\db\ActiveRecord;

class Block extends ActiveRecord
{
    public static function tableName(){
        return '{{%block}}';
    }
}
