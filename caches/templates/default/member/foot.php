<?php defined('IN_WZ') or exit('No direct script access allowed'); ?><div class="container">
    <hr/>
    <div style="color: #7D7D7D;text-align: center;" class="foot_category">
        <?php if(defined('IN_ADMIN') && !defined('HTML')) {
	echo "<div class=\"visual_div\" pc_action=\"content\" data=\"\"><a href=\"javascript:void(0)\" class=\"visual_edit\">修改</a>";
}
if(!class_exists('content_template_parse')) {
	$content_template_parse = load_class("content_template_parse", "content");
}
if (method_exists($content_template_parse, 'category')) {
	$rs = $content_template_parse->category(array('cid'=>'29','order'=>'sort ASC','start'=>'0','pagesize'=>'10','page'=>'0',));
	$pages = $content_template_parse->pages;$number = $content_template_parse->number;}?>
        <?php $n=1;if(is_array($rs)) foreach($rs AS $r) { ?>
        <a href="<?php echo $r[url];?>"><?php echo $r['name'];?></a>  |
        <?php $n++;}?>
        <?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
        <a href="<?php echo WEBURL;?>index.php?m=link">友情链接</a>
    </div>
    <div style="text-align: center; padding-top:10px;font-size:12px; color:#7D7D7D"><?php echo $siteconfigs['copyright'];?><?php echo $siteconfigs['statcode'];?> Powered by <a href="http://www.wuzhicms.com" target="_blank">五指CMS</a> </div>
</div>
<div class="container">
</div>
<script type="text/javascript">
    var _uid=getcookie('_uid');
    if(_uid!=null) {
        $("#mylogined").removeClass('hide');
        $("#mylogin").addClass('hide');
        var _username=decodeURI(getcookie('truename'));
        $("#myname").html(_username);
        var modelid=getcookie('modelid');
        if(modelid==10) {
            $("#my-panel1").removeClass('hide');
        } else if(modelid==11) {
            $("#my-panel2").removeClass('hide');
        } else {
            $("#my-panel3").removeClass('hide');
        }
        $(function($) {
            $("#mini_car").load("/index.php?m=order&f=json&v=mini_car");
        });

    }
    setInterval("get_newmessage()", 10000);
    function get_newmessage() {
        $.getJSON("/index.php?m=member&f=json&v=get_newmessage", { time: Math.random()}, function(json){
            if(json.newmessage==1) {
                $("#mymessage-tips").removeClass('hide');
            } else {
                $("#mymessage-tips").addClass('hide');
            }
        });
    }
    get_newmessage();
</script>
</body>
</html>