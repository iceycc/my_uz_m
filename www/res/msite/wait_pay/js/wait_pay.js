


var dataTeName = {
    "company":"签订公司：",
    "contactno":"合同编号：",
    "totalpay":"合同总金额：",
    "designno":"设计协议编号：",
    "designpay":"设计协议总金额：",
    "contactmoney":"合同款：",
    "extrapay":"增减项：",
    "wait_pay_money":"待支付："
}

$(function () {
    var paramsData;
    function getWaitPay(){
        $.ajax({
            type: "POST",
            url: "index.php?m=wap&f=online_pay_step&v=wait_pay_info",
            data:{
                orderid:getUrlParameter('orderid'),
                nodeid:getUrlParameter('nodeid'),
                id:getUrlParameter('id')
            },
            dataType: "json",
            timeout: 3000,
            success: function(data){
                //console.log(data);
                paramsData = data.data.params;
                solveTemplate("#pay_node", "#pay-node-template", data);
            },
            error: function(XMLHttpRequest, textStatus){
                //console.log('error');
            }
        });

    }
    // function sendPay(params,fn) {
    //     $.ajax({
    //         type: "POST",
    //         url: "index.php?m=llpay&f=llpay&v=pay",
    //         data:params,
    //         dataType: "json",
    //         timeout: 3000,
    //         success: function(data){
    //             //console.log(data);
    //             window.location.href = data.data.go_url;
    //             fn&&fn();
    //         },
    //         error: function(err){
    //             //console.log(err);
    //         }
    //     });
    // }
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
                console.log(err);
            }
        });
    }







    getWaitPay();
    $('.pay_node').on('click','.pay_nodeSubmit', function () {

        var operHref;
        var scoreNodeArr = [37,35,31,27];

        if(findInArr(paramsData.nodeid, scoreNodeArr)){
            operHref = 'mobile-score.html?orderid='+paramsData.orderid+'&nodeid='+paramsData.nodeid+'&gosoure=3';
        }else{
            operHref = 'mobile-user_home.html';
        }
        paramsData.url_return = operHref;// window.location.href;

        var ModifyPayMoney = $(this).parents('.pay_node').find('.modify_pay_money').val();
        if(checkPayumber(ModifyPayMoney)){
            return false;
        }
        if(ModifyPayMoney && ModifyPayMoney != ''){
            paramsData.money = ModifyPayMoney.replace(/\s/g,"");
            console.log(paramsData);
        }
        //console.log(paramsData);
        sendPay(paramsData);
        $(this).val('正在支付请稍后..').attr('disabled',true).css('opacity',0.6);
    });
});