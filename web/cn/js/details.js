/**
 * Created by daicunya on 2018/2/6.
 */
var _details = {
  init : function () {
    this.bind();
  },
  bind : function () {
    var _this = this;
    // 显示（隐藏）回复评论内容
    $('.reply-list').on('click','.show-wrap',function () {
      $(this).siblings('.revert-wrap').toggle();
    });
    // 回复评论
    $('.reply-list').on('click','#revertBtn',function () {
      _this.revertEvent(this);
    });
    // 发表评论
    $('#replyBtn').click(function () {
      _this.replyEvent();
    });
  },
  revertEvent : function (obj) {
    var revertCnt = $(obj).siblings('textarea').val();
    if (!revertCnt) {
      alert('内容不能为空!');
    } else {
      $('.revert-input textarea').val('');
      var lis = "<li>";
      lis+= "<span class='revert-name'>凤凰火:</span>"+
            "<em class='revert-text'>这是回复的内容</em>"+
            "<div class='revert-time'>2018-1-23</div>"+
            "</li>";
      $(obj).parent().siblings('.revert-list').append(lis);
    }
  },
  replyEvent : function () {
    var replyCnt = $('.reply-input textarea').val();
    if (!replyCnt) {
      alert('请输入评论内容!');
    } else {
      $.post('/cn/api/discuss',{
        id: '23',
        pid: 0,
        comment: replyCnt
      },function (res) {
        console.log(res);
        if (res.code == 1) {
          var lis = "<li class='reply-item'>";
          lis+= "<div class='reply-wrap clearfix'>"+
            "<div class='reply-img'>"+
            "<div>"+
            "<img src='' alt=''></div>"+
            "<p>这是名字</p>"+
            "</div>"+
            "<div class='reply-cnt'>"+
            "<p>这是发表的评论内容</p>"+
            "<div class='revert'>"+
            "<div class='show-wrap'>"+
            "<span>回复</span>"+
            "</div>"+
            "<div class='revert-wrap'>"+
            "<ul class='revert-list'>"+
            "</ul>"+
            "<div class='revert-input clearfix'>"+
            "<textarea placeholder='我也来说两句....'></textarea>"+
            "<button id='revertBtn'>评论</button>"+
            "</div>"+
            "</div>"+
            "</div>"+
            "</div>"+
            "</div>"+
            "<div class='reply-time clearfix'>"+
            "<p>发表于：2018-01-12</p>"+
            "<div>"+
            "<p>举报</p>"+
            "<p>支持<span>100</span></p>"+
            "<p>反对<span>20</span></p>"+
            "</div>"+
            "</div>"+
            "</li>";
          $('.reply-list>ul').append(lis);
        }
      },'json');
    }
  }
};
$(function () {
  _details.init();
//  分页
  $.jqPaginator('#pagination1', {
    totalPages: 20,
    visiblePages: 7,
    currentPage: 1,
    onPageChange: function (num, type) {
      console.log(num,type);
      // $('#p1').text(type + '：' + num);
    }
  });
})