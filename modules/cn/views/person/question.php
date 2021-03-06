
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
          <?php foreach($list as $k=>$v){?>
        <li class="item">
          <div class="head">
            <img src="<?php echo $data[$k]['image']!=false?$data[$k]['image']:'/cn/images/head.png'?>" alt="">
          </div>
          <div class="cnt">
            <h5><span class="logo">Q</span><a href="/details/<?php echo $v['id']?>.html"><?php echo $v['name']?></a></h5>
            <div class="answer">
              <span class="logo">A</span>
              <div><?php echo $data[$k]['comment']?></div>
            <div class="info clearfix">
              <p><span><?php echo $data[$k]['userName']?></span>发起了提问</p>
              <p><span><?php echo $data[$k]['count']?>人回复</span>|<span><?php echo $v['viewCount']?>次浏览</span></p>
              </div>
            </div>
        </li>
          <?php }?>
        <!---分页-->
          <div>
              <?php echo $page;?>
          </div>

      </ul>
    </div>
  </section>
</div>
