<!DOCTYPE html>
<html lang="en">
<body>
<link href="<?php echo R;?>js/colorpicker/style.css" rel="stylesheet">
<link href="<?php echo R;?>js/jquery-ui/jquery-ui.css" rel="stylesheet">
<script src="<?php echo R;?>js/jquery.js"></script>
<script src="<?php echo R;?>js/layer.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo R;?>css/layer.css">
<link rel="stylesheet" type="text/css" href="<?php echo R;?>css/layui.css">
<style type="text/css">
	.h5{ 
		overflow: hidden;
		
	}
	.h51{
		padding-left: 18%;
	}
	.h5n{
		border: 1px solid;
		width:350px;
		height:330px;
		margin-right: 10px;
		float: left;
		margin-left:10px;
	}
	.input{
		height:30px;
		width:190px;
		
	}
	.red{
		color: red;
	}
	.layui-layer-content{
		position:relative;
	}
	body, html {
        overflow: auto !important;
    }
    .select{
    	height: 34px;
	    width: 120px;
	    margin-top: 60px;
    }
</style>
<form class="form-horizontal tasi-form" method="post" action="?m=workitems&f=workitem&v=add<?php echo $this->su();?>" id="wz-form">
  <ul  class="h5 h51">
     <li class='h5n'>
            <input type="hidden" name="activity_type" value='2'>
            <input type="hidden" name="sourceId" value='<?echo $sourceId?>'>
	        <div class="layui-form-label share">
		        <label class="labelr" style="margin-left:10px;margin-top:10px;"><span class='red'>*</span>活动列表名称</label>
		        <input type="text" name="activityname" id="activityname_n" class="input" style="margin-top:10px;"placeholder="描述（建议1-15字符之间）"  value="" ></span>
	        </div>
	        <div class="layui-form-label">
	         <label class="labelr" style="margin-left:10px;">是否显示标题栏</label>
	          <span style='margin-top: 10px;margin-left: 10px;'> 
	            <input name="headline" type="radio" value="1"  checked="" class="headline" />是
	            <input name="headline" type="radio" value="2"  class="isheadline"/>否
	          </span>
	        </div><br/>
		    <div class="layui-form-label headlineh" >
		         <label class="labelr" style="margin-left:10px;"><span class='red'>*</span>标题栏名称</label>
		         <input type="text" name="activitytitle" id='name_n' class="input" placeholder="描述（建议1-8字符之间）"value="" >                
		    </div>
		    <div class="layui-form-label">
	         <label class="labelr" style="margin-left:10px;">是否显示底部导航</label>
	          <span style='margin-top: 10px;margin-left: 10px;'> 
	            <input name="navigation" type="radio" value="1"  checked="" />是
	            <input name="navigation" type="radio" value="2"  />否
	          </span>
	        </div>
	         <div class="layui-form-label">
	         <label class="labels" style="margin-left:10px;">是否显示在线咨询按钮</label>
	          <span style='margin-top: 10px;margin-left: 10px;'> 
	            <input name="consult" type="radio" value="1"  checked="" />是
	            <input name="consult" type="radio" value="2"  />否
	          </span>
	        </div>
	         <div class="layui-form-label">
	         <label class="labelr" style="margin-left:10px;">是否显示公共底</label>
	          <span style='margin-top: 10px;margin-left: 10px;'> 
	            <input name="floor" type="radio" value="1"  checked="" />是
	            <input name="floor" type="radio" value="2"  />否
	          </span>
	        </div>
     </li>   
     <li class='h5n'>
           <center><span style='top: 10px;position: relative;'>发标组件</span><br/>
            <span style="top:15px;position: relative;"> 
                <input type="radio" name="applybox"  value="1" checked="" class="applyboxShow">显示
                <input type="radio" name="applybox"  value="2" class="applyboxHide">隐藏
           </span></center><br/>
           <div class='applybox' style="margin-left:10px;">
           <div class="layui-form-label applys">
             <label class="labelf">区域选择</label>
              <span style='margin-top: 10px;margin-left: 10px;'> 
                  <input name="area" type="radio" class="radio" value="1" checked=""/>公司开通城市
                  <input name="area" type="radio" class="radio" value="2" />全国城市
                  <input name="area" type="radio" class="radio default"  />
                  <span class="defaults">默认城市</span>
              </span>
          </div>
           <div class="layui-form-label applys">
              <label class="labelr">报名人数基数</label>
              <input type="text" class="form-control input" id="Tosignup" name="tosignup"  value='' style="width:70px;height:30px;">                          
          </div>
           <div class="layui-form-label applys">
              <label class="labelr">报名按钮背景文案</label>
              <input type="text" class="form-control input" id="submitcopy" name="submitcopy"  value='' style="width:70px;height:30px;">                          
          </div>
           <div class="layui-form-label applys">
              <label class="labelr">提交按钮背景颜色</label>
              <input type="text" class="form-control input" id="buttoncolor" name="buttoncolor"  value='' style="width:70px;height:30px;"><br/>                       
          </div>
           <div class="layui-form-label applys">
              <label class="labelr">提交按钮文案颜色</label>
              <input type="text" class="form-control input" id="buttoncopycolor" name="buttoncopycolor"  value='' style="width:70px;height:30px;"><br/>                       
          </div>
           <div class="layui-form-label applys">
              <label class="labelr">报名人数颜色</label>
              <input type="text" class="form-control input" id="numbercolor" name="numbercolor"  value='' style="width:70px;height:30px;"><br/>                       
          </div>
           <div class="layui-form-label applys">
              <label class="labels" style="height: 32px;">报名人数提示语颜色</label>
              <input type="text" class="form-control input" id="cuewords" name="cuewords"  value='' style="width:70px;height:30px;"><br/>                     
           </div>
        </div>
     </li>
     <li class='h5n'>
	         <center><span style='top: 10px;position: relative;'>分享</span></center><br/>
	          <div style="margin-left:10px;">
	         <div class="layui-form-label share">
	         <label class="labelf"><span class='red'>*</span>分享图标</label>
		          <input type="text" value="" ondblclick="img_view(this.value);" class="form-control" id="share_n" name="share" size="100" style="width:230px;margin-right:5px;position:relative;" placeholder='300px*300px'>
		          <button type="button" class="btn btn-white" onclick="openiframe('/index.php?m=attachment&amp;f=index&amp;v=upload_dialog&amp;callback=callback_thumb_dialog&amp;htmlid=share_n&amp;limit=1&amp;htmlname=setting%5Bshare_n%5D&amp;ext=png%7Cjpg%7Cgif%7Cdoc%7Cdocx&amp;token=3d9292f4c141b7f9c4f3a37f8af2e607&amp;_menuid=29&amp;_submenuid=67','share_n','loading...',810,400,1)" style="height: 28px;">上传图标</button>
	        </div>
	        <div class="layui-form-label share" style="margin-top:5px;">
	        <label class="labelf"><span class='red'>*</span>分享标题</label>	
	          <textarea style="width:230px;height:30px;margin-left:10px;" name="sharetitle" id='sharename_n' placeholder="24个字符以内"  ></textarea>
	        </div><br/>
	     	<div class="layui-form-label layui-form-area" style="margin-top:5px;">
	          <label style="height:30px;line-height:30px;width: 70px;"><span class='red'>*</span>分享描述
	          <textarea style="width:300px;margin-top:10px;height:50px;margin-left: -9px;" name="content" id="content_n" placeholder="34个字符以内"  ></textarea>
	        </div>
	        </div>
     </li> 
  </ul>
  <hr>
   <input name="submit"  class="save-bt btn btn-info" id="add_normal" value="新增内容" style="margin-left:30px;">
	   <table class="table table-striped table-advance table-hover" >
	     <thead>
	     <tr>
	         <th class="hidden-phone tablehead">ID</th>
	         <th class="tablehead">内容</th>
	         <th class="tablehead">链接</th>
	         <th class="tablehead">去广告（慎重！要花钱！）</th>
	         <th class="tablehead">跳转</th>
	         <th class="tablehead">管理操作</th>
	     </tr>
	     </thead>
	   </table>
       <div class="attaclist">
           <div id="activity_normal">
               <ul id="pic_ul">
               </ul>
              
            </div>
         </div>
   <center>
   	   <div>  
   	     <input name="submit" type="submit" class="save-bt btn btn-infos" id="wz-button-submit-normal-b"  onclick=""  value="保存" >
	   	 <input name="submit" type="submit" class="save-bt btn btn-infos" id="wz-button-submit-normal"  onclick=""  value="发布" >
	   </div>

</form>
<script>
    var SCOPE = {
     
    }
</script>
<script src="<?php echo R; ?>js/html5upload/extension.js"></script>
<script src="<?php echo R;?>js/jquery.nicescroll.js" type="text/javascript"></script>
</body>
</html>
