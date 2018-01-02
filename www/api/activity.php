<?php
header('Content-type:text/html;charset=utf-8');
header("Access-Control-Allow-Origin: *");
define('WWW_ROOT',substr(dirname(__FILE__), 0, -4).'/');
require '../configs/web_config.php';
require COREFRAME_ROOT.'core.php';
$action = $GLOBALS['action'];
if($action=='activity') {
    hdata();
}else if($action=='district'){
    district();
}  
function hdata(){
    // $redis = new Redis();    
    // $redis->connect("127.0.0.1","6379");  
    // $redis->set("say","hello world");    
    // echo $redis->get("say"); die;
    $action_id = $GLOBALS['action_id'];
    $shuffling = 'shuffling';
    $db = load_class('db');
    if(empty($action_id)){
      echo json_encode(array('code'=>0,'活动id为空','process_time'=>time()));
      die;
    }
    $data = $db->get_one('m_newactivity',"id={$action_id} and status=1");
    $data_copy = $db->get_one('m_newactivity_copy',"activity_id={$action_id}");
    $data_lst = $db->get_one('m_newactivity_lst',"activity_id={$action_id}",'content,contents');
    if($data['area'] > 2){
         $c = $db->get_one('linkage_data','lid ='.$data['area'],'name');
    }
    $cname = !empty($c['name']) ? $c['name'] : '';
    $arr = array(
        'iftitle' => $data['headline'],//标题名称是否显示  0 显示 1 隐藏
        'navigation' => $data['navigation'],//是否显示底部导航是否显示  0 显示 1 隐藏
        'consult' => $data['consult'],//是否显示在线咨询按钮  0 显示 1 隐藏
        'floor' => $data['floor'],//是否显示公共底  0 显示 1 隐藏
        'applybox' => $data['applybox'],//发标组件是否显示  0 显示 1 隐藏 
        'share' => getMImgShow($data['share'],'original'), //分享图标
        'sharetitle' => $data['sharetitle'],//分享标题  
        'content' => $data['content'],//分享描述 
        'are'=> $data['area'],//1开通 2全国
        'default_s' =>$cname,
        'activity_type' => $data['activity_type'],//模板类型 0 h5 1 普通
    );
    if($data['activity_type']==1){
        $arr['background'] = getMImgShow($data['background'],'original');//发标背景
        if(empty($data['tosignup'])){
          $arr['tosignup'] = 0;
        }else{
          $arr['tosignup'] = $data['tosignup'];
        }
        //报名人数基数
        if(empty($data['submitcopy'])){
            $arr['submitcopy'] = '立即报名';
        }else{
            $arr['submitcopy'] = $data['submitcopy'];
        }
        //报名按钮背景文案
        $arr['buttoncolor'] = $data['buttoncolor'];//提交按钮背景颜色
        $arr['buttoncopycolor'] = $data['buttoncopycolor'];//提交按钮文案颜色
        $arr['numbercolor'] = $data['numbercolor'];//报名人数颜色
        $arr['cuewords'] = $data['cuewords'];//报名人数提示语颜色
    }
    if(intval($data['headline'])==1){
        $arr['title'] = $data['activitytitle'];//活动标题
    }
    if(intval($data['applybox'])==1){
       if(intval($data['area'])==1){
          $aredata=$action=dredge();
       }else if(intval($data['area'])==2){
          $aredata=$action=nationwide();
       }
        $arr['city'] = $aredata;
    }
    $arr_lst =  json_decode($data_lst['content']);
    $res = $resdata = array();
    foreach ($arr_lst as $ke => $va) {
         foreach ($va as $k => $v) {
            $res[$k][$ke] = $v;
         }
    }
  
    if(!empty($data_lst['contents'])){
      foreach ($res as $key => $value) {
        if(strstr($value['type'],$shuffling)){
        // echo "<pre>";var_dump(json_decode($data_lst['contents'])->$value['type']);
           if(!empty(json_decode($data_lst['contents'])->$value['type'])){
              $res_lst[$key]['shufflingpic'] = $value['picimg'];
              $res_lst[$key]['shufflingurl'] = trim($value['picurl']);
              $res[$key]['shuffling'] = $action=content(json_decode($data_lst['contents'])->$value['type'],$res_lst);
              $res_lst = array();
           }else{
              $res_lst[$key]['shufflingpic'] = $value['picimg'];
              $res_lst[$key]['shufflingurl'] = $value['picurl'];
              $res[$key]['shuffling']=array( 0 =>array(
                    'shufflingpic' => getMImgShow($value['picimg'],'original'),
                    'picurl' => trim($value['picurl']),
                   ),
                );
           }
         }
      }
    }


    foreach ($res  as $k => $va) {
        $resdata[$k]['picimg'] = getMImgShow($va['picimg'],'original');
        $resdata[$k]['id'] = $va['ids'];
        $resdata[$k]['jump'] = $va['jump'] == '无' ? '' : $va['jump'];
        $resdata[$k]['picurl'] = trim($va['picurl']);
        $resdata[$k]['picshow'] = $va['picshow'];
        $resdata[$k]['picout'] = $va['picout'];
        if(!empty($va['shuffling'])){
             $resdata[$k]['shuffling'] = $va['shuffling'];
        }
        if(strstr($va['type'],$shuffling)){
            $resdata[$k]['type'] = 'shuffling';
        }else{
            $resdata[$k]['type'] = $va['type'];//图片状态 pic图片 vim视频 shuffling轮播 bidding报名
        }
        if(intval($va['picshow'])==1){

           if(!empty($va['copy']) && !empty($va['color']) && !empty($va['copycolor'])){
               $resdata[$k]['location'] = $va['location'];//报名位置 0上 1下
               $resdata[$k]['copy'] = $va['copy'];//报名按钮背景文案
               $resdata[$k]['color'] = $va['color'];//报名按钮背景颜色
               $resdata[$k]['copycolor'] = $va['copycolor'];//报名按钮文案颜色
           }else{
                $resdata[$k]['location'] = $data_copy['location'];
                $resdata[$k]['copy'] = $data_copy['copy'];
                $resdata[$k]['color'] = $data_copy['color'];
                $resdata[$k]['copycolor'] = $data_copy['copycolor'];
           }
        }
       
        if(intval($data['activity_type'])==2){
            if($va['type']=='bidding'){
                $resdata[$k]['background'] = getMImgShow($va['picimg'],'original');//发标背景
                if(empty($data['tosignup'])){
                  $resdata[$k]['tosignup'] = 0;
                }else{
                  $resdata[$k]['tosignup'] = $data['tosignup'];
                }
                //报名人数基数
                if(empty($data['submitcopy'])){
                    $resdata[$k]['submitcopy'] = '立即报名';
                }else{
                    $resdata[$k]['submitcopy'] = $data['submitcopy'];
                }
                //报名按钮背景文案
                $resdata[$k]['buttoncolor'] = $data['buttoncolor'];//提交按钮背景颜色
                $resdata[$k]['buttoncopycolor'] = $data['buttoncopycolor'];//提交按钮文案颜色
                $resdata[$k]['numbercolor'] = $data['numbercolor'];//报名人数颜色
                $resdata[$k]['cuewords'] = $data['cuewords'];//报名人数提示语颜色
                unset($resdata[$k]['picimg']);unset($resdata[$k]['picurl']);
                unset($resdata[$k]['picshow']);unset($resdata[$k]['picout']);
            }
        }
    }
 
    $arr['module'] = $resdata;//图片数据
    echo json_encode(array('code'=>1,'arr'=>$arr,'process_time'=>time()));
}
function dredge(){
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
            "lid"=>'326',
            'name'=>'东莞市',
          ),
          array(
            'name'=>'武汉',
            'lid'=>'295',
          ),
            array(
            'name'=>'郑州',
            'lid'=>'278',
          ),
            array(
            'name'=>'成都',
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
    return $data;
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
function content($data,$res_lst){
        $arr = array();
        foreach ($data as $ke => $va) {
           foreach ($va as $k => $v) {
              $arr[$k][$ke] = $v;
           }
        }
        if(!empty($arr)){
            $arr = array_merge($arr,$res_lst);
        }
        foreach ($arr as $key => $va) {
           $arr[$key]['shufflingpic'] = getMImgShow($va['shufflingpic'],'original');//发标背景
        }
        return $arr;
}

