<?php

namespace app\modules\content\models;

use yii\db\ActiveRecord;
use app\libs\GoodsPager;
class Post extends ActiveRecord
{
    public static function tableName()
    {
        return '{{%post}}';
    }

    public function getPostList($where,$order,$page,$pageSize){
        $limit = " limit ".($page-1)*$pageSize.",$pageSize";
        $sql = 'select p.* from {{%post}} as p WHERE '.$where;
        $count = count(\Yii::$app->db->createCommand($sql)->queryAll());
        $sql .= $order;
        $sql .= " $limit";
        $data = \Yii::$app->db->createCommand($sql)->queryAll();
        foreach($data as $k=>$v){
            $cat=explode(',',$v['catId']);
            if(count($cat)>0){
                foreach($cat as $key=>$va){
                    $class =  \Yii::$app->db->createCommand("select ca.name from {{%category}} as ca WHERE id=$va ")->queryOne();
                    if($key>0){
                        $data[$k]['class'] .=','.$class['name'];
                    } else {
                        $data[$k]['class'] = $class['name'];
                    }
                }
            } else {
                $data[$k]['class'] = '';
            }
        }
        $pageModel = new GoodsPager($count,$page,$pageSize,10);
        $pageStr = $pageModel->GetPagerContent();
        $totalPage = ceil($count/$pageSize);
        return ['totalPage' => $totalPage,'data' => $data,'pageStr' => $pageStr,'count' => $count,'page' => $page];
    }
}