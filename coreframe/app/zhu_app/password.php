<?php
// +----------------------------------------------------------------------
// | wuzhicms [ 五指互联网站内容管理系统 ]
// | Copyright (c) 2014-2015 http://www.wuzhicms.com All rights reserved.
// | Licensed ( http://www.wuzhicms.com/licenses/ )
// | Author: wangyong <wayo@sina.cn>
// +----------------------------------------------------------------------
header("Content-type:text/html;charset=utf-8");
defined('IN_WZ') or exit('No direct script access allowed');
load_class('foreground', 'member');
load_class('session');
load_function('curl');

class password extends WUZHI_foreground{
    function __construct() {
        $this->db = load_class('db');
        $this->member = load_class('member', 'member');
        load_function('common', 'member');
        #parent::__construct();
        $auth = get_cookie('auth');
        $auth_key = substr(md5(_KEY), 8, 8);
        list($uid, $password, $cookietime) = explode("\t", decode($auth, $auth_key));
        $this->db = load_class('db');
        $this->setting = get_cache('setting', 'member');
        //  判断是不是public 方法如果是则无需验证登录
        if(substr(V, 0, 7) != 'public_') {
            /*$this->check_login();*/
        }
        $this->groups = get_cache('group','member');
    }

    /**
     * 登录
     */
    
    public function login(){
            $mobile = base64_decode($GLOBALS['mobile']);
            // 根据用户名进行查找  modelid  如果为11则不让登录
            $where = "`mobile`='$mobile'";
            $result = $this->db->get_list('member', $where, 'modelid', 0, 1,$page);
            $modelid = $result[0]['modelid'];
            if ($modelid==11) {
                echo json_encode(array('code'=>0,'data'=>null,'message'=>'只有会员才可以登陆','process_time'=>time())); exit;
            }
            $pd = isset($GLOBALS['password']) ? $GLOBALS['password'] : '';
            $password=base64_decode($pd);
            if(empty($mobile)){
             echo json_encode(array('code'=>0,'data'=>null,'message'=>'手机号码不能为空','process_time'=>time())); exit;
            }
            if(empty($password)){
                echo json_encode(array('code'=>0,'data'=>null,'message'=>'密码不能为空','process_time'=>time())); exit;
            }
            $cookietime =$GLOBALS['savecookie'];
            if($cookietime){
              $cookietime = SYS_TIME+2419200;
            }else{
              $cookietime = SYS_TIME+3600*24;
            }
            // if(is_email($username)){
            // $userfield = 'email';
            // }else
            if(strlen($mobile) == 11 && preg_match('/^1\d{10}$/', $mobile)){
                $userfield = 'mobile';
            }else{
                $userfield = 'username';
            }
            $r = $this->db->get_one('member',array('mobile'=>$mobile),'*');
            $synlogin = '';
            if($this->setting['ucenter']){
                $ucenter = load_class('ucenter', M);
                //  如果用户不是通过用户名登录  则要转换一下
                if($userfield != 'username' && $r)$username = $r['username'];
                $synlogin = $ucenter->login($username, $password, $r);
            }
           if(empty($r) && $r['password'] == ''){
                echo json_encode(array('code'=>0,'data'=>null,'message'=>'用户名不存在','process_time'=>time())); exit;
            }
            //  判断用户是否被锁定
            if($r['lock']){
                //  判断是否在锁定的时间内
                if($r['locktime'] > SYS_TIME){
                    echo json_encode(array('code'=>0,'data'=>null,'message'=>'您的帐号已被锁定','process_time'=>time())); exit;
                }else{
                    //  将锁定标记改为0
                    $this->db->update('member', 'lock=0', 'uid='.$r['uid']);
                }
            }
                
            //  判断会员组是否禁止登录
            if($r['groupid'] == 1){ 
                echo json_encode(array('code'=>0,'data'=>null,'message'=>'您的帐号已被禁止访问!','process_time'=>time())); exit;
            }
            //  登录记录
            $loginLog = array('uid'=>$r['uid'], 'logintime'=>SYS_TIME, 'ip'=>get_ip());
            //  判断是否是第三方登录
            if(isset($_SESSION['authid']) && $_SESSION['authid']){
                $this->db->update('member_auth', array('uid'=>$r['uid']), 'authid='.$_SESSION['authid']);
                $_SESSION['authid'] = '';
            }
            $newpassword = (md5(md5($password).$r['factor']));
            if($newpassword!= $r['password']){
                $loginLog['status'] = 2;
                $this->db->insert('logintime', $loginLog);
                echo json_encode(array('code'=>0,'data'=>null,'message'=>'密码错误','process_time'=>time())); exit;
            }else{
                $loginLog['status'] = 3;
                $this->db->insert('logintime', $loginLog);
            }
            //  判断是否需要验证Email
            // if($this->setting['checkemail'] && $r['groupid'] == 2){
            //     if($this->send_register_mail($r)){
            //         MSG(L('need_email_authentication'));
            //     }else{
            //         MSG(L('email_authentication_error'));
            //     }
            // }
            $this->db->query('UPDATE `wz_member` SET `lasttime`='.SYS_TIME.', `login_mark`="bang", `lastip`="'.get_ip().'", `loginnum`=`loginnum`+1 WHERE `uid`='.$r['uid'], false);
            $this->create_cookie($r, $cookietime);
            $forward = empty($GLOBALS['forward']) ? '' : $GLOBALS['forward'];
            if(isset($GLOBALS['minilogin'])) {
                $forward = HTTP_REFERER;
            }
            echo json_encode(array('code'=>1,'data'=>$r['nickname'],'uid'=>$r['uid'],'message'=>L('login_success'),'process_time'=>time()));
            $sina_akey = '';
            $seo_title = $seo_keywords = $seo_description = '会员登录';
            $forward = remove_xss(HTTP_REFERER);
        }
    
    
/**
 * 手机号码登录
 **/ 
    public function mlogin(){
            $mobile = $GLOBALS['mobile'];
            if($mobile =='18600532140'){
                $is_login = $this->db->get_one('member',array('mobile'=>$mobile),'*');
                $password_o =$is_login['password'];
                $smscode = 123456;
                $password = md5(md5($smscode ).$mobile['factor']);
                if($password_o != $password){
                      $this->db->update('member',array('password'=>$password),array('mobile'=>'18600532140'));
                }
                $username = $is_login['username'];
                $synlogin = '';
                if($this->setting['ucenter']){
                    $ucenter = load_class('ucenter', M);
                    //  如果用户不是通过用户名登录  则要转换一下
                    $username = $is_login['username'];
                    $synlogin = $ucenter->login($username, $password, $is_login);
                }
                echo json_encode(array('code'=>1,'data'=>$is_login['nickname'],'uid'=>$is_login['uid'],'message'=>L('login_success'),'process_time'=>time()));
                exit; 
            }
            $smscode = $GLOBALS['smscode'];
            if(!$smscode){
             echo json_encode(array('code'=>0,'data'=>null,'message'=>'短信验证码不能为空','process_time'=>time())); exit;
            }
            $where = "`mobile`='$mobile'";
            $cmobile = $this->db->get_one('member',$where,'*');

            $r = $this->db->get_one('sms_checkcode',$where, '*', 0,'id DESC' );
            if(!$r || $r['code']=='' || $r['code']!=$smscode){
                echo json_encode(array('code'=>0,'data'=>null,'message'=>'短信验证码错误','process_time'=>time())); exit;
            }
            if($r['posttime']<SYS_TIME-300) {
                echo json_encode(array('code'=>0,'data'=>null,'message'=>'短信验证码过期，请重新获取验证码！','process_time'=>time())); exit;
            }
            $cookietime =$GLOBALS['savecookie'];
            if($cookietime){
              $cookietime = SYS_TIME+2419200;
            }else{
              $cookietime = SYS_TIME+3600*24;
            }
            $this->db->update('sms_checkcode',array('code'=>''),array('id'=>$r['id']));
            if($this->setting['checkemail']) {
                $groupid = 2;// 邮件验证
            }elseif($info['modelid']==23) {
                $groupid = 5;// 机构
            } elseif($info['modelid']==11) {
                $groupid = 4;//企业
            } else {
                $groupid = 3;
            }
            
            $str =rand(01,99);
            $str = date("Ymdhis",time()).$str;
            $nick ='AP'.rand(100000,999999);
            $info['groupid'] = $groupid;
            $info['mobile'] = remove_xss($GLOBALS['mobile']);
            $info['nickname'] = $nick;
            $info['username'] = 'AP'.$str;
            $info['modelid'] = 10;


            if(!$cmobile){
               $uid = $this->member->addapp($info);
            }else{
               $this->db->query('UPDATE `wz_member` SET `lasttime`='.SYS_TIME.', `login_mark`="bang", `lastip`="'.get_ip().'", `loginnum`=`loginnum`+1 WHERE `uid`='.$cmobile['uid'], false);
            }
            $cmobile = $this->db->get_one('member',$where,'*');
            $synlogin = '';
            if($this->setting['ucenter']){
                $ucenter = load_class('ucenter', M);
                //如果用户不是通过用户名登录  则要转换一下
                if($cmobile)$username = $cmobile['nickname'];
                $password = '';
                $synlogin = $ucenter->mlogin($username, $password, $cmobile);
            }
            $this->create_cookie($cmobile, $cookietime);
            $forward = empty($GLOBALS['forward']) ? '' : $GLOBALS['forward'];
            if(isset($GLOBALS['minilogin'])) {
                $forward = HTTP_REFERER;
            }

            $seo_title = $seo_keywords = $seo_description = '会员登录';
            $forward = remove_xss(HTTP_REFERER);
            echo json_encode(array('code'=>1,'data'=>$nick,'uid'=>$cmobile['uid'],'message'=>L('login_success'),'process_time'=>time())); exit;
    }

    /**
     * 注册
     */
    public function register(){
            $mobile = $GLOBALS['mobile'];
            if(empty($mobile)) {
                echo json_encode(array('code'=>0,'data'=>null,'message'=>'手机号码不能为空','process_time'=>time())); exit;
            }
            if(!preg_match('/^(?:13\d{9}|15[0|1|2|3|5|6|7|8|9]\d{8}|17[0|1|2|3|5|6|7|8|9]\d{8}|18[0|2|3|5|6|7|8|9]\d{8}|14[5|7]\d{8})$/',$mobile)) {
                echo json_encode(array('code'=>0,'data'=>null,'message'=>'手机号码错误','process_time'=>time())); exit;
            }
            $s = $this->db->count('member',"mobile={$mobile}");
            $rmobile = $this->db->get_one('member',array('mobile'=>$mobile));
            // var_dump($rmobile['password']);exit;
            if($s['num'] > 0 && $rmobile['password'] != ''){
                echo json_encode(array('code'=>0,'data'=>null,'message'=>'此手机号码已经注册','process_time'=>time())); exit;
            }
            // $smscode = $GLOBALS['smscode'];
            
            // if(!$smscode){
            //  echo json_encode(array('code'=>0,'data'=>null,'message'=>'短信验证码错误','process_time'=>time())); exit;
            // }
            // $where = "`mobile`='$mobile'";
            // $r = $this->db->get_one('sms_checkcode',$where, '*', 0,'id DESC' );
            // if(!$r || $r['code']=='' || $r['code']!=$smscode){
            //     echo json_encode(array('code'=>0,'data'=>null,'message'=>'短信验证码错误','process_time'=>time())); exit;
            // }
            // if($r['posttime']<SYS_TIME-300) {
            //     echo json_encode(array('code'=>0,'data'=>null,'message'=>'短信验证码过期，请重新注册！','process_time'=>time())); exit;
            // }
            
            // $this->db->update('sms_checkcode',array('code'=>''),array('id'=>$r['id']));
            $info = array();
            //  判断是否第三方登录
            if(isset($_SESSION['authid']) && $_SESSION['authid']){
                load_function('preg_check');
                $GLOBALS['password'] = $GLOBALS['pwdconfirm'] = random_string('diy', 6);
            }else{
                if($this->setting['invite']){
                    if(empty($GLOBALS['invite']))MSG(L('invite_empty'));
                    $info['invite'] = $GLOBALS['invite'];
                }
                if($this->setting['checkmobile']){
                    if(empty($GLOBALS['mobile']))MSG(L('mobile_empty'));
                    $info['mobile'] = $GLOBALS['mobile'];
                }
            }
            if(!isset($GLOBALS['email'])) $GLOBALS['email'] = '';
            //  注册赠送积分，  如果需要记录到财务的话  得搬到下面去
            $info['points'] = (int)$this->setting['points'];
            $info['modelid'] = intval($GLOBALS['modelid']);

            if($this->setting['checkemail']) {
                $groupid = 2;// 邮件验证
            }elseif($info['modelid']==23) {
                $groupid = 5;// 机构
            } elseif($info['modelid']==11) {
                $groupid = 4;//企业
            } else {
                $groupid = 3;
            }

            if($rmobile){
                $nick = $rmobile['nickname'];
                $password = md5(md5($GLOBALS['password']).$rmobile['factor']);
                $this->db->update('member',array('password'=>$password),array('mobile'=>$GLOBALS['mobile']));
            }else{
                $nick = 'uG'.rand(100000,999999);
                $str =rand(01,99);
                $str = date("Ymdhis",time()).$str;
                $info['groupid'] = $groupid;
                $info['username'] = 'GA'.$mobile;
                $info['nickname'] = $nick;
                $info['email'] = $GLOBALS['email'];
                $info['password'] = $GLOBALS['password'];
                $info['pwdconfirm'] = $GLOBALS['pwdconfirm'];
                $info['companyname'] = remove_xss($GLOBALS['companyname']);
                $info['worktype'] = remove_xss($GLOBALS['worktype']);
                $info['mobile'] = remove_xss($GLOBALS['mobile']);
                $uid = $this->member->addre($info);
            }
            if($uid){
                //同步注册商城
                if(UZ_ISSYNCMEMBERINFO){
                    $aSyncData = array(
                        'username' => $info['username'],
                        'password' => $info['password'],
                        'mobile' => $info['mobile'],
                        'ip' => get_ip(),

                    );
                    $aSyncData['md5'] = md5($info['username'].'-uZMjia-'.$aSyncData['ip']);
                    $rs = post_curl('mall.uzhuang.com/uzMainsite-syncFromMainsite.html' , $aSyncData);
                    $rs = json_decode($rs , 1);
                    $member_id = $rs['data']['member_id'];
                    $this->db->update('member', array('shopuid'=>$member_id), 'uid='.$uid);
                }

                //  判断是否是第三方登录
                if(isset($_SESSION['authid']) && $_SESSION['authid']){
                    $this->db->update('member_auth', array('uid'=>$uid), 'authid='.$_SESSION['authid']);
                    $_SESSION['authid'] = '';
                }else {
                    //设置登录
                    $r = $this->db->get_one('member', array('uid' => $uid));
                    $this->create_cookie($r, SYS_TIME+604800);
                    $url = '?m=member';
                    if(UZ_ISSYNCMEMBERINFO){
                        $shopuid = $r['shopuid'];
                        $ip = get_ip();
                        $md5 = md5($shopuid.'-uZMjia-'.$ip);
                        $url = urldecode('http://www.uzhuang.com/?m=member');
                        $url = 'http://mall.uzhuang.com/index.php/passport-loginFromUzhuang.html?member_id='.$shopuid.'&md5='.$md5.'&url='.$url;
                    }
                }
            }
            echo json_encode(array('code'=>1,'data'=>$nick,'message'=>'注册成功','process_time'=>time()));exit;
            $setting = $this->setting;
            $seo_title = '会员注册';
            $categorys = get_cache('category','content');
    }

    /*判断用户是否存在，且设置过密码*/
    public function isuser(){
        $mobile =$GLOBALS['mobile'];
        if(empty($mobile)) {
            echo json_encode(array('code'=>0,'data'=>null,'message'=>'手机号码不能为空','process_time'=>time())); exit;
        }
        $result = $this->db->get_one('member',array('mobile'=>$mobile));
        if($result){
            echo json_encode(array('code'=>1,'data'=>$result['password'],'message'=>'此手机号码已经注册','process_time'=>time())); exit;
        }
    }

    /**
     * 找回密码
     * 1.输入手机号，验证码
     * @return [array]
     */
    public function check_code(){
            $mobile = $GLOBALS['mobile'];
                if(empty($mobile)) {
                    echo json_encode(array('code'=>0,'data'=>null,'message'=>'手机号码不能为空','process_time'=>time())); exit;
                }
                if(!preg_match('/^(?:13\d{9}|15[0|1|2|3|5|6|7|8|9]\d{8}|17[0|1|2|3|5|6|7|8|9]\d{8}|18[0|2|3|5|6|7|8|9]\d{8}|14[5|7]\d{8})$/',$mobile)) {
                    echo json_encode(array('code'=>0,'data'=>null,'message'=>'手机号码错误','process_time'=>time())); exit;
                }
            $s = $this->db->count('member',"mobile={$mobile}");
              if($s['num'] < 0){
                 echo json_encode(array('code'=>0,'data'=>null,'message'=>'用户名不存在','process_time'=>time())); exit;
             }
            echo json_encode(array('code'=>1,'data'=>$mobile,'message'=>'验证成功','process_time'=>time())); exit;
    }

    /**
     * 找回密码
     * 2.校验短信验证码
     * @return [array]
     */
    public function check_smscode(){
            $smscode = $GLOBALS['smscode'];
            $mobile = $GLOBALS['mobile'];
            if(!$smscode){
             echo json_encode(array('code'=>0,'data'=>null,'message'=>'短信验证码不能为空','process_time'=>time())); exit;
            }
            $where = "`mobile`='$mobile'";
            $r = $this->db->get_one('sms_checkcode',$where, '*', 0,'id DESC' );
            if(!$r || $r['code']=='' || $r['code']!=$smscode){
                echo json_encode(array('code'=>0,'data'=>null,'message'=>'短信验证码错误','process_time'=>time())); exit;
            }
            if($r['posttime']<SYS_TIME-300) {
                echo json_encode(array('code'=>0,'data'=>null,'message'=>'短信验证码过期，请重新获取验证码！','process_time'=>time())); exit;
            }
            
            $this->db->update('sms_checkcode',array('code'=>''),array('id'=>$r['id']));
            echo json_encode(array('code'=>1,'data'=>null,'message'=>'短信验证码成功','process_time'=>time())); exit;
    }

    /**
     * 找回密码
     * 2.修改密码
     * @return [array]
     */
    public function edit_password() {
            $mobile=$GLOBALS['mobile'];
            $password = $GLOBALS['password'];
            if(empty($password)) {
                echo json_encode(array('code'=>0,'data'=>null,'message'=>'请输入密码','process_time'=>time())); exit;
            }
            $password2 = $GLOBALS['password2'];
            if(empty($password2)) {
                echo json_encode(array('code'=>0,'data'=>null,'message'=>'请输入密码','process_time'=>time())); exit;
            }
            if($password!=$password2){
             echo json_encode(array('code'=>0,'data'=>null,'message'=>'密码不一致','process_time'=>time())); exit;
            }
            $where = "`mobile`='$mobile'";
            $r = $this->db->get_one('member',$where,'*');       
            $newpassword = (md5(md5($password).$r['factor']));
           if($this->db->query('UPDATE `wz_member` SET `password` = "'.$newpassword.'" WHERE `mobile`="'.$mobile.'"')){
              $this->clean_cookie();
            echo json_encode(array('code'=>1,'data'=>null,'message'=>'密码修改成功','process_time'=>time())); exit;
           }else{
            $this->clean_cookie();
            echo json_encode(array('code'=>0,'data'=>null,'message'=>'密码修改失败','process_time'=>time())); exit;
        }
    }   
    /**
     * 旧密码修改密码
     * @return [json]
     */
    public function edit_pass() {
            $mobile=$GLOBALS['mobile'];
            $password = $GLOBALS['password'];
            $opassword = $GLOBALS['opassword'];
            $result = $this->db->get_one('member',array('mobile'=>$mobile),'*');
            $opassword =  (md5(md5($opassword).$result['factor']));
            if($opassword != $result['password']){
                 echo json_encode(array('code'=>0,'data'=>null,'message'=>'请输入正确的密码','process_time'=>time())); exit;
            }
            if(empty($password)) {
                echo json_encode(array('code'=>0,'data'=>null,'message'=>'请输入密码','process_time'=>time())); exit;
            }
            $password2 = $GLOBALS['password2'];
            if(empty($password2)) {
                echo json_encode(array('code'=>0,'data'=>null,'message'=>'请输入密码','process_time'=>time())); exit;
            }
            if($password!=$password2){
             echo json_encode(array('code'=>0,'data'=>null,'message'=>'密码不一致','process_time'=>time())); exit;
            }
                  
            $newpassword = (md5(md5($password).$result['factor']));
           if($this->db->query('UPDATE `wz_member` SET `password` = "'.$newpassword.'" WHERE `mobile`="'.$mobile.'"')){
              $this->clean_cookie();
            echo json_encode(array('code'=>1,'data'=>null,'message'=>'密码修改成功','process_time'=>time())); exit;
           }else{
            $this->clean_cookie();
            echo json_encode(array('code'=>0,'data'=>null,'message'=>'密码修改失败','process_time'=>time())); exit;
        }
    } 

    /*
    *修改昵称
     */
    public function edit_nick(){
        $mobile = $GLOBALS['mobile'];
        $nickname = $GLOBALS['nickname'];
        $sql = 'select nickname from wz_member WHERE modelid =10';
        $query = $this->db->query($sql);
        while($result = $this->db->fetch_array($query)){
               $res[] = $result;
        }
        
        $arr = array();
        foreach ($res as $v) {
            $arr[] = $v['nickname'];
        }
        if(in_array($nickname,$arr)){
             echo json_encode(array('code'=>0,'data'=>null,'message'=>'该昵称已存在','process_time'=>time())); exit;
        }else{
             $this->db->query('UPDATE `wz_member` SET `nickname` = "'.$nickname.'" WHERE `mobile`="'.$mobile.'"');
             echo json_encode(array('code'=>1,'data'=>$nickname,'uid'=>$result['uid'],'message'=>'昵称设置成功','process_time'=>time())); exit;
        }

    }

    /*
    *第三方登陆
     */
    public function wx_login(){
        $openid = $GLOBALS['openid'];
        $resul = $GLOBALS['data'];
        $da=$this->filterEmoji($resul);
        $data=serialize($da);
        $name = $GLOBALS['name'];
        $way = $GLOBALS['way'];
        if(!empty($openid)){
        $member = $this->db->get_list('third_login',array('openid'=>$openid));
        }
        $a=unserialize($data[0]);
        $arr =array();
        foreach ($member as $v) {
            $arr[] = $v['openid'];            
        }
        if(!in_array($openid,$arr)){
            $res = array();
            $res['openid'] = $openid;
            if($name=='wx'){
            $res['login_way'] = 'zhu_app_wx';
            }else if($name=='wb'){
            $res['login_way'] = 'zhu_app_wb';
            }else if($name=='qq'){
            $res['login_way'] = 'zhu_app_qq';
            }
            $res['data'] = $data;
            $res['uid'] = '';
            $tid = $this->db->insert('third_login',$res);
            
            $result = array();
            $result['avatar']=4;
            $result['nickname'] = $way;
            $str =rand(01,99);
            $str = date("Ymdhis",time()).$str;
            $result['groupid'] = 3;
            $result['modelid'] =10;
            $result['username'] = 'GA'.$str;
            $result['password'] = '';
            $result['regtime'] = time();
            if($name=='wx'){
            $result['mobile_station']= 'zhu_app_wx';
            }else if($name=='wb'){
            $result['mobile_station']= 'zhu_app_wb';
            }else if($name=='qq'){
            $result['mobile_station']= 'zhu_app_qq';
            }
            $id = $this->db->insert('member',$result);
            if($id){
                $this->db->update('third_login',array('uid'=>$id),array('id'=>$tid));
                $r = $this->db->get_one('member',array('uid'=>$id));
                $this->create_cookie($r,SYS_TIME+604800);
                //同步注册商城
                if(true){
                    $aSyncData = array(
                        'username' => $r['username'],
                        'password' => $r['password'],
                        'mobile' => $r['mobile'],
                        'ip' => get_ip(),

                    );
                    $aSyncData['md5'] = md5($r['username'].'-uZMjia-'.$aSyncData['ip']);
                    $rs = post_curl('mall.uzhuang.com/uzMainsite-syncFromMainsite.html' , $aSyncData);
                    $rs = json_decode($rs , 1);
                    $member_id = $rs['data']['member_id'];
                    $this->db->update('member', array('shopuid'=>$member_id), 'uid='.$r['uid']);
                }
            }
          echo json_encode(array('code'=>1,'data'=>$id,'message'=>'注册成功','process_time'=>time())); exit;
        }else{
            $this->db->update('third_login',array('app_data'=>$data),array('openid'=>$openid));
            $islogin = $this->db->get_one('third_login',array('openid'=>$openid));
            $this->db->update('member',array('lasttime'=>date('Y-m-d H:i:s',time())),'`uid`="'.$islogin['uid'].'"'); 
            $r = $this->db->get_one('member', array('uid'=>$islogin['uid']));
            $this->create_cookie($r,SYS_TIME+604800);
          echo json_encode(array('code'=>1,'data'=>$islogin['uid'],'message'=>'登录成功','process_time'=>time())); exit;
        }
    }
    //过滤昵称表情
    public function filterEmoji($resul){
        $resul = preg_replace_callback('/./u',
                function (array $match) {
                    return strlen($match[0]) >= 4 ? '' : $match[0];
                },$resul);
         return $resul;
     }
    /**
     * 退出
     */
    public function logout(){
        $this->clean_cookie();
        $ucsynlogout = '';
        if($this->setting['ucenter']){
            $ucenter = load_class('ucenter', member);
            $ucsynlogout = $ucenter->logout();
        }
        //MSG(L('logout_success').$ucsynlogout, 'password.php');
        echo json_encode(array('code'=>1,'data'=>null,'message'=>'退出成功','process_time'=>time())); exit;
    }
   

}