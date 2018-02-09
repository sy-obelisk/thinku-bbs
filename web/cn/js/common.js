/**
 * Created by daicunya on 2018/1/23.
 */

var _common = {
  init : function () {
    this.bind();
  },
  bind : function () {
    
  },
  setCookie : function (name,value) {
    var Days = 30,
        exp  = new Date();
    exp.setTime(exp.getTime() + Days*24*60*60*1000);
    document.cookie = name + "="+ escape (value) + ";expires=" + exp.toGMTString();
  },
  getCookie : function (name) {
    var arr,
        reg=new RegExp("(^| )"+name+"=([^;]*)(;|$)");
    if(arr = document.cookie.match(reg))
      return unescape(arr[2]);
    else
      return null;
  },
  delCookie : function (name) {
    var exp = new Date();
    exp.setTime(exp.getTime() - 1);
    var cval = this.getCookie(name);
    if(cval != null)
      document.cookie= name + "="+cval+";expires="+exp.toGMTString();
  }
};
$(function () {
  _common.init();
  // 导航头部个人中心
  $('.header-person>div').mouseover(function () {
    $('.header-person>ul').show();
  }).mouseleave(function () {
    $('.header-person>ul').hide();
  });
  $('.header-person>ul').mouseover(function () {
    $('.header-person>ul').show();
  }).mouseleave(function () {
    $('.header-person>ul').hide();
  });

});