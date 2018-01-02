<?php defined('IN_WZ') or exit('No direct script access allowed');?>
<?php
include $this->template('headers','core');
?>
<body class="body">
<style type="text/css">
  #form6{
      margin-left:30px;
      margin-top:10px;  
  }
 fieldset{
      margin-bottom: 10px;
  }
  .element{
      text-align: center;
  }
  #module{
      margin-top:10px; 
  }
  body, html {
      overflow: auto !important;
  }
  .fen{
    margin-left: 100px;
  }
  .red{
    color:red;
    margin: 0 1px;
  }
 
  .h ,.staticadd,.vimadd,.carrouseladd,.applyadd{
    cursor:pointer;
  }
  .imsy,.titlesy{
    margin-top: 10px;
    margin-left: 10px;
  }
  .ifh5 {
  -webkit-appearance: none; /* remove default */
  display: block;
  margin: 10px;
  width: 24px;
  height: 24px;
  cursor: pointer;
  vertical-align: middle;
  box-shadow: hsla(0,0%,100%,.15) 0 1px 1px, inset hsla(0,0%,0%,.5) 0 0 0 1px;
  background-image: -webkit-radial-gradient( hsla(200,100%,90%,1) 0%, hsla(200,100%,70%,1) 15%, hsla(200,100%,60%,.3) 28%, hsla(200,100%,30%,0) 70% );
  background-repeat: no-repeat;
  -webkit-transition: background-position .15s cubic-bezier(.8, 0, 1, 1),
    -webkit-transform .25s cubic-bezier(.8, 0, 1, 1);
}

/* The up/down direction logic */

.ifh5,
.ifh5:active {
  background-position: 0 24px;
}
.ifh5:checked {
  background-position: 0 0;
}
</style>
<link href="<?php echo R;?>js/colorpicker/style.css" rel="stylesheet">
<link href="<?php echo R;?>js/jquery-ui/jquery-ui.css" rel="stylesheet">
<script src="<?php echo R;?>js/jquery.js"></script>
<script src="<?php echo R;?>js/layer.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo R;?>css/layer.css">
<link rel="stylesheet" type="text/css" href="<?php echo R;?>css/layui.css">
<section class="wrapper">
    <div class="row">
        <div class="col-lg-12">
            <section class="panel"><br/>
                <form action="?m=xin&f=content&v=add<?php echo $this->su();?>" class="form-inline"  id="form6" method="post">
                  <div style='margin-left: 30px;margin-bottom: 30px;overflow:hidden'>
                      <div style="float:left; margin-right:20px">
                        <span>普通</span>
                        <input type="radio" class='ifh5' id='NOH5' name="ifh5" value="1" checked />
                      </div>
                      <div style="float:left;">
                        <span style='margin-left: 5px;'>H5</span>
                        <input type="radio" class='ifh5' id='H5' name="ifh5"  value="2" />
                      </div>
                      <!-- <span>普通</span>&nbsp;&nbsp;<input type="radio" class='ifh5' name="name" checked />
                      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                      <span>H5</span>&nbsp;&nbsp;<input type="radio" class='ifh5' name="name" /> -->
                  </div>
                     <div class="layui-form-label share">
                         <label class="labelr" style="margin-left:10px;"><span class='red'>*</span>活动列表名称</label>
                         <input type="text" name="activityname" id="title" class="input" style="height:30px; width:300px;"placeholder="描述（建议1-15字符之间）" vlverify() value="" ><img src="" class="imsy ims" alt=""><span class='titlesy titles'></span>
                      </div><br/>
                       <div class="layui-form-label">
                         <label class="labelr" style="margin-left:10px;">是否显示标题栏</label>
                          <span style='margin-top: 10px;margin-left: 10px;'> 
                            <input name="headline" type="radio" value="1"  onclick="show('headlineh')" checked="" />是
                            <input name="headline" type="radio" value="2"  onclick="hide('headlineh')"/>否
                          </span>
                      </div><br/>
                      <div class="layui-form-label headlineh" >
                         <label class="labelr" style="margin-left:10px;"><span class='red'>*</span>标题栏名称</label>
                         <input type="text" name="activitytitle" id='name' class="input" style="height:30px; width:300px; " placeholder="描述（建议1-8字符之间）"value="" onblur="checks('name','0')"><img src="" class="imsy nameims" alt=""><span class='titlesy name'></span>                 
                      </div><br/>
<!--                       <div class="layui-form-label">
                       <label class="labelf" style="margin-left:10px;">公共顶</label>
                         <span style='margin-top: 10px;margin-left: 10px;'> 
                            <input name="iftop" type="radio" value="1" checked=""/>是
                            <input name="iftop" type="radio" value="2" />否
                         </span>
                      </div> -->
                      <div id='module' >
                       <fieldset>
                       <legend >组件</legend>
                          <div class="staticModule">
                            <fieldset>
                             <span class='staticadd'><img src="<?php echo R;?>images/add.png" alt="" style='width:20px'>增加</span>
                                <legend >图片组件  ---- <input type="text" name='static' class="element"   id='static'style="width:30px;height:10px;" class="element">---<span style="color:red" class="h5">640*高度不限（建议高度5000px）</span></legend>
                             <div class="attaclist"><div id="case"><ul id="case_ul"></ul></div><span class="input-group-btn">
                             <input type="hidden" name='case' value="case"> 
                             <button type="button" class="btn btn-white" onclick="openiframe('/index.php?m=attachment&amp;f=index&amp;v=upload_dialog&amp;callback=callback_hd&amp;htmlid=case&amp;limit=20&amp;width=1&amp;htmlname=form%5Bcase%5D&amp;ext=jpg%7Cpng%7Cgif%7Cbmp&amp;token=34f98e4c74f75c6701341b703f09917b&amp;_menuid=5002','case','loading...',810,400,20)">上传图片</button>
                            </fieldset>
                          </div>
                          <!--  静态图片上传 -->
                          <div class="carrouselModule" id="carrouselModule">
                          <fieldset >
                               <legend >轮播组件 ---- <input type="text" name='picture' id='picture' style="width:30px;height:10px;" class="element"></legend>
                              <span class='carrouseladd'><img src="<?php echo R;?>images/add.png" alt="" style='width:20px'>增加</span>
                            <div class="attaclist"><div id="carrousel"><ul id="case_ul"></ul></div><span class="input-group-btn">
                             <button type="button" class="btn btn-white" onclick="openiframe('/index.php?m=attachment&amp;f=index&amp;v=upload_dialog&amp;callback=callback_hd&amp;htmlid=carrousel&amp;limit=20&amp;width=1&amp;htmlname=form%5Bcarrousel%5D&amp;ext=jpg%7Cpng%7Cgif%7Cbmp&amp;token=34f98e4c74f75c6701341b703f09917b&amp;_menuid=5002','carrousel','loading...',810,400,20)">上传图片</button>
                          </fieldset>
                          </div>
                           <!--  轮播组件 -->
                          <div class="vimModule"> 
                            <fieldset>
                             <span class='vimadd'><img src="<?php echo R;?>images/add.png" alt="" style='width:20px'>增加</span>
                                <legend >视频组件 ---- <input type="text" name='video' class="element" id='video' style="width:30px;height:10px;" >----去广告<input type="checkbox" name="advertising" value="1"  style="margin-left:5px;position: relative;top: 2px;" class="advertising" onmouseover="showAdv(this)" />---<span style="color:red" class="h5 h1">640*330px</span></legend>
                               <div class="attaclist"><div id="vim"><ul id="case_ul"></ul></div><span class="input-group-btn" onclick="imgTip(this)" onmouseover="showBtn(this)">
                                   <button type="button" id="countLimit" class="btn btn-white vim"  onclick="openiframe('/index.php?m=attachment&amp;f=index&amp;v=upload_dialog&amp;callback=callback_vim&amp;htmlid=vim&amp;limit=1&amp;width=1&amp;htmlname=form%5Bvim%5D&amp;ext=jpg%7Cpng%7Cgif%7Cbmp&amp;token=34f98e4c74f75c6701341b703f09917b&amp;_menuid=5002','vim','loading...',810,400,20)">上传图片</button><br/>
                             </div>
                            </fieldset>
                          </div>
                          <!--  视频组件 -->
                      <div class="applyModule"> 
                          <fieldset id="applys">
                             <legend >
                               发标组件  ---- <input type="text" name='apply' id='apply' class="applys element" style="width:30px;height:10px;" >----

                               <span> 
                                    <input type="radio" name="applybox"  onclick="show('applys')"value="1" checked="">显示
                                    <input type="radio" name="applybox"  onclick="hide('applys')" value="2" >隐藏
                               </span>
                               </legend>
                                <span class='applyadd'><img src="<?php echo R;?>images/add.png" alt="" style='width:20px'>增加</span><br/>
                                <div id="applysxiao">
                                      <div class="layui-form-label applys">
                                         <label class="labelf">区域选择</label>
                                          <span style='margin-top: 10px;margin-left: 10px;'> 
                                              <input name="area" type="radio" class="radio" value="1" checked=""/>公司开通城市
                                              <input name="area" type="radio" class="radio" value="2" />全国城市
                                          </span>
                                      </div><br/> 
                                       <input type="text" value="" ondblclick="img_view(this.value);" class="form-control applys h5" id="attachment_test" name="background" size="100" style="width:300px;margin-right:5px;position:relative;" placeholder="背景640*430px" > 
                                      <button type="button"  style="" class="btn btn-white applys" onclick="openiframe('/index.php?m=attachment&amp;f=index&amp;v=upload_dialog&amp;callback=callback_thumb_dialog&amp;htmlid=attachment_test&amp;limit=1&amp;htmlname=setting%5Battachment_test%5D&amp;ext=png%7Cjpg%7Cgif%7Cdoc%7Cdocx&amp;token=3d9292f4c141b7f9c4f3a37f8af2e607&amp;_menuid=29&amp;_submenuid=67','attachment_test','loading...',810,400,1)">上传文件</button><br/><br/>
                                      <span class="test"></span>
                                       <div class="layui-form-label applys">
                                          <label class="labelr">报名人数基数</label>
                                          <input type="text" class="form-control input" id="Tosignup" name="Tosignup"  value='' style="width:150px;height:30px;">                          
                                      </div>
                                      <div class="layui-form-label applys">
                                          <label class="labelr">提交按钮文案</label>
                                          <input type="text" class="form-control input" id="submitcopy" name="submitcopy"  value='' style="width:150px;height:30px;"><br/>                       
                                      </div><br/>
                                       <div class="layui-form-label applys">
                                          <label class="labelr">提交按钮背景颜色</label>
                                          <input type="text" class="form-control input" id="buttoncolor" name="buttoncolor"  value='' style="width:80px;height:30px;"><br/>                       
                                      </div>
                                       <div class="layui-form-label applys">
                                          <label class="labelr">提交按钮文案颜色</label>
                                          <input type="text" class="form-control input" id="buttoncopycolor" name="buttoncopycolor"  value='' style="width:80px;height:30px;"><br/>                       
                                      </div>
                                       <div class="layui-form-label applys">
                                          <label class="labelr">报名人数颜色</label>
                                          <input type="text" class="form-control input" id="numbercolor" name="numbercolor"  value='' style="width:80px;height:30px;"><br/>                       
                                      </div>
                                       <div class="layui-form-label applys">
                                          <label class="labels">报名人数提示语颜色</label>
                                          <input type="text" class="form-control input" id="cuewords" name="cuewords"  value='' style="width:80px;height:30px;"><br/>                     
                                        </div>
                                </div>
                          </fieldset>
                          <!--  发标组件 -->
                       </div>
                       <div class="layui-form-label floor">
                         <label class="labels ">是否显示公共底</label>
                          <span style='margin-top: 10px;margin-left: 10px;'> 
                              <input name="floor" type="radio" value="1" checked=""/>是
                              <input name="floor" type="radio" value="2" />否
                          </span>
                      </div>
                       <div class="layui-form-label fen di">
                         <label class="labels">是否显示底部导航</label>
                          <span style='margin-top: 10px;margin-left: 10px;'> 
                              <input name="navigation" type="radio" value="1" checked=""/>是
                              <input name="navigation" type="radio" value="2" />否
                          </span>
                      </div>
                      <div class="layui-form-label fen">
                         <label class="labels">是否显示在线咨询按钮</label>
                          <span style='margin-top: 10px;margin-left: 10px;'> 
                              <input name="consult" type="radio" value="1" checked=""/>是
                              <input name="consult" type="radio" value="2" />否
                          </span>
                      </div>  

                      <br/>
                       <fieldset>
                         <legend >分享</legend>
                         <div class="layui-form-label share">
                           <label class="labelf"><span class='red'>*</span>分享图标</label>
                              <input type="text" value="" ondblclick="img_view(this.value);" class="form-control" id="share" name="share" size="100" style="width:300px;margin-right:5px;position:relative;" placeholder='300px*300px'>
                              <button type="button" class="btn btn-white" onclick="openiframe('/index.php?m=attachment&amp;f=index&amp;v=upload_dialog&amp;callback=callback_thumb_dialog&amp;htmlid=share&amp;limit=1&amp;htmlname=setting%5Bshare%5D&amp;ext=png%7Cjpg%7Cgif%7Cdoc%7Cdocx&amp;token=3d9292f4c141b7f9c4f3a37f8af2e607&amp;_menuid=29&amp;_submenuid=67','share','loading...',810,400,1)" style="height: 28px;">上传图标</button>
                          </div><br/>
                          <div class="layui-form-label share">
                           <label class="labelf"><span class='red'>*</span>分享标题</label>
                               <input type="text" name='sharename' id='sharename'style='width:450px; height:30px;' placeholder='24个字符以内' onblur="checks('sharename','1')"><img src="" class="imsy sharenameims" alt=""><span class='titlesy sharename'></span>
                          </div><br/>
                          <div class="layui-form-label layui-form-area share">
                              <label style="height:30px;line-height:30px;"><span class='red'>*</span>分享描述<img src="" style="margin-left: 10px;
                              margin-top: 7px;" class="sharecontentims" alt=""><span class='sharecontent'></label>
                              <textarea  name="content" placeholder="34个字符以内" id="sharecontent" onblur="checks('sharecontent','2')"></textarea>
                          </div>
                        </fieldset>
                    <input name="submit" type="submit" class="save-bt btn btn-info" id="baoG" onclick="mandatory()" onclick="baoGs()"  value="发布" >
                    &nbsp;&nbsp;&nbsp;&nbsp;
                    <input name="submit" type="submit" class="save-bt btn btn-info" id="baoGs" onclick="mandatory()" onclick="baoGs()"  value="保存" >
                 </form>
            </section>
        </div>
</section>

<script src="<?php echo R;?>js/bootstrap.min.js"></script>
<script src="<?php echo R;?>js/jquery.nicescroll.js" type="text/javascript"></script>
<script src="<?php echo R;?>js/pxgrids-scripts.js"></script>
<script src="<?php echo R;?>js/jquery-ui/jquery-ui.min.js" type="text/javascript"></script>
<script src="<?php echo R;?>js/jquery.ui.touch-punch.min.js" type="text/javascript"></script>
<link href="<?php echo R;?>css/style.css" rel="stylesheet">
<script src="<?php echo R; ?>js/html5upload/extension.js"></script>
<script src="<?php echo R; ?>js/html5upload/activity.js"></script>
<link href="{R}css/validform.css" rel="stylesheet" />
<script src="{R}js/validform.min.js"></script>
<script type="text/javascript" src="{R}js/validform.min.js"></script>
<script type="text/javascript">
    var a;
    $('#title').blur(function(){
       var name = $("#title").val();
       var namel = $("#title").val().length;
       if(namel>15){
            $(".ims").attr("src", "http://m.uzhuang.com/res/images/error.png"); 
            $('.titles').html('活动列表名称不得大于15个字符!');
            a='exist';
            return false;
        } 
       $.ajax({
          url:"?m=xin&f=content&v=checkNameExits<?php echo $this->su();?>",
          data:{'title':name},
          type:"POST",
          dataType:"json",
          success:function(data){
            if (data) {
              $(".ims").attr("src", "http://m.uzhuang.com/res/images/error.png"); 
              $('.titles').html('类表名已称存在！！');
               cl();
              a='exist';
            }else{
                if(name){
                 $(".ims").attr("src", "http://m.uzhuang.com/res/images/right.png"); 
                 $('.titles').html('类表名可以使用！！');
                 cl();
                  a='han';
              }
            }
          },
        })
    });
    function cl(){
        $('#title').click(function(){
           $("#title").val('');
           $('.titles').html('');
           $(".ims").attr("src", ""); 
        })
    }
    var num = 0;
    var car = 0;
    var vim = 0;
    var app = 0;
    $('.staticadd').click(function(){
      num++;
      var str = "'/index.php?m=attachment&amp;f=index&amp;v=upload_dialog&amp;callback=callback_imagesH&amp;htmlid=casem"+num+"&amp;limit=20&amp;width=1&amp;htmlname=form%5Bcasem%5D&amp;ext=jpg%7Cpng%7Cgif%7Cbmp&amp;token=34f98e4c74f75c6701341b703f09917b&amp;_menuid=5002','casem"+num+"','loading...',810,400,20"
      var strs='<div class="attaclists"><div id="casem'+num+'"><ul id="case_ul"></ul></div><span class="input-group-btn">'
         $(".staticModule").append('<div class="staticModules"><fieldset><legend >图片组件 ---- <input type="text" name="static'+num+'" class="element" style="width:30px;height:10px;" class="element">---- <span onclick="delmodule(this)" style="cursor:pointer;"><img src="<?php echo R;?>images/del.png"  style="width:30px">删除</span></legend>'+strs+'<button type="button" class="btn btn-white casem" onclick="openiframe('+str+')">上传图片</button></fieldset></div><input type="hidden" name="casem" value='+num+'>');
     });
    $('.carrouseladd').click(function(){
        car++;
        var str = "'/index.php?m=attachment&amp;f=index&amp;v=upload_dialog&amp;callback=callback_imagesH&amp;htmlid=carrousel"+car+"&amp;limit=20&amp;width=1&amp;htmlname=form%5Bcarrousel%5D&amp;ext=jpg%7Cpng%7Cgif%7Cbmp&amp;token=34f98e4c74f75c6701341b703f09917b&amp;_menuid=5002','carrousel"+car+"','loading...',810,400,20"
        var strs='<div class="attaclists"><div id="carrousel'+car+'"><ul id="case_ul"></ul></div><span class="input-group-btn">'
        $(".carrouselModule").append('<div class="staticModules"><fieldset><legend >轮播组件 ---- <input type="text" name="car'+car+'" class="element" style="width:30px;height:10px;" class="element">---- <span onclick="delmodule(this)" style="cursor:pointer;"><img src="<?php echo R;?>images/del.png"  style="width:30px">删除</span></legend>'+strs+'<button type="button" class="btn btn-white casem" onclick="openiframe('+str+')">上传图片</button></fieldset></div><input type="hidden" name="car" value='+car+'>');
    });
    $('.vimadd').click(function(){
        vim++;
        var str = "'/index.php?m=attachment&amp;f=index&amp;v=upload_dialog&amp;callback=callback_vim&amp;htmlid=vim"+vim+"&amp;limit=1&amp;width=1&amp;htmlname=form%5Bvim"+vim+"%5D&amp;ext=jpg%7Cpng%7Cgif%7Cbmp&amp;token=34f98e4c74f75c6701341b703f09917b&amp;_menuid=5002','vim"+vim+"','loading...',810,400,20"
        var strs='<div class="attaclists"><div id="vim'+vim+'"><ul id="case_ul"></ul></div><span class="input-group-btn" onmouseover="showBtn(this)" onclick="imgTip(this)">'
        $(".vimModule").append('<div class="staticModules"><fieldset><legend >视频组件 ---- <input type="text" name="vim'+vim+'" class="element" style="width:30px;height:10px;" class="element">----去广告<input type="checkbox" name="advertising'+vim+'" value="1"  style="margin-left:5px;position: relative;top: 2px;" class="advertising"  onmouseover="showAdv(this)"/>---- <span onclick="delmodule(this)" style="cursor:pointer;"><img src="<?php echo R;?>images/del.png"  style="width:30px">删除</span></legend>'+strs+'<button onmouseover="picCount(this)" type="button" class="btn btn-white casem" onclick="openiframe('+str+')">上传图片</button></fieldset></div><input type="hidden" name="vim" value='+vim+'>');
    });
    $('.applyadd').click(function(){
          /*曹植修改*/
          // 新增发标组件的个数
          var applyNo = parseInt($("#applysxiao").siblings('.applyModule').length);
          app++;
          var str = "'/index.php?m=attachment&f=index&v=upload_dialog&callback=callback_thumb_dialog&htmlid=attachment_test"+app+"&limit=1&htmlname=setting%5Battachment_test%5D&ext=png%7Cjpg%7Cgif%7Cdoc%7Cdocx&token=3d9292f4c141b7f9c4f3a37f8af2e607&_menuid=29&_submenuid=67','attachment_test"+app+"','loading...',810,400,1";

          var applyObj = '<div class="applyModule"><fieldset id="applys'+app+'"><legend >发标组件  ---- <input type="text" name="apply'+app+'" id="apply'+app+'" class="applys element" style="width:30px;height:10px;" >---- <span onclick="delmodule(this)" style="cursor:pointer;"><img src="<?php echo R;?>images/del.png"  style="width:30px">删除</span></legend><br/><div id="applysxiao'+app+'"><div class="layui-form-label applys"><label class="labelf">区域选择</label><span style="margin-top: 10px;margin-left: 10px;""><input name="area'+app+'" type="radio" value="1"  class="radio" checked=""/>公司开通城市<input name="area'+app+'" type="radio" value="2"  class="radio"/>全国城市</span></div><br/><input type="text" value="" ondblclick="img_view(this.value);" class="form-control applys h5" id="attachment_test'+app+'" name="background'+app+'" size="100" style="width:300px;margin-right:5px;position:relative;" placeholder="背景640*430px" ><button type="button" class="btn btn-white applys" onclick="openiframe('+str+')">上传文件</button><br/><br/><span class="test"></span><div class="layui-form-label applys"><label class="labelr">报名人数基数</label><input type="text" class="form-control input" id="Tosignup'+app+'" name="Tosignup'+app+'" style="width:150px;height:30px;"></div><div class="layui-form-label applys"><label class="labelr">提交按钮文案</label><input type="text" class="form-control input" id="submitcopy'+app+'" name="submitcopy'+app+'" style="width:150px;height:30px;"><br/></div><br/><div class="layui-form-label applys"><label class="labelr">提交按钮背景颜色</label><input type="text" class="form-control input" id="buttoncolor'+app+'" name="buttoncolor'+app+'" style="width:80px;height:30px;"><br/></div><div class="layui-form-label applys"><label class="labelr">提交按钮文案颜色</label><input type="text" class="form-control input" id="buttoncopycolor'+app+'" name="buttoncopycolor'+app+'"style="width:80px;height:30px;"><br/></div><div class="layui-form-label applys"><label class="labelr">报名人数颜色</label><input type="text" class="form-control input" id="numbercolor'+app+'" name="numbercolor'+app+'"  style="width:80px;height:30px;"><br/></div><div class="layui-form-label applys"><label class="labels">报名人数提示语颜色</label><input type="text" class="form-control input" id="cuewords'+app+'" name="cuewords'+app+'"  style="width:80px;height:30px;"><br/></div></div></fieldset><input type="hidden" class="applyNum" name="applyNum" value="'+app+'"></div>';
          if(!applyNo){
            $('#applysxiao').after(applyObj);
          }else{
            $('#applysxiao').siblings('.applyModule').last().after(applyObj);
          }
          // 将发标组件的个数保持到 .applyNum
          $(".applyNum").val(app);
         /*曹植修改*/
    });
    $(document).on('click','.radio',function(){
      $(this).attr('checked',true).siblings().removeAttr('checked');
    });
</script>

</body>
</html>
<script type="text/javascript">
  $('#H5').click(function(){
     $('.h5').html('640*1000px');
     $('.h5').attr('placeholder','背景640*1000px')
  })
  $('#NOH5').click(function(){
     $('.h5').html('640*高度不限（建议高度5000px）');
     $('.h1').html('640*330px');
     $('.h5').attr('placeholder','背景640*430px')
  })
</script>


