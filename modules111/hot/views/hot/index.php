<div class="row control-tit wrapper border-bottom white-bg">
    <span>热门模块管理</span>
    <a class="addRole" href="/hot/hot/add-hot">添加热门模块</a>
</div>
    <div class="over-auto">
        <?php if($data){ ?>
            <table class="table-container">
                <th>ID</th>
                <th class="w150">名称</th>
                <th class="w350">图片</th>
                <th class="w250">链接地址</th>
                <th class="w250">创建人</th>
                <th class="tc-handle">操作</th>
            <?php
            foreach($data as $v) { ?>
                <tr>
                    <td class="tm"><?php echo $v['id'] ?></td>
                    <td class="tm"><?php echo $v['name'] ?></td>
                    <td class="ellipsis"><img src="<?php echo $v['image'] ?>" alt=""></td>
                    <td><a href="<?php echo $v['url'] ?>"><?php echo $v['url'] ?></a></td>
                    <td class="ellipsis"><?php echo $v['username'] ?></td>
                    <td class="tm"><a href="/hot/hot/update-hot?id=<?php echo $v['id'] ?>">修改</a>-------<a href="/hot/hot/delete?id=<?php echo $v['id'] ?>">删除</a></td>
                <?php
            }
        } else { ?>
                    <div>还没有模块</div>
                    <?php
                }
                ?>
    </div>


