<?php defined('IN_WZ') or exit('No direct script access allowed'); ?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>优装美家—管家式装修服务 有品质的低价</title>
    <meta name="viewport" content="width=device-width,minimum-scale=1.0,maximum-scale=1.0, minimal-ui">
    <link rel="stylesheet" href="<?php echo R;?>msite/base/css/base.css">
    <link rel="stylesheet" href="<?php echo R;?>msite/butler-details/css/common.css">
    <link rel="stylesheet" href="<?php echo R;?>msite/butler-details/css/question_explicit.css">
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
        <h1 class="header-title">问题详情</h1>
    </header>


    <section class="question_wd_cont">
        <ul class="wd_cont" id="wd_cont">
            <script type="text/template" id="question-details-template">
                <li class="wd_cont_list">
                    <!--用户问题-->
                    <% var questionTit = questionExpMas.quiz %>
                    <div class="wd_question">
                        <div class="wd_question_t clearfix">
                            <div class="answer_question_logo fl">
                                <img src="<%= questionTit.userp %>" alt="">
                            </div>
                            <div class="user_masa fl">
                                <p class="user_masa_username"><%= questionTit.uname %></p>
                                <p class="user_masa_time"><%= questionTit.qtime %></p>
                            </div>
                            <div class="answer_question_time_r fr clearfix">
                                <i class="fl"></i><b class="fl"><%= questionTit.pv %></b>
                            </div>
                        </div>
                        <p class="wd_question_name "><%= questionTit.title %> </p>
                    </div>
                    <!--管家回答-->
                    <div class="wd_reply clearfix">
                        <span class="trig"></span>
                        <% var dataAnswer = questionExpMas.answer %>
                        <% var isdis = "1px dashed #ccc" %>
                        <% for(var i = 0;i<dataAnswer.length;i++){ %>
                        <% if(i == dataAnswer.length-1){isdis = "none" }%>
                        <% var answeritem = dataAnswer[i]%>
                            <% if(answeritem.founder == 0){ %>
                            <div class="clearfix answer_minute" style="border-bottom: <%= isdis %>;">
                                <div class="wd_reply_l fl">
                                    <div class="answer_question_logo fl">
                                        <img src="<%= answeritem.headportrait %>" alt="">
                                    </div>
                                </div>
                                <ul class="wd_reply_r fl">
                                     <li class="clearfix">
                                        <div class="wd_reply_r_head clearfix">
                                            <span class="wd_reply_name fl"><%= answeritem.gjname %></span>
                                            <span class="wd_reply_place fl">管家</span>
                                            <span class="wd_reply_time fr"><%= answeritem.Time %></span>
                                        </div>
                                        <p class="wd_reply_r_text"><%= answeritem.content %></p>
                                        <div class="wd_reply_r_foot clearfix">

                                            <span class="reply_more_btn fl">查看全文</span>
                                            <div class="answer_time_zan fr" zanid = "<%= answeritem.id %>" number="0">
                                                <i class="fl"></i><span class="fl"><%= answeritem.laud %></span>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                            <% }else if(answeritem.founder == 1){ %>
                            <div class="clearfix answer_minute" style="border-bottom: <%= isdis %>;">
                                <div class="wd_reply_l fl">
                                    <div class="answer_question_logo fl">
                                        <img src="<%= answeritem.headportrait %>" alt="">
                                    </div>
                                </div>
                                <ul class="wd_reply_r fl">
                                    <li class="clearfix" >
                                        <div class="wd_reply_r_head clearfix">
                                            <span class="wd_reply_name fl" style="margin-top: -.2rem;"><%= answeritem.gjname %></span>
                                            <span class="wd_reply_time fr"><%= answeritem.Time %></span>
                                        </div>
                                        <p class="wd_reply_r_text"><%= answeritem.content %></p>
                                        <div class="wd_reply_r_foot clearfix">

                                            <span class="reply_more_btn fl">查看全文</span>
                                            <div class="answer_time_zan fr"  zanid = "<%= answeritem.id %>" number="0">
                                                <i class="fl"></i><span class="fl"><%= answeritem.laud %></span>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </div>

                            <% } %>
                        <% } %>

                    </div>
                </li>
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
<script src="<?php echo R;?>msite/butler-details/js/question_explicit.js"></script>
<script>
    //size
    ;(function(){
        var oRem = document.documentElement.style.fontSize = document.documentElement.clientWidth/320*16+'px';
        window.addEventListener('resize',function(){
            var oRem = document.documentElement.style.fontSize = document.documentElement.clientWidth/320*16+'px';
        },false);
    })();
</script>