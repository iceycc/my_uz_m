<?php
// +----------------------------------------------------------------------
// | wuzhicms [ 五指互联网站内容管理系统 ]
// | Copyright (c) 2014-2015 http://www.wuzhicms.com All rights reserved.
// | Licensed ( http://www.wuzhicms.com/licenses/ )
// | Author: wangcanjia <phpip@qq.com>
// +----------------------------------------------------------------------
header("content-type:text/html;charset=utf-8");
defined('IN_WZ') or exit('No direct script access allowed');
/**
 * 首页
 */
load_class('foreground', 'member');
load_class('session');
class index extends WUZHI_foreground {
	function __construct() {
        $this->member = load_class('member', 'member');
        load_function('common', 'member');
        $this->member_setting = get_cache('setting', 'member');
        parent::__construct();
	}
    /**
     *首页入口
     **/
    public function index(){
        $title=$GLOBALS['title'];
        $mobile=$GLOBALS['mobile'];
        $sex=$GLOBALS['sex'];
        $areaid_2=$GLOBALS['areaid_2'];
        $address=$GLOBALS['address'];
        $housecategory=$GLOBALS['housecategory'];//1新房 3旧房
        $area=$GLOBALS['area'];
        $budget=$GLOBALS['budget'];
        $status=$GLOBALS['status'];
        $smscode = $GLOBALS['smscode'];
        $uid=$this->get_cookie('tj_id');
        $icode = urldecode($GLOBALS['icode'])-520;
        $formdata=array();
        if(empty($uid)){
            //分享
            if(empty($icode)){
                echo json(1,null,'非法请求');
                die();
            }
            $info =  $this->db->get_one('award_user',"icode={$icode}");
            if(empty($info)){
                echo json(1,null,'邀请码错误');
                die();
            }
            $uid = $info['uid'];
            $formdata['source']='推荐装修返现-分享好友页面';
        } else{
            //邀请
            if($smscode){
                if (!check_sms_code($smscode,$mobile)){
                    echo json(1,null,'手机验证码错误');
                    die();
                }
            }
            $info = $this->db->get_one('award_user',"uid={$uid}");
            $icode = $info['icode'];
            $formdata['source']='推荐装修返现';

        }
        $status = 0;
        if(isset($address)&&$address){
            $status+=10;
        }
        if(isset($housecategory)&&$housecategory){
            $status+=10;
        }
        if(isset($area)&&$area){
            $status+=10;
        }
        if(isset($budget)&&$budget){
            $status+=10;
        }

        if($title && $mobile && $sex && $areaid_2 && $uid){

            $md5 = md5($title.$mobile.$sex.$areaid_2.$uid);
            $md5_2 = get_cache('near_award_sumit');
            if($md5 == $md5_2){
                echo json_encode(array('code'=>1,'data'=>null,'message'=>'不允许重复提交','process_time'=>time()));exit;
            }
            set_cache('near_award_submit',$md5);


            $area_db = $city_db = $this->db->get_one('linkage_data', 'lid=' . $areaid_2, 'name,pid');
            $areaid_1 = $area_db['pid'];
            $formdata['referer'] = remove_xss(HTTP_REFERER);
            $formdata['order_no'] = date('YmdH').rand(100,999).date('is');
            $formdata['nodeid'] =0;
            $formdata['nodename']='订单待确认';
            $formdata['title'] = $title;
            $formdata['telephone'] = $mobile;
            $formdata['addtime'] = date('Y-m-d G:i:s',time());
            $formdata['orderstatus'] = '正常';
            $formdata['cid'] = 135;
            $formdata['status'] = 1;


            $formdata['sex']= $sex==1?'女':'男';
            $formdata['areaid_2']=$areaid_2;
            $formdata['areaid_1']=$areaid_1;
            $formdata['address']=$address;
            $formdata['area']=$area;
            $formdata['budget']=$budget;
//            $formdata['uid']=$uid;
            $formdata['housecategory']=$housecategory;
            $formdata['sourcenew']=6;
            $formdata['sourcenew_1']=0;
            $formdata['sourcenew_2']=0;
            $demands=$this->db->get_list('demand','telephone="'.$mobile.'" and (source="推荐装修返现" or source="推荐装修返现-分享好友页面")','addtime',0,1,$page,'id desc');
            $a = $demands[0]['addtime'];
            $a_ux = strtotime($a);
            if($a_ux + 12*3600 > time()){
                echo json(1,null,'同一手机号12小时内只能被推荐一次');
                die();
            }
            $b_date = date('Y-m-d',time());
            $demand=$this->db->get_list('award_demand_code',"uid='".$uid."' and addtime LIKE '%$b_date%'",'addtime',0,10,$page,'id desc','order_id');
            $count=count($demand);
            if($count>=10){
            echo json(1,null,'推荐奖励已用完,明天再来');
            die();
            }
            $id=$this->db->insert('demand',$formdata);
            $r=$this->db->get_one('award_user','uid="'.$uid.'"','money,ruid');
            //$this->db->update('award_user',array('money'=>$r['money']+(60+$status)),array('uid'=>$uid));
            $order_no = '1'.str_pad($id,9,0,STR_PAD_LEFT);
            $this->db->update('demand',array('order_no'=>$order_no),array('id'=>$id));

            //根据icode注册
            if(empty($smscode)){
                $this->registerbyicode($mobile, $icode);
            }
            $this->awardbonus($uid,$id,60+$status,$r['ruid']);

            $node['orderid']=$id;
            $node['nodeid']=0;
            $node['status']=1;
            $node['addtime']=time();
            $this->db->insert('award_nodestatus',$node);



            // 装修推荐返现推荐量房成功时发送短信
            // 获取发送短信的内容
            $message_info = $this->db->get_one('award_send_message',array('node_no'=>2,'in_use'=>1),'message_content');
            if($message_info&&$message_info['message_content']){
                // 加载发送短信类
                $sendMessage = load_class('sendmessage');
                // 获取群发的内容
                $message_content = $message_info['message_content'];
                // 发送短信
                $send_result = $sendMessage->sendmessage($mobile,$message_content);
                $print_data = array('send_res'=>$send_result,'phone'=>$mobile,'time'=>time());
                error_log(print_r($print_data,1),3,'/test/tjlfcg.txt');
            }
            echo json_encode(array('code'=>0,'data'=>$count,'message'=>'申请成功','process_time'=>time()));exit;
        }else{
            echo json_encode(array('code'=>1,'data'=>null,'message'=>'参数不正确','process_time'=>time()));exit;
        }
    }

    //插入award_demand_code表,奖金发放
    public function awardbonus($uid,$id,$status,$pid=null)
    {
        $money=array();
        $money['uid']=$uid;
        $money['order_id']=$id;
        $money['money']=$status;//60+$status;
        $money['pid']=$pid;
        $money['addtime']=date('Y-m-d H:i:s',time());
        $this->db->insert('award_demand_code',$money);
        if($pid !=null){
            $money['money'] = 50;
            $this->db->insert('award_demand_code',$money);
        }
    }

    //方式二填写信息后自动注册
    public function registerbyicode($mobile, $rcode)
    {
        $info['nickname'] = $mobile;
        $info['mobile'] = $mobile;
        $avatar=$this->avatar();
        $sta=$this->db->get_one('award_user','icode="'.$rcode.'"','*');
        $mobile_info = $this->db->get_one('award_user',"mobile = {$mobile}");
        if($mobile_info){
            return 0;
        }
        if(empty($sta)){
            return 0;
//            echo json_encode(array('code'=>0,'data'=>null,'message'=>'邀请码错误','process_time'=>time()));exit;
        }else{
            $info['rcode'] = $rcode;
        }
        $info['ruid']= $sta['uid'];
        for ($i=0; $i <1000 ; $i++) {
            $info['icode'] =mt_rand(100000,999999);
            $stat=$this->db->get_one('award_user','icode="'.$info['icode'].'"');
            if(empty($stat)){
                break;
            }
        }
        $info['headimg'] = $avatar.".png";
        $info['addtime'] = date('Y-m-d H:i:s',time());
        $info['cityid'] = $_COOKIE["cityid"]?$_COOKIE["cityid"]:3360;
        $this->db->insert('award_user',$info);
    }


    //轮播图
    public function carousel(){
        $sql="select * from wz_award_banner";
        $query = $this->db->query($sql);
            while($data = $this->db->fetch_array($query)) {
                $res = $data;
            }
            $obj=json_decode($res['content']);
            $object =  json_decode(json_encode($obj),true);
            $img=$object['picimg'];
            $url=$object['url'];
            foreach ($img as $key => $value) {
                $imgers[$key]['img']="http://m.uzhuang.com/image/original/".$value;
                $imgers[$key]['url']=$object['url'][$key];
            }
           echo json_encode(array('code'=>1,'data'=>$imgers,'message'=>'成功','process_time'=>time()));exit; 
    }
    //推荐返现
    public function cash_back(){
        $result=$this->db->get_list('award_draw',$where,'*',0,100,$page,'id desc');
        foreach ($result as $key => $value) {
            $result[$key]['mobile']=substr_replace($value['mobile'],'****',3,4);
            if($value['header']){
            $result[$key]['header']="http://m.uzhuang.com/image/original/".$value['header'];
            }else{
            $result[$key]['header']="http://m.uzhuang.com/res/images/avatar/avatar.png";
            }
        }
        echo json_encode(array('code'=>1,'data'=>$result,'message'=>'成功','process_time'=>time()));exit;
    }
    //进首页判断
    public function index_status(){
        $uid=$this->get_cookie('tj_id');
        if($uid){
            $res = $this->db->get_one('award_user','uid="'.$uid.'"');
            if($res){
                $b_date = date('Y-m-d');
                $demand=$this->db->get_list('award_demand_code',"uid='".$uid."' and addtime LIKE '%$b_date%' and money!=50",'addtime',0,10,$page,'id desc','order_id');
                $count=count($demand);
                $result['count']=10-$count;
                $result['uid']=$uid;
            echo json_encode(array('code'=>1,'data'=>$result,'message'=>'用户已登录','process_time'=>time()));exit;
            }else{
            echo json_encode(array('code'=>0,'data'=>array('count'=>10),'message'=>'用户不存在','process_time'=>time()));exit;
            }
        }else{
        echo json_encode(array('code'=>0,'data'=>array('count'=>10),'message'=>L('login_please'),'process_time'=>time()));exit;
        }
    }


    public function avatar(){
        $str = array('default1'=>'default1','default2'=>'default2','default3'=>'default3','default4'=>'default4','default5'=>'default5');
        $rand=array_rand($str,1);
        return $rand;
    }

    public function get_cookie($string, $default = '', $encrypt = true) {
        return isset($_COOKIE[$string]) ? decode($_COOKIE[$string]) : $default;
    }

    //管家端-推荐装修返现账号打通判断
    public function tj_status(){
        $uid = $GLOBALS['uid'];
        if(empty($uid)){
            echo json_encode(array('code'=>0,'message'=>'COOKIE存取失败','process_time'=>time()));exit;
        }
        $res = $this->db->get_one('award_user','userid="'.$uid.'"','uid,icode');
        if($res){
        $cookietime = SYS_TIME + 1*7*24*3600;
            setcookie('icode',$uid['icode']+520,$cookietime);
            $this->set_cookie('tj_id',$res['uid'],$cookietime);
            echo json_encode(array('code'=>1,'message'=>'成功','process_time'=>time()));exit;
        }else{
            echo json_encode(array('code'=>0,'message'=>'COOKIE存取失败','process_time'=>time()));exit;
        }
    }
    public function set_cookie($string, $value = '', $time = 0, $encrypt = true) {
        $time = $time > 0 ? $time : ($value == '' ? SYS_TIME - 3600 : 0);
        $s = $_SERVER['SERVER_PORT'] == '443' ? 1 : 0;
        if($encrypt) $value = encode($value);
        setcookie($string, $value, $time, COOKIE_PATH, COOKIE_DOMAIN, $s);
    }

}

