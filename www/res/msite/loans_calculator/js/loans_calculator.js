$(function(){

	$(window).on("scroll", scrollFn);

	function scrollFn(){
		var sTop = document.body.scrollTop;  //滚动距离
		var formTop = $('.form-box').offset().top + $('.form-box').height();  //表单距离上边距的距离

		if(sTop > formTop) {
			$('.bottom-link').show();
		} else {
			$('.bottom-link').hide();
		}
	}

	//建行
	$('#jh-apply-sub').on('click', function(){
		getResult(0.0038, 500000);
	})

	//苏宁
	$('#sn-apply-sub').on('click', function(){
		getResult(0.006, 200000);
	})

	//阳光互信
	$('#yghx-apply-sub').on('click', function(){
		getResult(0.005, 200000);
	})

	function getResult(interest, max){
		var input_num = $('#money-num').val();
		var time_num = $('#loans-date').val();
		var time_text = $('#loans-date').find('option').not(function(){return !this.selected}).text();

		if(input_num == '') {
			alertOpen('请输入贷款金额');
			return false;
		}

		if(input_num <= 0) {
			alertOpen('贷款金额要0元以上');
			return false;
		}

		if(input_num > max) {
			alertOpen('贷款金额不能超过'+(max/10000)+'万');
			return false;
		}

		var one_re_money = (parseFloat(input_num/time_num) + parseFloat(input_num * interest)).toFixed(2);
		var total_money = parseFloat(input_num) + parseFloat(input_num * interest * time_num);

		$('#result-money').text(one_re_money + '元');
		$('#loans-money').text(input_num + '元');
		$('#return-money').text(total_money + '元');
		$('#loans-time').text(time_text);

		$('.one-con').hide().siblings('.two-con').show();
		$('.close-btn').on('click', function(){
			$(this).parents('.two-con').hide().siblings('.one-con').show();
		})
	}

	function alertOpen(str) {
		var alert_tag = '<section id="alert-layer"><div id="layer-content"><p id="alert-con"></p><p class="auto-close">好</p></div></section>';
		if($("#alert-layer"))
		{
			$("#alert-layer").remove();
		}
		$(alert_tag).appendTo("body");
		// $("#alert-layer").height(docH);
		$("#alert-con").text(str);

		$(".auto-close").on("click", function(){
			$("#alert-layer").remove();
		});
	}
});