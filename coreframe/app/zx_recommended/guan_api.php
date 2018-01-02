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
class guan_api extends WUZHI_foreground {
	function __construct() {
        $this->member = load_class('member', 'member');
        load_function('common', 'member');
        $this->member_setting = get_cache('setting', 'member');
        parent::__construct();
	}

    /**
	 * 推荐返现接口
	 */
    public function index()
    {
        $orderid = $GLOBALS['orderid'];
        $nodeid = $GLOBALS['nodeid'];
        $track_detail=$this->db->get_list('demand_track_detail','orderid="'.$orderid.'" and nodeid=11','col8');
        if($track_detail){
	        $arr =1;
	        foreach ($track_detail as $kk => $vv) {
	        	if($vv['col8']=='是' || $vv['col8']==1){
	        		$arr = 2;
	        	}
	        }
	    }
        $orderSource = $this->db->get_one('demand','id='.$orderid,'source');//获取订单来源
        foreach ($data['is_amount_room'] as $key => $value) {
         	if($value==1){
         		$data['select'][$key] = '是';
         	}else{
         		$data['select'][$key] = '否';
         	}
        }
        foreach ($data['refuse_reason'] as $key => $value) {
         	$data['remark'][$key] = $value;
        }
        if(strstr($orderSource['source'],'推荐装修返现')){
        	$stat = $this->db->get_one('award_nodestatus','orderid="'.$orderid.'" and nodeid="'.$nodeid.'"');
	        $set = $this->db->get_one('demand','id="'.$orderid.'"','payment_id,totalpay');
	        $res1 = $this->db->get_one('award_demand_code',"order_id={$orderid} and money!=50",'uid,money,order_id,contract_status');
		    $res2 = $this->db->get_one('award_demand_code',array('order_id'=>$orderid,'money'=>50),'pid,order_id,contract_status');
		    $rat = $this->db->get_one('demand_referno','orderid="'.$orderid.'" and nodeid="'.$nodeid.'"');
		    $dena_com = $this->db->get_one('demand_company','orderid="'.$orderid.'" and isdel=0');

	        if($nodeid==10 && $dena_com['addtime']<'2017-12-14 12:00:00'){// 装修推荐奖励  客服审核通过，管家预约成功，等待量房
	         	$res_recode = $this->db->get_one('award_nodestatus','orderid='.$orderid.' and nodeid='.$nodeid);
	         	$newData = array('nodeid'=>$nodeid,'orderid'=>$orderid,'status'=>4,'addtime'=>time());
	         	if($res_recode){
	         		$this->db->update('award_nodestatus',$newData,'orderid='.$orderid.' and nodeid='.$nodeid);
	         	}else{
	         		$this->db->insert('award_nodestatus',$newData);
	         	}
	        }else if($nodeid==11 && $dena_com['addtime']<'2017-12-14 12:00:00'){//装修推荐奖励  上门量房节点
	         	if ($arr==1) { // 客服审核通过，管家预约成功，量房失败
	         		// 原因
	         		$status_reason = $GLOBALS['item']['remark'];
	         		$refuse_reason = '';
	         		foreach ($status_reason as $key => $value) {//获取拒绝量房原因(拒绝原因可选，如果填写取其中一个)
	         			if ($value) {
	         				$refuse_reason = $value;
	         				return false;
	         			}
	         		}
	         		$res_recode1 = $this->db->get_one('award_nodestatus','orderid='.$orderid.' and nodeid='.$nodeid);
	         		$newData1 = array('nodeid'=>$nodeid,'orderid'=>$orderid,'status'=>6,'addtime'=>time(),'status_reason'=>$refuse_reason);
	         		if($res_recode1){
	         			$this->db->update('award_nodestatus',$newData1,'orderid='.$orderid.' and nodeid='.$nodeid);
	         		}else{
	         			$this->db->insert('award_nodestatus',$newData1);
	         		}
	         	}else if($arr==2){ // 装修推荐奖励  客服审核通过，管家预约成功，量房成功
	         		//exit;
	         		$this->send_message($orderid);//发送短信
	         		$res_recode2 = $this->db->get_one('award_nodestatus','orderid='.$orderid.' and nodeid='.$nodeid);
	         		$newData2 = array('nodeid'=>$nodeid,'orderid'=>$orderid,'status'=>5,'addtime'=>time());
	         		if($res_recode2){
	         			$this->db->update('award_nodestatus',$newData2,'orderid='.$orderid.' and nodeid='.$nodeid);
	         		}else{
	         			$this->db->insert('award_nodestatus',$newData2);
		         		$this->db->update('award_demand_code',array('status'=>1),array('order_id'=>$orderid));
		         		if ($res1) {
		         			$current_money = $this->db->get_one('award_user',"uid={$res1['uid']}","cumulative_money,money");
		         			$new_cumulative_money = $current_money['cumulative_money']+$res1['money'];
		         			$new_money = $current_money['money']+$res1['money'];
		         			$this->db->update('award_user',array('cumulative_money'=>"{$new_cumulative_money}",'money'=>"{$new_money}"),array('uid'=>$res1['uid']));
		         		}
		         		if ($res2) {
		         			$current_money2 = $this->db->get_one('award_user',"uid={$res2['pid']}","cumulative_money,money");
		         			$new_cumulative_money2 = $current_money2['cumulative_money']+50;
		         			$new_money2 = $current_money2['money']+50;
		         			$this->db->update('award_user',array('cumulative_money'=>"{$new_cumulative_money2}",'money'=>"{$new_money2}"),array('uid'=>$res2['pid']));
		         		}
	         		}
	         	}
	        }else if($nodeid==19 && $dena_com['addtime']>'2017-11-23 18:00:00'){
	        	if($rat['is_online'] ==0){
		        	if(!empty($set['totalpay'])){
		        	    $refe = $this->db->get_one('demand_referno','orderid="'.$orderid.'" and nodeid="19"','needmoney');
		        	    $money=$refe['needmoney']/$set['totalpay'];
		        	    if($money>=0.8){
		        	    	$totalpay_money = $set['totalpay'] * 0.01;
		        	    	if($stat['status']==8){
				         	    $this->db->update('award_nodestatus',array('status'=>8),array('orderid'=>$orderid,'nodeid'=>$nodeid));
				         	}else{
				         	    $this->db->insert('award_nodestatus',array('nodeid'=>$nodeid,'orderid'=>$orderid,'status'=>8,'addtime'=>time()));
				         	}
				        $this->db->update('award_demand_code',array('contract_status'=>1),array('order_id'=>$orderid));
		        	    }else if($money<0.8){
		        	    	$totalpay_money = $set['totalpay'] * 0.005;
		        	    	if($stat){
				         	    $this->db->update('award_nodestatus',array('status'=>8),array('orderid'=>$orderid,'nodeid'=>$nodeid));
				         	}else{
				         	    $this->db->insert('award_nodestatus',array('nodeid'=>$nodeid,'orderid'=>$orderid,'status'=>8,'addtime'=>time()));
				         	}
		        	    }
		        	    if(!$stat){
				            if($res1) {
				         			$curr_money = $this->db->get_one('award_user',"uid={$res1['uid']}","cumulative_money,money");
				         			$cumula_money = $curr_money['cumulative_money']+$totalpay_money;
				         			$moneys = $curr_money['money']+$totalpay_money;
				         			$this->db->update('award_user',array('cumulative_money'=>"{$cumula_money}",'money'=>"{$moneys}"),array('uid'=>$res1['uid']));
				            }
				         	if($res2) {
				         			$curr_money1 = $this->db->get_one('award_user',"uid={$res2['pid']}","cumulative_money,money");
				         			$cumula_money1 = $curr_money1['cumulative_money']+$totalpay_money;
				         			$moneys1 = $curr_money1['money']+$totalpay_money;
				         			$this->db->update('award_user',array('cumulative_money'=>"{$cumula_money1}",'money'=>"{$moneys1}"),array('uid'=>$res2['pid']));
				         	}
				        }
		        	}else{
		        		if(empty($stat)){
	                    $this->db->insert('award_nodestatus',array('nodeid'=>$nodeid,'orderid'=>$orderid,'status'=>9,'addtime'=>time()));
		        		}
		        	}
		        }
	        }else if($dena_com['addtime']>'2017-11-23 18:00:00'){
		        $dema = $this->db->get_one('demand','id="'.$orderid.'"','payment_id');
		        $refes = $this->db->get_one('demand_referno','orderid="'.$orderid.'" and nodeid="'.$nodeid.'"','needmoney');
			    $moneys=$refes['needmoney']/$set['totalpay'];
		        if($res1['contract_status']==0){
			        if($dema['payment_id']){
		                $method = $this->db->get_list('f_payment_method','payment_id="'.$dema['payment_id'].'" and node_id!="45"','*',0,1,$page,'node_id desc');
		                if($moneys<0.8){
				            if($nodeid == $method[0]['node_id']){
		                	    if($rat['is_online'] ==0){
				                    $totalpay_money = $set['totalpay'] * 0.005;
					                if(!$stat){
								        if($res1) {
								            $curr_money = $this->db->get_one('award_user',"uid={$res1['uid']}","cumulative_money,money");
								         	$cumula_money = $curr_money['cumulative_money']+$totalpay_money;
								         	$moneys = $curr_money['money']+$totalpay_money;
								         	$this->db->update('award_user',array('cumulative_money'=>"{$cumula_money}",'money'=>"{$moneys}"),array('uid'=>$res1['uid']));
								        }
								        if($res2) {
								         	$curr_money1 = $this->db->get_one('award_user',"uid={$res2['pid']}","cumulative_money,money");
								         	$cumula_money1 = $curr_money1['cumulative_money']+$totalpay_money;
								         	$moneys1 = $curr_money1['money']+$totalpay_money;
								         	$this->db->update('award_user',array('cumulative_money'=>"{$cumula_money1}",'money'=>"{$moneys1}"),array('uid'=>$res2['pid']));
								        }
								    }
								    if($stat['status']!=10){
								        $pat=$this->db->insert('award_nodestatus',array('nodeid'=>19,'orderid'=>$orderid,'status'=>10,'addtime'=>time()));	
								    }
								    if($pat){
								    $this->db->update('award_demand_code',array('contract_status'=>1),array('order_id'=>$orderid));
								    }
				                }
				            }
			            }
			        }
			    }
			}
        }
    }

    public function send_message($orderid){
		// 获取发送短信的内容
        $message_info = $this->db->get_one('award_send_message',array('node_no'=>3,'in_use'=>1),'message_content');
        if($message_info&&$message_info['message_content']){
            // 加载发送短信类
            $sendMessage = load_class('sendmessage');
            // 获取群发的内容
            $message_content = $message_info['message_content'];
            // 发送短信
            $get_phone = $this->db->get_one('demand',array('id'=>$orderid),'telephone');
            if($get_phone&&$get_phone['telephone']){
            	$send_result = $sendMessage->sendmessage($get_phone['telephone'],$message_content);
            }
        }
	}

	//新版上门量房
	public function time_sta(){
        if(!strstr($_SERVER['HTTP_REFERER'],'uz.com')&&!strstr($_SERVER['HTTP_REFERER'],'uzhuang.com')){
            die('非法请求');
        }
		$status=$GLOBALS['status'];
		$orderid=$GLOBALS['orderid'];
		if($status && $orderid){
			$res = $this->db->get_one('award_nodestatus','orderid="'.$orderid.'" and (status=3 or status=4)');
			if(!$res){
				if($status==3 || $status==4){
					$formdata['orderid'] = $orderid;
					if($status==3){
					$formdata['status'] =3;
				    }else if($status==4){
		            $formdata['status'] =4;
		                $res1 = $this->db->get_one('award_demand_code',"order_id={$orderid} and money!=50",'uid,money,order_id,contract_status');
			            $res2 = $this->db->get_one('award_demand_code',array('order_id'=>$orderid,'money'=>50),'pid,order_id,contract_status');
			            if($res1) {
	         				$curr_money = $this->db->get_one('award_user',"uid={$res1['uid']}","cumulative_money,money");
	         				$cumula_money = $curr_money['cumulative_money']+$res1['money'];
	         				$moneys = $curr_money['money']+$res1['money'];
	         				$flag=$this->db->update('award_user',array('cumulative_money'=>"{$cumula_money}",'money'=>"{$moneys}"),array('uid'=>$res1['uid']));
	         				if(!$flag)$this->db->rollBack();
				        }
				        if($res2) {
		         			$curr_money1 = $this->db->get_one('award_user',"uid={$res2['pid']}","cumulative_money,money");
		         			$cumula_money1 = $curr_money1['cumulative_money']+50;
		         			$moneys1 = $curr_money1['money']+50;
		         			$flag=$this->db->update('award_user',array('cumulative_money'=>"{$cumula_money1}",'money'=>"{$moneys1}"),array('uid'=>$res2['pid']));
		         			if(!$flag)$this->db->rollBack();
				        }
				    }
				    $formdata['addtime'] = time();
					$this->db->insert('award_nodestatus',$formdata);
				}
		    }
	    }
	}
	//定时执行新版上门量房
	public function autoexec(){
		$transaction=$this->db->beginTransaction();
		$date_time = date('Y-m-d H:i:s',time());
		//$time = 3600*72;
		$time = 120;
		$res = $this->db->get_list('demand','(source="推荐装修返现" or source="推荐装修返现-分享好友页面")','id',0,10000,$page);

		foreach ($res as $key => $value) {
			$arr[]=$value['id'];
		}
		$or_id = implode(',',$arr);
		if($res){
			$sql = 'SELECT orderid,companyid,addtime FROM wz_demand_company WHERE orderid in ('.$or_id.') and isdel=0 and addtime>"2017-12-14 18:00:00"';
			$query = $this->db->query($sql);
			$arr=array();
	        while ($data = $this->db->fetch_array($query)) {
	            $com[]=$data;
	        }
	        foreach ($com as $k => $v) {
	        	$rat=$this->db->get_one('appeal','orderid="'.$v['orderid'].'" and companyid = "'.$v['companyid'].'"');
	        	$com[$k]['status'] = $rat;
	        }
	        foreach ($com as $k1 => $v1) {
	            if(empty($v1['status'])){
	            $array[] = $v1;
	        	}
	        }
	        foreach ($array as $k2 => $v2) {
	        	$array[$k2]['addtime1'] = date('Y-m-d H:i:s',strtotime($v2['addtime'])+$time);
	        	if($date_time >= $array[$k2]['addtime1']){
	                $arr_rat[]=$array[$k2];

	        	}
	        }
	        $result = array_values($this->array_unset_tt($arr_rat,'orderid'));
	        foreach ($result as $k2 => $v2) {
	        	$hat= $this->db->get_one('award_nodestatus','orderid="'.$v2['orderid'].'" and (status=4 or status=3)');
                $stat = $this->db->get_one('award_nodestatus','orderid="'.$v2['orderid'].'" and status=4');
	        	$result[$k2]['sta'] = $hat['status'];
	        	if($result[$k2]['sta']!=4 && $result[$k2]['sta']!=3){
		        	$flag=$this->db->update('award_demand_code',array('status'=>1),array('order_id'=>$v2['orderid']));
		        	if(!$flag)$this->db->rollBack();
					$formdata['orderid'] = $v2['orderid'];
					$formdata['status'] =4;
					$formdata['addtime'] = time();
	        	    $flag=$this->db->insert('award_nodestatus',$formdata);
	        	    if(!$flag)$this->db->rollBack();
		        	$res1 = $this->db->get_one('award_demand_code',"order_id={$v2['orderid']} and money!=50",'uid,money,order_id,contract_status');
			        $res2 = $this->db->get_one('award_demand_code',array('order_id'=>$v2['orderid'],'money'=>50),'pid,order_id,contract_status');
	        	    if(!$stat){
				        if($res1) {
	         				$curr_money = $this->db->get_one('award_user',"uid={$res1['uid']}","cumulative_money,money");
	         				$cumula_money = $curr_money['cumulative_money']+$res1['money'];
	         				$moneys = $curr_money['money']+$res1['money'];
	         				$flag=$this->db->update('award_user',array('cumulative_money'=>"{$cumula_money}",'money'=>"{$moneys}"),array('uid'=>$res1['uid']));
	         				if(!$flag)$this->db->rollBack();
				        }
				        if($res2) {
		         			$curr_money1 = $this->db->get_one('award_user',"uid={$res2['pid']}","cumulative_money,money");
		         			$cumula_money1 = $curr_money1['cumulative_money']+50;
		         			$moneys1 = $curr_money1['money']+50;
		         			$flag=$this->db->update('award_user',array('cumulative_money'=>"{$cumula_money1}",'money'=>"{$moneys1}"),array('uid'=>$res2['pid']));
		         			if(!$flag)$this->db->rollBack();
				        }
				    }
	        	}
	        }
	        $this->db->commit($transaction);
	    }	
	}
	public function array_unset_tt($arr, $key)
    {
        //建立一个目标数组
        $res = [];
        foreach ($arr as $value) {
            //查看有没有重复项
            if (isset($res[$value[$key]])) {
                unset($value[$key]);
            } else {
                $res[$value[$key]] = $value;
            }
        }
        return $res;
    }
}
