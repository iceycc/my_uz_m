$(function(){
	var order_id = getUrlParameter('orderid');
	var node_id = getUrlParameter('nodeid');
	var temp = getUrlParameter('stem');

	getMore();
	function getMore(){
		var url;
		if(temp){
			url = '/index.php?m=wap&f=biz_lognew&v=check_waterdetail';
		} else {
			url = '/index.php?m=wap&f=biz_lognew&v=public_get_checked_item';
		}
		$.ajax({
			type: 'POST',
			url: url,
			data: {orderid: order_id, nodeid: node_id},
			dataType: 'json',
			timeout: 3000,
			success: function(res){
				console.log(res)
				solveTemplate("#table-box", "#check-data", res);
			}
		});
	}
});