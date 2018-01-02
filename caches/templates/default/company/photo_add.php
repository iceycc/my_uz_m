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
    .sh{
        font-size: 16px;
        font-weight: bolder;
        font-family: 宋体;
    }
    .sh td{width:200px;}
    .showDiv div{
        font-weight: border;
        font-family: microsoft yahei;
        color:#FFFFFF;
        cursor: pointer;
    }
    .huodong{
      background:#2D89EF;
      color:white;
    }
    .die{
      background:white;
      border:1px solid #CCC;
    }
</style>
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
                <div class="memberborder">
                    <?php if(!isset($siteconfigs)) $siteconfigs=get_cache('siteconfigs'); include T('member','left'); ?>
                </div>
            </div>
            <!--左侧结束-->

            <!--右侧开始-->
            <div class="memberright">

                <div class="memberbordertop">
                    <section class="panel">
                        <div class="panel-heading"><span class="title">管理案例</span></div>

                        <ul id="myTab" class="nav nav-tabs" role="tablist">
                            <li role="presentation" ><a href="?m=company&f=biz_photo&v=listing" >案例列表</a></li>
                            <li role="presentation" class="active"><a href="#tabs2" role="tab" id="2tab" data-toggle="tab" aria-controls="tabs2" aria-expanded="false">新增案例</a></li>
                            </li>
                        </ul>

                        <div id="myTabContent" class="tab-content tabsbordertop">


                            <div role="tabpanel" class="tab-pane fade active in" id="tabs1" aria-labelledby="1tab">

                                <form name="myform" class="form-horizontal" action="index.php?m=company&f=biz_photo&v=add" method="post" id="myform">
                                    <table class="table table-striped table-advance table-hover text-center">
                                        <tr>
                                            <td><div class="form-groupinfo"><label class="col-sm-2 control-label text-right text-blod"><font color="red">*</font> 案例名称：</label>
                                            <div class="col-sm-4 text-left">
                                                <input type="text" style="color:#" name="form[title]" id="title" maxlength="30" value="" class="form-control" datatype="*2-80" nullmsg="请输入案例名称" errormsg="案例名称至少2个字符,最多80个字符！">                                    
                                                   </div>
                                                   </div>
                                                   </td>
                                        </tr>

                                        <?php $n=1;if(is_array($field_list)) foreach($field_list AS $info) { ?>
                                        <tr>
                                            <td><div class="form-groupinfo"><label class="col-sm-2 control-label text-right text-blod"><?php if($info['star']) { ?><font color="red">*</font><?php } ?> <?php echo $info['name'];?>：</label><div class="col-sm-10 text-left">
                                                <?php echo $info['form'];?>
                                            </div></div></td>
                                        </tr>
                                        <?php $n++;}?>
                                        
                                        
                                           <!-- 效果图开始-->
                                <tr class="showDiv">
                                            <td>
                                                <!-- <hr style="height:5px;color:black;" /> -->
                                                <div style="width:133px;height:36px;line-height:36px;position:relative;float:left;left:100px;margin-left:20px;text-align:center;top:10px;" class="huodong chang">平面图</div>
                                                <div style="width:133px;height:36px;position:relative;float:left;left:105px;margin-left:20px;text-align:center;line-height:36px;top:10px;color:black;" class="die chang">效果图</div>
                                                <div style="width:133px;height:36px;position:relative;float:left;left:115px;margin-left:20px;text-align:center;line-height:36px;top:10px;color:black;" class="die chang">竣工实景图</div>
                                                <div style="width:133px;height:36px;position:relative;float:left;left:115px;margin-left:20px;text-align:center;line-height:36px;top:10px;color:black;" class="die chang">户型图</div>
                                            </td>
                                        </tr>
                                        <tr style="display:block;clear:both;">
                                            <td style="width:868px">

                                                <div class="chenge1"  style="width:700px;display:block;position:relative;left:120px;">
                                                  <table class="sh">
                                                        <tr>
                                                           
                                                                <td style="width:100px">平面图</td>
                                                                <td style="width:100px">空间</td>
                                                                <td style="width:100px">项目类型</td>
                                                                <td style="width:120px">图片描述</td>
                                                                <td style="width:70px">操作</td>
                                                        </tr>
                                                      
                                                         <tr>
                                                            <td id="pmt" colspan="5">
                                                               <!-- <input type="hidden" name="form[project1]" id="pjt1"> -->
                                                                <!-- <input type="hidden" name="form[photos1][0][space]" id="space"> -->
                                                            </td>
                                                            </tr>

                                                      
                                                      </table>
                                                </div>
                                               
                                                <div class="chenge1" id="view2" style="width:700px;display:none;position:relative;left:120px;">
                                                    <table class="sh">
                                                        <tr>
                                                           
                                                                <td style="width:100px">效果图</td>
                                                                <td style="width:100px">空间</td>
                                                                <td style="width:100px">项目类型</td>
                                                                <td style="width:120px">图片描述</td>
                                                                <td style="width:70px">操作</td>
                                                        </tr>
                                                      
                                                         <tr>
                                                            <td id="xgt" colspan="5">
                                                                
                                                            </td>
                                                            </tr>

                                                      
                                                      </table>
                                                </div>
                                                
                                                <div class="chenge1" id="view3" style="width:700px;display:none;position:relative;left:120px;">
                                                  <table class="sh">
                                                        <tr>
                                                           
                                                                <td style="width:100px">竣工图</td>
                                                                <td style="width:100px">空间</td>
                                                                <td style="width:100px">项目类型</td>
                                                                <td style="width:120px">图片描述</td>
                                                                <td style="width:70px">操作</td>
                                                        </tr>
                                                      
                                                         <tr>
                                                            <td id="jgt" colspan="5">
                                                                
                                                            </td>
                                                            </tr>

                                                      
                                                      </table>
                                                </div>

                                                <div class="chenge1" id="view4" style="width:700px;display:none;position:relative;left:120px;">
                                                  <table class="sh">
                                                        <tr>
                                                           
                                                                <td style="width:100px">户型图</td>
                                                                <td style="width:100px">空间</td>
                                                                <td style="width:100px">项目类型</td>
                                                                <td style="width:120px">图片描述</td>
                                                                <td style="width:70px">操作</td>
                                                        </tr>
                                                      
                                                         <tr>
                                                            <td id="wzt" colspan="5">
                                                                
                                                            </td>
                                                            </tr>

                                                      
                                                      </table>
                                                </div>
                                            </td>
                                        </tr>


                                           <!-- 效果图结束 -->

                                         <tr style="height:70px;">
                                           <td><div class="form-groupinfo"><label class="col-sm-2 control-label text-right"> </label><div style="width:70%;"><input type="submit" name="submit" id="submit" value="保存并发布" class="btn btn-order" style="margin-right:30px;margin-top:20px"><input type="reset" name="reset" value="取消" class="btn btn-order" style="margin-left:20px;margin-top:20px" /></div></div></td>
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
    var title = document.getElementById("title");
    var rd=$(":radio[name*=housetype]");
    

    $(function(){
        $(".form-horizontal").Validform({
            tiptype:1
        });
    })

    $("#submit").click(function(){
        // 校验费用是否是  保留两位小数的数字
        // 校验是否是数字
        var reg=/^[0-9]*$/;
        // 校验是否是两位小数的数字
        var reg1=/^\d+(\.\d{2})+$/;
        // 得到要校验的值
        var v=$("#cost").val();
        var res=reg.test(v);
        if (!res) {
            var res1=reg1.test(v);
            if (!res1) {
                alert("只能输入整数或保留两位小数的数字");
                return false;
            }
        }

        t=setTimeout("hide_formtips()",5000);

        // 判断是否至少上传了平面图或户型图中的一种
        var pmtLength = $("#photos1_ul li").length;
        var wztLength = $("#photos4_ul li").length;
        if (!pmtLength&&!wztLength) {
            alert("请上传平面图或户型图中的至少一种");
            return false;
        }

        /*// 获取平面图的项目类型信息
        var spv1='';
        $("#photos1 select[name*=project]").each(function(){
            if (spv1=='') {
                spv1=$(this).val();
            }else{
                spv1+=','+$(this).val();
            }
        })
        $("#pjt1").val(spv1);*/
    });

    function hide_formtips() {
        $.Hidemsg();
        clearInterval(t);
    }

    // 点击四种图的时候进行切换
    $(".showDiv div").click(function(){
        var i=$(this).index();
        
        if (i==2) {
          $("#view3").css("display","block");
          $("#view3").siblings().css("display","none");
        }else if(i==1){
          $("#view2").css("display","block");
          $("#view2").siblings().css("display","none");
        }else {
            $(".showDiv").next().find("div:eq("+i+")").css("display","block");
            $(".showDiv").next().find("div:eq("+i+")").siblings().css("display","none");
          }
    })
    // 点击平面图  效果图  竣工实景图  户型图的时候改变其样式
    $(".chang").click(function(){
      var index=$(this).index();
      $(".chenge1").eq(index).css("display","block").siblings().css("display","none");
      $(this).removeClass("die").addClass("huodong").css("color","white");
      $(this).siblings().removeClass("huodong").addClass("die").css("color","black");
    })

    $(".isAll").click(function(){
        var v=$(this).attr("ischecked");
        if (!v) {
            $(".sh").find("input[type=checkbox]").attr("checked","checked");
            $(this).attr("ischecked","a");
        }else{
            $(this).removeAttr("ischecked");
            $(".sh :checkbox").removeAttr("checked");
        }
    })

    $(".sh :checkbox").click(function(){
        var i=$(this).attr("checked");
        if (i) {
            $(this).removeAttr("checked");
        }else{
            $(this).attr("checked","checked");
        }
    })


    // 点击其他户型时向后面添加一个文本域
    var isOtherHouse=false;
    $(":radio[name*=housetype][value=14]").click(function(){
        if (!isOtherHouse) {
            var txtArea = $('<textarea id="isOtherHouse" name="form[otherHouseType]" style="position:absolute;float:right;border-radius:5px;padding-top:5px;padding-left:5px;"></textarea>');
            $(this).parent().after(txtArea);
            isOtherHouse=true;
        }
    })
    // 点击户型时(除去其它户型)将文本域去掉
    $(":radio[name*=housetype][value!=14]").click(function(){
        $("#isOtherHouse").remove();
        isOtherHouse=false;
    })

    // 点击其他风格时在后面添加文本框
    var isOtherType=false;
    $(":radio[name*=style]:last").click(function(){
        if (!isOtherType) {
            var txtArea = $('<textarea id="isOtherType" name="form[otherType]" style="position:absolute;float:right;border-radius:5px;padding-top:5px;padding-left:5px;"></textarea>');
            $(this).parent().after(txtArea);
            isOtherType=true;
        }
    })
    // 点击除去其它户型之外的户型时将文本框移除
    $(":radio[name*=style]:not(:last)").click(function(){
        $("#isOtherType").remove();
        isOtherType=false;
    })

    

    // 文档加载时将按钮进行移动
    $(document).ready(function(){
        $("tr:eq(4)").find("label").remove();
        $("#pmt").append($("tr:eq(4)"));

        $("tr:eq(3)").find("label").remove();
        $("#wzt").append($("tr:eq(3)"));

        $("tr:eq(2)").find("label").remove();
        $("#xgt").append($("tr:eq(2)"));

        $("tr:eq(1)").find("label").remove();
        $("#jgt").append($("tr:eq(1)"));



        // 改变费用文本框的大小
        $("#area").css({width:"170px"});
        $("#cost").css({width:"170px"});
    })

</script>
<!--正文部分-->
<?php if(!isset($siteconfigs)) $siteconfigs=get_cache('siteconfigs'); include T('member','foot'); ?>
