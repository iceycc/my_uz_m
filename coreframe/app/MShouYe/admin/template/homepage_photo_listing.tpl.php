<?php defined('IN_WZ') or exit('No direct script access allowed');?>
<?php
include $this->template('header','core');
?>
<body class="body">
<style type="text/css">
    .table>tbody>tr>td, .table>thead>tr>th {
        padding: 5px 10px;
    }
    .table>thead>tr>th.tablehead {
        padding: 10px 10px;
    }
    body {
        min-height: 400px;

    }
    .collect{
      float: left;
      margin: 0;
    }
   
</style>
<section class="wrapper">
    <div class="row">
        <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                 <span class="dropdown addcontent">

                 </span>
                 <span class="dropdown examine">
                 </span>
                    <form class="pull-right position" action="" method="get">
                        <input name="m" value="content" type="hidden">
                        <input name="f" value="content" type="hidden">
                        <input name="v" value="listing" type="hidden">
                        <input name="type" value="<?php echo $type;?>" type="hidden">
                        <input name="_su" value="<?php echo $GLOBALS['_su'];?>" type="hidden">
                        <input name="status" value="<?php echo $status;?>" type="hidden">
                        <input name="cid" value="<?php echo $cid;?>" type="hidden">
                    </form>
                    <form action="?m=MShouYe&f=homepage_photo&v=listing<?php echo $this->su();?>" class="form-inline"  method="post" id="form7">
                              <div class="input-append dropdown">
                                <div style="float:left;height:35px;padding-top:10px;font-size:15px;margin-right:10px;color:#000000;"><b>选择城市</b></div>
                                <select name="keytypes" class="form-control city" style="float:left;width:65px;height:30px;margin:5px 35px 0px 0px;">
                                <option value="">全部</option>
                                  <?php foreach ($city as $key => $value) {?>
                                    <option value="<?php echo $value['cityid'];?>" <?php echo $keytypes==$value['cityid']?'selected':'';?>> <?php echo $value['city'];?></option>
                                  <?}?>
                                </select>
                                <div style="float:left;height:35px;padding-top:10px;font-size:15px;margin-right:10px;color:#000000;"><b>选择状态</b></div>
                                <select name="status" class="form-control status" style="float:left;width:65px;height:30px;margin:5px 0px 0px 0px;">
                                    
                                    <option value="1" selected>上架</option>
                                    <option value="2" <?php echo $keytypess=='2'?'selected':'' ?> >下架</option>
                                    <option value="3" <?php echo $keytypess=='3'?'selected':'' ?> >草稿</option>
                                </select>
                            <!-- <input type="text" name="title" class="input" style="height:35px; width:200px; " value="<?php echo $GLOBALS['title']?>"> -->
                            <button type="submit" class="sbtn adsr-btn" style="margin:5px 0px 0px 40px;height:30px"><i class="icon-search"></i></button>
                     </div>
                     </form>
                </header>
                  &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;<a href="?m=MShouYe&f=homepage_photo&v=add&cid=270<?php echo $this->su();?>"class="btn btn-default btn-sm" >新建</a>
                <form action="?m=MShouYe&f=homepage_photo&v=Deletes<?php echo $this->su();?>" class="form-inline"  id="form6" method="post">
                        <table class="table table-striped table-advance table-hover">
                            <thead>
                            <tr>
                            <th class="textName" style="padding-left:40px;padding-right:20px;"><h5>序号</h5></th>
                                 <th class="textName"style="padding-left:20px;"><h5><p class="collect">干预值
                                  (<a href="javascript:void(0);" class="gshang" >升</a>
                                  <a href="javascript:void(0);" class="gxia" >降</a>)
                                 </p></h5><br/>
                                </th>
                                <th class="textName" style="padding-left:40px;"><h5>标题</h5></th>
                                <th class="textName" style="padding-left:40px;"><h5>城市</h5></th>
                                 <th class="textName"style="padding-left:45px;"><h5><p class="collect">更新时间 
                                   (<a href="javascript:void(0);" class="tshang" >升</a>
                                   <a href="javascript:void(0);" class="txia" >降</a>)
                                   </p></h5><br/>     
                                 </th>
                                <th class="textName" style="padding-left:20px;"><h5>状态</h5></th>
                                <th class="textName"><h5>操作</h5></th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php if(!isset($no_search)||$no_search!=0){?>
                            <?php foreach($result AS $key =>$Mjin) { ?>
                                <tr title="<?php echo $models[$r['modelid']]['name'];?>">
                                  <tr id="u_<?php echo $Mjin['id'];?>">
                                <td style="padding-left:40px;padding-right:20px;">
                              <input type="checkbox" name="ids[]" value="<?php echo $Mjin['id']?>" echo 'disabled'?>
                               &nbsp;<?php 
                               $k=$pagess*10;
                               if($k==0){
                                  echo $key+1;
                               }else{
                                  echo $k+$key+1-10;
                               }
                              ?>
                               </td>
                               <td style="padding-left:30px;"> <button style="" onclick="openiframe('?m=MShouYe&f=homepage_photo&v=intervene&id=<?php echo $Mjin['id'];?><?php echo $this->su();?>','testaa','修改干预值',350,100);" type="button"><?echo $Mjin['intervene']?></button></td>
                               <td style="padding-left:30px;"><a href="<?php echo getMImgShow($Mjin['cover'],'original')?>" target="_blank"><?php echo $Mjin['title']?></a></td>
                               <td style="padding-left:30px;"><?php 
                                $c=array();
                               $city=explode(',',$Mjin['city']);
                               $city_configs = get_config('city_config');
                               foreach ($city as $keyc => $valuec) {
                                   
                                   foreach ($city_configs as $keycity => $valuecity) {
                                        if($valuecity['cityid']==$valuec){
                                              $c[]=$valuecity['city'];
                                        }
                                   }
                               }
                               echo implode(',',$c);
                               ?></a></td>
                               <td style="padding-left:30px;"><?php echo date('Y-m-d H:i:s',$Mjin['updatetime']);?></td>
                               <td style="padding-left:30px;"><?php 
                               if($Mjin['status']==1){echo "上架";}elseif($Mjin['status']==2){echo "下架";
                               }elseif($Mjin['status']==3){echo "未发布";}?></td>

                              <td> 
                              <a href="?m=MShouYe&f=homepage_photo&v=edit&id=<?php echo $Mjin['id'];?>&cid=<?php echo $Mjin['cid'].$this->su();?>" class="btn btn-primary btn-xs">编辑</a>
                              <?php if($Mjin['status']==1){?><a href="javascript:makedo('?m=MShouYe&f=homepage_photo&v=UnShelve&id=<?php echo $Mjin['id'];?><?php echo $this->su();?>', '确认下架该记录？')" class="btn btn-default btn-xs">下架</a><?}elseif($Mjin['status']==2){?><a href="javascript:makedo(' ?m=MShouYe&f=homepage_photo&v=Putaway&id=<?php echo $Mjin['id'];?><?php echo $this->su();?>', '确认上架该记录？')" class="btn btn-default btn-xs">上架</a><?}elseif($Mjin['status']==3){?><a href="javascript:makedo('?m=MShouYe&f=homepage_photo&v=Publish&id=<?php echo $Mjin['id'];?><?php echo $this->su();?>', '确认发布该记录？')" class="btn btn-default btn-xs">发布</a><?}?>
                              <a href="javascript:makedo('?m=MShouYe&f=homepage_photo&v=delete&id=<?php echo $Mjin['id'];?><?php echo $this->su();?>', '确认删除该记录？')" class="btn btn-danger btn-xs">删除</a>
                                    </td>
                                </tr>
                                <?}?>
                            <?php }else{ ?>
                                  <tr align="center"><td></td><td></td><td></td><td><font size="4">没有相关记录</font></td><td></td><td></td><td></td></tr>
                               <?}?>
                            </tbody>
                        </table>


                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="pull-left">
                                        <button type="button" onClick="checkall()" name="submit2" class="btn btn-default btn-sm">全选/反选</button>
                                        <input type="submit" class="btn btn-default btn-sm" id="deletes"value="批量删除">
                                    </div>
                                    <div class="pull-right">
                                        <ul class="pagination pagination-sm mr0">
                                            <?php echo $pages;?>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
            </section>
        </div>
</section>
<script src="<?php echo R;?>js/bootstrap.min.js"></script>
<script src="<?php echo R;?>js/hover-dropdown.js"></script>
<script src="<?php echo R;?>js/jquery.nicescroll.js" type="text/javascript"></script>
<script src="<?php echo R;?>js/pxgrids-scripts.js"></script>
<script type="text/javascript">
  // $("select[name=key]").change(function(){
  //   var where = $(this).val();
  //   // alert(where)
  //   location.href="?m=MShouYe&f=homepage_photo&v=listing&shang="+where+"<?php echo $this->su();?>";
  // })
  // 按干预值升降 start
var cityid='';
var status='';
$('.gshang').click(function(){
  if($('.city option[selected]').val()){
        cityid=$('.city option[selected]').val();
  }
  if($('.status option[selected]').val()){
       status=$('.status option[selected]').val();
  }
  $('.gshang').attr("href","?m=MShouYe&f=homepage_photo&v=listing&cid=270&pai=gshang&keytypes="+cityid+"&status="+status+"<?php echo $this->su();?>");
})

$('.gxia').click(function(){
  if($('.city option[selected]').val()){
        cityid=$('.city option[selected]').val();
  }
  if($('.status option[selected]').val()){
        status=$('.status option[selected]').val();
  }
  $('.gxia').attr("href","?m=MShouYe&f=homepage_photo&v=listing&cid=270&pai=gxia&keytypes="+cityid+"&status="+status+"<?php echo $this->su();?>");
})
// 按干预值升降 end

// 按更新时间升降 start
$('.tshang').click(function(){
  if($('.city option[selected]').val()){
        cityid=$('.city option[selected]').val();
  }
  if($('.status option[selected]').val()){
        status=$('.status option[selected]').val();
  }
  $('.tshang').attr("href","?m=MShouYe&f=homepage_photo&v=listing&cid=270&pai=tshang&keytypes="+cityid+"&status="+status+"<?php echo $this->su();?>");
})
$('.txia').click(function(){
  if($('.city option[selected]').val()){
        cityid=$('.city option[selected]').val();
  }
  if($('.status option[selected]').val()){
        status=$('.status option[selected]').val();
  }
  $('.txia').attr("href","?m=MShouYe&f=homepage_photo&v=listing&cid=270&pai=txia&keytypes="+cityid+"&status="+status+"<?php echo $this->su();?>");
})
// 按更新时间升降 end
  $("#deletes").click(function(){
    if (!confirm('确定要删除选中记录？')) {
      return false;
    };
  })
    $("#bao1").click(function(){
    $("#form6").attr("action","?m=MShouYe&f=homepage_photo&v=listing<?php echo $this->su();?>")
  })
    $("#form7").find("button").click(function(e){
      var form = $(e.target).parents("form");
      form.attr("action","?m=MShouYe&f=homepage_photo&v=listing<?php echo $this->su();?>&"+form.serialize());
      form.submit();
      return false;
  })
</script>
</body>
</html>