<?php defined('IN_WZ') or exit('No direct script access allowed');?>
<?php
include $this->template('header','core');
?>
<body class="body">
<style type="text/css">
  .user,.message {
  margin-left: 10px;
}

.message {
  background: rgba(242, 242, 242, 1);
}

h1 {
  color: black;
}

td {
  font-size: 15px;
}

.extract {
  margin-top: 30px;
}

.user_extract {
  font-size: 20px;
  border: 1px solid;
  padding: 10px;
  background-color: #cccccc;
  font-weight: 700;
  color: #fff;
  -webkit-border-radius: 5px;
  -moz-border-radius: 5px;
  border-radius: 5px;
  cursor: pointer;
}


.total {
  margin-top: 20px;
  font-size: 15px;
}

.total label {
  color: red;
  margin: 0 10px 0 10px;
}

.check {
  border: 1px solid;
  width: 20px;
  padding: 5px;
  color: #eee;
  -webkit-border-radius: 5px;
  -moz-border-radius: 5px;
  border-radius: 5px;
  cursor: pointer;
}

.active {
    background: #0AA00E;
}


.n {
  background-color: red;
}

.y {
  background-color: #3DC53D;
}

.x {
  background-color: #09D0F1;
}

.nocheck {
  background-color: #8F948F;
}

.ti {
  font-size: 16px;
  width: 255px;
  margin-left: 30px;
}

.tin {
  margin-top: 10px;
  margin-left: 30px;
}

.no {
  width: 30px;
  border: 1px solid;
  padding: 7px;
  cursor: pointer;
}

body{
  overflow-y: scroll;
  overflow-x: scroll;
}

::-webkit-scrollbar {
  width: 10px;
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
.wrapper{
    min-width: 1620px;
    overflow-y: auto;
}
</style>
<script src="<?php echo R;?>js/layer.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo R;?>css/layer.css">
<link rel="stylesheet" type="text/css" href="<?php echo R;?>css/autocomplete.css">
<section class="wrapper">
    <div class="row">
            <section class="panel">
              <div class="user">
                  <div class="message">
                     <table style="width:95%;margin-left:30px; ">
                          <tr>
                            <th><h1>用户信息</h1></th>
                          </tr>
                          <tr>
                            <td>昵称:<?php echo $arr['nickname']?></td>
                            <td style="text-align: right">TA的推荐：</td>
                            <td>推荐次数:<?php echo $arr['room_num']?></td>
                              <td style="text-align: right">TA的好友：</td>
                              <td>好友推荐数:<?php echo $arr['friend_room_num']?></td>
                          </tr>

                          <tr>
                            <td>邀请码：<?php echo $arr['icode']?></td>
                              <td></td>
                            <td>量房成功数：<?php echo $arr['success_room_num']?></td>
                              <td></td>
                            <td rowspan="2" style="text-algn:left;">
                                好友成功量房数：<?php echo $arr['friend_success_num']?><br>
                              <!-- <div style="padding-left: 95px;position: relative;top: -16px;">
                                <?foreach ($arr['bank_manage'] as $key => $manage) {?>
                                   <p style="margin-bottom:0;"><? echo $manage;?></p>
                               <? }?> -->
                              </div>
                            </td>
                          </tr>
                          <tr>
                            <td>手机号：<?php echo $arr['mobile']?></td>
                              <td></td>
                            <td>好友注册数：<?php echo  $arr['register_num']?></td>
                          </tr>
                          <tr>
                            <td></td>
                            <td></td>
                            <td>
                                签订三方合同数：<?php echo $arr['contract_num'];?>
                            </td>
                          </tr>
                     </table>
                  </div>
                  <div class="extract">
                     <span class="user_extract <?php if($status==2){?>active<?php } ?>" onclick="filtration(2,<?=$uid?>)">TA的推荐</span>
                     <span class="user_extract <?php if($status==3){?>active<?php } ?>" onclick="filtration(3,<?=$uid?>)">TA的好友</span>
                  </div><br/>
                  <? include $this->template('userinfo_template');?>
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
<script type="text/javascript">
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
      content: '<div class="ti"><span>你已选择<span style="color:red">审核未通过</span>，请确认操作正确并填写未通过原因</span></div><div class="tin"><input type="text" style="width:240px;height: 36px;" name="remark"/><hr><span class="no" onclick="no()">重新选择</span><span class="no" onclick="commit('+id+')">确认提交</span></div>'
    });
  }
  function commit(id){
    var remark = $('input[name="remark"]').val();
    if(!remark){
      layer.msg('备注还没有填写');
      return false;
   }
   var remark = $('input[name="remark"]').val();
   var data = {'id':id,'remark':remark};
    $.post('?m=award&f=award&v=deposit_status_no<?php echo $this->su();?>',data,function(r){
        if(r.status ==1){
          layer.msg('审核成功！', {icon: 1});
          $('.check_no').find('.operator').text(r.data.operator);
          $('.check_no').find('.status').text(r.data.status);
          $('.check_no').find('.remark').text(r.data.remark);
          $('.check_no').find('.y,.n').css('background-color','#8F948F').removeAttr('onclick');
          no();
        }
    },'json');
  }
  function filtration(sta,uid){
     window.location.href = '?m=award&f=award&v=userinfo&status='+sta+'&id='+uid+'<?php echo $this->su();?>'
  }
  $('.x').click(function(){
     var uid = $(this).attr('uid');
     window.location.href = '?m=award&f=award&v=userinfo&status=2&id='+uid+'<?php echo $this->su();?>'
  })
</script>