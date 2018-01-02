<!DOCTYPE html>
<html lang="en">
<body>
<?php
include $this->template('header','core');
?>
<link href="<?php echo R;?>js/colorpicker/style.css" rel="stylesheet">
<link href="<?php echo R;?>js/jquery-ui/jquery-ui.css" rel="stylesheet">
<script src="<?php echo R;?>js/jquery.js"></script>
<script src="<?php echo R;?>js/jquery-1.8.3.min.js" type="text/javascript"></script>
<script src="<?php echo R;?>js/layer.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo R;?>css/layer.css">
<link rel="stylesheet" type="text/css" href="<?php echo R;?>css/layui.css">
<link rel="stylesheet" href="<?php echo R;?>css/laydate.css">
<link rel="stylesheet" href="<?php echo R;?>css/laydates.css">
<style type="text/css">
   .head{
   	    width: 1300px;
	    height: 380px;
	    border: 1px solid;
	    margin: auto;
	    margin-bottom:10px; 
   }
   .banner{
   	    width: 1300px;
	    height: 100px;
	    border: 1px solid;
	    margin: auto;
	    margin-bottom:10px; 
   }
   .layui-form-label{
        margin-left: 49px;
   }
   .content{
   	    width: 1300px;
   	    border: 1px solid;
	    margin: auto;
	    margin-bottom:10px; 
	    padding-bottom: 30px;
   }
   .bidding{
   	    width: 1300px;
   	    border: 1px solid;
	    margin: auto;
	    margin-bottom:10px;
   }
   ul li{
   	  cursor:move;
   }
    body{
        overflow-y: scroll;
    }
     ::-webkit-scrollbar {
          width:10px;
      }
      ::-webkit-scrollbar-track {
          -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.1); 
          -webkit-border-radius: 10px;
          border-radius: 10px;
      }
      ::-webkit-scrollbar-thumb {
          -webkit-border-radius: 10px;
          border-radius: 10px;
          -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.1); 
      }
      ::-webkit-scrollbar-thumb:window-inactive {
          background: rgba(255,0,0,0.1); 
      }
</style>
<section class="wrapper">
    <div class="row">
        <section class="panel">
          <form class="form-horizontal tasi-form" method="post" action="?m=pc_activity&f=activity&v=activityAdd<?php echo $this->su();?>" >
               <div class="head">
               	   <span >
               	     <center>
               	       <i style="font-size:20px;position: relative;top: 10px;">基础信息模块</i>
               	       <hr style="height:2px;border-width:0;color:gray;background-color:gray;width:1200px;">
               	   	 </center>
               	   </span>
               	    <div class="layui-form-label">
				         <label class="labelr" style="margin-left:10px;">活动类型</label>
				         <span style='margin-left: 10px;'> 
			                  <input name="activity_type" type="radio" class="radio" value="1" checked=""/><i style="line-height: 24px;">标准</i>
			                  <input name="activity_type" type="radio" class="radio" value="2" /><i style="line-height: 24px;">特殊</i>
			             </span> 
				   </div><br/>
               	   <div class="layui-form-label">
				         <label class="labelr" style="margin-left:10px;">SEO关键词</label>
				         <input type="text" name="seo_keyword" id='seo_keyword' class="input" placeholder="如：优装网，生活家，全包活动" value="" style="height: 30px;width:806px;"><span style="color:red">一般不能超过100个字符</span>              
				   </div>
				   <div class="layui-form-label">
				         <label class="labelr" style="margin-left:10px;">SEO描述</label>
				         <textarea style="width:800px;" name="seo_description" id="seo_description" placeholder="如：优装美家德系整装是优装美家与生活共同合作推出，是一款利率超低、额度高、期限灵活、免抵押免担保，专门为用户解决装修资金周转的装修货款分期厂品"  ></textarea><span style="color:red">一般不能超过200个字符</span>                  
				   </div>
               </div>
               <div class="banner">
               	   <div class="layui-form-label">
				         <span style="margin-top:10px;font-size:15px;">banner图部分</span>
				   </div><br/>
				   <div class="layui-form-label" style="margin-top:10px;">
				         <label class="labelr">banner图宽度</label>
				         <input type="text" name="banner_width" id='banner_width' class="input" placeholder="1800" value="" style="height: 30px;width:60px;">  
				         <label class="labelr" style="line-height: 30px;width: 20px;margin-left: -5px;">PX</label>
				         <label class="labelr" style="margin-left:50px;">banner图上传</label>
				         <input type="text" value="" ondblclick="img_view(this.value);" class="form-control" id="banner" name="banner" size="100" style="width:230px;margin-right:5px;position:relative;" placeholder="背景640*430px" > 
                         <button type="button"  style="height: 28px;margin-left: -10px;" class="btn btn-white applys" onclick="openiframe('/index.php?m=attachment&amp;f=index&amp;v=upload_dialog&amp;callback=callback_thumb_dialog&amp;htmlid=banner&amp;limit=1&amp;htmlname=setting%5Bbanner%5D&amp;ext=png%7Cjpg%7Cgif%7Cdoc%7Cdocx&amp;token=3d9292f4c141b7f9c4f3a37f8af2e607&amp;_menuid=29&amp;_submenuid=67','banner','loading...',810,400,1)">上传文件</button>
                         <label class="labelr" style="margin-left:50px;">banner图图色值</label>
				         <input type="text" name="banner_color" id='banner_color' class="input" placeholder="#259add" value="" style="height:30px;width:100px;">  
				   </div>
               </div>
               <div class="content">
               	   <div class="layui-form-label" style="margin-top:10px;">
				         <span style="font-size:15px;">内容部分</span>
				          <button type="button" class="btn btn-white" style="margin-top: -7px;" onclick="openiframe('/index.php?m=attachment&amp;f=index&amp;v=upload_dialog&amp;callback=callback_pc_pic&amp;htmlid=content&amp;limit=20&amp;width=1&amp;htmlname=form%5Bcontent%5D&amp;ext=jpg%7Cpng%7Cgif%7Cbmp&amp;token=34f98e4c74f75c6701341b703f09917b&amp;_menuid=5002','content','loading...',810,400,20)">上传图片</button>
				   </div><br/>
				    <div class="attaclist">
					    <div id="content">
					       <ul id="pic_ul"></ul>
					    </div>
				    </div>
               </div>
               <div class="bidding">
               	   <div class="layui-form-label">
				         <span style="margin-top:10px;font-size:15px;">发标部分</span>
				   </div><br/>
				   <div class="layui-form-label" style="margin-top:10px;">
				     <label class="labelr">发标图上传</label>
				     <input type="text" value="" ondblclick="img_view(this.value);" class="form-control" id="bidding" name="bidding" size="100" style="width:230px;margin-right:5px;position:relative;" placeholder="背景640*430px" > 
                    <button type="button"  style="height: 28px;margin-left: -10px;" class="btn btn-white applys" onclick="openiframe('/index.php?m=attachment&amp;f=index&amp;v=upload_dialog&amp;callback=callback_thumb_dialog&amp;htmlid=bidding&amp;limit=1&amp;htmlname=setting%5Bbidding%5D&amp;ext=png%7Cjpg%7Cgif%7Cdoc%7Cdocx&amp;token=3d9292f4c141b7f9c4f3a37f8af2e607&amp;_menuid=29&amp;_submenuid=67','bidding','loading...',810,400,1)">上传文件</button>
                    <label class="labelr" style="margin-left:50px;">发标图色值</label>
				    <input type="text" name="bidding_color" id='bidding_color' class="input" placeholder="#259add" value="" style="height:30px;width:100px;">
                 </div>
                 <div class="layui-form-label" style="margin-top:10px;">
				     <label class="labelr">发标左侧图上传</label>
				     <input type="text" value="" ondblclick="img_view(this.value);" class="form-control" id="left_pic" name="left_pic" size="100" style="width:230px;margin-right:5px;position:relative;" placeholder="背景640*430px" > 
                    <button type="button"  style="height: 28px;margin-left: -10px;" class="btn btn-white applys" onclick="openiframe('/index.php?m=attachment&amp;f=index&amp;v=upload_dialog&amp;callback=callback_thumb_dialog&amp;htmlid=left_pic&amp;limit=1&amp;htmlname=setting%5Bleft_pic%5D&amp;ext=png%7Cjpg%7Cgif%7Cdoc%7Cdocx&amp;token=3d9292f4c141b7f9c4f3a37f8af2e607&amp;_menuid=29&amp;_submenuid=67','left_pic','loading...',810,400,1)">上传文件</button>
                    <label class="labelr" style="margin-left:50px;">select框色值</label>
				    <input type="text" name="left_pic_color" id='' class="input" placeholder="#259add" value="" style="height:30px;width:100px;">
                 </div>
               </div>
			   <center>
			         <input type="hidden" value="<?php echo $sourceID?>" name='sourceID'>
			   	     <input name="submit" type="submit" class="save-bt btn" id="btn-save"  onclick=""  value="发布" >
			   </center>
		  </form>
        </section>
    </div>
</section>
<script>
</script>
<script src="<?php echo R;?>js/html5upload/extension.js"></script>
<script src='<?php echo R;?>/js/laydate.js?<?php echo VERHASH; ?>'></script>
<script src="<?php echo R;?>js/jquery.nicescroll.js" type="text/javascript"></script>
<script src="<?php echo R;?>js/activity/pc_activity.js"></script>
<script src="<?php echo R;?>js/jquery-ui-1.9.2.min.js" type="text/javascript"></script>
</body>
</html>
