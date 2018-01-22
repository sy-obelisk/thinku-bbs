<div class="row control-tit wrapper border-bottom white-bg">
    <span>社团公告</span>
    <a class="addRole" href="/content/category/notice-add?catId=<?php echo $_GET['id'] ?>">添加公告</a>
</div>
<div class="wrapper wrapper-content">
    <div>
        <table class="table-container">
            <th>发表人UID</th>
            <th class="w150">公告</th>
            <th>发表时间</th>
            <th class="tc-handle">操作</th>
            <?php foreach ($data as $v) { ?>
                <tr>
                    <td class="tm"><?php echo $v['uid'] ?></td>
                    <td class="tm"><?php echo $v['value'] ?></td>
                    <td class="tm"><?php echo date('Y-m-d H:i:s',$v['createTime']) ?></td>
                    <td class="tm">
                        <a href="/content/category/notice-add?noticeId=<?php echo $v['id'] ?>">修改</a>---<a href="/content/category/notice-delete?noticeId=<?php echo $v['id'] ?>">删除</a>
                    </td>
                </tr>
                <?php
            }
            ?>
        </table>
    </div>
</div>