<?php
// +----------------------------------------------------------------------
// | wuzhicms [ ÎåÖ¸»¥ÁªÍøÕ¾ÄÚÈÝ¹ÜÀíÏµÍ³ ]
// | Copyright (c) 2014-2015 http://www.wuzhicms.com All rights reserved.
// | Licensed ( http://www.wuzhicms.com/licenses/ )
// | Author: wangcanjia <phpip@qq.com>
// +----------------------------------------------------------------------
/**
 * ÊÕ²Ø¼Ð
 */
header("Access-Control-Allow-Origin: *");
defined('IN_WZ') or exit('No direct script access allowed');
load_class('foreground', 'member');
class package extends WUZHI_foreground {
  protected $product_type;
  // 套餐价格
  protected $package_price = array(
      0=>array(
          'name'=>'全包',
          'min'=>'0',
          'max'=>'0',
      ),
      1=>array(
          'name'=>'0-499元/㎡',
          'min'=>'0',
          'max'=>'499',
      ),
      2=>array(
          'name'=>'500-799元/㎡',
          'min'=>'500',
          'max'=>'799',
      ),
      3=>array(
          'name'=>'799元/㎡以上',
          'min'=>'799',
          'max'=>'0',
      ),
  );
  protected $cityid = 3360;
  public function __construct(){
    $this->db = load_class('db');
    $this->product_type = array(
        0=>array(
            'name'=>'全部',
            'value'=>0
        ),
        1=>array(
            'name'=>'基础装修',
            'value'=>1
        ),
        2=>array(
            'name'=>'监理服务',
            'value'=>2
        ),
        3=>array(
            'name'=>'拎包入住',
            'value'=>3
        ),
        4=>array(
            'name'=>'全屋装修',
            'value'=>4
        ),
        5=>array(
            'name'=>'局部换新',
            'value'=>5
        )
    );

    if (is_numeric($_COOKIE['cityid'])) {
        $this->cityid = $_COOKIE['cityid'];
    }
  }

  /*
   *装修套餐报名人数自动增加
  */
  public function signup_auto_add(){
      // 获取报名人数自动增加时间
      $get_signup_date = $this->db->get_one('block_product_detail','','signup_autoadd_date');
      $auto_signup_timestemp = $get_signup_date['signup_autoadd_date'];
      if (!$auto_signup_timestemp) {//初始化报名人数自动增长时间
          $original_time = date('Y-m-d',time());
          $original_timestemp = strtotime($original_time.' 00:00:00');
          $this->db->update('block_product_detail',array('signup_autoadd_date'=>$original_timestemp));
      }else{
          $current_timestemp = time();
          $auto_addtime = 172800;// 60*60*24*2  两天的时间戳
          if ($current_timestemp-$auto_signup_timestemp>$auto_addtime) {
              $add_num = floor(($current_timestemp-$auto_signup_timestemp)/$auto_addtime);
              $this->db->query("update wz_block_product_detail set signup=signup+{$add_num}");
              $original_time = date('Y-m-d',time());
              $original_timestemp = strtotime($original_time.' 00:00:00');
              $this->db->update('block_product_detail',array('signup_autoadd_date'=>$original_timestemp));
              // $this->db->update('block_product_detail',array('signup_autoadd_date'=>time()));
          }
      }
  }

  // 套餐列表页数据
  public function package_list(){
    // 增加人数
    $this->signup_auto_add();
    $where = "city like '%,{$this->cityid},%'";
    // 装修方式
    $product_type = $GLOBALS['product_type'];
    if($product_type){
      $where .= " and product_type={$product_type}";
    }
    // 套餐价格
    $min_price = $this->package_price[$GLOBALS['money']]['min'];
    if ($min_price) {//最低价格
      $where .= " and price >= {$min_price}";
    }
    $max_price = $this->package_price[$GLOBALS['money']]['max'];
    if ($max_price) {//最高价格
      $where .= " and price <= {$max_price}";
    }
    // 获取页数
    $page = $GLOBALS['page']?$GLOBALS['page']:1;
    // 查询数据
    $decorate_list = $this->db->get_list('block_product_detail',$where,'id,m_package_photos,spreadhead,title,product_type,price,signup',0,10,$page);
    $patterns = "/\d+(\.\d+)?/";
    foreach ($decorate_list as $key => $decorate) {
      //套餐类型
      $decorate_list[$key]['product_type'] = $this->product_type[$decorate['product_type']];
      // 封面图
      $product_photos = trim($decorate['m_package_photos'],',');
      $product_photos = explode(',', $product_photos);
      $decorate_list[$key]['m_package_photos'] = getImgShow($product_photos[0] , 'original');

      // 套餐标题
      $decorate_list[$key]['spreadhead'] = $decorate['title'];

      $strs = $decorate['price'];
      preg_match_all($patterns,$strs,$arr);
      $price = $arr[0][0];
      if (is_numeric($price)) {
          $decorate_list[$key]['price'] = str_replace($price,"<span>".$price."</span>",$decorate['price']);
      }else{
          $decorate_list[$key]['price'] = $decorate['price'];
      }
    }
    $code = count($decorate_list)?0:1;
    die(json_encode(array('code'=>$code,'data'=>$decorate_list,'message'=>'数据获取成功')));
  }

  // 套餐详情页数据
  public function package_detail(){
    $id = $GLOBALS['id'];
    if (!$id) {
      die(json_encode(array('code'=>1,'message'=>'获取ID失败')));
    }
    $package_detail = $this->db->get_one('block_product_detail',array('id'=>$id),'id,price,product_type,m_package_photos,introduce_photo,remark,company_name,company_id,label,three');
    // 装修图片
    $package_detail['m_package_photos'] = explode(',', trim($package_detail['m_package_photos'],','));
    foreach ($package_detail['m_package_photos'] as $key => $value) {
        $package_detail['m_package_photos'][$key] = getImgShow($value , 'original');
    }
    // 说明图片
    $package_detail['introduce_photo'] = explode(',', trim($package_detail['introduce_photo'],','));
    foreach ($package_detail['introduce_photo'] as $key => $value) {
        $package_detail['introduce_photo'][$key] = getImgShow($value , 'original');
    }
    // 套餐类型
    $package_detail['product_type'] = $this->product_type[$package_detail['product_type']];

    // 标签
    $label = trim($package_detail['label'],',');//去除标签两端的 “,”
    $package_detail['label'] = explode(',', $label);//将标签分割成数组

    // 处理 承诺、保证、服务 3个字段
    $three = trim($package_detail['three'],'+=+');
    $three = explode('+=+', $three);//分割three字段(承诺、保证、服务)
    $package_detail['promise'] = $three[0];//承诺
    $package_detail['ensure'] = $three[1];//保证
    $package_detail['service'] = $three[2];//服务
    unset($package_detail['three']);//删除无用字段
    // 装修公司
    if (!$package_detail['company_name']) {
        $company = $this->db->get_one('company', array('id' => $package_detail['company_id']),'title');
        $package_detail['company'] = $company['title'];//获取装修公司
    }else{
        $package_detail['company'] = $package_detail['company_name'];//获取装修公司
    }
    unset($package_detail['company_name']);
    // 获取是否收藏
    // 获取用户id
    $uid = get_cookie('_uid');
    if ($uid) {//登录状态
        $res = $this->db->get_one('favorite',array('uid'=>$uid,'keyid'=>$id,'type'=>17));
        $package_detail['collect'] = count($res)?1:0;
    }else{//未登录状态
        $package_detail['collect'] = 0;
    }
    $source = 'M站-套餐详情页';//订单来源
    // 将结果返回前端
    die(json_encode(array('code'=>0,'data'=>$package_detail,'message'=>'获取成功')));
  }

  // 装修套餐收藏
  public function collect_package() {
    // 获取用户id
    $uid = get_cookie('_uid');
    if (!$uid) {
      die(json_encode(array('code'=>1,'message'=>'您还未登录')));
    }
    $id = intval($GLOBALS['id']);
    if(!$id){
      die(json_encode(array('code'=>2,'message'=>'收藏失败')));
    }
    $type = 17;//收藏类型为套餐
    // 查询是否收藏过该套餐
    $is_collect = $this->db->get_one('favorite', array('uid' => $uid,'type'=>$type,'keyid'=>$id));
    if(!$is_collect) {//未收藏过 进行收藏操作
        $package = $this->db->get_one('block_product_detail', array('id'=>$id),'title');
        if(!$package){
          die(json_encode(array('code'=>3,'message'=>'该套餐不存在')));
        }
        $formdata = array();
        $formdata['type'] = $type;//收藏的类型
        $formdata['title'] = $package['title'];//收藏套餐的标题
        $formdata['url'] = WEBURL."index.php?m=content&f=index&v=product_detail&id={$id}";//收藏套餐的详情页地址
        $formdata['addtime'] = time();//收藏时间
        $formdata['uid'] = $uid;//用户id
        $formdata['keyid'] = $id;//收藏套餐的id
        $this->db->insert('favorite', $formdata);
        die(json_encode(array('code'=>0,'message'=>'收藏成功','collect'=>1)));
    } else {//收藏过  进行取消收藏操作
        $this->db->delete('favorite', array('fid'=>$is_collect['fid']));
        die(json_encode(array('code'=>0,'message'=>'取消收藏成功','collect'=>0)));
    }
  }

  // 首页  精选套餐
  public function package_good(){
    $where = "show_m_homepage=1 and city like '%,{$this->cityid},%'";//在M站首页显示的装修套餐
    $packages = $this->db->get_list('block_product_detail',$where,'id,m_package_photos,price,product_type,title',0,2,0,'intervene desc');
    $patterns = "/\d+(\.\d+)?/";
    foreach ($packages as $key => $package) {
      // 封面图(m_package_photos字段的第一个图片)
      $m_package_photos = explode(',', trim($package['m_package_photos'],','));
      $packages[$key]['m_package_photos'] = getImgShow($m_package_photos[0] , 'original');
      // 套餐类型
      $packages[$key]['product_type'] = $this->product_type[$package['product_type']];
      // 标题
      $packages[$key]['remark'] = $package['title'];

      $strs = $package['price'];
      preg_match_all($patterns,$strs,$arr);
      $price = $arr[0][0];
      if (is_numeric($price)) {
          $packages[$key]['price'] = str_replace($price,"<span>".$price."</span>",$package['price']);
      }else{
          $packages[$key]['price'] = $decorate['price'];
      }
    }
    die(json_encode(array('code'=>0,'data'=>$packages,'message'=>'请求成功')));
  }

  // 我的收藏  装修套餐
  public function my_collect_package(){
    $uid = get_cookie('_uid');//用户id
    if(!$uid){
      die(json_encode(array('code'=>1,'message'=>'未登录')));
    }
    // 获取该用户收藏的装修套餐
    $collect_packages = $this->db->get_list('favorite',array('uid'=>$uid,'type'=>17),'keyid');
    if(!$collect_packages){//没有收藏
      die(json_encode(array('code'=>0,'data'=>$collect_packages)));
    }
    // 获取该用户收藏的装修套餐的id，并以 “,” 的形式链接
    $ids = '';
    foreach ($collect_packages as $key => $package) {
      $ids .= ','.$package['keyid'];
    }
    $ids = trim($ids,',');
    // 查询该用户收藏的装修套餐的详细信息
    $where = "id in ({$ids})";
    // 查询数据
    $packages = $this->db->get_list('block_product_detail',$where,'id,m_package_photos,spreadhead,title,product_type,price,signup',0,10,$page);
    if ($packages) {
        $patterns = "/\d+(\.\d+)?/";
    }
    foreach ($packages as $key => $decorate) {
      //套餐类型
      $packages[$key]['product_type'] = $this->product_type[$decorate['product_type']]['name'];
      // 标题
      $packages[$key]['spreadhead'] = $decorate['title'];

      $strs = $decorate['price'];
      preg_match_all($patterns,$strs,$arr);
      $price = $arr[0][0];
      if (is_numeric($price)) {
          $packages[$key]['price'] = str_replace($price,"<span>".$price."</span>",$decorate['price']);
      }else{
          $packages[$key]['price'] = $decorate['price'];
      }
      
      //封面图(m_package_photos字段的第一个图片)
      $product_photos = trim($decorate['m_package_photos'],',');
      $product_photos = explode(',', $product_photos);
      $packages[$key]['m_package_photos'] = getImgShow($product_photos[0] , 'original');
    }
    die(json_encode(array('code'=>0,'data'=>$packages)));
  }

  // 装修套餐条件接口
  public function package_condition(){
      $package_money = array(
          0=>array(
              'name'=>'全部',
              'value'=>0
          ),
          1=>array(
              'name'=>'0-499元/㎡',
              'value'=>1
          ),
          2=>array(
              'name'=>'500-799元/㎡',
              'value'=>2
          ),
          3=>array(
              'name'=>'799元/㎡以上',
              'value'=>3
          )
      );

      $package_type = $this->product_type;
      die(json_encode(array('code'=>1,'data'=>array('money'=>$package_money,'type'=>$package_type))));
  }
}