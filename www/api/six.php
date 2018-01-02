<?php

header('Content-type:text/html;charset=utf-8');
header("Access-Control-Allow-Origin: *");
define('WWW_ROOT',substr(dirname(__FILE__), 0, -4).'/');
require '../configs/web_config.php';
require COREFRAME_ROOT.'core.php';

$action = $GLOBALS['action'];
if($action=='fbform') {
    fbform();
} elseif($action=='fbcount') {
    fbcount();
} 

function fbform() {

    $db = load_class('db');

    if(empty($GLOBALS['title'])) {
        send(false,null,'请填写联系人');
    }
    if(empty($GLOBALS['telephone'])) {
        send(false,null,'请填写电话');
    }
    if(!preg_match('/^(?:13\d{9}|15[0|1|2|3|5|6|7|8|9]\d{8}|17[0|1|2|3|5|6|7|8|9]\d{8}|19[9]\d{8}|18[0|1|2|3|5|6|7|8|9]\d{8}|14[5|7]\d{8})$/',$GLOBALS['telephone'])) {
         send(false,null,'电话号码错误！');
    }
    $formdata = array();
    $formdata['title'] = remove_xss($GLOBALS['title']);
    $formdata['telephone'] = remove_xss($GLOBALS['telephone']);
    $formdata['addtime'] = date('Y-m-d H:i:s',SYS_TIME);
    $formdata['source'] = remove_xss($GLOBALS['source']);
    if(!empty($GLOBALS['company_id'])){
      $c_name = $db->get_one('company','id='.$GLOBALS['company_id'],'title');
       $formdata['kfzy'] = $c_name['title'];
    }
    $formdata['cid'] = 135;
    $formdata['status'] = 1;
    $data = $db->get_one('demand','telephone='.$formdata['telephone'],'addtime',0,'addtime desc');
    if(!empty($data['addtime']) && (strtotime($formdata['addtime'])-strtotime($data['addtime']))<12*3600){
        send(false,null,'您已成功报名过，12小时内只允许提交一次！');
    }
    $id = $db->insert('demand',$formdata);
  
    $msg = get_config('message_config');
    $msg = $msg['normal'];
   
    $order_no = '1'.str_pad($id,9,0,STR_PAD_LEFT);
    $db->update('demand',array('order_no'=>$order_no),array('id'=>$id));
    $d1 = date('Y-m-d',SYS_TIME).' 8:00:01';
    $d2 = date('Y-m-d',SYS_TIME).' 18:00:01';
    $d3 = date('Y-m-d',SYS_TIME).' 23:59:59';
    $d1 = strtotime($d1);
    $d2 = strtotime($d2);
    $d3 = strtotime($d3);
    if(SYS_TIME<$d1) {
        send(true,null,'<span style=" color:#E07D1A;font-size: 22px;">报名成功！</span><br/><br/>您的装修申请已经提交，<br/>客服会在2小时内联系您,<br/>请您保持手机畅通！
    ');
    } elseif(SYS_TIME<$d2) {
        send(true,null,'<span style=" color:#E07D1A;font-size: 22px;">报名成功！</span><br/><br/>您的装修申请已经提交，<br/>客服会在2小时内联系您,<br/>请您保持手机畅通！
    ');
    } else {
        send(true,null,'<span style=" color:#E07D1A;font-size: 22px;">报名成功！</span><br/><br/>您的装修申请已经提交，<br/>客服会在2小时内联系您,<br/>请您保持手机畅通！
     ');
    }

}

function fbcount(){
    // $db = load_class('db');
    // $count = $db->count('demand',"source='618activity'");
    // echo $count['num'];
    // exit;
}

function send($status,$data,$msg){
    if(!$status){
        $data =null;
    }
    $return_data = array(
        'flag' =>$status,
        'msg' => $msg,
        'data'=>$data,
        'time' => time(),
    );
    header('Content-Type:text/jcmd; charset=utf-8');
    echo  json_encode($return_data);
    exit;
}
