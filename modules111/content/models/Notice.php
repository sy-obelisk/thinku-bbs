<?php 
namespace app\modules\content\models;
use yii\db\ActiveRecord;
use app\libs\Pager;
use yii;
class Notice extends ActiveRecord {
    public $cateData;

    public static function tableName(){
            return '{{%notice}}';
    }

}
