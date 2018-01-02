<?php defined('IN_WZ') or exit('No direct script access allowed'); ?><!doctype html>
<html>
<head>
<meta name="viewport" content="width=device-width,minimum-scale=1.0,maximum-scale=1.0, minimal-ui"/>
<meta content="yes" name="apple-mobile-web-app-capable">
<META HTTP-EQUIV="Pragma" CONTENT="no-cache">
<META HTTP-EQUIV="Cache-Control" CONTENT="no-cache">
<META HTTP-EQUIV="Expires" CONTENT="0">
<!--iphone桌面快捷方式图标<link rel="apple-touch-icon" href="custom_icon.png">-->
<meta charset="utf-8">
<meta name="keywords" content="">
<meta name="description" content="">
<link rel="stylesheet" type="text/css" href="<?php echo R;?>msite/base/css/base.css">
<link rel="stylesheet" type="text/css" href="<?php echo R;?>msite/score/css/score.css">
<title>优装美家就是装修管家，管家式装修服务平台</title>
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
    <!-- <div class="city">
        <a href="##" class="current-city">北京<i class="iconfont icon-xiajiantou"></i></a>
    </div> -->
    <h1 class="header-title">业主评分</h1>
</header>
<section class="score_content">
    <ul class="score_contentlist" id="score_cont">

    </ul>
</section>
<script type="text/template" id="score_starlist_templete">
    <% for(var i = 0;i<starListData.length;i++){ %>
    <% var item = starListData[i] %>
    <li class="scores">
        <div class="scoreSendId">
            <input type="hidden" class="nodeid" sendname="nodeid" value="<%= item.nodeid %>">
            <input type="hidden"  sendname="orderid" value="<%= item.orderid %>">
            <input type="hidden"  sendname="housekeeper_id" value="<%= item.housekeeper_id %>">
            <input type="hidden"  sendname="company_id" value="<%= item.company_id %>">
        </div>
        <div class="scores_title"><%= item.nodename %>收服务评分</div>
        <ul class="scor_mode">
            <li class="sc_cont">
                <div class="sc_title">装修公司评分</div>
                <div class="sc_name">
                    <img src="<%= item.company_thumb %>">
                    <p><%= item.companyname %></p>
                </div>
                <div class="sc_button">
                    <ol>
                        <% if(item.nodeid == 37){ %>
                        <li class="start_button">
                            <span class="start_name">设计水平</span>
                            <div class="start_cont outcome" name="design" number="<%= item.design %>">
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
                            <div class="start_cont outcome" name="quality" number="<%= item.quality %>">
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
                            <div class="start_cont outcome" name="manner" number="<%= item.manner %>">
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
                            <div class="start_cont outcome" name="capacity" number="<%= item.capacity %>">
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
                <div class="sc_name">
                    <img src="<%= item.personalphotos %>">
                    <p><%= item.gjname %></p>
                </div>
                <div class="sc_button">
                    <ol>
                        <li class="start_button">
                            <span class="start_name">专业技能</span>
                            <div class="start_cont outcome" name="professional" number="<%= item.professional %>">
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
                            <div class="start_cont outcome" name="serve" number="<%= item.serve %>">
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
                            <div class="start_cont outcome" name="coordinate" number="<%= item.coordinate %>">
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
        </ul>
        <!-- class="outcome"-->
        <div class="textarea_par" name="content" >
            <textarea class="scor_texta" placeholder="发表您的评论"></textarea>
        </div>
        <div class="scor_subbtn">
            <input type="button" class="submit_score" value="发表评论">
        </div>
    </li>
    <% } %>
</script>
<!--<section class="scores">
    <div class="scores_title">水电工程验收服务评分</div>
    <ul class="scor_mode">
        <li class="sc_cont">
            <div class="sc_title">装修公司评分</div>
            <div class="sc_name">
                <img src="http://www.uzhuang.com/image/big_square/ae6400206o06o100o0tzvc.jpg">
                <p>北京阳光兄弟建筑装饰工程有限装饰工程有限装饰工程有限公司</p>
            </div>
            <div class="sc_button">
                <ol>
                    <li class="start_button">
                        <span class="start_name">施工质量</span>
                        <div class="start_cont" name="gs_zl">
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
                        <div class="start_cont"  name="gs_td">
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
                        <div class="start_cont"  name="gs_sx">
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
            <div class="sc_name">
                <img src="http://www.uzhuang.com/image/big_square/ae6400206o06o100o0tzvc.jpg">
                <p>北京阳光</p>
            </div>
            <div class="sc_button">
                <ol>
                    <li class="start_button">
                        <span class="start_name">专业技能</span>
                        <div class="start_cont"  name="gj_jn">
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
                        <div class="start_cont" name="gj_td">
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
                        <div class="start_cont" name="gj_nl">
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
    </ul>
    <div>
        <textarea class="scor_texta" placeholder="发表您的评论"></textarea>
    </div>
    <div class="scor_subbtn">
        <input type="button" class="submit_score" value="发表评论">
    </div>
</section>-->


</body>
</html>
<script src="<?php echo R;?>msite/base/js/zepto.min.js"></script>
<script src="<?php echo R;?>msite/base/js/underscore-template.js"></script>
<script src="<?php echo R;?>msite/base/js/base.js"></script>
<script src="<?php echo R;?>msite/base/js/size.js"></script>
<script src="<?php echo R;?>msite/score/js/score.js"></script>