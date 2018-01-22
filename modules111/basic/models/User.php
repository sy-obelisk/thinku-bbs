<?php

namespace app\modules\basic\models;

use yii\db\ActiveRecord;

class User extends ActiveRecord
{
    public static function tableName(){
        return '{{%user}}';
    }
}