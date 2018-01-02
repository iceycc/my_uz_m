<?php defined('IN_WZ') or exit('No direct script access allowed'); ?><?php if(!isset($siteconfigs)) $siteconfigs=get_cache('siteconfigs'); include T('member','head'); ?>
<link type="text/css" rel="stylesheet" href="<?php echo R;?>h1jk/css/tuangou_style.css" xmlns="http://www.w3.org/1999/html">
<!-- 购物车商品 -->
<!-- ---------------------------------- -->

<div class="container">
    <div class="gmwidth">
        <div class="row">
            <form name="orderform" action="?m=order&f=order_goods&v=index" method="post">
            <div class="col-xs-12">
                <div class="gouwuche_box">
                    <table class="table table-hover">
                        <caption class="margin_bottom10">
                            全部商品（<?php echo $number;?>）&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;
                            <button type="button" class="btn btn-primary" onclick="gotourl('<?php echo WEBURL;?>')"><span class="glyphicon glyphicon-chevron-left"></span> 继续购物</button>
                            &nbsp;&nbsp;&nbsp;&nbsp; <button type="button" class="btn btn btn-danger_g" onclick="gotourl('<?php echo WEBURL;?>index?m=order&f=order_goods&v=delete')"> <span class="glyphicon glyphicon-remove"></span> 清空购物车</button>
                        </caption>

                        <thead>
                        <tr>
                            <th>选择</th>
                            <th>商品</th>
                            <th><div align="center">机构价</div></th>
                            <th><div align="center">会员价</div></th>
                            <th><div align="center">数量</div></th>
                            <th><div align="center">优惠</div></th>
                            <th><div align="center">操作</div></th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $n=1;if(is_array($result)) foreach($result AS $r) { ?>
                        <tr>
                            <td><div class="checkbox">
                                <label>
                                    <input name="cartids[]" value="<?php echo $r['cartid'];?>" onclick="count_price()" type="checkbox" checked>
                                </label>
                            </div></td>
                            <td width="438px;"><a href="<?php echo $r['goods_detail']['url'];?>"><img src="<?php echo $r['goods_detail']['thumb'];?>" width="80"><span style=" margin-left:16px;"><?php echo $r['goods_detail']['title'];?></span></a></td>
                            <td><div align="center"><span class="text_through color_777">￥<span id="price_old<?php echo $r['cartid'];?>"><?php echo $r['goods_detail']['price_old'];?></span></span></div></td>
                            <td><div align="center"><span class="color_heyihong font_weight">￥<span id="price<?php echo $r['cartid'];?>"><?php echo $r['goods_detail']['price'];?></span></span></div></td>
                            <td><div class="item-amount ">
                                <div align="center"><a href="javascript:change_quantity(<?php echo $r['cartid'];?>,0);" class="J_Minus no-minus">-</a>
                                    <input type="text" id="quantity<?php echo $r['cartid'];?>" name="quantity[<?php echo $r['cartid'];?>]" value="<?php echo $r['quantity'];?>" class="text text-amount J_ItemAmount" data-max="<?php echo $r['max_quantity'];?>" data-min="<?php echo $r['min_quantity'];?>" onkeyup="this.value=this.value.replace(/\D/g,'')" onafterpaste="this.value=this.value.replace(/\D/g,'')" onblur="check_nums(this);">
                                    <a href="javascript:change_quantity(<?php echo $r['cartid'];?>,1);" class="J_Plus plus">+</a></div>
                            </div></td>
                            <td><div align="center"><span class="font_size12 color_heyihong">已省 ￥<span id="jr_price<?php echo $r['cartid'];?>"><?php echo $r['jr_price'];?></span><br>
                返积分 <span id="point<?php echo $r['cartid'];?>"><?php echo intval($r['goods_detail']['price']/2);?></span></span></div></td>
                            <td><div align="center"><a href="?m=order&f=order_goods&v=del&id=<?php echo $r['cartid'];?>">删除</a></div></td>
                        </tr>
<?php $n++;}?>
                        </tbody>
                    </table>
                </div>
                <div class="gwnext">
                     <span class="float_right">合计：<span style="font-weight:700; font-size:18px;" class="color_heyihong">￥<span id="total_price"><?php echo $total_price;?></span></span> &nbsp;&nbsp;&nbsp;&nbsp;
          <button type="submit" class="btn btn-danger_g active">&nbsp;&nbsp;下一步&nbsp;&nbsp;</button>
          </span>
                </div>
            </div></form>
        </div>
    </div>
</div>
<script>
    function check_nums(obj) {
        var max = $(obj).attr('data-max');
        var min = $(obj).attr('data-min');
        max = parseInt(max);
        min = parseInt(min);
        if($(obj).val()>max) {
            alert('数量超过库存量');
            $(obj).val(max);
        }
        if($(obj).val()<min) {
            alert('该商品数量不能低于'+min);
            $(obj).val(min);
        }
        count_price();
    }
    function count_price() {
        var chk_value =[];
        var chk_value2 =[];
        var id = '';
        $('input[name="cartids[]"]:checked').each(function(){
            id = $(this).val();
            chk_value.push(id);
            chk_value2.push($("#quantity"+id).val());
        });
        //alert(chk_value.length==0 ?'你还没有选择任何内容！':chk_value);
        $.getJSON("?m=order&f=order_goods&v=count_price", { cartids: chk_value, quantity:chk_value2 },
                function(data){
                    $("#total_price").html(data.total_price);
                    $.each(data.result, function(idx, obj) {
                        $("#price"+obj.cartid).html(obj.price);
                        $("#price_old"+obj.cartid).html(obj.price_old);
                        $("#jr_price"+obj.cartid).html(obj.jr_price);
                        $("#point"+obj.cartid).html(obj.point);
                    });
                });
    }
    function change_quantity(id,type) {
        var min = $("#quantity"+id).attr('data-min');
        min = parseInt(min);
        var quantity = $("#quantity"+id).val();
        quantity = parseInt(quantity);
        if(type=='1') {
            quantity = quantity+1;
        } else {
            quantity = quantity-1;
            //if(quantity<min) quantity = min;
        }
        $("#quantity"+id).val(quantity);
        check_nums($("#quantity"+id));
    }
</script>
<!-- ---------------------------------- -->

<!--正文部分-->
<?php if(!isset($siteconfigs)) $siteconfigs=get_cache('siteconfigs'); include T('member','foot'); ?>
