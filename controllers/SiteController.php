<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;

class SiteController extends Controller
{
    public function actionIndex()
    {
        $this->redirect('');
        #return $this->render('index');
    }

    public function actionError()
    {

//        $this->redirect('/surprise.html');
        #return $this->render('index');
    }


}
