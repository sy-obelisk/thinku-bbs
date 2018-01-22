!function a(b, c, d) {
    function e(g, h) {
        if (!c[g]) {
            if (!b[g]) {
                var i = "function" == typeof require && require;
                if (!h && i)return i(g, !0);
                if (f)return f(g, !0);
                throw new Error("Cannot find module '" + g + "'")
            }
            var j = c[g] = {exports:{}};
            b[g][0].call(j.exports, function (a) {
                var c = b[g][1][a];
                return e(c ? c : a)
            }, j, j.exports, a, b, c, d)
        }
        return c[g].exports
    }

    for (var f = "function" == typeof require && require, g = 0; g < d.length; g++)e(d[g]);
    return e
}({1:[function () {
    !function (a) {
        "function" == typeof define && define.amd ? define(["jquery"], a) : a(jQuery)
    }(function (a) {
        var b = !1, c = !1, d = 5e3, e = 2e3, f = 0, g = ["ms", "moz", "webkit", "o"], h = window.requestAnimationFrame || !1, i = window.cancelAnimationFrame || !1;
        if (!h)for (var j in g) {
            var k = g[j];
            h || (h = window[k + "RequestAnimationFrame"]), i || (i = window[k + "CancelAnimationFrame"] || window[k + "CancelRequestAnimationFrame"])
        }
        var l = window.MutationObserver || window.WebKitMutationObserver || !1, m = {zindex:"auto", cursoropacitymin:0, cursoropacitymax:1, cursorcolor:"#424242", cursorwidth:"5px", cursorborder:"1px solid #fff", cursorborderradius:"5px", scrollspeed:60, mousescrollstep:24, touchbehavior:!1, hwacceleration:!0, usetransition:!0, boxzoom:!1, dblclickzoom:!0, gesturezoom:!0, grabcursorenabled:!0, autohidemode:!0, background:"", iframeautoresize:!0, cursorminheight:32, preservenativescrolling:!0, railoffset:!1, bouncescroll:!0, spacebarenabled:!0, railpadding:{top:0, right:0, left:0, bottom:0}, disableoutline:!0, horizrailenabled:!0, railalign:"right", railvalign:"bottom", enabletranslate3d:!0, enablemousewheel:!0, enablekeyboard:!0, smoothscroll:!0, sensitiverail:!0, enablemouselockapi:!0, cursorfixedheight:!1, directionlockdeadzone:6, hidecursordelay:400, nativeparentscrolling:!0, enablescrollonselection:!0, overflowx:!0, overflowy:!0, cursordragspeed:.3, rtlmode:"auto", cursordragontouch:!1, oneaxismousemode:"auto", scriptpath:function () {
            var a = document.getElementsByTagName("script"), a = a[a.length - 1].src.split("?")[0];
            return 0 < a.split("/").length ? a.split("/").slice(0, -1).join("/") + "/" : ""
        }()}, n = !1, o = function () {
            if (n)return n;
            var a = document.createElement("DIV"), b = {haspointerlock:"pointerLockElement"in document || "mozPointerLockElement"in document || "webkitPointerLockElement"in document};
            b.isopera = "opera"in window, b.isopera12 = b.isopera && "getUserMedia"in navigator, b.isoperamini = "[object OperaMini]" === Object.prototype.toString.call(window.operamini), b.isie = "all"in document && "attachEvent"in a && !b.isopera, b.isieold = b.isie && !("msInterpolationMode"in a.style), b.isie7 = !(!b.isie || b.isieold || "documentMode"in document && 7 != document.documentMode), b.isie8 = b.isie && "documentMode"in document && 8 == document.documentMode, b.isie9 = b.isie && "performance"in window && 9 <= document.documentMode, b.isie10 = b.isie && "performance"in window && 10 <= document.documentMode, b.isie9mobile = /iemobile.9/i.test(navigator.userAgent), b.isie9mobile && (b.isie9 = !1), b.isie7mobile = !b.isie9mobile && b.isie7 && /iemobile/i.test(navigator.userAgent), b.ismozilla = "MozAppearance"in a.style, b.iswebkit = "WebkitAppearance"in a.style, b.ischrome = "chrome"in window, b.ischrome22 = b.ischrome && b.haspointerlock, b.ischrome26 = b.ischrome && "transition"in a.style, b.cantouch = "ontouchstart"in document.documentElement || "ontouchstart"in window, b.hasmstouch = window.navigator.msPointerEnabled || !1, b.ismac = /^mac$/i.test(navigator.platform), b.isios = b.cantouch && /iphone|ipad|ipod/i.test(navigator.platform), b.isios4 = b.isios && !("seal"in Object), b.isandroid = /android/i.test(navigator.userAgent), b.trstyle = !1, b.hastransform = !1, b.hastranslate3d = !1, b.transitionstyle = !1, b.hastransition = !1, b.transitionend = !1;
            for (var c = ["transform", "msTransform", "webkitTransform", "MozTransform", "OTransform"], d = 0; d < c.length; d++)if ("undefined" != typeof a.style[c[d]]) {
                b.trstyle = c[d];
                break
            }
            b.hastransform = 0 != b.trstyle, b.hastransform && (a.style[b.trstyle] = "translate3d(1px,2px,3px)", b.hastranslate3d = /translate3d/.test(a.style[b.trstyle])), b.transitionstyle = !1, b.prefixstyle = "", b.transitionend = !1;
            for (var c = "transition webkitTransition MozTransition OTransition OTransition msTransition KhtmlTransition".split(" "), e = " -webkit- -moz- -o- -o -ms- -khtml-".split(" "), f = "transitionend webkitTransitionEnd transitionend otransitionend oTransitionEnd msTransitionEnd KhtmlTransitionEnd".split(" "), d = 0; d < c.length; d++)if (c[d]in a.style) {
                b.transitionstyle = c[d], b.prefixstyle = e[d], b.transitionend = f[d];
                break
            }
            b.ischrome26 && (b.prefixstyle = e[1]), b.hastransition = b.transitionstyle;
            a:{
                for (c = ["-moz-grab", "-webkit-grab", "grab"], (b.ischrome && !b.ischrome22 || b.isie) && (c = []), d = 0; d < c.length; d++)if (e = c[d], a.style.cursor = e, a.style.cursor == e) {
                    c = e;
                    break a
                }
                c = "url(http://www.google.com/intl/en_ALL/mapfiles/openhand.cur),n-resize"
            }
            return b.cursorgrabvalue = c, b.hasmousecapture = "setCapture"in a, b.hasMutationObserver = !1 !== l, n = b
        }, p = function (g, j) {
            function k() {
                var a = s.win;
                if ("zIndex"in a)return a.zIndex();
                for (; 0 < a.length && 9 != a[0].nodeType;) {
                    var b = a.css("zIndex");
                    if (!isNaN(b) && 0 != b)return parseInt(b);
                    a = a.parent()
                }
                return!1
            }

            function n(a, b, c) {
                return b = a.css(b), a = parseFloat(b), isNaN(a) ? (a = x[b] || 0, c = 3 == a ? c ? s.win.outerHeight() - s.win.innerHeight() : s.win.outerWidth() - s.win.innerWidth() : 1, s.isie8 && a && (a += 1), c ? a : 0) : a
            }

            function p(a, b, c, d) {
                s._bind(a, b, function (d) {
                    d = d ? d : window.event;
                    var e = {original:d, target:d.target || d.srcElement, type:"wheel", deltaMode:"MozMousePixelScroll" == d.type ? 0 : 1, deltaX:0, deltaZ:0, preventDefault:function () {
                        return d.preventDefault ? d.preventDefault() : d.returnValue = !1, !1
                    }, stopImmediatePropagation:function () {
                        d.stopImmediatePropagation ? d.stopImmediatePropagation() : d.cancelBubble = !0
                    }};
                    return"mousewheel" == b ? (e.deltaY = -.025 * d.wheelDelta, d.wheelDeltaX && (e.deltaX = -.025 * d.wheelDeltaX)) : e.deltaY = d.detail, c.call(a, e)
                }, d)
            }

            function r(a, b, c) {
                var d, e;
                if (0 == a.deltaMode ? (d = -Math.floor(a.deltaX * (s.opt.mousescrollstep / 54)), e = -Math.floor(a.deltaY * (s.opt.mousescrollstep / 54))) : 1 == a.deltaMode && (d = -Math.floor(a.deltaX * s.opt.mousescrollstep), e = -Math.floor(a.deltaY * s.opt.mousescrollstep)), b && s.opt.oneaxismousemode && 0 == d && e && (d = e, e = 0), d && (s.scrollmom && s.scrollmom.stop(), s.lastdeltax += d, s.debounced("mousewheelx", function () {
                    var a = s.lastdeltax;
                    s.lastdeltax = 0, s.rail.drag || s.doScrollLeftBy(a)
                }, 15)), e) {
                    if (s.opt.nativeparentscrolling && c && !s.ispage && !s.zoomactive)if (0 > e) {
                        if (s.getScrollTop() >= s.page.maxh)return!0
                    } else if (0 >= s.getScrollTop())return!0;
                    s.scrollmom && s.scrollmom.stop(), s.lastdeltay += e, s.debounced("mousewheely", function () {
                        var a = s.lastdeltay;
                        s.lastdeltay = 0, s.rail.drag || s.doScrollBy(a)
                    }, 15)
                }
                return a.stopImmediatePropagation(), a.preventDefault()
            }

            var s = this;
            if (this.version = "3.5.4", this.name = "nicescroll", this.me = j, this.opt = {doc:a("body"), win:!1}, a.extend(this.opt, m), this.opt.snapbackspeed = 80, g)for (var t in s.opt)"undefined" != typeof g[t] && (s.opt[t] = g[t]);
            this.iddoc = (this.doc = s.opt.doc) && this.doc[0] ? this.doc[0].id || "" : "", this.ispage = /^BODY|HTML/.test(s.opt.win ? s.opt.win[0].nodeName : this.doc[0].nodeName), this.haswrapper = !1 !== s.opt.win, this.win = s.opt.win || (this.ispage ? a(window) : this.doc), this.docscroll = this.ispage && !this.haswrapper ? a(window) : this.win, this.body = a("body"), this.iframe = this.isfixed = this.viewport = !1, this.isiframe = "IFRAME" == this.doc[0].nodeName && "IFRAME" == this.win[0].nodeName, this.istextarea = "TEXTAREA" == this.win[0].nodeName, this.forcescreen = !1, this.canshowonmouseevent = "scroll" != s.opt.autohidemode, this.page = this.view = this.onzoomout = this.onzoomin = this.onscrollcancel = this.onscrollend = this.onscrollstart = this.onclick = this.ongesturezoom = this.onkeypress = this.onmousewheel = this.onmousemove = this.onmouseup = this.onmousedown = !1, this.scroll = {x:0, y:0}, this.scrollratio = {x:0, y:0}, this.cursorheight = 20, this.scrollvaluemax = 0, this.observerremover = this.observer = this.scrollmom = this.scrollrunning = this.isrtlmode = !1;
            do this.id = "ascrail" + e++; while (document.getElementById(this.id));
            this.hasmousefocus = this.hasfocus = this.zoomactive = this.zoom = this.selectiondrag = this.cursorfreezed = this.cursor = this.rail = !1, this.visibility = !0, this.hidden = this.locked = !1, this.cursoractive = !0, this.wheelprevented = !1, this.overflowx = s.opt.overflowx, this.overflowy = s.opt.overflowy, this.nativescrollingarea = !1, this.checkarea = 0, this.events = [], this.saved = {}, this.delaylist = {}, this.synclist = {}, this.lastdeltay = this.lastdeltax = 0, this.detected = o();
            var u = a.extend({}, this.detected);
            this.ishwscroll = (this.canhwscroll = u.hastransform && s.opt.hwacceleration) && s.haswrapper, this.istouchcapable = !1, u.cantouch && u.ischrome && !u.isios && !u.isandroid && (this.istouchcapable = !0, u.cantouch = !1), u.cantouch && u.ismozilla && !u.isios && !u.isandroid && (this.istouchcapable = !0, u.cantouch = !1), s.opt.enablemouselockapi || (u.hasmousecapture = !1, u.haspointerlock = !1), this.delayed = function (a, b, c, d) {
                var e = s.delaylist[a], f = (new Date).getTime();
                return!d && e && e.tt ? !1 : (e && e.tt && clearTimeout(e.tt), void(e && e.last + c > f && !e.tt ? s.delaylist[a] = {last:f + c, tt:setTimeout(function () {
                    s && (s.delaylist[a].tt = 0, b.call())
                }, c)} : e && e.tt || (s.delaylist[a] = {last:f, tt:0}, setTimeout(function () {
                    b.call()
                }, 0))))
            }, this.debounced = function (a, b, c) {
                var d = s.delaylist[a];
                (new Date).getTime(), s.delaylist[a] = b, d || setTimeout(function () {
                    var b = s.delaylist[a];
                    s.delaylist[a] = !1, b.call()
                }, c)
            };
            var v = !1;
            if (this.synched = function (a, b) {
                return s.synclist[a] = b, function () {
                    v || (h(function () {
                        v = !1;
                        for (a in s.synclist) {
                            var b = s.synclist[a];
                            b && b.call(s), s.synclist[a] = !1
                        }
                    }), v = !0)
                }(), a
            }, this.unsynched = function (a) {
                s.synclist[a] && (s.synclist[a] = !1)
            }, this.css = function (a, b) {
                for (var c in b)s.saved.css.push([a, c, a.css(c)]), a.css(c, b[c])
            }, this.scrollTop = function (a) {
                return"undefined" == typeof a ? s.getScrollTop() : s.setScrollTop(a)
            }, this.scrollLeft = function (a) {
                return"undefined" == typeof a ? s.getScrollLeft() : s.setScrollLeft(a)
            }, BezierClass = function (a, b, c, d, e, f, g) {
                this.st = a, this.ed = b, this.spd = c, this.p1 = d || 0, this.p2 = e || 1, this.p3 = f || 0, this.p4 = g || 1, this.ts = (new Date).getTime(), this.df = this.ed - this.st
            }, BezierClass.prototype = {B2:function (a) {
                return 3 * a * a * (1 - a)
            }, B3:function (a) {
                return 3 * a * (1 - a) * (1 - a)
            }, B4:function (a) {
                return(1 - a) * (1 - a) * (1 - a)
            }, getNow:function () {
                var a = 1 - ((new Date).getTime() - this.ts) / this.spd, b = this.B2(a) + this.B3(a) + this.B4(a);
                return 0 > a ? this.ed : this.st + Math.round(this.df * b)
            }, update:function (a, b) {
                return this.st = this.getNow(), this.ed = a, this.spd = b, this.ts = (new Date).getTime(), this.df = this.ed - this.st, this
            }}, this.ishwscroll) {
                this.doc.translate = {x:0, y:0, tx:"0px", ty:"0px"}, u.hastranslate3d && u.isios && this.doc.css("-webkit-backface-visibility", "hidden");
                var w = function () {
                    var a = s.doc.css(u.trstyle);
                    return a && "matrix" == a.substr(0, 6) ? a.replace(/^.*\((.*)\)$/g, "$1").replace(/px/g, "").split(/, +/) : !1
                };
                this.getScrollTop = function (a) {
                    if (!a) {
                        if (a = w())return 16 == a.length ? -a[13] : -a[5];
                        if (s.timerscroll && s.timerscroll.bz)return s.timerscroll.bz.getNow()
                    }
                    return s.doc.translate.y
                }, this.getScrollLeft = function (a) {
                    if (!a) {
                        if (a = w())return 16 == a.length ? -a[12] : -a[4];
                        if (s.timerscroll && s.timerscroll.bh)return s.timerscroll.bh.getNow()
                    }
                    return s.doc.translate.x
                }, this.notifyScrollEvent = document.createEvent ? function (a) {
                    var b = document.createEvent("UIEvents");
                    b.initUIEvent("scroll", !1, !0, window, 1), a.dispatchEvent(b)
                } : document.fireEvent ? function (a) {
                    var b = document.createEventObject();
                    a.fireEvent("onscroll"), b.cancelBubble = !0
                } : function () {
                }, u.hastranslate3d && s.opt.enabletranslate3d ? (this.setScrollTop = function (a, b) {
                    s.doc.translate.y = a, s.doc.translate.ty = -1 * a + "px", s.doc.css(u.trstyle, "translate3d(" + s.doc.translate.tx + "," + s.doc.translate.ty + ",0px)"), b || s.notifyScrollEvent(s.win[0])
                }, this.setScrollLeft = function (a, b) {
                    s.doc.translate.x = a, s.doc.translate.tx = -1 * a + "px", s.doc.css(u.trstyle, "translate3d(" + s.doc.translate.tx + "," + s.doc.translate.ty + ",0px)"), b || s.notifyScrollEvent(s.win[0])
                }) : (this.setScrollTop = function (a, b) {
                    s.doc.translate.y = a, s.doc.translate.ty = -1 * a + "px", s.doc.css(u.trstyle, "translate(" + s.doc.translate.tx + "," + s.doc.translate.ty + ")"), b || s.notifyScrollEvent(s.win[0])
                }, this.setScrollLeft = function (a, b) {
                    s.doc.translate.x = a, s.doc.translate.tx = -1 * a + "px", s.doc.css(u.trstyle, "translate(" + s.doc.translate.tx + "," + s.doc.translate.ty + ")"), b || s.notifyScrollEvent(s.win[0])
                })
            } else this.getScrollTop = function () {
                return s.docscroll.scrollTop()
            }, this.setScrollTop = function (a) {
                return s.docscroll.scrollTop(a)
            }, this.getScrollLeft = function () {
                return s.docscroll.scrollLeft()
            }, this.setScrollLeft = function (a) {
                return s.docscroll.scrollLeft(a)
            };
            this.getTarget = function (a) {
                return a ? a.target ? a.target : a.srcElement ? a.srcElement : !1 : !1
            }, this.hasParent = function (a, b) {
                if (!a)return!1;
                for (var c = a.target || a.srcElement || a || !1; c && c.id != b;)c = c.parentNode || !1;
                return!1 !== c
            };
            var x = {thin:1, medium:3, thick:5};
            this.getOffset = function () {
                if (s.isfixed)return{top:parseFloat(s.win.css("top")), left:parseFloat(s.win.css("left"))};
                if (!s.viewport)return s.win.offset();
                var a = s.win.offset(), b = s.viewport.offset();
                return{top:a.top - b.top + s.viewport.scrollTop(), left:a.left - b.left + s.viewport.scrollLeft()}
            }, this.updateScrollBar = function (a) {
                if (s.ishwscroll)s.rail.css({height:s.win.innerHeight()}), s.railh && s.railh.css({width:s.win.innerWidth()}); else {
                    var b = s.getOffset(), c = b.top, d = b.left, c = c + n(s.win, "border-top-width", !0);
                    s.win.outerWidth(), s.win.innerWidth();
                    var d = d + (s.rail.align ? s.win.outerWidth() - n(s.win, "border-right-width") - s.rail.width : n(s.win, "border-left-width")), e = s.opt.railoffset;
                    e && (e.top && (c += e.top), s.rail.align && e.left && (d += e.left)), s.locked || s.rail.css({top:c, left:d, height:a ? a.h : s.win.innerHeight()}), s.zoom && s.zoom.css({top:c + 1, left:1 == s.rail.align ? d - 20 : d + s.rail.width + 4}), s.railh && !s.locked && (c = b.top, d = b.left, a = s.railh.align ? c + n(s.win, "border-top-width", !0) + s.win.innerHeight() - s.railh.height : c + n(s.win, "border-top-width", !0), d += n(s.win, "border-left-width"), s.railh.css({top:a, left:d, width:s.railh.width}))
                }
            }, this.doRailClick = function (a, b, c) {
                var d;
                s.locked || (s.cancelEvent(a), b ? (b = c ? s.doScrollLeft : s.doScrollTop, d = c ? (a.pageX - s.railh.offset().left - s.cursorwidth / 2) * s.scrollratio.x : (a.pageY - s.rail.offset().top - s.cursorheight / 2) * s.scrollratio.y, b(d)) : (b = c ? s.doScrollLeftBy : s.doScrollBy, d = c ? s.scroll.x : s.scroll.y, a = c ? a.pageX - s.railh.offset().left : a.pageY - s.rail.offset().top, c = c ? s.view.w : s.view.h, b(d >= a ? c : -c)))
            }, s.hasanimationframe = h, s.hascancelanimationframe = i, s.hasanimationframe ? s.hascancelanimationframe || (i = function () {
                s.cancelAnimationFrame = !0
            }) : (h = function (a) {
                return setTimeout(a, 15 - Math.floor(+new Date / 1e3) % 16)
            }, i = clearInterval), this.init = function () {
                if (s.saved.css = [], u.isie7mobile || u.isoperamini)return!0;
                if (u.hasmstouch && s.css(s.ispage ? a("html") : s.win, {"-ms-touch-action":"none"}), s.zindex = "auto", s.zindex = s.ispage || "auto" != s.opt.zindex ? s.opt.zindex : k() || "auto", !s.ispage && "auto" != s.zindex && s.zindex > f && (f = s.zindex), s.isie && 0 == s.zindex && "auto" == s.opt.zindex && (s.zindex = "auto"), !s.ispage || !u.cantouch && !u.isieold && !u.isie9mobile) {
                    var e = s.docscroll;
                    s.ispage && (e = s.haswrapper ? s.win : s.doc), u.isie9mobile || s.css(e, {"overflow-y":"hidden"}), s.ispage && u.isie7 && ("BODY" == s.doc[0].nodeName ? s.css(a("html"), {"overflow-y":"hidden"}) : "HTML" == s.doc[0].nodeName && s.css(a("body"), {"overflow-y":"hidden"})), u.isios && !s.ispage && !s.haswrapper && s.css(a("body"), {"-webkit-overflow-scrolling":"touch"});
                    var g = a(document.createElement("div"));
                    g.css({position:"relative", top:0, "float":"right", width:s.opt.cursorwidth, height:"0px", "background-color":s.opt.cursorcolor, border:s.opt.cursorborder, "background-clip":"padding-box", "-webkit-border-radius":s.opt.cursorborderradius, "-moz-border-radius":s.opt.cursorborderradius, "border-radius":s.opt.cursorborderradius}), g.hborder = parseFloat(g.outerHeight() - g.innerHeight()), s.cursor = g;
                    var h = a(document.createElement("div"));
                    h.attr("id", s.id), h.addClass("nicescroll-rails");
                    var i, j, m, n = ["left", "right"];
                    for (m in n)j = n[m], (i = s.opt.railpadding[j]) ? h.css("padding-" + j, i + "px") : s.opt.railpadding[j] = 0;
                    if (h.append(g), h.width = Math.max(parseFloat(s.opt.cursorwidth), g.outerWidth()) + s.opt.railpadding.left + s.opt.railpadding.right, h.css({width:h.width + "px", zIndex:s.zindex, background:s.opt.background, cursor:"default"}), h.visibility = !0, h.scrollable = !0, h.align = "left" == s.opt.railalign ? 0 : 1, s.rail = h, g = s.rail.drag = !1, s.opt.boxzoom && !s.ispage && !u.isieold && (g = document.createElement("div"), s.bind(g, "click", s.doZoom), s.zoom = a(g), s.zoom.css({cursor:"pointer", "z-index":s.zindex, backgroundImage:"url(" + s.opt.scriptpath + "zoomico.png)", height:18, width:18, backgroundPosition:"0px 0px"}), s.opt.dblclickzoom && s.bind(s.win, "dblclick", s.doZoom), u.cantouch && s.opt.gesturezoom && (s.ongesturezoom = function (a) {
                        return 1.5 < a.scale && s.doZoomIn(a), .8 > a.scale && s.doZoomOut(a), s.cancelEvent(a)
                    }, s.bind(s.win, "gestureend", s.ongesturezoom))), s.railh = !1, s.opt.horizrailenabled) {
                        s.css(e, {"overflow-x":"hidden"}), g = a(document.createElement("div")), g.css({position:"relative", top:0, height:s.opt.cursorwidth, width:"0px", "background-color":s.opt.cursorcolor, border:s.opt.cursorborder, "background-clip":"padding-box", "-webkit-border-radius":s.opt.cursorborderradius, "-moz-border-radius":s.opt.cursorborderradius, "border-radius":s.opt.cursorborderradius}), g.wborder = parseFloat(g.outerWidth() - g.innerWidth()), s.cursorh = g;
                        var o = a(document.createElement("div"));
                        o.attr("id", s.id + "-hr"), o.addClass("nicescroll-rails"), o.height = Math.max(parseFloat(s.opt.cursorwidth), g.outerHeight()), o.css({height:o.height + "px", zIndex:s.zindex, background:s.opt.background}), o.append(g), o.visibility = !0, o.scrollable = !0, o.align = "top" == s.opt.railvalign ? 0 : 1, s.railh = o, s.railh.drag = !1
                    }
                    if (s.ispage ? (h.css({position:"fixed", top:"0px", height:"100%"}), h.css(h.align ? {right:"0px"} : {left:"0px"}), s.body.append(h), s.railh && (o.css({position:"fixed", left:"0px", width:"100%"}), o.css(o.align ? {bottom:"0px"} : {top:"0px"}), s.body.append(o))) : (s.ishwscroll ? ("static" == s.win.css("position") && s.css(s.win, {position:"relative"}), e = "HTML" == s.win[0].nodeName ? s.body : s.win, s.zoom && (s.zoom.css({position:"absolute", top:1, right:0, "margin-right":h.width + 4}), e.append(s.zoom)), h.css({position:"absolute", top:0}), h.css(h.align ? {right:0} : {left:0}), e.append(h), o && (o.css({position:"absolute", left:0, bottom:0}), o.css(o.align ? {bottom:0} : {top:0}), e.append(o))) : (s.isfixed = "fixed" == s.win.css("position"), e = s.isfixed ? "fixed" : "absolute", s.isfixed || (s.viewport = s.getViewport(s.win[0])), s.viewport && (s.body = s.viewport, 0 == /fixed|relative|absolute/.test(s.viewport.css("position")) && s.css(s.viewport, {position:"relative"})), h.css({position:e}), s.zoom && s.zoom.css({position:e}), s.updateScrollBar(), s.body.append(h), s.zoom && s.body.append(s.zoom), s.railh && (o.css({position:e}), s.body.append(o))), u.isios && s.css(s.win, {"-webkit-tap-highlight-color":"rgba(0,0,0,0)", "-webkit-touch-callout":"none"}), u.isie && s.opt.disableoutline && s.win.attr("hideFocus", "true"), u.iswebkit && s.opt.disableoutline && s.win.css({outline:"none"})), !1 === s.opt.autohidemode ? (s.autohidedom = !1, s.rail.css({opacity:s.opt.cursoropacitymax}), s.railh && s.railh.css({opacity:s.opt.cursoropacitymax})) : !0 === s.opt.autohidemode || "leave" === s.opt.autohidemode ? (s.autohidedom = a().add(s.rail), u.isie8 && (s.autohidedom = s.autohidedom.add(s.cursor)), s.railh && (s.autohidedom = s.autohidedom.add(s.railh)), s.railh && u.isie8 && (s.autohidedom = s.autohidedom.add(s.cursorh))) : "scroll" == s.opt.autohidemode ? (s.autohidedom = a().add(s.rail), s.railh && (s.autohidedom = s.autohidedom.add(s.railh))) : "cursor" == s.opt.autohidemode ? (s.autohidedom = a().add(s.cursor), s.railh && (s.autohidedom = s.autohidedom.add(s.cursorh))) : "hidden" == s.opt.autohidemode && (s.autohidedom = !1, s.hide(), s.locked = !1), u.isie9mobile)s.scrollmom = new q(s), s.onmangotouch = function (a) {
                        a = s.getScrollTop();
                        var b = s.getScrollLeft();
                        if (a == s.scrollmom.lastscrolly && b == s.scrollmom.lastscrollx)return!0;
                        var c = a - s.mangotouch.sy, d = b - s.mangotouch.sx;
                        if (0 != Math.round(Math.sqrt(Math.pow(d, 2) + Math.pow(c, 2)))) {
                            var e = 0 > c ? -1 : 1, f = 0 > d ? -1 : 1, g = +new Date;
                            s.mangotouch.lazy && clearTimeout(s.mangotouch.lazy), 80 < g - s.mangotouch.tm || s.mangotouch.dry != e || s.mangotouch.drx != f ? (s.scrollmom.stop(), s.scrollmom.reset(b, a), s.mangotouch.sy = a, s.mangotouch.ly = a, s.mangotouch.sx = b, s.mangotouch.lx = b, s.mangotouch.dry = e, s.mangotouch.drx = f, s.mangotouch.tm = g) : (s.scrollmom.stop(), s.scrollmom.update(s.mangotouch.sx - d, s.mangotouch.sy - c), s.mangotouch.tm = g, c = Math.max(Math.abs(s.mangotouch.ly - a), Math.abs(s.mangotouch.lx - b)), s.mangotouch.ly = a, s.mangotouch.lx = b, c > 2 && (s.mangotouch.lazy = setTimeout(function () {
                                s.mangotouch.lazy = !1, s.mangotouch.dry = 0, s.mangotouch.drx = 0, s.mangotouch.tm = 0, s.scrollmom.doMomentum(30)
                            }, 100)))
                        }
                    }, h = s.getScrollTop(), o = s.getScrollLeft(), s.mangotouch = {sy:h, ly:h, dry:0, sx:o, lx:o, drx:0, lazy:!1, tm:0}, s.bind(s.docscroll, "scroll", s.onmangotouch); else {
                        if (u.cantouch || s.istouchcapable || s.opt.touchbehavior || u.hasmstouch) {
                            s.scrollmom = new q(s), s.ontouchstart = function (b) {
                                if (b.pointerType && 2 != b.pointerType)return!1;
                                if (s.hasmoving = !1, !s.locked) {
                                    if (u.hasmstouch)for (var c = b.target ? b.target : !1; c;) {
                                        var d = a(c).getNiceScroll();
                                        if (0 < d.length && d[0].me == s.me)break;
                                        if (0 < d.length)return!1;
                                        if ("DIV" == c.nodeName && c.id == s.id)break;
                                        c = c.parentNode ? c.parentNode : !1
                                    }
                                    if (s.cancelScroll(), (c = s.getTarget(b)) && /INPUT/i.test(c.nodeName) && /range/i.test(c.type))return s.stopPropagation(b);
                                    if (!("clientX"in b) && "changedTouches"in b && (b.clientX = b.changedTouches[0].clientX, b.clientY = b.changedTouches[0].clientY), s.forcescreen && (d = b, b = {original:b.original ? b.original : b}, b.clientX = d.screenX, b.clientY = d.screenY), s.rail.drag = {x:b.clientX, y:b.clientY, sx:s.scroll.x, sy:s.scroll.y, st:s.getScrollTop(), sl:s.getScrollLeft(), pt:2, dl:!1}, s.ispage || !s.opt.directionlockdeadzone)s.rail.drag.dl = "f"; else {
                                        var d = a(window).width(), e = a(window).height(), f = Math.max(document.body.scrollWidth, document.documentElement.scrollWidth), g = Math.max(document.body.scrollHeight, document.documentElement.scrollHeight), e = Math.max(0, g - e), d = Math.max(0, f - d);
                                        s.rail.drag.ck = !s.rail.scrollable && s.railh.scrollable ? e > 0 ? "v" : !1 : s.rail.scrollable && !s.railh.scrollable && d > 0 ? "h" : !1, s.rail.drag.ck || (s.rail.drag.dl = "f")
                                    }
                                    if (s.opt.touchbehavior && s.isiframe && u.isie && (d = s.win.position(), s.rail.drag.x += d.left, s.rail.drag.y += d.top), s.hasmoving = !1, s.lastmouseup = !1, s.scrollmom.reset(b.clientX, b.clientY), !u.cantouch && !this.istouchcapable && !u.hasmstouch) {
                                        if (!c || !/INPUT|SELECT|TEXTAREA/i.test(c.nodeName))return!s.ispage && u.hasmousecapture && c.setCapture(), s.opt.touchbehavior ? (c.onclick && !c._onclick && (c._onclick = c.onclick, c.onclick = function (a) {
                                            return s.hasmoving ? !1 : void c._onclick.call(this, a)
                                        }), s.cancelEvent(b)) : s.stopPropagation(b);
                                        /SUBMIT|CANCEL|BUTTON/i.test(a(c).attr("type")) && (pc = {tg:c, click:!1}, s.preventclick = pc)
                                    }
                                }
                            }, s.ontouchend = function (a) {
                                return a.pointerType && 2 != a.pointerType ? !1 : s.rail.drag && 2 == s.rail.drag.pt && (s.scrollmom.doMomentum(), s.rail.drag = !1, s.hasmoving && (s.lastmouseup = !0, s.hideCursor(), u.hasmousecapture && document.releaseCapture(), !u.cantouch)) ? s.cancelEvent(a) : void 0
                            };
                            var p = s.opt.touchbehavior && s.isiframe && !u.hasmousecapture;
                            s.ontouchmove = function (b, c) {
                                if (b.pointerType && 2 != b.pointerType)return!1;
                                if (s.rail.drag && 2 == s.rail.drag.pt) {
                                    if (u.cantouch && "undefined" == typeof b.original)return!0;
                                    if (s.hasmoving = !0, s.preventclick && !s.preventclick.click && (s.preventclick.click = s.preventclick.tg.onclick || !1, s.preventclick.tg.onclick = s.onpreventclick), b = a.extend({original:b}, b), "changedTouches"in b && (b.clientX = b.changedTouches[0].clientX, b.clientY = b.changedTouches[0].clientY), s.forcescreen) {
                                        var d = b;
                                        b = {original:b.original ? b.original : b}, b.clientX = d.screenX, b.clientY = d.screenY
                                    }
                                    if (d = ofy = 0, p && !c) {
                                        var e = s.win.position(), d = -e.left;
                                        ofy = -e.top
                                    }
                                    var f = b.clientY + ofy, e = f - s.rail.drag.y, g = b.clientX + d, h = g - s.rail.drag.x, i = s.rail.drag.st - e;
                                    if (s.ishwscroll && s.opt.bouncescroll ? 0 > i ? i = Math.round(i / 2) : i > s.page.maxh && (i = s.page.maxh + Math.round((i - s.page.maxh) / 2)) : (0 > i && (f = i = 0), i > s.page.maxh && (i = s.page.maxh, f = 0)), s.railh && s.railh.scrollable) {
                                        var j = s.rail.drag.sl - h;
                                        s.ishwscroll && s.opt.bouncescroll ? 0 > j ? j = Math.round(j / 2) : j > s.page.maxw && (j = s.page.maxw + Math.round((j - s.page.maxw) / 2)) : (0 > j && (g = j = 0), j > s.page.maxw && (j = s.page.maxw, g = 0))
                                    }
                                    if (d = !1, s.rail.drag.dl)d = !0, "v" == s.rail.drag.dl ? j = s.rail.drag.sl : "h" == s.rail.drag.dl && (i = s.rail.drag.st); else {
                                        var e = Math.abs(e), h = Math.abs(h), k = s.opt.directionlockdeadzone;
                                        if ("v" == s.rail.drag.ck) {
                                            if (e > k && .3 * e >= h)return s.rail.drag = !1, !0;
                                            h > k && (s.rail.drag.dl = "f", a("body").scrollTop(a("body").scrollTop()))
                                        } else if ("h" == s.rail.drag.ck) {
                                            if (h > k && .3 * h >= e)return s.rail.drag = !1, !0;
                                            e > k && (s.rail.drag.dl = "f", a("body").scrollLeft(a("body").scrollLeft()))
                                        }
                                    }
                                    if (s.synched("touchmove", function () {
                                        s.rail.drag && 2 == s.rail.drag.pt && (s.prepareTransition && s.prepareTransition(0), s.rail.scrollable && s.setScrollTop(i), s.scrollmom.update(g, f), s.railh && s.railh.scrollable ? (s.setScrollLeft(j), s.showCursor(i, j)) : s.showCursor(i), u.isie10 && document.selection.clear())
                                    }), u.ischrome && s.istouchcapable && (d = !1), d)return s.cancelEvent(b)
                                }
                            }
                        }
                        if (s.onmousedown = function (a, b) {
                            if (!s.rail.drag || 1 == s.rail.drag.pt) {
                                if (s.locked)return s.cancelEvent(a);
                                s.cancelScroll(), s.rail.drag = {x:a.clientX, y:a.clientY, sx:s.scroll.x, sy:s.scroll.y, pt:1, hr:!!b};
                                var c = s.getTarget(a);
                                return!s.ispage && u.hasmousecapture && c.setCapture(), s.isiframe && !u.hasmousecapture && (s.saved.csspointerevents = s.doc.css("pointer-events"), s.css(s.doc, {"pointer-events":"none"})), s.hasmoving = !1, s.cancelEvent(a)
                            }
                        }, s.onmouseup = function (a) {
                            return s.rail.drag && (u.hasmousecapture && document.releaseCapture(), s.isiframe && !u.hasmousecapture && s.doc.css("pointer-events", s.saved.csspointerevents), 1 == s.rail.drag.pt) ? (s.rail.drag = !1, s.hasmoving && s.triggerScrollEnd(), s.cancelEvent(a)) : void 0
                        }, s.onmousemove = function (a) {
                            if (s.rail.drag && 1 == s.rail.drag.pt) {
                                if (u.ischrome && 0 == a.which)return s.onmouseup(a);
                                if (s.cursorfreezed = !0, s.hasmoving = !0, s.rail.drag.hr) {
                                    s.scroll.x = s.rail.drag.sx + (a.clientX - s.rail.drag.x), 0 > s.scroll.x && (s.scroll.x = 0);
                                    var b = s.scrollvaluemaxw;
                                    s.scroll.x > b && (s.scroll.x = b)
                                } else s.scroll.y = s.rail.drag.sy + (a.clientY - s.rail.drag.y), 0 > s.scroll.y && (s.scroll.y = 0), b = s.scrollvaluemax, s.scroll.y > b && (s.scroll.y = b);
                                return s.synched("mousemove", function () {
                                    s.rail.drag && 1 == s.rail.drag.pt && (s.showCursor(), s.rail.drag.hr ? s.doScrollLeft(Math.round(s.scroll.x * s.scrollratio.x), s.opt.cursordragspeed) : s.doScrollTop(Math.round(s.scroll.y * s.scrollratio.y), s.opt.cursordragspeed))
                                }), s.cancelEvent(a)
                            }
                        }, u.cantouch || s.opt.touchbehavior)s.onpreventclick = function (a) {
                            return s.preventclick ? (s.preventclick.tg.onclick = s.preventclick.click, s.preventclick = !1, s.cancelEvent(a)) : void 0
                        }, s.bind(s.win, "mousedown", s.ontouchstart), s.onclick = u.isios ? !1 : function (a) {
                            return s.lastmouseup ? (s.lastmouseup = !1, s.cancelEvent(a)) : !0
                        }, s.opt.grabcursorenabled && u.cursorgrabvalue && (s.css(s.ispage ? s.doc : s.win, {cursor:u.cursorgrabvalue}), s.css(s.rail, {cursor:u.cursorgrabvalue})); else {
                            var r = function (a) {
                                if (s.selectiondrag) {
                                    if (a) {
                                        var b = s.win.outerHeight();
                                        a = a.pageY - s.selectiondrag.top, a > 0 && b > a && (a = 0), a >= b && (a -= b), s.selectiondrag.df = a
                                    }
                                    0 != s.selectiondrag.df && (s.doScrollBy(2 * -Math.floor(s.selectiondrag.df / 6)), s.debounced("doselectionscroll", function () {
                                        r()
                                    }, 50))
                                }
                            };
                            s.hasTextSelected = "getSelection"in document ? function () {
                                return 0 < document.getSelection().rangeCount
                            } : "selection"in document ? function () {
                                return"None" != document.selection.type
                            } : function () {
                                return!1
                            }, s.onselectionstart = function () {
                                s.ispage || (s.selectiondrag = s.win.offset())
                            }, s.onselectionend = function () {
                                s.selectiondrag = !1
                            }, s.onselectiondrag = function (a) {
                                s.selectiondrag && s.hasTextSelected() && s.debounced("selectionscroll", function () {
                                    r(a)
                                }, 250)
                            }
                        }
                        u.hasmstouch && (s.css(s.rail, {"-ms-touch-action":"none"}), s.css(s.cursor, {"-ms-touch-action":"none"}), s.bind(s.win, "MSPointerDown", s.ontouchstart), s.bind(document, "MSPointerUp", s.ontouchend), s.bind(document, "MSPointerMove", s.ontouchmove), s.bind(s.cursor, "MSGestureHold", function (a) {
                            a.preventDefault()
                        }), s.bind(s.cursor, "contextmenu", function (a) {
                            a.preventDefault()
                        })), this.istouchcapable && (s.bind(s.win, "touchstart", s.ontouchstart), s.bind(document, "touchend", s.ontouchend), s.bind(document, "touchcancel", s.ontouchend), s.bind(document, "touchmove", s.ontouchmove)), s.bind(s.cursor, "mousedown", s.onmousedown), s.bind(s.cursor, "mouseup", s.onmouseup), s.railh && (s.bind(s.cursorh, "mousedown", function (a) {
                            s.onmousedown(a, !0)
                        }), s.bind(s.cursorh, "mouseup", s.onmouseup)), (s.opt.cursordragontouch || !u.cantouch && !s.opt.touchbehavior) && (s.rail.css({cursor:"default"}), s.railh && s.railh.css({cursor:"default"}), s.jqbind(s.rail, "mouseenter", function () {
                            return s.win.is(":visible") ? (s.canshowonmouseevent && s.showCursor(), void(s.rail.active = !0)) : !1
                        }), s.jqbind(s.rail, "mouseleave", function () {
                            s.rail.active = !1, s.rail.drag || s.hideCursor()
                        }), s.opt.sensitiverail && (s.bind(s.rail, "click", function (a) {
                            s.doRailClick(a, !1, !1)
                        }), s.bind(s.rail, "dblclick", function (a) {
                            s.doRailClick(a, !0, !1)
                        }), s.bind(s.cursor, "click", function (a) {
                            s.cancelEvent(a)
                        }), s.bind(s.cursor, "dblclick", function (a) {
                            s.cancelEvent(a)
                        })), s.railh && (s.jqbind(s.railh, "mouseenter", function () {
                            return s.win.is(":visible") ? (s.canshowonmouseevent && s.showCursor(), void(s.rail.active = !0)) : !1
                        }), s.jqbind(s.railh, "mouseleave", function () {
                            s.rail.active = !1, s.rail.drag || s.hideCursor()
                        }), s.opt.sensitiverail && (s.bind(s.railh, "click", function (a) {
                            s.doRailClick(a, !1, !0)
                        }), s.bind(s.railh, "dblclick", function (a) {
                            s.doRailClick(a, !0, !0)
                        }), s.bind(s.cursorh, "click", function (a) {
                            s.cancelEvent(a)
                        }), s.bind(s.cursorh, "dblclick", function (a) {
                            s.cancelEvent(a)
                        })))), u.cantouch || s.opt.touchbehavior ? (s.bind(u.hasmousecapture ? s.win : document, "mouseup", s.ontouchend), s.bind(document, "mousemove", s.ontouchmove), s.onclick && s.bind(document, "click", s.onclick), s.opt.cursordragontouch && (s.bind(s.cursor, "mousedown", s.onmousedown), s.bind(s.cursor, "mousemove", s.onmousemove), s.cursorh && s.bind(s.cursorh, "mousedown", function (a) {
                            s.onmousedown(a, !0)
                        }), s.cursorh && s.bind(s.cursorh, "mousemove", s.onmousemove))) : (s.bind(u.hasmousecapture ? s.win : document, "mouseup", s.onmouseup), s.bind(document, "mousemove", s.onmousemove), s.onclick && s.bind(document, "click", s.onclick), !s.ispage && s.opt.enablescrollonselection && (s.bind(s.win[0], "mousedown", s.onselectionstart), s.bind(document, "mouseup", s.onselectionend), s.bind(s.cursor, "mouseup", s.onselectionend), s.cursorh && s.bind(s.cursorh, "mouseup", s.onselectionend), s.bind(document, "mousemove", s.onselectiondrag)), s.zoom && (s.jqbind(s.zoom, "mouseenter", function () {
                            s.canshowonmouseevent && s.showCursor(), s.rail.active = !0
                        }), s.jqbind(s.zoom, "mouseleave", function () {
                            s.rail.active = !1, s.rail.drag || s.hideCursor()
                        }))), s.opt.enablemousewheel && (s.isiframe || s.bind(u.isie && s.ispage ? document : s.win, "mousewheel", s.onmousewheel), s.bind(s.rail, "mousewheel", s.onmousewheel), s.railh && s.bind(s.railh, "mousewheel", s.onmousewheelhr)), !s.ispage && !u.cantouch && !/HTML|^BODY/.test(s.win[0].nodeName) && (s.win.attr("tabindex") || s.win.attr({tabindex:d++}), s.jqbind(s.win, "focus", function (a) {
                            b = s.getTarget(a).id || !0, s.hasfocus = !0, s.canshowonmouseevent && s.noticeCursor()
                        }), s.jqbind(s.win, "blur", function () {
                            b = !1, s.hasfocus = !1
                        }), s.jqbind(s.win, "mouseenter", function (a) {
                            c = s.getTarget(a).id || !0, s.hasmousefocus = !0, s.canshowonmouseevent && s.noticeCursor()
                        }), s.jqbind(s.win, "mouseleave", function () {
                            c = !1, s.hasmousefocus = !1, s.rail.drag || s.hideCursor()
                        }))
                    }
                    if (s.onkeypress = function (d) {
                        if (s.locked && 0 == s.page.maxh)return!0;
                        d = d ? d : window.e;
                        var e = s.getTarget(d);
                        if (e && /INPUT|TEXTAREA|SELECT|OPTION/.test(e.nodeName) && (!e.getAttribute("type") && !e.type || !/submit|button|cancel/i.tp) || a(e).attr("contenteditable"))return!0;
                        if (s.hasfocus || s.hasmousefocus && !b || s.ispage && !b && !c) {
                            if (e = d.keyCode, s.locked && 27 != e)return s.cancelEvent(d);
                            var f = d.ctrlKey || !1, g = d.shiftKey || !1, h = !1;
                            switch (e) {
                                case 38:
                                case 63233:
                                    s.doScrollBy(72), h = !0;
                                    break;
                                case 40:
                                case 63235:
                                    s.doScrollBy(-72), h = !0;
                                    break;
                                case 37:
                                case 63232:
                                    s.railh && (f ? s.doScrollLeft(0) : s.doScrollLeftBy(72), h = !0);
                                    break;
                                case 39:
                                case 63234:
                                    s.railh && (f ? s.doScrollLeft(s.page.maxw) : s.doScrollLeftBy(-72), h = !0);
                                    break;
                                case 33:
                                case 63276:
                                    s.doScrollBy(s.view.h), h = !0;
                                    break;
                                case 34:
                                case 63277:
                                    s.doScrollBy(-s.view.h), h = !0;
                                    break;
                                case 36:
                                case 63273:
                                    s.railh && f ? s.doScrollPos(0, 0) : s.doScrollTo(0), h = !0;
                                    break;
                                case 35:
                                case 63275:
                                    s.railh && f ? s.doScrollPos(s.page.maxw, s.page.maxh) : s.doScrollTo(s.page.maxh), h = !0;
                                    break;
                                case 32:
                                    s.opt.spacebarenabled && (s.doScrollBy(g ? s.view.h : -s.view.h), h = !0);
                                    break;
                                case 27:
                                    s.zoomactive && (s.doZoom(), h = !0)
                            }
                            if (h)return s.cancelEvent(d)
                        }
                    }, s.opt.enablekeyboard && s.bind(document, u.isopera && !u.isopera12 ? "keypress" : "keydown", s.onkeypress), s.bind(document, "keydown", function (a) {
                        a.ctrlKey && (s.wheelprevented = !0)
                    }), s.bind(document, "keyup", function (a) {
                        a.ctrlKey || (s.wheelprevented = !1)
                    }), s.bind(window, "resize", s.lazyResize), s.bind(window, "orientationchange", s.lazyResize), s.bind(window, "load", s.lazyResize), u.ischrome && !s.ispage && !s.haswrapper) {
                        var t = s.win.attr("style"), h = parseFloat(s.win.css("width")) + 1;
                        s.win.css("width", h), s.synched("chromefix", function () {
                            s.win.attr("style", t)
                        })
                    }
                    s.onAttributeChange = function () {
                        s.lazyResize(250)
                    }, !s.ispage && !s.haswrapper && (!1 !== l ? (s.observer = new l(function (a) {
                        a.forEach(s.onAttributeChange)
                    }), s.observer.observe(s.win[0], {childList:!0, characterData:!1, attributes:!0, subtree:!1}), s.observerremover = new l(function (a) {
                        a.forEach(function (a) {
                            if (0 < a.removedNodes.length)for (var b in a.removedNodes)if (a.removedNodes[b] == s.win[0])return s.remove()
                        })
                    }), s.observerremover.observe(s.win[0].parentNode, {childList:!0, characterData:!1, attributes:!1, subtree:!1})) : (s.bind(s.win, u.isie && !u.isie9 ? "propertychange" : "DOMAttrModified", s.onAttributeChange), u.isie9 && s.win[0].attachEvent("onpropertychange", s.onAttributeChange), s.bind(s.win, "DOMNodeRemoved", function (a) {
                        a.target == s.win[0] && s.remove()
                    }))), !s.ispage && s.opt.boxzoom && s.bind(window, "resize", s.resizeZoom), s.istextarea && s.bind(s.win, "mouseup", s.lazyResize), s.lazyResize(30)
                }
                if ("IFRAME" == this.doc[0].nodeName) {
                    var v = function (b) {
                        s.iframexd = !1;
                        try {
                            var c = "contentDocument"in this ? this.contentDocument : this.contentWindow.document
                        } catch (d) {
                            s.iframexd = !0, c = !1
                        }
                        return s.iframexd ? ("console"in window && console.log("NiceScroll error: policy restriced iframe"), !0) : (s.forcescreen = !0, s.isiframe && (s.iframe = {doc:a(c), html:s.doc.contents().find("html")[0], body:s.doc.contents().find("body")[0]}, s.getContentSize = function () {
                            return{w:Math.max(s.iframe.html.scrollWidth, s.iframe.body.scrollWidth), h:Math.max(s.iframe.html.scrollHeight, s.iframe.body.scrollHeight)}
                        }, s.docscroll = a(s.iframe.body)), !u.isios && s.opt.iframeautoresize && !s.isiframe && (s.win.scrollTop(0), s.doc.height(""), b = Math.max(c.getElementsByTagName("html")[0].scrollHeight, c.body.scrollHeight), s.doc.height(b)), s.lazyResize(30), u.isie7 && s.css(a(s.iframe.html), {"overflow-y":"hidden"}), s.css(a(s.iframe.body), {"overflow-y":"hidden"}), u.isios && s.haswrapper && s.css(a(c.body), {"-webkit-transform":"translate3d(0,0,0)"}), "contentWindow"in this ? s.bind(this.contentWindow, "scroll", s.onscroll) : s.bind(c, "scroll", s.onscroll), s.opt.enablemousewheel && s.bind(c, "mousewheel", s.onmousewheel), s.opt.enablekeyboard && s.bind(c, u.isopera ? "keypress" : "keydown", s.onkeypress), (u.cantouch || s.opt.touchbehavior) && (s.bind(c, "mousedown", s.ontouchstart), s.bind(c, "mousemove", function (a) {
                            s.ontouchmove(a, !0)
                        }), s.opt.grabcursorenabled && u.cursorgrabvalue && s.css(a(c.body), {cursor:u.cursorgrabvalue})), s.bind(c, "mouseup", s.ontouchend), void(s.zoom && (s.opt.dblclickzoom && s.bind(c, "dblclick", s.doZoom), s.ongesturezoom && s.bind(c, "gestureend", s.ongesturezoom))))
                    };
                    this.doc[0].readyState && "complete" == this.doc[0].readyState && setTimeout(function () {
                        v.call(s.doc[0], !1)
                    }, 500), s.bind(this.doc, "load", v)
                }
            }, this.showCursor = function (a, b) {
                s.cursortimeout && (clearTimeout(s.cursortimeout), s.cursortimeout = 0), s.rail && (s.autohidedom && (s.autohidedom.stop().css({opacity:s.opt.cursoropacitymax}), s.cursoractive = !0), s.rail.drag && 1 == s.rail.drag.pt || ("undefined" != typeof a && !1 !== a && (s.scroll.y = Math.round(1 * a / s.scrollratio.y)), "undefined" != typeof b && (s.scroll.x = Math.round(1 * b / s.scrollratio.x))), s.cursor.css({height:s.cursorheight, top:s.scroll.y}), s.cursorh && (s.cursorh.css(!s.rail.align && s.rail.visibility ? {width:s.cursorwidth, left:s.scroll.x + s.rail.width} : {width:s.cursorwidth, left:s.scroll.x}), s.cursoractive = !0), s.zoom && s.zoom.stop().css({opacity:s.opt.cursoropacitymax}))
            }, this.hideCursor = function (a) {
                !s.cursortimeout && s.rail && s.autohidedom && !(s.hasmousefocus && "leave" == s.opt.autohidemode) && (s.cursortimeout = setTimeout(function () {
                    s.rail.active && s.showonmouseevent || (s.autohidedom.stop().animate({opacity:s.opt.cursoropacitymin}), s.zoom && s.zoom.stop().animate({opacity:s.opt.cursoropacitymin}), s.cursoractive = !1), s.cursortimeout = 0
                }, a || s.opt.hidecursordelay))
            }, this.noticeCursor = function (a, b, c) {
                s.showCursor(b, c), s.rail.active || s.hideCursor(a)
            }, this.getContentSize = s.ispage ? function () {
                return{w:Math.max(document.body.scrollWidth, document.documentElement.scrollWidth), h:Math.max(document.body.scrollHeight, document.documentElement.scrollHeight)}
            } : s.haswrapper ? function () {
                return{w:s.doc.outerWidth() + parseInt(s.win.css("paddingLeft")) + parseInt(s.win.css("paddingRight")), h:s.doc.outerHeight() + parseInt(s.win.css("paddingTop")) + parseInt(s.win.css("paddingBottom"))}
            } : function () {
                return{w:s.docscroll[0].scrollWidth, h:s.docscroll[0].scrollHeight}
            }, this.onResize = function (a, b) {
                if (!s || !s.win)return!1;
                if (!s.haswrapper && !s.ispage) {
                    if ("none" == s.win.css("display"))return s.visibility && s.hideRail().hideRailHr(), !1;
                    !s.hidden && !s.visibility && s.showRail().showRailHr()
                }
                var c = s.page.maxh, d = s.page.maxw, e = s.view.w;
                if (s.view = {w:s.ispage ? s.win.width() : parseInt(s.win[0].clientWidth), h:s.ispage ? s.win.height() : parseInt(s.win[0].clientHeight)}, s.page = b ? b : s.getContentSize(), s.page.maxh = Math.max(0, s.page.h - s.view.h), s.page.maxw = Math.max(0, s.page.w - s.view.w), s.page.maxh == c && s.page.maxw == d && s.view.w == e) {
                    if (s.ispage)return s;
                    if (c = s.win.offset(), s.lastposition && (d = s.lastposition, d.top == c.top && d.left == c.left))return s;
                    s.lastposition = c
                }
                return 0 == s.page.maxh ? (s.hideRail(), s.scrollvaluemax = 0, s.scroll.y = 0, s.scrollratio.y = 0, s.cursorheight = 0, s.setScrollTop(0), s.rail.scrollable = !1) : s.rail.scrollable = !0, 0 == s.page.maxw ? (s.hideRailHr(), s.scrollvaluemaxw = 0, s.scroll.x = 0, s.scrollratio.x = 0, s.cursorwidth = 0, s.setScrollLeft(0), s.railh.scrollable = !1) : s.railh.scrollable = !0, s.locked = 0 == s.page.maxh && 0 == s.page.maxw, s.locked ? (s.ispage || s.updateScrollBar(s.view), !1) : (s.hidden || s.visibility ? !s.hidden && !s.railh.visibility && s.showRailHr() : s.showRail().showRailHr(), s.istextarea && s.win.css("resize") && "none" != s.win.css("resize") && (s.view.h -= 20), s.cursorheight = Math.min(s.view.h, Math.round(s.view.h * (s.view.h / s.page.h))), s.cursorheight = s.opt.cursorfixedheight ? s.opt.cursorfixedheight : Math.max(s.opt.cursorminheight, s.cursorheight), s.cursorwidth = Math.min(s.view.w, Math.round(s.view.w * (s.view.w / s.page.w))), s.cursorwidth = s.opt.cursorfixedheight ? s.opt.cursorfixedheight : Math.max(s.opt.cursorminheight, s.cursorwidth), s.scrollvaluemax = s.view.h - s.cursorheight - s.cursor.hborder, s.railh && (s.railh.width = 0 < s.page.maxh ? s.view.w - s.rail.width : s.view.w, s.scrollvaluemaxw = s.railh.width - s.cursorwidth - s.cursorh.wborder), s.ispage || s.updateScrollBar(s.view), s.scrollratio = {x:s.page.maxw / s.scrollvaluemaxw, y:s.page.maxh / s.scrollvaluemax}, s.getScrollTop() > s.page.maxh ? s.doScrollTop(s.page.maxh) : (s.scroll.y = Math.round(s.getScrollTop() * (1 / s.scrollratio.y)), s.scroll.x = Math.round(s.getScrollLeft() * (1 / s.scrollratio.x)), s.cursoractive && s.noticeCursor()), s.scroll.y && 0 == s.getScrollTop() && s.doScrollTo(Math.floor(s.scroll.y * s.scrollratio.y)), s)
            }, this.resize = s.onResize, this.lazyResize = function (a) {
                return a = isNaN(a) ? 30 : a, s.delayed("resize", s.resize, a), s
            }, this._bind = function (a, b, c, d) {
                s.events.push({e:a, n:b, f:c, b:d, q:!1}), a.addEventListener ? a.addEventListener(b, c, d || !1) : a.attachEvent ? a.attachEvent("on" + b, c) : a["on" + b] = c
            }, this.jqbind = function (b, c, d) {
                s.events.push({e:b, n:c, f:d, q:!0}), a(b).bind(c, d)
            }, this.bind = function (a, b, c, d) {
                var e = "jquery"in a ? a[0] : a;
                "mousewheel" == b ? "onwheel"in s.win ? s._bind(e, "wheel", c, d || !1) : (a = "undefined" != typeof document.onmousewheel ? "mousewheel" : "DOMMouseScroll", p(e, a, c, d || !1), "DOMMouseScroll" == a && p(e, "MozMousePixelScroll", c, d || !1)) : e.addEventListener ? (u.cantouch && /mouseup|mousedown|mousemove/.test(b) && s._bind(e, "mousedown" == b ? "touchstart" : "mouseup" == b ? "touchend" : "touchmove", function (a) {
                    if (a.touches) {
                        if (2 > a.touches.length) {
                            var b = a.touches.length ? a.touches[0] : a;
                            b.original = a, c.call(this, b)
                        }
                    } else a.changedTouches && (b = a.changedTouches[0], b.original = a, c.call(this, b))
                }, d || !1), s._bind(e, b, c, d || !1), u.cantouch && "mouseup" == b && s._bind(e, "touchcancel", c, d || !1)) : s._bind(e, b, function (a) {
                    return(a = a || window.event || !1) && a.srcElement && (a.target = a.srcElement), "pageY"in a || (a.pageX = a.clientX + document.documentElement.scrollLeft, a.pageY = a.clientY + document.documentElement.scrollTop), !1 === c.call(e, a) || !1 === d ? s.cancelEvent(a) : !0
                })
            }, this._unbind = function (a, b, c, d) {
                a.removeEventListener ? a.removeEventListener(b, c, d) : a.detachEvent ? a.detachEvent("on" + b, c) : a["on" + b] = !1
            }, this.unbindAll = function () {
                for (var a = 0; a < s.events.length; a++) {
                    var b = s.events[a];
                    b.q ? b.e.unbind(b.n, b.f) : s._unbind(b.e, b.n, b.f, b.b)
                }
            }, this.cancelEvent = function (a) {
                return(a = a.original ? a.original : a ? a : window.event || !1) ? (a.preventDefault && a.preventDefault(), a.stopPropagation && a.stopPropagation(), a.preventManipulation && a.preventManipulation(), a.cancelBubble = !0, a.cancel = !0, a.returnValue = !1) : !1
            }, this.stopPropagation = function (a) {
                return(a = a.original ? a.original : a ? a : window.event || !1) ? a.stopPropagation ? a.stopPropagation() : (a.cancelBubble && (a.cancelBubble = !0), !1) : !1
            }, this.showRail = function () {
                return 0 == s.page.maxh || !s.ispage && "none" == s.win.css("display") || (s.visibility = !0, s.rail.visibility = !0, s.rail.css("display", "block")), s
            }, this.showRailHr = function () {
                return s.railh ? (0 == s.page.maxw || !s.ispage && "none" == s.win.css("display") || (s.railh.visibility = !0, s.railh.css("display", "block")), s) : s
            }, this.hideRail = function () {
                return s.visibility = !1, s.rail.visibility = !1, s.rail.css("display", "none"), s
            }, this.hideRailHr = function () {
                return s.railh ? (s.railh.visibility = !1, s.railh.css("display", "none"), s) : s
            }, this.show = function () {
                return s.hidden = !1, s.locked = !1, s.showRail().showRailHr()
            }, this.hide = function () {
                return s.hidden = !0, s.locked = !0, s.hideRail().hideRailHr()
            }, this.toggle = function () {
                return s.hidden ? s.show() : s.hide()
            }, this.remove = function () {
                s.stop(), s.cursortimeout && clearTimeout(s.cursortimeout), s.doZoomOut(), s.unbindAll(), u.isie9 && s.win[0].detachEvent("onpropertychange", s.onAttributeChange), !1 !== s.observer && s.observer.disconnect(), !1 !== s.observerremover && s.observerremover.disconnect(), s.events = null, s.cursor && s.cursor.remove(), s.cursorh && s.cursorh.remove(), s.rail && s.rail.remove(), s.railh && s.railh.remove(), s.zoom && s.zoom.remove();
                for (var b = 0; b < s.saved.css.length; b++) {
                    var c = s.saved.css[b];
                    c[0].css(c[1], "undefined" == typeof c[2] ? "" : c[2])
                }
                s.saved = !1, s.me.data("__nicescroll", "");
                var d = a.nicescroll;
                d.each(function (a) {
                    if (this && this.id === s.id) {
                        delete d[a];
                        for (var b = ++a; b < d.length; b++, a++)d[a] = d[b];
                        d.length--, d.length && delete d[d.length]
                    }
                });
                for (var e in s)s[e] = null, delete s[e];
                s = null
            }, this.scrollstart = function (a) {
                return this.onscrollstart = a, s
            }, this.scrollend = function (a) {
                return this.onscrollend = a, s
            }, this.scrollcancel = function (a) {
                return this.onscrollcancel = a, s
            }, this.zoomin = function (a) {
                return this.onzoomin = a, s
            }, this.zoomout = function (a) {
                return this.onzoomout = a, s
            }, this.isScrollable = function (b) {
                if (b = b.target ? b.target : b, "OPTION" == b.nodeName)return!0;
                for (; b && 1 == b.nodeType && !/^BODY|HTML/.test(b.nodeName);) {
                    var c = a(b), c = c.css("overflowY") || c.css("overflowX") || c.css("overflow") || "";
                    if (/scroll|auto/.test(c))return b.clientHeight != b.scrollHeight;
                    b = b.parentNode ? b.parentNode : !1
                }
                return!1
            }, this.getViewport = function (b) {
                for (b = b && b.parentNode ? b.parentNode : !1; b && 1 == b.nodeType && !/^BODY|HTML/.test(b.nodeName);) {
                    var c = a(b);
                    if (/fixed|absolute/.test(c.css("position")))return c;
                    var d = c.css("overflowY") || c.css("overflowX") || c.css("overflow") || "";
                    if (/scroll|auto/.test(d) && b.clientHeight != b.scrollHeight || 0 < c.getNiceScroll().length)return c;
                    b = b.parentNode ? b.parentNode : !1
                }
                return b ? a(b) : !1
            }, this.triggerScrollEnd = function () {
                if (s.onscrollend) {
                    var a = s.getScrollLeft(), b = s.getScrollTop();
                    s.onscrollend.call(s, {type:"scrollend", current:{x:a, y:b}, end:{x:a, y:b}})
                }
            }, this.onmousewheel = function (a) {
                if (!s.wheelprevented) {
                    if (s.locked)return s.debounced("checkunlock", s.resize, 250), !0;
                    if (s.rail.drag)return s.cancelEvent(a);
                    if ("auto" == s.opt.oneaxismousemode && 0 != a.deltaX && (s.opt.oneaxismousemode = !1), s.opt.oneaxismousemode && 0 == a.deltaX && !s.rail.scrollable)return s.railh && s.railh.scrollable ? s.onmousewheelhr(a) : !0;
                    var b = +new Date, c = !1;
                    return s.opt.preservenativescrolling && s.checkarea + 600 < b && (s.nativescrollingarea = s.isScrollable(a), c = !0), s.checkarea = b, s.nativescrollingarea ? !0 : ((a = r(a, !1, c)) && (s.checkarea = 0), a)
                }
            }, this.onmousewheelhr = function (a) {
                if (!s.wheelprevented) {
                    if (s.locked || !s.railh.scrollable)return!0;
                    if (s.rail.drag)return s.cancelEvent(a);
                    var b = +new Date, c = !1;
                    return s.opt.preservenativescrolling && s.checkarea + 600 < b && (s.nativescrollingarea = s.isScrollable(a), c = !0), s.checkarea = b, s.nativescrollingarea ? !0 : s.locked ? s.cancelEvent(a) : r(a, !0, c)
                }
            }, this.stop = function () {
                return s.cancelScroll(), s.scrollmon && s.scrollmon.stop(), s.cursorfreezed = !1, s.scroll.y = Math.round(s.getScrollTop() * (1 / s.scrollratio.y)), s.noticeCursor(), s
            }, this.getTransitionSpeed = function (a) {
                var b = Math.round(10 * s.opt.scrollspeed);
                return a = Math.min(b, Math.round(a / 20 * s.opt.scrollspeed)), a > 20 ? a : 0
            }, s.opt.smoothscroll ? s.ishwscroll && u.hastransition && s.opt.usetransition ? (this.prepareTransition = function (a, b) {
                var c = b ? a > 20 ? a : 0 : s.getTransitionSpeed(a), d = c ? u.prefixstyle + "transform " + c + "ms ease-out" : "";
                return s.lasttransitionstyle && s.lasttransitionstyle == d || (s.lasttransitionstyle = d, s.doc.css(u.transitionstyle, d)), c
            }, this.doScrollLeft = function (a, b) {
                var c = s.scrollrunning ? s.newscrolly : s.getScrollTop();
                s.doScrollPos(a, c, b)
            }, this.doScrollTop = function (a, b) {
                var c = s.scrollrunning ? s.newscrollx : s.getScrollLeft();
                s.doScrollPos(c, a, b)
            }, this.doScrollPos = function (a, b, c) {
                var d = s.getScrollTop(), e = s.getScrollLeft();
                return(0 > (s.newscrolly - d) * (b - d) || 0 > (s.newscrollx - e) * (a - e)) && s.cancelScroll(), 0 == s.opt.bouncescroll && (0 > b ? b = 0 : b > s.page.maxh && (b = s.page.maxh), 0 > a ? a = 0 : a > s.page.maxw && (a = s.page.maxw)), s.scrollrunning && a == s.newscrollx && b == s.newscrolly ? !1 : (s.newscrolly = b, s.newscrollx = a, s.newscrollspeed = c || !1, s.timer ? !1 : void(s.timer = setTimeout(function () {
                    var c, d, e = s.getScrollTop(), f = s.getScrollLeft();
                    c = a - f, d = b - e, c = Math.round(Math.sqrt(Math.pow(c, 2) + Math.pow(d, 2))), c = s.newscrollspeed && 1 < s.newscrollspeed ? s.newscrollspeed : s.getTransitionSpeed(c), s.newscrollspeed && 1 >= s.newscrollspeed && (c *= s.newscrollspeed), s.prepareTransition(c, !0), s.timerscroll && s.timerscroll.tm && clearInterval(s.timerscroll.tm), c > 0 && (!s.scrollrunning && s.onscrollstart && s.onscrollstart.call(s, {type:"scrollstart", current:{x:f, y:e}, request:{x:a, y:b}, end:{x:s.newscrollx, y:s.newscrolly}, speed:c}), u.transitionend ? s.scrollendtrapped || (s.scrollendtrapped = !0, s.bind(s.doc, u.transitionend, s.onScrollTransitionEnd, !1)) : (s.scrollendtrapped && clearTimeout(s.scrollendtrapped), s.scrollendtrapped = setTimeout(s.onScrollTransitionEnd, c)), s.timerscroll = {bz:new BezierClass(e, s.newscrolly, c, 0, 0, .58, 1), bh:new BezierClass(f, s.newscrollx, c, 0, 0, .58, 1)}, s.cursorfreezed || (s.timerscroll.tm = setInterval(function () {
                        s.showCursor(s.getScrollTop(), s.getScrollLeft())
                    }, 60))), s.synched("doScroll-set", function () {
                        s.timer = 0, s.scrollendtrapped && (s.scrollrunning = !0), s.setScrollTop(s.newscrolly), s.setScrollLeft(s.newscrollx), s.scrollendtrapped || s.onScrollTransitionEnd()
                    })
                }, 50)))
            }, this.cancelScroll = function () {
                if (!s.scrollendtrapped)return!0;
                var a = s.getScrollTop(), b = s.getScrollLeft();
                return s.scrollrunning = !1, u.transitionend || clearTimeout(u.transitionend), s.scrollendtrapped = !1, s._unbind(s.doc, u.transitionend, s.onScrollTransitionEnd), s.prepareTransition(0), s.setScrollTop(a), s.railh && s.setScrollLeft(b), s.timerscroll && s.timerscroll.tm && clearInterval(s.timerscroll.tm), s.timerscroll = !1, s.cursorfreezed = !1, s.showCursor(a, b), s
            }, this.onScrollTransitionEnd = function () {
                s.scrollendtrapped && s._unbind(s.doc, u.transitionend, s.onScrollTransitionEnd), s.scrollendtrapped = !1, s.prepareTransition(0), s.timerscroll && s.timerscroll.tm && clearInterval(s.timerscroll.tm), s.timerscroll = !1;
                var a = s.getScrollTop(), b = s.getScrollLeft();
                return s.setScrollTop(a), s.railh && s.setScrollLeft(b), s.noticeCursor(!1, a, b), s.cursorfreezed = !1, 0 > a ? a = 0 : a > s.page.maxh && (a = s.page.maxh), 0 > b ? b = 0 : b > s.page.maxw && (b = s.page.maxw), a != s.newscrolly || b != s.newscrollx ? s.doScrollPos(b, a, s.opt.snapbackspeed) : (s.onscrollend && s.scrollrunning && s.triggerScrollEnd(), void(s.scrollrunning = !1))
            }) : (this.doScrollLeft = function (a, b) {
                var c = s.scrollrunning ? s.newscrolly : s.getScrollTop();
                s.doScrollPos(a, c, b)
            }, this.doScrollTop = function (a, b) {
                var c = s.scrollrunning ? s.newscrollx : s.getScrollLeft();
                s.doScrollPos(c, a, b)
            }, this.doScrollPos = function (a, b, c) {
                function d() {
                    if (s.cancelAnimationFrame)return!0;
                    if (s.scrollrunning = !0, l = 1 - l)return s.timer = h(d) || 1;
                    var a = 0, b = sy = s.getScrollTop();
                    if (s.dst.ay) {
                        var b = s.bzscroll ? s.dst.py + s.bzscroll.getNow() * s.dst.ay : s.newscrolly, c = b - sy;
                        (0 > c && b < s.newscrolly || c > 0 && b > s.newscrolly) && (b = s.newscrolly), s.setScrollTop(b), b == s.newscrolly && (a = 1)
                    } else a = 1;
                    var e = sx = s.getScrollLeft();
                    s.dst.ax ? (e = s.bzscroll ? s.dst.px + s.bzscroll.getNow() * s.dst.ax : s.newscrollx, c = e - sx, (0 > c && e < s.newscrollx || c > 0 && e > s.newscrollx) && (e = s.newscrollx), s.setScrollLeft(e), e == s.newscrollx && (a += 1)) : a += 1, 2 == a ? (s.timer = 0, s.cursorfreezed = !1, s.bzscroll = !1, s.scrollrunning = !1, 0 > b ? b = 0 : b > s.page.maxh && (b = s.page.maxh), 0 > e ? e = 0 : e > s.page.maxw && (e = s.page.maxw), e != s.newscrollx || b != s.newscrolly ? s.doScrollPos(e, b) : s.onscrollend && s.triggerScrollEnd()) : s.timer = h(d) || 1
                }

                if (b = "undefined" == typeof b || !1 === b ? s.getScrollTop(!0) : b, s.timer && s.newscrolly == b && s.newscrollx == a)return!0;
                s.timer && i(s.timer), s.timer = 0;
                var e = s.getScrollTop(), f = s.getScrollLeft();
                (0 > (s.newscrolly - e) * (b - e) || 0 > (s.newscrollx - f) * (a - f)) && s.cancelScroll(), s.newscrolly = b, s.newscrollx = a, s.bouncescroll && s.rail.visibility || (0 > s.newscrolly ? s.newscrolly = 0 : s.newscrolly > s.page.maxh && (s.newscrolly = s.page.maxh)), s.bouncescroll && s.railh.visibility || (0 > s.newscrollx ? s.newscrollx = 0 : s.newscrollx > s.page.maxw && (s.newscrollx = s.page.maxw)), s.dst = {}, s.dst.x = a - f, s.dst.y = b - e, s.dst.px = f, s.dst.py = e;
                var g = Math.round(Math.sqrt(Math.pow(s.dst.x, 2) + Math.pow(s.dst.y, 2)));
                s.dst.ax = s.dst.x / g, s.dst.ay = s.dst.y / g;
                var j = 0, k = g;
                if (0 == s.dst.x ? (j = e, k = b, s.dst.ay = 1, s.dst.py = 0) : 0 == s.dst.y && (j = f, k = a, s.dst.ax = 1, s.dst.px = 0), g = s.getTransitionSpeed(g), c && 1 >= c && (g *= c), s.bzscroll = g > 0 ? s.bzscroll ? s.bzscroll.update(k, g) : new BezierClass(j, k, g, 0, 1, 0, 1) : !1, !s.timer) {
                    (e == s.page.maxh && b >= s.page.maxh || f == s.page.maxw && a >= s.page.maxw) && s.checkContentSize();
                    var l = 1;
                    s.cancelAnimationFrame = !1, s.timer = 1, s.onscrollstart && !s.scrollrunning && s.onscrollstart.call(s, {type:"scrollstart", current:{x:f, y:e}, request:{x:a, y:b}, end:{x:s.newscrollx, y:s.newscrolly}, speed:g}), d(), (e == s.page.maxh && b >= e || f == s.page.maxw && a >= f) && s.checkContentSize(), s.noticeCursor()
                }
            }, this.cancelScroll = function () {
                return s.timer && i(s.timer), s.timer = 0, s.bzscroll = !1, s.scrollrunning = !1, s
            }) : (this.doScrollLeft = function (a, b) {
                var c = s.getScrollTop();
                s.doScrollPos(a, c, b)
            }, this.doScrollTop = function (a, b) {
                var c = s.getScrollLeft();
                s.doScrollPos(c, a, b)
            }, this.doScrollPos = function (a, b) {
                var c = a > s.page.maxw ? s.page.maxw : a;
                0 > c && (c = 0);
                var d = b > s.page.maxh ? s.page.maxh : b;
                0 > d && (d = 0), s.synched("scroll", function () {
                    s.setScrollTop(d), s.setScrollLeft(c)
                })
            }, this.cancelScroll = function () {
            }), this.doScrollBy = function (a, b) {
                var c = 0, c = b ? Math.floor((s.scroll.y - a) * s.scrollratio.y) : (s.timer ? s.newscrolly : s.getScrollTop(!0)) - a;
                if (s.bouncescroll) {
                    var d = Math.round(s.view.h / 2);
                    -d > c ? c = -d : c > s.page.maxh + d && (c = s.page.maxh + d)
                }
                return s.cursorfreezed = !1, py = s.getScrollTop(!0), 0 > c && 0 >= py ? s.noticeCursor() : c > s.page.maxh && py >= s.page.maxh ? (s.checkContentSize(), s.noticeCursor()) : void s.doScrollTop(c)
            }, this.doScrollLeftBy = function (a, b) {
                var c = 0, c = b ? Math.floor((s.scroll.x - a) * s.scrollratio.x) : (s.timer ? s.newscrollx : s.getScrollLeft(!0)) - a;
                if (s.bouncescroll) {
                    var d = Math.round(s.view.w / 2);
                    -d > c ? c = -d : c > s.page.maxw + d && (c = s.page.maxw + d)
                }
                return s.cursorfreezed = !1, px = s.getScrollLeft(!0), 0 > c && 0 >= px || c > s.page.maxw && px >= s.page.maxw ? s.noticeCursor() : void s.doScrollLeft(c)
            }, this.doScrollTo = function (a, b) {
                b && Math.round(a * s.scrollratio.y), s.cursorfreezed = !1, s.doScrollTop(a)
            }, this.checkContentSize = function () {
                var a = s.getContentSize();
                (a.h != s.page.h || a.w != s.page.w) && s.resize(!1, a)
            }, s.onscroll = function () {
                s.rail.drag || s.cursorfreezed || s.synched("scroll", function () {
                    s.scroll.y = Math.round(s.getScrollTop() * (1 / s.scrollratio.y)), s.railh && (s.scroll.x = Math.round(s.getScrollLeft() * (1 / s.scrollratio.x))), s.noticeCursor()
                })
            }, s.bind(s.docscroll, "scroll", s.onscroll), this.doZoomIn = function (b) {
                if (!s.zoomactive) {
                    s.zoomactive = !0, s.zoomrestore = {style:{}};
                    var c, d = "position top left zIndex backgroundColor marginTop marginBottom marginLeft marginRight".split(" "), e = s.win[0].style;
                    for (c in d) {
                        var g = d[c];
                        s.zoomrestore.style[g] = "undefined" != typeof e[g] ? e[g] : ""
                    }
                    return s.zoomrestore.style.width = s.win.css("width"), s.zoomrestore.style.height = s.win.css("height"), s.zoomrestore.padding = {w:s.win.outerWidth() - s.win.width(), h:s.win.outerHeight() - s.win.height()}, u.isios4 && (s.zoomrestore.scrollTop = a(window).scrollTop(), a(window).scrollTop(0)), s.win.css({position:u.isios4 ? "absolute" : "fixed", top:0, left:0, "z-index":f + 100, margin:"0px"}), d = s.win.css("backgroundColor"), ("" == d || /transparent|rgba\(0, 0, 0, 0\)|rgba\(0,0,0,0\)/.test(d)) && s.win.css("backgroundColor", "#fff"), s.rail.css({"z-index":f + 101}), s.zoom.css({"z-index":f + 102}), s.zoom.css("backgroundPosition", "0px -18px"), s.resizeZoom(), s.onzoomin && s.onzoomin.call(s), s.cancelEvent(b)
                }
            }, this.doZoomOut = function (b) {
                return s.zoomactive ? (s.zoomactive = !1, s.win.css("margin", ""), s.win.css(s.zoomrestore.style), u.isios4 && a(window).scrollTop(s.zoomrestore.scrollTop), s.rail.css({"z-index":s.zindex}), s.zoom.css({"z-index":s.zindex}), s.zoomrestore = !1, s.zoom.css("backgroundPosition", "0px 0px"), s.onResize(), s.onzoomout && s.onzoomout.call(s), s.cancelEvent(b)) : void 0
            }, this.doZoom = function (a) {
                return s.zoomactive ? s.doZoomOut(a) : s.doZoomIn(a)
            }, this.resizeZoom = function () {
                if (s.zoomactive) {
                    var b = s.getScrollTop();
                    s.win.css({width:a(window).width() - s.zoomrestore.padding.w + "px", height:a(window).height() - s.zoomrestore.padding.h + "px"}), s.onResize(), s.setScrollTop(Math.min(s.page.maxh, b))
                }
            }, this.init(), a.nicescroll.push(this)
        }, q = function (a) {
            var b = this;
            this.nc = a, this.steptime = this.lasttime = this.speedy = this.speedx = this.lasty = this.lastx = 0, this.snapy = this.snapx = !1, this.demuly = this.demulx = 0, this.lastscrolly = this.lastscrollx = -1, this.timer = this.chky = this.chkx = 0, this.time = function () {
                return+new Date
            }, this.reset = function (a, c) {
                b.stop();
                var d = b.time();
                b.steptime = 0, b.lasttime = d, b.speedx = 0, b.speedy = 0, b.lastx = a, b.lasty = c, b.lastscrollx = -1, b.lastscrolly = -1
            }, this.update = function (a, c) {
                var d = b.time();
                b.steptime = d - b.lasttime, b.lasttime = d;
                var d = c - b.lasty, e = a - b.lastx, f = b.nc.getScrollTop(), g = b.nc.getScrollLeft(), f = f + d, g = g + e;
                b.snapx = 0 > g || g > b.nc.page.maxw, b.snapy = 0 > f || f > b.nc.page.maxh, b.speedx = e, b.speedy = d, b.lastx = a, b.lasty = c
            }, this.stop = function () {
                b.nc.unsynched("domomentum2d"), b.timer && clearTimeout(b.timer), b.timer = 0, b.lastscrollx = -1, b.lastscrolly = -1
            }, this.doSnapy = function (a, c) {
                var d = !1;
                0 > c ? (c = 0, d = !0) : c > b.nc.page.maxh && (c = b.nc.page.maxh, d = !0), 0 > a ? (a = 0, d = !0) : a > b.nc.page.maxw && (a = b.nc.page.maxw, d = !0), d ? b.nc.doScrollPos(a, c, b.nc.opt.snapbackspeed) : b.nc.triggerScrollEnd()
            }, this.doMomentum = function (a) {
                var c = b.time(), d = a ? c + a : b.lasttime;
                a = b.nc.getScrollLeft();
                var e = b.nc.getScrollTop(), f = b.nc.page.maxh, g = b.nc.page.maxw;
                if (b.speedx = g > 0 ? Math.min(60, b.speedx) : 0, b.speedy = f > 0 ? Math.min(60, b.speedy) : 0, d = d && 60 >= c - d, (0 > e || e > f || 0 > a || a > g) && (d = !1), a = b.speedx && d ? b.speedx : !1, b.speedy && d && b.speedy || a) {
                    var h = Math.max(16, b.steptime);
                    h > 50 && (a = h / 50, b.speedx *= a, b.speedy *= a, h = 50), b.demulxy = 0, b.lastscrollx = b.nc.getScrollLeft(), b.chkx = b.lastscrollx, b.lastscrolly = b.nc.getScrollTop(), b.chky = b.lastscrolly;
                    var i = b.lastscrollx, j = b.lastscrolly, k = function () {
                        var a = 600 < b.time() - c ? .04 : .02;
                        b.speedx && (i = Math.floor(b.lastscrollx - b.speedx * (1 - b.demulxy)), b.lastscrollx = i, 0 > i || i > g) && (a = .1), b.speedy && (j = Math.floor(b.lastscrolly - b.speedy * (1 - b.demulxy)), b.lastscrolly = j, 0 > j || j > f) && (a = .1), b.demulxy = Math.min(1, b.demulxy + a), b.nc.synched("domomentum2d", function () {
                            b.speedx && (b.nc.getScrollLeft() != b.chkx && b.stop(), b.chkx = i, b.nc.setScrollLeft(i)), b.speedy && (b.nc.getScrollTop() != b.chky && b.stop(), b.chky = j, b.nc.setScrollTop(j)), b.timer || (b.nc.hideCursor(), b.doSnapy(i, j))
                        }), 1 > b.demulxy ? b.timer = setTimeout(k, h) : (b.stop(), b.nc.hideCursor(), b.doSnapy(i, j))
                    };
                    k()
                } else b.doSnapy(b.nc.getScrollLeft(), b.nc.getScrollTop())
            }
        }, r = a.fn.scrollTop;
        a.cssHooks.pageYOffset = {get:function (b, c) {
            return(c = a.data(b, "__nicescroll") || !1) && c.ishwscroll ? c.getScrollTop() : r.call(b)
        }, set:function (b, c) {
            var d = a.data(b, "__nicescroll") || !1;
            return d && d.ishwscroll ? d.setScrollTop(parseInt(c)) : r.call(b, c), this
        }}, a.fn.scrollTop = function (b) {
            if ("undefined" == typeof b) {
                var c = this[0] ? a.data(this[0], "__nicescroll") || !1 : !1;
                return c && c.ishwscroll ? c.getScrollTop() : r.call(this)
            }
            return this.each(function () {
                var c = a.data(this, "__nicescroll") || !1;
                c && c.ishwscroll ? c.setScrollTop(parseInt(b)) : r.call(a(this), b)
            })
        };
        var s = a.fn.scrollLeft;
        a.cssHooks.pageXOffset = {get:function (b, c) {
            return(c = a.data(b, "__nicescroll") || !1) && c.ishwscroll ? c.getScrollLeft() : s.call(b)
        }, set:function (b, c) {
            var d = a.data(b, "__nicescroll") || !1;
            return d && d.ishwscroll ? d.setScrollLeft(parseInt(c)) : s.call(b, c), this
        }}, a.fn.scrollLeft = function (b) {
            if ("undefined" == typeof b) {
                var c = this[0] ? a.data(this[0], "__nicescroll") || !1 : !1;
                return c && c.ishwscroll ? c.getScrollLeft() : s.call(this)
            }
            return this.each(function () {
                var c = a.data(this, "__nicescroll") || !1;
                c && c.ishwscroll ? c.setScrollLeft(parseInt(b)) : s.call(a(this), b)
            })
        };
        var t = function (b) {
            var c = this;
            if (this.length = 0, this.name = "nicescrollarray", this.each = function (a) {
                for (var b = 0, d = 0; b < c.length; b++)a.call(c[b], d++);
                return c
            }, this.push = function (a) {
                c[c.length] = a, c.length++
            }, this.eq = function (a) {
                return c[a]
            }, b)for (var d = 0; d < b.length; d++) {
                var e = a.data(b[d], "__nicescroll") || !1;
                e && (this[this.length] = e, this.length++)
            }
            return this
        };
        !function (a, b, c) {
            for (var d = 0; d < b.length; d++)c(a, b[d])
        }(t.prototype, "show hide toggle onResize resize remove stop doScrollPos".split(" "), function (a, b) {
            a[b] = function () {
                var a = arguments;
                return this.each(function () {
                    this[b].apply(this, a)
                })
            }
        }), a.fn.getNiceScroll = function (b) {
            return"undefined" == typeof b ? new t(this) : this[b] && a.data(this[b], "__nicescroll") || !1
        }, a.extend(a.expr[":"], {nicescroll:function (b) {
            return a.data(b, "__nicescroll") ? !0 : !1
        }}), a.fn.niceScroll = function (b, c) {
            "undefined" == typeof c && "object" == typeof b && !("jquery"in b) && (c = b, b = !1);
            var d = new t;
            "undefined" == typeof c && (c = {}), b && (c.doc = a(b), c.win = a(this));
            var e = !("doc"in c);
            return!e && !("win"in c) && (c.win = a(this)), this.each(function () {
                var b = a(this).data("__nicescroll") || !1;
                b || (c.doc = e ? a(this) : c.doc, b = new p(c, a(this)), a(this).data("__nicescroll", b)), d.push(b)
            }), 1 == d.length ? d[0] : d
        }, window.NiceScroll = {getjQuery:function () {
            return a
        }}, a.nicescroll || (a.nicescroll = new t, a.nicescroll.options = m)
    })
}, {}], 2:[function () {
    !function (a, b) {
        function c(a) {
            var b = a.length, c = ib.type(a);
            return ib.isWindow(a) ? !1 : 1 === a.nodeType && b ? !0 : "array" === c || "function" !== c && (0 === b || "number" == typeof b && b > 0 && b - 1 in a)
        }

        function d(a) {
            var b = xb[a] = {};
            return ib.each(a.match(kb) || [], function (a, c) {
                b[c] = !0
            }), b
        }

        function e(a, c, d, e) {
            if (ib.acceptData(a)) {
                var f, g, h = ib.expando, i = "string" == typeof c, j = a.nodeType, k = j ? ib.cache : a, l = j ? a[h] : a[h] && h;
                if (l && k[l] && (e || k[l].data) || !i || d !== b)return l || (j ? a[h] = l = _.pop() || ib.guid++ : l = h), k[l] || (k[l] = {}, j || (k[l].toJSON = ib.noop)), ("object" == typeof c || "function" == typeof c) && (e ? k[l] = ib.extend(k[l], c) : k[l].data = ib.extend(k[l].data, c)), f = k[l], e || (f.data || (f.data = {}), f = f.data), d !== b && (f[ib.camelCase(c)] = d), i ? (g = f[c], null == g && (g = f[ib.camelCase(c)])) : g = f, g
            }
        }

        function f(a, b, c) {
            if (ib.acceptData(a)) {
                var d, e, f, g = a.nodeType, i = g ? ib.cache : a, j = g ? a[ib.expando] : ib.expando;
                if (i[j]) {
                    if (b && (f = c ? i[j] : i[j].data)) {
                        ib.isArray(b) ? b = b.concat(ib.map(b, ib.camelCase)) : b in f ? b = [b] : (b = ib.camelCase(b), b = b in f ? [b] : b.split(" "));
                        for (d = 0, e = b.length; e > d; d++)delete f[b[d]];
                        if (!(c ? h : ib.isEmptyObject)(f))return
                    }
                    (c || (delete i[j].data, h(i[j]))) && (g ? ib.cleanData([a], !0) : ib.support.deleteExpando || i != i.window ? delete i[j] : i[j] = null)
                }
            }
        }

        function g(a, c, d) {
            if (d === b && 1 === a.nodeType) {
                var e = "data-" + c.replace(zb, "-$1").toLowerCase();
                if (d = a.getAttribute(e), "string" == typeof d) {
                    try {
                        d = "true" === d ? !0 : "false" === d ? !1 : "null" === d ? null : +d + "" === d ? +d : yb.test(d) ? ib.parseJSON(d) : d
                    } catch (f) {
                    }
                    ib.data(a, c, d)
                } else d = b
            }
            return d
        }

        function h(a) {
            var b;
            for (b in a)if (("data" !== b || !ib.isEmptyObject(a[b])) && "toJSON" !== b)return!1;
            return!0
        }

        function i() {
            return!0
        }

        function j() {
            return!1
        }

        function k(a, b) {
            do a = a[b]; while (a && 1 !== a.nodeType);
            return a
        }

        function l(a, b, c) {
            if (b = b || 0, ib.isFunction(b))return ib.grep(a, function (a, d) {
                var e = !!b.call(a, d, a);
                return e === c
            });
            if (b.nodeType)return ib.grep(a, function (a) {
                return a === b === c
            });
            if ("string" == typeof b) {
                var d = ib.grep(a, function (a) {
                    return 1 === a.nodeType
                });
                if (Rb.test(b))return ib.filter(b, d, !c);
                b = ib.filter(b, d)
            }
            return ib.grep(a, function (a) {
                return ib.inArray(a, b) >= 0 === c
            })
        }

        function m(a) {
            var b = Ub.split("|"), c = a.createDocumentFragment();
            if (c.createElement)for (; b.length;)c.createElement(b.pop());
            return c
        }

        function n(a, b) {
            return a.getElementsByTagName(b)[0] || a.appendChild(a.ownerDocument.createElement(b))
        }

        function o(a) {
            var b = a.getAttributeNode("type");
            return a.type = (b && b.specified) + "/" + a.type, a
        }

        function p(a) {
            var b = ec.exec(a.type);
            return b ? a.type = b[1] : a.removeAttribute("type"), a
        }

        function q(a, b) {
            for (var c, d = 0; null != (c = a[d]); d++)ib._data(c, "globalEval", !b || ib._data(b[d], "globalEval"))
        }

        function r(a, b) {
            if (1 === b.nodeType && ib.hasData(a)) {
                var c, d, e, f = ib._data(a), g = ib._data(b, f), h = f.events;
                if (h) {
                    delete g.handle, g.events = {};
                    for (c in h)for (d = 0, e = h[c].length; e > d; d++)ib.event.add(b, c, h[c][d])
                }
                g.data && (g.data = ib.extend({}, g.data))
            }
        }

        function s(a, b) {
            var c, d, e;
            if (1 === b.nodeType) {
                if (c = b.nodeName.toLowerCase(), !ib.support.noCloneEvent && b[ib.expando]) {
                    e = ib._data(b);
                    for (d in e.events)ib.removeEvent(b, d, e.handle);
                    b.removeAttribute(ib.expando)
                }
                "script" === c && b.text !== a.text ? (o(b).text = a.text, p(b)) : "object" === c ? (b.parentNode && (b.outerHTML = a.outerHTML), ib.support.html5Clone && a.innerHTML && !ib.trim(b.innerHTML) && (b.innerHTML = a.innerHTML)) : "input" === c && bc.test(a.type) ? (b.defaultChecked = b.checked = a.checked, b.value !== a.value && (b.value = a.value)) : "option" === c ? b.defaultSelected = b.selected = a.defaultSelected : ("input" === c || "textarea" === c) && (b.defaultValue = a.defaultValue)
            }
        }

        function t(a, c) {
            var d, e, f = 0, g = typeof a.getElementsByTagName !== V ? a.getElementsByTagName(c || "*") : typeof a.querySelectorAll !== V ? a.querySelectorAll(c || "*") : b;
            if (!g)for (g = [], d = a.childNodes || a; null != (e = d[f]); f++)!c || ib.nodeName(e, c) ? g.push(e) : ib.merge(g, t(e, c));
            return c === b || c && ib.nodeName(a, c) ? ib.merge([a], g) : g
        }

        function u(a) {
            bc.test(a.type) && (a.defaultChecked = a.checked)
        }

        function v(a, b) {
            if (b in a)return b;
            for (var c = b.charAt(0).toUpperCase() + b.slice(1), d = b, e = yc.length; e--;)if (b = yc[e] + c, b in a)return b;
            return d
        }

        function w(a, b) {
            return a = b || a, "none" === ib.css(a, "display") || !ib.contains(a.ownerDocument, a)
        }

        function x(a, b) {
            for (var c, d, e, f = [], g = 0, h = a.length; h > g; g++)d = a[g], d.style && (f[g] = ib._data(d, "olddisplay"), c = d.style.display, b ? (f[g] || "none" !== c || (d.style.display = ""), "" === d.style.display && w(d) && (f[g] = ib._data(d, "olddisplay", B(d.nodeName)))) : f[g] || (e = w(d), (c && "none" !== c || !e) && ib._data(d, "olddisplay", e ? c : ib.css(d, "display"))));
            for (g = 0; h > g; g++)d = a[g], d.style && (b && "none" !== d.style.display && "" !== d.style.display || (d.style.display = b ? f[g] || "" : "none"));
            return a
        }

        function y(a, b, c) {
            var d = rc.exec(b);
            return d ? Math.max(0, d[1] - (c || 0)) + (d[2] || "px") : b
        }

        function z(a, b, c, d, e) {
            for (var f = c === (d ? "border" : "content") ? 4 : "width" === b ? 1 : 0, g = 0; 4 > f; f += 2)"margin" === c && (g += ib.css(a, c + xc[f], !0, e)), d ? ("content" === c && (g -= ib.css(a, "padding" + xc[f], !0, e)), "margin" !== c && (g -= ib.css(a, "border" + xc[f] + "Width", !0, e))) : (g += ib.css(a, "padding" + xc[f], !0, e), "padding" !== c && (g += ib.css(a, "border" + xc[f] + "Width", !0, e)));
            return g
        }

        function A(a, b, c) {
            var d = !0, e = "width" === b ? a.offsetWidth : a.offsetHeight, f = kc(a), g = ib.support.boxSizing && "border-box" === ib.css(a, "boxSizing", !1, f);
            if (0 >= e || null == e) {
                if (e = lc(a, b, f), (0 > e || null == e) && (e = a.style[b]), sc.test(e))return e;
                d = g && (ib.support.boxSizingReliable || e === a.style[b]), e = parseFloat(e) || 0
            }
            return e + z(a, b, c || (g ? "border" : "content"), d, f) + "px"
        }

        function B(a) {
            var b = W, c = uc[a];
            return c || (c = C(a, b), "none" !== c && c || (jc = (jc || ib("<iframe frameborder='0' width='0' height='0'/>").css("cssText", "display:block !important")).appendTo(b.documentElement), b = (jc[0].contentWindow || jc[0].contentDocument).document, b.write("<!doctype html><html><body>"), b.close(), c = C(a, b), jc.detach()), uc[a] = c), c
        }

        function C(a, b) {
            var c = ib(b.createElement(a)).appendTo(b.body), d = ib.css(c[0], "display");
            return c.remove(), d
        }

        function D(a, b, c, d) {
            var e;
            if (ib.isArray(b))ib.each(b, function (b, e) {
                c || Ac.test(a) ? d(a, e) : D(a + "[" + ("object" == typeof e ? b : "") + "]", e, c, d)
            }); else if (c || "object" !== ib.type(b))d(a, b); else for (e in b)D(a + "[" + e + "]", b[e], c, d)
        }

        function E(a) {
            return function (b, c) {
                "string" != typeof b && (c = b, b = "*");
                var d, e = 0, f = b.toLowerCase().match(kb) || [];
                if (ib.isFunction(c))for (; d = f[e++];)"+" === d[0] ? (d = d.slice(1) || "*", (a[d] = a[d] || []).unshift(c)) : (a[d] = a[d] || []).push(c)
            }
        }

        function F(a, b, c, d) {
            function e(h) {
                var i;
                return f[h] = !0, ib.each(a[h] || [], function (a, h) {
                    var j = h(b, c, d);
                    return"string" != typeof j || g || f[j] ? g ? !(i = j) : void 0 : (b.dataTypes.unshift(j), e(j), !1)
                }), i
            }

            var f = {}, g = a === Rc;
            return e(b.dataTypes[0]) || !f["*"] && e("*")
        }

        function G(a, c) {
            var d, e, f = ib.ajaxSettings.flatOptions || {};
            for (e in c)c[e] !== b && ((f[e] ? a : d || (d = {}))[e] = c[e]);
            return d && ib.extend(!0, a, d), a
        }

        function H(a, c, d) {
            var e, f, g, h, i = a.contents, j = a.dataTypes, k = a.responseFields;
            for (h in k)h in d && (c[k[h]] = d[h]);
            for (; "*" === j[0];)j.shift(), f === b && (f = a.mimeType || c.getResponseHeader("Content-Type"));
            if (f)for (h in i)if (i[h] && i[h].test(f)) {
                j.unshift(h);
                break
            }
            if (j[0]in d)g = j[0]; else {
                for (h in d) {
                    if (!j[0] || a.converters[h + " " + j[0]]) {
                        g = h;
                        break
                    }
                    e || (e = h)
                }
                g = g || e
            }
            return g ? (g !== j[0] && j.unshift(g), d[g]) : void 0
        }

        function I(a, b) {
            var c, d, e, f, g = {}, h = 0, i = a.dataTypes.slice(), j = i[0];
            if (a.dataFilter && (b = a.dataFilter(b, a.dataType)), i[1])for (e in a.converters)g[e.toLowerCase()] = a.converters[e];
            for (; d = i[++h];)if ("*" !== d) {
                if ("*" !== j && j !== d) {
                    if (e = g[j + " " + d] || g["* " + d], !e)for (c in g)if (f = c.split(" "), f[1] === d && (e = g[j + " " + f[0]] || g["* " + f[0]])) {
                        e === !0 ? e = g[c] : g[c] !== !0 && (d = f[0], i.splice(h--, 0, d));
                        break
                    }
                    if (e !== !0)if (e && a["throws"])b = e(b); else try {
                        b = e(b)
                    } catch (k) {
                        return{state:"parsererror", error:e ? k : "No conversion from " + j + " to " + d}
                    }
                }
                j = d
            }
            return{state:"success", data:b}
        }

        function J() {
            try {
                return new a.XMLHttpRequest
            } catch (b) {
            }
        }

        function K() {
            try {
                return new a.ActiveXObject("Microsoft.XMLHTTP")
            } catch (b) {
            }
        }

        function L() {
            return setTimeout(function () {
                $c = b
            }), $c = ib.now()
        }

        function M(a, b) {
            ib.each(b, function (b, c) {
                for (var d = (ed[b] || []).concat(ed["*"]), e = 0, f = d.length; f > e; e++)if (d[e].call(a, b, c))return
            })
        }

        function N(a, b, c) {
            var d, e, f = 0, g = dd.length, h = ib.Deferred().always(function () {
                delete i.elem
            }), i = function () {
                if (e)return!1;
                for (var b = $c || L(), c = Math.max(0, j.startTime + j.duration - b), d = c / j.duration || 0, f = 1 - d, g = 0, i = j.tweens.length; i > g; g++)j.tweens[g].run(f);
                return h.notifyWith(a, [j, f, c]), 1 > f && i ? c : (h.resolveWith(a, [j]), !1)
            }, j = h.promise({elem:a, props:ib.extend({}, b), opts:ib.extend(!0, {specialEasing:{}}, c), originalProperties:b, originalOptions:c, startTime:$c || L(), duration:c.duration, tweens:[], createTween:function (b, c) {
                var d = ib.Tween(a, j.opts, b, c, j.opts.specialEasing[b] || j.opts.easing);
                return j.tweens.push(d), d
            }, stop:function (b) {
                var c = 0, d = b ? j.tweens.length : 0;
                if (e)return this;
                for (e = !0; d > c; c++)j.tweens[c].run(1);
                return b ? h.resolveWith(a, [j, b]) : h.rejectWith(a, [j, b]), this
            }}), k = j.props;
            for (O(k, j.opts.specialEasing); g > f; f++)if (d = dd[f].call(j, a, k, j.opts))return d;
            return M(j, k), ib.isFunction(j.opts.start) && j.opts.start.call(a, j), ib.fx.timer(ib.extend(i, {elem:a, anim:j, queue:j.opts.queue})), j.progress(j.opts.progress).done(j.opts.done, j.opts.complete).fail(j.opts.fail).always(j.opts.always)
        }

        function O(a, b) {
            var c, d, e, f, g;
            for (e in a)if (d = ib.camelCase(e), f = b[d], c = a[e], ib.isArray(c) && (f = c[1], c = a[e] = c[0]), e !== d && (a[d] = c, delete a[e]), g = ib.cssHooks[d], g && "expand"in g) {
                c = g.expand(c), delete a[d];
                for (e in c)e in a || (a[e] = c[e], b[e] = f)
            } else b[d] = f
        }

        function P(a, b, c) {
            var d, e, f, g, h, i, j, k, l, m = this, n = a.style, o = {}, p = [], q = a.nodeType && w(a);
            c.queue || (k = ib._queueHooks(a, "fx"), null == k.unqueued && (k.unqueued = 0, l = k.empty.fire, k.empty.fire = function () {
                k.unqueued || l()
            }), k.unqueued++, m.always(function () {
                m.always(function () {
                    k.unqueued--, ib.queue(a, "fx").length || k.empty.fire()
                })
            })), 1 === a.nodeType && ("height"in b || "width"in b) && (c.overflow = [n.overflow, n.overflowX, n.overflowY], "inline" === ib.css(a, "display") && "none" === ib.css(a, "float") && (ib.support.inlineBlockNeedsLayout && "inline" !== B(a.nodeName) ? n.zoom = 1 : n.display = "inline-block")), c.overflow && (n.overflow = "hidden", ib.support.shrinkWrapBlocks || m.always(function () {
                n.overflow = c.overflow[0], n.overflowX = c.overflow[1], n.overflowY = c.overflow[2]
            }));
            for (e in b)if (g = b[e], ad.exec(g)) {
                if (delete b[e], i = i || "toggle" === g, g === (q ? "hide" : "show"))continue;
                p.push(e)
            }
            if (f = p.length) {
                h = ib._data(a, "fxshow") || ib._data(a, "fxshow", {}), "hidden"in h && (q = h.hidden), i && (h.hidden = !q), q ? ib(a).show() : m.done(function () {
                    ib(a).hide()
                }), m.done(function () {
                    var b;
                    ib._removeData(a, "fxshow");
                    for (b in o)ib.style(a, b, o[b])
                });
                for (e = 0; f > e; e++)d = p[e], j = m.createTween(d, q ? h[d] : 0), o[d] = h[d] || ib.style(a, d), d in h || (h[d] = j.start, q && (j.end = j.start, j.start = "width" === d || "height" === d ? 1 : 0))
            }
        }

        function Q(a, b, c, d, e) {
            return new Q.prototype.init(a, b, c, d, e)
        }

        function R(a, b) {
            var c, d = {height:a}, e = 0;
            for (b = b ? 1 : 0; 4 > e; e += 2 - b)c = xc[e], d["margin" + c] = d["padding" + c] = a;
            return b && (d.opacity = d.width = a), d
        }

        function S(a) {
            return ib.isWindow(a) ? a : 9 === a.nodeType ? a.defaultView || a.parentWindow : !1
        }

        var T, U, V = typeof b, W = a.document, X = a.location, Y = a.jQuery, Z = a.$, $ = {}, _ = [], ab = "1.9.1", bb = _.concat, cb = _.push, db = _.slice, eb = _.indexOf, fb = $.toString, gb = $.hasOwnProperty, hb = ab.trim, ib = function (a, b) {
            return new ib.fn.init(a, b, U)
        }, jb = /[+-]?(?:\d*\.|)\d+(?:[eE][+-]?\d+|)/.source, kb = /\S+/g, lb = /^[\s\uFEFF\xA0]+|[\s\uFEFF\xA0]+$/g, mb = /^(?:(<[\w\W]+>)[^>]*|#([\w-]*))$/, nb = /^<(\w+)\s*\/?>(?:<\/\1>|)$/, ob = /^[\],:{}\s]*$/, pb = /(?:^|:|,)(?:\s*\[)+/g, qb = /\\(?:["\\\/bfnrt]|u[\da-fA-F]{4})/g, rb = /"[^"\\\r\n]*"|true|false|null|-?(?:\d+\.|)\d+(?:[eE][+-]?\d+|)/g, sb = /^-ms-/, tb = /-([\da-z])/gi, ub = function (a, b) {
            return b.toUpperCase()
        }, vb = function (a) {
            (W.addEventListener || "load" === a.type || "complete" === W.readyState) && (wb(), ib.ready())
        }, wb = function () {
            W.addEventListener ? (W.removeEventListener("DOMContentLoaded", vb, !1), a.removeEventListener("load", vb, !1)) : (W.detachEvent("onreadystatechange", vb), a.detachEvent("onload", vb))
        };
        ib.fn = ib.prototype = {jquery:ab, constructor:ib, init:function (a, c, d) {
            var e, f;
            if (!a)return this;
            if ("string" == typeof a) {
                if (e = "<" === a.charAt(0) && ">" === a.charAt(a.length - 1) && a.length >= 3 ? [null, a, null] : mb.exec(a), !e || !e[1] && c)return!c || c.jquery ? (c || d).find(a) : this.constructor(c).find(a);
                if (e[1]) {
                    if (c = c instanceof ib ? c[0] : c, ib.merge(this, ib.parseHTML(e[1], c && c.nodeType ? c.ownerDocument || c : W, !0)), nb.test(e[1]) && ib.isPlainObject(c))for (e in c)ib.isFunction(this[e]) ? this[e](c[e]) : this.attr(e, c[e]);
                    return this
                }
                if (f = W.getElementById(e[2]), f && f.parentNode) {
                    if (f.id !== e[2])return d.find(a);
                    this.length = 1, this[0] = f
                }
                return this.context = W, this.selector = a, this
            }
            return a.nodeType ? (this.context = this[0] = a, this.length = 1, this) : ib.isFunction(a) ? d.ready(a) : (a.selector !== b && (this.selector = a.selector, this.context = a.context), ib.makeArray(a, this))
        }, selector:"", length:0, size:function () {
            return this.length
        }, toArray:function () {
            return db.call(this)
        }, get:function (a) {
            return null == a ? this.toArray() : 0 > a ? this[this.length + a] : this[a]
        }, pushStack:function (a) {
            var b = ib.merge(this.constructor(), a);
            return b.prevObject = this, b.context = this.context, b
        }, each:function (a, b) {
            return ib.each(this, a, b)
        }, ready:function (a) {
            return ib.ready.promise().done(a), this
        }, slice:function () {
            return this.pushStack(db.apply(this, arguments))
        }, first:function () {
            return this.eq(0)
        }, last:function () {
            return this.eq(-1)
        }, eq:function (a) {
            var b = this.length, c = +a + (0 > a ? b : 0);
            return this.pushStack(c >= 0 && b > c ? [this[c]] : [])
        }, map:function (a) {
            return this.pushStack(ib.map(this, function (b, c) {
                return a.call(b, c, b)
            }))
        }, end:function () {
            return this.prevObject || this.constructor(null)
        }, push:cb, sort:[].sort, splice:[].splice}, ib.fn.init.prototype = ib.fn, ib.extend = ib.fn.extend = function () {
            var a, c, d, e, f, g, h = arguments[0] || {}, i = 1, j = arguments.length, k = !1;
            for ("boolean" == typeof h && (k = h, h = arguments[1] || {}, i = 2), "object" == typeof h || ib.isFunction(h) || (h = {}), j === i && (h = this, --i); j > i; i++)if (null != (f = arguments[i]))for (e in f)a = h[e], d = f[e], h !== d && (k && d && (ib.isPlainObject(d) || (c = ib.isArray(d))) ? (c ? (c = !1, g = a && ib.isArray(a) ? a : []) : g = a && ib.isPlainObject(a) ? a : {}, h[e] = ib.extend(k, g, d)) : d !== b && (h[e] = d));
            return h
        }, ib.extend({noConflict:function (b) {
            return a.$ === ib && (a.$ = Z), b && a.jQuery === ib && (a.jQuery = Y), ib
        }, isReady:!1, readyWait:1, holdReady:function (a) {
            a ? ib.readyWait++ : ib.ready(!0)
        }, ready:function (a) {
            if (a === !0 ? !--ib.readyWait : !ib.isReady) {
                if (!W.body)return setTimeout(ib.ready);
                ib.isReady = !0, a !== !0 && --ib.readyWait > 0 || (T.resolveWith(W, [ib]), ib.fn.trigger && ib(W).trigger("ready").off("ready"))
            }
        }, isFunction:function (a) {
            return"function" === ib.type(a)
        }, isArray:Array.isArray || function (a) {
            return"array" === ib.type(a)
        }, isWindow:function (a) {
            return null != a && a == a.window
        }, isNumeric:function (a) {
            return!isNaN(parseFloat(a)) && isFinite(a)
        }, type:function (a) {
            return null == a ? String(a) : "object" == typeof a || "function" == typeof a ? $[fb.call(a)] || "object" : typeof a
        }, isPlainObject:function (a) {
            if (!a || "object" !== ib.type(a) || a.nodeType || ib.isWindow(a))return!1;
            try {
                if (a.constructor && !gb.call(a, "constructor") && !gb.call(a.constructor.prototype, "isPrototypeOf"))return!1
            } catch (c) {
                return!1
            }
            var d;
            for (d in a);
            return d === b || gb.call(a, d)
        }, isEmptyObject:function (a) {
            var b;
            for (b in a)return!1;
            return!0
        }, error:function (a) {
            throw new Error(a)
        }, parseHTML:function (a, b, c) {
            if (!a || "string" != typeof a)return null;
            "boolean" == typeof b && (c = b, b = !1), b = b || W;
            var d = nb.exec(a), e = !c && [];
            return d ? [b.createElement(d[1])] : (d = ib.buildFragment([a], b, e), e && ib(e).remove(), ib.merge([], d.childNodes))
        }, parseJSON:function (b) {
            return a.JSON && a.JSON.parse ? a.JSON.parse(b) : null === b ? b : "string" == typeof b && (b = ib.trim(b), b && ob.test(b.replace(qb, "@").replace(rb, "]").replace(pb, ""))) ? new Function("return " + b)() : void ib.error("Invalid JSON: " + b)
        }, parseXML:function (c) {
            var d, e;
            if (!c || "string" != typeof c)return null;
            try {
                a.DOMParser ? (e = new DOMParser, d = e.parseFromString(c, "text/xml")) : (d = new ActiveXObject("Microsoft.XMLDOM"), d.async = "false", d.loadXML(c))
            } catch (f) {
                d = b
            }
            return d && d.documentElement && !d.getElementsByTagName("parsererror").length || ib.error("Invalid XML: " + c), d
        }, noop:function () {
        }, globalEval:function (b) {
            b && ib.trim(b) && (a.execScript || function (b) {
                a.eval.call(a, b)
            })(b)
        }, camelCase:function (a) {
            return a.replace(sb, "ms-").replace(tb, ub)
        }, nodeName:function (a, b) {
            return a.nodeName && a.nodeName.toLowerCase() === b.toLowerCase()
        }, each:function (a, b, d) {
            var e, f = 0, g = a.length, h = c(a);
            if (d) {
                if (h)for (; g > f && (e = b.apply(a[f], d), e !== !1); f++); else for (f in a)if (e = b.apply(a[f], d), e === !1)break
            } else if (h)for (; g > f && (e = b.call(a[f], f, a[f]), e !== !1); f++); else for (f in a)if (e = b.call(a[f], f, a[f]), e === !1)break;
            return a
        }, trim:hb && !hb.call("﻿ ") ? function (a) {
            return null == a ? "" : hb.call(a)
        } : function (a) {
            return null == a ? "" : (a + "").replace(lb, "")
        }, makeArray:function (a, b) {
            var d = b || [];
            return null != a && (c(Object(a)) ? ib.merge(d, "string" == typeof a ? [a] : a) : cb.call(d, a)), d
        }, inArray:function (a, b, c) {
            var d;
            if (b) {
                if (eb)return eb.call(b, a, c);
                for (d = b.length, c = c ? 0 > c ? Math.max(0, d + c) : c : 0; d > c; c++)if (c in b && b[c] === a)return c
            }
            return-1
        }, merge:function (a, c) {
            var d = c.length, e = a.length, f = 0;
            if ("number" == typeof d)for (; d > f; f++)a[e++] = c[f]; else for (; c[f] !== b;)a[e++] = c[f++];
            return a.length = e, a
        }, grep:function (a, b, c) {
            var d, e = [], f = 0, g = a.length;
            for (c = !!c; g > f; f++)d = !!b(a[f], f), c !== d && e.push(a[f]);
            return e
        }, map:function (a, b, d) {
            var e, f = 0, g = a.length, h = c(a), i = [];
            if (h)for (; g > f; f++)e = b(a[f], f, d), null != e && (i[i.length] = e); else for (f in a)e = b(a[f], f, d), null != e && (i[i.length] = e);
            return bb.apply([], i)
        }, guid:1, proxy:function (a, c) {
            var d, e, f;
            return"string" == typeof c && (f = a[c], c = a, a = f), ib.isFunction(a) ? (d = db.call(arguments, 2), e = function () {
                return a.apply(c || this, d.concat(db.call(arguments)))
            }, e.guid = a.guid = a.guid || ib.guid++, e) : b
        }, access:function (a, c, d, e, f, g, h) {
            var i = 0, j = a.length, k = null == d;
            if ("object" === ib.type(d)) {
                f = !0;
                for (i in d)ib.access(a, c, i, d[i], !0, g, h)
            } else if (e !== b && (f = !0, ib.isFunction(e) || (h = !0), k && (h ? (c.call(a, e), c = null) : (k = c, c = function (a, b, c) {
                return k.call(ib(a), c)
            })), c))for (; j > i; i++)c(a[i], d, h ? e : e.call(a[i], i, c(a[i], d)));
            return f ? a : k ? c.call(a) : j ? c(a[0], d) : g
        }, now:function () {
            return(new Date).getTime()
        }}), ib.ready.promise = function (b) {
            if (!T)if (T = ib.Deferred(), "complete" === W.readyState)setTimeout(ib.ready); else if (W.addEventListener)W.addEventListener("DOMContentLoaded", vb, !1), a.addEventListener("load", vb, !1); else {
                W.attachEvent("onreadystatechange", vb), a.attachEvent("onload", vb);
                var c = !1;
                try {
                    c = null == a.frameElement && W.documentElement
                } catch (d) {
                }
                c && c.doScroll && !function e() {
                    if (!ib.isReady) {
                        try {
                            c.doScroll("left")
                        } catch (a) {
                            return setTimeout(e, 50)
                        }
                        wb(), ib.ready()
                    }
                }()
            }
            return T.promise(b)
        }, ib.each("Boolean Number String Function Array Date RegExp Object Error".split(" "), function (a, b) {
            $["[object " + b + "]"] = b.toLowerCase()
        }), U = ib(W);
        var xb = {};
        ib.Callbacks = function (a) {
            a = "string" == typeof a ? xb[a] || d(a) : ib.extend({}, a);
            var c, e, f, g, h, i, j = [], k = !a.once && [], l = function (b) {
                for (e = a.memory && b, f = !0, h = i || 0, i = 0, g = j.length, c = !0; j && g > h; h++)if (j[h].apply(b[0], b[1]) === !1 && a.stopOnFalse) {
                    e = !1;
                    break
                }
                c = !1, j && (k ? k.length && l(k.shift()) : e ? j = [] : m.disable())
            }, m = {add:function () {
                if (j) {
                    var b = j.length;
                    !function d(b) {
                        ib.each(b, function (b, c) {
                            var e = ib.type(c);
                            "function" === e ? a.unique && m.has(c) || j.push(c) : c && c.length && "string" !== e && d(c)
                        })
                    }(arguments), c ? g = j.length : e && (i = b, l(e))
                }
                return this
            }, remove:function () {
                return j && ib.each(arguments, function (a, b) {
                    for (var d; (d = ib.inArray(b, j, d)) > -1;)j.splice(d, 1), c && (g >= d && g--, h >= d && h--)
                }), this
            }, has:function (a) {
                return a ? ib.inArray(a, j) > -1 : !(!j || !j.length)
            }, empty:function () {
                return j = [], this
            }, disable:function () {
                return j = k = e = b, this
            }, disabled:function () {
                return!j
            }, lock:function () {
                return k = b, e || m.disable(), this
            }, locked:function () {
                return!k
            }, fireWith:function (a, b) {
                return b = b || [], b = [a, b.slice ? b.slice() : b], !j || f && !k || (c ? k.push(b) : l(b)), this
            }, fire:function () {
                return m.fireWith(this, arguments), this
            }, fired:function () {
                return!!f
            }};
            return m
        }, ib.extend({Deferred:function (a) {
            var b = [
                ["resolve", "done", ib.Callbacks("once memory"), "resolved"],
                ["reject", "fail", ib.Callbacks("once memory"), "rejected"],
                ["notify", "progress", ib.Callbacks("memory")]
            ], c = "pending", d = {state:function () {
                return c
            }, always:function () {
                return e.done(arguments).fail(arguments), this
            }, then:function () {
                var a = arguments;
                return ib.Deferred(function (c) {
                    ib.each(b, function (b, f) {
                        var g = f[0], h = ib.isFunction(a[b]) && a[b];
                        e[f[1]](function () {
                            var a = h && h.apply(this, arguments);
                            a && ib.isFunction(a.promise) ? a.promise().done(c.resolve).fail(c.reject).progress(c.notify) : c[g + "With"](this === d ? c.promise() : this, h ? [a] : arguments)
                        })
                    }), a = null
                }).promise()
            }, promise:function (a) {
                return null != a ? ib.extend(a, d) : d
            }}, e = {};
            return d.pipe = d.then, ib.each(b, function (a, f) {
                var g = f[2], h = f[3];
                d[f[1]] = g.add, h && g.add(function () {
                    c = h
                }, b[1 ^ a][2].disable, b[2][2].lock), e[f[0]] = function () {
                    return e[f[0] + "With"](this === e ? d : this, arguments), this
                }, e[f[0] + "With"] = g.fireWith
            }), d.promise(e), a && a.call(e, e), e
        }, when:function (a) {
            var b, c, d, e = 0, f = db.call(arguments), g = f.length, h = 1 !== g || a && ib.isFunction(a.promise) ? g : 0, i = 1 === h ? a : ib.Deferred(), j = function (a, c, d) {
                return function (e) {
                    c[a] = this, d[a] = arguments.length > 1 ? db.call(arguments) : e, d === b ? i.notifyWith(c, d) : --h || i.resolveWith(c, d)
                }
            };
            if (g > 1)for (b = new Array(g), c = new Array(g), d = new Array(g); g > e; e++)f[e] && ib.isFunction(f[e].promise) ? f[e].promise().done(j(e, d, f)).fail(i.reject).progress(j(e, c, b)) : --h;
            return h || i.resolveWith(d, f), i.promise()
        }}), ib.support = function () {
            var b, c, d, e, f, g, h, i, j, k, l = W.createElement("div");
            if (l.setAttribute("className", "t"), l.innerHTML = "  <link/><table></table><a href='/a'>a</a><input type='checkbox'/>", c = l.getElementsByTagName("*"), d = l.getElementsByTagName("a")[0], !c || !d || !c.length)return{};
            f = W.createElement("select"), h = f.appendChild(W.createElement("option")), e = l.getElementsByTagName("input")[0], d.style.cssText = "top:1px;float:left;opacity:.5", b = {getSetAttribute:"t" !== l.className, leadingWhitespace:3 === l.firstChild.nodeType, tbody:!l.getElementsByTagName("tbody").length, htmlSerialize:!!l.getElementsByTagName("link").length, style:/top/.test(d.getAttribute("style")), hrefNormalized:"/a" === d.getAttribute("href"), opacity:/^0.5/.test(d.style.opacity), cssFloat:!!d.style.cssFloat, checkOn:!!e.value, optSelected:h.selected, enctype:!!W.createElement("form").enctype, html5Clone:"<:nav></:nav>" !== W.createElement("nav").cloneNode(!0).outerHTML, boxModel:"CSS1Compat" === W.compatMode, deleteExpando:!0, noCloneEvent:!0, inlineBlockNeedsLayout:!1, shrinkWrapBlocks:!1, reliableMarginRight:!0, boxSizingReliable:!0, pixelPosition:!1}, e.checked = !0, b.noCloneChecked = e.cloneNode(!0).checked, f.disabled = !0, b.optDisabled = !h.disabled;
            try {
                delete l.test
            } catch (m) {
                b.deleteExpando = !1
            }
            e = W.createElement("input"), e.setAttribute("value", ""), b.input = "" === e.getAttribute("value"), e.value = "t", e.setAttribute("type", "radio"), b.radioValue = "t" === e.value, e.setAttribute("checked", "t"), e.setAttribute("name", "t"), g = W.createDocumentFragment(), g.appendChild(e), b.appendChecked = e.checked, b.checkClone = g.cloneNode(!0).cloneNode(!0).lastChild.checked, l.attachEvent && (l.attachEvent("onclick", function () {
                b.noCloneEvent = !1
            }), l.cloneNode(!0).click());
            for (k in{submit:!0, change:!0, focusin:!0})l.setAttribute(i = "on" + k, "t"), b[k + "Bubbles"] = i in a || l.attributes[i].expando === !1;
            return l.style.backgroundClip = "content-box", l.cloneNode(!0).style.backgroundClip = "", b.clearCloneStyle = "content-box" === l.style.backgroundClip, ib(function () {
                var c, d, e, f = "padding:0;margin:0;border:0;display:block;box-sizing:content-box;-moz-box-sizing:content-box;-webkit-box-sizing:content-box;", g = W.getElementsByTagName("body")[0];
                g && (c = W.createElement("div"), c.style.cssText = "border:0;width:0;height:0;position:absolute;top:0;left:-9999px;margin-top:1px", g.appendChild(c).appendChild(l), l.innerHTML = "<table><tr><td></td><td>t</td></tr></table>", e = l.getElementsByTagName("td"), e[0].style.cssText = "padding:0;margin:0;border:0;display:none", j = 0 === e[0].offsetHeight, e[0].style.display = "", e[1].style.display = "none", b.reliableHiddenOffsets = j && 0 === e[0].offsetHeight, l.innerHTML = "", l.style.cssText = "box-sizing:border-box;-moz-box-sizing:border-box;-webkit-box-sizing:border-box;padding:1px;border:1px;display:block;width:4px;margin-top:1%;position:absolute;top:1%;", b.boxSizing = 4 === l.offsetWidth, b.doesNotIncludeMarginInBodyOffset = 1 !== g.offsetTop, a.getComputedStyle && (b.pixelPosition = "1%" !== (a.getComputedStyle(l, null) || {}).top, b.boxSizingReliable = "4px" === (a.getComputedStyle(l, null) || {width:"4px"}).width, d = l.appendChild(W.createElement("div")), d.style.cssText = l.style.cssText = f, d.style.marginRight = d.style.width = "0", l.style.width = "1px", b.reliableMarginRight = !parseFloat((a.getComputedStyle(d, null) || {}).marginRight)), typeof l.style.zoom !== V && (l.innerHTML = "", l.style.cssText = f + "width:1px;padding:1px;display:inline;zoom:1", b.inlineBlockNeedsLayout = 3 === l.offsetWidth, l.style.display = "block", l.innerHTML = "<div></div>", l.firstChild.style.width = "5px", b.shrinkWrapBlocks = 3 !== l.offsetWidth, b.inlineBlockNeedsLayout && (g.style.zoom = 1)), g.removeChild(c), c = l = e = d = null)
            }), c = f = g = h = d = e = null, b
        }();
        var yb = /(?:\{[\s\S]*\}|\[[\s\S]*\])$/, zb = /([A-Z])/g;
        ib.extend({cache:{}, expando:"jQuery" + (ab + Math.random()).replace(/\D/g, ""), noData:{embed:!0, object:"clsid:D27CDB6E-AE6D-11cf-96B8-444553540000", applet:!0}, hasData:function (a) {
            return a = a.nodeType ? ib.cache[a[ib.expando]] : a[ib.expando], !!a && !h(a)
        }, data:function (a, b, c) {
            return e(a, b, c)
        }, removeData:function (a, b) {
            return f(a, b)
        }, _data:function (a, b, c) {
            return e(a, b, c, !0)
        }, _removeData:function (a, b) {
            return f(a, b, !0)
        }, acceptData:function (a) {
            if (a.nodeType && 1 !== a.nodeType && 9 !== a.nodeType)return!1;
            var b = a.nodeName && ib.noData[a.nodeName.toLowerCase()];
            return!b || b !== !0 && a.getAttribute("classid") === b
        }}), ib.fn.extend({data:function (a, c) {
            var d, e, f = this[0], h = 0, i = null;
            if (a === b) {
                if (this.length && (i = ib.data(f), 1 === f.nodeType && !ib._data(f, "parsedAttrs"))) {
                    for (d = f.attributes; h < d.length; h++)e = d[h].name, e.indexOf("data-") || (e = ib.camelCase(e.slice(5)), g(f, e, i[e]));
                    ib._data(f, "parsedAttrs", !0)
                }
                return i
            }
            return"object" == typeof a ? this.each(function () {
                ib.data(this, a)
            }) : ib.access(this, function (c) {
                return c === b ? f ? g(f, a, ib.data(f, a)) : null : void this.each(function () {
                    ib.data(this, a, c)
                })
            }, null, c, arguments.length > 1, null, !0)
        }, removeData:function (a) {
            return this.each(function () {
                ib.removeData(this, a)
            })
        }}), ib.extend({queue:function (a, b, c) {
            var d;
            return a ? (b = (b || "fx") + "queue", d = ib._data(a, b), c && (!d || ib.isArray(c) ? d = ib._data(a, b, ib.makeArray(c)) : d.push(c)), d || []) : void 0
        }, dequeue:function (a, b) {
            b = b || "fx";
            var c = ib.queue(a, b), d = c.length, e = c.shift(), f = ib._queueHooks(a, b), g = function () {
                ib.dequeue(a, b)
            };
            "inprogress" === e && (e = c.shift(), d--), f.cur = e, e && ("fx" === b && c.unshift("inprogress"), delete f.stop, e.call(a, g, f)), !d && f && f.empty.fire()
        }, _queueHooks:function (a, b) {
            var c = b + "queueHooks";
            return ib._data(a, c) || ib._data(a, c, {empty:ib.Callbacks("once memory").add(function () {
                ib._removeData(a, b + "queue"), ib._removeData(a, c)
            })})
        }}), ib.fn.extend({queue:function (a, c) {
            var d = 2;
            return"string" != typeof a && (c = a, a = "fx", d--), arguments.length < d ? ib.queue(this[0], a) : c === b ? this : this.each(function () {
                var b = ib.queue(this, a, c);
                ib._queueHooks(this, a), "fx" === a && "inprogress" !== b[0] && ib.dequeue(this, a)
            })
        }, dequeue:function (a) {
            return this.each(function () {
                ib.dequeue(this, a)
            })
        }, delay:function (a, b) {
            return a = ib.fx ? ib.fx.speeds[a] || a : a, b = b || "fx", this.queue(b, function (b, c) {
                var d = setTimeout(b, a);
                c.stop = function () {
                    clearTimeout(d)
                }
            })
        }, clearQueue:function (a) {
            return this.queue(a || "fx", [])
        }, promise:function (a, c) {
            var d, e = 1, f = ib.Deferred(), g = this, h = this.length, i = function () {
                --e || f.resolveWith(g, [g])
            };
            for ("string" != typeof a && (c = a, a = b), a = a || "fx"; h--;)d = ib._data(g[h], a + "queueHooks"), d && d.empty && (e++, d.empty.add(i));
            return i(), f.promise(c)
        }});
        var Ab, Bb, Cb = /[\t\r\n]/g, Db = /\r/g, Eb = /^(?:input|select|textarea|button|object)$/i, Fb = /^(?:a|area)$/i, Gb = /^(?:checked|selected|autofocus|autoplay|async|controls|defer|disabled|hidden|loop|multiple|open|readonly|required|scoped)$/i, Hb = /^(?:checked|selected)$/i, Ib = ib.support.getSetAttribute, Jb = ib.support.input;
        ib.fn.extend({attr:function (a, b) {
            return ib.access(this, ib.attr, a, b, arguments.length > 1)
        }, removeAttr:function (a) {
            return this.each(function () {
                ib.removeAttr(this, a)
            })
        }, prop:function (a, b) {
            return ib.access(this, ib.prop, a, b, arguments.length > 1)
        }, removeProp:function (a) {
            return a = ib.propFix[a] || a, this.each(function () {
                try {
                    this[a] = b, delete this[a]
                } catch (c) {
                }
            })
        }, addClass:function (a) {
            var b, c, d, e, f, g = 0, h = this.length, i = "string" == typeof a && a;
            if (ib.isFunction(a))return this.each(function (b) {
                ib(this).addClass(a.call(this, b, this.className))
            });
            if (i)for (b = (a || "").match(kb) || []; h > g; g++)if (c = this[g], d = 1 === c.nodeType && (c.className ? (" " + c.className + " ").replace(Cb, " ") : " ")) {
                for (f = 0; e = b[f++];)d.indexOf(" " + e + " ") < 0 && (d += e + " ");
                c.className = ib.trim(d)
            }
            return this
        }, removeClass:function (a) {
            var b, c, d, e, f, g = 0, h = this.length, i = 0 === arguments.length || "string" == typeof a && a;
            if (ib.isFunction(a))return this.each(function (b) {
                ib(this).removeClass(a.call(this, b, this.className))
            });
            if (i)for (b = (a || "").match(kb) || []; h > g; g++)if (c = this[g], d = 1 === c.nodeType && (c.className ? (" " + c.className + " ").replace(Cb, " ") : "")) {
                for (f = 0; e = b[f++];)for (; d.indexOf(" " + e + " ") >= 0;)d = d.replace(" " + e + " ", " ");
                c.className = a ? ib.trim(d) : ""
            }
            return this
        }, toggleClass:function (a, b) {
            var c = typeof a, d = "boolean" == typeof b;
            return this.each(ib.isFunction(a) ? function (c) {
                ib(this).toggleClass(a.call(this, c, this.className, b), b)
            } : function () {
                if ("string" === c)for (var e, f = 0, g = ib(this), h = b, i = a.match(kb) || []; e = i[f++];)h = d ? h : !g.hasClass(e), g[h ? "addClass" : "removeClass"](e); else(c === V || "boolean" === c) && (this.className && ib._data(this, "__className__", this.className), this.className = this.className || a === !1 ? "" : ib._data(this, "__className__") || "")
            })
        }, hasClass:function (a) {
            for (var b = " " + a + " ", c = 0, d = this.length; d > c; c++)if (1 === this[c].nodeType && (" " + this[c].className + " ").replace(Cb, " ").indexOf(b) >= 0)return!0;
            return!1
        }, val:function (a) {
            var c, d, e, f = this[0];
            {
                if (arguments.length)return e = ib.isFunction(a), this.each(function (c) {
                    var f, g = ib(this);
                    1 === this.nodeType && (f = e ? a.call(this, c, g.val()) : a, null == f ? f = "" : "number" == typeof f ? f += "" : ib.isArray(f) && (f = ib.map(f, function (a) {
                        return null == a ? "" : a + ""
                    })), d = ib.valHooks[this.type] || ib.valHooks[this.nodeName.toLowerCase()], d && "set"in d && d.set(this, f, "value") !== b || (this.value = f))
                });
                if (f)return d = ib.valHooks[f.type] || ib.valHooks[f.nodeName.toLowerCase()], d && "get"in d && (c = d.get(f, "value")) !== b ? c : (c = f.value, "string" == typeof c ? c.replace(Db, "") : null == c ? "" : c)
            }
        }}), ib.extend({valHooks:{option:{get:function (a) {
            var b = a.attributes.value;
            return!b || b.specified ? a.value : a.text
        }}, select:{get:function (a) {
            for (var b, c, d = a.options, e = a.selectedIndex, f = "select-one" === a.type || 0 > e, g = f ? null : [], h = f ? e + 1 : d.length, i = 0 > e ? h : f ? e : 0; h > i; i++)if (c = d[i], !(!c.selected && i !== e || (ib.support.optDisabled ? c.disabled : null !== c.getAttribute("disabled")) || c.parentNode.disabled && ib.nodeName(c.parentNode, "optgroup"))) {
                if (b = ib(c).val(), f)return b;
                g.push(b)
            }
            return g
        }, set:function (a, b) {
            var c = ib.makeArray(b);
            return ib(a).find("option").each(function () {
                this.selected = ib.inArray(ib(this).val(), c) >= 0
            }), c.length || (a.selectedIndex = -1), c
        }}}, attr:function (a, c, d) {
            var e, f, g, h = a.nodeType;
            if (a && 3 !== h && 8 !== h && 2 !== h)return typeof a.getAttribute === V ? ib.prop(a, c, d) : (f = 1 !== h || !ib.isXMLDoc(a), f && (c = c.toLowerCase(), e = ib.attrHooks[c] || (Gb.test(c) ? Bb : Ab)), d === b ? e && f && "get"in e && null !== (g = e.get(a, c)) ? g : (typeof a.getAttribute !== V && (g = a.getAttribute(c)), null == g ? b : g) : null !== d ? e && f && "set"in e && (g = e.set(a, d, c)) !== b ? g : (a.setAttribute(c, d + ""), d) : void ib.removeAttr(a, c))
        }, removeAttr:function (a, b) {
            var c, d, e = 0, f = b && b.match(kb);
            if (f && 1 === a.nodeType)for (; c = f[e++];)d = ib.propFix[c] || c, Gb.test(c) ? !Ib && Hb.test(c) ? a[ib.camelCase("default-" + c)] = a[d] = !1 : a[d] = !1 : ib.attr(a, c, ""), a.removeAttribute(Ib ? c : d)
        }, attrHooks:{type:{set:function (a, b) {
            if (!ib.support.radioValue && "radio" === b && ib.nodeName(a, "input")) {
                var c = a.value;
                return a.setAttribute("type", b), c && (a.value = c), b
            }
        }}}, propFix:{tabindex:"tabIndex", readonly:"readOnly", "for":"htmlFor", "class":"className", maxlength:"maxLength", cellspacing:"cellSpacing", cellpadding:"cellPadding", rowspan:"rowSpan", colspan:"colSpan", usemap:"useMap", frameborder:"frameBorder", contenteditable:"contentEditable"}, prop:function (a, c, d) {
            var e, f, g, h = a.nodeType;
            if (a && 3 !== h && 8 !== h && 2 !== h)return g = 1 !== h || !ib.isXMLDoc(a), g && (c = ib.propFix[c] || c, f = ib.propHooks[c]), d !== b ? f && "set"in f && (e = f.set(a, d, c)) !== b ? e : a[c] = d : f && "get"in f && null !== (e = f.get(a, c)) ? e : a[c]
        }, propHooks:{tabIndex:{get:function (a) {
            var c = a.getAttributeNode("tabindex");
            return c && c.specified ? parseInt(c.value, 10) : Eb.test(a.nodeName) || Fb.test(a.nodeName) && a.href ? 0 : b
        }}}}), Bb = {get:function (a, c) {
            var d = ib.prop(a, c), e = "boolean" == typeof d && a.getAttribute(c), f = "boolean" == typeof d ? Jb && Ib ? null != e : Hb.test(c) ? a[ib.camelCase("default-" + c)] : !!e : a.getAttributeNode(c);
            return f && f.value !== !1 ? c.toLowerCase() : b
        }, set:function (a, b, c) {
            return b === !1 ? ib.removeAttr(a, c) : Jb && Ib || !Hb.test(c) ? a.setAttribute(!Ib && ib.propFix[c] || c, c) : a[ib.camelCase("default-" + c)] = a[c] = !0, c
        }}, Jb && Ib || (ib.attrHooks.value = {get:function (a, c) {
            var d = a.getAttributeNode(c);
            return ib.nodeName(a, "input") ? a.defaultValue : d && d.specified ? d.value : b
        }, set:function (a, b, c) {
            return ib.nodeName(a, "input") ? void(a.defaultValue = b) : Ab && Ab.set(a, b, c)
        }}), Ib || (Ab = ib.valHooks.button = {get:function (a, c) {
            var d = a.getAttributeNode(c);
            return d && ("id" === c || "name" === c || "coords" === c ? "" !== d.value : d.specified) ? d.value : b
        }, set:function (a, c, d) {
            var e = a.getAttributeNode(d);
            return e || a.setAttributeNode(e = a.ownerDocument.createAttribute(d)), e.value = c += "", "value" === d || c === a.getAttribute(d) ? c : b
        }}, ib.attrHooks.contenteditable = {get:Ab.get, set:function (a, b, c) {
            Ab.set(a, "" === b ? !1 : b, c)
        }}, ib.each(["width", "height"], function (a, b) {
            ib.attrHooks[b] = ib.extend(ib.attrHooks[b], {set:function (a, c) {
                return"" === c ? (a.setAttribute(b, "auto"), c) : void 0
            }})
        })), ib.support.hrefNormalized || (ib.each(["href", "src", "width", "height"], function (a, c) {
            ib.attrHooks[c] = ib.extend(ib.attrHooks[c], {get:function (a) {
                var d = a.getAttribute(c, 2);
                return null == d ? b : d
            }})
        }), ib.each(["href", "src"], function (a, b) {
            ib.propHooks[b] = {get:function (a) {
                return a.getAttribute(b, 4)
            }}
        })), ib.support.style || (ib.attrHooks.style = {get:function (a) {
            return a.style.cssText || b
        }, set:function (a, b) {
            return a.style.cssText = b + ""
        }}), ib.support.optSelected || (ib.propHooks.selected = ib.extend(ib.propHooks.selected, {get:function (a) {
            var b = a.parentNode;
            return b && (b.selectedIndex, b.parentNode && b.parentNode.selectedIndex), null
        }})), ib.support.enctype || (ib.propFix.enctype = "encoding"), ib.support.checkOn || ib.each(["radio", "checkbox"], function () {
            ib.valHooks[this] = {get:function (a) {
                return null === a.getAttribute("value") ? "on" : a.value
            }}
        }), ib.each(["radio", "checkbox"], function () {
            ib.valHooks[this] = ib.extend(ib.valHooks[this], {set:function (a, b) {
                return ib.isArray(b) ? a.checked = ib.inArray(ib(a).val(), b) >= 0 : void 0
            }})
        });
        var Kb = /^(?:input|select|textarea)$/i, Lb = /^key/, Mb = /^(?:mouse|contextmenu)|click/, Nb = /^(?:focusinfocus|focusoutblur)$/, Ob = /^([^.]*)(?:\.(.+)|)$/;
        ib.event = {global:{}, add:function (a, c, d, e, f) {
            var g, h, i, j, k, l, m, n, o, p, q, r = ib._data(a);
            if (r) {
                for (d.handler && (j = d, d = j.handler, f = j.selector), d.guid || (d.guid = ib.guid++), (h = r.events) || (h = r.events = {}), (l = r.handle) || (l = r.handle = function (a) {
                    return typeof ib === V || a && ib.event.triggered === a.type ? b : ib.event.dispatch.apply(l.elem, arguments)
                }, l.elem = a), c = (c || "").match(kb) || [""], i = c.length; i--;)g = Ob.exec(c[i]) || [], o = q = g[1], p = (g[2] || "").split(".").sort(), k = ib.event.special[o] || {}, o = (f ? k.delegateType : k.bindType) || o, k = ib.event.special[o] || {}, m = ib.extend({type:o, origType:q, data:e, handler:d, guid:d.guid, selector:f, needsContext:f && ib.expr.match.needsContext.test(f), namespace:p.join(".")}, j), (n = h[o]) || (n = h[o] = [], n.delegateCount = 0, k.setup && k.setup.call(a, e, p, l) !== !1 || (a.addEventListener ? a.addEventListener(o, l, !1) : a.attachEvent && a.attachEvent("on" + o, l))), k.add && (k.add.call(a, m), m.handler.guid || (m.handler.guid = d.guid)), f ? n.splice(n.delegateCount++, 0, m) : n.push(m), ib.event.global[o] = !0;
                a = null
            }
        }, remove:function (a, b, c, d, e) {
            var f, g, h, i, j, k, l, m, n, o, p, q = ib.hasData(a) && ib._data(a);
            if (q && (k = q.events)) {
                for (b = (b || "").match(kb) || [""], j = b.length; j--;)if (h = Ob.exec(b[j]) || [], n = p = h[1], o = (h[2] || "").split(".").sort(), n) {
                    for (l = ib.event.special[n] || {}, n = (d ? l.delegateType : l.bindType) || n, m = k[n] || [], h = h[2] && new RegExp("(^|\\.)" + o.join("\\.(?:.*\\.|)") + "(\\.|$)"), i = f = m.length; f--;)g = m[f], !e && p !== g.origType || c && c.guid !== g.guid || h && !h.test(g.namespace) || d && d !== g.selector && ("**" !== d || !g.selector) || (m.splice(f, 1), g.selector && m.delegateCount--, l.remove && l.remove.call(a, g));
                    i && !m.length && (l.teardown && l.teardown.call(a, o, q.handle) !== !1 || ib.removeEvent(a, n, q.handle), delete k[n])
                } else for (n in k)ib.event.remove(a, n + b[j], c, d, !0);
                ib.isEmptyObject(k) && (delete q.handle, ib._removeData(a, "events"))
            }
        }, trigger:function (c, d, e, f) {
            var g, h, i, j, k, l, m, n = [e || W], o = gb.call(c, "type") ? c.type : c, p = gb.call(c, "namespace") ? c.namespace.split(".") : [];
            if (i = l = e = e || W, 3 !== e.nodeType && 8 !== e.nodeType && !Nb.test(o + ib.event.triggered) && (o.indexOf(".") >= 0 && (p = o.split("."), o = p.shift(), p.sort()), h = o.indexOf(":") < 0 && "on" + o, c = c[ib.expando] ? c : new ib.Event(o, "object" == typeof c && c), c.isTrigger = !0, c.namespace = p.join("."), c.namespace_re = c.namespace ? new RegExp("(^|\\.)" + p.join("\\.(?:.*\\.|)") + "(\\.|$)") : null, c.result = b, c.target || (c.target = e), d = null == d ? [c] : ib.makeArray(d, [c]), k = ib.event.special[o] || {}, f || !k.trigger || k.trigger.apply(e, d) !== !1)) {
                if (!f && !k.noBubble && !ib.isWindow(e)) {
                    for (j = k.delegateType || o, Nb.test(j + o) || (i = i.parentNode); i; i = i.parentNode)n.push(i), l = i;
                    l === (e.ownerDocument || W) && n.push(l.defaultView || l.parentWindow || a)
                }
                for (m = 0; (i = n[m++]) && !c.isPropagationStopped();)c.type = m > 1 ? j : k.bindType || o, g = (ib._data(i, "events") || {})[c.type] && ib._data(i, "handle"), g && g.apply(i, d), g = h && i[h], g && ib.acceptData(i) && g.apply && g.apply(i, d) === !1 && c.preventDefault();
                if (c.type = o, !(f || c.isDefaultPrevented() || k._default && k._default.apply(e.ownerDocument, d) !== !1 || "click" === o && ib.nodeName(e, "a") || !ib.acceptData(e) || !h || !e[o] || ib.isWindow(e))) {
                    l = e[h], l && (e[h] = null), ib.event.triggered = o;
                    try {
                        e[o]()
                    } catch (q) {
                    }
                    ib.event.triggered = b, l && (e[h] = l)
                }
                return c.result
            }
        }, dispatch:function (a) {
            a = ib.event.fix(a);
            var c, d, e, f, g, h = [], i = db.call(arguments), j = (ib._data(this, "events") || {})[a.type] || [], k = ib.event.special[a.type] || {};
            if (i[0] = a, a.delegateTarget = this, !k.preDispatch || k.preDispatch.call(this, a) !== !1) {
                for (h = ib.event.handlers.call(this, a, j), c = 0; (f = h[c++]) && !a.isPropagationStopped();)for (a.currentTarget = f.elem, g = 0; (e = f.handlers[g++]) && !a.isImmediatePropagationStopped();)(!a.namespace_re || a.namespace_re.test(e.namespace)) && (a.handleObj = e, a.data = e.data, d = ((ib.event.special[e.origType] || {}).handle || e.handler).apply(f.elem, i), d !== b && (a.result = d) === !1 && (a.preventDefault(), a.stopPropagation()));
                return k.postDispatch && k.postDispatch.call(this, a), a.result
            }
        }, handlers:function (a, c) {
            var d, e, f, g, h = [], i = c.delegateCount, j = a.target;
            if (i && j.nodeType && (!a.button || "click" !== a.type))for (; j != this; j = j.parentNode || this)if (1 === j.nodeType && (j.disabled !== !0 || "click" !== a.type)) {
                for (f = [], g = 0; i > g; g++)e = c[g], d = e.selector + " ", f[d] === b && (f[d] = e.needsContext ? ib(d, this).index(j) >= 0 : ib.find(d, this, null, [j]).length), f[d] && f.push(e);
                f.length && h.push({elem:j, handlers:f})
            }
            return i < c.length && h.push({elem:this, handlers:c.slice(i)}), h
        }, fix:function (a) {
            if (a[ib.expando])return a;
            var b, c, d, e = a.type, f = a, g = this.fixHooks[e];
            for (g || (this.fixHooks[e] = g = Mb.test(e) ? this.mouseHooks : Lb.test(e) ? this.keyHooks : {}), d = g.props ? this.props.concat(g.props) : this.props, a = new ib.Event(f), b = d.length; b--;)c = d[b], a[c] = f[c];
            return a.target || (a.target = f.srcElement || W), 3 === a.target.nodeType && (a.target = a.target.parentNode), a.metaKey = !!a.metaKey, g.filter ? g.filter(a, f) : a
        }, props:"altKey bubbles cancelable ctrlKey currentTarget eventPhase metaKey relatedTarget shiftKey target timeStamp view which".split(" "), fixHooks:{}, keyHooks:{props:"char charCode key keyCode".split(" "), filter:function (a, b) {
            return null == a.which && (a.which = null != b.charCode ? b.charCode : b.keyCode), a
        }}, mouseHooks:{props:"button buttons clientX clientY fromElement offsetX offsetY pageX pageY screenX screenY toElement".split(" "), filter:function (a, c) {
            var d, e, f, g = c.button, h = c.fromElement;
            return null == a.pageX && null != c.clientX && (e = a.target.ownerDocument || W, f = e.documentElement, d = e.body, a.pageX = c.clientX + (f && f.scrollLeft || d && d.scrollLeft || 0) - (f && f.clientLeft || d && d.clientLeft || 0), a.pageY = c.clientY + (f && f.scrollTop || d && d.scrollTop || 0) - (f && f.clientTop || d && d.clientTop || 0)), !a.relatedTarget && h && (a.relatedTarget = h === a.target ? c.toElement : h), a.which || g === b || (a.which = 1 & g ? 1 : 2 & g ? 3 : 4 & g ? 2 : 0), a
        }}, special:{load:{noBubble:!0}, click:{trigger:function () {
            return ib.nodeName(this, "input") && "checkbox" === this.type && this.click ? (this.click(), !1) : void 0
        }}, focus:{trigger:function () {
            if (this !== W.activeElement && this.focus)try {
                return this.focus(), !1
            } catch (a) {
            }
        }, delegateType:"focusin"}, blur:{trigger:function () {
            return this === W.activeElement && this.blur ? (this.blur(), !1) : void 0
        }, delegateType:"focusout"}, beforeunload:{postDispatch:function (a) {
            a.result !== b && (a.originalEvent.returnValue = a.result)
        }}}, simulate:function (a, b, c, d) {
            var e = ib.extend(new ib.Event, c, {type:a, isSimulated:!0, originalEvent:{}});
            d ? ib.event.trigger(e, null, b) : ib.event.dispatch.call(b, e), e.isDefaultPrevented() && c.preventDefault()
        }}, ib.removeEvent = W.removeEventListener ? function (a, b, c) {
            a.removeEventListener && a.removeEventListener(b, c, !1)
        } : function (a, b, c) {
            var d = "on" + b;
            a.detachEvent && (typeof a[d] === V && (a[d] = null), a.detachEvent(d, c))
        }, ib.Event = function (a, b) {
            return this instanceof ib.Event ? (a && a.type ? (this.originalEvent = a, this.type = a.type, this.isDefaultPrevented = a.defaultPrevented || a.returnValue === !1 || a.getPreventDefault && a.getPreventDefault() ? i : j) : this.type = a, b && ib.extend(this, b), this.timeStamp = a && a.timeStamp || ib.now(), void(this[ib.expando] = !0)) : new ib.Event(a, b)
        }, ib.Event.prototype = {isDefaultPrevented:j, isPropagationStopped:j, isImmediatePropagationStopped:j, preventDefault:function () {
            var a = this.originalEvent;
            this.isDefaultPrevented = i, a && (a.preventDefault ? a.preventDefault() : a.returnValue = !1)
        }, stopPropagation:function () {
            var a = this.originalEvent;
            this.isPropagationStopped = i, a && (a.stopPropagation && a.stopPropagation(), a.cancelBubble = !0)
        }, stopImmediatePropagation:function () {
            this.isImmediatePropagationStopped = i, this.stopPropagation()
        }}, ib.each({mouseenter:"mouseover", mouseleave:"mouseout"}, function (a, b) {
            ib.event.special[a] = {delegateType:b, bindType:b, handle:function (a) {
                var c, d = this, e = a.relatedTarget, f = a.handleObj;
                return(!e || e !== d && !ib.contains(d, e)) && (a.type = f.origType, c = f.handler.apply(this, arguments), a.type = b), c
            }}
        }), ib.support.submitBubbles || (ib.event.special.submit = {setup:function () {
            return ib.nodeName(this, "form") ? !1 : void ib.event.add(this, "click._submit keypress._submit", function (a) {
                var c = a.target, d = ib.nodeName(c, "input") || ib.nodeName(c, "button") ? c.form : b;
                d && !ib._data(d, "submitBubbles") && (ib.event.add(d, "submit._submit", function (a) {
                    a._submit_bubble = !0
                }), ib._data(d, "submitBubbles", !0))
            })
        }, postDispatch:function (a) {
            a._submit_bubble && (delete a._submit_bubble, this.parentNode && !a.isTrigger && ib.event.simulate("submit", this.parentNode, a, !0))
        }, teardown:function () {
            return ib.nodeName(this, "form") ? !1 : void ib.event.remove(this, "._submit")
        }}), ib.support.changeBubbles || (ib.event.special.change = {setup:function () {
            return Kb.test(this.nodeName) ? (("checkbox" === this.type || "radio" === this.type) && (ib.event.add(this, "propertychange._change", function (a) {
                "checked" === a.originalEvent.propertyName && (this._just_changed = !0)
            }), ib.event.add(this, "click._change", function (a) {
                this._just_changed && !a.isTrigger && (this._just_changed = !1), ib.event.simulate("change", this, a, !0)
            })), !1) : void ib.event.add(this, "beforeactivate._change", function (a) {
                var b = a.target;
                Kb.test(b.nodeName) && !ib._data(b, "changeBubbles") && (ib.event.add(b, "change._change", function (a) {
                    !this.parentNode || a.isSimulated || a.isTrigger || ib.event.simulate("change", this.parentNode, a, !0)
                }), ib._data(b, "changeBubbles", !0))
            })
        }, handle:function (a) {
            var b = a.target;
            return this !== b || a.isSimulated || a.isTrigger || "radio" !== b.type && "checkbox" !== b.type ? a.handleObj.handler.apply(this, arguments) : void 0
        }, teardown:function () {
            return ib.event.remove(this, "._change"), !Kb.test(this.nodeName)
        }}), ib.support.focusinBubbles || ib.each({focus:"focusin", blur:"focusout"}, function (a, b) {
            var c = 0, d = function (a) {
                ib.event.simulate(b, a.target, ib.event.fix(a), !0)
            };
            ib.event.special[b] = {setup:function () {
                0 === c++ && W.addEventListener(a, d, !0)
            }, teardown:function () {
                0 === --c && W.removeEventListener(a, d, !0)
            }}
        }), ib.fn.extend({on:function (a, c, d, e, f) {
            var g, h;
            if ("object" == typeof a) {
                "string" != typeof c && (d = d || c, c = b);
                for (g in a)this.on(g, c, d, a[g], f);
                return this
            }
            if (null == d && null == e ? (e = c, d = c = b) : null == e && ("string" == typeof c ? (e = d, d = b) : (e = d, d = c, c = b)), e === !1)e = j; else if (!e)return this;
            return 1 === f && (h = e, e = function (a) {
                return ib().off(a), h.apply(this, arguments)
            }, e.guid = h.guid || (h.guid = ib.guid++)), this.each(function () {
                ib.event.add(this, a, e, d, c)
            })
        }, one:function (a, b, c, d) {
            return this.on(a, b, c, d, 1)
        }, off:function (a, c, d) {
            var e, f;
            if (a && a.preventDefault && a.handleObj)return e = a.handleObj, ib(a.delegateTarget).off(e.namespace ? e.origType + "." + e.namespace : e.origType, e.selector, e.handler), this;
            if ("object" == typeof a) {
                for (f in a)this.off(f, c, a[f]);
                return this
            }
            return(c === !1 || "function" == typeof c) && (d = c, c = b), d === !1 && (d = j), this.each(function () {
                ib.event.remove(this, a, d, c)
            })
        }, bind:function (a, b, c) {
            return this.on(a, null, b, c)
        }, unbind:function (a, b) {
            return this.off(a, null, b)
        }, delegate:function (a, b, c, d) {
            return this.on(b, a, c, d)
        }, undelegate:function (a, b, c) {
            return 1 === arguments.length ? this.off(a, "**") : this.off(b, a || "**", c)
        }, trigger:function (a, b) {
            return this.each(function () {
                ib.event.trigger(a, b, this)
            })
        }, triggerHandler:function (a, b) {
            var c = this[0];
            return c ? ib.event.trigger(a, b, c, !0) : void 0
        }}), function (a, b) {
            function c(a) {
                return ob.test(a + "")
            }

            function d() {
                var a, b = [];
                return a = function (c, d) {
                    return b.push(c += " ") > y.cacheLength && delete a[b.shift()], a[c] = d
                }
            }

            function e(a) {
                return a[N] = !0, a
            }

            function f(a) {
                var b = F.createElement("div");
                try {
                    return a(b)
                } catch (c) {
                    return!1
                } finally {
                    b = null
                }
            }

            function g(a, b, c, d) {
                var e, f, g, h, i, j, k, n, o, p;
                if ((b ? b.ownerDocument || b : O) !== F && E(b), b = b || F, c = c || [], !a || "string" != typeof a)return c;
                if (1 !== (h = b.nodeType) && 9 !== h)return[];
                if (!H && !d) {
                    if (e = pb.exec(a))if (g = e[1]) {
                        if (9 === h) {
                            if (f = b.getElementById(g), !f || !f.parentNode)return c;
                            if (f.id === g)return c.push(f), c
                        } else if (b.ownerDocument && (f = b.ownerDocument.getElementById(g)) && L(b, f) && f.id === g)return c.push(f), c
                    } else {
                        if (e[2])return Z.apply(c, $.call(b.getElementsByTagName(a), 0)), c;
                        if ((g = e[3]) && P.getByClassName && b.getElementsByClassName)return Z.apply(c, $.call(b.getElementsByClassName(g), 0)), c
                    }
                    if (P.qsa && !I.test(a)) {
                        if (k = !0, n = N, o = b, p = 9 === h && a, 1 === h && "object" !== b.nodeName.toLowerCase()) {
                            for (j = l(a), (k = b.getAttribute("id")) ? n = k.replace(sb, "\\$&") : b.setAttribute("id", n), n = "[id='" + n + "'] ", i = j.length; i--;)j[i] = n + m(j[i]);
                            o = nb.test(a) && b.parentNode || b, p = j.join(",")
                        }
                        if (p)try {
                            return Z.apply(c, $.call(o.querySelectorAll(p), 0)), c
                        } catch (q) {
                        } finally {
                            k || b.removeAttribute("id")
                        }
                    }
                }
                return u(a.replace(gb, "$1"), b, c, d)
            }

            function h(a, b) {
                var c = b && a, d = c && (~b.sourceIndex || W) - (~a.sourceIndex || W);
                if (d)return d;
                if (c)for (; c = c.nextSibling;)if (c === b)return-1;
                return a ? 1 : -1
            }

            function i(a) {
                return function (b) {
                    var c = b.nodeName.toLowerCase();
                    return"input" === c && b.type === a
                }
            }

            function j(a) {
                return function (b) {
                    var c = b.nodeName.toLowerCase();
                    return("input" === c || "button" === c) && b.type === a
                }
            }

            function k(a) {
                return e(function (b) {
                    return b = +b, e(function (c, d) {
                        for (var e, f = a([], c.length, b), g = f.length; g--;)c[e = f[g]] && (c[e] = !(d[e] = c[e]))
                    })
                })
            }

            function l(a, b) {
                var c, d, e, f, h, i, j, k = T[a + " "];
                if (k)return b ? 0 : k.slice(0);
                for (h = a, i = [], j = y.preFilter; h;) {
                    (!c || (d = hb.exec(h))) && (d && (h = h.slice(d[0].length) || h), i.push(e = [])), c = !1, (d = jb.exec(h)) && (c = d.shift(), e.push({value:c, type:d[0].replace(gb, " ")}), h = h.slice(c.length));
                    for (f in y.filter)!(d = mb[f].exec(h)) || j[f] && !(d = j[f](d)) || (c = d.shift(), e.push({value:c, type:f, matches:d}), h = h.slice(c.length));
                    if (!c)break
                }
                return b ? h.length : h ? g.error(a) : T(a, i).slice(0)
            }

            function m(a) {
                for (var b = 0, c = a.length, d = ""; c > b; b++)d += a[b].value;
                return d
            }

            function n(a, b, c) {
                var d = b.dir, e = c && "parentNode" === d, f = R++;
                return b.first ? function (b, c, f) {
                    for (; b = b[d];)if (1 === b.nodeType || e)return a(b, c, f)
                } : function (b, c, g) {
                    var h, i, j, k = Q + " " + f;
                    if (g) {
                        for (; b = b[d];)if ((1 === b.nodeType || e) && a(b, c, g))return!0
                    } else for (; b = b[d];)if (1 === b.nodeType || e)if (j = b[N] || (b[N] = {}), (i = j[d]) && i[0] === k) {
                        if ((h = i[1]) === !0 || h === x)return h === !0
                    } else if (i = j[d] = [k], i[1] = a(b, c, g) || x, i[1] === !0)return!0
                }
            }

            function o(a) {
                return a.length > 1 ? function (b, c, d) {
                    for (var e = a.length; e--;)if (!a[e](b, c, d))return!1;
                    return!0
                } : a[0]
            }

            function p(a, b, c, d, e) {
                for (var f, g = [], h = 0, i = a.length, j = null != b; i > h; h++)(f = a[h]) && (!c || c(f, d, e)) && (g.push(f), j && b.push(h));
                return g
            }

            function q(a, b, c, d, f, g) {
                return d && !d[N] && (d = q(d)), f && !f[N] && (f = q(f, g)), e(function (e, g, h, i) {
                    var j, k, l, m = [], n = [], o = g.length, q = e || t(b || "*", h.nodeType ? [h] : h, []), r = !a || !e && b ? q : p(q, m, a, h, i), s = c ? f || (e ? a : o || d) ? [] : g : r;
                    if (c && c(r, s, h, i), d)for (j = p(s, n), d(j, [], h, i), k = j.length; k--;)(l = j[k]) && (s[n[k]] = !(r[n[k]] = l));
                    if (e) {
                        if (f || a) {
                            if (f) {
                                for (j = [], k = s.length; k--;)(l = s[k]) && j.push(r[k] = l);
                                f(null, s = [], j, i)
                            }
                            for (k = s.length; k--;)(l = s[k]) && (j = f ? _.call(e, l) : m[k]) > -1 && (e[j] = !(g[j] = l))
                        }
                    } else s = p(s === g ? s.splice(o, s.length) : s), f ? f(null, g, s, i) : Z.apply(g, s)
                })
            }

            function r(a) {
                for (var b, c, d, e = a.length, f = y.relative[a[0].type], g = f || y.relative[" "], h = f ? 1 : 0, i = n(function (a) {
                    return a === b
                }, g, !0), j = n(function (a) {
                    return _.call(b, a) > -1
                }, g, !0), k = [function (a, c, d) {
                    return!f && (d || c !== D) || ((b = c).nodeType ? i(a, c, d) : j(a, c, d))
                }]; e > h; h++)if (c = y.relative[a[h].type])k = [n(o(k), c)]; else {
                    if (c = y.filter[a[h].type].apply(null, a[h].matches), c[N]) {
                        for (d = ++h; e > d && !y.relative[a[d].type]; d++);
                        return q(h > 1 && o(k), h > 1 && m(a.slice(0, h - 1)).replace(gb, "$1"), c, d > h && r(a.slice(h, d)), e > d && r(a = a.slice(d)), e > d && m(a))
                    }
                    k.push(c)
                }
                return o(k)
            }

            function s(a, b) {
                var c = 0, d = b.length > 0, f = a.length > 0, h = function (e, h, i, j, k) {
                    var l, m, n, o = [], q = 0, r = "0", s = e && [], t = null != k, u = D, v = e || f && y.find.TAG("*", k && h.parentNode || h), w = Q += null == u ? 1 : Math.random() || .1;
                    for (t && (D = h !== F && h, x = c); null != (l = v[r]); r++) {
                        if (f && l) {
                            for (m = 0; n = a[m++];)if (n(l, h, i)) {
                                j.push(l);
                                break
                            }
                            t && (Q = w, x = ++c)
                        }
                        d && ((l = !n && l) && q--, e && s.push(l))
                    }
                    if (q += r, d && r !== q) {
                        for (m = 0; n = b[m++];)n(s, o, h, i);
                        if (e) {
                            if (q > 0)for (; r--;)s[r] || o[r] || (o[r] = Y.call(j));
                            o = p(o)
                        }
                        Z.apply(j, o), t && !e && o.length > 0 && q + b.length > 1 && g.uniqueSort(j)
                    }
                    return t && (Q = w, D = u), s
                };
                return d ? e(h) : h
            }

            function t(a, b, c) {
                for (var d = 0, e = b.length; e > d; d++)g(a, b[d], c);
                return c
            }

            function u(a, b, c, d) {
                var e, f, g, h, i, j = l(a);
                if (!d && 1 === j.length) {
                    if (f = j[0] = j[0].slice(0), f.length > 2 && "ID" === (g = f[0]).type && 9 === b.nodeType && !H && y.relative[f[1].type]) {
                        if (b = y.find.ID(g.matches[0].replace(ub, vb), b)[0], !b)return c;
                        a = a.slice(f.shift().value.length)
                    }
                    for (e = mb.needsContext.test(a) ? 0 : f.length; e-- && (g = f[e], !y.relative[h = g.type]);)if ((i = y.find[h]) && (d = i(g.matches[0].replace(ub, vb), nb.test(f[0].type) && b.parentNode || b))) {
                        if (f.splice(e, 1), a = d.length && m(f), !a)return Z.apply(c, $.call(d, 0)), c;
                        break
                    }
                }
                return B(a, j)(d, b, H, c, nb.test(a)), c
            }

            function v() {
            }

            var w, x, y, z, A, B, C, D, E, F, G, H, I, J, K, L, M, N = "sizzle" + -new Date, O = a.document, P = {}, Q = 0, R = 0, S = d(), T = d(), U = d(), V = typeof b, W = 1 << 31, X = [], Y = X.pop, Z = X.push, $ = X.slice, _ = X.indexOf || function (a) {
                for (var b = 0, c = this.length; c > b; b++)if (this[b] === a)return b;
                return-1
            }, ab = "[\\x20\\t\\r\\n\\f]", bb = "(?:\\\\.|[\\w-]|[^\\x00-\\xa0])+", cb = bb.replace("w", "w#"), db = "([*^$|!~]?=)", eb = "\\[" + ab + "*(" + bb + ")" + ab + "*(?:" + db + ab + "*(?:(['\"])((?:\\\\.|[^\\\\])*?)\\3|(" + cb + ")|)|)" + ab + "*\\]", fb = ":(" + bb + ")(?:\\(((['\"])((?:\\\\.|[^\\\\])*?)\\3|((?:\\\\.|[^\\\\()[\\]]|" + eb.replace(3, 8) + ")*)|.*)\\)|)", gb = new RegExp("^" + ab + "+|((?:^|[^\\\\])(?:\\\\.)*)" + ab + "+$", "g"), hb = new RegExp("^" + ab + "*," + ab + "*"), jb = new RegExp("^" + ab + "*([\\x20\\t\\r\\n\\f>+~])" + ab + "*"), kb = new RegExp(fb), lb = new RegExp("^" + cb + "$"), mb = {ID:new RegExp("^#(" + bb + ")"), CLASS:new RegExp("^\\.(" + bb + ")"), NAME:new RegExp("^\\[name=['\"]?(" + bb + ")['\"]?\\]"), TAG:new RegExp("^(" + bb.replace("w", "w*") + ")"), ATTR:new RegExp("^" + eb), PSEUDO:new RegExp("^" + fb), CHILD:new RegExp("^:(only|first|last|nth|nth-last)-(child|of-type)(?:\\(" + ab + "*(even|odd|(([+-]|)(\\d*)n|)" + ab + "*(?:([+-]|)" + ab + "*(\\d+)|))" + ab + "*\\)|)", "i"), needsContext:new RegExp("^" + ab + "*[>+~]|:(even|odd|eq|gt|lt|nth|first|last)(?:\\(" + ab + "*((?:-\\d)?\\d*)" + ab + "*\\)|)(?=[^-]|$)", "i")}, nb = /[\x20\t\r\n\f]*[+~]/, ob = /^[^{]+\{\s*\[native code/, pb = /^(?:#([\w-]+)|(\w+)|\.([\w-]+))$/, qb = /^(?:input|select|textarea|button)$/i, rb = /^h\d$/i, sb = /'|\\/g, tb = /\=[\x20\t\r\n\f]*([^'"\]]*)[\x20\t\r\n\f]*\]/g, ub = /\\([\da-fA-F]{1,6}[\x20\t\r\n\f]?|.)/g, vb = function (a, b) {
                var c = "0x" + b - 65536;
                return c !== c ? b : 0 > c ? String.fromCharCode(c + 65536) : String.fromCharCode(c >> 10 | 55296, 1023 & c | 56320)
            };
            try {
                $.call(O.documentElement.childNodes, 0)[0].nodeType
            } catch (wb) {
                $ = function (a) {
                    for (var b, c = []; b = this[a++];)c.push(b);
                    return c
                }
            }
            A = g.isXML = function (a) {
                var b = a && (a.ownerDocument || a).documentElement;
                return b ? "HTML" !== b.nodeName : !1
            }, E = g.setDocument = function (a) {
                var d = a ? a.ownerDocument || a : O;
                return d !== F && 9 === d.nodeType && d.documentElement ? (F = d, G = d.documentElement, H = A(d), P.tagNameNoComments = f(function (a) {
                    return a.appendChild(d.createComment("")), !a.getElementsByTagName("*").length
                }), P.attributes = f(function (a) {
                    a.innerHTML = "<select></select>";
                    var b = typeof a.lastChild.getAttribute("multiple");
                    return"boolean" !== b && "string" !== b
                }), P.getByClassName = f(function (a) {
                    return a.innerHTML = "<div class='hidden e'></div><div class='hidden'></div>", a.getElementsByClassName && a.getElementsByClassName("e").length ? (a.lastChild.className = "e", 2 === a.getElementsByClassName("e").length) : !1
                }), P.getByName = f(function (a) {
                    a.id = N + 0, a.innerHTML = "<a name='" + N + "'></a><div name='" + N + "'></div>", G.insertBefore(a, G.firstChild);
                    var b = d.getElementsByName && d.getElementsByName(N).length === 2 + d.getElementsByName(N + 0).length;
                    return P.getIdNotName = !d.getElementById(N), G.removeChild(a), b
                }), y.attrHandle = f(function (a) {
                    return a.innerHTML = "<a href='#'></a>", a.firstChild && typeof a.firstChild.getAttribute !== V && "#" === a.firstChild.getAttribute("href")
                }) ? {} : {href:function (a) {
                    return a.getAttribute("href", 2)
                }, type:function (a) {
                    return a.getAttribute("type")
                }}, P.getIdNotName ? (y.find.ID = function (a, b) {
                    if (typeof b.getElementById !== V && !H) {
                        var c = b.getElementById(a);
                        return c && c.parentNode ? [c] : []
                    }
                }, y.filter.ID = function (a) {
                    var b = a.replace(ub, vb);
                    return function (a) {
                        return a.getAttribute("id") === b
                    }
                }) : (y.find.ID = function (a, c) {
                    if (typeof c.getElementById !== V && !H) {
                        var d = c.getElementById(a);
                        return d ? d.id === a || typeof d.getAttributeNode !== V && d.getAttributeNode("id").value === a ? [d] : b : []
                    }
                }, y.filter.ID = function (a) {
                    var b = a.replace(ub, vb);
                    return function (a) {
                        var c = typeof a.getAttributeNode !== V && a.getAttributeNode("id");
                        return c && c.value === b
                    }
                }), y.find.TAG = P.tagNameNoComments ? function (a, b) {
                    return typeof b.getElementsByTagName !== V ? b.getElementsByTagName(a) : void 0
                } : function (a, b) {
                    var c, d = [], e = 0, f = b.getElementsByTagName(a);
                    if ("*" === a) {
                        for (; c = f[e++];)1 === c.nodeType && d.push(c);
                        return d
                    }
                    return f
                }, y.find.NAME = P.getByName && function (a, b) {
                    return typeof b.getElementsByName !== V ? b.getElementsByName(name) : void 0
                }, y.find.CLASS = P.getByClassName && function (a, b) {
                    return typeof b.getElementsByClassName === V || H ? void 0 : b.getElementsByClassName(a)
                }, J = [], I = [":focus"], (P.qsa = c(d.querySelectorAll)) && (f(function (a) {
                    a.innerHTML = "<select><option selected=''></option></select>", a.querySelectorAll("[selected]").length || I.push("\\[" + ab + "*(?:checked|disabled|ismap|multiple|readonly|selected|value)"), a.querySelectorAll(":checked").length || I.push(":checked")
                }), f(function (a) {
                    a.innerHTML = "<input type='hidden' i=''/>", a.querySelectorAll("[i^='']").length && I.push("[*^$]=" + ab + "*(?:\"\"|'')"), a.querySelectorAll(":enabled").length || I.push(":enabled", ":disabled"), a.querySelectorAll("*,:x"), I.push(",.*:")
                })), (P.matchesSelector = c(K = G.matchesSelector || G.mozMatchesSelector || G.webkitMatchesSelector || G.oMatchesSelector || G.msMatchesSelector)) && f(function (a) {
                    P.disconnectedMatch = K.call(a, "div"), K.call(a, "[s!='']:x"), J.push("!=", fb)
                }), I = new RegExp(I.join("|")), J = new RegExp(J.join("|")), L = c(G.contains) || G.compareDocumentPosition ? function (a, b) {
                    var c = 9 === a.nodeType ? a.documentElement : a, d = b && b.parentNode;
                    return a === d || !(!d || 1 !== d.nodeType || !(c.contains ? c.contains(d) : a.compareDocumentPosition && 16 & a.compareDocumentPosition(d)))
                } : function (a, b) {
                    if (b)for (; b = b.parentNode;)if (b === a)return!0;
                    return!1
                }, M = G.compareDocumentPosition ? function (a, b) {
                    var c;
                    return a === b ? (C = !0, 0) : (c = b.compareDocumentPosition && a.compareDocumentPosition && a.compareDocumentPosition(b)) ? 1 & c || a.parentNode && 11 === a.parentNode.nodeType ? a === d || L(O, a) ? -1 : b === d || L(O, b) ? 1 : 0 : 4 & c ? -1 : 1 : a.compareDocumentPosition ? -1 : 1
                } : function (a, b) {
                    var c, e = 0, f = a.parentNode, g = b.parentNode, i = [a], j = [b];
                    if (a === b)return C = !0, 0;
                    if (!f || !g)return a === d ? -1 : b === d ? 1 : f ? -1 : g ? 1 : 0;
                    if (f === g)return h(a, b);
                    for (c = a; c = c.parentNode;)i.unshift(c);
                    for (c = b; c = c.parentNode;)j.unshift(c);
                    for (; i[e] === j[e];)e++;
                    return e ? h(i[e], j[e]) : i[e] === O ? -1 : j[e] === O ? 1 : 0
                }, C = !1, [0, 0].sort(M), P.detectDuplicates = C, F) : F
            }, g.matches = function (a, b) {
                return g(a, null, null, b)
            }, g.matchesSelector = function (a, b) {
                if ((a.ownerDocument || a) !== F && E(a), b = b.replace(tb, "='$1']"), !(!P.matchesSelector || H || J && J.test(b) || I.test(b)))try {
                    var c = K.call(a, b);
                    if (c || P.disconnectedMatch || a.document && 11 !== a.document.nodeType)return c
                } catch (d) {
                }
                return g(b, F, null, [a]).length > 0
            }, g.contains = function (a, b) {
                return(a.ownerDocument || a) !== F && E(a), L(a, b)
            }, g.attr = function (a, b) {
                var c;
                return(a.ownerDocument || a) !== F && E(a), H || (b = b.toLowerCase()), (c = y.attrHandle[b]) ? c(a) : H || P.attributes ? a.getAttribute(b) : ((c = a.getAttributeNode(b)) || a.getAttribute(b)) && a[b] === !0 ? b : c && c.specified ? c.value : null
            }, g.error = function (a) {
                throw new Error("Syntax error, unrecognized expression: " + a)
            }, g.uniqueSort = function (a) {
                var b, c = [], d = 1, e = 0;
                if (C = !P.detectDuplicates, a.sort(M), C) {
                    for (; b = a[d]; d++)b === a[d - 1] && (e = c.push(d));
                    for (; e--;)a.splice(c[e], 1)
                }
                return a
            }, z = g.getText = function (a) {
                var b, c = "", d = 0, e = a.nodeType;
                if (e) {
                    if (1 === e || 9 === e || 11 === e) {
                        if ("string" == typeof a.textContent)return a.textContent;
                        for (a = a.firstChild; a; a = a.nextSibling)c += z(a)
                    } else if (3 === e || 4 === e)return a.nodeValue
                } else for (; b = a[d]; d++)c += z(b);
                return c
            }, y = g.selectors = {cacheLength:50, createPseudo:e, match:mb, find:{}, relative:{">":{dir:"parentNode", first:!0}, " ":{dir:"parentNode"}, "+":{dir:"previousSibling", first:!0}, "~":{dir:"previousSibling"}}, preFilter:{ATTR:function (a) {
                return a[1] = a[1].replace(ub, vb), a[3] = (a[4] || a[5] || "").replace(ub, vb), "~=" === a[2] && (a[3] = " " + a[3] + " "), a.slice(0, 4)
            }, CHILD:function (a) {
                return a[1] = a[1].toLowerCase(), "nth" === a[1].slice(0, 3) ? (a[3] || g.error(a[0]), a[4] = +(a[4] ? a[5] + (a[6] || 1) : 2 * ("even" === a[3] || "odd" === a[3])), a[5] = +(a[7] + a[8] || "odd" === a[3])) : a[3] && g.error(a[0]), a
            }, PSEUDO:function (a) {
                var b, c = !a[5] && a[2];
                return mb.CHILD.test(a[0]) ? null : (a[4] ? a[2] = a[4] : c && kb.test(c) && (b = l(c, !0)) && (b = c.indexOf(")", c.length - b) - c.length) && (a[0] = a[0].slice(0, b), a[2] = c.slice(0, b)), a.slice(0, 3))
            }}, filter:{TAG:function (a) {
                return"*" === a ? function () {
                    return!0
                } : (a = a.replace(ub, vb).toLowerCase(), function (b) {
                    return b.nodeName && b.nodeName.toLowerCase() === a
                })
            }, CLASS:function (a) {
                var b = S[a + " "];
                return b || (b = new RegExp("(^|" + ab + ")" + a + "(" + ab + "|$)")) && S(a, function (a) {
                    return b.test(a.className || typeof a.getAttribute !== V && a.getAttribute("class") || "")
                })
            }, ATTR:function (a, b, c) {
                return function (d) {
                    var e = g.attr(d, a);
                    return null == e ? "!=" === b : b ? (e += "", "=" === b ? e === c : "!=" === b ? e !== c : "^=" === b ? c && 0 === e.indexOf(c) : "*=" === b ? c && e.indexOf(c) > -1 : "$=" === b ? c && e.slice(-c.length) === c : "~=" === b ? (" " + e + " ").indexOf(c) > -1 : "|=" === b ? e === c || e.slice(0, c.length + 1) === c + "-" : !1) : !0
                }
            }, CHILD:function (a, b, c, d, e) {
                var f = "nth" !== a.slice(0, 3), g = "last" !== a.slice(-4), h = "of-type" === b;
                return 1 === d && 0 === e ? function (a) {
                    return!!a.parentNode
                } : function (b, c, i) {
                    var j, k, l, m, n, o, p = f !== g ? "nextSibling" : "previousSibling", q = b.parentNode, r = h && b.nodeName.toLowerCase(), s = !i && !h;
                    if (q) {
                        if (f) {
                            for (; p;) {
                                for (l = b; l = l[p];)if (h ? l.nodeName.toLowerCase() === r : 1 === l.nodeType)return!1;
                                o = p = "only" === a && !o && "nextSibling"
                            }
                            return!0
                        }
                        if (o = [g ? q.firstChild : q.lastChild], g && s) {
                            for (k = q[N] || (q[N] = {}), j = k[a] || [], n = j[0] === Q && j[1], m = j[0] === Q && j[2], l = n && q.childNodes[n]; l = ++n && l && l[p] || (m = n = 0) || o.pop();)if (1 === l.nodeType && ++m && l === b) {
                                k[a] = [Q, n, m];
                                break
                            }
                        } else if (s && (j = (b[N] || (b[N] = {}))[a]) && j[0] === Q)m = j[1]; else for (; (l = ++n && l && l[p] || (m = n = 0) || o.pop()) && ((h ? l.nodeName.toLowerCase() !== r : 1 !== l.nodeType) || !++m || (s && ((l[N] || (l[N] = {}))[a] = [Q, m]), l !== b)););
                        return m -= e, m === d || m % d === 0 && m / d >= 0
                    }
                }
            }, PSEUDO:function (a, b) {
                var c, d = y.pseudos[a] || y.setFilters[a.toLowerCase()] || g.error("unsupported pseudo: " + a);
                return d[N] ? d(b) : d.length > 1 ? (c = [a, a, "", b], y.setFilters.hasOwnProperty(a.toLowerCase()) ? e(function (a, c) {
                    for (var e, f = d(a, b), g = f.length; g--;)e = _.call(a, f[g]), a[e] = !(c[e] = f[g])
                }) : function (a) {
                    return d(a, 0, c)
                }) : d
            }}, pseudos:{not:e(function (a) {
                var b = [], c = [], d = B(a.replace(gb, "$1"));
                return d[N] ? e(function (a, b, c, e) {
                    for (var f, g = d(a, null, e, []), h = a.length; h--;)(f = g[h]) && (a[h] = !(b[h] = f))
                }) : function (a, e, f) {
                    return b[0] = a, d(b, null, f, c), !c.pop()
                }
            }), has:e(function (a) {
                return function (b) {
                    return g(a, b).length > 0
                }
            }), contains:e(function (a) {
                return function (b) {
                    return(b.textContent || b.innerText || z(b)).indexOf(a) > -1
                }
            }), lang:e(function (a) {
                return lb.test(a || "") || g.error("unsupported lang: " + a), a = a.replace(ub, vb).toLowerCase(), function (b) {
                    var c;
                    do if (c = H ? b.getAttribute("xml:lang") || b.getAttribute("lang") : b.lang)return c = c.toLowerCase(), c === a || 0 === c.indexOf(a + "-"); while ((b = b.parentNode) && 1 === b.nodeType);
                    return!1
                }
            }), target:function (b) {
                var c = a.location && a.location.hash;
                return c && c.slice(1) === b.id
            }, root:function (a) {
                return a === G
            }, focus:function (a) {
                return a === F.activeElement && (!F.hasFocus || F.hasFocus()) && !!(a.type || a.href || ~a.tabIndex)
            }, enabled:function (a) {
                return a.disabled === !1
            }, disabled:function (a) {
                return a.disabled === !0
            }, checked:function (a) {
                var b = a.nodeName.toLowerCase();
                return"input" === b && !!a.checked || "option" === b && !!a.selected
            }, selected:function (a) {
                return a.parentNode && a.parentNode.selectedIndex, a.selected === !0
            }, empty:function (a) {
                for (a = a.firstChild; a; a = a.nextSibling)if (a.nodeName > "@" || 3 === a.nodeType || 4 === a.nodeType)return!1;
                return!0
            }, parent:function (a) {
                return!y.pseudos.empty(a)
            }, header:function (a) {
                return rb.test(a.nodeName)
            }, input:function (a) {
                return qb.test(a.nodeName)
            }, button:function (a) {
                var b = a.nodeName.toLowerCase();
                return"input" === b && "button" === a.type || "button" === b
            }, text:function (a) {
                var b;
                return"input" === a.nodeName.toLowerCase() && "text" === a.type && (null == (b = a.getAttribute("type")) || b.toLowerCase() === a.type)
            }, first:k(function () {
                return[0]
            }), last:k(function (a, b) {
                return[b - 1]
            }), eq:k(function (a, b, c) {
                return[0 > c ? c + b : c]
            }), even:k(function (a, b) {
                for (var c = 0; b > c; c += 2)a.push(c);
                return a
            }), odd:k(function (a, b) {
                for (var c = 1; b > c; c += 2)a.push(c);
                return a
            }), lt:k(function (a, b, c) {
                for (var d = 0 > c ? c + b : c; --d >= 0;)a.push(d);
                return a
            }), gt:k(function (a, b, c) {
                for (var d = 0 > c ? c + b : c; ++d < b;)a.push(d);
                return a
            })}};
            for (w in{radio:!0, checkbox:!0, file:!0, password:!0, image:!0})y.pseudos[w] = i(w);
            for (w in{submit:!0, reset:!0})y.pseudos[w] = j(w);
            B = g.compile = function (a, b) {
                var c, d = [], e = [], f = U[a + " "];
                if (!f) {
                    for (b || (b = l(a)), c = b.length; c--;)f = r(b[c]), f[N] ? d.push(f) : e.push(f);
                    f = U(a, s(e, d))
                }
                return f
            }, y.pseudos.nth = y.pseudos.eq, y.filters = v.prototype = y.pseudos, y.setFilters = new v, E(), g.attr = ib.attr, ib.find = g, ib.expr = g.selectors, ib.expr[":"] = ib.expr.pseudos, ib.unique = g.uniqueSort, ib.text = g.getText, ib.isXMLDoc = g.isXML, ib.contains = g.contains
        }(a);
        var Pb = /Until$/, Qb = /^(?:parents|prev(?:Until|All))/, Rb = /^.[^:#\[\.,]*$/, Sb = ib.expr.match.needsContext, Tb = {children:!0, contents:!0, next:!0, prev:!0};
        ib.fn.extend({find:function (a) {
            var b, c, d, e = this.length;
            if ("string" != typeof a)return d = this, this.pushStack(ib(a).filter(function () {
                for (b = 0; e > b; b++)if (ib.contains(d[b], this))return!0
            }));
            for (c = [], b = 0; e > b; b++)ib.find(a, this[b], c);
            return c = this.pushStack(e > 1 ? ib.unique(c) : c), c.selector = (this.selector ? this.selector + " " : "") + a, c
        }, has:function (a) {
            var b, c = ib(a, this), d = c.length;
            return this.filter(function () {
                for (b = 0; d > b; b++)if (ib.contains(this, c[b]))return!0
            })
        }, not:function (a) {
            return this.pushStack(l(this, a, !1))
        }, filter:function (a) {
            return this.pushStack(l(this, a, !0))
        }, is:function (a) {
            return!!a && ("string" == typeof a ? Sb.test(a) ? ib(a, this.context).index(this[0]) >= 0 : ib.filter(a, this).length > 0 : this.filter(a).length > 0)
        }, closest:function (a, b) {
            for (var c, d = 0, e = this.length, f = [], g = Sb.test(a) || "string" != typeof a ? ib(a, b || this.context) : 0; e > d; d++)for (c = this[d]; c && c.ownerDocument && c !== b && 11 !== c.nodeType;) {
                if (g ? g.index(c) > -1 : ib.find.matchesSelector(c, a)) {
                    f.push(c);
                    break
                }
                c = c.parentNode
            }
            return this.pushStack(f.length > 1 ? ib.unique(f) : f)
        }, index:function (a) {
            return a ? "string" == typeof a ? ib.inArray(this[0], ib(a)) : ib.inArray(a.jquery ? a[0] : a, this) : this[0] && this[0].parentNode ? this.first().prevAll().length : -1
        }, add:function (a, b) {
            var c = "string" == typeof a ? ib(a, b) : ib.makeArray(a && a.nodeType ? [a] : a), d = ib.merge(this.get(), c);
            return this.pushStack(ib.unique(d))
        }, addBack:function (a) {
            return this.add(null == a ? this.prevObject : this.prevObject.filter(a))
        }}), ib.fn.andSelf = ib.fn.addBack, ib.each({parent:function (a) {
            var b = a.parentNode;
            return b && 11 !== b.nodeType ? b : null
        }, parents:function (a) {
            return ib.dir(a, "parentNode")
        }, parentsUntil:function (a, b, c) {
            return ib.dir(a, "parentNode", c)
        }, next:function (a) {
            return k(a, "nextSibling")
        }, prev:function (a) {
            return k(a, "previousSibling")
        }, nextAll:function (a) {
            return ib.dir(a, "nextSibling")
        }, prevAll:function (a) {
            return ib.dir(a, "previousSibling")
        }, nextUntil:function (a, b, c) {
            return ib.dir(a, "nextSibling", c)
        }, prevUntil:function (a, b, c) {
            return ib.dir(a, "previousSibling", c)
        }, siblings:function (a) {
            return ib.sibling((a.parentNode || {}).firstChild, a)
        }, children:function (a) {
            return ib.sibling(a.firstChild)
        }, contents:function (a) {
            return ib.nodeName(a, "iframe") ? a.contentDocument || a.contentWindow.document : ib.merge([], a.childNodes)
        }}, function (a, b) {
            ib.fn[a] = function (c, d) {
                var e = ib.map(this, b, c);
                return Pb.test(a) || (d = c), d && "string" == typeof d && (e = ib.filter(d, e)), e = this.length > 1 && !Tb[a] ? ib.unique(e) : e, this.length > 1 && Qb.test(a) && (e = e.reverse()), this.pushStack(e)
            }
        }), ib.extend({filter:function (a, b, c) {
            return c && (a = ":not(" + a + ")"), 1 === b.length ? ib.find.matchesSelector(b[0], a) ? [b[0]] : [] : ib.find.matches(a, b)
        }, dir:function (a, c, d) {
            for (var e = [], f = a[c]; f && 9 !== f.nodeType && (d === b || 1 !== f.nodeType || !ib(f).is(d));)1 === f.nodeType && e.push(f), f = f[c];
            return e
        }, sibling:function (a, b) {
            for (var c = []; a; a = a.nextSibling)1 === a.nodeType && a !== b && c.push(a);
            return c
        }});
        var Ub = "abbr|article|aside|audio|bdi|canvas|data|datalist|details|figcaption|figure|footer|header|hgroup|mark|meter|nav|output|progress|section|summary|time|video", Vb = / jQuery\d+="(?:null|\d+)"/g, Wb = new RegExp("<(?:" + Ub + ")[\\s/>]", "i"), Xb = /^\s+/, Yb = /<(?!area|br|col|embed|hr|img|input|link|meta|param)(([\w:]+)[^>]*)\/>/gi, Zb = /<([\w:]+)/, $b = /<tbody/i, _b = /<|&#?\w+;/, ac = /<(?:script|style|link)/i, bc = /^(?:checkbox|radio)$/i, cc = /checked\s*(?:[^=]|=\s*.checked.)/i, dc = /^$|\/(?:java|ecma)script/i, ec = /^true\/(.*)/, fc = /^\s*<!(?:\[CDATA\[|--)|(?:\]\]|--)>\s*$/g, gc = {option:[1, "<select multiple='multiple'>", "</select>"], legend:[1, "<fieldset>", "</fieldset>"], area:[1, "<map>", "</map>"], param:[1, "<object>", "</object>"], thead:[1, "<table>", "</table>"], tr:[2, "<table><tbody>", "</tbody></table>"], col:[2, "<table><tbody></tbody><colgroup>", "</colgroup></table>"], td:[3, "<table><tbody><tr>", "</tr></tbody></table>"], _default:ib.support.htmlSerialize ? [0, "", ""] : [1, "X<div>", "</div>"]}, hc = m(W), ic = hc.appendChild(W.createElement("div"));
        gc.optgroup = gc.option, gc.tbody = gc.tfoot = gc.colgroup = gc.caption = gc.thead, gc.th = gc.td, ib.fn.extend({text:function (a) {
            return ib.access(this, function (a) {
                return a === b ? ib.text(this) : this.empty().append((this[0] && this[0].ownerDocument || W).createTextNode(a))
            }, null, a, arguments.length)
        }, wrapAll:function (a) {
            if (ib.isFunction(a))return this.each(function (b) {
                ib(this).wrapAll(a.call(this, b))
            });
            if (this[0]) {
                var b = ib(a, this[0].ownerDocument).eq(0).clone(!0);
                this[0].parentNode && b.insertBefore(this[0]), b.map(function () {
                    for (var a = this; a.firstChild && 1 === a.firstChild.nodeType;)a = a.firstChild;
                    return a
                }).append(this)
            }
            return this
        }, wrapInner:function (a) {
            return this.each(ib.isFunction(a) ? function (b) {
                ib(this).wrapInner(a.call(this, b))
            } : function () {
                var b = ib(this), c = b.contents();
                c.length ? c.wrapAll(a) : b.append(a)
            })
        }, wrap:function (a) {
            var b = ib.isFunction(a);
            return this.each(function (c) {
                ib(this).wrapAll(b ? a.call(this, c) : a)
            })
        }, unwrap:function () {
            return this.parent().each(function () {
                ib.nodeName(this, "body") || ib(this).replaceWith(this.childNodes)
            }).end()
        }, append:function () {
            return this.domManip(arguments, !0, function (a) {
                (1 === this.nodeType || 11 === this.nodeType || 9 === this.nodeType) && this.appendChild(a)
            })
        }, prepend:function () {
            return this.domManip(arguments, !0, function (a) {
                (1 === this.nodeType || 11 === this.nodeType || 9 === this.nodeType) && this.insertBefore(a, this.firstChild)
            })
        }, before:function () {
            return this.domManip(arguments, !1, function (a) {
                this.parentNode && this.parentNode.insertBefore(a, this)
            })
        }, after:function () {
            return this.domManip(arguments, !1, function (a) {
                this.parentNode && this.parentNode.insertBefore(a, this.nextSibling)
            })
        }, remove:function (a, b) {
            for (var c, d = 0; null != (c = this[d]); d++)(!a || ib.filter(a, [c]).length > 0) && (b || 1 !== c.nodeType || ib.cleanData(t(c)), c.parentNode && (b && ib.contains(c.ownerDocument, c) && q(t(c, "script")), c.parentNode.removeChild(c)));
            return this
        }, empty:function () {
            for (var a, b = 0; null != (a = this[b]); b++) {
                for (1 === a.nodeType && ib.cleanData(t(a, !1)); a.firstChild;)a.removeChild(a.firstChild);
                a.options && ib.nodeName(a, "select") && (a.options.length = 0)
            }
            return this
        }, clone:function (a, b) {
            return a = null == a ? !1 : a, b = null == b ? a : b, this.map(function () {
                return ib.clone(this, a, b)
            })
        }, html:function (a) {
            return ib.access(this, function (a) {
                var c = this[0] || {}, d = 0, e = this.length;
                if (a === b)return 1 === c.nodeType ? c.innerHTML.replace(Vb, "") : b;
                if (!("string" != typeof a || ac.test(a) || !ib.support.htmlSerialize && Wb.test(a) || !ib.support.leadingWhitespace && Xb.test(a) || gc[(Zb.exec(a) || ["", ""])[1].toLowerCase()])) {
                    a = a.replace(Yb, "<$1></$2>");
                    try {
                        for (; e > d; d++)c = this[d] || {}, 1 === c.nodeType && (ib.cleanData(t(c, !1)), c.innerHTML = a);
                        c = 0
                    } catch (f) {
                    }
                }
                c && this.empty().append(a)
            }, null, a, arguments.length)
        }, replaceWith:function (a) {
            var b = ib.isFunction(a);
            return b || "string" == typeof a || (a = ib(a).not(this).detach()), this.domManip([a], !0, function (a) {
                var b = this.nextSibling, c = this.parentNode;
                c && (ib(this).remove(), c.insertBefore(a, b))
            })
        }, detach:function (a) {
            return this.remove(a, !0)
        }, domManip:function (a, c, d) {
            a = bb.apply([], a);
            var e, f, g, h, i, j, k = 0, l = this.length, m = this, q = l - 1, r = a[0], s = ib.isFunction(r);
            if (s || !(1 >= l || "string" != typeof r || ib.support.checkClone) && cc.test(r))return this.each(function (e) {
                var f = m.eq(e);
                s && (a[0] = r.call(this, e, c ? f.html() : b)), f.domManip(a, c, d)
            });
            if (l && (j = ib.buildFragment(a, this[0].ownerDocument, !1, this), e = j.firstChild, 1 === j.childNodes.length && (j = e), e)) {
                for (c = c && ib.nodeName(e, "tr"), h = ib.map(t(j, "script"), o), g = h.length; l > k; k++)f = j, k !== q && (f = ib.clone(f, !0, !0), g && ib.merge(h, t(f, "script"))), d.call(c && ib.nodeName(this[k], "table") ? n(this[k], "tbody") : this[k], f, k);
                if (g)for (i = h[h.length - 1].ownerDocument, ib.map(h, p), k = 0; g > k; k++)f = h[k], dc.test(f.type || "") && !ib._data(f, "globalEval") && ib.contains(i, f) && (f.src ? ib.ajax({url:f.src, type:"GET", dataType:"script", async:!1, global:!1, "throws":!0}) : ib.globalEval((f.text || f.textContent || f.innerHTML || "").replace(fc, "")));
                j = e = null
            }
            return this
        }}), ib.each({appendTo:"append", prependTo:"prepend", insertBefore:"before", insertAfter:"after", replaceAll:"replaceWith"}, function (a, b) {
            ib.fn[a] = function (a) {
                for (var c, d = 0, e = [], f = ib(a), g = f.length - 1; g >= d; d++)c = d === g ? this : this.clone(!0), ib(f[d])[b](c), cb.apply(e, c.get());
                return this.pushStack(e)
            }
        }), ib.extend({clone:function (a, b, c) {
            var d, e, f, g, h, i = ib.contains(a.ownerDocument, a);
            if (ib.support.html5Clone || ib.isXMLDoc(a) || !Wb.test("<" + a.nodeName + ">") ? f = a.cloneNode(!0) : (ic.innerHTML = a.outerHTML, ic.removeChild(f = ic.firstChild)), !(ib.support.noCloneEvent && ib.support.noCloneChecked || 1 !== a.nodeType && 11 !== a.nodeType || ib.isXMLDoc(a)))for (d = t(f), h = t(a), g = 0; null != (e = h[g]); ++g)d[g] && s(e, d[g]);
            if (b)if (c)for (h = h || t(a), d = d || t(f), g = 0; null != (e = h[g]); g++)r(e, d[g]); else r(a, f);
            return d = t(f, "script"), d.length > 0 && q(d, !i && t(a, "script")), d = h = e = null, f
        }, buildFragment:function (a, b, c, d) {
            for (var e, f, g, h, i, j, k, l = a.length, n = m(b), o = [], p = 0; l > p; p++)if (f = a[p], f || 0 === f)if ("object" === ib.type(f))ib.merge(o, f.nodeType ? [f] : f); else if (_b.test(f)) {
                for (h = h || n.appendChild(b.createElement("div")), i = (Zb.exec(f) || ["", ""])[1].toLowerCase(), k = gc[i] || gc._default, h.innerHTML = k[1] + f.replace(Yb, "<$1></$2>") + k[2], e = k[0]; e--;)h = h.lastChild;
                if (!ib.support.leadingWhitespace && Xb.test(f) && o.push(b.createTextNode(Xb.exec(f)[0])), !ib.support.tbody)for (f = "table" !== i || $b.test(f) ? "<table>" !== k[1] || $b.test(f) ? 0 : h : h.firstChild, e = f && f.childNodes.length; e--;)ib.nodeName(j = f.childNodes[e], "tbody") && !j.childNodes.length && f.removeChild(j);
                for (ib.merge(o, h.childNodes), h.textContent = ""; h.firstChild;)h.removeChild(h.firstChild);
                h = n.lastChild
            } else o.push(b.createTextNode(f));
            for (h && n.removeChild(h), ib.support.appendChecked || ib.grep(t(o, "input"), u), p = 0; f = o[p++];)if ((!d || -1 === ib.inArray(f, d)) && (g = ib.contains(f.ownerDocument, f), h = t(n.appendChild(f), "script"), g && q(h), c))for (e = 0; f = h[e++];)dc.test(f.type || "") && c.push(f);
            return h = null, n
        }, cleanData:function (a, b) {
            for (var c, d, e, f, g = 0, h = ib.expando, i = ib.cache, j = ib.support.deleteExpando, k = ib.event.special; null != (c = a[g]); g++)if ((b || ib.acceptData(c)) && (e = c[h], f = e && i[e])) {
                if (f.events)for (d in f.events)k[d] ? ib.event.remove(c, d) : ib.removeEvent(c, d, f.handle);
                i[e] && (delete i[e], j ? delete c[h] : typeof c.removeAttribute !== V ? c.removeAttribute(h) : c[h] = null, _.push(e))
            }
        }});
        var jc, kc, lc, mc = /alpha\([^)]*\)/i, nc = /opacity\s*=\s*([^)]*)/, oc = /^(top|right|bottom|left)$/, pc = /^(none|table(?!-c[ea]).+)/, qc = /^margin/, rc = new RegExp("^(" + jb + ")(.*)$", "i"), sc = new RegExp("^(" + jb + ")(?!px)[a-z%]+$", "i"), tc = new RegExp("^([+-])=(" + jb + ")", "i"), uc = {BODY:"block"}, vc = {position:"absolute", visibility:"hidden", display:"block"}, wc = {letterSpacing:0, fontWeight:400}, xc = ["Top", "Right", "Bottom", "Left"], yc = ["Webkit", "O", "Moz", "ms"];
        ib.fn.extend({css:function (a, c) {
            return ib.access(this, function (a, c, d) {
                var e, f, g = {}, h = 0;
                if (ib.isArray(c)) {
                    for (f = kc(a), e = c.length; e > h; h++)g[c[h]] = ib.css(a, c[h], !1, f);
                    return g
                }
                return d !== b ? ib.style(a, c, d) : ib.css(a, c)
            }, a, c, arguments.length > 1)
        }, show:function () {
            return x(this, !0)
        }, hide:function () {
            return x(this)
        }, toggle:function (a) {
            var b = "boolean" == typeof a;
            return this.each(function () {
                (b ? a : w(this)) ? ib(this).show() : ib(this).hide()
            })
        }}), ib.extend({cssHooks:{opacity:{get:function (a, b) {
            if (b) {
                var c = lc(a, "opacity");
                return"" === c ? "1" : c
            }
        }}}, cssNumber:{columnCount:!0, fillOpacity:!0, fontWeight:!0, lineHeight:!0, opacity:!0, orphans:!0, widows:!0, zIndex:!0, zoom:!0}, cssProps:{"float":ib.support.cssFloat ? "cssFloat" : "styleFloat"}, style:function (a, c, d, e) {
            if (a && 3 !== a.nodeType && 8 !== a.nodeType && a.style) {
                var f, g, h, i = ib.camelCase(c), j = a.style;
                if (c = ib.cssProps[i] || (ib.cssProps[i] = v(j, i)), h = ib.cssHooks[c] || ib.cssHooks[i], d === b)return h && "get"in h && (f = h.get(a, !1, e)) !== b ? f : j[c];
                if (g = typeof d, "string" === g && (f = tc.exec(d)) && (d = (f[1] + 1) * f[2] + parseFloat(ib.css(a, c)), g = "number"), !(null == d || "number" === g && isNaN(d) || ("number" !== g || ib.cssNumber[i] || (d += "px"), ib.support.clearCloneStyle || "" !== d || 0 !== c.indexOf("background") || (j[c] = "inherit"), h && "set"in h && (d = h.set(a, d, e)) === b)))try {
                    j[c] = d
                } catch (k) {
                }
            }
        }, css:function (a, c, d, e) {
            var f, g, h, i = ib.camelCase(c);
            return c = ib.cssProps[i] || (ib.cssProps[i] = v(a.style, i)), h = ib.cssHooks[c] || ib.cssHooks[i], h && "get"in h && (g = h.get(a, !0, d)), g === b && (g = lc(a, c, e)), "normal" === g && c in wc && (g = wc[c]), "" === d || d ? (f = parseFloat(g), d === !0 || ib.isNumeric(f) ? f || 0 : g) : g
        }, swap:function (a, b, c, d) {
            var e, f, g = {};
            for (f in b)g[f] = a.style[f], a.style[f] = b[f];
            e = c.apply(a, d || []);
            for (f in b)a.style[f] = g[f];
            return e
        }}), a.getComputedStyle ? (kc = function (b) {
            return a.getComputedStyle(b, null)
        }, lc = function (a, c, d) {
            var e, f, g, h = d || kc(a), i = h ? h.getPropertyValue(c) || h[c] : b, j = a.style;
            return h && ("" !== i || ib.contains(a.ownerDocument, a) || (i = ib.style(a, c)), sc.test(i) && qc.test(c) && (e = j.width, f = j.minWidth, g = j.maxWidth, j.minWidth = j.maxWidth = j.width = i, i = h.width, j.width = e, j.minWidth = f, j.maxWidth = g)), i
        }) : W.documentElement.currentStyle && (kc = function (a) {
            return a.currentStyle
        }, lc = function (a, c, d) {
            var e, f, g, h = d || kc(a), i = h ? h[c] : b, j = a.style;
            return null == i && j && j[c] && (i = j[c]), sc.test(i) && !oc.test(c) && (e = j.left, f = a.runtimeStyle, g = f && f.left, g && (f.left = a.currentStyle.left), j.left = "fontSize" === c ? "1em" : i, i = j.pixelLeft + "px", j.left = e, g && (f.left = g)), "" === i ? "auto" : i
        }), ib.each(["height", "width"], function (a, b) {
            ib.cssHooks[b] = {get:function (a, c, d) {
                return c ? 0 === a.offsetWidth && pc.test(ib.css(a, "display")) ? ib.swap(a, vc, function () {
                    return A(a, b, d)
                }) : A(a, b, d) : void 0
            }, set:function (a, c, d) {
                var e = d && kc(a);
                return y(a, c, d ? z(a, b, d, ib.support.boxSizing && "border-box" === ib.css(a, "boxSizing", !1, e), e) : 0)
            }}
        }), ib.support.opacity || (ib.cssHooks.opacity = {get:function (a, b) {
            return nc.test((b && a.currentStyle ? a.currentStyle.filter : a.style.filter) || "") ? .01 * parseFloat(RegExp.$1) + "" : b ? "1" : ""
        }, set:function (a, b) {
            var c = a.style, d = a.currentStyle, e = ib.isNumeric(b) ? "alpha(opacity=" + 100 * b + ")" : "", f = d && d.filter || c.filter || "";
            c.zoom = 1, (b >= 1 || "" === b) && "" === ib.trim(f.replace(mc, "")) && c.removeAttribute && (c.removeAttribute("filter"), "" === b || d && !d.filter) || (c.filter = mc.test(f) ? f.replace(mc, e) : f + " " + e)
        }}), ib(function () {
            ib.support.reliableMarginRight || (ib.cssHooks.marginRight = {get:function (a, b) {
                return b ? ib.swap(a, {display:"inline-block"}, lc, [a, "marginRight"]) : void 0
            }}), !ib.support.pixelPosition && ib.fn.position && ib.each(["top", "left"], function (a, b) {
                ib.cssHooks[b] = {get:function (a, c) {
                    return c ? (c = lc(a, b), sc.test(c) ? ib(a).position()[b] + "px" : c) : void 0
                }}
            })
        }), ib.expr && ib.expr.filters && (ib.expr.filters.hidden = function (a) {
            return a.offsetWidth <= 0 && a.offsetHeight <= 0 || !ib.support.reliableHiddenOffsets && "none" === (a.style && a.style.display || ib.css(a, "display"))
        }, ib.expr.filters.visible = function (a) {
            return!ib.expr.filters.hidden(a)
        }), ib.each({margin:"", padding:"", border:"Width"}, function (a, b) {
            ib.cssHooks[a + b] = {expand:function (c) {
                for (var d = 0, e = {}, f = "string" == typeof c ? c.split(" ") : [c]; 4 > d; d++)e[a + xc[d] + b] = f[d] || f[d - 2] || f[0];
                return e
            }}, qc.test(a) || (ib.cssHooks[a + b].set = y)
        });
        var zc = /%20/g, Ac = /\[\]$/, Bc = /\r?\n/g, Cc = /^(?:submit|button|image|reset|file)$/i, Dc = /^(?:input|select|textarea|keygen)/i;
        ib.fn.extend({serialize:function () {
            return ib.param(this.serializeArray())
        }, serializeArray:function () {
            return this.map(function () {
                var a = ib.prop(this, "elements");
                return a ? ib.makeArray(a) : this
            }).filter(function () {
                var a = this.type;
                return this.name && !ib(this).is(":disabled") && Dc.test(this.nodeName) && !Cc.test(a) && (this.checked || !bc.test(a))
            }).map(function (a, b) {
                var c = ib(this).val();
                return null == c ? null : ib.isArray(c) ? ib.map(c, function (a) {
                    return{name:b.name, value:a.replace(Bc, "\r\n")}
                }) : {name:b.name, value:c.replace(Bc, "\r\n")}
            }).get()
        }}), ib.param = function (a, c) {
            var d, e = [], f = function (a, b) {
                b = ib.isFunction(b) ? b() : null == b ? "" : b, e[e.length] = encodeURIComponent(a) + "=" + encodeURIComponent(b)
            };
            if (c === b && (c = ib.ajaxSettings && ib.ajaxSettings.traditional), ib.isArray(a) || a.jquery && !ib.isPlainObject(a))ib.each(a, function () {
                f(this.name, this.value)
            }); else for (d in a)D(d, a[d], c, f);
            return e.join("&").replace(zc, "+")
        }, ib.each("blur focus focusin focusout load resize scroll unload click dblclick mousedown mouseup mousemove mouseover mouseout mouseenter mouseleave change select submit keydown keypress keyup error contextmenu".split(" "), function (a, b) {
            ib.fn[b] = function (a, c) {
                return arguments.length > 0 ? this.on(b, null, a, c) : this.trigger(b)
            }
        }), ib.fn.hover = function (a, b) {
            return this.mouseenter(a).mouseleave(b || a)
        };
        var Ec, Fc, Gc = ib.now(), Hc = /\?/, Ic = /#.*$/, Jc = /([?&])_=[^&]*/, Kc = /^(.*?):[ \t]*([^\r\n]*)\r?$/gm, Lc = /^(?:about|app|app-storage|.+-extension|file|res|widget):$/, Mc = /^(?:GET|HEAD)$/, Nc = /^\/\//, Oc = /^([\w.+-]+:)(?:\/\/([^\/?#:]*)(?::(\d+)|)|)/, Pc = ib.fn.load, Qc = {}, Rc = {}, Sc = "*/".concat("*");
        try {
            Fc = X.href
        } catch (Tc) {
            Fc = W.createElement("a"), Fc.href = "", Fc = Fc.href
        }
        Ec = Oc.exec(Fc.toLowerCase()) || [], ib.fn.load = function (a, c, d) {
            if ("string" != typeof a && Pc)return Pc.apply(this, arguments);
            var e, f, g, h = this, i = a.indexOf(" ");
            return i >= 0 && (e = a.slice(i, a.length), a = a.slice(0, i)), ib.isFunction(c) ? (d = c, c = b) : c && "object" == typeof c && (g = "POST"), h.length > 0 && ib.ajax({url:a, type:g, dataType:"html", data:c}).done(function (a) {
                f = arguments, h.html(e ? ib("<div>").append(ib.parseHTML(a)).find(e) : a)
            }).complete(d && function (a, b) {
                h.each(d, f || [a.responseText, b, a])
            }), this
        }, ib.each(["ajaxStart", "ajaxStop", "ajaxComplete", "ajaxError", "ajaxSuccess", "ajaxSend"], function (a, b) {
            ib.fn[b] = function (a) {
                return this.on(b, a)
            }
        }), ib.each(["get", "post"], function (a, c) {
            ib[c] = function (a, d, e, f) {
                return ib.isFunction(d) && (f = f || e, e = d, d = b), ib.ajax({url:a, type:c, dataType:f, data:d, success:e})
            }
        }), ib.extend({active:0, lastModified:{}, etag:{}, ajaxSettings:{url:Fc, type:"GET", isLocal:Lc.test(Ec[1]), global:!0, processData:!0, async:!0, contentType:"application/x-www-form-urlencoded; charset=UTF-8", accepts:{"*":Sc, text:"text/plain", html:"text/html", xml:"application/xml, text/xml", json:"application/json, text/javascript"}, contents:{xml:/xml/, html:/html/, json:/json/}, responseFields:{xml:"responseXML", text:"responseText"}, converters:{"* text":a.String, "text html":!0, "text json":ib.parseJSON, "text xml":ib.parseXML}, flatOptions:{url:!0, context:!0}}, ajaxSetup:function (a, b) {
            return b ? G(G(a, ib.ajaxSettings), b) : G(ib.ajaxSettings, a)
        }, ajaxPrefilter:E(Qc), ajaxTransport:E(Rc), ajax:function (a, c) {
            function d(a, c, d, e) {
                var f, l, s, t, v, x = c;
                2 !== u && (u = 2, i && clearTimeout(i), k = b, h = e || "", w.readyState = a > 0 ? 4 : 0, d && (t = H(m, w, d)), a >= 200 && 300 > a || 304 === a ? (m.ifModified && (v = w.getResponseHeader("Last-Modified"), v && (ib.lastModified[g] = v), v = w.getResponseHeader("etag"), v && (ib.etag[g] = v)), 204 === a ? (f = !0, x = "nocontent") : 304 === a ? (f = !0, x = "notmodified") : (f = I(m, t), x = f.state, l = f.data, s = f.error, f = !s)) : (s = x, (a || !x) && (x = "error", 0 > a && (a = 0))), w.status = a, w.statusText = (c || x) + "", f ? p.resolveWith(n, [l, x, w]) : p.rejectWith(n, [w, x, s]), w.statusCode(r), r = b, j && o.trigger(f ? "ajaxSuccess" : "ajaxError", [w, m, f ? l : s]), q.fireWith(n, [w, x]), j && (o.trigger("ajaxComplete", [w, m]), --ib.active || ib.event.trigger("ajaxStop")))
            }

            "object" == typeof a && (c = a, a = b), c = c || {};
            var e, f, g, h, i, j, k, l, m = ib.ajaxSetup({}, c), n = m.context || m, o = m.context && (n.nodeType || n.jquery) ? ib(n) : ib.event, p = ib.Deferred(), q = ib.Callbacks("once memory"), r = m.statusCode || {}, s = {}, t = {}, u = 0, v = "canceled", w = {readyState:0, getResponseHeader:function (a) {
                var b;
                if (2 === u) {
                    if (!l)for (l = {}; b = Kc.exec(h);)l[b[1].toLowerCase()] = b[2];
                    b = l[a.toLowerCase()]
                }
                return null == b ? null : b
            }, getAllResponseHeaders:function () {
                return 2 === u ? h : null
            }, setRequestHeader:function (a, b) {
                var c = a.toLowerCase();
                return u || (a = t[c] = t[c] || a, s[a] = b), this
            }, overrideMimeType:function (a) {
                return u || (m.mimeType = a), this
            }, statusCode:function (a) {
                var b;
                if (a)if (2 > u)for (b in a)r[b] = [r[b], a[b]]; else w.always(a[w.status]);
                return this
            }, abort:function (a) {
                var b = a || v;
                return k && k.abort(b), d(0, b), this
            }};
            if (p.promise(w).complete = q.add, w.success = w.done, w.error = w.fail, m.url = ((a || m.url || Fc) + "").replace(Ic, "").replace(Nc, Ec[1] + "//"), m.type = c.method || c.type || m.method || m.type, m.dataTypes = ib.trim(m.dataType || "*").toLowerCase().match(kb) || [""], null == m.crossDomain && (e = Oc.exec(m.url.toLowerCase()), m.crossDomain = !(!e || e[1] === Ec[1] && e[2] === Ec[2] && (e[3] || ("http:" === e[1] ? 80 : 443)) == (Ec[3] || ("http:" === Ec[1] ? 80 : 443)))), m.data && m.processData && "string" != typeof m.data && (m.data = ib.param(m.data, m.traditional)), F(Qc, m, c, w), 2 === u)return w;
            j = m.global, j && 0 === ib.active++ && ib.event.trigger("ajaxStart"), m.type = m.type.toUpperCase(), m.hasContent = !Mc.test(m.type), g = m.url, m.hasContent || (m.data && (g = m.url += (Hc.test(g) ? "&" : "?") + m.data, delete m.data), m.cache === !1 && (m.url = Jc.test(g) ? g.replace(Jc, "$1_=" + Gc++) : g + (Hc.test(g) ? "&" : "?") + "_=" + Gc++)), m.ifModified && (ib.lastModified[g] && w.setRequestHeader("If-Modified-Since", ib.lastModified[g]), ib.etag[g] && w.setRequestHeader("If-None-Match", ib.etag[g])), (m.data && m.hasContent && m.contentType !== !1 || c.contentType) && w.setRequestHeader("Content-Type", m.contentType), w.setRequestHeader("Accept", m.dataTypes[0] && m.accepts[m.dataTypes[0]] ? m.accepts[m.dataTypes[0]] + ("*" !== m.dataTypes[0] ? ", " + Sc + "; q=0.01" : "") : m.accepts["*"]);
            for (f in m.headers)w.setRequestHeader(f, m.headers[f]);
            if (m.beforeSend && (m.beforeSend.call(n, w, m) === !1 || 2 === u))return w.abort();
            v = "abort";
            for (f in{success:1, error:1, complete:1})w[f](m[f]);
            if (k = F(Rc, m, c, w)) {
                w.readyState = 1, j && o.trigger("ajaxSend", [w, m]), m.async && m.timeout > 0 && (i = setTimeout(function () {
                    w.abort("timeout")
                }, m.timeout));
                try {
                    u = 1, k.send(s, d)
                } catch (x) {
                    if (!(2 > u))throw x;
                    d(-1, x)
                }
            } else d(-1, "No Transport");
            return w
        }, getScript:function (a, c) {
            return ib.get(a, b, c, "script")
        }, getJSON:function (a, b, c) {
            return ib.get(a, b, c, "json")
        }}), ib.ajaxSetup({accepts:{script:"text/javascript, application/javascript, application/ecmascript, application/x-ecmascript"}, contents:{script:/(?:java|ecma)script/}, converters:{"text script":function (a) {
            return ib.globalEval(a), a
        }}}), ib.ajaxPrefilter("script", function (a) {
            a.cache === b && (a.cache = !1), a.crossDomain && (a.type = "GET", a.global = !1)
        }), ib.ajaxTransport("script", function (a) {
            if (a.crossDomain) {
                var c, d = W.head || ib("head")[0] || W.documentElement;
                return{send:function (b, e) {
                    c = W.createElement("script"), c.async = !0, a.scriptCharset && (c.charset = a.scriptCharset), c.src = a.url, c.onload = c.onreadystatechange = function (a, b) {
                        (b || !c.readyState || /loaded|complete/.test(c.readyState)) && (c.onload = c.onreadystatechange = null, c.parentNode && c.parentNode.removeChild(c), c = null, b || e(200, "success"))
                    }, d.insertBefore(c, d.firstChild)
                }, abort:function () {
                    c && c.onload(b, !0)
                }}
            }
        });
        var Uc = [], Vc = /(=)\?(?=&|$)|\?\?/;
        ib.ajaxSetup({jsonp:"callback", jsonpCallback:function () {
            var a = Uc.pop() || ib.expando + "_" + Gc++;
            return this[a] = !0, a
        }}), ib.ajaxPrefilter("json jsonp", function (c, d, e) {
            var f, g, h, i = c.jsonp !== !1 && (Vc.test(c.url) ? "url" : "string" == typeof c.data && !(c.contentType || "").indexOf("application/x-www-form-urlencoded") && Vc.test(c.data) && "data");
            return i || "jsonp" === c.dataTypes[0] ? (f = c.jsonpCallback = ib.isFunction(c.jsonpCallback) ? c.jsonpCallback() : c.jsonpCallback, i ? c[i] = c[i].replace(Vc, "$1" + f) : c.jsonp !== !1 && (c.url += (Hc.test(c.url) ? "&" : "?") + c.jsonp + "=" + f), c.converters["script json"] = function () {
                return h || ib.error(f + " was not called"), h[0]
            }, c.dataTypes[0] = "json", g = a[f], a[f] = function () {
                h = arguments
            }, e.always(function () {
                a[f] = g, c[f] && (c.jsonpCallback = d.jsonpCallback, Uc.push(f)), h && ib.isFunction(g) && g(h[0]), h = g = b
            }), "script") : void 0
        });
        var Wc, Xc, Yc = 0, Zc = a.ActiveXObject && function () {
            var a;
            for (a in Wc)Wc[a](b, !0)
        };
        ib.ajaxSettings.xhr = a.ActiveXObject ? function () {
            return!this.isLocal && J() || K()
        } : J, Xc = ib.ajaxSettings.xhr(), ib.support.cors = !!Xc && "withCredentials"in Xc, Xc = ib.support.ajax = !!Xc, Xc && ib.ajaxTransport(function (c) {
            if (!c.crossDomain || ib.support.cors) {
                var d;
                return{send:function (e, f) {
                    var g, h, i = c.xhr();
                    if (c.username ? i.open(c.type, c.url, c.async, c.username, c.password) : i.open(c.type, c.url, c.async), c.xhrFields)for (h in c.xhrFields)i[h] = c.xhrFields[h];
                    c.mimeType && i.overrideMimeType && i.overrideMimeType(c.mimeType), c.crossDomain || e["X-Requested-With"] || (e["X-Requested-With"] = "XMLHttpRequest");
                    try {
                        for (h in e)i.setRequestHeader(h, e[h])
                    } catch (j) {
                    }
                    i.send(c.hasContent && c.data || null), d = function (a, e) {
                        var h, j, k, l;
                        try {
                            if (d && (e || 4 === i.readyState))if (d = b, g && (i.onreadystatechange = ib.noop, Zc && delete Wc[g]), e)4 !== i.readyState && i.abort(); else {
                                l = {}, h = i.status, j = i.getAllResponseHeaders(), "string" == typeof i.responseText && (l.text = i.responseText);
                                try {
                                    k = i.statusText
                                } catch (m) {
                                    k = ""
                                }
                                h || !c.isLocal || c.crossDomain ? 1223 === h && (h = 204) : h = l.text ? 200 : 404
                            }
                        } catch (n) {
                            e || f(-1, n)
                        }
                        l && f(h, k, l, j)
                    }, c.async ? 4 === i.readyState ? setTimeout(d) : (g = ++Yc, Zc && (Wc || (Wc = {}, ib(a).unload(Zc)), Wc[g] = d), i.onreadystatechange = d) : d()
                }, abort:function () {
                    d && d(b, !0)
                }}
            }
        });
        var $c, _c, ad = /^(?:toggle|show|hide)$/, bd = new RegExp("^(?:([+-])=|)(" + jb + ")([a-z%]*)$", "i"), cd = /queueHooks$/, dd = [P], ed = {"*":[function (a, b) {
            var c, d, e = this.createTween(a, b), f = bd.exec(b), g = e.cur(), h = +g || 0, i = 1, j = 20;
            if (f) {
                if (c = +f[2], d = f[3] || (ib.cssNumber[a] ? "" : "px"), "px" !== d && h) {
                    h = ib.css(e.elem, a, !0) || c || 1;
                    do i = i || ".5", h /= i, ib.style(e.elem, a, h + d); while (i !== (i = e.cur() / g) && 1 !== i && --j)
                }
                e.unit = d, e.start = h, e.end = f[1] ? h + (f[1] + 1) * c : c
            }
            return e
        }]};
        ib.Animation = ib.extend(N, {tweener:function (a, b) {
            ib.isFunction(a) ? (b = a, a = ["*"]) : a = a.split(" ");
            for (var c, d = 0, e = a.length; e > d; d++)c = a[d], ed[c] = ed[c] || [], ed[c].unshift(b)
        }, prefilter:function (a, b) {
            b ? dd.unshift(a) : dd.push(a)
        }}), ib.Tween = Q, Q.prototype = {constructor:Q, init:function (a, b, c, d, e, f) {
            this.elem = a, this.prop = c, this.easing = e || "swing", this.options = b, this.start = this.now = this.cur(), this.end = d, this.unit = f || (ib.cssNumber[c] ? "" : "px")
        }, cur:function () {
            var a = Q.propHooks[this.prop];
            return a && a.get ? a.get(this) : Q.propHooks._default.get(this)
        }, run:function (a) {
            var b, c = Q.propHooks[this.prop];
            return this.pos = b = this.options.duration ? ib.easing[this.easing](a, this.options.duration * a, 0, 1, this.options.duration) : a, this.now = (this.end - this.start) * b + this.start, this.options.step && this.options.step.call(this.elem, this.now, this), c && c.set ? c.set(this) : Q.propHooks._default.set(this), this
        }}, Q.prototype.init.prototype = Q.prototype, Q.propHooks = {_default:{get:function (a) {
            var b;
            return null == a.elem[a.prop] || a.elem.style && null != a.elem.style[a.prop] ? (b = ib.css(a.elem, a.prop, ""), b && "auto" !== b ? b : 0) : a.elem[a.prop]
        }, set:function (a) {
            ib.fx.step[a.prop] ? ib.fx.step[a.prop](a) : a.elem.style && (null != a.elem.style[ib.cssProps[a.prop]] || ib.cssHooks[a.prop]) ? ib.style(a.elem, a.prop, a.now + a.unit) : a.elem[a.prop] = a.now
        }}}, Q.propHooks.scrollTop = Q.propHooks.scrollLeft = {set:function (a) {
            a.elem.nodeType && a.elem.parentNode && (a.elem[a.prop] = a.now)
        }}, ib.each(["toggle", "show", "hide"], function (a, b) {
            var c = ib.fn[b];
            ib.fn[b] = function (a, d, e) {
                return null == a || "boolean" == typeof a ? c.apply(this, arguments) : this.animate(R(b, !0), a, d, e)
            }
        }), ib.fn.extend({fadeTo:function (a, b, c, d) {
            return this.filter(w).css("opacity", 0).show().end().animate({opacity:b}, a, c, d)
        }, animate:function (a, b, c, d) {
            var e = ib.isEmptyObject(a), f = ib.speed(b, c, d), g = function () {
                var b = N(this, ib.extend({}, a), f);
                g.finish = function () {
                    b.stop(!0)
                }, (e || ib._data(this, "finish")) && b.stop(!0)
            };
            return g.finish = g, e || f.queue === !1 ? this.each(g) : this.queue(f.queue, g)
        }, stop:function (a, c, d) {
            var e = function (a) {
                var b = a.stop;
                delete a.stop, b(d)
            };
            return"string" != typeof a && (d = c, c = a, a = b), c && a !== !1 && this.queue(a || "fx", []), this.each(function () {
                var b = !0, c = null != a && a + "queueHooks", f = ib.timers, g = ib._data(this);
                if (c)g[c] && g[c].stop && e(g[c]); else for (c in g)g[c] && g[c].stop && cd.test(c) && e(g[c]);
                for (c = f.length; c--;)f[c].elem !== this || null != a && f[c].queue !== a || (f[c].anim.stop(d), b = !1, f.splice(c, 1));
                (b || !d) && ib.dequeue(this, a)
            })
        }, finish:function (a) {
            return a !== !1 && (a = a || "fx"), this.each(function () {
                var b, c = ib._data(this), d = c[a + "queue"], e = c[a + "queueHooks"], f = ib.timers, g = d ? d.length : 0;
                for (c.finish = !0, ib.queue(this, a, []), e && e.cur && e.cur.finish && e.cur.finish.call(this), b = f.length; b--;)f[b].elem === this && f[b].queue === a && (f[b].anim.stop(!0), f.splice(b, 1));
                for (b = 0; g > b; b++)d[b] && d[b].finish && d[b].finish.call(this);
                delete c.finish
            })
        }}), ib.each({slideDown:R("show"), slideUp:R("hide"), slideToggle:R("toggle"), fadeIn:{opacity:"show"}, fadeOut:{opacity:"hide"}, fadeToggle:{opacity:"toggle"}}, function (a, b) {
            ib.fn[a] = function (a, c, d) {
                return this.animate(b, a, c, d)
            }
        }), ib.speed = function (a, b, c) {
            var d = a && "object" == typeof a ? ib.extend({}, a) : {complete:c || !c && b || ib.isFunction(a) && a, duration:a, easing:c && b || b && !ib.isFunction(b) && b};
            return d.duration = ib.fx.off ? 0 : "number" == typeof d.duration ? d.duration : d.duration in ib.fx.speeds ? ib.fx.speeds[d.duration] : ib.fx.speeds._default, (null == d.queue || d.queue === !0) && (d.queue = "fx"), d.old = d.complete, d.complete = function () {
                ib.isFunction(d.old) && d.old.call(this), d.queue && ib.dequeue(this, d.queue)
            }, d
        }, ib.easing = {linear:function (a) {
            return a
        }, swing:function (a) {
            return.5 - Math.cos(a * Math.PI) / 2
        }}, ib.timers = [], ib.fx = Q.prototype.init, ib.fx.tick = function () {
            var a, c = ib.timers, d = 0;
            for ($c = ib.now(); d < c.length; d++)a = c[d], a() || c[d] !== a || c.splice(d--, 1);
            c.length || ib.fx.stop(), $c = b
        }, ib.fx.timer = function (a) {
            a() && ib.timers.push(a) && ib.fx.start()
        }, ib.fx.interval = 13, ib.fx.start = function () {
            _c || (_c = setInterval(ib.fx.tick, ib.fx.interval))
        }, ib.fx.stop = function () {
            clearInterval(_c), _c = null
        }, ib.fx.speeds = {slow:600, fast:200, _default:400}, ib.fx.step = {}, ib.expr && ib.expr.filters && (ib.expr.filters.animated = function (a) {
            return ib.grep(ib.timers,function (b) {
                return a === b.elem
            }).length
        }), ib.fn.offset = function (a) {
            if (arguments.length)return a === b ? this : this.each(function (b) {
                ib.offset.setOffset(this, a, b)
            });
            var c, d, e = {top:0, left:0}, f = this[0], g = f && f.ownerDocument;
            if (g)return c = g.documentElement, ib.contains(c, f) ? (typeof f.getBoundingClientRect !== V && (e = f.getBoundingClientRect()), d = S(g), {top:e.top + (d.pageYOffset || c.scrollTop) - (c.clientTop || 0), left:e.left + (d.pageXOffset || c.scrollLeft) - (c.clientLeft || 0)}) : e
        }, ib.offset = {setOffset:function (a, b, c) {
            var d = ib.css(a, "position");
            "static" === d && (a.style.position = "relative");
            var e, f, g = ib(a), h = g.offset(), i = ib.css(a, "top"), j = ib.css(a, "left"), k = ("absolute" === d || "fixed" === d) && ib.inArray("auto", [i, j]) > -1, l = {}, m = {};
            k ? (m = g.position(), e = m.top, f = m.left) : (e = parseFloat(i) || 0, f = parseFloat(j) || 0), ib.isFunction(b) && (b = b.call(a, c, h)), null != b.top && (l.top = b.top - h.top + e), null != b.left && (l.left = b.left - h.left + f), "using"in b ? b.using.call(a, l) : g.css(l)
        }}, ib.fn.extend({position:function () {
            if (this[0]) {
                var a, b, c = {top:0, left:0}, d = this[0];
                return"fixed" === ib.css(d, "position") ? b = d.getBoundingClientRect() : (a = this.offsetParent(), b = this.offset(), ib.nodeName(a[0], "html") || (c = a.offset()), c.top += ib.css(a[0], "borderTopWidth", !0), c.left += ib.css(a[0], "borderLeftWidth", !0)), {top:b.top - c.top - ib.css(d, "marginTop", !0), left:b.left - c.left - ib.css(d, "marginLeft", !0)}
            }
        }, offsetParent:function () {
            return this.map(function () {
                for (var a = this.offsetParent || W.documentElement; a && !ib.nodeName(a, "html") && "static" === ib.css(a, "position");)a = a.offsetParent;
                return a || W.documentElement
            })
        }}), ib.each({scrollLeft:"pageXOffset", scrollTop:"pageYOffset"}, function (a, c) {
            var d = /Y/.test(c);
            ib.fn[a] = function (e) {
                return ib.access(this, function (a, e, f) {
                    var g = S(a);
                    return f === b ? g ? c in g ? g[c] : g.document.documentElement[e] : a[e] : void(g ? g.scrollTo(d ? ib(g).scrollLeft() : f, d ? f : ib(g).scrollTop()) : a[e] = f)
                }, a, e, arguments.length, null)
            }
        }), ib.each({Height:"height", Width:"width"}, function (a, c) {
            ib.each({padding:"inner" + a, content:c, "":"outer" + a}, function (d, e) {
                ib.fn[e] = function (e, f) {
                    var g = arguments.length && (d || "boolean" != typeof e), h = d || (e === !0 || f === !0 ? "margin" : "border");
                    return ib.access(this, function (c, d, e) {
                        var f;
                        return ib.isWindow(c) ? c.document.documentElement["client" + a] : 9 === c.nodeType ? (f = c.documentElement, Math.max(c.body["scroll" + a], f["scroll" + a], c.body["offset" + a], f["offset" + a], f["client" + a])) : e === b ? ib.css(c, d, h) : ib.style(c, d, e, h)
                    }, c, g ? e : b, g, null)
                }
            })
        }), a.jQuery = a.$ = ib, "function" == typeof define && define.amd && define.amd.jQuery && define("jquery", [], function () {
            return ib
        })
    }(window)
}, {}], 3:[function () {
    !function (a, b, c) {
        !function (a) {
            "use strict";
            "function" == typeof define && define.amd ? define(["jquery"], a) : jQuery && !jQuery.fn.qtip && a(jQuery)
        }(function (d) {
            "use strict";
            function e(a, b, c, e) {
                this.id = c, this.target = a, this.tooltip = G, this.elements = {target:a}, this._id = T + "-" + c, this.timers = {img:{}}, this.options = b, this.plugins = {}, this.cache = {event:{}, target:d(), disabled:F, attr:e, onTooltip:F, lastClass:""}, this.rendered = this.destroyed = this.disabled = this.waiting = this.hiddenDuringWait = this.positioning = this.triggering = F
            }

            function f(a) {
                return a === G || "object" !== d.type(a)
            }

            function g(a) {
                return!(d.isFunction(a) || a && a.attr || a.length || "object" === d.type(a) && (a.jquery || a.then))
            }

            function h(a) {
                var b, c, e, h;
                return f(a) ? F : (f(a.metadata) && (a.metadata = {type:a.metadata}), "content"in a && (b = a.content, f(b) || b.jquery || b.done ? b = a.content = {text:c = g(b) ? F : b} : c = b.text, "ajax"in b && (e = b.ajax, h = e && e.once !== F, delete b.ajax, b.text = function (a, b) {
                    var f = c || d(this).attr(b.options.content.attr) || "Loading...", g = d.ajax(d.extend({}, e, {context:b})).then(e.success, G, e.error).then(function (a) {
                        return a && h && b.set("content.text", a), a
                    }, function (a, c, d) {
                        b.destroyed || 0 === a.status || b.set("content.text", c + ": " + d)
                    });
                    return h ? f : (b.set("content.text", f), g)
                }), "title"in b && (f(b.title) || (b.button = b.title.button, b.title = b.title.text), g(b.title || F) && (b.title = F))), "position"in a && f(a.position) && (a.position = {my:a.position, at:a.position}), "show"in a && f(a.show) && (a.show = a.show.jquery ? {target:a.show} : a.show === E ? {ready:E} : {event:a.show}), "hide"in a && f(a.hide) && (a.hide = a.hide.jquery ? {target:a.hide} : {event:a.hide}), "style"in a && f(a.style) && (a.style = {classes:a.style}), d.each(S, function () {
                    this.sanitize && this.sanitize(a)
                }), a)
            }

            function i(a, b) {
                for (var c, d = 0, e = a, f = b.split("."); e = e[f[d++]];)f.length > d && (c = e);
                return[c || a, f.pop()]
            }

            function j(a, b) {
                var c, d, e;
                for (c in this.checks)for (d in this.checks[c])(e = RegExp(d, "i").exec(a)) && (b.push(e), ("builtin" === c || this.plugins[c]) && this.checks[c][d].apply(this.plugins[c] || this, b))
            }

            function k(a) {
                return W.concat("").join(a ? "-" + a + " " : " ")
            }

            function l(c) {
                return c && {type:c.type, pageX:c.pageX, pageY:c.pageY, target:c.target, relatedTarget:c.relatedTarget, scrollX:c.scrollX || a.pageXOffset || b.body.scrollLeft || b.documentElement.scrollLeft, scrollY:c.scrollY || a.pageYOffset || b.body.scrollTop || b.documentElement.scrollTop} || {}
            }

            function m(a, b) {
                return b > 0 ? setTimeout(d.proxy(a, this), b) : (a.call(this), c)
            }

            function n(a) {
                return this.tooltip.hasClass(bb) ? F : (clearTimeout(this.timers.show), clearTimeout(this.timers.hide), this.timers.show = m.call(this, function () {
                    this.toggle(E, a)
                }, this.options.show.delay), c)
            }

            function o(a) {
                if (this.tooltip.hasClass(bb))return F;
                var b = d(a.relatedTarget), c = b.closest(X)[0] === this.tooltip[0], e = b[0] === this.options.show.target[0];
                if (clearTimeout(this.timers.show), clearTimeout(this.timers.hide), this !== b[0] && "mouse" === this.options.position.target && c || this.options.hide.fixed && /mouse(out|leave|move)/.test(a.type) && (c || e))try {
                    a.preventDefault(), a.stopImmediatePropagation()
                } catch (f) {
                } else this.timers.hide = m.call(this, function () {
                    this.toggle(F, a)
                }, this.options.hide.delay, this)
            }

            function p(a) {
                return this.tooltip.hasClass(bb) || !this.options.hide.inactive ? F : (clearTimeout(this.timers.inactive), this.timers.inactive = m.call(this, function () {
                    this.hide(a)
                }, this.options.hide.inactive), c)
            }

            function q(a) {
                this.rendered && this.tooltip[0].offsetWidth > 0 && this.reposition(a)
            }

            function r(a, c, e) {
                d(b.body).delegate(a, (c.split ? c : c.join(ib + " ")) + ib, function () {
                    var a = z.api[d.attr(this, V)];
                    a && !a.disabled && e.apply(a, arguments)
                })
            }

            function s(a, c, f) {
                var g, i, j, k, l, m = d(b.body), n = a[0] === b ? m : a, o = a.metadata ? a.metadata(f.metadata) : G, p = "html5" === f.metadata.type && o ? o[f.metadata.name] : G, q = a.data(f.metadata.name || "qtipopts");
                try {
                    q = "string" == typeof q ? d.parseJSON(q) : q
                } catch (r) {
                }
                if (k = d.extend(E, {}, z.defaults, f, "object" == typeof q ? h(q) : G, h(p || o)), i = k.position, k.id = c, "boolean" == typeof k.content.text) {
                    if (j = a.attr(k.content.attr), k.content.attr === F || !j)return F;
                    k.content.text = j
                }
                if (i.container.length || (i.container = m), i.target === F && (i.target = n), k.show.target === F && (k.show.target = n), k.show.solo === E && (k.show.solo = i.container.closest("body")), k.hide.target === F && (k.hide.target = n), k.position.viewport === E && (k.position.viewport = i.container), i.container = i.container.eq(0), i.at = new B(i.at, E), i.my = new B(i.my), a.data(T))if (k.overwrite)a.qtip("destroy", !0); else if (k.overwrite === F)return F;
                return a.attr(U, c), k.suppress && (l = a.attr("title")) && a.removeAttr("title").attr(db, l).attr("title", ""), g = new e(a, k, c, !!j), a.data(T, g), a.one("remove.qtip-" + c + " removeqtip.qtip-" + c, function () {
                    var a;
                    (a = d(this).data(T)) && a.destroy(!0)
                }), g
            }

            function t(a) {
                return a.charAt(0).toUpperCase() + a.slice(1)
            }

            function u(a, b) {
                var d, e, f = b.charAt(0).toUpperCase() + b.slice(1), g = (b + " " + tb.join(f + " ") + f).split(" "), h = 0;
                if (sb[b])return a.css(sb[b]);
                for (; d = g[h++];)if ((e = a.css(d)) !== c)return sb[b] = d, e
            }

            function v(a, b) {
                return Math.ceil(parseFloat(u(a, b)))
            }

            function w(a, b) {
                this._ns = "tip", this.options = b, this.offset = b.offset, this.size = [b.width, b.height], this.init(this.qtip = a)
            }

            function x(a, b) {
                this.options = b, this._ns = "-modal", this.init(this.qtip = a)
            }

            function y(a) {
                this._ns = "ie6", this.init(this.qtip = a)
            }

            var z, A, B, C, D, E = !0, F = !1, G = null, H = "x", I = "y", J = "width", K = "height", L = "top", M = "left", N = "bottom", O = "right", P = "center", Q = "flipinvert", R = "shift", S = {}, T = "qtip", U = "data-hasqtip", V = "data-qtip-id", W = ["ui-widget", "ui-tooltip"], X = "." + T, Y = "click dblclick mousedown mouseup mousemove mouseleave mouseenter".split(" "), Z = T + "-fixed", $ = T + "-default", _ = T + "-focus", ab = T + "-hover", bb = T + "-disabled", cb = "_replacedByqTip", db = "oldtitle", eb = {ie:function () {
                for (var a = 3, c = b.createElement("div"); (c.innerHTML = "<!--[if gt IE " + ++a + "]><i></i><![endif]-->") && c.getElementsByTagName("i")[0];);
                return a > 4 ? a : 0 / 0
            }(), iOS:parseFloat(("" + (/CPU.*OS ([0-9_]{1,5})|(CPU like).*AppleWebKit.*Mobile/i.exec(navigator.userAgent) || [0, ""])[1]).replace("undefined", "3_2").replace("_", ".").replace("_", "")) || F};
            A = e.prototype, A._when = function (a) {
                return d.when.apply(d, a)
            }, A.render = function (a) {
                if (this.rendered || this.destroyed)return this;
                var b, c = this, e = this.options, f = this.cache, g = this.elements, h = e.content.text, i = e.content.title, j = e.content.button, k = e.position, l = ("." + this._id + " ", []);
                return d.attr(this.target[0], "aria-describedby", this._id), this.tooltip = g.tooltip = b = d("<div/>", {id:this._id, "class":[T, $, e.style.classes, T + "-pos-" + e.position.my.abbrev()].join(" "), width:e.style.width || "", height:e.style.height || "", tracking:"mouse" === k.target && k.adjust.mouse, role:"alert", "aria-live":"polite", "aria-atomic":F, "aria-describedby":this._id + "-content", "aria-hidden":E}).toggleClass(bb, this.disabled).attr(V, this.id).data(T, this).appendTo(k.container).append(g.content = d("<div />", {"class":T + "-content", id:this._id + "-content", "aria-atomic":E})), this.rendered = -1, this.positioning = E, i && (this._createTitle(), d.isFunction(i) || l.push(this._updateTitle(i, F))), j && this._createButton(), d.isFunction(h) || l.push(this._updateContent(h, F)), this.rendered = E, this._setWidget(), d.each(S, function (a) {
                    var b;
                    "render" === this.initialize && (b = this(c)) && (c.plugins[a] = b)
                }), this._unassignEvents(), this._assignEvents(), this._when(l).then(function () {
                    c._trigger("render"), c.positioning = F, c.hiddenDuringWait || !e.show.ready && !a || c.toggle(E, f.event, F), c.hiddenDuringWait = F
                }), z.api[this.id] = this, this
            }, A.destroy = function (a) {
                function b() {
                    if (!this.destroyed) {
                        this.destroyed = E;
                        var a = this.target, b = a.attr(db);
                        this.rendered && this.tooltip.stop(1, 0).find("*").remove().end().remove(), d.each(this.plugins, function () {
                            this.destroy && this.destroy()
                        }), clearTimeout(this.timers.show), clearTimeout(this.timers.hide), this._unassignEvents(), a.removeData(T).removeAttr(V).removeAttr(U).removeAttr("aria-describedby"), this.options.suppress && b && a.attr("title", b).removeAttr(db), this._unbind(a), this.options = this.elements = this.cache = this.timers = this.plugins = this.mouse = G, delete z.api[this.id]
                    }
                }

                return this.destroyed ? this.target : (a === E && "hide" !== this.triggering || !this.rendered ? b.call(this) : (this.tooltip.one("tooltiphidden", d.proxy(b, this)), !this.triggering && this.hide()), this.target)
            }, C = A.checks = {builtin:{"^id$":function (a, b, c, e) {
                var f = c === E ? z.nextid : c, g = T + "-" + f;
                f !== F && f.length > 0 && !d("#" + g).length ? (this._id = g, this.rendered && (this.tooltip[0].id = this._id, this.elements.content[0].id = this._id + "-content", this.elements.title[0].id = this._id + "-title")) : a[b] = e
            }, "^prerender":function (a, b, c) {
                c && !this.rendered && this.render(this.options.show.ready)
            }, "^content.text$":function (a, b, c) {
                this._updateContent(c)
            }, "^content.attr$":function (a, b, c, d) {
                this.options.content.text === this.target.attr(d) && this._updateContent(this.target.attr(c))
            }, "^content.title$":function (a, b, d) {
                return d ? (d && !this.elements.title && this._createTitle(), this._updateTitle(d), c) : this._removeTitle()
            }, "^content.button$":function (a, b, c) {
                this._updateButton(c)
            }, "^content.title.(text|button)$":function (a, b, c) {
                this.set("content." + b, c)
            }, "^position.(my|at)$":function (a, b, c) {
                "string" == typeof c && (a[b] = new B(c, "at" === b))
            }, "^position.container$":function (a, b, c) {
                this.rendered && this.tooltip.appendTo(c)
            }, "^show.ready$":function (a, b, c) {
                c && (!this.rendered && this.render(E) || this.toggle(E))
            }, "^style.classes$":function (a, b, c, d) {
                this.rendered && this.tooltip.removeClass(d).addClass(c)
            }, "^style.(width|height)":function (a, b, c) {
                this.rendered && this.tooltip.css(b, c)
            }, "^style.widget|content.title":function () {
                this.rendered && this._setWidget()
            }, "^style.def":function (a, b, c) {
                this.rendered && this.tooltip.toggleClass($, !!c)
            }, "^events.(render|show|move|hide|focus|blur)$":function (a, b, c) {
                this.rendered && this.tooltip[(d.isFunction(c) ? "" : "un") + "bind"]("tooltip" + b, c)
            }, "^(show|hide|position).(event|target|fixed|inactive|leave|distance|viewport|adjust)":function () {
                if (this.rendered) {
                    var a = this.options.position;
                    this.tooltip.attr("tracking", "mouse" === a.target && a.adjust.mouse), this._unassignEvents(), this._assignEvents()
                }
            }}}, A.get = function (a) {
                if (this.destroyed)return this;
                var b = i(this.options, a.toLowerCase()), c = b[0][b[1]];
                return c.precedance ? c.string() : c
            };
            var fb = /^position\.(my|at|adjust|target|container|viewport)|style|content|show\.ready/i, gb = /^prerender|show\.ready/i;
            A.set = function (a, b) {
                if (this.destroyed)return this;
                var e, f = this.rendered, g = F, k = this.options;
                return this.checks, "string" == typeof a ? (e = a, a = {}, a[e] = b) : a = d.extend({}, a), d.each(a, function (b, e) {
                    if (f && gb.test(b))return delete a[b], c;
                    var h, j = i(k, b.toLowerCase());
                    h = j[0][j[1]], j[0][j[1]] = e && e.nodeType ? d(e) : e, g = fb.test(b) || g, a[b] = [j[0], j[1], e, h]
                }), h(k), this.positioning = E, d.each(a, d.proxy(j, this)), this.positioning = F, this.rendered && this.tooltip[0].offsetWidth > 0 && g && this.reposition("mouse" === k.position.target ? G : this.cache.event), this
            }, A._update = function (a, b) {
                var c = this, e = this.cache;
                return this.rendered && a ? (d.isFunction(a) && (a = a.call(this.elements.target, e.event, this) || ""), d.isFunction(a.then) ? (e.waiting = E, a.then(function (a) {
                    return e.waiting = F, c._update(a, b)
                }, G, function (a) {
                    return c._update(a, b)
                })) : a === F || !a && "" !== a ? F : (a.jquery && a.length > 0 ? b.empty().append(a.css({display:"block", visibility:"visible"})) : b.html(a), this._waitForContent(b).then(function (a) {
                    a.images && a.images.length && c.rendered && c.tooltip[0].offsetWidth > 0 && c.reposition(e.event, !a.length)
                }))) : F
            }, A._waitForContent = function (a) {
                var b = this.cache;
                return b.waiting = E, (d.fn.imagesLoaded ? a.imagesLoaded() : d.Deferred().resolve([])).done(function () {
                    b.waiting = F
                }).promise()
            }, A._updateContent = function (a, b) {
                this._update(a, this.elements.content, b)
            }, A._updateTitle = function (a, b) {
                this._update(a, this.elements.title, b) === F && this._removeTitle(F)
            }, A._createTitle = function () {
                var a = this.elements, b = this._id + "-title";
                a.titlebar && this._removeTitle(), a.titlebar = d("<div />", {"class":T + "-titlebar " + (this.options.style.widget ? k("header") : "")}).append(a.title = d("<div />", {id:b, "class":T + "-title", "aria-atomic":E})).insertBefore(a.content).delegate(".qtip-close", "mousedown keydown mouseup keyup mouseout",function (a) {
                    d(this).toggleClass("ui-state-active ui-state-focus", "down" === a.type.substr(-4))
                }).delegate(".qtip-close", "mouseover mouseout", function (a) {
                    d(this).toggleClass("ui-state-hover", "mouseover" === a.type)
                }), this.options.content.button && this._createButton()
            }, A._removeTitle = function (a) {
                var b = this.elements;
                b.title && (b.titlebar.remove(), b.titlebar = b.title = b.button = G, a !== F && this.reposition())
            }, A.reposition = function (c, e) {
                if (!this.rendered || this.positioning || this.destroyed)return this;
                this.positioning = E;
                var f, g, h = this.cache, i = this.tooltip, j = this.options.position, k = j.target, l = j.my, m = j.at, n = j.viewport, o = j.container, p = j.adjust, q = p.method.split(" "), r = i.outerWidth(F), s = i.outerHeight(F), t = 0, u = 0, v = i.css("position"), w = {left:0, top:0}, x = i[0].offsetWidth > 0, y = c && "scroll" === c.type, z = d(a), A = o[0].ownerDocument, B = this.mouse;
                if (d.isArray(k) && 2 === k.length)m = {x:M, y:L}, w = {left:k[0], top:k[1]}; else if ("mouse" === k)m = {x:M, y:L}, !B || !B.pageX || !p.mouse && c && c.pageX ? c && c.pageX || ((!p.mouse || this.options.show.distance) && h.origin && h.origin.pageX ? c = h.origin : (!c || c && ("resize" === c.type || "scroll" === c.type)) && (c = h.event)) : c = B, "static" !== v && (w = o.offset()), A.body.offsetWidth !== (a.innerWidth || A.documentElement.clientWidth) && (g = d(b.body).offset()), w = {left:c.pageX - w.left + (g && g.left || 0), top:c.pageY - w.top + (g && g.top || 0)}, p.mouse && y && B && (w.left -= (B.scrollX || 0) - z.scrollLeft(), w.top -= (B.scrollY || 0) - z.scrollTop()); else {
                    if ("event" === k ? c && c.target && "scroll" !== c.type && "resize" !== c.type ? h.target = d(c.target) : c.target || (h.target = this.elements.target) : "event" !== k && (h.target = d(k.jquery ? k : this.elements.target)), k = h.target, k = d(k).eq(0), 0 === k.length)return this;
                    k[0] === b || k[0] === a ? (t = eb.iOS ? a.innerWidth : k.width(), u = eb.iOS ? a.innerHeight : k.height(), k[0] === a && (w = {top:(n || k).scrollTop(), left:(n || k).scrollLeft()})) : S.imagemap && k.is("area") ? f = S.imagemap(this, k, m, S.viewport ? q : F) : S.svg && k && k[0].ownerSVGElement ? f = S.svg(this, k, m, S.viewport ? q : F) : (t = k.outerWidth(F), u = k.outerHeight(F), w = k.offset()), f && (t = f.width, u = f.height, g = f.offset, w = f.position), w = this.reposition.offset(k, w, o), (eb.iOS > 3.1 && 4.1 > eb.iOS || eb.iOS >= 4.3 && 4.33 > eb.iOS || !eb.iOS && "fixed" === v) && (w.left -= z.scrollLeft(), w.top -= z.scrollTop()), (!f || f && f.adjustable !== F) && (w.left += m.x === O ? t : m.x === P ? t / 2 : 0, w.top += m.y === N ? u : m.y === P ? u / 2 : 0)
                }
                return w.left += p.x + (l.x === O ? -r : l.x === P ? -r / 2 : 0), w.top += p.y + (l.y === N ? -s : l.y === P ? -s / 2 : 0), S.viewport ? (w.adjusted = S.viewport(this, w, j, t, u, r, s), g && w.adjusted.left && (w.left += g.left), g && w.adjusted.top && (w.top += g.top)) : w.adjusted = {left:0, top:0}, this._trigger("move", [w, n.elem || n], c) ? (delete w.adjusted, e === F || !x || isNaN(w.left) || isNaN(w.top) || "mouse" === k || !d.isFunction(j.effect) ? i.css(w) : d.isFunction(j.effect) && (j.effect.call(i, this, d.extend({}, w)), i.queue(function (a) {
                    d(this).css({opacity:"", height:""}), eb.ie && this.style.removeAttribute("filter"), a()
                })), this.positioning = F, this) : this
            }, A.reposition.offset = function (a, c, e) {
                function f(a, b) {
                    c.left += b * a.scrollLeft(), c.top += b * a.scrollTop()
                }

                if (!e[0])return c;
                var g, h, i, j, k = d(a[0].ownerDocument), l = !!eb.ie && "CSS1Compat" !== b.compatMode, m = e[0];
                do"static" !== (h = d.css(m, "position")) && ("fixed" === h ? (i = m.getBoundingClientRect(), f(k, -1)) : (i = d(m).position(), i.left += parseFloat(d.css(m, "borderLeftWidth")) || 0, i.top += parseFloat(d.css(m, "borderTopWidth")) || 0), c.left -= i.left + (parseFloat(d.css(m, "marginLeft")) || 0), c.top -= i.top + (parseFloat(d.css(m, "marginTop")) || 0), g || "hidden" === (j = d.css(m, "overflow")) || "visible" === j || (g = d(m))); while (m = m.offsetParent);
                return g && (g[0] !== k[0] || l) && f(g, 1), c
            };
            var hb = (B = A.reposition.Corner = function (a, b) {
                a = ("" + a).replace(/([A-Z])/, " $1").replace(/middle/gi, P).toLowerCase(), this.x = (a.match(/left|right/i) || a.match(/center/) || ["inherit"])[0].toLowerCase(), this.y = (a.match(/top|bottom|center/i) || ["inherit"])[0].toLowerCase(), this.forceY = !!b;
                var c = a.charAt(0);
                this.precedance = "t" === c || "b" === c ? I : H
            }).prototype;
            hb.invert = function (a, b) {
                this[a] = this[a] === M ? O : this[a] === O ? M : b || this[a]
            }, hb.string = function () {
                var a = this.x, b = this.y;
                return a === b ? a : this.precedance === I || this.forceY && "center" !== b ? b + " " + a : a + " " + b
            }, hb.abbrev = function () {
                var a = this.string().split(" ");
                return a[0].charAt(0) + (a[1] && a[1].charAt(0) || "")
            }, hb.clone = function () {
                return new B(this.string(), this.forceY)
            }, A.toggle = function (a, c) {
                var e = this.cache, f = this.options, g = this.tooltip;
                if (c) {
                    if (/over|enter/.test(c.type) && /out|leave/.test(e.event.type) && f.show.target.add(c.target).length === f.show.target.length && g.has(c.relatedTarget).length)return this;
                    e.event = l(c)
                }
                if (this.waiting && !a && (this.hiddenDuringWait = E), !this.rendered)return a ? this.render(1) : this;
                if (this.destroyed || this.disabled)return this;
                var h, i, j, k = a ? "show" : "hide", m = this.options[k], n = (this.options[a ? "hide" : "show"], this.options.position), o = this.options.content, p = this.tooltip.css("width"), q = this.tooltip.is(":visible"), r = a || 1 === m.target.length, s = !c || 2 > m.target.length || e.target[0] === c.target;
                return(typeof a).search("boolean|number") && (a = !q), h = !g.is(":animated") && q === a && s, i = h ? G : !!this._trigger(k, [90]), this.destroyed ? this : (i !== F && a && this.focus(c), !i || h ? this : (d.attr(g[0], "aria-hidden", !a), a ? (e.origin = l(this.mouse), d.isFunction(o.text) && this._updateContent(o.text, F), d.isFunction(o.title) && this._updateTitle(o.title, F), !D && "mouse" === n.target && n.adjust.mouse && (d(b).bind("mousemove." + T, this._storeMouse), D = E), p || g.css("width", g.outerWidth(F)), this.reposition(c, arguments[2]), p || g.css("width", ""), m.solo && ("string" == typeof m.solo ? d(m.solo) : d(X, m.solo)).not(g).not(m.target).qtip("hide", d.Event("tooltipsolo"))) : (clearTimeout(this.timers.show), delete e.origin, D && !d(X + '[tracking="true"]:visible', m.solo).not(g).length && (d(b).unbind("mousemove." + T), D = F), this.blur(c)), j = d.proxy(function () {
                    a ? (eb.ie && g[0].style.removeAttribute("filter"), g.css("overflow", ""), "string" == typeof m.autofocus && d(this.options.show.autofocus, g).focus(), this.options.show.target.trigger("qtip-" + this.id + "-inactive")) : g.css({display:"", visibility:"", opacity:"", left:"", top:""}), this._trigger(a ? "visible" : "hidden")
                }, this), m.effect === F || r === F ? (g[k](), j()) : d.isFunction(m.effect) ? (g.stop(1, 1), m.effect.call(g, this), g.queue("fx", function (a) {
                    j(), a()
                })) : g.fadeTo(90, a ? 1 : 0, j), a && m.target.trigger("qtip-" + this.id + "-inactive"), this))
            }, A.show = function (a) {
                return this.toggle(E, a)
            }, A.hide = function (a) {
                return this.toggle(F, a)
            }, A.focus = function (a) {
                if (!this.rendered || this.destroyed)return this;
                var b = d(X), c = this.tooltip, e = parseInt(c[0].style.zIndex, 10), f = z.zindex + b.length;
                return c.hasClass(_) || this._trigger("focus", [f], a) && (e !== f && (b.each(function () {
                    this.style.zIndex > e && (this.style.zIndex = this.style.zIndex - 1)
                }), b.filter("." + _).qtip("blur", a)), c.addClass(_)[0].style.zIndex = f), this
            }, A.blur = function (a) {
                return!this.rendered || this.destroyed ? this : (this.tooltip.removeClass(_), this._trigger("blur", [this.tooltip.css("zIndex")], a), this)
            }, A.disable = function (a) {
                return this.destroyed ? this : ("toggle" === a ? a = !(this.rendered ? this.tooltip.hasClass(bb) : this.disabled) : "boolean" != typeof a && (a = E), this.rendered && this.tooltip.toggleClass(bb, a).attr("aria-disabled", a), this.disabled = !!a, this)
            }, A.enable = function () {
                return this.disable(F)
            }, A._createButton = function () {
                var a = this, b = this.elements, c = b.tooltip, e = this.options.content.button, f = "string" == typeof e, g = f ? e : "Close tooltip";
                b.button && b.button.remove(), b.button = e.jquery ? e : d("<a />", {"class":"qtip-close " + (this.options.style.widget ? "" : T + "-icon"), title:g, "aria-label":g}).prepend(d("<span />", {"class":"ui-icon ui-icon-close", html:"&times;"})), b.button.appendTo(b.titlebar || c).attr("role", "button").click(function (b) {
                    return c.hasClass(bb) || a.hide(b), F
                })
            }, A._updateButton = function (a) {
                if (!this.rendered)return F;
                var b = this.elements.button;
                a ? this._createButton() : b.remove()
            }, A._setWidget = function () {
                var a = this.options.style.widget, b = this.elements, c = b.tooltip, d = c.hasClass(bb);
                c.removeClass(bb), bb = a ? "ui-state-disabled" : "qtip-disabled", c.toggleClass(bb, d), c.toggleClass("ui-helper-reset " + k(), a).toggleClass($, this.options.style.def && !a), b.content && b.content.toggleClass(k("content"), a), b.titlebar && b.titlebar.toggleClass(k("header"), a), b.button && b.button.toggleClass(T + "-icon", !a)
            }, A._storeMouse = function (a) {
                (this.mouse = l(a)).type = "mousemove"
            }, A._bind = function (a, b, c, e, f) {
                var g = "." + this._id + (e ? "-" + e : "");
                b.length && d(a).bind((b.split ? b : b.join(g + " ")) + g, d.proxy(c, f || this))
            }, A._unbind = function (a, b) {
                d(a).unbind("." + this._id + (b ? "-" + b : ""))
            };
            var ib = "." + T;
            d(function () {
                r(X, ["mouseenter", "mouseleave"], function (a) {
                    var b = "mouseenter" === a.type, c = d(a.currentTarget), e = d(a.relatedTarget || a.target), f = this.options;
                    b ? (this.focus(a), c.hasClass(Z) && !c.hasClass(bb) && clearTimeout(this.timers.hide)) : "mouse" === f.position.target && f.hide.event && f.show.target && !e.closest(f.show.target[0]).length && this.hide(a), c.toggleClass(ab, b)
                }), r("[" + V + "]", Y, p)
            }), A._trigger = function (a, b, c) {
                var e = d.Event("tooltip" + a);
                return e.originalEvent = c && d.extend({}, c) || this.cache.event || G, this.triggering = a, this.tooltip.trigger(e, [this].concat(b || [])), this.triggering = F, !e.isDefaultPrevented()
            }, A._bindEvents = function (a, b, e, f, g, h) {
                if (f.add(e).length === f.length) {
                    var i = [];
                    b = d.map(b, function (b) {
                        var e = d.inArray(b, a);
                        return e > -1 ? (i.push(a.splice(e, 1)[0]), c) : b
                    }), i.length && this._bind(e, i, function (a) {
                        var b = this.rendered ? this.tooltip[0].offsetWidth > 0 : !1;
                        (b ? h : g).call(this, a)
                    })
                }
                this._bind(e, a, g), this._bind(f, b, h)
            }, A._assignInitialEvents = function (a) {
                function b(a) {
                    return this.disabled || this.destroyed ? F : (this.cache.event = l(a), this.cache.target = a ? d(a.target) : [c], clearTimeout(this.timers.show), this.timers.show = m.call(this, function () {
                        this.render("object" == typeof a || e.show.ready)
                    }, e.show.delay), c)
                }

                var e = this.options, f = e.show.target, g = e.hide.target, h = e.show.event ? d.trim("" + e.show.event).split(" ") : [], i = e.hide.event ? d.trim("" + e.hide.event).split(" ") : [];
                /mouse(over|enter)/i.test(e.show.event) && !/mouse(out|leave)/i.test(e.hide.event) && i.push("mouseleave"), this._bind(f, "mousemove", function (a) {
                    this._storeMouse(a), this.cache.onTarget = E
                }), this._bindEvents(h, i, f, g, b, function () {
                    clearTimeout(this.timers.show)
                }), (e.show.ready || e.prerender) && b.call(this, a)
            }, A._assignEvents = function () {
                var c = this, e = this.options, f = e.position, g = this.tooltip, h = e.show.target, i = e.hide.target, j = f.container, k = f.viewport, l = d(b), m = (d(b.body), d(a)), r = e.show.event ? d.trim("" + e.show.event).split(" ") : [], s = e.hide.event ? d.trim("" + e.hide.event).split(" ") : [];
                d.each(e.events, function (a, b) {
                    c._bind(g, "toggle" === a ? ["tooltipshow", "tooltiphide"] : ["tooltip" + a], b, null, g)
                }), /mouse(out|leave)/i.test(e.hide.event) && "window" === e.hide.leave && this._bind(l, ["mouseout", "blur"], function (a) {
                    /select|option/.test(a.target.nodeName) || a.relatedTarget || this.hide(a)
                }), e.hide.fixed ? i = i.add(g.addClass(Z)) : /mouse(over|enter)/i.test(e.show.event) && this._bind(i, "mouseleave", function () {
                    clearTimeout(this.timers.show)
                }), ("" + e.hide.event).indexOf("unfocus") > -1 && this._bind(j.closest("html"), ["mousedown", "touchstart"], function (a) {
                    var b = d(a.target), c = this.rendered && !this.tooltip.hasClass(bb) && this.tooltip[0].offsetWidth > 0, e = b.parents(X).filter(this.tooltip[0]).length > 0;
                    b[0] === this.target[0] || b[0] === this.tooltip[0] || e || this.target.has(b[0]).length || !c || this.hide(a)
                }), "number" == typeof e.hide.inactive && (this._bind(h, "qtip-" + this.id + "-inactive", p), this._bind(i.add(g), z.inactiveEvents, p, "-inactive")), this._bindEvents(r, s, h, i, n, o), this._bind(h.add(g), "mousemove", function (a) {
                    if ("number" == typeof e.hide.distance) {
                        var b = this.cache.origin || {}, c = this.options.hide.distance, d = Math.abs;
                        (d(a.pageX - b.pageX) >= c || d(a.pageY - b.pageY) >= c) && this.hide(a)
                    }
                    this._storeMouse(a)
                }), "mouse" === f.target && f.adjust.mouse && (e.hide.event && this._bind(h, ["mouseenter", "mouseleave"], function (a) {
                    this.cache.onTarget = "mouseenter" === a.type
                }), this._bind(l, "mousemove", function (a) {
                    this.rendered && this.cache.onTarget && !this.tooltip.hasClass(bb) && this.tooltip[0].offsetWidth > 0 && this.reposition(a)
                })), (f.adjust.resize || k.length) && this._bind(d.event.special.resize ? k : m, "resize", q), f.adjust.scroll && this._bind(m.add(f.container), "scroll", q)
            }, A._unassignEvents = function () {
                var c = [this.options.show.target[0], this.options.hide.target[0], this.rendered && this.tooltip[0], this.options.position.container[0], this.options.position.viewport[0], this.options.position.container.closest("html")[0], a, b];
                this._unbind(d([]).pushStack(d.grep(c, function (a) {
                    return"object" == typeof a
                })))
            }, z = d.fn.qtip = function (a, b, e) {
                var f = ("" + a).toLowerCase(), g = G, i = d.makeArray(arguments).slice(1), j = i[i.length - 1], k = this[0] ? d.data(this[0], T) : G;
                return!arguments.length && k || "api" === f ? k : "string" == typeof a ? (this.each(function () {
                    var a = d.data(this, T);
                    if (!a)return E;
                    if (j && j.timeStamp && (a.cache.event = j), !b || "option" !== f && "options" !== f)a[f] && a[f].apply(a, i); else {
                        if (e === c && !d.isPlainObject(b))return g = a.get(b), F;
                        a.set(b, e)
                    }
                }), g !== G ? g : this) : "object" != typeof a && arguments.length ? c : (k = h(d.extend(E, {}, a)), this.each(function (a) {
                    var b, e;
                    return e = d.isArray(k.id) ? k.id[a] : k.id, e = !e || e === F || 1 > e.length || z.api[e] ? z.nextid++ : e, b = s(d(this), e, k), b === F ? E : (z.api[e] = b, d.each(S, function () {
                        "initialize" === this.initialize && this(b)
                    }), b._assignInitialEvents(j), c)
                }))
            }, d.qtip = e, z.api = {}, d.each({attr:function (a, b) {
                if (this.length) {
                    var c = this[0], e = "title", f = d.data(c, "qtip");
                    if (a === e && f && "object" == typeof f && f.options.suppress)return 2 > arguments.length ? d.attr(c, db) : (f && f.options.content.attr === e && f.cache.attr && f.set("content.text", b), this.attr(db, b))
                }
                return d.fn["attr" + cb].apply(this, arguments)
            }, clone:function (a) {
                var b = (d([]), d.fn["clone" + cb].apply(this, arguments));
                return a || b.filter("[" + db + "]").attr("title",function () {
                    return d.attr(this, db)
                }).removeAttr(db), b
            }}, function (a, b) {
                if (!b || d.fn[a + cb])return E;
                var c = d.fn[a + cb] = d.fn[a];
                d.fn[a] = function () {
                    return b.apply(this, arguments) || c.apply(this, arguments)
                }
            }), d.ui || (d["cleanData" + cb] = d.cleanData, d.cleanData = function (a) {
                for (var b, c = 0; (b = d(a[c])).length; c++)if (b.attr(U))try {
                    b.triggerHandler("removeqtip")
                } catch (e) {
                }
                d["cleanData" + cb].apply(this, arguments)
            }), z.version = "2.2.0", z.nextid = 0, z.inactiveEvents = Y, z.zindex = 15e3, z.defaults = {prerender:F, id:F, overwrite:E, suppress:E, content:{text:E, attr:"title", title:F, button:F}, position:{my:"top left", at:"bottom right", target:F, container:F, viewport:F, adjust:{x:0, y:0, mouse:E, scroll:E, resize:E, method:"flipinvert flipinvert"}, effect:function (a, b) {
                d(this).animate(b, {duration:200, queue:F})
            }}, show:{target:F, event:"mouseenter", effect:E, delay:90, solo:F, ready:F, autofocus:F}, hide:{target:F, event:"mouseleave", effect:E, delay:0, fixed:F, inactive:F, leave:"window", distance:F}, style:{classes:"", widget:F, width:F, height:F, def:E}, events:{render:G, move:G, show:G, hide:G, toggle:G, visible:G, hidden:G, focus:G, blur:G}};
            var jb, kb = "margin", lb = "border", mb = "color", nb = "background-color", ob = "transparent", pb = " !important", qb = !!b.createElement("canvas").getContext, rb = /rgba?\(0, 0, 0(, 0)?\)|transparent|#123456/i, sb = {}, tb = ["Webkit", "O", "Moz", "ms"];
            if (qb)var ub = a.devicePixelRatio || 1, vb = function () {
                var a = b.createElement("canvas").getContext("2d");
                return a.backingStorePixelRatio || a.webkitBackingStorePixelRatio || a.mozBackingStorePixelRatio || a.msBackingStorePixelRatio || a.oBackingStorePixelRatio || 1
            }(), wb = ub / vb; else var xb = function (a, b, c) {
                return"<qtipvml:" + a + ' xmlns="urn:schemas-microsoft.com:vml" class="qtip-vml" ' + (b || "") + ' style="behavior: url(#default#VML); ' + (c || "") + '" />'
            };
            d.extend(w.prototype, {init:function (a) {
                var b, c;
                c = this.element = a.elements.tip = d("<div />", {"class":T + "-tip"}).prependTo(a.tooltip), qb ? (b = d("<canvas />").appendTo(this.element)[0].getContext("2d"), b.lineJoin = "miter", b.miterLimit = 1e5, b.save()) : (b = xb("shape", 'coordorigin="0,0"', "position:absolute;"), this.element.html(b + b), a._bind(d("*", c).add(c), ["click", "mousedown"], function (a) {
                    a.stopPropagation()
                }, this._ns)), a._bind(a.tooltip, "tooltipmove", this.reposition, this._ns, this), this.create()
            }, _swapDimensions:function () {
                this.size[0] = this.options.height, this.size[1] = this.options.width
            }, _resetDimensions:function () {
                this.size[0] = this.options.width, this.size[1] = this.options.height
            }, _useTitle:function (a) {
                var b = this.qtip.elements.titlebar;
                return b && (a.y === L || a.y === P && this.element.position().top + this.size[1] / 2 + this.options.offset < b.outerHeight(E))
            }, _parseCorner:function (a) {
                var b = this.qtip.options.position.my;
                return a === F || b === F ? a = F : a === E ? a = new B(b.string()) : a.string || (a = new B(a), a.fixed = E), a
            }, _parseWidth:function (a, b, c) {
                var d = this.qtip.elements, e = lb + t(b) + "Width";
                return(c ? v(c, e) : v(d.content, e) || v(this._useTitle(a) && d.titlebar || d.content, e) || v(d.tooltip, e)) || 0
            }, _parseRadius:function (a) {
                var b = this.qtip.elements, c = lb + t(a.y) + t(a.x) + "Radius";
                return 9 > eb.ie ? 0 : v(this._useTitle(a) && b.titlebar || b.content, c) || v(b.tooltip, c) || 0
            }, _invalidColour:function (a, b, c) {
                var d = a.css(b);
                return!d || c && d === a.css(c) || rb.test(d) ? F : d
            }, _parseColours:function (a) {
                var b = this.qtip.elements, c = this.element.css("cssText", ""), e = lb + t(a[a.precedance]) + t(mb), f = this._useTitle(a) && b.titlebar || b.content, g = this._invalidColour, h = [];
                return h[0] = g(c, nb) || g(f, nb) || g(b.content, nb) || g(b.tooltip, nb) || c.css(nb), h[1] = g(c, e, mb) || g(f, e, mb) || g(b.content, e, mb) || g(b.tooltip, e, mb) || b.tooltip.css(e), d("*", c).add(c).css("cssText", nb + ":" + ob + pb + ";" + lb + ":0" + pb + ";"), h
            }, _calculateSize:function (a) {
                var b, c, d, e = a.precedance === I, f = this.options.width, g = this.options.height, h = "c" === a.abbrev(), i = (e ? f : g) * (h ? .5 : 1), j = Math.pow, k = Math.round, l = Math.sqrt(j(i, 2) + j(g, 2)), m = [this.border / i * l, this.border / g * l];
                return m[2] = Math.sqrt(j(m[0], 2) - j(this.border, 2)), m[3] = Math.sqrt(j(m[1], 2) - j(this.border, 2)), b = l + m[2] + m[3] + (h ? 0 : m[0]), c = b / l, d = [k(c * f), k(c * g)], e ? d : d.reverse()
            }, _calculateTip:function (a, b, c) {
                c = c || 1, b = b || this.size;
                var d = b[0] * c, e = b[1] * c, f = Math.ceil(d / 2), g = Math.ceil(e / 2), h = {br:[0, 0, d, e, d, 0], bl:[0, 0, d, 0, 0, e], tr:[0, e, d, 0, d, e], tl:[0, 0, 0, e, d, e], tc:[0, e, f, 0, d, e], bc:[0, 0, d, 0, f, e], rc:[0, 0, d, g, 0, e], lc:[d, 0, d, e, 0, g]};
                return h.lt = h.br, h.rt = h.bl, h.lb = h.tr, h.rb = h.tl, h[a.abbrev()]
            }, _drawCoords:function (a, b) {
                a.beginPath(), a.moveTo(b[0], b[1]), a.lineTo(b[2], b[3]), a.lineTo(b[4], b[5]), a.closePath()
            }, create:function () {
                var a = this.corner = (qb || eb.ie) && this._parseCorner(this.options.corner);
                return(this.enabled = !!this.corner && "c" !== this.corner.abbrev()) && (this.qtip.cache.corner = a.clone(), this.update()), this.element.toggle(this.enabled), this.corner
            }, update:function (b, c) {
                if (!this.enabled)return this;
                var e, f, g, h, i, j, k, l, m = this.qtip.elements, n = this.element, o = n.children(), p = this.options, q = this.size, r = p.mimic, s = Math.round;
                b || (b = this.qtip.cache.corner || this.corner), r === F ? r = b : (r = new B(r), r.precedance = b.precedance, "inherit" === r.x ? r.x = b.x : "inherit" === r.y ? r.y = b.y : r.x === r.y && (r[b.precedance] = b[b.precedance])), f = r.precedance, b.precedance === H ? this._swapDimensions() : this._resetDimensions(), e = this.color = this._parseColours(b), e[1] !== ob ? (l = this.border = this._parseWidth(b, b[b.precedance]), p.border && 1 > l && !rb.test(e[1]) && (e[0] = e[1]), this.border = l = p.border !== E ? p.border : l) : this.border = l = 0, k = this.size = this._calculateSize(b), n.css({width:k[0], height:k[1], lineHeight:k[1] + "px"}), j = b.precedance === I ? [s(r.x === M ? l : r.x === O ? k[0] - q[0] - l : (k[0] - q[0]) / 2), s(r.y === L ? k[1] - q[1] : 0)] : [s(r.x === M ? k[0] - q[0] : 0), s(r.y === L ? l : r.y === N ? k[1] - q[1] - l : (k[1] - q[1]) / 2)], qb ? (g = o[0].getContext("2d"), g.restore(), g.save(), g.clearRect(0, 0, 6e3, 6e3), h = this._calculateTip(r, q, wb), i = this._calculateTip(r, this.size, wb), o.attr(J, k[0] * wb).attr(K, k[1] * wb), o.css(J, k[0]).css(K, k[1]), this._drawCoords(g, i), g.fillStyle = e[1], g.fill(), g.translate(j[0] * wb, j[1] * wb), this._drawCoords(g, h), g.fillStyle = e[0], g.fill()) : (h = this._calculateTip(r), h = "m" + h[0] + "," + h[1] + " l" + h[2] + "," + h[3] + " " + h[4] + "," + h[5] + " xe", j[2] = l && /^(r|b)/i.test(b.string()) ? 8 === eb.ie ? 2 : 1 : 0, o.css({coordsize:k[0] + l + " " + (k[1] + l), antialias:"" + (r.string().indexOf(P) > -1), left:j[0] - j[2] * Number(f === H), top:j[1] - j[2] * Number(f === I), width:k[0] + l, height:k[1] + l}).each(function (a) {
                    var b = d(this);
                    b[b.prop ? "prop" : "attr"]({coordsize:k[0] + l + " " + (k[1] + l), path:h, fillcolor:e[0], filled:!!a, stroked:!a}).toggle(!(!l && !a)), !a && b.html(xb("stroke", 'weight="' + 2 * l + 'px" color="' + e[1] + '" miterlimit="1000" joinstyle="miter"'))
                })), a.opera && setTimeout(function () {
                    m.tip.css({display:"inline-block", visibility:"visible"})
                }, 1), c !== F && this.calculate(b, k)
            }, calculate:function (a, b) {
                if (!this.enabled)return F;
                var c, e, f = this, g = this.qtip.elements, h = this.element, i = this.options.offset, j = (g.tooltip.hasClass("ui-widget"), {});
                return a = a || this.corner, c = a.precedance, b = b || this._calculateSize(a), e = [a.x, a.y], c === H && e.reverse(), d.each(e, function (d, e) {
                    var h, k, l;
                    e === P ? (h = c === I ? M : L, j[h] = "50%", j[kb + "-" + h] = -Math.round(b[c === I ? 0 : 1] / 2) + i) : (h = f._parseWidth(a, e, g.tooltip), k = f._parseWidth(a, e, g.content), l = f._parseRadius(a), j[e] = Math.max(-f.border, d ? k : i + (l > h ? l : -h)))
                }), j[a[c]] -= b[c === H ? 0 : 1], h.css({margin:"", top:"", bottom:"", left:"", right:""}).css(j), j
            }, reposition:function (a, b, d) {
                function e(a, b, c, d, e) {
                    a === R && j.precedance === b && k[d] && j[c] !== P ? j.precedance = j.precedance === H ? I : H : a !== R && k[d] && (j[b] = j[b] === P ? k[d] > 0 ? d : e : j[b] === d ? e : d)
                }

                function f(a, b, e) {
                    j[a] === P ? p[kb + "-" + b] = o[a] = g[kb + "-" + b] - k[b] : (h = g[e] !== c ? [k[b], -g[b]] : [-k[b], g[b]], (o[a] = Math.max(h[0], h[1])) > h[0] && (d[b] -= k[b], o[b] = F), p[g[e] !== c ? e : b] = o[a])
                }

                if (this.enabled) {
                    var g, h, i = b.cache, j = this.corner.clone(), k = d.adjusted, l = b.options.position.adjust.method.split(" "), m = l[0], n = l[1] || l[0], o = {left:F, top:F, x:0, y:0}, p = {};
                    this.corner.fixed !== E && (e(m, H, I, M, O), e(n, I, H, L, N), j.string() === i.corner.string() || i.cornerTop === k.top && i.cornerLeft === k.left || this.update(j, F)), g = this.calculate(j), g.right !== c && (g.left = -g.right), g.bottom !== c && (g.top = -g.bottom), g.user = this.offset, (o.left = m === R && !!k.left) && f(H, M, O), (o.top = n === R && !!k.top) && f(I, L, N), this.element.css(p).toggle(!(o.x && o.y || j.x === P && o.y || j.y === P && o.x)), d.left -= g.left.charAt ? g.user : m !== R || o.top || !o.left && !o.top ? g.left + this.border : 0, d.top -= g.top.charAt ? g.user : n !== R || o.left || !o.left && !o.top ? g.top + this.border : 0, i.cornerLeft = k.left, i.cornerTop = k.top, i.corner = j.clone()
                }
            }, destroy:function () {
                this.qtip._unbind(this.qtip.tooltip, this._ns), this.qtip.elements.tip && this.qtip.elements.tip.find("*").remove().end().remove()
            }}), jb = S.tip = function (a) {
                return new w(a, a.options.style.tip)
            }, jb.initialize = "render", jb.sanitize = function (a) {
                if (a.style && "tip"in a.style) {
                    var b = a.style.tip;
                    "object" != typeof b && (b = a.style.tip = {corner:b}), /string|boolean/i.test(typeof b.corner) || (b.corner = E)
                }
            }, C.tip = {"^position.my|style.tip.(corner|mimic|border)$":function () {
                this.create(), this.qtip.reposition()
            }, "^style.tip.(height|width)$":function (a) {
                this.size = [a.width, a.height], this.update(), this.qtip.reposition()
            }, "^content.title|style.(classes|widget)$":function () {
                this.update()
            }}, d.extend(E, z.defaults, {style:{tip:{corner:E, mimic:F, width:6, height:6, border:E, offset:0}}});
            var yb, zb, Ab = "qtip-modal", Bb = "." + Ab;
            zb = function () {
                function a(a) {
                    if (d.expr[":"].focusable)return d.expr[":"].focusable;
                    var b, c, e, f = !isNaN(d.attr(a, "tabindex")), g = a.nodeName && a.nodeName.toLowerCase();
                    return"area" === g ? (b = a.parentNode, c = b.name, a.href && c && "map" === b.nodeName.toLowerCase() ? (e = d("img[usemap=#" + c + "]")[0], !!e && e.is(":visible")) : !1) : /input|select|textarea|button|object/.test(g) ? !a.disabled : "a" === g ? a.href || f : f
                }

                function c(a) {
                    1 > k.length && a.length ? a.not("body").blur() : k.first().focus()
                }

                function e(a) {
                    if (i.is(":visible")) {
                        var b, e = d(a.target), h = f.tooltip, j = e.closest(X);
                        b = 1 > j.length ? F : parseInt(j[0].style.zIndex, 10) > parseInt(h[0].style.zIndex, 10), b || e.closest(X)[0] === h[0] || c(e), g = a.target === k[k.length - 1]
                    }
                }

                var f, g, h, i, j = this, k = {};
                d.extend(j, {init:function () {
                    return i = j.elem = d("<div />", {id:"qtip-overlay", html:"<div></div>", mousedown:function () {
                        return F
                    }}).hide(), d(b.body).bind("focusin" + Bb, e), d(b).bind("keydown" + Bb, function (a) {
                        f && f.options.show.modal.escape && 27 === a.keyCode && f.hide(a)
                    }), i.bind("click" + Bb, function (a) {
                        f && f.options.show.modal.blur && f.hide(a)
                    }), j
                }, update:function (b) {
                    f = b, k = b.options.show.modal.stealfocus !== F ? b.tooltip.find("*").filter(function () {
                        return a(this)
                    }) : []
                }, toggle:function (a, e, g) {
                    var k = (d(b.body), a.tooltip), l = a.options.show.modal, m = l.effect, n = e ? "show" : "hide", o = i.is(":visible"), p = d(Bb).filter(":visible:not(:animated)").not(k);
                    return j.update(a), e && l.stealfocus !== F && c(d(":focus")), i.toggleClass("blurs", l.blur), e && i.appendTo(b.body), i.is(":animated") && o === e && h !== F || !e && p.length ? j : (i.stop(E, F), d.isFunction(m) ? m.call(i, e) : m === F ? i[n]() : i.fadeTo(parseInt(g, 10) || 90, e ? 1 : 0, function () {
                        e || i.hide()
                    }), e || i.queue(function (a) {
                        i.css({left:"", top:""}), d(Bb).length || i.detach(), a()
                    }), h = e, f.destroyed && (f = G), j)
                }}), j.init()
            }, zb = new zb, d.extend(x.prototype, {init:function (a) {
                var b = a.tooltip;
                return this.options.on ? (a.elements.overlay = zb.elem, b.addClass(Ab).css("z-index", z.modal_zindex + d(Bb).length), a._bind(b, ["tooltipshow", "tooltiphide"], function (a, c, e) {
                    var f = a.originalEvent;
                    if (a.target === b[0])if (f && "tooltiphide" === a.type && /mouse(leave|enter)/.test(f.type) && d(f.relatedTarget).closest(zb.elem[0]).length)try {
                        a.preventDefault()
                    } catch (g) {
                    } else(!f || f && "tooltipsolo" !== f.type) && this.toggle(a, "tooltipshow" === a.type, e)
                }, this._ns, this), a._bind(b, "tooltipfocus", function (a, c) {
                    if (!a.isDefaultPrevented() && a.target === b[0]) {
                        var e = d(Bb), f = z.modal_zindex + e.length, g = parseInt(b[0].style.zIndex, 10);
                        zb.elem[0].style.zIndex = f - 1, e.each(function () {
                            this.style.zIndex > g && (this.style.zIndex -= 1)
                        }), e.filter("." + _).qtip("blur", a.originalEvent), b.addClass(_)[0].style.zIndex = f, zb.update(c);
                        try {
                            a.preventDefault()
                        } catch (h) {
                        }
                    }
                }, this._ns, this), a._bind(b, "tooltiphide", function (a) {
                    a.target === b[0] && d(Bb).filter(":visible").not(b).last().qtip("focus", a)
                }, this._ns, this), c) : this
            }, toggle:function (a, b, d) {
                return a && a.isDefaultPrevented() ? this : (zb.toggle(this.qtip, !!b, d), c)
            }, destroy:function () {
                this.qtip.tooltip.removeClass(Ab), this.qtip._unbind(this.qtip.tooltip, this._ns), zb.toggle(this.qtip, F), delete this.qtip.elements.overlay
            }}), yb = S.modal = function (a) {
                return new x(a, a.options.show.modal)
            }, yb.sanitize = function (a) {
                a.show && ("object" != typeof a.show.modal ? a.show.modal = {on:!!a.show.modal} : a.show.modal.on === c && (a.show.modal.on = E))
            }, z.modal_zindex = z.zindex - 200, yb.initialize = "render", C.modal = {"^show.modal.(on|blur)$":function () {
                this.destroy(), this.init(), this.qtip.elems.overlay.toggle(this.qtip.tooltip[0].offsetWidth > 0)
            }}, d.extend(E, z.defaults, {show:{modal:{on:F, effect:E, blur:E, stealfocus:E, escape:E}}}), S.viewport = function (c, d, e, f, g, h, i) {
                function j(a, b, c, e, f, g, h, i, j) {
                    var k = d[f], m = v[a], t = w[a], u = c === R, x = m === f ? j : m === g ? -j : -j / 2, y = t === f ? i : t === g ? -i : -i / 2, z = r[f] + s[f] - (o ? 0 : n[f]), A = z - k, B = k + j - (h === J ? p : q) - z, C = x - (v.precedance === a || m === v[b] ? y : 0) - (t === P ? i / 2 : 0);
                    return u ? (C = (m === f ? 1 : -1) * x, d[f] += A > 0 ? A : B > 0 ? -B : 0, d[f] = Math.max(-n[f] + s[f], k - C, Math.min(Math.max(-n[f] + s[f] + (h === J ? p : q), k + C), d[f], "center" === m ? k - x : 1e9))) : (e *= c === Q ? 2 : 0, A > 0 && (m !== f || B > 0) ? (d[f] -= C + e, l.invert(a, f)) : B > 0 && (m !== g || A > 0) && (d[f] -= (m === P ? -C : C) + e, l.invert(a, g)), r > d[f] && -d[f] > B && (d[f] = k, l = v.clone())), d[f] - k
                }

                var k, l, m, n, o, p, q, r, s, t = e.target, u = c.elements.tooltip, v = e.my, w = e.at, x = e.adjust, y = x.method.split(" "), z = y[0], A = y[1] || y[0], B = e.viewport, C = e.container, D = c.cache, E = {left:0, top:0};
                return B.jquery && t[0] !== a && t[0] !== b.body && "none" !== x.method ? (n = C.offset() || E, o = "static" === C.css("position"), k = "fixed" === u.css("position"), p = B[0] === a ? B.width() : B.outerWidth(F), q = B[0] === a ? B.height() : B.outerHeight(F), r = {left:k ? 0 : B.scrollLeft(), top:k ? 0 : B.scrollTop()}, s = B.offset() || E, ("shift" !== z || "shift" !== A) && (l = v.clone()), E = {left:"none" !== z ? j(H, I, z, x.x, M, O, J, f, h) : 0, top:"none" !== A ? j(I, H, A, x.y, L, N, K, g, i) : 0}, l && D.lastClass !== (m = T + "-pos-" + l.abbrev()) && u.removeClass(c.cache.lastClass).addClass(c.cache.lastClass = m), E) : E
            }, S.polys = {polygon:function (a, b) {
                var c, d, e, f = {width:0, height:0, position:{top:1e10, right:0, bottom:0, left:1e10}, adjustable:F}, g = 0, h = [], i = 1, j = 1, k = 0, l = 0;
                for (g = a.length; g--;)c = [parseInt(a[--g], 10), parseInt(a[g + 1], 10)], c[0] > f.position.right && (f.position.right = c[0]), c[0] < f.position.left && (f.position.left = c[0]), c[1] > f.position.bottom && (f.position.bottom = c[1]), c[1] < f.position.top && (f.position.top = c[1]), h.push(c);
                if (d = f.width = Math.abs(f.position.right - f.position.left), e = f.height = Math.abs(f.position.bottom - f.position.top), "c" === b.abbrev())f.position = {left:f.position.left + f.width / 2, top:f.position.top + f.height / 2}; else {
                    for (; d > 0 && e > 0 && i > 0 && j > 0;)for (d = Math.floor(d / 2), e = Math.floor(e / 2), b.x === M ? i = d : b.x === O ? i = f.width - d : i += Math.floor(d / 2), b.y === L ? j = e : b.y === N ? j = f.height - e : j += Math.floor(e / 2), g = h.length; g-- && !(2 > h.length);)k = h[g][0] - f.position.left, l = h[g][1] - f.position.top, (b.x === M && k >= i || b.x === O && i >= k || b.x === P && (i > k || k > f.width - i) || b.y === L && l >= j || b.y === N && j >= l || b.y === P && (j > l || l > f.height - j)) && h.splice(g, 1);
                    f.position = {left:h[0][0], top:h[0][1]}
                }
                return f
            }, rect:function (a, b, c, d) {
                return{width:Math.abs(c - a), height:Math.abs(d - b), position:{left:Math.min(a, c), top:Math.min(b, d)}}
            }, _angles:{tc:1.5, tr:7 / 4, tl:5 / 4, bc:.5, br:.25, bl:.75, rc:2, lc:1, c:0}, ellipse:function (a, b, c, d, e) {
                var f = S.polys._angles[e.abbrev()], g = 0 === f ? 0 : c * Math.cos(f * Math.PI), h = d * Math.sin(f * Math.PI);
                return{width:2 * c - Math.abs(g), height:2 * d - Math.abs(h), position:{left:a + g, top:b + h}, adjustable:F}
            }, circle:function (a, b, c, d) {
                return S.polys.ellipse(a, b, c, c, d)
            }}, S.svg = function (a, c, e) {
                for (var f, g, h, i, j, k, l, m, n, o = (d(b), c[0]), p = d(o.ownerSVGElement), q = o.ownerDocument, r = (parseInt(c.css("stroke-width"), 10) || 0) / 2, s = !0; !o.getBBox;)o = o.parentNode;
                if (!o.getBBox || !o.parentNode)return F;
                switch (o.nodeName) {
                    case"ellipse":
                    case"circle":
                        m = S.polys.ellipse(o.cx.baseVal.value, o.cy.baseVal.value, (o.rx || o.r).baseVal.value + r, (o.ry || o.r).baseVal.value + r, e);
                        break;
                    case"line":
                    case"polygon":
                    case"polyline":
                        for (l = o.points || [
                            {x:o.x1.baseVal.value, y:o.y1.baseVal.value},
                            {x:o.x2.baseVal.value, y:o.y2.baseVal.value}
                        ], m = [], k = -1, i = l.numberOfItems || l.length; i > ++k;)j = l.getItem ? l.getItem(k) : l[k], m.push.apply(m, [j.x, j.y]);
                        m = S.polys.polygon(m, e);
                        break;
                    default:
                        m = o.getBoundingClientRect(), m = {width:m.width, height:m.height, position:{left:m.left, top:m.top}}, s = !1
                }
                if (n = m.position, p = p[0], s && p.createSVGPoint && (g = o.getScreenCTM(), l = p.createSVGPoint(), l.x = n.left, l.y = n.top, h = l.matrixTransform(g), n.left = h.x, n.top = h.y), q !== b) {
                    var f = d((q.defaultView || q.parentWindow).frameElement).offset();
                    f && (n.left += f.left, n.top += f.top)
                }
                return q = d(q), n.left += q.scrollLeft(), n.top += q.scrollTop(), m
            }, S.imagemap = function (a, b, c) {
                b.jquery || (b = d(b));
                var e, f, g, h, i, j = b.attr("shape").toLowerCase().replace("poly", "polygon"), k = d('img[usemap="#' + b.parent("map").attr("name") + '"]'), l = d.trim(b.attr("coords")), m = l.replace(/,$/, "").split(",");
                if (!k.length)return F;
                if ("polygon" === j)h = S.polys.polygon(m, c); else {
                    if (!S.polys[j])return F;
                    for (g = -1, i = m.length, f = []; i > ++g;)f.push(parseInt(m[g], 10));
                    h = S.polys[j].apply(this, f.concat(c))
                }
                return e = k.offset(), e.left += Math.ceil((k.outerWidth(F) - k.width()) / 2), e.top += Math.ceil((k.outerHeight(F) - k.height()) / 2), h.position.left += e.left, h.position.top += e.top, h
            };
            var Cb, Db = '<iframe class="qtip-bgiframe" frameborder="0" tabindex="-1" src="javascript:\'\';"  style="display:block; position:absolute; z-index:-1; filter:alpha(opacity=0); -ms-filter:"progid:DXImageTransform.Microsoft.Alpha(Opacity=0)";"></iframe>';
            d.extend(y.prototype, {_scroll:function () {
                var b = this.qtip.elements.overlay;
                b && (b[0].style.top = d(a).scrollTop() + "px")
            }, init:function (c) {
                var e = c.tooltip;
                1 > d("select, object").length && (this.bgiframe = c.elements.bgiframe = d(Db).appendTo(e), c._bind(e, "tooltipmove", this.adjustBGIFrame, this._ns, this)), this.redrawContainer = d("<div/>", {id:T + "-rcontainer"}).appendTo(b.body), c.elements.overlay && c.elements.overlay.addClass("qtipmodal-ie6fix") && (c._bind(a, ["scroll", "resize"], this._scroll, this._ns, this), c._bind(e, ["tooltipshow"], this._scroll, this._ns, this)), this.redraw()
            }, adjustBGIFrame:function () {
                var a, b, c = this.qtip.tooltip, d = {height:c.outerHeight(F), width:c.outerWidth(F)}, e = this.qtip.plugins.tip, f = this.qtip.elements.tip;
                b = parseInt(c.css("borderLeftWidth"), 10) || 0, b = {left:-b, top:-b}, e && f && (a = "x" === e.corner.precedance ? [J, M] : [K, L], b[a[1]] -= f[a[0]]()), this.bgiframe.css(b).css(d)
            }, redraw:function () {
                if (1 > this.qtip.rendered || this.drawing)return this;
                var a, b, c, d, e = this.qtip.tooltip, f = this.qtip.options.style, g = this.qtip.options.position.container;
                return this.qtip.drawing = 1, f.height && e.css(K, f.height), f.width ? e.css(J, f.width) : (e.css(J, "").appendTo(this.redrawContainer), b = e.width(), 1 > b % 2 && (b += 1), c = e.css("maxWidth") || "", d = e.css("minWidth") || "", a = (c + d).indexOf("%") > -1 ? g.width() / 100 : 0, c = (c.indexOf("%") > -1 ? a : 1) * parseInt(c, 10) || b, d = (d.indexOf("%") > -1 ? a : 1) * parseInt(d, 10) || 0, b = c + d ? Math.min(Math.max(b, d), c) : b, e.css(J, Math.round(b)).appendTo(g)), this.drawing = 0, this
            }, destroy:function () {
                this.bgiframe && this.bgiframe.remove(), this.qtip._unbind([a, this.qtip.tooltip], this._ns)
            }}), Cb = S.ie6 = function (a) {
                return 6 === eb.ie ? new y(a) : F
            }, Cb.initialize = "render", C.ie6 = {"^content|style$":function () {
                this.redraw()
            }}
        })
    }(window, document)
}, {}], 4:[function (a, b) {
    !function (a, c) {
        var d = {version:"2.1.6", areas:{}, apis:{}, inherit:function (a, b) {
            for (var c in a)b.hasOwnProperty(c) || (b[c] = a[c]);
            return b
        }, stringify:function (a) {
            return void 0 === a || "function" == typeof a ? a + "" : JSON.stringify(a)
        }, parse:function (a) {
            try {
                return JSON.parse(a)
            } catch (b) {
                return a
            }
        }, fn:function (a, b) {
            d.storeAPI[a] = b;
            for (var c in d.apis)d.apis[c][a] = b
        }, get:function (a, b) {
            return a.getItem(b)
        }, set:function (a, b, c) {
            a.setItem(b, c)
        }, remove:function (a, b) {
            a.removeItem(b)
        }, key:function (a, b) {
            return a.key(b)
        }, length:function (a) {
            return a.length
        }, clear:function (a) {
            a.clear()
        }, Store:function (a, b, c) {
            var e = d.inherit(d.storeAPI, function (a, b, c) {
                return 0 === arguments.length ? e.getAll() : void 0 !== b ? e.set(a, b, c) : "string" == typeof a ? e.get(a) : a ? e.setAll(a, b) : e.clear()
            });
            return e._id = a, e._area = b || d.inherit(d.storageAPI, {items:{}, name:"fake"}), e._ns = c || "", d.areas[a] || (d.areas[a] = e._area), d.apis[e._ns + e._id] || (d.apis[e._ns + e._id] = e), e
        }, storeAPI:{area:function (a, b) {
            var c = this[a];
            return c && c.area || (c = d.Store(a, b, this._ns), this[a] || (this[a] = c)), c
        }, namespace:function (a, b) {
            if (!a)return this._ns ? this._ns.substring(0, this._ns.length - 1) : "";
            var c = a, e = this[c];
            return e && e.namespace || (e = d.Store(this._id, this._area, this._ns + c + "."), this[c] || (this[c] = e), b || e.area("session", d.areas.session)), e
        }, isFake:function () {
            return"fake" === this._area.name
        }, toString:function () {
            return"store" + (this._ns ? "." + this.namespace() : "") + "[" + this._id + "]"
        }, has:function (a) {
            return this._area.has ? this._area.has(this._in(a)) : !!(this._in(a)in this._area)
        }, size:function () {
            return this.keys().length
        }, each:function (a, b) {
            for (var c = 0, e = d.length(this._area); e > c; c++) {
                var f = this._out(d.key(this._area, c));
                if (void 0 !== f && a.call(this, f, b || this.get(f)) === !1)break;
                e > d.length(this._area) && (e--, c--)
            }
            return b || this
        }, keys:function () {
            return this.each(function (a, b) {
                b.push(a)
            }, [])
        }, get:function (a, b) {
            var c = d.get(this._area, this._in(a));
            return null !== c ? d.parse(c) : b || c
        }, getAll:function () {
            return this.each(function (a, b) {
                b[a] = this.get(a)
            }, {})
        }, set:function (a, b, c) {
            var e = this.get(a);
            return null != e && c === !1 ? b : d.set(this._area, this._in(a), d.stringify(b), c) || e
        }, setAll:function (a, b) {
            var c, d;
            for (var e in a)d = a[e], this.set(e, d, b) !== d && (c = !0);
            return c
        }, remove:function (a) {
            var b = this.get(a);
            return d.remove(this._area, this._in(a)), b
        }, clear:function () {
            return this._ns ? this.each(function (a) {
                d.remove(this._area, this._in(a))
            }, 1) : d.clear(this._area), this
        }, clearAll:function () {
            var a = this._area;
            for (var b in d.areas)d.areas.hasOwnProperty(b) && (this._area = d.areas[b], this.clear());
            return this._area = a, this
        }, _in:function (a) {
            return"string" != typeof a && (a = d.stringify(a)), this._ns ? this._ns + a : a
        }, _out:function (a) {
            return this._ns ? a && 0 === a.indexOf(this._ns) ? a.substring(this._ns.length) : void 0 : a
        }}, storageAPI:{length:0, has:function (a) {
            return this.items.hasOwnProperty(a)
        }, key:function (a) {
            var b = 0;
            for (var c in this.items)if (this.has(c) && a === b++)return c
        }, setItem:function (a, b) {
            this.has(a) || this.length++, this.items[a] = b
        }, removeItem:function (a) {
            this.has(a) && (delete this.items[a], this.length--)
        }, getItem:function (a) {
            return this.has(a) ? this.items[a] : null
        }, clear:function () {
            for (var a in this.list)this.removeItem(a)
        }, toString:function () {
            return this.length + " items in " + this.name + "Storage"
        }}};
        a.store && (d.conflict = a.store);
        var e = d.Store("local", function () {
            try {
                return localStorage
            } catch (a) {
            }
        }());
        e.local = e, e._ = d, e.area("session", function () {
            try {
                return sessionStorage
            } catch (a) {
            }
        }()), "function" == typeof c && void 0 !== c.amd ? c(function () {
            return e
        }) : "undefined" != typeof b && b.exports ? b.exports = e : a.store = e
    }(window, window.define)
}, {}], 5:[function () {
    (function (a) {
        var b = function () {
        };
        a.announcement = new b, b.prototype.show = function (a) {
            "string" == typeof a && a.length > 0 && $(".right .announcement .content").html(a), $(".right .announcement").fadeIn(100)
        }, b.prototype.hide = function () {
            $(".right .announcement").fadeOut(100)
        }, $(document).ready(function () {
            $(".right .announcement .close").click(announcement.hide)
        })
    }).call(this, "undefined" != typeof self ? self : "undefined" != typeof window ? window : {})
}, {}], 6:[function () {
    (function (a) {
        var b = function () {
            this.lastTime = 0, this.timeout = 180, this.messageId = 0, this.maxSaveRows = 100, this.delTimeout = 120
        };
        a.chat = new b, b.prototype.append = function (a, b) {
            if ("" !== a.content) {
                b || this.appendTime(a.time);
                var c = $("<div></div>");
                c.addClass("message"), c.attr("dt-id", a.id), c.attr("dt-index", a.index), c.attr("dt-time", a.time), b && c.attr("dt-rand", a.rand), a.user.id == user.id && c.addClass("message-me"), c.append(-1 !== parseInt(a.user.id) ? '<img class="photo" src="/player/getPhoto?uid=' + a.user.id + '">' : '<img class="photo" src="http://www.smartstudy.com' + course.info.teacherPic + '">');
                var d = $("<div></div>");
                d.addClass("container"), c.append(d);
                var e = $("<div></div>");
                e.addClass("header"), e.append('<div class="username">' + (a.user.name ? a.user.name : "无名") + "</div>"), b && e.append('<div class="pending"><img src="' + build.cdn + '/images/submit-loading.gif"/></div>'), e.append('<div class="button"></div>'), parseInt(a.user.id) === parseInt(user.id) && e.find(".button").append('<div class="item delete">撤回</div>'), e.append('<div class="clear"></div>'), d.append(e);
                var f = $("<div></div>");
                if (f.addClass("content"), f.append('<span class="triangle"></span>'), d.append(f), "text" == a.type) {
                    var g = func.htmlEncode(a.content);
                    g = g.replace(/\[笑\]/g, ' <img src="' + build.cdn + '/images/emoji/1c.gif"> '), g = g.replace(/\[呆\]/g, ' <img src="' + build.cdn + '/images/emoji/2c.gif"> '), g = g.replace(/\[哭\]/g, ' <img src="' + build.cdn + '/images/emoji/3c.gif"> '), g = g.replace(/\[酷\]/g, ' <img src="' + build.cdn + '/images/emoji/4c.gif"> '), g = g.replace(/\[赞\]/g, ' <img src="' + build.cdn + '/images/emoji/5c.gif"> '), f.append('<span class="text">' + g + "</span>")
                } else f.addClass("voice"), f.attr("dt-hash", a.hash), f.attr("dt-chat", "1"), f.css("width", parseInt(10 + a.leng / 120 * 90) + "%"), a.user.id == user.id ? (f.append('<span class="icon icon-me"></span>'), d.append('<span class="info"><span class="length">' + a.leng + "''</span></span>")) : (f.append('<span class="icon"></span>'), d.append(1 === a.readed ? '<span class="info"><span class="unread readed"></span><span class="length">' + a.leng + "''</span></span>" : '<span class="info"><span class="unread"></span><span class="length">' + a.leng + "''</span></span>"));
                c.append('<div class="clear"></div>'), $(".right .chat").append(c), $(".right .chat .block").remove(), $(".right .chat").append('<div class="block"></div>'), $(".right .chat").scrollTop($(".right .chat")[0].scrollHeight)
            }
        }, b.prototype.appendTime = function (a) {
            a - this.lastTime <= this.timeout || ($(".right .chat").append('<div class="time">' + func.getDTime(a) + "</div>"), this.lastTime = a)
        }, b.prototype.save = function (a) {
            store.set("chat." + course.id + "." + this.messageId, a), store.set("chat." + course.id + ".maxId", this.messageId), this.messageId > this.maxSaveRows && store.remove("chat." + course.id + "." + (this.messageId - this.maxSaveRows)), this.messageId++
        }, b.prototype.setReaded = function (a) {
            if (void 0 !== a.attr("dt-index") && 0 === a.find(".info .readed").length) {
                a.find(".info .unread").addClass("readed");
                var b = store.get("chat." + course.id + "." + a.attr("dt-index"));
                a && "object" == typeof a && (b.readed = 1), store.set("chat." + course.id + "." + a.attr("dt-index"), b)
            }
        }, b.prototype.getHistory = function () {
            for (var a = store.get("chat." + course.id + ".maxId") || 0, b = a - this.maxSaveRows + 1 >= 0 ? a - this.maxSaveRows + 1 : 0; a >= b; b++) {
                this.messageId = b;
                var c = store.get("chat." + course.id + "." + b);
                c && "object" == typeof c && this.append(c)
            }
            this.messageId++, layout.loadingDone("chat", " 历史消息加载完成")
        }, b.prototype.clearHistory = function () {
            store.clearAll()
        }, b.prototype.submit = function (a) {
            a.rand = Math.random().toString(), a.user = {id:user.id, name:user.name}, this.append(a, !0), "text" === a.type ? realtime.publish("chatPub." + course.id, {type:"text", rand:a.rand, content:a.content, productId:product.id, sectionId:product.sectionId}) : realtime.publish("chatPub." + course.id, {type:"voice", rand:a.rand, hash:a.hash, leng:a.leng, productId:product.id, sectionId:product.sectionId}), setTimeout(function () {
                $('.right .chat .message-me[dt-rand="' + a.rand + '"]').length > 0 && (input.showTip("消息发送失败，请重新发送"), $('.right .chat .message-me[dt-rand="' + a.rand + '"]').remove())
            }, 2e4), "string" != typeof a.content || -1 === a.content.indexOf("老师") && -1 === a.content.indexOf(course.info.teacherName) || -1 === a.content.indexOf("帅") && -1 === a.content.indexOf("美") && -1 === a.content.indexOf("漂亮") && (-1 === a.content.indexOf("课") && -1 === a.content.indexOf("讲") || -1 === a.content.indexOf("好") && -1 === a.content.indexOf("不错")) || realtime.publish("chatPub." + course.id, {type:"op", action:"egg"})
        }, b.prototype.showButton = function () {
            parseInt($(this).attr("dt-time")) + chat.delTimeout <= parseInt((new Date).getTime() / 1e3) && $(this).find(".button .delete").remove(), $(this).find(".button").fadeIn(100)
        }, b.prototype.hideButton = function () {
            0 === $(this).find(".container .header .button .pop").length && $(this).find(".button").fadeOut(100)
        }, b.prototype.del = function () {
            return 0 !== $(this).parent().find(".delete-div").length ? void $(this).parent().find(".delete-div").remove() : ($(this).find(".pop").remove(), void $(this).parent().append('<div class="pop delete-div"><span class="cancel">取消</span><span class="confirm">确认</span><span class="triangle"></span></div>'))
        }, b.prototype.deleteConfirm = function () {
            realtime.publish("chatPub." + course.id, {type:"op", action:"delete", id:$(this).parent().parent().parent().parent().parent().attr("dt-id")}), $(this).parent().html('撤回中...<span class="triangle"></span>')
        }, b.prototype.cancelConfirm = function () {
            $(this).parent().remove()
        }, b.prototype.deleteDo = function (a, b) {
            0 !== $('.right .chat .message[dt-id="' + a + '"]').length && (store.remove("chat." + course.id + "." + $('.right .chat .message[dt-id="' + a + '"]').attr("dt-index")), $('.right .chat .message[dt-id="' + a + '"]').remove(), $(".right .chat").append('<div class="time">' + b + "撤回了一条消息</div>"), $(".right .chat .block").remove(), $(".right .chat").append('<div class="block"></div>'))
        }, realtime.on("chatSub", function (a) {
            var b = {id:a.id, index:chat.messageId, user:a.user, time:a.time, type:a.message.type};
            if ("text" === b.type)b.content = a.message.content; else if ("voice" === b.type)b.leng = a.message.leng, b.hash = a.message.hash; else if ("op" === b.type) {
                if (b.action = a.message.action, "egg" === b.action)return b.type = "text", b.user.id = "-1", b.user.name = course.info.teacherName, b.content = "谢谢啦！^-^ [彩蛋自动回复]", chat.save(b), void chat.append(b);
                "delete" === b.action && chat.deleteDo(a.message.id, b.user.name)
            }
            ("text" === b.type || "voice" === b.type) && (chat.save(b), chat.append(b), parseInt(b.user.id) === parseInt(user.id) && $('.right .chat .message-me[dt-rand="' + a.message.rand + '"]').remove())
        }), $(document).ready(function () {
            $(".right .chat").on("mouseenter", ".message", chat.showButton), $(".right .chat").on("mouseleave", ".message", chat.hideButton), $(".right .chat").on("click", ".message .container .delete", chat.del), $(".right .chat").on("click", ".message .container .delete-div .confirm", chat.deleteConfirm), $(".right .chat").on("click", ".message .container .delete-div .cancel", chat.cancelConfirm)
        })
    }).call(this, "undefined" != typeof self ? self : "undefined" != typeof window ? window : {})
}, {}], 7:[function (a) {
    (function (a, b) {
        var c = function () {
            this.id = 0, this.info = {}
        };
        a.course = new c, a.product = {id:0, sectionId:0}, c.prototype.fetch = function () {
            $.ajax({url:"player/get_course_info", data:{token:user.token, price_id:product.id, section_id:product.sectionId}, cache:!1, dataType:"json", type:"GET", success:function (a) {
                course.fill(a.data)
            }, error:function () {
            }})
        }, c.prototype.fill = function (a) {
            this.info.productUrl = a.price_url, this.info.teacherName = a.teacher_name, this.info.productName = a.price_name, this.info.teacherPic = a.teacher_pic, this.info.sectionVersion = a.section_version, parseInt(course.id) !== parseInt(a.course_id) ? (0 !== parseInt(course.id) && (realtime.client.unsubscribe("chatPub." + course.id), realtime.client.unsubscribe("chatSub." + course.id), input.showTip("您已切换到新课程聊天室")), course.id = a.course_id, chat.getHistory(), realtime.client.subscribe("chatPub." + product.id + "." + course.id), realtime.client.subscribe("chatSub." + product.id + "." + course.id)) : course.id = a.course_id, document.title = a.section_name + " - " + a.price_name + " - 智课网(SmartStudy.com)", $(".left .header .return").attr("href", a.price_url), $(".left .header .title").html(a.section_name + " - " + a.price_name), $(".left .footer .teacher .photo img").attr("src", "http://www.smartstudy.com" + a.teacher_pic), $(".left .footer .teacher .info span a").html(a.teacher_name), 0 === parseInt(a.teacher_course_num) ? $(".left .footer .teacher .info > a").html("所有课程") : ($(".left .footer .teacher .info > a").html("所有课程（<font></font>）"), $(".left .footer .teacher .info a font").html(a.teacher_course_num)), $(".left .footer .teacher a").attr("href", a.teacher_url), $(".left .footer .classmates").html('<a href="#">同学：</a>');
            for (var b = 0; b < a.classmates.length; b++)$(".left .footer .classmates").append('<a href="#"><img src="' + a.classmates[b].photo + '"><span>' + a.classmates[b].name + "</span></a>");
            for (var c = $(".left .footer .classmates a"), b = 0; b < c.length; b++)$(c[b]).qtip({content:{text:$(c[b]).find("span").html()}, position:{my:"bottom center", at:"top center"}, show:{delay:300}});
            layout.left(), layout.loadingDone("course", "课程信息加载完成"), 1 === parseInt(a.newclassmate) ? course.showConfirmDiv() : (player.load(), a.has_buy && course.startPlay())
        }, c.prototype.parseHash = function () {
            if (location.hash)try {
                var a = new b(location.hash.substr(1), "base64"), c = JSON.parse(a.toString("utf8"))
            } catch (d) {
                alert("地址解析错误，请刷新后重试")
            } else {
                var c = {}, e = location.pathname.split(".")[0].split("-");
                c.id = e[1], c.sectionId = e[2]
            }
            product = c
        }, c.prototype.genHash = function () {
            var a = new b(JSON.stringify(product), "utf8");
            location.hash = a.toString("base64")
        }, c.prototype.showConfirmDiv = function () {
            var a = $("<div></div>");
            a.addClass("play-confirm"), a.append('<div class="container"></div>'), a.find(".container").append('<div class="text">您确认进入该课程学习后，系统将开始计该课程的有效期。</div>'), a.find(".container").append('<div class="button"><span class="cancel">取消</span><span class="confirm">确认</span></div>'), $("body").append(a), $(".play-confirm").css("padding-top", .4 * (layout.pageH - layout.getH(".play-confirm .container"))), $(".play-confirm .cancel").click(function () {
                location.href = "/user/schedule"
            }), $(".play-confirm .confirm").click(function () {
                player.load(), $(".play-confirm").remove(), course.startPlay()
            })
        }, c.prototype.startPlay = function () {
            $.ajax({url:"player/start_play", data:{token:user.token, price_id:product.id}, cache:!1, type:"GET"})
        }, course.parseHash(), $(document).ready(function () {
            course.fetch()
        })
    }).call(this, "undefined" != typeof self ? self : "undefined" != typeof window ? window : {}, a("buffer").Buffer)
}, {buffer:21}], 8:[function () {
    (function (a) {
        a.flash = {teach:!1}, flash.embedFlash = function (a, b, c, d, e, f, g, h) {
            var i = "11.1.0", j = "/swf/playerProductInstall.swf", k = {};
            k.quality = "high", k.bgcolor = c, k.allowscriptaccess = "always", k.allowfullscreen = "true", k.wmode = h, k.scale = "noScale", k.salign = "TL";
            var l = {};
            l.id = b, l.name = b, l.align = "middle", swfobject.embedSWF(a, f, d, e, i, j, g, k, l), swfobject.createCSS("#" + f, "display:block;text-align:left;")
        }, flash.getFlash = function (a) {
            return-1 != navigator.appName.indexOf("Microsoft") ? window[a] : document[a]
        }, flash.recordComplete = function (a, b) {
            return 0 === parseInt(user.id) ? (input.showTip('<a href="/login">您尚未登录，无法进行操作，点击登录</>', "fail", -1), !1) : 0 === b ? (input.showTip("说话时间太短了"), !1) : b > 60 ? (input.showTip("不能超过60秒，已录制" + b + "秒"), !1) : ("chat" === $(".right .input").attr("dt-id") ? chat.submit({type:"voice", hash:a, leng:b}) : note.submit({type:"voice", "private":$(".right .input .toolbar .private input").attr("checked") ? 1 : 0, slide:$(".right .input .toolbar .slide").attr("dt-time"), hash:a, leng:b}), void("note" === $(".right .input").attr("dt-id") && (input.closeToolbar("voice"), $(".right .input .toolbar .slide").attr("dt-time", "-1"))))
        }, flash.resize = function (a) {
            flash.getFlash("audiorecorder").resize(a)
        }, flash.setFlashHeight = function () {
            $(".right .recorder-bg").show(), $(".right .recorder-tip").show(), layout.right()
        }, flash.resumeFlashHeight = function () {
            $(".right .recorder-bg").hide(), $(".right .recorder-tip").hide(), layout.right()
        }, flash.startRecord = function () {
            "note" === $(".right .input").attr("dt-id") && (input.showToolbar("voice"), flash.getCurrentTime())
        }, flash.cancelRecord = function () {
            "note" === $(".right .input").attr("dt-id") && (input.closeToolbar("voice"), $(".right .input .toolbar .slide").attr("dt-time", "-1"))
        }, flash.toggleSound = function () {
            "1" === $(this).attr("dt-playing") ? ($(this).find(".icon").removeClass("icon-playing"), $(this).find(".icon").html(""), $(this).removeAttr("dt-playing"), $(this).removeClass("playing"), flash.stopSound()) : ($(".playing").find(".icon").removeClass("icon-playing"), $(".playing").find(".icon").html(""), $(".playing").removeAttr("dt-playing"), $(".playing").removeClass("playing"), flash.stopSound(), $(this).attr("dt-playing", "1"), $(this).addClass("playing"), "1" === $(this).attr("dt-chat") && chat.setReaded($(this).parent().parent()), $(this).find(".icon").addClass("icon-playing"), $(this).find(".icon").html($(this).parent().parent().hasClass("message-me") ? '<img src="' + build.cdn + '/images/voice-playing-me.gif">' : '<img src="' + build.cdn + '/images/voice-playing.gif">'), flash.playSound($(this).attr("dt-hash")))
        }, flash.playSound = function (a) {
            flash.getFlash("audioplayer").playSound(a)
        }, flash.stopSound = function () {
            flash.getFlash("audioplayer").stopSound()
        }, flash.soundComplete = function () {
            $(".playing").find(".icon").removeClass("icon-playing"), $(".playing").find(".icon").html(""), $(".playing").removeAttr("dt-playing"), $(".playing").removeClass("playing")
        }, flash.showTips = function () {
        }, flash.errorTip = function () {
            player.showTip("课程加载失败", "由于网络问题导致视频加载失败，请重试或者稍后再看。", '<span class="btn-refresh">刷新</span>')
        }, flash.endTip = function () {
            var a = outline.getNext();
            -1 === a ? player.showTip("课程播放完毕", "您当前所选的课程已经全部播放完毕。", '<span class="btn-close">关闭</span>') : player.showTip("课程播放完毕", "当前章节课程已经播放完毕。", '<span class="btn-next">下一节</span><span class="btn-close">关闭</span>')
        }, flash.breakTip = function (a) {
            return 0 === parseInt(user.id) ? void(flash.teach || flash.resetPlay()) : void player.showTip("提示", "您上次观看到 <b>" + player.int2Time(a) + "</b> 处，是否继续播放？", '<span class="btn-continue">继续播放</span><span class="btn-reset">从头播放</span>')
        }, flash.payOrLogin = function () {
            0 === parseInt(user.id) ? player.showTip("登录", '您只有登录后才可以听课。还没有账号？现在<a href="http://www.smartstudy.com/reg">注册</a>', '<span class="btn-signin">登录</span>') : player.showTip("该课程尚未购买", "您只有购买该课程后才可以听课。", '<span class="btn-buy" dt-id="' + product.id + '">现在购买</span>')
        }, flash.hideAllTips = function () {
            player.closeTip()
        }, flash.continuePlay = function () {
            flash.getFlash("smartplayer").continuePlay()
        }, flash.resetPlay = function () {
            try {
                flash.getFlash("smartplayer").resetPlay()
            } catch (a) {
            }
        }, flash.seekPlay = function (a) {
            a = parseInt(a), flash.getFlash("smartplayer").seekPlay(a)
        }, flash.getCurrentTime = function () {
            flash.getFlash("smartplayer").getCurrentTime()
        }, flash.currentTimeResponse = function (a) {
            a = parseInt(1e3 * a), $(".right .input .toolbar .slide span").html(outline.int2Time(a)), $(".right .input .toolbar .slide").attr("dt-time", a)
        }, $(document).ready(function () {
            flash.embedFlash(build.cdn + "/swf/AudioRecorder.swf", "audiorecorder", "", "100%", "150px", "recorderinner", "", "transparent"), $(".right .recorder-tip .close span").click(flash.resumeFlashHeight), flash.embedFlash(build.cdn + "/swf/AudioPlayer.swf", "audioplayer", "", "1px", "1px", "audioplayerinner", "", "transparent"), $(".right .plugin").on("click", ".voice", flash.toggleSound)
        })
    }).call(this, "undefined" != typeof self ? self : "undefined" != typeof window ? window : {})
}, {}], 9:[function () {
    (function (a) {
        var b = function () {
        };
        a.func = new b, b.prototype.getDTime = function (a) {
            var b = parseInt((new Date).getTime() / 1e3), c = 86400 * parseInt(b / 86400) - 28800, d = new Date(1e3 * a), e = d.getFullYear(), f = d.getMonth() + 1, g = d.getDate(), h = d.getHours(), i = d.getMinutes();
            return 10 > i && (i = "0" + i), a >= c ? h + ":" + i : a >= c - 86400 ? "昨天 " + h + ":" + i : a >= c - 172800 ? "前天 " + h + ":" + i : e + "-" + f + "-" + g + " " + h + ":" + i
        }, b.prototype.htmlEncode = function (a) {
            var b = document.createElement("div"), c = document.createTextNode(a);
            return b.appendChild(c), b.innerHTML
        }, b.prototype.htmlDecode = function (a) {
            var b = document.createElement("div");
            return b.innerHTML = a, b.innerText || b.textContent
        }
    }).call(this, "undefined" != typeof self ? self : "undefined" != typeof window ? window : {})
}, {}], 10:[function (a) {
    a("./require.js"), a("./function.js"), a("./layout.js"), a("./course.js"), a("./outline.js"), a("./realtime.js"), a("./swf-object.js"), a("./flash.js"), a("./player.js"), a("./input.js"), a("./chat.js"), a("./note.js"), a("./tab.js"), a("./announcement.js"), a("./teach.js")
}, {"./announcement.js":5, "./chat.js":6, "./course.js":7, "./flash.js":8, "./function.js":9, "./input.js":11, "./layout.js":12, "./note.js":13, "./outline.js":14, "./player.js":15, "./realtime.js":16, "./require.js":17, "./swf-object.js":18, "./tab.js":19, "./teach.js":20}], 11:[function () {
    (function (a) {
        var b = function () {
            this.dvalue = 0, this.errorTimeout = {}, this.toolbarShow = 0
        };
        a.input = new b, b.prototype.init = function () {
            this.dvalue = layout.getH(".right .input") - layout.getH(".right .input .keyboard .text .textarea")
        }, b.prototype.toText = function () {
            input.closeToolbar("voice"), $(".right .input .toolbar .slide").attr("dt-time", "-1"), $(".right .input .keyboard").css("display", "block"), $(".right .input .voice").css("display", "none"), $(".right .recorder").css("display", "none"), $(".right .input").attr("dt-type", "text")
        }, b.prototype.toVoice = function () {
            $(".right .input .voice").css("display", "block"), $(".right .input .keyboard").css("display", "none"), $(".right .recorder").css("display", "block"), $(".right .input").attr("dt-type", "voice")
        }, b.prototype.textSubmit = function (a) {
            if ("click" === a.type || 13 === a.keyCode) {
                var b = $(".right .input .keyboard .text .textarea").val();
                if (0 === parseInt(user.id))return this.showTip('<a href="/login">您尚未登录，无法进行操作，点击登录</>', "fail", -1), !1;
                if (0 === b.length)return this.showTip("请不要发布空内容"), !1;
                if (b.length > 140)return this.showTip("不能超过140个字，已输入" + b.length + "个字"), !1;
                "chat" === $(".right .input").attr("dt-id") ? chat.submit({type:"text", content:b}) : note.submit({type:"text", "private":$(".right .input .toolbar .private input").attr("checked") ? 1 : 0, slide:$(".right .input .toolbar .slide").attr("dt-time"), content:b}), $(".right .input .keyboard .text .textarea").val(""), this.textGrowTaller({})
            }
        }, b.prototype.textGrowTaller = function (a) {
            if (a && 13 === a.keyCode)return!1;
            var b = $(".right .input .keyboard .text .textarea"), c = $(".right .input .keyboard .text .hide");
            c.val(b.val());
            var d = c[0].scrollHeight >= layout.getH(".right .input .keyboard .text .hide") ? c[0].scrollHeight : layout.getH(".right .input .keyboard .text .hide");
            layout.setH(".right .input .keyboard .text .textarea", d), layout.setH(".right .input", d + this.dvalue)
        }, b.prototype.showTip = function (a, b, c) {
            $(".right .input .keyboard .emoji-div").hide(), a = a || "", b = b || "warning", c = c || 3e3, clearTimeout(this.errorTimeout), $(".right .input .error").removeClass("error-succeed"), $(".right .input .error").removeClass("error-fail"), $(".right .input .error .icon").html('<i class="fa fa-exclamation-triangle"></i>'), "succeed" === b && ($(".right .input .error").addClass("error-succeed"), $(".right .input .error .icon").html('<i class="fa fa-check-circle"></i>')), "fail" === b && ($(".right .input .error").addClass("error-fail"), $(".right .input .error .icon").html('<i class="fa fa-times-circle"></i>')), $(".right .input .error .text").html(a), $(".right .input .error").css("display", "block"), $(".right .input .error").animate({opacity:"1"}, 100, "swing", function () {
            }), -1 !== c && (this.errorTimeout = setTimeout(function () {
                input.closeTip()
            }, c))
        }, b.prototype.closeTip = function () {
            clearTimeout(this.errorTimeout), $(".right .input .error").animate({opacity:"0"}, 100, "swing", function () {
                $(".right .input .error").css("display", "none")
            })
        }, b.prototype.showToolbar = function (a) {
            "note" === $(".right .input").attr("dt-id") && ("voice" === $(".right .input").attr("dt-type") && "voice" === a ? $(".right .input .toolbar").fadeIn(100) : "text" === $(".right .input").attr("dt-type") && (this.toolbarShow++, this.toolbarShow > 0 && ($(".right .input .toolbar").fadeIn(100), "-1" === $(".right .input .toolbar .slide").attr("dt-time") && "" === $(".right .input .keyboard .text .textarea").val() && flash.getCurrentTime())))
        }, b.prototype.closeToolbar = function (a) {
            "note" === $(".right .input").attr("dt-id") && ("voice" === $(".right .input").attr("dt-type") && "voice" === a ? $(".right .input .toolbar").fadeOut(100) : "text" === $(".right .input").attr("dt-type") && (this.toolbarShow--, this.toolbarShow <= 0 && ($(".right .input .toolbar").fadeOut(100), "" === $(".right .input .keyboard .text .textarea").val() && $(".right .input .toolbar .slide").attr("dt-time", "-1"))))
        }, b.prototype.emojiToggle = function () {
            "none" === $(".right .input .keyboard .emoji-div").css("display") ? $(".right .input .keyboard .emoji-div").fadeIn(50) : $(".right .input .keyboard .emoji-div").fadeOut(50)
        }, b.prototype.emojiClick = function () {
            $(".right .input .keyboard .text .textarea").val($(".right .input .keyboard .text .textarea").val() + "[" + $(this).attr("dt-name") + "]"), $(".right .input .keyboard .text .textarea").focus(), $(".right .input .keyboard .emoji-div").fadeOut(50), input.textGrowTaller()
        }, $(document).ready(function () {
            input.init(), $(".right .input .keyboard .icon").click(input.toVoice.bind(input)), $(".right .input .keyboard .text .textarea").keydown(input.textSubmit.bind(input)), $(".right .input .keyboard .text .enter").click(input.textSubmit.bind(input)), $(".right .input .keyboard .text .emoji").click(input.emojiToggle.bind(input)), $(".right .input .keyboard .emoji-div img").click(input.emojiClick), $(".right .input .keyboard .text .textarea").keydown(input.textGrowTaller.bind(input)), $(".right .input .keyboard .text .textarea").keyup(input.textGrowTaller.bind(input)), $(".right .input .keyboard .text .textarea").focus(input.showToolbar.bind(input)), $(".right .input .keyboard .text .textarea").blur(input.closeToolbar.bind(input)), $(".right .input .voice .icon").click(input.toText.bind(input)), $(".right .input .error .close").click(input.closeTip.bind(input)), $(".right .input .keyboard .text textarea").val(""), $(".right .input .toolbar .private").click(note.privateToggle), $(".right .input .toolbar").mouseenter(input.showToolbar.bind(input)), $(".right .input .toolbar").mouseleave(input.closeToolbar.bind(input)), $(".right .input .error").click(function () {
                $(".right .input .keyboard .text .textarea").focus()
            }), $(".right .input .toolbar").click(function () {
                $(".right .input .keyboard .text .textarea").focus()
            }), $(".right .input .toolbar .slide").click(flash.getCurrentTime)
        })
    }).call(this, "undefined" != typeof self ? self : "undefined" != typeof window ? window : {})
}, {}], 12:[function () {
    (function (a) {
        var b = function () {
            if (this.css = document.styleSheets[0].rules || document.styleSheets[0].cssRules || window.CSSRule.STYLE_RULE, document.styleSheets && document.styleSheets.length > 10) {
                this.devCss = [];
                for (var a = 0; a < document.styleSheets.length; a++)this.devCss[a] = document.styleSheets[a].rules || document.styleSheets[a].cssRules
            }
            this.firstLoad = 1, this.pageW = 0, this.pageH = 0, this.rightW = 0, this.resizeTimeout = {}, this.scrollId = {}, this.loadingInterval = {}, this.loadingItem = {layout:0, outline:0, course:0, player:0, chat:0, noteMine:0, noteShare:0, noteZan:0}, this.loadingTip = "等待加载...", this.loadingComplete = 0, this.loadingCompleteF = !1
        };
        a.layout = new b, b.prototype.init = function () {
            this.pageW = $(document.body).width(), this.pageH = $(document.body).height()
        }, b.prototype.run = function () {
            var a = this;
            if (this.init(), this.firstLoad || this.showResizeCover(), this.right(), this.left(), this.firstLoad && this.scroll(), this.firstLoad || this.closeResizeCover(), this.firstLoad) {
                var b = 0;
                for (var c in this.loadingItem)b++;
                this.loadingComplete = 0, this.loadingInterval = setInterval(function () {
                    $(".loading .tip .process .num").html(parseInt(a.loadingComplete / b * 100)), $(".loading .tip .txt").html("（" + a.loadingTip + "...）"), b !== a.loadingComplete || a.loadingCompleteF || (a.loadingCompleteF = !0, setTimeout(function () {
                        $(".left").css("visibility", "visible"), $(".right").css("visibility", "visible"), $(".loading").hide(), outline.open(), clearInterval(a.loadingInterval), 1 !== parseInt(store.get("teach." + user.id)) ? teach.process() : teach.done = !0
                    }, 150), setTimeout(function () {
                        outline.close()
                    }, 3e3), setTimeout(function () {
                        0 !== $("#smartplayerinner").length && player.showTip("提示", '您的播放可能遇到问题，请确认是否安装了<a href="http://get.adobe.com/cn/flashplayer/" target="_blank">最新版flash播放器</a>', '<span class="btn-close">关闭</span>')
                    }, 5e3))
                }, 100), this.firstLoad = 0
            }
            teach.done || 0 === teach.covered || teach.process(teach.step), (!teach.done && this.pageW < 1e3 || this.pageH < 480) && (teach.done = !0, teach.close()), layout.loadingDone("layout", "页面布局完成")
        }, b.prototype.right = function (a) {
            if (a = a || {}, this.pageW < 1e3 ? ($(".right").css("display", "none"), this.rightW = 0) : ($(".right").css("display", "block"), this.pageW < 1230 ? this.setW(".right", 300) : this.pageW < 1316 ? this.setW(".right", 320) : this.pageW < 1390 ? this.setW(".right", 340) : this.pageW < 1550 ? this.setW(".right", 360) : this.pageW < 1870 ? this.setW(".right", 400) : this.setW(".right", 460), this.rightW = this.getW(".right")), this.setH(".right .outline .header", this.getH(".left .header .btn:nth-child(1)") + parseInt($(".left").css("padding-top"))), $(".right .outline .header").css("line-height", this.getH(".right .outline .header") + "px"), this.setW(".right .outline .header", this.rightW + this.getW(".outline .container")), this.setH(".outline .container", this.pageH - this.getH(".outline .header")), this.setH(".outline .container-bg", this.pageH - this.getH(".outline .header")), $(".outline .container-bg").css("top", this.getH(".outline .header")), this.setCss(".right .outline .container .slide .text", "width"), outline.opened ? $(".right .outline").css("right", 0) : $(".right .outline").css("right", -this.getW(".outline .container")), $(".right .navi").css("margin-top", this.getH(".right .outline .header")), this.setW(".right .navi span", (this.rightW - parseInt($(".right .navi").css("padding-left")) - parseInt($(".right .navi").css("padding-left"))) / 2), this.setW(".right .note .note-navi .tab", (this.rightW - parseInt($(".right .navi").css("padding-left")) - parseInt($(".right .navi").css("padding-left"))) / 3), this.setH(".right .note", this.pageH - this.getH(".right .navi") - this.getH(".right .input")), this.setH(".right .chat", this.getH(".right .note")), this.setCss(".right .chat .message .container", "width", this.getW(".right .chat") - parseInt($(".right .chat").css("padding-left")) - parseInt($(".right .chat").css("padding-right")) - parseInt(this.getCss(".right .chat .message .photo", "width")) - parseInt(this.getCss(".right .chat .message .container", "marginLeft")) + "px"), this.setCss(".right .note .note-content .message .container", "width", this.getW(".right .note .note-content") - parseInt($(".right .note .note-content").css("padding-left")) - parseInt($(".right .note .note-content").css("padding-right")) - parseInt(this.getCss(".right .note .note-content .message .photo", "width")) - parseInt(this.getCss(".right .note .note-content .message .container", "marginLeft")) + "px"), this.setCss(".right .note .note-content .mine .message .container", "width", this.getW(".right .note .note-content") - parseInt($(".right .note .note-content").css("padding-left")) - parseInt($(".right .note .note-content").css("padding-right")) + "px"), this.setCss(".right .note .note-content .mine .message .edit .textarea", "width", parseInt(this.getCss(".right .note .note-content .mine .message .container", "width")) - 2 * parseInt(this.getCss(".right .note .note-content .mine .message .edit .textarea", "padding")) - parseInt(this.getCss(".right .note .note-content .mine .message .edit .save", "width")) - parseInt(this.getCss(".right .note .note-content .mine .message .edit .save", "marginLeft")) - parseInt(this.getCss(".right .note .note-content .mine .message .edit .save", "marginRight")) + "px"), this.setCss(".right .note .note-content .hide", "width", parseInt(this.getCss(".right .note .note-content .mine .message .edit .textarea", "width")) + "px"), this.setH(".right .note .note-content", this.getH(".right .note") - this.getH(".right .note .note-navi")), this.setW(".right .input", this.rightW), this.setW(".right .input .keyboard", this.rightW - parseInt($(".right .input").css("padding-left")) - parseInt($(".right .input").css("padding-right"))), this.setW(".right .input .keyboard .text", this.getW(".right .input .keyboard") - this.getW(".right .input .keyboard .icon")), this.setW(".right .input .keyboard .text textarea", this.getW(".right .input .keyboard .text") - parseInt($(".right .input .keyboard .text").css("margin-left")) - ("none" === $(".right .input .keyboard .text .emoji").css("display") ? 0 : this.getW(".right .input .keyboard .text .emoji")) - this.getW(".right .input .keyboard .text .enter") - parseInt($(".right .input .keyboard .text .textarea-container").css("padding-left")) - parseInt($(".right .input .keyboard .text .textarea-container").css("padding-right"))), this.setW(".right .input .error", this.rightW), this.setW(".right .input .toolbar", this.rightW), this.setW(".right .input .voice", this.getW(".right .input .keyboard")), this.setW(".right .recorder-bg", this.rightW), this.setH(".right .recorder-bg", this.pageH), $(".right .recorder-tip").css("top", parseInt(.45 * (this.pageH - 300))), $(".right .recorder-tip").css("left", parseInt((this.rightW - 225) / 2)), this.setW(".right .recorder", this.getW(".right .input .voice") - this.getW(".right .input .voice .icon") - 15), "block" === $(".right .recorder-bg").css("display") ? ($(".right .recorder").css("top", parseInt(.45 * (this.pageH - 300) + 140)), $(".right .recorder").css("left", parseInt((this.rightW - this.getW(".right .recorder")) / 2))) : ($(".right .recorder").css("top", this.pageH - this.getH(".right .input") + 17), $(".right .recorder").css("left", parseInt($(".input").css("padding-left")) + this.getW(".right .input .voice .icon") + 15)), $("#audiorecorder").length > 0 && 0 !== a.recorder)try {
                flash.resize(layout.getW(".right .recorder"))
            } catch (b) {
            }
            this.setW(".right .announcement", this.rightW), this.setW(".right .announcement .content", parseInt($(".right .announcement").css("width")) - this.getW(".right .announcement .title") - this.getW(".right .announcement .close")), $(".right .announcement").css("top", this.getH(".right .navi"))
        }, b.prototype.left = function () {
            this.setW(".left", this.pageW - this.rightW - 1), this.leftW = this.getW(".left"), 0 === parseInt(user.id) ? ($(".left .header .study").hide(), $(".left .header .login").show()) : ($(".left .header .study").show(), $(".left .header .login").hide()), this.setW(".left .header .title", this.getW(".left .header") - this.getW(".left .header .btn:nth-child(1)") - this.getW(".left .header .btn:nth-child(3)") - this.getW(".left .header .btn:nth-child(4)") - this.getW(".left .header .btn:nth-child(5)") - 20), this.setH(".left .header .title", this.getH(".left .header .btn:nth-child(1)")), $(".left .header .title").css("line-height", this.getH(".left .header .title") + "px");
            var a = parseInt((this.getW(".left .footer") - this.getW(".left .footer .teacher")) / this.getW(".left .footer .classmates a:nth-child(2)")) - 1;
            a = a > 20 ? 20 : a, a = 1 > a ? 1 : a, a -= 1, $(".left .footer .classmates a").hide();
            for (var b = 1; a >= b; b++)$(".left .footer .classmates a:nth-child(" + b + ")").show();
            1 >= a && $(".left .footer .classmates a").hide(), this.pageH < 480 ? ($(".left .footer").hide(), this.footerH = 0) : ($(".left .footer").show(), this.footerH = this.getH(".left .footer")), this.setH(".left .player", this.pageH - this.getH(".left .header") - this.footerH - parseInt($(".left").css("padding-top")) - parseInt($(".left").css("padding-bottom"))), this.setH(".left .player img", parseInt($(".left .player").css("height"))), $(".left .player .tip").css("top", .45 * (parseInt($(".left .player").css("height")) - parseInt($(".left .player .tip").css("height")))), $(".left .player .tip").css("left", .5 * (this.getW(".left .player") - parseInt($(".left .player .tip").css("width"))))
        }, b.prototype.scroll = function () {
            var a = {cursorcolor:"#4e555a", cursorwidth:"5px", cursorborder:"none", zindex:"100", autohidemode:!0}, b = $(".nice-scroll").niceScroll(a);
            this.scrollId.outline = b[0].id, this.scrollId.chat = b[1].id, this.scrollId.note = b[2].id, $("#" + this.scrollId.outline).css("left", "-100px"), $("#" + this.scrollId.chat).css("left", "-100px"), $("#" + this.scrollId.note).css("left", "-100px"), $(".nicescroll-rails div").css("margin-right", "4px")
        }, b.prototype.getW = function (a) {
            var b = 0;
            return b += parseInt($(a).css("width")), b += parseInt($(a).css("padding-left")), b += parseInt($(a).css("padding-right")), b += parseInt($(a).css("border-left-width")) || 0, b += parseInt($(a).css("border-right-width")) || 0, b += parseInt($(a).css("margin-left")) || 0, b += parseInt($(a).css("margin-right")) || 0
        }, b.prototype.getH = function (a) {
            var b = 0;
            return b += parseInt($(a).css("height")), b += parseInt($(a).css("padding-top")), b += parseInt($(a).css("padding-bottom")), b += parseInt($(a).css("border-top-width")) || 0, b += parseInt($(a).css("border-bottom-width")) || 0, b += parseInt($(a).css("margin-top")) || 0, b += parseInt($(a).css("margin-bottom")) || 0
        }, b.prototype.setW = function (a, b) {
            $(a).css("width", b - this.getW(a) + parseInt($(a).css("width")))
        }, b.prototype.setH = function (a, b) {
            $(a).css("height", b - this.getH(a) + parseInt($(a).css("height")))
        }, b.prototype.getCss = function (a, b) {
            for (var c = 0; c < this.css.length; c++)if (this.css[c].selectorText == a)return this.css[c].style[b];
            if (this.devCss)for (var c = 0; c < this.devCss.length; c++)for (var d = 0; d < this.devCss[c].length; d++)if (this.devCss[c][d].selectorText == a)return this.devCss[c][d].style[b]
        }, b.prototype.setCss = function (a, b, c) {
            for (var d = 0; d < this.css.length; d++)if (this.css[d].selectorText == a)try {
                this.css[d].style[b] = c
            } catch (e) {
            }
            if (this.devCss)for (var d = 0; d < this.devCss.length; d++)for (var f = 0; f < this.devCss[d].length; f++)if (this.devCss[d][f].selectorText == a)try {
                this.devCss[d][f].style[b] = c
            } catch (e) {
            }
        }, b.prototype.showResizeCover = function () {
            $(".resize").css("padding-top", parseInt(.33333 * (this.pageH - 30))), $(".resize").show()
        }, b.prototype.closeResizeCover = function () {
            setTimeout(function () {
                $(".resize").hide()
            }, 150)
        }, b.prototype.loadingDone = function (a, b) {
            0 === this.loadingItem[a] && (this.loadingItem[a] = 1, this.loadingComplete++, this.loadingTip = b)
        }, b.prototype.debug = function () {
            $(".debug").parent().css("position", "relative"), $(".debug").css("position", "absolute"), $(".debug").css("top", "150px"), $(".debug").css("right", "200px"), $(".debug").html(""), $(".debug").append("页面宽度：" + this.pageW + "<br>"), $(".debug").append("页面高度：" + this.pageH + "<br>"), $(".debug").append("右部宽度：" + this.rightW + "<br>"), $(".resize").html(""), $(".resize").append("页面调整中……<br><br>"), $(".resize").append("页面宽度：" + this.pageW + "<br>"), $(".resize").append("页面高度：" + this.pageH + "<br>"), $(".resize").append("右部宽度：" + this.rightW + "<br>")
        }, $(document).ready(function () {
            layout.run()
        }), $(window).resize(function () {
            layout.run()
        })
    }).call(this, "undefined" != typeof self ? self : "undefined" != typeof window ? window : {})
}, {}], 13:[function () {
    (function (a) {
        var b = function () {
            this.totNew = 0, this.maxId = -1, this.minId = -1, this.page = 1
        };
        a.note = new b, b.prototype.init = function () {
            this.totNew = 0, this.maxId = -1, this.minId = -1, this.page = 1
        }, b.prototype.switchTo = function () {
            $(".right .note .note-content .mine").hide(), $(".right .note .note-content .share").hide(), $(".right .note .note-content .essence").hide(), $(".right .note .note-content ." + $(this).parent().attr("dt-id")).show(), $(".right .note .note-navi .tab span").removeClass("active"), $(this).addClass("active"), $(".right .note .note-content").getNiceScroll().resize(), $(".right .note .note-content").getNiceScroll().stop(), $(".right .note .note-content").scrollTop(0)
        }, b.prototype.showButton = function () {
            $(this).find(".header .button").fadeIn(100)
        }, b.prototype.hideButton = function () {
            "1" !== $(this).find(".header .button").attr("dt-show") && $(this).find(".header .button").fadeOut(100)
        }, b.prototype.edit = function () {
            var a = $(this).parent().parent().parent();
            return 0 !== a.find(".edit").length ? (a.find(".content").show(), a.find(".slide").show(), a.find(".edit").remove(), void a.find(".edit-toolbar").remove()) : (a.find(".content").hide(), a.find(".slide").hide(), a.find(".edit").remove(), a.find(".edit-toolbar").remove(), a.append('<div class="edit"><textarea class="textarea"></textarea><span class="save">保存</span><div class="clear"></div></div>'), a.append(0 === parseInt(a.parent().attr("dt-private")) ? '<div class="edit-toolbar"><span class="check"><input type="checkbox">设为私密</span><span class="tip"></span></div>' : '<div class="edit-toolbar"><span class="check"><input type="checkbox" checked="checked">设为私密</span><span class="tip"></span></div>'), a.find(".edit textarea").val(func.htmlDecode(a.find(".content .text").html())), void a.find(".edit textarea").keydown())
        }, b.prototype.textGrowTaller = function (a) {
            if (13 === a.keyCode)return $(this).parent().find(".save").click(), !1;
            var b = $(this), c = $(".right .note .note-content .hide");
            c.val(b.val()), $(this).css("height", c[0].scrollHeight - parseInt($(this).css("padding-top")) - parseInt($(this).css("padding-bottom")))
        }, b.prototype.save = function () {
            var a = $(this), b = $(this).parent().parent().parent(), c = b.find(".edit textarea").val();
            return 0 === c.length ? (b.find(".edit-toolbar .tip").html('<i class="fa fa-exclamation-triangle"></i> 请不要发布空内容'), !1) : c.length > 140 ? (b.find(".edit-toolbar .tip").html('<i class="fa fa-exclamation-triangle"></i> 不能超过140个字'), !1) : void("1" !== a.attr("dt-save") && (a.attr("dt-save", "1"), a.html("保存中"), $.ajax({url:"player/edit_note", data:{token:user.token, note_id:b.attr("dt-id"), content:c, share:b.find(".edit-toolbar .check input").attr("checked") ? 0 : 1}, cache:!1, dataType:"json", type:"GET", success:function (a) {
                0 === a.error ? (b.find(".edit-toolbar .check input").attr("checked") ? b.attr("dt-private", 1) : b.attr("dt-private", 0), b.find(".content").show(), b.find(".edit").remove(), b.find(".edit-toolbar").remove(), b.find(".content .text").html(func.htmlEncode(c))) : note.saveFailed(b, a.msg)
            }, error:function () {
                note.saveFailed(b, "未知错误")
            }})))
        }, b.prototype.saveFailed = function (a, b) {
            a.find(".edit .save").html("保存"), a.find(".edit .save").removeAttr("dt-save"), a.find(".edit-toolbar .tip").html('<i class="fa fa-exclamation-triangle"></i> ' + b)
        }, b.prototype.privateToggle = function () {
            $(this).find("input").attr("checked") ? ($(this).find("input").prop("checked", !1), $(this).find("input").attr("checked", !1)) : ($(this).find("input").prop("checked", !0), $(this).find("input").attr("checked", !0))
        }, b.prototype.del = function () {
            return 0 !== $(this).parent().find(".delete").length ? ($(this).parent().removeAttr("dt-show"), void $(this).parent().find(".delete").remove()) : ($(this).parent().attr("dt-show", "1"), $(this).parent().find(".share-div").remove(), void $(this).parent().append('<div class="pop delete"><span class="cancel">取消</span><span class="confirm">确认</span><span class="triangle"></span></div>'))
        }, b.prototype.deleteConfirm = function () {
            var a = $(this).parent().parent().parent().parent().parent(), b = $(this).parent();
            b.html('删除中...<span class="triangle"></span>');
            var c = product.sectionId;
            $.ajax({url:"player/del_note", data:{token:user.token, note_id:a.attr("dt-id")}, cache:!1, dataType:"json", type:"GET", success:function (b) {
                0 === b.error ? (a.remove(), $('.right .outline .container .slide[dt-id="' + c + '"] .note-span span').html(parseInt($('.right .outline .container .slide[dt-id="' + c + '"] .note-span span').html()) - 1)) : note.deleteFailed(a, b.msg)
            }, error:function () {
                note.deleteFailed(a, "未知错误")
            }})
        }, b.prototype.deleteCancel = function () {
            $(this).parent().parent().removeAttr("dt-show"), $(this).parent().remove()
        }, b.prototype.deleteFailed = function (a) {
            a.find(".header .button .delete").html('删除失败<span class="triangle"></span>'), setTimeout(function () {
                a.find(".header .button .delete-btn").click(), a.find(".header .button .delete-btn").click()
            }, 1500)
        }, b.prototype.share = function () {
            if (0 !== $(this).parent().find(".share-div").length)return $(this).parent().removeAttr("dt-show"), void $(this).parent().find(".share-div").remove();
            $(this).parent().attr("dt-show", "1"), $(this).parent().find(".delete").remove();
            var a = location.href.replace("#", "?info="), b = "";
            b = $(this).parent().parent().parent().find(".content").hasClass("voice") ? "语音笔记" : $(this).parent().parent().parent().find(".content .text").html(), b = b.length > 10 ? b.substr(0, 10) + "..." : b;
            var c = "小伙伴们，我刚在@智课网 " + course.info.teacherName + "的" + course.info.productName + "上分享了一条笔记(" + b + ")。非常NB，速来膜拜吧。", d = "小伙伴们，我刚在智课网（@SmartStudy） " + course.info.teacherName + "的" + course.info.productName + "分享了一条笔记(" + b + ")。非常NB，速来膜拜吧。", e = '<div class="pop share-div">分享到：';
            e += '<a class="icon weibo" href="http://www.jiathis.com/send/?webid=tsina&url=' + a + "&title=" + c + "&pic=http://www.smartstudy.com" + course.info.teacherPic + '" target="_blank"></a>', e += '<a class="icon renren" href="http://widget.renren.com/dialog/share?resourceUrl=' + a + "&srcUrl=" + a + "&title=" + d + "&pic=http://www.smartstudy.com" + course.info.teacherPic + "&description=" + d + '" target="_blank"></a>', e += '<a class="icon qzone" href="http://sns.qzone.qq.com/cgi-bin/qzshare/cgi_qzshare_onekey?url=' + a + "&title=" + c + "&pics=http://www.smartstudy.com" + course.info.teacherPic + "&summary=" + c + '" target="_blank"></a>', e += '<a class="icon email" href="http://www.jiathis.com/send/?webid=email&url=' + a + "&title=" + c + "&pic=http://www.smartstudy.com" + course.info.teacherPic + '" target="_blank"></a>', e += '<span class="triangle"></span></div>', $(this).parent().append(e)
        }, b.prototype.zan = function () {
            var a = $(this).parent().parent().parent().parent().attr("dt-id");
            "1" === $(this).attr("dt-zan") ? ($('.right .note .note-content .message[dt-id="' + a + '"]').find(".zan-btn").removeAttr("dt-zan"), $('.right .note .note-content .message[dt-id="' + a + '"]').find(".zan-btn").html("赞(<font>" + (parseInt($(this).find("font").html()) - 1) + "</font>)")) : ($('.right .note .note-content .message[dt-id="' + a + '"]').find(".zan-btn").attr("dt-zan", "1"), $('.right .note .note-content .message[dt-id="' + a + '"]').find(".zan-btn").html("已赞(<font>" + (parseInt($(this).find("font").html()) + 1) + "</font>)")), $.ajax({url:"/player/note_laud", data:{note_id:a}, cache:!1, dataType:"json", type:"GET"})
        }, b.prototype.add = function (a, b) {
            var c = $("<div></div>");
            c.addClass("message"), c.attr("dt-id", a.id), c.attr("dt-private", a.private), a.user && (c.attr("dt-user-id", a.user.id), c.attr("dt-user-name", a.user.name)), a.pull && c.append('<img class="photo" src="/player/getPhoto?uid=' + a.user.id + '">');
            var d = $("<div></div>");
            d.addClass("container"), c.append(d);
            var e = $("<div></div>");
            e.addClass("header"), e.append(a.pull ? '<div class="username">' + (a.user.name ? a.user.name : "无名") + "</div>" : '<div class="username">自己</div>'), b && e.append('<div class="pending"><img src="' + build.cdn + '/images/submit-loading.gif"/></div>'), e.append('<div class="button"></div>'), e.find(".button").append(1 === parseInt(a.zan) ? '<span class="item zan-btn" dt-zan="1">已赞(<font>' + a.zanNum + "</font>)</span>" : '<span class="item zan-btn">赞(<font>' + a.zanNum + "</font>)</span>"), a.pull || "text" !== a.type || e.find(".button").append('<span class="item edit-btn">编辑</span>'), e.find(".button").append('<span class="item share-btn">分享</span>'), a.pull || e.find(".button").append('<span class="item delete-btn">删除</span>'), e.append('<div class="clear"></div>'), d.append(e);
            var f = $("<div></div>");
            if (f.addClass("content"), d.append(f), a.pull && f.append('<span class="triangle"></span>'), "text" === a.type)f.append('<span class="text">' + func.htmlEncode(a.content) + "</span>"); else {
                var g = JSON.parse(a.content);
                f.addClass("voice"), f.attr("dt-hash", g.hash), f.attr("dt-leng", g.leng), a.pull ? f.css("width", parseInt(10 + g.leng / 120 * 90) + "%") : f.css("width", parseInt(10 + g.leng / 90 * 90) + "%"), f.append('<span class="icon"></span>'), d.append('<span class="info"><span class="unread readed"></span><span class="length">' + g.leng + "''</span></span>")
            }
            return d.append('<div class="clear"></div>'), c.append('<div class="clear"></div>'), d.append('<div class="slide" dt-time="' + a.slide + '"><span class="slide-icon"><i class="fa fa-play"></i></span>' + outline.int2Time(a.slide) + "</div>"), a.pull ? a.essence ? a.append ? $(".right .note .note-content .essence").append(c) : $(".right .note .note-content .essence").prepend(c) : a.append ? $(".right .note .note-content .share").append(c) : $(".right .note .note-content .share").prepend(c) : $(".right .note .note-content .mine").prepend(c), $(".right .note .note-content").getNiceScroll().resize(), a.notScroll || $(".right .note .note-content").scrollTop(0), c
        }, b.prototype.submit = function (a) {
            var b = this;
            "voice" === a.type && (a.content = JSON.stringify({hash:a.hash, leng:a.leng})), a.zan = 0, a.zanNum = 0;
            var c = this.add(a, !0), d = product.id, e = product.sectionId, f = course.id;
            $.ajax({url:"/player/save_note", data:{token:user.token, price_id:d, course_id:f, section_id:e, content:a.content, position:a.slide, type:"text" === a.type ? 0 : 1, share:1 === a.private ? 0 : 1}, cache:!1, dataType:"json", type:"GET", success:function (d) {
                return 1 === d.error ? void b.submitFailed(c, d.msg) : (c.find(".header .pending").remove(), c.attr("dt-id", d.data), $('.right .outline .container .slide[dt-id="' + e + '"] .note-span span').html(parseInt($('.right .outline .container .slide[dt-id="' + e + '"] .note-span span').html()) + 1), void(a.private || realtime.publish("note." + e, {content:a.content})))
            }, error:function () {
                b.submitFailed(c)
            }})
        }, b.prototype.submitFailed = function (a, b) {
            b = b || "发送失败，未知错误", "没有权限操作" === b ? input.showTip('<a href="' + course.info.productUrl + '">您尚未购课，无法记录笔记，点击购买</a>', "fail", -1) : input.showTip(b), a.remove()
        }, b.prototype.fetch = function () {
            $.ajax({url:"player/get_notes", data:{token:user.token, section_id:product.sectionId}, cache:!1, dataType:"json", type:"GET", success:function (a) {
                if (0 === a.error)for (var b = a.data.length - 1; b >= 0; b--) {
                    var c = a.data[b];
                    note.add({id:c.id, type:"0" === c.type ? "text" : "voice", "private":"1" === c.share ? 0 : 1, slide:c.position, content:c.content, zan:c.laud, zanNum:c.laud_num})
                }
                layout.loadingDone("noteMine", "个人笔记加载完成")
            }}), $.ajax({url:"player/get_share_notes", data:{token:user.token, section_id:product.sectionId, operation:"init", note_id:""}, cache:!1, dataType:"json", type:"GET", success:function (a) {
                if (0 === a.error)for (var b = a.data.length - 1; b >= 0; b--) {
                    var c = a.data[b];
                    note.add({id:c.id, type:"0" === c.type ? "text" : "voice", "private":0, slide:c.position, content:c.content, zan:c.laud, zanNum:c.laud_num, user:{id:c.user_id, name:c.user_name}, pull:!0}), c.id = parseInt(c.id), note.maxId = -1 === note.maxId || c.id > note.maxId ? c.id : note.maxId, note.minId = -1 === note.minId || c.id < note.minId ? c.id : note.minId
                }
                layout.loadingDone("noteShare", "共享笔记加载完成")
            }}), $.ajax({url:"player/get_share_notes", data:{token:user.token, section_id:product.sectionId, order:1, page:1}, cache:!1, dataType:"json", type:"GET", success:function (a) {
                if (0 === a.error)for (var b = a.data.length - 1; b >= 0; b--) {
                    var c = a.data[b];
                    note.add({id:c.id, type:"0" === c.type ? "text" : "voice", "private":0, slide:c.position, content:c.content, zan:c.laud, zanNum:c.laud_num, user:{id:c.user_id, name:c.user_name}, pull:!0, essence:!0})
                }
                layout.loadingDone("noteZan", "精华笔记加载完成")
            }})
        }, b.prototype.fetchMore = function () {
            if ("1" !== $(this).attr("dt-disabled")) {
                var a = $(this);
                a.find(".inner").html("努力加载中..."), a.attr("dt-disabled", "1"), $.ajax({url:"player/get_share_notes", data:{token:user.token, section_id:product.sectionId, operation:"history", note_id:note.minId}, cache:!1, dataType:"json", type:"GET", success:function (b) {
                    if (0 === b.error) {
                        $(".right .note .note-content .share .more").remove(), $(".right .note .note-content .share .block").remove();
                        for (var c = 0; c < b.data.length; c++) {
                            var d = b.data[c];
                            note.add({id:d.id, type:"0" === d.type ? "text" : "voice", "private":0, slide:d.position, content:d.content, zan:d.laud, zanNum:d.laud_num, user:{id:d.user_id, name:d.user_name}, pull:!0, append:!0, notScroll:!0}), d.id = parseInt(d.id), note.minId = -1 === note.minId || d.id < note.minId ? d.id : note.minId
                        }
                        $(".right .note .note-content .share").append(0 === b.data.length ? '<div class="more" dt-disabled="1"><div class="inner">没有笔记了...</div></div>' : '<div class="more"><div class="inner">点击获取更多笔记</div></div>'), $(".right .note .note-content .share").append('<div class="block"></div>')
                    } else note.fecthMoreFailed(a)
                }, error:function () {
                    note.fecthMoreFailed(a)
                }})
            }
        }, b.prototype.fecthMoreFailed = function (a) {
            a.find(".inner").html("获取笔记失败，请稍后再试"), setTimeout(function () {
                a.removeAttr("dt-disabled"), a.find(".inner").html("点击获取更多笔记")
            }, 1500)
        }, b.prototype.fetchNew = function () {
            if ("1" !== $(this).attr("dt-disabled")) {
                var a = $(this);
                a.html("努力加载中..."), a.attr("dt-disabled", "1"), $.ajax({url:"player/get_share_notes", data:{token:user.token, section_id:product.sectionId, operation:"new", note_id:note.maxId}, cache:!1, dataType:"json", type:"GET", success:function (b) {
                    if (0 === b.error) {
                        a.remove();
                        for (var c = b.data.length - 1; c >= 0; c--) {
                            var d = b.data[c];
                            note.add({id:d.id, type:"0" === d.type ? "text" : "voice", "private":0, slide:d.position, content:d.content, zan:d.laud, zanNum:d.laud_num, user:{id:d.user_id, name:d.user_name}, pull:!0}), note.maxId = -1 === note.maxId || d.id > note.maxId ? d.id : note.maxId
                        }
                        note.totNew = 0
                    } else note.fecthNewFailed(a)
                }, error:function () {
                    note.fecthNewFailed(a)
                }})
            }
        }, b.prototype.fecthNewFailed = function (a) {
            a.html("获取新笔记失败，请稍后再试"), setTimeout(function () {
                a.removeAttr("dt-disabled"), a.html("共有 <span>" + (note.totNew > 99 ? "99+" : note.totNew) + "</span>  条新笔记，点击查看")
            }, 1500)
        }, b.prototype.fetchEssence = function () {
            if ("1" !== $(this).attr("dt-disabled")) {
                var a = $(this);
                a.find(".inner").html("努力加载中..."), a.attr("dt-disabled", "1"), note.page++, $.ajax({url:"player/get_share_notes", data:{token:user.token, section_id:product.sectionId, order:1, page:note.page}, cache:!1, dataType:"json", type:"GET", success:function (b) {
                    if (0 === b.error) {
                        $(".right .note .note-content .essence .more").remove(), $(".right .note .note-content .essence .block").remove();
                        for (var c = 0; c < b.data.length; c++) {
                            var d = b.data[c];
                            note.add({id:d.id, type:"0" === d.type ? "text" : "voice", "private":0, slide:d.position, content:d.content, zan:d.laud, zanNum:d.laud_num, user:{id:d.user_id, name:d.user_name}, pull:!0, append:!0, notScroll:!0, essence:!0})
                        }
                        $(".right .note .note-content .essence").append(0 === b.data.length ? '<div class="more" dt-disabled="1"><div class="inner">没有笔记了...</div></div>' : '<div class="more"><div class="inner">点击获取更多笔记</div></div>'), $(".right .note .note-content .essence").append('<div class="block"></div>')
                    } else note.fecthMoreFailed(a)
                }, error:function () {
                    note.fecthMoreFailed(a)
                }})
            }
        }, b.prototype.playSlide = function () {
            flash.seekPlay($(this).attr("dt-time"))
        }, realtime.on("note", function () {
            note.totNew++, $(".right .note .note-content .share .new").remove();
            var a = $("<div></div>");
            a.addClass("new"), a.append("共有 <span>" + (note.totNew > 99 ? "99+" : note.totNew) + "</span>  条新笔记，点击查看"), $(".right .note .note-content .share").prepend(a)
        }), $(document).ready(function () {
            $(".right .note .note-navi .tab span").click(note.switchTo), $(".right .note .note-content").on("mouseenter", ".message", note.showButton), $(".right .note .note-content").on("mouseleave", ".message", note.hideButton), $(".right .note .note-content .mine").on("click", ".message .header .button .edit-btn", note.edit), $(".right .note .note-content .mine").on("keydown", ".message .edit textarea", note.textGrowTaller), $(".right .note .note-content .mine").on("keyup", ".message .edit textarea", note.textGrowTaller), $(".right .note .note-content .mine").on("click", ".message .edit .save", note.save), $(".right .note .note-content .mine").on("click", ".message .edit-toolbar .check", note.privateToggle), $(".right .note .note-content").on("click", ".message .header .button .share-btn", note.share), $(".right .note .note-content .mine").on("click", ".message .header .button .delete-btn", note.del), $(".right .note .note-content .mine").on("click", ".message .header .button .delete .confirm", note.deleteConfirm), $(".right .note .note-content .mine").on("click", ".message .header .button .delete .cancel", note.deleteCancel), $(".right .note .note-content .share").on("click", ".new", note.fetchNew), $(".right .note .note-content .share").on("click", ".more", note.fetchMore), $(".right .note .note-content .essence").on("click", ".more", note.fetchEssence), $(".right .note .note-content").on("click", ".message .slide", note.playSlide), $(".right .note .note-content").on("click", ".message .header .button .zan-btn", note.zan), note.fetch()
        })
    }).call(this, "undefined" != typeof self ? self : "undefined" != typeof window ? window : {})
}, {}], 14:[function () {
    (function (a) {
        var b = function () {
            this.opened = !1, this.totLevel = 3, this.data = {}, this.list = []
        };
        a.outline = new b, b.prototype.toggle = function () {
            this.opened ? this.close() : this.open()
        }, b.prototype.open = function () {
            if (!this.opened) {
                this.opened = !0, $(".right").css("overflow", "visible"), $(".outline").animate({right:0}, 200, "swing", function () {
                    $(".outline .header").html('<i class="fa fa-angle-double-right"></i> 收起课程大纲')
                });
                for (var a = $('.right .outline .container .item[dt-active="1"]'); a && 0 !== a.length;) {
                    if (a.hasClass("container"))return;
                    a.hasClass("item") && this.openItem(a), a = a.parent()
                }
            }
        }, b.prototype.close = function () {
            this.opened && (this.opened = !1, $(".outline").animate({right:-layout.getW(".outline .container")}, 200, "swing", function () {
                $(".right").css("overflow", "hidden"), $(".outline .header").html('<i class="fa fa-angle-double-left"></i> 展开课程大纲'), $(".outline").find(".child").hide()
            }))
        }, b.prototype.setLevel = function (a) {
            this.totLevel = a
        }, b.prototype.parse = function (a) {
            this.data = a
        }, b.prototype.generate = function () {
            this._generate({root:1, child:this.data}, 0, $(".right .outline .container"))
        }, b.prototype._generate = function (a, b, c) {
            if (a.root)d = c; else {
                var d = $("<div></div>");
                d.addClass("item"), d.addClass("level-" + b), a.child ? (d.attr("dt-id", a.id), d.append('<div class="name"><span><i class="fa fa-caret-right"></i> ' + a.name + "</span></div>"), d.append('<div class="child"></div>')) : (d.addClass("slide"), d.attr("dt-slide", "1"), d.attr("dt-id", a.id), d.attr("dt-version", a.version), d.attr("dt-speechcraft", a.speechcraft), d.attr("dt-freevieew", a.freevieew), d.attr("dt-free", a.free), this.list.push(a.id), d.append(parseInt(a.id) === product.sectionId ? '<span class="icon"><i class="fa fa-play"></i></span>' : "1" === a.free ? '<span class="icon">试听</span>' : '<span class="icon icon-none"></span>'), d.append('<span class="text">' + this.int2Time(a.duration) + "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span>" + a.name + "</span></span>"), d.append('<a class="note-span" href="/user/Note" target="_blank"><i class="fa fa-file-text-o"></i>笔记<span class="num">' + a.note + "</span></a>"), parseInt(a.id) === parseInt(product.sectionId) && (d.attr("dt-active", "1"), d.find(".icon").addClass("icon-active"), d.find(".text").addClass("text-active"), d.find(".note-span").addClass("note-active")), d.append('<div class="clear"></div>'))
            }
            if (a.child)for (var e in a.child)"__proto__" !== e && this._generate(a.child[e], b + 1, d);
            0 !== c.find("> .child").length ? c.find("> .child").append(d) : c.append(d)
        }, b.prototype.toggleItem = function () {
            var a = $(this).parent().parent();
            "1" !== a.attr("dt-slide") && ("none" === a.find("> .child").css("display") ? outline.openItem(a) : outline.closeItem(a))
        }, b.prototype.openItem = function (a) {
            a.find("> .child").show(100, function () {
                layout.setH(".outline .container", layout.getH(".outline .container"))
            }), a.find("> .name").find(".fa").removeClass("fa-caret-right"), a.find("> .name").find(".fa").addClass("fa-caret-down")
        }, b.prototype.closeItem = function (a) {
            a.find(".child").hide(100, function () {
                layout.setH(".outline .container", layout.getH(".outline .container"))
            }), a.find("> .name").find(".fa").removeClass("fa-caret-down"), a.find("> .name").find(".fa").addClass("fa-caret-right")
        }, b.prototype.fetch = function () {
            $.ajax({url:"/outline/get_outline", data:{price_id:product.id}, cache:!1, dataType:"json", type:"GET", success:function (a) {
                outline.parse(a), outline.generate(), $(".right .outline .container .item .name span").click(outline.toggleItem), $(".right .outline .container .slide .text").click(outline.switchSlide);
                for (var b = $(".right .outline .container .slide .text"), c = 0; c < b.length; c++)$(b[c]).qtip({content:{text:$(b[c]).find("span").html()}, position:{my:"right center", at:"left center"}, show:{delay:300}});
                layout.loadingDone("outline", "课程大纲加载完成")
            }, error:function () {
            }})
        }, b.prototype.switchSlide = function () {
            var a = $('.right .outline .container .item[dt-active="1"]');
            "1" === a.attr("dt-free") ? a.find(".icon").html("试听") : (a.find(".icon").html(""), a.find(".icon").addClass("icon-none")), a.find(".icon").removeClass("icon-active"), a.find(".text").removeClass("text-active"), a.find(".note-span").removeClass("note-active"), a.removeAttr("dt-active"), $(this).parent().find(".icon").html('<i class="fa fa-play"></i>'), $(this).parent().find(".icon").removeClass("icon-none"), $(this).parent().find(".icon").addClass("icon-active"), $(this).parent().find(".text").addClass("text-active"), $(this).parent().find(".note-span").addClass("note-active"), $(this).parent().attr("dt-active", "1"), realtime.client.unsubscribe("note." + product.sectionId), product.sectionId = $(this).parent().attr("dt-id"), course.genHash(), realtime.client.subscribe("note." + product.id + "." + product.sectionId), player.closeTip(), course.fetch(), note.init(), note.fetch(), $(".right .note .note-content .share .new").remove(), $(".right .note .message").remove(), $(".right .note .note-content .share .more").removeAttr("dt-disabled"), $(".right .note .note-content .share .more .inner").html("点击获取更多笔记"), setTimeout(function () {
                outline.close()
            }, 500)
        }, b.prototype.playPrev = function () {
            for (var a = -1, b = 0; b < this.list.length; b++)if (parseInt(this.list[b]) === parseInt(product.sectionId)) {
                a = b;
                break
            }
            -1 !== a && $('.right .outline .container .item[dt-id="' + this.list[a - 1] + '"] .text').click()
        }, b.prototype.playNext = function () {
            for (var a = -1, b = 0; b < this.list.length; b++)if (parseInt(this.list[b]) === parseInt(product.sectionId)) {
                a = b;
                break
            }
            -1 !== a && $('.right .outline .container .item[dt-id="' + this.list[a + 1] + '"] .text').click()
        }, b.prototype.getNext = function () {
            for (var a = -1, b = 0; b < this.list.length; b++)if (parseInt(this.list[b]) === parseInt(product.sectionId)) {
                a = b;
                break
            }
            return a
        }, b.prototype.int2Time = function (a) {
            var b = "";
            return a = parseInt(a / 1e3), b = 10 > a % 60 ? "0" + a % 60 : a % 60, a = parseInt(a / 60), b = (10 > a % 60 ? "0" + a % 60 : a % 60) + ":" + b, a = parseInt(a / 60), b = (10 > a % 60 ? "0" + a % 60 : a % 60) + ":" + b
        }, $(document).ready(function () {
            $(".right .outline .header").click(outline.toggle.bind(outline)), $(".left .header .prev").click(outline.playPrev.bind(outline)), $(".left .header .next").click(outline.playNext.bind(outline)), outline.fetch()
        })
    }).call(this, "undefined" != typeof self ? self : "undefined" != typeof window ? window : {})
}, {}], 15:[function () {
    (function (a) {
        var b = function () {
        };
        a.player = new b, b.prototype.showTip = function (a, b, c) {
            $(".left .player .tip .title").html(a), $(".left .player .tip .content").html(b), $(".left .player .tip .button span").remove(), $(".left .player .tip .button").prepend(c), $(".left .player .tip-cover").show(), $(".left .player .tip").show()
        }, b.prototype.closeTip = function () {
            $(".left .player .tip-cover").hide(), $(".left .player .tip").hide()
        }, b.prototype.clickTipBtn = function () {
            "btn-refresh" === $(this).attr("class") && location.reload(), "btn-close" === $(this).attr("class") && player.closeTip(), "btn-continue" === $(this).attr("class") && (flash.continuePlay(), player.closeTip()), "btn-reset" === $(this).attr("class") && (flash.resetPlay(), player.closeTip()), "btn-signin" === $(this).attr("class") && (location.href = "/login"), "btn-buy" === $(this).attr("class") && (location.href = course.info.productUrl), "btn-next" === $(this).attr("class") && $(".left .header .next").click()
        }, b.prototype.int2Time = function (a) {
            var b = "";
            return a = parseInt(a / 1e3), b = 10 > a % 60 ? "0" + a % 60 + "秒" : a % 60 + "秒", a = parseInt(a / 60), 0 !== a && (b = (10 > a % 60 ? "0" + a % 60 : a % 60) + "分" + b, a = parseInt(a / 60), 0 !== a && (b = (10 > a % 60 ? "0" + a % 60 : a % 60) + "小时" + b)), b
        }, b.prototype.load = function () {
            $(".left .player").find("#smartplayer").remove(), $(".left .player").append('<div id="smartplayerinner"></div>');
            var a = {};
            a.before_play = "", a.price_id = product.id, a.section_id = product.sectionId, a.section_version = course.info.sectionVersion, a.server_path = "rtmp://myms.smartstudy.com:8080/study", a.buy = 1, flash.embedFlash(build.cdn + "/swf/SmartPlayerNext.swf", "smartplayer", "", "100%", "100%", "smartplayerinner", a, "transparent"), layout.loadingDone("player", "播放器加载完成")
        }, $(document).ready(function () {
            $(".left .player .tip .close").click(player.closeTip), $(".left .player .tip").on("click", "span", player.clickTipBtn)
        })
    }).call(this, "undefined" != typeof self ? self : "undefined" != typeof window ? window : {})
}, {}], 16:[function (a) {
    (function (b) {
        var c = a("util"), d = a("events"), e = a("../../node_modules/windlike/lib/browser_client.js"), f = function (a) {
            a = a || {}, this.firstLoad = !0, this.token = a.token || "unknown", this.address = a.address || "localhost", this.port = a.port || "2883", this.client = {}, this.user = {}, this.setting()
        };
        c.inherits(f, d.EventEmitter), f.prototype.setting = function () {
            var a = this;
            this.client = new e("http://" + this.address + ":" + this.port + "?token=" + this.token), this.client.on("connected", function () {
                a.firstLoad ? a.firstLoad = !1 : input.showTip("已成功连接服务器", "succeed"), a.emit("connected")
            }), this.client.on("closed", function () {
                input.showTip("已断开连接，正在重连……", "warnging", -1), a.emit("closed")
            }), this.client.on("dead", function () {
                input.showTip("已断开连接，请刷新页面", "fail", -1), a.emit("dead")
            }), this.client.on("message", function (b, c) {
                if (b == "system." + a.token && "user" == c.cmd)return a.user = c.res, void a.emit("init");
                if (b == "system." + a.token)return void a.emit("system." + c.cmd, c);
                try {
                    b = b.split("."), 2 != b.length && (b[1] = 0)
                } catch (d) {
                }
                a.emit(b[0], c)
            })
        }, f.prototype.publish = function (a, b) {
            this.client.publish(a, b)
        }, b.realtime = new f({token:user.token, address:"www.smartstudy.com", port:"1884"}), realtime.on("init", function () {
            0 !== parseInt(course.id) && (this.client.subscribe("chatPub." + product.id + "." + course.id), this.client.subscribe("chatSub." + product.id + "." + course.id)), this.client.subscribe("note." + product.id + "." + product.sectionId)
        })
    }).call(this, "undefined" != typeof self ? self : "undefined" != typeof window ? window : {})
}, {"../../node_modules/windlike/lib/browser_client.js":29, events:24, util:28}], 17:[function (a) {
    (function (b) {
        a("../../bower_components/jquery/jquery.js"), a("../../bower_components/jquery.nicescroll/jquery.nicescroll.min.js"), a("../../bower_components/qtip2/jquery.qtip.min.js"), b.store = a("../../bower_components/store2/dist/store2.js"), Function.prototype.bind || (Function.prototype.bind = Function.prototype.bind || function (a) {
            if ("function" != typeof this)throw new TypeError("Function.prototype.bind - what is trying to be bound is not callable");
            var b = Array.prototype.slice, c = b.call(arguments, 1), d = this, e = function () {
            }, f = function () {
                return d.apply(this instanceof e ? this : a || window, c.concat(b.call(arguments)))
            };
            return e.prototype = this.prototype, f.prototype = new e, f
        }), b.build = {cdn:"/resource/classroom"}
    }).call(this, "undefined" != typeof self ? self : "undefined" != typeof window ? window : {})
}, {"../../bower_components/jquery.nicescroll/jquery.nicescroll.min.js":1, "../../bower_components/jquery/jquery.js":2, "../../bower_components/qtip2/jquery.qtip.min.js":3, "../../bower_components/store2/dist/store2.js":4}], 18:[function () {
    (function (a) {
        a.swfobject = function () {
            function a() {
                if (!R) {
                    try {
                        var a = K.getElementsByTagName("body")[0].appendChild(q("span"));
                        a.parentNode.removeChild(a)
                    } catch (b) {
                        return
                    }
                    R = !0;
                    for (var c = N.length, d = 0; c > d; d++)N[d]()
                }
            }

            function b(a) {
                R ? a() : N[N.length] = a
            }

            function c(a) {
                if (typeof J.addEventListener != C)J.addEventListener("load", a, !1); else if (typeof K.addEventListener != C)K.addEventListener("load", a, !1); else if (typeof J.attachEvent != C)r(J, "onload", a); else if ("function" == typeof J.onload) {
                    var b = J.onload;
                    J.onload = function () {
                        b(), a()
                    }
                } else J.onload = a
            }

            function d() {
                M ? e() : f()
            }

            function e() {
                var a = K.getElementsByTagName("body")[0], b = q(D);
                b.setAttribute("type", G);
                var c = a.appendChild(b);
                if (c) {
                    var d = 0;
                    !function () {
                        if (typeof c.GetVariable != C) {
                            var e = c.GetVariable("$version");
                            e && (e = e.split(" ")[1].split(","), U.pv = [parseInt(e[0], 10), parseInt(e[1], 10), parseInt(e[2], 10)])
                        } else if (10 > d)return d++, void setTimeout(arguments.callee, 10);
                        a.removeChild(b), c = null, f()
                    }()
                } else f()
            }

            function f() {
                var a = O.length;
                if (a > 0)for (var b = 0; a > b; b++) {
                    var c = O[b].id, d = O[b].callbackFn, e = {success:!1, id:c};
                    if (U.pv[0] > 0) {
                        var f = p(c);
                        if (f)if (!s(O[b].swfVersion) || U.wk && U.wk < 312)if (O[b].expressInstall && h()) {
                            var k = {};
                            k.data = O[b].expressInstall, k.width = f.getAttribute("width") || "0", k.height = f.getAttribute("height") || "0", f.getAttribute("class") && (k.styleclass = f.getAttribute("class")), f.getAttribute("align") && (k.align = f.getAttribute("align"));
                            for (var l = {}, m = f.getElementsByTagName("param"), n = m.length, o = 0; n > o; o++)"movie" != m[o].getAttribute("name").toLowerCase() && (l[m[o].getAttribute("name")] = m[o].getAttribute("value"));
                            i(k, l, c, d)
                        } else j(f), d && d(e); else u(c, !0), d && (e.success = !0, e.ref = g(c), d(e))
                    } else if (u(c, !0), d) {
                        var q = g(c);
                        q && typeof q.SetVariable != C && (e.success = !0, e.ref = q), d(e)
                    }
                }
            }

            function g(a) {
                var b = null, c = p(a);
                if (c && "OBJECT" == c.nodeName)if (typeof c.SetVariable != C)b = c; else {
                    var d = c.getElementsByTagName(D)[0];
                    d && (b = d)
                }
                return b
            }

            function h() {
                return!S && s("6.0.65") && (U.win || U.mac) && !(U.wk && U.wk < 312)
            }

            function i(a, b, c, d) {
                S = !0, y = d || null, z = {success:!1, id:c};
                var e = p(c);
                if (e) {
                    "OBJECT" == e.nodeName ? (w = k(e), x = null) : (w = e, x = c), a.id = H, (typeof a.width == C || !/%$/.test(a.width) && parseInt(a.width, 10) < 310) && (a.width = "310"), (typeof a.height == C || !/%$/.test(a.height) && parseInt(a.height, 10) < 137) && (a.height = "137"), K.title = K.title.slice(0, 47) + " - Flash Player Installation";
                    var f = U.ie && U.win ? "ActiveX" : "PlugIn", g = "MMredirectURL=" + encodeURI(window.location).toString().replace(/&/g, "%26") + "&MMplayerType=" + f + "&MMdoctitle=" + K.title;
                    if (typeof b.flashvars != C ? b.flashvars += "&" + g : b.flashvars = g, U.ie && U.win && 4 != e.readyState) {
                        var h = q("div");
                        c += "SWFObjectNew", h.setAttribute("id", c), e.parentNode.insertBefore(h, e), e.style.display = "none", function () {
                            4 == e.readyState ? e.parentNode.removeChild(e) : setTimeout(arguments.callee, 10)
                        }()
                    }
                    l(a, b, c)
                }
            }

            function j(a) {
                if (U.ie && U.win && 4 != a.readyState) {
                    var b = q("div");
                    a.parentNode.insertBefore(b, a), b.parentNode.replaceChild(k(a), b), a.style.display = "none", function () {
                        4 == a.readyState ? a.parentNode.removeChild(a) : setTimeout(arguments.callee, 10)
                    }()
                } else a.parentNode.replaceChild(k(a), a)
            }

            function k(a) {
                var b = q("div");
                if (U.win && U.ie)b.innerHTML = a.innerHTML; else {
                    var c = a.getElementsByTagName(D)[0];
                    if (c) {
                        var d = c.childNodes;
                        if (d)for (var e = d.length, f = 0; e > f; f++)1 == d[f].nodeType && "PARAM" == d[f].nodeName || 8 == d[f].nodeType || b.appendChild(d[f].cloneNode(!0))
                    }
                }
                return b
            }

            function l(a, b, c) {
                var d, e = p(c);
                if (U.wk && U.wk < 312)return d;
                if (e)if (typeof a.id == C && (a.id = c), U.ie && U.win) {
                    var f = "";
                    for (var g in a)a[g] != Object.prototype[g] && ("data" == g.toLowerCase() ? b.movie = a[g] : "styleclass" == g.toLowerCase() ? f += ' class="' + a[g] + '"' : "classid" != g.toLowerCase() && (f += " " + g + '="' + a[g] + '"'));
                    var h = "";
                    for (var i in b)b[i] != Object.prototype[i] && (h += '<param name="' + i + '" value="' + b[i] + '" />');
                    e.outerHTML = '<object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000"' + f + ">" + h + "</object>", P[P.length] = a.id, d = p(a.id)
                } else {
                    var j = q(D);
                    j.setAttribute("type", G);
                    for (var k in a)a[k] != Object.prototype[k] && ("styleclass" == k.toLowerCase() ? j.setAttribute("class", a[k]) : "classid" != k.toLowerCase() && j.setAttribute(k, a[k]));
                    for (var l in b)b[l] != Object.prototype[l] && "movie" != l.toLowerCase() && m(j, l, b[l]);
                    e.parentNode.replaceChild(j, e), d = j
                }
                return d
            }

            function m(a, b, c) {
                var d = q("param");
                d.setAttribute("name", b), d.setAttribute("value", c), a.appendChild(d)
            }

            function n(a) {
                var b = p(a);
                b && "OBJECT" == b.nodeName && (U.ie && U.win ? (b.style.display = "none", function () {
                    4 == b.readyState ? o(a) : setTimeout(arguments.callee, 10)
                }()) : b.parentNode.removeChild(b))
            }

            function o(a) {
                var b = p(a);
                if (b) {
                    for (var c in b)"function" == typeof b[c] && (b[c] = null);
                    b.parentNode.removeChild(b)
                }
            }

            function p(a) {
                var b = null;
                try {
                    b = K.getElementById(a)
                } catch (c) {
                }
                return b
            }

            function q(a) {
                return K.createElement(a)
            }

            function r(a, b, c) {
                a.attachEvent(b, c), Q[Q.length] = [a, b, c]
            }

            function s(a) {
                var b = U.pv, c = a.split(".");
                return c[0] = parseInt(c[0], 10), c[1] = parseInt(c[1], 10) || 0, c[2] = parseInt(c[2], 10) || 0, b[0] > c[0] || b[0] == c[0] && b[1] > c[1] || b[0] == c[0] && b[1] == c[1] && b[2] >= c[2] ? !0 : !1
            }

            function t(a, b, c, d) {
                if (!U.ie || !U.mac) {
                    var e = K.getElementsByTagName("head")[0];
                    if (e) {
                        var f = c && "string" == typeof c ? c : "screen";
                        if (d && (A = null, B = null), !A || B != f) {
                            var g = q("style");
                            g.setAttribute("type", "text/css"), g.setAttribute("media", f), A = e.appendChild(g), U.ie && U.win && typeof K.styleSheets != C && K.styleSheets.length > 0 && (A = K.styleSheets[K.styleSheets.length - 1]), B = f
                        }
                        U.ie && U.win ? A && typeof A.addRule == D && A.addRule(a, b) : A && typeof K.createTextNode != C && A.appendChild(K.createTextNode(a + " {" + b + "}"))
                    }
                }
            }

            function u(a, b) {
                if (T) {
                    var c = b ? "visible" : "hidden";
                    R && p(a) ? p(a).style.visibility = c : t("#" + a, "visibility:" + c)
                }
            }

            function v(a) {
                var b = /[\\\"<>\.;]/, c = null != b.exec(a);
                return c && typeof encodeURIComponent != C ? encodeURIComponent(a) : a
            }

            {
                var w, x, y, z, A, B, C = "undefined", D = "object", E = "Shockwave Flash", F = "ShockwaveFlash.ShockwaveFlash", G = "application/x-shockwave-flash", H = "SWFObjectExprInst", I = "onreadystatechange", J = window, K = document, L = navigator, M = !1, N = [d], O = [], P = [], Q = [], R = !1, S = !1, T = !0, U = function () {
                    var a = typeof K.getElementById != C && typeof K.getElementsByTagName != C && typeof K.createElement != C, b = L.userAgent.toLowerCase(), c = L.platform.toLowerCase(), d = /win/.test(c ? c : b), e = /mac/.test(c ? c : b), f = /webkit/.test(b) ? parseFloat(b.replace(/^.*webkit\/(\d+(\.\d+)?).*$/, "$1")) : !1, g = !1, h = [0, 0, 0], i = null;
                    if (typeof L.plugins != C && typeof L.plugins[E] == D)i = L.plugins[E].description, !i || typeof L.mimeTypes != C && L.mimeTypes[G] && !L.mimeTypes[G].enabledPlugin || (M = !0, g = !1, i = i.replace(/^.*\s+(\S+\s+\S+$)/, "$1"), h[0] = parseInt(i.replace(/^(.*)\..*$/, "$1"), 10), h[1] = parseInt(i.replace(/^.*\.(.*)\s.*$/, "$1"), 10), h[2] = /[a-zA-Z]/.test(i) ? parseInt(i.replace(/^.*[a-zA-Z]+(.*)$/, "$1"), 10) : 0); else if (typeof J.ActiveXObject != C)try {
                        var j = new ActiveXObject(F);
                        j && (i = j.GetVariable("$version"), i && (g = !0, i = i.split(" ")[1].split(","), h = [parseInt(i[0], 10), parseInt(i[1], 10), parseInt(i[2], 10)]))
                    } catch (k) {
                    }
                    return{w3:a, pv:h, wk:f, ie:g, win:d, mac:e}
                }();
                !function () {
                    U.w3 && ((typeof K.readyState != C && "complete" == K.readyState || typeof K.readyState == C && (K.getElementsByTagName("body")[0] || K.body)) && a(), R || (typeof K.addEventListener != C && K.addEventListener("DOMContentLoaded", a, !1), U.ie && U.win && (K.attachEvent(I, function () {
                        "complete" == K.readyState && (K.detachEvent(I, arguments.callee), a())
                    }), J == top && !function () {
                        if (!R) {
                            try {
                                K.documentElement.doScroll("left")
                            } catch (b) {
                                return void setTimeout(arguments.callee, 0)
                            }
                            a()
                        }
                    }()), U.wk && !function () {
                        return R ? void 0 : /loaded|complete/.test(K.readyState) ? void a() : void setTimeout(arguments.callee, 0)
                    }(), c(a)))
                }(), function () {
                    U.ie && U.win && window.attachEvent("onunload", function () {
                        for (var a = Q.length, b = 0; a > b; b++)Q[b][0].detachEvent(Q[b][1], Q[b][2]);
                        for (var c = P.length, d = 0; c > d; d++)n(P[d]);
                        for (var e in U)U[e] = null;
                        U = null;
                        for (var f in swfobject)swfobject[f] = null;
                        swfobject = null
                    })
                }()
            }
            return{registerObject:function (a, b, c, d) {
                if (U.w3 && a && b) {
                    var e = {};
                    e.id = a, e.swfVersion = b, e.expressInstall = c, e.callbackFn = d, O[O.length] = e, u(a, !1)
                } else d && d({success:!1, id:a})
            }, getObjectById:function (a) {
                return U.w3 ? g(a) : void 0
            }, embedSWF:function (a, c, d, e, f, g, j, k, m, n) {
                var o = {success:!1, id:c};
                U.w3 && !(U.wk && U.wk < 312) && a && c && d && e && f ? (u(c, !1), b(function () {
                    d += "", e += "";
                    var b = {};
                    if (m && typeof m === D)for (var p in m)b[p] = m[p];
                    b.data = a, b.width = d, b.height = e;
                    var q = {};
                    if (k && typeof k === D)for (var r in k)q[r] = k[r];
                    if (j && typeof j === D)for (var t in j)typeof q.flashvars != C ? q.flashvars += "&" + t + "=" + j[t] : q.flashvars = t + "=" + j[t];
                    if (s(f)) {
                        var v = l(b, q, c);
                        b.id == c && u(c, !0), o.success = !0, o.ref = v
                    } else {
                        if (g && h())return b.data = g, void i(b, q, c, n);
                        u(c, !0)
                    }
                    n && n(o)
                })) : n && n(o)
            }, switchOffAutoHideShow:function () {
                T = !1
            }, ua:U, getFlashPlayerVersion:function () {
                return{major:U.pv[0], minor:U.pv[1], release:U.pv[2]}
            }, hasFlashPlayerVersion:s, createSWF:function (a, b, c) {
                return U.w3 ? l(a, b, c) : void 0
            }, showExpressInstall:function (a, b, c, d) {
                U.w3 && h() && i(a, b, c, d)
            }, removeSWF:function (a) {
                U.w3 && n(a)
            }, createCSS:function (a, b, c, d) {
                U.w3 && t(a, b, c, d)
            }, addDomLoadEvent:b, addLoadEvent:c, getQueryParamValue:function (a) {
                var b = K.location.search || K.location.hash;
                if (b) {
                    if (/\?/.test(b) && (b = b.split("?")[1]), null == a)return v(b);
                    for (var c = b.split("&"), d = 0; d < c.length; d++)if (c[d].substring(0, c[d].indexOf("=")) == a)return v(c[d].substring(c[d].indexOf("=") + 1))
                }
                return""
            }, expressInstallCallback:function () {
                if (S) {
                    var a = p(H);
                    a && w && (a.parentNode.replaceChild(w, a), x && (u(x, !0), U.ie && U.win && (w.style.display = "block")), y && y(z)), S = !1
                }
            }}
        }()
    }).call(this, "undefined" != typeof self ? self : "undefined" != typeof window ? window : {})
}, {}], 19:[function () {
    var a = function () {
    }, b = new a;
    a.prototype.switchTo = function () {
        $(".right .plugin").hide(), $("#" + layout.scrollId.chat).hide(), $("#" + layout.scrollId.note).hide(), $(".right ." + $(this).attr("dt-id")).show(), $("#" + layout.scrollId[$(this).attr("dt-id")]).show(), $(".right .navi span").removeClass("active"), $(this).addClass("active"), "chat" === $(this).attr("dt-id") ? ($(".right .input").attr("dt-id", "chat"), $(".right .input .keyboard .textarea").attr("placeholder", "输入您想说的话..."), $(".right .input .keyboard .text .emoji").show()) : ($(".right .input").attr("dt-id", "note"), $(".right .input .keyboard .textarea")
            .attr("placeholder", "随时记录笔记..."),
            $(".right .input .keyboard .textarea").attr("id", "remeberBJ"),
            $(".right .input .keyboard .textarea").attr("onfocus","remeberBJ()"),
            $(".right .input .keyboard .text .emoji").hide(), $(".right .input .keyboard .emoji-div").hide()), $(".right .input .keyboard .text .textarea").val(""), input.textGrowTaller(), "voice" === $(".right .input").attr("dt-type") && ($(".right .recorder").hide(), setTimeout(function () {
            $(".right .recorder").show()
        }, 1)), input.toolbarShow = 0, $(".right .input .toolbar").hide(), $(".right .input .toolbar .slide").attr("dt-time", "-1"), layout.right()
    }, $(document).ready(function () {
        $(".right .navi span").click(b.switchTo)
    })
}, {}], 20:[function () {
    (function (a) {
        var b = function () {
            this.covered = 0, this.step = 0, this.done = !1
        };
        a.teach = new b, b.prototype.process = function (a) {
            this.done || (a = a || 1, this.step = a, 0 === this.covered && (this.covered = 1, $("body").append('<div class="teach-cover teach-top"></div>'), $("body").append('<div class="teach-cover teach-bottom"></div>'), $("body").append('<div class="teach-cover teach-left"></div>'), $("body").append('<div class="teach-cover teach-right"></div>'), $("body").append('<div class="teach-cover teach-highlight"></div>'), $("body").append('<div class="teach-cloud"><div class="text"></div><div class="button"><span class="cancel">我知道了</span><span class="next">下一步</span><span class="ok">开始学习</span></div><div class="arrow-up"></div><div class="arrow-down"></div></div>'), $(".teach-cloud .next").click(this.next), $(".teach-cloud .cancel").click(this.close), $(".teach-cloud .ok").click(this.close)), 1 === a && (this.layout($(".right .navi .chat-tab").offset().left, $(".right .navi .chat-tab").offset().top, $(".right .navi .note-tab").offset().left + layout.getW(".right .navi .note-tab"), $(".right .navi .note-tab").offset().top + layout.getH(".right .navi .note-tab"), "up"), $(".teach-cloud .text").html("[1/7] <font>随堂交流</font>和<font>记笔记</font>功能上线公测啦！马上和一起听课的小伙伴交流吧！")), 2 === a && (this.layout($(".right .input").offset().left, $(".right .input").offset().top, $(".right .input").offset().left + layout.getW(".right .input"), $(".right .input").offset().top + layout.getH(".right .input"), "down"), $(".teach-cloud .text").html("[2/7] 学习有困惑？想认识备考战友？想和名师大拿<font>互动交流</font>，赶快来吧！"), $(".teach-cloud").css("top", $(".right .input").offset().top - 245), $(".teach-cloud").css("left", parseInt($(".teach-cloud").css("left")) + 50)), 3 === a && ($(".right .input .keyboard .icon").click(), this.layout($(".right .input").offset().left, $(".right .input").offset().top, $(".right .input").offset().left + layout.getW(".right .input"), $(".right .input").offset().top + layout.getH(".right .input"), "down"), $(".teach-cloud .text").html("[3/7] 点击这里切换到<font>“语音”</font>模式，用语音和同学们随堂交流。"), $(".teach-cloud").css("left", $(".right .input").offset().left - 507), $(".teach-cloud").css("top", parseInt($(".teach-cloud").css("top")) + 20)), 4 === a && ($(".right .input .voice .icon").click(), note.add({id:"test", "private":0, slide:123456, type:"text", content:"我是一条测试笔记。点击分享，将我一键分享给自己的朋友。", zan:0, zanNum:0}), $(".right .navi .note-tab").click(), $('.right .note .note-content .mine .message[dt-id="test"] .header .button').show(), this.layout($('.right .note .note-content .mine .message[dt-id="test"] .header .button').offset().left - 20, $('.right .note .note-content .mine .message[dt-id="test"] .header .button').offset().top, $('.right .note .note-content .mine .message[dt-id="test"] .header .button').offset().left + layout.getW('.right .note .note-content .mine .message[dt-id="test"] .header .button') + 20, $('.right .note .note-content .mine .message[dt-id="test"] .header .button').offset().top + layout.getH('.right .note .note-content .mine .message[dt-id="test"] .header .button'), "up"), $(".teach-cloud .text").html("[4/7] 点击分享，将笔记<font>一键分享</font>给自己的朋友。"), $(".teach-cloud").css("left", parseInt($(".teach-cloud").css("left")) + 14), $(".teach-cloud").css("top", parseInt($(".teach-cloud").css("top")) - 7)), 5 === a && ($('.right .note .note-navi .tab[dt-id="share"] span').click(), this.layout($('.right .note .note-navi .tab[dt-id="share"] span').offset().left - 20, $('.right .note .note-navi .tab[dt-id="share"] span').offset().top - 7, $('.right .note .note-navi .tab[dt-id="share"] span').offset().left + layout.getW('.right .note .note-navi .tab[dt-id="share"] span') + 20, $('.right .note .note-navi .tab[dt-id="share"] span').offset().top + layout.getH('.right .note .note-navi .tab[dt-id="share"] span') + 7, "up"), $(".teach-cloud .text").html("[5/7] 看看高分达人和备考战友分享的笔记，早日炼成学霸。"), $(".teach-cloud").css("left", parseInt($(".teach-cloud").css("left")) - 38), $(".teach-cloud").css("top", parseInt($(".teach-cloud").css("top")) - 7)), 6 === a && (this.layout($(".right .outline .header").offset().left, $(".right .outline .header").offset().top, $(".right .outline .header").offset().left + layout.getW(".right .outline .header"), $(".right .outline .header").offset().top + layout.getH(".right .outline .header"), "up"), $(".teach-cloud .text").html("[6/7] 展开本<font>课程大纲</font>，自由选择章节和知识点，个性化学习复习节奏。"), $(".teach-cloud").css("left", parseInt($(".teach-cloud").css("left")) - 20), $(".teach-cloud").css("top", parseInt($(".teach-cloud").css("top")) - 5)), 7 === a && (outline.open(), setTimeout(function () {
                var a = '.right .outline .container .item[dt-id="' + product.sectionId + '"] .note-span';
                teach.layout($(a).offset().left, $(a).offset().top, $(a).offset().left + layout.getW(a), $(a).offset().top + layout.getH(a), "up"), $(".teach-cloud .text").html("[7/7] 每一条笔记，都会精准定位到相应知识点，快速查看高效学习。"), $(".teach-cloud").css("left", parseInt($(".teach-cloud").css("left")) - 50), $(".teach-cloud").css("top", parseInt($(".teach-cloud").css("top")) - 5), $(".teach-cloud .button span").hide(), $(".teach-cloud .button .ok").show()
            }, 250)))
        }, b.prototype.layout = function (a, b, c, d, e) {
            $(".teach-top").css("height", b), $(".teach-bottom").css("height", layout.pageH - d), $(".teach-bottom").css("top", d), $(".teach-left").css("width", a), $(".teach-left").css("height", d - b), $(".teach-left").css("top", b), $(".teach-right").css("width", layout.pageW - c), $(".teach-right").css("height", d - b), $(".teach-right").css("top", b), $(".teach-right").css("left", c), "up" === e ? ($(".teach-cloud").css("left", a - 450), $(".teach-cloud").css("top", d + 45), $(".teach-cloud .arrow-up").show(), $(".teach-cloud .arrow-down").hide()) : ($(".teach-cloud").css("left", a - 450), $(".teach-cloud").css("top", b - 265), $(".teach-cloud .arrow-up").hide(), $(".teach-cloud .arrow-down").show())
        }, b.prototype.next = function () {
            teach.process(teach.step + 1)
        }, b.prototype.close = function () {
            teach.done = !0, store.set("teach." + user.id, "1"), store.set("teach.0", "1"), $(".teach-cover").remove(), $(".teach-cloud").remove(), teach.step >= 3 && $(".right .input .voice .icon").click(), teach.step >= 4 && ($('.right .note .note-content .mine .message[dt-id="test"]').remove(), $(".right .navi .chat-tab").click()), teach.step >= 5 && $('.right .note .note-navi .tab[dt-id="mine"] span').click(), teach.step >= 7 && outline.close(), flash.teach && (flash.teach = !1, flash.resetPlay())
        }, $(document).ready(function () {
        })
    }).call(this, "undefined" != typeof self ? self : "undefined" != typeof window ? window : {})
}, {}], 21:[function (a, b, c) {
    function d(a, b, c) {
        if (!(this instanceof d))return new d(a, b, c);
        var e, f = typeof a;
        if ("number" === f)e = a > 0 ? a >>> 0 : 0; else if ("string" === f)"base64" === b && (a = C(a)), e = d.byteLength(a, b); else {
            if ("object" !== f || null === a)throw new Error("First argument needs to be a number, array or string.");
            "Buffer" === a.type && E(a.data) && (a = a.data), e = +a.length > 0 ? Math.floor(+a.length) : 0
        }
        var g;
        T ? g = d._augment(new Uint8Array(e)) : (g = this, g.length = e, g._isBuffer = !0);
        var h;
        if (T && "number" == typeof a.byteLength)g._set(a); else if (F(a))if (d.isBuffer(a))for (h = 0; e > h; h++)g[h] = a.readUInt8(h); else for (h = 0; e > h; h++)g[h] = (a[h] % 256 + 256) % 256; else if ("string" === f)g.write(a, 0, b); else if ("number" === f && !T && !c)for (h = 0; e > h; h++)g[h] = 0;
        return g
    }

    function e(a, b, c, d) {
        c = Number(c) || 0;
        var e = a.length - c;
        d ? (d = Number(d), d > e && (d = e)) : d = e;
        var f = b.length;
        Q(f % 2 === 0, "Invalid hex string"), d > f / 2 && (d = f / 2);
        for (var g = 0; d > g; g++) {
            var h = parseInt(b.substr(2 * g, 2), 16);
            Q(!isNaN(h), "Invalid hex string"), a[c + g] = h
        }
        return g
    }

    function f(a, b, c, d) {
        var e = L(H(b), a, c, d);
        return e
    }

    function g(a, b, c, d) {
        var e = L(I(b), a, c, d);
        return e
    }

    function h(a, b, c, d) {
        return g(a, b, c, d)
    }

    function i(a, b, c, d) {
        var e = L(K(b), a, c, d);
        return e
    }

    function j(a, b, c, d) {
        var e = L(J(b), a, c, d);
        return e
    }

    function k(a, b, c) {
        return R.fromByteArray(0 === b && c === a.length ? a : a.slice(b, c))
    }

    function l(a, b, c) {
        var d = "", e = "";
        c = Math.min(a.length, c);
        for (var f = b; c > f; f++)a[f] <= 127 ? (d += M(e) + String.fromCharCode(a[f]), e = "") : e += "%" + a[f].toString(16);
        return d + M(e)
    }

    function m(a, b, c) {
        var d = "";
        c = Math.min(a.length, c);
        for (var e = b; c > e; e++)d += String.fromCharCode(a[e]);
        return d
    }

    function n(a, b, c) {
        return m(a, b, c)
    }

    function o(a, b, c) {
        var d = a.length;
        (!b || 0 > b) && (b = 0), (!c || 0 > c || c > d) && (c = d);
        for (var e = "", f = b; c > f; f++)e += G(a[f]);
        return e
    }

    function p(a, b, c) {
        for (var d = a.slice(b, c), e = "", f = 0; f < d.length; f += 2)e += String.fromCharCode(d[f] + 256 * d[f + 1]);
        return e
    }

    function q(a, b, c, d) {
        d || (Q("boolean" == typeof c, "missing or invalid endian"), Q(void 0 !== b && null !== b, "missing offset"), Q(b + 1 < a.length, "Trying to read beyond buffer length"));
        var e = a.length;
        if (!(b >= e)) {
            var f;
            return c ? (f = a[b], e > b + 1 && (f |= a[b + 1] << 8)) : (f = a[b] << 8, e > b + 1 && (f |= a[b + 1])), f
        }
    }

    function r(a, b, c, d) {
        d || (Q("boolean" == typeof c, "missing or invalid endian"), Q(void 0 !== b && null !== b, "missing offset"), Q(b + 3 < a.length, "Trying to read beyond buffer length"));
        var e = a.length;
        if (!(b >= e)) {
            var f;
            return c ? (e > b + 2 && (f = a[b + 2] << 16), e > b + 1 && (f |= a[b + 1] << 8), f |= a[b], e > b + 3 && (f += a[b + 3] << 24 >>> 0)) : (e > b + 1 && (f = a[b + 1] << 16), e > b + 2 && (f |= a[b + 2] << 8), e > b + 3 && (f |= a[b + 3]), f += a[b] << 24 >>> 0), f
        }
    }

    function s(a, b, c, d) {
        d || (Q("boolean" == typeof c, "missing or invalid endian"), Q(void 0 !== b && null !== b, "missing offset"), Q(b + 1 < a.length, "Trying to read beyond buffer length"));
        var e = a.length;
        if (!(b >= e)) {
            var f = q(a, b, c, !0), g = 32768 & f;
            return g ? -1 * (65535 - f + 1) : f
        }
    }

    function t(a, b, c, d) {
        d || (Q("boolean" == typeof c, "missing or invalid endian"), Q(void 0 !== b && null !== b, "missing offset"), Q(b + 3 < a.length, "Trying to read beyond buffer length"));
        var e = a.length;
        if (!(b >= e)) {
            var f = r(a, b, c, !0), g = 2147483648 & f;
            return g ? -1 * (4294967295 - f + 1) : f
        }
    }

    function u(a, b, c, d) {
        return d || (Q("boolean" == typeof c, "missing or invalid endian"), Q(b + 3 < a.length, "Trying to read beyond buffer length")), S.read(a, b, c, 23, 4)
    }

    function v(a, b, c, d) {
        return d || (Q("boolean" == typeof c, "missing or invalid endian"), Q(b + 7 < a.length, "Trying to read beyond buffer length")), S.read(a, b, c, 52, 8)
    }

    function w(a, b, c, d, e) {
        e || (Q(void 0 !== b && null !== b, "missing value"), Q("boolean" == typeof d, "missing or invalid endian"), Q(void 0 !== c && null !== c, "missing offset"), Q(c + 1 < a.length, "trying to write beyond buffer length"), N(b, 65535));
        var f = a.length;
        if (!(c >= f)) {
            for (var g = 0, h = Math.min(f - c, 2); h > g; g++)a[c + g] = (b & 255 << 8 * (d ? g : 1 - g)) >>> 8 * (d ? g : 1 - g);
            return c + 2
        }
    }

    function x(a, b, c, d, e) {
        e || (Q(void 0 !== b && null !== b, "missing value"), Q("boolean" == typeof d, "missing or invalid endian"), Q(void 0 !== c && null !== c, "missing offset"), Q(c + 3 < a.length, "trying to write beyond buffer length"), N(b, 4294967295));
        var f = a.length;
        if (!(c >= f)) {
            for (var g = 0, h = Math.min(f - c, 4); h > g; g++)a[c + g] = b >>> 8 * (d ? g : 3 - g) & 255;
            return c + 4
        }
    }

    function y(a, b, c, d, e) {
        e || (Q(void 0 !== b && null !== b, "missing value"), Q("boolean" == typeof d, "missing or invalid endian"), Q(void 0 !== c && null !== c, "missing offset"), Q(c + 1 < a.length, "Trying to write beyond buffer length"), O(b, 32767, -32768));
        var f = a.length;
        if (!(c >= f))return b >= 0 ? w(a, b, c, d, e) : w(a, 65535 + b + 1, c, d, e), c + 2
    }

    function z(a, b, c, d, e) {
        e || (Q(void 0 !== b && null !== b, "missing value"), Q("boolean" == typeof d, "missing or invalid endian"), Q(void 0 !== c && null !== c, "missing offset"), Q(c + 3 < a.length, "Trying to write beyond buffer length"), O(b, 2147483647, -2147483648));
        var f = a.length;
        if (!(c >= f))return b >= 0 ? x(a, b, c, d, e) : x(a, 4294967295 + b + 1, c, d, e), c + 4
    }

    function A(a, b, c, d, e) {
        e || (Q(void 0 !== b && null !== b, "missing value"), Q("boolean" == typeof d, "missing or invalid endian"), Q(void 0 !== c && null !== c, "missing offset"), Q(c + 3 < a.length, "Trying to write beyond buffer length"), P(b, 3.4028234663852886e38, -3.4028234663852886e38));
        var f = a.length;
        if (!(c >= f))return S.write(a, b, c, d, 23, 4), c + 4
    }

    function B(a, b, c, d, e) {
        e || (Q(void 0 !== b && null !== b, "missing value"), Q("boolean" == typeof d, "missing or invalid endian"), Q(void 0 !== c && null !== c, "missing offset"), Q(c + 7 < a.length, "Trying to write beyond buffer length"), P(b, 1.7976931348623157e308, -1.7976931348623157e308));
        var f = a.length;
        if (!(c >= f))return S.write(a, b, c, d, 52, 8), c + 8
    }

    function C(a) {
        for (a = D(a).replace(V, ""); a.length % 4 !== 0;)a += "=";
        return a
    }

    function D(a) {
        return a.trim ? a.trim() : a.replace(/^\s+|\s+$/g, "")
    }

    function E(a) {
        return(Array.isArray || function (a) {
            return"[object Array]" === Object.prototype.toString.call(a)
        })(a)
    }

    function F(a) {
        return E(a) || d.isBuffer(a) || a && "object" == typeof a && "number" == typeof a.length
    }

    function G(a) {
        return 16 > a ? "0" + a.toString(16) : a.toString(16)
    }

    function H(a) {
        for (var b = [], c = 0; c < a.length; c++) {
            var d = a.charCodeAt(c);
            if (127 >= d)b.push(d); else {
                var e = c;
                d >= 55296 && 57343 >= d && c++;
                for (var f = encodeURIComponent(a.slice(e, c + 1)).substr(1).split("%"), g = 0; g < f.length; g++)b.push(parseInt(f[g], 16))
            }
        }
        return b
    }

    function I(a) {
        for (var b = [], c = 0; c < a.length; c++)b.push(255 & a.charCodeAt(c));
        return b
    }

    function J(a) {
        for (var b, c, d, e = [], f = 0; f < a.length; f++)b = a.charCodeAt(f), c = b >> 8, d = b % 256, e.push(d), e.push(c);
        return e
    }

    function K(a) {
        return R.toByteArray(a)
    }

    function L(a, b, c, d) {
        for (var e = 0; d > e && !(e + c >= b.length || e >= a.length); e++)b[e + c] = a[e];
        return e
    }

    function M(a) {
        try {
            return decodeURIComponent(a)
        } catch (b) {
            return String.fromCharCode(65533)
        }
    }

    function N(a, b) {
        Q("number" == typeof a, "cannot write a non-number as a number"), Q(a >= 0, "specified a negative value for writing an unsigned value"), Q(b >= a, "value is larger than maximum value for type"), Q(Math.floor(a) === a, "value has a fractional component")
    }

    function O(a, b, c) {
        Q("number" == typeof a, "cannot write a non-number as a number"), Q(b >= a, "value larger than maximum allowed value"), Q(a >= c, "value smaller than minimum allowed value"), Q(Math.floor(a) === a, "value has a fractional component")
    }

    function P(a, b, c) {
        Q("number" == typeof a, "cannot write a non-number as a number"), Q(b >= a, "value larger than maximum allowed value"), Q(a >= c, "value smaller than minimum allowed value")
    }

    function Q(a, b) {
        if (!a)throw new Error(b || "Failed assertion")
    }

    var R = a("base64-js"), S = a("ieee754");
    c.Buffer = d, c.SlowBuffer = d, c.INSPECT_MAX_BYTES = 50, d.poolSize = 8192;
    var T = function () {
        try {
            var a = new ArrayBuffer(0), b = new Uint8Array(a);
            return b.foo = function () {
                return 42
            }, 42 === b.foo() && "function" == typeof b.subarray && 0 === new Uint8Array(1).subarray(1, 1).byteLength
        } catch (c) {
            return!1
        }
    }();
    d.isEncoding = function (a) {
        switch (String(a).toLowerCase()) {
            case"hex":
            case"utf8":
            case"utf-8":
            case"ascii":
            case"binary":
            case"base64":
            case"raw":
            case"ucs2":
            case"ucs-2":
            case"utf16le":
            case"utf-16le":
                return!0;
            default:
                return!1
        }
    }, d.isBuffer = function (a) {
        return!(null == a || !a._isBuffer)
    }, d.byteLength = function (a, b) {
        var c;
        switch (a = a.toString(), b || "utf8") {
            case"hex":
                c = a.length / 2;
                break;
            case"utf8":
            case"utf-8":
                c = H(a).length;
                break;
            case"ascii":
            case"binary":
            case"raw":
                c = a.length;
                break;
            case"base64":
                c = K(a).length;
                break;
            case"ucs2":
            case"ucs-2":
            case"utf16le":
            case"utf-16le":
                c = 2 * a.length;
                break;
            default:
                throw new Error("Unknown encoding")
        }
        return c
    }, d.concat = function (a, b) {
        if (Q(E(a), "Usage: Buffer.concat(list[, length])"), 0 === a.length)return new d(0);
        if (1 === a.length)return a[0];
        var c;
        if (void 0 === b)for (b = 0, c = 0; c < a.length; c++)b += a[c].length;
        var e = new d(b), f = 0;
        for (c = 0; c < a.length; c++) {
            var g = a[c];
            g.copy(e, f), f += g.length
        }
        return e
    }, d.compare = function (a, b) {
        Q(d.isBuffer(a) && d.isBuffer(b), "Arguments must be Buffers");
        for (var c = a.length, e = b.length, f = 0, g = Math.min(c, e); g > f && a[f] === b[f]; f++);
        return f !== g && (c = a[f], e = b[f]), e > c ? -1 : c > e ? 1 : 0
    }, d.prototype.write = function (a, b, c, d) {
        if (isFinite(b))isFinite(c) || (d = c, c = void 0); else {
            var k = d;
            d = b, b = c, c = k
        }
        b = Number(b) || 0;
        var l = this.length - b;
        c ? (c = Number(c), c > l && (c = l)) : c = l, d = String(d || "utf8").toLowerCase();
        var m;
        switch (d) {
            case"hex":
                m = e(this, a, b, c);
                break;
            case"utf8":
            case"utf-8":
                m = f(this, a, b, c);
                break;
            case"ascii":
                m = g(this, a, b, c);
                break;
            case"binary":
                m = h(this, a, b, c);
                break;
            case"base64":
                m = i(this, a, b, c);
                break;
            case"ucs2":
            case"ucs-2":
            case"utf16le":
            case"utf-16le":
                m = j(this, a, b, c);
                break;
            default:
                throw new Error("Unknown encoding")
        }
        return m
    }, d.prototype.toString = function (a, b, c) {
        var d = this;
        if (a = String(a || "utf8").toLowerCase(), b = Number(b) || 0, c = void 0 === c ? d.length : Number(c), c === b)return"";
        var e;
        switch (a) {
            case"hex":
                e = o(d, b, c);
                break;
            case"utf8":
            case"utf-8":
                e = l(d, b, c);
                break;
            case"ascii":
                e = m(d, b, c);
                break;
            case"binary":
                e = n(d, b, c);
                break;
            case"base64":
                e = k(d, b, c);
                break;
            case"ucs2":
            case"ucs-2":
            case"utf16le":
            case"utf-16le":
                e = p(d, b, c);
                break;
            default:
                throw new Error("Unknown encoding")
        }
        return e
    }, d.prototype.toJSON = function () {
        return{type:"Buffer", data:Array.prototype.slice.call(this._arr || this, 0)}
    }, d.prototype.equals = function (a) {
        return Q(d.isBuffer(a), "Argument must be a Buffer"), 0 === d.compare(this, a)
    }, d.prototype.compare = function (a) {
        return Q(d.isBuffer(a), "Argument must be a Buffer"), d.compare(this, a)
    }, d.prototype.copy = function (a, b, c, d) {
        var e = this;
        if (c || (c = 0), d || 0 === d || (d = this.length), b || (b = 0), d !== c && 0 !== a.length && 0 !== e.length) {
            Q(d >= c, "sourceEnd < sourceStart"), Q(b >= 0 && b < a.length, "targetStart out of bounds"), Q(c >= 0 && c < e.length, "sourceStart out of bounds"), Q(d >= 0 && d <= e.length, "sourceEnd out of bounds"), d > this.length && (d = this.length), a.length - b < d - c && (d = a.length - b + c);
            var f = d - c;
            if (100 > f || !T)for (var g = 0; f > g; g++)a[g + b] = this[g + c]; else a._set(this.subarray(c, c + f), b)
        }
    }, d.prototype.slice = function (a, b) {
        var c = this.length;
        if (a = ~~a, b = void 0 === b ? c : ~~b, 0 > a ? (a += c, 0 > a && (a = 0)) : a > c && (a = c), 0 > b ? (b += c, 0 > b && (b = 0)) : b > c && (b = c), a > b && (b = a), T)return d._augment(this.subarray(a, b));
        for (var e = b - a, f = new d(e, void 0, !0), g = 0; e > g; g++)f[g] = this[g + a];
        return f
    }, d.prototype.get = function (a) {
        return console.log(".get() is deprecated. Access using array indexes instead."), this.readUInt8(a)
    }, d.prototype.set = function (a, b) {
        return console.log(".set() is deprecated. Access using array indexes instead."), this.writeUInt8(a, b)
    }, d.prototype.readUInt8 = function (a, b) {
        return b || (Q(void 0 !== a && null !== a, "missing offset"), Q(a < this.length, "Trying to read beyond buffer length")), a >= this.length ? void 0 : this[a]
    }, d.prototype.readUInt16LE = function (a, b) {
        return q(this, a, !0, b)
    }, d.prototype.readUInt16BE = function (a, b) {
        return q(this, a, !1, b)
    }, d.prototype.readUInt32LE = function (a, b) {
        return r(this, a, !0, b)
    }, d.prototype.readUInt32BE = function (a, b) {
        return r(this, a, !1, b)
    }, d.prototype.readInt8 = function (a, b) {
        if (b || (Q(void 0 !== a && null !== a, "missing offset"), Q(a < this.length, "Trying to read beyond buffer length")), !(a >= this.length)) {
            var c = 128 & this[a];
            return c ? -1 * (255 - this[a] + 1) : this[a]
        }
    }, d.prototype.readInt16LE = function (a, b) {
        return s(this, a, !0, b)
    }, d.prototype.readInt16BE = function (a, b) {
        return s(this, a, !1, b)
    }, d.prototype.readInt32LE = function (a, b) {
        return t(this, a, !0, b)
    }, d.prototype.readInt32BE = function (a, b) {
        return t(this, a, !1, b)
    }, d.prototype.readFloatLE = function (a, b) {
        return u(this, a, !0, b)
    }, d.prototype.readFloatBE = function (a, b) {
        return u(this, a, !1, b)
    }, d.prototype.readDoubleLE = function (a, b) {
        return v(this, a, !0, b)
    }, d.prototype.readDoubleBE = function (a, b) {
        return v(this, a, !1, b)
    }, d.prototype.writeUInt8 = function (a, b, c) {
        return c || (Q(void 0 !== a && null !== a, "missing value"), Q(void 0 !== b && null !== b, "missing offset"), Q(b < this.length, "trying to write beyond buffer length"), N(a, 255)), b >= this.length ? void 0 : (this[b] = a, b + 1)
    }, d.prototype.writeUInt16LE = function (a, b, c) {
        return w(this, a, b, !0, c)
    }, d.prototype.writeUInt16BE = function (a, b, c) {
        return w(this, a, b, !1, c)
    }, d.prototype.writeUInt32LE = function (a, b, c) {
        return x(this, a, b, !0, c)
    }, d.prototype.writeUInt32BE = function (a, b, c) {
        return x(this, a, b, !1, c)
    }, d.prototype.writeInt8 = function (a, b, c) {
        return c || (Q(void 0 !== a && null !== a, "missing value"), Q(void 0 !== b && null !== b, "missing offset"), Q(b < this.length, "Trying to write beyond buffer length"), O(a, 127, -128)), b >= this.length ? void 0 : (a >= 0 ? this.writeUInt8(a, b, c) : this.writeUInt8(255 + a + 1, b, c), b + 1)
    }, d.prototype.writeInt16LE = function (a, b, c) {
        return y(this, a, b, !0, c)
    }, d.prototype.writeInt16BE = function (a, b, c) {
        return y(this, a, b, !1, c)
    }, d.prototype.writeInt32LE = function (a, b, c) {
        return z(this, a, b, !0, c)
    }, d.prototype.writeInt32BE = function (a, b, c) {
        return z(this, a, b, !1, c)
    }, d.prototype.writeFloatLE = function (a, b, c) {
        return A(this, a, b, !0, c)
    }, d.prototype.writeFloatBE = function (a, b, c) {
        return A(this, a, b, !1, c)
    }, d.prototype.writeDoubleLE = function (a, b, c) {
        return B(this, a, b, !0, c)
    }, d.prototype.writeDoubleBE = function (a, b, c) {
        return B(this, a, b, !1, c)
    }, d.prototype.fill = function (a, b, c) {
        if (a || (a = 0), b || (b = 0), c || (c = this.length), Q(c >= b, "end < start"), c !== b && 0 !== this.length) {
            Q(b >= 0 && b < this.length, "start out of bounds"), Q(c >= 0 && c <= this.length, "end out of bounds");
            var d;
            if ("number" == typeof a)for (d = b; c > d; d++)this[d] = a; else {
                var e = H(a.toString()), f = e.length;
                for (d = b; c > d; d++)this[d] = e[d % f]
            }
            return this
        }
    }, d.prototype.inspect = function () {
        for (var a = [], b = this.length, d = 0; b > d; d++)if (a[d] = G(this[d]), d === c.INSPECT_MAX_BYTES) {
            a[d + 1] = "...";
            break
        }
        return"<Buffer " + a.join(" ") + ">"
    }, d.prototype.toArrayBuffer = function () {
        if ("undefined" != typeof Uint8Array) {
            if (T)return new d(this).buffer;
            for (var a = new Uint8Array(this.length), b = 0, c = a.length; c > b; b += 1)a[b] = this[b];
            return a.buffer
        }
        throw new Error("Buffer.toArrayBuffer not supported in this browser")
    };
    var U = d.prototype;
    d._augment = function (a) {
        return a._isBuffer = !0, a._get = a.get, a._set = a.set, a.get = U.get, a.set = U.set, a.write = U.write, a.toString = U.toString, a.toLocaleString = U.toString, a.toJSON = U.toJSON, a.equals = U.equals, a.compare = U.compare, a.copy = U.copy, a.slice = U.slice, a.readUInt8 = U.readUInt8, a.readUInt16LE = U.readUInt16LE, a.readUInt16BE = U.readUInt16BE, a.readUInt32LE = U.readUInt32LE, a.readUInt32BE = U.readUInt32BE, a.readInt8 = U.readInt8, a.readInt16LE = U.readInt16LE, a.readInt16BE = U.readInt16BE, a.readInt32LE = U.readInt32LE, a.readInt32BE = U.readInt32BE, a.readFloatLE = U.readFloatLE, a.readFloatBE = U.readFloatBE, a.readDoubleLE = U.readDoubleLE, a.readDoubleBE = U.readDoubleBE, a.writeUInt8 = U.writeUInt8, a.writeUInt16LE = U.writeUInt16LE, a.writeUInt16BE = U.writeUInt16BE, a.writeUInt32LE = U.writeUInt32LE, a.writeUInt32BE = U.writeUInt32BE, a.writeInt8 = U.writeInt8, a.writeInt16LE = U.writeInt16LE, a.writeInt16BE = U.writeInt16BE, a.writeInt32LE = U.writeInt32LE, a.writeInt32BE = U.writeInt32BE, a.writeFloatLE = U.writeFloatLE, a.writeFloatBE = U.writeFloatBE, a.writeDoubleLE = U.writeDoubleLE, a.writeDoubleBE = U.writeDoubleBE, a.fill = U.fill, a.inspect = U.inspect, a.toArrayBuffer = U.toArrayBuffer, a
    };
    var V = /[^+\/0-9A-z]/g
}, {"base64-js":22, ieee754:23}], 22:[function (a, b, c) {
    var d = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/";
    !function (a) {
        "use strict";
        function b(a) {
            var b = a.charCodeAt(0);
            return b === g ? 62 : b === h ? 63 : i > b ? -1 : i + 10 > b ? b - i + 26 + 26 : k + 26 > b ? b - k : j + 26 > b ? b - j + 26 : void 0
        }

        function c(a) {
            function c(a) {
                j[l++] = a
            }

            var d, e, g, h, i, j;
            if (a.length % 4 > 0)throw new Error("Invalid string. Length must be a multiple of 4");
            var k = a.length;
            i = "=" === a.charAt(k - 2) ? 2 : "=" === a.charAt(k - 1) ? 1 : 0, j = new f(3 * a.length / 4 - i), g = i > 0 ? a.length - 4 : a.length;
            var l = 0;
            for (d = 0, e = 0; g > d; d += 4, e += 3)h = b(a.charAt(d)) << 18 | b(a.charAt(d + 1)) << 12 | b(a.charAt(d + 2)) << 6 | b(a.charAt(d + 3)), c((16711680 & h) >> 16), c((65280 & h) >> 8), c(255 & h);
            return 2 === i ? (h = b(a.charAt(d)) << 2 | b(a.charAt(d + 1)) >> 4, c(255 & h)) : 1 === i && (h = b(a.charAt(d)) << 10 | b(a.charAt(d + 1)) << 4 | b(a.charAt(d + 2)) >> 2, c(h >> 8 & 255), c(255 & h)), j
        }

        function e(a) {
            function b(a) {
                return d.charAt(a)
            }

            function c(a) {
                return b(a >> 18 & 63) + b(a >> 12 & 63) + b(a >> 6 & 63) + b(63 & a)
            }

            var e, f, g, h = a.length % 3, i = "";
            for (e = 0, g = a.length - h; g > e; e += 3)f = (a[e] << 16) + (a[e + 1] << 8) + a[e + 2], i += c(f);
            switch (h) {
                case 1:
                    f = a[a.length - 1], i += b(f >> 2), i += b(f << 4 & 63), i += "==";
                    break;
                case 2:
                    f = (a[a.length - 2] << 8) + a[a.length - 1], i += b(f >> 10), i += b(f >> 4 & 63), i += b(f << 2 & 63), i += "="
            }
            return i
        }

        var f = "undefined" != typeof Uint8Array ? Uint8Array : Array, g = "+".charCodeAt(0), h = "/".charCodeAt(0), i = "0".charCodeAt(0), j = "a".charCodeAt(0), k = "A".charCodeAt(0);
        a.toByteArray = c, a.fromByteArray = e
    }("undefined" == typeof c ? this.base64js = {} : c)
}, {}], 23:[function (a, b, c) {
    c.read = function (a, b, c, d, e) {
        var f, g, h = 8 * e - d - 1, i = (1 << h) - 1, j = i >> 1, k = -7, l = c ? e - 1 : 0, m = c ? -1 : 1, n = a[b + l];
        for (l += m, f = n & (1 << -k) - 1, n >>= -k, k += h; k > 0; f = 256 * f + a[b + l], l += m, k -= 8);
        for (g = f & (1 << -k) - 1, f >>= -k, k += d; k > 0; g = 256 * g + a[b + l], l += m, k -= 8);
        if (0 === f)f = 1 - j; else {
            if (f === i)return g ? 0 / 0 : 1 / 0 * (n ? -1 : 1);
            g += Math.pow(2, d), f -= j
        }
        return(n ? -1 : 1) * g * Math.pow(2, f - d)
    }, c.write = function (a, b, c, d, e, f) {
        var g, h, i, j = 8 * f - e - 1, k = (1 << j) - 1, l = k >> 1, m = 23 === e ? Math.pow(2, -24) - Math.pow(2, -77) : 0, n = d ? 0 : f - 1, o = d ? 1 : -1, p = 0 > b || 0 === b && 0 > 1 / b ? 1 : 0;
        for (b = Math.abs(b), isNaN(b) || 1 / 0 === b ? (h = isNaN(b) ? 1 : 0, g = k) : (g = Math.floor(Math.log(b) / Math.LN2), b * (i = Math.pow(2, -g)) < 1 && (g--, i *= 2), b += g + l >= 1 ? m / i : m * Math.pow(2, 1 - l), b * i >= 2 && (g++, i /= 2), g + l >= k ? (h = 0, g = k) : g + l >= 1 ? (h = (b * i - 1) * Math.pow(2, e), g += l) : (h = b * Math.pow(2, l - 1) * Math.pow(2, e), g = 0)); e >= 8; a[c + n] = 255 & h, n += o, h /= 256, e -= 8);
        for (g = g << e | h, j += e; j > 0; a[c + n] = 255 & g, n += o, g /= 256, j -= 8);
        a[c + n - o] |= 128 * p
    }
}, {}], 24:[function (a, b) {
    function c() {
        this._events = this._events || {}, this._maxListeners = this._maxListeners || void 0
    }

    function d(a) {
        return"function" == typeof a
    }

    function e(a) {
        return"number" == typeof a
    }

    function f(a) {
        return"object" == typeof a && null !== a
    }

    function g(a) {
        return void 0 === a
    }

    b.exports = c, c.EventEmitter = c, c.prototype._events = void 0, c.prototype._maxListeners = void 0, c.defaultMaxListeners = 10, c.prototype.setMaxListeners = function (a) {
        if (!e(a) || 0 > a || isNaN(a))throw TypeError("n must be a positive number");
        return this._maxListeners = a, this
    }, c.prototype.emit = function (a) {
        var b, c, e, h, i, j;
        if (this._events || (this._events = {}), "error" === a && (!this._events.error || f(this._events.error) && !this._events.error.length))throw b = arguments[1], b instanceof Error ? b : TypeError('Uncaught, unspecified "error" event.');
        if (c = this._events[a], g(c))return!1;
        if (d(c))switch (arguments.length) {
            case 1:
                c.call(this);
                break;
            case 2:
                c.call(this, arguments[1]);
                break;
            case 3:
                c.call(this, arguments[1], arguments[2]);
                break;
            default:
                for (e = arguments.length, h = new Array(e - 1), i = 1; e > i; i++)h[i - 1] = arguments[i];
                c.apply(this, h)
        } else if (f(c)) {
            for (e = arguments.length, h = new Array(e - 1), i = 1; e > i; i++)h[i - 1] = arguments[i];
            for (j = c.slice(), e = j.length, i = 0; e > i; i++)j[i].apply(this, h)
        }
        return!0
    }, c.prototype.addListener = function (a, b) {
        var e;
        if (!d(b))throw TypeError("listener must be a function");
        if (this._events || (this._events = {}), this._events.newListener && this.emit("newListener", a, d(b.listener) ? b.listener : b), this._events[a] ? f(this._events[a]) ? this._events[a].push(b) : this._events[a] = [this._events[a], b] : this._events[a] = b, f(this._events[a]) && !this._events[a].warned) {
            var e;
            e = g(this._maxListeners) ? c.defaultMaxListeners : this._maxListeners, e && e > 0 && this._events[a].length > e && (this._events[a].warned = !0, console.error("(node) warning: possible EventEmitter memory leak detected. %d listeners added. Use emitter.setMaxListeners() to increase limit.", this._events[a].length), "function" == typeof console.trace && console.trace())
        }
        return this
    }, c.prototype.on = c.prototype.addListener, c.prototype.once = function (a, b) {
        function c() {
            this.removeListener(a, c), e || (e = !0, b.apply(this, arguments))
        }

        if (!d(b))throw TypeError("listener must be a function");
        var e = !1;
        return c.listener = b, this.on(a, c), this
    }, c.prototype.removeListener = function (a, b) {
        var c, e, g, h;
        if (!d(b))throw TypeError("listener must be a function");
        if (!this._events || !this._events[a])return this;
        if (c = this._events[a], g = c.length, e = -1, c === b || d(c.listener) && c.listener === b)delete this._events[a], this._events.removeListener && this.emit("removeListener", a, b); else if (f(c)) {
            for (h = g; h-- > 0;)if (c[h] === b || c[h].listener && c[h].listener === b) {
                e = h;
                break
            }
            if (0 > e)return this;
            1 === c.length ? (c.length = 0, delete this._events[a]) : c.splice(e, 1), this._events.removeListener && this.emit("removeListener", a, b)
        }
        return this
    }, c.prototype.removeAllListeners = function (a) {
        var b, c;
        if (!this._events)return this;
        if (!this._events.removeListener)return 0 === arguments.length ? this._events = {} : this._events[a] && delete this._events[a], this;
        if (0 === arguments.length) {
            for (b in this._events)"removeListener" !== b && this.removeAllListeners(b);
            return this.removeAllListeners("removeListener"), this._events = {}, this
        }
        if (c = this._events[a], d(c))this.removeListener(a, c); else for (; c.length;)this.removeListener(a, c[c.length - 1]);
        return delete this._events[a], this
    }, c.prototype.listeners = function (a) {
        var b;
        return b = this._events && this._events[a] ? d(this._events[a]) ? [this._events[a]] : this._events[a].slice() : []
    }, c.listenerCount = function (a, b) {
        var c;
        return c = a._events && a._events[b] ? d(a._events[b]) ? 1 : a._events[b].length : 0
    }
}, {}], 25:[function (a, b) {
    b.exports = "function" == typeof Object.create ? function (a, b) {
        a.super_ = b, a.prototype = Object.create(b.prototype, {constructor:{value:a, enumerable:!1, writable:!0, configurable:!0}})
    } : function (a, b) {
        a.super_ = b;
        var c = function () {
        };
        c.prototype = b.prototype, a.prototype = new c, a.prototype.constructor = a
    }
}, {}], 26:[function (a, b) {
    function c() {
    }

    var d = b.exports = {};
    d.nextTick = function () {
        var a = "undefined" != typeof window && window.setImmediate, b = "undefined" != typeof window && window.postMessage && window.addEventListener;
        if (a)return function (a) {
            return window.setImmediate(a)
        };
        if (b) {
            var c = [];
            return window.addEventListener("message", function (a) {
                var b = a.source;
                if ((b === window || null === b) && "process-tick" === a.data && (a.stopPropagation(), c.length > 0)) {
                    var d = c.shift();
                    d()
                }
            }, !0), function (a) {
                c.push(a), window.postMessage("process-tick", "*")
            }
        }
        return function (a) {
            setTimeout(a, 0)
        }
    }(), d.title = "browser", d.browser = !0, d.env = {}, d.argv = [], d.on = c, d.addListener = c, d.once = c, d.off = c, d.removeListener = c, d.removeAllListeners = c, d.emit = c, d.binding = function () {
        throw new Error("process.binding is not supported")
    }, d.cwd = function () {
        return"/"
    }, d.chdir = function () {
        throw new Error("process.chdir is not supported")
    }
}, {}], 27:[function (a, b) {
    b.exports = function (a) {
        return a && "object" == typeof a && "function" == typeof a.copy && "function" == typeof a.fill && "function" == typeof a.readUInt8
    }
}, {}], 28:[function (a, b, c) {
    (function (b, d) {
        function e(a, b) {
            var d = {seen:[], stylize:g};
            return arguments.length >= 3 && (d.depth = arguments[2]), arguments.length >= 4 && (d.colors = arguments[3]), p(b) ? d.showHidden = b : b && c._extend(d, b), v(d.showHidden) && (d.showHidden = !1), v(d.depth) && (d.depth = 2), v(d.colors) && (d.colors = !1), v(d.customInspect) && (d.customInspect = !0), d.colors && (d.stylize = f), i(d, a, d.depth)
        }

        function f(a, b) {
            var c = e.styles[b];
            return c ? "[" + e.colors[c][0] + "m" + a + "[" + e.colors[c][1] + "m" : a
        }

        function g(a) {
            return a
        }

        function h(a) {
            var b = {};
            return a.forEach(function (a) {
                b[a] = !0
            }), b
        }

        function i(a, b, d) {
            if (a.customInspect && b && A(b.inspect) && b.inspect !== c.inspect && (!b.constructor || b.constructor.prototype !== b)) {
                var e = b.inspect(d, a);
                return t(e) || (e = i(a, e, d)), e
            }
            var f = j(a, b);
            if (f)return f;
            var g = Object.keys(b), p = h(g);
            if (a.showHidden && (g = Object.getOwnPropertyNames(b)), z(b) && (g.indexOf("message") >= 0 || g.indexOf("description") >= 0))return k(b);
            if (0 === g.length) {
                if (A(b)) {
                    var q = b.name ? ": " + b.name : "";
                    return a.stylize("[Function" + q + "]", "special")
                }
                if (w(b))return a.stylize(RegExp.prototype.toString.call(b), "regexp");
                if (y(b))return a.stylize(Date.prototype.toString.call(b), "date");
                if (z(b))return k(b)
            }
            var r = "", s = !1, u = ["{", "}"];
            if (o(b) && (s = !0, u = ["[", "]"]), A(b)) {
                var v = b.name ? ": " + b.name : "";
                r = " [Function" + v + "]"
            }
            if (w(b) && (r = " " + RegExp.prototype.toString.call(b)), y(b) && (r = " " + Date.prototype.toUTCString.call(b)), z(b) && (r = " " + k(b)), 0 === g.length && (!s || 0 == b.length))return u[0] + r + u[1];
            if (0 > d)return w(b) ? a.stylize(RegExp.prototype.toString.call(b), "regexp") : a.stylize("[Object]", "special");
            a.seen.push(b);
            var x;
            return x = s ? l(a, b, d, p, g) : g.map(function (c) {
                return m(a, b, d, p, c, s)
            }), a.seen.pop(), n(x, r, u)
        }

        function j(a, b) {
            if (v(b))return a.stylize("undefined", "undefined");
            if (t(b)) {
                var c = "'" + JSON.stringify(b).replace(/^"|"$/g, "").replace(/'/g, "\\'").replace(/\\"/g, '"') + "'";
                return a.stylize(c, "string")
            }
            return s(b) ? a.stylize("" + b, "number") : p(b) ? a.stylize("" + b, "boolean") : q(b) ? a.stylize("null", "null") : void 0
        }

        function k(a) {
            return"[" + Error.prototype.toString.call(a) + "]"
        }

        function l(a, b, c, d, e) {
            for (var f = [], g = 0, h = b.length; h > g; ++g)f.push(F(b, String(g)) ? m(a, b, c, d, String(g), !0) : "");
            return e.forEach(function (e) {
                e.match(/^\d+$/) || f.push(m(a, b, c, d, e, !0))
            }), f
        }

        function m(a, b, c, d, e, f) {
            var g, h, j;
            if (j = Object.getOwnPropertyDescriptor(b, e) || {value:b[e]}, j.get ? h = j.set ? a.stylize("[Getter/Setter]", "special") : a.stylize("[Getter]", "special") : j.set && (h = a.stylize("[Setter]", "special")), F(d, e) || (g = "[" + e + "]"), h || (a.seen.indexOf(j.value) < 0 ? (h = q(c) ? i(a, j.value, null) : i(a, j.value, c - 1), h.indexOf("\n") > -1 && (h = f ? h.split("\n").map(function (a) {
                return"  " + a
            }).join("\n").substr(2) : "\n" + h.split("\n").map(function (a) {
                return"   " + a
            }).join("\n"))) : h = a.stylize("[Circular]", "special")), v(g)) {
                if (f && e.match(/^\d+$/))return h;
                g = JSON.stringify("" + e), g.match(/^"([a-zA-Z_][a-zA-Z_0-9]*)"$/) ? (g = g.substr(1, g.length - 2), g = a.stylize(g, "name")) : (g = g.replace(/'/g, "\\'").replace(/\\"/g, '"').replace(/(^"|"$)/g, "'"), g = a.stylize(g, "string"))
            }
            return g + ": " + h
        }

        function n(a, b, c) {
            var d = 0, e = a.reduce(function (a, b) {
                return d++, b.indexOf("\n") >= 0 && d++, a + b.replace(/\u001b\[\d\d?m/g, "").length + 1
            }, 0);
            return e > 60 ? c[0] + ("" === b ? "" : b + "\n ") + " " + a.join(",\n  ") + " " + c[1] : c[0] + b + " " + a.join(", ") + " " + c[1]
        }

        function o(a) {
            return Array.isArray(a)
        }

        function p(a) {
            return"boolean" == typeof a
        }

        function q(a) {
            return null === a
        }

        function r(a) {
            return null == a
        }

        function s(a) {
            return"number" == typeof a
        }

        function t(a) {
            return"string" == typeof a
        }

        function u(a) {
            return"symbol" == typeof a
        }

        function v(a) {
            return void 0 === a
        }

        function w(a) {
            return x(a) && "[object RegExp]" === C(a)
        }

        function x(a) {
            return"object" == typeof a && null !== a
        }

        function y(a) {
            return x(a) && "[object Date]" === C(a)
        }

        function z(a) {
            return x(a) && ("[object Error]" === C(a) || a instanceof Error)
        }

        function A(a) {
            return"function" == typeof a
        }

        function B(a) {
            return null === a || "boolean" == typeof a || "number" == typeof a || "string" == typeof a || "symbol" == typeof a || "undefined" == typeof a
        }

        function C(a) {
            return Object.prototype.toString.call(a)
        }

        function D(a) {
            return 10 > a ? "0" + a.toString(10) : a.toString(10)
        }

        function E() {
            var a = new Date, b = [D(a.getHours()), D(a.getMinutes()), D(a.getSeconds())].join(":");
            return[a.getDate(), J[a.getMonth()], b].join(" ")
        }

        function F(a, b) {
            return Object.prototype.hasOwnProperty.call(a, b)
        }

        var G = /%[sdj%]/g;
        c.format = function (a) {
            if (!t(a)) {
                for (var b = [], c = 0; c < arguments.length; c++)b.push(e(arguments[c]));
                return b.join(" ")
            }
            for (var c = 1, d = arguments, f = d.length, g = String(a).replace(G, function (a) {
                if ("%%" === a)return"%";
                if (c >= f)return a;
                switch (a) {
                    case"%s":
                        return String(d[c++]);
                    case"%d":
                        return Number(d[c++]);
                    case"%j":
                        try {
                            return JSON.stringify(d[c++])
                        } catch (b) {
                            return"[Circular]"
                        }
                    default:
                        return a
                }
            }), h = d[c]; f > c; h = d[++c])g += q(h) || !x(h) ? " " + h : " " + e(h);
            return g
        }, c.deprecate = function (a, e) {
            function f() {
                if (!g) {
                    if (b.throwDeprecation)throw new Error(e);
                    b.traceDeprecation ? console.trace(e) : console.error(e), g = !0
                }
                return a.apply(this, arguments)
            }

            if (v(d.process))return function () {
                return c.deprecate(a, e).apply(this, arguments)
            };
            if (b.noDeprecation === !0)return a;
            var g = !1;
            return f
        };
        var H, I = {};
        c.debuglog = function (a) {
            if (v(H) && (H = b.env.NODE_DEBUG || ""), a = a.toUpperCase(), !I[a])if (new RegExp("\\b" + a + "\\b", "i").test(H)) {
                var d = b.pid;
                I[a] = function () {
                    var b = c.format.apply(c, arguments);
                    console.error("%s %d: %s", a, d, b)
                }
            } else I[a] = function () {
            };
            return I[a]
        }, c.inspect = e, e.colors = {bold:[1, 22], italic:[3, 23], underline:[4, 24], inverse:[7, 27], white:[37, 39], grey:[90, 39], black:[30, 39], blue:[34, 39], cyan:[36, 39], green:[32, 39], magenta:[35, 39], red:[31, 39], yellow:[33, 39]}, e.styles = {special:"cyan", number:"yellow", "boolean":"yellow", undefined:"grey", "null":"bold", string:"green", date:"magenta", regexp:"red"}, c.isArray = o, c.isBoolean = p, c.isNull = q, c.isNullOrUndefined = r, c.isNumber = s, c.isString = t, c.isSymbol = u, c.isUndefined = v, c.isRegExp = w, c.isObject = x, c.isDate = y, c.isError = z, c.isFunction = A, c.isPrimitive = B, c.isBuffer = a("./support/isBuffer");
        var J = ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];
        c.log = function () {
            console.log("%s - %s", E(), c.format.apply(c, arguments))
        }, c.inherits = a("inherits"), c._extend = function (a, b) {
            if (!b || !x(b))return a;
            for (var c = Object.keys(b), d = c.length; d--;)a[c[d]] = b[c[d]];
            return a
        }
    }).call(this, a("JkpR2F"), "undefined" != typeof self ? self : "undefined" != typeof window ? window : {})
}, {"./support/isBuffer":27, JkpR2F:26, inherits:25}], 29:[function (a, b) {
    var c = a("util"), d = a("events"), e = a("engine.io-client"), f = b.exports = function (a) {
        this.old = {}, this.cache = [], this.uri = a, this.status = "closed", this.times = 0, this._connect()
    };
    c.inherits(f, d.EventEmitter), f.prototype.subscribe = function (a) {
        this._send({cmd:"subscribe", topic:a, options:{qos:0}})
    }, f.prototype.unsubscribe = function (a) {
        this._send({cmd:"unsubscribe", topic:a})
    }, f.prototype.publish = function (a, b) {
        this._send({cmd:"publish", topic:a, message:b, options:{qos:0}})
    }, f.prototype._connect = function () {
        this.old = e(this.uri), this.old.on("open", this._open.bind(this)), this.old.on("message", this._message.bind(this)), this.old.on("close", this._close.bind(this))
    }, f.prototype._reconnect = function () {
        if ("daed" != this.status) {
            if (this.times >= 10)return this.status = "dead", void this.emit("dead");
            var a = [100, 1e3, 2e3, 5e3, 7e3, 1e4, 15e3, 3e4, 4e4, 6e4][this.times];
            this.times++;
            var b = this;
            setTimeout(function () {
                b._connect()
            }, a)
        }
    }, f.prototype._open = function () {
        this.status = "connected", this.emit("connected");
        for (var a = 0; a < this.cache.length; a++)this._send(this.cache[a]);
        this.cache = [], this.times = 0
    }, f.prototype._close = function () {
        "connected" == this.status && this.emit("closed"), this.status = "closed", this._reconnect()
    }, f.prototype._message = function (a) {
        this.times = 0;
        try {
            if (a = JSON.parse(a), "object" != typeof a)throw new Error;
            a.message = JSON.parse(a.message)
        } catch (b) {
            throw new Error("Cann't parse message.")
        }
        this.emit("message", a.topic, a.message)
    }, f.prototype._send = function (a) {
        "dead" != this.status && "object" == typeof a && ("connected" == this.status ? this.old.send(JSON.stringify(a)) : this.cache.push(a))
    }
}, {"engine.io-client":30, events:24, util:28}], 30:[function (a, b) {
    b.exports = a("./lib/")
}, {"./lib/":31}], 31:[function (a, b) {
    b.exports = a("./socket"), b.exports.parser = a("engine.io-parser")
}, {"./socket":32, "engine.io-parser":43}], 32:[function (a, b) {
    (function (c) {
        function d(a, b) {
            if (!(this instanceof d))return new d(a, b);
            if (b = b || {}, a && "object" == typeof a && (b = a, a = null), a && (a = k(a), b.host = a.host, b.secure = "https" == a.protocol || "wss" == a.protocol, b.port = a.port, a.query && (b.query = a.query)), this.secure = null != b.secure ? b.secure : c.location && "https:" == location.protocol, b.host) {
                var e = b.host.split(":");
                b.hostname = e.shift(), e.length && (b.port = e.pop())
            }
            this.agent = b.agent || !1, this.hostname = b.hostname || (c.location ? location.hostname : "localhost"), this.port = b.port || (c.location && location.port ? location.port : this.secure ? 443 : 80), this.query = b.query || {}, "string" == typeof this.query && (this.query = m.decode(this.query)), this.upgrade = !1 !== b.upgrade, this.path = (b.path || "/engine.io").replace(/\/$/, "") + "/", this.forceJSONP = !!b.forceJSONP, this.forceBase64 = !!b.forceBase64, this.timestampParam = b.timestampParam || "t", this.timestampRequests = b.timestampRequests, this.transports = b.transports || ["polling", "websocket"], this.readyState = "", this.writeBuffer = [], this.callbackBuffer = [], this.policyPort = b.policyPort || 843, this.rememberUpgrade = b.rememberUpgrade || !1, this.open(), this.binaryType = null, this.onlyBinaryUpgrades = b.onlyBinaryUpgrades
        }

        function e(a) {
            var b = {};
            for (var c in a)a.hasOwnProperty(c) && (b[c] = a[c]);
            return b
        }

        var f = a("./transports"), g = a("component-emitter"), h = a("debug")("engine.io-client:socket"), i = a("indexof"), j = a("engine.io-parser"), k = a("parseuri"), l = a("parsejson"), m = a("parseqs");
        b.exports = d, d.priorWebsocketSuccess = !1, g(d.prototype), d.protocol = j.protocol, d.Socket = d, d.Transport = a("./transport"), d.transports = a("./transports"), d.parser = a("engine.io-parser"), d.prototype.createTransport = function (a) {
            h('creating transport "%s"', a);
            var b = e(this.query);
            b.EIO = j.protocol, b.transport = a, this.id && (b.sid = this.id);
            var c = new f[a]({agent:this.agent, hostname:this.hostname, port:this.port, secure:this.secure, path:this.path, query:b, forceJSONP:this.forceJSONP, forceBase64:this.forceBase64, timestampRequests:this.timestampRequests, timestampParam:this.timestampParam, policyPort:this.policyPort, socket:this});
            return c
        }, d.prototype.open = function () {
            var a;
            a = this.rememberUpgrade && d.priorWebsocketSuccess && -1 != this.transports.indexOf("websocket") ? "websocket" : this.transports[0], this.readyState = "opening";
            var a = this.createTransport(a);
            a.open(), this.setTransport(a)
        }, d.prototype.setTransport = function (a) {
            h("setting transport %s", a.name);
            var b = this;
            this.transport && (h("clearing existing transport %s", this.transport.name), this.transport.removeAllListeners()), this.transport = a, a.on("drain",function () {
                b.onDrain()
            }).on("packet",function (a) {
                b.onPacket(a)
            }).on("error",function (a) {
                b.onError(a)
            }).on("close", function () {
                b.onClose("transport close")
            })
        }, d.prototype.probe = function (a) {
            function b() {
                if (m.onlyBinaryUpgrades) {
                    var b = !this.supportsBinary && m.transport.supportsBinary;
                    l = l || b
                }
                l || (h('probe transport "%s" opened', a), k.send([
                    {type:"ping", data:"probe"}
                ]), k.once("packet", function (b) {
                    if (!l)if ("pong" == b.type && "probe" == b.data)h('probe transport "%s" pong', a), m.upgrading = !0, m.emit("upgrading", k), d.priorWebsocketSuccess = "websocket" == k.name, h('pausing current transport "%s"', m.transport.name), m.transport.pause(function () {
                        l || "closed" != m.readyState && "closing" != m.readyState && (h("changing transport and sending upgrade packet"), j(), m.setTransport(k), k.send([
                            {type:"upgrade"}
                        ]), m.emit("upgrade", k), k = null, m.upgrading = !1, m.flush())
                    }); else {
                        h('probe transport "%s" failed', a);
                        var c = new Error("probe error");
                        c.transport = k.name, m.emit("upgradeError", c)
                    }
                }))
            }

            function c() {
                l || (l = !0, j(), k.close(), k = null)
            }

            function e(b) {
                var d = new Error("probe error: " + b);
                d.transport = k.name, c(), h('probe transport "%s" failed because of error: %s', a, b), m.emit("upgradeError", d)
            }

            function f() {
                e("transport closed")
            }

            function g() {
                e("socket closed")
            }

            function i(a) {
                k && a.name != k.name && (h('"%s" works - aborting "%s"', a.name, k.name), c())
            }

            function j() {
                k.removeListener("open", b), k.removeListener("error", e), k.removeListener("close", f), m.removeListener("close", g), m.removeListener("upgrading", i)
            }

            h('probing transport "%s"', a);
            var k = this.createTransport(a, {probe:1}), l = !1, m = this;
            d.priorWebsocketSuccess = !1, k.once("open", b), k.once("error", e), k.once("close", f), this.once("close", g), this.once("upgrading", i), k.open()
        }, d.prototype.onOpen = function () {
            if (h("socket open"), this.readyState = "open", d.priorWebsocketSuccess = "websocket" == this.transport.name, this.emit("open"), this.flush(), "open" == this.readyState && this.upgrade && this.transport.pause) {
                h("starting upgrade probes");
                for (var a = 0, b = this.upgrades.length; b > a; a++)this.probe(this.upgrades[a])
            }
        }, d.prototype.onPacket = function (a) {
            if ("opening" == this.readyState || "open" == this.readyState)switch (h('socket receive: type "%s", data "%s"', a.type, a.data), this.emit("packet", a), this.emit("heartbeat"), a.type) {
                case"open":
                    this.onHandshake(l(a.data));
                    break;
                case"pong":
                    this.setPing();
                    break;
                case"error":
                    var b = new Error("server error");
                    b.code = a.data, this.emit("error", b);
                    break;
                case"message":
                    this.emit("data", a.data), this.emit("message", a.data)
            } else h('packet received with socket readyState "%s"', this.readyState)
        }, d.prototype.onHandshake = function (a) {
            this.emit("handshake", a), this.id = a.sid, this.transport.query.sid = a.sid, this.upgrades = this.filterUpgrades(a.upgrades), this.pingInterval = a.pingInterval, this.pingTimeout = a.pingTimeout, this.onOpen(), "closed" != this.readyState && (this.setPing(), this.removeListener("heartbeat", this.onHeartbeat), this.on("heartbeat", this.onHeartbeat))
        }, d.prototype.onHeartbeat = function (a) {
            clearTimeout(this.pingTimeoutTimer);
            var b = this;
            b.pingTimeoutTimer = setTimeout(function () {
                "closed" != b.readyState && b.onClose("ping timeout")
            }, a || b.pingInterval + b.pingTimeout)
        }, d.prototype.setPing = function () {
            var a = this;
            clearTimeout(a.pingIntervalTimer), a.pingIntervalTimer = setTimeout(function () {
                h("writing ping packet - expecting pong within %sms", a.pingTimeout), a.ping(), a.onHeartbeat(a.pingTimeout)
            }, a.pingInterval)
        }, d.prototype.ping = function () {
            this.sendPacket("ping")
        }, d.prototype.onDrain = function () {
            for (var a = 0; a < this.prevBufferLen; a++)this.callbackBuffer[a] && this.callbackBuffer[a]();
            this.writeBuffer.splice(0, this.prevBufferLen), this.callbackBuffer.splice(0, this.prevBufferLen), this.prevBufferLen = 0, 0 == this.writeBuffer.length ? this.emit("drain") : this.flush()
        }, d.prototype.flush = function () {
            "closed" != this.readyState && this.transport.writable && !this.upgrading && this.writeBuffer.length && (h("flushing %d packets in socket", this.writeBuffer.length), this.transport.send(this.writeBuffer), this.prevBufferLen = this.writeBuffer.length, this.emit("flush"))
        }, d.prototype.write = d.prototype.send = function (a, b) {
            return this.sendPacket("message", a, b), this
        }, d.prototype.sendPacket = function (a, b, c) {
            var d = {type:a, data:b};
            this.emit("packetCreate", d), this.writeBuffer.push(d), this.callbackBuffer.push(c), this.flush()
        }, d.prototype.close = function () {
            return("opening" == this.readyState || "open" == this.readyState) && (this.onClose("forced close"), h("socket closing - telling transport to close"), this.transport.close()), this
        }, d.prototype.onError = function (a) {
            h("socket error %j", a), d.priorWebsocketSuccess = !1, this.emit("error", a), this.onClose("transport error", a)
        }, d.prototype.onClose = function (a, b) {
            if ("opening" == this.readyState || "open" == this.readyState) {
                h('socket close with reason: "%s"', a);
                var c = this;
                clearTimeout(this.pingIntervalTimer), clearTimeout(this.pingTimeoutTimer), setTimeout(function () {
                    c.writeBuffer = [], c.callbackBuffer = [], c.prevBufferLen = 0
                }, 0), this.transport.removeAllListeners("close"), this.transport.close(), this.transport.removeAllListeners(), this.readyState = "closed", this.id = null, this.emit("close", a, b)
            }
        }, d.prototype.filterUpgrades = function (a) {
            for (var b = [], c = 0, d = a.length; d > c; c++)~i(this.transports, a[c]) && b.push(a[c]);
            return b
        }
    }).call(this, "undefined" != typeof self ? self : "undefined" != typeof window ? window : {})
}, {"./transport":33, "./transports":34, "component-emitter":40, debug:42, "engine.io-parser":43, indexof:52, parsejson:53, parseqs:54, parseuri:55}], 33:[function (a, b) {
    function c(a) {
        this.path = a.path, this.hostname = a.hostname, this.port = a.port, this.secure = a.secure, this.query = a.query, this.timestampParam = a.timestampParam, this.timestampRequests = a.timestampRequests, this.readyState = "", this.agent = a.agent || !1, this.socket = a.socket
    }

    var d = a("engine.io-parser"), e = a("component-emitter");
    b.exports = c, e(c.prototype), c.timestamps = 0, c.prototype.onError = function (a, b) {
        var c = new Error(a);
        return c.type = "TransportError", c.description = b, this.emit("error", c), this
    }, c.prototype.open = function () {
        return("closed" == this.readyState || "" == this.readyState) && (this.readyState = "opening", this.doOpen()), this
    }, c.prototype.close = function () {
        return("opening" == this.readyState || "open" == this.readyState) && (this.doClose(), this.onClose()), this
    }, c.prototype.send = function (a) {
        if ("open" != this.readyState)throw new Error("Transport not open");
        this.write(a)
    }, c.prototype.onOpen = function () {
        this.readyState = "open", this.writable = !0, this.emit("open")
    }, c.prototype.onData = function (a) {
        try {
            var b = d.decodePacket(a, this.socket.binaryType);
            this.onPacket(b)
        } catch (c) {
            c.data = a, this.onError("parser decode error", c)
        }
    }, c.prototype.onPacket = function (a) {
        this.emit("packet", a)
    }, c.prototype.onClose = function () {
        this.readyState = "closed", this.emit("close")
    }
}, {"component-emitter":40, "engine.io-parser":43}], 34:[function (a, b, c) {
    (function (b) {
        function d(a) {
            var c, d = !1;
            if (b.location) {
                var h = "https:" == location.protocol, i = location.port;
                i || (i = h ? 443 : 80), d = a.hostname != location.hostname || i != a.port
            }
            return a.xdomain = d, c = new e(a), "open"in c && !a.forceJSONP ? new f(a) : new g(a)
        }

        var e = a("xmlhttprequest"), f = a("./polling-xhr"), g = a("./polling-jsonp"), h = a("./websocket");
        c.polling = d, c.websocket = h
    }).call(this, "undefined" != typeof self ? self : "undefined" != typeof window ? window : {})
}, {"./polling-jsonp":35, "./polling-xhr":36, "./websocket":38, xmlhttprequest:39}], 35:[function (a, b) {
    (function (c) {
        function d() {
        }

        function e(a) {
            f.call(this, a), this.query = this.query || {}, h || (c.___eio || (c.___eio = []), h = c.___eio), this.index = h.length;
            var b = this;
            h.push(function (a) {
                b.onData(a)
            }), this.query.j = this.index, c.document && c.addEventListener && c.addEventListener("beforeunload", function () {
                b.script && (b.script.onerror = d)
            })
        }

        var f = a("./polling"), g = a("component-inherit");
        b.exports = e;
        var h, i = /\n/g, j = /\\n/g;
        g(e, f), e.prototype.supportsBinary = !1, e.prototype.doClose = function () {
            this.script && (this.script.parentNode.removeChild(this.script), this.script = null), this.form && (this.form.parentNode.removeChild(this.form), this.form = null), f.prototype.doClose.call(this)
        }, e.prototype.doPoll = function () {
            var a = this, b = document.createElement("script");
            this.script && (this.script.parentNode.removeChild(this.script), this.script = null), b.async = !0, b.src = this.uri(), b.onerror = function (b) {
                a.onError("jsonp poll error", b)
            };
            var c = document.getElementsByTagName("script")[0];
            c.parentNode.insertBefore(b, c), this.script = b;
            var d = "undefined" != typeof navigator && /gecko/i.test(navigator.userAgent);
            d && setTimeout(function () {
                var a = document.createElement("iframe");
                document.body.appendChild(a), document.body.removeChild(a)
            }, 100)
        }, e.prototype.doWrite = function (a, b) {
            function c() {
                d(), b()
            }

            function d() {
                if (e.iframe)try {
                    e.form.removeChild(e.iframe)
                } catch (a) {
                    e.onError("jsonp polling iframe removal error", a)
                }
                try {
                    var b = '<iframe src="javascript:0" name="' + e.iframeId + '">';
                    f = document.createElement(b)
                } catch (a) {
                    f = document.createElement("iframe"), f.name = e.iframeId, f.src = "javascript:0"
                }
                f.id = e.iframeId, e.form.appendChild(f), e.iframe = f
            }

            var e = this;
            if (!this.form) {
                var f, g = document.createElement("form"), h = document.createElement("textarea"), k = this.iframeId = "eio_iframe_" + this.index;
                g.className = "socketio", g.style.position = "absolute", g.style.top = "-1000px", g.style.left = "-1000px", g.target = k, g.method = "POST", g.setAttribute("accept-charset", "utf-8"), h.name = "d", g.appendChild(h), document.body.appendChild(g), this.form = g, this.area = h
            }
            this.form.action = this.uri(), d(), a = a.replace(j, "\\\n"), this.area.value = a.replace(i, "\\n");
            try {
                this.form.submit()
            } catch (l) {
            }
            this.iframe.attachEvent ? this.iframe.onreadystatechange = function () {
                "complete" == e.iframe.readyState && c()
            } : this.iframe.onload = c
        }
    }).call(this, "undefined" != typeof self ? self : "undefined" != typeof window ? window : {})
}, {"./polling":37, "component-inherit":41}], 36:[function (a, b) {
    (function (c) {
        function d() {
        }

        function e(a) {
            if (i.call(this, a), c.location) {
                var b = "https:" == location.protocol, d = location.port;
                d || (d = b ? 443 : 80), this.xd = a.hostname != c.location.hostname || d != a.port
            }
        }

        function f(a) {
            this.method = a.method || "GET", this.uri = a.uri, this.xd = !!a.xd, this.async = !1 !== a.async, this.data = void 0 != a.data ? a.data : null, this.agent = a.agent, this.create(a.isBinary, a.supportsBinary)
        }

        function g() {
            for (var a in f.requests)f.requests.hasOwnProperty(a) && f.requests[a].abort()
        }

        var h = a("xmlhttprequest"), i = a("./polling"), j = a("component-emitter"), k = a("component-inherit"), l = a("debug")("engine.io-client:polling-xhr");
        b.exports = e, b.exports.Request = f, k(e, i), e.prototype.supportsBinary = !0, e.prototype.request = function (a) {
            return a = a || {}, a.uri = this.uri(), a.xd = this.xd, a.agent = this.agent || !1, a.supportsBinary = this.supportsBinary, new f(a)
        }, e.prototype.doWrite = function (a, b) {
            var c = "string" != typeof a && void 0 !== a, d = this.request({method:"POST", data:a, isBinary:c}), e = this;
            d.on("success", b), d.on("error", function (a) {
                e.onError("xhr post error", a)
            }), this.sendXhr = d
        }, e.prototype.doPoll = function () {
            l("xhr poll");
            var a = this.request(), b = this;
            a.on("data", function (a) {
                b.onData(a)
            }), a.on("error", function (a) {
                b.onError("xhr poll error", a)
            }), this.pollXhr = a
        }, j(f.prototype), f.prototype.create = function (a, b) {
            var d = this.xhr = new h({agent:this.agent, xdomain:this.xd}), e = this;
            try {
                if (l("xhr open %s: %s", this.method, this.uri), d.open(this.method, this.uri, this.async), b && (d.responseType = "arraybuffer"), "POST" == this.method)try {
                    a ? d.setRequestHeader("Content-type", "application/octet-stream") : d.setRequestHeader("Content-type", "text/plain;charset=UTF-8")
                } catch (g) {
                }
                "withCredentials"in d && (d.withCredentials = !0), d.onreadystatechange = function () {
                    var a;
                    try {
                        if (4 != d.readyState)return;
                        if (200 == d.status || 1223 == d.status) {
                            var c = d.getResponseHeader("Content-Type");
                            a = "application/octet-stream" === c ? d.response : b ? "ok" : d.responseText
                        } else setTimeout(function () {
                            e.onError(d.status)
                        }, 0)
                    } catch (f) {
                        e.onError(f)
                    }
                    null != a && e.onData(a)
                }, l("xhr data %s", this.data), d.send(this.data)
            } catch (g) {
                return void setTimeout(function () {
                    e.onError(g)
                }, 0)
            }
            c.document && (this.index = f.requestsCount++, f.requests[this.index] = this)
        }, f.prototype.onSuccess = function () {
            this.emit("success"), this.cleanup()
        }, f.prototype.onData = function (a) {
            this.emit("data", a), this.onSuccess()
        }, f.prototype.onError = function (a) {
            this.emit("error", a), this.cleanup()
        }, f.prototype.cleanup = function () {
            if ("undefined" != typeof this.xhr && null !== this.xhr) {
                this.xhr.onreadystatechange = d;
                try {
                    this.xhr.abort()
                } catch (a) {
                }
                c.document && delete f.requests[this.index], this.xhr = null
            }
        }, f.prototype.abort = function () {
            this.cleanup()
        }, c.document && (f.requestsCount = 0, f.requests = {}, c.attachEvent ? c.attachEvent("onunload", g) : c.addEventListener && c.addEventListener("beforeunload", g))
    }).call(this, "undefined" != typeof self ? self : "undefined" != typeof window ? window : {})
}, {"./polling":37, "component-emitter":40, "component-inherit":41, debug:42, xmlhttprequest:39}], 37:[function (a, b) {
    function c(a) {
        var b = a && a.forceBase64;
        (!i || b) && (this.supportsBinary = !1), d.call(this, a)
    }

    var d = a("../transport"), e = a("parseqs"), f = a("engine.io-parser"), g = a("component-inherit"), h = a("debug")("engine.io-client:polling");
    b.exports = c;
    var i = function () {
        var b = a("xmlhttprequest"), c = new b({agent:this.agent, xdomain:!1});
        return null != c.responseType
    }();
    g(c, d), c.prototype.name = "polling", c.prototype.doOpen = function () {
        this.poll()
    }, c.prototype.pause = function (a) {
        function b() {
            h("paused"), c.readyState = "paused", a()
        }

        var c = this;
        if (this.readyState = "pausing", this.polling || !this.writable) {
            var d = 0;
            this.polling && (h("we are currently polling - waiting to pause"), d++, this.once("pollComplete", function () {
                h("pre-pause polling complete"), --d || b()
            })), this.writable || (h("we are currently writing - waiting to pause"), d++, this.once("drain", function () {
                h("pre-pause writing complete"), --d || b()
            }))
        } else b()
    }, c.prototype.poll = function () {
        h("polling"), this.polling = !0, this.doPoll(), this.emit("poll")
    }, c.prototype.onData = function (a) {
        var b = this;
        h("polling got data %s", a);
        var c = function (a) {
            return"opening" == b.readyState && b.onOpen(), "close" == a.type ? (b.onClose(), !1) : void b.onPacket(a)
        };
        f.decodePayload(a, this.socket.binaryType, c), "closed" != this.readyState && (this.polling = !1, this.emit("pollComplete"), "open" == this.readyState ? this.poll() : h('ignoring poll - transport state "%s"', this.readyState))
    }, c.prototype.doClose = function () {
        function a() {
            h("writing close packet"), b.write([
                {type:"close"}
            ])
        }

        var b = this;
        "open" == this.readyState ? (h("transport open - closing"), a()) : (h("transport not open - deferring close"), this.once("open", a))
    }, c.prototype.write = function (a) {
        var b = this;
        this.writable = !1;
        var c = function () {
            b.writable = !0, b.emit("drain")
        }, b = this;
        f.encodePayload(a, this.supportsBinary, function (a) {
            b.doWrite(a, c)
        })
    }, c.prototype.uri = function () {
        var a = this.query || {}, b = this.secure ? "https" : "http", c = "";
        return!1 !== this.timestampRequests && (a[this.timestampParam] = +new Date + "-" + d.timestamps++), this.supportsBinary || a.sid || (a.b64 = 1), a = e.encode(a), this.port && ("https" == b && 443 != this.port || "http" == b && 80 != this.port) && (c = ":" + this.port), a.length && (a = "?" + a), b + "://" + this.hostname + c + this.path + a
    }
}, {"../transport":33, "component-inherit":41, debug:42, "engine.io-parser":43, parseqs:54, xmlhttprequest:39}], 38:[function (a, b) {
    function c(a) {
        var b = a && a.forceBase64;
        b && (this.supportsBinary = !1), d.call(this, a)
    }

    var d = a("../transport"), e = a("engine.io-parser"), f = a("parseqs"), g = a("component-inherit"), h = a("debug")("engine.io-client:websocket"), i = a("ws");
    b.exports = c, g(c, d), c.prototype.name = "websocket", c.prototype.supportsBinary = !0, c.prototype.doOpen = function () {
        if (this.check()) {
            var a = this.uri(), b = void 0, c = {agent:this.agent};
            this.ws = new i(a, b, c), void 0 === this.ws.binaryType && (this.supportsBinary = !1), this.ws.binaryType = "arraybuffer", this.addEventListeners()
        }
    }, c.prototype.addEventListeners = function () {
        var a = this;
        this.ws.onopen = function () {
            a.onOpen()
        }, this.ws.onclose = function () {
            a.onClose()
        }, this.ws.onmessage = function (b) {
            a.onData(b.data)
        }, this.ws.onerror = function (b) {
            a.onError("websocket error", b)
        }
    }, "undefined" != typeof navigator && /iPad|iPhone|iPod/i.test(navigator.userAgent) && (c.prototype.onData = function (a) {
        var b = this;
        setTimeout(function () {
            d.prototype.onData.call(b, a)
        }, 0)
    }), c.prototype.write = function (a) {
        function b() {
            c.writable = !0, c.emit("drain")
        }

        var c = this;
        this.writable = !1;
        for (var d = 0, f = a.length; f > d; d++)e.encodePacket(a[d], this.supportsBinary, function (a) {
            try {
                c.ws.send(a)
            } catch (b) {
                h("websocket closed before onclose event")
            }
        });
        setTimeout(b, 0)
    }, c.prototype.onClose = function () {
        d.prototype.onClose.call(this)
    }, c.prototype.doClose = function () {
        "undefined" != typeof this.ws && this.ws.close()
    }, c.prototype.uri = function () {
        var a = this.query || {}, b = this.secure ? "wss" : "ws", c = "";
        return this.port && ("wss" == b && 443 != this.port || "ws" == b && 80 != this.port) && (c = ":" + this.port), this.timestampRequests && (a[this.timestampParam] = +new Date), this.supportsBinary || (a.b64 = 1), a = f.encode(a), a.length && (a = "?" + a), b + "://" + this.hostname + c + this.path + a
    }, c.prototype.check = function () {
        return!(!i || "__initialize"in i && this.name === c.prototype.name)
    }
}, {"../transport":33, "component-inherit":41, debug:42, "engine.io-parser":43, parseqs:54, ws:56}], 39:[function (a, b) {
    var c = a("has-cors");
    b.exports = function (a) {
        var b = a.xdomain;
        try {
            if ("undefined" != typeof XMLHttpRequest && (!b || c))return new XMLHttpRequest
        } catch (d) {
        }
        if (!b)try {
            return new ActiveXObject("Microsoft.XMLHTTP")
        } catch (d) {
        }
    }
}, {"has-cors":50}], 40:[function (a, b) {
    function c(a) {
        return a ? d(a) : void 0
    }

    function d(a) {
        for (var b in c.prototype)a[b] = c.prototype[b];
        return a
    }

    b.exports = c, c.prototype.on = c.prototype.addEventListener = function (a, b) {
        return this._callbacks = this._callbacks || {}, (this._callbacks[a] = this._callbacks[a] || []).push(b), this
    }, c.prototype.once = function (a, b) {
        function c() {
            d.off(a, c), b.apply(this, arguments)
        }

        var d = this;
        return this._callbacks = this._callbacks || {}, c.fn = b, this.on(a, c), this
    }, c.prototype.off = c.prototype.removeListener = c.prototype.removeAllListeners = c.prototype.removeEventListener = function (a, b) {
        if (this._callbacks = this._callbacks || {}, 0 == arguments.length)return this._callbacks = {}, this;
        var c = this._callbacks[a];
        if (!c)return this;
        if (1 == arguments.length)return delete this._callbacks[a], this;
        for (var d, e = 0; e < c.length; e++)if (d = c[e], d === b || d.fn === b) {
            c.splice(e, 1);
            break
        }
        return this
    }, c.prototype.emit = function (a) {
        this._callbacks = this._callbacks || {};
        var b = [].slice.call(arguments, 1), c = this._callbacks[a];
        if (c) {
            c = c.slice(0);
            for (var d = 0, e = c.length; e > d; ++d)c[d].apply(this, b)
        }
        return this
    }, c.prototype.listeners = function (a) {
        return this._callbacks = this._callbacks || {}, this._callbacks[a] || []
    }, c.prototype.hasListeners = function (a) {
        return!!this.listeners(a).length
    }
}, {}], 41:[function (a, b) {
    b.exports = function (a, b) {
        var c = function () {
        };
        c.prototype = b.prototype, a.prototype = new c, a.prototype.constructor = a
    }
}, {}], 42:[function (a, b) {
    function c(a) {
        return c.enabled(a) ? function (b) {
            b = d(b);
            var e = new Date, f = e - (c[a] || e);
            c[a] = e, b = a + " " + b + " +" + c.humanize(f), window.console && console.log && Function.prototype.apply.call(console.log, console, arguments)
        } : function () {
        }
    }

    function d(a) {
        return a instanceof Error ? a.stack || a.message : a
    }

    b.exports = c, c.names = [], c.skips = [], c.enable = function (a) {
        try {
            localStorage.debug = a
        } catch (b) {
        }
        for (var d = (a || "").split(/[\s,]+/), e = d.length, f = 0; e > f; f++)a = d[f].replace("*", ".*?"), "-" === a[0] ? c.skips.push(new RegExp("^" + a.substr(1) + "$")) : c.names.push(new RegExp("^" + a + "$"))
    }, c.disable = function () {
        c.enable("")
    }, c.humanize = function (a) {
        var b = 1e3, c = 6e4, d = 60 * c;
        return a >= d ? (a / d).toFixed(1) + "h" : a >= c ? (a / c).toFixed(1) + "m" : a >= b ? (a / b | 0) + "s" : a + "ms"
    }, c.enabled = function (a) {
        for (var b = 0, d = c.skips.length; d > b; b++)if (c.skips[b].test(a))return!1;
        for (var b = 0, d = c.names.length; d > b; b++)if (c.names[b].test(a))return!0;
        return!1
    };
    try {
        window.localStorage && c.enable(localStorage.debug)
    } catch (e) {
    }
}, {}], 43:[function (a, b, c) {
    (function (b) {
        function d(a, b, d) {
            if (!b)return c.encodeBase64Packet(a, d);
            var e = a.data, f = new Uint8Array(e), g = new Uint8Array(1 + e.byteLength);
            g[0] = n[a.type];
            for (var h = 0; h < f.length; h++)g[h + 1] = f[h];
            return d(g.buffer)
        }

        function e(a, b, d) {
            if (!b)return c.encodeBase64Packet(a, d);
            var e = new FileReader;
            return e.onload = function () {
                a.data = e.result, c.encodePacket(a, b, d)
            }, e.readAsArrayBuffer(a.data)
        }

        function f(a, b, d) {
            if (!b)return c.encodeBase64Packet(a, d);
            if (m)return e(a, b, d);
            var f = new Uint8Array(1);
            f[0] = n[a.type];
            var g = new q([f.buffer, a.data]);
            return d(g)
        }

        function g(a, b, c) {
            for (var d = new Array(a.length), e = k(a.length, c), f = function (a, c, e) {
                b(c, function (b, c) {
                    d[a] = c, e(b, d)
                })
            }, g = 0; g < a.length; g++)f(g, a[g], e)
        }

        var h = a("./keys"), i = a("arraybuffer.slice"), j = a("base64-arraybuffer"), k = a("after"), l = a("utf8"), m = navigator.userAgent.match(/Android/i);
        c.protocol = 2;
        var n = c.packets = {open:0, close:1, ping:2, pong:3, message:4, upgrade:5, noop:6}, o = h(n), p = {type:"error", data:"parser error"}, q = a("blob");
        c.encodePacket = function (a, c, e) {
            "function" == typeof c && (e = c, c = !1);
            var g = void 0 === a.data ? void 0 : a.data.buffer || a.data;
            if (b.ArrayBuffer && g instanceof ArrayBuffer)return d(a, c, e);
            if (q && g instanceof b.Blob)return f(a, c, e);
            var h = n[a.type];
            return void 0 !== a.data && (h += l.encode(String(a.data))), e("" + h)
        }, c.encodeBase64Packet = function (a, d) {
            var e = "b" + c.packets[a.type];
            if (q && a.data instanceof q) {
                var f = new FileReader;
                return f.onload = function () {
                    var a = f.result.split(",")[1];
                    d(e + a)
                }, f.readAsDataURL(a.data)
            }
            var g;
            try {
                g = String.fromCharCode.apply(null, new Uint8Array(a.data))
            } catch (h) {
                for (var i = new Uint8Array(a.data), j = new Array(i.length), k = 0; k < i.length; k++)j[k] = i[k];
                g = String.fromCharCode.apply(null, j)
            }
            return e += b.btoa(g), d(e)
        }, c.decodePacket = function (a, b) {
            if ("string" == typeof a || void 0 === a) {
                if ("b" == a.charAt(0))return c.decodeBase64Packet(a.substr(1), b);
                a = l.decode(a);
                var d = a.charAt(0);
                return Number(d) == d && o[d] ? a.length > 1 ? {type:o[d], data:a.substring(1)} : {type:o[d]} : p
            }
            var e = new Uint8Array(a), d = e[0], f = i(a, 1);
            return q && "blob" === b && (f = new q([f])), {type:o[d], data:f}
        }, c.decodeBase64Packet = function (a, c) {
            var d = o[a.charAt(0)];
            if (!b.ArrayBuffer)return{type:d, data:{base64:!0, data:a.substr(1)}};
            var e = j.decode(a.substr(1));
            return"blob" === c && q && (e = new q([e])), {type:d, data:e}
        }, c.encodePayload = function (a, b, d) {
            function e(a) {
                return a.length + ":" + a
            }

            function f(a, d) {
                c.encodePacket(a, b, function (a) {
                    d(null, e(a))
                })
            }

            return"function" == typeof b && (d = b, b = null), b ? q && !m ? c.encodePayloadAsBlob(a, d) : c.encodePayloadAsArrayBuffer(a, d) : a.length ? void g(a, f, function (a, b) {
                return d(b.join(""))
            }) : d("0:")
        }, c.decodePayload = function (a, b, d) {
            if ("string" != typeof a)return c.decodePayloadAsBinary(a, b, d);
            "function" == typeof b && (d = b, b = null);
            var e;
            if ("" == a)return d(p, 0, 1);
            for (var f, g, h = "", i = 0, j = a.length; j > i; i++) {
                var k = a.charAt(i);
                if (":" != k)h += k; else {
                    if ("" == h || h != (f = Number(h)))return d(p, 0, 1);
                    if (g = a.substr(i + 1, f), h != g.length)return d(p, 0, 1);
                    if (g.length) {
                        if (e = c.decodePacket(g, b), p.type == e.type && p.data == e.data)return d(p, 0, 1);
                        var l = d(e, i + f, j);
                        if (!1 === l)return
                    }
                    i += f, h = ""
                }
            }
            return"" != h ? d(p, 0, 1) : void 0
        }, c.encodePayloadAsArrayBuffer = function (a, b) {
            function d(a, b) {
                c.encodePacket(a, !0, function (a) {
                    return b(null, a)
                })
            }

            return a.length ? void g(a, d, function (a, c) {
                var d = c.reduce(function (a, b) {
                    var c;
                    return c = "string" == typeof b ? b.length : b.byteLength, a + c.toString().length + c + 2
                }, 0), e = new Uint8Array(d), f = 0;
                return c.forEach(function (a) {
                    var b = "string" == typeof a, c = a;
                    if (b) {
                        for (var d = new Uint8Array(a.length), g = 0; g < a.length; g++)d[g] = a.charCodeAt(g);
                        c = d.buffer
                    }
                    e[f++] = b ? 0 : 1;
                    for (var h = c.byteLength.toString(), g = 0; g < h.length; g++)e[f++] = parseInt(h[g]);
                    e[f++] = 255;
                    for (var d = new Uint8Array(c), g = 0; g < d.length; g++)e[f++] = d[g]
                }), b(e.buffer)
            }) : b(new ArrayBuffer(0))
        }, c.encodePayloadAsBlob = function (a, b) {
            function d(a, b) {
                c.encodePacket(a, !0, function (a) {
                    var c = new Uint8Array(1);
                    if (c[0] = 1, "string" == typeof a) {
                        for (var d = new Uint8Array(a.length), e = 0; e < a.length; e++)d[e] = a.charCodeAt(e);
                        a = d.buffer, c[0] = 0
                    }
                    for (var f = a instanceof ArrayBuffer ? a.byteLength : a.size, g = f.toString(), h = new Uint8Array(g.length + 1), e = 0; e < g.length; e++)h[e] = parseInt(g[e]);
                    if (h[g.length] = 255, q) {
                        var i = new q([c.buffer, h.buffer, a]);
                        b(null, i)
                    }
                })
            }

            g(a, d, function (a, c) {
                return b(new q(c))
            })
        }, c.decodePayloadAsBinary = function (a, b, d) {
            "function" == typeof b && (d = b, b = null);
            for (var e = a, f = []; e.byteLength > 0;) {
                for (var g = new Uint8Array(e), h = 0 === g[0], j = "", k = 1; 255 != g[k]; k++)j += g[k];
                e = i(e, 2 + j.length), j = parseInt(j);
                var l = i(e, 0, j);
                if (h)try {
                    l = String.fromCharCode.apply(null, new Uint8Array(l))
                } catch (m) {
                    var n = new Uint8Array(l);
                    l = "";
                    for (var k = 0; k < n.length; k++)l += String.fromCharCode(n[k])
                }
                f.push(l), e = i(e, j)
            }
            var o = f.length;
            f.forEach(function (a, e) {
                d(c.decodePacket(a, b), e, o)
            })
        }
    }).call(this, "undefined" != typeof self ? self : "undefined" != typeof window ? window : {})
}, {"./keys":44, after:45, "arraybuffer.slice":46, "base64-arraybuffer":47, blob:48, utf8:49}], 44:[function (a, b) {
    b.exports = Object.keys || function (a) {
        var b = [], c = Object.prototype.hasOwnProperty;
        for (var d in a)c.call(a, d) && b.push(d);
        return b
    }
}, {}], 45:[function (a, b) {
    function c(a, b, c) {
        function e(a, d) {
            if (e.count <= 0)throw new Error("after called too many times");
            --e.count, a ? (f = !0, b(a), b = c) : 0 !== e.count || f || b(null, d)
        }

        var f = !1;
        return c = c || d, e.count = a, 0 === a ? b() : e
    }

    function d() {
    }

    b.exports = c
}, {}], 46:[function (a, b) {
    b.exports = function (a, b, c) {
        var d = a.byteLength;
        if (b = b || 0, c = c || d, a.slice)return a.slice(b, c);
        if (0 > b && (b += d), 0 > c && (c += d), c > d && (c = d), b >= d || b >= c || 0 === d)return new ArrayBuffer(0);
        for (var e = new Uint8Array(a), f = new Uint8Array(c - b), g = b, h = 0; c > g; g++, h++)f[h] = e[g];
        return f.buffer
    }
}, {}], 47:[function (a, b, c) {
    !function (a) {
        "use strict";
        c.encode = function (b) {
            var c, d = new Uint8Array(b), e = d.length, f = "";
            for (c = 0; e > c; c += 3)f += a[d[c] >> 2], f += a[(3 & d[c]) << 4 | d[c + 1] >> 4], f += a[(15 & d[c + 1]) << 2 | d[c + 2] >> 6], f += a[63 & d[c + 2]];
            return e % 3 === 2 ? f = f.substring(0, f.length - 1) + "=" : e % 3 === 1 && (f = f.substring(0, f.length - 2) + "=="), f
        }, c.decode = function (b) {
            var c, d, e, f, g, h = .75 * b.length, i = b.length, j = 0;
            "=" === b[b.length - 1] && (h--, "=" === b[b.length - 2] && h--);
            var k = new ArrayBuffer(h), l = new Uint8Array(k);
            for (c = 0; i > c; c += 4)d = a.indexOf(b[c]), e = a.indexOf(b[c + 1]), f = a.indexOf(b[c + 2]), g = a.indexOf(b[c + 3]), l[j++] = d << 2 | e >> 4, l[j++] = (15 & e) << 4 | f >> 2, l[j++] = (3 & f) << 6 | 63 & g;
            return k
        }
    }("ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/")
}, {}], 48:[function (a, b) {
    (function (a) {
        function c(a, b) {
            b = b || {};
            for (var c = new d, e = 0; e < a.length; e++)c.append(a[e]);
            return b.type ? c.getBlob(b.type) : c.getBlob()
        }

        var d = a.BlobBuilder || a.WebKitBlobBuilder || a.MSBlobBuilder || a.MozBlobBuilder, e = function () {
            try {
                var a = new Blob(["hi"]);
                return 2 == a.size
            } catch (b) {
                return!1
            }
        }(), f = d && d.prototype.append && d.prototype.getBlob;
        b.exports = function () {
            return e ? a.Blob : f ? c : void 0
        }()
    }).call(this, "undefined" != typeof self ? self : "undefined" != typeof window ? window : {})
}, {}], 49:[function (a, b, c) {
    (function (a) {
        !function (d) {
            function e(a) {
                for (var b, c, d = [], e = 0, f = a.length; f > e;)b = a.charCodeAt(e++), b >= 55296 && 56319 >= b && f > e ? (c = a.charCodeAt(e++), 56320 == (64512 & c) ? d.push(((1023 & b) << 10) + (1023 & c) + 65536) : (d.push(b), e--)) : d.push(b);
                return d
            }

            function f(a) {
                for (var b, c = a.length, d = -1, e = ""; ++d < c;)b = a[d], b > 65535 && (b -= 65536, e += s(b >>> 10 & 1023 | 55296), b = 56320 | 1023 & b), e += s(b);
                return e
            }

            function g(a, b) {
                return s(a >> b & 63 | 128)
            }

            function h(a) {
                if (0 == (4294967168 & a))return s(a);
                var b = "";
                return 0 == (4294965248 & a) ? b = s(a >> 6 & 31 | 192) : 0 == (4294901760 & a) ? (b = s(a >> 12 & 15 | 224), b += g(a, 6)) : 0 == (4292870144 & a) && (b = s(a >> 18 & 7 | 240), b += g(a, 12), b += g(a, 6)), b += s(63 & a | 128)
            }

            function i(a) {
                for (var b, c = e(a), d = c.length, f = -1, g = ""; ++f < d;)b = c[f], g += h(b);
                return g
            }

            function j() {
                if (r >= q)throw Error("Invalid byte index");
                var a = 255 & p[r];
                if (r++, 128 == (192 & a))return 63 & a;
                throw Error("Invalid continuation byte")
            }

            function k() {
                var a, b, c, d, e;
                if (r > q)throw Error("Invalid byte index");
                if (r == q)return!1;
                if (a = 255 & p[r], r++, 0 == (128 & a))return a;
                if (192 == (224 & a)) {
                    var b = j();
                    if (e = (31 & a) << 6 | b, e >= 128)return e;
                    throw Error("Invalid continuation byte")
                }
                if (224 == (240 & a)) {
                    if (b = j(), c = j(), e = (15 & a) << 12 | b << 6 | c, e >= 2048)return e;
                    throw Error("Invalid continuation byte")
                }
                if (240 == (248 & a) && (b = j(), c = j(), d = j(), e = (15 & a) << 18 | b << 12 | c << 6 | d, e >= 65536 && 1114111 >= e))return e;
                throw Error("Invalid UTF-8 detected")
            }

            function l(a) {
                p = e(a), q = p.length, r = 0;
                for (var b, c = []; (b = k()) !== !1;)c.push(b);
                return f(c)
            }

            var m = "object" == typeof c && c, n = "object" == typeof b && b && b.exports == m && b, o = "object" == typeof a && a;
            (o.global === o || o.window === o) && (d = o);
            var p, q, r, s = String.fromCharCode, t = {version:"2.0.0", encode:i, decode:l};
            if ("function" == typeof define && "object" == typeof define.amd && define.amd)define(function () {
                return t
            }); else if (m && !m.nodeType)if (n)n.exports = t; else {
                var u = {}, v = u.hasOwnProperty;
                for (var w in t)v.call(t, w) && (m[w] = t[w])
            } else d.utf8 = t
        }(this)
    }).call(this, "undefined" != typeof self ? self : "undefined" != typeof window ? window : {})
}, {}], 50:[function (a, b) {
    var c = a("global");
    try {
        b.exports = "XMLHttpRequest"in c && "withCredentials"in new c.XMLHttpRequest
    } catch (d) {
        b.exports = !1
    }
}, {global:51}], 51:[function (a, b) {
    b.exports = function () {
        return this
    }()
}, {}], 52:[function (a, b) {
    var c = [].indexOf;
    b.exports = function (a, b) {
        if (c)return a.indexOf(b);
        for (var d = 0; d < a.length; ++d)if (a[d] === b)return d;
        return-1
    }
}, {}], 53:[function (a, b) {
    (function (a) {
        var c = /^[\],:{}\s]*$/, d = /\\(?:["\\\/bfnrt]|u[0-9a-fA-F]{4})/g, e = /"[^"\\\n\r]*"|true|false|null|-?\d+(?:\.\d*)?(?:[eE][+\-]?\d+)?/g, f = /(?:^|:|,)(?:\s*\[)+/g, g = /^\s+/, h = /\s+$/;
        b.exports = function (b) {
            return"string" == typeof b && b ? (b = b.replace(g, "").replace(h, ""), a.JSON && JSON.parse ? JSON.parse(b) : c.test(b.replace(d, "@").replace(e, "]").replace(f, "")) ? new Function("return " + b)() : void 0) : null
        }
    }).call(this, "undefined" != typeof self ? self : "undefined" != typeof window ? window : {})
}, {}], 54:[function (a, b, c) {
    c.encode = function (a) {
        var b = "";
        for (var c in a)a.hasOwnProperty(c) && (b.length && (b += "&"), b += encodeURIComponent(c) + "=" + encodeURIComponent(a[c]));
        return b
    }, c.decode = function (a) {
        for (var b = {}, c = a.split("&"), d = 0, e = c.length; e > d; d++) {
            var f = c[d].split("=");
            b[decodeURIComponent(f[0])] = decodeURIComponent(f[1])
        }
        return b
    }
}, {}], 55:[function (a, b) {
    var c = /^(?:(?![^:@]+:[^:@\/]*@)(http|https|ws|wss):\/\/)?((?:(([^:@]*)(?::([^:@]*))?)?@)?((?:[a-f0-9]{0,4}:){2,7}[a-f0-9]{0,4}|[^:\/?#]*)(?::(\d*))?)(((\/(?:[^?#](?![^?#\/]*\.[^?#\/.]+(?:[?#]|$)))*\/?)?([^?#\/]*))(?:\?([^#]*))?(?:#(.*))?)/, d = ["source", "protocol", "authority", "userInfo", "user", "password", "host", "port", "relative", "path", "directory", "file", "query", "anchor"];
    b.exports = function (a) {
        for (var b = c.exec(a || ""), e = {}, f = 14; f--;)e[d[f]] = b[f] || "";
        return e
    }
}, {}], 56:[function (a, b) {
    function c(a, b) {
        var c;
        return c = b ? new e(a, b) : new e(a)
    }

    var d = function () {
        return this
    }(), e = d.WebSocket || d.MozWebSocket;
    b.exports = e ? c : null, e && (c.prototype = e.prototype)
}, {}]}, {}, [10]);