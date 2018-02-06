<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/4/21 0021
 * Time: 10:40
 */
namespace app\modules\cn\controllers;

use app\modules\content\models\Category;
use yii;
use yii\web\Controller;
use app\modules\cn\models\Content;
use app\modules\cn\models\UserDiscuss;
use app\modules\content\models\ExtendData;
use app\modules\content\models\ContentExtend;
use app\modules\content\models\CategoryContent;

class ArticleController extends Controller
{
    public $layout = 'cn.php';
    public $enableCsrfValidation = false;

    public function actionDetails()
    {
        $id = Yii::$app->request->get('id');// 帖子内容的id,评论的id
        $model = new Content();
        $data =  $model->getClass(['fields' => 'listeningFile','where' =>"c.id=$id"])[0];
        $discussModel=new UserDiscuss();
        $discuss = $discussModel->getContentDiscuss($id);//评论
//        echo '<pre>';
//        var_dump($discuss);die;
        $viewCount = $data['viewCount'];
        Content::updateAll(['viewCount' => ($viewCount+1)],"id=$id");
        return $this->render('details',['data'=>$data,'discuss'=>$discuss]);
    }

    public function actionNew()
    {
        return $this->render('new');
    }


}