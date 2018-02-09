/**
 * Created by daicunya on 2018/2/6.
 */
var _login = {
  init : function () {
    this.bind();
  },
  bind : function () {
    var _this = this;

    $('#userLogin').click(function () {
      _this.subLogin();
    })
    $('#phoneLogin').click(function () {
      _this.phoneLogin();
    })
  },
  // 已有账号登录
  subLogin : function () {
    var userPass   = $('.userPass').val(),
        userName   = $('.userName').val(),
        verifyCode = $('.loginCode').val();
    if(verifyCode == ""){
      return false;
    }
    if(userName == ""){
      return false;
    }
    if(userPass == ""){
      return false;
    }
    $.post('/cn/api/login-in',{verifyCode:verifyCode,userPass:userPass,userName:userName},function(res){
      if(res.code == 0){
        _common.setCookie('readName',userName);
        if($('#auto').is(':checked')) {
          _common.setCookie('readSign',1);
          _common.setCookie('readPass',userPass);
        }else{
          _common.setCookie('readSign',0);
          _common.delCookie('readPass');
        }
        if(res.check == 1){
          setTimeout(function(){
            location.href=re.url;
          },1500);
        }else{
          $(".reg-success").show();
          $(".shop-login").hide();
        }
      }else{
        alert(res.message);
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
    $.post('/cn/api/message-login',{registerStr:phone,code:code},function(res){
      console.log(res);
      if(res.code == 0){
        if(res.type == 0){
          alert('首次登录你的雷哥网密码为：'+re.password);
        }
        if(res.check == 0){
          $('.loginMessage').html(re.success_content);
          setTimeout(function(){
            location.href=re.url;
          },1500);
        }else{
          $(".reg-success").show();
          $(".shop-login").hide();
        }
      }else{
        alert(res.message);
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
