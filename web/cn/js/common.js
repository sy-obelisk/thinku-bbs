/**
 * Created by daicunya on 2018/1/23.
 */

var _common = {
  init : function () {
    this.bind();
  },
  bind : function () {
    var _this = this;
    $('.login-change').click(function () {
      $(this).parent().css('display','none').siblings('.userMessage').show();
    });
    // 搜索
    $('.search form>span').click(function () {
      _this.search();
    });
    $('.search-hot a').click(function () {
      $('.search-text').val($(this).html());
      _this.search();
    });
    // 签到
    $('.sign-in .icon').click(function () {
      _this.checkIn();
    }),
    // 退出登录
    $('.header-person>ul li').eq(1).click(function () {
      _this.loginOut();
    }),
    // 提问
    $('.aside-question').click(function () {
        $('.ask').show();
    }),
  //  关闭提问
    $('.ask-close').click(function () {
      $('.ask').hide().children('.ask-p').hide().siblings('.ask-search').show();
    }),
    //  提问切换到发布新问题
    $('.ask-ck-new').click(function () {
      $('.ask-p').hide().siblings('.ask-sub').show();
      $('.new-question').val($('.ask-input').val());
    }),
    // 提问搜索
    $('.ask-input').keyup(function () {
      _this.askInput(this);
    }),
      // 提交提问
    $('.submit-que').click(function () {
      _this.submitQue(this);
    }),
      $('.que-cancel').click(function () {
        $('.ask-p').hide().siblings('.ask-search').show().parent().hide();
      })
  },
  // 设置cookie
  setCookie : function (name,value,day) {
    var date = new Date();
    date.setDate(date.getDate() + day);
    document.cookie = name + "="+ escape(value) + ";expires=" + date;
  },
  // 获取cookie
  getCookie : function (name) {
    var arr,
        reg=new RegExp("(^| )"+name+"=([^;]*)(;|$)");
    if(arr = document.cookie.match(reg))
      return unescape(arr[2]);
    else
      return null;
  },
  // 删除cookie
  delCookie : function (name) {
    var cval = this.getCookie(name);
    if(cval != null)
      this.setCookie(name,null,-1);
  },
  // 搜索
  search : function () {
    var k = $('.search-text').val();
    console.log(k);
    location.href = "/search.html?keyword="+encodeURIComponent(k);
  },
  enterSearch : function (e) {
    if (e.keyCode == 13) {
      this.search();
    }
  },
  // 签到
  checkIn : function () {
    $.post('/cn/api/sign-in',function (res) {
      console.log(res);
      if (res.code == 0) {
        $('.sign-in .icon').unbind();
        alert(res.message);
        var num = $('.sign-in .num p').eq(1).html();
        $('.sign-in .num p').eq(2).html('已签到');
        $('.sign-in .num p').eq(1).html(Number(num)+Number(1));
      }else {
        alert(res.message);
      }
    },'json')
  },
  // 退出
  loginOut : function () {
    $.post('/cn/api/login-out',function (res) {
      location.href = '/index.html';
    },'json')
  },
  // 问题搜索
  askInput : function (obj) {
    var val= $(obj).val();
    $.ajax({
      url: '/cn/api/search-question',
      type: 'post',
      data: {
        keyword: val
      },
      dataType: 'json',
      success:function (res) {
        console.log(res);
        if (res.code == 0) {
          if (JSON.stringify(res.data) != '[]'){
            var lis = '<p>你想问的是不是：</p>';
            for (var i = 0, data = res.data; i < data.length; i++) {
              lis += '<li class="ask-item">' +
                     '<a href="/details/' + data[i].id + '.html"><p>' + data[i].name + '</p><span>1个人回答</span></a>' +
                     '</li>';
            }
            $('.ask-list').show().html(lis);
          }else {
            var lis = '<p>没有您搜索的问题，请提一个新问题</p>';
            $('.ask-list').show().html(lis);
          }
          $('.ask-ck-new').show();
        }
      },
      complete: function () {

      }
    })
  },
  // 提交提问
  submitQue : function (obj) {
    var cnt = $('.new-question').val(),
        explain = $('.ques-explain').val(),
        score = $('.reward-input').val();
    if (!cnt) {
      alert('请输入要提问的问题');
      return false;
    }
    $.post('/cn/api/question',{
      name: cnt,
      article: explain,
      integral: score
    },function (res) {
      console.log(res);
      if (res.code == 0){
        alert(res.message);
        location.href = '/details/'+res.id+'.html';
      }
    },'json')
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

// 短信、邮箱验证码
function clickDX(e, timeN, str,emailType) {
  var phoneReg   = /((\d{11})|^((\d{7,8})|(\d{4}|\d{3})-(\d{7,8})|(\d{4}|\d{3})-(\d{7,8})-(\d{4}|\d{3}|\d{2}|\d{1})|(\d{7,8})-(\d{4}|\d{3}|\d{2}|\d{1}))$)/;
  var emailReg   = /^([a-zA-Z0-9]+[_|\_|\.]?)*[a-zA-Z0-9]+@([a-zA-Z0-9]+[_|\_|\.]?)*[a-zA-Z0-9]+\.[a-zA-Z]{2,4}$/;
  var _that      = $(e);
  var defalutVal = $(e).val();
  var timeNum    = timeN; // 再次点击时间间隔
  if(str == 1){
    var phone = $('.phones').val();
    if(phone == ""){
      alert('请输入手机号！');
      return false;
    }
    if(!phoneReg.test(phone)){
      alert('手机号格式不正确(不能小于11位)!');
      return false;
    }
    $.post('/cn/api/phone-code',{phoneNum:phone,type:emailType},function(res){
      alert(res.message);
      if(res.code == 0){
        _that.attr("disabled", true);
        _that.unbind("click").val(timeNum + "秒后重发");
        var timer = setInterval(function () {
          timeNum--;
          _that.val(timeNum + "秒后重发");
          if (timeNum < 0) {
            clearInterval(timer);
            $(e).removeAttr("disabled");
            _that.val(defalutVal);
          }
        }, 1000);
      }
    },'json')
  }else{
    var mail = $('.email').val();
    console.log(mail);
    if(mail == ""){
      alert("请输入您的邮箱!");
      return false;
    }
    if(!emailReg.test(mail)){
      alert('邮箱格式不正确!');
      return false;
    }
    $.post('/cn/api/send-mail',{email:mail,type:emailType},function(res){
      alert(res.message);
      if(res.code == 0){
        $(e).attr("disabled", true);
        _that.unbind("click").val(timeNum + "秒后重发");
        var timer = setInterval(function () {
          _that.val(timeNum + "秒后重发");
          timeNum--;
          if (timeNum < 0) {
            clearInterval(timer);
            $(e).removeAttr("disabled");
            _that.val(defalutVal);
          }
        }, 1000);
      }
    },'json')
  }
}