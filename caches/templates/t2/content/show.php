<?php defined('IN_WZ') or exit('No direct script access allowed'); ?><?php if(!isset($siteconfigs)) $siteconfigs=get_cache('siteconfigs'); include T("content","head",TPLID); ?>
<div class="container Site_map"> 当前位置：<a href="<?php echo WEBURL;?>">首页</a><span> &gt; <?php echo catpos($cid);?></span></div>

<div class="bankuai_1 pd5">

    <div class="container">
        <div class="row">
            <div class="col-xs-8" style="border-right:1px solid #eee">
                <div class="content_title"><?php echo $title;?></div>
                <div class="bignewsbox">
                    <div class="Nfoot">
                        <div class="lwd">时间：<?php echo $addtime;?>&nbsp;&nbsp; 来源：<?php echo $copyfrom;?></div>
                    </div>
                </div>
                <div class="content_p">
                    <?php echo $content;?>
                </div>
                <?php if($content_pages) { ?>
                <div class="page-ination">
                    <div class="page-in">
                        <ul class="clearfix">
                            <?php echo $content_pages;?>
                        </ul>
                    </div>
                </div><?php } ?>
                <?php if($keywords) $keyword = implode(',',$keywords);?>
                <?php if(defined('IN_ADMIN') && !defined('HTML')) {
	echo "<div class=\"visual_div\" pc_action=\"content\" data=\"\"><a href=\"javascript:void(0)\" class=\"visual_edit\">修改</a>";
}
if(!class_exists('content_template_parse')) {
	$content_template_parse = load_class("content_template_parse", "content");
}
if (method_exists($content_template_parse, 'relation')) {
	$rs = $content_template_parse->relation(array('cid'=>$cid,'id'=>$id,'keywords'=>$keyword,'order'=>'id ASC','start'=>'0','pagesize'=>'5','page'=>'0',));
	$pages = $content_template_parse->pages;$number = $content_template_parse->number;}?>
                <?php if(!empty($rs)) { ?>相关内容：<br>
                <?php $n=1;if(is_array($rs)) foreach($rs AS $r) { ?>
                <a href="<?php echo $r['url'];?>"><?php echo $r['title'];?></a> <?php echo time_format($r['addtime']);?>
                <?php $n++;}?>
                <hr>
                <?php } ?>
                <?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>

                <?php if($previous_page['url']) { ?>上一篇： <a class="f_pre" href="<?php echo $previous_page['url'];?>#top"><?php echo strcut($previous_page['title'],40);?></a> <br><?php } ?>
                <?php if($next_page['url']) { ?>下一篇： <a class="f_next" href="<?php echo $next_page['url'];?>#top"><?php echo strcut($next_page['title'],40);?></a><?php } ?>
<hr>


                <!--高速版，加载速度快，使用前需测试页面的兼容性-->
                <div id="SOHUCS"></div>
                <script>
                    (function(){
                        var appid = 'cyrKWBFTI',
                                conf = 'prod_51cde46e252516e5a1da7093b8db4c12';
                        var doc = document,
                                s = doc.createElement('script'),
                                h = doc.getElementsByTagName('head')[0] || doc.head || doc.documentElement;
                        s.type = 'text/javascript';
                        s.charset = 'utf-8';
                        s.src =  'http://assets.changyan.sohu.com/upload/changyan.js?conf='+ conf +'&appid=' + appid;
                        h.insertBefore(s,h.firstChild);
                        window.SCS_NO_IFRAME = true;
                    })()
                </script>

            </div>
            <div class="col-xs-4">
                <div class="rightad_boxg"></div>
                <div class="right_hot" id="righthot">
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
<script type="text/javascript" src="<?php echo WEBURL;?>index.php?f=stat&id=<?php echo $id;?>&cid=<?php echo $cid;?>"></script>
<?php if(!isset($siteconfigs)) $siteconfigs=get_cache('siteconfigs'); include T("content","foot",TPLID); ?>