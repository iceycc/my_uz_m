var siteNodeMas,
    siteMassages = {},
    ismysite = 1,
    butlerTitTop,
    infoTextTimer,
    listPayData,
    urlordadeId = GetQueryString("live_id")?GetQueryString("live_id"):GetQueryString("id");

var dataPayTitleName = {
    "company":"签订公司：",
    "contactno":"合同编号：",
    "totalpay":"合同总金额：",
    "designno":"设计协议编号：",
    "designpay":"设计协议总金额："
}
//节点详情
function getMySiteNodeRes() {
    $.ajax({
        type: "POST",
        url: "/index.php?m=wap&f=member_lognew&v=detail&orderid=" + urlordadeId,
        dataType: "json",
        timeout: 6000,
        success: function (res) {
            if (!res.code)return;
            siteNodeMas = res.data;
            //console.log(res);
            NodeBok = false;
            siteNodeMas.URLordadeId = urlordadeId;
            $.each(siteNodeMas, function (index, ele) {
               if(ele.nodeid == 2){
                   ////console.log(ele);
                   $('#node22 .zxnode_list_title .zxnodestatus .companySize').html(ele.company.length);
               }
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

deleteHeader();
//头部信息 节点时间
function getMySiteTitleRes(fn) {
    $.ajax({
        type: "POST",
        url: "/index.php?m=wap&f=member_lognew&v=log&orderid=" + urlordadeId,
        dataType: "json",
        timeout: 6000,
        success: function (res) {
            if (res.code == 1){
                siteMassages = res.data;
                //console.log(res);
                siteMassages.titleOrderid = urlordadeId;
                if ($('header .header-title').html() == "工地直播") {
                    solveTemplate("#site-title-mas", "#butler-info-template", siteMassages);
                    deleteHeader();
                } else {
                    solveTemplate("#mysite_title", "#mysite-title-templete", siteMassages);
                    solveTemplate("#mysite_titlelink", "#mysite-titlelink-templete", siteMassages);
                    // 对比图
                    solveTemplate("#space_img", "#space-img-template", siteMassages);
                    scaleImg($("#space_img img"));
                    // 获取管家导航条高度 注：其他执行完之后获取
                    butlerTitTop = getPos($('.company_ul .musite_butler')[0]).top;
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

                ////console.log(nodeArray);
                if (res.data.collectstatus == 1) {
                    $('#favor-btn .iconfont').attr('class', 'iconfont icon-star_two');
                } else {
                    $('#favor-btn .iconfont').attr('class', 'iconfont icon-star_one');
                }

                //<span class="node_title_gain">巡检巡检</span>
                var inspection = res.data.check_nodes;
                $.each(inspection,function (index,ele) {
                    var nodeTitle = '#'+isNodeId[0][ele];
                    $(nodeTitle).find('.zxnode_list_title').append($('<span class="node_title_gain">巡检巡检</span>'));
                });

                //节点详情是否加载完成
                //中间未进行节点删除
                if(nodeTimeres.length > 0){
                    searchNodeId(siteMassages);
                }
                // if(nodeArray.length > 0) {
                //     if (ListNodeTest('node1', 'node5', nodeArray) && !findInArr(10, nodeArray)) {
                //         $('.zxnode_start').eq(1).remove();
                //         //if (ListNodeTest('node16', 'node15', nodeArray)) {
                //         //    $('.zxnode_march').eq(0).remove();
                //         //}
                //     }
                // }

                var ajaxTimer = setInterval(function () {

                    if (NodeBok)return;
                    fn&&fn();
                    clearInterval(ajaxTimer);
                    var oldNode = isNodeId[1][getCookie('nodeids')];

                    if(oldNode){
                        //see more go back
                        var underway = oldNode;
                        nodeMasLoads(underway,siteNodeMas,230);
                    }else if(newStemNodeid){
                        //news get info
                        nodeMasLoads(newStemNodeid,siteNodeMas,300);
                    }else{
                        //default
                        var underway = res.data.max_logname.nodeid;
                        ////console.log(underway,siteNodeMas)
                        nodeMasLoads(underway,siteNodeMas,230);
                    }
                }, 100);

            }else{
                //console.log(res);
                alertOpen(res.message);
            }
        },
        error: function (XMLHttpRequest, textStatus) {
            if (textStatus == "timeout") {
                reLoad("body");
            }
        }
    });
}

/*
 **	getListPayData 		获取支付or验收信息
 ** 	params
 */
function getListPayData(NODEID){
    $.ajax({
        type: "POST",
        url: "index.php?m=wap&f=online_pay_step&v=list_check_pay&orderid="+urlordadeId,
        dataType: "json",
        timeout: 3000,
        success: function(data){
            //console.log(data);
            listPayData = data.data;
            //点击验收后操作
            if(NODEID){
                showTip('确认验收成功');
            }
            solveTemplate('#payment_mode_'+isNodeId[0][ownerSayScoreData.NODEID], "#payment_mode_templete", listPayData);
            scaleImg($('.acc_contimg img'));
        },
        error: function(XMLHttpRequest, textStatus){
            //console.log('error');
        }
    });
}

/*
* zhifu
* */
//验收
function sendAccp(NODEID) {
    $.ajax({
        type: "POST",
        url: "index.php?m=wap&f=member&v=through_accept",
        data:{
            orderid:urlordadeId,
            nodeid:NODEID
        },
        dataType: "json",
        timeout: 3000,
        success: function(data){
            //console.log(data);
            getListPayData(NODEID);
        },
        error: function(XMLHttpRequest, textStatus){
            //console.log('error');
        }
    });
}
// 支付
function sendPay(params,fn) {
    $.ajax({
        type: "POST",
        url: "index.php?m=llpay&f=llpay&v=pay",
        data:params,
        dataType: "json",
        timeout: 3000,
        success: function(data){
            //console.log(data);
            if(!parseInt(data.code)){
                alertOpen(data.message);
                $('.pay_button input').val('去支付').removeAttr('disabled').css('opacity',1);
            }else{
                window.location.href = data.data.go_url;
            }
            fn&&fn();
        },
        error: function(err){
            //console.log(err);
        }
    });
}


$(function () {

    getMySiteNodeRes();
    getMySiteTitleRes(function () {
        //支付列表信息
        getListPayData();
        //console.log(1)
    });

    $(window).on('scroll', function () {
        var headerHeight = $('header').height();
        var winScrollTop;
        if (document.documentElement.scrollTop) {
            winScrollTop = document.documentElement.scrollTop;
        } else {
            winScrollTop = document.body.scrollTop;
        }
        if (winScrollTop + headerHeight > butlerTitTop) {
            $('.musite_butler_dable').show();
            $('.company_ul .musite_butler').css({'top': headerHeight, "position": "fixed"});
        } else {
            $('.musite_butler_dable').hide();
            $('.company_ul .musite_butler').css({'top': 0, "position": "relative"});
        }
    });


    //预交底 and 竣工验收 and 上门量房 //空间照片
    $('.zxnode_list').on('click', '.yujiaodi_space .space_photo_boxpar,.jungong_space .space_photo_boxpar', function () {
        var ownNodeid = isNodeId[1][$(this).parents('.zxnode_list').attr('id')];
        var ownIndex =  $(this).parents('.space_photo_list').index();
        $.each(siteNodeMas, function (index, ele) {
            if (ele.nodeid == ownNodeid) {
                alertImg = ele.check_other;
            }
        });
        alertImg = alertImg[ownIndex];
        ////console.log(alertImg);
        $('#big-pic-content')[0].innerHTML = '';
        solveTemplate("#big-pic-content", "#big-pic-data", alertImg);
        showBigPic(1);
    });

    //签订意向合同
    $('.zxnode_list').on('click', '#node5 .company_imgboxcont', function () {
        $.each(siteNodeMas, function (index, ele) {
            if (ele.nodeid == 19) {
                alertImg1 = ele.pz_photos;
            }
        });
        ////console.log(alertImg);
        $('#big-pic-content')[0].innerHTML = '';
        solveTemplate("#big-pic-content", "#big-pic1-data", alertImg1);
        showBigPic(1);
    });


    //验收
    $('.zxnode').on('click', '#accp_submit', function () {
        var Index = $(this).attr('Index');
        var accpNodeId = listPayData[Index].nodeid;
        ownerSayScoreData.NODEID = accpNodeId;
        // if(parseInt(accpNodeId) == 37){
        //     showTip('确认验收成功');
        // }else{
            sendAccp(accpNodeId);
        //}

        ////console.log(isNodeId[0][accpNodeId]);
    });
    //支付
    $('.zxnode').on('click', '.pay_nodeSubmit', function () {
        var bindex = $(this).attr('bIndex');
        var dindex = $(this).attr('dIndex');
        var sendParams = listPayData[bindex].pay_info[dindex].params;
        var _this = $(this);

        var operHref;
        var scoreNodeArr = [37,35,31,27];

        if(findInArr(sendParams.nodeid, scoreNodeArr)){
            operHref = 'mobile-score.html?orderid='+sendParams.orderid+'&nodeid='+sendParams.nodeid+'&gosoure=2';;
        }else{
            operHref = 'mobile-mysite.html?live_id='+sendParams.orderid;
        }
        sendParams.url_return = operHref;// window.location.href;

        var ModifyPayMoney = $(this).parents('.pay_node').find('.modify_pay_money').val();
        if(checkPayumber(ModifyPayMoney)){
            return false;
        }
        if(ModifyPayMoney && ModifyPayMoney != ''){
            sendParams.money = ModifyPayMoney.replace(/\s/g,"");
        }
        //console.log(sendParams);
        sendPay(sendParams);
        $(this).val('正在支付请稍后..').attr('disabled',true).css('opacity',0.6);
    });


    $('.zxnode').on('click', '.acc_contimg', function () {
        var nodeID = $(this).attr('nodeid');
        $.each(listPayData, function (index, ele) {
            //console.log(ele,nodeID)
            if (ele.nodeid == parseInt(nodeID)) {

                alertImg1 = ele.check_info.photos;
                //console.log(alertImg1)
            }
        });
        //console.log(alertImg1);
        $('#big-pic-content')[0].innerHTML = '';
        solveTemplate("#big-pic-content", "#big-pic1-data", alertImg1);
        showBigPic(1);
    });

});
