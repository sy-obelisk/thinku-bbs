
<div class="row control-tit wrapper border-bottom white-bg">
    <span>分类管理</span>
    <a class="addRole" href="/content/category/add">添加分类</a>
</div>
<table width="100%" class="table table-hover easyui-treegrid" title="分类表"  data-options="
				url: '/content/api/cat',
				method: 'get',
				idField: 'id',
				lines: 'true',
				treeField: 'name'
			">
    <thead>
    <tr>
        <th data-options="field:'id'"  align="center" >ID</th>
        <th data-options="field:'name'"  align="left" >分类名称</th>
        <th data-options="field:'image'" align="center">缩略图</th>
        <th data-options="field:'createTime'" align="center">创建时间</th>
        <th data-options="field:'action'"  align="center">操作</th>
    </tr>
    </thead>
    <tbody>

    </tbody>
</table>
