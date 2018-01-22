<?php

namespace app\modules\basic\models;

use yii\db\ActiveRecord;

class Block extends ActiveRecord
{
    public static function tableName(){
        return '{{%block}}';
    }

    /**
     * 获取所有模块
     * @param $pid
     * @return mixed
     * @Obelisk
     */
    public function getAllBlock($pid,$status,$data =array()){
        $userId = \Yii::$app->session->get('adminId');
        $block = \Yii::$app->db->createCommand("select b.* from {{%user_block}} ub LEFT JOIN {{%block}} b ON ub.blockId = b.id WHERE ub.userId = $userId AND b.pid=6")->queryAll();
        $objData = $this->find()->where(['pid' => $pid])->all();
        foreach($objData as $k => $v){

            $std = $v['status'] == 1?"显示":"隐藏";
            $data[$k] = $v->attributes;
            $str = "";
            foreach($block as $val){
                if($val['value'] != 'add'){
                    $str .= '<a href="/basic/block/'.$val['value'].'?id='.$v->id.'">'.$val['name'].'</a> ';
                }
            }
            $data[$k]['action'] = $str;
            $data[$k]['status'] = $std;
        }
        foreach($data as $k => $v){
            $childData = $this->getAllBlock($v['id'],$status);
            if(count($childData) > 0){
                $data[$k]['children'] = $childData ;
            }
        }
        return $data;
    }

    /**
     * 获取资源选择菜单
     * @param $pid
     * @param $id
     * @param array $data
     * @return array
     * @Obelisk
     */
    public function getTree($pid,$id,$data =array()){
        $data = \Yii::$app->db->createCommand('select id,name as text from {{%block}} where pid='.$pid)->queryAll();
        if($id){
            $idArr = explode(",",$id);
        }

        foreach($data as $k => $v){
            if($id){
                if(in_array($v['id'],$idArr)){
                    $data[$k]['checked'] = true;
                }
            }
            $childData = $this->getTree($v['id'],$id);
            if(count($childData) > 0){
                $data[$k]['children'] = $childData ;
            }
        }
        return $data;
    }

}
