
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
<!--        <li><span>已读消息</span></li>-->
      </ul>
    </div>
    <div class="info-box bd">
      <!--全部消息-->
      <ul class="info-list">
        <?php foreach($arr as $v){?>
        <li>
          <div class="img">
            <img src="<?php echo $v['image']?>" alt="">
          </div>
          <div class="text">
           <?php echo $v['news']?>
          </div>
          <p class="time"><?php echo date('Y-m-d H:i:s',$v['createTime'])?></p>
        </li>
        <?php }?>
      </ul>
      <!--未读消息-->
      <ul class="info-list">
        <?php foreach($new as $v){?>
          <li>
            <div class="img">
              <img src="<?php echo $v['image']?>" alt="">
            </div>
            <div class="text">
              <?php echo $v['news']?>
            </div>
            <p class="time"><?php echo date('Y-m-d H:i:s',$v['createTime'])?></p>
          </li>
        <?php }?>
      </ul>
      <!--已读消息-->
<!--      <ul class="info-list">-->
<!--        <li>-->
<!--          <div class="img">-->
<!--            <img src="" alt="">-->
<!--          </div>-->
<!--          <div class="text">-->
<!--            系统消息系统消息系统消息系统消息系统消息系统消息系统消息系统消息系统消息系统消息-->
<!--          </div>-->
<!--          <p class="time">2018-01-22</p>-->
<!--        </li>-->
<!--        <li>-->
<!--          <div class="img">-->
<!--            <img src="" alt="">-->
<!--          </div>-->
<!--          <div class="text">-->
<!--            系统消息系统消息系统消息系统消息系统消息系统消息系统消息系统消息系统消息系统消息-->
<!--          </div>-->
<!--          <p class="time">2018-01-22</p>-->
<!--        </li>-->
<!--      </ul>-->
    </div>
  </section>
</div>
<script>
  jQuery(".info-cnt").slide({});
</script>
