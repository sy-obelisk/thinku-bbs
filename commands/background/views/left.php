
<ul class="nav nav-tabs nav-stacked">
    <?php
    foreach($data as $v) {
        ?>
    <?php
    if(in_array($v['id'],$blockArr)) {
        ?>
        <li class="<?php if ($v['value'] == $controller) echo 'active'?>">
            <a href="<?php echo baseUrl?>/<?php echo $module?>/<?php echo $v['value']?>/index"><?php echo $v['name']?></a>
        </li>
    <?php
    }
        ?>
    <?php
    }
    ?>
</ul>
