`<script type="text/javascript" src="/ueditor/ueditor.config.js"></script>
<!-- 编辑器源码文件 -->
<script type="text/javascript" src="/ueditor/ueditor.all.min.js"></script>
<!-- 编辑器公式插件 -->
<script type="text/javascript" charset="utf-8" src="/ueditor/kityformula-plugin/addKityFormulaDialog.js"></script>
<script type="text/javascript" charset="utf-8" src="/ueditor/kityformula-plugin/getKfContent.js"></script>
<script type="text/javascript" charset="utf-8" src="/ueditor/kityformula-plugin/defaultFilterFix.js"></script>
<script type="text/javascript" src="/My97DatePicker/WdatePicker.js"></script>
<div class="row control-tit wrapper border-bottom white-bg">
    <a class="addRole" href="/hot/banner/index">直播管理</a>
    <span>编辑直播</span>
    <form action="/content/live-broadcast/add" method="post">
        <input name="liveId" type="hidden" value="<?php echo isset($data['id']) ? $data['id'] : '' ?>">
        <br/><br/>
        直播标题：<input type="text" name="title" value="<?php echo isset($data['title']) ? $data['title'] : '' ?>">
        <br/><br/>
        开播时间：<input type="text" class="input-small Wdate" onclick="WdatePicker({dateFmt:'yyyy-MM-dd HH:mm:ss'})" size="15" name="startTime" value="<?php echo isset($data['startTime']) ? date('Y-m-d H:i:s',$data['startTime']) : '' ?>"><br/><br/>
        结束时间：<input type="text" class="input-small Wdate" onclick="WdatePicker({dateFmt:'yyyy-MM-dd HH:mm:ss'})" size="15" name="endTime" value="<?php echo isset($data['endTime']) ? date('Y-m-d H:i:s',$data['endTime']) : '' ?>"><br/><br/>
        宣传时间：<input type="text" class="input-small Wdate" onclick="WdatePicker({dateFmt:'yyyy-MM-dd HH:mm:ss'})" size="15" name="psvTime" value="<?php echo isset($data['psvTime']) ? date('Y-m-d H:i:s',$data['psvTime']) : '' ?>"><br/><br/>
        直播图片：<input type="text" class="imageFile" name="img" value="<?php echo isset($data['image']) ? $data['image'] : '' ?>" placeholder="图片地址">
        <a href="#" class="btn btn-info" onclick="upImage();">上传图片</a>
        <br/><br/>
        宣传图片：<input type="text" class="imageFile1" name="img1" value="<?php echo isset($data['psvImage']) ? $data['psvImage'] : '' ?>" placeholder="图片地址">
        <a href="#" class="btn btn-info" onclick="upImage1();">上传图片</a>
        <br/><br/>
        回放图片：<input type="text" class="imageFile2" name="img2" value="<?php echo isset($data['backImage']) ? $data['backImage'] : '' ?>" placeholder="图片地址">
        <a href="#" class="btn btn-info" onclick="upImage2();">上传图片</a>
        <br/><br/>
        <input type="submit" value="提交">
    </form>
</div>
<div>
</div>
<script type="text/plain" id="j_ueditorupload"></script>
<script type="text/plain" id="j_ueditorupload1"></script>
<script type="text/plain" id="j_ueditorupload2"></script>
<script>
    //实例化编辑器
    var o_ueditorupload = UE.getEditor('j_ueditorupload',{autoHeightEnabled:false});
    var o_ueditorupload1 = UE.getEditor('j_ueditorupload1',{autoHeightEnabled:false});
    var o_ueditorupload2 = UE.getEditor('j_ueditorupload2',{autoHeightEnabled:false});
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
    o_ueditorupload1.ready(function ()
    {

        o_ueditorupload1.hide();//隐藏编辑器

        //监听图片上传
        o_ueditorupload1.addListener('beforeInsertImage', function (t,arg)
        {
            $('.imageFile1').val(arg[0].src);

        });

        /* 文件上传监听
         * 需要在ueditor.all.min.js文件中找到
         * d.execCommand("insertHtml",l)
         * 之后插入d.fireEvent('afterUpfile',b)
         */
        o_ueditorupload1.addListener('afterUpfile', function (t, arg)
        {

        });
    });
    o_ueditorupload2.ready(function ()
    {

        o_ueditorupload2.hide();//隐藏编辑器

        //监听图片上传
        o_ueditorupload2.addListener('beforeInsertImage', function (t,arg)
        {
            $('.imageFile2').val(arg[0].src);

        });

        /* 文件上传监听
         * 需要在ueditor.all.min.js文件中找到
         * d.execCommand("insertHtml",l)
         * 之后插入d.fireEvent('afterUpfile',b)
         */
        o_ueditorupload2.addListener('afterUpfile', function (t, arg)
        {

        });
    });
    function upImage()
    {
        var myImage = o_ueditorupload.getDialog("insertimage");
        myImage.open();
    }
    function upImage1()
    {
        var myImage1 = o_ueditorupload1.getDialog("insertimage");
        myImage1.open();
    }
    function upImage2()
    {
        var myImage2 = o_ueditorupload2.getDialog("insertimage");
        myImage2.open();
    }
</script>