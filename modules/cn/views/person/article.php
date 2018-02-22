<!doctype html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Document</title>
  <link rel="stylesheet" href="/cn/css/iconfont/iconfont.css">
  <link rel="stylesheet" href="/cn/css/common.css">
  <link rel="stylesheet" href="/cn/css/person-cmn.css">
  <link rel="stylesheet" href="/cn/css/person-article.css">
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
<div class="person p-container clearfix">
  <aside class="person-aside">
    <div class="aside-head">
      <div>
        <img src="" alt="">
      </div>
      <p>用户名</p>
      <p><span class="iconfont icon-jifen"></span>积分：20</p>
    </div>
    <ul class="aside-list">
      <li><a href="change-image.html">设置头像</a></li>
      <li><a href="person.html">个人中心</a></li>
      <li><a href="collection.html">我的收藏</a></li>
      <li><a href="share.html">我的分享</a></li>
      <li class="on"><a href="article.html">我的帖子</a></li>
      <li><a href="message-board.html">留言板</a></li>
      <li><a href="info.html">系统消息</a></li>
    </ul>
  </aside>
  <!--内容区-->
  <section class="person-cnt article-cnt">
    <div class="post-msg">
      <a href="">发帖</a>
    </div>
    <div class="article-tab">
      <p>我的帖子</p>
      <p>板块/群组</p>
    </div>
    <ul class="article-list">
      <li class="clearfix">
        <div class="article-img">
          <img src="" alt="">
        </div>
        <div class="article-info">
          <h3><a href="">帖子的标题</a></h3>
          <div>
            <p>发表于<span>2018-01-11</span></p>
            <p><span>查看：111</span>|<span>回复：333</span></p>
          </div>
        </div>
        <div class="sort">美国留学</div>
      </li>
      <li class="clearfix">
        <div class="article-img">
          <img src="" alt="">
        </div>
        <div class="article-info">
          <h3><a href="">帖子的标题</a></h3>
          <div>
            <p>发表于<span>2018-01-11</span></p>
            <p><span>查看：111</span>|<span>回复：333</span></p>
          </div>
        </div>
        <div class="sort">美国留学</div>
      </li>
      <li class="clearfix">
        <div class="article-img">
          <img src="" alt="">
        </div>
        <div class="article-info">
          <h3><a href="">帖子的标题</a></h3>
          <div>
            <p>发表于<span>2018-01-11</span></p>
            <p><span>查看：111</span>|<span>回复：333</span></p>
          </div>
        </div>
        <div class="sort">美国留学</div>
      </li>
      <!---分页-->
      <div class="page-wrap">
        <ul class="pagination" id="pagination1"></ul>
      </div>
    </ul>
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
<script>
  //  全部消息分页
  $.jqPaginator('#pagination1', {
    totalPages: 20,
    visiblePages: 7,
    currentPage: 1,
    onPageChange: function (num, type) {
      console.log(num,type);
      // $('#p1').text(type + '：' + num);
    }
  });
</script>
</html>
