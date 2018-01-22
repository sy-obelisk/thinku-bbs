/**
 * Created by daicunya on 2017/11/2.
 */
'use strict';

;(function ($) {

  function Tab(obj,opt) {
    var _this = this;
    this.tab = obj;
    this.config = opt;
    this.options = {
      "triggerType" : "click",
      "auto"        : 1000,
      "effect"      : "default",
      "invoke"      : 2
    };
    if (this.getConfig()) {
      $.extend(this.options,this.getConfig());
    }
    var config = this.options;
    //获取DOM节点
    this.tabItems = this.tab.find('.j-tab-nav>li');
    this.tabCntItems   = this.tab.find('.j-tab-cnt>li');

    //不同的事件类型执行不同的方法
    if (config.triggerType === 'click') {
      this.tabItems.bind("click",function () {
        _this.invoke($(this));
      })
    } else {
      this.tabItems.mouseover(function () {
        alert("mouseover")
      })
    }

    if (config.auto) {
      this.timer = '';
      this.loop = 0;

      this.autoPlay();

      this.tab.hover(function () {
        window.clearInterval(_this.timer)
      },function () {
        _this.autoPlay();
      })
    }

    //默认显示第几个
    if (config.invoke > 1) {
      _this.invoke(this.tabItems.eq(config.invoke-1));
    }
  }
  Tab.prototype = {
    //  获取配置参数
    getConfig : function () {
      var config = this.config;
      if (config && (config!="")) {
        //获取到的是对象不类型,不需要转换
        console.log(typeof config);
        return config;
      } else {
        return null;
      }
    },
    //事件执行方法
    invoke : function (currentTab) {
      var _this = this,
          index = currentTab.index();
      //tab选中参数
      currentTab.addClass('active').siblings().removeClass('active');

      var effect      = this.config.effect,
          tabCntItems = this.tabCntItems;
      if (effect === "default") {
        tabCntItems.eq(index).addClass('active').siblings().removeClass('active');
      } else {
        tabCntItems.eq(index).fadeIn().addClass('active').siblings().fadeOut();
      }

      if (this.config.auto) {
        this.loop = index;
      }
    },
    //自动切换方法
    autoPlay : function () {
      var _this = this,
          tabItems = this.tabItems,
          tabLength = tabItems.length ,
          config = this.config;

      this.timer = window.setInterval(function () {
        _this.loop++;
        if (_this.loop >= tabLength) {
          _this.loop = 0;
        }
        tabItems.eq(_this.loop).trigger(config.triggerType);
      },config.auto)
    }
  }

  $.fn.extend({
    tab : function (config) {
      this.each(function () {
        new Tab($(this),config)
      })
      return this;
    }
  })
})(jQuery);
