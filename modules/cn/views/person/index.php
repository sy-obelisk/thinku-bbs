
  <link rel="stylesheet" href="/cn/css/person-cmn.css">
  <link rel="stylesheet" href="/cn/css/person.css">
<!--内容区-->
<div class="person p-container clearfix">
  <aside class="person-aside">
    <?php use app\commands\front\PersonWidget;?>
    <?php PersonWidget::begin();?>
    <?php PersonWidget::end();?>
  </aside>
  <!--内容区-->
  <section class="person-cnt single-cnt">
    <div class="single-tab hd">
      <ul>
        <li class="on"><span>个人资料</span></li>
        <li><span>积分</span></li>
        <li><span>用户安全</span></li>
        <li><span>密码安全</span></li>
      </ul>
    </div>
    <div class="single-box bd">
      <!--个人资料-->
      <ul class="data person-data">
        <li >
          <label for="">昵&nbsp;&nbsp;&nbsp; 称：</label><span>nicknick</span><a class="change-data" href="javascript:void(0)">修改</a><input class="nickname" type="text" placeholder="设置自己的昵称吧">
        </li>
        <li>
          <label for="">真实姓名：</label><span></span><a class="change-data" href="javascript:void(0)">修改</a><input class="name" type="text">
        </li>
        <li>
          <label for="">生&nbsp;&nbsp;&nbsp; 日：</label><span>1900-12-12</span><a class="change-data" href="javascript:void(0)">修改</a><input class="birth" type="text" placeholder="请选择日期" id="birthDate">
        </li>
        <li>
          <label for="">现&nbsp;居&nbsp;地：</label><span></span><a class="change-data" href="javascript:void(0)">修改</a><input class="place" type="text">
        </li>
        <li>
          <label for="">联系电话：</label><span></span><a class="change-data" href="javascript:void(0)">修改</a><input type="text" class="phone" placeholder="电话">
        </li>
        <li>
          <label for="">email&nbsp;&nbsp; ：</label><span></span><a class="change-data" href="javascript:void(0)">修改</a><input type="text" class="p-email" placeholder="邮箱">
        </li>
        <li>
          <label for="">毕业院校：</label><span></span><a class="change-data" href="javascript:void(0)">修改</a><input  class="school" type="text">
        </li>
        <li>
          <label for="">学&nbsp;&nbsp;&nbsp; 历：</label><span></span><a class="change-data" href="javascript:void(0)">修改</a><input class="education" type="text">
        </li>
        <input type="button" id="dataBtn" value="保存">
      </ul>
      <!--积分-->
      <ul class="score">
        <h2><span class="iconfont icon-jifen"></span>积分：<?php echo $integral['integral']?></h2>
        <h5>积分记录</h5>
        <?php
        foreach($integral['details'] as $v){?>
        <li>
          <p><?php echo $v['message']?></p>
          <p><?php echo ($v['type'] == 1?'+':'-').$v['score']?></p>
          <p><?php echo $v['createTime']?></p>
        </li>
        <?php }?>
        <!---分页-->
<!--        <div class="page-wrap">-->
<!--          <ul class="pagination" id="pagination1"></ul>-->
<!--        </div>-->
        <div>
          <?php echo $page;?>
        </div>
      </ul>
      <!--用户权限-->
      <ul class="limit">
        <li>
          <img src="/cn/images/person-limit.png" alt="">
        </li>
      </ul>
      <!-- 修改密码-->
      <ul class="pass">
        <li>
          <label for="">新&nbsp;密&nbsp;码：</label><input class="new-pass" type="password">
        </li>
        <li>
          <label for="">密码确认：</label><input class="pass-again" type="password">
        </li>
        <li>
          <label for="">email&nbsp;：</label><input class="email" type="text">
        </li>
        <li>
          <label for="">手机号码：</label><input class="phones" type="text">
        </li>
        <li>
          <label for="">验&nbsp;证码&nbsp;：</label><input class="veri-code" type="text"><input type="button" id="getCode" value="获取验证码">
        </li>
        <input type="button" value="提交" id="passBtn">
      </ul>
    </div>
  </section>
</div>
<script src="/cn/laydate/laydate.js"></script>
<script>
  $(function () {
    jQuery(".single-cnt").slide({});
    //  全部消息分页
    $.jqPaginator('#pagination1', {
      totalPages: 20,
      visiblePages: 7,
      currentPage: 1,
      onPageChange: function (num, type) {
        console.log(num,type);
        // $('#p1').text(type + '：' + num);
      }
    });
    //  日期选择
    laydate.render({
      elem: '#birthDate' //指定元素
    });

    $('.change-data').click(function () {
      $(this).siblings('input').toggle();
    });
    
    //  修改个人资料
    $('#dataBtn').click(function () {
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
          userName: name,
          bathday: birth,
          email : email,
          phone : phone,
          nickName : nickname,
          school : school,
          education : edu,
          label : place
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
    });

    // 修改密码
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
    $('#passBtn').click(function () {
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
    })
  });
 
</script>
