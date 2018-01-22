<div class="row control-tit wrapper border-bottom white-bg">
    <span>配置管理</span>
    <a class="addRole" href="/basic/config/add">添加配置</a>
</div>
<table class="tb1 col-lg-10">
    <thead>
    <tr>
        <th>序号</th>
        <th>配置名</th>
        <th>value值</th>
        <th>操作</th>
    </tr>
    </thead>
    <tbody>
    <?php if(isset($data)){
        foreach($data as $v){ ?>
            <tr>
                <td><?php echo $v['id']?></td>
                <td><?php echo $v['key']?></td>
                <td><?php echo $v['value']?></td>
                <td class="handle">
                    <a href="/basic/config/update?id=<?php echo $v['id']?>" class="alter">修改</a>
                </td>
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
