<?php defined('IN_WZ') or exit('No direct script access allowed'); ?><?php if(!isset($siteconfigs)) $siteconfigs=get_cache('siteconfigs'); include T('member','head'); ?>
<script src="<?php echo R;?>member/js/jscarousel.js" type="text/javascript"></script>
<link href="<?php echo R;?>css/validform.css" rel="stylesheet" />
<script src="<?php echo R;?>js/validform.min.js"></script>
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
        <?php if(isset($GLOBALS['tabid'])) { ?>
        $("#<?php echo $GLOBALS['tabid'];?>").click();
            <?php } ?>
    });
</script>
<style type="text/css">
    *{font-family:宋体;}
    .no-border{
        border-right:3px solid white;
        border-left:3px solid white;
    }
    .border-top{
        border:1px solid #CCCCCC;
        border-bottom:0px;
    }
    .border-both{
        border-left:1px solid #CCCCCC;
        border-right:1px solid #CCCCCC;
    }
    .border-bottom{
        border:1px solid #CCCCCC;
        border-top:0px;
    }
    .border-all{
        border:1px solid #CCCCCC;
    }
</style>
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
        
                <div class="memberborder">
                    <?php if(!isset($siteconfigs)) $siteconfigs=get_cache('siteconfigs'); include T('member','left'); ?>
                </div>
            </div>
            <!--左侧结束-->

            <!--右侧开始-->
            <div class="memberright">

                <div class="memberbordertop">
                    <section class="panel">
                        <div class="panel-heading"><span class="title">账户信息</span></div>

                        <ul id="myTab" class="nav nav-tabs" role="tablist">
                            <li role="presentation" class="active"><a href="#tabs1" id="1tab" role="tab" data-toggle="tab" aria-controls="tabs1" aria-expanded="true">基本信息</a></li>
                            <!-- <li role="presentation" class=""><a href="#tabs2" role="tab" id="2tab" data-toggle="tab" aria-controls="tabs2" aria-expanded="false">设置密码</a></li>
                            <li role="presentation" class=""><a href="?m=member&amp;f=index&amp;v=avatar">修改头像</a></li> -->
                        </ul>


                        <div id="myTabContent" class="tab-content tabsbordertop" style="margin:0px;padding:0px;">
                        <!-- <div role="tabpanel" class="tab-pane active in" id="tabs3" aria-labelledby="3tab"> -->

                            <div role="tabpanel" class="tab-pane  active in" id="tabs1" aria-labelledby="1tab">
                                <div class="panel-body" id="panel-bodys">
                                    <form class="form-horizontal" role="form" name="myform" action="index.php?m=company&f=biz_setting&v=companyInformation&id=123" method="post" id="myform" onsubmit="return formsubmit();">

<table style="border-bottom:0px;" class="table table-striped table-advance table-hover text-center">
   <!--  <div style="border:1px solid green;height:50px;">
       
   </div> -->
<!--公司基本信息  -->
        <tr class="border-top" style="width:893px;">
            <td>
                <div class="form-groupinfo"><label class="col-sm-3 control-label text-right"><font color="red">*</font> 公司名称：</label>
                    <div class="col-sm-7 text-left">
                    <input type="text" name="form[companyname]" id="companyname" size="" placeholder="" value="<?php echo $r['companyname'];?>" class="form-control" datatype="*" sucmsg="OK" errormsg="请输入公司名称" nullmsg="请输入公司名称" readonly="">
                    <span class="tablewarnings"></span>
                    </div>
                </div>
            </td>
        </tr>

        <tr class="border-both">
            <td><div class="form-groupinfo"><label class="col-sm-3 control-label text-right"><font color="red">*</font> 施工等级资质：</label>
            <div class="col-sm-7 text-left"> 
            <label class="radio-inline">
            <input type="radio" disabled="disabled" <?php if($r['ConstructQuay']==1) { ?>checked="checked"<?php } ?> name="form[ConstructQuay]" datatype="n" sucmsg="OK" errormsg="请选择施工等级资质" nullmsg="请选施工等级资质" value="1" checked=""> 一级</label> 
            <label class="radio-inline">
            <input type="radio" disabled="disabled" <?php if($r['ConstructQuay']==2) { ?>checked="checked"<?php } ?> name="form[ConstructQuay]" datatype="n" sucmsg="OK" errormsg="请选择施工等级资质" nullmsg="请选施工等级资质" value="2"> 二级</label> 
            <label class="radio-inline">
            <input type="radio" disabled="disabled" <?php if($r['ConstructQuay']==3) { ?>checked="checked"<?php } ?> name="form[ConstructQuay]" datatype="n" sucmsg="OK" errormsg="请选择施工等级资质" nullmsg="请选施工等级资质" value="3"> 三级</label><span class="tablewarnings"></span></div></div></td>
        </tr>

        <tr class="border-both">
            <td><div class="form-groupinfo"><label class="col-sm-3 control-label text-right"><font color="red">*</font> 店铺负责人姓名：</label><div class="col-sm-7 text-left"><input type="text" name="form[fzrxm]" id="fzrxm" size="" placeholder="" value="<?php echo $r['fzrxm'];?>" class="form-control" datatype="*" sucmsg="OK" errormsg="请填写负责人姓名" nullmsg="请填写负责人姓名！"><span class="tablewarnings"></span></div></div></td>
        </tr>

        <!-- <tr class="border-both">
            <td><div class="form-groupinfo"><label class="col-sm-3 control-label text-right"><font color="red">*</font> 店铺负责人手机号码：</label><div class="col-sm-7 text-left"><input type="text" name="form[chargePersonPhone]" id="chargePersonPhone" size="" placeholder="请输入店铺负责人手机号" value="<?php echo $r['chargePersonPhone'];?>" class="form-control" datatype="*" sucmsg="OK" errormsg="请输入店铺负责人手机号" nullmsg="请输入店铺负责人手机号"><span class="tablewarnings"></span></div></div></td>
        </tr> -->

        <tr class="border-both">
            <td><div class="form-groupinfo"><label class="col-sm-3 control-label text-right"><font color="red">*</font> 店铺负责人手机号码：</label><div class="col-sm-7 text-left"><label style="line-height:25px;"><?php echo $p;?></label><input style="position:relative;left:100px;" class="changePhone" name="changePhone" type="button" value="点击修改"><span class="tablewarnings"></span></div></div></td>
        </tr>


        <tr class="border-both">
            <td><div class="form-groupinfo"><label class="col-sm-3 control-label text-right">公司邮箱：</label><div class="col-sm-8 text-left" style="padding-top: 6px;"><?php echo $e;?><!-- caozhi@uzhuang.com --> <a href="?m=member&amp;f=index&amp;v=editMerchantEmail" style="color:#2a3bfb;"><input style="position:relative;left:52px;color:black;" class="changeEmail" type="button" value="点击修改" ><!--，您的邮箱还未验证通过验证后可获积分：10点，点击验证--></a> </div></div></td>
        </tr>

        <!-- <tr class="border-both">
            <td><div class="form-groupinfo"><label class="col-sm-3 control-label text-right"><font color="red">*</font> 公司详细地址：</label>
                <div class="col-sm-7 text-left">
                    <div id="wz_areaid">
                        <input name="form[areaid]" id="areaid" type="hidden" value="1044">
                        <div class="col-sm-4">
                    <select name="LK1_1" class="LK1_1 form-control" id="LK1_1">
                        <option value="0">请选择</option>
                        <option value="2">北京市</option>
                        <option value="3">上海市</option>
                        <option value="4">天津市</option>
                        <option value="5">重庆市</option>
                        <option value="6">河北省</option>
                        <option value="7">山西省</option>
                        <option value="8">内蒙古</option>
                        <option value="9">辽宁省</option>
                        <option value="10">吉林省</option>
                        <option value="11">黑龙江省</option>
                        <option value="12">江苏省</option>
                        <option value="13">浙江省</option>
                        <option value="14">安徽省</option>
                        <option value="15">福建省</option>
                        <option value="16">江西省</option>
                        <option value="17">山东省</option>
                        <option value="18">河南省</option>
                        <option value="19">湖北省</option>
                        <option value="20">湖南省</option>
                        <option value="21">广东省</option>
                        <option value="22">广西</option>
                        <option value="23">海南省</option>
                        <option value="24">四川省</option>
                        <option value="25">贵州省</option>
                        <option value="26">云南省</option>
                        <option value="27">西藏</option>
                        <option value="28">陕西省</option>
                        <option value="29">甘肃省</option>
                        <option value="30">青海省</option>
                        <option value="31">宁夏</option>
                        <option value="32">新疆</option>
                        <option value="33">台湾省</option>
                        <option value="34">香港</option>
                        <option value="35">澳门</option>
                        <option value="3358">钓鱼岛</option>
                    </select>
                        </div>
                        <div class="col-sm-4">
                        <select name="LK1_2" class="form-control" id="LK1_2"></select>
                        </div>
                    <div class="col-sm-4">
                    <select name="LK1_3" class="form-control" id="LK1_3"></select>
                    </div>
                    </div>
                <span class="tablewarnings"></span>
                </div>
                </div>
            </td>
        </tr>
        <tr class="border-both">
            <td><div class="form-groupinfo"><label class="col-sm-3 control-label text-right"><font color="red"></font></label><div class="col-sm-7 text-left"><input type="text" name="form[one_text]" id="one_text" size="" placeholder="" value="<?php echo $r['one_text'];?>" class="form-control" datatype="*" sucmsg="OK" errormsg="请输入公司详细地址" nullmsg="请输入正确的公司详细地址"><span class="tablewarnings"></span></div></div></td>
        </tr> -->
        
        <tr class="border-both">
            <td><div class="form-groupinfo"><label class="col-sm-3 control-label text-right"><font color="red">*</font> 服务区域：</label>
            <div class="col-sm-7 text-left">
                <div id="wz_areaid">
                    <input name="form[areaid]" id="areaid" type="hidden" value="1044">
                    <div class="col-sm-4">
                <select name="form[serviec_1]" class="LK1_1 form-control" id="serviec_1" onchange="linkage('areaid',this.value,this)" data-value="10">
                    <option value="0">请选择</option>
                    <option value="2">北京市</option>
                    <option value="3">上海市</option>
                    <option value="4">天津市</option>
                    <option value="5"> 重庆市</option>
                    <option value="6">河北省</option>
                    <option value="7">山西省</option>
                    <option value="8">内蒙古</option>
                    <option value="9">辽宁省</option>
                    <option value="10">吉林省</option>
                    <option value="11">黑龙江省</option>
                    <option value="12">江苏省</option>
                    <option value="13">浙江省</option>
                    <option value="14">安徽省</option>
                    <option value="15">福建省</option>
                    <option value="16">江西省</option>
                    <option value="17">山东省</option>
                    <option value="18">河南省</option>
                    <option value="19">湖北省</option>
                    <option value="20">湖南省</option>
                    <option value="21">广东省</option>
                    <option value="22">广西</option>
                    <option value="23">海南省</option>
                    <option value="24">四川省</option>
                    <option value="25">贵州省</option>
                    <option value="26">云南省</option>
                    <option value="27">西藏</option>
                    <option value="28">陕西省</option>
                    <option value="29">甘肃省</option>
                    <option value="30">青海省</option>
                    <option value="31">宁夏</option>
                    <option value="32">新疆</option>
                    <option value="33">台湾省</option>
                    <option value="34">香港</option>
                    <option value="35">澳门</option>
                    <option value="3358">钓鱼岛</option>
                </select>
                    </div>
                    <div class="col-sm-4">
                        <select name="form[serviec_2]" class="form-control" id="serviec_2" onchange="linkage('areaid',this.value,this)" data-value="">
                            
                        </select>
                    </div>
                <div class="col-sm-4">
                <select name="form[serviec_3]" class="form-control" id="serviec_3" onchange="linkage('areaid',this.value,this)" data-value="" style="display:none;">
                    
                </select>
                </div>
                </div>
            <span class="tablewarnings"></span>
            </div>
            </div>
            </td>
        </tr>
        <tr class="border-both">
            <td><div class="form-groupinfo">
                <label class="col-sm-3 control-label text-right"><font color="red"></font> </label>
                <div class="col-sm-7 text-left">
                    <!-- <input type="hidden" name="form[areaids][]" value="no_value"> -->
                    <div id="areaids_div" class="col-sm-12 input-group serviceArea">
                        
                    </div>
                    <span class="tablewarnings"></span>
                </div></div></td>
        </tr>
        
        <!-- <tr>
            <td>
                <div class="form-groupinfo">
                    <div class="col-sm-7 text-left" style="padding-left:265px;width:755px;">
                        <label class="checkbox-inline serviceArea">
                        <input name="form[areaids][]" type="checkbox" value="1042">昌邑区</label><label class="checkbox-inline">
                        </div>
                        <span class="tablewarnings"></span>
                    </div>
                </div>
            </td>
        </tr> -->

        <tr class="border-bottom">
            <td>
            <div class="form-groupinfo"><label class="col-sm-3 control-label text-right"><font color="red">*</font> 公司座机：</label><div class="col-sm-7 text-left"><input type="text" name="form[gszj]" id="gszj" size="" placeholder="请输入座机号码" value="<?php echo $r['gszj'];?>" class="form-control" datatype="/^(0[0-9]{2,3}-)?([2-9][0-9]{6,7})+(-[0-9]{1,4})?$/" sucmsg="OK" errormsg="请输入公司座机号码" nullmsg="请输入公司座机号码！"><span class="tablewarnings"></span></div></div></td>
        </tr>

        <tr class="no-border">
            <td><div class="form-groupinfo"><label class="col-sm-3 control-label text-right"></label><div class="col-sm-7 text-left">
            <span class="tablewarnings"></span></div></div></td>
        </tr>

<!-- 银行信息 -->
        <tr class="border-top">
            <td><div class="form-groupinfo"><label class="col-sm-3 control-label text-left" style="font-size:15px;">银行信息</label><div class="col-sm-7 text-left">
            <span class="tablewarnings"></span></div></div></td>
        </tr>

        <tr class="border-both">
            <td><div class="form-groupinfo"><label class="col-sm-3 control-label text-right"><font color="red">*</font> 公司基本户账号：</label><div class="col-sm-7 text-left"><input disabled="disabled" type="text" name="form[combasacc]" id="combasacc" size="50" placeholder="请输入公司基本户账号" value="<?php echo $r['combasacc'];?>" class="form-control" datatype="*" sucmsg="OK" errormsg="请输入公司基本户号" nullmsg="请输入公司基本户号！"><span class="tablewarnings"></span></div></div></td>
        </tr>

        <tr class="border-both">
            <td><div class="form-groupinfo"><label class="col-sm-3 control-label text-right"><font color="red">*</font> 公司基本户账号开户银行：</label><div class="col-sm-7 text-left"><input disabled="disabled" type="text" name="form[accountbank]" id="accountbank" size="" placeholder="请输入基本户账号开户银行" value="<?php echo $r['accountbank'];?>" class="form-control" datatype="*" sucmsg="OK" errormsg="请输入基本户开户银行" nullmsg="请输入基本户开户银行"><span class="tablewarnings"></span></div></div></td>
        </tr>

         <tr class="border-both">
            <td><div class="form-groupinfo"><label class="col-sm-3 control-label text-right"><font color="red">*</font> 开户账户名称：</label><div class="col-sm-7 text-left"><input disabled="disabled" type="text" name="form[accountname]" id="accountname" size="" placeholder="请输入开户账户名称" value="<?php echo $r['accountname'];?>" class="form-control" datatype="*" sucmsg="OK" errormsg="请输入开户账户名称" nullmsg="请输入开户账户名称"><span class="tablewarnings"></span></div></div></td>
        </tr>

        <tr class="border-both">
            <td><div class="form-groupinfo"><label class="col-sm-3 control-label text-right"><font color="red">*</font> 开户行：</label><div class="col-sm-7 text-left"><input type="text" disabled="disabled" name="form[openaccount]" id="openaccount" size="" placeholder="请输入开户行" value="<?php echo $r['openaccount'];?>" class="form-control" datatype="*" sucmsg="OK" errormsg="请输入开户行" nullmsg="请输入开户行"><span class="tablewarnings"></span></div></div></td>
        </tr>
        
        <tr class="border-both">
            <td>
            <div class="form-groupinfo">
            <label class="col-sm-3 control-label text-right"><font color="red">*</font> 开户行所在省市：</label>
                <div class="col-sm-7 text-left">
                    <div id="wz_myfieldid6">
                    <input name="myfieldid6" id="myfieldid6" type="hidden" value="0">
                    <div class="col-sm-4">
                        <select name="BelongProvince" class="LK1_1 form-control" id="BelongProvince" onchange="linkage('myfieldid6',this.value,this)" data-value="0">
                            <option value="0">请选择</option>
                            <option value="2">北京市</option>
                            <option value="3">上海市</option>
                            <option value="4">天津市</option>
                            <option value="5"> 重庆市</option>
                            <option value="6">河北省</option>
                            <option value="7">山西省</option>
                            <option value="8">内蒙古</option>
                            <option value="9">辽宁省</option>
                            <option value="10">吉林省</option>
                            <option value="11">黑龙江省</option>
                            <option value="12">江苏省</option>
                            <option value="13">浙江省</option>
                            <option value="14">安徽省</option>
                            <option value="15">福建省</option>
                            <option value="16">江西省</option>
                            <option value="17">山东省</option>
                            <option value="18">河南省</option>
                            <option value="19">湖北省</option>
                            <option value="20">湖南省</option>
                            <option value="21">广东省</option>
                            <option value="22">广西</option>
                            <option value="23">海南省</option>
                            <option value="24">四川省</option>
                            <option value="25">贵州省</option>
                            <option value="26">云南省</option>
                            <option value="27">西藏</option>
                            <option value="28">陕西省</option>
                            <option value="29">甘肃省</option>
                            <option value="30">青海省</option>
                            <option value="31">宁夏</option>
                            <option value="32">新疆</option>
                            <option value="33">台湾省</option>
                            <option value="34">香港</option>
                            <option value="35">澳门</option>
                            <option value="3358">钓鱼岛</option>
                        </select>
                    </div>
                    <div class="col-sm-4">
                    <select name="BelongCity" class="form-control" id="BelongCity" onchange="linkage('myfieldid6',this.value,this)" data-value="" disabled="disabled"></select>
                    </div>
                    <div class="col-sm-4">
                        <select name="BelongCounty" class="form-control" id="BelongCounty" onchange="linkage('myfieldid6',this.value,this)" data-value="" disabled=""></select>
                    </div></div><script src="http://www.uzhuang.com/res/js/jquery.wuzhicms-select.js"></script>
            <script>
            $.wuzhicmsSelect.defaults.url = "/res/js/linkage/1.json";
            $("#wz_myfieldid6").wuzhicmsSelect({
            selects : ["LK1_1","LK1_2","LK1_3"]
            });
            </script>                                                
            </div>
            </div>
                <input name="BankProvince" type="hidden" value="11">
                <input name="BankCity" type="hidden" value="189">
                <input name="BankCounty" type="hidden" value="1131">
            </td>
        </tr>

        <tr class="border-both">
            <td><div class="form-groupinfo"><label class="col-sm-3 control-label text-right"><font color="red">*</font> 开户行支行名称：</label><div class="col-sm-7 text-left"><input disabled="disabled" type="text" name="form[branchname]" id="branchname" size="" placeholder="请输入开户行支行名称" value="<?php echo $r['branchname'];?>" class="form-control"><span class="tablewarnings"></span></div></div></td>
        </tr>
                                            
        <tr class="border-bottom">
            <td><div class="form-groupinfo"><label class="col-sm-3 control-label text-right"><font color="red">*</font> 银行账号：</label><div class="col-sm-7 text-left"><input disabled="disabled" type="text" name="form[BankNo]" id="BankNo" size="" placeholder="请输入银行账号" value="<?php echo $r['BankNo'];?>" class="form-control" datatype="*" sucmsg="OK" errormsg="请输入银行卡号" nullmsg="请输入银行卡号"><span class="tablewarnings"></span></div></div></td>
        </tr>
        <tr class="no-border">
            <td><div class="form-groupinfo"><label class="col-sm-3 control-label text-right"></label><div class="col-sm-7 text-left">
            <span class="tablewarnings"></span></div></div></td>
        </tr>
<!-- 公司资质信息 -->
        <tr class="border-top">
            <td><div class="form-groupinfo"><label class="col-sm-3 control-label text-left" style="font-size:15px;">公司资质信息</label><div class="col-sm-7 text-left">
            <span class="tablewarnings"></span></div></div></td>
        </tr>

        <tr class="border-both">
            <td><div class="form-groupinfo" style="padding-top:0px;line-height:210px;"><label class="col-sm-3 control-label text-right"><font color="red">*</font> 营业执照扫描件：</label><div class="col-sm-7 text-left"><!-- <div class="input-group"><script src="http://www.uzhuang.com/res/js/dialog/dialog-plus.js"></script><script type="text/javascript" src="http://www.uzhuang.com/res/js/json2.js"></script><script type="text/javascript" src="http://www.uzhuang.com/res/js/html5upload/plupload.full.min.js"></script><script type="text/javascript" src="http://www.uzhuang.com/res/js/html5upload/extension.js"></script><input disabled="disabled" type="text" value="<?php echo $r['thumb'];?>" ondblclick="img_view('?m=core&amp;f=image_privew&amp;imgurl='+this.value);" class="form-control" id="thumb" name="form[thumb]" size="100" datatype="*" sucmsg="OK" errormsg="请上传营业执照" nullmsg="请上传营业执照！"><span class="input-group-btn"></span></div><span class="tablewarnings"></span> --><img src="<?php echo getImgShow($r['thumb'],'small');?>" /></div></div></td>
        </tr>

        <tr class="border-both">
            <td><div class="form-groupinfo"><label class="col-sm-3 control-label text-right"><font color="red">*</font> 营业执照编号：</label><div class="col-sm-7 text-left"><input disabled="disabled" type="text" name="form[yyzzbh]" id="yyzzbh" size="50" placeholder="请输入营业执照编号" value="<?php echo $r['yyzzbh'];?>" class="form-control" datatype="*" sucmsg="OK" errormsg="请输入营业执照编号" nullmsg="请输入营业执照编号"><span class="tablewarnings"></span></div></div></td>
        </tr>

        <tr class="border-both">
            <td><div class="form-groupinfo" style="padding-top:0px;line-height:210px;"><label class="col-sm-3 control-label text-right"><font color="red">*</font> 法人身份证扫描件：</label><div class="col-sm-7 text-left"><!-- <div class="input-group"><input disabled="disabled" type="text" value="<?php echo $r['LegalCardId'];?>" ondblclick="img_view('?m=core&amp;f=image_privew&amp;imgurl='+this.value);" class="form-control" id="LegalCardId" name="form[LegalCardId]" size="100" datatype="*" sucmsg="OK" errormsg="请上传法人身份证扫描件" nullmsg="请上传法人身份证扫描件！"><span class="input-group-btn"></span></div> --><img src="<?php echo getImgShow($r['LegalCardId'],'small');?>" /><span class="tablewarnings"></span></div></div></td>
        </tr>

        <tr class="border-both">
            <td><div class="form-groupinfo"><label class="col-sm-3 control-label text-right"><font color="red">*</font> 法人身份证号：</label><div class="col-sm-7 text-left"><input disabled="disabled" type="text" name="form[LegalIdentityCard]" id="LegalIdentityCard" size="" placeholder="请输入法人身份证号" value="<?php echo $r['LegalIdentityCard'];?>" class="form-control"><span class="tablewarnings"></span></div></div></td>
        </tr>

        <tr class="border-both">
            <td><div class="form-groupinfo" style="padding-top:0px;line-height:210px;"><label class="col-sm-3 control-label text-right"><font color="red">*</font> 组织机构代码证扫描件：</label><div class="col-sm-7 text-left"><!-- <div class="input-group"><input disabled="disabled" type="text" value="<?php echo $r['orgimg'];?>" ondblclick="img_view('?m=core&amp;f=image_privew&amp;imgurl='+this.value);" class="form-control" id="orgimg" name="form[orgimg]" size="100" datatype="*" sucmsg="OK" errormsg="图片格式为.gif .jpg .peg .png .bmp" nullmsg="请上传组织机构代码证扫描件！"><span class="input-group-btn"></span></div> --><img src="<?php echo getImgShow($r['orgimg'],'small');?>" /><span class="tablewarnings"></span></div></div></td>
        </tr>

        <!-- <tr class="border-both" style="display:none;">
            <td><div class="form-groupinfo"><label class="col-sm-3 control-label text-right"><font color="red">*</font> 组织机构代码证(未取)：</label><div class="col-sm-7 text-left"><div class="input-group"><input disabled="disabled" type="text" value="<?php echo $r['zzjgdmz'];?>" ondblclick="img_view('?m=core&amp;f=image_privew&amp;imgurl='+this.value);" class="form-control" id="zzjgdmz" name="form[zzjgdmz]" size="100" datatype="*" sucmsg="OK" errormsg="请上传组织机构代码证" nullmsg="请上传组织机构代码证！"><span class="input-group-btn"></span></div><span class="tablewarnings"></span></div></div></td>
        </tr> -->

        <tr class="border-both">
            <td><div class="form-groupinfo" style="padding-top:0px;line-height:210px;"><label class="col-sm-3 control-label text-right"><font color="red">*</font> 税务登记证扫描件：</label><div class="col-sm-7 text-left"><!-- <div class="input-group"><input disabled="disabled" type="text" value="<?php echo $r['swdj'];?>" ondblclick="img_view('?m=core&amp;f=image_privew&amp;imgurl='+this.value);" class="form-control" id="swdj" name="form[swdj]" size="100" datatype="*" sucmsg="OK" errormsg="请上传税务登记证扫描件" nullmsg="请上传税务登记证扫描件！"><span class="input-group-btn"></span></div> --><img src="<?php echo getImgShow($r['swdj'],'small');?>" /><span class="tablewarnings"></span></div></div></td>
        </tr>

        <tr class="border-bottom">
            <td><div class="form-groupinfo"><label class="col-sm-3 control-label text-right"><font color="red">*</font> 税务登记证编号：</label><div class="col-sm-7 text-left"><input disabled="disabled" type="text" name="form[swdjzno]" id="swdjzno" size="50" placeholder="请输入税务登记证编号" value="<?php echo $r['swdjzno'];?>" class="form-control" datatype="*" sucmsg="OK" errormsg="请输入税务登记证编号" nullmsg="请输入税务登记证编号"><span class="tablewarnings"></span></div></div></td>
        </tr>

        <tr class="no-border">
            <td><div class="form-groupinfo"><label class="col-sm-3 control-label text-right"></label><div class="col-sm-7 text-left">
            <span class="tablewarnings"></span></div></div></td>
        </tr>

        <!-- <tr class="border-all">
            <td>
                <div class="form-groupinfo"><label class="col-sm-3 control-label text-right"><font color="red"></font> 公司简介</label>
                    <div class="col-sm-7 text-left">
                        <textarea name="companyIntroduce" style="width:520px;height:80px;"><?php echo $r['companyIntroduce'];?></textarea>
                    <span class="tablewarnings"></span>
                    </div>
                </div>
            </td>
        </tr> -->
</tr>
<tr class="no-border">
    <td><input type="submit" style="background:#387bb8;color:white;border:1px solid #3567a1;padding:6px 12px;" name="submit2" class="sub" value="提交修改"/></td>


</tr>

</table>
                                    </form>
                                </div>

                            </div>
                         
                             
                        </div>


                    </section>
                </div>

            </div>
            <!--右侧结束-->


        </div>
    </div>
</div>
<!--正文部分-->

<script type="text/javascript">
    $(document).on("click",":checkbox[name*=areaids]",function(){
        var c=$(this).attr("checked");
        if (c) {
            $(this).removeAttr("checked");
        }else{
            $(this).attr("checked","checked");
        }
    })
    // 点击提交按钮时执行的事件
    $(":submit").click(function(){
        // 店铺负责人姓名
        var fzr=$("#fzrxm");
        var fzrxm=fzr.val();
        if (!fzrxm) {
            if (fzr.parent().next().is("span")) {
                fzr.parent().next().remove();
            };
            fzr.parent().after('<span style="line-height:30px;color:red;text-align:left;">请输入店铺负责人</span>');
            // alert("请输入店铺负责人姓名");
            $(window).scrollTop(180);
            fzr.focus();
            return false;
        }else{
            fzr.parent().next().remove();
        }

        // 服务区域
        var sav=$(":checkbox[name*=areaids]:checked");
        var c=sav.length;
        if (!c) {
            if ($(":checkbox[name*=areaids]").parents(".col-sm-7").next().is("span")) {
                $(":checkbox[name*=areaids]").parents(".col-sm-7").next().remove();
            };
            $(":checkbox[name*=areaids]").parents(".col-sm-7").after('<span style="line-height:30px;color:red;text-align:left;">请选择服务区域</span>');
            // alert("选择服务区域");
            $(window).scrollTop(250);
            return false;
        }else{
            $(":checkbox[name*=areaids]").parents(".col-sm-7").next().remove();
        }

        // 公司座机
        var gszj=$("#gszj");
        var zjh=gszj.val();
        if (!zjh) {
            if (gszj.parent().next().is("span")) {
                gszj.parent().next().remove();
            };
            gszj.parent().after('<span style="line-height:30px;color:red;text-align:left;">请输入公司座机</span>');
            $(window).scrollTop(200);
            gszj.focus();
            return false;
        }else if (zjh) {
            var reg=/^(0[0-9]{2,3}-)?([2-9][0-9]{6,7})+(-[0-9]{1,4})?$/;
            var res=reg.test(zjh);
            if (!res) {
                if (gszj.parent().next().is("span")) {
                    gszj.parent().next().remove();
                };
                gszj.parent().after('<span style="line-height:30px;color:red;text-align:left;">请输入正确的座机号</span>');
                gszj.select();
                $(window).scrollTop(200);
                return false; 
            }else{
                gszj.parent().next().remove();
            }
        };
    })

    function formsubmit() {

        myform.submit();
    }
    function check_password() {
        if($("#oldpassword").val()=='') {
            var d = dialog({
                content: '原密码不能为空！'
            });
            d.show();
            setTimeout(function () {
                d.close().remove();
                $("#oldpassword").focus();
            }, 2000);

            return false;
        }
        if($("#password").val()=='' || $("#repassword").val()=='') {
            var d = dialog({
                content: '新密码不能为空！'
            });
            d.show();
            setTimeout(function () {
                d.close().remove();
                if($("#password").val()=='') {
                    $("#password").focus();
                } else {
                    $("#repassword").focus();
                }
            }, 2000);

            return false;
        }
        if($("#password").val() != $("#repassword").val()) {
            var d = dialog({
                content: '新密码输入不一致！'
            });
            d.show();
            setTimeout(function () {
                d.close().remove();
                $("#password").focus();
            }, 2000);

            return false;
        }
        passworform.submit();
    }
    $(function(){
        $(".form-horizontal").Validform({
            tiptype:1
        });
        <?php if($memberinfo['modelid']==11 && $memberinfo['checkmec']==1) { ?>
        $(".btn-white").remove();
            <?php } ?>
    })

    $(document).ready(function(){
        var thumb = $("#thumb").val();
        // 公司详细地址   该项已经去掉
        /*$.ajax({
            url:"index.php?m=company&f=biz_setting&v=getCompanyArea",
            type:"POST",
            dataType:"json",
            success:function(data){
                
                var proId=data[0]['lid'];

                var cityId=data[1]['lid'];
                var cityName=data[1]['name'];

                var countryId=data[2]['lid'];
                var countryName=data[2]['name'];
                $("#LK1_1").val(proId);
                var city=$("<option value="+cityId+">"+cityName+"</option>");
                $("#LK1_2").empty().append(city);

                var country=$("<option value="+countryId+">"+countryName+"</option>");
                $("#LK1_3").empty().append(country);
            }
        })*/
        // 开户行所在省市
        $.ajax({
            url:"index.php?m=company&f=biz_setting&v=BelongArea",
            type:"POST",
            dataType:"json",
            success:function(data){
                // 省的value
                var proId=data[0]['lid'];
                // 市的value与值
                var cityId=data[1]['lid'];
                var cityName=data[1]['name'];
                // 县的value与值
                var countryId=data[2]['lid'];
                var countryName=data[2]['name'].trim();
                // 省的值
                var proName=data[0]['name'].trim();
                if (proName==countryName) {
                    $("#BelongProvince").val(proId);
                    var city=$("<option value="+countryId+">"+countryName+"</option>");
                    $("#BelongCity").empty().append(city);

                    var country=$("<option value="+cityId+">"+cityName+"</option>");
                    $("#BelongCounty").empty().append(country);
                }else{
                    $("#BelongProvince").val(proId);
                    var city=$("<option value="+cityId+">"+cityName+"</option>");
                    $("#BelongCity").empty().append(city);

                    var country=$("<option value="+countryId+">"+countryName+"</option>");
                    $("#BelongCounty").empty().append(country);
                }
                // 开户行所在省市不可编辑
                $("#BelongProvince").attr("disabled","disabled");
            }
        })
        
        // 服务区域下拉框
        $.ajax({
            url:"index.php?m=company&f=biz_setting&v=getSer",
            type:"POST",
            dataType:"json",
            success:function(data){
                
                var p=data[0]['lid'];
                $("#serviec_1").val(p);
                $("#serviec_2").append("<option value="+data[1]['lid']+">"+data[1]['name']+"</option>");
            }
        })
        
        //  获取服务区域
        $.ajax({
            url:"index.php?m=company&f=biz_setting&v=getServiceArea",
            type:"POST",
            dataType:"json",
            success:function(data){
                $.ajax({
                    url:"index.php?m=company&f=biz_setting&v=getConcreteArea",
                    type:"POST",
                    dataType:"json",
                    success:function(data2){
                        // 用户审核的状态
                        var userStatus = data2[0]['settled_progress'];
                        // alert(userStatus) 
                        var res = data2[0]['service_area'].split(',');
                        
                        $(".serviceArea").empty();
                        $.each(data,function(serArea,serAreaObj){
                            if (thumb&&userStatus!=4) {
                                if ($.inArray(serAreaObj.lid,res)>-1) {
                                    $(".serviceArea").append("<label class='checkbox-inline'><input name='form[areaids][]' type='checkbox' checked='checked' value='"+serAreaObj.lid+"'>"+serAreaObj.name+"</label>");
                                }else{
                                    $(".serviceArea").append("<label class='checkbox-inline'><input name='form[areaids][]' type='checkbox' value='"+serAreaObj.lid+"'>"+serAreaObj.name+"</label>");
                                }
                            }else{
                                if ($.inArray(serAreaObj.lid,res)>-1) {
                                    $(".serviceArea").append("<label class='checkbox-inline'><input name='form[areaids][]' type='checkbox' checked='checked' value='"+serAreaObj.lid+"'>"+serAreaObj.name+"</label>");
                                }else{
                                    $(".serviceArea").append("<label class='checkbox-inline'><input name='form[areaids][]' type='checkbox' value='"+serAreaObj.lid+"'>"+serAreaObj.name+"</label>");
                                }
                            }
                        })
                    }
                })
            },
            async:true
        })

    })

    // 服务区域发生chenge事件时执行的方法
    $("#serviec_1").change(function(){
        var t=$(this);
        t.parent().next().find("select").empty();
        var pid = $(this).val();
        $.ajax({
            url:"index.php?m=company&f=biz_setting&v=companyThreeLevel",
            data:{'pid':pid},
            type:"POST",
            dataType:"json",
            success:function(data){
                console.log(data);
                $("#serviec_2").empty();
                $.each(data,function(cit,citObj){
                    $("#serviec_2").append("<option value='"+citObj.lid+"'>"+citObj.name+"</option>")
                })
                var conPid = data[0]['lid'];
                $.post("index.php?m=company&f=biz_setting&v=companyThreeLevel",{'pid':conPid},function(datac){
                    console.log(datac)
                    $(".serviceArea").empty();
                    $.each(datac,function(ctr,ctrObj){
                        // $(".serviceArea").append("<input name='form[areaids][]' type='checkbox' value="+ctrObj.lid+">"+ctrObj.name);
                        $(".serviceArea").append("<label class='checkbox-inline'><input name='form[areaids][]' class='serArea' type='checkbox' value="+ctrObj.lid+">"+ctrObj.name+"</label>");
                    })
                },'json')
            },
            async:true
        })
    })
    $("#serviec_2").change(function(){
        var pid = $(this).val();
        $.ajax({
            url:"index.php?m=company&f=biz_setting&v=companyThreeLevel",
            data:{'pid':pid},
            type:"POST",
            dataType:"json",
            success:function(data){
                $(".serviceArea").empty();
                $.each(data,function(country,countryObj){
                    $(".serviceArea").append("<label class='checkbox-inline'><input name='form[areaids][]' class='serArea' type='checkbox' value='"+countryObj.lid+"'>"+countryObj.name+"</label>");
                })
            },
            error:function(){
                // alert("error")
            },
            async:true
        })
    })

    

    /*// 省发生变化时执行的事件   该项已经去掉
    $("#LK1_1").change(function(){
        var parentId=$(this).val();
        $.ajax({
            url:"index.php?m=company&f=biz_setting&v=getCityOrCountry",
            data:{'parentId':parentId},
            type:"POST",
            dataType:"json",
            success:function(data){
                $("#LK1_2").empty();
                $.each(data,function(area,areaObj){
                    $("#LK1_2").append("<option value='"+areaObj.lid+"'>"+areaObj.name+"</option>");
                })
                // 获取区级地址
                var cityId=data[0]['lid'];
                $.post("index.php?m=company&f=biz_setting&v=getCityOrCountry",{'parentId':cityId},function(dataCity){
                    $("#LK1_3").empty();
                    $.each(dataCity,function(area,areaObj){
                        $("#LK1_3").append("<option value='"+areaObj.lid+"'>"+areaObj.name+"</option>")
                    })
                },'json')
            }
        })
    })

    // 市发生变化时执行的事件
    $("#LK1_2").change(function(){
        var parentId=$(this).val();
        $.ajax({
            url:"index.php?m=company&f=biz_setting&v=getCityOrCountry",
            data:{'parentId':parentId},
            type:"POST",
            dataType:"json",
            success:function(data){
                $("#LK1_3").empty();
                $.each(data,function(area,areaObj){
                    $("#LK1_3").append("<option value='"+areaObj.lid+"'>"+areaObj.name+"</option>");
                })
            }
        })
    })*/

    $(".changePhone").click(function(){
        location.href="index.php?m=member&f=index&v=edit_bz_mobile";
    })

    $(".changeEmail").click(function(){
        location.href="index.php?m=member&f=index&v=editMerchantEmail";
    })
    /*$(".sub").click(function(){
        var zhi=$("textarea[name*=content]").next().find("[contenteditable]").text();
        
        var v=$("textarea[name*=content]").val(zhi);
        // alert(v)
        return false;
    })*/
</script>
<?php if(!isset($siteconfigs)) $siteconfigs=get_cache('siteconfigs'); include T("member","foot"); ?>