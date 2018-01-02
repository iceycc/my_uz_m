<?php
defined('IN_WZ') or exit('No direct script access allowed');
load_class('admin');

class spread extends WUZHI_admin
{
    private $db;

    function __construct()
    {
        $this->db = load_class('db');
    }

    public function lst()
    {
        $page = isset($GLOBALS['page']) ? intval($GLOBALS['page']) : 1;
        $pagess = $page;
        $keytypes = isset($GLOBALS['title']) ? $GLOBALS['title'] : '';
        $citys = isset($GLOBALS['city']) ? $GLOBALS['city'] : '';
        $exercise_types = isset($GLOBALS['exercise_type']) ? $GLOBALS['exercise_type'] : '';
        $pc_m = isset($GLOBALS['pc_m']) ? intval($GLOBALS['pc_m']) : '';
        if ($pc_m == 1) {
            $ids = $this->search_pc();
        } else if ($pc_m == 2) {
            $ids = $this->search_m();
        }
        $where = $this->search($keytypes, $citys, $exercise_types, $ids);
        $page = max($page, 1);
        $res = $this->db->get_list('exercise', "status !=-1" . $where, '*', 0, 10, $page, 'update_time desc,id desc');
       // print_r($res);die;
        $exercise_type = array(1 => '线上活动', 2 => '线下活动');
        $ranking = 1 + (10 * ($page - 1));
        foreach ($res as $k => $re) {
            $res[$k]['ranking'] = $ranking;
            $res[$k]['exercise_type'] = $exercise_type[$re['exercise_type']];
            $res[$k]['citys'] = $this->citys($re['exercise_city'], $re['city']);
            $res[$k]['exercise_time'] = date('Y-m-d', $re['start_time']) . ' - ' . date('Y-m-d', $re['end_time']);
            $res[$k]['citys_count'] = substr_count($this->citys($re['exercise_city'], $re['city']), ',');
            $res[$k]['citys_status'] = $re['exercise_city'];
            $res[$k]['pczhu'][]= $this->db->get_list('exercise_pc', 'sourceid=' . $re['id'] . ' and status !=-1');
            $res[$k]['mzhu'][] = $this->db->get_list('m_newactivity', 'sourceid=' . $re['id'] . ' and status !=-1');
            $ranking++;
        }
        $pages = $this->db->pages;
        $total = $this->db->number;
        $cityData = get_config('city_config');

        include $this->template('spread_lit');
    }//列表页数据

    public function createActivity()
    {
        $id = $GLOBALS['id'];
        $title = $GLOBALS['ti'];
        //$cityData = $this->dredge_city();
        $cityData = get_config('city_config');
        if ($id) {
            $res = $this->db->get_one('exercise', "id=" . $id);
            $arrpt = $this->companyData($res['company'], $res['payment_id'], $res['method_id']);

            $arrzx = $this->companyData($res['company_zx'], $res['payment_id_zx'], $res['method_id_zx']);
            $arr = $this->glueorder($arrpt, $arrzx);
            $cityId = explode(',', $res['city']);
            foreach ($cityData as $ke => $va) {
                foreach ($cityId as $id) {
                    if ($va['cityid'] == $id) {
                        $cityData[$ke]['checked'] = 'checked';
                    }
                }
            }
        }
        $company = $this->db->get_list('company', 'status=9', 'id,title');
        include $this->template('createActivity');
    }//新增活动 编辑活动页面展示
// 平台 装修
    public function glueorder($arr1, $arr2)
    {
        $arr = array();
        $i = 0;
        foreach ($arr1 as $k => $v){
            $flag = 1;
            foreach ($arr2 as $key => $value){
                if($v['comid']==$value['comid']){
                    $flag = 0;
                    $arr[$i]['comid'] = $v['comid'];
                    $arr[$i]['companyname'] = $v['companyname'];
                    $arr[$i]['payment_name'] = $v['payment_name'];
                    $arr[$i]['payment_id'] = $v['payment_id'];
                    $arr[$i]['commission'] = $v['commission'];
                    $arr[$i]['method_id'] = $v['method_id'];
                    $arr[$i]['payment_name_zx'] = $value['payment_name'];
                    $arr[$i]['payment_id_zx'] = $value['payment_id'];
                    $arr[$i]['commission_zx'] = $value['commission'];
                    $arr[$i]['method_id_zx'] = $value['method_id'];
                    $i++;
                }
            }
            //只有平台单
            if($flag){
                $arr[$i]['comid'] = $v['comid'];
                $arr[$i]['companyname'] = $v['companyname'];
                $arr[$i]['payment_name'] = $v['payment_name'];
                $arr[$i]['payment_id'] = $v['payment_id'];
                $arr[$i]['commission'] = $v['commission'];
                $arr[$i]['method_id'] = $v['method_id'];
                $arr[$i]['payment_name_zx'] = '';
                $arr[$i]['payment_id_zx'] = '';
                $arr[$i]['commission_zx'] = '';
                $arr[$i]['method_id_zx'] = '';
                $i++;
            }
        }
        //只有装修单
        foreach ($arr2 as $key => $value){
            $flag = 1;
            foreach ($arr1 as $k => $v){
                if($v['comid']==$value['comid']){
                    $flag = 0;
                }
            }
            if($flag){
                $arr[$i]['comid'] = $value['comid'];
                $arr[$i]['companyname'] = $value['companyname'];
                $arr[$i]['payment_name'] = '';
                $arr[$i]['payment_id'] = '';
                $arr[$i]['commission'] = '';
                $arr[$i]['method_id'] = '';
                $arr[$i]['payment_name_zx'] = $value['payment_name'];
                $arr[$i]['payment_id_zx'] = $value['payment_id'];
                $arr[$i]['commission_zx'] = $value['commission'];
                $arr[$i]['method_id_zx'] = $value['method_id'];
                $i++;
            }
        }
        return $arr;
    }

    public function searchTitle()
    {
        $title = $GLOBALS['ti'];
        $company = $this->db->get_list('company', "title like '%$title%'", 'id,title');
        die(json_encode($company));
    }//装修公司搜索

    public function activityName()
    {
        $comid = $GLOBALS['comid'];
        $company = $this->db->get_one('company', 'id=' . $comid, 'title');
        //装修单
        $company_payment_zx = $this->db->get_list('f_payment', 'order_type = 1 and company_id=' . $comid, 'payment_id,payment_name');
        if (!empty($company_payment_zx)) {
            foreach ($company_payment_zx as $key => $va) {
                $data_zx = $this->db->get_one('f_payment_method', 'payment_id=' . $va['payment_id'] . ' and commission !=0', 'commission,method_id');
                $company_payment_method_zx[$key]['commission'] = $data_zx['commission'];
                $company_payment_method_zx[$key]['method_id'] = $data_zx['method_id'];
            }
        }
        $zx = array(
            'comid' => $comid,
            'companyname' => $company['title'],
            'company_payment_zx' => $company_payment_zx ? $company_payment_zx : '暂无',
            'company_payment_method_zx' => $company_payment_method_zx ? $company_payment_method_zx : '暂无',
        );
        //平台订单
        $company_payment = $this->db->get_list('f_payment', 'order_type = 0 and company_id=' . $comid, 'payment_id,payment_name');
        if (!empty($company_payment)) {
            foreach ($company_payment as $key => $va) {
                $data = $this->db->get_one('f_payment_method', 'payment_id=' . $va['payment_id'] . ' and commission !=0', 'commission,method_id');
                $company_payment_method[$key]['commission'] = $data['commission'];
                $company_payment_method[$key]['method_id'] = $data['method_id'];
            }
        }
        $pt = array(
            'comid' => $comid,
            'companyname' => $company['title'],
            'company_payment' => $company_payment ? $company_payment : '暂无',
            'company_payment_method' => $company_payment_method ? $company_payment_method : '暂无',
        );
        $arr = compact('pt', 'zx');
        die(json_encode($arr));
    }

    private function companyData($companyId, $payment_id, $method_id)
    {
        if ($companyId) {
            $company = $this->db->get_list('company', "id in($companyId)", 'id,title');
            if ($payment_id) {
                $company_payment = $this->db->get_list('f_payment', "payment_id in ($payment_id)", 'payment_id,payment_name,company_id');
            }
            if ($method_id) {
                $company_payment_method = $this->db->get_list('f_payment_method', "method_id in ($method_id) and commission !=0", 'payment_id,commission,method_id', 0, 200);
                foreach ($company_payment_method as $k => $me) {
                    $com_id = $this->db->get_one('f_payment', 'payment_id=' . $me['payment_id'], 'company_id');
                    $company_payment_method[$k]['company_id'] = $com_id['company_id'];
                }
            }
            foreach ($company as $key => $va) {
                if ($payment_id) {
                    foreach ($company_payment as $pa) {
                        if ($va['id'] == $pa['company_id']) {
                            $arr[$key]['comid'] = $va['id'];
                            $arr[$key]['companyname'] = $va['title'];
                            $arr[$key]['payment_name'] = $pa['payment_name'];
                            $arr[$key]['payment_id'] = $pa['payment_id'];
                        }
                    }
                }
                if ($method_id) {
                    foreach ($company_payment_method as $me) {
                        $arr[$key]['commission'] = $me['commission'];
                        $arr[$key]['method_id'] = $me['method_id'];
                    }
                }
            }
        }
        return $arr;
    }

    public function add()
    {
        $id = $GLOBALS['exercise_id'];
        if (!empty($GLOBALS['submit'])) {
            if (!empty($id)) {
                $exercise_id = $this->save($GLOBALS, $id);
            } else {
                $exercise_id = $this->save($GLOBALS);
            }
            if ($exercise_id) {
                MSG('<script>setTimeout("top.dialog.get(window).close().remove();",1000),parent.iframeid.location.reload();</script>添加成功');
            }
        }
    }

    private function save($data, $id = '')
    {
        $status = array('发布' => 1);
        $arr = array();
        if (intval($data['exercise_city']) == 2) {
            $citys = implode(',', $data['city']);
            $arr['city'] = $citys . ',';
        }
        if (intval($data['exercise_city']) == 1) {
            $arr['city'] = '全国';
        }
        if (!empty($data['company'])) {
            $companys = implode(',', $data['company']);
        }
        if (!empty($data['payment_id'])) {
            $payment_ids = implode(',', $data['payment_id']);
        }
        if (!empty($data['method_id'])) {
            $method_ids = implode(',', $data['method_id']);
        }
        if (!empty($data['company_zx'])) {
            $companys_zx = implode(',', $data['company_zx']);
        }
        if (!empty($data['payment_id_zx'])) {
            $payment_ids_zx = implode(',', $data['payment_id_zx']);
        }
        if (!empty($data['method_id_zx'])) {
            $method_ids_zx = implode(',', $data['method_id_zx']);
        }
        $arr['exercise_title'] = $data['exercise_title'];
        $arr['exercise_city'] = $data['exercise_city'];
        $arr['exercise_type'] = $data['exercise_type'];
        $arr['start_time'] = strtotime($data['start_time']);
        $arr['end_time'] = strtotime($data['end_time']);
        $arr['exercise_remarks'] = $data['exercise_remarks'];
        $arr['company'] = $companys;
        $arr['payment_id'] = $payment_ids;
        $arr['method_id'] = $method_ids;
        $arr['company_zx'] = $companys_zx;
        $arr['payment_id_zx'] = $payment_ids_zx;
        $arr['method_id_zx'] = $method_ids_zx;
        $arr['add_time'] = time();
        $arr['update_time'] = time();
        $arr['status'] = $status[$data['submit']];
        if (!empty($id)) {
            $this->db->update('exercise', $arr, array('id' => $id));
        } else {
            $exercise_id = $this->db->insert('exercise', $arr);
        }
        $exercise_id = $exercise_id ? $exercise_id : $id;

        return $exercise_id;


    }

    private function dredge_city($arr = array())
    {
        $data = array(
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
        foreach ($data as $k => $v) {

        }
        return $data;
    }

    private function citys($type, $cityId)
    {
        if (intval($type) == 2) {
            //$dredge_city = $this->dredge_city();
            $dredge_city = get_config('city_config');
            $cityId = explode(',', $cityId);
            $citys = array();
            foreach ($dredge_city as $k => $va) {
                foreach ($cityId as $ke => $id) {
                    if ($va['cityid'] == $id) {

                        $citys[] = $va['city'];
                    }
                }
            }
        } else {
            return '全国';
        }
        if (!empty($citys)) {
            return implode(',', $citys);
        }
    }

    public function activitySource()
    {
        $id = $GLOBALS['id'];
        $type = $GLOBALS['type'];
        if (intval($type) == 1) {
            $p_id = $this->db->get_one('exercise_pc', 'sourceid=' . $id . ' and status !=-1');
        } else if (intval($type) == 2) {
            $m_id = $this->db->get_one('m_newactivity', 'sourceid=' . $id . ' and status !=-1');
        }
        if ($m_id) {
            die($id);
        } else if ($p_id) {
            die($id);
        }
    }

    public function activityAdd()
    {
        $sourceID = $GLOBALS['source'];
        if (!empty($GLOBALS['submit'])) {
            $pcId = $this->pc_save($GLOBALS);
            if ($pcId) {
                MSG(L('添加成功'), '?m=pc_activity&f=activity&v=lst&_su=wuzhicms');
            }
        } else {
            include $this->template('activity_add');
        }
    }

    private function pc_save($data, $id = "")
    {
        $arr = array();
        $status = array('保存' => 3, '发布' => 1);
        $arr['activity_type'] = $data['activity_type'];
        $arr['seo_keyword'] = $data['seo_keyword'];
        $arr['seo_description'] = $data['seo_description'];
        $arr['rewrite'] = $data['rewrite'];
        $arr['banner_width'] = $data['banner_width'];
        $arr['banner'] = $data['banner'];
        $arr['banner_color'] = $data['banner_color'];
        $arr['activity_content'] = json_encode($data['form']['content']);
        $arr['bidding'] = $data['bidding'];
        $arr['bidding_color'] = $data['bidding_color'];
        $arr['left_pic'] = $data['left_pic'];
        $arr['left_pic_color'] = $data['left_pic_color'];
        $arr['status'] = $status[$data['submit']];
        $arr['sourceid'] = $data['sourceID'];
        if (empty($id)) {
            if (!empty($data['sourceID'])) {
                $this->db->query("UPDATE wz_exercise SET exercise_num = exercise_num+1 WHERE id=$data[sourceID]");
            }
            $pcId = $this->db->insert('exercise_pc', $arr);
        } else {
            $this->db->update('exercise_pc', $arr, array('id' => $id));
        }
        return $pcId ? $pcId : $id;
    }

 /*   public function detaiLslist()
    {
        $id = $GLOBALS['ids'];
        $arr = array();
        $p_id = $this->db->get_one('exercise_pc', 'sourceid=' . $id . ' and status !=-1');
        $m_id = $this->db->get_one('m_newactivity', 'sourceid=' . $id . ' and status !=-1');
        $pc_name = $this->db->get_one('exercise', 'id=' . $id . '');
        if ($p_id) {
            $p_num = $this->db->get_list('channel_activity',"activityid={$p_id['id']}");
            $arr[0]['title'] = '主站PC';
            $arr[0]['id'] = $id;
            $arr[0]['did'] = 'p' . $p_id['id'];
            $arr[0]['type'] = 1;
            $arr[0]['url'] = 'http://www.uzhuang.com/index.php?m=pc_activity&f=activity&v=lst&page=' . $id;
            $arr[0]['activityname'] = $pc_name['exercise_title'];
            $arr[0]['addtime'] = $p_id['addtime'] ? $p_id['addtime'] :date('Y-m-d H:i:s',$pc_name['add_time']);
            $arr[0]['m_id'] = $p_id['id'];
            $arr[0]['exercise_id'] = $id;
            $arr[0]['channel_num'] = count($p_num);
            $arr[0]['custom_url'] = $p_id['custom_url'];

        }
        if ($m_id) {
            $m_num = $this->db->get_list('channel_activity',"activityid={$m_id['id']}");
            $str = R;
            $newstr = substr($str, 0, strlen($str) - 5);
            $url = $newstr . '/mobile-temp_new.html?activity_id=' . $m_id['id'];
            $arr[1]['title'] = 'M站';
            $arr[1]['id'] = $id;
            $arr[1]['did'] = 'm' . $m_id['id'];
            $arr[1]['type'] = 2;
            $arr[1]['url'] = $url;
            $arr[1]['activityname'] = $m_id['activityname'] ;
            $arr[1]['addtime'] = date('Y-m-d H:i:s',$m_id['addtime']);
            $arr[1]['m_id'] = $m_id['id'];
            $arr[1]['exercise_id'] = $id;
            $arr[1]['channel_num'] = count($m_num);
            $arr[1]['custom_url'] = $m_id['custom_url'];
        }



        include $this->template('detaiLslist');
    }*/

    public function detaiLslist(){
        $id = $GLOBALS['ids'];
        $p_id = $this->db->get_list('exercise_pc', 'sourceid=' . $id . ' and status !=-1 order by addtime desc');
        $m_id = $this->db->get_list('m_newactivity', 'sourceid=' . $id . ' and status !=-1 order by addtime desc');
        $pc_name = $this->db->get_one('exercise', 'id=' . $id . '');
        if($p_id){
            foreach ($p_id as $k_pc => $v_pc) {
                $p_num = $this->db->get_list('channel_activity', "activityid={$v_pc['id']}");
                $pc_arr['title'] = '主站PC';
                $pc_arr['id'] = $id;
                $pc_arr['did'] = 'p' . $v_pc['id'];
                $pc_arr['type'] = 1;
                $pc_arr['url'] = 'http://www.uzhuang.com/index.php?m=pc_activity&f=activity&v=lst&page=' . $id;
                $pc_arr['activityname'] = $pc_name['exercise_title'];
                $pc_arr['addtime'] = $v_pc['addtime'] ? $v_pc['addtime'] : date('Y-m-d H:i:s', $pc_name['add_time']);
                $pc_arr['m_id'] = $v_pc['id'];
                $pc_arr['exercise_id'] = $id;
                $pc_arr['channel_num'] = count($p_num);
                $pc_arr['custom_url'] = $v_pc['custom_url'];
                $arr['pc'][] = $pc_arr;
            }
        }
        if($m_id){
            foreach ($m_id as $k_m => $v_m) {
                $m_num = $this->db->get_list('channel_activity',"activityid={$v_m['id']}");
                $str = R;
                $newstr = substr($str, 0, strlen($str) - 5);
                $url = $newstr . '/mobile-temp_new.html?activity_id=' . $v_m['id'];
                $m_arr['title'] = 'M站';
                $m_arr['id'] = $id;
                $m_arr['did'] = 'm' . $v_m['id'];
                $m_arr['type'] = 2;
                $m_arr['url'] = $url;
                $m_arr['activityname'] = $v_m['activityname'] ;
                $m_arr['addtime'] = date('Y-m-d H:i:s',$v_m['addtime']);
                $m_arr['m_id'] = $v_m['id'];
                $m_arr['exercise_id'] = $id;
                $m_arr['channel_num'] = count($m_num);
                $m_arr['custom_url'] = $v_m['custom_url'];
                $arr['m'][] = $m_arr;

            }


        }

        include $this->template('detaiLslist');



    }

    public function status()
    {
        $id = $GLOBALS['id'];
        $type = intval($GLOBALS['type']);
        $status = intval($GLOBALS['status']);
        $message = $GLOBALS['message'];
        if ($type == 1) {
            $typeId = $this->db->update('exercise_pc', array('status' => $status), array('sourceid' => $id));
        } else if ($type == 2) {
            $typeId = $this->db->update('m_newactivity', array('status' => $status), array('sourceid' => $id));
        }
        if ($typeId) {
            $id = $this->db->query("UPDATE wz_exercise SET exercise_num = exercise_num-1 WHERE id=$id");
        }
        if ($id) {
            die($id);
        }
    }

    public function activityEdit()
    {
        $id = intval($GLOBALS['id']);
        $arr = $this->db->get_one('exercise_pc', 'id=' . $id);
        $content = $this->normal(json_decode($arr['activity_content']));
        if (!empty($GLOBALS['submit'])) {
            $pcId = $this->pc_save($GLOBALS, $id);
            MSG(L('编辑成功'), '?m=pc_activity&f=activity&v=lst&_su=wuzhicms');
        } else {
            include $this->template('activity_edit');
        }
    }

    private function normal($arr_lst)
    {
        $data = array();
        if (!empty($arr_lst)) {
            foreach ($arr_lst as $ke => $va) {
                foreach ($va as $k => $v) {
                    $data[$k][$ke] = $v;
                }
            }
        }
        return $data;
    }

    private function search_pc()
    {
        $arrId = $this->db->get_list('exercise_pc', 'status != -1', 'sourceid');
        $arr = array();
        foreach ($arrId as $key => $id) {
            $arr[] = $id['sourceid'];
        }
        return implode(',', $arr) ?: 'null';
    }

    private function search_m()
    {
        $arrId = $this->db->get_list('m_newactivity', 'status != -1 and sourceid != 0', 'sourceid');
        $arr = array();
        foreach ($arrId as $key => $id) {
            $arr[] = $id['sourceid'];
        }
        return implode(',', $arr) ?: 'null';
    }

    private function search($keytypes = "", $city = "", $exercise_type = "", $ids = "")
    {
        if (!empty($keytypes)) {
            $keytypes = " and exercise_title like '%$keytypes%'";
        }
        if ($city != 0) {
            $citys = " and (city like '%$city" . ',' . "%' or exercise_city = 1)";
        }
        if ($exercise_type != 0) {
            $exercise_type = " and exercise_type = $exercise_type";
        }
        if (!empty($ids)) {
            $ids = " and id in ($ids)";
        }
        $where = $keytypes . $citys . $exercise_type . $ids;

        return $where;
    }

    public function isRepeatTitle()
    {
        $id = $GLOBALS['id'];
        $exercise_title = $GLOBALS['exercise_title'];
        $res = $this->db->get_one('exercise', "exercise_title='" . $exercise_title . "'and id !='" . $id . "' and status !=-1", 'id');
        die(json_encode($res['id']));
    }

    public function txtSearch()
    {
        $this->db->get_list('exercise', $where, 'exercise_title');
        $total = $this->db->number;
        $data = $this->db->get_list('exercise', $where, 'exercise_title', 0, $total, 'update_time');
        die(json_encode($data));
    }

    //自定义链接 插入PC 和M站活动表

    public function addactive(){

      $type = $GLOBALS['type'];
      $customurl = $GLOBALS['customurl'];
      $exercise_id = $GLOBALS['exercise_id'];

      $pc_exercise = $this->db->get_one('exercise', 'id=' . $exercise_id . '');
      if($type == 1){
       $data['custom_url'] = $customurl;
       $data['status'] = 1;
       $data['sourceid'] = $exercise_id;
       $data['activity_type'] = 1;
       $this->db->insert('exercise_pc', $data);
       die(json_encode(array('msg'=>1)));
      }
      if($type == 2){
       $arr['custom_url'] = $customurl;
       $arr['status'] = 1;
       $arr['sourceid'] = $exercise_id;
       $arr['addtime']  = time();
       $arr['activity_type']  = 1;
       $arr['activityname'] = $pc_exercise['exercise_title'];
       $this->db->insert('m_newactivity', $arr);
       die(json_encode(array('msg'=>1)));
      }
    }

    public function up_custom(){

       $id = $GLOBALS['id'];
       $custom_url = $GLOBALS['custom_url'];
       $active_type = $GLOBALS['active_type'];
       $data['custom_url'] = $custom_url;
       if($active_type == 1){

           $this->db->update('exercise_pc', $data, array('id' => $id));
           die(json_encode(array('msg'=>1)));
       }
       if($active_type == 2){

           $this->db->update('m_newactivity', $data, array('id' => $id));
           die(json_encode(array('msg'=>1)));
       }

    }
}


















