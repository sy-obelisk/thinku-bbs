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
      <div class="article">
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
         <?php echo $data['listeningFile']?>
          <div class="bottom">本主题有申友留学推荐于2018-01-10 16:30 分类</div>
        </div>
        <!--分享-->
        <div class="share">
          <div class="bshare-custom">分享到：<a title="分享到微信" class="bshare-weixin">微信</a><a title="分享到QQ空间" class="bshare-qzone">QQ空间</a><a title="分享到QQ好友" class="bshare-qqim">QQ</a><a title="分享到新浪微博" class="bshare-sinaminiblog">微博</a><a title="分享到豆瓣" class="bshare-douban">豆瓣</a><a title="更多平台" class="bshare-more bshare-more-icon more-style-addthis"></a><span class="BSHARE_COUNT bshare-share-count">0</span></div>
          <script type="text/javascript" charset="utf-8" src="http://static.bshare.cn/b/button.js#style=-1&amp;uuid=&amp;pophcol=3&amp;lang=zh"></script>
          <a class="bshareDiv" onclick="javascript:return false;"></a>
          <script type="text/javascript" charset="utf-8" src="http://static.bshare.cn/b/bshareC0.js"></script>
        </div>
        <!--收藏-->
        <div class="collect">
          <ul>
            <li>收藏</li>
            <li>顶</li>
            <li>踩</li>
          </ul>
        </div>
        <!--回复区-->
        <div class="reply">
          <!--用户回复列表-->
          <div class="reply-list">
            <ul>
              <?php foreach ($discuss['data'] as $v){?>
              <li class="reply-item">
                <div class="reply-wrap clearfix">
                  <!--头像-->
                  <div class="reply-img">
                    <div>
                      <img src="<?php echo $v['image']?>" alt="">
                    </div>
                    <p><?php echo $v['nickname']==false?$v['userName']:$v['nickname']?></p>
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
                    <p>举报</p>
                    <p>支持<span><?php echo $v['liked']?></span></p>
                    <p>反对<span><?php echo $v['hate']?></span></p>
                  </div>
                </div>
              </li>
              <?php }?>
            </ul>
          </div>
          <!---分页-->
          <div class="page-wrap">
            <ul class="pagination" id="pagination1"></ul>
          </div>
          <!---回复输入-->
          <div class="reply-input">
            <textarea></textarea>
            <button id="replyBtn">发表</button>
          </div>
        </div>
      </div>
    </div>
    <!--侧边栏-->
    <?php use app\commands\front\RightWidget;?>
    <?php RightWidget::begin();?>
    <?php RightWidget::end();?>
  </section>
</div>
<script src="/cn/js/details.js"></script>
<script>
  //  侧边栏我要规划
  jQuery(".project").slide({});
  //  侧边栏热帖排行榜
  jQuery(".ranking").slide({});
</script>