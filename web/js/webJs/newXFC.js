$(function () {
    jQuery(".big_blueBG").slide({
        titCell: ".hd ul",
        mainCell: ".bd ul",
        autoPage: true,
        effect: "top",
        vis: 1,
        trigger: "click",
        pnLoop: false
    });
    $(".tubiao_div").bind({
        "mouseenter": function () {
            $(this).find("div.tubiao_zzc").show()
        }, "mouseleave": function () {
            $(this).find("div.tubiao_zzc").hide()
        }
    })
});