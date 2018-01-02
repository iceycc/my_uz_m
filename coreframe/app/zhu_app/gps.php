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
	class gps extends WUZHI_foreground {
    function __construct() {
	      $this->member = load_class('member', 'member');
	        load_function('common', 'member');
	        $this->member_setting = get_cache('setting', 'member');
	        parent::__construct();
	} 

	private static $_instance;
		const REQ_GET = 1;
		const REQ_POST = 2;
	private function async($url, $params = array(), $encode = true, $method = self::REQ_GET)
		 {
		 $ch = curl_init();
		  if ($method == self::REQ_GET)
		  {
		   $url = $url . '?' . http_build_query($params);
		   $url = $encode ? $url : urldecode($url);
		   curl_setopt($ch, CURLOPT_URL, $url);
		  }
		   else
		  {
		   curl_setopt($ch, CURLOPT_URL, $url);
		   curl_setopt($ch, CURLOPT_POST, true);
		   curl_setopt($ch, CURLOPT_POSTFIELDS, $params);
		  }
		  curl_setopt($ch, CURLOPT_REFERER, '百度地图referer');
		  curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (iPhone; CPU iPhone OS 7_0 like Mac OS X; en-us) AppleWebKit/537.51.1 (KHTML, like Gecko) Version/7.0 Mobile/11A465 Safari/9537.53');
		  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		  $resp = curl_exec($ch);
		  curl_close($ch);
		  return $resp;
	}


	  /**
	  * ip定位
	  * @param string $ip
	  * @return array
	  * @throws Exception
	  */
	public function locationByIP(){
	  $ip = '202.97.224.69';
	  //检查是否合法IP
	  if (!filter_var($ip, FILTER_VALIDATE_IP))
	  {
	   throw new Exception('ip地址不合法');
	  }
	  $params = array(
	    'ak' => 'BiYl0zyGXDl3E67wPxyGYGyP',
	    'ip' => $ip,
	    'coor' => 'bd09ll'//百度地图GPS坐标
	  );
	  $api = 'http://api.map.baidu.com/location/ip';
	  $resp = $this->async($api, $params);
	  $data = json_decode($resp, true);
	  //有错误
	  if ($data['status'] != 0)
	  {
	   throw new Exception($data['message']);
	  }
	  //返回地址信息
	  $arr=array(
	    'address' => $data['content']['address'],
	    'province' => $data['content']['address_detail']['province'],
	    'city' => $data['content']['address_detail']['city'],
	    'district' => $data['content']['address_detail']['district'],
	    'street' => $data['content']['address_detail']['street'],
	    'street_number' => $data['content']['address_detail']['street_number'],
	    'city_code' => $data['content']['address_detail']['city_code'],
	    'lng' => $data['content']['point']['x'],
	    'lat' => $data['content']['point']['y']
	  );
	  var_dump($arr);
	}
  



 /**
  * GPS定位
  * @param $lng
  * @param $lat
  * @return array
  * @throws Exception
  */
    public function locationByGPS(){
      $lat = 44.8;
      $lng = 116.5;
      //$lat = $GLOBALS['lat'];
      //$lng = $GLOBALS['lng'];
	  $params = array(
	    'coordtype' => 'wgs84ll',
	    //'location' => '39.88,116.43',
	    'location' => $lat . ',' . $lng,
	    'ak' => 'BiYl0zyGXDl3E67wPxyGYGyP',
	    'output' => 'json',
	    'pois' => 0,
	  );
	  $resp = $this->async('http://api.map.baidu.com/geocoder/v2/', $params, false);
	  $data = json_decode($resp, true);
	  //var_dump($resp);
	  if ($data['status'] != 0)
	  {
	   throw new Exception($data['message']);
	  }
	  $arr=array(
	    'address' => $data['result']['formatted_address'],
	    'province' => $data['result']['addressComponent']['province'],
	    'city' => $data['result']['addressComponent']['city'],
	    'street' => $data['result']['addressComponent']['street'],
	    'street_number' => $data['result']['addressComponent']['street_number'],
	    'city_code'=>$data['result']['cityCode'],
	    'lng'=>$data['result']['location']['lng'],
	    'lat'=>$data['result']['location']['lat']
	  );
	  var_dump($arr);
	}

}

