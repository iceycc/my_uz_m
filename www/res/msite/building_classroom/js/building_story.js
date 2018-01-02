
var page = 1; //初始页数

$(function() {
	getInfo();
	$(window).bind("scroll", function() {
		scrollPages(getInfo);
	});
});

function getInfo() {
	isLoading = false;
	var content = '<ul id=page'+page+'></ul>'; // 存储数据
	$("#story-box").append(content);
	$.ajax({
		type: 'GET',
		url: '/index.php?m=wap&f=zxkt_index&v=owner_story_list&page=' + page,
		dataType: 'json',
		timeout: 3000,
		success: function(res) {
			console.log(res)
			if(res && res.code == 1) {
				var data = res.data;
				var article = data.article;

				if(page == 1) {
					solveTemplate('#banner-box', '#video-data', data);
				}

				totalPage = article.page_max;
				solveTemplate("#page"+page, "#art-data", article);
				docH = $(document).height();
				if(totalPage <= 1){
					$(".down-page").remove();
				}
				isLoading = true;
				page++;

				var swiper = new Swiper('#index-banner', {
					pagination: '.swiper-pagination',
					loop : true,
					autoplay: 3000,
					paginationClickable: false,
					autoplayDisableOnInteraction : false
				});

				setStr('.story-h3', 46); // 业主故事描述
			}


		},
		error: function() {
			console.log('error');
		}
	});
}