<?php
/**
 * 首页
 * Created by PhpStorm.
 * User: obelisk
 */
namespace app\modules\cn\controllers;
use app\libs\Method;
use app\modules\cn\models\Category;
use app\modules\cn\models\Gossip;
use app\modules\cn\models\Post;
use yii;
use yii\web\Controller;
use app\libs\Jpush;

class GossipController extends Controller {
    public $enableCsrfValidation = false;
    public $layout=false;

    /**
     * 帖子详情
     * @Obelisk
     */
    public function actionIndex(){
        $id = Yii::$app->request->get('id');
        $model = new Gossip();
        $data = $model->getGossipDetails($id);
        return $this->renderPartial('details',$data);
    }

    /**
     * 帖子详情
     * @Obelisk
     */
    public function actionAddPost(){
        if($_POST){
            $data = Yii::$app->request->post('data');
            $cnContent = strip_tags($data['content']);
            $sign1 = Method::sensitiveWords($cnContent);
            $sign2 = Method::sensitiveWords($data['title']);
            if($sign1['code'] == 0 || $sign2['code' ==0]){

            }
            $imageContent = Method::getStrImage($data['content']);
            $model = new Post();
            $model->title = $data['title'];
            $model->content = $data['content'];
            $model->cnContent = $cnContent;
            $model->imageContent = serialize($imageContent);
            $model->datum = serialize($data['datum']);
            $model->radio = serialize($data['radio']);
            $model->createTime = time();
            $model->dateTime = date("Y-m-d");
            $model->hot = 0;
            $model->catId = $data['catId'];
            $model->viewCount = 0;
            $model->save();
        }else{
            $model = new Category();
            $firstCategory = $model->getAllCatArr(0);
            //var_dump($firstCategory);die;
            return $this->renderPartial('add',['firstCategory' => $firstCategory]);
        }
    }
}