<?php
// +----------------------------------------------------------------------
// | wuzhicms [ ÎåÖ¸»¥ÁªÍøÕ¾ÄÚÈÝ¹ÜÀíÏµÍ³ ]
// | Copyright (c) 2014-2015 http://www.wuzhicms.com All rights reserved.
// | Licensed ( http://www.wuzhicms.com/licenses/ )
// | Author: wangcanjia <phpip@qq.com>
// +----------------------------------------------------------------------
/**
 * ÊÕ²Ø¼Ð
 */
header("Access-Control-Allow-Origin: *");
defined('IN_WZ') or exit('No direct script access allowed');
load_class('foreground', 'member');
load_function('common','member');
class member extends WUZHI_foreground {
    function __construct() {
        $this->member = load_class('member', 'member');
        load_function('common', 'member');
        $this->member_setting = get_cache('setting', 'member');
        parent::__construct();
        $auth = get_cookie('auth');
          $uid=$GLOBALS['uid'];
        if(empty($uid)){
            echo json_encode(array('code'=>0,'data'=>array('member'=>null),'message'=>L('login_please'),'process_time'=>time()));exit;
        }
        $this->member_info = $this->db->get_list('member', "`uid`='$uid'", 'uid,username,avatar,mobile,sex,age,nickname');
        $this->member_info = $this->member_info[0];
        if(empty($this->member_info['uid'])){
            echo json_encode(array('code'=>0,'data'=>array('member'=>null),'message'=>L('login_please'),'process_time'=>time()));exit;
        }
        $file = 'uploadfile/member/'.substr(md5($this->member_info['uid']), 0, 2).'/'.$uid.'/180x180.jpg';
        //var_dump($this->member_info['avatar']);exit;
        if($this->member_info['avatar']==1){
          $this->member_info['avatar'] ='http://www.uzhuang.com/'.$file;
        }else if($this->member_info['avatar']==4){
          $photo=$this->db->get_list('third_login',"uid='".$uid."'",'*');
          $a=unserialize($photo[0]['data']);
          $this->member_info['avatar']=$a[2];             
        }else{
           $this->member_info['avatar']= R.'images/userface.png';
      }
    }
  /**
   * 个人中心
   */
    public function index(){
        $temp = array(
            'design' => $this->db->count('favorite', "`uid`='".$this->member_info['uid']."' AND `type`=10"),
            'picture' => $this->db->count('favorite', "`uid`='".$this->member_info['uid']."' AND `type`=11"),
            'company' => $this->db->count('favorite', "`uid`='".$this->member_info['uid']."' AND `type`=12"),
            'day_log' => $this->db->count('favorite', "`uid`='".$this->member_info['uid']."' AND `type`=13"),
            'decorate_class' => $this->db->count('favorite', "`uid`='".$this->member_info['uid']."' AND `type`=16"),
        );
        $return =array(
            'design'=>$temp['design']['num'],
            'company'=>$temp['company']['num'],
            'picture'=>$temp['picture']['num'],
            'day_log'=>$temp['day_log']['num'],
            'decorate_class'=>$temp['decorate_class']['num'],
            'member'=>$this->member_info,
        );
        echo json_encode(array('code'=>1,'data'=>$return,'message'=>'','process_time'=>time())); exit;
    }
    /**
   * 个人中心
   */
    public function setting(){
             $avater = $_FILES;
             $mobile = remove_xss($GLOBALS['mobile']);
             $sex = remove_xss($GLOBALS['sex']);
             $uid = remove_xss($GLOBALS['uid']);
             $age = intval($GLOBALS['age']);
             $nickname = remove_xss($GLOBALS['nickname']);
             //$a = 'uid:'.$uid.'---'.'mobile:'.$mobile.'----'.'sex:'.$sex.'---'.'age'.$age.'time:'.date('Y-m-d H:i:s',time());
             //error_log(print_r($a,1),3,'/alidata/www/m.uzhuang.com/www/res/log/log.txt');
             //error_log(print_r($_FILES,1),3,'/alidata/www/m.uzhuang.com/www/res/log/loga.txt');
                if(empty($uid)){
                    echo json_encode(array('code'=>0,'message'=>'用户uid不存在','process_time'=>time()));exit;
                }
                if(empty($mobile) ){
                    echo json_encode(array('code'=>0,'message'=>'手机号不能为空','process_time'=>time()));exit;
                }
                if( !isset($sex)){
                    echo json_encode(array('code'=>0,'message'=>'性别参数空','process_time'=>time()));exit;
                }
                if( !isset($nickname)){
                    echo json_encode(array('code'=>0,'message'=>'昵称参数空','process_time'=>time()));exit;
                }
                if( !isset($age)){
                    echo json_encode(array('code'=>0,'message'=>'年龄参数空','process_time'=>time()));exit;
                }
                $uid = $this->db->get_one('member',array('mobile'=>$mobile),'uid,sex,nickname,age,avatar');
                if(!$uid){
                    echo json_encode(array('code'=>0,'message'=>'获取信息失败','process_time'=>time()));exit;
                }
                if($_FILES['picture1']['size'] >= (3*1024*1024) ){
                    echo json_encode(array('code'=>0,'message'=>'图片过大','process_time'=>time()));exit;
                }
                $ava = $uid['avatar'];
                if(!empty($avater)){
                  //echo "string";exit;
                    $ava = 1;
                    $dir = substr(md5($uid['uid']),0,2).'/'.$uid['uid'].'/';
                    $dir = WWW_ROOT.'uploadfile/member/'.$dir;

                    if(!file_exists($dir)){
                        mkdir($dir,777,true);
                    }

                    $filename = $dir.'180x180.jpg';
                    move_uploaded_file($_FILES['picture1']['tmp_name'],$filename);
                    $isimg = exif_imagetype($filename);

                }
                if(empty($sex) || ($sex == '女')){
                    $sex = 0;
                }elseif ($sex == '男') {
                    $sex = 1;
                }
                if(empty($nickname)){
                    $nickname = $uid['nickname'];
                }
                if(empty($age)){
                    $age = $uid['age'];
                }
             $avatararr = array('30x30.jpg', '45x45.jpg', '90x90.jpg', '180x180.jpg');
             $result = $this->db->update('member', array('avatar'=>$ava,'nickname'=>$nickname,'sex'=>$sex,'age'=>$age), array('uid'=>$uid['uid']));
             $info = array();
             $info['avatar'] = isset($dir)?avatar($uid['uid'],180):'';

             $info['nickname'] = $nickname;
             $info['sex'] = $sex==1?'男':'女';
             $info['age'] = $age;
                if($result){
                    echo json_encode(array('code'=>1,'data'=>$info,'message'=>'操作成功','process_time'=>time()));exit;
                }else{
                    echo json_encode(array('code'=>0,'data'=>null,'message'=>'操作失败','process_time'=>time()));exit;
                }
    }

       
           
      
      
      

   /**
   * 精品案例收藏
   */
    public function photos() {
        $page = isset($GLOBALS['page']) ? intval($GLOBALS['page']) : 1;
        $page = max($page,1);
        $uid = $this->member_info['uid'];
        $publisher = $this->memberinfo['username'];
        $result_rs = $this->db->get_list('favorite', "`uid`='$uid' AND `type` IN(11)", '*',0,100,$page,'addtime desc');
        $result = array();
        foreach($result_rs as $r) {
            if($r['type']==11) {
              $rs= $this->db->get_one('m_picture','status=1 and id="'.$r['keyid'].'"','id,status,cover,name,style,housetype','0','','','UNIX_TIMESTAMP(addtime) DESC');
                  //循环出风格的索引,找对应的中文
                         $configs_picture = get_config('picture_config');
                         $pp=trim($rs['style'],',');
                         $ss=explode(',',$pp);
                           for($a=0;$a<count($ss);$a++){
                               $style[$a]=$configs_picture['style'][$ss[$a]];
                           }    
                            $rs['style']=$style;
                  //循环出风格的索引,找对应的中文
                         $p1=trim($rs['housetype'],',');
                         $s1=explode(',',$p1);
                           for($i=0;$i<count($s1);$i++){
                               $housetype[$i]=$configs_picture['house'][$s1[$i]];
                           }    
                            $rs['housetype']=$housetype;
                $rs['cover']=getMImgShow($rs['cover'],'original');
                $rs['fid'] = $r['fid'];
                $rs['url'] = $r['url'];
            }
            $result[] = $rs;
        }
        $pages = $this->db->pages;
        $total = $this->db->number;
        $configs = get_config('picture_config');    
        echo json_encode(array('code'=>1,'data'=>$result,'message'=>'','process_time'=>time()));exit;
    }

    public function fav() {
        $id = intval($GLOBALS['id']);
        if(empty($id) || empty($GLOBALS['type']) || !in_array($GLOBALS['type'], array('picture','company','design'))){
            echo json_encode(array('code'=>0,'data'=>null,'message'=>"参数非法",'process_time'=>time()));exit;
        }
        $uid = $this->member_info['uid'];
        switch($GLOBALS['type']){
            case 'picture':
                $r = $this->db->get_one('favorite', array('uid' => $uid,'type'=>11,'keyid'=>$id));
                $mec_r = $this->db->get_one('m_picture', array('id'=>$id),'name,url,collectnum');
                if(empty($mec_r)){
                    echo json_encode(array('code'=>0,'data'=>null,'message'=>"精品案例不存在",'process_time'=>time()));exit;
                };
                if(!$r) {
                    $formdata = array();
                    $formdata['type'] = 11;
                    $formdata['url'] = $mec_r['url'];
                    $formdata['addtime'] = SYS_TIME;
                    $formdata['uid'] = $uid;
                    $formdata['keyid'] = $id;
                    $formdata['collectstatus'] = 1;
                    $this->db->insert('favorite', $formdata);
                    $this->db->update('m_picture', array('collectnum'=>$mec_r['collectnum']+1), array('id' => $id));
                    $result = $this->db->get_one('m_picture',array('id' => $id),'collectnum');
                    $r = $this->db->get_one('favorite', array('uid' => $uid,'keyid'=>$id));
                    echo json_encode(array('code'=>1,'data'=>array('collectnum'=>$result['collectnum'],'collectstatus'=>$r['collectstatus']),'message'=>"收藏成功",'process_time'=>time()));exit;
                } else {
                    $this->db->delete('favorite', array('fid'=>$r['fid']));
                    $this->db->update('m_picture', array('collectnum'=>$mec_r['collectnum']-1), array('id' => $id));
                    $result = $this->db->get_one('m_picture',array('id' => $id),'collectnum');
                    echo json_encode(array('code'=>1,'data'=>array('collectnum'=>$result['collectnum'],'collectstatus'=>0),'message'=>"取消收藏成功",'process_time'=>time()));exit;
                }
                break;
        }
    }
    
  /**
   * 装修公司
   */

    public function company() {
        $page = isset($GLOBALS['page']) ? intval($GLOBALS['page']) : 1;
        $page = max($page,1);
        $uid = $this->member_info['uid'];
        $publisher = $this->memberinfo['username'];
        $result_rs = $this->db->get_list('favorite', "`uid`='$uid' AND `type` IN(12)", '*',0,100,$page,'addtime DESC');
        $result_s = $this->db->get_list('favorite', "`uid`='$uid' AND `type` IN(12)", 'keyid',0,100,$page,'addtime DESC');
        $keyids=array();
          foreach ($result_s as $key => $value) {
              $keyids[]=$value['keyid'];
          }
        $company_picture = $this->db->get_list('m_picture','companyid in ('.implode(',',$keyids).') and status=1','*');
          $com=array();
          foreach ($company_picture as $key => $company) {
              $com[]=$company['companyid'];
          }
        $companynam = $this->db->get_list('m_company','id in ('.implode(',',$com).')','id,thumb,title,tese,avg_total,photonum,designnum,com_collectnum,collectnums,addtime',0,100,$page,'addtime DESC');
          
        foreach ($companynam as $key => $value) {
          if($value['avg_total']==0){
           $companynam[$key]['avg_total']='5';
          }
        $companynam[$key]['companylogos']='http://www.uzhuang.com/image/big_square/'.$value['thumb'];
          }
               $pages = $this->db->pages;
               $total = $this->db->number;
               $configs = get_config('picture_config');
               $companyname = array_values($companynam);
         // echo '<pre>';print_r($companyname);exit;
         echo json_encode(array('code'=>1,'data'=>$companyname,'message'=>'','process_time'=>time()));exit;
    }

    public function fav_company() {
        $id = intval($GLOBALS['id']);
        if(empty($id) || empty($GLOBALS['type']) || !in_array($GLOBALS['type'], array('picture','company','design'))){
            echo json_encode(array('code'=>0,'data'=>null,'message'=>"参数非法",'process_time'=>time()));exit;
        }
        $uid = $this->member_info['uid'];
        switch($GLOBALS['type']){
            case 'company':
                $r = $this->db->get_one('favorite', array('uid' => $uid,'type'=>12,'keyid'=>$id));
                $mec_r = $this->db->get_one('m_company', array('id'=>$id),'title,com_collectnum');
                if(empty($mec_r)){
                    echo json_encode(array('code'=>0,'data'=>null,'message'=>"口碑公司不存在",'process_time'=>time()));exit;
                };
                if(!$r) {
                    $formdata = array();
                    $formdata['type'] = 12;
                    $formdata['addtime'] = SYS_TIME;
                    $formdata['uid'] = $uid;
                    $formdata['keyid'] = $id;
                    $formdata['collectstatus'] = 1;
                    $this->db->insert('favorite', $formdata);
                    $this->db->update('m_company', array('com_collectnum'=>$mec_r['com_collectnum']+1,'addtime'=>$formdata['addtime']), array('id' => $id));
                    $result = $this->db->get_one('m_company',array('id' => $id),'com_collectnum');
                    $r = $this->db->get_one('favorite', array('uid' => $uid,'type'=>12,'keyid'=>$id));
                    echo json_encode(array('code'=>1,'data'=>array('com_collectnum'=>$result['com_collectnum'],'collectstatus'=>$r['collectstatus']),'message'=>"收藏成功",'process_time'=>time()));exit;
                } else {
                    $this->db->delete('favorite', array('fid'=>$r['fid']));
                    $this->db->update('m_company', array('com_collectnum'=>$mec_r['com_collectnum']-1,'addtime'=>SYS_TIME), array('id' => $id));
                    $result = $this->db->get_one('m_company',array('id' => $id),'com_collectnum');
                    echo json_encode(array('code'=>1,'data'=>array('com_collectnum'=>$result['com_collectnum'],'collectstatus'=>0),'message'=>"取消收藏成功",'process_time'=>time()));exit;
                }
                break;
        }
    }
  /**
   * 设计师
   */
    public function design() {
        $page = isset($GLOBALS['page']) ? intval($GLOBALS['page']) : 1;
        $page = max($page,1);
        $uid = $this->member_info['uid'];
        $publisher = $this->memberinfo['username'];
        $result_rs = $this->db->get_list('favorite', "`uid`='$uid' AND `type` IN(10)", '*',0,100,$page,'addtime DESC');
        $result_s = $this->db->get_list('favorite', "`uid`='$uid' AND `type` IN(10)", 'keyid',0,100,$page,'addtime DESC');
        $keyids=array();
          foreach ($result_s as $key => $value) {
              $keyids[]=$value['keyid'];
          }
        $design_picture = $this->db->get_list('m_picture','designer in ('.implode(',',$keyids).') and status=1','*');
          $com=array();
          foreach ($design_picture as $key => $company){
              $com[]=$company['designer'];
          }
      if($com){
        $rs = $this->db->get_list('m_company_team','id in ('.implode(',',$com).')','id,thumb,title,ranks,productionnum,collectnums,design_collectnum,thumb1',0,100,$page,'addtime DESC');
        foreach ($rs as $key => $va) {
          if($va['thumb1']!=""){
           $rs[$key]['thumb1'] =getMImgShow($va['thumb1'],'big_square');
           $rs[$key]['design_collectnums'] = $va['design_collectnum']+$va['collectnums'];
          }else{   
           $rs[$key]['thumb']='http://www.uzhuang.com/image/big_square/'.$va['thumb'];
           $rs[$key]['design_collectnums'] = $va['design_collectnum']+$va['collectnums'];
          }
        }
         $pages = $this->db->pages;
         $total = $this->db->number;
         $configs = get_config('picture_config');
        echo json_encode(array('code'=>1,'data'=>$rs,'message'=>'','process_time'=>time()));exit;         
          }
        echo json_encode(array('code'=>0,'data'=>null,'message'=>"无设计师",'process_time'=>time()));exit;        
    }

    public function fav_design() {
        $id = intval($GLOBALS['id']);
        if(empty($id) || empty($GLOBALS['type']) || !in_array($GLOBALS['type'], array('picture','company','design'))){
            echo json_encode(array('code'=>0,'data'=>null,'message'=>"参数非法",'process_time'=>time()));exit;
        }
        $uid = $this->member_info['uid'];
        switch($GLOBALS['type']){
            case 'design':
                $r = $this->db->get_one('favorite', array('uid' => $uid,'type'=>10,'keyid'=>$id));
                $mec_r = $this->db->get_one('m_company_team', array('id'=>$id),'title,design_collectnum');
                if(empty($mec_r)){
                    echo json_encode(array('code'=>0,'data'=>null,'message'=>"设计师不存在",'process_time'=>time()));exit;
                };
                if(!$r) {
                    $formdata = array();
                    $formdata['type'] = 10;
                    $formdata['addtime'] = SYS_TIME;
                    $formdata['uid'] = $uid;
                    $formdata['keyid'] = $id;
                    $formdata['collectstatus'] = 1;
                    $this->db->insert('favorite', $formdata);
                    $this->db->update('m_company_team', array('design_collectnum'=>$mec_r['design_collectnum']+1,'addtime'=>$formdata['addtime']), array('id' => $id));
                    $result = $this->db->get_one('m_company_team',array('id' => $id),'design_collectnum');
                    $r = $this->db->get_one('favorite', array('uid' => $uid,'type'=>10,'keyid'=>$id));
                    echo json_encode(array('code'=>1,'data'=>array('design_collectnum'=>$result['design_collectnum'],'collectstatus'=>$r['collectstatus']),'message'=>"收藏成功",'process_time'=>time()));exit;
                } else {
                    $this->db->delete('favorite', array('fid'=>$r['fid']));
                    $this->db->update('m_company_team', array('design_collectnum'=>$mec_r['design_collectnum']-1,'addtime'=>SYS_TIME), array('id' => $id));
                    $result = $this->db->get_one('m_company_team',array('id' => $id),'design_collectnum');
                    echo json_encode(array('code'=>1,'data'=>array('design_collectnum'=>$result['design_collectnum'],'collectstatus'=>0),'message'=>"取消收藏成功",'process_time'=>time()));exit;
                }
                break;
          }
     }

    //工地直播
    public function day_log() {
        $page = isset($GLOBALS['page']) ? intval($GLOBALS['page']) : 1;
        $page = max($page,1);
        $uid = $this->member_info['uid'];
        $publisher = $this->memberinfo['username'];
        $result_rs = $this->db->get_list('favorite', "`uid`='".$uid."' AND `type` IN(13)", '*',0,100,$page,'addtime desc');
        foreach ($result_rs as $keys => $values) {
                $keyids[$keys]=$values['keyid'];
        }
        $result = array();
                if($keyids){
                $a= $this->db->get_list('day_log_demand_list','orderid in ('.implode(',',$keyids).')','logname,renovationcategory,homestyle,budget,housetype,style,way,area,userid,addtime,nodename,uid,orderid,nodeid,check_detail,check_waterdetail,check_other,recphoto,content,browse_count',0,100,$page,'id DESC');
                }
                  foreach ($a as $key => $value) {
                  $resul=$this->db->count('log_evaluate',"orderid='".$value['orderid']."'");
                  $arr[$key]['logname']=$value['logname'];
                  $arr[$key]['uids']=$value['uid'];
                  $arr[$key]['nodename']=$value['nodename'];
                  $arr[$key]['orderid']=$value['orderid'];
                  $arr[$key]['browse_count']=$value['browse_count'];
                  $arr[$key]['message']=$resul['num'];
                  $arr[$key]['addtime']=time_format1(strtotime($value['addtime']));
                  if(!preg_match("/[\x7f-\xff]/", $arr[$key]['addtime'])){
                              $arr[$key]['addtime']=date('Y-m-d',strtotime($value['addtime']));
                  }
                  $arrs[$key]['check_other']=string2array($value['check_other']);
                  if($arrs[$key]['check_other']){
                    foreach ($arrs[$key]['check_other'] as $ks => $vs) {
                        if (!empty($vs['chan_Srcs'])) {
                            $a = explode(',',trim($vs['chan_Srcs'],','));

                            foreach ($a as $kk => $vv) {
                               if(!empty($vv)){
                               $arrs[$key]['imger'][] = $vv;
                               }else{
                               $arrs[$key]['imger'][] =array();
                               }
                            }
                        }else{
                          $arrs[$key]['imger'] =array();
                        }
                    }
                  }else{
                    $arrs[$key]['imger'] =array();
                  }
                  $arrs[$key]['check_other']=string2array($value['check_other']);
                  if($arrs[$key]['check_other']){
                    foreach ($arrs[$key]['check_other'] as $ks => $vs) {
                        if (!empty($vs['img_yse'])) {
                            $a = explode(',',trim($vs['img_yse'],','));
                            foreach ($a as $kk => $vv) {
                              if(!empty($vv)){
                               $arrs[$key]['imgers'][] = $vv;
                              }else{
                               $arrs[$key]['imgers'][] =array();
                              }
                            }
                        }else{
                          $arrs[$key]['imgers'] =array();
                        }
                    }
                  }else{
                    $arrs[$key]['imgers'] =array();
                  }
                  $arrs[$key]['recphoto']=unserialize($value['recphoto']);
                  $arrs[$key]['check_detail']=string2array($value['check_detail']);
                  if($arrs[$key]['check_detail']){
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
                        }else{
                          $arrs[$key]['img'] =array();
                        }
                    }
                  }else{
                    $arrs[$key]['img'] =array();
                  }
                  if($arrs[$key]['check_detail']){
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
                        }else{
                          $arrs[$key]['imgs'] =array();
                        }
                    }
                  }else{
                    $arrs[$key]['imgs'] =array(); 
                  }
                  $arrs[$key]['photo']=array_merge($arrs[$key]['img'],$arrs[$key]['imgs'],$arrs[$key]['recphoto'],$arrs[$key]['imger'],$arrs[$key]['imgers']);
                  if(empty($arrs[$key]['photo'])){
                  $arr[$key]['log_photo']='';
                  }else{
                  $arr[$key]['log_photo']="http://www.uzhuang.com/image/pic_230/".end($arrs[$key]['photo']);
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
                                  $arr[$key]['budget']=$value['budget'];
                  }
                      $log_r= $this->db->get_one('member_hk_data',array('uid'=>$value['userid']), 'uid,gjname,personalphoto,lifeword');
                      $arr[$key]['uid']=$log_r['uid'];
                      $arr[$key]['gjname']=$log_r['gjname'];
                      $arr[$key]['personalphoto']=$log_r['personalphoto'];
                      $arr[$key]['lifeword']=$log_r['lifeword'];
                  foreach ($arr as $pk => $pl) {
                     $uid_log=$this->db->get_one('day_log_demand_list',"`orderid`= '".$pl['orderid']."'",'title,uid');
                     //var_dump($uid_log['uid']);
                      if($uid_log['uid']!=$uid || empty($uid_log['uid'])){
                        $log_exist=(int)0;
                      }else{
                        $log_exist=(int)1;
                      }
                      $arr[$pk]['log_exist']=$log_exist;
                     $arr[$pk]['personalphotos'] ='http://www.uzhuang.com/image/pic_230/'.$arr[$pk]['personalphoto'];                                      
                  }
                    $pages = $this->db->pages;
                    $total = $this->db->number;
                    $configs = get_config('picture_config'); 
                      //echo"<pre>";print_r($ab);exit;  
                    //echo"<pre>";print_r($result); 
                    if($arr){
                    echo json_encode(array('code'=>1,'data'=>$arr,'message'=>'','process_time'=>time()));exit;
                    }else{
                    echo json_encode(array('code'=>0,'data'=>null,'message'=>'','process_time'=>time()));exit; 
                    }
                }

    public function fav_day_log() {
        $orderid= intval($GLOBALS['orderid']);
        if(empty($orderid) || empty($GLOBALS['type']) || !in_array($GLOBALS['type'], array('picture','company','design','day_log'))){
            echo json_encode(array('code'=>0,'data'=>null,'message'=>"参数非法",'process_time'=>time()));exit;
        }
        $uid = $this->member_info['uid'];
        switch($GLOBALS['type']){
            case 'day_log':
                $r = $this->db->get_one('favorite', array('uid' => $uid,'type'=>13,'keyid'=>$orderid));
                $mec_r = $this->db->get_one('day_log_demand_list', array('orderid'=>$orderid),'logname,url,log_collectnum');
                if(empty($mec_r)){
                    echo json_encode(array('code'=>0,'data'=>null,'message'=>"工地直播不存在",'process_time'=>time()));exit;
                };
                if(!$r) {
                    $formdata = array();
                    $formdata['type'] = 13;
                    $formdata['url'] = $mec_r['url'];
                    $formdata['addtime'] = SYS_TIME;
                    $formdata['uid'] = $uid;
                    $formdata['keyid'] = $orderid;
                    $formdata['collectstatus'] = 1;
                    $this->db->insert('favorite', $formdata);
                    $this->db->update('day_log_demand_list', array('log_collectnum'=>$mec_r['log_collectnum']+1), array('orderid' => $orderid));
            //echo "string";exit;
                    $result = $this->db->get_one('day_log_demand_list',array('orderid' => $orderid),'log_collectnum');
                    $r = $this->db->get_one('favorite', array('uid' => $uid,'type'=>13,'keyid'=>$orderid));
                    echo json_encode(array('code'=>1,'data'=>array('log_collectnum'=>$result['log_collectnum'],'collectstatus'=>$r['collectstatus']),'message'=>"收藏成功",'process_time'=>time()));exit;
                } else {
                    $this->db->delete('favorite', array('fid'=>$r['fid']));
                    $this->db->update('day_log_demand_list', array('log_collectnum'=>$mec_r['log_collectnum']-1), array('orderid' => $orderid));
                    $result = $this->db->get_one('day_log_demand_list',array('orderid' => $orderid),'log_collectnum');
                    echo json_encode(array('code'=>1,'data'=>array('log_collectnum'=>$result['log_collectnum'],'collectstatus'=>0),'message'=>"取消收藏成功",'process_time'=>time()));exit;
                }
                break;
        }
    }

    //装修课堂收藏
    public function fav_decorate_class() {
        $id= intval($GLOBALS['id']);
        if(empty($id) || empty($GLOBALS['type']) || !in_array($GLOBALS['type'], array('picture','company','design','day_log','decorate_class'))){
            echo json_encode(array('code'=>0,'data'=>null,'message'=>"参数非法",'process_time'=>time()));exit;
        }
          $uid = $GLOBALS['uid'];
        switch($GLOBALS['type']){
            case 'decorate_class':
                $r = $this->db->get_one('favorite', array('uid' => $uid,'type'=>16,'keyid'=>$id));
                $mec_r = $this->db->get_one('faq', array('id'=>$id),'cid,title,remark');
                if(empty($mec_r)){
                    echo json_encode(array('code'=>0,'data'=>null,'message'=>"暂无此收藏数据",'process_time'=>time()));exit;
                };
                if(!$r) {
                    $formdata = array();
                    $formdata['type'] = 16;
                    //$formdata['url'] = $mec_r['url'];
                    $formdata['addtime'] = SYS_TIME;
                    $formdata['uid'] = $uid;
                    $formdata['keyid'] = $id;
                    $formdata['collectstatus'] = 1;
                    $this->db->insert('favorite', $formdata);
                    $this->db->update('faq', array('decorate_collect'=>$mec_r['decorate_collect']+1), array('id' => $id));
                   //echo "string";exit;
                    $result = $this->db->get_one('faq',array('id' => $id),'decorate_collect');
                    $r = $this->db->get_one('favorite', array('uid' => $uid,'keyid'=>$id));
                     //echo "<pre>";print_r(array('log_collectnum'=>$result['log_collectnum'],'collectstatus'=>'"'.$r['collectstatus'].'"'));exit;
                    echo json_encode(array('code'=>1,'data'=>array('decorate_collect'=>$result['decorate_collect'],'collectstatus'=>$r['collectstatus']),'message'=>"收藏成功",'process_time'=>time()));exit;
                }else{
                    $this->db->delete('favorite', array('fid'=>$r['fid']));
                    $this->db->update('faq', array('decorate_collect'=>$mec_r['decorate_collect']-1), array('id' => $id));
                    $result = $this->db->get_one('faq',array('id' => $id),'decorate_collect');
                    //echo "<pre>";print_r(array('log_collectnum'=>$result['log_collectnum'],'collectstatus'=>'"0"'));exit;
                    echo json_encode(array('code'=>1,'data'=>array('decorate_collect'=>$result['decorate_collect'],'collectstatus'=>"0"),'message'=>"取消收藏成功",'process_time'=>time()));exit;
                }
                break;
        }
    }

    public function decorate_class() {
        $page = isset($GLOBALS['page']) ? intval($GLOBALS['page']) : 1;
        $page = max($page,1);
        $uid =$GLOBALS['uid'];
        if($uid){
        $result_rs = $this->db->get_list('favorite', "`uid`='".$uid."' AND `type`=16", '*',0,100,$page,'addtime desc');
        $result = array();
        foreach($result_rs as $r) {
            if($r['type']==16) {
              $rs= $this->db->get_one('faq','status=9 and id="'.$r['keyid'].'"','id,cid,title,remark,thumb,addtime,url','0','','','UNIX_TIMESTAMP(addtime) DESC');
              //详情页地址
              if (!isset($GLOBALS['from_android'])) {//(判断是否来自安卓端的请求)安卓端URL不要重新定义直接用数据库中的值即可
              if(WEBURL=='http://m.uzhuang.com/'){
                  $rs['url']="http://m.uzhuang.com/mobile-uzapp_article.html?uzid=".$rs['id'];
              }else if(WEBURL=='http://mdev.uz.com/'){
                  $rs['url']="http://mdev.uz.com/mobile-uzapp_article.html?uzid=".$rs['id'];
              }else if(WEBURL=='http://mtest.uz.com/'){
                  $rs['url']="http://mtest.uz.com/mobile-uzapp_article.html?uzid=".$rs['id'];
              }else if(WEBURL=='http://mpre.uz.com/'){
                  $rs['url']="http://mpre.uz.com/mobile-uzapp_article.html?uzid=".$rs['id'];
              }
              }else{
              	$rs['status'] = $r['status'];//安卓端收藏的类型(是否为视频)
              }
              $rs['addtime']=date('Y-m-d',$rs['addtime']);
              if($rs['thumb']){
                  $rs['thumb']="http://www.uzhuang.com/image/pic_230/".$rs['thumb'];
              }
            }
            $result[] = $rs;
        }
        $pages = $this->db->pages;
        $total = $this->db->number;
        $configs = get_config('picture_config');
        echo json_encode(array('code'=>1,'data'=>$result,'message'=>'','process_time'=>time()));exit;
        }else{
        echo json_encode(array('code'=>0,'data'=>null,'message'=>'用户uid不存在','process_time'=>time()));exit;
        }
    }
    //订单列表
   public function listing(){
       // $uid = $this->member_info['uid'];
        $uid=$GLOBALS['uid'];
        
       $where="`uid`=$uid ";
       $result=$this->db->get_list('demand',$where,'title,id,order_no,address,nodename,orderstatus',0,1000,'id DESC');
       $arr=array();
       $arr1=array();
       foreach ($result as $key => $value) {
           $s=(int)$value['id'];
           //查最新节点name
          $res=$this->db->get_list('demand_track',"`orderid`=$s",'orderid,nodeid,nodename,date1',0,1,$page,'date1 desc');
          $arr[$value['id']]=array('id'=>$value['id'],'kaigongriqi'=>'未开工','bianhao'=>$value['order_no'],'zuixinjindu'=>$value['nodename'],'dizhi'=>$value['address'],'orderstatus'=>$value['orderstatus']);
        
          if($arr[$value['id']]['zuixinjindu']=='分配管家经理'){
            $arr[$value['id']]['zuixinjindu']='为您精选3家装修公司';
          }
          if($arr[$value['id']]['zuixinjindu']=='分配管家'){
            $arr[$value['id']]['zuixinjindu']='为您指定管家';
          }
           if($arr[$value['id']]['zuixinjindu']=='订单已确认'){
            $arr[$value['id']]['zuixinjindu']='装修订单审核';
          }
           if($arr[$value['id']]['zuixinjindu']=='确定装修公司'){
            $arr[$value['id']]['zuixinjindu']='选定装修公司';
          }
           if($arr[$value['id']]['zuixinjindu']=='意向定金'){
            $arr[$value['id']]['zuixinjindu']='签订意向定金';
          }
           if(!$arr[$value['id']]['zuixinjindu']){
            $arr[$value['id']]['zuixinjindu']='装修订单审核';
          }
           // $arr1=array($res[0]);
           //查工程开工天数
           $res1=$this->db->get_list('demand_track',"`orderid`=$s",'orderid,userid,nodeid,nodename,addtime,col2,remark',0,1000);
           if($res1){
           foreach ($res1 as $key => $value1) {
                             
                            if ($value1['nodeid']==21) {
                               $nowTime=date('Y-m-d',time());
                               $addTime=date('Y-m-d',strtotime($value1['addtime']));
                               $time=ceil((strtotime($nowTime)-strtotime($addTime))/3600/24+1);
                               
                               $arr[$value1['orderid']]['kaigongriqi']='开工第'.$time.'天';
                                   if($time<0){
                               $arr[$value1['orderid']]['kaigongriqi']='未开工';
                                   }
                              }else if($value1['nodeid']<21){
                                      $arr[$value1['orderid']]['kaigongriqi']='未开工';
                              }else if($value1['nodeid']>36&&$value1['nodeid']<41){
                                      $arr[$value1['orderid']]['kaigongriqi']='竣工';
                              }else if($value1['nodeid']<47&&$value1['nodeid']>43){
                                      $arr[$value1['orderid']]['kaigongriqi']='完结';
                              }else if($value1['nodeid']==51){
                                      $arr[$value1['orderid']]['kaigongriqi']='完结';
                                      $arr[$value['id']]['zuixinjindu']='完结';
                              }

                         if($arr[$value['id']]['zuixinjindu']=='拆改'){
                                if($value1['col2']=='否'){
                                  $arr[$value['id']]['zuixinjindu']='工程开工';
                                   }
                                }

                          if($arr[$value['id']]['zuixinjindu']=='污染治理'){
                                if($value1['remark']=='未进行污染治理'){
                                  $arr[$value['id']]['zuixinjindu']='竣工污染检测';
                                  $arr[$value1['orderid']]['kaigongriqi']='竣工';
                                   }else{
                                    $arr[$value1['orderid']]['kaigongriqi']='竣工';
                                   }
                                }

                          if($arr[$value['id']]['zuixinjindu']=='污染治理'){
                                if($value1['remark']=='未进行污染治理'){
                                  $arr[$value['id']]['zuixinjindu']='竣工污染检测';
                                  $arr[$value1['orderid']]['kaigongriqi']='竣工';
                                   }else{
                                    $arr[$value1['orderid']]['kaigongriqi']='竣工';
                                   }
                                }
                           if($arr[$value['id']]['zuixinjindu']=='尾款质保期'){
                                if($arr[$value['id']]['orderstatus']=='完结'){
                                  $arr[$value['id']]['zuixinjindu']='完结';
                                   $arr[$value1['orderid']]['kaigongriqi']='完结';
                                   }else{
                                    $arr[$value1['orderid']]['kaigongriqi']='竣工';
                                   }
                                }
                          if($arr[$value['id']]['zuixinjindu']=='入住空气检测'){
                                if($arr[$value['id']]['orderstatus']=='完结'){
                                  $arr[$value['id']]['zuixinjindu']='完结';
                                   $arr[$value1['orderid']]['kaigongriqi']='完结';
                                   }else{
                                    $arr[$value1['orderid']]['kaigongriqi']='竣工';
                                   }
                                }
                          if($arr[$value['id']]['zuixinjindu']=='空气治理'){
                                if($value1['remark']=='未进行空气治理'){
                                  $arr[$value['id']]['zuixinjindu']='完结';
                                  $arr[$value1['orderid']]['kaigongriqi']='完结';
                                   }else{
                                    $arr[$value1['orderid']]['kaigongriqi']='竣工';
                                   }
                                }
                           

                     }
                       
               }

             }
            
             rsort($arr); 
             $arr=array_values($arr);
             $arr['order_exist']='1'; 
             if(!$result){
              $arr=array(
                'order_exist'=>'0',
                'tishiyu'=>'您还没有装修订单哦~');
             }
                // echo '<pre>';print_r($arr);exit;
            
         echo json_encode(array('code'=>1,'data'=>$arr,'message'=>'个人中心订单列表页数据','process_time'=>time()));
            
       // var_dump($arr);exit;
      }

//订单详情
     public function listing_details(){
            //获取前台传的订单号
                   $order_no=$GLOBALS['order_no'];
                   $demand=$this->db->get_one('demand',"`order_no` = $order_no",'id,address,homestyle,housetype,renovationcategory,area,way,style,housekeeperid,nodeid,designpay,totalpay,designno,contactno,addtime,updatetime');
                // echo '<pre>';print_r($demand);exit;
                        // 判断订单是否有订单信息
                        if(!empty($demand['address']))
                        {
                                //循环出风格的索引,找对应的中文
                                 $configs_picture = get_config('picture_config');
                                 $pp=trim($demand['style'],',');
                                 $ss=explode(',',$pp);
                                   for($a=0;$a<count($ss);$a++){
                                       $style[$a]=$configs_picture['style1'][$ss[$a]];
                                   }
                                  
                                   
                                    $demand['style']=$style;
                       
                                
                                   $fs=trim($demand['way'],',');
                                  $fs1=explode(',',$fs);
                                    for($j=0;$j<count($fs1);$j++){
                                      $demand['way']=$configs_picture['way'][$fs1[$j]];
                                   }
                           
                                 if($demand['renovationcategory']=='1'){
                                   $demand['homestyle']= $configs_picture['homestyle'][$demand['homestyle']];
                                   //订单数组
                                   $dingdanxinxi=array('address'=>$demand['address'],'homestyle'=>$demand['homestyle'],'area'=>$demand['area'],'style'=>$demand['style'],'way'=>$demand['way'],'orderinfo'=>1);
                                }elseif( $demand['renovationcategory']=='2'){

                                   $demand['housetype']=$configs_picture['housetype'][$demand['housetype']];
                                    //订单数组
                                   $dingdanxinxi=array('address'=>$demand['address'],'housetype'=>$demand['housetype'],'area'=>$demand['area'],'style'=>$demand['style'],'way'=>$demand['way'],'orderinfo'=>1);
                                 } 

                        }else{
                          $dingdanxinxi=array('orderinfo'=>0);
                        }
                   // 订单id
                   $id=$demand['id'];

                   // 管家id
                   $guajiaId=$demand['housekeeperid'];
                   // 节点id
                   $nodeid=$demand['nodeid'];  
                   //三家公司的评分
                   $companypingfen1=array();
                   // 上门量房的状态
                   $shangmenstr=array();
                   //给前台传当前订单的所有节点
                   $arr=array();
                   //给前台传当前订单的所有节点名称
                   $arr1=array();
                   $nordInfo = array('sh'=>1,'sel'=>2,'gj'=>3);
                  // 订单节点信息的数组
                  $order_finally=array();

                   $demand_track=$this->db->get_list('demand_track',"`orderid`=$id",'orderid,nodename,nodeid'); 
                   $c=count($demand_track);
                   for($i=0;$i<$c;$i++){
                     $arr[]=$demand_track[$i]['nodeid'];
                   } 
                   // foreach ($demand_track as $key => $value) {
                    
                   //         $arr1[]=array($value['nodename']);
                   // }
                   //订单最新进度的节点名称
                   $demand_track1=$this->db->get_one('demand',"`order_no` = $order_no",'nodename,orderstatus');  
                //装修订单审核
                $shenhe=array();
                   if($demand&&$nodeid<1){
                     $time1a=date('m-d',strtotime($demand['addtime']));            
                        $time1b=explode('-',$time1a);
                        $time1c=$time1b[0].'.'.$time1b[1];
                   $shenhe=array('shijian'=>$time1c,'nodename'=>'装修订单审核','message'=>"您的装修申请已经提交，客服会在24小时内与您联系！",'nodestatus'=>1);
                   $order_finally[strtotime($demand['addtime'])] = $shenhe;
                   }
                   if($nodeid>1||$nodeid==1){
                    //取节点时间、名称
                        
                        $time1a=date('m-d',strtotime($demand['addtime']));            
                        $time1b=explode('-',$time1a);
                        $time1c=$time1b[0].'-'.$time1b[1];
                   $shenhe=array('shijian'=>$time1c,'nodename'=>'装修订单审核','message'=>"恭喜您，您的装修申请已经通过审核!",'nodestatus'=>1);
                   $order_finally[strtotime($demand['addtime'])] = $shenhe;
                   }
                //为您精选3家装修公司
                   if($nodeid>2||$nodeid==2){
                      //取节点时间、名称
                      // $time2=$this->db->get_one('demand_track_wp',"`orderid`=$id AND `nodeid`= 2",'date1,nodename'); 

                      $threecompany=$this->db->get_list('demand_company',array('orderid'=>$id),'companyname,companyid');
                      foreach ($threecompany as $key => $value){
                          $uid=$value['companyid'];
                          $companypingfen=$this->db->get_one('company',"`id`=$uid",'avg_total');
                          $companypingfen1[]=array('companyname'=>$value['companyname']);
                        }  
                        $time2a=date('m-d',strtotime($demand['addtime']));            
                        $time2b=explode('-',$time2a);
                        $time2c=$time2b[0].'-'.$time2b[1];
                        $companyarr=array('shijian'=>$time2c,'nodename'=>'为您精选3家装修公司','threecompany'=>$companypingfen1,'nodestatus'=>1);
                        $order_finally[strtotime($demand['addtime'])+1] = $companyarr;
                        // $order_finally[$nordInfo['sh']] = $shenhe;
                   }else{
                     $order_finally[1888886301]=array('nodename'=>'为您精选3家装修公司','nodestatus'=>0);
                   }
                        
                  
               // 为您指定管家
                   if($nodeid>9||$nodeid==9){
                    //取节点时间、名称
                    // $time9=$this->db->get_one('demand_track_wp',"`orderid`=$id AND `nodeid`= 9",'date1,nodename'); 
               
                    $guanjia=$this->db->get_one('member_hk_data',"`uid`= $guajiaId",'gjname,personalphoto,mobile');
                    $guanjia['personalphoto']='http://www.uzhuang.com/image/small_square/'.$guanjia['personalphoto'];
                     $time9a=date('m-d',strtotime($demand['updatetime']));            
                     $time9b=explode('-',$time9a);
                    $time9c=$time9b[0].'-'.$time9b[1];

                    $guanjiaarr=array('shijian'=>$time9c,'nodename'=>'为您指定管家','guanjia'=>$guanjia,'nodestatus'=>1);
                     $order_finally[strtotime($demand['updatetime'])] = $guanjiaarr;

                   }else{
                    $order_finally[1888886302]=array('nodename'=>'为您指定管家','nodestatus'=>0);
                   }
             if($nodeid>10){
               // 上门量房
                   if($nodeid>11||$nodeid==11){
                    //取节点时间、名称
                   $time11=$this->db->get_one('demand_track',"`orderid`=$id AND `nodeid`= 11",'date1,nodename,addtime'); 

                   $shangmen=$this->db->get_list('demand_track_detail',"`orderid`=$id AND `nodeid`= 11",'col2,col7,col8');
                   foreach ($shangmen as $key => $value) {
                                    if($value['col8']=='是'){
                                      $shijian=date('Y-m-d',strtotime($value['col7']));            
                                      $shijian1=explode('-',$shijian);
                                      $shangstr=$shijian1[0].'年'.$shijian1[1].'月'.$shijian1[2].'日,已量房';
                                      }else{
                                        $shangstr='未量房';
                                      }
                                     $shangmenstr[]=array('company'=>$value['col2'],'beizhu'=>$shangstr);
                                  }  
                                  $time11a=date('m-d',strtotime($time11['addtime']));            
                                 $time11b=explode('-',$time11a);
                                $time11c=$time11b[0].'-'.$time11b[1];
                        //判断有无现场照片和整改照片
                        $shangmen_src=$this->db->get_one('day_log',"`orderid`=$id AND `nodeid`= 35",'recphoto,sitephoto');
                        if(!unserialize($shangmen_src['sitephoto'])&&!unserialize($shangmen_src['recphoto'])){
                                  $srcstatus=(int)0;
                        }else{
                                  $srcstatus=(int)1;
                        }
                          // print_r($srcstatus);exit;
                          $liangfangarr=array('shijian'=>$time11c,'nodename'=>$time11['nodename'],'message'=>$shangmenstr,'nodestatus'=>1,'src'=>WEBURL.'uploadfile/nodeid/shangmenliangfang.jpg','srcstatus'=>$srcstatus);
                          $order_finally[strtotime($time11['addtime'])] = $liangfangarr;
                   }else{
                    $order_finally[1888886303]=array('nodename'=>'上门量房','nodestatus'=>0,'src'=>WEBURL.'uploadfile/nodeid/shangmenliangfang.jpg','srcstatus'=>(int)0);
                   }
              //确定装修公司
                   if($nodeid>13||$nodeid==13){
                     //取节点时间、名称
                    $time13=$this->db->get_one('demand_track',"`orderid`=$id AND `nodeid`= 13",'date1,nodename,addtime'); 

                    $confirmcompany=$this->db->get_one('demand_track_detail',"`orderid`=$id AND `nodeid`= 13 AND `col8`= '是'",'col2');
                    if(!$confirmcompany){
                        $confirmcompany=$this->db->get_one('demand_track_detail',"`orderid`=$id AND `nodeid`= 13 AND `col8` is null ",'col2');
                    }else{
                        $confirmcompany=$confirmcompany;
                    }
                                 $time13a=date('m-d',strtotime($time13['addtime']));            
                                 $time13b=explode('-',$time13a);
                                $time13c=$time13b[0].'-'.$time13b[1];
                     //判断有无现场照片和整改照片
                        $confirm_src=$this->db->get_one('day_log',"`orderid`=$id AND `nodeid`= 13",'recphoto,sitephoto');
                        if(!unserialize($confirm_src['sitephoto'])&&!unserialize($confirm_src['recphoto'])){
                                  $srcstatus=(int)0;
                        }else{
                                  $srcstatus=(int)1;
                        }

                    $confirmcompanyarr=array('shijian'=>$time13c,'nodename'=>$time13['nodename'],'company'=>$confirmcompany['col2'],'nodestatus'=>1,'src'=>WEBURL.'uploadfile/nodeid/quedingzhuangxiugongsi.jpg','srcstatus'=>$srcstatus);
                    $order_finally[strtotime($time13['addtime'])] = $confirmcompanyarr;
                   }else{
                    $order_finally[1888886304]=array('nodename'=>'确定装修公司','nodestatus'=>0,'src'=>WEBURL.'uploadfile/nodeid/quedingzhuangxiugongsi.jpg','srcstatus'=>(int)0);
                   }
              // 签订设计协议/意向定金
                if($nodeid>15||$nodeid==15){
                     //取节点时间、名称
                    $time15=$this->db->get_one('demand_track',"`orderid`=$id AND `nodeid`= 15",'date1,nodename,addtime'); 
                                $time15a=date('m-d',strtotime($time15['addtime']));            
                                 $time15b=explode('-',$time15a);
                                $time15c=$time15b[0].'-'.$time15b[1];
                    $xieyi=$this->db->get_one('demand_referno',"`orderid`=$id AND `nodeid`= 15",'nodename,needmoney'); 
                     $xieyi1=$this->db->get_list('demand_referno',"`orderid`=$id AND `nodeid`= 15",'nodename,needmoney'); 
                     $q = 0.0;
                     foreach ($xieyi1 as $key => $valuexiey) {
                       $q+=$valuexiey['needmoney'];
                     }
                       //判断有无现场照片和整改照片
                        $xieyi_src=$this->db->get_one('day_log',"`orderid`=$id AND `nodeid`= 15",'recphoto,sitephoto');
                        if(!unserialize($xieyi_src['sitephoto'])&&!unserialize($xieyi_src['recphoto'])){
                                  $srcstatus=(int)0;
                        }else{
                                  $srcstatus=(int)1;
                        }
                    if($xieyi['nodename']=='意向定金'){

                      $xieyiarr=array('shijian'=>$time15c,'nodename'=>$time15['nodename'],'beizhu'=>"签订意向定金协议",'jine'=>"已付款".number_format($q,2)."元",'nodestatus'=>1,'src'=>WEBURL.'uploadfile/nodeid/yixiangdingjin.jpg','srcstatus'=>$srcstatus);
                       $order_finally[strtotime($time15['addtime'])] = $xieyiarr;
                    }
                     if($xieyi['nodename']=='签订设计协议'){
                      $xieyiarr=array('shijian'=>$time15c,'nodename'=>$time15['nodename'],'beizhu'=>"签订设计协议",'bianhao'=>"协议编号:".$demand['designno'],'jine'=>"已付款".number_format($q,2)."元",'nodestatus'=>1,'src'=>WEBURL.'uploadfile/nodeid/yixiangdingjin.jpg','srcstatus'=>$srcstatus);
                        $order_finally[strtotime($time15['addtime'])] = $xieyiarr;
                    }
                  // var_dump($xieyiarr);exit;
                }else{
                  $order_finally[1888886305]=array('nodename'=>'签订设计协议/意向定金','nodestatus'=>0,'src'=>WEBURL.'uploadfile/nodeid/yixiangdingjin.jpg','srcstatus'=>(int)0);
                }
            // 方案确定预交底
                if($nodeid>17||$nodeid==17){
                   //取节点时间、名称、备注
                    $time17=$this->db->get_one('demand_track',"`orderid`=$id AND `nodeid`= 17",'date1,nodename,remark,addtime'); 
                                $time17a=date('m-d',strtotime($time17['addtime']));            
                                 $time17b=explode('-',$time17a);
                                $time17c=$time17b[0].'-'.$time17b[1];
                      //判断有无现场照片和整改照片
                        $yujiaodi_src=$this->db->get_one('day_log',"`orderid`=$id AND `nodeid`= 17",'recphoto,sitephoto');
                        if(!unserialize($yujiaodi_src['sitephoto'])&&!unserialize($yujiaodi_src['recphoto'])){
                                  $srcstatus=(int)0;
                        }else{
                                  $srcstatus=(int)1;
                        }

                    $yujiaodiarr=array('shijian'=>$time17c,'nodename'=>$time17['nodename'],'beizhu'=>$time17['remark'],'nodestatus'=>1,'src'=>WEBURL.'uploadfile/nodeid/fanganyujiaodi.jpg','srcstatus'=>$srcstatus);
                      $order_finally[strtotime($time17['addtime'])] = $yujiaodiarr;
                }else{
                   $order_finally[1888886306]=array('nodename'=>'方案确定预交底','nodestatus'=>0,'src'=>WEBURL.'uploadfile/nodeid/fanganyujiaodi.jpg','srcstatus'=>(int)0);
                }
           // 签施工协议
                if($nodeid>19||$nodeid==19){
                   //取节点时间、名称
                    $time19=$this->db->get_one('demand_track',"`orderid`=$id AND `nodeid`= 19",'date1,nodename,addtime'); 
                                $time19a=date('m-d',strtotime($time19['addtime']));            
                                 $time19b=explode('-',$time19a);
                                $time19c=$time19b[0].'-'.$time19b[1];
                    $xieyi=$this->db->get_one('demand_referno',"`orderid`=$id AND `nodeid`= 15",'nodename,needmoney'); 
                     $xieyi1=$this->db->get_list('demand_referno',"`orderid`=$id AND `nodeid`= 19",'nodename,needmoney'); 
                     $a = 0.0;
                     foreach ($xieyi1 as $key => $valuexieyi) {
                       $a+=$valuexieyi['needmoney'];
                     }
                    //判断有无现场照片和整改照片
                        $shigong_src=$this->db->get_one('day_log',"`orderid`=$id AND `nodeid`= 19",'recphoto,sitephoto');
                        if(!unserialize($shigong_src['sitephoto'])&&!unserialize($shigong_src['recphoto'])){
                                  $srcstatus=(int)0;
                        }else{
                                  $srcstatus=(int)1;
                        }
                    if($xieyi['nodename']=='意向定金'){
                      $shigongarr=array('shijian'=>$time19c,'nodename'=>$time19['nodename'],'bianhao'=>"协议编号：".$demand['contactno'],'jine'=>"协议金额：".number_format($demand['totalpay'],2),'gongchengkuan'=>"已付40%工程款",'shijifukuan'=>$xieyi['needmoney']."元定金抵充<br>实际付款".number_format($a,2)."元",'nodestatus'=>1,'src'=>WEBURL.'uploadfile/nodeid/shigongxieyi.jpg','srcstatus'=>$srcstatus);
                       $order_finally[strtotime($time19['addtime'])] = $shigongarr;
                       
                    }
                     if($xieyi['nodename']=='签订设计协议'){
                       $shigongarr=array('shijian'=>$time19c,'nodename'=>$time19['nodename'],'bianhao'=>"协议编号:".$demand['contactno'],'jine'=>"协议金额:".number_format($demand['totalpay'],2),'gongchengkuan'=>"已付40%工程款",'shijifukuan'=>"实际付款".number_format($a,2)."元",'nodestatus'=>1,'src'=>WEBURL.'uploadfile/nodeid/shigongxieyi.jpg','srcstatus'=>$srcstatus);
                        $order_finally[strtotime($time19['addtime'])] = $shigongarr;
                    }
                }else{
                  $order_finally[1888886307]=array('nodename'=>'签施工协议','nodestatus'=>0,'src'=>WEBURL.'uploadfile/nodeid/shigongxieyi.jpg','srcstatus'=>(int)0);
                }
                
           // 工程开工
                if($nodeid>21||$nodeid==21){
                     //取节点时间、名称、备注
                    $time21=$this->db->get_one('demand_track',"`orderid`=$id AND `nodeid`= 21",'date1,nodename,remark,addtime'); 
                                 $time21a=date('m-d',strtotime($time21['addtime']));            
                                 $time21b=explode('-',$time21a);
                                $time21c=$time21b[0].'-'.$time21b[1];
                      //判断有无现场照片和整改照片
                        $gongcheng_src=$this->db->get_one('day_log',"`orderid`=$id AND `nodeid`= 21",'recphoto,sitephoto');
                        if(!unserialize($gongcheng_src['sitephoto'])&&!unserialize($gongcheng_src['recphoto'])){
                                  $srcstatus=(int)0;
                        }else{
                                  $srcstatus=(int)1;
                        }
                    $gongchengarr=array('shijian'=>$time21c,'nodename'=>$time21['nodename'],'beizhu'=>$time21['remark'],'nodestatus'=>1,'src'=>WEBURL.'uploadfile/nodeid/gongchengkaigong.jpg','srcstatus'=>$srcstatus);
                     $order_finally[strtotime($time21['addtime'])] = $gongchengarr;
                }else{
                  $order_finally[1888886308]=array('nodename'=>'工程开工','nodestatus'=>0,'src'=>WEBURL.'uploadfile/nodeid/gongchengkaigong.jpg','srcstatus'=>(int)0);
                }
            // 拆改
                // if(in_array('23', $arr)){
                //      //取节点时间、名称、备注
                //     $time23=$this->db->get_one('demand_track',"`orderid`=$id AND `nodeid`= 23",'date1,nodename,remark');  
                // }else{
                //   $time23=array('拆改'=>'null');
                // }
                 if(in_array('23', $arr)){
                     //取节点时间、名称、备注
                    $time23=$this->db->get_one('demand_track',"`orderid`=$id AND `nodeid`= 23",'date1,nodename,remark,col2,addtime'); 
                                 $time23a=date('m-d',strtotime($time23['addtime']));            
                                 $time23b=explode('-',$time23a);
                                $time23c=$time23b[0].'-'.$time23b[1];
                    $chaigaiarr=array('shijian'=>$time23c,'nodename'=>$time23['nodename'],'beizhu'=>$time23['remark'],'nodestatus'=>1);
                    if($time23['col2']=='是'){
                    $order_finally[strtotime($time23['addtime'])] = $chaigaiarr;
                    }else{

                    $order_finally[1888886309]=array('nodename'=>'拆改','nodestatus'=>0);
                    }
              
                
                }
            // 水电材料验收
                 if(in_array('25', $arr)){
                     //取节点时间、名称、备注
                    $time25=$this->db->get_one('demand_track',"`orderid`=$id AND `nodeid`= 25",'date1,nodename,remark,addtime'); 
                                $time25a=date('m-d',strtotime($time25['addtime']));            
                                 $time25b=explode('-',$time25a);
                                $time25c=$time25b[0].'-'.$time25b[1];
                      //判断有无现场照片和整改照片
                        $shuidiancl_src=$this->db->get_one('day_log',"`orderid`=$id AND `nodeid`= 25",'recphoto,sitephoto');
                        if(!unserialize($shuidiancl_src['sitephoto'])&&!unserialize($shuidiancl_src['recphoto'])){
                                  $srcstatus=(int)0;
                        }else{
                                  $srcstatus=(int)1;
                        }
                    $shuidianclarr=array('shijian'=>$time25c,'nodename'=>$time25['nodename'],'beizhu'=>$time25['remark'],'nodestatus'=>1,'src'=>WEBURL.'uploadfile/nodeid/shuidiancailiao.jpg','srcstatus'=>$srcstatus);
                      $order_finally[strtotime($time25['addtime'])] = $shuidianclarr;
                }else{
                  $order_finally[1888886310]=array('nodename'=>'水电材料验收','nodestatus'=>0,'src'=>WEBURL.'uploadfile/nodeid/shuidiancailiao.jpg','srcstatus'=>(int)0);

                }
           // 泥木材料验收
                 if(in_array('29', $arr)){
                     //取节点时间、名称、备注
                    $time29=$this->db->get_one('demand_track',"`orderid`=$id AND `nodeid`= 29",'date1,nodename,remark,addtime'); 
                                $time29a=date('m-d',strtotime($time29['addtime']));            
                                 $time29b=explode('-',$time29a);
                                $time29c=$time29b[0].'-'.$time29b[1];
                      //判断有无现场照片和整改照片
                        $nimucl_src=$this->db->get_one('day_log',"`orderid`=$id AND `nodeid`= 29",'recphoto,sitephoto');
                        if(!unserialize($nimucl_src['sitephoto'])&&!unserialize($nimucl_src['recphoto'])){
                                  $srcstatus=(int)0;
                        }else{
                                  $srcstatus=(int)1;
                        }
                    $nimuclarr=array('shijian'=>$time29c,'nodename'=>$time29['nodename'],'beizhu'=>$time29['remark'],'nodestatus'=>1,'src'=>WEBURL.'uploadfile/nodeid/nimucailiao.jpg','srcstatus'=>$srcstatus);
                    $order_finally[strtotime($time29['addtime'])] = $nimuclarr;
                }else{
                  $order_finally[1888886312]=array('nodename'=>'泥木材料验收','nodestatus'=>0,'src'=>WEBURL.'uploadfile/nodeid/nimucailiao.jpg','srcstatus'=>(int)0);
              
                }
            // 油漆材料验收
                 if(in_array('33', $arr)){
                     //取节点时间、名称、备注
                    $time33=$this->db->get_one('demand_track',"`orderid`=$id AND `nodeid`= 33",'date1,nodename,remark,addtime'); 
                                 $time33a=date('m-d',strtotime($time33['addtime']));            
                                 $time33b=explode('-',$time33a);
                                $time33c=$time33b[0].'-'.$time33b[1];
                      //判断有无现场照片和整改照片
                        $youqicl_src=$this->db->get_one('day_log',"`orderid`=$id AND `nodeid`= 33",'recphoto,sitephoto');
                        if(!unserialize($youqicl_src['sitephoto'])&&!unserialize($youqicl_src['recphoto'])){
                                  $srcstatus=(int)0;
                        }else{
                                  $srcstatus=(int)1;
                        }
                    $youqiclarr=array('shijian'=>$time33c,'nodename'=>$time33['nodename'],'beizhu'=>$time33['remark'],'nodestatus'=>1,'src'=>WEBURL.'uploadfile/nodeid/youqicailiao.jpg','srcstatus'=>$srcstatus);
                    $order_finally[strtotime($time33['addtime'])] = $youqiclarr;
                }else{
                   $order_finally[1888886314]=array('nodename'=>'油漆材料验收','nodestatus'=>0,'src'=>WEBURL.'uploadfile/nodeid/youqicailiao.jpg','srcstatus'=>(int)0);
                }
           // 水电验收
                 if(in_array('27', $arr)){
                
                     //取节点时间、名称、备注
                    $time27=$this->db->get_one('demand_track',"`orderid`=$id AND `nodeid`= 27",'date1,nodename,remark,addtime'); 
                                  $time27a=date('m-d',strtotime($time27['addtime']));            
                                 $time27b=explode('-',$time27a);
                                $time27c=$time27b[0].'-'.$time27b[1];
                     $shuidianday=$this->db->get_list('demand_referno',"`orderid`=$id AND `nodeid`= 27",'nodename,needmoney'); 
                      $s = 0.0;
                     foreach ($shuidianday as $key => $valuexieyi) {
                       $s+=$valuexieyi['needmoney'];
                     }
                      //判断有无现场照片和整改照片
                        $shuidian_src=$this->db->get_one('day_log',"`orderid`=$id AND `nodeid`= 27",'recphoto,sitephoto');
                        if(!unserialize($shuidian_src['sitephoto'])&&!unserialize($shuidian_src['recphoto'])){
                                  $srcstatus=(int)0;
                        }else{
                                  $srcstatus=(int)1;
                        }
                      $shuidianarr=array('shijian'=>$time27c,'nodename'=>$time27['nodename'],'beizhu'=>"验收通过",'jine'=>"已付20%工程款<br>实收".number_format($s,2)."元",'nodestatus'=>1,'src'=>WEBURL.'uploadfile/nodeid/shuidian.jpg','srcstatus'=>$srcstatus);
                      $order_finally[strtotime($time27['addtime'])] = $shuidianarr;
                }else{
                   $order_finally[1888886311]=array('nodename'=>'水电验收','nodestatus'=>0,'src'=>WEBURL.'uploadfile/nodeid/shuidian.jpg','srcstatus'=>(int)0);

                }
                // echo '<pre>';print_r($shuidianarr);exit;
          // 泥木验收
                 if(in_array('31', $arr)){
                     //取节点时间、名称、备注
                    $time31=$this->db->get_one('demand_track',"`orderid`=$id AND `nodeid`= 31",'date1,nodename,remark,addtime'); 
                                  $time31a=date('m-d',strtotime($time31['addtime']));            
                                 $time31b=explode('-',$time31a);
                                $time31c=$time31b[0].'-'.$time31b[1];
                     $nimuday=$this->db->get_list('demand_referno',"`orderid`=$id AND `nodeid`= 31",'nodename,needmoney'); 
                      $n = 0.0;
                     foreach ($nimuday as $key => $valuexieyi) {
                       $n+=$valuexieyi['needmoney'];
                     }

                     //判断有无现场照片和整改照片
                        $nimu_src=$this->db->get_one('day_log',"`orderid`=$id AND `nodeid`= 31",'recphoto,sitephoto');
                        if(!unserialize($nimu_src['sitephoto'])&&!unserialize($nimu_src['recphoto'])){
                                  $srcstatus=(int)0;
                        }else{
                                  $srcstatus=(int)1;
                        }

                     $nimuarr=array('shijian'=>$time31c,'nodename'=>$time31['nodename'],'beizhu'=>"验收通过",'jine'=>"已付20%工程款<br>实收".number_format($n,2)."元",'nodestatus'=>1,'src'=>WEBURL.'uploadfile/nodeid/nimu.jpg','srcstatus'=>$srcstatus);
                     $order_finally[strtotime($time31['addtime'])] = $nimuarr;
                }else{
                    $order_finally[1888886313]=array('nodename'=>'泥木验收','nodestatus'=>0,'src'=>WEBURL.'uploadfile/nodeid/nimu.jpg','srcstatus'=>(int)0);
                }
          // 油漆验收
                 if(in_array('35', $arr)){
                     //取节点时间、名称、备注
                    $time35=$this->db->get_one('demand_track',"`orderid`=$id AND `nodeid`= 35",'date1,nodename,remark,addtime'); 
                                 $time35a=date('m-d',strtotime($time35['addtime']));            
                                 $time35b=explode('-',$time35a);
                                $time35c=$time35b[0].'-'.$time35b[1];
                     $youqiday=$this->db->get_list('demand_referno',"`orderid`=$id AND `nodeid`= 35",'nodename,needmoney'); 
                      $y = 0.0;
                     foreach ($youqiday as $key => $valuexieyi) {
                       $y+=$valuexieyi['needmoney'];
                     }
                      //判断有无现场照片和整改照片
                        $youqi_src=$this->db->get_one('day_log',"`orderid`=$id AND `nodeid`= 35",'recphoto,sitephoto');
                        if(!unserialize($youqi_src['sitephoto'])&&!unserialize($youqi_src['recphoto'])){
                                  $srcstatus=(int)0;
                        }else{
                                  $srcstatus=(int)1;
                        }
                    $youqiarr=array('shijian'=>$time35c,'nodename'=>$time35['nodename'],'beizhu'=>"验收通过",'jine'=>"已付20%工程款<br>实收".number_format($y,2)."元",'nodestatus'=>1,'src'=>WEBURL.'uploadfile/nodeid/youqi.jpg','srcstatus'=>$srcstatus);
                    $order_finally[strtotime($time35['addtime'])] = $youqiarr;
                }else{
                    $order_finally[1888886315]=array('nodename'=>'油漆验收','nodestatus'=>0,'src'=>WEBURL.'uploadfile/nodeid/youqi.jpg','srcstatus'=>(int)0);

                }
          // 竣工验收
                 if(in_array('37', $arr)){
                     //取节点时间、名称、备注
                    $time37=$this->db->get_one('demand_track',"`orderid`=$id AND `nodeid`= 37",'date1,nodename,remark,addtime'); 
                                 $time37a=date('m-d',strtotime($time37['addtime']));            
                                 $time37b=explode('-',$time37a);
                                $time37c=$time37b[0].'-'.$time37b[1];
                    $jungongday=$this->db->get_list('demand_referno',"`orderid`=$id AND `nodeid`= 37",'nodename,extrapay'); 
                     $j = 0.0;
                     foreach ($jungongday as $key => $valuexieyi) {
                       $j+=$valuexieyi['extrapay'];
                     }
                      //判断有无现场照片和整改照片
                        $jungong_src=$this->db->get_one('day_log',"`orderid`=$id AND `nodeid`= 37",'recphoto,sitephoto');
                        if(!unserialize($jungong_src['sitephoto'])&&!unserialize($jungong_src['recphoto'])){
                                  $srcstatus=(int)0;
                        }else{
                                  $srcstatus=(int)1;
                        }

                     if(number_format($j,2)==0.00){
                      $jungongarr=array('shijian'=>$time37c,'nodename'=>$time37['nodename'],'beizhu'=>"验收通过",'nodestatus'=>1,'src'=>WEBURL.'uploadfile/nodeid/jungong.jpg','srcstatus'=>$srcstatus);
                     }else{
                         $jungongarr=array('shijian'=>$time37c,'nodename'=>$time37['nodename'],'beizhu'=>"验收通过",'zengxiang'=>"已付增项款".number_format($j,2)."元",'nodestatus'=>1,'src'=>WEBURL.'uploadfile/nodeid/jungong.jpg','srcstatus'=>$srcstatus);
                     }
                   
                     $order_finally[strtotime($time37['addtime'])] = $jungongarr;
                }else{
                    $order_finally[1888886316]=array('nodename'=>'竣工验收','nodestatus'=>0,'src'=>WEBURL.'uploadfile/nodeid/jungong.jpg','srcstatus'=>(int)0);

                }
        // 竣工污染检测
               if($nodeid>39||$nodeid==39){
                     //取节点时间、名称、备注
                    $time39=$this->db->get_one('demand_track',"`orderid`=$id AND `nodeid`= 39",'date1,nodename,remark,addtime'); 
                                 $time39a=date('m-d',strtotime($time39['addtime']));            
                                 $time39b=explode('-',$time39a);
                                $time39c=$time39b[0].'-'.$time39b[1];
                       //判断有无现场照片和整改照片
                        $wuranjiance_src=$this->db->get_one('day_log',"`orderid`=$id AND `nodeid`= 39",'recphoto,sitephoto');
                        if(!unserialize($wuranjiance_src['sitephoto'])&&!unserialize($wuranjiance_src['recphoto'])){
                                  $srcstatus=(int)0;
                        }else{
                                  $srcstatus=(int)1;
                        }
                    $wuranjiancearr=array('shijian'=>$time39c,'nodename'=>$time39['nodename'],'beizhu'=>$time39['remark'],'nodestatus'=>1,'src'=>WEBURL.'uploadfile/nodeid/jungongwuran.jpg','srcstatus'=>$srcstatus);
                    $order_finally[strtotime($time39['addtime'])] = $wuranjiancearr;
                }else{
                    $order_finally[1888886317]=array('nodename'=>'竣工污染检测','nodestatus'=>0,'src'=>WEBURL.'uploadfile/nodeid/jungongwuran.jpg','srcstatus'=>(int)0);

                }
        // 污染治理
                 if(in_array('41', $arr)){
                     //取节点时间、名称、备注
                    $time41=$this->db->get_one('demand_track',"`orderid`=$id AND `nodeid`= 41",'date1,nodename,remark,addtime');
                                 $time41a=date('m-d',strtotime($time41['addtime']));            
                                 $time41b=explode('-',$time41a);
                                $time41c=$time41b[0].'-'.$time41b[1];  
                    $wuran=$this->db->get_one('demand_extra',"`orderid`=$id AND `nodeid`= 41",'companyname,contactno');
                     $wuran1=$this->db->get_list('demand_referno',"`orderid`=$id AND `nodeid`= 41",'needmoney'); 
                     $w = 0.0;
                     foreach ($wuran1 as $key => $valuexieyi) {
                       $w+=$valuexieyi['needmoney'];
                     }
                      //判断有无现场照片和整改照片
                        $wuran_src=$this->db->get_one('day_log',"`orderid`=$id AND `nodeid`= 41",'recphoto,sitephoto');
                        if(!unserialize($wuran_src['sitephoto'])&&!unserialize($wuran_src['recphoto'])){
                                  $srcstatus=(int)0;
                        }else{
                                  $srcstatus=(int)1;
                        }
                    $wuranarr=array('shijian'=>$time41c,'nodename'=>$time41['nodename'],'company'=>'治理公司：'.$wuran['companyname'],'jine'=>"已付金额：".number_format($w,2)."元","bianhao"=>$wuran['contactno'],'beizhu'=>$time41['remark'],'nodestatus'=>1,'src'=>WEBURL.'uploadfile/nodeid/wuranzhili.jpg','srcstatus'=>$srcstatus);
                    if($time41['remark']=='未进行污染治理'){

                    $order_finally[1888886318]=array('nodename'=>'污染治理','nodestatus'=>0,'src'=>WEBURL.'uploadfile/nodeid/wuranzhili.jpg','srcstatus'=>(int)0);
                    }else{

                    $order_finally[strtotime($time41['addtime'])] = $wuranarr;
                    }

                }
                // echo "<pre>";print_r($wuranarr);exit;
          // 复测
                 if(in_array('43', $arr)){
                     //取节点时间、名称、备注
                    $time43=$this->db->get_one('demand_track',"`orderid`=$id AND `nodeid`= 43",'date1,nodename,remark,addtime');  
                                 $time43a=date('m-d',strtotime($time43['addtime']));            
                                 $time43b=explode('-',$time43a);
                                $time43c=$time43b[0].'-'.$time43b[1]; 
                               //判断有无现场照片和整改照片
                                $fuce1_src=$this->db->get_one('day_log',"`orderid`=$id AND `nodeid`= 43",'recphoto,sitephoto');
                                if(!unserialize($fuce1_src['sitephoto'])&&!unserialize($fuce1_src['recphoto'])){
                                          $srcstatus=(int)0;
                                }else{
                                          $srcstatus=(int)1;
                                } 
                             $fuce1arr=array('shijian'=>$time43c,'nodename'=>$time43['nodename'].'1','beizhu'=>$time43['remark'],'nodestatus'=>1,'src'=>WEBURL.'uploadfile/nodeid/fucediyici.jpg','srcstatus'=>$srcstatus);     
                             $order_finally[strtotime($time43['addtime'])] = $fuce1arr;
                }else{
                    $order_finally[1888886319]=array('nodename'=>'复测1','nodestatus'=>0,'src'=>WEBURL.'uploadfile/nodeid/fucediyici.jpg','srcstatus'=>(int)0);
                }
         // 尾款质保期
               if($nodeid>45||$nodeid==45){
                     //取节点时间、名称、备注
                    $time45=$this->db->get_one('demand_track',"`orderid`=$id AND `nodeid`= 45",'date1,nodename,remark,addtime,col4'); 
                                $time45a=date('m-d',strtotime($time45['addtime']));            
                                 $time45b=explode('-',$time45a);
                                $time45c=$time45b[0].'-'.$time45b[1];  
                          //判断有无现场照片和整改照片
                                $weikuan_src=$this->db->get_one('day_log',"`orderid`=$id AND `nodeid`= 45",'recphoto,sitephoto');
                                if(!unserialize($weikuan_src['sitephoto'])&&!unserialize($weikuan_src['recphoto'])){
                                          $srcstatus=(int)0;
                                }else{
                                          $srcstatus=(int)1;
                                } 
                      if($time45['col4']=='已赠送'){
                             $weikuanarr=array('shijian'=>$time45c,'nodename'=>$time45['nodename'],'beizhu'=>$time45['remark'],'zengsong'=>'赠送：优装美家微空气监测仪一台','nodestatus'=>1,'src'=>WEBURL.'uploadfile/nodeid/weikuan.jpg','srcstatus'=>$srcstatus);  
                        }else{
                           $weikuanarr=array('shijian'=>$time45c,'nodename'=>$time45['nodename'],'beizhu'=>$time45['remark'],'nodestatus'=>1,'src'=>WEBURL.'uploadfile/nodeid/weikuan.jpg','srcstatus'=>$srcstatus);  
                        }
                             $order_finally[strtotime($time45['addtime'])] = $weikuanarr;
                }else{
                    $order_finally[1888886320]=array('nodename'=>'尾款质保期','nodestatus'=>0,'src'=>WEBURL.'uploadfile/nodeid/weikuan.jpg','srcstatus'=>(int)0);
                }
        // 入住空气检测
                if(in_array('47', $arr)){
                     //取节点时间、名称、备注
                    $time47=$this->db->get_one('demand_track',"`orderid`=$id AND `nodeid`= 47",'date1,nodename,remark,col4,addtime');
                                $time47a=date('m-d',strtotime($time47['addtime']));            
                                 $time47b=explode('-',$time47a);
                                $time47c=$time47b[0].'-'.$time47b[1];  
                          //判断有无现场照片和整改照片
                                $ruzhu_src=$this->db->get_one('day_log',"`orderid`=$id AND `nodeid`= 47",'recphoto,sitephoto');
                                if(!unserialize($ruzhu_src['sitephoto'])&&!unserialize($ruzhu_src['recphoto'])){
                                          $srcstatus=(int)0;
                                }else{
                                          $srcstatus=(int)1;
                                } 
                    if($time47['col4']=='已赠送'){
                     $ruzhuarr=array('shijian'=>$time47c,'nodename'=>$time47['nodename'],'beizhu'=>$time47['remark'],'zengsong'=>'赠送：优装美家微空气监测仪一台','nodestatus'=>1,'src'=>WEBURL.'uploadfile/nodeid/ruzhukongqijiance.jpg','srcstatus'=>$srcstatus);
                     $order_finally[strtotime($time47['addtime'])] = $ruzhuarr;
                    } else{
                      $ruzhuarr=array('shijian'=>$time47c,'nodename'=>$time47['nodename'],'beizhu'=>$time47['remark'],'nodestatus'=>1,'src'=>WEBURL.'uploadfile/nodeid/ruzhukongqijiance.jpg','srcstatus'=>$srcstatus);
                      $order_finally[strtotime($time47['addtime'])] = $ruzhuarr;
                    }
                   
                }else{
                    $order_finally[1888886321]=array('nodename'=>'入住空气检测','nodestatus'=>0,'src'=>WEBURL.'uploadfile/nodeid/ruzhukongqijiance.jpg','srcstatus'=>(int)0);
                }
                // var_dump($ruzhuarr);exit;
        // 空气治理
                if(in_array('49', $arr)){
                     //取节点时间、名称、备注
                    $time49=$this->db->get_one('demand_track',"`orderid`=$id AND `nodeid`= 49",'date1,nodename,remark,addtime,col4');  
                     $time49a=date('m-d',strtotime($time49['addtime']));            
                                 $time49b=explode('-',$time49a);
                                $time49c=$time49b[0].'-'.$time49b[1];  
                    $kongqi=$this->db->get_one('demand_extra',"`orderid`=$id AND `nodeid`= 49",'totalmoney,contactno,companyname');
                      //判断有无现场照片和整改照片
                                $kongqi_src=$this->db->get_one('day_log',"`orderid`=$id AND `nodeid`= 49",'recphoto,sitephoto');
                                if(!unserialize($kongqi_src['sitephoto'])&&!unserialize($kongqi_src['recphoto'])){
                                          $srcstatus=(int)0;
                                }else{
                                          $srcstatus=(int)1;
                                } 
                  if($time49['col4']=='已赠送'){    
                      $kongqiarr=array('shijian'=>$time49c,'nodename'=>$time49['nodename'],'company'=>'治理公司：'.$kongqi['companyname'],'bianhao'=>'协议编号：'.$kongqi['contactno'],'jine'=>'已付金额：'.number_format($kongqi['totalmoney'],2).'元','beizhu'=>$time49['remark'],'zengsong'=>'赠送：优装美家微空气监测仪一台','nodestatus'=>1,'src'=>WEBURL.'uploadfile/nodeid/kongqizhili.jpg','srcstatus'=>$srcstatus);
                     }else{
                      $kongqiarr=array('shijian'=>$time49c,'nodename'=>$time49['nodename'],'company'=>'治理公司：'.$kongqi['companyname'],'bianhao'=>'协议编号：'.$kongqi['contactno'],'jine'=>'已付金额：'.number_format($kongqi['totalmoney'],2).'元','beizhu'=>$time49['remark'],'nodestatus'=>1,'src'=>WEBURL.'uploadfile/nodeid/kongqizhili.jpg','srcstatus'=>$srcstatus);

                     }
                        if($time49['remark']=='未进行空气治理'){

                            $order_finally[1888886322]=array('nodename'=>'空气治理','nodestatus'=>0,'src'=>WEBURL.'uploadfile/nodeid/kongqizhili.jpg','srcstatus'=>(int)0);
                           }else{
                                 $order_finally[strtotime($time49['addtime'])] = $kongqiarr;
                           }
                        }
                    // echo '<pre>';print_r($order_finally);exit;
                
      // 复测
                 if(in_array('51', $arr)){
                     //取节点时间、名称、备注
                    $time51=$this->db->get_one('demand_track',"`orderid`=$id AND `nodeid`= 51",'date1,nodename,remark,addtime,col4');  
                                $time51a=date('m-d',strtotime($time51['addtime']));            
                                 $time51b=explode('-',$time51a);
                                $time51c=$time51b[0].'-'.$time51b[1]; 
                              //判断有无现场照片和整改照片
                                $fuce2_src=$this->db->get_one('day_log',"`orderid`=$id AND `nodeid`= 51",'recphoto,sitephoto');
                                if(!unserialize($fuce2_src['sitephoto'])&&!unserialize($fuce2_src['recphoto'])){
                                          $srcstatus=(int)0;
                                }else{
                                          $srcstatus=(int)1;
                                } 
                      if($time51['col4']=='已赠送'){    
                                $fuce2arr=array('shijian'=>$time51c,'nodename'=>$time51['nodename'].'2','beizhu'=>$time51['remark'],'zengsong'=>'赠送：优装美家微空气监测仪一台','nodestatus'=>1,'src'=>WEBURL.'uploadfile/nodeid/fucetongguo.jpg','srcstatus'=>$srcstatus);
                          }else{
                             $fuce2arr=array('shijian'=>$time51c,'nodename'=>$time51['nodename'].'2','beizhu'=>$time51['remark'],'nodestatus'=>1,'src'=>WEBURL.'uploadfile/nodeid/fucetongguo.jpg','srcstatus'=>$srcstatus);
                          }
                                 $order_finally[strtotime($time51['addtime'])] = $fuce2arr;
                                 
                }else{
                    $order_finally[1888886323]=array('nodename'=>'复测2','nodestatus'=>0,'src'=>WEBURL.'uploadfile/nodeid/fucetongguo.jpg','srcstatus'=>(int)0);  
                  }

            }else{
                $order_finally[1888886303]=array('nodename'=>'上门量房','nodestatus'=>0,'src'=>WEBURL.'uploadfile/nodeid/shangmenliangfang.jpg','srcstatus'=>(int)0);
                $order_finally[1888886304]=array('nodename'=>'确定装修公司','nodestatus'=>0,'src'=>WEBURL.'uploadfile/nodeid/quedingzhuangxiugongsi.jpg','srcstatus'=>(int)0);
                $order_finally[1888886305]=array('nodename'=>'签订设计协议/意向定金','nodestatus'=>0,'src'=>WEBURL.'uploadfile/nodeid/yixiangdingjin.jpg','srcstatus'=>(int)0);
                $order_finally[1888886306]=array('nodename'=>'方案确定预交底','nodestatus'=>0,'src'=>WEBURL.'uploadfile/nodeid/fanganyujiaodi.jpg','srcstatus'=>(int)0);
                $order_finally[1888886307]=array('nodename'=>'签施工协议','nodestatus'=>0,'src'=>WEBURL.'uploadfile/nodeid/shigongxieyi.jpg','srcstatus'=>(int)0);
                $order_finally[1888886308]=array('nodename'=>'工程开工','nodestatus'=>0,'src'=>WEBURL.'uploadfile/nodeid/gongchengkaigong.jpg','srcstatus'=>(int)0);
                $order_finally[1888886309]=array('nodename'=>'拆改','nodestatus'=>0);
                 $order_finally[1888886310]=array('nodename'=>'水电材料验收','nodestatus'=>0,'src'=>WEBURL.'uploadfile/nodeid/shuidiancailiao.jpg','srcstatus'=>(int)0);
                $order_finally[1888886312]=array('nodename'=>'泥木材料验收','nodestatus'=>0,'src'=>WEBURL.'uploadfile/nodeid/nimucailiao.jpg','srcstatus'=>(int)0);
                $order_finally[1888886314]=array('nodename'=>'油漆材料验收','nodestatus'=>0,'src'=>WEBURL.'uploadfile/nodeid/youqicailiao.jpg','srcstatus'=>(int)0);
                 $order_finally[1888886311]=array('nodename'=>'水电验收','nodestatus'=>0,'src'=>WEBURL.'uploadfile/nodeid/shuidian.jpg','srcstatus'=>(int)0);
                $order_finally[1888886313]=array('nodename'=>'泥木验收','nodestatus'=>0,'src'=>WEBURL.'uploadfile/nodeid/nimu.jpg','srcstatus'=>(int)0);
                $order_finally[1888886315]=array('nodename'=>'油漆验收','nodestatus'=>0,'src'=>WEBURL.'uploadfile/nodeid/youqi.jpg','srcstatus'=>(int)0);
                 $order_finally[1888886316]=array('nodename'=>'竣工验收','nodestatus'=>0,'src'=>WEBURL.'uploadfile/nodeid/jungong.jpg','srcstatus'=>(int)0);
                $order_finally[1888886317]=array('nodename'=>'竣工污染检测','nodestatus'=>0,'src'=>WEBURL.'uploadfile/nodeid/jungongwuran.jpg','srcstatus'=>(int)0);
                $order_finally[1888886318]=array('nodename'=>'污染治理','nodestatus'=>0,'src'=>WEBURL.'uploadfile/nodeid/wuranzhili.jpg','srcstatus'=>(int)0);
                $order_finally[1888886319]=array('nodename'=>'复测1','nodestatus'=>0,'src'=>WEBURL.'uploadfile/nodeid/fucediyici.jpg','srcstatus'=>(int)0);
                $order_finally[1888886320]=array('nodename'=>'尾款质保期','nodestatus'=>0,'src'=>WEBURL.'uploadfile/nodeid/weikuan.jpg','srcstatus'=>(int)0);
                $order_finally[1888886321]=array('nodename'=>'入住空气检测','nodestatus'=>0,'src'=>WEBURL.'uploadfile/nodeid/ruzhukongqijiance.jpg','srcstatus'=>(int)0);
                $order_finally[1888886322]=array('nodename'=>'空气治理','nodestatus'=>0,'src'=>WEBURL.'uploadfile/nodeid/kongqizhili.jpg','srcstatus'=>(int)0);
                 $order_finally[1888886323]=array('nodename'=>'复测2','nodestatus'=>0,'nodestatus'=>0,'src'=>WEBURL.'uploadfile/nodeid/fucetongguo.jpg','srcstatus'=>(int)0); 
                  $order_finally[1888886324]=array('nodename'=>'完成','nodestatus'=>0); 
            }
                ksort($order_finally);
                $order_finally=array_values($order_finally);
                 $order=array(
                  'dingdanxinxi'=>$dingdanxinxi,
                  'dangqianjindu'=>$demand_track1,
                  'dingdanjiedian'=>$order_finally,
                  );
                 // echo '<pre>';print_r($order_finally);exit;
                echo json_encode(array('code'=>1,'data'=>$order,'message'=>'装修订单详情页的数据','process_time'=>time()));

      }

    //我的美家工地直播
    public function log(){
      $ab=array();
      $ac=array();
      $uid=$GLOBALS['uid'];
          $a= $this->db->get_list('day_log_demand_list','uid="'.$uid.'"','orderid,nodeid,logname,recphoto,sitephoto,addtime,nodename,address,userid',0,100,$page,'id DESC');
           foreach ($a as $ke => $va) {
           $c[$ke]=$va['orderid'];
           }
           if($c){
            $aw=implode(',',$c);
           }else{
            $aw=-1;
           }
           $where1='uid="'.$uid.'"';
           $d= $this->db->get_list('demand',$where1,'id,address',0,100,$page,'id DESC');
           //echo '<pre>';print_r($d);exit;
           foreach ($d as $keyd => $valued) {            
              $where='orderid='.$valued['id'];
              $b= $this->db->get_one('day_log',$where,'orderid');
              if($b==''){
                 $ac[$keyd]['status']=2;
                 $ac[$keyd]['orderid']=$valued['id'];
                 $ac[$keyd]['address']=$valued['address'];
                 $aa='工地还没有开始开工那~';
                 $ac[$keyd]['res']=$aa;
              }
           }//echo '<pre>';print_r($ab);exit;         
          if($d){           
          
        
          $ad=array();
           foreach ($a as $key => $value) {
                $ab[$key]['orderid']=$value['orderid'];
                $ab[$key]['nodeid']=$value['nodeid'];
                $ab[$key]['logname']=$value['logname'];
                $ab[$key]['addtime']=time_format1(strtotime($value['addtime']));
                if(!preg_match("/[\x7f-\xff]/", $ab[$key]['addtime'])){
                    $ab[$key]['addtime']=date('Y-m-d',strtotime($value['addtime']));
                }
                $ab[$key]['nodename']=$value['nodename'];
                $ab[$key]['address']=$value['address'];
                $ab[$key]['result']= unserialize($value['recphoto']);
                //echo "<pre>";print_r($ab[$key]['result']);exit;
                $ab[$key]['results']= unserialize($value['sitephoto']);
                         $aaa=array_filter($ab[$key]['result']);
                $ab[$key]['photo']=array_slice($aaa,-1,1);
                         $bbb=array_filter($ab[$key]['results']);
                $ab[$key]['photos']=array_slice($bbb,-1,1);
                //$resulto1=array_pop($result1);
                //var_dump( $ab[$key]['photo'][0]);exit;
                if(is_array($ab[$key]['result'][0])){
                      $keys = array_keys($ab[$key]['result'][0]);
                      $ab[$key]['recphoto']='http://www.uzhuang.com/image/pic_230/'.$ab[$key]['result'][0][$keys[0]][0];
                      }else{
                      $ab[$key]['recphoto']= 'http://www.uzhuang.com/image/pic_230/'.$ab[$key]['photo'][0];
                      }
                   if($ab[$key]['photos']){
                if(is_array($ab[$key]['results'][0])){
                      $keys = array_keys($ab[$key]['results'][0]);
                      $ab[$key]['sitephoto']='http://www.uzhuang.com/image/pic_230/'.$ab[$key]['results'][0][$keys[0]][0];                     
                      }else{
                         $ab[$key]['sitephoto']='http://www.uzhuang.com/image/pic_230/'.$ab[$key]['photos'][0];
                      }
                   }
                 }
                    foreach ($a as $ke => $value) { 
                      $log_r= $this->db->get_one('member_hk_data',array('uid'=>$value['userid']), 'uid,gjname,personalphoto,lifeword');
                      $ab[$ke]['uid']=$log_r['uid'];
                      $ab[$ke]['gjname']=$log_r['gjname'];
                      $ab[$ke]['personalphoto']=$log_r['personalphoto'];
                      $ab[$ke]['lifeword']=$log_r['lifeword'];
                      }
                      foreach ($ab as $pk => $pl) {
                         $ab[$pk]['personalphotos'] ='http://www.uzhuang.com/image/small_square/'.$arb[$pk]['personalphoto'];
                      }
                      //$ab=.$ac;
                      $results = array_merge($ab, $ac);
                //echo"<pre>";print_r($results); 
                echo json_encode(array('code'=>1,'data'=>$results,'message'=>'','process_time'=>time()));exit;
              }else{
                $a='您还没有工地哦~';
                echo json_encode(array('code'=>0,'data'=>$a,'message'=>"您还没有工地哦",'process_time'=>time()));exit;
              }
          }

       public function steward()
       {
            $uid=remove_xss($GLOBALS['uid']);
            $res=$this->db->get_list('favorite',"`uid`='".$uid."' and `type`=14");
            if(!$res)
            {
              echo json_encode(array('code'=>0,'data'=>'您还没有收藏管家哦','message'=>"您还没有收藏管家哦",'process_time'=>time()));exit;
            }else
            {
                $arr=array();
                foreach ($res as $key => $value)
                {
                     $gj=$this->db->get_one('member_hk_data',"`uid`='".$value['keyid']."'");
                     $arr[$key]['gj_id']=$value['keyid'];
                     $arr[$key]['personalphoto']='http://www.uzhuang.com/image/pic_230/'.$gj['personalphoto'];
                     $arr[$key]['gjname']=$gj['gjname'];
                     $arr[$key]['level']=$gj['level'];
                     $arr[$key]['constru_num']=count($this->db->get_list('day_log_demand_list',"`userid`='".$value['keyid']."'"));
                     $arr[$key]['answer_num']=count($this->db->get_list('bang_answer',"`uid`='".$value['keyid']."'"));
                     
                }
              echo json_encode(array('code'=>1,'data'=>$arr,'message'=>'个人中心收藏管家列表','process_time'=>time()));exit;
            }
       }

      // 管家收藏
      public function collect(){
          $uid=remove_xss($GLOBALS['uid']);
            if(!$uid)
            {
              echo json_encode(array('code'=>0,'data'=>array('member'=>null),'message'=>L('login_please'),'process_time'=>time()));exit;
            }else
            {
              // 收藏的管家id
              $id=remove_xss($GLOBALS['id']);
            $r = $this->db->get_one('favorite', array('uid' => $uid,'type'=>14,'keyid'=>$id));
              $mec_r = $this->db->get_one('member_hk_data',"`uid`=$id",'*');
              if(empty($mec_r)){
                  echo json_encode(array('code'=>0,'data'=>null,'message'=>"该管家不存在",'process_time'=>time()));exit;
              };
              if(!$r)
              {
                  $formdata = array();
                  $formdata['type'] = 14;
                  $formdata['addtime'] = SYS_TIME;
                  $formdata['uid'] = $uid;
                  $formdata['keyid'] = $id;
                  $formdata['collectstatus'] = 1;
                  $this->db->insert('favorite', $formdata);
                  echo json_encode(array('code'=>1,'data'=>array('collectstatus'=>1),'message'=>"收藏成功",'process_time'=>time()));exit;
              }else
              {
                  $this->db->delete('favorite', array('fid'=>$r['fid']));
                  echo json_encode(array('code'=>1,'data'=>array('collectstatus'=>0),'message'=>"取消收藏成功",'process_time'=>time()));exit;
              }
            }
      }

 }



