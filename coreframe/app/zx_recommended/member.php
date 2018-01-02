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
class member extends WUZHI_foreground {
	function __construct() {
        $this->member = load_class('member', 'member');
        load_function('common', 'member');
        $this->member_setting = get_cache('setting', 'member');
        parent::__construct();
/*        $uid = $_COOKIE["uid"];
        if(empty($uid)){
           echo json_encode(array('code'=>0,'data'=>array('member'=>null),'message'=>L('login_please'),'process_time'=>time()));exit;
        }*/
	}
    /**
     *我的账户中心
     **/
    public function index(){
       $uid=$this->get_cookie('tj_id');
        $uid_status = $this->db->get_one('award_user','uid="'.$uid.'"');
        if(empty($uid_status)){
            echo json_encode(array('code'=>0,'data'=>array('member'=>null),'message'=>L('login_please'),'process_time'=>time()));exit;
        }
       if($uid){
       $res=$this->db->get_one('award_user','uid="'.$uid.'"','nickname,icode,cumulative_money,qrcode,headimg');
       $res['qrcode']="http://m.uzhuang.com/uploadfile/award/".$res['qrcode'];
       $res['avatar']="http://m.uzhuang.com/res/avatar/".$res['headimg'];
       echo json_encode(array('code'=>1,'data'=>$res,'message'=>'成功','process_time'=>time()));exit;
       }else{
       echo json_encode(array('code'=>0,'data'=>null,'message'=>'用户不存在,请登录','process_time'=>time()));exit;
       }
    }
     
    //我的推荐
    public function my_recommend(){
        $uid=$this->get_cookie('tj_id');
        $uid_status = $this->db->get_one('award_user','uid="'.$uid.'"');
        if(empty($uid_status)){
            echo json_encode(array('code'=>0,'data'=>array('member'=>null),'message'=>L('login_please'),'process_time'=>time()));exit;
        }
        $arr=array();
        $res=$this->db->get_list('award_demand_code','uid="'.$uid.'" and money!=50','order_id,money',0,3,$page,'id desc');
        foreach ($res as $key => $value) {
            $arr[$key]=$this->db->get_one('award_nodestatus','orderid="'.$value['order_id'].'"','status,status_reason,orderid',0,'status desc');
            $fat = $this->db->get_one('demand','id="'.$value['order_id'].'"','totalpay,payment_id');
            $arr[$key]['totalpay']=$fat['totalpay'];
            $arr[$key]['payment_id']=$fat['payment_id'];
            $refe = $this->db->get_one('demand_referno','orderid="'.$value['order_id'].'" and nodeid="19"','needmoney');
            $money=$refe['needmoney']/$arr[$key]['totalpay'];
            if($money>=0.8){
             $arr[$key]['jl_j'] = $arr[$key]['totalpay'] * 0.01; 
            }else{
             $arr[$key]['jl_j'] = $arr[$key]['totalpay'] * 0.005;
            }
            $dena_com = $this->db->get_one('demand_company','orderid="'.$value['order_id'].'" and isdel=0');
            if($dena_com['addtime']<'2017-12-14 12:00:00'){
                if($arr[$key]['status']==1){
                    $arr[$key]['status_reason']='成功提交，等待客服联系中';
                }else if($arr[$key]['status']==2){
                    $arr[$key]['status_reason']='审核失败，原因:'.$arr[$key]['status_reason'];
                }else if($arr[$key]['status']==3){
                    $arr[$key]['status_reason']='审核成功，预约量房失败，原因：'.$arr[$key]['status_reason'];
                }else if($arr[$key]['status']==4){
                    $arr[$key]['status_reason']='审核成功，已预约量房，等待量房';
                }else if($arr[$key]['status']==5){
                    $arr[$key]['status_reason']='装修管家已成功量房，奖励金'.$value['money'].'元已到达您的账户，可在我的账户页面进行查看，请注意查收';  
                }else if($arr[$key]['status']==6){
                    $arr[$key]['status_reason']='装修管家上门量房失败，原因：'.$arr[$key]['status_reason'];
                }else if($arr[$key]['status']==8){
                    $arr[$key]['status_reason']='签约成功，奖励金'.$arr[$key]['jl_j'].'元已达到您的账户'.'...';
                }else if($arr[$key]['status']==9){
                    $arr[$key]['status_reason']='签约失败，请再接再厉';
                }else if($arr[$key]['status']==10){
                    $arr[$key]['status_reason']='业主的房屋装修完毕，剩余奖励金'.$arr[$key]['jl_j'].'元'.'...'.'。';
                }
            }else{
                if($arr[$key]['status']==1){
                    $arr[$key]['status_reason']='成功提交，等待客服联系中';
                }else if($arr[$key]['status']==2){
                    $arr[$key]['status_reason']='审核失败，原因:'.$arr[$key]['status_reason'];
                }else if($arr[$key]['status']==3){
                    $arr[$key]['status_reason']='审核成功，装修公司上门服务失败';
                }else if($arr[$key]['status']==4){
                    $arr[$key]['status_reason']='装修公司已成功上门服务，您获得'.$value['money'].'鼓励金';
                }else if($arr[$key]['status']==8){
                    $arr[$key]['status_reason']='签约成功，您获得'.$arr[$key]['jl_j'].'元奖励金';
                }else if($arr[$key]['status']==9){
                    $arr[$key]['status_reason']='签约失败，请再接再厉';
                }else if($arr[$key]['status']==10){
                    $arr[$key]['status_reason']='业主的房屋装修完毕，剩余奖励金'.$arr[$key]['jl_j'].'元'.'...'.'。';
                }

            }
            $demand=$this->db->get_one('demand','id="'.$value['order_id'].'"','title,area,areaid_1,areaid_2,areaid,address');
            $arr[$key]['title']=$demand['title'];
            $arr[$key]['area']=$demand['area'];
            $arr[$key]['areaid_1']=$this->region($demand['areaid_1']);
            $arr[$key]['areaid_2']=$this->region($demand['areaid_2']);
            $arr[$key]['areaid']=$this->region($demand['areaid']);
            $arr[$key]['address']=$demand['address'];
        }
        if($arr){
           echo json_encode(array('code'=>1,'data'=>$arr,'message'=>'我的推荐','process_time'=>time()));exit; 
        }else{
           echo json_encode(array('code'=>0,'data'=>null,'message'=>'暂无推荐','process_time'=>time()));exit;
        }
    }

    //我的好友
    public function my_friend(){
        $uid=$this->get_cookie('tj_id');
        $res=$this->db->get_one('award_user','uid="'.$uid.'"');
        if(empty($res)){
            echo json_encode(array('code'=>0,'data'=>array('member'=>null),'message'=>L('login_please'),'process_time'=>time()));exit;
        }
        $result=$this->db->get_list('award_user','rcode="'.$res['icode'].'"','uid,mobile');
        foreach ($result as $key => $value) {
            $demands[$key]['a']=$this->db->get_list('award_demand_code','uid="'.$value['uid'].'" and status=1 and money=50','*',0,1000,$page,'order_id');
            $result[$key]['count']=count($demands[$key]['a']);
            $result[$key]['avatar']="http://m.uzhuang.com/res/images/avatar/avatar.png";
        }
        if($result){
        echo json_encode(array('code'=>1,'data'=>$result,'message'=>'我的好友','process_time'=>time()));exit;
        }else{
        echo json_encode(array('code'=>0,'data'=>null,'message'=>'暂无好友','process_time'=>time()));exit; 
        }
    }

    //个人中心
    public function personal_center(){
        $uid=$this->get_cookie('tj_id');
        $res=$this->db->get_one('award_user','uid="'.$uid.'"','nickname,sex,qrcode,headimg');
        if(empty($res)){
            echo json_encode(array('code'=>0,'data'=>array('member'=>null),'message'=>L('login_please'),'process_time'=>time()));exit;
        }
        $res['qrcode']="http://m.uzhuang.com/uploadfile/award/".$res['qrcode'];
        if($res['sex']==1){
        $res['sex']=1;
        }else if($res['sex']==2){
        $res['sex']=2;
        }
        $res['avatar']="http://m.uzhuang.com/res/avatar/".$res['headimg'];
        if($res){
        echo json_encode(array('code'=>1,'data'=>$res,'message'=>'成功','process_time'=>time()));exit;
        }else{
        echo json_encode(array('code'=>0,'data'=>null,'message'=>'失败','process_time'=>time()));exit; 
        }
    }

    //个人中心修改
    public function edit(){
        $uid=$this->get_cookie('tj_id');
        $uid_status = $this->db->get_one('award_user','uid="'.$uid.'"');
        if(empty($uid_status)){
            echo json_encode(array('code'=>0,'data'=>array('member'=>null),'message'=>L('login_please'),'process_time'=>time()));exit;
        }
        $nickname=$GLOBALS['nickname'];
        $sex=$GLOBALS['sex'];
        $this->db->update('award_user',array('nickname'=>$nickname,'sex'=>$sex),array('uid'=>$uid));
        echo json_encode(array('code'=>1,'data'=>null,'message'=>'修改成功','process_time'=>time()));exit;
    }
       //城市区域
    public function region($status){
        $area=$this->db->get_one('linkage_data','lid="'.$status.'"','name');
        return $area['name'];
    }

    public function get_cookie($string, $default = '', $encrypt = true) {
        return isset($_COOKIE[$string]) ? decode($_COOKIE[$string]) : $default;
    }

}