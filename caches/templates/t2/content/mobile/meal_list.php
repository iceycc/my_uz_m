<?php defined('IN_WZ') or exit('No direct script access allowed'); ?><!doctype html>
<html>
<head>
    <meta name="viewport" content="width=device-width,minimum-scale=1.0,maximum-scale=1.0, minimal-ui"/>
    <meta content="yes" name="apple-mobile-web-app-capable">
    <!--iphone桌面快捷方式图标<link rel="apple-touch-icon" href="custom_icon.png">-->
    <meta charset="utf-8">
    <meta name="keywords" content="">
    <meta name="description" content="">
    <title>装修套餐列表</title>
    <link href="./res/msite/base/css/base.css" rel="stylesheet" type="text/css" >
    <link href="./res//msite/index/css/post_form.css" rel="stylesheet" type="text/css">
    <link href="./res/msite/setmeal/css/meal_list.css" rel="stylesheet" type="text/css">
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
</head>
<body>
<header class="rem100">
    <div class="tit_minu">
        <a id="go-back" target="_self" title="优装美家">
            <i class="iconfont icon-goback"></i>
        </a>
        <a class="back_index" href="mobile-index.html">首页</a>
    </div>
    <!-- <div class="city">
        <a href="##" class="current-city">北京<i class="iconfont icon-xiajiantou"></i></a>
    </div> -->
    <h1 class="header-title">装修套餐</h1>

    <i id="shaixuan-minu" class="iconfont icon-shaixuan1"></i>
</header>

<!--list s-->
<section class="meal_mode">
    <!--<ul class="meal_cont">
        <li class="meal_list">

            <div class="meal_top_img">
                <img src="./res/activity/index/img/tj_index_img_02.jpg">
            </div>
            <div class="meal_text">
                <div class="meal_text_title">
                    <div class="meal_name">生活家额-至臻环保精装套餐装套餐</div>
                    <div class="meal_title_lable">领包入住</div>
                </div>
                <div class="meal_money clearfix">
                    <div class="price_num fl">¥ <span>599</span> 元/m2</div>
                    <div class="meal_singnum fr">2269人已报名</div>
                </div>
            </div>
        </li>

    </ul>-->
</section>
<!--list e-->

<!--fix term s-->
<div class="term" id="term-content">

    <script type="text/template" id="trem-template">
        <div class="term_close"></div>
        <div class="term_content">
            <ul class="term_ul">
                <li class="trem_mode" type="product_type">
                    <h2 class="trem_mode_title">装修方式</h2>
                    <ul class="term_minu_cont clearfix">
                        <% for(var i = 0;i< data.type.length;i++){ %>
                            <li class="term_minu <%if(i == 0){%>active<% } %>" type="<%= data.type[i].value %>"><%= data.type[i].name %></li>
                        <% } %>
                    </ul>
                </li>
                <li class="trem_mode" type="money">
                    <h2 class="trem_mode_title">套餐价格</h2>
                    <ul class="term_minu_cont clearfix">
                        <% for(var i = 0;i< data.money.length;i++){ %>
                            <li class="term_minu <%if(i == 0){%>active<% } %>" type="<%= data.money[i].value %>"><%= data.money[i].name %></li>
                        <% } %>
                    </ul>
                </li>
            </ul>
            <div class="term_sibmit">确定</div>
        </div>
    </script>
</div>
<!--fix term e-->

<script type="text/template" id="meal-list-template">
    <% for(var i = 0;i< data.length;i++){ %>
    <% var item = data[i]; %>
    <li class="meal_list">
        <a href="mobile-meal_detail.html?id=<%= item.id %>" class="meal_link"></a>
        <div class="meal_top_img">
            <img data-original="<%= item.m_package_photos %>">
        </div>
        <div class="meal_text">
            <div class="meal_text_title">
                <% if(item.spreadhead){ %>
                <div class="meal_name"><%= item.spreadhead %></div>
                <% } %>

                <% if(item.product_type.name){ %>
                <div class="meal_title_lable"><%= item.product_type.name %></div>
                <% } %>
            </div>
            <div class="meal_money clearfix">
                <% if(item.price){ %>
                <div class="price_num fl">¥ <%= item.price %></div>
                <% } %>

                <% if(item.signup){ %>
                <div class="meal_singnum fr"><%= item.signup %>人已报名</div>
                <% } %>
            </div>
        </div>
    </li>
    <% } %>

</script>
<script type="text/javascript" src="./res/msite/base/js/zepto.min.js"></script>
<script type="text/javascript" src="./res/msite/base/js/underscore-template.js"></script>
<script type="text/javascript" src="./res/msite/base/js/base.js"></script>
<script type="text/javascript" src="./res/msite/base/js/imageLoad.js"></script>
<script type="text/javascript" src="./res/msite/base/js/rem100.640x.js"></script>
<script type="text/javascript" src="./res/msite/setmeal/js/meal_list.js"></script>
</body>
</html>