$(function () {

    //固定部分控制背景颜色
    $(".fixed_div_img").hover(function(){
        $(this).css("background","#00a1e8");
    },function(){
        $(this).css("background","#b2b2b2");
    });
    //头部选中效果
    var url = window.location.search;
    var urlS = url.split("/")[1];
    if (urlS == "exam") {
        $(".head_nav ul li").eq(1).addClass("on")
    } else if (urlS == "index") {
        $(".head_nav ul li").eq(0).addClass("on")
    }
    else {
        if (urlS == "modeltest") {
            $(".head_nav ul li").eq(2).addClass("on")
        } else {
            if (urlS == "ceping") {
                $(".head_nav ul li").eq(3).addClass("on")
            } else {
                if (urlS == "publicclass") {
                    $(".head_nav ul li").eq(5).addClass("on")
                } else {
                    if (urlS == "livelesson") {
                        $(".head_nav ul li").eq(6).addClass("on")
                    } else {
                        if (urlS == "teacherintroduce") {
                            $(".head_nav ul li").eq(7).addClass("on")
                        }
                    }
                }
            }
        }
    }

    jQuery(".lr_whiteBG").slide({trigger: "click"});
    $(".login_qita").mouseenter(function () {
        $(".hover_add_rl").show()
    });
    $(".hover_add_rl").mouseleave(function () {
        $(".hover_add_rl").hide()
    });
    $(".login_qita02").mouseenter(function () {
        $(".hover_add_rl02").show()
    });
    $(".hover_add_rl02").mouseleave(function () {
        $(".hover_add_rl02").hide()
    });

    $(".login_head_btn").click(function () {
        $("#login_register").show();
        $(".log_reg_zzc").show();
        //$(".lr_whiteBG_hb .hd ul .login").trigger("click")
    });
    $(".he_nav_register").click(function () {
        $("#reg_register02").show();
        $(".log_reg_zzc").show();
        //$(".lr_whiteBG_hb .hd ul .reg").trigger("click")
    });
    $("#log_username").blur(function () {
        var reg = /^0{0,1}(13[0-9]|15[7-9]|153|156|18[2-9])[0-9]{8}$/;
        if ($(this).val() == "" || !reg.test($(this).val())) {
            $(this).parent().find("span").show()
        } else {
            $(this).parent().find("span").hide()
        }
    });
    $("#log_password").blur(function () {
        var reg = /^[A-Za-z0-9_-]+$/;
        if ($(this).val() == "" || !reg.test($(this).val()) || parseInt($(this).val().length) < 6) {
            $(this).parent().find("span").show()
        } else {
            $(this).parent().find("span").hide()
        }
    });
    $("#phone").blur(function () {
        var reg = /^0{0,1}(13[0-9]|15[0-9]|18[2-9])[0-9]{8}$/;
        if ($(this).val() == "" || !reg.test($(this).val())) {
            $(this).parent().find("span").show()
        } else {
            $(this).parent().find("span").hide()
        }
    });
    $("#password").blur(function () {
        var reg = /^[A-Za-z0-9_-]+$/;
        if ($(this).val() == "" || !reg.test($(this).val()) || parseInt($(this).val().length) < 6) {
            $(this).parent().find("span").show()
        } else {
            $(this).parent().find("span").hide()
        }
    });
    $("#mes_yzm").blur(function () {
        var reg = /^[0-9]{6}$/;
        if ($(this).val() == "" || !reg.test($(this).val())) {
            $(this).parent().find("span").show()
        } else {
            $(this).parent().find("span").hide()
        }
    });
    $(".vip_huiy").mouseenter(function () {
        $(".he_nav_xiala").show()
    });
    $(".vip_huiy").mouseleave(function () {
        $(".he_nav_xiala").hide()
    });
    $(".he_nav_li_hoverT").mouseenter(function () {
        $(this).find("div.zN_zzc").show()
    });
    $(".he_nav_li_hoverT").mouseleave(function () {
        $(this).find("div.zN_zzc").hide()
    });

    $("#goRegister").click(function () {
        $("#login_register").hide();
        $("#reg_register02").show();
    });
    $("#goLogin").click(function () {
        $("#login_register").show();
        $("#reg_register02").hide();
    });
    jQuery(".twoRegHd").slide({trigger:"click"});
    //广告窗关闭按钮
    $(".jiqir_close02").click(function(){$(this).parent().hide()});
});

function clickDX(e) {
    //var _that = $(".reg_free_yzm_div");
    var _that =  $(e);
    var timeNum = 60;
    $(e).removeAttr("onclick");
    _that.unbind("click").val(timeNum + "秒后重新发送");
    var timer = setInterval(function () {
        _that.val(timeNum + "秒后重新发送");
        timeNum--;
        if (timeNum <= 0) {
            clearInterval(timer);
            _that.val("免费获取验证码");
            _that.bind("click", e, get_Phonecode)
        }
    }, 1000)
}
function isStrictMode() {
    return document.compatMode != "BackCompat"
}
function getHeight() {
    return isStrictMode() ? Math.max(document.documentElement.scrollHeight, document.documentElement.clientHeight) : Math.max(document.body.scrollHeight, document.body.clientHeight)
}
function getWidth() {
    return isStrictMode() ? Math.max(document.documentElement.scrollWidth, document.documentElement.clientWidth) : Math.max(document.body.scrollWidth, document.body.clientWidth)
}
//遮罩层
$(window).load(function(){
    var wenzW = getWidth();
    var wenzH = getHeight();
    $(".log_reg_zzc").css({"width": wenzW + "px", "height": wenzH + "px"});
});

function zhisyZZC(width, height, rightTopClose, backImg, btnNum, btnOneFont, btnTwoFontL, btnTwoFontR) {
    $(".log_reg_zzc").show();
    $(".zishiy_zzcDiv").css({"width": width + "px", "height": height + "px", "display": "block"});
    if (rightTopClose == "show") {
        $(".zishiy_zzcDiv .zzcDiv_head .head_center .head_center_close").show();
        $(".zishiy_zzcDiv .zzcDiv_head .head_center .head_center_close").click(function () {
            $(this).parents("div.zishiy_zzcDiv").hide();
            $(".log_reg_zzc").hide()
        })
    } else {
        $(".zishiy_zzcDiv .zzcDiv_head .head_center .head_center_close").hide()
    }
    if (backImg.indexOf("/") > 0) {
        $(".zishiy_zzcDiv .zzcDiv_content .content_center img.content_center_img").attr("src", backImg)
    } else {
        $(".zishiy_zzcDiv .zzcDiv_content .content_center p").html(backImg)
    }
    if (btnNum == 1) {
        $(".zishiy_zzcDiv .zzcDiv_content .content_center input.content_center_btn").show();
        $(".zishiy_zzcDiv .zzcDiv_content .content_center input.content_center_btn2").hide();
        $(".zishiy_zzcDiv .zzcDiv_content .content_center span.content_center_font").hide();
        $(".zishiy_zzcDiv .zzcDiv_content .content_center input.content_center_btn").val(btnOneFont)
    } else {
        $(".zishiy_zzcDiv .zzcDiv_content .content_center input.content_center_btn").hide();
        $(".zishiy_zzcDiv .zzcDiv_content .content_center input.content_center_btn2").show();
        $(".zishiy_zzcDiv .zzcDiv_content .content_center span.content_center_font").show();
        $(".zishiy_zzcDiv .zzcDiv_content .content_center input.content_center_diff").val(btnTwoFontL);
        $(".zishiy_zzcDiv .zzcDiv_content .content_center input.content_center_diff2").val(btnTwoFontR)
    }
    $(".zishiy_zzcDiv .zzcDiv_content .content_center input.content_center_btn").click(function () {
        $(this).parents("div.zishiy_zzcDiv").hide();
        $(".log_reg_zzc").hide()
    })

}

//关闭遮罩层
function closeRL(self) {
    $(self).parent().parent().parent().hide();
    $(".log_reg_zzc").hide();
}
//验证函数
function webYZ(self, reg, lengthNum) {
    $(self).bind({
        'focus': function () {

        },
        'blur': function () {
            var textVal = $(this).val();
            var regs = reg;
            if (!$(this).val() || !regs.test(textVal) || $(this).val().length < lengthNum) {
                $(this).parent().find("span.miss_login").show();
            } else {

                $(this).parent().find("span.miss_login").hide();
            }
        }
    });
}
//头部搜索
function seaEnter(event){
    if(event.keyCode==13){
        searchEnter($("#keywords").next("div"));
    }
}

function searchEnter(e){
    var k=$(e).prev("input#keywords").val();
    if(typeof(k)!='undefined')
    {
        var url="index.php?web/exam/timu_list&keywords="+encodeURIComponent(k);
        window.location.href=url;
    }
}
