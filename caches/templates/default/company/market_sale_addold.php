<?php defined('IN_WZ') or exit('No direct script access allowed'); ?><?php if(!isset($siteconfigs)) $siteconfigs=get_cache('siteconfigs'); include T('member','head'); ?>
<link rel="stylesheet" href="<?php echo R;?>js/dialog/ui-dialog.css" />
<script src="<?php echo R;?>js/dialog/dialog-plus.js"></script>
<link href="<?php echo R;?>css/validform.css" rel="stylesheet" />
<script src="<?php echo R;?>js/validform.min.js"></script>

<script src="<?php echo R;?>member/js/jscarousel.js" type="text/javascript"></script>
<link href="<?php echo R;?>css/validform.css" rel="stylesheet" />
<script src="<?php echo R;?>js/validform.min.js"></script>
<script type="text/javascript" src="<?php echo R;?>js/ueditor/ueditor.config.js"></script>
<script type="text/javascript" src="<?php echo R;?>js/ueditor/ueditor.all.min.js"></script>
<script src="<?php echo R;?>js/jquery-ui/jquery-ui.min.js" type="text/javascript"></script>
<script src="<?php echo R;?>js/jquery-ui-1.10.1.custom.min.js"></script>
<script src="<?php echo R;?>js/jquery.ui.touch-punch.min.js" type="text/javascript"></script>
<style type="text/css">
    .table>tbody>tr>td>img{
        max-width: 80px;max-height: 80px;
    }
    .btn{
        cursor:pointer;
    }
</style>
<script type="text/javascript">
    $(document).ready(function() {
        $('#jsCarousel').jsCarousel({ onbackgroundnailclick: function(src) {
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
                        <div class="panel-heading"><span class="title">管理优惠活动</span></div>

                        <ul id="myTab" class="nav nav-tabs" role="tablist">
                            <!-- <li role="presentation" ><a href="?m=company&f=biz_market_sale&v=listing" >活动列表</a></li> -->
                                <li role="presentation" class="active">
                                    <a href="#tabs2" role="tab" id="2tab" data-toggle="tab" aria-controls="tabs2" aria-expanded="false">发布优惠活动</a>
                                </li>
                            </li>
                        </ul>
        
                        <div id="myTabContent" class="tab-content tabsbordertop">


                            <div role="tabpanel" class="tab-pane fade active in" id="tabs1" aria-labelledby="1tab">

                                <form name="myform" class="form-horizontal" action="" method="post" id="myform">
                                    <table class="table table-striped table-advance table-hover text-center">
                                        <tr>
                                            <input type="hidden" name="title" value="<?php echo $result[0]['title'];?>">
                                            <input type="hidden" name="particulars" value="<?php echo $result[0]['particulars'];?>">
                                            <input type="hidden" name="background" value="<?php echo $result[0]['background'];?>">
                                            <input type="hidden" name="url" value="<?php echo $result[0]['url'];?>">
                                            <input type="hidden" name="editid" value="<?php echo $result[0]['id'];?>">
                                            <td><div class="form-groupinfo"><label class="col-sm-2 control-label text-right text-blod"><font color="red">*</font> 活动名称：</label><div class="col-sm-4 text-left">
                                                <input type="text" style="color:#" name="form[title]" id="title" maxlength="50" value="" class="form-control" datatype="*2-80" nullmsg="请输入活动名称" errormsg="请输入活动名称至少2个字符,最多80个字符！">                                       </div></div></td>
                                        </tr>
                                        <!-- 活动详情图对应的字段名   particulars
                                             上传背景图对应的字段名   background -->
                                      
                                        <?php $n=1;if(is_array($field_list)) foreach($field_list AS $info) { ?>
                                        <tr>
                                            <td><div class="form-groupinfo">
                                                <label class="col-sm-2 control-label text-right text-blod">
                                                    <?php if($info['star']) { ?><font color="red">*</font><?php } ?> <?php echo $info['name'];?>：</label><div class="col-sm-10 text-left">
                                                <?php echo $info['form'];?>
                                            </div></div></td>
                                        </tr>
                                        <?php $n++;}?>
                                       <!--  <tr>
                                           <td><div class="form-groupinfo"><label class="col-sm-2 control-label text-right text-blod"><?php if($info['star']) { ?><font color="red">*</font><?php } ?> <?php echo $formdata['5']['content']['name'];?>：</label><div class="col-sm-10 text-left">
                                               <?php echo $formdata['5']['content']['form'];?>
                                           </div></div></td>
                                       </tr> -->

                                        <tr>
                                            <td>
                                                <div class="form-groupinfo">
                                                    <label class="col-sm-2 control-label text-right"></label>
                                                    <div class="col-sm-3 text-left">
                                                        <input type="submit" name="submit" id="submit" value="发布活动" class="btn btn-order">
                                                        <input type="button"  value="查看" class="btn btn-order Preview">
                                                        <!-- onclick="location.href='index.php?m=company&f=biz_market_sale&v=delete&did=<?php echo $result[0]['id'];?>';return false;" -->
                                                        <input type="button" value="取消活动" class="btn Cancel" style="position:relative;left:132px;top:-32px;" >
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    </table>
                                </form>

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
    $("#submit").click(function(){
        t=setTimeout("hide_formtips()",5000);
    });

    function hide_formtips() {
        $.Hidemsg();
        clearInterval(t);
    }
    $(document).ready(function(){
        var title=$("input[name=title]").val();
        var particulars=$("input[name=particulars]").val();
        var background=$("input[name=background]").val();
        $("#title").val(title);
        $("#particulars").val(particulars);
        $("#background").val(background);
        var v=$("#title").val();
        if (v) {
            $("input[type=button]").removeAttr("disabled");
            var edId = $("input[name=editid]").val();
            // alert(ed);return false;
            $("#myform").attr("action","index.php?m=company&f=biz_market_sale&v=edit&editId="+edId);
        };
        if (!v) {
            $("input[type=button]").attr("disabled","disabled");    
        }        
    })
    $(".Preview").click(function(){
        location.href='beijing-zhuangxiugongsi/<?php echo $memberinfo['uid'];?>-youhui/';
        return false;
    })
    $("#background,#particulars").keydown(function(){
        return false;
    })
    $(".Cancel").click(function(){
        // 得到活动详情名称
        var i=$("input[name=editid]").val();
        if (confirm("确认要取消活动吗？")) {
            location.href='index.php?m=company&f=biz_market_sale&v=delete&did='+i;
        }else{
            return false;
        }
    })
</script>

<!--正文部分-->
<?php if(!isset($siteconfigs)) $siteconfigs=get_cache('siteconfigs'); include T('member','foot'); ?>
