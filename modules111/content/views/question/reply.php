<div class="row control-tit wrapper border-bottom white-bg">
    <span>回复管理</span>
</div>
<div class="wrapper wrapper-content">
    <div>
        <?php if ($data) { ?>
            <table class="table-container">
                <th>回复人</th>
                <th>回复内容</th>
                <th>回复时间</th>
                <th>操作</th>
                <?php foreach ($data as $v) { ?>
                    <tr>
                        <td><?php echo $v['username'] ?></td>
                        <td><?php echo $v['content'] ?></td>
                        <td><?php echo date('Y-m-d H:i:s', $v['createTime']); ?></td>
                        <td class="tm">
                            <a href="/content/question/reply-delete?id=<?php echo $v['id'] ?>">删除</a>
                        </td>
                    </tr>
                    <?php
                }
                ?>
            </table>
            <?php
        } else { ?>
            <table class="table-container">
                <th>并没有什么回答</th>
            </table>
            <?php
        }
        ?>
    </div>
</div>
