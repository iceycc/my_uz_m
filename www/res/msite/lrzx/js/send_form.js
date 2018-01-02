// Xushu Edit 2015-11-03
//判断设备
var device;
var app;
if(browser.versions.iPhone || browser.versions.iPad) {
	device = "apple";
}
if(browser.versions.android) {
	device = "android";
}

//测试是否为微信
function isWeiXin(){
    var ua = window.navigator.userAgent.toLowerCase();
    if(ua.match(/MicroMessenger/i) == 'micromessenger'){
        return true;
    }else{
        return false;
    }
}
//测试是否为微博
function isWeiBo() {
	var ua = window.navigator.userAgent.toLowerCase();
	if(ua.indexOf('weibo') > -1) {
		return true;
	}
}
function getPerson(){
	$.ajax({
		type: "GET",
		url: "api/wap.php?action=fbcount",
		dataType: "text",
		success: function(number){
			if(number){
				$('#userTotal').text(number);
			}
		},
		error: function(){
        	alert('您当前网络异常');
        }
	});
}
var w_h = $(window).height();
var w_w = $(window).width();
var d_h = $(document).height();
var wxCue = '<p id="tip"><i class="tip-icon"></i><span id="tip-con"></span></p>';
$(function(){
	getPerson();
	//底部提交按钮显示隐藏
	$("#free-btn").hide("fast");
	$(document).scroll(function() {
		var scroll_top = document.body.scrollTop;
		var btn_top_show = $('.btn-top-show').offset().top;
		if(scroll_top > btn_top_show)
		{
			$("#free-btn").show("fast");
		}
		else {
			$("#free-btn").hide("fast");
		}
	});

	//顶部红色提示条
	function showInfo(el, childel, msg){
		$('#' + childel).html(msg);
	    $('#' + el).addClass('show');
		if(device == "apple")
		{
			$('#' + el).addClass("ios");
			$('#' + el).css({top: managerPage.scrollTop});
			$(window).scroll(function(){
				$('#' + el).css({top: managerPage.scrollTop});
			});
		}
	    setTimeout(function(){
	        $('#' + el).removeClass('show');
	    }, 2000);
	}
	// //输入框上部提示语
	function inputTip(el, str) {
		$("#tip").remove();
		$(wxCue).appendTo("#" + el);
		$("#tip-con").html(str);
		setTimeout(function(){
			$("#tip").remove();
		},2000);
	}
	//输入框检测
	function checkName(name, errorel, errorchildel, namebox){
		if($("#" + name).val()=='') {
			if(isWeiXin() || isWeiBo()){
				inputTip(namebox, '您的姓名不能为空');
			}
			else {
				showInfo(errorel, errorchildel, '您的姓名不能为空');
			}
            $("#" + name).focus();
            return false;
        }
        var reg = /^[\u4E00-\u9FA5]+$/;
	    var userName = $("#" + name).val();
	    if (!reg.test(userName)) {
			if(isWeiXin() || isWeiBo()){
				inputTip(namebox, '请填写中文姓名');
			}
			else {
				showInfo(errorel, errorchildel, '请填写中文姓名');
			}
	        $("#" + name).focus();
	        return false;
	    }
		if($("#" + name).val().replace(/[^x00-xff]/g,"**").length>20) {
			if(isWeiXin() || isWeiBo()){
				inputTip(namebox, '您的称呼保持在10个字以内');
			}
			else {
				showInfo(errorel, errorchildel, '您的称呼保持在10个字以内');
			}
			$("#" + name).focus();
			return false;
		}
	}
	function checkPhone(telephone, errorel, errorchildel, phonebox){
		if($("#" + telephone).val()=='') {
			if(isWeiXin() || isWeiBo()){
				inputTip(phonebox, '请填写电话');
			}
			else {
				showInfo(errorel, errorchildel, '请填写电话');
			}
            $("#" + telephone).focus();
            return false;
        } 
		else {
            var tel = /^1[3|4|5|7|8|9][0-9]\d{8}$/;
            if(!tel.test($("#" + telephone).val())) {
				if(isWeiXin() || isWeiBo()){
					inputTip(phonebox, '您的电话输入有误，请重新填写');
				}
				else {
					showInfo(errorel, errorchildel, '您的电话输入有误，请重新填写');
				}
                $("#" + telephone).focus();
                return false;
            }
        }
	}

	//发送提交请求
    function checkForms(name, telephone, province, btnid, formid, errorel, errorchildel, namebox, phonebox) {
    	var fromPage; //来源变量
    	if(getUrlParameter("id")){
    		fromPage = getUrlParameter("id");
    	}else{
    		fromPage = $("#source").val();
    	}

    	if(checkName(name, errorel, errorchildel, namebox) == false) {
			return false;
		}
		if(checkPhone(telephone, errorel, errorchildel, phonebox) == false){
			return false;
		}
		if(wbbm_province==0)
		{
			if(isWeiXin() || isWeiBo()){
				inputTip(province, '请选择城市');
				return false;
			}
			else {
				showInfo(errorel, errorchildel, '请选择您所在的城市');
				return false;
			}
		}
        $.ajax({
        	type: "POST",
        	url: "api/mmwap.php?action=fbform",
        	data: {
        		title: $("#" + name).val(),
        		telephone: $("#" + telephone).val(),
        		areaid: wbbm_province,
        		source: fromPage,
        		lrsx: choose_lrsx,
        		lrsx_area: choose_area,
        		lrsx_style: choose_style,
        		lrjd: choose_lrjd
        	},
        	dataType: "json",
        	beforeSend: function(){
				$('#' + btnid).attr('disabled', 'disabled').val("提交中...");
				$("#" + formid).addClass("disabled");
        	},
            success: function(res){
            	console.log(res)
            	if(res['flag']){
            		alertOpen(res['msg']);
            		getPerson();
					res="";
					$(".apply-input").val("");
					$("#select-01").val("0");
					$("#alert-select-01").val("0");
            	}else if(!res['flag']){
					alertOpen(res['msg']);
					$(".apply-input").val("");
					$("#select-01").val("0");
					$("#alert-select-01").val("0");
				}
            },
            complete: function(){
            	$('#' + btnid).removeAttr('disabled').val("免费申请");
				$("#" + formid).removeClass("disabled");
            },
			error: function(){
				$('#' + btnid).removeAttr('disabled').val("免费申请");
            	alert('您当前网络异常');
            }
        });
        return false;
    }

	//弹出层方法
	function setLayerTop() {
		var layer_top = (w_h- $("#layer-content").height())/2+managerPage.scrollTop;
		$("#layer-content").css("top",layer_top);
	}
	function alertOpen(str) {
		var alert_tag = '<section id="alert-layer"><div id="layer-content"><p id="alert-con"></p><p class="auto-close"><span id="close-time">5</span>s后自动关闭</p><span id="layer-close"></span></div></section>';
		$(alert_tag).appendTo("body");
		var d_h = $(document).height();
		$("#alert-layer").height(d_h);
		$("#alert-con").html(str);
		// setLayerTop();
		// $(window).scroll(setLayerTop);
		setTimeout(alertClose,1000);
		function alertClose() {
			var t = $("#close-time").html();
			t--;
			if(t>0)
			{
				$("#close-time").html(t);
				setTimeout(alertClose,1000);
			}
			else {
				$("#alert-layer").remove();
			}
		}
		$("#layer-close").bind("click",function(){
			$("#alert-layer").remove();
		});
	}

	$("#alert-myform").on("submit", function() {
		return checkForms('alert-user-name', 'alert-user-pwd', 'alert-province', 'alert-applyBtn', 'alert-myform', 'alert-errorCue', 'alert-errorMsg', 'alert-name-box', 'alert-phone-box');
	});
	$("#alert-user-pwd").on('focus', function(){
		checkName('alert-user-name', 'alert-errorCue', 'alert-errorMsg', 'alert-name-box');
	});

	$("#myform").on("submit", function() {
		return checkForms('user-name', 'user-pwd', 'province', 'applyBtn', 'myform', 'errorCue', 'errorMsg', 'name-box', 'phone-box');
	});
	$("#user-pwd").on('focus', function(){
		checkName('user-name', 'errorCue', 'errorMsg', 'name-box');
	});
})
