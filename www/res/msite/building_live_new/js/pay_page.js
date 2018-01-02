var nodeLogo = {
    "10": "iconfont icon-yuyueliangfangs",
    "11": "iconfont icon-liangfang",
    "12": "iconfont icon-dingdanshenhes",
    "15": "iconfont icon-yixiangdingjins",
    "17": "iconfont icon-yujiaodiss",
    "19": "iconfont icon-qiandingsanfanghetongs",
    "21": "iconfont icon-kaigongyishis",
    "25": "iconfont icon-shuidianyanshous",
    "27": "iconfont icon-shuidiangcyanshous",
    "29": "iconfont icon-wamuyanshous",
    "28": "iconfont icon-fangshuigcyanshous",
    "31": "iconfont icon-wamugongchengyanshous",
    "33": "iconfont icon-youqicailiaoyanshous",
    "35": "iconfont icon-youqiyanshous",
    "36": "iconfont icon-anzhuangyanshous",
    "37": "iconfont icon-jungongs",
    "39": "iconfont icon-huanbaojiances",
    "45": "iconfont icon-weibaoss",
    "43": "iconfont icon-dablebaojiances",
    "49": "iconfont icon-huanbaozhiliss",
    "51": "iconfont icon-huanbaozhilifuces",
    "1": "iconfont icon-dingdanshenhes",
    "2": "iconfont icon-jingxuangongsis",
    "9": "iconfont icon-zhidingguanjias",
    "101": "iconfont icon-yuyuejianmian",
    "102": "iconfont icon-jianmian"
}
var order_id = getUrlParameter('order_id');

$(function () {
    var listPayData;
    function getPayInfo() {
        $.ajax({
            type: 'GET',
            url: 'index.php?m=wap&f=member_lognew&v=pay_list&order_id=' + order_id,
            dataType: 'json',
            timeout: 3000,
            success: function (res) {
                //console.log(res)
                if (res.code == 0) {
                    var p = '<p style="text-align: center;padding-top: 3rem;font-size: 0.875rem;">' + res.message + '</p>';
                    $('#pay-box').append(p);
                }
                if (res.code == 1) {
                    var data = res.data;
                    listPayData = data.pay_list;
                    $('.header-title').html('支付进度（<span id="node-num">' + data.molecule + '</span>/' + data.denominator + '）');
                    solveTemplate("#pay_content", "#pay-data", data);

                    $('.blue-active').last().css('border-color', '#d8d8d8');

                }
            },
            error: function (XMLHttpRequest) {
                //console.log('error');
            }
        });
    };


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

    function payRecord(ID,fn) {
        $.ajax({
            type: "POST",
            url: "index.php?m=wap&f=member_lognew&v=get_online_pay_detail&id="+ID,
            dataType: "json",
            timeout: 3000,
            success: function(data){
                //console.log(data)
                if(data.code != 0)return false;
                $('.pay_record_lodding').hide();
                fn&&fn(data);
            },
            error: function(err){
                $('.pay_record_lodding').hide();
                //console.log(err);
            }
        });
    }


    getPayInfo();
    $('#pay_content').on('click', '.go_pay', function () {
        var bindex = $(this).attr('bIndex');
        var dindex = $(this).attr('dIndex');
        var sendParams = listPayData[bindex].detail[dindex].params;

        var operHref;
        var scoreNodeArr = [37,35,31,27];

        if(findInArr(sendParams.nodeid, scoreNodeArr)){
            operHref = 'mobile-score.html?orderid='+sendParams.orderid+'&nodeid='+sendParams.nodeid+'&gosoure=1';
        }else{
            operHref = 'mobile-pay_page.html?order_id='+sendParams.orderid;
        }
        sendParams.url_return = operHref;

        var ModifyPayMoney = $(this).parents('.pay_contlist').find('.modify_pay_money').val();
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

    //c查看支付详情
    $('#pay_content').on('click','.pay_record_title',function () {
        // lode state
        var lodeState = $(this).attr('data-load-state');
        //toggle state
        var states = $(this).attr('data-states');
        var _this = $(this);
        //toggle
        if(states == 1){
            _this.attr('data-states',0);
            _this.parent().find('.pay_record_cont').addClass('active');
        }else{
            _this.attr('data-states',1);
            _this.parent().find('.pay_record_cont').removeClass('active');
        }
        //是否已加载
        if(lodeState == 0)return false;
        //加载动画显示
        $(this).parent().find('.pay_record_lodding').show();
        // 明细id
        var payRecordId = $(this).attr('data-massage-id');
        //明细请求
        payRecord(payRecordId,function (data) {
            //明细容器
            var recordContent = _this.parent().find('.pay_re_list');
            //console.log(states)
            solveTemplate(recordContent, "#pay-record-template", data);
            //识别已加载
            _this.attr('data-load-state',0);
        });


    });
});