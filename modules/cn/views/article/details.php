<link rel="stylesheet" href="/cn/css/details.css">
<!--内容区-->
<div class="details p-container">
  <section class="de-wrap p-posts clearfix">
    <div class="wrap">
      <ul class="bread-crumb">
        <li><a href="/">首页</a>
        <?php foreach($nav as $v){
          echo "<span>&gt;</span>".$v['name'];
        }?>
        </li>
<!--        <li><a href="/">首页</a><span>&gt;</span><a href="">留学</a><span>&gt;</span><a href="">美国</a><span>&gt;</span><a href="">签证</a></li>-->
      </ul>
      <!--帖子内容-->
      <div class="article" data-id="<?php echo $data['id'];?>">
        <div class="title">
          <div class="img">
            <img src="" alt="">
          </div>
          <div class="font">
            <h2>【标题】<?php echo $data['name']?></h2>
            <ul>
              <li>发表时间：<?php echo substr($data['createTime'],0,10)?></li>
              <li>阅读量：<?php echo $data['viewCount']?></li>
              <li>回复量：<?php echo $discuss['count']?></li>
            </ul>
          </div>
        </div>
        <div class="cnt">
         <?php echo $data['listeningFile'];?>
<!--          --><?php //if($data['url']!=false){
//              $url=unserialize($data['url']);
//            foreach($url as $v){
//              echo '<p><a href="'.$v.'">'.substr($v,strrpos($v,'/')+1).'</a></p>';
//            }
//          }?>
          <!--下载附件-->

          <div class="hide-wrap">
            <!--隐藏-->
            <?php $integral= Yii::$app->session->get('integral','');
            if($integral<10){
            ?>
            <div class="hide-box"><i class="fa fa-lock"></i>抱歉，您的等级还不够，暂时无法下载。多发帖，评论来提高等级吧！</div>
            <?php }else{?>
            <!--显示-->
              <?php if($data['url']!=false){?>
              <div class="show-box">
                <ul class="down-list">
                  <?php
                  $url=unserialize($data['url']);
                  foreach($url as $v){?>
                    <li>
                      <img src="/cn/images/rar.gif" alt="">
                      <a href="<?php echo $v?>"><?php echo substr($v,strrpos($v,'/')+1)?></a>
                      <!--<em>(下载次数：54)</em>-->
                    </li>
                  <?php }?>
                </ul>
              </div>
            <?php }else { }}?>
          </div>
        </div>
        <!--分享-->
        <div class="share">
          <div class="bshare-custom">分享到：<a title="分享到微信" class="bshare-weixin">微信</a><a title="分享到QQ空间" class="bshare-qzone">QQ空间</a><a title="分享到QQ好友" class="bshare-qqim">QQ</a><a title="分享到新浪微博" class="bshare-sinaminiblog">微博</a><a title="分享到豆瓣" class="bshare-douban">豆瓣</a><a title="更多平台" class="bshare-more bshare-more-icon more-style-addthis"></a><span class="BSHARE_COUNT bshare-share-count">0</span></div>
        </div>
        <!--收藏-->
        <div class="collect">
          <ul>
            <?php if($data['isCollect']){?>
            <li>已收藏</li>
            <?php }else{?>
            <li>收藏</li>
            <?php }?>
            <li>顶<span><?php echo $data['liked']?></span></li>
            <li>踩<span><?php echo $data['hate']?></span></li>
            <li id="artAccuse">举报</li>
          </ul>
        </div>
        <!--回复区-->
        <div class="reply">
          <!--用户回复列表-->
          <div class="reply-list">
            <ul>
              <?php foreach ($discuss['data'] as $v){?>
              <li class="reply-item" data-id="<?php echo $v['id']?>">
                <div class="reply-wrap clearfix">
                  <!--头像-->
                  <div class="reply-img">
                    <div>
                      <img src="<?php echo $v['image']?>" alt="">
                    </div>
                    <p class="reply-name"><?php echo $v['nickname']==false?$v['userName']:$v['nickname']?></p>
                    <?php if($v['model']==false and $data['catId']==119){?>
                    <p class="best-btn">设为最佳答案</p>
                    <?php }?>
                  </div>
                  <div class="reply-cnt">
                    <p><?php echo $v['comment']?></p>
                    <div class="revert">
                      <div class="show-wrap">
                        <span>回复</span>
                      </div>
                      <div class="revert-wrap">
                        <ul class="revert-list">
                          <?php if(is_array($v['son'])){ foreach($v['son'] as $key=>$val){?>
                          <li>
                            <span class="revert-name"><?php echo $val['nickname']==false?$val['userName']:$val['nickname']?>:</span>
                            <em class="revert-text"><?php echo $val['comment']?></em>
                            <div class="revert-time"><?php echo substr($val['createTime'],0,10)?></div>
                          </li>
                          <?php }}?>
                        </ul>
                        <div class="revert-input clearfix">
                          <textarea placeholder="我也来说两句...."></textarea>
                          <button id="revertBtn">评论</button>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="reply-time clearfix">
                  <p>发表于：<?php echo substr($v['createTime'],0,10)?></p>
                  <div>
                    <p id="accuseBtn">举报</p>
                    <p id="support">支持<span><?php echo $v['liked']?></span></p>
                    <p id="oppose">反对<span><?php echo $v['hate']?></span></p>
                  </div>
                </div>
                <?php if($v['model']==1 && $data['catId']==119 ){?>
                <div class="best-ans">最佳答案</div>
                <?php }?>
              </li>
              <?php }?>
            </ul>
          </div>
          <!---分页-->
<!--          <div class="page-wrap">-->
<!--            <ul class="pagination" id="pagination1"></ul>-->
<!--          </div>-->
<!--          <div>-->
            <?php echo $page;?>
<!--          </div>-->
          <!---回复输入-->
          <div class="reply-input">
            <textarea placeholder="来评论一下吧"></textarea>
            <button id="replyBtn">发表</button>
          </div>
        </div>
      </div>
    </div>
    <!--举报框-->
    <div class="accuse">
      <div class="box">
        <span>X</span>
        <p>我要举报:</p>
        <textarea class="accuse-cnt"></textarea>
        <ul class="type-list clearfix">
          <li><label for="acc1">垃圾营销</label><input type="radio" name="typeItem" id="acc1" value="1"></li>
          <li><label for="acc2">淫秽色情</label><input type="radio" name="typeItem" id="acc2" value="2"></li>
          <li><label for="acc3">有害信息</label><input type="radio" name="typeItem" id="acc3" value="3"></li>
          <li><label for="acc4">人身攻击</label><input type="radio" name="typeItem" id="acc4" value="4"></li>
          <li><label for="acc5">违法信息</label><input type="radio" name="typeItem" id="acc5" value="5"></li>
        </ul>
        <button id="subAccuse">提交</button>
      </div>
    </div>
    <!--侧边栏-->
    <?php use app\commands\front\RightWidget;?>
    <?php RightWidget::begin();?>
    <?php RightWidget::end();?>
  </section>
</div>
<script type="text/javascript" charset="utf-8" src="http://static.bshare.cn/b/button.js#style=-1&amp;uuid=&amp;pophcol=3&amp;lang=zh"></script>
<script type="text/javascript" charset="utf-8" src="http://static.bshare.cn/b/bshareC0.js"></script>
<script src="/cn/js/details.js"></script>
<script>
  //  侧边栏我要规划
  jQuery(".project").slide({});
  //  侧边栏热帖排行榜
  jQuery(".ranking").slide({});

</script>