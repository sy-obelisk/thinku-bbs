$(function () {
    $(".sNext").each(function () {
        $(this).click(function () {
            $(this).addClass("on");
            $(this).siblings(".sPrev").removeClass("on")
        })
    });
    $(".sPrev").each(function () {
        $(this).click(function () {
            $(this).addClass("on");
            $(this).siblings(".sNext").removeClass("on")
        })
    });
    $(".ZX_ve_a").hover(function () {
        $(this).css("color", "#229edc")
    }, function () {
        $(this).css("color", "#888888")
    });
    jQuery("#remen_yicuo").slide({trigger: "click"});
    $("#zhishi_yufa .bd ul li table tr td").hover(function () {
        var a = $(this).find($(".zhishi_in_yuan img"));
        $(this).find($(".zhishi_in_yuan img")).src("../images/tiku_blue_shu.gif")
    });
    //jQuery("#zhishi_yufa").slide({trigger: "click"});
    jQuery("#classJieshao").slide();
    $(".fenlei_CR_top_in .fenlei_CR_top_in_backg").bind({
        "mouseenter": function () {
            var bo_div = $(this).find("div");
            bo_div.animate({"height": "230px", "top": "40px"}, 1000)
        }, "mouseleave": function () {
            var bo_div = $(this).find("div");
            bo_div.animate({"height": "49px", "top": "50%"}, 1000)
        }
    });
    $(".fenlei_CR_top_in .fenlei_CR_top_in_backg02").bind({
        "mouseenter": function () {
            var bo_div = $(this).find("div");
            bo_div.animate({"height": "230px", "top": "40px"}, 1000)
        }, "mouseleave": function () {
            var bo_div = $(this).find("div");
            bo_div.animate({"height": "49px", "top": "50%"}, 1000)
        }
    });
    $(".fenlei_CR_top_inbo .fenlei_CR_top_in_backg").bind({
        "mouseenter": function () {
            var bo_div = $(this).find("div");
            bo_div.animate({"height": "182px", "top": "30px"}, 1000)
        }, "mouseleave": function () {
            var bo_div = $(this).find("div");
            bo_div.animate({"height": "35px", "top": "50%"}, 1000)
        }
    });
    $(".fenlei_CR_top_inbo .fenlei_CR_top_in_backg02").bind({
        "mouseenter": function () {
            var bo_div = $(this).find("div");
            bo_div.animate({"height": "182px", "top": "30px"}, 1000)
        }, "mouseleave": function () {
            var bo_div = $(this).find("div");
            bo_div.animate({"height": "35px", "top": "50%"}, 1000)
        }
    });
    jQuery(".b-desc").slide({trigger: "click"});
    function liPadding(eachLi) {
        $(eachLi).each(function () {
            if ($(this).index() == 4 || $(this).index() == 9 || $(this).index() == 14 || $(this).index() == 19) {
                $(this).css("paddingRight", "0")
            }
        })
    }

    $("#remen_yicuo .bd ul li:nth-child(3n+3)").css("marginRight", "0");
    $("#zhishi_yufa .bd ul li:nth-child(5n+5)").css("marginRight", "0");
    $(".left_ndleix ul li").click(function () {
        //if ($(this).hasClass("on")) {
        //    $("#section").removeAttr("val");
        //    $("#sec_nandu").removeAttr("val");
        //    $(this).removeClass("on")
        //} else {
            $("#section").val($(this).find("a input[name='section']").val());
            $("#sec_nandu").val($(this).find("a input[name='level']").val());
            $(this).addClass("on");
            $(this).siblings().removeClass("on");
            getutkinfo();
        //}
    });
    $(".gaiban_ZN ul li").bind({
        "mouseenter": function () {
            $(this).animate({marginTop: "-10px"})
        }, "mouseleave": function () {
            $(this).animate({marginTop: "0"})
        }
    });
    $(".left_ndleix ul li").each(function () {
        if ($(this).index() == 7) {
            $(this).css("marginRight", "0")
        }
    });
    $(".gg_close").click(function () {
        $(this).parent().hide()
    });
    //改变查看更多链接
   setInterval(function(){
       if($("#remen_yicuo .hd ul li").eq(1).hasClass("on")){
       $("#remen_yicuo .remen_more a").attr("href","index.php?web/exam/timu_list&exte=GF");
   }else{
           $("#remen_yicuo .remen_more a").attr("href","index.php?web/exam/timu_list&exte=YC");
       }
   },1000);


});
//广告随滚动条滚动js
$(document).ready(function () {
    var scrollbox = $(".tiku_guangg");
    var position = scrollbox.position();
    scrollbox.css("top", 20 + $(document).scrollTop());
    $(window).scroll(function () {
        var offsetTop = 20 + $(document).scrollTop();
        scrollbox.stop().animate({top: offsetTop, marginTop: "0"}, {duration: 800, queue: false})
    })
});

function getutkinfo(){
    var section=$("#section").val();
    var level=$("#sec_nandu").val();
    var z='';
    if(z!='' && z!=undefined || z!=null){
        $("#lu_fly").show();
        $(".log_reg_zzc").show();
        var postdata={
            step: $("input[name='step']:checked").val()
        };
        if($("#section").val()!='' && $("#section").val()!='undefined'){
            postdata.sectionid=$("#section").val();
        }
        if($("#sec_nandu").val()!='' && $("#sec_nandu").val()!='undefined'){
            postdata.questionlevel=$("#sec_nandu").val();
        }
        $.ajax({
            url: 'index.php?web/exam/getutk', // ��ת�� action
            data: postdata,
            type: 'post',
            cache: false,
            dataType: 'json',
            success: function (data) {
                if (data.code == 1) {
                    if(data.uallnum>0){
                        $(".mas_start").val("继续做题");
                        $("#tikumsg").html("此题库你已做题数["+data.uallnum+"]题，总题数为["+data.qallnum+"]");
                    }
                    $("#lu_fly").hide();
                    $(".log_reg_zzc").hide();
                }else if(data.code == -1){
                    //$("#tikumsg").html(data.message);//没登录
                    $("#lu_fly").hide();
                    $("#login_register").show();
                }else{
                    $("#tikumsg").html("你还没有做过这个题库噢，请点击马上开始做题~");
                    $(".mas_start").val("马上开始做题");
                    $("#lu_fly").hide();
                    $(".log_reg_zzc").hide();
                }
            },
            error: function () {
                $("#lu_fly").hide();
                $(".log_reg_zzc").hide();
                alert("sorry!,网络通讯失败！");
            }
        });
    }else{
        alert(z);
    }
}
//异步请求获取单项信息
function changeSection(_this,id) {
    var str = "";
    $.post('index.php?web/api/getSectionInfo', {sectionId: id}, function (re) {
        str += '<ul>';
        for (i = 0; i < re.length; i++) {
            str += '<li>';
            str += '<div class="zhishi_in_div';
            if (re[i].ukqnubm > 0) {
                var a = ' zhishiy_greyBG" >';
            } else {
                var a = ' zhishiy_whiteBG" >';
            }
            str += a;
            str += '<a href="index.php?web/exam/tiku_list&knowsid=' + re[i].knowsid + '&name=' + re[i].knows + '">' + re[i].knows + '</a>';
            <!--考小图标div-->
            str += '<div class="zhishi_inWhite_yuan"></div>';
            <!--右边的箭头div-->
            str += '<div class="zhishi_right_div_j"></div>';
            <!--鼠标移上去显示右边的小图标-->
            str += '<div class="zhishi_in_div_img02">';
            str += '<span>共题' + re[i].totalnum + '<br/>';
            if (re[i].ukqnubm > 0) {
                var b = '我做了<b style="color: #d40006;">' + re[i].ukqnubm + '</b>题'
            } else if (re[i].ukqnubm == re[i].totalnum && re[i].totalnum != 0) {
                var b = '已做完';
            } else {
                var b = re[i].num + '人已做'
            }
            str += b
            str += '</span> </div> </div></li>';
        }
        str += '</ul>';
        $(_this).siblings('li').removeClass('on');
        $(_this).addClass('on');
        $('#sectionKnows').html(str);
    }, 'json');

}

    /**
     * 获取单项来源题库
     * @param _this 点击对象
     * @param id 单项Id
     * @param twoId 来源Id
     * @param name 来源名
     */
function changeLowerExam(_this,id,twoId,name){
        var str = "";
        var num = Math.random()*50;
        num = Math.floor(num);
        $.post('index.php?web/api/getLowerInfo', {sectionId: id,twoId:twoId}, function (re) {
            str +='<ul>';
            str +='<div class="bigDiv'+num+'">';
            str +='<div class="sbd">';
            str +='<ul class="smallUl">';
            for (i = 0; i < re.length; i++) {
                str +='<li>';
                    str +='<a href="index.php?web/exam/tiku_list&stid='+re[i].stid+'&sectionid='+re[i].sectionid+'&originid='+re[i].twoobjectid+'&name='+re[i].stname+'">【'+name+'】 '+re[i].stname;
                    str +=' <img src="app/web_core/styles/images/tiku_index_ku_hover.png"';
                    str +='alt="" style="position: relative;top: 3px"></a>';
                    str +='<span style="font-size: 12px;color: #e5696d;"> ';
                if(re[i].userlowertk >0 && typeof(re[i].userlowertk) != 'undefined'){
                    var a = '已做 '+re[i].userlowertk+' 题';
                }else if(re[i].userlowertk == re[i].lowertknumb && re[i].lowertknumb != 0 && typeof(re[i].userlowertk) != 'undefined'){
                        var a = '已做完';
                }else if(re[i].userlowertk == 0 && typeof(re[i].userlowertk) != 'undefined' ){
                            var a = '未做题';
                }else{
                    var a = '';
                }
                str += a;
                str +='</li>';
            }
            str +='</ul>';
            str +='</div>';
            str +='<div class="shd">';
            str +='<a class="sNext"></a>';
            str +='<a class="sPrev"></a>';
            str +='</div>';
            str +='</div>';
            str +='<script type="text/javascript">'
            str +='jQuery(".bigDiv'+num+'").slide({mainCell:".sbd ul.smallUl",autoPage:true,effect:"top",scroll:8,vis:8,trigger:"click",prevCell:".sNext",nextCell:".sPrev",pnLoop:false})';
            str +='</script>';
            str +='</ul>';
            $(_this).siblings('li').removeClass('on');
            $(_this).addClass('on');
            $(_this).closest('.og_head_ul').next('.og_body_ul').html(str);
        }, 'json');
}