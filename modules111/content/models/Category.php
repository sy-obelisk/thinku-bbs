<?php

namespace app\modules\content\models;

use yii\db\ActiveRecord;

class Category extends ActiveRecord
{
    public static function tableName(){
        return '{{%category}}';
    }

    public function getCategory(){
        $data = Category::find()->asArray()->where('pid=0')->orderBy('sort DESC')->all();
        foreach($data as $k=>$v){
            $data[$k]['action'] = '<a href="/content/category/lock?id='.$v['id'].'">锁</a>---<a href="/content/category/update?id='.$v['id'].'">修改</a>---<a href="/content/category/notice?id='.$v['id'].'">社团公告</a>---<a href="/content/category/delete?id='.$v['id'].'">删除</a>';
            $data[$k]['createTime'] = date("Y-m-d H:i",$data[$k]['createTime']) ;
            $childData = $this->getSubordinate($v['id']);
            if(count($childData) > 0){
                $data[$k]['children'] = $childData ;
            }
        }
        return $data;
    }
    public function getSubordinate($pid){
        $data = Category::find()->asArray()->where('pid='.$pid)->all();
        foreach($data as $k=>$v){
            $data[$k]['action'] = '<a href="/content/category/lock?id='.$v['id'].'">锁</a>---<a href="/content/category/update?id='.$v['id'].'">修改</a>---<a href="/content/category/notice?id='.$v['id'].'">社团公告</a>---<a href="/content/category/delete?id='.$v['id'].'">删除</a>';
            $data[$k]['createTime'] = date("Y-m-d H:i",$data[$k]['createTime']) ;
            $childData = $this->getSubordinate($v['id']);
            if(count($childData) > 0){
                $data[$k]['children'] = $childData ;
            }
        }
        return $data;
    }

    public function getParentCat($pid,$id){
        $data = \Yii::$app->db->createCommand('select id,name as text from {{%category}} where pid='.$pid)->queryAll();
        if($id){
            $idArr = explode(",",$id);
        }
        foreach($data as $k => $v){
            if($id){
                if(in_array($v['id'],$idArr)){
                    $data[$k]['checked'] = true;
                }
            }
            $childData = $this->getParentCat($v['id'],$id);
            if(count($childData) > 0){
                $data[$k]['children'] = $childData ;
            }
        }
        return $data;
    }
}