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
    swiper1.slideNext();
}

function singup() {
    checkForm();

    /*    util.sendSingUp(function () {
            document.getElementsByClassName('sing_name')[0].value = '';
            document.getElementsByClassName('sing_telphone')[0].value = '';
            document.getElementsByClassName('city_sel')[0].value = 0;
        });*/
}

function checkForm() {
    //检测性别
    if (document.getElementById('sex-female').className.indexOf('btn-selected') === -1 && document.getElementById('sex-male').className.indexOf('btn-selected') === -1) {
        showTip("请选择性别");
        return false;
    }

    //检测验证码
    var smscode = $('.smscode').val();
    if (!smscode) {
        showTip("请输入验证码");
        return false;
    }

    //检测地址
    var address = $('.address').val();
    if (address) {
        var reg = /^[a-zA-Z0-9\u4e00-\u9fa5]+$/;
        if (!reg.test(address)) {
            showTip("您的小区名有误请重新输入");
            return false;
        }
    }

    //检测房屋面积输入
    var area = $('.area').val();

    if (!util.isPositiveInteger(area)) {
        showTip("房屋面积为正整数请重新输入");
        return false;
    }

    //检测预算金额输入
    var budget = $('.budget').val();
    if (!util.isPositiveInteger(budget)) {
        showTip("预算金额为正整数请重新输入");
        return false;
    }

    return true;
}

/**
 * 发送验证码
 */
function sendCode() {
    if (util.checkPhone()) {
        console.log('获取验证码');
    }
}

function selectBtn(ele) {
    var style = 'btn btn-unselected';

    ele.className = 'btn btn-selected';

    if (ele.id === 'sex-male') {
        document.getElementById('sex-female').className = style;
    } else if (ele.id === 'sex-female') {
        document.getElementById('sex-male').className = style;
    } else if (ele.id === 'housecategory-new') {
        document.getElementById('housecategory-old').className = style;
    } else if (ele.id === 'housecategory-old') {
        document.getElementById('housecategory-new').className = style;
    }
}