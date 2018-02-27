
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
      <ul class="data">
        <li>
          <label for="">用&nbsp;户&nbsp;名：</label><input type="text">
        </li>
        <li>
          <label for="">真实姓名：</label><input type="text">
        </li>
        <li>
          <label for="">生&nbsp;&nbsp;&nbsp; 日：</label><input type="text" placeholder="请选择日期" id="birthDate">
        </li>
        <li>
          <label for="">现&nbsp;居&nbsp;地：</label><input type="text">
        </li>
        <li>
          <label for="">联系电话：</label><input type="text">
        </li>
        <li>
          <label for="">email&nbsp;&nbsp; ：</label><input type="text">
        </li>
        <li>
          <label for="">毕业院校：</label><input type="text">
        </li>
        <li>
          <label for="">学&nbsp;&nbsp;&nbsp; 历：</label><input type="text">
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
          <label for="">新&nbsp;密&nbsp;码：</label><input type="text">
        </li>
        <li>
          <label for="">密码确认：</label><input type="text">
        </li>
        <li>
          <label for="">email&nbsp;：</label><input type="text">
        </li>
        <li>
          <label for="">手机号码：</label><input type="text">
        </li>
        <li>
          <label for="">验&nbsp;证码&nbsp;：</label><input type="text">
        </li>
        <input type="button" value="提交" id="passBtn">
      </ul>
    </div>
  </section>
</div>
<script src="/cn/laydate/laydate.js"></script>
<script>
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
</script>
