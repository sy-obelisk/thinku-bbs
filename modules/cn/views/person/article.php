
 <link rel="stylesheet" href="/cn/css/person-cmn.css">
 <link rel="stylesheet" href="/cn/css/person-article.css">

<!--内容区-->
<div class="person p-container clearfix">
  <?php use app\commands\front\PersonWidget;?>
  <?php PersonWidget::begin();?>
  <?php PersonWidget::end();?>
  <!--内容区-->
  <section class="person-cnt article-cnt">
    <div class="post-msg">
      <a href="">发帖</a>
    </div>
    <div class="article-tab">
      <p>我的帖子</p>
      <p>板块/群组</p>
    </div>
    <ul class="article-list">
      <li class="clearfix">
        <div class="article-img">
          <img src="" alt="">
        </div>
        <div class="article-info">
          <h3><a href="">帖子的标题</a></h3>
          <div>
            <p>发表于<span>2018-01-11</span></p>
            <p><span>查看：111</span>|<span>回复：333</span></p>
          </div>
        </div>
        <div class="sort">美国留学</div>
      </li>
      <li class="clearfix">
        <div class="article-img">
          <img src="" alt="">
        </div>
        <div class="article-info">
          <h3><a href="">帖子的标题</a></h3>
          <div>
            <p>发表于<span>2018-01-11</span></p>
            <p><span>查看：111</span>|<span>回复：333</span></p>
          </div>
        </div>
        <div class="sort">美国留学</div>
      </li>
      <li class="clearfix">
        <div class="article-img">
          <img src="" alt="">
        </div>
        <div class="article-info">
          <h3><a href="">帖子的标题</a></h3>
          <div>
            <p>发表于<span>2018-01-11</span></p>
            <p><span>查看：111</span>|<span>回复：333</span></p>
          </div>
        </div>
        <div class="sort">美国留学</div>
      </li>
      <!---分页-->
      <div class="page-wrap">
        <ul class="pagination" id="pagination1"></ul>
      </div>
    </ul>
  </section>
</div>
<script>
  //  全部消息分页
  $.jqPaginator('#pagination1', {
    totalPages: 20,
    visiblePages: 7,
    currentPage: 1,
    onPageChange: function (num, type) {
      console.log(num,type);
      // $('#p1').text(type + '：' + num);
    }
  });
</script>
