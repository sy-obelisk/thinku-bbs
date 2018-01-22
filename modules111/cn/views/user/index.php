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
    <meta name="keywords" content="">
    <meta name="description" content="">
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
    <link rel="stylesheet" href="/cn/css/animate.min.css">
    <script src="/cn/js/jquery-1.12.2.min.js"></script>
    <script src="/cn/js/jquery.swipebox.js"></script>
    <script src="/cn/js/jquery.SuperSlide.2.1.1.js"></script>
    <script src="/cn/js/user-center.js"></script>
    <script type="text/javascript" charset="utf-8"
            src="http://static.bshare.cn/b/buttonLite.js#style=-1&amp;uuid=&amp;pophcol=2&amp;lang=zh"></script>
    <script type="text/javascript" charset="utf-8" src="http://static.bshare.cn/b/bshareC0.js"></script>
    <title>个人中心</title>
    <style>


    </style>
</head>
<body>
<?php use app\commands\front\NavWidget; ?>
<?php NavWidget::begin(); ?>
<?php NavWidget::end(); ?>
<section class="userInfo-wrap">
    <div class="w12 search clearfix" style="margin-bottom: 0;">
        <div class="fl"><a href="/"><img src="/cn/images/t-1.png" alt=""></a></div>
        <div class="search-wrap  bg-f fr">
            <div class="inb ic-1"><img src="/cn/images/ic-1.png" alt=""></div>
            <input class="search-int" type="text">
        </div>
    </div>
    <div class="w12 userInfo clearfix">
        <div class="info-l fl">
            <div class="userInfo-head inb"><img
                    src="<?php echo '/cn/img/noavatar_big.gif' ?>" alt=""></div>
            <div class="userInfo-text inb">
                <p class="info-username"><?php echo isset($userData['nickname']) ? $userData['nickname'] : $userData['username'] ?></p>
                <div class="info-lev">
                    <span>初出茅庐</span><span>雷豆数：<?php echo isset($leidou['integral']) ? $leidou['integral'] : '0' ?></span>
                </div>
                <p class="dayNum">你已签到<?php echo !empty($userData['countSign']) ? $userData['countSign'] : '0' ?>天</p>
            </div>
        </div>
        <div class="info-r fr">发表总数：<em><?php echo isset($total) ? $total : '0' ?></em></div>
    </div>
</section>
<!--未发布帖子-->
<section class="nopush-wrap">
    <div class="w12 noPush clearfix">
        <p class="tm">你还没有参与过任何话题</p>
        <a class="goPush" href="/add.html">立即发帖</a>
    </div>
</section>
<!--发过帖子-->
<section>
    <div class="w12 userPush-wrap clearfix">
        <div class="tabCheck">
            <span class="on">帖子</span>
            <span>备考八卦</span>
        </div>
        <!--        <p class="sys-hit">你参与过以下话题：SC、CR、Q</p>-->
        <div style="display: block;" class="userPushlist-wrap">
            <ul class="userPush-list">
                <?php foreach($userPost['data'] as $v) { ?>
                    <li>
                        <span class="push-data"><?php echo $v['dateTime'] ?></span>

                        <div class="push-info">
<!--                            <div class="push-img"><img src="--><?php //echo $v['imageContent'][0] ?><!--" alt=""></div>-->
                            <div class="push-text">
                                <div class="push-tag">
                                    <a href="/post/details/<?php echo $v['id'] ?>.html"><h1 class="push-tit inb ellipsis"><?php echo $v['title'] ?></h1></a>
                                    <span><?php echo $v['name'] ?></span>
                                     <span class="remove_btn"><a href="/cn/user/post-delete?id=<?php echo $v['id']; ?>">删除</a></span>
                                </div>
                                <p class="push-de ellipsis-5"><?php echo $v['cnContent'] ?></p>
                                <div class="push-share clearfix">
                                    <span>阅读：<?php echo $v['viewCount'] ?></span>

                                    <div class="bshare-custom fr">
                                        <a title="分享到微信" class="bshare-weixin"></a><a title="分享到新浪微博"
                                                                                      class="bshare-sinaminiblog"></a><a
                                            title="分享到豆瓣" class="bshare-douban"></a><a title="分享到人人网"
                                                                                       class="bshare-renren"></a><a
                                            title="分享到腾讯微博" class="bshare-qqmb"></a><a title="更多平台"
                                                                                       class="bshare-more bshare-more-icon more-style-addthis"></a>
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
                <a class="gossip-1" data-page="2" href="javascript:void (0);">查看更多&gt;&gt;</a>
            </div>
        </div>
        <div class="userPushlist-wrap">
            <ul class="userPush-list">
                <?php foreach($userGossip['data'] as $u) { ?>
                    <li>
                        <span class="push-data"><?php echo date("Y-m-d", $u['createTime']);  ?></span>

                        <div class="push-info">
<!--                            <div class="push-img"><img src="--><?php //echo json_decode($u['image'])[0] ?><!--" alt=""></div>-->
                            <div class="push-text">
                                <div class="push-tag">
                                    <a href="/gossip/details/<?php echo $u['id'] ?>.html"><h1 class="push-tit inb ellipsis"><?php echo $u['title'] ?></h1></a>
                                    <span>
                                        <?php if($u['belong'] ==1){
                                            echo 'GMAT';
                                        } elseif($u['belong'] ==2){
                                            echo '托福';
                                        } elseif($u['belong'] ==3){
                                            echo '留学';
                                        } elseif($u['belong'] ==4){
                                            echo '雅思';
                                        } else{
                                            echo '';
                                        }?>
                                    </span>
                                </div>
                                <p class="push-de ellipsis-5"><?php echo $u['content'] ?></p>

                                <div class="push-share clearfix">
                                    <span>阅读：<?php echo $u['viewCount'] ?></span>

                                    <div class="bshare-custom fr">
                                        <a title="分享到微信" class="bshare-weixin"></a><a title="分享到新浪微博"
                                                                                      class="bshare-sinaminiblog"></a><a
                                            title="分享到豆瓣" class="bshare-douban"></a><a title="分享到人人网"
                                                                                       class="bshare-renren"></a><a
                                            title="分享到腾讯微博" class="bshare-qqmb"></a><a title="更多平台"
                                                                                       class="bshare-more bshare-more-icon more-style-addthis"></a>
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
                <a class="gossip-2" data-page="2" href="javascript:void (0);">查看更多&gt;&gt;</a>
            </div>
        </div>
    </div>

</section>
<?php use app\commands\front\FooterWidget; ?>
<?php FooterWidget::begin(); ?>
<?php FooterWidget::end(); ?>
</body>
</html>