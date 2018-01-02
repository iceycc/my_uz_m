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
	<link rel="stylesheet" type="text/css" href="<?php echo R;?>msite/loans_calculator/css/loans_calculator.css">
	<script>
        var _hmt = _hmt || [];
        (function() {
            var hm = document.createElement("script");
            hm.src = "https://hm.baidu.com/hm.js?0a9b93e0ac9bdda145e2d4f6ffa88ee5";
            var s = document.getElementsByTagName("script")[0];
            s.parentNode.insertBefore(hm, s);
        })();
	</script>
</head>
<body>
<div id='share_logo' style='margin:0 auto;display:none;'>
	<img src="<?php echo R;?>msite/base/img/share_logo.jpg"/>
</div>
<header>
	<a id="logo" href="mobile-index.html" target="_self" title="优装美家"><i class="iconfont icon-jingyu"></i></a>
	<h1 class="header-title">建设银行</h1>
</header>
<section class="banner">
	<img src="<?php echo R;?>msite/loans_calculator/img/jh_banner.jpg" alt="banner图" />
</section>
<section class="apply-form">
	<img src="<?php echo R;?>msite/loans_calculator/img/jh_img1.jpg" alt="" />
	<a class="first-btn" href="http://m.uzhuang.com/mobile-template.html?temp=150&id=jsyh">我要贷款</a>
	<div class="jh-form-box form-box">
		<div class="one-con">
			<form>
				<div class="num-box">
					<span>贷款金额</span>
					<input type="number" id="money-num" value="" />
					<span>元</span>
				</div>
				<div class="time-box">
					<span>贷款周期</span>
					<select id="loans-date">
						<option value="12">12期（1年）</option>
						<option value="6">6期（半年）</option>
						<option value="18">18期（1年半）</option>
						<option value="24">24期（2年）</option>
						<option value="36">36期（3年）</option>
						<option value="48">48期（4年）</option>
					</select>
				</div>
				<input type="button" id="jh-apply-sub" class="btn-style" value="算一算" />
			</form>
			<p class="message"><span class="msg-icon"></span>该贷款计算器提供的结果仅供参考</p>
		</div>
		<div class="two-con">
			<div class="result">
				<p>每期还款：<span id="result-money">--元</span></p>
				<span class="close-btn">X</span>
			</div>
			<div class="result-info">
				<p>贷款金额：<span id="loans-money">--元</span></p>
				<p>本息合计：<span id="return-money">--元</span></p>
				<p>贷款周期：<span id="loans-time">--</span></p>
			</div>
			<a href="http://m.uzhuang.com/mobile-template.html?temp=150&id=jsyh">我要贷款</a>
		</div>
	</div>
</section>
<section>
	<img src="<?php echo R;?>msite/loans_calculator/img/jh_img3.jpg" alt="" />
	<img src="<?php echo R;?>msite/loans_calculator/img/jh_img4.jpg" alt="" />
	<img src="<?php echo R;?>msite/loans_calculator/img/jh_img5.jpg" alt="" />
</section>
<a href="http://m.uzhuang.com/mobile-template.html?temp=150&id=jsyh" class="bottom-link">我要贷款</a>

<script type="text/javascript" src="<?php echo R;?>msite/base/js/zepto.min.js"></script>
<script type="text/javascript" src="<?php echo R;?>msite/loans_calculator/js/loans_calculator.js"></script>
</body>
</html>