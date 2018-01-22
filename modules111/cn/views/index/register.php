<!DOCTYPE html>
<html>
<head>
    <title>雷哥网注册界面</title>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <link rel="stylesheet" href="/cn/css/fonts/font-awesome/css/font-awesome.min.css"/>
    <link rel="stylesheet" href="/cn/css/public.css"/>
    <link rel="stylesheet" href="/cn/css/register.css"/>
    <link rel="stylesheet" href="/cn/css/style.css"/>
    <script type="text/javascript" src="/cn/js/jquery-1.9.1.min.js"></script>
    <script type="text/javascript" src="/cn/js/jquery.SuperSlide.2.1.1.js"></script>
    <script type="text/javascript" src="/cn/js/Validform_v5.3.2_min.js"></script>
    <script type="text/javascript" src="/cn/js/publicJS.js"></script>
    <script type="text/javascript" src="/cn/js/register.js"></script>
</head>
<body>
<div class="loginMessage">

</div>
<div class="login-top">
    <div class="logo">
        <img src="/cn/images/head_logo.png" alt="logo图标">
        <b>|</b>
        <span>注册</span>
    </div>
    <div class="reg">
        <span>我已注册，现在就</span>
        <a href="/cn/index">登录</a>
    </div>
    <div style="clear: both"></div>
</div>
<div class="login-con">
    <div class="inCon">
        <div class="shop-login">
            <h4>雷哥网注册</h4>
            <div class="toggleReg">
                <div class="toggleHd hd">
                    <ul>
                        <li>
                            <input type="radio" name="reg" id="phoneR" checked/><label for="phoneR">手机注册</label>
                        </li>
                        <li>
                            <input type="radio" name="reg" id="emailR"/><label for="emailR">邮箱注册</label>
                        </li>
                    </ul>
                </div>
                <div style="clear: both;margin-bottom: 8px;"></div>
                <div class="toggleBd">
                    <ul>
                        <li>
                            <div class="userMessage regPhone">
                                <div>
                                    <ul>
                                        <li>
                                            <div class="leftIcon">
                                                <span></span>
                                                <img src="/cn/images/login_phoneIcon.png" alt="电话图标">
                                            </div>
                                            <div class="rightInput">
                                                <input class="phones" type="text" placeholder="手机号：13/14/15/18"  datatype="m" errormsg="手机号格式不正确!" onkeypress="javascript:enterPhone(event);"/>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="leftIcon">
                                                <span></span>
                                                <img src="/cn/images/login_password.png" alt="密码图标">
                                            </div>
                                            <div class="rightInput">
                                                <input class="phonePass" type="password" placeholder="密码长度6位以上，数字+字母" datatype="*6-16" errormsg="密码范围在6~16位之间！" onkeypress="javascript:enterPhone(event);"/>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                                <!--动态密码-->
                                <div class="dynamic">
                                    <div class="dynamic-left">
                                        <input class="phoneCode" type="text" placeholder="验证码" datatype="*" errormsg="动态密码不能为空！" onkeypress="javascript:enterPhone(event);"/>
                                    </div>
                                    <div class="dynamic-right">
                                        <input type="button" onclick="clickDX(this,60,1,1);" value="获取短信验证码"/>
                                    </div>
                                    <div style="clear: both"></div>
                                </div>
                                <div class="loginBtn">
                                    <input type="button" onclick="phoneRegister()" value="注册" id="btn_regP"/>
                                </div>
                            </div>
                        </li>
                    </ul>
                    <ul>
                        <li>
                            <div class="userMessage regEmail">
                                <div>
                                    <ul>
                                        <li>
                                            <div class="leftIcon">
                                                <span></span>
                                                <img src="/cn/images/login_phoneIcon.png" alt="电话图标">
                                            </div>
                                            <div class="rightInput">
                                                <input class="email" type="text" placeholder="邮箱：xxxx@163.com"  datatype="e" errormsg="邮箱格式不正确!" onkeypress="javascript:enterEmail(event);"/>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="leftIcon">
                                                <span></span>
                                                <img src="/cn/images/login_password.png" alt="密码图标">
                                            </div>
                                            <div class="rightInput">
                                                <input class="emailPass" type="password" placeholder="密码长度6位以上，数字+字母" datatype="*6-16" errormsg="密码范围在6~16位之间！" onkeypress="javascript:enterEmail(event);"/>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                                <!--动态密码-->
                                <div class="dynamic">
                                    <div class="dynamic-left">
                                        <input class="emailCode" type="text" placeholder="验证码" datatype="*" errormsg="动态密码不能为空！" onkeypress="javascript:enterEmail(event);"/>
                                    </div>
                                    <div class="dynamic-right">
                                        <input type="button" onclick="clickDX(this,120,2,1);" value="获取邮件验证码"/>
                                    </div>
                                    <div style="clear: both"></div>
                                </div>
                                <div class="loginBtn">
                                    <input type="button" onclick="emailRegister()" value="注册" id="btn_regE"/>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
                <script type="text/javascript">
                    /**
                     * 用户注册
                     * @returns {boolean}
                     */
                    function phoneRegister(){
                        var phone = $('.phones').val()
                        var code = $('.phoneCode').val()
                        var phonePass = $('.phonePass').val()
                        if(phone == ""){
                            return false;
                        }
                        if(code == ""){
                            return false;
                        }
                        if(phonePass == ""){
                            return false;
                        }
                        $.post('/cn/api/register',{type:1,registerStr:phone,code:code,pass:phonePass},function(re){
                            if(re.code == 1){
                                alert(re.message);
                                $('.loginMessage').html(re.success_content);
                                setTimeout(function(){
                                    location.href=re.url;
                                },1000);
                            }else{
                                alert(re.message);
                            }
                        },'json')
                    }

                    /**
                     * 用户注册
                     * @returns {boolean}
                     */
                    function emailRegister(){
                        var email = $('.email').val()
                        var code = $('.emailCode').val()
                        var emailPass = $('.emailPass').val()
                        if(email == ""){
                            return false;
                        }
                        if(code == ""){
                            return false;
                        }
                        if(emailPass == ""){
                            return false;
                        }
                        $.post('/cn/api/register',{type:2,registerStr:email,code:code,pass:emailPass},function(re){
                            if(re.code == 1){
                                alert(re.message);
                                $('.loginMessage').html(re.success_content);
                                setTimeout(function(){
                                    location.href=re.url;
                                },1000);
                            }else{
                                alert(re.message);
                            }
                        },'json')
                    }
                    /**
                     * enter键手机注册
                     */
                    function enterPhone(event){
                        if(event.keyCode==13){
                            phoneRegister();
                        }
                    }
                    /**
                     * enter键邮箱注册
                     */
                    function enterEmail(event){
                        if(event.keyCode==13){
                            emailRegister();
                        }
                    }
                </script>
            </div>
            <script type="text/javascript">
                //    手机注册和邮箱注册切换
                jQuery(".toggleReg").slide({mainCell:".toggleBd",trigger:"click"});
            </script>
        </div>
    </div>
</div>
<div class="login-foot">
    <ul>
        <li><a href="http://www.gmatonline.cn/index.html">雷哥网GMAT</a></li>
        <li>|</li>
        <li><a href="http://toefl.gmatonline.cn/">雷哥网托福</a></li>
        <li>|</li>
        <li><a href="http://ielts.viplgw.cn/">雷哥网雅思</a></li>
        <li>|</li>
        <li><a href="http://www.smartapply.cn/">雷哥网留学</a></li>
        <li>|</li>
        <li><a href="http://open.viplgw.cn">公开课</a></li>
        <li>|</li>
        <li>客服电话：<span>400-1816-180</span></li>
    </ul>
    <div class="clearB"></div>
    <span>Copyright &copy;2016 All Right Reserved gmatonline 版权所有 京ICP备15001182号-1 京公网安备11010802017681
     <a href="http://www.gmatonline.cn/aboutUs/16.html#free_shengm">免责声明</a>
    </span>
</div>
</body>
</html>