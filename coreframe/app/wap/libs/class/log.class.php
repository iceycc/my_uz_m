<?php
// +----------------------------------------------------------------------
// | wuzhicms [ 五指互联网站内容管理系统 ]
// | Copyright (c) 2014-2015 http://www.wuzhicms.com All rights reserved.
// | Licensed ( http://www.wuzhicms.com/licenses/ )
// | Author: wangcanjia <phpip@qq.com>
// +----------------------------------------------------------------------
header("content-type:text/html;charset=utf-8");
defined('IN_WZ') or exit('No direct script access allowed');
	/**
	 * 首页
	 */
load_class('foreground', 'member');
class WUZHI_log extends WUZHI_foreground {
    function __construct() {
	   parent::__construct();
	}
  
    public function day_log(){
        //类似节点
        $day_log1 = get_config('log_config');
        $nodeidss=$day_log1[$nodeids];
        foreach($day_log1 as $h => $va){
            if($h=='7'){
               $vs=array();
               foreach($va as $v){
                 $vs[]=$v['nodeid'];
               }
             }
           }
        //$transaction=$this->db->beginTransaction();
       foreach($this->db->get_list('day_log','`condition`=0 and nodeid IN('.implode(',',$vs).')','id,remark,condition,orderid,nodeid,recphoto,sitephoto,col,content', 0, 2, $page,'nodeid DESC') as $item){
            $recphoto =unserialize($item['recphoto']);
            $sitephoto =unserialize($item['sitephoto']);
            $remark =unserialize($item['remark']);
            //echo "<pre>";print_r($remark);exit;
            //$flag = $this->db->delete('m_day_log',array('orderid'=>$item['orderid'],'nodeid'=>$item['nodeid']));
            //if(!$flag)$this->db->rollBack();
            $this->db->delete('m_day_log',array('orderid'=>$item['orderid'],'nodeid'=>$item['nodeid']));
            switch($item['nodeid']){
                case '37':
                foreach ($recphoto[0] as $pk => $pv) {
                    $temp = explode('_', $pk);
                    if(empty($temp[0]) || !is_array($pv)) continue;
                    foreach((array)$pv as $ck => $cv){
                        $data = array(
                            'nodeid' => $item['nodeid'],
                            'orderid' => $item['orderid'],
                            'proName' => $remark[0]["proName_{$temp[1]}"][$ck],
                            'brand' => null,
                            'accQua' => $remark[0]["accQua_{$temp[1]}"][$ck],
                            'unpuaRea' => $remark[0]["unquaRea_{$temp[1]}"][$ck],
                            'accDate' => $remark[0]["accDate_{$temp[1]}"][$ck],
                            'overDate' => $remark[0]["overDate_{$temp[1]}"][$ck],
                            'accImg' => $cv,
                            'overImg' => $sitephoto[0]["overImg_{$temp[1]}"][$ck],
                            'node' => $temp[1],
                            'gb_pic' => $remark[0]['gb_pic'][$ck],
                            'gb_cont' => $remark[0]['gb_cont'][$ck],
                            'col'=>$item['col'],
                        );
                       //$flag=$this->db->insert('m_day_log',$data);
                       //if($flag)$this->db->rollBack();
                       $this->db->insert('m_day_log',$data);
                    }
                }
                break;
                default:
                if($recphoto){
                foreach ($recphoto as $pk => $pv) {
                    $data1 = array(
                        'nodeid' => $item['nodeid'],
                        'orderid' => $item['orderid'],
                        'proName' => $remark[0]['proName_SOW'][$pk],
                        'brand' => $remark[0]['brand_SOW'][$pk],
                        'accQua' => $remark[0]['accQua_SOW'][$pk],
                        'unpuaRea' => $remark[0]['unquaRea_SOW'][$pk],
                        'accDate' => $remark[0]['accDate_SOW'][$pk],
                        'overDate' => $remark[0]['overDate_SOW'][$pk],
                        'accImg' => $pv,
                        'overImg' => $sitephoto[$pk],
                        'node' => 'SOW',
                        'gb_pic' => $remark[0]['gb_pic'][$pk],
                        'gb_cont' => $remark[0]['gb_cont'][$pk],
                        'col' => $item['col'],
                        'content' => $item['content'],
                    );
                    //$flag=$this->db->insert('m_day_log',$data1);
                    //if(!$flag)$this->db->rollBack();
                    $this->db->insert('m_day_log',$data1);
                }
              }else{
                    $data1 = array(
                        'nodeid' => $item['nodeid'],
                        'orderid' => $item['orderid'],
                        'proName' => $remark[0]['proName_SOW'][$pk],
                        'brand' => $remark[0]['brand_SOW'][$pk],
                        'accQua' => $remark[0]['accQua_SOW'][$pk],
                        'unpuaRea' => $remark[0]['unquaRea_SOW'][$pk],
                        'accDate' => $remark[0]['accDate_SOW'][$pk],
                        'overDate' => $remark[0]['overDate_SOW'][$pk],
                        'accImg' => $pv,
                        'overImg' => $sitephoto[$pk],
                        'node' => 'SOW',
                        'gb_pic' => $remark[0]['gb_pic'][$pk],
                        'gb_cont' => $remark[0]['gb_cont'][$pk],
                        'col' => $item['col'],
                        'content' => $item['content'],
                    );
                    //$flag=$this->db->insert('m_day_log',$data1);
                    //if(!$flag)$this->db->rollBack();
                    $this->db->insert('m_day_log',$data1);
              }
                break;
            }
            //$flg=$this->db->update('day_log', array('condition'=>1), array('id' =>$item['id']));
            //if(!$flg)$this->db->rollBack();
            $this->db->update('day_log', array('condition'=>1), array('id' =>$item['id']));
            //$this->db->commit($transaction);
        }
    }

    public function test(){
    	$arr=array(
          'day_log' =>$this->day_log(),
    		);
    }

    // 预约见面
    public function result101($orderid){
        $res = $this->db->get_one('day_log',array('orderid'=>$orderid,'nodeid'=>101,'isPublish'=>'发布'),"check_detail,check_waterdetail,check_other,photo,recphoto,nodename,content");
        /*// 获取分配的装修公司
        $demand_company = $this->db->get_list('demand_company',array('orderid'=>$orderid,'isselected'=>'是','isdel'=>0),'companyid,companyname,is_apply_repalce_com,replace_reason');
        foreach ($demand_company as $key => $company) {
            $meet_info = $this->db->get_one('demand_track_detail',array('orderid'=>$orderid,'nodeid'=>101,'col1'=>$company['companyid']),'col8,addtime');//是否见面
            $demand_company[$key]['meet_company'] = $meet_info['col8']=='是'?1:0;
            $demand_company[$key]['meet_time'] = $meet_info['addtime'];
        }*/
        // 获取预约见面节点同意见面的装修公司
        $demand_company = $this->db->get_list('demand_track_detail',array('orderid'=>$orderid,'nodeid'=>101,'col8'=>'是'),'col2,addtime');
        $arr['nodeid'] = 101;
        $arr['nodename'] = '预约见面';
        $arr['company'] = $demand_company;
        $arr['message'] = $this->get_message($orderid,101);
        $arr['owner_speak']=strip_tags($res['owner_speak']);
        $arr['content']=strip_tags($res['content']);
        $resu['recphoto']=unserialize($res['recphoto']);
        if(!empty($resu['recphoto'])){
            foreach ($resu['recphoto'] as $ke => $va) {
                $recphoto[]="http://www.uzhuang.com/image/pic_230/".$va;
                $recphotos[]="http://www.uzhuang.com/image/pic_800/".$va;
            }
            $arr['photo']=array_slice($recphoto,0,9);
            $arr['photos']=array_slice($recphotos,0,9);
        }else{
            $arr['photo']=array();
            $arr['photos']=array();
        }
        $arr['gjphoto']=$this->gjphoto($orderid);
        return $arr;
    }
    public function result102($orderid){
        $res = $this->db->get_one('day_log',array('orderid'=>$orderid,'nodeid'=>102,'isPublish'=>'发布'),"check_detail,check_waterdetail,check_other,photo,recphoto,nodename,content");
        /*// 获取分配的装修公司
        $demand_company = $this->db->get_list('demand_company',array('orderid'=>$orderid,'isselected'=>'是','isdel'=>0),'companyid,companyname,is_apply_repalce_com,replace_reason');
        foreach ($demand_company as $key => $company) {
            $meet_info = $this->db->get_one('demand_track_detail',array('orderid'=>$orderid,'nodeid'=>13,'col1'=>$company['companyid']),'col8,addtime');//是否见面
            $demand_company[$key]['meet_company'] = $meet_info['col8']=='是'?1:0;
            $demand_company[$key]['meet_time'] = $meet_info['addtime'];
        }*/
        // 获取预约见面节点同意见面的装修公司
        $demand_company = $this->db->get_list('demand_track_detail',array('orderid'=>$orderid,'nodeid'=>102,'col8'=>'是'),'col2,addtime');
        $arr['nodeid'] = 102;
        $arr['nodename'] = '见面';
        $arr['company'] = $demand_company;
        $arr['message'] = $this->get_message($orderid,102);
        $arr['owner_speak']=strip_tags($res['owner_speak']);
        $arr['content']=strip_tags($res['content']);

        $referno = $this->db->get_one('demand_referno','orderid="'.$orderid.'" and nodeid=102');
        //echo "<pre>";print_r($referno);exit;
        if($referno['is_online']==0 || $referno['pay_schedult']==1){
            $arr['pay']=$this->pays($orderid,102);
        }else{
            $arr['pay']=null;
        }
        $resu['recphoto']=unserialize($res['recphoto']);
        if(!empty($resu['recphoto'])){
            foreach ($resu['recphoto'] as $ke => $va) {
                $recphoto[]="http://www.uzhuang.com/image/pic_230/".$va;
                $recphotos[]="http://www.uzhuang.com/image/pic_800/".$va;
            }
            $arr['photo']=array_slice($recphoto,0,9);
            $arr['photos']=array_slice($recphotos,0,9);
        }else{
            $arr['photo']=array();
            $arr['photos']=array();
        }
        $arr['gjphoto']=$this->gjphoto($orderid);
        return $arr;
    }

    //预约量房
    public function result0(){
        $result=array();
        $resu=array();
        $yonghu=array();
        $company=array();
        $photos=array();
        $order_id=$GLOBALS['orderid'];
        $res = $this->db->get_one('day_log',array('orderid'=>$order_id,'nodeid'=>10,'isPublish'=>'发布'),"check_detail,check_waterdetail,check_other,photo,recphoto,nodename,content");
        $result['nodename']=$res['nodename'];
        $company= $this->db->get_list('demand_track_detail',"orderid='".$order_id."' and nodeid=10",'col1,col2,addtime');
        foreach ($company as $ke => $va) {
            $amount_roomt = $this->db->get_one('demand_company',array('orderid'=>$order_id,'companyid'=>$va['col1'],'isdel'=>0,'is_amount_room'=>1),'id');
            if (!$amount_roomt) {
                unset($company[$ke]);
                continue;
            }
            $result['companyname'][]=$va;
            $result['companyname'][$ke]['date1']=$va['addtime'];
        }
        $resu['check_other']=string2array($res['check_other']);
        $arr=array();
        foreach ($resu as $key => $value) {
            foreach ($value as $ke => $valu) {
                if(!empty($valu['img_yse'])){
                $arr[]=$valu['img_yse'];
                }
            } 
        }
        if(!empty($arr)){
          foreach ($arr as $key => $value) {
              $a=explode(',',$value);
             foreach ($a as $kes => $vals) {
              if(!empty($vals)){
               $photo[]="http://www.uzhuang.com/image/pic_230/".$vals;
               $photos[]="http://www.uzhuang.com/image/pic_800/".$vals;
              }
             }
          }
        }else{
            $photo[]=array();
            $photos[]=array();           
        }
        $resu['recphoto']=unserialize($res['recphoto']);
        if(!empty($resu['recphoto'])){
            foreach ($resu['recphoto'] as $ke => $va) {
                $recphoto[]="http://www.uzhuang.com/image/pic_230/".$va;
                $recphotos[]="http://www.uzhuang.com/image/pic_800/".$va;
            }
        }else{
            $recphoto[]=array();
            $recphotos[]=array();
        }
        $result['photo']=array_slice(array_values(array_filter(array_merge($recphoto,$photo))),0,9);
        $result['photos']=array_slice(array_values(array_filter(array_merge($recphotos,$photos))),0,9);
        $result['gjphoto']=$this->gjphoto($order_id);
        $result['content']=strip_tags($res['content']);
        $result['nodeid']=10;
        $result['message'] = $this->get_message($order_id,10);
        return $result;
    }
    //上门量房
    public function result1(){
        $result=array();
        $resu=array();
        $yonghu=array();
        $company=array();
        $photos=array();
        $order_id=$GLOBALS['orderid'];
        $res = $this->db->get_one('day_log',array('orderid'=>$order_id,'nodeid'=>11,'isPublish'=>'发布'),"check_detail,check_waterdetail,check_other,photo,recphoto,nodename,addtime,content,owner_speak");
        $result['nodename']=$res['nodename'];
        $company= $this->db->get_list('demand_track_detail',"orderid='".$order_id."' and nodeid=11 and (col8='是' or col8=1)",'col2,col8');
        foreach ($company as $ke => $va) {
            if($va['col8']==1){
               $result['companyname'][]=$va;
               $result['companyname'][$ke]['col8']='是';
            }else{
               $result['companyname'][]=$va;
            }
        }
        $resu['check_other']=string2array($res['check_other']);
        $arr=array();
        foreach ($resu as $key => $value) {
            foreach ($value as $ke => $valu) {
                if(!empty($valu['img_yse'])){
                $arr[]=$valu['img_yse'];
                }
            } 
        }
        if(!empty($arr)){
            foreach ($arr as $key => $value) {
              $a=explode(',',$value);
             foreach ($a as $kes => $vals) {
              if(!empty($vals)){
               $photo[]="http://www.uzhuang.com/image/pic_230/".$vals;
               $photos[]="http://www.uzhuang.com/image/pic_800/".$vals;
              }
             }
            }
        }else{
            $photo[]=array();
            $photos[]=array();
        }
        $resu['recphoto']=unserialize($res['recphoto']);
        if(!empty($resu['recphoto'])){
            foreach ($resu['recphoto'] as $ke => $va) {
                $recphoto[]="http://www.uzhuang.com/image/pic_230/".$va;
                $recphotos[]="http://www.uzhuang.com/image/pic_800/".$va;
            }
        }else{
            $recphoto[]=array();
            $recphotos[]=array();
        }
        $result['photo']=array_slice(array_values(array_filter(array_merge($recphoto,$photo))),0,9);
        $result['photos']=array_slice(array_values(array_filter(array_merge($recphotos,$photos))),0,9);
        $result['check_detail']=string2array($res['check_detail']);
        //$result['check_waterdetail']=string2array($res['check_waterdetail']);
        //$result['addtime']=$res['addtime'];
        $result['gjphoto']=$this->gjphoto($order_id);
        $result['content']=strip_tags($res['content']);
        if($res['owner_speak']){
        $result['owner_speak']=strip_tags($res['owner_speak']);
        $result['user_photo'] = "http://m.uzhuang.com/res/img/yonghu.png";
        }
        $result['nodeid']=11;
        $result['message'] = $this->get_message($order_id,11);
        return $result;
    }
     //报价审核
    public function result2(){
        $result=array();
        $resu=array();
        $yonghu=array();
        $photos=array();
        $arr=array();
        $arr1=array();
        $arr2=array();
        $companys=array();
        $bjsh=array();
        $uid=get_cookie('_uid');
        $order_id=$GLOBALS['orderid'];
        $res = $this->db->get_one('day_log',array('orderid'=>$order_id,'nodeid'=>12,'isPublish'=>'发布'),"check_detail,check_waterdetail,check_other,photo,recphoto,nodename,addtime,content,owner_speak");
        $result['nodename']=$res['nodename'];
        if(!empty($uid)){
        $result['uid']=1;
        }else{
        $result['uid']=0;   
        }
        //$pinglun =$this->db->get_list('log_evaluate',"orderid=2295 and nodeid=17",'*',0,1000,$page,'id DESC');
        $company= $this->db->get_list('demand_track_detail',"orderid='".$order_id."' and nodeid=12",'col1,col2,remark,attach1,attach2,attach5');
        foreach ($company as $kk => $vv) {
            $bj_photo=$vv['attach5'];
            $bjsh[0]=$bj_photo;

        }
        $a=explode('|',$bjsh[0]);
        
        foreach ($a as $ke => $va) {
            if($va){
            $aa[]="http://www.uzhuang.com/image/pic_230/".$va;
            $bb[]="http://www.uzhuang.com/image/pic_800/".$va;
            $result['bj_photo']=$aa;
            $result['bj_photos']=$bb;
            }
        }
        //echo "<pre>";print_r($result);exit;
        foreach ($company[0] as $keys => $values) {
            $rec[]=$values;    
        }
        //echo "<pre>";print_r($rec);
        //装修公司设计图片，报价图片
        if($company[0] && ($company[0]['attach1'] || $company[0]['attach2'])){
        $rs=array();
        foreach ($company as $ke => $val) {
            $rs[]=$val['col1'];
        }
        $arrs['company_name']=$company[0]['col2'];
        $arr['quote']=explode('|',$rec[3]);
        $arr['design_photo']=explode('|',$rec[4]);
        $arr['b_photo']=explode('|',$rec[5]);
        foreach ($arr['quote'] as $ks => $vs) {
            if(!empty($vs)){
            $arrs['quote'][]="http://www.uzhuang.com/image/pic_230/".$vs;
            $arrs['quotes'][]="http://www.uzhuang.com/image/pic_800/".$vs;
            }
        }
        foreach ($arr['design_photo'] as $kk => $vv) {
            if(!empty($vv)){
            $arrs['design_photo'][]="http://www.uzhuang.com/image/pic_230/".$vv;
            $arrs['design_photos'][]="http://www.uzhuang.com/image/pic_800/".$vv;
            }
        }
        $companys['company']=$arrs;
        }
        /*echo "<pre>";print_r($result);
        exit;*/
        if($company[1] && ($company[1]['attach1'] || $company[1]['attach2'])){
            $rec1=array();
            foreach ($company[1] as $keys => $values) {
                $rec1[]=$values;
                
            }
            //管家评价
            //$gjpj1=$rec1[1];
            //装修公司设计图片，报价图片
            $arrs1['company_name']=$company[1]['col2'];
            $arr1['quote1']=explode('|',$rec1[3]);
            $arr1['design_photo1']=explode('|',$rec1[4]);
            $arr1['b_photo1']=explode('|',$rec[5]);
            foreach ($arr1['quote1'] as $ks => $vs) {
                if(!empty($vs)){
                $arrs1['quote'][]="http://www.uzhuang.com/image/pic_230/".$vs;
                $arrs1['quotes'][]="http://www.uzhuang.com/image/pic_800/".$vs;
                }
            }
            foreach ($arr1['design_photo1'] as $kk => $vv) {
                if(!empty($vv)){
                $arrs1['design_photo'][]="http://www.uzhuang.com/image/pic_230/".$vv;
                $arrs1['design_photos'][]="http://www.uzhuang.com/image/pic_800/".$vv;
                }
            }
            $companys['company1']=$arrs1;
        }
        if($company[2] && ($company[2]['attach1'] || $company[2]['attach2'])){
            $rec2=array();
            foreach ($company[2] as $keys => $values) {
                $rec2[]=$values;
                
            }
            //管家评价
            //$gjpj2=$rec2[1];
            //装修公司设计图片，报价图片
            $arrs2['company_name']=$company[2]['col2'];
            $arr2['quote2']=explode('|',$rec2[3]);
            $arr2['design_photo2']=explode('|',$rec2[4]);
            $arr2['b_photo2']=explode('|',$rec[5]);
            foreach ($arr2['quote2'] as $ks => $vs) {
                if(!empty($vs)){
                $arrs2['quote'][]="http://www.uzhuang.com/image/pic_230/".$vs;
                $arrs2['quotes'][]="http://www.uzhuang.com/image/pic_800/".$vs;
                }
            }
            foreach ($arr2['design_photo2'] as $kk => $vv) {
                if(!empty($vv)){
                $arrs2['design_photo'][]="http://www.uzhuang.com/image/pic_230/".$vv;
                $arrs2['design_photos'][]="http://www.uzhuang.com/image/pic_800/".$vv;
                }
            }
            $companys['company2']=$arrs2;
        }
        //echo "<pre>";print_r($result);exit;
        $result['company_photo']=array_values($companys);
        $result['company_name'] =count($result['company_photo'])."家装修公司提供了图纸及报价清单.";
        $result['company_names'] ="管家对".count($result['company_photo'])."家装修公司的图纸、及报价进行了审核.";
        //装修公司
        $rs=array();
        foreach ($company as $ke => $val) {
            $rs[]=$val['col1'];
        }
        //echo "<pre>";print_r($rs);exit;
        if(!empty($rs)){
        $companyphoto =$this->db->get_list('company',"id in (".implode(',',$rs).')','thumb');
        //echo "<pre>";print_r($companyphoto);exit;
        }
        $resu['check_other']=string2array($res['check_other']);
        $arr=array();
        foreach ($resu as $key => $value) {
            foreach ($value as $ke => $valu) {
                if(!empty($valu['img_yse'])){
                $arr[]=$valu['img_yse'];
                }
            } 
        }
        if(!empty($arr)){
            foreach ($arr as $key => $value) {
              $a=explode(',',$value);
             foreach ($a as $kes => $vals) {
              if(!empty($vals)){
               $photo[]="http://www.uzhuang.com/image/pic_230/".$vals;
               $photos[]="http://www.uzhuang.com/image/pic_800/".$vals;
              }
             }
            }
        }else{
            $photo[]=array();
            $photos[]=array();
        }
        $resu['recphoto']=unserialize($res['recphoto']);
        if(!empty($resu['recphoto'])){
            foreach ($resu['recphoto'] as $ke => $va) {
                $recphoto[]="http://www.uzhuang.com/image/pic_230/".$va;
                $recphotos[]="http://www.uzhuang.com/image/pic_800/".$va;
            }
        }else{
            $recphoto[]=array();
            $recphotos[]=array();
        }
        $result['photo']=array_slice(array_values(array_filter(array_merge($recphoto,$photo))),0,9);
        $result['photos']=array_slice(array_values(array_filter(array_merge($recphotos,$photos))),0,9);
        //$result['check_detail']=string2array($res['check_detail']);
        //$result['check_waterdetail']=string2array($res['check_waterdetail']);
        //$result['addtime']=$res['addtime'];
        $result['gjphoto']=$this->gjphoto($order_id);
        $result['content']=strip_tags($res['content']);
        if($res['owner_speak']){
        $result['owner_speak']=strip_tags($res['owner_speak']);
        $result['user_photo'] = "http://m.uzhuang.com/res/img/yonghu.png";
        }
        $result['nodeid']=12;
        $result['message'] = $this->get_message($order_id,12);
        //echo "<pre>";print_r($result);exit;
       return $result;
    }

    //签订意向订金
    public function result3(){
        $result=array();
        $resu=array();
        $yonghu=array();
        $photos=array();
        $order_id=$GLOBALS['orderid'];
        $res = $this->db->get_one('day_log',array('orderid'=>$order_id,'nodeid'=>15,'isPublish'=>'发布'),"check_detail,check_waterdetail,check_other,photo,recphoto,nodename,addtime,content,owner_speak");
       $result['nodename']=$res['nodename'];
        //$pinglun =$this->db->get_list('log_evaluate',"orderid=2295 and nodeid=17",'*',0,1000,$page,'id DESC');
        $resu['check_other']=string2array($res['check_other']);
        $arr=array();
        foreach ($resu as $key => $value) {
            foreach ($value as $ke => $valu) {
                if(!empty($valu['img_yse'])){
                $arr[]=$valu['img_yse'];
                }
            } 
        }
        if(!empty($arr)){
            foreach ($arr as $key => $value) {
              $a=explode(',',$value);
             foreach ($a as $kes => $vals) {
              if(!empty($vals)){
               $photo[]="http://www.uzhuang.com/image/pic_230/".$vals;
               $photos[]="http://www.uzhuang.com/image/pic_800/".$vals;
              }
             }
            }
        }else{
            $photo[]=array();
            $photos[]=array();
        }
        $resu['recphoto']=unserialize($res['recphoto']);
        if(!empty($resu['recphoto'])){
            foreach ($resu['recphoto'] as $ke => $va) {
                $recphoto[]="http://www.uzhuang.com/image/pic_230/".$va;
                $recphotos[]="http://www.uzhuang.com/image/pic_800/".$va;
            }
        }else{
            $recphoto[]=array();
            $recphotos[]=array();
        }
        $result['photo']=array_slice(array_values(array_filter(array_merge($recphoto,$photo))),0,9);
        $result['photos']=array_slice(array_values(array_filter(array_merge($recphotos,$photos))),0,9);
        //$result['check_detail']=string2array($res['check_detail']);
        $result['gjphoto']=$this->gjphoto($order_id);
        $result['content']=strip_tags($res['content']);
        if($res['owner_speak']){
        $result['owner_speak']=strip_tags($res['owner_speak']);
        $result['user_photo'] = "http://m.uzhuang.com/res/img/yonghu.png";
        }
        $result['nodeid']=15;
        $result['company']= $this->db->get_one('demand_track_detail',"orderid='".$order_id."' and nodeid=13 and col8='是'",'col2');
        $result['nodename']=$this->db->get_one('demand_track',"orderid='".$order_id."' and nodeid=15",'nodename');
        $referno = $this->db->get_one('demand_referno','orderid="'.$order_id.'" and nodeid=15');
        //echo "<pre>";print_r($referno);exit;
        if($referno['is_online']==0 || $referno['pay_schedult']==1){
        $result['pay']=$this->pays($order_id,15);
        }else{
        $result['pay']=null;
        }
        $result['message'] = $this->get_message($order_id,15);
       return $result;
    }
    //预交底
    public function result4(){
        $result=array();
        $arrs=array();
        $resu=array();
        $yonghu=array();
        $photos=array();
        $order_id=$GLOBALS['orderid'];
        $res = $this->db->get_one('day_log',array('orderid'=>$order_id,'nodeid'=>17,'isPublish'=>'发布'),"check_detail,check_waterdetail,check_other,photo,recphoto,nodename,content,owner_speak");
        $result=  $this->db->get_one('demand_track',array('orderid'=>$order_id,'nodeid'=>17),"addtime,col5,col6,col8");
        $result['addtimes']=substr($result['addtime'],0,10);
        $result['nodename']=$res['nodename'];
        //$pinglun =$this->db->get_list('log_evaluate',"orderid=2295 and nodeid=17",'*',0,1000,$page,'id DESC');
        $resu['check_other']=string2array($res['check_other']);
        $results['check_other']=string2array($res['check_other']);
        foreach ($results['check_other'] as $key => $value) {
            if(!empty($value['img_yse'])){
            $arrs[]=$value;
            }
        }
        $result['check_other']=$arrs;
        foreach ($result['check_other'] as $ke => $val) {
            if(!empty($val['img_yse'])){
              $img_yse=explode(',',$val['img_yse']);
              $result['check_other'][$ke]['img_yse'] = array_filter($img_yse);
              
              foreach ($result['check_other'][$ke]['img_yse'] as $mk => $mv) {
                  $result['check_other'][$ke]['img_yse'][$mk] = "http://www.uzhuang.com/image/pic_230/".$mv;
                  $result['check_other'][$ke]['img_yses'][$mk] = "http://www.uzhuang.com/image/pic_800/".$mv;
              }
            }
        }
        $arr=array();
        foreach ($resu as $key => $value) {
            foreach ($value as $ke => $valu) {
                if(!empty($valu['img_yse'])){
                $arr[]=$valu['img_yse'];
                }
            } 
        }
        if(!empty($arr)){
        foreach ($arr as $key => $value) {
        $a=explode(',',$value);
         foreach ($a as $kes => $vals) {
           if(!empty($vals)){
            $photo[]="http://www.uzhuang.com/image/pic_230/".$vals;
            $photos[]="http://www.uzhuang.com/image/pic_800/".$vals;
           //$result['check_other_photo'][]="http://www.uzhuang.com/image/pic_230/".$vals;
           }
         }
        }
        }else{
          $photo[]=array();
          $photos[]=array(); 
        }
        $resu['recphoto']=unserialize($res['recphoto']);
        if(!empty($resu['recphoto'])){
            foreach ($resu['recphoto'] as $ke => $va) {
                $recphoto[]="http://www.uzhuang.com/image/pic_230/".$va;
                $recphotos[]="http://www.uzhuang.com/image/pic_800/".$va;
            }
            $result['gjsphoto']=$recphoto;
        }else{
            $recphoto[]=array();
            $recphotos[]=array();
        }
       //echo "<pre>";print_r($recphoto);exit;
        /*if(empty($res['photo'])){
        $resu['recpho']=array(); 
        }else{
        $resu['recpho']=unserialize($res['photo']);
            foreach ($resu['recpho']['yonghu'] as $key => $value) {
               $yonghu[]=$value;
            }
        }*/
        $result['photo']=array_slice(array_values(array_filter(array_merge($recphoto,$photo))),0,9);
        $result['photos']=array_slice(array_values(array_filter(array_merge($recphotos,$photos))),0,9);
        $result['check_detail']=string2array($res['check_detail']);
        //$result['check_waterdetail']=string2array($res['check_waterdetail']);
        //$result['addtime']=$res['addtime'];
        $result['gjphoto']=$this->gjphoto($order_id);
        $result['content']=strip_tags($res['content']);
        if($res['owner_speak']){
        $result['owner_speak']=strip_tags($res['owner_speak']);
        $result['user_photo'] = "http://m.uzhuang.com/res/img/yonghu.png";
        }
        $result['nodeid']=17;
        $referno = $this->db->get_one('demand_referno','orderid="'.$order_id.'" and nodeid=17');
        if($referno['is_online']==0 || $referno['pay_schedult']==1){
        $result['pay']=$this->pays($order_id,17);
        }else{
        $result['pay']=null;
        }
        $result['message'] = $this->get_message($order_id,17);
       return $result;
    }
    //签订三方合同
    public function result5(){
      $result=array();
        $resu=array();
        $yonghu=array();
        $photos=array();
        $order_id=$GLOBALS['orderid'];
         $res = $this->db->get_one('day_log',array('orderid'=>$order_id,'nodeid'=>19,'isPublish'=>'发布'),"check_detail,check_waterdetail,check_other,photo,recphoto,nodename,nodename,addtime,content,owner_speak");
         $result=  $this->db->get_one('demand_track',array('orderid'=>$order_id,'nodeid'=>19),"addtime,col8,col9");
         $result['nodename']=$res['nodename'];
        //$pinglun =$this->db->get_list('log_evaluate',"orderid=2295 and nodeid=17",'*',0,1000,$page,'id DESC');
        $resu['check_other']=string2array($res['check_other']);
        $arr=array();
       foreach ($resu as $key => $value) {
            foreach ($value as $ke => $valu) {
                if(!empty($valu['img_yse'])){
                $arr[]=$valu['img_yse'];

                }
            }   
        }
        if(!empty($arr)){
            foreach ($arr as $key => $value) {
              $a=explode(',',$value);
             foreach ($a as $kes => $vals) {
              if(!empty($vals)){
               $photo[]="http://www.uzhuang.com/image/pic_230/".$vals;
               $photos[]="http://www.uzhuang.com/image/pic_800/".$vals;
              }
             }
            }
        }else{
            $photo[]=array();
            $photos[]=array();
        }
        $resu['recphoto']=unserialize($res['recphoto']);
        if(!empty($resu['recphoto'])){
            foreach ($resu['recphoto'] as $ke => $va) {
                $recphoto[]="http://www.uzhuang.com/image/pic_230/".$va;
                $recphotos[]="http://www.uzhuang.com/image/pic_800/".$va;
            }
        }else{
            $recphoto[]=array();
            $recphotos[]=array();
        }
        /*//$resu['check_detail']=string2array($res['check_detail']);          
        /* if(empty($res['photo'])){
        $resu['recpho']=array(); 
        }else{
        $resu['recpho']=unserialize($res['photo']);
            foreach ($resu['recpho']['yonghu'] as $key => $value) {
               $yonghu[]=$value;
            }
        }*/
        //echo "<pre>";print_r($photos);
        //echo "<pre>";print_r($recphoto);exit;
        $result['photo']=array_slice(array_values(array_filter(array_merge($recphoto,$photo))),0,9);
        $result['photos']=array_slice(array_values(array_filter(array_merge($recphotos,$photos))),0,9);               
        //$result['check_waterdetail']=string2array($res['check_waterdetail']);
        //$result['addtime']=$res['addtime'];
        $result['gjphoto']=$this->gjphoto($order_id);
        $result['content']=strip_tags($res['content']);
        if($res['owner_speak']){
        $result['owner_speak']=strip_tags($res['owner_speak']);
        $result['user_photo'] = "http://m.uzhuang.com/res/img/yonghu.png";
        }
        $result['nodeid']=19;
        $result['company']= $this->db->get_one('demand_track_detail',"orderid='".$order_id."' and nodeid=13 and col8='是'",'col2');
        $attach1=$this->db->get_one('demand_track',"orderid='".$order_id."' and nodeid=19",'attach1');
        foreach ($attach1 as $key => $value) {
            $a=explode('|',$value);
            if(!empty($a)){
            $b=array_filter($a);
                foreach ($b as $k => $v) {
                    if(!empty($v)){
                    $arr1[]="http://www.uzhuang.com/image/pic_230/".$v;
                    $arr2[]="http://www.uzhuang.com/image/pic_800/".$v;
                    $result['pz_photo']=$arr1;
                    $result['pz_photos']=$arr2;
                    }
                }
            }
        }
        $referno = $this->db->get_one('demand_referno','orderid="'.$order_id.'" and nodeid=19');
        if($referno['is_online']==0 || $referno['pay_schedult']==1){
        $result['pay']=$this->pays($order_id,19);
        }else{
        $result['pay']=null;
        }
        $result['message'] = $this->get_message($order_id,19);
       return $result;
    }
    //开工仪式
    public function result6(){
        $result=array();
        $resu=array();
        $yonghu=array();
        $photos=array();
        $arrs=array();
        $order_id=$GLOBALS['orderid'];
        $res = $this->db->get_one('day_log',array('orderid'=>$order_id,'nodeid'=>21,'isPublish'=>'发布'),"check_detail,check_waterdetail,check_other,photo,recphoto,nodename,addtime,content,owner_speak");
        //$pinglun =$this->db->get_list('log_evaluate',"orderid=2295 and nodeid=17",'*',0,1000,$page,'id DESC');
        $result=  $this->db->get_one('demand_track',array('orderid'=>$order_id,'nodeid'=>21),"addtime,col8,col9");
        $result['nodename']=$res['nodename'];
        $resu['check_other']=string2array($res['check_other']);
        $results['check_other']=string2array($res['check_other']);
        foreach ($results['check_other'] as $key => $value) {
            if(!empty($value['img_yse'])){
            $arrs[]=$value;
            }
        }
        $result['check_other']=$arrs;
        foreach ($result['check_other'] as $ke => $val) {
            if(!empty($val['img_yse'])){
              $img_yse=explode(',',$val['img_yse']);
              $result['check_other'][$ke]['img_yse'] = array_filter($img_yse);
              
              foreach ($result['check_other'][$ke]['img_yse'] as $mk => $mv) {
                  $result['check_other'][$ke]['img_yse'][$mk] = "http://www.uzhuang.com/image/pic_230/".$mv;
                  $result['check_other'][$ke]['img_yses'][$mk] = "http://www.uzhuang.com/image/pic_800/".$mv;
              }
            }
        }
        $arr=array();
        foreach ($resu as $key => $value) {
            foreach ($value as $ke => $valu) {
                if(!empty($valu['img_yse'])){
                $arr[]=$valu['img_yse'];
                }
            } 
        }
        if(!empty($arr)){
            foreach ($arr as $key => $value) {
              $a=explode(',',$value);
             foreach ($a as $kes => $vals) {
              if(!empty($vals)){
               $photo[]="http://www.uzhuang.com/image/pic_230/".$vals;
               $photos[]="http://www.uzhuang.com/image/pic_800/".$vals;
              }
             }
            }
        }else{
            $photo[]=array();
            $photos[]=array();
        }
        $resu['recphoto']=unserialize($res['recphoto']);
        if(!empty($resu['recphoto'])){
            foreach ($resu['recphoto'] as $ke => $va) {
                $recphoto[]="http://www.uzhuang.com/image/pic_230/".$va;
                $recphotos[]="http://www.uzhuang.com/image/pic_800/".$va;
            }
            $result['gjsphoto']=$recphoto;
            $result['gjsphotos']=$recphotos;
        }else{
            $recphoto[]=array();
            $recphotos[]=array();
        }
        $result['photo']=array_slice(array_values(array_filter(array_merge($recphoto,$photo))),0,9);
        $result['photos']=array_slice(array_values(array_filter(array_merge($recphotos,$photos))),0,9);
        //$result['check_waterdetail']=string2array($res['check_waterdetail']);
        //$result['addtimes']=$res['addtime'];
        $result['gjphoto']=$this->gjphoto($order_id);
        $result['content']=strip_tags($res['content']);
        if($res['owner_speak']){
        $result['owner_speak']=strip_tags($res['owner_speak']);
        $result['user_photo'] = "http://m.uzhuang.com/res/img/yonghu.png";
        }
        $result['nodeid']=21;
        $referno = $this->db->get_one('demand_referno','orderid="'.$order_id.'" and nodeid=21');
        if($referno['is_online']==0 || $referno['pay_schedult']==1){
        $result['pay']=$this->pays($order_id,21);
        }else{
        $result['pay']=null;
        }
        $result['message'] = $this->get_message($order_id,21);
       return $result;
    }
    //水电材料验收
    public function result7(){
        $result=array();
        $resu=array();
        $yonghu=array();
        $title=array();
        $titles=array();
        $order_id=$GLOBALS['orderid'];
        $res = $this->db->get_one('day_log',array('orderid'=>$order_id,'nodeid'=>25,'isPublish'=>'发布'),"check_detail,check_waterdetail,check_other,photo,recphoto,nodename,addtime,content,owner_speak");
        //$pinglun =$this->db->get_list('log_evaluate',"orderid=2295 and nodeid=17",'*',0,1000,$page,'id DESC');
        $result=  $this->db->get_one('demand_track',array('orderid'=>$order_id,'nodeid'=>25),"addtime,col8,col9");
        $result['nodename']=$res['nodename'];
        $resu['check_other']=string2array($res['check_other']);

        $arr=array();
        foreach ($resu as $key => $value) {
            foreach ($value as $ke => $valu) {
                if(!empty($valu['img_yse'])){
                $arr[]=$valu['img_yse'];
                }
            } 
        }
        if(!empty($arr)){
        foreach ($arr as $key => $value) {
          $a=explode(',',$value);
         foreach ($a as $kes => $vals) {
          if(!empty($vals)){
           $photo[]="http://www.uzhuang.com/image/pic_230/".$vals;
           $photos[]="http://www.uzhuang.com/image/pic_800/".$vals;
          }
         }
        }
        }else{
          $photo[]=array();
          $photos[]=array();  
        }
        $resu['recphoto']=unserialize($res['recphoto']);
        if(!empty($resu['recphoto'])){
            foreach ($resu['recphoto'] as $ke => $va) {
                $recphoto[]="http://www.uzhuang.com/image/pic_230/".$va;
                $recphotos[]="http://www.uzhuang.com/image/pic_800/".$va;
            }
        }else{
            $recphoto[]=array();
            $recphotos[]=array();
        }
        //echo "<pre>";print_r($photos);exit;
        $result['photo']=array_slice(array_values(array_filter(array_merge($recphoto,$photo))),0,9);
        $result['photos']=array_slice(array_values(array_filter(array_merge($recphotos,$photos))),0,9);
        $result['check_detail']=string2array($res['check_detail']);
            foreach ($result['check_detail'] as $ke => $val) {
                if($val['qua']=='合格') {
                   $titles[]=$val['title'];
                    if(!empty($val['img_yse'])) {
                      $img_yse=explode(',',$val['img_yse']);
                      $result['check_detail'][$ke]['img_yse'] = array_filter($img_yse);
                      foreach ($result['check_detail'][$ke]['img_yse'] as $mk => $mv) {
                          $result['check_detail'][$ke]['img_yse'][$mk] = "http://www.uzhuang.com/image/pic_230/".$mv;
                          $result['check_detail'][$ke]['img_yses'][$mk] = "http://www.uzhuang.com/image/pic_800/".$mv;
                      }
                    }
                    if($val['qua']=='合格' && $val['img_yse']==''){
                            $title[]=$val['title'];
                    }
                    if($result['check_detail'][$ke]['img_yse']){
                      $result['check_detail']['qualified'][] = $result['check_detail'][$ke];
                    }
                    unset($result['check_detail'][$ke]);
                }else{
                    if(!empty($val['img_yse'])) {
                      $img_yse=explode(',',$val['img_yse']);
                      $result['check_detail'][$ke]['img_yse'] = array_filter($img_yse);
                      foreach ($result['check_detail'][$ke]['img_yse'] as $mk => $mv) {
                          $result['check_detail'][$ke]['img_yse'][$mk] = "http://www.uzhuang.com/image/pic_230/".$mv;
                          $result['check_detail'][$ke]['img_yses'][$mk] = "http://www.uzhuang.com/image/pic_800/".$mv;
                      }
                    }
                    if(!empty($val['chan_Srcs'])){
                      $chan_Srcs=explode(',',$val['chan_Srcs']);
                      $result['check_detail'][$ke]['chan_Srcs'] =array_filter($chan_Srcs);
                      foreach ($result['check_detail'][$ke]['chan_Srcs'] as $ks => $vs) {
                          $result['check_detail'][$ke]['chan_Srcs'][$ks] = "http://www.uzhuang.com/image/pic_230/".$vs;
                          $result['check_detail'][$ke]['chan_Srcss'][$ks] = "http://www.uzhuang.com/image/pic_800/".$vs;
                      }
                    }else{
                          $result['check_detail'][$ke]['chan_Srcs'] =1;
                    }
                    $result['check_detail']['unqualified'][] = $result['check_detail'][$ke];
                    unset($result['check_detail'][$ke]);
                }                
            }
        $result['count']=count($title);
        $result['sum']=count($titles);
        //$result['check_waterdetail']=string2array($res['check_waterdetail']);
        //$result['addtimes']=$res['addtime'];
        $result['gjphoto']=$this->gjphoto($order_id);
        $result['content']=strip_tags($res['content']);
        if($res['owner_speak']){
        $result['owner_speak']=strip_tags($res['owner_speak']);
        $result['user_photo'] = "http://m.uzhuang.com/res/img/yonghu.png";
        }
        $result['nodeid']=25;
        $referno = $this->db->get_one('demand_referno','orderid="'.$order_id.'" and nodeid=25');
        if($referno['is_online']==0 || $referno['pay_schedult']==1){
        $result['pay']=$this->pays($order_id,25);
        }else{
        $result['pay']=null;
        }
        $result['message'] = $this->get_message($order_id,25);
        //echo "<pre>";print_r($result);exit;
       return $result;
    }
    //水电工程验收
    public function result8(){
        $result=array();
        $resu=array();
        $yonghu=array();
        $title=array();
        $titles=array();
        $tits=array();
        $tit=array();
        $order_id=$GLOBALS['orderid'];
        $res = $this->db->get_one('day_log',array('orderid'=>$order_id,'nodeid'=>27,'isPublish'=>'发布'),"check_detail,check_waterdetail,check_other,photo,recphoto,nodename,addtime,content,owner_speak");
        //$pinglun =$this->db->get_list('log_evaluate',"orderid=2295 and nodeid=17",'*',0,1000,$page,'id DESC');
        $result=  $this->db->get_one('demand_track',array('orderid'=>$order_id,'nodeid'=>27),"addtime,col8,col9");
        //$company= $this->db->get_list('demand_track_detail',"orderid=13687 and nodeid=13",'col1,col2,date1');
        $company = $this->db->get_one('demand_company',array('orderid'=>$order_id,'isselected'=>'是'),"companyname,companyid",0,"id desc");
        $co=$this->db->get_one('company',"`id`='".$company['companyid']."'",'avg_total');
        if(!empty($co['avg_total']) && $co['avg_total']!=0){
            $result['avg_total']=$co['avg_total'];
        }else{
            $result['avg_total']='5.0';
        }
        $result['gj_total']='5.0';
        $result['nodename']=$res['nodename'];
        $resu['check_other']=string2array($res['check_other']);
        $arr=array();
        foreach ($resu as $key => $value) {
            foreach ($value as $ke => $valu) {
                if(!empty($valu['img_yse'])){
                $arr[]=$valu['img_yse'];
                }
            } 
        }
        if(!empty($arr)){
        foreach ($arr as $key => $value) {
          $a=explode(',',$value);
         foreach ($a as $kes => $vals) {
          if(!empty($vals)){
           $photo[]="http://www.uzhuang.com/image/pic_230/".$vals;
           $photos[]="http://www.uzhuang.com/image/pic_800/".$vals;
          }
         }
        }
        }else{
          $photo[]=array();
          $photos[]=array();
        }
        $resu['recphoto']=unserialize($res['recphoto']);
        if(!empty($resu['recphoto'])){
            foreach ($resu['recphoto'] as $ke => $va) {
                $recphoto[]="http://www.uzhuang.com/image/pic_230/".$va;
                $recphotos[]="http://www.uzhuang.com/image/pic_800/".$va;
            }
        }else{
            $recphoto[]=array();
            $recphotos[]=array();
        }
        //echo "<pre>";print_r($photos);exit;
        $result['photo']=array_slice(array_values(array_filter(array_merge($recphoto,$photo))),0,9);
        $result['photos']=array_slice(array_values(array_filter(array_merge($recphotos,$photos))),0,9);
        $result['check_detail']=string2array($res['check_detail']);
        $result['check_waterdetail']=string2array($res['check_waterdetail']);
        //$result['check_detail']=array_merge($check_details,$check_waterdetail);
        foreach ($result['check_detail'] as $ke => $val) {
                if($val['qua']=='合格') {
                        $tit[]=$val['title'];
                    if(!empty($val['img_yse'])) {
                      $img_yse=explode(',',$val['img_yse']);
                      $result['check_detail'][$ke]['img_yse'] = array_filter($img_yse);
                      foreach ($result['check_detail'][$ke]['img_yse'] as $mk => $mv) {
                          $result['check_detail'][$ke]['img_yse'][$mk] = "http://www.uzhuang.com/image/pic_230/".$mv;
                          $result['check_detail'][$ke]['img_yses'][$mk] = "http://www.uzhuang.com/image/pic_800/".$mv;
                      }
                    }
                    if($val['qua']=='合格' && $val['img_yse']==''){
                            $title[]=$val['title'];
                    }
                    if($result['check_detail'][$ke]['img_yse']){
                      $result['check_detail']['qualified'][] = $result['check_detail'][$ke];
                    }
                    unset($result['check_detail'][$ke]);
                }else{
                    if(!empty($val['img_yse'])) {
                      $img_yse=explode(',',$val['img_yse']);
                      $result['check_detail'][$ke]['img_yse'] = array_filter($img_yse);
                      foreach ($result['check_detail'][$ke]['img_yse'] as $mk => $mv) {
                          $result['check_detail'][$ke]['img_yse'][$mk] = "http://www.uzhuang.com/image/pic_230/".$mv;
                          $result['check_detail'][$ke]['img_yses'][$mk] = "http://www.uzhuang.com/image/pic_800/".$mv;
                      }
                    }
                    if(!empty($val['chan_Srcs'])){
                      $chan_Srcs=explode(',',$val['chan_Srcs']);
                      $result['check_detail'][$ke]['chan_Srcs'] =array_filter($chan_Srcs);
                      foreach ($result['check_detail'][$ke]['chan_Srcs'] as $ks => $vs) {
                          $result['check_detail'][$ke]['chan_Srcs'][$ks] = "http://www.uzhuang.com/image/pic_230/".$vs;
                          $result['check_detail'][$ke]['chan_Srcss'][$ks] = "http://www.uzhuang.com/image/pic_800/".$vs;
                      }
                    }else{
                          $result['check_detail'][$ke]['chan_Srcs'] =1;
                    }
                    $result['check_detail']['unqualified'][] = $result['check_detail'][$ke];
                    unset($result['check_detail'][$ke]);
                }                
            }
        //echo "<pre>";print_r($title);exit;
        $result['count']=count($title);
        $result['sum']=count($tit);
        foreach ($result['check_waterdetail'] as $ke => $val) {
            if($val['qua']=='合格') {
                    $tits[]=$val['title'];
                if(!empty($val['img_yse'])) {
                  $img_yse=explode(',',$val['img_yse']);
                  $result['check_waterdetail'][$ke]['img_yse'] = array_filter($img_yse);
                  foreach ($result['check_waterdetail'][$ke]['img_yse'] as $mk => $mv) {
                      $result['check_waterdetail'][$ke]['img_yse'][$mk] = "http://www.uzhuang.com/image/pic_230/".$mv;
                      $result['check_waterdetail'][$ke]['img_yses'][$mk] = "http://www.uzhuang.com/image/pic_800/".$mv;
                  }
                }
                if($val['qua']=='合格' && $val['img_yse']==''){
                        $titles[]=$val['title'];
                }
                if($result['check_waterdetail'][$ke]['img_yse']){
                   $result['check_waterdetail']['qualifieds'][] = $result['check_waterdetail'][$ke];
                }
                unset($result['check_waterdetail'][$ke]);
            }else{
                if (!empty($val['img_yse'])) {
                      $img_yse=explode(',',$val['img_yse']);
                      $result['check_waterdetail'][$ke]['img_yse'] = array_filter($img_yse);
                      foreach ($result['check_waterdetail'][$ke]['img_yse'] as $mk => $mv) {
                          $result['check_waterdetail'][$ke]['img_yse'][$mk] = "http://www.uzhuang.com/image/pic_230/".$mv;
                          $result['check_waterdetail'][$ke]['img_yses'][$mk] = "http://www.uzhuang.com/image/pic_800/".$mv;
                      }
                }
                if(!empty($val['chan_Srcs'])){
                    $chan_Srcs=explode(',',$val['chan_Srcs']);
                    $result['check_waterdetail'][$ke]['chan_Srcs'] =array_filter($chan_Srcs);
                    foreach ($result['check_waterdetail'][$ke]['chan_Srcs'] as $ks => $vs) {
                    $result['check_waterdetail'][$ke]['chan_Srcs'][$ks] = "http://www.uzhuang.com/image/pic_230/".$vs;
                    $result['check_waterdetail'][$ke]['chan_Srcss'][$ks] = "http://www.uzhuang.com/image/pic_800/".$vs;
                    }
                }else{
                    $result['check_waterdetail'][$ke]['chan_Srcs']=1;
                }
                $result['check_waterdetail']['unqualifieds'][] = $result['check_waterdetail'][$ke];
                unset($result['check_waterdetail'][$ke]);

            }
        }
        $result['counts']=count($titles);
        $result['sums']=count($tits);
        //$result['addtimes']=$res['addtime'];
        $result['gjphoto']=$this->gjphoto($order_id);
        $result['content']=strip_tags($res['content']);
        if($res['owner_speak']){
        $result['owner_speak']=strip_tags($res['owner_speak']);
        $result['user_photo'] = "http://m.uzhuang.com/res/img/yonghu.png";
        }
        $result['nodeid']=27;
        $referno = $this->db->get_one('demand_referno','orderid="'.$order_id.'" and nodeid=27');
        if($referno['is_online']==0 || $referno['pay_schedult']==1){
        $result['pay']=$this->pays($order_id,27);
        }else{
        $result['pay']=null;
        }
        $result['message'] = $this->get_message($order_id,27);
        $result['grade'] = $this->grade($order_id,27);
        //echo "<pre>";print_r($result);exit;
       return $result;
    }
    //防水工程验收
    public function result9(){
        $result=array();
        $resu=array();
        $yonghu=array();
        $title=array();
        $titles=array();
        $order_id=$GLOBALS['orderid'];
        $res = $this->db->get_one('day_log',array('orderid'=>$order_id,'nodeid'=>28,'isPublish'=>'发布'),"check_detail,check_waterdetail,check_other,photo,recphoto,nodename,addtime,content,owner_speak");
        //$pinglun =$this->db->get_list('log_evaluate',"orderid=2295 and nodeid=17",'*',0,1000,$page,'id DESC');
        $result=  $this->db->get_one('demand_track',array('orderid'=>$order_id,'nodeid'=>28),"addtime,col8,col9");
        $company = $this->db->get_one('demand_company',array('orderid'=>$order_id,'isselected'=>'是'),"companyname,companyid",0,"id desc");
        $co=$this->db->get_one('company',"`id`='".$company['companyid']."'",'avg_total');
        if(!empty($co['avg_total']) && $co['avg_total']!=0){
            $result['avg_total']=$co['avg_total'];
        }else{
            $result['avg_total']='5.0';
        }
        $result['gj_total']='5.0';
        $result['nodename']=$res['nodename'];
        $resu['check_other']=string2array($res['check_other']);
        $arr=array();
        foreach ($resu as $key => $value) {
            foreach ($value as $ke => $valu) {
                if(!empty($valu['img_yse'])){
                $arr[]=$valu['img_yse'];
                }
            } 
        }
       if(!empty($arr)){
        foreach ($arr as $key => $value) {
          $a=explode(',',$value);
         foreach ($a as $kes => $vals) {
          if(!empty($vals)){
           $photo[]="http://www.uzhuang.com/image/pic_230/".$vals;
           $photos[]="http://www.uzhuang.com/image/pic_800/".$vals;
          }
         }
        }
        }else{
          $photo[]=array();
          $photos[]=array();  
        }
        $resu['recphoto']=unserialize($res['recphoto']);
        if(!empty($resu['recphoto'])){
            foreach ($resu['recphoto'] as $ke => $va) {
                $recphoto[]="http://www.uzhuang.com/image/pic_230/".$va;
                $recphotos[]="http://www.uzhuang.com/image/pic_800/".$va;
            }
        }else{
            $recphoto[]=array();
            $recphotos[]=array();
        }
        //echo "<pre>";print_r($photos);exit;
        $result['photo']=array_slice(array_values(array_filter(array_merge($recphoto,$photo))),0,9);
        $result['photos']=array_slice(array_values(array_filter(array_merge($recphotos,$photos))),0,9);
        $result['check_detail']=string2array($res['check_detail']);
        if($result['check_detail']){
            foreach ($result['check_detail'] as $ke => $val) {
                    if($val['qua']=='合格' && $val['title']!='防水是否合格') {
                       $titles[]=$val['title'];
                        if(!empty($val['img_yse'])) {
                          $img_yse=explode(',',$val['img_yse']);
                          $result['check_detail'][$ke]['img_yse'] = array_filter($img_yse);
                          foreach ($result['check_detail'][$ke]['img_yse'] as $mk => $mv) {
                              $result['check_detail'][$ke]['img_yse'][$mk] = "http://www.uzhuang.com/image/pic_230/".$mv;
                              $result['check_detail'][$ke]['img_yses'][$mk] = "http://www.uzhuang.com/image/pic_800/".$mv;
                          }
                        }
                        if($val['qua']=='合格' && $val['img_yse']==''){
                                $title[]=$val['title'];
                        }
                        if($result['check_detail'][$ke]['img_yse']){
                           $result['check_detail']['qualified'][] = $result['check_detail'][$ke];
                        }
                        unset($result['check_detail'][$ke]);
                    }else if($val['qua']=='不合格' && $val['title']!='防水是否合格'){
                        if (!empty($val['img_yse'])) {
                          $img_yse=explode(',',$val['img_yse']);
                          $result['check_detail'][$ke]['img_yse'] = array_filter($img_yse);
                          foreach ($result['check_detail'][$ke]['img_yse'] as $mk => $mv) {
                              $result['check_detail'][$ke]['img_yse'][$mk] = "http://www.uzhuang.com/image/pic_230/".$mv;
                              $result['check_detail'][$ke]['img_yses'][$mk] = "http://www.uzhuang.com/image/pic_800/".$mv;
                          }
                        }
                        if(!empty($val['chan_Srcs'])){
                          $chan_Srcs=explode(',',$val['chan_Srcs']);
                          $result['check_detail'][$ke]['chan_Srcs'] =array_filter($chan_Srcs);
                          foreach ($result['check_detail'][$ke]['chan_Srcs'] as $ks => $vs) {
                              $result['check_detail'][$ke]['chan_Srcs'][$ks] = "http://www.uzhuang.com/image/pic_230/".$vs;
                              $result['check_detail'][$ke]['chan_Srcss'][$ks] = "http://www.uzhuang.com/image/pic_800/".$vs;
                          }
                        }else{
                              $result['check_detail'][$ke]['chan_Srcs'] =1;
                        }
                        $result['check_detail']['unqualified'][] = $result['check_detail'][$ke];
                        unset($result['check_detail'][$ke]);
                    }else if($val['title']=='防水是否合格'){
                          $img_yse=explode(',',$val['img_yse']);
                          $result['check_detail'][$ke]['img_yse'] = array_filter($img_yse);
                          foreach ($result['check_detail'][$ke]['img_yse'] as $mk => $mv) {
                              $result['check_detail'][$ke]['img_yse'][$mk] = "http://www.uzhuang.com/image/pic_230/".$mv;
                              $result['check_detail'][$ke]['img_yses'][$mk] = "http://www.uzhuang.com/image/pic_800/".$mv;
                          }
                        $result['check_detail']['waterproof'][] = $result['check_detail'][$ke];
                        unset($result['check_detail'][$ke]);
                    }else if(strpos($val['title'],'是否做闭水试验')>=0 || strpos($val['title'],'是否做闭水试验')!=false){
                        if(!empty($val['img_yse'])) {
                          $img_yse=explode(',',$val['img_yse']);
                          $result['check_detail'][$ke]['img_yse'] = array_filter($img_yse);
                          foreach ($result['check_detail'][$ke]['img_yse'] as $mk => $mv) {
                              $result['check_detail'][$ke]['img_yse'][$mk] = "http://www.uzhuang.com/image/pic_230/".$mv;
                              $result['check_detail'][$ke]['img_yses'][$mk] = "http://www.uzhuang.com/image/pic_800/".$mv;
                          }
                        }
                        $result['check_detail']['closed_water'][] = $result['check_detail'][$ke];
                        unset($result['check_detail'][$ke]);
                    }      
                }
            }else{
                $result['check_detail']=null;
            }
        $result['count']=count($title);
        $result['sum']=count($titles);
        //$result['check_waterdetail']=string2array($res['check_waterdetail']);
        //$result['addtimes']=$res['addtime'];
        $result['gjphoto']=$this->gjphoto($order_id);
        $result['content']=strip_tags($res['content']);
        if($res['owner_speak']){
        $result['owner_speak']=strip_tags($res['owner_speak']);
        $result['user_photo'] = "http://m.uzhuang.com/res/img/yonghu.png";
        }
        $result['nodeid']=28;
        $referno = $this->db->get_one('demand_referno','orderid="'.$order_id.'" and nodeid=28');
        if($referno['is_online']==0 || $referno['pay_schedult']==1){
        $result['pay']=$this->pays($order_id,28);
        }else{
        $result['pay']=null;
        }
        $result['message'] = $this->get_message($order_id,28);
        //echo "<pre>";print_r($result);exit;
       return $result;
    }
    //瓦木材料验收
    public function result10(){
        $result=array();
        $resu=array();
        $yonghu=array();
        $title=array();
        $titles=array();
        $order_id=$GLOBALS['orderid'];
        $res = $this->db->get_one('day_log',array('orderid'=>$order_id,'nodeid'=>29,'isPublish'=>'发布'),"check_detail,check_waterdetail,check_other,photo,recphoto,nodename,addtime,content,owner_speak");
        //$pinglun =$this->db->get_list('log_evaluate',"orderid=2295 and nodeid=17",'*',0,1000,$page,'id DESC');
        $result=  $this->db->get_one('demand_track',array('orderid'=>$order_id,'nodeid'=>29),"addtime,col8,col9");
        $result['nodename']=$res['nodename'];
        $resu['check_other']=string2array($res['check_other']);
        $arr=array();
        foreach ($resu as $key => $value) {
            foreach ($value as $ke => $valu) {
                if(!empty($valu['img_yse'])){
                $arr[]=$valu['img_yse'];
              }
            } 
        }
        if(!empty($arr)){
        foreach ($arr as $key => $value) {
          $a=explode(',',$value);
         foreach ($a as $kes => $vals) {
          if(!empty($vals)){
           $photo[]="http://www.uzhuang.com/image/pic_230/".$vals;
           $photos[]="http://www.uzhuang.com/image/pic_800/".$vals;
          }
         }
        }
        }else{
          $photo[]=array();
          $photos[]=array();
        }
        $resu['recphoto']=unserialize($res['recphoto']);
        if(!empty($resu['recphoto'])){
            foreach ($resu['recphoto'] as $ke => $va) {
                $recphoto[]="http://www.uzhuang.com/image/pic_230/".$va;
                $recphotos[]="http://www.uzhuang.com/image/pic_800/".$va;
            }
        }else{
            $recphoto[]=array();
            $recphotos[]=array();
        }
        //echo "<pre>";print_r($photos);exit;
        $result['photo']=array_slice(array_values(array_filter(array_merge($recphoto,$photo))),0,9);
        $result['photos']=array_slice(array_values(array_filter(array_merge($recphotos,$photos))),0,9);
        $result['check_detail']=string2array($res['check_detail']);
        foreach ($result['check_detail'] as $ke => $val) {
                if($val['qua']=='合格') {
                   $titles[]=$val['title'];
                    if(!empty($val['img_yse'])) {
                      $img_yse=explode(',',$val['img_yse']);
                      $result['check_detail'][$ke]['img_yse'] = array_filter($img_yse);
                      foreach ($result['check_detail'][$ke]['img_yse'] as $mk => $mv) {
                          $result['check_detail'][$ke]['img_yse'][$mk] = "http://www.uzhuang.com/image/pic_230/".$mv;
                          $result['check_detail'][$ke]['img_yses'][$mk] = "http://www.uzhuang.com/image/pic_800/".$mv;
                      }
                    }
                    if($val['qua']=='合格' && $val['img_yse']==''){
                            $title[]=$val['title'];
                    }
                    if($result['check_detail'][$ke]['img_yse']){
                       $result['check_detail']['qualified'][] = $result['check_detail'][$ke];
                    }
                    unset($result['check_detail'][$ke]);
                }else{
                    if(!empty($val['img_yse'])) {
                      $img_yse=explode(',',$val['img_yse']);
                      $result['check_detail'][$ke]['img_yse'] = array_filter($img_yse);
                      foreach ($result['check_detail'][$ke]['img_yse'] as $mk => $mv) {
                          $result['check_detail'][$ke]['img_yse'][$mk] = "http://www.uzhuang.com/image/pic_230/".$mv;
                          $result['check_detail'][$ke]['img_yses'][$mk] = "http://www.uzhuang.com/image/pic_800/".$mv;
                      }
                    }
                    if(!empty($val['chan_Srcs'])){
                      $chan_Srcs=explode(',',$val['chan_Srcs']);
                      $result['check_detail'][$ke]['chan_Srcs'] =array_filter($chan_Srcs);
                      foreach ($result['check_detail'][$ke]['chan_Srcs'] as $ks => $vs) {
                          $result['check_detail'][$ke]['chan_Srcs'][$ks] = "http://www.uzhuang.com/image/pic_230/".$vs;
                          $result['check_detail'][$ke]['chan_Srcss'][$ks] = "http://www.uzhuang.com/image/pic_800/".$vs;
                      }
                    }else{
                          $result['check_detail'][$ke]['chan_Srcs'] =1;
                    }
                    $result['check_detail']['unqualified'][] = $result['check_detail'][$ke];
                    unset($result['check_detail'][$ke]);
                }                
            }
        $result['count']=count($title);
        $result['sum']=count($titles);
        //$result['check_waterdetail']=string2array($res['check_waterdetail']);
        //$result['addtimes']=$res['addtime'];
        $result['gjphoto']=$this->gjphoto($order_id);
        $result['content']=strip_tags($res['content']);
        if($res['owner_speak']){
        $result['owner_speak']=strip_tags($res['owner_speak']);
        $result['user_photo'] = "http://m.uzhuang.com/res/img/yonghu.png";
        }
        $result['nodeid']=29;
        $referno = $this->db->get_one('demand_referno','orderid="'.$order_id.'" and nodeid=29');
        if($referno['is_online']==0 || $referno['pay_schedult']==1){
        $result['pay']=$this->pays($order_id,29);
        }else{
        $result['pay']=null;
        }
        $result['message'] = $this->get_message($order_id,29);
        //echo "<pre>";print_r($result);exit;
       return $result;
    }
    //瓦木工程验收
    public function result11(){
        $result=array();
        $resu=array();
        $yonghu=array();
        $title=array();
        $titles=array();
        $order_id=$GLOBALS['orderid'];
        $res = $this->db->get_one('day_log',array('orderid'=>$order_id,'nodeid'=>31,'isPublish'=>'发布'),"check_detail,check_waterdetail,check_other,photo,recphoto,nodename,addtime,content,owner_speak");
        //$pinglun =$this->db->get_list('log_evaluate',"orderid=2295 and nodeid=17",'*',0,1000,$page,'id DESC');
        $result=  $this->db->get_one('demand_track',array('orderid'=>$order_id,'nodeid'=>31),"addtime,col8,col9");
        $company = $this->db->get_one('demand_company',array('orderid'=>$order_id,'isselected'=>'是'),"companyname,companyid",0,"id desc");
        $co=$this->db->get_one('company',"`id`='".$company['companyid']."'",'avg_total');
        if(!empty($co['avg_total']) && $co['avg_total']!=0){
            $result['avg_total']=$co['avg_total'];
        }else{
            $result['avg_total']='5.0';
        }
        $result['gj_total']='5.0';
        $result['nodename']=$res['nodename'];
        $resu['check_other']=string2array($res['check_other']);
        $arr=array();
        $arrs=array();
        foreach ($resu as $key => $value) {
            foreach ($value as $ke => $valu) {
                $arr[]=$valu['img_yse'];
                $arrs[]=$valu['chan_Srcs'];
            } 
        }
        $bb=array_filter($arr);
        if(!empty($bb)){
        foreach ($bb as $key => $value) {
          $a=explode(',',$value);
         foreach ($a as $kes => $vals) {
          if(!empty($vals)){
           $photo[]="http://www.uzhuang.com/image/pic_230/".$vals;
           $photos[]="http://www.uzhuang.com/image/pic_800/".$vals;
          }
         }
        }
        }else{
          $photo[]=array();
          $photos[]=array(); 
        }
        $cc=array_filter($arrs);
        if(!empty($cc)){
        foreach ($cc as $ke => $val) {
          $a=explode(',',$val);
         foreach ($a as $kess => $valss) {
          if(!empty($valss)){
           $photoss[]="http://www.uzhuang.com/image/pic_230/".$valss;
           $photosss[]="http://www.uzhuang.com/image/pic_800/".$valss;
          }
         }
        }
        }else{
          $photoss[]=array();
          $photosss[]=array();  
        }
        $resu['recphoto']=unserialize($res['recphoto']);
        if(!empty($resu['recphoto'])){
            foreach ($resu['recphoto'] as $ke => $va) {
                $recphoto[]="http://www.uzhuang.com/image/pic_230/".$va;
                $recphotos[]="http://www.uzhuang.com/image/pic_800/".$va;
            }
        }else{
            $recphoto[]=array();
            $recphotos[]=array();
        }
        $result['photo']=array_slice(array_values(array_filter(array_merge($recphoto,$photo,$photoss))),0,9);
        $result['photos']=array_slice(array_values(array_filter(array_merge($recphotos,$photos,$photosss))),0,9);
        $result['check_detail']=string2array($res['check_detail']);
        foreach ($result['check_detail'] as $ke => $val) {
                if($val['qua']=='合格') {
                            $titles[]=$val['title'];
                    if(!empty($val['img_yse'])) {
                      $img_yse=explode(',',$val['img_yse']);
                      $result['check_detail'][$ke]['img_yse'] = array_filter($img_yse);
                      foreach ($result['check_detail'][$ke]['img_yse'] as $mk => $mv) {
                          $result['check_detail'][$ke]['img_yse'][$mk] = "http://www.uzhuang.com/image/pic_230/".$mv;
                          $result['check_detail'][$ke]['img_yses'][$mk] = "http://www.uzhuang.com/image/pic_800/".$mv;
                      }
                    }
                    if($val['qua']=='合格' && $val['img_yse']==''){
                            $title[]=$val['title'];
                    }
                    if($result['check_detail'][$ke]['img_yse']){
                    $result['check_detail']['qualified'][] = $result['check_detail'][$ke];
                    }
                    unset($result['check_detail'][$ke]);
                }else{
                    if(!empty($val['img_yse'])) {
                      $img_yse=explode(',',$val['img_yse']);
                      $result['check_detail'][$ke]['img_yse'] = array_filter($img_yse);
                      foreach ($result['check_detail'][$ke]['img_yse'] as $mk => $mv) {
                          $result['check_detail'][$ke]['img_yse'][$mk] = "http://www.uzhuang.com/image/pic_230/".$mv;
                          $result['check_detail'][$ke]['img_yses'][$mk] = "http://www.uzhuang.com/image/pic_800/".$mv;
                      }
                    }
                    if(!empty($val['chan_Srcs'])){
                      $chan_Srcs=explode(',',$val['chan_Srcs']);
                      $result['check_detail'][$ke]['chan_Srcs'] =array_filter($chan_Srcs);
                      foreach ($result['check_detail'][$ke]['chan_Srcs'] as $ks => $vs) {
                          $result['check_detail'][$ke]['chan_Srcs'][$ks] = "http://www.uzhuang.com/image/pic_230/".$vs;
                          $result['check_detail'][$ke]['chan_Srcss'][$ks] = "http://www.uzhuang.com/image/pic_800/".$vs;
                      }
                    }else{
                          $result['check_detail'][$ke]['chan_Srcs'] =1;
                    }
                    $result['check_detail']['unqualified'][] = $result['check_detail'][$ke];
                    unset($result['check_detail'][$ke]);
                }                
            }
        $result['count']=count($title);
        $result['sum']=count($titles);
        //$result['check_waterdetail']=string2array($res['check_waterdetail']);
        //$result['addtimes']=$res['addtime'];
        $result['gjphoto']=$this->gjphoto($order_id);
        $result['content']=strip_tags($res['content']);
        if($res['owner_speak']){
        $result['owner_speak']=strip_tags($res['owner_speak']);
        $result['user_photo'] = "http://m.uzhuang.com/res/img/yonghu.png";
        }
        $result['nodeid']=31;
        $referno = $this->db->get_one('demand_referno','orderid="'.$order_id.'" and nodeid=31');
        if($referno['is_online']==0 || $referno['pay_schedult']==1){
        $result['pay']=$this->pays($order_id,31);
        }else{
        $result['pay']=null;
        }
        $result['message'] = $this->get_message($order_id,31);
        $result['grade'] = $this->grade($order_id,31);
        //echo "<pre>";print_r($result);exit; 
       return $result;
    }
    //油漆材料验收
    public function result12(){
        $result=array();
        $resu=array();
        $yonghu=array();
        $title=array();
        $titles=array();
        $order_id=$GLOBALS['orderid'];
        $res = $this->db->get_one('day_log',array('orderid'=>$order_id,'nodeid'=>33,'isPublish'=>'发布'),"check_detail,check_waterdetail,check_other,photo,recphoto,nodename,addtime,content,owner_speak");
        //$pinglun =$this->db->get_list('log_evaluate',"orderid=2295 and nodeid=17",'*',0,1000,$page,'id DESC');
        $result=  $this->db->get_one('demand_track',array('orderid'=>$order_id,'nodeid'=>33),"addtime,col8,col9");
        $result['nodename']=$res['nodename'];
        $resu['check_other']=string2array($res['check_other']);
        $arr=array();
        $arrs=array();
        foreach ($resu as $key => $value) {
            foreach ($value as $ke => $valu) {
                $arr[]=$valu['img_yse'];
                $arrs[]=$valu['chan_Srcs'];
            } 
        }
        $bb=array_filter($arr);
        if(!empty($bb)){
        foreach ($bb as $key => $value) {
          $a=explode(',',$value);
         foreach ($a as $kes => $vals) {
          if(!empty($vals)){
           $photo[]="http://www.uzhuang.com/image/pic_230/".$vals;
           $photos[]="http://www.uzhuang.com/image/pic_800/".$vals;
          }
         }
        }
        }else{
          $photo[]=array();
          $photos[]=array(); 
        }
        $cc=array_filter($arrs);
        if(!empty($cc)){
        foreach ($cc as $ke => $val) {
          $a=explode(',',$val);
         foreach ($a as $kess => $valss) {
          if(!empty($valss)){
           $photoss[]="http://www.uzhuang.com/image/pic_230/".$valss;
           $photosss[]="http://www.uzhuang.com/image/pic_800/".$valss;
          }
         }
        }
        }else{
          $photoss[]=array();
          $photosss[]=array(); 
        }
        $resu['recphoto']=unserialize($res['recphoto']);
        if(!empty($resu['recphoto'])){
            foreach ($resu['recphoto'] as $ke => $va) {
                $recphoto[]="http://www.uzhuang.com/image/pic_230/".$va;
                $recphotos[]="http://www.uzhuang.com/image/pic_800/".$va;
            }
        }else{
            $recphoto[]=array();
            $recphotos[]=array();
        }
        $result['photo']=array_slice(array_values(array_filter(array_merge($recphoto,$photo,$photoss))),0,9);
        $result['photos']=array_slice(array_values(array_filter(array_merge($recphotos,$photos,$photosss))),0,9);
        $result['check_detail']=string2array($res['check_detail']);
        foreach ($result['check_detail'] as $ke => $val) {
                if($val['qua']=='合格') {
                        $titles[]=$val['title'];
                    if(!empty($val['img_yse'])) {
                      $img_yse=explode(',',$val['img_yse']);
                      $result['check_detail'][$ke]['img_yse'] = array_filter($img_yse);
                      foreach ($result['check_detail'][$ke]['img_yse'] as $mk => $mv) {
                          $result['check_detail'][$ke]['img_yse'][$mk] = "http://www.uzhuang.com/image/pic_230/".$mv;
                          $result['check_detail'][$ke]['img_yses'][$mk] = "http://www.uzhuang.com/image/pic_800/".$mv;
                      }
                    }
                    if($val['qua']=='合格' && $val['img_yse']==''){
                            $title[]=$val['title'];
                    }
                    if($result['check_detail'][$ke]['img_yse']){
                        $result['check_detail']['qualified'][] = $result['check_detail'][$ke];
                    }
                    unset($result['check_detail'][$ke]);
                }else{
                    if(!empty($val['img_yse'])) {
                      $img_yse=explode(',',$val['img_yse']);
                      $result['check_detail'][$ke]['img_yse'] = array_filter($img_yse);
                      foreach ($result['check_detail'][$ke]['img_yse'] as $mk => $mv) {
                          $result['check_detail'][$ke]['img_yse'][$mk] = "http://www.uzhuang.com/image/pic_230/".$mv;
                          $result['check_detail'][$ke]['img_yses'][$mk] = "http://www.uzhuang.com/image/pic_800/".$mv;
                      }
                    }
                    if(!empty($val['chan_Srcs'])){
                      $chan_Srcs=explode(',',$val['chan_Srcs']);
                      $result['check_detail'][$ke]['chan_Srcs'] =array_filter($chan_Srcs);
                      foreach ($result['check_detail'][$ke]['chan_Srcs'] as $ks => $vs) {
                          $result['check_detail'][$ke]['chan_Srcs'][$ks] = "http://www.uzhuang.com/image/pic_230/".$vs;
                           $result['check_detail'][$ke]['chan_Srcss'][$ks] = "http://www.uzhuang.com/image/pic_800/".$vs;
                      }
                    }else{
                          $result['check_detail'][$ke]['chan_Srcs'] =1;
                    }
                    $result['check_detail']['unqualified'][] = $result['check_detail'][$ke];
                    unset($result['check_detail'][$ke]);
                }                
            }
        $result['count']=count($title);
        $result['sum']=count($titles);
        //$result['check_waterdetail']=string2array($res['check_waterdetail']);
        //$result['addtimes']=$res['addtime'];
        $result['gjphoto']=$this->gjphoto($order_id);
        $result['content']=strip_tags($res['content']);
        if($res['owner_speak']){
        $result['owner_speak']=strip_tags($res['owner_speak']);
        $result['user_photo'] = "http://m.uzhuang.com/res/img/yonghu.png";
        }
        $result['nodeid']=33;
        $referno = $this->db->get_one('demand_referno','orderid="'.$order_id.'" and nodeid=33');
        if($referno['is_online']==0 || $referno['pay_schedult']==1){
        $result['pay']=$this->pays($order_id,33);
        }else{
        $result['pay']=null;
        }
        $result['message'] = $this->get_message($order_id,33);
       return $result;
    }
    //油漆工程验收
    public function result13(){
        $result=array();
        $resu=array();
        $yonghu=array();
        $title=array();
        $titles=array();
        $order_id=$GLOBALS['orderid'];
        $res = $this->db->get_one('day_log',array('orderid'=>$order_id,'nodeid'=>35,'isPublish'=>'发布'),"check_detail,check_waterdetail,check_other,photo,recphoto,nodename,addtime,content,owner_speak");
        //$pinglun =$this->db->get_list('log_evaluate',"orderid=2295 and nodeid=17",'*',0,1000,$page,'id DESC');
        $result=  $this->db->get_one('demand_track',array('orderid'=>$order_id,'nodeid'=>35),"addtime,col8,col9");
        $company = $this->db->get_one('demand_company',array('orderid'=>$order_id,'isselected'=>'是'),"companyname,companyid",0,"id desc");
        $co=$this->db->get_one('company',"`id`='".$company['companyid']."'",'avg_total');
        if(!empty($co['avg_total']) && $co['avg_total']!=0){
            $result['avg_total']=$co['avg_total'];
        }else{
            $result['avg_total']='5.0';
        }
        $result['gj_total']='5.0';
        $result['nodename']=$res['nodename'];
        $resu['check_other']=string2array($res['check_other']);
        $arr=array();
        $arrs=array();
        foreach ($resu as $key => $value) {
            foreach ($value as $ke => $valu) {
                $arr[]=$valu['img_yse'];
                $arrs[]=$valu['chan_Srcs'];
            } 
        }
        $bb=array_filter($arr);
        if(!empty($bb)){
        foreach ($bb as $key => $value) {
          $a=explode(',',$value);
         foreach ($a as $kes => $vals) {
          if(!empty($vals)){
           $photo[]="http://www.uzhuang.com/image/pic_230/".$vals;
           $photos[]="http://www.uzhuang.com/image/pic_800/".$vals;
          }
         }
        }
        }else{
          $photo[]=array();
          $photos[]=array(); 
        }
        $cc=array_filter($arrs);
        if(!empty($cc)){
        foreach ($cc as $ke => $val) {
          $a=explode(',',$val);
         foreach ($a as $kess => $valss) {
          if(!empty($valss)){
           $photoss[]="http://www.uzhuang.com/image/pic_230/".$valss;
           $photosss[]="http://www.uzhuang.com/image/pic_800/".$valss;
          }
         }
        }
        }else{
          $photoss[]=array();
          $photosss[]=array();
        }
        $resu['recphoto']=unserialize($res['recphoto']);
        if(!empty($resu['recphoto'])){
            foreach ($resu['recphoto'] as $ke => $va) {
                $recphoto[]="http://www.uzhuang.com/image/pic_230/".$va;
                $recphotos[]="http://www.uzhuang.com/image/pic_800/".$va;
            }
        }else{
            $recphoto[]=array();
            $recphotos[]=array();
        }
        $result['photo']=array_slice(array_values(array_filter(array_merge($recphoto,$photo,$photoss))),0,9);
        $result['photos']=array_slice(array_values(array_filter(array_merge($recphotos,$photos,$photosss))),0,9);
        $result['check_detail']=string2array($res['check_detail']);
        foreach ($result['check_detail'] as $ke => $val) {
                if($val['qua']=='合格') {
                    $titles[]=$val['title'];
                    if(!empty($val['img_yse'])) {
                      $img_yse=explode(',',$val['img_yse']);
                      $result['check_detail'][$ke]['img_yse'] = array_filter($img_yse);
                      foreach ($result['check_detail'][$ke]['img_yse'] as $mk => $mv) {
                          $result['check_detail'][$ke]['img_yse'][$mk] = "http://www.uzhuang.com/image/pic_230/".$mv;
                          $result['check_detail'][$ke]['img_yses'][$mk] = "http://www.uzhuang.com/image/pic_800/".$mv;
                      }
                    }
                    if($val['qua']=='合格' && $val['img_yse']==''){
                            $title[]=$val['title'];
                    }
                    if($result['check_detail'][$ke]['img_yse']){
                      $result['check_detail']['qualified'][] = $result['check_detail'][$ke];
                    }
                    unset($result['check_detail'][$ke]);
                }else{
                    if(!empty($val['img_yse'])) {
                      $img_yse=explode(',',$val['img_yse']);
                      $result['check_detail'][$ke]['img_yse'] = array_filter($img_yse);
                      foreach ($result['check_detail'][$ke]['img_yse'] as $mk => $mv) {
                          $result['check_detail'][$ke]['img_yse'][$mk] = "http://www.uzhuang.com/image/pic_230/".$mv;
                          $result['check_detail'][$ke]['img_yses'][$mk] = "http://www.uzhuang.com/image/pic_800/".$mv;
                      }
                    }
                    if(!empty($val['chan_Srcs'])){
                      $chan_Srcs=explode(',',$val['chan_Srcs']);
                      $result['check_detail'][$ke]['chan_Srcs'] =array_filter($chan_Srcs);
                      foreach ($result['check_detail'][$ke]['chan_Srcs'] as $ks => $vs) {
                          $result['check_detail'][$ke]['chan_Srcs'][$ks] = "http://www.uzhuang.com/image/pic_230/".$vs;
                          $result['check_detail'][$ke]['chan_Srcss'][$ks] = "http://www.uzhuang.com/image/pic_800/".$vs;
                      }
                    }else{
                          $result['check_detail'][$ke]['chan_Srcs'] =1;
                    }
                    $result['check_detail']['unqualified'][] = $result['check_detail'][$ke];
                    unset($result['check_detail'][$ke]);
                }                
            }
        $result['count']=count($title);
        $result['sum']=count($titles);
        //$result['check_waterdetail']=string2array($res['check_waterdetail']);
        //$result['addtimes']=$res['addtime'];
        $result['gjphoto']=$this->gjphoto($order_id);
        $result['content']=strip_tags($res['content']);
        if($res['owner_speak']){
        $result['owner_speak']=strip_tags($res['owner_speak']);
        $result['user_photo'] = "http://m.uzhuang.com/res/img/yonghu.png";
        }
        $result['nodeid']=35;
        $referno = $this->db->get_one('demand_referno','orderid="'.$order_id.'" and nodeid=35');
        if($referno['is_online']==0 || $referno['pay_schedult']==1){
        $result['pay']=$this->pays($order_id,35);
        }else{
        $result['pay']=null;
        }
        $result['message'] = $this->get_message($order_id,35);
        $result['grade'] = $this->grade($order_id,35);
       return $result;
    }
    //安装工程验收
    public function result14(){
        $result=array();
        $resu=array();
        $yonghu=array();
        $title=array();
        $titles=array();
        $order_id=$GLOBALS['orderid'];
        $res = $this->db->get_one('day_log',array('orderid'=>$order_id,'nodeid'=>36,'isPublish'=>'发布'),"check_detail,check_waterdetail,check_other,photo,recphoto,nodename,addtime,content,owner_speak");
        //$pinglun =$this->db->get_list('log_evaluate',"orderid=2295 and nodeid=17",'*',0,1000,$page,'id DESC');
        $result=  $this->db->get_one('demand_track',array('orderid'=>$order_id,'nodeid'=>36),"addtime,col8,col9");
        $company = $this->db->get_one('demand_company',array('orderid'=>$order_id,'isselected'=>'是'),"companyname,companyid",0,"id desc");
        $co=$this->db->get_one('company',"`id`='".$company['companyid']."'",'avg_total');
        if(!empty($co['avg_total']) && $co['avg_total']!=0){
            $result['avg_total']=$co['avg_total'];
        }else{
            $result['avg_total']='5.0';
        }
        $result['gj_total']='5.0';
        $result['nodename']=$res['nodename'];
        $resu['check_other']=string2array($res['check_other']);
        $arr=array();
        $arrs=array();
        foreach ($resu as $key => $value) {
            foreach ($value as $ke => $valu) {
                $arr[]=$valu['img_yse'];
                $arrs[]=$valu['chan_Srcs'];
            } 
        }
        $bb=array_filter($arr);
        if(!empty($bb)){
        foreach ($bb as $key => $value) {
          $a=explode(',',$value);
         foreach ($a as $kes => $vals) {
          if(!empty($vals)){
           $photo[]="http://www.uzhuang.com/image/pic_230/".$vals;
           $photos[]="http://www.uzhuang.com/image/pic_800/".$vals;
          }
         }
        }
        }else{
          $photo[]=array();
          $photos[]=array(); 
        }
        $cc=array_filter($arrs);
        if(!empty($cc)){
        foreach ($cc as $ke => $val) {
          $a=explode(',',$val);
         foreach ($a as $kess => $valss) {
          if(!empty($valss)){
           $photoss[]="http://www.uzhuang.com/image/pic_230/".$valss;
           $photosss[]="http://www.uzhuang.com/image/pic_800/".$valss;
          }
         }
        }
        }else{
          $photoss[]=array();
          $photosss[]=array(); 
        }
        $resu['recphoto']=unserialize($res['recphoto']);
        if(!empty($resu['recphoto'])){
            foreach ($resu['recphoto'] as $ke => $va) {
                $recphoto[]="http://www.uzhuang.com/image/pic_230/".$va;
                $recphotos[]="http://www.uzhuang.com/image/pic_800/".$va;
            }
        }else{
            $recphoto[]=array();
            $recphotos[]=array();
        }
        $result['photo']=array_slice(array_values(array_filter(array_merge($recphoto,$photo,$photoss))),0,9);
        $result['photos']=array_slice(array_values(array_filter(array_merge($recphotos,$photos,$photosss))),0,9);
        $result['check_detail']=string2array($res['check_detail']);
        foreach ($result['check_detail'] as $ke => $val) {
                if($val['qua']=='合格') {
                    $titles[]=$val['title'];
                    if(!empty($val['img_yse'])) {
                      $img_yse=explode(',',$val['img_yse']);
                      $result['check_detail'][$ke]['img_yse'] = array_filter($img_yse);
                      foreach ($result['check_detail'][$ke]['img_yse'] as $mk => $mv) {
                          $result['check_detail'][$ke]['img_yse'][$mk] = "http://www.uzhuang.com/image/pic_230/".$mv;
                          $result['check_detail'][$ke]['img_yses'][$mk] = "http://www.uzhuang.com/image/pic_800/".$mv;
                      }
                    }
                    if($val['qua']=='合格' && $val['img_yse']==''){
                            $title[]=$val['title'];
                    }
                    if($result['check_detail'][$ke]['img_yse']){
                      $result['check_detail']['qualified'][] = $result['check_detail'][$ke];
                    }
                    unset($result['check_detail'][$ke]);
                }else{
                    if(!empty($val['img_yse'])) {
                      $img_yse=explode(',',$val['img_yse']);
                      $result['check_detail'][$ke]['img_yse'] = array_filter($img_yse);
                      foreach ($result['check_detail'][$ke]['img_yse'] as $mk => $mv) {
                          $result['check_detail'][$ke]['img_yse'][$mk] = "http://www.uzhuang.com/image/pic_230/".$mv;
                          $result['check_detail'][$ke]['img_yses'][$mk] = "http://www.uzhuang.com/image/pic_800/".$mv;
                      }
                    }
                    if(!empty($val['chan_Srcs'])){
                      $chan_Srcs=explode(',',$val['chan_Srcs']);
                      $result['check_detail'][$ke]['chan_Srcs'] =array_filter($chan_Srcs);
                      foreach ($result['check_detail'][$ke]['chan_Srcs'] as $ks => $vs) {
                          $result['check_detail'][$ke]['chan_Srcs'][$ks] = "http://www.uzhuang.com/image/pic_230/".$vs;
                          $result['check_detail'][$ke]['chan_Srcss'][$ks] = "http://www.uzhuang.com/image/pic_800/".$vs;
                      }
                    }else{
                          $result['check_detail'][$ke]['chan_Srcs'] =1;
                    }
                    $result['check_detail']['unqualified'][] = $result['check_detail'][$ke];
                    unset($result['check_detail'][$ke]);
                }                
            }
        $result['count']=count($title);
        $result['sum']=count($titles);
        //$result['check_waterdetail']=string2array($res['check_waterdetail']);
        //$result['addtimes']=$res['addtime'];
        $result['gjphoto']=$this->gjphoto($order_id);
        $result['content']=strip_tags($res['content']);
        if($res['owner_speak']){
        $result['owner_speak']=strip_tags($res['owner_speak']);
        $result['user_photo'] = "http://m.uzhuang.com/res/img/yonghu.png";
        }
        $result['nodeid']=36;
        $referno = $this->db->get_one('demand_referno','orderid="'.$order_id.'" and nodeid=36');
        if($referno['is_online']==0 || $referno['pay_schedult']==1){
        $result['pay']=$this->pays($order_id,36);
        }else{
        $result['pay']=null;
        }
        $result['message'] = $this->get_message($order_id,36);
       return $result;
    }
    //竣工验收
    public function result15(){
        $result=array();
        $resu=array();
        $yonghu=array();
        $arrs=array();
        $order_id=$GLOBALS['orderid'];
        $res = $this->db->get_one('day_log',array('orderid'=>$order_id,'nodeid'=>37,'isPublish'=>'发布'),"check_detail,check_waterdetail,check_other,photo,recphoto,nodename,addtime,content,owner_speak");
        //$pinglun =$this->db->get_list('log_evaluate',"orderid=2295 and nodeid=17",'*',0,1000,$page,'id DESC');
        $result=  $this->db->get_one('demand_track',array('orderid'=>$order_id,'nodeid'=>37),"addtime,col8,col9");
        $company = $this->db->get_one('demand_company',array('orderid'=>$order_id,'isselected'=>'是'),"companyname,companyid",0,"id desc");
        $co=$this->db->get_one('company',"`id`='".$company['companyid']."'",'avg_total');
        if(!empty($co['avg_total']) && $co['avg_total']!=0){
            $result['avg_total']=$co['avg_total'];
        }else{
            $result['avg_total']='5.0';
        }
        $result['gj_total']='5.0';
        $result['nodename']=$res['nodename'];
        $resu['check_other']=string2array($res['check_other']);
        $results['check_other']=string2array($res['check_other']);
        foreach ($results['check_other'] as $keys => $values) {
            if($values['img_yse']){
                $arrs[]=$values;
            }
        }
        $result['check_other']=$arrs;
        foreach ($result['check_other'] as $ke => $val) {
                    if(!empty($val['img_yse'])) {
                      $img_yse=explode(',',$val['img_yse']);
                      $result['check_other'][$ke]['img_yse'] = array_filter($img_yse);
                      foreach ($result['check_other'][$ke]['img_yse'] as $mk => $mv) {
                          $result['check_other'][$ke]['img_yse'][$mk] = "http://www.uzhuang.com/image/pic_230/".$mv;
                          $result['check_other'][$ke]['img_yses'][$mk] = "http://www.uzhuang.com/image/pic_800/".$mv;
                      }
                    }
        }
        $arr=array();
        foreach ($resu as $key => $value) {
            foreach ($value as $ke => $valu) {
                if(!empty($valu['img_yse'])){
                $arr[]=$valu['img_yse'];
                }
            } 
        }
        if(!empty($arr)){
        foreach ($arr as $key => $value) {
        $a=explode(',',$value);
         foreach ($a as $kes => $vals) {
           if(!empty($vals)){
            $photo[]="http://www.uzhuang.com/image/pic_230/".$vals;
            $photos[]="http://www.uzhuang.com/image/pic_800/".$vals;
           //$result['check_other_photo'][]="http://www.uzhuang.com/image/pic_230/".$vals;
           }
         }
        }
        }else{
          $photo[]=array();
          $photos[]=array();
        }
        $resu['recphoto']=unserialize($res['recphoto']);
        if(!empty($resu['recphoto'])){
            foreach ($resu['recphoto'] as $ke => $va) {
                $recphoto[]="http://www.uzhuang.com/image/pic_230/".$va;
                $recphotos[]="http://www.uzhuang.com/image/pic_800/".$va;
            }
            $result['gjsphoto']=$recphoto;
        }else{
            $recphoto[]=array();
            $recphotos[]=array();
        }
        //echo "<pre>";print_r($photos);exit;
        $result['photo']=array_slice(array_values(array_filter(array_merge($recphoto,$photo))),0,9);
        $result['photos']=array_slice(array_values(array_filter(array_merge($recphotos,$photos))),0,9);
        $result['check_detail']=string2array($res['check_detail']);
        foreach ($result['check_detail'] as $ke => $val) {
                //if ($val['qua']=='合格') {
                    if(!empty($val['img_yse'])) {
                      $img_yse=explode(',',$val['img_yse']);
                      $result['check_detail'][$ke]['img_yse'] = array_filter($img_yse);
                      foreach ($result['check_detail'][$ke]['img_yse'] as $mk => $mv) {
                          $result['check_detail'][$ke]['img_yse'][$mk] = "http://www.uzhuang.com/image/pic_230/".$mv;
                          $result['check_detail'][$ke]['img_yses'][$mk] = "http://www.uzhuang.com/image/pic_800/".$mv;
                      }
                    }
                    if($val['qua']=='合格' && $val['img_yse']==''){
                            $title[]=$val['title'];
                    }
                   /* $result['check_detail']['qualified'][] = $result['check_detail'][$ke];
                    unset($result['check_detail'][$ke]);
                }else{
                    if (!empty($val['img_yse'])) {
                      $img_yse=explode(',',$val['img_yse']);
                      $result['check_detail'][$ke]['img_yse'] = array_filter($img_yse);
                      foreach ($result['check_detail'][$ke]['img_yse'] as $mk => $mv) {
                          $result['check_detail'][$ke]['img_yse'][$mk] = "http://www.uzhuang.com/image/pic_230/".$mv;
                      }
                    }
                    if (!empty($val['chan_Srcs'])){
                      $chan_Srcs=explode(',',$val['chan_Srcs']);
                      $result['check_detail'][$ke]['chan_Srcs'] =array_filter($chan_Srcs);
                      foreach ($result['check_detail'][$ke]['chan_Srcs'] as $ks => $vs) {
                          $result['check_detail'][$ke]['chan_Srcs'][$ks] = "http://www.uzhuang.com/image/pic_230/".$vs;
                      }
                    }
                    $result['check_detail']['unqualified'][] = $result['check_detail'][$ke];
                    unset($result['check_detail'][$ke]);
                }                */
            }
            //exit;
        //$result['check_waterdetail']=string2array($res['check_waterdetail']);
        //$result['addtimes']=$res['addtime'];
        $result['gjphoto']=$this->gjphoto($order_id);
        $result['content']=strip_tags($res['content']);
        if($res['owner_speak']){
        $result['owner_speak']=strip_tags($res['owner_speak']);
        $result['user_photo'] = "http://m.uzhuang.com/res/img/yonghu.png";
        }
        $result['nodeid']=37;
        $referno = $this->db->get_one('demand_referno','orderid="'.$order_id.'" and nodeid=37');
        if($referno['is_online']==0 || $referno['pay_schedult']==1){
        $result['pay']=$this->pays($order_id,37);
        }else{
        $result['pay']=null;
        }
        $result['message'] = $this->get_message($order_id,37);
        $result['grade'] = $this->grade($order_id,37);
       return $result;
    }
    //第一次环保监测
    public function result16(){
        $result=array();
        $resu=array();
        $yonghu=array();
        $photos=array();
        $order_id=$GLOBALS['orderid'];
        $res = $this->db->get_one('day_log',array('orderid'=>$order_id,'nodeid'=>39,'isPublish'=>'发布'),"check_detail,check_waterdetail,check_other,photo,recphoto,nodename,addtime,content,owner_speak");
        $result=  $this->db->get_one('demand_track',array('orderid'=>$order_id,'nodeid'=>39),"addtime,col8,col7,remark");
        $result['nodename']=$res['nodename'];
        //$pinglun =$this->db->get_list('log_evaluate',"orderid=2295 and nodeid=17",'*',0,1000,$page,'id DESC');
        $resu['check_other']=string2array($res['check_other']);
        $arr=array();
        foreach ($resu as $key => $value) {
            foreach ($value as $ke => $valu) {
                if(!empty($valu['img_yse'])){
                $arr[]=$valu['img_yse'];
                }
            } 
        }
        if(!empty($arr)){
        foreach ($arr as $key => $value) {
          $a=explode(',',$value);
         foreach ($a as $kes => $vals) {
          if(!empty($vals)){
           $photo[]="http://www.uzhuang.com/image/pic_230/".$vals;
           $photos[]="http://www.uzhuang.com/image/pic_800/".$vals;
          }
         }
        }
        }else{
          $photo[]=array();
          $photos[]=array();  
        }
        $resu['recphoto']=unserialize($res['recphoto']);
        if(!empty($resu['recphoto'])){
            foreach ($resu['recphoto'] as $ke => $va) {
                $recphoto[]="http://www.uzhuang.com/image/pic_230/".$va;
                $recphotos[]="http://www.uzhuang.com/image/pic_800/".$va;
            }
        }else{
            $recphoto[]=array();
            $recphotos[]=array();
        }
        //echo "<pre>";print_r($photos);exit;
        $result['photo']=array_slice(array_values(array_filter(array_merge($recphoto,$photo))),0,9);
        $result['photos']=array_slice(array_values(array_filter(array_merge($recphotos,$photos))),0,9);
        $result['check_detail']=string2array($res['check_detail']);
        foreach ($result['check_detail'] as $ke => $val) {
                    if(!empty($val['img_yse'])) {
                      $img_yse=explode(',',$val['img_yse']);
                      $result['check_detail'][$ke]['img_yse'] = array_filter($img_yse);
                      foreach ($result['check_detail'][$ke]['img_yse'] as $mk => $mv) {
                          $result['check_detail'][$ke]['img_yse'][$mk] = "http://www.uzhuang.com/image/pic_230/".$mv;
                          $result['check_detail'][$ke]['img_yses'][$mk] = "http://www.uzhuang.com/image/pic_800/".$mv;
                      }
                    }
                    if($val['qua']=='合格' && $val['img_yse']==''){
                            $title[]=$val['title'];
                    }
                    if($result['check_detail'][$ke]['img_yse']){
                        $result['check_detail']['qualified'][] = $result['check_detail'][$ke];
                    }
                    unset($result['check_detail'][$ke]);
            }
        //$result['check_waterdetail']=string2array($res['check_waterdetail']);
        //$result['addtime']=$res['addtime'];
        $result['gjphoto']=$this->gjphoto($order_id);
        $result['content']=strip_tags($res['content']);
        if($res['owner_speak']){
        $result['owner_speak']=strip_tags($res['owner_speak']);
        $result['user_photo'] = "http://m.uzhuang.com/res/img/yonghu.png";
        }
        $result['nodeid']=39;
        $referno = $this->db->get_one('demand_referno','orderid="'.$order_id.'" and nodeid=39');
        if($referno['is_online']==0 || $referno['pay_schedult']==1){
        $result['pay']=$this->pays($order_id,39);
        }else{
        $result['pay']=null;
        }
        $result['message'] = $this->get_message($order_id,39);
       return $result;
    }
    //第二次环保监测
    public function result17(){
        $result=array();
        $resu=array();
        $yonghu=array();
        $photos=array();
        $order_id=$GLOBALS['orderid'];
        $res = $this->db->get_one('day_log',array('orderid'=>$order_id,'nodeid'=>43,'isPublish'=>'发布'),"check_detail,check_waterdetail,check_other,photo,recphoto,nodename,addtime,content,owner_speak");
        $result=  $this->db->get_one('demand_track',array('orderid'=>$order_id,'nodeid'=>43),"addtime,col8,col7,remark");
        $result['nodename']=$res['nodename'];
        //$pinglun =$this->db->get_list('log_evaluate',"orderid=2295 and nodeid=17",'*',0,1000,$page,'id DESC');
        $resu['check_other']=string2array($res['check_other']);
        $arr=array();
        foreach ($resu as $key => $value) {
            foreach ($value as $ke => $valu) {
                if(!empty($valu['img_yse'])){
                $arr[]=$valu['img_yse'];
                }
            } 
        }
        if(!empty($arr)){
        foreach ($arr as $key => $value) {
          $a=explode(',',$value);
         foreach ($a as $kes => $vals) {
          if(!empty($vals)){
           $photo[]="http://www.uzhuang.com/image/pic_230/".$vals;
           $photos[]="http://www.uzhuang.com/image/pic_800/".$vals;
          }
         }
        }
        }else{
          $photo[]=array();
          $photos[]=array(); 
        }
        $resu['recphoto']=unserialize($res['recphoto']);
        if(!empty($resu['recphoto'])){
            foreach ($resu['recphoto'] as $ke => $va) {
                $recphoto[]="http://www.uzhuang.com/image/pic_230/".$va;
                $recphotos[]="http://www.uzhuang.com/image/pic_800/".$va;
            }
        }else{
            $recphoto[]=array();
            $recphotos[]=array();
        }
        //echo "<pre>";print_r($photos);exit;
        $result['photo']=array_slice(array_values(array_filter(array_merge($recphoto,$photo))),0,9);
        $result['photos']=array_slice(array_values(array_filter(array_merge($recphotos,$photos))),0,9);
        $result['check_detail']=string2array($res['check_detail']);
        foreach ($result['check_detail'] as $ke => $val) {
                    if(!empty($val['img_yse'])) {
                      $img_yse=explode(',',$val['img_yse']);
                      $result['check_detail'][$ke]['img_yse'] = array_filter($img_yse);
                      foreach ($result['check_detail'][$ke]['img_yse'] as $mk => $mv) {
                          $result['check_detail'][$ke]['img_yse'][$mk] = "http://www.uzhuang.com/image/pic_230/".$mv;
                          $result['check_detail'][$ke]['img_yses'][$mk] = "http://www.uzhuang.com/image/pic_800/".$mv;
                      }
                    }
                    if($val['qua']=='合格' && $val['img_yse']==''){
                            $title[]=$val['title'];
                    }
                    if($result['check_detail'][$ke]['img_yse']){
                        $result['check_detail']['qualified'][] = $result['check_detail'][$ke];
                    }
                    unset($result['check_detail'][$ke]);     
            }
        //$result['check_waterdetail']=string2array($res['check_waterdetail']);
        //$result['addtime']=$res['addtime'];
        $result['gjphoto']=$this->gjphoto($order_id);
        $result['content']=strip_tags($res['content']);
        if($res['owner_speak']){
        $result['owner_speak']=strip_tags($res['owner_speak']);
        $result['user_photo'] = "http://m.uzhuang.com/res/img/yonghu.png";
        }
        $result['nodeid']=43;
        $referno = $this->db->get_one('demand_referno','orderid="'.$order_id.'" and nodeid=43');
        if($referno['is_online']==0 || $referno['pay_schedult']==1){
        $result['pay']=$this->pays($order_id,43);
        }else{
        $result['pay']=null;
        }
        $result['message'] = $this->get_message($order_id,43);
       return $result;
    }
    //维保
    public function result18(){
        $result=array();
        $resu=array();
        $yonghu=array();
        $order_id=$GLOBALS['orderid'];
        $res = $this->db->get_one('day_log',array('orderid'=>$order_id,'nodeid'=>45,'isPublish'=>'发布'),"check_detail,check_waterdetail,check_other,photo,recphoto,nodename,addtime,content,owner_speak");
        $result=  $this->db->get_one('demand_track',array('orderid'=>$order_id,'nodeid'=>45),"addtime,col8,col7");
        $date=strtotime($result['addtime']);
        $result['addtime'] =date('Y-m-d',$date);
        $result['nodename']=$res['nodename'];
        //$pinglun =$this->db->get_list('log_evaluate',"orderid=2295 and nodeid=17",'*',0,1000,$page,'id DESC');
        $resu['check_other']=string2array($res['check_other']);
        $arr=array();
        foreach ($resu as $key => $value) {
            foreach ($value as $ke => $valu) {
                if(!empty($valu['img_yse'])){
                $arr[]=$valu['img_yse'];
                }
            } 
        }
        if(!empty($arr)){
        foreach ($arr as $key => $value) {
          $a=explode(',',$value);
         foreach ($a as $kes => $vals) {
          if(!empty($vals)){
           $photo[]="http://www.uzhuang.com/image/pic_230/".$vals;
           $photos[]="http://www.uzhuang.com/image/pic_800/".$vals;
          }
         }
        }
        }else{
          $photo[]=array();
          $photos[]=array();  
        }
        $resu['recphoto']=unserialize($res['recphoto']);
        if(!empty($resu['recphoto'])){
            foreach ($resu['recphoto'] as $ke => $va) {
                $recphoto[]="http://www.uzhuang.com/image/pic_230/".$va;
                $recphotos[]="http://www.uzhuang.com/image/pic_800/".$va;
            }
        }else{
            $recphoto[]=array();
            $recphotos[]=array();
        }
        //echo "<pre>";print_r($photos);exit;
        $result['photo']=array_slice(array_values(array_filter(array_merge($recphoto,$photo))),0,9);
        $result['photos']=array_slice(array_values(array_filter(array_merge($recphotos,$photos))),0,9);
        $result['check_detail']=string2array($res['check_detail']);
        //$result['check_waterdetail']=string2array($res['check_waterdetail']);
        //$result['addtime']=$res['addtime'];
        $result['gjphoto']=$this->gjphoto($order_id);
        $result['content']=strip_tags($res['content']);
        if($res['owner_speak']){
        $result['owner_speak']=strip_tags($res['owner_speak']);
        $result['user_photo'] = "http://m.uzhuang.com/res/img/yonghu.png";
        }
        $result['nodeid']=45;
        $referno = $this->db->get_one('demand_referno','orderid="'.$order_id.'" and nodeid=45');
        if($referno['is_online']==0 || $referno['pay_schedult']==1){
        $result['pay']=$this->pays($order_id,45);
        }else{
        $result['pay']=null;
        }
        $result['ret'] = '维保期间未出现装修质量问题,您托管在优装美家的装修质保金,将支付给装修公司.';
        //echo "<pre>";print_r($result);exit;
        $result['message'] = $this->get_message($order_id,45);
       return $result;
    }
     //环保治理
    public function result19(){
        $result=array();
        $resu=array();
        $yonghu=array();
        $photos=array();
        $order_id=$GLOBALS['orderid'];
        $res = $this->db->get_one('day_log',array('orderid'=>$order_id,'nodeid'=>49,'isPublish'=>'发布'),"check_detail,check_waterdetail,check_other,photo,recphoto,nodename,addtime,content,owner_speak");
        $result=  $this->db->get_one('demand_track',array('orderid'=>$order_id,'nodeid'=>49),"addtime,col8");
        $result['nodename']=$res['nodename'];
        //$pinglun =$this->db->get_list('log_evaluate',"orderid=2295 and nodeid=17",'*',0,1000,$page,'id DESC');
        $resu['check_other']=string2array($res['check_other']);
        $arr=array();
        foreach ($resu as $key => $value) {
            foreach ($value as $ke => $valu) {
                if(!empty($valu['img_yse'])){
                $arr[]=$valu['img_yse'];
                }
            } 
        }
        if(!empty($arr)){
        foreach ($arr as $key => $value) {
          $a=explode(',',$value);
         foreach ($a as $kes => $vals) {
          if(!empty($vals)){
           $photo[]="http://www.uzhuang.com/image/pic_230/".$vals;
           $photos[]="http://www.uzhuang.com/image/pic_800/".$vals;
          }
         }
        }
        }else{
          $photo[]=array();
          $photos[]=array();  
        }
        $resu['recphoto']=unserialize($res['recphoto']);
        if(!empty($resu['recphoto'])){
            foreach ($resu['recphoto'] as $ke => $va) {
                $recphoto[]="http://www.uzhuang.com/image/pic_230/".$va;
                $recphotos[]="http://www.uzhuang.com/image/pic_800/".$va;
            }
        }else{
            $recphoto[]=array();
            $recphotos[]=array();
        }
        //echo "<pre>";print_r($photos);exit;
        $result['photo']=array_slice(array_values(array_filter(array_merge($recphoto,$photo))),0,9);
        $result['photos']=array_slice(array_values(array_filter(array_merge($recphotos,$photos))),0,9);
        $result['check_detail']=string2array($res['check_detail']);
        //$result['check_waterdetail']=string2array($res['check_waterdetail']);
        //$result['addtime']=$res['addtime'];
        $result['gjphoto']=$this->gjphoto($order_id);
        $result['content']=strip_tags($res['content']);
        if($res['owner_speak']){
        $result['owner_speak']=strip_tags($res['owner_speak']);
        $result['user_photo'] = "http://m.uzhuang.com/res/img/yonghu.png";
        }
        $result['nodeid']=49;
        $referno = $this->db->get_one('demand_referno','orderid="'.$order_id.'" and nodeid=49');
        if($referno['is_online']==0 || $referno['pay_schedult']==1){
        $result['pay']=$this->pays($order_id,49);
        }else{
        $result['pay']=null;
        }
        $result['message'] = $this->get_message($order_id,49);
        //echo "<pre>";print_r($result);exit;
       return $result;
    }
    //环保治理复测
    public function result20(){
        $result=array();
        $resu=array();
        $yonghu=array();
        $photos=array();
        $order_id=$GLOBALS['orderid'];
        $res = $this->db->get_one('day_log',array('orderid'=>$order_id,'nodeid'=>51,'isPublish'=>'发布'),"check_detail,check_waterdetail,check_other,photo,recphoto,nodename,addtime,content,owner_speak");
        $result=  $this->db->get_one('demand_track',array('orderid'=>$order_id,'nodeid'=>51),"addtime,col8,remark");
        $result['nodename']=$res['nodename'];
        //$pinglun =$this->db->get_list('log_evaluate',"orderid=2295 and nodeid=17",'*',0,1000,$page,'id DESC');
        $resu['check_other']=string2array($res['check_other']);
        $arr=array();
        foreach ($resu as $key => $value) {
            foreach ($value as $ke => $valu) {
                if(!empty($valu['img_yse'])){
                $arr[]=$valu['img_yse'];
                }
            } 
        }
        if(!empty($arr)){
        foreach ($arr as $key => $value) {
          $a=explode(',',$value);
         foreach ($a as $kes => $vals) {
          if(!empty($vals)){
           $photo[]="http://www.uzhuang.com/image/pic_230/".$vals;
           $photos[]="http://www.uzhuang.com/image/pic_800/".$vals;
          }
         }
        }
        }else{
          $photo[]=array();
          $photos[]=array();  
        }
        $resu['recphoto']=unserialize($res['recphoto']);
        if(!empty($resu['recphoto'])){
            foreach ($resu['recphoto'] as $ke => $va) {
                $recphoto[]="http://www.uzhuang.com/image/pic_230/".$va;
                $recphotos[]="http://www.uzhuang.com/image/pic_800/".$va;
            }
        }else{
            $recphoto[]=array();
            $recphotos[]=array();
        }
        //echo "<pre>";print_r($photos);exit;
        $result['photo']=array_slice(array_values(array_filter(array_merge($recphoto,$photo))),0,9);
        $result['photos']=array_slice(array_values(array_filter(array_merge($recphotos,$photos))),0,9);
        $result['check_detail']=string2array($res['check_detail']);
        //$result['check_waterdetail']=string2array($res['check_waterdetail']);
        //$result['addtime']=$res['addtime'];
        $result['gjphoto']=$this->gjphoto($order_id);
        $result['content']=strip_tags($res['content']);
        if($res['owner_speak']){
        $result['owner_speak']=strip_tags($res['owner_speak']);
        $result['user_photo'] = "http://m.uzhuang.com/res/img/yonghu.png";
        }
        $result['nodeid']=51;
        $referno = $this->db->get_one('demand_referno','orderid="'.$order_id.'" and nodeid=51');
        if($referno['is_online']==0 || $referno['pay_schedult']==1){
        $result['pay']=$this->pays($order_id,51);
        }else{
        $result['pay']=null;
        }
        $result['message'] = $this->get_message($order_id,51);
       return $result;
    }
    //评分
    public function grade($orderid,$nodeid){
      $log_graded_amend = $this->db->count('log_graded_amend','orderid="'.$orderid.'" and nodeid ="'.$nodeid.'"');
      if($log_graded_amend['num']>0){
          $result1 = $this->db->get_one('log_graded_amend','orderid="'.$orderid.'" and nodeid ="'.$nodeid.'"','content,design,quality,manner,capacity,professional,serve,coordinate,additional,company_id,housekeeper_id,additional_num,modification_num');
          }else{
          $result1 = $this->db->get_one('log_graded','orderid="'.$orderid.'" and nodeid ="'.$nodeid.'"','content,design,quality,manner,capacity,professional,serve,coordinate,additional,company_id,housekeeper_id,additional_num,modification_num');
      }
      $sta = $this->db->get_one('log_graded_amend','orderid="'.$orderid.'" and nodeid ="'.$nodeid.'"','content,design,quality,manner,capacity,professional,serve,coordinate,additional,company_id,housekeeper_id,additional_num,modification_num');
      if($sta['additional_num']){
       $arr1['additional_num'] = $sta['additional_num'];
      }else{
      $sta1 = $this->db->get_one('log_graded','orderid="'.$orderid.'" and nodeid ="'.$nodeid.'"','content,design,quality,manner,capacity,professional,serve,coordinate,additional,company_id,housekeeper_id,additional_num,modification_num');
       $arr1['additional_num'] = $sta1['additional_num'];
      }
      $arr1['content'] = $result1['content'];
      $arr1['additional'] = $result1['additional'];
      $arr1['modification_num'] = $result1['modification_num'];
      $arr1['company_id'] = $result1['company_id'];
      $arr1['design'] =isset($result1['design']) ? $result1['design'] : 0;
      $arr1['quality'] = isset($result1['quality']) ? $result1['quality'] : 0;
      $arr1['manner'] = isset($result1['manner']) ? $result1['manner'] : 0;
      $arr1['capacity'] = isset($result1['capacity']) ? $result1['capacity'] : 0;
      $arr1['professional'] = isset($result1['professional']) ? $result1['professional'] : 0;
      $arr1['serve'] = isset($result1['serve']) ? $result1['serve'] : 0;
      $arr1['coordinate'] = isset($result1['coordinate']) ? $result1['coordinate'] : 0;
      return $arr1;
    }

       public function get_message($orderid,$nodeid){
        $arr=array();
        $pinglun =$this->db->get_list('log_evaluate',"orderid=".$orderid." and nodeid='".$nodeid."'",'*',0,1000,1,'id,uid');
        //$uid =$this->db->get_list('log_evaluate',"orderid=".$orderid." and nodeid=12",'*',0,1000,1,'uid');
       
        foreach ($pinglun as $keys => $values) {
            $pinglun[$keys]['addtime']  = date('Y-m-d',$pinglun[$keys]['addtime']);
            if(empty($values['uid'])){
            $pinglun[$keys]['photo'] = "http://m.uzhuang.com/res/img/jingyu.png";
            }else{
            $pinglun[$keys]['photo']='http://www.uzhuang.com/uploadfile/member/'.substr(md5($values['uid']), 0, 2).'/'.$values['uid'].'/180x180.jpg';   
            }
        }
        foreach ($pinglun as $key => $value) {
            if($value['parent_id']==0 && $value['first_id']==0){
               $arr[]= $value;
            }
        }
        $resu=array();
        foreach ($arr as $k => $v) {
            $result =$this->db->get_list('log_evaluate',"orderid=".$orderid." and nodeid=".$nodeid." and first_id=".$v['id'],'*',0,1000,1,'id');
             foreach ($result as $kk => $vv) {
                if($vv['first_id']==$v['id']){
                    if(strpos($result[$kk]['content'],'回复') !== false && strpos($result[$kk]['content'],'回复')==0){
                        //$pre_length = mb_strlen($result[$kk]['content']);
                        $pre_length = mb_strpos($result[$kk]['content'], '：');
                        $resu['id']= $result[$kk]['id'];
                        $resu['orderid']= $result[$kk]['orderid'];
                        $resu['nodeid']= $result[$kk]['nodeid'];
                        $resu['content']= mb_substr($result[$kk]['content'],$pre_length+3);
                        $resu['addtime']= $result[$kk]['addtime'];
                        $resu['name']= $result[$kk]['name'];
                        $resu['reply_name']= $result[$kk]['reply_name'];
                        $resu['parent_id']= $result[$kk]['parent_id'];
                        $resu['first_id']= $result[$kk]['first_id'];
                        $resu['read']= $result[$kk]['read'];
                        if(empty($uid)){
                        $resu['photo']="http://m.uzhuang.com/res/img/jingyu.png";
                        }else{
                        $resu['photo']='http://www.uzhuang.com/uploadfile/member/'.substr(md5($uid), 0, 2).'/'.$uid.'/180x180.jpg';
                        }
                        
                        //$result[$kk]=$resu;
                        $arr[$k]['reply'][] =$resu;
                    }else{
                        $resus['id']= $result[$kk]['id'];
                        $resus['orderid']= $result[$kk]['orderid'];
                        $resus['nodeid']= $result[$kk]['nodeid'];
                        $resus['content']= $result[$kk]['content']; 
                        $resus['addtime']= $result[$kk]['addtime'];
                        $resus['name']= $result[$kk]['name'];
                        $resus['reply_name']= $result[$kk]['reply_name'];
                        $resus['parent_id']= $result[$kk]['parent_id'];
                        $resus['first_id']= $result[$kk]['first_id'];
                        $resus['read']= $result[$kk]['read'];
                        if(empty($uid)){
                        $resu['photo']="http://m.uzhuang.com/res/img/jingyu.png";
                        }else{
                        $resu['photo']='http://www.uzhuang.com/uploadfile/member/'.substr(md5($uid), 0, 2).'/'.$uid.'/180x180.jpg';
                        }
                        $arr[$k]['reply'][] =$resus;
                    }
                }
             }
        }
        return $arr;
    }



    public function gjphoto($orderid){
      $result = $this->db->get_one('day_log_demand_list',"orderid='".$orderid."'",'userid');
      
      $giphoto= $this->db->get_one('member_hk_data',"uid='".$result['userid']."'",'personalphoto');
      //echo "<pre>";print_r($result);
      if($giphoto['personalphoto']){
      $photo="http://www.uzhuang.com/image/pic_230/".$giphoto['personalphoto'];
      }else{
      $photo="http://m.uzhuang.com/res/img/guanjia.png";
      }
      //exit;
      return $photo;
    }

    //装修对比图
    public function comparison_photo($orderid,$type){
       $res = $this->db->get_one('decorate_pictures','order_id="'.$orderid.'"','decorate_pictures');
       $res = unserialize($res['decorate_pictures']);
       foreach ($res as $key => $value) {
          if(count($value['attach1'])>0 && count($value['attach2'])>0){
            foreach ($value['attach1'] as $k => $v) {
                $ar1[$key]['attach1'][$k] =  'http://www.uzhuang.com/image/pic_230/'.$v;
                if($type==1){
                    $arr[$key]['attach1'] = $ar1[$key]['attach1'][0];
                }else if($type==2){
                    $arr[$key]['title'] = $key;
                    $arr[$key]['attach1'] = $ar1[$key]['attach1'][0];
                    $arr[$key]['big_attach1'][$k] =  'http://www.uzhuang.com/image/pic_800/'.$v;
                }
            }
            foreach ($value['attach2'] as $k1 => $v1) {
                $ar1[$key]['attach2'][$k1] =  'http://www.uzhuang.com/image/pic_230/'.$v1;
                if($type==1){
                    $arr[$key]['attach2'] = $ar1[$key]['attach2'][0];
                }else if($type==2){
                    $arr[$key]['title'] = $key;
                    $arr[$key]['attach2'] = $ar1[$key]['attach2'][0];
                    $arr[$key]['big_attach2'][$k1] =  'http://www.uzhuang.com/image/pic_800/'.$v1;
                }
            }
          }
        }
        //array_values($arr);
        return array_values($arr);
    }

    public function pays($order_id,$nodeid){
        $array=array();
        $arr=array();
        $item=array();
        $array['totalpay']=$result[0]['totalpay'];
        $array['designpay']=$result[0]['designpay'];
        $array['designno']=$result[0]['designno'];
        $result=$this->db->get_list('demand',"id='".$order_id."'",'payment_id',0,100,$page,'');
         //echo "<pre>";print_r($payment_method);
        $array['amount']=$result[0]['amount'];
        $demand_referno=$this->db->get_list('f_payment_method',"payment_id='".$result[0]['payment_id']."'",'node_id',0,100,$page,'');
        $demand_refernos=$this->db->get_list('demand_referno',"orderid='".$order_id."'",'nodeid',0,100,$page,'','nodeid');
        $a=array_merge($demand_referno,$demand_refernos);
        $sort[]=array_unique($deman);
        $arr[]=$this->db->get_list('demand_referno',"orderid='".$order_id."' and nodeid = '".$nodeid."'",'nodename,nodeid,needmoney,extrapay,is_online,pay_schedult',0,100,$page,'');//caozhi 新增is_online,pay_schedult两个字段
        //echo "<pre>";print_r($arr);exit;
        foreach($arr as $k=>$v){
            foreach ($v as $ks => $vs) {
                if(!isset($item[$vs['nodeid']])){
                    $item[$vs['nodeid']]=$vs;
                    $re=$this->db->get_list('demand',"id='".$order_id."'",'payment_id');
                    $pay=$this->db->get_list('f_payment_method',"payment_id='".$re[0]['payment_id']."' and node_id='".$vs['nodeid']."'",'draw_rate',0,100,$page,'');
                    //echo "<pre>";print_r($pay);
                    $demand=$this->db->get_list('demand',"id='".$order_id."'",'designpay,totalpay,designno,contactno',0,100,$page,'');
                    if($nodeid==15){
                        $item[$vs['nodeid']]['designpay']=$demand[0]['designpay'];
                        $item[$vs['nodeid']]['designno']=$demand[0]['designno'];
                    }else{
                        $item[$vs['nodeid']]['totalpay']=$demand[0]['totalpay'];
                        $item[$vs['nodeid']]['contactno']=$demand[0]['contactno'];
                        $item[$vs['nodeid']]['is_online']=$vs['is_online'];
                        $item[$vs['nodeid']]['pay_schedult']=$vs['pay_schedult'];
                    }

                    //echo "<pre>";print_r($pay);
                    if($nodeid!=15){
                        if($pay){
                            $item[$vs['nodeid']]['draw_rate']=intval($pay[0]['draw_rate'])."%";
                        }else{
                            $item[$vs['nodeid']]['draw_rate']=$pay[0]['draw_rate'];   
                        }
                    }
                    $payment=$this->db->get_one('f_payment',array('payment_id'=>$re[0]['payment_id']),'payment_name');
                    if($item[$vs['nodeid']]['nodeid']==19){
                        $item[$vs['nodeid']]['payment_name']=$payment['payment_name'];
                    }
                    if($item[$vs['nodeid']]['nodeid']>=19){
                        $item[$vs['nodeid']]['pay_money']=$item[$vs['nodeid']]['totalpay']*(float)$item[$vs['nodeid']]['draw_rate']/100;
                    }
                }else{
                    $item[$vs['nodeid']]['needmoney']+=$vs['needmoney'];
                    $item[$vs['nodeid']]['extrapay']+=$vs['extrapay'];
                    //$item[$vs['nodeid']]['photo']+=$vs['posphoto'];
                    $re=$this->db->get_list('demand',"id='".$order_id."'",'payment_id');
                    $pay=$this->db->get_list('f_payment_method',"payment_id='".$re[0]['payment_id']."' and node_id='".$vs['nodeid']."'",'draw_rate',0,100,$page,'');
                    $demand=$this->db->get_list('demand',"id='".$order_id."'",'designpay,totalpay,designno,contactno',0,100,$page,'');
                    if($nodeid==15){
                    $item[$vs['nodeid']]['designpay']=$demand[0]['designpay'];
                    $item[$vs['nodeid']]['designno']=$demand[0]['designno'];
                    }else{
                    $item[$vs['nodeid']]['totalpay']=$demand[0]['totalpay'];
                    $item[$vs['nodeid']]['contactno']=$demand[0]['contactno'];
                    }
                    if($nodeid!=15){
                        if($pay){
                            $item[$vs['nodeid']]['draw_rate']=intval($pay[0]['draw_rate'])."%";
                        }else{
                            $item[$vs['nodeid']]['draw_rate']=$pay[0]['draw_rate'];   
                        }
                    }
                    $payment=$this->db->get_one('f_payment',array('payment_id'=>$re[0]['payment_id']),'payment_name');
                    if($item[$vs['nodeid']]['nodeid']==19){
                    $item[$vs['nodeid']]['payment_name']=$payment['payment_name'];
                    }
                    if($item[$vs['nodeid']]['nodeid']>=19){
                     $item[$vs['nodeid']]['pay_money']=$item[$vs['nodeid']]['totalpay']*(float)$item[$vs['nodeid']]['draw_rate']/100;
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
        }
        $results=array_merge($item,$ar);
        $ages = array();
        foreach ($results as $user) {
            $ages[] = $user['nodeid'];
        }

        array_multisort($ages, SORT_ASC, $results);
        return $results;
        /*if($results){
            echo json_encode(array('code'=>1,'data'=>$results,'message'=>'订单支付已进行','process_time'=>time())); exit; 
        }else{
            echo json_encode(array('code'=>0,'data'=>'','message'=>'您还没有到支付节点哦~','process_time'=>time())); exit; 
        }*/
    }
}