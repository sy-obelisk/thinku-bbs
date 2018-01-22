<?php 
namespace app\modules\user\models;
use app\libs\Pager;
use app\modules\content\models\Content;
use yii\db\ActiveRecord;
class UserDiscuss extends ActiveRecord {
    public static function tableName(){
            return '{{%user_discuss}}';
    }

    /**
     * 获取所有讨论
     * @param $where
     * @param int $pageSize
     * @param int $page
     * @return array
     * @Obelisk
     */

    public function getAllDiscuss($where,$pageSize = 10,$page =1){
        $limit = "limit ".($page-1)*$pageSize.",$pageSize";
        $data = \Yii::$app->db->createCommand("SELECT d.* from ".tablePrefix."user_discuss d left join ".tablePrefix."user u on d.userId = u.id where ".$where."  order by d.createTime DESC ".$limit)->queryAll();
        $count = count(\Yii::$app->db->createCommand("SELECT d.* from ".tablePrefix."user_discuss d left join ".tablePrefix."user u on d.userId = u.id where ".$where."  order by d.createTime DESC ")->queryAll());
        return ['data' => $data,'count' => $count];
    }

}
