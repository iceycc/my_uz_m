<?php
// +----------------------------------------------------------------------
// | wuzhicms [ ÎåÖ¸»¥ÁªÍøÕ¾ÄÚÈÝ¹ÜÀíÏµÍ³ ]
// | Copyright (c) 2014-2015 http://www.wuzhicms.com All rights reserved.
// | Licensed ( http://www.wuzhicms.com/licenses/ )
// | Author: wangcanjia <phpip@qq.com>
// +----------------------------------------------------------------------
/**
 * ÊÕ²Ø¼Ð
 */
header("Access-Control-Allow-Origin: *");
defined('IN_WZ') or exit('No direct script access allowed');
load_class('foreground', 'member');
class member_lognew extends WUZHI_foreground {
    public $pay_base;
    function __construct() {
        $this->pay_base = load_class('online_pay', 'llpay');
        $this->member = load_class('member', 'member');
        $this->log = load_class('log','wap');
        load_function('common', 'member');
        $this->member_setting = get_cache('setting', 'member');
        parent::__construct();
        $auth = get_cookie('auth');
        $auth_key = substr(md5(_KEY), 8, 8);
        list($uid, $password, $cookietime) = explode("\t", decode($auth, $auth_key));
        if(empty($uid)){
            echo json_encode(array('code'=>0,'data'=>array('member'=>null),'message'=>L('login_please'),'process_time'=>time()));exit;
        }
        $this->member_info = $this->db->get_list('member', "`uid`='$uid'", '*');
        $this->member_info = $this->member_info[0];
        if(empty($this->member_info['uid'])){
            echo json_encode(array('code'=>0,'data'=>array('member'=>null),'message'=>L('login_please'),'process_time'=>time()));exit;
        }
        $file = 'uploadfile/member/'.substr(md5($this->member_info['uid']), 0, 2).'/'.$uid.'/180x180.jpg';
        //var_dump($this->member_info['avatar']);exit;
        if($this->member_info['avatar']==1){
           $this->member_info['avatar'] ='http://www.uzhuang.com/'.$file;
        }elseif(strlen($this->member_info['avatar'])>5){
           $this->member_info['avatar']=$this->member_info['avatar'];             
        }else{
           $this->member_info['avatar']= R.'images/userface.png';
      }
    }
    // 我的工地列表页接口
    public function log_list(){
        $uid=get_cookie('_uid');
        //$uid = 25518;
        $arr=array();
        $arrs=array();
        $ars=array();
        $aar=array();
        $arra= array();
        $resul2= array();
        if($uid){
         $result= $this->db->get_list('demand',"uid='".$uid."' and nodeid is not null",'title,id,order_no,address,nodename,nodeid,orderstatus,housekeeperid',0,100,$page,'addtime DESC');
         foreach ($result as $k => $v) {
            if($v['nodeid']==3){
              $v['nodeid'] =2;
              $v['nodename'] ='分配装修公司';
            }  

            $sta = $this->db->get_list('demand_track','orderid="'.$v['id'].'" and nodeid>=10 and nodeid!=102 and nodeid!=101','nodeid',0,30,$page,'nodeid desc','nodeid');
           if($sta){
           $where40 = "orderid='".$v['id']."' and nodeid!=101 and nodeid!=102";
           }else{
           $where40 = "orderid='".$v['id']."'";
           }

            $resu= $this->db->get_list('demand_track',$where40,'nodename,nodeid,date1',0,1,$page,'nodeid desc','nodeid');
            $resul= $this->db->get_list('demand_track',"orderid ='".$v['id']."'",'orderid,nodeid,date1',0,100,$page,'nodeid desc','nodeid');
            $arra = array();
            foreach ($resul as $key => $value) {
              $arra[$value['nodeid']]= $value;
              $resul=$arra; 
            }
            if($resu[0]['nodeid']>=21&&$resu[0]['nodeid']!=101&&$resu[0]['nodeid']!=102){
                $ars['id']=$v['id'];
                $str .= $ars['id'].',';
                $arrs['ids']=trim($str,',');
                $time= $this->db->get_one('demand_track',"orderid ='".$v['id']."' and nodeid=21",'date1');
                $a=time()-strtotime($time['date1']);
                $days=round((time()-strtotime($time['date1']))/3600/24);
                $arr[$k]['order_no']=$v['order_no'];
                $arr[$k]['orderid']=$v['id'];
                if($resu[0]['nodeid']>37){
                $arr[$k]['status']='已竣工';
                }else if($resu[0]['nodeid']>=21 && $resu[0]['nodeid']<=37){
                if($resul[21]){
                  $a=array_search(max($resul),$resul);
                  if($resul[$a]['nodeid']==37){
                      //echo "<pre>";print_r($resu[0]['nodeid']);
                    $aar[$k]['time1']= $this->db->get_one('demand_track',"orderid ='".$v['id']."' and nodeid='".$resu[0]['nodeid']."'",'date1');
                    //echo "<pre>";print_r($aar[$k]['time1']['date1']);
                    $arr[$k]['status'] = "开工".round((strtotime($aar[$k]['time1']['date1'])-strtotime($time['date1']))/3600/24)."天";
                    }else{
                    $aar[$k]['time1']= time();
                    $arr[$k]['status'] = "开工".round(($aar[$k]['time1']-strtotime($time['date1']))/3600/24)."天"; 
                    }
                }else{
                $arr[$k]['status'] = '装修中';
                }
                }
                if($resu[0])
                $arr[$k]['nodename']=$resu[0]['nodename'];
                $arr[$k]['nodeid'] = $v['nodeid'];
                $arr[$k]['orderstatus']=$v['orderstatus'];
            }else{
              if(!empty($v['nodename'])){
                if($v['nodeid']==1){
                $arr[$k]['nodename']='装修订单审核';
                $arr[$k]['nodeid'] = $v['nodeid'];
                }else if($v['nodeid']==0){
                $arr[$k]['nodename']='装修订单审核';
                $arr[$k]['nodeid'] = $v['nodeid']; 
                }/*else if($v['nodeid']==102){
                  $arr[$k]['nodename']='见面';
                  $arr[$k]['nodeid'] = $v['nodeid'];
                }*/else{
                $arr[$k]['nodename']=$resu[0]['nodename'];
                $arr[$k]['nodeid'] = $v['nodeid'];
                }
              }else{
                $arr[$k]['nodename']='装修订单审核';
                if($v['nodeid']>=10){
                  $get_nodeid = $this->db->get_one('demand_track',"orderid={$v['id']} and nodeid!=101 and nodeid!=102",'nodeid',0,'nodeid desc');
                  if(!$get_nodeid)$get_nodeid = $this->db->get_one('demand_track',array('orderid'=>$v['id']),'nodeid',0,'nodeid desc');
                  $get_nodename = $this->db->get_one('f_node',array('node_id'=>$get_nodeid['nodeid']),'node_name');
                  $arr[$k]['nodename']=$get_nodename['node_name'];
                }
                $arr[$k]['nodeid'] = $v['nodeid'];
              }
                $arr[$k]['order_no']=$v['order_no'];
                $arr[$k]['orderid']=$v['id'];
                $arr[$k]['status']='未开工';
            }
            $arr[$k]['address']=$v['address'];
            $coms_where = "orderid={$v['id']} and nodeid=13 and (col8='是' or col8=1)";
            $com = $this->db->get_one('demand_track_detail',$coms_where,"col2,col1",0,"id desc");
            if(!$com){
              $company=$this->db->get_one('demand_track_detail',"orderid='".$v['id']."' and nodeid=13 and col8 is null" ,"col2,col1",0,"id desc");
            }else{
              $company = $com;
            }
            $arr[$k]['company_id'] = $company['col1'];
            $cou=array();
            $re=array();
            if($resul[27] || $resul[31] || $resul[35] || $resul[37]){
              foreach ($resul as $ke => $val) {
                if($val['nodeid']==27 || $val['nodeid']==31 || $val['nodeid']==35 || $val['nodeid']==37){
                  $cou[]=$val;
                  $re[]= $this->db->get_one('log_graded','nodeid="'.$val['nodeid'].'" and orderid="'.$val['orderid'].'"'); 
                }
              }
              $count=count($cou);
              $r=count(array_filter($re));
              $arr[$k]['count'] =$count-$r;
            }else{
              $arr[$k]['count'] =0;
            }
            if($resu[0]['nodeid']>=10 && $resu[0]['nodeid']<=51){
                $arr[$k]['addtime']=time_format1(strtotime($resu[0]['date1']));
                if(!preg_match("/[\x7f-\xff]/", $arr[$k]['addtime'])){
                    $arr[$k]['addtime']=date('Y-m-d',strtotime($resu[0]['date1']));
                }
                $log_r= $this->db->get_one('member_hk_data','uid="'.$v['housekeeperid'].'"', 'uid,gjname,personalphoto,level');
                $arr[$k]['gjname'] = $log_r['gjname'];
                if($log_r['level']==1){
                  $arr[$k]['level']='金牌管家';
                }else if($log_r['level']==0){
                  $arr[$k]['level']='装修管家';
                }else if($log_r['level']==2){
                  $arr[$k]['level']='资深管家';
                }
                $arr[$k]['uid'] = $log_r['uid'];
                  if($log_r['personalphoto']){
                  $arr[$k]['personalphoto'] = 'http://www.uzhuang.com/image/pic_230/'.$log_r['personalphoto'];
                  }else{
                  $arr[$k]['personalphotos']='http://m.uzhuang.com/res/img/guanjia.png';
                  }
            }
            #caozhi add begin
            #列表页获取订单的状态
            $order_status = array();
            // 获取待验收的数据
            $where_check = "orderid={$v['id']} and checked_status=2 and (nodeid=27 or nodeid=31 or nodeid=35 or nodeid=37)";
            $unchecked = $this->db->get_list('demand_track',$where_check,'orderid,nodeid');
            $order_status['unchecked'] = count($unchecked)?$unchecked:null;
            // 获取代支付的数据
            $unpay = $this->db->get_list('demand_referno',array('orderid'=>$v['id'],'is_online'=>1,'pay_schedult'=>0),'id,orderid,nodeid');
            $order_status['unpay'] = count($unpay)?$unpay:null;
            // 获取待评价的数据
            // 水电工程验收(27)、瓦木工程验收(31)、油漆工程验收(35)、竣工验收(37)
            $evaluate_nodes = array('27','31','35','37');
            $unevaluates = array();
            foreach ($evaluate_nodes as $nodekey => $nodeval) {
              // 查看该节点是否完成
              $is_complete = $this->db->get_one('demand_track',array('orderid'=>$v['id'],'nodeid'=>$nodeval),'orderid,nodeid');
              if ($is_complete) {
                $evaluate_res = $this->db->get_one('log_graded',array('orderid'=>$v['id'],'nodeid'=>$nodeval));
                if (!$evaluate_res) {
                  array_push($unevaluates, $is_complete);
                }
              }
            }
            $order_status['unevaluate'] = count($unevaluates)?$unevaluates:null;
            if(count($unchecked)){
              $order_status['step'] = 1;//待验收
              $arr[$k]['count'] =count($unchecked);
            }else if(count($unpay)){
              $order_status['step'] = 2;//待支付
              $arr[$k]['count'] =count($unpay);
            }else if(count($unevaluates)){
              $order_status['step'] = 3;//待评价
              $coms_where = "orderid={$v['id']} and nodeid=13 and (col8='是' or col8=1)";
              $coms = $this->db->get_one('demand_track_detail',$coms_where,"col2,col1",0,"id desc");
              if($coms){
              $arr[$k]['count'] =count($unevaluates);
              }else{
              $arr[$k]['count'] =0;
              }
            }else{
              $order_status['step'] = 0;//以上三种都没有
            }
            $arr[$k]['order_status'] = $order_status;
            #caozhi add end
         }
         if($arr){
         echo json_encode(array('code'=>1,'data'=>$arr,'message'=>'我的工地列表页','process_time'=>time())); exit;
         }else{
         echo json_encode(array('code'=>0,'data'=>null,'message'=>'您还没有工地~','process_time'=>time())); exit;  
         }
        }else{
         echo json_encode(array('code'=>0,'data'=>null,'message'=>'您还没有登陆~','process_time'=>time())); exit;   
        }
    }
    //写评分
    public function write_score(){
      $formdata = array();
      $arr = array();
      $arrs = array();
      $array= array();
      //$upda = 1 修改状态
      //$upda = 2 追加状态
        $upda= $GLOBALS['upda'];
        $orderid= $GLOBALS['orderid'];
      if($orderid){
        $formdata['orderid'] =$orderid;
        $nodeid= $GLOBALS['nodeid'];
        $formdata['nodeid'] = $nodeid;
        //装修公司施工质量
        $formdata['quality']=$GLOBALS['quality'];
        //装修公司服务态度
        $formdata['manner']=$GLOBALS['manner'];
        //装修公司施工时效
        $formdata['capacity']=$GLOBALS['capacity'];
        //装修公司设计评分
        $formdata['design']=$GLOBALS['design'];
        //管家专业技能
        $formdata['professional']=$GLOBALS['professional'];
        //管家服务态度
        $formdata['serve']=$GLOBALS['serve'];
        //管家协调能力
        $formdata['coordinate']=$GLOBALS['coordinate'];
        //装修公司
        $company_id=$GLOBALS['company_id'];
        $formdata['company_id']=$company_id;
        //管家
        $housekeeper_id = $GLOBALS['housekeeper_id'];
        $formdata['housekeeper_id'] =$housekeeper_id;
        //评价内容
        $formdata['content'] = $GLOBALS['content'];
        //追加评价
        $formdata['additional'] = $GLOBALS['additional'];
        //追加评价数
        $formdata['additional_num'] = $GLOBALS['additional_num'];
        //修改评分数
        $formdata['modification_num'] = $GLOBALS['modification_num'];
        //添加及修改评分时间
        $formdata['addtime'] = time();
        //追评时间
        $form['additional_time'] = time();
        //追评
        $res = $this->db->get_one('log_graded','orderid = "'.$formdata['orderid'].'" and nodeid = "'.$formdata['nodeid'].'"');
        $re = $this->db->get_one('log_graded_amend','orderid = "'.$formdata['orderid'].'" and nodeid = "'.$formdata['nodeid'].'"');
        if($upda == 2){
        $arr['additional_num'] = $formdata['additional_num'];
        $arr['additional'] = $formdata['additional'];
        if($re){
        $this->db->update('log_graded_amend',array('additional' =>$formdata['additional'],'additional_num'=>$formdata['additional_num'],'additional_time'=>$form['additional_time']),array('orderid'=>$formdata['orderid'],'nodeid'=>$formdata['nodeid']));
        }else{
        $this->db->update('log_graded',array('additional' =>$formdata['additional'],'additional_num'=>$formdata['additional_num'],'additional_time'=>$form['additional_time']),array('orderid'=>$formdata['orderid'],'nodeid'=>$formdata['nodeid']));
        }
        echo json_encode(array('code'=>1,'data'=>$arr,'message'=>'追加评分成功','process_time'=>time()));exit;
        //修改
        }else if($upda == 1){
         if($re['nodeid']==$formdata['nodeid']){
         echo json_encode(array('code'=>0,'data'=>null,'message'=>'修改节点已评','process_time'=>time()));exit;
         }else{
          $this->db->insert('log_graded_amend',$formdata);
          if($res['additional_time']){
           $this->db->update('log_graded_amend',array('additional_time'=>$res['additional_time']),array('orderid'=>$formdata['orderid'],'nodeid'=>$formdata['nodeid']));
          }
          $arr['modification_num'] = $formdata['modification_num'];
          $this->contrary_graded_logic($orderid,$nodeid,$company_id,$housekeeper_id);
          echo json_encode(array('code'=>1,'data'=>$arr,'message'=>'修改评分成功','process_time'=>time()));exit;
         }
        }else{
          if($res['nodeid']==$formdata['nodeid']){
          echo json_encode(array('code'=>0,'data'=>null,'message'=>'节点已评','process_time'=>time()));exit;
          }else{
          $this->db->insert('log_graded',$formdata);
          $this->positive_graded_logic($orderid,$nodeid,$company_id,$housekeeper_id);
          echo json_encode(array('code'=>1,'data'=>null,'message'=>'评分成功','process_time'=>time()));exit;
          }
        }
      }else{
          echo json_encode(array('code'=>0,'data'=>null,'message'=>'订单ID不存在','process_time'=>time()));exit;
      }
    }

    //正向评分逻辑
    public function positive_graded_logic($orderid,$nodeid,$company_id,$housekeeper_id){
          $result = $this->db->count('log_graded','orderid="'.$orderid.'"');
          if($result['num']==4){
           $re = $this->db->get_list('log_graded_amend','orderid="'.$orderid.'" and nodeid!=37');
           $r = $this->db->get_list('log_graded_amend','orderid="'.$orderid.'" and nodeid=37');
           foreach ($re as $key => $value) {
            $arr[] = $value['nodeid'];
           }
           foreach ($r as $k => $v) {
            $arr1[] = $v['nodeid'];
           }
           if(in_array("27",$arr)){
              $arra[] = '';
           }else{
              $arra[] = 27;
           }
           if(in_array("31",$arr)){
              $arra[] = '';
           }else{
              $arra[] = 31;
           }
           if(in_array("35",$arr)){
              $arra[] = '';
           }else{
              $arra[] = 35;
           }
           if(in_array("37",$arr1)){
              $arra1[] = '';
           }else{
              $arra1[] = 37;
           }
           $a = implode(',',array_values(array_filter($arra)));
           $b = implode(',',array_values(array_filter($arra1)));
           $log_graded = $this->db->get_list('log_graded','orderid="'.$orderid.'" and nodeid in('.$a.') and nodeid!=37');
           $log_graded1 = $this->db->get_list('log_graded','orderid="'.$orderid.'" and nodeid="'.$b.'"');
           //27 31 35
           $merge=array_merge($re,$log_graded);
           //37
           $merge1=array_merge($r,$log_graded1);
           foreach ($merge as $key => $value) {
            //装修公司
            $arrs['quality'][] = $value['quality'];
            $arrs['manner'][] = $value['manner'];
            $arrs['capacity'][] = $value['capacity'];
            $arrs['design'][] = $value['design'];
            $arrs['professional'][] = $value['professional'];
            $arrs['serve'][] = $value['serve'];
            $arrs['coordinate'][] = $value['coordinate'];
           }
           $array['quality'] = array_sum($arrs['quality']);
           $array['manner'] = array_sum($arrs['manner']);
           $array['capacity'] = array_sum($arrs['capacity']);
           $array['design'] = array_sum($arrs['design']);
           $array['professional'] = array_sum($arrs['professional']);
           $array['serve'] = array_sum($arrs['serve']);
           $array['coordinate'] = array_sum($arrs['coordinate']);
           //一、装修公司
           //设计水平分值=竣工验收设计水平评分
           $des = $merge1[0]['design'];
           //施工质量分值=竣工验收点评分*50%+（水电工程验收+瓦木工程验收+油漆工程验收）/3*50%
           $qua = round($merge1[0]['quality']*0.5+($array['quality']/3)*0.5,1);
           //服务态度分值=竣工验收点评分*50%+（水电工程验收+瓦木工程验收+油漆工程验收）/3*50%
           $man = round($merge1[0]['manner']*0.5+($array['manner']/3)*0.5,1);
           //施工时效分值=竣工验收点评分*50%+（水电工程验收+瓦木工程验收+油漆工程验收）/3*50%
           $cap = round($merge1[0]['capacity']*0.5+($array['capacity']/3)*0.5,1);
           //二、管家
           //专业能力=竣工验收点评分*50%+（水电工程验收+瓦木工程验收+油漆工程验收）/3*50%
           $pro = round($merge1[0]['professional']*0.5+($array['professional']/3)*0.5,1);
           //服务态度=竣工验收点评分*50%+（水电工程验收+瓦木工程验收+油漆工程验收）/3*50%
           $ser = round($merge1[0]['serve']*0.5+($array['serve']/3)*0.5,1);
           //响应速度=竣工验收点评分*50%+（水电工程验收+瓦木工程验收+油漆工程验收）/3*50%
           $coo = round($merge1[0]['coordinate']*0.5+($array['coordinate']/3)*0.5,1);
           //装修公司
           $company = $this->db->get_one('company','id="'.$company_id.'"','quality,manner,capacity,design,completed_num');
           $design =$company['design']+$des;
           $quality=$company['quality']+$qua;
           $manner = $company['manner']+$man;
           $capacity = $company['capacity']+$cap;
           $completed_num = $company['completed_num']+1;
           $this->db->update('company',array('quality'=>$quality,'manner'=>$manner,'capacity'=>$capacity,'design'=>$design,'completed_num'=>$completed_num),array('id'=>$company_id));
           //管家
           $hk_data = $this->db->get_one('member_hk_data','uid="'.$housekeeper_id.'"','professional,serve,coordinate,completed_num');
           $professional = $hk_data['professional']+$pro;
           $serve = $hk_data['serve']+$ser;
           $coordinate = $hk_data['coordinate']+$coo;
           $completed_num1 = $hk_data['completed_num']+1;
           $this->db->update('member_hk_data',array('professional'=>$professional,'serve'=>$serve,'coordinate'=>$coordinate,'completed_num'=>$completed_num1),array('uid'=>$housekeeper_id));
         }
    }
    //反向评分逻辑
    public function contrary_graded_logic($orderid,$nodeid,$company_id,$housekeeper_id){
          $result = $this->db->count('log_graded','orderid="'.$orderid.'"');
          if($result['num']==4){
           $re = $this->db->get_list('log_graded_amend','orderid="'.$orderid.'" and nodeid!=37');
           $r = $this->db->get_list('log_graded_amend','orderid="'.$orderid.'" and nodeid=37');
           foreach ($re as $key => $value) {
            $arr[] = $value['nodeid'];
           }
           foreach ($r as $k => $v) {
            $arr1[] = $v['nodeid'];
           }
           if(in_array("27",$arr)){
              $arra[] = '';
           }else{
              $arra[] = 27;
           }
           if(in_array("31",$arr)){
              $arra[] = '';
           }else{
              $arra[] = 31;
           }
           if(in_array("35",$arr)){
              $arra[] = '';
           }else{
              $arra[] = 35;
           }
           if(in_array("37",$arr1)){
              $arra1[] = '';
           }else{
              $arra1[] = 37;
           }
           $a = implode(',',array_values(array_filter($arra)));
           $b = implode(',',array_values(array_filter($arra1)));
           //修改后的评分
           $log_graded = $this->db->get_list('log_graded','orderid="'.$orderid.'" and nodeid in('.$a.') and nodeid!=37');
           $log_graded1 = $this->db->get_list('log_graded','orderid="'.$orderid.'" and nodeid="'.$b.'"');
           //27 31 35
           $merge=array_merge($re,$log_graded);
           //37
           $merge1=array_merge($r,$log_graded1);
           foreach ($merge as $key => $value) {
            //装修公司
            $arrs['quality'][] = $value['quality'];
            $arrs['manner'][] = $value['manner'];
            $arrs['capacity'][] = $value['capacity'];
            $arrs['design'][] = $value['design'];
            $arrs['professional'][] = $value['professional'];
            $arrs['serve'][] = $value['serve'];
            $arrs['coordinate'][] = $value['coordinate'];
           }
           $array['quality'] = array_sum($arrs['quality']);
           $array['manner'] = array_sum($arrs['manner']);
           $array['capacity'] = array_sum($arrs['capacity']);
           $array['design'] = array_sum($arrs['design']);
           $array['professional'] = array_sum($arrs['professional']);
           $array['serve'] = array_sum($arrs['serve']);
           $array['coordinate'] = array_sum($arrs['coordinate']);
           //一、装修公司
           //设计水平分值=竣工验收设计水平评分
           $des = $merge1[0]['design'];
           //施工质量分值=竣工验收点评分*50%+（水电工程验收+瓦木工程验收+油漆工程验收）/3*50%
           $qua = round($merge1[0]['quality']*0.5+($array['quality']/3)*0.5,1);
           //服务态度分值=竣工验收点评分*50%+（水电工程验收+瓦木工程验收+油漆工程验收）/3*50%
           $man = round($merge1[0]['manner']*0.5+($array['manner']/3)*0.5,1);
           //施工时效分值=竣工验收点评分*50%+（水电工程验收+瓦木工程验收+油漆工程验收）/3*50%
           $cap = round($merge1[0]['capacity']*0.5+($array['capacity']/3)*0.5,1);
           //二、管家
           //专业能力=竣工验收点评分*50%+（水电工程验收+瓦木工程验收+油漆工程验收）/3*50%
           $pro = round($merge1[0]['professional']*0.5+($array['professional']/3)*0.5,1);
           //服务态度=竣工验收点评分*50%+（水电工程验收+瓦木工程验收+油漆工程验收）/3*50%
           $ser = round($merge1[0]['serve']*0.5+($array['serve']/3)*0.5,1);
           //响应速度=竣工验收点评分*50%+（水电工程验收+瓦木工程验收+油漆工程验收）/3*50%
           $coo = round($merge1[0]['coordinate']*0.5+($array['coordinate']/3)*0.5,1);
           //未修改的评分
           $log_gradeds = $this->db->get_list('log_graded','orderid="'.$orderid.'" and nodeid!=37');
           $log_gradeds1 = $this->db->get_list('log_graded','orderid="'.$orderid.'" and nodeid=37');
           foreach ($log_gradeds as $ke => $val) {
            //装修公司
            $ar['quality'][] = $val['quality'];
            $ar['manner'][] = $val['manner'];
            $ar['capacity'][] = $val['capacity'];
            $ar['design'][] = $val['design'];
            $ar['professional'][] = $val['professional'];
            $ar['serve'][] = $val['serve'];
            $ar['coordinate'][] = $val['coordinate'];
           }
           $arrays['quality'] = array_sum($ar['quality']);
           $arrays['manner'] = array_sum($ar['manner']);
           $arrays['capacity'] = array_sum($ar['capacity']);
           $arrays['design'] = array_sum($ar['design']);
           $arrays['professional'] = array_sum($ar['professional']);
           $arrays['serve'] = array_sum($ar['serve']);
           $arrays['coordinate'] = array_sum($ar['coordinate']);
           //一、装修公司
           //设计水平分值=竣工验收设计水平评分
           $des1 = $log_gradeds1[0]['design'];
           //施工质量分值=竣工验收点评分*50%+（水电工程验收+瓦木工程验收+油漆工程验收）/3*50%
           $qua1 = round($log_gradeds1[0]['quality']*0.5+($arrays['quality']/3)*0.5,1);
           //服务态度分值=竣工验收点评分*50%+（水电工程验收+瓦木工程验收+油漆工程验收）/3*50%
           $man1 = round($log_gradeds1[0]['manner']*0.5+($arrays['manner']/3)*0.5,1);
           //施工时效分值=竣工验收点评分*50%+（水电工程验收+瓦木工程验收+油漆工程验收）/3*50%
           $cap1 = round($log_gradeds1[0]['capacity']*0.5+($arrays['capacity']/3)*0.5,1);
           //二、管家
           //专业能力=竣工验收点评分*50%+（水电工程验收+瓦木工程验收+油漆工程验收）/3*50%
           $pro1 = round($log_gradeds1[0]['professional']*0.5+($arrays['professional']/3)*0.5,1);
           //服务态度=竣工验收点评分*50%+（水电工程验收+瓦木工程验收+油漆工程验收）/3*50%
           $ser1 = round($log_gradeds1[0]['serve']*0.5+($arrays['serve']/3)*0.5,1);
           //响应速度=竣工验收点评分*50%+（水电工程验收+瓦木工程验收+油漆工程验收）/3*50%
           $coo1 = round($log_gradeds1[0]['coordinate']*0.5+($arrays['coordinate']/3)*0.5,1);

           $company = $this->db->get_one('company','id="'.$company_id.'"','quality,manner,capacity,design');
           $design =$company['design']+($des-$des1);
           $quality=$company['quality']+($qua-$qua1);
           $manner = $company['manner']+($man-$man1);
           $capacity = $company['capacity']+($cap-$cap1);
           $this->db->update('company',array('quality'=>$quality,'manner'=>$manner,'capacity'=>$capacity,'design'=>$design),array('id'=>$company_id));
           $hk_data = $this->db->get_one('member_hk_data','uid="'.$housekeeper_id.'"','professional,serve,coordinate');
           $professional = $hk_data['professional']+($pro-$pro1);
           $serve = $hk_data['serve']+($ser-$ser1);
           $coordinate = $hk_data['coordinate']+($coo-$coo1);
           $this->db->update('member_hk_data',array('professional'=>$professional,'serve'=>$serve,'coordinate'=>$coordinate),array('uid'=>$housekeeper_id));
         }
    }

    //列表取评分数据
    public function list_graded(){
      $orderid = $GLOBALS['orderid'];
      $resul= $this->db->get_list('demand_track',"orderid ='".$orderid."'",'orderid,nodeid,nodename',0,100,$page,'nodeid asc');
      foreach ($resul as $key => $value) {
        $arr1 = array();
        if($value['nodeid']==27 || $value['nodeid']==31 || $value['nodeid']==35 || $value['nodeid']==37){
          $arr1[]=$value;
          $arr1=array_values($arr1);
          $re[]=$this->db->get_one('log_graded','nodeid="'.$value['nodeid'].'" and orderid="'.$value['orderid'].'"');
        }
      }
      $node= array_values(array_filter($re));
      foreach ($node as $ke => $val) {
        $set[$val['nodeid']]=$val['nodeid'];
      }
      if(in_array("27",$set)){
        $arra[] = '';
      }else{
        $arra[] = 27;
      }
      if(in_array("31",$set)){
        $arra[] = '';
      }else{
        $arra[] = 31;
      }
      if(in_array("35",$set)){
        $arra[] = '';
      }else{
        $arra[] = 35;
      }
      if(in_array("37",$set)){
        $arra[] = '';
      }else{
        $arra[] = 37;
      }
      $a = implode(',',array_values(array_filter($arra)));
      $result=$this->db->get_list('demand_track',"orderid ='".$orderid."' and nodeid in(".$a.")",'orderid,nodeid,nodename',0,100,$page,'nodeid asc');
      foreach ($result as $k => $v) {
        $arr1[$k]['orderid']=$v['orderid'];
        $arr1[$k]['nodeid']=$v['nodeid'];
        $arr1[$k]['nodename']=$v['nodename'];
        $arr = array();
        //装修公司
          $track_detail= $this->db->get_one('demand_track_detail',"orderid='".$v['orderid']."' and nodeid=13 and col8='是'",'col1,col2,col8');
          $company = $this->db->get_one('company','id="'.$track_detail['col1'].'"','title,thumb,quality,manner,capacity');
          $arr1[$k]['companyname'] = $company['title'];
          $arr1[$k]['company_id'] = $track_detail['col1'];
          $arr1[$k]['company_thumb'] = 'http://www.uzhuang.com/uploadfile/'.substr($company['thumb'],0,2).'/'.substr($company['thumb'],2,2).'/'.$company['thumb'];
          //管家
          $steward_id = $this->db->get_one('demand','id="'.$orderid.'"','housekeeperid');
          $log_r= $this->db->get_one('member_hk_data','uid="'.$steward_id['housekeeperid'].'"', 'uid,gjname,personalphoto,professional,serve,coordinate');
          $arr1[$k]['gjname'] = $log_r['gjname'];
          $arr1[$k]['housekeeper_id'] = $log_r['uid'];

          if($log_r['personalphoto']){
            $arr1[$k]['personalphotos'] = 'http://www.uzhuang.com/image/pic_230/'.$log_r['personalphoto'];
          }else{
            $arr1[$k]['personalphotos']='http://m.uzhuang.com/res/img/guanjia.png';
          }
          //$log_graded = $this->db->get_one('log_graded','orderid="'.$v['orderid'].'" and nodeid ="'.$v['nodeid'].'"');
          $log_graded_amend = $this->db->count('log_graded_amend','orderid="'.$v['orderid'].'" and nodeid ="'.$v['nodeid'].'"');
          if($log_graded_amend['num']>0){
             $result1 = $this->db->get_list('log_graded_amend','orderid="'.$v['orderid'].'" and nodeid ="'.$v['nodeid'].'"');
          }else{
             $result1 = $this->db->get_list('log_graded','orderid="'.$v['orderid'].'" and nodeid ="'.$v['nodeid'].'"');
          }
          if($result1){
            foreach ($result1 as $ke => $val) {
            $arr1[$k]['design'] = $val['design'];
            $arr1[$k]['quality'] = $val['quality'];
            $arr1[$k]['manner'] = $val['manner'];
            $arr1[$k]['capacity'] = $val['capacity'];
            $arr1[$k]['professional'] = $val['professional'];
            $arr1[$k]['serve'] = $val['serve'];
            $arr1[$k]['coordinate'] = $val['coordinate'];
            $arr1[$k]['content'] = $val['content'];
            $arr1[$k]['additional'] = $val['additional'];
            }
          }else{
            $arr1[$k]['design'] = 0;
            $arr1[$k]['quality'] = 0;
            $arr1[$k]['manner'] = 0;
            $arr1[$k]['capacity'] = 0;
            $arr1[$k]['professional'] = 0;
            $arr1[$k]['serve'] = 0;
            $arr1[$k]['coordinate'] = 0;
             $arr1[$k]['content'] = $val['content'];
            $arr1[$k]['additional'] = $val['additional'];
          }
      }
      echo json_encode(array('code'=>1,'data'=>$arr1,'message'=>'成功','process_time'=>time())); exit;
    }
    //详情取评分数据
    public function detail_graded(){
      $orderid = $GLOBALS['orderid'];
      $nodeid = $GLOBALS['nodeid'];
      $arr1 = array();
      $resul= $this->db->get_list('demand_track',"orderid='".$orderid."' and nodeid='".$nodeid."'",'orderid,nodeid,nodename');
      foreach ($resul as $k => $v) {
      $arr1[$k]['orderid'] = $v['orderid'];
      $arr1[$k]['nodename'] = $v['nodename'];
      $arr1[$k]['nodeid'] = $v['nodeid'];
      $track_detail= $this->db->get_one('demand_track_detail',"orderid='".$orderid."' and nodeid=13 and col8='是'",'col1,col2,col8');
      $company = $this->db->get_one('company','id="'.$track_detail['col1'].'"','title,thumb,quality,manner,capacity');
      $arr1[$k]['companyname'] = $company['title'];
      $arr1[$k]['company_id'] = $track_detail['col1'];
      $arr1[$k]['company_thumb'] = 'http://www.uzhuang.com/uploadfile/'.substr($company['thumb'],0,2).'/'.substr($company['thumb'],2,2).'/'.$company['thumb'];
      $steward_id = $this->db->get_one('demand','id="'.$orderid.'"','housekeeperid');
      $log_r= $this->db->get_one('member_hk_data','uid="'.$steward_id['housekeeperid'].'"', 'uid,gjname,personalphoto,professional,serve,coordinate');
      $arr1[$k]['gjname'] = $log_r['gjname'];
      $arr1[$k]['housekeeper_id'] = $log_r['uid'];
      if($log_r['personalphoto']){
            $arr1[$k]['personalphotos'] ='http://www.uzhuang.com/image/pic_230/'.$log_r['personalphoto'];
          }else{
            $arr1[$k]['personalphotos']='http://m.uzhuang.com/res/img/guanjia.png';
      }
      $log_graded_amend = $this->db->count('log_graded_amend','orderid="'.$orderid.'" and nodeid ="'.$nodeid.'"');
      if($log_graded_amend['num']>0){
          $result1 = $this->db->get_list('log_graded_amend','orderid="'.$orderid.'" and nodeid ="'.$nodeid.'"','content,design,quality,manner,capacity,professional,serve,coordinate,additional,company_id,housekeeper_id,additional,content');
          }else{
          $result1 = $this->db->get_list('log_graded','orderid="'.$orderid.'" and nodeid ="'.$nodeid.'"','content,design,quality,manner,capacity,professional,serve,coordinate,additional,company_id,housekeeper_id,content,additional');
      }
      if($result1){
        foreach ($result1 as $ke => $val) {
        $arr1[$k]['design'] = $val['design'];
        $arr1[$k]['quality'] = $val['quality'];
        $arr1[$k]['manner'] = $val['manner'];
        $arr1[$k]['capacity'] = $val['capacity'];
        $arr1[$k]['professional'] = $val['professional'];
        $arr1[$k]['serve'] = $val['serve'];
        $arr1[$k]['coordinate'] = $val['coordinate'];
        $arr1[$k]['content'] = $val['content'];
        $arr1[$k]['additional'] = $val['additional'];
        }
      }else{
        $arr1[$k]['design'] = 0;
        $arr1[$k]['quality'] = 0;
        $arr1[$k]['manner'] = 0;
        $arr1[$k]['capacity'] = 0;
        $arr1[$k]['professional'] = 0;
        $arr1[$k]['serve'] = 0;
        $arr1[$k]['coordinate'] = 0;
        $arr1[$k]['content'] = $val['content'];
        $arr1[$k]['additional'] = $val['additional'];
      }
      }
      echo json_encode(array('code'=>1,'data'=>$arr1,'message'=>'成功','process_time'=>time())); exit;
    }

    //业主写日志
    public function owner_write_log(){
      $orderid = $GLOBALS['orderid'];
      $nodeid = $GLOBALS['nodeid'];
      $owner_speak = $GLOBALS['owner_speak'];
      $arr['owner_speak'] =$owner_speak;
      $arr['user_photo'] = "http://m.uzhuang.com/res/img/yonghu.png";
      //1=评价,修改 2=删除
      $status = $GLOBALS['status'];
      $owner_date =date('Y-m-d H:i:s',time());
      if($status==1){
      $this->db->update('day_log',array('owner_speak'=>$owner_speak,'owner_date'=>$owner_date),array('orderid'=>$orderid,'nodeid'=>$nodeid));
      echo json_encode(array('code'=>1,'data'=>$arr,'message'=>'成功','process_time'=>time())); exit;
      }if($status==2){
      $this->db->update('day_log',array('owner_speak'=>''),array('orderid'=>$orderid,'nodeid'=>$nodeid));
      echo json_encode(array('code'=>0,'data'=>null,'message'=>'删除成功','process_time'=>time())); exit;
      }else{
      echo json_encode(array('code'=>0,'data'=>null,'message'=>'状态错误','process_time'=>time())); exit;
      }
    }

     //工地详情页头部公共包
    public function bags($orderid=''){
            $nodeid = 13;
            $arr1=array();
            $arr=array();
            $result= $this->db->get_one('demand',array('id'=>$orderid),'title,order_no,address,sex,homestyle,budget,housetype,area,style,way,renovationcategory,uid,xqmc,totalpay');
            //echo "<pre>";print_r($result);exit;
                $arr1['name']=$result['address'];
                $results=$this->db->get_one('member',array('uid'=>$arr1['result']['uid']),'avatar');
                $file = 'uploadfile/member/'.substr(md5($arr1['result']['uid']), 0, 2).'/'.$arr1['result']['uid'].'/180x180.jpg';
                if($results['avatar']==1){
                $arr1['avatar'] ='http://www.uzhuang.com/'.$file;
                }else{
                $arr1['avatar']= R.'images/userface.png';
                }
                $configs_picture = get_config('picture_config');
                //正常显示图片
                if($result['renovationcategory']==1){
                        $q=trim($result['homestyle'],',');
                        $w=explode(',',$q);
                        for($i=0;$i<count($w);$i++){
                          $homestyle[$i]=$configs_picture['homestyle'][$w[$i]];
                        }
                        $arr1['homestyle']=$homestyle;              
                        }else{
                        $qq=trim($result['housetype'],',');
                        $ww=explode(',',$qq);
                        for($v=0;$v<count($ww);$v++){
                          $housetype[$v]=$configs_picture['housetype'][$ww[$v]];
                        }
                        $arr1['homestyle']=$housetype;    
                        }
                        $configs_picture = get_config('picture_config');
                        $a=trim($result['way'],',');
                        $b=explode(',',$a);
                        for($i=0;$i<count($b);$i++){
                         $way[$i]=$configs_picture['way'][$b[$i]];
                        }
                        $arr1['way']=$way;
                        if($result['totalpay']>1000){
                        $arr1['budget']=sprintf("%.1f", $result['totalpay']/10000).'万';
                        }else if($result['totalpay']<1000 && $result['totalpay']!=0){
                        $arr1['budget']=number_format($result['totalpay'],1).'元';
                        }
                        $arr1['area']=$result['area'];
                $where = "id='".$orderid."'";
                $idss=$this->db->get_list('demand',$where,'order_no',0,1,$page,'id DESC');
                $arr1['order_no']=$idss[0]['order_no'];
                $ids=$this->db->get_one('demand',array('id'=>$orderid), 'housekeeperid');
                $log_r= $this->db->get_one('member_hk_data',array('uid'=>$ids['housekeeperid']), 'uid,gjname,personalphoto,mobile,level');
                //echo "<pre>";print_r($ids);exit;
                $arr1['uid']=$log_r['uid'];
                $arr1['gjname']=$log_r['gjname'];
                $arr1['mobile']=$log_r['mobile'];
                if($log_r['level']==1){
                $arr1['level']="金牌管家";
                }else{
                $arr1['level']='装修管家';
                }
                //$arr[$pk]['personalphotos'] ='http://www.uzhuang.com/image/small_square/'.$arr[$pk]['personalphoto']; 
                if(!empty($log_r['personalphoto'])){
                $arr1['personalphotos']='http://www.uzhuang.com/image/pic_230/'.$log_r['personalphoto'];
                }else{
                $arr1['personalphotos']='http://m.uzhuang.com/res/img/gjphoto.png';
                }
                //$com=$this->db->get_one('demand_track_detai',array('orderid'=>$orderid,'nodeid'=>$nodeid,'col8'=>''),"col2,col1,col8",0,"id desc");
                  $com = $this->db->get_one('demand_track_detail',array('orderid'=>$orderid,'nodeid'=>$nodeid,'col8'=>'是'),"col2,col1",0,"id desc");
                //echo "<pre>";print_r($com);
                //var_dump($com);
                if(!$com){
                  $company=$this->db->get_one('demand_track_detail',"orderid='".$orderid."' and nodeid='".$nodeid."' and col8 is null" ,"col2,col1",0,"id desc");
                }else{
                  $company = $com;
                }
                //var_dump($com);
                $res=mb_strlen($company['col2']);
                //echo "<pre>";print_r($company);exit;
                if($res>36){
                $arr1['company']=mb_substr($company['col2'], 0, 12,'utf-8').'...';
                }else{
                $arr1['company']=$company['col2'];
                }
                //var_dump($s);exit;
                $company_photo=$this->db->get_one('company',array('id'=>$company['col1']),"thumb,id",0,"id desc");
                $arr1['company_photo']='http://www.uzhuang.com/uploadfile/'.substr($company_photo['thumb'],0,2).'/'.substr($company_photo['thumb'],2,2).'/'.$company_photo['thumb'];
                $arr1['id']=$company_photo['id'];
                $payid = $this->pay_status($orderid);
                if($payid){
                  $arr1['sta'] = 1;
                }else{
                  $arr1['sta'] = 0;
                }
                //http://image-'.$srv_n.'.uzhuang.com/uploadfile/'.substr($src,0,2).'/'.substr($src,2,2).'/'.$src
                return $arr1;
                $pages = $this->db->pages;
                $total = $this->db->number;
                $configs = get_config('picture_config');              
    }
    //工地直播详情页
    //第一个接口用户进工地直播详情页   输出的数据
    public function log(){
           $orderid = $GLOBALS['orderid'];
           if($orderid){
           $uid =get_cookie('_uid');
           $fac = $this->db->get_list('demand','uid="'.$uid.'"','id');
           foreach ($fac as $kq => $vq) {
              $fa[] = $vq['id'];
           }
           if(in_array($orderid,$fa)){
           $sta = $this->db->get_list('demand_track','orderid="'.$orderid.'" and nodeid>=10 and nodeid!=102 and nodeid!=101','nodeid',0,30,$page,'nodeid desc','nodeid');
           if($sta){
           $where40 = "orderid='".$orderid."' and nodeid!=101 and nodeid!=102";
           }else{
           $where40 = "orderid='".$orderid."'";
           }
           $maxNodeId = $this->db->get_list('demand_track',$where40,'nodeid',0,1,$page,'nodeid desc','nodeid');  
           $nodeid = $maxNodeId[0]['nodeid'];
           //echo "<pre>";print_r($nodeid);exit;
           $design_rs = $this->db->get_one('day_log_demand_list', array('orderid' => $orderid),"browse_count");
           $browseCount = (int)$design_rs['browse_count']+1;
           // 跟新到数据库
           $this->db->update('day_log_demand_list',array('browse_count'=>$browseCount),array('orderid'=>$orderid));
           //调bags方法包         
           $arr=array(
              'node'=>$this->bags($orderid),
            );
           //工地直播  完结状态
           $where7= "`id`='".$orderid."' and orderstatus='完结'";
           $resul= $this->db->get_list('demand',$where7,'orderstatus');
           foreach ($resul as $key => $value) {
            $arr['orderstatus']=$value['orderstatus'];
           }

           //var_dump($retest);exit;
           //日志拆改是否显示
           $where4= "`orderid`='".$orderid."' and nodeid=23";
           $results = $this->db->get_list('demand_track',$where4,'col2');
           foreach ($results as $ke => $va) {
           $arr['col2']=$va['col2'];
            }
           //意向定金  状态
           $where5= "`orderid`='".$orderid."' and nodeid=15";
           $result = $this->db->get_list('demand_track',$where5,'col2');
           foreach ($result as $key => $val) {
           $arr['col3']=$val['col2'];
            }

           $collectstatus=$this->db->get_list('favorite',$where11,'keyid,collectstatus');
           $ar=array();
              foreach ($collectstatus as $key => $value) {
                $ar[]=$value['keyid'];
              }
              if(empty($uid)){
                $a = (empty($uid)) ? $arr['collectstatus']=0:$arr['collectstatus']=$collectstatus1['collectstatus'];
              }else{
              if(in_array($orderid,$ar)){
                $collectstatus1=$this->db->get_one('favorite',"`keyid`=$orderid and `uid`=$uid",'keyid,collectstatus');
              }
                $a = (empty($uid)) ? $arr['collectstatus']=0:$arr['collectstatus']=$collectstatus1['collectstatus'];
              }
              $arr['collectstatus']=$a;
              $arrs=array();
              $nodeids[$nodeid]=$nodeid;
              $resuls=$this->details($orderid,$nodeids);
              foreach ($resuls as $key => $value) {
                $arrs=$value;
              }
              $arr['max_logname']=$arrs;
              $where2 = "orderid='".$orderid."' and nodeid!=0";
              $res = $this->db->get_list('demand_track',$where2,'nodeid,date1', 0, 100, $page,'nodeid DESC','nodeid');
              $resu=array();
              foreach ($res as $key => $value) {
              if($value['nodeid']!=3){
                $resu[$key][]= $value['nodeid'];
                $a=substr($value['date1'],2,8);
                $resu[$key][]= $a;
              }
              //explode("@",$email); 
              //substr($value['accDate'],0,10);
              }
              // echo"<pre>";print_r($resu);
              $arr['resu']=array_values($resu);
              //$quali数组的第一个元素节点id,第二个元素合格的个数，第三个元素不合格的个数
              $quali=array();
              $quote=array();
              foreach ($arr['resu'] as $key => $value) {
              foreach ($value as $ke => $va) {
               $quali[$key][]=$va;
              }
            
            // 取合格的数据
            $qualified = $this->db->get_list('day_log',"`orderid`='".$orderid."' and `nodeid`='".$value[0]."'",'orderid,nodeid,check_detail,check_waterdetail');
           
            $qualis=string2array($qualified[0]['check_detail']);
            $quass=string2array($qualified[0]['check_waterdetail']);
             //echo "<pre>";print_r($quass);
            $ress = array_merge($qualis,$quass);
            //echo "<pre>";print_r($ress);
            $qua=array();
            $quas=array();
            foreach ($qualis as $ks => $vs) {
                if($vs['qua']=='合格'){
                     $qua[]=$vs['qua'];
                }
               
            }
            foreach ($qualis as $ks => $vs) {
                if($vs['qua']=='不合格'){
                     $quas[]=$vs['qua'];
                }
            }
            /*foreach ($ress as $kes => $vas) {
                if($vas['qua']=='合格'){
                     $water[]=$vas['qua'];
                }
            }
            foreach ($ress as $kes => $vas) {
                if($vas['qua']=='不合格'){
                     $waters[]=$vas['qua'];
                }
            }*/
            $qualified=count($qua);
            $unqualified=count($quas);
            /*$waterqua=count($water);
            $waterunqua=count($waters);*/

            $quali[$key][]=$qualified;
            $quali[$key][]=$unqualified;
            /*$quote[$key][]=$waterqua;
            $quate[$key][]=$waterunqua;*/
           }//exit;
            $arr['resu']=$quali;
            //装修对比图
            $arr['comparison_photo'] =$this->log->comparison_photo($orderid,2);
            //echo "<pre>";print_r(array_slice($arr['comparison_photo'],0,1));exit;
            #caozhi add begin
            // 获取巡检节点
            $check_node_list = $this->db->get_list('new_service',array('server_order'=>$orderid),'current_node');
            $check_nodes = array();
            foreach ($check_node_list as $key => $node) {
              array_push($check_nodes, $node['current_node']);
            }
            $arr['check_nodes'] = array_unique($check_nodes);
            #caozhi add end
           if($arr){
            echo json_encode(array('code'=>1,'data'=>$arr,'message'=>'刚进详情页的接口','process_time'=>time())); exit;
           }else{
            echo json_encode(array('code'=>0,'data'=>null,'message'=>'数据不存在','process_time'=>time())); exit;
           }
          }else{
            echo json_encode(array('code'=>2,'data'=>null,'message'=>'您无权访问此工地信息','process_time'=>time())); exit;
          }
         }else{
          echo json_encode(array('code'=>0,'data'=>null,'message'=>'订单ID不存在','process_time'=>time())); exit;
         }
    }

    // 列表页点击节点展开详情
    public function details($orderid,$nodeid){
        //装修订单审核
        if($nodeid[1]==1){
         $array=array();
         $demand =$this->db->get_one('demand',array('id'=>$orderid),'nodeid,addtime');
         $array['nodeid']=1;
         if($demand['nodeid']==0){
            $array['nodename']='装修订单审核';
            $str1 = substr($demand['addtime'],2,8);
            $array['addtime']=$str1;
            $array['title']='您的装修申请已经提交，客服会在24小时内与您联系！';
         }else if($demand['nodeid']>0){
            $array['nodename']='装修订单审核';
            $str1 = substr($demand['addtime'],2,8);
            $array['addtime']=$str1;
            $array['title']='恭喜您,您的装修申请已经通过审核!';
         }
         $resu[]=$array;
        }
        //为您精选三家公司
        if($nodeid[2]==2){
         $arr=array();
         $company= $this->db->get_list('demand_company',"orderid='".$orderid."'  and isdel=0",'companyname,companyid');
         foreach ($company as $key => $value) {
            $demands = $this->db->get_list('demand_company','companyid="'.$value['companyid'].'" and isselected="是"','orderid',0,10000,$page);
            $set =array();
            $arra =array();
            $arra1 =array();
            foreach ($demands as $k => $v) {
              $ret = $this->db->get_one('demand',"id='".$v['orderid']."' and orderstatus !='废弃订单'",'id,nodeid,nodename',0,1,$page,'nodeid desc');
              $set[$key][$k] = array_filter($ret);
            }
            foreach ($set as $ke => $val) {
              foreach ($val as $ks => $vs) {
                if($vs['nodeid']>=37 && $vs['nodeid']!=101 && $vs['nodeid']!=102){
                  if($vs){
                  $arra[$ks] = $vs;
                  }
                }else if($vs['nodeid']<37){
                  if($vs){
                  $arra1[$ks] = $vs;
                  }
                }
              }
            }
            //未完成
            $company[$key]['unfinished'] = count($arra1);
            //已完成
            $company[$key]['completed'] = count($arra);
            $co=$this->db->get_one('company',"`id`='".$value['companyid']."'",'thumb,avg_total,quality,manner,capacity,design,completed_num');
            $company[$key]['quality']=$co['quality']/$co['completed_num'];
            $company[$key]['manner']=$co['manner']/$co['completed_num'];
            $company[$key]['capacity']=$co['capacity']/$co['completed_num'];
            $company[$key]['design']=$co['design']/$co['completed_num'];
            $company[$key]['thumb']='http://www.uzhuang.com/uploadfile/'.substr($co['thumb'],0,2).'/'.substr($co['thumb'],2,2).'/'.$co['thumb'];
         }
         $arr['nodeid']=2;
         $arr['companyname']='为您精选3家装修公司';
         $str2 = substr($company[0]['date1'],2,8);
         $arr['addtime']=$str2;
         $arr['company']=$company;
         $resu[]=$arr;
        }
         //为您指定管家
        if($nodeid[9]==9){
         $ars=array();
         $d_log_list=$this->db->get_one('demand',array('id'=>$orderid), 'housekeeperid');
         $ars['name']='为您指定管家';
         $ars['nodeid']=9;
         $hk_data= $this->db->get_one('member_hk_data',array('uid'=>$d_log_list['housekeeperid']), 'uid,gjname,mobile,personalphoto,level,worktime,service_num,professional,serve,coordinate,completed_num');
         $ars['gjname'] = $hk_data['gjname'];
         $ars['mobile'] = $hk_data['mobile'];
         $ars['worktime'] = $hk_data['worktime'];
         $demand_track = $this->db->get_list('demand','housekeeperid = "'.$hk_data['uid'].'"','id,nodeid',0,10000,$page);
         foreach ($demand_track as $key => $value) {
            if($value['nodeid']>=19 && $value['nodeid']!=102 && $value['nodeid']!=101){
              $ret[] = $value;
            } 
         } 
         $ars['service_num'] = $hk_data['service_num']+count($ret);
         $ars['professional'] = $hk_data['professional']/$hk_data['completed_num'];
         $ars['serve'] = $hk_data['serve']/$hk_data['completed_num'];
         $ars['coordinate'] = $hk_data['coordinate']/$hk_data['completed_num'];
         if($hk_data['level']==0){
            $ars['level'] = '装修管家';
         }else if($hk_data['level']==1){
            $ars['level'] = '金牌管家';
         }
         $ars['personalphoto']="http://www.uzhuang.com/image/pic_230/".$hk_data['personalphoto'];
         $resu[]=$ars;
        }
         //预约见面
         if($nodeid[101]==101){
            $resu[]=$this->log->result101($orderid);
         }
         //见面
         if($nodeid[102]==102){
            $resu[]=$this->log->result102($orderid);
         }
         //预约量房
         if($nodeid[10]==10){
            $resu[]=$this->log->result0($orderid);
         }
         //上门量房
         if($nodeid[11]==11){
            $resu[]=$this->log->result1($orderid);
         }
         //报价审核
         if($nodeid[12]==12){
            $resu[]=$this->log->result2($orderid);
         }
         //签订意向定金
         if($nodeid[15]==15){
            $resu[]=$this->log->result3($orderid);
         }
         //预交底
         if($nodeid[17]==17){
            $resu[]=$this->log->result4($orderid);
         }
         //签订三方合同
         if($nodeid[19]==19){
            $resu[]=$this->log->result5($orderid);
         }
         //开工仪式
         if($nodeid[21]==21){
            $resu[]=$this->log->result6($orderid);
         }
         //水电材料验收
         if($nodeid[25]==25){
            $resu[]=$this->log->result7($orderid);
         }
         //水电工程验收
         if($nodeid[27]==27){
            $resu[]=$this->log->result8($orderid);
         }
         //防水材料验收
         if($nodeid[28]==28){
            $resu[]=$this->log->result9($orderid);
         }
         //瓦木材料验收
         if($nodeid[29]==29){
            $resu[]=$this->log->result10($orderid);
         }
         //瓦木工程验收
         if($nodeid[31]==31){
            $resu[]=$this->log->result11($orderid);
         }
         //油漆材料验收
         if($nodeid[33]==33){
            $resu[]=$this->log->result12($orderid);
         }
         //油漆工程验收
         if($nodeid[35]==35){
            $resu[]=$this->log->result13($orderid);
         }
         //安装工程验收
         if($nodeid[36]==36){
            $resu[]=$this->log->result14($orderid);
         }
         //竣工验收
         if($nodeid[37]==37){
            $resu[]=$this->log->result15($orderid);
         }
         //第一次环保监测
         if($nodeid[39]==39){
            $resu[]=$this->log->result16($orderid);
         }
         //第二次环保监测
         if($nodeid[43]==43){
            $resu[]=$this->log->result17($orderid);
         }
         //维保节点
         if($nodeid[45]==45){
            $resu[]=$this->log->result18($orderid);
         }
         //环保治理
         if($nodeid[49]==49){
            $resu[]=$this->log->result19($orderid);
         }
         //环保治理后复测
         if($nodeid[51]==51){
            $resu[]=$this->log->result20($orderid);
         }
         return $resu;
    }
    //工地直播详情页
    public function detail(){
      $orderid=$GLOBALS['orderid'];
      $uid=get_cookie('_uid');
      $resu=array();
      if($orderid){
      $results= $this->db->get_list('demand_track',"orderid='".$orderid."'",'nodeid',0,100,'','nodeid');
          $nodeid=array();
          foreach ($results as $key => $value) {
            if($value['nodeid']==45){
              $maintenance=$this->db->get_one('demand_track','orderid="'.$orderid.'" and nodeid="'.$value['nodeid'].'"','col7');
            }
            if($maintenance['col7']=='否'){
            $nodeid[$value['nodeid']]=$value['nodeid'];
            unset($nodeid['45']);
            }else{
            $nodeid[$value['nodeid']]=$value['nodeid'];
            }
          }
         //装修订单审核
        if($nodeid[1]==1){
         $array=array();
         $demand =$this->db->get_one('demand',array('id'=>$orderid),'nodeid,addtime');
         $array['nodeid']=1;
         if($demand['nodeid']==0){
            $array['nodename']='装修订单审核';
            $str1 = substr($demand['addtime'],2,8);
            $array['addtime']=$str1;
            $array['title']='您的装修申请已经提交，客服会在24小时内与您联系！';
         }else if($demand['nodeid']>0){
            $array['nodename']='装修订单审核';
            $str1 = substr($demand['addtime'],2,8);
            $array['addtime']=$str1;
            $array['title']='恭喜您,您的装修申请已经通过审核!';
         }
         $resu[]=$array;
        }
         //为您精选三家公司
        if($nodeid[2]==2){
         $arr=array();
         $company= $this->db->get_list('demand_company',"orderid='".$orderid."' and isdel=0",'companyname,companyid');
         foreach ($company as $key => $value) {
            $demands = $this->db->get_list('demand_company','companyid="'.$value['companyid'].'" and isselected="是" and isdel=0','orderid',0,10000,$page);
            $set =array();
            $arra =array();
            $arra1 =array();
            foreach ($demands as $k => $v) {
              $ret = $this->db->get_one('demand',"id='".$v['orderid']."' and orderstatus !='废弃订单'",'id,nodeid,nodename',0,1,$page,'nodeid desc');
              $set[$key][$k] = array_filter($ret);
            }
            foreach ($set as $ke => $val) {
              foreach ($val as $ks => $vs) {
                if($vs['nodeid']>=37 && $vs['nodeid']!=101 && $vs['nodeid']!=102){
                  if($vs){
                  $arra[$ks] = $vs;
                  }
                }else if($vs['nodeid']<37){
                  if($vs){
                  $arra1[$ks] = $vs;
                  }
                }
              }
            }
            //未完成
            $company[$key]['unfinished'] = count($arra1);
            //已完成
            $company[$key]['completed'] = count($arra);
            $co=$this->db->get_one('company',"`id`='".$value['companyid']."'",'thumb,avg_total,quality,manner,capacity,design,completed_num');
            $company[$key]['quality']=number_format($co['quality']/$co['completed_num'],1);
            $company[$key]['manner']=number_format($co['manner']/$co['completed_num'],1);
            $company[$key]['capacity']=number_format($co['capacity']/$co['completed_num'],1);
            $company[$key]['design']=number_format($co['design']/$co['completed_num'],1);
            $company[$key]['thumb']='http://www.uzhuang.com/uploadfile/'.substr($co['thumb'],0,2).'/'.substr($co['thumb'],2,2).'/'.$co['thumb'];
         }
         $arr['nodeid']=2;
         $arr['companyname']='为您精选3家装修公司';
         $str2 = substr($company[0]['date1'],2,8);
         $arr['addtime']=$str2;
         $arr['company']=$company;
         $resu[]=$arr;
        }
         //为您指定管家
        if($nodeid[9]==9){
         $ars=array();
         $d_log_list=$this->db->get_one('demand',array('id'=>$orderid), 'housekeeperid');
         $ars['name']='为您指定管家';
         $ars['nodeid']=9;
         $hk_data= $this->db->get_one('member_hk_data',array('uid'=>$d_log_list['housekeeperid']),'uid,gjname,mobile,personalphoto,level,worktime,service_num,professional,serve,coordinate,completed_num');
         $ars['gjname'] = $hk_data['gjname'];
         $ars['housekeeper_id'] = $hk_data['uid'];
         $ars['mobile'] = $hk_data['mobile'];
         $ars['worktime'] = $hk_data['worktime'];
         $demand_track = $this->db->get_list('demand','housekeeperid = "'.$d_log_list['housekeeperid'].'"','id,nodeid',0,10000,$page);
         foreach ($demand_track as $key => $value) {
            if($value['nodeid']>=19 && $value['nodeid']!=102 && $value['nodeid']!=101){
              $ret[] = $value;
            } 
         }  
         $ars['service_num'] = $hk_data['service_num']+count($ret);
         $ars['professional'] = number_format($hk_data['professional']/$hk_data['completed_num'],1);
         $ars['serve'] = number_format($hk_data['serve']/$hk_data['completed_num'],1);
         $ars['coordinate'] = number_format($hk_data['coordinate']/$hk_data['completed_num'],1);
         if($hk_data['level']==0){
            $ars['level'] = '装修管家';
         }else if($hk_data['level']==1){
            $ars['level'] = '金牌管家';
         }
         $ars['personalphoto']="http://www.uzhuang.com/image/pic_230/".$hk_data['personalphoto'];
         $resu[]=$ars;
        }

         //预约见面
         if($nodeid[101]==101){
            $resu[]=$this->log->result101($orderid);
         }
         //见面
         if($nodeid[102]==102){
            $resu[]=$this->log->result102($orderid);
         }
         //预约量房
         if($nodeid[10]==10){
            $resu[]=$this->log->result0($orderid);
         }
         //上门量房
         if($nodeid[11]==11){
            $resu[]=$this->log->result1($orderid);
         }
         //报价审核
         if($nodeid[12]==12){
            $resu[]=$this->log->result2($orderid);
         }
          //echo "<pre>";print_r($nodeid);exit;
         //签订意向定金
         if($nodeid[15]==15){
            $resu[]=$this->log->result3($orderid);
         }
         //预交底
         if($nodeid[17]==17){
            $resu[]=$this->log->result4($orderid);
         }
         //签订三方合同
         if($nodeid[19]==19){
            $resu[]=$this->log->result5($orderid);
         }
         //开工仪式
         if($nodeid[21]==21){
            $resu[]=$this->log->result6($orderid);
         }
         //水电材料验收
         if($nodeid[25]==25){
            $resu[]=$this->log->result7($orderid);
         }

         //水电工程验收
         if($nodeid[27]==27){
            $resu[]=$this->log->result8($orderid);
         }
         //防水材料验收
         if($nodeid[28]==28){
            $resu[]=$this->log->result9($orderid);
         }
         //瓦木材料验收
         if($nodeid[29]==29){
            $resu[]=$this->log->result10($orderid);
         }
         //瓦木工程验收
         if($nodeid[31]==31){
            $resu[]=$this->log->result11($orderid);
         }
         //油漆材料验收
         if($nodeid[33]==33){
            $resu[]=$this->log->result12($orderid);
         }
         //油漆工程验收
         if($nodeid[35]==35){
            $resu[]=$this->log->result13($orderid);
         }
         //安装工程验收
         if($nodeid[36]==36){
            $resu[]=$this->log->result14($orderid);
         }
         //竣工验收
         if($nodeid[37]==37){
            $resu[]=$this->log->result15($orderid);
         }
         //第一次环保监测
         if($nodeid[39]==39){
            $resu[]=$this->log->result16($orderid);
         }
         //第二次环保监测
         if($nodeid[43]==43){
            $resu[]=$this->log->result17($orderid);
         }
         //维保节点
         if($nodeid[45]==45){
            $resu[]=$this->log->result18($orderid);
         }
         //环保治理
         if($nodeid[49]==49){
            $resu[]=$this->log->result19($orderid);
         }
         //环保治理后复测
         if($nodeid[51]==51){
            $resu[]=$this->log->result20($orderid);
         }
         if($resu){
         echo json_encode(array('code'=>1,'data'=>$resu,'message'=>'节点以进行','process_time'=>time())); exit;
         }else{
         echo json_encode(array('code'=>0,'data'=>null,'message'=>'节点未进行','process_time'=>time())); exit;  
         }
        }else{
         echo json_encode(array('code'=>0,'data'=>null,'message'=>'订单ID不存在','process_time'=>time())); exit; 
        }
    }

    //查看更多验收项
    public function public_get_checked_item(){
        $orderid = $GLOBALS['orderid'];
        $nodeid =$GLOBALS['nodeid'];
        $title=array();
        $item_result = $this->db->get_one('day_log',array('orderid'=>$orderid,'nodeid'=>$nodeid),'check_detail');
        $result = array();
        $result['check_detail'] = string2array($item_result['check_detail']);
        foreach ($result as $key => $value) {
          foreach ($value as $keys => $values) {
            if($values['qua']=='合格' && $values['img_yse']==''){
             $title[]=$values['title'];
            }
          }
        }
        echo json_encode(array('code'=>1,'data'=>$title,'message'=>'查看更多验收项','process_time'=>time())); exit;
    }
    //查看更多验收项水电工程验收项--水路
    public function check_waterdetail(){
        $orderid = $GLOBALS['orderid'];
        $nodeid = $GLOBALS['nodeid'];
        $title =array();
        $item_result = $this->db->get_one('day_log',array('orderid'=>$orderid,'nodeid'=>$nodeid),'check_waterdetail');
        $result = array();
        $result['check_waterdetail'] = string2array($item_result['check_waterdetail']);
        foreach ($result as $key => $value) {
          foreach ($value as $keys => $values) {
            if($values['qua']=='合格' && $values['img_yse']==''){
              $title[]=$values['title'];
            }
          }
        }
        echo json_encode(array('code'=>1,'data'=>$title,'message'=>'查看更多验收项','process_time'=>time())); exit;
    }
    //我的工地->支付进度
    public function pay(){
        $pay_money=array();
        $array=array();
        $arr=array();
        $item=array();
        $deman=array();
        $coun=array();
        $order_id=$GLOBALS['order_id'];
        if($order_id){
        $result=$this->db->get_list('demand',"id='".$order_id."' and nodeid!=102",'payment_id',0,100,$page,'');
        $array['amount']=$result[0]['amount'];
        if($result[0]['payment_id']){
        $demand_referno=$this->db->get_list('f_payment_method',"payment_id='".$result[0]['payment_id']."'",'node_id',0,100,$page,'');
        $demand_refernos=$this->db->get_list('demand_referno',"orderid='".$order_id."'  and nodeid!=102",'nodeid',0,100,$page,'','nodeid');
        $refernos=$this->db->get_list('demand_referno',"orderid='".$order_id."' and nodeid!=45  and nodeid!=102",'nodeid',0,100,$page,'','nodeid');
        $aa=array_merge($demand_referno,$demand_refernos);
        foreach ($aa as $keys => $values) {
            foreach ($values as $kk => $vv) {
                $demans[$vv]=$vv;
            }    
        }
        $res=$this->db->get_one('demand_track','orderid="'.$order_id.'  and nodeid!=102" and nodeid=45');
        if($res){
          if($res['col7']=='是'){
          $sort[]=array_values($demans);
          }else if($res['col7']=='否'){
          unset($demans['45']);
          $sort[]=array_values($demans);
          }
        }else{
          unset($demans['45']);
          $sort[]=array_values($demans);
        }
        foreach ($sort as $key => $value) {
            $b=implode(',',$value);
            if($b)
            $arr[]=$this->db->get_list('demand_referno',"orderid='".$order_id."'  and nodeid!=102 and nodeid in (',',".$b.")",'nodename,nodeid,needmoney,extrapay',0,100,$page,'');
        }
        }else{
          echo json_encode(array('code'=>0,'data'=>null,'message'=>'管家没有确认支付方式','process_time'=>time())); exit; 
        }
        foreach($arr as $k=>$v){
            foreach ($v as $ks => $vs) {
                if(!isset($item[$vs['nodeid']])){
                    $item[$vs['nodeid']]=$vs;
                    $re=$this->db->get_list('demand',"id='".$order_id."'",'payment_id');
                    $pay=$this->db->get_list('f_payment_method',"payment_id='".$re[0]['payment_id']."' and node_id='".$vs['nodeid']."'",'draw_rate',0,100,$page,'');
                    //echo "<pre>";print_r($pay);
                    $demand=$this->db->get_list('demand',"id='".$order_id."'  and nodeid!=102",'designpay,totalpay,designno,contactno',0,100,$page,'');
                    $item[$vs['nodeid']]['designpay']=$demand[0]['designpay'];
                    $item[$vs['nodeid']]['designno']=$demand[0]['designno'];
                    $item[$vs['nodeid']]['totalpay']=$demand[0]['totalpay'];
                    $item[$vs['nodeid']]['contactno']=$demand[0]['contactno'];
                    $coun['totalpay']=$demand[0]['totalpay'];
                    $attach1=$this->db->get_one('demand_track',"orderid='".$order_id."' and nodeid=15  and nodeid!=102",'attach1');
                    foreach ($attach1 as $key => $value) {
                        $a=explode('|',$value);
                        if(!empty($a)){
                        $b=array_filter($a);
                        foreach ($b as $k => $v) {
                            $arrs[]="http://www.uzhuang.com/image/pic_230/".$v;
                        }
                        }
                    }
                    if($item[$vs['nodeid']]['nodeid']==15){
                    $item[$vs['nodeid']]['photo']=$arrs;
                    }
                    //echo "<pre>";print_r($pay);
                    if($pay){
                    $item[$vs['nodeid']]['draw_rate']=intval($pay[0]['draw_rate'])."%";
                    }else{
                    $item[$vs['nodeid']]['draw_rate']=$pay[0]['draw_rate'];   
                    }
                    $payment=$this->db->get_one('f_payment',array('payment_id'=>$re[0]['payment_id']),'payment_name');
                    $counts=$this->db->get_list('f_payment_method',"payment_id='".$re[0]['payment_id']."' and node_id!=45",'draw_rate',0,100,$page,'');
                    if($vs['nodeid']==15){
                    $coun['denominator']=count($counts)+1;
                    }else{
                    $coun['denominator']=count($counts); 
                    }
                    $coun['molecule']=count($refernos);
                    //$item[$vs['nodeid']]['pay_name']='('.$coun.'/'.$count.')';
                    if($item[$vs['nodeid']]['nodeid']==19){
                    $item[$vs['nodeid']]['payment_name']=$payment['payment_name'];
                    }
                     if($item[$vs['nodeid']]['nodeid']>=19){
                     $item[$vs['nodeid']]['pay_money']=$item[$vs['nodeid']]['totalpay']*(float)$item[$vs['nodeid']]['draw_rate']/100;
                    }
                    $item[$vs['nodeid']]['status']=2;
                    if($item[$vs['nodeid']]['nodeid']==45){
                      $item[$vs['nodeid']]['ret']='维保期间未出现装修质量问题,您托管在优装美家的装修质保金,将支付给装修公司.';
                    }
                }else{
                    $item[$vs['nodeid']]['needmoney']+=$vs['needmoney'];
                    //$item[$vs['nodeid']]['extrapay']+=$vs['extrapay'];
                    $re=$this->db->get_list('demand',"id='".$order_id."' and nodeid!=102",'payment_id');
                    $pay=$this->db->get_list('f_payment_method',"payment_id='".$re[0]['payment_id']."' and node_id='".$vs['nodeid']."'",'draw_rate',0,100,$page,'');
                    $demand=$this->db->get_list('demand',"id='".$order_id."'  and nodeid!=102",'designpay,totalpay,designno,contactno',0,100,$page,'');
                    $item[$vs['nodeid']]['designpay']=$demand[0]['designpay'];
                    $item[$vs['nodeid']]['designno']=$demand[0]['designno'];
                    $item[$vs['nodeid']]['totalpay']=$demand[0]['totalpay'];
                    $item[$vs['nodeid']]['contactno']=$demand[0]['contactno'];
                    $coun['totalpay']=$demand[0]['totalpay'];
                    if($pay){
                    $item[$vs['nodeid']]['draw_rate']=intval($pay[0]['draw_rate'])."%";
                    }else{
                    $item[$vs['nodeid']]['draw_rate']=$pay[0]['draw_rate'];   
                    }
                    $payment=$this->db->get_one('f_payment',array('payment_id'=>$re[0]['payment_id']),'payment_name');
                    $counts=$this->db->get_list('f_payment_method',"payment_id='".$re[0]['payment_id']."'",'draw_rate',0,100,$page,'');
                    if($vs['nodeid']==15){
                    $coun['denominator']=count($counts)+1;
                    }else{
                    $coun['denominator']=count($counts); 
                    }
                    $coun['molecule']=count($refernos);
                    //$item[$vs['nodeid']]['pay_name']='('.$coun.'/'.$count.')';
                    if($item[$vs['nodeid']]['nodeid']==19){
                    $item[$vs['nodeid']]['payment_name']=$payment['payment_name'];
                    }
                    if($item[$vs['nodeid']]['nodeid']>=19){
                     $item[$vs['nodeid']]['pay_money']=$item[$vs['nodeid']]['totalpay']*(float)$item[$vs['nodeid']]['draw_rate']/100;
                    }
                    $item[$vs['nodeid']]['status']=2;
                    if($item[$vs['nodeid']]['nodeid']==45){
                      $item[$vs['nodeid']]['ret']='维保期间未出现装修质量问题,您托管在优装美家的装修质保金,将支付给装修公司.';
                    }
                }
            }
        }
                    $ar=array();
                    $res=array_diff($sort[0],array_keys($item));
                    $resu=implode(',',$res);
                   
                    if(!empty($resu)){
                    $co=$this->db->get_list('f_payment_method',"payment_id='".$re[0]['payment_id']."' and node_id in (".$resu.")",'node_id,draw_rate',0,100,$page,'');
                    }
                    foreach ($co as $ke => $va) {
                        //echo "<pre>";print_r($va);
                        $node=$this->db->get_list('f_node',"node_id='".$va['node_id']."'",'node_name',0,100,$page,'');
                         
                        $ar[$va['node_id']]['nodename']=$node[0]['node_name'];
                        $ar[$va['node_id']]['nodeid']=$va['node_id'];
                        $ar[$va['node_id']]['draw_rate']=intval($va['draw_rate'])."%";
                        $ar[$va['node_id']]['status']=1;
                    }

                    $results=array_merge($item,$ar);
                    $ages = array();
                    foreach ($results as $user) {
                        $ages[] = $user['nodeid'];
                    }
                    array_multisort($ages, SORT_ASC, $results);
                    $pay_money['molecule']=$coun['molecule'];
                    $pay_money['denominator']=$coun['denominator'];
                    $pay_money['totalpay']=$coun['totalpay'];
                    $pay_money['node']=$results;
                    //echo "<pre>";print_r($pay_money);exit;
                    if($results){
                        echo json_encode(array('code'=>1,'data'=>$pay_money,'message'=>'订单支付已进行','process_time'=>time())); exit; 
                    }else{
                        echo json_encode(array('code'=>0,'data'=>null,'message'=>'您还没有到支付节点哦~','process_time'=>time())); exit; 
                    }
            }else{
              echo json_encode(array('code'=>0,'data'=>null,'message'=>'订单id不存在~','process_time'=>time())); exit; 
            }
    }

    // 支付进度列表页
    public function pay_list(){
      $pay_money=array();
      $array=array();
      $arr=array();
      $item=array();
      $deman=array();
      $coun=array();
      $order_id=$GLOBALS['order_id'];
      if($order_id){
        // 获取付款方式编号
        $result=$this->db->get_list('demand',"id=".$order_id." and nodeid!=102",'payment_id',0,100,$page,'');
        $array['amount']=$result[0]['amount'];
        // if($result[0]['payment_id']){
          // 获取要付款的节点号
          $demand_referno=$this->db->get_list('f_payment_method',"payment_id='".$result[0]['payment_id']."'",'node_id',0,100,$page,'');
          // 获取该订单的付款记录
          $demand_refernos=$this->db->get_list('demand_referno',"orderid='".$order_id."'  and nodeid!=102",'nodeid',0,100,$page,'','nodeid');
          $refernos=$this->db->get_list('demand_referno',"orderid='".$order_id."' and nodeid!=45  and nodeid!=102",'nodeid',0,100,$page,'','nodeid');
          $aa=array_merge($demand_referno,$demand_refernos);
          foreach ($aa as $keys => $values) {
            foreach ($values as $kk => $vv) {
              $demans[$vv]=$vv;
            }    
          }
          $res=$this->db->get_one('demand_track','orderid="'.$order_id.'  and nodeid!=102" and nodeid=45');
          if($res){
            if($res['col7']=='是'){
              $sort[]=array_values($demans);
            }else if($res['col7']=='否'){
              unset($demans['45']);
              $sort[]=array_values($demans);
            }
          }else{
            unset($demans['45']);
            $sort[]=array_values($demans);
          }
          foreach ($sort as $key => $value) {
            $b=implode(',',$value);
            if($b)
            $arr[]=$this->db->get_list('demand_referno',"orderid='".$order_id."'  and nodeid!=102 and nodeid in (',',".$b.")",'id,nodeid,nodename,referno,addtime,payday,needmoney,extrapay,is_online,pay_schedult,deposit_money',0,100,$page,'nodeid asc,id desc');
          }
        // }else{
          // echo json_encode(array('code'=>0,'data'=>null,'message'=>'管家没有确认支付方式','process_time'=>time())); exit; 
        // }
          
        $item=array();
        $demand=$this->db->get_one('demand',"id='".$order_id."'  and nodeid!=102",'designpay,totalpay,designno,contactno,payment_id');
        $payment_id = $demand['payment_id'];
        $pay_nodes = $this->db->get_list('f_payment_method',array('payment_id'=>$payment_id),'node_id');
        $uncompleted_nodes = array();
        foreach ($pay_nodes as $key => $value) {
          array_push($uncompleted_nodes, $value['node_id']);
        }
        
        $completed_nodes = array();
        foreach ($arr[0] as $key => $value) {
          array_push($completed_nodes, $value['nodeid']);
          if($value['nodeid']==102||$value['nodeid']==15){
            unset($arr[0][$key]['extrapay']);
            if($arr[0][$key]['nodename']=='签设计协议'){
              $arr[0][$key]['designno'] = $demand['designno'];//协议编号
              $arr[0][$key]['designpay'] = $demand['designpay']?$demand['designpay']:null;//协议金额
            }
            // $arr[0][$key]['wait_pay'] = floatval($value['needmoney']);
            $arr[0][$key]['complete_node'] = 1;
          }else if($value['nodeid']==19){//签订三方合同
            $arr[0][$key]['contactno'] = $demand['contactno'];//合同编号
            $arr[0][$key]['totalpay'] = $demand['totalpay']?$demand['totalpay']:null;//合同金额
            // 获取付款比例
            $draw_rate = $this->db->get_one('f_payment_method',array('payment_id'=>$payment_id,'node_id'=>$value['nodeid']),'draw_rate');
            $arr[0][$key]['draw_rate'] = intval($draw_rate['draw_rate']).'%';
            // 获取合同款
            $arr[0][$key]['pay_money'] = $demand['totalpay']*$draw_rate['draw_rate']?sprintf("%.2f",substr(sprintf("%.4f", $demand['totalpay']*$draw_rate['draw_rate']/100), 0, -2)):null;
            unset($arr[0][$key]['extrapay']);

            // 待支付金额
            // $arr[0][$key]['wait_pay'] = floatval($value['needmoney']);//-floatval($value['deposit_money']);
            $arr[0][$key]['complete_node'] = 1;
          }else{
            $arr[0][$key]['contactno'] = $demand['contactno'];//合同编号
            $arr[0][$key]['totalpay'] = $demand['totalpay']?$demand['totalpay']:null;//合同金额
            // 获取付款比例
            $draw_rate = $this->db->get_one('f_payment_method',array('payment_id'=>$payment_id,'node_id'=>$value['nodeid']),'draw_rate');
            $arr[0][$key]['draw_rate'] = intval($draw_rate['draw_rate']).'%';
            // 获取合同款
            $arr[0][$key]['pay_money'] = $demand['totalpay']*$draw_rate['draw_rate']?$demand['totalpay']*$draw_rate['draw_rate']/100:null;
            // $arr[0][$key]['wait_pay'] = floatval($value['needmoney']);//+floatval($value['extrapay']);
            $check_res = $this->db->get_one('demand_track',array('orderid'=>$order_id,'nodeid'=>$value['nodeid']),'checked_status');
            if($check_res['checked_status']!=3){
              $arr[0][$key]['complete_node'] = 0;
            }else{
              $arr[0][$key]['complete_node'] = 1;
            }
            if($value['nodeid']==45){
              $arr[0][$key]['complete_node'] = 1;
              unset($arr[0][$key]['draw_rate']);
            }
          }
          $payed_money = $this->pay_base->get_payed_money($arr[0][$key]['id']);
          if($arr[0][$key]['is_online']==1){
            $arr[0][$key]['payed_money'] = $payed_money?sprintf("%.2f",substr(sprintf("%.4f", $payed_money), 0, -2)):null;
            $arr[0][$key]['wait_pay'] = bcsub(floatval($value['needmoney']), $payed_money,2)?sprintf("%.2f",substr(sprintf("%.4f", bcsub(floatval($value['needmoney']), $payed_money,2)), 0, -2)):null;
          }else{
            $arr[0][$key]['payed_money'] = bcsub(floatval($value['needmoney']), $payed_money,2)?sprintf("%.2f",substr(sprintf("%.4f", bcsub(floatval($value['needmoney']), $payed_money,2)), 0, -2)):null;
            $arr[0][$key]['wait_pay'] = $payed_money?sprintf("%.2f",substr(sprintf("%.4f", $payed_money), 0, -2)):null;
          }

          $arr[0][$key]['params'] = array('id'=>$value['id'],'orderid'=>$order_id,'nodeid'=>$value['nodeid'],'money'=>$arr[0][$key]['wait_pay']);
          if($arr[0][$key]['is_online']==0){//线下支付
            $arr[0][$key]['pay_schedult'] =  1;
          }else if($arr[0][$key]['pay_schedult'] == 1){//完成支付
            $arr[0][$key]['pay_schedult'] =  1;
          }else{//未完成支付
            $arr[0][$key]['pay_schedult'] =  0;
          }
          // 获取线上支付已支付笔数
          $online_payed_count = $this->pay_base->get_pay_count(intval($value['id']));
          if($arr[0][$key]['pay_schedult']==0){
            $arr[0][$key]['show_detail'] = $online_payed_count;
          }else{
            $arr[0][$key]['show_detail'] = $online_payed_count>1?$online_payed_count:0;
          }
          if($arr[0][$key]['is_online']&&$arr[0][$key]['complete_node']){//线上支付已完成支付节点
            $pay_count = $this->db->count('online_pay_item',array('referno_id'=>$arr[0][$key]['id']));
            if($pay_count['num']==1){
              $pay_referno = $this->db->get_one('online_pay_item',array('referno_id'=>$arr[0][$key]['id']),'referno');
              $arr[0][$key]['referno'] = $pay_referno['referno'];
            }
          }
          // unset($arr[0][$key]['is_online']);
          // $arr[0][$key]['complete_node'] = 1;
        }
        foreach ($uncompleted_nodes as $key => $value) {
          if (in_array($value,$completed_nodes)) {
            unset($uncompleted_nodes[$key]);
          }
        }
          
        foreach($arr[0] as $k=>$v){
          if($v['pay_schedult']==0){
            $v['addtime'] = '待支付';
          }else{
            if($v['is_online'])$v['addtime'] = $v['payday'];
          }
          // unset($v['is_online']);
          $item[$v['nodeid']]['complete_node'] = $v['complete_node'];
          $item[$v['nodeid']]['nodeid']=$v['nodeid'];
          $item[$v['nodeid']]['nodename']=$v['nodename'];
          $item[$v['nodeid']]['draw_rate']=$v['draw_rate']?intval($v['draw_rate']).'%':'';
          unset($v['nodename']);
          unset($v['complete_node']);
          // echo '<pre>';print_r($v);
          if($v['nodeid']==45){
            $v['ret']='维保期间未出现装修质量问题,您托管在优装美家的装修质保金,将支付给装修公司.';
          }
          if ($v['show_detail']==1&&$v['pay_schedult']) {
            $payed_info = $this->pay_base->get_payed_info($v['id']);
            $v['addtime'] = date('Y-m-d G:i:s',$payed_info['payday']);
            $v['referno'] = $payed_info['referno'];
          }
          if(isset($v['deposit_money']))
            $v['deposit_money'] = $v['deposit_money']?sprintf("%.2f",substr(sprintf("%.4f", $v['deposit_money']), 0, -2)):null;
          else
            $v['deposit_money'] = null;//sprintf("%.2f",substr(sprintf("%.4f", 0), 0, -2));
            $select_company_where = "orderid={$order_id} and isdel=0 and (isselected='是' or isselected='1')";
            $selected_company = $this->db->get_one('demand_company',$select_company_where,'companyname');
            if ($select_company) {
              $v['companyname'] = $selected_company['companyname'];
            }else{
              $v['companyname'] = null;
            }
          $item[$v['nodeid']]['detail'][]=$v;
        }

        foreach ($uncompleted_nodes as $key => $value) {
          if($value==45){//维保节点
            $is_complete_wb = $this->db->get_one('f_payment_method',array('payment_id'=>$payment_id,'node_id'=>45),'draw_rate,pay_rate');
            if($is_complete_wb&&floatval($is_complete_wb['draw_rate'])&&floatval($is_complete_wb['pay_rate'])){
              unset($uncompleted_nodes[$key]);
              continue;
            }
          }
          $uncompleted_data = array();
          $nodename = $this->db->get_one('f_node',array('node_id'=>$value),'node_name');
          $uncompleted_data['nodename'] = $nodename['node_name'];
          $node_draw = $this->db->get_one('f_payment_method',array('payment_id'=>$payment_id,'node_id'=>$value),'draw_rate');
          $uncompleted_data['draw_rate'] = $node_draw['draw_rate'];
          $uncompleted_data['complete_node'] = 0;
          $uncompleted_data['nodeid'] = $value;
          $node_status = $this->db->get_one('demand_track',array('orderid'=>$order_id,'nodeid'=>$value),'checked_status');
          if ($node_status['checked_status']==3) {
            $item[$value]['complete_node'] = 1;
            $item[$value]['detail'] = array();
            $item[$value]['draw_rate'] = floatval($node_draw['draw_rate']);
            $item[$value]['nodeid'] = $value;
            $item[$value]['nodename'] = $nodename['node_name'];
            unset($uncompleted_nodes[$key]);
            continue;
          }
          array_push($item, $uncompleted_data);
        }
        $data = array();
        // 支付节点总数
        $totalCount = count($item);
        // 已完成的支付节点数
        $completed_count = $totalCount - count($uncompleted_nodes);
        $data['pay_list'] = array_values($item);
        $data['denominator'] = $totalCount;
        $data['molecule'] = $completed_count;
        $data['totalpay'] = $demand['totalpay'];
        
        die(json_encode(array('code'=>1,'data'=>$data,'message'=>'数据获取成功')));
      }else{
        echo json_encode(array('code'=>0,'data'=>null,'message'=>'订单id不存在~','process_time'=>time())); exit; 
      }
    }

    // 我的支付进度页面点击【查看支付明细】
    public function get_online_pay_detail(){
      $id = $GLOBALS['id'];
      if (!$id) {
        die(json_encode(array('code'=>1,'data'=>'','message'=>'支付唯一号获取失败')));
      }
      // 获取订单号、节点号
      $pay_info = $this->db->get_one('demand_referno',array('id'=>$id),'orderid,nodeid,nodename,extrapay,deposit_money,needmoney');
      // 获取合同编号、合同总金额
      $contract_info = $this->db->get_one('demand',array('id'=>$pay_info['orderid']),'designno,designpay,contactno,totalpay,payment_id');
      $draw_rate = $this->db->get_one('f_payment_method',array('payment_id'=>$contract_info['payment_id'],'node_id'=>$pay_info['nodeid']),'draw_rate');
      $contract_money = floatval($contract_info['totalpay'])*floatval($draw_rate['draw_rate'])/100;//合同款

      $res = $this->db->get_list('online_pay_item',array('referno_id'=>$id),'pay_money,referno,payday');
      if($res){
        foreach ($res as $key => $value) {
          $res[$key]['contactno'] = $contract_info['contactno']?$contract_info['contactno']:null;
          $res[$key]['totalpay'] = $contract_info['totalpay']?$contract_info['totalpay']:null;
          $res[$key]['designno'] = $contract_info['designno']?$contract_info['designno']:null;
          $res[$key]['designpay'] = $contract_info['designpay']?$contract_info['designpay']:null;
          $res[$key]['draw_rate'] = $draw_rate['draw_rate']?floatval($draw_rate['draw_rate']).'%':null;
          $res[$key]['needmoney'] = $pay_info['needmoney']?$pay_info['needmoney']:null;
          $res[$key]['extrapay'] = $pay_info['extrapay']?$pay_info['extrapay']:null;
          $res[$key]['contract_money'] = $contract_money?sprintf("%.2f",substr(sprintf("%.4f", $contract_money), 0, -2)):null;
          if($pay_info['nodeid']==15){
            $res[$key]['nodename'] = $pay_info['nodename'];
            $res[$key]['deposit_money'] = $pay_info['deposit_money']?$pay_info['deposit_money']:null;
          }else{
            $res[$key]['deposit_money'] = null;
          }
          $res[$key]['payday'] = date('Y-m-d G:i:s',$value['payday']);
        }
        die(json_encode(array('code'=>0,'data'=>$res,'message'=>'数据获取成功')));
      }else{
        die(json_encode(array('code'=>0,'data'=>array(),'message'=>'暂无支付数据')));
      }
    }
    //支付状态
    public function pay_status($order_id){
        $pay_money=array();
        $array=array();
        $arr=array();
        $item=array();
        $deman=array();
        $coun=array();
        if($order_id){
        $result=$this->db->get_list('demand',"id='".$order_id."' and nodeid!=102",'payment_id',0,100,$page,'');
        $array['amount']=$result[0]['amount'];
        // if($result[0]['payment_id']){
        $demand_referno=$this->db->get_list('f_payment_method',"payment_id='".$result[0]['payment_id']."'",'node_id',0,100,$page,'');
        $demand_refernos=$this->db->get_list('demand_referno',"orderid='".$order_id."'  and nodeid!=102",'nodeid',0,100,$page,'','nodeid');
        $refernos=$this->db->get_list('demand_referno',"orderid='".$order_id."' and nodeid!=45  and nodeid!=102",'nodeid',0,100,$page,'','nodeid');
        $aa=array_merge($demand_referno,$demand_refernos);
        foreach ($aa as $keys => $values) {
            foreach ($values as $kk => $vv) {
                $demans[$vv]=$vv;
            }    
        }
        $res=$this->db->get_one('demand_track','orderid="'.$order_id.'  and nodeid!=102" and nodeid=45');
        if($res){
          if($res['col7']=='是'){
          $sort[]=array_values($demans);
          }else if($res['col7']=='否'){
          unset($demans['45']);
          $sort[]=array_values($demans);
          }
        }else{
          unset($demans['45']);
          $sort[]=array_values($demans);
        }
        foreach ($sort as $key => $value) {
            $b=implode(',',$value);
            if($b)
            $arr[]=$this->db->get_list('demand_referno',"orderid='".$order_id."'  and nodeid!=102 and nodeid in (',',".$b.")",'nodename,nodeid,needmoney,extrapay',0,100,$page,'');
        }
        // }
        foreach($arr as $k=>$v){
            foreach ($v as $ks => $vs) {
                if(!isset($item[$vs['nodeid']])){
                    $item[$vs['nodeid']]=$vs;
                    $re=$this->db->get_list('demand',"id='".$order_id."'",'payment_id');
                    $pay=$this->db->get_list('f_payment_method',"payment_id='".$re[0]['payment_id']."' and node_id='".$vs['nodeid']."'",'draw_rate',0,100,$page,'');
                    //echo "<pre>";print_r($pay);
                    $demand=$this->db->get_list('demand',"id='".$order_id."'  and nodeid!=102",'designpay,totalpay,designno,contactno',0,100,$page,'');
                    $item[$vs['nodeid']]['designpay']=$demand[0]['designpay'];
                    $item[$vs['nodeid']]['designno']=$demand[0]['designno'];
                    $item[$vs['nodeid']]['totalpay']=$demand[0]['totalpay'];
                    $item[$vs['nodeid']]['contactno']=$demand[0]['contactno'];
                    $coun['totalpay']=$demand[0]['totalpay'];
                    $attach1=$this->db->get_one('demand_track',"orderid='".$order_id."' and nodeid=15  and nodeid!=102",'attach1');
                    foreach ($attach1 as $key => $value) {
                        $a=explode('|',$value);
                        if(!empty($a)){
                        $b=array_filter($a);
                        foreach ($b as $k => $v) {
                            $arrs[]="http://www.uzhuang.com/image/pic_230/".$v;
                        }
                        }
                    }
                    if($item[$vs['nodeid']]['nodeid']==15){
                    $item[$vs['nodeid']]['photo']=$arrs;
                    }
                    //echo "<pre>";print_r($pay);
                    if($pay){
                    $item[$vs['nodeid']]['draw_rate']=intval($pay[0]['draw_rate'])."%";
                    }else{
                    $item[$vs['nodeid']]['draw_rate']=$pay[0]['draw_rate'];   
                    }
                    $payment=$this->db->get_one('f_payment',array('payment_id'=>$re[0]['payment_id']),'payment_name');
                    $counts=$this->db->get_list('f_payment_method',"payment_id='".$re[0]['payment_id']."' and node_id!=45",'draw_rate',0,100,$page,'');
                    if($vs['nodeid']==15){
                    $coun['denominator']=count($counts)+1;
                    }else{
                    $coun['denominator']=count($counts); 
                    }
                    $coun['molecule']=count($refernos);
                    //$item[$vs['nodeid']]['pay_name']='('.$coun.'/'.$count.')';
                    if($item[$vs['nodeid']]['nodeid']==19){
                    $item[$vs['nodeid']]['payment_name']=$payment['payment_name'];
                    }
                     if($item[$vs['nodeid']]['nodeid']>=19){
                     $item[$vs['nodeid']]['pay_money']=$item[$vs['nodeid']]['totalpay']*(float)$item[$vs['nodeid']]['draw_rate']/100;
                    }
                    $item[$vs['nodeid']]['status']=2;
                    if($item[$vs['nodeid']]['nodeid']==45){
                      $item[$vs['nodeid']]['ret']='维保期间未出现装修质量问题,您托管在优装美家的装修质保金,将支付给装修公司.';
                    }
                }else{
                    $item[$vs['nodeid']]['needmoney']+=$vs['needmoney'];
                    //$item[$vs['nodeid']]['extrapay']+=$vs['extrapay'];
                    $re=$this->db->get_list('demand',"id='".$order_id."' and nodeid!=102",'payment_id');
                    $pay=$this->db->get_list('f_payment_method',"payment_id='".$re[0]['payment_id']."' and node_id='".$vs['nodeid']."'",'draw_rate',0,100,$page,'');
                    $demand=$this->db->get_list('demand',"id='".$order_id."'  and nodeid!=102",'designpay,totalpay,designno,contactno',0,100,$page,'');
                    $item[$vs['nodeid']]['designpay']=$demand[0]['designpay'];
                    $item[$vs['nodeid']]['designno']=$demand[0]['designno'];
                    $item[$vs['nodeid']]['totalpay']=$demand[0]['totalpay'];
                    $item[$vs['nodeid']]['contactno']=$demand[0]['contactno'];
                    $coun['totalpay']=$demand[0]['totalpay'];
                    if($pay){
                    $item[$vs['nodeid']]['draw_rate']=intval($pay[0]['draw_rate'])."%";
                    }else{
                    $item[$vs['nodeid']]['draw_rate']=$pay[0]['draw_rate'];   
                    }
                    $payment=$this->db->get_one('f_payment',array('payment_id'=>$re[0]['payment_id']),'payment_name');
                    $counts=$this->db->get_list('f_payment_method',"payment_id='".$re[0]['payment_id']."'",'draw_rate',0,100,$page,'');
                    if($vs['nodeid']==15){
                    $coun['denominator']=count($counts)+1;
                    }else{
                    $coun['denominator']=count($counts); 
                    }
                    $coun['molecule']=count($refernos);
                    //$item[$vs['nodeid']]['pay_name']='('.$coun.'/'.$count.')';
                    if($item[$vs['nodeid']]['nodeid']==19){
                    $item[$vs['nodeid']]['payment_name']=$payment['payment_name'];
                    }
                    if($item[$vs['nodeid']]['nodeid']>=19){
                     $item[$vs['nodeid']]['pay_money']=$item[$vs['nodeid']]['totalpay']*(float)$item[$vs['nodeid']]['draw_rate']/100;
                    }
                    $item[$vs['nodeid']]['status']=2;
                    if($item[$vs['nodeid']]['nodeid']==45){
                      $item[$vs['nodeid']]['ret']='维保期间未出现装修质量问题,您托管在优装美家的装修质保金,将支付给装修公司.';
                    }
                }
            }
        }
                    $ar=array();
                    $res=array_diff($sort[0],array_keys($item));
                    $resu=implode(',',$res);
                   
                    if(!empty($resu)){
                    $co=$this->db->get_list('f_payment_method',"payment_id='".$re[0]['payment_id']."' and node_id in (".$resu.")",'node_id,draw_rate',0,100,$page,'');
                    }
                    foreach ($co as $ke => $va) {
                        //echo "<pre>";print_r($va);
                        $node=$this->db->get_list('f_node',"node_id='".$va['node_id']."'",'node_name',0,100,$page,'');
                         
                        $ar[$va['node_id']]['nodename']=$node[0]['node_name'];
                        $ar[$va['node_id']]['nodeid']=$va['node_id'];
                        $ar[$va['node_id']]['draw_rate']=intval($va['draw_rate'])."%";
                        $ar[$va['node_id']]['status']=1;
                    }

                    $results=array_merge($item,$ar);
                    $ages = array();
                    foreach ($results as $user) {
                        $ages[] = $user['nodeid'];
                    }
                    array_multisort($ages, SORT_ASC, $results);
                    $pay_money['molecule']=$coun['molecule'];
                    $pay_money['denominator']=$coun['denominator'];
                    $pay_money['totalpay']=$coun['totalpay'];
                    $pay_money['node']=$results;
                    //echo "<pre>";print_r($pay_money);exit;
                    if($results){
                      return $pay_money;
                    }
            }
    }
    //我的工地->我的消息
    public function message(){
        $uid=get_cookie('_uid');
        $arr=array();
        $arrs=array();
        $array=array();
        $arrays=array();
        $result=array();
        if($uid){
        $result= $this->db->get_list('demand',"uid='".$uid."'",'id');
        foreach ($result as $key => $value) {
           $res[$value['id']]= $this->db->get_list('log_evaluate',"`orderid`=".$value['id'],'content,nodeid,orderid,parent_id,addtime,name,first_id',0,100,$page,'addtime desc');
        }
        $i = 0;
        foreach ($res as $k => $v) {
            foreach ($v as $ks => $vs) {
                //echo "<pre>";print_r($vs);
                $nodeid=$this->db->get_one('f_node',"node_id ='".$vs['nodeid']."'",'node_name');
                $res[$k][$ks]['node_name'] = $nodeid['node_name'];
                /*if(strpos($vs['content'],'游客')){
                    $res[$k][$ks]['content']=substr($vs['content'],strpos($vs['content'],'：')+3);
                    $res[$k][$ks]['status']=1;
                }*/
                if($vs['parent_id']==0 || $vs['parent_id']==null){
                $arr[$k][$ks]['name']=$vs['name'];
                $arr[$k][$ks]['orderid']=$vs['orderid'];
                $arr[$k][$ks]['nodeid']=$vs['nodeid'];
                $arr[$k][$ks]['addtime']=date('Y-m-d',$vs['addtime']);
                $arr[$k][$ks]['addtimes']=$vs['addtime'];
                $arr[$k][$ks]['photo']="http://m.uzhuang.com/res/img/jingyu.png";
                $arr[$k][$ks]['nodename']=$res[$k][$ks]['node_name'];
                $arr[$k][$ks]['content']=$res[$k][$ks]['content'];
                //$arr[$k][$ks]['message']="@".$res[$k][$ks]['node_name'].'：'. $res[$k][$ks]['content'];
                $arr[$k][$ks]['status']=2;
                $arr[$k] = array_values($arr[$k]);
                //
                //array_values($arr[$k][$ks])
                }
                //echo "<pre>";print_r($arr[$k][$ks]['nodeid']);
                if($vs['parent_id']!=0 && $i==0){
                    $a=$this->db->get_list('log_evaluate',"uid='".$uid."'",'id');
                    foreach ($a as $key => $value) {
                     $result=$this->db->get_list('log_evaluate',"`parent_id`=".$value['id'],'content,nodeid,orderid,parent_id,addtime,name,first_id',0,100,$page,'addtime desc');
                     foreach ($result as $kk => $vv) {
                      //echo "<pre>";print_r($vv);
                      /*if(strpos($result[$kk]['content'],'回复') !== false && strpos($result[$kk]['content'],'回复')==0){
                        $pre_length = mb_strpos($result[$kk]['content'], '：');
                        $resu['content']= mb_substr($result[$kk]['content'],$pre_length+3);*/
                        if(strpos($vv['content'],'回复') !==false || strpos($vv['content'],'回复') ==0){
                        $pre_length = mb_strpos($vv['content'], '：');
                        $res[$kk]['content']= mb_substr($vv['content'],$pre_length+3);
                        $arrs[$kk]['name']=$vv['name'];
                        $arrs[$kk]['orderid']=$vv['orderid'];
                        $arrs[$kk]['nodeid']=$vv['nodeid'];
                        $arrs[$kk]['addtime']=date('Y-m-d',$vv['addtime']);
                        $arrs[$kk]['addtimes']=$vv['addtime'];
                        if(empty($uid)){
                        $arrs[$kk]['photo']="http://m.uzhuang.com/res/img/jingyu.png";
                        }else{
                        $arrs[$kk]['photo']='http://www.uzhuang.com/uploadfile/member/'.substr(md5($uid), 0, 2).'/'.$uid.'/180x180.jpg';
                        }
                        //$arrs[$kk]['message']="@".$res[$k][$ks]['node_name'].'：'. $res[$kk]['content'];
                        $arrs[$kk]['nodename']=$res[$k][$ks]['node_name'];
                        $arrs[$kk]['content']=$res[$kk]['content'];
                        $arrs[$kk]['status']=1;
                        //$this->db->update('log_evaluate',array('read'=>1),array('orderid'=>$arrs[$kk]['orderid'],'nodeid'=>$arrs[$kk]['nodeid']));
                        }else{
                        $arrs[$kk]['name']=$vv['name'];
                        $arrs[$kk]['orderid']=$vv['orderid'];
                        $arrs[$kk]['nodeid']=$vv['nodeid'];
                        $arrs[$kk]['addtime']=date('Y-m-d',$vv['addtime']);
                        $arrs[$kk]['addtimes']=$vv['addtime'];
                        if(empty($uid)){
                        $arrs[$kk]['photo']="http://m.uzhuang.com/res/img/jingyu.png";
                        }else{
                        $arrs[$kk]['photo']='http://www.uzhuang.com/uploadfile/member/'.substr(md5($uid), 0, 2).'/'.$uid.'/180x180.jpg';
                        }
                        //$arrs[$kk]['message']="@".$res[$k][$ks]['node_name'].'：'. $res[$kk]['content'];
                        $arrs[$kk]['nodename']=$res[$k][$ks]['node_name'];
                        $arrs[$kk]['content']=$vv['content'];
                        $arrs[$kk]['status']=1;
                        //$this->db->update('log_evaluate',array('read'=>1),array('orderid'=>$arrs[$kk]['orderid'],'nodeid'=>$arrs[$kk]['nodeid']));
                        }
                        $arrs_arr[][] = $arrs[0];
                     }
                  }
                  $i++;
                }
            }
        }

        foreach ($arr as $ks => $vs) {
                  foreach ($vs as $keys => $values) {
                    $this->db->update('log_evaluate',array('read'=>1),array('orderid'=>$values['orderid'],'nodeid'=>$values['nodeid']));
                    $array[]=$values;
                  } 
        }
        foreach ($arrs_arr as $kss => $vss) {
                  foreach ($vss as $keyss => $valuess) {
                     $this->db->update('log_evaluate',array('read'=>1),array('orderid'=>$valuess['orderid'],'nodeid'=>$valuess['nodeid']));
                    $arrays[]=$valuess;
                  } 
        }
        
        $results['message']=array_merge($array,$arrays);
        usort($results['message'],array('member_lognew','timeorder'));
        if($results['message']){
        echo json_encode(array('code'=>1,'data'=>$results,'message'=>'我的消息','process_time'=>time())); exit;
        }else{
        echo json_encode(array('code'=>0,'data'=>null,'message'=>'没有消息哟~','process_time'=>time())); exit;
        }
        }else{
        echo json_encode(array('code'=>0,'data'=>null,'message'=>'未登录','process_time'=>time())); exit;
        }
    }

    function timeorder($a,$b){
      if ($a['addtimes']==$b['addtimes']) return 0;
      return ($a['addtimes']<$b['addtimes'])?1:-1;
    }
    function is_mobile(){
        $agent = strtolower($_SERVER['HTTP_USER_AGENT']);
        $is_pc = (strpos($agent, 'windows nt')) ? true : false;
        $is_mac = (strpos($agent, 'mac os')) ? true : false;
        $is_iphone = (strpos($agent, 'iphone')) ? true : false;
        $is_android = (strpos($agent, 'android')) ? true : false;
        $is_ipad = (strpos($agent, 'ipad')) ? true : false;
        

        if($is_pc){
              return  'pc站';
        }

        if($is_iphone){
              return  'iphone';
        }
        
        if($is_mac){
              return  true;
        }
        
        if($is_android){
              return  'android';
        }
        
        if($is_ipad){
              return  'ipad';
        }
    }
}



