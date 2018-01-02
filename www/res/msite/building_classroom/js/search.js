var p_name = getUrlParameter('pname'); //获取来源页面

// 定义绑定事件名称
var on_name = 'input';
if(browser.versions.trident) {
	on_name = 'propertychange';
}

if(browser.versions.android) {
	on_name = 'keyup';
}

$(function() {
	var need_text = ''; // 缓存搜索名称

	$('#s-text').on(on_name, function(e) {
		e.stopPropagation();
		var _this = $(this);
		var val = $.trim(_this.val());

		if(val == '') {
			$('.show').removeClass('show');
		}
		if(val && val != need_text) {
			getResult(_this.val())
		}

		need_text = val;

		$('.icon-guanbis').on('click', function() {
			_this.val('');
			$('.show').removeClass('show');
		});
	});
});

function getResult(val) {
	$.ajax({
		type: 'POST',
		url: '/index.php?m=wap&f=zxkt_index&v=zx_strategy_seek',
		data: {search_name: val, status: p_name},
		dataType: 'json',
		timeout: 3000,
		success: function(res) {
			if(res && res.code == 1) {
				solveTemplate('#search-box', '#search-data', res);
				$('#search-box').addClass('show').siblings().removeClass('show');

				setStr('.same-h3', 24); // 标题
				setStr('.same-p', 58); // 描述

				var reg = new RegExp(val,"g");
				$('.same-h3').each(function() {
					var _this = $(this);
					var text = _this.text();
					_this.html(text.replace(reg, '<span style="color: #ff7519;">'+val+'</span>'))
				})
			} else {
				$('.no-result').addClass('show').siblings().removeClass('show');
			}
		},
		error: function() {
			console.log('error');
		}
	});
}