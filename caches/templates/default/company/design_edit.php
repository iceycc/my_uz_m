<?php defined('IN_WZ') or exit('No direct script access allowed'); ?><?php if(!isset($siteconfigs)) $siteconfigs=get_cache('siteconfigs'); include T('member','head'); ?>
<script src="<?php echo R;?>member/js/jscarousel.js" type="text/javascript"></script>
<script src="<?php echo R;?>js/wuzhicms_member.js" type="text/javascript"></script>
<link href="<?php echo R;?>css/validform.css" rel="stylesheet" />
<script src="<?php echo R;?>js/validform.min.js"></script>
<script type="text/javascript" src="<?php echo R;?>js/ueditor/ueditor.config.js"></script>
<script type="text/javascript" src="<?php echo R;?>js/ueditor/ueditor.all.min.js"></script>
<script type="text/javascript" src="<?php echo R;?>js/validform.min.js"></script>
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
                        <div class="panel-heading"><span class="title">管理设计师</span></div>

                        <ul id="myTab" class="nav nav-tabs" role="tablist">
                            <li role="presentation" ><a href="?m=company&f=biz_design&v=listing">设计师列表</a></li>
                            <li role="presentation" class="active" class=""><a href="#tabs2" role="tab" id="2tab" data-toggle="tab" aria-controls="tabs2" aria-expanded="false">修改设计师</a></li>
                        </ul>
                        <div id="myTabContent" class="tab-content tabsbordertop">

                            <div role="tabpanel" class="tab-pane fade active in" id="tabs1" aria-labelledby="1tab">
                                <div class="panel-body" id="panel-bodys">
                                    <form name="myform" class="form-horizontal" action="" method="post" id="myform">
                                        <table class="table table-striped table-advance table-hover text-center">
                                            <tr>
                                                <td>
                                                    <div class="form-groupinfo">
                                                        <label class="col-sm-2 control-label text-right text-blod">
                                                            <font color="red">*</font> 设计师姓名：</label>
                                                        <div class="col-sm-10 text-left">
                                                        <input type="text" style="width:250px;" name="form[title]" id="title" maxlength="80" value="<?php echo $data['title'];?>" class="form-control" datatype="*2-80" nullmsg="设计师姓名" errormsg="设计师姓名至少2个字符,最多80个字符！">
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                              <div class="tip" style="display:none;z-index:100;background:white;width:208px;height:60px;border:1px solid black;position:absolute;left:650px;top:300px;">
                                            <div style="width:100%;height:26px;background:black;font-weight: bolder;color:white;padding-left:5px;">提示信息</div>
                                            <div>设计费应为数字</div>
                                        </div>
                                        <tr class="sjf">
                                            <td>
                                                <div class="form-groupinfo">
                                                    <label class="col-sm-2 control-label text-right text-blod">设计费:</label>
                                                    <div class="col-sm-4 text-left" style="width:500px;">
                                                        <input type="text" name="form[lowestcost]"  id="lowestcost" value="<?php echo $data['lowestcost'];?>" style="width:90px;height:34px;"> 
                                                        — <input type="text" name="form[maximumcost]" id="maximumcost" value="<?php echo $data['maximumcost'];?>" style="width:90px;height:34px;">
                                                        <label>元/平米(不填为面议)</label><label style="color:red"></label>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                            <?php $n=1;if(is_array($field_list)) foreach($field_list AS $info) { ?>
                                            <tr>
                                                <td>
                                                    <div class="form-groupinfo">
                                                        <label class="col-sm-2 control-label text-right text-blod">
                                                            <?php if($info['star']) { ?>
                                                            <font color="red">*</font>
                                                            <?php } ?>
                                                            <?php echo $info['name'];?>：
                                                        </label>
                                                        <div class="col-sm-10 text-left">
                                                            <?php echo $info['form'];?>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            <?php $n++;}?>

                                            <tr>
                                                <td>
                                                    <div class="form-groupinfo">
                                                        <label class="col-sm-2 control-label text-right text-blod">
                                                            <?php if($info['star']) { ?>
                                                            <font color="red">*</font>
                                                            <?php } ?>
                                                            <?php echo $formdata['5']['content']['name'];?>：
                                                        </label>
                                                        <div class="col-sm-10 text-left">
                                                            <?php echo $formdata['5']['content']['form'];?>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <div class="form-groupinfo">
                                                        <label class="col-sm-2 control-label text-right">
                                                        </label>
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
                                                <td><div class="form-groupinfo"><label class="col-sm-3 control-label text-right">我的域名：</label><div class="col-sm-3 text-left"><input type="text" class="form-control" id="domain" placeholder="字母或数字组合" name="domain"  placeholder="请输入用户名" datatype="/^[a-z0-9]{3,20}$/i" errormsg="字母或数字组合，并且大于3个字符" sucmsg="可以使用" ajaxurl="index.php?m=company&f=json&v=check_domain" value="<?php echo $domain;?>"><span class="Validform_ok"></span></div></div>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td><div class="form-groupinfo"><label class="col-sm-3 control-label text-right"> </label><div class="col-sm-3 text-left"><button type="submit" name="submit" class="btn btn-order">提 交</button></div></div></td>
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
<script src="/res/js/validform.min.js"></script>
<script>
    $(function(){
        $(".form-horizontal").Validform({
            tiptype:1
        });

        var m = $("tr[class=sjf]").insertAfter($("select:first").parents("tr"));

    })

    $(document).ready(function(){
        $("#lowestcost").removeAttr("nullmsg");
        $("#lowestcost").removeAttr("class");

    })

    $(".form-horizontal").Validform({
        tiptype:1,
        datatype:{//传入自定义datatype类型【方式二】;

            "max2":function(gets,obj,curform,regxp){
                var atmax=3,
                        numselected=curform.find("input[name='"+obj.attr("name")+"']:checked").length;

                if(numselected==0){
                    return false;
                }else if(numselected>atmax){
                    return "擅长风格 最多只能选择"+atmax+"项！";
                }
                return  true;
            }

        }
    });

    $("#submit").click(function(){
        t=setTimeout("hide_formtips()",5000);
    });

    function hide_formtips() {
        $.Hidemsg();
        clearInterval(t);
    }
    $(".tz").click(function(){
        $("#myTab li:eq(0)").removeAttr("class");//移除属性
        $("#myTab li:eq(1)").addClass("active");//添加active的属性
    })

    

    $("#submit").click(function(){
        var reg = new RegExp("^[0-9]+$"); 
        var v1=parseInt($("#lowestcost").val());
        var v2=parseInt($("#maximumcost").val());
        if($("#lowestcost").val()!='' && $("#maximumcost").val()!='' ){

            if (isNaN(v1) || isNaN(v2)) {
              
                    alert("请输入数字");
                    return false;
              
            }
           
            if (v1&&v2) {
                if (v1>v2) {
                    alert("最低费用不能高于最高费用");
                    return false;
                }
            }
        }
        
    })
     $(".isDel").click(function(){
        if (!confirm("案例被删除后不可恢复！\n确认要删除选择的案例？")) {
            return false;
        }
    })
</script>
<?php if(!isset($siteconfigs)) $siteconfigs=get_cache('siteconfigs'); include T("member","foot"); ?>