<div class="span10">
    <div >
        <a href="/index/index">首页</a><span >&gt;</span><span>帖子管理</span>
    </div>

    <a href="<?php echo baseUrl.'/admin/article/add'?>">添加帖子</a>
    <table border="1"  width="100%">

        <tr align="center">
            <th>id</th>
            <th>标题</th>
            <th>内容</th>
            <th>用户</th>
            <th>文件</th>
            <th>置顶</th>
            <th>分类</th>
            <th>话题</th>
            <th>回复数</th>
            <th>操作</th>
        </tr>
        <?php
        foreach($data as $v){?>
            <tr>
                <td><?php echo $v['id']?></td>
                <td><?php echo $v['title']?></td>
                <td><?php echo $v['content']?></td>
                <td><?php echo $v['uid']?></td>
                <td><?php echo $v['file']?></td>
                <td><?php echo $v['isTop']?></td>
                <td><?php echo $v['cate']?></td>
                <td><?php echo $v['topic']?></td>
                <td><?php echo $v['count']?></td>

                <td>
                    <a class="link-update" href="<?php echo baseUrl.'/admin/article/add'.'?'.'id='.$v['id']?>">修改</a>
                    <a class="link-del" href="" onclick="del(<?php echo $v['id'] ?>//)">删除</a>
                </td>
            </tr>
        <?php }?>
    </table>
</div>
<script>
    function del(id){
        if(confirm("确定删除内容吗")) {
            $.get("/admin/article/del", {id: id},
                function (msg) {
                    if (msg) {
                        alert('删除成功');
                    }
                }, 'text'
            );
        }
    }
</script>

