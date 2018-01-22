<?php 
namespace app\modules\cn\models;
use app\modules\content\models\CategoryContent;
use yii\db\ActiveRecord;
use app\libs\Pager;
use app\modules\cn\models\Content;
class TodayTask extends ActiveRecord {
    public $cateData;

    public static function tableName(){
            return '{{%todayTask}}';
    }

    public function todayTask(){
        $session = \Yii::$app->session;
        $time = date("Y-m-d");
        $todayTask = $session->get('todayTask');
        $userId = $session->get('userId');
        if(!$todayTask){
            $todayTask = $this->find()->asArray()->where("time = '$time' AND status = 1")->one();
            if($todayTask){
                $todayTask = json_decode($todayTask['content'],'true');
                $session->set('todayTask',$todayTask);
            }else{
                $grammarLearning = Content::find()->where("catId = 246")->all();
                $grammarLearningArr = [];
                foreach($grammarLearning as $v){
                    $grammarLearningArr[] = $v['id'];
                }
                $grammarLearning = array_rand($grammarLearningArr,1);
                $todayTask['grammarLearning'] = $grammarLearningArr[$grammarLearning];
                $panListensPractice = CategoryContent::find()->where("catId = 38")->all();
                $panListensPracticeArr = [];
                foreach($panListensPractice as $v){
                    $panListensPracticeArr[] = $v['contentId'];
                }
                $panListensPractice = array_rand($panListensPracticeArr,3);
                foreach($panListensPractice as $v){
                    $panListensPracticeNew[] = $panListensPracticeArr[$v];
                }
                $todayTask['panListensPractice'] = $panListensPracticeNew;
                $intensiveListening = Content::find()->where("catId = 248")->all();
                $intensiveListeningArr = [];
                foreach($intensiveListening as $v){
                    $intensiveListeningArr[] = $v['id'];
                }
                $intensiveListening = array_rand($intensiveListeningArr,1);
                $todayTask['intensiveListening'] = $intensiveListeningArr[$intensiveListening];
                $keyWords = Content::find()->where("catId = 249")->all();
                $keyWordsArr = [];
                foreach($keyWords as $v){
                    $keyWordsArr[] = $v['id'];
                }
                $keyWords = array_rand($keyWordsArr,5);
                foreach($keyWords as $v){
                    $keyWordsNew[] = $keyWordsArr[$v];
                }
                $todayTask['keyWords'] = $keyWordsNew;
                $this->content = json_encode($todayTask);
                $this->time =  $time;
                $this->status = 1;
                $this->save();
                $session->set('todayTask',$todayTask);
            }
        }
        if($userId){
            $todayTask = $this->find()->asArray()->where("time = '$time' AND userId=$userId AND status = 2")->one();
            if(!$todayTask){
                $content = [
                    'grammarLearning' =>[
                        'status' => 0,
                        'num' =>  1,
                    ],
                    'panListensPractice' =>[
                        'status' => 0,
                        'num' =>  1,
                    ],
                    'intensiveListening' =>[
                        'status' => 0,
                        'num' =>  1,
                    ],
                    'keyWords' =>[
                        'status' => 0,
                        'num' =>  1,
                    ]
                ];
                $this->content = json_encode($content);
                $this->time =  $time;
                $this->userId =  $userId;
                $this->status = 2;
                $this->save();
            }
        }
    }


}
