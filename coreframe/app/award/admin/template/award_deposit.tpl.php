<?php defined('IN_WZ') or exit('No direct script access allowed');?>
<?php
include $this->template('header','core');
?>
<body class="body">
<style type="text/css">
   body{
        overflow-y: scroll;
        overflow-x: scroll;
    }
    ::-webkit-scrollbar {
        width:10px;
    }
    ::-webkit-scrollbar-track {
        -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.3); 
        -webkit-border-radius: 10px;
        border-radius: 10px;
    }
    ::-webkit-scrollbar-thumb {
        -webkit-border-radius: 10px;
        border-radius: 10px;
        -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.5); 
    }
    ::-webkit-scrollbar-thumb:window-inactive {
        background: rgba(255,0,0,0.4); 
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
  .active{
     background-color: green;
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
  .x{
    background-color:#09D0F1;
  }
  .y{
     background-color:#3DC53D;
  }
  .n{
   background-color: red;
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
  .wrapper{
    min-width: 1220px;
    overflow-y: auto;
 }
</style>
<script src="<?php echo R;?>js/layer.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo R;?>css/layer.css">
<link rel="stylesheet" type="text/css" href="<?php echo R;?>css/autocomplete.css">
<section class="wrapper">
    <div class="row">
            <section class="panel">
                <header class="panel-heading">
                </header>
                     <form action="?m=award&f=award&v=deposit<?php echo $this->su();?>" class="form-inline"  method="post">
                    <input type="hidden" value="<? echo $GLOBALS['status']; ?>" id="button_index">
                      <input type="text" name="title" placeholder="仅支持手机号搜索" class="titles" style="height:35px; width:200px; " value="<?php echo $GLOBALS['title']?>" id='txtSearch'>
                      <button type="submit" class="btn adsr-btn">搜索</button>
                    </form>
                    <div class="but">
                        <button type="submit" btnindex="9" class="btn adsr-btn " onclick="filtration(9)">全部申请(<?php echo $dai_num+$yes_num+$no_num; ?>)</button>
                        <button type="submit" btnindex="0" class="btn adsr-btn" onclick="filtration(0)">待审核(<?php echo $dai_num; ?>)</button>
                        <button type="submit" btnindex="1" class="btn adsr-btn" onclick="filtration(1)">审核通过(<?php echo $yes_num; ?>)</button>
                        <button type="submit" btnindex="2" class="btn adsr-btn" onclick="filtration(2)">审核未通过(<?php echo $no_num; ?>)</button>
                        <button type="submit" btnindex="2" class="btn adsr-btn" onclick="exportorder()">导出</button>
                    </div>
                    <div class="panel-body" id="panel-bodys">
                       <table class="table table-striped table-advance table-hover">
                           <thead>
                             <tr>
                                 <th style="background-color: #D4D8DC;font-size: 17px;"><input type="checkbox" id="select_all"></th>
                                 <th style="background-color: #D4D8DC;font-size: 17px;">序号</th>
                                 <th style="background-color: #D4D8DC;font-size: 17px;padding:0;">邀请码</th>
                                 <th class="search1" style="background-color: #D4D8DC;font-size: 17px;padding:0;">
                                     <select name="attribute" id="attribute">
                                         <option value="0"<?php echo $attribute==0?'selected':'' ?>>属性</option>
                                         <option value="1"<?php echo $attribute==1?'selected':'' ?>>社会人士</option>
                                         <option value="2"<?php echo $attribute==2?'selected':'' ?>>优装美家</option>
                                     </select>
                                 </th>
                                 <th style="background-color: #D4D8DC;font-size: 17px;padding:0;padding-left:10px;">用户姓名</th>
                                 <th style="background-color: #D4D8DC;font-size: 17px;padding: 0;padding-left: 10px;">电话</th>
                                 <th style="background-color: #D4D8DC;font-size: 17px;padding:0;">提现金额</th>
                                 <th style="background-color: #D4D8DC;font-size: 17px;padding: 0;padding-left: 13px;">申请时间</th>
                                 <th style="background-color: #D4D8DC;font-size: 17px;">状态</th>
                                 <th style="background-color: #D4D8DC;font-size: 17px;">审核人</th>
                                 <th style="background-color: #D4D8DC;font-size: 17px;">银行</th>
                                 <th style="background-color: #D4D8DC;font-size: 17px;">支行</th>
                                 <th style="background-color: #D4D8DC;font-size: 17px;">管理操作</th>
                                 <th style="background-color: #D4D8DC;font-size: 17px;">备注</th>
                             </tr>
                           </thead>
                           <tbody>
                               <?php foreach ($res as $key => $va) {?>
                                 <tr>
                                   <td style="height:35px"><input type="checkbox" name="applyid[]" value="<?php echo $va['stream_no']?>"></td>
                                   <td style="height:35px"><?php echo $va['stream_no']?></td>
                                   <td style="height:35px;padding:5px 10px;"><?php echo $va['icode']?></td>
                                   <td style="height:35px;padding:5px 10px;"><?php echo $va['attribute']; ?></td>
                                   <td style="height:35px;"><?php echo $va['username']; ?></td>
                                   <td style="height:35px;padding: 0;padding-left: 10px;"><?php echo $va['mobile']?></td>
                                   <td style="height:35px;padding:0;padding-left:15px;"><?php echo $va['money']?></td>
                                   <td style="height:35px;padding: 0;padding-left: 14px;"><?php echo date('Y-m-d H:i :s',$va['addtime'])?></td>
                                   <td style="height:35px" class="status"><?php echo $va['status']?></td>
                                   <td style="height:35px" class="operator"><?php echo $va['operator'];?></td>
                                   <td style="height:35px"><?php echo $va['bank_name'];?></td>
                                   <td style="height:35px"><?php echo $va['branch'];?></td>
                                   <td style="height:35px;padding:5px 0px;">
                                       <span class="check x" uid="<?php echo $va['uid']?>">详情</span>
                                       <span class="check <?php echo $va['nocheck']?> y" onclick='check_y(<?php echo $va['id']?>,this)'>审核通过</span>
                                       <span class="check <?php echo $va['nocheck']?> n"  onclick='check_n(<?php echo $va['id']?>,this)'>审核未通过</span>
                                   </td style="height:35px">
                                   <td style="height:35px;padding:0;" class="remark"><?php echo $va['pay_reason']?></td>
                                 </tr>
                               <?}?>
                           </tbody>
                       </table>
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
<script src="<?php echo R;?>js/jquery-ui-1.9.2.min.js" type="text/javascript"></script>
<script src="<?php echo R;?>js/hover-dropdown.js"></script>
<script src="<?php echo R;?>js/jquery.nicescroll.js"></script>
<script src="<?php echo R;?>js/autocomplete.js"></script>
<script src="<?php echo R;?>js/award/award.js"></script>
<script src="<?php echo R;?>js/activity/pc_activity.js"></script>
<script type="text/javascript">

    //构造提交表单
    function exportorder()
    {
        var action = '?m=award&f=award&v=export_csv&_su=wuzhicms';
        var form = $('<form style="display: none"></form>');
        var allcheckbox = $('input[name="applyid[]"]');
        var checkbox = new Array();

        allcheckbox.each(function(i,e){
            if($(e).prop('checked')){
                checkbox.push(e.cloneNode(true));

            }
        })
        if(checkbox.length == 0){
            layer.alert('还没有选择导出信息',{icon: 2});
            return false;
        }
        form.attr('action', action);
        form.attr('method', 'post');

        $(checkbox).each(function(i,e){
            $(e).prop('checked',true);
            form.append(e);
        })

        $(document.body).append(form);
        form.submit();
//        location.href = location.href;
        layer.msg('导出成功');
        return false;
    }

  function check_y(id,eleObj){
    layer.open({
        content : '你已选择<span style="color:#2EE1E2">审核通过</span>，请确认操作正确，确认后申请将会提交给财务并且无法更改',
        icon:3,
        btn : ['确认提交','重新选择'],
        yes : function(){
            $('.layer-anim,.layui-layer-shade').remove();
            var data = {'id':id};
            $.post('?m=award&f=award&v=deposit_status<?php echo $this->su();?>',data,function(r){
                if(r.status ==1){
                  layer.msg('审核成功！', {icon: 1});
                  $(eleObj).closest('tr').find('.operator').text(r.data.operator);
                  $(eleObj).closest('tr').find('.status').text(r.data.status);
                  $(eleObj).closest('tr').find('.y,.n').css('background-color','#8F948F').removeAttr('onclick');
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
      content: '<div class="ti"><span>你已选择<span style="color:red">审核未通过</span>，请确认操作正确并填写未通过原因</span></div><div class="tin"><input type="text" style="width:240px;height: 36px;" name="remark"/><hr><span class="no layui-layer-close1">重新选择</span><span class="no" onclick="commit('+id+')">确认提交</span></div>'
    });
  }
  function commit(id){
   var remark = $('input[name="remark"]').val();
    if(!remark){
      layer.msg('备注还没有填写');
      return false;
   }

   var data = {'id':id,'remark':remark};
    $.post('?m=award&f=award&v=deposit_status_no<?php echo $this->su();?>',data,function(r){
        if(r.status ==1){
          layer.msg('审核成功！', {icon: 1});
          $('.check_no').find('.operator').text(r.data.operator);
          $('.check_no').find('.status').text(r.data.status);
          $('.check_no').find('.remark').text(r.data.remark);
          $('.check_no').find('.y,.n').css('background-color','#8F948F').removeAttr('onclick');
           setTimeout(no,1000);
        }
    },'json');
  }
  function filtration(sta){
     window.location.href = '?m=award&f=award&v=deposit&status='+sta+'<?php echo $this->su();?>'
  }
  $('.x').click(function(){
     var uid = $(this).attr('uid');
     window.location.href = '?m=award&f=award&v=details&uid='+uid+'<?php echo $this->su();?>'
  })

  $("select[name=attribute]").change(function(){
    var stat = $(this).val();
    location.href=location.href+"&attribute="+stat+"<?php echo $this->su();?>";
  })

  $('#select_all').click(function(){
      $('input:checkbox').prop('checked',this.checked);
  })
</script>