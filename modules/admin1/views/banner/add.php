
<script type="text/javascript" charset="utf-8" src="/ueditor/ueditor.config.js"></script>
<script type="text/javascript" charset="utf-8" src="/ueditor/ueditor.all.min.js"> </script>
<script type="text/javascript" charset="utf-8" src="/ueditor/lang/zh-cn/zh-cn.js"></script>

<div class="span10">
    <a href="/index/index">首页</a><span >&gt;</span><span>banner管理</span><span >&gt;</span><span>添加/修改</span>
    <form name="form" method="post" action="<?php echo baseUrl."/admin/banner/add"?>" enctype="multipart/form-data">
        <table>

            <tr>
                <td width="80px">位置:</td>
                <td>
                    <select name="module">
                        <option value ="">请添加banner图位置</option>
                        <option value ="sat" <?php echo isset($data)&& $data['module']=="sat" ?  'selected':''?>>首页</option>
                        <option value ="pubclass" <?php echo isset($data)&& $data['module']=="pubclass" ?  'selected':''?>>公开课</option>
                        <option value ="info" <?php echo isset($data)&& $data['module']=="info" ?  'selected':''?>>资讯</option>
                    </select>
                </td>
<!--                <td><input type="text" name="module" placeholder="模块"  value="--><?php //echo isset($data)? $data['controller']:''?><!--"></td>-->
            </tr>
<!--            <tr>-->
<!--                <td>图片</td>-->
<!--                <td>-->
<!--                    --><?php // if(isset($data)) {$pic=$data['pic'];echo"<input name='pic' type='text' value='$pic' style='width: 500px;;'>";}
//                    else {echo '<input id="file" type="file" name="pic" >';
//                    }?>
<!--                </td>-->
<!--            </tr>-->
            <?php if(isset($data)) {
                $str = '<tr>';
                $str .= '<td>原图片:</td>';
                $str .= '<td>';
                $pic = $data['pic'];
                $str .= "<input name='pic' type='text' value='" . $pic . "'></td></tr>";
                echo $str;
            } ?>

            <tr>
                <td>上传、修改图片:</td>
                <td>
                    <input id="file" type="file" name="pic" >
                </td>
            </tr>
            <tr>
                <td>外链地址:</td>
                <td>
                    <input  type="text" name="url" value="<?php echo isset($data)? $data['url']:''?>" />
                </td>
            </tr>
            <tr>
                <td>图片说明:</td>
                <td>
                    <input  type="text" name="alt"  value="<?php echo isset($data)? $data['alt']:''?>" />
                </td>
            </tr>


            <tr>
                <td colspan="2" align="right">
                    <input type="hidden" name='id' value="<?php echo isset($data)? $data['id']:''?>"/>
                    <button type="submit" id="login-button">添加/修改</button></td>
            </tr>
            <input type="hidden" name="_csrf" value="<?=Yii::$app->request->getCsrfToken()?>" />
        </table>
    </form>

</div>