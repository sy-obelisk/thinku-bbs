<?php

namespace app\modules\cn\models;
use yii\db\ActiveRecord;
class Category extends ActiveRecord
{
    public $allCatArr = [];
    public static function tableName(){
        return '{{%category}}';
    }

    public function getCategory($catId){
        $arr = [];
        $sign = $this->find()->asArray()->where("id=$catId")->one();
        if($sign['pid']){
            $sign = $this->find()->asArray()->where("id={$sign['pid']}")->one();
            array_unshift($arr,['id' => $sign['id'],'name' => $sign['name']]);
        }
        if($sign['pid']){
            $sign = $this->find()->asArray()->where("id={$sign['pid']}")->one();
            array_unshift($arr,['id' => $sign['id'],'name' => $sign['name']]);
        }
        if($sign['pid']){
            $sign = $this->find()->asArray()->where("id={$sign['pid']}")->one();
            array_unshift($arr,['id' => $sign['id'],'name' => $sign['name']]);
        }
        return $arr;
    }

    public function getCatChild($catId){
        $sign = $this->find()->asArray()->where("pid=$catId AND id !=8 AND id !=29")->all();
        if(empty($sign)){
            $res = $this->find()->asArray()->where("id=$catId")->one();
            $sign = $this->find()->asArray()->where("pid={$res['pid']} AND id !=8 AND id !=29")->all();
        }
        return $sign;
    }

    /**
     * 获取下拉框
     * @param $id
     * @Obelisk
     */
    public function getAllCatArr($id){
        $arr = $this->find()->asArray()->where("pid=$id")->orderBy('sort ASC')->all();
        if($arr){
            $this->allCatArr[] = $arr;
            $this->getFirstCatArr($arr);
        }
        return $this->allCatArr;
    }

    private function getFirstCatArr($arr){
        if(isset($arr[0])){
            $arrNext =  $this->find()->asArray()->where("pid={$arr[0]['id']}")->orderBy('sort ASC')->all();
            if($arrNext){
                $this->allCatArr[] = $arrNext;
                $this->getFirstCatArr($arrNext);
            }
        }
    }
}
