<?php defined('IN_WZ') or exit('No direct script access allowed');?>
<?php
include $this->template('header','core');
?>
<body class="body">
<style type="text/css">
 .test_demo_ellipsis{
  text-overflow:ellipsis;
     overflow:hidden;
     white-space:nowrap;
     width:50px;
   }
 .test_demo_ellipsis:hover {
     overflow:visible;
  }
  #jolst td{
    height: 40px;
  }
  .xiaotu{
    width:30px;
  }
</style>

<section class="wrapper">
    <div class="row">
        <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                 <span class="dropdown addcontent">
                  <script src="<?php echo R; ?>js/html5upload/extension.js"></script>
                 </span>
                 <span class="dropdown examine">
                 </span>
          <!--           <form class="pull-right position" action="" method="get">
                        <input name="m" value="content" type="hidden">
                        <input name="f" value="content" type="hidden">
                        <input name="v" value="listing" type="hidden">
                        <input name="type" value="<?php echo $type;?>" type="hidden">
                        <input name="_su" value="<?php echo $GLOBALS['_su'];?>" type="hidden">
                        <input name="status" value="<?php echo $status;?>" type="hidden">
                        <input name="cid" value="<?php echo $cid;?>" type="hidden">
                    </form> -->
                    <form action="?m=xin&f=content&v=listing<?php echo $this->su();?>" class="form-inline"  method="post">
                            <div class="input-append dropdown">
                            <font size="4px">活动名称:</font> <input type="text" name="title" placeholder="搜索标题" class="titles" style="height:35px; width:200px; " value="<?php echo $GLOBALS['title']?>">
                            <button type="submit" class="btn adsr-btn"><i class="icon-search"></i></button>
                     </div>
                     </form>
                </header>
                  &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;<a href="?m=xin&f=content&v=adds&cid=39<?php echo $this->su();?>"class="btn btn-default btn-sm" >添加活动</a>
                      &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;<a href="?m=xin&f=content&v=ae&cid=39<?php echo $this->su();?>"class="btn btn-default btn-sm" >添加新活动</a>
                  <br/>
                   <font size="2px" style="margin-left:30px;">共<span style="color:red"><?php echo $total?></span>条记录.</font>
                <div class="panel-body" id="panel-bodys">
                <form action="?m=xin&f=content&v=Deletes<?php echo $this->su();?>" class="form-inline"  id="form6" method="post">
                        <table class="table table-striped table-advance table-hover">
                            <thead>
                            <tr>
                            <th class="textName"style="padding-left:20px;"><h4>序号</h4></th>
                                <th class="textName"style="padding-left:20px;"><h4>活动名称</h4></th>
                                <th class="textName"style="padding-left:70px;"><h4>时间</h4></th>
                                <th class="textName"style="padding-left:140px;"><h4>链接</h4></th>
                                <th class="textName"style="padding-left:20px;"><h4>状态</h4></h4>
                                <th class="textName"style="padding-left:50px;"><h4>操作</h4></th>
                            </tr>
                            </thead>
                            <tbody id='jolst'>
                     
                                
                            </tbody>
                        </table>
                    </form>
            </section>
        </div>
</section>
<script src="<?php echo R;?>js/bootstrap.min.js"></script>
<script src="<?php echo R;?>js/hover-dropdown.js"></script>
<script src="<?php echo R;?>js/jquery.nicescroll.js" type="text/javascript"></script>
<script src="<?php echo R;?>js/pxgrids-scripts.js"></script>
<script type="text/javascript">
      $('.adsr-btn').click(function(){
          var titles = $('.titles').val();
           $.post("?m=xin&f=content&v=jolst<?php echo $this->su();?>",{'titles':titles},function(data){
            if(data){
               var str = ''
              $(data).each(function(te, u) {
                 str += '<tr><td></td><td>'+u['title']+'</td><td>'+u['addtime']+'</td><td>'+u['newstr']+'<img src='+u['url']+' class="xiaotu" alt=""  onClick="img_wei(this.src);"></td><td>'+u['statu']+'</td></tr>'
               });
              $('#jolst').html(str);
            }
          },'json');
           return false
      })
      $(function(){
        $.post("?m=xin&f=content&v=jolst<?php echo $this->su();?>",function(data){
            if(data){
              var str = ''
              $(data).each(function(te, u) {
                 str += '<tr><td></td><td>'+u['title']+'</td><td>'+u['addtime']+'</td><td>'+u['newstr']+'<img src='+u['url']+' class="xiaotu" alt=""  onClick="img_wei(this.src);"></td><td>'+u['statu']+'</td></tr>'
               });
              $('#jolst').html(str);
            }
        },'json');
      });


</script>
