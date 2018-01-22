<link rel="stylesheet" type="text/css" href="/easyui/themes/default/easyui.css">
<link rel="stylesheet" type="text/css" href="/easyui/themes/icon.css">

<script type="text/javascript" src="/easyui/jquery.easyui.min.js"></script>
<div class="span10" id="datacontent">

    <ul class="breadcrumb">
        <li><a href="<?php echo baseUrl?>/basic/index">全局</a> <span class="divider">/</span></li>
        <li class="active">模块管理</li>
    </ul>
    <ul class="nav nav-tabs">
        <li class="active">
            <a href="javascript:;" >模块管理</a>
        </li>
        <?php
        $userId = \Yii::$app->session->get('adminId');
        $block = \Yii::$app->db->createCommand("select b.* from {{%user_block}} ub LEFT JOIN {{%block}} b ON ub.blockId = b.id WHERE ub.userId = $userId AND b.pid=6")->queryAll();
        ?>
        <?php
        foreach($block as $v) {
            ?>
            <?php
            if($v['value'] == 'add') {
                ?>
                <li class="dropdown pull-right">
                    <a href="<?php echo baseUrl?>/basic/block/add">添加资源</a>
                </li>
            <?php
            }
                ?>
        <?php
        }
        ?>
    </ul>
    <legend></legend>
    <table width="300px" class="table table-hover easyui-treegrid" title="资源表"  data-options="
				url: '<?php echo baseUrl?>/basic/api/block?pid=1&status=2',
				method: 'get',
				rownumbers: true,
				idField: 'id',
				treeField: 'name'
			">
        <thead>
        <tr>
            <th data-options="field:'name'"  align="middle" >资源名称</th>
            <th data-options="field:'status'"  align="middle" >资源状态</th>
            <th data-options="field:'action'"  align="middle">操作</th>
        </tr>
        </thead>
        <tbody>

        </tbody>
    </table>
    <div class="pagination pagination-right">
        <ul></ul>
    </div>
</div>
