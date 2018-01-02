<?php defined('IN_WZ') or exit('No direct script access allowed');?>
<?php
include $this->template('header','core');
?>
<body class="body">
<style type="text/css">
</style> 
<script src="<?php echo R;?>js/jquery.js"></script>
<script src="<?php echo R;?>js/layer.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo R;?>css/layer.css">
<section class="wrapper">
    <div class="row">
            <section class="panel">
                <header class="panel-heading">
                    <form action="?m=activity&f=activity&v=lst<?php echo $this->su();?>" class="form-inline"  method="post">
                            <div class="input-append dropdown">
                            <input type="text" name="title" placeholder="搜索标题" class="titles" style="height:35px; width:200px; " value="<?php echo $GLOBALS['title']?>">
                            <button type="submit" class="btn adsr-btn"><i class="icon-search"></i></button>
                     </div>
                    </form>
                </header>
                  &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;<a href="?m=activity&f=activity&v=add<?php echo $this->su();?>"class="btn btn-default btn-sm" >添加活动</a>
                  <br/>
                   <font size="2px" style="margin-left:30px;">共<span style="color:red"><?php echo $total?></span>条记录.</font>
                    <div class="panel-body" id="panel-bodys">
                 <table class="table table-striped table-advance table-hover">
                     <thead>
                     <tr>
                         <th class="hidden-phone tablehead">序号</th>
                         <th style="position: relative;left: 8px;">活动名称</th>
                         <th style="position: relative;left: 41px;">时间</th>
                         <th class="">链接</th>
                         <th class="">状态</th>
                         <th style="position: relative;left: 41px;">操作</th>
                     </tr>
                     </thead>
                     <tbody>
                        <?foreach ($res as $k => $re) {?>
                         <tr>
                             <td style="echo $GLOBALS['id'];"><?php echo $re['ranking']?>
                               <?php if($re['activity_type']=='1'){?>
                                       <img src="<?php echo R;?>images/H5.png" style="width:20px;">
                               <?}?>
                             </td>
                             <td><?php echo $re['activityname']?></td>
                             <td><?php echo date('Y-m-d H:i:s',$re['updatetime'])?></td>
                             <td><?$str=R;$newstr = substr($str,0,strlen($str)-5);
                             echo $newstr.'/mobile-temp_new.html?activity_id='.$re['id'];?></td>
                             <td><?php echo $re['status_type']?></td>
                             <td>
                                 <a class="btn btn-primary btn-xs wuzhi-edit" attr-id='<?php echo $re['id']?>' >修改</a>
                                 <a attr-id='<?php echo $re['id']?>' attr-status='<? echo $re['status_type_data'][0]?>' attr-message='<? echo $re['status_type_data'][1]?>' class="btn btn-default btn-xs wuzhi-status" ><? echo $re['status_type_data'][1]?></a>
                                 <a href="" class="btn btn-danger btn-xs wuzhi-delete" attr-id='<?php echo $re['id']?>' attr-status='-1' attr-message='删除' >删除</a>
                             </td>
                         </tr>
                       <?}?>
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
<script src="<?php echo R;?>js/bootstrap.min.js"></script>
<script src="<?php echo R;?>js/hover-dropdown.js"></script>
<script src="<?php echo R;?>js/jquery.nicescroll.js" type="text/javascript"></script>
<script src="<?php echo R;?>js/pxgrids-scripts.js"></script>
<script>
    var SCOPE = {
      'set_status_url' : '?m=activity&f=activity&v=status<?php echo $this->su();?>',
      'set_edit_url' : '?m=activity&f=activity&v=edit<?php echo $this->su();?>',
    }
</script>
<script src="<?php echo R;?>js/activity/dialog.js"></script>
<script src="<?php echo R;?>js/activity/activity.js"></script>
