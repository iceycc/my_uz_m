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
    <link href="<?php echo R;?>msite/application/css/application.css" rel="stylesheet" type="text/css">
    <div style="display:none">
        <script>
            var _hmt = _hmt || [];
            (function () {
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
    <!--<a id="logo" href="##" target="_self" title="优装美家"><i class="iconfont icon-jingyu"></i></a>-->
    <div class="tit_minu">
        <a id="go-back" target="_self" title="优装美家">
            <i class="iconfont icon-goback"></i>
        </a>
        <a class="back_index" href="mobile-index.html">首页</a>
    </div>
    <h1 class="header-title">报名</h1>
</header>

<div id="manager-banner"><img src="<?php echo R;?>msite/application/img/manager_banner.jpg" alt="装修管家，解决装修痛点"></div>
<section id="quality">
    <div class="mod-title">
        <h2>有品质的低价</h2>
    </div>
    <ul id="features-1">
        <li id="icon-liangfang" class="feature"><i class="icon">&nbsp;</i>
            <h3>免费量房</h3>
        </li>
        <li id="icon-sheji" class="feature"><i class="icon">&nbsp;</i>
            <h3>免费设计</h3>
        </li>
        <li id="icon-baojia" class="feature"><i class="icon">&nbsp;</i>
            <h3>免费报价</h3>
        </li>
        <li id="icon-jianli" class="feature"><i class="icon">&nbsp;</i>
            <h3>免费监理</h3>
        </li>
        <li id="icon-yanshou" class="feature"><i class="icon">&nbsp;</i>
            <h3>免费验收</h3>
        </li>
        <li id="icon-huanbao" class="feature"><i class="icon">&nbsp;</i>
            <h3>免费环保</h3>
        </li>
    </ul>
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
                    <select name="select-01" id="select-01">
                        <option value="0">省/市</option>
                    </select>
                </div>
            </div>
            <input id="applyBtn" class="orange-btn" type="submit" value="免费申请">
            <input id="source" name="source" type="hidden" size="30" value="">
        </form>
        <div id="errorCue" class="hideError"><span id="errorMsg">您输入的姓名或电话有错误</span></div>
        <p id="apply-total" class="total">已有<em class="number" id="userTotal">122356</em>人参加</p>
        <p id="apply-tip" class="tip">*支持北京、天津、深圳、广州报名<br/>
            更多城市正在开发中！</p>
    </div>
</section>
<section id="manager">
    <div class="mod-title">
        <h2>装修管家</h2>
    </div>
    <ul id="features-2">
        <li class="feature">
            <p class="number"><em>297</em>项</p>
            <p class="con">报价审核</p>
        </li>
        <li class="feature">
            <p class="number"><em>198</em>个</p>
            <p class="con">施工节点验收</p>
        </li>
        <li class="feature">
            <p class="number"><em>108</em>项</p>
            <p class="con">材料验收</p>
        </li>
        <li class="feature">
            <p class="number"><em>2</em>次</p>
            <p class="con">免费环保检测</p>
        </li>
        <li class="feature">
            <p class="number"><em>1</em>个</p>
            <p class="con">环保硬件赠送</p>
        </li>
        <li class="feature">
            <p class="number"><em>100</em>万</p>
            <p class="con">装修保险赠送</p>
        </li>
    </ul>
</section>
<section id="steps" class="fix">
    <div class="mod-title">
        <h2>装修流程</h2>
    </div>
    <div id="step1">
        <div class="txt">
            <h3 class="step-name">申请免费量房</h3>
            <p class="con">在线10秒快速申请</p>
        </div>
        <img class="step-img" src="<?php echo R;?>msite/application/img/manager_16.png"></div>
    <div id="step2">
        <div class="txt">
            <h3 class="step-name">免费设计报价</h3>
            <p class="con">精选三家公司免费设计报价</p>
        </div>
        <img class="step-img" src="<?php echo R;?>msite/application/img/manager_17.png"></div>
    <div id="step3">
        <div class="txt">
            <h3 class="step-name">装修施工</h3>
            <p class="con">专业装修队伍<br>
                施工质量保证</p>
        </div>
        <img class="step-img" src="<?php echo R;?>msite/application/img/manager_18.png"></div>
    <div id="step4"><img class="step-img" src="<?php echo R;?>msite/application/img/manager_19.png">
        <div class="txt">
            <h3 class="step-name">全程监理</h3>
            <p class="con">管家全程监理<br>
                远程了解工地动态</p>
        </div>
    </div>
    <div id="step5">
        <div class="txt">
            <h3 class="step-name">环保检测</h3>
            <p class="con">2次专业环保仪检测<br>
                放心入住</p>
        </div>
        <img class="step-img" src="<?php echo R;?>msite/application/img/manager_23.png"></div>
    <div id="step6">
        <div class="txt">
            <h3 class="step-name">环保治理</h3>
            <p class="con">专业污染治理解决方案<br>
                消灭污染源头</p>
        </div>
        <img class="step-img" src="<?php echo R;?>msite/application/img/manager_27.png"></div>
    <div id="step7">
        <div class="txt">
            <h3 class="step-name">赠送空气监测仪</h3>
            <p class="con">随时随地<br>
                监测室内空气质量</p>
        </div>
        <img class="step-img" src="<?php echo R;?>msite/application/img/manager_31.png"></div>
</section>
<div id="follow"><img class="code" src="<?php echo R;?>msite/application/img/code.png">
    <p class="txt">长按识别二维码，关注获取更多惊喜！</p>
</div>
<a id="bottom-telephone" href="tel:400-6171-666">咨询电话：400-6171-666</a>
<button id="free-btn">免费申请</button>
<footer id="footer">
    <!-- <ul class="platforms">
          <li class="active"><cite class="iconfont icon-shouji"></cite>触屏版</li>
        <li class="vline"></li>
        <li><a href="http://www.uzhuang.com/index.php?from=wap"><cite class="iconfont icon-diannao"></cite>电脑版</a></li>
        <li class="vline"></li>
        <li><a href="#"><cite class="iconfont icon-guanyuwomen"></cite>关于我们</a></li>
      </ul>
       -->
    <p class="company-name">北京优装网信息科技有限公司 京ICP备15022586号-1</p>
</footer>
</body>
<script src="<?php echo R;?>msite/base/js/zepto.min.js"></script>
<script src="<?php echo R;?>msite/base/js/base.js"></script>
<script src="<?php echo R;?>msite/application/js/send_form.js"></script>
<script src="<?php echo R;?>msite/application/js/manager_select.js"></script>
<script>
    $(function () {
        var city_select = $('#select-01');
        var slec_w = $(city_select).width();
        var slec_h = $(city_select).height();
        $(city_select).width(slec_w + 2);
        $(city_select).height(slec_h + 2);
        $('#select-01').loadProvince();
    })
</script>
</html>