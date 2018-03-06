
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
          <label for="">昵&nbsp;&nbsp;&nbsp; 称：</label><?php if($data['nickname']){?><span><?php echo $data['nickname']?></span><a class="change-data" data-id="nickname" href="javascript:void(0)">修改</a><?php }else{?><input class="nickname" type="text" placeholder="设置自己的昵称吧"><?php }?>
        </li>
        <li>
          <label for="">真实姓名：</label>
          <?php if($data['name']!=false){?>
            <span><?php echo $data['name'];?></span><a class="change-data" data-id="name" href="javascript:void(0)">修改</a>
          <?php }else{?>
            <input class="name" type="text">
          <?php }?>
        </li>
        <li>
          <label for="">生&nbsp;&nbsp;&nbsp; 日：</label><?php if($data['bathday']){?><span><?php echo substr($data['bathday'],0,10)?></span><a class="change-data" data-id="birth" href="javascript:void(0)">修改</a><?php }else{?><input class="birth" type="text" placeholder="请选择日期" id="birthDate"><?php }?>
        </li>
        </li>
        <li>
          <label for="">现&nbsp;居&nbsp;地：</label><?php if($data['address']){?><span><?php echo $data['address']?></span><a class="change-data" data-id="place" href="javascript:void(0)">修改</a><?php }else{?><input class="place" type="text"><?php }?>
        </li>
        <li>
          <label for="">联系电话：</label><?php if($data['phone']){?><span><?php echo $data['phone']?></span><a class="change-data" data-id="phone" href="javascript:void(0)">修改</a><?php }else{?><input type="text" class="phone" placeholder="电话"><?php }?>
        </li>
        <li>
          <label for="">email&nbsp;&nbsp; ：</label><?php if($data['email']){?><span><?php echo $data['email']?></span><a class="change-data" data-id="p-email" href="javascript:void(0)">修改</a><?php }else{?><input type="text" class="p-email" placeholder="邮箱"><?php }?>
        </li>
        <li>
          <label for="">毕业院校：</label><?php if($data['school']){?><span><?php echo $data['school']?></span><a class="change-data" data-id="school" href="javascript:void(0)">修改</a><?php }else{?><input  class="school" type="text"><?php }?>
        </li>
        <li>
          <label for="">学&nbsp;&nbsp;&nbsp; 历：</label><?php if($data['education']){?><span><?php echo $data['education']?></span><a class="change-data" data-id="education" href="javascript:void(0)">修改</a><?php }else{?><input class="education" type="text"><?php }?>
        </li>
        <input type="button" id="dataBtn" value="保存">
      </ul>
      <!--积分-->
      <ul class="score">
<!--        <h2><span class="iconfont icon-jifen"></span>积分：--><?php //echo $integral['integral']?><!--</h2>-->
<!--        <h5>积分记录</h5>-->
<!--        --><?php
//        foreach($integral['details'] as $v){?>
<!--        <li>-->
<!--          <p>--><?php //echo $v['message']?><!--</p>-->
<!--          <p>--><?php //echo ($v['type'] == 1?'+':'-').$v['score']?><!--</p>-->
<!--          <p>--><?php //echo $v['createTime']?><!--</p>-->
<!--        </li>-->
<!--        --><?php //}?>
        <!---分页-->
        <div class="page-wrap">
          <ul class="pagination" id="pagination1"></ul>
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
<script src="/cn/js/person-index.js"></script>
