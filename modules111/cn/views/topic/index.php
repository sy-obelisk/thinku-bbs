<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<!--    <script async="" src="js/ga.js"></script>-->

    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="renderer" content="webkit">
    <title><?php echo isset($topic['name']) ? $topic['name'] : '' ?>-雷哥网社团-我们就爱分享知识！</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta id="znonce" name="znonce" content="2a42706a06b8460ead9047ea19da58db">
    <meta name="keywords" content="雷哥培训，GMAT网课，GMAT培训，托福网课，托福培训，雅思网课，雅思培训，零中介留学，美国留学，出国留学，留学申请，留学文书、海外实习">
    <meta name="description" content="雷哥网社团-我们就爱分享知识！留学备考智能服务平台。">
    <link rel="stylesheet" href="/cn/css/topic.css">
    <link rel="stylesheet" href="/cn/css/header.css">
    <link rel="stylesheet" href="/cn/css/main.css">
    <link rel="stylesheet" href="/cn/css/reset.css">
    <link rel="stylesheet" href="/cn/css/common.css">
    <link rel="stylesheet" href="/cn/css/common-topic.css">
    <link rel="stylesheet" href="/cn/css/topic-gc.css">
    <!--[if lt IE 9]>
    <!--<script src="https://static.zhihu.com/static/components/respond/dest/respond.min.js"></script>-->
<!--    <script src="/cn/js/respond.proxy.js"></script>-->
    <!--[endif]-->
<!--    <script src="/cn/js/instant.14757a4a.js"></script>-->
    <script src="/cn/js/jquery-1.12.2.min.js"></script>
    <script src="/cn/js/jquery.SuperSlide.2.1.1.js"></script>
    <script src="/cn/js/showImg.js"></script>
    <script src="/cn/js/topic.js"></script>

</head>

<body class="zhi ">


<!--搜索-->
<?php use app\commands\front\NavWidget; ?>
<?php NavWidget::begin(); ?>
<?php NavWidget::end(); ?>
<!--当前位置-->
<section>
    <div class="w12 location">
        <div class="tzTop2">
        <a href="/">首页</a>&nbsp;>&nbsp;<a
            href="/topic_square.html">话题</a>&nbsp;>&nbsp;<em><?php echo $topic['name'] ?></em>
        </div>
    </div>
</section>
<div class="w12 zu-main clearfix " style="padding-top: 0;" id="main-topic" data-topicId="<?php echo isset($_GET['topicId']) ? $_GET['topicId'] : '' ?>" role="main" aria-hidden="false">
    <div class="w850 fl">
        <?php

            if(count($userTopic)>0) {
                ?>
                <div class="zm-topic-cat-title clearfix">
                    <h2 class="fl bT"><i class="zg-icon zg-icon-topic-square"
                                         style="background-position: -71px -88px;width: 16px;height: 16px;"></i>已参与的话题动态
                    </h2>
                    <a class="fr gzing" href="#">共关注<?php echo count($userTopic)?>个话题</a>
                </div>
                <ul class="topicList clearfix" style="border-bottom:1px solid #ccc;">
                    <?php
                        foreach($userTopic as $v) {
                            ?>
                            <li><a href="/topic/<?php echo $v['id']?>.html"><?php echo $v['name']?></a></li>
                        <?php
                        }
                    ?>
                    <!--                <a href="#">运动</a>-->
                </ul>
            <?php
            }else {
                ?>
                <div class="zm-topic-cat-title clearfix">
                    <h2 class="fl bT"><i class="zg-icon zg-icon-topic-square"
                                         style="background-position: -71px -88px;width: 16px;height: 16px;"></i>你还未参与任何话题
                    </h2>
                </div>
            <?php
            }
        ?>
        <div style="padding-top: 28px;" class="zu-main-content">
            <div class="zu-main-content-inner">

                <div class="topic-info">
                    <div class="clearfix">
                        <h1 class="zm-editable-content questionName">
                            <div class="questionName_img inb"><img src="<?php echo isset($topic['image']) ? $topic['image'] : '' ?>" alt=""></div>
                            <?php echo isset($topic['name']) ? $topic['name'] : '' ?>
                        </h1>
                        <a class="qBt fr common_right_btn sign_btn" href="javascript:void(0);"><span class="un_signed">我要提问</span></a>
                    </div>

                </div>

                <div class="zu-main-feed-con navigable">
                    <?php foreach ($data['data'] as $v) { ?>
                        <div id="js-home-feed-list" class="zh-general-list topstory clearfix">
                            <div class="feed-item folding feed-item-hook">
                                <div class="feed-item-inner">
                                    <div class="feed-content" data-za-module="AnswerItem">
                                        <h2 class="feed-title">
                                            <a class="question_link"
                                               href="/cn/question/<?php echo $topic['id'] ?>-<?php echo $v['id'] ?>.html?questionId=<?php echo $v['id'] ?>"
                                               target="_blank"><?php echo $v['title'] ?></a>
                                        </h2>
                                        <?php
                                        foreach($v['answer'] as $va) {
                                            ?>
                                            <div class="relative reInfo">
                                                <a href="javascript:;" class="vCount"
                                                   title="<?php echo $v['viewCount'] ?>人查看"><?php echo $v['viewCount'] ?></a>
                                                <div class="expandable entry-body">

                                                    <div class="zm-item-answer-author-info">
                                                        <span
                                                            class="author-link size_10"><?php echo $va['user']['username'] ?></span>
                                                    </div>
                                                    <div class="zm-item-rich-text expandable js-collapse-body">
                                                        <div class="zh-summary summary clearfix size_box">
                                                            <?php echo isset($va['content']) ? $va['content'] : '还没有首楼，赶紧成为首楼' ?>
                                                        </div>
                                                    </div>

                                                </div>
                                                <div class="feed-meta sall_box clearfix">
                                                    <span class="meta-item toggle-comment js-toggleCommentBox"><i
                                                            class="z-icon-comment"></i><?php echo $va['commentNum'] ?>
                                                        条评论</span>
                                                </div>
                                            </div>
                                            <?php
                                        }
                                        ?>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <?php
                    }
                    ?>
                    <a href="javascript:;" data-page="2" id="zh-load-more" data-method="next"
                       class="zg-btn-white zg-r3px zu-button-more"
                       style="">更多</a>
                </div>

            </div>
        </div>
    </div>
    <div class="w285 fr">
        <div class="topics-plaza">
            <a target="_blank" href="/topic_square.html" class="zg-btn-blue">进入话题广场</a>
            <a target="_blank" href="/topic_square.html" class="text">
                来这里发现更多有趣话题
            </a>
        </div>
        <div class="zm-topic-cat-title clearfix">
            <h2 class="bT">热门话题</h2>
        </div>
        <ul class=" hotGc hotWrap">
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
<section class="questionWrap">
    <div class="modal-dialog">
        <div class="modal-dialog-title">
            <span class="modal-dialog-title-text" id=":2m" role="heading">提问</span>
            <span class="modal-dialog-title-close" role="button" tabindex="0" aria-label="Close"></span>
        </div>
        <div class="modal-dialog-content">
            <div class="before-ask-form">
                <b>提问前请先搜索</b>
                <div style="position:relative;margin-top:18px;">
                    <input type="text" class="zg-form-text-input" id="js-before-ask" placeholder="请输入你的问题">
                </div>
                <div class="ac-renderer">
                    <div class="ac-hive">
                        <div class="ac-row ac-first"><b>你想问的是不是：</b></div>
                        <div class="ac-list-one">
                            <div class="ac-row">
                                <a href="#">如何评价电影《希特勒回来了》(Er ist wieder da)?</a>
                                <span class="zm-ac-gray">285 个回答 </span>
                            </div>
                        </div>
                    </div>

                    <div class="ac-row ac-last iwanttoask">
                        <a href="javascript:;">不是，我要提一个新问题»</a>
                    </div>
                </div>
            </div>
            <form class="form-data" action="#">
                <div class="zm-add-question-form-topic-wrap">
                    <div class="zg-section-big">
                        <div class="zg-form-text-input add-question-title-form ">
                            <textarea class="zg-editor-input zu-seamless-input-origin-element" title="在这里输入问题"
                                      id="title" placeholder="写下你的问题"></textarea>
                        </div>
                        <div id="zh-question-suggest-ac-wrap" class="question-suggest-ac-wrap">
                            <div class="ac-renderer" role="listbox">
                                <div class="ac-head zg-gray">你的问题可能已经有答案</div>
                                <div class="ac-list-two">
                                    <!--                                    <div class="ac-row goog-zippy-header goog-zippy-collapsed">-->
                                    <!--                                        <a href="#">作？dsa</a> <span class="zm-ac-gray">3 个回答 </span>-->
                                    <!--                                    </div>-->
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="zg-section-big">
                        <div class="add-question-section-title">
                            问题说明（可选）：
                        </div>
                        <div class="zm-editable-editor-field-wrap">
                            <textarea id="content" class="zm-editable-editor-field-element editable"></textarea>
                        </div>
                    </div>
                    <div class="add-question-section-title">
                        <span class="zg-gray fr hidden-phone">话题越精准，越容易让跟你一样备考的战友看到你的问题</span>
                        选择话题：
                        <span id="zh-question-form-tag-err">至少添加一个话题</span>
                    </div>
                    <div id="zh-question-suggest-topic-container" class="zm-tag-editor zg-section">
                        <div class="zm-tag-editor-labels"></div>
                        <div class="zm-tag-editor-editor zg-clear">
<!--                            话题标签-->
                            <div class="zg-inline" data-id="<?php echo $topic['id'] ?>">
                                <div class="zm-tag-editor-edit-item">
                                    <span><?php echo $topic['name'] ?></span>
                                    <a href="javascript:;" class="zg-r3px zm-tag-editor-remove-button" name="remove">
                                </div>
                            </div>
                            <div class="zm-tag-editor-command-buttons-wrap zg-left">
                                <label for="topic" class="zg-icon icon-magnify"></label>
                                <input class="zu-question-suggest-topic-input label-input-label" type="text"
                                       placeholder="搜索话题">
                                <a class="zg-mr15 zg-btn-blue" href="#" name="add" style="display: none;">添加</a>
                                <a href="#" name="close" style="display: none;">完成</a>
                                <label class="err-tip" style="display:none;">最多添加五个话题</label>
                                <div class="ac-renderer-2">
                                    <div class="ac-data" style="display: none"></div>
                                    <div class="ac-row ac-active ac-row-null" style="display: none">
                                        <span class="zu-autocomplete-row-name zu-info zu-autocomplete-row-name-info">没有找到话题：<b
                                                class="ac-highlighted"></b></span>
                                        <span
                                            class="add-new-topic zu-add-info zg-gray-normal zu-autocomplete-row-description">是否创建新话题</span>
                                    </div>
                                    <div class="ac-row ac-repeat ac-active" style="display: none">
                                        <span class="zg-gray-normal zu-autocomplete-row-description">请不要输入重复话题</span>
                                    </div>
                                </div>
                            </div>
                            <div class="zm-tag-editor-maxcount zg-section" style="display: none;">
                                <span>最多只能为一个问题绑定 5 个话题</span>
                                <a href="#" name="close" style="display: none;">完成</a>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="sug-con zg-clear" style="display: none;">
                    <span class="zg-gray-normal zg-left tip">推荐添加</span><span
                        class="sugs zg-clear zg-inline"></span>
                    <img data-src="https://static.zhihu.com/static/img/spinner2.gif" style="display: none;">
                </div>
                <div class="zm-command">
                    <a href="javascript:;" name="cancel" class="zm-command-cancel">取消</a>
                    <a href="javascript:;" name="addq" class="zg-r5px zu-question-form-add zg-btn-blue">发布</a>
                </div>
            </form>
        </div>

    </div>


</section>
<!--<script src="/cn/js/vendor.cb14a042.js" aria-hidden="true"></script>-->
<!--<script src="/cn/js/base.4cfce18f.js" aria-hidden="true"></script>-->

<!--<script src="/cn/js/common.6b2d25b7.js" aria-hidden="true"></script>-->


<!--<script src="/cn/js/richtexteditor.c68a1600.js" async="" aria-hidden="true"></script>-->
<!--<script src="/cn/js/page-main.c0accdb8.js" aria-hidden="true"></script>-->
<script>
    //        显示全文
    $('.reInfo').each(function(index){
        var _this=$(this);
        var box=_this.find('.size_box');
        var sall_box=_this.find('.sall_box');
        var text = box.text();
        var contentHtml=box.html();
        var newBox = document.createElement("div");
        var btn = document.createElement("span");
        $(newBox).html(text.substring(0, 200));
        $(btn).html(text.length > 200 ? "显示全部" : "").addClass("show-all");
        $(btn).on("click", function () {
            if ($(this).html() == "显示全部") {
                $(this).html("收起");
                $(newBox).html(contentHtml);
            } else {
                $(this).html("显示全部");
                $(newBox).html(text.substring(0, 200));
            }
        });
        box.html("");
        $(box).append($(newBox));
        $(sall_box).append($(btn));
    });
//    function show() {
//        var box = $(".size_box");
//        var text = box.text();
//        var contentHtml=box.html();
//        var newBox = document.createElement("div");
//        var btn = document.createElement("span");
//        $(newBox).html(text.substring(0, 200));
//        $(btn).html(text.length > 200 ? "显示全部" : "").addClass("show-all");
//        $(btn).on("click", function () {
//            if ($(this).html() == "显示全部") {
//                $(this).html("收起");
//                $(newBox).html(contentHtml);
//            } else {
//                $(this).html("显示全部");
//                $(newBox).html(text.substring(0, 200));
//            }
//        });
//        box.html("");
//        $(box).append($(newBox));
//        $('.sall_box').append($(btn));
//    }

//    show();
    $('#zh-load-more').click(function () {
        var page = $(this).attr('data-page');
        var topicId = $('#main-topic').attr('data-topicId');
        var str = '';
        $.ajax({
            url: '/cn/api/load-question',
            data: {
                topicId: topicId,
                page: page
            },
            dataType: 'json',
            type: 'post',
            success: function (data) {
                if (data.code == 0) {
                    $('#zh-load-more').html('暂无更多数据');
                    return false;
                }
                if (data.code == 1) {
                    $(this).attr('data-page', data.page);
                    for (var i = 0; i < data.data.data.length; i++) {
                        str += '<div class="feed-item folding feed-item-hook">' +
                            '<div class="feed-item-inner">' +
                            '<div class="feed-content" data-za-module="AnswerItem">' +
                            '<h2 class="feed-title">' +
                            '<a class="question_link" href="/cn/topic/question?questionId=' + data.data.data[i].id + '" target="_blank">' + data.data.data[i].title + '</a>' +
                            '</h2>' +
                            '<div class="expandable entry-body">' +

                            '<div class="zm-item-answer-author-info">' +
                            '<span class="author-link">' + data.data.data[i].user.username + '</span>' +
                            '</div>' +

                            '<div class="zm-item-rich-text expandable js-collapse-body">' +
                            '<div class="zh-summary summary clearfix">' + data.data.data[i].content + '' +
                            '</div>' +
                            '</div>' +
                            '</div>' +
                            '<div class="feed-meta">' +
                            '<span class="meta-item toggle-comment js-toggleCommentBox"><i class="z-icon-comment"></i>' + data.data.data[i].commentNum + '条评论</span>' +
                            '</div>' +
                            '</div>' +
                            '</div>' +

                            '</div>';

                    }
                    $('#js-home-feed-list').append(str);
                }

            }
        })
    })
</script>
<?php use app\commands\front\FooterWidget; ?>
<?php FooterWidget::begin(); ?>
<?php FooterWidget::end(); ?>
</body>
</html>