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
    // 点击全部一级导航点击
    $('.article-all').click(function () {
      _this.allArticle(this);
      $('.all-article li').eq(0).addClass('active').siblings().removeClass('active');
    });
    // 其他一级导航点击
    $('.article-other').click(function () {
      _this.getList(this);
      $('.get-list .first-li').addClass('active').siblings().removeClass('active');
      $('.get-list .inHd:eq(0) li').eq(0).addClass('on').siblings().removeClass('on');
      $('.get-list .inHd:eq(1) li').eq(0).addClass('on').siblings().removeClass('on');
      $('.get-list .inBd:eq(0)>ul').eq(0).css('display','block').children('li').eq(0).addClass('active').siblings().removeClass('active').parent().siblings().css('display','none');
      $('.get-list .inBd:eq(1)>ul').eq(0).css('display','block').children('li').eq(0).addClass('active').siblings().removeClass('active').parent().siblings().css('display','none');
    });
    // 全部/精华二级导航点击
    $('.box-tab .all-article li').click(function () {
      _this.allArticle(this);
    });
    // 职业、生活二级导航点击
    $('.box-tab>.bd .get-list>li').click(function () {
      _this.getList(this);
    });
    // 留学二级导航点击
    $('.abroad-wrap .inHd li').click(function () {
      var i = $(this).index();
      var obj = $('.abroad-wrap .inBd>ul').eq(i).children().eq(0);
      _this.getList(obj);
    });
    // 考试二级导航点击
    $('.exam-wrap .inHd li').click(function () {
      var i = $(this).index();
      var obj = $('.exam-wrap .inBd>ul').eq(i).children().eq(0);
      _this.getList(obj);
    });
    // 留学、考试三级导航点击
    $('.box-tab>.bd .get-list .inBd li').click(function () {
      _this.getList(this);
    });
  },
  getList : function (obj) {
    var first  = $(obj).data('first'),
        second = $(obj).data('second'),
        third  = $(obj).data('third'),
        _this = this;
    $(obj).addClass('active').siblings().removeClass('active');
    third = third == undefined ? '' : third;
    _this.ajaxEvent(first,second,third,1);
  },
  // 全部/精华
  allArticle : function(obj){
    var cate = $(obj).data('cate'),
        _this = this;
    $(obj).addClass('active').siblings().removeClass('active');
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
          tp = 1;
        }
        if (res.code == 0) {
          var ulItem = "<ul>";
          for(var i=0,data=res.data;i<data.length;i++) {
              var _data = data[i].listeningFile.substr(0,1550);
              // var data_ = _data.replace(/<img.*\/>/ig, "");
              var data_ = _data.replace(/<\/?.+?>/g,"");

            ulItem+="<li class='item'>"+
              "<div class='img'>";
              if (data[i].image){
                ulItem+="<img src='"+data[i].image+"' alt='头像'>";
              }else {
                ulItem+="<img src='/cn/images/head.png' alt='头像'>";
              }
            ulItem+="</div>"+
              "<div class='right'>"+
              "<h3><a href='/details/"+data[i].id+".html'>"+data[i].name+"<i class='iconfont icon-hot'></a></i></h3>"+
              "<div class='info-list clearfix'>"+
              "<div class='first-div'><span>"+data[i].userName+"</span> <span>发布于"+data[i].createTime+"</span></div>"+
              "<div class='last-div'>"+
              // "<p><span>"+data[i].last.name+" </span><span>最后回复于"+data[i].last.time+" </span></p>"+
              "<p><span>查看："+data[i].viewCount+"  </span>|<span>回复："+data[i].count+"</span></p></div>"+
              "</div>"+
              "<div class='abstract'>"+data_+"</div>"+
              "</div>"+
              "</li>";
          }
          ulItem+= "</ul>";
          $('.box-post-list').html(ulItem);
          if (p>1){
            $('html').scrollTop($('.posts').offset().top);
          }
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
        // console.log(res);
        tp = res.page.pagecount;
        if (!res.page.count){
          tp = 1;
        }
        if (res.code == 0) {
          var ulItem = "<ul>";
          for(var i=0,data=res.data;i<data.length;i++) {
            var _data = data[i].listeningFile.substr(0,1550);
            // var data_ = _data.replace(/<img.*\/>/ig, "");
              var data_ = _data.replace(/<\/?.+?>/g,"");
              ulItem+="<li class='item'>"+
              "<div class='img'>";
            if (data[i].image){
              ulItem+="<img src='"+data[i].image+"' alt='头像'>";
            }else {
              ulItem+="<img src='/cn/images/head.png' alt='头像'>";
            }
            ulItem+="</div>"+
              "<div class='right'>";
            if (i <= 3 && p == 1){
              ulItem+="<h3><a href='/details/"+data[i].id+".html'>"+data[i].name+"<i class='iconfont icon-hot'></i></a></h3>";
            } else {
              ulItem+="<h3><a href='/details/"+data[i].id+".html'>"+data[i].name+"</a></h3>";
            }
            ulItem+="<div class='info-list clearfix'>"+
              "<div class='first-div'><span>"+data[i].userName+"</span> <span>发布于"+data[i].createTime+"</span></div>"+
              "<div class='last-div'>"+
              // "<p><span>"+data[i].last.name+" </span><span>最后回复于"+data[i].last.time+" </span></p>"+
              "<p><span>查看："+data[i].viewCount+"  </span>|<span>回复："+data[i].count+"</span></p></div>"+
              "</div>"+
              "<div class='abstract'>"+data_+"</div>"+
              "</div>"+
              "</li>";
          }
          ulItem+= "</ul>";
          $('.box-post-list').html(ulItem);
          if (p>1){
            $('html').scrollTop($('.posts').offset().top);
          }
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

//    考试
    jQuery(".exam-wrap").slide({trigger:"click",titCell:".inHd li",mainCell:".inBd"});
//    留学
    jQuery(".abroad-wrap").slide({trigger:"click",titCell:".inHd li",mainCell:".inBd"});
//  帖子导航
    jQuery(".box-tab").slide({trigger:"click"});


//  侧边栏我要规划
    jQuery(".project").slide({});
//  侧边栏热帖排行榜
    jQuery(".ranking").slide({});
})