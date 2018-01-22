$(function(){

//    轮播
    jQuery(".z_lunbo").slide({mainCell:".bd ul",autoPlay:true,trigger:"click"});

//    核心考点梳理
$(".hexing_shuli ul li .shuli_img").hover(function(){
    $(this).find("img").animate({
        "marginTop":"-10px"
    });
},function(){
    $(this).find("img").animate({
        "marginTop":"0"
    });
});
//题目难度练习
    jQuery(".timu_ldlx").slide({trigger:"click"});
//课程音频
    jQuery(".re_p_con_left").slide({trigger:"click"});
//资源下载下面的小轮播
    jQuery(".re_p_con_right").slide({mainCell:".bd ul",autoPlay:true,trigger:"click"});
//公开课、直播课小圆点
    $(".public_zhibo .public_zb_head ul li").click(function(){
        $(this).find("img").show();
        $(this).siblings().find("img").hide();
    });
//公开课、直播课点击
    jQuery(".public_zhibo").slide({trigger:"click"});

    // ================================首页的流动遮罩层效果=========================================
    $(".grade_pic ul li:nth-child(n+6)").css('margin-bottom','0');
    $(".grade_pic ul li:nth-child(5n+5)").css('margin-right','0');
    $('.author_pic_box:nth-child(4n+4)').css('margin-right','0');
    $('.last_dev_left ul li:last-child').css('border-bottom','0');
    //精品免费公开课
    $('.con_hover').mouseover(function(){
        $(this).find('.con_hov_show').show();
        $(this).find('.con_hov_hide').hide();
        $(this).find('.author_name_hov').stop().animate({top:'0'},{duration:500}).css('height','215px');
        $(this).find('.author_name_hov').addClass('ath_bg_black');
        $(this).find('.author_name_hov p').css('marginTop','10px');
    });
    $('.con_hover').mouseleave(function(){
        $('.con_hov_show').hide();
        $('.con_hov_hide').show();
        $('.author_name_hov').stop().animate({top:'164px'},{height:'63px'},{duration:500});
        $('.author_name_hov').removeClass('ath_bg_black');
        $(this).find('.author_name_hov p').css('marginTop','');
    });
//免费课程
    $(this).find('.new_class_show').mouseover(function(){
        $(this).find('.new_mask_jl').show();
    })
    $('.new_class_show').mouseleave(function(){
        $('.new_mask_jl').hide();
    })
//逐题精讲课程
    $(this).find('.she_mask').mouseover(function(){
        $(this).find('.new_zt_mask').hide();
        $(this).find('.new_zt_mask1').show();
    });
    $('.she_mask').mouseleave(function(){
        $('.new_zt_mask').show();
        $('.new_zt_mask1').hide();
    });
    //    ================================首页的流动遮罩层效果 end=========================================
//自适应模考
    $(".zsy_znzj").hover(function(){
        $(this).stop().animate({
            fontSize:'30px'
        });
    },
        function(){
            $(this).stop().animate({
                fontSize:'28px'
            });
        });

//    名师团队
    $(".teacherTeam ul li").mouseenter(function(){
        $(this).find("div").animate({
            "height":"294px"
        },500);
        $(this).find("div p.hideP").show();
        $(this).find("div p.pamanda").css("marginTop","41px");
        $(this).find("div span.showSpan").hide();
    });
    $(".teacherTeam ul li").mouseleave(function(){
        $(this).find("div").animate({
            "height":"71px"
        },500);
        $(this).find("div p.hideP").hide();
        $(this).find("div p.pamanda").css("marginTop","15px");
        $(this).find("div span.showSpan").show();

    });
});





