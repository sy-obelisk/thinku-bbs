<?php

namespace app\modules\content\models;

use yii\db\ActiveRecord;
use app\libs\GoodsPager;
class Answer extends ActiveRecord
{
    public static function tableName()
    {
        return '{{%answer}}';
    }

    public function getAnswerList($where,$order){
        $sql = 'select u.username,a.* from {{%answer}} as a left JOIN {{%user}} as u on a.uid=u.uid WHERE '.$where;
        $sql .= $order;
        $data = \Yii::$app->db->createCommand($sql)->queryAll();
        return $data;
    }
}