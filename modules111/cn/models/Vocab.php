<?php 
namespace app\modules\cn\models;
use yii\db\ActiveRecord;
use app\libs\Pager;
use app\libs\Method;
class Vocab extends ActiveRecord {
    public $cateData;

    public static function tableName(){
            return '{{%user_words}}';
    }

    /**
     * 获取生词列表
     * @Obelisk
     */
    public function getAllVocab($userId,$pageSize,$page){
        $limit = " limit ".($page-1)*$pageSize.",$pageSize";
        $sql = "select startTime,endTime,count(id) as num from {{%user_words}} WHERE userId=$userId GROUP BY startTime ORDER BY startTime DESC $limit";
        $count = "select startTime,endTime,count(id) as num from {{%user_words}} WHERE userId=$userId GROUP BY startTime ORDER BY startTime DESC";
        $data = \Yii::$app->db->createCommand($sql)->queryAll();
        $count = count(\Yii::$app->db->createCommand($count)->queryAll());
        $pageModel = new Pager($count,$page,$pageSize);
        $pageStr = $pageModel->GetPagerContent();
        return ['data' => $data,'pageStr' => $pageStr];
    }

    /**
     * 获取生词本单词
     * @param $keywords
     * @param $userId
     * @param $pageSize
     * @param $page
     * @return array
     * @Obelisk
     */
    public function getWords($keywords,$userId,$pageSize,$page){
        $limit = " limit ".($page-1)*$pageSize.",$pageSize";
        $sql = "select * from {{%user_words}} WHERE userId=$userId AND startTime=$keywords ORDER BY createTime DESC $limit";
        $count = "select * from {{%user_words}} WHERE userId=$userId AND startTime=$keywords ORDER BY createTime DESC";
        $data = \Yii::$app->db->createCommand($sql)->queryAll();
        foreach($data as $k=>$v){
            $data[$k]['translate'] = Method::getTranslate($v['word']);
        }
        $count = count(\Yii::$app->db->createCommand($count)->queryAll());
        $pageModel = new Pager($count,$page,$pageSize);
        $pageStr = $pageModel->GetPagerContent();
        return ['keywords' => $data[0]['startTime'],'data' => $data,'pageStr' => $pageStr,'startTime' => date("Y/m/d",$data[0]['startTime']),'endTime' => date("Y/m/d",$data[0]['endTime'])];
    }
}
