<?php
header('Content-type:text/html;charset=utf-8');
header("Access-Control-Allow-Origin: *");
define('WWW_ROOT',substr(dirname(__FILE__), 0, -4).'/');
require '../configs/web_config.php';
require COREFRAME_ROOT.'core.php';
$action = $GLOBALS['action'];
if($action=='subscribe') {
    subscribe();
} 
function subscribe(){
	$temp=$GLOBALS['temp'];
	$type=$GLOBALS['type'];
    if($type=='Boutique'){
      $datas=$action=Boutique($temp);
    }
    if($type=='steward'){
      $datas=$action=steward($temp);
    }
    if($type=='works'){
      $datas=$action=works($temp);
    }
    if($type=='designer'){
      $datas=$action=designer($temp);
    }
     $ctiy=$action=ctiy();
     $fbcount=$action=fbcount();
     $data=array(
     	 'titie'=>$datas['title'],
     	 'cover'=>$datas['cover'],
     	 'name'=>$datas['name'],
     	 'personalphoto'=>$datas['personalphoto'],
     	 'level'=>$datas['level'],
     	 'thumb'=>$datas['thumb'],
       'ranks'=>$datas['ranks'],
     	 'city'=>$ctiy,
     	 'fbcount'=>$fbcount,
     	);
     if ($type=='taocan') {//如果是装修套餐则请求该套餐的报名人数
        $package_id = intval($GLOBALS['package_id']);//接受套餐id
        if (is_numeric($package_id)) {
          $db = load_class('db');
          $signup_num = $db->get_one('block_product_detail',array('id'=>$package_id),'signup');
          $data['fbcount'] = intval($signup_num['signup'])?intval($signup_num['signup']):null;//改套餐报名人数
        }
     }
    $data=array_filter($data);
    echo  json_encode(array('code'=>1,'data'=>$data,'process_time'=>time()));
}
function Boutique($temp){
	$db = load_class('db');
	$data=$db->get_one('m_picture','id='.$temp,"*");
	$datas=array();
	$datas['title']='我想要这样装';
	$datas['cover']=getMImgShow($data['cover'],'big_square');
	return $datas;
    
}
function steward($temp){
  $db = load_class('db');
	$data=$db->get_one('member_hk_data','uid='.$temp,"*");
	$datas=array();
	$datas['title']='预约管家';
	$datas['name']=$data['gjname'];
	$datas['personalphoto']='http://www.uzhuang.com/image/pic_230/'.$data['personalphoto'];
	$level = array('0' =>'管家' , '1' =>'资深管家');
	$datas['level']=$level[$data['level']];
	return $datas;
}
function works($temp){
	$db = load_class('db');
	$data=$db->get_one('m_company','id='.$temp,"*");
	$datas['title']='预约装修公司';
	$datas['name']=$data['title'];
	$datas['thumb']='http://image1.uzhuang.com/image/big_square/'.$data['thumb'];
	return $datas;
}
function designer($temp){
  $db = load_class('db');
  $data=$db->get_one('m_company_team','id='.$temp,"*");
  $datas['title']='预约设计师';
  $datas['name']=$data['title'];
  if($data['thumb1']){
       $datas['thumb']= getMImgShow($data['thumb1'],'big_square');
    }else{
       $datas['thumb']='http://image1.uzhuang.com/image/big_square/'.$data['thumb'];
    }
  $datas['ranks']=$data['ranks'];
  return $datas;
}
function ctiy(){
	$info=array(
        array(
            "lid"=>'3360',
            'name'=>'北京市',
          ),
         array(
            "lid"=>'3362',
            'name'=>'天津市',
          ),
          array(
            "lid"=>'328',
            'name'=>'深圳市',
          ),
           array(
            "lid"=>'326',
            'name'=>'广州',
          ),
            array(
            "lid"=>'3361',
            'name'=>'上海市',
          ),
             array(
            "lid"=>'435',
            'name'=>'西安市',
          ),
              array(
            "lid"=>'213',
            'name'=>'杭州市',
          ),
              array(
            "lid"=>'200',
            'name'=>'南京市',
          ),
              array(
            "lid"=>'326',
            'name'=>'东莞市',
          ),
              array(
              'name'=>'武汉市',
              'lid'=>'295',
            ),
              array(
              'name'=>'郑州市',
              'lid'=>'278',
            ),
              array(
              'name'=>'成都市',
              'lid'=>'382',
            ),
              array(
              'name'=>'青岛市',
              'lid'=>'262',
            ),
              array(
              'name'=>'大连市',
              'lid'=>'165',
            ),
      );
	return $info;
}
function fbcount(){
    $db = load_class('db');
    $count = $db->count('demand');
    return $count['num']+1000;
   
}