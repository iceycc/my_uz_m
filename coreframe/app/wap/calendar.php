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
class calendar extends WUZHI_foreground {
	function __construct() {
        $this->member = load_class('member', 'member');
        load_function('common', 'member');
        $this->member_setting = get_cache('setting', 'member');
        parent::__construct();
        //echo WWW_ROOT;
        require_once(WWW_ROOT.'api/calender.php');
	}

	public function zx_calendar(){
		//手机号
        $mobile=$GLOBALS['mobile'];
        //称呼
        $name=$GLOBALS['name'];
        //装修时间  1:一个月以内2:三个月以内3:
        $decorate=$GLOBALS['decorate'];
        //省
        $areaid_1=$GLOBALS['areaid_1'];
        //市
        $areaid_2=$GLOBALS['areaid_2'];
        //点击换一个
        $exchange=$GLOBALS['exchange'];
            $formdata=array();
            $formdata['referer'] = remove_xss(HTTP_REFERER);
            $formdata['order_no'] = date('YmdH').rand(100,999).date('is');
            $formdata['nodeid'] =0;
            $formdata['nodename']='订单待确认';
            $formdata['title'] = $name;
            $formdata['telephone'] = $mobile;
            $formdata['areaid_1'] = $areaid_1;
            $formdata['areaid_2'] = $areaid_2;
            $formdata['addtime'] = date('Y-m-d G:i:s',time());
            $formdata['orderstatus'] = '正常';
            $formdata['cid'] = 135;
            $formdata['status'] = 1;
            $formdata['source']='M-装修吉日';
            //$this->db->insert('demand',$formdata);
            $demands=$this->db->get_list('demand','telephone="'.$mobile.'" and source="M-装修吉日"','addtime',0,1,$page,'id desc');
            $a = $demands[0]['addtime'];
			$a_ux = strtotime($a);
			$a_date = date('Y-m-d',$a_ux);
			$b_date = date('Y-m-d');
			
        //发送手机短息
        $sendMessage = load_class('sendmessage');
	/*	$msg="用户测算1个月内装修吉日测算结果是16年9月19日，那么短信内容为：【优装美家】一个月内适合您装修的日子是：公元2016年9月19日 星期一。退订回N";
		echo "<pre>";print_r($mobile);
		echo "<pre>";print_r($msg);
        $re=$sendMessage->sendmessage($mobile,$msg);
        var_dump($re);exit;*/
        $res=substr($mobile,-4);
        $a=$res/80;
        $f = '0'.'.'.end(explode('.', $a));
        $b=$f*80;
        $ress=substr($b,0,1);
        $time=time();
        $calender= new calender_module;
        if($decorate==1){
            //一个月以内
	        //$BeginDate=date('Y-m-01 H:i:s', strtotime(date("Y-m-d 23:59:59")));
	        $type = $GLOBALS['type'];
	        $status = $GLOBALS['status'];
	        $start_time=$time;
	        $aaa=date("Y-m-d H:i:s",strtotime("+1 month")-86400);
	        $last_time=strtotime($aaa);
	        $starts=$GLOBALS['start'];
	        $start=strtotime($starts);
	        $date=$starts;	
	        if(empty($start)){
	        $resu=$calender->luckyDays($start_time,$last_time,1,$mobile);
	        if(empty($resu)){
              $result=$calender->luckyDays($start_time,$last_time,1);
              	if(count($result)==1){
					$result[0]['status']='1';
					$result[0]['type']='number';
				}
              $result[0]['type']='time';
	        }else{
	          $result=$calender->luckyDays($start_time,$last_time,2,$mobile);
	            if(count($result)==1){
					$result[0]['status']='2';
					$result[0]['type']='time';
				}
	          $result[0]['type']='number';
	          	        
	        }
	        $msg='一个月内适合您装修的日子是：公元'.$result[0]['sYear'].'年'.$result[0]['sMonth'].'月'.$result[0]['sDay'].'日 星期'.$result[0]['week'].'。退订回N';
	        $result[0]['decorate']='一个月内适合您的装修吉日是';
	        $demand=$this->db->get_list('demand','telephone="'.$mobile.'" and source="M-装修吉日"','addtime',0,1,$page,'id desc');
	        if($a_date!=$b_date){
			$id=$this->db->insert('demand',$formdata);
			}
			$order_no = '1'.str_pad($id,9,0,STR_PAD_LEFT);
			$this->db->update('demand',array('order_no'=>$order_no),array('id'=>$id));
	        echo json_encode(array('code'=>1,'data'=>$result,'message'=>'装修吉日','process_time'=>time())); 
	        //if(empty($demand)){
                //$sendMessage->sendmessage($mobile,$msg);
	        //}
	        exit;
	        //点击换一个
		    }else if(!empty($start)){
			  if($start){
		      	$start+=86400;
              }
              if($status!='null'){
              	$start=time();
              }
              
              $results[]=$this->fortuna($start,$last_time,$mobile,$status,$type,$date);
              $results[0]['decorate']='一个月内适合您的装修吉日是';
              echo json_encode(array('code'=>1,'data'=>$results,'message'=>'点击换一个的装修吉日','process_time'=>time())); exit;
	        }
        }else if($decorate==2){
            //三个月以内
           	$type = $GLOBALS['type'];
	        $status = $GLOBALS['status'];
	        $start_time=$time;
	        $last_time=strtotime("3 months");
	        $starts=$GLOBALS['start'];
	        $start=strtotime($starts);
	        $date=$starts;	
	        if(empty($start)){
	        $resu=$calender->luckyDays($start_time,$last_time,1,$mobile);
	        if(empty($resu)){
              $result=$calender->luckyDays($start_time,$last_time,1);
              $result[0]['type']='time';
	        }else{
	          $result=$calender->luckyDays($start_time,$last_time,1,$mobile);
	          $result[0]['type']='number';
	        }
	        $msg='三个月内适合您装修的日子是：公元'.$result[0]['sYear'].'年'.$result[0]['sMonth'].'月'.$result[0]['sDay'].'日 星期'.$result[0]['week'].'。退订回N';
	        $result[0]['decorate']='三个月内适合您的装修吉日是';
	        $demand=$this->db->get_list('demand','telephone="'.$mobile.'" and source="M-装修吉日"','addtime',0,1,$page,'id desc');
	        if($a_date!=$b_date){
			$id=$this->db->insert('demand',$formdata);
			}
			$order_no = '1'.str_pad($id,9,0,STR_PAD_LEFT);
			$this->db->update('demand',array('order_no'=>$order_no),array('id'=>$id));
	        echo json_encode(array('code'=>1,'data'=>$result,'message'=>'装修吉日','process_time'=>time()));
	        /*if(empty($demand)){
                $sendMessage->sendmessage($mobile,$msg);
	        }*/
	        exit;
	        //点击换一个
	        }else if(!empty($start)){
			  if($start){
		      	$start+=86400;
              }
              if($status!='null'){
              	$start=time();
              }
              $results[]=$this->fortuna($start,$last_time,$mobile,$status,$type,$date);
              $results[0]['decorate']='三个月内适合您的装修吉日是';
              echo json_encode(array('code'=>1,'data'=>$results,'message'=>'点击换一个的装修吉日','process_time'=>time())); exit;
            }
        }else if($decorate==3){
            //本年内
           	$type = $GLOBALS['type'];
	        $status = $GLOBALS['status'];           
	        $start_time=$time;
	        $year=date("Y",time());
			$last_time=strtotime($year."-12-31");
			$starts=$GLOBALS['start'];
	        $start=strtotime($starts);
	        $date=$starts;	
			if(empty($start)){
			$resu=$calender->luckyDays($start_time,$last_time,1,$mobile);
	        if(empty($resu)){
              $result=$calender->luckyDays($start_time,$last_time,1);
              $result[0]['type']='time';
	        }else{
	          $result=$calender->luckyDays($start_time,$last_time,1,$mobile);
	          $result[0]['type']='number';
	        }
			$msg='本年内适合您装修的日子是：公元'.$result[0]['sYear'].'年'.$result[0]['sMonth'].'月'.$result[0]['sDay'].'日 星期'.$result[0]['week'].'。退订回N';
			$result[0]['decorate']='本年内适合您的装修吉日是';
			$demand=$this->db->get_list('demand','telephone="'.$mobile.'" and source="M-装修吉日"','addtime',0,1,$page,'id desc');
	        if($a_date!=$b_date){
			$id=$this->db->insert('demand',$formdata);
			}
			$order_no = '1'.str_pad($id,9,0,STR_PAD_LEFT);
			$this->db->update('demand',array('order_no'=>$order_no),array('id'=>$id));
			echo json_encode(array('code'=>1,'data'=>$result,'message'=>'装修吉日','process_time'=>time()));
	        /*if(empty($demand)){
               $sendMessage->sendmessage($mobile,$msg);
            }	*/
			exit;
			//点击换一个
            }else if(!empty($start)){
              if($start){
		      	$start+=86400;
              }
              if($status!='null'){
              	$start=time();
              }
		      $results[]=$this->fortuna($start,$last_time,$mobile,$status,$type,$date);
		      $results[0]['decorate']='本年内适合您的装修吉日是';
		      echo json_encode(array('code'=>1,'data'=>$results,'message'=>'点击换一个的装修吉日','process_time'=>time())); exit;
            }
        }else if($decorate==4){
            //一年内
           	$type = $GLOBALS['type'];
	        $status = $GLOBALS['status'];
	        $start_time=$time;
			$last_time=strtotime("1 years");
			$starts=$GLOBALS['start'];
	        $start=strtotime($starts);
	        $date=$starts;	
			if(empty($start)){
			$resu=$calender->luckyDays($start_time,$last_time,1,$mobile);
	        if(empty($resu)){
              $result=$calender->luckyDays($start_time,$last_time,1);
              $result[0]['type']='time';
	        }else{
	          $result=$calender->luckyDays($start_time,$last_time,1,$mobile);
	          $result[0]['type']='number';
	        }
			$msg='一年内适合您装修的日子是：公元'.$result[0]['sYear'].'年'.$result[0]['sMonth'].'月'.$result[0]['sDay'].'日 星期'.$result[0]['week'].'。退订回N';
			$result[0]['decorate']='一年内适合您的装修吉日是';
			$demand=$this->db->get_list('demand','telephone="'.$mobile.'" and source="M-装修吉日"','addtime',0,1,$page,'id desc');
	        if($a_date!=$b_date){
			$id=$this->db->insert('demand',$formdata);
			}
			$order_no = '1'.str_pad($id,9,0,STR_PAD_LEFT);
			$this->db->update('demand',array('order_no'=>$order_no),array('id'=>$id));
			echo json_encode(array('code'=>1,'data'=>$result,'message'=>'装修吉日','process_time'=>time()));
	        /*if(empty($demand)){
               $sendMessage->sendmessage($mobile,$msg);
            }	*/		
			exit;
			//点击换一个			
            }else if(!empty($start)){
		      if($start){
		      	$start+=86400;
              }
              if($status!='null'){
              	$start=time();
              }
		      $results[]=$this->fortuna($start,$last_time,$mobile,$status,$type,$date);
		      $results[0]['decorate']='一年内适合您的装修吉日是';
		      echo json_encode(array('code'=>1,'data'=>$results,'message'=>'点击换一个的装修吉日','process_time'=>time())); exit;
            }
        }else if($decorate==5){
            //一年以后
            $type = $GLOBALS['type'];
	        $status = $GLOBALS['status'];
            $times= date("Y-m-d", strtotime("1 year"));
	        $start_time= strtotime("1 year");
	        $a=strtotime($times);
	        $year=date('Y',$a);
			$last_time=strtotime("2 year");
			$starts=$GLOBALS['start'];
	        $start=strtotime($starts);
	        $date=$starts;
			if(empty($start)){
			$resu=$calender->luckyDays($start_time,$last_time,1,$mobile);
	        if(empty($resu)){
              $result=$calender->luckyDays($start_time,$last_time,1);
              $result[0]['type']='time';
	        }else{
	          $result=$calender->luckyDays($start_time,$last_time,1,$mobile);
	          $result[0]['type']='number';
	        }
			$msg='一年以后适合您装修的日子是：公元'.$result[0]['sYear'].'年'.$result[0]['sMonth'].'月'.$result[0]['sDay'].'日 星期'.$result[0]['week'].'。退订回N';
			$result[0]['decorate']='一年以后适合您的装修吉日是';
			$demand=$this->db->get_list('demand','telephone="'.$mobile.'" and source="M-装修吉日"','addtime',0,1,$page,'id desc');
	        if($a_date!=$b_date){
			$id=$this->db->insert('demand',$formdata);
			}
			$order_no = '1'.str_pad($id,9,0,STR_PAD_LEFT);
			$this->db->update('demand',array('order_no'=>$order_no),array('id'=>$id));
			echo json_encode(array('code'=>1,'data'=>$result,'message'=>'装修吉日','process_time'=>time()));
	        /*if(empty($demand)){
               $sendMessage->sendmessage($mobile,$msg);
            }	*/		
			exit;
			}else if(!empty($start)){
		      if($start){
		      	$start+=86400;
              }
              if($status!='null'){
              	$start=$start_time;
              }
		      $results[]=$this->fortuna($start,$last_time,$mobile,$status,$type,$date);
		      $result[0]['decorate']='一年以后适合您的装修吉日是';
		      echo json_encode(array('code'=>1,'data'=>$results,'message'=>'点击换一个的装修吉日','process_time'=>time())); exit;
			}
        }
        //echo "<pre>";print_r($mobile,$msg);exit;
        //$demand=$this->db->get_list('demand','mobile="'.$mobile.'" and source="M-装修吉日"','addtime',0,1,$page,'id desc');
	    //if(empty($demand)){
        //$sendMessage->sendmessage($mobile,$msg);
        //}
	}

	//幸运号+装修吉日的循环方法
	public function fortuna($start,$last_time,$mobile,$status,$type,$date){
		   /* echo "<pre>";print_r($date);
			echo "<pre>";print_r(date("Y-m-d",$start));
			echo "<pre>";print_r(date("Y-m-d",$last_time));exit;*/
		$calender= new calender_module;
		if($status==2 || $type=='number'){
           $fortuna_result=$calender->luckyDays($start,$last_time,2,$mobile);
           if(empty($fortuna_result)){
           	    $start=time();
	           	$fortuna_results=$calender->luckyDays($start,$last_time,2);
	           	$fortuna_results[0]['type']='time';
				if(count($fortuna_results)==1){
					$fortuna_results[0]['status']='2';
					$fortuna_results[0]['type']='number';
				}
				return $fortuna_results[0];
           }
           $a=$fortuna_result[0]['sYear'].'-'.$fortuna_result[0]['sMonth'].'-'.$fortuna_result[0]['sDay'];
           if($a==$date){
           $starts=strtotime($a);
           $starts+=86400;
           $fortuna_result=$calender->luckyDays($starts,$last_time,2,$mobile);
	            if(empty($fortuna_result)){
		           	$fortuna_resultss=$calender->luckyDays($start,$last_time,2);
		           	$fortuna_resultss[0]['type']='time';
					if(count($fortuna_resultss)==1){
						$fortuna_resultss[0]['status']='2';
						$fortuna_resultss[0]['type']='number';
					}
					return $fortuna_resultss[0];
	            }
           }
		   $fortuna_result[0]['type']='number';
		    if(count($fortuna_result)==1){
		        $fortuna_result[0]['status']=1;
		        $fortuna_result[0]['type']='time';
		    }
		    return $fortuna_result[0];
        }else if($status==1 || $type=='time'){
            $lucky_result=$calender->luckyDays($start,$last_time,2);
            if(empty($lucky_result)){
	           	$lucky_results=$calender->luckyDays($start,$last_time,2,$mobile);
	           	$lucky_results[0]['type']='time';
				if(count($lucky_results)==1){
					$lucky_results[0]['status']='2';
					$lucky_results[0]['type']='number';
				}
				return $lucky_results[0];
            }
           $a=$lucky_result[0]['sYear'].'-'.$lucky_result[0]['sMonth'].'-'.$lucky_result[0]['sDay'];
           if($a==$date){
           $starts=strtotime($a);
           $starts+=86400;
           //echo "<pre>";print_r($starts);exit;
           $lucky_result=$calender->luckyDays($starts,$last_time,2);
             if(empty($lucky_result)){
	           	$lucky_resultss=$calender->luckyDays($start,$last_time,2,$mobile);
	           	$lucky_resultss[0]['type']='time';
				if(count($lucky_resultss)==1){
					$lucky_resultss[0]['status']='2';
					$lucky_resultss[0]['type']='number';
				}
				return $lucky_resultss[0];
             }
           }
		    $lucky_result[0]['type']='time';
			if(count($lucky_result)==1){
				$lucky_result[0]['status']='2';
				$lucky_result[0]['type']='number';
			}
			return $lucky_result[0];
        }
	}
    //家居风水相关问答推荐
	public function zx_question(){
		$arr= $this->db->get_list('bang_question',"`tally`='装修风水'", 'id,title,uid,qtime', 0, 3,$page,'qtime DESC');
		//echo "<pre>";print_r($arr);exit;
		$res=array();
	        foreach ($arr as $key => $value){
	        $avatar= $this->db->get_one('member',array('uid'=>$value['uid']),'avatar');
	        if($value['uid'] && $avatar['avatar']==1){
	        $arr[$key]['tw_photo']='http://www.uzhuang.com/'.'uploadfile/member/'.substr(md5($value['uid']), 0, 2).'/'.$value['uid'].'/180x180.jpg';
	        }else{
	        $arr[$key]['tw_photo']='http://m.uzhuang.com/res/img/yonghu.png';
	        }
	        $result = $this->db->get_list('bang_answer',array('qid'=>$value['id']),'*');
		        foreach ($result as $k => $v) {
		            if($value['id']==$v['qid']){
		              $res['uid']=$result[$k]['uid'];
		              //$res['qid']=$result[$k]['qid'];
		              $res['founder']=$result[$k]['founder'];
		              $res['content']=$result[$k]['content'];
			            if($v['founder']==0){
			           	    $personalphoto=$this->db->get_one('member_hk_data',"uid='".$result[$k]['uid']."'",'personalphoto');
					        if($personalphoto['personalphoto']){
					        $res['hf_photo']="http://www.uzhuang.com/image/pic_230/".$personalphoto['personalphoto'];
					        }else{
					        $res['hf_photo']="http://m.uzhuang.com/res/img/yonghu.png";
					        }
			            }else if($v['founder']==1){
			            	if($result[$k]['uid']){
			           	    $res['hf_photo']='http://www.uzhuang.com/'.'uploadfile/member/'.substr(md5($v['uid']), 0, 2).'/'.$v['uid'].'/180x180.jpg';
			                }else{
			                $res['hf_photo']="http://m.uzhuang.com/res/img/yonghu.png";
			                }
			            }
			        }
			        $arr[$key]['qid'][] =$res;
		        } 
	        }
	    return $arr;
	}
	//家居风水相关装修知识推荐
	public function House_geomancy(){
	    $res=$this->db->get_list('faq',"cid=87 and status=9",'id,title,remark,thumb',0,3,$page,'sort desc,addtime desc');
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
	        if($value['thumb']){
	          $res[$key]['thumb']="http://www.uzhuang.com/image/pic_230/".$value['thumb'];
	        }
	    }
	    return $res;
    }
    
    public function index(){
    	$arr=array(
    	   'zx_question' =>$this->zx_question(),
    	   'House_geomancy' =>$this->House_geomancy()
    	);
        echo json_encode(array('code'=>1,'data'=>$arr,'message'=>'','process_time'=>time())); exit;
    }
 


}