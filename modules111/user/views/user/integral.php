<script type="text/javascript" src="/My97DatePicker/WdatePicker.js"></script>
<div class="row control-tit wrapper border-bottom white-bg">
    <span>调整积分</span>
</div>
<div class="wrapper wrapper-content">
    <form action="/user/user/update-integral" method="post">
        <div class="white-bg info-wrap">
            <p>UID：<?php echo isset($userData['uid'])? $userData['uid']:'' ?></p>
            <p>用户名：<?php echo isset($userData['username'])?$userData['username']:'' ?>
            <p>昵称：<?php echo isset($userData['nickname'])?$userData['nickname']:'' ?>
            <div>积分修改类型：<select name="type" id="">
                    <option value="1">
                        +
                    </option>
                    <option value="2">
                        -
                    </option>
                </select>
            </div>
            <br/>
            <p>积分：<input type="text" name="integral" value="<?php echo  $data['integral'] ?>"></p>
            <input type="hidden" name="url" value="<?php echo $_GET['url']?>">
            <input name="uid" type="hidden" value="<?php echo isset($userData['uid'])?$userData['uid']:'' ?>">
            <input type="submit" value="提交">
        </div>
    </form>
</div>

