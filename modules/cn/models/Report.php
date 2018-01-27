<?php
namespace app\modules\cn\models;

use yii\db\ActiveRecord;

class Report extends ActiveRecord
{
    public $cateData;

    public static function tableName()
    {
        return '{{%report}}';
    }

}
