
function checkSingUpForm() {
    var singName = $('.sing_name input').val(),
        singPhone = $('.sing_telphone input').val(),
        regName = /^[\u4E00-\u9FA5]+$/,
        regPhone = /^1[3|4|5|7|8|9][0-9]\d{8}$/;

    if (singName.trim() == '') {
        showTip("请输入您的姓名");
        $('.sing_name input').focus();
        return false;
    }
    if (!regName.test(singName)) {
        showTip("请输入中文名");
        $('.sing_name input').focus();
        return false;
    }
    if (singPhone.trim() == '') {
        showTip("请输入您的电话");
        $('.sing_telphone input').focus();
        return false;
    }
    if (!regPhone.test(singPhone)) {
        showTip("您的电话有误请重新输入");
        $('.sing_telphone input').focus();
        return false;
    }

    if(cityId == ''){
        if($('#city_sel').val() == 0){
            showTip("请选择您的所在城市");
            $('.sing_city #city_sel').focus();
            return false;
        }else{
            return true;
        }
    }
    else {
        return true;
    }

}

function alertSingState(str) {
    var alert_tag = '<section id="alert-layer"><div id="layer-content"><p id="alert-con"></p><p class="auto-close"><span id="close-time">5</span>s后自动关闭</p><span id="layer-close" class="iconfont icon-close"></span></div></section>';
    if ($("#alert-layer")) {
        $("#alert-layer").remove();
    }
    $(alert_tag).appendTo("body");
    $("#alert-layer").height(docH);
    $("#alert-con").html(str);
    var timer = setTimeout(alertClose, 1000);

    function alertClose() {
        var t = $("#close-time").html();
        t--;
        if (t > 0) {
            $("#close-time").html(t);
            setTimeout(alertClose, 1000);
        }
        else {
            $("#alert-layer").remove();
            clearTimeout(timer);
            $('.sing_text').val('');
            goBack();
        }
    }

    $("#layer-close").bind("click", function () {
        $("#alert-layer").remove();
        $('.sing_text').val('');
        goBack();
    });
}


//send sing up massage
function sendSingUpMas(DATA) {
    $.ajax({
        type: "POST",
        url: "api/lottery.php?action=attend_prom",
        data: DATA,
        dataType: "json",
        timeout: 3000,
        success: function (data) {

            //console.log(data);
            //alertSingState(data.msg);

            if (data.errno == 0) {
                var alertStr = '<span style=" color:#E07D1A;font-size: 22px;">报名成功！</span><br/><br/>您的装修申请已经提交，<br/>客服会在2小时内联系您,<br/>请您保持手机畅通'
                $('.sing_name input,.sing_telphone input').val('');
                successOrderid = data.data.orderid;
                setCookie('orderid',data.data.orderid);
                alertOpen(alertStr);
            } else {
                $('.sing_name input,.sing_telphone input').val('');
                alertOpen(data.msg);
            }
        },
        error: function (XMLHttpRequest, textStatus) {
            //console.log(XMLHttpRequest);
        }
    });
}

//默认城市设置
function citySel() {
    if(cityId != ''){
        // 有默认城市
        $('.sing_city').remove();
    }else{
        // 无默认城市
    }
}


var successOrderid;
var cityId = getCookie("cityid");

$(function () {
    var urlSource = getCookie("source_new");

    $('.singup_submit').on('click', function () {
        //console.log(checkSingUpForm())
        if (!checkSingUpForm())return false;

        //console.log(1)
        var DATAMAS = {
            "name": $('.sing_name input').val(),
            "phone": $('.sing_telphone input').val(),
            "source": urlSource
        }
        if(cityId == ''){
            DATAMAS.city =  $('.sing_city #city_sel').val();
        }else{
            DATAMAS.city = cityId;
        }
        ////console.log(DATAMAS)
        sendSingUpMas(DATAMAS);
    });

    citySel();
});