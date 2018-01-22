<?php
//模考统计
namespace app\modules\cn\models;

use app\modules\cn\models\Content;
use yii\db\ActiveRecord;
use app\modules\cn\models\HistoryRecord;
use app\libs\Pager;
class TestStatistics extends ActiveRecord
{
    public static function tableName(){
        return '{{%tf_test_statistics}}';
    }

    /**
     * 获取TPO被做次数
     * @param $tpoNumber
     * @Obelisk
     */
    public function getTpoNumber($tpoNumber){
        $data = count($this->find()->where("tpoNumber = $tpoNumber")->all());
        return $data;
    }

    public function getTestResult($id){
        $data = [];
        $statistics = $this->findOne($id);
        $tpoName = Content::findOne($statistics->tpoNumber);
        $tpoName = $tpoName->name;
        $data['tpoName'] = $tpoName;
        $model = new HistoryRecord();
        if($statistics->listen){
            $data['listen'] = $model->getTestResult($id,$statistics->listen);
        }
        if(!$statistics->listen){
            $data['listen'] = 0;
        }
        if($statistics->speaking){
            $data['speaking'] = $model->getSpokenResult($id,$statistics->speaking);
        }
        if(!$statistics->speaking){
            $data['speaking'] = 0;
        }
        if($statistics->read){
            $data['read'] = $model->getReadgResult($id,$statistics->read);
        }
        if(!$statistics->read){
            $data['read'] = 0;
        }
        if($statistics->writing){
            $data['writing'] = $model->getWritingResult($id,$statistics->writing);
        }
        if(!$statistics->writing){
            $data['writing'] = 0;
        }
        return $data;
    }

    /**
     * 获取模考记录
     * @param $userId
     * @param $type
     * @Obelisk
     */
    public function getTestRecord($userId,$type,$pageSize,$page=1){
        $limit = " limit ".($page-1)*$pageSize.",$pageSize";
        $where="";
        if($type==2){
            $where = "AND tts.type=2";
        }
        if($type==3){
            $where = "AND tts.type=1";
        }
        $sql = "select tts.*,c.name from {{%tf_test_statistics}} tts LEFT JOIN {{%content}} c ON tts.tpoNumber=c.id WHERE tts.userId=$userId $where ORDER BY tts.startTime DESC $limit";
        $data = \Yii::$app->db->createCommand($sql)->queryAll();
        $count = "select tts.*,c.name from {{%tf_test_statistics}} tts LEFT JOIN {{%content}} c ON tts.tpoNumber=c.id WHERE tts.userId=$userId $where ORDER BY tts.startTime DESC";
        $count = count(\Yii::$app->db->createCommand($count)->queryAll());
        $pageModel = new Pager($count,$page,$pageSize);
        $pageStr = $pageModel->GetPagerContent();
        foreach($data as $k=>$v){
            if($v['listen']){
                $data[$k]['listen'] = $this->testIsBreak($v['id'],$v['listen']);
            }
            if($v['speaking']){
                $data[$k]['speaking'] = $this->testIsBreak($v['id'],$v['speaking']);
            }
            if($v['read']){
                $data[$k]['read'] = $this->testIsBreak($v['id'],$v['read']);
            }
            if($v['writing']){
                $data[$k]['writing'] = $this->testIsBreak($v['id'],$v['writing']);
            }
        }
        return ['data' => $data,'pageStr' => $pageStr];
    }

    /**判断当前模考是否完成
     * @param $statisticsId
     * @param $testId
     * @return int
     * @Obelisk
     */
    public function testIsBreak($statisticsId,$testId){
        $sign = HistoryRecord::find()->where("isBreak=2 AND statisticsId=$statisticsId AND testId=$testId")->one();
        if($sign){
            return 1;
        }else{
            return 2;
        }
    }

    /**
     * 获取做题数量
     * @Obelisk
     */
    public function getTpoNum($userId){
        $count = $this->find()->where("userId=$userId AND type=2")->count();
        return $count;
    }
}
