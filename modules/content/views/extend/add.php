<script type="text/javascript" src="/ueditor/ueditor.config.js"></script>
<!-- 编辑器源码文件 -->
<script type="text/javascript" src="/ueditor/ueditor.all.min.js"></script>
<!-- 编辑器公式插件 -->
<script type="text/javascript" charset="utf-8" src="/ueditor/kityformula-plugin/addKityFormulaDialog.js"></script>
<script type="text/javascript" charset="utf-8" src="/ueditor/kityformula-plugin/getKfContent.js"></script>
<script type="text/javascript" charset="utf-8" src="/ueditor/kityformula-plugin/defaultFilterFix.js"></script>

<!-- 树形菜单选择 -->
<link rel="stylesheet" type="text/css" href="/easyui/themes/default/easyui.css">
<link rel="stylesheet" type="text/css" href="/easyui/themes/icon.css">


<script type="text/javascript" src="/easyui/jquery.easyui.min.js"></script>
<div class="span10" id="datacontent">
    <ul class="breadcrumb">
        <li><a href="<?php echo baseUrl?>/content/index/index">内容模块</a> <span class="divider">/</span></li>
        <li class="active">扩展属性</li>
    </ul>
    <form action="<?php echo baseUrl?>/content/extend/add" method="post" class="form-horizontal">
        <fieldset>
            <div class="control-group">
                <label for="modulename" class="control-label">属性名称</label>
                <div class="controls">
                    <input type="text" id="input1" name="extend[name]" value="<?php echo isset($data)?$data['name']:''?>" datatype="userName" needle="needle" msg="您必须输入中英文字符的分类名称">
                    <span class="help-block">请输入扩展属性名称</span>
                </div>
            </div>
            <div class="control-group">
                <label for="modulename" class="control-label">属性标题</label>
                <div class="controls">
                    <input type="text" id="input1" name="extend[title]" value="<?php echo isset($data)?$data['title']:''?>" datatype="userName" needle="needle" msg="您必须输入中英文字符的分类名称">
                    <span class="help-block">请输入扩展属性标题</span>
                </div>
            </div>
            <div class="control-group">
                <label for="contentcatid" class="control-label">调用码：</label>
                <div class="controls form-inline">
                    <select id="contentcatid"  msg="您必须选择一个分类" needle="needle"
                            class="autocombox input-medium" name="extend[code]">
                        <?php
                        foreach($extendInvoke as $v) {
                            ?>
                            <option <?php echo isset($data) && $data['code'] == $v['code'] ? 'selected="selected"' : ''?>
                                value="<?php echo $v['code']?>"><?php echo $v['name']?></option>
                        <?php
                        }
                        ?>
                    </select>
                </div>
            </div>
<!--            --><?php //if(!isset($type)) { ?>
<!--                <div class="control-group">-->
<!--                    <label for="modulename" class="control-label">父级属性</label>-->
<!--                    <div class="controls">-->
<!--                        <select style="width: 400px" id="contentcatid" msg="您必须选择一个父级属性" url='--><?php //echo baseUrl?><!--/content/api/extend-tree' class="easyui-combotree">-->
<!--                        </select>-->
<!--                        <input type="hidden" name="extend[pid]" value="--><?php //echo isset($data)?$data['pid']:''?><!--">-->
<!--                    </div>-->
<!--                </div>-->
<!--            --><?php
//            }?>
            <?php if(!isset($type)) { ?>
                <div class="control-group">
                    <label for="modulename" class="control-label">分类名称</label>

                    <div class="controls">
                        <select id="contentcatid" msg="您必须选择一个分类" needle="needle" class="autocombox input-medium">
                            <option><?php echo $catName?></option>
                        </select><br/><br/>
                    </div>

                    <div class="controls" id="checkbox_digui">
                        <input type="radio" name="status" value="1"/> 子分类&nbsp;&nbsp;&nbsp;
                        <input type="radio" name="status" value="2"/> 递归&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <?php
                        if(!isset($inheritId) || (isset($inheritId)&&$inheritId == 1)) {
                            ?>
                            <input type="checkbox" <?php echo isset($data) && $data['deleteType'] ? 'checked' : ''?>
                                   name="canDelete" value="1"/> 继承分类不能删除
                        <?php
                        }
                        ?>
                    </div>

                </div>
            <?php
            }?>
            <div class="control-group">
                <label for="moduledescribe" class="control-label">属性图片</label>
                <div class="controls">
                    <div style="margin-bottom: 10px" id="InputsWrapper">
                                  <span>
                                      <input type="text" class="imageFile"  name="extend[image]" value="<?php echo isset($data)?$data['image']:''?>" placeholder="图片地址">
                                  </span>
                        <br>
                        <br>
                    </div>
                    <a href="#" class="btn btn-info" onclick="upImage();">上传图片</a>
                </div>
            </div>

            <div class="control-group">
                <label for="catdes" class="control-label">属性简介</label>
                <div class="controls">
                    <textarea class="input-xxlarge" rows="7" id="editor" name="extend[description]"><?php echo isset($data)?$data['description']:''?></textarea>
                    <span class="help-block">对这个分类进行描述</span>
                </div>
            </div>

            <div class="control-group">
                <label for="catdes" class="control-label">是否必填</label>
                <div class="controls" id="checkbox_digui">
                    <input class="requiredValue" type="radio" <?php echo isset($data) && $data['required'] == 1?'checked="true"':''?> name="extend[required]" value="1"/> 必填&nbsp;&nbsp;&nbsp;
                    <input type="radio" <?php echo isset($data) && $data['required'] == 2?'checked="true"':''?> name="extend[required]" class="requiredValue" value="2"/> 非必填&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                </div>
            </div>
            <?php if(!isset($type)) { ?>
                <div class="control-group">
                    <label class="control-label">子内容是否继承</label>

                    <div class="controls" id="checkbox_digui">
                        <input type="radio" <?php echo isset($data) && $data['used'] == 1 ? 'checked="true"' : '' ?>
                               name="extend[used]" value="1"/> 继承&nbsp;&nbsp;&nbsp;
                        <input type="radio" <?php echo isset($data) && $data['used'] == 2 ? 'checked="true"' : '' ?>
                               name="extend[used]" value="2"/> 不继承&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    </div>
                </div>
            <?php
            }
            ?>
            <div <?php echo isset($data) && $data['required'] == 1?'':'style="display: none"'?> id="required" class="control-group">
                <label for="contentcatid" class="control-label">正则值：</label>
                <div class="controls form-inline">
                    <input type="text" id="input1" name="extend[requiredValue]" value="<?php echo isset($data)?$data['requiredValue']:''?>" datatype="userName" needle="needle" msg="您必须输入中英文字符的分类名称">
                </div>
            </div>

            <div class="control-group">
                <label for="contentcatid" class="control-label">文本选择：</label>
                <div class="controls form-inline">
                    <select id="contentcatid" onchange="judgeType(this)"  msg="您必须选择一个分类" needle="needle"
                            class="autocombox input-medium" name="extend[type]">
                        <option <?php echo isset($data) && $data['type'] == 0?'selected="selected"':''?> value="0">普通文本</option>
                        <option <?php echo isset($data) && $data['type'] == 1?'selected="selected"':''?> value="1">编辑器(长文本)</option>
                        <option <?php echo isset($data) && $data['type'] == 2?'selected="selected"':''?> value="2">日期</option>
                        <option <?php echo isset($data) && $data['type'] == 3?'selected="selected"':''?> value="3">附件</option>
                        <option <?php echo isset($data) && $data['type'] == 4?'selected="selected"':''?> value="4">文本域</option>
                        <option <?php echo isset($data) && $data['type'] == 5?'selected="selected"':''?> value="5">下拉列表</option>
                    </select>
                </div>
            </div>
            <div <?php echo isset($data) && $data['type'] == 5?'':'style="display: none"'?> id="typeValue" class="control-group">
                <label for="contentcatid" class="control-label">列表值：</label>
                <div class="controls form-inline">
                    <textarea class="input-xxlarge" name="extend[typeValue]"><?php echo isset($data)?$data['typeValue']:''?></textarea>
                </div>
            </div>
            <div class="control-group">
                <div class="controls">
                    <input name="id" type="hidden" value="<?php echo isset($id)?$id:''?>">
                    <input name="url" type="hidden" value="<?php echo isset($url)?$url:''?>">
                    <input name="back" type="hidden" value="<?php echo isset($back)?$back:''?>">
                    <input name="<?php echo isset($type)?'extend[contentId]':'extend[catId]'?>" type="hidden" value="<?php echo isset($catId)?$catId:''?>">
                    <?php if(!isset($type)){?>
                        <input name="extend[belong]" type="hidden" value="<?php echo isset($belong)?$belong:''?>">
                    <?php }else{?>
                        <input name="type" type="hidden" value="<?php echo $type?>">
                    <?php }?>
                    <input type="submit"  class="btn btn-primary" value="提交">
                </div>
            </div>
        </fieldset>
    </form>
</div>
<?php
if(isset($id)){
    ?>
    <script>
        function expandTo() {
            var node = $('.easyui-combotree').tree('find', <?php echo isset($data['pid'])?$data['pid']:''?>);
            $('.textbox-value').val(node.id);
        }
        $('.easyui-combotree').tree({
            onLoadSuccess: function (newValue, oldValue) {
                expandTo();
            }
        })
    </script>
<?php
}
?>
<script>
    var editor = UE.getEditor('editor');
    $('.easyui-combotree').combotree({
        onClick: function (node) {
            $("input[name='extend[pid]']").val(node.id);
        }
    })
    function judgeType(_this){
        var val = $(_this).val();
        if(val == 5){
            $('#typeValue').show();
        }else{
            $('#typeValue').hide();
        }
    }

    $('.requiredValue').change(function(){
        var val = $(this).val();
        if(val == 1){
            $('#required').show();
        }else{
            $('#required').hide();
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