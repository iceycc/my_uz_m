<?php defined('IN_WZ') or exit('No direct script access allowed'); ?><?php if(!isset($siteconfigs)) $siteconfigs=get_cache('siteconfigs'); include T("member","head"); ?>
<style type="text/css">
    .table_form tr{line-height: 3.2}
</style>
<div class="container membercenter">
    <div class="row">
        <div class="span3 memberleft">
            <?php if(!isset($siteconfigs)) $siteconfigs=get_cache('siteconfigs'); include T('member','left'); ?>
        </div>
        <div class="memberright">

            <div class="memberframe order">
                <div class="memberinfotitle"><h4>修改密码</h4></div>
                <div id="formdiv">
                    <form name="myform" action="" method="post" id="myform" onsubmit="return formsubmit();">
                        <table width="100%" cellspacing="0" class="table_form">

                            <tr>
                                <th width="150" align="right">旧密码：</th>
                                <td><input name="oldpassword" type="password" size="30" value=""  class="input-text" /></td>
                            </tr>

                            <tr>
                                <th align="right">新密码：</th>
                                <td><input name="password" type="password" size="30" value=""  class="input-text" /></td>
                            </tr>
                            <tr>
                                <th align="right">新密码确认：</th>
                                <td><input name="password2" type="password" size="30" value=""  class="input-text" /></td>
                            </tr>
                            <tr>
                                <th align="right">验证码：</th>
                                <td>
                                    <input type="text" id="Verificationcode" name="checkcode" class="form-control" placeholder="验证码" onfocus="javascript:document.getElementById('code_img').src='<?php echo WEBURL;?>api/identifying_code.php?w=110&h=40&rd='+Math.random();void(0);"> <img src="<?php echo R;?>images/logincode.gif" id="code_img" alt="点击刷新" onclick="javascript:this.src='<?php echo WEBURL;?>api/identifying_code.php?rd='+Math.random();void(0);">

                                </td>
                            </tr>
                            <tr>
                                <td></td>
                                <td colspan="2"><label>
                                    <input type="submit" name="submit" id="dosubmit" value="确 定" class="btn btn-submit"/>
                                </label></td>
                            </tr>
                        </table>
                    </form>
                </div>


            </div>
        </div>
    </div>


</div>
<style type="text/css">
    .payment-show .payment-desc {
        color: #999;
        display: block;
        overflow: auto;
    }
    .table_form {
        width: 980px;
        margin: auto;
    }

</style>

<script type="text/javascript">
    function formsubmit() {

        myform.submit();
    }
</script>
<?php if(!isset($siteconfigs)) $siteconfigs=get_cache('siteconfigs'); include T("member","foot"); ?>