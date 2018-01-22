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
    <link rel="stylesheet" href="/cn/css/animate.min.css">
    <link rel="stylesheet" href="/cn/css/gossip_details.css">
    <script src="/cn/js/jquery-1.12.2.min.js"></script>
    <script src="/cn/js/jquery.swipebox.js"></script>
    <script src="/cn/js/jquery.SuperSlide.2.1.1.js"></script>
    <script type="text/javascript" charset="utf-8"
            src="http://static.bshare.cn/b/buttonLite.js#style=-1&amp;uuid=&amp;pophcol=2&amp;lang=zh"></script>
    <script type="text/javascript" charset="utf-8" src="http://static.bshare.cn/b/bshareC0.js"></script>
    <title><?php echo base64_decode($data['title'])?>-雷哥网社区-我们就爱分享知识！</title>
</head>
<body style="background: #f6f7f7;">
<!--搜索-->
<?php use app\commands\front\NavWidget; ?>
<?php NavWidget::begin(); ?>
<?php NavWidget::end(); ?>
<!--当前位置-->
<section>
    <div class="w12 location">
        <div class="tzTop2">
        <a href="/">首页</a>&nbsp;>&nbsp;<em><?php switch ($data['belong']){
                case 1:echo 'GMAT备考八卦';break;
                case 2:echo '托福备考八卦';break;
                case 4:echo '雅思备考八卦';break;
                case 3:echo '留学备考八卦';break;
                case 5:echo 'SAT备考八卦';break;
            }?></em>
        </div>
    </div>
</section>
<!--帖子详情-->
<section style="margin-bottom: 20px;">
    <div class="w12 bg-f">
        <div class="issueWrap clearfix">
            <h1 class="articleTit ellipsis fl"><?php echo base64_decode($data['title'])?></h1>
            <a href="/add.html">            <div class="issueBtn tm fr">
                    <img src="/cn/images/ic-5B.png" alt="">
                    <span class="inb">我要发布八卦</span>
                </div></a>

        </div>
        <div class="issueInfo clearfix">
            <div class="issuerImg fl"><img src="<?php echo '/cn/img/noavatar_big.gif' ?>" alt=""></div>
            <div class="clearfix fl issue-R">
                <div class="clearfix">
                    <h1 class="issuer fl"><?php echo $data['publisher']?></h1>
                    <div class="fr issueData">
                        <img src="/cn/images/ic-6.png" alt="">
                        <span class="inb">发表于<?php echo date("Y-m-d",$data['createTime'])?></span>
                    </div>
                </div>
                <div class="issueText">
                    <?php echo base64_decode($data['content'])?>
                    <br/>
                    <?php
                    $images = json_decode($data['image'],'true');
                    if($images) {
                        foreach ($images as $val) {
                            ?>
                            <a href="<?php echo $val ?>" target="_blank">
                                <img src="<?php echo $val ?>" alt="图片" width="200"/></a>
                            <?php
                        }
                    }
                    ?>
                </div>
                <?php if(!Yii::$app->session->get('uid')) { ?>
                    <div>
                        <p class="login_hint tm">亲，<a href="#">登录</a>后才能发表回复哦~</p>
                    </div>
                <?php
                }
                ?>
            </div>
        </div>
        <div class="clearfix lookWrap">
            <p class="fl lookUp">查看：<?php echo $data['id']+289+floor(time()/($v['id']*35387))?> &nbsp;&nbsp;回复：<?php echo $count?></p>
            <div class="bshare-custom fr">
                <a title="分享到微信" class="bshare-weixin"></a><a title="分享到新浪微博" class="bshare-sinaminiblog"></a><a
                    title="分享到豆瓣" class="bshare-douban"></a><a title="分享到人人网" class="bshare-renren"></a><a
                    title="分享到腾讯微博" class="bshare-qqmb"></a><a title="更多平台" class="bshare-more bshare-more-icon more-style-addthis"></a>
            </div>

        </div>
    </div>
</section>
<!--相关文章-->
<section>
    <div class="w12 bg-f relevanceWrap">
        <p class="articleTit_1">相关文章</p>
        <ul class="relevanceList">
            <?php
                foreach($hot as $v) {
                    ?>
                    <li><a href="/gossip/details/<?php echo $v['id']?>.html"><?php echo base64_decode($v['title'])?></a></li>
                <?php
                }
            ?>
        </ul>
    </div>
</section>
<section>
    <div class="w12 bg-f" style="margin-bottom: 10px;">
        <div class="reply_1 clearfix">
            <p class="fl">全部回复 (<?php echo $count?>) </p>
            <p class="fr reply_btn1">回复</p>
        </div>
    </div>
</section>
<!--回复-->
<section style="margin-bottom: 20px;">
    <div class="w12 bg-f">
        <?php
            foreach($reply as $v) {
                ?>
                <div class="reply_wrap">
                    <div class="issuer_info clearfix">
                        <div class="issuer_1 fl">
                            <div class="issuer_img2 inb"><img src="<?php echo '/cn/img/noavatar_big.gif' ?>" alt=""></div>
                            <div class="issuer2_name inb">
                                <p><?php echo $v['uName']?></p>
                                <span><?php echo \app\libs\Method::time_tran($v['createTime'])?></span>
                            </div>
                        </div>
                    </div>
                    <div class="revert_wrap">
                        <p class="iss_content">
                            <?php echo base64_decode($v['content'])?>
                        </p>
                    </div>
<!--                    <div class="tm">-->
<!--                        <img src="/cn/images/line_2.png" alt="">-->
<!---->
<!--                        <p class="other_reply inb">还有3条回复，<span class="show_other">点击查看</span></p>-->
<!--                        <img src="/cn/images/line_2.png" alt="">-->
<!--                    </div>-->
                </div>
            <?php
            }
        ?>
    </div>
</section>
<!--评论-->
<section>
    <div class="w12 bg-f">
        <?php if(!Yii::$app->session->get('uid')) { ?>
            <div class="nologin"><a href="#">登录</a>/<a href="#">注册</a></div>
        <?php
        }
        ?>
        <div class="publish_wrap">
            <div class="issuer_img2 inUp"><img src="<?php echo '/cn/img/noavatar_big.gif' ?>" alt=""></div>
            <div class="inUp">
                <div class="intWrap relative">
                    <img class="crow_t ani" src="/cn/images/crow_t.png" alt="">
                    <textarea class="int_text" name="" id="" cols="30" rows="10" placeholder="随便说点什么吧？"></textarea>
                </div>
                <div class="tr">
                    <a onclick="reply(<?php echo $data['id']?>)" class="push_btn" href="javascript:;">发表</a>
                </div>
            </div>
            <script type="text/javascript">
                function reply(_id){
                    var content = $('.int_text').val();
                    $.post("/cn/api/reply",{id:_id,content:content,type:1},function(re){
                        alert(re.message);
                        if(re.code == 1){
                            location.reload();
                        }
                    },'json')
                }
            </script>
        </div>
    </div>
</section>
<?php use app\commands\front\FooterWidget; ?>
<?php FooterWidget::begin(); ?>
<?php FooterWidget::end(); ?>
</body>
</html>