$(function () {
    jQuery("#classJieshao").slide({trigger: "click"});
    //$(".jC_lg_div").scroll_absolute({arrows: false});
    $(".guany_jian").click(function () {
        if ($(this).hasClass("on")) {
            $(this).removeClass("on")
        } else {
            $(this).addClass("on")
        }
        $(this).siblings("div.kt_xq_show_rx").slideToggle("slow")
    });

});