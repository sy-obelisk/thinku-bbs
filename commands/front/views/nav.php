<header class="header">
    <div class="p-container clearfix">
        <div class="think-nav fl">
          <ul>
            <li><a href="http://www.thinkwithu.com/study-aboard/assistance.html" target="_blank">留学服务</a></li>
            <li><a href="http://www.thinkwithu.com/gmatsheet.html" target="_blank">GMAT课程</a></li>
            <li><a href="http://www.thinkwithu.com/satsheet.html" target="_blank">SAT课程</a></li>
            <li><a href="http://www.thinkwithu.com/toefl/assistance.html" target="_blank">托福课程</a></li>
            <li><a href="http://www.thinkwithu.com/ieltssheet.html" target="_blank">雅思课程</a></li>
            <li><a href="http://www.thinkwithu.com/public-class.html" target="_blank">申友讲堂</a></li>
            <li><a href="http://www.gmatonline.cn/index.html" target="_blank">申友在线</a></li>
            <li><a href="http://www.thinkwithu.com/teachers.html" target="_blank">名师云集</a></li>
            <li><a href="http://www.thinkwithu.com/case.html" target="_blank">成功案例</a></li>
            <li><a href="http://www.thinkwithu.com/schools.html" target="_blank">院校库</a></li>
            <li>|</li>
            <li>400-600-1123</li>
            <li><a href="http://p.qiao.baidu.com/im/index?siteid=6058744&ucid=3827656&cp=&cr=&cw=" target="_blank">在线咨询</a></li>
          </ul>
        </div>
        <div class="wrap fr">
            <?php if($userId==false){?>
            <ul class="header-login">
                <li><a href="/login.html">登录</a></li>
                <li><a href="/register.html">注册</a></li>
            </ul>
            <?php } else{?>
            <div class="header-person">
                <div>
                    <img src="<?php echo $user['image']!=false?$user['image']:'/cn/images/head.png'?>" alt="">
                    <p><?php echo $user['nickname']?$user['nickname']:$user['userName']?></p>
                </div>
                <ul>
                    <li><a href="/person.html">个人中心</a></li>
                    <li><a href="">退出</a></li>
                </ul>
            </div>
            <?php }?>
        </div>
    </div>
</header>
<nav class="nav p-container clearfix">
    <a href="/index.html" class="home-icon">
        <img src="/cn/images/sy-lg.png" alt="">
    </a>
    <div class="title">
        <img src="/cn/images/index01.png" alt="">
    </div>
    <div class="search clearfix">
        <ul class="search-hot">
            <li><span class="iconfont icon-hot"></span>热搜:</li>
            <li><a href="javascript:void(0)">美国留学</a></li>
            <li><a href="javascript:void(0)">大学排名</a></li>
            <li><a href="javascript:void(0)">专业解读</a></li>
        </ul>
        <div>
            <input class="search-text" type="text" placeholder="search" onkeypress="_common.enterSearch(event)">
          <span>
            <i class="fa fa-search"></i>
          </span>
        </div>
    </div>
</nav>
<!--提问-->
<div class="ask">
  <!--提问搜索-->
  <div class="ask-p ask-search">
    <h5>我要提问</h5>
    <span class="ask-close">X</span>
    <div class="ask-wrap">
      <p>提问前请先搜索</p>
      <input type="search" class="ask-input" placeholder="请输入问题"/>
      <ul class="ask-list">
<!--        <p>你想问的是不是：</p>-->
<!--        <li class="ask-item">-->
<!--          <a href=""><p>GMAT报名流程？</p><span>1个人回答</span></a>-->
<!--        </li>-->
      </ul>
      <button class="ask-ck-new">不是，提新问题</button>
    </div>
  </div>
  <!--提交新提问-->
  <div class="ask-p ask-sub">
    <h5>我要提问</h5>
    <span class="ask-close">X</span>
    <div class="ask-wrap">
      <p>新问题：</p>
      <input class="new-question" type="text">
      <p>问题说明（可选）：</p>
      <textarea class="ques-explain"></textarea>
      <div class="reward"><p>我要悬赏(可选)：</p><input class="reward-input" type="text">积分</div>
      <button class="que-cancel">取消</button><button class="submit-que">发布</button>
    </div>
  </div>
</div>
