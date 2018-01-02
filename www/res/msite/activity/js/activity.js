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
var isApp = getUrlParameter("app");

var hid = getUrlParameter('hid');  //新版活动编号
var temp = getUrlParameter("temp"); //旧版活动编号
var url = encodeURIComponent(window.location.href.split("#")[0]);

//旧版微信分享
wxShare(url, "hdmb", temp);

//新版微信分享
wxShare(url, "newhd", hid);

var city_status = 0;
var choose_province = 0; //获取省份 0为未选择
var choose_city = 0; //获取城市 0为未选择
var fromPage; //来源变量
var wxCue = '<p id="tip"><i class="tip-icon"></i><span id="tip-con"></span></p>';
$(function(){
	if(hid) {
		getTemp();
	};
	if(temp) {
		getTopic();
		getPerson();
	};
	if(isApp && isApp == 1){
		$("header").add("#footer").add(".footer_menu_bs").remove();
		$(".container").css({"padding-top": 0});
		$("#free-btn").css({"bottom": 0});
		$("#managerPage").css({"padding-bottom": 0});
	}

});

function dataLoaded(){
		//底部提交按钮显示隐藏
		var w_h = $(window).height();
		var w_w = $(window).width();
		var d_h = $(document).height();
		var content_h = $("#apply-form").height() + $("#apply-form").offset().top - $("header").height() - (parseFloat($('#applyBtn').css('margin-top'))*4);
		var footer_top = 0;

		if($("#footer").height()){
			footer_top =  d_h - w_h - $("#footer").height();
		} else if($(".footer_menu_bs").height()){
			footer_top =  d_h - w_h - $(".footer_menu_bs").height();
		} else {
			footer_top =  d_h - w_h - 50;
		}

		$(document).scroll(function() {
			var scroll_top = getScrollTop();
			if(scroll_top>content_h)
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
		// $("#user-name").bind("focus",gotoReg);
		function gotoReg() {
			var input_top = parseInt($("#apply-form").offset().top) - 56 - headerH;
			if(device == "apple")
			{
				setTimeout(function(){managerPage.scrollTop  = input_top+10;},10);
			}
			else {
				managerPage.scrollTop  = input_top;
			}

			$("#user-name").focus();
		}
};
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

//优酷视频去广告
function hideAd(vid){
	player = new YKU.Player('youkuplayer',{
		styleid: '0',
		client_id: '3cd17f251dc3cedd',
		vid: vid,
		newPlayer: true
	});
}
//获取报名人数
function getPerson(){
	$.ajax({
		type: "GET",
		url: "api/wap.php?action=fbcount&temp="+temp,
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

//新版模板获取数据方法
function getTemp() {
	$.ajax({
		type: 'GET',
		url: '/api/newhd.php?action=hdata&hid='+hid,
		dataType: 'json',
		timeout: 3000,
		success: function(res) {
			console.log(res)
			if(res && res.code == 1){
				var data = res.arr;

				//普通活动模板
				if(data.ifh5 == 1) {
					$("#swiper-container").remove();
					$(".style-none").show();

					solveTemplate("#common-content", "#common-data", data);

					$('.swiper-box').each(function(){
						var box_id = $(this).attr('id');
						var swiper = new Swiper('#'+box_id, {
							pagination: '#'+box_id+' .swiper-pagination',
							loop : true,
							autoplay: 3000,
							paginationClickable: false,
							autoplayDisableOnInteraction : false
						});
					});

					var imgNum = 0;
					var load_img = $(".lazy-img");
					for(var i=0; i<load_img.length; i++){
						load_img[i].onload = function(){
							imgNum++;
							if(imgNum==load_img.length){
								dataLoaded();
							}
						}
					}

					//底部导航隐藏
					if(data.navigation == 2){
						$('.footer_menu_bs').remove();
						$('body').css('padding-bottom', '0');
						$('#free-btn').css('bottom', '0');
					}
					//公共底隐藏
					if(data.floor == 2){
						$('#footer').remove();
					}
				}
				//H5活动模板
				if(data.ifh5 == 2) {
					$('.common-container').add('#footer').remove();
					$(".container").css({"padding-top": 0});
					$("#swiper-container").css('height', winH);

					solveTemplate(".swiper-wrapper", "#h5-data", data);

					var swiper = new Swiper('#swiper-container', {
					    paginationClickable: true,
					    direction: 'vertical'
					});
					//底部导航显示
					if(data.navigation == 1){
						$('.go-top').css('bottom', '5.5rem');
					}
					//底部导航隐藏
					if(data.navigation == 2){
						$('.footer_menu_bs').remove();
					}

					//去掉最后一屏箭头提示
					$(".swiper-slide").last().find(".go-top").remove();
				}

				//标题显示隐藏
				if(data.iftitle == 1){
					$('.header-title').text(data.title);
				}
				if(data.iftitle == 2){
					$('header').remove();
					$('.container').css('padding-top', '0');
				}

				//在线咨询按钮隐藏
				if(data.consult == 2) {
					$('#udesk-feedback-tab').hide();
				}
				for(var key in data.module) {
					var item = data.module[key];
					//视频去广告
					if(Array.prototype.isPrototypeOf(item)) {
						for(var key in item) {
							var every = item[key];

							if(every.ad == 1){
								var _vid = every.url.split('embed/')[1];
								hideAd(_vid);
							}
						}
					}
					// 全国城市获取
					if(!Array.prototype.isPrototypeOf(item)) {
						if(item.are == 1) {
							city_status = 1;
							$("#select-01").bind("change", function(){
								var selected_1 = $(this).find('option').not(function(){ return !this.selected });
								choose_province = selected_1.val();
							});
						}
						if(item.are == 2) {
							city_status = 2;
							$("#select-01").bind("change", function(){
								var selected_1 = $(this).find('option').not(function(){ return !this.selected });
								choose_province = selected_1.val();
								getCitys(choose_province);
							});
						}
					}
				}

				$("#user-pwd").on('focus', function(){
					checkName();
				});
				$("#myform").on("submit", function() {
					if(city_status == 1){
						return checkForms();
					}else if(city_status == 2){
						return allCitysCheckForms();
					}
				});
			} else{
				alert("活动过期啦~来首页看看更多活动吧");
				window.location.href = "mobile-index.html";
			}
		}
	});
}
//获取专题详情
function getTopic(){
	$.ajax({
		type: "POST",
		url: "api/hd.php?action=fbform&temp="+temp+"&idurl="+url,
		dataType: "json",
		timeout: 3000,
		success: function(res){
			console.log(res)
			if(res && res.code == 1){
				var data = res.data;
				if(data.status == 1){
					if(data.type == 2){
						$(".container").css({"padding-top": 0});
						$("#swiper-container").css('height', winH);
						$(".normal-form").add("#footer").remove();
						solveTemplate(".swiper-wrapper", "#swiper-box-data", data);

						var swiper = new Swiper('#swiper-container', {
						    // pagination: '.swiper-pagination',
						    // loop : true,
						    paginationClickable: true,
						    direction: 'vertical'
						});


						if(data.background){
							$("#apply-form").parent(".swiper-slide").css({
								"background-image": "url("+data.background+")",
								"background-repeat": "no-repeat",
								"background-size": "cover"
							});
						}
						for(var i=0; i<data.head.length; i++){
							var item = data.head[i];
							if(item.type == "vim"){
								$(".temp-video").parent(".swiper-slide").css({
									"background-image": "url("+item.url+")",
									"background-repeat": "no-repeat",
									"background-size": "cover"
								});
							}
						}
						$(".swiper-slide").last().find(".go-top").remove();
					} else {
						$("#swiper-container").remove();
						$(".style-none").show();
						solveTemplate("#content-top", "#top-activity-data", data);
    					solveTemplate("#content-bottom", "#bottom-activity-data", data);

    					if(data.isno == 2) {
    						$('.normal-form').add('#free-btn').remove();
    					}
    					if(data.background){
							$("#apply-form").css({
								"background": "url("+data.background+") no-repeat"
							});
	    				}
					}

    				var imgNum = 0;
    				var load_img = $(".lazy-img");
    				for(var i=0; i<load_img.length; i++){
    					load_img[i].onload = function(){
    						imgNum++;
    						if(imgNum==load_img.length){
    							dataLoaded();
    						}
    					}
    				}
    				if(data.title){
    					$(".header-title").html(data.title);
    				}
    				if(data.button){
    					$("#applyBtn").val(data.button);
    					$("#free-btn").html(data.button);
    				}
    				if(data.status_1 == 2){
    					$(".footer_menu_bs").add(".amount_house_mask_bs").remove();
    					$("#managerPage").css({"padding-bottom": 0});
    					$("#free-btn").css({"bottom": 0});
    				}
    				if(data.status_3 == 2){
    					$("#footer").remove();
    					$("#managerPage").css({"padding-bottom": '5.3375rem'});
    				}
    				if(data.status_4 == 2){
    					$("header").remove();
    					$(".container").css({"padding-top": 0});
    				}
    				if(data.status_1 == 2 && data.status_3 == 2){
    					$("#managerPage").css({"padding-bottom": '2.1875rem'});
    					$("#free-btn").css({"bottom": 0});
    				}
    				if(data.color){
    					$("#applyBtn").add("#free-btn").css({
    						"background-color": "#"+data.color,
    						"border-color": "#"+data.color
    					});
    				}
    				if(data.color1){
    					$("#applyBtn").add("#free-btn").css({"color": "#"+data.color1});
    				}
    				if(data.color2){
    					$("#userTotal").css({"color": "#"+data.color2});
    				}
    				if(data.color3){
    					$("#apply-total").css({"color": "#"+data.color3});
    				}
    				//去除视频广告
    				if(data.advertising == 1){
    					var _vid;
    					for(var i=0; i<data.head.length; i++){
    						if(data.head[i].type == "vim"){
    							_vid = data.head[i].urlsx.split('embed/')[1];
    						}
    					}
    					for(var i=0; i<data.troops.length; i++){
    						if(data.troops[i].type == "vim"){
    							_vid = data.troops[i].urlsx.split('embed/')[1];
    						}
    					}
    					hideAd(_vid);
    				}

    				if(data.city == 1){
    					city_status = 1;
    					$("#city").remove();
    					$("#province").removeClass("fl");
    					$("#select-01").removeClass("apply-select").addClass("open-city");
    					solveTemplate("#select-01", "#province-data", data);
    					$("#select-01").bind("change", function(){
    						var selected_1 = $(this).find('option').not(function(){ return !this.selected });
    						choose_province = selected_1.val();
    					});
    				}else if(data.city == 2){
    					city_status = 2;
    					solveTemplate("#select-01", "#province-data", data);
    					$("#select-01").bind("change", function(){
    						var selected_1 = $(this).find('option').not(function(){ return !this.selected });
    						choose_province = selected_1.val();
    						getCitys(choose_province);
    					});
    				}

    				$("#user-pwd").on('focus', function(){
    					checkName();
    				});
    				$("#myform").on("submit", function() {
    					if(city_status == 1){
    						return checkForms();
    					}else if(city_status == 2){
    						return allCitysCheckForms();
    					}
    				});
				}else{
					$("#apply-form").add("#footer-bottom-tel").add("#free-btn").add("#footer").remove();
					alert("活动过期啦~来首页看看更多活动吧");
					window.location.href = "mobile-index.html";
				}
			}
		},
		error: function(XMLHttpRequest, textStatus){
			if(textStatus == "timeout"){
				$("#apply-form").add("#footer-bottom-tel").add("#footer").remove();
				reLoad("body");
			}
		}
	});
}
function getCitys(select_id){
	var url;
	if(hid) {
		url = '/api/newhd.php?action=district&select='+select_id;
	}

	if(temp) {
		url = 'api/hd.php?action=fbform&temp='+temp+'&select='+select_id;
	}
	$.ajax({
		type: "POST",
		url: url,
		dataType: "json",
		timeout: 3000,
		success: function(res){
			console.log(res)
			if(res && res.code == 1){
    			if(hid) {
    				solveTemplate("#select-02", "#city-data", res);
    			}
    			if(temp) {
    				var data = res.data;
    				solveTemplate("#select-02", "#city-data", data);
    			}
    			$("#select-02").bind("change", function(){
					var selected_2 = $(this).find('option').not(function(){ return !this.selected });
					choose_city = selected_2.val();
				});
			}
		},error: function(XMLHttpRequest, textStatus){
			console.log(textStatus);
		}
	});
}
//发送开通城市请求
function checkForms() {
	if(getUrlParameter("id")){
		var source = getUrlParameter("id");
		if(isWeiXin()){
			fromPage = "Mweixin-" + source;
		}else if(isWeiBo()){
			fromPage = "Mweibo-" + source;
		}else{
			fromPage = "M-" + source;
		}
	}else{
		var source = $("#source").val();
		if(isWeiXin()){
			fromPage = "Mweixin-" + source;
		}else if(isWeiBo()){
			fromPage = "Mweibo-" + source;
		}else{
			if(isApp == 1){
				fromPage = "App-" + source;
			} else {
				fromPage = "M-" + source;
			}
		}
	}
	if(checkName() == false) {
		return false;
	}
	if(checkPhone() == false){
		return false;
	}
	if(choose_province==0)
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
    $.ajax({
    	type: "POST",
    	url: "api/hd.php?action=fbcount&city="+city_status+"&title="+$("#user-name").val()+"&telephone="+$("#user-pwd").val()+"&areaid="+choose_province+"&source="+fromPage+"&time="+new Date().getTime(),
    	dataType: "json",
		data{
            activityid:temp
		},
    	beforeSend: function(){
			$('#applyBtn').attr('disabled', 'disabled');
			$("#myform").addClass("disabled");
    	},
        success: function(res){
        	if(res['flag']){
        		alertOpen(res['msg']);
        		if(temp) {
        			getPerson();
        		};
				res="";
				$(".apply-input").val("");
				$("#select-01").val("0");
        	}else if(!res['flag']){
				alertOpen(res['msg']);
				$(".apply-input").val("");
				$("#select-01").val("0");
			}
        },
        complete: function(){
        	$('#applyBtn').removeAttr('disabled');
			$("#myform").removeClass("disabled");
        },
		error: function(){
			$('#applyBtn').removeAttr('disabled');
        	alert('您当前网络异常');
        }
    });
    return false;
}
//发送全国城市请求
function allCitysCheckForms() {
	if(getUrlParameter("id")){
		var source = getUrlParameter("id");
		if(isWeiXin()){
			fromPage = "Mweixin-" + source;
		}else if(isWeiBo()){
			fromPage = "Mweibo-" + source;
		}else{
			if(isApp == 1){
				fromPage = "App-" + source;
			} else {
				fromPage = "M-" + source;
			}
		}
	}else{
		var source = $("#source").val();
		if(isWeiXin()){
			fromPage = "Mweixin-" + source;
		}else if(isWeiBo()){
			fromPage = "Mweibo-" + source;
		}else{
			fromPage = "M-" + source;
		}
	}
	if(checkName() == false) {
		return false;
	}
	if(checkPhone() == false){
		return false;
	}
	if(choose_province==0)
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
    if(choose_city==0)
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
    $.ajax({
    	type: "POST",
		url: 'api/hd.php?action=fbcount&city='+city_status+'&title='+$("#user-name").val()+'&telephone='+$("#user-pwd").val()+'&select='+choose_province+'&select_1='+choose_city+'&source='+fromPage,
    	dataType: "json",
    	beforeSend: function(){
			$('#applyBtn').attr('disabled', 'disabled');
			$("#myform").addClass("disabled");
    	},
        success: function(res){
        	if(res['flag']){
        		alertOpen(res['msg']);
        		if(temp) {
        			getPerson();
        		};
				res="";
				$(".apply-input").val("");
				$(".apply-select").val("0");
        	}else if(!res['flag']){
				alertOpen(res['msg']);
				$(".apply-input").val("");
				$(".apply-select").val("0");
			}
        },
        complete: function(){
        	$('#applyBtn').removeAttr('disabled');
			$("#myform").removeClass("disabled");
        },
		error: function(){
			$('#applyBtn').removeAttr('disabled');
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
