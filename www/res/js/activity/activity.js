 /**
 * 编辑
 */
$('.wuzhi-edit').on('click',function(){
    var id = $(this).attr('attr-id');
    var url = SCOPE.set_edit_url+'&id='+id;
    window.location.href = url;
}); 
/**
 * 
 *删除/状态修改
 */
$('.wuzhi-delete,.wuzhi-status').on('click',function(){
  var id = $(this).attr('attr-id');
  var status = $(this).attr('attr-status');
	var message = $(this).attr('attr-message');
    url = SCOPE.set_status_url;
    data = {'status':status,'id':id,'message':message};
    	layer.open({
        	type : 0,
        	title : '是否提交！',
        	btn : ['yes','no'],
        	icon : 3,
        	closeBtn:2,
        	content:'是否确认'+message,
        	scrollbar:true,
        	yes:function(){
        	   todelete(url,data);
        	}
        })
    return false;
});
function todelete(url,data){
	 $.post(url,data,function(s){
       if(s.status == 1){
           return dialog.success(s.message,'');
       }
       if(s.status == 0){
       	   return dialog.error(s.message);
       }
	  },'json');
}
$('#normal').hide();
$('.H5').on('click',function(){
    $('#H5').show();
    $('#normal').hide();
    $(this).addClass('active').removeClass('normalsty');
    $('.normal').addClass('normalsty').removeClass('active');
});
$('.normal').on('click',function(){
    $('#H5').hide();
    $('#normal').show();
    $('.shows').hide();
    $(this).addClass('active').removeClass('normalsty');
    $('.H5').addClass('normalsty').removeClass('active');
});
$('#add').click(function(){
   layer.open({
    type: 1,
    skin: 'layui-layer-rim', 
    area: ['420px', '240px'], 
    content: '<button type="button" style="height: 100px;width: 100px;padding: 0px;top: 27px;left: 45px;" class="btn btn-white layui-layer-close layui-layer-close1" onclick="openiframe(\'/index.php?m=attachment&amp;f=index&amp;v=upload_dialog&amp;callback=callback_pic&amp;htmlid=activity&amp;limit=20&amp;width=1&amp;htmlname=form%5Bactivity%5D&amp;ext=jpg%7Cpng%7Cgif%7Cbmp&amp;token=34f98e4c74f75c6701341b703f09917b&amp;_menuid=5002\',\'activity\',\'loading...\',810,400,20)">图片</button><button type="button" style="height: 100px;width: 100px;padding: 0px;top: 27px;left: 256px;" class="btn btn-white layui-layer-close layui-layer-close1" onclick="openiframe(\'/index.php?m=attachment&amp;f=index&amp;v=upload_dialog&amp;callback=callbacks_vim&amp;htmlid=activity&amp;limit=20&amp;width=1&amp;htmlname=form%5Bactivity%5D&amp;ext=jpg%7Cpng%7Cgif%7Cbmp&amp;token=34f98e4c74f75c6701341b703f09917b&amp;_menuid=5002\',\'activity\',\'loading...\',810,400,20)">视频</button>'
  });
});
function moveup(eleObj){
  var positionLi = $(eleObj).closest('li');
  var currentSpan = positionLi.find('span.liNum');
  var prevSpan = positionLi.prev('li').find('span.liNum');
  if(positionLi.prev().is('li')){
    var currentNum = currentSpan.text();
    var prevNum = prevSpan.text();
    currentSpan.text(prevNum);
    currentSpan.next(".ids").val(prevNum);
    prevSpan.text(currentNum);
    prevSpan.next(".ids").val(currentNum);
    if(positionLi.hasClass("shuffling")){
      
      // positionLi.find('input.shufinput').val('shuffling'+prevNum);
      // positionLi.find('tr[gaibian=lasttr]').attr('class','xiao[shuffling'+prevNum+']');
      // positionLi.find('tr[gaibian=lasttr]').find("[gaibian=trhidediv]").attr("class","shuffling"+prevNum);
      // positionLi.find('tr[gaibian=change]').each(function(){
      //   $(this).attr('class','xiao[shuffling'+prevNum+']');
      //   $(this).find('.imgname').attr('name','xiao[shuffling'+prevNum+'][shufflingpic][]');
      //   $(this).find('.urlname').attr('name','xiao[shuffling'+prevNum+'][shufflingurl][]');
      // });
    }

    if(positionLi.prev('li').hasClass('shuffling')){
      var shuf_type = positionLi.find('input.shufinput').val()
      positionLi.find('input.shufinput').val(shuf_type);
      if (shuf_type=='shuffling') {
        positionLi.find('input.shufinput').val(shuf_type+currentNum);
        positionLi.find('tr[gaibian=lasttr]').attr('class','xiao[shuffling'+currentNum+']');
        positionLi.find('tr[gaibian=lasttr]').find("[gaibian=trhidediv]").attr("class","shuffling"+currentNum);
        positionLi.prev('li').find('tr[gaibian=change]').each(function(){
        $(this).find('input.shufinput').val('shuffling'+currentNum);
        $(this).find('.imgname').attr('name','xiao[shuffling'+currentNum+'][shufflingpic][]');
        $(this).find('.urlname').attr('name','xiao[shuffling'+currentNum+'][shufflingurl][]');
      });
      }
      
      
    }

    var newLi = positionLi.clone();
    positionLi.prev('li').before(newLi);
    positionLi.remove();
  }else{
  }
}
function movedown(eleObj){
  var positionLi = $(eleObj).closest('li');
  var currentSpan = positionLi.find('span.liNum');
  var nextSpan = positionLi.next('li').find('span.liNum');
  if(positionLi.next().is('li')){
    var currentNum = currentSpan.text();
    var nexNum = nextSpan.text();
    currentSpan.text(nexNum);
    currentSpan.next(".ids").val(nexNum);
    nextSpan.text(currentNum);
    nextSpan.next(".ids").val(currentNum);

    // if(positionLi.hasClass("shuffling")){
    //   positionLi.find('input.shufinput').val('shuffling'+nexNum);
    //   positionLi.find('tr[gaibian=lasttr]').attr('class','xiao[shuffling'+nexNum+']');
    //   positionLi.find('tr[gaibian=lasttr]').find("[gaibian=trhidediv]").attr("class","shuffling"+nexNum);
    //   positionLi.find('tr[gaibian=change]').each(function(){
    //     $(this).attr('class','xiao[shuffling'+nexNum+']');
    //     $(this).find('.imgname').attr('name','xiao[shuffling'+nexNum+'][shufflingpic][]');
    //     $(this).find('.urlname').attr('name','xiao[shuffling'+nexNum+'][shufflingurl][]');
    //   });
    // }

    if(positionLi.next('li').hasClass('shuffling')){
      var shuf_type = positionLi.next('li').find('input.shufinput').val()
      positionLi.next('li').find('input.shufinput').val(shuf_type);
      if (shuf_type=='shuffling') {
        positionLi.next('li').find('input.shufinput').val(shuf_type+currentNum);
        positionLi.find('tr[gaibian=lasttr]').attr('class','xiao[shuffling'+currentNum+']');
        positionLi.find('tr[gaibian=lasttr]').find("[gaibian=trhidediv]").attr("class","shuffling"+currentNum);
        positionLi.next('li').find('tr[gaibian=change]').each(function(){
          $(this).find('input.shufinput').val('shuffling'+currentNum);
          $(this).find('.imgname').attr('name','xiao[shuffling'+currentNum+'][shufflingpic][]');
          $(this).find('.urlname').attr('name','xiao[shuffling'+currentNum+'][shufflingurl][]');
        });
      }
      
    }

    var newLi = positionLi.clone();
    positionLi.next('li').after(newLi);
    positionLi.remove();
  }else{
  }
}
$('.headline').click(function(){
   $(".headlineh").animate({ height: 'show', opacity: 'show' }, 'slow');
});
$('.isheadline').click(function(){
    $(".headlineh").animate({ height: 'hide', opacity: 'hide' }, 'slow');
});
$('.applyboxShow').click(function(){
    $(".applybox").animate({ height: 'show', opacity: 'show' }, 'slow');
});
$('.applyboxHide').click(function(){
    $(".applybox").animate({ height: 'hide', opacity: 'hide' }, 'slow');
});
$(document).on('click','.shows',function(){
  if($(this).hasClass("checked")){
    $(this).removeClass("checked");
    $(this).prev(".picshow").val(0);
  }else{
    $(this).addClass("checked");
    $(this).prev(".picshow").val(1);
  }
});
$(document).on('click','.out',function(){
  if($(this).hasClass("checked")){
    $(this).removeClass("checked");
    $(this).prev(".picout").val(0);
  }else{
    $(this).addClass("checked");
    $(this).prev(".picout").val(1);
  }
});
$(document).on('click','.vshows',function(){
  if($(this).hasClass("checked")){
    $(this).removeClass("checked");
    $(this).prev(".vimshow").val(0);
  }else{
    $(this).addClass("checked");
    $(this).prev(".vimshow").val(1);
  }
});
$(document).on('click','.vout',function(){
  if($(this).hasClass("checked")){
    $(this).removeClass("checked");
    $(this).prev(".vimout").val(0);
  }else{
    $(this).addClass("checked");
    $(this).prev(".vimout").val(1);
  }
});
$(document).on('click','.edit_copy',function(){
  $(".activeLi").removeClass("activeLi");
  $(this).addClass("activeLi");
  if (!$(this).prev(':checkbox').hasClass('checked')) {
     dialog.error('还有选择是否显示报名按钮');
     return false;
  }
  var parentLi = $('.activeLi').closest('li');
  var locations = parentLi.find(".location").val();
  var copys = parentLi.find('.copy').val();
  var colors = parentLi.find('.color').val();
  var copycolors = parentLi.find('.copycolor').val();
  if(locations==1){
    var isChecked = '<input class="locations" name="a" type="radio" value="1" checked/>上'+
              '<input class="locations" name="a" type="radio" value="2"/>下';
  }else if(locations==2){
    var isChecked = '<input class="locations" name="a" type="radio" value="1"/>上'+
              '<input class="locations" name="a" type="radio" value="2" checked/>下';
  }else{
    var isChecked = '<input class="locations" name="a" type="radio" value="1" checked/>上'+
              '<input class="locations" name="a" type="radio" value="2"/>下';
  }
  layer.open({
      type: 1,
      skin: 'layui-layer-rim', 
      area: ['320px', '340px'], 
      content: ' <center><span style="top: 10px;position: relative;">报名按钮</span></center><br/>'+
         '<div class="layui-form-label">'+
          '<label class="labelf" style="margin-left:10px;">报名位置</label>'+
            '<span style="margin-top: 10px;margin-left: 10px;">'+
              isChecked+
            '</span>'+
        '</div>'+
          '<div class="layui-form-label share">'+
            '<label class="labelr" style="margin-left:10px;margin-top:10px;">报名按钮背景文案</label>'+
            '<input type="text" class="input copys" style="margin-top:10px; "placeholder="" vlverify() value="'+copys+'" ></span>'+
          '</div>'+
          '<div class="layui-form-label share">'+
            '<label class="labelr" style="margin-left:10px;margin-top:10px;">报名按钮背景颜色</label>'+
            '<input type="text" class="input colors" style="margin-top:10px; "placeholder="" vlverify() value="'+colors+'" ></span>'+
          '</div>'+
          '<div class="layui-form-label share">'+
            '<label class="labelr" style="margin-left:10px;margin-top:10px;">报名按钮文案颜色</label>'+
            '<input type="text" class="input copycolors" style="margin-top:10px; "placeholder="" vlverify() value="'+copycolors+'" ></span>'+
          '</div>'+
          ' <input type="button" class="save-bt btn btn-info " style="position: absolute;bottom: 10px;left: 79px;" onclick="saveVal()" value="保存" >'
    });
});
$(document).on('click','.jump',function(){
  var $this = $(this);
        layer.open({
            content : '是否选择跳转',
            icon:3,
            btn : ['是','否'],
            yes : function(){
                $('.layui-layer-dialog,.layui-layer-shade').remove();
                if($this.prop("checked")){
                  $this.next("input").show().val('');
                  $this.closest("td").prev().prev().find("input[type='text']").hide().val('');
                }else{
                  $this.next("input").hide().val('无');
                  $this.closest("td").prev().prev().find("input[type='text']").show();
                }
            },
        });
  
});
function saveVal(){
  var locations = $('.locations:checked').val();
  var copys = $('.copys').val();
  var colors = $('.colors').val();
  var copycolors = $('.copycolors').val();
  if(!copys || !colors || !copycolors){
    dialog.error('有空数据--请完善后在保存！');
    return false
  }
  $(".activeLi").closest("li").find('.location').val(locations);
  $(".activeLi").closest("li").find('.copy').val(copys);
  $(".activeLi").closest("li").find('.color').val(colors);
  $(".activeLi").closest("li").find('.copycolor').val(copycolors);
  $(".activeLi").closest("li").find('.issave').val(1);
  $(".layui-layer-shade,.layui-layer-rim").remove();
}
$('#wz-button-submit,#wz-button-submit-b').on('click',function(){
   var activityname = $("#activityname").val();
   var activitynameLe=$('#activityname').val().length
   var name = $("#name").val();
   var nameLe=$('#name').val().length
   var share =$('#share').val();
   var sharename =$('#sharename').val();
   var sharenameLe=$('#sharename').val().length
   var content =$('#content').val();
   var contentLe=$('#content').val().length
   var color =$('#color').val();
   var copycolor =$('#copycolor').val();
   var copy =  $('input[name="copy"]').val();
   if(!activityname){
      tips('活动列表名称不能为空','activityname');
      $(document).scrollTop(0);
      return false;
   }
   if(activitynameLe>15){
      tips('不能大于15个字符','activityname');
      $(document).scrollTop(0);
      return false;
   }
    if(!name &&$ ("#name").is(":visible")){
          tips('标题栏名称不能为空', 'name');
          $(document).scrollTop(0);
          return false;
       }
       if(nameLe>8 &$ ("#name").is(":visible")){
          tips('不能大于8个字符','name');
          $(document).scrollTop(0);
          return false;
      }
     if(!copy){
        tips('报名按钮背景文案','copy');
        $(document).scrollTop(0);
        return false;
     }
     if(!color){
        tips('报名按钮背景文案','color');
        $(document).scrollTop(0);
        return false;
     }
     if(!copycolor){
        tips('报名按钮背景文案','copycolor');
        $(document).scrollTop(0);
        return false;
     }
     if(!share){
        tips('分享图标不能为空','share');
        $(document).scrollTop(0);
        return false;
     }
     if(!sharename){
        tips('分享标题不能为空','sharename');
        $(document).scrollTop(0);
        return false;
     }
     if(sharenameLe>24){
        tips('不能大于24个字符','sharename');
        $(document).scrollTop(0);
        return false;
     }
     if(!content){
        tips('分享描述不能为空','content');
        $(document).scrollTop(0);
        return false;
     }
     if(contentLe>34){
        tips('不能大于34个字符','content');
        $(document).scrollTop(0);
        return false;
     }
    $("#normal").remove();
})
function tips(arr,id){
   layer.tips(arr,'#'+id, {
      tips: 2
   });
}
$('#add_normal').click(function(){
   layer.open({
    type: 1,
    skin: 'layui-layer-rim', 
    area: ['420px', '440px'], 
    content: '<button type="button" style="height: 100px;width: 100px;padding: 0px;top: 27px;left: 45px;" class="btn btn-white layui-layer-close layui-layer-close1" onclick="openiframe(\'/index.php?m=attachment&amp;f=index&amp;v=upload_dialog&amp;callback=callback_pic1&amp;htmlid=activity_normal&amp;limit=20&amp;width=1&amp;htmlname=form%5Bactivity_normal%5D&amp;ext=jpg%7Cpng%7Cgif%7Cbmp&amp;token=34f98e4c74f75c6701341b703f09917b&amp;_menuid=5002\',\'activity_normal\',\'loading...\',810,400,20)">图片</button><button type="button" style="height: 100px;width: 100px;padding: 0px;top: 27px;left: 256px;" class="btn btn-white layui-layer-close layui-layer-close1" onclick="openiframe(\'/index.php?m=attachment&amp;f=index&amp;v=upload_dialog&amp;callback=callbacks_vim1&amp;htmlid=activity_normal&amp;limit=20&amp;width=1&amp;htmlname=form%5Bactivity_normal%5D&amp;ext=jpg%7Cpng%7Cgif%7Cbmp&amp;token=34f98e4c74f75c6701341b703f09917b&amp;_menuid=5002\',\'activity_normal\',\'loading...\',810,400,20)">视频</button><button type="button" style="height: 100px;width: 100px;padding: 0px;top:200px;left: 45px;" class="btn btn-white layui-layer-close layui-layer-close1" onclick="openiframe(\'/index.php?m=attachment&amp;f=index&amp;v=upload_dialog&amp;callback=callback_shuffling&amp;htmlid=activity_normal&amp;limit=20&amp;width=1&amp;htmlname=form%5Bactivity_normal%5D&amp;ext=jpg%7Cpng%7Cgif%7Cbmp&amp;token=34f98e4c74f75c6701341b703f09917b&amp;_menuid=5002\',\'activity_normal\',\'loading...\',810,400,20)">轮播</button><button type="button" style="height: 100px;width: 100px;padding: 0px;top:200px;left:256px;" class="btn btn-white layui-layer-close layui-layer-close1" onclick="openiframe(\'/index.php?m=attachment&amp;f=index&amp;v=upload_dialog&amp;callback=callback_bidding&amp;htmlid=activity_normal&amp;limit=20&amp;width=1&amp;htmlname=form%5Bactivity_normal%5D&amp;ext=jpg%7Cpng%7Cgif%7Cbmp&amp;token=34f98e4c74f75c6701341b703f09917b&amp;_menuid=5002\',\'activity_normal\',\'loading...\',810,400,20)">发标</button>'
  });
});
function goAdd(licount){
     layer.open({
      type: 1,
      skin: 'layui-layer-rim', 
      area: ['210px', '240px'], 
      content: '<button type="button" style="height: 100px;width: 100px;padding: 0px;top: 27px;left: 45px;" class="btn btn-white layui-layer-close layui-layer-close1" onclick="openIframe(\'/index.php?m=attachment&amp;f=index&amp;v=upload_dialog&amp;callback=callback_shufflings&amp;htmlid='+licount+'&amp;limit=20&amp;width=1&amp;htmlname=xiao%5B'+licount+'%5D&amp;ext=jpg%7Cpng%7Cgif%7Cbmp&amp;token=34f98e4c74f75c6701341b703f09917b&amp;_menuid=5002\',\''+licount+'\',\'loading...\',810,400,20)">轮播</button>'
    });
}
$('#wz-button-submit-normal,#wz-button-submit-normal-b').click(function(){
    var activityname = $("#activityname_n").val();
    var activitynameLe=$('#activityname_n').val().length
    var name_n = $("#name_n").val();
    var nameLe = $("#name_n").val().length;
    var share =$('#share_n').val();
    var sharename =$('#sharename_n').val();
    var sharenameLe = $("#sharename_n").val().length;
    var content =$('#content_n').val();
    var contentLe = $("#content_n").val().length;
    if(!activityname){
          tips('活动列表名称不能为空','activityname_n');
          $(document).scrollTop(0);
          return false;
    }
    if(activitynameLe>15){
      tips('不能大于15个字符','activityname_n');
      $(document).scrollTop(0);
      return false;
    }
      if(!name_n && $("#name_n").is(":visible")){
         tips('标题栏名称不能为空', 'name_n');
         $(document).scrollTop(0);
        return false;
      }
      if(nameLe>8 && $("#name_n").is(":visible")){
         tips('不能大于8个字符', 'name_n');
         $(document).scrollTop(0);
        return false;
      }
  
    if(!share){
      tips('分享图标不能为空','share_n');
      $(document).scrollTop(0);
      return false;
    }
    if(!sharename){
      tips('分享标题不能为空','sharename_n');
      $(document).scrollTop(0);
      return false;
    }
    if(sharenameLe>24){
      tips('不能大于24个字符','sharename_n');
      $(document).scrollTop(0);
      return false;
    }
    if(!content){
      tips('分享描述不能为空','content_n');
      $(document).scrollTop(0);
      return false;
    }
    if(contentLe>34){
      tips('不能大于34个字符','content_n');
      $(document).scrollTop(0);
      return false;
    }
    $("#H5").remove();
})
function lingsde(eleObj){
    $(eleObj).closest('tr').remove();
}
$(document).on('click','.deleteLi',function(){
  var positionLi = $(this).closest('li');
  if(positionLi.next().is('li')){
    positionLi.nextAll('li').each(function(i,n){
      var currentIndex = parseInt($(this).find(".liNum").text());
      $(this).find(".liNum").text(currentIndex-1);
      $(this).find(".ids").val(currentIndex-1);
    });
  }
  positionLi.remove();
});
  $(function(){ 
    var iftitle = $('#headlineType').val();
    var iftitle_n = $('#headlineType_n').val();
    var applybox = $('#applyboxTyle').val();
    var applybox_n = $('#applyboxTyle_n').val();
    if(iftitle==2 || iftitle_n==2){
     $(".headlineh").hide();
    }
    if(applybox==2 || applybox_n==2){
     $(".applybox").hide();
    }
  })//页面加载的事件


$('.default').click(function(){
    var url = '/api/newhd.php?action=dredge';
        var data = {'status':1};
        var select = ''; 
      $.ajax({
            url:url,
            data:data,
            type:'POST',
            dataType:'json',
            success:function(res){
              $(res.arr).each(function(i,n){
               select += '<option value='+n.lid+' class="aa">'+n.name+'</option>';
               });
            },
            async:false
      });
    layer.open({
       type: 1,
       title:'城市选择',
       skin: 'layui-layer-rim', 
       area: ['420px', '240px'], 
         content:  '<center><select class="select" name = "select"><option value=""> 请选择 </option>'+select+'</select></center>'
        });
  })
  $(document).on('change','.select',function(){
    var name = $(this).find("option:selected").text();
    var lid = $(this).val();
        $('.defaults').text(name);
        $('.default').val(lid);
        $('.layui-layer-rim,.layui-layer-shade').remove();
      
  })
