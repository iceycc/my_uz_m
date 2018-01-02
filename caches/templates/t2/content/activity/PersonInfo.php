<?php defined('IN_WZ') or exit('No direct script access allowed'); ?><!doctype html>
<html>
<head>
<meta name="viewport" content="width=device-width,minimum-scale=1.0,maximum-scale=1.0, minimal-ui"/>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>帐号登录</title>
<link href="<?php echo R;?>activity/base/css/base.css" rel="stylesheet" type="text/css">
<link href="<?php echo R;?>activity/PersonInfo/css/PersonInfo.css" rel="stylesheet" type="text/css">
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
    <h1 class="header-title">个人信息</h1>

</header>

<section id="container">
	
</section>
<div class="windowBg" style="display:none;"></div>
<div class="alertDiv" style="display:none;">
	<div class="txt fix">
    	<input name="" type="text" class="int" id="int" value="信息">
        <cite class="close"></cite>
    </div>
    <div class="btn fix">
    	<input name="" type="reset" class="res" value="取消">
    	<input name="" type="submit" class="sub" value="确定">
    </div>
</div>

</body>
<script src="<?php echo R;?>activity/base/js/zepto.min.js"></script>

<script src="<?php echo R;?>activity/base/js/underscore.min.js"></script>
<script type="text/javascript" src="http://res.wx.qq.com/open/js/jweixin-1.0.0.js"></script><script src="<?php echo R;?>activity/base/js/base.js"></script>
<script src="<?php echo R;?>activity/PersonInfo/js/PersonInfo.js"></script>

<script type="text/template" id="each_template">
	<%var user=PersonInfo%>
	<ul class="userInfo">
    	<li>
        	<p class="tit">头像</p>
            <p class="pic"><img src="<%=user.avatar%>" width="90" height="90"></p>    
        </li>
    	<li id="name">
        	<p class="tit">昵称</p>
            <cite class="arrorIcon"></cite>
            <p class="desc"><%=user.nickname%></p>    
        </li>
		<li id="sex">
        	<p class="tit">性别</p>
            <cite class="arrorIcon"></cite>
            <p class="desc">
				<select id="sexSelect" >
					
					<option class="man" value="1" >男</option>
					<option class="woman" value="2" >女</option>
				</select>
			</p>    
        </li>
        <li id="code">
        	<p class="tit">二维码</p>
            <cite class="arrorIcon"></cite>
            <p class="code"></p>
        </li>
        <li class="btn">退出登录</li>
    </ul>
</script>


</html>
