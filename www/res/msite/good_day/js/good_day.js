var device;
var app;
if(browser.versions.iPhone || browser.versions.iPad) {
	device = "apple";
}
if(browser.versions.android) {
	device = "android";
}

var time = 0; //装修时间
var fromPage; //来源变量
var wxCue = '<p id="tip"><i class="tip-icon"></i><span id="tip-con"></span></p>';

$(function(){
	$("#user-pwd").on('focus', function(){
		checkName();
	});
	$("#myform").on("submit", function() {
		return allCitysCheckForms();
	});
});

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
//顶部红色提示条
function showInfo(msg){
	$('#errorMsg').html(msg);
    $('#errorCue').removeClass().addClass('show');
	if(device == "apple"){
		$('#errorCue').addClass("ios");
		$('#errorCue').css({top: managerPage.scrollTop});
		$(window).scroll(function(){
			$('#errorCue').css({top: managerPage.scrollTop});
		});
	}
    setTimeout(function(){
        $('#errorCue').removeClass('show');
    }, 2000);
}
//输入框上部提示语
function nameTip(str) {
	$("#tip").remove();
	$(wxCue).appendTo("#name-box");
	$("#tip-con").html(str);
	setTimeout(function(){
		$("#tip").remove();
	},2000);
}
//输入框上部提示语
function phoneTip(str) {
	$("#tip").remove();
	$(wxCue).appendTo("#phone-box");
	$("#tip-con").html(str);
	setTimeout(function(){
		$("#tip").remove();
	},2000);
}
//选择省提示语
function provinceTip(str) {
	$("#tip").remove();
	$(wxCue).appendTo("#province");
	$("#tip-con").html(str);
	setTimeout(function(){
		$("#tip").remove();
	},2000);
}
//选择城市提示语
function cityTip(str) {
	$("#tip").remove();
	$(wxCue).appendTo("#city");
	$("#tip-con").html(str);
	setTimeout(function(){
		$("#tip").remove();
	},2000);
}
//输入框检测
function checkName(){
	if($("#user-name").val()=='') {
		if(isWeiXin() || isWeiBo()){
			nameTip('您的姓名不能为空');
		}
		else {
			showInfo('您的姓名不能为空');
		}
        $("#user-name").focus();
        return false;
    }
    var reg = /^[\u4E00-\u9FA5]+$/;
    var userName = $("#user-name").val();
    if (!reg.test(userName)) {
		if(isWeiXin() || isWeiBo()){
			nameTip('请填写中文姓名');
		}
		else {
			showInfo('请填写中文姓名');
		}
        $("#user-name").focus();
        return false;
    }
	if($("#user-name").val().replace(/[^x00-xff]/g,"**").length>20) {
		if(isWeiXin() || isWeiBo()){
			nameTip('您的称呼保持在10个字以内');
		}
		else {
			showInfo('您的称呼保持在10个字以内');
		}
		$("#user-name").focus();
		return false;
	}
}
function checkPhone(){
	if($("#user-pwd").val()=='') {
		if(isWeiXin() || isWeiBo()){
			phoneTip('请填写电话');
		}
		else {
			showInfo('请填写电话');
		}
        $("#user-pwd").focus();
        return false;
    } 
	else {
        var tel = /^1[3|4|5|7|8|9][0-9]\d{8}$/;
        if(!tel.test($("#user-pwd").val())) {
			if(isWeiXin() || isWeiBo()){
				phoneTip('您的电话输入有误，请重新填写');
			}
			else {
				showInfo('您的电话输入有误，请重新填写');
			}
            $("#user-pwd").focus();
            return false;
        }
    }
}

function allCitysCheckForms() {
	// if(getUrlParameter("id")){
	// 	var source = getUrlParameter("id");
	// 	if(isWeiXin()){
	// 		fromPage = "Mweixin-" + source;
	// 	}else if(isWeiBo()){
	// 		fromPage = "Mweibo-" + source;
	// 	}else{
	// 		if(isApp == 1){
	// 			fromPage = "App-" + source;
	// 		} else {
	// 			fromPage = "M-" + source;
	// 		}
	// 	}
	// }else{
	// 	var source = $("#source").val();
	// 	if(isWeiXin()){
	// 		fromPage = "Mweixin-" + source;
	// 	}else if(isWeiBo()){
	// 		fromPage = "Mweibo-" + source;
	// 	}else{
	// 		fromPage = "M-" + source;
	// 	}
	// }
	if(checkName() == false) {
		return false;
	}
	if(checkPhone() == false){
		return false;
	}
	if(wbbm_province==0)
	{
		if(isWeiXin() || isWeiBo()){
			provinceTip('请选择城市');
			return false;
		}
		else {
			showInfo('请选择您所在的城市');
			return false;
		}
	}
    if(wbbm_citys==0)
	{
		if(isWeiXin() || isWeiBo()){
			cityTip('请选择城市');
			return false;
		}
		else {
			showInfo('请选择您所在的城市');
			return false;
		}
	}

	window.location.href = '/mobile-good_result.html?name='+$("#user-name").val()+'&telephone='+$("#user-pwd").val()+'&time='+$("#time").val()+'&province='+wbbm_province+'&city='+wbbm_citys;

    return false;
}