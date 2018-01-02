var util = {};

util.isPositiveInteger = function (value) {
    var reg = /^\+?[1-9][0-9]*$/;
    return reg.test(value) ;
}

util.checkPhone = function () {
    var singPhone = $('.sing_telphone').val(),
        regPhone = /^1[3|4|5|7|8|9][0-9]\d{8}$/;

    if (singPhone.trim() === '') {
        showTip("请输入您的电话");
        $('.sing_telphone ').focus();
        return false;
    }
    if (!regPhone.test(singPhone)) {
        showTip("您的电话有误请重新输入");
        $('.sing_telphone ').focus();
        return false;
    }

    return true;
};

/**
 * 检测报名框
 * sing_name 用户名
 * sing_telphone 电话号码
 * sing_city 所在城市
 * @returns {boolean}
 */
util.checkSingUpForm = function () {
    var singName = $('.sing_name').val(),
        regName = /^[\u4E00-\u9FA5]+$/;

    if (singName.trim() === '') {
        showTip("请输入您的姓名");
        $('.sing_name ').focus();
        return false;
    }
    if (!regName.test(singName)) {
        showTip("请输入中文名");
        $('.sing_name ').focus();
        return false;
    }
    if (!util.checkPhone()) {
        return false;
    }

    if ($('.city_sel').val() === 0) {
        showTip("请选择您的所在城市");
        $('.city_sel ').focus();
        return false;
    }
    return true;

};

util.sendSingUp = function (callback) {
    if (!util.checkSingUpForm()) {
        return false;
    }

    var source = util.getQueryString('source');
    var cid_id = util.getQueryString('cid_id');
    var cid_city_id = util.getQueryString('cid_city_id');
    var cid_comp_id = util.getQueryString('cid_comp_id');
    var cid_act_id = util.getQueryString('cid_act_id');
/*    if (!source)
        source = 'M站-管家式装修页';*/

    var data = {
        "source": source,
        "cid_id": cid_id,
        "cid_city_id": cid_city_id,
        "cid_comp_id": cid_comp_id,
        "cid_act_id": cid_act_id,
        "title": $('.sing_name ').val(),
        "telephone": $('.sing_telphone ').val(),
        "areaid": $('.city_sel ').val()
    };
    $.ajax({
        type: "get",
        url: "/api/mmwap.php?action=fbform",
        //url: "/api/lottery.php?action=attend_prom",
        data: data,
        dataType: "json",
        timeout: 10000,
        success: function (data) {
            if (data.flag) {
                $('.sing_name,.sing_telphone').val('');
                alertOpen(data.msg);
            } else {
                $('.sing_name,.sing_telphone').val('');
                alertOpen(data.msg);
            }
        },
        error: function (XMLHttpRequest, textStatus) {
            //console.log(XMLHttpRequest);
        }
    });
};

util.isMobile = function () {
    var browser_class = navigator.userAgent;

    if (browser_class.match("Mobile") || browser_class.match("mobile"))
        return true;

    return false;
};


util.getQueryString = function (name) {
    var reg = new RegExp("(^|&)" + name + "=([^&]*)(&|$)");
    var r = window.location.search.substr(1).match(reg);
    console.log(r);
    if (r != null) return decodeURI(r[2]);
    return null;
};