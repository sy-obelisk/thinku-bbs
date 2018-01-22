<?php

namespace app\modules\content\models;

use yii\db\ActiveRecord;
use app\libs\GoodsPager;
class reply extends ActiveRecord
{
    public static function tableName()
    {
        return '{{%reply}}';
    }
}