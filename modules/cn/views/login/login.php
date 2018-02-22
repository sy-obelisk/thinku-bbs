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
    还没有申友网账号？
    <a href="./register.html">注册</a>
  </div>
</nav>
<!--内容区-->
<div class="login-wrap">
  <div class="cnt">
    <h2>登录</h2>
    <div class="login-phone userMessage">
      <div>
        <ul>
          <li>
            <div class="leftIcon">
              <span></span>
            </div>
            <div class="rightInput">
              <input class="userName" type="text" placeholder="邮箱/已验证手机"  datatype="*" errormsg="用户名不能为空!" value="" onkeypress="javascript:_login.enterLogin(event);"/>
            </div>
          </li>
          <li>
            <div class="leftIcon">
              <span></span>
            </div>
            <div class="rightInput">
              <input class="userPass" type="password" placeholder="密码" datatype="*6-16" errormsg="密码范围在6~16位之间！" value="" onkeypress="javascript:_login.enterLogin(event);"/>
            </div>
          </li>
        </ul>
      </div>
      <div class="dynamic">
        <div class="dynamic-left">
          <input class="loginCode" type="text" placeholder="验证码" datatype="*" errormsg="动态密码不能为空！"  onkeypress="javascript:_login.enterLogin(event);"/>
        </div>
        <div class="dynamic-right">
          <img src="image.html" onclick="this.src='image.html?'+Math.random();" alt="验证码"/>
        </div>
        <div style="clear: both"></div>
      </div>
      <div class="autoLogin clearfix">
        <input type="checkbox" id="auto" />
        <label for="auto">记住密码</label>
        <a href="findKey.html">忘记密码?</a>
      </div>
      <div class="loginBtn">
        <input type="button" value="登录" id="userLogin"/>
      </div>
      <p class="login-change">短信快捷登录</p>
    </div>
    <div class="login-email userMessage">
      <div>
        <ul>
          <li>
            <div class="leftIcon">
              <span></span>
            </div>
            <div class="rightInput">
              <input  class="phones" type="text" placeholder="手机号"  datatype="m" errormsg="手机号格式不正确(不能小于11位)!" onkeypress="javascript:_login.enterPhone(event);"/>
            </div>
          </li>
        </ul>
      </div>
      <!--动态密码-->
      <div class="dynamic">
        <div class="dynamic-left">
          <input class="phone-code" type="text" placeholder="动态密码" datatype="*" errormsg="动态密码不能为空！" onkeypress="javascript:_login.enterPhone(event);"/>
        </div>
        <div class="dynamic-right">
          <input type="button" onclick="clickDX(this,60,1,9);" value="发送动态密码"/>
        </div>
        <div style="clear: both"></div>
      </div>
      <div class="loginBtn">
        <input type="button" value="登录" id="phoneLogin"/>
      </div>
      <p class="login-change">账号密码登录</p>
    </div>
  </div>
</div>
<!--底部-->
<?php use app\commands\front\FootWidget;?>
<?php FootWidget::begin();?>
<?php FootWidget::end();?>
</body>
<script src="https://use.fontawesome.com/0e249ab73d.js"></script>
<script src="/cn/js/Validform_v5.3.2_min.js"></script>
<script src="/cn/js/common.js"></script>
<script src="/cn/js/login.js"></script>
</html>