<?php
namespace app\modules\cn\models;
use yii\db\ActiveRecord;
use app\libs\GoodsPager;
class LiveUser extends ActiveRecord {
    public static function tableName(){
        return '{{%live_user}}';
    }

}