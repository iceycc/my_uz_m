/* Created by zhaorong on 2016-8-25*/
//siteNodeMas.urlordadeId
//工地直播头部信息
//头部信息
var siteMassages,
    //节点详情
    siteNodeMas,
    //
    criticsNum,
    //节点参数
    NodeBok = true,
    //评论状态
    criticsBok = false,
    //加载id
    LoadNoad = [],
    // 大图展示1
    alertImg,
    // 大图展示2
    alertImg1,
    // 加载定时器
    infoTextTimer,
    // 订单id
    titleOrderid,
    //节点数组
    nodeArray = [],
    //评论参数
    ismysite = 0,
    //评分结果
    ownerSayScoreData = {},
    //业主说状态
    ownerAddDataStatus = 0,
    //业主说data
    owner_data,
    //追评data
    addratingsData;

var urlordadeId = GetQueryString("live_id") ? GetQueryString("live_id") : GetQueryString("id");
var newStemNodeid = GetQueryString("nodeid");
var isAPP = GetQueryString("app");
var isLog = getCookie('NDb__uid');

//The live broadcast list page requires the order id start
setCookie('buildingid', urlordadeId, 1);
//end

//title massage and node time
function getTitleMas() {
    $.ajax({
        type: "POST",
        url: "/index.php?m=wap&f=biz_lognew&v=log&orderid=" + urlordadeId,
        dataType: "json",
        timeout: 3000,
        success: function (res) {
            if (!res.code || ismysite == 1)return;
            siteMassages = res.data;

            //console.log(res);
            if ($('header .header-title').html() == "工地直播") {
                solveTemplate("#site-title-mas", "#butler-info-template", siteMassages);

                solveTemplate("#space_img", "#space-img-template", siteMassages);
                scaleImg($("#space_img img"));
                //app 删除头部
                deleteHeader();
            }
            var nodeTimeres = siteMassages.resu;

            //设置节点时间，节点进行状态
            $.each(nodeTimeres, function (index, ele) {
                //保存已进行节点id
                nodeArray.push(ele[0]);
                LoadNoad.push(isNodeId[0][ele[0]]);
                $('#' + isNodeId[0][ele[0]]).removeClass('isnodemassage').attr('ismassage', '1').find('.zxnode_times').html(ele[1]).show();
            });
            // //console.log(nodeArray);

            //中间未进行节点删除
            if (nodeTimeres.length > 0) {
                searchNodeId(siteMassages);
            }
            //收藏状态
            if (res.data.collectstatus == 1) {
                $('#favor-btn .iconfont').attr('class', 'iconfont icon-star_two');
            } else {
                $('#favor-btn .iconfont').attr('class', 'iconfont icon-star_one');
            }

            var underway;
            var oldNode = isNodeId[1][getCookie('nodeids')];

            if (oldNode) {
                underway = oldNode;
                removeCookie('nodeids');
            } else {
                underway = res.data.max_logname.nodeid;
                removeCookie('nodeids');
            }

            //节点详情是否加载完成
            var ajaxTimer = setInterval(function () {
                if (NodeBok)return;
                clearInterval(ajaxTimer);
                nodeMasLoads(underway, siteNodeMas, 165);
            }, 100);
        },
        error: function (XMLHttpRequest, textStatus) {
            if (textStatus == "timeout") {
                reLoad("body");
            }
        }
    });
}

/*
 **	ownerSriticsScore 		uezhushuo & pingfen & pinglun
 ** 	params
 ** 					[underway-->>nodeid || node=>this]
 ** 					[siteNodeMas-->>node massage]
 ** 					[Thissibstsid-->>tongji id]
 ** 					[newcriticsTit-->>jiedianneirong]
*/
function ownerSriticsScore(underway,status,Thissibstsid,newcriticsTit){
    //当前业主说id
    ////console.log(underway,status,Thissibstsid,newcriticsTit)

    ownerSayScoreData.NODEID = isNodeId[1][Thissibstsid.replace("s","")];
    ////console.log(ownerSayScoreData);
    var ownerScoreArray = [37,27,31,35];

    //业主说
    ////console.log(ownerSayScoreData.NODEID)
    if(ownerSayScoreData.NODEID > 10 && $('header .header-title').html() == "我的工地"){
        //支付节点
        //payNodeCont(underway,status);
        //业主说
        ownerSay(underway,status);
    }
    //评论
    criticsDom(Thissibstsid, newcriticsTit);

    //支付信息
    if($('header .header-title').html() == "我的工地"){
        nodePayment(underway,status);
    }
    // nodePayment(underway,status);

    //评分
    if(findInArr(ownerSayScoreData.NODEID,ownerScoreArray) && siteMassages.node.company) {
        scoreStar(underway, status);
    }


}


/*
 **	nodeMasLoads 		iedian shuju
 ** 	params
 ** 					[underway-->>nodeid]
 ** 					[siteNodeMas-->>node massage]
 ** 					[tops-->>scrolltop]
*/
function nodeMasLoads(underway, siteNodeMas, tops) {
    //加载最新节点数据
    solveTemplate("#s" + isNodeId[0][underway], "#s" + isNodeId[0][underway] + "-cont-template", siteNodeMas);
    //img取中间
    var nowNodwImg = $("#" + isNodeId[0][underway]).find('img');
    scaleImg(nowNodwImg);

    //最新节点评论dom
    var newcriticsTit = $("#" + isNodeId[0][underway]).find('.zxnode_list_title');
    var Thissibstsid = "s" + isNodeId[0][underway];

    ownerSriticsScore(underway,'load', Thissibstsid, newcriticsTit);

    //已加载识别,内容展开
    $("#" + isNodeId[0][underway]).attr('isload', 1).addClass('slideDown');
    appDomContent(isNodeId[0][underway]);

    //当前进行节点显示首屏
    var newTops = getPos($("#s" + isNodeId[0][underway])[0]).top - tops;
    setScrollTo(newTops);
    removeCookie('nodeids');
}

/*2.91 支付 start*/
function nodePayment(underway,stem){
    var ownerId;
    if(stem == 'load'){
        ownerId = isNodeId[0][underway];
        ////console.log(ownerId)
        // 识别最新节点
        $("#" + isNodeId[0][underway]).find('.zxnode_list_cont').append('<div class=pay_ment id=payment_mode_'+ownerId+'></div>');
        //solveTemplate('#payment_mode_'+ownerId,"#payment_mode_templete" , siteNodeMas);

    }else{
        ownerId = $(underway).parents('.zxnode_list').attr('id');
        ////console.log(ownerId)
        // 识别点击节点
        $(underway).parents('.zxnode_list').find('.zxnode_list_cont').append('<div class=pay_ment id=payment_mode_'+ownerId+'></div>');
        solveTemplate('#payment_mode_'+ownerId, "#payment_mode_templete", siteNodeMas);
        scaleImg($('.acc_contimg img'));
    }
}
//支付节点
function payNodeCont(underway,stem){
    var ownerId;
    if(stem == 'load'){
        ownerId = isNodeId[0][underway];
        ////console.log(ownerId)
        // 识别最新节点
        $("#" + isNodeId[0][underway]).find('.zxnode_list_cont').append('<div class=pay_addmode id=payaddmode_mode_'+ownerId+'></div>');
        solveTemplate('#payaddmode_mode_'+ownerId,"#payaddmode_mode_templete" , siteNodeMas);
    }else{
        ownerId = $(underway).parents('.zxnode_list').attr('id');
        ////console.log(ownerId)
        // 识别点击节点
        $(underway).parents('.zxnode_list').find('.zxnode_list_cont').append('<div class=pay_addmode id=payaddmode_mode_'+ownerId+'></div>');
        solveTemplate('#payaddmode_mode_'+ownerId, "#payaddmode_mode_templete", siteNodeMas);
    }
}

/*2.91 支付 end*/




//shanchu cookoe
function removeCookie(name) {
    setCookie(name, 1, -1);
}

// 设置滚动距离
function setScrollTo(tops) {
    if (document.documentElement.scrollTop) {
        document.documentElement.scrollTop = tops;
    } else {
        document.body.scrollTop = tops;
    }
}

// app 删除节点
function appDomContent(nodeName) {
    if (nodeName == 'none2' && isAPP && isAPP == 1) {
        $('.company_audit_shenhe').remove();
    }
}

// app删除头部
function deleteHeader() {
    if (isAPP && isAPP == 1) {
        $('header').remove();
        $('body').css({'padding-top': 0});
    }
}

// Before the test is carried out
function ListNodeTest(NodeNameStart, NodeNameEnd, Array) {
    var StartNum = NodeNameStart.match(/\d+/g);
    var EndNum = NodeNameEnd.match(/\d+/g);
    var States = true;

    for (var i = parseInt(EndNum); i >= parseInt(StartNum); i--) {
        if (findInArr(isNodeId[1]['node' + i], Array)) {
            States = false;
        }
    }
    return States;
}

// 节点详情
function getNodeRes() {
    $.ajax({
        type: "POST",
        url: "/index.php?m=wap&f=biz_lognew&v=detail&orderid=" + urlordadeId,
        dataType: "json",
        timeout: 3000,
        success: function (res) {
            if (!res.code || ismysite == 1)return;
            siteNodeMas = res.data;
            //console.log(res);
            NodeBok = false;
            siteNodeMas.URLordadeId = urlordadeId;
            $.each(siteNodeMas, function (index, ele) {
                if(ele.nodeid == 15 && ele.nodename.nodename == "签设计协议" ){
                    $('#node3 .zxnodestatus').html('签订设计协议');
                }
            });
        },
        error: function (XMLHttpRequest, textStatus) {
            if (textStatus == "timeout") {
                reLoad("body");
            }
        }
    });
}

// 更新评论
function getMassageRes(fn) {
    $.ajax({
        type: "POST",
        url: "/index.php?m=wap&f=biz_lognew&v=detail&orderid=" + urlordadeId,
        dataType: "json",
        timeout: 3000,
        success: function (res) {
            if (!res.code)return;
            ////console.log(res);
            siteNodeMas = res.data;
            siteNodeMas.URLordadeId = urlordadeId;
            fn && fn(res);
        },
        error: function (XMLHttpRequest, textStatus) {
            if (textStatus == "timeout") {
                reLoad("body");
            }
        }
    });
}

// 数组查找
function findInArr(num, arr) {
    for (var i = 0; i < arr.length; i++) {
        if (arr[i] == num) {
            return true;
        }
    }
    return false;
}

// 当前节点前未进行节点
function searchNodeId(siteMassages) {
    var newNodeId = siteMassages.max_logname.nodeid;
    var newNudeName = isNodeId[0][newNodeId];
    var newNudeNum = newNudeName.match(/\d+/g)[0];

    function deleteDzengNode(a){
        var delEachNum = a ? a : 50;
        for(var i = 21;i< delEachNum ;i++){
            if(!isNodeId[1]['node' + i])return false;
            var ownNodeId = isNodeId[1]['node' + i];
            if (!findInArr(ownNodeId, nodeArray)) {
                $('#node' + i).remove();
            }
        }
    }
    ////console.log(nodeArray,111111)
    if(parseFloat(newNudeNum) <= 20 && parseFloat(newNudeNum) != 1){
        //最新节点之前递减查找未进行的节点并删除

        for (var i = parseFloat(newNudeNum); i > 0; i--) {
            var ownNodeId = isNodeId[1]['node' + i];

            if(i == 1){
                deleteDzengNode();
            }
            if (!findInArr(ownNodeId, nodeArray)) {
                $('#node' + i).remove();
            }

        }
    }else{
        deleteDzengNode(newNudeNum);
    }
    // 查看大节点中间是否有进行的节点 如果没有 删除该大的节点
    $('.zxnode_start').each(function (index,el) {
        var zxNodeSize = $(this).find('.zxnode_list').size();
        ////console.log(zxNodeSize);
        if(zxNodeSize == 0){
            $(this).remove();
            $('.zxnode_start').removeClass('zxnode_march').addClass('zxnode_march').eq(0).removeClass('zxnode_march');
        }
    })

}

//  评论提交
function criticsMode(DATA, fn) {
    $.ajax({
        type: "POST",
        url: "/index.php?m=wap&f=biz_lognew&v=public_log_comment",
        dataType: "json",
        data: DATA,
        timeout: 3000,
        success: function (res) {
            if (!res.code)return;
            fn && fn(res);
        },
        error: function (XMLHttpRequest, textStatus) {
            if (textStatus == "timeout") {
                reLoad("body");
            }
        }
    });
}

// 弹窗提示
function alertMassage(text) {
    $('.alert_points_text').show().html(text).addClass('animated fadeInDown');
    setTimeout(function () {
        $('.alert_points_text').removeClass('fadeInDown').addClass('fadeOutUp');
        setTimeout(function () {
            $('.alert_points_text').hide().removeClass('fadeOutUp');
        }, 1000);
    }, 2000);
}

// 获取url参数
function GetQueryString(name) {
    var reg = new RegExp("(^|&)" + name + "=([^&]*)(&|$)");
    var r = window.location.search.substr(1).match(reg);
    if (r != null)return unescape(r[2]);
    return null;
}

// 获取目标位置函数//原生对象
function getPos(obj) {
    var l = 0;
    var t = 0;
    while (obj) {
        l += obj.offsetLeft;
        t += obj.offsetTop;
        obj = obj.offsetParent;
    }
    return {
        left: l,
        top: t
    }
}

//评论框动画
function criticsAnimate(_this) {
    criticsBok = false;
    var _thisPost = getPos(_this[0]);

    ////console.log(_thisPost);
    if (document.documentElement.scrollTop) {
        document.documentElement.scrollTop = _thisPost.top;
    } else {
        document.body.scrollTop = _thisPost.top;
    }
    $('.critics_text_info').val('').blur();
    $('.critics_text').hide().removeAttr('style').attr('ducshow', 0);
    ;
    $('.icon-pinglun').removeClass('woshipinglunanniu');
    return false;
}

// 评论模块
function criticsDom(ThisSiblingsId, _this) {
    criticsNum = isNodeId[1][$(_this).parents('.zxnode_list').attr('id')];
    ////console.log(criticsNum);
    var criticsObj = $("#critics-" + ThisSiblingsId).size();
    if(!criticsObj){
        var criticsMode = '<div class=discuss id=critics-' + ThisSiblingsId + '></div>';
        $(_this).parents('.zxnode_list').find('.zxnode_list_cont').append(criticsMode);
        solveTemplate("#critics-" + ThisSiblingsId, "#critics-template", siteNodeMas);
    }else{
        solveTemplate("#critics-" + ThisSiblingsId, "#critics-template", siteNodeMas);
    }
    // var criticsMode = '<div class=discuss id=critics-' + ThisSiblingsId + '></div>';
    // $(_this).parents('.zxnode_list').find('.zxnode_list_cont').append(criticsMode);
    // solveTemplate("#critics-" + ThisSiblingsId, "#critics-template", siteNodeMas);
    //登录隐藏评论按钮
    if (ismysite == 0) {
        if (siteMassages.statu == 1) {
            $('.discuss_title_r').hide();
        }
    }
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

// 设置滚动条高度
function setScrollTop(obj) {
    var scrolltop;
    if (document.documentElement.scrollTop) {
        scrolltop = document.documentElement.scrollTop;
    } else {
        scrolltop = document.body.scrollTop;
    }
    $(obj).css({
        "position": "absolute",
        "left": 0,
        "top": scrolltop
    });
}

// 收藏
function setFavorite() {
    $.ajax({
        type: "POST",
        url: "index.php?m=wap&f=member&v=fav_day_log&type=day_log&orderid=" + urlordadeId,
        dataType: "json",
        timeout: 3000,
        success: function (data) {
            ////console.log("获取收藏状态");
            ////console.log(data);
            if (data.code == 0) {
                alertConfirm("登录后才能收藏哦，去登录~");
                $("#confirm-layer").on('touchmove', function (event) {
                    event.preventDefault();
                })
            } else {
                if (data.data.collectstatus == 1) {
                    $("#favor-btn .iconfont").removeClass("icon-star_one").addClass("icon-star_two");
                } else {
                    $("#favor-btn .iconfont").removeClass("icon-star_two").addClass("icon-star_one");
                }
                collectShow(data.message);
            }

        },
        error: function (XMLHttpRequest, textStatus) {
            //console.log("getNodeData error");
        }
    });
}

// img大图轮播
function showBigPic(_thisIndex,title) {
    var TITLE = title ? title : '';
    //$(".lazy-bimg").dxLazyLoad();
    var caseDom = $("#case-info"),
        docH = $(document).height(),
        winH = $(window).height(),
        winW = $(window).width();
    //var index = parseInt($(_this).attr("index"));
    var index = _thisIndex;
    $('.pic-info').height(winH);
    $('.pic-local').width(winW);
    $('.space_name').html(TITLE);
    // caseDom.height(winH);

    $("#big-pic").show().css({
        width: winW,
        height: winH,
        overflow: "auto"
    });
    caseDom.css({
        height: winH,
        overflow: "hidden"
    });
    var swipe = new Swipe(document.getElementById('slider'), {
        speed: 400,
        startSlide: index - 1,
        callback: function () {
            //current index position
            var index = this.getPos() + 1;
            $("#current-number").text(index);
            // preLoadImg(index);
        }
    });
    //初始化
    $("#current-number").text(swipe.getPos() + 1);
    //total index position
    $("#total-number").text(swipe.getLength());
    $('.pic-info').each(function () {
        new RTP.PinchZoom($(this), {});
    });

    $('#big-pic').on('click', ".go-back", function (e) {
        var headerH = $("header").height(),
            btmH = $(".bottom-btn").height();
        $("#big-pic").hide();
        // caseDom.height(docH-headerH-btmH);
        caseDom.css({
            height: "auto",
            overflow: ""
        });
        $('#slider').html('<ul id="big-pic-content"></ul>');
        event.preventDefault();
        return false;
    });
}

// 业主评分
function createOwnerModule() {

}

// transfer nodeid or idnode
var isNodeId = [
    {
    "10": "node26",
    "11": "node1",
    "12": "node2",
    "15": "node3",
    "17": "node4",
    "19": "node5",
    "21": "node6",
    "25": "node7",
    "27": "node8",
    "29": "node9",
    "28": "node10",
    "31": "node11",
    "33": "node12",
    "35": "node13",
    "36": "node14",
    "37": "node15",
    "39": "node16",
    "45": "node17",
    "43": "node18",
    "49": "node19",
    "51": "node20",
    "1": "node21",
    "2": "node22",
    "9": "node23",
    "101": "node24",
    "102": "node25"
}, {
    "node1": 11,
    "node2": 12,
    "node3": 15,
    "node4": 17,
    "node5": 19,
    "node6": 21,
    "node7": 25,
    "node8": 27,
    "node9": 29,
    "node10": 28,
    "node11": 31,
    "node12": 33,
    "node13": 35,
    "node14": 36,
    "node15": 37,
    "node16": 39,
    "node17": 45,
    "node18": 43,
    "node19": 49,
    "node20": 51,
    "node21": 1,
    "node22": 2,
    "node23": 9,
    "node26": 10,
    "node24": 101,
    "node25": 102
}];

// 评论框title
var revisePlTextList = [
    {
        "plButton":".icon-pinglun",
        "plText":"我要回复",
        "textarea":""
    },
    {
        "plButton":".discuss_title_r",
        "plText":"我要评论",
        "textarea":""
    },
    {
        "plButton":".write_log",
        "plText":"日志编写",
        "textarea":""
    },
    {
        "plButton":".owner_say .revise",
        "plText":"日志修改",
        "textarea":""
    },
    {
        "plButton":".owner_textbutton .addratings",
        "plText":"追加评价",
        "textarea":""
    }
];
/*
2.9 start
*/

// start status text
var StarStatus = ['非常差', '差', '一般', '好', '非常好'];

// 添加星星
function addStarNum(){
    $('.start_cont').each(function(){
        var this_res = $(this).attr('number');
        if(this_res > 0){
            $(this).siblings('.start_num').html(StarStatus[parseInt(this_res)-1]).removeClass('color_red');
        }
        $(this).find('.iconfont').each(function(ind,el){
            if(ind <　this_res){
                $(el).removeClass('icon-star_one').addClass('icon-star_two color_red');
            }
        });
    });
}

// 业主说模板
function ownerSay(underway,stem){
    var ownerId;
    if(stem == 'load'){
        ownerId = isNodeId[0][underway];
        ////console.log(ownerId)
        // 识别最新节点
        $("#" + isNodeId[0][underway]).find('.zxnode_list_cont').append('<div class=owner_say id=owner_mode_'+ownerId+'></div>');
        solveTemplate('#owner_mode_'+ownerId,"#owner_say_templete" , siteNodeMas);
    }else{
        ownerId = $(underway).parents('.zxnode_list').attr('id');
        ////console.log(ownerId)
        // 识别点击节点
        $(underway).parents('.zxnode_list').find('.zxnode_list_cont').append('<div class=owner_say id=owner_mode_'+ownerId+'></div>');
        solveTemplate('#owner_mode_'+ownerId, "#owner_say_templete", siteNodeMas);
    }

}

// 评分模板
function scoreStar(underway,stem){

    var scoreId;
    if(stem == 'load'){
        scoreId = isNodeId[0][underway];
        $("#" + isNodeId[0][underway]).find('.zxnode_list_cont').append('<div class=score_star id=score_mode_'+scoreId+'></div>');
        solveTemplate("#score_mode_"+scoreId, "#score_star_templete", siteNodeMas);
        addStarNum();
    }else{
        scoreId = $(underway).parents('.zxnode_list').attr('id');
        // 识别点击节点
        $(underway).parents('.zxnode_list').find('.zxnode_list_cont').append('<div class=score_star id=score_mode_'+scoreId+'></div>');
        solveTemplate("#score_mode_"+scoreId, "#score_star_templete", siteNodeMas);
        addStarNum();
    }
}

// 提交业主说数据
function sendOwnerSay(){
    ////console.log(ownerSayScoreData);
    $.ajax({
        type: "POST",
        url: "/index.php?m=wap&f=member_lognew&v=owner_write_log",
        data:ownerSayScoreData.ownerSayData,
        dataType: "json",
        timeout: 3000,
        success: function (res) {
            owner_data = res.data;
            //console.log(res)
            if(res.code == 0){
                owner_data = {};
            }
            //console.log(isNodeId[0][ownerSayScoreData.NODEID])
            ownerAddDataStatus = 1;
            solveTemplate('#owner_mode_'+isNodeId[0][ownerSayScoreData.NODEID],"#owner_say_templete" , owner_data);
            ownerAddDataStatus = 0;
            $('.critics_text').hide().find('.critics_text_info').val('');
        },
        error: function (XMLHttpRequest, textStatus) {
            //console.log(XMLHttpRequest)
        }
    });
}

// 业主说数据
function setOwnerData(JSON){
    ownerSayDatas = ownerSayScoreData.ownerSayData;
    ownerSayDatas.orderid = urlordadeId;
    if(JSON.NODEID){
        ownerSayDatas.nodeid = JSON.NODEID;
    }
    if(JSON.STATUS){
        ownerSayDatas.status = JSON.STATUS;
    }
    if(JSON.SPEAK){
        ownerSayDatas.owner_speak = JSON.SPEAK;
    }
    ////console.log(ownerSayScoreData);

}

// 业主说
function ownerText(){
    //zhuce yeshushuo data
    var ownerSayDatas = ownerSayScoreData.ownerSayData = {};
    // zhuopin  nodeid
    var ratingsNodeid;
    //合并数据
    function showOwnerText(_this,status){
        ownerSayScoreData.NODEID = isNodeId[1][_this.parents('.zxnode_list').attr('id')];
        //console.log(ownerSayScoreData)
        if(status == 1){
            //console.log(isNodeId[1][_this.parents('.zxnode_list').attr('id')],status)
            criticsBok = true;
            setOwnerData({
                "NODEID":isNodeId[1][_this.parents('.zxnode_list').attr('id')],
                "STATUS":status
            });
            ////console.log(ownerSayScoreData);
            var old_OWNERSAY = _this.parents('.owner_say').find('.spak_text_wz').html();
            $('.critics_text .critics_text_info').val(old_OWNERSAY);
            $('.critics_text').show().attr('ducshow', 1);
            $('.critics_text .owner_textcont_num').show();
            var old_OWNERSAY_SIZE = $('.critics_text .critics_text_info').val().length;
            ////console.log(old_OWNERSAY_SIZE)
            $('.owner_textcont_num span').html(old_OWNERSAY_SIZE);
            $('#owner_say_cont .icon-right').attr('stem',9);
            setScrollTop('.critics_text');
        }else{
            //console.log(_this.parents('.owner_say').find('.say_text .spak_text_wz').html());
            //console.log(isNodeId[1][_this.parents('.zxnode_list').attr('id')])
            ////console.log($(this).parents('.owner_say').find('.say_text .spak_text_wz').html())
            setOwnerData({
                "STATUS":status,
                "NODEID":isNodeId[1][_this.parents('.zxnode_list').attr('id')],
                "SPEAK":_this.parents('.owner_say').find('.say_text .spak_text_wz').html()
            });
        }
    }

    $('.zxnode_list').on('click', '.write_log', function () {
        showOwnerText($(this),1);
    });


    //评论字符长度
    $('.critics_text .critics_text_info').on('input',function(){
        var textSize = $(this).val().length;
        $(this).siblings('.owner_textcont_num').find('span').html(textSize);
        setOwnerData({
            "SPEAK":$(this).val()
        });
    });

    //send ownerSay
    $('#owner_say_cont .icon-right').on('touchstart',function(){
        var writeLogOrpl = $('#owner_say_cont .icon-right').attr('stem');
        if(writeLogOrpl == 9){
            sendOwnerSay();
        }else if(writeLogOrpl == 10){
            addRatings(ratingsNodeid);
        }
    });

    //修改业主说
    $('.zxnode_list').on('click','.owner_say .revise',function(){
        showOwnerText($(this),1);
    });

    //追加评分
    $('.zxnode_list').on('click','.owner_textbutton .addratings',function(){
        $('.critics_text').show().attr('ducshow', 1);
        $('.critics_text .owner_textcont_num').show();
        $('.owner_textmak .owner_textcont_num span').html(0);
        $('#owner_say_cont .icon-right').attr('stem',10);
        ratingsNodeid = isNodeId[1][$(this).parents('.zxnode_list').attr('id')];
        setScrollTop('.critics_text');
        ////console.log(ratingsNodeid)
        //追评按钮Id
        $(this).attr('id','node_ratings'+ratingsNodeid);

    });

    //业主说删除
    $('.zxnode_list').on('click','.owner_say .output',function(){
        ////console.log(ownerSayScoreData);
        var _this = $(this);
        ////console.log(ownerSayScoreData)
        alertOption({
            "str":'确定删除？',
            "right":'确认',
            "error":'取消',
            "success":function(){
                showOwnerText(_this,2);
                //ownerSayScoreData.NODEID = $(this).parents('.zxnode_list').attr('id');
                sendOwnerSay();
                ////console.log(ownerSayScoreData);
                //console.log(1)
            }
        });
        //showOwnerText($(this),2);
    });

    // 设置goback节点id
    $('.zxnode_list').on('click','.score_star .score_link,.score_star .modify_score,.node_backlink .comp_link_a', function(){
        setCookie('nodeids',$(this).parents('.zxnode_list').attr('id'));
    });
}

// 追评
function addRatings(ratingsNodeid) {

    var ratingsId = isNodeId[0][ratingsNodeid];
    ////console.log(ratingsNodeid,ratingsId)
    ////console.log(ratingsNodeid,urlordadeId,$('.critics_text_info').val(),ratingsId)
    $.ajax({
        type: "POST",
        url: "/index.php?m=wap&f=member_lognew&v=write_score",
        data:{
            'nodeid':ratingsNodeid,
            'orderid':urlordadeId,
            'additional':$('.critics_text_info').val(),
            'additional_num':1,
            'upda':2
        },
        dataType: "json",
        timeout: 3000,
        success: function (res) {
            //console.log(res)
            addratingsData = res.data;
            ownerAddDataStatus = 0;
            var ratingsTemp = $('#'+ratingsId).find('.owner_zhuip');
            //当前节点下模板
            solveTemplate(ratingsTemp,"#score_ratings_templete" , addratingsData);

            $('.critics_text').hide().find('.critics_text_info').val('');
            $('#'+ratingsId).find('.addratings').hide();
        },
        error: function (XMLHttpRequest, textStatus) {
            //console.log(XMLHttpRequest)
        }
    });
}

// 设置评论框title
function revisePlTitlt(arr){
    $.each(arr,function(index,ele){
        $(document).on('touchend', ele.plButton, function () {
            $('.critics_text_title').html(ele.plText);
            $('.critics_text_info').val(ele.textarea);
        });
    });
}

// 头部对比图
var spaceImgName = {
    'canting':'餐厅',
    'yangtai':'阳台',
    'shufang':'书房',
    'xuanguan':'玄关',
    'guodao':'过道',
    'ertongfang':'儿童房',
    'yimaojian':'衣帽间',
    'huayuan':'花园',
    'keting':'客厅',
    'woshi':'卧室',
    'chufang':'厨房',
    'weishengjian':'卫生间'
}

// 空间对比图切换
$('.newspace').on('tap','.sp_btnlist',function(){
   $(this).addClass('active').siblings('li').removeClass('active');
   $(this).parent().siblings('.spacebox').find('.nspace_mode').eq($(this).index()).show().siblings('.nspace_mode').hide();
});

/*
2.9 end
*/
$(function () {

    if($('header .header-title').html() == "工地直播"){
        getTitleMas();
        getNodeRes();
    }
    $("#favor-btn").bind("click", setFavorite);
    var zxnodeTltle = document.getElementsByClassName('zxnode_list_title');
    for (var i = 0; i < zxnodeTltle.length; i++) {
        //click 延迟处理
        FastClick.attach(zxnodeTltle[i]);
        zxnodeTltle[i].addEventListener('click', function (event) {
            var isMassage = $(this).parent().attr('ismassage');
            //节点未进行or数据未加载无操作
            if (!parseInt(isMassage) || NodeBok)return;

            var isCLass = $(this).parent().attr('class').search('slideDown');
            //节点内容展开收起状态
            if (isCLass < 0) {
                //内容展开
                var isLoad = $(this).parent().attr('isload');
                //数据嵌套入页面则显示否则嵌套
                if (isLoad == 0) {
                    //载入数据
                    //兄弟节点id
                    var ThisSiblingsId = $(this).siblings('.zxnode_list_cont').attr('id');
                    //载入数据
                    solveTemplate("#" + ThisSiblingsId, "#" + ThisSiblingsId + "-cont-template", siteNodeMas);
                    //图片适应
                    var ImgBox = $(this).parents('.zxnode_list').find(".pre_img img");
                    var watercontImg = $(this).parents('.zxnode_list').find(".water_cont img");
                    var CompanyImg = $(this).parents('.zxnode_list').find(".company_audit img");
                    var CompanyImgPz = $(this).parents('.zxnode_list').find(".company_imgboxcont img");
                    scaleImg(watercontImg);
                    scaleImg(ImgBox);
                    scaleImg(CompanyImg);
                    scaleImg(CompanyImgPz);
                    scaleImg($('.space_photo img'));
                    scaleImg($('.acc_contimg img'));

                    var nodeListId = ThisSiblingsId.substring(1, ThisSiblingsId.length);
                    //app delete node content
                    appDomContent(nodeListId);

                    //yeshushuo & pinglun $ pingfen

                    ownerSriticsScore(this,'see',ThisSiblingsId,this);


                    //是否加载状态
                    $(this).parent().attr('isload', 1);
                    //内容展开
                    $(this).parents('.zxnode_list').addClass('slideDown');
                } else if (isLoad == 1) {
                    //内容展开
                    $(this).parents('.zxnode_list').addClass('slideDown');
                }
            } else {
                //内容收起
                $(this).parents('.zxnode_list').removeClass('slideDown');
            }
        }, false);
    }

    // 2.9start
    //xie rizhi
    ownerText();
    // 2.9 end
    //验收整改sel
    $('.zxnode_list_cont').on('touchstart', '.water_minu', function () {
        var _thisClass = $(this).attr('class').search('water_minuon');
        if (_thisClass <= 0) {
            //内容展开
            $(this).addClass('water_minuon').parent().siblings('.water_cont').show();
        } else {
            //内容收起
            $(this).removeClass('water_minuon').parent().siblings('.water_cont').hide();
        }
    });

    //评论
    $(document).on('touchend', '.icon-pinglun,.discuss_title_r', function () {

        criticsBok = true;
        //$('.critics_text').show().addClass('animated fadeIn').removeClass('fadeOut').attr('ducshow', 1);
        //('.critics_text').css({'left':0}).addClass('animated fadeIn').removeClass('fadeOut').attr('ducshow', 1);
        $('.critics_text').show().attr('ducshow', 1);
        $('.critics_text .owner_textcont_num').hide();
        setScrollTop('.critics_text');
    });


    //pinglun anniu wenan
    revisePlTitlt(revisePlTextList);

    //关闭评论
    $('.critics_text .icon-error').on('touchend', function () {
        criticsBok = false;
        clearInterval(infoTextTimer);
        $('.critics_text_info').val('').blur();
        //$('.critics_text').hide().removeAttr('style').attr('ducshow', 0);
        //$('.critics_text').removeClass('fadeIn').removeAttr('style').attr('ducshow', 0);

        $('.critics_text').hide().attr('ducshow', 0);
        $('.icon-pinglun').removeClass('woshipinglunanniu');
        return false;
    });

    $('.critics_text').on('touchmove', function (e) {
        e.preventDefault();
        return false;
    });

    //文本框定位顶部
    $(document).on('touchstart', function () {
        var textshow = $('.critics_text').attr('ducshow');
        if (textshow == 1) {
            setScrollTop('.critics_text');
        }
    });

    $('.critics_text_info').on('focus', function () {
        infoTextTimer = setInterval(function () {
            ////console.log(1)
            var textshow = $('.critics_text').attr('ducshow');
            if (textshow == 1) {
                setScrollTop('.critics_text');
            }
        }, 50);
    });

    $('.critics_text_info').on('blur', function () {
        clearInterval(infoTextTimer);
    });

    //评论提交
    $(document).on('touchend', '.node_critics_text', function () {
        $('.critics_text .icon-right').attr({'stem': 1, 'nodeid': $(this).parents('.zxnode_list').attr('id')});
    });

    $(document).on('touchend', '.node_title_reply', function () {
        var thisNodeid = $(this).parents('.zxnode_list').attr('id');
        var thiscriticsid = $(this).parents('.discuss_text').find('.critics_report_massage .id_ss').val();
        $('.critics_text .icon-right').attr({'stem': 2, 'nodeid': thisNodeid, 'criticsid': thiscriticsid});
        $(this).addClass('woshipinglunanniu');
    });

    $(document).on('touchend', '.node_child_reply', function () {
        var massageData = $(this).parents('.discuss_text_answer').siblings('.critics_report_massage');
        massageData.find('.childid1').val($(this).parents('.discuss_answer_list').find('.childid1').val());
        massageData.find('.childname').val($(this).parents('.discuss_answer_list').find('.childname').val());
        $(this).addClass('woshipinglunanniu');
        $('.critics_text .icon-right').attr({'stem': 3, 'nodeid': $(this).parents('.zxnode_list').attr('id')});
    });

    //评论文本是否输入文字
    $('.critics_text_info').on('input', function () {
        var TextLength = $(this).val().length;
        if (TextLength > 0) {

            $('.critics_text_header .icon-right').css({"color": "#2bb1fa"});
        } else {
            $('.critics_text_header .icon-right').css({"color": "#cccccc"});
        }
        setScrollTop('.critics_text');
        clearInterval(infoTextTimer);
    });

    //提交评论
    $('.critics_text .icon-right').on('touchstart', function () {
        var textStem = $(this).attr('stem');
        var thisnode = $(this).attr('nodeid');
        if ($('.critics_text_info').val() == '')return;
        var reportMassage = $('#' + thisnode);
        var _this = $(this);
        var ThisSiblingsId = reportMassage.find('.zxnode_list_cont').attr('id');
        var discussButton = $('.woshipinglunanniu').parents('.discuss_cont_list');
        var discussSmall = $('.woshipinglunanniu').parents('.discuss_answer_list');
        var discuss = $('.woshipinglunanniu').parents('.discuss');
        switch (textStem) {
            case '1':
                criticsMode({
                    "orderid": urlordadeId,
                    "nodeid": reportMassage.find('.discuss_title .nodeid').val(),
                    "content": $('.critics_text_info').val(),
                    "reply": false
                }, function (res) {
                    ////console.log(res);
                    var discussPar = reportMassage.find('.discuss');
                    criticsAnimate(discussPar);
                    alertMassage("评论成功");
                    getMassageRes(function () {
                        //reportMassage.find('.discuss').remove();
                        reportMassage.find('.discuss').html('');
                        criticsDom(ThisSiblingsId, reportMassage.find('.zxnode_list_title'));
                    });

                });
                break;
            case '2':
                criticsMode({
                    "orderid": urlordadeId,
                    "nodeid": reportMassage.find('.critics_report_massage .nodeid').val(),
                    "content": $('.critics_text_info').val(),
                    "reply_name": discussButton.find('.critics_report_massage .namess').val(),
                    "parent_id": $(this).attr('criticsid'),
                    "first_id": $(this).attr('criticsid'),
                    "reply": true
                }, function (res) {
                    ////console.log(discussButton.find('.critics_report_massage .namess').val())
                    ////console.log(res);
                    alertMassage("评论成功");
                    ////console.log(reportMassage.find('.critics_report_massage .id_ss').val())
                    criticsAnimate(discuss);
                    getMassageRes(function () {
                        //reportMassage.find('.discuss').remove();.
                        reportMassage.find('.discuss').html('');
                        criticsDom(ThisSiblingsId, reportMassage.find('.zxnode_list_title'));
                    });
                });
                break;
            case '3':
                criticsMode({
                    "orderid": urlordadeId,
                    "nodeid": reportMassage.find('.critics_report_massage .nodeid').val(),
                    "content": $('.critics_text_info').val(),
                    "reply_name": discussSmall.find('.childnamelist').val(),
                    "parent_id": discussSmall.find('.critics_report_massagetwo .childid1').val(),//id
                    "first_id": discussButton.find('.critics_report_massage .id_ss').val(),//reportMassage.find('.critics_report_massage .id_ss').val()
                    "reply": true
                }, function (res) {
                    ////console.log(res);
                    alertMassage("评论成功");
                    criticsAnimate(discuss);
                    getMassageRes(function () {
                        //reportMassage.find('.discuss').remove();
                        reportMassage.find('.discuss').html('');
                        criticsDom(ThisSiblingsId, reportMassage.find('.zxnode_list_title'));
                    });
                });
                break;
        }
        return false;
    });

    //评论查看更多
    $(document).on('click', '.discuss_more', function () {
        var isLoad = $(this).parents('.zxnode_list').find('.critics_list_moretext').attr('isload');
        if (isLoad == 0) {
            criticsNum = isNodeId[1][$(this).parents('.zxnode_list').attr('id')];
            var TempBox = $(this).parents('.zxnode_list').find('.critics_list_moretext').attr('id');
            solveTemplate("#" + TempBox, "#critics-text-more", siteNodeMas);
            $(this).parents('.zxnode_list').find('.critics_list_moretext').attr('isload', 1);
            $(this).html("收起更多");

        } else {
            if ($(this).html() == "更多评论") {
                $(this).parents('.zxnode_list').find('.critics_list_moretext').show();
                $(this).html("收起更多");
            } else {
                $(this).parents('.zxnode_list').find('.critics_list_moretext').hide();
                $(this).html("更多评论");

                var _thisPost = getPos($(this).parents('.discuss').get(0));
                if (document.documentElement.scrollTop) {
                    document.documentElement.scrollTop = _thisPost.top;
                } else {
                    document.body.scrollTop = _thisPost.top;
                }
            }
        }

    });

    //所有进行节点展开收起
    var loadMoreImg = true;
    $('#slide-btn').on('click', function () {
        if (NodeBok)return;
        if (loadMoreImg) {
            loadMoreImg = false;
            $('<div class="loadMoreImg">前方多图预警，小心流量，慎重点开！</div>').appendTo('body');
            setTimeout(function () {
                $('.loadMoreImg').remove();
            }, 2000);

        } else {
            var isOpen = $(this).find('.iconfont').attr('class').search('icon-openbtn');
            if (isOpen < 0) {
                $(this).find('.iconfont').attr('class', 'iconfont icon-openbtn');
                $.each(LoadNoad, function (index, ele) {
                    $("#" + ele).removeClass('slideDown');
                });
            } else {

                $(this).find('.iconfont').attr('class', 'iconfont icon-closebtn');
                $.each(LoadNoad, function (index, ele) {
                    var eleLoad = $("#" + ele).attr('isload');
                    ////console.log(LoadNoad);
                    if (eleLoad == 0) {
                        solveTemplate("#s" + ele, "#s" + ele + "-cont-template", siteNodeMas);
                        var nowNodwImg = $("#" + ele).find('img');
                        scaleImg(nowNodwImg);
                        //最新节点评论dom
                        var newcriticsTit = $("#" + ele).find('.zxnode_list_title');
                        var Thissibstsid = "s" + ele;
                        //criticsDom(Thissibstsid, newcriticsTit);
                        ownerSriticsScore(isNodeId[1][ele],'load', Thissibstsid, newcriticsTit);
                        //已加载识别
                        $("#" + ele).attr('isload', 1);
                        //内容展开
                        $("#" + ele).addClass('slideDown');
                        // pingfen pinglun
                        ////console.log(isNodeId[1][ele]);

                    } else {
                        $("#" + ele).addClass('slideDown');
                    }

                });
            }
        }
    });

    //评论展开
    $(document).on('touchend', '.answer_text_sub', function () {
        var ThisSubText = $(this).attr('subtext');
        if (ThisSubText) {
            if (ThisSubText == 1) {
                $(this).html($(this).siblings('.answer_text_input').val());
                $(this).attr('subtext', 0)
            } else {
                $(this).html($(this).html().substring(0, 25) + '···');
                $(this).attr('subtext', 1)
            }

        }

    });

    //大图展示
    //验收项
    $('.zxnode_list').on('click', '.water .company_imgboxcont,.circuit .company_imgboxcont', function () {
        var isCheckChange = $(this).parents('.water_list').attr('class').search('water_list_zg');
        var _this = $(this);
        var ownNodeid = isNodeId[1][$(this).parents('.zxnode_list').attr('id')];
        ////console.log(isCheckChange);
        if (Math.abs(isCheckChange) != 1) {
            var ownIndex = $(this).parents('.water_zg_par').index();
            var ownzgliIndex = $(this).parents('.water_list_zgli').index();
            // //console.log(ownzgliIndex);
            $.each(siteNodeMas, function (index, ele) {
                if (ele.nodeid == ownNodeid) {
                    if (ele.nodeid == 27) {
                        var water = _this.parents('.water_ul').parent().attr('class').search('water');
                        if (water >= 0) {

                            if (ownzgliIndex == 0) {
                                ////console.log(ele.check_waterdetail.unqualifieds[ownIndex]);
                                alertImg1 = ele.check_waterdetail.unqualifieds[ownIndex].img_yses;
                            } else {
                                if (ele.check_waterdetail.unqualifieds[ownIndex].chan_Srcs.length > 0) {
                                    alertImg1 = ele.check_waterdetail.unqualifieds[ownIndex].chan_Srcss;
                                }
                            }
                        } else {
                            if (ownzgliIndex == 0) {
                                ////console.log(ele.check_detail.unqualified[ownIndex]);
                                alertImg1 = ele.check_detail.unqualified[ownIndex].img_yses;
                            } else {
                                if (ele.check_detail.unqualified[ownIndex].chan_Srcs.length > 0) {
                                    alertImg1 = ele.check_detail.unqualified[ownIndex].chan_Srcss;
                                }
                            }


                        }
                    } else {
                        if (ownzgliIndex == 0) {
                            ////console.log(ele.check_detail.unqualified[ownIndex]);
                            alertImg1 = ele.check_detail.unqualified[ownIndex].img_yses;
                        } else {
                            if (ele.check_detail.unqualified[ownIndex].chan_Srcs.length > 0) {
                                alertImg1 = ele.check_detail.unqualified[ownIndex].chan_Srcss;
                            }
                        }
                    }
                }
            });
            // //console.log(alertImg1);
            $('#big-pic-content')[0].innerHTML = '';
            solveTemplate("#big-pic-content", "#big-pic1-data", alertImg1);
            showBigPic(1);
        } else {
            var ownIndex = $(this).parents('li').index();
            ////console.log(2)
            $.each(siteNodeMas, function (index, ele) {
                if (ele.nodeid == ownNodeid) {
                    if (ele.nodeid == 27) {

                        var water = _this.parents('.water_ul').parent().attr('class').search('water');
                        ////console.log(ele)
                        if (water >= 0) {
                            if (ele.check_waterdetail.qualifieds) {
                                alertImg = ele.check_waterdetail.qualifieds;
                            }
                        } else {
                            if (ele.check_detail.qualified) {
                                alertImg = ele.check_detail.qualified;
                            }
                        }

                    } else {
                        if (ele.check_detail.qualified) {
                            alertImg = ele.check_detail.qualified;
                        }

                    }
                }
            });
            alertImg = alertImg[ownIndex];
            ////console.log(alertImg);
            $('#big-pic-content')[0].innerHTML = '';
            solveTemplate("#big-pic-content", "#big-pic-data", alertImg);
        }
        showBigPic(1);
    });

    //环保监测项
    $('.zxnode_list').on('click', '.auditing_stades .company_imgboxcont', function () {
        var ownNodeid = isNodeId[1][$(this).parents('.zxnode_list').attr('id')];
        var ownIndex = $(this).parents('li').index();
        $.each(siteNodeMas, function (index, ele) {
            if (ele.nodeid == ownNodeid) {
                if (ele.check_detail.qualified) {
                    alertImg = ele.check_detail.qualified;
                }

            }
        });
        alertImg = alertImg[ownIndex];
        ////console.log(alertImg);
        $('#big-pic-content')[0].innerHTML = '';
        solveTemplate("#big-pic-content", "#big-pic-data", alertImg);
        showBigPic(1);
    });

    //防水
    $('.zxnode_list').on('click', '#node10 .company_img_first', function () {
        var ownNodeid = isNodeId[1]['node10'];
        $.each(siteNodeMas, function (index, ele) {
            if (ele.nodeid == ownNodeid) {
                alertImg = ele.check_detail.closed_water[0];
            }
        });
        ////console.log(alertImg);
        $('#big-pic-content')[0].innerHTML = '';
        solveTemplate("#big-pic-content", "#big-pic-data", alertImg);
        showBigPic(1);
    });

    //报价审核
    $(document).on('click', '#node2 .company_pnoto_table', function () {
        var ownNodeid = isNodeId[1]['node2'];
        var iscont = $(this).attr('iscont');
        var ownindex = $(this).parents('.company_photo_parent').index();
        $.each(siteNodeMas, function (index, ele) {
            if (ele.nodeid == ownNodeid) {
                if (iscont == 0) {
                    alertImg1 = ele.company_photo[ownindex].quotes;
                } else {
                    alertImg1 = ele.company_photo[ownindex].design_photos;
                }

            }
        });
        ////console.log(alertImg1);
        $('#big-pic-content')[0].innerHTML = '';
        solveTemplate("#big-pic-content", "#big-pic1-data", alertImg1);
        showBigPic(1);
    });

    //审核报告
    $('.zxnode_list').on('click', '.company_audit_shenhe .company_img_list', function () {
        var ownNodeid = isNodeId[1]['node2'];
        var uId = $(this).attr('uid');
        if (uId == 0) {
            alertConfirm("登录后才能查看哦，去登录~");
            $("#confirm-layer").on('touchmove', function (event) {
                event.preventDefault();
            })
        } else {
            $.each(siteNodeMas, function (index, ele) {
                if (ele.nodeid == ownNodeid) {
                    alertImg1 = ele.bj_photos;
                }
            });
            ////console.log(alertImg1);
            $('#big-pic-content')[0].innerHTML = '';
            solveTemplate("#big-pic-content", "#big-pic1-data", alertImg1);
            showBigPic(1);
        }
    });

    //node photo
    $('.zxnode_list').on('click', '.pre_list', function () {
        var ownNodeid = isNodeId[1][$(this).parents('.zxnode_list').attr('id')];

        $.each(siteNodeMas, function (index, ele) {
            if (ele.nodeid == ownNodeid) {
                ////console.log(ele);
                alertImg1 = ele.photos;
            }
        });
        //console.log(alertImg1);

        $('#big-pic-content')[0].innerHTML = '';
        solveTemplate("#big-pic-content", "#big-pic1-data", alertImg1);
        showBigPic($(this).index() + 1);
    });

    $('.zxnode_list').on('click', '.water_cont a', function () {
        var nodeOffsetTop = $(this).parents('.zxnode_list').attr('id');
        setCookie("nodeids", nodeOffsetTop, 1);
    })

    //头部装修对比图
    $('.newspace').on('click','.nspaceimg',function(){
        var imgType = $(this).attr('type');
        var imgListtype = $(this).parents('.nspace_mode').attr('type');
        //console.log(imgListtype,imgType)
        // 查找对应节点json
        function lookUpImgData(_this){
            var lookData = siteMassages.comparison_photo;
            for(var i = 0;i<lookData.length;i++){
                if(lookData[i].title == imgListtype){
                    ////console.log(lookData[i])
                    return lookData[i];
                }
            }
        }
        //console.log(lookUpImgData($(this)))
        //console.log(imgType)
        alertImg1 = lookUpImgData($(this))[imgType];
        //console.log(alertImg1)
        $('#big-pic-content')[0].innerHTML = '';
        solveTemplate("#big-pic-content", "#big-pic1-data", alertImg1);

        // 显示图片空间名称
        var showPicData = {
            "big_attach1":"装修前",
            "big_attach2":"装修后"
        };
        var showPicTitle = spaceImgName[imgListtype]+'('+showPicData[imgType]+')';
        // //console.log(showPicTitle);
        showBigPic(1,showPicTitle);

    });

});
