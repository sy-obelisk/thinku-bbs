<script type="text/javascript" src="/My97DatePicker/WdatePicker.js"></script>
<script type="text/javascript" src="/cn/js/jquery1.42.min.js"></script>
<div class="span10" id="datacontent">
    <ul class="breadcrumb">
        <li><a href="/user/index/index">用户模块</a> <span class="divider">/</span></li>
        <li class="active">留言管理</li>
    </ul>
    <ul class="nav nav-tabs">
        <li class="active">
            <a href="javascript:;" onclick="javascript:openall();">留言管理</a>
        </li>
    </ul>
    <form action="/user/discuss/publish" id="checkPush" method="post">
        <table class="table table-hover">
            <thead>
            <tr>
                <th width="80">ID</th>
                <th>身份</th>
                <!--                <th>头像</th>-->
                <th>用户</th>
                <th>信息</th>
                <th>留言时间</th>
                <th>状态</th>
                <th>操作</th>
            </tr>
            </thead>
            <tbody>
            <?php
            foreach($data as $v) {
                ?>
                <tr>
                    <td><?php echo $v['id']?></td>
                    <td><?php echo $v['identity']?></td>
                    <td><?php echo $v['contact']?></td>
                    <td><?php echo $v['message']?></td>
                    <td><?php echo date("Y-m-d H:i:s",$v['time'])?></td>
                    <td>
                        <?php echo $v['isSolve']=='0'?'未处理':'已处理'?>
                    </td>
                    <td><a><span onclick="check('<?php echo $v['id']?>','1')">已处理</span></a>
                        <a><span onclick="check('<?php echo $v['id']?>','0')">未处理</span></a>
                    </td>
                </tr>
                <?php
            }
            ?>
            </tbody>
        </table>
    </form>
    <div class="pagination pagination-right">
        <?php use yii\widgets\LinkPager;?>
        <?php echo LinkPager::widget([
            'pagination' => $page,
        ])?>
    </div>
</div>
<script>
    function check(id,flag){
        $.post('/user/message/check',{id:id,flag:flag},function(re){
            alert(re.message);
            window.location.href='/user/message/index';
        },"json")
    }
</script>