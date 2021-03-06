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
<link href="<?php echo R;?>msite/cases/css/detail-case.css" rel="stylesheet" type="text/css">
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
	<h1 class="header-title">精品案例</h1>
	
</header>

<div id="detail-works" class="container">
	<section id="case-info">
		<!-- <div class="marb">
			<div class="case-div">
				<img id="cover-img" src="<?php echo R;?>msite/cases/img/case1.png" alt="效果图">
				<div class="casename-designer">
					<a href="" class="designer-face"><img src="<?php echo R;?>msite/cases/img/face.png" alt="" /></a>
					<h3 class="case-name">暖秋</h3>
				</div>
				<div class="div-ceng"></div>
			</div>
			<div class="detail-info"><span>#三居一厅一卫</span><span>#95㎡</span><span>#地中海</span></div>
		</div>
		<ul class="main">
			<li class="content-li">
				<a href="##" class="link-a"><img src="img/loading_pic.jpg" alt="效果图"></a>
				<div><p class="num">1</p><p class="info">玄关：家里有孩子,而且要孩子有足够的活动空间,在家具  选择上不想过多,尽量精简。</p></div>
			</li>
			<li class="content-li">
				<a href="##" class="link-a"><img src="img/loading_pic.jpg" alt="效果图"></a>
				<div><p class="num">2</p><p class="info">客厅：家里有孩子,而且要孩子有足够的活动空间,在家具  选择上不想过多,尽量精简。</p></div>
			</li>
			<li class="content-li">
				<a href="##" class="link-a"><img src="img/loading_pic.jpg" alt="效果图"></a>
				<div><p class="num">3</p><p class="info">卧室：家里有孩子,而且要孩子有足够的活动空间,在家具  选择上不想过多,尽量精简。</p></div>
			</li>
			<li class="content-li">
				<a href="##" class="link-a"><img src="img/loading_pic.jpg" alt="效果图"></a>
				<div><p class="num">4</p><p class="info">卧室：家里有孩子,而且要孩子有足够的活动空间,在家具  选择上不想过多,尽量精简。</p></div>
			</li>
		</ul>
		<div class="company-info">
			<a class="company-link" href="">
				<img src="<?php echo R;?>msite/cases/img/co_face.png" alt="" class="company-face" />
				<h3 class="company-name">北京绿缘居装饰设计有限公司</h3>
				<p class="company-money">报&nbsp;&nbsp;&nbsp;&nbsp;价：<span>199999</span></p>
			</a>
		</div> -->
	</section>
	<section id="similar-cases">
		<div class="similar-title">
			<div class="width-line"></div>
			<h3>相似案例</h3>
		</div>
		<ul id="similar-content">
			<!-- <li class="similar-li">
				<a href="">
					<img src="cases/img/similar_case_img1.jpg" alt="" />
					<div class="similar-info">
						<img src="cases/img/face.png" alt="" class="designer-face" />
						<div>
							<p class="similar-case-name">style厅映仟象映画签映签仟象映画签映签</p>
							<p class="designer-name">徐庶</p>
						</div>
					</div>
				</a>
			</li> -->
		</ul>
	</section>
	<section id="big-pic">
		<a class="go-back"><i class="iconfont icon-goback"></i></a>
		<div class="page">
	        <div class="pic-local"><span id="current-number" class="num"></span>/<span id="total-number" class="num"></span></div>
	        <div id='slider'>
	            <ul id="big-pic-content">
	                <!-- <li class="single-pic">
	                    <div class="pic-info">
	                        <img src="img/big_img.png" alt="图片">
							<div class="pic-local"><span class="num">1</span>/<span class="num">7</span></div>
	                    </div>
	                </li>
	                <li class="single-pic">
	                    <div class="pic-info">
	                        <img src="img/frog.jpg" alt="图片">
	                    	<div class="pic-local"><span class="num">1</span>/<span class="num">7</span></div>
	                    </div>
	                </li>
	                <li class="single-pic">
	                    <div class="pic-info">
	                        <img src="img/case2.png" alt="图片">
	                    	<div class="pic-local"><span class="num">1</span>/<span class="num">7</span></div>
	                    </div>
	                </li>
	                <li class="single-pic">
	                    <div class="pic-info">
	                        <img src="img/case3.png" alt="图片">
	                    	<div class="pic-local"><span class="num">1</span>/<span class="num">7</span></div>
	                    </div>
	                </li> -->
	            </ul>
			</div>
	    </div>
	</section>
	<section class="bottom-choose">
		<a href="javascript:scroll(0, 0)"><i id="goTop" class="iconfont icon-fanhuidingbu"></i></a>
		<div class="bottom-btn">
			<a id="collect"><i class="iconfont"></i><span>收藏</span></a>
			<a href="mobile-sale_price.html?id=M站-精品案例详情页" class="apply-btn">我想要这样装</a>
		</div>
	</section>
</div>
<script type="text/template" id="detail-data">
	<% for(var i=0; i<picture.length; i++){ %>
		<% var item = picture[i] %>
		<div class="case-div">
			<img id="cover-img" src=<%= item.cover%> alt="效果图">
			<div class="casename-designer">
				<% if(design.thumb1){ %>
					<a class="designer-face" href=mobile-designer.html?designer_id=<%= design.id%>><img src=<%= design.thumb1%> /></a>
				<% }else{ %>
					<a class="designer-face" href=mobile-designer.html?designer_id=<%= design.id%>><img src=<%= design.thumb%> /></a>
				<% } %>
				<h3 class="case-name"><%= item.name%></h3>
			</div>
			<div class="div-ceng"></div>
		</div>
		<div class="detail-info">
			<span>#<%= item.housetype%></span>
			<span>#<%= item.area%>㎡</span>
			<% for(key in item.style) { %>
				<span><i class="dian"></i><%= item.style[key]%></span>
			<% } %>
		</div>
	<% } %>
	<ul class="main">
		<% for(var j=1; j<=hebing.length; j++){ %>
			<% var every = hebing[j-1] %>
			<li class="content-li">
				<a index=<%= j%> class="link-bimg"><img class="loading-pic lazy-img" img-id="<%= every.number %>" data-original=<%= every.photo%>></a>
				<% if(j == hebing.length){ %>
					<div><p class="num"></p><p class="info"><%= every.alt%></p></div>
				<% }else{ %>
					<div><p class="num"><%= j%></p><p class="info"><%= every.alt%></p></div>
				<% } %>
			</li>
		<% } %>
	</ul>
	<div class="company-info">
		<a class="company-link" href=<%="mobile-company_detail.html?company_id="+company.id%>>
			<img  class="company-face" src=<%= company.thumb%>>
			<h3 class="company-name"><%= company.title%></h3>
			<% if(company.total && company.total > 0) { %>
				<p class="company-money">报&nbsp;&nbsp;&nbsp;&nbsp;价：<span><%= company.total%></span>万元</p>
			<% } %>
		</a>
	</div>
</script>
<script type="text/template" id="big-pic-data">
	<% for(var j=1; j<=hebing.length; j++){ %>
		<% var every = hebing[j-1] %>
		<li class="single-pic">
			<div class="pic-info">
				<img class="lazy-bimg" src=<%= every.photo%>>
				<div class="loader"></div>
			</div>
		</li>
	<% } %>
</script>
<script type="text/template" id="similar-data">
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
</script>
<script type="text/javascript" src="http://res.wx.qq.com/open/js/jweixin-1.0.0.js"></script>
<script type="text/javascript" src="<?php echo R;?>msite/base/js/zepto.min.js"></script>
<script type="text/javascript" src="<?php echo R;?>msite/base/js/underscore-template.js"></script>
<script type="text/javascript" src="<?php echo R;?>msite/base/js/swipe.js"></script>
<script type="text/javascript" src="<?php echo R;?>msite/base/js/pinchzoom.min.js"></script>
<script type="text/javascript" src="<?php echo R;?>msite/base/js/base.js"></script>
<script type="text/javascript" src="<?php echo R;?>msite/base/js/dxlazyload.js"></script>
<script type="text/javascript" src="<?php echo R;?>msite/cases/js/detail-case.js"></script>
</html>