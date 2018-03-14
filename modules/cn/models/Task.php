<?php
namespace app\modules\cn\models;

use yii;
use yii\db\ActiveRecord;


class Task extends ActiveRecord
{
    public $cateData;

    public static function tableName()
    {
        return '{{%dailyTask}}';
    }

    /*
     * 查看每日任务是否签到
     * */
    public function todayTask($where){
        $todayTask = Yii::$app->db->createCommand('select signIn from {{%dailyTask}}'.$where)->queryOne();
        return $todayTask;
    }


}
