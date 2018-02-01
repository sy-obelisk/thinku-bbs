<?php
namespace app\modules\cn\models;

use yii\db\ActiveRecord;

class Like extends ActiveRecord
{
    public $cateData;

    public static function tableName()
    {
        return '{{%like}}';
    }

}
