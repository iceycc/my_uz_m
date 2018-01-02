<?php defined('IN_WZ') or exit('No direct script access allowed'); ?>
<?php
include $this->template('header', 'core');
?>
<body class="body pxgridsbody">
<style type="text/css">
.tablewarnings {
display: none;
}
#content{
  height: 200px;
}
</style>
<link href="<?php echo R; ?>js/colorpicker/style.css" rel="stylesheet">
<link href="<?php echo R; ?>js/jquery-ui/jquery-ui.css" rel="stylesheet">
<script src="<?php echo R; ?>js/colorpicker/color.js"></script>


<section class="wrapper">
<div class="row">
<div class="col-lg-12">
<section class="panel" style="border-top: 2px solid #2E3238;">
<header class="panel-heading addpos"><?php echo catpos($cid, ' &gt; ', 'target="_blank"'); ?></header>
<div class="panel-body" id="panel-bodys">
<form name="myform" class="form-horizontal tasi-form" action="" method="post">
<table class="table table-striped table-advance table-hover" id="contenttable">
<tbody>
<?php
if (isset($formdata['5']['title'])) {
?>
<tr>
<td>
<div class="col-sm-12 input-group" id="titlecss"><span
        class="input-group-addon"><?php echo $formdata['5']['title']['name'] ?></span><?php echo $formdata['5']['title']['form'] ?>
</div>
</td>
</tr>
<?php
}
if (isset($formdata['5']['content'])) {
?>
<tr>
<td>
<div class="col-sm-12 input-group">
    <?php echo $formdata['5']['content']['form'] ?>
    <span
        class="tablewarnings"><?php echo $formdata['5']['content']['remark'] ?></span>
</div>
</td>
</tr>
<?php } ?>
<tr>
<td>



<div id="myTabContent" class="tab-content">
<div role="tabpanel" class="tab-pane fade active in" id="tabs1"
     aria-labelledby="1tab">
    <table class="table table-striped table-advance table-hover"
           id="contenttable">
        <?php
        if (is_array($formdata['0'])) {
            foreach ($formdata['0'] as $field => $info) {
                if ($info['powerful_field']) continue;
                if ($info['formtype'] == 'powerful_field') {
                    foreach ($formdata['0'] as $_fm => $_fm_value) {
                        if ($_fm_value['powerful_field']) {
                            $info['form'] = str_replace('{' . $_fm . '}', $_fm_value['form'], $info['form']);
                        }
                    }
                    foreach ($formdata['1'] as $_fm => $_fm_value) {
                        if ($_fm_value['powerful_field']) {
                            $info['form'] = str_replace('{' . $_fm . '}', $_fm_value['form'], $info['form']);
                        }
                    }
                    foreach ($formdata['2'] as $_fm => $_fm_value) {
                        if ($_fm_value['powerful_field']) {
                            $info['form'] = str_replace('{' . $_fm . '}', $_fm_value['form'], $info['form']);
                        }
                    }
                }
                ?>
                <tr>
                    <td style="width: 120px;">
                        <?php if ($info['star']) { ?> <font
                            color="red">*</font><?php } ?>
                        <strong><?php echo $info['name'] ?></strong>
                    </td>
                    <td class="hidden-phone">
                        <div class="col-sm-12 input-group">
                        <?php echo $info['form'] ?>
                            <span
                                class="tablewarnings"><?php echo $info['remark'] ?></span>
                        </div>
                    </td>
                </tr>

            <?php
            }
        }?>
    </table>
</div>
</div>

</td>
</tr>
<tr>
<td>
<div class="contentsubmit text-center">
<input type="hidden" name="modelid" value="<?php echo $modelid; ?>">
<input name="submit" type="submit" class="save-bt btn btn-info" value=" 提 交 ">
&nbsp;&nbsp;&nbsp;
<input name="submit2" type="submit" class="btn  btn-primary" value=" 提交后再编辑 ">
</div>
</td>
</tr>
</tbody>
</table>
</form>
</div>
</section>
</div>
</div>
</section>


<script src="<?php echo R; ?>js/bootstrap.min.js"></script>
<script src="<?php echo R; ?>js/jquery.nicescroll.js" type="text/javascript"></script>
<script src="<?php echo R; ?>js/pxgrids-scripts.js"></script>
<script src="<?php echo R; ?>js/jquery-ui/jquery-ui.min.js" type="text/javascript"></script>
<script src="<?php echo R; ?>js/jquery.ui.touch-punch.min.js" type="text/javascript"></script>
<link href="<?php echo R; ?>css/style.css" rel="stylesheet">
<script type="text/javascript">
$(".save-bt").click(function () {
t = setTimeout("hide_formtips()", 5000);
});
$(function () {
$(".form-horizontal").Validform({
tiptype: 1
//$.Hidemsg()
});
})

function fillurl(obj, value) {
if (value != '' && $("#route_type").val() == 3) {
value = value.replace("<?php echo POSTFIX;?>", "");
$(obj).val(value + '<?php echo POSTFIX;?>');
}
}
function change_route(name, value) {
$("#def_type").html(name);
$("#route_type").val(value);
}
function hide_formtips() {
$.Hidemsg();
clearInterval(t);
}
function check_title() {
var title = $("#title").val();
if (title == '') {
alert('请填写标题');
$("#title").focus();
} else {
$.post("?m=content&f=content&v=checktitle<?php echo $this->su();?>", {
title: title,
cid:<?php echo $cid;?>,
id: 0
},
function (data) {
if (data == 'ok') {
    alert('没有重复标题');
} else if (data == '1') {
    alert('有完全相同的标题存在');
} else if (data == '2') {
    alert('有相似度很高的标题存在');
}
});
}
}
//移除相关内容
    function remove_relation(obj,rid) {
        $.post("?m=content&f=relation&v=remove_relation<?php echo $this->su();?>", { rid: rid, time: Math.random()}, function(data){
            if(data=='200') {
                $(obj).parent().fadeOut();
            } else {
                alert(data);
            }
        });

    }
<?php
if($cate_config['workflowid'] && $_SESSION['role']!=1) {
?>
$("input[name='form[status]'][value='9']").attr("disabled",true);
$("input[name='form[status]'][value='8']").attr("disabled",true);
$("input[name='form[status]'][value='1']").attr("checked",true);

<?php }?>
</script>