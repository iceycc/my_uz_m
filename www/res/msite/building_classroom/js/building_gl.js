var cid = getUrlParameter('cid');  // 获取节点id;
var stage = getUrlParameter('stage');  // 获取节点所在阶段

var page = 1; //初始页数

// tab显示
function showTab(selector) {
	var _this = $('.' + selector);
	_this.addClass('ul-show');
	_this.find('li').each(function(){
		var _this = $(this);
		if(_this.attr('index') == cid) {
			_this.addClass('active');
		}
	});
	var ul_h = (_this.height()/16 + 3.375);
	$('#gl-box').css('margin-top', ul_h + 'rem');

	var $this = $('.' +selector+ '-box');
	$this.find('dd').each(function(){
		var _this = $(this);
		if(_this.attr('index') == cid) {
			_this.addClass('active');
		}
	});
}

$(function(){
	showTab(stage);
	getList();
	$(window).bind("scroll", function() {
		scrollPages(getList);
	});

	$('.icon-shaixuan').on('click', function(e) {
		$(document).on('touchmove', stopDefault);

		$('.gl-sx').addClass('sx-show');

		// $('.sx-content dd').on('click', function(e) {
		// 	$('dd').removeClass('active');

		// 	var _this = $(this);

		// 	_this.addClass('active').parents('.gl-sx').removeClass('sx-show');
		// 	$(document).off('touchmove', stopDefault);

		// 	getList();
		// });
	});

	// 分类点击
	$('.c-dt').on('click', function(e) {
		var _this = $(this);
		var par_dl = _this.parents('dl');

		par_dl.siblings().removeClass('dl-show');

		if(par_dl.hasClass('dl-show')) {
			par_dl.removeClass('dl-show');
		} else {
			par_dl.addClass('dl-show');
		}
	});

	// 点击遮罩层关闭
	$('.sx-ceng').on('click', function(e) {
		$(this).parents('.gl-sx').removeClass('sx-show');

		$(document).off('touchmove', stopDefault);
	});

});

// 获取列表内容
function getList() {
	isLoading = false;
	var content = '<ul id=page'+page+'></ul>'; // 存储数据
	$("#gl-box").append(content);
	$.ajax({
		type: 'GET',
		url: '/index.php?m=wap&f=zxkt_index&v=zx_strategy_list&cid=' + cid + '&page=' + page,
		dataType: 'json',
		timeout: 3000,
		success: function(res) {
			console.log(res)
			if(res && res.code == 1) {
				var data = res.data;

				totalPage = data.page_max;
				solveTemplate("#page"+page, "#gl-data", data);
				docH = $(document).height();
				if(totalPage <= 1){
					$(".down-page").remove();
				}
				isLoading = true;
				page++;

				setStr('.same-h3', 24); // 标题截取
				setStr('.same-p', 58); // 描述截取
			}
		},
		error: function() {
			console.log('error');
		}
	});
}