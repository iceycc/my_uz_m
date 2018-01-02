// login page 2015-12-1 Xushu
$(function () {
    $("#login-btn").bind("click", userLogin);
    var check = setTimeout(checkLogin, 1000);
    getWeiboLink();
    lgoinByQQ();

    // Login in by weixin
    $("#wx-passport").bind('click', function () {
        $(this).attr("href", "/index.php?m=third_login&f=weixin&v=weixin_login_url");
    });

    /*
     *		新增短信登录
     */
    //切换登录窗口
    tebleLog();
    //点击登录
    $("#login-masbtn").bind("click", CheckMassageLogIn);
    //发送验证码
    $("#sent-message").bind("click", sentMessage);
});
var user_home = getUrlParameter("user_home");
function userLogin() {
    var user_id = $("#user-name").val();
    var user_pwd = $("#pwd").val();
    var ck_ph = checkPhone(user_id);
    var ck_pwd = checkPwd(user_pwd);
    if (ck_ph == true && ck_pwd == true) {
        var save = '';
        if (free_login.checked == true) {
            var save = "&savecookie=savecookie";
        }
        $.ajax({
            type: "POST",
            url: "index.php?m=wap&f=password&v=login",
            data: 'username=' + user_id + '&password=' + user_pwd + save,
            dataType: "json",
            success: function (data) {
                if (data.code == 1) {
                    //login Success
                    if (user_home && user_home == 1) {
                        window.location.href = "mobile-user_home.html";
                    }
                    else {
                        var favored = getUrlParameter("favored");
                        if (favored == 1) {
                            window.location.href = document.referrer;
                        }
                        else {
                            goBack();
                        }
                    }
                }
                else {
                    alertOpen(data.message);
                }
            },
            error: function (XMLHttpRequest, textStatus, errorThrown) {
                console.log(XMLHttpRequest.status);
                console.log(XMLHttpRequest.readyState);
                console.log(textStatus);
            }
        })
    }
}
//show Tips
function collectShow(str) {
    var tip_box = '<div id="showBox"><span id="showInfo"></span></div>';
    if ($('#showBox')) {
        $('#showBox').remove();
    }
    $(tip_box).appendTo("body");
    $('#showInfo').html(str);
    setTimeout(function () {
        $('#showBox').show();
        setTimeout(function () {
            $('#showBox').hide();
        }, 2000);
    }, 1);
}
//Check login
function checkLogin() {
    var username = getCookie('NDb__uid');
    if (username != null && username != "") {
        collectShow("您已登录");
        setTimeout(function () {
            goBack();
        }, 1000);
    }
}
//Get login address by weibo
function getWeiboLink() {
    $.ajax({
        type: "POST",
        url: "index.php?m=third_login&f=sina&v=sina_login",
        dataType: "json",
        timeout: 3000,
        success: function (data) {
            if (data.code == 1) {
                var weibolink = data.data;
                $("#weibo-passport").attr("href", weibolink);
            }
            else {
                setTimeout(getWeiboLink, 1000);
            }
        },
        error: function (XMLHttpRequest, textStatus) {
            setTimeout(getWeiboLink, 1000);
        }
    });
}

// Login in by QQ
function lgoinByQQ() {
    $.ajax({
        type: "POST",
        url: "/index.php?m=third_login&f=QQ&v=qq_login_url",
        dataType: "json",
        timeout: 3000,
        success: function (res) {
            console.log(res)
            if (res.code == 1) {
                var QQLink = res.data;
                $("#qq-passport").attr("href", QQLink);
            } else {
                setTimeout(lgoinByQQ, 1000);
            }
        },
        error: function (XMLHttpRequest, textStatus) {
            setTimeout(lgoinByQQ, 1000);
        }
    });
}

// Login in by weixin
// function lgoinByWx() {
// 	$.ajax({
// 		type: "POST",
// 		url: "/index.php?m=third_login&f=weixin&v=callback",
// 		dataType: "json",
// 		timeout: 3000,
// 		success: function(res) {
// 			console.log(res)
// 			if(res.code == 1) {
// 				var wxLink = res.data;
// 				$("#wx-passport").attr("href", wxLink);
// 			} else {
// 				setTimeout(lgoinByWx, 1000);
// 			}
// 		},
// 		error: function(XMLHttpRequest, textStatus) {
// 			setTimeout(lgoinByWx, 1000);
// 		}
// 	});
// }

/*
 *		登录切换
 */
function tebleLog() {
    $('.paslist_btn').on('click', function () {
        var logInfo = $(this).parents('.container').find('.log_silder .log_info');
        $(this).hide().siblings('.paslist_btn').show();
        logInfo.eq($(this).index()).addClass('active').siblings('.log_info').removeClass('active');
    });
}
/*
 *		登录验证
 */
function CheckMassageLogIn() {
    // 电话
    var user_phone = checkFormPhone($("#phone-number").val());
    if (!user_phone) {
        $("#phone-number").focus();
        return false;
    }

    //验证码格式
    var captCha_number = captCha($("#phone-code").val());
    if (!captCha_number) {
        $("#phone-code").focus();
        return false;
    }

    PhoneLogIn();
    //return true;
}

/*
 *		验证码格式验证
 */
function sentMessage() {

    var user_phone = checkFormPhone($("#phone-number").val());
    if (!user_phone) {
        $("#phone-number").focus();
        return false;
    } else {
        // 按钮倒计时样式
        var mobile = $("#phone-number").val();
        getMessageReport(mobile);
    }

}
/*
 *		获取验证码
 */
function getMessageReport(mobile) {
    $.ajax({
        type: "POST",
        url: "/index.php?m=sms&f=sms&v=sendsmscheck&mobile=" + mobile,
        dataType: "json",
        timeout: 3000,
        success: function (res) {
            console.log(res);
            if (!res.code) {
                // 按钮倒计时
                new countButtonDown({
                    el: '#sent-message'
                });
            } else {
                alertOpen(res.message)
            }
        },
        error: function (XMLHttpRequest, textStatus) {
            console.log(textStatus);
        }
    });
}

/*
 *		短信登录
 */
function PhoneLogIn() {
    var savecookie = $('#frees_loginsave').prop('checked');
    var saveCode;
    savecookie ? saveCode = '&savecookie=savecookie' : saveCode = '';
    $.ajax({
        type: "get",
        url: "index.php?m=wap&f=password&v=smslogin"+saveCode,
        dataType: "json",
        timeout: 3000,
        data: {
            mobile: $("#phone-number").val().trim(),
            smscode: $("#phone-code").val().trim()
        },
        success: function (data) {
            console.log(data);
            if (!data.code) {
                //login Success
                if (user_home && user_home == 1) {
                    window.location.href = "mobile-user_home.html";
                }
                else {
                    var favored = getUrlParameter("favored");
                    if (favored == 1) {
                        window.location.href = document.referrer;
                    }
                    else {
                        goBack();
                    }
                }
            }
            else {
                alertOpen(data.message);
            }
        },
        error: function (XMLHttpRequest, textStatus) {
            console.log(textStatus);
        }
    });
}