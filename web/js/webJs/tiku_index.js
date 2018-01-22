$(function() {
	//题库首页more变色
	$(".ZX_ve_a").hover(function() {
		$(this).css("color", "#229edc");
	}, function() {
		$(this).css("color", "#888888");
	});
	//<!----------------------------题库首页JS----------------------------->
	//易错题目js
	jQuery("#remen_yicuo").slide();
	//知识点题库js
	jQuery("#zhishi_yufa").slide();

$(".sNext").each(function(){

    $(this).click(function(){
        if($(this).html()=='<img src="app/web_core/styles/images/proxy_top02.png" alt="">'){
            alert("aaaaaa");
            $(this).html('<img src="app/web_core/styles/images/proxy_top02.png" alt="">');
        }else{
            alert("bbbbbbbbbbb");
            $(this).html('<img src="app/web_core/styles/images/proxy_top.png" alt="">');
        }

    });
});
    //<!----------------------------题库首页JS end----------------------------->

});
