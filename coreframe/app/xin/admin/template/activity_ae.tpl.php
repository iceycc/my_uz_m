<?php defined('IN_WZ') or exit('No direct script access allowed');?>
<?php
include $this->template('headers','core');
?>
<body class="body">
<style type="text/css">
  #form6{
    
      margin-left:30px;
      margin-top:10px;  
  }
 fieldset{
      margin-bottom: 10px;
  }
  .element{
      text-align: center;
  }
  #module{
      margin-top:10px; 
  }
  body, html {
      overflow: auto !important;
  }
  .fen{
    margin-left: 100px;
  }
  .red{
    color:red;
    margin: 0 1px;
  }
  .titles{
    margin: 9px auto 0;
  }
  .ims{
    margin: 9px auto 0;
    margin-left: 10px;
  }
  #yi{
    color: red;
  }
</style>
<link href="<?php echo R;?>js/colorpicker/style.css" rel="stylesheet">
<link href="<?php echo R;?>js/jquery-ui/jquery-ui.css" rel="stylesheet">
<script src="<?php echo R;?>js/colorpicker/color.js"></script>
<script src="<?php echo R;?>js/jquery.js"></script>
<script src="<?php echo R;?>js/layer.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo R;?>css/layer.css">
<link rel="stylesheet" type="text/css" href="<?php echo R;?>css/layui.css">
<section class="wrapper">
    <div class="row">
        <div class="col-lg-12">
            <section class="panel"><br/>
                <form action="" class="form-inline"  id="form6" method="post">
                     <div class="layui-form-label">
                         <label class="labelf"><span class='red'>*</span>�б�����</label>
                         <input type="text" name="exercise" id="title" class="input " style="height:30px; width:300px; "placeholder="����������1-15�ַ�֮�䣩" value=""><img src="" class="ims" alt=""><span class='titles'></span>
                      </div><br/>
                      <div class="layui-form-label">
                         <label class="labelr"><span class='red'>*</span>�ģ�����</label>
                         <input type="text" name="title" id='name' class="input" style="height:30px; width:300px; " placeholder="����������1-8�ַ�֮�䣩"value="">                 
                      </div><br/>
                      <div class="layui-form-label">
                       <label class="labelf">������</label>
                         <span style='margin-top: 10px;margin-left: 10px;'> 
                            <input name="Fruits" type="radio" value="1" checked=""/>��
                            <input name="Fruits" type="radio" value="2" />��
                         </span>
                      </div>
                      <div id='module' >
                       <fieldset>
                       <legend >���</legend>
                          <div >
                            <fieldset>
                                <legend >��̬ͼƬ�ϴ� ---- <input type="text" name='static' id='static'style="width:30px;height:10px;" class="element"></legend>
                                   <div class="attaclist"><div id="case"><ul id="case_ul"></ul></div><span class="input-group-btn">
                             <button type="button" class="btn btn-white" onclick="openiframe('/index.php?m=attachment&amp;f=index&amp;v=upload_dialog&amp;callback=callback_images6&amp;htmlid=case&amp;limit=20&amp;width=1&amp;htmlname=form%5Bcase%5D&amp;ext=jpg%7Cpng%7Cgif%7Cbmp&amp;token=34f98e4c74f75c6701341b703f09917b&amp;_menuid=5002','case','loading...',810,400,20)">�ϴ�ͼƬ</button>
                            </fieldset>
                          </div>
                          <div >
                              <fieldset>
                                  <legend >��Ƶ ---- <input type="text" name='video' id='video' style="width:30px;height:10px;" class="element"></legend>
                                <div class="attaclist"><div id="cases"><ul id="case_ul"></ul></div><span class="input-group-btn">
                               <button type="button" id="countLimit" class="btn btn-white cases" onclick="openiframe('/index.php?m=attachment&amp;f=index&amp;v=upload_dialog&amp;callback=callback_images10&amp;htmlid=cases&amp;limit=1&amp;width=1&amp;htmlname=form%5Bcases%5D&amp;ext=jpg%7Cpng%7Cgif%7Cbmp&amp;token=34f98e4c74f75c6701341b703f09917b&amp;_menuid=5002','cases','loading...',810,400,20)">�ϴ�ͼƬ</button>
                               </div>
                              </fieldset>
                              <fieldset id="applys">
                                   <legend >
                                   ������ ---- <input type="text" name='apply' id='apply' class="applys" style="width:30px;height:10px;" class="element">----
                                   <span> 
                                        <input type="radio" name="shtype"  id="show" value="1" checked="">��ʾ
                                        <input type="radio" name="shtype"  id="hide" value="2" >����
                                   </span>
                                   </legend>
                                   <input type="text" value="" ondblclick="img_view(this.value);" class="form-control applys" id="attachment_test" name="attachment_test" size="100" style="width:300px;margin-right:5px;position:relative;" placeholder="�����߶�384px" > 
                                  <button type="button"  style="" class="btn btn-white applys" onclick="openiframe('/index.php?m=attachment&amp;f=index&amp;v=upload_dialog&amp;callback=callback_thumb_dialog&amp;htmlid=attachment_test&amp;limit=1&amp;htmlname=setting%5Battachment_test%5D&amp;ext=png%7Cjpg%7Cgif%7Cdoc%7Cdocx&amp;token=3d9292f4c141b7f9c4f3a37f8af2e607&amp;_menuid=29&amp;_submenuid=67','attachment_test','loading...',810,400,1)">�ϴ��ļ�</button><br/><br/>
                                  <span class="test"></span>
                                   <div class="layui-form-label applys">
                                      <label class="labelr">������������</label>
                                      <input type="text" class="form-control input" id="register_tel" name="register_tel"  value='' style="width:150px;height:30px;">                          
                                  </div>
                                  <div class="layui-form-label applys">
                                      <label class="labelr">�ύ��ť�İ�</label>
                                      <input type="text" class="form-control input" id="register_tel" name="register_tel"  value='' style="width:150px;height:30px;"><br/>                       
                                  </div><br/>
                                   <div class="layui-form-label applys">
                                      <label class="labelr">�ύ��ť������ɫ</label>
                                      <input type="text" class="form-control input" id="register_tel" name="register_tel"  value='' style="width:80px;height:30px;"><br/>                       
                                  </div>
                                   <div class="layui-form-label applys">
                                      <label class="labelr">�ύ��ť�İ���ɫ</label>
                                      <input type="text" class="form-control input" id="register_tel" name="register_tel"  value='' style="width:80px;height:30px;"><br/>                       
                                  </div>
                                   <div class="layui-form-label applys">
                                      <label class="labelr">����������ɫ</label>
                                      <input type="text" class="form-control input" id="register_tel" name="register_tel"  value='' style="width:80px;height:30px;"><br/>                       
                                  </div>
                                   <div class="layui-form-label applys">
                                      <label class="labels">����������ʾ����ɫ</label>
                                      <input type="text" class="form-control input" id="register_tel" name="register_tel"  value='' style="width:80px;height:30px;"><br/>                     
                                  </div>
                              </fieldset>
                               <fieldset>
                               <legend >ͼƬ ---- <input type="text" name='picture' id='picture' style="width:30px;height:10px;" class="element"></legend>
                               <div class="layui-form-label">
                                 <label class="labelf">Ч��ѡ��</label>
                                 <span style='margin-top: 10px;margin-left: 10px;'> 
                                    <input name="Fruit" type="radio" value="1" checked=""/>��ҳ�ֲ�
                                    <input name="Fruit" type="radio" value="2" />˫ҳ
                                 </span>
                                </div>
                              </fieldset><br/> 
                          </fieldset>
                       </div>
                       <div class="layui-form-label">
                         <label class="labelf">�ײ�����</label>
                          <span style='margin-top: 10px;margin-left: 10px;'> 
                              <input name="" type="radio" value="1" checked=""/>��
                              <input name="" type="radio" value="2" />��
                          </span>
                      </div>
                       <div class="layui-form-label fen">
                         <label class="labelf">������</label>
                          <span style='margin-top: 10px;margin-left: 10px;'> 
                              <input name="" type="radio" value="1" checked=""/>��
                              <input name="" type="radio" value="2" />��
                          </span>
                      </div><br/>
                       <fieldset>
                         <legend >����</legend>
                         <div class="layui-form-label">
                           <label class="labelf"><span class='red'>*</span>����ͼ��</label>
                              <input type="text" value="" ondblclick="img_view(this.value);" class="form-control" id="share" name="share" size="100" style="width:300px;margin-right:5px;position:relative;" placeholder='300px*300px'>
                              <button type="button" class="btn btn-white" onclick="openiframe('/index.php?m=attachment&amp;f=index&amp;v=upload_dialog&amp;callback=callback_thumb_dialog&amp;htmlid=share&amp;limit=1&amp;htmlname=setting%5Bshare%5D&amp;ext=png%7Cjpg%7Cgif%7Cdoc%7Cdocx&amp;token=3d9292f4c141b7f9c4f3a37f8af2e607&amp;_menuid=29&amp;_submenuid=67','share','loading...',810,400,1)" style="height: 28px;">�ϴ�ͼ��</button>
                          </div><br/>
                          <div class="layui-form-label">
                           <label class="labelf"><span class='red'>*</span>�������</label>
                               <input type="text" name='sharename' id='sharename'style='width:300px; height:30px;' placeholder='24���ַ�����'>
                          </div><br/>
                          <div class="layui-form-label layui-form-area">
                              <label style="height:30px;line-height:30px;"><span class='red'>*</span>��������</label>
                              <textarea  name="content"></textarea>
                          </div>
                        </fieldset>
                    <input name="submit" type="submit" class="save-bt btn btn-info" id="baoG" value="����" >
               </form>
            </section>
        </div>
        <img src="<? echo R?>images/right.png" alt="">
</section>
<script src="<?php echo R;?>js/bootstrap.min.js"></script>
<script src="<?php echo R;?>js/jquery.nicescroll.js" type="text/javascript"></script>
<script src="<?php echo R;?>js/pxgrids-scripts.js"></script>
<script src="<?php echo R;?>js/jquery-ui/jquery-ui.min.js" type="text/javascript"></script>
<script src="<?php echo R;?>js/jquery.ui.touch-punch.min.js" type="text/javascript"></script>
<link href="<?php echo R;?>css/style.css" rel="stylesheet">
<script src="<?php echo R; ?>js/html5upload/extension.js"></script>
<link href="{R}css/validform.css" rel="stylesheet" />
<script src="{R}js/validform.min.js"></script>
<script type="text/javascript" src="{R}js/validform.min.js"></script>
<script type="text/javascript">
    var a;
    $('#title').mouseleave(function(){
       var name = $("#title").val();
       $.ajax({
          url:"?m=xin&f=content&v=checkNameExits<?php echo $this->su();?>",
          data:{'title':name},
          type:"POST",
          dataType:"json",
          success:function(data){
            if (data) {
              $(".ims").attr("src", "http://m.uzhuang.com/res/images/error.png"); 
              $('.titles').html('������ѳƴ���!����');
             

               

            
              a='exist';
            }else{
                if(name){
                 $(".ims").attr("src", "http://m.uzhuang.com/res/images/right.png"); 
                 $('.titles').html('���������ʹ�ã���');
              }
            }
          },
        })
    });
    $('#baoG').click(function(){
        var title =$('#title').val();
        if(a=='exist'){
           $(document).scrollTop(0);
           return false;
        }
        subassembly()
    });
    function subassembly(){
       var static = $('#static').val();
       var video = $('#video').val();
       var apply = $('#apply').val();
       var picture = $('#picture').val();
       if(static>4){
          big('static');
       }
       if(video>4){
          big('video');
       }
       if(apply>4){
          big('apply');
       }
       if(picture>4){
          big('picture');
       }

       if(isNaN(static) || isNaN(video) || isNaN(apply) || isNaN(picture)){
           layer.msg('���ֻ��Ϊ����', function(){});
       }
       function big(big){
          layer.tips('��������ܴ���4Ŷ����', '#'+big, {
                  tips: 3
            });
          return false;
       }
    }
    $('#hide').click(function(){
       $(".applys").animate({ height: 'hide', opacity: 'hide' }, 'slow');
       $('#applys').css('height','20px');
    });
    $('#show').click(function(){
       $(".applys").animate({ height: 'show', opacity: 'show' }, 'slow');
       $('#applys').css('height','');
    });
    $(".attaclist").mouseleave(function(){
      var yi=$("#yi").val();
      if(yi){
         $(".cases").animate({ height: 'hide', opacity: 'hide' }, 'slow');
         layer.msg('�����ϴ���ƵͼƬ����');
      }
    });
</script>
</body>
</html>
