<?php defined('IN_WZ') or exit('No direct script access allowed');?>
<?php
include $this->template('header','core');
?>
<body class="body">
<style type="text/css">
	.h5{
		overflow: hidden;
	} 
	.h5n{
		border: 1px solid;
		width:350px;
		height:300px;
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
	::-webkit-scrollbar {
          width:10px;
    }
    ::-webkit-scrollbar-track {
          -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.5); 
          -webkit-border-radius: 10px;
          border-radius: 10px;
    }
    ::-webkit-scrollbar-thumb {
          -webkit-border-radius: 10px;
          border-radius: 10px;
          -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.5); 
    }
    ::-webkit-scrollbar-thumb:window-inactive {
        background: rgba(255,0,0,0.5); 
    }
    .wrapper{
      min-width: 1720px;
    }
      .select{
    	height: 34px;
	    width: 120px;
	    margin-top: 60px;
    }
</style>
<script src="<?php echo R;?>js/jquery.js"></script>
<script src="<?php echo R;?>js/layer.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo R;?>css/layer.css">
<section class="wrapper">
    <div class="row">
            <section class="panel">
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
    .btn-infos{
    	 width: 50px;
         height: 36px;
    }
</style>
<section class="wrapper">
    <div class="row">
        <section class="panel">
			<form class="form-horizontal tasi-form" method="post" action="?m=workitems&f=workitem&v=edit<?php echo $this->su();?>" id="wz-form">
			  <ul  class="h5">
			     <li class='h5n'>
			            <input type="hidden" name="id" value='<?php echo $arr['id']?>'>
			            <input type="hidden" name="activity_type" value='2'>
				        <div class="layui-form-label share">
					        <label class="labelr" style="margin-left:10px;margin-top:10px;"><span class='red'>*</span>活动列表名称</label>
					        <input type="text" name="activityname" id="activityname_n" class="input" style="margin-top:10px;"placeholder="描述（建议1-15字符之间）"  value="<?php echo $arr['activityname']?>" ></span>
				        </div>
				        <div class="layui-form-label">
				         <label class="labelr" style="margin-left:10px;">是否显示标题栏</label>
				          <span style='margin-top: 10px;margin-left: 10px;'> 
				           <input type="hidden" id="headlineType_n" value="<? echo $arr['headline']?>">
				            <input name="headline" type="radio" value="1"  checked="" class="headline" <?php if($arr['headline']==1){echo 'checked';}?>/>是
				            <input name="headline" type="radio" value="2"  class="isheadline" <?php if($arr['headline']==2){echo 'checked';}?>/>否
				          </span>
				        </div><br/>
					    <div class="layui-form-label headlineh" >
					         <label class="labelr" style="margin-left:10px;"><span class='red'>*</span>标题栏名称</label>
					         <input type="text" name="activitytitle" id='name_n' class="input" placeholder="描述（建议1-8字符之间）"value="<?php echo $arr['activitytitle']?>" >                 
					    </div>
					    <div class="layui-form-label">
				         <label class="labelr" style="margin-left:10px;">是否显示底部导航</label>
				          <span style='margin-top: 10px;margin-left: 10px;'> 
				            <input name="navigation" type="radio" value="1"  <?php if($arr['navigation']==1){echo 'checked';}?>/>是
				            <input name="navigation" type="radio" value="2"  <?php if($arr['navigation']==2){echo 'checked';}?>/>否
				          </span>
				        </div>
				         <div class="layui-form-label">
				         <label class="labels" style="margin-left:10px;">是否显示在线咨询按钮</label>
				          <span style='margin-top: 10px;margin-left: 10px;'> 
				            <input name="consult" type="radio" value="1"  <?php if($arr['consult']==1){echo 'checked';}?>/>是
				            <input name="consult" type="radio" value="2"  <?php if($arr['consult']==2){echo 'checked';}?>/>否
				          </span>
				        </div>
				         <div class="layui-form-label">
				         <label class="labelr" style="margin-left:10px;">是否显示公共底</label>
				          <span style='margin-top: 10px;margin-left: 10px;'> 
				            <input name="floor" type="radio" value="1"  <?php if($arr['floor']==1){echo 'checked';}?>/>是
				            <input name="floor" type="radio" value="2"  <?php if($arr['floor']==2){echo 'checked';}?>/>否
				          </span>
				        </div>
			     </li>   
			     <li class='h5n'>
			           <center><span style='top: 10px;position: relative;'>发标组件</span><br/>
			            <span style="top:15px;position: relative;"> 
			                <input type="hidden" id="applyboxTyle_n" value="<?php echo $arr['applybox']?>">
			                <input type="radio" name="applybox"  value="1" class="applyboxShow" <?php if($arr['applybox']==1){echo 'checked';}?>>显示
			                <input type="radio" name="applybox"  value="2" class="applyboxHide" <?php if($arr['applybox']==2){echo 'checked';}?>>隐藏
			           </span></center><br/>
			           <div class='applybox' style="margin-left:10px;">
			           <div class="layui-form-label applys">
			             <label class="labelf">区域选择</label>
			              <span style='margin-top: 10px;margin-left: 10px;'> 
			                  <input name="area" type="radio" class="radio" value="1" checked="" <?php if($arr['area']==1){echo 'checked';}?>/>公司开通城市
			                  <input name="area" type="radio" class="radio" value="2"  <?php if($arr['area']==2){echo 'checked';}?>/>全国城市
			                   <input name="area" type="radio" class="radio default" 
                                  <?php if($arr['area'] > 2){echo 'checked';}?>
			                   value="<?php echo $arr['area']?>" />
                               <span class="defaults"><?php echo $cname?></span>
			              </span>
			          </div>
			           <div class="layui-form-label applys">
			              <label class="labelr">报名人数基数</label>
			              <input type="text" class="form-control input" id="Tosignup" name="tosignup"  value='<?php echo $arr['tosignup']?>' style="width:70px;height:30px;">                          
			          </div>
			           <div class="layui-form-label applys">
			              <label class="labelr">报名按钮背景文案</label>
			              <input type="text" class="form-control input" id="submitcopy" name="submitcopy"  value='<?php echo $arr['submitcopy']?>' style="width:70px;height:30px;">                          
			          </div>
			           <div class="layui-form-label applys">
			              <label class="labelr">提交按钮背景颜色</label>
			              <input type="text" class="form-control input" id="buttoncolor" name="buttoncolor"  value='<?php echo $arr['buttoncolor']?>' style="width:70px;height:30px;"><br/>                       
			          </div>
			           <div class="layui-form-label applys">
			              <label class="labelr">提交按钮文案颜色</label>
			              <input type="text" class="form-control input" id="buttoncopycolor" name="buttoncopycolor"  value='<?php echo $arr['buttoncopycolor']?>' style="width:70px;height:30px;"><br/>                       
			          </div>
			           <div class="layui-form-label applys">
			              <label class="labelr">报名人数颜色</label>
			              <input type="text" class="form-control input" id="numbercolor" name="numbercolor"  value='<?php echo $arr['numbercolor']?>' style="width:70px;height:30px;"><br/>                       
			          </div>
			           <div class="layui-form-label applys">
			              <label class="labels" style="height: 32px;">报名人数提示语颜色</label>
			              <input type="text" class="form-control input" id="cuewords" name="cuewords"  value='<?php echo $arr['cuewords']?>' style="width:70px;height:30px;"><br/>                     
			           </div>
			        </div>
			     </li> 
			     <li class='h5n'>
				         <center><span style='top: 10px;position: relative;'>分享</span></center><br/>
				          <div style="margin-left:10px;">
				         <div class="layui-form-label share">
				         <label class="labelf"><span class='red'>*</span>分享图标</label>
					          <input type="text" value="<?php echo $arr['share']?>" ondblclick="img_view(this.value);" class="form-control" id="share_n" name="share" size="100" style="width:230px;margin-right:5px;position:relative;" placeholder='300px*300px'>
					          <button type="button" class="btn btn-white" onclick="openiframe('/index.php?m=attachment&amp;f=index&amp;v=upload_dialog&amp;callback=callback_thumb_dialog&amp;htmlid=share_n&amp;limit=1&amp;htmlname=setting%5Bshare_n%5D&amp;ext=png%7Cjpg%7Cgif%7Cdoc%7Cdocx&amp;token=3d9292f4c141b7f9c4f3a37f8af2e607&amp;_menuid=29&amp;_submenuid=67','share_n','loading...',810,400,1)" style="height: 28px;">上传图标</button>
				        </div>
				        <div class="layui-form-label share" style="margin-top:5px;">
				        <label class="labelf"><span class='red'>*</span>分享标题</label>	
				          <textarea style="width:230px;height:30px;margin-left:10px;" name="sharetitle" id='sharename_n' placeholder="24个字符以内"  ><?php echo $arr['sharetitle']?></textarea>
				        </div><br/>
				     	<div class="layui-form-label layui-form-area" style="margin-top:5px;">
				          <label style="height:30px;line-height:30px;width: 70px;"><span class='red'>*</span>分享描述
				          <textarea style="width:300px;margin-top:10px;height:50px;margin-left: -9px;" name="content" id="content_n" placeholder="34个字符以内"><?php echo $arr['content']?></textarea>
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
				         <th style="position: absolute;margin-left: -30%;">跳转</th>
				         <th class="tablehead">管理操作</th>
				     </tr>
				     </thead>
				   </table>
			    <div class="attaclist">
			        <div id="activity_normal">
			             <ul id="pic_ul">
                            <? 
                            if(!empty($data)){
                            foreach ($data as $k => $va) {?>
			             	 <li id="file_node_<?php echo $va['ids']?>" <?if($va['icon'] == "shuffling")echo "class='shuffling'";?>>
			             	       <table class="table table-striped table-advance table-hover">
			             	          <tr>
			             	             <td style="width:100px;margin-right:18px"> 
			             	                  <span class="liNum" style="font-family:Arial Black;position: relative;top:45px;"><?php echo $va['ids']?></span>
			             	                   <input style="" type="hidden" name="form[activity_normal][picimg][]"  value="<?php echo $va['picimg']?>">
			             	                  <input type="hidden" name="form[activity_normal][ids][]" value="<?php echo $va['ids']?>" class="ids">
			             	                  <img src="<?php echo getMImgShow($va['picimg'],'original')?>"  onclick="img_viewss(this.src);" style="margin-left: 101px;">
			             	             </td>
			             	           
                                     <span style="<?php if($va['type'] == 'draw') echo 'display:none;'?>">
                                     
			             	            <td>
			             	              <?php if($va['type'] != 'bidding'){?>
	             	                        <input type="text" name="form[activity_normal][picurl][]" value="<?php echo $va['picurl']?>"
	             	                     style="width:270px;height: 30px; margin-left:-30px;margin-top: 19px;<?if($va['jump'] != '无' && $va['jump']!="") echo "display: none;"?>" >
	             	                    <?}else{?>
                                            <input type="hidden" name="form[activity_normal][picurl][]" value="<?php echo $va['picurl']?>" style="width:270px;height: 30px; margin-left:-30px;margin-top: 19px;<?if($va['jump'] != '无' && $va['jump']!="") echo "display: none;"?>" >
			             	               <?}?>      
			             	            </td>     
	             	                  
                                      </span>
			             	                    <span style='position: relative;top: 10px;'>
                                         <span style="<?php if($va['type'] == 'draw') echo 'display:none;'?>">
                                           <td >
			             	                      <?php if($va['type'] != 'bidding'){?>
				             	                    <input type="hidden" class="picout" name="form[activity_normal][picout][]" value="0">
				             	                    <input class="out"  type="checkbox"  style="margin-left:251px;" <?php if($va['picout']==1){echo 'checked';}?> <?php if($va['type']!='vim'){echo 'disabled';}?> />去掉
				             	                       <?}?>
	                                                </td>
	                                                </span>
	                                                <td>

	                                                <span style="margin-left:50px; ">
                                                   
                                                        <input class="jump" type="checkbox" value="0" <?if($va['jump'] != '无' && $va['jump']!="") echo "checked"?>/>跳转
			             	                             <input type="text" name="form[activity_normal][jump][]" value="<?php echo $va['jump']?>" style="width:20px;<?if($va['jump'] != '无' && $va['jump'] == "") echo "display:none;"?>" />
                                                        
	                                                </span>
	                                        </td>
	                                             </span>
                                                <td>
	                                                   <img <?php if($va['type'] != 'bidding'){echo 'style="min-width:10px;width:20px;position: relative;left: 450px;"';}else{echo 'style="min-width:10px;width:20px;position: relative;left: 1000px;"';}?> src="<?php echo R;?>images/<?php echo $va['icon']?>.png"  />
					             	                    <a class="btn btn-danger btn-xs deleteLi" <?php if($va['type'] != 'bidding'){echo 'style="margin-left: 467px;"';}else{echo 'style="margin-left: 1016px;"';}?> >删除</a>
					             	                    <a style="background:#D8D8D8;" class="btn btn-xs" href="javascript:void(0);" onclick="moveup(this)">↑</a>
					             	                    <a style="background:#D8D8D8;" class="btn btn-xs" href="javascript:void(0);" onclick="movedown(this)">↓</a>
	                                               
	                                                

			             	                   </span>
			             	              </td>
			             	              <td>
			             	                    <input type="hidden" name="form[activity_normal][type][]" value="<?php echo $va['type']?>" class='shufinput'/>
			             	              </td>
			             	          </tr>
			             	           
			             	          <?php if(!empty($va['shuffling'])){
			             	          	foreach ($va['shuffling'] as $k => $v) {?>
				             	               <tr class="xiao[<?php echo $va['type']?>]" gaibian="change">
						             	          <td>
							             	           <img src="<?php echo getMImgShow($v['shufflingpic'],'original')?>" alt="小汉哥" onclick="img_viewss(this.src);" style="position:relative;min-width:10px;width: 50px;left: 197px;">
							             	          <input  type="hidden" name="xiao[<?php echo $va['type']?>][shufflingpic][]" value="<?php echo $v['shufflingpic']?>" class="imgname">
						             	          </td>
						             	          <td>
						             	          		<input type="text" name="xiao[<?php echo $va['type']?>][shufflingurl][]" value="<?php echo $v['shufflingurl']?>" style="width: 214px;height: 22px; position: absolute;left: 304px;margin-top: -16px;" placeholder="图片url连接(如:http://m.uzhuang.com)" class="urlname">
						             	          </td>
						             	          <td>
						             	          	    <div style="position: absolute;left: 684px;margin-top: -14px;"><input type="checkbox"  disabled/>去掉</div>
						             	          </td>
						             	          <td>
						             	                <a class="btn btn-danger btn-xs"  style="position: absolute;left:1000px;margin-top: -14px;" onclick="lingsde(this)">删除</a>
						             	          </td>
				             	               </tr>
			             	           <?}?>
			             	           
			             	               <tr class="xiao[<?php echo $va['type']?>]" gaibian="lasttr">
						             	          <td>
						             	          <div class="<?php echo $va['type']?>" gaibian="trhidediv">
						             	          	  <span>
						             	          	  </span>
						             	          </div>
						             	          </td>
						             	   </tr>
						             	   <td>
			             	              <input  type="submit" class="save-bt" onclick="goAdd('<?php echo $va["type"]?>');return false" value="继续添加" >
			             	             </td>
			             	         <?}?>
			             	       </table>
			             	  </li>
			             	 <?}}?>
			             </ul>
			        </div>
			    </div>
			   	   <div>
			   	   <center>
			   	     	<input name="submit" type="submit" class="save-bt btn btn-infos" id="wz-button-submit-normal"  onclick=""  value="发布" >
			   	   </center>
				   </div>
			</form>
        </section>
    </div>
</section>
<script src="<?php echo R; ?>js/html5upload/extension.js"></script>
<script src="<?php echo R;?>js/jquery.nicescroll.js" type="text/javascript"></script>
<script src="<?php echo R;?>js/activity/dialog.js"></script>
<script src="<?php echo R;?>js/activity/activity.js"></script>
