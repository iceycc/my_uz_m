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
class extract_money extends WUZHI_foreground {
    function __construct() {
        $this->member = load_class('member', 'member');
        load_function('common', 'member');
        $this->member_setting = get_cache('setting', 'member');
        parent::__construct();
       /* $uid = $_COOKIE["uid"];
        if(empty($uid)){
           echo json_encode(array('code'=>0,'data'=>array('member'=>null),'message'=>L('login_please'),'process_time'=>time()));exit;
        }*/
    }

    //推荐量房列表
    public function recommend(){
        $uid=$this->get_cookie('tj_id');
        $uid_status = $this->db->get_one('award_user','uid="'.$uid.'"');
        if(empty($uid_status)){
            echo json_encode(array('code'=>0,'data'=>array('member'=>null),'message'=>L('login_please'),'process_time'=>time()));exit;
        }
        $arr=array();
        $res=$this->db->get_list('award_demand_code','uid="'.$uid.'" and money!=50','order_id,money',0,100,$page,'id desc');
        foreach ($res as $key => $value) {
            $arr[$key]=$this->db->get_one('award_nodestatus','orderid="'.$value['order_id'].'"','status,status_reason,orderid',0,'status desc');
            $fat = $this->db->get_one('demand','id="'.$value['order_id'].'"','totalpay,payment_id');
            $arr[$key]['totalpay']=$fat['totalpay'];
            $arr[$key]['payment_id']=$fat['payment_id'];
            $refe = $this->db->get_one('demand_referno','orderid="'.$value['order_id'].'" and nodeid="19"','needmoney');
            $money=$refe['needmoney']/$arr[$key]['totalpay'];
            $arr[$key]['draw_rate'] = $money;
            $dena_com = $this->db->get_one('demand_company','orderid="'.$value['order_id'].'" and isdel=0');
            if($arr[$key]['draw_rate']>=0.8){
             $arr[$key]['jl_j'] = $arr[$key]['totalpay'] * 0.01; 
            }else{
             $arr[$key]['jl_j'] = $arr[$key]['totalpay'] * 0.005;
            }
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
                    $arr[$key]['status_reason']='签约成功，奖励金'.$arr[$key]['jl_j'].'元已到达您的账户'.'...';
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
                    $arr[$key]['status_reason']='签约成功，您获得'.$arr[$key]['jl_j'].'奖励金';
                }else if($arr[$key]['status']==9){
                    $arr[$key]['status_reason']='签约失败，请再接再厉';
                }else if($arr[$key]['status']==10){
                    $arr[$key]['status_reason']='业主的房屋装修完毕，剩余奖励金'.$arr[$key]['jl_j'].'元'.'...'.'。';
                }
            }
            $demand=$this->db->get_one('demand','id="'.$value['order_id'].'"','title,area,areaid_1,areaid_2,areaid,address,id');
            $arr[$key]['orderid']=$demand['id'];
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
     

   

    //推荐量房详情页
    public function recommend_detail(){
        $orderid = $GLOBALS['orderid'];
        if($orderid){
        $res=$this->db->get_one('award_demand_code','order_id="'.$orderid.'"','uid,money');
        $user=$this->db->get_one('award_user','uid="'.$res['uid'].'"','nickname,sex');
        $res['mobile']=$user['mobile'];
        $res['sex']=$user['sex'];
        $res['avatar']='http://m.uzhuang.com/res/images/avatar/avatar.png';
        $demand=$this->db->get_one('demand','id="'.$orderid.'"','title,budget,area,areaid_1,areaid_2,areaid,address,telephone,totalpay,payment_id');
        $res['title']=$demand['title'];
        $res['area']=$demand['area'];
        $res['budget']=$demand['totalpay'];
        $res['areaid_1']=$this->region($demand['areaid_1']);
        $res['areaid_2']=$this->region($demand['areaid_2']);
        $res['areaid']=$this->region($demand['areaid']);
        $res['address']=$demand['address'];
        $res['mobile']=$demand['telephone'];
        $refe = $this->db->get_one('demand_referno','orderid="'.$orderid.'" and nodeid="19"','needmoney');
        $money=$refe['needmoney']/$demand['totalpay'];
        //  echo "<pre>";print_r($fat);exit;
        if($money>=0.8){
            $res['jl_j'] = $demand['totalpay'] * 0.01;
        }else{
            $res['jl_j'] = $demand['totalpay'] * 0.005;
        }
        $dena_com = $this->db->get_one('demand_company','orderid="'.$orderid.'" and isdel=0');
        $result=$this->db->get_list('award_nodestatus','orderid="'.$orderid.'" and status<=6','status,status_reason',0,10,$page,'status asc');
        $results=$this->db->get_list('award_nodestatus','orderid="'.$orderid.'" and status>6','status,status_reason',0,10,$page,'status desc');
        if($dena_com['addtime']<'2017-12-14 12:00:00'){
            foreach ($result as $key => $value) {
                if($value['status']==1){
                    $arr[$key]['title']='成功提交，等待客服联系中';
                    $arr[$key]['status']=0;
                }else if($value['status']==2){
                    $arr[$key]['reason']=$value['status_reason'];
                    $arr[$key]['title']='审核失败';
                    $arr[$key]['status']=1;
                }else if($value['status']==3){
                    $arr[$key]['reason']=$value['status_reason'];
                    $arr[$key]['title']='审核成功，预约量房失败';
                    $arr[$key]['status']=1;
                }else if($value['status']==4){
                    $arr[$key]['title']='审核成功，已预约量房，等待量房';
                    $arr[$key]['status']=0;
                }else if($value['status']==5){
                    $arr[$key]['title']='装修管家已成功量房，奖励金'.$res['money'].'元已到达您的账户，可在我的账户页面进行查看，请注意查收';
                    $arr[$key]['status']=0;
                }else if($value['status']==6){
                    $arr[$key]['reason']=$value['status_reason'];
                    $arr[$key]['title']='装修管家上门量房失败';
                    $arr[$key]['status']=1;
                }
            }
        }else{
            foreach ($result as $key => $value) {
                if($value['status']==1){
                    $arr[$key]['title']='成功提交，等待客服联系中';
                    $arr[$key]['status']=0;
                }else if($value['status']==2){
                    $arr[$key]['reason']=$value['status_reason'];
                    $arr[$key]['title']='审核失败';
                    $arr[$key]['status']=1;
                }else if($value['status']==3){
                    $arr[$key]['reason']=$value['status_reason'];
                    $arr[$key]['title']='审核成功，装修公司上门服务失败';
                    $arr[$key]['status']=1;
                }else if($value['status']==4){
                    $arr[$key]['title']='装修公司已成功上门服务，您获得'.$res['money'].'鼓励金';
                    $arr[$key]['status']=0;
                } 
            }
        }
        foreach ($results as $k1 => $v1) {
            if($v1['status']==8){
                $arrs[$k1]['title']='签约成功，您获得'.$res['jl_j'].'元奖励金';
                $arrs[$k1]['status']=0;
            }else if($v1['status']==9){
                $arrs[$k1]['title']='签约失败，请再接再厉';
                $arrs[$k1]['status']=1;
            }else if($v1['status']==10){
                $arrs[$k1]['title']='业主的房屋装修完毕，剩余奖励金'.$res['jl_j'].'元已到达您的账户可在我的账户页面进行查看，请注意查收。';
                $arrs[$k1]['status']=0;
            }
        }
        //上门量房
        if($arr){
        $res['status_reason']=array_values($arr);
        }else{
        $res['status_reason']=null;
        }
        //签约红包
        if($arrs){
        $res['sign_redbag'] = array_values($arrs);
        }else{
        $res['sign_redbag'] = null;    
        }
        echo json_encode(array('code'=>1,'data'=>$res,'message'=>'推荐详情页','process_time'=>time()));exit;
        }else{
        echo json_encode(array('code'=>0,'data'=>null,'message'=>'订单id不存在','process_time'=>time()));exit; 
        }
    }

    //我的好友
    public function friend(){
        $uid=$this->get_cookie('tj_id');
        $uid_status = $this->db->get_one('award_user','uid="'.$uid.'"');
        if(empty($uid_status)){
            echo json_encode(array('code'=>0,'data'=>array('member'=>null),'message'=>L('login_please'),'process_time'=>time()));exit;
        }
        $res=$this->db->get_one('award_user','uid="'.$uid.'"','icode');
        $result=$this->db->get_list('award_user','rcode="'.$res['icode'].'"','uid,nickname,sex');
        foreach ($result as $key => $value) {
            $code[$key]=$this->db->get_list('award_demand_code','uid="'.$value['uid'].'" and money=50');
            $result[$key]['count']=count($code[$key]);
            $result[$key]['avatar']='http://m.uzhuang.com/res/images/avatar/avatar.png';
        }
        if($result){
        echo json_encode(array('code'=>1,'data'=>$result,'message'=>'我的好友','process_time'=>time()));exit;
        }else{
        echo json_encode(array('code'=>0,'data'=>null,'message'=>'暂无好友','process_time'=>time()));exit; 
        }
    }
    //我的好友详情
    public function friend_detail(){
        $uid=$GLOBALS['uid'];
        $arr=array();
        //$ress=$this->db->get_one('award_user','uid="'.$uid.'"','icode');
        $res=$this->db->get_one('award_user','uid="'.$uid.'"','mobile,nickname,sex');
        $res['avatar']='http://m.uzhuang.com/res/images/avatar/avatar.png';
        $result=$this->db->get_list('award_demand_code','uid="'.$uid.'" and money=50','order_id,money');
        $results=$this->db->get_list('award_demand_code','uid="'.$uid.'" and status=1 and money=50','order_id,money');
        foreach ($result as $key => $value) {
            $demand=$this->db->get_one('demand','id="'.$value['order_id'].'"','title,area,areaid_1,areaid_2,areaid,address,payment_id,totalpay');
            $arr[$key]['title']=$demand['title'];
            $arr[$key]['area']=$demand['area'];
            $arr[$key]['areaid_1']=$this->region($demand['areaid_1']);
            $arr[$key]['areaid_2']=$this->region($demand['areaid_2']);
            $arr[$key]['areaid']=$this->region($demand['areaid']);
            $arr[$key]['address']=$demand['address'];
            //$fat = $this->db->get_one('f_payment_method','payment_id="'.$demand['payment_id'].'"','draw_rate');
            $refe = $this->db->get_one('demand_referno','orderid="'.$value['order_id'].'" and nodeid="19"','needmoney');
            $money=$refe['needmoney']/$demand['totalpay'];
            //  echo "<pre>";print_r($fat);exit;
            if($money>=0.8){
                $res['jl_j'] = $demand['totalpay'] * 0.01;
            }else{
                $res['jl_j'] = $demand['totalpay'] * 0.005;
            }
            //$re=$this->db->get_one('award_nodestatus','orderid="'.$value['order_id'].'"','orderid,status,status_reason',0,$page,'status asc');
            $resss=$this->db->get_list('award_nodestatus','orderid="'.$value['order_id'].'"','orderid,status,status_reason',0,10,$page,'status asc');
            $a=array_search(max($resss),$resss);
            $re = $resss[$a];
            $money=$this->db->get_one('award_demand_code','order_id="'.$re['orderid'].'"');
            $dena_com = $this->db->get_one('demand_company','orderid="'.$value['order_id'].'" and isdel=0');
            if($dena_com['addtime']<'2017-12-14 12:00:00'){
                if($re['status']==1){
                    $arr[$key]['reason']='成功提交，等待客服联系中';
                }else if($re['status']==2){
                    $arr[$key]['reason']='审核失败，原因:'.$re['status_reason'];
                }else if($re['status']==3){
                    $arr[$key]['reason']='审核成功，预约量房失败，原因：'.$re['status_reason'];
                }else if($re['status']==4){
                    $arr[$key]['reason']='审核成功，已预约量房，等待量房';
                }else if($re['status']==5){
                    $arr[$key]['reason']='装修管家已成功量房，奖励金'.$money['money'].'元已到达您的账户，可在我的账户页面进行查看，请注意查收';
                }else if($re['status']==6){
                    $arr[$key]['reason']='装修管家上门量房失败，原因：'.$re['status_reason'];
                }else if($re['status']==8){
                    $arr[$key]['reason']='签约成功，奖励金'.$res['jl_j'].'元已到达您的账户，可在我的账户页面进行查看，请注意查收';  
                }else if($re['status']==9){
                    $arr[$key]['reason']='签约失败，请再接再厉';
                }else if($re['status']==10){
                    $arr[$key]['reason']='业主的房屋装修完毕，剩余奖励金'.$res['jl_j'].'元已到达您的账户可在我的账户页面进行查看，请注意查收。';
                }
            }else{
                if($re['status']==1){
                    $arr[$key]['reason']='成功提交，等待客服联系中';
                }else if($re['status']==2){
                    $arr[$key]['reason']='审核失败，原因:'.$re['status_reason'];
                }else if($re['status']==3){
                    $arr[$key]['reason']='审核成功，装修公司上门服务失败';
                }else if($re['status']==4){
                    $arr[$key]['reason']='装修公司已成功上门服务，您获得'.$money['money'].'鼓励金';
                }else if($re['status']==8){
                    $arr[$key]['reason']='签约成功，您获得'.$res['jl_j'].'元奖励金';  
                }else if($re['status']==9){
                    $arr[$key]['reason']='签约失败，请再接再厉';
                }else if($re['status']==10){
                    $arr[$key]['reason']='业主的房屋装修完毕，剩余奖励金'.$res['jl_j'].'元已到达您的账户可在我的账户页面进行查看，请注意查收。';
                }
            }
        }
        $res['friend']=$arr;
        $res['count']=count($results);
        $res['money']=50*$res['count'];
        echo json_encode(array('code'=>1,'data'=>$res,'message'=>'我的好友','process_time'=>time()));exit;  
    }

    //城市区域
    public function region($status){
        $area=$this->db->get_one('linkage_data','lid="'.$status.'"','name');
        return $area['name'];
    }


    //..........................................................................................................................................
    /**
     *提取金额
     **/
    public function index(){
        $uid=$this->get_cookie('tj_id');
        $uid_status = $this->db->get_one('award_user','uid="'.$uid.'"');
        if(empty($uid_status)){
            echo json_encode(array('code'=>0,'data'=>array('member'=>null),'message'=>L('login_please'),'process_time'=>time()));exit;
        }
        $id=$GLOBALS['id'];
        $arr=array();
        $res=$this->db->get_one('award_user','uid="'.$uid.'"','cumulative_money,extract_money');
        if($id){ 
            $ress=$this->db->get_list('award_bank_card','id="'.$id.'"','bank_number,bank_name',0,1,$page,'id desc');
        }else{
            $ress=$this->db->get_list('award_money','uid="'.$uid.'"','bank_number,bank_name',0,1,$page,'id desc');
        }
        if($ress[0]['bank_number']){
        $arr['bank_number']=$ress[0]['bank_number'];
        }else{
        $arr['bank_number']=null;
        }
        $arr['bank_name']=$ress[0]['bank_name'].'('.'尾号'.substr($ress[0]['bank_number'],-4).')';
        $str= $this->db->get_list('award_money','uid="'.$uid.'"','money_status,money',0,100,$page,'id desc');
        if($str){
            foreach ($str as $key => $value) {
                $sta[]=$value['money_status'];
                if(in_array(0,$sta)){
                    $r=0;
                }else{
                    $r=1;
                }
            }
        }else{
            $r=1;
        }
        $result=array_merge($res,$arr);
        $result['status']=$r;
        echo json_encode(array('code'=>1,'data'=>$result,'message'=>'提取展示','process_time'=>time()));exit;
    }

    //点击提现
    public function extract(){
        $uid=$this->get_cookie('tj_id');
        $uid_status = $this->db->get_one('award_user','uid="'.$uid.'"');
        if(empty($uid_status)){
            echo json_encode(array('code'=>0,'data'=>array('member'=>null),'message'=>L('login_please'),'process_time'=>time()));exit;
        }
        if($uid){
        $bank_number=$GLOBALS['bank_number'];
        $bank_name=$GLOBALS['bank_name'];
        $money=$GLOBALS['money'];
        $branch=$this->db->get_one('award_bank_card','uid="'.$uid.'" and bank_name="'.$bank_name.'" and bank_number="'.$bank_number.'"','branch');
        if($money<100){
        echo json_encode(array('code'=>0,'data'=>null,'message'=>'单笔提取金额需大于等于100元','process_time'=>time()));exit;
        }
        if($money%10!=0){
        echo json_encode(array('code'=>0,'data'=>null,'message'=>'金额需要为10的倍数','process_time'=>time()));exit;
        }
        $res=$this->db->get_one('award_user','uid="'.$uid.'"','icode');
        $formdata=array();
            $formdata['uid'] = $uid;
            $formdata['icode']=$res['icode'];
            $formdata['money']=$money;
            $formdata['bank_number'] = $bank_number;
            $formdata['bank_name'] = $bank_name;
            $formdata['addtime']=time();
            $formdata['branch']=$branch['branch'];
            $re=$this->db->get_one('award_user','uid="'.$uid.'"','cumulative_money');
            if($re['cumulative_money']<100){
            echo json_encode(array('code'=>0,'data'=>null,'message'=>'不足100元','process_time'=>time()));exit;
            }else{
              $this->db->update('award_user',array('cumulative_money'=>$re['cumulative_money']-$money),array('uid'=>$uid));  
            }
        $id=$this->db->insert('award_money',$formdata);
        $time=substr(date('Ymd',time()),2,6);
        $stream_no = $time.str_pad($id,5,0,STR_PAD_LEFT);
        $this->db->update('award_money',array('stream_no'=>$stream_no),array('id'=>$id));
        echo json_encode(array('code'=>1,'data'=>null,'message'=>'提取成功','process_time'=>time()));exit;
        }else{
        echo json_encode(array('code'=>0,'data'=>null,'message'=>'请登录','process_time'=>time()));exit;
        }
    }


    //提取历史
    public function extract_history(){
        $uid=$this->get_cookie('tj_id');
        $uid_status = $this->db->get_one('award_user','uid="'.$uid.'"');
        if(empty($uid_status)){
            echo json_encode(array('code'=>0,'data'=>array('member'=>null),'message'=>L('login_please'),'process_time'=>time()));exit;
        }
        $res=$this->db->get_list('award_money','uid="'.$uid.'"','money,bank_number,bank_name,addtime,money_status,pay_reason,status,reason');
        $result=$this->db->get_list('award_money','uid="'.$uid.'"','money,bank_number,bank_name,addtime');
        foreach ($res as $key => $value) {
            if($value['money_status']==0){
                $result[$key]['status']='提取中';
            }else if($value['money_status']==1){
                $result[$key]['status']='已打款';
            }else if($value['status']==2){
                $result[$key]['status']='提取失败';
                $result[$key]['remark']= $value['reason'];
            }else if($value['money_status']==2){
                $result[$key]['status']='提取失败';
                $result[$key]['remark']=$value['pay_reason'];
            }
            $result[$key]['addtime']=date('Y-m-d',$value['addtime']);
        }
        echo json_encode(array('code'=>1,'data'=>$result,'message'=>'提取历史','process_time'=>time()));exit;
    }
    

    //选择银行卡
    public function bank_number(){
        $uid=$this->get_cookie('tj_id');
        $uid_status = $this->db->get_one('award_user','uid="'.$uid.'"');
        if(empty($uid_status)){
            echo json_encode(array('code'=>0,'data'=>array('member'=>null),'message'=>L('login_please'),'process_time'=>time()));exit;
        }
        $result=$this->db->get_list('award_bank_card','uid="'.$uid.'"','id,bank_number,bank_name,name,branch');
        echo json_encode(array('code'=>1,'data'=>$result,'message'=>'选择银行卡','process_time'=>time()));exit;
    }
    
    //绑定银行卡
    public function bind_bank_number(){
        $uid=$this->get_cookie('tj_id');
        $uid_status = $this->db->get_one('award_user','uid="'.$uid.'"');
        if(empty($uid_status)){
            echo json_encode(array('code'=>0,'data'=>array('member'=>null),'message'=>L('login_please'),'process_time'=>time()));exit;
        }
        if($uid){
        $res=$this->db->get_list('award_bank_card','uid="'.$uid.'"','*');
        $result=count($res);
        if($result<3){
        $name=$GLOBALS['name'];
        $bank_number=$GLOBALS['bank_number'];
        $id_number=$GLOBALS['id_number'];
        $bank_name=$GLOBALS['bank_name'];
        $branch=$GLOBALS['branch'];
        $formdata=array();
            $formdata['uid'] = $uid;
            $formdata['name'] = $name;
            $formdata['bank_number'] = $bank_number;
            $formdata['id_number'] = $id_number;
            $formdata['bank_name'] = $bank_name;
            $formdata['branch'] = $branch;
            $this->db->insert('award_bank_card',$formdata);
        }else{
            echo json_encode(array('code'=>0,'data'=>null,'message'=>'最多可绑定3张银行卡','process_time'=>time()));exit; 
        }
            echo json_encode(array('code'=>1,'data'=>null,'message'=>'绑定银行卡成功','process_time'=>time()));exit;
        }else{
            echo json_encode(array('code'=>0,'data'=>null,'message'=>'用户不存在,请登录','process_time'=>time()));exit; 
        }
    }
    public function get_cookie($string, $default = '', $encrypt = true) {
        return isset($_COOKIE[$string]) ? decode($_COOKIE[$string]) : $default;
    }

}