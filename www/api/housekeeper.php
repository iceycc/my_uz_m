<?php
header('Content-type:text/html;charset=utf-8');
header("Access-Control-Allow-Origin: *");
define('WWW_ROOT',substr(dirname(__FILE__), 0, -4).'/');
require '../configs/web_config.php';
require COREFRAME_ROOT.'core.php';
$action = $GLOBALS['action'];
if($action=='data') {
    data();
}else if($action=='questionlst'){
	questionlst();
}else if($action=='questionDetails'){
	questionDetails();
}else if($action=='collect'){
	collect();
}else if($action=='laud'){
	laud();
}
//1675
  function data(){
		$uid=$GLOBALS['uid'];
	 	if(empty($uid)){
	  		echo json_encode(array('code'=>0,'data'=>'管家id不能为空！','process_time'=>time()));
	  		die;
	  	}
	 	$db = load_class('db');
	 	load_function('common','member');
	 	$hk = $db->get_one('member_hk_data',array('uid'=>$uid));
	 	$person_label=explode("|",$hk['person_label']);
	 	$dem = $db->get_list('demand',"housekeeperid=$uid and id<=11589",'nodename,nodeid,id,logname',0,2000,0,"id desc");
	 	$answer=array();
	 	$questiondata=array();
	 	$site=array();
	 	$log_rs = $db->get_list('day_log_demand_list','userid="'.$uid.'" and nodeid >10 and nodename!="预约量房" and url LIKE "%shows%" and orderid >13087 and nodeid!=10000', 'logname,renovationcategory,homestyle,budget,housetype,style,way,area,userid,addtime,nodename,uid,orderid,nodeid,check_detail,check_waterdetail,check_other,recphoto,content,browse_count,url,thumb', 0,1000, $page, 'addtime DESC');
	 	    foreach ($log_rs as $key => $value) {
		        $site[$key]['title']=$value['logname'];
		        $site[$key]['nodename']=$value['nodename'];
		        $site[$key]['id']=$value['orderid'];
		        $site[$key]['thumb']=$value['thumb'];
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
		        if($arrs[$key]['photo']){
		        $site[$key]['recphoto']="http://www.uzhuang.com/image/pic_230/".end($arrs[$key]['photo']); 
		        }else if($value['thumb']){
		        $site[$key]['recphoto']="http://www.uzhuang.com/image/pic_230/".$value['thumb']; 
		        }else{
		        $site[$key]['recphoto']=R.'msite/building_live/img/cover.jpg';
		        }
		    }
	 	$questions=	$db->get_list('bang_answer',"uid=$uid",'qid',0,20000,$page,'id desc');
	 	foreach ($questions as $qkey => $qvalue) {
	 		$qid[]=$qvalue['qid'];
	 	}
	    $qid=implode(',',$qid);
	    if(!empty($qid)){
	    	$question=$db->get_list('bang_question',"id in ($qid)",'title,uid,id,qtime,uname',0,20000,$page,'id desc');
		    foreach ($question as $qu => $que) {
		    	$ques=	$db->get_one('bang_answer',"qid=$que[id]",'laud');
		    	$questiondata[$qu]['title']=$que['title'];
		    	$time= strtotime($que['qtime']);
		    	$questiondata[$qu]['Time']=$action=Times($time);
		        $questiondata[$qu]['userp']=avatar($que['uid'],180);
		    	$answers=	$db->get_list('bang_answer',"qid=$que[id] and founder=0",'id,content,laud',0,1,$page,'id desc');
		    	foreach ($answers as $ey => $e) {
		    	  $answer[$qu]['id']=$e['id'];
		    	  $answer[$qu][content]=$e['content'];
		    	  if($hk['personalphoto']){
		    	  $answer[$qu]['gjp']='http://www.uzhuang.com/image/pic_230/'.$hk['personalphoto'];
		    	  }else{
		    	  $answer[$qu]['gjp']='http://m.uzhuang.com/res/img/guanjia.png';
		    	  }
		    	  $answer[$qu]['laud']=$e['laud'];
		    	}
		    }
	    }
	    
	 	$levelname=array(0=>'普通管家',1=>'金牌管家');
	 	//判断是否收藏
	 	if($GLOBALS['source']){
	 			$ers=$db->get_one('favorite',"`uid`='".$GLOBALS['userid']."' and `keyid`='".$uid."' and `type`=14");	
	 	}else{

	 			$ers=$db->get_one('favorite',"`uid`='".get_cookie('_uid')."' and `keyid`='".$uid."' and `type`=14");
	 	}
	 	if($ers){
	 		$collectstatus=1;
	 	}else{
	 		$collectstatus=0;
	 	}
	    $data=array(
	    	 'gjname'=>$hk['gjname'],//管家名称
	    	 'level'=>$hk['level'],//是否为金牌管家  1是 0 否
	    	 'levelname'=>$levelname[$hk['level']],//管家级别
	         'headportrait'=>getGImgShow($hk['half_photo'],'original'),//管家照片
	         'worktime'=>$hk['worktime'],//从业时间 
	         'service_num'=>$hk['service_num'],//服务客户数量
	         'good_percent'=>$hk['good_percent'],//用户好评率
	         'lifeword'=>$hk['lifeword'],//管家箴言
	         'experience'=>$hk['experience'],//职业经历
	         'person_label'=>$person_label,//个人标签  
	         'site'=>array_values($site),//工地直播
	         'question'=>$questiondata,//问题
	         'answer'=>$answer,//回答
	         'collectstatus'=>$collectstatus,//是否收藏
	    	);
	      echo json_encode(array('code'=>1,'data'=>$data,'process_time'=>time()));
  }
  function Times($time){
        $time = (int) substr($time, 0, 10);
        $int = time() - $time;
        $str = '';
        if ($int <= 300){
            $str = sprintf('刚刚', $int);
        }elseif ($int < 3600){
            $str = sprintf('%d分钟前', floor($int / 60));
        }elseif ($int < 86400){
            $str = sprintf('%d小时前', floor($int / 3600));
        }elseif ($int < 2592000){
            $str = sprintf('%d天前', floor($int / 86400));
        }else{
           $str = date('Y-m-d', $time);
        }
        return $str;
  }
  function questionlst(){
	  	$db = load_class('db');
	    $uid=$GLOBALS['uid'];
	    if(empty($uid)){
	  		echo json_encode(array('code'=>0,'data'=>'问题id不能为空！','process_time'=>time()));
	  		die;
	  	}
	    $hk = $db->get_one('member_hk_data',"uid=$uid");
	    load_function('common','member');
	  	$questions=	$db->get_list('bang_answer',"uid=$uid",'qid');
	 	foreach ($questions as $qkey => $qvalue) {
	 		$qid[]=$qvalue['qid'];
	 	}
	 	 $qid=implode(',',$qid);
	 	 if(!empty($qid)){
		 	 $question=$db->get_list('bang_question',"id in ($qid)",'title,uid,id,qtime,uname,pv',0,2000,0,"id desc");
		 	 foreach ($question as $qu => $que) {
			 	 if(!empty($que[uid])){
		 	 		 $user=$db->get_one('member',"uid=$que[uid]",'avatar');
		 	     }
		 	     if(!empty($que[id])){
		 	     	 $ques=	$db->get_one('bang_answer',"qid=$que[id]",'laud');
		 	     	 $answer=$db->get_list('bang_answer',"qid=$que[id] and founder=0",'id');
		 	     }
		 	 	 $question[$qu]['sumanswer']=count($answer);
		         $question[$qu]['laud']=$ques['laud'];
		         $time= strtotime($que['qtime']);
		         $question[$qu]['Time']=$action=Times($time);
		         $question[$qu]['userp']=avatar($que['uid'],180);
		    	
		 	 }
	 	}
	 	 $data=array(
	          'question'=>$question,//问题
	          'gjname'=>$hk['gjname'],
		 	);
	 	 // echo '<pre>';print_r($data);exit;
	 	 echo json_encode(array('code'=>1,'data'=>$data,'process_time'=>time()));
  }
  function questionDetails(){
	  	$id=$GLOBALS['id'];
	  	if(empty($id)){
	  		echo json_encode(array('code'=>0,'data'=>'问题id不能为空！','process_time'=>time()));
	  		die;
	  	}
	  	$db = load_class('db');
	  	load_function('common','member');
	  	$Details=$db->get_list('bang_answer',"qid=$id",'id,content,founder,laud,atime,uid',0,2000,0,"id desc");
	  	$answers=	$db->get_list('bang_answer',"qid=$id and founder=0");
	  	$answer=array();
	  	$question=array();
	    $db->query("UPDATE wz_bang_question SET pv= pv+1 WHERE id=$id");
	    $quizdata=$db->get_one('bang_question',"id=$id",'title,uid,id,qtime,uname,pv');
	    if(!empty($quizdata[uid])){
	    	$user=$db->get_one('member',"uid=$quizdata[uid]",'avatar');
	    }
	    $t= strtotime($quizdata['qtime']);
	    $quizdata['Time']=$action=Times($t);
	    $quizdata['quizSum']=count($answers);
	    $quizdata['userp']=avatar($quizdata['uid'],180);
	    $quizdata['qtime']=$quizdata['qtime'];
	    foreach ($Details as $key => $value) {
	    	$hk = $db->get_one('member_hk_data',array('uid'=>$value[uid]));
	    	  $answer[$key]['id']=$value['id'];
	          $answer[$key]['gjname']=$hk['gjname'];//管家名称
	    	  $answer[$key]['founder']=$value['founder'];//是否为管家0 是
	          $answer[$key]['content']=$value['content'];//管家回答的内容
	          $answer[$key]['laud']=$value['laud'];//点赞数
	          $time= strtotime($value['atime']);
	          $answer[$key]['Time']=$action=Times($time);//回答时间
	          if($hk['personalphoto']){
	          $answer[$key]['headportrait']='http://www.uzhuang.com/image/pic_230/'.$hk['personalphoto'];//管家头像
	          }else{
	          $answer[$key]['headportrait']='http://m.uzhuang.com/res/img/guanjia.png';
	          }

	          $answer[$key][founder]=$value['founder'];
	    }
	    $data=array(
	          'quiz'=>$quizdata,
	          'answer'=>$answer,
	    	);
	    echo json_encode(array('code'=>1,'data'=>$data,'process_time'=>time()));
  }
  // 管家收藏
  function collect(){
  		$db = load_class('db');
  		$uid=get_cookie('_uid');
  	    if(!$uid)
  	    {
  	    	echo json_encode(array('code'=>0,'data'=>array('member'=>null),'message'=>L('login_please'),'process_time'=>time()));exit;
  	    }else
  	    {
  	    	// 收藏的管家id
  	    	$id=remove_xss($GLOBALS['id']);
	    	$r = $db->get_one('favorite', array('uid' => $uid,'type'=>14,'keyid'=>$id));
	        $mec_r = $db->get_one('member_hk_data',"`uid`=$id",'*');
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
	            $db->insert('favorite', $formdata);
	            echo json_encode(array('code'=>1,'data'=>array('collectstatus'=>1),'message'=>"收藏成功",'process_time'=>time()));exit;
	        }else
	        {
	            $db->delete('favorite', array('fid'=>$r['fid']));
	            echo json_encode(array('code'=>1,'data'=>array('collectstatus'=>0),'message'=>"取消收藏成功",'process_time'=>time()));exit;
	        }
  	    }
  }
// 点赞
 function laud(){
  		$db = load_class('db');
  	    // 回答id
  	    $id=remove_xss($GLOBALS['id']);
  	    $laud=$db->get_one('bang_answer',"`id`='".$id."'",'laud');
 	    if(remove_xss($GLOBALS['laudstatus'])==1){
  	    	$answer_laud=$laud['laud']+1;
	  	    if($db->update('bang_answer',array('laud'=>$answer_laud),array('id'=>$id))){
	  	    	echo json_encode(array('code'=>1,'data'=>array('answer_laud'=>$answer_laud),'message'=>"点赞成功",'process_time'=>time()));exit;
	  	    }else{
	  	    	echo json_encode(array('code'=>0,'data'=>null,'message'=>"点赞失败",'process_time'=>time()));exit;
	  	    }
 	    }else{
 	    	  if($laud['laud']==0){
 	    	  	$answer_laud=0;
 	    	  }else{
 	    		$answer_laud=$laud['laud']-1;
 	    	  }
 	    	  $db->update('bang_answer',array('laud'=>$answer_laud),array('id'=>$id));
	  	      echo json_encode(array('code'=>0,'data'=>array('answer_laud'=>$answer_laud),'message'=>"取消点赞",'process_time'=>time()));exit;
 	    }

  }