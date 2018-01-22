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
        <li><a href="<?php echo baseUrl?>/content/index/index">内容模块</a> <span class="divider">/</span></li>
        <li><a href="<?php echo baseUrl?>/content/content/index">内容管理</a> <span class="divider">/</span></li>
        <li class="active">添加内容</li>
    </ul>
    <ul class="nav nav-tabs">
        <li class="pull-right">
            <?php if(isset($id)) { ?>
                <a href="<?php echo baseUrl?>/content/extend/add?id=<?php echo $id?>&type=content&back=1&url=<?php echo $url?>">添加内容属性</a>
            <?php
            }
            ?>
        </li>
    </ul>
    <form action="<?php echo baseUrl?>/content/content/add" method="post" class="form-horizontal">
        <fieldset>
            <?php if(!isset($catId)) { ?>
                <div class="control-group">
                    <label for="modulename" class="control-label">内容分类</label>

                    <div class="controls">
                        <select style="width: 400px" id="contentcatid" msg="您必须选择一个分类" url='<?php echo baseUrl?>/content/api/tree?pid=1&major=1' class="main easyui-combotree">
                        </select>
                    </div>
                </div>
            <?php
            }else {
                ?>
                <div class="control-group">
                    <label for="modulename" class="control-label">内容主分类</label>
                    <div class="controls">
                        <select id="contentcatid" msg="您必须选择一个分类" needle="needle" class="input-medium">
                            <option><?php echo $catName?></option>
                        </select><br/><br/>
                    </div>
                </div>

                <div class="control-group">
                    <label for="modulename" class="control-label">内容副分类</label>
                    <div class="controls">
                        <select style="width: 400px" id="contentcatid" msg="您必须选择一个分类" data-options="url:'<?php echo baseUrl?>/content/api/content-second-class?catId=<?php echo isset($id)?$data['catId']:$catId?>&id=<?php echo $catId?>',method:'get',cascadeCheck:false" multiple class="vice easyui-combotree">
                        </select><br/><br/>
                    </div>
                </div>
                <?php
                if(isset($relCentent[0]['name'])) { ?>
                    <div class="control-group">
                        <label for="modulename" class="control-label">关联【<?php echo $relCentent[0]['name']?>】内容</label>
                        <div class="controls">
                            <select style="width: 400px" id="contentcatid" msg="您必须选择一个分类" data-options="url:'<?php echo baseUrl?>/content/api/content-gl?catId=<?php echo $relCentent[0]['id']?>&id=<?php echo $catId?>',method:'get',cascadeCheck:false" multiple class="vice1 easyui1-combotree">
                            </select><br/><br/>
                        </div>
                    </div>
                <?php }
                ?>
            <?php
            }
            ?>
            <?php if(isset($catId)) { ?>
            <div class="control-group">
                <label for="modulename" class="control-label">内容名称</label>
                <div class="controls">
                    <input type="text" id="input1" name="content[name]" value="<?php echo isset($data['name'])?$data['name']:''?>" datatype="userName" needle="needle" msg="您必须输入中英文字符的分类名称">
                    <span class="help-block">请输入内容名称</span>
                </div>
            </div>

            <div class="control-group">
                <label for="modulename" class="control-label">内容标题</label>
                <div class="controls">
                    <input type="text" id="input1" name="content[title]" value="<?php echo isset($data['title'])?$data['title']:''?>" datatype="userName" needle="needle" msg="您必须输入中英文字符的分类名称">
                </div>
            </div>

            <div class="control-group">
                <label for="moduledescribe" class="control-label">内容图片</label>

                <div class="controls">
                    <div style="margin-bottom: 10px" id="InputsWrapper">
                                  <span>
                                      <input type="text" class="imageFile" name="content[image]"
                                             value="<?php echo isset($data['image']) ? $data['image'] : '' ?>"
                                             placeholder="图片地址">
                                  </span>
                        <br>
                        <br>
                    </div>
                    <a href="#" class="btn btn-info" onclick="upImage();">上传图片</a>
                </div>
            </div>

            <div class="control-group">
                <label for="modulename" class="control-label">内容浏览量</label>
                <div class="controls">
                    <input type="text" id="input1" name="content[viewCount]" value="<?php echo isset($data['viewCount'])?$data['viewCount']:'0'?>"  needle="needle" msg="您必须输入中英文字符的分类名称">
                </div>
            </div>


            <div class="control-group">
                <label for="modulename" class="control-label">点赞人数</label>
                <div class="controls">
                    <input type="text" id="input1" name="content[like]" value="<?php echo isset($data['like'])?$data['like']:'0'?>"  needle="needle" msg="您必须输入中英文字符的分类名称">
                </div>
            </div>

            <div class="control-group">
                <label for="modulename" class="control-label">是否设置为精华帖</label>
                <div class="controls">
                    <input type="radio" <?php echo isset($data['goodArticle']) && $data['goodArticle'] ==1?"checked":""?> name="content[goodArticle]" value="1" needle="needle"/> 是&nbsp;&nbsp;&nbsp;
                    <input type="radio" <?php echo isset($data['goodArticle']) && $data['goodArticle']==0?"checked":""?> name="content[goodArticle]" value="0" needle="needle"/> 否

                    <!--                    <input type="text" id="input1" name="content[goodAticle]" value="--><?php //echo isset($data['goodAticle'])?$data['goodAticle']:'0'?><!--"  needle="needle" msg="您必须输入中英文字符的分类名称">-->
                </div>
            </div>

            <div class="control-group">
                <label for="modulename" class="control-label">是否显示</label>
                <div class="controls">
                    <input type="radio" <?php echo isset($data['show']) && $data['show'] ==1?"checked":""?> name="content[show]" value="1" needle="needle"/> 是&nbsp;&nbsp;&nbsp;
                    <input type="radio" <?php echo isset($data['show']) && $data['show']==0?"checked":""?> name="content[show]" value="0" needle="needle"/> 否

                    <!--                    <input type="text" id="input1" name="content[show]" value="--><?php //echo isset($data['show'])?$data['show']:'0'?><!--"  needle="needle" msg="您必须输入中英文字符的分类名称">-->
                </div>
            </div>
            <?php
            foreach ($catContent as $k => $v) {
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
                                    value="<?php echo $val?>"><?php echo $val?></option>
                            <?php
                            }
                            ?>
                        </select>
                        <input type="hidden" name="key[]" value="<?php echo $v['id'] ?>">
                    <?php } elseif ($v['type'] == 1) { ?>

                        <textarea  id="editor<?php echo $k ?>"
                                   name="value[]"><?php echo empty($v['value'])&&isset($v['dataValue'])?$v['dataValue']:$v['value'] ?></textarea>
                        <input type="hidden" name="key[]" value="<?php echo $v['id'] ?>">
                        <script>
                            var editor = UE.getEditor('editor<?php echo $k?>',{ initialFrameWidth: null });
                        </script>
                    <?php
                    } elseif ($v['type'] == 2) {
                        ?>
                        <input type="text"  class="Wdate" onclick="WdatePicker({dateFmt:'yyyy-MM-dd HH:mm:ss'})" name="value[]" value="<?php echo empty($v['value'])&&isset($v['dataValue'])?$v['dataValue']:$v['value'] ?>" datatype=""
                               needle="needle" msg="">
                        <input type="hidden" name="key[]" value="<?php echo $v['id'] ?>">
                    <?php
                    }elseif($v['type'] == 0){
                        ?>
                        <input type="text"  name="value[]" value="<?php echo str_replace('"', '&#34;', str_replace("'", '&#39;', empty($v['value'])&&isset($v['dataValue'])?$v['dataValue']:$v['value'])); ?>" datatype=""
                               needle="needle" msg="">
                        <input type="hidden" name="key[]" value="<?php echo $v['id'] ?>">
                    <?php
                    }elseif($v['type'] == 4){
                        ?>
                        <textarea class="input-xxlarge" rows="7" name="value[]"><?php echo empty($v['value'])&&isset($v['dataValue'])?$v['dataValue']:$v['value'] ?></textarea>
                        <input type="hidden" name="key[]" value="<?php echo $v['id'] ?>">
                    <?php
                    }
                    else {
                    ?>
                    <div style="margin-bottom: 10px" id="InputsWrapper">
                                  <span>
                                      <input type="text" class="file<?php echo $k ?>" name="value[]"
                                             value="<?php echo empty($v['value'])&&isset($v['dataValue'])?$v['dataValue']:$v['value'] ?>" placeholder="文件地址">
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
                ?>
<?php
//    if($pid != 0) {
//        foreach ($tag as $v){
//            ?>
<!--                <div class="control-group">-->
<!--                    <label for="catdes" class="control-label">--><?php //echo $v['name'] ?><!--</label>-->
<!--                    <div class="controls">-->
<!--                        <select id="contentcatid"  msg="您必须选择一个分类" needle="needle"-->
<!--                                class="autocombox input-medium" name="tagValue[]">-->
<!--                            --><?php
//                            foreach($v['child'] as $val) {
//                                ?>
<!--                                <option --><?php //echo isset($val['select'])&&$val['select']?"selected='selected'":''?><!-- value="--><?php //echo $val['id']?><!--">--><?php //echo $val['name']?><!--</option>-->
<!--                            --><?php
//                            }
//                            ?>
<!--                        </select>-->
<!--                        <input name="tagKey[]" value="--><?php //echo $v['id']?><!--" type="hidden">-->
<!--                    </div>-->
<!--                </div>-->
<!--        --><?php
//        }
//    }
//        ?>
                <div class="control-group">
                    <div class="controls">
                        <input name="category" type="hidden" value="<?php echo $catId?>">
                        <input name="con" type="hidden" value="">
                        <input name="url" type="hidden" value="<?php echo $url?>">
                        <input name="content[pid]" type="hidden" value="<?php echo isset($_GET['pid'])?$_GET['pid']:0?><?php echo isset($data['pid'])?$data['pid']:''?>">
                        <input name="id" type="hidden" value="<?php echo isset($id) ? $id : '' ?>">
                        <input name="content[catId]" type="hidden" value="<?php echo isset($catId) && isset($id) ?  $data['catId']: $catId ?>">
                        <input type="submit" class="btn btn-primary" value="提交">
                    </div>
                </div>
                <?php
                }
                ?>
        </fieldset>
    </form>
</div>

<script>
    <?php
    if(!isset($id)){
    ?>
    $('.main').combotree({
        onClick: function (node) {
            location.href = "<?php echo baseUrl?>/content/content/add?url=<?php echo $url?>&id=" + node.id + "&pid=<?php echo isset($_GET['pid'])?$_GET['pid']:0?>";
        }
    })
    <?php
    }
    ?>
    $('.vice').combotree({
        onCheck:function(newValue,oldValue){
            var nodes = $('.easyui-combotree').combotree('getValues');
            $("input[name='category']").val(nodes);
        }
    });
    $('.vice1').combotree({
        onCheck:function(newValue,oldValue){
            var nodes = $('.easyui1-combotree').combotree('getValues');
            $("input[name='con']").val(nodes);
        }
    });
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