<?php defined('IN_WZ') or exit('No direct script access allowed'); ?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>优装美家专业装修管家服务  装修监理服务，全程帮您管装修 </title>
    <meta name="viewport" content="width=device-width,minimum-scale=1.0,maximum-scale=1.0, minimal-ui">
    <meta name="keywords" content="装修管家，装修服务，装修监理，环保服务 优装美家">
    <meta name="description" content="优装美家，要装修找优装美家装修管家，全程为您保驾护航，提供全方位专业高品质装修服务，提供资深监理服务，提供装修顾问服务">
    <link rel="stylesheet" href="<?php echo R;?>msite/base/css/base.css">
    <link rel="stylesheet" href="<?php echo R;?>msite/butler-details/css/common.css">
    <link rel="stylesheet" href="<?php echo R;?>msite/butler-details/css/butler-details.css">
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
<header id="header">
    <script type="text/template" id="header-template">
        <%if(urlStem != 'wx'){%>
            <div class="tit_minu">
                <a id="go-back" target="_self" title="优装美家">
                    <i class="iconfont icon-goback"></i>
                </a>
                <a class="back_index" href="mobile-index.html">首页</a>
            </div>
            <h1 class="header-title"></h1>
        <% }else{ %>
            <a id="logo" href="mobile-index.html" target="_self" title="优装美家">
                <i class="iconfont icon-jingyu"></i>
            </a>
            <span class="in_title_name iconfont icon-logo"></span>
        <% } %>
    </script>
</header>

<!--管家信息 s-->
<section class="butler_mas" id="butler_mas_box">
    <script type="text/template" id="butlerMas-template">
        <ul class="mas_xq">
            <li class="mas_list mas_name">
                <% if(butlerMas.level == 1){ %>
                <a href="http://m.uzhuang.com/mobile-template.html?temp=166" style="color: #ffc700;">
                    <p class="clearfix">
                        <em class="fl"><%=butlerMas.levelname%></em>
                        <i class="fl"></i>
                        <a href="http://m.uzhuang.com/mobile-template.html?temp=166" class="fl"></a>
                    </p>
                </a>
                <% } %>
                <h2><%=butlerMas.gjname%></h2>
            </li>
            <li class="mas_time">从业时间<span class="color_gold font_14 padlr_10"><%=butlerMas.worktime%></span>年</li>
            <li class="mas_number">服务客户<span class="color_gold font_14 padlr_10"><%=butlerMas.service_num%></span>个</li>
            <li class="mas_rate">客户好评率<span class="color_gold font_14 padlr_10"><%=butlerMas.good_percent%></span></li>
            <li class="mas_point">
                <ol class="clearfix">
                    <% for(var i=0; i
                    <butlerMas.person_label.length
                    ; i++){ %>

                    <% var item = butlerMas.person_label[i] %>
                    <% if(item == ''){break;}%>
                    <li class="fl"><%=item%></li>
                    <% } %>

                </ol>
            </li>
        </ul><!--<%=butlerMas.headportrait%>-->
        <img class="mas_logo" src="<%=butlerMas.headportrait%>" alt="">
        <span class="butler_mas_bot"></span>
    </script>
</section>
<!--管家信息 e-->

<!--管家承诺 e-->

<!-- <section class="promise">
     <p>“没有更好的承诺，只有更好的服务！让顾客更省心、
         省时、省钱，确保工作效率最大化。以专业的知识，贴
         心的服务和不懈的努力，来为您解决装修中的烦恼。”
     </p>
 </section>-->
<!--管家承诺 e-->

<!--个人经历 s-->

<div id="promise_undergo">
    <script type="text/template" id="promise_undergo-template">
        <section class="promise">
            <p><%=butlerMas.lifeword%></p>
        </section>
        <section class="undergo">
            <section class="undergo_title"><span>从业经历</span></section>
            <p><%=butlerMas.experience%></p>
        </section>
    </script>
</div>
<!--个人经历 e-->



<!--接手工地 s-->
<!--buildings  单个时添加该class-->
<section class="building  overflow_h" id="building_list1">
    <script type="text/template" id="building-list-template">
        <% if(buildingSite.length >0) { %>
        <section class="building_title"><span>在管工地</span></section>
        <% } %>
        <div class="in_live_lists live_list_img" >
            <% var buildingIndex = buildingSite.length; %>
            <% if(buildingSite.length == 1){ %>
            <ul id="in_live_list" class="buildings" style="padding: 0;">
                <%for(var i = 0;i<buildingIndex;i++){%>
                <% var item = buildingSite[i] %>
                <li>
                    <img class="lazy-img" src="<%=item.recphoto%>">
                    <a href="mobile-live_detail.html?live_id=<%=item.id%>" class="in_live_mask">
                        <h3><%=item.title%></h3>
                        <p><%=item.nodename%></p>
                    </a>
                </li>
                <% } %>
            </ul>
            <% }else{ %>

            <ul id="in_live_list">




                <% if(buildingIndex >6){ %>

                <% buildingIndex = 6 %>

                <% }else{ %>

                <% if(buildingIndex%2 != 0){ %>

                <% buildingIndex = buildingIndex-1 %>

                <% } %>

                <% } %>

                <%for(var i = 0;i
                <buildingIndex
                ;i++){%>
                <% var item = buildingSite[i] %>
                <li>
                    <img class="lazy-img" src="<%=item.recphoto%>">
                    <a href="mobile-live_detail.html?live_id=<%=item.id%>" class="in_live_mask">
                        <h3><%=item.title%></h3>
                        <p><%=item.nodename%></p>
                    </a>
                </li>
                <% } %>
            </ul>
            <% } %>

        </div>
        <% if(buildingSite.length > 6){ %>
        <div class="building_more">点击查看更多</div>
        <% } %>
    </script>
</section>
<!--接手工地 e-->


<!--接手工地--查看更多 s-->
<!--buildings  单个时添加该class-->
<section class="building  overflow_h" id="building_listm">
    <script type="text/template" id="building-listm-template">
        <section class="building_title"><span>在管工地</span></section>
        <div class="in_live_lists live_list_more">
            <ul id="in_live_list">
                <%for(var i = 0;i
                <buildingSite.length
                ;i++){%>
                <% var item = buildingSite[i] %>
                <li>
                    <img class="lazy-img" src="<%=item.recphoto%>">
                    <a href="mobile-live_detail.html?live_id=<%=item.id%>" class="in_live_mask">
                        <h3><%=item.title%></h3>
                        <p><%=item.nodename%></p>
                    </a>
                </li>
                <% } %>
            </ul>


        </div>
        <% if(buildingSite.length > 6){ %>
        <div class="building_more">收起</div>
        <% } %>
    </script>
</section>
<!--接手工地--查看更多 e-->


<!--专业解答 s-->
<section class="answer" id="answer">
    <script type="text/template" id="building-answer-template">
        <% if(butlerMas.question.length > 0){ %>
        <section class="undergo_title"><span>专业解答</span></section>
        <% } %>
        <ul class="answer_cont">
            <% var questionRes = butlerMas.question %>
            <% var answerRes = butlerMas.answer %>
            <%for(var i = 0;i<questionRes.length;i++){%>
            <%if(i>1)break;%>
            <% var questionCont = questionRes[i] %>
            <% var answerCont = answerRes[i] %>
            <li class="answer_list">
                <div class="answer_question clearfix">
                    <div class="answer_question_logo fl">
                        <img src="<%=questionCont.userp%>" alt="">
                    </div>
                    <div class="answer_question_text fl">
                        <span class="trig"></span>
                        <p><%=questionCont.title%></p>
                    </div>

                </div>
                <div class="answer_reply  clearfix">
                    <div class="answer_question_logo fr">
                        <img src="<%=answerCont.gjp%>" alt="">
                    </div>
                    <div class="answer_question_text fr">
                        <span class="trig"></span>
                        <p class="answer_text_test"><%=answerCont.content%></p>
                    </div>
                </div>
                <div class="answer_time  clearfix">
                    <div class="answer_time_l fl">10小时前</div>
                    <div class="answer_time_zan fr" zanid = "<%=answerCont.id%>" number="0">
                        <i class="fl"></i><span class="fl"><%=answerCont.laud%></span>
                    </div>
                </div>
            </li>
            <% } %>
        </ul>
        <% if(questionRes.length >2){ %>
        <div class="building_more">
            <a href="mobile-butler_question_list.html?id=<%=case_id%>" style="color: #999;">点击查看更多</a>
        </div>
        <% } %>
    </script>
</section>

<!--专业解答 e-->

<!--诸葛装修 s-->
<section class="zhuge">
    <a class="zhuge_jd" href="http://b.uzhuang.com"></a>
</section>
<!--诸葛装修 e-->
<section class="bottom-choose">
    <div class="bottom-btn" style="">
        <a id="collect"><i class="iconfont icon-star_one"></i><span>收藏</span></a>
        <a id="ordered_butler_link" href="javascript:;" class="apply-btn">约TA帮我监管工地</a>
    </div>
</section>
<a id="index-bottom-tel" href="tel:400-6171-666"><span id="tel-icon">&nbsp;</span></a>
</body>
</html>
<script type="text/javascript" src="http://res.wx.qq.com/open/js/jweixin-1.0.0.js"></script>
<script src="<?php echo R;?>msite/base/js/zepto.min.js"></script>
<script src="<?php echo R;?>msite/base/js/underscore-template.js"></script>
<script src="<?php echo R;?>msite/base/js/base.js"></script>
<script src="<?php echo R;?>msite/butler-details/js/butler-details.js"></script>
<script>
    //size
    ;
    (function () {
        var oRem = document.documentElement.style.fontSize = document.documentElement.clientWidth / 320 * 16 + 'px';
        window.addEventListener('resize', function () {
            var oRem = document.documentElement.style.fontSize = document.documentElement.clientWidth / 320 * 16 + 'px';
        }, false);
    })();
</script>
