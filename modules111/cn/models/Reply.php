<?php 
namespace app\modules\cn\models;
use yii\db\ActiveRecord;
use app\libs\Pager;
use app\modules\cn\models\Content;
class Reply extends ActiveRecord {
    public $cateData;

    public static function tableName(){
            return '{{%reply}}';
    }



}
