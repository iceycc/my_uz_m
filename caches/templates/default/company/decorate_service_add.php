<?php defined('IN_WZ') or exit('No direct script access allowed'); ?><?php defined('IN_WZ') or exit('No direct script access allowed');?>
<?php
    session_start();
    $t=mktime();
    $_SESSION['conn_id']=$t;
    $_SESSION['conn']=$t;
   // var_dump($_SESSION);
    //var_dump($_COOKIE);
?>
<?php if(!isset($siteconfigs)) $siteconfigs=get_cache('siteconfigs'); include T('member','head'); ?>
<script src="<?php echo R;?>member/js/jscarousel.js" type="text/javascript"></script>
<link href="<?php echo R;?>css/validform.css" rel="stylesheet" />
<script src="<?php echo R;?>js/validform.min.js"></script>
<script type="text/javascript" src="<?php echo R;?>js/ueditor/ueditor.config.js"></script>
<script type="text/javascript" src="<?php echo R;?>js/ueditor/ueditor.all.min.js"></script>
<script type="text/javascript" src="<?php echo R;?>js/uz_alert.js"></script>



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



   
    }
</script>
<style>
    #content {
        height: 80px;
    }
    .myTable tr{
      border:1px solid #ccc;
    }
    .myTable td{
      height:20px;
    }
</style>
<style>
/*xushu 0917 edit*/
#alert-bar {
    margin: 0;
}
#xs-company-layer {
    width: 680px;
}
.company-search {
    height: 56px;
}
.company-search h3 {
    float: left;
    font: normal 14px/36px "Microsoft YaHei";
    margin: 0;
}
.company-search .search-input {
    float: left;
    width: 480px;
    height: 36px;
    margin-left: 10px;
    text-indent: 5px;
}
.company-search .search.btn {
    float: left;
    margin-left: 5px;
    background-color: #387bb8;
    color: #fff;
    width: 90px;
    height: 36px;
}
.company-search .search.btn:hover, #addComp:hover {
    background-color: #2784D9;
}
#xs-company-layer form {
    min-height:  200px;
    max-height: 260px;
    overflow-y: scroll;
    text-align: left;
}
#xs-company-layer .myTable {
    margin: 0 5px !important;
    width: 97% !important;
    font: normal 12px/24px "宋体";
}
.myTable input {
    position: relative;
    top:3px;
    margin-right: 8px;
}
#xs-company-layer .myTable td {
    padding: 3px 10px;
}
#addComp {
    padding: 0;
    margin-top: 5px;
    width: 240px;
    height: 40px;
    background-color: #387bb8;
    color: #fff;
    text-align: center;
    font: normal 14px/40px "宋体" !important;
    border-width: 0;
    border-color: #357ebd;
}
.myTable tr{
  border:1px solid #ccc;
}
.selectCompany {
    background: #fff;
    border: 1px solid #ccc;
    border-radius: 3px;
    padding: 0 30px 0 10px;
}
.delCom {
    position: absolute;
    top: 9px;
    display: block;
    font: normal 12px/17px "Arial";
    width: 18px;
    height: 18px;
    border: 1px solid #ccc;
    background-color: #cecece;
    color: #fff;
    -webkit-border-radius: 10px;
    -ms-border-radius: 10px;
    -moz-border-radius: 10px;
    border-radius: 10px;
    cursor: pointer;
    right: 10px;
}
.delCom:hover {
    color: #fff;
    border: 1px solid #B76161;
    background-color: #EF6969;
}
.add {
     float: left;
    margin-left: 15px;
    width: 80px;
    height: 33px;
    line-height: 30px;
    color: #fff;
    background-color: #387BB8;
}
.add:hover {
    color: #fff;
    background-color: #2784D9;
}
.removeDiv{
    position: relative;
    float: left;    
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
            <div id="xs-company-layer" class="hide">
              <div class="company-search">
                <h3>装修公司名称:</h3>
                <input class="search-input" type="text" name="companyName">
                <input class="search btn" type="button" class="search" value="搜索">
                <!-- <a href="index.php?m=company&f=biz_decorate_service&v=searchCompany">阿道夫</a> -->
              </div>
              <form>
                  <table class="myTable" cellspacing="0">
                    <tr class="companyTitle">
                      <td style="text-align:center;">装修公司名称</td>
                    </tr>
                    <!-- <tr>
                      <td><input type="radio" name="com">东易</td>
                    </tr> -->
                  </table>
              </form>
              <div class="bottom-btn">
                  <input id="addComp" type="button" value="添加" >
              </div>
            </div>
            <div class="memberright">

                <div class="memberbordertop">
                    <section class="panel">
                        <div class="panel-heading"><span class="title">申请装修服务</span></div>

                        <div id="myTabContent" class="tab-content tabsbordertop">
                            <div role="tabpanel" class="tab-pane fade active in" id="tabs1" aria-labelledby="1tab">

                                <form name="myform" method="post" class="form-horizontal" action="index.php?m=company&f=biz_decorate_service&v=add" onSubmit="return submitOnce(this)">
                                      <input type="hidden" name="token" value="<?php echo $_SESSION['token']; ?>">
                                    <table class="table table-striped table-advance table-hover text-center">
                                        <tr class="selCompany">
                                            <td><div class="form-groupinfo">
                                            <label class="col-sm-2 control-label text-right text-blod" style="position:relative;float:left;padding-right: 19px;" class="beforeCom">
                                            <font color="red"></font>指定装修公司:</label>
                                            <a class="add">+ 添加</a>
                                            <div style="position:relative;float:left;height:30px;line-height:30px;" id="companyName">
                                                <!-- <input type="text" name="" disabled="" id="aaaaaa" id=""> -->
                                            </div>
                                            <div style="clear:both;">
                                                </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><div class="form-groupinfo"><label class="col-sm-2 control-label text-right text-blod"><font color="red">*</font> 您的姓名：</label><div class="col-sm-4 text-le">
                                                <input type="text" style="width: 142px; " style="" name="form[title]" id="title" maxlength="40" value="" class="form-control" datatype="*2-40" nullmsg="请输入您的姓名" errormsg="姓名至少2个字符,最多40个字符！">                                       </div></div></td>
                                        </tr>
                                         <!-- <tr>
                                            <td><div class="form-groupinfo"><label class="col-sm-2 control-label text-right text-blod">所在小区 ：</label><div class="col-sm-4 text-le">
                                                <input type="text" style="" name="form[title]" id="title" maxlength="40" value="" class="form-control" datatype="*2-40" nullmsg="请输小区名" errormsg="姓名至少2个字符,最多40个字符！">                                       </div></div></td>
                                                                                 </tr> -->
                                        
                                        <?php $n=1;if(is_array($field_list)) foreach($field_list AS $info) { ?>
                                        <tr id="tr_<?php echo $info['field'];?>">
                                            <td><div class="form-groupinfo"><label class="col-sm-2 control-label text-right text-blod"><?php if($info['star']) { ?><font color="red">*</font><?php } ?> <?php echo $info['name'];?>：</label><div class="col-sm-10 text-left">
                                                <?php echo $info['form'];?>
                                            </div></div></td>
                                        </tr>
                                        <?php $n++;}?>
                                        
                                        <tr>
                                           <input type="hidden" name="hidden" id="hidden" value="<?php echo $_SESSION['conn_id']?>">
                                           
                                        <td><div class="form-groupinfo"><label class="col-sm-2 control-label text-right"> </label><div class="col-sm-3 text-left"><input type="submit" name="submit" id="submit" value="提交" class="btn btn-order" style="width:160px">
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
                                </div>
                                </div>
                                </div>
                                
                         
                  
<script type="text/javascript">
    $(function(){
        $(".form-horizontal").Validform({
            tiptype:1,
            ignoreHidden:true,
            beforeCheck:function(){ //zx 2015-10-24
                var test1=0;
                $('.form-groupinfo input[type=checkbox]').each(function(){
                    if($(this).is(":checked")){
                        test1++;
                    }
                });
                if(test1==0){
                    $('#Validform_msg').css({
                        'display': 'block',
                        'left': '820px',
                        'top': '408.5px',
                    });
                    $(".Validform_info").text("请选择装修风格");
                    return false;
                }
                return true;
            }
        });
        $("#tr_housetype").css('display','none');
        $("#tr_yxgsm").css('display','none');
          
        
    })
    function change_formtype(type) {
        if(type==1) {
            $("#tr_housetype").css('display','none');
            $("#tr_homestyle").css('display','');
        } else {
            $("#tr_housetype").css('display','');
            $("#tr_homestyle").css('display','none');
        }
    }
    function change_formtype2(type) {
        if(type==2) {
            $("#tr_yxgsm").css('display','');
        } else {
            $("#tr_yxgsm").css('display','none');

        }
    }


    $('#other_checkbox').bind('click',function() {
        $('#other_input').toggle(); 
    })  
    $("#ws_add_company").bind('click',function(){
        uzAlert('demo123','123456789');
    })
    
    // alert($)
    $(document).ready(function(){
        $(".selCompany").insertAfter("#tr_referral");
        $("#area").after("<b style='position:relative;left:150px;top:-25px;'>m²</b>");
        $("#area").parents("tr").css("height","33px")
    })
     $(document).ready(function(){
        $(".selCompany").insertAfter("#tr_referral");
        $("#budget").after("<b style='position:relative;left:150px;top:-25px;'>万元</b>");
        $("#budget").parents("tr").css("height","33px")
    })

    $(".add").click(function(){
        uzAlert('xs-company-layer','搜索装修公司');
        //$(".addCom").css("display","block");
    })
    $(".close").click(function(){
        $(".addCom").css("display","none");
    })

    $(".search").click(function(){
        var comName = $("input[name=companyName]").val();
        // alert(comName);return false;
        $.ajax({
            url:"index.php?m=company&f=biz_decorate_service&v=searchCompany",
            data:{'cname':comName},
            type:"POST",
            dataType:"json",
            success:function(data){
                
                $(".companyTitle").siblings().remove();
                $.each(data,function(i,companyObj){
                    $(".companyTitle").after("<tr><td><input type='checkbox' class='selcom' value='"+companyObj.uid+"' name='com'>"+companyObj.companyname+"</td></tr>");
                })
            },
            error:function(){

            },
            async:true
        })
    })

    $(document).on('click','.selcom',function(){
        var selCount = $("input[checked=checked]").length;
        if (selCount<=2) {
            var isC = $(this).attr("checked");
            if (!isC) {
                $(this).attr("checked","checked");
            }else{
                $(this).removeAttr("checked");
            }
        }else{
            var isCl = $(this).attr("checked");
            if (isCl) {
                $(this).removeAttr("checked");
            }else{
                alert("最多可选三家")
                return false;
            }
        }
    })

    $("#addComp").click(function(){
        var l=$("#companyName .removeDiv").length;
        var cl=$(".selcom:checked").length;
        var zong=l+cl;
        if (zong>3) {
            alert("最多可添加三家");
            return false;
        }
        // 现在选择的公司
        var selectCompany = new Array();
        var selNum=0;
        $(".selcom:checked").each(function(){
            selectCompany[selNum]=$(this).val();
            selNum++;
        })        
        
        // 已经选择的公司
        var selectedCompany = new Array();
        var isAddCompany=true;
        $(":hidden[name*=comID]").each(function(){
            var v=$(this).val();
            var res=$.inArray(v, selectCompany);
            if (res!=-1) {
                var name=$(".selcom[value="+v+"]").parent().text();
                alert(name+"已经选择了");
                isAddCompany = false;
                return false;
            };
        })

        $(".selcom:checked").each(function(){
            if (!isAddCompany) {
                return false;
            };
            var v=$(this).parent().text();
            var id=$(this).val();
            var comlen = $("#companyName").children().length;
            if (comlen>3) {
                // alert(comlen)
                alert("最多可添加三家")
                return false;
            }
            $("#companyName").append('<div class="removeDiv"><input type="text" name="item[comName][]" style="margin-left:5px;height:35px;" onclick="delCompany()" disabled="" class="selectCompany" value="'+v+'" /><input type="hidden" name="item[comName][]" value="'+v+'" /><input type="hidden" name="item[comID][]" value="'+id+'" /><span class="delCom" title="点击取消"">x</span></div>');
            $(this).attr('checked', false).parent().css('display', 'none'); //zx 2015-10-24
            closeAlert();
        })
    })



    $(document).on("click",".delCom",function(){
        var val = $(this).prev().val(); //zx 2015-10-24
        $(this).prev().remove();
        $(this).nextUntil(":text").remove();
        $(this).parents(".removeDiv").remove();
        $(".selcom:input[value="+val+"]").attr('checked', false).parent().css({ //zx 2015-10-24
            'display': 'block',
            'height': '32px',
        });
    })
    function delCompany(){
        alert("ting")
    }

    var count = 0;
    $(".checkbox-inline:last").find(":checkbox").click(function(e){
        var textBox = $('<textarea name="other" style="position:absolute;"></textarea>');
        count++;
        //alert(count)
        if (count%2==0) {
            $(this).parent().next().remove();
        }else{
            $(this).parent().after(textBox);
        }
        
    })
     var c=0,limit=2; 
       function doCheck(obj) { 
            obj.checked?c++:c--; 
            if(c>limit){ 
              obj.checked=false; 
              alert("最多只能选择两种风格"); 
              c--; 
            } 
        }
    
    /*var submitcount=0;
    function submitOnce (form){
      if (submitcount == 0){
             submitcount++;
             return true;
        } else{
            alert("请不要重复提交，谢谢！");
          return false;
        }
    }*/
// $('.form-horizontal').submit(function() {
//     var test=0;
//     $('.form-groupinfo input[type=checkbox]').each(function(){
//         if(!$(this).attr('checked')){
//             test=1;
//            return false;

//         }
//     });
//     if(test==1){
//         $(".Validform_info").html("qing");
//         alert($(".Validform_info").text());
//          return false;
//     }// preventDefault();
// });
// 

</script>

<script src="<?php echo R;?>js/bootstrap.min.js"></script>
<script src="<?php echo R;?>js/jquery.nicescroll.js" type="text/javascript"></script>
<script src="<?php echo R;?>js/pxgrids-scripts.js"></script>
  
<!--正文部分-->
<?php if(!isset($siteconfigs)) $siteconfigs=get_cache('siteconfigs'); include T('member','foot'); ?>

