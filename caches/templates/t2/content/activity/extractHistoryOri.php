<?php defined('IN_WZ') or exit('No direct script access allowed'); ?><!doctype html>
<html>
<head>
<meta name="viewport" content="width=device-width,minimum-scale=1.0,maximum-scale=1.0, minimal-ui"/>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>提取历史</title>
<link href="<?php echo R;?>activity/base/css/base.css" rel="stylesheet" type="text/css">
<link href="<?php echo R;?>activity/extractHistory/css/extractHistory.css" rel="stylesheet" type="text/css">


    <div style="display:none">
        <script>
            var _hmt = _hmt || [];
            (function () {
                var hm = document.createElement("script");
                hm.src = "//hm.baidu.com/hm.js?92380afd6606de580cc830429c39c519";
                var s = document.getElementsByTagName("script")[0];
                s.parentNode.insertBefore(hm, s);
            })();
        </script>
    </div>
</head>

<body>
<header>
    <a id="go-back" target="_self" title="优装美家">
        <i class="iconfont icon-goback"></i>
    </a>
    <h1 class="header-title">提取历史</h1>

</header>

<section class="bg_fff">
	<div class="infoMod fix">
        <div class="col-left">
            <p class="time">2016.05.30</p>
            <p class="money"><cite class="icon">¥</cite>800.00</p>
            <p class="cardNumber">建设银行：<span>6222 2222 2222 2222 222</span></p>
        </div>
        <div class="col-right">
            <p class="state extraction">提取中</p>
            <!--<p class="success_info" style="display:none;">请注意查收</p>
            <a href="#" class="fail_btn" style="display:none;">查看原因 &gt; </a>-->
        </div>
    </div>
    <!--<p class="error">提取失败：银行卡卡号与姓名不符，请重新申请，如有疑问请联系客服。</p>-->
</section>

<section class="bg_fff">
	<div class="infoMod fix">
        <div class="col-left">
            <p class="time">2016.05.30</p>
            <p class="money"><cite class="icon">¥</cite>800.00</p>
            <p class="cardNumber">建设银行：<span>6222 2222 2222 2222 222</span></p>
        </div>
        <div class="col-right">
            <p class="state success">已打款</p>
            <p class="success_info">请注意查收</p>
           <!-- <a href="#" class="fail_btn" style="display:none;">查看原因 &gt; </a>-->
        </div>
    </div>
    <!--<p class="error">提取失败：银行卡卡号与姓名不符，请重新申请，如有疑问请联系客服。</p>-->
</section>

<section class="bg_fff">
	<div class="infoMod fix">
        <div class="col-left">
            <p class="time">2016.05.30</p>
            <p class="money"><cite class="icon">¥</cite>800.00</p>
            <p class="cardNumber">建设银行：<span>6222 2222 2222 2222 222</span></p>
        </div>
        <div class="col-right">
            <p class="state fail">提取失败</p>
            <!--<p class="success_info" style="display:none;">请注意查收</p>-->
            <a href="#" class="fail_btn">查看原因 &gt; </a>
        </div>
    </div>
    <!--<p class="error">提取失败：银行卡卡号与姓名不符，请重新申请，如有疑问请联系客服。</p>-->
</section>

<section class="bg_fff">
	<div class="infoMod fix">
        <div class="col-left">
            <p class="time">2016.05.30</p>
            <p class="money"><cite class="icon">¥</cite>800.00</p>
            <p class="cardNumber">建设银行：<span>6222 2222 2222 2222 222</span></p>
        </div>
        <div class="col-right">
            <p class="state fail">提取失败</p>
            <!--<p class="success_info" style="display:none;">请注意查收</p>-->
            <!--<a href="#" class="fail_btn">查看原因 &gt; </a>-->
        </div>
    </div>
    <p class="error">提取失败：银行卡卡号与姓名不符，请重新申请，如有疑问请联系客服。</p>
</section>


</body>
<script src="<?php echo R;?>activity/base/js/zepto.min.js"></script>
<script src="<?php echo R;?>activity/base/js/underscore-template.js"></script>
<script type="text/javascript" src="http://res.wx.qq.com/open/js/jweixin-1.0.0.js"></script><script src="<?php echo R;?>activity/base/js/base.js"></script>
<script src="<?php echo R;?>activity/base/js/underscore.min.js"></script>
<script src="<?php echo R;?>activity/extractHistory/js/extractHistory.js"></script>


</html>
