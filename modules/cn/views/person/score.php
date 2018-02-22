<link rel="stylesheet" href="/cn/css/person-cmn.css">
<link rel="stylesheet" href="/cn/css/person.css">

<!--内容区-->
<div class="person p-container clearfix">
  <?php use app\commands\front\PersonWidget;?>
  <?php PersonWidget::begin();?>
  <?php PersonWidget::end();?>
  <!--内容区-->
  <section class="person-cnt">

  </section>
</div>
<script src="/cn/js/details.js"></script>
<script>
  //  我要规划
  jQuery(".project").slide({});
  //  热帖排行榜
  jQuery(".ranking").slide({});
</script>
