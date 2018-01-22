<script type="text/javascript" src="/My97DatePicker/WdatePicker.js"></script>
<div class="row control-tit wrapper border-bottom white-bg">
    <span>修改角色</span>
</div>
<div class="wrapper wrapper-content">
    <form action="/user/user/update-role" method="post">
        <div class="white-bg info-wrap">
            <input name="uid" type="hidden" value="<?php echo isset($_GET['id'])? $_GET['id']:'' ?>">
            <p>UID：<?php echo isset($data['uid'])? $data['uid']:'' ?></p>
            <p>用户名：<?php echo isset($data['username'])?$data['username']:'' ?>
            <p>昵称：<?php echo isset($data['nickname'])?$data['nickname']:'' ?>
            <div>角色：<select name="role" id="">
                <option value="">选择角色</option>
                <?php foreach($role as $r){ ?>
                    <option <?php if((isset($data['roleId'])?$data['roleId']:'')==$r['id']){ ?> selected="selected" <?php } ?> value="<?php echo $r['id'] ?>"><?php echo $r['name'] ?></option>
                    <?php
                } ?>
            </select>
                <input type="hidden" name="url" value="<?php echo $_GET['url']?>">
            <input type="submit" value="提交">
                </div>
        </div>
    </form>
</div>

