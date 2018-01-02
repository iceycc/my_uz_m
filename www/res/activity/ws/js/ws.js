// Index data

var current_cityid = 3360;  //Default City id

$(function(){
	
	getIndex();

	//Bind button Events
	
});

//Show a Picture in Weibo Page


//Get Activity Data
function getIndex(){
	$.ajax({
		type: "POST",
		//http://m.uzhuang.com/index.php?m=wap&f=index&v=index
		url: "index.php?m=wap&f=index&v=index",
		dataType: "json",
		timeout: 3000,
		success: function(data){
			if(data.code == 1)
			{
				//console.log(data);
				index_data = data.data;
				located = data.data.init.ktcity;
				//console.log(index_data);
				//console.log(located);
				
				//solveTemplate("#active-list", "#index-active-template", index_data);
				solveTemplate("#choose-city", "#index-located-template", located);
				solveTemplate("#container", "#each_template", located);
				

			}
		},
		error: function(XMLHttpRequest, textStatus){
			if(textStatus == "timeout"){
				reLoad("body");
			}
		}
	});
}



function solveTemplate(contentId, tplId, data){
	//console.log(contentId);
	//console.log(tplId);
	//console.log(data);
	//_.template
	
	var content = $(contentId),
	 tpl = $(tplId).html(),
	
	 roundFun = _.template(tpl),
	 html = roundFun(data);
	
	content.html(html);
	console.log(content);
	
    	
}


