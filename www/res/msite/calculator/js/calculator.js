

(function($) {
	
	//functionName03 S
	$.fn.calculationFun = function(opt){
		
		//
		var defaults = {
				baseNum: 1
			};
		//	
		var opt = $.extend(defaults, opt);//将opt加入到defaults
		$(this).addClass("bor");
		//
		for(var i=0; i<opt.cityInfo.areaRatio.length; i++) {  
              
           // alert(opt.cityInfo.areaRatio[i].imgsrc);  
        }
		//
		//
		var cityidArray = new Array();
		var citynameArray = new Array();
		var dataArray = new Array();
		var cityTotal;
		//获得cityID S
		$.ajax({
				type: "POST",
				dataType: "json",
				url: "/api/mmwap.php?action=fbcity",
				cache: false,
				success: function(dataResult) {
					if (dataResult) {
						//
						var province = dataResult.data;
						for (var key in province) {
								cityidArray[key] = province[key].lib;
								citynameArray[key] = province[key].name;
												
								//console.log(cityidArray[key]);		
						}
						//
						cityTotal = cityidArray.length;
					}
					main()
					
				},
				error: function(XMLHttpResponse) {
					console.log(XMLHttpRequest.status);
					console.log(XMLHttpRequest.readyState);
					console.log(textStatus);
					
				}
		 });
		
		//获得cityID E
		//main S
		function main(){
			
			
			var n;
			var temp_base;
			console.log("默认基数："+opt.baseNum);
			
			//确定城市id
			for( var i=0; i<cityTotal; i++){
				if( opt.cityID_selected == cityidArray[i]){
					console.log("选中城市name:"+citynameArray[i]);
					var temp_base = opt.cityInfo.cityBase[i]*opt.baseNum;
					//console.log("城市基数："+temp_base);
					
				}				
			}
			//确定居室
			if( opt.areaTotal < 60 ){
				 var n = 0;
				 console.log("60以下"); console.log(n); 
			}
			else if( 60 <= opt.areaTotal && opt.areaTotal < 80 ){
				 var n = 1;
				 console.log("60-80"); console.log(n); 
			}
			else if( 80 <= opt.areaTotal && opt.areaTotal < 120 ){
				 var n = 2;
				 console.log("80-120"); console.log(n); 
			}
			else if( 120 <= opt.areaTotal && opt.areaTotal <= 160 ){
				 var n = 3;
				 console.log("120-160"); console.log(n); 
			}
			else if( opt.areaTotal > 160 ){
				 var n = 4;
				 console.log("160以上"); console.log(n); 
			}
			else{ console.log("56565"); }
			//
			
			console.log("总面积："+opt.areaTotal);
			console.log("城市总数："+cityTotal);
			console.log("选中城市ID："+opt.cityID_selected);
			
			
			//console.log("面积系数："+opt.cityInfo.areaRatio[n].ratio[5]);
			//console.log("面积系数："+opt.cityInfo.areaRatio[n].ratio[0]);
			//空间费用
			var area_len = opt.cityInfo.areaRatio[n].ratio.length;
			var totalSpace = new Number();
			console.log("area长度："+area_len);
			for( var m = 0; m < area_len; m++){
				//var a = 25.564;
				//console.log(a.toFixed(2));
				//a.toFixed(2);
				//console.log("城市基数2："+temp_base);
				var temp_area = opt.areaTotal * opt.cityInfo.areaRatio[n].ratio[m] ;
				var temp_unitPrice = temp_base * opt.cityInfo.unitPrice[n].price[m];
				var temp_spacePrice = temp_area.toFixed(2)* temp_unitPrice.toFixed(2);
				dataArray[m] = Math.round(temp_spacePrice);
				console.log(dataArray[m]);
				console.log("数据类型："+typeof(dataArray[m]));
				$("#unitPrice li").eq(m).find(".num").html(dataArray[m]);
				totalSpace = totalSpace + dataArray[m];
				console.log("空间总价："+totalSpace);
				
				//total += dataArray[m];
				//console.log("总价："+typeof(dataArray[m]) );
				
				//console.log("area:"+temp_area);
				//console.log("radio:"+temp_unitPrice);
				//console.log("面积系数："+opt.cityInfo.areaRatio[n].ratio[m]);
				//console.log("单价："+opt.cityInfo.unitPrice[n].price[m]);
			}
			
			//管理费
			var price_len = opt.cityInfo.unitPrice[n].price.length;
			console.log("price长度："+price_len);
			
			var unitFees = (temp_base * opt.cityInfo.unitPrice[n].price[price_len-1]).toFixed(2);
			console.log("一平米管理费："+unitFees);
			
			var totalFees = Math.round(opt.areaTotal * unitFees);
			console.log("总管理费："+totalFees);
			$("#unitPrice li").eq(price_len-1).find(".num").html(totalFees);
			//总价
			var totalPrice = (totalSpace + totalFees)/10000;
			console.log("装修预算："+totalPrice.toFixed(1));
			$("#totalPrice").html(totalPrice.toFixed(1));
			//console.log("个数："+opt.cityInfo.areaRatio[n].ratio.length);
			
			//console.log("单价："+opt.cityInfo.unitPrice[n]);
			
			//opt.areaTotal * opt.cityInfo.areaRatio[n].bedRoom ;
			
			//opt.cityInfo.unitPrice[n].bedRoom * opt.cityInfo.cityBase[i] * opt.baseNum;
			
			
			// var bedPrice = opt.cityInfo.areaRatio[n].bedRoom * opt.cityInfo.unitPrice[n].bedRoom ;
			
			
			/*console.log("第三个城市name："+citynameArray[2]);
			console.log("第三个城市ID："+cityidArray[2]);
			
			console.log("城市基数："+opt.cityInfo.cityBase[0]);
			console.log("面积系数："+opt.cityInfo.areaRatio[1].imgsrc);
			console.log("单价："+opt.cityInfo.unitPrice[2].imgsrc);*/
		}
		//main E
	}
	//functionName03 E
	
})(Zepto);