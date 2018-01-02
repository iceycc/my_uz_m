<?php defined('IN_WZ') or exit('No direct script access allowed');?>
<?php
include $this->template('header','core');
?>
<!--<body class="body">-->
<script src="<?php echo R;?>js/jquery.min.js"></script>
<script src="<?php echo R;?>js/layer.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo R;?>css/layer.css">
<section class="wrapper">
    <div class="row">
        <section class="panel"  width: 100%;">
        <?php if($role1['name'] == '超级管理员'){ ?>
            <div style="height: 25px; font-size: 20px;color: #39f; margin-left: 80px; margin-top: 40px" id="addtag">
                <a href="" onclick="return false;" style="margin-left: 82px;">
                    +添加渠道
                </a>
            </div>
        <?php }?>
            <!--            <input type="submit" style="height: 25px;color: #3385ff;" value="+添加渠道">-->
            <ul style="height: 100%;list-style: none;font-size: 16px;" id="channeltags">
                <?php foreach ($top_menu as $k => $v) {?>
                <li style="padding-top: 10px;float: left;clear: both;" id="<?php echo $v['id'] ?>">
                    <div style=" float: left; width: 100px;"><?php echo numToWord( $k +1) ?>级标签</div>
                    <div style="padding-right: 20px;font-size: 16px;float: left;" >

                        <span style="float:left;"   onclick="addtagname(this)" class="tagname">
                            <span style="background: url(' <?php echo R; ?>images/edit.png');background-size:20px 20px;width: 20px;height: 20px; float: left;" ></span>

                          <span class="channelvalue"><?php echo $v['channelvalue'] ?></span>:
                        </span>

                        <span class="btn" style="padding-top:10px;float: left;clear: both;color: #39f" onclick="addchild(this)">+继续添加</span>
                    </div>
                    <div style="width: 600px;float: left;"class="childs">
                        <?php foreach ($childs[$k] as $key => $value) { ?>
                        <span style="padding-right: 20px;"><label><?php echo $value['channelvalue']?> <input type="checkbox" id="<?php echo $value['id'] ?>" name="<?php echo $value['channelkey'] ?>"></label></span>
                        <?php } ?>
                    </div>
                </li>
                <?php } ?>
            </ul>
            <center style="clear: both">
                <a onclick="return false" id="deletechannel" class="btn btn-danger">删除</a>
                <a href="" class="btn btn-primary">保存</a>
            </center>
        </section>
    </div>
</section>
<script>
    $('#addtag').click(function() {
        var childkey = '';
        layer.open({
            title: '请输入标签名称',
            content: ' <input type="text" id="topname">',
            btn: ['确定', '取消'],
            btn1: function (index, layero) {
                childkey = $('#topname').val();
                var id = '';
                $.ajax({
                    url: '?m=workitems&f=workitem&v=addChannel&_su=wuzhicms&_menuid=5661',
                    type: 'post',
                    dataType: 'json',
                    data: {
                        name:childkey
                    },
                    async:false,
                    success: function(data){
                        id = data;
                    }
                });
                $('#channeltags').append('<li style="padding-top: 10px;float: left;clear: both;" id="'+id+'">\n' +
                    '                    <div style="padding-right: 20px;font-size: 16px;float: left;" >\n' +
                    '                        <span style="float:left;"  class="tagname" onclick="addtagname(this)">\n           ' +
                    '                        <span style="background: url(\' <?php echo R; ?>images/edit.png\');background-size:20px 20px;width: 20px;height: 20px; float: left;" ></span>\n' +
                    '                            <span class="channelvalue">'+childkey+'</span>:\n' +
                    '                        </span>\n' +
                    '                        <span class="btn" style="padding-top:10px;float: left;clear: both;color: #39f" onclick="addchild(this)">+继续添加</span>\n' +
                    '                    </div>\n' +
                    '                    <div style="width: 600px;float: left;" class="childs">\n' +
                    '                    </div>\n' +
                    '                </li>');
                layer.close(index);
            },
            btn2:function(index, layero){
                layer.close(index)
            }
        });
    });
    function addchild(obj){
        var tagname;
        layer.open({
            title:'请输入渠道名称',
            content:' <input type="text" id="tagname">',
            btn:['确定','取消'],
            btn1:function(index, layero){
                tagname = $('#tagname').val();
                var id ='';
                $.ajax({
                    url: '?m=workitems&f=workitem&v=addChannel&_su=wuzhicms&_menuid=5661',
                    type: 'post',
                    dataType: 'json',
                    data: {
                        name:tagname,
                        pid:$(obj).parents('li').attr('id')
                    },
                    async:false,
                    success: function(data){
                        id = data;
                    }
                });
                $(obj).parents('li').find('.childs').append('<span style="padding-right: 20px"><label>'+tagname+' <input type="checkbox" id="'+id+'" name="'+id+'"></label></span>\n');
                layer.close(index);
            },
            btn2:function(index, layero){
                layer.close(index)
            },
        });
    }

     function addtagname(obj){
        var that = obj;
        console.log(123);
        var value = $(that).parents('li').find('.channelvalue').html();
        layer.open({
            title:'编辑标签名称',
            content:' <input type="text" id="tagnameedit" value="'+value+'">',
            btn:['确定','取消'],
            btn1:function(index, layero){
                var tagname = $('#tagnameedit').val();
                $(that).parents('li').find('.channelvalue').html(tagname);
                var id = $(that).parents('li').attr('id');
                $.post('?m=workitems&f=workitem&v=changeTagName&_su=wuzhicms&_menuid=5661',{id:id,name:tagname},function(){
                },'JSON');
                layer.close(index);
            },
            btn2:function(index, layero){
                layer.close(index)
            },
        })
    };

    $('#deletechannel').click(function(){
        $('input[type="checkbox"]').each(function(i,e){
            if(e.checked){
                $.post('?m=workitems&f=workitem&v=deleteChannel&_su=wuzhicms&_menuid=5661',{id:e.id},function(){
                },'JSON');
                $(e).parents('span').fadeOut("slow");
            }
        })
    });
</script>
<script src="<?php echo R;?>js/bootstrap.min.js"></script>
<script src="<?php echo R;?>js/hover-dropdown.js"></script>
<script src="<?php echo R;?>js/jquery.nicescroll.js" type="text/javascript"></script>
<script src="<?php echo R;?>js/pxgrids-scripts.js"></script>
<script src="<?php echo R;?>js/activity/dialog.js"></script>
<script src="<?php echo R;?>js/activity/activity.js"></script>

