
<div class="navbar navbar-inverse">
    <div class="navbar-inner">
        <div class="container-fluid">
            <button data-target=".nav-collapse" data-toggle="collapse" class="btn btn-navbar" type="button"> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
            <a href="/" target="_blank" class="brand"><img src="/css/coreCss/img/favicon.png">托福后台</a>
            <div class="nav-collapse navbar-responsive-collapse collapse">
                <ul class="nav">
                    <?php
                    foreach($navData as $v) {
                        ?>
<?php
                        if(in_array($v['id'],$blockArr)) {
                            ?>
                            <li class="<?php if ($data == $v['value']) echo 'active' ?>">
                                <a href="<?php echo baseUrl?>/<?php echo $v['value'];?>/index/index"><?php echo $v['name']?></a>
                            </li>
                        <?php
                        }
                            ?>
                    <?php
                    }
                    ?>
                </ul>
                <ul class="nav pull-right">
                    <li>
                        <a href="<?php echo baseUrl?>/basic/index/index" >后台首页</a>
                    </li>
                    <li>
                        <a href="<?php echo baseUrl?>/user/login/html">生成静态页</a>
                    </li>
                    <li>
                        <a href="/user/login/login-out">退出管理</a>
                    </li>
                </ul>
            </div>

        </div>
    </div>
</div>