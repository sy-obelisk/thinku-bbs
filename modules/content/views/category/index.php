<link rel="stylesheet" type="text/css" href="/easyui/themes/default/easyui.css">
<link rel="stylesheet" type="text/css" href="/easyui/themes/icon.css">

<script type="text/javascript" src="/easyui/jquery.easyui.min.js"></script>
<div class="span10" id="datacontent">

    <ul class="breadcrumb">
        <li><a href="<?php echo baseUrl?>/content/index">内容管理</a> <span class="divider">/</span></li>
        <li class="active">分类管理</li>
    </ul>
    <ul class="nav nav-tabs">
        <?php
        $userId = \Yii::$app->session->get('adminId');
        $block = \Yii::$app->db->createCommand("select b.* from {{%user_block}} ub LEFT JOIN {{%block}} b ON ub.blockId = b.id WHERE ub.userId = $userId AND b.pid=8")->queryAll();
        ?>
        <?php
        foreach($block as $v) {
        ?>
        <?php
        if($v['value'] == 'add') {
        ?>
        <li class="dropdown pull-right">
            <a href="<?php echo baseUrl?>/content/category/add">添加分类</a>
        </li>
        <?php
        }
            ?>
        <?php
        }
        ?>
    </ul>
    <table width="100%" class="table table-hover easyui-treegrid" title="分类表"  data-options="
				url: '<?php echo baseUrl?>/content/api/category',
				method: 'get',
				idField: 'id',
				treeField: 'name'
			">
        <thead>
        <tr>
            <th data-options="field:'id'"  align="middle" >ID</th>
            <th data-options="field:'name'"  align="left" >分类名称</th>
            <th data-options="field:'image'" align="middle">缩略图</th>
            <th data-options="field:'createTime'" align="middle">创建时间</th>
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
<script type="text/javascript">

    function checkDelete(id){
        $.post('/content/api/check-delete',{id:id},function(re){
            if(re.code == 1){
                if(confirm("确定删除分类吗")){
                    location.href = "/content/category/delete?id="+id;
                }
            }else{
                alert("请先删除子类,属性与其内容");
            }
        },"json")
    }
</script>
