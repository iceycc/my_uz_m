var lotteryData;

function getLottery(ID) {
    $.ajax({
        type: "POST",
        url: "api/lottery.php?action=lucky_list&id="+ID,
        dataType: "json",
        timeout: 3000,
        success: function (res) {
            //console.log(res);
            lotteryData = res.list;
            $('.header_text').html(res.award)
            solveTemplate('#prize-list', '#prize-temp', lotteryData);
            lotteryListMove();
        },
        error: function (XMLHttpRequest, textStatus) {
            console.log(XMLHttpRequest);
        }
    });
}

//lottery list move
function lotteryListMove(){
    $('.sel_cont').kxbdSuperMarquee({
        isMarquee: true,
        isEqual: false,
        loop: 0,
        scrollAmount: 1,
        direction: 'up',
        scrollDelay: 30,
        time: 0
    });
}


$(function () {
    //获取中奖数据
    var pageid = getUrlParameter('id');
    getLottery(pageid);
});