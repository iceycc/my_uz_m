<?php defined('IN_WZ') or exit('No direct script access allowed'); ?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>优装美家—管家式装修服务 有品质的低价</title>
    <meta name="keywords" content="装修管家,量房设计,装修施工,材料商城,环保方案,装修服务,装修图库,建材商城,装修攻略、优装网、装修网、优装美家">
    <meta name="description" content="优装美家为您提供免费专业咨询、免费量房、免费设计、免费装修保险、免费环保检测、优装网-专业装修网优选装修公司、优选建材商品、优选装修管家、优选环保服务">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">

    <link rel="stylesheet" href="<?php echo R;?>msite/building_live_new/css/iconfont.css">
    <link rel="stylesheet" href="<?php echo R;?>msite/base/css/base.css">
    <link rel="stylesheet" href="<?php echo R;?>msite/building_live_new/css/building_new.css">
    <link rel="stylesheet" href="<?php echo R;?>msite/building_live_new/css/mysite.css">
    <link rel="stylesheet" href="<?php echo R;?>msite/building_live_new/css/animate.css">
    <script>
        var _hmt = _hmt || [];
        (function() {
            var hm = document.createElement("script");
            hm.src = "https://hm.baidu.com/hm.js?0a9b93e0ac9bdda145e2d4f6ffa88ee5";
            var s = document.getElementsByTagName("script")[0];
            s.parentNode.insertBefore(hm, s);
        })();
    </script>
</head>
<body>
<header>
    <div class="tit_minu">
        <a id="go-back" target="_self" title="优装美家">
            <i class="iconfont icon-goback"></i>
        </a>
        <a class="back_index" href="mobile-index.html">首页</a>
    </div>
    <h1 class="header-title">我的工地</h1>
</header>

<section class="mysite_title">
    <div id="mysite_title">
        <script type="text/template" id="mysite-title-templete">
            <% var titnewnode = siteMassages.node %>
            <div class="mysite_title_order">
                <div class="clearfix mysite_tit_ordernumb">
                    <i class="iconfont color_999 icon-dingdanbianhaos fl"></i>
                    <p class="fl color_999" style="font-size: .6rem;">订单编号：<a href="javascript:;" class="color_999"><%=
                        titnewnode.order_no %></a></p>
                </div>
                <p class="textcenter ordername"><%= titnewnode.name %></p>
                <ul class="mysite_info">

                    <% if(titnewnode.budget){ %>
                        <li><%= titnewnode.budget %></li>
                    <% } %>

                    <% if(titnewnode.area){ %>
                        <li><%= titnewnode.area %>m²</li>
                    <% } %>

                    <% if(titnewnode.homestyle[0]){ %>
                        <li><%= titnewnode.homestyle[0] %></li>
                    <% } %>

                    <% if(titnewnode.way[0]){ %>
                        <li><%= titnewnode.way[0] %></li>
                    <% } %>
                </ul>

            </div>
        </script>
    </div>
    <!--kongjianduibitu start-->
    <section class="newspace" id="space_img">
        <script type="text/template" id="space-img-template">
            <% var spaceImgData = siteMassages.comparison_photo; %>
            <% if(spaceImgData){ %>
            <div class="new_space_cont">
                <div class="spacebox">
                    <% for(var i = 0;i < spaceImgData.length;i++){ %>
                    <% var item = spaceImgData[i]; %>
                    <% if(i == 0){ %>
                    <ul class="nspace_mode clearfix"  style="display: block;" type="<%= item.title %>">
                        <% }else{ %>
                        <ul class="nspace_mode clearfix"  type="<%= item.title %>" >
                            <% } %>
                            <li class="nspaceimg fl" type="big_attach1">
                                <img src="<%= item.attach1 %>">
                                <div class="nsp_mod nsp_mod_old">
                                    <i></i><span>装修前</span>
                                </div>
                            </li>
                            <li class="nspaceimg fl" type="big_attach2">
                                <img src="<%= item.attach2 %>">
                                <div class="nsp_mod nsp_mod_new">
                                    <span>装修后</span><i></i>
                                </div>
                            </li>
                        </ul>
                        <% } %>
                </div>

                <ol class="space_button">
                    <% for(var i = 0;i < spaceImgData.length;i++){ %>
                    <% var item = spaceImgData[i]; %>
                    <% if(i == 0){ %>
                    <li class="sp_btnlist active">
                        <% }else{ %>
                    <li class="sp_btnlist">
                        <% } %>
                        <i class="iconfont icon-<%= item.title %>"></i>
                        <span><%= spaceImgName[item.title] %></span>
                    </li>
                    <% } %>
                </ol>
            </div>
            <% } %>
        </script>
    </section>
    <!--空间照片对比图 end-->

    <div id="mysite_titlelink">
        <script type="text/template" id="mysite-titlelink-templete">
            <% var titnewnode = siteMassages.node %>
            <ul class="company_ul">
                <% if(titnewnode.gjname){ %>
                <li class="company_list company_list_company musite_butler">

                        <div class="company_icon_box fl">
                            <a href="/mobile-m_butler_details.html?butlerid=<%= titnewnode.uid %>">
                                <img src="<%= titnewnode.personalphotos %>" alt="">
                            </a>
                        </div>
                        <div class="company_name fl">

                            <p class="company_name1"><%= titnewnode.gjname %></p>

                            <p class="company_name2">(装修管家)</p>
                        </div>
                        <div class="phone_box fr">
                            <a href="tel:<%= titnewnode.mobile %>" style="color: #fff;">
                                <i class="iconfont icon-dianhuazb"></i>
                            </a>
                        </div>

                </li>

                <li class="musite_butler_dable"></li>
                <% } %>

                <% if(titnewnode.sta != 0){ %>
                <li class="company_list company_list_company musite_payment">
                    <a class="clearfix" href="/mobile-pay_page.html?order_id=<%= siteMassages.titleOrderid %>">
                        <div class="company_icon_box fl">
                            <i class="iconfont icon-shiliangzhinengduixiang2s"></i>
                        </div>
                        <div class="company_name fl">
                            <p class="payment_speed">支付进度</p>
                        </div>
                        <i class="iconfont icon-goback"></i>
                    </a>
                </li>
                <% } %>

                <% if(titnewnode.company){ %>
                <li class="company_list company_list_company">
                    <a class="clearfix" href="mobile-company_detail.html?company_id=<%= titnewnode.id %>">
                        <div class="company_icon_box fl">
                            <i class="iconfont icon-zhuangxiugongsis"></i>
                        </div>
                        <div class="company_name fl">
                            <p class="company_name1"><%= titnewnode.company %></p>
                            <p class="company_name2">(装修公司)</p>
                        </div>
                        <i class="iconfont icon-goback"></i>
                    </a>

                </li>
                <% } %>
            </ul>
        </script>
    </div>
</section>

<!--装修节点 s-->
<section class="zxnode_topcolorbg"></section>

<section class="zxnode">
    <ul class="zxnode_start  clearfix">
        <li class="zxnode_start_name">订单信息</li>
        <!-- 装修订单审核 s-->
        <li isload="0" ismassage="0" id="node21" class="isnodemassage zxnode_list  fr">
            <div class="zxnode_list_title clearfix" status="nodeclose">
                <span class="zxnodestatus fl">装修订单审核</span><i class="iconfont icon-gotonext fr"></i>
            </div>
            <div class="zxnode_logo">
                <i class="iconfont icon-dingdanshenhes zxnode_icon"></i>
                <span class="zxnode_logo_centerbg"></span>
                <p class="zxnode_times">15-10-10</p>
            </div>
            <!--节点内容-->
            <div class="zxnode_list_cont" id="snode21">
                <script type="text/template" id="snode21-cont-template">
                    <% for(var i = 0;i
                    <siteNodeMas.length;i++){%>
                    <% var item = siteNodeMas[i] %>
                    <% if(item.nodeid == 1 ){ %>
                    <div class="review">
                        <p class="review_tit"><%= item.title %></p>
                        <!--管家说-->
                        <% if(item.content){ %>
                        <ul class="butler_say">
                            <li class="clearfix butler_say_list">
                                <div class="fl say_logo">
                                    <img src="<%= item.gjphoto %>">
                                </div>
                                <div class="clearfix fl say_text">

                                    <p><span class="color_blue fl">【管家说】</span><%= item.content %></p>
                                </div>
                            </li>
                        </ul>
                        <% } %>
                    </div>
                    <% } %>
                    <% } %>
                </script>
            </div>
            <!--bottom border-->
            <div class="nodebottombor"></div>
        </li>
        <!-- 装修订单审核 e-->

        <!-- 为您精选3家装修公司 s-->
        <li isload="0" ismassage="0" id="node22" class="isnodemassage zxnode_list  fr">
            <div class="zxnode_list_title clearfix" status="nodeclose">
                <span class="zxnodestatus fl">为您精选<span class="companySize">3</span>家装修公司</span><i class="iconfont icon-gotonext fr"></i>
            </div>
            <div class="zxnode_logo">
                <i class="iconfont icon-jingxuangongsis zxnode_icon"></i>
                <span class="zxnode_logo_centerbg"></span>
                <p class="zxnode_times">15-10-10</p>
            </div>
            <!--节点内容-->
            <div class="zxnode_list_cont" id="snode22">
                <script type="text/template" id="snode22-cont-template">
                    <% for(var i = 0;i
                    <siteNodeMas.length;i++){%>
                    <% var item = siteNodeMas[i] %>
                    <% if(item.nodeid == 2 ){ %>

                    <ul class="three_company_bak">
                        <!--<% for(var j = 0;j<item.company.length;j++){%>
                            <% var itemcompany = item.company[j] %>
                            <li>
                                <a href="mobile-company_detail.html?company_id=<%= itemcompany.companyid %>">
                                    <p><%= itemcompany.companyname %></p>
                                    <span><%= itemcompany.avg_total %>分</span>
                                </a>
                            </li>
                            <% } %>-->

                        <!--2017-04-10 add 2.9 new start-->
                        <% for(var j = 0;j<item.company.length;j++ ){ %>
                        <% var companydata = item.company[j]; %>
                        <li class="comp_list company_link node_backlink">
                            <a class="comp_link_a" href="mobile-company_detail.html?company_id=<%= companydata.companyid %>"></a>
                            <div class="comp_title">
                                <p>第<%= j+1 %>家</p>
                                <div class="comp_gj_logo">
                                    <img src="<%= companydata.thumb %>">
                                </div>

                            </div>
                            <div class="comp_text">
                                <p class="comp_name"><%= companydata.companyname %></p>
                                <div class="comp_mark">
                                    <div class="comp_complete">
                                        <span class="comp_endname">已竣工:</span>
                                        <span class="comp_endnum"><%= companydata.completed %>家</span>
                                    </div>
                                    <div class="comp_abuilding">
                                        <span class="comp_abuildingname">在施工:</span>
                                        <span class="comp_abuildingnum"><%= companydata.unfinished %>家</span>
                                    </div>
                                </div>
                            </div>
                            <% if(parseFloat(companydata.design) != 0 || parseFloat(companydata.quality) != 0 || parseFloat(companydata.manner) != 0 || parseFloat(companydata.capacity) != 0){ %>
                            <div class="comp_grade">
                                <ul class="clearfix">
                                    <% if(parseFloat(companydata.design) != 0){ %>
                                    <li class="">设计<%= companydata.design %></li>
                                    <% } %>

                                    <% if(parseFloat(companydata.quality) != 0){ %>
                                    <li class="">施工<%= companydata.quality %></li>
                                    <% } %>

                                    <% if(parseFloat(companydata.manner) != 0){ %>
                                    <li class="">服务<%= companydata.manner %></li>
                                    <% } %>

                                    <% if(parseFloat(companydata.capacity) != 0){ %>
                                    <li class="">时效<%= companydata.capacity %></li>
                                    <% } %>
                                </ul>
                            </div>
                            <% } %>
                        </li>
                        <% } %>
                        <!--2017-04-10 add 2.9 new end-->

                    </ul>
                    <% if(item.content){ %>
                    <div class="review">
                        <!--管家说-->
                        <ul class="butler_say">
                            <li class="clearfix butler_say_list">
                                <div class="fl say_logo">
                                    <img src="<%= item.gjphoto %>">
                                </div>
                                <div class="clearfix fl say_text">

                                    <p><span class="color_blue fl">【管家说】</span><%= item.content %></p>
                                </div>
                            </li>
                        </ul>

                    </div>
                    <% } %>
                    <% } %>
                    <% } %>
                </script>
            </div>
            <!--bottom border-->
            <div class="nodebottombor"></div>
        </li>
        <!-- 为您精选3家装修公司 e-->

        <!-- 为您指定管家 s-->
        <li isload="0" ismassage="0" id="node23" class="isnodemassage zxnode_list  fr">
            <div class="zxnode_list_title clearfix" status="nodeclose">
                <span class="zxnodestatus fl">为您指定管家</span><i class="iconfont icon-gotonext fr"></i>
            </div>
            <div class="zxnode_logo">
                <i class="iconfont icon-zhidingguanjias zxnode_icon"></i>
                <span class="zxnode_logo_centerbg"></span>
                <p class="zxnode_times">15-10-10</p>
            </div>
            <!--节点内容-->
            <div class="zxnode_list_cont" id="snode23">
                <script type="text/template" id="snode23-cont-template">
                    <% for(var i = 0;i
                    <siteNodeMas.length;i++){%>
                    <% var item = siteNodeMas[i] %>
                    <% if(item.nodeid == 9 ){ %>
                   <!-- <div class="appoint_butler clearfix">
                        <div class="appoint_butler_logo fl">
                            <img src="<%= item.personalphoto %>" alt="">
                        </div>
                        <div class="appoint_butler_text fl">
                            <p><%= item.gjname.gjname %></p>
                            <div>
                                <div class="phone_box fl">
                                    <a href="tel:<%= item.gjname.mobile %>" style="color: #fff;">
                                        <i class="iconfont icon-dianhuazb"></i>
                                    </a>
                                </div>
                                <a class="fl butler_phonenum" href="tel:<%= item.gjname.mobile %>"
                                   style="color: #666;"><%=
                                    item.gjname.mobile %></a>
                            </div>

                        </div>
                    </div>-->
                    <ul class="three_company_bak appoint_gj">
                        <li class="comp_list">
                            <div class="comp_title">
                                <p>我是您的装修管家，很高兴为您服务！</p>
                                <div class="comp_gj_logo">
                                    <img src="<%= item.personalphoto %>">
                                </div>
                            </div>
                            <div class="comp_text">
                                <div class="comp_complete">
                                    <span class="comp_endname appoint_gjname"><%= item.gjname %></span>
                                    <span class="comp_endnum color_red"><%= item.level %></span>
                                </div>
                                <div class="comp_mark">
                                    <div class="comp_complete">
                                        <span class="comp_endname">从业时间:</span>
                                        <span class="comp_endnum"><%= item.worktime %>年</span>
                                    </div>
                                    <div class="comp_abuilding">
                                        <span class="comp_abuildingname">服务客户:</span>
                                        <span class="comp_abuildingnum"><%= item.service_num %>个</span>
                                    </div>
                                </div>
                            </div>
                            <% if(parseFloat(item.professional) != 0 || parseFloat(item.serve) != 0 || parseFloat(item.coordinate) != 0){ %>
                            <div class="comp_grade">
                                <ul class="clearfix">
                                    <% if(parseFloat(item.professional) != 0){ %>
                                    <li class="">专业<%= item.professional %></li>
                                    <% } %>

                                    <% if(parseFloat(item.serve) != 0){ %>
                                    <li class="">服务<%= item.serve %></li>
                                    <% } %>

                                    <% if(parseFloat(item.coordinate) != 0){ %>
                                    <li class="">协调<%= item.coordinate %></li>
                                    <% } %>

                                </ul>
                            </div>
                            <% } %>
                            <p class="gj_phonenum">
                                <a href="tel:<%= item.mobile %>">电话:&nbsp;&nbsp;<%= item.mobile %>&nbsp;&nbsp;<i class="iconfont icon-dianhua11"></i></a>
                            </p>
                            <p class="see_jgmoremas node_backlink"><a class="comp_link_a" href="mobile-m_butler_details.html?butlerid=<%= item.housekeeper_id %>">查看管家更多信息>></a></p>
                        </li>

                        <!--2017-04-10 add 2.9 new end-->

                    </ul>
                    <% if(item.content){ %>
                    <div class="review">
                        <!--管家说-->
                        <ul class="butler_say">
                            <li class="clearfix butler_say_list">
                                <div class="fl say_logo">
                                    <img src="<%= item.gjphoto %>">
                                </div>
                                <div class="clearfix fl say_text">

                                    <p><span class="color_blue fl">【管家说】</span><%= item.content %></p>
                                </div>
                            </li>
                        </ul>

                    </div>
                    <% } %>
                    <% } %>
                    <% } %>
                </script>
            </div>
            <!--bottom border-->
            <div class="nodebottombor"></div>
        </li>
        <!-- 为您指定管家 e-->

    </ul>
    <ul class="zxnode_start zxnode_march clearfix">
        <li class="zxnode_start_name">装修前</li>

        <!-- 预约见面 s-->
        <li isload="0" ismassage="0" id="node24" class="isnodemassage zxnode_list  fr">
            <div class="zxnode_list_title clearfix" status="nodeclose">
                <span class="zxnodestatus fl">预约见面</span><i class="iconfont icon-gotonext fr"></i>
            </div>
            <div class="zxnode_logo">
                <i class="iconfont icon-yuyuejianmian zxnode_icon"></i>
                <span class="zxnode_logo_centerbg"></span>
                <p class="zxnode_times">15-10-10</p>
            </div>
            <!--节点内容-->
            <div class="zxnode_list_cont" id="snode24">
                <script type="text/template" id="snode24-cont-template">
                    <% for(var i = 0;i
                    <siteNodeMas.length;i++){%>
                    <% var item = siteNodeMas[i] %>
                    <% if(item.nodeid == 101 ){ %>
                    <div class="new_review">
                        <% if(item.photo.length>0 || item.content){ %>
                        <div style="padding:.9rem .5rem 0 .7rem;">
                            <% if(item.photo.length>0){ %>
                            <ul class="pre_img clearfix">
                                <% var photos = item.photo %>
                                <% for(var p = 0;p
                                <photos.length
                                        ;p++){ %>
                                    <% if(photos.length<1){break;} %>
                                    <li class="pre_list fl">
                                        <div class="pre_list_imgbox">
                                            <img src="<%= photos[p] %>" alt="">
                                        </div>
                                    </li>
                                    <% } %>

                            </ul>
                        <% } %>

                        </div>
                        <% } %>
                        <!--管家说-->
                        <% if(item.content){ %>
                        <ul class="butler_say">
                            <li class="clearfix butler_say_list">
                                <div class="fl say_logo">
                                    <img src="<%= item.gjphoto %>">
                                </div>
                                <div class="clearfix fl say_text">

                                    <p><span class="color_blue fl">【管家说】</span><%= item.content %></p>
                                </div>
                            </li>
                        </ul>
                        <% } %>
                        <% if(item.company && item.company.length > 0){ %>
                        <ul class="amount_firm node_jianmain">
                            <% for(var j = 0;j<item.company.length;j++){ %>
                            <% var compItem = item.company[j]; %>
                            <li>
                                <p>装修公司<%= j+1 %>：<%= compItem.col2 %></p>
                                <p class="color_blue">预约见面时间：<%= compItem.addtime %></p>
                            </li>
                            <% } %>
                        </ul>
                        <% } %>
                    </div>
                    <% } %>
                    <% } %>
                </script>
            </div>
            <!--bottom border-->
            <div class="nodebottombor"></div>

        </li>
        <!-- 预约见面 e-->

        <!-- 见面 s-->
        <li isload="0" ismassage="0" id="node25" class="isnodemassage zxnode_list  fr">
            <div class="zxnode_list_title clearfix" status="nodeclose">
                <span class="zxnodestatus fl">见面</span><i class="iconfont icon-gotonext fr"></i>
            </div>
            <div class="zxnode_logo">
                <i class="iconfont icon-jianmian zxnode_icon"></i>
                <span class="zxnode_logo_centerbg"></span>
                <p class="zxnode_times">15-10-10</p>
            </div>
            <!--节点内容-->
            <div class="zxnode_list_cont" id="snode25">
                <script type="text/template" id="snode25-cont-template">
                    <% for(var i = 0;i
                    <siteNodeMas.length;i++){%>
                    <% var item = siteNodeMas[i] %>
                    <% if(item.nodeid == 102 ){ %>
                    <div class="new_review">
                        <% if(item.photo.length>0 || item.content){ %>
                        <div style="padding:.9rem .5rem 0 .7rem;">
                            <% if(item.photo.length>0){ %>
                            <ul class="pre_img clearfix">
                                <% var photos = item.photo %>
                                <% for(var p = 0;p
                                <photos.length
                                        ;p++){ %>
                                    <% if(photos.length<1){break;} %>
                                    <li class="pre_list fl">
                                        <div class="pre_list_imgbox">
                                            <img src="<%= photos[p] %>" alt="">
                                        </div>
                                    </li>
                                    <% } %>

                            </ul>
                            <% } %>

                        </div>
                        <% } %>
                        <!--管家说-->
                        <% if(item.content){ %>
                        <ul class="butler_say">
                            <li class="clearfix butler_say_list">
                                <div class="fl say_logo">
                                    <img src="<%= item.gjphoto %>">
                                </div>
                                <div class="clearfix fl say_text">

                                    <p><span class="color_blue fl">【管家说】</span><%= item.content %></p>
                                </div>
                            </li>
                        </ul>
                        <% } %>
                        <% if(item.company && item.company.length > 0){ %>
                        <ul class="amount_firm node_jianmain">
                            <% for(var j = 0;j<item.company.length;j++){ %>
                            <% var compItem = item.company[j]; %>
                            <li>
                                <p>装修公司<%= j+1 %>：<%= compItem.col2 %></p>
                                <p class="color_blue">预约见面时间：<%= compItem.addtime %></p>
                            </li>
                            <% } %>
                        </ul>
                        <% } %>

                        <!--<p class="node_jianm_title">选定装修公司：北京绿缘居装饰工程有限公司</p>-->


                       <!-- <table class="pay_table">

                            <tr>
                                <th colspan="2">支付信息</th>
                            </tr>
                            <tr>
                                <td>增减项</td>
                                <td>0.00</td>
                            </tr>
                            <tr>
                                <td>已付款</td>
                                <td>0.00</td>
                            </tr>

                        </table>-->
                    </div>
                    <% } %>
                    <% } %>
                </script>
            </div>
            <!--bottom border-->
            <div class="nodebottombor"></div>
        </li>
        <!-- 见面 e-->

        <!-- 预约量房 s-->
        <li isload="0" ismassage="0" id="node26" class="isnodemassage zxnode_list  fr">
            <div class="zxnode_list_title clearfix" status="nodeclose">
                <span class="zxnodestatus fl">预约量房</span><i class="iconfont icon-gotonext fr"></i>
            </div>
            <div class="zxnode_logo">
                <i class="iconfont icon-yuyueliangfangs zxnode_icon"></i>
                <span class="zxnode_logo_centerbg"></span>
                <p class="zxnode_times">15-10-10</p>
            </div>
            <!--节点内容-->
            <div class="zxnode_list_cont" id="snode26">
                <script type="text/template" id="snode26-cont-template">
                    <% for(var i = 0;i
                    <siteNodeMas.length;i++){%>
                    <% var item = siteNodeMas[i] %>
                    <% if(item.nodeid == 10 ){ %>
                    <div class="review">

                        <% if(item.photo.length>0){ %>
                        <ul class="pre_img clearfix">
                            <% var photos = item.photo %>
                            <% for(var p = 0;p
                            <photos.length
                                    ;p++){ %>
                                <% if(photos.length<1){break;} %>
                                <li class="pre_list fl">
                                    <div class="pre_list_imgbox">
                                        <img src="<%= photos[p] %>" alt="">
                                    </div>
                                </li>
                                <% } %>

                        </ul>
                        <% } %>
                        <!--管家说-->
                        <% if(item.content){ %>
                        <ul class="butler_say">
                            <li class="clearfix butler_say_list">
                                <div class="fl say_logo">
                                    <img src="<%= item.gjphoto %>">
                                </div>
                                <div class="clearfix fl say_text">
                                    <p><span class="color_blue fl">【管家说】</span><%= item.content %></p>
                                </div>
                            </li>
                        </ul>
                        <% } %>
                        <ul class="three_company">
                            <% for(var j = 0;j
                            <item.companyname.length
                                    ;j++){%>
                                <% var itemcompany = item.companyname[j] %>
                                <li>
                                    <a href="mobile-company_detail.html?company_id=<%= itemcompany.col1 %>">
                                        <p>装修公司<%= j+1 %>：<%= itemcompany.col2 %></p>
                                        <span class="color_blue">预约量房时间：<%= itemcompany.date1 %></span>
                                    </a>
                                </li>
                                <% } %>
                        </ul>
                    </div>
                    <% } %>
                    <% } %>
                </script>
            </div>
            <!--bottom border-->
            <div class="nodebottombor"></div>
        </li>
        <!-- 预约量房 e-->

        <!-- 上门量房 s-->
        <li isload="0" ismassage="0" id="node1" class="isnodemassage zxnode_list fr">
            <div class="zxnode_list_title clearfix" status="nodeclose">
                <span class="zxnodestatus fl">上门量房</span><i class="iconfont icon-gotonext fr"></i>
            </div>
            <div class="zxnode_logo">
                <i class="iconfont icon-liangfang zxnode_icon"></i>
                <span class="zxnode_logo_centerbg"></span>
                <p class="zxnode_times">15-10-10</p>
            </div>
            <!--节点内容-->
            <div class="zxnode_list_cont" id="snode1">
                <script type="text/template" id="snode1-cont-template">

                    <% for(var i = 0;i
                    <siteNodeMas.length;i++){%>
                    <% var item = siteNodeMas[i] %>
                    <% if(item.nodeid == 11 ){ %>
                    <div class="amount_room" style="padding-bottom: 1rem;">
                        <% if(item.photo.length>0){ %>
                        <ul class="pre_img clearfix">
                            <% var photos = item.photo %>
                            <% for(var p = 0;p
                            <photos.length
                                    ;p++){ %>
                                <% if(photos.length<1){break;} %>
                                <li class="pre_list fl">
                                    <div class="pre_list_imgbox">
                                        <img src="<%= photos[p] %>" alt="">
                                    </div>
                                </li>
                                <% } %>

                        </ul>
                        <% } %>
                        <!--管家说-->
                        <% if(item.content){ %>
                        <ul class="butler_say">
                            <li class="clearfix butler_say_list">
                                <div class="fl say_logo">
                                    <img src="<%= item.gjphoto %>">
                                </div>
                                <div class="clearfix fl say_text">

                                    <p><span class="color_blue fl">【管家说】</span><%= item.content %></p>
                                </div>
                            </li>
                        </ul>
                        <% } %>
                        <% if(item.companyname){ %>
                        <ul class="amount_firm">

                            <% var companys = item.companyname %>
                            <% for(var j = 0;j
                            <companys.length
                                    ;j++){ %>
                                <% if(companys[j].col8 == "是"){ %>
                                <% companys[j].col8 = "已量房"; %>
                                <% }else if(companys[j].col8 == "否"){ %>
                                <% companys[j].col8 = "未量房"; %>
                                <% } %>
                                <li>
                                    <p><%= companys[j].col2 %></p>
                                    <span class="color_blue"><%= companys[j].col8 %></span>
                                </li>
                                <% } %>
                        </ul>
                        <% } %>
                        <!--<% if(item.check_detail.length > 0){ %>
                        <table class="meter_table">
                            <tr>
                                <th>量房现场信息</th>
                                <th>结果</th>
                            </tr>

                            <% var checkDetail = item.check_detail %>
                            <% for(var u = 0;u
                            <checkDetail.length
                                    ;u++){ %>
                                <tr>
                                    <td><%= checkDetail[u].title %></td>
                                    <td><%= checkDetail[u].qua %></td>
                                </tr>
                                <% } %>
                        </table>
                        <% } %>-->
                    </div>
                    <% } %>
                    <% } %>
                </script>
            </div>
            <!--bottom border-->
            <div class="nodebottombor"></div>
        </li>
        <!-- 上门量房 e-->

        <!--报价审核 s-->
        <li isload="0" ismassage="0" id="node2" class="isnodemassage zxnode_list fr">
            <div class="zxnode_list_title clearfix" status="nodeclose">
                <span class="zxnodestatus fl">报价审核</span><i class="iconfont icon-gotonext fr"></i>
            </div>
            <div class="zxnode_logo">
                <i class="iconfont icon-dingdanshenhes zxnode_icon"></i>
                <span class="zxnode_logo_centerbg"></span>
                <p class="zxnode_times">15-10-10</p>
            </div>
            <!--节点内容-->
            <div class="zxnode_list_cont" id="snode2">
                <script type="text/template" id="snode2-cont-template">

                    <% for(var i = 0;i
                    <siteNodeMas.length;i++){%>
                    <% var item = siteNodeMas[i] %>

                    <% if(item.nodeid == 12 ){ %>


                    <div class="review">
                        <% if(item.photo.length>0){ %>
                        <ul class="pre_img clearfix">
                            <% var photos = item.photo %>
                            <% for(var p = 0;p
                            <photos.length
                                    ;p++){ %>
                                <% if(photos.length<1){break;} %>
                                <li class="pre_list fl">
                                    <div class="pre_list_imgbox">
                                        <img src="<%= photos[p] %>" alt="">
                                    </div>
                                </li>
                                <% } %>

                        </ul>
                        <% } %>
                        <!--管家说-->
                        <% if(item.content){ %>
                        <ul class="butler_say">
                            <li class="clearfix butler_say_list">
                                <div class="fl say_logo">
                                    <img src="<%= item.gjphoto %>">
                                </div>
                                <div class="clearfix fl say_text">

                                    <p><span class="color_blue fl">【管家说】</span><%= item.content %></p>
                                </div>
                            </li>
                        </ul>
                        <% } %>

                        <% if(item.company_photo.length > 0){ %>
                        <p class="review_tit" style="margin-bottom: -1rem;"><%= item.company_name %></p>
                        <ul class="company_audit clearfix">
                            <% for(var j = 0;j
                            <item.company_photo.length
                                    ;j++){ %>

                                <% var conpanyItem = item.company_photo[j]; %>


                                <li class="company_photo_parent clearfix company_img_ul">
                                    <p class="fontsize07 color_999  company_audit_p"><%= j+1 %>. <%=
                                        conpanyItem.company_name %></p>
                                    <ol class="clearfix company_img_ul">
                                        <% if(conpanyItem.quote){ %>
                                            <% if(conpanyItem.quote.length > 1){ %>

                                                <li class="fl company_img_list company_img_first company_pnoto_table"
                                                    iscont="0">
                                                    <div class="company_imgbox company_imgbox_down">
                                                        <div class="company_imgboxcont">
                                                            <img src="<%= conpanyItem.quote[1] %>" alt="">
                                                        </div>
                                                    </div>
                                                    <div class="company_imgbox company_imgbox_up">
                                                        <div class="company_imgboxcont">
                                                            <img src="<%= conpanyItem.quote[0] %>" alt="">
                                                        </div>
                                                    </div>
                                                    <p class="fontsize07 textcenter color_999 company_audit_p">报价详情</p>
                                                </li>
                                            <% }else{ %>
                                                <li class="fl company_img_list company_img_first company_pnoto_table"
                                                    iscont="0">
                                                    <div class="company_imgbox">
                                                        <div class="company_imgboxcont">
                                                            <img src="<%= conpanyItem.quote[0] %>" alt="">
                                                        </div>
                                                    </div>
                                                    <p class="fontsize07 textcenter color_999 company_audit_p">报价详情</p>
                                                </li>

                                            <% } %>
                                        <% } %>

                                        <% if(conpanyItem.design_photo){ %>
                                        <% if(conpanyItem.design_photo.length > 1){ %>
                                            <li class="fl company_img_list  company_pnoto_table" iscont="1">

                                                <div class="company_imgbox company_imgbox_down">
                                                    <div class="company_imgboxcont">
                                                        <img src="<%= conpanyItem.design_photo[1] %>" alt="">
                                                    </div>
                                                </div>
                                                <div class="company_imgbox company_imgbox_up">
                                                    <div class="company_imgboxcont">
                                                        <img src="<%= conpanyItem.design_photo[0] %>" alt="">
                                                    </div>
                                                </div>

                                                <p class="fontsize07 color_999 textcenter company_audit_p">图纸</p>
                                            </li>
                                        <% }else{ %>
                                            <li class="fl company_img_list  company_pnoto_table" iscont="1">
                                                <div class="company_imgbox company_imgbox_up">
                                                    <div class="company_imgboxcont">
                                                        <img src="<%= conpanyItem.design_photo[0] %>" alt="">
                                                    </div>
                                                </div>

                                                <p class="fontsize07 color_999 textcenter company_audit_p">图纸</p>
                                            </li>
                                        <% } %>
                                        <% } %>
                                    </ol>


                                </li>

                                <% } %>

                                <!--second-->

                        </ul>
                        <% } %>
                        <!--审核报告-->
                        <!--zongjie-->
                        <% if(item.bj_photo && item.bj_photo.length > 0){ %>
                            <div class="company_audit_list company_audit_shenhe">

                                <% if(item.bj_photo){ %>
                                <% if(item.bj_photo.length > 1){ %>
                                <p class="fontsize07 color_999  company_audit_p"><%= item.company_names %>.</p>
                                <ol class="clearfix company_img_ul audit_report ">
                                    <li class="fl company_img_list company_img_first " uid="<%= item.uid %>">
                                        <div class="company_imgbox company_imgbox_down">
                                            <div class="company_imgboxcont">
                                                <img src="<%= item.bj_photo[1] %>" alt="">
                                            </div>
                                        </div>
                                        <div class="company_imgbox company_imgbox_up">
                                            <div class="company_imgboxcont">
                                                <img src="<%= item.bj_photo[0] %>" alt="">
                                            </div>
                                        </div>
                                        <p class="fontsize07 textcenter color_999 company_audit_p">审核报告</p>
                                    </li>
                                </ol>
                                <% }else{ %>

                                <ol class="clearfix company_img_ul audit_report ">
                                    <li class="fl company_img_list company_img_first " uid="<%= item.uid %>">
                                        <div class="company_imgbox">
                                            <div class="company_imgboxcont">
                                                <img src="<%= item.bj_photo[0] %>" alt="">
                                            </div>
                                        </div>
                                        <p class="fontsize07 textcenter color_999 company_audit_p">审核报告</p>
                                    </li>
                                </ol>
                                <% } %>
                                <% } %>
                            </div>
                        <% } %>
                    </div>
                    <% } %>
                    <% } %>
                </script>
            </div>
            <!--bottom border-->
            <div class="nodebottombor"></div>
        </li>
        <!--报价审核 e-->

        <!--签订意向定金 s-->
        <li isload="0" ismassage="0" id="node3" class="isnodemassage zxnode_list fr">
            <div class="zxnode_list_title clearfix" status="nodeclose">
                <span class="zxnodestatus fl">签订意向定金</span><i class="iconfont icon-gotonext fr"></i>
            </div>
            <div class="zxnode_logo">
                <i class="iconfont icon-yixiangdingjins zxnode_icon"></i>
                <span class="zxnode_logo_centerbg"></span>
                <p class="zxnode_times">15-10-10</p>
            </div>
            <!--节点内容-->
            <div class="zxnode_list_cont" id="snode3">
                <script type="text/template" id="snode3-cont-template">

                    <% for(var i = 0;i
                    <siteNodeMas.length;i++){%>
                    <% var item = siteNodeMas[i] %>

                    <% if(item.nodeid == 15 ){ %>

                    <div class="review">
                        <% if(item.photo.length>0){ %>
                        <ul class="pre_img clearfix">
                            <% var photos = item.photo %>
                            <% for(var p = 0;p
                            <photos.length
                                    ;p++){ %>
                                <% if(photos.length<1){break;} %>
                                <li class="pre_list fl">
                                    <div class="pre_list_imgbox">
                                        <img src="<%= photos[p] %>" alt="">
                                    </div>
                                </li>
                                <% } %>
                        </ul>
                        <% } %>
                        <!--管家说-->
                        <% if(item.content){ %>
                        <ul class="butler_say">
                            <li class="clearfix butler_say_list">
                                <div class="fl say_logo">
                                    <img src="<%= item.gjphoto %>">
                                </div>
                                <div class="clearfix fl say_text">

                                    <p><span class="color_blue fl">【管家说】</span><%= item.content %></p>
                                </div>
                            </li>
                        </ul>
                        <% } %>
                    </div>

                    <% } %>
                    <% } %>
                </script>
            </div>
            <!--bottom border-->
            <div class="nodebottombor"></div>
        </li>
        <!--签订意向定金 e-->

        <!--预交底 s-->
        <li isload="0" ismassage="0" id="node4" class="isnodemassage zxnode_list fr">
            <div class="zxnode_list_title clearfix" status="nodeopen">
                <span class="zxnodestatus fl">预交底</span><i class="iconfont icon-gotonext fr"></i>
            </div>
            <div class="zxnode_logo">
                <i class="iconfont icon-yujiaodiss zxnode_icon"></i>
                <span class="zxnode_logo_centerbg"></span>
                <p class="zxnode_times">15-10-10</p>
            </div>
            <!--节点内容-->
            <div class="zxnode_list_cont" id="snode4">
                <script type="text/template" id="snode4-cont-template">

                    <% for(var i = 0;i
                    <siteNodeMas.length;i++){%>
                    <% var item = siteNodeMas[i] %>

                    <% if(item.nodeid == 17 ){ %>
                    <div class="review">

                        <% if(item.photo.length>0){ %>
                        <ul class="pre_img clearfix">
                            <% var photos = item.photo %>
                            <% for(var p = 0;p
                            <photos.length
                                    ;p++){ %>
                                <% if(photos.length<1){break;} %>
                                <li class="pre_list fl">
                                    <div class="pre_list_imgbox">
                                        <img src="<%= photos[p] %>" alt="">
                                    </div>
                                </li>
                                <% } %>
                        </ul>
                        <% } %>
                        <!--管家说-->
                        <% if(item.content){ %>
                        <ul class="butler_say">
                            <li class="clearfix butler_say_list">
                                <div class="fl say_logo">
                                    <img src="<%= item.gjphoto %>">
                                </div>
                                <div class="clearfix fl say_text">

                                    <p><span class="color_blue fl">【管家说】</span><%= item.content %></p>
                                </div>
                            </li>
                        </ul>
                        <% } %>
                        <div>
                            <% if(item.col8){ %>
                            <p class="pre_cen_tit fontsize07 ">现场参与人员：<%= item.col8 %></p>
                            <% } %>

                            <% if(item.col5){ %>
                            <p class="pre_cen_tit fontsize07 ">设计方案是否调整：<%= item.col5 %></p>
                            <% } %>

                            <% if(item.col6){ %>
                            <p class="pre_cen_tit fontsize07 ">报价是否有细化和增项：<%= item.col6 %></p>
                            <% } %>

                            <% if(item.addtimes){ %>
                            <p class="pre_cen_tit fontsize07 ">最终版设计方案和报价完成时间：<%= item.addtimes %></p>
                            <% } %>
                        </div>
                        <!--预交底现场-->
                        <% if(item.check_detail.length > 0){ %>
                        <table class="meter_table">
                            <tr>
                                <th>预交底现场信息</th>
                                <th>结果</th>
                            </tr>

                            <% var checkDetail = item.check_detail %>
                            <% for(var u = 0;u
                            <checkDetail.length
                                    ;u++){ %>
                                <tr>
                                    <td><%= checkDetail[u].title %></td>
                                    <%if(checkDetail[u].qua == '合格'){  %>
                                    <td>是</td>
                                    <% }else{ %>
                                    <td>否</td>
                                    <% } %>
                                </tr>
                                <% } %>
                        </table>
                        <% } %>
                    </div>
                    <% if(item.check_other.length > 0){ %>

                    <ol class="space_photo clearfix jungong_space">
                        <% for(var t = 0;t
                        <item.check_other.length
                                ;t++){ %>
                            <% var checkOther = item.check_other[t]; %>
                            <li class="space_photo_list fl">
                                <% if(checkOther.img_yse.length == 1){ %>
                                <div class="space_photo_boxpar">
                                    <div class="space_photo_border">
                                        <div class="space_photo_box">
                                            <img src="<%= checkOther.img_yse[0] %>" alt="">
                                        </div>
                                    </div>
                                </div>
                                <% }else if(checkOther.img_yse.length > 1 ){ %>
                                <div class="space_photo_boxpar" style="top: -.4rem;">
                                    <div class="space_photo_border space_box_up">
                                        <div class="space_photo_box ">
                                            <img src="<%= checkOther.img_yse[0] %>" alt="">
                                        </div>
                                    </div>
                                    <div class="space_photo_border space_box_down">
                                        <div class="space_photo_box ">
                                            <img src="<%= checkOther.img_yse[1] %>" alt="">
                                        </div>
                                    </div>
                                </div>
                                <% } %>
                                <p class="fontsize07 textcenter color333 lineheight15"><%= checkOther.title %></p>
                            </li>
                            <% } %>
                    </ol>
                    <% } %>
                    <% } %>
                    <% } %>
                </script>
            </div>
            <!--bottom border-->
            <div class="nodebottombor"></div>
        </li>
        <!--预交底 e-->

        <!--签订三方合同 s-->
        <li isload="0" ismassage="0" id="node5" class="isnodemassage zxnode_list fr">
            <div class="zxnode_list_title clearfix" status="nodeclose">
                <span class="zxnodestatus fl">签订三方合同</span><i class="iconfont icon-gotonext fr"></i>
            </div>
            <div class="zxnode_logo">
                <i class="iconfont icon-qiandingsanfanghetongs zxnode_icon"></i>
                <span class="zxnode_logo_centerbg"></span>
                <p class="zxnode_times">15-10-10</p>
            </div>
            <!--节点内容-->
            <div class="zxnode_list_cont" id="snode5">
                <script type="text/template" id="snode5-cont-template">

                    <% for(var i = 0;i
                    <siteNodeMas.length;i++){%>
                    <% var item = siteNodeMas[i] %>

                    <% if(item.nodeid == 19 ){ %>
                    <div class="review">
                        <% if(item.photo.length>0){ %>
                        <ul class="pre_img clearfix">
                            <% var photos = item.photo %>
                            <% for(var p = 0;p
                            <photos.length
                                    ;p++){ %>
                                <% if(photos.length<1){break;} %>
                                <li class="pre_list fl">
                                    <div class="pre_list_imgbox">
                                        <img src="<%= photos[p] %>" alt="">
                                    </div>
                                </li>
                                <% } %>

                        </ul>
                        <% } %>
                        <!--管家说-->
                        <% if(item.content){ %>
                        <ul class="butler_say">
                            <li class="clearfix butler_say_list">
                                <div class="fl say_logo">
                                    <img src="<%= item.gjphoto %>">
                                </div>
                                <div class="clearfix fl say_text">

                                    <p><span class="color_blue fl">【管家说】</span><%= item.content %></p>
                                </div>
                            </li>
                        </ul>
                        <% } %>
                        <div>
                            <% if(item.pay && item.pay.length > 0){ %>
                            <div class="review_tit color999 margintop05">
                                <% if(item.company){ %>
                                <p class="review_tit">签订公司：<%= item.company.col2 %></p>
                                <% } %>
                                <% if(item.pay[0].contactno){ %>
                                    <p>合同编号：<%= item.pay[0].contactno %></p>
                                <% } %>

                                <% if(item.pay[0].totalpay){ %>
                                    <p>合同总金额：<%= item.pay[0].totalpay %></p>
                                <% } %>
                            </div>
                            <% } %>
                        </div>



                        <% if(item.pz_photo){ %>
                        <div class="margintop1">
                            <div class="company_imgbox marginauto">
                                <% if(item.pz_photo.length == 1){ %>
                                <div class="company_imgboxcont">
                                    <img src="<%= item.pz_photo[0]%>" alt="">
                                </div>
                                <% }else{ %>
                                    <div class="company_imgbox company_imgbox_down" style="top: -.1rem; left: -.1rem">
                                        <div class="company_imgboxcont">
                                            <img src="<%= item.pz_photo[1]%>"
                                                 alt="">
                                        </div>
                                    </div>
                                    <div class="company_imgbox company_imgbox_up" style="top: .2rem;left: .2rem;">
                                        <div class="company_imgboxcont">
                                            <img src="<%= item.pz_photo[0]%>" alt="">
                                        </div>
                                    </div>

                                <% } %>
                            </div>
                            <p class="fontsize07 color_999 textcenter company_audit_p">凭证</p>
                        </div>
                        <% } %>

                    </div>

                    <% } %>
                    <% } %>
                </script>
            </div>
            <!--bottom border-->
            <div class="nodebottombor"></div>
        </li>
        <!--签订三方合同 e-->
    </ul>
    <ul class="zxnode_start zxnode_march clearfix">
        <li class="zxnode_start_name">装修中</li>
        <!--开工仪式 s-->
        <li isload="0" ismassage="0" id="node6" class="isnodemassage zxnode_list fr">
            <div class="zxnode_list_title clearfix" status="nodeclose">
                <span class="zxnodestatus fl">开工仪式</span><i class="iconfont icon-gotonext fr"></i>
            </div>
            <div class="zxnode_logo">
                <i class="iconfont icon-kaigongyishis zxnode_icon"></i>
                <span class="zxnode_logo_centerbg"></span>
                <p class="zxnode_times">15-10-10</p>
            </div>
            <!--节点内容-->
            <div class="zxnode_list_cont" id="snode6">
                <script type="text/template" id="snode6-cont-template">

                    <% for(var i = 0;i
                    <siteNodeMas.length;i++){%>
                    <% var item = siteNodeMas[i] %>

                    <% if(item.nodeid == 21 ){ %>
                    <div class="review">
                        <% if(item.gjsphoto){ %>
                        <% var ImgNum = "block"; %>
                        <% if(item.gjsphoto.length<1){ ImgNum = "none" } %>
                        <ul class="pre_img clearfix" style="display:<%= ImgNum %>">
                            <% var photos = item.gjsphoto %>
                            <% for(var p = 0;p<photos.length;p++){ %>
                                <% if(photos.length<1){break;} %>
                                <li class="pre_list fl">
                                    <div class="pre_list_imgbox">
                                        <img src="<%= photos[p] %>" alt="">
                                    </div>
                                </li>
                                <% } %>

                        </ul>
                        <% } %>
                        <!--管家说-->
                        <% if(item.content){ %>
                        <ul class="butler_say">
                            <li class="clearfix butler_say_list">
                                <div class="fl say_logo">
                                    <img src="<%= item.gjphoto %>">
                                </div>
                                <div class="clearfix fl say_text">

                                    <p><span class="color_blue fl">【管家说】</span><%= item.content %></p>
                                </div>
                            </li>
                        </ul>
                        <% } %>
                        <p class="pre_cen_tit fontsize07">现场参与人员：<%= item.col8 %></p>
                    </div>


                    <% if(item.check_other.length > 0){ %>
                    <ol class="space_photo clearfix jungong_space">
                        <% for(var t = 0;t
                        <item.check_other.length
                                ;t++){ %>
                            <% var checkOther = item.check_other[t]; %>
                            <li class="space_photo_list fl">
                                <% if(checkOther.img_yse.length == 1){ %>
                                <div class="space_photo_boxpar">
                                    <div class="space_photo_border">
                                        <div class="space_photo_box">
                                            <img src="<%= checkOther.img_yse[0] %>" alt="">
                                        </div>
                                    </div>
                                </div>
                                <% }else if(checkOther.img_yse.length > 1 ){ %>
                                <div class="space_photo_boxpar" style="top: -.4rem;">
                                    <div class="space_photo_border space_box_up">
                                        <div class="space_photo_box ">
                                            <img src="<%= checkOther.img_yse[0] %>" alt="">
                                        </div>
                                    </div>
                                    <div class="space_photo_border space_box_down">
                                        <div class="space_photo_box ">
                                            <img src="<%= checkOther.img_yse[1] %>" alt="">
                                        </div>
                                    </div>
                                </div>
                                <% } %>
                                <p class="fontsize07 textcenter color333 lineheight15"><%= checkOther.title %></p>
                            </li>
                            <% } %>
                    </ol>
                    <% } %>

                    <!--<% if(item.pay.length > 0){ %>
                    <div class="pay_box margintop1 ">
                        <div class="pay_box_title textcenter">支付</div>
                        <div class="review_tit color999 margintop05">
                            <p><%= item.pay[0].nodename %>( <%= item.pay[0].draw_rate %> )</p>
                            <p>应收金额：<%= item.pay[0].pay_money %>元</p>
                            <p>增减项：<%= item.pay[0].extrapay %>元</p>
                            <p>已付款：<%= item.pay[0].needmoney %>元</p>
                        </div>
                    </div>
                    <% } %>-->

                    <% } %>
                    <% } %>
                </script>
            </div>
            <!--bottom border-->
            <div class="nodebottombor"></div>
        </li>
        <!--开工仪式 e-->

        <!--水电材料验收 s-->
        <li isload="0" ismassage="0" id="node7" class="isnodemassage zxnode_list fr">
            <div class="zxnode_list_title clearfix" status="nodeclose">
                <span class="zxnodestatus fl">水电材料验收</span><i class="iconfont icon-gotonext fr"></i>
            </div>
            <div class="zxnode_logo">
                <i class="iconfont icon-shuidianyanshous zxnode_icon"></i>
                <span class="zxnode_logo_centerbg"></span>
                <p class="zxnode_times">15-10-10</p>
            </div>
            <!--节点内容-->
            <div class="zxnode_list_cont" id="snode7">
                <script type="text/template" id="snode7-cont-template">

                    <% for(var i = 0;i
                    <siteNodeMas.length;i++){%>
                    <% var item = siteNodeMas[i] %>


                    <% if(item.nodeid == 25 ){ %>
                    <% var batteryGc = item.check_detail %>
                    <% if(item.photo.length > 0 || item.content || item.addtime){ %>
                    <div class="review review fontsize07 color_organe">
                        <% if(item.photo.length>0){ %>
                        <ul class="pre_img clearfix">
                            <% var photos = item.photo %>
                            <% for(var p = 0;p
                            <photos.length
                                    ;p++){ %>
                                <% if(photos.length<1){break;} %>
                                <li class="pre_list fl">
                                    <div class="pre_list_imgbox">
                                        <img src="<%= photos[p] %>" alt="">
                                    </div>
                                </li>
                                <% } %>
                        </ul>
                        <% } %>
                        <% if(item.addtime){ %>
                        <p class="pre_cen_tit fontsize07 color_blue">验收时间：<%= item.addtime %></p>
                        <% } %>
                        <!--管家说-->
                        <% if(item.content){ %>
                        <ul class="butler_say">
                            <li class="clearfix butler_say_list">
                                <div class="fl say_logo">
                                    <img src="<%= item.gjphoto %>">
                                </div>
                                <div class="clearfix fl say_text">

                                    <p><span class="color_blue fl">【管家说】</span><%= item.content %></p>
                                </div>
                            </li>
                        </ul>
                        <% } %>

                    </div>
                    <% } %>
                    <!--水路-->
                    <% if(item.check_detail.qualified || item.count != 0 || item.check_detail.unqualified){ %>
                    <div class="water border_bot_none">
                        <!---->
                        <ul class="water_ul">
                            <% if(item.check_detail.qualified || item.count != 0){ %>
                            <li class="water_list">
                                <!--合格项-->
                                <div class="water_minubox clearfix">
                                    <div class="fl water_list_tit color_blue"><i class="iconfont icon-right"></i><span>验收合格</span>
                                    </div>
                                    <div class="fr water_minu "><%= item.sum %>项目<i
                                            class="iconfont icon-slidearrow"></i></div>
                                </div>
                                <div class="water_cont">
                                    <% if(item.check_detail.qualified){ %>
                                    <ul>
                                        <% var waterContindex = 0; %>
                                        <% for(var t = 0;t
                                        <batteryGc.qualified.length
                                                ;t++){ %>
                                            <% var wateritemb = batteryGc.qualified[t]; %>
                                            <% if(wateritemb.img_yse.length == 1 ){ %>
                                            <li>
                                                <% waterContindex++; %>
                                                <h3 class="h3"><%= waterContindex %>：<%= wateritemb.title %>(<%= wateritemb.detailO  %>)</h3>
                                                <div class="company_imgbox water_contimg ">
                                                    <div class="company_imgboxcont">
                                                        <img src="<%= wateritemb.img_yse[0] %>" alt="">
                                                    </div>
                                                </div>
                                            </li>
                                            <% }else if(wateritemb.img_yse.length > 1){ %>
                                            <li>
                                                <% waterContindex++; %>
                                                <h3 class="h3"><%= waterContindex %>：<%= wateritemb.title %>(<%= wateritemb.detailO  %>)</h3>
                                                <div class="company_img_list water_contimg">
                                                    <div class="company_imgbox company_imgbox_down">
                                                        <div class="company_imgboxcont">
                                                            <img src="<%= wateritemb.img_yse[1] %>"
                                                                 alt="">
                                                        </div>
                                                    </div>
                                                    <div class="company_imgbox company_imgbox_up">
                                                        <div class="company_imgboxcont">
                                                            <img src="<%= wateritemb.img_yse[0] %>" alt="">
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                            <% } %>
                                            <% } %>


                                    </ul>
                                    <% } %>
                                    <% if(item.count > 0){ %>
                                    <a href="mobile-check_detail.html?nodeid=<%= item.nodeid %>&orderid=<%= siteNodeMas.URLordadeId %>"
                                       class="water_cont_link fontsize07 color_blue">其它<%= item.count %>项验收明细</a>
                                    <% }else{ %>
                                        <div style="height: 2rem;"></div>
                                    <% } %>

                                </div>
                            </li>
                            <% } %>
                            <% if(item.check_detail.unqualified){ %>
                            <!--整改项-->
                            <li class="water_list water_list_zg">
                                <!--合格项-->
                                <div class="water_minubox clearfix">
                                    <div class="fl water_list_tit color_organe"><i
                                            class="iconfont icon-tanhaos color_organe"></i><span>整改项</span></div>
                                    <div class="fr water_minu "><%= batteryGc.unqualified.length %>项目<i
                                            class="iconfont icon-slidearrow"></i></div>
                                </div>
                                <div class="water_cont">

                                    <% for(var j = 0;j
                                    <batteryGc.unqualified.length
                                            ;j++){ %>
                                        <% var waterzgb = batteryGc.unqualified[j]; %>
                                        <div class="water_zg_par">
                                            <h3 class="fontsize07 color_999 water_list_zgtit"><%= j+1 %>：<%= waterzgb.qua%>：<%=waterzgb.title %>(<%= waterzgb.detailO %>)</h3>

                                            <% if(waterzgb.tomark){ %>
                                                <h3 class="fontsize07 color_999 water_list_zgtit water_listzg_tomark"><%= waterzgb.tomark %></h3>
                                            <% } %>
                                            <ul class="clearfix water_list_zgul">
                                                <li class="water_list_zgli fl">
                                                    <div class="water_list_zgli_child">
                                                        <div class="company_imgbox">
                                                            <div class="company_imgboxcont">
                                                                <img src="<%= waterzgb.img_yse[0] %>" alt="">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <p class="fontsize07 color_organe textcenter lineheight2">整改前</p>
                                                </li>
                                                <li class="water_list_zgli fl">

                                                    <!--两种状态-->
                                                    <% if(waterzgb.chan_Srcs == 1){ %>
                                                    <!--整改中-->
                                                    <div class="company_imgbox water_list_zgway">
                                                        <div class="company_imgboxcont">
                                                            <img src="<?php echo R;?>msite/building_live_new/img/zhenggaizhong.jpg"
                                                                 alt="">
                                                        </div>
                                                        <p class="water_list_zgwaytext">整改中</p>
                                                    </div>
                                                    <% }else{ %>
                                                    <!--整改后-->
                                                    <div class="company_imgbox">
                                                        <div class="company_imgboxcont">
                                                            <img src="<%= waterzgb.chan_Srcs[0] %>" alt="">
                                                        </div>
                                                    </div>
                                                    <p class="fontsize07 color_organe textcenter lineheight2">整改后</p>
                                                    <% } %>
                                                </li>
                                            </ul>
                                        </div>
                                        <% } %>
                                </div>
                            </li>
                            <% } %>
                        </ul>

                    </div>
                    <% } %>

                    <% } %>
                    <% } %>
                </script>
            </div>
            <!--bottom border-->
            <div class="nodebottombor"></div>
        </li>
        <!--水电材料验收 e-->

        <!--水电工程验收 s-->
        <li isload="0" ismassage="0" id="node8" class="isnodemassage zxnode_list fr">
            <div class="zxnode_list_title clearfix" status="nodeclose">
                <span class="zxnodestatus fl">水电工程验收</span><i class="iconfont icon-gotonext fr"></i>
            </div>
            <div class="zxnode_logo">
                <i class="iconfont icon-shuidiangcyanshous zxnode_icon"></i>
                <span class="zxnode_logo_centerbg"></span>
                <p class="zxnode_times">15-10-10</p>
            </div>
            <!--节点内容-->
            <div class="zxnode_list_cont" id="snode8">
                <script type="text/template" id="snode8-cont-template">

                    <% for(var i = 0;i
                    <siteNodeMas.length;i++){%>
                    <% var item = siteNodeMas[i] %>

                    <% if(item.nodeid == 27 ){ %>
                    <% var wraterGc = item.check_waterdetail; %>
                    <% var batteryGc = item.check_detail; %>
                    <% if(item.photo.length>0 || item.addtime || item.content){ %>
                    <div class="review fontsize07 color_organe">
                        <% if(item.photo.length>0){ %>
                        <ul class="pre_img clearfix">
                            <% var photos = item.photo %>
                            <% for(var p = 0;p
                            <photos.length
                                    ;p++){ %>
                                <% if(photos.length<1){break;} %>
                                <li class="pre_list fl">
                                    <div class="pre_list_imgbox">
                                        <img src="<%= photos[p] %>" alt="">
                                    </div>
                                </li>
                                <% } %>

                        </ul>
                        <% } %>
                        <% if(item.addtime){ %>
                        <p class="pre_cen_tit fontsize07 color_blue">验收时间：<%= item.addtime %></p>
                        <% } %>
                        <!--管家说-->
                        <% if(item.content){ %>
                        <ul class="butler_say">
                            <li class="clearfix butler_say_list">
                                <div class="fl say_logo">
                                    <img src="<%= item.gjphoto %>">
                                </div>
                                <div class="clearfix fl say_text">

                                    <p><span class="color_blue fl">【管家说】</span><%= item.content %></p>
                                </div>
                            </li>
                        </ul>
                        <% } %>

                    </div>
                    <% } %>
                    <!--水路-->
                    <% if(item.check_waterdetail.qualifieds || item.counts != 0 || item.check_waterdetail.unqualifieds){ %>
                    <div class="water">
                        <!---->
                        <h3 class="water_title">一、水路</h3>
                        <ul class="water_ul">
                            <% if(item.check_waterdetail.qualifieds || item.counts != 0){ %>
                            <li class="water_list">
                                <!--合格项-->
                                <div class="water_minubox clearfix">
                                    <div class="fl water_list_tit color_blue"><i class="iconfont icon-right"></i><span>验收合格</span>
                                    </div>
                                    <div class="fr water_minu "><%= item.sums %>项目<i
                                            class="iconfont icon-slidearrow"></i></div>
                                </div>
                                <div class="water_cont">
                                    <% if(item.check_waterdetail.qualifieds){ %>
                                    <ul>
                                        <% var waterContindexs = 0; %>
                                        <% for(var j = 0;j
                                        <wraterGc.qualifieds.length
                                                ;j++){ %>
                                            <% var wateritem = wraterGc.qualifieds[j]; %>
                                            <% if(wateritem.img_yse.length == 1 ){ %>
                                            <% waterContindexs++; %>
                                            <li>
                                                <h3 class="h3"><%= waterContindexs %>：<%= wateritem.title %></h3>
                                                <div class="company_imgbox water_contimg ">
                                                    <div class="company_imgboxcont">
                                                        <img src="<%= wateritem.img_yse[0] %>" alt="">
                                                    </div>
                                                </div>
                                            </li>
                                            <% }else if(wateritem.img_yse.length > 1){ %>
                                            <% waterContindexs++; %>
                                            <li>
                                                <h3 class="h3"><%= waterContindexs %>：<%= wateritem.title %></h3>
                                                <div class="company_img_list water_contimg">
                                                    <div class="company_imgbox company_imgbox_down">
                                                        <div class="company_imgboxcont">
                                                            <img src="<%= wateritem.img_yse[1] %>"
                                                                 alt="">
                                                        </div>
                                                    </div>
                                                    <div class="company_imgbox company_imgbox_up">
                                                        <div class="company_imgboxcont">
                                                            <img src="<%= wateritem.img_yse[0] %>" alt="">
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                            <% } %>
                                            <% } %>


                                    </ul>
                                    <% } %>
                                    <% if(item.counts > 0){ %>
                                    <a href="mobile-check_detail.html?nodeid=<%= item.nodeid %>&orderid=<%= siteNodeMas.URLordadeId %>&stem=water"
                                       class="water_cont_link fontsize07 color_blue">其它<%= item.counts %>项验收明细</a>
                                    <% }else{ %>
                                    <div style="height: 2rem;"></div>
                                    <% } %>

                                </div>
                            </li>
                            <% } %>
                            <!--整改项-->
                            <% if(item.check_waterdetail.unqualifieds){ %>
                            <li class="water_list water_list_zg">
                                <!--合格项-->
                                <div class="water_minubox clearfix">
                                    <div class="fl water_list_tit color_organe"><i
                                            class="iconfont icon-tanhaos color_organe"></i><span>整改项</span></div>
                                    <div class="fr water_minu "><%= wraterGc.unqualifieds.length %>项目<i
                                            class="iconfont icon-slidearrow"></i></div>
                                </div>
                                <div class="water_cont">

                                    <% for(var j = 0;j
                                    <wraterGc.unqualifieds.length
                                            ;j++){ %>
                                        <% var waterzg = wraterGc.unqualifieds[j]; %>
                                        <div class="water_zg_par">
                                        <h3 class="fontsize07 color_999 water_list_zgtit"><%= j+1 %>：<%= waterzg.qua%>：<%= waterzg.title %></h3>
                                        <% if(waterzg.tomark){ %>
                                            <h3 class="fontsize07 color_999 water_list_zgtit water_listzg_tomark"><%= waterzg.tomark %></h3>
                                        <% } %>
                                        <ul class="clearfix water_list_zgul">
                                            <li class="water_list_zgli fl">
                                                <div class="water_list_zgli_child">
                                                    <div class="company_imgbox">
                                                        <div class="company_imgboxcont">
                                                            <img src="<%= waterzg.img_yse[0] %>" alt="">
                                                        </div>
                                                    </div>
                                                </div>
                                                <p class="fontsize07 color_organe textcenter lineheight2">整改前</p>
                                            </li>
                                            <li class="water_list_zgli fl">

                                                <!--两种状态-->
                                                <% if(waterzg.chan_Srcs == 1){ %>
                                                <!--整改中-->
                                                <div class="company_imgbox water_list_zgway">
                                                    <div class="company_imgboxcont">
                                                        <img src="<?php echo R;?>msite/building_live_new/img/zhenggaizhong.jpg"
                                                             alt="">
                                                    </div>
                                                    <p class="water_list_zgwaytext">整改中</p>
                                                </div>
                                                <% }else{ %>
                                                <!--整改后-->
                                                <div class="company_imgbox">
                                                    <div class="company_imgboxcont">
                                                        <img src="<%= waterzg.chan_Srcs[0] %>" alt="">
                                                    </div>
                                                </div>
                                                <p class="fontsize07 color_organe textcenter lineheight2">整改后</p>
                                                <% } %>
                                            </li>
                                        </ul>
                                        </div>
                                        <% } %>
                                </div>
                            </li>
                            <% } %>
                        </ul>

                    </div>
                    <% } %>
                    <!--电路-->
                    <% if(item.check_detail.qualified || item.count != 0 || item.check_detail.unqualified){ %>
                    <div class="circuit">
                        <!---->
                        <h3 class="water_title">二、电路</h3>
                        <ul class="water_ul">
                            <% if(item.check_detail.qualified || item.count != 0){ %>
                            <li class="water_list">
                                <!--合格项-->
                                <div class="water_minubox clearfix">
                                    <div class="fl water_list_tit color_blue"><i class="iconfont icon-right"></i><span>验收合格</span>
                                    </div>
                                    <div class="fr water_minu "><%= item.sum %>项目<i
                                            class="iconfont icon-slidearrow"></i></div>
                                </div>
                                <div class="water_cont">
                                    <% if(item.check_detail.qualified){ %>
                                    <ul>
                                        <% var waterContindex = 0; %>
                                        <% for(var t = 0;t
                                        <batteryGc.qualified.length
                                                ;t++){ %>
                                            <% var wateritemb = batteryGc.qualified[t]; %>
                                            <% if(wateritemb.img_yse.length == 1 ){ %>
                                            <li>
                                                <% waterContindex++; %>
                                                <h3 class="h3"><%= waterContindex %>：<%= wateritemb.title %></h3>
                                                <div class="company_imgbox water_contimg ">
                                                    <div class="company_imgboxcont">
                                                        <img src="<%= wateritemb.img_yse[0] %>" alt="">
                                                    </div>
                                                </div>
                                            </li>
                                            <% }else if(wateritemb.img_yse.length > 1){ %>
                                            <li>
                                                <% waterContindex++; %>
                                                <h3 class="h3"><%= waterContindex %>：<%= wateritemb.title %></h3>
                                                <div class="company_img_list water_contimg">
                                                    <div class="company_imgbox company_imgbox_down">
                                                        <div class="company_imgboxcont">
                                                            <img src="<%= wateritemb.img_yse[1] %>"
                                                                 alt="">
                                                        </div>
                                                    </div>
                                                    <div class="company_imgbox company_imgbox_up">
                                                        <div class="company_imgboxcont">
                                                            <img src="<%= wateritemb.img_yse[0] %>" alt="">
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                            <% } %>
                                            <% } %>


                                    </ul>
                                    <% } %>
                                    <% if(item.count > 0){ %>
                                    <a href="mobile-check_detail.html?nodeid=<%= item.nodeid %>&orderid=<%= siteNodeMas.URLordadeId %>"
                                       class="water_cont_link fontsize07 color_blue">其它<%= item.count %>项验收明细</a>
                                    <% }else{ %>
                                    <div style="height: 2rem;"></div>
                                    <% } %>
                                </div>
                            </li>
                            <% } %>
                            <!--整改项-->
                            <% if(item.check_detail.unqualified){ %>
                            <li class="water_list water_list_zg">
                                <!--合格项-->
                                <div class="water_minubox clearfix">
                                    <div class="fl water_list_tit color_organe"><i
                                            class="iconfont icon-tanhaos color_organe"></i><span>整改项</span></div>
                                    <div class="fr water_minu "><%= batteryGc.unqualified.length %>项目<i
                                            class="iconfont icon-slidearrow"></i></div>
                                </div>
                                <div class="water_cont">

                                    <% for(var j = 0;j
                                    <batteryGc.unqualified.length
                                            ;j++){ %>
                                        <% var waterzgb = batteryGc.unqualified[j]; %>
                                        <div class="water_zg_par">
                                        <h3 class="fontsize07 color_999 water_list_zgtit"><%= j+1 %>：<%= waterzgb.qua
                                            %>：<%=
                                            waterzgb.title %></h3>

                                        <% if(waterzgb.tomark){ %>
                                        <h3 class="fontsize07 color_999 water_list_zgtit water_listzg_tomark"><%= waterzgb.tomark %></h3>
                                        <% } %>
                                        <ul class="clearfix water_list_zgul">
                                            <li class="water_list_zgli fl">
                                                <div class="water_list_zgli_child">
                                                    <div class="company_imgbox">
                                                        <div class="company_imgboxcont">
                                                            <img src="<%= waterzgb.img_yse[0] %>" alt="">
                                                        </div>
                                                    </div>
                                                </div>
                                                <p class="fontsize07 color_organe textcenter lineheight2">整改前</p>
                                            </li>
                                            <li class="water_list_zgli fl">

                                                <!--两种状态-->
                                                <% if(waterzgb.chan_Srcs == 1){ %>
                                                <!--整改中-->
                                                <div class="company_imgbox water_list_zgway">
                                                    <div class="company_imgboxcont">
                                                        <img src="<?php echo R;?>msite/building_live_new/img/zhenggaizhong.jpg"
                                                             alt="">
                                                    </div>
                                                    <p class="water_list_zgwaytext">整改中</p>
                                                </div>
                                                <% }else{ %>
                                                <!--整改后-->
                                                <div class="company_imgbox">
                                                    <div class="company_imgboxcont">
                                                        <img src="<%= waterzgb.chan_Srcs[0] %>" alt="">
                                                    </div>
                                                </div>
                                                <p class="fontsize07 color_organe textcenter lineheight2">整改后</p>
                                                <% } %>
                                            </li>
                                        </ul>
                                        </div>
                                        <% } %>
                                </div>
                            </li>
                            <% } %>
                        </ul>
                    </div>
                    <% } %>

                    <% } %>
                    <% } %>
                </script>

            </div>


            <!--bottom border-->
            <div class="nodebottombor"></div>
        </li>
        <!--水电工程验收 e-->

        <!--瓦木材料验收 s-->
        <li isload="0" ismassage="0" id="node9" class="isnodemassage zxnode_list fr">
            <div class="zxnode_list_title clearfix" status="nodeclose">
                <span class="zxnodestatus fl">瓦木材料验收</span><i class="iconfont icon-gotonext fr"></i>
            </div>
            <div class="zxnode_logo">
                <i class="iconfont icon-wamuyanshous zxnode_icon"></i>
                <span class="zxnode_logo_centerbg"></span>
                <p class="zxnode_times">15-10-10</p>
            </div>
            <!--节点内容-->
            <div class="zxnode_list_cont" id="snode9">
                <script type="text/template" id="snode9-cont-template">

                    <% for(var i = 0;i
                    <siteNodeMas.length;i++){%>
                    <% var item = siteNodeMas[i] %>


                    <% if(item.nodeid == 29 ){ %>
                    <% var batteryGc = item.check_detail %>
                    <% if(item.photo.length>0 || item.content || item.addtime){ %>
                    <div class="review fontsize07 color_organe">
                        <% if(item.photo.length>0){ %>
                        <ul class="pre_img clearfix">
                            <% var photos = item.photo %>
                            <% for(var p = 0;p
                            <photos.length
                                    ;p++){ %>
                                <% if(photos.length<1){break;} %>
                                <li class="pre_list fl">
                                    <div class="pre_list_imgbox">
                                        <img src="<%= photos[p] %>" alt="">
                                    </div>
                                </li>
                                <% } %>
                        </ul>
                        <% } %>

                        <% if(item.addtime){ %>
                        <p class="pre_cen_tit fontsize07 color_blue">验收时间：<%= item.addtime %></p>
                        <% } %>
                        <!--管家说-->
                        <% if(item.content){ %>
                        <ul class="butler_say">
                            <li class="clearfix butler_say_list">
                                <div class="fl say_logo">
                                    <img src="<%= item.gjphoto %>">
                                </div>
                                <div class="clearfix fl say_text">

                                    <p><span class="color_blue fl">【管家说】</span><%= item.content %></p>
                                </div>
                            </li>
                        </ul>
                        <% } %>

                    </div>
                    <% } %>
                    <!--水路-->
                    <div class="water border_bot_none">
                        <!---->
                        <ul class="water_ul">
                            <% if(item.check_detail.qualified || item.count != 0){ %>
                            <li class="water_list">
                                <!--合格项-->
                                <div class="water_minubox clearfix">
                                    <div class="fl water_list_tit color_blue"><i class="iconfont icon-right"></i><span>验收合格</span>
                                    </div>
                                    <div class="fr water_minu "><%= item.sum %>项目<i
                                            class="iconfont icon-slidearrow"></i></div>
                                </div>
                                <div class="water_cont">
                                    <% if(item.check_detail.qualified){ %>
                                    <ul>
                                        <% var waterContindex = 0; %>
                                        <% for(var t = 0;t
                                        <batteryGc.qualified.length
                                                ;t++){ %>
                                            <% var wateritemb = batteryGc.qualified[t]; %>
                                            <% if(wateritemb.img_yse.length == 1 ){ %>
                                            <li>
                                                <% waterContindex++; %>
                                                <h3 class="h3"><%= waterContindex %>：<%= wateritemb.title %>(<%= wateritemb.detailO  %>)</h3>
                                                <div class="company_imgbox water_contimg ">
                                                    <div class="company_imgboxcont">
                                                        <img src="<%= wateritemb.img_yse[0] %>" alt="">
                                                    </div>
                                                </div>
                                            </li>
                                            <% }else if(wateritemb.img_yse.length > 1){ %>
                                            <li>
                                                <% waterContindex++; %>
                                                <h3 class="h3"><%= waterContindex %>：<%= wateritemb.title %>(<%= wateritemb.detailO  %>)</h3>
                                                <div class="company_img_list water_contimg">
                                                    <div class="company_imgbox company_imgbox_down">
                                                        <div class="company_imgboxcont">
                                                            <img src="<%= wateritemb.img_yse[1] %>"
                                                                 alt="">
                                                        </div>
                                                    </div>
                                                    <div class="company_imgbox company_imgbox_up">
                                                        <div class="company_imgboxcont">
                                                            <img src="<%= wateritemb.img_yse[0] %>" alt="">
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                            <% } %>
                                            <% } %>


                                    </ul>
                                    <% } %>
                                    <% if(item.count > 0){ %>
                                    <a href="mobile-check_detail.html?nodeid=<%= item.nodeid %>&orderid=<%= siteNodeMas.URLordadeId %>"
                                       class="water_cont_link fontsize07 color_blue">其它<%= item.count %>项验收明细</a>
                                    <% }else{ %>
                                    <div style="height: 2rem;"></div>
                                    <% } %>
                                </div>
                            </li>
                            <% } %>
                            <!--整改项-->
                            <% if(item.check_detail.unqualified){ %>
                            <li class="water_list water_list_zg">
                                <!--合格项-->
                                <div class="water_minubox clearfix">
                                    <div class="fl water_list_tit color_organe"><i
                                            class="iconfont icon-tanhaos color_organe"></i><span>整改项</span></div>
                                    <div class="fr water_minu "><%= batteryGc.unqualified.length %>项目<i
                                            class="iconfont icon-slidearrow"></i></div>
                                </div>
                                <div class="water_cont">

                                    <% for(var j = 0;j
                                    <batteryGc.unqualified.length
                                            ;j++){ %>
                                        <% var waterzgb = batteryGc.unqualified[j]; %>
                                        <div class="water_zg_par">
                                        <h3 class="fontsize07 color_999 water_list_zgtit"><%= j+1 %>：<%= waterzgb.qua
                                            %>：<%=
                                            waterzgb.title %>(<%= waterzgb.detailO  %>)</h3>
                                        <% if(waterzgb.tomark){ %>
                                        <h3 class="fontsize07 color_999 water_list_zgtit water_listzg_tomark"><%= waterzgb.tomark %></h3>
                                        <% } %>
                                        <ul class="clearfix water_list_zgul">
                                            <li class="water_list_zgli fl">
                                                <div class="water_list_zgli_child">
                                                    <div class="company_imgbox">
                                                        <div class="company_imgboxcont">
                                                            <img src="<%= waterzgb.img_yse[0] %>" alt="">
                                                        </div>
                                                    </div>
                                                </div>
                                                <p class="fontsize07 color_organe textcenter lineheight2">整改前</p>
                                            </li>
                                            <li class="water_list_zgli fl">

                                                <!--两种状态-->
                                                <% if(waterzgb.chan_Srcs == 1){ %>
                                                <!--整改中-->
                                                <div class="company_imgbox water_list_zgway">
                                                    <div class="company_imgboxcont">
                                                        <img src="<?php echo R;?>msite/building_live_new/img/zhenggaizhong.jpg"
                                                             alt="">
                                                    </div>
                                                    <p class="water_list_zgwaytext">整改中</p>
                                                </div>
                                                <% }else{ %>
                                                <!--整改后-->
                                                <div class="company_imgbox">
                                                    <div class="company_imgboxcont">
                                                        <img src="<%= waterzgb.chan_Srcs[0] %>" alt="">
                                                    </div>
                                                </div>
                                                <p class="fontsize07 color_organe textcenter lineheight2">整改后</p>
                                                <% } %>
                                            </li>
                                        </ul>
                                        </div>
                                        <% } %>
                                </div>
                            </li>
                            <% } %>
                        </ul>

                    </div>

                    <% } %>
                    <% } %>
                </script>
            </div>
            <!--bottom border-->
            <div class="nodebottombor"></div>
        </li>
        <!--瓦木材料验收 e-->

        <!--防水工程 s-->
        <li isload="0" ismassage="0" id="node10" class="isnodemassage zxnode_list fr">
            <div class="zxnode_list_title clearfix" status="nodeclose">
                <span class="zxnodestatus fl">防水工程验收</span><i class="iconfont icon-gotonext fr"></i>
            </div>
            <div class="zxnode_logo">
                <i class="iconfont icon-fangshuigcyanshous zxnode_icon"></i>
                <span class="zxnode_logo_centerbg"></span>
                <p class="zxnode_times">15-10-10</p>
            </div>
            <!--节点内容-->
            <div class="zxnode_list_cont" id="snode10">
                <script type="text/template" id="snode10-cont-template">

                    <% for(var i = 0;i
                    <siteNodeMas.length;i++){%>
                    <% var item = siteNodeMas[i] %>

                    <% if(item.nodeid == 28 ){ %>
                    <% if(item.photo.length > 0 || item.content || item.addtime){ %>
                        <div class="review">
                            <% if(item.photo.length>0){ %>
                            <ul class="pre_img clearfix">
                                <% var photos = item.photo %>
                                <% for(var p = 0;p
                                <photos.length
                                        ;p++){ %>
                                    <% if(photos.length<1){break;} %>
                                    <li class="pre_list fl">
                                        <div class="pre_list_imgbox">
                                            <img src="<%= photos[p] %>" alt="">
                                        </div>
                                    </li>
                                    <% } %>

                            </ul>
                            <% } %>
                            <% if(item.addtime){ %>
                            <p class="pre_cen_tit fontsize07 color_blue">验收时间：<%= item.addtime %></p>
                            <% } %>
                            <!--管家说-->
                            <% if(item.content){ %>
                            <ul class="butler_say">
                                <li class="clearfix butler_say_list">
                                    <div class="fl say_logo">
                                        <img src="<%= item.gjphoto %>">
                                    </div>
                                    <div class="clearfix fl say_text">

                                        <p><span class="color_blue fl">【管家说】</span><%= item.content %></p>
                                    </div>
                                </li>
                            </ul>
                            <% } %>

                        </div>
                    <% } %>
                    <% if(item.check_detail){ %>
                    <% if(item.check_detail.closed_water[0].qua == "是"){ %>
                    <div class="auditing_stades" idYes="0">
                        <div class="water_minubox ">
                            <div class=" water_list_tit color_blue">
                                <i class="iconfont icon-right fr" style="top: .5rem;"></i><span class="fl">防水合格</span>
                            </div>
                        </div>
                    </div>
                    <% }else{ %>
                    <div class="auditing_stades" idYes="1">
                        <div class="water_minubox clearfix">
                            <div class="water_list_tit color_organe">
                                <i class="iconfont icon-tanhaos color_organe fr"></i><span
                                    class="fl color_organe">防水未合格</span>
                            </div>
                        </div>
                    </div>
                    <% } %>
                    <div class="company_audit_list">

                        <% if(item.check_detail.closed_water[0].qua == "是"){ %>
                        <% if(item.check_detail.closed_water[0].img_yse.length > 0){ %>
                        <ol class="clearfix company_img_ul audit_report ">

                            <% if(item.check_detail.closed_water[0].img_yse.length == 1){ %>
                            <li class="fl company_img_list company_img_first ">
                                <div class="company_imgbox company_imgbox_up" style="top: 0;">
                                    <div class="company_imgboxcont">
                                        <img src="<%= item.check_detail.closed_water[0].img_yse[0] %>" alt="">
                                    </div>
                                </div>
                                <p class="fontsize07 textcenter color_999 company_audit_p">闭水试验</p>
                            </li>
                            <% }else{ %>
                            <li class="fl company_img_list company_img_first ">
                                <div class="company_imgbox company_imgbox_down">
                                    <div class="company_imgboxcont">
                                        <img src="<%= item.check_detail.closed_water[0].img_yse[1] %>" alt="">
                                    </div>
                                </div>
                                <div class="company_imgbox company_imgbox_up" style="top: 0;">
                                    <div class="company_imgboxcont">
                                        <img src="<%= item.check_detail.closed_water[0].img_yse[0] %>" alt="">
                                    </div>
                                </div>
                                <p class="fontsize07 textcenter color_999 company_audit_p">闭水试验</p>
                            </li>

                            <% } %>
                        </ol>
                        <% } %>
                        <% }else{ %>

                        <% if(item.check_detail.closed_water[0].chan_Srcs.length > 0){ %>
                        <ol class="clearfix company_img_ul audit_report ">
                            <% if(item.check_detail.closed_water[0].chan_Srcs.length == 1){ %>
                            <li class="fl company_img_list company_img_first ">
                                <div class="company_imgbox company_imgbox_up" style="top: 0;">
                                    <div class="company_imgboxcont">
                                        <img src="<%= item.check_detail.closed_water[0].img_yse[0] %>" alt="">
                                    </div>
                                </div>
                                <p class="fontsize07 textcenter color_999 company_audit_p">闭水试验</p>
                            </li>
                            <% }else{ %>
                            <li class="fl company_img_list company_img_first ">
                                <div class="company_imgbox company_imgbox_down">
                                    <div class="company_imgboxcont">
                                        <img src="<%= item.check_detail.closed_water[0].img_yse[1] %>" alt="">
                                    </div>
                                </div>
                                <div class="company_imgbox company_imgbox_up" style="top: 0;">
                                    <div class="company_imgboxcont">
                                        <img src="<%= item.check_detail.closed_water[0].img_yse[0] %>" alt="">
                                    </div>
                                </div>
                                <p class="fontsize07 textcenter color_999 company_audit_p">闭水试验</p>
                            </li>

                            <% } %>
                        </ol>
                        <% } %>
                        <% } %>
                    </div>
                    <% }else{ %>
                        <div style="height: 1rem;"></div>
                    <% } %>

                    <% } %>
                    <% } %>
                </script>
            </div>
            <!--bottom border-->
            <div class="nodebottombor"></div>
        </li>
        <!--防水工程 e-->

        <!--瓦木工程 s-->
        <li isload="0" ismassage="0" id="node11" class="isnodemassage zxnode_list fr">
            <div class="zxnode_list_title clearfix" status="nodeclose">
                <span class="zxnodestatus fl">瓦木工程验收</span><i class="iconfont icon-gotonext fr"></i>
            </div>
            <div class="zxnode_logo">
                <i class="iconfont icon-wamugongchengyanshous zxnode_icon"></i>
                <span class="zxnode_logo_centerbg"></span>
                <p class="zxnode_times">15-10-10</p>
            </div>
            <!--节点内容-->
            <div class="zxnode_list_cont" id="snode11">
                <script type="text/template" id="snode11-cont-template">

                    <% for(var i = 0;i
                    <siteNodeMas.length;i++){%>
                    <% var item = siteNodeMas[i] %>
                    <% if(item.nodeid == 31 ){ %>
                    <% var batteryGc = item.check_detail %>
                    <% if(item.photo.length>0 || item.content || item.addtime){ %>
                    <div class="review fontsize07 color_organe">
                        <% if(item.photo.length>0){ %>
                        <ul class="pre_img clearfix">
                            <% var photos = item.photo %>
                            <% for(var p = 0;p
                            <photos.length
                                    ;p++){ %>
                                <% if(photos.length<1){break;} %>
                                <li class="pre_list fl">
                                    <div class="pre_list_imgbox">
                                        <img src="<%= photos[p] %>" alt="">
                                    </div>
                                </li>
                                <% } %>
                        </ul>
                        <% } %>
                        <% if(item.addtime){ %>
                        <p class="pre_cen_tit fontsize07 color_blue">验收时间：<%= item.addtime %></p>
                        <% } %>
                        <!--管家说-->
                        <% if(item.content){ %>
                        <ul class="butler_say">
                            <li class="clearfix butler_say_list">
                                <div class="fl say_logo">
                                    <img src="<%= item.gjphoto %>">
                                </div>
                                <div class="clearfix fl say_text">

                                    <p><span class="color_blue fl">【管家说】</span><%= item.content %></p>
                                </div>
                            </li>
                        </ul>
                        <% } %>


                    </div>
                    <% } %>
                    <!--水路-->
                    <div class="water border_bot_none">
                        <!---->
                        <ul class="water_ul">
                            <% if(item.check_detail.qualified || item.count != 0){ %>
                            <li class="water_list">
                                <!--合格项-->
                                <div class="water_minubox clearfix">
                                    <div class="fl water_list_tit color_blue"><i class="iconfont icon-right"></i><span>验收合格</span>
                                    </div>
                                    <div class="fr water_minu "><%= item.sum %>项目<i
                                            class="iconfont icon-slidearrow"></i></div>
                                </div>
                                <div class="water_cont">
                                    <% if(item.check_detail.qualified){ %>
                                    <ul>
                                        <% var waterContindex = 0; %>
                                        <% for(var t = 0;t
                                        <batteryGc.qualified.length
                                                ;t++){ %>
                                            <% var wateritemb = batteryGc.qualified[t]; %>
                                            <% if(wateritemb.img_yse.length == 1 ){ %>
                                            <li>
                                                <% waterContindex++; %>
                                                <h3 class="h3"><%= waterContindex %>：<%= wateritemb.title %></h3>
                                                <div class="company_imgbox water_contimg ">
                                                    <div class="company_imgboxcont">
                                                        <img src="<%= wateritemb.img_yse[0] %>" alt="">
                                                    </div>
                                                </div>
                                            </li>
                                            <% }else if(wateritemb.img_yse.length > 1){ %>
                                            <li>
                                                <% waterContindex++; %>
                                                <h3 class="h3"><%= waterContindex %>：<%= wateritemb.title %></h3>
                                                <div class="company_img_list water_contimg">
                                                    <div class="company_imgbox company_imgbox_down">
                                                        <div class="company_imgboxcont">
                                                            <img src="<%= wateritemb.img_yse[1] %>"
                                                                 alt="">
                                                        </div>
                                                    </div>
                                                    <div class="company_imgbox company_imgbox_up">
                                                        <div class="company_imgboxcont">
                                                            <img src="<%= wateritemb.img_yse[0] %>" alt="">
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                            <% } %>
                                            <% } %>


                                    </ul>
                                    <% } %>
                                    <% if(item.count > 0){ %>
                                    <a href="mobile-check_detail.html?nodeid=<%= item.nodeid %>&orderid=<%= siteNodeMas.URLordadeId %>"
                                       class="water_cont_link fontsize07 color_blue">其它<%= item.count %>项验收明细</a>
                                    <% }else{ %>
                                    <div style="height: 2rem;"></div>
                                    <% } %>
                                </div>
                            </li>
                            <% } %>
                            <% if(item.check_detail.unqualified){ %>

                            <!--整改项-->
                            <li class="water_list water_list_zg">
                                <!--合格项-->
                                <div class="water_minubox clearfix">
                                    <div class="fl water_list_tit color_organe"><i
                                            class="iconfont icon-tanhaos color_organe"></i><span>整改项</span></div>
                                    <div class="fr water_minu "><%= batteryGc.unqualified.length %>项目<i
                                            class="iconfont icon-slidearrow"></i></div>
                                </div>
                                <div class="water_cont">

                                    <% for(var j = 0;j
                                    <batteryGc.unqualified.length
                                            ;j++){ %>
                                        <% var waterzgb = batteryGc.unqualified[j]; %>
                                        <div class="water_zg_par">
                                        <h3 class="fontsize07 color_999 water_list_zgtit"><%= j+1 %>：<%= waterzgb.qua
                                            %>：<%=
                                            waterzgb.title %></h3>
                                            <% if(waterzgb.tomark){ %>
                                            <h3 class="fontsize07 color_999 water_list_zgtit water_listzg_tomark"><%= waterzgb.tomark %></h3>
                                            <% } %>
                                        <ul class="clearfix water_list_zgul">
                                            <li class="water_list_zgli fl">
                                                <div class="water_list_zgli_child">
                                                    <div class="company_imgbox">
                                                        <div class="company_imgboxcont">
                                                            <img src="<%= waterzgb.img_yse[0] %>" alt="">
                                                        </div>
                                                    </div>
                                                </div>
                                                <p class="fontsize07 color_organe textcenter lineheight2">整改前</p>
                                            </li>
                                            <li class="water_list_zgli fl">

                                                <!--两种状态-->
                                                <% if(waterzgb.chan_Srcs == 1){ %>
                                                <!--整改中-->
                                                <div class="company_imgbox water_list_zgway">
                                                    <div class="company_imgboxcont">
                                                        <img src="<?php echo R;?>msite/building_live_new/img/zhenggaizhong.jpg"
                                                             alt="">
                                                    </div>
                                                    <p class="water_list_zgwaytext">整改中</p>
                                                </div>
                                                <% }else{ %>
                                                <!--整改后-->
                                                <div class="company_imgbox">
                                                    <div class="company_imgboxcont">
                                                        <img src="<%= waterzgb.chan_Srcs[0] %>" alt="">
                                                    </div>
                                                </div>
                                                <p class="fontsize07 color_organe textcenter lineheight2">整改后</p>
                                                <% } %>
                                            </li>
                                        </ul>
                                        </div>
                                        <% } %>
                                </div>
                            </li>
                            <% } %>
                        </ul>

                    </div>


                    <% } %>
                    <% } %>
                </script>
            </div>
            <!--bottom border-->
            <div class="nodebottombor"></div>
        </li>
        <!--瓦木工程 e-->

        <!--油漆材料 s-->
        <li isload="0" ismassage="0" id="node12" class="isnodemassage zxnode_list fr">
            <div class="zxnode_list_title clearfix" status="nodeclose">
                <span class="zxnodestatus fl">油漆材料验收</span><i class="iconfont icon-gotonext fr"></i>
            </div>
            <div class="zxnode_logo">
                <i class="iconfont icon-youqicailiaoyanshous zxnode_icon"></i>
                <span class="zxnode_logo_centerbg"></span>
                <p class="zxnode_times">15-10-10</p>
            </div>
            <!--节点内容-->
            <div class="zxnode_list_cont" id="snode12">
                <script type="text/template" id="snode12-cont-template">

                    <% for(var i = 0;i
                    <siteNodeMas.length;i++){%>
                    <% var item = siteNodeMas[i] %>
                    <% if(item.nodeid == 33 ){ %>
                    <% var batteryGc = item.check_detail %>
                    <% if(item.photo.length>0 || item.content || item.addtime){ %>
                    <div class="review fontsize07 color_organe">
                        <% if(item.photo.length>0){ %>
                        <ul class="pre_img clearfix">
                            <% var photos = item.photo %>
                            <% for(var p = 0;p
                            <photos.length
                                    ;p++){ %>
                                <% if(photos.length<1){break;} %>
                                <li class="pre_list fl">
                                    <div class="pre_list_imgbox">
                                        <img src="<%= photos[p] %>" alt="">
                                    </div>
                                </li>
                                <% } %>

                        </ul>
                        <% } %>
                        <% if(item.addtime){ %>
                        <p class="pre_cen_tit fontsize07 color_blue">验收时间：<%= item.addtime %></p>
                        <% } %>
                        <!--管家说-->
                        <% if(item.content){ %>
                        <ul class="butler_say">
                            <li class="clearfix butler_say_list">
                                <div class="fl say_logo">
                                    <img src="<%= item.gjphoto %>">
                                </div>
                                <div class="clearfix fl say_text">

                                    <p><span class="color_blue fl">【管家说】</span><%= item.content %></p>
                                </div>
                            </li>
                        </ul>
                        <% } %>

                    </div>
                    <% } %>
                    <!--水路-->
                    <div class="water border_bot_none">
                        <!---->
                        <ul class="water_ul">
                            <% if(item.check_detail.qualified || item.count > 0){ %>
                            <li class="water_list">
                                <!--合格项-->
                                <div class="water_minubox clearfix">
                                    <div class="fl water_list_tit color_blue"><i class="iconfont icon-right"></i><span>验收合格</span>
                                    </div>
                                    <div class="fr water_minu "><%= item.sum %>项目<i
                                            class="iconfont icon-slidearrow"></i></div>
                                </div>
                                <div class="water_cont">
                                    <% if(item.check_detail.qualified){ %>
                                    <ul>

                                        <% var waterContindex = 0; %>
                                        <% for(var t = 0;t
                                        <batteryGc.qualified.length
                                                ;t++){ %>
                                            <% var wateritemb = batteryGc.qualified[t]; %>
                                            <% if(wateritemb.img_yse.length == 1 ){ %>
                                            <li>
                                                <% waterContindex++; %>
                                                <h3 class="h3"><%= waterContindex %>：<%= wateritemb.title %>(<%= wateritemb.detailO  %>)</h3>
                                                <div class="company_imgbox water_contimg ">
                                                    <div class="company_imgboxcont">
                                                        <img src="<%= wateritemb.img_yse[0] %>" alt="">
                                                    </div>
                                                </div>
                                            </li>
                                            <% }else if(wateritemb.img_yse.length > 1){ %>
                                            <li>
                                                <% waterContindex++; %>
                                                <h3 class="h3"><%= waterContindex %>：<%= wateritemb.title %>(<%= wateritemb.detailO  %>)</h3>
                                                <div class="company_img_list water_contimg">
                                                    <div class="company_imgbox company_imgbox_down">
                                                        <div class="company_imgboxcont">
                                                            <img src="<%= wateritemb.img_yse[1] %>"
                                                                 alt="">
                                                        </div>
                                                    </div>
                                                    <div class="company_imgbox company_imgbox_up">
                                                        <div class="company_imgboxcont">
                                                            <img src="<%= wateritemb.img_yse[0] %>" alt="">
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                            <% } %>
                                            <% } %>


                                    </ul>
                                    <% } %>
                                    <% if(item.count > 0){ %>
                                    <a href="mobile-check_detail.html?nodeid=<%= item.nodeid %>&orderid=<%= siteNodeMas.URLordadeId %>"
                                       class="water_cont_link fontsize07 color_blue">其它<%= item.count %>项验收明细</a>
                                    <% }else{ %>
                                    <div style="height: 2rem;"></div>
                                    <% } %>
                                </div>
                            </li>
                            <% } %>
                            <!--整改项-->
                            <% if(item.check_detail.unqualified){ %>
                            <li class="water_list water_list_zg">
                                <!--合格项-->
                                <div class="water_minubox clearfix">
                                    <div class="fl water_list_tit color_organe"><i
                                            class="iconfont icon-tanhaos color_organe"></i><span>整改项</span></div>
                                    <div class="fr water_minu "><%= batteryGc.unqualified.length %>项目<i
                                            class="iconfont icon-slidearrow"></i></div>
                                </div>
                                <div class="water_cont">

                                    <% for(var j = 0;j
                                    <batteryGc.unqualified.length
                                            ;j++){ %>
                                        <% var waterzgb = batteryGc.unqualified[j]; %>
                                        <div class="water_zg_par">
                                        <h3 class="fontsize07 color_999 water_list_zgtit"><%= j+1 %>：<%= waterzgb.qua
                                            %>：<%=
                                            waterzgb.title %>(<%= waterzgb.detailO  %>)</h3>
                                            <% if(waterzgb.tomark){ %>
                                            <h3 class="fontsize07 color_999 water_list_zgtit water_listzg_tomark"><%= waterzgb.tomark %></h3>
                                            <% } %>
                                        <ul class="clearfix water_list_zgul">
                                            <li class="water_list_zgli fl">
                                                <div class="water_list_zgli_child">
                                                    <div class="company_imgbox">
                                                        <div class="company_imgboxcont">
                                                            <img src="<%= waterzgb.img_yse[0] %>" alt="">
                                                        </div>
                                                    </div>
                                                </div>
                                                <p class="fontsize07 color_organe textcenter lineheight2">整改前</p>
                                            </li>
                                            <li class="water_list_zgli fl">

                                                <!--两种状态-->
                                                <% if(waterzgb.chan_Srcs == 1){ %>
                                                <!--整改中-->
                                                <div class="company_imgbox water_list_zgway">
                                                    <div class="company_imgboxcont">
                                                        <img src="<?php echo R;?>msite/building_live_new/img/zhenggaizhong.jpg"
                                                             alt="">
                                                    </div>
                                                    <p class="water_list_zgwaytext">整改中</p>
                                                </div>
                                                <% }else{ %>
                                                <!--整改后-->
                                                <div class="company_imgbox">
                                                    <div class="company_imgboxcont">
                                                        <img src="<%= waterzgb.chan_Srcs[0] %>" alt="">
                                                    </div>
                                                </div>
                                                <p class="fontsize07 color_organe textcenter lineheight2">整改后</p>
                                                <% } %>
                                            </li>
                                        </ul>
                                        </div>
                                        <% } %>
                                </div>
                            </li>
                            <% } %>
                        </ul>

                    </div>

                    <% } %>
                    <% } %>
                </script>
            </div>
            <!--bottom border-->
            <div class="nodebottombor"></div>
        </li>
        <!--油漆材料 e-->

        <!--油漆工程 s-->
        <li isload="0" ismassage="0" id="node13" class="isnodemassage zxnode_list fr">
            <div class="zxnode_list_title clearfix" status="nodeclose">
                <span class="zxnodestatus fl">油漆工程验收</span><i class="iconfont icon-gotonext fr"></i>
            </div>
            <div class="zxnode_logo">
                <i class="iconfont icon-youqiyanshous zxnode_icon"></i>
                <span class="zxnode_logo_centerbg"></span>
                <p class="zxnode_times">15-10-10</p>
            </div>
            <!--节点内容-->
            <div class="zxnode_list_cont" id="snode13">
                <script type="text/template" id="snode13-cont-template">

                    <% for(var i = 0;i
                    <siteNodeMas.length;i++){%>
                    <% var item = siteNodeMas[i] %>
                    <% if(item.nodeid == 35 ){ %>
                    <% var batteryGc = item.check_detail %>
                    <% if(item.photo.length>0 || item.addtime || item.content){ %>
                    <div class="review fontsize07 color_organe">
                        <% if(item.photo.length>0){ %>
                        <ul class="pre_img clearfix">
                            <% var photos = item.photo %>
                            <% for(var p = 0;p
                            <photos.length
                                    ;p++){ %>
                                <% if(photos.length<1){break;} %>
                                <li class="pre_list fl">
                                    <div class="pre_list_imgbox">
                                        <img src="<%= photos[p] %>" alt="">
                                    </div>
                                </li>
                                <% } %>

                        </ul>
                        <% } %>
                        <% if(item.addtime){ %>
                        <p class="pre_cen_tit fontsize07 color_blue">验收时间：<%= item.addtime %></p>
                        <% } %>
                        <!--管家说-->
                        <% if(item.content){ %>
                        <ul class="butler_say">
                            <li class="clearfix butler_say_list">
                                <div class="fl say_logo">
                                    <img src="<%= item.gjphoto %>">
                                </div>
                                <div class="clearfix fl say_text">

                                    <p><span class="color_blue fl">【管家说】</span><%= item.content %></p>
                                </div>
                            </li>
                        </ul>
                        <% } %>

                    </div>
                    <% } %>
                    <!--水路-->
                    <div class="water border_bot_none">
                        <!---->
                        <ul class="water_ul">
                            <% if(item.check_detail.qualified || item.count > 0){ %>
                            <li class="water_list">
                                <!--合格项-->
                                <div class="water_minubox clearfix">
                                    <div class="fl water_list_tit color_blue"><i class="iconfont icon-right"></i><span>验收合格</span>
                                    </div>
                                    <div class="fr water_minu "><%= item.sum %>项目<i
                                            class="iconfont icon-slidearrow"></i></div>
                                </div>
                                <div class="water_cont">
                                    <% if(item.check_detail.qualified){ %>
                                    <ul>
                                        <% var waterContindex = 0; %>
                                        <% for(var t = 0;t
                                        <batteryGc.qualified.length
                                                ;t++){ %>
                                            <% var wateritemb = batteryGc.qualified[t]; %>
                                            <% if(wateritemb.img_yse.length == 1 ){ %>
                                            <li>
                                                <% waterContindex++; %>
                                                <h3 class="h3"><%= waterContindex %>：<%= wateritemb.title %></h3>
                                                <div class="company_imgbox water_contimg ">
                                                    <div class="company_imgboxcont">
                                                        <img src="<%= wateritemb.img_yse[0] %>" alt="">
                                                    </div>
                                                </div>
                                            </li>
                                            <% }else if(wateritemb.img_yse.length > 1){ %>
                                            <li>
                                                <% waterContindex++; %>
                                                <h3 class="h3"><%= waterContindex %>：<%= wateritemb.title %></h3>
                                                <div class="company_img_list water_contimg">
                                                    <div class="company_imgbox company_imgbox_down">
                                                        <div class="company_imgboxcont">
                                                            <img src="<%= wateritemb.img_yse[1] %>"
                                                                 alt="">
                                                        </div>
                                                    </div>
                                                    <div class="company_imgbox company_imgbox_up">
                                                        <div class="company_imgboxcont">
                                                            <img src="<%= wateritemb.img_yse[0] %>" alt="">
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                            <% } %>
                                            <% } %>


                                    </ul>
                                    <% } %>
                                    <% if(item.count > 0){ %>
                                    <a href="mobile-check_detail.html?nodeid=<%= item.nodeid %>&orderid=<%= siteNodeMas.URLordadeId %>"
                                       class="water_cont_link fontsize07 color_blue">其它<%= item.count %>项验收明细</a>
                                    <% }else{ %>
                                    <div style="height: 2rem;"></div>
                                    <% } %>
                                </div>
                            </li>
                            <% } %>
                            <!--整改项-->
                            <% if(item.check_detail.unqualified){ %>
                            <li class="water_list water_list_zg">
                                <!--合格项-->
                                <div class="water_minubox clearfix">
                                    <div class="fl water_list_tit color_organe"><i
                                            class="iconfont icon-tanhaos color_organe"></i><span>整改项</span></div>
                                    <div class="fr water_minu "><%= batteryGc.unqualified.length %>项目<i
                                            class="iconfont icon-slidearrow"></i></div>
                                </div>
                                <div class="water_cont">

                                    <% for(var j = 0;j
                                    <batteryGc.unqualified.length
                                            ;j++){ %>
                                        <% var waterzgb = batteryGc.unqualified[j]; %>
                                        <div class="water_zg_par">
                                        <h3 class="fontsize07 color_999 water_list_zgtit"><%= j+1 %>：<%= waterzgb.qua
                                            %>：<%=
                                            waterzgb.title %></h3>
                                            <% if(waterzgb.tomark){ %>
                                            <h3 class="fontsize07 color_999 water_list_zgtit water_listzg_tomark"><%= waterzgb.tomark %></h3>
                                            <% } %>
                                        <ul class="clearfix water_list_zgul">
                                            <li class="water_list_zgli fl">
                                                <div class="water_list_zgli_child">
                                                    <div class="company_imgbox">
                                                        <div class="company_imgboxcont">
                                                            <img src="<%= waterzgb.img_yse[0] %>" alt="">
                                                        </div>
                                                    </div>
                                                </div>
                                                <p class="fontsize07 color_organe textcenter lineheight2">整改前</p>
                                            </li>
                                            <li class="water_list_zgli fl">

                                                <!--两种状态-->
                                                <% if(waterzgb.chan_Srcs == 1){ %>
                                                <!--整改中-->
                                                <div class="company_imgbox water_list_zgway">
                                                    <div class="company_imgboxcont">
                                                        <img src="<?php echo R;?>msite/building_live_new/img/zhenggaizhong.jpg"
                                                             alt="">
                                                    </div>
                                                    <p class="water_list_zgwaytext">整改中</p>
                                                </div>
                                                <% }else{ %>
                                                <!--整改后-->
                                                <div class="company_imgbox">
                                                    <div class="company_imgboxcont">
                                                        <img src="<%= waterzgb.chan_Srcs[0] %>" alt="">
                                                    </div>
                                                </div>
                                                <p class="fontsize07 color_organe textcenter lineheight2">整改后</p>
                                                <% } %>
                                            </li>
                                        </ul>
                                        </div>
                                        <% } %>
                                </div>
                            </li>
                            <% } %>
                        </ul>

                    </div>

                    <% } %>
                    <% } %>
                </script>
            </div>
            <!--bottom border-->
            <div class="nodebottombor"></div>
        </li>
        <!--油漆工程 e-->

        <!--安装工程 s-->
        <li isload="0" ismassage="0" id="node14" class="isnodemassage zxnode_list fr">
            <div class="zxnode_list_title clearfix" status="nodeclose">
                <span class="zxnodestatus fl">安装工程</span><i class="iconfont icon-gotonext fr"></i>
            </div>
            <div class="zxnode_logo">
                <i class="iconfont icon-anzhuangyanshous zxnode_icon"></i>
                <span class="zxnode_logo_centerbg"></span>
                <p class="zxnode_times">15-10-10</p>
            </div>
            <!--节点内容-->
            <div class="zxnode_list_cont" id="snode14">
                <script type="text/template" id="snode14-cont-template">

                    <% for(var i = 0;i
                    <siteNodeMas.length;i++){%>
                    <% var item = siteNodeMas[i] %>
                    <% if(item.nodeid == 36 ){ %>
                    <% var batteryGc = item.check_detail %>
                    <% if(item.photo.length>0 || item.content){ %>
                    <div class="review fontsize07 color_organe">
                        <% if(item.photo.length>0){ %>
                        <ul class="pre_img clearfix">
                            <% var photos = item.photo %>
                            <% for(var p = 0;p
                            <photos.length
                                    ;p++){ %>
                                <% if(photos.length<1){break;} %>
                                <li class="pre_list fl">
                                    <div class="pre_list_imgbox">
                                        <img src="<%= photos[p] %>" alt="">
                                    </div>
                                </li>
                                <% } %>

                        </ul>
                        <% } %>
                        <!--管家说-->
                        <% if(item.content){ %>
                        <ul class="butler_say">
                            <li class="clearfix butler_say_list">
                                <div class="fl say_logo">
                                    <img src="<%= item.gjphoto %>">
                                </div>
                                <div class="clearfix fl say_text">

                                    <p><span class="color_blue fl">【管家说】</span><%= item.content %></p>
                                </div>
                            </li>
                        </ul>
                        <% } %>
                    </div>
                    <% } %>
                    <!--水路-->
                    <div class="water border_bot_none">
                        <!---->
                        <ul class="water_ul">
                            <% if(item.check_detail.qualified || item.count > 0){ %>
                            <li class="water_list">
                                <!--合格项-->
                                <div class="water_minubox clearfix">
                                    <div class="fl water_list_tit color_blue"><i class="iconfont icon-right"></i><span>验收合格</span>
                                    </div>
                                    <div class="fr water_minu "><%= item.sum %>项目<i
                                            class="iconfont icon-slidearrow"></i></div>
                                </div>
                                <div class="water_cont">
                                    <% if(item.check_detail.qualified){ %>
                                    <ul>
                                        <% var waterContindex = 0; %>
                                        <% for(var t = 0;t
                                        <batteryGc.qualified.length
                                                ;t++){ %>
                                            <% var wateritemb = batteryGc.qualified[t]; %>
                                            <% if(wateritemb.img_yse.length == 1 ){ %>
                                            <li>
                                                <% waterContindex++; %>
                                                <h3 class="h3"><%= waterContindex %>：<%= wateritemb.title %></h3>
                                                <div class="company_imgbox water_contimg ">
                                                    <div class="company_imgboxcont">
                                                        <img src="<%= wateritemb.img_yse[0] %>" alt="">
                                                    </div>
                                                </div>
                                            </li>
                                            <% }else if(wateritemb.img_yse.length > 1){ %>
                                            <li>
                                                <% waterContindex++; %>
                                                <h3 class="h3"><%= waterContindex %>：<%= wateritemb.title %></h3>
                                                <div class="company_img_list water_contimg">
                                                    <div class="company_imgbox company_imgbox_down">
                                                        <div class="company_imgboxcont">
                                                            <img src="<%= wateritemb.img_yse[1] %>"
                                                                 alt="">
                                                        </div>
                                                    </div>
                                                    <div class="company_imgbox company_imgbox_up">
                                                        <div class="company_imgboxcont">
                                                            <img src="<%= wateritemb.img_yse[0] %>" alt="">
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                            <% } %>
                                            <% } %>


                                    </ul>
                                    <% } %>
                                    <% if(item.count > 0){ %>
                                    <a href="mobile-check_detail.html?nodeid=<%= item.nodeid %>&orderid=<%= siteNodeMas.URLordadeId %>"
                                       class="water_cont_link fontsize07 color_blue">其它<%= item.count %>项验收明细</a>
                                    <% }else{ %>
                                    <div style="height: 2rem;"></div>
                                    <% } %>
                                </div>
                            </li>
                            <% } %>
                            <!--整改项-->
                            <% if(item.check_detail.unqualified){ %>
                            <li class="water_list water_list_zg">
                                <!--合格项-->
                                <div class="water_minubox clearfix">
                                    <div class="fl water_list_tit color_organe"><i
                                            class="iconfont icon-tanhaos color_organe"></i><span>整改项</span></div>
                                    <div class="fr water_minu "><%= batteryGc.unqualified.length %>项目<i
                                            class="iconfont icon-slidearrow"></i></div>
                                </div>
                                <div class="water_cont">

                                    <% for(var j = 0;j
                                    <batteryGc.unqualified.length
                                            ;j++){ %>
                                        <% var waterzgb = batteryGc.unqualified[j]; %>
                                        <div class="water_zg_par">
                                        <h3 class="fontsize07 color_999 water_list_zgtit"><%= j+1 %>：<%= waterzgb.qua
                                            %>：<%=
                                            waterzgb.title %></h3>
                                            <% if(waterzgb.tomark){ %>
                                            <h3 class="fontsize07 color_999 water_list_zgtit water_listzg_tomark"><%= waterzgb.tomark %></h3>
                                            <% } %>
                                        <ul class="clearfix water_list_zgul">
                                            <li class="water_list_zgli fl">
                                                <div class="water_list_zgli_child">
                                                    <div class="company_imgbox">
                                                        <div class="company_imgboxcont">
                                                            <img src="<%= waterzgb.img_yse[0] %>" alt="">
                                                        </div>
                                                    </div>
                                                </div>
                                                <p class="fontsize07 color_organe textcenter lineheight2">整改前</p>
                                            </li>
                                            <li class="water_list_zgli fl">

                                                <!--两种状态-->
                                                <% if(waterzgb.chan_Srcs == 1){ %>
                                                <!--整改中-->
                                                <div class="company_imgbox water_list_zgway">
                                                    <div class="company_imgboxcont">
                                                        <img src="<?php echo R;?>msite/building_live_new/img/zhenggaizhong.jpg"
                                                             alt="">
                                                    </div>
                                                    <p class="water_list_zgwaytext">整改中</p>
                                                </div>
                                                <% }else{ %>
                                                <!--整改后-->
                                                <div class="company_imgbox">
                                                    <div class="company_imgboxcont">
                                                        <img src="<%= waterzgb.chan_Srcs[0] %>" alt="">
                                                    </div>
                                                </div>
                                                <p class="fontsize07 color_organe textcenter lineheight2">整改后</p>
                                                <% } %>
                                            </li>
                                        </ul>
                                        </div>
                                        <% } %>
                                </div>
                            </li>
                            <% } %>
                        </ul>

                    </div>

                    <% } %>
                    <% } %>
                </script>
            </div>
            <!--bottom border-->
            <div class="nodebottombor"></div>
        </li>
        <!--安装工程 e-->

        <!--竣工验收 s-->
        <li isload="0" ismassage="0" id="node15" class="isnodemassage zxnode_list fr">
            <div class="zxnode_list_title clearfix" status="nodeclose">
                <span class="zxnodestatus fl">竣工验收</span><i class="iconfont icon-gotonext fr"></i>
            </div>
            <div class="zxnode_logo">
                <i class="iconfont icon-jungongs zxnode_icon"></i>
                <span class="zxnode_logo_centerbg"></span>
                <p class="zxnode_times">15-10-10</p>
            </div>
            <!--节点内容-->
            <div class="zxnode_list_cont" id="snode15">
                <script type="text/template" id="snode15-cont-template">

                    <% for(var i = 0;i
                    <siteNodeMas.length;i++){%>
                    <% var item = siteNodeMas[i] %>

                    <% if(item.nodeid == 37 ){ %>
                    <% if(item.gjsphoto || item.content ||item.check_detail.length > 0){ %>
                    <div class="review fontsize07 color_organe workend">
                        <% if(item.gjsphoto){ %>
                        <% var ImgNum = "block"; %>
                        <% if(item.gjsphoto.length<1){ ImgNum = "none" } %>
                        <ul class="pre_img clearfix" style="display:<%= ImgNum %>">
                            <% var photos = item.gjsphoto %>
                            <% for(var p = 0;p
                            <photos.length
                                    ;p++){ %>
                                <% if(photos.length<1){break;} %>
                                <li class="pre_list fl">
                                    <div class="pre_list_imgbox">
                                        <img src="<%= photos[p] %>" alt="">
                                    </div>
                                </li>
                                <% } %>

                        </ul>
                        <% } %>

                        <!--预交底现场-->
                        <% if(item.check_detail.length > 0){ %>
                        <table class="meter_table">
                            <tr>
                                <th>验收明细</th>
                                <th>结果</th>
                            </tr>

                            <% var checkDetail = item.check_detail %>
                            <% for(var u = 0;u
                            <checkDetail.length
                                    ;u++){ %>
                                <tr>
                                    <td><%= checkDetail[u].title %></td>
                                    <td><%= checkDetail[u].qua %></td>
                                </tr>
                                <% } %>
                        </table>
                        <% } %>
                        <!--管家说-->
                        <% if(item.content){ %>
                        <ul class="butler_say">
                            <li class="clearfix butler_say_list">
                                <div class="fl say_logo">
                                    <img src="<%= item.gjphoto %>">
                                </div>
                                <div class="clearfix fl say_text">

                                    <p><span class="color_blue fl">【管家说】</span><%= item.content %></p>
                                </div>
                            </li>
                        </ul>
                        <% } %>
                    </div>
                    <% } %>
                    <% if(item.check_other.length > 0){ %>

                    <ol class="space_photo clearfix jungong_space">
                        <% for(var t = 0;t
                        <item.check_other.length
                                ;t++){ %>
                            <% var checkOther = item.check_other[t]; %>
                            <li class="space_photo_list fl">
                                <% if(checkOther.img_yse.length == 1){ %>
                                <div class="space_photo_boxpar">
                                    <div class="space_photo_border">
                                        <div class="space_photo_box">
                                            <img src="<%= checkOther.img_yse[0] %>" alt="">
                                        </div>
                                    </div>
                                </div>
                                <% }else if(checkOther.img_yse.length > 1 ){ %>
                                <div class="space_photo_boxpar" style="top: -.4rem;">
                                    <div class="space_photo_border space_box_up">
                                        <div class="space_photo_box ">
                                            <img src="<%= checkOther.img_yse[0] %>" alt="">
                                        </div>
                                    </div>
                                    <div class="space_photo_border space_box_down">
                                        <div class="space_photo_box ">
                                            <img src="<%= checkOther.img_yse[1] %>" alt="">
                                        </div>
                                    </div>
                                </div>
                                <% } %>
                                <p class="fontsize07 textcenter color333 lineheight15"><%= checkOther.title %></p>
                            </li>
                            <% } %>
                    </ol>
                    <% } %>


                    <% } %>
                    <% } %>
                </script>
            </div>
            <!--bottom border-->
            <div class="nodebottombor"></div>
        </li>
        <!--竣工验收 e-->
    </ul>
    <!--装修后-->
    <ul class="zxnode_start zxnode_march zxnode_end clearfix">
        <li class="zxnode_start_name">装修后</li>
        <!--第一次环保检测 s-->
        <li isload="0" ismassage="0" id="node16" class="isnodemassage zxnode_list  fr">
            <div class="zxnode_list_title clearfix" status="nodeclose">
                <span class="zxnodestatus fl">第一次环保检测</span><i class="iconfont icon-gotonext fr"></i>
            </div>
            <div class="zxnode_logo">
                <i class="iconfont icon-huanbaojiances zxnode_icon"></i>
                <span class="zxnode_logo_centerbg"></span>
                <p class="zxnode_times">15-10-10</p>
            </div>
            <!--节点内容-->
            <div class="zxnode_list_cont" id="snode16">
                <script type="text/template" id="snode16-cont-template">

                    <% for(var i = 0;i
                    <siteNodeMas.length;i++){%>
                    <% var item = siteNodeMas[i] %>
                    <% if(item.nodeid == 39 ){ %>


                    <div class="review">
                        <% if(item.photo.length>0){ %>
                        <ul class="pre_img clearfix">
                            <% var photos = item.photo %>
                            <% for(var p = 0;p
                            <photos.length
                                    ;p++){ %>
                                <% if(photos.length<1){break;} %>
                                <li class="pre_list fl">
                                    <div class="pre_list_imgbox">
                                        <img src="<%= photos[p] %>" alt="">
                                    </div>
                                </li>
                                <% } %>
                        </ul>
                        <% } %>
                        <!--管家说-->
                        <% if(item.content){ %>
                        <ul class="butler_say">
                            <li class="clearfix butler_say_list">
                                <div class="fl say_logo">
                                    <img src="<%= item.gjphoto %>">
                                </div>
                                <div class="clearfix fl say_text">

                                    <p><span class="color_blue fl">【管家说】</span><%= item.content %></p>
                                </div>
                            </li>
                        </ul>
                        <% } %>
                        <% if(item.addtime){ %>
                        <div class="testing_time">检测时间：<%= item.addtime %></div>
                        <% } %>

                        <% if(item.col8){ %>
                        <div class="testing_person">参检人员：<%= item.col8 %></div>
                        <% } %>

                        <% if(item.col7){ %>
                        <% if(item.col7 == "是"){ %>
                        <div class="testing_person">检测结果：合格</div>
                        <% }else{ %>
                        <div class="testing_person">检测结果：不合格</div>
                        <% } %>

                        <% } %>

                    </div>


                    <div class="auditing_stades">
                        <% if(item.col7 == '是'){ %>
                            <div class="water_minubox clearfix">
                                <div class="fl water_list_tit color_blue"><i class="iconfont icon-right"></i><span>通过</span>
                                </div>
                            </div>
                        <% }else{ %>
                            <div class="water_minubox clearfix">
                                <div class="fl water_list_tit color_organe"><i
                                        class="iconfont icon-tanhaos color_organe"></i><span class="color_organe">未通过</span>
                                </div>
                            </div>
                            <% if(item.remark){ %>
                                <h3 class="fontsize07 color_999 water_list_zgtit">不合格原因：<%= item.remark %></h3>
                            <% } %>
                        <% } %>
                        <div class="water_cont">
                            <% if(item.check_detail.qualified){ %>
                                <ul>
                                    <% for(var t = 0;t<item.check_detail.qualified.length;t++){%>
                                    <% var items = item.check_detail.qualified[t] %>
                                    <li>
                                        <h3 class="h3"><%= t+1 %>：<%= items.title %></h3>
                                        <% if(items.img_yse.length > 1 ){ %>
                                        <div class="company_img_list water_contimg">
                                            <div class="company_imgbox company_imgbox_down">
                                                <div class="company_imgboxcont">
                                                    <img src="<%= items.img_yse[1] %>" alt="">
                                                </div>
                                            </div>
                                            <div class="company_imgbox company_imgbox_up">
                                                <div class="company_imgboxcont">
                                                    <img src="<%= items.img_yse[0] %>" alt="">
                                                </div>
                                            </div>
                                        </div>
                                        <% }else{ %>
                                        <div class="company_img_list water_contimg">
                                            <div class="company_imgbox">
                                                <div class="company_imgboxcont">
                                                    <img src="<%= items.img_yse[0] %>" alt="">
                                                </div>
                                            </div>
                                        </div>
                                        <% } %>
                                    </li>
                                    <% } %>
                                </ul>

                            <% } %>
                        </div>

                    </div>



                    <% } %>
                    <% } %>
                </script>
            </div>
            <!--bottom border-->
            <div class="nodebottombor"></div>
        </li>
        <!--第一次环保检测 e-->

        <!--维保 s-->
        <li isload="0" ismassage="0" id="node17" class="isnodemassage zxnode_list fr">
            <div class="zxnode_list_title clearfix" status="nodeclose">
                <span class="zxnodestatus fl">维保</span><i class="iconfont icon-gotonext fr"></i>
            </div>
            <div class="zxnode_logo">
                <i class="iconfont icon-weibaoss zxnode_icon"></i>
                <span class="zxnode_logo_centerbg"></span>
                <p class="zxnode_times">15-10-10</p>
            </div>
            <!--节点内容-->
            <div class="zxnode_list_cont" id="snode17">
                <script type="text/template" id="snode17-cont-template">

                    <% for(var i = 0;i
                    <siteNodeMas.length;i++){%>
                    <% var item = siteNodeMas[i] %>

                    <% if(item.nodeid == 45 ){ %>
                    <div class="review">
                        <% if(item.photo.length>0){ %>
                        <ul class="pre_img clearfix">
                            <% var photos = item.photo %>
                            <% for(var p = 0;p
                            <photos.length
                                    ;p++){ %>
                                <% if(photos.length<1){break;} %>
                                <li class="pre_list fl">
                                    <div class="pre_list_imgbox">
                                        <img src="<%= photos[p] %>" alt="">
                                    </div>
                                </li>
                                <% } %>

                        </ul>
                        <% } %>
                        <!--管家说-->
                        <% if(item.content){ %>
                        <ul class="butler_say">
                            <li class="clearfix butler_say_list">
                                <div class="fl say_logo">
                                    <img src="<%= item.gjphoto %>">
                                </div>
                                <div class="clearfix fl say_text">

                                    <p><span class="color_blue fl">【管家说】</span><%= item.content %></p>
                                </div>
                            </li>
                        </ul>
                        <% } %>
                       <!-- <div class="testing_time">维保时间:&nbsp;<%= item.addtime %></div>
                        <div class="testing_person">参与维保人员:&nbsp;<%= item.col8 %></div>
                        <div class="testing_person">可以返还装修公司维保款:&nbsp;<%= item.col7 %></div>-->
                        <div class="testing_time">
                            <% if(item.addtime1){ %>
                            维保时间：<%= item.addtime1 %> 至 <%= item.addtime %>
                            <% }else{ %>
                            维保时间：<%= item.addtime %>
                            <% } %>
                        </div>
                        <% if(item.ret){ %>
                        <div class="testing_person" style="margin-top: 1rem;text-indent: 2em;"><%= item.ret %></div>
                        <% } %>
                    </div>

                    <% } %>
                    <% } %>
                </script>
            </div>
            <!--bottom border-->
            <div class="nodebottombor"></div>
        </li>
        <!--维保 e-->

        <!--第二次环保检测 s-->
        <li isload="0" ismassage="0" id="node18" class="isnodemassage zxnode_list fr">
            <div class="zxnode_list_title clearfix" status="nodeclose">
                <span class="zxnodestatus fl">第二次环保检测</span><i class="iconfont icon-gotonext fr"></i>
            </div>
            <div class="zxnode_logo">
                <i class="iconfont icon-dablebaojiances zxnode_icon"></i>
                <span class="zxnode_logo_centerbg"></span>
                <p class="zxnode_times">15-10-10</p>
            </div>
            <!--节点内容-->
            <div class="zxnode_list_cont" id="snode18">
                <script type="text/template" id="snode18-cont-template">

                    <% for(var i = 0;i
                    <siteNodeMas.length;i++){%>
                    <% var item = siteNodeMas[i] %>
                    <% if(item.nodeid == 43 ){ %>

                    <div class="review">
                        <% if(item.photo.length>0){ %>
                        <ul class="pre_img clearfix">
                            <% var photos = item.photo %>
                            <% for(var p = 0;p
                            <photos.length
                                    ;p++){ %>
                                <% if(photos.length<1){break;} %>
                                <li class="pre_list fl">
                                    <div class="pre_list_imgbox">
                                        <img src="<%= photos[p] %>" alt="">
                                    </div>
                                </li>
                                <% } %>
                        </ul>
                        <% } %>
                        <!--管家说-->
                        <% if(item.content){ %>
                        <ul class="butler_say">
                            <li class="clearfix butler_say_list">
                                <div class="fl say_logo">
                                    <img src="<%= item.gjphoto %>">
                                </div>
                                <div class="clearfix fl say_text">

                                    <p><span class="color_blue fl">【管家说】</span><%= item.content %></p>
                                </div>
                            </li>
                        </ul>
                        <% } %>
                        <% if(item.addtime){ %>
                        <div class="testing_time">检测时间：<%= item.addtime %></div>
                        <% } %>

                        <% if(item.col8){ %>
                        <div class="testing_person">参检人员：<%= item.col8 %></div>
                        <% } %>

                        <% if(item.col7){ %>
                        <% if(item.col7 == "是"){ %>
                        <div class="testing_person">检测结果：合格</div>
                        <% }else{ %>
                        <div class="testing_person">检测结果：不合格</div>
                        <% } %>

                        <% } %>

                    </div>
                    <div class="auditing_stades">
                        <% if(item.col7 == '是'){ %>
                        <div class="water_minubox clearfix">
                            <div class="fl water_list_tit color_blue"><i class="iconfont icon-right"></i><span>通过</span>
                            </div>
                        </div>
                        <% }else{ %>
                        <div class="water_minubox clearfix">
                            <div class="fl water_list_tit color_organe"><i
                                    class="iconfont icon-tanhaos color_organe"></i><span class="color_organe">未通过</span>
                            </div>
                        </div>
                            <% if(item.remark){ %>
                                <h3 class="fontsize07 color_999 water_list_zgtit">不合格原因：<%= item.remark %></h3>
                            <% } %>
                        <% } %>
                        <div class="water_cont">
                            <% if(item.check_detail.qualified){ %>
                            <ul>
                                <% for(var t = 0;t<item.check_detail.qualified.length;t++){%>
                                <% var items = item.check_detail.qualified[t] %>
                                <li>
                                    <h3 class="h3"><%= t+1 %>：<%= items.title %></h3>
                                    <% if(items.img_yse.length > 1 ){ %>
                                    <div class="company_img_list water_contimg">
                                        <div class="company_imgbox company_imgbox_down">
                                            <div class="company_imgboxcont">
                                                <img src="<%= items.img_yse[1] %>" alt="">
                                            </div>
                                        </div>
                                        <div class="company_imgbox company_imgbox_up">
                                            <div class="company_imgboxcont">
                                                <img src="<%= items.img_yse[0] %>" alt="">
                                            </div>
                                        </div>
                                    </div>
                                    <% }else{ %>
                                    <div class="company_img_list water_contimg">
                                        <div class="company_imgbox">
                                            <div class="company_imgboxcont">
                                                <img src="<%= items.img_yse[0] %>" alt="">
                                            </div>
                                        </div>
                                    </div>
                                    <% } %>
                                </li>
                                <% } %>
                            </ul>

                            <% } %>
                        </div>

                    </div>

                    <% } %>
                    <% } %>
                </script>

            </div>
            <!--bottom border-->
            <div class="nodebottombor"></div>
        </li>
        <!--第二次环保检测 e-->

        <!--环保治理 s-->
        <li isload="0" ismassage="0" id="node19" class="isnodemassage zxnode_list fr">
            <div class="zxnode_list_title clearfix" status="nodeclose">
                <span class="zxnodestatus fl">环保治理</span><i class="iconfont icon-gotonext fr"></i>
            </div>
            <div class="zxnode_logo">
                <i class="iconfont icon-huanbaozhiliss zxnode_icon"></i>
                <span class="zxnode_logo_centerbg"></span>
                <p class="zxnode_times">15-10-10</p>
            </div>
            <!--节点内容-->
            <div class="zxnode_list_cont" id="snode19">
                <script type="text/template" id="snode19-cont-template">

                    <% for(var i = 0;i
                    <siteNodeMas.length;i++){%>
                    <% var item = siteNodeMas[i] %>
                    <% if(item.nodeid == 49 ){ %>

                    <div class="review">
                        <% if(item.photo.length>0){ %>
                        <ul class="pre_img clearfix">
                            <% var photos = item.photo %>
                            <% for(var p = 0;p
                            <photos.length
                                    ;p++){ %>
                                <% if(photos.length<1){break;} %>
                                <li class="pre_list fl">
                                    <div class="pre_list_imgbox">
                                        <img src="<%= photos[p] %>" alt="">
                                    </div>
                                </li>
                                <% } %>
                        </ul>
                        <% } %>
                        <!--管家说-->
                        <% if(item.content){ %>
                        <ul class="butler_say">
                            <li class="clearfix butler_say_list">
                                <div class="fl say_logo">
                                    <img src="<%= item.gjphoto %>">
                                </div>
                                <div class="clearfix fl say_text">

                                    <p><span class="color_blue fl">【管家说】</span><%= item.content %></p>
                                </div>
                            </li>
                        </ul>
                        <% } %>
                        <div class="testing_time">治理时间:&nbsp;<%= item.addtime %></div>
                        <div class="testing_person">参与人员:&nbsp;<%= item.col8 %></div>

                    </div>

                    <% } %>
                    <% } %>
                </script>
            </div>
            <!--bottom border-->
            <div class="nodebottombor"></div>
        </li>
        <!--环保治理 e-->

        <!--环保治理复测 s-->
        <li isload="0" ismassage="0" id="node20" class="isnodemassage zxnode_list fr"
            style="border-left: none;padding-bottom: 3rem;">
            <div class="zxnode_list_title clearfix" status="nodeclose">

                <span class="zxnodestatus fl">环保治理复测</span><i class="iconfont icon-gotonext fr"></i>
            </div>
            <div class="zxnode_logo">
                <div class="nodelastborder"></div>
                <i class="iconfont icon-huanbaozhilifuces zxnode_icon"></i>
                <span class="zxnode_logo_centerbg"></span>
                <p class="zxnode_times">15-10-10</p>
            </div>
            <!--节点内容-->
            <div class="zxnode_list_cont" id="snode20">
                <script type="text/template" id="snode20-cont-template">

                    <% for(var i = 0;i
                    <siteNodeMas.length;i++){%>
                    <% var item = siteNodeMas[i] %>
                    <% if(item.nodeid == 51 ){ %>

                    <div class="review">
                        <% if(item.photo.length>0){ %>
                        <ul class="pre_img clearfix">
                            <% var photos = item.photo %>
                            <% for(var p = 0;p
                            <photos.length
                                    ;p++){ %>
                                <% if(photos.length<1){break;} %>
                                <li class="pre_list fl">
                                    <div class="pre_list_imgbox">
                                        <img src="<%= photos[p] %>" alt="">
                                    </div>
                                </li>
                                <% } %>
                        </ul>
                        <% } %>
                        <!--管家说-->
                        <% if(item.content){ %>

                        <ul class="butler_say">
                            <li class="clearfix butler_say_list">
                                <div class="fl say_logo">
                                    <img src="<%= item.gjphoto %>">
                                </div>
                                <div class="clearfix fl say_text">

                                    <p><span class="color_blue fl">【管家说】</span><%= item.content %></p>
                                </div>
                            </li>
                        </ul>
                        <% } %>
                        <div class="testing_time">治理时间:&nbsp;<%= item.addtime %></div>
                        <div class="testing_person">参与人员:&nbsp;<%= item.col8 %></div>
                        <div class="testing_person">环保复测单位:&nbsp;<%= item.remark %></div>

                    </div>

                    <% } %>
                    <% } %>
                </script>
            </div>
            <!--bottom border-->
            <div class="nodebottombor"></div>
        </li>
        <!--环保治理复测 e-->

    </ul>
</section>
<!--装修节点 e-->

<section class=alert_points_text>评论成功</section>
<!-- 评论文本框 s -->
<section class="critics_text" id="owner_say_cont">
    <div class="critics_text_header clearfix">
        <i class="iconfont icon-error fl"></i>
        <span class="critics_text_title">我要回复</span>
        <i class="iconfont icon-right fr"></i>
    </div>
    <!--<textarea class="critics_text_info" id="critics_text_info"></textarea>-->
    <div class="owner_textcont">
        <textarea class="critics_text_info" id="critics_text_info" maxlength="1000"></textarea>
        <div class="owner_textcont_num"><span>0</span>/1000</div>
    </div>
</section>
<!-- 评论文本框 e -->
<button id="slide-btn"><i class="iconfont icon-openbtn"></i></button>
<!--大图展示-->
<section id="big-pic">
    <a class="go-back"><i class="iconfont icon-goback"></i></a>
    <div class="page">
        <div class="pic-local">
            <div class="space_name" ></div>
            <div>
                <span id="current-number" class="num"></span>/<span id="total-number" class="num"></span>
            </div>
        </div>
        <div id='slider'>
            <ul id="big-pic-content">
            </ul>
        </div>
    </div>
</section>

</body>
</html>

<div style="display: none;">
<!--评论模块-->
<script type="text/template" id="critics-template">
    <% for(var i = 0;i
    <siteNodeMas.length;i++){ %>
    <% var item = siteNodeMas[i] %>
    <% if(criticsNum == 1 || criticsNum == 2 || criticsNum == 9 ){ break;}%>
    <% if(item.nodeid == criticsNum ){ %>
    <div class="discuss_title clearfix">
        <div class="discuss_title_l fl">
            <span>最新评论</span><b>(<%= item.message.length %>)</b>
        </div>
        <a class="discuss_title_r fr node_critics_text">写评论</a>
        <input type="hidden" class="nodeid" value="<%= item.nodeid %>">
    </div>
    <% if(item.message.length > 0){ %>

    <ul class="discuss_cont">
        <% for(var j = 0;j
        <item.message.length
                ;j++){ %>
            <% if(j>1){break; } %>
            <% var massageItem = item.message[j]; %>
            <li class="discuss_cont_list clearfix">
                <div class="fl discuss_logo">
                    <img src="<%= massageItem.photo %>">
                </div>
                <div class="clearfix fl discuss_text">
                    <div class="discuss_text_title clearfix">
                        <div class="discuss_user fl">
                            <div class="discuss_username"><%= massageItem.name %></div>
                            <span class="discuss_ans_time"><%= massageItem.addtime %></span>
                        </div>

                        <a class="write_discuss fr">
                            <i class="iconfont icon-pinglun node_title_reply"></i>
                        </a>
                    </div>
                    <input type="hidden" value="<%= massageItem.content %>" class="answer_text_input">

                    <% var quesTexts = massageItem.content; %>
                    <% if(quesTexts.length > 25){ %>
                    <% quesTexts = quesTexts.substring(0,25); %>
                    <div class="discuss_text_question answer_text_sub" subtext="1"><%= quesTexts %>···</div>
                    <% }else{ %>
                    <div class="discuss_text_question"><%= massageItem.content %></div>
                    <% } %>
                    <div class="critics_report_massage" style="display: none;">
                        <input type="hidden" class="orderid" value="<%= massageItem.orderid %>">
                        <input type="hidden" class="nodeid" value="<%= massageItem.nodeid %>">
                        <input type="hidden" class="reply_name" value="<%= massageItem.reply_name %>">
                        <input type="hidden" class="parent_id" value="<%= massageItem.parent_id %>">
                        <input type="hidden" class="first_id" value="<%= massageItem.first_id %>">
                        <input type="hidden" class="id_ss" value="<%= massageItem.id %>">
                        <input type="hidden" class="namess" value="<%= massageItem.name %>">
                        <input type="hidden" class="childid1">
                        <input type="hidden" class="childname">

                    </div>
                    <ul class="discuss_text_answer">
                        <% if(massageItem.reply){ %>
                        <% for(var p = 0;p
                        <massageItem.reply.length
                                ;p++){ %>
                            <% var massageReplays = massageItem.reply[p] %>
                            <li class="discuss_answer_list clearfix">
                                <div class="critics_report_massagetwo" style="display: none;">
                                    <% if(p == 0){ %>
                                    <input type="hidden" class="childid1" value="<%= massageItem.reply[p].id %>">
                                    <% }else{ %>
                                    <input type="hidden" class="childid1" value="<%= massageItem.reply[p-1].id %>">
                                    <% } %>
                                    <input type="hidden" class="childname childnamelist" value="<%= massageReplays.name %>">
                                </div>
                                <div class="fl clearfix">
                                    <span class="answer_uname fl"><%= massageReplays.name %>&nbsp;</span>
                                    <span class="fl">回复</span>
                                    <span class="answer_uname fl">&nbsp;<%= massageReplays.reply_name %>：</span>
                                </div>
                                <input type="hidden" class="answer_text_input" value="<%= massageReplays.content %>">
                                <% var answerTexts = massageReplays.content; %>
                                <% if(answerTexts.length > 25){ %>
                                <% answerTexts = answerTexts.substring(0,25); %>
                                <span class="answer_text answer_text_sub"  subtext="1"><%= answerTexts %>···</span>
                                <% }else{ %>
                                <span class="answer_text"><%= massageReplays.content %></span>
                                <% } %>

                                <i class="iconfont icon-pinglun node_child_reply"></i>
                            </li>
                            <% } %>
                            <% } %>
                    </ul>
                </div>
            </li>
            <% } %>
            <ol class="critics_list_moretext" isload="0" id="critics-list-moretext<%= criticsNum %>"></ol>
    </ul>
    <% if(item.message.length > 2){ %>
    <a href="javascript:;" class="discuss_more">更多评论</a>
    <% } %>

    <% } %>
    <% } %>
    <% } %>

</script>

<!--评论查看更多-->
<script type="text/template" id="critics-text-more"，>
    <% for(var i = 0;i
    <siteNodeMas.length;i++){ %>

    <% var item = siteNodeMas[i] %>

    <% if(item.nodeid == criticsNum ){ %>

    <% if(item.message.length > 0){ %>

    <% for(var j = 2;j
    <item.message.length;j++){ %>

    <% var massageItem = item.message[j]; %>
    <li class="discuss_cont_list clearfix">
        <div class="fl discuss_logo">
            <img src="<%= massageItem.photo %>">
        </div>
        <div class="clearfix fl discuss_text">
            <div class="discuss_text_title clearfix">
                <div class="discuss_user fl">
                    <div class="discuss_username"><%= massageItem.name %></div>
                    <span class="discuss_ans_time"><%= massageItem.addtime %></span>
                </div>

                <a class="write_discuss fr">
                    <i class="iconfont icon-pinglun node_title_reply"></i>
                </a>
            </div>
            <input type="hidden" value="<%= massageItem.content %>" class="answer_text_input">

            <% var quesTexts = massageItem.content; %>
            <% if(quesTexts.length > 25){ %>
            <% quesTexts = quesTexts.substring(0,25); %>
            <div class="discuss_text_question answer_text_sub" subtext="1"><%= quesTexts %>···</div>
            <% }else{ %>
            <div class="discuss_text_question"><%= massageItem.content %></div>
            <% } %>
            <div class="critics_report_massage" style="display: none;">
                <input type="hidden" class="orderid" value="<%= massageItem.orderid %>">
                <input type="hidden" class="nodeid" value="<%= massageItem.nodeid %>">
                <input type="hidden" class="reply_name" value="<%= massageItem.reply_name %>">
                <input type="hidden" class="parent_id" value="<%= massageItem.parent_id %>">
                <input type="hidden" class="first_id" value="<%= massageItem.first_id %>">
                <input type="hidden" class="id_ss" value="<%= massageItem.id %>">
                <input type="hidden" class="namess" value="<%= massageItem.name %>">
                <input type="hidden" class="childid1">
                <input type="hidden" class="childname">

            </div>
            <ul class="discuss_text_answer">
                <% if(massageItem.reply){ %>
                <% for(var p = 0;p
                <massageItem.reply.length
                        ;p++){ %>
                    <% var massageReplays = massageItem.reply[p] %>
                    <li class="discuss_answer_list clearfix">
                        <div class="critics_report_massagetwo" style="display: none;">
                            <% if(p == 0){ %>
                            <input type="hidden" class="childid1" value="<%= massageItem.reply[p].id %>">
                            <% }else{ %>
                            <input type="hidden" class="childid1" value="<%= massageItem.reply[p-1].id %>">
                            <% } %>
                            <input type="hidden" class="childname childnamelist" value="<%= massageReplays.name %>">
                        </div>
                        <div class="fl clearfix">
                            <span class="answer_uname fl"><%= massageReplays.name %>&nbsp;</span>
                            <span class="fl">回复</span>
                            <span class="answer_uname fl">&nbsp;<%= massageReplays.reply_name %>：</span>
                        </div>
                        <input type="hidden" class="answer_text_input" value="<%= massageReplays.content %>">
                        <% var answerTexts = massageReplays.content; %>
                        <% if(answerTexts.length > 25){ %>
                        <% answerTexts = answerTexts.substring(0,25); %>
                        <span class="answer_text answer_text_sub"  subtext="1"><%= answerTexts %>···</span>
                        <% }else{ %>
                        <span class="answer_text"><%= massageReplays.content %></span>
                        <% } %>

                        <i class="iconfont icon-pinglun node_child_reply"></i>
                    </li>
                    <% } %>
                    <% } %>
            </ul>
        </div>
    </li>
    <% } %>

    <% } %>
    <% } %>
    <% } %>

</script>

<!--大图展示1-->
<script type="text/template" id="big-pic-data">
    <% for(var j=0; j < alertImg.img_yses.length; j++){ %>
    <% var every = alertImg.img_yses[j] %>
    <li class="single-pic">
        <div class="pic-info">
            <img class="lazy-bimg" src=<%= every %>>
            <div class="loader"></div>
        </div>
    </li>
    <% } %>
</script>

<!--大图展示2-->
<script type="text/template" id="big-pic1-data">
    <% for(var j=0; j < alertImg1.length; j++){ %>
    <% var every = alertImg1[j] %>
    <li class="single-pic">
        <div class="pic-info">
            <img class="lazy-bimg" src=<%= every %>>
            <div class="loader"></div>
        </div>
    </li>
    <% } %>
</script>

<!--yezhushuo start-->
<script type="text/template" id="owner_say_templete">
    <% if(ownerAddDataStatus == 0){ %>
    <% for(var i = 0;i<siteNodeMas.length;i++){ %>
    <% var item = siteNodeMas[i] %>
    <% if(item.nodeid == ownerSayScoreData.NODEID ){ %>
    <% if(!item.owner_speak){ %>
    <div class="write_logbox">
        <div class="write_log">
            <i class="iconfont icon-biji-copy-copy"></i><span>写日志</span>
        </div>
    </div>
    <!--业主说-->
    <% } %>
    <% if(item.owner_speak){ %>
    <ul class="butler_say">
        <li class="clearfix butler_say_list">
            <div class="fl say_logo">
                <img src="<%= item.user_photo %>">
            </div>
            <div class="clearfix fl say_text">
                <p><span class="color_organe fl">【业主说】</span><span class="spak_text_wz"><%= item.owner_speak %></span></p>
            </div>
        </li>
    </ul>

    <div class="owner_textbutton owner_say_button">
        <a class="color_blue revise" href="javascript:;">编辑</a>
        <a class="color_blue output" href="javascript:;">删除</a>
    </div>
    <% } %>
    <% } %>
    <% } %>
    <% }else{ %>
    <% if(!owner_data.owner_speak){ %>
    <div class="write_logbox">
        <div class="write_log">
            <i class="iconfont icon-biji-copy-copy"></i><span>写日志</span>
        </div>
    </div>
    <!--业主说-->
    <% } %>
    <% if(owner_data.owner_speak){ %>
    <ul class="butler_say">
        <li class="clearfix butler_say_list">
            <div class="fl say_logo">
                <img src="<%= owner_data.user_photo %>">
            </div>
            <div class="clearfix fl say_text">
                <p><span class="color_organe fl">【业主说】</span><span class="spak_text_wz"><%= owner_data.owner_speak %></span></p>
            </div>
        </li>
    </ul>

    <div class="owner_textbutton owner_say_button">
        <a class="color_blue revise" href="javascript:;">编辑</a>
        <a class="color_blue output" href="javascript:;">删除</a>
    </div>
    <% } %>
    <% } %>
</script>
<!--yezhushuo end-->

<!--pingfen start-->
<script type="text/template" id="score_star_templete">
    <% for(var i = 0;i<siteNodeMas.length;i++){ %>
    <% var item = siteNodeMas[i] %>
    <% if(item.nodeid == ownerSayScoreData.NODEID ){ %>
    <% if(item.grade.serve == 0){ %>
    <a class="score_link" href="mobile-score.html?nodeid=<%= item.nodeid %>&orderid=<%= urlordadeId %>" ></a>
    <% } %>
    <% var staritem = item.grade %>
    <div class="scores_title">水电工程验收服务评分</div>
    <ul class="scor_mode">
        <li class="sc_cont">
            <div class="sc_title">装修公司评分</div>
            <div class="sc_button">
                <ol>
                    <% if(item.nodeid == 37){ %>
                    <li class="start_button">
                        <span class="start_name">设计水平</span>
                        <div class="start_cont outcome" name="design" number="<%= staritem.design %>">
                            <i class="iconfont icon-star_one"></i>
                            <i class="iconfont icon-star_one"></i>
                            <i class="iconfont icon-star_one"></i>
                            <i class="iconfont icon-star_one"></i>
                            <i class="iconfont icon-star_one"></i>
                        </div>
                        <span class="start_num color_red">请评分</span>
                    </li>
                    <% } %>
                    <li class="start_button">
                        <span class="start_name">施工质量</span>
                        <div class="start_cont outcome" name="quality" number="<%= staritem.quality %>">
                            <i class="iconfont icon-star_one"></i>
                            <i class="iconfont icon-star_one"></i>
                            <i class="iconfont icon-star_one"></i>
                            <i class="iconfont icon-star_one"></i>
                            <i class="iconfont icon-star_one"></i>
                        </div>
                        <span class="start_num color_red">请评分</span>
                    </li>

                    <li class="start_button">
                        <span class="start_name">服务态度</span>
                        <div class="start_cont outcome" name="manner" number="<%= staritem.manner %>">
                            <i class="iconfont icon-star_one"></i>
                            <i class="iconfont icon-star_one"></i>
                            <i class="iconfont icon-star_one"></i>
                            <i class="iconfont icon-star_one"></i>
                            <i class="iconfont icon-star_one"></i>
                        </div>
                        <span class="start_num color_red">请评分</span>
                    </li>

                    <li class="start_button">
                        <span class="start_name">施工时效</span>
                        <div class="start_cont outcome" name="capacity" number="<%= staritem.capacity %>">
                            <i class="iconfont icon-star_one"></i>
                            <i class="iconfont icon-star_one"></i>
                            <i class="iconfont icon-star_one"></i>
                            <i class="iconfont icon-star_one"></i>
                            <i class="iconfont icon-star_one"></i>
                        </div>
                        <span class="start_num color_red">请评分</span>
                    </li>
                </ol>
            </div>
        </li>

        <li class="sc_cont">
            <div class="sc_title">装修管家评分</div>
            <div class="sc_button">
                <ol>
                    <li class="start_button">
                        <span class="start_name">专业技能</span>
                        <div class="start_cont outcome" name="professional" number="<%= staritem.professional %>">
                            <i class="iconfont icon-star_one"></i>
                            <i class="iconfont icon-star_one"></i>
                            <i class="iconfont icon-star_one"></i>
                            <i class="iconfont icon-star_one"></i>
                            <i class="iconfont icon-star_one"></i>
                        </div>
                        <span class="start_num color_red">请评分</span>
                    </li>

                    <li class="start_button">
                        <span class="start_name">服务态度</span>
                        <div class="start_cont outcome" name="serve" number="<%= staritem.serve %>">
                            <i class="iconfont icon-star_one"></i>
                            <i class="iconfont icon-star_one"></i>
                            <i class="iconfont icon-star_one"></i>
                            <i class="iconfont icon-star_one"></i>
                            <i class="iconfont icon-star_one"></i>
                        </div>
                        <span class="start_num color_red">请评分</span>
                    </li>

                    <li class="start_button">
                        <span class="start_name">协调能力</span>
                        <div class="start_cont outcome" name="coordinate" number="<%= staritem.coordinate %>">
                            <i class="iconfont icon-star_one"></i>
                            <i class="iconfont icon-star_one"></i>
                            <i class="iconfont icon-star_one"></i>
                            <i class="iconfont icon-star_one"></i>
                            <i class="iconfont icon-star_one"></i>
                        </div>
                        <span class="start_num color_red">请评分</span>
                    </li>
                </ol>
            </div>
        </li>
        <% if(staritem.serve != 0){ %>
        <li>
            <ol class="owner_text">
                <% if(staritem.content != ''){ %>
                <li class="own_li">
                    <div class="owner_text_title">业主评价</div>
                    <p><%= staritem.content %></p>
                </li>
                <% } %>
                <div class="owner_zhuip">
                    <% if(staritem.additional != ''){ %>
                    <div class="owner_text_title color_blue">业主追评</div>
                    <p><%= staritem.additional %></p>
                    <% } %>
                </div>

            </ol>
            <% if(staritem.additional_num == 0 || staritem.modification_num == 0){ %>
            <div class="owner_textbutton">
                <% if(staritem.additional_num == 0){ %>
                <a class="addratings color_blue" href="javascript:;">追加评价</a>
                <% } %>

                <% if(staritem.modification_num == 0){ %>
                <a class="modify_score color_blue" href="mobile-score.html?nodeid=<%= item.nodeid %>&orderid=<%= urlordadeId %>&upda=1">修改评分</a>
                <% } %>
            </div>
            <% }else{ %>
            <div style="height: 0.7rem;"></div>
            <% } %>
        </li>
        <% } %>
    </ul>
    <% } %>
    <% } %>
</script>

<script  type="text/template" id="score_ratings_templete">
    <% if(addratingsData.additional != ''){ %>
    <div class="owner_text_title color_blue">业主追评</div>
    <p><%= addratingsData.additional %></p>
    <div style="height: 0.7rem;"></div>
    <% } %>
</script>
<!--pingfen end-->

<!--zhifu start-->
<script type="text/template" id="payment_mode_templete">
    <% console.log(ownerSayScoreData.NODEID); %>
    <% for(var i = 0;i<listPayData.length;i++){ %>
    <% if(ownerSayScoreData.NODEID == listPayData[i].nodeid){ %>
        <% var item = listPayData[i]; %>
        <% if(item.step == 1){ %>
        <div class="accp" >
            <div class="accp_title">增减项明细</div>
            <ul class="accp_money">
                <li class="accp_cont accp_moneynumber">
                    <div class="acct_conttitle">
                        增减项金额：
                    </div>
                    <div class="acct_contres">
                        <div class="acct_contrestext">
                            <% if(item.check_info.extrapay >= 0){ %>
                                <i class="iconfont icon-jiahao"></i><span><%= Math.abs(item.check_info.extrapay) %></span>
                            <% }else { %>
                                <i class="iconfont icon-jianhao"></i><span><%= Math.abs(item.check_info.extrapay) %></span>
                            <% } %>
                        </div>
                        <span class="acc_danwei">元</span>
                    </div>
                </li>
                <% if(item.check_info.photos){ %>
                <li class="accp_cont accp_moneyimg">
                    <div class="acct_conttitle">
                        增减项明细：
                    </div>
                    <div class="acc_contimg" nodeid="<%= item.nodeid %>">
                        <img src="<%= item.check_info.photo[0] %>">
                    </div>
                </li>
                <% } %>
            </ul>
            <div class="accp_button" id="accp_submit" Index="<%= i %>">确认验收通过</div>
        </div>
        <% }else if(item.step == 2){ %>
        <% if(item.pay_info){ %>
            <% for(var t = 0; t< item.pay_info.length;t++){ %>
                <% var iteml = item.pay_info[t]; %>
                <div class="pay_node" >
                   <div class="pay_node_title">对<%= item.nodename %>的费用支付</div>
                   <ul class="pay_node_ul">
                       <% if(iteml.title){ %>
                           <% for(var kay in iteml.title){ %>
                                <% var payInfoTit = iteml.title[kay]; %>
                                <% if(payInfoTit){ %>

                               <li class="pay_node_list clearfix">
                                   <h2 class="fl"><%= dataPayTitleName[kay] %></h2>
                                   <p class="fl"><%= payInfoTit %><% if(kay == 'totalpay' || kay == 'designpay'){ %>元<% } %></p>
                               </li>
                                <% } %>
                           <% } %>
                       <% } %>
                      <!-- <li class="pay_node_list clearfix">
                           <h2 class="fl">合同编号：</h2>
                           <p class="fl">uz-00081</p>
                       </li>
                       <li class="pay_node_list clearfix">
                           <h2 class="fl">合同总金额：</h2>
                           <p class="fl">100000元</p>
                       </li>-->
                   </ul>

                   <div class="pay_node_mas">
                       <h2><i class="iconfont icon-qian"></i><span>支付信息</span></h2>
                       <ul class="par_node_masnum">

                           <% var itemc = iteml.content %>

                           <% if(listPayData[i].nodeid == 102 || listPayData[i].nodeid == 15){ %>
                           <li class="par_node_masli clearfix">
                               <div class="par_node_masleft fl"><%if(listPayData[i].nodename == '签设计协议'){%>设计协议金额<%}else{%>意向定金<%}%>：</div>
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
                           <% if(listPayData[i].nodeid != 102 && listPayData[i].nodeid != 19 && listPayData[i].nodeid != 15){ %>
                           <li class="par_node_masli clearfix">
                               <div class="par_node_masleft fl">增减项：</div>
                               <div class="par_node_masright fl"><%= parseFloat(itemc.extrapay) %>元</div>
                           </li>
                           <% } %>

                           <!--已交定金-->
                           <% if(listPayData[i].nodeid == 19 && itemc.deposit){ %>
                           <li class="par_node_masli clearfix">
                               <div class="par_node_masleft fl">已交定金：</div>
                               <div class="par_node_masright fl"><%= parseFloat(itemc.deposit) %>元</div>
                           </li>
                           <% } %>

                           <!--待支付-->
                           <% if(parseFloat(itemc.wait_pay_money)){ %>
                           <li class="par_node_masli clearfix">

                               <div class="par_node_masleft fl">待支付：</div>

                               <div class="par_node_masright fl"><%= parseFloat(itemc.wait_pay_money) %>元</div>
                           </li>
                           <% } %>

                           <!--已支付-->
                           <% if(itemc.payed_money > 0){ %>
                           <li class="par_node_masli clearfix">
                               <div class="par_node_masleft fl">已支付：</div>
                               <div class="par_node_masright fl"><%= itemc.payed_money %>元</div>
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


                    <%if(parseInt(iteml.pay_schedult) != 1){ %>
                    <div class="pay_money_number">
                        <span>支付金额：</span>
                        <input type="text" class="modify_pay_money" placeholder="<%= iteml.params.money %>元">
                    </div>
                    <% } %>


                    <%if(parseInt(iteml.pay_schedult) != 1){ %>
                    <div class="pay_button">
                        <%if(parseInt(iteml.pay_schedult) == 0){ %>
                            <input type="button" class="pay_nodeSubmit" bIndex="<%= i %>" dIndex="<%= t %>" value="去支付">
                        <% }else if(parseInt(iteml.pay_schedult) == 2){ %>
                            <input type="button" class="pay_nodeSubmit" bIndex="<%= i %>" dIndex="<%= t %>" value="去支付">
                        <% }else if(parseInt(iteml.pay_schedult) == 3){ %>
                            <input type="button" class="pay_nodeSubmit" bIndex="<%= i %>" dIndex="<%= t %>" value="支付中，请稍后.." disabled style="opacity: 0.6;">
                        <% } %>
                   </div>
                    <% } %>
               </div>
            <% } %>
        <% } %>
        <% } %>
    <% } %>
    <% } %>
</script>
<!--zhifu end-->

<!--zhifu jiedian start-->
<script type="text/template" id="payaddmode_mode_templete">
        <% for(var i = 0;i<siteNodeMas.length;i++){ %>
        <% var item = siteNodeMas[i]; %>
        <% if(item.nodeid == ownerSayScoreData.NODEID){ %>
        <% if(item.nodeid == 19){ %>

            <% if(item.pay && item.pay.length > 0){ %>
            <div class="" style="overflow: hidden;">

                <div class="pay_tablebox">
                    <table class="pay_table">
                        <tr>
                            <th colspan="2">支付信息</th>
                        </tr>
                        <% if(item.pay[0].draw_rate && item.pay[0].needmoney){ %>
                        <tr>
                            <td><%= item.pay[0].draw_rate %>合同款</td>
                            <td><%= item.pay[0].needmoney %></td>
                        </tr>
                        <% } %>

                        <% if(item.pay[0].needmoney){ %>
                        <tr>
                            <td>已付款</td>
                            <td><%= item.pay[0].needmoney %></td>
                        </tr>
                        <% } %>
                    </table>
                </div>

            </div>
            <% } %>
        <% }else if(item.nodeid == 15){ %>
            <% if(item.pay && item.pay.length > 0){ %>
            <% if(item.pay[0].nodename == '签订意向定金'){ %>
            <div class="pay_tablebox">
                <% if(item.company){ %>
                    <% if(item.company.col2){ %>
                        <p class="review_tit color999">选定装修公司：<%= item.company.col2 %></p>
                    <% } %>
                <% } %>
                <table class="pay_table">
                    <% if(item.pay[0].nodename){ %>
                    <tr>
                        <th colspan="2"><%= item.pay[0].nodename %></th>
                    </tr>
                    <% } %>

                    <% if(item.pay[0].needmoney){ %>
                    <tr>
                        <td>已付款</td>
                        <td><%= item.pay[0].needmoney %></td>
                    </tr>
                    <% } %>
                </table>
            </div>
            <% }else{ %>
            <div class="pay_tablebox">
                <% if(item.company){ %>
                    <% if(item.company.col2){ %>
                        <p class="review_tit color999" style="padding: 0 0.5rem;">选定装修公司：<%= item.company.col2 %></p>
                    <% } %>
                <% } %>
                <table class="pay_table">
                    <% if(item.pay[0].nodename){ %>
                    <tr>
                        <th colspan="2"><%= item.pay[0].nodename %></th>
                    </tr>
                    <% } %>

                    <% if(item.pay[0].designno){ %>
                    <tr>
                        <td>协议编号</td>
                        <td><%= item.pay[0].designno %></td>
                    </tr>
                    <% } %>

                    <% if(item.pay[0].designpay){ %>
                    <tr>
                        <td>设计协议总金额</td>
                        <td><%= item.pay[0].designpay %></td>
                    </tr>
                    <% } %>

                    <% if(item.pay[0].needmoney){ %>
                    <tr>
                        <td>已付款</td>
                        <td><%= item.pay[0].needmoney %></td>
                    </tr>
                    <% } %>
                </table>
            </div>
            <% } %>
            <% } %>


        <% }else{ %>

            <% if(item.pay && item.pay.length > 0){ %>
            <div class="pay_tablebox">
                <table class="pay_table">
                    <tr>
                        <th colspan="2">支付信息</th>
                    </tr>
                    <% if(item.pay[0].draw_rate){ %>
                    <tr>
                        <td><%= item.pay[0].nodename %></td>
                        <td><%= item.pay[0].draw_rate %></td>
                    </tr>
                    <% } %>

                    <% if(item.pay[0].pay_money){ %>
                    <tr>
                        <td>应收金额</td>
                        <td><%= item.pay[0].pay_money %></td>
                    </tr>
                    <% } %>

                    <% if(item.pay[0].extrapay){ %>
                    <tr>
                        <td>增减项</td>
                        <td><%= item.pay[0].extrapay %></td>
                    </tr>
                    <% } %>


                    <% if(item.pay[0].needmoney){ %>
                    <tr>
                        <td>已付款</td>
                        <td><%= item.pay[0].needmoney %></td>
                    </tr>
                    <% } %>
                </table>
            </div>
            <% } %>

        <% } %>
        <% } %>
        <% } %>
    </script>
<!--zhifu jiedian start-->

<!--见面节点 start-->

<!--见面节点 start-->
</div>
<script src="<?php echo R;?>msite/base/js/zepto.min.js"></script>
<script src="<?php echo R;?>msite/base/js/size.js"></script>
<script src="<?php echo R;?>msite/base/js/underscore-template.js"></script>
<script src="<?php echo R;?>msite/base/js/base.js"></script>
<script src="<?php echo R;?>msite/base/js/swipe.js"></script>
<script src="<?php echo R;?>msite/base/js/pinchzoom.min.js"></script>
<script src="<?php echo R;?>msite/building_live_new/js/fastclick.js"></script>
<script src="<?php echo R;?>msite/building_live_new/js/building_new.min.js"></script>
<script src="<?php echo R;?>msite/building_live_new/js/mysite.min.js"></script>



