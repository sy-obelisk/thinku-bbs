<!doctype html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Document</title>
  <link rel="stylesheet" href="/cn/css/iconfont/iconfont.css">
  <link rel="stylesheet" href="/cn/css/common.css">
  <link rel="stylesheet" href="/cn/css/details.css">
</head>
<body>
<header class="header">
  <div class="p-container clearfix">
    <div class="wrap fr">
      <ul class="header-login">
        <li><a href="">登录</a></li>
        <li><a href="">注册</a></li>
      </ul>
      <div class="header-person">
        <div>
          <img src="/cn/images/head.png" alt="">
          <p>这是名字</p>
        </div>
        <ul>
          <li><a href="">个人中心</a></li>
          <li><a href="">退出</a></li>
        </ul>
      </div>
    </div>
  </div>
</header>
<nav class="nav p-container clearfix">
  <a href="" class="home-icon">
    <img src="/cn/images/logo.png" alt="">
  </a>
  <div class="title">
    <img src="/cn/images/index01.png" alt="">
  </div>
  <div class="search clearfix">
    <ul>
      <li><span class="iconfont icon-hot"></span>热搜:</li>
      <li><a href="javascript:void(0)">美国留学</a></li>
      <li><a href="javascript:void(0)">大学排名</a></li>
      <li><a href="javascript:void(0)">专业解读</a></li>
    </ul>
    <form>
      <input type="text" placeholder="search">
      <span>
          <i class="fa fa-search"></i>
        </span>
    </form>
  </div>
</nav>
<!--内容区-->
<div class="details p-container">
  <section class="de-wrap p-posts clearfix">
    <div class="wrap">
      <ul class="bread-crumb">
        <li><a href="">首页</a><span>&gt;</span><a href="">留学</a><span>&gt;</span><a href="">美国</a><span>&gt;</span><a href="">签证</a></li>
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
              <li>发表时间：<?php echo $data['createTime']?></li>
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

          <div class="bshare-custom">分享到：<a title="分享到微信" class="bshare-weixin">微信</a><a title="分享到QQ空间" class="bshare-qzone">QQ空间</a><a title="分享到QQ好友" class="bshare-qqim">QQ</a><a title="分享到新浪微博" class="bshare-sinaminiblog">微博</a><a title="分享到豆瓣" class="bshare-douban">豆瓣</a><a title="更多平台" class="bshare-more bshare-more-icon more-style-addthis"></a><span class="BSHARE_COUNT bshare-share-count">0</span></div><script type="text/javascript" charset="utf-8" src="http://static.bshare.cn/b/button.js#style=-1&amp;uuid=&amp;pophcol=3&amp;lang=zh"></script><a class="bshareDiv" onclick="javascript:return false;"></a><script type="text/javascript" charset="utf-8" src="http://static.bshare.cn/b/bshareC0.js"></script>
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
                          <li>
                            <span class="revert-name">凤凰火:</span>
                            <em class="revert-text">这是回复的内容</em>
                            <div class="revert-time">2018-1-23</div>
                          </li>
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
                  <p>发表于：2018-01-12</p>
                  <div>
                    <p>举报</p>
                    <p>支持<span>100</span></p>
                    <p>反对<span>20</span></p>
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
    <aside class="aside">
      <ul class="posted">
        <li><a href="./new-article.html"><i class="iconfont icon-hot"></i>我要发帖</a></li>
        <li><a href=""><i class="iconfont icon-hot"></i>我要提问</a></li>
      </ul>
      <!--签到-->
      <div class="sign-in">
        <div class="icon">
          <i class="iconfont icon-hot"></i>
          签到
        </div>
        <div class="num">
          <p>今日签到人数</p>
          <p>21</p>
          <p>你还未签到</p>
        </div>
      </div>
      <!--论坛公告-->
      <div class="announce">
        <div class="title"></div>
        <div class="cnt">
          【刷词团】号外！号外！GRE填空1200精选专项刷词团强烈来袭~

          刷词内容：雷哥GRE独家整理的鸡精填空选项词1200个+对应填空真题训练

          2018年1月22日开刷！
          报名添加小G君微信：1746295647
        </div>
      </div>
      <!--我要留学-->
      <div class="abroad">
        <div class="title"></div>
        <ul>
          <li><a href="">美国</a></li>
          <li><a href="">英国</a></li>
          <li><a href="">澳洲</a></li>
          <li><a href="">加拿大</a></li>
          <li><a href="">香港</a></li>
          <li><a href="">新加坡</a></li>
          <li><a href="">法国</a></li>
          <li><a href="">其他</a></li>
        </ul>
      </div>
      <!--我要考试-->
      <div class="test">
        <div class="title"></div>
        <ul>
          <li><a href="">GMAT</a></li>
          <li><a href="">GRE</a></li>
          <li><a href="">托福</a></li>
          <li><a href="">雅思</a></li>
          <li><a href="">SAT</a></li>
          <li><a href="">ACT</a></li>
          <li><a href="">AP</a></li>
        </ul>
      </div>
      <!--我要规划-->
      <div class="project">
        <div class="title"></div>
        <div class="project-box p-prorank-box">
          <div class="hd">
            <ul>
              <li class="on">北美</li>
              <li>欧洲</li>
              <li>其他</li>
            </ul>
          </div>
          <div class="bd">
            <ul>
              <li><a href=""><span style="background-color: #e92b3b">1</span>MBA精英计划美前30英G5</a></li>
              <li><a href=""><span style="background-color: #e98a52">2</span>MBA精英计划美前30英G5</a></li>
              <li><a href=""><span style="background-color: #22ada2">3</span>MBA精英计划美前30英G5</a></li>
              <li><a href=""><span>4</span>MBA精英计划美前30英G5</a></li>
              <li><a href=""><span>4</span>MBA精英计划美前30英G5</a></li>
              <li><a href=""><span>4</span>MBA精英计划美前30英G5</a></li>
              <li><a href=""><span>4</span>MBA精英计划美前30英G5</a></li>
              <li><a href=""><span>4</span>MBA精英计划美前30英G5</a></li>
            </ul>
          </div>
        </div>
      </div>
      <!--热帖排行-->
      <div class="ranking">
        <div class="title"></div>
        <div class="ranking-box p-prorank-box">
          <div class="hd">
            <ul>
              <li class="on">今日热榜</li>
              <li>一周精华</li>
            </ul>
          </div>
          <div class="bd">
            <ul>
              <li><a href=""><span style="background-color: #e92b3b">1</span>12.30换库后CR逻辑鸡精（第8题） 12.30换库后CR逻...</a></li>
              <li><a href=""><span style="background-color: #e98a52">2</span>MBA精英计划美前30英G5</a></li>
              <li><a href=""><span style="background-color: #22ada2">3</span>MBA精英计划美前30英G5</a></li>
              <li><a href=""><span>4</span>MBA精英计划美前30英G5</a></li>
              <li><a href=""><span>5</span>MBA精英计划美前30英G5</a></li>
            </ul>
          </div>
        </div>
      </div>
      <!--热门课程-->
      <div class="course">
        <h2>热门课程</h2>
        <ul>
          <li><a href="">
              <img src="/cn/images/aside-course01.png" alt="课程图片">
            </a></li>
          <li><a href="">
              <img src="/cn/images/aside-course02.png" alt="课程图片">
            </a></li>
        </ul>
      </div>
    </aside>
  </section>
</div>
<footer class="footer">
  <div class="p-container clearfix">
    <div class="footer-nav clearfix">
      <ul>
        <h4>申友产品</h4>
        <li><a href="">留学</a></li>
        <li><a href="">GMAT</a></li>
        <li><a href="">TOEFL</a></li>
        <li><a href="">IELTS</a></li>
        <li><a href="">SAT</a></li>
      </ul>
      <ul class="focus">
        <h4>关注我们</h4>
        <li>
          <span>申友留学</span>
          <img src="/cn/images/foot-code01.png" alt="">
        </li>
        <li>
          <span>申友GMAT</span>
          <img src="/cn/images/foot-code01.png" alt="">
        </li>
        <li>
          <span>商科留学</span>
          <img src="/cn/images/foot-code01.png" alt="">
        </li>
      </ul>
    </div>
    <div class="footer-code">
      <div>
        <img src="/cn/images/logo-white.png" alt="">
      </div>
      <ul class="clearfix">
        <li><img src="/cn/images/foot-code01.png" alt="二维码"></li>
        <li><img src="/cn/images/foot-code02.png" alt="二维码"></li>
      </ul>
    </div>
  </div>
</footer>
</body>
<script src="https://use.fontawesome.com/0e249ab73d.js"></script>
<script src="/cn/js/jquery.SuperSlide.2.1.js"></script>
<script src="/cn/js/jqPaginator.min.js"></script>
<script src="/cn/js/common.js"></script>
<script src="/cn/js/details.js"></script>
<script>
  //  我要规划
  jQuery(".project").slide({});
  //  热帖排行榜
  jQuery(".ranking").slide({});
</script>
</html>