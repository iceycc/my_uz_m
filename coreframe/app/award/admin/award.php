<?php
defined('IN_WZ') or exit('No direct script access allowed');
load_class('admin');

class award extends WUZHI_admin
{
    private $db;

    function __construct()
    {
        $this->db = load_class('db');
    }

    public function lst()
    {
        include $this->template('award_manage');
    }

    public function left()
    {
        include $this->template('award_left');
    }

    public function setting()
    {
        $r = $this->db->get_one('award_banner', 'id = 1');
        $content = json_decode($r['content']);
        $data = array();
        if ($content) {
            foreach ($content as $key => $va) {
                foreach ($va as $k => $v) {
                    $data[$k][$key] = $v;
                }
            }
        }
        include $this->template('award_set');
    }

    public function bannerAdd()
    {
        $arr['content'] = json_encode($GLOBALS['form']['banner']);
        $r = $this->db->get_one('award_banner');
        if ($r['id'] == 1)
            $this->db->update('award_banner', $arr, array('id' => '1'));
        else
            $this->db->insert('award_banner', $arr);
    }

    public function drawAdd()
    {
        $draw = $GLOBALS['draw'];
        $data = array();
        foreach ($draw as $key => $va) {
            foreach ($va as $k => $v) {
                $data[$k][$key] = $v;
            }
        }
        foreach ($data as $key => $va) {
            $arr['mobile'] = $va['mobile'];
            $arr['money'] = $va['money'];
            $arr['header'] = $va['header'];
            if (!empty($arr['mobile']))
                $this->db->insert('award_draw', $arr);
        }
    }

    public function drawlst()
    {
        $rs['data'] = $this->db->get_list('award_draw');
        $pages = $this->db->pages;
        // $total = $this->db->number;
        die(json_encode($rs));
    }

    public function drawdel()
    {
        $id = $GLOBALS['id'];
        $this->db->delete('award_draw', array('id' => $id));
    }

    public function deposit()
    {
        $page = isset($GLOBALS['page']) ? intval($GLOBALS['page']) : 1;
        $status = isset($GLOBALS['status']) ? intval($GLOBALS['status']) : '9';
        $mobile = isset($GLOBALS['title']) ? $GLOBALS['title'] : '';
        $attribute = isset($GLOBALS['attribute']) ? $GLOBALS['attribute'] : '';
        $dai_num = $this->db->count('award_money', 'status = 0');
        $dai_num = $dai_num['num'];
        $yes_num = $this->db->count('award_money', 'status = 1');
        $yes_num = $yes_num['num'];
        $no_num = $this->db->count('award_money', 'status = 2');
        $no_num = $no_num['num'];
        $page = max($page, 1);
        if ($status != 9)
            $where = 'status =' . $status;
        if (!empty($mobile))
            $where = $this->search($mobile);
        $res = $this->db->get_list('award_money', $where, '*', 0, 10, $page, 'id desc');
        if($attribute==1 || $attribute==2){
            foreach ($res as $k1 => $v1) {
               $tmp= $this->db->get_one('award_user', "uid ='".$v1['uid']."' and attribute='".$attribute."'");
               $res[$k1] = array_merge($res[$k1],$tmp);
            }
            $res=array_filter($res);
        }
        foreach ($res as $key => $va) {
            $r = $this->db->get_one('award_user', array('uid' => $va['uid']));
            $res[$key]['mobile'] = $r['mobile'];
            $res[$key]['icode'] = $r['icode'];
            $res[$key]['status'] = $this->check_status($va['status']);
            $res[$key]['operator'] = !empty($va['operator']) ? $va['operator'] : '暂无';
            $res[$key]['nocheck'] = $va['status'] != 0 ? 'nocheck' : '';
            $res[$key]['attribute'] = $r['attribute'] == 1 ? '社会人士' : '优装美家';

            // caozhi add begin
            // 提现审核列表新增用户姓名、银行、支行等列
            $bank_info = $this->get_bank_info($va['uid']);
            $res[$key]['username'] = $bank_info['name'] ? $bank_info['name'] : '暂无';
            // caozhi add end
        }
        //echo "<pre>";print_r($res);exit;
        $pages = $this->db->pages;
        // $total = $this->db->number;
        include $this->template('award_deposit');
    }

    // 根据用户id获取银行卡信息  caozhi add begin
    public function get_bank_info($uid)
    {
        $bank_info = $this->db->get_one('award_bank_card', array('uid' => $uid));
        return $bank_info;
    }

    // caozhi add end
    public function details()
    {
        $uid = $GLOBALS['uid'];
        $page = isset($GLOBALS['page']) ? intval($GLOBALS['page']) : 1;
        $status = !empty($GLOBALS['status']) ? $GLOBALS['status'] : 1;
        $arr = $this->db->get_one('award_user', 'uid =' . $uid);
        $bank = $this->db->get_list('award_bank_card', 'uid =' . $uid, 'id_number,bank_name,bank_number');
        $extract = $this->db->get_list('award_money', 'uid =' . $uid, '*', 0, 10, $page);
        $pages = $this->db->pages;
        $total = $this->db->number;
        $extract_sum = 0;
        foreach ($extract as $key => $va) {
            if ($va['money_status'] == 1)
                $extract_sum++;
        }
        if ($status == 1) {
            foreach ($extract as $key => $va) {
                $extract[$key]['status'] = $this->check_status($va['status']);
                $extract[$key]['money_status'] = $this->money_status($va['money_status']);
                $extract[$key]['pay_time'] = !empty($va['paytime']) ? date('Y-m-d H:i:s', $va['paytime']) : '暂无';
                $extract[$key]['operator'] = !empty($va['operator']) ? $va['operator'] : '暂无';
                $extract[$key]['nocheck'] = $va['status'] != 0 ? 'nocheck' : '';
            }
        } else if ($status == 2) {
            $demand_code = $this->db->get_list('award_demand_code', "uid = $uid and money > 50");
            $pages = $this->db->pages;
            $total = $this->db->number;
            $code_status = array('否', '是');
            $win = 0;
            foreach ($demand_code as $key => $va) {
                if (!empty($va['order_id'])) {
                    $orderStatus = $this->db->get_one('award_nodestatus', 'orderid=' . $va['order_id'], 'status,status_reason', 0, 'id desc');
                    $demand = $this->db->get_one('demand', 'id =' . $va['order_id'], 'address,area,budget,housekeeperid,title,telephone');
                    $demand_code[$key]['address'] = $demand['address'];
                    $demand_code[$key]['nickname'] = $demand['title'];
                    $demand_code[$key]['mobile'] = $demand['telephone'];
                    $demand_code[$key]['area'] = $demand['area'];
                    $demand_code[$key]['budget'] = $demand['budget'];
                    $xiaoStatus = $this->orderStatus();
                    if ($orderStatus['status'] == 5) {
                        $orderMoney = $this->db->get_one('award_demand_code', 'order_id =' . $va['order_id'] . ' and money > 50', 'money');
                        $demand_code[$key]['orderStatus'] = $xiaoStatus[$orderStatus['status']] . $orderMoney['money'] . '鼓励金';
                    } else {
                        $demand_code[$key]['orderStatus'] = $xiaoStatus[$orderStatus['status']] . $orderStatus['status_reason'];
                    }
                }
                if (!empty($demand['housekeeperid'])) {
                    $hk = $this->db->get_one('member_hk_data', 'uid =' . $demand['housekeeperid'], 'gjname');
                    $demand_code[$key]['gjname'] = $hk['gjname'];
                }
                $demand_code[$key]['status'] = $code_status[$va['status']];
                if ($va['status'] == 1)
                    $win++;
            }
            $userData = $this->db->get_one('award_user', 'uid =' . $uid, 'nickname');
        } else if ($status == 3) {
            $fcode = $arr['icode'] ? $this->db->get_list('award_user', 'rcode =' . $arr['icode']) : array();
            $pages = $this->db->pages;
            $total = $this->db->number;
            $yroom = 0;
            foreach ($fcode as $key => $va) {
                $room = $this->fcode($va['uid']);
                $fcode[$key]['codesum'] = $room['codesum'];
                $fcode[$key]['ycode'] = $room['ycode'];
                $yroom += $room['ycode'];
            }
        }
        $id_number = '';
        $bank_manage = array();
        foreach ($bank as $key => $va) {
            $id_number = $va['id_number'];
            $bank_manage[] = $va['bank_name'] . $va['bank_number'];
            $bank_sum = $key + 1;
        }
        $arr['extract_sum'] = $extract_sum;
        $arr['id_number'] = $id_number;
        $arr['bank_manage'] = $bank_manage;
        $arr['bank_sum'] = $bank_sum;
        if ($GLOBALS['tmp'] == 2)
            include $this->template('user_fdetails');
        else
            include $this->template('award_details');
    }

    // 群发短信  caozhi add begin
    public function mass_SMS()
    {
        // 获取自动群发的内容
        $auto_send_message_info = $this->get_auto_message_info();
        // 手动群发短信的内容
        $manual_send_message_info = $this->get_manual_message_info();
        include $this->template('send_message');
    }

    // 获取自动群发的内容
    protected function get_auto_message_info()
    {
        $data = $this->db->get_list('award_send_message', array('message_type' => 0));
        return $data;
    }

    // 获取人工群发的内容
    protected function get_manual_message_info()
    {
        $data = $this->db->get_one('award_send_message', array('message_type' => 1));
        return $data;
    }

    // 启用/禁用短信息
    public function change_message_satate()
    {
        $id = $GLOBALS['id'];
        $this->db->update('award_send_message', array('in_use' => $GLOBALS['state']), array('id' => $id));
    }

    // 编辑短信内容
    public function edit_message_content()
    {
        $id = $GLOBALS['id'];
        $content = trim($GLOBALS['content'], '。');
        $content = $content . '。回复N退订。';//短信内容
        $this->db->update('award_send_message', array('message_content' => $content), array('id' => $id));
    }

    // 人工群发短信
    public function send_messages()
    {
        $phones = $GLOBALS['phones'];
        $phones = implode(',', array_unique(explode(',', trim($phones, ','))));
        // 加载发送短信类
        $sendMessage = load_class('sendmessage');
        // 获取群发的内容
        $message = $this->db->get_one('award_send_message', array('message_type' => 1), 'message_content');
        $message_content = $message['message_content'];
        // 发送短信    结果格式类似  00,F003233140527170802
        $send_result = $sendMessage->sendmessage($phones, $message_content);
        // 获取发送结果
        $result_code = explode(',', $send_result);
        $code = $result_code[0];
        if ($code == '00') {
            die(json_encode(array('code' => '00', 'message' => '发送成功')));
        } else if ($code == '02') {
            die(json_encode(array('code' => '02', 'message' => 'IP限制')));
        } else if ($code == '03') {
            // die(json_encode(array('code'=>'03','message'=>'单个手机号请求发送成功')));
        } else if ($code == '04') {
            die(json_encode(array('code' => '04', 'message' => '用户名错误')));
        } else if ($code == '05') {
            die(json_encode(array('code' => '05', 'message' => '密码错误')));
        } else if ($code == '06') {
            die(json_encode(array('code' => '06', 'message' => '编码错误')));
        }
    }

    //读取excel $filename 路径文件名 $encode 返回数据的编码 默认为utf8
    public function read($filename, $encode = 'utf-8')
    {
        // 引用php上传类文件
        require_once COREFRAME_ROOT . 'extend/class/PHPExcel.php';
        require_once COREFRAME_ROOT . 'extend/class/PHPExcel/IOFactory.php';
        require_once COREFRAME_ROOT . 'extend/class/PHPExcel/Reader/Excel5.php';
        $objReader = PHPExcel_IOFactory::createReader('Excel5');//use excel2007 for 2007 format
        //这里有问题
        $objPHPExcel = $objReader->load($filename); //$filename可以是上传的文件，或者是指定的文件
        $sheet = $objPHPExcel->getSheet(0);
        $highestRow = $sheet->getHighestRow(); // 取得总行数
        $sheetData = $objPHPExcel->getSheet(0)->toArray(null, true, true, true);
        return $sheetData;
    }

    // 从Excel表格批量导入手机号
    public function batch_import_phone()
    {
        if (empty($_FILES['phones']['name'])) {
            MSG('请选择要导入的文件！', HTTP_REFERER);
        } else {
            // 获取页面中已经存在的手机号
            $exist_phones = trim($GLOBALS['phones'], ',');
            $phones_from_page = $exist_phones ? explode(",", $exist_phones) : array();

            $tmp_file = $_FILES['phones']['tmp_name'];
            $file_types = explode(".", $_FILES['phones']['name']);
            $file_type = $file_types[count($file_types) - 1];
            /*判别是不是.xls文件，判别是不是excel文件*/
            if (strtolower($file_type) != "xls") {
                MSG('不是excel文件，请重新上传！', HTTP_REFERER);
            }
            // 读取Excel表格的内容
            $excel_data = $this->read($tmp_file);
            // excel表中的手机个数  因为有表头所以减一
            $raw_phone_count = count($excel_data) - 1 + count($phones_from_page);
            // 校验手机号是否合法
            $phones = array();
            $phone_grep = '/1\d{10}$/';
            foreach ($excel_data as $key => $phone) {
                if (preg_match($phone_grep, trim($phone['A']))) {
                    $phones[] = trim($phone['A']);
                }
            }
            $intersect_res = array_intersect($phones, $phones_from_page);//获取页面中传过来的手机号和Excel表格的交集
            $intersect_count = count($intersect_res);//页面中传过来的手机号的和Excel表格的交集的数量

            // 将页面的手机号和Excel表格的手机号合并
            if ($phones_from_page) {
                $phones = array_merge($phones_from_page, $phones);
            }

            // 合法的手机个数
            $legal_phone_count = count($phones);
            // 不合法手机个数
            $unlegal_phone_count = $raw_phone_count - $legal_phone_count;
            // 去掉重复的手机号
            $new_phones = array_values(array_unique($phones));
            $new_phones_count = count($new_phones);
            // 重复的手机个数
            $repeated_phone_count = $intersect_count ? $intersect_count : ($legal_phone_count - $new_phones_count);
            // 开始构造表格
            $row = 1;
            $tr_str = '<tr row="' . $row . '" class="phones-line">';
            $tr_num = 1;
            foreach ($new_phones as $key => $phone) {
                $tr_str .= '<td style="padding:8px;" class="cell-td">
                      <span style="display:block;">
                        <span class="inline-span checkbox-span"><input type="checkbox" class="checkbox-left check-tel" index="' . ($key % 4) . '" name="" id=""></span>
                        <span class="inline-span no-span" style="text-align:center;">' . ($key + 1) . '</span>
                        <span class="inline-span telephone-span send-message-phone" style="text-align: center;">' . $phone . '</span>
                      </span>
                    </td>';
                if (($key + 1) % 4 == 0) {
                    if ($tr_num > 9) {
                        $show_tr = 'style="display:none;"';
                    } else {
                        $show_tr = '';
                    }
                    $row = floor(($key + 1) / 40) + 1;
                    $tr_str .= '</tr><tr row="' . $row . '" class="phones-line" ' . $show_tr . '>';
                    $tr_num++;
                }
            }
            $tr_str .= '</tr>';
            if ($row > 1) {
                $pages = '<div id="phone-pages"><div class=""><a href="javascript:;" class="page-num layui-laypage-prev">上一页</a>';
                for ($i = 1; $i <= $row; $i++) {
                    $a_class = $i == 1 ? 'active' : '';
                    $pages .= '<a href="javascript:;" class="page-num ' . $a_class . '">' . $i . '</a>';
                }
                $pages .= '<a href="javascript:;" class="page-num layui-laypage-next">下一页</a></div></div>';
            }
            // 获取自动群发的内容
            $auto_send_message_info = $this->get_auto_message_info();
            // 手动群发短信的内容
            $manual_send_message_info = $this->get_manual_message_info();
            include $this->template('send_message');
        }
    }

    // caozhi add end

    public function finance()
    {
        $mobile = isset($GLOBALS['title']) ? $GLOBALS['title'] : '';
        $status = isset($GLOBALS['status']) ? intval($GLOBALS['status']) : '9';
        $page = isset($GLOBALS['page']) ? intval($GLOBALS['page']) : 1;
        $attribute = isset($GLOBALS['attribute']) ? $GLOBALS['attribute'] : '';
        $processed = $this->db->count('award_money', 'money_status != 0 and status=1');
        $processed = $processed['num'];
        $untreated = $this->db->count('award_money', 'money_status = 0 and status=1');
        $untreated = $untreated['num'];
        if ($status != 9)
            $where = $status == 0 ? "money_status = 0 and " : "money_status != 0 and ";
        if (!empty($mobile))
            $where = $this->search($mobile) . ' and ';
        $res = $this->db->get_list('award_money', $where . 'status = 1', '*');

        if($attribute==1 || $attribute==2){
            foreach ($res as $k1 => $v1) {
               $tmp= $this->db->get_one('award_user', "uid ='".$v1['uid']."' and attribute='".$attribute."'");
               $res[$k1] = array_merge($res[$k1],$tmp);
            }
            $res=array_filter($res);
        }
        foreach ($res as $key => $va) {
            $id_number = $this->db->get_one('award_bank_card', 'uid =' . $va['uid'], 'id_number,name');
            $user = $this->db->get_one('award_user', 'uid =' . $va['uid']);
            $res[$key]['name'] = $user['nickname'];
            $res[$key]['mobile'] = $user['mobile'];

            $res[$key]['attribute'] = $user['attribute'] == 1 ? '社会人士' : '优装美家';

            $res[$key]['money_status'] = $this->money_status($va['money_status']);
            $res[$key]['money_status_num'] = $va['money_status'];
            $res[$key]['payer'] = !empty($va['payer']) ? $va['payer'] : '暂无';
            $res[$key]['nocheck'] = $va['money_status'] != 0 ? 'nocheck' : '';
            $res[$key]['id_number'] = $id_number['id_number'];
            // caozhi add begin
            // 财务打款管理列表页新增【姓名】列
            $res[$key]['username'] = $id_number['name'] ? $id_number['name'] : '暂无';
            // caozhi add end
        }
        $pages = $this->db->pages;
        $total = $this->db->number;
        include $this->template('award_finance');
    }

    private function fcode($uid)
    {
        $demand_code = $this->db->get_list('award_demand_code', "uid ={$uid}");
        $y_code = $this->db->get_list('award_demand_code', "uid ={$uid} and money > 50 and status = 1");
        $arr['codesum'] = count($demand_code);
        $arr['ycode'] = count($y_code);
        return $arr;
    }

    private function search($mobile)
    {
        $r = $this->db->get_list('award_user', "mobile like '%$mobile%' OR icode like '%$mobile%'", 'uid');
        $arr = array();
        foreach ($r as $v) {
            $arr[] = $v['uid'];
        }
        return !empty($arr) ? "uid in(" . implode(',', $arr) . ")" : 'uid in (0)';
    }

    private function check_status($sta)
    {
        $status = array('待审核', '审核通过', '审核不通过');
        return $status[$sta];
    }

    private function money_status($sta)
    {
        $status = array('提取中', '提取成功', '提取失败');
        return $status[$sta];
    }

    public function deposit_status()
    {
        $id = $GLOBALS['id'];
        $arr['operator'] = get_cookie('username');
        $arr['status'] = 1;
        if ($this->db->update('award_money', $arr, array('id' => $id))) {
            $data['operator'] = get_cookie('username');
            $data['status'] = $this->check_status($arr['status']);
            die(json_encode(array('status' => 1, 'data' => $data)));
        }
    }

    public function deposit_status_no()
    {
        $id = $GLOBALS['id'];
        $money = $this->db->get_one('award_money', 'id=' . $id, 'money,uid');
        $this->db->query("UPDATE wz_award_user  SET cumulative_money = cumulative_money + $money[money] WHERE uid = $money[uid]");
        $arr['operator'] = get_cookie('username');
        $arr['reason'] = $GLOBALS['remark'];
        $arr['status'] = 2;
        $arr['money_status'] = 2;
        if ($this->db->update('award_money', $arr, array('id' => $id))) {
            $data['operator'] = get_cookie('username');
            $data['remark'] = $arr['reason'];
            $data['status'] = $this->check_status($arr['status']);
            die(json_encode(array('status' => 1, 'data' => $data)));
        }
    }

    public function get_money_status()
    {
        $id = $GLOBALS['id'];
        $uid = $GLOBALS['uid'];
        $money = $GLOBALS['money'];
        $arr['payer'] = get_cookie('username');
        $arr['money_status'] = 1;
        $arr['pay_reason'] = $GLOBALS['remark'];
        $arr['paytime'] = time();
        if ($this->db->update('award_money', $arr, array('id' => $id))) {
            $this->db->query("UPDATE wz_award_user  SET extract_money= extract_money + $money WHERE uid = $uid");

            // 装修推荐返现  提现成功时发送短信
            $message_info = $this->db->get_one('award_send_message', array('node_no' => 4, 'in_use' => 1), 'message_content');
            if ($message_info && $message_info['message_content']) {
                // 加载发送短信类
                $sendMessage = load_class('sendmessage');
                // 获取短信内容
                $message_content = $message_info['message_content'];
                // 获取手机号
                $get_mobile = $this->db->get_one('award_user', array('uid' => $uid), 'mobile');
                $mobile = $get_mobile['mobile'];
                // 发送短信
                $send_result = $sendMessage->sendmessage($mobile, $message_content);
            }
            $data['payer'] = get_cookie('username');
            $data['status'] = $this->money_status($arr['money_status']);
            die(json_encode(array('status' => 1, 'data' => $data)));
        }
    }

    public function get_money_status_no()
    {
        $id = $GLOBALS['id'];
        $money = $this->db->get_one('award_money', 'id=' . $id, 'money,uid');
        $this->db->query("UPDATE wz_award_user  SET cumulative_money = cumulative_money + $money[money] WHERE uid = $money[uid]");
        $arr['payer'] = get_cookie('username');
        $arr['money_status'] = 2;
        $arr['pay_reason'] = $GLOBALS['remark'];
        $arr['paytime'] = time();
        if ($this->db->update('award_money', $arr, array('id' => $id))) {
            $data['payer'] = get_cookie('username');
            $data['remark'] = $arr['pay_reason'];
            $data['status'] = $this->money_status($arr['money_status']);
            die(json_encode(array('status' => 1, 'data' => $data)));
        }
    }

    public function prints()
    {
        $ids = implode(',', $GLOBALS['ids']);
        $field = 'uid,stream_no,id_number,bank_number,bank_name,branch,money,payer,paytime,operator';
        $arr = $this->db->get_list('award_money', "id in ($ids)", $field);
        foreach ($arr as $k => $v) {
            $id_number = $this->db->get_one('award_bank_card', 'uid =' . $v['uid'], 'id_number,name');
            $u = $this->db->get_one('award_user', 'uid =' . $v['uid'], 'nickname');
            $arr[$k]['name'] = $u['nickname'];
            $arr[$k]['attribute'] = $u['attribute'] == 1 ? '社会人士' : '优装美家';
            $arr[$k]['bank'] = $v['bank_name'] . $v['branch'];
            $arr[$k]['pay_time'] = !empty($v['paytime']) ? date('Y-m-d H:i:s', $v['paytime']) : '暂无';
            $arr[$k]['pay_reason'] = !empty($v['payer']) ? $v['payer'] : '暂无';
            $arr[$k]['id_number'] = $id_number['id_number'];
        }
        die(json_encode(array('status' => 1, 'data' => $arr)));
    }

    public function orderStatus()
    {
        return $orderStatus = array('1' => '成功提交，等待客服联系中', '2' => '审核失败，原因:', '3' => '审核成功，预约量房失败，原因：', '4' => '审核成功，已预约量房，等待量房', '5' => '装修管家已成功量房，您获得', '6' => '装修管家上门量房失败，原因：');
    }

    /*
     5-2  添加市场管理模块
     */
    public function bazaar()
    {
        $citys = $this->dredge_city();
        $start = date("Y-m-d 00:00:00");
        $end = date("Y-m-d H:i:s");
        $monthstart = date('Y-m-d 00:00:00', strtotime(date('Y-m')));

        /**************************今日*****************************/
        // 获取今天用户注册量
        $today_regist_num = $this->get_regist_num('today', 0);
        // 获取今日新增推荐
        $today = $this->db->count('award_demand_code', "money > 50 and addtime between '$start' and '$end'");
        // 获取今日预约量房
        $subscribe = $this->db->count('award_nodestatus', 'nodeid =10 and addtime between ' . strtotime($start) . ' and ' . strtotime($end));
        // 获取今日上门量房
        $visit = $this->db->count('award_nodestatus', 'nodeid =11 and addtime between ' . strtotime($start) . ' and ' . strtotime($end));
        // 获取今日签到三方合同
        $compact = $this->db->count('award_nodestatus', 'nodeid=19 and addtime between ' . strtotime($start) . ' and ' . strtotime($end));
        /**************************本月*****************************/
        // 获取本月用户注册量
        $month_regist_num = $this->get_regist_num('month', 0);
        // 获取本月新增推荐
        $month = $this->db->count('award_demand_code', "money > 50 and addtime between '$monthstart' and '$end'");
        // 获取本月预约量房
        $subscribem = $this->db->count('award_nodestatus', 'nodeid =10 and addtime between ' . strtotime($monthstart) . ' and ' . strtotime($end));
        // 获取本月上门量房
        $visitm = $this->db->count('award_nodestatus', 'nodeid =11 and addtime between ' . strtotime($monthstart) . ' and ' . strtotime($end));
        // 获取本月签到三方合同
        $compact_m = $this->db->count('award_nodestatus', 'nodeid=19 and addtime between ' . strtotime($monthstart) . ' and ' . strtotime($end));

        /*************************全部******************************/
        // 获取全部总注册量
        $regist_num = $this->get_regist_num('all', 0);
        // 获取全部新增推荐
        $count = $this->db->count('award_demand_code', 'money > 50');
        // 获取全部预约量房
        $subscribes = $this->db->query("SELECT * FROM `wz_award_nodestatus` where nodeid = 10 GROUP BY orderid");
        while ($data = $this->db->fetch_array($subscribes)) {
            $subscribec[] = $data;
        }
        // 获取全部上门量房
        $visits = $this->db->query("SELECT * FROM `wz_award_nodestatus` where nodeid = 11 GROUP BY orderid");
        while ($data = $this->db->fetch_array($visits)) {
            $visitc[] = $data;
        }
        // 获取本月签到三方合同
        $compacti = $this->db->query("SELECT * FROM `wz_award_nodestatus` where nodeid = 19 GROUP BY orderid");
        while ($data = $this->db->fetch_array($compacti)) {
            $compact_n[] = $data;
        }

        $page = isset($GLOBALS['page']) ? intval($GLOBALS['page']) : 1;
        $search = isset($GLOBALS['search']) ? intval($GLOBALS['search']) : '';
        $searchWord = $GLOBALS['searchWord'];
        $begin_time = $GLOBALS['begin_time'];//查询开始时间
        $end_time = $GLOBALS['end_time'];//查询结束时间
        $tui = $GLOBALS['tui'];
        //echo "<pre>";print_r($tui);exit;
        $attribute = $GLOBALS['attribute'];
        //$city = $GLOBALS['city'];
        if ($begin_time && $end_time) {
            $demand_info = $this->searchWord($begin_time, $end_time, $searchWord, $tui, $page, $attribute);
            $res = $demand_info['res'];
        }
        $pagess = $demand_info['pages'];
        $totals = count($res);
        $icode = $res[0]['icode'];
        if ($icode)
            $icodes_info = $this->icodes($icode, $begin_time, $end_time);
        $icodes = $icodes_info['arr2'];
        $pages = $this->db->pages;
        $total = count($icodes);
        //echo "<pre>";print_r($arr);exit;
        /*// 量房成功数
        $success_amount_room_num = $demand_info['success_amount_room_num'];
        // 好友注册数
        $friend_regist_num = $icodes_info['friend_regist_num'];
        // 好友推荐数
        $friend_recommend_num = $total;
        // 好友成功量房数
        $friend_success_amount_num = $icodes_info['friend_success_amount_num'];*/
        include $this->template('award_bazaar');
    }

    // 获取用户注册数
    public function get_regist_num($search_type, $cityid)
    {
        $where = 1;
        if ($cityid) {
            $where .= " and cityid = {$cityid}";
        }
        if ($search_type == 'today') {
            $start_time = date('Y-m-d', time()) . ' 00:00:00';
            $end_time = date('Y-m-d G:i:s', time());
        } else if ($search_type == 'month') {
            $start_time = date('Y-m', time()) . '-01 00:00:00';
            $end_time = date('Y-m-d G:i:s', time());
        }
        // 注册开始时间
        if (!empty($start_time)) {
            $where .= " and addtime>'{$start_time}'";
        }
        // 注册结束时间
        if (!empty($end_time)) {
            $where .= " and addtime<'{$end_time}'";
        }
        // 查询注册数量
        $regist_num = $this->db->count('award_user', $where);
        return $regist_num;
    }

    //根据icode获取好友数量
    public function get_friend_num($icode)
    {
        $use = $this->db->get_list('award_user', 'rcode="' . $icode . '"');
        return count($use) ? count($use) : 0;
    }

    //好友成功量房数量
    public function get_success_friend_num($icode)
    {
        $use = $this->db->get_list('award_user', 'rcode="' . $icode . '"');
        $count = 0;
        foreach ($use as $k => $v) {
            $count += $this->get_success_room_num($v['uid']);
        }
        return $count ? $count : 0;
    }

    //根据uid获取推荐量房成功数
    public function get_success_room_num($uid)
    {
        $code = $this->db->get_list('award_demand_code', '(uid="' . $uid . '" and money >50 and status=1 )');
        return count($code) ? count($code) : 0;
    }

    //根据uid获得量房数目
    public function get_room_num($uid)
    {
        $code = $this->db->get_list('award_demand_code', 'uid="' . $uid . '"and money > 50');
        return count($code) ? count($code) : 0;
    }

    //根据icode获取好友推荐量房数
    public function get_friend_room_num($icode)
    {
        $use = $this->db->get_list('award_user', 'rcode="' . $icode . '"');
        $count = 0;
        foreach ($use as $k => $v) {
            $count += $this->get_room_num($v['uid']);
        }
        return $count ? $count : 0;
    }


    private function dredge_city()
    {
        return array(
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
                'name' => '广州',
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
                'name' => '惠州',
            ),
            array(
                "lid" => '342',
                'name' => '东莞市',
            ),
            array(
                'name' => '武汉',
                'lid' => '295',
            ),
            array(
                'name' => '郑州',
                'lid' => '278',
            ),
            array(
                'name' => '成都',
                'lid' => '382',
            )
        );
    }

    public function city_search()
    {
        $start = date("Y-m-d 00:00:00");
        $end = date("Y-m-d H:i:s");
        $monthstart = date('Y-m-d 00:00:00', strtotime(date('Y-m')));
        $code = $this->db->count('award_demand_code');
        $nodestatus = $this->db->count('award_nodestatus');
        $codes = $this->db->get_list('award_demand_code', $where, 'order_id', 0, $code['num']);
        $today = $this->db->get_list('award_demand_code', "money > 50 and    addtime between '$start' and '$end'", 'order_id', 0, $code['num']);

        $stoday = $this->db->get_list('award_nodestatus', 'nodeid =10 and addtime between ' . strtotime($start) . ' and ' . strtotime($end), 'orderid', 0, $nodestatus['num']);
        $svisit = $this->db->get_list('award_nodestatus', 'nodeid =11 and addtime between ' . strtotime($start) . ' and ' . strtotime($end), 'orderid', 0, $nodestatus['num']);
        $visitm = $this->db->get_list('award_nodestatus', 'nodeid =11 and addtime between ' . strtotime($monthstart) . ' and ' . strtotime($end), 'orderid', 0, $nodestatus['num']);

        $subscribem = $this->db->get_list('award_nodestatus', 'nodeid =10 and addtime between ' . strtotime($monthstart) . ' and ' . strtotime($end), 'orderid', 0, $nodestatus['num']);
        $month = $this->db->get_list('award_demand_code', "money > 50 and addtime between '$monthstart' and '$end'", 'order_id', 0, $code['num']);
        $subscribe = $this->db->get_list('award_nodestatus', 'nodeid = 10', 'orderid', 0, $nodestatus['num']);
        $visit = $this->db->get_list('award_nodestatus', 'nodeid = 11', 'orderid', 0, $nodestatus['num']);

        foreach ($today as $k => $v) {
            $city = $this->db->get_one('demand', 'id = ' . $v['order_id'], 'areaid_2');
            $h[$v['order_id']] = empty($city['areaid_2']) ? '1' : $city['areaid_2'];
            $arr2['today'] = array_count_values($h);
        }
        foreach ($month as $k => $v) {
            $city = $this->db->get_one('demand', 'id = ' . $v['order_id'], 'areaid_2');
            $hh[$v['order_id']] = empty($city['areaid_2']) ? '1' : $city['areaid_2'];
            $arr2['month'] = array_count_values($hh);
        }
        foreach ($stoday as $k => $v) {
            $city = $this->db->get_one('demand', 'id = ' . $v['orderid'], 'areaid_2');
            $xx[$v['orderid']] = empty($city['areaid_2']) ? '1' : $city['areaid_2'];
            $arr2['stoday'] = array_count_values($xx);
        }
        foreach ($visitm as $k => $v) {
            $city = $this->db->get_one('demand', 'id = ' . $v['orderid'], 'areaid_2');
            $ss[$v['orderid']] = empty($city['areaid_2']) ? '1' : $city['areaid_2'];
            $arr2['visitm'] = array_count_values($ss);
        }
        foreach ($subscribem as $k => $v) {
            $city = $this->db->get_one('demand', 'id = ' . $v['orderid'], 'areaid_2');
            $yy[$v['orderid']] = empty($city['areaid_2']) ? '1' : $city['areaid_2'];
            $arr2['subscribem'] = array_count_values($yy);
        }
        foreach ($svisit as $k => $v) {
            $city = $this->db->get_one('demand', 'id = ' . $v['orderid'], 'areaid_2');
            $mm[$v['orderid']] = empty($city['areaid_2']) ? '1' : $city['areaid_2'];
            $arr2['svisit'] = array_count_values($mm);
        }
        foreach ($codes as $k => $v) {
            $city = $this->db->get_one('demand', 'id = ' . $v['order_id'], 'areaid_2');
            $arr[$v['order_id']] = empty($city['areaid_2']) ? '1' : $city['areaid_2'];
            $arr2['code'] = array_count_values($arr);
        }
        foreach ($subscribe as $k => $v) {
            $city = $this->db->get_one('demand', 'id = ' . $v['orderid'], 'areaid_2');
            $res[$v['orderid']] = empty($city['areaid_2']) ? '1' : $city['areaid_2'];
            $arr2['subscribe'] = array_count_values($res);
        }
        foreach ($visit as $k => $v) {
            $city = $this->db->get_one('demand', 'id = ' . $v['orderid'], 'areaid_2');
            $data[$v['orderid']] = empty($city['areaid_2']) ? '1' : $city['areaid_2'];
            $arr2['visit'] = array_count_values($data);
        }

        if (!empty($GLOBALS['cityid'])) {
            $aa = empty($arr2['code'][$GLOBALS['cityid']]) ? 0 : $arr2['code'][$GLOBALS['cityid']];//新增推荐
            $bb = empty($arr2['subscribe'][$GLOBALS['cityid']]) ? 0 : $arr2['subscribe'][$GLOBALS['cityid']];
            $cc = empty($arr2['visit'][$GLOBALS['cityid']]) ? 0 : $arr2['visit'][$GLOBALS['cityid']];
            $dd = empty($arr2['today'][$GLOBALS['cityid']]) ? 0 : $arr2['today'][$GLOBALS['cityid']];
            $ee = empty($arr2['month'][$GLOBALS['cityid']]) ? 0 : $arr2['month'][$GLOBALS['cityid']];
            $ff = empty($arr2['stoday'][$GLOBALS['cityid']]) ? 0 : $arr2['stoday'][$GLOBALS['cityid']];
            $gg = empty($arr2['svisit'][$GLOBALS['cityid']]) ? 0 : $arr2['svisit'][$GLOBALS['cityid']];
            $hh = empty($arr2['subscribem'][$GLOBALS['cityid']]) ? 0 : $arr2['subscribem'][$GLOBALS['cityid']];
            $ii = empty($arr2['visitm'][$GLOBALS['cityid']]) ? 0 : $arr2['visitm'][$GLOBALS['cityid']];
            // caozhi add begin  获取城市的用户注册量
            $cityid = $GLOBALS['cityid'];
            // 获取今天用户注册量
            $today_regist_num = $this->get_regist_num('today', $cityid);
            // 获取本月用户注册量
            $month_regist_num = $this->get_regist_num('month', $cityid);
            // 获取总注册量
            $regist_num = $this->get_regist_num('all', $cityid);
            $arr1['today_regist_num'] = $today_regist_num['num'];
            $arr1['month_regist_num'] = $month_regist_num['num'];
            $arr1['regist_num'] = $regist_num['num'];
            // caozhi add end
        }
        $arr1['aa'] = $aa;//新增推荐
        $arr1['bb'] = $bb;
        $arr1['cc'] = $cc;
        $arr1['dd'] = $dd;
        $arr1['ee'] = $ee;
        $arr1['ff'] = $ff;
        $arr1['gg'] = $gg;
        $arr1['hh'] = $hh;
        $arr1['ii'] = $ii;
        die(json_encode(array('status' => 1, 'data' => $arr1)));
        return $arr2;
    }

    public function icode()
    {
        $icode = $GLOBALS['icode'];
        die(json_encode(array('status' => 1, 'data' => $this->icodes($icode))));
    }

    public function icodes($icode = "", $begin_time, $end_time)
    {
        $res = $this->db->get_list('award_user', 'rcode =' . $icode);
        $arr2 = array();
        // 好友成功量房数
        $friend_success_amount_num = 0;
        foreach ($res as $k => $v) {
            $where = 'money > 50 and uid =' . $v['uid'];
            if ($begin_time) {
                $where .= " and addtime>='{$begin_time}'";
            }
            if ($end_time) {
                $where .= " and addtime<='{$end_time}'";
            }
            $arr = $this->db->get_list('award_demand_code', $where);
            if (!empty($arr)) {
                foreach ($arr as $ke => $va) {
                    $data = array();
                    $data['orderid'] = $va['order_id'];
                    $data['addtime'] = $va['addtime'];
                    $orderStatus = $this->db->get_one('award_nodestatus', 'orderid=' . $va['order_id'], 'status,status_reason', 0, 'id desc');
                    $xiaoStatus = $this->orderStatus();
                    if ($orderStatus['status'] == 5) {
                        $friend_success_amount_num++;
                        $orderMoney = $this->db->get_one('award_demand_code', 'order_id =' . $va['order_id'] . ' and money > 50', 'money');
                        $data['orderStatus'] = $xiaoStatus[$orderStatus['status']] . $orderMoney['money'] . '鼓励金';
                    } else {
                        $data['orderStatus'] = $xiaoStatus[$orderStatus['status']] . $orderStatus['status_reason'];
                    }
                    $data['status_reason'] = $orderStatus['status_reason'];
                    $data['mobile'] = $v['mobile'];
                    $data['icode'] = $v['icode'];
                    $arr2[] = $data;
                }
            }
        }
        // 好友注册数
        $where1 = 'rcode=' . $icode;
        if ($begin_time) {
            $where1 .= " and addtime>='{$begin_time}'";
        }
        if ($end_time) {
            $where1 .= " and addtime<='{$end_time}'";
        }
        $friend_regist_num = $this->db->count('award_user', $where1);
        $data['friend_regist_num'] = $friend_regist_num['num'];
        $data['friend_success_amount_num'] = $friend_success_amount_num;
        $data['arr2'] = $arr2;
        return $data;
    }

    public function time_search()
    {
        if ($GLOBALS['time_begin'] && $GLOBALS['time_end']) {
            $time_begin = $GLOBALS['time_begin'];
            $time_end = $GLOBALS['time_end'];
            $ress = $this->db->get_list('award_user',"addtime between '".$time_begin."' and '".$time_end."'", 'uid,icode,mobile,attribute',0,1000000);
            foreach ($ress as $k3 => $v3) {
                $ae[] = $v3['uid'];
                $ar[] = $v3['icode'];
            }
            $uid_status = implode(',',$ae);
            if($uid_status){
            $icodes_status = implode(',',$ar);
            $todays = $this->db->count('award_demand_code', "uid in (".$uid_status.") and money > 50");
            //$visitcs = $this->db->count('award_nodestatus', 'nodeid =11 and addtime between ' . strtotime($time_begin) . ' and ' . strtotime($time_end));
            $res = $this->db->get_list('award_demand_code','uid in ('.$uid_status.') and status=1','*',0,100000,'','','','order_id');
            $visitcs =count($res);
            }
            $subscribecs = $this->db->count('award_nodestatus', 'nodeid =10 and addtime between ' . strtotime($time_begin) . ' and ' . strtotime($time_end));
            $compact = $this->db->count('award_nodestatus', 'nodeid =19 and addtime between ' . strtotime($time_begin) . ' and ' . strtotime($time_end));
            $arr['a'] = $todays['num'];
            $arr['b'] = $visitcs;
            $arr['c'] = $subscribecs['num'];
            $arr['d'] = $compact['num'];
            $where = "addtime is not null and addtime>='{$time_begin}' and addtime<='{$time_end}'";
            if ($GLOBALS['cityid']) {
                $where .= " and cityid={$GLOBALS['cityid']}";
            }
            $register_num = $this->db->count('award_user', $where);
            $arr['register_num'] = $register_num['num'];
            die(json_encode(array('status' => 1, 'data' => $arr)));
        }
    }

    public function searchWord($begin_time, $end_time, $searchWord, $tui, $page, $attribute)
    {
        $xiao = array('1' => 'mobile', '2' => 'icode');
        $s = $xiao[$tui];
        if ($begin_time) {
            $where = "addtime>='{$begin_time}'";
        }
        if ($end_time) {
            $where .= " and addtime<='{$end_time}'";
        }
        if ($searchWord) {
            $r = $this->db->get_list('award_user', "$xiao[$tui] = $searchWord", 'uid');
            $arr = array();
            foreach ($r as $v) {
                $arr[] = $v['uid'];
            }
            $xid = !empty($arr) ? "uid in(" . implode(',', $arr) . ")" : 'uid in (-1)';
            $where .= ' and ' . $xid;
        }
        if ($attribute) {
            $where .= " and attribute={$attribute}";
        }
        $res = $this->db->get_list('award_user', $where, 'uid,icode,mobile,attribute', 0, 10, $page, 'addtime desc');
        $pages = $this->db->pages;
        $ress = $this->db->get_list('award_user', $where, 'uid,icode,mobile,attribute',0,1000000);
        if($res){
            foreach ($res as $key => $value) {
                $ar =array();
                //推荐次数
                $cou = $this->db->get_list('award_demand_code', 'uid="' . $value['uid'] . '" and money > 50 ');
                $res[$key]['recommend_num'] = count($cou);
                //推荐量房成功数
                $code = $this->db->get_list('award_demand_code', 'uid="' . $value['uid'] . '" and status=1');
                $res[$key]['success_room_num'] = count($code);
                //推荐三方合同数
                $cods = $this->db->get_list('award_demand_code', 'uid="' . $value['uid'] . '"');
                foreach ($cods as $k0 => $v0) {
                    $ar[] =$v0['order_id'];
                }
                $res[$key]['ar_orderid'] = implode(',',$ar);
                //res[$key]['contract_num'] = $this->db->get_list('demand_track',"orderid in (".$ar_orderid.") and nodeid=19");
                //$co_array[$key] = $cods;
                //$res[$key]['contract_num'] = count($cods);
                //推荐好友注册数
                $use = $this->db->get_list('award_user', 'rcode="' . $value['icode'] . '"');
                $res[$key]['register_num'] = count($use);
            }   
            foreach ($res as $k1 => $v1) {
                if($v1['ar_orderid']){
                $contract = $this->db->get_list('demand_track',"orderid in (".$v1['ar_orderid'].") and nodeid=19");
                $res[$k1]['contract_num'] = count($contract);
                }
                $set = $this->db->get_one('award_user', 'rcode="' . $v1['icode'] . '"', 'uid');
                $res[$k1]['useid'] = $set['uid'];
            }
            foreach ($res as $k2 => $v2) {
                //好友成功量房数
                if($v2['useid']){
                $code1 = $this->db->get_list('award_demand_code', 'uid="' . $v2['useid'] . '" and status=1');
                }
                $res[$k2]['friend_success_num'] = count($code1);
            }
            foreach ($ress as $k3 => $v3) {
                $ae[] = $v3['uid'];
                $ar[] = $v3['icode'];
            }
        }
        $uid_status = implode(',',$ae);
        if($uid_status){
        $icodes_status = implode(',',$ar);
        //推荐总次数
        $code = $this->db->get_list('award_demand_code', 'uid in ('.$uid_status.') and money > 50','*',0,100000,'','','','order_id');
        $data['recommend_num'] = count($code);
        //推荐总量房成功数
        $code1 = $this->db->get_list('award_demand_code','uid in ('.$uid_status.') and status=1','*',0,100000,'','','','order_id');
        $data['success_room_num'] = count($code1);
        //推荐总三方合同数
        $code2 = $this->db->get_list('award_demand_code','uid in ('.$uid_status.') and contract_status=1','*',0,100000,'','','','order_id');
        $data['contract_num'] = count($code2);
        }
        //推荐总好友注册数
        $code3 = $this->db->get_list('award_user',$where.' and rcode is not null','*',0,100000,'');
        $data['register_num'] = count($code3);
        //推荐总好友成功量房数
        if($icodes_status){
        $code4 = $this->db->get_list('award_user',$where.' and rcode in ('.$icodes_status.')','uid',0,100000,'');
        foreach ($code4 as $k4 => $v4) {
            $aa[] =$v4['uid']; 
        }
        $uids = implode(',',$aa);
        if($uids){
        $code5 = $this->db->get_list('award_demand_code','uid in ('.$uids.') and status=1','*',0,100000,'','','','order_id');
        }
        $data['friend_success_num'] = count($code5);
        }
        $data['pages'] = $pages;
        $data['res'] = array_values($res);
        return $data;
    }

    //导出
    function export_csv()
    {
        $filename = '推荐装修返现';
        $applyid = $GLOBALS['applyid'];
        $where = '(' . implode(',', $applyid) . ')';
        $res = $this->db->get_list('award_money', "stream_no in $where");
        foreach ($res as $key => $va) {
            $r = $this->db->get_one('award_user', array('uid' => $va['uid']));
            $res[$key]['mobile'] = $r['mobile'];
            $res[$key]['icode'] = $r['icode'];
            $res[$key]['status'] = $this->check_status($va['status']);
            $res[$key]['operator'] = !empty($va['operator']) ? $va['operator'] : '暂无';
            $res[$key]['nocheck'] = $va['status'] != 0 ? 'nocheck' : '';
            $res[$key]['attribute'] = $r['attribute'] == 1 ? '社会人士' : '优装美家';

            // caozhi add begin
            // 提现审核列表新增用户姓名、银行、支行等列
            $bank_info = $this->get_bank_info($va['uid']);
            $res[$key]['username'] = $bank_info['name'] ? $bank_info['name'] : '暂无';
            // caozhi add end
        }

        //组织打印数据
        $print = array();
        foreach ($res as $k => $v) {
            $print[$k]['stream_no'] = $v['stream_no'];
            $print[$k]['icode'] = $v['icode'];
            $print[$k]['attribute'] = $v['attribute'];
            $print[$k]['username'] = $v['username'];
            $print[$k]['mobile'] = $v['mobile'];
            $print[$k]['money'] = $v['money'];
            $print[$k]['addtime'] = date('Y-m-d H:i :s', $v['addtime']);
            $print[$k]['status'] = $v['status'];
            $print[$k]['operator'] = $v['operator'];
            $print[$k]['bank_name'] = $v['bank_name'];
            $print[$k]['branch'] = $v['branch'];
            $print[$k]['reason'] = $v['reason'];
        }
        $cell_field = array('', 'A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z', 'AA', 'AB', 'AC', 'AD', 'AE', 'AF', 'AG', 'AH');

        require_once COREFRAME_ROOT . 'extend/class/PHPExcel.php';

        // Create new PHPExcel object
        $objPHPExcel = new PHPExcel();
        // Set document properties
        $objPHPExcel->getProperties()->setCreator("uzhuang.com")
            ->setLastModifiedBy("uzhuang.com")
            ->setTitle("uzhuang")
            ->setSubject("uzhuang Document")
            ->setDescription("uzhuang")
            ->setKeywords("uzhuang")
            ->setCategory("Test result file");
        // Add some data
        $i = 1;

        $fields = array('序号', '邀请码', '属性', '用户姓名', '电话', '提现金额', '申请时间', '状态', '审核人', '银行', '支行', '备注');
        foreach ($fields as $field => $rs) {
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue($cell_field[$i] . '1', $rs);
            $i++;
        }

        $j = 2;
        foreach ($print as $key => $val) {
            $i = 1;
            foreach ($val as $k => $v) {
                $objPHPExcel->setActiveSheetIndex(0)->setCellValue($cell_field[$i++] . $j, $v);
            }
            $j++;
        }

        //exit;
        // Rename worksheet
        $objPHPExcel->getActiveSheet()->setTitle('优装美家');
        // Set active sheet index to the first sheet, so Excel opens this as the first sheet
        $objPHPExcel->setActiveSheetIndex(0);
        // Redirect output to a client’s web browser (Excel5)
        ob_end_clean();
        header('Content-Type: application/vnd.ms-excel');
        header("Content-Disposition: attachment;filename='{$filename}.xls'");
        header('Cache-Control: max-age=0');
        // If you're serving to IE 9, then the following may be needed
        header('Cache-Control: max-age=1');
        // If you're serving to IE over SSL, then the following may be needed
        header('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
        header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT'); // always modified
        header('Cache-Control: cache, must-revalidate'); // HTTP/1.1
        header('Pragma: public'); // HTTP/1.0
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
        $objWriter->save('php://output');
    }

    public function userinfo()
    {
        $uid = $GLOBALS['id'];
        $page = isset($GLOBALS['page']) ? intval($GLOBALS['page']) : 1;
        $status = !empty($GLOBALS['status']) ? $GLOBALS['status'] : 2;
        $arr = $this->db->get_one('award_user', 'uid =' . $uid);

        //推荐量房成功数
        $arr['success_room_num'] = $this->get_success_room_num($arr['uid']);
//        var_dump( $arr['success_room_num']);die();

        //推荐量房数量
        $arr['room_num'] = $this->get_room_num($arr['uid']);

        //推荐好友注册数
        $arr['register_num'] = $this->get_friend_num($arr['icode']);

        //好友量房成功数
        $arr['friend_success_num'] = $this->get_success_friend_num($arr['icode']);

        //好友推荐数
        $arr['friend_room_num'] = $this->get_friend_room_num($arr['icode']);
        //签订三方合同数
        $contract = $this->db->get_list('award_demand_code','uid="'.$arr['uid'].'"');
        if($contract){
            foreach ($contract as $k1 => $v1) {
                $ar[] = $v1['order_id'];
            }
            $order_id = implode(',',$ar);
            $res1 = $this->db->get_list('demand_track',"nodeid=19 and orderid in (".$order_id.")",'orderid');
            $arr['contract_num'] = count($res1);
        }
        $bank = $this->db->get_list('award_bank_card', 'uid =' . $uid, 'id_number,bank_name,bank_number');
        $extract = $this->db->get_list('award_money', 'uid =' . $uid, '*', 0, 10, $page);
        $pages = $this->db->pages;
        $total = $this->db->number;
        $extract_sum = 0;
        foreach ($extract as $key => $va) {
            if ($va['money_status'] == 1)
                $extract_sum++;
        }
        if ($status == 2) {
            $demand_code = $this->db->get_list('award_demand_code', "uid = $uid and money > 50");
            $pages = $this->db->pages;
            $total = $this->db->number;
            $code_status = array('否', '是');
            $win = 0;
            foreach ($demand_code as $key => $va) {
                if (!empty($va['order_id'])) {
                    $orderStatus = $this->db->get_one('award_nodestatus', 'orderid=' . $va['order_id'], 'status,status_reason', 0, 'id desc');
                    $demand = $this->db->get_one('demand', 'id =' . $va['order_id'], 'address,area,budget,housekeeperid,title,telephone');
                    $demand_code[$key]['address'] = $demand['address'];
                    $demand_code[$key]['nickname'] = $demand['title'];
                    $demand_code[$key]['mobile'] = $demand['telephone'];
                    $demand_code[$key]['area'] = $demand['area'];
                    $demand_code[$key]['budget'] = $demand['budget'];
                    $xiaoStatus = $this->orderStatus();
                    if ($orderStatus['status'] == 5) {
                        $orderMoney = $this->db->get_one('award_demand_code', 'order_id =' . $va['order_id'] . ' and money > 50', 'money');
                        $demand_code[$key]['orderStatus'] = $xiaoStatus[$orderStatus['status']] . $orderMoney['money'] . '鼓励金';
                    } else {
                        $demand_code[$key]['orderStatus'] = $xiaoStatus[$orderStatus['status']] . $orderStatus['status_reason'];
                    }
                }
                if (!empty($demand['housekeeperid'])) {
                    $hk = $this->db->get_one('member_hk_data', 'uid =' . $demand['housekeeperid'], 'gjname');
                    $demand_code[$key]['gjname'] = $hk['gjname'];
                }
                $demand_code[$key]['status'] = $code_status[$va['status']];
                if ($va['status'] == 1)
                    $win++;
            }

            $userData = $this->db->get_one('award_user', 'uid =' . $uid, 'nickname');
        } else if ($status == 3) {
            $fcode = $arr['icode'] ? $this->db->get_list('award_user', 'rcode =' . $arr['icode']) : array();
            $pages = $this->db->pages;
            $total = $this->db->number;
            $yroom = 0;
            foreach ($fcode as $key => $va) {
                $room = $this->fcode($va['uid']);
                $fcode[$key]['codesum'] = $room['codesum'];
                $fcode[$key]['ycode'] = $room['ycode'];
                $yroom += $room['ycode'];
            }
        }
        $id_number = '';
        $bank_manage = array();
        foreach ($bank as $key => $va) {
            $id_number = $va['id_number'];
            $bank_manage[] = $va['bank_name'] . $va['bank_number'];
            $bank_sum = $key + 1;
        }
        $arr['extract_sum'] = $extract_sum;
        $arr['id_number'] = $id_number;
        $arr['bank_manage'] = $bank_manage;
        $arr['bank_sum'] = $bank_sum;
        $tmp = $GLOBALS['tmp'];
//
        include $this->template('award_userinfo');
    }

    //管理会员
    public function member()
    {
        $type = isset($GLOBALS['type']) ? $GLOBALS['type'] : '';
        $title = isset($GLOBALS['title']) ? $GLOBALS['title'] : '';
        $attribute = isset($GLOBALS['attribute']) ? $GLOBALS['attribute'] : '';
        if ($type && $title) {
            $where = "$type ='$title'";
        }
        if ($attribute) {
            $where = "attribute ='$attribute'";
        }
        $page = isset($GLOBALS['page']) ? intval($GLOBALS['page']) : 1;
        $user = $this->db->get_list('award_user', $where, 'mobile,uid,icode,nickname,addtime,attribute', 0, 5, $page);
        $pages = $this->db->pages;
        include $this->template('award_member');
    }

    public function attribute()
    {
        $value = $GLOBALS['value'];
        $mobile = $GLOBALS['mobile'];
        if ($mobile) {
            $this->db->update('award_user', array('attribute' => $value), array('mobile' => $mobile));
            die(json_encode(array('code' => 1)));
        } else {
            die(json_encode(array('code' => 0)));
        }
    }
}

