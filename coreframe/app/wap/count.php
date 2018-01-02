<?php
// +----------------------------------------------------------------------
// | wuzhicms [ 五指互联网站内容管理系统 ]
// | Copyright (c) 2014-2015 http://www.wuzhicms.com All rights reserved.
// | Licensed ( http://www.wuzhicms.com/licenses/ )
// | Author: wangcanjia <phpip@qq.com>
// +----------------------------------------------------------------------
header("Access-Control-Allow-Origin: *");
defined('IN_WZ') or exit('No direct script access allowed');
header("Content-type:text/html;charset=utf-8");
/**
 * 首页
 */
load_class('foreground', 'member');
class count extends WUZHI_foreground {
	function __construct() {
        $this->member = load_class('member', 'member');
        load_function('common', 'member');
        $this->member_setting = get_cache('setting', 'member');
        parent::__construct();
	}
  public function index(){
    $count_get=get_cache('count','count');
    $browseCount = (int)$count_get['count_num']+1;
    if($browseCount>6136){
    $sums =$browseCount;
    }else{
    $sums = 6136+$browseCount;
    }
    $arr = array('count_num'=>$sums);
    set_cache('count',$arr,'count');
    $count_get=get_cache('count','count');
    echo json_encode(array('code'=>1,'data'=>$count_get,'message'=>'操作成功','process_time'=>time())); exit;
  }

}