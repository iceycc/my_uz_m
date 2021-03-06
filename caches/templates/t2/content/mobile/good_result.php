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
<link href="<?php echo R;?>msite/good_day/css/good_result.css" rel="stylesheet" type="text/css">
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
<body id="managerPage">
<div id='share_logo' style='margin:0 auto;display:none;'> 
  <img src="<?php echo R;?>msite/base/img/share_logo.jpg"/> 
</div>
<header>
    <div class="tit_minu">
        <a id="go-back" target="_self" title="优装美家">
            <i class="iconfont icon-goback"></i>
        </a>
        <a class="back_index" href="mobile-index.html">首页</a>
    </div>
    <h1 class="header-title">装修吉日</h1>
</header>
<section class="top" id="good-box">
    <!-- <div class="content">
        <h3>一个月内适合您的装修吉日是</h3>
        <p class="time"><span id="year">2016</span>年<span id="month">11</span>月</p>
        <p id="day">13</p>
        <p class="today">星期日</p>
        <a class="change-day" href="#">换一个</a>
    </div>
    <div class="good-bad">
        <div class="good">
            <p>宜</p>
            <ul class="good-list">
                <li>结婚</li>
            </ul>
        </div>
        <div class="bad">
            <p>忌</p>
            <ul class="bad-list">
                <li>针灸</li>
            </ul>
        </div>
    </div> -->
</section>
<section class="center">
    <h3 class="center-t"><span></span><p>为您推荐</p></h3>
    <div class="fs-content">
        <p class="know-title">装修风水知识</p>
        <ul class="fs-list" id="fs-box">
            <!-- <li>
                <a href="#">
                    <div class="img-box">
                        <img src="<?php echo R;?>msite/good_day/img/jr_banner.jpg" alt="攻略图" />
                    </div>
                    <div class="word-box">
                        <h3>装修管家15年经验总结 收房...</h3>
                        <p>房屋装修分为硬装和软装，前者决定房屋质量而后者却是决定房屋美观与否的</p>
                    </div>
                </a>
            </li> -->
        </ul>
    </div>
</section>
<section class="bottom">
    <p class="know-title">装修风水问答</p>
    <div id="bottom-box">
        <!-- <div class="bottom-box">
            <div class="question">
                <img src="<?php echo R;?>msite/good_day/img/jr_banner.jpg" alt="用户头像" />
                <p>玄关设计在风水上需要注意什么？</p>
            </div>
            <div class="answer">
                <p>好不容易盼到交房，还有一笔重要的支出那就是如何做好预算，是我们非常关心的问题可又很难解决。大们非常题难问...</p>
                <img src="<?php echo R;?>msite/good_day/img/jr_banner.jpg" alt="管家头像" />
            </div>
            <a href="">查看全文</a>
        </div> -->
    </div>
</section>

<!-- 错误提示 -->
<section id="errorCue" class="hideError"><span id="errorMsg">您输入的姓名或电话有错误</span></section>

<script type="text/template" id='good-data'>
    <% for(var i=0; i<data.length; i++){ %>
        <% var item = data[i] %>
        <div class="content">
            <h3><%= item.decorate %></h3>
            <p class="time"><span id="year"><%= item.sYear %></span>年<span id="month"><%= item.sMonth %></span>月</p>
            <p id="day"><%= item.sDay %></p>
            <p class="today">星期<%= item.week %></p>
            <a class="change-day" href="/mobile-good_result.html">换一个</a>
        </div>
        <div class="good-bad">
            <div class="good">
                <p>宜</p>
                <ul class="good-list">
                    <% for(var key in item.fit){ %>
                        <li><%= item.fit[key] %></li>
                    <% } %>
                </ul>
            </div>
            <div class="bad">
                <p>忌</p>
                <ul class="bad-list">
                    <% for(var key in item.fear){ %>
                        <li><%= item.fear[key] %></li>
                    <% } %>
                </ul>
            </div>
        </div>
    <% } %>
</script>
<script type="text/template" id="center-data">
    <% for(var i=0; i<House_geomancy.length; i++){ %>
        <% var item = House_geomancy[i] %>
        <li>
            <a href="<%= item.url %>&pid=fs">
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
</script>
<script type="text/template" id="bottom-data">
    <% for(var i=0; i<zx_question.length; i++){ %>
        <% var item = zx_question[i] %>
        <div class="bottom-box">
            <a href="/mobile-butler_question_explicit.html?id=<%= item.id %>">
                <div class="question">
                    <img src="<%= item.tw_photo %>" alt="用户头像" />
                    <p><%= item.title %></p>
                </div>
                <% if(item.qid && item.qid.length != 0){ %>
                    <div class="answer">
                        <p><%= item.qid[0].content %></p>
                        <img src="<%= item.qid[0].hf_photo %>" alt="管家头像" />
                    </div>
                <% } %>
                <span>查看全文</span>
            </a>
        </div>
    <% } %>
</script>
<script type="text/javascript" src="<?php echo R;?>msite/base/js/zepto.min.js"></script>
<script type="text/javascript" src="<?php echo R;?>msite/base/js/underscore.min.js"></script>
<script type="text/javascript" src="<?php echo R;?>msite/base/js/base.js"></script>
<script type="text/javascript" src="<?php echo R;?>msite/base/js/size.js"></script>
<script type="text/javascript" src="<?php echo R;?>msite/good_day/js/good_result.js"></script>
<script type="text/javascript">
</script>
</body>
</html>