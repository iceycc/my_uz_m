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
class WUZHI_online_pay extends WUZHI_foreground {
    function __construct() {
	   parent::__construct();
	}

    // 获取在线支付已经支付的金额
    public function get_payed_money($id){
        if (!$id) {
            die(json_encode(array('code'=>0,'data'=>'','message'=>'获取已支付金额id获取失败')));
        }
        // 获取支付的金额
        $payed_item = $this->db->get_list('online_pay_item',array('referno_id'=>$id),'pay_money');
        $payed_money = 0;
        // 计算已支付金额总和
        foreach ($payed_item as $key => $value) {
          $payed_money = floatval(bcadd(floatval($value['pay_money']),$payed_money,2));// floatval($value['pay_money']);
        }
        return $payed_money;
    }

    // 获取该订单已经支付的笔数
    public function get_pay_count($id){
        $count = $this->db->count('online_pay_item',array('referno_id'=>$id));
        return intval($count['num']);
    }

    // 获取单项支付的
    public function get_payed_info($id){
        $payed_result = $this->db->get_one('online_pay_item',array('referno_id'=>$id),'pay_money,referno,payday');
        return $payed_result;
    }
}