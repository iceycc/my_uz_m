<?php
// +----------------------------------------------------------------------
// | wuzhicms [ 五指互联网站内容管理系统 ]
// | Copyright (c) 2014-2015 http://www.wuzhicms.com All rights reserved.
// | Licensed ( http://www.wuzhicms.com/licenses/ )
// | Author: wangcanjia <phpip@qq.com>
// +----------------------------------------------------------------------
defined('IN_WZ') or exit('No direct script access allowed');

class question_list
{
	private $db;
    private $default_header;
    function __construct() {
        $this->db = load_class('db');
        $this->default_header = R.'images/userface.png';//默认图片
    }

    private function check($id)
    {
        //校验id
        if(is_null($id)) {
            die(json_encode([
                'code' => 2,
                'message' => 'Id can not empty!',
                'data' => []
            ]));
        } elseif ($id < 0) {
            die(json_encode([
                'code' => 3,
                'message' => 'Id must be positive numeric!',
                'data' => []
            ]));
        }
    }

    /**
     * 获取首页热词
     */
    public function get_hot_words() {
    	$hot_words = $this->db->get_list('question_hot_word' , array('pub_show' => '1'), 'id,sequence,name', '', 1000, '','sequence');
    	echo json_encode(
    	    [
    	        'code' => 0,
    	        'message' => 'Success',
    	        'data' => $hot_words
            ]
        );
    }

    /**
     * 获取首页问题列表
     */
    public function get_homepage()
    {
        $hot_words_id = $GLOBALS['hot_words_id']; //接收热词ID
        $type = $GLOBALS['type'];
        $page = isset($GLOBALS['page'])&&$GLOBALS['page']?$GLOBALS['page']:1;//获取分页
        $key_word = $GLOBALS['key_word'];//搜索关键字
        $fields = 'id,title,pv,q_reward';//要查询的字段
        $order_by = 'qtime desc, col desc';
        $page_pre_result = 5;//每页条数

        $where = 'yydel=0';

        if ($hot_words_id) {//热词列表
            $this->check($hot_words_id);
            $where .= " and q_hot_word like '%,{$hot_words_id},%'";
            if ($key_word) {
                $where .= " and title like '%{$key_word}%'";
            }
            $question = $this->db->get_list('bang_question',$where,$fields,0,$page_pre_result,$page,$order_by);
        }else if($type==1){//我的收藏列表页
            // 获取用户id
            $uid = $GLOBALS['uid'];
            $this->check($uid);
            $question_ids = $this->db->get_list('bang_my_collect',array('uid'=>$uid),'icollect');
            $question_ids = array_column($question_ids, 'icollect');
            $question_str = implode($question_ids, ',');
            //根据问题id获取问题的信息
            if ($question_str) {
                $where .= " and id in ({$question_str})";
                if ($key_word) {
                    $where .= " and title like '%{$key_word}%'";
                }
                $question = $this->db->get_list('bang_question',$where,$fields,0,$page_pre_result,$page,$order_by);
            }else{
                $question = [];
            }
        }else if($type==2){//我的问题列表页
            // 获取用户id
            $uid = $GLOBALS['uid'];
            $this->check($uid);

            $where .= " and uid={$uid}";
            if ($key_word) {
                $where .= " and title like '%{$key_word}%'";
            }
            $this->db->update('bang_question',array('q_read_state'=>0),array('id'=>$q_id));//将改问题状态改为已读
            $question = $this->db->get_list('bang_question',$where,$fields,0,$page_pre_result,$page,$order_by);
        }

        $data = [];
        foreach ($question as $q_key => $q_info) {
            //根据问题id获取回答信息
            $sql = "select qid,uid,content from wz_bang_answer where qid={$q_info['id']} order by a_adoption desc,laud desc, atime desc";
            $ans_info = $this->db->fetch_array($this->db->query($sql));

            $q_info['a_content'] = $ans_info['content'];

            //根据回答者id获取头像
            $answer_info = $this->db->get_list('bang_answer',array('qid'=>$q_info['id']),'uid',0,5,0,'id','uid');
            $q_info['avatar'] = [];//用户头像
            foreach ($answer_info as $answer_key => $answer_value) {
                $answer_uid = $answer_value['uid'];
                $q_info['avatar'][] = $this->get_user_head_photo($answer_uid);
            }

            $q_info['q_reward'] = $this->convert_money($q_info['q_reward']);
            $data[] = $q_info;
        }
        echo json_encode(
            [
                'code' => 0,
                'message' => 'Success',
                'data' => $data
            ]
        );
    }

    /**
     * 问题详情页
     */
    public function get_question_list() {
        $qid = $GLOBALS['q_id'];//问题id
        $uid = $GLOBALS['uid'];//用户id

        $this->check($qid);
        $this->check($uid);
        $u_role = $this->get_steward_info($uid);//获取当前登录用户角色

        //问题详情页
        $q_info = $this->db->get_one('bang_question', array('id' => $qid), 'id,uid,uname,title,content,attach,pv,qtime,tally,q_reward,q_reward_balance,q_adoption,q_adoption_time');

        // 查询该问题是否被收藏
        if ($uid) {
            $collect_result = $this->db->get_one('bang_my_collect',array('uid'=>$uid,'icollect'=>$qid));
            if ($collect_result) {
                $q_info['is_collect'] = true;//被收藏
            }else{
                $q_info['is_collect'] = false;//未收藏
            }
        }else{
            $q_info['is_collect'] = false;//未收藏
        }
        if(empty($q_info)) {
            die(json_encode([
                'code' => 7,
                'message' => '该问题不存在',
                'data' => []
            ]));
        } else {
            //统计问题pv
            $this->db->query('update wz_bang_question set pv:=pv+1 where id='.$qid);
        }

        //提问超过5天未采纳，赏金给赞数最多(或回答时间最早)回答，且该问题不可进行采纳操作；如果超过5天，该问题仍然0回答，则赏金退回提问者账户
        if((strtotime($q_info['qtime']) + 86400 * 5) < time() && $q_info['q_adoption'] == 0 && $q_info['q_reward_balance'] != 0) {
            $sql = "select id from wz_bang_answer where qid=$qid order by laud desc, atime asc limit 1";
            $ans_info = $this->db->fetch_array($this->db->query($sql));

            if(!empty($ans_info)) {//该问题超过5天未采纳，且有用户回答该问题
                $this->db->update('bang_answer', array('a_get_reward' => $q_info['q_reward']), 'id='.$ans_info['id']);
            } else {//如果该问题超过5天仍没有回答
                //todo 赏金退回提问者账户
            }
        }

        unset($q_info['q_reward_balance']);
        $q_info['label'] = explode('|',$q_info['tally']);
        unset($q_info['tally']);

        //当用户采纳回答2天内，只有用户与被采纳者能够看到采纳状态
        if($q_info['q_adoption'] != 0 && $q_info['q_reward_balance'] == 0 && ($q_info['q_adoption_time'] > time() && time() < $q_info['q_adoption_time'] + 86400 * 2)) {
            if($uid != $q_info['uid'] || $uid != $q_info['q_adoption']) {
                $q_info['q_adoption'] = 0;
            }
        }

        $q_info['attach'] = '';
        if(!empty($q_info['attach'])){
            $q_info['attach'] = explode('|', $q_info['attach']);
        } else {
            $q_info['attach'] = array();
        }

        //获取提问者头像
        $author_avatar = $this->get_user_info($q_info['uid']);
        if($author_avatar['avatar'] == 1){
            $this->db->get_list('member', 'uid='.$q_info['uid'], '*');
            $q_info['avatar'] = "http://www.uzhuang.com/uploadfile/member/".substr(md5($q_info['uid']), 0, 2).'/'.$q_info['uid']."/180x180.jpg";
        } else {
            $q_info['avatar'] = '';
        }

        //获取问题的回答列表
        $answer_list = $this->db->get_list('bang_answer', array('qid' => $qid), 'id,uid,aname,content,attach,atime,laud,a_adoption,a_get_reward,a_like_user');

        $answer_list_info = [];
        foreach ($answer_list as $k => $v) {
            //获取回答者头像及身份信息
            $user_info = $this->get_user_info($v['uid']);
            $steward_info = $this->get_steward_info($v['uid']);

            $v['like_num'] = $v['laud'];
            unset($v['laud']);

            //处理附件图片
            if(!empty($v['attach'])){
                $v['attach'] = explode('|', $v['attach']);
            } else {
                $v['attach'] = [];
            }

            //处理用户身份
            if(!empty(array_filter($steward_info))) {
                if(($u_role['level'] == 0 || $u_role['level'] == 1) && $uid != $v['uid']) {//当登陆用户角色为管家时，显示其他管家的回答时名字为匿名用户，头像为空
                    $v['aname'] = '匿名用户';
                    $v['a_avatar'] = $this->default_header;//todo 默认头像
                    $v['role'] = '普通用户';
                } else {
                    $v['a_avatar'] = getImgShow($steward_info['personalphoto'],'small_square');
                    $v['role'] = $steward_info['level'] == 1 ? '金牌管家' : '管家';
                }
            } else {
                $v['a_avatar'] = $user_info['avatar'];
                $v['role'] = $user_info['user_lv'] == 2 ? '达人' : '普通用户';
            }

            //当前登陆用户是否已点赞该回答
            if(strstr($v['a_like_user'], $uid)){
                $v['liked'] = 1;
            } else {
                $v['liked'] = 0;
            }
            unset($v['a_like_user']);

            //获取热门评论
            $hot_comment = $this->get_answer_comments($q_info['id'], $v['id'],$uid);
            //获取该回答下的评论总条数
            $comment_num = $this->db->fetch_array($this->db->query("select count(c_id) as num from wz_comment_list where q_id = $qid and a_id = ".$v['id']));

            if(!empty($hot_comment)) {
                $v['hot_comment'] = $hot_comment[0];
                $v['hot_comment']['comment_total_num'] = $comment_num['num'];
            } else {
                $v['hot_comment'] = array();
                $v['hot_comment']['comment_total_num'] = 0;
            }

            //处理用户身份
            if(!empty(array_filter($steward_info))) {
                if(($u_role['level'] == 0 || $u_role['level'] == 1) && $uid != $v['uid']) {//当登陆用户角色为管家时，显示其他管家的回答时名字为匿名用户，头像为空
                    $v['hot_comment']['username'] = '匿名用户';
                    $v['hot_comment']['role'] = '普通用户';
                } else {
                    $v['hot_comment']['username'] = $this->get_username($v['uid']);
                    $v['hot_comment']['role'] = $steward_info['level'] == 1 ? '金牌管家' : '管家';
                }
            } else {
                $v['hot_comment']['username'] = $this->get_username($v['uid']);
                $v['hot_comment']['role'] = $user_info['user_lv'] == 2 ? '达人' : '普通用户';
            }
            //判断用户的提问者与回答者身份
            $qes_info = $this->db->get_one('bang_question', array('id'=>$qid), 'uid');//获取提问者id
            $ans_info = $this->db->get_one('bang_answer', array('qid'=>$qid, 'id'=>$v['uid']), 'uid');//获取回答者id

            if($qes_info['uid'] == $v['user_id']) {
                $v['hot_comment']['role'] = '提问者';
            } elseif ($ans_info['uid'] == $v['user_id']) {
                $v['hot_comment']['role'] = '回答者';
            }

            if($v['hot_comment']['comment_total_num'] == 0) {
                $v['hot_comment'] = null;
            }

            $answer_list_info[] = $v;
        }

        $q_info['answer_num'] = count($answer_list_info);
        $q_info['q_reward'] = $this->convert_money($q_info['q_reward']);

        if(!empty($q_info)) {
            $data['code'] = 0;
            $data['msg'] = 'Success';
            $data['data']['question'] = $q_info;
            $data['data']['answer_list']= $answer_list_info;
        } else {
            $data['code'] = 1;
            $data['message'] = '该问题不存在';
            $data['data'] = [];
        }
        echo json_encode($data);
    }

    //获取回答的评论信息
    private function get_answer_comments($q_id, $a_id,$uid)
    {
        $data = $this->db->query("select c_id,q_id,a_id,reply_c_id,user_id,like_num,c_add_time,content,if(INSTR(like_user,$uid)<>0, 1,0) as liked from wz_comment_list where q_id = $q_id and a_id = $a_id order by like_num desc,c_add_time desc");
        $comment_list = [];
        while($res = $this->db->fetch_array($data)) {
            $comment_list[] = $res;
        }
        return $comment_list;
    }

    //转换赏金格式
    private function convert_money($reward)
    {
        //对赏金处理，数据表中存储单位为分
        if(strlen($reward) < 3) {
            $reward = '0.'.str_pad($reward, 2,'0',STR_PAD_LEFT);
        } else {
            $reward = substr($reward, 0, strlen($reward) - 2) . '.' . substr($reward, -2);
        }
        return $reward;
    }

    //获取回答信息
    public function get_answer()
    {
        //接收问题及回答id
        $q_id = $GLOBALS['q_id'];
        $a_id = $GLOBALS['a_id'];
        $uid = $GLOBALS['uid'];//当前登陆用户id

        $this->check($q_id);
        $this->check($a_id);
        $this->check($uid);

        $data = $this->db->query("select qid as q_id,id as a_id,uid,content,if(INSTR(a_like_user,$uid)<>0, 1,0) as liked, laud as like_num,atime from wz_bang_answer where id = $a_id");
        $res = $this->db->fetch_array($data);

        $u_info = $this->get_steward_info($uid);//获取当前登录用户角色

        //处理用户身份
        if(!empty(array_filter($u_info))) {
            if(($u_info['level'] == 0 || $u_info['level'] == 1) && $uid != $res['uid']) {//当登陆用户角色为管家时，显示其他管家的回答时名字为匿名用户，头像为空
                $res['aname'] = '匿名用户';
                $res['a_avatar'] = $this->default_header;//todo 默认头像
                $res['role'] = '普通用户';
            } else {
                $res['a_avatar'] = $u_info['personalphoto'];
                $res['role'] = $u_info['level'] == 1 ? '金牌管家' : '管家';
            }
        }
        //判断当前用户是否为提问者
        $ask_user = $this->db->get_one('bang_question', array('id'=>$q_id), 'id');
        if($uid == $res['uid']) {
            $res['role'] = '回答者';
        } elseif(!empty($ask_user) && $ask_user['id'] == $uid) {
            $res['role'] = '提问者';
        }

        //通过uid获取用户名
        $res['username'] = $this->get_username($res['uid']);

        echo json_encode([
            'code' => 0,
            'message' => 'Success',
            'data' => $res
        ]);
    }

    //通过uid获取用户姓名
    private function get_username($uid)
    {
        $user_info = $this->db->get_one('member', array('uid'=>$uid), 'username');
        if(!empty($user_info)) {
            return $user_info['username'];
        } else {
            return '';
        }
    }

    //获取回答的所有评论信息
    public function get_comment_list()
    {
        //接收问题及回答id
        $q_id = $GLOBALS['q_id'];
        $a_id = $GLOBALS['a_id'];
        $uid = $GLOBALS['uid'];

        $this->check($q_id);
        $this->check($a_id);
        $this->check($uid);

        $comment_list = $this->get_answer_comments($q_id, $a_id, $uid);

        $data = [];
        //添加用户相关信息
        foreach ($comment_list as $v) {
            $u_info = $this->get_steward_info($v['user_id']);//获取当前登录用户信息
            $steward_info = $this->db->get_one('member_hk_data', array('uid'=>$v['user_id']),'uid');//获取管家列表
            if(!empty($u_info)) {
                if(!empty($steward_info['uid'])) {//在管家表中查到当前登录用户信息，需要做特殊处理
                    if ($uid != $steward_info['uid']) {//当登陆用户角色为管家时，显示其他管家的回答时名字为匿名用户，头像为空
                        $v['aname'] = '匿名用户';
                        $v['a_avatar'] = $this->default_header;//todo 默认头像
                        $v['role'] = '普通用户';
                    } else {
                        $v['a_avatar'] = $u_info['personalphoto'];
                        $v['role'] = $u_info['level'] == 1 ? '金牌管家' : '管家';
                    }
                }else {
                    $v['a_avatar'] = $u_info['avatar'];
                    $v['role'] = $u_info['user_lv'] == 2 ? '达人' : '普通用户';
                }
            }

            //判断用户的提问者与回答者身份
            $qes_info = $this->db->get_one('bang_question', array('id'=>$q_id), 'uid');//获取提问者id
            $ans_info = $this->db->get_one('bang_answer', array('qid'=>$q_id, 'id'=>$a_id), 'uid');//获取回答者id

            if($qes_info['uid'] == $v['user_id']) {
                $v['role'] = '提问者';
            } elseif ($ans_info['uid'] == $v['user_id']) {
                $v['role'] = '回答者';
            }

            $v['username'] = $this->get_username($v['user_id']);
            $data[] = $v;
        }

        echo json_encode(
            [
                'code' => 0,
                'message' => 'Success',
                'data' => $data
            ]
        );
    }

    //获取管家信息
    private function get_steward_info($uid)
    {
        $info = $this->db->get_one('member_hk_data', 'uid = ' . $uid, 'level,personalphoto');
        return !empty($info) ? $info : [];
    }

    //获取普通用户信息
    private function get_user_info($uid)
    {
        $info = $this->db->get_one('member', 'uid = '. $uid, 'avatar,user_lv');
        return !empty($info) ? $info : [];
    }

    //问题采纳接口
    public function adoption()
    {
        $uid = $GLOBALS['uid'];//用户id
        $q_id = $GLOBALS['q_id'];//问题id
        $a_id = $GLOBALS['a_id'];//回答id

        $this->check($uid);
        $this->check($q_id);
        $this->check($a_id);

        $q_id_exist = $this->db->get_one('bang_question', array('id'=>$q_id), 'uid');
        $a_id_exist = $this->db->get_one('bang_answer', array('id'=>$a_id), 'id');

        if(empty($q_id_exist)) {
            die(json_encode([
                'code' => 7,
                'message' => '该问题不存在',
                'data' => []
            ]));
        } elseif($uid != $q_id_exist['uid']) {
            die(json_encode([
                'code' => 8,
                'message' => '您无此操作权限',
                'data' => []
            ]));
        } elseif(empty($a_id_exist)) {
            die(json_encode([
                'code' => 9,
                'message' => '该回答不存在',
                'data' => []
            ]));
        } else {
            $this->db->update('bang_question', ['q_adoption'=>$q_id,'q_adoption_time'=>date('Y-m-d H:i:s',time()),'q_reward_balance'=>0], 'id='.$q_id);

            die(json_encode([
                'code' => 0,
                'message' => 'Success',
                'data' => []
            ]));
        }
    }

    //问题提交接口
    public function ask_question()
    {
        $uid = $GLOBALS['uid'];//用户id
        $title = $GLOBALS['title'];//问题标题
        $content = $GLOBALS['content'];//问题描述
        $reward = $GLOBALS['reward'];//问题赏金,正整数
        //todo 问题附件

        $uname = $this->get_username($uid);
        $this->check($uid);
        if(empty($uname) || empty($title)) {
            die(json_encode([
                'code' => 5,
                'message' => '问题标题不得为空',
                'data' => []
            ]));
        } elseif($reward < 0) {
            die(json_encode([
                'code' => 6,
                'message' => '赏金必须为正整数',
                'data' => []
            ]));
        }
        $title = addslashes(htmlspecialchars($title));
        $content = addslashes(htmlspecialchars($content));

        $data = [
            'uid' => $uid,
            'uname' => $uname,
            'title' => $title,
            'content' => $content,
            'q_reward' => $reward * 100,
            'q_reward_balance' => $reward * 100
        ];
        $this->db->insert('bang_question', $data);

        die(json_encode([
            'code' => 0,
            'message' => 'Success',
            'data' => []
        ]));
    }

    //问题回答接口
    public function answer()
    {
        $q_id = $GLOBALS['q_id'];//问题id
        $uid = $GLOBALS['uid'];//用户id
        $aname = $GLOBALS['aname'];//用户名
        $content = $GLOBALS['content'];//回答内容
        //todo 回答附件
        $attach = '';

        $this->check($q_id);
        $this->check($uid);
        if(empty($content)) {
            die(json_encode([
                'code' => 5,
                'message' => 'Content can not blank!',
                'data' => []
            ]));
        }
        $content = addslashes(htmlspecialchars($content));

        $data = [
            'uid' => $uid,
            'qid' => $q_id,
            'aname' => $aname,
            'content' => $content,
            'attach' => $attach,
            'atime' => date('Y-m-d :H:m:i', time()),
            'best' => 0,
            'read' => 0,
            'founder' => 0,
            'laud' => 0,
            'question_id' => '',
            'audit'=>'待审核'
        ];

        $this->db->insert('bang_answer', $data);

        $this->db->update('bang_question',array('q_read_state'=>1),array('id'=>$q_id));//将改问题状态改为有人回答

        die(json_encode([
            'code' => 0,
            'message' => 'Success',
            'data' => []
        ]));
    }

    //回答评论接口
    public function comment()
    {
        $q_id = $GLOBALS['q_id'];//问题id
        $a_id = $GLOBALS['a_id'];//回答id
        $uid = $GLOBALS['uid'];//用户id
        $reply_c_id = $GLOBALS['reply_c_id'];//回复评论的id，不是回复评论时，该字段传0
        $content = $GLOBALS['content'];//评论内容

        $this->check($q_id);
        $this->check($a_id);
        $this->check($reply_c_id);
        $this->check($uid);
        if(empty($content)) {
            die(json_encode([
                'code' => 5,
                'message' => 'Content can not blank!',
                'data' => []
            ]));
        }
        $content = addslashes(htmlspecialchars($content));

        $data = [
            'q_id' => $q_id,
            'a_id' => $a_id,
            'reply_c_id' => $reply_c_id,
            'user_id' => $uid,
            'content' => $content
        ];

        $this->db->insert('comment_list', $data);

        die(json_encode([
            'code' => 0,
            'message' => 'Success',
            'data' => []
        ]));
    }

    //点赞接口
    public function like()
    {
        $q_id = $GLOBALS['q_id'];//问题id
        $a_id = $GLOBALS['a_id'];//回答id
        $c_id = $GLOBALS['c_id'];//评论id
        $uid = $GLOBALS['uid'];//用户id

        $this->check($q_id);
        $this->check($a_id);
        $this->check($c_id);
        $this->check($uid);

        if($a_id != 0 && $q_id != 0 && $c_id == 0) {//赞回答
            $liked = $this->db->fetch_array($this->db->query("select instr((select a_like_user from wz_bang_answer where id=$a_id), $uid) as exist"));//查询用户是否已经点过赞
            $like_user = $this->db->get_one('bang_answer', array('id'=>$a_id), 'a_like_user');//查看该回答点赞记录
            if(!empty($liked['exist'])) {//用户已点赞
                $this->db->query('update wz_bang_answer set laud:=laud-1 where id=' . $a_id);//点赞数量-1
                $liked_user = str_replace($uid.',','',$like_user['a_like_user']);//并移除该用户点赞记录
                $this->db->update('bang_answer', array('a_like_user'=>$liked_user), 'id='.$a_id);
            } else {//用户未赞
                $this->db->query('update wz_bang_answer set laud:=laud+1 where id=' . $a_id);//点赞数量+1

                if(!empty($like_user['a_like_user'])) {
                    $liked_user = $like_user['a_like_user'] . $uid . ',';
                } else {
                    $liked_user = ',' . $uid . ',';
                }
                $this->db->update('bang_answer', array('a_like_user'=>$liked_user), 'id='.$a_id);//并新增该用户点赞记录
            }
            die(json_encode([
                'code' => 0,
                'message' => 'Success',
                'data' => []
            ]));
        } elseif($c_id != 0 && $q_id != 0 && $a_id !=0) {//赞评论
            $liked = $this->db->fetch_array($this->db->query("select instr((select like_user from wz_comment_list where c_id=$c_id), $uid) as exist"));//查询用户是否已经点过赞
            $like_user = $this->db->get_one('comment_list', array('c_id'=>$c_id), 'like_user');//查看该回答点赞记录

            if(!empty($liked['exist'])) {//用户已点赞
                $this->db->query('update wz_comment_list set like_num:=like_num-1 where c_id=' . $c_id);//点赞数量-1
                $liked_user = str_replace($uid.',','',$like_user['like_user']);//并移除该用户点赞记录
                $this->db->update('comment_list', array('like_user'=>$liked_user), 'c_id='.$c_id);
            } else {//用户未赞
                $this->db->query('update wz_comment_list set like_num:=like_num+1 where c_id=' . $c_id);//点赞数量+1

                if(!empty($like_user['a_like_user'])) {
                    $liked_user = $like_user['a_like_user'] . $uid . ',';
                } else {
                    $liked_user = ',' . $uid . ',';
                }
                $this->db->update('comment_list', array('like_user'=>$liked_user), 'c_id='.$c_id);//并新增该用户点赞记录
            }
            die(json_encode([
                'code' => 0,
                'message' => 'Success',
                'data' => []
            ]));
        } else {
            die(json_encode([
                'code' => 4,
                'message' => 'Param error',
                'data' => []
            ]));
        }
    }

    //获取首页的banner信息
    public function get_banner_list()
    {
        $banner_list = $this->db->get_list('question_banner', array('banner_show' => '1'), 'img_name,activity_url', 'weight desc');
        //todo 处理图片地址
        echo json_encode(
            [
                "code" => 0,
                "message" => "Success",
                "data" => $banner_list
            ]
        );
    }

    //个人中心页
    public function profile()
    {
        $uid = $GLOBALS['uid'];
        $this->check($uid);
        // 获取我的收藏数
        $collect_num = $this->db->count('bang_my_collect',array('uid'=>$uid));
        // 获取我的提问数
        $question_num = $this->db->count('bang_question',array('uid'=>$uid));
        // 是否有新的回答
        $state = $this->db->get_one('bang_question',array('uid'=>$uid,'q_read_state'=>1),'id');
        // 获取用户名称和头像
        $user_info = $this->db->get_one('member',array('uid'=>$uid),'avatar,nickname,truename,username');
        $user_head_photo = $this->get_user_head_photo($uid);
        if ($user_info['nickname']) {
            $username = $user_info['nickname'];
        }else if($user_info['truename']){
            $username = $user_info['truename'];
        }else{
            $username = $user_info['username'];
        }
        $red_dot = $state?1:0;//1有新的回答、0没有新的回答
        $data = ['collect_num'=>$collect_num['num'],'my_question_num'=>$question_num['num'],'avatar'=>$user_head_photo,'username'=>$username,'red_dot'=>$red_dot];
        die(json_encode(['code'=>0,'data'=>$data,'message'=>'数据获取成功']));
    }

    //收藏问题接口
    public function favourites()
    {
        $uid = $GLOBALS['uid'];
        $this->check($uid);

        $qid = $GLOBALS['q_id'];
        if (!is_numeric($qid) || $qid<=0) {
            die(json_encode(['code'=>4,'message'=>'参数错误']));
        }

        $collect_result = $this->db->get_one('bang_my_collect', array('uid' => $uid,'icollect'=>$qid));
        $question_info = $this->db->get_one('bang_question', array('id'=>$qid),'bang_collect');
        if(!$collect_result) {
            $formdata = array();
            $formdata['uid'] = $uid;
            $formdata['icollect'] = $qid;
            $this->db->insert('bang_my_collect', $formdata);
            $this->db->update('bang_question', array('bang_collect'=>$question_info['bang_collect']+1), array('id' => $qid));
            die(json_encode(['code'=>0,'message'=>'收藏成功']));
        } else {
            $this->db->delete('bang_my_collect', array('uid'=>$uid,'icollect'=>$qid));
            $this->db->update('bang_question', array('bang_collect'=>$question_info['bang_collect']-1), array('id' => $id));
            die(json_encode(['code'=>0,'message'=>'取消收藏成功']));
        }
    }

    //我的问题
    public function my_question()
    {
        
    }

    //我的钱包
    public function wallet()
    {

    }

    /*
     * 获取用户头像
     */
    public function get_user_head_photo($uid){
        if ($uid) {
            $avatar = $this->db->get_one('member_hk_data', 'uid = '.$uid, 'personalphoto');
            if ($avatar) {//管家头像
                return getImgShow($avatar['personalphoto'],'small_square');
            }else{//用户头像
                $member_info = $this->db->get_one('member',array('uid'=>$uid),'uid,avatar');
                if($member_info['avatar']==1){
                    $file = 'uploadfile/member/'.substr(md5($member_info['uid']), 0, 2).'/'.$member_info['uid'].'/180x180.jpg';
                    return 'http://www.uzhuang.com/'.$file;
                }else if(strlen($member_info['avatar'])>5){
                    return $member_info['avatar'];
                }else{
                    return $this->default_header;//默认头像
                }
            }
        } else {
            return $this->default_header;//默认头像
        }
    }

    /*
     *热门搜索
     */
    public function hot_search(){
        $designation = $this->db->get_list('bang_hotword','','designation',0,10,1,'sort asc');
        $designation = array_column($designation, 'designation');
        die(json_encode(['code'=>0,'data'=>$designation,'message'=>'查询成功']));
    }
}
