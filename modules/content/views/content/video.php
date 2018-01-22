<script type="text/javascript" src="/ueditor/ueditor.config.js"></script>
<!-- 编辑器源码文件 -->
<script type="text/javascript" src="/ueditor/ueditor.all.min.js"></script>
<!-- 编辑器公式插件 -->
<script type="text/javascript" charset="utf-8" src="/ueditor/kityformula-plugin/addKityFormulaDialog.js"></script>
<script type="text/javascript" charset="utf-8" src="/ueditor/kityformula-plugin/getKfContent.js"></script>
<script type="text/javascript" charset="utf-8" src="/ueditor/kityformula-plugin/defaultFilterFix.js"></script>
<link rel="stylesheet" type="text/css" href="/easyui/themes/default/easyui.css">
<link rel="stylesheet" type="text/css" href="/easyui/themes/icon.css">
<script type="text/javascript" src="/easyui/jquery.easyui.min.js"></script>
<div class="span10" id="datacontent">
    <ul class="breadcrumb">
        <li><a href="<?php echo baseUrl?>/content/index/index">内容模块</a> <span class="divider">/</span></li>
        <li><a href="<?php echo baseUrl?>/content/content/index">内容管理</a> <span class="divider">/</span></li>
        <li class="active">添加内容</li>
    </ul>
    <form action="<?php echo baseUrl?>/content/content/video" method="post" class="form-horizontal">
        <fieldset>
            <input type="hidden" name="contentId" value="<?php echo isset($_GET['pid'])?$_GET['pid']:'' ?>">
            <div class="control-group">
                <label for="modulename" class="control-label">LIVESDKID：</label>
                <input type="text" name="kidId" value="<?php echo isset($data['livesdkid'])?$data['livesdkid']:'' ?>">
            </div>
            <div class="control-group">
                <label for="modulename" class="control-label">老师口令：</label>
                <input type="text" name="teacherKey" value="<?php echo isset($data['teacherKey'])?$data['teacherKey']:'' ?>">
            </div>
            <div class="control-group">
                <label for="modulename" class="control-label">助教口令：</label>
                <input type="text" name="assistantKey" value="<?php echo isset($data['assistantKey'])?$data['assistantKey']:'' ?>">
            </div>
            <div class="control-group">
                <label for="modulename" class="control-label">学生WEB端口令：</label>
                <input type="text" name="webKey" value="<?php echo isset($data['webKey'])?$data['webKey']:'' ?>">
            </div>
            <div class="control-group">
                <label for="modulename" class="control-label">学生客户端口令：</label>
                <input type="text" name="clientKey" value="<?php echo isset($data['clientKey'])?$data['clientKey']:'' ?>">
            </div>
            <div class="control-group">
                <div class="controls">
                    <input type="submit" class="btn btn-primary" value="提交">&nbsp;&nbsp;&nbsp;&nbsp;<span class="btn btn-primary" onclick="displayEdit()">编辑视频课程</span>
                </div>
            </div>
        </fieldset>
    </form>
</div>
<script>
    function displayEdit(){
        $("#edit").css("display","block")
    }
    function displayAdd(){
        $("#form_v").css("display","block")
        $("input[name='kname']").val('');
        $("input[name='sdk']").val('');
        $("input[name='pwd']").val('');
        $("input[name='files']").val('');
        $("input[name='id']").remove();
    }
</script>
<div class="span10" id="edit" style="display: none;">
    <ul class="breadcrumb">
        <li>内容模块 <span class="divider">/</span></li>
        <li>视频管理 <span class="divider">/</span></li>
        <li><a href="javascript:void(0);" onclick="displayAdd()">添加视频</a></li>
    </ul>
    <div class="control-group" >
        <table style=" width: 60%;overflow: auto;_overflow: auto;margin: 20px 0;background: #ffffff;border-radius: 5px;border: 3px solid #fff;">
            <th>课程名称</th>
            <th>sdk</th>
            <th>密码</th>
            <th>文件地址</th>
            <th>发表时间</th>
            <th>操作</th>
            <?php foreach($video as $v) { ?>
                <tr>
                    <td><?php echo $v['name'] ?></td>
                    <td><?php echo $v['sdk'] ?></td>
                    <td><?php echo $v['pwd'] ?></td>
                    <td><?php echo $v['fileAddress'] ?></td>
                    <td><?php echo date('Y-m-d H:i:s', $v['createTime']); ?></td>
                    <td><a href='javascript:void(0);' onclick="upData(<?php echo $v['id'] ?>);">修改</a>&nbsp;&nbsp;&nbsp;&nbsp;<a href='javascript:void(0);' onclick="Delete(<?php echo $v['id'] ?>);">删除</a></td>
                </tr>
                <?php
            }
            ?>
        </table>
    </div>
    <script>
        function upData(o) {
            var id = o;
            $.ajax({
                url: '/content/api/video',
                data: {id: id},
                dataType: 'json',
                type: 'get',
                success: function (data) {
                    $("input[name='kname']").val(data.name);
                    $("input[name='sdk']").val(data.sdk);
                    $("input[name='pwd']").val(data.pwd);
                    $("input[name='files']").val(data.fileAddress);
                    $("#form_v").css("display","block");
                    var str = "<input type='hidden' name='id' value='"+data.id+"'>";
                    $("#form_v").append(str);
                }
            });
        }
        function Delete(j){
            var id = j;
            $.ajax({
                url: '/content/api/video-delete',
                data: {id: id},
                dataType: 'json',
                type: 'get',
                success: function (data) {
                    if(data==1){
                        alert("成功");
                        window.location.reload();
                    } else {
                        alert("删除失败");
                    }
                }
            });
        }
    </script>
    <form action="<?php echo baseUrl?>/content/content/file-video" method="post" class="form-horizontal" id="form_v" style="display: none">
        <fieldset>
            <div class="hid control-group">
                <label for="modulename" class="control-label">课程名称：</label>
                <input type="text" name="kname" value="">
            </div>
            <div class="hid control-group">
                <label for="modulename" class="control-label">SDK：</label>
                <input type="text" name="sdk" value="">
            </div>
            <div class="hid control-group">
                <label for="modulename" class="control-label">密码：</label>
                <input type="text" name="pwd" value="">
            </div>
            <input type="hidden" name="cid" value="<?php echo isset($_GET['pid'])?$_GET['pid']:'' ?>">
<!--            <div class="hid control-group">-->
<!--                <label for="catdes" class="control-label">视频课程：</label>-->
<!--                <div class="controls">-->
<!--                <div style="margin-bottom: 10px" id="InputsWrapper">-->
<!--                                  <span>-->
<!--                                      <input type="text" class="file" name="files"-->
<!--                                             value="" placeholder="文件地址">-->
<!--                                  </span>-->
<!--                    <a href="javascript:void(0);" class="btn btn-info" onclick="upFiles();">上传文件</a>-->
<!--                <script>-->
<!--                    //实例化编辑器-->
<!--                    var o_ueditorupload = UE.getEditor('j_ueditorupload',-->
<!--                        {-->
<!--                            autoHeightEnabled: false-->
<!--                        });-->
<!--                    o_ueditorupload.ready(function () {-->
<!---->
<!--                        o_ueditorupload.hide();//隐藏编辑器-->
<!---->
<!--                        o_ueditorupload.addListener('afterUpfile', function (t, arg) {-->
<!--                            $('.file').val(arg[0].url);-->
<!--                        });-->
<!--                    });-->
<!---->
<!--//                    弹出文件上传的对话框-->
<!--                    function upFiles() {-->
<!--                        var myFiles = o_ueditorupload.getDialog("attachment");-->
<!--                        myFiles.open();-->
<!--                    }-->
<!---->
<!--                </script>-->
<!--                <script type="text/plain" id="j_ueditorupload"></script>-->
<!--                </div>-->
<!--                </div>-->
<!--            </div>-->
            <div class="control-group">
                <div class="controls">
                    <input type="submit" class="btn btn-primary" value="添加视频课">
                </div>
            </div>
        </fieldset>
    </form>
</div>




