<?php defined('IN_WZ') or exit('No direct script access allowed');?>
<?php
include $this->template('header','core');
?>
<body class="body">
<script src="<?php echo R;?>js/jquery.min.js"></script>
<script src="<?php echo R;?>js/layer.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo R;?>css/layer.css">
<section class="wrapper">
    <div class="row">
        <section class="panel">
            <div   class="save-bt btn btn-info" style="width: 200px;height: 40px; font-size: 20px;color: #fff;margin-left: 30px;margin-top: 15px"><?php echo $activity['activityname'] ?></div>
            <div style="height: 25px; font-size: 14px;color: #39f; margin-left: 80px; margin-top: 40px" id="addchannel">
                <a href="" onclick="return false;">
                    +添加渠道
                </a>
            </div>
            <input type="hidden" id="c_id" value="<?php echo $c_id ?>">
<!--            <input type="submit" style="height: 25px;color: #3385ff;" value="+添加渠道">-->
            <input type="hidden" id="type_source" value="<?php  echo $type ?>">
            <ul style="font-size: 14px" id="channel">
                <?php foreach($channel_list as $k => $v){ ?>
                <li style="width: 1000px;margin-top: 20px;float: left;clear: both; border-bottom: dashed #ccc 1px; padding-bottom: 10px" id="<?php echo $v['id'] ?>">
                    <div style="width: 60px; line-height: 55px; float: left;">渠道<?php echo $k+1 ?></div>
                    <div style="width: 500px; float: left;">
                        <div>
                            <input type="text" style="width: 310px;" value="<?php echo $v['channelname'] ?>" class="channelname" placeholder="渠道名称">
                            <a onclick="savechannelname(this)" style="width: 60px;" class="btn btn-primary btn-xs">保存</a>
                        </div>
                        <div style="width: 140px; float: left;" onclick="addchild(this)"><a onclick="return false;" class="btn">+继续添加</a></div>

                        <div style="float: left;clear: both; width: 1000px; height: 38px;" class="selectdiv" >
                            <?php foreach($allparents[$k] as $key => $value){ ?>
                            <select name="<?php echo $value['channelkey'] ?>" id="<?php echo $value['id'] ?>" style="width:95px;height:21px;margin-left: 4px;margin-top: 2px;">
                                <option>请选择</option>
                                <?php foreach ($select[$k][$key] as $ke => $val){ ?>
                                <option value="<?php echo $val['id']?>"
                                    <?php foreach($allchild[$k] as $ak => $av){
                                        if($av['channelkey']==$val['channelkey']){echo 'selected';}} ?>
                                >
                                    <?php echo $val['channelvalue'] ?></option>
                                <?php } ?>
                                <option value="addnew">+新增</option>
                            </select>
                            <?php } ?>

                        </div>
                        <div  style="float: left;clear: both; width: 500px;height: 29px; margin-left: 4px;"  class="selectdiv1">
                             <?php if($arr['city']){ ?>
                            <select   id="city">
                                <option>请选择</option>
                                <?php foreach ($arr['city'] as $k_city => $v_city){ ?>

                                <option value="<?php echo $k_city ?>"
                                <?php foreach ($v['city'] as $k_c => $v_c){ ?>
                                    <?php if($k_city == $k_c){echo 'selected';}} ?>>
                                    <?php echo $v_city ?>
                                </option>

                                <?php }?>

                            </select>
                            <?php }?>
                            <?php if($arr['company']){ ?>
                            <select  id="company" style="width: 300px;">
                                <option>请选择</option>
                                <?php foreach ($arr['company'] as $k_company => $v_company){  ?>
                                <option value=<?php echo $v_company['id'] ?>
                                        <?php foreach ($v['company_id'] as $k_com => $v_com){ ?>
                                    <?php if($v_company['id'] == $k_com){echo 'selected';}} ?>>

                                    <?php echo $v_company['title'] ?>
                                </option>
                                    <?php }?>

                            </select>
                          <?php }?>

                            <?php if($activity['activityname']){ ?>
                                <select disabled>
                                    <option><?php echo $activity['activityname'] ?></option>
                                </select>
                            <?php }?>


                         </div>

                        <div style="margin-top: 10px;float: left;">
                            <input type="text" class="url" style="float: left;width: 350px; margin-top: 5px" disabled  value="<?php echo $v['url'] ?>">
                            <a onclick="copytext(this)" style="float: left;width: 60px; margin-top: 5px;margin-left: 5px;" class="btn btn-success btn-xs">复制</a>
                            <span class="success" style="float: left;margin-left: 5px;margin-top:5px;color: #0AA00E">已生成</span>
                        </div>
                    </div>
                    <div style="width: 300px; float: left;">
                        <a onclick="savehref(this)" style="width: 60px;" class="btn btn-info btn-xs" >生成链接</a>
                        <a onclick="deletechannel(this)" style="width: 60px;" class="btn btn-danger btn-xs">删除</a>
                    </div>
                </li>
                <?php } ?>
            </ul>

            <center>

            </center>
        </section>
    </div>
</section>
<script>
    $('#addchannel').click(function(){
        var length = $('li').length+1;
        var custom_url = '<?php echo $custom_url ?>';
        if(<?php  echo $type  ?> == 1){
           var $url = custom_url ? custom_url : "http://www.uzhuang.com/huodong-<?php echo $c_id ?>.html";
        }else{
           var $url = custom_url ? custom_url :"http://m.uzhuang.com/mobile-temp_new.html?activity_id=<?php echo $activity['id'] ?>";
        }
        $('#channel').html($('#channel').html()+
            '<li style="width: 1000px;margin-top: 20px;float: left;clear: both; border-bottom: dashed #ccc 1px;padding-bottom: 10px">\n' +
            '<div style="width: 60px; line-height: 55px; float: left;">渠道'+length+'</div>\n' +
            '                    <div style="width: 500px; float: left;">\n' +
            '                        <div>\n' +
            '                            <input type="text" style="width: 310px;" class="channelname"  placeholder="渠道名称">\n' +
            '                            <a onclick="savechannelname(this)"  style="width: 60px;"  class="btn btn-primary btn-xs">保存</a>\n' +
            '                        <div style="width: 140px; float: left;" onclick="addchild(this)"><a onclick="return false;" class="btn">+继续添加</a></div>\n'+
            '                        </div>\n' +
            '                        <div  style="float: left;clear: both;width: 1000px; height: 38px;"  class="selectdiv">\n' +

            '                        </div>\n' +

            '                        <div  style="float: left;clear: both; width: 400px;height: 29px; margin-left: 4px;"  class="selectdiv1 add-sel">\n' +

            '                        </div>\n' +
            '                        <div>' +


            '<input type="text" class="url" style="float: left;width: 350px; margin-top: 5px"  disabled value='+$url+'> '+

            '<a onclick="copytext(this)" style="float:left;width: 60px; margin-top: 5px;margin-left: 5px;"  class="btn btn-success btn-xs">复制</a></div>\n' +
            '                            <span class="success" style="float: left;margin-left: 5px;margin-top:5px;color: #aa0000">未生成</span>\n'+
            '                    </div>\n' +
            '                    <div style="width: 130px; float: left;">\n' +
            '                        <a onclick="savehref(this)" style="width: 60px;" class="btn btn-info btn-xs" >生成链接</a>\n' +
            '                        <a onclick="deletechannel(this)"  style="width: 60px;" class="btn btn-danger btn-xs">删除</a>\n' +
            '                    </div>\n' +
            '                </li>');


        c_id = $("#c_id").val();
        $.ajax({
            type: "POST",
            url: "?m=workitems&f=workitem&v=getCompanyCity&_su=wuzhicms&_menuid=5661",
            data: {c_id:c_id},
            dataType: 'json',
            success: function(msg){
                //console.log(msg);return false;
                $(".add-sel").html(msg);

                $('.add-sel').removeClass('add-sel');

            }
        });

    });


    var selector = $('select');
    function addchild(obj){
        var channellist='';
        var names = [];
        var selects = $(obj).parents('li').find('select');
        selects.each(function(i,e){
            names[i] = $(e).attr('name');
        });
        $.ajax({
            url: '?m=workitems&f=workitem&v=getChannelList&_su=wuzhicms&_menuid=5661',
            type: 'post',
            dataType: 'json',
            data: {
                key:names
            },
            async:false,
            success: function(data){
                channellist = data;
            }
        })
        layer.open({
            title:'添加标签',
            btn:['确定','取消'],
            content:channellist,
            btn1:function(index, layero){
                var checked = new Array();
                var checkboxs = layero.find('input[type="checkbox"]');
                checkboxs.each(function(i,e){
                    if(e.checked){
                        checked.push($(e).parent('div').attr('id'))
                    }
                });
                $.post('?m=workitems&f=workitem&v=getChild&_su=wuzhicms&_menuid=5661',{checked:checked},function(data){

                    $(obj).parents('li').find('.selectdiv').append(data);

                    $(obj).parents('li').find('.success').html('未生成');
                    $(obj).parents('li').find('.success').css('color','#aa0000');

                    selectfunc();
                },'JSON');

                layer.close(index)
            },
            btn2:function(index, layero){

                layer.close(index)
            },
        });
    }

    function savechannelname(obj){
        var name = $(obj).parent('div').find('.channelname').val();

        var id = $(obj).parents('li').attr('id');
        if(!id){
            layer.msg('请先生成链接');
            return false;
        }
        $.post('?m=workitems&f=workitem&v=changeChannelName&_su=wuzhicms&_menuid=5661',{id:id,name:name},function(data){
            window.location.reload();
        },'JSON');
    }

    function deletechannel(obj){
        var id = $(obj).parents('li').attr('id');
        layer.confirm('确认删除?',function(index){
            $.post('?m=workitems&f=workitem&v=deleteActivityChannel&_su=wuzhicms&_menuid=5661',{id:id},function(data){
                window.location.reload();
            },'JSON');
            $(obj).parents('li').fadeOut('slow');
            layer.close(index);
        })
    }

    function selectfunc(){
        $('select').bind('change',function(){
            var that = this;
            if($(this).val()=='addnew'){
                layer.open({
                    title:'请输入渠道名称',
                    content:' <input type="text" id="tagname">',
                    btn:['确定','取消'],
                    btn1:function(index, layero){
                        var tagname = $('#tagname').val();
                        var id ='';
                        $.ajax({
                            url: '?m=workitems&f=workitem&v=addChannel&_su=wuzhicms&_menuid=5661',
                            type: 'post',
                            dataType: 'json',
                            data: {
                                name:tagname,
                                pid:$(that).attr('id')
                            },
                            async:false,
                            success: function(data){
                                id = data;
                            }
                        });
                        $(that).append('<option value="'+id+'" selected>'+tagname+'</option>\n');
                        layer.close(index);
                    },
                    btn2:function(index, layero){
                        $(that).prop('selectedIndex', 0);
                        layer.close(index)
                    },
                });
            }

            $(that).parents('li').find('.success').html('未生成');
            $(that).parents('li').find('.success').css('color','#aa0000');
        })
    }
    selectfunc();

    var i = 0;
    function copytext(obj){
        var cp = $(obj).parent('div').find('input').val();
        var clipboard = new Clipboard(obj,{
            text: function() {
                return cp;
            }
        });
        if(i == 0){
            layer.msg('复制链接需要点两下');
            i++;
        } else{
            layer.msg('复制成功');
            i=0;
        }
    }


    function savehref(obj){
        var activity = <?php echo $activity['id'] ?>;
        var c_id = <?php echo $c_id ?>;
        var channels = [];
        var selects = $(obj).parents('li').find('.selectdiv select');
        //城市id
        var sele_city = $(obj).parents('li').find('.selectdiv1 #city');
        //装修公司 id
        var sele_com = $(obj).parents('li').find('.selectdiv1 #company');

        var channelid = $(obj).parents('li').attr('id');
        var type_source =  $("#type_source").val();
        var channelname = $(obj).parents('li').find('.channelname').val();
        var flag = 0;
        var flag1 = 0;
        var flag2 = 0;
        selects.each(function(i,e){
            channels[i] = $(e).val();
            if($(e).val()=='请选择'||$(e).val()=='addnew'){
                flag = 1;
            }
        });
        if(flag){
            layer.msg('有未选择的渠道');
            return false;
        }
        if(channels.length == 0){
            layer.msg('还未选择推广渠道');
            return false;
        }

        var city = sele_city.val();

        var company = sele_com.val();
        if(city) {

            if (city == '请选择' || city == 'addnew') {
                flag1 = 1;
            }

            if (flag1) {
                layer.msg('有未选择的城市渠道');
                return false;
            }
            if (city.length == 0) {
                layer.msg('还未选择推广渠道');
                return false;
            }
        }
        if(company){
        if(company =='请选择'||company =='addnew'){
            flag2 = 1;
        }

        if(flag2){
            layer.msg('有未选择的装修公司渠道');
            return false;
        }
        if(company.length == 0){
            layer.msg('还未选择推广渠道');
            return false;
        }
        }


        $.post('?m=workitems&f=workitem&v=addChannelActivity&_su=wuzhicms&_menuid=5661',{activityid:activity,channelid:channels,id:channelid,channelname:channelname,type_source:type_source,c_id:c_id,city:city,company:company},function(data){
            $(obj).parents('li').find('.url').val(data.url);
            $(obj).parents('li').attr('id',data.id);
            $(obj).parents('li').find('.success').html('已生成');
            $(obj).parents('li').find('.success').css('color','#0AA00E');
            layer.msg('成功生成');

        },'JSON');
        setTimeout(window.location.reload(),1000);
    }

</script>
<script src="<?php echo R;?>js/clipboard.min.js"></script>
<script src="<?php echo R;?>js/bootstrap.min.js"></script>
<script src="<?php echo R;?>js/hover-dropdown.js"></script>
<script src="<?php echo R;?>js/jquery.nicescroll.js" type="text/javascript"></script>
<script src="<?php echo R;?>js/pxgrids-scripts.js"></script>
<script src="<?php echo R;?>js/activity/dialog.js"></script>
<script src="<?php echo R;?>js/activity/activity.js"></script>

