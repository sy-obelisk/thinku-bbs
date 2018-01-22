<?php

namespace app\modules\content\models;

use yii\db\ActiveRecord;
use app\libs\GoodsPager;
class Gossip extends ActiveRecord
{
    public static function tableName()
    {
        return '{{%gossip}}';
    }

    public function getGossipList($where,$order,$page,$pageSize){
        $limit = " limit ".($page-1)*$pageSize.",$pageSize";
        $sql = 'select * from {{%gossip}} as g WHERE '.$where;
        $count = count(\Yii::$app->db->createCommand($sql)->queryAll());
        $sql .= $order;
        $sql .= " $limit";
        $data = \Yii::$app->db->createCommand($sql)->queryAll();
        $pageModel = new GoodsPager($count,$page,$pageSize,10);
        $pageStr = $pageModel->GetPagerContent();
        $totalPage = ceil($count/$pageSize);
        return ['totalPage' => $totalPage,'data' => $data,'pageStr' => $pageStr,'count' => $count,'page' => $page];
    }
}