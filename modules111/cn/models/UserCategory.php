<?php
namespace app\modules\cn\models;
use yii\db\ActiveRecord;
use app\libs\Method;
use app\libs\Pager;
use app\libs\GoodsPager;
class UserCategory extends ActiveRecord {
    public $cateData;

    public static function tableName(){
        return '{{%user_category}}';
    }

    public function getMembers($catId){
        $sql = "select u.username,u.image from {{%user_category}} as uc LEFT JOIN {{%user}} as u on uc.uid=u.uid where uc.catId= $catId ORDER BY uc.createTime desc limit 0,8";
        $data = \Yii::$app->db->createCommand($sql)->queryAll();
        return $data;
    }
}