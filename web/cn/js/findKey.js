/**
 * Created by daicunya on 2018/2/9.
 */
var _findKey = {
  init : function () {
    this.bind();
  },
  bind : function () {
    var _this = this;
    // 手机找回密码
    $('#pFindBtn').click(function () {
      _this.findPhone();
    });
    // 邮箱找回密码
    $('#eFindBtn').click(function () {
      _this.findEmail();
    })
  },
  // 手机找回密码
  findPhone : function () {
      var phone = $('.find-phone').val(),
          code  = $('.find-phone-code').val(),
          pass  = $('.find-phone-pass').val()
      if(phone == ""){
        alert("请输入您的电话!");
        return false;
      }
      if(code == ""){
        alert("请输入电话验证码");
        return false;
      }
      if(pass == ""){
        alert("请输入您的新密码");
        return false;
      }
      $.post('/cn/api/find-pass',{type:1,registerStr:phone,code:code,pass:pass},function(res){
        if(res.code == 1){
          alert(res.message);
          location.href='/cn/index';
        }else{
          alert(res.message);
        }
      },'json')
  },
  // 邮箱找回密码
  findEmail : function () {
    var email     = $('.find-email').val(),
        emailCode = $('.email-code').val(),
        emailPass = $('.email-pass').val();
    if(email == ""){
      alert("请输入您的邮箱!");
      return false;
    }
    if(emailCode == ""){
      alert("请输入邮箱验证码");
      return false;
    }
    if(emailPass == ""){
      alert("请输入您的新密码");
      return false;
    }
    $.post('/cn/api/find-pass',{type:2,registerStr:email,code:emailCode,pass:emailPass},function(res){
      if(res.code == 1){
        alert(res.message);
        location.href='/cn/index';
      }else{
        alert(res.message);
      }
    },'json')
  }
};
$(function () {
  _findKey.init();
})