
  <link rel="stylesheet" href="/cn/css/person-cmn.css">
  <link rel="stylesheet" href="/cn/css/person-head.css">

<!--内容区-->
<div class="person p-container clearfix">
  <?php use app\commands\front\PersonWidget;?>
  <?php PersonWidget::begin();?>
  <?php PersonWidget::end();?>
  <!--内容区-->
  <section class="person-cnt head-cnt">
    <div class="head-now">
      <p>当前我的头像</p>
      <div>
        <img src="" alt="">
      </div>
    </div>
    <div class="head-up">
      <p>设置我的新头像</p>
      <div>
        <p>上传头像</p>
      </div>
    </div>
  </section>
</div>
