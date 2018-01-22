$(function(){
    $(".PX_l_center_timu .PX_l_center_SCK").scroll_absolute({arrows:false});
    $(".PX_l_center01_remen ul li .PX_zan").click(function(){
        //判断是否登录
        if($(this).hasClass("on")){
            alert('已收藏');
        }else{
            var tikuId = $(this).attr('data-id');
            var _this = $(this);
            $.post('index.php?web/api/verdictLogin',{},function(re){
                if(re.code == 1){
                    $.post('index.php?web/api/addCollect',{tikuId:tikuId},function(call){
                        if(call.code == 1){
                            _this.addClass("on");
                        }else{
                            alert('收藏失败，请重试');
                        }
                    },'json')
                }else{
                    loginw(this);
                }
            },'json')
        }
    })
});