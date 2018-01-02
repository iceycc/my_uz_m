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
    .chenge1 td{
      font-family:microsoft yahei;font-weight:normal;
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
                            <li role="presentation" class="active"><a href="#tabs2" role="tab" id="2tab" data-toggle="tab" aria-controls="tabs2" aria-expanded="false">修改案例</a></li>
                            </li>
                        </ul>
                        <div id="myTabContent" class="tab-content tabsbordertop">
                            <div role="tabpanel" class="tab-pane fade active in" id="tabs1" aria-labelledby="1tab">
                                <form name="myform" class="form-horizontal" action="index.php?m=company&f=biz_photo&v=edit" method="post" id="myform">
                                    <table class="table table-striped table-advance table-hover text-center">
                                        <tr>
                                            <td>
                                                <div class="form-groupinfo">
                                                    <label class="col-sm-2 control-label text-right text-blod">
                                                        <font color="red">*</font> 案例名称：
                                                    </label>
                                                    <input type="hidden" name="hstyleNo" value="<?php echo $housetypeNo;?>" id="">
                                                    <input type="hidden" name="hstyleName" value="<?php echo $houseTypeName;?>" id="">
                                                    <input type="hidden" name="sNo" value="<?php echo $styleNo;?>" id="">
                                                    <input type="hidden" name="sName" value="<?php echo $styleName;?>" id="">
                                                    <div class="col-sm-4 text-left">
                                                        <input type="text" style="color:#" name="form[title]" id="title" maxlength="50" value="<?php echo $data['title'];?>" class="form-control" datatype="*2-50" nullmsg="案例名称" errormsg="案例名称至少2个字符,最多50个字符！">
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
                                                           
                                                                <td style="width:100px;">平面图</td>
                                                                <td style="width:100px;">空间</td>
                                                                <td style="width:100px;">项目类型</td>
                                                                <td style="width:130px;">图片描述</td>
                                                                <td style="width:70px;">操作</td>
                                                        </tr>
                                                      
                                                        <tr>
                                                            <td id="pmt" colspan="5">
                                                            

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
                                                            <!-- <td style="display:none;">未知图</td> -->
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

                                        <tr>
                                            <td>
                                                <div class="form-groupinfo">
                                                    <label class="col-sm-2 control-label text-right">
                                                    </label>
                                                    <div class="col-sm-3 text-left">
                                                        <input type="hidden" name="id" value="<?php echo $id;?>">
                                                        <!-- 四个隐藏域用于判断  平面图  效果图  竣工实景图   户型图  在编辑(删除的时候是否全部删除了) -->
                                                        <input type="hidden" id="ping" name="zheng[ping]">
                                                        <input type="hidden" id="xiao" name="zheng[xiao]">
                                                        <input type="hidden" id="jun" name="zheng[jun]">
                                                        <input type="hidden" id="wei" name="zheng[wei]">
                                                        <input type="submit" name="submit" id="submit" value="提交" class="btn btn-order" style="margin-left:160px;">
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


    var hstyleNo = $("input[name=hstyleNo]").val();
    var hstyleName = $("input[name=hstyleName]").val();
    var sNo = $("input[name=sNo]").val();
    var sName = $("input[name=sName]").val();
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
        // alert($("#photos3_ul li").length);
        // 用于删除  平面图  效果图  竣工实景图  户型图(如果都删除时生效)
        var pmtLength = $("#photos1_ul li").length;
        var xgtLength = $("#photos2_ul li").length;
        var jgtLength = $("#photos3_ul li").length;
        var wztLength = $("#photos4_ul li").length;

        $("#ping").val(pmtLength);
        $("#xiao").val(xgtLength);
        $("#jun").val(jgtLength);
        $("#wei").val(wztLength);        
    });

    // 点击平面图时执行的事件
    $(document).on("click","#photos1_ul a:contains(移除)",function(){
        var l=$("#photos1_ul li").length;
        var tl=$("#photos4_ul li").length;
        if (l==1&&tl==0) {
            alert("户型图与平面图至少要保留其中一种");
            return false;
        };
    })

    // 点击户型图时执行的事件
    $(document).on("click","#photos4_ul a:contains(移除)",function(){
        var l=$("#photos1_ul li").length;
        var tl=$("#photos4_ul li").length;
        if (l==0&&tl==1) {
            alert("户型图与平面图至少要保留其中一种");
            return false;
        };
    })

    function hide_formtips() {
        $.Hidemsg();
        clearInterval(t);
    }

    // 点击平面图   效果图   竣工实景图   户型图时切换下方的内容
    $(".showDiv div").click(function(){
        var i=$(this).index();
        $(".chenge1").eq(i).css("display","block").siblings().css("display","none");
    })

    // 点击删除按钮时判断  平面图或户型图是否至少存在一种
    

    /*$(".isAll").click(function(){
        var v=$(this).attr("ischecked");
        if (!v) {
            $(".sh").find("input[type=checkbox]").attr("checked","checked");
            $(this).attr("ischecked","a");
        }else{
            $(this).removeAttr("ischecked");
            $(".sh :checkbox").removeAttr("checked");
        }
    })*/

    /*$(".sh :checkbox").click(function(){
        var i=$(this).attr("checked");
        if (i) {
            $(this).removeAttr("checked");
        }else{
            $(this).attr("checked","checked");
        }
    })*/

    // 点击户型中的其他单选框时执行的事件
    var isOtherHouse=true;
    $(":radio[name*=housetype]:last").click(function(){
        if (isOtherHouse) {
          var txtArea = $('<textarea id="isOtherHouse" name="form[otherHouseType]" style="position:absolute;float:right;border-radius:5px;padding-top:5px;padding-left:5px;"></textarea>');
          $(this).parent().after(txtArea);
          isOtherHouse=false;
        }
    })
    // 点击户型中除去其它单选框是执行的事件
    $(":radio[name*=housetype][value!=14]").click(function(){
        $("#isOtherHouse").remove();
        isOtherHouse=true;
    })


    // 点击风格中的其他单选框时执行的事件
    $(":radio[name*=style]:last").click(function(){
        var txtArea = $('<textarea id="otherStyle" name="form[otherType]" style="position:absolute;float:right;border-radius:5px;padding-top:5px;padding-left:5px;"></textarea>');
        $(this).parent().after(txtArea);
    })
    // 点击风格中的除去其他单选框时执行的事件
    $(":radio[name*=style]:not(:last)").click(function(){
        $("#otherStyle").remove();
    })

    $(document).ready(function(){      
      // 文档加载时显示其他户型
      if (hstyleNo==14) {
        var txtArea=$("<textarea dong='dong' name='form[otherHouseType]' style='position:absolute;float:right;border-radius:5px;padding-top:5px;padding-left:5px;'>"+hstyleName+"</textarea>");
        $("input[name*=housetype][value=14]").attr("checked","checked")
        .parent().after(txtArea);
      };
      // 文档加载时显示其他风格
      if (sNo==14) {
        var txtArea = $("<textarea zheng='zheng' name='form[otherType]' style='position:absolute;float:right;border-radius:5px;padding-top:5px;padding-left:5px;'>"+sName+"</textarea>");
        $("input[name*=style][value=14]").attr("checked","checked")
        .parents("label").after(txtArea);
      };



      // 文档加载时将几种效果图(平面图   效果图   竣工实景图   户型图)移动到现在的位置    并将lable移除
      $("#jgt").append($("table:eq(0)").find($("tr:eq(1)")));
      $("label:contains(平面图)").remove();
      $("#xgt").append($("table:eq(0)").find($("tr:eq(1)")));
      $("label:contains(效果图)").remove();
      $("#wzt").append($("table:eq(0)").find($("tr:eq(1)")));
      $("label:contains(户型图)").remove();
      $("#pmt").append($("table:eq(0)").find($("tr:eq(1)")));
      $("label:contains(竣工图)").remove();

      // 改变费用文本框的大小
      $("#area").css({width:"170px"});
      $("#cost").css({width:"170px"});

      // 文档加载的时候获取就数据的费用是否符合现在的规则    整数保留两位小数
      var cVal = $("#cost").val();
      var cPos=cVal.indexOf(".");
      if (cPos<1) {
        $("#cost").val(cVal+".00");
      };
    })

    $(":radio[name*=housetype]:not(:last)").click(function(){
      $("[dong=dong]").remove();
    })
    
    $(":radio[name*=style]:not(:last)").click(function(){
      $("[zheng=zheng]").remove();
    })  
    
    $(".chang").click(function(){
      var index=$(this).index();
      $(".chenge1").eq(index).css("display","block").siblings().css("display","none");
      $(this).removeClass("die").addClass("huodong").css("color","white");
      $(this).siblings().removeClass("huodong").addClass("die").css("color","black");
    })
</script>

<!--正文部分-->
<?php if(!isset($siteconfigs)) $siteconfigs=get_cache('siteconfigs'); include T('member','foot'); ?>
