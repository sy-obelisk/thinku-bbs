
<!-- 树形菜单选择 -->
<link rel="stylesheet" type="text/css" href="/easyui/themes/default/easyui.css">
<link rel="stylesheet" type="text/css" href="/easyui/themes/icon.css">
<script type="text/javascript" src="/easyui/jquery.easyui.min.js"></script>

<div class="span10" id="datacontent">
    <ul class="breadcrumb">
        <li><a href="<?php echo baseUrl?>/content/index/index">内容模块</a> <span class="divider">/</span></li>
        <li><a href="<?php echo baseUrl?>/content/content/index">内容管理</a> <span class="divider">/</span></li>
        <li class="active">修改主分类</li>
    </ul>
    <ul class="nav nav-tabs">

    </ul>
    <form action="<?php echo baseUrl?>/content/content/change-category" method="post" class="form-horizontal">
        <fieldset>
            <div class="control-group">
                <label for="modulename" class="control-label">内容分类</label>

                <div class="controls">
                    <select style="width: 400px" id="contentcatid" msg="您必须选择一个分类" url='<?php echo baseUrl?>/content/api/tree?pid=1&major=1' class="main easyui-combotree">
                    </select>
                </div>
            </div>
            <input name="id" type="hidden" value="<?php echo $contentId?>">
            <input name="url" type="hidden" value="<?php echo $url?>">
            <input name="catId" type="hidden" value="">
            <input type="submit" class="btn btn-primary" value="提交">
        </fieldset>
    </form>
</div>

<script type="text/javascript">

    $('.main').combotree({
        onClick: function (node) {
            $("input[name='catId']").val(node.id);
        }
    })
</script>
