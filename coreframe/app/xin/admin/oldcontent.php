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
load_class('admin');
define('HTML',true);
class oldcontent extends WUZHI_admin {
  public function listing(){
    
        $page = isset($GLOBALS['page']) ? intval($GLOBALS['page']) : 1;
        $db = load_class('db');
        $pagess=$page ;
        $keytypes = isset($GLOBALS['title']) ? $GLOBALS['title'] : '';
        $page = max($page,1);
        if($keytypes==NUll){
          $result = $db->get_list('m_exercise'," status !=3 and status !=5 ",'*',0,10,$page,'updatetime desc');
        }else{
          $result = $db->get_list('m_exercise',"title like '%".$keytypes."%' and status != 3 and status !=5",'*',0,10,$page,'updatetime desc');
        }
        $dir='uploadfile/wei';
        if(!is_dir($dir)){
           mkdir($dir);
        }
        foreach($result as $wei){
           $weid=$wei['id'];
              $str=R;$newstr = substr($str,0,strlen($str)-5);
              $urls=$newstr.'/mobile-template.html?temp='.$wei['id'];
              $data = $urls; 
              $filename ='uploadfile/wei/'.$wei['id'].'.png';
              $errorCorrectionLevel = 'L';  
              $matrixPointSize = 6;  
              QRcode::png($data, $filename, $errorCorrectionLevel, $matrixPointSize, 2); 
        }
        $pages = $db->pages;
        $total = $db->number;
     include $this->template('oldcontent_listing');
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
          $arr[]= $ar;
      }
      $data=implode("|",$arr);
      return $data;
  }//数组处理问题
  public function implodes($data){
      $arr = array();
      foreach($data as $ar){
        $arr[]= basename($ar['url']);
      }
      $data=implode("|",$arr);
      return $data;
  }//数组处理问题
  public function edit(){
      	$db=load_class('db');
        $content=$db->get_one('m_exercise','status!=3 and status !=5 and id="'.$GLOBALS['id'].'"','*',0,10,$page,'updatetime desc','');
        if($GLOBALS['submit']=="发布"){
		      if(!empty($GLOBALS['url'])){
              $cae=implode("|",$GLOBALS['url']);
          }
          if(!empty($GLOBALS['urlt'])){
              $caet=implode("|",$GLOBALS['urlt']);
          }
          $cases=$GLOBALS['form']['case'];
          if(!empty($cases)){
              $case=$this->implode($cases);
              if(!empty($cae)){
                 $cae.='|'.$case;
              }else{
                 $cae=$case;
              }
          } 

          $casexs=$GLOBALS['form']['casex'];
          if(!empty($casexs)){
              $casex=$this->implodes($casexs);
              if(!empty($caet)){
                $caet.='|'.$casex;
              }else{
                $caet=$casex;
              }
          } 
          if(!empty($GLOBALS['bian'])){
            $bian=implode("|",$GLOBALS['bian']);
          }
          if(!empty($GLOBALS['bians'])){
            $bians=implode("|",$GLOBALS['bians']);
          }   
   
          if(!empty($GLOBALS['urlsx'])){
            $urlsx=implode("|",$GLOBALS['urlsx']);
          }
          if(!empty($GLOBALS['urlsh'])){
            $urlsh=implode("|",$GLOBALS['urlsh']);
          }//视频
          $shipins=$GLOBALS['form']['cases'];
           if(!empty($GLOBALS['shipin'])){
              $ship=implode("|",$GLOBALS['shipin']);
          }
          if(!empty($shipins)){
              $shipin=$this->implode($shipins);
              if(!empty($ship)){
                  $ship.='|'.$shipin;
              }else{
                  $ship=$shipin;
              }
          } 
          if(!empty($GLOBALS['urlp'])){
            $urlp=implode("|",$GLOBALS['urlp']);
          }
          if(!empty($GLOBALS['bianp'])){
            $bianp=implode("|",$GLOBALS['bianp']);
          }
          if(!empty($GLOBALS['type1'])){
            $type1=implode("|",$GLOBALS['type1']);
          }
          if(!empty($GLOBALS['type2'])){
            $type2=implode("|",$GLOBALS['type2']);
          }
          if(!empty($GLOBALS['type3'])){
            $type3=implode("|",$GLOBALS['type3']);
          }
     
          //视频
     	    $formdata = array();
              $formdata['shipin']=$ship;
              $formdata['type1']=$type1;
              $formdata['type2']=$type2;
              $formdata['type3']=$type3;
              $formdata['shipin']=$ship;
              $formdata['shipinurl']=$urlp;
              $formdata['shipinbian']=$bianp;
              $formdata['name'] =$GLOBALS['name'];
              $formdata['title']=$GLOBALS['exercise'];          
              $formdata['headpiece']=$cae;
              $formdata['status_2']=$GLOBALS['sx'];
              $formdata['background']=basename($GLOBALS['attachment_test']);
              $formdata['share']=basename($GLOBALS['share']);
              $formdata['troops']=$caet;
              $formdata['city']=$GLOBALS['city'];
              $formdata['status']=1;
              $formdata['status_1']=$GLOBALS['status_1'];
              $formdata['status_3']=$GLOBALS['status_3'];
              $formdata['status_4']=$GLOBALS['status_4'];
              $formdata['color']=$GLOBALS['color'];
              $formdata['color1']=$GLOBALS['color1'];
              $formdata['color2']=$GLOBALS['color2'];
              $formdata['color3']=$GLOBALS['color3'];
              $formdata['bian']=$bian;
              $formdata['bians']=$bians;
              $formdata['headpieceurl']=$urlsx;
              $formdata['troopsurl']=$urlsh;
              $formdata['updatetime']=date('Y-m-d H:i:s');
              $formdata['addtime']=date('Y-m-d H:i:s');
              $formdata['button']=$GLOBALS['button'];
              $formdata['person']=$GLOBALS['person'];
              $formdata['sharename']=$GLOBALS['sharename'];
              $formdata['sharedescribe']=$GLOBALS['sharedescribe'];
              $formdata['advertising']=$GLOBALS['advertising'];
              $formdata['status_5']=$GLOBALS['isno'];
           
              $db->update('m_exercise',$formdata,array('id'=>$GLOBALS['id'])); 

            MSG(L('编辑成功！！'),'?m=xin&f=oldcontent&v=listing&_su=wuzhicms');
        }
        include $this->template('content_edit');
  }
  public function delete(){
     $db = load_class('db');
     $Id = isset($GLOBALS['id']) ? intval($GLOBALS['id']) : 1;
     $formdata = array();
         $formdata['status'] = 3;
     $db->update('m_exercise',$formdata,array('id'=>$Id)); 
     MSG(L('删除成功！！'),'?m=xin&f=oldcontent&v=listing&_su=wuzhicms');
  }
  public function Putaway(){
      	 $db = load_class('db');
         $Id = isset($GLOBALS['id']) ? intval($GLOBALS['id']) : 1;
         $formdata = array();
             $formdata['status'] = 1;
             $formdata['updatetime'] =date('Y-m-d H:i:s') ;
         $db->update('m_exercise',$formdata,array('id'=>$Id)); 
         MSG(L('上线成功！！'),'?m=xin&f=oldcontent&v=listing&_su=wuzhicms');
  }//上线
  public function UnShelve(){
	   $db = load_class('db');
     $Id = isset($GLOBALS['id']) ? intval($GLOBALS['id']) : 1;
     $formdata = array();
         $formdata['status'] = 2;
         $formdata['updatetime'] =date('Y-m-d H:i:s') ;
     $db->update('m_exercise',$formdata,array('id'=>$Id)); 
     MSG(L('下线成功！！'),'?m=xin&f=oldcontent&v=listing&_su=wuzhicms');
  }
  public function Deletes(){
     	$db = load_class('db');
	    foreach($GLOBALS['ids'] as $id){
	         $formdata = array();
	         $formdata['status'] = 3;
	     $db->update('m_exercise',$formdata,array('id'=>$id)); 
	    }
       MSG(L('删除成功！！'),'?m=xin&f=oldcontent&v=listing&_su=wuzhicms');
  }
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
      $res = $db->get_one('m_exercise',"title='".$name."'and status in(1,2) and id !='".$id."'" ,'id');
      die(json_encode($res['id']));
  }
  public function ae(){
    include $this->template('shiyan');
  }
}