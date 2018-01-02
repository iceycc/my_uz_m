<?php defined('IN_WZ') or exit('No direct script access allowed'); ?><?php if(!isset($siteconfigs)) $siteconfigs=get_cache('siteconfigs'); include T('member','head'); ?>
<div class="container membercenter">
    <div class="row">
        <div class="span3 memberleft">
<?php if(!isset($siteconfigs)) $siteconfigs=get_cache('siteconfigs'); include T('member','left'); ?>
        </div>
        <div class="memberright">
            <div class="memberframe order">
                <div class="memberinfotitle"><h4>预约体检</h4></div>
                <div class="orderstate"><strong>填写体检人信息：</strong></div>
                <form name="myform" action="" method="post" id="myform" onsubmit="return formsubmit();">
                    <table width="100%" cellspacing="0" class="table_form">
                        <tr>
                            <th width="150" align="right">姓名：</th>
                            <td><input name="truename" type="text" id="truename" size="30" value="<?php echo $memberinfo['truename'];?>"  class="input-text"/></td>
                        </tr>
                        <tr>
                            <th width="150" align="right">性别：</th>
                            <td><input name="sex" type="radio" id="sex" value="1"/> 男 <input name="sex" type="radio" id="sex" value="2"/> 女</td>
                        </tr>
                        <tr>
                            <th width="150" align="right">婚姻状况：</th>
                            <td><input name="marriage" type="radio" id="marriage" value="1"/> 已婚 <input name="marriage" type="radio" id="marriage" value="0"/> 未婚</td>
                        </tr>
                        <tr>
                            <th align="right">生日：</th>
                            <td><div class="col-sm-4 input-group"><?php echo WUZHI_form::calendar('info[birthday]', date('Y-m-d', $memberinfo['birthday']), 0);?></div>
                            </td>
                        </tr>
                        <tr>
                            <th align="right">身份证号码：</th>
                            <td><input name="identity_card" type="text" id="identity_card" size="30" value="<?php echo $memberinfo['identity_card'];?>"  class="input-text"/>
                            </td>
                        </tr>
                        <tr>
                            <th align="right">手机：</th>
                            <td><input name="mobile" type="text" id="mobile" size="30" value="<?php echo $memberinfo['mobile'];?>"/></td>
                        </tr>
                        <tr>
                            <th align="right">地址：</th>
                            <td><input name="address" type="text" id="address" size="30" value="<?php echo $memberinfo['address'];?>"/></td>
                        </tr>
                        <tr>
                            <th align="right">E-mail：</th>
                            <td><input name="email" type="text" id="email" size="30" value="<?php echo $memberinfo['email'];?>"  class="input-text"/></td>
                        </tr>
                        <tr>
                            <th align="right">居住城市：</th>
                            <td><input name="livecity" type="text" id="livecity" size="30" value="<?php echo $memberinfo['livecity'];?>"  class="input-text" /></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td colspan="2"><label>
                                <input type="submit" name="submit" id="dosubmit" value="保存体检人信息" class="btn btn-submit"/>
                            </label></td>
                        </tr>
                    </table>
                </form>
            </div>

        </div>
    </div>


</div>
<?php if(!isset($siteconfigs)) $siteconfigs=get_cache('siteconfigs'); include T('member','foot'); ?>
