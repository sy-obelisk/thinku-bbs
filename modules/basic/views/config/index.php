
<div class="span10" id="datacontent">
    <ul class="breadcrumb">
        <li><a href="/basic/index/index">全局</a> <span class="divider">/</span></li>
        <li class="active">配置管理</li>
    </ul>
    <ul class="nav nav-tabs">
        <li class="active">
            <a href="javascript:;" onclick="javascript:openall();">配置管理</a>
        </li>
        <?php
            foreach($block as $v){
            ?>
                <?php
                if($v['value'] == 'add') {
                    ?>
                    <li class="dropdown pull-right">
                        <a class="dropdown-toggle" href="<?php echo baseUrl ?>/basic/config/add">添加配置<strong
                                class="caret"></strong></a>
                    </li>
                <?php
                }
                    ?>
        <?php
        }
        ?>
    </ul>
    <legend>所有内容</legend>
    <table class="table table-hover">
        <thead>
        <tr>
            <th width="80">ID</th>
            <!--<th width="80">缩略图</th>-->
            <th>配置键名</th>
            <th>配置值</th>
            <th>发布者Id</th>
            <th>发布时间</th>
            <th >操作</th>
        </tr>
        </thead>
        <tbody>
        <?php
        foreach($data as $v) {
            ?>
            <tr>
                <td><?php echo $v['id']?></td>
                <!--<td><img src="{x2;if:v:extend['thumb']}{x2;v:extend['thumb']}{x2;else}app/core/styles/images/noupload.gif{x2;endif}" alt="" style="width:24px;"/></td>-->
                <td><span><?php echo $v['key']?></span></td>
                <td><span><?php echo $v['value']?></span></td>
                <td><span><?php echo $v['userId']?></span></td>
                <td><span><?php echo $v['createTime']?></span></td>
                <td>
                    <div>
                        <?php
                        foreach($block as $val){
                            ?>
                            <?php
                            if($val['value'] != 'add') {
                                ?>
                                <a class="btn"
                                   href="<?php echo baseUrl?>/basic/config/<?php echo $val['value']?>?id=<?php echo $v['id']?>"><?php echo $val['name']?></a>
                            <?php
                            }
                            ?>
                        <?php
                        }
                        ?>
                    </div>
                </td>
            </tr>
        <?php
        }
        ?>
        </tbody>
    </table>
</div>
