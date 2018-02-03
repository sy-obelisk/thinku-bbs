<?php
namespace app\modules\content\models;

use yii;
use yii\db\ActiveRecord;

class ContentExtend extends ActiveRecord
{
    public $cateData;

    public static function tableName()
    {
        return '{{%content_extend}}';
    }

    /**
     * 分类内容模板copy
     * @param $contentId 内容ID
     * @param $catId 分类ID
     * @param $extendValue 属性的值
     * @Obelisk
     */
    public function shiftExtend($contentId, $catId, $extendValue, $pid)
    {
        $where = '';
        if ($pid != 0) {
            $where = "AND used = 1";
        }
        $cateExtend = Yii::$app->db->createCommand("select * from {{%category_extend}} WHERE catId=$catId AND belong='content' $where ORDER by id ASC")->queryAll();
        foreach ($cateExtend as $k => $v) {
            $contExtendModel = new ContentExtend();
            $contExtendModel->catExtendId = $v['id'];
            $contExtendModel->contentId = $contentId;
            $contExtendModel->name = $v['name'];
            $contExtendModel->title = $v['title'];
            $contExtendModel->image = $v['image'];
            $contExtendModel->description = $v['description'];
            $contExtendModel->type = $v['type'];
            $contExtendModel->userId = $v['userId'];
            $contExtendModel->createTime = $v['createTime'];
            $contExtendModel->inheritId = $v['inheritId'];
            $contExtendModel->canDelete = $v['canDelete'];
            $contExtendModel->code = $v['code'];
            $contExtendModel->typeValue = $v['typeValue'];
            $contExtendModel->required = $v['required'];
            $contExtendModel->requiredValue = $v['requiredValue'];
            if ($v['required'] == 1) {
                if (empty($extendValue[$k])) {
                    die('<script>alert("属性值必填");history.go(-1);</script>');
                }
                if (!empty($contExtendModel->requiredValue)) {
                    if (!preg_match("{$v['requiredValue']}", $extendValue[$k])) {
                        die('<script>alert("请输入合法值");history.go(-1);</script>');
                    }
                }
            }
            if (!isset($extendValue[$k]{255})) {
                $contExtendModel->value = $extendValue[$k];
            }
            $contExtendModel->save();
            if (isset($extendValue[$k]{255})) {
                $dataModel = new ExtendData();
                $dataModel->extendId = $contExtendModel->primaryKey;
                $dataModel->value = $extendValue[$k];
                $dataModel->save();
            }
        }
    }

}
