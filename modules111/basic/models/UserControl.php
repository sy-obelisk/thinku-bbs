<?php

namespace app\modules\basic\models;

use yii\db\ActiveRecord;

class UserControl extends ActiveRecord
{
    public static function tableName(){
        return '{{%user_control}}';
    }
}