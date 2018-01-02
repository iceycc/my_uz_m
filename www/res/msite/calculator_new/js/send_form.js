
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

var _app = getUrlParameter('isapp'); //判断是否来自app

$(function(){
	if(_app) {
		$('header').remove();
		$('#calculator-banner').css('margin-top', '0');
	}
	//$("#select-01,#select-02").width($("#select-01").width()+2).height($("#select-01").height()+2);
	//getPerson();
	$("#go-back").on('click', function(){
		goBack();
	});
	//底部提交按钮显示隐藏
	$("#free-btn").hide("fast");
	var w_h = $(window).height();
	var w_w = $(window).width();
	var d_h = $(document).height();
	if($("#apply-tip").height()) {
		var apply_h = $("#apply-tip").height();
	}
	else {
		var apply_h = 0;
	}
	var banner_h = $("#manager-banner").height();
	if(banner_h){
		var banner_h = banner_h;
	}
	else {
		banner_h = $("#weibo-banner").height()+$("header").height();
	}
	var content_h = banner_h+$("#quality").height();
	var tip_h =  $("#apply-total").height() + apply_h;
	var tip_margin = parseInt($("#apply-tip").css("margin-bottom")) + parseInt($("#apply-total").css("margin-bottom")); 
	if(tip_margin) {
		tip_margin = tip_margin;
	}
	else {
		tip_margin = 0;
	}
	var line = content_h - tip_h -tip_margin;
	var wxCue = '<p id="tip"><i class="tip-icon"></i><span id="tip-con"></span></p>';
	var footer_top =  d_h - w_h - $("#footer").height() - $("#bottom-tel").height();
	$(document).scroll(function() {
		var scroll_top = getScrollTop();
		if(scroll_top>line)
		{
			$("#free-btn").show("fast");
			if(scroll_top>footer_top) {
				$("#free-btn").addClass("document-bottom");
			}
			else {
				$("#free-btn").removeClass();
			}
		}
		else {
			$("#free-btn").hide("fast");
		}
	});
	$("#free-btn").bind("click",gotoReg);
	//输入框获取焦点后，屏幕滚动

    $("#user-name").bind("focus",gotoReg);
	function gotoReg() {
		var input_top = content_h - $("#apply-form").height() - parseInt($("#features-1").css("margin-bottom"));
		if(device == "apple")
		{
			setTimeout(function(){managerPage.scrollTop  = input_top+10;},10);
		}
		else {
			managerPage.scrollTop  = input_top;
		}

		$("#user-name").focus();
	}
	//顶部红色提示条
	function showInfo(msg){
		$('#errorMsg').html(msg);
	    $('#errorCue').removeClass().addClass('show');
		if(device == "apple")
		{
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
	//输入框面积提示语 wushi addd 2016-07-05 S
	function areaTip(str) {
		$("#tip").remove();
		$(wxCue).appendTo("#area-box");
		$("#tip-con").html(str);
		setTimeout(function(){
			$("#tip").remove();
		},2000);
	}
	//输入框面积提示语 wushi addd 2016-07-05 E
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
	function checkArea(){
		if($("#user-area").val()=='') {
			if(isWeiXin() || isWeiBo()){
				areaTip('您的装修面积不能为空');
			}
			else {
				showInfo('您的装修面积不能为空');
			}
            $("#user-area").focus();
            return false;
        }
		// var reg = /^(?:[0-9]{2,3}|1000)$/;
		var reg = /^(?:[1-9]\d{1,2}(?:\.[1-9]{1,2}|\.0[1-9])?|1000)$/;
		var userArea = $("#user-area").val();
	    if (!reg.test(userArea)) {
			if(isWeiXin() || isWeiBo()){
				areaTip('请填写10㎡~1000㎡面积范围，最多2位小数');
			}
			else {
				showInfo('请填写10㎡~1000㎡面积范围，最多2位小数');
			}
	        $("#user-area").focus();
	        return false;
	    }
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
	//根据面积获取房间数量
	var shi_num = ting_num = chu_num = wei_num = yt_num = 0;
	function roomNum() {
		var area_num = $("#user-area").val();
		if(area_num == 0){
			return false;
		} else {
			$.ajax({
				type: "POST",
	        	url: '/index.php?m=wap&f=calculator&v=house&area=' + area_num,
	        	dataType: "json",
	        	timeout: 3000,
	            success: function(res){
	            	var data = res.data;
	            	shi_num = $('#rooms').val(data.shi);
	        		ting_num = $('#living-room').val(data.ting);
	        		chu_num = $('#kitchen').val(data.chu);
	        		wei_num = $('#bathroom').val(data.wei);
	        		yt_num = $('#balcony').val(data.yt);

	            },
	            error: function(XMLHttpRequest){
	            	console.log('error');
	            }
			});
		}
	}
    function checkForms() {
    	var fromPage; //来源变量
    	if(getUrlParameter("id")){
    		fromPage = getUrlParameter("id");
    	}else{
    		fromPage = '';//$("#source").val();
    	}
		if(checkArea() == false) {
			return false;
		}
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
		shi_num = $('#rooms').find('option').not(function(){ return !this.selected }).val();
		ting_num = $('#living-room').find('option').not(function(){ return !this.selected }).val();
		chu_num = $('#kitchen').find('option').not(function(){ return !this.selected }).val();
		wei_num = $('#bathroom').find('option').not(function(){ return !this.selected }).val();
		yt_num = $('#balcony').find('option').not(function(){ return !this.selected }).val();
		var name = escape($("#user-name").val());

		setCookie('areanum', $("#user-area").val(), 1);
		setCookie('title', name, 1);
		setCookie('areaid', wbbm_province, 1);
		setCookie('house_type', shi_num+'|'+ting_num+'|'+chu_num+'|'+wei_num+'|'+yt_num, 1);
		setCookie('telephone', $("#user-pwd").val(), 1);
		setCookie('pagesource',fromPage , 1);

		_app ? location.href='mobile-calculator_result.html?isapp=true' : location.href='mobile-calculator_result.html';

		return false;
    }

	$("#myform").on("submit", function() {
		return checkForms();
	});

	var filter_time = function(){
        var time = setInterval(roomNum, 500);
        $(this).bind('blur',function(){
            clearInterval(time);
        });
    };
	$('#user-area').on('focus', filter_time);


	$("#user-name").on('focus', function(){
		checkArea();
	});
	$("#user-pwd").on('focus', function(){
		checkName();
	});
})
