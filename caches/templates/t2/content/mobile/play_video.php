<?php defined('IN_WZ') or exit('No direct script access allowed'); ?><!DOCTYPE html>
<html lang="en">
<head>
<meta name="viewport" content="width=device-width,minimum-scale=1.0,maximum-scale=1.0, minimal-ui"/>
<meta content="yes" name="apple-mobile-web-app-capable">
<!--iphone桌面快捷方式图标<link rel="apple-touch-icon" href="custom_icon.png">-->
<meta charset="utf-8">
<meta name="keywords" content="装修管家,量房设计,装修施工,材料商城,环保方案,装修服务,装修图库,建材商城,装修攻略、优装网、装修网、优装美家">
<meta name="description" content="优装美家为您提供免费专业咨询、免费量房、免费设计、免费装修保险、免费环保检测、优装网-专业装修网优选装修公司、优选建材商品、优选装修管家、优选环保服务">
<title>优装美家—管家式装修服务 有品质的低价</title>
<link href="<?php echo R;?>msite/base/css/base.css" rel="stylesheet" type="text/css">

<style type="text/css">
.icon-star_one, .icon-star_two {position: absolute; right: 0.5rem; top: 0.55rem; font-size: 1.5rem; color: #a9a9a9;}
.video-classroom {margin-top: 2.75rem; width: 100%;}
iframe {width: 100%; height: 11.25rem;}
</style>
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
<header>
	<div class="tit_minu">
        <a id="go-back" target="_self" title="优装美家">
            <i class="iconfont icon-goback"></i>
        </a>
        <a class="back_index" href="mobile-index.html">首页</a>
    </div>
	<h1 class="header-title">视频</h1>
	<i class="iconfont icon-star_one collect"></i>
</header>

<section class="video-classroom">
	<div class="c_video" id="youkuplayer">
    	<iframe id="frame" src="" frameborder=0 allowfullscreen></iframe>
    </div>
</section>


<script type="text/javascript" src="http://player.youku.com/jsapi"></script>
<script type="text/javascript" src="<?php echo R;?>msite/base/js/zepto.min.js"></script>
<script type="text/javascript" src="<?php echo R;?>msite/base/js/size.js"></script>
<script type="text/javascript" src="<?php echo R;?>msite/base/js/base.js"></script>
<script type="text/javascript" src="<?php echo R;?>msite/building_classroom/js/common.js"></script>
<script type="text/javascript">
$(function(){
	var video_url = getUrlParameter('videourl');
	var title = getUrlParameter('title');
  var video_id = getUrlParameter('id');
	var _vid = video_url.split('embed/')[1]; //获取视频vid

	$('.header-title').text(title);
	$('#frame').attr('src', video_url);

  collectStatus();
  $('.collect').on('click', collect);

  // 收藏操作
  function collect() {
    $.ajax({
      type: 'GET',
      url: '/index.php?m=wap&f=member&v=fav_decorate_class&type=decorate_class&id=' + video_id + '&pid=sp',
      dataType: 'json',
      timeout: 3000,
      success: function(res) {
        console.log(res)
        if(res) {
          if(res.code == 0) {
            alertConfirm("登录后才能收藏哦，去登录~");
            $("#confirm-layer").on('touchmove', function(event){
              event.preventDefault();
            })
          };
          if(res.code == 1) {
            var data = res.data;
            if(data.collectstatus == 1){
              $(".collect").removeClass("icon-star_one").addClass("icon-star_two");
              collectShow(res.message);
            }
            else{
              $(".collect").removeClass("icon-star_two").addClass("icon-star_one");
              collectShow(res.message);
            }
          }
        }
      }
    });
  }

  // 收藏状态
  function collectStatus() {
    $.ajax({
      type: 'GET',
      url: '/index.php?m=wap&f=zxkt_index&v=collection&id=' + video_id,
      dataType: 'json',
      timeout: 3000,
      success: function(res) {
        console.log(res)
        if(res && res.code == 1) {
          var data = res.data;
          if(data.collectstatus == 1){
            $(".collect").removeClass("icon-star_one").addClass("icon-star_two");
          }
          else{
            $(".collect").removeClass("icon-star_two").addClass("icon-star_one");
          }
        }
      }
    });
  }
});
</script>
</body>
</html>