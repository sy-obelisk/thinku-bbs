<!-- 树形菜单选择 -->
<link rel="stylesheet" type="text/css" href="/easyui/themes/default/easyui.css">
<link rel="stylesheet" type="text/css" href="/easyui/themes/icon.css">
<script type="text/javascript" src="/easyui/jquery.easyui.min.js"></script>

<div class="span10" id="datacontent">
    <form action="/user/user/add-block" method="post">
    <div class="control-group">
        <label for="modulename" class="control-label">资源</label>
        <div class="controls">
            <select style="width: 400px" id="contentcatid" msg="您必须选择一个分类" data-options="url:'<?php echo baseUrl?>/basic/api/tree?pid=1&id=<?php echo $block?>',method:'get',cascadeCheck:false" multiple class="vice easyui-combotree">
            </select><br/><br/>
        </div>
        <input type="hidden" name="block" value="">
        <div class="control-group">
            <div class="controls">
                <input name="id" type="hidden" value="<?php echo isset($id)?$id:''?>">
                <input type="submit"  class="btn btn-primary" value="提交">
            </div>
        </div>
    </div>
    </form>
</div>
<script>
    $('.vice').combotree({
        onCheck:function(newValue,oldValue){
            var nodes = $('.easyui-combotree').combotree('getValues');
            $("input[name='block']").val(nodes);
        }
    });
</script>