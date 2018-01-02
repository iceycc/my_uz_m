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
<link href="<?php echo R;?>msite/building_classroom/css/red_list.css" rel="stylesheet" type="text/css">
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
	<h1 class="header-title">家装红宝书</h1>
</header>

<h3 class="list-title">目录</h3>
<!-- 红宝书列表 S -->
<section id="red-box" class="red-sec">
	<!-- <div class="red-list">
		<h3><span>【第一章：施工准备】</span><i class="iconfont icon-slidearrow"></i></h3>
		<ul class="ul-list">
			<li><a href="#"><span>1</span><p>装修施工流程（准备工作、装修流程、注意事项）</p></a></li>
			<li><a href="#"><span>2</span><p>装修注意事项（装修时间、新旧房区别）</p></a></li>
			<li><a href="#"><span>3</span><p>施工承包方式（全包、半包、包清工）</p></a></li>
			<li><a href="#"><span>4</span><p>预算报价审核（报价合理性、常用数据测量与计算）</p></a></li>
		</ul>
	</div> -->
</section>
<!-- 红宝书列表 E -->
<script type="text/template" id="red-data">
	<% for(var key in data){ %>
		<% var items = data[key] %>
		<div class="red-list">
			<h3 class="red-title"><span>【<%= items.name %>】</span><i class="iconfont icon-slidearrow"></i></h3>
			<ul class="ul-list">
			<% for(var i=0; i<items.cid.length; i++){ %>
				<% var item = items.cid[i] %>
				<li><a index="<%= item.id %>" class="link-a" href="<%= item.url %>&pid=m"><p class="same-p"><%= item.title %></p></a></li>
			<% } %>
			</ul>
		</div>
	<% } %>
</script>
<script type="text/javascript" src="<?php echo R;?>msite/base/js/zepto.min.js"></script>
<script type="text/javascript" src="<?php echo R;?>msite/base/js/underscore.min.js"></script>
<script type="text/javascript" src="<?php echo R;?>msite/base/js/size.js"></script>
<script type="text/javascript" src="<?php echo R;?>msite/base/js/base.js"></script>
<script type="text/javascript" src="<?php echo R;?>msite/building_classroom/js/common.js"></script>
<script type="text/javascript" src="<?php echo R;?>msite/building_classroom/js/red_list.js"></script>
</body>
</html>