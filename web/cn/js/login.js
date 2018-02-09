/**
 * Created by daicunya on 2018/2/6.
 */
var _login = {
  init : function () {
    this.bind();
  },
  bind : function () {
    var _this = this;
    $('.login-change').click(function () {
      $(this).parent().css('display','none').siblings('.userMessage').show();
    });
    $('#userLogin').click(function () {
      _this.subLogin();
    })
    // $('.')
  },
  // 已有账号登录
  subLogin : function () {
    var userPass   = $('.userPass').val(),
        userName   = $('.userName').val(),
        verifyCode = $('.loginCode').val();
    if(verifyCode == ""){
//            $('.loginCode').parent().find("p").css("visibility","visible");
      return false;
    }
    if(userName == ""){
//            $('.userName').next("p").css("visibility","visible").html("请输入用户名!");
      return false;
    }
    if(userPass == ""){
//            $('.userPass').next("p").css("visibility","visible").html("请输入密码");
      return false;
    }
    $.post('/cn/api/login-in',{verifyCode:verifyCode,userPass:userPass,userName:userName},function(re){
      if(re.code == 1){
        setCookie('readName',userName);
        if($('#auto').is(':checked')) {
          setCookie('readSign',1);
          setCookie('readPass',userPass);
        }else{
          setCookie('readSign',0);
          delCookie('readPass');
        }
        if(re.check == 1){
          $('.loginMessage').html(re.success_content);
          setTimeout(function(){
            location.href=re.url;
          },1500);
        }else{
          $(".reg-success").show();
          $(".shop-login").hide();
        }
      }else{
        alert(re.message);
      }
    },'json')
  },
  // 手机动态登录
  phoneLogin : function () {
    var phone = $('.phones').val(),
        code  = $('.phone-code').val();
    if(phone == ""){
      return false;
    }
    if(code == ""){
      return false;
    }
    $.post('/cn/api/phone-login',{phone:phone,code:code},function(re){
      if(re.code == 1){
        if(re.type == 1){
          alert('首次登录你的雷哥网密码为：'+re.password);
        }
        if(re.check == 1){
          $('.loginMessage').html(re.success_content);
          setTimeout(function(){
            location.href=re.url;
          },1500);
        }else{
          $(".reg-success").show();
          $(".shop-login").hide();
        }
      }else{
        alert(re.message);
      }
    },'json')
  },
  // 已有账号回车键登录
  enterLogin : function (e) {
    if(e.keyCode == 13){
      this.subLogin();
    }
  },
  // 手机登录回车键
  enterPhone : function(e) {
    if(e.keyCode == 13){
      this.phoneLogin();
    }
  }
}
$(function () {
  _login.init();
  $(".login-phone").Validform({
    btnSubmit:"#btn_sub",
    showAllError:true,
    tiptype:3
  });
  $(".login-email").Validform({
    btnSubmit:"#btn_phone",
    showAllError:true,
    tiptype:3
  });
});
// 短信、邮箱验证码
function clickDX(e, timeN, str,emailType) {
  var phoneReg   = /((\d{11})|^((\d{7,8})|(\d{4}|\d{3})-(\d{7,8})|(\d{4}|\d{3})-(\d{7,8})-(\d{4}|\d{3}|\d{2}|\d{1})|(\d{7,8})-(\d{4}|\d{3}|\d{2}|\d{1}))$)/;
  var emailReg   = /^([a-zA-Z0-9]+[_|\_|\.]?)*[a-zA-Z0-9]+@([a-zA-Z0-9]+[_|\_|\.]?)*[a-zA-Z0-9]+\.[a-zA-Z]{2,4}$/;
  var _that      = $(e);
  var defalutVal = $(e).val();
  var timeNum    = timeN; // 再次点击时间间隔
  if(str == 1){
    var phone = $('.phones').val();
    console.log(phone);
    if(phone == ""){
      alert('请输入手机号！');
      return false;
    }
    if(!phoneReg.test(phone)){
      alert('手机号格式不正确(不能小于11位)!');
      return false;
    }
    $.post('/cn/api/phone-code',{phoneNum:phone,type:emailType},function(re){
      alert(re.message);
      if(re.code == 1){
        _that.attr("disabled", true);
        _that.unbind("click").val(timeNum + "秒后重发");
        var timer = setInterval(function () {
          timeNum--;
          _that.val(timeNum + "秒后重发");
          if (timeNum < 0) {
            clearInterval(timer);
            $(e).removeAttr("disabled");
            _that.val(defalutVal);
          }
        }, 1000);
      }
    },'json')
  }else{
    var mail = $('.email').val();
    console.log(mail);
    if(mail == ""){
      alert("请输入您的邮箱!");
      return false;
    }
    if(!emailReg.test(mail)){
      alert('邮箱格式不正确!');
      return false;
    }
    $.post('/cn/api/send-mail',{email:mail,type:emailType},function(re){
      alert(re.message);
      if(re.code == 1){
        $(e).attr("disabled", true);
        _that.unbind("click").val(timeNum + "秒后重发");
        var timer = setInterval(function () {
          _that.val(timeNum + "秒后重发");
          timeNum--;
          if (timeNum < 0) {
            clearInterval(timer);
            $(e).removeAttr("disabled");
            _that.val(defalutVal);
          }
        }, 1000);
      }
    },'json')
  }
}