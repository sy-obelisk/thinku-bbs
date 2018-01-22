<?php
namespace app\modules\content\models;

use yii\db\ActiveRecord;
use app\libs\GoodsPager;
class PostReply extends ActiveRecord
{
    public static function tableName()
    {
        return '{{%post_reply}}';
    }
    public function getPostReply($postId){
        $sql = "select p.id,p.content,p.createTime,u.username from {{%post_reply}} as p LEFT JOIN {{%user}} as u on p.uid=u.uid where postId=$postId";
        $data = \Yii::$app->db->createCommand($sql)->queryAll();
//        var_dump($data);die;
        return $data;
    }
}