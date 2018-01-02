<?php
	defined('IN_WZ') or exit('No direct script access allowed');
	//↓↓↓↓↓↓↓↓↓↓请在这里配置您的基本信息↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓
	//商户编号是商户在连连钱包支付平台上开设的商户号码，为18位数字，如：201408071000001543
	$llpay_config['oid_partner'] = '201706231001848521';

//秘钥格式注意不能修改（左对齐，右边有回车符）
$llpay_config['RSA_PRIVATE_KEY'] ='-----BEGIN RSA PRIVATE KEY-----
MIIEpAIBAAKCAQEApb5ehGUfe3ZUfdkaz2C5Kbik9tPekA1MWfYD6A/jmlTVs9RO
3R4Br5lpz3z5UDoH5P4JqMzD9wq06tfaeHbtQ7UjKY7rLDqE9ogR+IcH4QRWRV2D
EEZleesgN3Oe3Iy+7S7CJ8dFYGgdOpcyc32iIImPTWvG7VxTfuPUj1nZOscy7jws
uZTtUeHrsqLa7q6iNC4tL3t4j0m8TO3cenDWT3L0OGDnAqSwA52enChGMj4jVLKe
AqMduVB0buwleEq7BwtdGB6+sYmAAP8m/srI5XnHpKnQ+Gcmnt6ZXeos+GsCbDn/
DAqTKuOF6xeHVc5moAxa+S0GavXia+6bKDxXkwIDAQABAoIBAErSGnbn84NXkqLR
LDIrtsrnyMiIMnOTHUGLNo4/Bf84htRMZmGZVyd/OO3qu92EpOWx7IhgD6LpGWze
johNH6SuE7aCBxYLQNTN7lbkFiF1RMDBixYAwXR9OSjvL+reOp51uj4czevMdE1r
zeGm+FZ54tAPdFjYkfS5Qs6Hv/GxGujrADRAbzQ8hQRqIIM2uHCHl5iSpEk7+n2y
ysFzUfdkbPtaiCze3bCMGlD1edXpkU4xRN7kC0Ct5Kqd5/EHwQ4uc7Yx3hqom5oP
XmdRsSazYYgCekqLPpLlsghHcR9MUDT+X5BQeVVczVEh0CVSc2ofCFDuH/Y3I8z3
Yr+8n0kCgYEA1cG44eXcVJ6x0Z6QaM4LBJ7UVSvJ7I7xgvvU2T4ALn+yHfdDsrMU
QjqQ40o2geaME/W2KOKvEJqoCQgpUWTLB1jKBfdfWiwuZfCOMOye2jr3FoVFCPUl
L4HF4lMzOa5pu8UCYnVGYobVs9KqpBJNbFmeI9f7NMk/cjFpLZupNP0CgYEAxn+X
ZqCGMoB3WUfeLGg00zrkUTUXdqn+Y/Y0K6tsV7ruQOM5ZmZUd5Xt7Zf73dyuqooQ
jKAE2qzKll4ywCYWk09sGI1fb8Prd35wWftKyyjFXsJ6MeiKh1LqhF6yZ26ucd0h
F3b3VR1iuh5RIpOm1kGZKBUVz1gm/zXdQAHUK88CgYEAmhKGNp0+EOhJ93O5VzGc
k3oARlvHsfDed7EZHHUqIFn+gsblTvrxUUNxh8LIQx1wPjrPT+0Ejo1LLSdq0LY7
+VGwXFiPrClIUEXx16XWYio6S0tIFUrNwM5jWdzqgVsL70HzlBA/6WiSxIjGYnim
wcBe0istcEDWsHKZAzy92+kCgYACHsLDOdu1FmIv9fCNkN9fkjV2GJcTkWVCNBMC
lGYn2btJviOS0Gz+if9slj7+c6j58VeT6PGkVEwlpwPrwXxkPmjtKjVmwDT3pcYV
b/WwjdLt3C3p8o3oPB59I3XMXQZH+RCta3vg0NuJGWHMeL9DcpfsMa119X8VIsIm
ON7HSQKBgQDQnLOSULVCt8b+Vq0Ee1dnE3BhXCo8K5iBvctEjrH9m8gLOgb2i2CU
smYsrxvA3DPEeDHppo3Sar3wdAGjtVpEQ3jMIj/O+B/hT1ORRNDRdEDhhGinDvIK
bh7v9sM/A+SRCLYixceCstR3nJJYVgkXhN52Nt1/gbpvv+3gsgNU9g==
-----END RSA PRIVATE KEY-----';


	//安全检验码，以数字和字母组成的字符
	// $llpay_config['key'] = '201408071000001539_sahdisa_20141205';

	//↑↑↑↑↑↑↑↑↑↑请在这里配置您的基本信息↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑

	//版本号
	$llpay_config['version'] = '1.1';

	//请求应用标识 为wap版本，不需修改
	$llpay_config['app_request'] = '3';


	//签名方式 不需修改
	$llpay_config['sign_type'] = strtoupper('RSA');

	//订单有效时间  分钟为单位，默认为10080分钟（7天） 
	$llpay_config['valid_order'] ="10080";

	//字符编码格式 目前支持 gbk 或 utf-8
	$llpay_config['input_charset'] = strtolower('utf-8');

	//访问模式,根据自己的服务器是否支持ssl访问，若支持请选择https；若不支持请选择http
	$llpay_config['transport'] = 'http';

	// 
	$llpay_config['busi_partner'] = '101001';// 虚拟商品：101001 实物商品：109001
	return $llpay_config
?>