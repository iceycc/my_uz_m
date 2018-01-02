<?php defined('IN_WZ') or exit('No direct script access allowed'); ?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>优装美家就是装修管家，管家式装修服务平台</title>
    <meta name="viewport" content="width=device-width,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no">
    <link rel="stylesheet" href="./res/activity/base/css/base.css">
    <link rel="stylesheet" href="./res/activity/base/css/swiper.min.css">
    <link rel="stylesheet" href="./res/activity/base/css/index_footerminu.css">
    <link rel="stylesheet" href="./res/activity/index/css/index_main.css">
    <div style="display:none">
        <script>
            var _hmt = _hmt || [];
            (function () {
                var hm = document.createElement("script");
                hm.src = "//hm.baidu.com/hm.js?92380afd6606de580cc830429c39c519";
                var s = document.getElementsByTagName("script")[0];
                s.parentNode.insertBefore(hm, s);
            })();
        </script>
    </div>
</head>
<body>
<header>
    <a id="go-back" target="_self" title="优装美家">
        <i class="iconfont icon-goback"></i>
    </a>
    <h1 class="header-title">推荐装修返现</h1>
    <a class="header_rightminu" href="activity-userhome.html">我的</a>

</header>

<!--info s-->
<section class="info">
    <div class="numtim_cont">
        <div class="numtim">
            <div class="numtim_logo"></div>
            <div class="numtim_text">
                <h2>今日您还可以推荐<span class="nt_number">10</span>名用户</h2>
                <p>填写好友装修信息领取现金返现</p>
            </div>
        </div>
        <div class="numtim_mstext">提示：需要获得好友手机验证码哦</div>
    </div>
    <div class="infotext">
        <!--必填项 s-->
        <div class="info_import">
            <ul class="if_states">
                <li class="if_name clearfix">
                    <div class="if_listtitle fl"><span>*</span>好友姓名</div>

                        <input class="textmass" type="text" states = "title"  placeholder="请输入好友真实姓名">

                </li>
                <li class="if_number clearfix">
                    <div class="if_listtitle fl"><span>*</span>好友电话</div>

                    <input class="textmass" type="text" states = "mobile"  placeholder="请输入好友的电话">

                </li>
                <li class="if_smscode clearfix">
                    <div class="if_listtitle fl"><span>*</span>验证码</div>

                    <div class="sms_minu_cont fr clearfix">
                        <input type="button" class="smsminu" value="发送验证码">
                    </div>
                    <input class="smscode textmass" type="text" maxlength="6" states = "smscode" placeholder="验证码">

                </li>
                <li class="if_sex clearfix" option="1">
                    <div class="if_listtitle fl"><span>*</span>好友性别</div>
                    <div class="fr clearfix sex_minu">
                        <div class="fl sex_left sexno_minu " statesnum = "1">
                            <i class="iconfont icon-xuanze2"></i>
                            <span>先生</span>
                        </div>

                        <div class="sex_right fl sexno_minu" statesnum = "2">
                            <i class="iconfont icon-xuanze2"></i>
                            <span>女士</span>
                        </div>
                    </div>
                    <input type="hidden" class="textmass" states = "sex" >
                </li>
                <li class="if_address clearfix">
                    <div class="if_listtitle fl"><span>*</span>好友地址</div>
                    <!--<input class="fr" type="text" states = "province"  placeholder="请选择城市">-->
                    <div class="province fr post_text">
                        <select name="select-01" id="select-01" class="textmass" states="areaid_2"><option value="0">城市</option></select>
                    </div>
                </li>

            </ul>
        </div>
        <!--必填项 e-->

        <!--选填项 s-->
        <div class="info_Choice">
            <ul class="if_states">
                <li class="if_name clearfix">
                    <div class="if_listtitle fl"><span>*</span>小区名</div>

                    <input class="textmass" type="text" states = "address" placeholder="请输入所在小区">

                </li>
                <li class="if_number clearfix" option="2">
                    <div class="if_listtitle fl"><span>*</span>新旧</div>
                    <div class="fr clearfix sex_minu">
                        <div class="fl sex_left sexno_minu"  statesnum = "1">
                            <i class="iconfont icon-xuanze2"></i>
                            <span>新房</span>
                        </div>
                        <div class="fl sex_right sexno_minu"  statesnum = "3">
                            <i class="iconfont icon-xuanze2"></i>
                            <span>旧房</span>
                        </div>
                    </div>
                    <input type="hidden" class="textmass" states = "housecategory">
                </li>
                <li class="if_sex clearfix">
                    <div class="if_listtitle fl"><span>*</span>面积</div>
                    <div class="fr clearfix post_text">
                        <div class="fr if_many">㎡</div>

                        <input class="textmany_area textmass" type="text" states = "area">

                    </div>
                </li>
                <li class="if_address clearfix">
                    <div class="if_listtitle fl"><span>*</span>预算</div>
                    <div class="fr clearfix post_tex" >
                        <div class="fr if_many">万元</div>

                        <input class="textmany_wy textmass" type="text" states = "budget">

                    </div>
                </li>
            </ul>
        </div>
        <!--选填项 e-->
    </div>
    <!--submite start-->
    <input type="submit" value="立即推荐 领取返现" class="if_sub is_disa" disabled>

    <div class="user_agreement">
        <i class="iconfont icon-xuanze2"></i><a href="mobile-sing_agreement.html">同意《推荐装修返现用户须知协议》</a>
    </div>
</section>
<!--info e-->

<!--alert mask s-->

<!--alert mask e-->

</body>
</html>
<script type="text/javascript" src="./res/activity/base/js/zepto.min.js"></script>
<script type="text/javascript" src="http://res.wx.qq.com/open/js/jweixin-1.0.0.js"></script><script src="./res/activity/base/js/base.js"></script>
<script type="text/javascript" src="./res/activity/base/js/underscore-template.js"></script>
<script type="text/javascript" src="./res/activity/base/js/manager_select.js"></script>
<script type="text/javascript" src="./res/activity/base/js/swiper.jquery.min.js"></script>
<script type="text/javascript" src="./res/activity/index/js/index_main.js"></script>
<script>
    $(function(){
        $('#select-01').loadProvince();
        new recommendInfo({
            direction:1
        });
    });
</script>