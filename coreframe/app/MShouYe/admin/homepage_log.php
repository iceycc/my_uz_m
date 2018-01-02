<?php
// +----------------------------------------------------------------------
// | wuzhicms [ 五指互联网站内容管理系统 ]
// | Copyright (c) 2014-2015 http://www.wuzhicms.com All rights reserved.
// | Licensed ( http://www.wuzhicms.com/licenses/ )
// | Author: wangcanjia <phpip@qq.com>
// +----------------------------------------------------------------------
header('Content-type:text/html;charset=utf-8');
defined('IN_WZ') or exit('No direct script access allowed');
require_once(COREFRAME_ROOT.'app/core/libs/class/Gd.class.php');
/**
 * 内容添加
 */
load_class('admin');
define('HTML',true);
class homepage_log extends WUZHI_admin {
    private $status_array = array(
        1=>'发布',
        3=>'草稿',
        1=>'上架',
        2=>'下架',
        4=>'删除',
    );
  
    function __construct() {
        $this->db = load_class('db');
        $this->private_check();
    }
  
   public function listing(){
    $keytypess = $GLOBALS['shang'];
    $select = $GLOBALS['select'];
    $keyValue = $GLOBALS['keyValue'];
    $page = isset($GLOBALS['page']) ? intval($GLOBALS['page']) : 1;
    $page = max($page,1);
       switch ($select){
           case 1:
               $where1 = "housekeeper = ".'"'.$keyValue.'"';
               break;
           case 2:
               $where1 = "orderid = ".'"'.$keyValue.'"';
               break;
           case 3:
               $where1 = "logname = ".'"'.$keyValue.'"';
               break;

       }
                   if ($keytypess == 3360) {
                       $where = "areaid_2='3360'";
                   } else if ($keytypess == 3362) {
                       $where = "areaid_2='3362'";
                   } else if ($keytypess == 328) {
                       $where = "areaid_2='328'";
                   } else if ($keytypess == 326) {
                       $where = "areaid_2='326'";
                   } else if ($keytypess == 3361) {
                       $where = "areaid_2='3361'";
                   } else if ($keytypess == 435) {
                       $where = "areaid_2='435'";
                   } else if ($keytypess == 213) {
                       $where = "areaid_2='213'";
                   } else if ($keytypess == 200) {
                       $where = "areaid_2='200'";
                   } else if ($keytypess == 295) {
                       $where = "areaid_2='295'";
                   } else if ($keytypess == 278) {
                       $where = "areaid_2='278'";
                   } else if ($keytypess == 382) {
                       $where = "areaid_2='382'";
                   }
                    if($where1 != ""){
                      if($where){
                          $where = $where . 'and '.$where1;
                      }else{
                          $where = $where1;
                      }

                   }

                   if ($GLOBALS['pai'] == "tshang") {
                       $result = $this->db->get_list('day_log_demand_list', $where, 'logname,areaid_2,addtime,nodename,log_intervene,orderid,url,nodeid,uid,deadline_m_time', 0, 10, $page, 'addtime ASC');
                   } else if ($GLOBALS['pai'] == "txia") {
                       $result = $this->db->get_list('day_log_demand_list', $where, 'logname,areaid_2,addtime,nodename,log_intervene,orderid,url,nodeid,uid,deadline_m_time', 0, 10, $page, 'addtime DESC');
                   } else if ($GLOBALS['pai'] == "gshang") {
                       $result = $this->db->get_list('day_log_demand_list', $where, 'logname,areaid_2,addtime,nodename,log_intervene,orderid,url,nodeid,uid,deadline_m_time', 0, 10, $page, 'log_intervene ASC');
                   } else if ($GLOBALS['pai'] == "gxia") {
                       $result = $this->db->get_list('day_log_demand_list', $where, 'logname,areaid_2,addtime,nodename,log_intervene,orderid,url,nodeid,uid,deadline_m_time', 0, 10, $page, 'log_intervene DESC');
                   } else {
                       $result = $this->db->get_list('day_log_demand_list', $where, 'logname,areaid_2,addtime,nodename,log_intervene,orderid,url,nodeid,uid,deadline_m_time', 0, 10, $page, 'addtime DESC');
                   }


                  //=echo "<pre>";print_r($result);exit;
                $pages = $this->db->pages;
                $totals = $this->db->number;
                $s=0;
                foreach ($result as $key => $value) {
                    if(strtotime($value['deadline_m_time']) < time()){

                        $this->db->update('day_log_demand_list',array('log_intervene'=> 0),array('orderid'=>$value['orderid']));
                    }
                    $cityId = $value['areaid_2'];
                    $where6 = "`lid` in ($cityId)";
                    // 查询条件
                    $area=$this->db->get_list('linkage_data', $where6,'name');

                    $result[$s]['shi'] = $area[0]['name'];
                    $s++;
                }


    include $this->template('homepage_log_listing');
    }
     public function intervene_log(){
       $result = $this->db->get_one('day_log_demand_list'," orderid='".$GLOBALS['orderid']."'");
       include $this->template('homepage_log_intervene');
    }
    public function intervenes_log(){

        $formdata = array();
        $formdata['log_intervene'] = $GLOBALS['log_intervene'];
        $formdata['deadline_m_time'] = $GLOBALS['deadline_m_time'];
        $this->db->update('day_log_demand_list',$formdata,array('orderid'=>$GLOBALS['orderid']));
        MSG('<script>setTimeout("top.dialog.get(window).close().remove();",700),parent.iframeid.location.reload();</script>申请已提交');
    }

   
    private function _status($status) {
        $status_array = $this->status_array;
        $string = '';
        foreach($status_array as $k=>$s) {
            if($k==$status) {
                $string .= '<a href="#" class="btn btn-primary btn-sm dropdown-toggle" data-toggle="dropdown" data-hover="dropdown"><i class="icon-check btn-icon"></i>'.$s.'<span class="caret"></span></a>';
            }
        }
        $string .= '<ul class="dropdown-menu">';
        foreach($status_array as $k=>$s) {
            if($k!=$status) {
                $url = URL().'&status='.$k;
                $url = url_unique($url);
                $string .= '<li><a href="?'.$url.'">'.$s.'</a></li>';
            }
        }
        $string .= '</ul>';
        return $string;
    }
    private function private_check() {
        $role = $_SESSION['role'];
        if($role==='1') return true;
        $actionids = array(1=>'listing',2=>'add',3=>'edit',4=>'delete',5=>'sort');
        if(in_array(V,$actionids)) {
            $cid = intval($GLOBALS['cid']);
            if($cid==0) return true;
            $actionids = array_flip($actionids);
            $actionid = $actionids[V];
            if(!$this->db->get_one('category_private',array('role'=>$role,'cid'=>$cid,'actionid'=>$actionid))) {
                //查看副栏目是否给予权限，如果有，则继承权限
                $category = get_cache('category_'.$cid,'content');
                if($category['pid']) {
                    if($this->db->get_one('category_private',array('role'=>$role,'cid'=>$category['pid'],'actionid'=>$actionid))) {
                        return true;
                    }
                }
                MSG(L('no content private'));
            }
        }
    }
    public function Sync(){
        $db = load_class('db');
         $company=$db->get_list('company',$where,"*");
             foreach ($company as $key => $value) {
                $res=$db->get_one('m_company',"id='".$value['companyid']."'");
                if($res['id']!=$value['companyid']){
     $db->query("insert into wz_m_company(id,cid,title,search_data,css,thumb,keywords,remark,block,url,sort,status,route,publisher,addtime,updatetime,areaid_1,areaid_2,areaid) select id,cid,companyname,thumb,remark,url,sort,addtime,updatetime,address,companylogo,avg_total,avg_service,avg_design,avg_quality from wz_company where id='".$value['companyid']."'");
                    }
             }

    } 
 
}