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
     * 水电现场
     */
load_class('foreground', 'member');
class sd_log extends WUZHI_foreground {
    function __construct() {
        $this->member = load_class('member', 'member');
        load_function('common', 'member');
        $this->member_setting = get_cache('setting', 'member');
        parent::__construct();
    }

    public function bag(){
        $day_log = get_config('log_config');
        $acquiesce=$GLOBALS['acquiesce'];
        $nodeid =$GLOBALS['nodeid'];
        $ends = $GLOBALS['ends'];
        $uid=get_cookie('_uid');
        $page = intval($GLOBALS['page']);
         if(!isset($page)||empty($page)){
                   $page=1;
         }
        $arr=array();
        $where = "nodeid in (25,27)";
        $log_rssss = $this->db->get_list('day_log_demand_list',$where, 'logname,userid,recphoto,addtime,nodename,orderid,nodeid,uid');
        $log_rs = $this->db->get_list('day_log_demand_list',$where, 'logname,sitephoto,userid,recphoto,addtime,nodename,orderid,nodeid,uid', 0, 4, $page, 'addtime DESC');
        $c=count($log_rssss);
        $page_max=ceil($c/4);  
        foreach ($log_rs as $key => $value) {
        $arr[$key]['result'] = unserialize($value['recphoto']);
        $arr[$key]['results']= unserialize($value['sitephoto']);
        $arr[$key]['logname']=$value['logname'];
        $arr[$key]['uids']=$value['uid'];
        $arr[$key]['nodename']=$value['nodename'];
        $arr[$key]['orderid']=$value['orderid'];
        $arr[$key]['addtime']=time_format1(strtotime($value['addtime']));

        if(!preg_match("/[\x7f-\xff]/", $arr[$key]['addtime'])){
            $arr[$key]['addtime']=date('Y-m-d',strtotime($value['addtime']));
        }
        $aaa=array_filter($arr[$key]['result']);
        $arr[$key]['photo']=array_slice($aaa,-1,1);
        $bbb=array_filter($arr[$key]['results']);
        $arr[$key]['photos']=array_slice($bbb,-1,1);
        if( $arr[$key]['photo']){
          if (is_array($arr[$key]['result'][0])) {
            $keys = array_keys($arr[$key]['result'][0]);
            if($arr[$key]['result'][0][$keys[0]][0]){
              $arr[$key]['recphoto']='http://www.uzhuang.com/image/pic_230/'.$arr[$key]['result'][0][$keys[0]][0];
            }
          }else{
            $arr[$key]['recphoto'] ='http://www.uzhuang.com/image/pic_230/'.$arr[$key]['photo'][0];
          } 
        }else{
            $arr[$key]['recphoto']=1;
        }
        if($arr[$key]['photos']){
          if(is_array($arr[$key]['results'][0])){
              $keys = array_keys($arr[$key]['results'][0]);
              if($arr[$key]['results'][0][$keys[0]][0]){
                $arr[$key]['sitephoto']='http://www.uzhuang.com/image/pic_230/'.$arr[$key]['results'][0][$keys[0]][0]; 
              }
          }else{
              $arr[$key]['sitephoto']='http://www.uzhuang.com/image/pic_230/'.$arr[$key]['photos'][0];
          }
        }
        }
        foreach ($log_rs as $key => $value) { 
          $log_r= $this->db->get_one('member_hk_data',array('uid'=>$value['userid']), 'uid,gjname,personalphoto,lifeword');
          $arr[$key]['uid']=$log_r['uid'];
          $arr[$key]['gjname']=$log_r['gjname'];
          $arr[$key]['personalphoto']=$log_r['personalphoto'];
        }

        foreach ($arr as $pk => $pl) {
           $uid_log=$this->db->get_one('day_log_demand_list',"`orderid`= '".$pl['orderid']."'",'title,uid');
            if($uid_log['uid']!=$uid || empty($uid_log['uid'])){
              $log_exist=(int)0;
            }else{
              $log_exist=(int)1;
            }
            $arr[$pk]['log_exist']=$log_exist;
           $arr[$pk]['personalphotos'] ='http://www.uzhuang.com/image/pic_230/'.$arr[$pk]['personalphoto'];                                      
        }
        if(empty($arr)){
        echo json_encode(array('code'=>0,'data'=>null,'message'=>'数据错误','process_time'=>time())); exit;
        }else{
          return $arr_finally=array(
            'arr'=>$arr,
            'page_max'=>$page_max,
          );    
        }     
    }

    public function listl(){
      $arr2=$this->bag();
      echo json_encode(array('code'=>1,'data'=>$arr2,'message'=>'水电现场','process_time'=>time())); exit;
    }
}
?>