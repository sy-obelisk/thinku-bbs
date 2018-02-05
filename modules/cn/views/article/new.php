<!doctype html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Document</title>
  <link rel="stylesheet" href="/cn/css/iconfont/iconfont.css">
  <link rel="stylesheet" href="/cn/css/common.css">
  <link rel="stylesheet" href="/cn/css/new-article.css">

  <script type="text/javascript" charset="utf-8" src="/ueditor/ueditor.config.js"></script>
  <script type="text/javascript" charset="utf-8" src="/ueditor/ueditor.all.js"> </script>
  <script type="text/javascript" charset="utf-8" src="/ueditor/lang/zh-cn/zh-cn.js"></script>
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
<div class="new-wrap p-container">
<!--路径导航-->
  <ul class="bread-crumb">
    <li><a href="">首页</a><span>&gt;</span><a href="">发帖</a></li>
  </ul>
  <div class="new-classify">
    <select name="" id="">
      <option value="">美国留学</option>
      <option value="">英国</option>
      <option value="">澳洲</option>
      <option value="">加拿大</option>
      <option value="">香港</option>
      <option value="">新加坡</option>
      <option value="">法国</option>
      <option value="">其他</option>
    </select>
    <select name="" id="">
      <option value="">GMAT考试</option>
      <option value="">GRE</option>
      <option value="">托福</option>
      <option value="">雅思</option>
      <option value="">SAT</option>
    </select>
    <select name="" id="">
      <option value="">金融职业</option>
      <option value="">大商科</option>
      <option value="">会计</option>
      <option value="">理工科</option>
      <option value="">文科艺术类</option>
    </select>
    <select name="" id="">
      <option value="">美国生活</option>
      <option value="">英国</option>
      <option value="">澳洲</option>
      <option value="">加拿大</option>
      <option value="">香港</option>
      <option value="">新加坡</option>
      <option value="">法国</option>
      <option value="">其他</option>
    </select>
  </div>
  <div class="new-title">
    <input type="text" placeholder="请输入标题">
  </div>
  <div class="new-cnt">
    <script id="myEditor" >

    </script>
  </div>
  <div class="sub-btn">
    <button class="put-in">发表</button>
    <button class="save-draft">保存草稿</button>
  </div>
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
<!--<script src="/cn/js/jquery.SuperSlide.2.1.js"></script>-->
<script src="/cn/js/common.js"></script>
<script>
  var ue = UE.getEditor('myEditor');
</script>

</html>