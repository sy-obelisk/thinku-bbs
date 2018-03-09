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
    <h2>注册</h2>
<!--    手机注册-->
    <div class="login-phone userMessage">
      <div>
        <ul>
          <li>
            <div class="leftIcon">
              <span class="iconfont icon-phone"></span>
            </div>
            <div class="rightInput">
              <input class="phones" type="text" placeholder="手机号：13/14/15/17/18"  datatype="m" errormsg="手机号格式不正确!" onkeypress="javascript:_register.enterPhone(event);"/>
            </div>
          </li>
          <li>
            <div class="leftIcon">
              <span class="iconfont icon-login_password"></span>
            </div>
            <div class="rightInput">
              <input class="phonePass" type="password" placeholder="密码长度6位以上，数字+字母" datatype="*6-16" errormsg="密码范围在6~16位之间！" value="" onkeypress="javascript:_register.enterPhone(event);"/>
            </div>
          </li>
        </ul>
      </div>
      <div class="dynamic">
        <div class="dynamic-left">
          <input class="phoneCode" type="text" placeholder="验证码" datatype="*" errormsg="动态密码不能为空！"  onkeypress="javascript:_register.enterPhone(event);"/>
        </div>
        <div class="dynamic-right">
          <input type="button" onclick="clickDX(this,60,1,9);" value="获取短信验证码"/>
        </div>
        <div style="clear: both"></div>
      </div>
      <div class="loginBtn">
        <input type="button" value="注册" id="pRegisterBtn"/>
      </div>
      <p class="login-change">邮箱注册</p>
    </div>
<!--    邮箱注册-->
    <div class="login-email userMessage">
      <div>
        <ul>
          <li>
            <div class="leftIcon">
              <span class="iconfont icon-email"></span>
            </div>
            <div class="rightInput">
              <input class="email" type="text" placeholder="邮箱：xxxx@xx.xx"  datatype="e" errormsg="邮箱格式不正确!" value="" onkeypress="javascript:_register.enterEmail(event);"/>
            </div>
          </li>
          <li>
            <div class="leftIcon">
              <span class="iconfont icon-login_password"></span>
            </div>
            <div class="rightInput">
              <input class="emailPass" type="password" placeholder="密码长度6位以上，数字+字母" datatype="*6-16" errormsg="密码范围在6~16位之间！" value="" onkeypress="javascript:_register.enterEmail(event);"/>
            </div>
          </li>
        </ul>
      </div>
      <div class="dynamic">
        <div class="dynamic-left">
          <input class="emailCode" type="text" placeholder="验证码" datatype="*" errormsg="动态密码不能为空！"  onkeypress="javascript:_register.enterEmail(event);"/>
        </div>
        <div class="dynamic-right">
          <input type="button" onclick="clickDX(this,120,2,1);" value="获取邮箱验证码"/>
        </div>
        <div style="clear: both"></div>
      </div>
      <div class="loginBtn">
        <input type="button" value="注册" id="eRegisterBtn"/>
      </div>
      <p class="login-change">手机注册</p>
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
<!--<script src="/cn/js/login.js"></script>-->
<script src="/cn/js/register.js"></script>
</html>