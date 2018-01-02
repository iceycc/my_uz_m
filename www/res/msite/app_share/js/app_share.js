var userId = getUrlParameter("uid");
var questionId = getUrlParameter("qid");

//获取文章所需参数
var aid = getUrlParameter('aid');

var isLoading = true, //ajax请求状态
	page = 1,		  //页数
	totalPage = 0,	  //总页数
	docH = 0;

$(function(){
	if(userId && questionId) {
		getInfo();
		$(window).bind("scroll", scrollPages);
	}

	if(aid) {
		getArt();
	}

	if(browser.versions.weixin){
		$(".download-app").bind("click", function(){
			$(".wx-share").show();
			$(".Iknow").bind('click', function(){
				$(".wx-share").hide();
			});
		});
	}
	if(browser.versions.android){
		$(".download-app").hide();
	}
});
function getInfo(){
	isLoading = false;
	var answerUl = '<ul id=page'+page+' class=answer-content></ul>';
	$("#answer-box").append(answerUl);
	$.ajax({
		type: "POST",
		url: "http://bang.uzhuang.com/index.php?m=bang&f=question&v=details&uid="+userId+"&qid="+questionId+"&page="+page,
		dataType: "json",
		timeout: 3000,
		success: function(res) {
			console.log(res)
			totalPage = res.data1.pages;
			if(totalPage <= 1){
				$(".down-page").remove();
			}
			solveTemplate('#question-box', '#question-data', res);
			solveTemplate('#page'+page, '#answer-data', res);
			docH = $(document).height();
			isLoading = true;
			page++;
		},
		error: function(XMLHttpRequest, textStatus){
			console.log("data error");
		}
	});
}


//获取文章信息
function getArt(){
	if(aid){
		$('#question-box').add('#answer-box').add('.down-page').remove();
		$.ajax({
			type: 'GET',
			url: 'http://bang.uzhuang.com/index.php?m=bangV2&f=ketang&v=nodeDetails&fid='+aid,
			dataType: 'json',
			timeout: 3000,
			success: function(res) {
				console.log(res)
				solveTemplate('#article-box', '#article-data', res);
			},
			error: function(XMLHttpRequest, textStatus){
				console.log("data error");
			}
		});
	}
}

function scrollPages() {
	var pageH = $('.down-page').height();
	var sTop = document.body.scrollTop + 200;
	if(pageH + sTop >= docH - winH && isLoading) {
		if(page <= totalPage) {
			getInfo();
		} else {
			$(".down-page").hide();
		}
	}
}