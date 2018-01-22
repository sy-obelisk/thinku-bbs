<div class="wrapper wrapper-content">
    <div><span>模块管理</span>-----------<a href="/basic/modular/add">添加模块</a> </div>
    <div>
        <ul>
            <?php
            foreach($Modular as $v){
                ?>
                <li><?php echo $v['name'] ?> ---------<a href="/basic/modular/update?id=<?php echo $v['id'] ?>">修改</a>------
                    <a href="/basic/modular/delete?id=<?php echo $v['id'] ?>">删除</a> </li>
                <?php
            }
            ?>
        </ul>
    </div>
</div>

