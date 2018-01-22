<?php
namespace app\modules\cn\models;
use app\modules\content\models\Answer;
use yii\db\ActiveRecord;
use app\modules\cn\models\Content;
class Question extends ActiveRecord
{
    public static function tableName()
    {
        return '{{%question}}';
    }

    public function getHotQuestion(){
        $data = Question::find()->asArray()->where("id in (2,10)")->orderBy('viewCount desc')->limit(2)->all();
        foreach($data as $key=>$v){
            $res = Answer::find()->asArray()->where('questionId='.$v['id'])->orderBy('createTime desc')->one();
            $data[$key]['answer'] = $res['cnContent'];
        }
        return $data;
    }
}
