function getLottery(){
    var ORDERID = successOrderid ? successOrderid : getCookie("orderid");
    if(!ORDERID){
        alertOpen('请先报名再参加抽奖哦!');
        return false;
    }
    $.ajax({
        type: "POST",
        url: "api/lottery.php?action=lucky_prom&order="+ORDERID,
        dataType: "json",
        timeout: 3000,
        success: function (data) {
            console.log(data);
            if(!data.errno){
                var str = '您已成功抽奖！我们将于7月16日14:00开奖并短信通知您抽奖结果';
                alertOpen(str);
            }else{
                alertOpen(data.msg);
            }

        },
        error: function (XMLHttpRequest, textStatus) {
            console.log(XMLHttpRequest);
        }
    });
}
$(function(){
    $('.lottery_submit').on('click',getLottery);
});