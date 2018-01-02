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
<style>
    #content {
        height: 80px;
    }
</style>

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
                        <div class="panel-heading"><span class="title">我的装修订单</span></div>
                        <ul id="myTab" class="nav nav-tabs" role="tablist">
                            <li role="presentation" <?php if($type==0) { ?>class="active"<?php } ?>><a href="?m=company&f=biz_decorate_service&v=decorate_order&type=0" id="1tab" >已完成(<?php echo $total;?>)</a></li>
                            <li role="presentation" <?php if($type==1) { ?>class="active"<?php } ?>><a href="?m=company&f=biz_decorate_service&v=decorate_order&type=1" role="tab" id="2tab" >未完成 (<?php echo $total2;?>)</a></li>
                        </ul>
                        <div id="myTabContent" class="tab-content tabsbordertop">
                            <div role="tabpanel" class="tab-pane fade active in" id="tabs1" aria-labelledby="1tab">
                                <?php $n=1;if(is_array($result)) foreach($result AS $r) { ?>
                                <div class="row">
                                    <div class="col-xs-12" style="text-align: left; color: #666; padding-bottom:12px; margin-bottom:30px;border-bottom: 1px solid #eeeeee"><strong>订单号：</strong> <?php echo $r['order_no'];?>  &nbsp;&nbsp;&nbsp;&nbsp; <strong>下单时间：</strong><?php echo date('Y-m-d H:i:s',$r['addtime']);?> &nbsp;&nbsp;&nbsp;&nbsp;<?php if($r['progress']==0) { ?><strong>【待受理】</strong><?php } ?></div>
                                    <div class="col-xs-3" style="text-align: right; margin-right: -20px; color: #999">

                                        <?php if($r['progress']>0) { ?>
                                        <p style=" margin-top: 2px;"><?php echo date('Y-m-d H:i:s',$r['progress1time']);?></p>
                                        <?php } ?>
                                        <?php if($r['progress']>1) { ?>
                                        <p style=" margin-top: 33px;"><?php echo date('Y-m-d H:i:s',$r['progress2time']);?></p>
                                        <?php } ?>
                                        <?php if($r['progress']>2) { ?>
                                        <p style=" margin-top: 33px;"><?php echo date('Y-m-d H:i:s',$r['progress3time']);?></p>
                                        <?php } ?>
                                        <?php if($r['progress']>3) { ?>
                                        <p style=" margin-top: 33px;"><?php echo date('Y-m-d H:i:s',$r['progress4time']);?></p>
                                        <?php } ?>
                                    </div>
                                    <?php if($r['progress']) { ?>
                                    <div class="col-xs-1" style="width: 36px;">

                                        <div class="order_process_icon">
                                            <span class="score-value-no score-value-d<?php echo $r['progress'];?>">
                                                <em></em>
                                            </span>
                                        </div>

                                    </div>
                                    <?php } ?>
                                    <div class="col-xs-4" style="color: #777">

                                        <?php if($r['progress']>0) { ?>
                                        <p style=" margin-top: 2px;">已申请量房，订单受理中</p>
                                        <?php } ?>
                                        <?php if($r['progress']>1) { ?>
                                        <p style=" margin-top: 33px;">已分配装修公司</p>
                                        <?php } ?>
                                        <?php if($r['progress']>2) { ?>
                                        <p style=" margin-top: 33px;">施工中</p>
                                        <?php } ?>
                                        <?php if($r['progress']>3) { ?>
                                        <p style=" margin-top: 33px;">订单已完结</p>
                                        <?php } ?>
                                    </div>
                                </div><hr style="margin-left: -15px; margin-right: -15px; margin-bottom: 15px;">
<?php $n++;}?>

                        </div>


                    </section>
                </div>
            </div>
            <!--右侧结束-->
        </div>
    </div>
</div>

<!--正文部分-->
<?php if(!isset($siteconfigs)) $siteconfigs=get_cache('siteconfigs'); include T('member','foot'); ?>
