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

function  collectionState(){
	$.ajax({
		type:"post",
		url:"http://mdev.uz.com/index.php?m=wap&f=member&v=ren_onload",
		dataType: "json",
		data:{
			video_id:'1',
		},
		success:function(res){
			if(res.code == 1){
				$(".collection_button .iconfont").addClass('icon-star_two').removeClass('icon-star_one');
				$(".collection_button").addClass('collection_success');
			}else{
				$(".collection_button .iconfont").addClass('icon-star_one').removeClass('icon-star_two');
				$(".collection_button").removeClass('collection_success');
			}
		},
		error:function(err){
			console.log(err);
		}
	});
}
collectionState();
function collection(URL){
	$.ajax({
		type:"post",
		url:"http://mdev.uz.com/index.php?m=wap&f=member&v=fav_ren_class",
		dataType: "json",
		data:{
			video_id:'1',
			video_url:URL,
			video_title:'装修课堂'
		},
		success:function(res){
			if(res.code == 1){
				if(res.message == '收藏成功'){
					$(".collection_button .iconfont").addClass('icon-star_two').removeClass('icon-star_one');
					$(".collection_button").addClass('collection_success');
					collectShow(res.message);
				}else{
					$(".collection_button .iconfont").addClass('icon-star_one').removeClass('icon-star_two');
					$(".collection_button").removeClass('collection_success');
					collectShow(res.message);
				}
			}else{
				alertConfirm("登录后才能收藏哦，去登录~");
			}
		},
		error:function(err){
			//errorPrompt('收藏失败请重新尝试');
			alertConfirm("登录后才能收藏哦，去登录~");
		}
	});
}


$(function(){
	
	var maskBok = false;
	
	
	//微信弹层
	if(browser.versions.weixin){
		$('.share_button').on('touchstart',function(){
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
		//下载安卓弹层
		$('.c_zgapp_download_btn').on('touchstart',maskIfAndr);
	}
	if(navigator.userAgent.toLowerCase().search('android') != -1){
		$('.c_zgapp_download_btn').off('touchstart',maskIfAndr);
		//下载iphone弹层
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
	$(".collection_button").on('touchstart',function(){
		$("#close-times").html(5);
		collection($(".iframe_src").html());
		return false;
	});
});