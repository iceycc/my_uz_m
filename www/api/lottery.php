<?php
/**
 * 716 活动抽奖注册
 */
header('Content-type:text/html;charset=utf-8');
header("Access-Control-Allow-Origin: *");
define('WWW_ROOT',substr(dirname(__FILE__), 0, -4).'/');
require '../configs/web_config.php';
require COREFRAME_ROOT.'core.php';

date_default_timezone_set('Asia/Shanghai');
$action = $GLOBALS['action'];
switch ($action) {
    case 'attend_prom':
        attend_prom();
        break;
    case 'lucky_prom':
        lucky_prom();
        break;
    case 'lucky_list':
        lucky_list();
        break;
    case 'lucky_draw':
        lucky_draw();
        break;
    case 'redirect':
        redirect();
        break;
}

/**
 * 报名API
 */
function attend_prom () {
    $name   = $GLOBALS['name'];
    $phone  = $GLOBALS['phone'];
    $city   = $GLOBALS['city'];
    $source = remove_xss($GLOBALS['source']);

    if (empty($name) || empty($phone)) {
        die(json_encode(array('errno'=>1, 'msg'=> '姓名或手机号不得为空！')));
    } else {
        $db = load_class('db');
        //姓名校验，最多允许20个英文或汉字，且为utf8编码
        if (mb_strlen($name) > 20) {
            die(json_encode(array('errno' => 1, 'msg' => '您的姓名过长')));
        } else {
            if (json_encode($name) == false) {
                die(json_encode(array('errno' => 1, 'msg' => '字符编码非UTF8.')));
            }
            $name = remove_xss($name);
        }

        //手机号校验
        $phone = is_string($phone) ? $phone : strval($phone);
        if ($phone{0} != 1) {
            $phone = substr($phone, strpos($phone, '86') + 2);//处理带国家码的手机号码
        }
        if(strpos($phone,'-')){
            $phone = implode(explode('-',$phone));//处理带有-的手机号
        }
        if (strlen($phone) != 11 || $phone{0} != 1 || is_numeric($phone) == false) {
            die(json_encode(array('errno' => 1, 'msg' => '您的手机号格式错误')));
        } else {
            $phone = remove_xss($phone);
            $start_luck = strtotime('3 Jul 2017');
            $end_luck = strtotime('16 Jul 2017');
            //查询手机号是否已报名
            $phone_db = $db->get_one('demand', 'telephone=\''.$phone.'\' AND UNIX_TIMESTAMP(addtime) BETWEEN '.$start_luck.' AND '.$end_luck, 'telephone,id');
            if ($phone == $phone_db['telephone']) {
                die(json_encode(array('errno' => 1, 'msg' => '您已成功报名过，12小时内只允许提交一次！','data'=>array('orderid'=>$phone_db['id']))));
            }
        }

        //城市名校验
        if(empty($city)){
            die(json_encode(array('errno' => 1, 'msg' => '城市名不得为空')));
        }
//        $citys = array('北京市', '天津市', '上海市', '广州市', '深圳市', '西安市', '武汉市', '杭州市', '大连市', '惠州市', '南京市', '成都市', '青岛市', '郑州市');
        if (!is_numeric($city)) {
            die(json_encode(array('errno' => 1, 'msg' => '城市代码错误')));
        }
        $city_db = $db->get_one('linkage_data', 'lid=' . $city, 'name,pid');
        if(empty($city_db)) {
            die(json_encode(array('errno' => 1, 'msg' => '该城市不存在')));
        }
//        if (!in_array($city_db['name'], $citys)) {
//            die(json_encode(array('errno' => 1, 'msg' => '该城市尚未参加本次活动')));
//        }

        $order = array(
            'title'     => addslashes($name),
            'cid'       => 135,
            'telephone' => addslashes($phone),
            'addtime'   => date('Y-m-d H:i:s',SYS_TIME),
            'source'    => addslashes($source),
            'areaid_1'  => addslashes($city_db['pid']),
            'areaid_2'  => addslashes($city)
        );
        $orderid = $db->insert('demand',$order,true);
        $order_no = '1'.str_pad($orderid,9,0,STR_PAD_LEFT);
        $db->update('demand',array('order_no'=>$order_no),array('id'=>$orderid));
        die(json_encode(array('errno' => 0, 'msg' => 'Success','data'=>array('orderid'=>$orderid))));
    }
}

/**
 * 抽奖报名API
 */
function lucky_prom() {
    $start_luck = strtotime('3 Jul 2017');
    $end_luck = strtotime('16 Jul 2017');
    if(time() > $end_luck || time() < $start_luck){
        die(json_encode(array('errno'=>1, 'msg'=>'活动已结束！')));
    }
    $orderid = $GLOBALS['order'];
    if(!is_numeric($orderid)){
        die(json_encode(array('errno'=>2, 'msg'=>'订单号格式错误')));
    }
    $db = load_class('db');
    $order = $db->get_one('demand', 'id='.$orderid, 'title,telephone,areaid_2,source');
    if(empty($order)) {
        die(json_encode(array('errno'=>1, 'msg'=>'您尚未报名，请在报名后参与抽奖')));
    }
    $luck = $db->get_one('lottery','orderid='.$orderid);
    if(!empty($luck)) {
        die(json_encode(array('errno'=>1, 'msg'=>'您已参加过抽奖，请耐心等待开奖结果')));
    }

    //写表操作
    $lottery = array(
        'name'      => addslashes($order['title']),
        'cellphone' => addslashes($order['telephone']),
        'city'      => addslashes($order['areaid_2']),
        'source'    => addslashes($order['source']),
        'orderid'   => addslashes($orderid)
    );
    $result = $db->insert('lottery',$lottery);
    if ($result == true) {
        die(json_encode(array('errno' => 0, 'msg' => 'Success')));
    }
}

/**
 * 抽奖结果滚动伪数据
 */
function lucky_list() {
    $luck_id   = $GLOBALS['id'];
    if(!is_numeric($luck_id)){
        die(json_encode(array('errno' => 1, 'msg' => 'id错误')));
    }
    $db = load_class('db');
    $info = $db->get_one('lottery', 'id='.$luck_id, 'city,awards');
    if(empty($info)){
        die(json_encode(array('errno' => 1, 'msg' => '很遗憾，您没有中奖')));
    }
    $lucky_name = array('张*','王*','王*芳','张*敏','王*英','艾*辉','白*春','郑*','李*杰','姚*','郭*亮','薛*飞','习*凯','来*','昌*','欧*娜','皇*龙','宇*都','都*','赵*欢','冯*楚','程*东','任*强','刘*峰','姜*涛','申*','孙*','谢*宇','秦*波','陈*','关*彤','杨*','倪*','韩*','董*鹏','柳*','严*','左*','牛*伟','孟*','高*萌','钟*','马*然','周*','钱*浩','柴*','常*松','崔*','殷*文','苏*');

    $lucky_number_prefix = array('130','131','132','155','156','185','186','176','175','135','136','137','138','139','150','151','152','157','158','159','182','183','184','187','188','133','153','180','181','189','177','173');
//    for($i=0;$i<50;++$i) {
//        $lucky_number_suffix[] = strval(mt_rand(1000,9999));
//    }
//    for($i=0;$i<50;++$i) {
//        $lucky_number[] = $lucky_number_prefix[array_rand($lucky_number_prefix)] . '****' . $lucky_number_suffix[array_rand($lucky_number_suffix)];
//    }
//    $lucky_map = array_combine($lucky_name,$lucky_number);

    $lucky_no = array('183****4206', '136****4954', '177****1496', '133****6418', '185****1405', '153****2412', '177****3814', '137****9074', '136****4203', '156****8245', '175****1009', '138****7478', '182****5911', '159****4979', '138****4903', '153****8917', '186****5911', '189****6899', '133****6412', '152****1009', '133****6412', '156****8673', '153****1496', '182****1037', '184****4203', '150****5159', '181****4291', '152****6899', '133****2163', '175****3392', '135****4979', '173****2495', '188****6252', '176****4954', '156****6317', '181****3232', '177****9701', '176****4979', '183****7381', '138****8673', '150****3232', '186****1037', '173****9936', '130****2024', '181****9936', '189****2163', '158****4291', '185****3392', '132****4206', '137****3402');
//    $lucky_map = array_combine($lucky_name,$lucky_no);
    $awards_list = array(
        0 => '装饰小红书1本',
        1 => '价值5168元优装管家服务',
        2 => '恒捷装饰保洁大礼包',
        3 => '精美冰裂茶具1套',
        4 => '家装e站1元抵200元装修抵用券',
        5 => '清和家居商城200元无门槛代金券',
        6 => '恒地装饰1000元抵2000元装修款抵用券',
        7 => 'A+国际装饰5折设计费优惠券',
        8 => '50元往返车费红包（免费预约量房，到店即赠）',
        9 => '袋熊装饰5折设计费优惠券',
        10 => '矩墨装饰5折设计费优惠券',
        11 => '尚正宅配3000元抵5000元装修款抵用券',
        12 => '梓桐装饰到店领取4L鲁花食用油一桶',
        13 => '百创装饰1000元工程抵用券',
        14 => '久居1000元工程抵用券',
        15 => '工匠大师装饰1000元抵用券',
        16 => '好宜家1000元装修抵用券',
    );
    $awards_city = array(
        '3360'=>array($awards_list[0],$awards_list[1],),
        '3362'=>array($awards_list[0],$awards_list[3],),
        '278'=>array($awards_list[0],$awards_list[2],),
        '295'=>array($awards_list[0],$awards_list[4],$awards_list[5],),
        '165'=>array($awards_list[0],$awards_list[6],),
        '3361'=>array($awards_list[0],$awards_list[7],),
        '382'=>array($awards_list[0],$awards_list[8],),
        '326'=>array($awards_list[0],$awards_list[1],),
        '200'=>array($awards_list[0],$awards_list[9],$awards_list[10],),
        '262'=>array($awards_list[0],$awards_list[11],),
        '435'=>array($awards_list[0],$awards_list[12],),
        '328'=>array($awards_list[0],$awards_list[13],$awards_list[14],),
        '336'=>array($awards_list[0],$awards_list[15],$awards_list[16],),
        '342'=>array($awards_list[0],$awards_list[13],),
    );

    $awds = array('装饰小红书1本', '装饰小红书1本', '价值5168元优装管家服务', '装饰小红书1本', '价值5168元优装管家服务', '价值5168元优装管家服务', '价值5168元优装管家服务', '装饰小红书1本', '价值5168元优装管家服务', '价值5168元优装管家服务', '装饰小红书1本', '装饰小红书1本', '装饰小红书1本', '装饰小红书1本', '价值5168元优装管家服务', '价值5168元优装管家服务', '价值5168元优装管家服务', '装饰小红书1本', '装饰小红书1本', '价值5168元优装管家服务', '价值5168元优装管家服务', '装饰小红书1本', '价值5168元优装管家服务', '装饰小红书1本', '价值5168元优装管家服务', '价值5168元优装管家服务', '装饰小红书1本', '价值5168元优装管家服务', '装饰小红书1本', '装饰小红书1本', '价值5168元优装管家服务', '装饰小红书1本', '价值5168元优装管家服务', '装饰小红书1本', '价值5168元优装管家服务', '价值5168元优装管家服务', '价值5168元优装管家服务', '价值5168元优装管家服务', '装饰小红书1本', '装饰小红书1本', '价值5168元优装管家服务', '装饰小红书1本', '装饰小红书1本', '装饰小红书1本', '装饰小红书1本', '价值5168元优装管家服务', '装饰小红书1本', '价值5168元优装管家服务', '价值5168元优装管家服务', '装饰小红书1本');
    $data['award'] = $info['awards'];
    for($i=0;$i<50;$i++){
        $name = $lucky_name[$i];
        $pm = $lucky_no[$i];
        $awd = $awds[$i];
        $data['list'][] = array(
            'name' => $name,
            'award' => $awd,
            'number' => $pm
        );
    }

    die(json_encode($data));

//    foreach($lucky_map as $k=>$v){
//        $data['list'][] = array(
//            'name'   => $k,
//           'award'  => $awards_city[$info['city']][mt_rand(0,count($awards_city[$info['city']])-1)],
//            'number' => $v
//        );
//    }
}

/**
 * 抽奖脚本
 */
function lucky_draw() {
    //奖品数量
    define('BOOK' ,100);
    define('OIL' , 20);
    define('TEASET' , 20);

    $awards_list = array(
        0 => '装饰小红书1本',
        1 => '价值5168元优装管家服务',
        2 => '恒捷装饰保洁大礼包',
        3 => '精美冰裂茶具1套',
        4 => '家装e站1元抵200元装修抵用券',
        5 => '清和家居商城200元无门槛代金券',
        6 => '恒地装饰1000元抵2000元装修款抵用券',
        7 => 'A+国际装饰5折设计费优惠券',
        8 => '50元往返车费红包（免费预约量房，到店即赠）',
        9 => '袋熊装饰5折设计费优惠券',
        10 => '矩墨装饰5折设计费优惠券',
        11 => '尚正宅配3000元抵5000元装修款抵用券',
        12 => '梓桐装饰到店领取4L鲁花食用油一桶',
        13 => '百创装饰1000元工程抵用券',
        14 => '久居1000元工程抵用券',
        15 => '工匠大师装饰1000元抵用券',
        16 => '好宜家1000元装修抵用券',
    );

    $awards_city = array(
        '3360'=>array(
            $awards_list[0],
            $awards_list[1],
        ),
        '3362'=>array(
            $awards_list[0],
            $awards_list[3],
        ),
        '278'=>array(
            $awards_list[0],
            $awards_list[2],
        ),
        '295'=>array(
            $awards_list[0],
            $awards_list[4],
            $awards_list[5],
        ),
        '165'=>array(
            $awards_list[0],
            $awards_list[6],
        ),
        '3361'=>array(
            $awards_list[0],
            $awards_list[7],
        ),
        '382'=>array(
            $awards_list[0],
            $awards_list[8],
        ),
        '326'=>array(
            $awards_list[0],
            $awards_list[1],
        ),
        '200'=>array(
            $awards_list[0],
            $awards_list[9],
            $awards_list[10],
        ),
        '262'=>array(
            $awards_list[0],
            $awards_list[11],
        ),
        '435'=>array(
            $awards_list[0],
            $awards_list[12],
        ),
        '328'=>array(
            $awards_list[0],
            $awards_list[13],
            $awards_list[14],
        ),
        '336'=>array(
            $awards_list[0],
            $awards_list[15],
            $awards_list[16],
        ),
        '342'=>array(
            $awards_list[0],
            $awards_list[13],
        ),
    );
    $book_count = $oil_count =$tea_count = 0;
    $db = load_class('db');
    $result = $db->query('select max(id) as maxid from wz_lottery');
    $max = $result->fetch_assoc();
    $max_id = $max['maxid'];

    for($i=1;$i<=$max_id;++$i){
        $city = $db->get_one('lottery','id='.$i,'city');
        //去除已被抽完的奖品
        if($book_count > BOOK){
            foreach($awards_city as $ct) {
                array_shift($ct);
            }
        } elseif($oil_count > OIL) {
           array_pop($awards_city['3362']);
        } elseif($tea_count > TEA) {
            array_pop($awards_city['435']);
        }
        //抽奖
        $key = array_rand($awards_city[$city['city']], 1);

        $user_award = $awards_city[$city['city']][$key];

        //统计限量的奖品数量
        if(strpos($user_award,'书'))
            ++$book_count;
        if(strpos($user_award,'油'))
            ++$oil_count;
        if(strpos($user_award,'茶'))
            ++$tea_count;
        $db->update('lottery',array('awards'=>$user_award),'id='.$i);
    }
    die('completed');
}

function redirect(){
    $luck_id   = $GLOBALS['id'];
    header("Location: http://m.uzhuang.com/mobile-temp_prize.html?id=".$luck_id);
}

