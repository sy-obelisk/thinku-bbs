<?php
namespace app\modules\cn\models;

use yii;
use yii\db\ActiveRecord;


class Collect extends ActiveRecord
{
    public $cateData;

    public static function tableName()
    {
        return '{{%user_collection}}';
    }

    /*
    * 验证是否收藏
    * */
    public function IsCollection($id)
    {
        $userId = Yii::$app->session->get('userId');
        $data = Yii::$app->db->createCommand("SELECT id from {{%user_collection}} where id=$id and userId=$userId")->queryOne();
        if ($data) {
            return true;
        } else {
            return false;
        }
    }

    /*
   * 收藏
   * */
    public function Collection($id)
    {
        $data['userId'] = Yii::$app->session->get('userId');
        $data['contentId'] = $id;
        $data['createTime'] = time();
        $re = Yii::$app->db->createCommand()->insert("{{%user_collection}}", $data)->execute();
        if ($data) {
            return true;
        } else {
            return false;
        }
    }

    /*
    * 收藏记录
    * */
    public function CollectionList($page=1,$pageSize)
    {
        $userId = Yii::$app->session->get('userId');
        $userId = 1;
        $offset = $pageSize * ($page - 1);
//        $data['data']= Yii::$app->db->createCommand("SELECT c.name,c.id,u.nickname,c.id,u.userName from {{%user_collection}} uc left join {{%content}} c on uc.userId=c.userId left join {{%user}} u on uc.userId=u.id where uc.userId=$userId limit $offset,$pageSize")->queryAll();
        $data['data']= Yii::$app->db->createCommand("select c.id,c.name,c.abstract,c.viewCount,c.createTime,u.userName,u.nickname,u.image,(SELECT CONCAT_WS(' ',ce.value,ed.value) From {{%content_extend}} ce left JOIN {{%extend_data}} ed ON ed.extendId=ce.id WHERE ce.contentId=c.id AND ce.code='99b3cc02b18ec45447bd9fd59f1cd655')  as listeningFile from  {{%user_collection}} uc left join {{%content}} c on uc.contentId=c.id LEFT JOIN {{%user}} u ON u.id=c.userId WHERE uc.userId=$userId order by c.id DESC limit $offset,$pageSize")->queryAll();
//        var_dump($data['data']);die;
        $data['count']=count(Yii::$app->db->createCommand("select c.id from  {{%user_collection}} uc left join {{%content}} c on uc.contentId=c.id LEFT JOIN {{%user}} u ON u.id=c.userId WHERE uc.userId=$userId order by c.id DESC ")->queryAll());
        $data['page']=$page;
        $data['pageCount']=ceil($data['count']/$pageSize);
        return $data;
    }

}
