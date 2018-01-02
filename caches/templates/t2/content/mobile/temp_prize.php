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
    <link rel="stylesheet" href="<?php echo R;?>msite/activity/css/prize.css">

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

<!--title-->
<section class="header_img">
    <img src="<?php echo R;?>msite/activity/img/prize716_header.jpg">
    <div class="header_text"></div>
</section>
<!--滚动区域 start-->
<section class="silder_mode">
    <div class="sil_title">
        <div class="sil_tit_bg"></div>
        <div class="sil_title_name">中奖信息</div>
    </div>
    <div class="sel_cont">
        <ul class="sel_listtext" id="prize-list">
            <script type="text/template" id="prize-temp">
                <% for(var i = 0;i<lotteryData.length;i++){ %>
                <% var item = lotteryData[i]; %>
                <li>
                    <div class="sel_list_name">
                       <%= item.name %>
                    </div>
                    <div class="sel_list_jiangpin">
                        <%= item.award %>
                    </div>
                    <div class="sel_list_telp">
                        <%= item.number %>
                    </div>
                </li>
                <% } %>
            </script>
        </ul>
    </div>
</section>
<!--滚动区域 end-->
</body>
</html>
<script type="text/javascript" src="<?php echo R;?>msite/base/js/zepto.min.js"></script>
<script type="text/javascript" src="<?php echo R;?>msite/base/js/jquery-1.8.3.min.js"></script>
<script type="text/javascript" src="<?php echo R;?>msite/base/js/kxbdSuperMarquee.js"></script>
<script type="text/javascript" src="<?php echo R;?>msite/base/js/underscore-template.js"></script>
<script type="text/javascript" src="<?php echo R;?>msite/base/js/base.js"></script>
<script type="text/javascript" src="<?php echo R;?>msite/base/js/size.js"></script>
<script type="text/javascript" src="<?php echo R;?>msite/activity/js/prize.js"></script>