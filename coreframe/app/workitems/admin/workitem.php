<?php
defined('IN_WZ') or exit('No direct script access allowed');
load_class('admin');

class workitem extends WUZHI_admin
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
        $page = max($page, 1);
        if (!empty($keytypes)) {
            $where = "and activityname like '%$keytypes%'";
        }
        $res = $this->db->get_list('m_newactivity', "status !=-1 " . $where, '*', 0, 10, $page, 'updatetime desc,id desc');
        $style = array('1' => '上线', '2' => '下线', '3' => '未发布');
        $ranking = 1 + (10 * ($page - 1));
        foreach ($res as $k => $re) {
            $res[$k]['ranking'] = $ranking;
            $res[$k]['status_type'] = $style[$re['status']];
            $res[$k]['status_type_data'] = $this->status_type($re['status']);
            $ranking++;
        }
        $pages = $this->db->pages;
        $total = $this->db->number;
        include $this->template('workitem_lit');
    }

    public function add()
    {
        $sourceId = $GLOBALS['source'];
        if (!empty($GLOBALS['submit'])) {
            $activityId = $this->save($GLOBALS);
            if ($activityId) {
                MSG(L('添加成功'), '?m=ac_spread&f=spread&v=lst&_su=wuzhicms');
            }
        }
        include $this->template('workitem_add');
    }

    public function edit()
    {
        $id = intval($GLOBALS['id']);

        $arr = $this->db->get_one('m_newactivity', array('id' => $id));
        $GLOBALS['sourceId'] = $arr['sourceid'];
        if ($arr['area'] > 2) {
            $c = $this->db->get_one('linkage_data', 'lid =' . $arr['area'], 'name');
        }
        $cname = !empty($c['name']) ? $c['name'] : '默认城市';
        $arr_copy = $this->db->get_one('m_newactivity_copy', array('activity_id' => $id));
        $arr_lsts = $this->db->get_one('m_newactivity_lst', array('activity_id' => $id), 'content,contents');
        $arr_lst = json_decode($arr_lsts['content']);
        $arr_lsts = json_decode($arr_lsts['contents']);

        if (!empty($GLOBALS['submit'])) {

            $activityId = $this->save($GLOBALS, $id);
            if ($activityId) {
                MSG(L('编辑成功'), '?m=ac_spread&f=spread&v=lst&_su=wuzhicms');
            }
        }
        if ($arr['activity_type'] == 2) {
            $data = $this->normal($arr_lst);
            foreach ($data as $key => $value) {
                $data[$key]['icon'] = $value['type'];
                if (!empty($arr_lsts->$value['type'])) {
                    $data[$key]['shuffling'] = $this->content($arr_lsts->$value['type']);
                    $data[$key]['icon'] = 'shuffling';
                }
            }
            include $this->template('workitem_editnormal');
        } else {
            $data = $this->h5($arr_lst);

            include $this->template('workitem_edith5');
        }
    }

    private function save($data, $id = '')
    {
        $status = array('保存' => 3, '发布' => 1);
        $arr = array();
        $arr['activityname'] = $data['activityname'];
        $arr['headline'] = $data['headline'];
        $arr['activitytitle'] = $data['activitytitle'];
        $arr['navigation'] = $data['navigation'];
        $arr['consult'] = $data['consult'];
        $arr['floor'] = $data['floor'];
        $arr['applybox'] = $data['applybox'];
        $arr['area'] = $data['area'];
        $arr['updatetime'] = time();
        $arr['activity_type'] = $data['activity_type'];
        $arr['background'] = $data['background'];
        $arr['tosignup'] = $data['tosignup'];
        $arr['submitcopy'] = $data['submitcopy'];
        $arr['buttoncolor'] = $data['buttoncolor'];
        $arr['buttoncopycolor'] = $data['buttoncopycolor'];
        $arr['numbercolor'] = $data['numbercolor'];
        $arr['cuewords'] = $data['cuewords'];
        $arr['share'] = $data['share'];
        $arr['sharetitle'] = $data['sharetitle'];
        $arr['content'] = $data['content'];
        $arr['status'] = $status[$data['submit']];
        $arr['sourceid'] = $data['sourceId'];

        if (empty($id)) {
            $arr['addtime'] = time();
            if (!empty($data['sourceId'])) {
                $this->db->query("UPDATE wz_exercise SET exercise_num = exercise_num+1 WHERE id=$data[sourceId]");
            }
            $activity = $this->db->insert('m_newactivity', $arr);
        } else {

            $activity_update = $this->db->update('m_newactivity', $arr, array('id' => $id));
        }
        if (is_numeric($activity) || $activity_update) {
            $arr_copy['activity_id'] = $activity ? $activity : $id;
            $arr_copy['location'] = $data['location'];
            $arr_copy['copy'] = $data['copy'];
            $arr_copy['color'] = $data['color'];
            $arr_copy['copycolor'] = $data['copycolor'];

            if (empty($id)) {
                if (!empty($arr_copy['location'])) {
                    $this->db->insert('m_newactivity_copy', $arr_copy);
                }
            } else {
                $this->db->update('m_newactivity_copy', $arr_copy, array('activity_id' => $id));
            }
            $arr_lst['activity_id'] = $activity ? $activity : $id;
            if ($arr['activity_type'] == 2) {
                $arr_lst['content'] = json_encode($data['form']['activity_normal']);
                $arr_lst['contents'] = json_encode($data['xiao']);
            } else {
                $arr_lst['content'] = json_encode($data['form']['activity']);
            }
            if (empty($id)) {
                $this->db->insert('m_newactivity_lst', $arr_lst);
            } else {
                $this->db->update('m_newactivity_lst', $arr_lst, array('activity_id' => $id));
            }
        }
        return $activity ? $activity : $id;
    }//添加新活动

    public function status()
    {
        $id = $GLOBALS['id'];
        $status = intval($GLOBALS['status']);
        $message = $GLOBALS['message'];
        $id = $this->db->update('m_newactivity', array('status' => $status, 'updatetime' => time()), array('id' => $id));
        if ($id) {
            die($this->show(1, $message . '成功'));
        }
    }//活动的状态修改

    private function status_type($status)
    {
        if (intval($status) == 1) {
            return $data = array(2, '下线');
        } else if (intval($status) == 2) {
            return $data = array(1, '上线');
        } else if (intval($status) == 3) {
            return $data = array(1, '发布');
        }
    }//活动的状态赋值

    private function h5($arr_lst)
    {
        $data = array();
        foreach ($arr_lst as $ke => $va) {
            foreach ($va as $k => $v) {
                $data[$k][$ke] = $v;
            }
        }
        foreach ($data as $k => $va) {
            if ($va['type'] == 'pic') {
                $data[$k]['placeholder'] = 'placeholder="图片url连接(如:http://m.uzhuang.com)"';
            } else if ($va['type'] == 'vim') {
                $data[$k]['placeholder'] = 'placeholder="视频url连接(http://player.youku.com/embed/XMTU2MzEzMDUwMA==)"';
            }
        }
        return $data;
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

    private function content($data)
    {
        $arr = array();
        foreach ($data as $ke => $va) {
            foreach ($va as $k => $v) {
                $arr[$k][$ke] = $v;
            }
        }
        return $arr;
    }

    private function show($status, $message, $data = array())
    {
        $reuslt = array(
            'status' => $status,
            'message' => $message,
            'data' => $data,
        );
        return json_encode($reuslt);
    }


    /**
     * 渠道管理
     * @author zkl<zhangkuanli@uzhuang.com>
     */
    public function channelManger()
    {
        $username = get_cookie('username');
        $uid = $this->db->get_one('member', "`username`='" . $username . "'", 'uid');
        $role = $this->db->get_one('admin', "`uid`='" . $uid['uid'] . "'", '*');
        $role1 = $this->db->get_one('admin_role', "`role`='" . $role['role'] . "'", '*');

        //后期增加主ID
        $top_menu = $this->db->get_list('channel','pid=9000 ');
        foreach ($top_menu as $key => $value){
            $childs[$key] = $this->db->get_list('channel',"pid={$value['id']}");
        }
//        var_dump($childs);die();
        include $this->template('channelmanger');

    }

    public function channelEdit()
    {
        $id = $GLOBALS['id'];
        $c_id = $GLOBALS['c_id'];

        $city_config = get_config('city_config');
        $type = $GLOBALS['type'] ? $GLOBALS['type'] : 2;
        if($c_id){
            $exercise = $this->db->get_one('exercise',"id={$c_id}");
        }

        if($type==1){
            $exercise = $this->db->get_one('exercise',"id={$c_id}");
            $activity = $this->db->get_one('exercise_pc',"id={$id}");
            $activity['activityname'] = $exercise['exercise_title'];
            $channel_list = $this->db->get_list('channel_activity',"activityid={$id}"); //查出每一条渠道

        }else{

            $activity = $this->db->get_one('m_newactivity',"id={$id}");
            $channel_list = $this->db->get_list('channel_activity',"activityid={$id}"); //查出每一条渠道
        }


        $arr = array();
        $allchild = array();
        foreach ($channel_list as $k => $v){
            $child = $this->db->get_list('channel',"id in ({$v['channelid']})");
            array_push($allchild,$child);
        }

        $allparents = array();
        foreach ($allchild as $k => $v){
            foreach ($v as $kk => $vv){
                $p = $this->db->get_one('channel',"id = {$vv['pid']}");
                $allparents[$k][$kk]=$p;
            }
        }

        $select = array();
//        var_dump($allparents);
        foreach($allparents as $k => $v){
            foreach ($v as $kk => $vv) {
                $sel = $this->db->get_list('channel', "pid={$vv['id']}");
                $select[$k][$kk]=$sel;
            }
        }
        $arr['city'] =  $this->citys($exercise['exercise_city'], $exercise['city']);
        if($arr['city'] == '全国'){
            $a['0'] = '全国';
           $city = $this->db->get_list('linkage_data',array('pid'=> 0),'name,lid');
             foreach ($city as $k_city => $v_city){

                 $a[$v_city['lid']] = $v_city['name'];
             }
            $arr['city'] = $a;
        }

        if(isset($exercise['company'])){

            $company1 = explode(",",$exercise['company']);

        }else{
            $company1 = array();
        }
        if($exercise['company_zx']){
            $company2 = explode(",",$exercise['company_zx']);
        }else{
            $company2 = array();
        }

        $company_id  = implode(",",array_merge($company1,$company2));
        if(isset($company_id)){
            if($company_id != "" ){
                $company = $this->db->get_list('company',"id in ".'('.trim($company_id,",").')','title,id');
                if($company){
                    $arr['company'] = $company ? $company : array();
                }
            }else{
                $arr['company'] =  array();
            }

        }

        foreach ($channel_list as $k => $v){

            $company_name = $this->db->get_one('company',array('id'=>$v['company_id']),'title,id');
            $channel_list[$k]['company_id'] = array($company_name['id']=>$company_name['title']);
            foreach ($city_config as $k_city => $v_city){
                $city_conf[$v_city['cityid']] = $v_city;
            }
            if($v['city'] == 0){
                $channel_list[$k]['city'] = array($v['city']=>'全国');
            }else{
                $channel_list[$k]['city'] = array($v['city']=>$city_conf[$v['city']]['city']);
            }

        }
        //$channel_list['a'] = $arr;

        $custom_url = $activity['custom_url'];
       // echo '<pre>';print_r($select);die;
        include $this->template('channeledit');
    }

    //AJAX method
    public function getChannelList()
    {
        $channel_list = $this->db->get_list('channel','pid=9000');
        $text = '<div id="choosechannel">';
        foreach ($channel_list as $k => $v){
            if($GLOBALS['key']&&in_array($v['channelkey'],$GLOBALS['key'])){
                continue;
            }
            $child = $this->db->get_one('channel',"pid={$v['id']}");
            $text .= "<div style='float: left; width: 150px;' id='{$v['id']}'><input type=\"checkbox\" name='{$v['channelname']}'>{$v['channelvalue']}<span style='margin-left:40px;display: block;margin-bottom: 5px;color: #999999'>{$child['channelvalue']}</span></div>";
        }
        $text .= '</div>';
        die(json_encode($text));
    }

    //默认抓取装修公司和城市

    public  function getCompanyCity(){
     $id = $GLOBALS['c_id'];
     $exercise = $this->db->get_one('exercise',array('id'=>$id),'city,company,exercise_city,company_zx');
     $arr['city'] =  $this->citys($exercise['exercise_city'], $exercise['city']);
     if($arr['city'] == '全国'){
         $a['0'] = '全国';
         $city = $this->db->get_list('linkage_data',array('pid'=> 0),'name,lid');
         foreach ($city as $k_city => $v_city){

             $a[$v_city['lid']] = $v_city['name'];
         }
         $arr['city'] = $a;

     }
     if(isset($exercise['company'])){
         $company1 = explode(",",$exercise['company']);
     }else{
         $company1 = array();
     }
     if($exercise['company_zx']){
         $company2 = explode(",",$exercise['company_zx']);
     }else{
         $company2 = array();
     }

     $company_id  = implode(",",array_merge($company1,$company2));
        if(isset($company_id)){
            if($company_id != "" ){
                $company = $this->db->get_list('company',"id in ".'('.trim($company_id,",").')','title,id');
                if($company){
                    $arr['company'] = $company ? $company : array();
                }
            }else{
                $arr['company'] =  array();
            }

        }

     $text = '<select id="city">';
     $text.="<option>请选择</option>";
     foreach ($arr['city'] as $k => $v){
       $text.="<option value={$k}>$v</option>";
     }
     $text.= '</select>'.' ';
     if($arr['company']){
         $text .= '<select id="company" style="width:300px;">';
         $text.="<option>请选择</option>";
         foreach ($arr['company'] as $k => $v){

             $text.="<option value={$v['id']}>{$v['title']}</option>";
         }
         $text.= '</select>';
     }


        die(json_encode($text));
    }


    //AJAX method
    public function addChannel()
    {
        $channelname = $GLOBALS['name'];
        $format['channelvalue'] = $channelname;
        $format['channelkey'] = pinyin($channelname);
        $format['pid'] = $GLOBALS['pid']?$GLOBALS['pid']:9000;
        $format['createtime'] = time();
        $this->db->insert('channel',$format);
        $id = $this->db->insert_id();
        die(json_encode($id));
    }

    //AJAX method
    public function deleteChannel()
    {
        $id = $GLOBALS['id'];
        $this->db->delete('channel',"id={$id}");
    }

    //AJAX method
    public function changeChannelName()
    {
        $id = $GLOBALS['id'];
        $name = $GLOBALS['name'];
        $this->db->update('channel_activity',array('channelname'=>$name),array('id'=>$id));
        die(json_encode(array('code'=>1)));
    }

    //AJAX method
    public function changeTagName()
    {
        $id = $GLOBALS['id'];
        $name = $GLOBALS['name'];
        $this->db->update('channel',array('channelvalue'=>$name),array('id'=>$id));
        die(json_encode(array('code'=>1)));

    }

    //AJAX method
    public function deleteActivityChannel()
    {
        $id = $GLOBALS['id'];
        $this->db->delete('channel_activity',"id={$id}");
        die(json_encode(array('code'=>1)));
    }

    //AJAX method
    public function getChild()
    {
        $text = '';
        $checked = $GLOBALS['checked'];
        $ids = implode(',',$checked);
        $channels = $this->db->get_list('channel',' id in ('.$ids.')');
        foreach($channels as $k => $v){
            $text .= '<select name="'.$v['channelkey'].'" id="'.$v['id'].'" style="width:95px;height:21px;margin-left: 4px;margin-top: 2px;">';
            $text .= '<option>请选择</option>';
            $childs = $this->db->get_list('channel',"pid={$v['id']}");
            foreach($childs as $key => $value){
                $text.='<option value="'.$value['id'].'">'.$value['channelvalue'].'</option>';
            }
            $text .= '<option value="addnew">+新增</option>';
            $text .= '</select>';
        }

        die(json_encode($text));
    }

    //AJAX method

    public function addChannelActivity()
    {
        $activityid = $GLOBALS['activityid'];
        $c_id = $GLOBALS['c_id'];
        $type_source = $GLOBALS['type_source'];
        $channelid = $GLOBALS['channelid'];
        $city  = $GLOBALS['city'];
        $company  = $GLOBALS['company'];
        sort($channelid);
        $channelname = $GLOBALS['channelname'];
        $channelids = implode(',',$channelid);

        if($type_source ==2){
            $mzhan = $this->db->get_one('m_newactivity',"id={$activityid}");
            if($mzhan['custom_url']){
                $url = '?cid_id='.implode('-',$channelid);

                if(isset($city)){

                    $url .= '&cid_city_id='.$city;
                }
                if(isset($company)){
                    $url .= '&cid_comp_id='.$company;
                }
                $url .= '&cid_act_id='.$activityid;

            }else{
                $url = '&id='.implode('-',$channelid);
                if(isset($city)){

                    $url .= '&city_id='.$city;
                }
                if(isset($company)){
                    $url .= '&comp_id='.$company;
                }
                $url .= '&act_id='.$activityid;
            }


        }else{
            $pc = $this->db->get_one('exercise_pc',"id={$activityid}");
            if($pc['custom_url']){
                $url = '&id='.implode('-',$channelid);

                if(isset($city)){

                    $url .= '&city_id='.$city;
                }
                if(isset($company)){
                    $url .= '&comp_id='.$company;
                }
                $url .= '&act_id='.$activityid;
                $url .= '&ex_id='.$c_id;

            }else{
                $url = implode('-',$channelid);

                if(isset($city)){

                    $url .= '-'.$city;
                }
                if(isset($company)){
                    $url .= '-'.$company;
                }
                $url .= '-'.$activityid;

            }


        }

        if($type_source == 1){
            $pc = $this->db->get_one('exercise_pc',"id={$activityid}");
            $format['url'] = $pc['custom_url'] ? $pc['custom_url'].$url :'http://www.uzhuang.com/huodong-'.$c_id.'-'.$url.'.html';
        }else{
            $mzhan = $this->db->get_one('m_newactivity',"id={$activityid}");
            $format['url'] = $mzhan['custom_url'] ? $mzhan['custom_url'].$url :'http://m.uzhuang.com/mobile-temp_new.html?activity_id='.$activityid.$url;
        }
        $format['channelid'] = $channelids;
        $format['activityid'] = $activityid;
        $format['channelname'] = $channelname;
        $format['source'] = $type_source;
        $format['city'] = $city;
        $format['company_id'] = $company;
        $id = $GLOBALS['id'];
        if($id){
            $this->db->update('channel_activity',$format,"id={$id}");
        } else {
            $this->db->insert('channel_activity',$format);
            $id = $this->db->insert_id();
        }
        die(json_encode(array('url'=>$format['url'],'id'=>$id)));
    }
    //城市方法
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

                        $citys[$va['cityid']] = $va['city'];
                    }
                }
            }
        } else {
            return '全国';
        }
        if (!empty($citys)) {
            return $citys;
        }
    }





}
