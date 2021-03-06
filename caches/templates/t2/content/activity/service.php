<?php defined('IN_WZ') or exit('No direct script access allowed'); ?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>优装美家就是装修管家，管家式装修服务平台</title>
    <meta name="viewport" content="width=device-width,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no">
    <meta name="format-detection" content="telephone=yes">
    <link rel="stylesheet" href="<?php echo R;?>activity/base/css/base.css">
    <link rel="stylesheet" href="<?php echo R;?>activity/base/css/index_footerminu.css">
    <style>
        .service_tel {
            width: 6rem;
            height: 1rem;
            background: rgba(0,0,0,0);
            position: absolute;
            left: 50%;
            margin-left: -3rem;
            top: 10rem;
        }
    </style>
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
    <h1 class="header-title">联系客服</h1>
</header>
<!--promote start-->
<section class="rule">
    <img src="<?php echo R;?>activity/service/img/service.jpg">
    <a class="service_tel" href="tel:400-6171-666"></a>
</section>
<!--promote end-->

<!--footer minu start-->
<section class="footer_minu">
    <ul class="clearfix">
        <li class="fl">
            <a href="activity-index.html">
                <div><i class="iconfont icon-tuijianhaoyou"></i></div>
                <p>推荐</p>
            </a>
        </li>
        <li class="fl">
            <a href="activity-rule.html">
                <div><i class="iconfont icon-jiangliguize"></i></div>
                <p>规则</p>
            </a>
        </li>
        <li class="fl footer_userhome">
            <a href="activity-userhome.html">
                <div><i class="iconfont icon-wodezhanghu"></i></div>
                <p>我的</p>
            </a>
        </li>
        <li class="fl minu_active">
            <div><i class="iconfont icon-lianxikefu1"></i></div>
            <p>客服</p>
        </li>
    </ul>
</section>
</body>
</html>
<script type="text/javascript" src="<?php echo R;?>activity/base/js/zepto.min.js"></script>
<script type="text/javascript" src="http://res.wx.qq.com/open/js/jweixin-1.0.0.js"></script><script src="<?php echo R;?>activity/base/js/base.js"></script>
<script type="text/javascript" src="<?php echo R;?>activity/service/js/service.js"></script>