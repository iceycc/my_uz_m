<?php defined('IN_WZ') or exit('No direct script access allowed'); ?><!doctype html>
<html>
<head>
<meta name="viewport" content="width=device-width,minimum-scale=1.0,maximum-scale=1.0, minimal-ui"/>
<meta content="yes" name="apple-mobile-web-app-capable">
<!--iphone桌面快捷方式图标<link rel="apple-touch-icon" href="custom_icon.png">-->
<meta charset="utf-8">
<meta name="keywords" content="装修管家,量房设计,装修施工,材料商城,环保方案,装修服务,装修图库,建材商城,装修攻略、优装网、装修网、优装美家">
<meta name="description" content="优装美家为您提供免费专业咨询、免费量房、免费设计、免费装修保险、免费环保检测、优装网-专业装修网优选装修公司、优选建材商品、优选装修管家、优选环保服务">
<title>优装美家—管家式装修服务 有品质的低价</title>
<link rel="stylesheet" type="text/css" href="<?php echo R;?>msite/base/css/base.css">
<link href="<?php echo R;?>msite/building_live_water/css/building_list.css" rel="stylesheet" type="text/css">
<link href="<?php echo R;?>/msite/index/css/post_form.css" rel="stylesheet" type="text/css">
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
	<!-- <div class="city">
		<a href="##" class="current-city">北京<i class="iconfont icon-xiajiantou"></i></a>
	</div> -->
	<h1 class="header-title">工地直播</h1>
	
</header>
<section id="list-container" class="container">
	
	<!-- <ul id="list-content" class="list-ul">
		<li class="list-li">
			<div class="manager-info">
				<img src="<?php echo R;?>msite/building_live_water/img/manager-face.png" alt="" class="manager-face" />
				<p class="manager-name">文丑</p>
				<p class="manager-job">管家</p>
				<p class="update-time"><i class="iconfont icon-days"></i><span>6小时前更新</span></p>
			</div>
			<div class="building-box">
				<img src="<?php echo R;?>msite/building_live_water/img/building-img.jpg" alt="效果图">
				<a href="##" class="building-info"><div class="info-div"><h3>泥木验收</h3><span>绣菊园吕先生家装修日志绣菊园吕先生家装修</span></div></a>
			</div>
		</li>
	</ul> -->
</section>
<div class="down-page">加载中...</div>
<section class="bottom">
	<a href="javascript:scroll(0, 0)"><i id="goTop" class="iconfont icon-fanhuidingbu"></i></a>
</section>
<script type="text/template" id="list-data">
	<% for(var key in arr) { %>
		<% var item = arr[key] %>
		<li class="list-li">
			<div class="manager-info">
				<img class="manager-face" src=<%= item.personalphotos %>>
				<p class="manager-name"><%= item.gjname %></p>
				<p class="manager-job">管家</p>
				<p class="update-time"><i class="iconfont icon-days"></i><span><%= item.addtime %></span></p>
			</div>
			<div class="building-box">
				<% if(item.sitephoto) { %>
				  <img class="lazy-img"  data-original=<%= item.sitephoto %>>
				<% } else { %>
				  <% if(item.recphoto == 1) { %>
				  	<img class="lazy-img"  data-original="<?php echo R;?>msite/building_live_water/img/cover.jpg" >
				  <% } else { %>
				  	<img class="lazy-img"  data-original=<%= item.recphoto %>>
				  <% } %>
				<% } %>
				<% if(item.log_exist == 0) {%>
					<a class="building-info" href="mobile-live_detail.html?live_id=<%= item.orderid %>"><div class="info-div"><h3><%= item.nodename %></h3><span><%= item.logname %></span></div></a>
				<% } %>
				<% if(item.log_exist == 1) {%>
					<a class="building-info" href="mobile-live_detail.html?live_id=<%= item.orderid %>&myself=1"><div class="info-div"><h3><%= item.nodename %></h3><span><%= item.logname %></span></div></a>
				<% } %>
			</div>
		</li>
	<% } %>
</script>
<script type="text/javascript" src="<?php echo R;?>msite/base/js/zepto.min.js"></script>
<script type="text/javascript" src="<?php echo R;?>msite/base/js/underscore-template.js"></script>
<script type="text/javascript" src="<?php echo R;?>msite/base/js/base.js"></script>
<script type="text/javascript" src="<?php echo R;?>msite/base/js/dxlazyload.js"></script>
<script type="text/javascript" src="<?php echo R;?>msite/building_live_water/js/building_list.js"></script>
</body>
</html>