<?php defined('IN_WZ') or exit('No direct script access allowed'); ?><!doctype html>
<html>
<head>
<meta name="viewport" content="width=device-width,minimum-scale=1.0,maximum-scale=1.0, minimal-ui"/>
<meta content="yes" name="apple-mobile-web-app-capable">
<meta charset="utf-8">
<meta name="keywords" content="装修管家,量房设计,装修施工,材料商城,环保方案,装修服务,装修图库,建材商城,装修攻略、优装网、装修网、优装美家">
<meta name="description" content="优装美家为您提供免费专业咨询、免费量房、免费设计、免费装修保险、免费环保检测、优装网-专业装修网优选装修公司、优选建材商品、优选装修管家、优选环保服务">
<title>优装美家—管家式装修服务 有品质的低价</title>
<link rel="stylesheet" type="text/css" href="<?php echo R;?>msite/base/css/base.css">
<link href="<?php echo R;?>msite/applied/css/post_form.css" rel="stylesheet" type="text/css">
<link href="<?php echo R;?>msite/applied/css/master.css" rel="stylesheet" type="text/css"/>
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
    	<!--banner-->
    	<div id="think-banner" class="think-banner">
    		<!--portrait_logo.jpg-->
        	<img class="apply-img" id="apply-img" src="<?php echo R;?>msite/applied/images/loading_pic.jpg">
        	<!--背景图上的logo及对象信息-->
			<div class="target_cont">
				<!--logo-->
				<div class="target_logo">
					<img src=""  />
				</div>
				<!--名称-->
				<h4 class="target_username">司马师</h4>
				<!--信息-->
				<div class="target_message">
					<ul class="target_message_list">
						<li class="steward_level">资深管家</li>
					</ul>
				</div>
				<div class="target_message_design">
					<span></span>
					<div class="target_message_design_lv">
						设计师
					</div>
				</div>
			</div>
        </div>
    	<div id="apply-form">
            <form name="myform" method="post" id="myform">
            	<div id="name-box">
                	<input id="user-name" name="title" class="apply-input" type="text" maxlength="10" placeholder="hi~我是小u管家，您怎么称呼？">
                </div>
                <div id="phone-box">
                	<input id="user-pwd" name="telephone" class="apply-input" type="tel" maxlength="11" placeholder="您的专属管家怎么联系您？">
                </div>
                <div class="user-info fix">
                	<div id="province">
                        <select name="select-01" id="select-01" ><option value="0">选择城市</option></select>
                	</div>
                </div>
                <p id="apply-total" class="total">已有<em class="number" id="userTotal">1648</em>人参加</p>
                <input id="applyBtn" class="orange-btn" type="submit" value="免费申请">
                <p class="sing_agreement"  style="margin-top: 0.5rem;">使用优装美家服务即代表您已同意<a href="mobile-sing_agreement.html">用户协议</a></p>
                <p class="promise">我们承诺：优装美家提供装修全程式服务，为了您的利益和我们的口碑，您的隐私将被严格保密。</p>
            </form>
            <div id="errorCue" class="hideError"><span id="errorMsg">您输入的姓名或电话有错误</span></div>
        </div>
    </section>
    <!--Form End-->

<script src="<?php echo R;?>msite/base/js/zepto.min.js"></script>
<script src="<?php echo R;?>msite/base/js/base.js"></script>
<script src="<?php echo R;?>msite/applied/js/send_form.js"></script>
<script src="<?php echo R;?>msite/applied/js/manager_select.js"></script>
<script src="<?php echo R;?>msite/applied/js/enlist_record.js"></script>

<script>
    $(function(){
        $('#select-01').loadProvince();
    })
</script>
</body>
</html>

