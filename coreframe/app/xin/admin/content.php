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
require_once(COREFRAME_ROOT.'app/core/libs/class/phpqrcode.php');
/**
 * 内容添加
 */
// 
load_class('admin');
define('HTML',true);
class content extends WUZHI_admin {
  public function listing(){
        $time = filemtime($this->template('content_listing'));
        $page = isset($GLOBALS['page']) ? intval($GLOBALS['page']) : 1;
        $db = load_class('db');
        $pagess=$page ;
        $keytypes = isset($GLOBALS['title']) ? $GLOBALS['title'] : '';
        $page = max($page,1);
        if(!empty($keytypes)){
           $where="and activityname like '%$keytypes%'";
        }
        $result = $db->get_list('m_activity'," status !=4 ".$where,'*',0,10,$page,'uptime desc');
        $dir='uploadfile/wei';
        if(!is_dir($dir)){
           mkdir($dir);
        }
        foreach($result as $wei){
           $weid=$wei['id'];
              $str=R;$newstr = substr($str,0,strlen($str)-5);
              $urls=$newstr.'/mobile-template_new.html?hid='.$wei['id'];
              $data = $urls; 
              $filename ='uploadfile/wei/'.$wei['id'].'.png';
              $errorCorrectionLevel = 'L';  
              $matrixPointSize = 6;  
              QRcode::png($data, $filename, $errorCorrectionLevel, $matrixPointSize, 2); 
        }
        $pages = $db->pages;
        $total = $db->number;
        include $this->template('content_listing');
  }
  public function adds(){
  	 include $this->template('content_adds');
  }
  public function doDownload(){
    $filename=$GLOBALS['filename'];
    header('content-disposition:attachment;filename='.basename($filename));
    header('content-length:'.filesize($filename));
    readfile($filename);
  }//文件下载
  public function implode($data){
      $arr = array();
      foreach($data as $ar){
        $arr[]= basename($ar['url']);
      }
      $data=implode("|",$arr);
      return $data;
  }//数组处理问题
  public function forc($data=array(),$urlsx,$bian,$type,$caset,$sort){
      if(!empty($data)){
           foreach ($data as $ckey => $cvalue) {
               $arrs[]['img']=$cvalue[url][0];
          }
          foreach ($arrs  as $key => $value) {
               $arrs[$key]['url'] = $urlsx[$key];
               $arrs[$key]['bian'] = $bian[$key];
               $arrs[$key]['type'] = $type[$key];
               $arrs[$key]['caset'] = $caset[$key];
               $arrs[$key]['sort'] = $sort;
          }
       }
      return $arrs;
  }
  public function forcadd($casemimg,$casemurl,$casemtype,$casembian,$caset,$sort){
            $arr = array();
            if(!empty($casemimg)){
              foreach ($casemimg as $key =>$value) {
                 $arr[]['img']=$value[url][0];
              }
              foreach ($arr as $k => $v) {
                 $arr[$k]['url'] = $casemurl[$k];
                 $arr[$k]['type'] = $casemtype[$k];
                 $arr[$k]['bian'] = $casembian[$k];
                 $arr[$k]['caset'] = $caset[$k];
                 $arr[$k]['sort'] = $sort;
               } 
          }
        return $arr;
  }
  public function appI($apply,$activity){
     $db = load_class('db');
     $data = array(
        'sort' => $apply,
        'ex_id' => $activity,
        'type' =>'apply'
      );
     $db->insert('m_activity_lst',$data);
  }
  public function add(){
        $db = load_class('db');
        $casem=$GLOBALS['casem'];
        $car=$GLOBALS['car'];
        $vim=$GLOBALS['vim'];
        $apply=$GLOBALS['apply'];
        $data=array();
        $data['ifh5'] = $GLOBALS['ifh5'];
        $data['iftitle']=$GLOBALS['headline'];
        $data['activityname'] = $GLOBALS['activityname'];//列表名称
        $data['activitytitle'] = $GLOBALS['activitytitle'];//活动模板标题
        $data['iftop'] = $GLOBALS['iftop'];//公共顶
        $data['applybox'] = $GLOBALS['applybox'];//报名框显示1/隐藏2
        $data['are'] = $GLOBALS['area'];//区域选择
        if($GLOBALS['submit']=='发布'){
            $data['status'] = 1;//状态
        }else if($GLOBALS['submit']=='保存'){
            $data['status'] = 3;//状态
        }
        $data['addtime'] = time();
        $data['uptime'] = time();
        $data['background'] = $GLOBALS['background'];//报名框背景a
        $data['tosignup'] = $GLOBALS['Tosignup'];//报名人数基数
        if(empty($GLOBALS['submitcopy'])){
           $data['submitcopy'] = '立即报名';
        }else{
          $data['submitcopy'] = $GLOBALS['submitcopy'];//提交按钮文案
        }
        $data['buttoncolor'] = $GLOBALS['buttoncolor'];//提交按钮背景颜色
        $data['buttoncopycolor'] = $GLOBALS['buttoncopycolor'];//提交按钮文案颜色
        $data['numbercolor'] = $GLOBALS['numbercolor'];//报名人数颜色
        $data['cuewords'] = $GLOBALS['cuewords'];//报名人数提示语颜色
        $data['floor'] = $GLOBALS['floor'];//是否显示公共底
        $data['navigation'] = $GLOBALS['navigation'];//是否显示底部导航
        $data['share'] = $GLOBALS['share'];//分享图标
        $data['sharename'] = $GLOBALS['sharename'];//分享标题
        $data['content'] = $GLOBALS['content'];//分享描述
        $data['consult'] = $GLOBALS['consult'];
        $activity=$db->insert('m_activity',$data);
        /*曹植修改   新增发标组件begin*/
        $applyNum = $GLOBALS['applyNum'];
        for($i=0;$i<=$applyNum;$i++){
          $appInfo = array();
          if ($i==0) {
            $j = '';
          }else{
            $j = $i;
          }
          if($GLOBALS['area'.$j]){
            // $appInfo['sort'] = $GLOBALS['apply'.$j];
            $appInfo['area'] = $GLOBALS['area'.$j];
            $appInfo['background'] = $GLOBALS['background'.$j];
            $appInfo['tosignup'] = $GLOBALS['Tosignup'.$j];
            $appInfo['submitcopy'] = $GLOBALS['submitcopy'.$j];
            $appInfo['buttoncolor'] = $GLOBALS['buttoncolor'.$j];
            $appInfo['buttoncopycolor'] = $GLOBALS['buttoncopycolor'.$j];
            $appInfo['numbercolor'] = $GLOBALS['numbercolor'.$j];
            $appInfo['cuewords'] = $GLOBALS['cuewords'.$j];
            $appInfo['ex_id'] = $db->insert('m_activity_lst',array('type'=>'apply','caset'=>'apply'.$j,'sort'=>$GLOBALS['apply'.$j],'ex_id'=>$activity));
            $db->insert('m_activity_apply',$appInfo);
          }
        }
        /*曹植修改   新增发标组件end*/
        $case=$this->forc($GLOBALS['form']['case'],$GLOBALS['caseurl'],$GLOBALS['casebian'],$GLOBALS['casetype'],$GLOBALS['casemodule'],$GLOBALS['static']);
        $carrousel=$this->forc($GLOBALS['form']['carrousel'],$GLOBALS['carrouselurl'],$GLOBALS['carrouselbian'],$GLOBALS['carrouseltype'],$GLOBALS['carrouselmodule'],$GLOBALS['picture']);
        if(!empty($case)){
          foreach ($case as $skey => $svalue) {
            $case[$skey]['ex_id'] = $activity;
          }
          foreach ($case as $keys => $values) {
            $db->insert('m_activity_lst',$values);
          }//图片
       }
        for ($x=1; $x<=$casem; $x++) {
            $casemimg=$GLOBALS['casem'.$x];
            $casemurl=$GLOBALS['casem'.$x.'urlsx'];
            $casemtype=$GLOBALS['casem'.$x.'type1'];
            $casembian=$GLOBALS['casem'.$x.'bian'];
            $caset=$GLOBALS['casem'.$x.'case'];
            $static=$GLOBALS['static'.$x];
            $staticadd=$this->forcadd($casemimg,$casemurl,$casemtype,$casembian,$caset,$static);
            foreach ($staticadd as $akey => $avalue) {
              if(empty($avalue[caset])){
                unset($staticadd[$akey]);
              }
               $staticadd[$akey]['ex_id']=$activity;
            }
            foreach ($staticadd as $keya => $valuea) {
              if(!empty($valuea)){
                $db->insert('m_activity_lst',$valuea);
              }
            }
        }//图片增加
        if(!empty($carrousel)){
          foreach ($carrousel as $ske => $svalu) {
            $carrousel[$ske]['ex_id'] = $activity;
          }
          foreach ($carrousel as $kes => $valus) {
            $db->insert('m_activity_lst',$valus);
          }//图片
        }
    
        for ($c=1; $c<=$car; $c++) {
          $car=$GLOBALS['carrousel'.$c];
          $carurlsx=$GLOBALS['carrousel'.$c.'urlsx'];
          $carbian=$GLOBALS['carrousel'.$c.'bian'];
          $cartype=$GLOBALS['carrousel'.$c.'type1'];
          $carcase=$GLOBALS['carrousel'.$c.'case'];
          $carsort=$GLOBALS['car'.$c];
          $caradd=$this->forcadd($car,$carurlsx,$cartype,$carbian,$carcase,$carsort);
          foreach ($caradd as $ckey => $cvalue) {
              if(empty($cvalue[caset])){
                unset($caradd[$ckey]);
              }
               $caradd[$ckey]['ex_id']=$activity;
            }
           foreach ($caradd as $keyc => $valuec) {
              if(!empty($valuec)){
                $db->insert('m_activity_lst',$valuec);
              }
            }
        }//轮播增加
        $vimdata=array(
             'img'=>$GLOBALS[form][vim][url],
             'url'=>$GLOBALS[vimurl],
             'type'=>$GLOBALS[vimtype],
             'caset'=>$GLOBALS[vimmodule],
             'ad'=>$GLOBALS[advertising],
             'sort'=>$GLOBALS[video],
             'ex_id'=>$activity,
          );
        if(!empty($vimdata['img'])){
           $db->insert('m_activity_lst',$vimdata);
        }//视频

        if(!empty($vim)){
            for ($i=1; $i <= $vim ; $i++) { 
                   $vimdatas=array(
                   'img'=>$GLOBALS['form']['vim'.$i]['url'],
                   'url'=>$GLOBALS['vim'.$i.'url'],
                   'type'=>$GLOBALS['vim'.$i.'type'],
                   'caset'=>$GLOBALS['vim'.$i.'module'],
                   'ad'=>$GLOBALS['advertising'.$i],
                   'sort'=>$GLOBALS['vim'.$i],
                   'ex_id'=>$activity,
                 );
                 if(!empty($vimdatas[img])){
                     $db->insert('m_activity_lst',$vimdatas);   
                 }
            }
        }//视频增加
        // $this->appI($apply,$activity);//曹植注释
        MSG(L('添加成功！！'),'?m=xin&f=content&v=listing&_su=wuzhicms');
  }//添加
  public function de_weight($data){
        $caset=array();
        foreach ($data as $key => $value) {
           $caset[] = $value['caset'];
        }
        $caset=array_unique($caset); 
        return $caset;
  }//计算组件个数
  public function de_weight_data($caset,$data){
    $arr=array();
     foreach ($caset as $key => $value) {
           foreach ($data as $k => $v) {
              if($value==$v['caset']){
                 $arr[$value][$k]=$v;
              }
           }
        }
      return $arr;
  }//处理组件数据
  public function edit(){
      	$db=load_class('db');
        $New = $db->get_one('m_activity',"id=$GLOBALS[id]");
        $Newdata = $db->get_list('m_activity_lst',"ex_id=$New[id]");//组件数据
        $sort = $db->get_list('m_activity_lst',"ex_id=$New[id]",'sort,caset,type,id,ad',0,200,0,'','caset');//组件排序编号
        $NewdataL = $db->get_list('m_activity_lst',"ex_id=$New[id] and caset like '%casem%'");//增加图片组件数据
        $Newdatac = $db->get_list('m_activity_lst',"ex_id=$New[id] and caset like '%carrousel%' and caset !='carrousel' ");//增加轮播组件数据
        $Newdatav = $db->get_list('m_activity_lst',"ex_id=$New[id] and caset like '%vim%' and caset !='vim' ");//增加视频组件数据
        $caset=$this->de_weight($NewdataL);//计算图片有多少组件
        $arr=$this->de_weight_data($caset,$NewdataL);//处理图片组件数据
        $casec=$this->de_weight($Newdatac);//计算轮播有多少组件
        $arrc=$this->de_weight_data($casec,$Newdatac);//处理轮播组件数据
        $casev=$this->de_weight($Newdatav);//计算视频有多少组件
        $arrv=$this->de_weight_data($casev,$Newdatav);//处理视频组件数据
        /*曹植添加开始*/
        $applys = $db->get_list('m_activity_lst','ex_id='.$New['id'].' and type="apply"','id,caset,sort');
        $applyIds = '';
        foreach ($applys as $key => $value) {
          $applyIds .= ','.$value['id'];
        }
        if(strpos($applys[0]['caset'],'apply')!==false){
          $maxApplyCount = (int)substr($applys[count($applys)-1]['caset'],5);
        }
        $applyIds = trim($applyIds,',');
        if($applyIds)$appRes = $db->get_list('m_activity_apply','ex_id in ('.$applyIds.')');
        foreach ($appRes as $key => $value) {
          foreach ($applys as $k => $v) {
            if($value['ex_id']==$v['id'])$appRes[$key]['sort'] = $v['sort'];
          }
        }
        /*曹植添加结束*/
        include $this->template('new_edit');
  }//编辑页数据展示
  public function editdata(){
    $id=$GLOBALS['hid'];
    $listid=$GLOBALS['listid'];
    $listurl=$GLOBALS['listbian'];
    $db = load_class('db');
    if(!empty($GLOBALS['form']['case'])){
        $case=$this->forc($GLOBALS['form']['case'],$GLOBALS['caseurl'],$GLOBALS['casebian'],$GLOBALS['casetype'],$GLOBALS['casemodule'],$GLOBALS['static']);
    }
    if(!empty($GLOBALS['form']['carrousel'])){
       $carrousel=$this->forc($GLOBALS['form']['carrousel'],$GLOBALS['carrouselurl'],$GLOBALS['carrouselbian'],$GLOBALS['carrouseltype'],$GLOBALS['carrouselmodule'],$GLOBALS['picture']);
    }
    if(empty($carrousel)){
          $static=$case;
      }else if(empty($case)){
          $static = $carrousel;
      }else if(!empty($case) && !empty($carrousel)){
          $static=array_merge($case,$carrousel);
    }  
    if(!empty($static)){
        foreach ($static as $skey => $svalue) {
          $static[$skey]['ex_id'] = $id;
        }   
        foreach ($static as $keys => $values) {
          $db->insert('m_activity_lst',$values);
        }//图片+轮播
    }
    $vimdata=array(
         'img'=>$GLOBALS[form][vim][url],
         'url'=>$GLOBALS[vimurl],
         'type'=>$GLOBALS[vimtype],
         'caset'=>$GLOBALS[vimmodule],
         'ad'=>$GLOBALS[advertising],
         'sort'=>$GLOBALS[video],
         'ex_id'=>$id,
    );
    if(!empty($vimdata['img'])){
       $db->insert('m_activity_lst',$vimdata);
    }//视频
    $data=$this->uns($GLOBALS);
    $sumAssembly=$this->sumAssembly($id);
    $casem=$GLOBALS[casem];
    $cars=$GLOBALS[cars];
    $vims=$GLOBALS[vims];
    for ($i=$sumAssembly['casem']+1; $i <=$casem ; $i++) { 
        $casemimg=$GLOBALS['casem'.$i];
        $casemurl=$GLOBALS['casem'.$i.'urlsx'];
        $casemtype=$GLOBALS['casem'.$i.'type1'];
        $casembian=$GLOBALS['casem'.$i.'bian'];
        $caset=$GLOBALS['casem'.$i.'case'];
        $static=$GLOBALS['static'.$i];
        $staticadd=$this->forcadd($casemimg,$casemurl,$casemtype,$casembian,$caset,$static);
        foreach ($staticadd as $akey => $avalue) {
            $staticadd[$akey]['ex_id'] =$id;
        }
        foreach ($staticadd as $keya => $valuea) {
          if(!empty($valuea)){
            $db->insert('m_activity_lst',$valuea);
          }
        }
    }//添加新增图片组件
    for ($c=$sumAssembly['carrousel']+1; $c<=$cars; $c++) {
        $car=$GLOBALS['carrousel'.$c];
        $carurlsx=$GLOBALS['carrousel'.$c.'urlsx'];
        $carbian=$GLOBALS['carrousel'.$c.'bian'];
        $cartype=$GLOBALS['carrousel'.$c.'type1'];
        $carcase=$GLOBALS['carrousel'.$c.'case'];
        $carsort=$GLOBALS['car'.$c];
        $caradd=$this->forcadd($car,$carurlsx,$cartype,$carbian,$carcase,$carsort);
        foreach ($caradd as $ckey => $cvalue) {
             $caradd[$ckey]['ex_id']=$id;
          }

         foreach ($caradd as $keyc => $valuec) {
            if(!empty($valuec)){
              $db->insert('m_activity_lst',$valuec);
            }
          }
    }//添加新增轮播组件
    for ($v=$sumAssembly['vim']+1; $v <= $vims ; $v++) { 
       $vimdatas=array(
           'img'=>$GLOBALS['form']['vim'.$v]['url'],
           'url'=>$GLOBALS['vim'.$v.'url'],
           'type'=>$GLOBALS['vim'.$v.'type'],
           'caset'=>$GLOBALS['vim'.$v.'module'],
           'ad'=>$GLOBALS['advertising'.$v],
           'sort'=>$GLOBALS['vim'.$v],
           'ex_id'=>$id,
        );
       if(!empty($vimdatas[img])){
           $db->insert('m_activity_lst',$vimdatas);   
       }
    }//添加新增视频组件
    $moduleadd=$this->moduleadd($GLOBALS['module'],$id);
    $this->updatedata($data,$id);
    $moduleup=$this->upmodule($data,$id);
    $lst= array('listurl'=>'url','lisbian'=>'bian','listid'=>'id');
    $this->lstedit($lst,$data);
     /*曹植修改开始*/
    $ex_ids = $db->get_list('m_activity_lst','ex_id='.$id.' and type="apply"','id');
    $ids = '';
    foreach ($ex_ids as $key => $value) {
      $ids .= ','.$value['id'];
    }
    $ids = trim($ids,',');
    $db->delete('m_activity_lst','ex_id='.$id.' and type="apply"');
    if($ids)$db->delete('m_activity_apply','ex_id in ('.$ids.')');
    $applyNum = $GLOBALS['applyNum'];
    for($i=0;$i<=$applyNum;$i++){
      $appInfo = array();
      if ($i==0) {
        $j = '';
      }else{
        $j = $i;
      }
      if($GLOBALS['area'.$j]){
        $appInfo['area'] = $GLOBALS['area'.$j];
        $appInfo['background'] = $GLOBALS['background'.$j];
        $appInfo['tosignup'] = $GLOBALS['Tosignup'.$j];
        $appInfo['submitcopy'] = $GLOBALS['submitcopy'.$j];
        $appInfo['buttoncolor'] = $GLOBALS['buttoncolor'.$j];
        $appInfo['buttoncopycolor'] = $GLOBALS['buttoncopycolor'.$j];
        $appInfo['numbercolor'] = $GLOBALS['numbercolor'.$j];
        $appInfo['cuewords'] = $GLOBALS['cuewords'.$j];
        $appSort = $GLOBALS['apply'.$j];
        $appInfo['ex_id'] = $db->insert('m_activity_lst',array('type'=>'apply','caset'=>'apply'.$j,'sort'=>$appSort,'ex_id'=>$id));
        $db->insert('m_activity_apply',$appInfo);
      }
    }
    /*曹植修改结束*/
    MSG(L('修改成功！！'),'?m=xin&f=content&v=listing&_su=wuzhicms');
  }//修改
  public function updatedata($data,$id){
    $db = load_class('db');
    $arr=array();
    $arr['activityname']=$data['activityname'];
    $arr['iftitle']=$data['headline'];
    $arr['activitytitle']=$data['activitytitle'];
    $arr['iftop']=$data['iftop'];
    $arr['applybox']=$data['applybox'];
    $arr['are']=$data['are'];
    $arr['background']=$data['background'];
    $arr['tosignup']=$data['Tosignup'];
    $arr['submitcopy']=$data['submitcopy'];
    $arr['buttoncolor']=$data['buttoncolor'];
    $arr['buttoncopycolor']=$data['buttoncopycolor'];
    $arr['numbercolor']=$data['numbercolor'];
    $arr['cuewords']=$data['cuewords'];
    $arr['floor']=$data['floor'];
    $arr['navigation']=$data['navigation'];
    $arr['consult']=$data['consult'];
    $arr['share']=$data['share'];
    $arr['sharename']=$data['sharename'];
    $arr['content']=$data['content'];
    $arr['uptime']=time();
    $db->update('m_activity',$arr,'id='.$id);
  }//修改信息
  public function upmodule($data,$id){
     $db = load_class('db');
     $arr=array('case'=>'static','carrousel'=>'picture','vim'=>'video','apply'=>'apply');
     foreach ($arr as $key => $value) {
       if(!empty($data[$value])){
         $db->update('m_activity_lst',"sort=$data[$value]","caset='$key' and ex_id=$id");
       }
       if($key=='apply'){
        if(!empty($data[$value])){
          $db->update('m_activity_lst',"sort=$data[$value]","type='$key' and ex_id=$id");
        }
       }
     }
  }//修改组件编号
  public function lstedit($lst,$data){
    $db = load_class('db');
    $arr=array();
    foreach ($lst as $key => $value) {
         $arr[$value]=$data[$key];
    }
    $arrs=array();
    foreach ($arr as $k => $v) {
      if(!empty($v)){
       foreach ($v as $vk => $ve) {
          $arrs[$vk][$k]=$ve;
       }
      }
    }
    $lstdata=array();
    foreach ($arrs as $ka => $va) {
       $lstdata['url']=$va['url'];
       $lstdata['bian']=$va['bian'];
       $db->update('m_activity_lst',$lstdata,array('id'=>$va[id]));
    }
  }//修改列表页信息
  public function sumAssembly($id){
      $db = load_class('db');
      $arr=array('casem','carrousel','vim');
      $arrs=array();
      foreach ($arr as $key => $value) {
       $data=$db->get_list('m_activity_lst',"ex_id=$id and caset like '%$value%' and caset !='$value'",'caset',0,200,0,'','caset');
         $arrs[$value]=count($data);
      }
      return $arrs;
  }//编辑时计算当时多多少组件
  public function moduleadd($data=array(),$id){
    $db = load_class('db');
    $arr=array();
    if(!empty($data)){
      foreach ($data as $k => $v) {
         foreach ($v as $key => $value) {
            $arr[$key][$k]=$value;
            $arr[$key]['ex_id']=$id;
         }
      }
      $sortv=$GLOBALS['vim1'];
      foreach ($arr as $s => $sv) {
        $sort=$db->get_one('m_activity_lst',"ex_id = $id and caset='$sv[caset]'",'sort');
        $arr[$s]['sort']=$sort['sort'];
        if(empty($sort['sort'])){
           $arr[$s]['sort']=$sortv;
        }
      }
      foreach ($arr as $a => $y) {
         $db->insert('m_activity_lst',$y);
      }
    }
  }//编辑时组件新增元素
  public function delete(){
         $db = load_class('db');
         $Id = isset($GLOBALS['id']) ? intval($GLOBALS['id']) : 1;
         $formdata = array();
         $formdata['status'] = 4;
         $db->update('m_activity',$formdata,array('id'=>$Id)); 
         MSG(L('删除成功！！'),HTTP_REFERER);
  }//删除
  public function Putaway(){
         $db = load_class('db');
         $Id = isset($GLOBALS['id']) ? intval($GLOBALS['id']) : 1;
         $formdata = array();
             $formdata['status'] = 1;
             $formdata['uptime'] =time();
         $db->update('m_activity',$formdata,array('id'=>$Id)); 
         MSG(L('上线成功！！'),HTTP_REFERER);
  }//上线
  public function UnShelve(){
      $db = load_class('db');
         $Id = isset($GLOBALS['id']) ? intval($GLOBALS['id']) : 1;
         $formdata = array();
             $formdata['status'] = 2;
             $formdata['uptime'] =time() ;
         $db->update('m_activity',$formdata,array('id'=>$Id)); 
         MSG(L('下线成功！！'),HTTP_REFERER);
  }//下线
  public function Publish(){
      $db = load_class('db');
      $Id = isset($GLOBALS['id']) ? intval($GLOBALS['id']) : 1;
           $formdata = array();
           $formdata['status'] = 1;
           $formdata['uptime'] =time() ;
       $db->update('m_activity',$formdata,array('id'=>$Id)); 
       MSG(L('发布成功！！'),HTTP_REFERER);
  }//发布
  public function Deletes(){
      $db = load_class('db');
      foreach($GLOBALS['ids'] as $id){
           $formdata = array();
           $formdata['status'] = 4;
       $db->update('m_activity',$formdata,array('id'=>$id)); 
      }
       MSG(L('删除成功！！'),HTTP_REFERER);
  }//批量删除
  public function delid(){
      $db = load_class('db');
      $id = $GLOBALS['id'];
      $del=$db->delete('m_activity_lst',array('id'=>$id));
      if($del){
        die(json_encode($del));
      }
  }//删除图片
  public function uns($data){
     $arr=array(
        '_startTime',
        'm',
        'f',
        'v',
        '_su',
        '_menuid',
        'submit',
        'page',
        'qr_time_bench',
        '_CLASS_NAME_',
        );
     foreach ($arr as $key => $value) {
       unset($data[$value]);
     }
      return $data;
  }//处理$GLOBAL传来的数据
  public function delids(){
      $db = load_class('db');
      $id = $GLOBALS['id'];
      $del=$db->delete('m_activity_lst',array('caset'=>$id));
      if($del){
        die(json_encode($del));
      }
  }//删除组件
  public function Modulesbian(){
         $db = load_class('db');
         $Id = $GLOBALS['id']; 
         $bian = $GLOBALS['bian']; 
         $y = $db->update('m_activity_lst','sort='.$bian,array('id'=>$Id)); 
         if($y){
           die(json_encode($y)); 
         }
  }
  /*曹植修改删除发标组件开始*/
  public function deleteApply(){
         $db = load_class('db');
         $id = $GLOBALS['id'];
         $del=$db->delete('m_activity_lst',array('id'=>$id));
         $del=$db->delete('m_activity_apply',array('ex_id'=>$id));
         die(json_encode($del));
  }
  /*曹植修改删除发标组件结束*/
  public function public_threeLevel(){
    $db=load_class('db');
    $pid = isset($GLOBALS['pid'])?intval($GLOBALS['pid']):0;
    $result = $db->get_list('linkage_data', array('pid'=>$pid), 'lid,name');
    die(json_encode($result));
  }
  public function checkNameExits(){
        $db = load_class('db');
        $name = $GLOBALS['title'];
        $id = $GLOBALS['id'];
        $res = $db->get_one('m_activity',"activityname='".$name."'and id !='".$id."' and status !=4" ,'id');
        die(json_encode($res['id']));
  }//校验名称是否重复
  public function ae(){
    include $this->template('shiyan');
  }
  public function ug(){
      $db = load_class('db');
      $id = $GLOBALS['id'];
      $g=$GLOBALS['g'];
      if($g==0){
        $gg=1;
      }
      if($g==1){
        $gg=0;
      }
      die(json_encode($db->update('m_activity_lst','ad='.$gg,array('id'=>$id))));
  }
}