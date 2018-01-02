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
<link href="<?php echo R;?>msite/about_us/css/about_us.css" rel="stylesheet" type="text/css">
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
	<h1 class="header-title">关于我们</h1>
	
</header>

<section class="container">
	<div class="company-info">
		<h3>公司简介</h3>
		<p class="company-info-p">优装美家是专注于打造家装、家居、家饰垂直细分领域综合电子商务平台，由装饰行业上市龙头企业洪涛股份投资创立，注册资本5000万，致力于以互联网产品为驱动的新型互联网业态，为消费者提供省心、省时、省钱全流程服务。</p>
		<p>中国建筑装饰协会（CBDA）电商深度战略合作伙伴</p>
		<p>中国建筑装饰协会（CBDA）官网家装平台</p>
	</div>
	<div class="contact-us">
		<h3>联系我们</h3>
		<a  class="about-tel" href="tel:400-6171-666"><p>咨询电话：400-6171-666</p></a>
		<p>微信：@优装美家</p>
		<p>微博：@优装美家</p>
		<p>公司地址：北京市西城区宣武门外大街10号庄胜广场中央办公楼南翼19层</p>
	</div>
	<div class="join-us">
		<h3>加入我们</h3>
		<p>简历投递至hr@uzhuang.com</p>
	</div>
  <div class="term-link"><a href="mobile-term.html?about_us=1">《免责声明》</a></div>
</section>
<script type="text/javascript" src="http://res.wx.qq.com/open/js/jweixin-1.0.0.js"></script>
<script type="text/javascript" src="<?php echo R;?>msite/base/js/zepto.min.js"></script>
<script type="text/javascript" src="<?php echo R;?>msite/base/js/base.js"></script>
<script type="text/javascript">
    if(getUrlParameter("isapp") && getUrlParameter("isapp") == 1){
        $("header").remove();
        $(".term-link").remove();
    }
</script>
<script>
	$(function () {
	    //console.log(window.location.href.split("#")[0])
		var HREF = 'http://m.uzhuang.com/mobile-cases.html';
        //var url = encodeURIComponent(window.location.href.split("#")[0]);
		var url = encodeURIComponent(HREF);
        wxShare(url, "gywm", 0);
    });

</script>
</body>
</html>