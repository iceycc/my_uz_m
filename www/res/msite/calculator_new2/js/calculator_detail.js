var _app = getUrlParameter('isapp'); //判断是否来自app

$(function(){
	//获取cookie
	var areanum = getCookie('areanum');
	var city = getCookie('areaid');
	var house_type = getCookie('house_type');
	var area_num_str = getCookie('edit_area');

	if(_app) {
		$('header').remove();
		$('.pad-style').css('margin-top', '0');
	}

	if(browser.versions.weixin){
		$('.icon-fenxiang1').show().on('click', function(){
			$('.share-tip').show();
			$(window).on('touchmove', stopMove);

			$('.Iknow').on('click', function(){
				$('.share-tip').hide();
				$(window).off('touchmove', stopMove);
			})
		})
	}

	getInfo();

	function tabChange(){
		$('.tab-li').on('click', function(){
			var _this = $(this),
				li_h = _this.find('p').height(),
				table_box = _this.find('.table-box');

			if(table_box.css('display') == 'none'){
				// $('.tab-li').removeClass('active').height(li_h).find('.table-box').hide();

				var table_h = table_box.show().height();

				_this.height(li_h + table_h);
				_this.addClass('active');
			} else {
				table_box.hide();
				_this.removeClass('active').height(li_h);
			}
		});
	}

	function getInfo(){
		var data;
		if(area_num_str){
			data = {area: areanum, city: city, house_type: house_type, edit_area: area_num_str};
		} else {
			data = {area: areanum, city: city, house_type: house_type};
		}
		$.ajax({
			type: 'POST',
			url: '/index.php?m=wap&f=calculator&v=quote_details',
			data: data,
			dataType: 'json',
			timeout: 3000,
			success: function(res){
				console.log(res)
				var data = res.data;
				$('#totalMoney').text(data.total_price);
				solveTemplate("#detail-box", "#detail-data", data);
				if(data.similar.length > 0){
					solveTemplate("#similar-cases", "#cases-data", data);
				}
				tabChange();
			},
			error: function(XMLHttpRequest){
				console.log('error');
			}
		});
	}

	function stopMove(e){
		e.preventDefault();
	}
});