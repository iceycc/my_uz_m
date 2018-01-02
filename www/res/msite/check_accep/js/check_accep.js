var ORDER_ID = getUrlParameter('orderid');
var NODE_ID = getUrlParameter('nodeid');
var LIDTDATA,alertImg1,alertImg;
function getWaitCheck(){
    $.ajax({
        type: "POST",
        url: "index.php?m=wap&f=online_pay_step&v=wait_check_info",
        data:{
            orderid:getUrlParameter('orderid'),
            nodeid:getUrlParameter('nodeid')
        },
        dataType: "json",
        timeout: 3000,
        success: function(data){
            //  未登录去登录页
            // if(data.code == 0){
            //     window.location.href="mobile-login.html?user_home=1";
            // }
            console.log(data);
            LIDTDATA = data.data;
            if(data.code != 0){
                $('.header-title').html(nodeConfig.nodeName[data.data.nodeid]);
                solveTemplate("#check-content", "#check-temp", data);
                var ImgBox = $('.pre_lists img');
                scaleImg($('.pre_lists img'));
                scaleImg($('.company_imgboxcont img'));
                scaleImg($('.space_photo img'));
                scaleImg($('.accp_money img'));
            }
        },
        error: function(XMLHttpRequest, textStatus){
            console.log('error');
        }
    });

}
var nodeConfig = {
    "nodeLogo":{
        "27": "icon-shuidianacc",
        "31": "icon-wamuacc",
        "35": "icon-youqiacc",
        "37": "icon-jungongacc"
    },
    "nodeName":{
        "27":"水电工程验收",
        "31":"瓦木工程验收",
        "35":"油漆工程验收",
        "37":"竣工验收"
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
                //console.log(boxW+'  '+boxH+' imgwidthheight '+imgW+'---'+imgH+' marginlefttop '+imgleft+'---'+imgtop);
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
            //console.log(getImgAttribute())

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

function sendWaitCheck() {
    $.ajax({
        type: "POST",
        url: "index.php?m=wap&f=member&v=through_accept",
        data:{
            orderid:ORDER_ID,
            nodeid:NODE_ID
        },
        dataType: "json",
        timeout: 3000,
        success: function(res){
            var data = res.data;
            console.log(data)

            if(!parseInt(res.code))return false;
            if(parseInt(data.next_step) == 1){
                //去支付
                console.log('zhifu');
                //console.log()
                window.location.href = "mobile-wait_pay.html?orderid="+ORDER_ID+"&nodeid="+NODE_ID+"&id="+data.id;
            }else{
                if(parseInt(data.next_step) != 2){
                    console.log('pingjia');
                    var scoreNodeArr = [37,35,31,27];

                    if(findInArr(NODE_ID, scoreNodeArr)){
                        operHref = "mobile-score.html?orderid="+ORDER_ID+"&nodeid="+NODE_ID+'&gosoure=3';
                    }else{
                        operHref = 'mobile-user_home.html';
                    }
                    window.location.href = operHref;
                }else{
                    window.location.href = 'mobile-user_home.html';
                }

            }


        },
        error: function(XMLHttpRequest, textStatus){
            console.log('error');
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
        event.preventDefault();
        return false;
    });
}

//18612623334
$(function () {
    getWaitCheck();

    $('.check_acc').on('click','#accp_submit',function () {
        sendWaitCheck();
    });

    //验收整改sel
    $('.check_acc').on('touchstart', '.water_minu', function () {
        var _thisClass = $(this).attr('class').search('water_minuon');
        if (_thisClass <= 0) {
            //内容展开
            $(this).addClass('water_minuon').parent().siblings('.water_cont').show();
        } else {
            //内容收起
            $(this).removeClass('water_minuon').parent().siblings('.water_cont').hide();
        }
    });

    //node photo
    $('.check_acc').on('click', '.pre_lists', function () {
        var ownNodeid = LIDTDATA.nodeid;

        alertImg1 = LIDTDATA.photos;

        console.log(alertImg1);

        $('#big-pic-content')[0].innerHTML = '';
        solveTemplate("#big-pic-content", "#big-pic1-data", alertImg1);
        showBigPic($(this).index() + 1);
    });
    //大图展示
    //验收项
    $('.check_acc').on('click', '.water .company_imgboxcont,.circuit .company_imgboxcont', function () {
        var isCheckChange = $(this).parents('.water_list').attr('class').search('water_list_zg');
        var _this = $(this);
        var ownNodeid = LIDTDATA.nodeid;
        //console.log(isCheckChange);
        if (Math.abs(isCheckChange) != 1) {
            var ownIndex = $(this).parents('.water_zg_par').index();
            var ownzgliIndex = $(this).parents('.water_list_zgli').index();
            // console.log(ownzgliIndex);
            var ele = LIDTDATA;
            if (ele.nodeid == 27) {
                var water = _this.parents('.water_ul').parent().attr('class').search('water');
                if (water >= 0) {

                    if (ownzgliIndex == 0) {
                        //console.log(ele.check_waterdetail.unqualifieds[ownIndex]);
                        alertImg1 = ele.check_waterdetail.unqualifieds[ownIndex].img_yses;
                    } else {
                        if (ele.check_waterdetail.unqualifieds[ownIndex].chan_Srcs.length > 0) {
                            alertImg1 = ele.check_waterdetail.unqualifieds[ownIndex].chan_Srcss;
                        }
                    }
                } else {
                    if (ownzgliIndex == 0) {
                        //console.log(ele.check_detail.unqualified[ownIndex]);
                        alertImg1 = ele.check_detail.unqualified[ownIndex].img_yses;
                    } else {
                        if (ele.check_detail.unqualified[ownIndex].chan_Srcs.length > 0) {
                            alertImg1 = ele.check_detail.unqualified[ownIndex].chan_Srcss;
                        }
                    }


                }
            } else {
                if (ownzgliIndex == 0) {
                    //console.log(ele.check_detail.unqualified[ownIndex]);
                    alertImg1 = ele.check_detail.unqualified[ownIndex].img_yses;
                } else {
                    if (ele.check_detail.unqualified[ownIndex].chan_Srcs.length > 0) {
                        alertImg1 = ele.check_detail.unqualified[ownIndex].chan_Srcss;
                    }
                }
            }
            // console.log(alertImg1);
            $('#big-pic-content')[0].innerHTML = '';
            solveTemplate("#big-pic-content", "#big-pic1-data", alertImg1);
            showBigPic();
        } else {
            var ownIndex = $(this).parents('li').index();
            //console.log(2)
            var ele = LIDTDATA;
            if (ele.nodeid == 27) {

                var water = _this.parents('.water_ul').parent().attr('class').search('water');
                //console.log(ele)
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

            alertImg = alertImg[ownIndex];
            //console.log(alertImg);
            $('#big-pic-content')[0].innerHTML = '';
            solveTemplate("#big-pic-content", "#big-pic-data", alertImg);
        }
        showBigPic();
    });

    //预交底 and 竣工验收 and 上门量房 //空间照片
    $('.check_acc').on('click', '.yujiaodi_space .space_photo_boxpar,.jungong_space .space_photo_boxpar', function () {
        var ownNodeid = LIDTDATA.nodeid;
        var ownIndex =  $(this).parents('.space_photo_list').index();
        var ele = LIDTDATA;
        if (ele.nodeid == ownNodeid) {
            alertImg = ele.check_other;
        }
        alertImg = alertImg[ownIndex];
        //console.log(alertImg);
        $('#big-pic-content')[0].innerHTML = '';
        solveTemplate("#big-pic-content", "#big-pic-data", alertImg);
        showBigPic();
    });

    $('.check_acc').on('click', '.acc_contimg', function () {
        var ele = LIDTDATA;
        if (ele.extrapay_info.extrapay_photo) {
            alertImg1 = ele.extrapay_info.extrapay_photos;
        }
        //alertImg = alertImg[ownIndex];
        //console.log(alertImg);
        $('#big-pic-content')[0].innerHTML = '';
        solveTemplate("#big-pic-content", "#big-pic1-data", alertImg1);
        showBigPic(0);
    });

});