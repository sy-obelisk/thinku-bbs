<?php
namespace app\modules\cn\models;
use yii\db\ActiveRecord;
class Recommend extends ActiveRecord {
    public $cateData;

    public static function tableName(){
        return '{{%recommend}}';
    }

    public function getRecommend(){
        $data = Recommend::find()->asArray()->select(['id','name'])->where('pid=0')->all();
        foreach($data as $key=>$v){
            $res = Recommend::find()->asArray()->select(['image','url'])->where('pid='.$v['id'])->all();
            $data[$key]['image'] = $res;
        }
        return $data;
    }
}