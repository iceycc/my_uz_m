$('.isdredge_city').click(function(){
	$("#city").animate({ height: 'hide', opacity: 'hide' }, 'slow');
});
$('.dredge_city').click(function(){
    var exercise_city = $('.exercise_city').val()
    if(parseInt(exercise_city) == 1){
         $(":checkbox").prop("checked",true);
    }
	  $("#city").animate({ height: 'show', opacity: 'show' }, 'slow');
});
function del(id){
    if(id.toString().indexOf("a")>0){
        id = id.toString().substring(0,id.toString().length-1);
    }
	$('#'+id).css('background','#FB6C6C').slideUp(500,function(){
		 layer.msg('删除成功');
         $('#'+id).remove();
    });
    dela(id);
}
function dela(id){
    id = id+'a';
    $('#'+id).css('background','#FB6C6C').slideUp(500,function(){
        layer.msg('删除成功');
        $('#'+id).remove();
    })
}
$(document).on('click','.layui-layer-close1',function(){
     $(".layui-layer-shade,.layui-layer").remove();
})
 $(function () {
  $(".title").each(function(){
     var status = $(this).attr('citys-status');
     if(parseInt(status) == 1){
       $(this).text('北京市,天津市,深圳市');
     }
  });
 })

$(".title").mouseover(function(){
     var citys = $(this).text();
     var id = $(this).attr('id');
     var status = $(this).attr('citys-status');
     var count = $(this).attr('citys-count');
     if(parseInt(status) == 1){
        citys = '全国';
     }
     if(parseInt(count)>3 || parseInt(status) == 1){
       layer.tips(citys, '#'+id, {
      	  tips: [2, '#CCCC33'],
      	  time: 4000
      	});
     }
});
var isDelete = true;
$(document).on('mouseover','.forbid',function(){
  isDelete = false;
});
$(document).on('mouseout','.forbid',function(){
  isDelete = true;
});
 $(function () {
    
        $("ul").sortable({
            delay:2,
            opacity:0.35,
        })
        $(document).on('dblclick','li',function(){
          if(!isDelete)return false;
          var $this = $(this);
            layer.open({
                content : '确认删除么！',
                icon:3,
                btn : ['是','否'],
                yes : function(){
                   $('.layer-anim,.layui-layer-shade').remove();
                    $this.css('background','#FB6C6C').slideUp(500,function(){
                     $this.remove();
                      setTimeout(sort,2);       
                    })
                },
            });
        })
    });
$(document).on('mouseup','#content li',function(){
        setTimeout(sort,2);
});
function sort(){
  $("#pic_ul>li").each(function(i,n){
     $(this).find('.liNum').text(i+1);
     $(this).find('.ids').val(i+1);
  });
} 
$('#wz-button-submit').click(function(){
  var xiao = '';
  var exercise_title = $("#exercise_title").val();
  var exercise_titlel = $("#exercise_title").val().length;
  var exercise_remarks = $("#exercise_remarks").val().length;
	var exercise_id = $("#exercise_id").val();
	var start_time = $("#start_time").val();
	var end_time = $("#end_time").val();
	if(!exercise_title){
      tips('标题不能为空','exercise_title');
      return false;
  }
  if(exercise_titlel > 20){
      tips('标题不能超过20个字符','exercise_title');
      return false;
  }
  if(!start_time){
    tips('开始时间不能为空','start_time');
    return false;
  }
  if(!end_time){
    tips('结束时间不能为空','end_time');
    return false;
  }
  if(exercise_remarks > 40){
      tips('活动备注不能超过40个字符','exercise_remarks');
      return false;
  }
    var url = "?m=pc_activity&f=activity&v=isRepeatTitle&_su=wuzhicms&_menuid=5493"
    var data = {'exercise_title':exercise_title,'id':exercise_id}
       $.ajax({
            url:url,
            data:data,
            type:'POST',
            dataType:'json',
            success:function(res){
              if(res){
                xiao = 1;
                layer.alert('标题已存在', {icon: 5});
              }
            },
            async:false
         });
     if(xiao){
      xiao = '';
      return false;
     }
})
function tips(arr,id){
   layer.tips(arr,'#'+id, {
      tips: 2
   });
}
$('.btn-add').click(function(){
	var id = $(this).attr('id');
	layer.open({
	    type: 1,
	    title: '请选择活动类型',
	    skin: 'layui-layer-rim', 
	    area: ['520px', '340px'], 
	    content: '<em style="position: absolute;top: 112px;left: 86px;">活动类型</em><center><select id="exercise_type" class="form-control" style="height:35px;width: 200px;margin-top: 100px;">' +
		              '<option value = "1">PC</option>' +
		              '<option value = "2">M站</option>' +
		              // '<option value = "3">主站APP</option>' +	
		          '</select><span class="xh" onclick="next_step('+id+')">下一步</span></center>'
	});
});
function next_step(id){
   var xiao = '';
   var type = $('#exercise_type').val();
   urls = '?m=pc_activity&f=activity&v=activitySource&_su=wuzhicms&_menuid=5493';
   postData = {'id':id,'type':type}
   $.ajax({
    url:urls,
    data:postData,
    type:'POST',
    dataType:'json',
    success:function(res){
      if(res){
       if(type==2){
           xiao = 1;
           layer.alert('此活动在M站添加过', {icon: 5});
           return false;
        }else if(type==1){
           xiao = 1;
           layer.alert('此活动在PC以添加过', {icon: 5});
           return false;
        }
      }
    },
    async:false
   });
   if(parseInt(type)==2 && xiao==''){
   	 var url  = '?m=workitems&f=workitem&v=add&source='+id+'&_su=wuzhicms&_menuid=5493';
     window.location.href = url;
   }else if(parseInt(type)==1 && xiao==''){
     var url  = '?m=pc_activity&f=activity&v=activityAdd&source='+id+'&_su=wuzhicms&_menuid=5493';
     window.location.href = url;
   }
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
$('.num').click(function(){
        var ids = $(this).attr('ids');
        var sta = $(this).attr('sta')
        if (sta == 'off') {
          var ii = layer.msg('玩命加载中', {icon: 16});
          $(".showLslist").css('display','none')
          var $this = $(this);
          $(this).attr('sta', 'on');
          $(this).find('em').text('收起');
        setTimeout(function(){
           layer.close(ii);
           $.ajax({
                url:'?m=pc_activity&f=activity&v=detaiLslist&_su=wuzhicms&_menuid=5493',
                data:'ids='+ids,
                type:'post',
                success:function(msg){
                    $this.closest('.showTr').after(msg);
                }
            })
        }, 1500);
        }else{
            $(".showLslist").css('display','none');
            $(this).find('em').text('展开')
            $(this).attr('sta', 'off')
        }
})
$(document).on('click','.wuzhi-delete',function(){
    var id = $(this).attr('attr-id');
    var status = $(this).attr('attr-status');
    var message = $(this).attr('attr-message');
    var type = $(this).attr('attr-type');
    var did = $(this).attr('attr-did');
    url = SCOPE.status_url;
    data = {'status':status,'id':id,'message':message,'type':type};
    layer.open({
        type : 0,
        btn : ['确认','取消'],
        icon : 3,
        closeBtn:2,
        content:'是否确认'+message,
        scrollbar:true,
        yes:function(){
           todelete(url,data,did,id);
        }
      })
   return false;
});
function todelete(url,data,did,id){
   var num = $('#'+id).find('m').text();
   $.post(url,data,function(s){
      $(".layer-anim,.layui-layer-shade").remove();
      $('#'+did).css('background','#FB6C6C').slideUp(500,function(){
       layer.msg('删除成功');
           $('#'+did).remove();
           num =  num - 1;
          $('#'+id).find('m').text(num);
      })
    },'json');
}
$(document).on('click','.wuzhi-edit',function(){
  var type = $(this).attr('attr-type');
  var eid = $(this).attr('attr-eid');
  var id = eid.slice(1,10);
  if(parseInt(type)==2){
     var url  = '?m=workitems&f=workitem&v=edit&id='+id+'&_su=wuzhicms&_menuid=5493';
     window.location.href = url;
   }else if(parseInt(type)==1){
     var url  = '?m=pc_activity&f=activity&v=activityEdit&id='+id+'&_su=wuzhicms&_menuid=5493';
     window.location.href = url;
   }
  return false;
});
$('#btn-save').click(function(){
   var seo_keyword = $('#seo_keyword').val();
   var seo_keywordL = $('#seo_keyword').val().length;
   var seo_description = $('#seo_description').val();
   var seo_descriptionL = $('#seo_description').val().length;
   if(seo_keyword){
      if(seo_keywordL > 100){
         layer.tips('SEO关键词不能超过100个字符', '#seo_keyword', {
            tips: 3
         });
         return false;
      }
   }
   if(seo_description){
      if(seo_descriptionL > 200){
         layer.tips('SEO描述不能超过200个字符', '#seo_description', {
            tips: 3
         });
         return false;
      }
   }
})
$('.edit').click(function(){
    var id = $(this).attr('ids');
    layer.open({
        type : 0,
        btn : ['确认','取消'],
        icon : 3,
        closeBtn:2,
        content:'您确认要编辑此活动么',
        scrollbar:true,
        yes:function(){
          $('.layer-anim,.layui-layer-shade').remove();
          openiframe('?m=pc_activity&f=activity&v=createActivity&id='+id+'&_su=wuzhicms&_menuid=5493','testaa','基础信息模块',800,600)
        }
      })
})
