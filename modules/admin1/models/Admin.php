<?php
namespace app\modules\admin\models;

use yii\db\ActiveRecord;

class Admin extends ActiveRecord
{
    public static function tableName()
    {
        return '{{%admin}}';
    }

    public function getAllAdmin($where, $pageSize = 10, $page = 1)
    {
        $limit = "limit " . ($page - 1) * $pageSize . ",$pageSize";
        $data = \Yii::$app->db->createCommand("SELECT * from {{%admin}} where " . $where . " order by createTime DESC " . $limit)->queryAll();
        $count = count(\Yii::$app->db->createCommand("SELECT * from {{%admin}} where " . $where . " order by createTime DESC ")->queryAll());
        return ['data' => $data, 'count' => $count];
    }
}
