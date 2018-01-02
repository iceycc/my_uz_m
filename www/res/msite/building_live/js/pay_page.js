$(function(){

var order_id = getUrlParameter('order_id');
getPayInfo()

function getPayInfo(){
	$.ajax({
		type: 'GET',
		url: '/index.php?m=wap&f=member_lognew&v=pay&order_id='+order_id,
		dataType: 'json',
		timeout: 3000,
		success: function(res){
			console.log(res)
			var data = res.data;
			$('.header-title').html('支付进度（<span id="node-num">'+data.molecule+'</span>/'+data.denominator+'）');

			solveTemplate("#pay-box", "#pay-data", data);

			$('.blue-active').last().css('border-color', '#d8d8d8');

			solveTemplate("#big-pic-content", "#big-pic-data", data.node[0]);
			showBigPic();
		},
		error: function(XMLHttpRequest){
			console.log('error');
		}
	});
};

function showBigPic(){
	$(".link-bimg").click(function(){

		// var caseDom = $("#case-info"),
		var	docH = $(document).height(),
			winH = $(window).height(),
			winW = $(window).width();
		var index = parseInt($(this).attr("index"));
		$('.pic-info').height(winH);
		$('.pic-local').width(winW);
		// caseDom.height(winH);

		// caseDom.css({
		// 	height: winH,
		// 	overflow: "hidden"
		// });
		$("#big-pic").show().css({
			width: winW,
			height: winH,
			overflow: "auto"
		});
		var swipe = new Swipe(document.getElementById('slider'), {
	        speed: 400,
	        startSlide: index-1,
	        callback: function() {
	        	//current index position
	        	var index=this.getPos()+1;
	        	$("#current-number").text(index);
				// preLoadImg(index);
	        }
	    });
	    //初始化
	    $("#current-number").text(swipe.getPos()+1);
	    //total index position
	    $("#total-number").text(swipe.getLength());
		$('.pic-info').each(function(){
            new RTP.PinchZoom($(this), {});
        });

        $(".go-back").click(function(){
        	var headerH = $("header").height(),
        		btmH = $(".bottom-btn").height();
        	$("#big-pic").hide();
        	// caseDom.height(docH-headerH-btmH);

   			//caseDom.css({
			// 	height: "auto",
			// 	overflow: ""
			// });
        });
	});
}
});