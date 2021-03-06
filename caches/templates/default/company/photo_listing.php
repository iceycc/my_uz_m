<?php defined('IN_WZ') or exit('No direct script access allowed'); ?><?php if(!isset($siteconfigs)) $siteconfigs=get_cache('siteconfigs'); include T('member','head'); ?>
<script src="<?php echo R;?>member/js/jscarousel.js" type="text/javascript"></script>
<link href="<?php echo R;?>css/validform.css" rel="stylesheet" />
<script src="<?php echo R;?>js/validform.min.js"></script>
<script type="text/javascript" src="<?php echo R;?>js/ueditor/ueditor.config.js"></script>
<script type="text/javascript" src="<?php echo R;?>js/ueditor/ueditor.all.min.js"></script>

<script type="text/javascript">
    $(document).ready(function() {
        $('#jsCarousel').jsCarousel({ onthumbnailclick: function(src) {
            // 可在这里加入点击图片之后触发的效果
            $("#overlay_pic").attr('src', src);
            $(".overlay").show();
        }, autoscroll: true });

        $(".overlay").click(function(){
            $(this).hide();
        });
    });
</script>


<div class="container memberframe">
    <div class="row">
        <div class="col-lg-12 col-xs-12">
            <!--左侧开始-->
            <div class="memberleft">
                <div class="memberborder">
                    <?php if(!isset($siteconfigs)) $siteconfigs=get_cache('siteconfigs'); include T('member','left'); ?>
                </div>
            </div>
            <!--左侧结束-->

            <!--右侧开始-->
            <div class="memberright">

                <div class="memberbordertop">
                    <section class="panel">
                        <div class="panel-heading"><span class="title">管理案例</span></div>

                        <ul id="myTab" class="nav nav-tabs" role="tablist">
                            <li role="presentation" class="active"><a href="#tabs1" id="1tab" role="tab" data-toggle="tab" aria-controls="tabs1" aria-expanded="true">案例列表</a></li>
                            <li role="presentation" class=""><a href="?m=company&f=biz_photo&v=add">新增案例</a></li>
                            </li>
                        </ul>

                        <div id="myTabContent" class="tab-content tabsbordertop">

                            <div role="tabpanel" class="tab-pane fade active in" id="tabs1" aria-labelledby="1tab">
                                 <div style="float:left;color:#777777;">共<b style="color:red"><?php echo $total;?></b>条记录，每页最多显示 10 条</div>
                 <form name="search" action="index.php?m=company&f=biz_photo&v=listing" method="post" style="float:right;color:#777777;">

                           案例名称：<input type="text" name="keywords" style="height:30px;">
                                    <button type="submit" class="btn btn-order">查询</button>
                                    <!-- btn btn-info -->
                                    </form>


                                <div class="panel-body" id="panel-bodys">
                                  <?php if($total) { ?>
                                    <table class="table table-striped table-advance table-hover text-center">
                                        <thead>
                                        <tr>
                                         <th class="tablehead"></th>
                                        <th class="tablehead">排名</th>
                                        <th class="tablehead">排序</th>
                                            <th class="tablehead">案例名称</th>
                                            <th class="tablehead">户型</th>
                                            <th class="tablehead">面积</th>
                                            <th class="tablehead">设计师</th>
                                            <th class="tablehead">创建时间</th>
                                            <th class="tablehead">管理操作</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                             <form action="index.php?m=company&f=biz_photo&v=sort" class="form-inline" method="post" target="_self">
                                      <?php foreach ($result as $key=>$r) { ?>
                                        <tr>
                                         <td class="center">
                                          <input type="checkbox" name="id[]" value="<?php echo $r['id'];?>">
                                          </td>

                                          <td class="orderlist"> <?php echo $r['index'];?></td>
                                           <td class="orderlist"><input type="text" class="center" style="width: 30px;padding:3px;" name="sorts[<?php echo $r[ 'id'];?>]" value="<?php echo $r[ 'sort'];?>"></td>
                                            
                                            <td class="orderlist "><a href="<?php echo WEBURL;?>xiaoguotu/136-<?php echo $r['id'];?>-<?php echo $page;?>.html"><font color="blue"><u><?php echo $r['title'];?></u></font></a></td>
                                            <td class="orderlist ">  <?php
                                            $house=array(1=>'一居',2=>'二居',3=>'三居',4=>'四居',5=>'五居',6=>'复式',7=>'别墅', 8=>'公寓',9=>'跃层',10=>'loft', 11=>'联排',12=>'独栋',13=>'四合院',14=>'其他');
                                            if ($r['housetype']!=14) {
                                                echo $house[$r['housetype']];
                                            }else{
                                                echo $house[$r['housetype']]."(".$r['otherHouseType'].")";
                                            }
                                            ?>
                                            </td>
                                            <td class="orderlist "><?php echo $r['area'];?>m&sup2;</td>
                                            <td class="orderlist "><?php echo $r['design'];?></td>
                                            <td class="orderlist "><?php echo date('Y-m-d H:i:s',$r['addtime'])?> </td>
                                            <td class="orderlist">
                                            <a href="index.php?m=company&f=biz_photo&v=edit&id=<?php echo $r['id'];?>">修改</a> | <a href="index.php?m=company&f=biz_photo&v=delete&id=<?php echo $r['id'];?>" class="isDel">删除</a></td>
                                        </tr>
                                        <?}?>
                                        </tbody>
                                    </table>

                       <div class="pull-left">
                                        <input id="v" name="v" type="hidden" value="<?php echo V;?>">
                                        <button type="button" onClick="checkall()" name="submit2" class="btn btn-default btn-sm">全选/反选</button>
                                        <button type="submit" onclick="$('#v').val('sort')" name="submit" class="btn btn-default btn-sm">排序</button>
                                        <button type="submit" onclick="$('#v').val('make_empty')" class="btn btn-default btn-sm">批量删除</button>
                        </div>
                    </form>

                     <?php } else { ?>
                              <table class="table table-striped table-advance table-hover text-center">
                                    <thead>
                                    <tr style="font-family:宋体;font-size:14px">
                                        <th class="tablehead" style="height:180px;font-size: larger">您目前还没有装修案例,增加装修案例能够提高接单几率,快去<a href="?m=company&f=biz_photo&v=add"><u color="blue"><b>创建</b></u></a>吧</th>
                                    </tr>
                                    </thead>
                                </table>
                            <?php } ?>
                      </div>



                                <?php if($total>10) { ?>
                                <div class="paginationpage text-center">
                                    <nav>
                                        <ul class="pagination">
                                            <?php echo $pages;?>
                                        </ul>
                                    </nav>
                                </div>
                                <?php } ?>
                            </div>



                        </div>


                    </section>
                </div>

            </div>
            <!--右侧结束-->


        </div>
    </div>
</div>
<script>
    $(function(){
        $(".form-horizontal").Validform({
            tiptype:1
        });
    })
    $(".isDel").click(function(){
        if (!confirm("案例被删除后不可恢复！\n确认要删除选择的案例？")) {
            return false;
        };
    })
    document.ready(function(){
        $.getJSON("<?php echo WEBURL;?>index.php?m=company&f=biz_photo&v=listing",{'a':'a'} function(data) {
            console.log(data)
        });
    })
</script>
<!--正文部分-->
<?php if(!isset($siteconfigs)) $siteconfigs=get_cache('siteconfigs'); include T('member','foot'); ?>
