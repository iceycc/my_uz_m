<?php defined('IN_WZ') or exit('No direct script access allowed'); ?><?php if(!isset($siteconfigs)) $siteconfigs=get_cache('siteconfigs'); include T("content","head",TPLID); ?>
<div class="container Site_map"> 当前位置：<a href="<?php echo WEBURL;?>">首页</a><span> &gt; <?php echo catpos($cid);?></span></div>

<div class="bankuai_1 pd30">
    <div class="container">
        <div class="subnav">
            <div class="panel-body">
                <?php $n=1;if(is_array($sub_categorys)) foreach($sub_categorys AS $cats) { ?>
                <a href="<?php echo $cats['url'];?>"><?php echo $cats['name'];?></a>
                <?php $n++;}?>
            </div>
        </div>

    
    <div class="row">
            <div class="col-xs-8" style="border-right:1px solid #eee">

             <h3><?php echo $category['name'];?></h3>
                
                   <?php if(defined('IN_ADMIN') && !defined('HTML')) {
	echo "<div class=\"visual_div\" pc_action=\"content\" data=\"\"><a href=\"javascript:void(0)\" class=\"visual_edit\">修改</a>";
}
if(!class_exists('content_template_parse')) {
	$content_template_parse = load_class("content_template_parse", "content");
}
if (method_exists($content_template_parse, 'listing')) {
	$rs = $content_template_parse->listing(array('order'=>'sort DESC,id DESC','cid'=>$cid,'urlrule'=>$urlrule,'start'=>'0','pagesize'=>'20','page'=>$page,));
	$pages = $content_template_parse->pages;$number = $content_template_parse->number;}?>
                <?php $n=1;if(is_array($rs)) foreach($rs AS $r) { ?>
                <div class="media">
                    <div class="media-left">
                        <a href="<?php echo $r[url];?>"><img src="<?php echo $r[thumb];?>" width="120px;"></a>
                    </div>
                    <div class="media-body">
                        <h4 class="media-heading manhangyichu" style="max-width:480px;"><strong><a href="<?php echo $r[url];?>" target="_blank"><?php echo $r['title'];?></a></strong></h4>
                        <p style="width:490px;"><span class="down_wds"><a href="<?php echo $categorys[$r['cid']]['url'];?>"><?php echo $categorys[$r['cid']]['name'];?></a> | <?php echo $r['soft_license'];?> | 大小:<?php echo $r['soft_size'];?> | 环境:<?php echo $r['soft_env'];?> | 人气:<?php echo $r['down_numbers'];?></span><br>
                            <?php echo strcut($r['remark'],180,'...');?><br>
                            <small style="float:right"><span class="glyphicon glyphicon-time" aria-hidden="true"></span> 更新日期：<?php echo date('Y.m.d',$r['addtime']);?></small></p>

                    </div>
                </div>
                <?php $n++;}?>
                <?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
               <?php if($this->db->number>20) { ?>
                <nav style="text-align: center;">
                    <ul class="pagination">
                        <?php echo $pages;?>
                    </ul>
                </nav>
                <?php } ?>
            </div>
            <div class="col-xs-4">
                <div class="rightad_boxg"></div>
                <div class="right_hot">
                    <h4>常用下载</h4>
                    <div class="list-group">
                        <?php if(defined('IN_ADMIN') && !defined('HTML')) {
	echo "<div class=\"visual_div\" pc_action=\"content\" data=\"\"><a href=\"javascript:void(0)\" class=\"visual_edit\">修改</a>";
}
if(!class_exists('content_template_parse')) {
	$content_template_parse = load_class("content_template_parse", "content");
}
if (method_exists($content_template_parse, 'block')) {
	$rs = $content_template_parse->block(array('type'=>'1','blockid'=>'14','cid'=>$cid,'start'=>'0','pagesize'=>'10','page'=>'0',));
	$pages = $content_template_parse->pages;$number = $content_template_parse->number;}?>
                        <?php $n=1;if(is_array($rs)) foreach($rs AS $r) { ?>
                        <a href="<?php echo $r['url'];?>" class="list-group-item_gr active"><span class="badge_top"><?php echo str_pad($n, 2, "0", STR_PAD_LEFT);?> </span>&nbsp;<?php echo strcut($r['title'],36);?></a>
                        <?php $n++;}?>
                        <?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
                    </div>
                </div>
                <div class="right_hot">
                    <h4>热门推荐</h4>
                    <div class="list-group">
                        <?php if(defined('IN_ADMIN') && !defined('HTML')) {
	echo "<div class=\"visual_div\" pc_action=\"content\" data=\"\"><a href=\"javascript:void(0)\" class=\"visual_edit\">修改</a>";
}
if(!class_exists('content_template_parse')) {
	$content_template_parse = load_class("content_template_parse", "content");
}
if (method_exists($content_template_parse, 'block')) {
	$rs = $content_template_parse->block(array('type'=>'1','blockid'=>'15','cid'=>$cid,'start'=>'0','pagesize'=>'10','page'=>'0',));
	$pages = $content_template_parse->pages;$number = $content_template_parse->number;}?>
                        <?php $n=1;if(is_array($rs)) foreach($rs AS $r) { ?>
                        <a href="<?php echo $r['url'];?>" class="list-group-item_gr active"><span class="badge_top"><?php echo str_pad($n, 2, "0", STR_PAD_LEFT);?> </span>&nbsp;<?php echo strcut($r['title'],36);?></a>
                        <?php $n++;}?>
                        <?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
                    </div>
                </div>
                <div class="right_hot">
                    <h4>浏览排行</h4>
                    <div class="list-group">
                        <?php if(defined('IN_ADMIN') && !defined('HTML')) {
	echo "<div class=\"visual_div\" pc_action=\"content\" data=\"\"><a href=\"javascript:void(0)\" class=\"visual_edit\">修改</a>";
}
if(!class_exists('content_template_parse')) {
	$content_template_parse = load_class("content_template_parse", "content");
}
if (method_exists($content_template_parse, 'rank')) {
	$rs = $content_template_parse->rank(array('order'=>'monthviews DESC','cid'=>$cid,'start'=>'0','pagesize'=>'10','page'=>'0',));
	$pages = $content_template_parse->pages;$number = $content_template_parse->number;}?>
                        <?php $n=1;if(is_array($rs)) foreach($rs AS $r) { ?>
                        <a href="<?php echo $r['url'];?>" class="list-group-item_gr active"><span class="badge_top"><?php echo str_pad($n, 2, "0", STR_PAD_LEFT);?> </span>&nbsp;<?php echo strcut($r['title'],36);?></a>
                        <?php $n++;}?>
                        <?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
                    </div>
                </div>
            </div>
        </div>
    

    </div>
</div>
<?php if(!isset($siteconfigs)) $siteconfigs=get_cache('siteconfigs'); include T("content","foot",TPLID); ?>