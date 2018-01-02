<?php defined('IN_WZ') or exit('No direct script access allowed'); ?><!doctype html>
<html>
<head>
    <meta name="viewport" content="width=device-width,minimum-scale=1.0,maximum-scale=1.0, minimal-ui"/>
    <meta content="yes" name="apple-mobile-web-app-capable">
    <!--iphone桌面快捷方式图标<link rel="apple-touch-icon" href="custom_icon.png">-->
    <meta charset="utf-8">
    <meta name="keywords" content="优装美家">
    <meta name="description" content="优装美家">

    <title>优装美家</title>
    <link rel="stylesheet" href="<?php echo R;?>msite/base/css/base.css">
    <link rel="stylesheet" href="<?php echo R;?>msite/activity/css/singup.css">
</head>

<body>
<div style="display:none">
    <script>
        var _hmt = _hmt || [];
        (function () {
            var hm = document.createElement("script");
            hm.src = "//hm.baidu.com/hm.js?0a9b93e0ac9bdda145e2d4f6ffa88ee5";
            var s = document.getElementsByTagName("script")[0];
            s.parentNode.insertBefore(hm, s);
        })();
    </script>

</div>
<header>
    <div class="tit_minu">
        <a id="go-back" target="_self" title="优装美家">
            <i class="iconfont icon-goback"></i>
        </a>
       
    </div>
    <h1 class="header-title">优装美家</h1>
</header>
<div class="header_img">
    <img src="<?php echo R;?>msite/activity/img/activity716header.jpg">
</div>
<div class="act716_text">
    <ul>
        <li class="sing_name">
            <input type="text" placeholder="请输入您的姓名">
        </li>
        <li class="sing_telphone">
            <input type="text" placeholder="您的手机号">
        </li>
        <li class="sing_city">
            <select id="city_sel"></select>
        </li>
    </ul>
</div>
<div class="footer_img">
    <img src="<?php echo R;?>msite/activity/img/activity716footer.jpg">
    <div class="submit_btn">
        <input type="submit" class="singup_submit" value="">
    </div>
    <div class="sing_link">
        <a href="mobile-sing_agreement.html">用户协议</a>
    </div>
</div>
</body>
</html>
<script type="text/javascript" src="<?php echo R;?>msite/base/js/zepto.min.js"></script>
<script type="text/javascript" src="<?php echo R;?>msite/base/js/underscore-template.js"></script>
<script type="text/javascript" src="<?php echo R;?>msite/base/js/base.js"></script>
<script type="text/javascript" src="<?php echo R;?>msite/base/js/manager_select.js"></script>
<script type="text/javascript" src="<?php echo R;?>msite/base/js/size.js"></script>
<script type="text/javascript" src="<?php echo R;?>msite/activity/js/singup.js"></script>
<script>
    $('#city_sel').loadProvince();
</script>