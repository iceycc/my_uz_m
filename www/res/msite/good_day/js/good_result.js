var name      = getUrlParameter('name'); // 用户名
var telephone = getUrlParameter('telephone'); //用户电话
var time      = getUrlParameter('time'); // 装修时间
var province  = getUrlParameter('province'); // 省份
var city      = getUrlParameter('city'); // 城市

// 换一个参数
var c_time = getUrlParameter('c_time');
var type   = getUrlParameter('type');
var status = getUrlParameter('status');

$(function(){
	goodDay();
});

// 装修吉日
function goodDay() {
	var url_data = {};
	if(c_time) {
		url_data = {mobile: telephone, decorate: time, start: c_time, type: type, status: status};
		console.log(url_data)
	} else {
		url_data = {name: name, mobile: telephone, decorate: time, areaid_1: province, areaid_2: city};
	}
	$.ajax({
		type: 'POST',
		url: '/index.php?m=wap&f=calendar&v=zx_calendar',
		data: url_data,
		dataType: 'json',
		timeout: 3000,
		success: function(res) {
			console.log(res)
			if(res && res.code == 1) {
				var data = res.data;
				solveTemplate('#good-box', '#good-data', res);
				getinfo();

				// 换一个url
				var change_type = data[0].type;
				var change_status = '';
				data[0].status ? change_status = data[0].status : change_status = null;

				var change_t = $('#year').text() + '-' + $('#month').text() + '-' + $('#day').text();
				var url = '/mobile-good_result.html?name='+name+'&telephone='+telephone+'&time='+time+'&province='+province+'&city='+city+'&c_time='+change_t+'&type='+change_type+'&status='+change_status;

				$('.change-day').attr('href', url);
			}
		},
		error: function() {
			console.log('error');
		}
	});
}

// 推荐内容
function getinfo() {
	$.ajax({
		type: 'GET',
		url: '/index.php?m=wap&f=calendar&v=index',
		dataType: 'json',
		timeout: 3000,
		success: function(res) {
			console.log(res)
			if(res && res.code == 1) {
				var data = res.data;
				solveTemplate('#fs-box', '#center-data', data);
				solveTemplate('#bottom-box', '#bottom-data', data);
			}
		}
	});
}