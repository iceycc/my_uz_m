<?php defined('IN_WZ') or exit('No direct script access allowed'); ?><!doctype html>
<html>
<head>
<meta name="viewport" content="width=device-width,minimum-scale=1.0,maximum-scale=1.0, minimal-ui"/>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>推荐详情</title>
<link href="<?php echo R;?>activity/base/css/base.css" rel="stylesheet" type="text/css">
<link href="<?php echo R;?>activity/recommendedDetails/css/recommendedDetails.css" rel="stylesheet" type="text/css">


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
    <h1 class="header-title">推荐详情</h1>

</header>

<!--标题内容-->
<section class="title_masage"></section>

<section class="amount_room"></section>
<section class="signing"></section>

</body>
<script src="<?php echo R;?>activity/base/js/zepto.min.js"></script>
<script src="<?php echo R;?>activity/base/js/underscore-template.js"></script>
<script type="text/javascript" src="http://res.wx.qq.com/open/js/jweixin-1.0.0.js"></script><script src="<?php echo R;?>activity/base/js/base.js"></script>
<script src="<?php echo R;?>activity/base/js/underscore.min.js"></script>
<script src="<?php echo R;?>activity/recommendedDetails/js/recommendedDetails.js"></script>

<script type="text/template" id="title_masage_templete">
	<% var user = data; %>
	<section>
		<div class="bg">
			<dl class="userMod fix">
				<dt class="pic"><img src="<%=user.avatar%>" height="100"></dt>
				<% if( user.sex==1 ){ %>
				<% tempSex="先生" %>
				<% }else if( user.sex==2 ){ %>
				<% tempSex="女士" %>
				<% }else{%>
				<% tempSex="" %>
				<% } %>
				<dd class="name"><%=user.title%> <%=tempSex%></dd>
				<dd class="tel"><%=user.mobile%></dd>
			</dl>
			<dl class="homeMod">
				<dt class="tit"><%=user.areaid_2+user.address%></dt>
				<dd class="desc">
					<% if( user.area!=0 && user.area!="" && user.area!=null){ %>
					<span><%=user.area%>㎡</span>
					<% } %>

					<% if( user.budget!=0 && user.budget!="" && user.budget!=null){ %>
					<span><%=user.budget%>万元</span>
					<% } %>

				</dd>
			</dl>
		</div>
	</section>
</script>

<script type="text/template" id="amount_room_template">
	<% if(data.status_reason){ %>
		<div class="mode_title">量房红包</div>
		<% var progressData = data.status_reason; %>
		<ul class="detailsMod">
			<% for(var key = 0; key < progressData.length;key++){ %>

				<% var item = progressData[key] %>

				<% if( item.status==0 ){ %>
					<li class="success fix">
				<% }else{ %>
					<li class="fail fix">
				<% } %>
						<cite class="state"></cite>
						<cite class="num"><%= key+1 %></cite>
						<p class="tit"><%=item.title%></p>
						<% if(item.status == 1 && item.reason){ %>
							<p class="reason">原因 : <%= item.reason %></p>
						<% } %>
					</li>
			<% } %>
		</ul>
	<% } %>
</script>

<script type="text/template" id="signing_cont_template">
	<% if(data.sign_redbag){ %>
		<div class="mode_title">签约红包</div>
		<% var progressData = data.sign_redbag; %>
		<ul class="detailsMod">
			<% for(var key = 0; key < progressData.length;key++){ %>

			<% var item = progressData[key] %>

			<% if( item.status==0 ){ %>
			<li class="success fix">
				<% }else{ %>
			<li class="fail fix">
				<% } %>
				<cite class="state"></cite>
				<cite class="num"><%= key + 1 + data.status_reason.length %></cite>
				<p class="tit"><%=item.title%></p>
				<% if(item.status == 1 && item.reason){ %>
				<p class="reason">原因 : <%= item.reason %></p>
				<% } %>
			</li>
			<% } %>
		</ul>
	<% } %>
</script>
</html>
