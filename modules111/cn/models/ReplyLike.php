<?php 
namespace app\modules\cn\models;
use yii\db\ActiveRecord;
class ReplyLike extends ActiveRecord {
    public $cateData;

    public static function tableName(){
            return '{{%reply_like}}';
    }

}
