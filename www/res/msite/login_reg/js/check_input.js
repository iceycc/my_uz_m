// 2015-12-01
function checkPhone(number) {
	var user_id = number;
	if(user_id == "")
	{
		showTip("请输入用户名");
		return false;
	}
    if(!isNaN(user_id)){
		//Number length is 11 ，First number is 1
        var tel = /^1[3|4|5|7|8|9][0-9]\d{8}$/;
        if(!tel.test(user_id)) {
			showTip("您输入的手机号格式不正确");
            return false;
        }
		else {
			return true;
		}
    }
    else {
		if(escape(user_id).indexOf( "%u" )<0)
		{
			if(user_id.length>2 && user_id.length<21)
			{
			    return true ;
			}
			else {
				showTip("您输入的用户名格式不正确");
			}
	    }
	    else
	    {
            showTip("您输入的用户名格式不正确");
            return false ;
	    }
    }
}
function checkPwd(pwd) {
	var user_pwd = pwd;
	if(user_pwd == "")
	{
		showTip("请输入密码");
		return false;
	}
	if(escape(user_pwd).indexOf( "%u" )<0) 
	{
		if(user_pwd.length>5 && user_pwd.length<21)
		{
			return true ;	
		}
		else {
			showTip("您输入的密码格式不正确");
		}
	}
}

/**
 * 删除左右两端的空格
 */
String.prototype.trim=function()
{
    return this.replace(/(^\s*)|(\s*$)/g, "");
}
/*
 *     	time		1017-07-31
 *		author		zhaorong
 *
 *		check log in phone number
 */
function checkFormPhone(uname) {
	var userId = uname.trim();
    if(userId == "")
    {
        showTip("请输入手机号");
        return false;
    }
    if(!isNaN(userId)){
        //Number length is 11 ，First number is 1
        var tel = /^1[3|4|5|7|8|9][0-9]\d{8}$/;
        if(!tel.test(userId)) {
            showTip("您输入的手机号格式不正确");
            return false;
        }
        else {
            return true;
        }
    }
}
/*
 *     	time		1017-07-31
 *		author		zhaorong
 *
 *		check log in message
 */
function captCha(message) {
	var mesg = message.trim();
    if(mesg == "")
    {
        showTip("请输入验证码");
        return false;
    }
    if(!isNaN(mesg)){
		return true;
	}else{
        showTip("验证码格式有误请重新输入");
    	return false;
	}
}