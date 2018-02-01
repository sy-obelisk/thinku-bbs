<?php
namespace app\modules\content\models;

use yii\db\ActiveRecord;

class CategoryContent extends ActiveRecord
{
    public $cateData;

    public static function tableName()
    {
        return '{{%category_content}}';
    }

    public function rules()
    {
        return [
            // username and password are both required
            [['contentId', 'catId'], 'required'],

        ];
    }

    /**
     * 将分类的内容的副分类存储
     * @param $contentId 内容ID
     * @param $category 副分类
     * @Obelisk
     */
    public function secondClass($contentId, $category)
    {
        foreach ($category as $v) {
            $model = new CategoryContent();
            $saveData = [
                'contentId' => $contentId,
                'catId' => $v
            ];
            $model->setAttributes($saveData);
            $model->save();
        }
        return $model->primaryKey;
    }
}
