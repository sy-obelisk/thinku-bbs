<?php

namespace app\modules\content\models;

use yii\db\ActiveRecord;
use app\libs\GoodsPager;
class TopicQuestion extends ActiveRecord
{
    public static function tableName()
    {
        return '{{%topic_question}}';
    }
}