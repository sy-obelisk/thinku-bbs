
<link rel="stylesheet" href="/cn/css/search.css">
<!--内容区-->
<div class="list-wrap p-container">
  <ul class="bread-crumb">
    <li><a href="/index.html">首页</a><span>&gt;</span>搜索的内容</li>
  </ul>
  <section class="content p-posts clearfix">
    <div class="list-box">
      <div class="list-cnt">
        <ul>
          <?php if($data==false){ echo '暂未搜索到数据，换一个关键词试试！';}else{?>
          <?php foreach ($data as $v) { ?>
            <li class="list-item">
              <div class="img">
                <img src="<?php echo $v['image']?>" alt="">
              </div>
              <div class="right">
                <h3><a href="/details/<?php echo $v['id'] ?>.html"><?php $keyword = Yii::$app->request->get('keyword', '');echo (str_replace($keyword,"<span style='color:red;'>".$keyword.'</span>',strip_tags($v['name'])));?></a></h3>
                <div class="info-list clearfix">
                  <div class="first-div">
                    <span><?php echo $v['nickname'] ? $v['nickname'] : $v['userName'] ?></span>
                    <span>发布于<?php echo substr($v['createTime'], 0, 10) ?></span>
                  </div>
                  <div class="last-div">
                    <p><?php echo isset($v['last']['name']) && $v['last']['name'] != false ? "<span>" . $v['last']['name'] . "</span> <span>最后回复于" . $v['last']['time'] . "</span> " : '' ?></span></p>

                    <p><span>查看：<?php echo $v['viewCount'] ?> </span>|<span>回复：<?php echo $v['count'] ?></span></p>
                  </div>
                </div>
                <div class="abstract">
                  <?php echo $v['listeningFile'] ?>
                </div>
              </div>
            </li>
          <?php } }?>
        </ul>
        <!---分页-->
        <div>
          <?php echo $page;?>
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
  })

</script>
</html>