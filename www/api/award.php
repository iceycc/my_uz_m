<?php
// +----------------------------------------------------------------------
// | wuzhicms [ 五指互联网站内容管理系统 ]
// | Copyright (c) 2014-2015 http://www.wuzhicms.com All rights reserved.
// | Licensed ( http://www.wuzhicms.com/licenses/ )
// | Author: zuofeng
// +----------------------------------------------------------------------
header('Content-type:text/html;charset=utf-8');
header("Access-Control-Allow-Origin: *");
define('WWW_ROOT',substr(dirname(__FILE__), 0, -4).'/');
require '../configs/web_config.php';
require COREFRAME_ROOT.'core.php';
require_once(COREFRAME_ROOT.'app/core/libs/class/Gd.class.php');
require_once(COREFRAME_ROOT.'app/core/libs/class/phpqrcode.php');
$action = $GLOBALS['action'];
$db = load_class('db');
load_class('session');
$mobile = $GLOBALS['mobile'];
$code = $GLOBALS['code'];
$ficode = $GLOBALS['ficode'];
if($action =='logo'){
    logo($db , $mobile , $code);
}elseif($action =='sendsms') {
    sendsms($db , $mobile);
}else if($action =='register') {
    register($db , $mobile , $code , $ficode);
}else if($action == 'logout'){
    logout();
}else if($action == 'reset_datum'){
    reset_datum($db);
}else if($action == 'personage_datum'){
    personage_datum($db);
}else if($action == 'my_friend'){
    my_friend($db);
}
function logo($db , $mobile , $code){
    // $action=verify($db , $mobile , $code);
    $userdata = $db->get_one('award_user','mobile='.$mobile);
	if(!$userdata)
	   echo die(json_encode(array('code'=>0,'arr'=>'手机号不存在','process_time'=>time())));
	$_SESSION['uid'] = $userdata['uid'];
	$_SESSION['username'] = $userdata['username'];
	echo die(json_encode(array('code'=>1,'arr'=>'登录成功','session'=>$_SESSION,'process_time'=>time())));
}//登录api
function register($db , $mobile , $code , $ficode){
	$icode = time();
	$str=R;$newstr = substr($str,0,strlen($str)-5);
	$invitation_code = $GLOBALS['invitation_code'];
	$m = $db->get_one('award_user','mobile ='.$mobile);
	if($db->get_one('award_user','mobile ='.$mobile))
		die(json_encode(array('code'=>1,'arr'=>'手机号已注册','process_time'=>time())));
    $action=verify($db , $mobile , $code);
	$arr['mobile'] = $mobile;
	$arr['username'] = $mobile;
	$arr['time'] = time();
	$arr['icode'] = substr($icode,6,4); 
	$arr['qr'] = $newstr.$arr['icode'].'.png'; 
	$action = qr($arr['icode']);
	if($db->insert('award_user', $arr)){
      if(!empty($ficode)){
      	$uid= $db->insert_id();
		$fid = $db->get_one('award_user','icode='.$ficode,'uid');
		$user['uid'] = $uid;
		$user['fid'] = $fid['uid'];
		$db->insert('award_friend', $user);
	  }
	  die(json_encode(array('code'=>0,'arr'=>'注册成功','process_time'=>time())));
	}
}//注册api
function logout(){
	$_SESSION['uid'] = $userdata['uid'];
	$_SESSION['username'] = $userdata['username'];
	echo die(json_encode(array('code'=>1,'arr'=>'退出成功','process_time'=>time())));
}//退出api
function sendsms($db,$mobile ) {
        $uid = get_cookie('_uid');
        $mobile = $GLOBALS['mobile'];
        if(!preg_match('/^(?:13\d{9}|15[0|1|2|3|5|6|7|8|9]\d{8}|17[0|1|2|3|5|6|7|8|9]\d{8}|18[0|1|2|3|5|6|7|8|9]\d{8}|14[5|7]\d{8})$/',$mobile)) {
            exit('201');
        }
        $posttime = SYS_TIME-86400;
        $ip = get_ip();
        $where = "`ip`='$ip' AND `posttime`>$posttime";
        $num = $db->count_result('sms_checkcode',$where);
        if($num>200) {//单IP 24小时内最大请求次数限定
            exit('203');
        }
        //单用户动态短信请求间隔时长限制 ,根据手机号码判断是否为一个用户
        $where = "`mobile`='$mobile'";
        $r = $db->get_one('sms_checkcode',$where, '*', 0,'id DESC' );
        if($r['posttime']>SYS_TIME-60) {//60 秒之内连续请求
            exit('204');
        }
        //同一手机号次数限定
        $where = "`mobile`='$mobile' AND `posttime`>$posttime";
        $num = $db->count_result('sms_checkcode',$where);
        if($num>200) {//同一手机号次数限定 24小时内最大请求次数限定
            exit('205');
        }

        //验证通过
    
        $code = rand(1000,9999);

        $send_sms = load_class('ym_sms' , 'sms');
        $msg = '【优装美家】您的手机验证码为：'.$code.'，1分钟后可再次获取验证码。';
        $rs = $send_sms->send($mobile , $msg);

        // $returnstr = $sendsms->send_sms($mobile, $mobile.'||'.$code, 1); //发送短信
        if($rs) {
            $formdata = array();
            $formdata['mobile'] = $mobile;
            $formdata['uid'] = $uid;
            $formdata['posttime'] = SYS_TIME;
            $formdata['code'] = $code;
            $formdata['ip'] = $ip;
            $db->insert('sms_checkcode', $formdata);
            exit('0');
        } else {
            echo $returnstr;
        }
}//发送验证码api
function verify($db , $mobile , $code){
	$now_time = time();
    $arr = $db->get_one('sms_checkcode','mobile ='.$mobile, '*', 0,'id DESC' );
	$code_time = $arr['posttime'];
	if(empty($code))
		echo die(json_encode(array('code'=>0,'arr'=>'验证码不能为空','process_time'=>time())));
	if($now_time - $code_time > 60 )
		echo die(json_encode(array('code'=>0,'arr'=>'验证码超时','process_time'=>time())));
	if(intval($code) != $arr['code'])
        echo die(json_encode(array('code'=>0,'arr'=>'验证码错误','process_time'=>time())));
}//手机验证码验证api
function qr($icode){
	$dir='../uploadfile/award';
	if(!is_dir($dir)){
        mkdir($dir);
   }
     $str=R;$newstr = substr($str,0,strlen($str)-5);
     $urls=$newstr.'';
     $data = $urls; 
     $filename ='../uploadfile/award/'.$icode.'.png';
     $errorCorrectionLevel = 'L';  
     $matrixPointSize = 6;  
     QRcode::png($data, $filename, $errorCorrectionLevel, $matrixPointSize, 2); 
}//二维码图片生成api
function islogo(){
	if(empty($_SESSION['uid'])){
		die(json_encode(array('code'=>'0','arr'=>'请登录','process_time'=>time())));
	}
}//判断是否登录api
function reset_datum($db){
    $action = islogo();
    $uid = $_SESSION['uid'];
    $data['username'] = $GLOBALS['username'];
    $data['sex'] = $GLOBALS['sex'];
    $data['headimg'] = $GLOBALS['headimg'];
    if(empty($data))
        die(json_encode(array('code'=>'0','arr'=>'还没有填写修改资料','process_time'=>time())));
    if($db->update('award_user',$data,array('uid' => $uid)))
    	die(json_encode(array('code'=>'1','arr'=>'修改成功','process_time'=>time())));
}//修改信息api
function personage_datum($db){
   $action = islogo();
   $uid = $_SESSION['uid'];
   $arr = $db->get_one('award_user',array('uid' => $uid),'username,mobile,headimg,sex,qr');
   $data = array(
   	     'username' => $arr['username'],//用户名
   	     'mobile' => $arr['mobile'],//手机号
   	     'headimg' => getMImgShow($arr['headimg'],'original'),//用户头像
   	     'sex' => $arr['sex'],//用户性别 1 男 2 女
   	     'qr' => getMImgShow($arr['qr'],'original'),//用户二维码
   	);
   echo json_encode(array('code'=>1,'arr'=>$data,'process_time'=>time()));
}//个人信息资料
function my_friend($db){
	$action = islogo();
	$uid = $_SESSION['uid'];
	$data = $db->get_list('award_friend','')
}	