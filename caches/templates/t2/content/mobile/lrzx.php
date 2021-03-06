<?php defined('IN_WZ') or exit('No direct script access allowed'); ?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width,minimum-scale=1.0,maximum-scale=1.0, minimal-ui"/>
    <meta name="keywords" content="装修管家,量房设计,装修施工,材料商城,环保方案,装修服务,装修图库,建材商城,装修攻略、优装网、装修网、优装美家">
    <meta name="description" content="优装美家为您提供免费专业咨询、免费量房、免费设计、免费装修保险、免费环保检测、优装网-专业装修网优选装修公司、优选建材商品、优选装修管家、优选环保服务">
    <title>优装美家—管家式装修服务 有品质的低价</title>
    <link href="<?php echo R;?>msite/base/css/base.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" type="text/css" href="<?php echo R;?>msite/lrzx/css/post_form.css">
    <link rel="stylesheet" type="text/css" href="<?php echo R;?>msite/lrzx/css/lrzx.css">
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
<body id="managerPage">
<section>
    <img class="banner" src="<?php echo R;?>msite/lrzx/img/banner.jpg" alt="banner" />
    <img class="img-1" src="<?php echo R;?>msite/lrzx/img/img1.jpg" alt="" />
</section>
<section class="form-box">
    <div class="form-one">
        <img class="form-header" src="<?php echo R;?>msite/lrzx/img/form_header.jpg" alt="" />
        <form class="apply-from">
            <div class="select-box clearfix">
                <div class="select-div">
                    <select id="lrsx">
                        <option value="0">懒人属性</option>
                        <option value="1">太忙了</option>
                        <option value="2">不懂装修</option>
                        <option value="3">有钱有闲</option>
                    </select>
                </div>
                <div class="select-div">
                    <select id="area">
                        <option value="0">房屋面积</option>
                        <option value="1">60㎡以下</option>
                        <option value="2">60~100㎡</option>
                        <option value="3">100~120㎡</option>
                        <option value="4">120~160㎡</option>
                        <option value="5">160㎡以上</option>
                    </select>
                </div>
                <div class="select-div">
                    <select id="style">
                        <option value="0">装修风格</option>
                        <option value="1">简约</option>
                        <option value="2">欧式</option>
                        <option value="3">中式</option>
                        <option value="4">田园</option>
                    </select>
                </div>
                <div class="select-div">
                    <select id="lrjd">
                        <option value="0">懒人焦点</option>
                        <option value="1">注重环保</option>
                        <option value="2">装修贷款</option>
                        <option value="3">待收新房</option>
                    </select>
                </div>
            </div>
            <span class="select-btn">确定有惊喜</span>
        </form>
        <div class="error-info"><span>请把资料填写完整</span></div>
    </div>
    <div class="form-two">
        <div class="add-bg">
            <i class="go-back"></i>
            <div class="top-p">
                <p><span class="title-1">环保服务</span>：<span class="content-1">0首付  0抵押  0手续费</span></p>
                <p><span class="title-2">资金安全</span>：<span class="content-2">满意后在付款</span></p>
                <p><span class="title-3">预计工期</span>：<span class="content-3">≤60天</span></p>
            </div>
        </div>
        <div class="center">
            <div class="center-top">
                <h3>机智的懒人~</h3>
                <div class="center-jzlr"><p>加班狗最佳装修方案</p><p>装修管家已经为全国10000+用户提供过服务，成功帮助用户从装修痛苦中解脱！</p></div>
            </div>
            <div class="center-bottom">
                <h3>我们帮您</h3>
                <div class="center-wmbn">
                    <p class="wmbn-1">全程7*24小时服务&nbsp;&nbsp;&nbsp;&nbsp;10次上门服务&nbsp;&nbsp;&nbsp;&nbsp;21个服务节点日志</p>
                    <p class="wmbn-2">环保服务：2次免费环保&nbsp;&nbsp;，竣工与入住前双保障</p>
                </div>
            </div>
            <form name="myform" method="post" id="myform" class="myform">
                <div id="name-box" class="name-box">
                    <input id="user-name" name="title" class="apply-input" type="text" maxlength="10" placeholder="hi~我是小U管家，您怎么称呼？">
                </div>
                <div id="phone-box" class="phone-box">
                    <input id="user-pwd" name="telephone" class="apply-input" type="text" maxlength="11" placeholder="您的专属管家怎么联系您呢？">
                </div>
                <div class="user-info fix">
                    <div id="province" class="province-select">
                        <select name="select-01" id="select-01" class="select-1"><option value="0">选择城市</option></select>
                    </div>
                </div>
                <input id="applyBtn" class="apply-btn" type="submit" value="免费量房">
                <input id="source" type="hidden" value="M站-懒人装修">
                <div id="errorCue" class="errorClass"><span id="errorMsg" class="error-msg">您输入的姓名或电话有错误</span></div>
            </form>
        </div>
    </div>
</section>
<section>
    <img class="btn-top-show" src="<?php echo R;?>msite/lrzx/img/img2.jpg" alt="" />
    <img src="<?php echo R;?>msite/lrzx/img/img3.jpg" alt="" />
    <img src="<?php echo R;?>msite/lrzx/img/img4.jpg" alt="" />
    <img src="<?php echo R;?>msite/lrzx/img/img5.jpg" alt="" />
    <img src="<?php echo R;?>msite/lrzx/img/img6.jpg" alt="" />
    <img src="<?php echo R;?>msite/lrzx/img/img7.jpg" alt="" />
    <img src="<?php echo R;?>msite/lrzx/img/img8.jpg" alt="" />
    <img src="<?php echo R;?>msite/lrzx/img/img9.jpg" alt="" />
    <img src="<?php echo R;?>msite/lrzx/img/img10.jpg" alt="" />
    <img src="<?php echo R;?>msite/lrzx/img/img11.jpg" alt="" />
    <img src="<?php echo R;?>msite/lrzx/img/img12.jpg" alt="" />
</section>
<section>
    <div class="amount_house_mask_bs"></div>
    <div class="in_info_bs">
        <span class="in_info_close_bs"></span>
        <p class="in_title_name_bs">现在预约，可免费获得装修全程管家式服务</p>
        <div id="alert-apply-form">
            <form name="myform" method="post" id="alert-myform" class="myform alert-myform">
                <div id="alert-name-box" class="name-box">
                    <input id="alert-user-name" name="title" class="apply-input" type="text" maxlength="10" placeholder="hi~我是小U管家，您怎么称呼？">
                </div>
                <div id="alert-phone-box" class="phone-box">
                    <input id="alert-user-pwd" name="telephone" class="apply-input" type="text" maxlength="11" placeholder="您的专属管家怎么联系您呢？">
                </div>
                <div class="user-info fix">
                    <div id="alert-province" class="province-select">
                        <select name="select-01" id="alert-select-01" class="select-1"><option value="0">选择城市</option></select>
                    </div>
                </div>
                <input id="alert-applyBtn" class="apply-btn" type="submit" value="免费量房">
                <input id="alert-source" type="hidden" value="M站-懒人装修">
            </form>
            <div id="alert-errorCue" class="errorClass"><span id="alert-errorMsg" class="error-msg">您输入的姓名或电话有错误</span></div>
            <p id="apply-tip" class="tip">我们承诺：优装美家提供装修全程管家式服务，为了您的 利益和我们的口碑，您的隐私将被严格保密。</p>
        </div>
    </div>
    <div id="free-btn">一秒报名</div>
</section>
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
<script type="text/javascript" src="<?php echo R;?>msite/base/js/zepto.min.js"></script>
<script type="text/javascript" src="<?php echo R;?>msite/base/js/manager_select.js"></script>
<script type="text/javascript" src="<?php echo R;?>msite/base/js/base.js"></script>
<script type="text/javascript" src="<?php echo R;?>msite/lrzx/js/lrzx.js"></script>
<script type="text/javascript" src="<?php echo R;?>msite/lrzx/js/send_form.js"></script>
<script>
    $(function(){
        $('#select-01').loadProvince();
        $('#alert-select-01').loadProvince();
    });
    var isApp = getUrlParameter('app');
    if(isApp == 1){
        $('.footer_menu_bs').remove();
        $('#free-btn').css({bottom: 0});
        var btnH = $('#free-btn').height();
        $('body').css({'margin-bottom': btnH});
    }
</script>
</body>
</html>
