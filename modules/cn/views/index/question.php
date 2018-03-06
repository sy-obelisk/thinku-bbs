<link rel="stylesheet" href="/cn/css/question.css">
<!--内容区-->
<div class="question p-container">
  <section class="p-posts clearfix">
    <div class="quest-wrap">
      <!--路径导航-->
      <ul class="bread-crumb">
        <li><a href="/">首页</a><span>&gt;</span>问答广场</li>
      </ul>
      <!-- 提问内容-->
      <div class="quest-box">
        <div class="hd">
          <ul>
            <li>推荐</li>
            <li>最新</li>
            <li>等待回复</li>
          </ul>
        </div>
        <div class="bd">
          <!--推荐-->
          <ul class="quest-list">
            <?php foreach($recommend as $v){
              $u = Yii::$app->db->createCommand("select userName,nickname,image from {{%user}} where id=".$v['userId'])->queryOne();
              $count=count(Yii::$app->db->createCommand("select id from {{%user_discuss}} where contentId=".$v['id'])->queryAll());
              ?>
            <li>
              <!--头像-->
              <div class="head">
                <img src="<?php echo $v['image']?>" alt="">
              </div>
              <!--内容-->
              <div class="cnt">
                <h5><span class="logo">Q</span><a href="/details/<?php echo $v['id']?>.html"><?php echo $v['name']?></a></h5>
                <div class="answer">
                  <span class="logo">A</span>
                  <div>
                    <?php $comment=Yii::$app->db->createCommand("select comment from {{%user_discuss}} where contentId=".$v['id'] ." order by model desc,liked desc")->queryOne()['comment'];
                      echo $comment;
                    ?>
                  </div>
                </div>
                <div class="info clearfix">
                  <p><span><?php echo $u['nickname']!=false?$u['nickname']:$u['userName']?></span>发起了提问</p>
                  <p><span><?php echo $count?>人回复</span>|<span><?php echo $v['viewCount']?>次浏览</span></p>
                </div>
              </div>
            </li>
            <?php }?>
          </ul>
          <!--最新-->
          <ul class="quest-list">
              <?php foreach($new as $v){
                  $u = Yii::$app->db->createCommand("select userName,nickname,image from {{%user}} where id=".$v['userId'])->queryOne();
                  $count=count(Yii::$app->db->createCommand("select id from {{%user_discuss}} where contentId=".$v['id'])->queryAll());
                  ?>
                  <li>
                      <!--头像-->
                      <div class="head">
                          <img src="<?php echo $v['image']?>" alt="">
                      </div>
                      <!--内容-->
                      <div class="cnt">
                          <h5><span class="logo">Q</span><a href="/details/<?php echo $v['id']?>.html"><?php echo $v['name']?></a></h5>
                          <div class="answer">
                              <span class="logo">A</span>
                              <div>
                                  <?php $comment=Yii::$app->db->createCommand("select comment from {{%user_discuss}} where contentId=".$v['id'] ." order by model desc,liked desc")->queryOne()['comment'];
                                  echo $comment;
                                  ?>
                              </div>
                          </div>
                          <div class="info clearfix">
                              <p><span><?php echo $u['nickname']!=false?$u['nickname']:$u['userName']?></span>发起了提问</p>
                              <p><span><?php echo $count?>人回复</span>|<span><?php echo $v['viewCount']?>次浏览</span></p>
                          </div>
                      </div>
                  </li>
              <?php }?>
          </ul>
          <!--等待回复-->
          <ul class="quest-list">
              <?php foreach($question as $v){
                  $u = Yii::$app->db->createCommand("select userName,nickname,image from {{%user}} where id=".$v['userId'])->queryOne();
                  $count=count(Yii::$app->db->createCommand("select id from {{%user_discuss}} where contentId=".$v['id'])->queryAll());
                  ?>
                  <li>
                      <!--头像-->
                      <div class="head">
                          <img src="<?php echo $v['image']?>" alt="">
                      </div>
                      <!--内容-->
                      <div class="cnt">
                          <h5><span class="logo">Q</span><a href="/details/<?php echo $v['id']?>.html"><?php echo $v['name']?></a></h5>
                          <div class="answer">
                              <span class="logo">A</span>
                              <div>
                                  <?php $comment=Yii::$app->db->createCommand("select comment from {{%user_discuss}} where contentId=".$v['id'] ." order by model desc,liked desc")->queryOne()['comment'];
                                  echo $comment;
                                  ?>
                              </div>
                          </div>
                          <div class="info clearfix">
                              <p><span><?php echo $u['nickname']!=false?$u['nickname']:$u['userName']?></span>发起了提问</p>
                              <p><span><?php echo $count?>人回复</span>|<span><?php echo $v['viewCount']?>次浏览</span></p>
                          </div>
                      </div>
                  </li>
              <?php }?>
          </ul>
        </div>
      </div>
    </div>
    <!--侧边栏-->
    <?php use app\commands\front\RightWidget;?>
    <?php RightWidget::begin();?>
    <?php RightWidget::end();?>
  </section>
</div>
<script type="text/javascript" src="/cn/js/question.js"></script>
<script type="text/javascript">
  //  侧边栏我要规划
  jQuery(".project").slide({});
  //  侧边栏热帖排行榜
  jQuery(".ranking").slide({});
  // 提问列表
  jQuery(".quest-box").slide({});
</script>