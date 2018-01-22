<?php
use app\libs\Method;
$getTime = new Method()
?>
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
    <link rel="stylesheet" href="/cn/css/swipebox.css">
    <link rel="stylesheet" href="/cn/css/main.css">
    <link rel="stylesheet" href="/cn/css/topic-details.css">
    <link rel="stylesheet" href="/cn/css/animate.min.css">
    <script type="text/javascript" src="/ueditor/ueditor.config.js"></script>
    <!-- 编辑器源码文件 -->
    <script type="text/javascript" src="/ueditor/ueditor.all.min.js"></script>
    <script src="/cn/js/jquery-1.12.2.min.js"></script>
    <script src="/cn/js/jquery.swipebox.js"></script>
    <script src="/cn/js/jquery.SuperSlide.2.1.1.js"></script>
    <script src="/cn/js/getRequest.js"></script>
    <script src="/cn/js/showImg.js"></script>
    <script src="/cn/js/topic-details.js"></script>
    <title><?php echo isset($question['title']) ? $question['title'] : '' ?>-雷哥网社团-我们就爱分享知识！</title>
</head>
<body>
<!--搜索-->
<?php use app\commands\front\NavWidget; ?>
<?php NavWidget::begin(); ?>
<?php NavWidget::end(); ?>
<!--当前位置-->
<section>
    <div class="w12 location">
        <div class="tzTop2">
        <a href="/">首页</a>&nbsp;>&nbsp;<a href="/topic_square.html">话题</a>&nbsp;>&nbsp;<a href="/topic/<?php echo $topic['id'] ?>.html"><?php echo $topic['name'] ?></a>&nbsp;>&nbsp;<em><?php echo isset($question['title']) ? $question['title'] : '' ?></em>
    </div>
    </div>
</section>
<section class="qDe-wrap">
    <div class="w12 clearfix">
        <div class="w895 fl">
            <div class="q-header">
                <div class="htWrap">
                    <?php
                    foreach ($topics as $v) {
                        ?>
                        <a href="/topic/<?php echo $v['id'] ?>.html"><?php echo $v['name'] ?></a>
                        <?php
                    }
                    ?>
                </div>
                <div class="qMain" data-userId="<?php echo Yii::$app->session->get('uid'); ?>">
                    <h1 class="qTitle"><?php echo isset($question['title']) ? $question['title'] : '' ?></h1>
                    <div class="qDetail">
                        <span
                            class="RichText"><?php echo isset($question['content']) ? $question['content'] : '' ?></span>
                    </div>
                </div>
                <div class="qSlide">
                    <div class="NumberBoard-item"><span class="NumberBoard-name">被浏览</span><span
                            class="NumberBoard-value"><?php echo isset($question['viewCount']) ? $question['viewCount'] : '0' ?></span>
                    </div>
                    <button class="Button answerBtn" type="button">
                        <svg viewBox="0 0 12 12" class="Icon Button-icon Icon--modify" width="14" height="16">
                            <title></title>
                            <g>
                                <path
                                    d="M.423 10.32L0 12l1.667-.474 1.55-.44-2.4-2.33-.394 1.564zM10.153.233c-.327-.318-.85-.31-1.17.018l-.793.817 2.49 2.414.792-.814c.318-.328.312-.852-.017-1.17l-1.3-1.263zM3.84 10.536L1.35 8.122l6.265-6.46 2.49 2.414-6.265 6.46z"
                                    fill-rule="evenodd"></path>
                            </g>
                        </svg>
                        写回答
                    </button>
                </div>
            </div>
            <div class="Card card_answer_content">
                <div class="List-header">
                    <h4 class="List-headerText"><span><em class="answerNum"><?php echo count($data) ?></em>个回答</span>
                    </h4>
                </div>
                <?php foreach ($data as $v) { ?>
                    <div class="list-item">
                        <div class="AuthorInfo-wrap">
                            <div class="testImg-big inb"><img
                                    src="<?php echo isset($v['image']) ? $v['image'] : '/cn/images/banner-1.png' ?>"
                                    alt="">
                            </div>
                            <div class="inb">
                                <p class="AuthorInfo-name"><?php echo isset($v['username']) ? $v['username'] : '' ?></p>
                            </div>
                        </div>
                        <div class="qDetail">
                            <span class="RichText"><?php echo isset($v['content']) ? $v['content'] : '' ?></span>
                        </div>
                        <div class="ContentItem-time">
                            <a class="fl" href="#"
                               target="_blank"><span>编辑于 <?php echo isset($v['createTime']) ? date('Y-m-d H:i:s', $v['createTime']) : '' ?></span></a>

                            <button class="Button ContentItem-action active-answer fr" type="button">
                                <svg viewBox="0 0 18 18" xmlns="http://www.w3.org/2000/svg"
                                     class="Icon Icon--comment Icon--left" width="12" height="16">
                                    <g>
                                        <path
                                            d="M7.24 16.313c-.272-.047-.553.026-.77.2-1.106.813-2.406 1.324-3.77 1.482-.16.017-.313-.06-.394-.197-.082-.136-.077-.308.012-.44.528-.656.906-1.42 1.11-2.237.04-.222-.046-.45-.226-.588C1.212 13.052.027 10.73 0 8.25 0 3.7 4.03 0 9 0s9 3.7 9 8.25-4.373 9.108-10.76 8.063z"></path>
                                    </g>
                                </svg>
                                <?php echo $v['reply']['count'] ?>条评论
                            </button>

                        </div>
                        <div class="Comments Comments--withEditor Comments-withPagination">
                            <div class="CommentTopbar">
                                <div class="CommentTopbar-meta">
                                    <h2 class="CommentTopbar-title"><?php echo $v['reply']['count'] ?>条评论</h2>
                                </div>
                            </div>
                            <div class="CommentList-wrap">
                                <!--                    评论列表-->
                                <div class="CommentList">
                                    <?php foreach (array_reverse($v['reply']['data']) as $va) { ?>
                                        <div class="CommentItem">
                                            <div class="CommentItem-meta clearfix">
                                                <div class="fl">
                                                    <div class="testImg inb"><img
                                                            src="<?php echo isset($va['image']) ? $va['image'] : '/cn/images/banner-1.png' ?>"
                                                            alt=""></div>
                                                    <div class="inb userLink">
                                                        <span><?php echo isset($va['username']) ? $va['username'] : '' ?></span>
                                                        <!--                                        <span class="CommentItem-reply">回复</span>-->
                                                        <!--                                        <span class="UserLink"><a class="UserLink-link" href="#">温酒</a></span>-->
                                                        <!--                                        <span class="CommentItem-roleInfo">（作者）</span>-->
                                                    </div>

                                                </div>
                                            <span
                                                class="CommentItem-time"><?php echo isset($va['createTime']) ? $getTime->time_tran($va['createTime']) : '' ?> </span>
                                            </div>
                                            <div
                                                class="RichText CommentItem-content"><?php echo isset($va['content']) ? $va['content'] : '' ?></div>
                                            <!--                            回复按钮-->
                                            <!--                            <div>-->
                                            <!--                                <button class="Button CommentItem-hoverBtn Button--plain" type="button"><svg viewBox="0 0 22 16" class="Icon Icon--reply Icon--left" width="13" height="16" ><title></title><g><path d="M21.96 13.22c-1.687-3.552-5.13-8.062-11.637-8.65-.54-.053-1.376-.436-1.376-1.56V.677c0-.52-.635-.915-1.116-.52L.47 6.67C.18 6.947 0 7.334 0 7.763c0 .376.14.722.37.987 0 0 6.99 6.818 7.442 7.114.453.295 1.136.124 1.135-.5V13c.027-.814.703-1.466 1.532-1.466 1.185-.14 7.596-.077 10.33 2.396 0 0 .395.257.535.257.892 0 .614-.967.614-.967z"></path></g></svg>回复</button>-->
                                            <!--                            </div>-->
                                        </div>
                                        <?php
                                    }
                                    ?>
                                </div>
                                <ul class="pageSize Pagination comments-pagination"
                                    data-answerId="<?php echo $v['id'] ?>">
                                    <?php echo $v['reply']['pageStr'] ?>
                                </ul>
                            </div>
                            <div class="replay-wrap">
                                <div class="replyInt inb input"><textarea class="inputInt" placeholder="写下你的评论..."
                                                                          type="text"></textarea>
                                </div>
                                <button class="Button replyBtn" type="button">评论</button>
                            </div>
                        </div>

                    </div>
                    <?php
                }
                ?>
            </div>
            <!--编辑器 占位图-->
            <div style="padding-right: 2px">
                <textarea id="editor" name="data[content]"></textarea>
                <div class="tr aSubt">
                    <button class="Button AnswerForm-submit Button--primary Button--blue" type="button">提交回答</button>
                </div>
            </div>
        </div>
        <div class="w285 fr">
            <?php if(count($hotQuestion)>0){ ?>
            <div class="Card">
                <div class="dr_tit">相关问题</div>
                <div class="Card-section">
                    <!--                    只显示5个-->
                    <?php
                    foreach ($hotQuestion as $v) {
                        ?>
                        <div class="questions-item">
                            <a class="aBt"
                               href="/cn/question/<?php echo $topicId ?>-<?php echo $v['id'] ?>.html"><?php echo $v['title'] ?></a>
                        </div>
                        <?php
                    }
                    ?>
                </div>
            </div>
            <?php
            }
            ?>
            <div class="Card">
                <div class="dr_tit">相关 Live 推荐</div>
                <div class="Card-section">
                    <?php
                    foreach($hotPost as $v) {
                        ?>
                        <a class="RelatedLives-item" href="/post/details/<?php echo $v['id']?>.html">
                            <div class="dr_img inb"><img src="<?php echo isset($v['image'])?$v['image']:'/cn/img/noavatar_big.gif' ?>" alt=""></div>
                            <div class="RelatedLives-subject"><?php echo $v['title']; ?></div>
                        </a>
                        <?php
                    }
                    ?>
                </div>
            </div>
            <!--热门课程推荐-->
            <div class="Card">
                <div class="dr_tit">热门课程推荐</div>
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
<!--                                        <div class="boxWrap slideBox-1">-->
<!--                                            <div class="hd">-->
<!--                                                <ul></ul>-->
<!--                                            </div>-->
<!--                                            <ul class="banner">-->
<!--                                                <li><a href="#"><img src="/cn/images/r-2.png" alt=""></a></li>-->
<!--                                                <li><a href="#"><img src="/cn/images/r-2.png" alt=""></a></li>-->
<!--                                                <li><a href="#"><img src="/cn/images/r-2.png" alt=""></a></li>-->
<!--                                            </ul>-->
<!--                                        </div>-->
<!--                                        <div class="boxWrap slideBox-1">-->
<!--                                            <div class="hd">-->
<!--                                                <ul></ul>-->
<!--                                            </div>-->
<!--                                            <ul class="banner">-->
<!--                                                <li><a href="#"><img src="/cn/images/r-2.png" alt=""></a></li>-->
<!--                                                <li><a href="#"><img src="/cn/images/r-2.png" alt=""></a></li>-->
<!--                                                <li><a href="#"><img src="/cn/images/r-2.png" alt=""></a></li>-->
<!--                                            </ul>-->
<!--                                        </div>-->
<!--                                    </div>-->

                </div>
                <!--微信交流群-->
                <div class="exchange-wrap Card slideBox-2">
                    <div class="hd">
                        <ul></ul>
                    </div>
                    <ul class="banner">
                        <?php
                        foreach($qr_code as $v) {
//                            ?>
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
    </div>
</section>
<?php use app\commands\front\FooterWidget; ?>
<?php FooterWidget::begin(); ?>
<?php FooterWidget::end(); ?>
</body>
</html>
