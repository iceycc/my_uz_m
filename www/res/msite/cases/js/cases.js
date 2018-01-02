$(function(){
	sxSlider();
	goTop();
	if(spacetype){
		getSpaceCases(spacetype);
	} else {
		getCases(styletype, housetype);
	}
	$(window).bind("scroll", scrollPages);
	getSx();

});
var city_id;
if(getUrlParameter('cityid')) {
	city_id = getUrlParameter('cityid');
} else if(getCookie("cityid")) {
	city_id = getCookie("cityid");
} else {
	city_id = 3360;
}

//滑动状态, 当前页数
var isLoading = true,
	page = 1,
	totalPage = 0,
	docH = 0;


var styletype = getUrlParameter("style_status") ? getUrlParameter("style_status"):null;
var housetype = getUrlParameter("house_status") ? getUrlParameter("house_status"):null;
var spacetype = getUrlParameter("space_status") ? getUrlParameter("space_status"):null;

document.cookie = "spaceid="+spacetype;
function sxSlider(){
	var sxLink = $("#shaixuan-link"),
		sxSlide = $("#sx-slide"),
		sxClose = $("#sx-close");

	sxSlide.removeClass("slideIn");
	sxLink.on("click", function(){
		sxSlide.addClass("slideIn");
		// stopScroll("#sx-slide");
	});

	sxClose.on("click", function(){
		sxSlide.removeClass("slideIn");
		// allowScroll();
	});
}

//获取精品案例数据
function getCases(style, house){
	isLoading = false;
	var caseContent = '<ul id=page'+page+'></ul>';
	$("#case-container").append(caseContent);
	$.ajax({
		type: "POST",
		url: "index.php?m=wap&f=biz_photo&v=listing&cityid="+city_id+"&page="+page+"&style="+style+"&house="+house,
		dataType: "json",
		timeout: 3000,
		success: function(res){
			console.log(res)
			if(res && res.code == 1){
				var data = res.data;
				totalPage = data.finalpage;
				solveTemplate("#page"+page, "#case-data", data);
				if(data.tishi){
					noAll(data.tishi, "#case-container");
				}
				docH = $(document).height();
				if(totalPage <= 1){
					$(".down-page").remove();
				}
				scrollimg();
				$(".lazy-img").dxLazyLoad();
				imgLoaded();
				isLoading = true;
				page++;
			}
		},
		error: function(XMLHttpRequest, textStatus){
			console.log(textStatus);
		}
	});
}

function getSpaceCases(space) {
	isLoading = false;
	var caseContent = '<ul id=page'+page+'></ul>';
	$("#case-container").append(caseContent);
	$.ajax({
		type: "GET",
		url: "/index.php?m=wap&f=biz_photo&v=spacelisting&cityid="+city_id+"&space="+space,
		dataType: "json",
		timeout: 3000,
		success: function(res){
			console.log(res);
			if(res && res.code == 1){
				var data = res.data;
				totalPage = data.finalpage;
				solveTemplate("#page"+page, "#spacecase-data", data);
				if(data.tishi){
					noAll(data.tishi, "#case-container");
				}
				docH = $(document).height();
				if(totalPage <= 1){
					$(".down-page").remove();
				}

				//截取字符串
				$(".space-case-name").each(function(){
					var theStr = $(this).html();
					var newStr = setString(theStr, 98);
					$(this).html(newStr);
				});
				scrollimg();
				$(".lazy-img").dxLazyLoad();
				imgLoaded();
				isLoading = true;
				page++;
			}

		},
		error: function(XMLHttpRequest, textStatus){
			console.log(textStatus);
		}
	});
}
//获取筛选数据
function getSx(){
	$.ajax({
		type: "POST",
		url: "index.php?m=wap&f=biz_photo&v=screen",
		dataType: "json",
		timeout: 2000,
		success: function(res){
			console.log(res)
			if(res && res.code == 1){
				var data = res.data;
				solveTemplate("#shaixuan-content", "#sx-data", data);
				item = $("#shaixuan-content a");
				item.each(function(event){
					var _this = $(this);
					if (_this[0].href == String(window.location)){
						_this.addClass('active-style');
						if(spacetype){
							var spaceTitle = _this.text();
							$(".header-title").html(spaceTitle + "案例");
						}
					}
					// sxSlide.removeClass("slideIn");
					// allowScroll();
					// page = 1;
					// $("#case-container ul").remove();
					// $(".down-page").show();

					// $(window).bind("scroll", scrollPages);
				});
			}
		},
		error: function(XMLHttpRequest, textStatus){
			console.log(textStatus);
		}
	});
}

function stopScroll(id){
	$(id).on('touchmove', function(event){
		event.preventDefault();
	})
}
function allowScroll(){
	$('body').css('overflow', '');
}

function scrollPages(){
	var pageH = $(".down-page").height();
	var sTop = document.body.scrollTop + 100;
	if(pageH + sTop >= docH - winH && isLoading){
		if(page <= totalPage){
			if(spacetype){
				getSpaceCases(spacetype);
			} else {
				getCases(styletype, housetype);
			}
		}else{
			$(".down-page").hide();
		}
	}
}


function scrollimg(){
	var case_id = getCookie("caseid");
	$(".case-li").each(function(){
		var this_id = $(this).attr("case-id");
		if(this_id == case_id){
			var headerH = $("header").height();
			var nTop = $(this).offset().top - headerH;
			document.body.scrollTop = nTop;

			document.cookie = "caseid=null"; //删除cookie
		}
	});

}