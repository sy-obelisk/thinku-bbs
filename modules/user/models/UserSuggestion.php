<?php
namespace app\modules\user\models;
use yii\db\ActiveRecord;
class UserSuggestion extends ActiveRecord {
    public static function tableName(){
        return '{{%user_suggestion}}';
    }

}
