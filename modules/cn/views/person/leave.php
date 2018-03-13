
  <link rel="stylesheet" href="/cn/css/person-cmn.css">

<!--内容区-->
<div class="person p-container clearfix">
  <?php use app\commands\front\PersonWidget;?>
  <?php PersonWidget::begin();?>
  <?php PersonWidget::end();?>
  <!--内容区-->
  <section class="person-cnt person-box">
    <div class="box">
      <ul class="collect-list person-list">
        <?php foreach($data['data'] as $v){?>
        <li class="item">
          <div class="collect-img">
            <img src="<?php echo $v['image']!=false?$v['image']:'/cn/images/head.png'?>" alt="">
          </div>
          <div class="collect-right">
            <h3><a href=""><?php echo $v['name']?></a></h3>
            <div class="info-list clearfix">
              <div class="first-div"><span><?php echo $v['nickname']?$v['nickname']:$v['userName']?></span> <span>回复于<?php echo $v['createTime']?></span></div>
              <div class="last-div clearfix">
<!--                <p><span>Nicholas </span><span>最后回复于2018-01-12</span></p>-->
<!--                <p><span>查看：778  </span>|<span>回复：66</span></p>-->
              </div>
            </div>
            <div class="abstract">
             <?php echo $v['comment']?>
            </div>
        </li>
        <?php }?>
        <!---分页-->
<!--        <div class="page-wrap">-->
<!--          <ul class="pagination" id="pagination1"></ul>-->
<!--        </div>-->
        <div>
          <?php echo $page;?>
        </div>
      </ul>
    </div>
  </section>
</div>

