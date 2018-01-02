<?php defined('IN_WZ') or exit('No direct script access allowed'); ?><?php if(!isset($siteconfigs)) $siteconfigs=get_cache('siteconfigs'); include T('member','head'); ?>
<style>
    .Validform_ok {
        margin-left: 10px;
        line-height: 20px;
        height: 17px;
        overflow: hidden;
        color: #999;
        font-size: 12px;
        position: absolute;
        margin-top: 8px;
    }

</style>

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
                        <!-- <div class="panel-heading"><span class="title">管理店铺</span></div> -->

                        <ul id="myTab" class="nav nav-tabs" role="tablist">
                            <li role="presentation" class="active"><a href="#tabs1" id="1tab" role="tab" data-toggle="tab" aria-controls="tabs1" aria-expanded="true">公司信息配置</a></li>

                        </ul>


                        <div id="myTabContent" class="tab-content tabsbordertop">

                            <div role="tabpanel" class="tab-pane fade active in" id="tabs1" aria-labelledby="1tab">
                                <div class="panel-body" id="panel-bodys">
                                    <form name="myform" class="form-horizontal" action="" method="post" id="myform">
                                        <table class="table table-striped table-advance table-hover text-center">
                                            <tr>
                                                <td><div class="form-groupinfo"><label class="col-sm-2 control-label text-right text-blod"><font color="red">*</font> 公司名称：</label><div class="col-sm-10 text-left">
                                                    <input type="text" style="color:#" name="form[title]" id="title" maxlength="80" value="<?php echo $data['title'];?>" class="form-control" readonly datatype="*2-80" nullmsg="公司名称" errormsg="公司名称至少2个字符,最多80个字符！">                                       </div></div></td>
                                            </tr>

                                            <?php $n=1;if(is_array($field_list)) foreach($field_list AS $info) { ?>
                                            <tr>
                                                <td><div class="form-groupinfo"><label class="col-sm-2 control-label text-right text-blod"><?php if($info['star']) { ?><font color="red">*</font><?php } ?> <?php echo $info['name'];?>：</label><div class="col-sm-10 text-left">
                                                    <?php echo $info['form'];?>
                                                </div></div></td>
                                            </tr>
                                            <?php $n++;}?>
                                            <!-- <tr class="zheng">
                                                <td><div class="form-groupinfo"><label class="col-sm-2 control-label text-right text-blod"><font color="red">*</font> <?php echo $formdata['5']['content']['name'];?>：</label><div class="col-sm-10 text-left">
                                                    <?php echo $formdata['5']['content']['form'];?>
                                                </div></div></td>
                                            </tr> -->
                                            <tr>
                                                <td>
                                                    <div class="form-groupinfo">
                                                    <label class="col-sm-2 control-label text-right"> </label>
                                                        <div class="col-sm-3 text-left">
                                                        <input type="submit" name="submit" id="submit" value="提交" class="btn btn-order">
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        </table>
                                    </form>
                                </div>

                            </div>

                            <div role="tabpanel" class="tab-pane fade" id="tabs2" aria-labelledby="2tab">
                                <div class="panel-body" id="panel-bodys">
                                    <form class="form-horizontal" role="form" name="passworform" action="?m=company&f=biz_setting&v=save_domain" method="post" id="passworform" >
                                        <table class="table table-striped table-advance table-hover text-center">
                                            <tbody>

                                            <tr>
                                                <td><div class="form-groupinfo"><label class="col-sm-2 control-label text-right">当前域名：</label><div class="col-sm-8 control-label text-left input-group"><strong>http://www.uzhuang.com/<?php echo $mycity;?>-zhuangxiugongsi/<span id="mydomain"><?php echo $domain;?></span>/</strong></div></div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><div class="form-groupinfo"><label class="col-sm-2 control-label text-right">更改域名：</label><div class="col-sm-7 text-left input-group"><input type="text" style="width:300px;" class="form-control" id="domain" maxlength="20" onKeyUp="setdomain(this.value)" placeholder="字母或字母+数字组合，并且大于3个字符" name="domain"  datatype="/^[a-z]{3,20}[0-9]{0,20}$/i" errormsg="字母或字母+数字组合，并且大于3个字符" sucmsg="可以使用" ajaxurl="index.php?m=company&f=json&v=check_domain" value="<?php echo $domain;?>"><span class="Validform_ok"></span></div></div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><div class="form-groupinfo"><label class="col-sm-2 control-label text-right"> </label><div class="col-sm-3 input-group text-left"><button type="submit" name="submit" class="btn btn-order">提 交</button></div></div></td>
                                            </tr>

                                            </tbody>
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
<link href="/res/css/validform.css" rel="stylesheet">
<!-- <script src="/res/js/validform.min.js"></script> -->

<script type="text/javascript">
    
    var isload = 0;
    
    var isChange=false;
    var funcTwo=false;
    $("#LK1_1,#LK1_2,#LK1_3").click(function(){
        isChange=true;
    })

    $("#LK1_1,#LK1_2,#LK1_3").change(function(){
        if (isChange) {
           $("#address").val("")
            funcTwo=true;
        }
        isChange=false;
    })    

    $("#address").click(function(){
        $(this).val("");
        funcTwo=true;
    })
    

    var comProAddr=$("#LK1_1");
    var comCityAddr=$("#LK1_2");
    var comCounAddr=$("#LK1_3");
    var detailAddr=$("#address");
    var thumb=$("#thumb");
    var companylogo=$("#companylogo");
    var areaErrorTip='<td><span class="errorTip" style="float: right;color:red;width:50px;visibility:hidden;">必填字段</span></td>';

    /*var addrPass=false;
    var detailPass=false;
    var thumbPass=false;
    var comLogoPass=false;*/
    
    function addrTip(){
        comProAddr.css("backgroundColor","#FFE7E7");
        comCityAddr.css("backgroundColor","#FFE7E7");
        comCounAddr.css("backgroundColor","#FFE7E7");
        comProAddr.parents("td").next().find("span").css("visibility","visible");
        // addrPass=false;
    }
    function addrHidden(){
        comProAddr.css("backgroundColor","white");
        comCityAddr.css("backgroundColor","white");
        comCounAddr.css("backgroundColor","white");
        comProAddr.parents("td").next().find("span").css("visibility","hidden");
        // addrPass=true;
    }
    function validateAddress(){
        var comProAddrVal = comProAddr.val();
        var comCityAddrVal=comCityAddr.val();
        
        if (comCityAddrVal==0||!comCityAddrVal) {
            addrTip();
        }else{
            addrHidden();
        }
    }
    function validateDetail(){
        var v=detailAddr.val();
        if (!v) {
            detailAddr.css("backgroundColor","#FFE7E7");
            detailAddr.parents("td").next().find("span").css("visibility","visible");
            // detailPass=false;
        }else{
            detailAddr.css("backgroundColor","white");
            detailAddr.parents("td").next().find("span").css("visibility","hidden");
            // detailPass=true;
        }
    }

    $("#address").focus(function(){
        validateAddress();
    }).blur(function(){
        validateDetail();
    })

    function detailTip(){
        detailAddr.css("backgroundColor","#FFE7E7");
        detailAddr.parents("td").next().find("span").css("visibility","visible");
        // detailPass=false;
    }
    function detailHidden(){
        detailAddr.css("backgroundColor","white");
        detailAddr.parents("td").next().find("span").css("visibility","hidden");
        // detailPass=true;
    }
    $(":button:contains(上传文件)").eq(0).click(function(){
        var cityVal=comCityAddr.val();
        if (!cityVal) {
            addrTip();
        }else{
            addrHidden();
        }
        var detailVal=detailAddr.val();
        if (!detailVal) {
            detailTip();
        }else{
            detailHidden();
        }
    })

    function thumTip(){
        thumb.css("backgroundColor","#FFE7E7");
        thumb.parents("td").next().find("span").css("visibility","visible");
        // thumbPass=false;
    }
    function thumHidden(){
        thumb.css("backgroundColor","white");
        thumb.parents("td").next().find("span").css("visibility","hidden");
        // thumbPass=true;
    }
    $(":button:contains(上传文件)").eq(1).click(function(){
        var cityVal=comCityAddr.val();
        if (!cityVal) {
            addrTip();
        }else{
            addrHidden();
        }

        if (!detailPass) {
            detailTip();
        }else{
            detailHidden();
        }

        var thumbVal = thumb.val();
        if (!thumbVal) {
            thumTip();
        }else{
            thumHidden();
        }
    })

    $("#submit").click(function(){
        var tj=true;
        var comCityAddrVal=comCityAddr.val();
        var detailAddrVal=detailAddr.val();
        var thumbVal=thumb.val();
        var companylogoVal=companylogo.val();
        if (!comCityAddrVal||comCityAddrVal==0) {
            addrTip();
            tj=false;
        }else{
            addrHidden();
            tj=true;
        }

        if (!detailAddrVal) {
            detailTip();
            tj=false;
        }else{
            detailHidden();
            tj=true;
        }

        if (!thumbVal) {
            thumTip();
            tj=false;
        }else{
            thumHidden();
            tj=true;
        }

        if (!companylogoVal) {
            companylogo.css("backgroundColor","#FFE7E7");
            companylogo.parents("td").next().find("span").css("visibility","visible");
            tj=false;
        }else{
            companylogo.css("backgroundColor","white");
            companylogo.parents("td").next().find("span").css("visibility","hidden");
            tj=true;
        }
        if (!tj) {
            return false;
        }

        if (!funcTwo) {
            $("#myform").attr("action","index.php?m=company&f=biz_setting&v=setting2");
        }else{

            $("#myform").attr("action","index.php?m=company&f=biz_setting&v=setting");
        }
    })


    $(document).ready(function(){
        $("#title").parents("td").after(areaErrorTip);
        comProAddr.parents("td").after(areaErrorTip);
        detailAddr.parents("td").after(areaErrorTip);
        thumb.parents("td").after(areaErrorTip);
        companylogo.parents("td").after(areaErrorTip);
        

        $("label:contains('呵呵')").text('');
    })
    // $('#companylogo').on('click', function(){
    //     alert('请上传1920*460px的图片');
    // });
</script>
<?php if(!isset($siteconfigs)) $siteconfigs=get_cache('siteconfigs'); include T("member","foot"); ?>