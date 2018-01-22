<?php
namespace app\modules\content\models;
use yii\db\ActiveRecord;
class RelatedContent extends ActiveRecord {
    public $cateData;

    public static function tableName(){
        return '{{%related_content}}';
    }



}
