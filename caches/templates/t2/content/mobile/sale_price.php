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
<link href="<?php echo R;?>msite/base/css/base.css" rel="stylesheet" type="text/css">
<link href="<?php echo R;?>msite/index/css/post_form.css" rel="stylesheet" type="text/css">
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
      <h1 class="header-title">报名</h1>
      
    </header>

    <!--Form Start-->
    <section id="price-form">
    	<div id="apply-banner">
        	<img id="apply-img" src="<?php echo R;?>msite/index/img/weibo_mfbj.jpg">
        </div>
    	<div id="apply-form">
            <form name="myform" method="post" id="myform">
            	<div id="name-box">
                	<input id="user-name" name="title" class="apply-input" type="text" maxlength="10" placeholder="您的姓名">
                </div>
                <div id="phone-box">
                	<input id="user-pwd" name="telephone" class="apply-input" type="tel" maxlength="11" placeholder="您的手机">
                </div>
                <div class="user-info fix">
                	<div id="province">
                        <select name="select-01" id="select-01"><option value="0">城市</option></select>
                	</div>
                </div>
                <p id="apply-total" class="total">已有<em class="number" id="userTotal">1648</em>人参加</p>
                <input id="applyBtn" class="orange-btn" type="submit" value="免费申请">
            </form>
            <div id="errorCue" class="hideError"><span id="errorMsg">您输入的姓名或电话有错误</span></div>
        </div>
    </section>
    <!--Form End-->
    <a id="bottom-telephone" href="tel:400-6171-666">预约电话：400-6171-666</a>
    <!--Footer Start-->
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
    <!--Footer End-->
<script src="<?php echo R;?>msite/base/js/zepto.min.js"></script>
<script src="<?php echo R;?>msite/base/js/base.js"></script>
<script src="<?php echo R;?>msite/application/js/send_form.js"></script>
<script src="<?php echo R;?>msite/application/js/manager_select.js"></script>

<script>
    $(function(){
        $('#select-01').loadProvince();
    })
</script>

</body>
</html>
