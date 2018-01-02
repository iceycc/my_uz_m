<?php defined('IN_WZ') or exit('No direct script access allowed');?>
<?php
include $this->template('header','core');
?>
<body class="body">
<style type="text/css">
    .recommend{
        display: inline-block;
        height: 38px;
        line-height: 38px;
        padding: 0 18px;
        background-color: #00962B;
        color: #fff;
        white-space: nowrap;
        text-align: center;
        font-size: 14px;
        border: none;
        border-radius: 2px;
        cursor: pointer;
        opacity: .9;
        -webkit-border-radius: 5px;
        -moz-border-radius: 5px;
        border-radius:5px;
        cursor: pointer;
    }
    .total{
      margin-top:20px; 
      font-size: 15px;
    }
   .total label{
     color: red;
     margin: 0 10px 0 10px;
   }
    .layui-form{
         overflow-y: scroll;
         overflow-x: scroll;
    }
    ::-webkit-scrollbar {
        width:10px;
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
</style>
<script src="<?php echo R;?>js/layer.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo R;?>css/layer.css">
<link rel="stylesheet" type="text/css" href="<?php echo R;?>css/autocomplete.css">
<section class="wrapper">
    <div class="row">
            <section class="panel">
                <span class="recommend"><?=$userData['nickname']?>的推荐</span><br>
                <? include $this->template('user_template');?>
            </section>
        </div>
</section>
<script>
</script>
<script src="<?php echo R;?>js/jquery-ui-1.9.2.min.js" type="text/javascript"></script>
<script src="<?php echo R;?>js/hover-dropdown.js"></script>
<script src="<?php echo R;?>js/jquery.nicescroll.js"></script>
<script src="<?php echo R;?>js/autocomplete.js"></script>
<script src="<?php echo R;?>js/award/award.js"></script>
<script src="<?php echo R;?>js/activity/pc_activity.js"></script>
<script type="text/javascript">
</script>