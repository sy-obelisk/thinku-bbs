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
    // 文章举报
    $('#artAccuse').click(function () {
      _this.accuse(this,1);
    });
    // 评论举报
    $('.reply-list').on('click','#accuseBtn',function () {
      _this.accuse(this,2);
    });
    // 关闭举报框
    $('.accuse .box>span').click(function () {
      $('.accuse').hide();
    });
    // 支持
    $('.reply-list').on('click','#support',function () {
      _this.support(this);
    });
    // 反对
    $('.reply-list').on('click','#oppose',function () {
      _this.oppose(this);
    });
    // 设为最佳答案
    $('.reply-list').on('click','.best-btn',function () {
      _this.bestAns(this);
    });
    // 下载附件
    $('#downBtn').click(function () {
      $.post('/cn/api/download',{
        id: $('.article').data('id'),
        num: 1
      },function (res) {
        console.log(res);
      },'json')
    })
  },
  // 回复评论
  revertEvent : function (obj) {
    var revertCnt = $(obj).siblings('textarea').val(),
        _this = this;
    if (!revertCnt) {
      alert('内容不能为空!');
    } else {
      $.post('/cn/api/discuss',{
        id: _this.pData.id,
        pid: $(obj).parent().parent().parent().parent().parent().parent().data('id'),
        comment: revertCnt
      },function (res) {
        console.log(res);
        var date = new Date(),
          time = date.getFullYear()+'-'+Number(date.getMonth()+1)+'-'+date.getDate()
        if (res.code == 0) {
          $('.revert-input textarea').val('');
          var lis = "<li>";
          lis+= "<span class='revert-name'>"+_this.pData.name+":</span>"+
            "<em class='revert-text'>"+revertCnt+"</em>"+
            "<div class='revert-time'>"+time+"</div>"+
            "</li>";
          $(obj).parent().siblings('.revert-list').append(lis);
        }
      },'json');
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
          var lis = "<li class='reply-item' data-id='"+res.id.id+"'>";
          lis+= "<div class='reply-wrap clearfix'>"+
            "<div class='reply-img'>"+
            "<div>"+
            "<img src='"+_this.pData.imgSrc+"' alt='头像'></div>"+
            "<p class='reply-name'>"+_this.pData.name+"</p>";
          if (!$('.best-ans')[0]){
            lis+="<p class='best-btn'>设为最佳答案</p>";
          }
          lis+="</div>"+
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
            "<p id='accuseBtn'>举报</p>"+
            "<p id='support'>支持<span>0</span></p>"+
            "<p id='oppose'>反对<span>0</span></p>"+
            "</div>"+
            "</div>"+
            "</li>";
          $('.reply-list>ul').prepend(lis);
          $('.reply-input textarea').val('');
          var height = $('.reply').offset().top;
          $(window).scrollTop(height-50);
        } else if(res.code == 2){
          alert('请登录后再评论');
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
  // 举报
  accuse : function (obj,num) {
    $('.accuse').show();
    if (num == 1){
      var val = $('.article').data('id');
    } else {
      var val = $(obj).parent().parent().parent().data('id');
    }
    $('#subAccuse').click(function () {
      console.log('aaa');
      var cnt = $('.accuse-cnt').val();
      var type = $('input:radio[name="typeItem"]:checked').val();
      if (!cnt) {
        alert('请输入举报内容');
        return false;
      }
      if(!type) {
        alert('请选择举报类型');
        return false;
      }
      $.post('/cn/api/report',{
        contentId: val,
        description: cnt,
        reportType: type,
        cate: num
      },function (res) {
        console.log(res);
        if (res.code == 0){
          alert('提交成功');
          $('.accuse').hide();
        }
      },'json')
    })
  },
  // 支持
  support : function (obj) {
    var num = $(obj).children().html();
    $.post('/cn/api/like',{
      id : $(obj).parent().parent().parent().data('id'),
      type : 2,
      status : 1
    },function (res) {
      console.log(res);
      if (res.code == 0){
        alert(res.message);
        $(obj).children().html(Number(num+1));
      } else {
        alert(res.message)
      }
    },'json')
  },
  // 反对
  oppose : function (obj) {
    var num = $(obj).children().html();
    $.post('/cn/api/like',{
      id : $(obj).parent().parent().parent().data('id'),
      type : 2,
      status : 2
    },function (res) {
      console.log(res);
      if (res.code == 0){
        alert(res.message);
        $(obj).children().html(Number(num+1));
      } else {
        alert(res.message);
      }
    },'json')
  },
  // 设为最佳答案
  bestAns : function (obj) {
    var dis = $(obj).parent().parent().parent().data('id'),
        id = $('.article').data('id');
    $.post('/cn/api/model',{
      id: id,
      disId: dis
    },function (res) {
      console.log(res);
      if (res.code == 0){
        $(obj).parent().parent().parent().append('<div class="best-ans">最佳答案</div>');
        $('.best-btn').hide();
        location.reload();
      }
      alert(res.message);
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