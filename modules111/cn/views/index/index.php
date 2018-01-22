<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <!--阻止浏览器缓存-->
    <meta http-equiv="pragma" content="no-cache">
    <meta http-equiv="Cache-Control" content="no-cache, must-revalidate">
    <meta http-equiv="expires" content="0">
    <!-- Basic Page Needs
     ================================================== -->
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="keywords" content="雷哥培训，GMAT网课，GMAT培训，托福网课，托福培训，雅思网课，雅思培训，零中介留学，美国留学，出国留学，留学申请，留学文书、海外实习">
    <meta name="description" content="雷哥网社区-我们就爱分享知识！互联网留学备考智能服务平台。">
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
    <link rel="stylesheet" href="/cn/css/swipebox.css">
    <link rel="stylesheet" href="/cn/css/main.css">
    <link rel="stylesheet" href="/cn/css/justifiedgallery.min.css">
    <link rel="stylesheet" href="/cn/css/animate.min.css">
    <script src="/cn/js/jquery-1.12.2.min.js"></script>
    <script src="/cn/js/jquery.swipebox.js"></script>
    <script src="/cn/js/justifiedgallery.js"></script>
    <script src="/cn/js/jquery.SuperSlide.2.1.1.js"></script>
    <script src="/cn/js/showImg.js"></script>
    <title>雷哥网社区-我们就爱分享知识！</title>
</head>
<body id="community">
<!--搜索-->
<?php use app\commands\front\NavWidget; ?>
<?php NavWidget::begin(); ?>
<?php NavWidget::end(); ?>
<!--banner-->
<section style="padding-top: 15px;">
    <div class="w12 banner-wrap clearfix bg-f">
        <div class="left fl">
            <div class="slide-box relative">
                <ul class="banner">
                    <?php foreach ($banner as $b) { ?>
                        <li><a href="<?php echo $b['url'] ?>"><img src="http://bbs.viplgw.cn<?php echo $b['image'] ?>" alt=""></a></li>
                        <?php
                    }
                    ?>
                </ul>
                <a class="crow prev" href="javascript:void (0);"><img src="/cn/images/crw-1.png" alt=""></a>
                <a class="crow next" href="javascript:void (0);"><img src="/cn/images/crw-2.png" alt=""></a>
            </div>
        </div>
        <div class="right fr slide02">
            <ul class="active-list">
                <?php foreach ($gossip as $h) { ?>
                    <li>
                        <div class="a-img fl"><img
                                src="<?php echo '/cn/img/noavatar_big.gif' ?>" alt="图片">
                        </div>
                        <div class="aTit-wrap fr">
                            <a href="/gossip/details/<?php echo $h['id'] ?>.html">
                                <h1 class="a-tit ellipsis">
<!--                                    【<span class="size_8">--><?php //echo isset($h['publisher']) ? $h['publisher'] : '' ?><!--</span>】--><?php //echo base64_decode($h['title']) ?>
                                    【备考八卦】<?php echo base64_decode($h['title']) ?>
                                </h1>
                            </a>
                            <p class="aTime-info"><span class="size_8"><?php echo $h['publisher'] ?></span> 发布于 <?php echo date('Y-m-d', $h['createTime']) ?> 查看：<span class="light"><?php echo $h['viewCount'] ?></span><span class="a-line">|</span>回复：<span class="light"><?php echo $h['replyNum'] ?></span></p>
                            <p class="a-de ellipsis"><?php echo base64_decode($h['content']) ?></p>
                        </div>
                    </li>
                    <?php
                }
                ?>
            </ul>
            <div class="tr moreBtn"><a href="/gossip/list.html">更多></a></div>
            <script>
                jQuery(".slide02").slide({mainCell:".active-list",autoPlay:true,effect:"topMarquee",interTime:50,vis:4,autoPage:true});
            </script>
        </div>
    </div>
</section>
<!--社区内容-->
<section>
    <div class="w12 clearfix content-wrap">
        <div class="left fl">
            <div class="lc-1 bg-f">
                <!--热帖-->
                <div class="lc-tit" style="display: block;">
                    <div class="ic-wrap inb"><img src="/cn/images/ic-2.png" alt=""></div>
                    <span class="lc-tit-word">最新话题</span>
                    <a class="fr more" data-page="10" href="/topic_square.html"> 更多</a>
                </div>
                <div class="topic-list clearfix">
                    <?php foreach ($newTopic as $n) { ?>
                        <a href="/topic/<?php echo $n['id'] ?>.html"><?php echo $n['name'] ?></a>
                        <?php
                    }
                    ?>

                </div>
                <!--话题热门问答-->
                <div class="lc-tit" style="display: block;">
                    <div class="ic-wrap inb"><img src="cn/images/ic-2.png" alt=""></div>
                    <span class="lc-tit-word">热门问答</span>
                    <a class="fr more" href="/topic_square.html"> 更多</a>
                </div>
                <ul class="c1-list clearfix">
                    <?php foreach($hotQuestion as $key=>$v) { ?>
                        <li>
                            <div class="c1-img inb"><img src="/cn/images/knowledge<?php echo $key+1?>.jpg" alt=""></div>
                            <div class="c1-text inb">
                                <a href="/cn/question.html?questionId=<?php echo $v['id'] ?>"><h1 class="c1-tit ellipsis"><?php echo $v['title']?></h1></a>
                                <p class="ellipsis-3 c1-de"><?php echo $v['answer']?></p>
                                <p class="tr cl_topic_de"><a href="/cn/question.html?questionId=<?php echo $v['id'] ?>">详情</a></p>
                            </div>
                        </li>
                        <?php
                    }
                    ?>
                </ul>
                <!--APP下载-->
                <div class="lc-tit" style="display: block;">
                    <div class="ic-wrap inb" style="line-height: 32px"><img src="/cn/images/ic-3.png" alt=""></div>
                    <span class="lc-tit-word">APP下载</span>
                </div>
                <ul class="app-list">
                    <li>
                        <div class="app-img inb">
                            <img src="/cn/images/icon-1.png" alt="">
                            <p>雷哥GMAT</p>
                        </div>
                        <div class="download inb">
                            <!--                            <p class="app-name">GMAT APP</p>-->
                            <div class="inb erm-wrap2">
                                <div class="erm-img2"><img src="/cn/images/erm-1.png" alt=""></div>
                                <div class="logo-wrap">
                                    <img class="logo" src="/cn/images/logo-1.png" alt="">
                                    <span>IOS</span>
                                    <!--                                <div class="erm-wrap"><img src="/cn/images/erm-1.png" alt=""></div>-->
                                </div>
                            </div>
                            <div class="inb erm-wrap2">
                                <div class="erm-img2"><img src="/cn/images/erm-1B.png" alt=""></div>
                                <div class="logo-wrap">
                                    <img class="logo" src="/cn/images/logo-2.png" alt="">
                                    <span>安卓</span>
                                    <!--                                <div class="erm-wrap"><img src="/cn/images/erm-1.png" alt=""></div>-->
                                </div>
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="app-img inb">
                            <img src="/cn/images/icon-2.png" alt="">
                            <p>雷哥托福</p>
                        </div>
                        <div class="download inb">
                            <!--                            <p class="app-name">托福 APP</p>-->
                            <div class="inb erm-wrap2">
                                <div class="erm-img2"><img src="/cn/images-common/toeflQrCode.jpg" alt=""></div>
                                <div class="logo-wrap">
                                    <img class="logo" src="/cn/images/logo-1.png" alt="">
                                    <span>IOS</span>
                                    <!--                                <div class="erm-wrap"><img src="/cn/images/erm-1.png" alt=""></div>-->
                                </div>
                            </div>
                            <!--                            <p class="app-name">托福 APP</p>-->
                            <div class="inb erm-wrap2">
                                <div class="erm-img2"><img src="/cn/images/erm-2B.png" alt=""></div>
                                <div class="logo-wrap">
                                    <img class="logo" src="/cn/images/logo-1.png" alt="">
                                    <span>安卓</span>
                                    <!--                                <div class="erm-wrap"><img src="/cn/images/erm-1.png" alt=""></div>-->
                                </div>
                            </div>
                        </div>

                    </li>
                </ul>
            </div>
            <div class="all-bbs-tiezi">
                <!--社区帖子导航-->
                <div class="bg-f lc-2 bbs-hd">
                    <ul class="post-list tm clearfix">
                        <li>
                            <a href="/#H_all">
                                <div class="postNav-1" id="H_all">
                                    <img src="/cn/images/c-1.png" alt="">
                                    <P>全部帖子</P>
                                </div>
                                <img class="crow-3" src="/cn/images/crow-3.png" alt="">
                            </a>
                        </li>
                        <?php
                        foreach ($firstCategory as $v) {
                            ?>
                            <li <?php echo $pid == $v['id'] ? 'class="on"' : '' ?>>
                                <a href="/post/list/<?php echo $v['id'] ?>.html#<?php echo $v['id'] ?>">
                                    <div class="postNav-1" id="<?php echo $v['id'] ?>">
                                        <img src="<?php echo $v['image'] ?>" alt="">

                                        <P style="color: #444444;"><?php echo $v['name'] ?></P>
                                    </div>
                                    <img class="crow-3" src="/cn/images/crow-3.png" alt="">
                                </a>
                            </li>
                            <?php
                        }
                        ?>
                    </ul>
                </div>
                <div class="bbs-bd">
<!--                    全部帖子-->
                    <ul>
                        <li>
                            <div class="post-nav2">
                                <ul class="post-list2  clearfix" style="display: block">
                                    <li <?php echo $_GET['hot'] == '' ? 'class="on"' : '' ?> id="h_all">
                                        <a href="/post/list/0.html">全部</a>
                                    </li>
                                    <li <?php echo $_GET['hot'] == 1 ? 'class="on"' : '' ?> id="h1">
                                        <a href="/post/list/h-1.html">精华</a>
                                    </li>
                                </ul>
                            </div>
                            <!--            帖子信息-->
                            <div class="chart bg-f">
                                <span>今日新贴：<span class="light"><?php echo $today?></span></span>
                                <span class="pipe">|</span>
                                <span>昨日发贴：<span class="light"><?php echo $lastDay?></span></span>
                                <span class="pipe">|</span>
                                <span>贴子总数：<span class="light"><?php echo $count?></span></span>
                                <!--                <span class="pipe">|</span>-->
                                <!--                <span>欢迎新成员：<span> iblisk</span></span>-->
                            </div>
                            <!--帖子列表-->
                            <div class="bg-f lc-3">
                                <ul class="post-list3">
                                    <?php
                                    foreach ($indexData as $v) {
                                        ?>
                                        <li>
                                            <div class="user-head inb"><img
                                                    src="<?php echo isset($v['image']) ? $v['image'] : '/cn/img/noavatar_big.gif' ?>"
                                                    alt=""></div>
                                            <div class="post-info inb">
                                                <div class="post-tit">
                                                    <span><?php echo $v['catName'] ?></span>
                                                    <?php
                                                    if ($v['hot']) {
                                                        ?>
                                                        <span>HOT</span>
                                                        <?php
                                                    }
                                                    ?>
                                                    <a href="/post/details/<?php echo $v['id'] ?>.html"><?php echo $v['title'] ?></a>
                                                </div>

                                                <div class="publish-info clearfix">

                                                    <!--                                        <span class="author-name">-->
                                                    <?php //echo $v['nickname'] ? $v['nickname'] : $v['userName'] ?><!--</span>-->
                                                    <div class="author-info">
                                                        <span class="author-name"><?php echo $v['nickname'] ? $v['nickname'] : $v['username'] ?></span>
                                                        <span class="show-time">发布于 <?php echo $v['dateTime'] ?></span>
                                                    </div>

                                                    <?php
                                                    if ($v['replySign']) {
                                                        ?>
                                                        <!--                                        <div class="author-info">-->
                                                        <!--                                        <span class="reply-data">--><?php //echo $v['replyName'] ?><!--最后回复于 --><?php //echo date("Y-m-d H:i", $v['replyTime']) ?><!-- </span>-->
                                                        <!--                                        </div>-->
                                                        <div class="author-info">
                                                            <span class="author-date" title=""><?php echo $v['replyName'] ?></span>
                                            <span class="show-time"
                                                  title="09:01">最后回复于&nbsp;<span><?php echo date("Y-m-d H:i", $v['replyTime']) ?></span></span>
                                                        </div>
                                                        <?php
                                                    }
                                                    ?>
                                                    <div class="fans_numbox">
                                                        <span>查看：<span class="light"><?php echo $v['viewCount'] ?></span></span>|
                                                <span>回复：<span class="light"><?php echo $v['replyCount'] ?></span>
                                            </span>
                                                    </div>
                                                </div>
                                                <div class="picturedisplay">
                                                    <div class="thumblist ">
                                                        <?php
                                                        $images = unserialize($v['imageContent']);
                                                        foreach ($images as $val) {
                                                            ?>
                                                            <span onclick="showPicture(this);"><img
                                                                    src="<?php echo $val ?>" alt=""></span>
                                                            <?php
                                                        }
                                                        ?>
                                                    </div>
                                                    <div class="picturebox xs-image">
                                                        <div class="picturecontrol x-act"
                                                             style=" color: #9699a3;    padding-bottom: 20px;">
                                                            <a class="x-btn" onclick="closePicture(this);"
                                                               href="javascript:;">
                                                                <img src="/cn/images/Icon_shouqi.png">
                                                                收起

                                                            </a>
                                                            &nbsp;&nbsp;&nbsp;

                                                            <a class="icon_viewlarge x-btn" href="#" target="_blank">
                                                                <img src="/cn/images/Icon_chakandatu.png">
                                                                查看大图</a>
                                                            &nbsp;&nbsp;&nbsp;

                                                            <a class="icon_turnleft x-btn" onclick="turnImg(this);" href="javascript:;">
                                                                <img src="/cn/images/Icon_xuanzhuan.png">
                                                                旋转
                                                            </a>

                                                        </div>
                                                        <div class="bigpicture">
                                                            <div class="picturewrap" onclick="closePicture(this);"
                                                                 style="margin: 20px;">
                                                                <img deg="0" class="picture" src="/cn/images/nopic.jpg">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <p class="post-de"><?php echo $v['cnContent'] ?></p>

                                            </div>
                                        </li>
                                        <?php
                                    }
                                    ?>
                                </ul>
                                <div class="show-more tm">
                                    <a href="/post/list/<?php if($selectId != 0 || $_GET['hot']==''){echo $selectId; } else{echo 'h-'.$_GET['hot']; } ?>.html">查看更多>></a>
                                </div>
                            </div>
                        </li>
                    </ul>
 <!--                    留学社团-->
                    <?php
                        foreach($allRow as $k => $value) {
                            ?>
                            <ul>
                                <li>
                                    <div class="post-nav2">
                                            <ul class="post-list2  clearfix" style="display: block">
                                                <?php
                                                foreach ($value['second'] as $v) {
                                                    ?>
                                                    <li>
                                                        <a href="/post/list/<?php echo $v['id'] ?>.html"><?php echo $v['name'] ?></a>
                                                    </li>
                                                <?php
                                                }
                                                ?>
                                            </ul>
                                    </div>
                                    <!--            帖子信息-->
                                    <div class="chart bg-f">
                                        <span>今日新贴：<span class="light"><?php echo $today?></span></span>
                                        <span class="pipe">|</span>
                                        <span>昨日发贴：<span class="light"><?php echo $lastDay?></span></span>
                                        <span class="pipe">|</span>
                                        <span>贴子总数：<span class="light"><?php echo $count?></span></span>
                                        <!--                <span class="pipe">|</span>-->
                                        <!--                <span>欢迎新成员：<span> iblisk</span></span>-->
                                    </div>
                                    <!--帖子列表-->
                                    <div class="bg-f lc-3">
                                        <ul class="post-list3">
                                            <?php
                                            foreach ($value['data'] as $v) {
                                                ?>
                                                <li>
                                                    <div class="user-head inb"><img
                                                            src="<?php echo isset($v['image']) ? $v['image'] : '/cn/img/noavatar_big.gif' ?>"
                                                            alt=""></div>
                                                    <div class="post-info inb">
                                                        <div class="post-tit">
                                                            <span><?php echo $v['catName'] ?></span>
                                                            <?php
                                                            if ($v['hot']) {
                                                                ?>
                                                                <span>HOT</span>
                                                            <?php
                                                            }
                                                            ?>
                                                            <a href="/post/details/<?php echo $v['id'] ?>.html"><?php echo $v['title'] ?></a>
                                                        </div>

                                                        <div class="publish-info clearfix">

                                                            <!--                                        <span class="author-name">-->
                                                            <?php //echo $v['nickname'] ? $v['nickname'] : $v['userName'] ?><!--</span>-->
                                                            <div class="author-info">
                                                                <span
                                                                    class="author-name"><?php echo $v['nickname'] ? $v['nickname'] : $v['username'] ?></span>
                                                                <span
                                                                    class="show-time">发布于 <?php echo $v['dateTime'] ?></span>
                                                            </div>

                                                            <?php
                                                            if ($v['replySign']) {
                                                                ?>
                                                                <!--                                        <div class="author-info">-->
                                                                <!--                                        <span class="reply-data">--><?php //echo $v['replyName'] ?><!--最后回复于 --><?php //echo date("Y-m-d H:i", $v['replyTime']) ?><!-- </span>-->
                                                                <!--                                        </div>-->
                                                                <div class="author-info">
                                                                    <span class="author-date"
                                                                          title=""><?php echo $v['replyName'] ?></span>
                                            <span class="show-time"
                                                  title="09:01">最后回复于&nbsp;<span><?php echo date("Y-m-d H:i", $v['replyTime']) ?></span></span>
                                                                </div>
                                                            <?php
                                                            }
                                                            ?>
                                                            <div class="fans_numbox">
                                                                <span>查看：<span
                                                                        class="light"><?php echo $v['viewCount'] ?></span></span>|
                                                <span>回复：<span class="light"><?php echo $v['replyCount'] ?></span>
                                            </span>
                                                            </div>
                                                        </div>
                                                        <div class="picturedisplay">
                                                            <div class="thumblist ">
                                                                <?php
                                                                $images = unserialize($v['imageContent']);
                                                                foreach ($images as $val) {
                                                                    ?>
                                                                    <span onclick="showPicture(this);"><img
                                                                            src="<?php echo $val ?>" alt=""></span>
                                                                <?php
                                                                }
                                                                ?>
                                                            </div>
                                                            <div class="picturebox xs-image">
                                                                <div class="picturecontrol x-act"
                                                                     style=" color: #9699a3;    padding-bottom: 20px;">
                                                                    <a class="x-btn" onclick="closePicture(this);"
                                                                       href="javascript:;">
                                                                        <img src="/cn/images/Icon_shouqi.png">
                                                                        收起

                                                                    </a>
                                                                    &nbsp;&nbsp;&nbsp;

                                                                    <a class="icon_viewlarge x-btn" href="#"
                                                                       target="_blank">
                                                                        <img src="/cn/images/Icon_chakandatu.png">
                                                                        查看大图</a>
                                                                    &nbsp;&nbsp;&nbsp;

                                                                    <a class="icon_turnleft x-btn"
                                                                       onclick="turnImg(this);" href="javascript:;">
                                                                        <img src="/cn/images/Icon_xuanzhuan.png">
                                                                        旋转
                                                                    </a>

                                                                </div>
                                                                <div class="bigpicture">
                                                                    <div class="picturewrap"
                                                                         onclick="closePicture(this);"
                                                                         style="margin: 20px;">
                                                                        <img deg="0" class="picture"
                                                                             src="/cn/images/nopic.jpg">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <p class="post-de"><?php echo $v['cnContent'] ?></p>

                                                    </div>
                                                </li>
                                            <?php
                                            }
                                            ?>
                                        </ul>
                                        <div class="show-more tm">
                                            <a href="/post/list/<?php echo $value['catId'] ?>.html">查看更多>></a>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        <?php
                        }
?>
<!--                    备考八卦-->
                    <ul>
                        <li>
                            <div class="post-nav2">
                                    <ul class="post-list2  clearfix" style="display: block">
                                        <?php
                                        foreach ($gossipCategory as $v) {
                                            ?>
                                            <li>
                                                <a href="/post/list/<?php echo $v['id'] ?>.html"><?php echo $v['name'] ?></a>
                                            </li>
                                            <?php
                                        }
                                        ?>
                                    </ul>
                            </div>
                            <!--帖子列表-->
                            <div class="bg-f lc-3" style="margin-top: 10px;">
                                <ul class="post-list3">
                                    <?php
                                    foreach ($gossipData as $v) {
                                        ?>
                                        <li>
                                            <div class="user-head inb"><img
                                                    src="<?php echo '/cn/img/noavatar_big.gif' ?>"
                                                    alt=""></div>
                                            <div class="post-info inb">
                                                <div class="post-tit">
                                                    <a href="/gossip/details/<?php echo $v['id'] ?>.html"><?php echo $v['title']?base64_decode($v['title']):'冒泡'?></a>
                                                </div>
                                                <!--                                <p class="post-de">-->
                                                <?php //echo $v['cnContent'] ?><!--</p>-->
                                                <div class="publish-info clearfix">

                                                    <!--                                        <span class="author-name">-->
                                                    <?php //echo $v['nickname'] ? $v['nickname'] : $v['userName'] ?><!--</span>-->
                                                    <div class="author-info">
                                                        <span class="author-name"><?php echo $v['publisher']?></span>
                                                        <span class="show-time">发布于 <?php echo date("Y-m-d",$v['createTime'])?></span>
                                                    </div>

                                                    <?php
                                                    if ($v['replySign']) {
                                                        ?>
                                                        <!--                                        <div class="author-info">-->
                                                        <!--                                        <span class="reply-data">--><?php //echo $v['replyName'] ?><!--最后回复于 --><?php //echo date("Y-m-d H:i", $v['replyTime']) ?><!-- </span>-->
                                                        <!--                                        </div>-->
                                                        <div class="author-info">
                                                            <span class="author-date" title=""><?php echo $v['replyName'] ?></span>
                                            <span class="show-time"
                                                  title="09:01">最后回复于&nbsp;<span><?php echo date("Y-m-d H:i", $v['replyTime']) ?></span></span>
                                                        </div>
                                                        <?php
                                                    }
                                                    ?>
                                                    <div class="fans_numbox">
                                                        <span>查看：<span class="light"><?php echo $v['viewCount'] ?></span></span>|
                                                <span>回复：<span class="light"><?php echo $v['replyCount'] ?></span>
                                            </span>
                                                    </div>
                                                </div>
                                                <div class="picturedisplay">
                                                    <div class="thumblist ">
                                                        <?php
                                                        $images = json_decode($v['image'],'true');
                                                        foreach ($images as $val) {
                                                            ?>
                                                            <span onclick="showPicture(this);"><img src="<?php echo $val ?>" alt=""></span>
                                                            <?php
                                                        }
                                                        ?>
                                                    </div>
                                                    <div class="picturebox xs-image">
                                                        <div class="picturecontrol x-act"
                                                             style=" color: #9699a3;    padding-bottom: 20px;">
                                                            <a class="x-btn" onclick="closePicture(this);"
                                                               href="javascript:;">
                                                                <img src="/cn/images/Icon_shouqi.png">
                                                                收起

                                                            </a>
                                                            &nbsp;&nbsp;&nbsp;

                                                            <a class="icon_viewlarge x-btn" href="#" target="_blank">
                                                                <img src="/cn/images/Icon_chakandatu.png">
                                                                查看大图</a>
                                                            &nbsp;&nbsp;&nbsp;

                                                            <a class="icon_turnleft x-btn" onclick="turnImg(this);" href="javascript:;">
                                                                <img src="/cn/images/Icon_xuanzhuan.png">
                                                                旋转
                                                            </a>

                                                        </div>
                                                        <div class="bigpicture">
                                                            <div class="picturewrap" onclick="closePicture(this);"
                                                                 style="margin: 20px;">
                                                                <img deg="0" class="picture" src="/cn/images/nopic.jpg">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <p class="post-de"><?php echo base64_decode($v['content'])?></p>

                                            </div>
                                        </li>
                                        <?php
                                    }
                                    ?>
                                </ul>
                                <div class="show-more tm">
                                    <a href="/post/list/24.html">查看更多>></a>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
            <script type="text/javascript">
                jQuery(".all-bbs-tiezi").slide({titCell:".bbs-hd li",mainCell:".bbs-bd"});
            </script>

        </div>
        <?php use app\commands\front\RightWidget; ?>
        <?php RightWidget::begin(); ?>
        <?php RightWidget::end(); ?>
</section>
<?php use app\commands\front\FooterWidget; ?>
<?php FooterWidget::begin(); ?>
<?php FooterWidget::end(); ?>
</body>
<script>
    $(function(){
        $('.active-list li').each(function(index,k){
            var result=String((index/4).toFixed(2));
            var str=parseInt(result.substring(result.indexOf(".")+1));
            if(str==0){
                $(this).find('.a-img img').attr('src','/cn/images/default_head_1.png')
            }
            if(str==25){
                $(this).find('.a-img img').attr('src','/cn/images/default_head_2.png')
            }
            if(str==50){
                $(this).find('.a-img img').attr('src','/cn/images/default_head_3.png')
            }
            if (str==75){
                $(this).find('.a-img img').attr('src','/cn/images/default_head_4.png')
            }
        });
        var urls=location.href.split("#")[1];
        if(urls=="H_all"){
            $(".post-list li:first-child").addClass("on");
        }else{
            $(".post-list li:first-child").removeClass("on");
        }

    });
    function mouseLi(o){
        location.href= $(o).attr("data-mouse");
    }
</script>
</html>