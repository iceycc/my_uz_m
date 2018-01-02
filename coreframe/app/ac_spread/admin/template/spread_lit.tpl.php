<?php defined('IN_WZ') or exit('No direct script access allowed');?>
<?php
include $this->template('header','core');
?>
<body class="body">
<style type="text/css">
 .form-inline{
    margin-left: 21px;
    margin-top: 10px;
 }
 .title{ 
      width:120px; 
      white-space:nowrap;
      overflow:hidden; 
      text-overflow:ellipsis;
 }
 .xiao{
        padding: 0 5px;
        line-height: 30px;
        border: none;
        background-color: #E0E8E1;
        font-size: 20px;
        cursor: pointer;
        height: 38px;
  }
.xh{
      padding: 0 5px;
      line-height: 30px;
      border: none;
      background-color: #7DC534;
      font-size: 10px;
      font-size: 20px;
      top:50px;
      cursor: pointer;
      position: relative;
  }
  .layui-layer-title{
    text-align: center;
  }
 body, html {
      overflow: auto !important;
  }
</style>
<script src="<?php echo R;?>js/layer.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo R;?>css/layer.css">
<link rel="stylesheet" type="text/css" href="<?php echo R;?>css/autocomplete.css">
<section class="wrapper">
    <div class="row">
            <section class="panel">
                <header class="panel-heading">
                </header>
                  &nbsp;&nbsp;&nbsp; &nbsp; 
                   <button class="btn btn-default btn-sm" onclick="openiframe('?m=pc_activity&f=activity&v=createActivity<?php echo $this->su();?><?php echo $this->su();?>','testaa','基础信息模块',800,600);" type="button">创建新活动</button>
                <button class="btn btn-default btn-sm" onclick="openiframe('?m=workitems&f=workitem&v=channelManger<?php echo $this->su();?><?php echo $this->su();?>','testaa','渠道管理模块',900,600);" type="button">渠道管理</button>
                <!--&nbsp;<a href="?m=workitems&f=workitem&v=channelManger<?php /*echo $this->su();*/?>"class="btn btn-default btn-sm" >渠道管理</a>-->
                    <form action="?m=ac_spread&f=spread&v=lst<?php echo $this->su();?>" class="form-inline"  method="post">
                          <div class="input-append dropdown">
                                <select name="exercise_type" class="form-control" style="float:left; height:35px;margin-right: 40px;">
                                     <option value = "">全部活动</option>
                                     <option value = "1" <?php if($exercise_types==1){echo 'selected';}?>>线上活动</option>
                                     <option value = "2" <?php if($exercise_types==2){echo 'selected';}?>>线下活动</option>
                                 </select> 
                                  <select name="city" class="form-control" style="float:left; height:35px;margin-right: 40px;">
                                     <option value = "0">全部城市</option>
                                     <?foreach ($cityData as $key => $city) {?>
                                         <option value = "<?php echo $city['cityid'];?>" <?php if($citys==$city['cityid']){echo 'selected';}?>><?php echo $city['city'];?></option>
                                     <?}?>
                                 </select>  
                                 <select name="pc_m" class="form-control" style="float:left; height:35px;margin-right: 40px;">
                                     <option value = "">全部页面</option>
                                     <option value = "1" <?php if($pc_m==1){echo 'selected';}?>>PC</option>
                                     <option value = "2" <?php if($pc_m==2){echo 'selected';}?>>M站</option>
                                     <!-- <option value = "3">主站APP</option> -->
                                 </select>
                                <input type="text" name="title" placeholder="输入活动名称" class="titles" style="height:35px; width:200px; " value="<?php echo $GLOBALS['title']?>" id='txtSearch'>
                                <button type="submit" class="btn adsr-btn"><i class="icon-search"></i></button>
                         </div>
                    </form>
                   <font size="2px" style="margin-left:30px;">共<span style="color:red"><?php echo $total?></span>条记录.</font>
                    <div class="panel-body" id="panel-bodys">
                       <table class="table table-striped table-advance table-hover">
                           <thead>
                           <tr>
                               <th >序号</th>
                               <th >查看</th>
                               <th >标题</th>
                               <th >活动城市</th>
                               <th >活动类型</th>
                               <th >活动时间</th>
                               <th >管理操作</th>
                           </tr>
                           </thead>
                           <tbody>
                              <?php foreach ($res as $key => $re) { ?>
                                  <?php $pc = "" ?>
                                  <?php $mz = "" ?>
                                  <?php if($re['pczhu'][0]){?>
                                      <?php  $pc =  count($re['pczhu'][0]); ?>
                                  <?php }else{?>
                                      <?php  $pc = 0; ?>
                                  <?php }?>
                                  <?php if($re['mzhu'][0]){?>
                                      <?php  $mz =  count($re['mzhu'][0]); ?>
                                  <?php }else{?>
                                      <?php  $mz = 0; ?>
                                  <?php }?>
                                <tr class="showTr">
                                    <td><?php echo $re['ranking']?></td>
                                    <td id="<?php echo $re['id']?>"><span class="xiao num" ids=<?php echo $re['id']?> sta="off"><em>展开</em>(<m><?php echo ($pc + $mz); ?></m>)</span></td>
                                    <td><?php echo $re['exercise_title']?></td>
                                    <td><div class="title" citys-status="<?php echo $re['citys_status']?>" citys-count="<?php echo $re['citys_count']?>" id='<?php echo $re['id'].'s'?>'><?php echo $re['citys'] ?></div></td>
                                    <td><?php echo $re['exercise_type']?></td>
                                    <td><?php echo $re['exercise_time']?></td>
                                    <td><div class="btn btn-default btn-sm btn-add" id="<?php echo $re['id']?>" style="background-color: #3FC397">新增页面</div>&nbsp;<button class="btn btn-default btn-sm edit"  type="button" style="background-color: #D7FAEA;" ids="<?php echo $re['id']?>">编辑活动</button></td>
                                </tr>
                              <?php }?>
                           </tbody>
                       </table>
                       <div class="panel-body">
                           <div class="row">
                               <div class="col-lg-12">
                                   <div class="pull-right">
                                       <ul class="pagination pagination-sm mr0">
                                           <?php echo $pages;?>
                                       </ul>
                                   </div>
                               </div>
                           </div>
                       </div>
                   </div>
                 
            </section>
        </div>
</section>
<script>
    var SCOPE = {
        'status_url' : '?m=pc_activity&f=activity&v=status<?php echo $this->su();?>',
        'txtSearch_url' : '?m=pc_activity&f=activity&v=txtSearch<?php echo $this->su();?>',
    }
</script>
<script src="<?php echo R;?>js/jquery-ui-1.9.2.min.js" type="text/javascript"></script>
<script src="<?php echo R;?>js/hover-dropdown.js"></script>
<script src="<?php echo R;?>js/jquery.nicescroll.js"></script>
<script src="<?php echo R;?>js/autocomplete.js"></script>
    <script type="text/javascript">
    $(function () {
      var url = SCOPE.txtSearch_url;
      var data = {}; 
      var txtSearchs = [];
      $.ajax({
        url:url,
        data:data,
        type:'POST',
        dataType:'json',
        success:function(res){
          $(res).each(function(i,n){
              txtSearchs[i] = n.exercise_title;
          });
        },
        async:false
      });
      $('#txtSearch').autocomplete(txtSearchs,{
            formatItem: function (data, i, total) {
                return "<I>" + data[0] + "</I>"; 
            },
            formatMatch: function (data, i, total) {
                return data[0];
            },
            formatResult: function (data) {
                return data[0];
            }
            })
      });
      $('.pagination-sm a').mouseover(function(){
            var city = '<? echo $citys?>';
            var title = '<? echo $keytypes?>';
            var pc_m = '<? echo $pc_m?>';
            var exercise_type = '<? echo $exercise_types?>';
            if(city || title || pc_m || exercise_type){
              if(!$(this).attr('city')){
                var href = $(this).attr('href');
                $(this).attr('href',href+'&city='+city+'&title='+title+'&pc_m='+pc_m+'&exercise_type='+exercise_type);
                $(this).attr('city','true');
              }
            }
            // location.href="?m=pc_activity&f=activity&v=lst&city="+city+"<?php echo $this->su();?>";
      })
</script>
<script src="<?php echo R;?>js/spread/dialog.js"></script>
<script src="<?php echo R;?>js/spread/spread.js"></script>
