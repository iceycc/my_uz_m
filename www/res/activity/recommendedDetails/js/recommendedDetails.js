// wushi 2017-03-07 edit

$(function(){
	//var tempUid = getCookie('uid');
	//var tempUid = 19591;
	var orderId = getUrlParameter("orderid");
	//var orderId = 888111;
	selectCard(orderId);
	
	
});
//getCard
function selectCard(i){
	$.ajax({
		type: "POST",
		url: "index.php?m=zx_recommended&f=extract_money&v=recommend_detail&orderid="+i,
		dataType: "json",
		timeout: 3000,
		success: function(data){
			if(data.code != 1)return false;
			solveTemplate(".title_masage", "#title_masage_templete", data);
            solveTemplate(".amount_room", "#amount_room_template", data);
            solveTemplate(".signing", "#signing_cont_template", data);
		},
		error: function(XMLHttpRequest, textStatus){
			if(textStatus == "timeout"){
				reLoad("body");
			}
		}
	});
}