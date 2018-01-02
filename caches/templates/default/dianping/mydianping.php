<?php defined('IN_WZ') or exit('No direct script access allowed'); ?><?php if(!isset($siteconfigs)) $siteconfigs=get_cache('siteconfigs'); include T('member','head'); ?>
<script src="<?php echo R;?>member/js/jscarousel.js" type="text/javascript"></script>
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
<!--正文部分-->
<div class="container adframe">
    <div class="row">
        <div class="col-lg-12 col-xs-12">
            
        </div>
    </div>
</div>

<div class="container memberframe">
    <div class="row">
        <div class="col-lg-12 col-xs-12">
            <!--左侧开始-->
            <div class="memberleft">
                <div class="membertitle"><h3>会员中心</h3></div>
                <div class="memberborder">
                    <?php if(!isset($siteconfigs)) $siteconfigs=get_cache('siteconfigs'); include T('member','left'); ?>
                </div>
            </div>
            <!--左侧结束-->

            <!--右侧开始-->
            <div class="memberright">

                <div class="memberbordertop">
                    <section class="panel">
                        <header class="panel-heading"><span class="title">我的点评</span></header>
                        <div class="panel-body" id="panel-bodys">
                            <table class="table table-striped table-advance table-hover text-center">
                                <thead>
                                <tr>
                                    <th class="tablehead"><h5>点评(<?php echo $total;?>)</h5></th>
                                </tr>
                                </thead>

                                <tbody>
                                <?php $n=1;if(is_array($result)) foreach($result AS $r) { ?>
                                <?php $id = substr($r['keyid'],3);?>
                                <?php $mecr=get_mec($id);?>
                                <tr>
                                    <td class="text-left shoptitle"><a href="<?php echo $mecr['url'];?>"><?php echo $mecr['title'];?></a></td>
                                </tr>
                                <tr>
                                    <td colspan="3" class="text-left mycomment">
                                        总评：<div class="star"><?php echo star($r['field1'],5);?></div>
                                        环境：<div class="star"><?php echo star($r['field2'],5);?></div>
                                        服务：<div class="star"><?php echo star($r['field3'],5);?></div>
                                        <div class="price">费用：￥<?php echo $r['field4'];?></div>
                                        <div class="comment"><p><?php echo $r['field5'];?></p><p>停车信息：<?php echo $r['field6'];?></p></div>
                                        <?php if($r['data']) { ?>
                                        <?php $pics = explode("\r\n",$r['data']);?>
                                        <div class="picgroup">
                                            <?php $n=1;if(is_array($pics)) foreach($pics AS $pic) { ?>
                                            <a href="<?php echo $pic;?>" target="_blank"><img src="<?php echo $pic;?>"></a>
                                            <?php $n++;}?></div>
                                        <?php } ?>
                                        <div class="commentinfo"><span class="text-left">发表于 <?php echo date('Y-m-d H:i:s',$r['addtime']);?></span> <div class="pull-right"> <span><a href="?m=dianping&f=index&v=delete&id=<?php echo $r['id'];?>">删除</a></span></div></div>
                                    </td>
                                </tr>
<?php $n++;}?>
                                </tbody>
                            </table>
                        </div>

                        <!--分页开始-->
                        <div class="paginationpage text-center">
                            <nav>
                                <ul class="pagination">
                                    <?php echo $pages;?>
                                </ul>
                            </nav>
                        </div>
                        <!--分页结束-->
            </section>
            </div>

        </div>
            <!--右侧结束-->


        </div>
    </div>
</div>
<!--正文部分-->
<?php if(!isset($siteconfigs)) $siteconfigs=get_cache('siteconfigs'); include T('member','foot'); ?>

