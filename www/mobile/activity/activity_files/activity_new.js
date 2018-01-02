var device;
var app;

//默认类型 zhaorong2017-05-10 start
var defaultNum;
//默认类型 zhaorong2017-05-10 end

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


// 2017-06-14 urllaiyuan
var urlSource = getUrlParameter("source");
var urlSource_new = getUrlParameter("id");
setCookie('source',urlSource);
setCookie('source_new',urlSource_new);


var hid;
if(getUrlParameter('activity_id')) {
	hid = getUrlParameter('activity_id');
}
if(getUrlParameter('hid')) {
	hid = getUrlParameter('hid');
}

var url = encodeURIComponent(window.location.href.split("#")[0]);

//旧版微信分享
wxShare(url, "newactivity", hid);

var city_s = false;
var choose_province = 0; //获取省份 0为未选择
var choose_city = 0; //获取城市 0为未选择
var fromPage; //来源变量
var wxCue = '<p id="tip"><i class="tip-icon"></i><span id="tip-con"></span></p>';
$(function(){

	getTemp();

	//楼层跳转
    jumpFloor();

	if(isApp && isApp == 1){
		$("header").add("#footer").add(".footer_menu_bs").remove();
		$(".container").css({"padding-top": 0});
		$("#free-btn").css({"bottom": 0});
		$("#managerPage").css({"padding-bottom": 0});
	}

});

//顶部红色提示条
function showInfo(msg){
	$('#errorMsg').html(msg);
    $('#errorCue').removeClass().addClass('show');
	if(device == "apple"){
		$('#errorCue').addClass("ios");
		$('#errorCue').css({top: 0});
		// $(window).scroll(function(){
		// 	$('#errorCue').css({top: managerPage.scrollTop});
		// });
	}
    setTimeout(function(){
        $('#errorCue').removeClass('show');
    }, 2000);
}
//输入框上部提示语
function showTip(id, str) {
	$("#tip").remove();
	$("#" + id).parent().append(wxCue);
	$("#tip-con").html(str);
	setTimeout(function(){
		$("#tip").remove();
	},2000);
}

//输入框检测
function checkName(id){
	if($("#" + id).val()=='') {
		if(isWeiXin() || isWeiBo()){
			showTip(id, '您的姓名不能为空');
		}
		else {
			showInfo('您的姓名不能为空');
		}
        $("#" + id).focus();
        return false;
    }
    var reg = /^[\u4E00-\u9FA5]+$/;
    var userName = $("#" + id).val();
    if (!reg.test(userName)) {
		if(isWeiXin() || isWeiBo()){
			showTip(id, '请填写中文姓名');
		}
		else {
			showInfo('请填写中文姓名');
		}
        $("#" + id).focus();
        return false;
    }
	if($("#" + id).val().replace(/[^x00-xff]/g,"**").length>20) {
		if(isWeiXin() || isWeiBo()){
			showTip(id, '您的称呼保持在10个字以内');
		}
		else {
			showInfo('您的称呼保持在10个字以内');
		}
		$("#" + id).focus();
		return false;
	}
}
function checkPhone(id){
	if($("#" + id).val()=='') {
		if(isWeiXin() || isWeiBo()){
			showTip(id, '请填写电话');
		}
		else {
			showInfo('请填写电话');
		}
        $("#" + id).focus();
        return false;
    } 
	else {
        var tel = /^1[3|4|5|7|8|9][0-9]\d{8}$/;
        if(!tel.test($("#" + id).val())) {
			if(isWeiXin() || isWeiBo()){
				showTip(id, '您的电话输入有误，请重新填写');
			}
			else {
				showInfo('您的电话输入有误，请重新填写');
			}
            $("#" + id).focus();
            return false;
        }
    }
}


//新版模板获取数据方法
function getTemp() {
	$.ajax({
		type: 'GET',
		url: '/api/activity.php?action=activity&action_id='+hid,
		dataType: 'json',
		timeout: 3000,
		success: function(res) {
			console.log(res);
			//alert(parseFloat(res.arr.are))
			if(res.arr.are && parseFloat(res.arr.are) > 100){
				setCookie('cityid',res.arr.are);
			}else{
				removeCookie('cityid');
			}

			if(res && res.code == 1){
				var data = res.arr;
                defaultNum = data.are;
				//普通活动模板
				if(data.activity_type == 2) {
					$("#swiper-container").remove();
					$(".style-none").show();

					solveTemplate("#common-content", "#common-data", data);

					$('.swiper-box').each(function(){
						var box_id = $(this).attr('id');
						var swiper = new Swiper('#'+box_id, {
							pagination: '#'+box_id+' .swiper-pagination',
							loop : true,
							autoplay: 5000,
							paginationClickable: false,
							autoplayDisableOnInteraction : false
						});
					});

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

					for(var key in data.module) {
						var item = data.module[key];

						// 获取省市
						if(item.type == 'bidding') {
							// 开通城市获取
							if(data.are == 1) {
								$("#select-01" +key).bind("change", function(){
									var selected_1 = $(this).find('option').not(function(){ return !this.selected });
									choose_province = selected_1.val();
								});
							}
							if(data.are == 2) {
								city_s = true;

								$("#select-01" + key).bind("change", function(){
									var form_id = $(this).parents('.myforms').attr('id');

									var selected_1 = $(this).find('option').not(function(){ return !this.selected });
									choose_province = selected_1.val();
									getCitys(form_id, choose_province);
								});
							}
						}
					}
				}
				//H5活动模板
				if(data.activity_type == 1) {
					$('.common-container').add('#footer').remove();
					$("body").css({"padding-bottom": 0});
					$(".container").css({"padding-top": 0});
					$("#swiper-container").css('height', winH);

					solveTemplate(".swiper-wrapper", "#h5-data", data);
					solveTemplate("#a-address", "#a-address-data", data);

					var swiper = new Swiper('#swiper-container', {
					    paginationClickable: true,
					    direction: 'vertical'
					});

					//跳转楼层2017-07-04
					setSwiperFloor(swiper);


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

					// 弹出框报名显示
					$('.cls-apply').on('click', function() {
						$('.amount_house_mask_bs').show();
						$('.in_info_bs').show();
					});

					// 弹出框报名隐藏
					$('.close_bs').on('click', function() {
						$('.in_info_bs').hide();
						$('.choose-box').show();

						$('.real-apply').on('click', function() {
							$('.choose-box').hide();
							$('.in_info_bs').show();
						})

						$('.real-close').on('click', function() {
							$('.choose-box').hide();
							$('.amount_house_mask_bs').hide();
						})
					})

					if(data.are == 1) {
						$("#select-01").bind("change", function(){
							aleret(1)
							var selected_1 = $(this).find('option').not(function(){ return !this.selected });
							choose_province = selected_1.val();
						});

						$("#select-01" + data.applybox).bind("change", function(){
							var selected_1 = $(this).find('option').not(function(){ return !this.selected });
							choose_province = selected_1.val();
						});
					}
					if(data.are == 2) {
						city_s = true;

						$("#select-01").bind("change", function(){
							var form_id = $("#select-01").parents('.myforms').attr('id');

							var selected_1 = $(this).find('option').not(function(){ return !this.selected });
							choose_province = selected_1.val();
							getCitys(form_id, choose_province);
						});

						$("#select-01" + data.applybox).bind("change", function(){
							var form_id = $("#select-01" + data.applybox).parents('.myforms').attr('id');

							var selected_1 = $(this).find('option').not(function(){ return !this.selected });
							choose_province = selected_1.val();
							getCitys(form_id, choose_province);
						});
					}

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

				$('.myforms').each(function() {
					var _this = $(this);
					var form_id = _this.attr('id');
					$("#" + form_id).on("submit", function() {
						return checkForms(form_id);
					});
				});

			} else{
				alert("活动过期啦~来首页看看更多活动吧");
				window.location.href = "mobile-index.html";
			}

		}
	});
}
function getCitys(formid, select_id){
	var city_id = $('#' + formid).find('.city-select').attr('id');

	$.ajax({
		type: "GET",
		url: '/api/newhd.php?action=district&select='+select_id,
		dataType: "json",
		timeout: 3000,
		success: function(res){
			console.log(res)
			if(res && res.code == 1){

    			solveTemplate("#" + city_id, "#city-data", res);

    			$("#" + city_id).bind("change", function(){
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
function checkForms(formid) {
	var name_id = $('#' + formid).find('.uname').attr('id');
	var phone_id = $('#' + formid).find('.phone').attr('id');
	var province_id = $('#' + formid).find('.cls-province').attr('id');
	var city_id = $('#' + formid).find('.cls-city').attr('id');

	var name_val = $('#' + name_id).val();
	var phone_val = $('#' + phone_id).val();


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
		var source = $("#" + formid).find('.fromsou').val();
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
	if(checkName(name_id) == false) {
		return false;
	}
	if(checkPhone(phone_id) == false){
		return false;
	}
	if(choose_province==0)
	{
		if(isWeiXin() || isWeiBo()){
			showTip(province_id, '请选择城市');
			return false;
		}
		else {
			showInfo('请选择您所在的城市');
			return false;
		}
	}

	var url = ''; //接口变量
	if(city_s) {
		if(choose_city==0)
		{
			if(isWeiXin() || isWeiBo()){
				showTip(city_id, '请选择城市');
				return false;
			}
			else {
				showInfo('请选择您所在的城市');
				return false;
			}
		}

		url = 'api/hd.php?action=fbcount&city=2&title='+name_val+'&telephone='+phone_val+'&select='+choose_province+'&select_1='+choose_city+'&source='+fromPage+"&defaultnum=2";
	} else {
		//	defaultnum ==> 1 为已开通城市列表 2 为有默认城市
		if(defaultNum == 1){
            url = "api/hd.php?action=fbcount&city=1&title="+name_val+"&telephone="+phone_val+"&areaid="+choose_province+"&source="+fromPage+"&defaultnum=2";
		}else{
            url = "api/hd.php?action=fbcount&city=1&title="+name_val+"&telephone="+phone_val+"&areaid="+choose_province+"&source="+fromPage+"&defaultnum=1";
		}
	}
    $.ajax({
    	type: "GET",
    	url: url,
    	dataType: "json",
    	timeout: 3000,
        beforeSend: function(){
			$('#' + formid).find('.orange-btn').attr('disabled', 'disabled');
			$('#' + formid).addClass("disabled");
    	},
        success: function(res){
        	console.log(res)
			var resData = res;
            setCookie('orderid',res.data.orderid);
        	if(res['flag']){
        		alertOpen(res['msg']);
				res="";
				$(".apply-input").val("");
				// $(".apply-select").add('.open-city').val("0");
				// console.log(resData.defaultnum)
                $(".apply-select").add('.open-city').val(resData.defaultnum);
				choose_province = choose_city = 0;

				$('.amount_house_mask_bs').hide();
				$('.in_info_bs').hide();
        	}else if(!res['flag']){
				alertOpen(res['msg']);
				$(".apply-input").val("");

				// $(".apply-select").add('.open-city').val("0");
                $(".apply-select").add('.open-city').val(resData.defaultnum);
				choose_province = choose_city = 0;

				$('.amount_house_mask_bs').hide();
				$('.in_info_bs').hide();
			}
        },
        complete: function(){
        	$('#' + formid).find('.orange-btn').removeAttr('disabled');
			$('#' + formid).removeClass("disabled");
        },
		error: function(){
			$('#' + formid).find('.orange-btn').removeAttr('disabled');
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

/*
* 	time		2017-07-04
* 	author		zhaorong
* 	content		jump floor
*  	state    	start
*  	temp		pu tong
* */

// 设置滚动距离
function setScrollTo(tops) {
    if (document.documentElement.scrollTop) {

        document.documentElement.scrollTop = tops;
    } else {

        document.body.scrollTop = tops;
    }
}

//跳转楼层
function jumpFloor() {
	$('.container').on('click','.jump_picimg',function(){
		// 楼层位置
		var JUMPNUM = $(this).attr('jump');
        if(!JUMPNUM)return false;
		// 楼层位置对应的内容
		var contentLi = $(this).parents('.common-container').find('.content-li');
		// 滚动条高度
		var jumpPos = contentLi.eq(JUMPNUM - 1).offset().top - 60;
        // 设置滚动条高度
		setScrollTo(jumpPos);
	});
}
/*
* state		end
*
**/

/*
* temp 		h5
* state		start
* */

function setSwiperFloor(SWIPER){
	$('.jump_picimgh5').on('click',function () {
        var JUMPNUM = $(this).attr('jump');
        if(!JUMPNUM)return false;
        SWIPER.slideTo(JUMPNUM-1, 1000, false);
    });

}


/*
* state   	end
* */