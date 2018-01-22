<?php
namespace app\modules\user\models;
use app\modules\cn\models\UserAnswer;
use yii\db\ActiveRecord;
class User extends ActiveRecord {
    public static function tableName(){
        return '{{%user}}';
    }

    public function getAllUser($where,$pageSize = 10,$page =1){
        $limit = "limit ".($page-1)*$pageSize.",$pageSize";
        $data = \Yii::$app->db->createCommand("SELECT u.* from {{%user}} u where ".$where." order by u.createTime DESC ".$limit)->queryAll();
        foreach($data as $k=>$v){
            $data[$k]['questionNum'] = UserAnswer::find()->where('userId='.$v['id'])->count();
        }
        $count = count(\Yii::$app->db->createCommand("SELECT * from {{%user}} u where ".$where." order by createTime DESC ")->queryAll());
        return ['data' => $data,'count' => $count];
    }

    public function getAnswerUser($where,$pageSize = 10,$page =1){
        $limit = "limit ".($page-1)*$pageSize.",$pageSize";
        $data = \Yii::$app->db->createCommand("SELECT u.*,count(ua.id) as questionNum from {{%user_answer}} ua LEFT JOIN {{%user}} u ON u.id=ua.userId where ".$where." group by ua.userId  order by questionNum DESC ".$limit)->queryAll();
        $count = count(\Yii::$app->db->createCommand("SELECT u.*,count(ua.id) as questionNum from {{%user_answer}} ua LEFT JOIN {{%user}} u ON u.id=ua.userId where ".$where." group by ua.userId  order by questionNum DESC ")->queryAll());
        return ['data' => $data,'count' => $count];
    }
}
