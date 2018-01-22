$(function(){
    var num=0;//用来记录原来的总价
    $("#jifenMoney").change(function(){
        if($(this).is(":checked")){
            var total=$("#totalP").html();
            num=total;
            var jifen=$("#jifenP").html();
            var last=total-jifen/100;
            $("#totalP").html(last);
        }else{
            $("#totalP").html(num);
        }
    });


});

function subtractNum(self){
    var changeNum=$(self).siblings("span#num").html();
    if(changeNum==1){
//        alert("已经到底了!不能再减啦!");
        return false;
    }
    changeNum--;
    $(self).siblings("span#num").html(changeNum);
    $("#totalP").html(changeNum*2000);
}
function addNum(self){
   var changeNum=$(self).siblings("span#num").html();
    changeNum++;
    $(self).siblings("span#num").html(changeNum);
    $("#totalP").html(changeNum*2000);
}
