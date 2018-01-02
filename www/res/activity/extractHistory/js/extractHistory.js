// wushi 2017-03-03 edit

$(function(){
	var tempUid = getCookie('tj_id');
	//var tempUid=123456;
	getCard(tempUid);
	
	
});

//getCard
function getCard(i){
	$.ajax({
		type: "POST",
		//http://m.uzhuang.com/index.php?m=wap&f=index&v=index
		//http://m.uzhuang.com/index.php?m=zx_recommended&f=extract_money&v=extract_history&uid=123456
		url: "index.php?m=zx_recommended&f=extract_money&v=extract_history&uid="+i,
		dataType: "json",
		timeout: 3000,
		success: function(data){
			console.log(i);
			//
			if(data.code == 1)
			{
				
				var cardInfo = data.data;
				console.log(cardInfo);	
				solveTemplate("#container", "#each_template", cardInfo);
				
			}
			//
			$(".infoMod .fail_btn").live("tap", function (event) {
				$(this).addClass("no");
				$(this).parents(".infoMod").siblings(".error").addClass("yes");
			}); 
			//
		},
		error: function(XMLHttpRequest, textStatus){
			if(textStatus == "timeout"){
				reLoad("body");
			}
		}
	});
}

//


