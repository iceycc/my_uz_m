<?php
header('Content-type:text/html;charset=utf-8');
header("Access-Control-Allow-Origin: *");
define('WWW_ROOT',substr(dirname(__FILE__), 0, -4).'/');
require '../configs/web_config.php';
require COREFRAME_ROOT.'core.php';
$action = $GLOBALS['action'];
if($action=='hdata') {
    hdata();
}else if($action=='district'){
    district();
}else if($action=='dredge'){
  dredge();
}
function hdata(){
   $hid=$GLOBALS['hid'];
   $db = load_class('db');
   if(empty($hid)){
      echo json_encode(array('code'=>1,'活动id为空','process_time'=>time()));
      die;
   }
   $data=$db->get_one('m_activity',"id={$hid} and status=1");
   if(empty($data['id'])){
    die;
   }
   $s=$db->get_list('m_activity_lst',"ex_id={$data['id']}",'*',0,200,0,'','caset');
   foreach ($s as $ks => $vs) {
      if($vs['sort']!=0){
        $pai='sort asc';
      }else{
        $pai='id asc';
      }
   }
   $sortlst=$db->get_list('m_activity_lst',"ex_id={$data['id']}",'*',0,200,0,$pai,'caset');
   $sort=$lst=$aTemps=array();
     foreach ($sortlst as $key => $value) {
        $sort[$key]['caset'] = $value['caset'];
        if(empty($value['caset']) && $value['type']=='apply'){
           $sort[$key]['caset'] = 'apply';
        }
     }
     if($data['applybox']==1){
     if($data['are']==1){
            $aredata=$action=dredge();
     }else if($data['are']==2){
            $aredata=$action=nationwide();
     }//判断报名区域选择
         $applybox=array(
               'background' => getMImgShow($data['background'],'original'),//报名框背景
               'tosignup'=>$data['tosignup'],//报名人数基数
               'submitcopy'=>$data['submitcopy'],//提交按钮文案
               'buttoncolor'=>$data['buttoncolor'],//提交按钮背景颜色
               'buttoncopycolor'=>$data['buttoncopycolor'],//提交按钮文案颜色
               'numbercolor'=>$data['numbercolor'],//报名人数颜色
               'cuewords'=>$data['cuewords'],//报名人数提示语颜色
               'city' =>$aredata,
               'are'=>$data['are'],//1开通 2全国
               'caset' =>'apply',
          );
  }//判断报名区域是否显示
     foreach ($sort as $k => $v) {
      $sorts[] = $v['caset'] ;
     }
     foreach ($sorts as $ks => $vs) {
       $lsdata[$vs]=$db->get_list('m_activity_lst',"ex_id={$data['id']} and caset='{$vs}'",'id,img,url,type,ad,caset',0,200,0,'bian asc');
       /*曹植修改begin*/
       // 判断是否是 发标组件
       if(strpos($vs,'apply')!==false&&$data['applybox']==1){
        $applyInfo = $db->get_one('m_activity_apply','ex_id='.$lsdata[$vs][0]['id']);
        $applyInfo['background'] = $applyInfo['img'] = getMImgShow($applyInfo['background'],'original');
        $applyInfo['city'] = $applyInfo['area']==1?dredge():nationwide();
        // $applyInfo['city'] = $applyInfo['area']==1?'公司开通城市':'全国城市';
        $applyInfo['caset'] = 'apply';
        $lsdata[$vs][0] = $applyInfo;
       }
       /*曹植修改end*/
     }
    foreach ($lsdata as $y => $e) {
    foreach ($e as $ey => $ue) {
        if(strpos($y,'apply')===false)$lsdata[$y][$ey][img]=getMImgShow($ue[img],'original');//曹植增加了if 条件
          $needle = "carrousel";
          $needle1 = "case";
          $needle2 = "vim";
          if (strstr($ue['caset'], $needle)){
            $lsdata[$y][$ey]['caset']='carrousel';
          }
          if (strstr($ue['caset'], $needle1)){
            $lsdata[$y][$ey]['caset']='case';
          }
          if (strstr($ue['caset'], $needle2)){
            $lsdata[$y][$ey]['caset']='vim';
          }
      } 
  }

    //曹植注释
    /*if(!empty($applybox)){
    foreach ($lsdata as $key => $value) {
        if($key=='apply'){
           $lsdata[$key]=$applybox;
        }
    }
  }*/
  foreach ($lsdata as $key => $value) {
      $aTemps[]= $value;
  }
  foreach ($aTemps as $aT => $Temps) {
    if(empty($Temps)){
      unset($aTemps[$aT]);
    }
  }
    $arr=array(
         'iftitle' => $data['iftitle'],//标题名称是否显示  1 显示 2 隐藏
         'applybox' => $data['applybox'],//报名区域是否显示 1 显示 2 隐藏
         'navigation'=>$data['navigation'],//是否显示底部导航 1 显示 2 隐藏
         'consult'=>$data['consult'],//是否显示在线咨询按钮 1 显示 2 隐藏
         'ifh5'=>$data['ifh5'],
         'module'=>$aTemps,
         'share'=>getMImgShow($data['share'],'original'),
         'sharename'=>$data['sharename'],
         'content'=>$data['content'],
   );
  if($data[ifh5]==1){
         $arrs=array(
           'floor'=>$data['floor'],//是否显示公共底 1 显示 2 隐藏
           );
           $arr=array_merge($arr,$arrs); 
  }//判断模板为普通模板还是H5模板
  if($data['iftitle']==1){
     $title=array(  
      'title'=>$data['activitytitle'],//标题名称
     );
       $arr=array_merge($arr,$title);  
  }//判断标题名称是否显示
  /*曹植修改 begin  将 发标组件 以原有的格式返回给前台*/
  foreach ($arr['module'] as $modulekey => $modulevalue) {
    // 数组中键值存在background为发标组件
    if (array_key_exists('background', $modulevalue[0])) {
      $arr['module'][$modulekey] = $modulevalue[0];
    }
  }
  /*曹植修改  end*/
    echo json_encode(array('code'=>1,'arr'=>$arr,'process_time'=>time()));
}
function dredge(){
  $status = $GLOBALS['status'];
	$data=array(
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
            "lid"=>'336',
            'name'=>'惠州',
          ),
              array(
            "lid"=>'342',
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
	   if(!empty($status)){
         echo json_encode(array('arr'=>$data));
     }else{
        return $data;
     }
}

function nationwide(){
	$db = load_class('db');
	$where = empty($city)?'pid in ("'.implode('","',array('2','3','4','5','34','35','0')).'") and pid !=2 and pid !=3 and pid !=4 and pid !=5 and pid !=34 and pid !=35':'pid="'.$city.'"';
    $info = array();
    foreach($db->get_list('linkage_data',$where,"lid,name") as $item){
         $info[] = $item;
     }
    return $info;
}
function district(){
  $db = load_class('db');
  $pid=$GLOBALS['select'];
  foreach($db->get_list('linkage_data',"pid={$pid}","lid,name") as $item){
         $info[] = $item;
     }
  echo json_encode(array('code'=>1,'arr'=>$info,'process_time'=>time()));
}

