/**
 * Created by daicunya on 2018/2/5.
 */
$(function () {
  // $('.new-title input').blur(function () {
  //
  //   }
  // });
  _new.init();
});

var _new = {
  init : function () {
    this.bind();
  },
  bind : function () {
    var _this = this;
    // 检查分类是否有填写
    document.querySelector('.new-title input').onblur = function () {
      console.log('sss');
      _this.checkInput(this);
    };
    // 发表
    $('.put-in').click(function () {
      console.log('a');
      _this.publishEvent();
    })
  },
  checkInput : function (obj) {
    var _this = this;
    if ($('#clsFirst').val() == '帖子分类' || $('#clsSecond').val() == '二级分类' || ($('#clsThird').css('visibility') == 'visible' && $('#clsThird').val() == '三级分类')) {
      alert("请选择帖子分类！");
    } else {
      if (!$(obj).val()) {
        alert('请出入标题');
      } else {
        // 点击发表

      }
    }
  },
  // 发表
  publishEvent : function () {
   $.ajax({
     type: 'post',
     url : "/cn/api/new-article",
     data: {
       name: 'fsdfsfd', // 标题
       abstract: 'afa', // 摘要
       pid: '0', // 父id
       catId: '2', // 主 id
       article: '222222', // 帖子内容
       category: '7,21' // 子分类id
     },
     dataType : 'json',
     success : function (res) {
       console.log(res);
     }
   })
  }
}