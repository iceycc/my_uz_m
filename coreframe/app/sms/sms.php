<?php
// +----------------------------------------------------------------------
// | wuzhicms [ 五指互联网站内容管理系统 ]
// | Copyright (c) 2014-2015 http://www.wuzhicms.com All rights reserved.
// | Licensed ( http://www.wuzhicms.com/licenses/ )
// | Author: wangcanjia <phpip@qq.com>
// +----------------------------------------------------------------------
header("Access-Control-Allow-Origin: *");
defined('IN_WZ') or exit('No direct script access allowed');

/**
 * 发送短信验证码
 */
class sms
{
    public function __construct()
    {
        $this->db = load_class('db');
        load_class('session');
    }

    /**
     * 发送短信
     */
//    public function sendsms()
//    {
//        //验证 页面验证码是否正确
//        //插入相关信息
//        /**
//         * 1、使用安全图片验证码（网站）
//         * 2、单IP的请求次数限定 （网站）（APP）
//         * 3、单用户动态短信请求间隔时长限制（网站）（APP）
//         * 4、  同一手机号次数限定 （网站）（APP）
//         */
//
//        if(!(strpos($_SERVER['HTTP_USER_AGENT'], 'iPhone')||strpos($_SERVER['HTTP_USER_AGENT'], 'iPad')||strpos($_SERVER['HTTP_USER_AGENT'], 'Android'))){
//            if (empty($_SERVER['HTTP_REFERER']) || (!strstr($_SERVER['HTTP_REFERER'], 'uzhuang.com') && !strstr($_SERVER['HTTP_REFERER'], 'uz.com'))) {
//                die('210');
//            }
//        }
//        $uid = decode($_COOKIE['tj_id']);
//        $mobile = $GLOBALS['mobile'];
//        if (!preg_match('/^(?:1[3|4|5|7|8|9][0-9]\d{8})$/', $mobile)) {
//            exit('201');
//        }
//
//        if(!(strpos($_SERVER['HTTP_USER_AGENT'], 'iPhone')||strpos($_SERVER['HTTP_USER_AGENT'], 'iPad')||strpos($_SERVER['HTTP_USER_AGENT'], 'Android'))) {
//            $code = strtolower($GLOBALS['code']);
//            $_SESSION['code'] = (string)$_SESSION['code'];
//            if (empty($uid)) {
//                if (empty($code) || empty($_SESSION['code']) || strcmp($code, $_SESSION['code'])) {
//                    die('202');
//                }
//            } else {
//                $award_user = $this->db->get_one('award_user', "uid = {$uid}");
//                if (!$award_user) {
//                    die('209');
//                }
//            }
//
//            $_SESSION['code'] = '';
//        }
//        $posttime = SYS_TIME - 86400;
//        $ip = get_ip();
//        $where = "`ip`='$ip' AND `posttime`>$posttime";
//        $num = $this->db->count_result('sms_checkcode', $where);
//        if ($num > 30) {//单IP 24小时内最大请求次数限定
//            exit('203');
//        }
//        //单用户动态短信请求间隔时长限制 ,根据手机号码判断是否为一个用户
//        $where = "`mobile`='$mobile'";
//        $r = $this->db->get_one('sms_checkcode', $where, '*', 0, 'id DESC');
//        if ($r['posttime'] > SYS_TIME - 60) {//60 秒之内连续请求
//            exit('204');
//        }
//        //同一手机号次数限定
//        $where = "`mobile`='$mobile' AND `posttime`>$posttime";
//        $num = $this->db->count_result('sms_checkcode', $where);
//        if ($num > 10) {//同一手机号次数限定 24小时内最大请求次数限定
//            exit('205');
//        }
//        //验证通过
//        $code = rand(1000, 9999);
//        //$send_sms = load_class('ym_sms' , 'sms');
//        $sendMessage = load_class('sendmessage');
//        $msg = '您的手机验证码为：' . $code . '，1分钟后可再次获取验证码。';
//        //$rs = $send_sms->send($mobile , $msg);
//        $rs = $sendMessage->sendmessage($mobile, $msg, true);
//        // $returnstr = $sendsms->send_sms($mobile, $mobile.'||'.$code, 1); //发送短信
//        if ($rs) {
//            $formdata = array();
//            $formdata['mobile'] = $mobile;
//            $formdata['uid'] = $uid;
//            $formdata['posttime'] = SYS_TIME;
//            $formdata['code'] = $code;
//            $formdata['ip'] = $ip;
//            $this->db->insert('sms_checkcode', $formdata);
//            exit('0');
//        } else {
//            exit('207');
//        }
//    }

    /**
     * 发送短信(验证手机号是否存在)
     * @param string 手机号
     * @return code 0 发送成功
     * 201 手机号格式错误
     * 203 IP超过日最大请求数
     * 204 请求过快 60s内单用户只能请求一次
     * 205 手机号超过日最大请求数
     * 206 该用户尚未注册
     * 207 系统错误 发送短信失败
     *
     * message
     */
    public function sendsmscheck()
    {
        $mobile = $GLOBALS['mobile'];

        //增加区分平台

        //手机号码格式
        if (!preg_match('/^(?:13\d{9}|15[0|1|2|3|5|6|7|8|9]\d{8}|17[0|1|2|3|5|6|7|8|9]\d{8}|18[0|1|2|3|5|6|7|8|9]\d{8}|14[5|7]\d{8})$/', $mobile)) {
            echo json_encode(array('code' => 201, 'message' => '手机号格式错误', 'process_time' => time()));
            exit;
        }
        $_SESSION['code'] = '';

        $posttime = SYS_TIME - 86400;
        $ip = get_ip();
        $where = "`ip`='$ip' AND `posttime`>$posttime";
        $num = $this->db->count_result('sms_checkcode', $where);
        if ($num > 30) {//单IP 24小时内最大请求次数限定
            echo json_encode(array('code' => 203, 'message' => 'IP超过日最大请求数', 'process_time' => time()));
            exit;
        }
        //单用户动态短信请求间隔时长限制 ,根据手机号码判断是否为一个用户
        $where = "`mobile`='$mobile'";
        $r = $this->db->get_one('sms_checkcode', $where, '*', 0, 'id DESC');
        if ($r['posttime'] > SYS_TIME - 60) {//60 秒之内连续请求
            echo json_encode(array('code' => 204, 'message' => '请求过快', 'process_time' => time()));
            exit;
        }
        //同一手机号次数限定
        $where = "`mobile`='$mobile' AND `posttime`>$posttime";
        $num = $this->db->count_result('sms_checkcode', $where);
        if ($num >= 10) {//同一手机号次数限定 24小时内最大请求次数限定
            echo json_encode(array('code' => 205, 'message' => '手机号超过日最大请求数', 'process_time' => time()));
            exit;
        }
        //验证通过
        $s = $this->db->count('member', "mobile={$mobile}");
        $user = $this->db->get_one('member', "mobile={$mobile}");
        $uid = $user['uid'];
        if ($s['num'] <= 0) {
            //手机号不存在
            echo json_encode(array('code' => 206, 'message' => '手机号未注册', 'process_time' => time()));
            exit;
        }
        $code = rand(1000, 9999);
        $sendMessage = load_class('sendmessage');
        $msg = '您的手机验证码为：' . $code . '，1分钟后可再次获取验证码。';
        $rs = $sendMessage->sendmessage($mobile, $msg, true);
        if ($rs) {
            $formdata = array();
            $formdata['mobile'] = $mobile;
            $formdata['uid'] = $uid;
            $formdata['posttime'] = SYS_TIME;
            $formdata['code'] = $code;
            $formdata['ip'] = $ip;
            $this->db->insert('sms_checkcode', $formdata);
            error_log($_SERVER['REMOTE_ADDR'] . PHP_EOL);
            echo json_encode(array('code' => 0, 'message' => '发送成功', 'process_time' => time()));
            exit;
        } else {
            //短信发送失败
            echo json_encode(array('code' => 207, 'message' => '接口异常', 'process_time' => time()));
            exit;
        }
    }


    /**
     * 新发送短信
     */
    public function sendsms_v2()
    {
        //验证 页面验证码是否正确
        //插入相关信息
        /**
         * 1、使用安全图片验证码（网站）
         * 2、单IP的请求次数限定 （网站）（APP）
         * 3、单用户动态短信请求间隔时长限制（网站）（APP）
         * 4、  同一手机号次数限定 （网站）（APP）
         */
        $platform = $GLOBALS['platform'];
        //推荐装修返现状态 1=方式一
        $status = $GLOBALS['status'];
        if(!$platform){
            if (empty($_SERVER['HTTP_REFERER']) || (!strstr($_SERVER['HTTP_REFERER'], 'uzhuang.com') && !strstr($_SERVER['HTTP_REFERER'], 'uz.com'))) {
                echo json(210, null, '非法请求');
                die();
            }
        }
        $uid = decode($_COOKIE['tj_id']);
        $mobile = $GLOBALS['mobile'];

        if (!preg_match('/^(?:1[3|4|5|7|8|9][0-9]\d{8})$/', $mobile)) {
            echo json(201,null,'手机号格式错误');
            die();
        }

        $code = strtolower($GLOBALS['code']);
        $_SESSION['code'] = (string)$_SESSION['code'];
        if (empty($uid)) {
            if (empty($code) || empty($_SESSION['code']) || strcmp($code, $_SESSION['code'])) {
                echo json(202, null, '验证码错误');
                die();
            }
        } else {
            $award_user = $this->db->get_one('award_user', "uid = {$uid}");
            if (!$award_user) {
                echo json(209, null, '请登录');
                die();
            }
        }

        $_SESSION['code'] = '';

        $posttime = SYS_TIME - 86400;
        $ip = get_ip();
        $where = "`ip`='$ip' AND `posttime`>$posttime";
        $num = $this->db->count_result('sms_checkcode', $where);
        if ($num > 30) {//单IP 24小时内最大请求次数限定
            echo json(203,null,'IP已达日请求最大次数');
            die();
        }
        //单用户动态短信请求间隔时长限制 ,根据手机号码判断是否为一个用户
        $where = "`mobile`='$mobile'";
        $r = $this->db->get_one('sms_checkcode', $where, '*', 0, 'id DESC');
        if ($r['posttime'] > SYS_TIME - 60) {//60 秒之内连续请求
            echo json(204,null,'请求过于频繁');
            die();
        }
        //同一手机号次数限定
        $where = "`mobile`='$mobile' AND `posttime`>$posttime";
        $num = $this->db->count_result('sms_checkcode', $where);
        if ($num > 10) {//同一手机号次数限定 24小时内最大请求次数限定
            echo json(205,null,'手机号已达日请求最大次数');
            die();
        }
        //验证通过
        $code = rand(1000, 9999);
        //$send_sms = load_class('ym_sms' , 'sms');
        $sendMessage = load_class('sendmessage');
        if($status==1){
        $msg = '您的朋友正在帮您获取优装美家免费上门量房服务及三套免费装修设计方案机会，验证码为：' . $code . '。此验证码仅限优装美家推荐装修使用';
        }else{
        $msg = '您的手机验证码为：' . $code . '，1分钟后可再次获取验证码。';
        }
        //$rs = $send_sms->send($mobile , $msg);
        $rs = $sendMessage->sendmessage($mobile, $msg, true);
        // $returnstr = $sendsms->send_sms($mobile, $mobile.'||'.$code, 1); //发送短信
        if ($rs) {
            $formdata = array();
            $formdata['mobile'] = $mobile;
            $formdata['uid'] = $uid;
            $formdata['posttime'] = SYS_TIME;
            $formdata['code'] = $code;
            $formdata['ip'] = $ip;
            $this->db->insert('sms_checkcode', $formdata);
            echo json(0,null,'发送成功');
            die();
        } else {
            echo json(207,null,'系统异常');
            die();
        }
    }
}

?>