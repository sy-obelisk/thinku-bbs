<header class="header">
    <div class="p-container clearfix">
        <div class="wrap fr">
            <?php if($userId==false){?>
            <ul class="header-login">
                <li><a href="/login.html">登录</a></li>
                <li><a href="/register.html">注册</a></li>
            </ul>
            <?php } else{?>
            <div class="header-person">
                <div>
                    <img src="/cn/images/head.png" alt="">
                    <p><?php echo $user['nickname']?$user['nickname']:$user['userName']?></p>
                </div>
                <ul>
                    <li><a href="/person/1.html">个人中心</a></li>
                    <li><a href="">退出</a></li>
                </ul>
            </div>
            <?php }?>
        </div>
    </div>
</header>
<nav class="nav p-container clearfix">
    <a href="/index.html" class="home-icon">
        <img src="/cn/images/logo.png" alt="">
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
      <input type="search" class="ask-input" placeholder="请输入问题"></input>
      <ul class="ask-list">
        <p>你想问的是不是：</p>
        <li class="ask-item">
          <a href=""><p>GMAT报名流程？</p><span>1个人回答</span></a>
        </li>
      </ul>
      <button class="ask-ck-new">新问题</button>
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
      <button class="submit-que">发布</button>
    </div>
  </div>
</div>