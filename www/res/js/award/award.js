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
	    if(!$("#button_index").val()){
	 		$(".but .adsr-btn:first").addClass('active');
	 	}else{
			$(".but .adsr-btn[btnindex="+$("#button_index").val()+"]").addClass('active').siblings().removeClass('active');
	 	}
	 	$("#panel-bodys tr").each(function(i,n){
	      $(this).find(".nocheck").removeAttr('onclick');
	    });
});
$(document).on('mouseup','#banner li',function(){
        setTimeout(sort,2);
});
function sort(){
  $("#pic_ul>li").each(function(i,n){
     $(this).find('.liNum').text(i+1);
     $(this).find('.ids').val(i+1);
  });
} 
$("button").mouseover(function(){
	if(parseInt($("#pic_ul li").length)>=6){
		$(this).attr("disabled","disabled");
	}
});
var isDelete = true;
$(document).on('mouseover','.forbid',function(){
  isDelete = false;
});
$(document).on('mouseout','.forbid',function(){
  isDelete = true;
});
$('.draw').click(function(){
	var trLen = $('.tr').length;
	trLen  = trLen + 1;
	var open = "openiframe('/index.php?m=attachment&amp;f=index&amp;v=upload_dialog&amp;callback=callback_thumb_dialog&amp;htmlid=header"+trLen+"&amp;limit=1&amp;htmlname=setting%5Bheader"+trLen+"%5D&amp;ext=png%7Cjpg%7Cgif%7Cdoc%7Cdocx&amp;token=3d9292f4c141b7f9c4f3a37f8af2e607&amp;_menuid=29&amp;_submenuid=67','header"+trLen+"','loading...',810,400,1)";
	$('.draws').append('<tr class="tr del" ondblclick="dels(this)">'+
                       '<td style="text-align: center;" class="liNums">'+trLen+'</td>'+
                       '<td style="text-align: center;"><input type="text" name="draw[mobile][]"></td>'+
                       '<td style="text-align: center;"><input type="text" name="draw[money][]"></td>'+
                       '<td style="text-align: center;"><span class="header" onclick='+open+'>上传图片</span></td>'+
                       '<td style="text-align: center;"><input type="text" value="" ondblclick="img_view(this.value);" class="form-control" id="header'+trLen+'" name="draw[header][]" size="100" style="width:230px;margin-right:5px;position:relative;"  ></td>'+
                       '<td style="text-align: center;color:red">提示：双击删除</td>'+
                  '</tr>')
	trLen++;
})
function dels(ob){
    ob.remove();
    setTimeout(sorts,2);       
}
function sorts(){
  $(".del").each(function(i,n){
     $(this).find('.liNums').text(i+1);
  });
}
function no(){
     $(".layui-layer-shade,.layui-layer").remove();
}
$("#checkall").click(function() {

      if($("#checkall").hasClass("checked")) {
          $(".ids").each(function() {  
            $(this).prop("checked", false).removeClass("checked"); 
          }); 
      }else{
         $(".ids").each(function() {  
            $(this).prop("checked", true).addClass("checked"); 
        }); 
      }
}); 
