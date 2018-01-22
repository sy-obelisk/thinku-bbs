<div class="row control-tit wrapper border-bottom white-bg">
    <span><a href="/content/post/index">帖子管理</a></span>
    <a class="addRole" href="/content/post/reply-add?id=<?php echo $_GET['id'] ?>">添加回复</a>
</div>
<div class="wrapper wrapper-content">
    <div>
        <table class="table-container" style="width: 100%">
            <th>ID</th>
            <th>回复内容</th>
            <th>回复时间</th>
            <th>回复人</th>
            <th>操作</th>
            <?php foreach($data as $v){ ?>
                <tr>
                    <td><?php echo $v['id'] ?></td>
                    <td><?php echo $v['content'] ?></td>
                    <td><?php echo date('Y-m-d H:i:s', $v['createTime']) ?></td>
                    <td><?php echo isset($v['nickname'])?$v['nickname']:$v['username'] ?></td>
                    <td><a href="/content/post/reply-delete?id=<?php echo $v['id'] ?>">删除</a> </td>
                </tr>
                <?php
            }
            ?>
        </table>
        <div>
        </div>
    </div>
</div>
