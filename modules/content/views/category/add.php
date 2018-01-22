`<script type="text/javascript" src="/ueditor/ueditor.config.js"></script>
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
        <li><a href="<?php echo baseUrl?>/content/index/index">内容模块</a> <span class="divider">/</span></li>
        <li><a href="<?php echo baseUrl?>/content/category/index">分类管理</a> <span class="divider">/</span></li>
        <li class="active">添加分类</li>
    </ul>
    <ul class="nav">
        <li class="pull-right">
            <?php if(isset($id)) { ?>
                <a href="<?php echo baseUrl?>/content/extend/add?back=1&id=<?php echo $id?>&belong=category">添加分类属性</a>
            <?php
            }
            ?>
        </li>
    </ul>
    <form action="<?php echo baseUrl?>/content/category/add" method="post" class="form-horizontal">
        <fieldset>
            <div class="control-group">
                <label for="modulename" class="control-label">父级分类</label>
                <div class="controls">
                    <select style="width: 400px" id="contentcatid" msg="您必须选择一个分类" url='<?php echo baseUrl?>/content/api/tree?pid=0<?php echo isset($data["id"])?"&id=".$data["id"]:""?>' class="main autocombox input-medium easyui-combotree">
                    </select><br/><br/>
                    <input type="hidden" name="category[pid]" value="<?php echo isset($_GET['pid'])?$_GET['pid']:''?><?php echo isset($data['pid'])?$data['pid']:''?>" >
                </div>
            </div>
            <div class="control-group">
                <label for="modulename" class="control-label">关联分类名称</label>
                <div class="controls">
                    <select style="width: 400px" id="contentcati" msg="您必须选择一个分类" url='<?php echo baseUrl?>/content/api/cat?pid=1' class="main1 autocombox input-medium easyui-combotree">
                    </select><br/><br/>
                    <input type="hidden" name="category[relatedcatid]" value="" >
                </div>
            </div>

            <div class="control-group">
                <label for="modulename" class="control-label">分类名称</label>
                <div class="controls">
                    <input type="text" id="input1" name="category[name]" value="<?php echo isset($data['name'])?$data['name']:''?>" datatype="userName" needle="needle" msg="您必须输入中英文字符的分类名称">
                    <span class="help-block">请输入分类名称</span>
                </div>
            </div>

            <div class="control-group">
                <label for="moduledescribe" class="control-label">分类图片</label>
                <div class="controls">
                    <div style="margin-bottom: 10px" id="InputsWrapper">
                                  <span>
                                      <input type="text" class="imageFile"   name="category[image]" value="<?php echo isset($data['image'])?$data['image']:''?>" placeholder="图片地址">
                                  </span>
                        <br>
                        <br>
                    </div>
                    <a href="#" class="btn btn-info" onclick="upImage();">上传图片</a>
                </div>
            </div>
<?php
    if(isset($id)) {
        ?>
        <div class="control-group">
            <label for="modulename" class="control-label">副分类模板</label>

            <div class="controls">
                <select style="width: 400px" id="contentcatid" msg="您必须选择一个分类"
                        data-options="url:'<?php echo baseUrl?>/content/api/tree?pid=1&type=1&id=<?php echo isset($data['secondClass']) ? $data['secondClass'] : ''?>',method:'get',cascadeCheck:false"
                        multiple class="vice easyui-combotree">
                </select><br/><br/>
            </div>
        </div>
    <?php
    }
?>
            <div class="control-group">
                <label for="catdes" class="control-label">分类简介</label>
                <div class="controls">
                    <textarea  id="editor" name="category[description]"><?php echo isset($data['description'])?$data['description']:''?></textarea>
                    <span class="help-block">对这个分类进行描述</span>
                </div>
            </div>
            <div class="control-group">
                <label for="modulename" class="control-label">模块显示</label>
                <div class="controls" id="checkbox_digui">
                    <input type="radio" <?php echo isset($data['isShow']) && $data['isShow'] ==1?"checked":""?> name="category[isShow]" value="1"/> 显示&nbsp;&nbsp;&nbsp;
                    <input type="radio" <?php echo isset($data['isShow']) && $data['isShow']==2?"checked":""?> name="category[isShow]" value="2"/> 隐藏
                </div>
            </div>
            <div class="control-group">
                <label for="modulename" class="control-label">作为主分类</label>
                <div class="controls" id="checkbox_digui">
                    <input type="radio" <?php echo isset($data['isMajor']) && $data['isMajor'] ==1?"checked":""?> name="category[isMajor]" value="1"/> 是&nbsp;&nbsp;&nbsp;
                    <input type="radio" <?php echo isset($data['isMajor']) && $data['isMajor']==2?"checked":""?> name="category[isMajor]" value="2"/> 否
                </div>
            </div>
            <div class="control-group">
                <label for="modulename" class="control-label">分类子内容</label>
                <div class="controls">
                    <input type="radio" <?php echo isset($data['can']) && $data['can'] ==1?"checked":""?> name="category[can]" value="1"/> 可用别分类&nbsp;&nbsp;&nbsp;
                    <input type="radio" <?php echo isset($data['can']) && $data['can']==2?"checked":""?> name="category[can]" value="2"/> 不可用别分类
                </div>
            </div>
            <?php
            if(isset($extend)){
            foreach ($extend as $k => $v) {
            ?>
            <div class="control-group">
                <label for="catdes" class="control-label"><?php echo $v['name'] ?></label>

                <div class="controls">
                    <?php
                    if($v['type'] == 5){
                        $typeValue = explode(",",$v['typeValue']);
                        ?>
                        <select id="contentcatid"  msg="您必须选择一个分类" needle="needle"
                                class="autocombox input-medium" name="value[]">
                            <?php
                            foreach($typeValue as $val) {
                                ?>
                                <option <?php echo $val == $v['value'] ? 'selected="selected"' : ''?>
                                    value="<?php echo$val?>"><?php echo $val?></option>
                            <?php
                            }
                            ?>
                        </select>
                        <input type="hidden" name="key[]" value="<?php echo $v['id'] ?>">
                    <?php }elseif ($v['type'] == 1) { ?>
                        <textarea class="input-xxlarge" rows="7" id="editor<?php echo $k ?>"
                                  name="value[]"><?php echo $v['value'] ?></textarea>
                        <input type="hidden" name="key[]" value="<?php echo $v['id'] ?>">
                        <script>
                            var editor = UE.getEditor('editor<?php echo $k?>');
                        </script>
                    <?php
                    } elseif ($v['type'] == 2) {
                    ?>
                    <input type="text"  class="Wdate" onclick="WdatePicker()" name="value[]" value="<?php echo $v['value'] ?>" datatype=""
                           needle="needle" msg="">
                    <input type="hidden" name="key[]" value="<?php echo $v['id'] ?>">
                    <?php
                    }elseif($v['type'] == 0) {
                        ?>
                        <input type="text" name="value[]" value="<?php echo $v['value'] ?>" datatype=""
                               needle="needle" msg="">
                        <input type="hidden" name="key[]" value="<?php echo $v['id'] ?>">
                    <?php
                    }elseif($v['type'] == 4){
                        ?>
                        <textarea class="input-xxlarge" rows="7" name="value[]"><?php echo $v['value'] ?></textarea>
                        <input type="hidden" name="key[]" value="<?php echo $v['id'] ?>">
                    <?php
                    }
                    else {
                    ?>
                    <div style="margin-bottom: 10px" id="InputsWrapper">
                                  <span>
                                      <input type="text" class="file<?php echo $k ?>" name="value[]"
                                             value="<?php echo $v['value'] ?>" placeholder="文件地址">
                                  </span>
                        <br>
                        <br>
                        <input type="hidden" name="key[]" value="<?php echo $v['id'] ?>">
                        <a href="#" class="btn btn-info" onclick="upFiles<?php echo $k ?>();">上传文件</a>
                        <script>
                            //实例化编辑器
                            var o_ueditorupload<?php echo $k?> = UE.getEditor('j_ueditorupload<?php echo $k?>',
                                {
                                    autoHeightEnabled: false
                                });
                            o_ueditorupload<?php echo $k?>.ready(function () {

                                o_ueditorupload<?php echo $k?>.hide();//隐藏编辑器

                                o_ueditorupload<?php echo $k?>.addListener('afterUpfile', function (t, arg) {
                                    $('.file<?php echo $k?>').val(arg[0].url);
                                });
                            });

                            弹出文件上传的对话框
                            function upFiles<?php echo $k?>() {
                                var myFiles = o_ueditorupload<?php echo $k?>.getDialog("attachment");
                                myFiles.open();
                            }

                        </script>
                        <script type="text/plain" id="j_ueditorupload<?php echo $k ?>"></script>

                        <?php
                        }
                        ?>
                    </div>
                </div>
                <?php
                }
                }
            ?>
            <div class="control-group">
                <label for="modulename" class="control-label">排序</label>
                <div class="controls">
                    <input type="text" id="input1" name="category[sort]" value="<?php echo isset($data['sort'])?$data['sort']:'0'?>" datatype="userName" needle="needle" msg="您必须输入中英文字符的分类名称">
                </div>
            </div>
            <div class="control-group">
                <div class="controls">
                    <input name="id" type="hidden" value="<?php echo isset($id)?$id:''?>">
                    <input name="category[secondClass]" type="hidden" value="<?php echo isset($data['secondClass'])?$data['secondClass']:''?>">
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

        $('.main').tree({
            onLoadSuccess: function (newValue, oldValue) {
                $('.main').combotree('setValue', <?php echo isset($data['pid'])?$data['pid']:''?>);
            }
        })
    </script>
<?php
}
?>
<?php
if(isset($_GET['pid'])) {
    ?>
    <script>
        $('.main').tree({
            onLoadSuccess: function (newValue, oldValue) {
                $('.main').combotree('setValue', <?php echo isset($_GET['pid'])?$_GET['pid']:''?>);
            }
        })
    </script>
<?php
}
?>
<script>
    $('.main').combotree({
        onClick: function (node) {
            $("input[name='category[pid]']").val(node.id);
        }
    })
    $('.main1').combotree({
        onClick: function (node) {
            $("input[name='category[relatedcatid]']").val(node.id);
        }
    })
    $('.vice').combotree({
        onCheck:function(newValue,oldValue){
            var nodes = $('.vice').combotree('getValues');
            $("input[name='category[secondClass]']").val(nodes);
        }
    });
    var editor = UE.getEditor('editor');
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