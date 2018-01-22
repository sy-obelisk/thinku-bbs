<link rel="stylesheet" type="text/css" href="/easyui/themes/default/easyui.css">
<link rel="stylesheet" type="text/css" href="/easyui/themes/icon.css">
<script type="text/javascript" src="/easyui/jquery.easyui.min.js"></script>
<div class="span10" id="datacontent">
    <ul class="breadcrumb">
        <li><a href="<?php echo baseUrl?>/content/content/index">内容管理</a> <span class="divider">/</span></li>
        <li class="active">内容属性管理</li>
    </ul>
    <ul class="nav nav-tabs">
        <?php
        $userId = Yii::$app->session->get('adminId');
        $block = Yii::$app->db->createCommand("select b.* from {{%user_block}} ub LEFT JOIN {{%block}} b ON ub.blockId = b.id WHERE ub.userId = $userId AND b.pid=42")->queryAll();
        ?>
        <?php
        foreach($block as $v) {
        if ($v['value'] == 'add') {
        ?>
        <li class="dropdown pull-right">

            <a href="<?php echo baseUrl?>/content/extend/add?id=<?php echo $id?>&type=content&back=2">添加内容属性</a>

        </li>
        <?php
            }
        }
        ?>
    </ul>
    <legend>内容属性</legend>
    <table class="table table-hover">
        <thead>
        <tr>
            <th width="80">ID</th>
            <!--<th width="80">缩略图</th>-->
            <th >属性名称</th>
            <th >属性标题</th>
            <th>内容id</th>
            <th>内容名称</th>
            <th>能否被删除</th>
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
                <td><span><?php echo $v['name']?></span></td>
                <td><span><?php echo $v['title']?></span></td>
                <td><span><?php echo $v['contentId']?></span></td>
                <td><span><?php echo $v['contName']?></span></td>
                <td><span><?php echo $v['canDelete']?'不能删除':'能删除'?></span></td>
                <td>
                    <div>
                        <?php
                        foreach($block as $val) {
                        ?>
                        <?php
                        if($val['value'] == 'update') {
                        ?>
                        <a class="btn"
                           href="<?php echo baseUrl?>/content/extend/update?id=<?php echo $v['id']?>&type=content">修改</a>
                        <?php
                        }
                        ?>
                        <?php
                        if($val['value'] == 'delete') {
                        ?>
                        <?php if($v['canDelete'] == 0) { ?>
                        <a class="btn ajax"
                           href="<?php echo baseUrl?>/content/extend/delete?id=<?php echo $v['id']?>&type=content"><em
                                class="icon-remove"></em></a>
                        <?php } ?>
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
    <div class="pagination pagination-right">
        <ul></ul>
    </div>
</div>