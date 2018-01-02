<?php defined('IN_WZ') or exit('No direct script access allowed'); ?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>优装美家就是装修管家，管家式装修服务平台</title>
    <meta name="viewport" content="width=device-width,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no">
    <link rel="stylesheet" href="<?php echo R;?>activity/base/css/base.css">
    <link rel="stylesheet" href="<?php echo R;?>activity/distill/css/distill.css">
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
    <h1 class="header-title">提取奖励金</h1>
</header>
<!--up money box start-->
<section class="money_cont">
    <div class="money_conttit clearfix" id="dis-title">
        <script type="text/template" id="dis-title-template">
            <div class="usable fl">
                <h4>可提佣金（元）</h4>
                <p><%= dist_title.cumulative_money %></p>
            </div>
            <div class="addup fl">
                <h4>累计提取（元）</h4>
                <p><%= dist_title.extract_money %></p>
            </div>
        </script>
    </div>
    <p class="history_link"><a href="activity-extractHistory.html">提取历史>></a></p>
</section>
<!--up money box start-->

<!--up money sel start-->
<section class="usable_sel">
    <div class="usa_selbox" id="usa-selbox">
        <script type="text/template" id="usa-selbox-template">
            <a href="activity-selectCard.html" class="clearfix">
                <%if(!dist_title.bank_number){%>
                <p class="fl bankcard" status="1">请选择收款的储蓄卡</p>
                <%}else{%>
                <p class="fl bankcard" status="2"><%= dist_title.bank_name %></p>
                <% } %>
                <i class="iconfont fr icon-goback"></i>
            </a>
        </script>
    </div>
    <div class="usa_text">
        <h3>请输入提取金额</h3>
        <div class="usa_textcont">
            <span class="color_org">¥</span>
            <input class="use_textnum" type="text">
            <span class="color_999">元</span>
        </div>
    </div>
    <input type="submit" value="确认提现" class="usa_button usa_dis" disabled />
</section>
<!--up money sel start-->

<!--prompts start-->
<section class="prompts">
    <h2>温馨提示：</h2>
    <ul>
        <li>1.单笔提取金额需大于等于100元</li>
        <li>2.金额需为10的倍数，如110、150、200等</li>
        <li>3.提现后3-5个工作日到账</li>
    </ul>
</section>
<!--prompts start-->
</body>
</html>
<script type="text/javascript" src="<?php echo R;?>activity/base/js/zepto.min.js"></script>
<script type="text/javascript" src="http://res.wx.qq.com/open/js/jweixin-1.0.0.js"></script><script src="<?php echo R;?>activity/base/js/base.js"></script>
<script type="text/javascript" src="<?php echo R;?>activity/base/js/underscore-template.js"></script>
<script type="text/javascript" src="<?php echo R;?>activity/distill/js/distill.js"></script>