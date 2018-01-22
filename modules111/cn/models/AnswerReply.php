<?php
namespace app\modules\cn\models;
use yii\db\ActiveRecord;
use app\libs\Method;
use app\libs\Pager;
use app\libs\GoodsPager;
class AnswerReply extends ActiveRecord {
    public $cateData;

    public static function tableName(){
        return '{{%answer_reply}}';
    }

    /**
     * 获取回复->用户
     * @return string
     * by  yanni
     */
    public function getReplyUser($answerId,$page,$pageSize){
        $limit = " limit ".($page-1)*$pageSize.",$pageSize";
        $sql = "select ar.content,ar.createTime,u.username,u.image from {{%answer_reply}} as ar LEFT JOIN {{%user}} as u on ar.uid=u.uid where ar.answerId= $answerId";
        $count = count(\Yii::$app->db->createCommand($sql)->queryAll());
        $sql .= " ORDER BY id desc";
        $sql .= " $limit";
        $data = \Yii::$app->db->createCommand($sql)->queryAll();
        $pageModel = new GoodsPager($count,$page,$pageSize,5);
        $pageStr = $pageModel->GetPagerContent();
        $totalPage = ceil($count/$pageSize);
        return ['totalPage' => $totalPage,'data' => $data,'pageStr' => $pageStr,'count' => $count,'page' => $page];
    }
}