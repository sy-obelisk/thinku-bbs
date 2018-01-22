$(function () {
    var chihui = $("#on_cihui").html().split("/");
    var chNum = chihui[0] / 170 * 100;
    $(".score_beizi02 div.heightDiff").css("height", chNum + "%");
    var tw_sc = $("#tw_sc").html().split("/");
    var chNumT = tw_sc[0] / 405 * 100;
    $(".score_beizi02 div.heightDiff02").css("height", chNumT + "%");
    var th_q = $("#th_q").html().split("/");
    var chNumTh = th_q[0] / 225 * 100;
    $(".score_beizi02 div.heightDiff03").css("height", chNumTh + "%");
    var a=$("#scoreInput").val();
    var b=Math.round(a/10)*10;
    $("#scoreAll").html(b);
});