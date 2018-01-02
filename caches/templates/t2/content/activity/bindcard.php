<?php defined('IN_WZ') or exit('No direct script access allowed'); ?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>优装美家就是装修管家，管家式装修服务平台</title>
    <meta name="viewport" content="width=device-width,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no">
    <link rel="stylesheet" href="<?php echo R;?>activity/base/css/base.css">
    <link rel="stylesheet" href="<?php echo R;?>activity/bindcard/css/bindcard.css">
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
    <h1 class="header-title">绑定银行卡</h1>
</header>
<section class="bindcard">
    <ul class="card_massage">
        <li class="card_list clearfix">
            <div class="cardname fl">姓名</div>
            <div class="cardtext">
                <input type="text" kind="name" placeholder="请输入真实姓名">
            </div>
        </li>
        <li class="card_list clearfix">
            <div class="cardname fl">卡号</div>
            <div class="cardtext">
                <input type="text" kind="bank_number" placeholder="请输入您的卡号">
            </div>
        </li>
        <li class="card_list clearfix">
            <div class="cardname fl">身份证号</div>
            <div class="cardtext">
                <input type="text" kind="id_number" placeholder="请输入您的身份证号">
            </div>
        </li>
        <li class="card_list clearfix">
            <div class="cardname fl">开户行</div>
            <div class="cardtext">
                <select class="bank_name">
                    <option value="中国银行">中国银行</option>
                    <option value="工商银行">工商银行</option>
                    <option value="农业银行">农业银行</option>
                    <option value="建设银行">建设银行</option>
                    <option value="交通银行">交通银行</option>
                    <option value="招商银行">招商银行</option>
                    <option value="浦发银行">浦发银行</option>
                    <option value="上海银行">上海银行</option>
                    <option value="邮政储蓄银行">邮政储蓄银行</option>
                    <option value="兴业银行">兴业银行</option>
                    <option value="中信银行">中信银行</option>
                    <option value="平安银行">平安银行</option>
                    <option value="华夏银行">华夏银行</option>
                    <option value="北京银行">北京银行</option>
                    <option value="宁波银行">宁波银行</option>
                    <option value="广发银行">广发银行</option>
                    <option value="民生银行">民生银行</option>
                    <option value="天津银行">天津银行</option>
                    <option value="光大银行">光大银行</option>
                    <option value="南京银行">南京银行</option>
                    <option value="深圳发展银行">深圳发展银行</option>
                    <option value="北京银行">北京银行</option>
                </select>
            </div>
            <i class="iconfont icon-slideup"></i>
        </li>
        <li class="card_list clearfix">
            <div class="cardname fl"></div>
            <div class="cardtext">
                <input type="text" kind="branch" placeholder="支行">
            </div>
        </li>
    </ul>
    <div class="submit">
        <input type="button" value="确认" class="submits">
    </div>
</section>
</body>
</html>
<script type="text/javascript" src="<?php echo R;?>activity/base/js/zepto.min.js"></script>
<script type="text/javascript" src="http://res.wx.qq.com/open/js/jweixin-1.0.0.js"></script><script src="<?php echo R;?>activity/base/js/base.js"></script>
<script type="text/javascript" src="<?php echo R;?>activity/base/js/underscore-template.js"></script>
<script type="text/javascript" src="<?php echo R;?>activity/bindcard/js/bindcard.js"></script>





















