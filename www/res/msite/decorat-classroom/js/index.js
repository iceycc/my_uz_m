//微信分享
var url = encodeURIComponent(window.location.href.split("#")[0]);
wxShare(url, "Decoration", null);
function scaleImg() {
    var imgs = $(".in_live_list img");
    var boxW = imgs.parent().width(); //区域宽度
    var boxH = imgs.parent().height(); //区域高度
    var ratio = boxW/boxH;
    for(var i=0; i<imgs.length; i++) {
        imgs[i].onload = function(){
            var img = new Image();
            img.src = this.src;
            var imgW = img.width;
            var imgH = img.height;
            var imgRatio = imgW/imgH;
            if(ratio > imgRatio){
                var height_t=-((boxW/imgW)*imgH - boxH)/2;
                this.style.height = "auto";
         		this.style.marginTop = height_t + "px";
         		this.style.width = '100%';
            } else {
                var width_w=-((boxH/imgH)*imgW - boxW)/2;
                this.style.width = "auto";
                this.style.marginLeft = width_w + "px";
                this.style.height = '100%';
            }
        };
    }
}
var maskBok = false;
function maskIfAndr(){
	if(maskBok)return;
	$(".download_mask").show();
	$(".download_mask_close").on('touchstart',function(){
		$(".download_mask").hide();
		return false;
	});
	$(".download_mask").on('touchmove',function(){
		return false;
	});
	return false;
}


if(browser.versions.weixin){
	$('.icon-fenxiang1').on('touchstart',function(){
		$(".weixin_share").show();
		$(".weixin_share_close").on('touchstart',function(){
			$(".weixin_share").hide();
			return false;
		});
		$(".weixin_share").on('touchmove',function(){
			return false;
		});
		return false;
		
	});
	
	//下载
	$('.c_zgapp_download_btn').on('touchstart',maskIfAndr);
}
if(navigator.userAgent.toLowerCase().search('android') != -1){
	$('.c_zgapp_download_btn').off('touchstart',maskIfAndr);
	//下载
	$('.c_zgapp_download_btn').on('touchstart',function(){
		$(".mask_android").show();
		$(".mask_android_close").on('touchstart',function(){
			$(".mask_android").hide();
			return false;
		});
		$(".mask_android").on('touchmove',function(){
			return false;
		});
		return false;
		
	});
}