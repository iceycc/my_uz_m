<!DOCTYPE html>
<html lang="en">
<body>
<?php
include $this->template('header','core');
?>
<link href="<?php echo R;?>js/colorpicker/style.css" rel="stylesheet">
<link href="<?php echo R;?>js/jquery-ui/jquery-ui.css" rel="stylesheet">
<script src="<?php echo R;?>js/layer.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo R;?>css/layer.css">
<link rel="stylesheet" type="text/css" href="<?php echo R;?>css/layui.css">
<link rel="stylesheet" href="<?php echo R;?>css/laydate.css">
<link rel="stylesheet" href="<?php echo R;?>css/laydates.css">
<style type="text/css">
	html {
		overflow: scroll;
	}

    #city{
    	 margin-left: 104px;

    }
    .chk_1{
	    display: none;
	}
	.chk_1 + label {
		background-color: #FFF;
		border: 1px solid #C1CACA;
		box-shadow: 0 1px 2px rgba(0, 0, 0, 0.05), inset 0px -15px 10px -12px rgba(0, 0, 0, 0.05);
		padding: 9px;
		border-radius: 5px;
		display: inline-block;
		position: relative;
		margin-right: 30px;
	}
	.chk_1 + label:active {
		box-shadow: 0 1px 2px rgba(0,0,0,0.05), inset 0px 1px 3px rgba(0,0,0,0.1);
	}
	.chk_1:checked + label {
		background-color: #A5CBEA;
		border: 1px solid #92A1AC;
		box-shadow: 0 1px 2px rgba(0, 0, 0, 0.05), inset 0px -15px 10px -12px rgba(0, 0, 0, 0.05), inset 15px 10px -12px rgba(255, 255, 255, 0.1);
		color: #243441;
	}
	.chk_1:checked + label:after {
		position: absolute;
		top: 0px;
		left: 0px;
		color: #758794;
		width: 100%;
		text-align: center;
		font-size: 1.4em;
		padding: 1px 0 0 0;
		vertical-align: text-top;
	}
	.xiao{
	    padding: 0 5px;
	    line-height: 30px;
	    border: none;
	    background-color: #99CC66;
	    color: #F1F1EB;
	    font-size: 10px;
	    -radius: 3px;
	    cursor: pointer;
	    height: 38px;
	}

	.hong{
        color:  #9D9D9D ;
        font-size: 20px;
        cursor:pointer;
        position: inherit;
    }
    .del{
	    padding: 0 5px;
	    line-height: 30px;
	    border: none;
	    background-color: #CC6672;
	    color: #F1F1EB;
	    font-size: 15px;
	    -radius: 3px;
	    cursor: pointer;
	}
	.layui-layer-title{
	    text-align: center;
	}
	.inline{
		display: inline-block;
	}
</style>
<section class="wrapper">
    <div class="row">
        <section class="panel">
          <form class="form-horizontal tasi-form" method="post" action="?m=pc_activity&f=activity&v=add<?php echo $this->su();?>" >
               <input type="hidden" value="<?php echo $res['id']?>" name="exercise_id" id="exercise_id">
	           <div class="layui-form-label headlineh" style='margin-top:20px;'>
			         <label class="labelr" style="margin-left:10px;"><span style="color:red">*</span>标题</label>
			         <input type="text" name="exercise_title" id='exercise_title' class="input xiao-input" placeholder="品质德系整装，拎包入住，159项全包，优装美家&生活家" value="<?php echo $res['exercise_title']?>" style="height: 30px;width: 395px;">
			   </div><br/>
			   <div class="layui-form-label headlineh" style='margin-top:20px;'>
			         <label class="labelr" style="margin-left:10px;">活动承接范围</label>
			         <span style="margin-top: 10px;margin-left: 10px;">
			         	 <input name="exercise_city" type="radio" value="1"  checked=""  class="isdredge_city" <?php if($res['exercise_city']==1){echo 'checked';}?>/>全部城市
	                     <input name="exercise_city" type="radio" value="2"  class="dredge_city" <?php if($res['exercise_city']==2){echo 'checked';}?>/>已开通城市
	                     <input type="hidden" class="exercise_city" value='<?php echo $res['exercise_city']?>'>
			         </span>
			   </div>
			   <div id='city' <?php if($res['exercise_city']!=2){?>style="display:none;"<?}	?>>
			     <?foreach ($cityData as $key => $city) {?>
			     	  <input type="checkbox" id="checkbox_a<?php echo $key;?>" class="chk_1" name='city[]'
			     	  <?php if(!empty($city['checked']) || empty($res['id'])){echo 'checked';}?> value='<?php echo $city['cityid']?>'/><label for="checkbox_a<?php echo $key;?>"><?php echo $city['city']?></label>
			     <?}?>
			   </div><br/>
			   <div class="layui-form-label headlineh" style='margin-top:20px;'>
			         <label class="labelr" style="margin-left:10px;">活动类型</label>
			         <span style="margin-left: 10px;">
				         <select name="exercise_type" class="form-control" style="height: 28px;">
	                            <option style="display:block;" value = "1"  <?php if($res['exercise_type']==1){echo 'selected';}?>>线上活动</option>
	                            <option style="display:block;" value = "2"  <?php if($res['exercise_type']==2){echo 'selected';}?>>线下活动</option>
	                     </select>
			         </span>
			   </div><br/>
			   <div class="layui-form-label headlineh" style='margin-top:20px;'>
			         <label class="labelr" style="margin-left:10px;"><span style="color:red">*</span>活动时间</label>
			         <span style="margin-left: 10px;">
						<div class="controls">
								<div class="pull-left info-list-wrap">
							<div class="clearfix">
								    <em style="line-height: 36px;">开始时间：</em>
									<input type="text" id="start_time" onclick="laydate({istime: true, format: 'YYYY-MM-DD'})" name="start_time" style=" width: 171px;height: 30px;" value='<?php echo isset($res['id']) ? date('Y-m-d',$res['start_time']) :''?>'>
									<em style="line-height: 36px;">结束时间：</em>
									<input type="text" id="end_time" onclick="laydate({istime: true, format: 'YYYY-MM-DD'})" name="end_time" style=" width: 171px;height: 30px;" value='<?php echo isset($res['id']) ? date('Y-m-d',$res['end_time']) :''?>'>
								</div>
							</div>
					   </div>
			         </span>
			   </div>
			   <div class="layui-form-label headlineh" style='margin-top:20px;'>
			         <label class="labelr" style="margin-left:10px;"><span style="color:red"></span>活动备注</label>
			         <input type="text" name="exercise_remarks" id='exercise_remarks' class="input xiao-input" placeholder="交定金送小狗…………"  style="height: 30px;width:496px;" value='<?php echo $res['exercise_remarks'];?>'>
			   </div><br/>
               <div class="layui-form-label headlineh" style='margin-top:20px;'>
			         <label class="labelr" style="margin-left:10px;"><span style="color:red"></span>选择装修公司</label>
			         <span class="xiao">添加公司</span>

			   </div><br/>
              <div style="overflow: auto;height: 123px;">
			          <table class="table table-striped table-advance table-hover" style="width: 80%;margin: 0 auto;
			          <?php if(empty($arr)){echo "display: none";}?>;">
	                     <tr>
	                         <th>装修公司名称</th>
	                         <th>付款比例</th>
	                         <th>佣金比例</th>
	                         <th>操作</th>
	                     </tr>
	                     <tbody id='company'>
                            <?  if(!empty($arr)){
                               foreach ($arr as $key => $ar){
                                   if(!empty($ar['payment_id'])){
                                   ?>
                                 <tr id="<?php echo $ar['comid']?>">
                                 	<td><?php echo $ar['companyname']?></td>
                                 	<td>(平台订单)<?php echo $ar['payment_name']?></td>
                                 	<td><?php echo $ar['commission']?></td>
                                 	<td><span class='del'  onclick='del(<?php $f = 1; echo $ar["comid"]?>)'>删除</span></td>
                                 	<input type='hidden' name='company[]' class='company_id' value="<?php echo $ar['comid']?>">
                                 	<input type='hidden' name='payment_id[]' class='company_id' value="<?php echo $ar['payment_id']?>">
                                 	<input type='hidden' name='method_id[]' class='company_id' value="<?php echo $ar['method_id']?>">
                                 </tr>
                                   <?php } ?>

                                   <?php if(!empty($ar['payment_id_zx'])){ ?>
                                       <tr id="<?php echo $ar['comid']?>a">
                                           <td><?php echo $ar['companyname']?></td>
                                           <td>(装修公司订单)<?php echo $ar['payment_name_zx']?></td>
                                           <td><?php echo $ar['commission_zx']?></td>
                                           <?php if($f != 1){ ?>
                                           <td><span class='del'  onclick="del('<?php echo $ar["comid"]?>a')">删除</span></td>
                                           <?php } ?>
                                           <input type='hidden' name='company_zx[]' class='company_id' value="<?php echo $ar['comid']?>">
                                           <input type='hidden' name='payment_id_zx[]' class='company_id' value="<?php echo $ar['payment_id_zx']?>">
                                           <input type='hidden' name='method_id_zx[]' class='company_id' value="<?php echo $ar['method_id_zx']?>">
                                       </tr>
                                   <?php } $f = 0;?>
                               <?}}?>
                         </tbody>
                      </table>
              </div>
			   <center>
			   	     <input name="submit" type="submit" class="save-bt btn" id="wz-button-submit"  onclick=""  value="保存" >
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
</body>
</html>
<script type="text/javascript">
	$('.xiao').click(function(){
	 	layer.open({
		    type: 1,
		    title:'装修公司选择',
		    skin: 'layui-layer-rim',
		    area: ['600px', '500px'],
		    content: '<center><form action="" class="form-inline"  method="post"><input type="text" name="title" placeholder="输入装修公司名字或关键词" class="input" value="" id="title"><span class="btn adsr-btn" onclick="Search()"><i class="icon-search"></i></span></form><br><div class="list"><?php  foreach($company as $com){?><strong ><a  class="hong layui-layer-close"  onclick="hong(this,<?php echo $com[id]?>)"><?php  echo $com[title]."<br/>"; ?></a></strong><?}?></center>'
            });
	});
    function hong(eleObj,comid){
    	    var xiao = '';
	        $(".company_id").each(function(){
	             var company_id = parseInt($(this).val());
	             if(comid == company_id){
	             	$('.layer-anim,.layui-layer-shade').remove();
	             	layer.msg('此装修公司已选择！', function(){
	             	});
	             	xiao = 'being';
	              }
	        });
	        if(xiao){
	        	xiao = '';
	        	return false;
	        }
    	    url = '?m=pc_activity&f=activity&v=activityName<?php echo $this->su();?>';
			postData = {'comid':comid}
		   $.post(url,postData,function(data){
		       //平台
		 	  var options = '';
		 	  var options_method = '';
		 	  //装修
		 	  var options_zx = '';
		 	  var options_method_zx = '';
		 	  var res = data.pt;

		 	  var zxres = data.zx;
		 	  //平台单比例
		 	  $(res.company_payment).each(function(i,n){
		 	  	options += '<option value="'+n.payment_id+'">'+n.payment_name+'</option>';
		 	  });
		 	  //平台单佣金
		 	  $(res.company_payment_method).each(function(i,n){
		 	  	options_method += '<option value="'+n.method_id+'">'+n.commission+'</option>';
		 	  });

               //装修单比例
               $(zxres.company_payment_zx).each(function(i,n){
                   options_zx += '<option value="'+n.payment_id+'">'+n.payment_name+'</option>';
               });
               //装修单佣金
               $(zxres.company_payment_method_zx).each(function(i,n){
                   options_method_zx += '<option value="'+n.method_id+'">'+n.commission+'</option>';
               });

		 	  layer.open({
			    type: 1,
			    title:res.companyname,
			    skin: 'layui-layer-rim',
			    area: ['350px', '250px'],
			    content:
                //平台单
                    '<div style="float: left;padding-left: 10px;">'+
                    '<span class=" inline" style="position: relative;top: 8px; width: 120px;">'+
                    '<input type="checkbox" name="order[]" value="1" onclick="choosept()"> 平台订单'+
                    '</span>'+
                    '<span class=" inline" style="width: 82px;position: relative;top: 8px;">付款比例</span>'+
                    '<select id="company_payment" class="form-control inline" style="height:16px;width: 100px;position: relative;top: 8px;" onchange="company_payment_method.options[selectedIndex].selected=true">'+
                    options+
                    '</select><br/><br/>'+
                    '<span class=" inline" style="position: relative;top: 8px; width: 120px;">&nbsp</span>'+
                    '<span class=" inline" style="width: 82px;">佣金</span>'+
                    '<select id="company_payment_method" class="form-control inline" style="height:16px;width: 100px;" onchange="company_payment.options[selectedIndex].selected=true">'+
                    options_method+
                    '</select><br/><br/>'+


//装修单
                    '<span class=" inline" style="position: relative;top: 8px; width: 120px;">'+
                    '<input type="checkbox" name="order[]" value="2"  onclick="choosezx()"> 装修公司订单'+
                    '</span>'+
                    '<span class=" inline" style="width: 82px;position: relative;top: 8px;">付款比例</span>'+
                    '<select id="company_payment_zx" class="form-control inline" style="height:16px;width: 100px;position: relative;top: 8px;" onchange="company_payment_method_zx.options[selectedIndex].selected=true">'+
                        options_zx+
                    '</select><br/><br/>'+
                    '<span class=" inline" style="position: relative;top: 8px; width: 120px;">&nbsp</span>'+
                    '<span class=" inline" style="width: 82px;">佣金</span>'+
                    '<select id="company_payment_method_zx" class="form-control inline" style="height:16px;width: 100px;" onchange="selB.options[selectedIndex].selected=true">'+
                        options_method_zx+
                    '</select><br/>'+
                        '<center>'+
                    '<button class="layui-btn layui-btn-small layui-layer-close" onclick="verify('+res.comid+',\''+res.companyname+'\')">确认</button></center>'+
                    '</div>'
	          });
			},'json');
	};
    $('company_payment').change(function(){
        $('#');
    });
    $('company_payment_method').change(function(){

    });
    $('company_payment_zx').change(function(){

    });
    $('company_payment_method_zx').change(function(){

    });
    var ispt = -1;
    var iszx = -1;
    //1选中 -1未选中
    function choosept(){
        ispt = -1*ispt;
    }
    function choosezx(){
        iszx = -1*iszx;
    }
	function verify(comid,companyname){

        if(iszx == 1)
        {
            var company_payment_zx = $('#company_payment_zx option:selected').text();
            var payment_id_zx = $('#company_payment_zx option:selected').val();
            var company_payment_method_zx = $('#company_payment_method_zx option:selected').text();
            var method_id_zx = $('#company_payment_method_zx option:selected').val();
            if(!payment_id_zx){
                payment_id_zx='';
            }
            if(!method_id_zx){
                method_id_zx='';
            }
            $('.table-hover').animate({ height: 'show', opacity: 'show' }, 'slow');
            $("#company").append("<tr id="+comid+" ><td>"+companyname+"</td><td><div class=\"inline\">(装修公司订单)</div>"+company_payment_zx+"</td><td>"+company_payment_method_zx+"</td><td><span class='del'  onclick='del("+comid+")'>删除</span></td><input type='hidden' name=\"company_zx[]\" class='company_id' value="+comid+"><input type='hidden' name=\"payment_id_zx[]\"  value="+payment_id_zx+"><input type='hidden' name=\"method_id_zx[]\"  value="+method_id_zx+"></tr>");
        }
        if(ispt==1)
        {
            var company_payment = $('#company_payment option:selected').text();
            var payment_id = $('#company_payment option:selected').val();
            var company_payment_method = $('#company_payment_method option:selected').text();
            var method_id = $('#company_payment_method option:selected').val();
            if(!payment_id){
                payment_id='';
            }
            if(!method_id){
                method_id='';
            }
            $('.table-hover').animate({ height: 'show', opacity: 'show' }, 'slow');
            $("#company").append("<tr id="+comid+"a ><td>"+companyname+"</td><td><div class=\"inline\">(平台订单)</div>"+company_payment+"</td><td>"+company_payment_method+"</td><td><span class='del'  onclick=\"del('"+comid+"a')\">删除</span></td><input type='hidden' name=\"company[]\" class='company_id' value="+comid+"><input type='hidden' name=\"payment_id[]\"  value="+payment_id+"><input type='hidden' name=\"method_id[]\"  value="+method_id+"></tr>");
        }
        ispt = -1;
        iszx = -1;
      }
	function Search(){
		var ti = $('#title').val();
		url = '?m=pc_activity&f=activity&v=searchTitle<?php echo $this->su();?>';
		postData = {'ti':ti}
		var str = ''
		$.post(url,postData,function(res){
			$(res).each(function(i){
		       str += '<strong ><a class="hong" onclick="hong(this,'+res[i]['id'] +')">'+ res[i]['title'] +'<br/></a></strong>'
			});
			$('.list').html(str)
	    },'json');
	};
</script>
