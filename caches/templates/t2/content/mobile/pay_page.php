<?php defined('IN_WZ') or exit('No direct script access allowed'); ?><!DOCTYPE html>
<html lang="en">
<head>
	<meta name="viewport" content="width=device-width,minimum-scale=1.0,maximum-scale=1.0, minimal-ui"/>
	<meta content="yes" name="apple-mobile-web-app-capable">
	<!--iphone桌面快捷方式图标<link rel="apple-touch-icon" href="custom_icon.png">-->
	<meta charset="utf-8">
	<meta name="keywords" content="装修管家,量房设计,装修施工,材料商城,环保方案,装修服务,装修图库,建材商城,装修攻略、优装网、装修网、优装美家">
	<meta name="description" content="优装美家为您提供免费专业咨询、免费量房、免费设计、免费装修保险、免费环保检测、优装网-专业装修网优选装修公司、优选建材商品、优选装修管家、优选环保服务">
	<title>优装美家—管家式装修服务 有品质的低价</title>
	<link rel="stylesheet" type="text/css" href="<?php echo R;?>msite/base/css/base.css">
	<link rel="stylesheet" type="text/css" href="<?php echo R;?>msite/building_live_new/css/pay_page.css">
    <link rel="stylesheet" href="<?php echo R;?>msite/building_live_new/css/iconfont.css">

<div style="display:none">
    <script>
    var _hmt = _hmt || [];
    (function() {
      var hm = document.createElement("script");
      hm.src = "//hm.baidu.com/hm.js?0a9b93e0ac9bdda145e2d4f6ffa88ee5";
      var s = document.getElementsByTagName("script")[0];
      s.parentNode.insertBefore(hm, s);
    })();
    </script>
</div>
</head>
<body>
<header>
	<div class="tit_minu">
        <a id="go-back" target="_self" title="优装美家">
            <i class="iconfont icon-goback"></i>
        </a>
        <a class="back_index" href="mobile-index.html">首页</a>
    </div>
	<h1 class="header-title">支付进度</h1>
</header>
<section>
	<div class="content-box" id="pay-box">
        <!--此空间未使用-->
		<!-- <p class="total-mun">合同总金额：<span>100000元</span></p>
		<div class="node-info">
			<ul class="node-ul clearfix">
				<li class="blue-active"><p>签订意向定金，已付款：1000元</p><div class="img-box"><img src="<?php echo R;?>msite/building_live_new/img/img_1.jpg" alt="" /><img src="<?php echo R;?>msite/building_live_new/img/img_1.jpg" alt="" /></li>
				<li class="blue-active"><p>签订三方合同（半包40/20/20/20），已付款：2000元</p><p>合同编号：uz-00081</p><p>合同总金额：50000元</p></li>
				<li><p>水电工程验收（20%），已付款：9500元</p><p>应收金额：10000元</p><p>增减项：-500元</p></li>
				<li><p>瓦木工程验收（20%）</p><p></p><p></p></li>
				<li><p>油漆工程验收（20%）</p><p></p><p></p></li>
				<li><p>维保节点</p><p></p><p></p></li>
			</ul>
		</div> -->
	</div>
    <div class="content-box" id="pay_content"></div>
</section>
<section id="big-pic">
	<a class="go-back"><i class="iconfont icon-goback"></i></a>
	<div class="page">
        <div class="pic-local"><span id="current-number" class="num"></span>/<span id="total-number" class="num"></span></div>

        <div id='slider'>
            <ul id="big-pic-content">
                <!-- <li class="single-pic">
                    <div class="pic-info">
                        <img src="img/big_img.png" alt="图片">
						<div class="pic-local"><span class="num">1</span>/<span class="num">7</span></div>
                    </div>
                </li> -->
            </ul>
		</div>
    </div>

</section>

<script type="text/template" id="pay-data">
    <p class="total-mun">合同总金额：<span><%= totalpay %>元</span></p>
    <div class="node-info">
        <ul class="node-ul clearfix">
            <% for(var j=0; j<pay_list.length; j++){ %>
            <% if(pay_list[j].complete_node == 1){ %>
                <% var item = pay_list[j]; %>
            <!--支付节点已进行-->
            <li class="blue-active">
                <div class="node_logo">
                    <i class="<%= nodeLogo[pay_list[j].nodeid] %>"></i>
                </div>
                <p class="pay_nodename">
                    <%= item.nodename %>
                    <% if(item.draw_rate){ %>
                    （<%= item.draw_rate %>）
                    <% } %>
                </p>
                <div class="pay_contbox">
                    <div class="pay_list_cont">
                        <% for(var i = 0;i<item.detail.length;i++){ %>
                            <% var node = item.detail; %>
                            <!--node name-->
                            <div class="pay_contlist" style="padding: 0.6rem 0;">
                            <!--title text-->
                            <% if(item.nodeid == 15){ %>
                                <!--意向定金-->
                                <% if(item.nodename == "签设计协议"){ %>

                                    <%if(node[i].designno){ %>
                                    <p>协议编号：<%= node[i].designno %></p>
                                    <% } %>

                                    <%if(node[i].designpay){ %>
                                    <p>设计协议总金额：<%= node[i].designpay %>元</p>
                                    <% } %>
                                <% } %>
                            <% }else if(item.nodeid == 19){ %>
                                <!--三方合同-->
                                <%if(node[i].contactno){ %>
                                <p>合同编号：<%= node[i].contactno %></p>
                                <% } %>
                                <%if(node[i].totalpay){ %>
                                <p>合同总金额：<%= node[i].totalpay %>元</p>
                                <% } %>
                            <% }else if(item.nodeid == 45){ %>
                            <!--维保节点-->

                            <p><%= node[i].ret %></p>
                            <% }else{ %>
                            <!--其余节点通用-->
                            <%if(node[i].pay_money){ %>
                            <p>应收金额：<%= node[i].pay_money %>元</p>
                            <% } %>
                            <% } %>
                            <!--支付凭证号-->
                            <%if(node[i].referno){ %>
                            <p>支付凭证号：<%= node[i].referno %></p>
                            <% } %>
                            <!--pay time-->
                            <%if(node[i].addtime){ %>
                                <p>支付时间：<%= node[i].addtime %></p>
                            <% } %>

                            <!--pay table-->
                            <% if(node[i].nodeid == 15){ %>
                            <!--签订意向定金节点-->
                            <% if(item.nodename == "签设计协议"){ %>
                            <table class="pay_table">
                                <tr>
                                    <th colspan="2">支付信息</th>
                                </tr>
                                <tr>
                                    <td>设计协议</td>
                                    <td><%= node[i].needmoney %>元</td>
                                </tr>

                                <% if(node[i].payed_money){ %>
                                <tr>
                                    <td>
                                        已支付
                                    </td>
                                    <td>
                                        <%= node[i].payed_money %>元
                                    </td>
                                </tr>
                                <% } %>
                                <% if(!node[i].pay_schedult){ %>
                                <tr>
                                    <td>
                                        <span style="color: red;">待支付</span>
                                    </td>
                                    <td>
                                        <span style="color: red;"><%= node[i].wait_pay %>元</span>
                                    </td>
                                </tr>
                                <% } %>
                            </table>
                            <% }else{ %>
                            <table class="pay_table">
                                <tr>
                                    <th colspan="2">支付信息</th>
                                </tr>
                                <tr class="pay_num">
                                    <td>意向定金</td>
                                    <td><%= node[i].needmoney %>元</td>
                                </tr>

                                <% if(node[i].payed_money){ %>
                                <tr>
                                    <td>
                                        已支付
                                    </td>
                                    <td>
                                        <%= node[i].payed_money %>元
                                    </td>
                                </tr>
                                <% } %>
                                <% if(!node[i].pay_schedult){ %>
                                <tr>
                                    <td>
                                        <span style="color: red;">待支付</span>
                                    </td>
                                    <td>
                                        <span style="color: red;"><%= node[i].wait_pay %>元</span>
                                    </td>
                                </tr>
                                <% } %>
                            </table>
                            <% } %>
                            <% }else if(item.nodeid == 19){ %>
                            <!--签订三方合同节点-->
                            <table class="pay_table">
                                <tr>
                                    <th colspan="2">支付信息</th>
                                </tr>
                                <tr class="pay_num">
                                    <td><%= parseInt(node[i].draw_rate) %>%合同款</td>
                                    <td><%= node[i].pay_money %>元</td>
                                </tr>
                                <% if(node[i].deposit_money){ %>
                                    <tr class="pay_num">
                                        <td>已交定金</td>
                                        <td><%= node[i].deposit_money %>元</td>
                                    </tr>
                                <% } %>

                                <% if(node[i].payed_money){ %>
                                <tr>
                                    <td>
                                        已支付
                                    </td>
                                    <td>
                                        <%= node[i].payed_money %>元
                                    </td>
                                </tr>
                                <% } %>
                                <% if(!node[i].pay_schedult){ %>
                                <tr>
                                    <td>
                                        <span style="color: red;">待支付</span>
                                    </td>

                                    <td>
                                        <span style="color: red;"><%= node[i].wait_pay %>元</span>
                                    </td>
                                </tr>
                                <% } %>
                            </table>

                            <p class="pay_num_text" >(注：其中20%款将支付给装修公司开工；另外20%款将作为质保金托管在优装美家，直到竣工后30天确保无装修质量问题后，再支付给装修公司)</p>

                            <% }else if(item.nodeid != 45){ %>
                            <!--除维保节点外其余没有指定的节点-->
                            <table class="pay_table">
                                <tr>
                                    <th colspan="2">支付信息</th>
                                </tr>
                                <tr class="pay_num">
                                    <td><%= parseInt(node[i].draw_rate) %>%合同款</td>
                                    <td><%= node[i].pay_money %>元</td>
                                </tr>
                                <tr class="pay_num">
                                    <td>增减项</td>
                                    <td><%= node[i].extrapay %>元</td>
                                </tr>

                                <% if(node[i].payed_money){ %>
                                <tr>
                                    <td>
                                        已支付
                                    </td>
                                    <td>
                                        <%= node[i].payed_money %>元
                                    </td>
                                </tr>
                                <% } %>
                                <% if(!node[i].pay_schedult){ %>
                                <tr>
                                    <td>
                                        <span style="color: red;">待支付</span>

                                    </td>
                                    <td>
                                        <span style="color: red;"><%= node[i].wait_pay %>元</span>
                                    </td>
                                </tr>
                                <% } %>
                            </table>
                            <% } %>
                            <!--<div class="pay_button">
                                <input type="submit" class="go_pay" bIndex="<%= j %>" dIndex="<%= i %>">
                            </div>-->

                            <% if(!node[i].pay_schedult && node[i].wait_pay){ %>
                                <div class="pay_money_number">
                                    <span>支付金额：</span>
                                    <input type="text" class="modify_pay_money" placeholder="<%= node[i].wait_pay %>元">
                                </div>
                            <% } %>
                            <%if(parseInt(node[i].pay_schedult) != 1){ %>
                                <div class="pay_button">
                                    <%if(parseInt(node[i].pay_schedult) == 0){ %>
                                    <input type="submit" class="go_pay" bIndex="<%= j %>" dIndex="<%= i %>" value="去支付">
                                    <% }else if(parseInt(node[i].pay_schedult) == 2){ %>
                                    <input type="submit" class="go_pay" bIndex="<%= j %>" dIndex="<%= i %>" value="去支付">
                                    <% }else if(parseInt(node[i].pay_schedult) == 3){ %>
                                    <input type="submit" class="go_pay" bIndex="<%= j %>" dIndex="<%= i %>" value="支付中，请稍后.." disabled style="opacity: 0.6;">
                                    <% } %>
                                </div>
                            <% } %>


                                <!--支付明细 start-->
                                <% if(node[i].show_detail != 0){ %>
                                <div class="pay_record">
                                    <!--按钮-->
                                    <div class="pay_record_title" data-states="1" data-massage-id="<%= node[i].params.id %>" data-load-state="1">查看支付明细</div>
                                    <div class="pay_record_cont">
                                        <!--详情加载logo-->
                                        <div class="pay_record_lodding"></div>
                                        <!--详情主体-->
                                        <div class="pay_re_text">
                                            <!--三角形-->
                                            <div class="pay_re_arrow"></div>
                                            <!--内容-->
                                            <div class="pay_re_list">

                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <% } %>
                                <!--支付明细 end-->

                            </div>

                        <% } %>

                    </div>

                </div>
            </li>
            <% }else{ %>
            <!--支付节点未进行-->
            <li>
                <div class="node_logo">
                    <i class="<%= nodeLogo[pay_list[j].nodeid] %>"></i>
                </div>
                <p class="pay_errnode">
                    <%= pay_list[j].nodename %>
                    <% if(pay_list[j].draw_rate){ %>
                    （<%= parseInt(pay_list[j].draw_rate) %>%）
                    <% } %>
                </p>
            </li>
            <% } %>

            <% } %>
        </ul>
    </div>
</script>
<script  type="text/template" id="pay-record-template">
    <% for(var i = 0;i<data.length;i++){ %>
        <% var item = data[i]; %>
        <div class="record_mas_list">
            <%if(item.pay_money){ %>
                <p>支付金额：<%= item.pay_money %>元</p>
            <% } %>
            <!--支付凭证号-->
            <%if(item.referno){ %>
                <p class="clearfix"><span class="fl">支付凭证号：</span><%= item.referno %></p>
            <% } %>
            <!--pay time-->
            <%if(item.payday){ %>
                <p>支付时间：<%= item.payday %></p>
            <% } %>

            <table class="pay_table">
                <tr>
                    <th colspan="2">支付信息</th>
                </tr>
                <% if(item.nodename){ %>
                    <% if(item.nodename == "签设计协议"){ %>
                        <tr  class="pay_num">
                            <td>设计协议</td>
                            <td><%= item.needmoney %>元</td>
                        </tr>
                    <% }else{ %>
                        <tr  class="pay_num">
                            <td>意向定金</td>
                            <td><%= item.needmoney %>元</td>
                        </tr>
                    <% } %>
                <% } %>

                <% if(item.draw_rate && item.contract_money){ %>
                <tr class="pay_num">
                    <td><%= item.draw_rate %>合同款</td>
                    <td><%= item.contract_money %>元</td>
                </tr>
                <% } %>

                <% if(item.extrapay && item.extrapay != 0){ %>
                <tr class="pay_num">
                    <td>增减项</td>
                    <td><%= item.extrapay %>元</td>
                </tr>
                <% } %>

                <% if(item.deposit_money){ %>
                <tr class="pay_num">
                    <td>已交定金</td>
                    <td><%= item.deposit_money %>元</td>
                </tr>
                <% } %>

                <% if(item.pay_money){ %>
                <tr>
                    <td>
                        已支付
                    </td>
                    <td>
                        <%= item.pay_money %>元
                    </td>
                </tr>
                <% } %>
            </table>
        </div>
    <% } %>
</script>
<script type="text/javascript" src="<?php echo R;?>msite/base/js/zepto.min.js"></script>
<script type="text/javascript" src="<?php echo R;?>msite/base/js/underscore.min.js"></script>
<script type="text/javascript" src="<?php echo R;?>msite/base/js/swipe.js"></script>
<script type="text/javascript" src="<?php echo R;?>msite/base/js/pinchzoom.min.js"></script>
<script type="text/javascript" src="<?php echo R;?>msite/base/js/base.js"></script>
<script type="text/javascript" src="<?php echo R;?>msite/base/js/dxlazyload.js"></script>
<script type="text/javascript" src="<?php echo R;?>msite/building_live_new/js/pay_page.min.js"></script>
</body>
</html>
<script>

</script>