<script type="text/javascript" src="/ueditor/ueditor.config.js"></script>
<!-- 编辑器源码文件 -->
<script type="text/javascript" src="/ueditor/ueditor.all.min.js"></script>
<!-- 编辑器公式插件 -->
<script type="text/javascript" charset="utf-8" src="/ueditor/kityformula-plugin/addKityFormulaDialog.js"></script>
<script type="text/javascript" charset="utf-8" src="/ueditor/kityformula-plugin/getKfContent.js"></script>
<script type="text/javascript" charset="utf-8" src="/ueditor/kityformula-plugin/defaultFilterFix.js"></script>
<script type="text/javascript" src="/My97DatePicker/WdatePicker.js"></script>
<!-- 树形菜单选择 -->
<link rel="stylesheet" type="text/css" href="/easyui/themes/default/easyui.css">
<link rel="stylesheet" type="text/css" href="/easyui/themes/icon.css">
<script type="text/javascript" src="/easyui/jquery.easyui.min.js"></script>

<div class="span10" id="datacontent">
    <ul class="breadcrumb">
        <li><a href="<?php echo baseUrl?>/user/index/index">用户模块</a> <span class="divider">/</span></li>
        <li><a href="<?php echo baseUrl?>/user/user/index">用户管理</a> <span class="divider">/</span></li>
        <li class="active">积分调整</li>
    </ul>
    <form action="<?php echo baseUrl?>/user/user/integral-edit" method="post" class="form-horizontal">
        <fieldset>
            <div class="control-group">
                <label for="modulename" class="control-label">调价值</label>
                <div class="controls">
                    <input type="text" id="input1" name="number" value="" datatype="userName" needle="needle" msg="您必须输入中英文字符的分类名称">
                    <span class="help-block">请输入调整数量</span>
                </div>
            </div>
            <div class="control-group">
                <label for="modulename" class="control-label">类型</label>
                <div class="controls">
                    <select name="type">
                        <option value="1">
                            +
                        </option>
                        <option value="2">
                            -
                        </option>
                    </select>
                </div>
            </div>
            <div class="control-group">
                <div class="controls submitRow">
                    <input name="userName" type="hidden" value="<?php echo isset($userName) ? $userName : '' ?>">
                    <input name="url" type="hidden" value="<?php echo isset($url) ? $url : '' ?>">
                    <input type="submit" class="btn btn-primary" value="提交">
                </div>
            </div>
        </fieldset>
    </form>
</div>

