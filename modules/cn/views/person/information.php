
  <link rel="stylesheet" href="/cn/css/person-cmn.css">
  <link rel="stylesheet" href="/cn/css/person-info.css">

<!--内容区-->
<div class="person p-container clearfix">
  <?php use app\commands\front\PersonWidget;?>
  <?php PersonWidget::begin();?>
  <?php PersonWidget::end();?>
  <!--内容区-->
  <section class="person-cnt info-cnt">
    <div class="info-tab hd">
      <ul>
        <li class="on"><span>全部消息</span></li>
        <li><span>未读消息</span></li>
        <li><span>已读消息</span></li>
      </ul>
    </div>
    <div class="info-box bd">
      <!--全部消息-->
      <ul class="info-list">
        <li>
          <div class="img">
            <img src="" alt="">
          </div>
          <div class="text">
            系统消息系统消息系统消息系统消息系统消息系统消息系统消息系统消息系统消息系统消息
          </div>
          <p class="time">2018-01-22</p>
        </li>
        <li>
          <div class="img">
            <img src="" alt="">
          </div>
          <div class="text">
            系统消息系统消息系统消息系统消息系统消息系统消息系统消息系统消息系统消息系统消息
          </div>
          <p class="time">2018-01-22</p>
        </li>
        <div class="page-wrap">
          <ul class="pagination" id="pagination1"></ul>
        </div>
      </ul>
      <!--未读消息-->
      <ul class="info-list">
        <li>
          <div class="img">
            <img src="" alt="">
          </div>
          <div class="text">
            系统消息系统消息系统消息系统消息系统消息系统消息系统消息系统消息系统消息系统消息
          </div>
          <p class="time">2018-01-22</p>
        </li>
        <li>
          <div class="img">
            <img src="" alt="">
          </div>
          <div class="text">
            系统消息系统消息系统消息系统消息系统消息系统消息系统消息系统消息系统消息系统消息
          </div>
          <p class="time">2018-01-22</p>
        </li>
        <div class="page-wrap">
          <ul class="pagination" id="pagination2"></ul>
        </div>
      </ul>
      <!--已读消息-->
      <ul class="info-list">
        <li>
          <div class="img">
            <img src="" alt="">
          </div>
          <div class="text">
            系统消息系统消息系统消息系统消息系统消息系统消息系统消息系统消息系统消息系统消息
          </div>
          <p class="time">2018-01-22</p>
        </li>
        <li>
          <div class="img">
            <img src="" alt="">
          </div>
          <div class="text">
            系统消息系统消息系统消息系统消息系统消息系统消息系统消息系统消息系统消息系统消息
          </div>
          <p class="time">2018-01-22</p>
        </li>
        <div class="page-wrap">
          <ul class="pagination" id="pagination3"></ul>
        </div>
      </ul>
    </div>
  </section>
</div>
<script>
  jQuery(".info-cnt").slide({});
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
  //  未读消息分页
  $.jqPaginator('#pagination2', {
    totalPages: 20,
    visiblePages: 7,
    currentPage: 1,
    onPageChange: function (num, type) {
      console.log(num,type);
      // $('#p1').text(type + '：' + num);
    }
  });
  //  已读消息分页
  $.jqPaginator('#pagination3', {
    totalPages: 20,
    visiblePages: 7,
    currentPage: 1,
    onPageChange: function (num, type) {
      console.log(num,type);
      // $('#p1').text(type + '：' + num);
    }
  });
</script>
