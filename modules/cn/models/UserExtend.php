<?php
namespace app\modules\cn\models;

use yii;
use yii\db\ActiveRecord;

class UserExtend extends ActiveRecord
{
    public static function tableName()
    {
        return '{{%user_extend}}';
    }

}
