<?php
// +----------------------------------------------------------------------
// | wuzhicms [ 五指互联网站内容管理系统 ]
// | Copyright (c) 2014-2015 http://www.wuzhicms.com All rights reserved.
// | Licensed ( http://www.wuzhicms.com/licenses/ )
// | Author: wangcanjia <phpip@qq.com>
// +----------------------------------------------------------------------
header("Access-Control-Allow-Origin: *");
defined('IN_WZ') or exit('No direct script access allowed');
/**
 * 首页
 */
load_class('foreground', 'member');
class zxkt_index extends WUZHI_foreground {
	function __construct() {
        $this->member = load_class('member', 'member');
        load_function('common', 'member');
        $this->member_setting = get_cache('setting', 'member');
        parent::__construct();
	}
  
  //视频讲堂
  public function video_lecture(){
    $res=$this->db->get_list('faq',"cid=290 and status=9",'id,title,remark,url,thumb',0,2,$page,'addtime desc');
    foreach ($res as $key => $value) {
      if($value['thumb']){
        $res[$key]['thumb']="http://www.uzhuang.com/image/pic_230/".$value['thumb'];
      }
    }
    return $res;
  }
  //装修攻略
  public function zx_strategy(){
    $res=$this->db->get_list('faq',"cid in (66,67,68,69,70,71,72,73,74,75,76,81,82,83) and status=9",'id,cid,title,remark,thumb',0,3,$page,'addtime desc');
    $configs_picture = get_config('picture_config');
    foreach ($res as $key => $value) {
       //详情页地址
      if(WEBURL=='http://m.uzhuang.com/'){
          $res[$key]['url']="http://m.uzhuang.com/mobile-uzapp_article.html?uzid=".$value['id'];
      }else if(WEBURL=='http://mdev.uz.com/'){
          $res[$key]['url']="http://mdev.uz.com/mobile-uzapp_article.html?uzid=".$value['id'];
      }else if(WEBURL=='http://mtest.uz.com/'){
          $res[$key]['url']="http://mtest.uz.com/mobile-uzapp_article.html?uzid=".$value['id'];
      }else if(WEBURL=='http://mpre.uz.com/'){
          $res[$key]['url']="http://mpre.uz.com/mobile-uzapp_article.html?uzid=".$value['id'];
      }
      //详情页分享
      if(WEBURL=='http://m.uzhuang.com/'){
          $res[$key]['share']="http://m.uzhuang.com/mobile-uzapp_share.html?uzid=".$value['id'];
      }else if(WEBURL=='http://mdev.uz.com/'){
          $res[$key]['share']="http://mdev.uz.com/mobile-uzapp_share.html?uzid=".$value['id'];
      }else if(WEBURL=='http://mtest.uz.com/'){
          $res[$key]['share']="http://mtest.uz.com/mobile-uzapp_share.html?uzid=".$value['id'];
      }else if(WEBURL=='http://mpre.uz.com/'){
          $res[$key]['share']="http://mpre.uz.com/mobile-uzapp_share.html?uzid=".$value['id'];
      }
      $res[$key]['cid_name']=$configs_picture['Decoration_class'][$value['cid']];
      if($value['thumb']){
        $res[$key]['thumb']="http://www.uzhuang.com/image/pic_230/".$value['thumb'];
      }
    }
    return $res;
  }
  //业主故事
  public function owner_story(){
    $res=$this->db->get_list('faq',"cid=301 and status=9",'id,title,remark,thumb,addtime',0,2,$page,'addtime desc');
    //$res=$this->db->get_list('faq',"cid=294 and status=9",'id,title,remark,thumb,addtime',0,2,$page,'addtime desc');
    foreach ($res as $key => $value) {
       //详情页地址
      if(WEBURL=='http://m.uzhuang.com/'){
          $res[$key]['url']="http://m.uzhuang.com/mobile-uzapp_article.html?uzid=".$value['id'];
      }else if(WEBURL=='http://mdev.uz.com/'){
          $res[$key]['url']="http://mdev.uz.com/mobile-uzapp_article.html?uzid=".$value['id'];
      }else if(WEBURL=='http://mtest.uz.com/'){
          $res[$key]['url']="http://mtest.uz.com/mobile-uzapp_article.html?uzid=".$value['id'];
      }else if(WEBURL=='http://mpre.uz.com/'){
          $res[$key]['url']="http://mpre.uz.com/mobile-uzapp_article.html?uzid=".$value['id'];
      }
      //详情页分享
      if(WEBURL=='http://m.uzhuang.com/'){
          $res[$key]['share']="http://m.uzhuang.com/mobile-uzapp_share.html?uzid=".$value['id'];
      }else if(WEBURL=='http://mdev.uz.com/'){
          $res[$key]['share']="http://mdev.uz.com/mobile-uzapp_share.html?uzid=".$value['id'];
      }else if(WEBURL=='http://mtest.uz.com/'){
          $res[$key]['share']="http://mtest.uz.com/mobile-uzapp_share.html?uzid=".$value['id'];
      }else if(WEBURL=='http://mpre.uz.com/'){
          $res[$key]['share']="http://mpre.uz.com/mobile-uzapp_share.html?uzid=".$value['id'];
      }
      $res[$key]['addtime']=date('Y-m-d',$value['addtime']);
      if($value['thumb']){
          $res[$key]['thumb']="http://www.uzhuang.com/image/pic_230/".$value['thumb'];
      }
    }
    return $res;
  }
  //装修风水
  public function House_geomancy(){
    $res=$this->db->get_list('faq',"cid=87 and status=9",'id,title,remark,thumb',0,2,$page,'addtime desc');
    foreach ($res as $key => $value) {
       //详情页地址
      if(WEBURL=='http://m.uzhuang.com/'){
          $res[$key]['url']="http://m.uzhuang.com/mobile-uzapp_article.html?uzid=".$value['id'];
      }else if(WEBURL=='http://mdev.uz.com/'){
          $res[$key]['url']="http://mdev.uz.com/mobile-uzapp_article.html?uzid=".$value['id'];
      }else if(WEBURL=='http://mtest.uz.com/'){
          $res[$key]['url']="http://mtest.uz.com/mobile-uzapp_article.html?uzid=".$value['id'];
      }else if(WEBURL=='http://mpre.uz.com/'){
          $res[$key]['url']="http://mpre.uz.com/mobile-uzapp_article.html?uzid=".$value['id'];
      }
      //详情页分享
      if(WEBURL=='http://m.uzhuang.com/'){
          $res[$key]['share']="http://m.uzhuang.com/mobile-uzapp_share.html?uzid=".$value['id'];
      }else if(WEBURL=='http://mdev.uz.com/'){
          $res[$key]['share']="http://mdev.uz.com/mobile-uzapp_share.html?uzid=".$value['id'];
      }else if(WEBURL=='http://mtest.uz.com/'){
          $res[$key]['share']="http://mtest.uz.com/mobile-uzapp_share.html?uzid=".$value['id'];
      }else if(WEBURL=='http://mpre.uz.com/'){
          $res[$key]['share']="http://mpre.uz.com/mobile-uzapp_share.html?uzid=".$value['id'];
      }
      if($value['thumb']){
          $res[$key]['thumb']="http://www.uzhuang.com/image/pic_230/".$value['thumb'];
      }
    }
    return $res;
  }
  //家装选材
  public function  material_selection(){
    $configs_picture = get_config('picture_config');
    $config=array_keys($configs_picture['material_selection']);
    $a=implode(',',$config);
    $res=$this->db->get_list('faq',"cid in (".$a.") and status=9",'id,cid,title,remark,thumb',0,3,$page,'addtime desc');
    foreach ($res as $key => $value) {
       //详情页地址
      if(WEBURL=='http://m.uzhuang.com/'){
          $res[$key]['url']="http://m.uzhuang.com/mobile-uzapp_article.html?uzid=".$value['id'];
      }else if(WEBURL=='http://mdev.uz.com/'){
          $res[$key]['url']="http://mdev.uz.com/mobile-uzapp_article.html?uzid=".$value['id'];
      }else if(WEBURL=='http://mtest.uz.com/'){
          $res[$key]['url']="http://mtest.uz.com/mobile-uzapp_article.html?uzid=".$value['id'];
      }else if(WEBURL=='http://mpre.uz.com/'){
          $res[$key]['url']="http://mpre.uz.com/mobile-uzapp_article.html?uzid=".$value['id'];
      }
      //详情页分享
      if(WEBURL=='http://m.uzhuang.com/'){
          $res[$key]['share']="http://m.uzhuang.com/mobile-uzapp_share.html?uzid=".$value['id'];
      }else if(WEBURL=='http://mdev.uz.com/'){
          $res[$key]['share']="http://mdev.uz.com/mobile-uzapp_share.html?uzid=".$value['id'];
      }else if(WEBURL=='http://mtest.uz.com/'){
          $res[$key]['share']="http://mtest.uz.com/mobile-uzapp_share.html?uzid=".$value['id'];
      }else if(WEBURL=='http://mpre.uz.com/'){
          $res[$key]['share']="http://mpre.uz.com/mobile-uzapp_share.html?uzid=".$value['id'];
      }
      $res[$key]['cid_name']=$configs_picture['material_selection'][$value['cid']];
      if($value['thumb']){
          $res[$key]['thumb']="http://www.uzhuang.com/image/pic_230/".$value['thumb'];
      }
    }
    return $res;
  }

  //装修课堂频道页
  public function index(){
    $arr=array(
           //视频讲堂
          'video_lecture' =>$this->video_lecture(),
           //装修攻略
          'zx_strategy' =>$this->zx_strategy(),
           //业主故事
          'owner_story' =>$this->owner_story(),
           //装修风水
          'house_geomancy' =>$this->House_geomancy(),
           //家装选材
          'material_selection' =>$this->material_selection()
        );
    echo json_encode(array('code'=>1,'data'=>$arr,'message'=>'操作成功','process_time'=>time())); exit;
  }

  //视频讲堂列表页
  public function video_list(){
    $page = intval($GLOBALS['page']);
      if(!isset($page)||empty($page)){
        $page=1;
    }
    $ress=$this->db->get_list('faq',"cid=290 and status=9",'title,remark,url,thumb');
    $res=$this->db->get_list('faq',"cid=290 and status=9",'id,title,remark,url,thumb',0,10,$page,'sort desc,addtime desc');
    $c=count($ress);
    $page_max=ceil($c/10);
    foreach ($res as $key => $value) {
      if($value['thumb']){
          $res[$key]['thumb']="http://www.uzhuang.com/image/pic_230/".$value['thumb'];
      }
    }
    $arr_finally=array(
            'arr'=>$res,
            'page_max'=>$page_max,
          );    
    echo json_encode(array('code'=>1,'data'=>$arr_finally,'message'=>'操作成功','process_time'=>time())); exit;
  }

  //装修攻略列表页
  public function zx_strategy_list(){
    $page = intval($GLOBALS['page']);
      if(!isset($page)||empty($page)){
        $page=1;
    }
    $cid=$GLOBALS['cid'];
    if(!empty($cid)){
    $ress=$this->db->get_list('faq',"cid='".$cid."' and status=9",'id');
    $res=$this->db->get_list('faq',"cid='".$cid."' and status=9",'id,title,remark,thumb',0,10,$page,'sort desc,addtime desc');
    $c=count($ress);
    $page_max=ceil($c/10);
    $configs_picture = get_config('picture_config');
    foreach ($res as $key => $value) {
       //详情页地址
      if(WEBURL=='http://m.uzhuang.com/'){
          $res[$key]['url']="http://m.uzhuang.com/mobile-uzapp_article.html?uzid=".$value['id'];
      }else if(WEBURL=='http://mdev.uz.com/'){
          $res[$key]['url']="http://mdev.uz.com/mobile-uzapp_article.html?uzid=".$value['id'];
      }else if(WEBURL=='http://mtest.uz.com/'){
          $res[$key]['url']="http://mtest.uz.com/mobile-uzapp_article.html?uzid=".$value['id'];
      }else if(WEBURL=='http://mpre.uz.com/'){
          $res[$key]['url']="http://mpre.uz.com/mobile-uzapp_article.html?uzid=".$value['id'];
      }
      //详情页分享
      if(WEBURL=='http://m.uzhuang.com/'){
          $res[$key]['share']="http://m.uzhuang.com/mobile-uzapp_share.html?uzid=".$value['id'];
      }else if(WEBURL=='http://mdev.uz.com/'){
          $res[$key]['share']="http://mdev.uz.com/mobile-uzapp_share.html?uzid=".$value['id'];
      }else if(WEBURL=='http://mtest.uz.com/'){
          $res[$key]['share']="http://mtest.uz.com/mobile-uzapp_share.html?uzid=".$value['id'];
      }else if(WEBURL=='http://mpre.uz.com/'){
          $res[$key]['share']="http://mpre.uz.com/mobile-uzapp_share.html?uzid=".$value['id'];
      }
      $res[$key]['cid_name']=$configs_picture['Decoration_class'][$value['cid']];
      if($value['thumb']){
          $res[$key]['thumb']="http://www.uzhuang.com/image/pic_230/".$value['thumb'];
      }
    }
    $arr_finally=array(
            'arr'=>$res,
            'page_max'=>$page_max,
          );
    echo json_encode(array('code'=>1,'data'=>$arr_finally,'message'=>'操作成功','process_time'=>time())); exit;
    }else{
    echo json_encode(array('code'=>0,'data'=>null,'message'=>'参数不存在','process_time'=>time())); exit;
    }
  }

  //装修攻略搜索
 public function zx_strategy_seek(){
    $search_name=$GLOBALS['search_name'];
    $status=$GLOBALS['status'];
    if($search_name) {
        if($status=='cl'){
          $where .= "`title` LIKE '%".$search_name."%' and status=9 and cid in (36,37,38,39,40,41,42,43,44,45,46,47,48,49,50,51,52,53,17154,55,56,57,58,59)";
          $res=$this->db->get_list('faq',$where,'id,title,remark,thumb');
        }else if($status=='gl'){
          $where .= "`title` LIKE '%".$search_name."%' and status=9 and cid in(66,67,68,69,70,71,72,73,74,75,76,81,82,83)";
          $res=$this->db->get_list('faq',$where,'id,title,remark,thumb');
        }else{
          echo json_encode(array('code'=>0,'data'=>null,'message'=>'请输入搜索模块参数','process_time'=>time())); exit;
        }
    }else{
      echo json_encode(array('code'=>0,'data'=>null,'message'=>'您没有输入搜索信息','process_time'=>time())); exit;
    }
    foreach ($res as $key => $value){
      //$res[$key]['addtime']=date('Y-m-d H:i',$value['addtime']);
       //详情页地址
      if(WEBURL=='http://m.uzhuang.com/'){
          $res[$key]['url']="http://m.uzhuang.com/mobile-uzapp_article.html?uzid=".$value['id'];
      }else if(WEBURL=='http://mdev.uz.com/'){
          $res[$key]['url']="http://mdev.uz.com/mobile-uzapp_article.html?uzid=".$value['id'];
      }else if(WEBURL=='http://mtest.uz.com/'){
          $res[$key]['url']="http://mtest.uz.com/mobile-uzapp_article.html?uzid=".$value['id'];
      }else if(WEBURL=='http://mpre.uz.com/'){
          $res[$key]['url']="http://mpre.uz.com/mobile-uzapp_article.html?uzid=".$value['id'];
      }
      //详情页分享
      if(WEBURL=='http://m.uzhuang.com/'){
          $res[$key]['share']="http://m.uzhuang.com/mobile-uzapp_share.html?uzid=".$value['id'];
      }else if(WEBURL=='http://mdev.uz.com/'){
          $res[$key]['share']="http://mdev.uz.com/mobile-uzapp_share.html?uzid=".$value['id'];
      }else if(WEBURL=='http://mtest.uz.com/'){
          $res[$key]['share']="http://mtest.uz.com/mobile-uzapp_share.html?uzid=".$value['id'];
      }else if(WEBURL=='http://mpre.uz.com/'){
          $res[$key]['share']="http://mpre.uz.com/mobile-uzapp_share.html?uzid=".$value['id'];
      }
      if($value['thumb']){
          $res[$key]['thumb']="http://www.uzhuang.com/image/pic_230/".$value['thumb'];
      }
    }
    if(!empty($res)){
    echo json_encode(array('code'=>1,'data'=>$res,'message'=>'操作成功','process_time'=>time())); exit;
    }else{
    echo json_encode(array('code'=>0,'data'=>null,'message'=>'没有更多的搜索结果','process_time'=>time())); exit;
    }
  }

  //业主故事列表页
  public function owner_story_list(){
    $page = intval($GLOBALS['page']);
      if(!isset($page)||empty($page)){
        $page=1;
    }
    $ress=$this->db->get_list('faq',"cid=301 and status=9",'title');
    $res=$this->db->get_list('faq',"cid=301 and status=9",'id,title,url,thumb,addtime,remark',0,10,$page,'sort desc,addtime desc');
    //$ress=$this->db->get_list('faq',"cid=294 and status=9",'title');
    //$res=$this->db->get_list('faq',"cid=294 and status=9",'id,title,url,thumb,addtime,remark',0,10,$page,'sort desc,addtime desc');
    $c=count($ress);
    $page_max=ceil($c/10);
    foreach ($res as $key => $value) {
      $res[$key]['addtime']=date('Y-m-d',$value['addtime']);
       //详情页地址
      if(WEBURL=='http://m.uzhuang.com/'){
          $res[$key]['url']="http://m.uzhuang.com/mobile-uzapp_article.html?uzid=".$value['id'];
      }else if(WEBURL=='http://mdev.uz.com/'){
          $res[$key]['url']="http://mdev.uz.com/mobile-uzapp_article.html?uzid=".$value['id'];
      }else if(WEBURL=='http://mtest.uz.com/'){
          $res[$key]['url']="http://mtest.uz.com/mobile-uzapp_article.html?uzid=".$value['id'];
      }else if(WEBURL=='http://mpre.uz.com/'){
          $res[$key]['url']="http://mpre.uz.com/mobile-uzapp_article.html?uzid=".$value['id'];
      }
      //详情页分享
      if(WEBURL=='http://m.uzhuang.com/'){
          $res[$key]['share']="http://m.uzhuang.com/mobile-uzapp_share.html?uzid=".$value['id'];
      }else if(WEBURL=='http://mdev.uz.com/'){
          $res[$key]['share']="http://mdev.uz.com/mobile-uzapp_share.html?uzid=".$value['id'];
      }else if(WEBURL=='http://mtest.uz.com/'){
          $res[$key]['share']="http://mtest.uz.com/mobile-uzapp_share.html?uzid=".$value['id'];
      }else if(WEBURL=='http://mpre.uz.com/'){
          $res[$key]['share']="http://mpre.uz.com/mobile-uzapp_share.html?uzid=".$value['id'];
      }
      if($value['thumb']){
          $res[$key]['thumb']="http://www.uzhuang.com/image/pic_230/".$value['thumb'];
      }
    }
    $arr_finally=array(
        'arr'=>$res,
        'page_max'=>$page_max,
    );  
    $resss=$this->db->get_list('faq',"cid=300 and status=9",'id,url,title,remark,thumb,addtime',0,100,$page,'sort desc,addtime desc');
    //$ress=$this->db->get_list('faq',"cid=293 and status=9",'id,url,title,remark,thumb,addtime',0,100,$page,'sort desc,addtime desc');
    foreach ($resss as $keys => $values) {
      $resss[$keys]['video_url']=$values['url'];
      $resss[$keys]['addtime']=date('Y-m-d',$values['addtime']);
      if($values['thumb']){
          $resss[$keys]['thumb']="http://www.uzhuang.com/image/pic_230/".$values['thumb'];
      }
    }
    $arr=array(
      'video'=>$resss,
      'article'=>$arr_finally
      );
    echo json_encode(array('code'=>1,'data'=>$arr,'message'=>'操作成功','process_time'=>time())); exit;
  }

  //装修风水列表页
  public function zx_geomantic_list(){
    $page = intval($GLOBALS['page']);
      if(!isset($page)||empty($page)){
        $page=1;
    }
    $ress=$this->db->get_list('faq',"cid=87 and status=9",'id');
    $res=$this->db->get_list('faq',"cid=87 and status=9",'id,title,remark,thumb',0,10,$page,'sort desc,addtime desc');
    $c=count($ress);
    $page_max=ceil($c/10);
    foreach ($res as $key => $value) {
      //$res[$key]['addtime']=date('Y-m-d H:i',$value['addtime']);
       //详情页地址
      if(WEBURL=='http://m.uzhuang.com/'){
          $res[$key]['url']="http://m.uzhuang.com/mobile-uzapp_article.html?uzid=".$value['id'];
      }else if(WEBURL=='http://mdev.uz.com/'){
          $res[$key]['url']="http://mdev.uz.com/mobile-uzapp_article.html?uzid=".$value['id'];
      }else if(WEBURL=='http://mtest.uz.com/'){
          $res[$key]['url']="http://mtest.uz.com/mobile-uzapp_article.html?uzid=".$value['id'];
      }else if(WEBURL=='http://mpre.uz.com/'){
          $res[$key]['url']="http://mpre.uz.com/mobile-uzapp_article.html?uzid=".$value['id'];
      }
      //详情页分享
      if(WEBURL=='http://m.uzhuang.com/'){
          $res[$key]['share']="http://m.uzhuang.com/mobile-uzapp_share.html?uzid=".$value['id'];
      }else if(WEBURL=='http://mdev.uz.com/'){
          $res[$key]['share']="http://mdev.uz.com/mobile-uzapp_share.html?uzid=".$value['id'];
      }else if(WEBURL=='http://mtest.uz.com/'){
          $res[$key]['share']="http://mtest.uz.com/mobile-uzapp_share.html?uzid=".$value['id'];
      }else if(WEBURL=='http://mpre.uz.com/'){
          $res[$key]['share']="http://mpre.uz.com/mobile-uzapp_share.html?uzid=".$value['id'];
      }
      if($value['thumb']){
          $res[$key]['thumb']="http://www.uzhuang.com/image/pic_230/".$value['thumb'];
      }
    }
    $arr_finally=array(
        'arr'=>$res,
        'page_max'=>$page_max,
    );
    echo json_encode(array('code'=>1,'data'=>$arr_finally,'message'=>'操作成功','process_time'=>time())); exit;
  }

  //家装选材列表页
  public function material_selection_list(){
    $page = intval($GLOBALS['page']);
      if(!isset($page)||empty($page)){
        $page=1;
    }
    $cid=$GLOBALS['cid'];
    if(empty($cid)){
    $ress=$this->db->get_list('faq',"cid in (36,37,38,39,40,41,42,43,44,45,46,47,48,49,50,51,52,53,17154,55,56,57,58,59) and status=9",'id');
    $res=$this->db->get_list('faq',"cid in (36,37,38,39,40,41,42,43,44,45,46,47,48,49,50,51,52,53,17154,55,56,57,58,59) and status=9",'id,cid,title,remark,thumb',0,10,$page,'sort desc,addtime desc');
    }else{
    $ress=$this->db->get_list('faq',"cid='".$cid."' and status=9",'id');
    $res=$this->db->get_list('faq',"cid='".$cid."' and status=9",'id,title,remark,thumb',0,10,$page,'sort desc,addtime desc');
    }
    $c=count($ress);
    $page_max=ceil($c/10);
    foreach ($res as $key => $value) {
       //详情页地址
      if(WEBURL=='http://m.uzhuang.com/'){
          $res[$key]['url']="http://m.uzhuang.com/mobile-uzapp_article.html?uzid=".$value['id'];
      }else if(WEBURL=='http://mdev.uz.com/'){
          $res[$key]['url']="http://mdev.uz.com/mobile-uzapp_article.html?uzid=".$value['id'];
      }else if(WEBURL=='http://mtest.uz.com/'){
          $res[$key]['url']="http://mtest.uz.com/mobile-uzapp_article.html?uzid=".$value['id'];
      }else if(WEBURL=='http://mpre.uz.com/'){
          $res[$key]['url']="http://mpre.uz.com/mobile-uzapp_article.html?uzid=".$value['id'];
      }
      //详情页分享
      if(WEBURL=='http://m.uzhuang.com/'){
          $res[$key]['share']="http://m.uzhuang.com/mobile-uzapp_share.html?uzid=".$value['id'];
      }else if(WEBURL=='http://mdev.uz.com/'){
          $res[$key]['share']="http://mdev.uz.com/mobile-uzapp_share.html?uzid=".$value['id'];
      }else if(WEBURL=='http://mtest.uz.com/'){
          $res[$key]['share']="http://mtest.uz.com/mobile-uzapp_share.html?uzid=".$value['id'];
      }else if(WEBURL=='http://mpre.uz.com/'){
          $res[$key]['share']="http://mpre.uz.com/mobile-uzapp_share.html?uzid=".$value['id'];
      }

      if($value['thumb']){
        $res[$key]['thumb']="http://www.uzhuang.com/image/pic_230/".$value['thumb'];
      }
    } 
    $arr_finally=array(
        'arr'=>$res,
        'page_max'=>$page_max,
    );
    echo json_encode(array('code'=>1,'data'=>$arr_finally,'message'=>'操作成功','process_time'=>time())); exit;
  }
 
  //装修红宝书
  public function zx_red_book(){
    $result=$this->db->get_list('category',"pid =291",'cid,name',0,10,$page,'cid asc');
    //$result=$this->db->get_list('category',"pid =295",'cid,name',0,10,$page,'cid asc');
    foreach ($result as $key =>$value) {
      $res[$key]['cid']=$this->db->get_list('faq',"cid ='".$value['cid']."' and status=9",'id,title',0,10,$page,'sort desc,addtime desc');
      $res[$key]['name']=$value['name'];
    }
    foreach ($res as $keys => $values) {
      foreach ($values['cid'] as $kk => $vv) {
        //红宝书详情页地址
        if(WEBURL=='http://m.uzhuang.com/'){
          $res[$keys]['cid'][$kk]['url']="http://m.uzhuang.com/mobile-uzapp_red.html?redid=".$vv['id'];
        }else if(WEBURL=='http://mdev.uz.com/'){
          $res[$keys]['cid'][$kk]['url']="http://mdev.uz.com/mobile-uzapp_red.html?redid=".$vv['id'];
        }else if(WEBURL=='http://mtest.uz.com/'){
          $res[$keys]['cid'][$kk]['url']="http://mtest.uz.com/mobile-uzapp_red.html?redid=".$vv['id'];
        }else if(WEBURL=='http://mpre.uz.com/'){
          $res[$keys]['cid'][$kk]['url']="http://mpre.uz.com/mobile-uzapp_red.html?redid=".$vv['id'];
        }
      }
    }
    echo json_encode(array('code'=>1,'data'=>$res,'message'=>'操作成功','process_time'=>time())); exit;
  }
  //上一章 下一章
  public function chapter(){
    $id=$GLOBALS['id'];
    $arr=array();
    $arrs=array();
    $ids=array();
    $result=$this->db->get_list('category',"pid =291",'cid',0,10,$page,'sort asc');
    //$result=$this->db->get_list('category',"pid =295",'cid',0,10,$page,'sort asc');
    foreach ($result as $key => $value) {
      foreach ($value as $kk => $vv) {
        $arr[]=$vv;
      }
    }
    $aa=implode(',',$arr);
    $res=$this->db->get_list('faq',"cid in (".$aa.") and status=9",'id,cid,title,sort',0,1000,$page,'sort desc,addtime desc');
    set_cache('red_detail',$res,'zx_red_book');
    foreach ($res as $k => $v){
       $ids[]=$v['id'];
    }
    if(in_array($id,$ids)){
        $a=get_cache('red_detail','zx_red_book');
        //根据前台传回来的id 去缓存文件里找到对应的key
        foreach ($a as $ke => $val) {
          if($id==$val['id']){
            $arrs=$ke;
            $cid=$val['cid'];
            $title=$val['title'];
          }
         
        }
        $chapter['title']=$title;
        //上一章
        $ar=$a[$arrs-1];
        if(!empty($ar)){
          if($ar['cid']==$cid){
          //节
            $chapter['up_status']=1;
           }else{
            //章
            $chapter['up_status']=2;
          }
            if(WEBURL=='http://m.uzhuang.com/'){
              $chapter['up']="http://m.uzhuang.com/mobile-uzapp_red.html?redid=".$ar['id'];
            }else if(WEBURL=='http://mdev.uz.com/'){
              $chapter['up']="http://mdev.uz.com/mobile-uzapp_red.html?redid=".$ar['id'];
            }else if(WEBURL=='http://mtest.uz.com/'){
              $chapter['up']="http://mtest.uz.com/mobile-uzapp_red.html?redid=".$ar['id'];
            }else if(WEBURL=='http://mpre.uz.com/'){
              $chapter['up']="http://mpre.uz.com/mobile-uzapp_red.html?redid=".$ar['id'];
            }
        }else{
          $chapter['up']='';
          $chapter['up_status']='';
        }
        //下一章
        $ab=$a[$arrs+1];
        //echo "<pre>";print_r($ab['cid']);
        //echo "<pre>";print_r($cid);exit;
        if(!empty($ab)){
          if($ab['cid']==$cid){
            //节
            $chapter['down_status']=1;
          }else{
            //章
            $chapter['down_status']=2;
          }   
            if(WEBURL=='http://m.uzhuang.com/'){
              $chapter['down']="http://m.uzhuang.com/mobile-uzapp_red.html?redid=".$ab['id'];
            }else if(WEBURL=='http://mdev.uz.com/'){
              $chapter['down']="http://mdev.uz.com/mobile-uzapp_red.html?redid=".$ab['id'];
            }else if(WEBURL=='http://mtest.uz.com/'){
              $chapter['down']="http://mtest.uz.com/mobile-uzapp_red.html?redid=".$ab['id'];
            }else if(WEBURL=='http://mpre.uz.com/'){
              $chapter['down']="http://mpre.uz.com/mobile-uzapp_red.html?redid=".$ab['id'];
            }
        }else{
          $chapter['down']='';
          $chapter['down_status']='';
        } 
        //分享
            if(WEBURL=='http://m.uzhuang.com/'){
              $chapter['share']="http://m.uzhuang.com/mobile-uzapp_share.html?redid=".$id;
            }else if(WEBURL=='http://mdev.uz.com/'){
              $chapter['share']="http://mdev.uz.com/mobile-uzapp_share.html?redid=".$id;
            }else if(WEBURL=='http://mtest.uz.com/'){
              $chapter['share']="http://mtest.uz.com/mobile-uzapp_share.html?redid=".$id;
            }else if(WEBURL=='http://mpre.uz.com/'){
              $chapter['share']="http://mpre.uz.com/mobile-uzapp_share.html?redid=".$id;
            }
      echo json_encode(array('code'=>1,'data'=>$chapter,'message'=>'操作成功','process_time'=>time())); exit;
    }else{
      echo json_encode(array('code'=>0,'data'=>null,'message'=>'id不存在','process_time'=>time())); exit;
    }
  }
   
    //装修课堂详情页
    public function detail(){
      $id=$GLOBALS['id'];
      if($id){
        $res=$this->db->get_list('faq',"id='".$id."' and status=9",'id,title,remark,content,addtime');
        foreach ($res as $key => $value) {
          $res[$key]['addtime']=date('Y-m-d H:i',$value['addtime']);
          /*if(WEBURL=='http://m.uzhuang.com/'){
          $res[$key]['url']="http://m.uzhuang.com/mobile-app_article.html?aid=".$value['id'];
          }else if(WEBURL=='http://mtest.uz.com/'){
          $res[$key]['url']="http://mtest.uz.com/mobile-app_article.html?aid=".$value['id'];
          }*/
        }
        if(!empty($res)){
        echo json_encode(array('code'=>1,'data'=>$res,'message'=>'操作成功','process_time'=>time())); exit;
        }else{
        echo json_encode(array('code'=>0,'data'=>null,'message'=>'数据不存在','process_time'=>time())); exit;
        }
      }else{
        echo json_encode(array('code'=>0,'data'=>null,'message'=>'id不存在','process_time'=>time())); exit;
      }
    }
    //装修红宝书详情页
    public function red_detail(){
      $id=$GLOBALS['id'];
      $result=$this->db->get_list('category',"pid =291",'cid',0,10,$page,'sort asc');
      //$result=$this->db->get_list('category',"pid =295",'cid',0,10,$page,'sort asc');
      foreach ($result as $key => $value) {
        foreach ($value as $kk => $vv) {
          $arr[]=$vv;
        }
      }
      $aa=implode(',',$arr);
      if($id){
        $res=$this->db->get_list('faq',"id='".$id."' and status=9",'id,title,remark,content,addtime');
        foreach ($res as $key => $value) {
          $res[$key]['addtime']=date('Y-m-d H:i',$value['addtime']);
          /*if(WEBURL=='http://m.uzhuang.com/'){
          $res[$key]['url']="http://m.uzhuang.com/mobile-app_article.html?aid=".$value['id'];
          }else if(WEBURL=='http://mtest.uz.com/'){
          $res[$key]['url']="http://mtest.uz.com/mobile-app_article.html?aid=".$value['id'];
          }*/
        }
        if(!empty($res)){
        echo json_encode(array('code'=>1,'data'=>$res,'message'=>'操作成功','process_time'=>time())); exit;
        }else{
        echo json_encode(array('code'=>0,'data'=>null,'message'=>'数据不存在','process_time'=>time())); exit;
        }
      }else{
        echo json_encode(array('code'=>0,'data'=>null,'message'=>'id不存在','process_time'=>time())); exit;
      }
    }
      public function collection(){
       $id=$GLOBALS['id'];
       $uid=get_cookie('_uid');
       $ar=array();
        if($uid){
          $collectstatus=$this->db->get_list('favorite',"type=16",'keyid,collectstatus');
            foreach ($collectstatus as $key => $value) {
              $ar[]=$value['keyid'];
            }
            if(in_array($id,$ar)){
              $type=16;
              $collectstatus1=$this->db->get_one('favorite',"`keyid`=$id and `type`=$type and `uid`=$uid",'keyid,collectstatus');
            }
            if($collectstatus1['collectstatus']==null){
              $arr['collectstatus']='0';
            }else{
              $arr['collectstatus']=$collectstatus1['collectstatus'];
            }
        }else{
            $arr['collectstatus']='0';
        }
        echo json_encode(array('code'=>1,'data'=>$arr,'message'=>'成功','process_time'=>time())); exit;
    }







}