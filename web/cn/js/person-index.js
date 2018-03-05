/**
 * Created by daicunya on 2018/2/28.
 */
var _person = {
  init: function () {
    this.bind();
    this.getIntegral(1);
  },
  bind: function () {
    var _this = this;
    $('.change-data').click(function () {
      var className = $(this).data('id');
      console.log(className);
      $(this).unbind().parent().append("<input class='"+className+"' type='text'>");
    });
    //  修改个人资料
    $('#dataBtn').click(function () {
      _this.changeInfo();
    });
    // 获取验证码
    $('#getCode').click(function () {
      var eData = $('.email').val(),
          pData = $('.phones').val();
      if (!eData && !pData) {
        alert('请输入手机号或邮箱');
      } else if (pData) {
        clickDX(this,60,1);
      } else if (eData) {
        clickDX(this,120,2);
      }
    });
    // 修改密码
    $('#passBtn').click(function () {
      _this.changePass();
    })
  },
  //  修改个人资料
  changeInfo: function () {
    var name = $('.name').val(),
      birth = $('.birth').val(),
      email = $('.p-email').val(),
      phone = $('.phone').val(),
      nickname = $('.nickname').val(),
      school = $('.school').val(),
      edu = $('.education').val(),
      place = $('.place').val();

    if (name || birth || email || phone || nickname || school || edu || place) {
      $.post('/cn/api/change-user-info',{
        userName: name, // 真实名字
        bathday: birth, // 生日
        email : email, // 邮箱
        phone : phone, // 手机
        nickName : nickname, // 昵称
        school : school, // 选校
        education : edu, // 学历
        address : place // 住址
      },function (res) {
        console.log(res);
        if (res.code == 0){
          alert(res.message);
          location.reload();
        }
      },'json')
    } else {
      alert('请填写资料再提交');
    }
  },
  // 修改密码
  changePass: function () {
    var pass = $('.new-pass').val(),
        passAgain = $('.pass-again').val(),
        eData = $('.email').val(),
        pData = $('.phones').val(),
        code = $('.veri-code').val();
    console.log(pass,passAgain,eData,pData,code);
    if (!pass){
      alert('请输入密码');
      return false;
    }
    if(!passAgain){
      alert('请输入确认密码');
      return false;
    }
    if(pass != passAgain){
      alert('两次输入密码不一致');
      return false;
    }
    if(!eData && !pData){
      alert('请输入手机或邮箱');
      return false;
    }
    if(!code){
      alert('请输入验证码');
      return false;
    }

    if (pData){
      var registerStr = pData;
    } else if(eData){
      var registerStr = eData;
    }
    $.post('/cn/api/change-pass',{
      registerStr: registerStr,
      pass: pass,
      newPass: passAgain,
      code: code
    },function (res) {
      console.log(res);
    },'json')
  },
  // 获取积分列表
  getIntegral: function (p) {
    var tp = '';
    $.ajax({
      url: '/cn/api/integral',
      type: 'post',
      data: {
        page: p
      },
      dataType: 'json',
      beforeSend: function () {
        $('.score').html("加载中...");
      },
      success: function (res) {
        tp = res.page.pagecount;
        if (!res.page.count){
          tp = 1;
        }
        var sbox = '<h2><span class="iconfont icon-jifen"></span>积分：'+res.data.integral+'</h2>'+
            '<h5>积分记录</h5>';
        for(var i=0,data=res.data.details;i<data.length;i++){
          sbox+='<li>'+
            '<p>'+data[i].message+'</p>'+
            '<p>'+data[i].score+'</p>'+
            '<p>'+data[i].createTime+'</p>'+
            '</li>';
        }
        var page = '<div class="page-wrap">'+
            '<ul class="pagination" id="pagination1"></ul>'+
            '</div>';
        $('.score').html(sbox+page);
        $(window).scrollTop(134);
      },
      complete: function () {
        console.log(tp);
        $.jqPaginator('.pagination', {
          totalPages: tp,
          visiblePages: 6,
          currentPage: p,
          onPageChange: function (num,type) {
            if(type == 'change'){
               _person.getIntegral(num);
            }
          }
        });
      }
    })
  }
}
$(function () {
  _person.init();
  jQuery(".single-cnt").slide({});
  //  日期选择
  laydate.render({
    elem: '#birthDate' //指定元素
  });

});