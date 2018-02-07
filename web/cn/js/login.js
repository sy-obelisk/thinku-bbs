/**
 * Created by daicunya on 2018/2/6.
 */
var _login = {
  init : function () {
    this.bind();
  },
  bind : function () {
    $('.login-change').click(function () {
      $(this).parent().css('display','none').siblings('.userMessage').show();
    })
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
})