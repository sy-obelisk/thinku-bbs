
<link rel="stylesheet" href="/cn/css/person-cmn.css">
<link rel="stylesheet" href="/cn/css/person-question.css">

<!--内容区-->
<div class="person p-container clearfix">
  <?php use app\commands\front\PersonWidget;?>
  <?php PersonWidget::begin();?>
  <?php PersonWidget::end();?>
  <!--内容区-->
  <section class="person-cnt person-box">
    <div class="box">
      <ul class="quest-list person-list">
        <li class="item">
          <div class="head">
            <img src="" alt="">
          </div>
          <div class="cnt">
            <h5><span class="logo">Q</span><a href="">问题</a></h5>
            <div class="answer">
              <span class="logo">A</span>
              <div>答案</div>
            <div class="info clearfix">
              <p><span>bfja</span>发起了提问</p>
              <p><span>2人回复</span>|<span>3次浏览</span></p>
              </div>
            </div>
        </li>
        <!---分页-->
        <div class="page-wrap">
          <ul class="pagination" id="pagination1"></ul>
        </div>
      </ul>
    </div>
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
