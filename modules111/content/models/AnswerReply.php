<?php

namespace app\modules\content\models;

use yii\db\ActiveRecord;
use app\libs\GoodsPager;
class AnswerReply extends ActiveRecord
{
    public static function tableName()
    {
        return '{{%answer_reply}}';
    }

    public function getReplyList($where,$order){
        $sql = 'select u.username,ar.* from {{%answer_reply}} as ar left JOIN {{%user}} as u on ar.uid=u.uid WHERE '.$where;
        $sql .= $order;
        $data = \Yii::$app->db->createCommand($sql)->queryAll();
        return $data;
    }
}