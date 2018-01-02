<?php
// +----------------------------------------------------------------------
// | wuzhicms [ 五指互联网站内容管理系统 ]
// | Copyright (c) 2014-2015 http://www.wuzhicms.com All rights reserved.
// | Licensed ( http://www.wuzhicms.com/licenses/ )
// | Author: wangcanjia <phpip@qq.com>
// +----------------------------------------------------------------------
defined('IN_WZ') or exit('No direct script access allowed');
load_class('foreground', 'member');
require_once ("lib/llpay_submit.class.php");
class llpay extends WUZHI_foreground{
    public $llpay_config;
    public $pay_base;
    function __construct() {
        $this->llpay_config = get_config('llpayapi_config');
        $this->pay_base = load_class('online_pay', 'llpay');
        parent::__construct();
	}

    public function pay(){
        //获取用户id
        $uid = get_cookie('_uid');
        if(!is_numeric($uid)){
            die(json_encode(array('code'=>0,'data'=>'','message'=>'用户编号格式不正确')));
        }
        //获取付款项的id
        $id = remove_xss($GLOBALS['id']);
        if (!$id) {
            echo json_encode(array('code'=>0,'data'=>'','message'=>'付款订单唯一标识获取失败'));die;
        }
        if (!is_numeric($id)) {
            die(json_encode(array('code'=>0,'data'=>'','message'=>'id格式不正确')));
        }
        //获取订单号
        $orderid = remove_xss($GLOBALS['orderid']);
        if (!$orderid) {
            echo json_encode(array('code'=>0,'data'=>'','message'=>'订单号获取失败'));die;
        }
        if (!is_numeric($orderid)) {
            die(json_encode(array('code'=>0,'data'=>'','message'=>'订单编号格式不正确')));
        }
        //获取节点号
        $nodeid = remove_xss($GLOBALS['nodeid']);
        if (!$nodeid) {
            echo json_encode(array('code'=>0,'data'=>'','message'=>'节点号获取失败'));die;
        }
        if (!is_numeric($nodeid)) {
            die(json_encode(array('code'=>0,'data'=>'','message'=>'订单节点格式不正确')));
        }
        // 接收支付金额
        $money = remove_xss($GLOBALS['money']);
        $money = floatval($money);
        // 判断金钱类型是否为数字
        if (!is_numeric($money)) {
            die(json_encode(array('code'=>0,'data'=>'','message'=>'付款金额应为数字')));
        }
        if (floatval($money)<=0) {
            die(json_encode(array('code'=>0,'data'=>'','message'=>'付款钱数应大于0')));
        }
        // 获取支付成功后的返回地址
        $url_return = remove_xss($GLOBALS['url_return']);

        // 获取金额、增减项计算应支付的金额
        $money_info = $this->db->get_one('demand_referno',array('id'=>$id,'orderid'=>$orderid,'nodeid'=>$nodeid,'is_online'=>1,'pay_schedult'=>0),'id,needmoney,extrapay,deposit_money,addtime');
        if(!$money_info){
            die(json_encode(array('code'=>0,'data'=>'','message'=>'该支付订单不存在无法完成支付')));
        }
        /*
         * 计算支付金额
         */
        /*if($nodeid==19){
            // 待支付金额
            $pay_money = floatval($money_info['needmoney']);//-floatval($money_info['deposit_money']);
        }else{*/
        // 待支付金额
        $pay_money = floatval($money_info['needmoney']);//+floatval($money_info['extrapay']);
        // 获取已支付金额
        $payed_money = $this->pay_base->get_payed_money($id);
        // 支付成功后返回URL
        $payed_add_money = bcadd($payed_money, $money,2);
        if(bccomp($pay_money, $payed_add_money,2)==1)$url_return = "mobile-wait_pay.html?orderid=".$orderid."&nodeid=".$nodeid."&id=".$id;
        // 计算待支付金额
        $pay_money = floatval(bcsub($pay_money, $payed_money,2));//$pay_money - $payed_money;
        // }
        if (bccomp($money,$pay_money,2)==1) {
            die(json_encode(array('code'=>0,'data'=>'','message'=>'支付金额不能大于未支付金额。')));
        }
        //根据订单编号获取用户id、订单时间(在线支付使用)
        $user_order_info = $this->db->get_one('demand',array('id'=>$orderid),'uid,addtime');
        $userid = $user_order_info['uid'];
        if (intval($uid)!==intval($userid)) {
            echo json_encode(array('code'=>0,'data'=>'','message'=>'用户id出现问题'));die;
        }

        // 查找用户的手机号、注册时间
        $get_user_info = $this->db->get_one('member',array('uid'=>$uid),'mobile,regtime');
        if(!$get_user_info['regtime']){
            $regtime = time();
            $get_user_info['regtime'] = $regtime;
            $this->db->update('member',array('regtime'=>$regtime),array('uid'=>$uid));
        }
        /*
         * 开始构造连连支付需要的参数
        */
       // $count = $this->pay_base->get_pay_count($id);
       $no_order = $id.'_'.time();//订单号
        $parameter = array (
            "oid_partner" => trim($this->llpay_config['oid_partner']),// 商户在连连支付支付平台上开设的商户号码,为18位数字  y
            "app_request" => trim($this->llpay_config['app_request']),// 请求应用标识 1-Android 2-ios 3-WAP  y   
            "sign_type" => trim($this->llpay_config['sign_type']),// 签名方式RSA或者MD5   y
            // "valid_order" => trim($this->llpay_config['valid_order']),// 订单有效时间  分钟为单位,默认为10080分钟(7天)  n
            "user_id" => $userid,//商户用户唯一编号   y
            "busi_partner" => trim($this->llpay_config['busi_partner']),// 虚拟商品：101001 实物商品：109001   y
            "no_order" => $no_order,//$id 订单号 y
            "dt_order" => local_date('YmdHis', $money_info['addtime']),//$money_info['addtime'] 商户订单时间 y
            // "name_goods" => "装修费用——{$money}——订单编号({$no_order})",// 商品名称 y
            "name_goods" => "装修费用",// 商品名称 y
            // "info_order" => $info_order,// 订单描述   n
            "money_order" => $money,//'0.01',//$money 交易金额  y
            // "notify_url" => "http://10.10.110.246/llpay/notify_url.php",// 服务器异步通知地址 y
            "notify_url" => WEBURL."notify_url",// 服务器异步通知地址 y
            "url_return" => WEBURL.$url_return,// 支付结束回显url n
            "version" => $this->llpay_config['version'],// 版本号
            "risk_item" => '{\"frms_ware_category\":\"2031\",\"user_info_mercht_userno\":\"'.$uid.'\",\"user_info_dt_register\":\"'.date("YmdHis",$get_user_info["regtime"]).'\",\"user_info_bind_phone\":\"'.$get_user_info["mobile"].'\",\"user_info_identify_state\":\"0\"}' // 风险控制参数 y
        );
        $llpaySubmit = new LLpaySubmit($this->llpay_config);
        $html_text = $llpaySubmit->buildRequestForm($parameter, "post", "确认");
        $html_text=  urlencode($html_text);

        $go_url = "https://wap.lianlianpay.com/payment.htm?req_data={$html_text}";
        $data = array();
        $data['go_url'] = $go_url;
        die(json_encode(array('code'=>1,'data'=>$data,'message'=>'请求成功')));
        
        // echo $html_text;
    }
}