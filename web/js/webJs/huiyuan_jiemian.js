$(function () {
    //课程推荐
    $(".hy_cV_in_div").eq(0).css("marginRight","18px");
    $(".hy_cV_in_div").eq(1).css("marginRight","18px");

    $(".hy_l_liebiao li").click(function () {
        var indexLI = $(this).index();
        $(".huiy_r_content").eq(indexLI).show();
        $(".huiy_r_content").eq(indexLI).siblings().hide();
        $(this).css("border", "1px #00b7ff solid");
        $(this).siblings().css("border", "none");
        $(this).find("a").css("color", "#00b6ff");
        $(this).find("a").parent().siblings().find("a").css("color", "black");
        $(this).find("img").show();
        $(this).siblings().find("img").hide();
    });
    if (huiy_num) {
        $(".hy_l_liebiao li").eq(huiy_num - 1).css("border", "1px #00b7ff solid");
        $(".hy_l_liebiao li").eq(huiy_num - 1).siblings().css("border", "none");
        $(".hy_l_liebiao li").eq(huiy_num - 1).find("a").css("color", "#00b6ff");
        $(".hy_l_liebiao li").eq(huiy_num - 1).find("a").parent().siblings().find("a").css("color", "black");
        $(".hy_l_liebiao li").eq(huiy_num - 1).find("img").show();
        $(".hy_l_liebiao li").eq(huiy_num - 1).siblings().find("img").hide();
        $(".huiy_r_content").eq(huiy_num - 1).show();
        $(".huiy_r_content").eq(huiy_num - 1).siblings().hide()
    }

    $("#user_btn").click(function () {
        $(".he_nav_xiala").slideToggle()
    });
    $("#my_phone").blur(function () {
        var reg = /^0{0,1}(13[0-9]|15[0-9]|18[2-9])[0-9]{8}$/;
        if ($(this).val() == "" || !reg.test($(this).val())) {
            $(this).parent().find("span#phone_span").show()
        } else {
            $(this).parent().find("span#phone_span").hide()
        }
    });
    $("#youxiang").blur(function () {
        var reg = /^([a-zA-Z0-9]+[_|\_|\.]?)*[a-zA-Z0-9]+@([a-zA-Z0-9]+[_|\_|\.]?)*[a-zA-Z0-9]+\.[a-zA-Z]{2,3}$/;
        if ($(this).val() == "" || !reg.test($(this).val())) {
            $(this).parent().find("span#youx_span").show()
        } else {
            $(this).parent().find("span#youx_span").hide()
        }
    });
    $("#oldCode").blur(function () {
        var reg = /^[A-Za-z0-9_-]+$/;
        if ($(this).val() == "" || !reg.test($(this).val()) || parseInt($(this).val().length) < 6) {
            $(this).parent().find("span#old_span").show()
        } else {
            $(this).parent().find("span#old_span").hide()
        }
    });
    $("#newCode").blur(function () {
        var reg = /^[A-Za-z0-9_-]+$/;
        if ($(this).val() == "" || !reg.test($(this).val()) || parseInt($(this).val().length) < 6) {
            $(this).parent().find("span#newCode_span").show()
        } else {
            $(this).parent().find("span#newCode_span").hide()
        }
    });
    $("#newCodeTwo").blur(function () {
        var reg = /^[A-Za-z0-9_-]+$/;
        if ($(this).val() == "" || !reg.test($(this).val()) || parseInt($(this).val().length) < 6 || $("#newCode").val() != $(this).val()) {
            $(this).parent().find("span#newCodeTwo_span").show()
        } else {
            $(this).parent().find("span#newCodeTwo_span").hide()
        }
    })
});

function seeJshow(){
    $(".jifen_xiangxi table").slideToggle();
}
function slideZS(self){
    if($(self).hasClass("fa-sort-asc")){
        $(self).addClass("fa-sort-desc");
        $(self).removeClass("fa-sort-asc");
        $(self).next("ol").slideDown("slow");
    }else{
        $(self).addClass("fa-sort-asc");
        $(self).removeClass("fa-sort-desc");
        $(self).next("ol").slideUp("slow");
    }
}
function askLeave(){
    $('.log_reg_zzc').show();
    $('.ask_leave').show();
}
function shenQclose(){
    $('.log_reg_zzc').hide();
    $('.ask_leave').hide();
}
function deletes(self){
    var noteid = $('#noteid').val();
    $.ajax({
        url: 'index.php?web/user/ajaxDelnote', // 跳转到 action
        data: {
            noteid:noteid
        },
        type: 'post',
        cache: false,
        dataType: 'json',
        success: function (data) {
            if (data) {
                $(self).parent().parent().parent().remove();
            }
        },
        error: function () {
            alert("网络通讯失败,请检查网络连接，或者联系网站管理员！");
        }
    });
}
var oldVal='';
function bianji(self){
    var htmls=$(self).parent().siblings("li.teaMess").html();
    $(self).parent().siblings("li.teaMess").html("<textarea>"+htmls+"</textarea>");
    oldVal=$(self).parent().siblings("li.teaMess").find("textarea").val();
    $(self).parent().html('<a href="#" class="biji_delete" onclick="noSaveXG(this,oldVal)">取消</a> <a href="#" class="biji_bianji" onclick="saveXG(this)">保存</a>');
}
function saveXG(self){
    var html=$(self).parent().siblings("li.teaMess").find("textarea").val();
    var id=$(self).parents("ol").next("input").val();
    alert(id);
    $.ajax({
        url: 'index.php?web/user/ajaxeditnote', // 跳转到 action
        data: {
            notes:html,
            noteid:id
        },
        type: 'post',
        cache: false,
        dataType: 'json',
        success: function (data) {
            if (data) {
                $(self).parent().siblings("li.teaMess").html(html);
                $(self).parent().html('<a href="#" class="biji_delete" onclick="deletes(this)">删除</a> <a href="#" class="biji_bianji" onclick="bianji(this)">编辑</a>');
            }
        },
        error: function () {
            alert("网络通讯失败,请检查网络连接，或者联系网站管理员！");
        }
    });


}
function noSaveXG(self,oldVal){
    $(self).parent().siblings("li.teaMess").html(oldVal);
    $(self).parent().html('<a href="#" class="biji_delete" onclick="deletes(this)">删除</a> <a href="#" class="biji_bianji" onclick="bianji(this)">编辑</a>');
}

function showAnswer(self){
    $(self).next("b.banswer").show();
}
