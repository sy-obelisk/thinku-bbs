<link rel="stylesheet" href="/cn/css/question.css">
<!--内容区-->
<div class="question p-container">
  <section class="p-posts clearfix">
    <div class="quest-wrap">
      <!--路径导航-->
      <ul class="bread-crumb">
        <li><a href="/">首页</a><span>&gt;</span>问答广场</li>
      </ul>
      <!-- 提问内容-->
      <div class="quest-box">
        <div class="hd">
          <ul>
            <li class="on" data-cate="recommend">推荐</li>
            <li data-cate="new">最新</li>
            <li data-cate="question">等待回复</li>
          </ul>
        </div>
        <div class="bd">
          <!--推荐-->
          <ul class="quest-list"></ul>
        </div>
      </div>
    </div>
    <!--侧边栏-->
    <?php use app\commands\front\RightWidget;?>
    <?php RightWidget::begin();?>
    <?php RightWidget::end();?>
  </section>
</div>
<script type="text/javascript" src="/cn/js/question.js"></script>
<script type="text/javascript">
  //  侧边栏我要规划
  jQuery(".project").slide({});
  //  侧边栏热帖排行榜
  jQuery(".ranking").slide({});
</script>