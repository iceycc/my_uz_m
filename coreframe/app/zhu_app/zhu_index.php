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
class zhu_index extends WUZHI_foreground {
	function __construct() {
        $this->member = load_class('member', 'member');
        load_function('common', 'member');
        $this->member_setting = get_cache('setting', 'member');
        parent::__construct();
	}
  
    //工地推荐
    public function fitment_log(){
      $uid=$GLOBALS['uid'];
      $count=array();
      $counts=array();
      $arr=array();
      if(!empty($uid)){
       $result= $this->db->get_list('demand',"uid='".$uid."' and orderstatus!='终止'",'title,id,order_no,address,nodename,nodeid,orderstatus',0,1,$page,'addtime DESC');
        foreach ($result as $k => $v) {
            $resu= $this->db->get_list('demand_track',"orderid ='".$v['id']."' and nodeid!=3",'nodeid,orderid,nodename,nodeid,date1',0,1,$page,'nodeid desc','nodeid');
              if($resu[0]['nodeid']<=10){
                if(!empty($v['nodename'])){
                  $arr['nodename']=$v['nodename'];
                }else{
                  $arr['nodename']='订单待确认';
                }
                $arr['nodeid']=$v['nodeid'];
                $arr['order_no']=$v['order_no'];
                if($resu[0]['date1']){
                $arr['addtime']=substr($resu[0]['date1'],0,10);
                }else{
                $arr['addtime']='';
                }
                $arr['orderid']=$v['id'];
                $arr['status']='未开工';
              }else if($resu[0]['nodeid']>=11 && $resu[0]['nodeid']<=37){
                $arr['order_no']=$v['order_no'];
                $arr['orderid']=$v['id'];
                $arr['status']='开工';
                $arr['nodeid']=$v['nodeid'];
                $arr['nodename']=$resu[0]['nodename'];
                $arr['address']=$v['address'];
                $arr['orderstatus']=$v['orderstatus'];
                $arr['addtime']=substr($resu[0]['date1'],0,10);
                $log=$this->db->get_one('day_log',"orderid='".$resu[0]['orderid']."' and nodeid='".$resu[0]['nodeid']."'",'recphoto,check_other,check_waterdetail,check_detail');
                $log_rs=$this->db->get_list('day_log',"orderid='".$resu[0]['orderid']."' and nodeid='".$resu[0]['nodeid']."'",'recphoto,check_other,check_waterdetail,check_detail');
                foreach ($log_rs as $key => $value) {
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
                $arrs[$key]['photo']=array_filter(array_merge($arrs[$key]['img'],$arrs[$key]['imgs'],$arrs[$key]['recphoto'],$arrs[$key]['imger'],$arrs[$key]['imgers']));
                  if(empty($arrs[$key]['photo'])){
                  $arr['log_photo']='';
                  }else{
                  $arr['log_photo']="http://www.uzhuang.com/image/pic_230/".end($arrs[$key]['photo']); 
                  }
                }
                if($resu[0]['nodeid']!=27){
                  $check_detail=string2array($log['check_detail']);
                  foreach ($check_detail as $key => $value) {
                      if($value['qua']=='合格'){
                        $ar[]=$value['qua'];
                      }
                      $arr['qualified']=count($ar);
                      if($value['qua']=='不合格'){
                        $arrss[]=$value['qua'];
                      }
                      $arr['unqualified']=count($arrss);
                  }
                }else{
                  $check_detail=string2array($log['check_detail']);
                  if(string2array($log['check_waterdetail'])){
                  $check_waterdetail=string2array($log['check_waterdetail']);
                  }else{
                  $check_waterdetail=array();
                  }
                  $check=array_merge($check_detail,$check_waterdetail);
                  foreach ($check as $keys => $values) {
                      if($values['qua']=='合格'){
                        $ar[]=$values['qua'];
                      }
                      $arr['qualified']=count($ar);
                      if($values['qua']=='不合格'){
                        $arrss[]=$values['qua'];
                      }
                      $arr['unqualified']=count($arrss);
                  }
                }
              }else if($resu[0]['nodeid']>37){
                if(!empty($v['nodename'])){
                  $arr['nodename']=$resu[0]['nodename'];
                }else{
                  $arr['nodename']='订单待确认';
                }
                $arr['nodeid']=$v['nodeid'];
                $arr['order_no']=$v['order_no'];
                $arr['addtime']=substr($resu[0]['date1'],0,10);
                $arr['orderid']=$v['id'];
                $arr['status']='已竣工';
              }
              $arr['user_photo']='http://www.uzhuang.com/uploadfile/member/'.substr(md5($uid), 0, 2).'/'.$uid.'/180x180.jpg';
        }
        if($arr){
        echo json_encode(array('code'=>1,'data'=>$arr,'message'=>'最新进度','process_time'=>time())); exit;
        }else{
        echo json_encode(array('code'=>0,'data'=>null,'message'=>'无数据','process_time'=>time())); exit;
        }
      }else{
        echo json_encode(array('code'=>0,'data'=>null,'message'=>'未登录','process_time'=>time())); exit;
      }
    }

    //案例推荐
    public function case_photo(){
      $array=array();
      $city=$GLOBALS['city'];
      $style=$GLOBALS['style'];
      $uid=$GLOBALS['uid'];
      if(!empty($uid)){
       $sql = "
        select orde.id as orderid,node.nodeid
        from wz_demand as orde
        left join wz_demand_track as node on orde.id=node.orderid
        WHERE not exists (select * from wz_demand_track where orderid=node.orderid and nodeid>node.nodeid) 
        and orde.uid='{$uid}' and orde.orderstatus!='终止'
        order by node.nodeid desc";
        $query= $this->db->query($sql);
        while($datas = $this->db->fetch_array($query)) {
            $result[]=$datas;
        }
      }else{
      $result=null;
      }
      if(empty($result)){
        if($style){
          if(!empty($GLOBALS['style1'])){
            $style1=$GLOBALS['style1'];
            $company= $this->db->get_list('m_company',"areaid_2='".$city."'","id",0,1000,$page,'addtime ASC');
            foreach ($company as $key => $value) {
                  $id[]=$value['id'];
            }
            $pieces = implode(",",$id); 
             $picture= $this->db->get_list('m_picture',"companyid in (".$pieces.") and style='".$style."' and status=1","id,cover,name,style,designer",0,2,$page,'addtime desc');
             $coun=count($picture);
             //echo "<pre>";print_r($coun);
             if($coun>=2){
              $pictures= $this->db->get_list('m_picture',"companyid in (".$pieces.") and style='".$style1."' and status=1","id,cover,name,style,designer",0,1,$page,'addtime desc');
             }else if($coun==1){
              $pictures= $this->db->get_list('m_picture',"companyid in (".$pieces.") and style='".$style1."' and status=1","id,cover,name,style,designer",0,2,$page,'addtime desc');
             }else if($coun==0){

              $pictures= $this->db->get_list('m_picture',"companyid in (".$pieces.") and style='".$style1."' and status=1","id,cover,name,style,designer",0,3,$page,'addtime desc');
             }
              if($picture){
                foreach ($picture as $kk => $vv) {
                  $arr[]=$vv; 
                }
              }else{
                $arr[]=array();
              }
              
              if($pictures){
                foreach ($pictures as $kks => $vvs) {
                  $arrs[]=$vvs;  
                }
              }else{
                $arrs[]=array();
              }
            $a=array_values(array_filter(array_merge($arr,$arrs)));
          }else{
            $company= $this->db->get_list('m_company',"areaid_2='".$city."'","id",0,1000,$page,'addtime ASC');
            foreach ($company as $key => $value) {
               $id[]=$value['id'];
            }
            $pieces = implode(",",$id);
            $picture= $this->db->get_list('m_picture',"companyid in (".$pieces.") and style='".$style."' and status=1","id,cover,name,style,designer",0,3,$page,'addtime desc');
              foreach ($picture as $kk => $vv) {
                $a[]=$vv;  
              }
          }
        }else{
          $configs_picture = get_config('picture_config');
          $res=array_rand($configs_picture['style'],1);
          $company= $this->db->get_list('m_company',"areaid_2='".$city."'","id",0,1000,$page,'addtime ASC');
            foreach ($company as $key => $value) {
              $id[]=$value['id'];
            }
          $pieces = implode(",",$id);
          $picture= $this->db->get_list('m_picture',"companyid in (".$pieces.") and style='".$res."' and status=1","id,cover,name,style,designer",0,3,$page,'addtime desc');
          foreach ($picture as $kk => $vv) {
              $a[]=$vv;  
          }
        }
        //echo "<pre>";print_r($a);exit;
        $configs_picture = get_config('picture_config');
        foreach ($a as $keys => $values) {
          $picture[$keys]=$this->db->get_one('m_company_team',"id='".$values['designer']."'",'title');
          $picture[$keys]['cover']=getMImgShow($values['cover'],'original');
          $picture[$keys]['name']=$values['name'];
          $pp=trim($values['style'],',');
          $ss=explode(',',$pp);
            for($a=0;$a<count($ss);$a++){
                $picture[$keys]['style']=$configs_picture['style'][$ss[$a]];
            }
          $picture[$keys]['id']=$values['id'];
        }
      }
      if($picture){
      echo json_encode(array('code'=>1,'data'=>$picture,'message'=>'推送风格存在','process_time'=>time())); exit;
      }else{
      echo json_encode(array('code'=>0,'data'=>null,'message'=>'推送风格不存在','process_time'=>time())); exit;
      }
    }

    private function getNode(){
        $data = array();
        $where = "node_type='normal' and disabled='false' and is_used='true'";
        foreach($this->db->get_list('f_node',$where,'node_id,node_name,parent_id') as $item){
            $nodeinfo['previous'][$item['node_id']] = $item;
            $data[$item['parent_id']] = $item;
        }
        foreach($data as $key => $value){
            $nodeinfo['next'][$value['node_id']] = array(
                'node_id' => $value['node_id'],
                'node_name' => $value['node_name'],
                'next_id' => $data[$value['node_id']]['node_id'],
            );
        }
        unset($data);
        return $nodeinfo;
    }
    //推荐装修攻略
    public function getOrder(){
        $uid = intval($GLOBALS['uid']);
        $nodes = $this->getNode();
        $status=$GLOBALS['status'];
        $result= $this->db->get_list('demand',"uid='".$uid."' and orderstatus!='终止'",'id',0,1,$page,'addtime DESC');
        if($result){
        $res= $this->db->get_list('demand_track',"orderid='".$result[0]['id']."'",'orderid,nodeid',0,1,$page,'nodeid DESC');
        }
        if($res){
            $xnode = $nodes['previous'][$res[0]['nodeid']];
            $return[] = $this->nodeReflection('',$xnode['node_id']);
        }else{
          if(empty($return)){
              $return[] = $this->nodeReflection($status);
          }
        }
        $nodes = $this->getNode();
        if($return){
        echo json_encode(array('code'=>1,'data'=>$return,'message'=>'推送装修攻略','process_time'=>time())); exit;
        }else{
        echo json_encode(array('code'=>0,'data'=>null,'message'=>'推送装修攻略','process_time'=>time())); exit;
        }
    }

    public function nodeReflection($status, $node=0){
        $args = array();
        $flag = false;
        if(empty($status) && empty($node)){
            $data['total'] = 3;
            $args['radio'] = array(
                'where' => 'cid=290 and status=9',
                'limit' => 1,
            );
            $args['article'] = array(
                'where' => 'cid in (66,67,68,69,70,71,72,73,74,75,76,81,82,83) and status=9',
                'limit' => 2,
            );
            $flag = true;
        }elseif(empty($node)){
            $data['total'] = 3;
            switch($status){
                case 1:
                    $data['title'] = '装修前';
                    $args['radio'] = array(
                        'where' => "cid=290 and status=9 and typeLabel!=',,' and (typeLabel LIKE '%,".'66'.",%' or typeLabel LIKE '%,".'67'.",%' or typeLabel LIKE '%,".'68'.",%' or typeLabel LIKE '%,".'69'.",%')",
                        'limit' => 1,
                    );
                    $args['article'] = array(
                        'where' => "cid in (66,67,68,69) and status=9",
                        'limit' => 3,
                    );
                    break;
                case 2:
                    $configs_picture = get_config('picture_config');
                    $set_node = $GLOBALS['set_node'];
                    $data['title'] = $configs_picture['Decoration_class'][$set_node];
                    if($set_node=='73'){
                      $args['radio'] = array(
                          'where' => "cid=290 and status=9 and typeLabel!=',,' and (typeLabel LIKE '%,".'73'.",%' or typeLabel LIKE '%,".'74'.",%')",
                          'limit' => 1,
                      );
                      $args['article'] = array(
                        'where' => "cid in (73,74) and status=9",
                        'limit' => 3,
                    );
                    }else{
                      $args['radio'] = array(
                          'where' => "cid=290 and status=9 and typeLabel!=',,' and typeLabel LIKE '%,".$set_node.",%'",
                          'limit' => 1,
                      );
                      $args['article'] = array(
                        'where' => "cid='".$set_node."' and status=9",
                        'limit' => 3,
                      );
                    }
                    break;
                case 3:
                    $data['title'] = '装修后';
                    $args['radio'] = array(
                        'where' => "cid=290 and status=9 and typeLabel!=',,' and (typeLabel LIKE '%,".'81'.",%' or typeLabel LIKE '%,".'82'.",%' or typeLabel LIKE '%,".'83'.",%')",
                        'limit' => 1,
                    );
                    $args['article'] = array(
                        'where' => "cid in (81,82,83) and status=9",
                        'limit' => 3,
                    );
                    break;
            }
        }elseif($node==21){
            $data['total'] = 5;
            $data['title'] = '拆改和水电';
            $where = "cid=290 and typeLabel!=',,' and (typeLabel LIKE '%,".'70'.",%' or typeLabel LIKE '%,".'71'.",%') and status=9";
            $ress=$this->db->get_one('faq',$where,'id,title,remark,thumb,url',0,1,$page,'addtime desc');
            if($ress){
                $ress['thumb'] = $ress['thumb']?"http://www.uzhuang.com/image/pic_230/".$ress['thumb']:'';
                $data['arr'][] = $ress;
                $data['total']--;
                foreach($this->db->get_list('faq',"cid=70 and status=9",'id,title,remark,thumb',0,2,$page,'addtime desc') as $item){
                    $item['thumb'] = $item['thumb']?"http://www.uzhuang.com/image/pic_230/".$item['thumb']:'';
                    if(WEBURL=='http://m.uzhuang.com/'){
                    $item['urls']="http://m.uzhuang.com/mobile-uzapp_article.html?uzid=".$item['id'];
                    }else if(WEBURL=='http://mdev.uz.com/'){
                    $item['urls']="http://mdev.uz.com/mobile-uzapp_article.html?uzid=".$item['id'];
                    }else if(WEBURL=='http://mtest.uz.com/'){
                    $item['urls']="http://mtest.uz.com/mobile-uzapp_article.html?uzid=".$item['id'];
                    }else if(WEBURL=='http://mpre.uz.com/'){
                    $item['urls']="http://mpre.uz.com/mobile-uzapp_article.html?uzid=".$item['id'];
                    }
                    if(WEBURL=='http://m.uzhuang.com/'){
                        $item['share']="http://m.uzhuang.com/mobile-uzapp_share.html?uzid=".$item['id'];
                    }else if(WEBURL=='http://mdev.uz.com/'){
                        $item['share']="http://mdev.uz.com/mobile-uzapp_share.html?uzid=".$item['id'];
                    }else if(WEBURL=='http://mtest.uz.com/'){
                        $item['share']="http://mtest.uz.com/mobile-uzapp_share.html?uzid=".$item['id'];
                    }else if(WEBURL=='http://mpre.uz.com/'){
                        $item['share']="http://mpre.uz.com/mobile-uzapp_share.html?uzid=".$item['id'];
                    }
                    $data['arr'][] = $item;
                    $data['total']--;
                }
                foreach($this->db->get_list('faq',"cid=71 and status=9",'id,title,remark,thumb',0,$data['total'],$page,'addtime desc') as $item){
                    $item['thumb'] = $item['thumb']?"http://www.uzhuang.com/image/pic_230/".$item['thumb']:'';
                    if(WEBURL=='http://m.uzhuang.com/'){
                    $item['urls']="http://m.uzhuang.com/mobile-uzapp_article.html?uzid=".$item['id'];
                    }else if(WEBURL=='http://mdev.uz.com/'){
                    $item['urls']="http://mdev.uz.com/mobile-uzapp_article.html?uzid=".$item['id'];
                    }else if(WEBURL=='http://mtest.uz.com/'){
                    $item['urls']="http://mtest.uz.com/mobile-uzapp_article.html?uzid=".$item['id'];
                    }else if(WEBURL=='http://mpre.uz.com/'){
                    $item['urls']="http://mpre.uz.com/mobile-uzapp_article.html?uzid=".$item['id'];
                    }
                    if(WEBURL=='http://m.uzhuang.com/'){
                        $item['share']="http://m.uzhuang.com/mobile-uzapp_share.html?uzid=".$item['id'];
                    }else if(WEBURL=='http://mdev.uz.com/'){
                        $item['share']="http://mdev.uz.com/mobile-uzapp_share.html?uzid=".$item['id'];
                    }else if(WEBURL=='http://mtest.uz.com/'){
                        $item['share']="http://mtest.uz.com/mobile-uzapp_share.html?uzid=".$item['id'];
                    }else if(WEBURL=='http://mpre.uz.com/'){
                        $item['share']="http://mpre.uz.com/mobile-uzapp_share.html?uzid=".$item['id'];
                    }
                    $data['arr'][] = $item;
                }
            }else{
                foreach($this->db->get_list('faq',"cid=70 and status=9",'id,title,remark,thumb',0,3,$page,'addtime desc') as $item){
                    $item['thumb'] = $item['thumb']?"http://www.uzhuang.com/image/pic_230/".$item['thumb']:'';
                    if(WEBURL=='http://m.uzhuang.com/'){
                    $item['urls']="http://m.uzhuang.com/mobile-uzapp_article.html?uzid=".$item['id'];
                    }else if(WEBURL=='http://mdev.uz.com/'){
                    $item['urls']="http://mdev.uz.com/mobile-uzapp_article.html?uzid=".$item['id'];
                    }else if(WEBURL=='http://mtest.uz.com/'){
                    $item['urls']="http://mtest.uz.com/mobile-uzapp_article.html?uzid=".$item['id'];
                    }else if(WEBURL=='http://mpre.uz.com/'){
                    $item['urls']="http://mpre.uz.com/mobile-uzapp_article.html?uzid=".$item['id'];
                    }
                    if(WEBURL=='http://m.uzhuang.com/'){
                        $item['share']="http://m.uzhuang.com/mobile-uzapp_share.html?uzid=".$item['id'];
                    }else if(WEBURL=='http://mdev.uz.com/'){
                        $item['share']="http://mdev.uz.com/mobile-uzapp_share.html?uzid=".$item['id'];
                    }else if(WEBURL=='http://mtest.uz.com/'){
                        $item['share']="http://mtest.uz.com/mobile-uzapp_share.html?uzid=".$item['id'];
                    }else if(WEBURL=='http://mpre.uz.com/'){
                        $item['share']="http://mpre.uz.com/mobile-uzapp_share.html?uzid=".$item['id'];
                    }
                    $data['arr'][] = $item;
                    $data['total']--;
                }
                foreach($this->db->get_list('faq',"cid=71 and status=9",'id,title,remark,thumb',0,$data['total'],$page,'addtime desc') as $item){
                    $item['thumb'] = $item['thumb']?"http://www.uzhuang.com/image/pic_230/".$item['thumb']:'';
                    if(WEBURL=='http://m.uzhuang.com/'){
                    $item['urls']="http://m.uzhuang.com/mobile-uzapp_article.html?uzid=".$item['id'];
                    }else if(WEBURL=='http://mdev.uz.com/'){
                    $item['urls']="http://mdev.uz.com/mobile-uzapp_article.html?uzid=".$item['id'];
                    }else if(WEBURL=='http://mtest.uz.com/'){
                    $item['urls']="http://mtest.uz.com/mobile-uzapp_article.html?uzid=".$item['id'];
                    }else if(WEBURL=='http://mpre.uz.com/'){
                    $item['urls']="http://mpre.uz.com/mobile-uzapp_article.html?uzid=".$item['id'];
                    }
                    if(WEBURL=='http://m.uzhuang.com/'){
                        $item['share']="http://m.uzhuang.com/mobile-uzapp_share.html?uzid=".$item['id'];
                    }else if(WEBURL=='http://mdev.uz.com/'){
                        $item['share']="http://mdev.uz.com/mobile-uzapp_share.html?uzid=".$item['id'];
                    }else if(WEBURL=='http://mtest.uz.com/'){
                        $item['share']="http://mtest.uz.com/mobile-uzapp_share.html?uzid=".$item['id'];
                    }else if(WEBURL=='http://mpre.uz.com/'){
                        $item['share']="http://mpre.uz.com/mobile-uzapp_share.html?uzid=".$item['id'];
                    }
                    $data['arr'][] = $item;
                }
            }
            $data['total'] = 5;
        }elseif($node==28){
            $data['total'] = 5;
            $data['title'] = '泥瓦和木工';
            $where = "cid=290 and typeLabel!=',,' and (typeLabel LIKE '%,".'73'.",%' or typeLabel LIKE '%,".'74'.",%') and status=9";
            $ress=$this->db->get_one('faq',$where,'id,title,remark,thumb,url',0,1,$page,'addtime desc');
            if($ress){
                $ress['thumb'] = $ress['thumb']?"http://www.uzhuang.com/image/pic_230/".$ress['thumb']:'';
                $data['arr'][] = $ress;
                $data['total']--;
                foreach($this->db->get_list('faq',"cid=73 and status=9",'id,title,remark,thumb',0,2,$page,'addtime desc') as $item){
                    $item['thumb'] = $item['thumb']?"http://www.uzhuang.com/image/pic_230/".$item['thumb']:'';
                    if(WEBURL=='http://m.uzhuang.com/'){
                    $item['urls']="http://m.uzhuang.com/mobile-uzapp_article.html?uzid=".$item['id'];
                    }else if(WEBURL=='http://mdev.uz.com/'){
                    $item['urls']="http://mdev.uz.com/mobile-uzapp_article.html?uzid=".$item['id'];
                    }else if(WEBURL=='http://mtest.uz.com/'){
                    $item['urls']="http://mtest.uz.com/mobile-uzapp_article.html?uzid=".$item['id'];
                    }else if(WEBURL=='http://mpre.uz.com/'){
                    $item['urls']="http://mpre.uz.com/mobile-uzapp_article.html?uzid=".$item['id'];
                    }
                    if(WEBURL=='http://m.uzhuang.com/'){
                        $item['share']="http://m.uzhuang.com/mobile-uzapp_share.html?uzid=".$item['id'];
                    }else if(WEBURL=='http://mdev.uz.com/'){
                        $item['share']="http://mdev.uz.com/mobile-uzapp_share.html?uzid=".$item['id'];
                    }else if(WEBURL=='http://mtest.uz.com/'){
                        $item['share']="http://mtest.uz.com/mobile-uzapp_share.html?uzid=".$item['id'];
                    }else if(WEBURL=='http://mpre.uz.com/'){
                        $item['share']="http://mpre.uz.com/mobile-uzapp_share.html?uzid=".$item['id'];
                    }
                    $data['arr'][] = $item;
                    $data['total']--;
                }
                foreach($this->db->get_list('faq',"cid=74 and status=9",'id,title,remark,thumb',0,$data['total'],$page,'addtime desc') as $item){
                    $item['thumb'] = $item['thumb']?"http://www.uzhuang.com/image/pic_230/".$item['thumb']:'';
                    if(WEBURL=='http://m.uzhuang.com/'){
                    $item['urls']="http://m.uzhuang.com/mobile-uzapp_article.html?uzid=".$item['id'];
                    }else if(WEBURL=='http://mdev.uz.com/'){
                    $item['urls']="http://mdev.uz.com/mobile-uzapp_article.html?uzid=".$item['id'];
                    }else if(WEBURL=='http://mtest.uz.com/'){
                    $item['urls']="http://mtest.uz.com/mobile-uzapp_article.html?uzid=".$item['id'];
                    }else if(WEBURL=='http://mpre.uz.com/'){
                    $item['urls']="http://mpre.uz.com/mobile-uzapp_article.html?uzid=".$item['id'];
                    }
                    if(WEBURL=='http://m.uzhuang.com/'){
                        $item['share']="http://m.uzhuang.com/mobile-uzapp_share.html?uzid=".$item['id'];
                    }else if(WEBURL=='http://mdev.uz.com/'){
                        $item['share']="http://mdev.uz.com/mobile-uzapp_share.html?uzid=".$item['id'];
                    }else if(WEBURL=='http://mtest.uz.com/'){
                        $item['share']="http://mtest.uz.com/mobile-uzapp_share.html?uzid=".$item['id'];
                    }else if(WEBURL=='http://mpre.uz.com/'){
                        $item['share']="http://mpre.uz.com/mobile-uzapp_share.html?uzid=".$item['id'];
                    }
                    $data['arr'][] = $item;
                }
            }else{
                foreach($this->db->get_list('faq',"cid=73 and status=9",'id,title,remark,thumb',0,3,$page,'addtime desc') as $item){
                    $item['thumb'] = $item['thumb']?"http://www.uzhuang.com/image/pic_230/".$item['thumb']:'';
                    $data['arr'][] = $item;
                    $data['total']--;
                }
                foreach($this->db->get_list('faq',"cid=75 and status=9",'id,title,remark,thumb',0,$data['total'],$page,'addtime desc') as $item){
                    $item['thumb'] = $item['thumb']?"http://www.uzhuang.com/image/pic_230/".$item['thumb']:'';
                    $data['arr'][] = $item;
                }
            }
            $data['total'] = 5;
        }else{
            $data['total'] = 5;
            if($node>=1 && $node<=19){
                $data['title'] = '装修前';
                $where1 = "cid=290 and typeLabel!=',,' and (typeLabel LIKE '%,".'66'.",%' or typeLabel LIKE '%,".'67'.",%' or typeLabel LIKE '%,".'68'.",%' or typeLabel LIKE '%,".'69'.",%') and status=9";
                $where2 = "cid in (66,67,68,69) and status=9";
            }elseif($node>=25 && $node<=27){
                $data['title'] = '防水';
                $where1 = "cid=290 and typeLabel!=',,' and (typeLabel LIKE '%,".'72'.",%') and status=9";
                $where2 = "cid in (72) and status=9";
            }elseif($node>=29 && $node<=31){
                $data['title'] = '油漆';
                $where1 = "cid=290 and typeLabel!=',,' and (typeLabel LIKE '%,".'75'.",%') and status=9";
                $where2 = "cid in (75) and status=9";
            }elseif($node>=33 && $node<=36){
                $data['title'] = '竣工';
                $where1 = "cid=290 and typeLabel!=',,' and (typeLabel LIKE '%,".'76'.",%') and status=9";
                $where2 = "cid in (76) and status=9";
            }elseif($node>=37 && $node<=51){
                $data['title'] = '装修后';
                $where1 = "cid=290 and typeLabel!=',,' and (typeLabel LIKE '%,".'81'.",%' or typeLabel LIKE '%,".'82'.",%' or typeLabel LIKE '%,".'83'.",%') and status=9";
                $where2 = "cid in (81,82,83) and status=9";
            }
            $args['radio'] = array(
                'where' => $where1,
                'limit' => 1,
            );
            $args['article'] = array(
                'where' => $where2,
                'limit' => 5,
            );
        }
        if(!empty($args))$data['arr'] = array();
        foreach($args as $key => $value){
            $_count = $this->db->count('faq',$value['where']);
            if($_count['num']<1) continue;
            $temp = array();
            if($flag)
            for($i=0; $i<$_count['num']; $i++){
                if(count($temp)>$value['limit']-1) break;
                $offset = rand(1, $_count['num'])-1;
                if(in_array($offset,$temp)) continue;
                $temp[] = $offset;
                foreach ($this->db->get_list('faq',$value['where'],'id,title,remark,thumb',$offset,1,1,'addtime desc') as $item) {
                    $item['thumb'] = $item['thumb']?"http://www.uzhuang.com/image/pic_230/".$item['thumb']:'';
                    if(WEBURL=='http://m.uzhuang.com/'){
                    $item['urls']="http://m.uzhuang.com/mobile-uzapp_article.html?uzid=".$item['id'];
                    }else if(WEBURL=='http://mdev.uz.com/'){
                    $item['urls']="http://mdev.uz.com/mobile-uzapp_article.html?uzid=".$item['id'];
                    }else if(WEBURL=='http://mtest.uz.com/'){
                    $item['urls']="http://mtest.uz.com/mobile-uzapp_article.html?uzid=".$item['id'];
                    }else if(WEBURL=='http://mpre.uz.com/'){
                    $item['urls']="http://mpre.uz.com/mobile-uzapp_article.html?uzid=".$item['id'];
                    }
                    //分享URL
                    if(WEBURL=='http://m.uzhuang.com/'){
                        $item['share']="http://m.uzhuang.com/mobile-uzapp_share.html?uzid=".$item['id'];
                    }else if(WEBURL=='http://mdev.uz.com/'){
                        $item['share']="http://mdev.uz.com/mobile-uzapp_share.html?uzid=".$item['id'];
                    }else if(WEBURL=='http://mtest.uz.com/'){
                        $item['share']="http://mtest.uz.com/mobile-uzapp_share.html?uzid=".$item['id'];
                    }else if(WEBURL=='http://mpre.uz.com/'){
                        $item['share']="http://mpre.uz.com/mobile-uzapp_share.html?uzid=".$item['id'];
                    }
                    $data['arr'][] = $item;
                }
            }else{
                if($value['limit']==1){
                  foreach ($this->db->get_list('faq',$value['where'],'id,title,remark,thumb,url',0,$value['limit'],1,'addtime desc') as $item) {
                      $item['thumb'] = $item['thumb']?"http://www.uzhuang.com/image/pic_230/".$item['thumb']:'';
                      $data['arr'][] = $item;
                    }
                }else{
                  foreach ($this->db->get_list('faq',$value['where'],'id,title,remark,thumb',0,$value['limit'],1,'addtime desc') as $item) {
                    $item['thumb'] = $item['thumb']?"http://www.uzhuang.com/image/pic_230/".$item['thumb']:'';
                    if(WEBURL=='http://m.uzhuang.com/'){
                    $item['urls']="http://m.uzhuang.com/mobile-uzapp_article.html?uzid=".$item['id'];
                    }else if(WEBURL=='http://mdev.uz.com/'){
                    $item['urls']="http://mdev.uz.com/mobile-uzapp_article.html?uzid=".$item['id'];
                    }else if(WEBURL=='http://mtest.uz.com/'){
                    $item['urls']="http://mtest.uz.com/mobile-uzapp_article.html?uzid=".$item['id'];
                    }else if(WEBURL=='http://mpre.uz.com/'){
                    $item['urls']="http://mpre.uz.com/mobile-uzapp_article.html?uzid=".$item['id'];
                    }
                    //分享URL
                    if(WEBURL=='http://m.uzhuang.com/'){
                        $item['share']="http://m.uzhuang.com/mobile-uzapp_share.html?uzid=".$item['id'];
                    }else if(WEBURL=='http://mdev.uz.com/'){
                        $item['share']="http://mdev.uz.com/mobile-uzapp_share.html?uzid=".$item['id'];
                    }else if(WEBURL=='http://mtest.uz.com/'){
                        $item['share']="http://mtest.uz.com/mobile-uzapp_share.html?uzid=".$item['id'];
                    }else if(WEBURL=='http://mpre.uz.com/'){
                        $item['share']="http://mpre.uz.com/mobile-uzapp_share.html?uzid=".$item['id'];
                    }
                    $data['arr'][] = $item;
                }
              }
            }
        }
        while((count($data['arr'])-$data['total'])>0){
            array_pop($data['arr']);
            reset($data['arr']);
        }
        unset($data['total']);
        return $data;
    }
    //推荐装修工地
    public function log(){
      $city=$GLOBALS['city'];
      $status=$GLOBALS['status'];
      $uid=$GLOBALS['uid'];
      $nodes = $this->getNode();
      if($uid){
      $result= $this->db->get_list('demand',"uid='".$uid."' and orderstatus!='终止'",'id',0,1,$page,'addtime DESC');
      }
      if($result[0]['id']){
      $res= $this->db->get_list('demand_track',"orderid='".$result[0]['id']."'",'orderid,nodeid',0,1,$page,'nodeid DESC');
      }
      //echo "<pre>";print_r($result);exit;
        if($res){
          $xnode = $nodes['previous'][$res[0]['nodeid']];
          if($xnode['node_id']>=1 && $xnode['node_id']<=19){
            $where="nodeid in(11,12,13,15,17,19) and areaid_2='".$city."' and nodename!='预约量房' and url LIKE '%shows%' and orderid >13087";
            $where1="nodeid in(11,12,13,15,17,19) and nodename!='预约量房' and url LIKE '%shows%' and orderid >13087";
            $title="装修前";
          }elseif ($xnode['node_id']==21) {
            $where="nodeid=21 and areaid_2='".$city."' and nodename!='预约量房' and url LIKE '%shows%' and orderid >13087";
            $where1="nodeid=21 and nodename!='预约量房' and url LIKE '%shows%' and orderid >13087";
            $title="开工";
          }else if($xnode['node_id']>=25 && $xnode['node_id']<=27){
            $where="nodeid in (25,27) and areaid_2='".$city."' and nodename!='预约量房' and url LIKE '%shows%' and orderid >13087";
            $where1="nodeid in (25,27) and nodename!='预约量房' and url LIKE '%shows%' and orderid >13087";
            $title="水电";
          }else if($xnode['node_id']==28){
            $where="nodeid=28 and areaid_2='".$city."' and nodename!='预约量房' and url LIKE '%shows%' and orderid >13087";
            $where1="nodeid=28 and nodename!='预约量房' and url LIKE '%shows%' and orderid >13087";
            $title="防水";
          }else if($xnode['node_id']>=29 && $xnode['node_id']<=31){
            $where="nodeid in (29,31) and areaid_2='".$city."' and nodename!='预约量房' and url LIKE '%shows%' and orderid >13087";
            $where1="nodeid in (29,31) and nodename!='预约量房' and url LIKE '%shows%' and orderid >13087";
            $title="瓦木";
          }else if($xnode['node_id']>=33 && $xnode['node_id']<=35){
            $where="nodeid in (33,35) and areaid_2='".$city."' and nodename!='预约量房' and url LIKE '%shows%' and orderid >13087";
            $where1="nodeid in (33,35) and nodename!='预约量房' and url LIKE '%shows%' and orderid >13087";
            $title="油漆";
          }elseif ($xnode['node_id']==36) {
            $where="nodeid =36 and areaid_2='".$city."' and nodename!='预约量房' and url LIKE '%shows%' and orderid >13087";
            $where1="nodeid=36 and nodename!='预约量房' and url LIKE '%shows%' and orderid >13087";
            $title="安装";
          }else if($xnode['node_id']==37){
            $where="nodeid=37 and areaid_2='".$city."' and nodename!='预约量房' and url LIKE '%shows%' and orderid >13087";
            $where1="nodeid=37 and nodename!='预约量房' and url LIKE '%shows%' and orderid >13087";
            $title="竣工";
          }else if($xnode['node_id']>=39 && $xnode['node_id']<=51){
            $where="nodeid in (39,43,45,49,51) and areaid_2='".$city."' and nodename!='预约量房' and url LIKE '%shows%' and orderid >13087";
            $where1="nodeid in (39,43,45,49,51) and nodename!='预约量房' and url LIKE '%shows%' and orderid >13087";
            $title="装修后";
          }
        }else{
        if($status){
          if($status==1){
            $where="nodeid in(11,12,13,15,17,19,21) and areaid_2='".$city."' and nodename!='预约量房' and url LIKE '%shows%' and orderid >13087";
            $where1="nodeid in(11,12,13,15,17,19,21) and nodename!='预约量房' and url LIKE '%shows%' and orderid >13087";
            $title="装修前";
          }else if($status==2){
            $set_node=$GLOBALS['set_node'];
            switch ($set_node){
              case 70:
                $where="nodeid=23 and areaid_2='".$city."' and nodename!='预约量房' and url LIKE '%shows%' and orderid >13087";
                $where1="nodeid=23 and nodename!='预约量房' and url LIKE '%shows%' and orderid >13087";
                $title="水电";
              break;  
              case 71:
                $where="nodeid in(25,27) and areaid_2='".$city."' and nodename!='预约量房' and url LIKE '%shows%' and orderid >13087";
                $where1="nodeid in(25,27) and nodename!='预约量房' and url LIKE '%shows%' and orderid >13087";
                $title="水电";
              break;  
              case 72:
                $where="nodeid=28 and areaid_2='".$city."' and nodename!='预约量房' and url LIKE '%shows%' and orderid >13087";
                $where1="nodeid=28 and nodename!='预约量房' and url LIKE '%shows%' and orderid >13087";
                $title="防水";
              break;
              case 73:
                $where="nodeid in(29,31) and areaid_2='".$city."' and nodename!='预约量房' and url LIKE '%shows%' and orderid >13087";
                $where1="nodeid in(29,31) and nodename!='预约量房' and url LIKE '%shows%' and orderid >13087";
                $title="泥木";
              break;
              case 75:
                $where="nodeid in(33,35) and areaid_2='".$city."' and nodename!='预约量房' and url LIKE '%shows%' and orderid >13087";
                $where1="nodeid in(33,35) and nodename!='预约量房' and url LIKE '%shows%' and orderid >13087";
                $title="油漆";
              break;
              case 76:
                $where="nodeid=37 and areaid_2='".$city."' and nodename!='预约量房' and url LIKE '%shows%' and orderid >13087";
                $where1="nodeid=37 and nodename!='预约量房' and url LIKE '%shows%' and orderid >13087";
                $title="竣工";
              break;
            }
          }else if($status==3){
            $where="nodeid in(39,43,45,49,51) and areaid_2='".$city."' and nodename!='预约量房' and url LIKE '%shows%' and orderid >13087";
            $where1="nodeid in(39,43,45,49,51) and nodename!='预约量房' and url LIKE '%shows%' and orderid >13087";
            $title="装修后";
          }
        }
        }
        if($where){
          $log = $this->db->get_list('day_log_demand_list',$where,'logname', 0, 1, $page, 'addtime DESC');
            if(!empty($log)){
            $log_rs = array();
            $query = $this->db->query("select * from wz_day_log_demand_list where areaid_2 is not null order by (case when ".$where." then 1 else 0 end) desc,addtime DESC limit 0,2;");
            while($data = $this->db->fetch_array($query)) {
              $log_rs[] = $data;
            }
            $log = $this->db->get_one('f_node','node_id="'.$re[0].'"','node_name', 0, 1, $page, 'addtime DESC');
              foreach ($log_rs as $key => $value) {
               $log_rs[$key]['titles']=$title;
              }
            }else{
            $log_rs = array();
            $query = $this->db->query("select * from wz_day_log_demand_list where areaid_2 is not null order by (case when ".$where1." then 1 else 0 end) desc,addtime DESC limit 0,2;");
            while($data = $this->db->fetch_array($query)) {
              $log_rs[] = $data;
            }
              $log = $this->db->get_one('f_node','node_id="'.$re[0].'"','node_name', 0, 1, $page, 'addtime DESC');
              foreach ($log_rs as $key => $value) {
               $log_rs[$key]['titles']=$title;
              }
            }
        }
        foreach ($log_rs as $key => $value) {
          $resul=$this->db->count('log_evaluate',"orderid='".$value['orderid']."'");
          $arr[$key]['logname']=$value['logname'];
          $arr[$key]['nodeid']=$value['nodeid'];
          $arr[$key]['uids']=$value['uid'];
          $arr[$key]['nodename']=$value['nodename'];
          $arr[$key]['orderid']=$value['orderid'];
          $arr[$key]['browse_count']=$value['browse_count'];
          $arr[$key]['message']=$resul['num'];
          $arr[$key]['addtime']=time_format1(strtotime($value['addtime']));
          $arr[$key]['titles']=$value['titles'];
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
          $arrs[$key]['photo']=array_filter(array_merge($arrs[$key]['img'],$arrs[$key]['imgs'],$arrs[$key]['recphoto'],$arrs[$key]['imger'],$arrs[$key]['imgers']));
            if($arrs[$key]['photo']){
            $arr[$key]['log_photo']="http://www.uzhuang.com/image/pic_230/".end($arrs[$key]['photo']); 
            }else if($value['thumb']){
            $arr[$key]['log_photo']="http://www.uzhuang.com/image/pic_230/".$value['thumb']; 
            }else{
            $arr[$key]['log_photo']='';
            }
              $log_r= $this->db->get_one('member_hk_data',array('uid'=>$value['userid']), 'uid,gjname,personalphoto,level');
              $arr[$key]['uid']=$log_r['uid'];
              $arr[$key]['gjname']=$log_r['gjname'];
              $arr[$key]['personalphoto']=$log_r['personalphoto'];
              if($log_r['level']==1){
                  $arr[$key]['level']='1';
                  }else{
                  $arr[$key]['level']='2';
              }
        }
        foreach ($arr as $pk => $pl) {
           $uid_log=$this->db->get_one('day_log_demand_list',"`orderid`= '".$pl['orderid']."'",'title,uid');
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
        }
      $data['arr']=$arr;
      $data['titles']=$arr[0]['titles'];
      //echo "<pre>";print_r($data);exit;
      if($data){
      echo json_encode(array('code'=>1,'data'=>$data,'message'=>'推荐装修工地存在','process_time'=>time())); exit;
      }else{
      echo json_encode(array('code'=>0,'data'=>null,'message'=>'推荐装修工地bu存在','process_time'=>time())); exit;
      }
    }


    public function counts(){
      $uid=$GLOBALS['uid'];
      $sql = "
        select orde.id as orderid,node.nodeid
        from wz_demand as orde
        left join wz_demand_track as node on orde.id=node.orderid
        WHERE not exists (select * from wz_demand_track where orderid=node.orderid and nodeid>node.nodeid) 
        and orde.uid='{$uid}' and orde.orderstatus!='终止'
        order by node.nodeid desc";
      $query= $this->db->query($sql);
      while($datas = $this->db->fetch_array($query)) {
          $re[]=$datas['nodeid'];
      }
      if(empty($re)){
         $data=9;
      }else{
         $data=10;
      }
      echo json_encode(array('code'=>1,'data'=>$data,'message'=>'推荐装修工地存在','process_time'=>time())); exit;
    }







}