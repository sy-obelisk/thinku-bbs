/**
 * Created by daicunya on 2018/2/5.
 */
$(function () {
  _new.init();
});

var _new = {
  init : function () {
    this.bind();
  },
  bind : function () {
    var _this = this;
    // 发表
    $('.put-in').click(function () {
      _this.publishEvent();
    })
  },
  // 检查分类是否有填写,发表
  publishEvent : function () {
    if ($('#clsFirst').val() == '帖子分类' || $('#clsSecond').val() == '二级分类' || ($('#clsThird').css('visibility') == 'visible' && $('#clsThird').val() == '三级分类')) {
      alert("请选择帖子分类!");
      return false;
    }
    if (!$('.new-title input').val()) {
      alert('请出入标题!');
      return false;
    }
    if(!ue.getContent()) {
      alert('请输入帖子内容!')
      return false;
    }
    if ($('#clsThird').val() == '三级分类') {
      var category = $('#clsFirst').val()+','+$('#clsSecond').val();
    } else {
      var category = $('#clsFirst').val()+','+$('#clsSecond').val()+','+$('#clsThird').val();
    }
    $.ajax({
      type: 'post',
      url : "/cn/api/new-article",
      data: {
        name: $('.new-title input').val(), // 标题
        catId: $('#clsFirst').val(), // 主 id
        article: ue.getContent(), // 帖子内容
        category: category // 子分类id
      },
      dataType : 'json',
      success : function (res) {
        console.log(res);
        if (res.code == 0) {
          alert(res.message);
          location.href = '/details/'+res.id+'.html';
        }
      }
    })
  }
}