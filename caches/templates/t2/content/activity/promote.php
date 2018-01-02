<?php defined('IN_WZ') or exit('No direct script access allowed'); ?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>优装美家就是装修管家，管家式装修服务平台</title>
    <meta name="viewport" content="width=device-width,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no">
    <link rel="stylesheet" href="<?php echo R;?>activity/base/css/base.css">
    <link rel="stylesheet" href="<?php echo R;?>activity/promote/css/promote.min.css">
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
    <h1 class="header-title">我的推荐</h1>
    <a class="header_rightminu" href="activity-rule.html">奖励金标准</a>
</header>
<!--promote start-->
<section class="promote">
    <ul class="promote_cont" id="user-promote">
        <script type="text/template" id="user-promote-template">
            <% for(var i=0; i<user_promote.length; i++){ %>
            <% var item = user_promote[i] %>
            <li class="promote_list clearfix">
                <a href="activity-recommendedDetails.html?orderid=<%= item.orderid %>" class="clearfix">
                    <div class="fl prom_name">
                        <p class="color_333"><%= item.title %>
                            <% if(item.area){ %>
                            <%= item.area %>㎡
                            <% } %>
                        </p>
                        <p class="color_999"><%= item.address %></p>
                    </div>
                    <div class="prom_status fr"><span><%= item.status_reason %></span></div>
                </a>
            </li>
            <% } %>
        </script>
    </ul>
</section>
<!--promote end-->
</body>
</html>
<script type="text/javascript" src="<?php echo R;?>activity/base/js/zepto.min.js"></script>
<script type="text/javascript" src="http://res.wx.qq.com/open/js/jweixin-1.0.0.js"></script><script src="<?php echo R;?>activity/base/js/base.js"></script>
<script type="text/javascript" src="<?php echo R;?>activity/base/js/underscore-template.js"></script>
<script type="text/javascript" src="<?php echo R;?>activity/promote/js/promote.min.js"></script>