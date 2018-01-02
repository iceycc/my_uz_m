<?php defined('IN_WZ') or exit('No direct script access allowed'); ?><!doctype html>
<html>
<head>
    <meta name="viewport" content="width=device-width,minimum-scale=1.0,maximum-scale=1.0, minimal-ui"/>
    <meta content="yes" name="apple-mobile-web-app-capable">
    <!--iphone桌面快捷方式图标<link rel="apple-touch-icon" href="custom_icon.png">-->
    <meta charset="utf-8">
    <meta name="keywords" content="装修管家,量房设计,装修施工,材料商城,环保方案,装修服务,装修图库,建材商城,装修攻略、优装网、装修网、优装美家">
    <meta name="description" content="优装美家为您提供免费专业咨询、免费量房、免费设计、免费装修保险、免费环保检测、优装网-专业装修网优选装修公司、优选建材商品、优选装修管家、优选环保服务">
    <title>优装美家—管家式装修服务 有品质的低价</title>
    <link rel="stylesheet" type="text/css" href="<?php echo R;?>msite/base/css/base.css">
    <link rel="stylesheet" type="text/css" href="<?php echo R;?>msite/base/css/case_base.css">
    <link rel="stylesheet" type="text/css" href="<?php echo R;?>msite/building_live_new/css/iconfont.css">

    <link rel="stylesheet" type="text/css" href="<?php echo R;?>msite/user_home/css/user_home.css">
    <link rel="stylesheet" type="text/css" href="<?php echo R;?>msite/company/css/company-list.css">
    <link rel="stylesheet" type="text/css" href="<?php echo R;?>msite/designer/css/designer-list.css">
    <link rel="stylesheet" type="text/css" href="<?php echo R;?>msite/user_home/css/mysite_list.css">
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
    <img src="<?php echo R;?>msite/base/img/share_logo.jpg"/>
</div>
<!--Top Bar Start-->
<header>
    <!--<a id="logo" href="##" target="_self" title="优装美家"><i class="iconfont icon-jingyu"></i></a>-->
    <div class="tit_minu">
        <a class="back_index" href="mobile-index.html">首页</a>
    </div>
    <h1 class="header-title">我的美家</h1>
    <a id="logout" href="#">退出</a>
</header>

<!--Top Bar End-->
<!--User Information Start-->
<section id="user-inform">
</section>
<!--User Information End-->
<!--Tab Start-->
<section class="tab_list">
    <ol class="tab-slider" id="my_pay_list">

    </ol>
    <ul class="tab-slider">
        <li id="my-live"><i class="iconfont icon-gongd tapicon_logo"></i><a class="tab" href="javascript:"><span class="title-name">我的工地</span><i class="iconfont icon-arrow"></i></a></li>
        <li id="my-like"><i class="iconfont icon-shoucang tapicon_logo"></i><a class="tab" href="javascript:"><span class="title-name">我的收藏</span><i class="iconfont icon-arrow"></i></a></li>
        <li id="my-news"><i class="iconfont icon-xiaoxi tapicon_logo"></i><a class="tab" href="javascript:"><span class="title-name">我的消息</span><span class="news-num">0</span><i class="iconfont icon-arrow"></i></a></li>
    </ul>
</section>
<!--Tab End-->

<section class="show-box">
    <div class="show-header">
        <!-- <a class="goback" target="_self" title="优装美家"><i class="iconfont icon-goback"></i></a> -->
        <div class="tit_minu">
            <a class="goback" target="_self" title="优装美家">
                <i class="iconfont icon-goback"></i>
            </a>
            <a class="back_index" href="mobile-index.html">首页</a>
        </div>
        <h3 class="show-title">我的美家</h3>
    </div>
    <!-- Building List S-->
    <!-- <div id="building-list">
        <ul id="list-content" class="list-ul">
            <li class="list-li">
              <div class="manager-info">
                <img src="<?php echo R;?>msite/building_live/img/manager-face.png" alt="" class="manager-face" />
                <p class="manager-name">文丑</p>
                <p class="manager-job">管家</p>
                <p class="update-time"><i class="iconfont icon-days"></i><span>6小时前更新</span></p>
              </div>
              <div class="building-box">
                <img src="<?php echo R;?>msite/building_live/img/building-img.jpg" alt="效果图">
                <a href="##" class="building-info"><div class="info-div"><h3>泥木验收</h3><span>绣菊园吕先生家装修日志绣菊园吕先生家装修</span></div></a>
              </div>
            </li>
            <script type="text/template" id="list-content-data">
                <% for(var i=0; i < data.length; i++) { %>
                <% var item = data[i] %>
                <% if(item.status && item.status == 2) { %>
                <li class="list-li">
                    <div class="building-status">
                        <a class="building-info">
                            <div class="info-div"><h3><%= item.res %></h3><span><%= item.address %></span></div>
                        </a>
                    </div>
                </li>
                <% } else { %>
                <li class="list-li">
                    <div class="manager-info">
                        <img class="manager-face" src=<%= item.personalphoto %>>
                        <p class="manager-name"><%= item.gjname %></p>
                        <p class="manager-job">管家</p>
                        <p class="update-time"><i class="iconfont icon-days"></i><span><%= item.addtime %></span></p>
                    </div>
                    <div class="building-box">
                        <% if(item.sitephoto) { %>
                        <img class="lazy-img" data-original=<%= item.sitephoto %>>
                        <% } else {%>
                        <img class="lazy-img" data-original=<%= item.recphoto %>>
                        <% } %>
                        <a class="building-info" href="mobile-live_detail.html?live_id=<%= item.orderid %>&myself=1">
                            <div class="info-div"><h3><%= item.nodename %></h3><span><%= item.logname %></span><p><span><%= item.budget %>万</span><span><%= item.area %>㎡</span><span><%= item.homestyle[0] %></span><span><%= item.way[0] %></span></p></div>
                            <div class="look-write-num">
                                <p><i class="iconfont icon-eyes"></i><span><%= item.browse_count %></span></p>
                                <p><i class="iconfont icon-pinglun"></i><span><%= item.message %></span></p>
                            </div>
                        </a>
                    </div>
                </li>
                <% } %>
                <% } %>
            </script>
        </ul>
    </div> -->
    <!-- Building List E-->
    <!--Orders List Start-->
    <div id="order-box">
        <ul id="order_list" >
        </ul>
    </div>
    <!--Orders List End-->
    <div id="my-favor">
        <!--Works start-->
        <div id="works-list">
            <div class="slide-tag mod-name">
                <i class="iconfont icon-tuku"></i>
                <h3>精品案例</h3>
                <i class="iconfont icon-gotonext"></i>
                <div class="total"><span id="total-number" class="number">0</span>套</div>
            </div>
            <ul id="content-now" class="slide_content" style="display:none">
            </ul>
        </div>
        <!--Works end-->
        <!--Company Start-->
        <div id="favor-company">
            <div class="slide-tag mod-name">
                <i class="iconfont icon-koubei"></i>
                <h3>口碑公司</h3>
                <i class="iconfont icon-gotonext"></i>
                <div class="total"><span id="company-number" class="number">0</span>家</div>
            </div>
            <div id="companys-list" class="slide_content" style="display:none">
                <ul id="company-list">
                    <script type="text/template" id="company-list-template">
                        <% $("#company-number").html(user_data.length);%>
                        <% for(var i=0; i
                        <user_data.length; i++){ %>
                        <% var item = user_data[i] %>
                        <li class="company-li clearfix">
                            <img class="company-logo" src=<%=item.companylogos%>>
                            <div class="txt">
                                <h2 class="company-name"><%=item.title%></h2>
                                <h3 class="tag"><%=item.tese%></h3>
                                <div class="data">
                                    <div class="works">案例：<span class="number"><%=item.photonum%></span></div>
                                    <div class="designers">设计师：<span class="number"><%=item.designnum%></span></div>
                                    <div class="score_total">综合评分：<span class="number"><%=item.avg_total%></span></div>
                                </div>
                            </div>
                            <a class="company_link" href=<%="mobile-company_detail.html?company_id="+item.id%>>&nbsp;</a>
                        </li>
                        <% } %>
                    </script>
                </ul>
            </div>
        </div>
        <!--Company End-->
        <!--Designers Start-->
        <div id="favor-designer">
            <div class="slide-tag mod-name">
                <i class="iconfont icon-shejishi"></i>
                <h3>设计师</h3>
                <i class="iconfont icon-gotonext"></i>
                <div class="total"><span id="designer-number" class="number">0</span>位</div>
            </div>
            <div id="designers-list" class="slide_content" style="display:none">
                <ul id="designer-list" class="clearfix">
                    <script type="text/template" id="company-designer-template">
                        <% $("#designer-number").html(favor_designer.length)%>
                        <% for(var i=0; i
                        <favor_designer.length; i++){ %>
                        <% var item = favor_designer[i] %>
                        <li>
                            <% if(item.thumb1){ %>
                            <img class="face" src=<%=item.thumb1%>>
                            <% }else{ %>
                            <img class="face" src=<%=item.thumb%>>
                            <% } %>
                            <div class="right-txt">
                                <h3 class="designer-name"><%=item.title%></h3>
                                <div class="about-designer">
                                    <div class="title"><%=item.ranks%></div>
                                    <div class="works"><span class="icon-tuku iconfont"></span>作品：<span class="work-number"><%=item.productionnum%></span>
                                    </div>
                                    <div class="follows"><span class="icon-fire iconfont"></span>人气：<span
                                            class="follow-number"><%=item.design_collectnums%></span></div>
                                </div>
                            </div>
                            <a class="designer-link" href=<%="mobile-designer.html?designer_id="+item.id%>>&nbsp;</a>
                        </li>
                        <% } %>
                    </script>
                </ul>
            </div>
        </div>
        <!--Designers End-->
        <!--Works start-->
        <!-- <div id="live-box">
            <div class="slide-tag mod-name">
                <i class="iconfont icon-gongdi"></i>
                <h3>工地直播</h3>
                <i class="iconfont icon-gotonext"></i>
                <div class="total"><span id="live-number" class="number">0</span>家</div>
            </div>
            <ul id="live-list" class="slide_content list-ul" style="display:none">
            </ul>
        </div> -->
        <!--Works end-->
        <!--classroom s-->
        <div id="favor-classroom">
            <div class="slide-tag mod-name">
                <i class="iconfont icon-zhuangxiuketang1"></i>
                <h3>装修课堂</h3>
                <i class="iconfont icon-gotonext"></i>
                <div class="total"><span id="classroom-number" class="number">0</span>课</div>
            </div>
            <div id="classrooms-list" class="slide_content" style="display:none">
                <ul id="classroom-list" class="building-list story-list">
                    <script type="text/template" id="classroom-list-template">
                        <% $("#classroom-number").html(data.length)%>
                        <% for(var i=0; i<data.length; i++){ %>
                            <% var item = data[i] %>
                            <% if(item.status == "gs"){ %>
                                <li class="story-li">
                                    <a href="<%= item.url %>&pid=<%= item.status %>">
                                        <div class="story-box">
                                            <img src="<%= item.thumb %>" alt="业主故事封面图" />
                                            <div class="ceng-box">
                                                <h3 class="story-h3"><%= item.title %></h3>
                                                <p><%= item.addtime %></p>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                            <% } else if(item.status == "sp") { %>
                                <% var newT = encodeURIComponent(item.title) %>
                                <li class="video-li">
                                    <div class="video-img">
                                        <a href="/mobile-play_video.html?videourl=<%= item.urls %>&title=<%= newT %>&id=<%= item.id %>">
                                            <img src="<%= item.thumb %>" alt="视频封面图" />
                                            <i class="play_btn"></i>
                                        </a>
                                    </div>
                                    <!-- <div class="c_video">
                                        <iframe width="100%" height="100%" src="<%= item.url %>" frameborder=0 allowfullscreen></iframe>
                                    </div> -->
                                    <p class="video-title"><%= item.title %></p>
                                </li>
                            <% } else { %>
                                <li class="building-li">
                                    <a href="<%= item.url %>&pid=<%= item.status %>">
                                        <div class="img-box">
                                            <img src="<%= item.thumb %>" alt="攻略图" />
                                        </div>
                                        <div class="word-box">
                                            <h3 class="same-h3"><%= item.title %></h3>
                                            <p class="same-p"><%= item.remark %></p>
                                        </div>
                                    </a>
                                </li>
                            <% } %>
                        <% } %>
                    </script>
                </ul>
            </div>
        </div>
        <!--classroom e-->
        <!--butler s-->
        <div id="favor-butler">
            <div class="slide-tag mod-name">
                <i class="iconfont icon-butlersc"></i>
                <h3>管家</h3>
                <i class="iconfont icon-gotonext"></i>
                <div class="total"><span id="butler-number" class="number">0</span>位</div>
            </div>

            <div id="butler-list" class="slide_content" style="display:none">
                <ul id="butler-listdata">
                    <script type="text/template" id="butler-listdata-template">
                        <% for(var i=0; i<butler_data.length; i++){ %>
                        <% var item = butler_data[i] %>
                        <li class="clearfix butler_sclist">
                            <a href="mobile-m_butler_details.html?butlerid=<%=item.gj_id%>">
                                <div class="butler_logo fl">
                                    <img src="<%= item.personalphoto %>">
                                </div>
                                <div class="butler_cont fl">
                                    <div class="clearfix butler_cont_tit">
                                        <h3 class="fl h3"><%=item.gjname%></h3>
                                        <% if(item.level == 1){ %>
                                            <p class="fl"><span></span>金牌管家</p>
                                        <% } %>
                                    </div>
                                    <div class="clearfix butler_cont_mas">
                                        <p class="fl p1"><i class="iconfont icon-gongdiB"></i>工地:<%=item.constru_num%></p>
                                        <p class="fl"><i class="iconfont icon-jieda"></i>解答:<%=item.answer_num%></p>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <% } %>
                    </script>
                </ul>
            </div>
        </div>
        <!--butler e-->
        <div id="favor-meal">
            <div class="slide-tag mod-name">
                <i class="iconfont icon-taocan1"></i>
                <h3>套餐</h3>
                <i class="iconfont icon-gotonext"></i>
                <div class="total"><span id="taocan-number" class="number">0</span>位</div>
            </div>
            <div id="meal-list" class="slide_content" style="display:none">
                <script type="text/template" id="meal-list-template">
                    <% for(var i = 0;i< data.length;i++){ %>
                    <% var item = data[i]; %>
                    <li class="meal_list">
                        <a href="mobile-meal_detail.html?id=<%= item.id %>" class="meal_link"></a>
                        <div class="meal_top_img">
                            <img class="lazy-img" src="<%= item.m_package_photos %>">
                        </div>
                        <div class="meal_text">
                            <div class="meal_text_title">
                                <% if(item.spreadhead){ %>
                                <div class="meal_name"><%= item.spreadhead %></div>
                                <% } %>

                                <% if(item.product_type){ %>
                                <div class="meal_title_lable"><%= item.product_type %></div>
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
            </div>
        </div>
    </div>
    <!-- my news start-->
    <div id="my-news-box">
        <ul id="news-content" class="news-ul">
            <!-- <li><a href="">
                <img src="<?php echo R;?>msite/user_home/img/temp/user_face.jpg" alt="" class="user-face" />
                <div class="new-info">
                    <p>
                        <span class="user-name">西瓜汁</span>
                        <span class="write-time">2016-05-29</span>
                    </p>
                    <p class="words-len">
                        <span class="common-len">回复了你</span><span class="live-name">@绣菊园吕先生家装修日志--预约量房：</span><span class="detail-new">对啊，我也好奇， 求楼主解答啊</span>
                    </p>
                </div>
            </a></li> -->
        </ul>
    </div>
    <!-- my news end-->
</section>

<script type="text/template" id="user-inform-data">
    <div id="user-head">
        <img id="user-face" src=<%= member.avatar%>>
        <h2 id="user-name"><%= member.nickname%></h2>
    </div>
</script>

<script type="text/template" id="order-data">
    <% for(var i = 0;i<mySiteData.length;i++){ %>
    <% var item = mySiteData[i] %>
    <li class="site_mode">
        <div class="site_live mode_link">
            <a href="mobile-mysite.html?live_id=<%= item.orderid %>"></a>
            <div class="site_tit">
                <p class="order_id">订单编号：<%= item.order_no %></p>
                <% if(item.address){ %>
                <p class="add_ress">地址：<%= item.address %></p>
                <% } %>
            </div>

            <div class="site_cont">
                <h2 class="site_c_tit"><%= item.status %></h2>

                <div class="site_c_logo">
                    <i class="<%= nodeLogo[item.nodeid] %>"></i>
                </div>
                <p class="site_nodename">最新进度：<%= item.nodename %></p>

                <% if(item.personalphoto || item.gjname || item.level){ %>
                <div class="site_c_desc clearfix">
                    <% if(item.personalphoto){ %>
                    <div class="fl site_gj_logo">
                        <img src="<%= item.personalphoto %>">
                    </div>
                    <% } %>

                    <% if(item.gjname || item.level){ %>
                    <div class="fl">
                        <% if(item.gjname){ %>
                        <span class="site_gj_name"><%= item.gjname %></span>
                        <% } %>

                        <% if(item.level){ %>
                        <span class="site_gj_status"><%= item.level %></span>
                        <% } %>
                    </div>
                    <% } %>

                    <% if(item.addtime){ %>
                    <p class="fr"><%= item.addtime %></p>
                    <% } %>

                </div>
                <% }else if(item.count == 0){ %>
                <div style="height: 0.5rem;"></div>
                <% } %>
            </div>
        </div>
        <% if(item.company_id && item.count > 0){ %>
        <div class="pinglun_status mode_link">
            <% var orderStatus = item.order_status; %>
            <% if(orderStatus.step == 1){ %>

                <a href="<%= wait_config.waitLink[orderStatus.step] %>?orderid=<%= orderStatus.unchecked[0].orderid %>&nodeid=<%= orderStatus.unchecked[0].nodeid %>"></a>
                <p><i class="iconfont icon-ayixiangqingduihao"></i></p>
                <p><%= item.count %>个待验收</p>
            <% }else if(orderStatus.step == 2){ %>

                <a href="<%= wait_config.waitLink[orderStatus.step] %>?orderid=<%= orderStatus.unpay[0].orderid %>&nodeid=<%= orderStatus.unpay[0].nodeid %>&id=<%= orderStatus.unpay[0].id %>"></a>
                <p><i class="iconfont icon-ayixiangqingduihao"></i></p>
                <p><%= item.count %>个待支付</p>
            <% }else if(orderStatus.step == 3){ %>

                <a href="<%= wait_config.waitLink[orderStatus.step] %>?orderid=<%= orderStatus.unevaluate[0].orderid %>"></a>
                <p><i class="iconfont icon-ayixiangqingduihao"></i></p>
                <p><%= item.count %>个待评价</p>
            <% } %>
        </div>
        <% } %>
    </li>
    <% } %>
</script>

<script type="text/template" id="content-now-data">
    <% for (var i=0; i<data.length; i++){ %>
    <% var item = data[i] %>
    <% if(item.status == 1){ %>
    <li class="content-li">
        <img class="lazy-img" data-original=<%= item.cover%>>
        <a href=mobile-detail_case.html?id=<%= item.id%> class="content-size">
            <div>
                <h3><%= item.name%></h3>
                <p>
                    <% for(key in item.style) { %>
                    <span><i class="dian"></i><%= item.style[key]%></span>
                    <% } %>
                    <i class="dian"></i><span><%= item.housetype%></span>
                </p>
            </div>
        </a>
    </li>
    <% } %>
    <% } %>
</script>

<!-- <script type="text/template" id="live-list-data">
    <% for(var key in data) { %>
    <% var item = data[key] %>
    <li class="list-li">
        <div class="manager-info">
            <img class="manager-face" src=<%= item.personalphoto %>>
            <p class="manager-name"><%= item.gjname %></p>
            <p class="manager-job">管家</p>
            <p class="update-time"><i class="iconfont icon-days"></i><span><%= item.addtime %></span></p>
        </div>
        <div class="building-box">
            <% if(item.log_photo) { %>
              <img class="lazy-img"  data-original=<%= item.log_photo %>>
            <% } else { %>
              <img class="lazy-img"  data-original="<?php echo R;?>msite/building_live_new/img/cover.jpg" >
            <% } %>
            <a class="building-info" href="mobile-live_detail.html?live_id=<%= item.orderid %>">
                <div class="info-div"><h3><%= item.nodename %></h3><span><%= item.logname %></span><p><span><%= item.budget %>万</span><span><%= item.area %>㎡</span><span><%= item.homestyle[0] %></span><span><%= item.way[0] %></span></p></div>
                <div class="look-write-num">
                    <p><i class="iconfont icon-eyes"></i><span><%= item.browse_count %></span></p>
                    <p><i class="iconfont icon-pinglun"></i><span><%= item.message %></span></p>
                </div>
            </a>
        </div>
    </li>
    <% } %>
</script> -->

<script type="text/template" id="news-data">
    <% for(var key in data){ %>
        <% var items = data[key] %>
        <% for(var i=0; i<items.length; i++){ %>
            <% var item = items[i] %>
            <li><a href="mobile-mysite.html?id=<%= item.orderid %>&nodeid=<%= item.nodeid %>">
                <img src="<%= item.photo %>" alt="" class="user-face" />
                <div class="new-info">
                    <p>
                        <span class="user-name"><%= item.name %></span>
                        <span class="write-time"><%= item.addtime %></span>
                    </p>
                    <p class="words-len">
                    <% if(item.status == 1){ %>
                        <span class="common-len">回复了你</span><span class="live-name">@<%= item.nodename %>：</span><span class="detail-new"><%= item.content %></span>
                    <% } %>
                    <% if(item.status == 2){ %>
                        <span class="common-len">评论了你</span><span class="live-name">@<%= item.nodename %>：</span><span class="detail-new"><%= item.content %></span>
                    <% } %>
                    </p>
                </div>
            </a></li>
        <% } %>
    <% } %>
</script>

<script type="text/template" id="my-wait">
    <% if(wait_data){ %>
        <% for(var i = 0;i < wait_data.length;i++){ %>
        <% var item = wait_data[i]; %>
            <% if(item.step > 0){ %>
                <li class="my-pay">
                    <i class="<%= wait_config.waitIcon[item.step] %> tapicon_logo"></i>
                    <!--1==> 待验收 2==> 待支付 3 ==> 待评价-->
                    <a class="tab" href=
                        <% if(item.step == 1){ %>

                            <%= wait_config.waitLink[item.step] %>?orderid=<%= item.unchecked[0].orderid %>&nodeid=<%= item.unchecked[0].nodeid %>

                        <% }else if(item.step == 2){ %>

                            <%= wait_config.waitLink[item.step] %>?orderid=<%= item.unpay[0].orderid %>&nodeid=<%= item.unpay[0].nodeid %>&id=<%= item.unpay[0].id %>

                        <% }else if(item.step == 3){ %>

                            <%= wait_config.waitLink[item.step] %>?orderid=<%= item.unevaluate[0].orderid %>

                        <% } %>

                    >
                        <span class="title-name"><%= wait_config.waitName[item.step] %></span>
                        <i class="iconfont icon-arrow"></i>
                        <span class="my_pay_num">
                            <% if(item.step == 3){ %>
                                <%= item.unevaluate.length %>
                            <% }else if(item.step == 1){ %>
                                <%= item.unchecked.length %>
                            <% }else if(item.step == 2){ %>
                                <%= item.unpay.length %>
                            <% } %>
                        </span>

                    </a>
                </li>
            <% } %>
        <% } %>
    <% } %>
</script>
<script type="text/javascript" src="http://player.youku.com/jsapi"></script>
<script src="<?php echo R;?>msite/base/js/zepto.min.js"></script>
<script src="<?php echo R;?>msite/base/js/underscore-template.js"></script>
<script src="<?php echo R;?>msite/base/js/base.js"></script>
<script src="<?php echo R;?>msite/base/js/size.js"></script>
<script src="<?php echo R;?>msite/base/js/dxlazyload.js"></script>
<script src="<?php echo R;?>msite/user_home/js/user_home.js"></script>
</body>
</html>
