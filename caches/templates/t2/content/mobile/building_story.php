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
<link href="<?php echo R;?>msite/base/css/swiper.min.css" rel="stylesheet" type="text/css">
<link href="<?php echo R;?>msite/base/css/base.css" rel="stylesheet" type="text/css">
<link href="<?php echo R;?>msite/building_classroom/css/building_story.css" rel="stylesheet" type="text/css">
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
	<h1 class="header-title">业主故事</h1>
</header>

<!-- 视频轮播 S -->
<section id="index-banner">
	<ul id="banner-box" class="swiper-wrapper">
    	<!-- <li class="swiper-slide">
        	<img class="banner-img" src="<?php echo R;?>msite/building_classroom/img/story_img.jpg" alt="视频封面">
			<div class="c_video" id="youkuplayer">
		    	<iframe src='http://player.youku.com/embed/XMTc2NzkzOTk2NA==' frameborder=0 allowfullscreen></iframe>
		    </div>
        </li> -->
    </ul>
    <div class="swiper-pagination"></div>
</section>
<!-- 视频轮播 E -->

<!-- 业主故事 S -->
<section class="story-list" id="story-box">
	<!-- <ul>
		<li>
			<a href="#">
				<div class="story-box">
					<img src="<?php echo R;?>msite/building_classroom/img/story_img.jpg" alt="业主故事封面图" />
					<div class="ceng-box">
						<h3>80后花10万爆改160㎡破厂房！80后圆烘焙梦</h3>
						<p>2016-08-18</p>
					</div>
				</div>
			</a>
		</li>
	</ul> -->
</section>
<!-- 业主故事 E -->
<script type="text/template" id="video-data">
	<% for(var i=0;i<video.length; i++) { %>
		<% var item = video[i] %>
		<% var newT = encodeURIComponent(item.title) %>
		<li class="swiper-slide">
			<div class="video-img">
				<a href="/mobile-play_video.html?videourl=<%= item.url %>&title=<%= newT %>&id=<%= item.id %>">
					<img src="<%= item.thumb %>" alt="视频封面图" />
					<i class="play_btn"></i>
				</a>
			</div>
			<!-- <div class="c_video" id="youkuplayer">
		    	<iframe src="<%= item.url %>" frameborder=0 allowfullscreen></iframe>
		    </div> -->
        </li>
	<% } %>
</script>

<script type="text/template" id="art-data">
	<% for(var i=0;i<arr.length; i++) { %>
		<% var item = arr[i] %>
		<li>
			<a href="<%= item.url %>&pid=gs">
				<div class="story-box">
					<img src="<%= item.thumb %>" alt="业主故事封面图" />
					<div class="ceng-box">
						<h3 class="story-h3"><%= item.title %></h3>
						<p><%= item.addtime %></p>
					</div>
				</div>
			</a>
        </li>
	<% } %>
</script>
<script type="text/javascript" src="http://player.youku.com/jsapi"></script>
<script type="text/javascript" src="<?php echo R;?>msite/base/js/zepto.min.js"></script>
<script type="text/javascript" src="<?php echo R;?>msite/base/js/jquery-1.8.3.min.js"></script>
<script type="text/javascript" src="<?php echo R;?>msite/base/js/swipe.js"></script>
<script type="text/javascript" src="<?php echo R;?>msite/base/js/swiper.jquery.min.js"></script>
<script type="text/javascript" src="<?php echo R;?>msite/base/js/underscore.min.js"></script>
<script type="text/javascript" src="<?php echo R;?>msite/base/js/size.js"></script>
<script type="text/javascript" src="<?php echo R;?>msite/base/js/base.js"></script>
<script type="text/javascript" src="<?php echo R;?>msite/building_classroom/js/common.js"></script>
<script type="text/javascript" src="<?php echo R;?>msite/building_classroom/js/building_story.js"></script>
</body>
</html>