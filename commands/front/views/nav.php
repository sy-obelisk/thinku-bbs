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
                    <li><a href="/person.html">个人中心</a></li>
                    <li><a href="">退出</a></li>
                </ul>
            </div>
            <?php }?>
        </div>
    </div>
</header>
<nav class="nav p-container clearfix">
    <a href="" class="home-icon">
        <img src="/cn/images/logo.png" alt="">
    </a>
    <div class="title">
        <img src="/cn/images/index01.png" alt="">
    </div>
    <div class="search clearfix">
        <ul>
            <li><span class="iconfont icon-hot"></span>热搜:</li>
            <li><a href="javascript:void(0)">美国留学</a></li>
            <li><a href="javascript:void(0)">大学排名</a></li>
            <li><a href="javascript:void(0)">专业解读</a></li>
        </ul>
        <form>
            <input type="text" placeholder="search">
      <span>
          <i class="fa fa-search"></i>
        </span>
        </form>
    </div>
</nav>