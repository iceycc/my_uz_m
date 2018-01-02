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
      .form-inline,.but{
          margin-left: 20px;
       }
       .but,.table{
          margin-top: 10px;
       }
       .btn{
         background-color: #3F9EF1;
         color: #eee;
       }
       .adsr-btn:hover{
         background-color: green;
        }
       .check{
        border: 1px solid;
        width: 20px;
        padding: 5px;
        color: #eee;
        -webkit-border-radius: 5px;
        -moz-border-radius: 5px;
        border-radius:5px;
        cursor: pointer;
      }
      .y{
         background-color:#3DC53D;
      }
      .n{
        background-color:red;
      }
      .nocheck{
         background-color: #8F948F;
      }
      .ti{
         font-size: 16px;
         width: 255px;
         margin-left: 30px;
      }
      .tin{
        margin-top: 10px;
        margin-left: 30px;
      }
      .no{
        width: 30px;
        border: 1px solid;
        padding: 7px;
        cursor: pointer;
      }
      .active{
           background-color: green;
      }
      .print{
        margin-left: 299px;
        margin-top: -52px;
      }
      .layui-layer-title{
        text-align: center;
      }
      .printm{
          display: inline-block;
          height: 38px;
          line-height: 38px;
          padding: 0 18px;
          background-color: #00962B;
          color: #fff;
          white-space: nowrap;
          text-align: center;
          font-size: 14px;
          border: none;
          border-radius: 2px;
          cursor: pointer;
          opacity: .9;
          -webkit-border-radius: 5px;
          -moz-border-radius: 5px;
          border-radius:5px;
          cursor: pointer;
          margin-left:10px; 
      }
      .wrapper{
        min-width: 1820px;
        overflow-y: auto;
      }
      .layui-table td, .layui-table th{
        padding:9px 5px;
      }
</style>
<script src="<?php echo R;?>js/layer.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo R;?>css/layer.css">
<link rel="stylesheet" type="text/css" href="<?php echo R;?>css/autocomplete.css">
<section class="wrapper">
    <div class="row">
            <section class="panel">
                    <form action="?m=award&f=award&v=finance<?php echo $this->su();?>" class="form-inline"  method="post">
                         <input type="hidden" value="<? echo $GLOBALS['status']; ?>" id="button_index">
                          <input type="text" name="title" placeholder="仅支持手机号搜索" class="titles" style="height:35px; width:200px; " value="<?php echo $GLOBALS['title']?>" id='txtSearch'>
                          <button type="submit" class="btn adsr-btn">搜索</button>
                    </form>
                    <div class="but" style="width: 480px;">
                        <button type="submit" btnindex="9" class="btn adsr-btn " onclick="filtration(9)">全部申请(<?php echo $processed+$untreated; ?>)</button>
                        <button type="submit" btnindex="1" class="btn adsr-btn" onclick="filtration(1)">已处理(<?php echo $processed; ?>)</button>
                        <button type="submit" btnindex="0" class="btn adsr-btn" onclick="filtration(0)">未处理(<?php echo $untreated; ?>)</button>
                     <form action="" class=""  id="form6" method="post">

                        <button type="submit" btnindex="" class="btn adsr-btn print" >打印</button>
                     </form>
                    </div>
                    <div class="layui-form">
                        <table class="layui-table">
                          <colgroup>
                            <col width="50">
                            <col width="50">
                            <col width="50">
                            <col width="100">
                            <col width="100">
                            <col width="150">
                            <col width="150">
                            <col width="150">
                            <col width="200">
                            <col width="230">
                            <col width="150">
                            <col width="150">
                            <col width="150">
                            <col width="150">
                            <col width="410">
                            <col width="150">
                            <col>
                          </colgroup>
                          <thead>
                            <tr>
                              <th><input type="checkbox" name="" lay-skin="primary" lay-filter="allChoose"></th>
                              <th style="padding: 9px 5px;">序号</th>
                              <th style="padding:0px;text-align:center;">姓名</th>
                              <th class="search" style="padding:0px;text-align:center;">
                                  <select name="attribute">
                                      <option value="0"<?php echo $attribute==0?'selected':'' ?>>属性</option>
                                      <option value="1"<?php echo $attribute==1?'selected':'' ?>>社会人士</option>
                                      <option value="2"<?php echo $attribute==2?'selected':'' ?>>优装美家</option>
                                  </select>
                              </th>
                              <th style="padding:0;">提现金额</th>
                              <th style="padding: 9px 5px;">电话</th>
                              <th>身份证号</th>
                              <th>银行卡号</th>
                              <th>开户行</th>
                              <th style="width:1px;">支行</th>
                              <th>申请时间</th>
                              <th>状态</th>
                              <th>审核人员</th>
                              <th>财务人员</th>
                              <th>打款时间</th>
                              <th style="width:375px;">操作管理</th>
                              <th style="width:330px;">备注</th>
                            </tr> 
                          </thead>
                          <tbody>
                           <?php foreach ($res as $key => $va) {?>
                            <tr>
                              <td><input type="checkbox" class="checked" name="checkbox" value="<?php echo $va['id']?>" lay-skin="primary"></td>
                              <td style="padding: 9px 5px;"><?php echo $va['stream_no']?></td>
                              <td style="padding:0px;"><span style="width:55px;display:block;text-align:center;"><?php echo $va['username']?></span></td>
                              <td style="padding:0px;"><span style="width:100px;display:block;text-align:center;"><?php echo $va['attribute']?></span></td>
                              <td style="padding:0;"><?php echo $va['money']?></td>
                              <td style="padding: 9px 5px;min-width:0;"><?php echo $va['mobile']?></td>
                              <td><?php echo $va['id_number']?></td>
                              <td><?php echo $va['bank_number'] ?></td>
                              <td><?php echo $va['bank_name'] ?></td>
                              <td style="width:1px;padding:0;"><?php echo $va['branch'] ?></td>
                              <td><?php echo date('Y-m-d H:i:s',$va['addtime'])?></td>
                              <td><?php echo $va['money_status'] ?></td>
                              <td><?php echo $va['operator'] ?></td>
                              <td class="payer"><?php echo $va['payer'] ?></td>
                              <td><?php if($va['paytime']){ echo date('Y-m-d h:i:s',$va['paytime']); }else{ echo "暂无"; }?></td>
                              <td>
                                  <?php if($va['attribute']=='社会人士') {?>
                                <span class="check <?php echo $va['nocheck']?> y" <?if($va['money_status_num'] == 0){?>onclick='check_y(<?php echo $va['id']?>,<?php echo $va['uid']?>,<?php echo $va['money']?>,this)'<?}?>>已打款</span>
                                 <span class="check <?php echo $va['nocheck']?> n"<?if($va['money_status_num'] == 0){?> onclick='check_n(<?php echo $va['id']?>,this)'<?}?>>打款失败</span>
                                 <?php }else{ ?>
                                      <span class="check <?php echo $va['nocheck']?> y" <?if($va['money_status_num'] == 0){?>onclick='check_y_uz(<?php echo $va['id']?>,<?php echo $va['uid']?>,<?php echo $va['money']?>,this)'<?}?>>纳入工资</span>
                                      <span class="check <?php echo $va['nocheck']?> n"<?if($va['money_status_num'] == 0){?> onclick='check_n(<?php echo $va['id']?>,this)'<?}?>>打款失败</span>
                                  <?php } ?>
                              </td>
                              <td><?php  echo $va['pay_reason']?></td>
                            </tr>
                            <?}?>
                          </tbody>
                        </table>
                    </div>
                </form>
                        <div class="panel-body">
                           <div class="row">
                               <div class="col-lg-12">
                                   <div class="pull-right">
                                       <ul class="pagination pagination-sm mr0">
                                           <?php echo $pages;?>
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
layui.use('form', function(){
  var $ = layui.jquery, form = layui.form();
  //全选
  form.on('checkbox(allChoose)', function(data){
    var child = $(data.elem).parents('table').find('tbody input[type="checkbox"]');
    child.each(function(index, item){
      item.checked = data.elem.checked;
    });
    form.render('checkbox');
  });
  
});
  function check_y(id,uid,money,eleObj){
    layer.open({
        content : '你已选择<span style="color:#2EE1E2">已打款</span>，请确认操作正确，确认后申请将无法更改',
        icon:3,
        btn : ['确认提交','重新选择'],
        yes : function(){
            $('.layer-anim,.layui-layer-shade').remove();
            var data = {'id':id,'uid':uid,'money':money};
            $.post('?m=award&f=award&v=get_money_status<?php echo $this->su();?>',data,function(r){
                console.log(r)
                if(r.status ==1){
                  layer.msg('审核成功！', {icon: 1});
                  $(eleObj).closest('tr').find('.payer').text(r.data.payer);
                  $(eleObj).closest('tr').find('.status').text(r.data.status);
                  $(eleObj).closest('tr').find('.y,.n').css('background-color','#8F948F').removeAttr('onclick');
                }
            },'json');
        },
    });
  }
function check_y_uz(id,uid,money,eleObj){
    layer.open({
        content : '你已选择<span style="color:#2EE1E2">已打款</span>，请确认操作正确，确认后申请将无法更改<br />奖励金已纳入该员工' +
        '<select name="month" id="month">' +
        '<option value="0">月份</option>' +
        '<option value="1">1月份</option>' +
        '<option value="2">2月份</option>' +
        '<option value="3">3月份</option>' +
        '<option value="4">4月份</option>' +
        '<option value="5">5月份</option>' +
        '<option value="6">6月份</option>' +
        '<option value="7">7月份</option>' +
        '<option value="8">8月份</option>' +
        '<option value="9">9月份</option>' +
        '<option value="10">10月份</option>' +
        '<option value="11">11月份</option>' +
        '<option value="12">12月份</option>' +
        '</select>'+
        '工资中',
        icon:3,
        btn : ['确认提交','重新选择'],
        yes : function(index,layero){
            $('.layer-anim,.layui-layer-shade').remove();
            var month = $(layero).find('#month').val();
            var data = {'id':id,'uid':uid,'money':money,'remark':'奖励金已纳入该员工'+month+'月份工资中'};
            if(month==0){
                layer.alert('请选择月份',{icon: 2});
                return false;
            }
            $.post('?m=award&f=award&v=get_money_status<?php echo $this->su();?>',data,function(r){
                if(r.status ==1){
                            layer.msg('审核成功！', {icon: 1});
                            $(eleObj).closest('tr').find('.payer').text(r.data.payer);
                            $(eleObj).closest('tr').find('.status').text(r.data.status);
                            $(eleObj).closest('tr').find('.y,.n').css('background-color','#8F948F').removeAttr('onclick');
                            setTimeout(no,1000);
                }
            },'json');
        },
    });
}
  function check_n(id,eleObj){
      $(".check_no").removeClass("check_no");
      $(eleObj).closest('tr').addClass("check_no");
       layer.open({
        type: 1,
        skin: 'layui-layer-rim', //加上边框
        area: ['320px', '220px'], //宽高
        content: '<div class="ti"><span>你已选择<span style="color:red">审核未通过</span>，请确认操作正确并填写未通过原因</span></div><div class="tin"><input type="text" style="width:240px;height: 36px;" name="remark"/><hr><span class="no" onclick="no()">重新选择</span><span class="no" onclick="commit('+id+')">确认提交</span></div>'
      });
  }
  function commit(id){
   var remark = $('input[name="remark"]').val();
   if(!remark){
      layer.msg('备注还没有填写');
      return false;
   }
   var data = {'id':id,'remark':remark};
    $.post('?m=award&f=award&v=get_money_status_no<?php echo $this->su();?>',data,function(r){
        if(r.status ==1){
          layer.msg('审核成功！', {icon: 1});
          $('.check_no').find('.payer').text(r.data.payer);
          $('.check_no').find('.status').text(r.data.status);
          $('.check_no').find('.remark').text(r.data.remark);
          $('.check_no').find('.y,.n').css('background-color','#8F948F').removeAttr('onclick');
           setTimeout(no,1000);
        }
    },'json');
  }
  function filtration(sta){
     window.location.href = '?m=award&f=award&v=finance&status='+sta+'&_su=wuzhicms&_menuid=5571'
  }
  $(":checkbox").click(function(){
    $(this).toggleClass("checked")
  })
  $('.print').click(function(){
    if(!$('.layui-form-checked').length){
     layer.alert('还没有选择打印信息', {icon: 2,skin: 'layer-ext-moon' })
      return false;
       }else{
        var ids = [];
        var index = 0;
        $("input[name=checkbox]:checked").each(function() {
            ids.push($(this).val());
      })
        // $("tbody .checked").each(function(){
        //     ids.push($(this).val());
        // }); 
        var data = {'ids':ids};
        $.post('?m=award&f=award&v=prints<?php echo $this->su();?>',data,function(r){
               if(r.status == 1){
                  var prints = '';
                  $(r.data).each(function(i,n){
                    prints += '<tr class="print_manage">'+
                                 '<td>'+n.stream_no+'</td>'+
                                 '<td>'+n.name+'</td>'+
                                 '<td>'+n.attribute+'</td>'+
                                 '<td>'+n.id_number+'</td>'+
                                 '<td>'+n.bank_number+'</td>'+
                                 '<td>'+n.bank+'</td>'+
                                 '<td>'+n.money+'</td>'+
                                 '<td>'+n.operator+'</td>'+
                                 '<td>'+n.pay_reason+'</td>'+
                                 '<td>'+n.pay_time+'</td>'+
                              '</tr>';
                  });
                  console.log(prints);
                  layer.open({
                      type: 1,
                      title:'确认打印信息是否正确',
                      skin: 'layui-layer-rim', 
                      area: ['1400px', '540px'],
                      content: '<table class="table table-striped table-advance table-hover">'+
                                 '<tr>'+
                                   '<th>编号</th>'+
                                   '<th>姓名</th>'+
                                   '<th>属性</th>'+
                                   '<th>身份证号</th>'+
                                   '<th>银行账号</th>'+
                                   '<th>开户行 支行</th>'+
                                   '<th>提现金额</th>'+
                                   '<th>审核人</th>'+
                                   '<th>财务人员</th>'+
                                   '<th>审核日期</th>'+
                                 '</tr>'+prints+
                               '</table>'+
                               '<center><span class="printm" onclick="no()">取消打印</span><span class="printm" onclick="prn1_preview()">确认打印</span></center>'
                      });
               }  
        },'json');
        return false;
     }
  })
  $('.search').on('mouseover',function(){
  $(this).find('dd').attr('onclick','change_se(this)')
  });
  function change_se(eleObj){
    var attribute = $(eleObj).attr('lay-value');
    location.href="?m=award&f=award&v=finance&attribute="+attribute+"<?php echo $this->su();?>";
  }
</script>