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
<link href="<?php echo R;?>msite/app_share/css/app_share.css" rel="stylesheet" type="text/css">
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
<section id="article-box" class="app-article">
	<!-- <h3>干了11年装修师傅干货分享，水电改造要这样做！</h3>
	<div class="time-words">
		<span>2016-01-12 19:00</span>
		<p>导语：水电工程是每一家装修的时候都应该特别注重的东西，这一点也是反复强调过的，水电改造对于房子来说是很重要的一步。</p>
	</div>
	<div class="detail-content">
		<p>厨房在水电改造的时候，主要的电器就是水龙头和热水器，而且基本上只要家里面积不是太大，厨房和卫生间都是使用同一个热水器的，所以很关键的就是热水器的安装位置了，确定了它的安装位置，才能进行水路改造。</p>
		<p>厨房在水电改造的时候，主要的电器就是水龙头和热水器，而且基本上只要家里面积不是太大。</p>
		<img src="<?php echo R;?>msite/app_share/img/go_download.png" alt="" />
		<p>厨房在水电改造的时候，主要的电器就是水龙头和热水器，而且基本上只要家里面积不是太大。</p>
		<p>厨房在水电改造的时候，主要的电器就是水龙头和热水器，而且基本上只要家里面积不是太大，厨房和卫生间都是使用同一个热水器的，所以很关键的就是热水器的安装位置了，确定了它的安装位置，才能进行水路改造。</p>
	</div> -->
</section>

<script type="text/template" id="article-data">
	<h3><%= data.title %></h3>
	<div class="time-words">
		<span><%= data.addtime %></span>
		<p><strong>导语：</strong><%= data.remark %></p>
	</div>
	<div class="detail-content">
		<%= data.content %>
	</div>
</script>
<script type="text/javascript" src="<?php echo R;?>msite/base/js/zepto.min.js"></script>
<script type="text/javascript" src="<?php echo R;?>msite/base/js/underscore-template.js"></script>
<script type="text/javascript" src="<?php echo R;?>msite/base/js/base.js"></script>
<script type="text/javascript" src="<?php echo R;?>msite/app_share/js/app_share.js"></script>
</body>
</html>