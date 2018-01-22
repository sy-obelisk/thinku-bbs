<?php
namespace app\modules\admin\models;

use yii\db\ActiveRecord;
use yii;

class Banner extends ActiveRecord
{
    public static function tableName()
    {
        return '{{%banner}}';
    }

    public function rules()
    {
        return [
            // username and password are both required
            [['pic', 'url'], 'required'],

        ];
    }


}