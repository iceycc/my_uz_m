<?php defined('IN_WZ') or exit('No direct script access allowed'); ?><!doctype html>
<html>
<head>
    <meta name="viewport" content="width=device-width,minimum-scale=1.0,maximum-scale=1.0, minimal-ui"/>
    <meta content="yes" name="apple-mobile-web-app-capable">
    <!--iphone桌面快捷方式图标<link rel="apple-touch-icon" href="custom_icon.png">-->
    <meta charset="utf-8">
    <meta name="keywords" content="">
    <meta name="description" content="">

    <title>待支付</title>
    <link rel="stylesheet" href="<?php echo R;?>msite/base/css/base.css">
    <link rel="stylesheet" href="<?php echo R;?>msite/wait_pay/css/wait_pay.css">
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
<header>
    <div class="tit_minu">
        <a id="go-back" target="_self" title="优装美家">
            <i class="iconfont icon-goback"></i>
        </a>
        <a class="back_index" href="mobile-index.html">首页</a>
    </div>
    <h1 class="header-title">待支付</h1>
</header>
<div class="pay_node" id="pay_node">
    <script type="text/template" id="pay-node-template">
        <div class="pay_node_title">对<%= data.nodename %>的费用支付</div>

        <ul class="pay_node_ul">
            <% if(data.title){ %>
                <% for(var kay in data.title){ %>
                    <% var payInfoTit = data.title[kay]; %>
                    <% if(payInfoTit){ %>
                        <li class="pay_node_list clearfix">
                            <h2 class="fl"><%= dataTeName[kay] %></h2>
                            <p class="fl"><%= payInfoTit %><% if(kay == 'totalpay' || kay == 'designpay'){ %>元<% } %></p>
                        </li>
                    <% } %>
                    <!--<li class="pay_node_list clearfix">
                        <h2 class="fl">合同编号：</h2>
                        <p class="fl">uz-00081</p>
                    </li>
                    <li class="pay_node_list clearfix">
                        <h2 class="fl">合同总金额：</h2>
                        <p class="fl">100000元</p>
                    </li>-->
                <% } %>
            <% } %>
        </ul>

        <div class="pay_node_mas">
            <h2><i class="iconfont icon-qian"></i><span>支付信息</span></h2>
            <ul class="par_node_masnum">

                <% var itemc = data.content; %>

                <% if((data.params.nodeid == 102 || data.params.nodeid == 15) && itemc.deposit){ %>
                <li class="par_node_masli clearfix">
                    <div class="par_node_masleft fl"><%if(data.nodename == '签设计协议'){%>设计协议金额<%}else{%>意向定金<%}%>：</div>
                    <div class="par_node_masright fl"><%= parseFloat(itemc.deposit) %>元</div>
                </li>
                <% } %>
                <!--合同款-->
                <% if(parseFloat(itemc.contactmoney) && parseFloat(itemc.draw_rate)){ %>
                <li class="par_node_masli clearfix">
                    <div class="par_node_masleft fl"><%= parseFloat(itemc.draw_rate) %>%合同款：</div>
                    <div class="par_node_masright fl"><%= parseFloat(itemc.contactmoney) %>元</div>
                </li>
                <% } %>
                <!--增减项-->
                <% if(data.params.nodeid != 102 && data.params.nodeid != 19 && data.params.nodeid != 15){ %>
                <li class="par_node_masli clearfix">
                    <div class="par_node_masleft fl">增减项：</div>
                    <div class="par_node_masright fl"><%= parseFloat(itemc.extrapay) %>元</div>
                </li>
                <% } %>

                <!--已交定金-->
                <% if(data.params.nodeid == 19 && itemc.deposit){ %>
                <li class="par_node_masli clearfix">
                    <div class="par_node_masleft fl">已交定金：</div>
                    <div class="par_node_masright fl"><%= parseFloat(itemc.deposit) %>元</div>
                </li>
                <% } %>

                <!--已支付-->
                <% if(parseFloat(itemc.payed_money)){ %>
                <li class="par_node_masli clearfix">
                    <div class="par_node_masleft fl">已支付：</div>
                    <div class="par_node_masright fl"><%= parseFloat(itemc.payed_money) %>元</div>
                </li>
                <% } %>
                
                <!--待支付-->
                <% if(parseFloat(itemc.wait_pay_money)){ %>
                <li class="par_node_masli clearfix">
                    <div class="par_node_masleft fl">待支付：</div>
                    <div class="par_node_masright fl"><%= parseFloat(itemc.wait_pay_money) %>元</div>
                </li>
                <% } %>


                <!--<li class="par_node_masli clearfix">-->
                    <!--<div class="par_node_masleft fl">20%合同款：</div>-->
                    <!--<div class="par_node_masright fl">20000元</div>-->
                <!--</li>-->
                <!--<li class="par_node_masli clearfix">-->
                    <!--<div class="par_node_masleft fl">20%合同款：</div>-->
                    <!--<div class="par_node_masright color_red fl">20000元</div>-->
                <!--</li>-->

            </ul>
        </div>

        <% if(parseFloat(itemc.wait_pay_money)){ %>
        <div class="pay_money_number">
            <span>支付金额：</span>
            <input type="text" class="modify_pay_money" placeholder="<%= itemc.wait_pay_money %>元">
        </div>
        <% } %>
        <div class="pay_button">
            <input type="button" class="pay_nodeSubmit" value="去支付" >
        </div>
        <p class="par_remark">温馨提示：考虑到在线支付，银行针对普通用户银行卡限额问题，建议您可以分笔支付（大部分银行单笔在线支付限额为10000元RMB）!</p>
    </script>
</div>
</body>
</html>
<script type="text/javascript" src="<?php echo R;?>msite/base/js/zepto.min.js"></script>
<script type="text/javascript" src="<?php echo R;?>msite/base/js/underscore-template.js"></script>
<script type="text/javascript" src="<?php echo R;?>msite/base/js/base.js"></script>
<script type="text/javascript" src="<?php echo R;?>msite/base/js/size.js"></script>
<script type="text/javascript" src="<?php echo R;?>msite/wait_pay/js/wait_pay.min.js"></script>