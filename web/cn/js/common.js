/**
 * Created by daicunya on 2018/1/23.
 */

var _common = {

};
$(function () {
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