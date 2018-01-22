`<script type="text/javascript" src="/ueditor/ueditor.config.js"></script>
<!-- 编辑器源码文件 -->
<script type="text/javascript" src="/ueditor/ueditor.all.min.js"></script>
<!-- 编辑器公式插件 -->
<script type="text/javascript" charset="utf-8" src="/ueditor/kityformula-plugin/addKityFormulaDialog.js"></script>
<script type="text/javascript" charset="utf-8" src="/ueditor/kityformula-plugin/getKfContent.js"></script>
<script type="text/javascript" charset="utf-8" src="/ueditor/kityformula-plugin/defaultFilterFix.js"></script>
<div class="row control-tit wrapper border-bottom white-bg">
    <span>话题图片管理</span>
</div>
<div>
    <form action="/content/topic/update" method="post">
        <input name="id" type="hidden" value="<?php echo isset($data['id']) ? $data['id'] : '' ?>">
        话题：<input type="text" name="title" value="<?php echo isset($data['name']) ? $data['name'] : '' ?>">
        简介：<input type="text" name="synopsis" value="<?php echo isset($data['synopsis']) ? $data['synopsis'] : '' ?>">
        图片：<input type="text" class="imageFile" name="img" value="<?php echo isset($data['image']) ? $data['image'] : '' ?>" placeholder="图片地址">
        <a href="#" class="btn btn-info" onclick="upImage();">上传图片</a>
        <input type="submit" value="提交">
    </form>
</div>
<script type="text/plain" id="j_ueditorupload"></script>
<script>
    //实例化编辑器
    var o_ueditorupload = UE.getEditor('j_ueditorupload',
        {
            autoHeightEnabled:false
        });
    o_ueditorupload.ready(function ()
    {

        o_ueditorupload.hide();//隐藏编辑器

        //监听图片上传
        o_ueditorupload.addListener('beforeInsertImage', function (t,arg)
        {
            $('.imageFile').val(arg[0].src);

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
    function upImage()
    {
        var myImage = o_ueditorupload.getDialog("insertimage");
        myImage.open();
    }
</script>