<div class="row control-tit wrapper border-bottom white-bg">
    <a href="/content/question/index">返回问题管理</a>
    <span>回答管理</span>
</div>
<div class="wrapper wrapper-content">
    <div>
        <?php if ($data) { ?>
            <table class="table-container">
                <th>回答人</th>
                <th>回答内容</th>
                <th>回答时间</th>
                <th>操作</th>
                <?php foreach ($data as $v) { ?>
                    <tr>
                        <td><?php echo $v['username'] ?></td>
                        <td><?php echo $v['content'] ?></td>
                        <td><?php echo date('Y-m-d H:i:s', $v['createTime']); ?></td>
                        <td class="tm">
                            <a href="/content/question/reply?id=<?php echo $v['id'] ?>">查看回复</a>
                            <a href="/content/question/answer-delete?id=<?php echo $v['id'] ?>">删除</a>
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
