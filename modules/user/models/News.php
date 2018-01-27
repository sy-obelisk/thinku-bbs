<?php
namespace app\modules\user\models;

use app\libs\Pager;
use yii\db\ActiveRecord;

class News extends ActiveRecord
{
    public $cateData;

    public static function tableName()
    {
        return '{{%news}}';
    }

    public function getAllNews($where, $pageSize = 10, $page = 1)
    {
        $limit = "limit " . ($page - 1) * $pageSize . ",$pageSize";
        $data = \Yii::$app->db->createCommand("SELECT n.*  from {{%news}} n LEFT JOIN {{%user}} u ON u.id=n.userId LEFT JOIN {{%user}} us ON us.id=n.sendId where " . $where . " order by n.createTime DESC " . $limit)->queryAll();
        $count = count(\Yii::$app->db->createCommand("SELECT n.* from {{%news}} n LEFT JOIN {{%user}} u ON u.id=n.userId LEFT JOIN {{%user}} us ON us.id=n.sendId where " . $where . " order by n.createTime DESC ")->queryAll());
        return ['data' => $data, 'count' => $count];
    }
}
