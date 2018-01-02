<?php
header('Content-type:text/html;charset=utf-8');
header("Access-Control-Allow-Origin: *");
define('WWW_ROOT',substr(dirname(__FILE__), 0, -4).'/');
require '../configs/web_config.php';
require COREFRAME_ROOT.'core.php';
$action = $GLOBALS['action'];
if($action=='receive') {
    receive();
}else if($action=='search'){
	search();
}
	function receive(){
		$idfa=$GLOBALS['idfa'];
		$db = load_class('db');
		if(empty($idfa)){
	  		echo json_encode(array('code'=>1,'data'=>'广告标识为空插入失败！！','process_time'=>time()));
	  		die;
	  	}
	  	$idfa_yn=$db->get_one('idfa',"idfa_content='$idfa'",'idfa_id');
	  	if(!empty($idfa_yn)){
	  		echo json_encode(array('code'=>1,'data'=>'广告标识已存在入失败！！','process_time'=>time()));
	  		die;
	  	}
	  	$data=array();
	  	$data['idfa_content']=$idfa;
	  	$data['idfa_time']=time();
	  	$db->insert('idfa',$data);
	    $insertId= $db->insert_id();
	    if(empty($insertId)){
	  		echo json_encode(array('code'=>1,'data'=>'false','process_time'=>time()));
	  	}else{
	  		echo json_encode(array('code'=>0,'data'=>'ture','process_time'=>time()));
	  	}
	}
	function search(){
		$idfa=$GLOBALS['idfa'];
		$db = load_class('db');
		if(empty($idfa)){
	  		echo json_encode(array('code'=>0,'data'=>'参数为空查询失败！','process_time'=>time()));
	  		die;
	  	}
	    $idfa_yn=$db->get_one('idfa',"idfa_content='$idfa'",'idfa_id');
	  	if(!empty($idfa_yn)){
	  		echo json_encode(array('code'=>0,'data'=>'ture','process_time'=>time()));
	  	}else{
	  		echo json_encode(array('code'=>1,'data'=>'false','process_time'=>time()));
	  	}
	}





	