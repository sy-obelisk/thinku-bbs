<script type="text/javascript" src="/My97DatePicker/WdatePicker.js"></script>

<div class="span10" id="datacontent">
    <ul class="breadcrumb">
        <li><a href="/user/index/index">用户模块</a> <span class="divider">/</span></li>
        <li class="active">用户管理</li>
    </ul>
    <ul class="nav nav-tabs">
        <li class="active">
            <a href="javascript:;" onclick="javascript:openall();">积分详情</a>
        </li>
    </ul>
    <legend>用户</legend>
    <form action="/user/discuss/publish" id="checkPush" method="post">
        <table class="table table-hover">
            <thead>
            <tr>
                <th width="80">ID</th>
                <th>用户id</th>
                <th>积分行为</th>
                <th>积分结果</th>
                <th>行为时间</th>
            </tr>
            </thead>
            <tbody>
            <?php
            foreach($integral['details'] as $v) {
                ?>
                <tr>
                    <td><?php echo $v['id']?></td>
                    <td><?php echo $id?></td>
<!--                    <td><img height="30" width="30" src="--><?php //echo $v['image']?><!--"/></td>-->
                    <td><?php echo $v['behavior']?></td>
                    <td><?php echo ($v['type'] == 1?'+':'-').$v['integral']?></td>
                    <td><?php echo date("Y-m-d H:i:s",$v['createTime'])?></td>
                </tr>
            <?php
            }
            ?>
            </tbody>
        </table>
    </form>
    <div class="pagination pagination-right">
    </div>
</div>
<