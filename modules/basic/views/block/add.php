
<!-- 树形菜单选择 -->
<link rel="stylesheet" type="text/css" href="/easyui/themes/default/easyui.css">
<link rel="stylesheet" type="text/css" href="/easyui/themes/icon.css">
<script type="text/javascript" src="/easyui/jquery.easyui.min.js"></script>

<div class="span10" id="datacontent">
    <ul class="breadcrumb">
        <li><a href="<?php echo baseUrl?>/basic/index/index">全局管理</a> <span class="divider">/</span></li>
        <li><a href="<?php echo baseUrl?>/basic/block/index">资源管理</a> <span class="divider">/</span></li>
        <li class="active">添加资源</li>
    </ul>
    <ul class="nav nav-tabs">
        <li class="active">
            <a href="#">添加资源</a>
        </li>
    </ul>
    <form action="<?php echo baseUrl?>/basic/block/add" method="post" class="form-horizontal">
        <fieldset>
            <div class="control-group">
                <label for="modulename" class="control-label">资源名称</label>
                <div class="controls">
                    <input type="text" id="input1" name="block[name]" value="<?php echo isset($data['name'])?$data['name']:''?>" datatype="userName" needle="needle" msg="您必须输入中英文字符的分类名称">
                    <span class="help-block">请输入模块名称</span>
                </div>
            </div>
            <div class="control-group">
                <label for="modulename" class="control-label">父级资源</label>
                <div class="controls">
                    <select style="width: 400px" id="contentcatid" msg="您必须选择一个分类" url='<?php echo baseUrl?>/basic/api/tree?pid=0' class="autocombox input-medium easyui-combotree">
                    </select>
                </div>
                    <input type="hidden" name="block[pid]" value="<?php echo isset($data['pid'])?$data['pid']:''?>" >
            </div>
            <div class="control-group">
                <label for="modulename" class="control-label">资源值</label>
                <div class="controls">
                    <input type="text" <?php echo isset($id) ? $id : '' ?>id="input1" name="block[value]" value="<?php echo isset($data['value'])?$data['value']:''?>" datatype="userName" needle="needle" msg="您必须输入中英文字符的分类名称">
                    <span class="help-block">请输入模块值</span>
                </div>
            </div>
            <div class="control-group">
                <label for="modulename" class="control-label">状态</label>
                <div class="controls" id="checkbox_digui">
                    <input type="radio" <?php echo isset($data['status']) && $data['status'] ==1?"checked":""?> name="block[status]" value="1"/> 显示&nbsp;&nbsp;&nbsp;
                    <input type="radio" <?php echo isset($data['status']) && $data['status']==2?"checked":""?> name="block[status]" value="2"/> 隐藏
                </div>
            </div>
            <div class="control-group">
                <div class="controls">
                    <input name="id" type="hidden" value="<?php echo isset($id) ? $id : '' ?>">
                    <input type="submit" class="btn btn-primary" value="提交">
                </div>
            </div>
        </fieldset>
    </form>
</div>
<?php
if(isset($id)){
?>
<script>
    function expandTo() {
        var node = $('.easyui-combotree').tree('find', <?php echo isset($data['pid'])?$data['pid']:''?>);
        $('.textbox-value').val(node.id);
    }
    $('.easyui-combotree').tree({
        onLoadSuccess: function (newValue, oldValue) {
            expandTo();
        }
    })
</script>
<?php
}
?>
<script>
    $('.easyui-combotree').combotree({
        onClick: function (node) {
            $("input[name='block[pid]']").val(node.id);
        }
    })
</script>
