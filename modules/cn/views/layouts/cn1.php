<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <?php
    //    $now_path=ltrim($_SERVER['REQUEST_URI'],'/');
    //    $st =stripos($now_path,'/');
    //    if($st!=false){
    //        $url=substr($now_path,0,($st));
    //    }else{
    //        $st =stripos($now_path,'.');
    //        $url=substr($now_path,0,($st));
    //    }
    //    if($url!='info_details'){
    //    $data = Yii::$app->db->createCommand("select * from {{%seo}} where url='$url'")->queryOne();
    ////        var_dump($url);die;
    //    }else{
    //        $id = Yii::$app->request->get('id', '');
    //        $data = Yii::$app->db->createCommand("select id,title,summary,keywords from {{%info}} where id=" . $id)->queryOne();
    //        $data['description']=$data['summary'];
    //    }
    ////var_dump($data);die;
    //
    //?>
    <title>
        【申友名校论坛】出国留学,名校留学,留学咨询,留学条件,出国游学,美国留学,gmat培训,托福培训,雅思培训
    </title>
    <meta name="keywords" content="【申友名校论坛】出国留学,名校留学,留学咨询,留学条件,出国游学,美国留学,gmat培训,托福培训,雅思培训">
    <meta name="description" content="申友留学,专注商科与STEM留学咨询,提供留学申请一站式服务,是GMAT与托福培训的行业领跑者。申友专注英国、美国、加拿大、澳洲、香港等名校留学申请,留学咨询、出国留学、托福与GMAT培训，尽在申友。">
    <!--阻止浏览器缓存-->
    <meta http-equiv="pragma" content="no-cache">
    <meta http-equiv="Cache-Control" content="no-cache, must-revalidate">
    <meta http-equiv="expires" content="0">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <!--    让IE浏览器用最高级内核渲染页面 还有用 Chrome 框架的页面用webkit 内核-->
    <meta http-equiv="X-UA-Compatible" content="chrome=1,IE=edge">
    <!--    让360双核浏览器用webkit内核渲染页面-->
    <meta name="renderer" content="webkit">
    <script src="/cn/js/jquery-2.1.1.min.js"></script>
    <script src="https://use.fontawesome.com/0e249ab73d.js"></script>
    <script src="/cn/js/jquery.SuperSlide.2.1.js"></script>
    <script src="/cn/js/jqPaginator.min.js"></script>
    <script src="/cn/js/common.js"></script>

    <link rel="stylesheet" href="/cn/css/common.css">
    <link rel="stylesheet" href="/cn/css/iconfont/iconfont.css">
</head>
<body>
<!--导航-->
<?= $content ?>
<!--底部-->
</body>
</html>
