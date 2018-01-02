<?php defined('IN_WZ') or exit('No direct script access allowed'); ?><!doctype html>
<html>
<head>
<meta name="viewport" content="width=device-width,minimum-scale=1.0,maximum-scale=1.0, minimal-ui"/>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>选择银行卡</title>
<link href="<?php echo R;?>activity/base/css/base.css" rel="stylesheet" type="text/css">
<link href="<?php echo R;?>activity/selectCard/css/selectCard.css" rel="stylesheet" type="text/css">


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
    <h1 class="header-title">选择银行卡</h1>
</header>


<div id="container"></div>
<section class="bg_fff">
	<div class="addCard">
    	<div class="dashedBold">
            <p class="tit"><cite class="icon"></cite>新增收款银行卡</p>
            <p class="desc">最多可保存3张银行卡</p>
        </div>
    </div>
</section>
</body>
<script src="<?php echo R;?>activity/base/js/zepto.min.js"></script>
<script src="<?php echo R;?>activity/base/js/underscore-template.js"></script>
<script type="text/javascript" src="http://res.wx.qq.com/open/js/jweixin-1.0.0.js"></script><script src="<?php echo R;?>activity/base/js/base.js"></script>
<script src="<?php echo R;?>activity/base/js/underscore.min.js"></script>
<script src="<?php echo R;?>activity/selectCard/js/selectCard.js"></script>
<script type="text/template" id="each_template">
	<%_.each(obj,function(e,i){%>
		<section class="bg_fff">
			<div class="cardWrap">
			
			<a href="activity-distill.html?cardId=<%=e.id%>" class="cardMod fix">
				<p class="tit">
					<span class="name"><%=e.name%></span>
					<cite class="icon"><img src="<%=e.src%>" width="36" height="36"></cite>
					<span><%=e.bank_name%></span>
				</p>
					<% var cardValue = "" %>
					<% var tempStr = e.bank_number %>
					<% for( var i=0; i<tempStr.length; i+=4){%>
							<% cardValue += tempStr.substring(i,i+4) + " " %>
					<% } %>
				<p class="cardNum"><%=cardValue%></p>
			</a>
		</div>
			<p class="bt_bg"></p>
		</section>
	<%})%>  
</script>


</html>
