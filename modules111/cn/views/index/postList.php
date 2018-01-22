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
    <link rel="stylesheet" href="/cn/css/justifiedgallery.min.css">
    <link rel="stylesheet" href="/cn/css/animate.min.css">
    <script src="/cn/js/jquery-1.12.2.min.js"></script>
    <script src="/cn/js/jquery.swipebox.js"></script>
    <script src="/cn/js/justifiedgallery.js"></script>
    <script src="/cn/js/jquery.SuperSlide.2.1.1.js"></script>
    <script src="/cn/js/showImg.js"></script>
    <title><?php echo $category->name ? $category->name : '全部帖子' ?>-雷哥网社区-我们就爱分享知识！</title>
</head>
<body id="community">
<!--搜索-->
<?php use app\commands\front\NavWidget; ?>
<?php NavWidget::begin(); ?>
<?php NavWidget::end(); ?>
<!--当前位置-->
<section>
    <div class="w12 location">
        <div class="tzTop"><a href="/">首页</a>&nbsp;><?php
            if (count($parent) > 0) {
                foreach ($parent as $v) {
            ?>
            <a href="/post/list/<?php echo $v['id'] ?>.html"><?php echo $v['name'] ?></a>&nbsp;>
                <?php
                }
                echo "<em>".$category['name']."</em>";
            } else {
                echo '<em>全部帖子</em>';
            }
            ?>
        </div>
        <div class="tzBt clearfix">
            <div class="tzIcon inb"><img src="<?php echo $category['image'] ? $category['image'] : '' ?>" alt=""></div>
            <div class="inb sttz_info">
                <div class="tzbt_top">
                    <h1 class="st_name"><?php echo $category['name'] ? $category['name'] : '全部帖子' ?></h1>
                    <div class="tzNum_2">
                        <span>今日新帖：<?php echo $today ?></span>
                        <span>帖子总数：<?php echo $count ?></span>
                    </div>
                    <div class="tzBt_de">
                        加入雷哥网社团，和大家一起出国留学~快乐加倍！效率加倍！<br>
                        2018&2019留学申请群：130636081<br>
                        雷哥GMAT备考交流群：439324846<br>
                        雷哥GRE备考社群：317282270<br>
                        雷哥托福备考社群：262605703<br>
                        每周留学直播课和备考刷题团不见不散！
                    </div>
                </div>
                <table class="zcd_wrap" cellspacing="0" cellpadding="0">
                    <tr>
                        <?php
                        if($_GET['hot'] || !$_GET['catId']) {
                            ?>
                            <td><a <?php if(!$_GET['hot']){?>class="on" <?php }?> href="/post/list/0.html">全部</a></td>
                            <td><a <?php if($_GET['hot']){?>class="on" <?php }?> href="/post/list/h-1.html">精华</a></td>
                            <?php
                        } else {
                            foreach($catChild as $v) {
                                ?>
                                <td><a <?php if($v['id']==$_GET['catId']){ ?>class="on" <?php } ?> href="/post/list/<?php echo $v['id'] ?>.html"><?php echo $v['name'] ?></a></td>
                                <?php
                            }
                        }
                        ?>
                    </tr>
                </table>
            </div>
            <div class="inb addIn_st" data-catId="<?php echo $_GET['catId'] ?>"><i class="addIn_bg"></i>加入社团</div>
        </div>
<!--        <div class="tzBt clearfix">-->
<!--            <div class="fl">-->
<!--                <div class="tzIcon inb"><img src="-->
<!--        --><?php //echo $category['image'] ? $category['image'] : '' ?><!--" alt=""></div>-->
<!--                <div class="inb">-->
<!--                    <p class="tzbName">-->
<!--                        --><?php //echo $category['name'] ? $category['name'] : '全部帖子' ?><!--</p>-->
<!--                    <div class="tzNum">-->
<!--                        <span>今日新贴：<span class="light">--><?php //echo $today ?><!--</span></span>|-->
<!--                        <span>贴子总数：<span class="light">--><?php //echo $count ?><!--</span></span>-->
<!--                    </div>-->
<!--                </div>-->
<!--            </div>-->
<!--            <div class="fl addIn_st" data-catId="--><?php //echo $_GET['catId'] ?><!--">-->
<!--                加入社团-->
<!--            </div>-->
<!--        </div>-->
<!--        <table class="zcd_wrap" cellspacing="0" cellpadding="0">-->
<!--            <tr>-->
<!--                <td><a href="#">题目答疑</a></td>-->
<!--                <td><a href="#">题目答疑</a></td>-->
<!--                <td><a href="#">题目答疑</a></td>-->
<!--                <td><a href="#">题目答疑</a></td>-->
<!--            </tr>-->
<!--        </table>-->

    </div>
</section>
<!--社区内容-->
<section>
    <div class="w12 clearfix content-wrap">
        <div class="left fl">
            <div class="lc-1 bg-f">
                <!--热帖-->
                <div class="lc-tit">
                    <div class="ic-wrap inb"><img src="/cn/images/ic-2.png" alt=""></div>
                    <span class="lc-tit-word"><?php echo $category->name ? $category->name : '全部帖子' ?></span>
                    <!--                    <a class="fr more" href="/">返回首页</a>-->
                </div>

            </div>
            <!--帖子列表-->
            <div class="bg-f lc-3">
                <ul class="post-list3">
                    <?php
                    foreach ($data as $v) {
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
                                <!--                                <p class="post-de">-->
                                <?php //echo $v['cnContent'] ?><!--</p>-->
                                <div class="publish-info clearfix">


                                    <div class="author-info">
                                        <span
                                            class="author-name"><?php echo $v['nickname'] ? $v['nickname'] : $v['userName'] ?></span>
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


                            </div>
                        </li>
                        <?php
                    }
                    ?>
                </ul>
                <div class="show-more tm">
                    <ul class="pageSize-wrap">
                        <?php echo $pageStr ?>
                    </ul>
                </div>
                <script type="text/javascript">
                    /**
                     * 讨论分页
                     */
                    $("body").on("click", ".iPage", function () {
                        var page = $(this).html();
                        location.href = "/post/list/<?php if($catId != 0 || $_GET['hot']==''){echo $catId; } else{echo 'h-'.$_GET['hot']; } ?>/" + page + ".html";
                    });
                    $('.thumblist span img').each(function(){
                        var regExp = new RegExp("files|/files", 'g');
                        var str=$(this).attr("src").replace(regExp,'/files');
                        $(this).attr("src",str);
                    })
                </script>
            </div>
        </div>
        <?php use app\commands\front\RightWidget; ?>
        <?php RightWidget::begin(); ?>
        <?php RightWidget::end(); ?>
    </div>
</section>
<?php use app\commands\front\FooterWidget; ?>
<?php FooterWidget::begin(); ?>
<?php FooterWidget::end(); ?>
</body>

<script>
    $('.addIn_st').click(function () {
        var catId = $(this).attr('data-catId');
        $.ajax({
            url: '/cn/api/join-club',
            data: {catId: catId},
            dataType: 'json',
            type: 'post',
            success: function (data) {
                console.log(data);
                if (data.code == 0) {
                    alert(data.message);
                    var r = confirm('点击确认前往登录');
                    if (r == true) {
                        location.href = 'http://login.gmatonline.cn/cn/index?source=8&url=http://bbs.viplgw.cn/'
                    }
                }
                else {
                    alert(data.message);
                }
            }
        })
    });

</script>
</html>