<?php defined('IN_WZ') or exit('No direct script access allowed'); ?><?php if(!isset($siteconfigs)) $siteconfigs=get_cache('siteconfigs'); include T("content","head",TPLID); ?>
<div class="container Site_map"> 当前位置：<a href="<?php echo WEBURL;?>">首页</a><span> &gt; <?php echo catpos($cid);?></span></div>

<div class="bankuai_1 pd5">
    <div class="container">
        <div class="row">
            <div class="col-xs-10" style="border-right:1px solid #eee">
                <div class="bignewsbox_gg">
                    <div class="Nbd_gg"><img src="<?php echo $thumb;?>" class="thumbnail">
                        <p><a href="#"><span style="font-weight:600; font-size:16px"><?php echo $title;?></span></a><br>
                            商品编码：<span class="color_danger"><?php echo $id;?></span>&nbsp;&nbsp;&nbsp;&nbsp; 库存：<span class="color_danger">有货</span><br>
                        <hr/>
                        支付方式：积分兑换
                        <hr/>
                        尊享价：<span class="color_danger" style="font-weight:600" ><?php echo $point;?>积分</span><br><br>
                        &nbsp;<a href="<?php echo WEBURL;?>index.php?m=order&id=<?php echo $id;?>&cid=<?php echo $cid;?>" class="btn btn-danger" role="button" >立即兑换</a></p>
                    </div>
                </div>
                <h3>商品详情</h3>
                <div class="bignewsbox_gg">
                    <div>
                        <?php echo $content;?>
                    </div>
                </div>

            </div>



            <div class="col-xs-2">
                <h4>==礼品推荐==</h4>
                

            </div>
        </div>
    </div>
</div>
<script type="text/javascript" src="<?php echo WEBURL;?>index.php?f=stat&id=<?php echo $id;?>&cid=<?php echo $cid;?>"></script>
<?php if(!isset($siteconfigs)) $siteconfigs=get_cache('siteconfigs'); include T("content","foot",TPLID); ?>