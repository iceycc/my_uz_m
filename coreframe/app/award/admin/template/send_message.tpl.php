<!DOCTYPE html>
<html lang="en">
<body>
<?php
include $this->template('header','core');
?>
<link href="<?php echo R;?>js/colorpicker/style.css" rel="stylesheet">
<link href="<?php echo R;?>js/jquery-ui/jquery-ui.css" rel="stylesheet">
<script src="<?php echo R;?>js/jquery.js"></script>
<script src="<?php echo R;?>js/jquery-1.8.3.min.js" type="text/javascript"></script>
<script src="<?php echo R;?>js/layer.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo R;?>css/layer.css">
<link rel="stylesheet" type="text/css" href="<?php echo R;?>css/layui.css">
<link rel="stylesheet" href="<?php echo R;?>css/laydate.css">
<link rel="stylesheet" href="<?php echo R;?>css/laydates.css">
<style type="text/css">
  h1 {
    font-weight: 600;
    font-size: 20px;
    color: black;
    margin-bottom: 10px;
  }
  .banner,.draw {
    background-color: #DC940D;
    color: #eee;
    -webkit-border-radius: 5px;
    -moz-border-radius: 5px;
    border-radius: 5px;
  }
  .set {
    margin-left: 10px;
  }
  ul li {
    cursor: move;
  }
  #save-auto-message,#draw {
    background: #3385ff;
    color: #eee;
  }
  .header {
    background-color: #3385ff;
    color: #eee;
    -webkit-border-radius: 5px;
    -moz-border-radius: 5px;
    border-radius: 5px;
  }
  .up {
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
      min-width: 1220px;
      overflow-y: auto;
  }
  .line-div{
    margin-left:30px;
    min-height:70px;
    line-height: 70px;
    border-bottom:1px dotted #ccc;
    width:85%;
  }
  .line-div span{
    display:inline-block;
  }
  .padding-sel{
    padding-right: 28px;
  }
  .padding-span{
    padding-left: 35px;
    /*padding-right: 28px;*/
  }
  .message-content{
    min-width: 535px;
    height:100%;
    line-height: 20px;
  }
  .edit-message,.disable-message,.enable-message{
    margin-left:20px;
    padding:3px 8px;
    border-radius:3px;
    color:white;
    cursor: pointer;
  }
  .edit-message{
    background:#2e8cc6;
  }
  .line-div .edit-message,.disable-message,.enable-message{
    height: 20px;
    line-height: 20px;
  }
  .disable-message{
    background:red;
  }
  .enable-message{
    background: green;
  }
  .head-word{
    font-size: 22px;
    color: black;
    display: block;
    padding-top: 15px;
    padding-left: 10px;
  }
  .message-operate{
    background:#CEEDFF;
    padding: 9px 12px;
    color: #1180C7;
    border-radius: 4px;
    cursor: pointer;
    margin-left: 10px;
    border: 1px solid #98D3F5;
  }
  .phones td{
    text-align: center;
  }
  .message-text{
    height: 100%;
    line-height: 35px;
    width: 100%;
    border: none;
  }
  .checkbox-left{
    float:left;
  }
  .inline-span{
    display: inline-block;
  }
  .checkbox-span{
    width: 10%;
  }
  .no-span{
    width:25%;
  }
  .telephone-span{
    width:60%;
  }
  .send-messages{
    background:#2e8cc6;
    color:white;
    padding:3px 17px;
    border-radius:3px;
    margin-left:230px;
    cursor:pointer;
    height:20px;
    line-height:20px;
  }
  #batch-import-form *{
    display: inline-block;
  }
  #phones-excel{
    width:80px;
    height: 37px;
    top: -8px;
    cursor: pointer;
    position:relative;
    z-index:1;
    opacity:0;
  }
  #upload-flie-name{
    position: absolute;
    line-height: 37px;
    width: 71px;
    height: 37px;
    white-space: nowrap;
    overflow:hidden;
    text-overflow:ellipsis;
    padding-left: 5px;
    color:#1180C7;
  }
  #phone-pages{
    padding: 0px 10px;
  }
  #phone-pages a{
    display: inline-block;
    vertical-align: middle;
    padding: 0 15px;
    height: 28px;
    line-height: 28px;
    margin: 0 -1px 5px 0;
    background-color: #fff;
    color: #333;
    font-size: 12px;
    border: 1px solid #e2e2e2;
  }
  #phone-pages a.active{
    color:white;
    background-color: #009688;
    border:1px solid #009688;
  }
</style>
<section class="wrapper">
  <div class="row">
    <section class="panel" id="panel">
      <div class="set">
        <span class="head-word">自动群发</span>
        <form class="form-horizontal tasi-form" method="post" action="" id="singcms-form">
          <?php $chinese_num = array('一','二','三','四'); ?>
          <?php foreach ($auto_send_message_info as $message_key => $message_info) { ?>
            <div class="line-div">
              <span style="">状态<?php echo $chinese_num[$message_key]; ?> :</span>
              <span style="margin-left:20px;">
                <span class="padding-span"><?php echo $message_info['node_name']; ?></span>
                <!-- <select class="padding-sel">
                  <option value="">注册成功</option>
                </select> -->
              </span>
              <span style="margin-left:<?php echo $message_info['node_name']=='推荐量房成功'?'52px':'80px' ?>;">内容</span>
              <span style="margin-left:20px;" class="message-content">
                <?php echo $message_info['message_content']?str_replace("回复N退订。","",$message_info['message_content']):'请输入短信内容'; ?>
              </span>
              <span class="edit-message" index=<?php echo $message_info['id']; ?>>编辑</span>
              <?php if($message_info['in_use']){ ?>
                <span class="disable-message" index=<?php echo $message_info['id']; ?>>禁用</span>
              <?php }else{ ?>
                <span class="enable-message" index=<?php echo $message_info['id']; ?>>启用</span>
              <?php } ?>
            </div>
          <?php } ?>
          
          <center style="margin-top:30px;">
              <!-- <input name="submit" type="button" class="save-bt btn" id="save-auto-message"  onclick=""  value="保存66" > -->
          </center>
        </form>
        <span class="head-word">人工群发</span>
          
        <div class="line-div" style="padding-top:15px;padding-left:10px;padding-bottom:15px;">
          <span>内容</span>
          <span style="margin-left:20px;" class="message-content">
            <?php echo $manual_send_message_info['message_content']?str_replace("回复N退订。","",$manual_send_message_info['message_content']):'请输入短信内容'; ?>
          </span>
          <span class="edit-message" index=<?php echo $manual_send_message_info['id']; ?>>编辑</span>
          <span class="send-messages">发送短信</span>
        </div>

        <div style="height:40px;margin-top:15px;margin-bottom:15px;relative:absolute;">
          <form action="?m=award&f=award&v=batch_import_phone<?php echo $this->su();?>" method="post" id="batch-import-form" enctype="multipart/form-data">
            <span class="message-operate add-phones" style="margin-right: 50px;">+添加手机号</span>
            <i id="excel-tip-position" style="position:relative;left:70px;top:-28px;"></i>
            <input class="" type="file" id="phones-excel" style="cursor:pointer;" name="phones">
            <span class="message-operate select-file" style="margin-left:0;position:relative;right:86px;">选择文件</span>
            <span class="message-operate batch-import" style="margin-left: 0;">批量导入</span>
            <span class="message-operate delete-phone" style="margin-left: 55px;">删除</span>
            
          </form>
        </div>

        <form class="form-horizontal tasi-form" method="post" action="" id="message-phones">
          <table class="table table-striped table-advance table-hover">
          <tr>
            <th style="background-color: #D4D8DC;text-align: center;">
              <span style="display:block;">
                <span class="inline-span checkbox-span"><input type="checkbox" class="checkbox-left check-all" index="0" name="" id=""></span>
                <span class="inline-span no-span">序号</span>
                <span class="inline-span telephone-span" style="background-color: #D4D8DC;text-align: center;">手机号</span>
              </span>
            </th>
            <th style="background-color: #D4D8DC;text-align: center;">
              <span style="display:block;">
                <span class="inline-span checkbox-span"><input type="checkbox" class="checkbox-left check-all" index="1" name="" id=""></span>
                <span class="inline-span no-span">序号</span>
                <span class="inline-span telephone-span" style="background-color: #D4D8DC;text-align: center;">手机号</span>
              </span>
            </th>
            <th style="background-color: #D4D8DC;text-align: center;">
              <span style="display:block;">
                <span class="inline-span checkbox-span"><input type="checkbox" class="checkbox-left check-all" index="2" name="" id=""></span>
                <span class="inline-span no-span">序号</span>
                <span class="inline-span telephone-span" style="background-color: #D4D8DC;text-align: center;">手机号</span>
              </span>
            </th>
            <th style="background-color: #D4D8DC;text-align: center;">
              <span style="display:block;">
                <span class="inline-span checkbox-span"><input type="checkbox" class="checkbox-left check-all" index="3" name="" id=""></span>
                <span class="inline-span no-span">序号</span>
                <span class="inline-span telephone-span" style="background-color: #D4D8DC;text-align: center;">手机号</span>
              </span>
            </th>
          <tr>
          <tbody class="phones-table">
            <!-- Excel表格中不合法的手机个数 -->
            <input type="hidden" id="unlegal_phone_count" value="<?php echo $unlegal_phone_count?$unlegal_phone_count:0; ?>">
            <!-- Excel表格中重复的手机个数 -->
            <input type="hidden" id="repeated_phone_count" value="<?php echo $repeated_phone_count?$repeated_phone_count:0; ?>">
            <?php echo $tr_str; ?>
            <!-- <tr class="phones-line">
              <td style="padding:8px;" class="cell-td">
                <span style="display:block;">
                  <span class="inline-span checkbox-span"><input type="checkbox" class="checkbox-left check-tel" index="0" name="" id=""></span>
                  <span class="inline-span no-span" style="text-align:center;">1</span>
                  <span class="inline-span telephone-span send-message-phone" style="text-align: center;">15931128908</span>
                </span>
              </td>
              <td style="padding:8px;" class="cell-td">
                <span style="display:block;">
                  <span class="inline-span checkbox-span"><input type="checkbox" class="checkbox-left check-tel" index="1" name="" id=""></span>
                  <span class="inline-span no-span" style="text-align:center;">2</span>
                  <span class="inline-span telephone-span send-message-phone" style="text-align: center;">15931128908</span>
                </span>
              </td>
              <td style="padding:8px;" class="cell-td">
                <span style="display:block;">
                  <span class="inline-span checkbox-span"><input type="checkbox" class="checkbox-left check-tel" index="2" name="" id=""></span>
                  <span class="inline-span no-span" style="text-align:center;">3</span>
                  <span class="inline-span telephone-span send-message-phone" style="text-align: center;">15931128908</span>
                </span>
              </td>
              <td style="padding:8px;" class="cell-td">
                <span style="display:block;">
                  <span class="inline-span checkbox-span"><input type="checkbox" class="checkbox-left check-tel" index="3" name="" id=""></span>
                  <span class="inline-span no-span" style="text-align:center;">4</span>
                  <span class="inline-span telephone-span send-message-phone" style="text-align: center;">15931128908</span>
                </span>
              </td>
            </tr>
            <tr class="phones-line">
              <td style="padding:8px;" class="cell-td">
                <span style="display:block;">
                  <span class="inline-span checkbox-span"><input type="checkbox" class="checkbox-left check-tel" index="0" name="" id=""></span>
                  <span class="inline-span no-span" style="text-align:center;">1</span>
                  <span class="inline-span telephone-span send-message-phone" style="text-align: center;">15931128908</span>
                </span>
              </td>
            </tr> -->
          <tbody>
          </table>
          <!-- <center>
            <input name="submit" type="submit" class="save-bt btn" id="draw"  onclick=""  value="保存" >
          </center> -->
        </form>
      </div>
      <?php 
        if($pages){
          echo "{$pages}";
        }
       ?>
      <!-- <div id="phone-pages"><div class="layui-box layui-laypage layui-laypage-default"><a href="javascript:;">上一页</a><a href="javascript:;" class="active">1</a><a href="javascript:;">2</a><a href="javascript:;">3</a><a href="javascript:;">4</a><a href="javascript:;" class="layui-laypage-next">下一页</a></div></div> -->
    </section>
  </div>
</section>
<script src="<?php echo R;?>js/html5upload/extension.js"></script>
<script src='<?php echo R;?>/js/laydate.js?<?php echo VERHASH; ?>'></script>
<script src="<?php echo R;?>js/jquery.nicescroll.js" type="text/javascript"></script>
<script src="<?php echo R;?>js/award/award.js"></script>
<script src="<?php echo R;?>js/jquery-ui-1.9.2.min.js" type="text/javascript"></script>
<script type="text/javascript">
  $(document).ready(function(){
    // 不合法的手机个数
    var unlegalPhoneCount = parseInt($('#unlegal_phone_count').val());
    // 重复手机个数
    var repeatedPhoneCount = parseInt($('#repeated_phone_count').val());
    var tipMessage = '';
    if(unlegalPhoneCount){
      tipMessage = 'Excel表格中有'+unlegalPhoneCount+'个不合法的手机号.<br>';
    }
    if(repeatedPhoneCount){
      if(!unlegalPhoneCount){
        tipMessage += 'Excel表中有';
      }
      tipMessage += repeatedPhoneCount+'个重复的手机号.';
    }
    if(unlegalPhoneCount||repeatedPhoneCount){
      tipMessage += '它们将被忽略.';
      layer.alert(tipMessage);
    }
  });
  // 点击编辑按钮
  $('.edit-message').click(function(){
    var messageEle = $(this).prev('.message-content');//获取包含短信文本的对象
    var message = $.trim(messageEle.text());//获取短信文本
    if(message=='请输入短信内容'){
      message = '';
    }
    //将短信文本放入textarea中
    var index = $(this).attr('index');
    messageEle.html('<textarea index="'+index+'" class="message-text"></textarea>');
    messageEle.find('.message-text').focus().val(message);
  });
  // 保存短信内容
  $(document).on('blur','.message-text',function(){
    var index = $(this).attr('index');//id
    var messageText = $(this).val();//获取短信文本
    if(messageText==''){
      messageText = '请输入短信内容';
    }else{//保存短信内容
      saveMessage(index,messageText);
    }
    var messageContent = $(this).closest('.message-content');//获取textarea的父级容器
    //将短信文本放入容器中
    messageContent.text(messageText);
    messageContent.css('width',messageContent.width()+'px');
  });
  function saveMessage(id,content){
    $.ajax({
      url:'?m=award&f=award&v=edit_message_content<?php echo $this->su();?>',
      data:{'id':id,'content':content},
      type:'post',
      dataType:'json',
      success:function(data){

      }
    })
  }
  $('#save-auto-message').click(function(){
    layer.msg('保存成功', {icon: 1});
  });

  // 点击禁用按钮
  $(document).on('click','.disable-message',function(){
    var $this = $(this);
    layer.confirm('确定要禁用该条信息?', {
      btn: ['确定','取消'] //按钮
    }, function(){//确定
      changeMessageState(0,$this.attr('index'),$this);//改变短信的启用/禁用状态
      layer.msg('禁用成功', {icon: 1});
    }, function(){//取消

    });
  });
  // 点击启用按钮
  $(document).on('click','.enable-message',function(){
    changeMessageState(1,$(this).attr('index'),$(this));//改变短信的启用/禁用状态
    layer.msg('启用成功', {icon: 1});
  });
  //改变短信的启用/禁用状态
  function changeMessageState(state,index,currentEle){
    $.ajax({
      url:'?m=award&f=award&v=change_message_satate<?php echo $this->su();?>',
      data:{'id':index,'state':state},
      type:'post',
      dataType:'json',
      success:function(data){
        if(state==0){
          currentEle.addClass('enable-message').removeClass('disable-message').text('启用');
        }else{
          currentEle.addClass('disable-message').removeClass('enable-message').text('禁用');
        }
      }
    })
  }

  // 点击提交手机号按钮
  $('.add-phones').click(function(){
    // 获取最后一行
    var lastTrLine = $('.phones-line:last');
    // 获取最后一行的最后一个td的索引
    var lastTdIndex = lastTrLine.find('.cell-td:last').index();
    // 获取要添加的HTML字符串
    var newEleIndex = getStr(lastTdIndex==3?-1:lastTdIndex);
    if(lastTdIndex==3){//已成一行
      lastTrLine.after(newEleIndex);
    }else if(lastTdIndex==-1){//列表为空
      $('.phones-table').append(newEleIndex);
    }else{//未成一行
      lastTrLine.append(newEleIndex);
    }
    focusPhoneTxt();
  });
  function focusPhoneTxt(){//手机号码文本框聚焦、选中
    $('.cell-td').find('.new-phone-text').focus().select();
  }
  function getStr(lastTdIndex){
    var str = '';
    var num = $(".cell-td").length+1;
    var tdIndex = lastTdIndex+1;
    str = '<td style="padding:8px;" class="cell-td">'+
            '<span style="display:block;">'+
              '<span class="inline-span checkbox-span"><input type="checkbox" class="checkbox-left check-tel" index='+tdIndex+' name="" id=""></span>'+
              '<span class="inline-span no-span" style="text-align:center;">'+num+'</span>'+
              '<span class="inline-span telephone-span send-message-phone" style="text-align: center;">'+
                '<input type="text" class="new-phone-text" value="" style="text-align: center;">'+
              '</span>'+
            '</span>'+
          '</td>';
    if(lastTdIndex==3||lastTdIndex==-1){
      str = '<tr class="phones-line">'+str+'</tr>';
    }
    return str;
  }
  var regPhone = /^1\d{10}$/;
  $(document).on('blur','.new-phone-text',function(){
    var phone = $(this).val();
    if(phone==''){
      $(this).closest('td').remove();
      layer.msg('未填写任何内容,已被删除.', {icon: 0});
      return false;
    }
    if(!regPhone.test(phone)){
      focusPhoneTxt();
      layer.msg('手机号码不正确', {icon: 0});
    }
  }).on('keyup','.new-phone-text',function(){
    var phoneNum = $(this).val();
    var phoneLength = phoneNum.length;
    if (phoneLength==11) {
      if(regPhone.test(phoneNum)){
        $(this).closest('span.telephone-span').text(phoneNum);
      }else{
        focusPhoneTxt();
        layer.msg('手机号码不正确', {icon: 0});
      }
    }
  });

  // 点击全选按钮时
  $('.check-all').click(function(){
    var thisAttrIndex = $(this).attr('index');
    $(this).toggleClass('checked');
    if($(this).hasClass('checked')){
      $('.check-tel:visible[index='+thisAttrIndex+']').prop('checked','true').addClass('checked');
    }else{
      $('.check-tel:visible[index='+thisAttrIndex+']').removeProp('checked').removeClass('checked');
    }
  });

  // 点击checkbox时执行的事件
  $('.cell-td').on('click','.check-tel',function(){
    $(this).toggleClass('checked');
    var td_index = $(this).closest('td').index();//父级td的索引数
    var tr_row_num = $(this).closest('tr').attr('row');
    var check_all_checked = true;
    $('.phones-line[row='+tr_row_num+']').each(function(i,n){
      if(!$(this).find('td').eq(td_index).find('.check-tel').hasClass('checked')){
        check_all_checked = false;
      }
    });
    if(check_all_checked){
      $('.check-all').eq(td_index).prop('checked','true').addClass('checked');
    }else{
      $('.check-all').eq(td_index).removeProp('checked').removeClass('checked');
    }
  });

  // 点击删除按钮执行的事件
  $('.delete-phone').click(function(){
    // 获取选中的长度
    var deleteCount = $('.check-tel:checked').length;
    if(!deleteCount){
      layer.msg('你还没有选中要删除的手机号.', {icon: 0});
      return false;
    }
    layer.confirm('确定要删除选中的手机号?', {
      btn: ['确定','取消'] //按钮
    }, function(){
      $('.check-tel:checked').closest('td').remove();
      // 开始构造表格
      var row = 1;
      var trStr = '<tr row="'+row+'" class="phones-line">';
      var currentPhoneLength = $('.cell-td').length;
      var rowNum = 0;
      $('.cell-td').each(function(i,n){
        var telIndex = i%4;
        // 编号
        var telNo = i+1;
        // 手机号
        var tel = $(this).find('.telephone-span').text();
        // 删除完成后重新拼接表格
        trStr += '<td style="padding:8px;" class="cell-td">'+
                    '<span style="display:block;">'+
                      '<span class="inline-span checkbox-span"><input type="checkbox" class="checkbox-left check-tel" index="'+telIndex+'" name="" id=""></span>'+
                      '<span class="inline-span no-span" style="text-align:center;">'+telNo+'</span>'+
                      '<span class="inline-span telephone-span send-message-phone" style="text-align: center;">'+tel+'</span>'+
                    '</span>'+
                  '</td>'
        if((i+1)%4==0){
          rowNum = Math.floor(row/10)+1;
          row++;
          if(rowNum>1){
            var show_tr = 'style="display:none;"';
          }else{
            var show_tr = '';
          }
          trStr += '</tr><tr row="'+rowNum+'" class="phones-line" '+show_tr+'>';
        }
      });
      trStr += '</tr>';

      if(rowNum>1){
        var pages = '<div id="phone-pages"><div class=""><a href="javascript:;" class="page-num layui-laypage-prev">上一页</a>';
        for (var i=1; i <= rowNum; i++) { 
          var a_class = i==1?'active':'';
          pages += '<a href="javascript:;" class="page-num '+a_class+'">'+i+'</a>';
        }
        pages += '<a href="javascript:;" class="page-num layui-laypage-next">下一页</a></div></div>';
        $('#phone-pages').replaceWith(pages)
      }else{
        $('#phone-pages').remove();
      }
      // 将拼完的表格展示出来
      $('.phones-table').empty().html(trStr);
      // 将已选中的checkbox的checked属性移除
      $('.checked').removeProp('checked').removeClass('checked');
      layer.msg('删除成功', {icon: 1});
    }, function(){

    });
  });

  // 点击发送短信按钮
  $('.send-messages').click(function(){
    if(!$(".cell-td").length){
      layer.msg('还没有手机号', {icon: 0});
      return false;
    }
    layer.confirm('请确认群发内容及名单！', {
      btn: ['确认发送','返回查看'] //按钮
    }, function(){//确认发送
      // 手机号码
      var phones = '';
      // 校验手机号码的正则
      // var regPhone = /^1\d{10}$/;
      // 不合格的手机号个数
      var errorNum = 0;
      // 获取手机号
      $('.phones-line:visible').each(function(){
        $(this).find('.send-message-phone').each(function(){
          var phone = $.trim($(this).text());
          if(regPhone.test(phone)){//手机格式合格
            phones += phone+',';
          }else{//手机格式不合格
            $(this).css('color','red');
            errorNum++;
          }
        });
      });
      if (errorNum) {//如果有不合格的手机号
        layer.confirm('存在格式不正确的手机号,不合格的手机号将被忽略', {
          btn: ['确定','取消'] //按钮
        }, function(){
          // 手动移除背景阴影、对话框
          $('.layui-layer-shade,.layui-layer-dialog').remove();
          // 调用发送短信的方法
          sendMessages(phones);
        }, function(){
          
        });
      }else{
        // 调用发送短信的方法
        sendMessages(phones);
      }
    }, function(){//返回查看
      
    });
  });
  function sendMessages(phones){//发送短信
    $.ajax({
      url:'?m=award&f=award&v=send_messages<?php echo $this->su();?>',
      data:{'phones':phones},
      type:'post',
      dataType:'json',
      success:function(data){
        if(data.code=='00'){
          layer.msg(data.message, {icon: 1});
        }else{
          layer.msg(data.message, {icon: 0});
        }
      }
    });
  }

  // 批量导入
  $('.batch-import').click(function(){
    // 获取要上传的文件
    var phoneExcel = $("#phones-excel").val();
    if (!phoneExcel) {
      layer.tips('点击上传Excel表格', '#excel-tip-position');
      return false;
    };

    /*处理已经添加的手机号*/
    // 获取已经存在的手机号码
    var existPhoneLength = $('.cell-td').length;
    if(existPhoneLength){
      var existPhones = '';
      $('.cell-td').each(function(i,n){
        existPhones += $.trim($(this).find('.send-message-phone').text())+',';
      });
    }
    $('#exist-phones').remove();
    if(!existPhones){
      existPhones = '';
    }
    $('#batch-import-form').append('<input type="hidden" id="exist-phones" name="phones" value="'+existPhones+'" >');
    $("#batch-import-form").submit();
  });


  $('#phones-excel').on('change',function(){
    var fileName = getFileName($(this).val());
    $('#upload-flie-name').remove();
    $('#phones-excel').after('<span id="upload-flie-name" title="'+fileName+'">'+fileName+'</span>');
  });
  function getFileName(filePath){
    if (filePath.indexOf('\\')!=-1) {
      return filePath.substr(filePath.lastIndexOf('\\')+1);
    }else{
      return filePath;
    }
  }

  // 分页
  $('#panel').on('click','.page-num',function(){console.log('aaa')
    var pageNum = $.trim($(this).text());
    if($.isNumeric(pageNum)){//如果是数字
      if($(this).hasClass('active')){
        return false;
      }
      removeCheckProp();// 将所有的复选框去掉checked属性
      $(this).addClass('active').siblings().removeClass('active');
      $('.phones-line').each(function(i,n){
        if($(this).attr('row')==pageNum){
          $(this).show();
        }else{
          $(this).hide();
        }
      });
    }else{
      var activePage = $.trim($('#phone-pages a.active').text());
      if(pageNum=='上一页'){
        if(activePage==1){
          layer.msg('已经是第一页了', {icon: 0});
          return false;
        }
        removeCheckProp();// 将所有的复选框去掉checked属性
        $('.phones-line').each(function(i,n){
          if($(this).attr('row')==activePage){
            $(this).hide();
          }
          if($(this).attr('row')==parseInt(activePage)-1){
            $(this).show();
          }
        });
        $('#phone-pages a.active').removeClass('active').prev('a').addClass('active');
        var activePage = $.trim($('#phone-pages a.active').text());
      }else if(pageNum=='下一页'){
        var lastPageNum = $('#phone-pages a').length-2;
        if(activePage==lastPageNum){
          layer.msg('已经是最后一页了', {icon: 0});
          return false;
        }
        removeCheckProp();// 将所有的复选框去掉checked属性
        $('.phones-line').each(function(i,n){
          if($(this).attr('row')==activePage){
            $(this).hide();
          }
          if($(this).attr('row')==parseInt(activePage)+1){
            $(this).show();
          }
        });
        $('#phone-pages a.active').removeClass('active').next('a').addClass('active');
        var activePage = $.trim($('#phone-pages a.active').text());
      }
    }
    $(document).scrollTop(1000);
  });
  function removeCheckProp(){
    // 将所有的复选框去掉checked属性
    $('.check-tel,.check-all').removeProp('checked').removeClass('checked');
  }
</script>
</body>
</html>