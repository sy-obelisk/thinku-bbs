<script type="text/javascript" src="/ueditor/ueditor.config.js"></script>
<!-- 编辑器源码文件 -->
<script type="text/javascript" src="/ueditor/ueditor.all.min.js"></script>
<!-- 编辑器公式插件 -->
<script type="text/javascript" charset="utf-8" src="/ueditor/kityformula-plugin/addKityFormulaDialog.js"></script>
<script type="text/javascript" charset="utf-8" src="/ueditor/kityformula-plugin/getKfContent.js"></script>
<script type="text/javascript" charset="utf-8" src="/ueditor/kityformula-plugin/defaultFilterFix.js"></script>
<div class="row control-tit wrapper border-bottom white-bg">
    <span>发布公告</span>
</div>
<div>
    <form action="/content/category/notice-add" method="post">
        <p class="pushTit">公告内容：</p>
        <textarea  id="editor" name="content"><?php echo isset($data['value'])?$data['value']:'' ?></textarea>
        <div>
            <input type="hidden" name="noticeId" value="<?php echo isset($data['id'])?$data['id']:'' ?>">
            <input type="hidden" name="id" value="<?php echo isset($_GET['catId'])?$_GET['catId']:'' ?>">
        <input type="submit" value="提交">
        </div>
    </form>
</div>
<script>
    var editor = UE.getEditor('editor',{ initialFrameWidth: null });
</script>
<script>
    //实例化编辑器
    var o_ueditorupload = UE.getEditor('j_ueditorupload',
        {
            autoHeightEnabled: false
        });
    o_ueditorupload.ready(function () {

        o_ueditorupload.hide();//隐藏编辑器

        o_ueditorupload.addListener('afterUpfile', function (t, arg) {
            $('.file').val(arg[0].url);
        });
    });

//    弹出文件上传的对话框
    function upFiles() {
        var myFiles = o_ueditorupload.getDialog("attachment");
        myFiles.open();
    }

</script>
<script type="text/plain" id="j_ueditorupload"></script>