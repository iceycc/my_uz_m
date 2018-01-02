<?php defined('IN_WZ') or exit('No direct script access allowed'); ?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>优装美家就是装修管家，管家式装修服务平台</title>
    <meta name="viewport" content="width=device-width,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no">
    <link rel="stylesheet" href="<?php echo R;?>activity/base/css/base.css">
    <link rel="stylesheet" href="<?php echo R;?>activity/username/css/username.css">
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
    <h1 class="header-title">昵称</h1>
</header>

<!--name title start-->
<section class="nametitle">
    <div id="us-name-title">
        <script type="text/template" id="user-title-template">
            <div class="fl name_tit">
                <img src="<%= user_promlist.avatar %>">
            </div>
            <div class="fl">
                <p class="name"><%= user_promlist.nickname %> <span><%= user_promlist.sex %></span></p>
                <p class="number"><%= user_promlist.mobile %></p>
            </div>
        </script>
    </div>
</section>
<!--name title end-->

<!--promote start-->
<section class="promlist"  id="user-promlist">
    <script type="text/template" id="user-promlist-template">
        <div class="promlistTit clearfix">
            <h2 class="fl">TA的推荐</h2>
            <p class="fr">已成功量房<span class="color_org"><%= user_promlist.count %></span>次，您获得奖励金<span class="color_org"><%= user_promlist.money %></span>元</p>
        </div>
        <ul class="promote_cont">
            <%if(user_promlist.friend.length　>　0){%>
                <% for(var i=0; i<user_promlist.friend.length; i++){ %>
                    <% var item = user_promlist.friend[i] %>
                    <li class="promote_list clearfix">
                        <div class="fl prom_name">
                            <p class="color_333"><%= item.title %>
                                <% if(item.area){ %>
                                <%= item.area %>㎡
                                <% } %>
                            </p>
                            <p class="color_999"><%= item.address %></p>
                        </div>
                        <div class="prom_status fr"><%= item.reason %></div>
                    </li>

                <% } %>
            <% } %>
        </ul>
    </script>
</section>
<!--promote end-->
</body>
</html>
<script type="text/javascript" src="<?php echo R;?>activity/base/js/zepto.min.js"></script>
<script type="text/javascript" src="http://res.wx.qq.com/open/js/jweixin-1.0.0.js"></script><script src="<?php echo R;?>activity/base/js/base.js"></script>
<script type="text/javascript" src="<?php echo R;?>activity/base/js/underscore-template.js"></script>
<script type="text/javascript" src="<?php echo R;?>activity/username/js/username.js"></script>