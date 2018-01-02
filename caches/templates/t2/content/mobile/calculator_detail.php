<?php defined('IN_WZ') or exit('No direct script access allowed'); ?><!DOCTYPE html>
<html lang="en">
<head>
	<meta name="viewport" content="width=device-width,minimum-scale=1.0,maximum-scale=1.0, minimal-ui"/>
    <meta content="yes" name="apple-mobile-web-app-capable">
    <!--iphone桌面快捷方式图标<link rel="apple-touch-icon" href="custom_icon.png">-->
    <meta charset="utf-8">
    <meta property="qc:admins" content="50304154552051676375" />
    <meta name="keywords" content="装修管家,量房设计,装修施工,材料商城,环保方案,装修服务,装修图库,建材商城,装修攻略、优装网、装修网、优装美家">
    <meta name="description" content="优装美家为您提供免费专业咨询、免费量房、免费设计、免费装修保险、免费环保检测、优装网-专业装修网优选装修公司、优选建材商品、优选装修管家、优选环保服务">
	<title>优装美家—计算器</title>
	<link rel="stylesheet" type="text/css" href="<?php echo R;?>msite/base/css/base.css">
	<link rel="stylesheet" href="<?php echo R;?>msite/calculator_new/css/calculator_detail.css" />

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
    <h1 class="header-title">优装美家</h1>
    <!-- <i class="iconfont icon-fenxiang1"></i> -->
</header>
<section class="top-info clearfix">
	<div class="pad-style">
		<div class="total-money">
			<p><span id="totalMoney">0</span>元</p>
			<p>您的半包装修预算约</p>
		</div>
	</div>
</section>
<section>
	<ul class="tab-ul" id="detail-box">
		<!--<li class="tab-li">
			<p class="clearfix"><span>其他</span><span>¥0</span><i class="iconfont icon-slidearrow"></i></p>
			<div class="table-box">
				<table>
					<tr>
						<th>项目名称</th>
						<th>工程量</th>
						<th>单价</th>
						<th>总价（元）</th>
					</tr>
					<tr>
						<td>地面成品砂浆找平</td>
						<td>17.2㎡</td>
						<td>35.00</td>
						<td>603</td>
					</tr>
					<tr>
						<td>铲除墙面腻子层</td>
						<td>17.2㎡</td>
						<td>35.00</td>
						<td>603</td>
					</tr>
					<tr>
						<td>墙面刮腻子</td>
						<td>17.2㎡</td>
						<td>35.00</td>
						<td>603</td>
					</tr>
					<tr>
						<td>铲除天花腻子层</td>
						<td>17.2㎡</td>
						<td>35.00</td>
						<td>603</td>
					</tr>
					<tr>
						<td>天花刷乳胶漆</td>
						<td>17.2㎡</td>
						<td>35.00</td>
						<td>603</td>
					</tr>
					<tr>
						<td>门套打底</td>
						<td>1套</td>
						<td>35.00</td>
						<td>603</td>
					</tr>
				</table>
			</div>
		</li> -->
	</ul>
</section>
<section id="similar-cases">
	<!-- <div class="similar-title">
		<div class="width-line"></div>
		<h3>查看相似装修案例</h3>
	</div>
	<ul>
		<li class="similar-li">
			<a href="">
				<div class="similar-cover"><img class="similar-img" src="<?php echo R;?>msite/calculator_new/img/serviceMod.jpg" alt="" /></div>
				<div class="similar-info">
					<img src="<?php echo R;?>msite/calculator_new/img/serviceMod.jpg" alt="" class="designer-face" />
					<div>
						<p class="similar-case-name">style厅映仟象映画签映签仟象映画签映签</p>
						<p class="designer-name">徐庶</p>
					</div>
				</div>
			</a>
		</li>
	</ul> -->
</section>
<section class="share-tip">
	<div class="share-box"><span class="Iknow"></span></div>
</section>
<script type="text/template" id="detail-data">
	<% for(var key in data){ %>
		<li class="tab-li">
			<p class="clearfix"><span><%= key %></span><span>¥<%= data[key].total %></span><i class="iconfont icon-slidearrow"></i></p>
			<div class="table-box">
				<table>
					<tr>
						<th>项目名称</th>
						<th>工程量</th>
						<th>单价</th>
						<th>总价（元）</th>
					</tr>
					<% for(var i=0; i<data[key].data.length; i++){ %>
						<% var item = data[key].data[i] %>
						<tr>
							<td><%= item.project %></td>
							<td><%= item.area %></td>
							<td><%= item.unit_price %></td>
							<td><%= item.total_price %></td>
						</tr>
					<% } %>
				</table>
			</div>
		</li>
	<% } %>
</script>
<script type="text/template" id="cases-data">
	<div class="similar-title">
		<div class="width-line"></div>
		<h3>查看相似装修案例</h3>
	</div>
	<ul>
	<% for(var i=0; i<similar.length; i++){ %>
		<% var item = similar[i] %>
		<li class="similar-li">
			<a href="mobile-detail_case.html?id=<%= item.id%>">
				<div class="similar-cover"><img class="similar-img" src="<%= item.cover %>" alt="" /></div>
				<div class="similar-info">
					<img src="<%= item.thumb %>" alt="" class="designer-face" />
					<div>
						<p class="similar-case-name"><%= item.name %></p>
						<p class="designer-name"><%= item.dname %></p>
					</div>
				</div>
			</a>
		</li>
	<% } %>
	</ul>
</script>
<script src="<?php echo R;?>msite/base/js/zepto.min.js"></script>
<script src="<?php echo R;?>msite/base/js/underscore.min.js"></script>
<script src="<?php echo R;?>msite/base/js/base.js"></script>
<script src="<?php echo R;?>msite/calculator_new/js/calculator_detail.js"></script>
</body>
</html>