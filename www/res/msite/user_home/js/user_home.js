// User home
var user_data,
	favor_designer,
	class_resault,
	butler_data,
	wait_data,
    mySiteData;
var nodeLogo = {
    "10": "iconfont icon-yuyueliangfangs",
    "11": "iconfont icon-liangfang",
    "12": "iconfont icon-dingdanshenhes",
    "15": "iconfont icon-yixiangdingjins",
    "17": "iconfont icon-yujiaodiss",
    "19": "iconfont icon-qiandingsanfanghetongs",
    "21": "iconfont icon-kaigongyishis",
    "25": "iconfont icon-shuidianyanshous",
    "27": "iconfont icon-shuidiangcyanshous",
    "29": "iconfont icon-wamuyanshous",
    "28": "iconfont icon-fangshuigcyanshous",
    "31": "iconfont icon-wamugongchengyanshous",
    "33": "iconfont icon-youqicailiaoyanshous",
    "35": "iconfont icon-youqiyanshous",
    "36": "iconfont icon-anzhuangyanshous",
    "37": "iconfont icon-jungongs",
    "39": "iconfont icon-huanbaojiances",
    "45": "iconfont icon-weibaoss",
    "43": "iconfont icon-dablebaojiances",
    "49": "iconfont icon-huanbaozhiliss",
    "51": "iconfont icon-huanbaozhilifuces",
    "1": "iconfont icon-dingdanshenhes",
    "0": "iconfont icon-dingdanshenhes",
    "2": "iconfont icon-jingxuangongsis",
    "9": "iconfont icon-zhidingguanjias",
    "101": "iconfont icon-yuyuejianmian",
    "102": "iconfont icon-jianmian"
}

var wait_config = {
	"waitLink":{
		"1":"mobile-check_accep.html",
        "2":"mobile-wait_pay.html",
        "3":"mobile-score.html",
	},
	"waitIcon":{
        "1":"iconfont icon-wdgd_dys",
        "2":"iconfont icon-wdgd_dzf",
        "3":"iconfont icon-wdgd_dpj",
	},
	"waitName":{
        "1":"待验收",
        "2":"待支付",
        "3":"待评价",
	}
}
$(function(){
	personalInfo();
	$('#my-live').on('click', function(e){
		var _this = $(this);
		var header_title = _this.find('.title-name').text();
		$('.show-box').addClass('slideIn');
		$('.show-title').text(header_title);
		$('#order-box').show();
		bindData();
	});
	$('#my-like').on('click', function(e){
		var _this = $(this);
		var header_title = _this.find('.title-name').text();
		$('.show-box').addClass('slideIn');
		$('.show-title').text(header_title);
		$('#my-favor').show();

		showTab();
		personalCollectCases();
		getCompany();
		getDesigner();
		getLive();
		//装修课堂
		getclassroom();
		//装修管家
		getButler();
		//收藏套餐
        getPackage();
	});
	$('#my-news').on('click', function(e){
		var _this = $(this);
		var header_title = _this.find('.title-name').text();
		$('.show-box').addClass('slideIn');
		$('.show-title').text(header_title);
		$('#my-news-box').show();

		getNews();
	});

	$('.goback').on('click', function(){
		$('.show-box').removeClass('slideIn');
		$('#order-box').add('#my-favor').add('#my-news-box').hide();
		window.location.reload();
	});
	$("#logout").bind("click",logout);

	//待验收、待评价、待支付
    getWaitItem();
})

function personalInfo(){
	$.ajax({
		type: "POST",
		url: "/index.php?m=wap&f=member&v=index",
		dataType: "json",
		timeout: 3000,
		success: function(res){
			if(res && res.code == 1){
				console.log(res)
				var data = res.data;
				solveTemplate("#user-inform", "#user-inform-data", data);
				if(data.news > 0){
					$('.news-num').show().text(data.news);
				}
			}else{
				window.location.href = "mobile-login.html?user_home=1";
			}
		},
		error: function(XMLHttpRequest, textStatus){
			console.log('error');
		}
	});
}

//我的工地

function bindData() {
	$.ajax({
		type: "POST",
		url: "/index.php?m=wap&f=member_lognew&v=log_list",
		dataType: "json",
		timeout: 3000,
		success: function(res){
			console.log(res)
			if(res.code == 0){
				noAll(res.message, "#order-box");
			}
			if(res.code == 1){
                mySiteData = res.data;
				solveTemplate("#order_list", "#order-data", mySiteData);
				$(".order-days").each(function(){
					if($(this).children("b").text() == "未开工"){
						$(this).css("color", "#999");
					}
				});
				$(".local-name h3").each(function(){
					var str = $(this).text();
					if(str.length > 11){
						var newStr = str.substr(0, 11)+"...";
						$(this).text(newStr);
					}
				});
			}
		},
		error: function(XMLHttpRequest, textStatus){
			console.log('error');
		}
	});
}

//案例收藏
function personalCollectCases(){
	$.ajax({
		type: "POST",
		url: "index.php?m=wap&f=member&v=photos",
		dataType: "json",
		timeout: 3000,
		success: function(res){
			console.log(res)
			if(res && res.code == 1){
				solveTemplate("#content-now", "#content-now-data", res);

				var number = $("#content-now .content-li").length;
				$("#total-number").text(number);

				$("#works-list").bind("click", function(){
					$(".lazy-img").dxLazyLoad();
					imgLoaded();
				});
			}
		},
		error: function(XMLHttpRequest, textStatus){
			console.log('error');
		}
	});
}

function showTab(){
	$(".slide-tag").on("click", function(event){
		var number = $(this).find(".number").html()*1;
		if(number == 0){
			return;
		}
		$(this).toggleClass("slide-down");
		$(this).next(".slide_content").toggle();
	});
}

function getCompany(){
	$.ajax({
		type: "POST",
		url: "index.php?m=wap&f=member&v=company",
		dataType: "json",
		timeout: 3000,
		success: function(data){
			if(data.code == 1)
			{
				user_data = data.data;
				solveTemplate("#company-list", "#company-list-template", data.data);
			}
		},
		error: function(XMLHttpRequest, textStatus){
			console.log('error');
		}
	});
}

function getDesigner(){
	$.ajax({
		type: "POST",
		url: "index.php?m=wap&f=member&v=design",
		dataType: "json",
		timeout: 3000,
		success: function(data){
			console.log(data)
			if(data.code == 1)
			{
				favor_designer = data.data;
				solveTemplate("#designer-list", "#company-designer-template", favor_designer);
			}
		},
		error: function(XMLHttpRequest, textStatus){
			console.log('error');
		}
	});
}

function logout() {
	$.ajax({
		type: "POST",
		url: "index.php?m=wap&f=password&v=logout",
		dataType: "json",
		timeout: 3000,
		success: function(data){
			if(data.code == 1)
			{
				window.location.href = "mobile-index.html"
			}
		},
		error: function(XMLHttpRequest, textStatus){
			console.log('error');
		}
	});
}

// 收藏的工地
function getLive() {
	$.ajax({
		type: "POST",
		url: "/index.php?m=wap&f=member&v=day_log",
		dataType: "json",
		timeout: 3000,
		success: function(res){
			console.log(res)
			if(res && res.code == 1) {
				var data = res.data;
				solveTemplate("#live-list", "#live-list-data", res);
				var number = $("#live-list .list-li").length;
				$("#live-number").text(number);
				$(".lazy-img").dxLazyLoad();
			}
		},
		error: function(XMLHttpRequest, textStatus){
			console.log(textStatus)
		}
	});
}

//获取装修课堂信息
function getclassroom(){
	$.ajax({
		type: "POST",
		url: "/index.php?m=wap&f=member&v=decorate_class",
		dataType: "json",
		success: function(res) {
			if(res.code == 1) {
				console.log(res);
				data = res.data;
				solveTemplate("#classroom-list", "#classroom-list-template", res);

				setStr('.story-h3', 46); // 业主故事描述
				setStr('.same-h3', 24); // 装修攻略、装修风水、家装选材标题
				setStr('.same-p', 58); // 装修攻略、装修风水、家装选材描述
			}
		},
		error: function(XMLHttpRequest){
			console.log('error');
		}
	});
}

//获取收藏管家
function getButler(){
	$.ajax({
		type: "POST",
		url: "/index.php?m=wap&f=member&v=steward",
		dataType: "json",
		success: function(res) {
			console.log(res);
			if(!res.code)return false;
			butler_data = res.data;
			solveTemplate("#butler-listdata", "#butler-listdata-template", butler_data);
			$('#favor-butler #butler-number').html(butler_data.length);
		},
		error: function(XMLHttpRequest){
			console.log('error');
		}
	});
}

// 获取收藏套餐
function getPackage() {
    $.ajax({
        type: "POST",
        url: "index.php?m=wap&f=package&v=my_collect_package",
        dataType: "json",
        success: function(data) {
            if(data.code == 1)return false;
            console.log(data)

            solveTemplate("#meal-list", "#meal-list-template", data);
            $('#favor-meal #taocan-number').html(data.data.length);
            $("#meal-list").bind("click", function(){
                $(".lazy-img").dxLazyLoad();
                imgLoaded();
            });
        },
        error: function(XMLHttpRequest){
            console.log('error');
        }
    });
}

// 获取我的消息
function getNews(){
	$.ajax({
		type: 'GET',
		url: '/index.php?m=wap&f=member_lognew&v=message',
		dataType: 'json',
		timeout: 3000,
		success: function(res){
			console.log(res)
			if(res.code == 0) {
				noAll(res.message, "#my-news-box");
			}
			if(res.code == 1) {
				solveTemplate("#news-content", "#news-data", res);

				$('.words-len').each(function(){
					var _this = $(this);
					var len = 0;
					var fir_str = _this.find('.common-len').text();
					var sec_str = _this.find('.live-name').text();
					var third_str = _this.find('.detail-new').text();

					var total_str = fir_str + sec_str + third_str;
					var two_len = fir_str.length + sec_str.length;
					var total_len = fir_str.length + sec_str.length + third_str.length;

					if(total_len > 39){
						var new_str = total_str.substring(two_len, 40);
						_this.find('.detail-new').text(new_str + '...');
					}
				})
			}
		},
		error: function(XMLHttpRequest){
			console.log('error');
		}
	});
}
//去除视频广告
function YKadvertis(src){
	player = new YKU.Player('youkuplayer',{ 
		styleid: '0',
		client_id: '3cd17f251dc3cedd',
		vid: src,
		newPlayer: true
	});
}

function setStr(selector, len) {
	$(selector).each(function(){
		var _this = $(this);
		var text = _this.text();

		_this.text(setString(text, len));
	});
}
//在线支付
function getWaitItem() {
    $.ajax({
        type: "POST",
        url: "/index.php?m=wap&f=member&v=get_new_reminder",
        dataType: "json",
        timeout: 3000,
        success: function(res){
            console.log(res);
            wait_data = res.data;
            solveTemplate("#my_pay_list", "#my-wait", butler_data);
        },
        error: function(XMLHttpRequest, textStatus){
            console.log('error');
        }
    });
}