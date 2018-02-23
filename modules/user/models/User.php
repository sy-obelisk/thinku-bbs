<?php
namespace app\modules\user\models;

use yii;
use yii\db\ActiveRecord;
use app\modules\cn\models\UserAnswer;

class User extends ActiveRecord
{
    public static function tableName()
    {
        return '{{%user}}';
    }

    public function getAllUser($where, $pageSize = 10, $page = 1)
    {
        $limit = "limit " . ($page - 1) * $pageSize . ",$pageSize";
        $data = \Yii::$app->db->createCommand("SELECT u.* from {{%user}} u where " . $where . " order by u.createTime DESC " . $limit)->queryAll();
        foreach ($data as $k => $v) {
//            $data[$k]['questionNum'] = UserAnswer::find()->where('userId='.$v['id'])->count();
        }
        $count = count(\Yii::$app->db->createCommand("SELECT * from {{%user}} u where " . $where . " order by createTime DESC ")->queryAll());
        return ['data' => $data, 'count' => $count];
    }

    public function getAnswerUser($where, $pageSize = 10, $page = 1)
    {
        $limit = "limit " . ($page - 1) * $pageSize . ",$pageSize";
        $data = \Yii::$app->db->createCommand("SELECT u.*,count(ua.id) as questionNum from {{%user_answer}} ua LEFT JOIN {{%user}} u ON u.id=ua.userId where " . $where . " group by ua.userId  order by questionNum DESC " . $limit)->queryAll();
        $count = count(\Yii::$app->db->createCommand("SELECT u.*,count(ua.id) as questionNum from {{%user_answer}} ua LEFT JOIN {{%user}} u ON u.id=ua.userId where " . $where . " group by ua.userId  order by questionNum DESC ")->queryAll());
        return ['data' => $data, 'count' => $count];
    }

    public function integral($userId, $num, $msg)
    {
        $data = Yii::$app->db->createCommand("SELECT id,integral from {{%user}} where id=$userId")->queryOne();
        $re = User::updateAll(['integral' => $data['integral'] + $num], "id=$userId");
        if ($re) {
            Yii::$app->session->set('integral', $data['integral'] + $num);
            $detailsData['userId'] = $userId;
            $detailsData['score'] = $num;
            $detailsData['message'] = $msg;
            $detailsData['createTime'] = date("Y-m-d H:i:s");
            $re = Yii::$app->db->createCommand()->insert("{{%integral_details}}", $detailsData)->execute();
        }
        $data = Yii::$app->db->createCommand("SELECT id,integral from {{%user}} where id=$userId")->queryOne();
        Yii::$app->session->set('integral', $data['integral']);
        if ($re) {
            return true;
        } else {
            return false;
        }
    }

}
