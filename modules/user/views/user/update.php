<script type="text/javascript" src="/ueditor/ueditor.config.js"></script>
<!-- 编辑器源码文件 -->
<script type="text/javascript" src="/ueditor/ueditor.all.min.js"></script>
<!-- 编辑器公式插件 -->
<script type="text/javascript" charset="utf-8" src="/ueditor/kityformula-plugin/addKityFormulaDialog.js"></script>
<script type="text/javascript" charset="utf-8" src="/ueditor/kityformula-plugin/getKfContent.js"></script>
<script type="text/javascript" charset="utf-8" src="/ueditor/kityformula-plugin/defaultFilterFix.js"></script>
<div class="span10" id="datacontent">

    <ul class="breadcrumb">
        <li><a href="/user/index/index"></a> 用户模块<span class="divider">/</span></li>
        <li><a href="/user/discuss/index">用户管理</a> <span class="divider">/</span></li>
        <li class="active">修改用户</li>
    </ul>
    <form action="/user/user/update" method="post" class="form-horizontal">
        <fieldset>
            <div class="control-group">
                <label for="area" class="control-label">备注：</label>
                <div class="controls">
                    <textarea name="remark"><?php echo $data->remark?></textarea>
                </div>
            </div>
            <div class="control-group">
                <label for="area" class="control-label">头像：</label>
                <div class="controls">
                    <input type="text" value="<?php echo $data->image?>" class="image" name="user[image]">
                    <a href="#" class="btn btn-info" onclick="upImage()">上传文件</a>
                </div>
            </div>
            <div class="control-group">
                <label for="area" class="control-label">昵称：</label>
                <div class="controls">
                    <input type="text" value="<?php echo $data->nickname?>" name="user[nickname]">
                </div>
            </div>
            <div class="control-group">
                <label for="area" class="control-label">电话：</label>
                <div class="controls">
                    <input value="<?php echo $data->phone?>" type="text" name="user[phone]">
                </div>
            </div>
            <div class="control-group">
                <label for="area" class="control-label">邮箱：</label>
                <div class="controls">
                    <input value="<?php echo $data->email?>" type="text" name="user[email]">
                </div>
            </div>
            <div class="control-group">
                <label for="area" class="control-label">密码：</label>
                <div class="controls">
                    <input value="<?php echo $data->userPass?>" type="text" name="userPass">
                </div>
            </div>
            <div class="control-group">
                <div class="controls">
                    <button class="btn btn-primary" type="submit">提交</button>
                    <input type="hidden" name="id" value="<?php echo $id?>"/>
                </div>
            </div>
        </fieldset>
    </form>
</div>
<script>
    //实例化编辑器
    var o_ueditorupload = UE.getEditor('sss',
        {
            autoHeightEnabled:false
        });
    o_ueditorupload.ready(function ()
    {

        o_ueditorupload.hide();//隐藏编辑器

        //监听图片上传
        o_ueditorupload.addListener('beforeInsertImage', function (t,arg)
        {
            $('.image').val(arg[0].src);

        });

        /* 文件上传监听
         * 需要在ueditor.all.min.js文件中找到
         * d.execCommand("insertHtml",l)
         * 之后插入d.fireEvent('afterUpfile',b)
         */
        o_ueditorupload.addListener('afterUpfile', function (t, arg)
        {

        });
    });

    //弹出图片上传的对话框
    function upImage()
    {
        var myImage = o_ueditorupload.getDialog("insertimage");
        myImage.open();
    }

</script>
<script type="text/plain" id="sss"></script>