
  <link rel="stylesheet" href="/cn/css/index.css">

<!--内容区-->
<div class="home p-container">
  <section class="posts p-posts clearfix">
    <div class="box">
      <div class="box-cnt">
        <ul>
          <li class="item">
            <div class="img">
              <img src="" alt="">
            </div>
            <div class="right">
              <h3><a href="">12.30换库后CR逻辑鸡精—Zora<i class="iconfont icon-hot"></a></i></h3>
              <div class="info-list clearfix">
                <div class="first-div"><span>小托君</span> <span>发布于2017-12-22</span></div>
                <div class="last-div">
                  <p><span>Nicholas </span><span>最后回复于2018-01-12</span></p>
                  <p><span>查看：778  </span>|<span>回复：66</span></p></div>
              </div>
              <div class="abstract">
                各位在一线备战托福的朋友们，主讲老师Zora，课程视频和课件在此下载学习；斩获更多托福
                信息，获取更多托福资讯，请添加微信公众号小托君。
              </div>
            </div>
          </li>
          <li class="item">
            <div class="img">
              <img src="" alt="">
            </div>
            <div class="right">
              <h3><a href="">12.30换库后CR逻辑鸡精—Zora<i class="iconfont icon-hot"></a></i></h3>
              <div class="info-list clearfix">
                <div class="first-div"><span>小托君</span> <span>发布于2017-12-22</span></div>
                <div class="last-div">
                  <p><span>Nicholas </span><span>最后回复于2018-01-12</span></p>
                  <p><span>查看：778  </span>|<span>回复：66</span></p></div>
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
    //  侧边栏我要规划
    jQuery(".project").slide({});
//  侧边栏热帖排行榜
    jQuery(".ranking").slide({});

//    分页
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