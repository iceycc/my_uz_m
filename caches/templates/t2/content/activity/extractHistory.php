<?php defined('IN_WZ') or exit('No direct script access allowed'); ?><!doctype html>
<html>
<head>
<meta name="viewport" content="width=device-width,minimum-scale=1.0,maximum-scale=1.0, minimal-ui"/>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>提取历史</title>
<link href="<?php echo R;?>activity/base/css/base.css" rel="stylesheet" type="text/css">
<link href="<?php echo R;?>activity/extractHistory/css/extractHistory.css" rel="stylesheet" type="text/css">


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
    <h1 class="header-title">提取历史</h1>

</header>


<div id="container"></div>

</body>
<script src="<?php echo R;?>activity/base/js/zepto.min.js"></script>
<script src="<?php echo R;?>activity/base/js/underscore-template.js"></script>
<script type="text/javascript" src="http://res.wx.qq.com/open/js/jweixin-1.0.0.js"></script><script src="<?php echo R;?>activity/base/js/base.js"></script>
<script src="<?php echo R;?>activity/base/js/underscore.min.js"></script>
<script src="<?php echo R;?>activity/extractHistory/js/extractHistory.js"></script>
<script type="text/template" id="each_template">
	<%_.each(obj,function(e,i){%>

	<section class="bg_fff">
		<div class="infoMod fix">
			<div class="col-left">
				<p class="time"><%=e.addtime%></p>
				<p class="money"><cite class="icon">¥</cite><%=e.money%></p>
				
				<% var cardValue = "" %>
				<% var tempStr = e.bank_number %>
				<% for( var i=0; i<tempStr.length; i+=4){%>
						<% cardValue += tempStr.substring(i,i+4) + " " %>
				<% } %>
				
				<p class="cardNumber"><%=e.bank_name%> : <%=cardValue%></p>
			</div>
			<div class="col-right">
				<% var stateTxt="" %>
				<% var stateClass="" %>
				<% var stateStyle="" %>
				<% if(e.status=="提取中"){ %>
					<% stateTxt="提取中"%>
					<% stateClass="extraction"%>
					<p class="state <%=stateClass%>"><%=stateTxt%></p>
				<% } else if(e.status=="已打款"){%>
					<% stateTxt="已打款"%>
					<% stateClass="success"%>
					<p class="state <%=stateClass%>"><%=stateTxt%></p>
					<p class="success_info" >请注意查收</p>		
				<% }else if(e.status=="提取失败"){%>
					<% stateTxt="提取失败"%>
					<% stateClass="fail"%>
					<p class="state <%=stateClass%>"><%=stateTxt%></p>
					<span class="fail_btn">查看原因 &gt; </span>
					
				<% } %>
			</div>
		</div>
		<% if(e.status=="提取失败"){ %>
		<p class="error"><%=e.remark%></p>
		<% } %>
	</section>
	 <%})%>  
</script>
<script >
$(".infoMod .fail_btn").live("tap", function (event) {
	$(this).addClass("no");
	$(this).parents(".infoMod").siblings(".error").addClass("yes");
});    
</script>
</html>
