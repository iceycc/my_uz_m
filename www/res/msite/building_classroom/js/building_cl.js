var cid = getUrlParameter('cid');
var page = 1; //初始页数

$(function(){
	if(cid) {
		lightBtn(cid);
		getInfo(cid);
	} else {
		getInfo(null);
	}
	$(window).bind("scroll", scrollPages);

	$('.icon-shaixuan').on('click', function(e) {
		$(document).on('touchmove', stopDefault);

		$('.cl-sx').addClass('sx-show');

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
		$(this).parents('.cl-sx').removeClass('sx-show');

		$(document).off('touchmove', stopDefault);
	});

});

// 获取选材内容
function getInfo(uid) {
	isLoading = false;
	var content = '<ul id=page'+page+'></ul>'; // 存储数据
	$("#cl-box").append(content);

	var url = '/index.php?m=wap&f=zxkt_index&v=material_selection_list&page=' + page;
	uid ? url = url +'&cid='+ uid : url;

	$.ajax({
		type: 'GET',
		url: url,
		dataType: 'json',
		timeout: 3000,
		success: function(res) {
			console.log(res)
			if(res && res.code == 1) {
				var data = res.data;

				totalPage = data.page_max;
				solveTemplate("#page"+page, "#cl-data", data);
				docH = $(document).height();
				if(totalPage <= 1){
					$(".down-page").remove();
				}
				isLoading = true;
				page++;

				setStr('.same-h3', 24);
				setStr('.same-p', 58);
			}
		},
		error: function() {
			console.log('error');
		}
	});
}

// 筛选按钮高亮
function lightBtn(index) {
	$('.sx-content dd').each(function(){
		var _this = $(this);

		if(_this.attr('index') == index) {
			_this.addClass('active');

			var text = _this.find('a').text();
			$('.sx-item').text(text);
		}
	});
}

function scrollPages(){
	var pageH = $(".down-page").height();
	var sTop = document.body.scrollTop + 100;
	if(pageH + sTop >= docH - winH && isLoading){
		if(page <= totalPage){
			if(cid) {
				lightBtn(cid);
				getInfo(cid);
			} else {
				getInfo(null);
			}
		}else{
			$(".down-page").hide();
		}
	}
}