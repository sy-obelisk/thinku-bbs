<style>
    .control-tit {
        margin-top: 10px;
        padding: 15px 20px;
    }
    .addRole{
        padding-left: 50px;
        text-align: right;

    }
</style>
<script type="text/javascript" src="/ueditor/ueditor.config.js"></script>
<!-- 编辑器源码文件 -->
<script type="text/javascript" src="/ueditor/ueditor.all.min.js"></script>
<!-- 编辑器公式插件 -->
<script type="text/javascript" charset="utf-8" src="/ueditor/kityformula-plugin/addKityFormulaDialog.js"></script>
<script type="text/javascript" charset="utf-8" src="/ueditor/kityformula-plugin/getKfContent.js"></script>
<script type="text/javascript" charset="utf-8" src="/ueditor/kityformula-plugin/defaultFilterFix.js"></script>
<div class="row control-tit wrapper border-bottom white-bg">
    <span>帖子管理</span>
    <a class="addRole" href="/content/gossip/index">修改帖子</a>
</div>
<div>
    <form action="/content/post/update" method="post">
        标题：<br/><input type="text" name="title" value="<?php echo isset($data['title'])?$data['title']:'' ?>"><br/>
        内容：<br/>
        <textarea  id="editor" name="content"><?php echo isset($data['content'])?$data['content']:'' ?></textarea>
        <input type="hidden" name="contentId" value="<?php echo isset($data['id'])?$data['id']:'' ?>">
        <script>
            var editor = UE.getEditor('editor',{ initialFrameWidth: null });
        </script>
        <br/>
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

            弹出文件上传的对话框
            function upFiles() {
                var myFiles = o_ueditorupload.getDialog("attachment");
                myFiles.open();
            }

        </script>
        <script type="text/plain" id="j_ueditorupload"></script>
        <input type="submit" value="提交">
    </form>
</div>

