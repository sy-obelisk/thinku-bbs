<!DOCTYPE html>
<html>
<head>
    <?php
    $seo = \app\modules\cn\models\Category::getSeoInfo(223);
    ?>
    <title><?php echo $seo['title'] ?></title>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <meta name="keywords" content="<?php echo $seo['keywords'] ?>">
    <meta name="description" content="<?php echo $seo['description'] ?>">
    <link rel="stylesheet" href="/cn/css/StudyAbroadProducts.css"/>
    <link rel="stylesheet" href="/cn/css/fonts/font-awesome/css/font-awesome.min.css"/>
    <script type="text/javascript" src="/cn/js/jquery1.42.min.js"></script>
    <script type="text/javascript" src="/cn/js/jquery.SuperSlide.2.1.1.js"></script>
    <script type="text/javascript" src="/cn/js/public.js"></script>
    <script type="text/javascript" src="/cn/js/index.js"></script>
</head>
<body>
<!-----------------------------头部------------------------------>
<!--头部灰色条-->
<?php use app\commands\front\NavWidget; ?>
<?php NavWidget::begin(); ?>
<?php NavWidget::end(); ?>
<div style="text-align: center">
    <img src="/cn/contact.png">
</div>