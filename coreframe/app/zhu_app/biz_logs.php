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
    class biz_logs extends WUZHI_foreground {
    function __construct() {
          $this->member = load_class('member', 'member');
            load_function('common', 'member');
            $this->member_setting = get_cache('setting', 'member');
            parent::__construct();
    }

    public function autoexec1(){
    	$where = "`condition`=0";
        $rest = $this->db->get_list('day_log',$where,'id,remark,condition,orderid', 0, 21, $page,'nodeid DESC');
        //var_dump($rest);exit;
        $remark = unserialize($rest[0]['remark']);
        for($i=0;$i<count($remark[0]['sNum_SOW']);$i+=1) {
        	$data['proName_SOW'] = $remark[0]['proName_SOW'][$i];
        	$data['brand_SOW'] = $remark[0]['brand_SOW'][$i];
        	$data['accQua_SOW'] = $remark[0]['accQua_SOW'][$i];
        	$data['unquaRea_SOW'] = $remark[0]['unquaRea_SOW'][$i];
        	$data['accDate_SOW'] = $remark[0]['accDate'][$i];
        	$data['overDate_SOW'] = $remark[0]['overDate_SOW'][$i];
        	$data['day_log_id'] =$rest[0]['id'];
            $data['orderid'] =$rest[0]['orderid'];
        	$this->db->insert('m_construction',$data);
        }
        var_dump($rest[0]['orderid']);
        $this->db->update('day_log', array('condition'=>1), array('id' => $rest[0]['id']));
    }

    public function test(){
    	$arr=array(
    	'autoexec'=>$this->autoexec(),
    		);
    }
}