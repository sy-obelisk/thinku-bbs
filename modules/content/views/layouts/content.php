
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="title" content="雷哥GMAT在线后台">
    <meta name="description" content="雷哥GMAT在线后台">
    <meta name="keywords" content="雷哥GMAT在线后台">
    <meta name="apple-mobile-web-app-capable" content="yes" />
    <title>留学后台</title>
    <!-- Le styles -->
    <link href="/css/coreCss/bootstrap-combined.min.css" rel="stylesheet">
    <link href="/css/coreCss/layoutit.css" rel="stylesheet">
    <link href="/css/coreCss/plugin.css" rel="stylesheet">

    <script type="text/javascript" src="/easyui/jquery.min.js"></script>
</head>
<body>

<div class="navbar navbar-inverse">
    <div class="navbar-inner">
        <div class="container-fluid">
            <button data-target=".nav-collapse" data-toggle="collapse" class="btn btn-navbar" type="button"> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
            <a href="index.php" target="_blank" class="brand"><img src="/css/coreCss/img/favicon.png">托福后台</a>
            <div class="nav-collapse navbar-responsive-collapse collapse">
                <ul class="nav">
                    <?php
                    use app\modules\content\models\Category;
                    $catId = isset($_GET['catId'])?$_GET['catId']:'';
                    if(empty($catId)){
                        $navData = Category::find()->where('pid=1 AND isShow=1')->all();
                    }else{
                        $navData = Category::findOne($catId);
                        $navData = Category::find()->where("pid=$navData->pid AND isShow=1")->all();
                    }
                    foreach($navData as $v) {
                        ?>

                        <li class="<?php if ($catId == $v['id']) echo 'active' ?>">
                            <a href="<?php echo baseUrl?>/content/content/index?catId=<?php echo $v['id']?>"><?php echo $v['name']?></a>
                        </li>
                    <?php
                    }
                    ?>
                </ul>
                <ul class="nav pull-right">
                    <li>
                        <a href="<?php echo baseUrl?>/basic/index/index" target="_self">后台首页</a>
                    </li>
                    <li>
                        <a href="/user/login/login-out">退出管理</a>
                    </li>
                </ul>
            </div>

        </div>
    </div>
</div>
<div class="container-fluid">
    <div class="row-fluid">
        <div class="span2">
            <?php
            $catId = isset($_GET['catId'])?$_GET['catId']:1
            ?>
            <table width="200" class="table table-hover easyui-treegrid" title="分类表"  data-options="
				url: '<?php echo baseUrl?>/content/api/category?pid=<?php echo $catId?>&show=1&status=1&id=<?php echo isset($_GET['catId'])?$_GET['catId']:''?>',
				method: 'get',
				idField: 'id',
				treeField: 'name'
			">
                <thead>
                <tr>
                    <th data-options="field:'id'"  align="middle" >ID</th>
                    <th data-options="field:'name'"  align="left" >分类名称</th>
                    <th data-options="field:'action'"  align="middle">操作</th>
                </tr>
                </thead>
                <tbody>

                </tbody>
            </table>
        <!-- $content变量的值 就是子页面渲染之后的代码。也就是说子页面中的内容将输出到这个地方-->
        </div>
        <?= $content ?>
    </div>
</div>
</body>
</html>
<script>
    $('.easyui-treegrid').treegrid({
        onLoadSuccess: function (newValue, oldValue) {
            $('.easyui-treegrid').treegrid('expandTo',<?php echo isset($_GET['showId'])?$_GET['showId']:''?>).treegrid('select',<?php echo isset($_GET['showId'])?$_GET['showId']:''?>);
        }
    })
</script>

