/**
 * Created by daicunya on 2018/2/8.
 */
var _register = {
  init : function () {
    this.bind();
  },
  bind : function () {
    var _this = this;
    // 邮箱注册
    $('#eRegisterBtn').click(function () {
      _this.emailRegister();
    });
    // 手机注册
    $('#pRegisterBtn').click(function () {
      console.log('aa');
      _this.phoneRegister();
    })
  },
  /* 手机注册 */
  phoneRegister : function () {
    var phone     = $('.phones').val(),
        code      = $('.phoneCode').val(),
        phonePass = $('.phonePass').val();
    console.log(phone,code,phonePass);
    if(phone == ""){
      return false;
    }
    if(code == ""){
      return false;
    }
    if(phonePass == ""){
      return false;
    }
    $.post('/cn/api/register',{type:1,registerStr:phone,code:code,pass:phonePass},function(res){
      console.log(res);
      if(res.code == 0){
        alert(res.message);
        location.href = './login.html';
        // $(".reg-success").show();
        // $(".shop-login").hide();
      }else{
        alert(res.message);
      }
    },'json')
  },
  /* 邮箱注册 */
  emailRegister : function () {
    var email = $('.email').val();
    var code = $('.emailCode').val();
    var emailPass = $('.emailPass').val();
    if(email == ""){
      return false;
    }
    if(code == ""){
      return false;
    }
    if(emailPass == ""){
      return false;
    }
    $.post('/cn/api/register',{type:2,registerStr:email,code:code,pass:emailPass},function(res){
      console.log(res);
      if(res.code == 0){
        // $(".reg-success").show();
        // $(".shop-login").hide();
      }else{
        alert(res.message);
      }
    },'json')
  },
  /*enter键邮箱注册*/
  enterEmail : function(e) {
    if (e.keyCode == 13) {
      this.emailRegister();
    }
  },
  /*enter键手机注册*/
  enterPhone : function(e){
    if(e.keyCode == 13){
      this.phoneRegister();
    }
  }
};
$(function () {
  _register.init();
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
})
