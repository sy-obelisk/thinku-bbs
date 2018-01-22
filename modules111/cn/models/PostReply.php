<?php
namespace app\modules\cn\models;
use yii\db\ActiveRecord;
use app\libs\Pager;
class PostReply extends ActiveRecord {
    public static function tableName(){
        return '{{%post_reply}}';
    }
}
