<?php defined('IN_WZ') or exit('No direct script access allowed'); ?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>优装美家就是装修管家，管家式装修服务平台</title>
    <meta name="viewport" content="width=device-width,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no">
    <link rel="stylesheet" href="./res/activity/base/css/base.css">
    <link rel="stylesheet" href="./res/activity/userhome/css/userhome.min.css">
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
    <h1 class="header-title">我的账户</h1>
</header>
<!--user window s-->
<section class="us_title" id="user-title">
    <script type="text/template" id="user-title-template">
        <div class="us_titlebg"></div>
        <div class="us_cont">
            <div class="us_conttit clearfix">
                <a href="activity-PersonInfo.html" class="clearfix">
                    <div class="us_titleft fl">
                        <div class="us_logo fl">
                            <img src="<%= user_title.avatar %>">
                        </div>
                        <div class="us_phonenum fl">
                            <p><%= user_title.nickname %></p>
                            <p class="us_phonenump1">邀请码 <span class="color_bul"><%= user_title.icode %></span></p>
                        </div>
                    </div>
                    <div class="us_titright fr clearfix">
                        <i class="iconfont fl icon-erweima"></i>
                        <i class="iconfont fl icon-goback"></i>
                    </div>
                </a>
            </div>

            <div class="us_money">
                <h3 class="color_org"><span>¥</span><%= user_title.cumulative_money %></h3>
                <p class="color_org">可提佣金（元）</p>
                <p>单笔提取金额大于等于100元</p>
            </div>

            <div class="us_button">
                <a href="activity-distill.html">提取</a>
            </div>
        </div>
    </script>
</section>

<!--user window e-->

<!--promote start-->
<section class="promote promotes">
    <div class="promote_tit clearfix">
        <a href="javascript:;" class="clearfix">
            <div class="promote_name fl">我的推荐</div>
            <div class="promote_right fr">
                <i class="iconfont icon-goback"></i>
            </div>
        </a>
    </div>
    <ul class="promote_cont" id="user-promote">
        <script type="text/template" id="user-promote-template">
            <% for(var i=0; i<user_promote.length; i++){ %>
            <% var item = user_promote[i] %>
                <li class="promote_list clearfix">
                    <a href="activity-recommendedDetails.html?orderid=<%= item.orderid %>"> </a>
                        <div class="fl prom_name">
                            <p class="color_333"><%= item.title %>
                                <% if(item.area){ %>
                                <%= item.area %>㎡
                                <% } %>
                            </p>
                            <p class="color_999"><%= item.address %></p>
                        </div>
                        <div class="prom_status fr"><span><%= item.status_reason %></span></div>

                </li>
            <% } %>
        </script>
    </ul>
    <div class="promote_none">您还没有推荐，<a href="activity-index_main.html">现在就去推荐>></a></div>
</section>
<!--promote end-->


<!--my friend start-->
<section class="promote friend">

    <div class="promote_tit clearfix">
        <a href="javascript:;">
            <div class="promote_name fl">我的好友</div>
            <div class="promote_right fr">
                <i class="iconfont fl icon-goback"></i>
            </div>
        </a>
    </div>

    <section class="round">
        <ul class="round_box" id="user-friend">
            <script type="text/template" id="user-friend-template">
                <% for(var i=0; i<user_firend.length; i++){ %>
                <% var item = user_firend[i] %>
                <li class="round_list fl">
                    <a href="activity-username.html?id=<%= item.uid %>"></a>
                    <div class="round_imgtit">
                        <img src="<%= item.avatar %>">
                    </div>
                    <p class="round_pnumber"><%= item.mobile %></p>
                    <p  class="round_name">已成功推荐量房<span class="color_org"><%= item.count %></span>次</p>
                </li>
                <% } %>
            </script>
        </ul>
    </section>
    <div class="friend_none color_org">您还没有好友</div>
</section>
<!--my friend start end-->


</body>
</html>
<script type="text/javascript" src="./res/activity/base/js/zepto.min.js"></script>
<script type="text/javascript" src="http://res.wx.qq.com/open/js/jweixin-1.0.0.js"></script>
<script type="text/javascript" src="./res/activity/base/js/base.js"></script>
<script type="text/javascript" src="./res/activity/base/js/underscore-template.js"></script>
<script type="text/javascript" src="./res/activity/userhome/js/userhome.min.js"></script>