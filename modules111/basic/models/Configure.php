<?php

namespace app\modules\basic\models;

use yii\db\ActiveRecord;

class Configure extends ActiveRecord
{
    public static function tableName(){
        return '{{%configure}}';
    }
}
