<?php defined('IN_WZ') or exit('No direct script access allowed'); ?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>优装美家—管家式装修服务 有品质的低价</title>
    <meta name="viewport" content="width=device-width,minimum-scale=1.0,maximum-scale=1.0, minimal-ui">
    <link rel="stylesheet" href="<?php echo R;?>msite/base/css/base.css">
    <link rel="stylesheet" href="<?php echo R;?>msite/butler-details/css/common.css">
    <link rel="stylesheet" href="<?php echo R;?>msite/butler-details/css/question_list.css">
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
        <h1 class="header-title"></h1>
    </header>
    <section class="question_cont">

        <ul class="question_list"  id="question_box">
            <script type="text/template" id="question-list-template">
                <% for (var i = 0;i<questionListMas.length;i++){ %>
                    <% var item = questionListMas[i]%>
                    <li class="answer_list">
                        <a class="list_link" href="mobile-butler_question_explicit.html?id=<%= item.id %>">
                            <div class="answer_title clearfix">
                                <div class="answer_question_logo fl">
                                    <img src="<%= item.userp %>" alt="">
                                </div>
                                <div class="answer_question_name fl"><%= item.uname %></div>
                            </div>
                            <p class="question_hd"><%= item.title %></p>
                            <div class="answer_question_time clearfix">
                                <p class="fl"><%= item.Time %></p>
                                <div class="answer_question_time_r fr clearfix">
                                    <span class="fl">已有<%= item.sumanswer %>条回答</span><i class="fl"></i><b class="fl"><%= item.pv %></b>
                                </div>
                            </div>
                        </a>
                    </li>
                <% } %>
            </script>
        </ul>
    </section>
    <section class="footer_zhuge">
        <span class="footer_zhuge_close"></span>
        <a class="footer_zhuge_link" href="http://b.uzhuang.com"></a>
    </section>
</body>
</html>
<script src="<?php echo R;?>msite/base/js/zepto.min.js"></script>
<script src="<?php echo R;?>msite/base/js/underscore-template.js"></script>
<script src="<?php echo R;?>msite/base/js/base.js"></script>
<script src="<?php echo R;?>msite/butler-details/js/question_list.js"></script>
<script>
    //size
    ;(function(){
        var oRem = document.documentElement.style.fontSize = document.documentElement.clientWidth/320*16+'px';
        window.addEventListener('resize',function(){
            var oRem = document.documentElement.style.fontSize = document.documentElement.clientWidth/320*16+'px';
        },false);
    })();
</script>