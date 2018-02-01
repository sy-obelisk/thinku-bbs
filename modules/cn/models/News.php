<?php
namespace app\modules\cn\models;

use app\libs\Pager;
use yii\db\ActiveRecord;

class News extends ActiveRecord
{
    public $cateData;

    public static function tableName()
    {
        return '{{%news}}';
    }

//    public function getAllNews($status='',$userId,$page=1,$pageSize=10){
//        if($status){
//            if($status == 1){
//                $status = 'AND status = 1';
//            }
//            if($status == 2){
//                $status = 'AND status = 2';
//            }
//        }
//        $limit = " limit ".($page-1)*$pageSize.",$pageSize";
//        $sql = "select * from {{%news}} WHERE userId=$userId $status order by createTime DESC $limit";
//        $count = "select * from {{%news}} WHERE userId=$userId $status order by createTime DESC";
//        $data = \Yii::$app->db->createCommand($sql)->queryAll();
//        $count = count(\Yii::$app->db->createCommand($count)->queryAll());
//        $pageModel = new Pager($count,$page,$pageSize);
//        $pageStr = $pageModel->GetPagerContent();
//        return ['data' => $data,'count' => $count,'pageStr' => $pageStr];
//    }

}
