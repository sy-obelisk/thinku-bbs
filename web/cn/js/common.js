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
    })
  },
  // 设置cookie
  setCookie : function (name,value) {
    var Days = 30,
        exp  = new Date();
    exp.setTime(exp.getTime() + Days*24*60*60*1000);
    document.cookie = name + "="+ escape (value) + ";expires=" + exp.toGMTString();
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
    var exp = new Date();
    exp.setTime(exp.getTime() - 1);
    var cval = this.getCookie(name);
    if(cval != null)
      document.cookie= name + "="+cval+";expires="+exp.toGMTString();
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
      console.log(res);
      location.reload();
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