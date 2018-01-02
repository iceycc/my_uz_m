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
    class biz_lognew extends WUZHI_foreground {
    function __construct() {
          $this->member = load_class('member', 'member');
          $this->log = load_class('log','wap');
          //$this->common = load_class('common','finance');
            load_function('common', 'member');
            $this->member_setting = get_cache('setting', 'member');
            parent::__construct();
    }

    //公共包
    public function bag(){
        $day_log = get_config('log_config');

        $acquiesce=$GLOBALS['acquiesce'];


        $nodeid =$GLOBALS['nodeid'];
        $uid=get_cookie('_uid');
        $page = intval($GLOBALS['page']);
         if(!isset($page)||empty($page)){
                   $page=1;
         }
        $arr=array();
        $arrs=array();
        //刚刚更新
        if($acquiesce==0 && $nodeid){
        $sql= "SELECT id FROM wz_day_log_demand_list WHERE nodeid>10 AND nodename!='预约量房' AND url LIKE '%shows%' AND orderid >13087 AND nodeid in (".$day_log[$nodeid]['nodeid'].")";
        $query = $this->db->query($sql);
        while($data = $this->db->fetch_array($query)) {
            $log_rss[] = $data;
        }

        $log_rs = $this->db->get_list('day_log_demand_list',"nodeid >10 and nodeid!=101 and nodeid!=102 and nodename!='预约量房' and url LIKE '%shows%' and orderid >13087 and nodeid in (".$day_log[$nodeid]['nodeid'].")", 'logname,renovationcategory,homestyle,budget,housetype,style,way,area,userid,addtime,nodename,uid,orderid,nodeid,check_detail,check_waterdetail,check_other,recphoto,content,browse_count,url,thumb,totalpay', 0, 10, $page, 'addtime DESC');
        $c=count($log_rss);
        $page_max=ceil($c/10);
        }else if($acquiesce==0){
        $sql= 'SELECT id FROM wz_day_log_demand_list WHERE nodeid>10 AND nodename!="预约量房" AND url LIKE "%shows%" AND orderid >13087';
        $query = $this->db->query($sql);
        while($data = $this->db->fetch_array($query)) {
            $log_rsss[] = $data;
        }
        //走过三方合同的orderid
        $tree_arr = $this->db->get_list('day_log','nodeid=19 and orderid>13087','orderid',0,10000,'','','orderid','orderid');
        foreach ($tree_arr as $k=>$v){
            $tree_orderid[] = $v['orderid'];
        }
        $tree_order_id=  implode(',',$tree_orderid);
        //未走过三方合同的orderid
         $tree_row = $this->db->get_list('day_log','nodeid!=19 and orderid>13087','orderid',0,10000,'','','orderid','orderid');
         foreach ($tree_row as $k=>$v){
             $untree_orderid[] = $v['orderid'];
         }
         $unthreeid = array_diff($untree_orderid,$tree_orderid);
         $untree_order_id=  implode(',',$unthreeid);

        $log_rs = $this->db->get_list('day_log_demand_list','nodeid >10 and nodeid!=101 and nodeid!=102 and nodename!="预约量房" and url LIKE "%shows%" and orderid >13087 and orderid in'.'('.$tree_order_id.')', 'logname,renovationcategory,homestyle,budget,housetype,style,way,area,userid,addtime,nodename,uid,orderid,nodeid,check_detail,check_waterdetail,check_other,recphoto,content,browse_count,url,thumb,totalpay,order_type_1', 0, 10, $page, 'log_intervene DESC,order_type_1,nodeid >= 19 DESC,addtime DESC');
        $sql = "SELECT `logname`,`renovationcategory`,`homestyle`,`budget`,`housetype`,`style`,`way`,`area`,`userid`,`addtime`,`nodename`,`uid`,`orderid`,`nodeid`,`check_detail`,`check_waterdetail`,`check_other`,`recphoto`,`content`,`browse_count`,`url`,`thumb`,`totalpay`,`order_type_1` FROM `wz_day_log_demand_list` WHERE nodeid >10 and nodeid!=101 and nodeid!=102 and nodename!='预约量房' and url LIKE '%shows%' and orderid >13087 AND orderid in (" . $tree_order_id . ") ORDER BY log_intervene DESC,order_type_1,nodeid >= 19 DESC,addtime DESC";
       $query = $this->db->query($sql);
       while ($data = $this->db->fetch_array($query)) {
           $lnum[] = $data;
       }
       $n = (int)(count($lnum)/10);
        $count_re = count($log_rs);
        if($count_re < 10 and  $count_re != 0){

            $log_rs2 = $this->db->get_list('day_log_demand_list','nodeid >10 and nodeid!=101 and nodeid!=102 and nodename!="预约量房" and url LIKE "%shows%" and orderid >13087 and orderid in'.'('.$untree_order_id.')', 'logname,renovationcategory,homestyle,budget,housetype,style,way,area,userid,addtime,nodename,uid,orderid,nodeid,check_detail,check_waterdetail,check_other,recphoto,content,browse_count,url,thumb,totalpay,order_type_1', -($n*10), 10, $page, 'log_intervene DESC,order_type_1,nodeid >= 19 DESC,addtime DESC');
            $num = 10 - $count_re;
            for($i=0;$i<$num;$i++){
                $log_rs[]= $log_rs2[$i];
            }
        }elseif($count_re == 0){
            $log_rs = $this->db->get_list('day_log_demand_list','nodeid >10 and nodeid!=101 and nodeid!=102 and nodename!="预约量房" and url LIKE "%shows%" and orderid >13087 and orderid in'.'('.$untree_order_id.')', 'logname,renovationcategory,homestyle,budget,housetype,style,way,area,userid,addtime,nodename,uid,orderid,nodeid,check_detail,check_waterdetail,check_other,recphoto,content,browse_count,url,thumb,totalpay,order_type_1', 0, 10, $page, 'log_intervene DESC,order_type_1,nodeid >= 19 DESC,addtime DESC');
        }

 //echo '<pre>';print_r($log_rs);die;

        $c=count($log_rsss);
        $page_max=ceil($c/10);
        }
        //浏览量最多
        if($acquiesce==1 && $nodeid){
        $sql= "SELECT id FROM wz_day_log_demand_list WHERE nodeid>10 AND nodename!='预约量房' AND url LIKE '%shows%' AND orderid >13087 AND nodeid in (".$day_log[$nodeid]['nodeid'].")";
        $query = $this->db->query($sql);
        while($data = $this->db->fetch_array($query)) {
            $log_rssss[] = $data;
        }
        $log_rs = $this->db->get_list('day_log_demand_list',"nodeid >10 and nodeid!=101 and nodeid!=102 and nodename!='预约量房' and url LIKE '%shows%' and orderid >13087 and nodeid in (".$day_log[$nodeid]['nodeid'].")", 'logname,renovationcategory,homestyle,budget,housetype,style,way,area,userid,addtime,nodename,uid,orderid,nodeid,check_detail,check_waterdetail,check_other,recphoto,content,browse_count,url,thumb,totalpay', 0, 10, $page, 'browse_count DESC');
        $c=count($log_rssss);
        $page_max=ceil($c/10);
        }else if($acquiesce==1){
        $sql= 'SELECT id FROM wz_day_log_demand_list WHERE nodeid>10 AND nodename!="预约量房" AND url LIKE "%shows%" AND orderid >13087';
        $query = $this->db->query($sql);
        while($data = $this->db->fetch_array($query)) {
            $log_rsssss[] = $data;
        }
        $log_rs = $this->db->get_list('day_log_demand_list','nodeid >10 and nodeid!=101 and nodeid!=102 and nodename!="预约量房" and url LIKE "%shows%" and orderid >13087', 'logname,renovationcategory,homestyle,budget,housetype,style,way,area,userid,addtime,nodename,uid,orderid,nodeid,check_detail,check_waterdetail,check_other,recphoto,content,browse_count,url,thumb,totalpay', 0, 10, $page, 'browse_count DESC');
        $c=count($log_rsssss);
        $page_max=ceil($c/10);
        }

        foreach ($log_rs as $key => $value) {
            //echo "<pre>";print_r($value);
        $resul=$this->db->count('log_evaluate',"orderid='".$value['orderid']."'");
        $arr[$key]['logname']=$value['logname'];
        $arr[$key]['uids']=$value['uid'];
        $arr[$key]['nodename']=$value['nodename'];
        $arr[$key]['nodeid'] = $value['nodeid'];
        $arr[$key]['orderid']=$value['orderid'];
        $arr[$key]['order_type_1'] =  $value['order_type_1'];
        $arr[$key]['browse_count']=$value['browse_count'];
        $arr[$key]['url']=$value['url'];
        $arr[$key]['thumb']=$value['thumb'];
        $arr[$key]['message']=$resul['num'];
        $arr[$key]['addtime']=time_format1(strtotime($value['addtime']));
        if(!preg_match("/[\x7f-\xff]/", $arr[$key]['addtime'])){
                    $arr[$key]['addtime']=date('Y-m-d',strtotime($value['addtime']));
        }
        $arrs[$key]['check_other']=string2array($value['check_other']);
         if($arrs[$key]['check_other']){
         $arrs[$key]['imger'] = array();
          foreach ($arrs[$key]['check_other'] as $ks => $vs) {
              if (!empty($vs['img_yse'])) {
                  $a = explode(',',trim($vs['img_yse'],','));
                  foreach ($a as $kk => $vv) {
                     if(!empty($vv)){
                      $arrs[$key]['imger'][] = $vv;
                     }else{
                      $arrs[$key]['imger'][] =array();
                     }
                  }
              }
          }
         }else{
           $arrs[$key]['imger'] =array();
         }
        $arrs[$key]['check_other']=string2array($value['check_other']);
         if($arrs[$key]['check_other']){
          $arrs[$key]['imgers'] = array();
          foreach ($arrs[$key]['check_other'] as $ks => $vs) {
              if (!empty($vs['chan_Srcs'])) {
                  $a = explode(',',trim($vs['chan_Srcs'],','));
                  foreach ($a as $kk => $vv) {
                    if(!empty($vv)){
                     $arrs[$key]['imgers'][] = $vv;
                    }else{
                     $arrs[$key]['imgers'][] =array();
                    }
                  }
              }
          }
        }else{
          $arrs[$key]['imgers'] =array();
        }
        $arrs[$key]['recphoto']=unserialize($value['recphoto']);
        $arrs[$key]['check_detail']=string2array($value['check_detail']);
        if($arrs[$key]['check_detail']){
          $arrs[$key]['img'] = array();
          foreach ($arrs[$key]['check_detail'] as $k => $v) {
              if (!empty($v['chan_Srcs'])) {
                  $a = explode(',',trim($v['chan_Srcs'],','));
                  foreach ($a as $kk => $vv) {
                     if(!empty($vv)){
                     $arrs[$key]['img'][] = $vv;
                     }else{
                     $arrs[$key]['img'][] =array();
                     }
                  }
              }
          }
        }else{
          $arrs[$key]['img'] =array();
        }
        if($arrs[$key]['check_detail']){
          $arrs[$key]['imgs']=array();
          foreach ($arrs[$key]['check_detail'] as $k => $v) {
              if (!empty($v['img_yse'])) {
                  $a = explode(',',trim($v['img_yse'],','));
                  foreach ($a as $kk => $vv) {
                     if(!empty($vv)){
                     $arrs[$key]['imgs'][] = $vv;
                    }else{
                     $arrs[$key]['imgs'][] =array(); 
                    }
                  }
              }
          }
        }else{
          $arrs[$key]['imgs'] =array(); 
        }
       
        $arrs[$key]['photo']=array_merge($arrs[$key]['img'],$arrs[$key]['imgs'],$arrs[$key]['recphoto'],$arrs[$key]['imger'],$arrs[$key]['imgers']);
        //装修对比图
        $comparison_photo=$this->log->comparison_photo($value['orderid'],1);
        if(!empty($comparison_photo)){
        $compar_photo= array_slice($comparison_photo,0,1);
          foreach ($compar_photo as $ks => $vs) {
             $arr[$key]['comparison_photo']=$vs;
          }
        }
        if($arrs[$key]['photo']){
        $arr[$key]['log_photo']="http://www.uzhuang.com/image/pic_230/".end($arrs[$key]['photo']); 
        }else if($value['thumb']){
        $arr[$key]['log_photo']="http://www.uzhuang.com/image/pic_230/".$value['thumb']; 
        }else{
        $arr[$key]['log_photo']=0;
        }
        if($value['renovationcategory']==1){
                       $configs_picture = get_config('picture_config');
                        $q=trim($value['homestyle'],',');
                        $w=explode(',',$q);
                        for($i=0;$i<count($w);$i++){
                          $homestyle[$i]=$configs_picture['homestyle'][$w[$i]];
                        }
                        $arr[$key]['homestyle']=$homestyle;           
                        }else{
                        $configs_picture = get_config('picture_config');
                        $qq=trim($value['housetype'],',');
                        $ww=explode(',',$qq);
                        for($v=0;$v<count($ww);$v++){
                          $housetype[$v]=$configs_picture['housetype'][$ww[$v]];
                        }
                        $arr[$key]['homestyle']=$housetype;    
                        }
                        $configs_picture = get_config('picture_config');
                        $a=trim($value['way'],',');
                        $b=explode(',',$a);
                        for($i=0;$i<count($b);$i++){
                         $way[$i]=$configs_picture['way'][$b[$i]];
                        }
                        $arr[$key]['way']=$way;
                        $arr[$key]['area']=$value['area'];
                        if($value['totalpay']>1000){
                        $arr[$key]['budget']=sprintf("%.1f", $value['totalpay']/10000).'万';
                        }else if($value['totalpay']<1000 && $value['totalpay']!=0){
                        $arr[$key]['budget']=number_format($value['totalpay'],1).'元';
                        }
        }
        foreach ($log_rs as $key => $value) { 
            $log_r= $this->db->get_one('member_hk_data',array('uid'=>$value['userid']), 'uid,gjname,personalphoto,level');
            $arr[$key]['uid']=$log_r['uid'];
            $arr[$key]['gjname']=$log_r['gjname'];
            $arr[$key]['personalphoto']=$log_r['personalphoto'];
            if($log_r['level']==1){
                $arr[$key]['level']='金牌管家';
            }else if($log_r['level']==0){
                $arr[$key]['level']='装修管家';
            }else if($log_r['level']==2){
                $arr[$key]['level']='资深管家';
            }
        }
        foreach ($arr as $pk => $pl) {
           $uid_log=$this->db->get_one('day_log_demand_list',"`orderid`= '".$pl['orderid']."'",'title,uid');
           //var_dump($uid_log['uid']);
            if($uid_log['uid']!=$uid || empty($uid_log['uid'])){
              $log_exist=(int)0;
            }else{
              $log_exist=(int)1;
            }
            $arr[$pk]['log_exist']=$log_exist;
            if($arr[$pk]['personalphoto']){
            $arr[$pk]['personalphotos'] ='http://www.uzhuang.com/image/pic_230/'.$arr[$pk]['personalphoto'];
            }else{
            $arr[$pk]['personalphotos']='http://m.uzhuang.com/res/img/guanjia.png';
            }
        }//echo"<pre>";print_r($arr);exit;
        if(empty($arr)){
        echo json_encode(array('code'=>0,'data'=>null,'message'=>'数据错误','process_time'=>time())); exit;
        }else{
            //echo '<pre>';print_r($arr);die;
          return $arr_finally=array(
            'arr'=>$arr,
            'page_max'=>$page_max,
          );    
        }     
    }
    //工地直播列表页
    public function listl(){

        $acquiesce=$GLOBALS['acquiesce'];
        //"0"是默认排序"1"浏览量最多排序"2"装修前"3"装修中"4"装修后(环保)"5"完结
        $nodeid =$GLOBALS['nodeid'];
        //最多人看
        if($acquiesce==1 && $nodeid){
        $arr2=$this->bag();
        echo json_encode(array('code'=>1,'data'=>$arr2,'message'=>'最多人看+筛选节点','process_time'=>time())); exit;
        }else if($acquiesce==1){
          $arr2=$this->bag(); 
        echo json_encode(array('code'=>1,'data'=>$arr2,'message'=>'最多人看','process_time'=>time())); exit;
        }
        //刚刚更新
        if($acquiesce==0 && $nodeid){
        $arr21=$this->bag();
        echo json_encode(array('code'=>1,'data'=>$arr21,'message'=>'刚刚更新+筛选节点','process_time'=>time())); exit;
        }else if($acquiesce==0){
        $arr21=$this->bag();
        echo json_encode(array('code'=>1,'data'=>$arr21,'message'=>'刚刚更新','process_time'=>time())); exit;
        }

        $totals = $this->db->number;
        $pages = $this->db->pages;
    }
    

      //工地详情页头部公共包
    public function bags($orderid=''){
            $nodeid = 13;
            $arr1=array();
            $arr=array();
            $result= $this->db->get_one('demand',array('id'=>$orderid),'title,sex,homestyle,budget,housetype,area,style,way,renovationcategory,uid,xqmc,totalpay');
                $results=$this->db->get_one('member',array('uid'=>$arr1['result']['uid']),'avatar');
                $file = 'uploadfile/member/'.substr(md5($arr1['result']['uid']), 0, 2).'/'.$arr1['result']['uid'].'/180x180.jpg';
                if($results['avatar']==1){
                $arr1['avatar'] ='http://www.uzhuang.com/'.$file;
                }else{
                $arr1['avatar']= R.'images/userface.png';
                }
                $configs_picture = get_config('picture_config');
                //正常显示图片
                if($result['renovationcategory']==1){
                        $q=trim($result['homestyle'],',');
                        $w=explode(',',$q);
                        for($i=0;$i<count($w);$i++){
                          $homestyle[$i]=$configs_picture['homestyle'][$w[$i]];
                        }
                        $arr1['homestyle']=$homestyle;              
                        }else{
                        $qq=trim($result['housetype'],',');
                        $ww=explode(',',$qq);
                        for($v=0;$v<count($ww);$v++){
                          $housetype[$v]=$configs_picture['housetype'][$ww[$v]];
                        }
                        $arr1['homestyle']=$housetype;    
                        }
                        $configs_picture = get_config('picture_config');
                        $a=trim($result['way'],',');
                        $b=explode(',',$a);
                        for($i=0;$i<count($b);$i++){
                         $way[$i]=$configs_picture['way'][$b[$i]];
                        }
                        $arr1['way']=$way;
                        if($result['totalpay']>1000){
                        $arr1['budget']=sprintf("%.1f",$result['totalpay']/10000).'万';
                        }else if($result['totalpay']<1000 && $result['totalpay']!=0){
                        $arr1['budget']=number_format($result['totalpay'],1).'元';
                        }
                        $arr1['area']=$result['area'];
                $where = "orderid='".$orderid."'";
                $idss=$this->db->get_list('day_log_demand_list',$where,'logname',0,1,$page,'id DESC');
                     $arr1['name']=$idss[0]['logname'];
                $ids =$this->db->get_list('day_log',$where,'userid,title',0,1,$page,'id DESC');
                $log_r= $this->db->get_one('member_hk_data',array('uid'=>$ids[0]['userid']), 'uid,gjname,personalphoto,mobile,level');
                $arr1['uid']=$log_r['uid'];
                $arr1['gjname']=$log_r['gjname'];
                $arr1['mobile']=$log_r['mobile'];
                if($log_r['level']==1){
                $arr1['level']='1';
                }else{
                $arr1['level']='2';
                }
                //$arr[$pk]['personalphotos'] ='http://www.uzhuang.com/image/small_square/'.$arr[$pk]['personalphoto'];
                if($log_r['personalphoto']){
                $arr1['personalphotos']='http://www.uzhuang.com/image/pic_230/'.$log_r['personalphoto'];
                }else{
                $arr1['personalphotos']='http://m.uzhuang.com/res/img/guanjia.png';
                }
                //$com=$this->db->get_one('demand_track_detai',array('orderid'=>$orderid,'nodeid'=>$nodeid,'col8'=>''),"col2,col1,col8",0,"id desc");
                  $com = $this->db->get_one('demand_track_detail',array('orderid'=>$orderid,'nodeid'=>$nodeid,'col8'=>'是'),"col2,col1",0,"id desc");
                //echo "<pre>";print_r($com);
                //var_dump($com);
                if(!$com){
                  $company=$this->db->get_one('demand_track_detail',"orderid='".$orderid."' and nodeid='".$nodeid."' and col8 is null" ,"col2,col1",0,"id desc");
                }else{
                  $company = $com;
                }
                //var_dump($com);
                $res=mb_strlen($company['col2']);
                //echo "<pre>";print_r($company);exit;
                if($res>36){
                $arr1['company']=mb_substr($company['col2'], 0, 12,'utf-8').'...';
                }else{
                $arr1['company']=$company['col2'];
                }
                //var_dump($s);exit;
                $company_photo=$this->db->get_one('company',array('id'=>$company['col1']),"thumb,id",0,"id desc");
                $arr1['company_photo']='http://www.uzhuang.com/uploadfile/'.substr($company_photo['thumb'],0,2).'/'.substr($company_photo['thumb'],2,2).'/'.$company_photo['thumb'];
                $arr1['id']=$company_photo['id'];
                //http://image-'.$srv_n.'.uzhuang.com/uploadfile/'.substr($src,0,2).'/'.substr($src,2,2).'/'.$src
                return $arr1;
                $pages = $this->db->pages;
                $total = $this->db->number;
                $configs = get_config('picture_config');              
    }
    //工地直播详情页
    //第一个接口用户进工地直播详情页   输出的数据
    public function log(){
           $orderid = $GLOBALS['orderid'];
           if($orderid){
           $uid =get_cookie('_uid');     
           $where40 = "orderid='".$orderid."' AND isPublish='发布' and nodeid!=101 and nodeid!=102";
           $maxNodeId = $this->db->get_list('day_log',$where40,'nodeid,content,nodename,addtime',0,1,$page,'nodeid desc');  
           $nodeid = $maxNodeId[0]['nodeid'];
           //echo "<pre>";print_r($nodeid);exit;
           $design_rs = $this->db->get_one('day_log_demand_list', array('orderid' => $orderid),"browse_count");
           $browseCount = (int)$design_rs['browse_count']+1;
           // 跟新到数据库
           $this->db->update('day_log_demand_list',array('browse_count'=>$browseCount),array('orderid'=>$orderid));
           //调bags方法包         
           $arr=array(
                'node'=>$this->bags($orderid),
            );
           //登陆评论状态
           $statu=$this->db->get_one('demand',"id='".$orderid."'",'uid');
           if($uid==$statu['uid']){
            $arr['statu']=1;
           }else{
            $arr['statu']=2;
           }
           //工地直播  完结状态
           $where7= "`id`='".$orderid."' and orderstatus='完结'";
           $resul= $this->db->get_list('demand',$where7,'orderstatus');
           foreach ($resul as $key => $value) {
            $arr['orderstatus']=$value['orderstatus'];
           }
           //var_dump($retest);exit;
           //日志拆改是否显示
           $where4= "`orderid`='".$orderid."' and nodeid=23";
           $results = $this->db->get_list('demand_track',$where4,'col2');
           foreach ($results as $ke => $va) {
           $arr['col2']=$va['col2'];
            }
           //意向定金  状态
           $where5= "`orderid`='".$orderid."' and nodeid=15";
           $result = $this->db->get_list('demand_track',$where5,'col2');
           foreach ($result as $key => $val) {
           $arr['col3']=$val['col2'];
            }
           $collectstatus=$this->db->get_list('favorite',$where11,'keyid,collectstatus');
           $ar=array();
              foreach ($collectstatus as $key => $value) {
                $ar[]=$value['keyid'];
              }
              if(empty($uid)){
                $a = (empty($uid)) ? $arr['collectstatus']=0:$arr['collectstatus']=$collectstatus1['collectstatus'];
              }else{
              if(in_array($orderid,$ar)){
                $collectstatus1=$this->db->get_one('favorite',"`keyid`=$orderid and `uid`=$uid",'keyid,collectstatus');
              }
                $a = (empty($uid)) ? $arr['collectstatus']=0:$arr['collectstatus']=$collectstatus1['collectstatus'];
              }
              $arr['collectstatus']=$a;
              $arrs=array();
              $nodeids[$nodeid]=$nodeid;
              $resuls=$this->details($orderid,$nodeids);
              foreach ($resuls as $key => $value) {
                $arrs=$value;
              }
              $arr['max_logname']=$arrs;
              $where2 = "orderid='".$orderid."' AND isPublish='发布'";
              $res = $this->db->get_list('day_log',$where2,'nodeid,addtime', 0, 21, $page,'nodeid DESC');

              $resu=array();
              foreach ($res as $key => $value) {
                //echo "<pre>";print_r($value);
              if($value['nodeid']!=10){
              $resu[$key][]= $value['nodeid'];
              $a=substr($value['addtime'],2,8);

              $resu[$key][]= $a;
              }
              //explode("@",$email); 
              //substr($value['accDate'],0,10);
              }//exit;
              // echo"<pre>";print_r($resu);
              $arr['resu']=array_values($resu);
              //$quali数组的第一个元素节点id,第二个元素合格的个数，第三个元素不合格的个数
              $quali=array();
              $quote=array();
              foreach ($arr['resu'] as $key => $value) {
              foreach ($value as $ke => $va) {
               $quali[$key][]=$va;
              }
            
            
            // 取合格的数据
            $qualified = $this->db->get_list('day_log',"`orderid`='".$orderid."' and `nodeid`='".$value[0]."'",'orderid,nodeid,check_detail,check_waterdetail');

            $qualis=string2array($qualified[0]['check_detail']);
            $quass=string2array($qualified[0]['check_waterdetail']);
             
             //echo "<pre>";print_r($quass);
            $ress = array_merge($qualis,$quass);
            //echo "<pre>";print_r($ress);
            $qua=array();
            $quas=array();
            foreach ($qualis as $ks => $vs) {
                if($vs['qua']=='合格'){
                     $qua[]=$vs['qua'];
                }
               
            }
            foreach ($qualis as $ks => $vs) {
                if($vs['qua']=='不合格'){
                     $quas[]=$vs['qua'];
                }
            }
            /*foreach ($ress as $kes => $vas) {
                if($vas['qua']=='合格'){
                     $water[]=$vas['qua'];
                }
            }
            foreach ($ress as $kes => $vas) {
                if($vas['qua']=='不合格'){
                     $waters[]=$vas['qua'];
                }
            }*/
            $qualified=count($qua);
            $unqualified=count($quas);
            /*$waterqua=count($water);
            $waterunqua=count($waters);*/

            $quali[$key][]=$qualified;
            $quali[$key][]=$unqualified;
            /*$quote[$key][]=$waterqua;
            $quate[$key][]=$waterunqua;*/
           }//exit;
            $arr['resu']=$quali;
            $arr['comparison_photo'] =$this->log->comparison_photo($orderid,2);
            //echo"<pre>";print_r($quali);
           if($arr){
            //echo"<pre>";print_r($arr);exit;
            echo json_encode(array('code'=>1,'data'=>$arr,'message'=>'刚进详情页的接口','process_time'=>time())); exit;
           }else{
            echo json_encode(array('code'=>0,'data'=>null,'message'=>'数据不存在','process_time'=>time())); exit;
           }
          }else{
             echo json_encode(array('code'=>0,'data'=>null,'message'=>'订单ID不存在','process_time'=>time())); exit;
          }
    }
    public function details($orderid,$nodeid){
          //echo "<pre>";print_r($nodeid);exit;
         if($nodeid[11]==11){
            $resu[]=$this->log->result1($orderid);
         }
         //报价审核
         if($nodeid[12]==12){
            $resu[]=$this->log->result2($orderid);
         }
         //签订意向定金
         if($nodeid[15]==15){
            $resu[]=$this->log->result3($orderid);
         }
         //预交底
         if($nodeid[17]==17){
            $resu[]=$this->log->result4($orderid);
         }
         //签订三方合同
         if($nodeid[19]==19){
            $resu[]=$this->log->result5($orderid);
         }
         //开工仪式
         if($nodeid[21]==21){
            $resu[]=$this->log->result6($orderid);
         }
         //水电材料验收
         if($nodeid[25]==25){
            $resu[]=$this->log->result7($orderresuid);
         }
         //水电工程验收
         if($nodeid[27]==27){
            $resu[]=$this->log->result8($orderid);
         }
         //防水材料验收
         if($nodeid[28]==28){
            $resu[]=$this->log->result9($orderid);
         }
         //瓦木材料验收
         if($nodeid[29]==29){
            $resu[]=$this->log->result10($orderid);
         }
         //瓦木工程验收
         if($nodeid[31]==31){
            $resu[]=$this->log->result11($orderid);
         }
         //油漆材料验收
         if($nodeid[33]==33){
            $resu[]=$this->log->result12($orderid);
         }
         //油漆工程验收
         if($nodeid[35]==35){
            $resu[]=$this->log->result13($orderid);
         }
         //安装工程验收
         if($nodeid[36]==36){
            $resu[]=$this->log->result14($orderid);
         }
         //竣工验收
         if($nodeid[37]==37){
            $resu[]=$this->log->result15($orderid);
         }
         //第一次环保监测
         if($nodeid[39]==39){
            $resu[]=$this->log->result16($orderid);
         }
         //第二次环保监测
         if($nodeid[43]==43){
            $resu[]=$this->log->result17($orderid);
         }
         //维保节点
         if($nodeid[45]==45){
            $resu[]=$this->log->result18($orderid);
         }
         //环保治理
         if($nodeid[49]==49){
            $resu[]=$this->log->result19($orderid);
         }
         //环保治理后复测
         if($nodeid[51]==51){
            $resu[]=$this->log->result20($orderid);
         }
         return $resu;
    }
    //工地直播详情页
    public function detail(){

      $orderid=$GLOBALS['orderid'];
      if($orderid){
      $results= $this->db->get_list('day_log',"orderid='".$orderid."' and nodeid!=101 and nodeid!=102 and isPublish='发布'",'nodeid,check_detail,check_waterdetail,check_other,photo,recphoto,addtime,content');
          $nodeid=array();
          foreach ($results as $key => $value) {
            $nodeid[$value['nodeid']]=$value['nodeid'];
          }
          //echo "<pre>";print_r($nodeid);exit;
         if($nodeid[11]==11){
            $resu[]=$this->log->result1($orderid);
         }
         //报价审核
         if($nodeid[12]==12){
            $resu[]=$this->log->result2($orderid);
         }
         //签订意向定金
         if($nodeid[15]==15){
            $resu[]=$this->log->result3($orderid);
         }
         //预交底
         if($nodeid[17]==17){
            $resu[]=$this->log->result4($orderid);
         }
         //签订三方合同
         if($nodeid[19]==19){
            $resu[]=$this->log->result5($orderid);
         }
         //开工仪式
         if($nodeid[21]==21){
            $resu[]=$this->log->result6($orderid);
         }
         //水电材料验收
         if($nodeid[25]==25){
            $resu[]=$this->log->result7($orderid);
         }
         //水电工程验收
         if($nodeid[27]==27){
            $resu[]=$this->log->result8($orderid);
         }
         //防水材料验收
         if($nodeid[28]==28){
            $resu[]=$this->log->result9($orderid);
         }
         //瓦木材料验收
         if($nodeid[29]==29){
            $resu[]=$this->log->result10($orderid);
         }
         //瓦木工程验收
         if($nodeid[31]==31){
            $resu[]=$this->log->result11($orderid);
         }
         //油漆材料验收
         if($nodeid[33]==33){
            $resu[]=$this->log->result12($orderid);
         }
         //油漆工程验收
         if($nodeid[35]==35){
            $resu[]=$this->log->result13($orderid);
         }
         //安装工程验收
         if($nodeid[36]==36){
            $resu[]=$this->log->result14($orderid);
         }
         //竣工验收
         if($nodeid[37]==37){
            $resu[]=$this->log->result15($orderid);
         }
         //第一次环保监测
         if($nodeid[39]==39){
            $resu[]=$this->log->result16($orderid);
         }
         //第二次环保监测
         if($nodeid[43]==43){
            $resu[]=$this->log->result17($orderid);
         }
         //维保节点
         if($nodeid[45]==45){
            $resu[]=$this->log->result18($orderid);
         }
         //环保治理
         if($nodeid[49]==49){
            $resu[]=$this->log->result19($orderid);
         }
         //环保治理后复测
         if($nodeid[51]==51){
            $resu[]=$this->log->result20($orderid);
         }
         //echo "<pre>";print_r($resu);exit;
         echo json_encode(array('code'=>1,'data'=>$resu,'message'=>'节点详情页','process_time'=>time())); exit;
        }else{
         echo json_encode(array('code'=>0,'data'=>null,'message'=>'订单ID不存在','process_time'=>time())); exit;
        }
    }
    //写评论
    public function public_log_comment(){
        $form = array();
        $uid = get_cookie('_uid');
        if($uid){
            // 评论者姓名
            $res = $this->db->get_one('member',array('uid'=>$uid),'username,avatar');
            $form['name'] = $res['username'];
            // 评论者头像
            if($res['avatar']){
                $file = 'uploadfile/member/'.substr(md5($uid), 0, 2).'/'.$uid.'/180x180.jpg';
                $userphoto = 'http://www.uzhuang.com/'.$file;
            }else{
                $userphoto = "http://m.uzhuang.com/res/img/jingyu.png";
            }
        }else{
            $str =rand(100000,999999);
            $userip = "游客".'_'.$str;
            $form['name'] = $userip;
            $userphoto = "http://m.uzhuang.com/res/img/jingyu.png";
        }
        //判断是否回复
        $reply = $GLOBALS['reply'];
        //订单编号
        $form['orderid'] = $GLOBALS['orderid'];
        //节点号
        $form['nodeid'] = $GLOBALS['nodeid'];
        //评论内容
        $form['content'] = $GLOBALS['content'];
        //评论时间
        $form['addtime'] = time();
        //回复人姓名
        $form['reply_name'] = $GLOBALS['reply_name'];
        if($reply){
          //评论区的第一个评论ID
          $form['first_id'] = $GLOBALS['first_id'];
          //回复评论的ID号
          $form['parent_id'] = $GLOBALS['parent_id'];
        }
        //用户id
        $form['uid'] = $uid;
        //评论来源
        $form['source']='M';
        // 插入数据库
        $id = $this->db->insert('log_evaluate',$form);
        $content=$this->db->get_one('log_evaluate',"orderid='".$form['orderid']."' and nodeid='".$form['nodeid']."'",'content');
        
        if($uid){
            $rdata = array('name'=>$res['username'],'userphoto'=>$userphoto,'parent_id'=>$id,'content'=>$content['content']);
        }else{
            $rdata = array('name'=>$userip,'userphoto'=>$userphoto,'parent_id'=>$id,'content'=>$content['content']);
        }
        echo json_encode(array('code'=>1,'data'=>$rdata,'message'=>'评论内容','process_time'=>time())); exit;
        //die(json_encode($rdata));
    }

    //查看更多验收项
    public function public_get_checked_item(){
        $orderid = $GLOBALS['orderid'];
        $nodeid =$GLOBALS['nodeid'];
        $title=array();
        $item_result = $this->db->get_one('day_log',array('orderid'=>$orderid,'nodeid'=>$nodeid),'check_detail');
        $result = array();
        $result['check_detail'] = string2array($item_result['check_detail']);
        foreach ($result as $key => $value) {
          foreach ($value as $keys => $values) {
            if($values['qua']=='合格' && $values['img_yse']==''){
             $title[]=$values['title'];
            }
          }
        }
        echo json_encode(array('code'=>1,'data'=>$title,'message'=>'查看更多验收项','process_time'=>time())); exit;
    }
    //查看更多验收项水电工程验收项--水路
    public function check_waterdetail(){
        $orderid = $GLOBALS['orderid'];
        $nodeid = $GLOBALS['nodeid'];
        $title =array();
        $item_result = $this->db->get_one('day_log',array('orderid'=>$orderid,'nodeid'=>$nodeid),'check_waterdetail');
        $result = array();
        $result['check_waterdetail'] = string2array($item_result['check_waterdetail']);
        foreach ($result as $key => $value) {
          foreach ($value as $keys => $values) {
            if($values['qua']=='合格' && $values['img_yse']==''){
              $title[]=$values['title'];
            }
          }
        }
        echo json_encode(array('code'=>1,'data'=>$title,'message'=>'查看更多验收项','process_time'=>time())); exit;
    }
}

