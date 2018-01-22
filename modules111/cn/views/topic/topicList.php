<!DOCTYPE html>
<html lang="en">
<head>
    <!--阻止浏览器缓存-->
    <meta http-equiv="pragma" content="no-cache">
    <meta http-equiv="Cache-Control" content="no-cache, must-revalidate">
    <meta http-equiv="expires" content="0">
    <!-- Basic Page Needs
     ================================================== -->
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="keywords" content="雷哥培训，GMAT网课，GMAT培训，托福网课，托福培训，雅思网课，雅思培训，零中介留学，美国留学，出国留学，留学申请，留学文书、海外实习">
    <meta name="description" content="雷哥网社团-我们就爱分享知识！留学备考智能服务平台。">
    <meta name="title" content="">
    <meta name="author" content="">
    <meta name="Copyright" content="">
    <meta name="description" content="">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <!-- 让IE浏览器用最高级内核渲染页面 还有用 Chrome 框架的页面用webkit 内核
    ================================================== -->
    <meta http-equiv="X-UA-Compatible" content="chrome=1,IE=edge">
    <!-- IOS6全屏 Chrome高版本全屏
    ================================================== -->
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="mobile-web-app-capable" content="yes">
    <!-- 让360双核浏览器用webkit内核渲染页面
    ================================================== -->
    <meta name="renderer" content="webkit">
    <link rel="stylesheet" href="/cn/css/reset.css">
    <link rel="stylesheet" href="/cn/css/common.css">
    <link rel="stylesheet" href="/cn/css/main.css">
    <link rel="stylesheet" href="/cn/css/topic-gc.css">
    <script src="/cn/js/jquery-1.12.2.min.js"></script>
    <script src="/cn/js/jquery.SuperSlide.2.1.1.js"></script>
    <script src="/cn/js/showImg.js"></script>
    <title>话题广场-雷哥网社团-我们就爱分享知识！</title>
</head>
<body class="bg-f">
<!--搜索-->
<?php use app\commands\front\NavWidget; ?>
<?php NavWidget::begin(); ?>
<?php NavWidget::end(); ?>
<!--当前位置-->
<section>
    <div class="w12 location" style="width: 1100px;">
        <div class="tzTop2">
        <a href="/">首页</a>
    </div>
    </div>
</section>
<section id="topicGc">
    <div class="w12 clearfix" style="width:1100px;padding-top: 15px">
        <div class="fl" style="width: 800px;">
            <div class="zm-topic-cat-title clearfix">
                <h2 class="fl bT"><i class="zg-icon zg-icon-topic-square"></i>话题广场</h2>
<!--                <a class="fr gzing" href="#">已关注7个话题</a>-->
            </div>
<!--            <ul class="topicList clearfix">-->
<!--                --><?php
//                foreach($topic as $v) { ?>
<!--                    <li><a href="/topic/--><?php //echo $v['id'] ?><!--.html">--><?php //echo $v['name'] ?><!--</a></li>-->
<!--                    --><?php
//                }
//                ?>
<!--            </ul>-->
            <ul class="topicWrap-list clearfix">
                <?php
                foreach($topic as $v) { ?>
                <li>
                    <div class="topicImg-left fl">
                        <a href="/topic/<?php echo $v['id'] ?>.html">
                        <img src="<?php echo isset($v['image'])?$v['image']:'/cn/images/8f57b9d21e34c1a2c04877f3d576f7a4_xs.jpg' ?>" alt="">
                        </a>
                    </div>
                    <div class="fl topicList_info">
                        <div class="twName clearfix">
                            <a class="tcName fl" href="/topic/<?php echo $v['id'] ?>.html"><?php echo $v['name'] ?></a>
<!--                            <a class="gz fr" href="/topic/--><?php //echo $v['id'] ?><!--.html"><i class="z-icon-follow"></i>关注</a>-->
                        </div>
                        <p class="ellipsis-2 twDe"><?php echo $v['synopsis'] ?></p>
                    </div>
                </li>
                    <?php
                }
                ?>
            </ul>
        </div>
        <div class="w285 hotGc fr" style="width: 280px;">
            <div class="zm-topic-cat-title clearfix">
                <h2 class="bT">热门话题</h2>
            </div>
            <ul class="hotWrap">
                <?php
                foreach($hotTopic as $h) {
                    ?>
                    <li>
                        <div class="top clearfix">
                            <div class="topicImg fl"><img src="<?php echo isset($h['image']) ? $h['image'] : '/cn/images/c0709cb3e_m.jpg' ?>" alt=""></div>
                            <div class="fl hTit">
                                <div class="hContent"><a href="/topic/<?php echo $h['id'] ?>.html"><?php echo isset($h['name']) ? $h['name'] : '' ?></a>
                                </div>
                                <div class="meta">
                                    <span><?php echo $h['synopsis'] ?></span>
                                </div>
                            </div>
                        </div>
                    </li>
                    <?php
                }
                ?>
            </ul>
            <!--热门课程推荐-->
            <div class="Card">
                <div class="zm-topic-cat-title"> <h2 class="bT">热门课程推荐</h2></div>
                <div class="recommend-wrap">
                    <?php foreach ($curriculum as $v) { ?>
                        <div class="boxWrap slideBox-1">

                            <ul class="banner">
                                <?php
                                foreach ($v['image'] as $i) { ?>
                                    <li>
                                        <a href="<?php echo isset($i['url']) ? $i['url'] : '#' ?>">
                                            <img src="<?php echo isset($i['image']) ? $i['image'] : '/cn/images/r-2.png' ?>"
                                                 alt="">
                                        </a>
                                    </li>
                                    <?php
                                }
                                ?>
                            </ul>
                        </div>
                        <?php
                    }
                    ?>
            </div>
            <!--微信交流群-->
            <div class="exchange-wrap Card slideBox-2">
                <div class="hd">
                    <ul></ul>
                </div>
                <ul class="banner">
                    <?php
                    foreach($qr_code as $v) {
                        ?>
                        <li>
                            <div class="inb erm2-wrap"><img src="<?php echo isset($v['image'])?$v['image']:'' ?>" alt=""></div>
                            <div class="inb erm2-info">
                                <h1 class="ellipsis"><?php echo isset($v['title'])?$v['title']:'' ?></h1>
                                <p class="ellipsis"><?php echo isset($v['title'])?$v['title']:'' ?></p>
                                <a href="<?php echo isset($v['url'])?$v['url']:'' ?>">扫描二维码立即进入</a>
                            </div>
                        </li>
                        <?php
                    }
                    ?>
                </ul>
            </div>
        </div>
    </div>
</section>
<?php use app\commands\front\FooterWidget; ?>
<?php FooterWidget::begin(); ?>
<?php FooterWidget::end(); ?>
</body>
</html>