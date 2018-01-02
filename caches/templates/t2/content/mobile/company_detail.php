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
<link href="<?php echo R;?>msite/base/css/base.css" rel="stylesheet" type="text/css">
<link href="<?php echo R;?>msite/base/css/case_base.css" rel="stylesheet" type="text/css">
<link href="<?php echo R;?>msite/company/css/company-detail.css" rel="stylesheet" type="text/css">
<link href="<?php echo R;?>msite/designer/css/designer-list.css" rel="stylesheet" type="text/css">
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
<!--Top Bar Start-->
<header>
    <!--<a id="logo" href="##" target="_self" title="优装美家"><i class="iconfont icon-jingyu"></i></a>--> 
    <div class="tit_minu">
        <a id="go-back" target="_self" title="优装美家">
            <i class="iconfont icon-goback"></i>
        </a>
        <a class="back_index" href="mobile-index.html">首页</a>
    </div>
	<!-- <div class="city">
		<a href="##" class="current-city">北京<i class="iconfont icon-xiajiantou"></i></a>
	</div> -->
	<h1 class="header-title">口碑公司</h1>
</header>

<!--Top Bar End-->

<!--Main Content Start-->
<section id="company-detail" class="container">
	<!--Company Head Start-->
	<div id="company-head" class="clearfix">
    	<script type="text/template" id="company-head-template">
			<img src=<%=companys_data.company.companylogo%>>
			<div class="right">
				<h1 class="company-name"><%=companys_data.company.title%></h1>
				<h2 class="company-tag"><%=companys_data.company.tese%></h2>
				<div class="btns">
					<a id="apply-btn" href="mobile-sale_price.html">预约</a>
					<a id="favor-btn" href="javascript:"><span id="favor-star" class="icon-star_one iconfont"></span><span class="txt">收藏</span></a>
				</div>
			</div>
		</script>
    </div>
    <!--Company Head End-->
    <!--Score Start-->
    <div id="company-score">
    	<div id="total">
        	<p id="total-score"></p>
            <h3>综合评分</h3>
        </div>
        <ul id="other-score">
        	<li id="design-level">
            	<h3>设计水平：</h3>
                <ul id="design-star" class="stars">
                	<li class="star">
                    	<span class="icon-star_two iconfont yellow"></span>
                        <span class="icon-star_two iconfont gray"></span>
                    </li>
                	<li class="star">
                    	<span class="icon-star_two iconfont yellow"></span>
                        <span class="icon-star_two iconfont gray"></span>
                    </li>
                    <li class="star">
                    	<span class="icon-star_two iconfont yellow"></span>
                        <span class="icon-star_two iconfont gray"></span>
                    </li>
                    <li class="star">
                    	<span class="icon-star_two iconfont yellow"></span>
                        <span class="icon-star_two iconfont gray"></span>
                    </li>
                    <li class="star">
                    	<span class="icon-star_two iconfont yellow"></span>
                        <span class="icon-star_two iconfont gray"></span>
                    </li>
                </ul>
                <div id="design-score" class="score"></div>
            </li>
            <li id="service-level">
            	<h3>服务评分：</h3>
                <ul id="service-star" class="stars">
                	<li class="star">
                    	<span class="icon-star_two iconfont yellow"></span>
                        <span class="icon-star_two iconfont gray"></span>
                    </li>
                	<li class="star">
                    	<span class="icon-star_two iconfont yellow"></span>
                        <span class="icon-star_two iconfont gray"></span>
                    </li>
                    <li class="star">
                    	<span class="icon-star_two iconfont yellow"></span>
                        <span class="icon-star_two iconfont gray"></span>
                    </li>
                    <li class="star">
                    	<span class="icon-star_two iconfont yellow"></span>
                        <span class="icon-star_two iconfont gray"></span>
                    </li>
                    <li class="star">
                    	<span class="icon-star_two iconfont yellow"></span>
                        <span class="icon-star_two iconfont gray"></span>
                    </li>
                </ul>
                <div id="service-score" class="score"></div>
            </li>
            <li id="quality-level">
            	<h3>施工质量：</h3>
                <ul id="quality-star" class="stars">
                	<li class="star">
                    	<span class="icon-star_two iconfont yellow"></span>
                        <span class="icon-star_two iconfont gray"></span>
                    </li>
                	<li class="star">
                    	<span class="icon-star_two iconfont yellow"></span>
                        <span class="icon-star_two iconfont gray"></span>
                    </li>
                    <li class="star">
                    	<span class="icon-star_two iconfont yellow"></span>
                        <span class="icon-star_two iconfont gray"></span>
                    </li>
                    <li class="star">
                    	<span class="icon-star_two iconfont yellow"></span>
                        <span class="icon-star_two iconfont gray"></span>
                    </li>
                    <li class="star">
                    	<span class="icon-star_two iconfont yellow"></span>
                        <span class="icon-star_two iconfont gray"></span>
                    </li>
                </ul>
                <div id="quality-score" class="score"></div>
            </li>
        </ul>
    </div>
    <!--Score End-->
    <!--About Start-->
    <div id="about-company">
    	<!--Tab Start-->
    	<ul id="company-tab" class="tab-slider">
          <li class="current" target="about-box"><a class="tab" href="javascript:">公司介绍</a></li>
          <li target="design-box" class=""><a class="tab" href="javascript:">设计师</a></li>
          <li id="my-like" target="works-box" class=""><a class="tab" href="javascript:">精品案例</a></li>
        </ul>
        <!--Tab End-->
        <!--About Company Start-->
        <section id="about-box">
        	<script type="text/template" id="company-about-template">
				<div id="location" class="clearfix"><p class="address"><span class="iconfont icon-local"></span>公司地址：<span class="con"><%=companys_data.company.address%></span></p></div>
				<h3>公司简介：</h3>
				<div id="about-content"><%=companys_data.company.content%></div>
			</script>
        </section>
        <!--About Company End-->
        <!--Designer Start-->
        <section id="design-box">
        	<ul id="designer-list" class="clearfix">
				<script type="text/template" id="company-designer-template">
					<% for(var i=0; i<companys_data.design.length; i++){ %>
					<% var item = companys_data.design[i] %>
                    <li>
                        <img class="face" src=<%=item.thumb%>>
                        <div class="right-txt">
                            <h3 class="designer-name"><%=item.title%></h3>
                            <div class="about-designer">
                                <div class="title"><%=item.ranks%></div>
                                <div class="works"><span class="icon-tuku iconfont"></span>作品：<span class="work-number"><%=item.productionnum%></span></div>
                                <div class="follows"><span class="icon-fire iconfont"></span>人气：<span class="follow-number"><%=item.design_collectnum%></span></div>
                            </div>
                        </div>
						<a class="designer-link" <%="href=mobile-designer.html?designer_id="+item.id+"&company_name="+companys_data.company.title%>>&nbsp;</a>
                    </li>
					<% } %>
                </script>
            </ul>
        </section>
        <!--Designer End-->
        <!--Works Start-->
        <section id="works-box">
            <ul id="content-now">
            <script type="text/template" id="works-data">
                <% for (var i=0; i<picture.length; i++){ %>
                    <% var item = picture[i] %>
                    <li class="content-li">
                        <img class="lazy-img" data-original=<%= item.cover%>>
                        <a href=mobile-detail_case.html?id=<%= item.id%> class="content-size"><div><h3><%= item.name%></h3><p>
                        <% for(key in item.style) { %>
                            <span><i class="dian"></i><%= item.style[key]%></span>
                        <% } %>
                        <i class="dian"></i><span><%= item.housetype%></span></p></div></a>
                    </li>
                <% } %>
            </script>
            </ul>
        </section>
        <!--Works End-->
    </div>
    <!--About End-->
</section>
<!--Main Content End-->
<script type="text/javascript" src="http://res.wx.qq.com/open/js/jweixin-1.0.0.js"></script>
<script src="<?php echo R;?>msite/base/js/zepto.min.js"></script>
<script src="<?php echo R;?>msite/base/js/base.js"></script>
<script src="<?php echo R;?>msite/base/js/underscore-template.js"></script>
<script src="<?php echo R;?>msite/base/js/dxTab.js"></script>
<script src="<?php echo R;?>msite/base/js/dxlazyload.js"></script>
<script src="<?php echo R;?>msite/company/js/company_detail.js"></script>

</body>
</html>
