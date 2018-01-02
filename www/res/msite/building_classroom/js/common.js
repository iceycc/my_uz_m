//滑动状态, 当前页数
var isLoading = true,
	totalPage = 0,
	docH = 0,
	winH = $(window).height();

//优酷视频去广告
function hideAd(vid){
	player = new YKU.Player('youkuplayer' ,{
		styleid: '0',
		client_id: '3cd17f251dc3cedd',
		vid: vid,
		newPlayer: true
	});
}

// 阻止默认行为
 function stopDefault(e) {
 	e.preventDefault();
 }

 // 截取字符串
function setStr(selector, len) {
	$(selector).each(function(){
		var _this = $(this);
		var text = _this.text();

		_this.text(setString(text, len));
	});
}

function scrollPages(fn){
	var pageH = $(".down-page").height();
	var sTop = document.body.scrollTop + 100;
	if(pageH + sTop >= docH - winH && isLoading){
		if(page <= totalPage){
			fn();
		}else{
			$(".down-page").hide();
		}
	}
}