var _app = getUrlParameter('isapp'); //判断是否来自app

$(function(){
	if(_app) {
		$('header').remove();
		$('.top-info').css('margin-top', '0');
		$('.change-btn').each(function() {
			var _this = $(this);
			var href = _this.attr('href');
			_this.attr('href', href + '&isapp=true');
		});
		$('.look-detail').attr('href', $('.look-detail').attr('href') + '?isapp=true');
	}
	//第一次获取cookie
	var areanum = getCookie('areanum'),
		name = decodeURIComponent(getCookie('title')),
		city = getCookie('areaid'),
		house_type = getCookie('house_type'),
		telephone = getCookie('telephone'),
		pagesource = decodeURIComponent(getCookie('pagesource'));

	//修改总面积和户型后，再次获取cookie
	var revise_house = getCookie('revise_house');

	//修改各个房间面积后，获取cookie
	var area_num_str = getCookie('edit_area');


	getInfo();

	function getInfo(){
		var data, url;
		if(area_num_str){
			url = '/index.php?m=wap&f=calculator&v=quote_area';
			data = {area: areanum, city: city, house_type: house_type, edit_area: area_num_str};
		} else {
			url = '/index.php?m=wap&f=calculator&v=quote_house';
			if(revise_house){
				data = {area: areanum, city: city, house_type: house_type, id:pagesource};
			}
			else {
				data = {area: areanum, name: name, city: city, house_type: house_type, telephone: telephone, source: true, id:pagesource};
			}
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

				if(data.houseStatus == 0 || data.houseStatus == 2){
					alertOpen('您填写的户型与实际存在差异，报价存在误差，建议调整后重新计算');
				}
				if(data.areaStatus == 0 || data.areaStatus == 2){
					alertOpen('您填写的面积与实际存在差异，报价存在误差，建议调整后重新计算');
				}
				$('#totalMoney').text(data.total_price);
				$('#writeArea').text(data.area);
				$('#realArea').text(data.use_area);

				solveTemplate("#room-budget", "#budget-data", data);

			},
			error: function(XMLHttpRequest){
				$('#show-box').show();
			}
		});
	};

});