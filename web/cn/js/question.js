/**
 * Created by daicunya on 2018/3/5.
 */
var _question = {
  init : function () {
    this.bind();
    this.questionList('recommend',1);
  },
  bind : function () {
    var _this = this;
    $('.quest-box>.hd li').click(function () {
      var cate = $(this).data('cate');
      $(this).addClass('on').siblings().removeClass('on');
      _this.questionList(cate,1);
    })
  },
  questionList: function (name,p) {
    var tp = '';
    $.ajax({
      url: '/cn/api/question-square',
      type: 'post',
      data: {
        cate: name,
        page: p
      },
      dataType: 'json',
      success: function (res) {
        console.log(res);
        tp = res.page.pageCount;
        if (!res.page.count){
          tp = 1;
        }
        var lis = '';
        for(var i=0,data = res.data;i<data.length;i++){
          lis+= '<li>'+
            '<div class="head">';
          if (data[i].image){
            lis+='<img src="'+data[i].image+'" alt="">';
          }else {
            lis+='<img src="/cn/images/head.png" alt="">';
          }
          lis+='</div>'+
            '<div class="cnt">'+
            '<h5><span class="logo">Q</span><a href="/details/'+data[i].id+'.html">'+data[i].name+'</a></h5>'+
            '<div class="answer">'+
            '<span class="logo">A</span>';
          if (data[i].comment){
            lis+='<div>'+data[i].comment+'</div>';
          } else {
            lis+='<div></div>';
          }
          lis+='</div>'+
            '<div class="info clearfix">'+
            '<p><span>'+data[i].userName+'</span>发起了提问</p>'+
            '<p><span>'+data[i].replyCount+'人回复</span>|<span>'+data[i].viewCount+'次浏览</span></p>'+
            '</div>'+
            '</div>'+
            '</li>';
        }
        lis+= '<div class="page-wrap">'+
               '<ul class="pagination" id="pagination1"></ul>'+
               '</div>';
        $('.quest-list').html(lis);
      },
      complete: function () {
        $.jqPaginator('.pagination', {
          totalPages: tp,
          visiblePages: 6,
          currentPage: p,
          onPageChange: function (num,type) {
            if(type == 'change'){
              _question.questionList(name,num);
            }
          }
        });
      }
    })
  }
};
$(function () {
  _question.init();
})