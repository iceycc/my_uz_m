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
	<link rel="stylesheet" type="text/css" href="<?php echo R;?>msite/base/css/base.css">
	<link rel="stylesheet" type="text/css" href="<?php echo R;?>msite/building_live_new/css/check_detail.css">

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
<header>
	<div class="tit_minu">
        <a id="go-back" target="_self" title="优装美家">
            <i class="iconfont icon-goback"></i>
        </a>
        <a class="back_index" href="mobile-index.html">首页</a>
    </div>
	<h1 class="header-title">验收明细—<span id="node-name">水电工程验收</span></h1>
</header>
<section>
	<table class="content-table" id="table-box">
		<!-- <tr class="title-tr"><th>验收项明细</th><th>结果</th></tr>
		<tr>
			<td>坐便器安装，包括固定方式，积水软管和排水。不得是用水泥固定底座</td>
			<td><i class="iconfont icon-duigou"></i></td>
		</tr> -->
	</table>
</section>
<script type="text/template" id="check-data">
	<tr class="title-tr"><th>验收项明细</th><th>结果</th></tr>
	<% for(var i=0;i<data.length; i++){ %>
		<tr>
			<td><%= data[i] %></td>
			<td><i class="iconfont icon-duigou"></i></td>
		</tr>
	<% } %>
</script>
<script type="text/javascript" src="<?php echo R;?>msite/base/js/zepto.min.js"></script>
<script type="text/javascript" src="<?php echo R;?>msite/base/js/underscore-template.js"></script>
<script type="text/javascript" src="<?php echo R;?>msite/base/js/base.js"></script>
<script type="text/javascript" src="<?php echo R;?>msite/building_live_new/js/check_detail.js"></script>
</body>
</html>