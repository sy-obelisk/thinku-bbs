<?php 
namespace app\modules\cn\models;
use app\modules\cn\models\UserDiscuss;
use app\modules\cn\models\UserAnswer;
use app\modules\cn\models\Collect;
use yii\db\ActiveRecord;
use app\libs\Pager;
use yii;
class LiveLook extends ActiveRecord {
    public $cateData;

    public static function tableName(){
            return '{{%live_look}}';
    }

}
