/**
 * Created by daicunya on 2018/3/5.
 */
var _question = {
  init : function () {
    this.bind();
  },
  bind : function () {
    $('.new-question').keydown(function () {
      console.log('aa');
    })
  },

};
$(function () {
  _question.init();
})