<?php
/* *
 * 功能：连连支付服务器异步通知页面
 * 版本：2.0
 * 日期：2017-07-24
 *************************页面功能说明*************************
 * 创建该页面文件时，请留心该页面文件中无任何HTML代码及空格。
 * 该页面不能在本机电脑测试，请到服务器上做测试。请确保外部可以访问该页面。
 */
defined('IN_WZ') or exit('No direct script access allowed');
load_class('foreground', 'member');
require_once ("llpay.config.php");
require_once ("lib/llpay_notify.class.php");
class notify_url extends WUZHI_foreground{
    public $llpay_config;
    public $pay_base;
    function __construct() {
    	$this->pay_base = load_class('online_pay', 'llpay');
        parent::__construct();
	}

	public function test(){
        // 获取支付项唯一编号
        $id = remove_xss($GLOBALS['id']);
		$referno_info = explode('_',$id);
		$referno_id = $referno_info[0];
		$money_order = remove_xss($GLOBALS['money']);
		$payed_money0 = $this->pay_base->get_payed_money($referno_id);
		// 获取需要支付的金额
		$need_pay_money = $this->db->get_one('demand_referno',array('id'=>$referno_id),'needmoney');
		$need_pay_money = floatval($need_pay_money['needmoney']);
		if (bccomp($need_pay_money,$payed_money0,2)==0) {
			die(json_encode(array('code'=>0,'message'=>'已经支付完成')));
		}
		$is_pay = $this->db->get_one('online_pay_item',array('referno_id'=>$referno_id,'payday'=>$referno_info[1]));
		if ($is_pay)die;
		// 将支付信息插入wz_online_pay_item表
		$this->db->insert('online_pay_item',array('referno_id'=>$referno_id,'pay_money'=>$money_order,'acct_name'=>'张晓雅','id_no'=>'8888','referno'=>time().'_'.md5(time()),'payday'=>$referno_info[1]));
		// 获取已支付的总金额
		$payed_money = $this->pay_base->get_payed_money($referno_id);
		// if ($need_pay_money==$payed_money) {
		if (bccomp($need_pay_money,$payed_money,2)==0) {
			// $this->db->update('demand_referno',array('pay_schedult'=>1,'referno'=>$oid_paybill,'payday'=>date('Y-m-d G:i:s',time())),array('id'=>$no_order));
			$this->db->update('demand_referno',array('pay_schedult'=>1,'remark'=>'张晓雅','payday'=>date('Y-m-d G:i:s',time())),array('id'=>$referno_id));
			// 调用财务接口
			$orderid_nodeid = $this->db->get_one('demand_referno',array('id'=>$referno_id),'orderid,nodeid');
			$url = 'http://www.uzhuang.com/index.php?m=finance&f=acquire_online_pay&v=data&_su=uzH730';
			// $params = 'order_id='.$this->userName.'&node_id='.$this->password;
			$params = 'order_id='.$orderid_nodeid['orderid'].'&node_id='.$orderid_nodeid['nodeid'];

	        $ch = curl_init();
	        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	        curl_setopt($ch, CURLOPT_URL, $url);
	        curl_setopt($ch,CURLOPT_POSTFIELDS,$params);
	        curl_setopt($ch, CURLOPT_TIMEOUT,3);
	        $data = curl_exec($ch);
	        curl_close ($ch);
        	var_dump($data);
        	$this->tj_zhuangxiu($referno_id);
		}
        file_put_contents("/alidata/log/lianlian_log/llpay_success_log_".date('Y_W',time()).".txt", "----------------------\n支付成功SUCCESS\n商户单号{$referno_id}(demand_referno表的id)\n连连支付单号{$oid_paybill}\n支付金额{$money_order}\n支付时间".date('Y-m-d G:i:s',time())."\n----------------------", FILE_APPEND);
	}

	public function notify(){
		$llpay_config = get_config('llpayapi_config');
		//计算得出通知验证结果
		$llpayNotify = new LLpayNotify($llpay_config);
		$llpayNotify->verifyNotify();
		//获取连连支付的通知返回参数，可参考技术文档中服务器异步通知参数列表
		$no_order = $llpayNotify->notifyResp['no_order'];//商户订单号
		$oid_paybill = $llpayNotify->notifyResp['oid_paybill'];//连连支付单号
		$result_pay = $llpayNotify->notifyResp['result_pay'];//支付结果，SUCCESS：为支付成功
		$money_order = $llpayNotify->notifyResp['money_order'];// 支付金额
		$acct_name = $llpayNotify->notifyResp['acct_name'];// 付款人姓名
		$id_no = $llpayNotify->notifyResp['id_no'];// 支付银行卡号后4位
		if ($llpayNotify->result) {//验证成功
			if($result_pay == "SUCCESS"){// 支付成功
				// 获取支付项唯一编号
				$referno_info = explode('_',$no_order);
				$referno_id = $referno_info[0];
				// 获取需要支付的金额
				$need_pay_money = $this->db->get_one('demand_referno',array('id'=>$referno_id),'needmoney');
				$need_pay_money = floatval($need_pay_money['needmoney']);
				$payed_money0 = $this->pay_base->get_payed_money($referno_id);
				if (bccomp($need_pay_money,$payed_money0,2)==0) {
					die(json_encode(array('code'=>0,'message'=>'已经支付完成')));
				}
				$is_pay = $this->db->get_one('online_pay_item',array('referno_id'=>$referno_id,'payday'=>$referno_info[1]));
				if ($is_pay)die;
				// 将支付信息插入wz_online_pay_item表
				$this->db->insert('online_pay_item',array('referno_id'=>$referno_id,'pay_money'=>$money_order,'acct_name'=>$acct_name,'id_no'=>$id_no,'referno'=>$oid_paybill,'payday'=>$referno_info[1]));
				// 获取已支付的总金额
				$payed_money = $this->pay_base->get_payed_money($referno_id);
				// if ($need_pay_money==$payed_money) {
				if (bccomp($need_pay_money,$payed_money,2)==0) {//支付完成
					// $this->db->update('demand_referno',array('pay_schedult'=>1,'referno'=>$oid_paybill,'payday'=>date('Y-m-d G:i:s',time())),array('id'=>$no_order));
					$this->db->update('demand_referno',array('pay_schedult'=>1,'remark'=>$acct_name,'payday'=>date('Y-m-d G:i:s',time())),array('id'=>$referno_id));
					// 调用财务接口
					$orderid_nodeid = $this->db->get_one('demand_referno',array('id'=>$referno_id),'orderid,nodeid');
					$url = 'http://www.uzhuang.com/index.php?m=finance&f=acquire_online_pay&v=data&_su=uzH730';
					// $params = 'order_id='.$this->userName.'&node_id='.$this->password;
					$params = 'order_id='.$orderid_nodeid['orderid'].'&node_id='.$orderid_nodeid['nodeid'];

			        $ch = curl_init();
			        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			        curl_setopt($ch, CURLOPT_URL, $url);
			        curl_setopt($ch,CURLOPT_POSTFIELDS,$params);
			        curl_setopt($ch, CURLOPT_TIMEOUT,3);
			        $data = curl_exec($ch);
			        curl_close ($ch);
			        $this->tj_zhuangxiu($referno_id);
				}
				file_put_contents("/alidata/log/lianlian_log/llpay_success_log_".date('Y_W',time()).".txt", "----------------------\n支付成功{$result_pay}\n商户单号{$referno_id}(demand_referno表的id)\n连连支付单号{$oid_paybill}\n支付金额{$money_order}\n支付时间".date('Y-m-d G:i:s',time())."\n----------------------", FILE_APPEND);
				//payAfter($llpayNotify->notifyResp);
			}
			// file_put_contents("log.txt", "异步通知 验证成功\n", FILE_APPEND);
			die("{'ret_code':'0000','ret_msg':'交易成功'}"); //请不要修改或删除
		} else {// 支付失败
			$this->db->update('demand_referno',array('pay_schedult'=>2),array('id'=>$referno_id));
			file_put_contents("/alidata/log/lianlian_log/llpay_error_log_".date('Y_W',time()).".txt", "----------------------\n支付失败{$result_pay}\n商户单号{$referno_id}(demand_referno表的id)\n连连支付单号{$oid_paybill}\n支付金额{$money_order}\n----------------------", FILE_APPEND);
			//验证失败
			die("{'ret_code':'9999','ret_msg':'验签失败'}");
			//调试用，写文本函数记录程序运行情况是否正常
			//logResult("这里写入想要调试的代码变量值，或其他运行的结果记录");
		}
	}

	public function tj_zhuangxiu($referno_id){
        $referno_id = $this->db->get_one('demand_referno','id="'.$referno_id.'"','orderid,nodeid');
		$orderid = $referno_id['orderid'];
		$nodeid = $referno_id['nodeid'];
		$stat = $this->db->get_one('award_nodestatus','orderid="'.$orderid.'" and nodeid="'.$nodeid.'"');
	    $set = $this->db->get_one('demand','id="'.$orderid.'"','payment_id,totalpay');
	    $res1 = $this->db->get_one('award_demand_code',"order_id={$orderid} and money!=50",'uid,money,order_id,contract_status');
		$res2 = $this->db->get_one('award_demand_code',array('order_id'=>$orderid,'money'=>50),'pid,order_id,contract_status');
		$rat = $this->db->get_one('demand_referno','orderid="'.$orderid.'" and nodeid="'.$nodeid.'"');
		$dena_com = $this->db->get_one('demand_company','orderid="'.$orderid.'" and isdel=0');
		if($nodeid==19 && $dena_com['addtime']<'2017-12-14 12:00:00'){
			if($rat['is_online'] ==0 || $rat['pay_schedult']==1){
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
		}else if($dena_com['addtime']<'2017-12-14 12:00:00'){
		    $dema = $this->db->get_one('demand','id="'.$orderid.'"','payment_id');
		    $refes = $this->db->get_one('demand_referno','orderid="'.$orderid.'" and nodeid="'.$nodeid.'"','needmoney');
			$moneys=$refes['needmoney']/$set['totalpay'];
		    if($res1['contract_status']==0){
			    if($dema['payment_id']){
		            $method = $this->db->get_list('f_payment_method','payment_id="'.$dema['payment_id'].'" and node_id!="45"','*',0,1,$page,'node_id desc');
		            if($moneys<0.8){
				        if($nodeid == $method[0]['node_id']){
		                	if($rat['is_online'] ==0 || $rat['pay_schedult']==1){
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

?>