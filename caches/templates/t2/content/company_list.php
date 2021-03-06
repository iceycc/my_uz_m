<?php defined('IN_WZ') or exit('No direct script access allowed'); ?><!doctype html>
<html>
<head>
<meta name="viewport" content="width=device-width,minimum-scale=1.0,maximum-scale=1.0, minimal-ui"/>
<meta content="yes" name="apple-mobile-web-app-capable">
<!--iphone桌面快捷方式图标<link rel="apple-touch-icon" href="custom_icon.png">-->
<meta charset="utf-8">
<meta name="keywords" content="装修管家,量房设计,装修施工,材料商城,环保方案,装修服务,装修图库,建材商城,装修攻略、优装网、装修网、优装美家">
<meta name="description" content="优装美家为您提供免费专业咨询、免费量房、免费设计、免费装修保险、免费环保检测、优装网-专业装修网优选装修公司、优选建材商品、优选装修管家、优选环保服务">
<title>优装美家_让装修从此不烦•不凡_优装网-专业装修网</title>
<link rel="stylesheet" type="text/css" href="<?php echo R;?>msite/base/css/base.css">
<link rel="stylesheet" type="text/css" href="<?php echo R;?>msite/company/css/company-list.css">
</head>
<body>
<div id='share_logo' style='margin:0 auto;display:none;'> 
  <img src="<?php echo R;?>msite/base/img/share_logo.jpg"/> 
</div>
<header>
	<a id="go-back" target="_self" title="优装美家"><i class="iconfont icon-goback"></i></a>
	<!-- <div class="city">
		<a href="##" class="current-city">北京<i class="iconfont icon-xiajiantou"></i></a>
	</div> -->
	<h1 class="header-title">口碑公司</h1>
	<div id="menu" title="菜单"> <i class="iconfont icon-cedaohang"></i></div>
</header>
<!--Menu Start-->
<section id="right-menu">
	<div class="sidebar-bg"></div>
	<aside id="sidebar">
        <ul class="sidebar-ul">
            <li>
                <a href="mobile-cases.html" class="link-a"><i class="iconfont icon-tuku"></i><p>精品案例</p><i class="iconfont icon-arrow"></i></a>
            </li>
            <li>
                <a href="##" class="link-a"><i class="iconfont icon-koubei"></i><p>口碑公司</p><i class="iconfont icon-arrow"></i></a>
            </li>
            <!-- <li>
                <a href="##" class="link-a"><i class="iconfont icon-gongdi"></i><p>工地直播</p><i class="iconfont icon-arrow"></i></a>
            </li> -->
            <li>
                <a href="mobile-user_home.html" class="link-a"><i class="iconfont icon-shejishi"></i><p>我的美家</p><i class="iconfont icon-arrow"></i></a>
            </li>
        </ul>
        <a id="apply" href="mobile-application.html?id=M站-菜单页">我要装修</a>
        <a id="bottom-tel" href="tel:400-6171-666"><i class="iconfont icon-dianhua"></i><span class="telephone">400-6171-666</span></a>
    </aside>
</section>
<!--Menu End-->
<!--Company Start-->
<section id="company-list-page" class="container">
	<ul id="company-list">
<!--    	<li class="company-li clearfix">
        	<img class="company-logo" src="">
            <div class="txt">
            	<h2 class="company-name">恩博（北京）建筑装饰有限公司</h2>
                <h3 class="tag">#上市公司</h3>
                <div class="data">
                	<div class="works">案例：<span class="number">20</span></div>
                	<div class="designers">设计师：<span class="number">8</span></div>
                	<div class="total">综合评分：<span class="number">5.0</span></div>
                </div>
            </div>
        </li>-->
        
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
                            <div class="total">综合评分：<span class="number"><%=item.avg_total%></span></div>
                        </div>
                    </div>
                </li>
            <% } %>
        </script>
        
    </ul>
</section>
<!--Company End-->
<section class="bottom">
	<a href="javascript:scroll(0, 0)"><i id="goTop" class="iconfont icon-fanhuidingbu"></i></a>
</section>
<script src="<?php echo R;?>msite/base/js/zepto.min.js"></script>
<script src="<?php echo R;?>msite/base/js/underscore-template.js"></script>
<script src="<?php echo R;?>msite/base/js/base.js"></script>
<script src="<?php echo R;?>msite/company/js/company_list.js"></script>
<script>
var _hmt = _hmt || [];
(function() {
var hm = document.createElement("script");
hm.src = "//hm.baidu.com/hm.js?78dc231309600aa470786dd036953521";
var s = document.getElementsByTagName("script")[0];
s.parentNode.insertBefore(hm, s);
})();
</script> 
<div style="display:none">  
	<script type="text/javascript">
        var _bdhmProtocol = (("https:" == document.location.protocol) ? " https://" : " http://");
        document.write(unescape("%3Cscript src='" + _bdhmProtocol + "hm.baidu.com/h.js%3Fb5fdc578640695ab74da0b40389ac54e' type='text/javascript'%3E%3C/script%3E"));
    </script>
</div>
</body>
</html>