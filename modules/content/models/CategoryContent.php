<?php 
namespace app\modules\content\models;
use yii\db\ActiveRecord;
class CategoryContent extends ActiveRecord {
    public $cateData;

    public static function tableName(){
            return '{{%category_content}}';
    }

    public function rules()
    {
        return [
            // username and password are both required
            [['contentId','catId'], 'required'],

        ];
    }
}
