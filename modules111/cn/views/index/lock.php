<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <!--阻止浏览器缓存-->
    <meta http-equiv="pragma" content="no-cache">
    <meta http-equiv="Cache-Control" content="no-cache, must-revalidate">
    <meta http-equiv="expires" content="0">
    <!-- Basic Page Needs
     ================================================== -->
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="keywords" content="">
    <meta name="description" content="">
    <meta name="title" content="">
    <meta name="author" content="">
    <meta name="Copyright" content="">
    <meta name="description" content="">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <!-- 让IE浏览器用最高级内核渲染页面 还有用 Chrome 框架的页面用webkit 内核
    ================================================== -->
    <meta http-equiv="X-UA-Compatible" content="chrome=1,IE=edge">
    <!-- IOS6全屏 Chrome高版本全屏
    ================================================== -->
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="mobile-web-app-capable" content="yes">
    <!-- 让360双核浏览器用webkit内核渲染页面
    ================================================== -->
    <meta name="renderer" content="webkit">
    <link rel="stylesheet" href="/cn/css/reset.css">
    <link rel="stylesheet" href="/cn/css/common.css">
    <link rel="stylesheet" href="/cn/css/swipebox.css">
    <link rel="stylesheet" href="/cn/css/main.css">
    <link rel="stylesheet" href="/cn/css/animate.min.css">
    <script src="/cn/js/jquery-1.12.2.min.js"></script>
    <script src="/cn/js/jquery.swipebox.js"></script>
    <script src="/cn/js/jquery.SuperSlide.2.1.1.js"></script>
    <title>雷哥社区</title>
</head>
<body>
<!--搜索-->
<?php use app\commands\front\NavWidget; ?>
<?php NavWidget::begin(); ?>
<?php NavWidget::end(); ?>

<div id="pt" class="bm cl">
    <div class="z">
        <a href="/" class="nvhm" title="首页"></a>
        <em>&gt;</em><span><?php echo $data['name']?></span>
    </div>
</div>

<div id="ct" class="wp cl">
    <div class="mn">
        <div class="nfl">
            <div class="f_c">
                <?php  if($data['keyTag'] == 1) { ?>
                    <h3 class="xs2 mbm">本版块需要密码，您必须在下面输入正确的密码才能浏览这个版块</h3>
                    <div class="o">
                            <input id="pass" type="password" name="pw" class="px vm" size="25">
                            &nbsp;
                            <button onclick="lock()" class="pn pnc vm" type="button" name="loginsubmit" value="true">
                                <strong>提交</strong>
                            </button>
                    </div>
                    <script type="text/javascript">
                        function lock(){
                            var password = $("#pass").val();
                            $.post("/cn/api/lock",{pass:password,catId:<?php echo $data['id']?>},function(re){
                                if(re.code == 1){
                                    location.href="<?php echo Yii::$app->session->get('lockUrl')?>";
                                }else{
                                    alert(re.message);
                                }
                            },'json')
                        }
                    </script>
                <?php
                }else {
                    ?>
                    <h3 class="xs2 mbm">本版块需要成为为社区学员才能进入，你已获得<?php echo $integral?>雷豆，累计获取10000雷豆将成为会员</h3>
                    <div class="o">
                            &nbsp;
                            <a href="http://order.gmatonline.cn/pay/order/integral?url=http://bbs.viplgw.cn/post/<?php echo $data['id']?>.html"><button class="pn pnc vm" type="submit" name="loginsubmit" value="true">
                                <strong>充值</strong>
                            </button></a>
                    </div>
                <?php
                }
                ?>
            </div>
        </div>
    </div>
</div>
<?php use app\commands\front\FooterWidget; ?>
<?php FooterWidget::begin(); ?>
<?php FooterWidget::end(); ?>
</body>
</html>


