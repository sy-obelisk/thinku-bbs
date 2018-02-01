<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="title" content="留学后台">
    <meta name="description" content="留学后台">
    <meta name="keywords" content="留学后台">
    <meta name="apple-mobile-web-app-capable" content="yes"/>
    <title>留学后台</title>
    <script type="text/javascript" src="/js/jquery-1.7.2.min.js"></script>
    <!-- Le styles -->
    <link href="/css/coreCss/bootstrap-combined.min.css" rel="stylesheet">
    <link href="/css/coreCss/layoutit.css" rel="stylesheet">
    <link href="/css/coreCss/plugin.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="/Uploadify/uploadify.css">
    <!--    <script type="text/javascript" src="/easyui/jquery.min.js"></script>-->

    <script src="/Uploadify/jquery.uploadify.min.js" type="text/javascript"></script>
</head>
<body>
<?php use app\commands\background\NavWidget; ?>
<?php NavWidget::begin(['data' => Yii::$app->controller->module->id]); ?>
<?php NavWidget::end(); ?>
<div class="container-fluid">
    <div class="row-fluid">
        <div class="span2">
            <?php use app\commands\background\LeftWidget; ?>
            <?php LeftWidget::begin(['controller' => Yii::$app->controller->id, 'module' => Yii::$app->controller->module->id]); ?>
            <?php LeftWidget::end(); ?>
            <!-- $content变量的值 就是子页面渲染之后的代码。也就是说子页面中的内容将输出到这个地方-->
        </div>
        <?= $content ?>
    </div>
</div>
</body>
</html>

