
<div class="row control-tit wrapper border-bottom white-bg">
    <span>角色管理</span>
    <a class="addRole" href="/basic/role/add">添加角色</a>
</div>
<table class="tb1 col-lg-10">
    <thead>
    <tr>
        <th>序号</th>
        <th>角色管理</th>
        <th>操作</th>
        <th>权限</th>
    </tr>
    </thead>
    <tbody>
    <?php if(isset($role)){
    foreach($role as $v){ ?>
    <tr>
        <td><?php echo $v['id']?></td>
        <td><?php echo $v['name']?></td>
        <td class="handle">
            <a href="/basic/role/update?id=<?php echo $v['id']?>" class="alter">修改</a><a href="/basic/role/delete?id=<?php echo $v['id']?>">删除</a>
        </td>
        <td><a href="/basic/role/limit?id=<?php echo $v['id']?>">角色权限</a></td>
    </tr>
        <?php
    }
    } else { ?>
        <li><a href="/basic/role/add">添加角色</a></li>
        <?php
    }
    ?>

    </tbody>
</table>


