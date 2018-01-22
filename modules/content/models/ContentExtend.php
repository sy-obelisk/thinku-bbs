<?php 
namespace app\modules\content\models;
use yii\db\ActiveRecord;
class ContentExtend extends ActiveRecord {
    public $cateData;

    public static function tableName(){
            return '{{%content_extend}}';
    }



}
