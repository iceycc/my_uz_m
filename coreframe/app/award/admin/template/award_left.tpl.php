<?php defined('IN_WZ') or exit('No direct script access allowed');?>
<?php
include $this->template('header','core');
?>
<link rel="stylesheet" href="<?php echo R;?>js/layui/css/layui.css"  media="all">
<style type="text/css">
</style>
<body class="body categorytree">

<!-- <div class="treelistmain">
    <div class="tree">
        <ul>
              <li><a href="javascript:0;" onclick="o_p('setting')">首页管理</a></li>
              <li><a href="javascript:0;" onclick="o_p('deposit')">提现申请管理</a></li>
              <li><a href="javascript:0;" onclick="o_p('finance')">财务打款管理</a></li>
        </ul>
    </div>
</div> -->


  <ul id="demo"></ul>

 

<script src="<?php echo R;?>js/bootstrap.min.js"></script>
<script type="text/javascript" src="<?php echo R;?>js/jquery-tree.min.js"></script>
<script src="<?php echo R;?>js/jquery.nicescroll.js" type="text/javascript"></script>
<script src="<?php echo R;?>js/pxgrids-scripts.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo R;?>css/jquery-tree.css" />
<script type="text/javascript" src="<?php echo R;?>js/jquery-tree.min.js"></script>
<script type="text/javascript" src="<?php echo R;?>js/layui/layui.js"></script>
<script>
layui.use(['tree', 'layer'], function(){
  var layer = layui.layer
  ,$ = layui.jquery; 
  layui.tree({
    elem: '#demo',
    target: '_blank',
    click: function(item){ 
        parent.$("#iframeid").attr('src','?m=award&f=award&v='+item.alias+'<?php echo $this->su();?>');
    },
    nodes: [ //节点
      {
        name: '首页管理',
        alias: 'setting'
      },
      {
        name: '市场管理',
        alias:'bazaar',
        children: [
         {
            name: '提现审核',
            alias: 'deposit'
          },
          {
            name: '群发短信',
            alias: 'mass_SMS'
          }
        ]
      },
      {
        name: '财务打款管理',
        alias: 'finance'
      },
      {
        name: '管理会员',
        alias: 'member'
      }
    ]
  });
});
</script>