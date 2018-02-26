/**
 * Created by daicunya on 2018/2/6.
 */
var _details = {
  pData : {
    id : $('.article').data('id'),
    imgSrc : $('.header-person>div img').attr('src'),
    name : $('.header-person>div p').html()
  },
  init : function () {
    this.bind();
    console.log(location.href);
    console.log(this.pData);
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
    // 收藏
    $('.collect li').eq(0).click(function () {
      _this.collect(this);
    });
    // 顶一下
    $('.collect li').eq(1).click(function () {
      _this.up(this);
    });
    // 踩
    $('.collect li').eq(2).click(function () {
      _this.down(this);
    });
    // 支持
    $('.reply-time>div p').eq(1).click(function () {
      _this.support(this);
    });
    // 反对
    $('.reply-time>div p').eq(2).click(function () {
      _this.oppose(this);
    });
  },
  // 回复评论
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
  // 发表评论
  replyEvent : function () {
    var replyCnt = $('.reply-input textarea').val(),
        _this = this;
    if (!replyCnt) {
      alert('请输入评论内容!');
    } else {
      $.post('/cn/api/discuss',{
        id: _this.pData.id,
        pid: 0,
        comment: replyCnt
      },function (res) {
        console.log(res);
        var date = new Date(),
            time = date.getFullYear()+'-'+Number(date.getMonth()+1)+'-'+date.getDate()
        if (res.code == 0) {
          var lis = "<li class='reply-item'>";
          lis+= "<div class='reply-wrap clearfix'>"+
            "<div class='reply-img'>"+
            "<div>"+
            "<img src='' alt=''></div>"+
            "<p>"+_this.pData.name+"</p>"+
            "</div>"+
            "<div class='reply-cnt'>"+
            "<p>"+$('.reply-input textarea').val()+"</p>"+
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
            "<p>发表于："+time+"</p>"+
            "<div>"+
            "<p>举报</p>"+
            "<p>支持<span>0</span></p>"+
            "<p>反对<span>0</span></p>"+
            "</div>"+
            "</div>"+
            "</li>";
          $('.reply-list>ul').prepend(lis);
          $('.reply-input textarea').val('');
          var height = $('.reply').offset().top;
          $(window).scrollTop(height-50);
        }
      },'json');
    }
  },
  collect : function (obj) {
    $.post('/cn/api/collection',{id:this.pData.id},function (res) {
      console.log(res);
      if (res.code == 0){
        alert(res.message);
        $(obj).html('已收藏').unbind();
      }
    },'json')
  },
  // 顶
  up : function (obj) {
    $.post('/cn/api/like',{
      id:this.pData.id,
      type: 1,
      status: 1
    },function (res) {
      console.log(res);
      if (res.code == 0) {
        var upNum = $('.collect li').eq(1).children('span').html();
        console.log(upNum);
        $('.collect li').eq(1).children('span').html(Number(upNum+1));
        alert(res.message);
      } else {
        alert(res.message);
      }
    },'json')
  },
  // 踩
  down : function (obj) {
    $.post('/cn/api/like',{
      id:this.pData.id,
      type: 1,
      status: 2
    },function (res) {
      console.log(res);
      if (res.code == 0) {
        var upNum = $('.collect li').eq(2).children('span').html();
        alert(res.message);
      } else {
        alert(res.message)
      }
    },'json')
  },
  // 支持
  support : function () {
    $.post('/cn/api/like',{

    },function (res) {

    },'json')
  },
  // 反对
  oppose : function () {
    $.post('/cn/api/like',{

    },function (res) {

    },'json')
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