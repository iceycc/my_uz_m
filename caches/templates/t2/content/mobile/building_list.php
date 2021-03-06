<?php defined('IN_WZ') or exit('No direct script access allowed'); ?><!doctype html>
<html>
<head>
<meta name="viewport" content="width=device-width,minimum-scale=1.0,maximum-scale=1.0, minimal-ui"/>
<meta content="yes" name="apple-mobile-web-app-capable">
<!--iphone桌面快捷方式图标<link rel="apple-touch-icon" href="custom_icon.png">-->
<META HTTP-EQUIV="Pragma" CONTENT="no-cache">
<META HTTP-EQUIV="Cache-Control" CONTENT="no-cache">
<META HTTP-EQUIV="Expires" CONTENT="0">
	<meta charset="utf-8">
<meta name="keywords" content="优装美家,房屋装修,装修管家,装修工地,装修现场,装修日记">
<meta name="description" content="优装美家装修管家日志频道，为您提供真实的房屋装修管家工作日志，装修工地现场直播、上门量房、油漆材料验收、水电验收、泥木材料验收，让优装的用户清晰了解优装管家服务的每一个环节。">
<title>装修工地现场直播_房屋装修日记_优装美家装修管家日志频道</title>
<link rel="stylesheet" type="text/css" href="<?php echo R;?>msite/base/css/base.css">
<link href="<?php echo R;?>msite/building_live_new/css/building_list.css" rel="stylesheet" type="text/css">
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
    <i id="shaixuan-link" class="iconfont icon-shaixuan"></i>
	
</header>

<section id="sx-box">
	<div id="sx-bg"></div>
	<div id="sx-content">
		<ul class="sx-ul">
			<li status="0" class="sx-li"><a href="mobile-building_list.html">全部</a></li>
			<li status="2" class="sx-li"><a href="mobile-building_list.html?status=2">装修前</a></li>
			<li status="3" class="sx-li"><a href="mobile-building_list.html?status=3">装修中</a></li>
			<li status="4" class="sx-li"><a href="mobile-building_list.html?status=4">装修后(环保)</a></li>
			<!-- <li status="5" class="sx-li">完结</li> -->
		</ul>
	</div>
</section>
<section id="list-container" class="container">
	<ul class="sort-ul">
		<li id="new-sort" status="0" class="sort-li active">最新发布</li>
		<li id="max-sort" status="1" class="sort-li">浏览最多</li>
	</ul>
	<ul id="list-content" class="list-ul">
		<!-- <li class="list-li">
			<div class="manager-info">
				<img src="<?php echo R;?>msite/building_live_new/img/manager-face.png" alt="" class="manager-face" />
				<p class="manager-name">文丑</p>
				<p class="manager-job">管家</p>
				<p class="update-time"><i class="iconfont icon-days"></i><span>6小时前更新</span></p>
			</div>
			<div class="building-box">
				<img src="<?php echo R;?>msite/building_live_new/img/building-img.jpg" alt="效果图">
				<a href="##" class="building-info">
					<div class="info-div">
						<h3>泥木验收</h3>
						<span>绣菊园吕先生家装修日志绣菊园吕先生家装修</span>
						<p>
							<span>20.2万</span>
							<span>100㎡</span>
							<span>两居</span>
							<span>全包</span>
						</p>
					</div>
					<div class="look-write-num">
						<p><i class="iconfont icon-eyes"></i><span>1230</span></p>
						<p><i class="iconfont icon-pinglun"></i><span>596</span></p>
					</div>
				</a>
			</div>
		</li> -->
	</ul>
</section>
<div class="down-page">加载中...</div>
<section class="bottom">
	<a href="javascript:scroll(0, 0)"><i id="goTop" class="iconfont icon-fanhuidingbu"></i></a>
</section>
<script type="text/template" id="list-data">
	<% for(var key in arr) { %>
		<% var item = arr[key] %>
		<li class="list-li" building-id="<%= item.orderid %>">
			<div class="manager-info">
				<a href="mobile-m_butler_details.html?id=M站-工地直播&butlerid=<%= item.uid %>">
					<img class="manager-face" src=<%= item.personalphotos %>>
					<% if(item.level == '金牌管家'){ %>
						<i class="jp-manager"></i>
					<% } %>
				</a>
				<p class="manager-name"><%= item.gjname %></p>
				<% if(item.level){ %>
					<p class="manager-job"><%= item.level %></p>
				<% } %>
				<p class="update-time"><i class="iconfont icon-days"></i><span><%= item.addtime %></span></p>
			</div>
			<div class="building-box">

				<% if(item.comparison_photo) { %>
					<div style="display: block;" class="lazy-dable clearfix">
						<div class="lazy_dable_l fl">
							<img class="lazy-img"  data-original="<%= item.comparison_photo.attach1 %>" >
							<div class="lazy-title lazy-l-t">装修前</div>
						</div>
						<div class="lazy_dable_r fr">
							<div class="lazy-title lazy-r-t">装修后</div>
							<img class="lazy-img"  data-original="<%= item.comparison_photo.attach2 %>" >
						</div>
					</div>
				<% }else{ %>
					<% if(item.log_photo) { %>
						<img class="lazy-img"  data-original=<%= item.log_photo %>>
					<% } else { %>
						<img class="lazy-img"  data-original="<?php echo R;?>msite/building_live_new/img/cover.jpg" >
					<% } %>
				<% } %>
				<% if(item.log_exist == 0) {%>
					<a style="display: block;" class="building-info" href="mobile-live_detail.html?live_id=<%= item.orderid %>">
						<div class="info-div">
							<% if(item.nodename) { %>
								<h3><%= item.nodename %></h3>
							<% } %>
							<% if(item.logname) { %>
								<span><%= item.logname %></span>
							<% } %>
							<p>
								<% if(item.budget) { %>
									<span><%= item.budget %></span>
								<% } %>
								<% if(item.area) { %>
									<span><%= item.area %>㎡</span>
								<% } %>
								<% if(item.homestyle[0]) { %>
									<span><%= item.homestyle[0] %></span>
								<% } %>
								<% if(item.way[0]) { %>
									<span><%= item.way[0] %></span>
								<% } %>
							</p>
						</div>
						<div class="look-write-num">
							<p><i class="iconfont icon-eyes"></i><span><%= item.browse_count %></span></p>
							<p><i class="iconfont icon-pinglun"></i><span><%= item.message %></span></p>
						</div>
					</a>
				<% } %>
				<% if(item.log_exist == 1) {%>
					<a class="building-info" href="mobile-live_detail.html?live_id=<%= item.orderid %>&myself=1">
						<div class="info-div">
							<% if(item.nodename) { %>
								<h3><%= item.nodename %></h3>
							<% } %>
							<% if(item.logname) { %>
								<span><%= item.logname %></span>
							<% } %>
							<p>
								<% if(item.budget) { %>
									<span><%= item.budget %></span>
								<% } %>
								<% if(item.area) { %>
									<span><%= item.area %>㎡</span>
								<% } %>
								<% if(item.homestyle[0]) { %>
									<span><%= item.homestyle[0] %></span>
								<% } %>
								<% if(item.way[0]) { %>
									<span><%= item.way[0] %></span>
								<% } %>
							</p>
						</div>
						<div class="look-write-num">
							<p><i class="iconfont icon-eyes"></i><span><%= item.browse_count %></span></p>
							<p><i class="iconfont icon-pinglun"></i><span><%= item.message %></span></p>
						</div>
					</a>
				<% } %>
			</div>
		</li>
	<% } %>
</script>
<script type="text/javascript" src="<?php echo R;?>msite/base/js/zepto.min.js"></script>
<script type="text/javascript" src="<?php echo R;?>msite/base/js/underscore-template.js"></script>
<script type="text/javascript" src="<?php echo R;?>msite/base/js/base.js"></script>
<script type="text/javascript" src="<?php echo R;?>msite/base/js/imageLoad.js"></script>
<script type="text/javascript" src="<?php echo R;?>msite/base/js/dxlazyload.js"></script>
<script type="text/javascript" src="<?php echo R;?>msite/building_live_new/js/building_list.js"></script>
</body>
</html>