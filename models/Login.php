<?php

namespace app\models;

use yii\db\ActiveRecord;

class Login extends ActiveRecord
{
    public static function tableName(){
        return '{{%user}}';
    }
}
