<?php defined('IN_WZ') or exit('No direct script access allowed'); ?><!DOCTYPE html>
<html lang="en">
<head>
<meta name="viewport" content="width=device-width,minimum-scale=1.0,maximum-scale=1.0, minimal-ui"/>
<meta content="yes" name="apple-mobile-web-app-capable">
<!--iphone桌面快捷方式图标<link rel="apple-touch-icon" href="custom_icon.png">-->
<meta charset="utf-8">
<meta name="keywords" content="装修管家,量房设计,装修施工,材料商城,环保方案,装修服务,装修图库,建材商城,装修攻略、优装网、装修网、优装美家">
<meta name="description" content="优装美家为您提供免费专业咨询、免费量房、免费设计、免费装修保险、免费环保检测、优装网-专业装修网优选装修公司、优选建材商品、优选装修管家、优选环保服务">
<title>优装美家—管家式装修服务 有品质的低价</title>
<link href="<?php echo R;?>msite/base/css/base.css" rel="stylesheet" type="text/css">
<link href="<?php echo R;?>msite/building_classroom/css/building_fs.css" rel="stylesheet" type="text/css">
<div style="display:none">
    <script>
    var _hmt = _hmt || [];
    (function() {
      var hm = document.createElement("script");
      hm.src = "//hm.baidu.com/hm.js?0a9b93e0ac9bdda145e2d4f6ffa88ee5";
      var s = document.getElementsByTagName("script")[0];
      s.parentNode.insertBefore(hm, s);
    })();
    </script>
</div>
</head>
<body>
<div id='share_logo' style='margin:0 auto;display:none;'>
  <img src="<?php echo R;?>msite/base/img/share_logo.jpg"/>
</div>
<header>
	<div class="tit_minu">
        <a id="go-back" target="_self" title="优装美家">
            <i class="iconfont icon-goback"></i>
        </a>
        <a class="back_index" href="mobile-index.html">首页</a>
    </div>
	<h1 class="header-title">装修风水</h1>
</header>
<section class="banner">
	<img src="<?php echo R;?>msite/building_classroom/img/fs_banner.jpg" alt="banner图" />
</section>

<!-- 装修风水 S -->
<section class="building-list" id="fs-box">
	<!-- <ul>
		<li>
			<a href="#">
				<div class="img-box">
					<img src="<?php echo R;?>msite/building_classroom/img/list_img.jpg" alt="攻略图" />
				</div>
				<div class="word-box">
					<h3>装修管家15年经验总结 收房...</h3>
					<p>房屋装修分为硬装和软装，前者决定房屋质量而后者却是决定房屋美观与否的</p>
				</div>
			</a>
		</li>
	</ul> -->
</section>
<!-- 装修风水 E -->
<div class="down-page">加载中...</div>

<script type="text/template" id="fs-data">
	<% for(var i=0; i<arr.length; i++){ %>
		<% var item = arr[i] %>
		<li>
			<a href="<%= item.url %>&pid=fs">
				<div class="img-box">
					<img src="<%= item.thumb %>" alt="攻略图" />
				</div>
				<div class="word-box">
					<h3 class="same-h3"><%= item.title %></h3>
					<p class="same-p"><%= item.remark %></p>
				</div>
			</a>
		</li>
	<% } %>
</script>

<script type="text/javascript" src="<?php echo R;?>msite/base/js/zepto.min.js"></script>
<script type="text/javascript" src="<?php echo R;?>msite/base/js/underscore.min.js"></script>
<script type="text/javascript" src="<?php echo R;?>msite/base/js/size.js"></script>
<script type="text/javascript" src="<?php echo R;?>msite/base/js/base.js"></script>
<script type="text/javascript" src="<?php echo R;?>msite/building_classroom/js/common.js"></script>
<script type="text/javascript">
$(function(){
	getInfo();
	$(window).bind("scroll", function() {
		scrollPages(getInfo);
	});
});

var page = 1; //初始页数
function getInfo() {
	isLoading = false;
	var content = '<ul id=page'+page+'></ul>'; // 存储数据
	$("#fs-box").append(content);
	$.ajax({
		type: 'GET',
		url: '/index.php?m=wap&f=zxkt_index&v=zx_geomantic_list&page=' + page,
		dataType: 'json',
		timeout: 3000,
		success: function(res) {
			console.log(res)
			if(res && res.code == 1) {
				var data = res.data;

				totalPage = data.page_max;
				solveTemplate("#page"+page, "#fs-data", data);
				docH = $(document).height();
				if(totalPage <= 1){
					$(".down-page").remove();
				}
				isLoading = true;
				page++;

				setStr('.same-h3', 24);
				setStr('.same-p', 58);
			}
		},
		error: function() {
			console.log('error');
		}
	});
}
</script>
</body>
</html>