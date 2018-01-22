$(function(){
    $(".name").click(function(){
        $(this).siblings("div.child").slideToggle();
    });
    jQuery(".suit_qiehuan").slide({trigger:"click"});

  $(".videoHideT").each(function(){
      var sec="",min="",ho="";
      var alltime=$(this).val();
      var hour = Math.floor((alltime / 60) % 24);      //计算小时
      var minite = Math.floor((alltime / 1) % 60);      //计算分
      var second = Math.floor((alltime*60)%60);             // 计算秒（floor向下取整;Math.ceil向上取整,有小数就整数部分加1）
      if(second<10){
          sec="0"+second;
      }else{
          sec=second;
      }
      if(minite<10){
          min="0"+minite;
      }else{
          min=minite;
      }
      if(hour<10){
          ho="0"+hour;
      }else{
          ho=hour;
      }
      $(this).next("span.videoTime").html(ho+":"+min+":"+sec);
});
    var url=window.location.search.split("&")[1].split("=")[1];
 $(".contentid").each(function(){
     if($(this).val()==url){
         $(this).parent().parent().addClass("text-active");
         $(this).parent().parent().next('a.note-span').addClass("note-active");
         $(this).parent().parent().prev('span.icon').addClass("icon-active");
         $(this).parent().parent().parents(".item").siblings().find(".text").removeClass("text-active");
         $(this).parent().parent().parents(".item").siblings().find(".note-span").removeClass("note-active");
         $(this).parent().parent().parents(".item").siblings().find(".icon").removeClass("icon-active");
         if($(this).parent().parent().prev('span.icon').attr("visibility")!="hidden"){
             $(this).parent().parent().prev('span.icon').html('<i class="fa fa-play"></i>');
             $(this).parent().parent().parents(".item").siblings().find(".icon").html("试听");
         }
     }
 });
});
var flag=true;
//防止浏览器窗口缩小错位
$(window).resize(function() {
    showClass(".classHead");
});
function showClass(self){
    $(".tea_head").find("span")[0].style.visibility="hidden";
    var width=$(".videoRight").width();
    $(".videoRight").css("overflow","inherit");
    $(self).parent().css({
        right:width+"px"
    });
    $(self).html('<span><i class="fa fa-angle-double-right"></i> 收起课程大纲</span>');
    flag=false;
}
function zhuanH(self){
    //$(self).find("span").hide();
    $(self).find("span")[0].style.visibility="hidden";
    addWidth($(".classHead"));
}

function addWidth(self){
    var width=$(".videoRight").width();
    if(flag){
        $(".videoRight").css("overflow","inherit");
        $(self).parent().animate({
            right:width+"px"
        });
        flag=false;
        $(self).html('<span><i class="fa fa-angle-double-right"></i> 收起课程大纲</span>');
    }else{
        $(self).parent().animate({
            right:"0"
        },100,function(){
            $(".videoRight").css("overflow","hidden");
            //$(".tea_head").find("span").show();
            $(".tea_head").find("span")[0].style.visibility="inherit";
        });
        flag=true;
        $(self).html('<span><i class="fa fa-angle-double-left"></i> 展开课程大纲</span>');
    }

}

function remeberBJ(self){
    var zhud=$(self).parent().siblings("div.toolbar").find("span.cur").html();
    var timeZ=$(self).parent().siblings("div.toolbar").find("span span.timeZ");
    if(!zhud){
        timeZ.html("00:00:00");
    }else{
        timeZ.html(zhud);
    }
}
function timeShow(self){
    $(self).parent().siblings("div.toolbar").show();
    remeberBJ(self);
}
function suitangEnterPress(event){
    if(event.keyCode == 13){
        exchange($(".enter").eq(0));
    }
}
function bijiEnterPress(event){
    if(event.keyCode == 13){
        enterMess($(".enter").eq(1));
    }
}
function timeHide(self){
    $(self).parent().siblings("div.toolbar").hide();
}

var biaoQ=true;
function biaoQing(self){
    if(biaoQ){
        $(self).siblings("div.emoji-div").show();
        biaoQ=false;
    }else{
        $(self).siblings("div.emoji-div").hide();
        biaoQ=true;
    }

}
    function smileOnc(self){
      var input=$(self).parent().siblings("input[type='text']");
      var name=$(self).attr("dt-name");
      input.val(input.val()+"["+name+"]");
    }
    var mkf=true;
    function yuyMKF(self){
    if(mkf){
        $(self).addClass("yuyMt");
        $(self).siblings("div.shuruK").hide();
        $(self).siblings("div.shezhiMKF").show();
        mkf=false;
    }else{
        $(self).removeClass("yuyMt");
        $(self).siblings("div.shuruK").show();
        $(self).siblings("div.shezhiMKF").hide();
        mkf=true;
    }

}
    function currTime(self){
    var time=$(self).find("span.bijiTime").html().split(":");
    var h=time[0];
    var m=time[1];
    var s=time[2];
    var total=parseInt(h)*3600+parseInt(m)*60+parseInt(s);
    var video=$("#video")[0];
    video.currentTime=total;
    $("#video").attr("autoplay","autoplay");
}
    function showCH(self){
    $(self).find("a.ch").show();
    }
    function hideCH(self){
    $(self).find("a.ch").hide();
    }
    function showSure(self){
    $(self).siblings("div").show();
    }
    function noSure(self){
    $(self).parent().hide();
    }

//播放多段视频
function videoSrc(){
    var a= $("#video").attr("mself");
        if($("#nowTime").val()==$("#totalTime").val()){
                $("#video").attr("mself",$(".moreVideo").eq(a).attr("mself"));
                $("#video").attr("src",$(".moreVideo").eq(a).val());
        }
}
    function getLocalTime(nS) {
         return new Date(parseInt(nS) * 1000).toLocaleString().replace(/:\d{1,2}$/,' ');
    }
//切换内容
    function showLeft(self){
        $(self).addClass("text-active");
        $(self).next('a.note-span').addClass("note-active");
        $(self).prev('span.icon').addClass("icon-active");
        $(self).parents(".item").siblings().find(".text").removeClass("text-active");
        $(self).parents(".item").siblings().find(".note-span").removeClass("note-active");
        $(self).parents(".item").siblings().find(".icon").removeClass("icon-active");
        if($(self).prev('span.icon').attr("visibility")!="hidden"){
            $(self).prev('span.icon').html('<i class="fa fa-play"></i>');
            $(self).parents(".item").siblings().find(".icon").html("试听");
        }
    //var obj=$("div.bdContent");
    //obj.animate({scrollTop:obj[0].scrollHeight+"px"},1000);
    var id= $(self).find("span input[type='hidden']").val();
    var mrId = $("#mrid").val();
    if(id){
        var contentid = id;
    }else{
        var contentid = mrId;
    }
    var username =$("#username").val();
    $.ajax({
        url: 'index.php?web/video/ajaxvideo', // 跳转到 action
        data: {
            contentId:contentid
        },
        type: 'POST',
        cache:false,
        dataType:'json',
        success: function (data) {
            if (data) {
                var teastr ="";
                var notestr="";
                var exchangestr="";
                    teastr+='<div class="leftImg"><img src="'+data.teach+'" width="83" height="83" alt=""></div>'+
                    '<div class="rightFont">'+
                    '<b><a href="index.php?web/teacherintroduce/shizi_xq&contentid='+data.teachid+'">'+data.teacher+'</a></b>'+
                    '<ol>'+
                    '<li style="width: 150px">'+data.teachValue+'</li>'+
                    '</ol>'+
                    '</div>'+
                    '<input class="contentidnote" type="hidden" value="'+data.contentid+'">'+
                    '<input class="extendid" type="hidden" value="'+data.extendid+'">'+
                    '<div style="clear: both"></div>';
                    $.each(data.note.notes,function(k,v) {
                        notestr += '<div class="message">' +
                        '<div class="container">' +
                        '<div class="header">' +
                        '<div class="username">' + data.note.username + '</div>' +
                        '<div class="button" style="display: none;">' +
                        '<span class="item zan-btn">赞(<font>0</font>)</span>' +
                        '<span class="item share-btn">分享</span>' +
                        '</div>' +
                        '<div class="clear"></div>' +
                        '</div>' +
                        '<div class="content">' +
                        '<span class="triangle"></span>' +
                        '<span class="text">' + v.notes + '</span>' +
                        '</div><div class="clear">' +
                        '</div>' +
                        '<div class="slide">' +
                        '<span class="slide-icon">' +
                        '<i class="fa fa-play"></i>' +
                        '</span>' + v.videoTimePoint + '</div></div>' +
                        '<div class="clear">' +
                        '</div></div>';
                    });
                    $.each(data.exchange.exchanges,function(k,v) {
                        var time=getLocalTime(v.recordingTime).split(" ")[1].substring(2);
                        if(v.username == username ){
                            exchangestr +='<div class="time">'+time+'</div>'+
                            '<div class="message message-me">'+
                            '<img class="photo" src="'+v.photo+'">'+
                            ' <div class="container" onmouseover="showCH(this)" onmouseout="hideCH(this)">'+
                            '<div class="header">'+
                            '<div class="username">'+v.username+'</div>'+
                            '<div class="clear"></div></div>'+
                            '<div class="content">'+
                            '<span class="triangle"></span>'+
                            '<span class="text">'+v.exchange+'</span>'+
                            '</div>'+
                            '<a href="javascript:;" class="chehui ch">'+
                            '<span onclick="showSure(this)">撤回</span>'+
                            '<div>'+
                            '<span class="jianjian"></span>'+
                            '<span onclick="noSure(this)">取消</span>&nbsp;&nbsp;'+
                            '<span  onclick="sure(this)">确认</span>'+
                            '<input type="hidden" class="exchangeid_n" value="'+ v.exchangeid+'">'+
                            '</div>'+
                            '</a>'+
                            '</div>'+
                            '<div class="clear"></div>'+
                            '<div class="slide timePos " onclick="currTime(this)">'+
                            '<span class="slide-icon">'+
                            '<i class="fa fa-play"></i>'+
                            '</span>'+
                            '<span class="bijiTime">'+v.videoTimePoint+'</span>'+
                            '</div>'+
                            '</div>' +
                            '</div>';
                        }else{
                            var time02=getLocalTime(v.recordingTime).split(" ")[1].substring(2);
                            exchangestr +='<div class="time">'+time02+'</div>'+
                            '<div class="message">'+
                            '<img class="photo" src="'+v.photo+'">'+
                            ' <div class="container" onmouseover="showCH(this)" onmouseout="hideCH(this)">'+
                            '<div class="header">'+
                            '<div class="username">'+v.username+'</div>'+
                            '<div class="clear"></div></div>'+
                            '<div class="content">'+
                            '<span class="triangle"></span>'+
                            '<span class="text">'+v.exchange+'</span>'+
                            '</div>'+
                            '</div>'+
                            '<div class="clear"></div>'+
                            '<div class="slide timePos02 " onclick="currTime(this)">'+
                            '<span class="slide-icon">'+
                            '<i class="fa fa-play"></i>'+
                            '</span>'+
                            '<span class="bijiTime">'+v.videoTimePoint+'</span>'+
                            '</div>'+
                            '</div>' +
                            '</div>';
                        }

                    });
                    $(".exch").html("");
                    $(".exch").html(exchangestr);
                    $(".mine").html("");
                    $(".mine").html(notestr);
                    $(".teacher_jieshao").html(teastr);
                    $("#extendid").val("");
                    $("span.title").html(data.contenttitle);
                    $("#video").attr("src",data.value);
                    $("#exchangeid").val(data.exchangeid);
            } else {
                //alert(data.message);
            }

        },
        error: function () {
            alert("网络通讯失败,请检查网络连接，或者联系网站管理员！");
        }
    });
}

    //输入笔记
    function enterMess(self){
    var obj=$(self).parents("div.bdFoot").siblings("div.bdContent");
    obj.animate({scrollTop:obj[0].scrollHeight+"px"},1000);
    var notes= $("#remeberBJ").val();
    if(!notes){
        alert("请不要发布空内容!");
        return false;
    }
    var videoTimePoint=$("#timeZhud").html();
    var nrId=$(".contentidnote").val();
    var mrId=$("#mrid").val();
    var voId=$("#extendid").val();
    var viId=$(".extendid").val();
    var catid =$("#catid").val();
    if(voId){
        var exId = voId;
    }else{
        var exId = viId;
    }
    if(nrId){
        var contentId = nrId;
    }else{
        var contentId = mrId;
    }
    $.ajax({
        url: 'index.php?web/video/ajaxnote', // 跳转到 action
        data: {
            notes:notes,
            videoTimePoint:videoTimePoint,
            contentId:contentId,
            videoId:exId,
            catid:catid
        },
        type: 'post',
        cache: false,
        dataType: 'json',
        success: function (data) {
            if (data) {
                var str="";
                var note_sum="";
                str+='<div class="message">'+
                '<div class="container">'+
                '<div class="header">'+
                '<div class="username">' + data.username + '</div>'+
                '<div class="button" style="display: none;">'+
                '<span class="item zan-btn">赞(<font>0</font>)</span>'+
                '<span class="item share-btn">分享</span>'+
                '</div>'+
                '<div class="clear"></div>'+
                '</div>'+
                '<div class="content">'+
                '<span class="triangle"></span>'+
                '<span class="text">' + data.notes + '</span>'+
                '</div><div class="clear">'+
                '</div>'+
                '<div class="slide currTime" onclick="currTime(this)">'+
                '<span class="slide-icon">'+
                '<i class="fa fa-play"></i>'+
                '</span><span class="bijiTime">'+ data.videoTimePoint+'</span></div></div>'+
                '<div class="clear">'+
                '</div></div>';
                //$.each(data.noteSum,function(k,v) {
                //    note_sum += '<span class="num">'+ v.notesNum+'</span>';
                //});
                //alert(data.noteSum);
                //$(".num").html(note_sum);
                $(".mine").append(str);
                $("#remeberBJ").val("");
            } else {
                //alert(data.message);
            }
        },
        error: function () {
            alert("网络通讯失败,请检查网络连接，或者联系网站管理员！");
        }
    });

}

    //输入交流
    function exchange(self) {
    var obj=$("div.bdContent");
    var time=$("#timeZhud02").html();
    var exchange = $("#exchanges").val();
    if (!exchange) {
        alert("请不要发布空内容!");
        return false;
    }
    var exchangeid = $("#exchangeid").val();
    var nrId = $(".contentidnote").val();
    var mrId = $("#mrid").val();
    var voId = $("#extendid").val();
    var viId = $(".extendid").val();
    if (viId) {
        var exId = viId;
    } else {
        var exId = voId;
    }
    if (nrId) {
        var contentId = nrId;
    } else {
        var contentId = mrId;
    }
    var username = $("#username").val();
    $.ajax({
        url: 'index.php?web/video/ajaxExchange', // 跳转到 action
        data: {
            exchange: exchange,
            contentId: contentId,
            videoId: exId,
            videoTimePoint: time
        },
        type: 'post',
        cache: false,
        dataType: 'json',
        success: function (data) {
            if (data) {
                if(data.exchange){
                    obj.animate({scrollTop:obj[0].scrollHeight+"px"},1000);
                }
                var str = "";
                if(data.username == username ){
                    var time03=getLocalTime(data.recordingTime).split(" ")[1].substring(2);
                    str +='<div class="time">'+time03+'</div>'+
                    '<div class="message message-me">'+
                    '<img class="photo" src="'+data.userphoto+'">'+
                    ' <div class="container" onmouseover="showCH(this)" onmouseout="hideCH(this)">'+
                    '<div class="header">'+
                    '<div class="username">'+data.username+'</div>'+
                    '<div class="clear"></div></div>'+
                    '<div class="content">'+
                    '<span class="triangle"></span>'+
                    '<span class="text">'+data.exchange+'</span>'+
                    '</div>'+
                    '<a href="javascript:;" class="chehui ch">'+
                    '<span onclick="showSure(this)">撤回</span>'+
                    '<div>'+
                    '<span class="jianjian"></span>'+
                    '<span onclick="noSure(this)">取消</span>&nbsp;&nbsp;'+
                    '<span  onclick="sure(this)">确认</span>'+
                    '<input type="hidden" class="exchangeid_n" value="'+data.exchangeid+'">'+
                    '</div>'+
                    '</a>'+
                    '</div>'+
                    '<div class="clear"></div>'+
                    '<div class="slide timePos " onclick="currTime(this)">'+
                    '<span class="slide-icon">'+
                    '<i class="fa fa-play"></i>'+
                    '</span>'+
                    '<span class="bijiTime">'+data.videoTimePoint+'</span>'+
                    '</div>'+
                    '</div>'+
                    '</div>';
                }else{
                    var time04=getLocalTime(data.recordingTime).split(" ")[1].substring(2);
                    str +='<div class="time">'+time04+'</div>'+
                    '<div class="message">'+
                    '<img class="photo" src="'+data.userphoto+'">'+
                    ' <div class="container" onmouseover="showCH(this)" onmouseout="hideCH(this)">'+
                    '<div class="header">'+
                    '<div class="username">'+data.username+'</div>'+
                    '<div class="username">'+data.recordingTime+'</div>'+
                    '<div class="clear"></div></div>'+
                    '<div class="content">'+
                    '<span class="triangle"></span>'+
                    '<span class="text">'+data.exchange+'</span>'+
                    '</div>'+
                    '</div>'+
                    '<div class="clear"></div>'+
                    '<div class="slide timePos02 " onclick="currTime(this)">'+
                    '<span class="slide-icon">'+
                    '<i class="fa fa-play"></i>'+
                    '</span>'+
                    '<span class="bijiTime">'+data.videoTimePoint+'</span>'+
                    '</div>'+
                    '</div>' +
                    '</div>';
                }

                $(".exch").append(str);
                $("#exchanges").val("");
                $("#exchangeid").val(data.exchangeid);
            } else {
                //alert(data.message);
            }
        },
        error: function () {
            alert("网络通讯失败,请检查网络连接，或者联系网站管理员！");
        }
    });
}

    //更新交流 1S
    function swich(){
    var obj=$("div.bdContent");
    var nrId=$(".contentidnote").val();
    var mrId=$("#mrid").val();
    var exchangeid=$("#exchangeid").val();
    if(nrId){
        var contentId = nrId;
    }else{
        var contentId = mrId;
    }
    var username =$("#username").val();

    $.ajax({
        url: 'index.php?web/video/ajaxSwitchExchange', // 跳转到 action
        data: {
            contentId:contentId,
            exchangeid:exchangeid
        },
        type: 'POST',
        cache:false,
        dataType:'json',
        success: function (data) {
            if (data.exchange) {
                var exchangestr="";
                $.each(data.exchange.exchanges,function(k,v) {
                    if(v.exchange){
                        obj.animate({scrollTop:obj[0].scrollHeight+"px"},1000);
                    }
                    if(v.username == username ){
                        var time05=getLocalTime(v.recordingTime).split(" ")[1].substring(2);
                        exchangestr +='<div class="time">'+time05+'</div>'+
                        '<div class="message message-me">'+
                        '<img class="photo" src="'+v.photo+'">'+
                        '<div class="container" onmouseover="showCH(this)" onmouseout="hideCH(this)">'+
                        '<div class="header">'+
                        '<div class="username">'+v.username+'</div>'+
                        '<div class="clear"></div></div>'+
                        '<div class="content">'+
                        '<span class="triangle"></span>'+
                        '<span class="text">'+v.exchange+'</span>'+
                        '</div>'+
                        '<a href="javascript:;" class="chehui ch">'+
                        '<span onclick="showSure(this)">撤回</span>'+
                        '<div>'+
                        '<span class="jianjian"></span>'+
                        '<span onclick="noSure(this)">取消</span>&nbsp;&nbsp;'+
                        '<span  onclick="sure(this)">确认</span>'+
                        '<input type="hidden" class="exchangeid_n" value="'+ v.exchangeid+'">'+
                        '</div>'+
                        '</div>'+
                        '<div class="clear"></div>'+
                        '<div class="slide timePos " onclick="currTime(this)">'+
                        '<span class="slide-icon">'+
                        '<i class="fa fa-play"></i>'+
                        '</span>'+
                        '<span class="bijiTime">'+v.videoTimePoint+'</span>'+
                        '</div>'+
                        '</div>' +
                        '</div>';
                    }else{
                        var time06=getLocalTime(v.recordingTime).split(" ")[1].substring(2);
                        exchangestr +='<div class="time">'+time06+'</div>'+
                        '<div class="message">'+
                        '<img class="photo" src="'+v.photo+'">'+
                        '<div class="container" onmouseover="showCH(this)" onmouseout="hideCH(this)">'+
                        '<div class="header">'+
                        '<div class="username">'+v.username+'</div>'+
                        '<div class="clear"></div></div>'+
                        '<div class="content">'+
                        '<span class="triangle"></span>'+
                        '<span class="text">'+v.exchange+'</span>'+
                        '</div>'+
                        '</div>'+
                        '<div class="clear"></div>'+
                        '<div class="slide timePos02 " onclick="currTime(this)">'+
                        '<span class="slide-icon">'+
                        '<i class="fa fa-play"></i>'+
                        '</span>'+
                        '<span class="bijiTime">'+v.videoTimePoint+'</span>'+
                        '</div>'+
                        '</div>' +
                        '</div>';
                    }
                });
                $(".exch").append(exchangestr);
                $("#exchangeid").val(data.exchangeid);
            } else {
                //alert('无数据');
            }
        },
        error: function () {
            alert("网络通讯失败,请检查网络连接，或者联系网站管理员！");
        }
    });
}


function prevClass(self){
    var contentid=$(self).attr("conId");
    var catid=$(self).attr("catId");
    location.href="index.php?web/video/index&contentid="+contentid+"&catid="+catid+"&switch=prev&updown="+flag;
}

function nextClass(self){
    var contentid=$(self).attr("conId");
    var catid=$(self).attr("catId");
    location.href="index.php?web/video/index&contentid="+contentid+"&catid="+catid+"&switch=next&updown="+flag;
}