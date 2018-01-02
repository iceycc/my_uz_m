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
                <div class="membertitle"><h3><?php if($this->memberinfo['modelid']==10) { ?>会员中心<?php } else { ?>商户中心<?php } ?></h3></div>
                <div class="memberborder">
                    <?php if(!isset($siteconfigs)) $siteconfigs=get_cache('siteconfigs'); include T('member','left'); ?>
                </div>
            </div>
            <!--左侧结束-->

            <!--右侧开始-->
            <div class="memberright">

                <div class="memberbordertop">
                    <section class="panel">
                        <div class="panel-heading"><span class="title">管理优惠活动</span></div>

                        <ul id="myTab" class="nav nav-tabs" role="tablist">
                            <li role="presentation" class="active"><a href="#tabs1" id="1tab" role="tab" data-toggle="tab" aria-controls="tabs1" aria-expanded="true">活动列表</a></li>
                            <li role="presentation" class=""><a href="?m=company&f=biz_market_sale&v=add">发布优惠活动</a></li>
                            </li>
                        </ul>

                        <div id="myTabContent" class="tab-content tabsbordertop">

                            <div role="tabpanel" class="tab-pane fade active in" id="tabs1" aria-labelledby="1tab">
                                <div class="panel-body" id="panel-bodys">
                                    <table class="table table-striped table-advance table-hover text-center">
                                        <thead>
                                        <tr>
                                            <th class="tablehead">活动名称</th>
                                            <th class="tablehead">状态</th>
                                            <th class="tablehead">管理操作</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php $n=1;if(is_array($result)) foreach($result AS $r) { ?>
                                        <tr>
                                            <td class="orderlist left"><?php echo $r['title'];?></td>
                                            <td class="orderlist"><?php if($r['status']==9) { ?><a href="<?php echo $r['url'];?>" target="_blank" class="color_cheng">点击访问</a><?php } else { ?><?php echo $status_arr[$r['status']];?><?php } ?></td>
                                            <td class="orderlist"><?php if($r['status']!=0) { ?><a href="index.php?m=company&f=biz_market_sale&v=edit&id=<?php echo $r['id'];?>">修改</a> | <a href="index.php?m=company&f=biz_market_sale&v=delete&id=<?php echo $r['id'];?>">删除</a><?php } ?></td>

                                        </tr>
                                        <?php $n++;}?>
                                        </tbody>
                                    </table>
                                </div>
                                <?php if($total>20) { ?>
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
</script>
<!--正文部分-->
<?php if(!isset($siteconfigs)) $siteconfigs=get_cache('siteconfigs'); include T('member','foot'); ?>
