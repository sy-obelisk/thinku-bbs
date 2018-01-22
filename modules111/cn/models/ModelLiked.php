<?php

namespace app\modules\cn\models;

use yii\db\ActiveRecord;

class ModelLiked extends ActiveRecord
{
    public static function tableName(){
        return '{{%model_essay_liked}}';
    }
}
