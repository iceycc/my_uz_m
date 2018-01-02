<?php
// +----------------------------------------------------------------------
// | wuzhicms [ 五指互联网站内容管理系统 ]
// | Copyright (c) 2014-2015 http://www.wuzhicms.com All rights reserved.
// | Licensed ( http://www.wuzhicms.com/licenses/ )
// | Author: wangcanjia <phpip@qq.com>
// +----------------------------------------------------------------------
header("content-type:text/html;charset=utf-8");
defined('IN_WZ') or exit('No direct script access allowed');
require_once(COREFRAME_ROOT.'app/core/libs/class/phpqrcode.php');
/**
 * 首页
 */
load_class('foreground', 'member');
class password extends WUZHI_foreground {
	function __construct() {
        $this->member = load_class('member', 'member');
        load_function('common', 'member');
        $this->member_setting = get_cache('setting', 'member');
        parent::__construct();
	}

    /**
     * 注册
    */
    public function register(){
        //$this->get_cookie('tj_id');exit;
            $mobile = $GLOBALS['mobile'];
            $icode = time();
            $smscode = $GLOBALS['smscode'];
            $rcode=$GLOBALS['rcode'];
            if(empty($mobile)) {
                echo json_encode(array('code'=>0,'data'=>null,'message'=>'手机号码不能为空','process_time'=>time())); exit;
            }
            if (!preg_match('/^(?:1[3|4|5|7|8|9][0-9]\d{8})$/', $mobile)) {
                echo json_encode(array('code'=>0,'data'=>null,'message'=>'手机号码错误','process_time'=>time())); exit;
            }
            $s = $this->db->count('award_user',"mobile={$mobile}");
            if($s['num'] > 0){
                echo json_encode(array('code'=>0,'data'=>null,'message'=>'此手机号码已经注册','process_time'=>time())); exit;
            }
            $where = "`mobile`='$mobile'";
            $r = $this->db->get_one('sms_checkcode',$where, '*', 0,'id DESC' );
            if(!$r || $r['code']=='' || $r['code']!=$smscode){
              echo json_encode(array('code'=>0,'data'=>null,'message'=>'短信验证码错误','process_time'=>time())); exit;
            }
            if($r['posttime']<SYS_TIME-300) {
              echo json_encode(array('code'=>0,'data'=>null,'message'=>'短信验证码过期，请重新注册！','process_time'=>time())); exit;
            }
            $this->db->update('sms_checkcode',array('code'=>''),array('id'=>$r['id']));
/*            $result = $this->db->get_one('member','mobile="'.$mobile.'"','uid');
            if(empty($result)){
                $arr = rand(100000, 999999);
                $infos['username'] = 'MB' . $mobile;
                $infos['nickname'] = 'u' . $arr;
                $infos['mobile'] = $mobile;
                $infos['modelid'] = 10;
                $infos['groupid'] = 3;
                $uid=$this->db->insert('member',$infos);
                $info['uid'] = $uid;
            }else{
                $info['uid'] = $result['uid'];
            }*/
            $avatar=$this->avatar();
                if($rcode){
                    $sta=$this->db->get_one('award_user','icode="'.$rcode.'"','*');
                    if(empty($sta)){
                    echo json_encode(array('code'=>0,'data'=>null,'message'=>'邀请码错误','process_time'=>time()));exit;
                    }else{
                    $info['rcode'] = $rcode;
                    }
                    $info['ruid']= $sta['uid'];
                }
                $info['nickname'] = $mobile;
                $info['mobile'] = $mobile;
                for ($i=0; $i <1000 ; $i++) { 
                     $info['icode'] =mt_rand(100000,999999);
                     $stat=$this->db->get_one('award_user','icode="'.$info['icode'].'"');
                     if(empty($stat)){
                        break; 
                     }
                }
                $info['headimg'] = $avatar.".png";
                $info['addtime'] = date('Y-m-d H:i:s',time());
                $info['cityid'] = $_COOKIE["cityid"]?$_COOKIE["cityid"]:3360;//获取cookie值  没有默认北京
                $uids=$this->db->insert('award_user',$info);
                // 装修推荐返现注册成功后发送短信
                // 获取发送短信的内容
                $message_info = $this->db->get_one('award_send_message',array('node_no'=>1,'in_use'=>1),'message_content');
                if($message_info&&$message_info['message_content']){
                    // 加载发送短信类
                    $sendMessage = load_class('sendmessage');
                    // 获取群发的内容
                    $message_content = $message_info['message_content'];
                    // 发送短信
                    $send_result = $sendMessage->sendmessage($mobile,$message_content);
                }
                $cookietime = SYS_TIME + 1*7*24*3600;
                setcookie('icode',$uid['icode']+520,$cookietime);
                $this->set_cookie('tj_id', $uids, $cookietime);
                $this->qr($info['icode']);
                $this->db->update('award_user',array('qrcode'=>$info['icode'].'.png'),array('uid'=>$uid));
            echo json_encode(array('code'=>1,'data'=>$send_result,'message'=>'注册成功','process_time'=>time()));exit;
    }


    //登陆
    public function login(){
        $mobile = $GLOBALS['mobile'];
        $icode = time();
        $smscode = $GLOBALS['smscode'];
        $rcode=$GLOBALS['rcode'];
        if(empty($mobile)) {
            echo json_encode(array('code'=>0,'data'=>null,'message'=>'手机号码不能为空','process_time'=>time())); exit;
        }
        if (!preg_match('/^(?:1[3|4|5|7|8|9][0-9]\d{8})$/', $mobile)) {
                echo json_encode(array('code'=>0,'data'=>null,'message'=>'手机号不正确','process_time'=>time())); exit;
        }
        $s = $this->db->count('award_user',"mobile={$mobile}");
        if($s['num'] <= 0){
              echo json_encode(array('code'=>0,'data'=>null,'message'=>'手机号还未注册','process_time'=>time())); exit;
        }
        $where = "`mobile`='$mobile'";
        $r = $this->db->get_one('sms_checkcode',$where, '*', 0,'id DESC' );
        if(!$r || $r['code']=='' || $r['code']!=$smscode){
              echo json_encode(array('code'=>0,'data'=>null,'message'=>'短信验证码错误','process_time'=>time())); exit;
        }
        if($r['posttime']<SYS_TIME-300) {
              echo json_encode(array('code'=>0,'data'=>null,'message'=>'短信验证码过期，请重新发送短信！','process_time'=>time())); exit;
        }
        $this->db->update('sms_checkcode',array('code'=>''),array('id'=>$r['id']));
        $uid=$this->db->get_one('award_user','mobile="'.$mobile.'"','uid,headimg,icode');
        if(empty($uid['headimg'])){
           $avatar=$this->avatar();
           $this->db->update('award_user',array('headimg'=>$avatar.".png"),array('mobile'=>$mobile));
        }
        $cookietime = SYS_TIME + 1*7*24*3600;
        setcookie('icode',$uid['icode']+520,$cookietime);
        $this->set_cookie('tj_id',$uid['uid'],$cookietime);
        echo json_encode(array('code'=>1,'data'=>null,'message'=>'登录成功','process_time'=>time()));exit;
    }

    //生成二维码
    public function qr($icode){
        $dir='./uploadfile/award';
        if(!is_dir($dir)){
            mkdir($dir);
        }
        $str='http://m.uzhuang.com/activity-reg.html?icode='.$icode;
/*        $newstr = substr($str,0,strlen($str)-5);
        //echo "<pre>";print_r($str);exit;
        $urls=$str.'activity-reg.html';*/
        $data = $str; 
        $filename ='./uploadfile/award/'.$icode.'.png';
        $errorCorrectionLevel = 'L';  
        $matrixPointSize = 6;  
        QRcode::png($data, $filename, $errorCorrectionLevel, $matrixPointSize, 2); 
    }    

    public function logout(){
        $this->set_cookie('tj_id','');
        $this->set_cookie('icode','');
        echo json_encode(array('code'=>1,'data'=>null,'message'=>'退出成功','process_time'=>time())); exit;
    }

    public function avatar(){
        $str = array('default1'=>'default1','default2'=>'default2','default3'=>'default3','default4'=>'default4','default5'=>'default5');
        $rand=array_rand($str,1);
        return $rand;
    }

    public function set_cookie($string, $value = '', $time = 0, $encrypt = true) {
        $time = $time > 0 ? $time : ($value == '' ? SYS_TIME - 3600 : 0);
        $s = $_SERVER['SERVER_PORT'] == '443' ? 1 : 0;
        if($encrypt) $value = encode($value);
        setcookie($string, $value, $time, COOKIE_PATH, COOKIE_DOMAIN, $s);
    }

}

