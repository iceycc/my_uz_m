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
    h1 {
      font-weight: 600;
      font-size: 20px;
      color: black;
      margin-bottom: 10px;
    }
    .banner,.draw {
      background-color: #DC940D;
      color: #eee;
      -webkit-border-radius: 5px;
      -moz-border-radius: 5px;
      border-radius: 5px;
    }
    .set {
      margin-left: 10px;
    }
    ul li {
      cursor: move;
    }
    #btn-save,#draw {
      background: #3385ff;
      color: #eee;
    }
  .header {
    background-color: #3385ff;
    color: #eee;
    -webkit-border-radius: 5px;
    -moz-border-radius: 5px;
    border-radius: 5px;
  }
  .up {
    cursor: pointer;
  }
  body{
  overflow-y: scroll;
  overflow-x: scroll;
}

::-webkit-scrollbar {
  width: 10px;
}

::-webkit-scrollbar-track {
  -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.3);
  -webkit-border-radius: 10px;
  border-radius: 10px;
}

::-webkit-scrollbar-thumb {
  -webkit-border-radius: 10px;
  border-radius: 10px;
  -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.5);
}

::-webkit-scrollbar-thumb:window-inactive {
  background: rgba(255,0,0,0.4);
}
.wrapper{
    min-width: 1220px;
    overflow-y: auto;
}
</style>
<section class="wrapper">
 <div class="row">
      <section class="panel">
        <div class="set">
            <h1>BANNER</h1>
            <!-- ?m=award&f=award&v=bannerAdd<?php echo $this->su();?> -->
              <form class="form-horizontal tasi-form" method="post" action="" id="singcms-form">
                  <button type="button" class="btn btn-white banner" style="margin-top: -7px;" onclick="openiframe('/index.php?m=attachment&amp;f=index&amp;v=upload_dialog&amp;callback=callback_pc_award&amp;htmlid=banner&amp;limit=6&amp;width=1&amp;htmlname=form%5Bbanner%5D&amp;ext=jpg%7Cpng%7Cgif%7Cbmp&amp;token=34f98e4c74f75c6701341b703f09917b&amp;_menuid=5002','banner','loading...',810,400,20)">上传图片</button>
                  <div id="banner">
                     <ul id="pic_ul">
                       <? foreach ($data as $key => $va) {?>
                         <li id="file_node_<? echo $va['ids']?>">
                             <table class="table table-striped table-advance table-hover">
                                <tr>
                                  <td style="width:5%;"> 
                                     <span class="liNum" style="font-family:Arial Black;"><? echo $va['ids']?></span>
                                     <input type="hidden" name="form[banner][ids][]" value="<? echo $va['ids']?>" class="ids">
                                     <img src="<?php echo getMImgShow($va['picimg'],'original')?>" alt="'+file_alt+'" onclick="img_viewss(this.src);" style="margin-left:50px;height:60px;width: 80px;"></td>
                                     <td style="width:10%"> 
                                     <input style="" type="hidden" name="form[banner][picimg][]" value="<?php echo $va['picimg']?>">
                                     <input type="text" name="form[banner][url][]" style="width:50%;height: 30px;" placeholder="活动页面链接" value="<?php echo $va['url']?>" class="forbid">
                                     </td>
                                     <td style="width: 10%">
                                         <span style="color:red">提示：双击删除</span>
                                     </td>
                                </tr>
                             </table>
                         </li>
                         <?}?>
                     </ul>
                  </div>
                    <center>
                        <input name="submit" type="submit" class="save-bt btn" id="btn-save"  onclick=""  value="保存" >
                    </center>
              </form>
            <h1>返现领取展示</h1>
            <button class="btn btn-white draw">新增用户</button>
            <form class="form-horizontal tasi-form" method="post" action="" id="singcms-draw">
              <table class="table table-striped table-advance table-hover">
              <tr>
                <th style="background-color: #D4D8DC;text-align: center;">序号</th>
                <th style="background-color: #D4D8DC;text-align: center;">手机号</th>
                <th style="background-color: #D4D8DC;text-align: center;">领取金额</th>
                <th style="background-color: #D4D8DC;text-align: center;">头像</th>
                <th style="background-color: #D4D8DC;text-align: center;">头像预览</th>
                <th style="background-color: #D4D8DC;text-align: center;"></th>
              <tr>
               <tbody class="draws">
               <tbody>
              </table>
              <center>
                <input name="submit" type="submit" class="save-bt btn" id="draw"  onclick=""  value="保存" >
              </center>
            </form>
        </div>
     </section>
  </div>
</section>
<script>
</script>
<script src="<?php echo R;?>js/html5upload/extension.js"></script>
<script src='<?php echo R;?>/js/laydate.js?<?php echo VERHASH; ?>'></script>
<script src="<?php echo R;?>js/jquery.nicescroll.js" type="text/javascript"></script>
<script src="<?php echo R;?>js/award/award.js"></script>
<script src="<?php echo R;?>js/jquery-ui-1.9.2.min.js" type="text/javascript"></script>
</body>
</html>
<script type="text/javascript">
    $('#btn-save').click(function(){
        var data = $("#singcms-form").serializeArray();
        if(!data.length){
           layer.alert('还没有提交数据', {icon: 5});
           return false;
        }
        $.post('?m=award&f=award&v=bannerAdd<?php echo $this->su();?>',data,function(result){
             layer.alert('添加成功！', {icon: 6});
        },'json');
        return false;
    });
    $(function () {
        draw();
    });
    $('#draw').click(function(){
       var data = $("#singcms-draw").serializeArray();
       if(!data.length){
           layer.alert('还没有提交数据', {icon: 5});
           return false;
        }
        $.post('?m=award&f=award&v=drawAdd<?php echo $this->su();?>',data,function(result){
             layer.alert('添加成功！', {icon: 6});
             setTimeout(draw,3000); 
             return false;
        },'json');
       return false;
    });
    function draw(){
       var data = {};
       $.post('?m=award&f=award&v=drawlst<?php echo $this->su();?>',data,function(res){
                var  drawlst= '';
                var num = '';
                $(res.data).each(function(i,n){
                    num = i+1;
                    drawlst += '<tr class="tr del del'+n.id+'" ondblclick="deldb('+n.id+')"><td style="text-align: center;" class="liNums">'+num+'</td><td style="text-align: center;">'+n.mobile+'</td><td style="text-align: center;">'+n.money+'</td><td style="text-align: center;"><span class="header up">上传图片</span></td><td style="text-align: center;"><input type="text" value="'+n.header+'" ondblclick="img_view(this.value);" class="form-control" id="header'+num+'"  size="100" style="width:230px;margin-right:5px;position:relative;"  ></td><td class="" style="text-align: center;color:red" >提示：双击删除</td></tr>';
                });
                 $('.draws').html(drawlst);   
       },'json');
    }
    function deldb(id){
         layer.open({
            content : '确认删除么！删除后无法恢复',
            icon:3,
            btn : ['是','否'],
            yes : function(){
               $('.layer-anim,.layui-layer-shade').remove();
                 $('.del'+id).css('background','#FB6C6C').slideUp(500,function(){
                 $('.del'+id).remove();
                 drawdel(id);
                    setTimeout(sorts,2);       
                })
            },
        });
    }
    function drawdel(id){
      data = {'id':id}
        $.post('?m=award&f=award&v=drawdel<?php echo $this->su();?>',data,function(result){},'json');
    }
</script>