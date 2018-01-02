<?php defined('IN_WZ') or exit('No direct script access allowed');?>
<?php
include $this->template('header','core');
?>
<body class="body">
<link rel="stylesheet" href="<?php echo R;?>js/layui/css/layui.css"  media="all">
<script src="<?php echo R;?>js/LodopFuncs.js"></script>
<style type="text/css">
   body{
          overflow-y: scroll;
          overflow-x: scroll;
      }
      ::-webkit-scrollbar {
          width:10px;
      }
      ::-webkit-scrollbar-track {
          -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.1); 
          -webkit-border-radius: 10px;
          border-radius: 10px;
      }
      ::-webkit-scrollbar-thumb {
          -webkit-border-radius: 10px;
          border-radius: 10px;
          -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.1); 
      }
      ::-webkit-scrollbar-thumb:window-inactive {
          background: rgba(255,0,0,0.1); 
      }
      .wrapper{
        min-width: 1520px;
        overflow-y: auto;
      }
      .layui-unselect{
        width: 100px;
      }
      .layui-form-checkbox{
        width: 0px;
      }
      .xt{
        text-align: center;
      }
      .line-input{
        display: inline-block;
        width: auto;
      }
      .seach-button-style{
        border:none;
        background:#009688;
        border-radius:3px;
        color:white;
        height:38px;
        padding-left:15px;
        padding-right:15px;
      }
</style>
<script src="<?php echo R;?>js/layer.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo R;?>css/layer.css">
<link rel="stylesheet" type="text/css" href="<?php echo R;?>css/autocomplete.css">
<section class="wrapper">
    <div class="row">
      <section class="panel">

        <p class="layui-elem-quote">数据监控</p> 

        <form class="layui-form" action="">
          <div class="layui-inline">
            <label class="layui-form-label">城市</label>
            <div class="layui-input-inline sel-type">
              <select name="modules" lay-verify="required" lay-search="">
                <option value="">全部城市</option>
                <?php foreach ($citys as $k => $v) {?>
                   <option value="<?php echo $v['lid']?>" <?php echo $GLOBALS['cityid']==$v['lid']?'selected':'' ?>><?php echo $v['name']?></option>
                <? }?>
              </select>
            </div>
          </div>
        </form>


        <div class="layui-form" style="padding-bottom: 50px;">
          <table class="layui-table">
            <colgroup>
              <col width="200">
              <col width="150">
              <col width="200">
              <col width="200">
              <col width="200">
              <col width="200">
              <col>
            </colgroup>
            <thead>
              <tr>
                <th></th>
                <th>注册数量</th>
                <th>新增推荐</th>
                <th>预约量房</th>
                <th>上门量房</th>
                <th>签订三方合同</th>
                <!-- <th>推荐总数</th>
                <th>预约量房总数</th>
                <th>上门量房总数</th> -->
              </tr> 
            </thead>
            <tbody>
              <tr>
                <td class="xt">今日</td>
                <td class="regist_num_today xt"><?php echo $today_regist_num['num'];?></td><!-- 今日注册数量 -->
                <td class="dd xt"><?php echo $today['num']?></td>
                <td class="ff xt"><?php echo $subscribe['num']?></td>
                <td class='gg xt'><?php echo $visit['num']?></td>
                <td class='pp xt'><?php echo $compact['num']?></td>
                <!-- <td rowspan="3" class="aa xt"><?php echo $count['num'];?></td>
                <td rowspan="3" class="bb xt"><?php echo !empty($s) ? $s : count($subscribec);?></td>
                <td rowspan="3" class="cc xt"><?php echo !empty($vc) ? $vc : count($visitc);?></td> -->
              </tr>
              <tr>
                <td class="xt">本月</td>
                <td class="regist_num_month xt"><?php echo $month_regist_num['num'];?></td><!-- 本月注册数量 -->
                <td class="ee xt"><?php echo $month['num']?></td>
                <td class="hh xt"><?php echo $subscribem['num']?></td>
                <td class="ii xt"><?php echo $visitm['num']?></td>
                <td class="oo xt"><?php echo $compact_m['num']?></td>
              </tr>

              <tr>
                <td class="all_info xt">全部</td>
                <td class="regist_num_all xt"><?php echo $regist_num['num'];?></td><!-- 本月注册数量 -->
                <td class="recommend_null_all xt aa"><?php echo $count['num'];?></td>
                <td class="appointment_amount_root_num xt bb"><?php echo !empty($s) ? $s : count($subscribec);?></td>
                <td class="the_door_amount_root_num xt cc"><?php echo !empty($vc) ? $vc : count($visitc);?></td>
                <td class="the_door_amount_root_num xt cc"><?php echo !empty($vc) ? $vc : count($compact_n);?></td>
              </tr>

              <tr>
                <td>
                   <div class="layui-inline">
                        <input class="layui-input time-begin" placeholder="开始日期" onclick="layui.laydate({elem: this, istime: true, format: 'YYYY-MM-DD hh:mm:ss'})" value="">
                        <span style='position: absolute;top: 8px;left: 183px;'>
                          
                        </span>
                        <input class="layui-input time-end" placeholder="结束日期" onclick="layui.laydate({elem: this, istime: true, format: 'YYYY-MM-DD hh:mm:ss'})" style="position: relative;top: 8px;" value="">
                        <button class="layui-btn layui-btn-mini xiao" style="margin-top: 11px;">搜索</button>
                   </div>
                </td>
                <td class="xt" id='search_range_retist_num'></td>
                <td class="xt" id='a'></td>
                <td class="xt" id='c'></td>
                <td class="xt" id='b'></td>
                <td class="xt" id='d'></td>
              </tr>
            </tbody>
          </table>
        </div>
        
        <form class="layui-form search" action="" method="get" id="form2" style="padding: 10px;">
        <input name="m" value="award" type="hidden">
        <input name="f" value="award" type="hidden">
        <input name="v" value="bazaar" type="hidden">
        <input name="_su" value="<?php echo $GLOBALS['_su'];?>" type="hidden">
        <input name="begin_time" value="<?php echo $begin_time;?>" type="hidden">
        <input name="end_time" value="<?php echo $end_time;?>" type="hidden">
        <input name="city" value="<?php echo $city;?>" type="hidden">
        <input name="tui" value="<?php echo $tui;?>" type="hidden">
        <input name="searchWord" value="<?php echo $searchWord;?>" type="hidden">
          <div class="layui-inline">
            <input class="layui-input time-begin line-input icon-calendar" placeholder="开始日期" onclick="layui.laydate({elem: this, istime: true, format: 'YYYY-MM-DD hh:mm:ss'})" name="begin_time" value="<?php if($begin_time)echo $begin_time; ?>">到
            <input class="layui-input time-end line-input icon-calendar" placeholder="结束日期" onclick="layui.laydate({elem: this, istime: true, format: 'YYYY-MM-DD hh:mm:ss'})" name="end_time" value="<?php if($end_time)echo $end_time; ?>">
          </div>
           <div class="layui-inline">
            <div class="layui-input-inline">
<!--               <select name="city" lay-verify="required" lay-search="">
     <option value="0" <?php echo $city==0 ? 'selected':'' ?>>全部城市</option>
     <?php foreach ($citys as $k => $v) {?>
         <option value="<?php echo $v['lid']?>" <?php echo $city==$v['lid']?'selected':'' ?>><?php echo $v['name']?></option>
     <? }?>
</select> -->
            </div>
             <div class="layui-input-inline">
              <select name="tui" lay-verify="required" lay-search="">
                   <option value="1" <?php echo $tui==1 ? 'selected':'' ?>>手机号</option>
                   <option value="2" <?php echo $tui==2 ? 'selected':'' ?>>邀请码</option>
              </select>
            </div>
             <div class="layui-input-inline">
                <input  class="layui-input" style="width: 200px;" id="searchWord" name="searchWord" value="<?php echo $searchWord?>">
             </div>
             <!-- <button class="layui-btn"><i class="layui-icon">&#xe615;</i></button> -->
             
             <input type="submit" name="submit1" value="搜索" class="seach-button-style" >
           </div>
        </form>

        <p class="layui-elem-quote wetr">
          推荐量房数:<?php echo $demand_info['recommend_num'];?>&nbsp;&nbsp;&nbsp;
          
          量房成功数:<?php echo $demand_info['success_room_num']?$demand_info['success_room_num']:0;?>&nbsp;&nbsp;&nbsp;
          好友注册数:<?php echo $demand_info['register_num']?$demand_info['register_num']:0;?>&nbsp;&nbsp;&nbsp;
          签订三方合同数:<?php echo $demand_info['contract_num']?$demand_info['contract_num']:0;?>&nbsp;&nbsp;&nbsp;
          好友成功量房数:<?php echo $demand_info['friend_success_num']?$demand_info['friend_success_num']:0;?>
        </p>
        <p class="layui-elem-quote wefr" style="display:none">
           推荐量房数：<?php echo $total?>
           好友数：<?php echo  $fnum['num']?>人
        </p>
        <div class="layui-form" style="padding-bottom: 50px;">
          <table class="layui-table">
            <colgroup>
              <col width="150">
              <col width="150">
              <col width="200">
              <col width="200">
              <col width="200">
              <col>
            </colgroup>
            <thead>
              <tr>
                <th>编号</th>
                <th>邀请码</th>
                <th class="search1">
                  <select>
                    <option value="0" <?php echo $attribute==0?'selected':'' ?>>属性</option>
                    <option value='1' <?php echo $attribute==1?'selected':'' ?>>社会人士</option>
                    <option value='2' <?php echo $attribute==2?'selected':'' ?>>优装美家</option>
                  </select>
                </th>
                <th>推荐次数</th>
                <th>量房成功数</th>
                <th>签订三方合同数</th>
                <th>好友注册数</th>
                <th>好友成功量房数</th>
                <th>操作</th>
              </tr> 
            </thead>
            <tbody>
              <?if(!empty($res)){?>
                  <?foreach ($res as $k => $r) {?>
                     <tr class="wetr">
                       <td><?php echo $r['mobile']?></td>
                       <td><?php echo $r['icode']?></td>
                       <td><?php if($r['attribute']==1){ echo "社会人士"; }else{ echo "优装美家"; } ?></td>
                       <td><?php echo $r['recommend_num']?></td>
                       <td><?php echo $r['success_room_num']?></td>
                       <td><?php echo $r['contract_num']?></td>
                       <td><?php echo $r['register_num']?></td>
                       <td><?php echo $r['friend_success_num']?></td>
                       <td>
                       <button style="width: 90px;height: 30px;"><a href="?m=award&f=award&v=userinfo&id=<?php echo $r['uid'];?><?php echo $this->su();?>">查看详情</a></button>
                       </td>
                     </tr>
                   <?}?>
                   <?foreach ($icodes as $k => $r) {?>
                     <tr class="wefr" style="display:none">
                       <td>
                           <?php echo $r['orderid']?>
                         <!--   <span class='layui-btn layui-btn-primary layui-btn-mini look' style='float: right;' icode=<?php echo $r['icode']?>>
                              查看
                           </span>  -->
                       </td>
                       <td><?php echo $r['mobile']?></td>
                       <td><?php echo $r['icode']?></td>
                       <td><?php echo $r['addtime']?></td>
                       <td><?php echo $r['orderStatus']?></td>
                     </tr>
                   <?}?>
                <?}?>
            </tbody>
          </table>
          <div class="panel-body">
              <div class="row">
                     <div class="col-lg-12">
                         <div class="pull-right">
                             <ul class="pagination pagination-sm mr0 wetr">
                                 <?php echo $pagess;?>
                             </ul>
                             <ul class="pagination pagination-sm mr0 wefr" style="display:none">
                                  <?php echo $pagess;?> 
                             </ul>
                         </div>
                     </div>
              </div>
          </div>
        </div> 
      </section>
    </div>
</section>
<script>
</script>
<script src="<?php echo R;?>js/hover-dropdown.js"></script>
<script src="<?php echo R;?>js/jquery-ui-1.9.2.min.js" type="text/javascript"></script>
<script src="<?php echo R;?>js/jquery.nicescroll.js"></script>
<script src="<?php echo R;?>js/autocomplete.js"></script>
<script src="<?php echo R;?>js/award/print.js"></script>
<script src="<?php echo R;?>js/award/award.js"></script>
<script src="<?php echo R;?>js/layui/layui.js"></script>
<script type="text/javascript">
  layui.use(['form','element'], function(){});
  layui.use('laydate', function(){
    var laydate = layui.laydate;
  });
  $(document).on('click','.sel-type',function(){
    $(this).find('dd').addClass("option-type");
  });
  $(document).on('mousedown','.option-type',function(){
      var val = $(this).attr('lay-value');
      var url = '?m=award&f=award&v=city_search&_su=wuzhicms&_menuid=5704';
      var data = {'cityid':val};
      $.post(url,data,function(res){
        if(res.status == 1){
              $('.aa').text(res.data.aa)
              $('.bb').text(res.data.bb)
              $('.cc').text(res.data.cc)
              $('.dd').text(res.data.dd)
              $('.ee').text(res.data.ee)
              $('.ff').text(res.data.ff)
              $('.gg').text(res.data.gg)
              $('.hh').text(res.data.hh)
              $('.ii').text(res.data.ii)
              $('.oo').text(res.data.ii)
              $('.pp').text(res.data.ii)
              $('.regist_num_today').text(res.data.today_regist_num);//今日注册数量
              $('.regist_num_month').text(res.data.month_regist_num);//本月注册数量
              $('.regist_num_all').text(res.data.regist_num);//总注册量
          }
        },'JSON');
  })
  $('.xiao').click(function(){
      var time_begin = $(".time-begin").val();
      var time_end = $(".time-end").val();
      if( time_begin && time_end){
        // caozhi add begin
        var cityid = $('.sel-type').find('.layui-this').attr('lay-value');
        // caozhi add end
        var url  = '?m=award&f=award&v=time_search&_su=wuzhicms&_menuid=5704';
        var data = {'time_begin':time_begin,'time_end':time_end};
        if (cityid) {
          data.cityid = cityid;
        };
             $.post(url,data,function(res){
                if(res.status == 1){
                    $('#a').text(res.data.a)
                    $('#b').text(res.data.b)
                    $('#c').text(res.data.c)
                    $('#d').text(res.data.d)
                    $('#search_range_retist_num').text(res.data.register_num);
                }
             },'JSON');
      }
  })
  $('.look').click(function(){
    var icode = $(this).attr('icode');
    var url = '?m=award&f=award&v=icode&_su=wuzhicms&_menuid=5704'
    var data = {'icode':icode}
     $.post(url,data,function(res){
        var tr = '';
        $(res.data).each(function(i,n){
          tr += '<tr>'+
                '<td>'+n.orderid+'</td>'+
                '<td>'+n.mobile+'</td>'+
                '<td>'+n.icode+'</td>'+
                '<td>'+n.addtime+'</td>'+
                '<td>'+n.orderStatus+'</td>'+
                '<td>'+n.status_reason+'</td>'+
                '</tr>';
        });
        if(res.status == 1){
           layer.open({
             type: 1,
             skin: 'layui-layer-rim', //加上边框
             area: ['900px', '600px'], //宽高
             content: '<div class="layui-form" style="padding-bottom: 50px;">'+
                        '<table class="layui-table">'+
                         ' <colgroup>'+
                            '<col width="150">'+
                            '<col width="150">'+
                            '<col width="200">'+
                            '<col width="200">'+
                            '<col width="200">'+
                            '<col width="150">'+
                            '<col>'+
                          '</colgroup>'+
                          '<thead>'+
                            '<tr>'+
                              '<th>编号</th>'+
                              '<th>手机号</th>'+
                              '<th>邀请码</th>'+
                              '<th>推荐时间</th>'+
                              '<th>推荐状态</th>'+
                              '<th>备注</th>'+
                            '</tr> '+
                          '</thead>'+
                          '<tbody>'+
                          tr+
                          '</tbody>'+
                        '</table>'+
                      '</div>'
             });
        }
       
     },'JSON');
  })
  $('.wet').click(function(){
     $('.wetr').show();
     $('.wefr').hide();
  })
  $('.wef').click(function(){
     $('.wetr').hide();
     $('.wefr').show();
  })

  $('.search1').on('mouseover',function(){
     $(this).find('dd').attr('onclick','change_se(this)')
  });
  function change_se(eleObj){
    var attribute = $(eleObj).attr('lay-value');
    console.log(location.href+"&attribute="+attribute+"<?php echo $this->su();?>");
    location.href=location.href+"&attribute="+attribute+"<?php echo $this->su();?>";
  }

  // 
  function vilidate_form(){
    var searchWord = $("#searchWord").val();
    if (searchWord=='') {
      layer.alert('请输入要搜索的手机号');
      return false;
    };
    $("#form2").submit();
  }
</script>
