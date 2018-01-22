<script type="text/javascript" charset="utf-8" src="/ueditor/ueditor.config.js"></script>
<script type="text/javascript" charset="utf-8" src="/ueditor/ueditor.all.min.js"> </script>
<script type="text/javascript" charset="utf-8" src="/ueditor/lang/zh-cn/zh-cn.js"></script>
<div class="span10">
    <div >
        <a>首页</a>
        <span >&gt;</span>
        <span><a href="/admin/questions/index">文章管理</a></span>
        <span >&gt;</span>
        <span>添加文章</span>
    </div>
<!--    先添加短文或题目图片<a  href="/admin/questions/extend">添加</a> </br>-->
<!--            添加短文小题及选项<a><span id="addquestion">添加题目</span></a></br></br>-->
        <div id="question" >
            <form class="form" method="post" action="<?php echo baseUrl."/admin/article/add"?>" enctype="multipart/form-data">
                <table>
                    <tr>
                        <td width="80px">标题：</td>
                        <td>
                            <input  type="text" name="title" value="<?php echo isset($data)? $data['title']:''?>" />
                        </td>
                    </tr>
                    <tr>
                        <td>内容：</td>
                        <td>
                            <textarea id="content" style="width: 500px;"><?php echo isset($data)? $data['content']:''?></textarea>
                        </td>
                    </tr>
                    <?php if(isset($data)) {
                        $str = '<tr>';
                        $str .= '<td>原图片：</td>';
                        $str .= '<td>';
                        $pic = $data['file'];
                        $str .= "<input name='file' type='text' value='" . $pic . "'></td></tr>";
                        echo $str;
                    } ?>
                    <tr>
                        <td>上传文件：</td>
                        <td>
                            <input id="file" type="file" name="file" >
                        </td>
                    </tr>
                    <tr>
                        <td>分类：</td>
                        <td>
                            <input  type="text" name="cate" value="<?php echo isset($data)? $data['cate']:''?>" />
                        </td>
                    </tr>
                    <tr>
                        <td>话题：</td>
                        <td>
                            <input  type="text" name="topic"  value="<?php echo isset($data)? $data['topic']:''?>" />
                        </td>
                    </tr>
                    <tr>
                        <td>是否置顶：</td>
                        <td>
                            <input type="radio" name="isTop" value="0" <?php echo isset($data)&&($data['isTop']=='0') ? 'checked="checked"':''?> />置顶
                            <input type="radio" name="isTop" value="1" <?php echo isset($data)&&($data['isTop']=='1') ? 'checked="checked"':''?> />不置顶
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2" align="right">
                            <input type="hidden" name='id' value="<?php echo isset($data)? $data['id']:''?>"/>
                            <button type="submit" id="login-button">添加/修改</button>
                        </td>
                    </tr>
                </table>
            </form>
        </div>
</div>
<script>
    var ue = UE.getEditor('editor');
    var content = UE.getEditor('content');
    var keyA= UE.getEditor('keyA');
    var keyB = UE.getEditor('keyB');
    var keyC= UE.getEditor('keyC');
    var keyD = UE.getEditor('keyD');
    var keyE = UE.getEditor('analysis');
</script>