<?php 
namespace app\modules\content\models;
use yii\db\ActiveRecord;
class ExtendData extends ActiveRecord {

    public static function tableName(){
            return '{{%extend_data}}';
    }


}
