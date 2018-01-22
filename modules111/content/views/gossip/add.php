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
        <span>添加备考八卦</span>
        <a class="addRole" href="/content/gossip/index">备考八卦管理</a>
    </div>
    <div>
        <form action="/content/gossip/add" method="post">
            标题：<input type="text" name="title" value="">
            内容：<input type="text" name="content" value="">
            图片：<input class="imageFile" type="text" name="img" value="">---<span href="#" class="btn btn-info" onclick="upImage();">上传图片</span>
            浏览次数：<input type="text" name="viewCount" value="0">
            类别：<select name="type" id="">
                <option value="1">GMAT</option>
                <option value="2">托福</option>
                <option value="3">留学</option>
                <option value="4">雅思</option>
            </select>
            <input type="submit" value="提交">
        </form>
    </div>

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
            var img='';
            for (var i = 0; i < arg.length; i++) {
                img += arg[i].src+',';
            };
            $('.imageFile').val(img);

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
    //弹出文件上传的对话框
    //    function upFiles()
    //    {
    //        var myFiles = o_ueditorupload.getDialog("attachment");
    //        myFiles.open();
    //    }

</script>
<script type="text/plain" id="j_ueditorupload"></script>
