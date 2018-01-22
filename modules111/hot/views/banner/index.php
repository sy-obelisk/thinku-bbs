<div class="row control-tit wrapper border-bottom white-bg">
    <span>首页Banner图管理</span>
    <a class="addRole" href="/hot/banner/banner-add">添加banner图</a>
</div>
<div class="over-auto">
        <?php if($data){ ?>
        <table class="table-container">
            <th>ID</th>
            <th class="w150">标题</th>
            <th class="w350">图片</th>
            <th class="w250">链接地址</th>
            <th class="w250">创建人</th>
            <th class="tc-handle">操作</th>
            <?php
            foreach($data as $v) { ?>
            <tr>
                <td class="tm"><?php echo $v['id'] ?></td>
                <td class="tm"><?php echo $v['title'] ?></td>
                <td class="ellipsis"><img src="<?php echo $v['image'] ?>" alt=""></td>
                <td><a href="<?php echo $v['url'] ?>"><?php echo $v['url'] ?></a></td>
                <td class="ellipsis"><?php echo $v['username'] ?></td>
                <td class="tm"><a href="/hot/banner/update-banner?id=<?php echo $v['id'] ?>">修改</a>-------<a href="/hot/banner/delete?id=<?php echo $v['id'] ?>">删除</a></td>
                <?php
                }
                } else { ?>
                    <div>还没有banner图</div>
                    <?php
                }
                ?>
    </div>