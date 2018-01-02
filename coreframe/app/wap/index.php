<?php
// +----------------------------------------------------------------------
// | wuzhicms [ 五指互联网站内容管理系统 ]
// | Copyright (c) 2014-2015 http://www.wuzhicms.com All rights reserved.
// | Licensed ( http://www.wuzhicms.com/licenses/ )
// | Author: wangcanjia <phpip@qq.com>
// +----------------------------------------------------------------------
header("content-type:text/html;charset=utf-8");
defined('IN_WZ') or exit('No direct script access allowed');
/**
 * 首页
 */
load_class('foreground', 'member');
//按数组某一字段排序
function compare($x,$y)
  { 
    if($x['intervene'] == $y['intervene']) 
     return 0; 
    elseif($x['intervene'] < $y['intervene']) 
     return 1; 
    else 
     return -1; 
  } 
class index extends WUZHI_foreground {
	function __construct() {
        $this->member = load_class('member', 'member');
        load_function('common', 'member');
        $this->member_setting = get_cache('setting', 'member');
        parent::__construct();
	}

/**
 *GPS定位
 **/
private static $_instance;
        const REQ_GET = 1;
        const REQ_POST = 2;
    private function async($url, $params = array(), $encode = true, $method = self::REQ_GET)
         {
         $ch = curl_init();
          if ($method == self::REQ_GET)
          {
           $url = $url . '?' . http_build_query($params);
           $url = $encode ? $url : urldecode($url);
           curl_setopt($ch, CURLOPT_URL, $url);
          }
           else
          {
           curl_setopt($ch, CURLOPT_URL, $url);
           curl_setopt($ch, CURLOPT_POST, true);
           curl_setopt($ch, CURLOPT_POSTFIELDS, $params);
          }
          curl_setopt($ch, CURLOPT_REFERER, '百度地图referer');
          curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (iPhone; CPU iPhone OS 7_0 like Mac OS X; en-us) AppleWebKit/537.51.1 (KHTML, like Gecko) Version/7.0 Mobile/11A465 Safari/9537.53');
          curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
          $resp = curl_exec($ch);
          curl_close($ch);
          return $resp;
    }
/**
  * GPS定位
  * @param $lng
  * @param $lat
  * @return array
  * @throws Exception
  */
    public function locationByGPS(){
      //$lat = 53.48;
      //$lng = 122.37;
      $lng = $GLOBALS['lng'];
      $lat = $GLOBALS['lat'];
      $params = array(
        'coordtype' => 'wgs84ll',
        //'location' => '39.88,116.43',
        'location' => $lat . ',' . $lng,
        'ak' => 'BiYl0zyGXDl3E67wPxyGYGyP',
        'output' => 'json',
        'pois' => 0,
      );
      $resp = $this->async('http://api.map.baidu.com/geocoder/v2/', $params, false);
      $data = json_decode($resp, true);
      //var_dump($resp);
      if ($data['status'] != 0)
      {
       throw new Exception($data['message']);
      }
      $arr=array(
        'address' => $data['result']['formatted_address'],
        'province' => $data['result']['addressComponent']['province'],
        'city' => $data['result']['addressComponent']['city'],
        'street' => $data['result']['addressComponent']['street'],
        'street_number' => $data['result']['addressComponent']['street_number'],
        'city_code'=>$data['result']['cityCode'],
        'lng'=>$data['result']['location']['lng'],
        'lat'=>$data['result']['location']['lat']
      );
      $city = $arr['city'];
            $city_area =array('北京市'=>0,'上海市'=>1,'广州市'=>2,'深圳市'=>3,'杭州市'=>4,'天津市'=>5,'西安市'=>6,'南京市'=>7,'武汉'=>8,'郑州'=>9,'成都'=>10);
            $city_config =  get_config('city_config');
            $citys =$city_area[$city];
            $cityid=$city_config[$citys];
            if($cityid){
               echo json_encode(array('code'=>1,'data'=>$cityid,'message'=>'开通城市','process_time'=>time())); exit;
            }else{
               echo json_encode(array('code'=>1,'data'=>$arr,'message'=>'未开通城市','process_time'=>time())); exit;
            }
    }   
    /**
     * M站首页城市切换
     */
    public function init() {
       
        $city_config =get_config('city_config');

        $arr=array(
             'ktcity'=>$city_config,
            );
        return $arr;
    }

    /**
     *专题封面图
     **/
    public function Topics_cover(){
        $where = 'status=1';
        $res = $this->db->get_list('m_special',$where,'special,address', 0, 6, $page,'intervene DESC,id DESC');
        $photos=array();
        foreach ($res as $key => $re) {
         $photos[$key]['special']=getMImgShow($re['special'],'original');
         $photos[$key]['address']=$re['address'];      
         }    
        return $photos;
    }
    /**
     *首页工地直播推荐
     **/
    public function tuijian_log(){
      if(!empty($GLOBALS['cityid'])){
        $cityid=$GLOBALS['cityid'];
      }else{
        $cityid =$_COOKIE['cityid'];
        if(empty($cityid)){
          $cityid=3360;
        }
      }
      //$cityid=3360;
      
      if($cityid){
        $where='areaid_2="'.$cityid.'"';
        $log_rs = array();
            $query = $this->db->query("select * from wz_day_log_demand_list where areaid_2 is not null and orderid >13087 and nodeid >10 and nodeid!=10000 and nodename!='预约量房' order by (case when ".$where." then 1 else 0 end) desc,log_intervene DESC,addtime DESC limit 0,4;");
            
        while($data = $this->db->fetch_array($query)) {
          $log_rs[] = $data;
          }
        $arr=array();
        $arrs=array();
        foreach ($log_rs as $key => $value) {
          $arrs[$key]['result'] = unserialize($value['recphoto']);
          $arrs[$key]['results']= unserialize($value['sitephoto']);
          $logname=$value['logname'];
          $res=mb_strlen($logname);
           //echo "<pre>";print_r($res);exit;
                if($res>22){
                $arr[$key]['logname']=mb_substr($logname, 0, 11,'utf-8').'...';
                }else{
                $arr[$key]['logname']=$logname;
                }
          $arr[$key]['nodename']=$value['nodename'];
          $arr[$key]['orderid']=$value['orderid'];
          $aaa=array_filter($arrs[$key]['result']);
          $arrs[$key]['photo']=array_slice($aaa,-1,1);
          $bbb=array_filter($arrs[$key]['results']);
          $arrs[$key]['photos']=array_slice($bbb,-1,1);
          if( $arrs[$key]['photo']){
            if (is_array($arrs[$key]['result'][0])) {
                $keys = array_keys($arrs[$key]['result'][0]);
              if($arrs[$key]['result'][0][$keys[0]][0]){
                $arr[$key]['recphoto']='http://www.uzhuang.com/image/pic_230/'.$arrs[$key]['result'][0][$keys[0]][0];
                }
                }else{
                $arr[$key]['recphoto'] ='http://www.uzhuang.com/image/pic_230/'.$arrs[$key]['photo'][0];
                } 
          }else{
              $arr[$key]['recphoto']=1;
          }  
          if($arrs[$key]['photos']){
              if(is_array($arrs[$key]['results'][0])){
                    $keys = array_keys($arrs[$key]['results'][0]);
                if($arrs[$key]['results'][0][$keys[0]][0]){
                    $arr[$key]['sitephoto']='http://www.uzhuang.com/image/pic_230/'.$arrs[$key]['results'][0][$keys[0]][0];
                    }
                    }else{
                    $arr[$key]['sitephoto']='http://www.uzhuang.com/image/pic_230/'.$arrs[$key]['photos'][0];
              }
          }
        }
        //echo "<pre>";print_r($arr);exit;
        echo json_encode(array('code'=>1,'data'=>$arr,'message'=>'工地直播推荐','process_time'=>time()));exit;
      }else{
          echo json_encode(array('code'=>0,'data'=>null,'message'=>'cookie里城市定位cityid不存在','process_time'=>time()));exit;
      }
    }

    /**
     *城市cityid存入cookie里
     **/
    public function qhcspi(){
        $cityid = $GLOBALS['cityid'];
        setcookie('cityid',$cityid);
        echo json_encode(array('code'=>1,'data'=>null,'message'=>'','process_time'=>time())); exit;
    }

    /**
     *轮播图
     **/
    public function shuffl_photo(){
        $shuffl = empty($GLOBALS['shuffl'])?'':mysql_real_escape_string($GLOBALS['shuffl']);
        if( $shuffl){
        $where = "status=1 and`city`='".$shuffl."'";
        $rs = $this->db->get_list('m_carousel',$where, 'carousel,address', 0, 3, $page, 'intervene DESC,id DESC');
        $photo=array();
        foreach ($rs as $key => $rc) {
        $photo[$key]['carousel']=getMImgShow($rc['carousel'],'original');
        $photo[$key]['address']=$rc['address'];
        }
       echo json_encode(array('code'=>1,'data'=>$photo,'message'=>'','process_time'=>time()));exit;
       }else{
       echo json_encode(array('code'=>0,'data'=>null,'message'=>'参数错误','process_time'=>time()));exit;
       }
    }

    /**
     *首页入口
     **/
    public function index(){
            $return = array(
    		'init'=>$this->init(),
            'Topics_cover'=>$this->Topics_cover(),
    		);
    	 echo json_encode(array('code'=>1,'data'=>$return,'message'=>'','process_time'=>time()));exit;
    }

    public function tjw_picture()
    {
          $cityid=empty($GLOBALS['cityid'])?'':mysql_escape_string($GLOBALS['cityid']);
          if(!empty($cityid))
           {
                   $result=$this->db->get_list('tjw_picture',"city ='".$cityid."' and status=1",'cover,address', 0, 3, $page, 'intervene DESC,updatetime DESC');
                  foreach ($result as $key => $value) {
                       $result[$key]['cover']=getMImgShow($value['cover'],'original');
                  }
          }
       // echo '<pre>';print_r($result);exit;
       echo json_encode(array('code'=>1,'data'=>$result,'message'=>'推荐位-装修案例的数据','process_time'=>time()));

    }

    public function tjw_company(){
       $cityid=$GLOBALS['cityid'];
       $company2=array();
       $company1=array();
       $companys=array();
       $company_finally=array();
       if(isset($cityid)&&!empty($cityid)){
                $picture=$this->db->get_list('m_picture','`status`=1','companyid',0,100000,$page,'id desc','companyid');
                foreach ($picture as $keyp => $valuep) {

                    $where="`areaid_2`= '".$cityid."' AND `id`='".$valuep['companyid']."' AND `status`=9";
                    $company=$this->db->get_one('m_company',$where,"id,thumb,title,tese,avg_total,designnum,photonum,intervene");
                    $companyz=$this->db->get_one('company',$where,"avg_total");   
                    $companys[]=$companyz['avg_total'];   
                    $company2[]=$company;
                } 
                $companys=array_filter($companys);
                $company2=array_filter($company2);
               foreach ($company2 as $keyc => $valuec) {
                      if($companys[$keyc]['avg_total']==0){
                        $companys[$keyc]['avg_total']=5;
                      }
                      $company2[$keyc]['avg_total']=$companys[$keyc]['avg_total'];
                      $company2[$keyc]['companylogo']='http://www.uzhuang.com/image/big_square/'.$valuec['thumb'];
               }
                $companyss=count($company2);
                if($companyss<8){
                  $picture=$this->db->get_list('m_picture','`status`=1','companyid',0,100000,$page,'id desc','companyid');
                  foreach ($picture as $keyp => $valuep) {
                      $where="areaid_2!= '".$cityid."' AND `id`='".$valuep['companyid']."' AND `status`=9";
                      $company=$this->db->get_one('m_company',$where,"id,thumb,title,tese,avg_total,designnum,photonum,intervene");
                      $companyz=$this->db->get_one('company',$where,"avg_total");   
                      $companys[]=$companyz['avg_total'];   
                      $company1[]=$company;
                  } 
                  $companys=array_filter($companys);
                  $company1=array_filter($company1);
                  foreach ($company1 as $keyc => $valuec) {
                          if($companys[$keyc]['avg_total']==0){
                            $companys[$keyc]['avg_total']=5;
                          }
                          $company1[$keyc]['avg_total']=$companys[$keyc]['avg_total'];
                          $company1[$keyc]['companylogo']='http://www.uzhuang.com/image/big_square/'.$valuec['thumb'];
                  }
                  $company2=array_merge($company2,$company1);      
                }

       }else{
                $picture=$this->db->get_list('m_picture','`status`=1','companyid',0,100000,$page,'id desc','companyid');
                foreach ($picture as $keyp => $valuep) {

                    $where="`areaid_2`= 3360 AND `id`='".$valuep['companyid']."' AND `status`=9";
                    $company=$this->db->get_one('m_company',$where,"id,thumb,title,tese,avg_total,designnum,photonum,intervene");
                     $companyz=$this->db->get_one('company',$where,"avg_total");  
                  
                    $companys[]=$companyz['avg_total'];  
                    $company2[]=$company;
                } 
                $companys=array_filter($companys);
                $company2=array_filter($company2);
               foreach ($company2 as $keyc => $valuec) {
                      if($companys[$keyc]['avg_total']==0){
                        $companys[$keyc]['avg_total']=5;
                      }
                      $company2[$keyc]['avg_total']=$companys[$keyc]['avg_total'];

                      $company2[$keyc]['companylogo']='http://www.uzhuang.com/image/big_square/'.$valuec['thumb'];
                }
                 $companyss=count($company2);
                if($companyss<8){
                  $picture=$this->db->get_list('m_picture','`status`=1','companyid',0,100000,$page,'id desc','companyid');
                  foreach ($picture as $keyp => $valuep) {
                      $where="areaid_2!=3360 AND `id`='".$valuep['companyid']."' AND `status`=9";
                      $company=$this->db->get_one('m_company',$where,"id,thumb,title,tese,avg_total,designnum,photonum,intervene");
                      $companyz=$this->db->get_one('company',$where,"avg_total");   
                      $companys[]=$companyz['avg_total'];   
                      $company1[]=$company;
                  } 
                  $companys=array_filter($companys);
                  $company1=array_filter($company1);
                  foreach ($company1 as $keyc => $valuec) {
                          if($companys[$keyc]['avg_total']==0){
                            $companys[$keyc]['avg_total']=5;
                          }
                          $company1[$keyc]['avg_total']=$companys[$keyc]['avg_total'];
                          $company1[$keyc]['companylogo']='http://www.uzhuang.com/image/big_square/'.$valuec['thumb'];
                  }
                  $company2=array_merge($company2,$company1);      
                }

       }
              $company2=array_values($company2);
               usort($company2,"compare"); 
               $c=count($company2);
                    // echo '<pre>';print_r($company2);exit;
               if($c>10){
                    for($i=0;$i<10;$i++){
                      $company_finally[$i]=$company2[$i];
                    }
                     
                echo json_encode(array('code'=>1,'data'=>$company_finally,'message'=>'口碑公司列表页的数据','process_time'=>time()));
               }else{
                // echo '<pre>';print_r($company2);exit;
                echo json_encode(array('code'=>1,'data'=>$company2,'message'=>'口碑公司列表页的数据','process_time'=>time()));
               }     
    }
}