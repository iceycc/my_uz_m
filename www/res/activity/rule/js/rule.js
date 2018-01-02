function silder() {

    var swiper = new Swiper('.swiper-container', {
        autoHeight: true, //enable auto height,
        loop:true,
        spaceBetween: 20,
        pagination: {
            el: '.swiper-pagination',
            clickable: true,
        },
        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
        }
    });
    var minuName = ['<b>返现规则</b>','<b>邀请人奖励</b>','<b>邀请好友奖励规则</b>'];
    $('.swiper-pagination-bullet').each(function (index,el) {
        $(this).html(minuName[index]);
    });
}
$(function(){
    silder();
});