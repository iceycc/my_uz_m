function recommendInfo(JSON) {
    JSON = JSON || {};
    var ApplyNum,
        UID = getCookie('tj_id');

    // 1 推荐返现状态 ==> 推荐别人 // 2 分享朋友打开状态 ==>  自己报名
    JSON.direction = JSON.direction || 1;

    var checkForm = {
        "title": '',
        "mobile": '',
        "smscode": '',
        "sex": '',
        "areaid_2": ''
    }
    var checkChoice = {
        "address": '',
        "housecategory": '',
        "area": '',
        "budget": ''
    }
    if (JSON.direction == 2) {
        delete checkForm.smscode;
        $('.if_smscode').remove();
    }
    //get Application number
    function getApplyNum() {
        $.ajax({
            type: "POST",
            url: "index.php?m=zx_recommended&f=index&v=index_status",
            dataType: "json",
            timeout: 3000,
            success: function (data) {
                //console.log(data);
                ApplyNum = data.data.count;
                (!ApplyNum) && ($('.if_sub').attr('disabled', true).addClass('is_disa'));
                $('.numtim .nt_number').html(data.data.count);
            },
            error: function (XMLHttpRequest, textStatus) {
                //console.log(textStatus);
            }
        });
    }

    //test option binding
    function optionForm(ele, json, fn) {
        //console.log(json)
        $(ele).each(function () {
            var states = $(this).attr('states');
            var input = $(this);
            //console.log(states)
            Object.defineProperty(json, states, {
                configurable: true,
                get: function () {
                    return input[0].value
                },
                set: function (newValue) {
                    input[0].value = newValue;
                }
            });
            $(this).change(function () {
                fn && fn(json, states);
            });
        });
    }

    //Important test
    function testForm() {

        var formStates = true;
        $.each(checkForm, function (ele, index) {
            if (checkForm[ele] == 0) {
                formStates = false;
                return false;
            } else if (checkForm[ele] == '') {
                formStates = false;
                return false;
            }

        });
        //return formStates;
        if (formStates) {
            $('.if_sub').removeAttr('disabled').removeClass('is_disa');
            return true;
        } else {
            $('.if_sub').attr('disabled', true).addClass('is_disa');
        }
    }

    //test import is right
    function testImport() {
        var importStates = false;
        $.each(checkForm, function (ele, index) {
            importStates = false;
            switch (ele) {
                case "title":
                    var text = $('.info_import input[states=title]').val();
                    var reg = /^[\u4E00-\u9FA5]+$/;
                    if (!reg.test(text)) {
                        showTip("您的姓名有误请重新输入");
                        $('.info_import input[states=title]').focus();
                        return false;
                    } else {
                        importStates = true;
                        return true;
                    }
                    break;
                case "mobile":
                    var text = $('.info_import input[states=mobile]').val();
                    var reg = /^1[3|4|5|7|8|9][0-9]\d{8}$/;
                    if (!reg.test(text)) {
                        showTip("您的电话有误请重新输入");
                        $('.info_import input[states=mobile]').focus();
                        return false;
                    } else {
                        importStates = true;
                        return true;
                    }
                    break;
                case "smscode":
                    var text = $('.smscode').val();
                    if (text == '') {
                        showTip("请输入验证码");
                    } else {
                        importStates = true;
                        return true;
                    }
                    break;
                case "sex":
                    var text = $('.info_import input[states=sex]').val();
                    if (text == '') {
                        showTip("请选择性别");
                    } else {
                        importStates = true;
                        return true;
                    }
                    break;
                case "areaid_2":
                    var text = $('#select-01').val();
                    if (text == 0) {
                        showTip("请选择城市");
                    } else {
                        importStates = true;
                        return true;
                    }
                    break;

            }
        });
        return importStates;
    }

    //test Choice complete and right
    function testChoice() {
        var status = 40;
        var qualifiedState = true;
        $.each(checkChoice, function (ele, index) {
            if (checkChoice[ele] == '') {
                status -= 10;
            } else {
                switch (ele) {
                    case "address":
                        var text = $('.info_Choice input[states=address]').val();
                        var reg = /^[a-zA-Z0-9\u4e00-\u9fa5]+$/;
                        if (!reg.test(text)) {
                            showTip("您的小区名有误请重新输入");
                            $('.info_Choice input[states=address]').focus();
                            qualifiedState = false;
                            return false;
                        }
                        break;
                    case "area":
                        var text = $('.info_Choice input[states=area]').val();
                        var reg = /^\+?[1-9][0-9]*$/;
                        if (!reg.test(text)) {
                            showTip("房屋面积为正整数请重新输入");
                            $('.info_import input[states=area]').focus();
                            qualifiedState = false;
                            return false;
                        }
                        break;
                    case "budget":
                        var text = $('.info_Choice input[states=budget]').val();
                        var reg = /^\+?[1-9][0-9]*$/;
                        if (!reg.test(text)) {
                            showTip("预算金额为正整数请重新输入");
                            $('.info_import input[states=budget]').focus();
                            qualifiedState = false;
                            return false;
                        }
                        break;
                }
            }
        });
        return {
            state:status,
            error:qualifiedState
        };
    }

    //concat jsondata
    function concatData() {
        var data = {};
        for (var name in checkForm) {
            data[name] = checkForm[name];
        }
        for (var name in checkChoice) {
            data[name] = checkChoice[name];
        }
        data.status = testChoice().state;

        // uid
        // var UID = getCookie('tj_id');
        // if(UID != '' && direction == 1){
        //     data.uid = UID;
        // }
        // 邀请码
        var ICODE = getUrlParameter('icode');
        if (ICODE && JSON.direction == 2) {

            data.icode = ICODE;
        }

        return data;
    }

    //removeData
    function resetStateData() {
        for (var name in checkForm) {
            checkForm[name] = '';
        }
        for (var name in checkChoice) {
            checkChoice[name] = '';
        }
        $('.if_sub ').addClass('is_disa').attr('disabled', 'disabled');
        $('.if_states input.textmass').val('');
        $('.if_states select').val(0);
        $('.sexno_minu').removeClass('sex_active');
    }

    //add flow image
    function flowImage() {
        var flowBox = '<section class="flowimg"><div class="flow_box"><i class="flow_close iconfont icon-shanchu1"></i></div></section>';
        $('body .flowimg').remove();
        $('body').append(flowBox);
        $('.flowimg').on('touchmove', function () {
            return false;
        });
        $('.flow_close').on('click', function () {
            $(this).parents('.flowimg').remove();
        });
    }

    //send Form data
    function sendMassage(sendData) {
        $.ajax({
            type: "POST",
            url: "index.php?m=zx_recommended&f=index&v=index",
            data: sendData,
            dataType: "json",
            timeout: 3000,
            success: function (data) {
                if (data.code == 1) {
                    showTip(data.message);
                    return false;
                }
                //console.log(data);

                // reset data
                resetStateData();

                // get apply number
                getApplyNum();

                // show success alert image
                flowImage();

            },
            error: function (XMLHttpRequest, textStatus) {
                //console.log(textStatus);
            }
        });
    }

    //send massage data
    function sendUsaData() {

        if (!UID && JSON.direction == 1) {
            alertConfirm({
                "str": "登录后才能推荐",
                "right": "确定",
                "error": "取消",
                "url": "activity-login.html?favored=1"
            });
            return false;
        }
        var importStatus = testImport();
        if (!importStatus)return false;
        var choiceState = testChoice().error;
        if(!choiceState)return false;
        var choiceEmpty = testChoice().state;
        var sendData = concatData();
        if (choiceEmpty == 40) {
            concatData();
            sendMassage(sendData);
        } else {

            var getMoney = 60 + sendData.status;
            alertConfirm({
                "str": '若量房成功，您将获得<span class="color_org">' + getMoney + '元</span>鼓励金填写完整信息，最高可获得<span class="color_org">100元</span>返现',
                "right": '<span class="color_org">确认推荐</span>',
                "error": '<span class="color_999">继续填写</span>',
                "success": function () {
                    sendMassage(sendData);
                }
            });
        }

    }

    //Button timer
    function setTimer() {
        var send_btn = $(".smsminu");
        send_btn.addClass("waiting").attr('disabled', 'disabled');
        var t = 60;
        var changeTime = function () {
            send_btn.val(t + "s秒后重新获取");
            t--;
            if (t < 0) {
                send_btn.removeClass("waiting").removeAttr('disabled');
                send_btn.val("发送短信验证码");
                return;
            }
            btnTimer = setTimeout(changeTime, 1000);
        };
        changeTime();
    }

    // send sms code
    function sendSmsCode() {
        testLogIn();
        var text = $('.info_import input[states=mobile]').val();
        var reg = /^1[3|4|5|7|8|9][0-9]\d{8}$/;
        if (text == '') {
            showTip("请输入电话");
            $('.info_import input[states=mobile]').focus();
            return false;
        } else if (!reg.test(text)) {
            showTip("您的电话有误请重新输入");
            $('.info_import input[states=mobile]').focus();
            return false;
        }
        $.ajax({
            type: "POST",
            url: "index.php?m=sms&f=sms&v=sendsms_v2&status=1&mobile=" + text,
            dataType: "json",
            timeout: 3000,
            success: function (data) {
                if(data.code == 0) {
                    //console.log("验证码发送成功");
                    setTimer();
                } else if(data=='202') {
                    showTip('图片验证码错误！');
                    $("#checkcode").focus();
                } else {
                    showTip(data.message);
                }
            },
            error: function (XMLHttpRequest, textStatus) {
                //console.log(textStatus);
            }
        });
    }

    // weixin alert tishi
    function alertWeixinMask() {
        if (!browser.versions.weixin)return false;
        // 延迟显示提示分享弹层
        setTimeout(function () {
            $('body').append('<div class="alert_mask"><div class="alert_mask_close"></div></div>');
            $('.alert_mask_close').on('click', function () {
                $(this).parent().remove();
                headerArrow();
            });
        }, 5000)

        // header gif arrow
        function headerArrow() {
            $('header').append('<img class="header_arrow" src="./res/activity/index/img/arrow.gif">');
            var headerArrowTimer = setTimeout(function () {
                $('header .header_arrow').remove();
            }, 15000);

            $('body').on('touchstart', function () {
                clearTimeout(headerArrowTimer);
                $('header .header_arrow').remove();
                $('body').off('touchstart');
            });
        }


    }


    $(function () {

        //Application number
        getApplyNum();

        //必填项 前四项
        optionForm('.info_import .textmass', checkForm, function (json, states) {
            //判断资料是否完成
            testForm();
        });

        //选填项后四项
        optionForm('.info_Choice .textmass', checkChoice, function (json, states) {
            if (!ApplyNum)return false;
        });

        // set sexs & old or new
        $('.sexno_minu').on('click', function () {
            var states = $(this).attr('statesnum');
            $(this).parents('li').find('input[type=hidden]').val(states);
            $(this).addClass('sex_active').siblings().removeClass('sex_active');
            if ($(this).parents('li').attr('option') == 1) {
                testForm();
            }
        });

        // send massage
        $('.if_sub').on('click', sendUsaData);

        // set select color
        $('.textmass').on('change', function () {
            if ($(this).val() != 0) {
                $(this).css('color', '#333');
            } else {
                $(this).css('color', '#999');
            }
        });

        //semd sms code
        $('.smsminu').on('click', sendSmsCode);

        // header mine minu


        // 弹层提示
        if (JSON.direction == 1) {
            alertWeixinMask();
        }
    });

}
