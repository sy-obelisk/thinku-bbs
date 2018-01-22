<?php
namespace app\modules\user\models;
use yii\db\ActiveRecord;
class UserBlock extends ActiveRecord {
    public static function tableName(){
        return '{{%user_block}}';
    }
}
