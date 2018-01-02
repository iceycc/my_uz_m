<?php defined('IN_WZ') or exit('No direct script access allowed');?>
<?php
include $this->template('header','core');
?>
<body class="body">
<style type="text/css">
   .H5:hover,.normal:hover{
    color: #3B4658;
    cursor:pointer;
  } 
  .active{
        border:1px solid;
        border-bottom:1px solid white;
        background-color: #B8CAC0;
  }  
  .normalsty{
    border:1px solid;
  }
  .btn-infos{
      width: 50px;
      height: 36px;
  }
  body{
         overflow-x: scroll;
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
        overflow-y: auto;
      }
</style>
<script src="<?php echo R;?>js/jquery.js"></script>
<script src="<?php echo R;?>js/layer.js"></script>
<script src="<?php echo R;?>js/layui.js" charset="utf-8"></script>
<link rel="stylesheet" type="text/css" href="<?php echo R;?>css/layer.css">
<section class="wrapper">
    <div class="row">
        <section class="panel">
          <center>
           <div style="font-size: 30px;border-bottom:1px solid;margin: 0 auto;width: 85%;">
               <span class='H5 active'>H5</span>
               <span class='normal normalsty'>普通</span>
           </div> 
          </center>
           <div>
               <span id='H5'><? include $this->template('workitem_h5');?></span>
               <span id='normal'><? include $this->template('workitem_normal');?></span>
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
      'set_delete_url' : '',
      'save_url' : '?m=activity&f=activity&v=add<?php echo $this->su();?>',
      'jump_url' : '?m=activity&f=activity&v=lst<?php echo $this->su();?>',
    }
</script>
<script src="<?php echo R;?>js/activity/dialog.js"></script>
<script src="<?php echo R;?>js/activity/activity.js"></script>

