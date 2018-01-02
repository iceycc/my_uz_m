<?php defined('IN_WZ') or exit('No direct script access allowed'); ?><!doctype html>
<html>
<head>
<meta name="viewport" content="width=device-width,minimum-scale=1.0,maximum-scale=1.0, minimal-ui"/>
<meta content="yes" name="apple-mobile-web-app-capable">
<!--iphone桌面快捷方式图标<link rel="apple-touch-icon" href="custom_icon.png">-->
<meta charset="utf-8">
<meta name="keywords" content="装修管家,量房设计,装修施工,材料商城,环保方案,装修服务,装修图库,建材商城,装修攻略、优装网、装修网、优装美家">
<meta name="description" content="优装美家为您提供免费专业咨询、免费量房、免费设计、免费装修保险、免费环保检测、优装网-专业装修网优选装修公司、优选建材商品、优选装修管家、优选环保服务">
<title>找靠谱装修公司，上优装美家</title>
<link rel="stylesheet" type="text/css" href="<?php echo R;?>msite/base/css/base.css">
<link href="<?php echo R;?>msite/activity/css/activity.css" rel="stylesheet" type="text/css">
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
<!--铂金分析的监测代码 start-->
<div style="display: none;">
    <script type="text/javascript">
        window._pt_lt = new Date().getTime();
        window._pt_sp_2 = [];
        _pt_sp_2.push('setAccount,47507b56');
        var _protocol = (("https:" == document.location.protocol) ? " https://" : " http://");
        (function() {
            var atag = document.createElement('script'); atag.type = 'text/javascript'; atag.async = true;
            atag.src = _protocol + 'js.ptengine.cn/47507b56.js';
            var s = document.getElementsByTagName('script')[0];
            s.parentNode.insertBefore(atag, s);
        })();
    </script>
</div>
<!--铂金分析的监测代码 end-->
<div id='share_logo' style='margin:0 auto;display:none;'>
  <img src="<?php echo R;?>msite/base/img/share_logo.jpg"/> 
</div>
<header>
    <a id="logo" href="mobile-index.html" target="_self" title="优装美家"><i class="iconfont icon-jingyu"></i></a>
    <!-- <div class="city">
        <a href="##" class="current-city">北京<i class="iconfont icon-xiajiantou"></i></a>
    </div> -->
    <h1 class="header-title">优装美家</h1>
    
</header>

<div class="container">
<section>
    <ul id="content-top">
        <!-- <li class="content-li">
            <img src="<?php echo R;?>msite/activity/img/case1.png" alt="效果图">
        </li>
        <li class="content-li">
            <img src="<?php echo R;?>msite/activity/img/case2.png" alt="效果图">
        </li>
        <li class="content-li">
            <img src="<?php echo R;?>msite/activity/img/case3.png" alt="效果图">
        </li> -->
    </ul>
</section>
<section id="swiper-container">
    <ul class="swiper-wrapper">
    <script type="text/template" id="swiper-box-data">
        <% for(var i=0; i<head.length; i++){ %>
            <% var item = head[i] %>
            <li class="swiper-slide">
                <% if(item.type == "vim") { %>
                    <div class="temp-video"><div id="youkuplayer" class="video-box"><iframe width=100% height=100% src="<%= item.urlsx %>" frameborder=0 allowfullscreen></iframe></div></div>
                    <div class="go-top"><i></i></div>
                <% } else { %>
                    <% if(item.urlsx) { %>
                        <a href=<%= item.urlsx %>><i class="pic-bg" style="background: url(<%= item.url %>) no-repeat 0 0/cover;"></i></a>
                        <div class="go-top"><i></i></div>
                    <% } else { %>
                        <i class="pic-bg" style="background: url(<%= item.url %>) no-repeat 0 0/cover;"></i>
                        <div class="go-top"><i></i></div>
                    <% } %>
                <% } %>
            </li>
        <% } %>
        <% if(isno == 1) { %>
            <li class="swiper-slide">
                <div id="apply-form">
                    <form name="myform" method="post" id="myform" >
                        <div id="name-box">
                            <input id="user-name" name="title" class="apply-input" type="text" maxlength="10" placeholder="您的姓名">
                        </div>
                        <div id="phone-box">
                            <input id="user-pwd" name="telephone" class="apply-input" type="tel" maxlength="11" placeholder="您的手机">
                        </div>
                        <div id="area-choose" class="user-info fix">
                            <div id="province" class="fl">
                            <select  name="select-01" id="select-01" class="apply-select">
                                <option value="0">省/市</option>
                            </select>
                            </div>
                            <div id="city" class="fr">
                                <select  name="select-02" id="select-02" class="apply-select">
                                    <option value="0" selected="">市/地区</option>
                                </select>
                            </div>
                        </div>
                        <input id="applyBtn" class="orange-btn" type="submit" value="一秒报名">
                        <input id="source" name="source" type="hidden" size="30" value="活动报名页">
                    </form>
                    <p id="apply-total" class="total">已有<em class="number" id="userTotal">0</em>人参加</p>
                </div>
            </li>
        <% } %>
    </script>
    </ul>
    <div class="swiper-pagination"></div>
</section>
<section class="normal-form">
    <div id="apply-form">
        <form name="myform" method="post" id="myform" >
            <div id="name-box">
                <input id="user-name" name="title" class="apply-input" type="text" maxlength="10" placeholder="您的姓名">
            </div>
            <div id="phone-box">
                <input id="user-pwd" name="telephone" class="apply-input" type="tel" maxlength="11" placeholder="您的手机">
            </div>
            <div id="area-choose" class="user-info fix">
                <div id="province" class="fl">
                <select  name="select-01" id="select-01" class="apply-select">
                    <option value="0">省/市</option>
                </select>
                </div>
                <div id="city" class="fr">
                    <select  name="select-02" id="select-02" class="apply-select">
                        <option value="0" selected="">市/地区</option>
                    </select>
                </div>
            </div>
            <input id="applyBtn" class="orange-btn" type="submit" value="一秒报名">
            <input id="source" name="source" type="hidden" size="30" value="活动报名页">
        </form>
        <p id="apply-total" class="total">已有<em class="number" id="userTotal">0</em>人参加</p>
    </div>
</section>
<section>
    <ul id="content-bottom">
        <!-- <li class="content-li">
            <img src="<?php echo R;?>msite/activity/img/case1.png" alt="效果图">
        </li>
        <li class="content-li">
            <img src="<?php echo R;?>msite/activity/img/case2.png" alt="效果图">
        </li>
        <li class="content-li">
            <img src="<?php echo R;?>msite/activity/img/case3.png" alt="效果图">
        </li> -->
    </ul>
</section>
</div>
<!--footer_menu start-->
<section class="footer_menu_bs">
    <ul class="left_menu_bs">
        <li class="footer_btn_bs">
            <i class="iconfont icon-home"></i>
            <div>首页</div>
            <a href="http://m.uzhuang.com/"></a>
        </li>
        <li class="footer_btn_bs">
            <i class="iconfont icon-tuku"></i>
            <div>精品案例</div>
            <a href="mobile-cases.html"></a>
        </li>
    </ul>
    <ul class="right_menu_bs">
        <li class="footer_btn_bs">
            <i class="iconfont icon-shejishi"></i>
            <div>我的</div>
            <a href="mobile-user_home.html"></a>
        </li>
        <li class="footer_btn_bs">
            <i class="iconfont icon-gongdi"></i>
            <div>工地直播</div>
            <a href="mobile-building_list.html"></a>
        </li>
    </ul>
</section>
<!--footer_menu end-->
<div id="errorCue" class="hideError"><span id="errorMsg">您输入的姓名或电话有错误</span></div>
<div class="style-none">
    <a id="footer-bottom-tel" href="tel:400-6171-666">咨询电话：400-6171-666</a>
    <button id="free-btn">一秒报名</button>
</div>
<footer id="footer">
    <ul class="platforms">
        <li class="active"><a href="mobile-index.html"><cite class="iconfont icon-shouji"></cite>触屏版</a></li>
        <li class="vline"></li>
        <li><a href="http://www.uzhuang.com/index.php?from=wap"><cite class="iconfont icon-diannao"></cite>电脑版</a></li>
        <li class="vline"></li>
        <li><a href="mobile-about_us.html"><cite class="iconfont icon-guanyuwomen"></cite>关于我们</a></li>
    </ul>
    <p class="company-name">北京优装网信息科技有限公司<br>京ICP备15022586号-1</p>
</footer>
<script type="text/template" id="top-activity-data">
    <% for(var i=0; i<head.length; i++){ %>
        <% var item = head[i] %>
        <li class="content-li">
            <% if(item.type == "vim") { %>
                <div class="temp-video" style="background: url(<%= item.url %>) no-repeat 0 0/cover;"><div id="youkuplayer" class="video-box"><iframe width=100% height=100% src="<%= item.urlsx %>" frameborder=0 allowfullscreen></iframe></div></div>
            <% } else { %>
                <% if(item.urlsx) { %>
                    <a href=<%= item.urlsx %>><img class="lazy-img" src=<%= item.url %>></a>
                <% } else { %>
                    <img class="lazy-img" src=<%= item.url %>>
                <% } %>
            <% } %>
        </li>
    <% } %>
</script>
<script type="text/template" id="bottom-activity-data">
    <% for(var i=0; i<troops.length; i++){ %>
        <% var item = troops[i] %>
        <li class="content-li">
            <% if(item.type == "vim") { %>
                <div class="temp-video" style="background: url(<%= item.url %>) no-repeat 0 0/cover;"><div id="youkuplayer" class="video-box"><iframe width=100% height=100% src="<%= item.urlsh %>" frameborder=0 allowfullscreen></iframe></div></div>
            <% } else { %>
                <% if(item.urlsh) { %>
                    <a href=<%= item.urlsh %>><img class="lazy-img" src=<%= item.url %>></a>
                <% } else { %>
                    <img class="lazy-img" src=<%= item.url %>>
                <% } %>
            <% } %>
        </li>
    <% } %>
</script>
<script type="text/template" id="province-data">
    <% if(city == 1) { %>
        <option value="0">城市</option>
    <% } %>
    <% if(city == 2) { %>
        <option value="0">省/市</option>
    <% } %>
    <% for(var key in city1){ %>
        <option value=<%= city1[key].lid%>><%= city1[key].name%></option>
    <% } %>
</script>
<script type="text/template" id="city-data">
    <option value="0">市/地区</option>
    <% for(var key in city1){ %>
        <option value=<%= city1[key].lid%>><%= city1[key].name%></option>
    <% } %>
</script>
<script type="text/javascript" src="http://res.wx.qq.com/open/js/jweixin-1.0.0.js"></script>
<script type="text/javascript" src="http://player.youku.com/jsapi"></script>
<script type="text/javascript" src="<?php echo R;?>msite/base/js/zepto.min.js"></script>
<script type="text/javascript" src="<?php echo R;?>msite/base/js/underscore.min.js"></script>
<script src="<?php echo R;?>msite/base/js/swiper.jquery.min.js"></script>
<script type="text/javascript" src="<?php echo R;?>msite/base/js/base.js"></script>
<script type="text/javascript" src="<?php echo R;?>msite/activity/js/activity.js"></script>
</body>
</html>