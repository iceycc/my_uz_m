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
               
                    <?php if(!isset($siteconfigs)) $siteconfigs=get_cache('siteconfigs'); include T('member','left'); ?>
                
            </div>
            <!--左侧结束-->

            <!--右侧开始-->
            <div class="memberright">

                <div class="memberbordertop">
                    <section class="panel">
                        <div class="panel-heading"><span class="title">装修保险</span></div>

                        <ul id="myTab" class="nav nav-tabs" role="tablist">
                            <li role="presentation" class="active"><a href="#tabs1" id="1tab" role="tab" data-toggle="tab" aria-controls="tabs1" aria-expanded="true">申请装保险</a></li>
                            <li role="presentation" class=""><a href="#tabs2" role="tab" id="2tab" data-toggle="tab" aria-controls="tabs2" aria-expanded="false">申请记录</a></li>
                            </li>
                        </ul>

                        <div id="myTabContent" class="tab-content tabsbordertop">

                            <div role="tabpanel" class="tab-pane fade active in" id="tabs1" aria-labelledby="1tab">

                                <form name="myform" class="form-horizontal" action="" method="post" id="myform">
                                    <table class="table table-striped table-advance table-hover text-center">
                                        <tr>
                                            <td><div class="form-groupinfo"><label class="col-sm-2 control-label text-right text-blod"><font color="red">*</font> 被保险人姓名：</label><div class="col-sm-4 text-left">
                                                <input type="text" style="color:#" name="form[title]" id="title" maxlength="50" value="" class="form-control" datatype="*2-50" nullmsg="请填写被保险人姓名" errormsg="被保险人姓名至少2个字符,最多50个字符！">                                       </div></div></td>
                                        </tr>

                                        <?php $n=1;if(is_array($field_list)) foreach($field_list AS $info) { ?>
                                        <tr>
                                            <td><div class="form-groupinfo"><label class="col-sm-2 control-label text-right text-blod"><?php if($info['star']) { ?><font color="red">*</font><?php } ?> <?php echo $info['name'];?>：</label><div class="col-sm-10 text-left">
                                                <?php echo $info['form'];?>
                                            </div></div></td>
                                        </tr>
                                        <?php $n++;}?>

                                        <tr>
                                            <td><div class="form-groupinfo"><label class="col-sm-2 control-label text-right"> </label><div class="col-sm-3 text-left"><input type="submit" name="submit" id="submit" value="提交" class="btn btn-order"></div></div></td>
                                        </tr>
                                    </table>
                                </form>

                            </div>


                            <div role="tabpanel" class="tab-pane fade" id="tabs2" aria-labelledby="2tab">
                                <div class="panel-body" id="panel-bodys">
                                    <table class="table table-striped table-advance table-hover text-center">
                                        <thead>
                                        <tr>
                                            <th class="tablehead">被保险人姓名</th>
                                            <th class="tablehead">订单编号</th>
                                            <th class="tablehead">身份证号</th>
                                            <th class="tablehead">手机号</th>
                                            <th class="tablehead">保单开始时间</th>
                                            <th class="tablehead">装修开始时间</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php $n=1;if(is_array($result)) foreach($result AS $r) { ?>
                                        <tr>
                                            <td class="orderlist"><?php echo $r['title'];?></td>
                                            <td class="orderlist"><?php echo $r['order_no'];?></td>
                                            <td class="orderlist"><?php echo $r['idcard'];?></td>
                                            <td class="orderlist"><?php echo $r['mobile'];?></td>
                                            <td class="orderlist"><?php echo $r['starttime'];?></td>
                                            <td class="orderlist"><?php echo $r['zxtime'];?></td>
                                        </tr>
                                        <tr>
                                            <td class="orderlist" ><strong>房屋地址：</strong></td>
                                            <td class="orderlist left" colspan="5"><?php echo $r['address'];?></td>
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
        $(".form-horizontal").Validform({
            tiptype:2,
            datatype:{//传入自定义datatype类型【方式二】;
                "idcard":function(gets,obj,curform,datatype){
                    //该方法由佚名网友提供;

                    var Wi = [ 7, 9, 10, 5, 8, 4, 2, 1, 6, 3, 7, 9, 10, 5, 8, 4, 2, 1 ];// 加权因子;
                    var ValideCode = [ 1, 0, 10, 9, 8, 7, 6, 5, 4, 3, 2 ];// 身份证验证位值，10代表X;

                    if (gets.length == 15) {
                        return isValidityBrithBy15IdCard(gets);
                    }else if (gets.length == 18){
                        var a_idCard = gets.split("");// 得到身份证数组
                        if (isValidityBrithBy18IdCard(gets)&&isTrueValidateCodeBy18IdCard(a_idCard)) {
                            return true;
                        }
                        return false;
                    }
                    return false;

                    function isTrueValidateCodeBy18IdCard(a_idCard) {
                        var sum = 0; // 声明加权求和变量
                        if (a_idCard[17].toLowerCase() == 'x') {
                            a_idCard[17] = 10;// 将最后位为x的验证码替换为10方便后续操作
                        }
                        for ( var i = 0; i < 17; i++) {
                            sum += Wi[i] * a_idCard[i];// 加权求和
                        }
                        valCodePosition = sum % 11;// 得到验证码所位置
                        if (a_idCard[17] == ValideCode[valCodePosition]) {
                            return true;
                        }
                        return false;
                    }

                    function isValidityBrithBy18IdCard(idCard18){
                        var year = idCard18.substring(6,10);
                        var month = idCard18.substring(10,12);
                        var day = idCard18.substring(12,14);
                        var temp_date = new Date(year,parseFloat(month)-1,parseFloat(day));
                        // 这里用getFullYear()获取年份，避免千年虫问题
                        if(temp_date.getFullYear()!=parseFloat(year) || temp_date.getMonth()!=parseFloat(month)-1 || temp_date.getDate()!=parseFloat(day)){
                            return false;
                        }
                        return true;
                    }

                    function isValidityBrithBy15IdCard(idCard15){
                        var year =  idCard15.substring(6,8);
                        var month = idCard15.substring(8,10);
                        var day = idCard15.substring(10,12);
                        var temp_date = new Date(year,parseFloat(month)-1,parseFloat(day));
                        // 对于老身份证中的你年龄则不需考虑千年虫问题而使用getYear()方法
                        if(temp_date.getYear()!=parseFloat(year) || temp_date.getMonth()!=parseFloat(month)-1 || temp_date.getDate()!=parseFloat(day)){
                            return false;
                        }
                        return true;
                    }

                }

            }});


    })
</script>
<!--正文部分-->
<?php if(!isset($siteconfigs)) $siteconfigs=get_cache('siteconfigs'); include T('member','foot'); ?>
