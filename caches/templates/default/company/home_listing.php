<?php defined('IN_WZ') or exit('No direct script access allowed'); ?><?php if(!isset($siteconfigs)) $siteconfigs=get_cache('siteconfigs'); include T('member','head'); ?>
<script src="<?php echo R;?>member/js/jscarousel.js" type="text/javascript"></script>

<link href="<?php echo R;?>css/validform.css" rel="stylesheet" />
<link href="<?php echo R;?>js/colorpicker/style.css" rel="stylesheet">
 <link rel="stylesheet" type="text/css" href="<?php echo R;?>uzhuang/base/css/base.css"/>

    <script type="text/javascript">
        var cookie_pre="<?php echo COOKIE_PRE;?>";var cookie_domain = '<?php echo COOKIE_DOMAIN;?>';var cookie_path = '<?php echo COOKIE_PATH;?>';var web_url = '<?php echo WEBURL;?>';
    </script>
    <script type="text/javascript" src="<?php echo R;?>js/jquery.min.js"></script>
    <script type="text/javascript" src="<?php echo R;?>js/base.js"></script>
    <link href="<?php echo R;?>uzhuang/co/css/co-detail.css" rel="stylesheet" type="text/css">

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
<style type="text/css">

     #dv2{
         margin-left:45px; 
        float: left;
     }
     #tb1{
       
        text-align: center;
     }
     #t1{
        width: 150px;
        height: 110px; 
        margin-top:20px; 
     }
     #t2{
       
        width: 150px;
        height: 30px; 
     }
      #t3{
       
        width: 150px;
        height: 15px; 
     }
     #dv1{
        margin-left:260px;
        width: 600px;
        height: 160px; 
     }
    .mon *{margin:0px;padding:0px;}
    .ymon *{margin: 0px;padding: 0px;}
    .phheader img{width: 90px;height: 90px;float:left;margin-right: 10px;}
    .mon{width:120px;height:80px;float:left;margin-left:30px;}
   
.skill-service{
  position: absolute;
  right: 38px;
  top: 130px;
  font: 12px "宋体";
  color: #999;
}
 .paymented{
  
  font: 14px/24px "Microsoft YaHei";

}
 .wait-payment{
  font: 14px/24px "Microsoft YaHei";
  color: #333;
}
.view-record{
  font: 12px "Microsoft YaHei";
  color: #333;
  float: left;
  margin-right: 22px;
}
  .total-news{
  font: 12px "Microsoft YaHei";
  color: #333;
  width: 300px;
} 
.xtb{
 margin-left:350px;
padding-top:40px 
}
    .mon a:hover{color:black;}
    /*弹出的表单的样式*/
    .MarginForm{width:580px;height:300px;position:absolute;background: white;left: 30%;top: 20%;display: none;z-index: 10;border:1px solid #ccc;}
    .MarginForm table{width:500px;}
    .MarginForm tr{height:30px;}
    .MarginForm tr td{border:1px solid #DFDFE1;}
    /*主题内容部分的样式*/
    .content,.ContentCase{width:100%;}
    .content .header{height: 40px;width:98%;display:block;border:1px solid #DFDFE1;font-size: 20px;line-height: 40px;padding-left:10px;border-bottom: 1px solid #DFDFE1;margin-left:1%;margin-bottom: 15px;}
    .detailContent{width:98%;border:1px solid #DFDFE1;position: relative;left:1%;margin-bottom:10px;}
    /*装修案例样式*/
    .ContentCase *{margin:0; }
    .ContentCase .header{height: 40px;width:98%;display:block;border:1px solid #DFDFE1;font-size: 20px;line-height: 40px;padding-left:10px;border-bottom: 1px solid #DFDFE1;margin-left:1%;margin-bottom: 15px;}
    .RenovationContent{height: 200px;width:100%;border-bottom:1px solid #DFDFE1;border-top:1px solid #DFDFE1;padding-top:15px}
    .CaseImg{width:160px;height:142px;border:1px solid purple;position: relative;float: left;margin-left:55px;}
    .createCase{width:160px;height:110px;border:1px solid #DFDFE1;position: relative;float: left;margin-left:50px;overflow:hidden;}
    .createCase,#dv1{position:relative;top:15px;}
    .Projects li{width:160px;clear:both;display:inline-block;border:1px solid red;position:relative;left:265px;top:-45px;margin-right:52px;text-align:center;}
    .spanHader{font-family:microsoft yahei;font-size:16px;color:#777777;}
</style>
<body style="background: #f6f9fc url(../../../../res/uzhuang/userhome/img/body-bg.png) center 37px repeat-x;">
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
                        <div class="panel-heading"><span class="title">商户中心首页</span></div>
                        <div style="width:100%;height:100px;margin-bottom:20px" class="phheader">
                            <!-- 公司logo -->
                            <div style="position:relative;margin-left:40px;margin-top:8px;" class="memberphoto"><?php if($r1['thumb']!='') { ?><img src="<?php echo getImgShownew($r1['thumb'],'original');?>"><?php } else { ?><img src="http://www.uzhuang.com/res/images/userface.png"><?php } ?></div>
                            <!-- <img style="position:relative;margin-left:10px;margin-top:8px;" src="" alt=""> -->
                            <div class="mon">
                                <h4 style="font: 12px "Microsoft YaHei";color: #333;">保证金：</h4>
                                <label class="paymented">已交:<?php 
                                          $sum=0;
                                           $sjf;
                                          
                                         foreach ($aCom2row as $key => $value1) {
                                           if(in_array(15,$orno1)&&in_array(17,$orno1)){
                                             $sjf=$value1['designpay'];
                                           }else{
                                             $sjf=$value1['designpay']*0.3;
                                           }
                                           
                                             if($maxnodeid==45){
                                             echo $bzj=$sjf*0.1+$value1['extrapay']*0.1+$sgf*0.1;
                                             if($bzj>10000){
                                               $bzj=10000;
                                             }
                                           }else{

                                              $bzj=$sjf*0.1+$value1['extrapay']*0.1;
                                             if($bzj>10000){
                                               $bzj=10000;
                                             }
                                             }
                                           $sum+=$bzj;
                                        }
                                        if($sum>10000){
                                          echo $sum=10000;
                                        }else{
                                        echo $sum;
                                        }
                                        ?>元
                                        </label><br>
                                <label class="wait-payment">待交:<?php 
                                   $sum=0;
                                           $sjf;
                                          
                                         foreach ($aCom2row as $key => $value1) {
                                           if(in_array(15,$orno1)&&in_array(17,$orno1)){
                                             $sjf=$value1['designpay'];
                                           }else{
                                             $sjf=$value1['designpay']*0.3;
                                           }
                                           
                                             if($maxnodeid==45){
                                             $bzj=$sjf*0.1+$value1['extrapay']*0.1+$sgf*0.1;
                                             if($bzj>10000){
                                               $bzj=10000;
                                             }
                                           }else{

                                              $bzj=$sjf*0.1+$value1['extrapay']*0.1;
                                             if($bzj>10000){
                                               $bzj=10000;
                                             }
                                             }
                                           $sum+=$bzj;
                                        }
                                        if($sum>10000){
                                           $sum=10000;
                                        }
                                    
                                $c=10000-$sum;
                                echo $c;
                                ?> 元</label><br>
        <p class="view-record"><a href="javascript:void(0)" class="Bond" style="color:blue">查看记录</a></p>
        <p class="total-news"><a href="?m=messagewp&f=message&v=listing" class="message" style="color:blue">全部消息(<?php echo $messageNum;?>)</a></p>
                                <!-- <label style="font-size:16px;font-size:border;">全部消息()</label> -->
                            </div>
                            <div class="skill-service"><p>技术服务年费：<span>免费</span></p></div>
                                              
                        <!-- 用来放小图标 -->
                        <div class="xtb">
                        <div class="zx-renzheng">
                      
                                      <?php if($r1['check_cert']==1) { ?>
                                      <i class="rz_1" title="该公司营业执照已认证"></i>
                                      <?php } else { ?>
                                       <i class="rz_1_no" title="该公司营业执照未认证"></i>
                                      <?php } ?>
                                      <?php if($r1['check_company']==1) { ?>
                                      <i class="rz_2" title="认证公司"></i>
                                       <?php } else { ?>
                                       <i class="rz_2_no" title="该公司未认证"></i>
                                      <?php } ?>
                                      <?php if($r1['check_money']==1) { ?>
                                      <i class="rz_8" title="该公司已交10000.00元保障金"></i><em title="该公司已交10000.00元保障金">10000元</em>
                                       <?php } else { ?>
                                       <i class="rz_8_no" title="该公司未交保障金"></i>
                                      <?php } ?>
                                        <?php if(in_array(1,explode(',',$r1['tese']))==true) { ?>
                                        <i class="rz_9" title="合同签署后绝无任何增项费用"></i><em title="合同签署后绝无任何增项费用">0增项</em>
                                        <?php } else { ?>
                                        <i class="rz_9_no" title="合同签署后绝无任何增项费用"></i><em title="合同签署后绝无任何增项费用">0增项</em>
                                      <?php } ?>
                                      <?php if(in_array(2,explode(',',$r1['tese']))==true) { ?>
                                        <i class="rz_10" title="环保0问题装修"></i><em title="环保0问题装修">0污染</em>
                                        <?php } else { ?>
                                        <i class="rz_10_no" title="环保0问题装修"></i><em title="环保0问题装修">0污染</em>
                                      <?php } ?>
                          </div>
                          </div>
                            </div>
                        <!-- 保证金账户记录表单 -->
                        <div class="MarginForm">
                            <span style="font-size:20px;cursor:pointer;float:right;margin-right:10px;" title="点击关闭">×</span>
                                <center>保证金账户记录<br />
                              
                                <span style="float:right;margin-right:40px;clear:both;">待交款:<?php 
                                  $sum=0;
                                           $sjf;
                                          
                                         foreach ($aCom2row as $key => $value1) {
                                           if(in_array(15,$orno1)&&in_array(17,$orno1)){
                                             $sjf=$value1['designpay'];
                                           }else{
                                             $sjf=$value1['designpay']*0.3;
                                           }
                                           
                                             if($maxnodeid==45){
                                             $bzj=$sjf*0.1+$value1['extrapay']*0.1+$sgf*0.1;
                                             if($bzj>10000){
                                               $bzj=10000;
                                             }
                                           }else{

                                              $bzj=$sjf*0.1+$value1['extrapay']*0.1;
                                             if($bzj>10000){
                                               $bzj=10000;
                                             }
                                             }
                                           $sum+=$bzj;
                                        }
                                        if($sum>10000){
                                           $sum=10000;
                                        }
                                    
                                $c=10000-$sum;
                                echo $c;
                                ?></span>
                                <table cellspacing="0" style="clear:both;">
                                    <tr>
                                        <td>订单编号</td>
                                        <td>订单时间</td>
                                        <td>保证金</td>
                                    </tr>
                            

                             <?php foreach ($aCom2row as $key => $value1) {?>
                                <tr>
                                  <td> <?php  echo $value1['order_no'];?></td>
                                  <td><?php  echo $value1['paydate'];?></td>
                                   <td>
                                   <?php
                                     
                                           $sjf;
                                           if(in_array(15,$orno1)&&in_array(17,$orno1)){
                                             $sjf=$value1['designpay'];
                                           }else{
                                             $sjf=$value1['designpay']*0.3;
                                           }
                                           
                                             if($maxnodeid==45){
                                             echo $bzj=$sjf*0.1+$value1['extrapay']*0.1+$sgf*0.1;
                                             if($bzj>10000){
                                              echo $bzj=10000;
                                             }
                                           }else{

                                             echo $bzj=$sjf*0.1+$value1['extrapay']*0.1;
                                             if($bzj>10000){
                                              echo $bzj=10000;
                                             }
                                             }

                                   ?>
                                    </td>
                                </tr>
                            <?php  }?>
                                    <tr>
                                        <td colspan="3">合计:  <?php 
                                          $sum=0;
                                           $sjf;
                                          
                                         foreach ($aCom2row as $key => $value1) {
                                           if(in_array(15,$orno1)&&in_array(17,$orno1)){
                                             $sjf=$value1['designpay'];
                                           }else{
                                             $sjf=$value1['designpay']*0.3;
                                           }
                                           
                                             if($maxnodeid==45){
                                             echo $bzj=$sjf*0.1+$value1['extrapay']*0.1+$sgf*0.1;
                                             if($bzj>10000){
                                               $bzj=10000;
                                             }
                                           }else{

                                              $bzj=$sjf*0.1+$value1['extrapay']*0.1;
                                             if($bzj>10000){
                                               $bzj=10000;
                                             }
                                             }
                                           $sum+=$bzj;
                                        }
                                        if($sum>10000){
                                          echo $sum=10000;
                                        }else{
                                        echo $sum;
                                        }
                                        ?>
                                    
                                        </td>
                                    </tr>
                                </table>
                               <!--  <div>
                               <ul class="pagination">
                                           <?php echo $pages;?>
                                       </ul>
                               </div> -->
                            <form action="index.php?m=orderwpwp&f=address&v=listing" method="post" style="margin-top:15px;">
                                    <input style="margin-top:10px;" type="submit" value="查看详情">
                            </form>
                                </center>
                        </div>
                        <div style="margin-bottom:5px;" class="content" >
                            <span class="header"><span class="spanHader">订单信息</span><span style="position:relative;float:right;padding-right:5px;"><a href="index.php?m=orderwp&f=address&v=listing&acbar=1#tabs1" class="spanHader">更多&gt;</a></span></span>
                            <div class="detailContent">
                                <?php if(count($result)!=0) {?>
                                  <table class="table table-striped table-advance table-hover text-center">
                                        <thead>
                                        <tr>
                                            <th class="tablehead">订单编号</th>
                                            <th class="tablehead">订单时间</th>
                                            <th class="tablehead">用户姓名</th>
                                            <th class="tablehead">详细地址</th>
                                            <th class="tablehead">风格</th>
                                            <th class="tablehead">户型</th>
                                            <th class="tablehead">面积</th>
                                            <th class="tablehead">预算</th>
                                            <th class="tablehead">订单状态</th>
                                            <th class="tablehead">管理操作</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php $n=1;if(is_array($result)) foreach($result AS $r) { ?>
                                        <tr>
                                            <td class="orderlist"><?php echo $r['order_no'];?></td>
                                            <td class="orderlist"><?php echo $r['addtime'];?></td>
                                            <td class="orderlist"><?php echo $r['title'];?></td>
                                            <td class="orderlist" style="width:192px"><?php echo $r['address'];?></td>
                                           <td class="orderlist"> 
                                            <?php $configs_picture = get_config('picture_config');?>
                                            <?php $pp=trim($r['style'],',');?>
                                            <?php $ss=explode(',',$pp);?>
                                                   <?php for($i=0;$i<count($ss);$i++){
                                                      echo $configs_picture['style'][$ss[$i]].'&nbsp;&nbsp;';
                                                   }
                                                   ?>
                                            </td>
                                            <td class="orderlist"> 
                                             <?php if($r['renovationcategory']=='1') { ?>
                                           <?php $configs_picture = get_config('picture_config');?>
          
                                          <?php 
                                          echo $configs_picture['homestyle'][$r['homestyle']];
                                           ?>
                                          <?php } elseif ($r['renovationcategory']=='2') { ?>
            
                                         <?php $configs_picture = get_config('picture_config');?>
          
                                    <?php
                     
                                      echo $configs_picture['housetype'][$r['housetype']];
                                            ?>
                                       <?php } ?> 
                                       </td>
                                            <td class="orderlist"><?php echo $r['area'];?>m&sup2;</td>
                                            <td class="orderlist"><?php echo $r['budget'];?>万元</td>
                                            <td class="orderlist">
                                        <?php if($r['orderstatus']=='完结') { ?>
                                         已完结
                                        <?php } elseif ($r['orderstatus']=='正常') { ?>
                                           施工中
                                         <?php } elseif ($r['orderstatus']=='已暂停') { ?>  
                                            已暂停
                                          <?php } elseif ($r['orderstatus']=='已终止') { ?>
                                             已终止
                                           <?php } ?>

                                            </td>
                                            <td class="orderlist">
                                            <a href="index.php?m=orderwp&f=address&v=listing_details&id=<?php echo $r['id'];?>&order_no=<?php echo $r['order_no'];?>">
                                           <font color="blue"><u>
                                           订单详情</u></font></a>
                                           <!-- <a href="index.php?m=orderwp&f=address&v=listing_evaluate&id=<?php echo $r['id'];?>">查看评价</a> -->
                                            <!-- <a href="index.php?m=dianping&f=index&v=mydianping&id=<?php echo $r['id'];?>">查看评价</a> -->
                                            </td>
                                        </tr>
                                        <?php $n++;}?>
                                        </tbody>
                                    </table>
                             <?} else {?>
                                <table class="table table-striped table-advance table-hover text-center" >
                                
                                    <tr style="font-family:宋体;font-size:20px;">
                                        <th  style="height:180px;font-size:larger;padding-left:360px;">您目前没有订单</th>
                                    </tr>
                                    
                                </table>
                            <?}?>
                            </div>
                        </div>

                        <div style="margin-bottom:5px;" class="ContentCase">
                            <span class="header"><span class="spanHader">装修案例</span><span style="position:relative;float:right;padding-right:5px;"><a href="index.php?m=company&f=biz_photo&v=listing" class="spanHader">更多&gt;</span></span>
                            <div class="RenovationContent" >
                                <div class="createCase" style="margin-top:12px;"><a href="index.php?m=company&f=biz_photo&v=add#tabs2">
                                    <img src="<?php echo R;?>images/case.png" alt="" ></a>
                                </div>
                                <div id="dv1">
                                 <?php if(count($result1)!=0) {?>
                                  <?php foreach ($result1 as $key=>$r2) { ?>
                                  <div id="dv2">
                                <table id="tb1" border="1" color="red" >
                              <tr>
                                  <td id="t1" style="border:1px solid #DFDFE1;"><img src="<?php echo getImgShownew($r2['thumb'],'small');?>" style="height: 110px;width: 150px;" ></td>
                              </tr>
                                <tr>
                                  <td id="t2" style="border:1px solid white;"><?php echo $r2['title'];?></td>
                              </tr>

                              </table>
                              </div>
                              <?}?>
                               <?} else {?>
                              <table class="table table-striped table-advance table-hover text-center" style="margin-left:40px;position:relative;top:-20px;">
                                   
                                    <tr style="color:#FFFFFF">
                                        <th style="height:180px;font-size:larger;font-family:宋体;font-size:18px;padding-left:20px;">您目前还没有装修案例，增加装修案例能够提高接单几率，快去<a href="?m=company&f=biz_photo&v=add"><u color="blue"><b>创建</b></u></a>吧</th>
                                    </tr>
                                   
                              </table>
                            <?}?>
                              </div>
                            </div>
                        </div>

                        <div style="margin-bottom:5px;" class="ContentCase">
                            <span class="header"><span class="spanHader">设计师</span><span style="position:relative;float:right;padding-right:5px;"><a href="index.php?m=company&f=biz_design&v=listing#tabs2" class="spanHader">更多&gt;</a></span></span>
                            <div class="RenovationContent">
                                <div class="createCase" style="margin-top:18px;"><a href="index.php?m=company&f=biz_design&v=listing#tabs2">
                                    <img src="<?php echo R;?>images/design.png" alt=""></a>
                                </div>
                                 <div id="dv1">
                                <?php if(count($result3)!=0) {?>
                                  <?php foreach ($result3 as $key=>$r3) { ?>
                                  <div id="dv2">
                                <table id="tb1" style="border:1px solid #DFDFE1" color="red" >
                              <tr>
                                  <td id="t1"><img src="<?php echo getImgShownew($r3['thumb'],'original');?>" style="height: 110px;width: 150px;" ></td>
                              </tr>
                                <tr>
                                  <td id="t2" style="border:1px solid white;border-top:1px solid #DFDFE1;"><?php echo $r3['title'];?></td>
                              </tr>
                              <tr>
                                  <td id="t3" style="border:1px solid white;">(<?php echo $r3['ranks'];?>)</td>
                              </tr>

                              </table>
                              </div>
                              <?}?>
                              <?} else {?>
                             <table class="table table-striped table-advance table-hover text-center" style="margin-left:40px;position:relative;top:-20px;">
                                  
                                    <tr>
                                        <th  style="height:180px;font-size:larger;font-family:宋体;font-size:18px;padding-left:130px;">您目前还未创建设计师,快去<a href="?m=company&f=biz_design&v=listing#tabs2"><b>创建</b></u></a>吧</th>
                                    </tr>
                                  
                                </table>
                            <?}?>
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
    <link href="<?php echo R;?>uzhuang/css/member.css" rel="stylesheet" type="text/css">

</body>
<script>
    $(function(){
        $(".form-horizontal").Validform({
            tiptype:1
        });
    })
    $(".form-horizontal").Validform({
        tiptype:1,
        datatype:{//传入自定义datatype类型【方式二】;

            "max6":function(gets,obj,curform,regxp){
                var atmax=6,
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

    $(".Bond").click(function(){
        $(".MarginForm").css("display","block");
    })
    $(".MarginForm span:first").click(function(){
        $(".MarginForm").css("display","none");
    })
</script>
<!--正文部分-->
<?php if(!isset($siteconfigs)) $siteconfigs=get_cache('siteconfigs'); include T('member','foot'); ?>
