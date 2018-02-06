<?php
namespace app\modules\user\models;

use yii\db\ActiveRecord;

class Report extends ActiveRecord
{
    public static function tableName()
    {
        return '{{%report}}';
    }

    /**
     * 获取所有举报
     * @param $where
     * @param int $pageSize
     * @param int $page
     * @return array
     * @Obelisk
     */

    public function getAllReport($where, $pageSize = 10, $page = 1)
    {
        $limit = "limit " . ($page - 1) * $pageSize . ",$pageSize";
        $data = \Yii::$app->db->createCommand("SELECT r.* from {{%report}} r left join {{%user}} u on r.userId = u.id where " . $where . "  order by r.id DESC " . $limit)->queryAll();
        $count = count(\Yii::$app->db->createCommand("SELECT r.id from {{%report}} r left join {{%user}} u on r.userId = u.id where " . $where . "  order by r.id DESC ")->queryAll());
        return ['data' => $data, 'count' => $count];
    }

}
