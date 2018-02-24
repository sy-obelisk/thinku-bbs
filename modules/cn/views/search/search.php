
<link rel="stylesheet" href="/cn/css/search.css">
<!--内容区-->
<div class="list-wrap p-container">
  <ul class="bread-crumb">
    <li><a href="">首页</a><span>&gt;</span>搜索的内容</li>
  </ul>
  <section class="content p-posts clearfix">
    <div class="list-box">
      <div class="list-cnt">
        <ul>
          <li class="list-item">
            <div class="img">
              <img src="" alt="">
            </div>
            <div class="right">
              <h3><a href="">12.30换库后CR逻辑鸡精—Zora</a></h3>
              <div class="info-list clearfix">
                <div class="first-div"><span>小托君</span> <span>发布于2017-12-22</span></div>
                <div class="last-div">
                  <p><span>查看：778 </span>|<span> 回复：66</span></p></div>
              </div>
              <div class="abstract">
                各位在一线备战托福的朋友们，主讲老师Zora，课程视频和课件在此下载学习；斩获更多托福
                信息，获取更多托福资讯，请添加微信公众号小托君。
              </div>
            </div>
          </li>
          <li class="list-item">
            <div class="img">
              <img src="" alt="">
            </div>
            <div class="right">
              <h3><a href="">12.30换库后CR逻辑鸡精—Zora</a></h3>
              <div class="info-list clearfix">
                <div class="first-div"><span>小托君</span> <span>发布于2017-12-22</span></div>
                <div class="last-div">
                  <p><span>查看：778 </span>|<span> 回复：66</span></p></div>
              </div>
              <div class="abstract">
                各位在一线备战托福的朋友们，主讲老师Zora，课程视频和课件在此下载学习；斩获更多托福
                信息，获取更多托福资讯，请添加微信公众号小托君。
              </div>
            </div>
          </li>
        </ul>
        <!---分页-->
        <div class="page-wrap">
          <ul class="pagination" id="pagination1"></ul>
        </div>
      </div>
    </div>
    <!--侧边栏-->
    <?php use app\commands\front\RightWidget;?>
    <?php RightWidget::begin();?>
    <?php RightWidget::end();?>
  </section>
</div>
<script>
  $(function () {
    $('.search-text').val("<?php echo Yii::$app->request->get('keyword', '');?>");
    //  侧边栏我要规划
    jQuery(".project").slide({});
    //  侧边栏热帖排行榜
    jQuery(".ranking").slide({});
    $.jqPaginator('#pagination1', {
      totalPages: 20,
      visiblePages: 7,
      currentPage: 1,
      onPageChange: function (num, type) {
        console.log(num,type);
        // $('#p1').text(type + '：' + num);
      }
    });
  })

</script>
</html>