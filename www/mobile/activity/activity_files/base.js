//Initialization function
var winH, winW, docH, headerH;
var dataStatus = 0; //ajax post number
$(function () {
    winH = $(window).height();
    winW = $(window).width();
    docH = $(document).height();
    headerH = $("headerH").height();
    sidebar();
    goTop();
    $("#go-back").bind("click", goBack);
    //$(document).on('touchstart',"#go-back",goBack);
    getSource();
});
//Get Browser Version
var browser = {
    versions: function () {
        var u = navigator.userAgent, app = navigator.appVersion;
        return {
            trident: u.indexOf('Trident') > -1, //IE内核
            presto: u.indexOf('Presto') > -1, //opera内核
            webKit: u.indexOf('AppleWebKit') > -1, //苹果、谷歌内核
            gecko: u.indexOf('Gecko') > -1 && u.indexOf('KHTML') == -1,//火狐内核
            mobile: !!u.match(/AppleWebKit.*Mobile.*/), //是否为移动终端
            ios: !!u.match(/\(i[^;]+;( U;)? CPU.+Mac OS X/), //ios终端
            android: u.indexOf('Android') > -1 || u.indexOf('Linux') > -1, //android终端或者uc浏览器
            iPhone: u.indexOf('iPhone') > -1, //是否为iPhone或者QQHD浏览器
            iPad: u.indexOf('iPad') > -1, //是否iPad
            webApp: u.indexOf('Safari') == -1, //是否web应该程序，没有头部与底部
            weixin: u.indexOf('MicroMessenger') > -1, //是否微信
            weibo: u.indexOf('weibo') > -1, //是否微博
            qq: u.match(/\sQQ/i) == " qq" //是否QQ
        };
    }(),
    language: (navigator.browserLanguage || navigator.language).toLowerCase()
}

// weixin share
function wxShare(url, fromPage, id, fn) {
    $.ajax({
        type: "POST",
        url: "/api/weixin.php?action=weixin&url=" + url + "&type=" + fromPage + "&temp=" + id,
        dataType: "json",
        success: function (res) {
            console.log(res);
            if (res.code == 1) {
                var data = res.data;
                fn && fn(data);
                wx.config({
                    debug: false,
                    appId: data.appid,
                    timestamp: data.timestamp,
                    nonceStr: data.noncestr,
                    signature: data.signature,
                    jsApiList: ['onMenuShareTimeline', 'onMenuShareAppMessage']
                });

                wx.ready(function () {
                    wx.onMenuShareAppMessage({
                        title: data.sharename, // 分享标题
                        desc: data.sharedescribe, // 分享描述
                        link: data.url, // 分享链接
                        imgUrl: data.share, // 分享图标
                        type: 'link', // 分享类型,music、video或link，不填默认为link
                        dataUrl: '', // 如果type是music或video，则要提供数据链接，默认为空
                        success: function () {
                            // alert('success');
                        }

                    });
                    wx.onMenuShareTimeline({
                        title: data.sharename, // 分享标题
                        link: data.url, // 分享链接
                        imgUrl: data.share, // 分享图标
                        success: function () {
                            // alert('success');
                        }

                    });
                });
            }
        }
    });
}

// Get Scrolled Top
function getScrollTop() {
    var scrollTop = 0;
    if (document.documentElement && document.documentElement.scrollTop) {
        scrollTop = document.documentElement.scrollTop;
    } else if (document.body) {
        scrollTop = document.body.scrollTop;
    }
    return scrollTop;
}
//Return to top of the page
//show or hide the collect case
function goTop() {
    var goTop = $('#goTop');
    var apply = $('.bottom-btn');
    goTop.hide();
    apply.hide();

    $(window).on('scroll', function () {
        var scroll_top = getScrollTop();
        if (scroll_top > 50) {
            apply.show();
        } else {
            apply.hide();
        }
        if (scroll_top >= winH * 2) {
            goTop.show();
        } else {
            goTop.hide();
        }
    });
    goTop.on('click', function () {
        document.body.scrollTop = 0;
    });
}
//Slide in right menu
function sidebar() {
    var sidebar = $('#sidebar'),
        menu = $('#menu'),
        bg = $('.sidebar-bg');

    menu.on('click', function (event) {
        $("#right-menu").addClass("slideIn");
        bg.show();
        bg.add(sidebar).on('touchmove', function (event) {
            event.preventDefault();
        })
    });

    bg.on('click', function () {
        $("#right-menu").removeClass("slideIn");
        $('body').css('overflow', '');
    });
}

//Get url Parameter
function getUrlParameter(name) {
    var match = RegExp('[?&]' + name + '=([^&]*)').exec(window.location.search);
    return match && decodeURIComponent(match[1].replace(/\+/g, ' '));
}
//solve Template
function solveTemplate(contentId, tplId, data) {
    var content = $(contentId),
        tpl = $(tplId).html(),
        render = _.template(tpl),
        html = render(data);

    content.html(html);
}
//Top tip bar
function showTip(str) {
    var tip_box = '<div id="errorCue"><span id="errorMsg"></span></div>';
    if ($('#errorCue')) {
        $('#errorCue').remove();
    }
    $(tip_box).appendTo("body");
    $('#errorMsg').html(str);
    setTimeout(function () {
        $('#errorCue').removeClass().addClass('show');
        setTimeout(function () {
            $('#errorCue').removeClass('show');
        }, 2000);
    }, 1);
}
//Alert Layer
function alertOpen(str) {
    var alert_tag = '<section id="alert-layer"><div id="layer-content"><p id="alert-con"></p><p class="auto-close"><span id="close-time">5</span>s后自动关闭</p><span id="layer-close" class="iconfont icon-close"></span></div></section>';
    if ($("#alert-layer")) {
        $("#alert-layer").remove();
    }
    $(alert_tag).appendTo("body");
    $("#alert-layer").height(docH);
    $("#alert-con").html(str);
    var timer = setTimeout(alertClose, 1000);

    function alertClose() {
        var t = $("#close-time").html();
        t--;
        if (t > 0) {
            $("#close-time").html(t);
            setTimeout(alertClose, 1000);
        }
        else {
            $("#alert-layer").remove();
            clearTimeout(timer);
        }
    }

    $("#layer-close").bind("click", function () {
        $("#alert-layer").remove();
    });
}
//Alert (Confirm button)
function alertConfirm(str) {
    var alert_tag = '<section id="confirm-layer"><div id="layer-content"><p id="alert-con"></p><div id="layerbtns"><a id="layer-cancel" href="javascript:">取消</a><a id="layer-ok" href="javascript:">确定</a></div></div></section>';
    if ($("#confirm-layer")) {
        $("#confirm-layer").remove();
    }
    $(alert_tag).appendTo("body");
    $("#alert-layer").height(docH);
    $("#alert-con").html(str);
    $("#layer-ok").bind("touchstart", function () {
        var e = "ok";
        $("#confirm-layer").trigger(e);
        $("#confirm-layer").remove();
        window.location.href = "mobile-login.html?favored=1";
        return false;
    });
    $("#layer-cancel").bind("touchstart", function () {
        var e = "cancel";
        $("#confirm-layer").trigger(e);
        $("#confirm-layer").remove();
        return false;
    });

}

//
function alertOption(json) {
    var alert_tag = '<section id="confirm-layer"><div id="layer-content"><p id="alert-con"></p><div id="layerbtns"><a id="layer-cancel" href="javascript:">' + json.error + '</a><a id="layer-ok" href="javascript:">' + json.right + '</a></div></div></section>';
    if ($("#confirm-layer")) {
        $("#confirm-layer").remove();
    }
    $(alert_tag).appendTo("body");
    $("#alert-layer").height(docH);
    $("#alert-con").html(json.str);
    $("#layer-ok").bind("touchstart", function () {
        var e = "ok";
        json.url && (window.location.href = json.url);
        json.success && json.success();
        $("#confirm-layer").trigger(e);
        $("#confirm-layer").remove();
        return false;
    });
    $("#layer-cancel").bind("touchstart", function () {
        var e = "cancel";
        $("#confirm-layer").trigger(e);
        $("#confirm-layer").remove();
        return false;
    });
    $('#confirm-layer').on('touchmove', function () {
        return false;
    });
}

//Go back page
function goBack() {
    window.history.back();
    return false;
}

//No data message
function noAll(str, id) {
    var tip_box = '<div class="no-order"><span class="no-Info"></span></div>';
    $(id).css('position', 'relative');
    $(tip_box).appendTo(id);
    $(id).find(".no-Info").html(str);
}

//reload page
function reLoad(id) {
    var tip_box = '<div class="no-order"><span class="no-Info">找不到数据辣，请重新<a id="F5">刷新</a>~</span></div>';
    $(id).css('position', 'relative');
    $(tip_box).appendTo(id);
    $("#F5").click(function () {
        window.location.reload();
    });
}

// set cookie
function setCookie(key, value, t) {
    var oDate = new Date();
    oDate.setDate(oDate.getDate() + t);
    document.cookie = key + '=' + value + ';expires=' + oDate.toGMTString();
}
//return cookie value
function getCookie(c_name) {
    if (document.cookie.length > 0) {
        c_start = document.cookie.indexOf(c_name + "=")
        if (c_start != -1) {
            c_start = c_start + c_name.length + 1
            c_end = document.cookie.indexOf(";", c_start)
            if (c_end == -1) c_end = document.cookie.length
            return unescape(document.cookie.substring(c_start, c_end))
        }
    }
    return ""
}

//remove cookie
function removeCookie(name) {
    setCookie(name, 1, -1);
}

// collect notice
function collectShow(str) {
    var timer;
    var tip_box = '<div id="showBox"><span id="showInfo"></span></div>';
    if ($('#showBox')) {
        $('#showBox').remove();
    }
    $(tip_box).appendTo("body");
    $('#showInfo').html(str);
    clearTimeout(timer);
    timer = setTimeout(function () {
        $('#showBox').show();
        setTimeout(function () {
            $('#showBox').hide();
        }, 2000);
    }, 1);
}

//截取案例封面中间部分图片
function imgLoaded() {
    $(".lazy-img").bind("imgloaded", function () {
        var _this = $(this);
        var parentH = _this.parent().height();
        var parentW = _this.parent().width();
        _this.css({
            height: "auto",
            "min-height": parentH
        });
        var imgW = _this.width();
        var imgH = _this.height();
        var _imgH = (parentW / imgW) * imgH;
        // if(imgW/imgH < 4/3){
        // 	var height_t = -(_imgH-parentH)/2;
        // 	_this.css({
        // 		position: "relative",
        // 		top: height_t,
        // 	});
        // }else if(imgW/imgH > 4/3){
        // }
        var height_t = -(_imgH - parentH) / 2;
        _this.css({
            position: "relative",
            top: height_t
        });
        _this.next().css("margin-top", -_imgH);
    });
}

//menu页获取来源
function getSource() {
    if (browser.versions.weixin) {
        $("#apply").attr("href", "mobile-sale_price.html?id=微信-菜单页");
    } else if (browser.versions.weibo) {
        $("#apply").attr("href", "mobile-sale_price.html?id=微博-菜单页");
    } else {
        $("#apply").attr("href", "mobile-sale_price.html?id=M站-菜单页");
    }
}

//截取字符串方法
function setString(str, len) {
    var strlen = 0;
    var s = "";
    for (var i = 0; i < str.length; i++) {
        if (str.charCodeAt(i) > 128) {
            strlen += 2;
        } else {
            strlen++;
        }
        s += str.charAt(i);
        if (strlen > len) {
            return s + "...";
        }
    }
    return s;
}

/*
* countDown Button style
* 发送短信倒计时
*
*@param {Object} parsem
*
*   totaltime           倒计时时间
*   isdisabled          按钮是否可点击 默认不可点击
*   defaultclass        样式类名有默认可替换
*   movehtml            默认时间数字后的文案可修改
*   statichtml          倒计时完成后按钮文字有默认值可修改
*   movetime            倒计时刷新时间
*   event               出发事件
*   isevent             是否选择自定义事件
*
* */
function countButtonDown(parsem) {

    timeDefault = parsem.totaltime || 60;
    // 倒计时时间
    parsem.totaltime = parsem.totaltime || 60;
    // 按钮desabled
    parsem.isdisabled = parsem.isdisabled || 'on';
    // 默认样式
    parsem.defaultclass = parsem.defaultclass || 'seng_message_waiting';
    // 倒计时数字后面文字
    parsem.movehtml = parsem.movehtml || 's秒后重新获取';
    // 按钮默认文字
    parsem.statichtml = parsem.statichtml || '发送短信验证码';
    // 定时器时间
    parsem.movetime = parsem.movetime || 1000;
    // 触发事件
    parsem.event = parsem.event || 'click';
    // 是否选择执行事件
    parsem.isevent = parsem.isevent || false;
    // 定时器
    var countTimer;
    var el = $(parsem.el);

    function countInterDown(){
        clearInterval(countTimer);
        // 设置初始时间
        el.val(parsem.totaltime + parsem.movehtml);
        // 设置按钮是否可点击
        if(parsem.isdisabled == 'on'){
            el.attr('disabled',true)
        }else if(parsem.isdisabled == 'off'){
            el.removeAttr('disabled');
        }else{
            el.attr('disabled',true);
        }
        // 添加倒计时进行中样式--> 可替换class
        el.addClass(parsem.defaultclass);
        countTimer = setInterval(function () {
            if(parsem.totaltime > 0){
                //时间递减
                parsem.totaltime--;
                //更新倒计时间
                el.val(parsem.totaltime + parsem.movehtml);
            }else{
                parsem.totaltime = timeDefault;
                //倒计完成清除定时器
                clearInterval(countTimer);
                // 清除倒计时间样式
                el.removeClass(parsem.defaultclass);
                // 按钮文字复原
                el.val(parsem.statichtml);
                // 按钮可点击
                el.removeAttr('disabled');
                //回掉函数
                parsem.success && parsem.success();
            }
        },parsem.movetime);
    }
    // 按钮操作
    if(!parsem.isevent){
        countInterDown();
    }else{
        el.on(parsem.event,function () {
            countInterDown();
        });
    }
}





//
function countButtonDown(parsem) {

    timeDefault = parsem.totaltime || 60;
    // 倒计时时间
    parsem.totaltime = parsem.totaltime || 60;
    // 按钮desabled
    parsem.isdisabled = parsem.isdisabled || 'on';
    // 默认样式
    parsem.defaultclass = parsem.defaultclass || 'seng_message_waiting';
    // 倒计时数字后面文字
    parsem.movehtml = parsem.movehtml || 's秒后重新获取';
    // 按钮默认文字
    parsem.statichtml = parsem.statichtml || '发送短信验证码';
    // 定时器时间
    parsem.movetime = parsem.movetime || 1000;
    // 触发事件
    parsem.event = parsem.event || 'click';
    // 是否选择执行事件
    parsem.isevent = parsem.isevent || false;
    // 定时器
    var countTimer;
    var el = $(parsem.el);

    function countInterDown(){
        clearInterval(countTimer);
        // 设置初始时间
        el.val(parsem.totaltime + parsem.movehtml);
        // 设置按钮是否可点击
        if(parsem.isdisabled == 'on'){
            el.attr('disabled',true)
        }else if(parsem.isdisabled == 'off'){
            el.removeAttr('disabled');
        }else{
            el.attr('disabled',true);
        }
        // 添加倒计时进行中样式--> 可替换class
        el.addClass(parsem.defaultclass);
        countTimer = setInterval(function () {
            if(parsem.totaltime > 0){
                //时间递减
                parsem.totaltime--;
                //更新倒计时间
                el.val(parsem.totaltime + parsem.movehtml);
            }else{
                parsem.totaltime = timeDefault;
                //倒计完成清除定时器
                clearInterval(countTimer);
                // 清除倒计时间样式
                el.removeClass(parsem.defaultclass);
                // 按钮文字复原
                el.val(parsem.statichtml);
                // 按钮可点击
                el.removeAttr('disabled');
                //回掉函数
                parsem.success && parsem.success();
            }
        },parsem.movetime);
    }
    // 按钮操作
    if(!parsem.isevent){
        countInterDown();
    }else{
        el.on(parsem.event,function () {
            countInterDown();
        });
    }
}



// 在线支付底部导航提示小红点
function getFooterPrompt() {
    $.ajax({
        type: "POST",
        url: "/index.php?m=wap&f=member&v=get_new_reminder",
        dataType: "json",
        timeout: 3000,
        success: function(res){

            console.log(res);
            if(res.red_dot){
                $('.footer_btn_bs .icon-shejishi').parent().append('<span class="footer_me_state"></span>');
            }
        },
        error: function(XMLHttpRequest, textStatus){
            console.log('error');
        }
    });
}
//数组查找
function findInArr(num, arr) {
    for (var i = 0; i < arr.length; i++) {
        if (arr[i] == num) {
            return true;
        }
    }
    return false;
}
//报名遮罩层

function Endmove(ev) {
    var e = ev || event;
    e.preventDefault&&e.preventDefault();
    return false;
}

// 小数验证
function checkPayumber(val) {
    var reg = /^[0-9]+(.[0-9]{1,2})?$/;
    var vals = val.replace(/\s/g,"");
    //console.log("vals==>"+vals,"val==>"+val);
    var state = isNaN(vals);
    if(val == ""){
        return false;
    }
    //console.log(state)
    if(state){
        //console.log(vals)
        if(vals > 0){
            return false;
        }else{
            showTip('请输入正确金额');
            //console.log(1)
            return true;
        }
    }else{
        if(reg.test(val)){
            return false;
        }else{
            showTip('请输入正确金额');
            //console.log(2)
            return true;
        }
    }

}

// toggle click
$.fn.toggleclick = function (fn1,fn2) {
    $(this).on('click',function () {
        var toggleclickState = $(this).hasClass('toggleClick-active');
        if(!toggleclickState){
            // 第一次点击
            $(this).addClass('toggleClick-active')
            fn1&&fn1();
        }else{
             // 第二次点击
            $(this).removeClass('toggleClick-active')
            fn2&&fn2();
        }
    });
}

// 图片取中间部分父级需设置宽高
function scaleImg(imgs) {
    for (var i = 0; i < imgs.length; i++) {
        imgs[i].onload = function () {
            var _this = this;

            function getImgAttribute(){
                var boxW = parseFloat($(_this).parent().css('width').match(/\d+/g)); //区域宽度
                var boxH = parseFloat($(_this).parent().css('height').match(/\d+/g)); //区域高度
                var img = new Image();
                img.src = _this.src;
                var imgW = img.width;
                var imgH = img.height;

                var imgleft = -(boxH * imgW / imgH - boxW) / 2;
                var imgtop = -(boxW * imgH / imgW - boxH) / 2;
                ////console.log(boxW+'  '+boxH+' imgwidthheight '+imgW+'---'+imgH+' marginlefttop '+imgleft+'---'+imgtop);
                return {
                    left:imgleft,
                    top:imgtop,
                    imgw:imgW,
                    imgh:imgH,
                    boxw:boxW,
                    boxh:boxH
                }
            }
            var imgAttr = getImgAttribute();
            ////console.log(getImgAttribute())

            if (imgAttr.imgw > imgAttr.imgh) {
                this.style.height = '100%';
                if($(this).width() < imgAttr.boxw){
                    this.style.width = '100%';
                }else{
                    this.style.marginLeft = getImgAttribute().left + 'px';
                }

            } else {
                this.style.width = '100%';
                this.style.marginTop = getImgAttribute().top + 'px';
            }
        };
    }
}

var oScrollTop;
$(function () {
    //遮罩层显示时阻止滑动屏幕内容跟随
    //遮罩层显示
    $('.amount_house_bs').on('touchstart', function () {
        oScrollTop = document.body.scrollTop;
        document.body.scrollTop = 0;
        $(".footer_menu_bs").hide();
        $('.amount_house_mask_bs').show();
        $('.in_info_bs').show();
        $("#errorCue").css({'top': 0});
        $('.amount_house_mask_bs').on('touchmove', Endmove);
        return false;
    });
    //遮罩层关闭按钮
    $('.in_info_close_bs').on('click', function () {
        $('.amount_house_mask_bs').hide();
        $('.in_info_bs').hide();
        $(document).off('touchmove', Endmove);
        alertOpenbOk = false;
        document.body.scrollTop = oScrollTop;
        $(".footer_menu_bs").show();
        return false;
    });
    //在线支付 0263 start
    if($('.footer_menu_bs')[0]){
        getFooterPrompt();
    }

});















