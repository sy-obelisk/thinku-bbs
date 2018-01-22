$(function(){
    $("#send").click(function(){
        var emails = $("#email").val();
        $(this).attr("disabled","disabled");
        $.post("index.php?web/information/mail",{emails:emails},function(msg){
            if(msg==1){
                $("#result").html("发送成功，请注意查收您的邮件！");
            }else{
                $("#result").html(msg);
            }
            $(this).removeAttr("disabled");
        });
    });


});


function webYZ(self,reg){
    $(self).bind({
        'focus':function(){
        },
        'blur':function(){
            var textVal=$(this).val();
            var regs= reg;
            if($(this).val() && !regs.test(textVal)){
                $(this).parent().find("span.spanTishi").show();
            }else{
                $(this).parent().find("span.spanTishi").hide();
            }
        }
    });
}
function information(){
    //获取值
    var nickname=$("#ws_nickname").val();//昵称
    var phone=$("#regPhone").val();//手机号
    var Phonecode=$("#regPhonecode").val();//短信验证码
    var email=$("#email").val();//邮箱
    var remailCode=$("#emailCode").val();//邮箱验证码
    var reqq=$("#ws_qq").val();//qq
    var reschool=$("#ws_school").val();//学校
    var rezhuanye=$("#ws_zhuanye").val();//专业
    var reclass=$("#ws_class").val();//年级
    var recity=$("#ws_city").val();//所在城市
    if(!nickname || !phone || !Phonecode || !email ||!remailCode || !reqq || !reschool || !rezhuanye || !reclass || !recity){
        alert("请把信息填写完整再提交！");
        return false;
    }
    $.ajax({
        url: 'index.php?web/information/mation', // 跳转到 action
        data: {
            nickname: nickname,
            phone: phone,
            Phonecode:Phonecode,
            email:email,
            remailCode:remailCode,
            reqq:reqq,
            reschool:reschool,
            rezhuanye:rezhuanye,
            reclass:reclass,
            recity:recity
        },
        type: 'post',
        cache: false,
        dataType: 'json',
        success: function (data) {
               if(data.code==1){
                   alert('更新成功！');
                   location.href='index.php?web/index';
               }else if(data.code==2){
                   $("#regPhonecode").val("");
                   $("#regPhone").next("span").html(data.message);
                   $("#regPhone").next("span").show();
               }else if(data.code==3){
                   $("#regPhonecode").next().next("span").html(data.message);
                   $("#regPhonecode").next().next("span").show();
               }else if(data.code==4){
                   $("#emailCode").val("");
                   $("#email").next("span").html(data.message);
                   $("#email").next("span").show();
               }else if(data.code==5){
                   $("#emailCode").next().next("span").html(data.message);
                   $("#emailCode").next().next("span").show();
               }else if(data.code==6){
                   $("#ws_qq").next("span").html(data.message);
                   $("#ws_qq").next("span").show();
               }else{
                alert('更新失败！请重试！');
               }
        },
        error: function () {
            $("#lu_fly").hide();
            $(".log_reg_zzc").hide();
            alert("网络通讯失败,请检查网络连接，或者联系网站管理员！");
        }
    });
}