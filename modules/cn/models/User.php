<?php
namespace app\modules\cn\models;

use yii;
use yii\db\ActiveRecord;

class User extends ActiveRecord
{
    public static function tableName()
    {
        return '{{%user}}';
    }

    /*
     * 获取积分
     * */
    public function integral($userId,$num, $msg)
    {
//        $userId = Yii::$app->session->get('userId');
//        $userId =1;
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
        Yii::$app->session->set('integral',$data['integral']);
        if ($re) {
            return true;
        } else {
            return false;
        }
    }

}
