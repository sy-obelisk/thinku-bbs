<?php

namespace app\modules\basic\models;

use yii\db\ActiveRecord;

class Role extends ActiveRecord
{
    public static function tableName(){
        return '{{%role}}';
    }

    public function getPower($id){
        $data = \Yii::$app->db->createCommand("select b.id,b.name from {{%user_control}} ub LEFT JOIN {{%control}} b ON ub.controlId = b.id WHERE ub.roleId = $id AND b.pid=0")->queryAll();
        return $data;
    }
}
