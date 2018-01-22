
<div class="span10" id="datacontent">
    <ul class="breadcrumb">
        <li><a href="<?php echo baseUrl?>/basic/index/index">全局管理</a> <span class="divider">/</span></li>
        <li><a href="<?php echo baseUrl?>/basic/config/index">配置管理</a> <span class="divider">/</span></li>
        <li class="active">添加配置</li>
    </ul>
    <form action="<?php echo baseUrl?>/basic/config/add" method="post" class="form-horizontal">
        <fieldset>
            <div class="control-group">
                <label for="modulename" class="control-label">配置键名</label>
                <div class="controls">
                    <input type="text" id="input1" name="params[key]" value="<?php echo isset($data['key'])?$data['key']:''?>" datatype="userName" needle="needle" msg="您必须输入中英文字符的分类名称">
                    <span class="help-block">请输入配置键名</span>
                </div>
            </div>
            <div class="control-group">
                <label for="modulename" class="control-label">配置值</label>
                <div class="controls">
                    <input type="text"  name="params[value]" value="<?php echo isset($data['value'])?$data['value']:''?>" datatype="userName" needle="needle" msg="您必须输入中英文字符的分类名称">
                    <span class="help-block">请输入配置值</span>
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
