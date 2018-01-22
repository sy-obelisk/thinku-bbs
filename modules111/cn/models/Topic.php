<?php

namespace app\modules\cn\models;

use yii\db\ActiveRecord;

class Topic extends ActiveRecord
{
    public static function tableName(){
        return '{{%topic}}';
    }

    public function getTopic($page,$pa){
        $data = \Yii::$app->db->createCommand("select * from {{%topic}} ORDER BY createTime DESC limit $page,$pa")->queryAll();
        return $data;
    }

    public function getHotTopic($where){
        $data = \Yii::$app->db->createCommand("select t.*,que.title from {{%topic}} as t left JOIN {{%topic_question}} as tq on t.id=tq.topicId LEFT JOIN {{%question}} as que on tq.questionId=que.id where $where ORDER BY t.createTime DESC ")->queryAll();
        return $data;
    }
}
