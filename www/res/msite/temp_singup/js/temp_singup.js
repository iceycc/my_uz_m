//Get sing up number

// 2017-06-08 根据产品需求删除已报名人数
// function getSingUpNum() {
//     $.ajax({
//         type: "POST",
//         url: "api/six.php?action=fbcount",
//         dataType: "json",
//         timeout: 3000,
//         success: function (data) {
//             //console.log(data);
//             data && $('.singup_num').html(data);
//         },
//         error: function (XMLHttpRequest, textStatus) {
//             console.log(XMLHttpRequest);
//         }
//     });
// }
var urlSource = getCookie("source");
// checkMassage
function checkSingUpForm() {
    var singName = $('.sing_name input').val(),
        singPhone = $('.sing_phone input').val(),
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
        $('.sing_phone input').focus();
        return false;
    }
    if (!regPhone.test(singPhone)) {
        showTip("您的电话有误请重新输入");
        $('.sing_phone input').focus();
        return false;
    }
    else {
        return true;
    }

}

// send sing up massage
function sendSingUpData(DATA) {
    $.ajax({
        type: "POST",
        url: "api/six.php?action=fbform",
        data: DATA,
        dataType: "json",
        timeout: 3000,
        success: function (data) {
            console.log(data);
            alertSingState(data.msg);
        },
        error: function (XMLHttpRequest, textStatus) {
            console.log(XMLHttpRequest);
        }
    });
}

//Alert Layer
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
$(function () {
    //get sing up num
    //getSingUpNum();
    $('.singup_submit').on('click', function () {
        var COMPANYID = getUrlParameter('companyid');
        var singUpText = {
            'source': '618activity',
            'title': $('.sing_name input').val(),
            'telephone': $('.sing_phone input').val(),
            'source':urlSource
        }
        //console.log(COMPANYID)
        if(COMPANYID){
            singUpText['company_id'] = COMPANYID;
        }
        //console.log(singUpText);
        if (checkSingUpForm()) {
            //console.log(singUpText);
            //console.log('send')
            sendSingUpData(singUpText);
        }
    });
});