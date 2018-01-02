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
  .ims,.titles,.nims,.ntitles{
    margin-top: 10px;
    margin-left: 10px;
  }
</style>
<link href="<?php echo R;?>js/colorpicker/style.css" rel="stylesheet">
<script src="<?php echo R; ?>js/html5upload/activity.js"></script>
<link href="<?php echo R;?>js/jquery-ui/jquery-ui.css" rel="stylesheet">
<script src="<?php echo R;?>js/jquery.js"></script>
<script src="<?php echo R;?>js/layer.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo R;?>css/layer.css">
<link rel="stylesheet" type="text/css" href="<?php echo R;?>css/layui.css">
<section class="wrapper">
    <div class="row">
        <div class="col-lg-12">
            <section class="panel"><br/>
                <form action="?m=xin&f=content&v=editdata<?php echo $this->su();?>" class="form-inline"  id="form6" method="post">
                     <input type="hidden" name="hid" value="<?php echo $New['id']?>">
                     <input type="hidden" value="<?php echo $New['ifh5']?>" id="ish5">
                     <input type="hidden" value="<?php echo $New['applybox']?>" id="aBox">
                     <input type="hidden" value="<?php echo $New['iftitle']?>" id="istitle">
                     <div class="layui-form-label">
                         <label class="labelr" style="margin-left:10px;"><span class='red'>*</span>活动列表名称</label>
                         <input type="text" name="activityname" id="title" class="input" style="height:30px; width:300px;"placeholder="描述（建议1-15字符之间）" vlverify() value="<?php echo $New['activityname']?>" ids="<?php echo$New['id'] ?>"><img src="" class="ims" alt=""><span class='titles'></span>
                     </div><br/>
                     <div class="layui-form-label">
                         <label class="labelr" style="margin-left:10px;">是否显示标题栏</label>
                          <span style='margin-top: 10px;margin-left: 10px;'> 
                            <input name="headline" type="radio" value="1"  onclick="show('headlineh')" <?php if($New['iftitle']==1){echo 'checked';}?>/>是
                            <input name="headline" type="radio" value="2"  onclick="hide('headlineh')" <?php if($New['iftitle']==2){echo 'checked';}?>/>否
                          </span>
                      </div><br/>
                      <div class="layui-form-label headlineh">
                         <label class="labelr" style="margin-left:10px;"><span class='red'>*</span>标题栏名称</label>
                         <input type="text" name="activitytitle" id='name' class="input" style="height:30px; width:300px; " placeholder="描述（建议1-8字符之间）"value="<?php echo $New['activitytitle']?>">    <img src="" class="nims" alt=""><span class='ntitles'></span>          
                      </div><br/>
                      
                    <!--   <div class="layui-form-label">
                       <label class="labelf" style="margin-left:10px;">公共顶</label>
                         <span style='margin-top: 10px;margin-left: 10px;'> 
                            <input name="iftop" type="radio" value="1" <?php if($New['iftop']==1){echo 'checked';}?>/>是
                            <input name="iftop" type="radio" value="2" <?php if($New['iftop']==2){echo 'checked';}?>/>否
                         </span>
                      </div> -->

                      <div id='module' >
                       <fieldset>
                       <legend >组件</legend>
                          <div class="staticModule">
                            <fieldset>
                             <span class='staticadd'><img src="<?php echo R;?>images/add.png" alt="" style='width:20px'>增加</span>
                                <legend id="stat">图片组件  ---- 
                                 <?php  foreach ($sort as $s => $sv) {
                                    if($sv[caset]=='case'){?>
                                       <input type="text" name='static' class="element"  value='<?php  echo $sv[sort];?>' id='static' style="width:30px;height:10px;" class="element">---<?php if($New['ifh5']==1){?><span style="color:red" class="h5">640*高度不限（建议高度5000px）</span><?}elseif($New['ifh5']==2){?><span style="color:red" class="h5">640*1000px</span><?}?>
                                    <?}}?>
                                </legend>
                              <?php foreach ($Newdata as $key => $value) {
                                      if($value['caset']=='case'){?>
                                       <div class="attaclist" id="<?php echo $value[id]?>">
                                            <div >
                                                 <ul >
                                                     <img src="<?php echo getMImgShow($value[img],'original')?>"  alt="" onclick="img_viewss(this.src);" style="width:80px;margin-left:20px;"/>
                                                     <input type="text" name="listurl[]" value="<?php echo $value[url]?>" style="width:270px;height: 30px;margin-left:10px" >
                                                     <input type="text" name="lisbian[]" value="<?php echo $value[bian]?>" style="width:70px;height: 30px;margin-left: 30px;" placeholder="图片位置ID" >
                                                     <a class="btn btn-danger btn-xs" onclick="del(<?php echo $value[id]?>);" style="margin-left: 30px;">删除</a>
                                                     <input type="hidden" name='listid[]' value="<?php echo $value[id]?>">
                                                 </ul>
                                            </div>
                                      </div>
                              <?} }?>
                             <div class="attaclist"><div id="case"><ul id="case_ul"></ul></div><span class="input-group-btn">
                             <input type="hidden" name='case' value="case"> 
                             <button type="button" class="btn btn-white" onclick="openiframe('/index.php?m=attachment&amp;f=index&amp;v=upload_dialog&amp;callback=callback_hd&amp;htmlid=case&amp;limit=20&amp;width=1&amp;htmlname=form%5Bcase%5D&amp;ext=jpg%7Cpng%7Cgif%7Cbmp&amp;token=34f98e4c74f75c6701341b703f09917b&amp;_menuid=5002','case','loading...',810,400,20)">上传图片</button>
                            </fieldset>
                            <?php foreach ($caset as $c => $vc) {?>
                              <div class="staticModules" ids="<?php echo $vc?>">
                                <fieldset>
                                    <legend >图片组件 ---- 
                                      <?foreach ($sort as $s => $sv) {
                                        if($sv[caset]==$vc){
                                             $type=$sv[caset];
                                          ?>
                                            <input type="text"  id="<?php  echo $sv[id];?>" class="element " value='<?php  echo $sv[sort];?>'style="width:30px;height:10px;" class="element" onblur="upModules(<?php echo $sv[id]?>)" >
                                     <?}}?>
                                    ---- <span onclick="delsmodule('<?php echo $vc?>',this)" style="cursor:pointer;"><img src="<?php echo R;?>images/del.png"  style="width:30px">删除</span></legend>
                                     <?php  foreach($arr[$vc] as $a => $v){?>
                                        <div class="attaclist" id="<?php echo $v[id]?>" >
                                            <div >
                                                 <ul >
                                                     <img src="<?php echo getMImgShow($v[img],'original')?>"  alt="" onclick="img_viewss(this.src);" style="width:80px;margin-left:20px;"/>
                                                     <input type="text" name="listurl[]" value="<?php echo $v[url]?>" style="width:270px;height: 30px;margin-left:10px" >
                                                     <input type="text" name="lisbian[]" value="<?php echo $v[bian]?>" style="width:70px;height: 30px;margin-left: 30px;" placeholder="图片位置ID" >
                                                     <a class="btn btn-danger btn-xs" onclick="del(<?php echo $v[id]?>);" style="margin-left: 30px;">删除</a>
                                                     <input type="hidden" name='listid[]' value="<?php echo $v[id]?>">
                                                 </ul>
                                            </div>
                                       </div> 
                                    <?}?>
                                   <div class="attaclist"><div id="<?php echo  $type?>"><ul id="case_ul"></ul></div>
                                   <button type="button" class="btn btn-white casem" onclick="openiframe('/index.php?m=attachment&amp;f=index&amp;v=upload_dialog&amp;callback=moduleadd&amp;htmlid=<?php echo  $type?>&amp;limit=20&amp;width=1&amp;htmlname=form%5Bcarrousel%5D&amp;ext=jpg%7Cpng%7Cgif%7Cbmp&amp;token=34f98e4c74f75c6701341b703f09917b&amp;_menuid=5002','<?php echo  $type?>','loading...',810,400,20)">上传图片</button>
                                    </fieldset>
                               </div>
                            <?}?>
                          </div>
                          <!--  静态图片上传 -->
                          <div class="carrouselModule" id="clModule">
                          <fieldset >
                             <span class='carrouseladd'><img src="<?php echo R;?>images/add.png" alt="" style='width:20px'>增加</span>
                               <legend  id="pic">轮播组件 ---- 
                                  <?php  foreach ($sort as $s => $sv) {
                                    if($sv[caset]=='carrousel'){?>
                                       <input id="pict" type="hidden"  >
                                        <input type="text" name='picture' id='picture' style="width:30px;height:10px;" value='<?php  echo $sv[sort];?>' class="element">
                                 <?}}?>
                               </legend>
                             <?php foreach ($Newdata as $key => $value) {
                                  if($value['caset']=='carrousel'){?>
                                       <div class="attaclist" id="<?php echo $value[id]?>">
                                            <div >
                                                 <ul >
                                                     <img src="<?php echo getMImgShow($value[img],'original')?>"  alt="" onclick="img_viewss(this.src);" style="width:80px;margin-left:20px;"/>
                                                     <input type="text" name="listurl[]" value="<?php echo $value[url]?>" style="width:270px;height: 30px;margin-left:10px" placeholder="图片url连接(如:http://m.uzhuang.com)">
                                                     <input type="text" name="lisbian[]" value="<?php echo $value[bian]?>" style="width:70px;height: 30px;margin-left: 30px;" placeholder="图片位置ID" >
                                                     <a class="btn btn-danger btn-xs" onclick="del(<?php echo $value[id]?>);" style="margin-left: 30px;">删除</a>
                                                     <input type="hidden" name='listid[]' value="<?php echo $value[id]?>">
                                                 </ul>
                                            </div>
                                      </div>
                             <?}}?>
                            <div class="attaclist"><div id="carrousel"><ul id="case_ul"></ul></div>
                             <button type="button" class="btn btn-white" onclick="openiframe('/index.php?m=attachment&amp;f=index&amp;v=upload_dialog&amp;callback=callback_hd&amp;htmlid=carrousel&amp;limit=20&amp;width=1&amp;htmlname=form%5Bcarrousel%5D&amp;ext=jpg%7Cpng%7Cgif%7Cbmp&amp;token=34f98e4c74f75c6701341b703f09917b&amp;_menuid=5002','carrousel','loading...',810,400,20)">上传图片</button>
                          </fieldset>
                          </div>
                           <?php foreach ($casec as $ec => $cc) {?>
                                <div class="carModules" ids="<?php echo $cc?>">
                                    <fieldset>
                                          <legend >轮播组件 ---- 
                                          <?foreach ($sort as $s => $sv) {
                                            if($sv[caset]==$cc){
                                                $typc=$sv[caset];
                                             $sum= explode('carrousel', $sv[caset]);
                                              ?>
                                          <input type="text" name="car" class="element" value='<?php  echo $sv[sort];?>' style="width:30px;height:10px;" onblur="upModules(<?php echo $sv[id]?>)" id="<?php echo $sv[id]?>" >
                                           <?}}?>
                                          ---- <span onclick="delsmodule('<?php echo $cc?>',this)" style="cursor:pointer;"><img src="<?php echo R;?>images/del.png"  style="width:30px">删除</span></legend>
                                         <?php  foreach($arrc[$cc] as $ac => $vc){?>
                                                <div class="attaclist" id="<?php echo $vc[id]?>" >
                                                    <div >
                                                         <ul >
                                                             <img src="<?php echo getMImgShow($vc[img],'original')?>"  alt="" onclick="img_viewss(this.src);" style="width:80px;margin-left:20px;"/>
                                                             <input type="text" name="listurl[]" value="<?php echo $vc[url]?>" style="width:270px;height: 30px;margin-left:10px" placeholder="图片url连接(如:http://m.uzhuang.com)">
                                                             <input type="text" name="lisbian[]" value="<?php echo $vc[bian]?>" style="width:70px;height: 30px;margin-left: 30px;" placeholder="图片位置ID" >
                                                             <a class="btn btn-danger btn-xs" onclick="del(<?php echo $vc[id]?>);" style="margin-left: 30px;">删除</a>
                                                             <input type="hidden" name='listid[]' value="<?php echo $vc[id]?>">
                                                         </ul>
                                                    </div>
                                              </div> 
                                     <?}?>
                                     <div class="attaclists"><div id="<?php echo  $typc?>"><ul id="case_ul"></ul></div><span class="input-group-btn">
                                    <button type="button" class="btn btn-white casem" onclick="openiframe('/index.php?m=attachment&amp;f=index&amp;v=upload_dialog&amp;callback=moduleadd&amp;htmlid=<?php echo  $typc?>&amp;limit=20&amp;width=1&amp;htmlname=form%5Bcarrousel%5D&amp;ext=jpg%7Cpng%7Cgif%7Cbmp&amp;token=34f98e4c74f75c6701341b703f09917b&amp;_menuid=5002','<?php echo  $typc?>','loading...',810,400,20)">上传图片</button>
                                    </fieldset>
                                </div>
                           <?}?>
                           <!--  轮播组件 -->
                          <div class="vimModule"> 
                            <fieldset>
                             <span class='vimadd'><img src="<?php echo R;?>images/add.png" alt="" style='width:20px'>增加</span>
                                <legend >视频组件 <span id="vid">----</span>
                                   <?foreach ($sort as $s => $sv) {
                                            if($sv[caset]=='vim'){?>
                                                <input type="text" name='video' class="element" value="<?php echo $sv[sort]?>" id='video' style="width:30px;height:10px;" >
                                        ----去广告<input type="checkbox" name="advertising" value="<? echo $sv['ad']?>"  <?php if($sv['ad']==1){echo 'checked';}?> style="margin-left:5px;position: relative;top: 2px;" class="advertising" onmouseover="showAdv(this)" onclick="advertisement('<?php echo $sv[id]?>')" id="<?php echo 'g'.$sv[id]?>" />---<?php if($New['ifh5']==1){?><span style="color:red" class="h5">640*330px</span><?}elseif($New['ifh5']==2){?><span style="color:red" class="h5">640*1000px</span><?}?>

                                      <?}}?>
                              </legend>
                                 
                               <div class="attaclist"><div id="vim"><ul id="case_ul"></ul></div>
                                <?php foreach ($Newdata as $key => $value) {
                                      if($value['caset']=='vim'){?>
                                      <div class="attaclist" id="<?php echo $value[id]?>">
                                            <div >
                                                 <ul ><li>
                                                     <img src="<?php echo getMImgShow($value[img],'original')?>"  alt="" onclick="img_viewss(this.src);" style="width:80px;margin-left:20px;"/>
                                                     <input type="text" name="listurl[]" value="<?php echo $value[url]?>" style="width:410px;height: 30px;margin-left:10px;" placeholder="视频url连接(http://player.youku.com/embed/XMTU2MzEzMDUwMA==)">
                                                     <a class="btn btn-danger btn-xs" onclick="del(<?php echo $value[id]?>);" style="margin-left: 10px;">删除</a>
                                                     <input type="hidden" name='listid[]' value="<?php echo $value[id]?>">
                                                 </li></ul>
                                            </div>
                                      </div>
                                 <?}}?>
                               <span class="input-group-btn" onclick="imgTip(this)" onmouseover="showBtn(this)">
                                   <button type="button" id="countLimit" class="btn btn-white vim" onclick="openiframe('/index.php?m=attachment&amp;f=index&amp;v=upload_dialog&amp;callback=callback_vim&amp;htmlid=vim&amp;limit=1&amp;width=1&amp;htmlname=form%5Bvim%5D&amp;ext=jpg%7Cpng%7Cgif%7Cbmp&amp;token=34f98e4c74f75c6701341b703f09917b&amp;_menuid=5002','vim','loading...',810,400,20)">上传图片</button><br/>
                             </div>
                            </fieldset>
                          </div>
                           <?php foreach ($casev as $ev => $cv) {?>
                              <div class="vimModules" ids="<?php echo $cv?>" id="vModules">
                                   <fieldset>
                                         <legend >视频组件 ---- 
                                         <?foreach ($sort as $s => $sv) {
                                            if($sv[caset]==$cv){
                                              $typv=$sv[caset];
                                              ?>
                                                   <input type="hidden" name='<?php echo $cv?>'  value="<?php echo $sv[sort]?>" >
                                         <input type="text" name="vim" class="element" value="<?php echo $sv[sort]?>" style="width:30px;height:10px;" class="element" onblur="upModules(<?php echo $sv[id]?>)" id="<?php echo $sv[id]?>">
                                          ----去广告<input type="checkbox" name="advertising" value="<?php echo $sv['ad']?>"  <?php if($sv['ad']==1){echo 'checked';}?> style="margin-left:5px;position: relative;top: 2px;" class="advertising"  onmouseover="showAdv(this)" onclick="advertisement('<?php echo $sv[id]?>')" id="<?php echo 'g'.$sv[id]?>" />
                                         <?}}?>
                                        ---- <span onclick="delsmodule('<?php echo $cv?>',this)" style="cursor:pointer;"><img src="<?php echo R;?>images/del.png"  style="width:20px">删除</span></legend>
                                          <div class="attaclists"><div id="<?php echo $typv=$sv[caset];?>"><ul id="case_ul"></ul></div>
                                              <?php  foreach($arrv[$cv] as $va => $vv){?>
                                                <div class="attaclist" id="<?php echo $vv[id]?>" >
                                                    <div >
                                                         <ul ><li>
                                                             <img src="<?php echo getMImgShow($vv[img],'original')?>"  alt="" onclick="img_viewss(this.src);" style="width:80px;margin-left:20px;"/>
                                                             <input type="text" name="listurl[]" value="<?php echo $vv[url]?>"   style="width:410px;height: 30px;margin-left:10px;" placeholder="视频url连接(http://player.youku.com/embed/XMTU2MzEzMDUwMA==)">
                                                             <a class="btn btn-danger btn-xs" onclick="del(<?php echo $vv[id]?>);" style="margin-left: 12px;">删除</a>
                                                             <input type="hidden" name='listid[]' value="<?php echo $vv[id]?>">
                                                        </li></ul>
                                                    </div>
                                              </div> 
                                         <?}?>
                                          <span class="input-group-btn" onclick="imgTip(this)" onmouseover="showBtn(this)">
                                          <button onmouseover="picCount(this)" type="button" class="btn btn-white casem" onclick="openiframe('/index.php?m=attachment&amp;f=index&amp;v=upload_dialog&amp;callback=modulevadd&amp;htmlid=<?php echo $typv=$sv[caset];?>&amp;limit=20&amp;width=1&amp;htmlname=form%5Bvim%5D&amp;ext=jpg%7Cpng%7Cgif%7Cbmp&amp;token=34f98e4c74f75c6701341b703f09917b&amp;_menuid=5002','<?php echo $typv=$sv[caset];?>','loading...',810,400,20)">上传图片</button>
                                      </fieldset>
                              </div>
                           <?}?>
                          <!--  视频组件 -->
                          <!--  曹植修改开始 -->
                          <div class="applyModule"> 
                          <input type="hidden" name="" value="<?php echo $maxApplyCount;?>" id="maxApplyCount">
                            <?php 
                              $index = 0;
                              $applyNum = 0;
                              foreach ($appRes as $appkey => $appval) {
                                $name = $index==0?'':$index;
                                $index++;
                            ?>
                            <fieldset <?php if($index==1){?>id="applys"<?php }?>>
                               <legend>
                                 发标组件  ---- <input type="text" name="apply<?php echo $name;?>" id="apply" value="<?php echo $appval['sort'];?>" class="applys element" style="width:30px;height:10px;">----

                                 <span> 
                                  <?php 
                                    if($index==1){
                                  ?>
                                      <input type="radio" name="applybox" onclick="show('applys')" value="1" <?php if($appval!=2)echo 'checked';?>>显示
                                      <input type="radio" name="applybox" onclick="hide('applys')" value="2" <?php if($appval==2)echo 'checked';?>>隐藏
                                  <?php }else{?>
                                    <input type="hidden" class="applyId" value="<?php echo $appval['ex_id'];?>" id="">
                                    <span onclick="delApply(this,1)" style="cursor:pointer;"><img src="http://m.uzhuang.com/res/images/del.png" style="width:30px">删除</span>
                                  <?}?>
                                 </span>
                                 </legend>
                                  <?php if($index==1){?><span class="applyadd"><img src="http://m.uzhuang.com/res/images/add.png" alt="" style="width:20px">增加</span><br><?php }?>
                                  <div id="applysxiao">
                                        <div class="layui-form-label applys">
                                           <label class="labelf">区域选择</label>
                                            <span style="margin-top: 10px;margin-left: 10px;"> 
                                                <input name="area<?php echo $name;?>" <?php echo $appval['area']==1?'checked':'';?> type="radio" class="radio" value="1">公司开通城市
                                                <input name="area<?php echo $name;?>" <?php echo $appval['area']==2?'checked':'';?> type="radio" class="radio" value="2">全国城市
                                            </span>
                                        </div><br> 
                                         <input type="text" value="<?php echo $appval['background'];?>" ondblclick="img_view(this.value);" class="form-control applys h5" id="attachment_test<?php echo $name;?>" name="background<?php echo $name;?>" size="100" style="width:300px;margin-right:5px;position:relative;" placeholder="背景640*430px"> 
                                        <button type="button" style="" class="btn btn-white applys" onclick="openiframe('/index.php?m=attachment&amp;f=index&amp;v=upload_dialog&amp;callback=callback_thumb_dialog&amp;htmlid=attachment_test<?php echo $name;?>&amp;limit=1&amp;htmlname=setting%5Battachment_test%5D&amp;ext=png%7Cjpg%7Cgif%7Cdoc%7Cdocx&amp;token=3d9292f4c141b7f9c4f3a37f8af2e607&amp;_menuid=29&amp;_submenuid=67','attachment_test<?php echo $name;?>','loading...',810,400,1)">上传文件</button><br><br>
                                        <span class="test"></span>
                                         <div class="layui-form-label applys">
                                            <label class="labelr">报名人数基数</label>
                                            <input type="text" class="form-control input" id="Tosignup" name="Tosignup<?php echo $name;?>" value="<?php echo $appval['tosignup'];?>" style="width:150px;height:30px;">                          
                                        </div>
                                        <div class="layui-form-label applys">
                                            <label class="labelr">提交按钮文案</label>
                                            <input type="text" class="form-control input" id="submitcopy" name="submitcopy<?php echo $name;?>" value="<?php echo $appval['submitcopy'];?>" style="width:150px;height:30px;"><br>                       
                                        </div><br>
                                         <div class="layui-form-label applys">
                                            <label class="labelr">提交按钮背景颜色</label>
                                            <input type="text" class="form-control input" id="buttoncolor" name="buttoncolor<?php echo $name;?>" value="<?php echo $appval['buttoncolor'];?>" style="width:80px;height:30px;"><br>                       
                                        </div>
                                         <div class="layui-form-label applys">
                                            <label class="labelr">提交按钮文案颜色</label>
                                            <input type="text" class="form-control input" id="buttoncopycolor" name="buttoncopycolor<?php echo $name;?>" value="<?php echo $appval['buttoncopycolor'];?>" style="width:80px;height:30px;"><br>                       
                                        </div>
                                         <div class="layui-form-label applys">
                                            <label class="labelr">报名人数颜色</label>
                                            <input type="text" class="form-control input" id="numbercolor" name="numbercolor<?php echo $name;?>" value="<?php echo $appval['numbercolor'];?>" style="width:80px;height:30px;"><br>                       
                                        </div>
                                         <div class="layui-form-label applys">
                                            <label class="labels">报名人数提示语颜色</label>
                                            <input type="text" class="form-control input" id="cuewords" name="cuewords<?php echo $name;?>" value="<?php echo $appval['cuewords'];?>" style="width:80px;height:30px;"><br>                     
                                          </div>
                                  </div><input type="hidden" name="applyNum" value="<?php echo $applyNum;$applyNum++;?>" id="">
                            </fieldset>
                            <?php 
                              }
                            ?>
                          </div>
                          <!--  曹植修改结束 -->
                          <!--  发标组件 -->
                       </div>
                       <div class="layui-form-label floor">
                         <label class="labels">是否显示公共底</label>
                          <span style='margin-top: 10px;margin-left: 10px;'> 
                              <input name="floor" type="radio" value="1" <?php if($New['floor']==1){echo 'checked';}?>/>是
                              <input name="floor" type="radio" value="2" <?php if($New['floor']==2){echo 'checked';}?>/>否
                          </span>
                      </div>
                       <div class="layui-form-label fen">
                         <label class="labels">是否显示底部导航</label>
                          <span style='margin-top: 10px;margin-left: 10px;'> 
                              <input name="navigation" type="radio" value="1" <?php if($New['navigation']==1){echo 'checked';}?>/>是
                              <input name="navigation" type="radio" value="2" <?php if($New['navigation']==2){echo 'checked';}?>/>否
                          </span>
                      </div>
                      <div class="layui-form-label fen">
                         <label class="labels">是否显示在线咨询按钮</label>
                          <span style='margin-top: 10px;margin-left: 10px;'> 
                              <input name="consult" type="radio" value="1" <?php if($New['consult']==1){echo 'checked';}?>/>是
                              <input name="consult" type="radio" value="2" <?php if($New['consult']==2){echo 'checked';}?>/>否
                          </span>
                      </div>  
                      <br/>
                       <fieldset>
                         <legend >分享</legend>
                         <div class="layui-form-label">
                           <label class="labelf"><span class='red'>*</span>分享图标</label>
                              <input type="text" value="<?php echo $New['share']?>" ondblclick="img_view(this.value);" class="form-control" id="share" name="share" size="100" style="width:300px;margin-right:5px;position:relative;" placeholder='300px*300px'>
                              <button type="button" class="btn btn-white" onclick="openiframe('/index.php?m=attachment&amp;f=index&amp;v=upload_dialog&amp;callback=callback_thumb_dialog&amp;htmlid=share&amp;limit=1&amp;htmlname=setting%5Bshare%5D&amp;ext=png%7Cjpg%7Cgif%7Cdoc%7Cdocx&amp;token=3d9292f4c141b7f9c4f3a37f8af2e607&amp;_menuid=29&amp;_submenuid=67','share','loading...',810,400,1)" style="height: 28px;">上传图标</button>
                          </div><br/>
                          <div class="layui-form-label">
                           <label class="labelf"><span class='red'>*</span>分享标题</label>
                               <input type="text" name='sharename' id='sharename'style='width:450px; height:30px;' value='<?php echo $New['sharename']?>'>
                          </div><br/>
                          <div class="layui-form-label layui-form-area">
                              <label style="height:30px;line-height:30px;"><span class='red'>*</span>分享描述</label>
                              <textarea  name="content" id='sharecontent'><?php echo $New['content']?></textarea>
                          </div>
                        </fieldset>
                    <input name="submit" type="submit" class="save-bt btn btn-info" id="baoG" value="提交"  >
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
<link href="{R}css/validform.css" rel="stylesheet" />
<script src="{R}js/validform.min.js"></script>
<script type="text/javascript" src="{R}js/validform.min.js"></script>
<script type="text/javascript">
  var a='';
  $('#baoG').click(function(){
      var namel = $("#title").val().length;
      var name =$("#name").val().length;
      var sharenamel =$("#sharename").val().length;
      var sharecontentl =$("#sharecontent").val().length;
       if(namel>15){
            $(document).scrollTop(0);
            $(".ims").attr("src", "http://m.uzhuang.com/res/images/error.png"); 
            $('.titles').html('活动列表名称不得大于15个字符!');
               cl();
            return false;
      } 
     if(name>8){
            $(document).scrollTop(0);
            $(".nims").attr("src", "http://m.uzhuang.com/res/images/error.png"); 
            $('.ntitles').html('标题栏名称不得大于8个字符!');
              cls();
            return false;
      } 
      if(sharenamel>24){
             layer.tips('分享标题不得大于24个字符!', '#sharename');
            return false;
      } 
      if(sharecontentl>34){
            layer.tips('分享描述不得大于34个字符!', '#sharecontent');
            return false;
      } 
      var title =$('#title').val();
      var name =$('#name').val();
      var share =$('#share').val();
      var sharename =$('#sharename').val();
      var sharecontent =$('#sharecontent').val();
      if(!title){
            $(document).scrollTop(0);
            layer.tips('请输入活动名称', '#title');
            return false;
      }
      if(!name&&$("#name").is(":visible")){
            $(document).scrollTop(0);
            layer.tips('标题栏名称', '#name');
            return false;
      }
       if(!share){
            layer.tips('分享图标不能为空！', '#share');
            return false;
      }
       if(!sharename){
            layer.tips('分享标题不能为空！', '#sharename');
            return false;
      }
       if(!sharecontent){
            layer.tips('分享标题不能为空！', '#sharecontent');
            return false;
      }
      if(a=='exist'){
         $(document).scrollTop(0);
         return false;
      }
  })
      function cl(){
        $('#title').click(function(){
           $("#title").val('');
           $('.titles').html('');
           $(".ims").attr("src", ""); 
        })
    }
    $('#title').blur(function(){
       var name = $("#title").val();
       var ids = $("#title").attr('ids');
       var namel = $("#title").val().length;
       if(namel>15){
            $(".ims").attr("src", "http://m.uzhuang.com/res/images/error.png"); 
            $('.titles').html('活动列表名称不得大于15个字符!');
            a='exist';
            return false;
        } 
       $.ajax({
          url:"?m=xin&f=content&v=checkNameExits<?php echo $this->su();?>",
          data:{'title':name,'id':ids},
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
                  a='han';
              }
            }
          },
        })
    });
    function cls(){
        $('#name').click(function(){
           $("#name").val('');
           $('.ntitles').html('');
           $(".nims").attr("src", ""); 
        })
    }

  var num = $('.staticModules').length ;
  var car = $('.carModules').length ;
  var vim = $('.vimModules').length ;
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
        $(".carrouselModule").append('<div class="carModules"><fieldset><legend >轮播组件 ---- <input type="text" name="car'+car+'" class="element" style="width:30px;height:10px;" class="element">---- <span onclick="delmodule(this)" style="cursor:pointer;"><img src="<?php echo R;?>images/del.png"  style="width:30px">删除</span></legend>'+strs+'<button type="button" class="btn btn-white casem" onclick="openiframe('+str+')">上传图片</button></fieldset></div><input type="hidden" name="cars" value='+car+'>');
  });
  $('.vimadd').click(function(){
        vim++;
        var str = "'/index.php?m=attachment&amp;f=index&amp;v=upload_dialog&amp;callback=callback_vim&amp;htmlid=vim"+vim+"&amp;limit=1&amp;width=1&amp;htmlname=form%5Bvim"+vim+"%5D&amp;ext=jpg%7Cpng%7Cgif%7Cbmp&amp;token=34f98e4c74f75c6701341b703f09917b&amp;_menuid=5002','vim"+vim+"','loading...',810,400,20"
        var strs='<div class="attaclists"><div id="vim'+vim+'"><ul id="case_ul"></ul></div><span class="input-group-btn" onmouseover="showBtn(this)" onclick="imgTip(this)">'
        $(".vimModule").append('<div class="vimModules"><fieldset><legend >视频组件 ---- <input type="text" name="vim'+vim+'" class="element" style="width:30px;height:10px;" class="element">----去广告<input type="checkbox" name="advertising'+vim+'" value="1"  style="margin-left:5px;position: relative;top: 2px;" class="advertising"  onmouseover="showAdv(this)"/>---- <span onclick="delmodule(this)" style="cursor:pointer;"><img src="<?php echo R;?>images/del.png"  style="width:30px">删除</span></legend>'+strs+'<button onmouseover="picCount(this)" type="button" class="btn btn-white casem" onclick="openiframe('+str+')">上传图片</button></fieldset></div><input type="hidden" name="vims" value='+vim+'>');
  });
  function del(eleObj){
      $('div').remove('#'+eleObj);
      $.ajax({
          url:"?m=xin&f=content&v=delid<?php echo $this->su();?>",
          data:{'id':eleObj},
          type:"POST",
          dataType:"json",
          success:function(data){
          },
          error:function(){
            alert('error')
          }
      })
  }//删除图片
  function delsmodule(eleObj,curr){
      $(curr).closest("div[ids="+eleObj+"]").remove();
      $.ajax({
          url:"?m=xin&f=content&v=delids<?php echo $this->su();?>",
          data:{'id':eleObj},
          type:"POST",
          dataType:"json",
          success:function(data){
          },
      })
  }//删除组件
  function upModules(eleObj){
     var Modulesbian =$('#'+eleObj).val();
       $.ajax({
          url:"?m=xin&f=content&v=Modulesbian<?php echo $this->su();?>",
          data:{'id':eleObj,'bian':Modulesbian},
          type:"POST",
          dataType:"json",
          success:function(data){},
      })
  }//更新组件编号
  function advertisement(eleObj){
      var g= $('#g'+eleObj).val();
       $.ajax({
          url:"?m=xin&f=content&v=ug<?php echo $this->su();?>",
          data:{'id':eleObj,'g':g},
          type:"POST",
          dataType:"json",
          success:function(data){},
      })
  }//更新广告勾选

  /*曹植修改开始*/
  // 删除发标组件
  function delApply(eleObj,type){
    var delId = $(eleObj).prev('.applyId').val();
    if(type==1){
      if (confirm('确认要删除磁记录吗?')) {
        $(eleObj).closest('fieldset').remove();
        $.ajax({
            url:"?m=xin&f=content&v=deleteApply<?php echo $this->su();?>",
            data:{'id':delId},
            type:"POST",
            dataType:"json",
            success:function(data){},
        });
      }
    }else{
      $(eleObj).closest('fieldset').remove();
    }
  }
  // 新增发标组件
  var app = $("#maxApplyCount").val();
  $('.applyadd').click(function(){
      // 新增发标组件的个数
      var applyNo = parseInt($(this).closest('fieldset').siblings('fieldset').length);
      app++;
      var str = "'/index.php?m=attachment&f=index&v=upload_dialog&callback=callback_thumb_dialog&htmlid=attachment_test"+app+"&limit=1&htmlname=setting%5Battachment_test%5D&ext=png%7Cjpg%7Cgif%7Cdoc%7Cdocx&token=3d9292f4c141b7f9c4f3a37f8af2e607&_menuid=29&_submenuid=67','attachment_test"+app+"','loading...',810,400,1";

      var applyObj = '<fieldset id="applys'+app+'"><legend >发标组件  ---- <input type="text" name="apply'+app+'" id="apply'+app+'" class="applys element" style="width:30px;height:10px;" >---- <span onclick="delApply(this)" style="cursor:pointer;"><img src="<?php echo R;?>images/del.png"  style="width:30px">删除</span></legend><br/><div id="applysxiao'+app+'"><div class="layui-form-label applys"><label class="labelf">区域选择</label><span style="margin-top: 10px;margin-left: 10px;""><input name="area'+app+'" type="radio" value="1"  class="radio" checked=""/>公司开通城市<input name="area'+app+'" type="radio" value="2"  class="radio"/>全国城市</span></div><br/><input type="text" value="" ondblclick="img_view(this.value);" class="form-control applys h5" id="attachment_test'+app+'" name="background'+app+'" size="100" style="width:300px;margin-right:5px;position:relative;" placeholder="背景640*430px" ><button type="button" class="btn btn-white applys" onclick="openiframe('+str+')">上传文件</button><br/><br/><span class="test"></span><div class="layui-form-label applys"><label class="labelr">报名人数基数</label><input type="text" class="form-control input" id="Tosignup'+app+'" name="Tosignup'+app+'" style="width:150px;height:30px;"></div><div class="layui-form-label applys"><label class="labelr">提交按钮文案</label><input type="text" class="form-control input" id="submitcopy'+app+'" name="submitcopy'+app+'" style="width:150px;height:30px;"><br/></div><br/><div class="layui-form-label applys"><label class="labelr">提交按钮背景颜色</label><input type="text" class="form-control input" id="buttoncolor'+app+'" name="buttoncolor'+app+'" style="width:80px;height:30px;"><br/></div><div class="layui-form-label applys"><label class="labelr">提交按钮文案颜色</label><input type="text" class="form-control input" id="buttoncopycolor'+app+'" name="buttoncopycolor'+app+'"style="width:80px;height:30px;"><br/></div><div class="layui-form-label applys"><label class="labelr">报名人数颜色</label><input type="text" class="form-control input" id="numbercolor'+app+'" name="numbercolor'+app+'"  style="width:80px;height:30px;"><br/></div><div class="layui-form-label applys"><label class="labels">报名人数提示语颜色</label><input type="text" class="form-control input" id="cuewords'+app+'" name="cuewords'+app+'"  style="width:80px;height:30px;"><br/></div></div><input type="hidden" class="applyNum" name="applyNum" value="'+app+'"></fieldset>';
      if(!applyNo){
        $('#applys').after(applyObj);
      }else{
        $('#applys').siblings('fieldset').last().after(applyObj);
      }
      // 将发标组件的个数保持到 .applyNum
      $(".applyNum").val(app);
     /*曹植修改*/
  });
  /*曹植修改结束*/
</script>
</body>
</html>



