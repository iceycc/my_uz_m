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
<link rel="stylesheet" type="text/css" href="<?php echo R;?>msite/login_reg/css/login.css">
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
	<h1 class="header-title">注册</h1>
	
</header>

<!--Top Bar End-->

<!--Main Content Start-->
<section id="reg" class="container">
    <div class="user-input">
    	<input id="phone-number" type="number" placeholder="请输入手机号">
    </div>
    <div class="img_code">
        <input id="img_code_in" type="text" maxlength="10" placeholder="请输入图片验证码">
        <img src="" alt="">
    </div>
    <div id="send-code" class="user-input clearfix">
    	<input id="phone-code" type="number" placeholder="请输入手机验证码">
        <input id="sent-message" type="button" value="发送短信验证码">
    </div>
    <div id="set-pwd" class="user-input">
    	<input id="restet-pwd" type="password" placeholder="请设置密码">
        <i id="eyes" class="iconfont icon-eyes" href="#"></i>
    </div>
    <p id="im-agree"><input type="checkbox" checked="checked">我已阅读并同意<a class="blue-link" href="mobile-readme.html">&lt;&lt;优装美家用户注册协议&gt;&gt;</a></p>
    <input id="reg-btn" class="disabled" type="button" value="注册">
</section>
<!--Main Content End-->

<script src="<?php echo R;?>msite/base/js/zepto.min.js"></script>
<script src="<?php echo R;?>msite/base/js/base.js"></script>
<script src="<?php echo R;?>msite/login_reg/js/check_input.js"></script>
<script src="<?php echo R;?>msite/login_reg/js/reg.js"></script>

</body>
</html>
