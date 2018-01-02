var device;
if(browser.versions.iPhone || browser.versions.iPad) {
	device = "apple";
}
if(browser.versions.android) {
	device = "android";
}
var _app = getUrlParameter('isapp'); //判断是否来自app

$(function(){
	//获取cookie
	var areanum = getCookie('areanum');
	var city = getCookie('areaid');
	var house_type = getCookie('house_type');

	var area_num_str = getCookie('edit_area');

	//获取url参数
	var revise_house = getUrlParameter('revise_house');

	if(_app) {
		$('header').remove();
		if($('.second-show')) {
			$('.second-show').css('margin-top', '0');
		}
		if($('.quality')) {
			$('.quality').css('margin-top', '0');
		}
	}

	if(revise_house){
		$('.quality').show();
		setCookie('edit_area', 0, -1);

		loadProvince();
		changeHtml();

		$("#myform").on("submit", function() {
			return checkForms();
		});
	}
	if(getUrlParameter('revise_area')){
		$('.second-show').show();
		var data, url;
		if(area_num_str) {
			url = '/index.php?m=wap&f=calculator&v=quote_area';
			data = {area: areanum, city: city, house_type: house_type, edit_area: area_num_str};
		} else {
			url = '/index.php?m=wap&f=calculator&v=quote_house';
			data = {area: areanum, city: city, house_type: house_type};
		}
		$.ajax({
			type: 'POST',
			url: url,
			data: data,
			dataType: 'json',
			timeout: 3000,
			success: function(res){
				console.log(res)
				var data = res.data;
				solveTemplate("#form-content", "#sec-form-data", data);

				$("#second-form").on("submit", function() {
			    	return checkSecForm();
			    });

			},
			error: function(XMLHttpRequest){
				console.log('error');
			}
		});
	}


	function changeHtml(){
		var room_arr = house_type.split('|');

		// first form
		$('#user-area').val(areanum);

		$('#rooms').val(room_arr[0]);
		$('#living-room').val(room_arr[1]);
		$('#kitchen').val(room_arr[2]);
		$('#bathroom').val(room_arr[3]);
		$('#balcony').val(room_arr[4]);
	}

	function loadProvince() {

		var select_1 = $('#select-01');
        $.ajax({
            type: "POST",
            dataType: "json",
            url: "/api/mmwap.php?action=fbcity",
            cache: false,
            success: function(dataResult) {
                if (dataResult) {
                    var provinceHtml = "<option  value='0'>城市</option>";
					var province = dataResult.data;
                    for (var key in province) {
                            provinceHtml += '<option value='+province[key].lib +'>' + province[key].name + '</option>';
                    }
                    select_1.html(provinceHtml);

                    select_1.val(city);

					select_1.bind("change",function(e){
						var selected_1 = select_1.find('option').not(function(){ return !this.selected });

					})
                }
            },
            error: function(XMLHttpResponse) {
				console.log(XMLHttpRequest.status);
				console.log(XMLHttpRequest.readyState);
			}
        });
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

	function areaTip(str) {
		$("#tip").remove();
		$(wxCue).appendTo("#area-box");
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

	function checkArea(){
		if($("#user-area").val()=='') {
			if(browser.versions.weixin || browser.versions.weibo){
				areaTip('您的装修面积不能为空');
			}
			else {
				showInfo('您的装修面积不能为空');
			}
            $("#user-area").focus();
            return false;
        }
		var reg = /^(?:[1-9]\d{1,2}(?:\.[1-9]{1,2}|\.0[1-9])?|1000)$/;
		var userArea = $("#user-area").val();
	    if (!reg.test(userArea)) {
			if(browser.versions.weixin || browser.versions.weibo){
				areaTip('请填写10㎡~1000㎡面积范围，最多2位小数');
			}
			else {
				showInfo('请填写10㎡~1000㎡面积范围，最多2位小数');
			}
	        $("#user-area").focus();
	        return false;
	    }
	}

	function checkForms() {
		var housenum = $('#user-area').val();

		var province = $('#select-01').find('option').not(function(){ return !this.selected }).val();

		var shi_num = $('#rooms').find('option').not(function(){ return !this.selected }).val(),
			ting_num = $('#living-room').find('option').not(function(){ return !this.selected }).val(),
			chu_num = $('#kitchen').find('option').not(function(){ return !this.selected }).val(),
			wei_num = $('#bathroom').find('option').not(function(){ return !this.selected }).val(),
			yt_num = $('#balcony').find('option').not(function(){ return !this.selected }).val();

		var house_num = shi_num+'|'+ting_num+'|'+chu_num+'|'+wei_num+'|'+yt_num;

		if(checkArea() == false) {
			return false;
		}
		if(province == 0)
		{
			if(browser.versions.weixin || browser.versions.weibo){
				provinceTip('请选择城市');
				return false;
			}
			else {
				showInfo('请选择您所在的城市');
				return false;
			}
		}

		//修改值存到cookie
		setCookie('revise_house', true, 1);
		setCookie('areanum', housenum, 1);
		setCookie('areaid', province, 1);
		setCookie('house_type', house_num, 1);

		_app ? location.href='mobile-calculator_result.html?isapp=true' : location.href='mobile-calculator_result.html';

		return false;

    }


    function checkSecForm() {
    	var sec_form_total = 0,
    		area_num_arr = [],
    		area_num_str;
		$('.areanum').each(function(){
			var _this = $(this);
			sec_form_total += parseFloat(_this.val());
			area_num_arr.push(_this.val());
		});
		area_num_str = area_num_arr.join('|');

		if(sec_form_total > areanum){
			$('.second-error').css('display', 'flex');
			setTimeout(function(){
				$('.second-error').hide();
			}, 2000);

			return false;
		}

		setCookie('edit_area', area_num_str, 1);

		location.href='mobile-calculator_result.html';

		return false;

    }

});