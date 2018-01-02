<?php defined('IN_WZ') or exit('No direct script access allowed'); ?><!doctype html>
<html>
<head>
    <meta name="viewport" content="width=device-width,minimum-scale=1.0,maximum-scale=1.0, minimal-ui"/>
    <meta content="yes" name="apple-mobile-web-app-capable">
    <!--iphone桌面快捷方式图标<link rel="apple-touch-icon" href="custom_icon.png">-->
    <meta charset="utf-8">
    <meta name="keywords" content="">
    <meta name="description" content="">
    <title>待验收</title>
    <link rel="stylesheet" href="<?php echo R;?>msite/base/css/base.css">
    <link rel="stylesheet" href="<?php echo R;?>msite/building_live_new/css/building_new.css">
    <link rel="stylesheet" href="<?php echo R;?>msite/building_live_new/css/mysite.css">
    <link rel="stylesheet" href="<?php echo R;?>msite/check_accep/css/check_accep.css">
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
    <h1 class="header-title">竣工验收</h1>
</header>
<div class="check_acc" id="check-content">

</div>
</body>
</html>
<script type="text/template" id="check-temp">

    <div class="check_title">
        <div class="title_logo">
            <i class="iconfont <%= nodeConfig.nodeLogo[data.nodeid] %>"></i>
        </div>
        <span class="acc_titlename"><%= nodeConfig.nodeName[data.nodeid] %></span>
    </div>

    <div class="check_cont">
        <% if(data.photo.length>0){ %>
        <ul class="check_image">
            <% for(var i = 0;i<data.photo.length;i++){ %>
                <li class="pre_lists">
                    <img src="<%= data.photo[i] %>">
                </li>
            <% } %>
        </ul>
        <% } %>

        <% if(data.content){ %>
        <div class=" butler_say_list">
            <div class=" say_logo">
                <img src="<%= data.gjphoto %>" style="width: 100%; margin-top: 0px;">
            </div>
            <div class=" say_text">
                <p class="clearfix"><span class="color_blue ">【管家说】</span><%= data.content %></p>
            </div>
        </div>
        <% } %>

        <% var item = data; %>
        <% if(item.nodeid == 27){ %>
        <% if(item.check_waterdetail.qualifieds || item.counts != 0 || item.check_waterdetail.unqualifieds){ %>
        <% var batteryGc = item.check_detail %>
        <% var wraterGc = item.check_waterdetail; %>
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
                        <a href="mobile-check_detail.html?nodeid=<%= item.nodeid %>&orderid=<%= item.nodeid %>&stem=water"
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
        <% var batteryGc = item.check_detail %>
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
                        <a href="mobile-check_detail.html?nodeid=<%= item.nodeid %>&orderid=<%= ORDER_ID %>"
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


        <% }else if(item.nodeid == 31){ %>
        <!--水路-->
        <% if(item.check_detail.qualified || item.count != 0 || item.check_detail.unqualified){ %>
        <% var batteryGc = item.check_detail %>
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
                        <a href="mobile-check_detail.html?nodeid=<%= item.nodeid %>&orderid=<%= ORDER_ID %>"
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
        <% }else if(item.nodeid == 35){ %>
        <!--水路-->
        <% if(item.check_detail.qualified || item.count != 0 || item.check_detail.unqualified){ %>
        <% var batteryGc = item.check_detail %>
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
                        <a href="mobile-check_detail.html?nodeid=<%= item.nodeid %>&orderid=<%= ORDER_ID %>"
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
        <% }else if(item.nodeid == 37){ %>
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
        <!--old node content end-->

        <!--check accep money & image-->
        <% if(data.extrapay_info.extrapay != 0 || data.extrapay_info.extrapay_photo){ %>
        <div class="accp" >
            <div class="accp_title">增减项明细</div>
            <ul class="accp_money">
                <% if(data.extrapay_info.extrapay != 0){ %>
                <li class="accp_cont accp_moneynumber">
                    <div class="acct_conttitle">
                        增减项金额：
                    </div>
                    <div class="acct_contres">
                        <div class="acct_contrestext">
                            <% if(data.extrapay_info.extrapay >= 0){ %>
                            <i class="iconfont icon-jiahao"></i><span><%= Math.abs(data.extrapay_info.extrapay) %></span>
                            <% }else { %>
                            <i class="iconfont icon-jianhao"></i><span><%= Math.abs(data.extrapay_info.extrapay) %></span>
                            <% } %>
                        </div>
                        <span class="acc_danwei">元</span>
                    </div>
                </li>
                <% } %>

                <% if(data.extrapay_info.extrapay_photo){ %>
                <li class="accp_cont accp_moneyimg">
                    <div class="acct_conttitle">
                        增减项明细：
                    </div>
                    <div class="acc_contimg" nodeid="<%= data.nodeid %>">
                        <img src="<%= data.extrapay_info.extrapay_photo %>">
                    </div>
                </li>
                <% } %>
            </ul>
        </div>
        <% } %>
        <!--check submit button-->
        <div class="acc_button_mode">
            <input type="button" id="accp_submit" class="acc_button" value="确认验收通过">
        </div>
    </div>
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

<script type="text/javascript" src="<?php echo R;?>msite/base/js/zepto.min.js"></script>
<script type="text/javascript" src="<?php echo R;?>msite/base/js/underscore-template.js"></script>
<script type="text/javascript" src="<?php echo R;?>msite/base/js/base.js"></script>
<script type="text/javascript" src="<?php echo R;?>msite/base/js/swipe.js"></script>
<script type="text/javascript" src="<?php echo R;?>msite/base/js/pinchzoom.min.js"></script>
<script type="text/javascript" src="<?php echo R;?>msite/base/js/size.js"></script>
<script type="text/javascript" src="<?php echo R;?>msite/check_accep/js/check_accep.js"></script>