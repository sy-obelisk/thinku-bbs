<?php 
namespace app\modules\content\models;
use yii\db\ActiveRecord;
class ExtendInvoke extends ActiveRecord {

    public static function tableName(){
            return '{{%extend_invoke}}';
    }


}
