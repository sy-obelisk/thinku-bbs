<!doctype html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Document</title>
  <link rel="stylesheet" href="/cn/css/iconfont/iconfont.css">
  <link rel="stylesheet" href="/cn/css/common.css">
  <link rel="stylesheet" href="/cn/css/person-cmn.css">
  <link rel="stylesheet" href="/cn/css/person.css">
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
      <li class="on"><a href="person.html">个人中心</a></li>
      <li><a href="collection.html">我的收藏</a></li>
      <li><a href="share.html">我的分享</a></li>
      <li><a href="article.html">我的帖子</a></li>
      <li><a href="message-board.html">留言板</a></li>
      <li><a href="info.html">系统消息</a></li>
    </ul>
  </aside>
  <!--内容区-->
  <section class="person-cnt single-cnt">
    <div class="single-tab hd">
      <ul>
        <li class="on"><span>个人资料</span></li>
        <li><span>积分</span></li>
        <li><span>用户安全</span></li>
        <li><span>密码安全</span></li>
      </ul>
    </div>
    <div class="single-box bd">
      <!--个人资料-->
      <ul class="data">
        <li>
          <label for="">用&nbsp;户&nbsp;名：</label><input type="text">
        </li>
        <li>
          <label for="">真实姓名：</label><input type="text">
        </li>
        <li>
          <label for="">生&nbsp;&nbsp;&nbsp; 日：</label><input type="text" placeholder="请选择日期" id="birthDate">
        </li>
        <li>
          <label for="">现&nbsp;居&nbsp;地：</label><input type="text">
        </li>
        <li>
          <label for="">联系电话：</label><input type="text">
        </li>
        <li>
          <label for="">email&nbsp;&nbsp; ：</label><input type="text">
        </li>
        <li>
          <label for="">毕业院校：</label><input type="text">
        </li>
        <li>
          <label for="">学&nbsp;&nbsp;&nbsp; 历：</label><input type="text">
        </li>
        <input type="button" id="dataBtn" value="保存">
      </ul>
      <!--积分-->
      <ul class="score">
        <h2><span class="iconfont icon-jifen"></span>积分：20</h2>
        <h5>积分记录</h5>
        <li>
          <p>发布帖子</p>
          <p>+2</p>
          <p>2018-01-12</p>
        </li>
        <li>
          <p>发布帖子</p>
          <p>+2</p>
          <p>2018-01-12</p>
        </li>
        <li>
          <p>发布帖子</p>
          <p>+2</p>
          <p>2018-01-12</p>
        </li>
        <li>
          <p>发布帖子</p>
          <p>+2</p>
          <p>2018-01-12</p>
        </li>
        <li>
          <p>发布帖子</p>
          <p>+2</p>
          <p>2018-01-12</p>
        </li>
        <li>
          <p>发布帖子</p>
          <p>+2</p>
          <p>2018-01-12</p>
        </li>
        <li>
          <p>发布帖子</p>
          <p>+2</p>
          <p>2018-01-12</p>
        </li>
        <li>
          <p>发布帖子</p>
          <p>+2</p>
          <p>2018-01-12</p>
        </li>
        <!---分页-->
        <div class="page-wrap">
          <ul class="pagination" id="pagination1"></ul>
        </div>
      </ul>
      <!--用户权限-->
      <ul class="limit">
        <li>
          <img src="/cn/images/person-limit.png" alt="">
        </li>
      </ul>
      <!-- 修改密码-->
      <ul class="pass">
        <li>
          <label for="">新&nbsp;密&nbsp;码：</label><input type="text">
        </li>
        <li>
          <label for="">密码确认：</label><input type="text">
        </li>
        <li>
          <label for="">email&nbsp;：</label><input type="text">
        </li>
        <li>
          <label for="">手机号码：</label><input type="text">
        </li>
        <li>
          <label for="">验&nbsp;证码&nbsp;：</label><input type="text">
        </li>
        <input type="button" value="提交" id="passBtn">
      </ul>
    </div>
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
<script src="/cn/laydate/laydate.js"></script>
<script src="/cn/js/common.js"></script>
<script>
  jQuery(".single-cnt").slide({});
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
  //  日期选择
  laydate.render({
    elem: '#birthDate' //指定元素
  });
</script>
</html>
