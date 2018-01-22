`<script type="text/javascript" src="/ueditor/ueditor.config.js"></script>
<!-- 编辑器源码文件 -->
<script type="text/javascript" src="/ueditor/ueditor.all.min.js"></script>
<!-- 编辑器公式插件 -->
<script type="text/javascript" charset="utf-8" src="/ueditor/kityformula-plugin/addKityFormulaDialog.js"></script>
<script type="text/javascript" charset="utf-8" src="/ueditor/kityformula-plugin/getKfContent.js"></script>
<script type="text/javascript" charset="utf-8" src="/ueditor/kityformula-plugin/defaultFilterFix.js"></script>
<script type="text/javascript" src="/My97DatePicker/WdatePicker.js"></script>

    <div class="row control-tit wrapper border-bottom white-bg">
        <span>添加分类</span>
    </div>
    <div>
        <form action="/content/category/add" method="post">
            <input type="hidden" name="uid" value="<?php  echo $uid?>">
            <input type="hidden" name="id" value="<?php echo isset($data['id'])?$data['id']:'' ?>">
            父级分类：
            <input name="pid" class="easyui-combotree" value="<?php echo isset($parent['id'])?$parent['id']:' ' ?>" data-options="url:'/content/api/tree?pid=0&id=<?php echo $parent['id'] ?>',method:'get'" style="width:200px;">
            分类名称：<input type="text" name="name" value="<?php echo isset($data['name'])?$data['name']:'' ?>">
            分类图片：<input type="text" class="imageFile" name="img" value="<?php echo isset($data['image']) ? $data['image'] : '' ?>" placeholder="图片地址">
            <a href="#" class="btn btn-info" onclick="upImage();">上传图片</a>
            分类排序：<input type="text" name="sort" value="<?php echo isset($data['sort'])?$data['sort']:'' ?>">
            八卦类型：<select name="gossip" id="">
                <option <?php if((isset($data['gossipType'])?$data['gossipType']:'0')==0){ ?> selected="selected" <?php } ?> value="0">不是备考八卦</option>
                <option <?php if((isset($data['gossipType'])?$data['gossipType']:'0')==1){ ?> selected="selected" <?php } ?> value="1">Gmat</option>
                <option <?php if((isset($data['gossipType'])?$data['gossipType']:'0')==2){ ?> selected="selected" <?php } ?> value="2">托福</option>
                <option <?php if((isset($data['gossipType'])?$data['gossipType']:'0')==3){ ?> selected="selected" <?php } ?> value="3">留学</option>
                <option <?php if((isset($data['gossipType'])?$data['gossipType']:'0')==4){ ?> selected="selected" <?php } ?> value="4">雅思</option>
                <option <?php if((isset($data['gossipType'])?$data['gossipType']:'0')==5){ ?> selected="selected" <?php } ?> value="5">SAT</option>
            </select>
            <input type="submit" value="<?php echo isset($data['id'])? '修改':'提交' ?>">
        </form>
    </div>

<script type="text/plain" id="j_ueditorupload"></script>
<script>
    $('.main').tree({
        onLoadSuccess: function (newValue, oldValue) {
            $('.main').combotree('setValue', <?php echo isset($data['pid'])?$data['pid']:''?>);
        }
    })
</script>
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
