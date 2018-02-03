<?php
namespace app\modules\cn\models;

use yii;
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
        $cate = Yii::$app->db->createCommand("select id,name From {{%category}} where pid=0 ")->queryAll();
        return $cate;
    }

    /**
     * 获取子分类
     * @return array
     */
    public function getSonCate($id)
    {
//        if ($id == 2) {
//            $cate = Yii::$app->db->createCommand("select id,name From {{%category}} where pid=14 ")->queryAll();
//        } else {
//            if (in_array($id, array(6, 7, 8, 9, 10, 11, 12, 13))) {
//                $cate = Yii::$app->db->createCommand("select id,name From {{%category}} where pid=15 ")->queryAll();
//            } else {
                $cate = Yii::$app->db->createCommand("select id,name From {{%category}} where pid=$id ")->queryAll();
//            }
//        }
        return $cate;
    }


}
