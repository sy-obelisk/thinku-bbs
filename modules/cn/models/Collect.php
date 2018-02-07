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
        $data['data']= Yii::$app->db->createCommand("SELECT c.name,c.id,u.nickname,c.id,u.userName from {{%user_collection}} uc left join {{%content}} c on uc.userId=c.userId left join {{%user}} u on uc.userId=u.id where userId=$userId limit ($page-1)*$pageSize,$pageSize")->queryAll();
        $data['count']=count(Yii::$app->db->createCommand("SELECT c.name,c.id,u.nickname,c.id,u.userName from {{%user_collection}} uc left join {{%content}} c on uc.userId=c.userId left join {{%user}} u on uc.userId=u.id where userId=$userId")->queryAll());
        $data['page']=$page;
        $data['pageCount']=ceil($data['count']/$pageSize);
        return $data;
    }
//    public function getCollect($userId,$type,$page=1,$pageSize=8){
//        $limit = "limit ".($page-1)*$pageSize.",$pageSize";
//        $sql = "select tc.num, tc.id,tc.contentId,c.pid,tc.createTime from {{%tf_collect}} tc LEFT JOIN {{%content}} c ON tc.contentId=c.id WHERE tc.userId=$userId AND collectType=$type  ORDER BY tc.createTime DESC $limit";
//        $count = "select tc.num, tc.id,tc.contentId,c.pid,tc.createTime from {{%tf_collect}} tc LEFT JOIN {{%content}} c ON tc.contentId=c.id WHERE tc.userId=$userId AND collectType=$type";
//        $data = \Yii::$app->db->createCommand($sql)->queryAll();
//        $count = count(\Yii::$app->db->createCommand($count)->queryAll());
//        $pageModel = new Pager($count,$page,$pageSize);
//        $pageStr = $pageModel->GetPagerContent();
//        foreach($data as $k => $v){
//            $sql = "select (SELECT CONCAT_WS(' ',ce.value,ed.value) From {{%content_extend}} ce left JOIN {{%extend_data}} ed ON ed.extendId=ce.id WHERE ce.contentId = c.id AND ce.code='6d67cf3eba969f1515df48f6f43e740d') as cnName,c.name,c.title,ca.name as catName from {{%content}} c LEFT JOIN {{%category}} ca ON c.catId=ca.id WHERE c.id={$v['pid']}";
//            $contentData = \Yii::$app->db->createCommand($sql)->queryOne();
//            if($contentData && substr($contentData['title'],0,1) == 'C'){
//                $contentData['title'] = 'Conversation '.substr($contentData['title'],1,1);
//            }else{
//                $contentData['title'] = 'Lecture '.substr($contentData['title'],1,1);
//            }
//            $data[$k]['parent'] = $contentData;
//        }
//        return ['data' => $data,'pageStr' => $pageStr];
//    }

}
