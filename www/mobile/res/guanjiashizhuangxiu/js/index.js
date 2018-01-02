var swiper1;

var url = encodeURIComponent(window.location.href.split("#")[0]);
wxShare(url, "gjszx", 0);

function pageLoad() {
    $('#city_sel').loadProvince();
    swiper1 = new Swiper('.swiper-container-v', {
        lazyLoading: true,
        lazyLoadingInPrevNext: true,
        direction: 'vertical',
        touchRatio: 0.8,
        touchAngle: 30,
        onSlideChangeEnd: function (swiper) {
            if (swiper.activeIndex === 2) {
                new CountUp(document.getElementById('money'), 2.00, 2.430, 3, 2).start();
            } else if (swiper.slides.length - 1 === swiper.activeIndex) {
                document.getElementById('indicator').style.display = 'none';
            } else {
                document.getElementById('indicator').style.display = 'inherit';
            }
        }
    });
    var option = {
        lazyLoading: true,
        lazyLoadingOnTransitionStart: true,
        loop: true,
        loopAdditionalSlides: 1,
        lazyLoadingInPrevNext: true,
        initialSlide: 1,
        slidesPerView: 'auto',
        centeredSlides: true,
        spaceBetween: 0
    };

    var swiperh1 = new Swiper('.sh1', option);
    var swiperh2 = new Swiper('.sh2', option);
};

function next() {
    if (swiper1.activeIndex !== 0) {
        swiper1.slideNext();
    }
}

function quickto() {
    swiper1.slideTo(swiper1.slides.length, 1000);
}

function singup() {
    util.sendSingUp(function () {
        document.getElementsByClassName('sing_name')[0].value = '';
        document.getElementsByClassName('sing_telphone')[0].value = '';
        document.getElementsByClassName('city_sel')[0].value = 0;
    });
}