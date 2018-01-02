<?php
defined('IN_WZ') or exit('No direct script access allowed');
load_class('admin');

class workitem extends WUZHI_admin {
	private $db;
	function __construct() {
		$this->db = load_class('db');
	}
    public function lst() 
    {   
        $page = isset($GLOBALS['page']) ? intval($GLOBALS['page']) : 1;
        $pagess=$page ;
        $keytypes = isset($GLOBALS['title']) ? $GLOBALS['title'] : '';
        $page = max($page,1);
        if(!empty($keytypes)){
           $where="and activityname like '%$keytypes%'";
        }
        $res = $db->get_list('m_newactivity',"status !=-1 ".$where,'*',0,10,$page,'updatetime desc,id desc');
        $style = array('1'=>'上线','2'=>'下线','3'=>'未发布');
        $ranking = 1+(10*($page-1));
        foreach ($res as $k => $re) {
           $res[$k]['ranking'] = $ranking;
           $res[$k]['status_type'] = $style[$re['status']];
           $res[$k]['status_type_data'] = $this->status_type($re['status']);
           $ranking++;
        }
        $pages = $db->pages;
        $total = $db->number;
        include $this->template('workitem_lit');
    }
    public function add() 
    {   
        if(!empty($GLOBALS['submit'])){
           $activityId = $this->save($GLOBALS);
           if($activityId){
              MSG(L('添加成功'),'?m=activity&f=activity&v=lst&_su=wuzhicms');
           }
        }
        include $this->template('workitem_add');
    }
    public function edit()
    {
      $id = intval($GLOBALS['id']);
      $arr = $this->db->get_one('m_newactivity',array('id'=>$id));
      $arr_copy = $this->db->get_one('m_newactivity_copy',array('activity_id'=>$id));
      $arr_lsts = $this->db->get_one('m_newactivity_lst',array('activity_id'=>$id),'content,contents');
      $arr_lst = json_decode($arr_lsts['content']);
      $arr_lsts = json_decode($arr_lsts['contents']);
      if(!empty($GLOBALS['submit'])){
             $activityId = $this->save($GLOBALS,$id);
             if($activityId){
                MSG(L('编辑成功'),'?m=activity&f=activity&v=lst&_su=wuzhicms');
             }
        }
       if($arr['activity_type']==2){
         $data = $this->normal($arr_lst);
         foreach ($data as $key => $value) {
            $data[$key]['icon'] = $value['type'];
                  if(!empty($arr_lsts->$value['type'])){
                    $data[$key]['shuffling'] = $this->content($arr_lsts->$value['type']);
                    $data[$key]['icon'] = 'shuffling';
                  }
         }
         include $this->template('workitem_editnormal');
      }else{
         $data = $this->h5($arr_lst);
         include $this->template('workitem_edith5');
      }
    }
    private function save($data,$id='')
    {   
       $status = array('保存'=>3,'发布'=>1);
       $arr=array();
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
       if(empty($id)){
           $arr['addtime'] = time();
           $activity = $this->db->insert('m_newactivity',$arr);
       }else{
           $activity_update = $this->db->update('m_newactivity',$arr,array('id'=>$id));
       }
       if(is_numeric($activity) || $activity_update){
           $arr_copy['activity_id'] = $activity ? $activity : $id ; 
           $arr_copy['location'] = $data['location']; 
           $arr_copy['copy'] = $data['copy']; 
           $arr_copy['color'] = $data['color']; 
           $arr_copy['copycolor'] = $data['copycolor']; 
           if(empty($id)){
             if(!empty($arr_copy['location'])){
                $this->db->insert('m_newactivity_copy',$arr_copy);
             }
           }else{
                $this->db->update('m_newactivity_copy',$arr_copy,array('activity_id'=>$id));
           }
           $arr_lst['activity_id'] = $activity ? $activity : $id;
           if($arr['activity_type']==2){
               $arr_lst['content'] = json_encode($data['form']['activity_normal']);
               $arr_lst['contents'] = json_encode($data['xiao']);
           }else{
               $arr_lst['content'] = json_encode($data['form']['activity']);
           }
           if(empty($id)){
               $this->db->insert('m_newactivity_lst',$arr_lst);
           }else{
               $this->db->update('m_newactivity_lst',$arr_lst,array('activity_id'=>$id));
           }
       }
       return $activity ? $activity : $id;
    }//添加新活动
    public function status()
    {
       $id = $GLOBALS['id'];
       $status = intval($GLOBALS['status']);
       $message = $GLOBALS['message'];
       $id = $this->db->update('m_newactivity',array('status'=>$status,'updatetime'=>time()),array('id'=>$id));
       if($id){
          show(1,$message.'成功');
       }
    }//活动的状态修改
    private function status_type($status)
    {
       if(intval($status)==1){
          return $data = array(2,'下线');
       }else if(intval($status)==2){
          return $data = array(1,'上线');
       }else if(intval($status)==3){
          return $data = array(1,'发布');
       }
    }//活动的状态赋值
    private function h5($arr_lst){
      $data = array();
      foreach ($arr_lst as $ke => $va) {
         foreach ($va as $k => $v) {
            $data[$k][$ke] = $v;
         }
      }
      foreach ($data as $k => $va) {
           if($va['type'] == 'pic'){
             $data[$k]['placeholder'] = 'placeholder="图片url连接(如:http://m.uzhuang.com)"';
           }else if($va['type'] == 'vim'){
             $data[$k]['placeholder'] = 'placeholder="视频url连接(http://player.youku.com/embed/XMTU2MzEzMDUwMA==)"';
           }
      }
      return $data;
    }
    private function normal($arr_lst){
        $data = array();
          foreach ($arr_lst as $ke => $va) {
           foreach ($va as $k => $v) {
              $data[$k][$ke] = $v;
           }
        }  
        return $data;  
    }
    private function content($data){
        $arr = array();
        foreach ($data as $ke => $va) {
           foreach ($va as $k => $v) {
              $arr[$k][$ke] = $v;
           }
        }  
        return $arr;
    }
  }
