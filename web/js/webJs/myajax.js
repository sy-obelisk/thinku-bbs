$(function () {
    var nums=$(".infoLhd ul li.on").index();
    $(".fenPage").eq(nums).find("ul li").eq(0).addClass("on");
    getCookie();
});

/**
 *免注册一键登录函数
 */
function reglogin(e) {
    var tel = $("#phone").val();
    if (tel == '' || !tel.match(/^0{0,1}(1[0-9][2-9])[0-9]{8}$/)) {
        $("#phone").focus();
        return false;
    } else {
        $("#login_register").hide();
        $("#lu_fly").show();
        $.ajax({
            url: 'index.php?web/api/register', // 跳转到 action
            data: {
                username: $("#phone").val(),
                phone: $("#phone").val(),
                phonecode: $("#mes_yzm").val(),
                userpwd: $("#rl_password").val()
            },
            type: 'post',
            cache: false,
            dataType: 'json',
            success: function (data) {
                if (data.code == 1) {
                    setCookie();
                    location.reload(location.href);
                    window.location.replace(location.href);
                    $("#lu_fly").hide();
                    $(".log_reg_zzc").hide();
                } else {
                    $(".messages_div span.miss_login").html(data.message).show();
                    $("#lu_fly").hide();
                    $("#login_register").show();
                }
            },
            error: function () {
                $("#lu_fly").hide();
                $(".log_reg_zzc").hide();
                alert("网络通讯失败,请检查网络连接，或者联系网站管理员！");
            }
        });
    }
}


/**
 *手机注册函数
 */
function PhonReg(e) {
    var tel = $("#regPhone").val();
    if (tel == '' || !tel.match(/^0{0,1}(1[0-9][2-9])[0-9]{8}$/)) {
        $("#regPhone").focus();
        return false;
    } else {
        $("#login_register").hide();
        $("#lu_fly").show();
        $.ajax({
            url: 'index.php?web/api/register', // 跳转到 action
            data: {
                phone: $("#regPhone").val(),
                phonecode: $("#regPhonecode").val(),
                username: $("#regUsername").val(),
                userpwd: $("#regpassword").val()
            },
            type: 'post',
            cache: false,
            dataType: 'json',
            success: function (data) {
                if (data.code == 1) {
                    setCookie();
                    location.reload(location.href);
                    window.location.replace(location.href);
                    $("#lu_fly").hide();
                    $(".log_reg_zzc").hide();
                } else {
                    alert(data.message);
                    //$(".messages_div span.miss_login").html(data.message).show();
                    $("#lu_fly").hide();
                    $("#login_register").show();
                }
            },
            error: function () {
                $("#lu_fly").hide();
                $(".log_reg_zzc").hide();
                alert("网络通讯失败,请检查网络连接，或者联系网站管理员！");
            }
        });
    }
}

/**
 *邮箱注册函数
 */
function EmailReg(e) {
    var tel = $("#regEmail").val();
    if (tel == '' || !tel.match(/^([a-zA-Z0-9_-])+@([a-zA-Z0-9_-])+((\.[a-zA-Z0-9_-]{2,3}){1,2})$/)) {
        $("#regEmail").focus();
        return false;
    } else {
        $("#login_register").hide();
        $("#lu_fly").show();
        $.ajax({
            url: 'index.php?web/api/register', // 跳转到 action
            data: {
                email: $("#regEmail").val(),
                emailCode: $("#emailCode").val(),
                username: $("#E_Username").val(),
                userpwd: $("#E_regPass").val(),
                codename: $(e).attr('codename')
            },
            type: 'post',
            cache: false,
            dataType: 'json',
            success: function (data) {
                if (data.code == 1) {
                    setCookie();
                    location.reload(location.href);
                    window.location.replace(location.href);
                    $("#lu_fly").hide();
                    $(".log_reg_zzc").hide();
                } else {
                    alert(data.message);
                    //$(".messages_div span.miss_login").html(data.message).show();
                    $("#lu_fly").hide();
                    $("#login_register").show();
                }
            },
            error: function () {
                $("#lu_fly").hide();
                $(".log_reg_zzc").hide();
                alert("网络通讯失败,请检查网络连接，或者联系网站管理员！");
            }
        });
    }
}
/**
 * 公用登录函数
 */
function login(e) {
    var username = $("#log_username").val();
    if (username == '') {
        $("#username").focus();
        return false;
    }
    $("#login_register").hide();
    $("#lu_fly").show();
    $.ajax({
        url: 'index.php?web/api/login', // 跳转到 action
        data: {
            username: $("#log_username").val(),
            password: $("#log_password").val(),
            randcode: $("#log_randcode").val(),
            codename: $(e).attr('codename')
        },
        type: 'post',
        cache: false,
        dataType: 'json',
        success: function (data) {
            if (data.code == 1) {
                setCookie();
                //$('#loadjs').html(data.ucsynlogin);
                var href = location.href.replace('&mylogin=login', '');
                window.location.replace(href);
                location.reload(href);
                window.location.replace(location.href);
                location.reload();
                $("#lu_fly").hide();
                $(".log_reg_zzc").hide();
            } else {
                $("#lu_fly").hide();
                $("#login_register").show();
                $("#log_username").focus();
                $("#login_register .login_r .lr_whiteBG  .lr_whiteBG_hb .bd ul li .sefci_bac").html(data.message);
                $("#login_register .login_r .lr_whiteBG  .lr_whiteBG_hb .bd ul li .sefci_bac").show();
            }
        },
        error: function () {
            $("#lu_fly").hide();
            $(".log_reg_zzc").hide();
            alert("网络通讯失败,请检查网络连接，或者联系网站管理员！");
        }
    });
}

//写入cookies
function setCookie() {
    if ($('#rempwd').is(':checked')) {
        $.cookie('username', $('#log_username').val());
        $.cookie('password', $('#log_password').val());
    }

}

//读取
function getCookie() {
    $.cookie("username");
    $.cookie("password");
    $('#log_username').val($.cookie("username"));
    $('#log_password').val($.cookie("password"));
    $('#index_log_username').val($.cookie("username"));//首页登录框赋值
    $('#index_log_password').val($.cookie("password"));//首页密码赋值
    return true;
}

/**
 *公用退出登录函数
 */
function logout() {
    $.ajax({
        url: 'index.php?web/api/logout', // 跳转到 action
        type: 'post',
        cache: false,
        dataType: 'json',
        success: function (data) {
            if (data.code == 1) {
                $('#loadjs').html(data.ucsynlogout);
                setTimeout(function () {
                    var href = location.href.replace('&mylogin=login', '');
                    window.location.replace(href);
                    location.reload(href);
                    window.location.replace(location.href);
                    location.reload();
                },500)
            } else {
                alert("内部错误请联系管理员！");
            }
        },
        error: function () {
            alert("网络通讯失败,请检查网络连接，或者联系网站管理员！");
        }
    });
}

function get_Phonecode(e) {
    $Phonenum = $("#" + $(e).attr('phone')).val();
    if ($Phonenum != '' && $Phonenum.match(/^0{0,1}(13[0-9]|15[0-9]|18[2-9])[0-9]{8}$/)) {
        $.ajax({
            url: 'index.php?web/api/phonecode', // 跳转到 action
            data: {
                Phonenum: $Phonenum
            },
            type: 'post',
            cache: false,
            dataType: 'json',
            success: function (data) {
                if (data.code == 1) {
                    clickDX(e,60,1);
                } else {
                    $(".phone_div.miss_login").html(data.message).show();
                }
            },
            error: function () {
                alert("网络通讯失败,请检查网络连接，或者联系网站管理员！");
            }
        });
    } else {
        $("#" + $(e).attr('phone')).focus();
        $("#regPhone").next("span.spanTishi").show();
        return false;
    }
}
//发送邮件函数
function sendEmail(self,inputVal){
    var email = $(inputVal).val();
    if(email){
        $(self).val("邮件发送中");
    }
    $.post("index.php?web/information/mail",{emails:email},function(msg){
        if(msg==1){
            clickDX(self,120,2);
            $("#result").html("发送成功，请注意查收您的邮件！").css({color:'orange',fontSize:'12px'});
        }else{
            $("#result").html(msg).css({color:'orange',fontSize:'12px'});
        }
    });
}
/**
 * 动态获取题目列表
 * @param self
 * @param pageNumber 页码
 * @param pageSize 每页条数
 */
function qstlist(self, pageNumber, pageSize) {
    $("#lu_fly").show();
    $(".log_reg_zzc").show();
    $('#' + $(self).attr('t')).val($(self).attr('v'));
    $.ajax({
        url: 'index.php?web/api/gettmlt', // 跳转到 action
        data: {
            'section': $('#section').val(),
            'level': $('#level').val(),
            'origin': $('#origin').val(),
            'keywords': $('#keywords').val(),
            'exte': $('#exte').val(),
            'order': $('#order').val(),
            'pageNumber': pageNumber,
            'pageSize': pageSize
        },
        type: 'post',
        cache: false,
        dataType: 'json',
        success: function (data) {
            if (data.code == 1) {
                var str = '';
                var pages = '';
                $(self).addClass("on");
                $(self).parent().siblings().find("a").removeClass("on");
                $("#lu_fly").hide();
                $(".log_reg_zzc").hide();
                $(data.lidata).each(function (i, row) {
                    str = str + '<li>';
                    str = str + '<a href="index.php?web/exam/tiku_meidaoti&questionid=' + row.questionid + '&section=' + row.section + '"><span class="hy_lx_yf_title">[' + row.section + ']-' + row.questionid + '-' + row.twbname + '</span></a>';
                    str = str + '<div class="hy_lx_p">' + row.question + '</div>';
                    str = str + '<div style="margin-top: -10px"  class="hy_lx_div">';
                    str = str + '<span>' + row.totaluser + '人已做</span>';
                    str = str + '<p>' + row.level + '</p>';
                    str = str + '</div>';
                    str = str + '</li>';
                    str = str + '<li style="clear: both"></li>';
                });
                $("#timu_list_ul").html(str);
                $("#timu_list_page").html(data.pages);
                //实现关键字高亮
                Highlight($('#keywords').val());
            } else if (data.code == 2) {
                $("#timu_list_ul").html('');
                $("#lu_fly").hide();
                $(".log_reg_zzc").hide();
            } else if (data.code == 5) {
                $("#lu_fly").hide();
                $(".log_reg_zzc").show();
                $("#login_register").show();
            } else {
                alert("内部错误请联系管理员！");
                $("#lu_fly").hide();
                $(".log_reg_zzc").hide();
            }
        },
        error: function () {
            alert("网络通讯失败,请检查网络连接，或者联系网站管理员！");
            $("#lu_fly").hide();
            $(".log_reg_zzc").hide();
        }
    });
}

/** 日期转换
 * by fawn
 * @param nS
 * @returns {string}
 */
function getLocalTime(nS) {
    return new Date(parseInt(nS) * 1000).toLocaleString().replace(/:\d{1,2}$/,' ');
}
/**
 *  资讯分页
 * @param self
 * @param pageNumber
 * @param pageSize
 * by fawn
 */
function newslist(self, pageNumber, pageSize) {
    $('#' + $(self).attr('t')).val($(self).attr('v'));
    var num=$(".infoLhd ul li.on").index();
    $(".fenPage ul li").eq(pageNumber-1).addClass("on").siblings().removeClass("on");
    $.ajax({
        url: 'index.php?web/index/newspage', // 跳转到 action
        data: {
            'pageNumber': pageNumber,
            'pageSize': pageSize,
            'key': num
        },
        type: 'post',
        cache: false,
        dataType: 'json',
        success: function (data) {
            if (data.code == 1) {
                var str = '';
                var pages = '';
                $(data.lidata).each(function (i, row) {
                    var time = getLocalTime(row.contentinputtime);
                    //if(row.contentthumb){
                    //    str = str + '<li>';
                    //    str = str + '<div class="infoLbd_left">';
                    //    str = str + '<img src="'+row.contentthumb+'" alt="介绍图">';
                    //    str = str + '</div>';
                    //    str = str + '<div class="infoLbd_right bdright_maleft">';
                    //    str = str + '<h2>'+row.contenttitle+'</h2>';
                    //    str = str + '<span>'+time+'</span>';
                    //    str = str + '<p>'+row.abstract+'</p>';
                    //    str = str + '</div>';
                    //    str = str + '<div style="clear: both"></div>';
                    //    str = str + '<a href="index.php?web/index/news_xq&contentid='+row.contentid+'" class="readAll">阅读全文 <i class="fa fa-angle-double-right"></i></a>';
                    //    str = str + '</li>';
                    //}else{
                        str = str + '<li>';
                        str = str + '<div class="infoLbd_right bdright_maleft02">';
                        str = str + '<h3>'+row.contenttitle+'</h3>';
                        str = str + '<span>'+time+'</span>';
                        str = str + '<p>'+row.abstract+'</p>';
                        str = str + '</div>';
                        str = str + '<div style="clear: both"></div>';
                        str = str + '<a href="index.php?web/index/news_xq&contentid='+row.contentid+'" class="readAll">阅读全文 <i class="fa fa-angle-double-right"></i></a>';
                        str = str + '</li>';
                    //}
                });
                $(".infoLbd ul div.page").eq(num).html(str);
                //$("#new_page").html(data.pages);
            }else {
                alert("内部错误请联系管理员！");
            }
        },
        error: function () {
            alert("网络通讯失败,请检查网络连接，或者联系网站管理员！");
        }
    });
}
/**
 *会员界面-收藏题目
 * @param self
 * @param section
 * @param level
 * @param origin
 * @param order
 * @param exte
 * @param pageNumber
 * @param pageSize
 */
function
getusercql(self, pageNumber, pageSize) {
    $("#lu_fly").show();
    $(".log_reg_zzc").show();
    $('#' + $(self).attr('t')).val($(self).attr('v'));
    $.ajax({
        url: 'index.php?web/user/getqstlist', // 跳转到 action
        data: {
            'section': $('#section').val(),
            'level': $('#level').val(),
            'origin': $('#origin').val(),
            'pageNumber': pageNumber,
            'pageSize': pageSize
        },
        type: 'post',
        cache: false,
        dataType: 'json',
        success: function (data) {
            $(self).addClass("on");
            $(self).parent().siblings().find("a").removeClass("on");
            $("#timu_list_page").html('');//清空分页内容
            if (data.code == 1) {
                var str = '';
                var pages = '';
                $("#lu_fly").hide();
                $(".log_reg_zzc").hide();
                $(data.lidata).each(function (i, row) {
                    str += '<li>' +
                        '<a href="/index.php?web/exam/tiku_meidaoti&questionid=' + row.questionid + '&originid=' + row.twoobjecttype + '&sectionid=' + row.sectiontype + '">' +
                        '<span class="hy_lx_yf_title">[' + row.section + ']-' + row.questionid + '-' + row.twbname + '</span>' +
                        '</a>' +
                        '<div class="hy_lx_p" style="width: 731px">' + row.question + ' <p class="hy_lx_bo_p">' + '<span>平均用时：' + row.meantime + '&nbsp;&nbsp;&nbsp;&nbsp;' + row.totaluser + '人已做</span>' +
                        '</p>' + '</div>' +
                        '<div class="hy_lx_div">' + '<span style="top: 7px">' + row.level + '</span>' +
                        '<p style="font-size: 18px;margin-top: 20px" onclick="quxiaoshoucang(' + row.questionid + ',this)">取消收藏</p>' +
                        '</div>' + '</li>' +
                        '<div style="clear: both;margin-bottom: 20px;"></div>';
                });
                $("#timu_list_ul").html(str);
                $("#timu_list_page").html(data.pages);
            } else if (data.code == 2) {
                $("#timu_list_ul").html('');
                $("#lu_fly").hide();
                $(".log_reg_zzc").hide();
            } else if (data.code == 5) {
                $("#lu_fly").hide();
                $(".log_reg_zzc").show();
                $("#login_register").show();
            } else {
                alert("内部错误请联系管理员！");
                $("#lu_fly").hide();
                $(".log_reg_zzc").hide();
            }
        },
        error: function () {
            alert("网络通讯失败,请检查网络连接，或者联系网站管理员！");
            $("#lu_fly").hide();
            $(".log_reg_zzc").hide();
        }
    });
}

/**
 * 做题记录
 * @param self
 * @param pageNumber
 * @param pageSize
 */
function getuserdqst(self, pageNumber, pageSize) {
    $(".log_reg_zzc").show();
    $("#lu_fly").show();
    $('#' + $(self).attr('t')).val($(self).attr('v'));
    $.ajax({
        url: 'index.php?web/user/getuserdqst', // 跳转到 action
        data: {
            'section': $('#d_section').val(),
            'level': $('#d_level').val(),
            'origin': $('#d_origin').val(),
            'qtp': $('#d_qtp').val(),
            'time': $('#d_time').val(),
            'callback': 'getuserdqst',
            'pageNumber': pageNumber,
            'pageSize': pageSize
        },
        type: 'post',
        cache: false,
        dataType: 'json',
        success: function (data) {
            $(self).addClass("on");
            $(self).parent().siblings().find("a").removeClass("on");
            $("#dolist_page").html('');
            if (data.code == 1) {
                var str = '';
                $("#lu_fly").hide();
                $(".log_reg_zzc").hide();
                $(data.lidata).each(function (i, row) {
                    var hyclass;
                    if (typeof(row.qanswer.qanswertype) != 'undefined' && typeof(row.questionanswer) != 'undefined' && row.qanswer.qanswer == row.questionanswer) {
                        hyclass = 'hy_lx_yf_titleT';
                    } else {
                        hyclass = 'hy_lx_yf_titleTh';
                    }
                    var str1='';
                    if(row.questionanswer==row.qanswer.qanswer){
                        str1= '<span class="trueColor">'+row.questionanswer+'</span>';
                    } else {
                        str1= '<span class="falseColor">' +row.qanswer.qanswer+
                        '</span><span class="trueColor">/' +row.questionanswer+
                        '</span>';
                    }
                    str += '<li>' +
                        '<a href="index.php?web/exam/tiku_meidaoti&questionid=' + row.questionid + '&originid=' + row.twoobjecttype + '&sectionid=' + row.sectiontype + '">' +
                        '<span class="' + hyclass + '">[' + row.sections + ']-' + row.questionid + '-' + row.twoname + '</span>' +
                        '</a>' +
                    '<span class="showAnswerbac" onclick="showAnswer(this)">显示答案</span>'+
                    '<b class="banswer">' +str1+
                    '</b>'+
                        '<div class="hy_lx_p" style="width: 731px">' + row.question + ' <p class="hy_lx_bo_p">' + '<span>平均用时：' + row.meantime + '&nbsp;&nbsp;&nbsp;&nbsp;'
                        + row.totaluser + '人已做</span>' + '&nbsp;&nbsp;&nbsp;&nbsp;' + row.qanswer.answertime +
                        '</p>' + '</div>' +
                        '<div  class="hy_lx_div">' + '<span style="top: 7px">' + row.level + '</span>' +
                        '<p style="font-size: 18px;margin-top: 20px" onclick="quxiaoshoucang(' + row.questionid + ',this)">取消收藏</p>' +
                        '</div>' + '</li>' +
                        '<div style="clear: both;margin-bottom: 20px;"></div>';
                });
                $("#do_list").html(str);
                $("#dolist_page").html(data.pages);
            } else if (data.code == 2) {
                $("#do_list").html('');
                $("#lu_fly").hide();
                $(".log_reg_zzc").hide();
            } else if (data.code == 5) {
                $("#lu_fly").hide();
                $(".log_reg_zzc").show();
                $("#login_register").show();
            } else {
                alert("内部错误请联系管理员！");
                $("#lu_fly").hide();
                $(".log_reg_zzc").hide();
            }
        },
        error: function () {
            alert("网络通讯失败,请检查网络连接，或者联系网站管理员！");
            $("#lu_fly").hide();
            $(".log_reg_zzc").hide();
        }
    });
}


/**
 * 错题记录
 * @param self
 * @param pageNumber
 * @param pageSize
 */
function getuserxqst(self, pageNumber, pageSize) {
    $("#lu_fly").show();
    $(".log_reg_zzc").show();
    $('#' + $(self).attr('t')).val($(self).attr('v'));
    $.ajax({
        url: 'index.php?web/user/getuserdqst', // 跳转到 action
        data: {
            'section': $('#x_section').val(),
            'level': $('#x_level').val(),
            'origin': $('#x_origin').val(),
            'qtp': $('#x_qtp').val(),
            'time': $('#x_time').val(),
            'callback': 'getuserxqst',
            'pageNumber': pageNumber,
            'pageSize': pageSize
        },
        type: 'post',
        cache: false,
        dataType: 'json',
        success: function (data) {
            $(self).addClass("on");
            $(self).parent().siblings().find("a").removeClass("on");
            $("#xlist_page").html('');
            if (data.code == 1) {
                var str = '';
                var pages = '';

                $("#lu_fly").hide();
                $(".log_reg_zzc").hide();
                $(data.lidata).each(function (i, row) {
                    var hyclass;
                    if (typeof(row.qanswer.qanswertype) != 'undefined' && row.qanswer.qanswertype == 1) {
                        hyclass = 'hy_lx_yf_titleTh';
                    } else {
                        hyclass = 'hy_lx_yf_titleT';
                    }
                    var str2='';
                    if(row.questionanswer==row.qanswer.qanswer){
                        str2= '<span class="trueColor">'+row.questionanswer+'</span>';
                    }else{
                        str2= '<span class="falseColor">' +row.qanswer.qanswer+
                        '</span><span class="trueColor">/' +row.questionanswer+
                        '</span>';
                    }
                    str += '<li>' +
                        '<a href="index.php?web/exam/tiku_meidaoti&questionid=' + row.questionid + '&originid=' + row.twoobjecttype + '&sectionid=' + row.sectiontype + '">' +
                        '<span class="' + hyclass + '">[' + row.sections + ']-' + row.questionid + '-' + row.twoname + '</span>' +
                        '</a>' +
                    '<span class="showAnswerbac" onclick="showAnswer(this)">显示答案</span>'+
                    '<b class="banswer">' +str2+
                    '</b>'+
                        '<div class="hy_lx_p" style="width: 731px">' + row.question + '<p class="hy_lx_bo_p">' + '<span>耗时' + row.meantime + '&nbsp;&nbsp;</span>正确率' + row.correct + '&nbsp;&nbsp;<span>' + '&nbsp;&nbsp;&nbsp;&nbsp;' + row.totaluser + '人已做</span>' +
                        '&nbsp;&nbsp;&nbsp;&nbsp;' + row.qanswer.answertime +
                        '</p>' + '</div>' +
                        '<div  class="hy_lx_div">' +
                        '<span style="top: 7px">' + row.level + '</span>' +
                        '<p style="font-size: 18px;margin-top: 20px" onclick="quxiaoshoucang(' + row.questionid + ',this)">取消收藏</p>' +
                        '</div>' + '</li>' +
                        '<div style="clear: both;margin-bottom: 20px;"></div>';
                });
                $("#x_list").html(str);
                $("#xlist_page").html(data.pages);
            } else if (data.code == 2) {
                $("#x_list").html('');
                $("#lu_fly").hide();
                $(".log_reg_zzc").hide();
            } else if (data.code == 5) {
                $("#lu_fly").hide();
                $(".log_reg_zzc").show();
                $("#login_register").show();
            } else {
                alert("内部错误请联系管理员！");
                $("#lu_fly").hide();
                $(".log_reg_zzc").hide();
            }
        },
        error: function () {
            alert("网络通讯失败,请检查网络连接，或者联系网站管理员！");
            $("#lu_fly").hide();
            $(".log_reg_zzc").hide();
        }
    });
}


/**
 * html转换实体函数
 * @param input
 * @returns {string}
 * @constructor
 */
function HTMLEncode(input) {
    var converter = document.createElement("DIV");
    converter.innerText = input;
    var output = converter.innerHTML;
    converter = null;
    return output;
}
/**
 * html实体解码
 * @param input 输入
 * @returns {string}
 * @constructor
 */
function HTMLDecode(input) {
    var converter = document.createElement("DIV");
    converter.innerHTML = input;
    var output = converter.innerText;
    converter = null;
    return output;
}

/**
 *
 * @param questionid
 * @param o
 */
function shoucang(questionid, o) {
    var questionid = questionid;
    $.ajax({
        url: 'index.php?web/user/shoucang', // 跳转到 action
        data: {
            questionid: questionid
        },
        type: 'post',
        cache: false,
        dataType: 'json',
        success: function (data) {
            //alert(data.message);
            if (data.code == 1) {
                $(o).removeClass("on");
                if ($(o).attr('showtext') != 'no') {
                    $(o).html("收藏");
                }
            }
            if (data.code == 2) {
                $(o).addClass("on");
                if ($(o).attr('showtext') != 'no') {
                    $(o).html("取消收藏");
                }
            }
            if (data.code == 5) {
                $("#login_register").show();
                $(".log_reg_zzc").show();
            }
        }
    });
}

function loginw(_self) {
    $(".log_reg_zzc").show();
    $("#login_register").show();
}
function Highlight(searchTerm){
    var obj=$('#timu_list_ul .hy_lx_p');
    obj.removeHighlight();
    if (searchTerm) {
        obj.highlight(searchTerm);
    }
}

