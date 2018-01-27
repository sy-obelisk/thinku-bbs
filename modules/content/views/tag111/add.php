<script type="text/javascript" src="/ueditor/ueditor.config.js"></script>
<!-- 编辑器源码文件 -->
<script type="text/javascript" src="/ueditor/ueditor.all.min.js"></script>
<!-- 编辑器公式插件 -->
<script type="text/javascript" charset="utf-8" src="/ueditor/kityformula-plugin/addKityFormulaDialog.js"></script>
<script type="text/javascript" charset="utf-8" src="/ueditor/kityformula-plugin/getKfContent.js"></script>
<script type="text/javascript" charset="utf-8" src="/ueditor/kityformula-plugin/defaultFilterFix.js"></script>

<!-- 树形菜单选择 -->
<link rel="stylesheet" type="text/css" href="/easyui/themes/default/easyui.css">
<link rel="stylesheet" type="text/css" href="/easyui/themes/icon.css">


<script type="text/javascript" src="/easyui/jquery.easyui.min.js"></script>
<div class="span10" id="datacontent">
    <ul class="breadcrumb">
        <li><a href="<?php echo baseUrl?>/content/index/index">内容模块</a> <span class="divider">/</span></li>
        <li class="active">标签组</li>
    </ul>
    <form action="<?php echo baseUrl?>/content/tag/add" method="post" class="form-horizontal">
        <fieldset>
            <div class="control-group">
                <label for="modulename" class="control-label">选择标签</label>

                <div class="controls">
                    <select style="width: 400px" id="contentcatid" msg="您必须选择一个分类" url='<?php echo baseUrl?>/content/api/tag'  class="main easyui-combotree">
                    </select>
                </div>
            </div>
            <div class="control-group">
                <div class="controls">
                    <input name="catId" type="hidden" value="<?php echo isset($catId)?$catId:''?>">
                    <input name="tag" type="hidden" value="">
                    <input name="type" type="hidden" value="<?php echo $type?>">
                    <input type="submit"  class="btn btn-primary" value="提交">
                </div>
            </div>
        </fieldset>
    </form>
</div>
<script>
    $('.main').combotree({
        onClick: function (node) {
            $("input[name='tag']").val(node.id);
        }
    })
</script>
