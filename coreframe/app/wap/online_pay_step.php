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
class online_pay_step extends WUZHI_foreground {
  public $pay_base;
  function __construct() {
    $this->member = load_class('member', 'member');
    $this->log = load_class('log','wap');
    $this->pay_base = load_class('online_pay', 'llpay');
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

  // 点击待验收按钮执行此方法
  public function wait_check_info(){
    $orderid = remove_xss($GLOBALS['orderid']);//获取订单编号
    $nodeid = remove_xss($GLOBALS['nodeid']);//获取节点号
    if (!$orderid) {
      echo json_encode(array('code'=>0,'data'=>'','message'=>'获取订单编号失败','process_time'=>time()));die;
    }
    if (!$nodeid) {
      echo json_encode(array('code'=>0,'data'=>'','message'=>'获取订单节点失败','process_time'=>time()));die;
    }
    //水电材料验收
    if($nodeid==25){
      $check_detail=$this->log->result7($orderid);
    }
    //水电工程验收
    if($nodeid==27){
      $check_detail=$this->log->result8($orderid);
    }
    //防水材料验收
    if($nodeid==28){
      $check_detail=$this->log->result9($orderid);
    }
    //瓦木材料验收
    if($nodeid==29){
      $check_detail=$this->log->result10($orderid);
    }
    //瓦木工程验收
    if($nodeid==31){
      $check_detail=$this->log->result11($orderid);
    }
    //油漆材料验收
    if($nodeid==33){
      $check_detail=$this->log->result12($orderid);
    }
    //油漆工程验收
    if($nodeid==35){
      $check_detail=$this->log->result13($orderid);
    }
    //安装工程验收
    if($nodeid==36){
      $check_detail=$this->log->result14($orderid);
    }
    //竣工验收
    if($nodeid==37){
      $check_detail=$this->log->result15($orderid);
    }
    // 查看该验收节点是否验收通过
    $check_res = $this->db->get_one('demand_track',array('orderid'=>$orderid,'nodeid'=>$nodeid),'checked_status');
    $check_detail['check_res'] = $check_res['checked_status'];
    $check_detail['extrapay_info'] = $this->get_extrapay_info($orderid,$nodeid);
    echo json_encode(array('code'=>1,'data'=>$check_detail,'message'=>'信息获取成功'));
  }

  public function get_extrapay_info($orderid,$nodeid){
    // 获取增减项金额
    $extrapay_num = $this->db->get_one('demand_referno',"orderid={$orderid} and nodeid={$nodeid} and extrapay!=0",'extrapay');
    $data['extrapay'] = floatval($extrapay_num['extrapay'])?floatval($extrapay_num['extrapay']):null;
    // 获取增减项图片
    $extrapay_img = $this->db->get_one('demand_track',"orderid={$orderid} and nodeid={$nodeid}",'attach1');
    if($extrapay_img['attach1']){
      $extrapay_img = explode("|",$extrapay_img['attach1']);
      $data['extrapay_photo'] = 'http://www.uzhuang.com/image/pic_230/'.$extrapay_img[0];
      foreach ($extrapay_img as $key => $value) {
        $data['extrapay_photos'][] = 'http://www.uzhuang.com/image/pic_800/'.$value;
      }
    }else{
      $data['extrapay_photo'] = '';
      $data['extrapay_photos'] = array();
    }
    return $data;
  }

  // 点击待支付按钮执行此方法
  public function wait_pay_info(){
    $orderid = remove_xss($GLOBALS['orderid']);//获取订单编号
    $nodeid = remove_xss($GLOBALS['nodeid']);//获取节点号
    $id = remove_xss($GLOBALS['id']);//获取支付项的id
    if (!$id) {
      echo json_encode(array('code'=>0,'data'=>'','message'=>'支付信息获取失败','process_time'=>time()));die;
    }
    if (!$orderid) {
      echo json_encode(array('code'=>0,'data'=>'','message'=>'获取订单编号失败','process_time'=>time()));die;
    }
    if (!$nodeid) {
      echo json_encode(array('code'=>0,'data'=>'','message'=>'获取订单节点失败','process_time'=>time()));die;
    }
    $data = array();
    $title = array();
    $content = array();
    $params = array();
    // 获取节点名称
    $nodename = $this->db->get_one('f_node',array('node_id'=>$nodeid),'node_name');
    // 获取支付项的订单编号、实付金额、增减项
    $pay_detail = $this->db->get_one('demand_referno',array('id'=>$id),'orderid,nodeid,needmoney,extrapay,deposit_money');
    // 签订公司
    $company = $this->db->get_one('demand_track_detail',"orderid='".$orderid."' and nodeid=13 and col8='是'",'col2');
    // 合同编号、合同总金额、付款比例编号
    $result = $this->db->get_one('demand',array('id'=>$orderid),'contactno,totalpay,payment_id');

    // 获取付款比例
    $payment_method = $this->db->get_one('f_payment_method',array('payment_id'=>$result['payment_id'],'node_id'=>$nodeid),'draw_rate');

    $title['company'] = $company['col2']?$company['col2']:null;//签订公司
    $title['contactno'] = $result['contactno']?$result['contactno']:null;//合同编号
    $title['totalpay'] = $result['totalpay']?$result['totalpay']:null;//合同总金额

    $content['draw_rate'] = $payment_method['draw_rate']?$payment_method['draw_rate']:null;//付款比例
    // 合同款
    $contactmoney = floatval($result['totalpay'])*floatval($payment_method['draw_rate'])/100;
    $content['contactmoney'] = $contactmoney?$contactmoney:null;//合同款
    $content['extrapay'] = $pay_detail['extrapay']?$pay_detail['extrapay']:null;//增减项
    /*if($nodeid==19){
      // 待支付金额
      $content['wait_pay_money'] = floatval($pay_detail['needmoney']);//-floatval($pay_detail['deposit_money']);
    }else{*/
    $wait_pay_money = floatval($pay_detail['needmoney']);//+floatval($pay_detail['extrapay']);
    // 获取已经支付的金额
    $payed_money = $this->pay_base->get_payed_money($id);
    // 重新计算待支付金额
    $wait_pay_money = floatval(bcsub($wait_pay_money, $payed_money,2));// $wait_pay_money-$payed_money;
    $content['wait_pay_money'] = $wait_pay_money?$wait_pay_money:null;//待支付
    $content['payed_money'] = $payed_money?$payed_money:null;//已支付金额
    if($nodeid==15){//获取设计协议编号、设计协议总金额
      $demand_info = $this->db->get_one('demand',array('id'=>$orderid),'designno,designpay');
      $title['designno'] = $demand_info['designno'];
      $title['designpay'] = $demand_info['designpay']?$demand_info['designpay']:null;
      $content['deposit'] = floatval($pay_detail['needmoney'])?floatval($pay_detail['needmoney']):null;
    }
    // }

    $params['orderid'] = $orderid;
    $params['nodeid'] = $nodeid;
    $params['id'] = $id;
    $params['money'] = $content['wait_pay_money'];// + floatval($pay_detail['extrapay']);

    $data['title'] = $title;
    $data['content'] = $content;
    $data['params'] = $params;

    if($nodeid==15){
      $nodename = $this->db->get_one('demand_track',array('orderid'=>$orderid,'nodeid'=>$nodeid),'nodename',0,'id asc');
      $data['nodename'] = $nodename['nodename'];//节点名称
    }else{
      $data['nodename'] = $nodename['node_name'];//节点名称
    }
    echo json_encode(array('code'=>1,'data'=>$data,'message'=>'信息获取成功'));
  }

  // 进入我的工地详情页时获取支付、验收信息
  public function list_check_pay(){
    $orderid = remove_xss($GLOBALS['orderid']);
    if (!$orderid) {
      echo json_encode(array('code'=>0,'data'=>'','message'=>'获取订单编号失败','process_time'=>time()));die;
    }
    // 要返回的数据
    $data = array();
    /**********************************获取需要支付的节点begin***********************************/
    // 根据订单id获取付款方式id
    $payment_id = $this->db->get_one('demand',array('id'=>$orderid),'payment_id');
    $payment_id = $payment_id['payment_id'];
    // 根据支付节点id获取需要支付的节点
    $pay_nodes = $this->db->get_list('f_payment_method',array('payment_id'=>$payment_id),'node_id');
    // 需要支付的节点号
    $pay_nodenos = array();
    foreach ($pay_nodes as $key => $node) {
      array_push($pay_nodenos, $node['node_id']);
    }
    array_unshift($pay_nodenos, '19');
    array_unshift($pay_nodenos, '15');
    array_unshift($pay_nodenos, '102');
    $pay_nodenos = array_unique($pay_nodenos);//需要支付的节点
    /**********************************获取需要支付的节点end***********************************/
    // 需要验收的节点
    $check_nodes = array(27,31,35,37);
    // 获取装修公司的名称
    $companyname = $this->db->get_one('demand_track_detail',"orderid='".$orderid."' and nodeid=13 and col8='是'",'col2');
    foreach ($pay_nodenos as $key => $node) {
      $node_data = array();
      $node_data['nodeid'] = $node;
      $nodename = $this->db->get_one('f_node',array('node_id'=>$node),'node_name');
      $node_data['nodename'] = $nodename['node_name'];
      
      if ($node==102||$node==15) {//见面或签意向定金节点
        // 获取节点名称
        $nodename = $this->db->get_one('demand_track',array('orderid'=>$orderid,'nodeid'=>$node),'nodename',0,'id asc');
        $node_data['nodename'] = $nodename['nodename'];
        // 获取支付信息
        $wait_pay_money = $this->db->get_list('demand_referno',array('orderid'=>$orderid,'nodeid'=>$node),'id,orderid,nodeid,needmoney,nodename,pay_schedult,is_online',0,200,0,'id asc');
        if(!$wait_pay_money)continue;
        $node_data['step'] = 2;//1待验收、2待支付、3待评价
        $node_data['pay_info'] = array();
        foreach ($wait_pay_money as $key => $money_data) {

          $pay_data['pay_schedult'] = $money_data['pay_schedult'];//0待支付、1完成支付

          $pay_data['title']['company'] = $companyname['col2'];//公司名称
          if($node_data['nodename']=='签设计协议'){
            $demand=$this->db->get_one('demand',"id='".$orderid."'",'designpay,totalpay,designno,contactno,payment_id');
            $pay_data['title']['designno'] = $demand['designno']?$demand['designno']:null;//协议编号
            $pay_data['title']['designpay'] = $demand['designpay']?$demand['designpay']:null;//协议金额
          }

          // 获取已支付金额
          $payed_money = $this->pay_base->get_payed_money($money_data['id']);
          // 待支付金额
          $wait_pay = floatval(bcsub(floatval($money_data['needmoney']), $payed_money,2));// floatval($money_data['needmoney'])-$payed_money;
          $pay_data['content']['deposit'] = $money_data['needmoney']?$money_data['needmoney']:null;//定金金额
          if($money_data['is_online']==1){
            $pay_data['content']['payed_money'] = $payed_money?$payed_money:null;//已支付金额
            $pay_data['content']['wait_pay_money'] = $wait_pay?$wait_pay:null;//待支付金额
          }else{
            $pay_data['content']['payed_money'] = $wait_pay?$wait_pay:null;//已支付金额
            $pay_data['content']['wait_pay_money'] = null;//待支付金额            
          }
          $pay_data['content']['extrapay'] = null;//增减项

          $pay_data['params']['orderid'] = $orderid;
          $pay_data['params']['nodeid'] = $node;
          $pay_data['params']['id'] = $money_data['id'];
          $pay_data['params']['money'] = $wait_pay;

          $node_data['pay_info'][] = $pay_data;
        }
        // 验收信息(无需验收节点、验收项为空)
        $node_data['check_info'] = array();
        array_push($data, $node_data);
      }else if($node==19){//签三方合同
        $node_data['step'] = 2;//1待验收、2待支付、3待评价
        // 合同编号、合同总金额、付款节点编号
        $result = $this->db->get_one('demand',array('id'=>$orderid),'contactno,totalpay,payment_id');
        // 获取付款比例
        $payment_method = $this->db->get_one('f_payment_method',array('payment_id'=>$result['payment_id'],'node_id'=>$node),'draw_rate');
        // 合同款
        $contract_money = floatval($result['totalpay'])*floatval($payment_method['draw_rate'])/100;
        // 获取支付金额
        $wait_pay_money = $this->db->get_list('demand_referno',array('orderid'=>$orderid,'nodeid'=>$node),'id,needmoney,pay_schedult,deposit_money,is_online',0,200,0,'id desc');
        foreach ($wait_pay_money as $key => $money_data) {
          $pay_data['pay_schedult'] = $money_data['pay_schedult'];

          $wait_pay = floatval($money_data['needmoney']);//-floatval($money_data['deposit_money']);
          // $node_data['pay_info'] = array();
          // 支付信息
          $pay_data['title']['company'] = $companyname['col2'];//公司名称
          $pay_data['title']['contactno'] = $result['contactno'];//合同编号
          $pay_data['title']['totalpay'] = $result['totalpay']?$result['totalpay']:null;//合同总金额
          unset($pay_data['title']['designno']);
          unset($pay_data['title']['designpay']);
          // 获取已支付金额
          $payed_money = $this->pay_base->get_payed_money($money_data['id']);
          // 待支付金额
          $wait_pay = floatval(bcsub($wait_pay, $payed_money,2));// $wait_pay-$payed_money;
          $pay_data['content']['draw_rate'] = $payment_method['draw_rate'];//付款比例
          $pay_data['content']['contactmoney'] = $contract_money?$contract_money:null;//合同款
          $pay_data['content']['deposit'] = floatval($money_data['deposit_money'])?floatval($money_data['deposit_money']):null;//已交定金
          if($money_data['is_online']==1){
            $pay_data['content']['payed_money'] = $payed_money?$payed_money:null;//待支付金额
            $pay_data['content']['wait_pay_money'] = $wait_pay?$wait_pay:null;//待支付金额
          }else{
            $pay_data['content']['payed_money'] = $wait_pay?$wait_pay:null;//待支付金额
            $pay_data['content']['wait_pay_money'] = null;//待支付金额
          }
          $pay_data['content']['extrapay'] = null;//增减项

          $pay_data['params']['orderid'] = $orderid;
          $pay_data['params']['nodeid'] = $node;
          $pay_data['params']['id'] = $money_data['id'];
          $pay_data['params']['money'] = $wait_pay;//支付金额

          $node_data['pay_info'][] = $pay_data;
        }

        // 验收信息
        $node_data['check_info'] = array();
        array_push($data, $node_data);
      }else{//需要验收的项
        // 查询是否验收通过
        $check_res = $this->db->get_one('demand_track',array('orderid'=>$orderid,'nodeid'=>$node,'checked_status'=>2),'checked_status');
        $node_data['step'] = $check_res?1:2;//1待验收、2待支付
        // 待支付的情况下查看该节点的收款比例是否存在、如果不存在则将step设置为0
        if($node_data['step']==2){
          $demand_draw_rate = $this->db->get_one('f_payment_method',array('payment_id'=>$payment_id,'node_id'=>$node),'draw_rate');
          if($demand_draw_rate['draw_rate']=='0.00'){
            $node_data['step'] = 0;
          }
        }
        // 合同编号、合同总金额、付款节点编号
        $result = $this->db->get_one('demand',array('id'=>$orderid),'contactno,totalpay,payment_id');
        // 获取付款比例
        $payment_method = $this->db->get_one('f_payment_method',array('payment_id'=>$result['payment_id'],'node_id'=>$node),'draw_rate');
        // 合同款
        $contract_money = floatval($result['totalpay'])*floatval($payment_method['draw_rate'])/100;
        // 获取增减项金额、明细、支付金额
        $extrapay_info = $this->db->get_list('demand_referno',array('orderid'=>$orderid,'nodeid'=>$node),'id,extrapay,posphoto,needmoney,pay_schedult,is_online',0,200,0,'id desc');

        foreach ($extrapay_info as $key => $money_data) {
          $pay_data['pay_schedult'] = $money_data['pay_schedult'];

          $pay_data['title']['company'] = $companyname['col2'];//公司名称
          $pay_data['title']['contactno'] = $result['contactno'];//合同编号
          $pay_data['title']['totalpay'] = $result['totalpay']?$result['totalpay']:null;//合同总金额

          // 获取已支付金额
          $payed_money = $this->pay_base->get_payed_money($money_data['id']);
          // 待支付金额
          $wait_pay = floatval(bcsub(floatval($money_data['needmoney']), $payed_money,2));// floatval($money_data['needmoney'])-$payed_money;
          $pay_data['content']['draw_rate'] = $payment_method['draw_rate'];//付款比例
          $pay_data['content']['contactmoney'] = $contract_money?$contract_money:null;//合同款
          $pay_data['content']['extrapay'] = $money_data['extrapay']?$money_data['extrapay']:null;//增减项
          if ($money_data['is_online']==1) {
            $pay_data['content']['payed_money'] = $payed_money?$payed_money:null;//已支付金额
            $pay_data['content']['wait_pay_money'] = $wait_pay?$wait_pay:null;//+floatval($money_data['extrapay']);//待支付金额
          }else{
            $pay_data['content']['payed_money'] = $wait_pay?$wait_pay:null;//已支付金额
            $pay_data['content']['wait_pay_money'] = null;//+floatval($money_data['extrapay']);//待支付金额
          }

          $pay_data['params']['orderid'] = $orderid;
          $pay_data['params']['nodeid'] = $node;
          $pay_data['params']['id'] = $money_data['id'];
          $pay_data['params']['money'] = $pay_data['content']['wait_pay_money'];//+floatval($money_data['extrapay']);

          $node_data['pay_info'][] = $pay_data;
        }

        $node_data['check_info'] = array();
        $node_data['check_info']['extrapay'] = $extrapay_info[0]['extrapay'];//增减项
        // 获取增减项照片
        $extrapay_photo = $this->db->get_one('demand_track',array('orderid'=>$orderid,'nodeid'=>$node),'attach1');
        if ($extrapay_photo['attach1']) {
          $photos = explode('|',$extrapay_photo['attach1']);
          foreach ($photos as $key => $photo) {
            $node_data['check_info']['photos'][] = "http://www.uzhuang.com/image/pic_800/".$photo;
            $node_data['check_info']['photo'][] = "http://www.uzhuang.com/image/pic_230/".$photo;
          }
        }else{
          $node_data['check_info']['photos'] = '';
          $node_data['check_info']['photo'] = '';
        }
      
        array_push($data, $node_data);
      }
    }

    // 只验收不支付的节点
    $only_check_nodes = array_diff($check_nodes,$pay_nodenos);
    foreach ($only_check_nodes as $key => $node) {
      $node_data = array();
      $node_data['nodeid'] = $node;
      $nodename = $this->db->get_one('f_node',array('node_id'=>$node),'node_name');
      $node_data['nodename'] = $nodename['node_name'];
      // 查询是否验收通过
      $check_res = $this->db->get_one('demand_track',array('orderid'=>$orderid,'nodeid'=>$node,'checked_status'=>2),'checked_status');
      $node_data['step'] = $check_res?1:0;//1待验收、0正常

      $node_data['pay_info'][] = array();

      $node_data['check_info'] = array();
      // 获取增减项金额、明细、支付金额
      $extrapay_info = $this->db->get_list('demand_referno',array('orderid'=>$orderid,'nodeid'=>$node),'id,extrapay,posphoto,needmoney,pay_schedult,is_online',0,200,0,'id desc');
      $node_data['check_info']['extrapay'] = $extrapay_info[0]['extrapay'];//增减项
      // 获取增减项照片
      $extrapay_photo = $this->db->get_one('demand_track',array('orderid'=>$orderid,'nodeid'=>$node),'attach1');
      if ($extrapay_photo['attach1']) {
        $photos = explode('|',$extrapay_photo['attach1']);
        foreach ($photos as $key => $photo) {
          $node_data['check_info']['photos'][] = "http://www.uzhuang.com/image/pic_800/".$photo;
          $node_data['check_info']['photo'][] = "http://www.uzhuang.com/image/pic_230/".$photo;
        }
      }else{
        $node_data['check_info']['photos'] = '';
        $node_data['check_info']['photo'] = '';
      }
    
      array_push($data, $node_data);
    }
    die(json_encode(array('code'=>1,'data'=>$data,'message'=>'数据获取成功')));
  }

}