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
<link href="<?php echo R;?>msite/base/css/swiper.min.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" type="text/css" href="<?php echo R;?>msite/base/css/base.css">
<link href="<?php echo R;?>msite/activity/css/activity_new.css" rel="stylesheet" type="text/css">
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
    <a id="logo" href="mobile-index.html" target="_self" title="优装美家"><i class="iconfont icon-jingyu"></i></a>
    <!-- <div class="city">
        <a href="##" class="current-city">北京<i class="iconfont icon-xiajiantou"></i></a>
    </div> -->
    <h1 class="header-title">优装美家</h1>

</header>
<div class="container">
<section class="common-container">
    <ul id="common-content">
        <!-- <li class="content-li">
            <img src="<?php echo R;?>msite/activity/img/case1.png" alt="效果图">
        </li>
        <li class="content-li">
            <img src="<?php echo R;?>msite/activity/img/case2.png" alt="效果图">
        </li>
        <li class="content-li">
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
        </li> -->
    </ul>
</section>
<section id="swiper-container">
    <ul class="swiper-wrapper">
    </ul>
    <div class="swiper-pagination"></div>

    <div class="amount_house_mask_bs"></div>
    <div class="in_info_bs">
        <span class="close_bs"></span>
        <p class="in_title_name_bs">现在预约，可免费获得装修全程管家式服务</p>
        <div id="apply-form">
                <form name="myform" method="post" id="alert-myform" class="myforms">
                <div id="a-name-box" class="cls-name">
                    <input id="a-user-name" name="title" class="apply-input uname" type="text" maxlength="10" placeholder="您的姓名">
                </div>
                <div id="a-phone-box" class="cls-phone">
                    <input id="a-user-pwd" name="telephone" class="apply-input phone" type="tel" maxlength="11" placeholder="您的手机">
                </div>
                <div id="a-address" class="user-info fix">
                    <!-- <div id="a-province">
                        <select name="select-01" id="a-select-01"><option value="0">选择城市</option></select>
                    </div> -->
                </div>
                <p id="apply-total">已有<em class="number" id="uTotal">7820</em>人参加</p>
                <input id="applyBtn" type="submit" value="我要报名">
                <input id="source" type="hidden" value="M站-活动报名页">
                <input type="hidden" class="city_id" name="city_id" value = "<%= city_id %>">
                <input type="hidden" class="comp_id" name="comp_id" value = "<%= comp_id %>">
                <input type="hidden" class="act_id"  name="act_id"  value = "<%= act_id %>">

            </form>
            <p class="sing_agreement"  style="margin-top: 0.5rem;">使用优装美家服务即代表您已同意<a href="mobile-sing_agreement.html">用户协议</a></p>
            <!-- <div id="errorCue" class="hideError"><span id="errorMsg">您输入的姓名或电话有错误</span></div> -->
            <p id="apply-tip" class="tip">我们承诺：优装美家提供装修全程管家式服务，为了您的 利益和我们的口碑，您的隐私将被严格保密。</p>
        </div>
    </div>

    <div class="choose-box"><p>您还在犹豫！现在报名就先送您免费量房！</p><span class="real-close">取消报名</span><span class="real-apply">返回报名</span></div>
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
<!-- 添加悬浮客服 -->
<!--<a target="_blank"  href="javascript:void(0)" id="udesk-feedback-tab" class="" style="" onclick="openJesongPlatChat(1);"><img src="<?php echo R;?>msite/base/img/service_tel.png" alt="" /></a>-->
<!-- 添加悬浮客服 -->
<div id="errorCue" class="hideError"><span id="errorMsg">您输入的姓名或电话有错误</span></div>
<div class="style-none">
    <a id="footer-bottom-tel" href="tel:400-6171-666">咨询电话：400-6171-666</a>
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
<script type="text/template" id="common-data">

    <% for(var key in module){ %>
        <% var item = module[key] %>
        <li class="content-li">
            <% if(item.type == "vim") { %>
                <div class="temp-video" style="background: url(<%= item.picimg %>) no-repeat 0 0/cover;"><div id="youkuplayer" class="video-box"><iframe width=100% height=100% src="<%= item.picurl %>" frameborder=0 allowfullscreen></iframe></div></div>
            <% } %>
            <% if(item.type == "shuffling"){ %>
                <div id="box<%= key %>" class="swiper-box">
                    <div class="swiper-wrapper">
                        <% for(var key in item.shuffling){ %>
                            <div class="swiper-slide">
                            <% if(item.shuffling[key].shufflingurl){ %>
                                <img class="swiper-img"  src="<%= item.shuffling[key].shufflingpic %>">
                                <a class="swiper-link" href="<%= item.shuffling[key].shufflingurl %>"></a>
                            <% } else { %>
                                <img class="swiper-img jump_picimg" src="<%= item.shuffling[key].shufflingpic %>"
                                    <%if(item.jump != ''){%>
                                        jump=<%= item.jump %>
                                    <% } %>
                                >
                            <% } %>
                            </div>
                        <% } %>
                    </div>
                    <div class="swiper-pagination"></div>
                </div>
            <% } %>
            <% if(item.type == "pic"){ %>
                <% if(item.picurl) { %>
                    <a href="<%= item.picurl %>">
                        <img class="lazy-img" src="<%= item.picimg %>">
                    </a>
                <% } else { %>
                    <img class="lazy-img jump_picimg" src="<%= item.picimg %>"
                        <%if(item.jump != ''){%>
                            jump=<%= item.jump %>
                        <% } %>
                    >
                <% } %>
            <% } %>
            <% if(applybox == 1){ %>
                <% if(item.type == "bidding"){ %>
                    <div id="apply-form<%= key %>" class="cls-applyform" style="background: url(<%= item.background %>) no-repeat 0 0/cover;">
                        <form name="myform" method="post" id="myform<%= key %>" class="myforms">
                            <div id="name-box<%= key %>" class="cls-name">
                                <input id="user-name<%= key %>" name="title" class="apply-input uname" type="text" maxlength="10" placeholder="您的姓名">
                            </div>
                            <div id="phone-box<%= key %>" class="cls-phone">
                                <input id="user-pwd<%= key %>" name="telephone" class="apply-input phone" type="tel" maxlength="11" placeholder="您的手机">
                            </div>
                            <% if(are > 2){ %>
                            <div id="area-choose" class="user-info fix">
                                <div id="province<%= applybox %>" class="cls-province">
                                    <select  name="select-01" id="select-01<%= applybox %>" class="open-city pro-select">
                                        <% choose_province = are; %>
                                        <option value=<%= are %>> <%= default_s %> </option>
                                    </select>
                                </div>
                            </div>
                            <% } %>
                            <% if(are == 1){ %>
                                <div id="area-choose" class="user-info fix">
                                    <div id="province<%= key %>" class="cls-province">
                                    <select  name="select-01" id="select-01<%= key %>" class="open-city pro-select">
                                        <option value="0">省/市</option>
                                        <% for(var key in city){ %>
                                            <option value=<%= city[key].lid%>><%= city[key].name%></option>
                                        <% } %>
                                    </select>
                                    </div>
                                </div>
                            <% } %>
                            <% if(are == 2){ %>
                                <div id="area-choose" class="user-info fix">
                                    <div id="province<%= key %>" class="fl cls-province">
                                    <select  name="select-01" id="select-01<%= key %>" class="apply-select pro-select">
                                        <option value="0">省/市</option>
                                        <% for(var ckey in city){ %>
                                            <option value=<%= city[ckey].lid%>><%= city[ckey].name%></option>
                                        <% } %>
                                    </select>
                                    </div>
                                    <div id="city<%= key %>" class="fr cls-city">
                                        <select  name="select-02" id="select-02<%= key %>" class="apply-select city-select">
                                            <option value="0" selected="">市/地区</option>
                                        </select>
                                    </div>
                                </div>
                            <% } %>
                            <input id="applyBtn<%= key %>" class="orange-btn" type="submit" value="<%= item.submitcopy %>" style="background-color: <%= item.buttoncolor %>; color: <%= item.buttoncopycolor %>">
                            <input id="source<%= key %>" class="fromsou" name="source" type="hidden" size="30" value="活动报名页">

                            <input type="hidden" class="city_id" name="city_id" value = "<%= city_id %>">
                            <input type="hidden" class="comp_id" name="comp_id" value = "<%= comp_id %>">
                            <input type="hidden" class="act_id"  name="act_id"  value = "<%= act_id %>">
                        </form>
                        <p id="apply-total<%= key %>" class="total" style="color: <%= item.cuewords %>">已有<em class="number" id="userTotal" style="color: <%= item.numbercolor %>"><%= item.tosignup %></em>人参加</p>
                        <p class="sing_agreement"  style="margin-top: 0.5rem;">使用优装美家服务即代表您已同意<a href="mobile-sing_agreement.html">用户协议</a></p>
                    </div>
                <% } %>
            <% } %>
        </li>
    <% } %>
</script>
<script type="text/template" id="h5-data">
    <% for(var key in module){ %>
        <% var item = module[key] %>
        <% if(item.type == "vim") { %>
            <li class="swiper-slide" style="background: url(<%= item.picimg %>) no-repeat 0 0/cover;">
                <div class="temp-video"><div id="youkuplayer" class="video-box"><iframe width=100% height=100% src="<%= item.picurl %>" frameborder=0 allowfullscreen></iframe></div></div>
                <% if(item.location && item.location == 1) { %>
                    <span class="cls-apply" style="top: 7rem; color: <%= item.copycolor %>;background-color: <%= item.color %>;"><%= item.copy %></span>
                <% } %>
                <% if(item.location && item.location == 2) { %>
                    <span class="cls-apply" style="color: <%= item.copycolor %>;background-color: <%= item.color %>;"><%= item.copy %></span>
                <% } %>
                <div class="go-top"><i></i></div>
            </li>
        <% } %>
        <% if(item.type == "pic"){ %>
            <li class="swiper-slide">
            <% if(item.picurl) { %>
                <a href=<%= item.picurl %>><i class="pic-bg" style="background: url(<%= item.picimg %>) no-repeat 0 0/cover;"></i></a>
                <% if(item.location && item.location == 1) { %>
                    <span class="cls-apply" style="top: 7rem; color: <%= item.copycolor %>;background-color: <%= item.color %>;"><%= item.copy %></span>
                <% } %>
                <% if(item.location && item.location == 2) { %>
                    <span class="cls-apply" style="color: <%= item.copycolor %>;background-color: <%= item.color %>;"><%= item.copy %></span>
                <% } %>
                <div class="go-top"><i></i></div>
            <% } else { %>
                <i class="pic-bg jump_picimgh5" style="background: url(<%= item.picimg %>) no-repeat 0 0/cover;"
                    <%if(item.jump != ''){%>
                        jump=<%= item.jump %>
                    <% } %>
                ></i>
                <% if(item.location && item.location == 1) { %>
                    <span class="cls-apply" style="top: 7rem; color: <%= item.copycolor %>;background-color: <%= item.color %>;"><%= item.copy %></span>
                <% } %>
                <% if(item.location && item.location == 2) { %>
                    <span class="cls-apply" style="color: <%= item.copycolor %>;background-color: <%= item.color %>;"><%= item.copy %></span>
                <% } %>
                <div class="go-top"><i></i></div>
            <% } %>
            </li>
        <% } %>
    <% } %>
    <% if(applybox == 1){ %>
        <li class="swiper-slide" style="background: url(<%= background %>) no-repeat 0 0/cover;">
            <div id="apply-form<%= applybox %>" class="cls-applyform">
                <form name="myform" method="post" id="myform<%= applybox %>" class="myforms" >
                    <div id="name-box<%= applybox %>" class="cls-name">
                        <input id="user-name<%= applybox %>" name="title" class="apply-input uname" type="text" maxlength="10" placeholder="您的姓名">
                    </div>
                    <div id="phone-box<%= applybox %>" class="cls-phone">
                        <input id="user-pwd<%= applybox %>" name="telephone" class="apply-input phone" type="tel" maxlength="11" placeholder="您的手机">
                    </div>
                    <% if(are > 2){ %>
                    <div id="area-choose" class="user-info fix">
                        <div id="province<%= applybox %>" class="cls-province">
                            <select  name="select-01" id="select-01<%= applybox %>" class="open-city pro-select">
                                <% choose_province = are; %>
                                <option value=<%= are %>> <%= default_s %> </option>
                            </select>
                        </div>
                    </div>
                    <% } %>

                    <% if(are == 1){ %>
                        <div id="area-choose" class="user-info fix">
                            <div id="province<%= applybox %>" class="cls-province">
                            <select  name="select-01" id="select-01<%= applybox %>" class="open-city pro-select">
                                <option value="0">省/市</option>
                                <% for(var key in city){ %>
                                    <option value=<%= city[key].lid%>><%= city[key].name%></option>
                                <% } %>
                            </select>
                            </div>
                        </div>
                    <% } %>
                    <% if(are == 2){ %>
                        <div id="area-choose" class="user-info fix">
                            <div id="province<%= applybox %>" class="fl cls-province">
                            <select  name="select-01" id="select-01<%= applybox %>" class="apply-select pro-select">
                                <option value="0">省/市</option>
                                <% for(var key in city){ %>
                                    <option value=<%= city[key].lid%>><%= city[key].name%></option>
                                <% } %>
                            </select>
                            </div>
                            <div id="city<%= applybox %>" class="fr cls-city">
                                <select  name="select-02" id="select-02<%= applybox %>" class="apply-select city-select">
                                    <option value="0" selected="">市/地区</option>
                                </select>
                            </div>
                        </div>
                    <% } %>
                    <input id="applyBtn<%= applybox %>" class="orange-btn" type="submit" value="<%= submitcopy %>" style="background-color: <%= buttoncolor %>; color: <%= buttoncopycolor %>">
                    <input id="source<%= applybox %>" class="fromsou" name="source" type="hidden" size="30" value="M站-活动报名页">
                    <input type="hidden" class="city_id" name="city_id" value = "<%= city_id %>">
                    <input type="hidden" class="comp_id" name="comp_id" value = "<%= comp_id %>">
                    <input type="hidden" class="act_id"  name="act_id"  value = "<%= act_id %>">

                </form>
                <% if(tosignup > 0){ %>
                <p id="apply-total<%= applybox %>" class="total" style="color: <%= cuewords %>">已有<em class="number" id="userTotal" style="color: <%= numbercolor %>"><%= tosignup %></em>人参加</p>
                <% } %>
                <p class="sing_agreement"  style="margin-top: 0.5rem;">使用优装美家服务即代表您已同意<a href="mobile-sing_agreement.html">用户协议</a></p>
            </div>
            <div class="go-top"><i></i></div>
        </li>
    <% } %>
</script>
<script type="text/template" id="a-address-data">
    <% if(applybox == 1){ %>
        <% if(are > 2){ %>
        <div id="area-choose" class="user-info fix">
            <div id="province<%= applybox %>" class="cls-province">
                <select  name="select-01" id="select-01<%= applybox %>" class="open-city pro-select">
                    <% choose_province = are; %>
                    <option value=<%= are %>> <%= default_s %> </option>
                </select>
            </div>
        </div>
        <% } %>

        <% if(are == 1){ %>
            <div class="user-info fix">
                <div id="a-province" class="cls-province">
                <select  name="select-01" id="select-01" class="open-city pro-select">
                    <option value="0">省/市</option>
                    <% for(var key in city){ %>
                        <option value=<%= city[key].lid%>><%= city[key].name%></option>
                    <% } %>
                </select>
                </div>
            </div>
        <% } %>
        <% if(are == 2){ %>
            <div class="alert-area" class="user-info fix">
                <div id="a-province" class="fl cls-province">
                <select  name="select-01" id="select-01" class="apply-select pro-select">
                    <option value="0">省/市</option>
                    <% for(var key in city){ %>
                        <option value=<%= city[key].lid%>><%= city[key].name%></option>
                    <% } %>
                </select>
                </div>
                <div id="a-city" class="fr cls-city">
                    <select  name="select-02" id="select-02" class="apply-select city-select">
                        <option value="0" selected="">市/地区</option>
                    </select>
                </div>
            </div>
        <% } %>
    <% } %>
</script>
<script type="text/template" id="city-data">
    <option value="0">市/地区</option>
    <% if(applybox == 1){ %>
        <% for(var key in arr){ %>
            <option value=<%= arr[key].lid%>><%= arr[key].name%></option>
        <% } %>
    <% } %>
</script>
<script type="text/javascript" src="http://res.wx.qq.com/open/js/jweixin-1.0.0.js"></script>
<script type="text/javascript" src="http://player.youku.com/jsapi"></script>
<script type="text/javascript" src="<?php echo R;?>msite/base/js/zepto.min.js"></script>
<script type="text/javascript" src="<?php echo R;?>msite/base/js/underscore.min.js"></script>
<script src="<?php echo R;?>msite/base/js/swiper.jquery.min.js"></script>
<script type="text/javascript" src="<?php echo R;?>msite/base/js/base.js"></script>
<script type="text/javascript" src="<?php echo R;?>msite/base/js/size.js"></script>
<script type="text/javascript" src="<?php echo R;?>msite/activity/js/activity_new.js"></script>

<!--<script type="text/javascript">-->
    <!--function openJesongPlatChat(cid,gid,fid){-->
        <!--var url=null;-->
        <!--if(cid==null){-->
            <!--alert("必须传入公司id");-->
            <!--return false;-->
        <!--}else if(cid!=null&&gid==null&&fid==null){-->
             <!--url="http://service.uzhuang.com/live/chat.dll?c="+cid+"";-->
        <!--}else if(fid==null&&gid!=null){-->
             <!--url="http://service.uzhuang.com/live/chat.dll?c=1&g="+gid+"";-->
        <!--}else  {-->
            <!--url="http://service.uzhuang.com/live/chat.dll?c=1&g="+gid+"&f="+fid+"";-->
        <!--}-->
        <!--window.open(url);-->
    <!--}-->
<!--</script>-->
<!-- 铂金分析监测代码 -->
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
</body>
</html>