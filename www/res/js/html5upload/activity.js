      function checks(argument,number) {
      var myData=new Array("标题栏名称不得大于8个字符!","分享标题不得大于24个字符!","分享描述不得大于34个字符!");
      var myNumber=new Array('8','24','34');
      var b=$('#'+argument).val().length
      if(b>myNumber[number]){
          $("."+argument+"ims").attr("src", "http://m.uzhuang.com/res/images/error.png"); 
          $('.'+argument).html(myData[number]);
          a='exist';
          return false;
      }else{
        $("."+argument+"ims").removeAttr("src"); 
        $('.'+argument).html('');
         a='han';
      }
    }
   function mandatory(){
      var title =$('#title').val();
      var share =$('#share').val();
      var name =$('#name').val();
      var sharename =$('#sharename').val();
      var sharecontent =$('#sharecontent').val();
      if(!title){
            $(document).scrollTop(0);
            layer.tips('请输入活动名称', '#title');
            a='exist';
            return false;
      }
      if(!name&&$("#name").is(":visible")){
            $(document).scrollTop(0);
            layer.tips('标题栏名称', '#name');
            a='exist';
            return false;
      }
       if(!share){
            layer.tips('分享图标不能为空！', '#share');
              a='exist';
            return false;
      }
       if(!sharename){
 
            layer.tips('分享标题不能为空！', '#sharename');
             a='exist';
            return false;
      }
       if(!sharecontent){
            layer.tips('分享描述不能为空！', '#sharecontent');
            a='exist';
            return false;
      }
    }
    $(document).on('blur','.element',function(){
       var static = $(this).val();
       var isn = '<span class="isn"><img src="http://m.uzhuang.com/res/images/error.png" style="margin-left:10px"><span class="">组件编号只能为数字！！</span></span>'
       if(isNaN(static)){
          $(this).after(isn);
       }
       var sum = $(".element").length;
       var tips = '<span class="errorTip"><img src="http://m.uzhuang.com/res/images/error.png" style="margin-left:10px"><span class="">组件偏序不能大于'+sum+'哦！！！</span></span>';
       if(static>sum){
        if(parseInt($(this).nextAll(".errorTip").length)==0){
            $(this).after(tips);
        }
         a='exist';
       }
    }).on('focus','.element',function(){
      $(this).next(".errorTip").remove();
      $(this).next(".isn").remove();
      a='han';
    });//编号校验提示
    $('#baoG,#baoGs').click(function(){
        var title =$('#title').val();
       
        if(a=='exist'){
          if($("#title").next().next('span').text()!='类表名可以使用！！'||$("#name").next().next('span').text()!=''){
           $(document).scrollTop(0);
          }
           return false;
        }
        if(!title){
            $(document).scrollTop(0);
            layer.tips('请输入活动名称', '#title');
            return false;
        }
   
    });

    function showAdv(eleObj){
      layer.tips('清谨慎勾选,点击是要花钱的', eleObj);
    }//广告勾选提示

    function hide(eleObj){
       $("."+eleObj).animate({ height: 'hide', opacity: 'hide' }, 'hide');
       $('#'+eleObj).css('height','');
    }//隐藏报名框
    function show(eleObj){
       $("."+eleObj).animate({ height: 'show', opacity: 'show' }, 'slow');
       $('#'+eleObj).css('height','');
    }//显示报名框
    $("#countLimit").mouseover(function(){
      var $this = $(this);
      var imgCount = parseInt($(this).closest("span").prev("#cases").find("#case_ul li").length);
      if(imgCount>=1){
        $this.attr("disabled","disabled");
      }
    });
    function picCount(eleObj){
      var imgCount = parseInt($(eleObj).closest('span').prev('div').find("li").length);
      if(imgCount>=1){
        $(eleObj).attr("disabled","disabled");
      }
    }
    // 图片个数限制
    function showBtn(eleObj){
      var imgCount = parseInt($(eleObj).prev("div").find("li").length);
      console.log(imgCount);
      if(imgCount == 0){
        $(eleObj).find("button").removeAttr("disabled");
      }else{
        $(eleObj).find("button").attr("disabled",true);
      }
    }
    // 图片提示
    function imgTip(eleObj){
      if($(eleObj).find("button").attr("disabled")){
        layer.msg('视频图片最多只能上传一张！！修改视频图片请删除现有图片在修改', function(){});
      }
    }
    // 删除图片
    function removeImg(eleObj){
      $(eleObj).closest("li").remove();
    }
    $("#cases").next("span").click(function(){
      var $this = $(this);
      var d = $this.find(":button").attr("disabled");
      if(d){
        layer.msg('视频图片最多只能上传一张！！修改视频图片请删除现有图片在修改', function(){});
      }
    });//视频背景图片限制提示
    $("#cases").next("span").mouseover(function(){
      var imgCount = parseInt($("#cases").find("#case_ul li").length);
      if(imgCount==0){
        $("#countLimit").removeAttr("disabled");
      }
    });
    function delmodule(eleObj){
       $(eleObj).closest("div").remove();
    }
    // 提交校验
    function baoGs(){
      var iptLeng = $(".element").length;
      var i = 0;
      $(".element").each(function(index,item){
        if($(this).next().is('span.errorTip')){
          $(document).scrollTop(0);
          i++;
        }
      });
      if(i>0){
      return false;
        
      }
    }

  $(function(){ 
    var picture = $('#picture').val();
    var static = $('#static').val();
    var apply = $('#apply').val();
    var video = $('#video').val();
    var ifh5 = $('#ish5').val();
    var applybox = $('#aBox').val();
    var iftitle = $('#istitle').val();

    if(!picture){
      $("#pic").append("<input name='picture' id='picture' style='width:30px;height:15px;'class='element'>")
    }
    if(!apply){
      $("#appi").append("<input name='apply' id='apply' style='width:30px;height:15px;'class='element'>")
    }
    if(!static){
      $("#stat").append("<input name='static' id='static' style='width:30px;height:15px;'class='element'>")
    }
    if(!video){
       $("#vid").append("<input name='video' id='video' style='width:30px;height:15px;'class='element'>")
    }
    if(ifh5==2){
     $("#clModule,.floor").hide();
     $(".di").css("margin-left","-1px");
    }
    if(iftitle==2){
     $(".headlineh").hide();
    }
    if(applybox==2){
      hide('applys');
    }
  })//页面加载的事件
  function baby(){
       $('body').append('<div id="on" tabindex="0" style="z-index: 1032; position: fixed; left: 0px; top: 0px; width: 100%; height: 100%; overflow: hidden; -webkit-user-select: none; opacity: 0.7; background: rgb(0, 0, 0);"></div>');
  }
  $('#H5').click(function(){
        baby();
        setTimeout(function(){
          $("#on").remove();
        },3000);
         layer.msg('正在切换中~请稍等！！', {icon: 16});
         setTimeout(function(){
             $(".carrouselModule,.floor").animate({ height: 'hide', opacity: 'hide' }, 'slow');
             $(".di").css("margin-left","-1px");
         }, 1500);
  });
  $('#NOH5').click(function(){
        baby();
        setTimeout(function(){
          $("#on").remove();
        },3000);
         layer.msg('正在切换中~请稍等！！', {icon: 16});
         setTimeout(function(){
             $(".carrouselModule,.floor").animate({ height: 'show', opacity: 'show' }, 'slow');
         }, 1500);
  });
