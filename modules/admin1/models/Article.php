<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/4/6 0006
 * Time: 17:11
 */
namespace app\modules\admin\models;

use yii\db\ActiveRecord;

class Article extends ActiveRecord
{
    public static function tableName()
    {
        return '{{%article}}';
    }

    public function rules()
    {
        return [
            [['content', 'answer', '', 'score'], 'required'],

        ];
    }
}