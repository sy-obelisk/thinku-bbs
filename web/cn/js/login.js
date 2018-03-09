/**
 * Created by daicunya on 2018/2/6.
 */
var _login = {
  init : function () {
    this.onload();
    this.bind();
  },
  onload: function(){
    var oUser = $('.userName'),
        oPswd = $('.userPass'),
        oRemember = $('#autoRem');
    if (_common.getCookie('loginSign')) {
      oUser.val(_common.getCookie('user'));
      oPswd.val(_common.getCookie('pswd'));
      oRemember.attr('checked',true);
    }
    // oRemember.change(function () {
    //   if (!this.checked){
    //     _common.delCookie('user');
    //     _common.delCookie('pswd');
    //   }
    // });
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
    if(!verifyCode){
      return false;
    }
    if(!userName){
      return false;
    }
    if(!userPass){
      return false;
    }
    $.post('/cn/api/login-in',{verifyCode:verifyCode,userPass:userPass,userName:userName},function(res){
      if(res.code == 0){
        _common.setCookie('user',userName,7);
        if($('#autoRem').is(':checked')) {
          _common.setCookie('loginSign',1,7);
          _common.setCookie('pswd',userPass,7);
        }else{
          _common.setCookie('loginSign',0);
          _common.delCookie('pswd');
        }
        location.href=res.url;
      }else{
        alert(res.message);
      }
    },'json');
  },
  // 手机动态登录
  phoneLogin : function () {
    var phone = $('.phones').val(),
        code  = $('.phone-code').val();
    if(!phone){
      return false;
    }
    if(!code){
      return false;
    }
    $.post('/cn/api/message-login',{registerStr:phone,code:code},function(res){
      if(res.code == 0){
        setTimeout(function(){
          location.href=res.url;
        },1500);
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
