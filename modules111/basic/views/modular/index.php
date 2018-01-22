
<div class="wrapper wrapper-content">
    <div><span>模块管理</span>-----------<a href="/basic/modular/add">添加模块</a> </div>
    <div>
        <ul>
        <?php
        foreach($Modular as $v){
            ?>
            <li><?php echo $v['name'] ?></li>
            <?php if(isset($v['children'])) {
                foreach($v['children'] as $va) {
                    ?>
                    <li><ul><li><?php echo $va['name'] ?>------<?php echo $va['action'] ?></li></ul></li>
                    <?php
                }
            }
        }
        ?>
        </ul>
    </div>
</div>

