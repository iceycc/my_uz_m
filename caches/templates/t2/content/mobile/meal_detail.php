<?php defined('IN_WZ') or exit('No direct script access allowed'); ?><!doctype html>
<html>
<head>
    <meta name="viewport" content="width=device-width,minimum-scale=1.0,maximum-scale=1.0, minimal-ui"/>
    <meta content="yes" name="apple-mobile-web-app-capable">
    <!--iphone桌面快捷方式图标<link rel="apple-touch-icon" href="custom_icon.png">-->
    <meta charset="utf-8">
    <meta name="keywords" content="">
    <meta name="description" content="">
    <title>装修效果图大全_室内设计效果图_装潢效果图_室内装饰效果图_优装美家图库</title>
    <link href="./res/msite/base/css/base.css" rel="stylesheet" type="text/css">
    <link href="./res/msite/base/css/swiper.min.css" rel="stylesheet" type="text/css">
    <link href="./res/msite/setmeal/css/meal_detail.css" rel="stylesheet" type="text/css">
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
<div id='share_logo' style='margin:0 auto;display:none;'>
    <img src="./res/msite/base/img/share_logo.jpg"/>
</div>
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
</header>

<!--banner s-->
<section class="banner" id="banner-content">
    <script type="text/template" id="banner-template">
        <ul id="banner-box" class="swiper-wrapper">
            <% for(var i = 0;i<data.m_package_photos.length;i++){ %>
            <li class="swiper-slide">
                <img class="banner-img" src="<%= data.m_package_photos[i] %>">
                <a class="banner-link" href="javascript:;"></a>
            </li>
            <% } %>
            <!--<li class="swiper-slide">
                <img class="banner-img" src="./res/activity/index/img/tj_index_img_03.jpg">
                <a class="banner-link" href="javascript:;"></a>
            </li>
            <li class="swiper-slide">
                <img class="banner-img" src="./res/activity/index/img/tj_index_img_05.jpg">
                <a class="banner-link" href="javascript:;"></a>
            </li>-->
        </ul>
        <div class="swiper-pagination"></div>
    </script>
</section>
<!--banner e-->

<!--content s-->
<section class="meal_content" id="meal-content">
    <script type="text/template" id="meal-content-template">
        <!--价格描述 s-->
        <section class="describe">
            <div class="price">
                <div class="price_money"><%= data.price %></div>

                <% if(data.product_type && data.product_type.name){ %>
                <div class="price_label"><%= data.product_type.name %></div>
                <% } %>
            </div>

            <% if(data.remark){ %>
            <div class="descr_text"><%= data.remark %></div>
            <% } %>

            <% if(data.company){ %>
            <div class="descr_link">
                <a href="mobile-company_detail.html?company_id=<%= data.company_id %>"><%= data.company %> ></a>
            </div>
            <% } %>
        </section>
        <!--价格描述 e-->

        <% if(data.label.length > 0 || data.label){ %>
        <!--优惠标签 s-->
        <div class="discount">
            <div class="price">
                <h2>特权优惠</h2>
            </div>
            <ul class="dis_lable">
                <% for(var i = 0;i<data.label.length;i++){ %>
                    <li><%= data.label[i] %></li>
                <% } %>
            </ul>
        </div>
        <!--优惠标签 e-->
        <% } %>

        <!--服务介绍 s-->
        <div class="serves">
            <div class="price">
                <h2>服务介绍</h2>
            </div>
            <ul class="servers_mode">
                <% if(data.promise){ %>
                <li class="servers_list clearfix">
                    <div class="fl">
                        <i class="iconfont icon-chengnuo"></i>
                        <span>承诺</span>
                    </div>
                    <p><%= data.promise %></p>
                </li>
                <% } %>

                <% if(data.ensure){ %>
                <li class="servers_list">
                    <div class="fl">
                        <i class="iconfont icon-baozheng"></i>
                        <span>保证</span>
                    </div>
                    <p><%= data.ensure %></p>
                </li>
                <% } %>

                <% if(data.service){ %>
                <li class="servers_list">
                    <div class="fl">
                        <i class="iconfont icon-fuwu"></i>
                        <span>服务</span>
                    </div>
                    <p><%= data.service %></p>
                </li>
                <% } %>
            </ul>
        </div>
        <!--服务介绍 e-->


        <% if(data.introduce_photo.length > 0 || data.introduce_photo){ %>
        <!--详情 s-->
        <div class="details">
            <div class="price">
                <h2>详情</h2>
            </div>

            <ul>
                <% for(var i = 0;i<data.introduce_photo.length;i++){ %>
                    <li class="img_details">
                        <div class="detail_imgbox">
                            <img data-original="<%= data.introduce_photo[i] %>">
                        </div>
                    </li>
                <% } %>
                <!--<li class="img_details">-->
                    <!--<div class="detail_imgbox">-->
                        <!--<img src="./res/activity/index/img/tj_index_img_05.jpg">-->
                    <!--</div>-->
                <!--</li>-->
                <!--<li class="img_details">-->
                    <!--<div class="detail_imgbox">-->
                        <!--<img src="./res/activity/index/img/tj_index_img_05.jpg">-->
                    <!--</div>-->
                <!--</li>-->
            </ul>
        </div>
        <!--详情 e-->
        <% } %>
    </script>
</section>
<!--content e-->

<!--bottom fix minu s-->
<section class="b_fix_minu">
    <div class="fix_collection fl">
        <i class="iconfont icon-shoucangkongxin"></i>
        <span>收藏</span>
    </div>
    <div class="fix_gosing fl">
        <a href="mobile-ordered.html?page_id=152&type=taocan">获得免费设计/量房</a>
    </div>
</section>
<!--bottom fix minu e-->

<script type="text/javascript" src="./res/msite/base/js/zepto.min.js"></script>
<script type="text/javascript" src="./res/msite/base/js/underscore-template.js"></script>
<script type="text/javascript" src="./res/msite/base/js/base.js"></script>
<script type="text/javascript" src="./res/msite/base/js/imageLoad.js"></script>
<script type="text/javascript" src="./res/msite/base/js/swiper.jquery.min.js"></script>
<script type="text/javascript" src="./res/msite/base/js/rem100.640x.js"></script>
<script type="text/javascript" src="./res/msite/setmeal/js/meal_detail.js"></script>
</body>
</html>
<script>

</script>