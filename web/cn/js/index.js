/**
 * Created by daicunya on 2018/2/22.
 */

var _index = {
  init : function () {
    this.bind();
    this.ajaxArticle('all',1);
  },
  bind : function () {
    var _this = this;
    $('.box-tab>.bd .get-list a').click(function () {
      _this.getList(this);
    });
    $('.box-tab .all-article a').click(function () {
      _this.allArticle(this);
    })
  },
  getList : function (obj) {
    var first  = $(obj).data('first'),
        second = $(obj).data('second'),
        third  = $(obj).data('third'),
        _this = this;
    $('.box-tab>.bd a').removeClass('on');
    $(obj).addClass('on');
    third = third == undefined ? '' : third;
    _this.ajaxEvent(first,second,third,1);
  },
  // 全部/精华
  allArticle : function(obj){
    var cate = $(obj).data('cate'),
        _this = this;
    _this.ajaxArticle(cate,1);
  },
  ajaxEvent : function (first,second,third,p) {
    var tp = '';
    $.ajax({
      url: '/cn/api/get-list',
      type: 'post',
      data: {
        first  : first,
        second : second,
        third  : third,
        page   : p
      },
      dataType: 'json',
      beforeSend: function () {
        $('.box-post-list').html("加载中...");
      },
      success: function (res) {
        console.log(res);
        tp = res.page.pagecount;
        if (!res.page.count){
          // res.data = 0;
          tp = 1;
        }
        if (res.code == 0) {
          var ulItem = "<ul>";
          for(var i=0,data=res.data;i<data.length;i++) {
            ulItem+="<li class='item'>"+
              "<div class='img'>"+
              "<img src='' alt='头像'>"+
              "</div>"+
              "<div class='right'>"+
              "<h3><a href='/details/"+data[i].id+".html'>"+data[i].name+"<i class='iconfont icon-hot'></a></i></h3>"+
              "<div class='info-list clearfix'>"+
              "<div class='first-div'><span>"+data[i].userName+"</span> <span>发布于"+data[i].createTime+"</span></div>"+
              "<div class='last-div'>"+
              // "<p><span>"+data[i].last.name+" </span><span>最后回复于"+data[i].last.time+" </span></p>"+
              "<p><span>查看："+data[i].viewCount+"  </span>|<span>回复："+data[i].count+"</span></p></div>"+
              "</div>"+
              "<div class='abstract'>"+data[i].listeningFile+"</div>"+
              "</div>"+
              "</li>";
          }
          ulItem+= "</ul>";
          $('.box-post-list').html(ulItem);
        }
      },
      complete: function () {
        $.jqPaginator('.pagination', {
          totalPages: tp,
          visiblePages: 6,
          currentPage: p,
          onPageChange: function (num,type) {
            if(type == 'change'){
              _index.ajaxEvent(first,second,third,num);
            }
          }
        });
      }
    })
  },
  // 全部/精华
  ajaxArticle : function (cate,p) {
    var tp = '';
    $.ajax({
      url: '/cn/api/all-article',
      type: 'post',
      data: {
        cate: cate,
        page: p
      },
      dataType: 'json',
      beforeSend: function () {
        $('.box-post-list').html("加载中...");
      },
      success: function (res) {
        console.log(res);
        tp = res.page.pagecount;
        if (!res.page.count){
          // res.data = 0;
          tp = 1;
        }
        if (res.code == 0) {
          var ulItem = "<ul>";
          for(var i=0,data=res.data;i<data.length;i++) {
            ulItem+="<li class='item'>"+
              "<div class='img'>"+
              "<img src='' alt='头像'>"+
              "</div>"+
              "<div class='right'>"+
              "<h3><a href='/details/"+data[i].id+".html'>"+data[i].name+"<i class='iconfont icon-hot'></a></i></h3>"+
              "<div class='info-list clearfix'>"+
              "<div class='first-div'><span>"+data[i].userName+"</span> <span>发布于"+data[i].createTime+"</span></div>"+
              "<div class='last-div'>"+
              // "<p><span>"+data[i].last.name+" </span><span>最后回复于"+data[i].last.time+" </span></p>"+
              "<p><span>查看："+data[i].viewCount+"  </span>|<span>回复："+data[i].count+"</span></p></div>"+
              "</div>"+
              "<div class='abstract'>"+data[i].listeningFile+"</div>"+
              "</div>"+
              "</li>";
          }
          ulItem+= "</ul>";
          $('.box-post-list').html(ulItem);
        }
      },
      complete: function () {
        $.jqPaginator('.pagination', {
          totalPages: tp,
          visiblePages: 6,
          currentPage: p,
          onPageChange: function (num, type) {
            if (type == 'change') {
              _index.ajaxArticle(cate, num);
            }
          }
        });
      }
    })
  }
};
$(function () {
  _index.init();
  $(function () {
//  banner图
    jQuery(".bnr-banner").slide({ mainCell:".box ul",effect:"leftLoop", autoPlay:false, delayTime:400});
//  文章资讯
    jQuery(".bnr-info").slide({delayTime:0 });
// 报offer
    jQuery(".workcase .offer").slide({mainCell:".bd ul",autoPlay:true,effect:"topMarquee",vis:3,interTime:50});
// 报高分
    jQuery(".workcase .score").slide({mainCell:".bd ul",autoPlay:true,effect:"topMarquee",vis:3,interTime:50});
// 热门公开课
    jQuery(".hotpublic .public").slide({ mainCell:".box ul",effect:"leftLoop", autoPlay:false, delayTime:400});
//  帖子导航
    jQuery(".box-tab").slide({trigger:"click"});
//    考试
    jQuery(".exam-wrap").slide({});
//    留学
    jQuery(".abroad-wrap").slide({});

//  侧边栏我要规划
    jQuery(".project").slide({});
//  侧边栏热帖排行榜
    jQuery(".ranking").slide({});
//    分页
//     $.jqPaginator('#pagination1', {
//       totalPages: 20,
//       visiblePages: 7,
//       currentPage: 1,
//       onPageChange: function (num, type) {
//         console.log(num,type);
//         if (type == 'change') {
//           _index.ajaxArticle(cate, num);
//         }
//       }
//     });
  })
})