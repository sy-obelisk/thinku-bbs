<!doctype html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Document</title>
  <link rel="stylesheet" href="/cn/css/iconfont/iconfont.css">
  <link rel="stylesheet" href="/cn/css/common.css">
  <link rel="stylesheet" href="/cn/css/login.css">
</head>
<body>
<nav class="login-nav clearfix">
  <a href="" class="home-icon">
    <img src="/cn/images/logo.png" alt="">
  </a>
  <div>
    我已注册，现在就
    <a href="./login.html">登录</a>
  </div>
</nav>
<!--内容区-->
<div class="login-wrap">
  <div class="cnt">
    <h2>找回密码</h2>
    <!-- 手机找回密码-->
    <div class="login-phone userMessage">
      <div>
        <ul>
          <li>
            <div class="leftIcon">
              <span></span>
            </div>
            <div class="rightInput">
              <input class="find-phone phones" type="text" placeholder="手机号"  datatype="m" errormsg="请输入有效的手机号"/>
            </div>
          </li>
          <li>
            <div class="leftIcon">
              <span></span>
            </div>
            <div class="rightInput">
              <input class="find-phone-pass" type="password" placeholder="新密码" datatype="*6-16" errormsg="密码范围在6~16位之间！"/>
            </div>
          </li>
        </ul>
      </div>
      <div class="dynamic">
        <div class="dynamic-left">
          <input class="find-phone-code" type="text" placeholder="验证码" datatype="*" errormsg="动态密码不能为空！"/>
        </div>
        <div class="dynamic-right">
          <input type="button" onclick="clickDX(this,60,1,9);" value="获取短信验证码"/>
        </div>
        <div style="clear: both"></div>
      </div>
      <div class="loginBtn">
        <input type="button" value="提交" id="pFindBtn"/>
      </div>
      <p class="login-change">邮箱找回密码</p>
    </div>
    <!-- 邮箱找回密码-->
    <div class="login-email userMessage">
      <div>
        <ul>
          <li>
            <div class="leftIcon">
              <span></span>
            </div>
            <div class="rightInput">
              <input class="find-email email" type="text" placeholder="邮箱"  datatype="e" errormsg="邮箱格式错误" />
            </div>
          </li>
          <li>
            <div class="leftIcon">
              <span></span>
            </div>
            <div class="rightInput">
              <input class="email-pass" type="password" placeholder="新密码" datatype="*6-16" errormsg="密码范围在6~16位之间！"/>
            </div>
          </li>
        </ul>
      </div>
      <div class="dynamic">
        <div class="dynamic-left">
          <input class="email-code" type="text" placeholder="验证码" datatype="*" errormsg="动态密码不能为空！"/>
        </div>
        <div class="dynamic-right">
          <input type="button" onclick="clickDX(this,120,2,2);" value="获取邮箱验证码"/>
        </div>
        <div style="clear: both"></div>
      </div>
      <div class="loginBtn">
        <input type="button" value="提交" id="eFindBtn"/>
      </div>
      <p class="login-change">手机找回密码</p>
    </div>
  </div>
</div>
<footer class="login-footer">
  <ul>
    <li>友情链接:</li>
    <li><a href="">申友在线</a></li>
    <li><a href="">雷哥网</a></li>
    <li><a href="">留学社区</a></li>
    <li><a href="">新浪微博</a></li>
    <li><a href="">人人网</a></li>
  </ul>
  <div>Copyright © 2015 All Right Reserved 申友教育 版权所有 京ICP备16000003号 京公网安备 11010802018491 免责声明</div>
</footer>
</body>
<script src="https://use.fontawesome.com/0e249ab73d.js"></script>
<script src="/cn/js/Validform_v5.3.2_min.js"></script>
<script src="/cn/js/common.js"></script>
<!--<script src="/cn/js/login.js"></script>-->
<script src="/cn/js/findKey.js"></script>
</html>
