<?php
namespace app\modules\cn\models;

use yii\db\ActiveRecord;

class Category extends ActiveRecord
{
    public $cateData;

    public static function tableName()
    {
        return '{{%category}}';
    }

    /**
     * 获取全部一级分类
     * @return array
     */
    public function getFirstCate()
    {
        $cate = \Yii::$app->db->createCommand("select id,name From {{%category}} where pid=0 ")->queryAll();
        return $cate;
    }

}
