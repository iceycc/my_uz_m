<?php defined('IN_WZ') or exit('No direct script access allowed');?>
<?php include $this->template('header','core');?>
<body class="login-body">
<div class="container fadeInDown">
    <form class="form-signin" id="form_login" action="index.php?m=core&f=index&v=login<?php echo $this->su();?>" method="post" onsubmit="return checkform();" >
        <div class="form-signin-heading"></div>
        <div class="login-wrap">
            <div class="loginlogo center"><h2 style="font-family:楷体;font-weight:bold;">优装美家移动端平台</h2></div>
            <div class="form-group">
                <div class="input-group" id="username_error">
                    <div class="input-group-addon">
                        <i class="icon-user"></i>
                    </div>
                    <input type="text" class="form-control" name="username" id="username" placeholder="用户名" autocomplete="off" autofocus>
                </div>
            </div>
            <div class="form-group">
                <div class="input-group" id="password_error">
                    <div class="input-group-addon">
                        <i class="icon-key5"></i>
                    </div>
                    <input type="password" class="form-control" name="password" id="password" placeholder="密码" autocomplete="off">
                </div>
            </div>
            <div class="form-group">
                <div class="input-group" id="codeid_error">
                    <div class="input-group-addon">
                        <i class="icon-qrcode"></i>
                    </div>
                    <input type="text" id="codeid" name="checkcode" class="form-control" placeholder="验证码" onfocus="javascript:document.getElementById('code_img').src='<?php echo WEBURL;?>index.php?m=core&f=identifying_code&rd='+Math.random();void(0);">
                    <div class="input-group-addon" id="logincode">
                        <img src="<?php echo R;?>images/logincode.gif" id="code_img" alt="点击刷新" onclick="javascript:this.src='<?php echo WWW_PATH;?>index.php?m=core&f=identifying_code&rd='+Math.random();void(0);">
                    </div>
                </div>
            </div>
            <button type="submit" name="submit" class="btn btn-shadow btn-danger btn-block btn-login">登 录</button>
        </div>
        <div class="form-signin-bottom center">Copyright &copy; 2015  www.uzhuang.com <a href="http://www.uzhuang.com/" target="_blank">北京优装网信息科技有限公司 版权所有</a></div>
    </form>
</div>
<script src="<?php echo R;?>js/bootstrap.min.js"></script>
<script src="<?php echo R;?>js/focuse.js"></script>
<script type="text/javascript">
   function addclass_slide(id,errid,classname) {
       $('#'+id).animate({
           opacity: 'show'
       }, 1000,function() {
           $('#'+errid).addClass(classname);
       });


   }
   function checkform() {
       $('#username_error').removeClass('validate-has-error');
       $('#password_error').removeClass('validate-has-error');
       $('#codeid_error').removeClass('validate-has-error');
        if($('#username').val()=='') {
           addclass_slide('username','username_error','validate-has-error');
           $('#username').focus();
           return false;
        }
       if($('#password').val()=='') {
           addclass_slide('password','password_error','validate-has-error');
           $('#password').focus();
           return false;
       }
       if($('#codeid').val()=='') {
           addclass_slide('codeid','codeid_error','validate-has-error');
           $('#codeid').focus();
           return false;
       }
}



$(function(){

  if(top.location.href != self.location.href){
      $('#form_login').attr('target','top');
  }

});
</script>
</body>
</html>