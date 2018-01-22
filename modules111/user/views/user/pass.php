<script type="text/javascript" src="/My97DatePicker/WdatePicker.js"></script>
<div class="row control-tit wrapper border-bottom white-bg">
    <span>修改密码</span>
</div>
<div class="wrapper wrapper-content">
    <form action="/user/user/update-pass" method="post">
        <div class="white-bg info-wrap">
            <p>UID：<?php echo isset($userData['uid'])? $userData['uid']:'' ?></p>
            <p>用户名：<?php echo isset($userData['username'])?$userData['username']:'' ?>
            <p>昵称：<?php echo isset($userData['nickname'])?$userData['nickname']:'' ?>
            <p>新密码：<input type="text" name="pass" value=""></p>
            <input type="hidden" name="url" value="<?php echo $_GET['url'] ?>">
            <input name="uid" type="hidden" value="<?php echo isset($userData['uid'])?$userData['uid']:'' ?>">
            <input type="submit" value="提交">
        </div>
    </form>
</div>

