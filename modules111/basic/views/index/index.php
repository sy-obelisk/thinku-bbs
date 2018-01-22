<div class="row control-tit wrapper border-bottom white-bg">
    <span>模块管理</span>
    <a class="addRole" href="/basic/modular/add">添加模块</a>
</div>
<table width="100%" class="table table-hover easyui-treegrid" title="模块管理"  data-options="
				url: '/basic/api/block',
				method: 'get',
				idField: 'id',
				lines: 'true',
				treeField: 'name'
			">
    <thead>
    <tr>
        <th data-options="field:'id'"  align="center" >ID</th>
        <th data-options="field:'name'"  align="left" >模块名称</th>
        <th data-options="field:'action'"  align="center">操作</th>
    </tr>
    </thead>
    <tbody>

    </tbody>
</table>



