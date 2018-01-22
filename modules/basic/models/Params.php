<?php

namespace app\modules\basic\models;

use yii\db\ActiveRecord;

class Params extends ActiveRecord
{
    public static function tableName(){
        return '{{%params}}';
    }
}
