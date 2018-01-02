var butlerMas;
var buildingSite;
var case_id = GetQueryString("butlerid");
//console.log(case_id);
var url = encodeURIComponent(window.location.href.split("#")[0]);
//url add 微信来源识别参数
var urls = url+"&stem=wx";
var urlStem;
console.log(urls);

//var urlStem = GetQueryString("stem");
wxShare(url, "steward", case_id);
//返回按钮
$(document).on('touchstart',"#go-back",goBack);

//检测是否安卓 安卓隐藏诸葛装修
if(browser.versions.android){
    $('.zhuge').hide();
}

//读取url参数
function GetQueryString(name) {
    var reg = new RegExp("(^|&)" + name + "=([^&]*)(&|$)");
    var r = window.location.search.substr(1).match(reg);
    if (r != null)return unescape(r[2]);
    return null;
}
//数据加载
function butler_mas() {
    $.ajax({
        type: "POST",
        url: "/api/housekeeper.php?action=data",
        data: {
            "uid": case_id
        },
        dataType: "json",
        success: function (res) {
            console.log(res);
            if (!res.code)return;
            butlerMas = res.data;
            buildingSite = res.data.site;

            var data1 = res.data;
            if(data1.collectstatus == 1){
                $("#collect i").removeClass("icon-star_one").addClass("icon-star_two");
            }
            else{
                $("#collect i").removeClass("icon-star_two").addClass("icon-star_one");
            }
            if(butlerMas.answer.length == 0){
                $('#answer').remove();
            }else{
                //问题列表
                solveTemplate("#answer", "#building-answer-template", butlerMas);
            }
            if(butlerMas.site.length == 0){
                $('#building_list1').remove();
            }else{
                //工地列表
                solveTemplate("#building_list1", "#building-list-template", buildingSite);
                //setTimeout(function(){
                //    scaleImg('.live_list_img img');
                //},300);
                //scaleImg('.live_list_img img');
                //$('.live_list_img img').css({"height":"auto","width":"100%"});
               $('.live_list_img img').css({
                        "width":"120%",
                        "margin-left":"-10%",
               });
            }
            if(browser.versions.weixin){
                urlStem='wx';
            }else{
                urlStem='nowx';
            }
            solveTemplate("#header", "#header-template", urlStem);
            $('header .header-title').html('装修管家-'+res.data.gjname);

            //管家信息
            solveTemplate("#butler_mas_box", "#butlerMas-template", butlerMas);
            //个人履历
            solveTemplate("#promise_undergo", "#promise_undergo-template", butlerMas);
            //header and weixin share
            //微信分享



            //问题列表查看更多
            general(50);
            //设置图片尺寸
            //setTimeout(function(){
            //    scaleImg('.live_list_img img');
            //},700);

            //scaleImg('.live_list_img img');


        },
        error: function (XMLHttpRequest, textStatus) {
            if (textStatus == "timeout") {
                reLoad("body");
            }
        }
    });
}
//收藏
function collectCase() {
    $.ajax({
        type: "POST",
        url: "/api/housekeeper.php?action=collect&id="+case_id,
        dataType: "json",
        success: function (res) {
            //console.log(res);

            if (res) {
                if (res.code == 0) {
                    alertConfirm("登录后才能收藏哦，去登录~");
                    $("#confirm-layer").on('touchmove', function (event) {
                        event.preventDefault();
                    })
                } else {
                    var data = res.data;
                    if (data.collectstatus == 1) {
                        $("#collect i").removeClass("icon-star_one").addClass("icon-star_two");
                        collectShow(res.message);
                    }
                    else {
                        $("#collect i").removeClass("icon-star_two").addClass("icon-star_one");
                        collectShow(res.message);
                    }
                }
            }
        },
        error: function () {
            alert("找不到数据辣，请稍后再试~");
        }
    });
}
//检测字符
function general(number) {
    $('.answer_question_text .answer_text_test').each(function (index, ele) {
        var _thisOldHtml = $(this).html();
        var _thisHtmlLength = $(this).html().length;
        if (_thisHtmlLength > number) {
            $('<a href="javascript:;" class="answer-question_more">查看全文</a>').appendTo($(this).parent());
            $("<em>" + _thisOldHtml + "</em>").appendTo($(this).parent());
            var newText = _thisOldHtml.substr(0, number) + "...";
            $(this).html(newText);
            $('<span class="answer_question_zw"></span>').appendTo($(this));
        }
    });

    //查看全文按钮
    $('.answer-question_more').on('touchstart', function (e) {
        var oldHtml = $(this).siblings('em').html();
        var btnHtml = $(this).html();
        var newHtml = oldHtml.substr(0, number) + "...";
        switch (btnHtml) {
            case '收起':
                $(this).siblings('.answer_text_test').html(newHtml);
                $('<span class="answer_question_zw"></span>').appendTo($(this).siblings('.answer_text_test'));
                $(this).html('查看全文');
                break;
            case '查看全文':
                $(this).siblings('.answer_text_test').html(oldHtml);
                $('<span class="answer_question_zw"></span>').appendTo($(this).siblings('.answer_text_test'));
                $(this).html('收起');
                break;
        }
        e.preventDefault();
        return false;
    });
}

//IMG LOADSIZE
function liveImgLoaded(){
    $(".lazy-img").bind("imgloaded",function(){
        var that = $(this);
        that.css({
            height: "auto",
            "min-height": "10.1875rem"
        });
        var boxH = $(".building-box").height();
        var boxW = $(".building-box").width();
        var imgW = that.width();
        var imgH = that.height();
        var _imgH=(boxW/imgW)*imgH;

        var height_t = -(_imgH-boxH);
        that.css({
            position: "relative",
            top: height_t/2
        });
        that.next().css("margin-top", height_t);
    });
}
function scaleImg(obj) {
    var imgs = $(obj);
    var boxW = imgs.parent().width(); //区域宽度
    var boxH = imgs.parent().height(); //区域高度
    var ratio = boxW/boxH;
    for(var i=0; i<imgs.length; i++) {
        imgs[i].onload = function(){
            var img = new Image();
            img.src = this.src;
            var imgW = img.width;
            var imgH = img.height;
            var imgRatio = imgW/imgH;
            if(ratio > imgRatio){
                var height_t=-((boxW/imgW)*imgH - boxH)/2;
                this.style.height = "auto";
                this.style.marginTop = height_t + "px";
                this.style.width = '100%';
            } else {
                var width_w=-((boxH/imgH)*imgW - boxW)/2;
                this.style.width = "auto";
                this.style.marginLeft = width_w + "px";
                this.style.height = '100%';
            }
        };
    }
}
$(function () {
    //预约管家链接
    $('#ordered_butler_link').attr('href','mobile-ordered.html?id=M站-管家详情页&page_id='+case_id+'&type=steward');
    butler_mas();
    //在管工地更多
    $(document).on('touchstart', '#building_list1 .building_more', function (e) {
        setTimeout(function(){
            $('#building_listm').show();
            $('#building_list1').hide();
            solveTemplate("#building_listm", "#building-listm-template", buildingSite);
            //设置图片尺寸
            //scaleImg('.live_list_more img');
            $('.live_list_more img').css({
                "width":"120%",
                "margin-left":"-10%"
            });
        },100);
        e.preventDefault();
        return false;
    });
    $(document).on('touchmove', '#building_list1 .building_more', function (e) {
        return false;
    });
    //在管工地收起
    $(document).on('touchstart', '#building_listm .building_more', function (e) {
        setTimeout(function(){
            $('#building_listm').hide();
            $('#building_list1').show();
            solveTemplate("#building_list1", "#building-list-template", buildingSite);
        },100);
        e.preventDefault();
        return false;
    });

    $("#collect").on('touchstart', function () {
        collectCase();
        return false;
    });
    //点赞
    $(document).on('touchstart','.answer_time_zan',function(){

        var _this = $(this);
        var zannumber = $(this).attr('number');
        zannumber++;
        $(this).attr({'number':zannumber});
        var zanStatus = zannumber%2;

        var answerId = $(this).attr('zanid');
        $.ajax({
            type: "POST",
            url: "/api/housekeeper.php?action=laud&id="+answerId+"&laudstatus="+zanStatus,
            dataType: "json",
            success: function (res) {
                //console.log(res);
                var data = res.data;
                if(res.code == 1){
                    _this.find('i').addClass('zan1');
                    _this.find('span').html(data.answer_laud);
                    _this.css({'color':'#ff7519'});
                }else{
                    _this.find('i').removeClass('zan1');
                    _this.find('span').html(data.answer_laud);
                    _this.css({'color':'#999999'});
                }
            },
            error: function () {
                alert("找不到数据辣，请稍后再试~");
            }
        });

    });
});