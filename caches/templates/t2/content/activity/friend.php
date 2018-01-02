<?php defined('IN_WZ') or exit('No direct script access allowed'); ?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>优装美家就是装修管家，管家式装修服务平台</title>
    <meta name="viewport" content="width=device-width,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no">
    <link rel="stylesheet" href="<?php echo R;?>activity/base/css/base.css">
    <link rel="stylesheet" href="<?php echo R;?>activity/friend/css/friend.css">
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
    <h1 class="header-title">我的好友</h1>
</header>
<!--promote start-->
<section class="friend">
    <ul class="friend_cont" id="friend-list">
        <script type="text/template" id="friend-list-template">
            <% for(var i=0; i<friend_data.length; i++){ %>
            <% var item = friend_data[i] %>
            <li class="friend_list clearfix">
                <a class="clearfix" href="activity-username.html?id=<%= item.uid %>">
                    <div class="fri_logo fl">
                        <img class="fl" src="<%= item.avatar %>" alt="">
                        <p class="fl"><%= item.nickname %></p>
                    </div>
                    <p class="fir_success fr">已成功推荐量房<span class="color_org"><%= item.count %></span>次</p>
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
<script type="text/javascript" src="<?php echo R;?>activity/friend/js/friend.js"></script>