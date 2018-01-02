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
<link rel="stylesheet" type="text/css" href="<?php echo R;?>msite/user_home/css/myorder.css">
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
<div id='share_logo' style='margin:0 auto;display:none;'> 
  <img src="<?php echo R;?>msite/base/img/share_logo.jpg"/> 
</div>
<!--Top Bar Start-->
<header>
    <!--<a id="logo" href="##" target="_self" title="优装美家"><i class="iconfont icon-jingyu"></i></a>--> 
    <div class="tit_minu">
        <a id="go-back" target="_self" title="优装美家">
            <i class="iconfont icon-goback"></i>
        </a>
        <a class="back_index" href="mobile-index.html">首页</a>
    </div>
	<!-- <div class="city">
		<a href="##" class="current-city">北京<i class="iconfont icon-xiajiantou"></i></a>
	</div> -->
	<h1 class="header-title">我的订单</h1>
	
</header>

<!--Top Bar End--> 
<!--My order head Start-->
<section id="order-head">
	<h2></h2>
    <ul id="tags"></ul>
</section>
<!--My order head End-->
<!--order steps Start-->
<section id="order-steps">
	<h2>订单进度：</h2>
    <ul id="steps"></ul> 
    <ul id="node-box">
    	<!--订单审核-->
    	<li id="shenhe" class="">
        	<div class="title">
            	<div class="time"></div>
            	<h3 class="step-name">装修订单审核</h3>
            	<div class="iconfont icon-gotonext"></div>
            </div>
            <div class="detail" >
            	<p></p>
            </div>
        </li>
        <!--精选家装公司-->
        <li id="jingxuan" class="">
        	<div class="title">
                <div class="time"></div>
                <h3 class="step-name">为您精选3家装修公司</h3>
                <div class="iconfont icon-gotonext"></div>
            </div>
            <div class="detail" >
            	<ul id="hot-company">
                </ul>
            </div>
        </li>
        <!--为您指定管家-->
        <li id="zhiding" class="">
        	<div class="title">
                <div class="time"></div>
                <h3 class="step-name">为您指定管家</h3>
                <div class="iconfont icon-gotonext"></div>
            </div>
            <div class="detail" >
            	<a id="take-phone" href="tel:" class="manager clearfix">
                	<img id="manager-face" src="">
                    <div class="about-manager">
                    	<h3><span id="manager-name"></span><span class="title">管家</span></h3>
                        <div id="take-phone" class="tel" href="tel:"><i class="iconfont icon-phone"></i><span id="manager-phone"></span></div>
                    </div>
                </a>
            </div>
        </li>
        <!--上门量房-->
        <li id="liangfang" class="">
        	<div class="title">
                <div class="time"></div>
                <h3 class="step-name">上门量房</h3>
                <div class="iconfont icon-gotonext"></div>
            </div>
            <div class="detail" >
            	<ul id="state-list">
                </ul>
            </div>
            <div class="bottom">
            	<a class="node-detail" href="javascript:"><i class="iconfont icon-i"></i>节点说明</a>
                <a class="live-photo" href="javascript:"><i class="iconfont icon-tuku"></i>去看现场照片</a>
            </div>
        </li>
        <!--选定装修公司-->
        <li id="xuangongsi" class="">
        	<div class="title">
            	<div class="time"></div>
            	<h3 class="step-name">选定装修公司</h3>
            	<div class="iconfont icon-gotonext"></div>
            </div>
            <div class="detail" >
            	<p></p>
            </div>
            <div class="bottom">
            	<a class="node-detail" href="javascript:"><i class="iconfont icon-i"></i>节点说明</a>
                <a class="live-photo" href="javascript:"><i class="iconfont icon-tuku"></i>去看现场照片</a>
            </div>
        </li>
        <!--签订设计协议/意向定金-->
        <li id="qianxieyi" class="">
        	<div class="title">
            	<div class="time"></div>
            	<h3 class="step-name">签订设计协议/意向定金<i class="iconfont icon-money"></i></h3>
            	<div class="iconfont icon-gotonext"></div>
            </div>
            <div class="detail" >
            	<p id="qxy-qd"></p>
                <p id="xybh"></p>
				<p id="yfk"></p>
            </div>
            <div class="bottom">
            	<a class="node-detail" href="javascript:"><i class="iconfont icon-i"></i>节点说明</a>
                <a class="live-photo" href="javascript:"><i class="iconfont icon-tuku"></i>去看现场照片</a>
            </div>
        </li>
        <!--方案确定预交底-->
        <li id="quedingfangan" class="">
        	<div class="title">
            	<div class="time"></div>
            	<h3 class="step-name">方案确定预交底</h3>
            	<div class="iconfont icon-gotonext"></div>
            </div>
            <div class="detail" >
            	<p>已确定</p>
            </div>
            <div class="bottom">
            	<a class="node-detail" href="javascript:"><i class="iconfont icon-i"></i>节点说明</a>
                <a class="live-photo" href="javascript:"><i class="iconfont icon-tuku"></i>去看现场照片</a>
            </div>
        </li>
        <!--签施工协议-->
        <li id="shigongxieyi" class="">
        	<div class="title">
            	<div class="time"></div>
            	<h3 class="step-name">签施工协议<i class="iconfont icon-money"></i></h3>
            	<div class="iconfont icon-gotonext"></div>
            </div>
            <div class="detail" >
            	<p id="sgxy-id"></p>
                <p id="sgxy-pay"></p>
                <p id="sgxy-detail"></p>
            </div>
            <div class="bottom">
            	<a class="node-detail" href="javascript:"><i class="iconfont icon-i"></i>节点说明</a>
                <a class="live-photo" href="javascript:"><i class="iconfont icon-tuku"></i>去看现场照片</a>
            </div>
        </li>
        <!--工程开工-->
        <li id="kaigong" class="">
        	<div class="title">
            	<div class="time"></div>
            	<h3 class="step-name">工程开工</h3>
            	<div class="iconfont icon-gotonext"></div>
            </div>
            <div class="detail" >
            	<p>已开工</p>
            </div>
            <div class="bottom">
            	<a class="node-detail" href="javascript:"><i class="iconfont icon-i"></i>节点说明</a>
                <a class="live-photo" href="javascript:"><i class="iconfont icon-tuku"></i>去看现场照片</a>
            </div>
        </li>
        <!--拆改-->
        <li id="chaigai" class="kexuan">
        	<div class="title">
            	<div class="time"></div>
            	<h3 class="step-name">拆改</h3>
            	<div class="iconfont icon-gotonext"></div>
            </div>
            <div class="detail" >
            	<p></p>
            </div>
<!--            <div class="bottom">
            	<a class="live-photo" href="javascript:"><i class="iconfont icon-tuku"></i>去看现场照片</a>
            </div>-->
        </li>
        <!--水电材料验收-->
        <li id="shuidian-1" class="">
        	<div class="title">
            	<div class="time"></div>
            	<h3 class="step-name">水电材料验收</h3>
            	<div class="iconfont icon-gotonext"></div>
            </div>
            <div class="detail" >
            	<p></p>
            </div>
            <div class="bottom">
            	<a class="node-detail" href="javascript:"><i class="iconfont icon-i"></i>节点说明</a>
                <a class="live-photo" href="javascript:"><i class="iconfont icon-tuku"></i>去看现场照片</a>
            </div>
        </li>
        <!--泥木材料验收-->
        <li id="nimu-1" class="">
        	<div class="title">
            	<div class="time"></div>
            	<h3 class="step-name">泥木材料验收</h3>
            	<div class="iconfont icon-gotonext"></div>
            </div>
            <div class="detail" >
            	<p></p>
            </div>
            <div class="bottom">
            	<a class="node-detail" href="javascript:"><i class="iconfont icon-i"></i>节点说明</a>
                <a class="live-photo" href="javascript:"><i class="iconfont icon-tuku"></i>去看现场照片</a>
            </div>
        </li>
        <!--油漆材料验收-->
        <li id="youqi-1" class="">
        	<div class="title">
            	<div class="time"></div>
            	<h3 class="step-name">油漆材料验收</h3>
            	<div class="iconfont icon-gotonext"></div>
            </div>
            <div class="detail" >
            	<p></p>
            </div>
            <div class="bottom">
            	<a class="node-detail" href="javascript:"><i class="iconfont icon-i"></i>节点说明</a>
                <a class="live-photo" href="javascript:"><i class="iconfont icon-tuku"></i>去看现场照片</a>
            </div>
        </li>
        <!--水电验收-->
        <li id="shuidian-2">
        	<div class="title">
            	<div class="time"></div>
            	<h3 class="step-name">水电验收<i class="iconfont icon-money"></i></h3>
            	<div class="iconfont icon-gotonext"></div>
            </div>
            <div class="detail" >
            	<p id="sd2-beizhu"></p>
                <p id="sd2-jine"></p>
            </div>
            <div class="bottom">
            	<a class="node-detail" href="javascript:"><i class="iconfont icon-i"></i>节点说明</a>
                <a class="live-photo" href="javascript:"><i class="iconfont icon-tuku"></i>去看现场照片</a>
            </div>
        </li>
        <!--泥木验收-->
        <li id="nimu-2" class="">
        	<div class="title">
            	<div class="time"></div>
            	<h3 class="step-name">泥木验收<i class="iconfont icon-money"></i></h3>
            	<div class="iconfont icon-gotonext"></div>
            </div>
            <div class="detail" >
            	<p id="nm2-beizhu"></p>
                <p id="nm2-jine"></p>
            </div>
            <div class="bottom">
            	<a class="node-detail" href="javascript:"><i class="iconfont icon-i"></i>节点说明</a>
                <a class="live-photo" href="javascript:"><i class="iconfont icon-tuku"></i>去看现场照片</a>
            </div>
        </li>
        <!--油漆验收-->
        <li id="youqi-2" class="">
        	<div class="title">
            	<div class="time"></div>
            	<h3 class="step-name">油漆验收<i class="iconfont icon-money"></i></h3>
            	<div class="iconfont icon-gotonext"></div>
            </div>
            <div class="detail" >
            	<p id="yq2-beizhu"></p>
                <p id="yq2-jine"></p>
            </div>
            <div class="bottom">
            	<a class="node-detail" href="javascript:"><i class="iconfont icon-i"></i>节点说明</a>
                <a class="live-photo" href="javascript:"><i class="iconfont icon-tuku"></i>去看现场照片</a>
            </div>
        </li>
        <!--竣工验收-->
        <li id="jungong" class="">
        	<div class="title">
            	<div class="time"></div>
            	<h3 class="step-name">竣工验收<i class="iconfont icon-money"></i></h3>
            	<div class="iconfont icon-gotonext"></div>
            </div>
            <div class="detail" >
            	<p id="jg-beizhu"></p>
                <p id="jg-jine"></p>
            </div>
            <div class="bottom">
            	<a class="node-detail" href="javascript:"><i class="iconfont icon-i"></i>节点说明</a>
                <a class="live-photo" href="javascript:"><i class="iconfont icon-tuku"></i>去看现场照片</a>
            </div>
        </li>
        <!--竣工污染检测-->
        <li id="wuran_1" class="">
        	<div class="title">
            	<div class="time"></div>
            	<h3 class="step-name">竣工污染检测<i class="iconfont icon-money"></i></h3>
            	<div class="iconfont icon-gotonext"></div>
            </div>
            <div class="detail" >
            	<p></p>
            </div>
            <div class="bottom">
            	<a class="node-detail" href="javascript:"><i class="iconfont icon-i"></i>节点说明</a>
                <a class="live-photo" href="javascript:"><i class="iconfont icon-tuku"></i>去看现场照片</a>
            </div>
        </li>
        <!--污染治理-->
        <li id="wuran_2" class="kexuan">
        	<div class="title">
            	<div class="time"></div>
            	<h3 class="step-name">污染治理<i class="iconfont icon-money"></i></h3>
            	<div class="iconfont icon-gotonext"></div>
            </div>
            <div class="detail" >
            	<p id="wr-cp"></p>
                <p id="wr-bz"></p>
                <p id="wr-id"></p>
                <p id="wr-mn"></p>
            </div>
            <div class="bottom">
            	<a class="node-detail" href="javascript:"><i class="iconfont icon-i"></i>节点说明</a>
                <a class="live-photo" href="javascript:"><i class="iconfont icon-tuku"></i>去看现场照片</a>
            </div>
        </li>
        <!--复测 1-->
        <li id="fuce1" class=" kexuan">
        	<div class="title">
            	<div class="time"></div>
            	<h3 class="step-name">复测<i class="iconfont icon-money"></i></h3>
            	<div class="iconfont icon-gotonext"></div>
            </div>
            <div class="detail" >
            	<p></p>
            </div>
            <div class="bottom">
            	<a class="node-detail" href="javascript:"><i class="iconfont icon-i"></i>节点说明</a>
                <a class="live-photo" href="javascript:"><i class="iconfont icon-tuku"></i>去看现场照片</a>
            </div>
        </li>
        <!--尾款质保期-->
        <li id="weikuan" class="">
        	<div class="title">
            	<div class="time"></div>
            	<h3 class="step-name">尾款质保期<i class="iconfont icon-money"></i></h3>
            	<div class="iconfont icon-gotonext"></div>
            </div>
            <div class="detail" >
            	<p></p>
            </div>
            <div class="bottom">
            	<a class="node-detail" href="javascript:"><i class="iconfont icon-i"></i>节点说明</a>
            </div>
        </li>
        <!--入住空气检测-->
        <li id="kongqi" class="">
        	<div class="title">
            	<div class="time"></div>
            	<h3 class="step-name">入住空气检测<i class="iconfont icon-money"></i></h3>
            	<div class="iconfont icon-gotonext"></div>
            </div>
            <div class="detail" >
            	<p id="kq-bz"></p>
                <p id="kq-zs"></p>
            </div>
            <div class="bottom">
            	<a class="node-detail" href="javascript:"><i class="iconfont icon-i"></i>节点说明</a>
                <a class="live-photo" href="javascript:"><i class="iconfont icon-tuku"></i>去看现场照片</a>
            </div>
        </li>
        <!--空气治理-->
        <li id="zhili" class=" kexuan">
        	<div class="title">
            	<div class="time"></div>
            	<h3 class="step-name">空气治理<i class="iconfont icon-money"></i></h3>
            	<div class="iconfont icon-gotonext"></div>
            </div>
            <div class="detail" >
            	<p id="zl-cp"></p>
				<p id="zl-id"></p>
				<p id="zl-mn"></p>
                <p id="zl-bz"></p>
            </div>
            <div class="bottom">
            	<a class="node-detail" href="javascript:"><i class="iconfont icon-i"></i>节点说明</a>
                <a class="live-photo" href="javascript:"><i class="iconfont icon-tuku"></i>去看现场照片</a>
            </div>
        </li>
        <!--复测 2-->
        <li id="fuce2" class="kexuan">
        	<div class="title">
            	<div class="time"></div>
            	<h3 class="step-name">复测</h3>
            	<div class="iconfont icon-gotonext"></div>
            </div>
            <div class="detail" >
            	<p></p>
            </div>
<!--            <div class="gift">
            	<p>赠送：优装美家微空气监测仪一台</p>
                <a class="orange-link" href="javascript:">查看介绍和使用说明</a>
            </div>-->
            <div class="bottom">
            	<a class="node-detail" href="javascript:"><i class="iconfont icon-i"></i>节点说明</a>
                <a class="live-photo" href="javascript:"><i class="iconfont icon-tuku"></i>去看现场照片</a>
            </div>
        </li>
        <!--完结-->
        <li id="wanjie" class="">
        	<div class="title">
            	<div class="time"></div>
            	<h3 class="step-name">完结</h3>
            </div>
        </li>
    </ul>
</section>
<!--order steps End-->

<script src="<?php echo R;?>msite/base/js/zepto.min.js"></script>
<script src="<?php echo R;?>msite/base/js/base.js"></script>
<script src="<?php echo R;?>msite/user_home/js/myorders.js"></script>
</body>
</html>
