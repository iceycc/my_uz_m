var lrsx = {
	1: '太忙了',
	2: '不懂装修',
	3: '有钱有闲'
};
var area = {
	1: '60㎡以下',
	2: '60~100㎡',
	3: '100~120㎡',
	4: '120~160㎡',
	5: '160㎡以上'
};
var style = {
	1: '简约',
	2: '欧式',
	3: '中式',
	4: '田园'
};
var lrjd = {
	1: '注重环保',
	2: '装修贷款',
	3: '待收新房'
}

var area_time = {
	1: '≤60天',
	2: '60~70天',
	3: '≤70天',
	4: '80~90天',
	5: '≥90天'
};
var lrjd_one = {
	1: '2次免费检测',
	2: '0首付&nbsp;&nbsp;0抵押&nbsp;&nbsp;0手续费',
	3: '免费新房验收'
}
var jzlr = {
	1: '<p>加班狗最佳装修方案</p><p>装修管家已经为全国10000+用户提供过服务，成功帮助用户从装修痛苦中解脱！</p>',
	2: '<p>门外汉也有捷径</p><p>装修管家已经为全国10000+用户提供过服务，只为装修质量负责！</p>',
	3: '<p>不如找个专业靠谱的，解放自己，省心装修</p><p>装修管家已经为全国10000+用户提供过服务，并为2000+别墅用户监管装修！</p>'
};
var wmbn_1 = {
	1: '全程7*24小时服务&nbsp;&nbsp;&nbsp;&nbsp;10次上门服务&nbsp;&nbsp;&nbsp;&nbsp;21个服务节点日志',
	2: '297项报价审核&nbsp;&nbsp;&nbsp;&nbsp;198个施工节点验收&nbsp;&nbsp;&nbsp;&nbsp;108项材料验收',
	3: '金牌管家全程服务&nbsp;&nbsp;&nbsp;&nbsp;24小随时解决问题'
};
var wmbn_2 = {
	1: '环保服务：2次免费环保&nbsp;&nbsp;，竣工与入住前双保障',
	2: '贷款服务：0首付0抵押&nbsp;&nbsp;，0手续费&nbsp;&nbsp;，门槛低',
	3: '公益验房：免费新房验收'
};
var choose_lrsx = 0,
	choose_area = 0,
	choose_style = 0,
	choose_lrjd = 0;
$(function(){

	$('#lrsx').change(function(){
		var _this = $(this);
		var add_bg = $('.add-bg');
		choose_lrsx = _this.val();
		if(choose_lrsx == 1){
			add_bg.removeClass('ren-mang ren-bu ren-qian').addClass('ren-mang');
		} else if(choose_lrsx == 2){
			add_bg.removeClass('ren-mang ren-bu ren-qian').addClass('ren-bu');
		} else {
			add_bg.removeClass('ren-mang ren-bu ren-qian').addClass('ren-qian');
		}
		mapObj(jzlr, choose_lrsx, '.center-jzlr');
		mapObj(wmbn_1, choose_lrsx, '.wmbn-1');
	});

	$('#area').change(function(){
		var _this = $(this);
		choose_area = _this.val();
		mapObj(area_time, choose_area, '.content-3');

	});

	$('#style').change(function(){
		var _this = $(this);
		choose_style = _this.val();
	});

	$('#lrjd').change(function(){
		var _this = $(this);
		choose_lrjd = _this.val();

		var title_2 = $('.title-2');
		var content_2 = $('.content-2');
		if(choose_lrjd == 2){
			title_2.html('报价审核');
			content_2.html('2次报价审核，不花冤枉钱');
		} else {
			title_2.html('资金安全');
			content_2.html('满意后在付款');
		}

		mapObj(lrjd, choose_lrjd, '.title-1');
		mapObj(lrjd_one, choose_lrjd, '.content-1');
		mapObj(wmbn_2, choose_lrjd, '.wmbn-2');
	});

	$('.select-btn').on('click', function(){
		var _this = $(this);
		if(choose_lrsx == 0 || choose_area == 0 || choose_style == 0 || choose_lrjd == 0){
			$('.error-info').show();

			setTimeout(function(){
			    $('.error-info').hide();
			}, 2000);
		} else {
			_this.parents('.form-one').hide();
			$('.form-two').show();
		}
	});

	$('.go-back').on('click', function(){
		var _this = $(this);
		_this.parents('.form-two').hide();
		$('.form-one').show();
	});



	var oScrollTop = 0;
	$('#free-btn').on('click', function(){
		oScrollTop = document.body.scrollTop;
		document.body.scrollTop = 0;
		$(".footer_menu_bs").hide();
		$('.amount_house_mask_bs').add('.in_info_bs').show();
		$("#errorCue").css({'top':0});
		$(document).on('touchmove',Endmove);


	});
	$('.in_info_close_bs').on('click', function(){
		$('.amount_house_mask_bs').hide();
		$('.in_info_bs').hide();
		$(document).off('touchmove',Endmove);
		document.body.scrollTop = oScrollTop;
		$(".footer_menu_bs").show();
		return false;
	});
	$(document).on('click','#layer-close',function(){
		$(".amount_house_mask_bs").hide();
		$(".in_info_bs").hide();
		$(document).off('touchmove',Endmove);
		$(".footer_menu_bs").show();
	});

});

function mapObj(obj, val, el){
	for(var key in obj){
		if(val == key){
			$(el).html(obj[key]);
		}
	}
}
