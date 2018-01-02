<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<title>连连支付wap交易接口</title>
</head>
<?php


/* *
 * 功能：连连支付wap交易接口接入页
 * 版本：1.2
 * 修改日期：2014-06-13
 * 说明：
 * 以下代码只是为了方便商户测试而提供的样例代码，商户可以根据自己网站的需要，按照技术文档编写,并非一定要使用该代码。
 */
require_once ("llpay.config.php");
require_once ("lib/llpay_submit.class.php");

	public function llpay(){
		echo "llpay";
	}

/**************************请求参数**************************/

	//商户用户唯一编号
	$user_id = '666';

	//支付类型
	$busi_partner = '109001';

	//商户订单号
	$no_order = '9876548798';
	//商户网站订单系统中唯一订单号，必填

	//付款金额
	$money_order = '0.01';
	//必填

	//商品名称
	$name_goods = '装修费用';

	//风险控制参数
	$risk_item = '{\"user_info_bind_phone\":\"13958069593\",\"user_info_dt_register\":\"20131030122130\",\"risk_state\":\"1\",\"frms_ware_category\":\"1009\"}';

	//服务器异步通知页面路径
	$notify_url = "http://10.10.110.246/llpay/notify_url.php";
	//需http://格式的完整路径，不能加?id=123这类自定义参数

	//页面跳转同步通知页面路径
	$return_url = "http://10.10.110.246/llpay/return_url.php";
	//需http://格式的完整路径，不能加?id=123这类自定义参数，不能写成http://localhost/

/************************************************************/

/*
 * version
 * sign
 */

//构造要请求的参数数组，无需改动
$parameter = array (
	"oid_partner" => trim($llpay_config['oid_partner']),// 商户在连连支付支付平台上开设的商户号码,为18位数字  y
	"app_request" => trim($llpay_config['app_request']),// 请求应用标识 1-Android 2-ios 3-WAP  y
	"sign_type" => trim($llpay_config['sign_type']),// 签名方式RSA或者MD5   y
	"valid_order" => trim($llpay_config['valid_order']),// 订单有效时间  分钟为单位,默认为10080分钟(7天)  n
	"user_id" => $user_id,//商户用户唯一编号   y
	"busi_partner" => $busi_partner,// 虚拟商品：101001 实物商品：109001   y
	"no_order" => $no_order,// 订单号 y
	"dt_order" => local_date('YmdHis', time()),// 商户订单时间 y
	"name_goods" => $name_goods,// 商品名称 y
	"info_order" => $info_order,// 订单描述   n
	"money_order" => $money_order,// 交易金额  y
	"notify_url" => $notify_url,// 服务器异步通知地址 y
	"url_return" => $return_url,// 支付结束回显url n
	"card_no" => $card_no,// 银行卡号 n
	"acct_name" => $acct_name,// 银行账号姓名 n
	"id_no" => $id_no,// 证件号码 n
	"no_agree" => $no_agree,// 签约协议号 n
	"risk_item" => $risk_item,// 风险控制参数 y
);

//建立请求
$llpaySubmit = new LLpaySubmit($llpay_config);
$html_text = $llpaySubmit->buildRequestForm($parameter, "post", "确认");
echo $html_text;
?>
</body>
</html>