<div class="row control-tit wrapper border-bottom white-bg">
    <span><?php echo $name ?>权限</span>
    <a class="addRole" href="/content/post/add">添加帖子</a>
</div>
<div class="wrapper wrapper-content">
    <div>
        <form action="/basic/role/update-qx" method="post">
            <input type="hidden" name="role" value="<?php echo isset($_GET['id'])?$_GET['id']:'' ?>">
            <?php foreach($data as $v){ ?>
                <input type="checkbox" name="content[]" <?php if(isset($v['checked']) ==1){ ?> checked="checked" <?php  } ?>  value="<?php echo $v['id'] ?>"><?php echo $v['name'] ?>
              <?php
            }
            ?>
            <input type="submit" value="提交">
        </form>
    </div>
</div>

