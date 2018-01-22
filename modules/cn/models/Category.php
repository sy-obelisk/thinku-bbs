<?php 
namespace app\modules\cn\models;
use yii\db\ActiveRecord;
class Category extends ActiveRecord {
    public $cateData;

    public static function tableName(){
            return '{{%category}}';
    }

}
