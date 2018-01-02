<?php defined('IN_WZ') or exit('No direct script access allowed'); ?><!doctype html>
<html>
<head>
<meta name="viewport" content="width=device-width,minimum-scale=1.0,maximum-scale=1.0, minimal-ui"/>
<meta content="yes" name="apple-mobile-web-app-capable">
<!--iphone桌面快捷方式图标<link rel="apple-touch-icon" href="custom_icon.png">-->
<meta charset="utf-8">
<meta property="qc:admins" content="50304154552051676375" />
<meta name="keywords" content="优装美家，北京装修，装修公司，装修服务，装修管家 装修平台，装修图库，家居建材，建材商城，装修攻略，优装网，装修网，金牌管家，装修监理，全屋装修，局部装修，婚房装修，儿童房装修，白领装修，绿色装修，甲醛检测，别墅装修，四合院装修，复式装修，农家院装修，loft装修，酒店装修，办公室装修，装修效果图，看家装美图，装修全攻略，买家具建材，环保方案，装饰公司 全包套餐 半包套餐">
<meta name="description" content="优装美家就是装修管家，管家式装修服务平台，为您提供专业咨询、量房、设计、装修贷款、环保治理等优质服务，装修就选优装美家">
<title>优装美家就是装修管家，管家式装修服务平台</title>
<link href="./res/msite/base/css/swiper.min.css" rel="stylesheet" type="text/css">
<link href="./res/msite/base/css/base.css" rel="stylesheet" type="text/css">
<link href="./res/msite/index/css/post_form.css" rel="stylesheet" type="text/css">
<link href="./res/msite/index/css/index.css" rel="stylesheet" type="text/css">
<link href="./res/msite/index/css/index_add.css" rel="stylesheet" type="text/css">
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
      <img src="./res/msite/base/img/share_logo.jpg"/>
    </div>

    <header>
        <a id="logo" href="mobile-index.html" target="_self" title="优装美家"><i class="iconfont icon-jingyu"></i></a>
        <a id="local" target="#"><span id="current-city"></span><span id="local-arrow"></span></a>
       <!-- <h1 class="header-title">优装美家</h1>-->
       <span class="in_title_name iconfont icon-logo"></span>
    </header>
    <!--Location Start-->
    <section id="location">
    	<h2>选择城市<a id="close-citys" class="icon-close iconfont" href="#"></a></h2>
        <div id="local-content">
        	<p id="lock-city">定位城市</p>
            <p id="your-city"><i class="iconfont icon-location"></i><span id="local-city"></span><span id="local-state"></span></p>
            <p id="other-city">已开城市</p>
            <ul id="choose-city">
                <script type="text/template" id="index-located-template">
				<% for(var key in located){ %>
				<% var item = located[key] %>
				<% var current_class="";%>
				<% if(item.cityid==current_cityid){ %>
				<%	 current_class="current"; %>
				<% } %>
            	<li city-id=<%=item.cityid+"  class="+current_class%>><%=item.city%></li>
				<% } %>
				</script>
            </ul>
            <p id="city-tip">更多城市敬请期待！</p>
        </div>
    </section>
    <!--Location End-->
    <!--Banner Start-->
    <section id="index-banner">
    	<ul id="banner-box" class="swiper-wrapper">
        <script type="text/template" id="index-banner-template">
		<% for(var i=0; i<banners_data.length; i++){ %>
            <% var item = banners_data[i] %>
        	<li class="swiper-slide">
            	<img class="banner-img" src=<%=item.carousel%>>
				<a class="banner-link" href=<%=item.address%>></a>
            </li>
			<% } %>
		</script>
        </ul>
        <div class="swiper-pagination"></div>
    </section>
	<!--Location end-->

	<!--nav_list start-->
   	<section class="link-list">
        <ul>
            <li><a href="/mobile-classroom.html"><i class="iconfont icon-ww"></i><p>学装修</p></a></li>
            <li><a id="find-company" href="/mobile-meal_list.html"><i class="iconfont icon-zhaogongsi"></i><p>找装修</p></a></li>
            <li><a href="/mobile-red_list.html"><i class="iconfont icon-hongbaoshu"></i><p>红宝书</p></a></li>
            <li><a href="/mobile-good_day.html"><i class="iconfont icon-fengshui"></i><p>测吉日</p></a></li>
            <li><a href="/mobile-calculator.html"><i class="iconfont icon-jisuanqi"></i><p>计算器</p></a></li>
        </ul>
    </section>
	<!--nav_list end-->

	<!-- what manager S -->
	<section class="what-manager">
		<a href="http://d.eqxiu.com/s/pdUd8R3X"><img src="./res/msite/index/img/what_manager.jpg" alt="" /></a>
	</section>
	<!-- what manager E -->

	<!--set meal start-->
	<section class="set_meal" id="meal-content">
		<script type="text/template" id="meal-list-template">
			<a class="cont_title"  onclick="_hmt.push(['_trackEvent', 'nav', 'click'])" href="mobile-meal_list.html">
				<div>
					<h2 class="cont_title_name">精选套餐</h2>
					<span>更多></span>
				</div>
			</a>
			<div class="meal_cont">
				<ul class="clearfix">
					<% for(var i = 0;i<data.length;i++){ %>
					<% var item = data[i]; %>
					<li class="fl meal_list">
						<a class="meal_list_link" href="mobile-meal_detail.html?id=<%= data[i].id %>"></a>
						<% if(item.m_package_photos){ %>
						<div class="meal_img">
							<img src="<%= item.m_package_photos%>">
						</div>
						<% } %>

						<div class="meal_text">
							<% if(item.remark){ %>
							<h2><%= item.remark %></h2>
							<% } %>

							<div class="meal_price">
								<% if(item.price){ %>
								<div class="meal_price_num ">¥ <%= item.price %> </div>
								<% } %>

								<% if(item.product_type.name){ %>
								<div class="meal_price_state"><%= item.product_type.name %></div>
								<% } %>
							</div>
						</div>
					</li>
					<% } %>
					<!--<li class="fl meal_list">
						<a class="meal_list_link" href="javascript:;"></a>
						<div class="meal_img">
							<img src="./res/msite/index/img/what_manager.jpg">
						</div>

						<div class="meal_text">
							<h2>臻挚环保-绿色家装健康生活</h2>
							<div class="meal_price">
								<div class="meal_price_num ">¥ <span>599</span> 元/m2</div>
								<div class="meal_price_state">拎包入住</div>
							</div>
						</div>
					</li>-->
				</ul>
			</div>
		</script>
	</section>
	<!--set meal end-->

	<!--case Start-->
    <section id="active">
        <a class="cont_title" id="more-cases" onclick="_hmt.push(['_trackEvent', 'nav', 'click'])" href="mobile-cases.html">
        	<div>
        		<h2 class="cont_title_name">装修案例</h2>
        		<span>更多></span>
        	</div>
        </a>
    	<ul id="active-list">
        	<script type="text/template" id="index-active-template">
			<% for(var i=0; i<BoutiqueCase_data.length; i++){ %>
			<% if(i>2){break;} %>
            <% var item = BoutiqueCase_data[i] %>
			<li>
				<img class="active-img" src=<%=item.cover%>>
				<a class="active-link" href=<%=item.address%>></a>
			</li>
			<% } %>
			</script>
        </ul>
    </section>
    <!--case End-->

    <!--Live start-->
    <section class="in_live">
        <a class="cont_title" onclick="_hmt.push(['_trackEvent', 'a', 'click'])" href="mobile-building_list.html">
        	<div>
        		<h2 class="cont_title_name">工地直播</h2>
        		<span>更多></span>
        	</div>
        </a>
    	<div class="in_live_list">
    		<ul id="in_live_list">
    			<script type="text/template" id="in_live_list_template">
					<% for(var i=0; i<live_data.length; i++){ %>
		            <% var item = live_data[i] %>
					<li>
						<% if(item.sitephoto){%>
							<img src="<%=item.sitephoto%>"/>
						<%  }else{%>
							<% if(item.recphoto == 1){%>
								<img style="width: 100%;" src="./res/msite/index/img/cover.jpg"/>
							<% }else{%>
								<img src="<%=item.recphoto%>"/>
							<% }%>
						<% } %>
	    				<a href="mobile-live_detail.html?live_id=<%=item.orderid%>" class="in_live_mask">
	    					<h3><%=item.logname%></h3>
	    					<p><%=item.nodename%></p>
	    				</a>
	    			</li>
					<% } %>
				</script>
    		</ul>
    	</div>
    </section>
    <!--Live end-->

    <!--company start-->
    <section class="in_company">
        <a id="more-companys" onclick="_hmt.push(['_trackEvent', 'a', 'click'])" href="mobile-company_list.html">
    		<div class="cont_title">
        		<h2 class="cont_title_name">口碑公司</h2>
        		<span>更多></span>
        	</div>
        </a>
    	<ul class="in_company_list" id="in_company_list">
    		<script type="text/template" id="in_company_data">
				<% for(var i=0; i<companys_data.length; i++){ %>
				<% if(i>7){break;} %>
	            <% var item = companys_data[i] %>
				<li>
	    			<a href="mobile-company_detail.html?company_id=<%=item.id%>">
	    				<img src="<%=item.companylogo%>"/>
	    			</a>
	    		</li>
				<% } %>
			</script>
    	</ul>
	</section>
    <!--company end-->

    <!--footer_menu start-->
    <section class="footer_menu_bs">
    	<ul class="left_menu_bs">
    		<li class="footer_btn_bs">
    			<i class="iconfont icon-home"></i>
    			<div class="in_menu_text">首页</div>
    			<a href="mobile-index.html"></a> 
    		</li>
    		<li class="footer_btn_bs">
    			<i class="iconfont icon-tuku"></i>
    			<div class="in_menu_text">精品案例</div>
    			<a href="mobile-cases.html"></a>
    		</li>
    	</ul>
    	<ul class="right_menu_bs">
    		<li class="footer_btn_bs">
    			<i class="iconfont icon-shejishi"></i>
    			<div class="in_menu_text">我的</div>
    			<a href="mobile-user_home.html"></a>
    		</li>
    		<li class="footer_btn_bs">
    			<i class="in_footer_menu_gd iconfont icon-gongdi"></i>
    			<div class="in_menu_text">工地直播</div>
    			<a href="mobile-building_list.html"></a>
    		</li>
    	</ul>
    	<div  onclick="_hmt.push(['_trackEvent', 'div', 'click'])" class="amount_house_bs"></div>
    </section>
    <!--footer_menu end-->

    <!--alert info start-->
    <div class="amount_house_mask_bs"></div>
    <div class="in_info_bs">
    	<span onclick="_hmt.push(['_trackEvent', 'span', 'click'])" class="in_info_close_bs"></span>
    	<p class="in_title_name_bs">现在预约，可免费获得装修全程管家式服务</p>
    	<div id="apply-form">
            <form name="myform" method="post" id="myform">
            	<div id="name-box">
                	<input id="user-name" name="title" class="apply-input" type="text" maxlength="10" placeholder="hi~我是小U管家，您怎么称呼？">
                </div>
                <div id="phone-box">
                	<input id="user-pwd" name="telephone" class="apply-input" type="text" maxlength="11" placeholder="您的专属管家怎么联系您呢？">
                </div>
                <div class="user-info fix">
                	<div id="province">
                        <select name="select-01" id="select-01"><option value="0">选择城市</option></select>
                	</div>
                </div>
                <p id="apply-total" class="total">已有<em class="number" id="userTotal">7820</em>人参加</p>
                <input id="applyBtn" class="orange-btn" type="submit" value="免费量房">
                <input id="source" type="hidden" value="M站-首页-报名">
            </form>
			<p class="sing_agreement"  style="margin-top: 0.5rem;">使用优装美家服务即代表您已同意<a href="mobile-sing_agreement.html">用户协议</a></p>
            <div id="errorCue" class="hideError"><span id="errorMsg">您输入的姓名或电话有错误</span></div>
            <p id="apply-tip" class="tip">我们承诺：优装美家提供装修全程管家式服务，为了您的 利益和我们的口碑，您的隐私将被严格保密。</p>
        </div>
    </div>
    <!--alert info end-->

	<!-- 添加悬浮客服 -->
	<!--<a target="_blank"  href="javascript:void(0)" id="udesk-feedback-tab" class="" style="" onclick="openJesongPlatChat(1);"><img src="./res/msite/base/img/service_tel.png" alt="" /></a>-->
	<!-- 添加悬浮客服 -->

    <!--Footer Start-->
    <footer id="footer">
    	<ul class="platforms">
        	<li class="active"><a href="mobile-index.html"><cite class="iconfont icon-shouji"></cite>触屏版</a></li>
            <li class="vline"></li>
            <li><a href="http://www.uzhuang.com/index.php?from=wap"><cite class="iconfont icon-diannao"></cite>电脑版</a></li>
            <li class="vline"></li>
            <li><a href="mobile-about_us.html"><cite class="iconfont icon-guanyuwomen"></cite>关于我们</a></li>
            <li class="vline"></li>
            <li><a href="http://app.uzhuang.com/"><cite class="iconfont icon-yu"></cite>App</a></li>
        </ul>
    	<p class="company-name">北京优装网信息科技有限公司<br>京ICP备15022586号-1</p>
    </footer>
    <!--Footer End-->

    <!--Weibo Pc Start-->
    <section id="weibo-pc">
    	<a id="weibo-image-link" target="_blank" href="http://www.uzhuang.com/index.php?from=wap"><img id="weibo-image" src="./res/msite/index/img/940X700banner.jpg"></a>
    </section>
    <!--Weibo Pc End-->
    <a id="index-bottom-tel" href="tel:400-6171-666"><span id="tel-icon">&nbsp;</span></a>
    <div class="index_bottom_erect"></div>
<script src="./res/msite/base/js/zepto.min.js"></script>
<script src="./res/msite/base/js/underscore-template.js"></script>
<script src="./res/msite/base/js/base.js"></script>
<script src="./res/msite/base/js/send_formM2.1.js"></script>
<script src="./res/msite/base/js/size.js"></script>
<script src="./res/msite/base/js/manager_select.js"></script>
<script src="./res/msite/base/js/swiper.jquery.min.js"></script>
<script src="./res/msite/index/js/index.js"></script>
<script>
    $(function(){
        $('#select-01').loadProvince();
    });
</script>

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
