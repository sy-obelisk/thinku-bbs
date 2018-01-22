<?php 
namespace app\modules\content\models;
use yii\db\ActiveRecord;
class CategoryExtend extends ActiveRecord {
    public $cateData;

    public static function tableName(){
            return '{{%category_extend}}';
    }

    /**
     * 暂时未使用
     * @param $pid
     * @param array $data
     * @return array
     * @Obelisk
     */
    public function getAllExtend($pid,$data =array()){
        $objData = $this->find()->where(['pid' => $pid])->all();
        foreach($objData as $k => $v){
            $data[$k] = $v->attributes;
            $data[$k]['action'] = '<a href="#">分类属性</a> <a href="#">内容属性</a> <a href="">修改</a> <a href="?r=content/extend/delete&id='.$v->id.'">删除</a> ';
        }
        foreach($data as $k => $v){
            $childData = $this->getAllCate($v['id']);
            if(count($childData) > 0){
                $data[$k]['children'] = $childData ;
            }

        }
        return $data;
    }
    public function getTree($pid,$data =array()){
        $data = \Yii::$app->db->createCommand('select id,name as text from {{%category_extend}} where pid='.$pid)->queryAll();
        foreach($data as $k => $v){
            $childData = $this->getTree($v['id']);
            if(count($childData) > 0){
                $data[$k]['children'] = $childData ;
            }

        }
        return $data;
    }
}
