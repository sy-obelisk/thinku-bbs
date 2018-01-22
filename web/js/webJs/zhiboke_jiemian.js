$(function(){
    //    ==============================================直播课界面js===========================================

    $(".zb_he_l_small").bind({

        "mouseenter":function(){
            $(this).find("img").animate({
                "width":"161px",
                "marginLeft":"-10px",
                "marginTop":"-10px"
            })
        },"mouseleave":function(){
            $(this).find("img").animate({
                "width":"139px",
                "marginLeft":"0",
                "marginTop":"0"
            })
        }
    });

    $("#zhibo_gmat_amanda ul li").live("mouseenter","#zhibo_gmat_amanda ul li",function(){
        $(this).find("div").animate({
            "height":"192px"
        },500);
        $(this).find("div .zhibo_show_font").show();
        $(this).find("div .zhibo_amanda_font").hide();
    });
    $("#zhibo_gmat_amanda ul li").live("mouseleave","#zhibo_gmat_amanda ul li",function(){
        $(this).find("div").animate({
            "height":"42px"
        },500);
        $(this).find("div .zhibo_show_font").hide();
        $(this).find("div .zhibo_amanda_font").show();

    });
//雷哥GMAT名师介绍
    jQuery("#zhibo_gmat_amanda").slide({mainCell:".zhibo_gmat_img_lunbo ul",autoPage:false,effect:"leftLoop",vis:5,trigger:"click",mouseOverStop:true});

    jQuery("#zhibo_kc_rili").slide({trigger:"click"});

    $(".zb_ke_rili_body_right ul li:nth-child(7n)").css("marginRight","0");
    //六月
    hoverClass(".body_rightOne ul li.on","div.body_left_center1 span","div.body_left_center2");
    //七月
    hoverClass(".body_rightTwo ul li.on","div.body_left_center1 span","div.body_left_center2");

});
function hoverClass(clickEle,changeSpan,changeSpanTwo){
    $(clickEle).hover(function(){
        $(this).parent().parent().siblings("div.zb_ke_rili_body_left").find(changeSpan).html($(this).find("a").html());
        var changeNum=$(this).find("a").html();
        var inputHtml=$(this).parent().parent().siblings("input:hidden").val();
        if(inputHtml=="1"){
            switch (parseInt(changeNum)){
                case 12: $(this).parent().parent().siblings("div.zb_ke_rili_body_left").find(changeSpanTwo).html(" <p>【GMAT在线强化课程（周末）】</p> <p style='font-size: 18px;'>时间：2015.09.12 9:30-16:00</p><p> <a>正在上课中</a></p>");
                    break;
                case 13: $(this).parent().parent().siblings("div.zb_ke_rili_body_left").find(changeSpanTwo).html("<p>【GMAT在线强化课程（周末）】</p> <p style='font-size: 18px;'>时间：2015.09.13 9:30-16:00</p><p> <a>正在上课中</a></p>");
                    break;
                
                case 17: $(this).parent().parent().siblings("div.zb_ke_rili_body_left").find(changeSpanTwo).html(" <p>【GMAT在线强化课程（晚班）】</p> <p style='font-size: 18px;'>时间：2015.09.17 19:00-21:00</p><p> <a>正在报名中</a></p>");
                    break;
                case 18: $(this).parent().parent().siblings("div.zb_ke_rili_body_left").find(changeSpanTwo).html(" <p>【GMAT在线强化课程（晚班）】</p> <p style='font-size: 18px;'>时间：2015.09.18 19:00-21:00</p><p> <a>正在报名中</a></p>");
                    break;
                case 19: $(this).parent().parent().siblings("div.zb_ke_rili_body_left").find(changeSpanTwo).html("<p>【GMAT在线强化课程（周末）】</p> <p style='font-size: 18px;'>时间：2015.09.19 9:30-16:00</p><p> <a>正在报名中</a></p>");
                    break;
                case 20: $(this).parent().parent().siblings("div.zb_ke_rili_body_left").find(changeSpanTwo).html("<p>【GMAT在线强化课程（周末）】</p> <p style='font-size: 18px;'>时间：2015.09.20 9:30-16:00</p><p> <a>正在报名中</a></p>");
                    break;
                case 21: $(this).parent().parent().siblings("div.zb_ke_rili_body_left").find(changeSpanTwo).html("<p>【GMAT在线强化课程（晚班）】</p> <p style='font-size: 18px;'>时间：2015.09.21 19:00-21:00</p><p> <a>正在报名中</a></p>");
                    break;
                case 22: $(this).parent().parent().siblings("div.zb_ke_rili_body_left").find(changeSpanTwo).html("<p>【GMAT在线强化课程（晚班）】</p> <p style='font-size: 18px;'>时间：2015.09.22 19:00-21:00</p><p> <a>正在报名中</a></p>");
                    break;
                case 23: $(this).parent().parent().siblings("div.zb_ke_rili_body_left").find(changeSpanTwo).html("<p>【GMAT在线强化课程（晚班）】</p> <p style='font-size: 18px;'>时间：2015.09.23 19:00-21:00</p><p> <a>正在报名中</a></p>");
                    break;
                case 24: $(this).parent().parent().siblings("div.zb_ke_rili_body_left").find(changeSpanTwo).html("<p>【GMAT在线强化课程（晚班）】</p> <p style='font-size: 18px;'>时间：2015.09.24 19:00-21:00</p><p> <a>正在报名中</a></p>");
                    break;
                case 25: $(this).parent().parent().siblings("div.zb_ke_rili_body_left").find(changeSpanTwo).html("<p>【GMAT在线强化课程（晚班）】</p> <p style='font-size: 18px;'>时间：2015.09.25 19:00-21:00</p><p> <a>正在报名中</a></p>");
                    break;
                case 26: $(this).parent().parent().siblings("div.zb_ke_rili_body_left").find(changeSpanTwo).html("<p>【GMAT在线强化课程（周末）】</p> <p style='font-size: 18px;'>时间：2015.09.26 9:30-16:00</p><p> <a>正在报名中</a></p>");
                    break;
                case 27: $(this).parent().parent().siblings("div.zb_ke_rili_body_left").find(changeSpanTwo).html("<p>【GMAT在线强化课程（周末）】</p> <p style='font-size: 18px;'>时间：2015.09.27 9:30-16:00</p><p> <a>正在报名中</a></p>");
                    break;
                case 28: $(this).parent().parent().siblings("div.zb_ke_rili_body_left").find(changeSpanTwo).html("<p>【GMAT在线强化课程（晚班）】</p> <p style='font-size: 18px;'>时间：2015.09.28 19:00-21:00</p><p> <a>正在报名中</a></p>");
                    break;
                case 29: $(this).parent().parent().siblings("div.zb_ke_rili_body_left").find(changeSpanTwo).html("<p>【GMAT在线强化课程（晚班）】</p> <p style='font-size: 18px;'>时间：2015.09.29 19:00-21:00</p><p> <a>正在报名中</a></p>");
                    break;
                case 30: $(this).parent().parent().siblings("div.zb_ke_rili_body_left").find(changeSpanTwo).html("<p>【GMAT在线强化课程（晚班）】</p> <p style='font-size: 18px;'>时间：2015.09.30 19:00-21:00</p><p> <a>正在报名中</a></p>");
                    break;
            }
    }else if(inputHtml=="2"){
            switch (parseInt(changeNum)){
                case 1: $(this).parent().parent().siblings("div.zb_ke_rili_body_left").find(changeSpanTwo).html(" <p>【GMAT在线强化课程(国庆班)】</p> <p style='font-size: 18px;'>时间：2015.10.01 9:30-16:00</p><p> <a>正在报名中</a></p>");
                    break;
                case 2: $(this).parent().parent().siblings("div.zb_ke_rili_body_left").find(changeSpanTwo).html("<p>【GMAT在线强化课程(国庆班)】</p> <p style='font-size: 18px;'>时间：2015.10.02 9:30-16:00</p><p> <a>正在报名中</a></p>");
                    break;
                case 3: $(this).parent().parent().siblings("div.zb_ke_rili_body_left").find(changeSpanTwo).html("<p>【GMAT在线强化课程(国庆班)】</p> <p style='font-size: 18px;'>时间：2015.10.03 9:30-16:00</p><p> <a>正在报名中</a></p>");
                    break;
                case 4: $(this).parent().parent().siblings("div.zb_ke_rili_body_left").find(changeSpanTwo).html("<p>【GMAT在线强化课程(国庆班)】</p> <p style='font-size: 18px;'>时间：2015.10.04 9:30-16:00</p><p> <a>正在报名中</a></p>");
                    break;
                case 5: $(this).parent().parent().siblings("div.zb_ke_rili_body_left").find(changeSpanTwo).html("<p>【GMAT在线强化课程(国庆班)】</p> <p style='font-size: 18px;'>时间：2015.10.05 9:30-16:00</p><p> <a>正在报名中</a></p>");
                    break;
                case 6: $(this).parent().parent().siblings("div.zb_ke_rili_body_left").find(changeSpanTwo).html(" <p>【GMAT在线强化课程(国庆班)】</p> <p style='font-size: 18px;'>时间：2015.10.06 9:30-16:00</p><p> <a>正在报名中</a></p>");
                    break;

            }
        }


    });
}
