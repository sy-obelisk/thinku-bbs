<?php 
namespace app\modules\content\models;
use yii\db\ActiveRecord;
class Content extends ActiveRecord {
    public $cateData;

    public static function tableName(){
            return '{{%content}}';
    }


}
