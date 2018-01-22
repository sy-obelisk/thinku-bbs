<?php

namespace app\modules\content\models;

use yii\db\ActiveRecord;
use app\libs\GoodsPager;
class Live extends ActiveRecord
{
    public static function tableName()
    {
        return '{{%live_activity}}';
    }
    public function getLiveBroadcast($where,$order,$page,$pageSize){
        $limit = " limit ".($page-1)*$pageSize.",$pageSize";
        $sql = 'select * from {{%live_activity}} as l WHERE '.$where;
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