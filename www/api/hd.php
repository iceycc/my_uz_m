<?php
header('Content-type:text/html;charset=utf-8');
header("Access-Control-Allow-Origin: *");
define('WWW_ROOT', substr(dirname(__FILE__), 0, -4) . '/');
require '../configs/web_config.php';
require COREFRAME_ROOT . 'core.php';
$action = $GLOBALS['action'];
if ($action == 'fbform') {
    fbform();
} elseif ($action == 'fbcount') {
    fbcount();
}
function fbform()
{
    $db = load_class('db');
    $result = $db->get_one('m_exercise', "id=" . $GLOBALS['temp'], '*');
    if ($result['status_2'] == 1) {
        if (!empty($result['shipin'])) {
            $headpiece = explode('|', $result['headpiece']);
            $urlsx = explode('|', $result['headpieceurl']);
            $bian = explode('|', $result['bian']);
            $type1 = explode('|', $result['type1']);
            $type2 = explode('|', $result['type2']);
            $shipin = explode('|', $result['shipin']);
            $surl = explode('|', $result['shipinurl']);
            $spin = explode('|', $result['shipinbian']);
            $head = array_merge($headpiece, $shipin);
            $type = array_merge($type1, $type2);
            $headu = array_merge($urlsx, $surl);
            $headp = array_merge($bian, $spin);
        } else {
            $head = explode('|', $result['headpiece']);
            $headu = explode('|', $result['headpieceurl']);
            $headp = explode('|', $result['bian']);
            $type = explode('|', $result['type1']);
        }
    } else {
        $head = explode('|', $result['headpiece']);
        $headu = explode('|', $result['headpieceurl']);
        $headp = explode('|', $result['bian']);
        $type = explode('|', $result['type1']);
    }
    if ($result['status_2'] == 2) {
        if (!empty($result['shipin'])) {
            $troops = explode('|', $result['troops']);
            $troopsurl = explode('|', $result['troopsurl']);
            $type3 = explode('|', $result['type3']);
            $bians = explode('|', $result['bians']);
            $shipin = explode('|', $result['shipin']);
            $shipinurl = explode('|', $result['shipinurl']);
            $shipinbian = explode('|', $result['shipinbian']);
            $type2 = explode('|', $result['type2']);
            $troops = array_merge($troops, $shipin);
            $typ3 = array_merge($type3, $type2);
            $troopsurl = array_merge($troopsurl, $shipinurl);
            $bias = array_merge($bians, $shipinbian);
        } else {
            $troops = explode('|', $result['troops']);
            $troopsurl = explode('|', $result['troopsurl']);
            $typ3 = explode('|', $result['type3']);
            $bias = explode('|', $result['bians']);
        }
    } else {
        $troops = explode('|', $result['troops']);
        $troopsurl = explode('|', $result['troopsurl']);
        $typ3 = explode('|', $result['type3']);
        $bias = explode('|', $result['bians']);
    }
    $aRowid = $aTemp = array();
    foreach ($head as $key => $value) {
        $aTemp[$headp[$key]][] = array(
            'url' => getMImgShow($value, 'original'),
            'bian' => $headp[$key],
            'urlsx' => $headu[$key],
            'type' => $type[$key],
        );
    }
    ksort($aTemp, SORT_NUMERIC);
    foreach ($aTemp as $item) {
        foreach ($item as $citem) {
            $aRowid[] = $citem;
        }
    }
    foreach ($aRowid as $key => $Previe) {
        if ($Previe['url'] != '') {
            unset($aRowid[$key]['bian']);
        }
    }

    //顶部图片处理加视频连接
    $aRowids = $aTemps = array();
    foreach ($troops as $keys => $values) {
        $aTemps[$bias[$keys]][] = array(
            'url' => getMImgShow($values, 'original'),
            'bias' => $bias[$keys],
            'urlsh' => $troopsurl[$keys],
            'type' => $typ3[$keys],
        );
    }
    ksort($aTemps, SORT_NUMERIC);
    foreach ($aTemps as $items) {
        foreach ($items as $citems) {
            $aRowids[] = $citems;
        }
    }
    foreach ($aRowids as $ke => $Previes) {
        if ($Previes['url'] != '') {
            unset($aRowids[$ke]['bias']);
        }
    }
    if ($result['city'] == 1) {
        $info = array(
            array(
                "lid" => '3360',
                'name' => '北京市',
            ),
            array(
                "lid" => '3362',
                'name' => '天津市',
            ),
            array(
                "lid" => '328',
                'name' => '深圳市',
            ),
            array(
                "lid" => '326',
                'name' => '广州市',
            ),
            array(
                "lid" => '3361',
                'name' => '上海市',
            ),
            array(
                "lid" => '435',
                'name' => '西安市',
            ),
            array(
                "lid" => '213',
                'name' => '杭州市',
            ),
            array(
                "lid" => '200',
                'name' => '南京市',
            ),
            array(
                "lid" => '336',
                'name' => '惠州市',
            ),
            array(
                "lid" => '326',
                'name' => '东莞市',
            ),
            array(
                'name' => '武汉市',
                'lid' => '295',
            ),
            array(
                'name' => '郑州市',
                'lid' => '278',
            ),
            array(
                'name' => '成都市',
                'lid' => '382',
            ),
        );
        // $info=$db->get_list('linkage_data','kai="kai" and pid !=""',"lid,name");
    } else if ($result['city'] == 2) {
        $where = empty($city) ? 'pid in ("' . implode('","', array('2', '3', '4', '5', '34', '35', '0')) . '") and pid !=2 and pid !=3 and pid !=4 and pid !=5 and pid !=34 and pid !=35' : 'pid="' . $city . '"';
        $info = array();
        foreach ($db->get_list('linkage_data', $where, "lid,name") as $item) {
            $info[] = $item;
        }
    }
    $str = R;
    $newstr = substr($str, 0, strlen($str) - 5);
    $url = $newstr . '/mobile-template.html?temp=' . $result['id'];
    $data = array(
        'title' => $result['name'],
        'type' => $result['type'],//模板类型
        'button' => $result['button'],
        'status' => $result['status'],
        'city' => $result['city'],
        'status_4' => $result['status_4'],
        'color' => $result['color'],
        'color1' => $result['color1'],
        'color2' => $result['color2'],
        'color3' => $result['color3'],
        'background' => getMImgShow($result['background'], 'original'),
        'head' => $aRowid,
        'city1' => $info,
        'share' => $result['share'],//分享图标
        'sharename' => $result['sharename'],//分享标题
        'sharedescribe' => $result['sharedescribe'],//分享的描述
        'url' => $url,//分享的url
        'status_1' => $result['status_1'],//是否显示底部导航
        'advertising' => $result['advertising'],
        'isno' => $result['status_5'],
    );
    if ($result['type'] != 2) {
        $datas = array(
            'status_3' => $result['status_3'],//是否显示公共底
            'troops' => $aRowids,
        );

        $data = array_merge($data, $datas);

    }
    echo json_encode(array('code' => 1, 'data' => $data, 'process_time' => time()));
}

function fbcount()
{
    $auth = get_cookie('auth');
    $auth_key = substr(md5(_KEY), 8, 8);
    list($uid, $password, $cookietime) = explode("\t", decode($auth, $auth_key));
    $xUan = $GLOBALS['city'];
    $db = load_class('db');
    // 加载发送短信类
    $sendMessage = load_class('sendmessage');
    // $send_sms = load_class('ym_sms' , 'sms');
    $msg = get_config('message_config');
    $msg = $msg['normal'];

    if (!empty($uid)) {
        $member_info = $db->get_list('member', "`uid`='$uid'", 'username,uid');
        $username = $member_info[0]['username'];
        $uid = $member_info[0]['uid'];
    }
    if (empty($GLOBALS['title'])) {
        send(false, null, '请填写联系人');
    }
    if (empty($GLOBALS['telephone'])) {
        send(false, null, '请填写电话');
    }
    if ($xUan == 1) {
        if (empty($GLOBALS['areaid'])) {
            send(false, null, '请填写城市');
        }
    }
    if ($xUan == 2) {
        if (empty($GLOBALS['select'])) {
            send(false, null, '省份不能为空');
        }
        if (empty($GLOBALS['select_1'])) {
            send(false, null, '城区不能为空');
        }
    }
    if (!preg_match('/^(?:13\d{9}|15[0|1|2|3|5|6|7|8|9]\d{8}|17[0|1|2|3|5|6|7|8|9]\d{8}|19[9]\d{8}|18[0|1|2|3|5|6|7|8|9]\d{8}|14[5|7]\d{8})$/', $GLOBALS['telephone'])) {
        send(false, null, '电话号码填写错误');
    }
    if ($xUan == '1') {
        $province = $db->get_one('linkage_data', "`lid`='" . $GLOBALS['areaid'] . "'", 'lid,pid');
        $provinces = $db->get_one('linkage_data', "`lid`='" . $province['pid'] . "'", 'lid');
        $telephone = remove_xss($GLOBALS['telephone']);
        $member = $db->get_one('member', array('mobile' => $telephone));
        $formdata = array();
        $formdata['title'] = remove_xss($GLOBALS['title']);
        $formdata['telephone'] = remove_xss($GLOBALS['telephone']);
        $formdata['addtime'] = date('Y-m-d H:i:s', SYS_TIME);
        $formdata['source'] = remove_xss($GLOBALS['source']);




        $formdata['cid'] = 135;
        $formdata['status'] = 1;
        $formdata['areaid_1'] = $provinces['lid'];
        $formdata['areaid_2'] = remove_xss($GLOBALS['areaid']);
        $formdata['publisher'] = $username;
        $formdata['uid'] = $uid;
        $formdata['keywords'] = remove_xss($GLOBALS['activityid']);

        $pat = '#^[\w]+[-|\d]*$#';
        if (preg_match($pat, $formdata['source'])) {
            $formdata['source'] = explode('-', $formdata['source']);
            $first = array_shift($formdata['source']);
            $source = implode(',', $formdata['source']);
            $mb_source = $db->get_list('channel', "`id` in (".$source.")", 'channelvalue');
            $arr = array();
            $activity_id = $GLOBALS['act_id'];


            $new_act = $db->get_one("m_newactivity",array('id'=>$activity_id),'sourceid,activityname');

            $exercise = $db->get_one("exercise",array('id'=>$new_act['sourceid']),'city');


            if($exercise['city'] == '全国'){

                $city_list = $db->get_one('linkage_data',array('lid'=>$GLOBALS['city_id']),'name');
                $city = $city_list['name'] ? $city_list['name'] : '全国';

            }else{

                $city_config =  get_config('city_config');

                foreach ($city_config as $k=>$v){

                    $city1[$v['cityid']] = $v;
                }
                $city = $city1[$GLOBALS['city_id']]['city'];

            }

            if(is_numeric($GLOBALS['comp_id'])){

                $company = $db->get_one('company',array('id'=>$GLOBALS['comp_id']),'title');

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

            $formdata['source'] = $first.'-'.$new_act['activityname'] . '-' .implode('-', $arr).$laiyuan;


        }

        $data = $db->get_one('demand', 'telephone=' . $formdata['telephone'], 'addtime', 0, 'addtime desc');
        if (!empty($data['addtime']) && (strtotime($formdata['addtime']) - strtotime($data['addtime'])) < 12 * 3600) {
            send(false, null, '您已成功报名过，12小时内只允许提交一次！');
        }
        $id = $db->insert('demand', $formdata);
        // 发送短信
        $sendMessage->sendmessage($telephone, $msg);
        // $rs = $send_sms->send($GLOBALS['telephone'] , $msg);

        $order_no = '1' . str_pad($id, 9, 0, STR_PAD_LEFT);
        $db->update('demand', array('order_no' => $order_no), array('id' => $id));
    } else if ($xUan == '2') {
        $telephone = remove_xss($GLOBALS['telephone']);
        $member = $db->get_one('member', array('mobile' => $telephone));
        $formdata = array();
        $formdata['title'] = remove_xss($GLOBALS['title']);
        $formdata['telephone'] = remove_xss($GLOBALS['telephone']);
        $formdata['addtime'] = date('Y-m-d H:i:s', SYS_TIME);
        $formdata['source'] = remove_xss($GLOBALS['source']);
        $formdata['cid'] = 135;
        $formdata['status'] = 1;
        $formdata['areaid_1'] = remove_xss($GLOBALS['select']);
        $formdata['areaid_2'] = remove_xss($GLOBALS['select_1']);
        $data = $db->get_one('demand', 'telephone=' . $formdata['telephone'], 'addtime', 0, 'addtime desc');
        if (!empty($data['addtime']) && (strtotime($formdata['addtime']) - strtotime($data['addtime'])) < 12 * 3600) {
            send(false, null, '您已成功报名过，12小时内只允许提交一次！');
        }
        $pat = '#^[\w]+[-|\d]*$#';
        if (preg_match($pat, $formdata['source'])) {
            $formdata['source'] = explode('-', $formdata['source']);
            $first = array_shift($formdata['source']);
            $source = implode(',', $formdata['source']);
            $mb_source = $db->get_list('channel', "`id` in (".$source.")", 'channelvalue');
            $arr = array();
            foreach ($mb_source as $v) {
                array_push($arr, $v['channelvalue']);
            }
            $formdata['source'] = $first . '-' .implode('-', $arr);
        }
        $id = $db->insert('demand', $formdata, true);
        //发送短信
        $sendMessage->sendmessage($telephone, $msg);
        // $rs = $send_sms->send($GLOBALS['telephone'] , $msg);

        $order_no = '1' . str_pad($id, 9, 0, STR_PAD_LEFT);
        $db->update('demand', array('order_no' => $order_no), array('id' => $id));
    }
    $d1 = date('Y-m-d', SYS_TIME) . ' 8:00:01';
    $d2 = date('Y-m-d', SYS_TIME) . ' 18:00:01';
    $d3 = date('Y-m-d', SYS_TIME) . ' 23:59:59';
    $d1 = strtotime($d1);
    $d2 = strtotime($d2);
    $d3 = strtotime($d3);
    if ($xUan == 1) {
        $defaultnum = $GLOBALS['defaultnum'];
        if ($defaultnum == 1) {
            $snum = remove_xss($GLOBALS['areaid']);
        }
    }
    if ($xUan == 2) {
        $snum = 0;
    }
    if (SYS_TIME < $d1) {
        send(true, array('orderid' => $id), '<span style=" color:#E07D1A;font-size: 22px;">报名成功！</span><br/><br/>您的装修申请已经提交，<br/>客服会在2小时内联系您,<br/>请您保持手机畅通！
', $snum);
    } elseif (SYS_TIME < $d2) {
        send(true, array('orderid' => $id), '<span style=" color:#E07D1A;font-size: 22px;">报名成功！</span><br/><br/>您的装修申请已经提交，<br/>客服会在2小时内联系您,<br/>请您保持手机畅通！
', $snum);
    } else {
        send(true, array('orderid' => $id), '<span style=" color:#E07D1A;font-size: 22px;">报名成功！</span><br/><br/>您的装修申请已经提交，<br/>客服会在2小时内联系您,<br/>请您保持手机畅通！
', $snum);
    }
}

function send($status, $data, $msg, $snum)
{
    if (!$status) {
        $data = null;
    }
    $return_data = array(
        'flag' => $status,
        'msg' => $msg,
        'data' => $data,
        'defaultnum' => $snum,
        'time' => time(),
    );
    header('Content-Type:text/jcmd; charset=utf-8');
    echo json_encode($return_data);
    exit;
}