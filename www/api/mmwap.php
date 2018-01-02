<?php
/**
 * uzhuang 商城会员同步
 */
header('Content-type:text/html;charset=utf-8');
header("Access-Control-Allow-Origin: *");
define('WWW_ROOT',substr(dirname(__FILE__), 0, -4).'/');
require '../configs/web_config.php';
require COREFRAME_ROOT.'core.php';

$action = $GLOBALS['action'];
if($action=='fbform') {
    fbform();
} elseif($action=='fbcount') {
    fbcount();
}elseif($action=='fbcity'){
    fbcity();
}

function fbform() {
    $auth = get_cookie('auth');
    $auth_key = substr(md5(_KEY), 8, 8);
    list($uid, $password, $cookietime) = explode("\t", decode($auth, $auth_key));
    $db = load_class('db');
    // 加载发送短信类
    $sendMessage = load_class('sendmessage');

    if(!empty($uid)){
        $member_info = $db->get_list('member', "`uid`='$uid'", 'username,uid');
        $username = $member_info[0]['username'];
        $uid = $member_info[0]['uid'];
    }
    if(empty($GLOBALS['title'])) {
        send(false,null,'请填写联系人');
    }
    
    if(empty($GLOBALS['telephone'])) {
        send(false,null,'请填写电话');
    }
    if(empty($GLOBALS['areaid'])) {
        send(false,null,'请填写城市');
    }
    //-----------------------
    $lrsx=$GLOBALS['lrsx'];
    $lrsx_area=$GLOBALS['lrsx_area'];
    $lrsx_style=$GLOBALS['lrsx_style'];
    $lrjd=$GLOBALS['lrjd'];
    $remarksData=$action=remarks($lrsx,$lrsx_area,$lrsx_style,$lrjd);
     //-------------------
    if(!preg_match('/^(?:13\d{9}|15[0|1|2|3|5|6|7|8|9]\d{8}|17[0|1|2|3|5|6|7|8|9]\d{8}|19[9]\d{8}|18[0|1|2|3|5|6|7|8|9]\d{8}|14[5|7]\d{8})$/',$GLOBALS['telephone'])) {
         send(false,null,'电话号码填写错误');
        }
    $areanum=$GLOBALS['areanum'];
    $province = $db->get_one('linkage_data', "`lid`='".$GLOBALS['areaid']."'", 'lid,pid');
    $provinces = $db->get_one('linkage_data', "`lid`='".$province['pid']."'", 'lid');
    $telephone = remove_xss($GLOBALS['telephone']);
    $member = $db->get_one('member',array('mobile'=>$telephone));
    $formdata = array();
    $formdata['title'] = remove_xss($GLOBALS['title']);
    $formdata['telephone'] = remove_xss($GLOBALS['telephone']);
    $formdata['addtime'] = date('Y-m-d H:i:s',SYS_TIME);
    $formdata['source'] = remove_xss($GLOBALS['source']);
    $cid['cid_id'] = $GLOBALS['cid_id'];
    $cid['cid_city_id'] = $GLOBALS['cid_city_id'];
    $cid['cid_comp_id'] = $GLOBALS['cid_comp_id'];
    $cid['cid_act_id'] = $GLOBALS['cid_act_id'];

    $formdata['cid'] = 135;
    $formdata['status'] = 1;
    $formdata['areaid_1'] =$provinces['lid'] ;
    $formdata['areaid_2'] =remove_xss($GLOBALS['areaid']) ;
    $formdata['publisher'] = $username;
    $formdata['uid'] = $uid;
    $formdata['area'] = $areanum;
    $formdata['remarks'] = $remarksData;
    $data = $db->get_one('demand','telephone='.$formdata['telephone'],'addtime',0,'addtime desc');
    if(!empty($data['addtime']) && (strtotime($formdata['addtime'])-strtotime($data['addtime']))<12*3600){
        send(false,null,'您已成功报名过，12小时内只允许提交一次！');
    }
    if($GLOBALS['source']){
        $pat = '#^[-|\d]+$#';
        if (preg_match($pat, $formdata['source'])) {
            $formdata['source'] = explode('-', $formdata['source']);
            $source = implode(',', $formdata['source']);
            $mb_source = $db->get_list('channel', "`id` in (".$source.")", 'channelvalue');
            $arr = array();
            foreach ($mb_source as $v) {
                array_push($arr, $v['channelvalue']);
            }
            $formdata['source'] =implode('-', $arr);
        }
    }



    //渠道推广来源
    if(((int)$GLOBALS['cid_id']) > 0){


            $channid = explode('-',$cid['cid_id']);
            $channid =  implode(',', $channid);
            $mb_source = $db->get_list('channel', "`id` in (".$channid.")", 'channelvalue');
            $arr = array();
            $activity_id = $cid['cid_act_id'];
            $new_act = $db->get_one("m_newactivity",array('id'=>$activity_id),'sourceid,activityname');

            $exercise = $db->get_one("exercise",array('id'=>$new_act['sourceid']),'city');
            if($exercise['city'] == '全国'){

                $city_list = $db->get_one('linkage_data',array('lid'=>$cid['cid_city_id']),'name');
                $city = $city_list['name'] ? $city_list['name'] :'全国';

            }else{

                $city_config =  get_config('city_config');

                foreach ($city_config as $k=>$v){

                    $city1[$v['cityid']] = $v;
                }
                $city = $city1[$cid['cid_city_id']]['city'];

            }
            if(is_numeric($cid['cid_comp_id'])){
                $company = $db->get_one('company',array('id'=>$cid['cid_comp_id']),'title');

                $companyname = $company['title'];
            }

            foreach ($mb_source as $v) {
                array_push($arr, $v['channelvalue']);
            }
            $laiyuan = '';
            if($city){
                $laiyuan.= '-'.$city;
            }
            if($companyname){
                $laiyuan.= '-'.$companyname;
            }

            $formdata['source'] = 'M站活动'.'-'.$new_act['activityname'] . '-' .implode('-', $arr).$laiyuan;
          }

    if (strpos($_SERVER['HTTP_REFERER'], 'taocan') !== false && is_numeric($GLOBALS['source'])) {//报名入口为装修套餐   将报名人数加一
        $package_id = intval($GLOBALS['source']);
        $package_info = $db->get_one('block_product_detail',array('id'=>$package_id),'signup,company_id,title');
        $db->update('block_product_detail',array('signup'=>$package_info['signup']+1),array('id'=>$package_id));

        $source = 'M站-找装修-'.$package_info['title'];
        if (!$package_info['company_id']) {
            $source .= '（*该装修公司暂未合作）';
        }
        $formdata['source'] = $source;
    }
    $id = $db->insert('demand',$formdata);

    $order_no = '1'.str_pad($id,9,0,STR_PAD_LEFT);
    $db->update('demand',array('order_no'=>$order_no),array('id'=>$id));
    $d1 = date('Y-m-d',SYS_TIME).' 8:00:01';
    $d2 = date('Y-m-d',SYS_TIME).' 18:00:01';
    $d3 = date('Y-m-d',SYS_TIME).' 23:59:59';
    $d1 = strtotime($d1);
    $d2 = strtotime($d2);
    $d3 = strtotime($d3);
    // 发送短信
    // $send_sms = load_class('ym_sms' , 'sms');
    $msg = get_config('message_config');
    $msg = $msg['normal'];
    // $rs = $send_sms->send($GLOBALS['telephone'] , $msg);
    $res = $sendMessage->sendmessage($telephone,$msg);
    if(SYS_TIME<$d1) {
        send(true,null,'<span style=" color:#E07D1A;font-size: 22px;">报名成功！</span><br/><br/>您的装修申请已经提交，<br/>客服会在2小时内联系您,<br/>请您保持手机畅通！
');
    } elseif(SYS_TIME<$d2) {
        send(true,null,'<span style=" color:#E07D1A;font-size: 22px;">报名成功！</span><br/><br/>您的装修申请已经提交，<br/>客服会在2小时内联系您,<br/>请您保持手机畅通！
');
    } else {
        send(true,null,'<span style=" color:#E07D1A;font-size: 22px;">报名成功！</span><br/><br/>您的装修申请已经提交，<br/>客服会在2小时内联系您,<br/>请您保持手机畅通！
');
    }

}

function remarks($lrsx,$lrsx_area,$lrsx_style,$lrjd){
      $config=get_config('remark_config');
      $data=array();
      $data['lrsx']=$config['lrsx'][$lrsx];
      $data['lrsx_area']=$config['lrsx_area'][$lrsx_area];
      $data['lrsx_style']=$config['lrsx_style'][$lrsx_style];
      $data['lrjd']=$config['lrjd'][$lrjd];
      $remarksData=serialize($data);
      return $remarksData;
}
function fbcity(){
     $info=array( 
        array( 
        name=>'北京市',
        lib=>'3360',
        ) ,
        array( 
        name=>'天津市',
        lib=>'3362',
        ) ,
        array( 
        name=>'广州市',
        lib=>'326',
        ),
        array( 
        name=>'深圳市',
        lib=>'328',
        ),
        array( 
        name=>'上海市',
        lib=>'3361',
        ),
        array( 
        name=>'杭州市',
        lib=>'213',
        ),
        array( 
        name=>'西安市',
        lib=>'435',
        ),
        array( 
        name=>'南京市',
        lib=>'200',
       ),
       array(
        name=>'惠州市',
        lib=>'336',
      ),
       array(
        name=>'东莞市',
        lib=>'326',
      ),
        array(
        name=>'武汉市',
        lib=>'295',
      ),
        array(
        name=>'郑州市',
        lib=>'278',
      ),
        array(
        name=>'成都市',
        lib=>'382',
      ),
        array(
        name=>'青岛市',
        lib=>'262',
      ),
        array(
        name=>'大连市',
        lib=>'165',
       ),
     );
    send(true,$info,'获取城市信息成功');
}


function fbcount(){
    $db = load_class('db');
    $count = $db->count('demand');
    echo $count['num']+1000;
    exit;
}

function send($status,$data,$msg){
    if(!$status){
        $data =null;
    }

    $return_data = array(
        'flag' =>$status,
        'msg' => $msg,
        'data'=>$data,
        'time' => time(),
    );
    header('Content-Type:text/jcmd; charset=utf-8');
    echo  json_encode($return_data);
    exit;
}
