// wushi 2017-03-08 edit

$(function () {
    var codeFlag = getUrlParameter("icode");
    //console.log(codeFlag);
    if (codeFlag == "" || codeFlag == null) {
        $("#code").focus(function () {
            $("#codeInfo").html("");
        });

        $("#code").bind("blur", function () {
            var codeTxt = $("#code").val();
            if (codeTxt == "") {
                $("#codeInfo").html("若有邀请人请填写他的邀请码");
            }
        });
    }else {
        $("#code").val(codeFlag);
        $("#codeInfo").html("");
    }

    $("#loginBtn").bind("click", function () {
        checkTel("loginRequest");
    });

    $("#regBtn").bind("click", function () {
        checkTel("regRequest");
    });

    $("#msgBtn").bind("click", function () {
        checkTel("msgRequest");
    });

    $("#tel,#msgWord").bind("keyup", function () {
        changeForm();
    });

    //sing up img code
    imgcode();

    testLogIn({
        success:function () {
            window.location.href = 'activity-index_main.html';
        }
    });

});

//
function changeForm() {
    var tempState = false;
    var tempOb = {
        telChange: $("#tel").val(),
        msgChange: $("#msgWord").val()
    }
    $.each(tempOb, function (key, value) {
        if (value == "" || value == 0) {
            tempState = false;
            return false;
        }
        else {
            tempState = true;
        }
    });
    if (tempState) {
        $(".btn").removeClass("opa7").removeAttr("disabled");
    }
    else {
        $(".btn").addClass("opa7").attr("disabled", true);
    }
}


//getMsgTel
function getMsgTel(telNum) {
    $.ajax({
        type: "POST",
        url: "index.php?m=sms&f=sms&v=sendsms_v2",
        data: {
            'mobile' : telNum,
            'code':$('#img_code_in').val()
        },
        dataType: "json",
        timeout: 3000,
        success: function (data) {
            if(data.code == 0) {
                //console.log("验证码发送成功");
                timer();
            } else if(data=='202') {
                showTip('图片验证码错误！');
                $("#checkcode").focus();
            } else {
                showTip(data.message);
            }
        },
        error: function (XMLHttpRequest, textStatus) {
            if (textStatus == "timeout") {
                reLoad("body");
            }
        }
    });
}


//sendLogin
function sendLogin(telNum, msgNum) {
    $.ajax({
        type: "POST",
        url: "index.php?m=zx_recommended&f=password&v=login",
        data: {
            "mobile": telNum,
            "smscode": msgNum
        },
        dataType: "json",
        timeout: 3000,
        success: function (data) {
            if (data.code == 0) {
                alertTip(data.code, data.message);
            }

            if (data.code == 1) {
                alertTip(data.code, data.message);
                setTimeout(urlFn, 2000);
            }
        },
        error: function (XMLHttpRequest, textStatus) {
            if (textStatus == "timeout") {
                reLoad("body");
            }
        }
    });
}

//sendReg
function sendReg(telNum, msgNum, codeNum) {
    $.ajax({
        type: "POST",
        url: "index.php?m=zx_recommended&f=password&v=register",
        data: {
            "mobile": telNum,
            "smscode": msgNum,
            "rcode": codeNum
        },
        dataType: "json",
        timeout: 3000,
        success: function (data) {

            if (data.code == 0) {
                alertTip(data.code, data.message);
            }

            if (data.code == 1) {
                alertTip(data.code, data.message);
                setTimeout(urlFn, 2000);
            }
        },
        error: function (XMLHttpRequest, textStatus) {
            if (textStatus == "timeout") {
                reLoad("body");
            }
        }
    });
}

//
function timer() {
    $(".time").show();
    $(".txt").html("重新发送");
    $("#msgBtn").unbind("click");
    $("#msgBtn").addClass('disabled').attr('disabled','disabled');
    var i = 60;
    timeCounter();
    function timeCounter() {
        if (i > 0) {
            $("#time").html(i);
            i = i - 1;
            var tempT = setTimeout(timeCounter, 1000);
        }
        else {
            $(".txt").html("发送验证码");
            $("#time").html("");
            $("#msgBtn").bind("click", function () {
                checkTel("msgRequest")
            });
            $("#msgBtn").removeClass('disabled').removeAttr('disabled');
            $(".time").hide();
            clearTimeout(tempT);
        }
    }

}

//
function checkTel(flag) {
    var tempFlag = flag;
    var tempTel = $("#tel").val();

    if (tempTel == "") {
        showTip("请输入手机号");
        return false;
    }

    var tel = /^1[3|4|5|7|8|9][0-9]\d{8}$/;
    if (!tel.test(tempTel)) {
        showTip("您输入的手机号格式不正确");
        return false;
    }
    if($('#img_code_in').val() == ""){
        showTip("请输入图片验证码");
        return false;
    }

    if (tempFlag == "msgRequest") {
        getMsgTel(tempTel);
        //console.log("发送验证码行数开始执行");
    }
    if (tempFlag == "loginRequest") {
        checkMsgWord(tempFlag);
        //console.log("登录，接着验证:验证码");
    }
    if (tempFlag == "regRequest") {
        checkMsgWord(tempFlag);
        //console.log("注册,接着验证:验证码");
    }

}

//
function checkMsgWord(flag) {
    var tempFlag = flag;
    var tempTel = $("#tel").val();
    var tempMsg = $("#msgWord").val();
    var tempCode = $("#code").val();
    if (tempMsg == "") {

        showTip("请输入验证码");
        return false;

    }
    if (tempMsg !== "" && tempFlag == "loginRequest") {
        sendLogin(tempTel, tempMsg);
        ////console.log("发送登录信息函数");

    }
    if (tempMsg !== "" && tempFlag == "regRequest") {
        sendReg(tempTel, tempMsg, tempCode);
        ////console.log("发送注册信息函数");
    }
}

//alertDiv 
function alertTip(tempCode, str) {
    var tempClass;
    if (tempCode == 0) {
        var tempClass = "alertDiv fail";
    }
    else {
        var tempClass = "alertDiv success";
    }
    var alertTip = '<div class="' + tempClass + '" id="alertTip"><span class="img"></span><p class="desc" id="noticeDesc"></p><p class="bg"></p></div>';
    $(alertTip).appendTo("body");
    $('#noticeDesc').html(str);
    setTimeout(function () {
        $('#alertTip').addClass('on');
        setTimeout(function () {
            $('#alertTip').removeClass('on');

        }, 2000);
    }, 1);

}

//
function urlFn() {
    var openUrl;
    var backUrlState = getUrlParameter('favored');
    if(backUrlState == 1){
        openUrl = 'activity-userhome.html';
    }else{
        openUrl = "activity-index_main.html";
    }

    window.location.href = openUrl;
}

//
function getUrlRequest() {
    var url = location.search;
    var Request = new Object();
    if (url.indexOf("?") != -1) {
        var str = url.substr(1)　//去掉?号
        strs = str.split("&");
        for (var i = 0; i < strs.length; i++) {
            Request[strs[i].split("=")[0]] = unescape(strs[i].split("=")[1]);
        }
    }
    return Request["icode"]
}

//sing up img code
function imgcode() {
    var src = './index.php?m=core&f=identifying_code&w=112&h=40&o='+Math.random();
    $('#img_code img').attr('src',src);
    $('#img_code img').on('touchstart',function () {
        var src = './index.php?m=core&f=identifying_code&w=112&h=40&o='+Math.random();
        $(this).attr('src',src);
    });
}