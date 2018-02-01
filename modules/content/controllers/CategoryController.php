<?php
/**
 * 分类管理
 * Created by PhpStorm.
 * User: Administrator
 * Date: 15-6-17
 * Time: 下午2:37
 */
namespace app\modules\content\controllers;


use yii;
use app\modules\content\models\Category;
use app\modules\content\models\CategoryExtend;
use app\modules\content\models\CategoryTag;
use app\libs\AppControl;
use app\libs\Method;

class CategoryController extends AppControl
{
    public $enableCsrfValidation = false;

    /**
     * 分类列表展示
     * @return string
     * @Obelisk
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    /**
     * 添加分类与其基本信息
     * @return string
     * @Obelisk
     */
    public function actionAdd()
    {
        if ($_POST) {
            $model = new Category();
            $categoryData = Yii::$app->request->post('category');
            $id = Yii::$app->request->post('id');
            if (empty($categoryData['name'])) {
                die('<script>alert("请添加分类名称");history.go(-1);</script>');
            }
            if (empty($categoryData['pid'])) {
                die('<script>alert("请选择父级分类");history.go(-1);</script>');
            }
            if ($id) {
                $extendId = Yii::$app->request->post('key', array());
                $extendValue = Yii::$app->request->post('value', array());
                $re = $model->updateAll($categoryData, 'id = :id', [':id' => $id]);
                foreach ($extendId as $k => $v) {
                    $required = CategoryExtend::findOne($v);
                    if ($required->required == 1) {
                        if (empty($extendValue[$k])) {
                            die('<script>alert("属性值必填");history.go(-1);</script>');
                        }
                        if (!empty($required->requiredValue)) {
                            if (!preg_match("$required->requiredValue", $extendValue[$k])) {
                                die('<script>alert("请输入合法值");history.go(-1);</script>');
                            }
                        }
                    }
                    $skip = CategoryExtend::updateAll(['value' => $extendValue[$k]], 'id = :id', [':id' => $v]);
                    if ($skip) {
                        $re = 1;
                    }
                }
            } else {
                $categoryData['createTime'] = date("Y-m-d H:i:s");
                $categoryData['userId'] = Yii::$app->session->get('adminId');
                $re = Yii::$app->db->createCommand()->insert("{{%category}}", $categoryData)->execute();
            }
            if ($re) {
                echo '<script>alert("成功")</script>';
                $this->redirect('/content/category/index');
            } else {
                echo '<script>alert("失败，请重试");history.go(-1);</script>';
                die;
            }
        } else {
            $pid = Yii::$app->request->get('pid');
            return $this->render('add', ['pid' => $pid]);
        }
    }

    /**
     * 删除分类
     * @return string
     * @Obelisk
     */

    public function actionDelete()
    {
        $id = Yii::$app->request->get('id');
        $model = new Category();
        if ($model->findOne($id)->delete()) {
            $this->redirect('/content/category/index');
        } else {
            echo '<script>alert("失败，请重试");history.go(-1);</script>';
            die;
        }
    }

    /**
     * 修改分类
     * @return string
     * @Obelisk
     */

    public function actionUpdate()
    {
        $id = Yii::$app->request->get('id');
        $model = new Category();
        $extendModel = new CategoryExtend();
        $data = $model->findOne($id);
        $pName = $model->find()->where("id=$data->pid")->one();
        $extend = $extendModel->find()->where('catId=' . $id . ' AND belong="category"')->all();
        return $this->render('add', array('data' => $data, 'pName' => $pName->name, 'extend' => $extend, 'id' => $id));
    }

    /**
     * 分类属性展示
     * @return string
     * @Obelisk
     */
    public function actionCategory()
    {
        $id = Yii::$app->request->get('id');
        $data = Yii::$app->db->createCommand("select a.*,b.name as catName,c.name as codeName from {{%category_extend}} a LEFT JOIN {{%category}} b ON a.catId=b.id LEFT JOIN {{%extend_invoke}} c ON a.code=c.code WHERE a.belong='category' AND a.catId=" . $id)->queryAll();
        foreach ($data as $k => $v) {
            if ($v['inheritId']) {
                $pr = Yii::$app->db->createCommand("select b.id,a.name,b.name as catName from {{%category_extend}} a LEFT JOIN {{%category}} b ON a.catId=b.id  WHERE a.belong='category' AND a.id=" . $v['inheritId'])->queryOne();
                $data[$k]['pr'] = $pr['catName'] . '(' . $pr['id'] . ')' . ';' . $pr['name'] . '(' . $v['inheritId'] . ')';
            }
        }
        return $this->render('extend', array('extend' => $data, 'id' => $id));
    }

    /**
     * 分类内容属性展示
     * @return string
     * @Obelisk
     */
    public function actionContent()
    {
        $id = Yii::$app->request->get('id');
        $data = Yii::$app->db->createCommand("select a.*,b.name as catName,c.name as codeName from {{%category_extend}} a LEFT JOIN {{%category}} b ON a.catId=b.id LEFT JOIN {{%extend_invoke}} c ON a.code=c.code  WHERE a.belong='content' AND a.catId=" . $id)->queryAll();
        foreach ($data as $k => $v) {
            if ($v['inheritId']) {
                $pr = Yii::$app->db->createCommand("select b.id,a.name,b.name as catName from {{%category_extend}} a LEFT JOIN {{%category}} b ON a.catId=b.id  WHERE a.belong='content' AND a.id=" . $v['inheritId'])->queryOne();
                $data[$k]['pr'] = $pr['catName'] . '(' . $pr['id'] . ')' . ';' . $pr['name'] . '(' . $v['inheritId'] . ')';
            }
        }
//        var_dump($data);die;
        return $this->render('content', array('extend' => $data, 'id' => $id));
    }

    /**
     * 内容管理
     * @Obelisk
     */
    public function actionContentIndex()
    {
        $catId = Yii::$app->request->get('catId');
        $this->redirect('/content/content/index?catId=' . $catId);

    }
}