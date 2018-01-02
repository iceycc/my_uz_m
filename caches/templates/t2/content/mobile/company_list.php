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
<link rel="stylesheet" type="text/css" href="<?php echo R;?>msite/company/css/company-list.css">
<style>
#footer {
	position: fixed;
    bottom: 0;
    left: 0;
}
#footer.setstatic {
	position: static;
}
</style><div style="display:none">
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
	<h1 class="header-title">口碑公司</h1>
	
</header>

<!--Company Start-->
<section id="company-list-page" class="container">
	<ul id="company-list">
		<script type="text/template" id="company-list-template">
            <% for(var i=0; i<companys_data.length; i++){ %>
                <% var item = companys_data[i] %>
                <li class="company-li clearfix">
                    <img class="company-logo" src=<%=item.companylogo%>>
                    <div class="txt">
                        <h2 class="company-name"><%=item.title%></h2>
                        <h3 class="tag"><%=item.tese%></h3>
                        <div class="data">
                            <div class="works">案例：<span class="number"><%=item.photonum%></span></div>
                            <div class="designers">设计师：<span class="number"><%=item.designnum%></span></div>
                            <div class="score_total">综合评分：<span class="number"><%=item.avg_total%></span></div>
                        </div>
                    </div>
					<a class="company_link" href=<%="mobile-company_detail.html?company_id="+item.id%>>&nbsp;</a>
                </li>
            <% } %>
        </script>
    </ul>
</section>
<!--Company End-->
<!--Footer Start-->
<footer id="footer">
    <ul class="platforms">
        <li class="active"><a href="mobile-index.html"><cite class="iconfont icon-shouji"></cite>触屏版</a></li>
        <li class="vline"></li>
        <li><a href="http://www.uzhuang.com/index.php?from=wap"><cite class="iconfont icon-diannao"></cite>电脑版</a></li>
        <li class="vline"></li>
        <li><a href="mobile-about_us.html"><cite class="iconfont icon-guanyuwomen"></cite>关于我们</a></li>
    </ul>
    <p class="company-name">北京优装网信息科技有限公司<br>京ICP备15022586号-1</p>
</footer>
<!--Footer End-->
<script src="<?php echo R;?>msite/base/js/zepto.min.js"></script>
<script src="<?php echo R;?>msite/base/js/underscore-template.js"></script>
<script src="<?php echo R;?>msite/base/js/base.js"></script>
<script src="<?php echo R;?>msite/company/js/company_list.js"></script>
</body>
</html>