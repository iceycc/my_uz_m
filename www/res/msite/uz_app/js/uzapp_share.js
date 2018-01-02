// 获取文章id
var uz_id = getUrlParameter("uzid");

// 获取红宝书id
var red_id = getUrlParameter("redid");

// 获取来源页面
var pid = getUrlParameter('pid');

var url = encodeURIComponent(window.location.href.split("#")[0]);
if(pid == 'm') {
	wxShare(url, 'red', red_id);
} else {
	wxShare(url, pid, uz_id);
}
$(function(){
	if(pid) {
		$('header').show().siblings('.app-article').css('padding-top', '3.375rem');
		if(pid == 'gl') {
			$('.header-title').text('装修攻略');
		}
		if(pid == 'gs') {
			$('.header-title').text('业主故事');
		}
		if(pid == 'fs') {
			$('.header-title').text('装修风水');
		}
		if(pid == 'cl') {
			$('.header-title').text('家装选材');
		}

		collectStatus();
		$('.collect').on('click', collect);

		// 红宝书header显示
		if(pid == 'm') {
			$('.app-article').css('padding-bottom', '3.06255rem');
			$('.menu').add('.pre-next').css('display', 'block');
			preNext();
		}
	}
	if(uz_id) {
		$('.watermark').hide();
		getInfo();
	}

	if(red_id) {
		// 禁止复制
		// document.body.onselectstart=document.body.oncontextmenu=function(){return false;};

		getRed();
	}

	if(browser.versions.weixin){
		$(".download-app").bind("click", function(){
			$(".wx-share").show();
			$(".wx-share").on('touchmove', function(e) {
				e.preventDefault();
			});
			$(".Iknow").bind('click', function(){
				$(".wx-share").hide();
				$(".wx-share").off('touchmove', function(e) {
					e.preventDefault();
				});
			});
		});
	}
	if(browser.versions.android){
		$(".download-app").hide();
	}
});
function getInfo(){
	$.ajax({
		type: "GET",
		url: "/index.php?m=zhu_app&f=zxkt_index&v=detail&id="+uz_id,
		dataType: "json",
		timeout: 3000,
		success: function(res) {
			console.log(res)
			solveTemplate('#article-box', '#article-data', res);
			$('img').each(function() {
				var _this = $(this);
				_this.parents('p').css('text-indent', '0 !important');
			})
		},
		error: function(XMLHttpRequest, textStatus){
			console.log("data error");
		}
	});
}


//获取文章信息
function getRed(){
	$.ajax({
		type: 'GET',
		url: '/index.php?m=zhu_app&f=zxkt_index&v=red_detail&id='+red_id,
		dataType: 'json',
		timeout: 3000,
		success: function(res) {
			console.log(res)

			solveTemplate('#article-box', '#red-data', res);

			// window.onload = function() {
			// 	$('.watermark').height($(document).height());
			// }
		},
		error: function(XMLHttpRequest, textStatus){
			console.log("data error");
		}
	});
}

// 上下章
function preNext() {
	$.ajax({
		type: 'GET',
		url: '/index.php?m=wap&f=zxkt_index&v=chapter&id=' + red_id,
		dataType: 'json',
		timeout: 3000,
		success: function(res) {
			console.log(res)
			if(res && res.code == 1) {
				var data = res.data;
				$('.header-title').text(setString(data.title, 12));

				var common_url = $('#menu-link').attr('href');
				$('#menu-link').attr('href', common_url + '?aid=' + red_id);

				if(data.up) {
					$('.pre').show().attr('href', data.up + '&pid=m');
				} else {
					$('.next').css('width', '100%');
				}

				if(data.down) {
					$('.next').show().attr('href', data.down + '&pid=m');
				} else {
					$('.pre').css('width', '100%');
				}
			}
		},
		error: function() {
			console.log('error');
		}
	});
}

// 收藏操作
function collect() {
	$.ajax({
		type: 'GET',
		url: '/index.php?m=wap&f=member&v=fav_decorate_class&type=decorate_class&id=' + uz_id + '&pid=' + pid,
		dataType: 'json',
		timeout: 3000,
		success: function(res) {
			console.log(res)
			if(res) {
				if(res.code == 0) {
					alertConfirm("登录后才能收藏哦，去登录~");
					$("#confirm-layer").on('touchmove', function(event){
						event.preventDefault();
					})
				};
				if(res.code == 1) {
					var data = res.data;
					if(data.collectstatus == 1){
						$(".collect").removeClass("icon-star_one").addClass("icon-star_two");
						collectShow(res.message);
					}
					else{
						$(".collect").removeClass("icon-star_two").addClass("icon-star_one");
						collectShow(res.message);
					}
				}
			}
		}
	});
}

// 收藏状态
function collectStatus() {
	$.ajax({
		type: 'GET',
		url: '/index.php?m=wap&f=zxkt_index&v=collection&id=' + uz_id,
		dataType: 'json',
		timeout: 3000,
		success: function(res) {
			console.log(res)
			if(res && res.code == 1) {
				var data = res.data;
				if(data.collectstatus == 1){
					$(".collect").removeClass("icon-star_one").addClass("icon-star_two");
				}
				else{
					$(".collect").removeClass("icon-star_two").addClass("icon-star_one");
				}
			}
		}
	});
}