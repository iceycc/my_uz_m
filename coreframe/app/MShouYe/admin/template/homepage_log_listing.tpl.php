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
    .shang{
      display: block;
      margin-bottom: -5px;
      width: 16px;
      height: 10px;
    }
     .xia{
      height: 10px;
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
                    <div class="input-append dropdown" style="left: 200px;top: 20px">
                        <div style="color:#000000;font-size:15px;"><b>其他 :</b></div>

                        <select name="key1" class="form-control" style="float:left;width:85px;height:30px;margin:-25px 35px -10px 70px;">
                            <option value="">全部</option>
                            <option value="1" <?php echo $select=='1'?'selected':'' ?>>管家名</option>
                            <option value="2" <?php echo $select=='2'?'selected':'' ?>>订单号</option>
                            <option value="3" <?php echo $select=='3'?'selected':'' ?>>日志名称</option>
                        </select>
                        <input type="text" name="keyValue"     size="50" value="<?php echo $keyValue ?>" style="float:left;width:200px;height:30px;margin:-25px 35px -10px 70px;margin-left: 160px"/>
                        <button type="submit" id="submit" class="btn btn-info" style="float:left;width:50px;height:30px;margin:-25px 35px -10px 70px;margin-left: 365px">搜索</button>
                    </div>

                    <div class="">
                           <div style="color:#000000;font-size:15px;"><b>选择城市 :</b></div>
                           <div style='float:left;width:80px;height:30px;margin:-20px 35px -10px 700px;'>共<span style="color:red"><?echo $totals?></span>条记录</div>
                           <select name="key" class="form-control" style="float:left;width:65px;height:30px;margin:-25px 35px -10px 70px;">
                                    <option value="">全部</option>
                                    <option value="3360" <?php echo $keytypess=='3360'?'selected':'' ?> >北京</option>
                                    <option value="3362" <?php echo $keytypess=='3362'?'selected':'' ?> >天津</option>
                                    <option value="328"  <?php echo $keytypess=='328'?'selected':'' ?> >深圳</option>
                                    <option value="326"  <?php echo $keytypess=='326'?'selected':'' ?> >广州</option>
                                    <option value="3361" <?php echo $keytypess=='3361'?'selected':'' ?> >上海</option>
                                    <option value="435" <?php echo $keytypess=='435'?'selected':'' ?> >西安</option>
                                    <option value="213" <?php echo $keytypess=='213'?'selected':'' ?> >杭州</option>
                                    <option value="200" <?php echo $keytypess=='200'?'selected':'' ?> >南京</option>
                                    <option value="295" <?php echo $keytypess=='295'?'selected':'' ?> >武汉</option>
                                    <option value="278" <?php echo $keytypess=='278'?'selected':'' ?> >郑州</option>
                                    <option value="382" <?php echo $keytypess=='382'?'selected':'' ?> >成都</option>
                                </select>
                       </div>



                </header>

                <table class="table table-striped table-advance table-hover">
                            <thead>
                            <tr>
                            <th class="textName" style="padding-left:40px;padding-right:20px;"><h5>序号</h5></th>
                                <th class="textName" style="padding-left:30px;"><h5><p class="collect">干预值
                                  (<a href="?m=MShouYe&f=homepage_log&v=listing&cid=223&pai=gshang&shang=<?php echo $keytypess;?><?php echo $this->su();?>"class="shang1" >升</a>
                                  <a href="?m=MShouYe&f=homepage_log&v=listing&cid=223&pai=gxia&shang=<?php echo $keytypess;?><?php echo $this->su();?>"class="xia1" >降</a>)</p></h5><br/>
                                </th>
                                <th class="textName" style="padding-left:40px;padding-right:20px;"><h5>订单号</h5></th>
                                <th class="textName" style="padding-left:30px;"><h5>标题</h5></th>
                                 <th class="textName" style="padding-left:30px;"><h5>城市</h5></th>
                                  <th class="textName" style="padding-left:30px;"><h5>最新进度</h5></th>
                                <th class="textName" style="padding-left:30px;"><h5><p class="collect">更新时间
                                    (<a href="?m=MShouYe&f=homepage_log&v=listing&cid=223&pai=tshang&shang=<?php echo $keytypess;?><?php echo $this->su();?>"class="shang1" >升</a>
                                    <a href="?m=MShouYe&f=homepage_log&v=listing&cid=223&pai=txia&shang=<?php echo $keytypess;?><?php echo $this->su();?>"class="xia1" >降</a>)</p></h5><br/>
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach($result AS $key =>$log) { ?>
                              <?php  $i++; ?>
                              <tr>
                              <td style="padding-left:40px;padding-right:20px;"><?php echo $i; ?></td>
                               <td style="padding-left:30px;"> <button style="" onclick="openiframe('?m=MShouYe&f=homepage_log&v=intervene_log&orderid=<?php echo $log['orderid'];?><?php echo $this->su();?>','testaa','修改干预值',390,290);" type="button"><?php echo $log['log_intervene']; ?></button></td>
                                  <td style="padding-left:40px;padding-right:20px;"><?php echo '10000'.$log['orderid']; ?></td>
                               <td style="padding-left:30px;"><a target="_blank"  href="<?php echo $log['url']; ?>"><?php echo $log['logname']; ?></a></td>

                               <td style="padding-left:30px;"><?php echo $log['shi']; ?></td>
                               <td style="padding-left:30px;"><?php echo $log['nodename']; ?></td>
                               <td style="padding-left:30px;"><?php echo $log['addtime'];?></td>
                                </tr>
                            <?php } ?>
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
            </section>
        </div>
</section>
<script src="<?php echo R;?>js/bootstrap.min.js"></script>
<script src="<?php echo R;?>js/hover-dropdown.js"></script>
<script src="<?php echo R;?>js/jquery.nicescroll.js" type="text/javascript"></script>
<script src="<?php echo R;?>js/pxgrids-scripts.js"></script>
<script type="text/javascript">
  $("select[name=key]").change(function(){
    var where = $(this).val();

    location.href="?m=MShouYe&f=homepage_log&v=listing&shang="+where+"<?php echo $this->su();?>";
  });
  $("#submit").click(function () {
    select1 = $("select[name=key1]").val();
    where =   $("select[name=key]").val();
    keyValue = $("input[name=keyValue]").val();
     if (select1 == null || select1 == undefined || select1 == '' || keyValue == null || keyValue == undefined || keyValue == '') {
         // var variable2 = variable1;
          alert('请选择后再搜索');return false;
      }
    location.href="?m=MShouYe&f=homepage_log&v=listing&select="+select1+"&keyValue="+keyValue+"&shang="+where+"<?php echo $this->su();?>";
  });

  $("#deletes").click(function(){
    if (!confirm('确定要删除选中记录？')) {
      return false;
    };
  });
    $("#bao1").click(function(){
    $("#form6").attr("action","?m=MShouYe&f=homepage_special&v=listing<?php echo $this->su();?>")
  })
</script>
</body>
</html>