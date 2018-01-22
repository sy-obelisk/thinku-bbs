$(function(){
       $(".classTable ul li").hover(function(){
           $(this).find(".whiteLi img").attr("src","app/web_core/styles/images/VPindex_playB.png");
           $(this).find("div.inzzc").show();
       },function(){
           $(this).find(".whiteLi img").attr("src","app/web_core/styles/images/VPindex_playG.png");
           $(this).find("div.inzzc").hide();
       });


    $(".cRightFont input[type]:hidden").each(function(){
        var sec="",min="",ho="";
         var allS=$(this).val();
        var hour = Math.floor((allS / 60) % 24);      //计算小时
        var minite = Math.floor((allS / 1) % 60);      //计算分
        var second = Math.floor((allS*60)%60);             // 计算秒（floor向下取整;Math.ceil向上取整,有小数就整数部分加1）
        if(second<=0){
            sec="";
        }else{
            sec=second+"秒";
        }
        if(minite<=0){
            min="";
        }else{
            min=minite+"分钟";
        }
        if(hour<=0){
            ho="";
        }else{
            ho=hour+"小时";
        }
        $(this).next("span.totalTime").html(ho+min+sec);
    });
});
