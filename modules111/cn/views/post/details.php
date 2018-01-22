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
    <link rel="stylesheet" href="/cn/css/article_details.css">
    <script src="/cn/js/jquery-1.12.2.min.js"></script>
    <script src="/cn/js/jquery.swipebox.js"></script>
    <script src="/cn/js/jquery.SuperSlide.2.1.1.js"></script>
    <script type="text/javascript" charset="utf-8"
            src="http://static.bshare.cn/b/buttonLite.js#style=-1&amp;uuid=&amp;pophcol=2&amp;lang=zh"></script>
    <script type="text/javascript" charset="utf-8" src="http://static.bshare.cn/b/bshareC0.js"></script>
    <title><?php echo $data['title'] ?>-雷哥网社区-我们就爱分享知识！</title>
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
            <a href="/">首页</a>><?php foreach ($parent as $v) { ?><a
                href="/post/list/<?php echo $v['id'] ?>.html"><?php echo $v['name'] ?></a>&nbsp;><?php } ?>
            <em><?php echo $data['name'] ?></em>
        </div>
    </div>
</section>
<!--帖子详情-->
<section style="margin-bottom: 20px;">
    <div class="w12 clearfix">
        <!--        左侧-->
        <div class="fl clearfix">
            <div class="w895 bg-f">
                <div class="issueInfo clearfix">
                    <div class="issuerImg fl"><img
                            src="<?php echo isset($data['image']) ? $data['image'] : '/cn/img/noavatar_big.gif' ?>"
                            alt=""></div>
                    <div style="padding-right: 20px">
                        <div class="clearfix fr issue-R">
                            <div class="clearfix">
                                <!--                    <h1 class="issuer ">-->
                                <?php //echo $data['nickname'] ? $data['nickname'] : $data['username'] ?><!--</h1>-->
                                <div class="clearfix">
                                    <h1 class="articleTit ellipsis fl"><?php echo $data['title'] ?></h1>
                                    <div class="btns">
                                        <a style="border-radius: 7px;font-size: 14px;" class="btn btn-default" href="#">只看楼主</a>
                                    </div>
                                </div>


                                <div class=" issueData tm">
                                <span
                                    class="inb"> 本帖最后由 <span
                                        class="size_8"><?php echo $data['nickname'] ? $data['nickname'] : $data['username'] ?></span>
                                    于 <?php echo $data['dateTime'] ?>编辑</span>
                                </div>
                            </div>
                            <div class="issueText">
                                <?php echo $data['content'] ?>
                            </div>
                            <?php if ($sign == 0) { ?>
                                <?php
                                if (count(unserialize($data['datum'])) != 0 || count(unserialize($data['radio'])) != 0) {
                                    ?>
                                    <div>
                                        <?php
                                        if (!Yii::$app->session->get('uid')) {
                                            ?>
                                            <p class="locked tm">游客，如果您要查看本帖隐藏内容请<a
                                                    href="http://login.gmatonline.cn/cn/index?source=8&url=http://gossip.cc/post/details/<?php echo $data['id'] ?>.html">回复</a>
                                            </p>
                                            <?php
                                        } else {
                                            ?>
                                            <p class="locked tm">游客，如果您要查看本帖隐藏内容请<a
                                                    href="#localReply">回复</a>
                                            </p>
                                            <?php
                                        }
                                        ?>
                                    </div>
                                    <?php
                                }
                                ?>
                                <?php
                            } else {
                                ?>
                                <?php
                                if (count(unserialize($data['datum'])) != 0 || count(unserialize($data['radio'])) != 0) {
                                    ?>
                                    <div class="clearfix rarWrap">
                                        <h4 class="dhint tm">本帖隐藏的内容</h4>
                                        <?php
                                        if (count(unserialize($data['datum'])) != 0) {
                                            ?>
                                            <ul class="downloadList">
                                                <?php
                                                $datum = unserialize($data['datum']);
                                                $datumTitle = unserialize($data['datumTitle']);
                                                foreach ($datum as $k => $v) {
                                                    ?>
                                                    <li>
                                                        <img src="/cn/images/rar.gif" alt="">
                                                        <a href="/download?file=<?php echo $v ?>&fileName=<?php echo $datumTitle[$k] ?>"><?php echo $datumTitle[$k] ?></a>
                                                        <em>(下载次数: <?php echo rand(50, 100) ?>)</em>
                                                    </li>
                                                    <!--                                                <li>-->
                                                    <!--                                                    <img src="/cn/images/unknown.gif" alt="">-->
                                                    <!--                                                    <a href="/download?file=--><?php //echo $v ?><!--&fileName=--><?php //echo $datumTitle[$k] ?><!--">--><?php //echo $datumTitle[$k] ?><!--</a>-->
                                                    <!--                                                    <em>(4.06 MB, 下载次数: 744)</em>-->
                                                    <!--                                                </li>-->
                                                    <?php
                                                }
                                                ?>
                                            </ul>
                                            <?php
                                        }
                                        ?>
                                        <?php
                                        if (count(unserialize($data['radio'])) != 0) {
                                            ?>

                                            <ul class="downloadList">
                                                <?php
                                                $datum = unserialize($data['radio']);
                                                $datumTitle = unserialize($data['radioTitle']);
                                                foreach ($datum as $k => $v) {
                                                    ?>
                                                    <li>
                                                        <img src="/cn/images/rar.gif" alt="">
                                                        <a href="/download?file=<?php echo $v ?>&fileName=<?php echo $datumTitle[$k] ?>"><?php echo $datumTitle[$k] ?></a>
                                                        <em>(下载次数: <?php echo rand(50, 100) ?>)</em>
                                                    </li>
                                                    <?php
                                                }
                                                ?>
                                            </ul>

                                            <?php
                                        }
                                        ?>


                                    </div>
                                    <?php
                                }
                                ?>
                                <?php
                            }
                            ?>
                        </div>
                    </div>
                </div>
                <div class="plc">
                    <!--                    <div class="sign">wechat：ybnt110&nbsp;&nbsp;（暗号：留学）</div>-->
                    <div class="bshare-custom" style="margin-bottom: 15px">
                        <b class="inb" style="font-weight: bold">分享到：</b>
                        <a title="分享到微信" class="bshare-weixin"></a><a title="分享到新浪微博" class="bshare-sinaminiblog"></a><a
                            title="分享到豆瓣" class="bshare-douban"></a><a title="分享到人人网" class="bshare-renren"></a><a
                            title="分享到腾讯微博" class="bshare-qqmb"></a><a title="更多平台"
                                                                       class="bshare-more bshare-more-icon more-style-addthis"></a>
                    </div>
                    <!--                    <a class="btn-default" href="#">-->
                    <!--                        <i style="font-style: normal">❤&nbsp;</i>收藏 <span id="favoritenumber">1</span>-->
                    <!--                    </a>-->
                    <?php if (Yii::$app->session->get('uid') == $data['uid']) { ?>
                        <div class="tr smWrap">
                            <strong class="sm">楼主</strong>
                            <a class="jub" href="/cn/post/add-post?id=<?php echo $data['id']; ?>">修改</a>
                            <a class="jub" href="/cn/user/post-delete?id=<?php echo $data['id']; ?>">删除</a>
                        </div>
                        <?php
                    }
                    ?>
                </div>
                <div class="clearfix lookWrap">
                    <!--                <p class="fl lookUp">查看：--><?php //echo $data['viewCount'] ?><!--回复：-->
                    <?php //echo $count ?><!--</p>-->
                    <p class="fl lookUp">共有&nbsp;<?php echo $count ?>&nbsp;条回复</p>
                    <!--            <div class="bshare-custom fr">-->
                    <!--                <a title="分享到微信" class="bshare-weixin"></a><a title="分享到新浪微博" class="bshare-sinaminiblog"></a><a-->
                    <!--                    title="分享到豆瓣" class="bshare-douban"></a><a title="分享到人人网" class="bshare-renren"></a><a-->
                    <!--                    title="分享到腾讯微博" class="bshare-qqmb"></a><a title="更多平台"-->
                    <!--                                                               class="bshare-more bshare-more-icon more-style-addthis"></a>-->
                    <!--            </div>-->

                </div>
            </div>
            <!--        相关文章-->
            <div class="w895 bg-f relevanceWrap">
                <p class="articleTit_1">相关文章</p>
                <ul class="relevanceList">
                    <?php
                    foreach ($hot as $v) {
                        ?>
                        <li><a href="/post/details/<?php echo $v['id'] ?>.html"><?php echo $v['title'] ?></a></li>
                        <?php
                    }
                    ?>
                </ul>
            </div>
            <!--        回复-->
            <div class="w895 bg-f">
                <?php
                foreach ($reply as $v) {
                    ?>
                    <div class="reply_wrap">
                        <div class="issuer_info clearfix">
                            <div class="issuer_1 fl tm">
                                <div class="issuer_img2 "><img
                                        src="<?php echo isset($v['image']) ? $v['image'] : '/cn/img/noavatar_big.gif' ?>"
                                        alt=""></div>
                                <div class="issuer2_name ">
                                    <p class="ellipsis"><?php echo $v['nickname'] ? $v['nickname'] : $v['username'] ?></p>
                                    <!--                                <span>-->
                                    <?php //echo \app\libs\Method::time_tran($v['createTime'])?><!--</span>-->
                                </div>
                            </div>
                            <div class="revert_wrap fr">
                                <p class="iss_content"><?php echo $v['content'] ?></p>
                                <div class="revert_list_wrap">
                                    <div class="open tr"><span onclick="taggle(this)">回复</span></div>
                                    <div class="taglle">
                                        <ul class="revert_list">
                                            <?php
                                            foreach ($v['reply'] as $val) {
                                                ?>
                                                <li>
                                                    <a class="issuer2_name2"><?php echo $val['nickname'] ? $val['nickname'] : $val['username'] ?>
                                                        :</a>
                                                    <em class="revert_text"><?php echo $val['content'] ?></em>
                                                    <div align="left" class="ddd_152">
                                                        <!--回复时间-->
                                                        <em style="color:#81828c;font-size: 11px!important;line-height: 18px "><?php echo \app\libs\Method::time_tran($v['createTime']) ?></em>
                                                        <!--回复-->
                                                        <!--                                                <em>-->
                                                        <!---->
                                                        <!--                                                    <a href="javascript:;" onclick="dxksst_reply(4941,'Hrisi01',9762);">回复</a>-->
                                                        <!--                                                </em>-->
                                                        <!--有权限的删除 显示-->

                                                        <!--                                                <em>-->
                                                        <!--                                                    &nbsp;-->
                                                        <!--                                                    <a href="javascript:;" onclick="dxksst_reply_delete(4941,674);">删除</a>-->
                                                        <!--                                                </em>-->


                                                    </div>
                                                </li>
                                                <?php
                                            }
                                            ?>
                                        </ul>
                                        <div class="bg-f reply_online">
                                            <textarea class="int_text2" cols="30" rows="10"
                                                      placeholder="我也来说两句……"></textarea>

                                            <div class="tr">
                                                <a class="push_btn" onclick="childReply(<?php echo $v['id'] ?>,this)"
                                                   href="javascript:;">评论</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <p class="tr issTime">
                                    <?php echo \app\libs\Method::time_tran($v['createTime']) ?>
                                    <a class="jub" href="#">举报</a>
                                    <a class="zhic" href="#">支持</a>
                                    <a class="fand" href="#">反对</a>
                                </p>
                            </div>
                        </div>

                        <!--                    <div class="tm">-->
                        <!--                        <img src="images/line_2.png" alt="">-->
                        <!--                        <p class="other_reply inb">还有3条回复，<span class="show_other">点击查看</span></p>-->
                        <!--                        <img src="images/line_2.png" alt="">-->
                        <!--                    </div>-->
                    </div>
                    <?php
                }
                ?>
            </div>
            <!--        分页-->
            <!--            <div class="w895 pwp">-->
            <!--                <ul class="pageSize tr">-->
            <!--                    <li class="on"><a href="#">1</a></li>-->
            <!--                    <li><a href="#">2</a></li>-->
            <!--                    <li><a href="#">3</a></li>-->
            <!--                    <li><a href="#">下一页</a></li>-->
            <!--                </ul>-->
            <!--            </div>-->
            <script type="text/javascript">
                function taggle(e) {
                    var obj = $(e).parent(".open").next('.taglle');
                    obj.toggle();
                }
                function childReply(_id, _this) {
                    var content = $(_this).parent('.tr').siblings('.int_text2').val();
                    $.post("/cn/api/post-reply", {id: _id, content: content, type: 2}, function (re) {
                        alert(re.message);
                        if (re.code == 1) {
                            location.reload();
                        }
                    }, 'json')
                }
            </script>
            <!--        评论-->
            <div class="w895 bg-f" id="localReply">
                <div class="publish_wrap clearfix">
                    <div class="issuer_img2 inUp fl"><img
                            src="<?php echo isset($v['image']) ? $v['image'] : '/cn/img/noavatar_big.gif' ?>" alt="">
                    </div>
                    <div class="inUp fr">
                        <div class="intWrap relative">
                            <img class="crow_t ani" src="/cn/images/crow_t.png" alt="">
                            <textarea class="int_text" name="" id="" cols="30" rows="10"
                                      placeholder="随便说点什么吧？"></textarea>
                        </div>
                        <div class="tr">
                            <a class="push_btn" onclick="Reply(<?php echo $data['id'] ?>)" href="javascript:;">发表</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--        右侧-->
        <div class="fr w285">
            <div class="issueWrap clearfix">
                <a href="/add.html">
                    <div class="issueBtn tm fr">
                        <img src="/cn/images/ic-5B.png" alt="">
                        <span class="inb">我要发布新帖</span>
                    </div>
                </a>
            </div>
            <div class="masterWrap">
                <h1>楼主</h1>
            </div>
            <ul class="admin">
                <li>
                    <a href="#"><img src="<?php echo isset($v['image']) ? $v['image'] : '/cn/img/noavatar_big.gif' ?>"
                                     alt=""></a>
                    <p>admin</p>
                </li>
            </ul>
            <div class="rBanner relative">
                <div class="hd">
                    <ul></ul>
                </div>
                <ul class="banner">
                    <?php
                    $banner = \app\modules\hot\models\Banner::find()->asArray()->where('tag=2')->limit(4)->all();
                    foreach ($banner as $v) {
                        ?>
                        <li><a href="<?php echo $v['url'] ?>"><img src="<?php echo $v['image'] ?>" alt=""></a></li>
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
<script type="text/javascript">
    function Reply(_id) {
        var content = $('.int_text').val();
        $.post("/cn/api/post-reply", {id: _id, content: content, type: 1}, function (re) {
            alert(re.message);
            if (re.code == 1) {
                location.reload();
            }
        }, 'json')
    }
    //    课程推荐
    jQuery(".rBanner").slide({
        mainCell: ".banner",
        titCell: ".hd ul",
        effect: "leftLoop",
        autoPage: "<li></li>",
        autoPlay: true
    });
</script>
<script>
    var editor = UE.getEditor('editor', {initialFrameWidth: null});
</script>
<script>

    //实例化编辑器
    var o_ueditorupload = UE.getEditor('j_ueditorupload',
        {
            autoHeightEnabled: false
        });
    o_ueditorupload.ready(function () {

        o_ueditorupload.hide();//隐藏编辑器

        o_ueditorupload.addListener('afterUpfile', function (t, arg) {
            $('.file').val(arg[0].url);
        });
    });

    //    弹出文件上传的对话框
    function upFiles() {
        var myFiles = o_ueditorupload.getDialog("attachment");
        myFiles.open();
    }

</script>
<script type="text/plain" id="j_ueditorupload"></script>
</body>
</html>