<?php defined('IN_WZ') or exit('No direct script access allowed');?>
<?php
include $this->template('header','core');
?>
<body>
<link href="<?php echo R;?>css/validform.css" rel="stylesheet">
<script src="<?php echo R;?>js/validform.min.js"></script>
<style type="text/css">
    .table_form td{
        padding: 10px;
    }
</style>
<section class="wrapper">
    <!-- page start-->

    <div class="row">
        <div class="col-lg-12">
            <section class="panel">
                <?php echo $this->menu($GLOBALS['_menuid']);?>
                <div class="panel-body">
                    <form class="form-horizontal tasi-form" method="post" action="">

    <ul id="myTab" class="nav nav-tabs" role="tablist">
      <li role="presentation" class="active"><a href="#tabs1" id="1tab" role="tab" data-toggle="tab" aria-controls="tabs1" aria-expanded="true">基本设置</a></li>
      <li role="presentation" class=""><a href="#tabs2" role="tab" id="2tab" data-toggle="tab" aria-controls="tabs2" aria-expanded="false">生成静态设置</a></li>
      <li role="presentation" class=""><a href="#tabs3" role="tab" id="3tab" data-toggle="tab" aria-controls="tabs3" aria-expanded="false">模板设置</a></li>
      <li role="presentation" class=""><a href="#tabs4" role="tab" id="4tab" data-toggle="tab" aria-controls="tabs4" aria-expanded="false">SEO设置</a></li>
        </ul>
      </li>
    </ul>

    <div id="myTabContent" class="tab-content">
      <div role="tabpanel" class="tab-pane fade active in" id="tabs1" aria-labelledby="1tab">
        <div class="form-group">
                            <label class="col-sm-2 col-xs-4 control-label">请选择模型</label>
                            <div class="col-lg-3 col-sm-4 col-xs-4 input-group">
                                <?php

                                echo $form->select(key_value($models,'modelid','name'), $r['modelid'], 'name="form[modelid]" class="form-control" datatype="*" errormsg="请选择模型！"',"≡ 请选择模型 ≡");

                                ?>

                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 col-xs-4 control-label">上级栏目</label>
                            <div class="col-lg-3 col-sm-4 col-xs-4 input-group">
                                <?php

                                echo $form->tree_select($categorys, $r['pid'], 'name="form[pid]" class="form-control" onchange="check_parent(this.value)"', '≡ 无上级栏目 ≡',$cid);

                                ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 col-xs-4 control-label">栏目名称</label>
                            <div class="col-lg-3 col-sm-4 col-xs-4 input-group">
                        <input type="text" class="form-control" id="name" name="form[name]" value="<?php echo $r['name'];?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 col-xs-4 control-label">英文目录</label>
                            <div class="col-lg-3 col-sm-4 col-xs-4 input-group">
                                <input type="text" class="form-control" id="catdir" name="form[catdir]" value="<?php echo $r['catdir'];?>">

                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 col-xs-4 control-label">栏目图片</label>
                            <div class="col-lg-3 col-sm-4 col-xs-4 input-group">
                                <div class="input-group"><?php echo $form->attachment('','1','form[thumb]',$r['thumb']);?></div>
                            </div>
                        </div>

                          <div class="form-group">
                              <label class="col-sm-2 col-xs-4 control-label">栏目icon</label>
                              <div class="col-lg-3 col-sm-4 col-xs-4 input-group">
                                  <div class="input-group"><?php echo $form->attachment('','1','form[icon]',$r['icon']);?></div>
                              </div>
                          </div>

                        <div class="form-group">
                            <label class="col-sm-2 col-xs-4 control-label">工作流</label>
                            <div class="col-lg-3 col-sm-4 col-xs-4 input-group">
                                <?php

                                echo $form->select(key_value($workflow,'workflowid','name'), $r['workflowid'], 'name="form[workflowid]" class="form-control"', '≡ 无需审核 ≡');

                                ?>
                            </div>
                        </div>
                        <div class="form-group <?php if($r['pid']) echo 'hide';?>" id="domain-div">
                            <label class="col-sm-2 col-xs-4 control-label">绑定域名</label>
                            <div class="col-lg-3 col-sm-4 col-xs-4 input-group">
                                <input type="text" class="form-control" id="domain" name="form[domain]" value="<?php echo $r['domain'];?>">
                                <span class="help-block"><i class="icon-info-circle"></i> 可绑定任意域名：格式为：http://www.wuzhicms.cn/ ，绑定域名后，生成静态规则将使用默认规则</span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 col-xs-4 control-label">是否在栏目列表处显示</label>
                            <div class="col-lg-3 col-sm-4 col-xs-4 input-group">
                                <label class="radio-inline"><input type="radio" name="form[showloop]" value="1" <?php if($r['showloop']==1) echo "checked";?>> 是</label>
                                <label class="radio-inline"><input type="radio" name="form[showloop]" value="0" <?php if($r['showloop']==0) echo "checked";?>> 否</label>
                            </div>
                        </div>


                        <div class="form-group">
                            <label class="col-sm-2 col-xs-4 control-label">是否在导航中显示</label>
                            <div class="col-lg-3 col-sm-4 col-xs-4 input-group">
                                <label class="radio-inline"><input type="radio" name="form[ismenu]" value="1" <?php if($r['ismenu']) echo "checked";?>> 是</label>
                                <label class="radio-inline"><input type="radio" name="form[ismenu]" value="0" <?php if(!$r['ismenu']) echo "checked";?>> 否</label>
                            </div>
                        </div>
      </div>

      <div role="tabpanel" class="tab-pane fade" id="tabs2" aria-labelledby="2tab">
        <div class="form-group">
                            <label class="col-sm-2 col-xs-4 control-label">栏目页生成静态</label>
                            <div class="col-lg-3 col-sm-4 col-xs-4 input-group">
                                <label class="radio-inline"><input type="radio" name="form[listhtml]" value="1" <?php if($r['listhtml']) echo "checked";?> onclick="change_listhtml(1);"> 是</label>
                                <label class="radio-inline"><input type="radio" name="form[listhtml]" value="0" <?php if(!$r['listhtml']) echo "checked";?> onclick="change_listhtml(0);"> 否</label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 col-xs-4 control-label">内容页生成静态</label>
                            <div class="col-lg-3 col-sm-4 col-xs-4 input-group">
                                <label class="radio-inline"><input type="radio" name="form[showhtml]" value="1" <?php if($r['showhtml']) echo "checked";?> onclick="change_showhtml(1);"> 是</label>
                                <label class="radio-inline"><input type="radio" name="form[showhtml]" value="0" <?php if(!$r['showhtml']) echo "checked";?> onclick="change_showhtml(0);"> 否</label>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 col-xs-4 control-label">栏目页URL规则</label>
                            <div class="col-lg-7 col-sm-7 col-xs-7 input-group">
                                <input type="text" class="form-control" id="listurl" name="form[listurl]" value="<?php echo $r['listurl'];?>">
                                <div class="input-group-btn">
                                    <button type="button" class="btn btn-white dropdown-toggle" data-toggle="dropdown">选择规则 <span class="caret"></span></button>
                                    <ul id="phpurlruleid" class="dropdown-menu pull-right <?php if($r['listhtml']) echo "hide";?>"">
                                        <li><a href="javascript:;" onclick="htmlit('index.php?v=listing&cid={$cid}|index.php?v=listing&cid={$cid}&page={$page}','listurl');">动态地址：index.php?v=listing&cid=1&page=1</a></li>
                                        <li><a href="javascript:;" onclick="htmlit('list-{$cid}-{$page}.html','listurl');">伪静态：list-1-10000.html</a></li>
                                    </ul>
                                    <ul id="htmlurlruleid" class="dropdown-menu pull-right <?php if(!$r['listhtml']) echo "hide";?>"">
                                        <li><a href="javascript:;" onclick="htmlit('{$categorydir}/{$cid}/index.html|{$categorydir}/{$cid}/{$page}.html','listurl');">news/1001/1.html</a></li>
                                        <li><a href="javascript:;" onclick="htmlit('{$catdir}/index.html|{$catdir}/{$page}.html','listurl');">download/1.html</a></li>
                                        <li><a href="javascript:;" onclick="htmlit('{$categorydir}/{$catdir}/index.html|{$categorydir}/{$catdir}/{$page}.html','listurl');">download/free/1.html</a></li>

                                    </ul>

                                </div>
                            </div>

                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 col-xs-4 control-label">内容页URL规则</label>
                            <div class="col-lg-7 col-sm-7 col-xs-7 input-group">
                                <input type="text" class="form-control" id="showurl" name="form[showurl]" value="<?php echo $r['showurl'];?>">
                                <div class="input-group-btn">
                                    <button type="button" class="btn btn-white dropdown-toggle" data-toggle="dropdown">选择规则 <span class="caret"></span></button>
                                    <ul id="phpurlruleid2" class="dropdown-menu pull-right <?php if($r['showhtml']) echo "hide";?>">
                                        <li><a href="javascript:;" onclick="htmlit('index.php?v=show&cid={$cid}&id={$id}|index.php?v=show&cid={$cid}&id={$id}&page={$page}','showurl');">动态地址：index.php?v=show&cid=1&id=1&page=1</a></li>
                                        <li><a href="javascript:;" onclick="htmlit('item-{$cid}-{$id}-{$page}.html','showurl');">伪静态：item-1-1-1.html</a></li>
                                        <li><a href="javascript:;" onclick="htmlit('show-{$cid}-{$id}-{$page}.html','showurl');">伪静态：show-1-1-1.html</a></li>

                                    </ul>
                                    <ul id="htmlurlruleid2" class="dropdown-menu pull-right <?php if(!$r['showhtml']) echo "hide";?>" "">
                                        <li><a href="javascript:;" onclick="htmlit('{$year}/{$cid}/{$id}.html|{$year}/{$cid}/{$id}-{$page}.html','showurl');">2014/1001/1-1.html</a></li>
                                        <li><a href="javascript:;" onclick="htmlit('{$year}/{$catdir}_{$month}{$day}/{$id}.html|{$year}/{$catdir}_{$month}{$day}/{$id}_{$page}.html','showurl');">2014/dir_1010/1_2.html</a></li>
                                        <li><a href="javascript:;" onclick="htmlit('{$categorydir}/{$catdir}/{$year}/{$month}{$day}/{$id}.html|{$categorydir}/{$catdir}/{$year}/{$month}{$day}/{$id}_{$page}.html','showurl');">parentdir/dir/2014/0101/1_1.html</a></li>

                                    </ul>

                                </div>
                            </div>

                        </div>
                        
      </div>

      <div role="tabpanel" class="tab-pane fade" id="tabs3" aria-labelledby="3tab">
      <div class="form-group">
                            <label class="col-sm-2 col-xs-4 control-label">大栏目页模版</label>
                            <div class="col-lg-3 col-sm-4 col-xs-4 input-group">
                                <?php
                                echo $form->templates('content', $r['category_template'],'name="form[category_template]" class="form-control"');
                                ?>

                            </div>
                        </div>




                        <div class="form-group">
                            <label class="col-sm-2 col-xs-4 control-label">终级栏目页模版</label>
                            <div class="col-lg-3 col-sm-4 col-xs-4 input-group">

                                <?php
                                echo $form->templates('content', $r['list_template'],'name="form[list_template]" class="form-control"');
                                ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 col-xs-4 control-label">内容页模版</label>
                            <div class="col-lg-3 col-sm-4 col-xs-4 input-group">
                                <?php
                                echo $form->templates('content', $r['show_template'],'name="form[show_template]" class="form-control"');
                                ?>
                            </div>
                        </div>

      </div>

      <div role="tabpanel" class="tab-pane fade" id="tabs4" aria-labelledby="4tab">
      <div class="form-group">
                            <label class="col-sm-2 col-xs-4 control-label">SEO 标题</label>
                            <div class="col-lg-3 col-sm-4 col-xs-4 input-group">
                                <input type="text" class="form-control" name="form[seo_title]" value="<?php echo $r['seo_title'];?>">
                            </div>
                        </div>


                        <div class="form-group">
                            <label class="col-sm-2 col-xs-4 control-label">SEO 关键字</label>
                            <div class="col-lg-3 col-sm-4 col-xs-4 input-group">
                                <input type="text" class="form-control" name="form[seo_keywords]" value="<?php echo $r['seo_keywords'];?>">
                            </div>
                        </div>


                        <div class="form-group">
                            <label class="col-sm-2 col-xs-4 control-label">SEO 网页描述</label>
                            <div class="col-lg-3 col-sm-4 col-xs-4 input-group">
                                <input type="text" class="form-control" name="form[seo_description]" value="<?php echo $r['seo_description'];?>">
                            </div>
                        </div>
      </div>
    </div> 

                        <div class="form-group">
                            <label class="col-sm-2 col-xs-4 control-label"></label>
                            <div class="col-lg-3 col-sm-4 col-xs-4 input-group">
                                <input type="hidden" name="type" value="<?php echo $r['type'];?>">
                                <input class="btn btn-info col-sm-12 col-xs-12" type="submit" name="submit" value="提交">
                            </div>
                        </div>
                    </form>
                </div>
            </section>
        </div>
    </div>
    <!-- page end-->
</section>
<script src="<?php echo R;?>js/bootstrap.min.js"></script>
<script src="<?php echo R;?>js/jquery.nicescroll.js" type="text/javascript"></script>
<script src="<?php echo R;?>js/pxgrids-scripts.js"></script>

<script type="text/javascript">
$(function(){
    $(".form-horizontal").Validform({
        tiptype:3
    });
})

function htmlit(value,id) {
    $("#"+id).val(value);
}
function change_listhtml(type) {
    if(type==1) {
       $("#htmlurlruleid").removeClass('hide');
       $("#phpurlruleid").addClass('hide');
        $("#listurl").val('{$categorydir}/{$catdir}/index.html|{$categorydir}/{$catdir}/{$page}.html');
    } else {
        $("#htmlurlruleid").addClass('hide');
        $("#phpurlruleid").removeClass('hide');
        $("#listurl").val('index.php?v=listing&cid={$cid}');
    }
}
function change_showhtml(type) {
    if(type==1) {
        $("#htmlurlruleid2").removeClass('hide');
        $("#phpurlruleid2").addClass('hide');
        $("#showurl").val('{$year}/{$cid}/{$id}.html|{$year}/{$cid}/{$id}-{$page}.html');
    } else {
        $("#htmlurlruleid2").addClass('hide');
        $("#phpurlruleid2").removeClass('hide');
        $("#showurl").val('index.php?v=show&cid={$cid}&id={$id}');
    }
}
function check_parent(value) {
    if(value==0) {
        $("#domain-div").removeClass('hide');
    } else {
        $("#domain-div").addClass('hide');
    }
}
</script>
