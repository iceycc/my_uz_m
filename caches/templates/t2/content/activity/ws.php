<?php defined('IN_WZ') or exit('No direct script access allowed'); ?><!doctype html>
<html>
<head>
<meta name="viewport" content="width=device-width,minimum-scale=1.0,maximum-scale=1.0, minimal-ui"/>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>无标题文档</title>
<link href="<?php echo R;?>activity/base/css/base.css" rel="stylesheet" type="text/css">


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
<!--<ul id="choose-city">
	<script type="text/template" id="index-located-template">
		<% for(var key in located){ %>
			<% var item = located[key] %>
			<% var current_class="";%>
			<% if(item.cityid==current_cityid){ %>
			<%	 current_class="current"; %>
			<% } %>
			<li city-id=<%=item.cityid+"  class="+current_class%>><%=item.city%></li>
		<% } %>
	</script>
</ul>-->

<ul id="choose-city">
	<script type="text/template" id="index-located-template">
		<% for(var key in located){ %>
			<% var item = located[key] %>
			<% var current_class="" %>
			<% if(item.cityid==current_cityid){ %>
			<%	 current_class="current"; %>
			<% } %>
			
			<p city-id="<%=item.cityid%>" class="<%=current_class%>" ><%=item.city%></p>
			<li city-id=<%=item.cityid+"  class="+current_class%> ><%=item.city%></li>
		<% } %>
	</script>
</ul>

<div id="container"></div>


</body>
<script src="<?php echo R;?>activity/base/js/zepto.min.js"></script>
<script src="<?php echo R;?>activity/base/js/underscore-template.js"></script>
<script src="<?php echo R;?>activity/base/js/base.js"></script>
<script type="text/javascript" src="http://res.wx.qq.com/open/js/jweixin-1.0.0.js"></script>
<script src="<?php echo R;?>activity/base/js/underscore.min.js"></script>

<script src="<?php echo R;?>activity/ws/js/ws.js"></script>
<!--<script>
    $(function(){
        var data=[{name:'carl'},{name:'carl'},{name:'carl'}];
        var t=_.template($("#tpl").html());
        $("#container").html(t(data));
    });
</script>-->
<script type="text/template" id="each_template">
    <%_.each(obj,function(e,i){%>
    <ul>
		<li><%=i%></li>
        <li><%=e.cityid%></li>
		<li><%=e.city%></li>
    </ul>
    <%})%>
</script>

<script>
tempData={
						name:"John",
						id:"Doe",
						age:[1,2,3],
						num:{
							x:11,
							y:22
							},
						color:{
							color_s:[111,222,333],
							color_b:[1111,2222,3333]
							}
					
					};
					console.log(tempData.name);
					console.log(tempData.age);
					console.log(tempData.num);
					console.log(tempData.num.x);
					console.log(tempData.color);
					console.log(tempData.color.color_s);
</script>
</html>
