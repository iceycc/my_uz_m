var aid = getUrlParameter('aid');
$(function() {

	$.ajax({
		type: 'GET',
		url: '/index.php?m=wap&f=zxkt_index&v=zx_red_book',
		dataType: 'json',
		timeout: 3000,
		success: function(res) {
			console.log(res)
			if(res && res.code == 1) {
				solveTemplate('#red-box', '#red-data', res);
				setStr('.same-p', 48);

				$('.link-a').each(function(event){
					var _this = $(this);

					if (_this.attr('index') == aid){
						_this.css('color', '#ff7519');
						document.body.scrollTop = _this.offset().top - _this.height();
					}
				});

				tabShow('red-title', 'red-list', 'red-hide');

			}
		},
		error: function() {
			console.log('error');
		}
	});
})

function tabShow(cid, pid, aClass) {
	$('.' + cid).on('click', function(e) {
		var _this = $(this);
		var par_red = _this.parents('.' + pid);

		if(par_red.hasClass(aClass)) {
			par_red.removeClass(aClass);
		} else {
			par_red.addClass(aClass);
		}
	});
}