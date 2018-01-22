<div class="row control-tit wrapper border-bottom white-bg">
    <span>添加用户</span>
</div>
<div>
    <form id="add-form" action="/user/user/add-user" method="post" onsubmit="return toVaild()">
        手机：<input type="text" class="phone" name="phone" value="">
        邮箱：<input type="text" class="email" name="email" value="">
        密码：<input type="password" class="password" name="passWord" value="">
        <input type="hidden" name="url" value="<?php echo $_GET['url'] ?>">
        <input type="submit" value="提交">
    </form>
</div>
<script>
    function toVaild() {
        var password = $(".password").val();
        var phone = $(".phone").val();
        var email = $(".email").val();
        var regExp_1 = /^[A-Za-z0-9]{4,8}$/;
        var regExp_4 = /^[A-Za-z0-9]{6,16}$/;
        var regExp_2 = /0?(13|14|15|17|18)[0-9]{9}/;
        var regExp_3 = /\w[-\w.+]*@([A-Za-z0-9][-A-Za-z0-9]+\.)+[A-Za-z]{2,14}/;
        if (!regExp_4.test(password)) {
            alert("密码只能6-16位英文和数字组合！");
            return false;
        }
        if (regExp_2.test(phone)) {
            $('#add-form').submit();
        }
        if (!regExp_3.test(email)) {
            alert("邮箱格式不对");
            return false;
        } else {
            $('#add-form').submit();
        }

    }
</script>



