<?php
// +----------------------------------------------------------------------
// | wuzhicms [ 五指互联网站内容管理系统 ]
// | Copyright (c) 2014-2015 http://www.wuzhicms.com All rights reserved.
// | Licensed ( http://www.wuzhicms.com/licenses/ )
// | Author: wangcanjia <phpip@qq.com>
// +----------------------------------------------------------------------
/**
 * 收藏夹
 */
header('Content-type:text/html;charset=utf-8');
header("Access-Control-Allow-Origin: *");
defined('IN_WZ') or exit('No direct script access allowed');
load_class('foreground', 'member');
class calculator extends WUZHI_foreground {
    // 填写面积带出的户型              
 	  public function house(){
          $area=remove_xss($GLOBALS['area']);
          $house='';
          switch ($area) {
             case $area<=30:
                  $house=array('shi'=>1,'ting'=>0,'chu'=>1,'wei'=>1,'yt'=>1);
               break;
               case $area>30&&$area<=60:
                  $house=array('shi'=>1,'ting'=>1,'chu'=>1,'wei'=>1,'yt'=>1);
              break;
              case $area>60&&$area<=80:
                  $house=array('shi'=>2,'ting'=>1,'chu'=>1,'wei'=>1,'yt'=>1);
              break;
              case $area>80&&$area<=120:
                  $house=array('shi'=>3,'ting'=>1,'chu'=>1,'wei'=>2,'yt'=>1);
              break;
              case $area>120&&$area<=160:
                  $house=array('shi'=>3,'ting'=>2,'chu'=>1,'wei'=>2,'yt'=>1);
              break;
              case $area>160:
                  $house=array('shi'=>4,'ting'=>2,'chu'=>1,'wei'=>2,'yt'=>1);
              break;
          }
        echo json_encode(array('code'=>1,'data'=>$house,'message'=>'M站计算器列表户型','process_time'=>time()));
    }
   // 开始计算 面积 area 城市 city
   public function start_calculate($area,$city){
          // 建筑面积
          $area=$area;
          // 使用面积
          $pro=$this->db->get_one('c_area_coefficient',"`proportion_type`=1",'proportion_value');
          $use_area=$area*(float)$pro['proportion_value'];
          // 城市
          $city=$city;
          // 城市系数
          $xs=$this->db->get_one('c_area_coefficient',"`proportion_type`=2",'proportion_value');
          $city_xs=unserialize($xs['proportion_value']);
          $city_xs=$city_xs[$city];
          switch ($area) {
              case $area<=30:
                  $house='1|0|1|1|1';
                  $pro_id=$this->db->get_one('c_proportion',"`house_type`='".$house."' and `type`=2");
                  if($pro_id)//后台存在的数据
                    {
                        // 地面系数
                        $ground=$this->db->get_list('c_proportion_details',"`proportion_id`='".$pro_id['id']."' and `space_value`!=0 and `area_type`=1");
                        $wall=$this->db->get_list('c_proportion_details',"`proportion_id`='".$pro_id['id']."' and `space_value`!=0 and `area_type`=2");
                        $arr=array();
                        foreach ($ground as $key => $value) {
                            foreach ($wall as $k => $v) {
                                if($value['space_id']==$v['space_id']){
                                     $spa=$this->db->get_one('c_space',"`id`='".$v['space_id']."'");
                                     $arr[$k]['space']=$spa['space'];
                                     $arr[$k]['ground_value']=$value['space_value'];
                                     $arr[$k]['wall_value']=$v['space_value'];
                                }
                            }
                        }
                        $array=array();
                        foreach ($arr as $key => $value) {
                          if($value['space']!='其他'){
                            $array[$value['space']]=$this->space_data($value['space'],$use_area,$value['ground_value'],$value['wall_value'],$city_xs);
                          }
                        }
                        $array['其他']=$this->space_data('其他',$use_area,$value['ground_value'],$value['wall_value'],$city_xs);
                        $array=array(
                             'area'=>$area,
                             'use_area'=>sprintf('%.1f',$use_area),
                             'house'=>array('室'=>1,'厅'=>0,'橱'=>1,'卫'=>1,'阳台'=>1),
                             'data'=>$array,
                          );
                     }
                  return $array;
              break;
              case $area>30&&$area<=60:
                  $house='1|1|1|1|1';
                  $pro_id=$this->db->get_one('c_proportion',"`house_type`='".$house."' and `type`=2");
                  if($pro_id)//后台存在的数据
                    {
                        // 地面系数
                        $ground=$this->db->get_list('c_proportion_details',"`proportion_id`='".$pro_id['id']."' and `space_value`!=0 and `area_type`=1");
                        $wall=$this->db->get_list('c_proportion_details',"`proportion_id`='".$pro_id['id']."' and `space_value`!=0 and `area_type`=2");
                        $arr=array();
                        foreach ($ground as $key => $value) {
                            foreach ($wall as $k => $v) {
                                if($value['space_id']==$v['space_id']){
                                     $spa=$this->db->get_one('c_space',"`id`='".$v['space_id']."'");
                                     $arr[$k]['space']=$spa['space'];
                                     $arr[$k]['ground_value']=$value['space_value'];
                                     $arr[$k]['wall_value']=$v['space_value'];
                                }
                            }
                        }
                        // echo '<pre>';print_r($arr);exit;
                        $array=array();
                        foreach ($arr as $key => $value) {
                          if($value['space']!='其他'){
                            $array[$value['space']]=$this->space_data($value['space'],$use_area,$value['ground_value'],$value['wall_value'],$city_xs);
                          }  
                        }
                        $array['其他']=$this->space_data('其他',$use_area,$value['ground_value'],$value['wall_value'],$city_xs);
                        $array=array(
                             'area'=>$area,
                             'use_area'=>sprintf('%.1f',$use_area),
                             'house'=>array('室'=>1,'厅'=>1,'橱'=>1,'卫'=>1,'阳台'=>1),
                             'data'=>$array,
                          );
                     }

                  return $array;
              break;
              case $area>60&&$area<=80:
                  $house='2|1|1|1|1';
                   $pro_id=$this->db->get_one('c_proportion',"`house_type`='".$house."' and `type`=2");
                  if($pro_id)//后台存在的数据
                    {
                        // 地面系数
                        $ground=$this->db->get_list('c_proportion_details',"`proportion_id`='".$pro_id['id']."' and `space_value`!=0 and `area_type`=1");
                        $wall=$this->db->get_list('c_proportion_details',"`proportion_id`='".$pro_id['id']."' and `space_value`!=0 and `area_type`=2");
                        $arr=array();
                        foreach ($ground as $key => $value) {
                            foreach ($wall as $k => $v) {
                                if($value['space_id']==$v['space_id']){
                                     $spa=$this->db->get_one('c_space',"`id`='".$v['space_id']."'");
                                     $arr[$k]['space']=$spa['space'];
                                     $arr[$k]['ground_value']=$value['space_value'];
                                     $arr[$k]['wall_value']=$v['space_value'];
                                }
                            }
                        }
                        $array=array();
                        foreach ($arr as $key => $value) {
                          if($value['space']!='其他'){
                            $array[$value['space']]=$this->space_data($value['space'],$use_area,$value['ground_value'],$value['wall_value'],$city_xs);
                          }
                        }
                        $array['其他']=$this->space_data('其他',$use_area,$value['ground_value'],$value['wall_value'],$city_xs);
                        $array=array(
                             'area'=>$area,
                             'use_area'=>sprintf('%.1f',$use_area),
                             'house'=>array('室'=>2,'厅'=>1,'橱'=>1,'卫'=>1,'阳台'=>1),
                             'data'=>$array,
                          );
                      }
                    // echo '<pre>';print_r($array);exit;
                  return $array;
              break;
              case $area>80&&$area<=120:
                  $house='3|1|1|2|1';
                  $pro_id=$this->db->get_one('c_proportion',"`house_type`='".$house."' and `type`=2");
                  if($pro_id)//后台存在的数据
                    {
                        // 地面系数
                        $ground=$this->db->get_list('c_proportion_details',"`proportion_id`='".$pro_id['id']."' and `space_value`!=0 and `area_type`=1");
                        $wall=$this->db->get_list('c_proportion_details',"`proportion_id`='".$pro_id['id']."' and `space_value`!=0 and `area_type`=2");
                        $arr=array();
                        foreach ($ground as $key => $value) {
                            foreach ($wall as $k => $v) {
                                if($value['space_id']==$v['space_id']){
                                     $spa=$this->db->get_one('c_space',"`id`='".$v['space_id']."'");
                                     $arr[$k]['space']=$spa['space'];
                                     $arr[$k]['ground_value']=$value['space_value'];
                                     $arr[$k]['wall_value']=$v['space_value'];
                                }
                            }
                        }
                        $array=array();
                        foreach ($arr as $key => $value) {
                          if($value['space']!='其他'){
                            $array[$value['space']]=$this->space_data($value['space'],$use_area,$value['ground_value'],$value['wall_value'],$city_xs);
                          }
                        }
                        $array['其他']=$this->space_data('其他',$use_area,$value['ground_value'],$value['wall_value'],$city_xs);
                        $array=array(
                             'area'=>$area,
                             'use_area'=>sprintf('%.1f',$use_area),
                             'house'=>array('室'=>3,'厅'=>1,'橱'=>1,'卫'=>2,'阳台'=>1),
                             'data'=>$array,
                          );
                     }
                  return $array;
              break;
              case $area>120&&$area<=160:
                  $house='3|2|1|2|1';
                   $pro_id=$this->db->get_one('c_proportion',"`house_type`='".$house."' and `type`=2");
                  if($pro_id)//后台存在的数据
                    {
                        // 地面系数
                        $ground=$this->db->get_list('c_proportion_details',"`proportion_id`='".$pro_id['id']."' and `space_value`!=0 and `area_type`=1");
                        $wall=$this->db->get_list('c_proportion_details',"`proportion_id`='".$pro_id['id']."' and `space_value`!=0 and `area_type`=2");
                        $arr=array();
                        foreach ($ground as $key => $value) {
                            foreach ($wall as $k => $v) {
                                if($value['space_id']==$v['space_id']){
                                     $spa=$this->db->get_one('c_space',"`id`='".$v['space_id']."'");
                                     $arr[$k]['space']=$spa['space'];
                                     $arr[$k]['ground_value']=$value['space_value'];
                                     $arr[$k]['wall_value']=$v['space_value'];
                                }
                            }
                        }
                        $array=array();
                        foreach ($arr as $key => $value) {
                          if($value['space']!='其他'){
                            $array[$value['space']]=$this->space_data($value['space'],$use_area,$value['ground_value'],$value['wall_value'],$city_xs);
                          }
                        }
                        $array['其他']=$this->space_data('其他',$use_area,$value['ground_value'],$value['wall_value'],$city_xs);
                        $array=array(
                             'area'=>$area,
                             'use_area'=>sprintf('%.1f',$use_area),
                             'house'=>array('室'=>3,'厅'=>2,'橱'=>1,'卫'=>2,'阳台'=>1),
                             'data'=>$array,
                          );
                      }
                  return $array;
              break;
              case $area>160:
                  $house='4|2|1|2|1';
                   $pro_id=$this->db->get_one('c_proportion',"`house_type`='".$house."' and `type`=2");
                  if($pro_id)//后台存在的数据
                    {
                        // 地面系数
                        $ground=$this->db->get_list('c_proportion_details',"`proportion_id`='".$pro_id['id']."' and `space_value`!=0 and `area_type`=1");
                        $wall=$this->db->get_list('c_proportion_details',"`proportion_id`='".$pro_id['id']."' and `space_value`!=0 and `area_type`=2");
                        $arr=array();
                        foreach ($ground as $key => $value) {
                            foreach ($wall as $k => $v) {
                                if($value['space_id']==$v['space_id']){
                                     $spa=$this->db->get_one('c_space',"`id`='".$v['space_id']."'");
                                     $arr[$k]['space']=$spa['space'];
                                     $arr[$k]['ground_value']=$value['space_value'];
                                     $arr[$k]['wall_value']=$v['space_value'];
                                }
                            }
                        }
                        $array=array();
                        foreach ($arr as $key => $value) {
                          if($value['space']!='其他'){
                            $array[$value['space']]=$this->space_data($value['space'],$use_area,$value['ground_value'],$value['wall_value'],$city_xs);
                          }
                        }
                        $array['其他']=$this->space_data('其他',$use_area,$value['ground_value'],$value['wall_value'],$city_xs);
                        $array=array(
                             'area'=>$area,
                             'use_area'=>sprintf('%.1f',$use_area),
                             'house'=>array('室'=>4,'厅'=>2,'橱'=>1,'卫'=>2,'阳台'=>1),
                             'data'=>$array,
                          );
                      }
                  return $array;
              break;
          }
   }
    // 各空间数据
   public function space_data($spa,$use_area,$ground,$wall,$city_xs,$area_ratio=false){
              if($spa=='其他'){
                    // 空间id
                    $space=$this->db->get_one('c_space',"`space`='".$spa."'",'id');
                    // 地面数据
                    $qt=$this->db->get_list('c_space_details',"`space_id`='".$space['id']."' and `space_project`='其他'",'*');
                    $qt_total='';
                    foreach ($qt as $key => $value) {
                       $qt[$key]['total_price']=$value['unit_price']*$city_xs*1; 
                       $qt_total+=$qt[$key]['total_price'];
                    }
                    $arr=array(
                          '其他'=>array(
                             'area'=>'1.0',
                             'data'=>$qt,
                             'total'=>$qt_total,
                            ),
                      );
               }else{
                    // 空间id
                    $space=$this->db->get_one('c_space',"`space`='".$spa."'",'id');
                    // 地面工程量
                    if($area_ratio==true){
                      $area_dm=$use_area;
                    }else{
                      $area_dm=$use_area*$ground;
                    }
                    // 地面数据
                    $dm=$this->db->get_list('c_space_details',"`space_id`='".$space['id']."' and `space_project`='地面'",'*');
                    $dm_total='';
                    foreach ($dm as $key => $value) {
                       if($value['project']=='铺过门石'){
                         $dm[$key]['total_price']=$value['unit_price']*$city_xs*1; 
                       }else{
                         $dm[$key]['total_price']=$value['unit_price']*$city_xs*$area_dm;
                       }
                       $dm_total+=$dm[$key]['total_price'];
                    }
                    // 墙面工程量
                    $area_qm=$area_dm*$wall;
                    // 墙面数据
                    $qm=$this->db->get_list('c_space_details',"`space_id`='".$space['id']."' and `space_project`='墙面'",'*');
                    $qm_total='';
                    foreach ($qm as $key => $value) {
                       if($value['project']=='包立管'){
                           $qm[$key]['total_price']=$value['unit_price']*$city_xs*1;
                       }else{
                           $qm[$key]['total_price']=$value['unit_price']*$city_xs*$area_qm;
                       }
                       $qm_total+=$qm[$key]['total_price'];
                    }
                    // 天花工程量
                    $area_th=$area_dm;
                    // 天花数据
                    $th=$this->db->get_list('c_space_details',"`space_id`='".$space['id']."' and `space_project`='天花'",'*');
                    $th_total='';
                    foreach ($th as $key => $value) {
                       $th[$key]['total_price']=$value['unit_price']*$city_xs*$area_th;
                       $th_total+=$th[$key]['total_price'];
                    }
                    $area_mc='';
                    $mc='';
                    $mc_total='';
                    if($spa!='餐厅'||$spa!='阳台'||$spa!='其他'){
                        // 门窗工程量
                        $area_mc='1.00';
                        // 门窗数据
                        $mc=$this->db->get_list('c_space_details',"`space_id`='".$space['id']."' and `space_project`='门窗'",'*');
                        foreach ($mc as $key => $value) {
                          $mc[$key]['total_price']=$value['unit_price']*$city_xs*$area_mc;
                          $mc_total+=$mc[$key]['total_price'];
                        }
                    }
                    $arr=array(
                        '地面'=>array(
                           'area'=>$area_dm,
                           'data'=>$dm,
                           'total'=>$dm_total,
                          ),
                        '墙面'=>array(
                           'area'=>$area_qm,
                           'data'=>$qm,
                           'total'=>$qm_total,
                          ),
                        '天花'=>array(
                           'area'=>$area_th,
                           'data'=>$th,
                           'total'=>$th_total,
                           ),
                        '门窗'=>array(
                           'area'=>$area_mc,
                           'data'=>$mc,
                           'total'=>$mc_total,
                          )
                      );
              }
              // echo '<pre>';print_r($arr);exit;
              return $arr;
   }
   // 报价详情页
   public function quote_details(){
        if(!$GLOBALS['edit_area']){
            $area=remove_xss($GLOBALS['area']);
            $city=remove_xss($GLOBALS['city']);
            // 转换cityid
            $calculator_config=get_config('calculator_config');
            $city=$calculator_config[$city];
            // echo $city;exit;
            $total_price=0;
            // 城市系数
            $xs=$this->db->get_one('c_area_coefficient',"`proportion_type`=2",'proportion_value');
            $city_xs=unserialize($xs['proportion_value']);
            $city_xs=$city_xs[$city];
            // 使用面积
            $pro=$this->db->get_one('c_area_coefficient',"`proportion_type`=1",'proportion_value');
            $use_area=$area*(float)$pro['proportion_value'];
            $house=remove_xss($GLOBALS['house_type']);
            $house_type=explode('|',$house);
            $pro_id=$this->db->get_one('c_proportion',"`house_type`='".$house."' and `type`=1");
            if($pro_id)//后台存在的数据
              {
                  // 地面系数
                  $ground=$this->db->get_list('c_proportion_details',"`proportion_id`='".$pro_id['id']."' and `space_value`!=0 and `area_type`=1");
                  // 墙面系数
                  $wall=$this->db->get_list('c_proportion_details',"`proportion_id`='".$pro_id['id']."' and `space_value`!=0 and `area_type`=2");
                  $arr1=array();
                  foreach ($ground as $key => $value) {
                      foreach ($wall as $k => $v) {
                          if($value['space_id']==$v['space_id']){
                               $spa=$this->db->get_one('c_space',"`id`='".$v['space_id']."'");
                               $arr1[$k]['space']=$spa['space'];
                               $arr1[$k]['ground_value']=$value['space_value'];
                               $arr1[$k]['wall_value']=$v['space_value'];
                          }
                      }
                  }
                  // 排序
                  $arr3=array();
                  $res=$this->db->get_list('c_space','','*',0,200,0,'type asc,intervene desc');
                  foreach ($res as $key => $value) {
                     foreach ($arr1 as $k1 => $v1) {
                        if($v1['space']==$value['space']){
                            $arr3[$key]['space']=$v1['space'];
                            $arr3[$key]['ground_value']=$v1['ground_value'];
                            $arr3[$key]['wall_value']=$v1['wall_value'];
                        }
                     }
                  }
                  $array=array();
                  foreach ($arr3 as $key => $value) {
                    if($value['space']!='其他'){
                      $array[$value['space']]=$this->space_data($value['space'],$use_area,$value['ground_value'],$value['wall_value'],$city_xs);
                    }
                  }
                  $array['其他']=$this->space_data('其他',$use_area,$value['ground_value'],$value['wall_value'],$city_xs);
                  $data=array(
                       'area'=>$area,
                       'use_area'=>sprintf('%.1f',$use_area),
                       'city'=>$city,
                       'house'=>$house,
                       'data'=>$array,
                    );
                  $arr=explode('|',$data['house']);
                  foreach ($data['data'] as $key => $value) {
                      foreach ($value as $k => $v) {
                          // 单个空间的总价
                          $data['data'][$key]['total']+=$v['total'];
                      }
                  }
                  foreach ($data['data'] as $key => $value) {
                      $total_price+=$value['total'];
                  }
                    // 管理费
                    $manage_price=(float)$total_price*0.1;
                    $total_price=$total_price+$manage_price;
                         foreach ($data['data'] as $key => $value) {
                         if($key=='其他'){
                                   $data['data'][$key]['其他']['data'][]=array(
                                                  'id' => 393,
                                                  'space_id' => 25,
                                                  'space_project' => '其他',
                                                  'project' => '管理费',
                                                  'unit_price' => '/',
                                                  'craft_standard' =>'<p>实际按当地标准收取（管理费=直接费*管理费率）。</p>',
                                                  'total_price' => $manage_price,
                                    );
                                   $data['data'][$key]['其他']['total']=$value['其他']['total']+$manage_price;
                                   $data['data'][$key]['total']=$value['total']+$manage_price;
                                }
                         }
                  $data['total_price']=round($total_price);
             }else{//后台不存在时
                 switch ($house_type[0]) {
                   case 1:
                     $pro_id=$this->db->get_one('c_proportion',"`house_type`='".$house_type[0]."' and `type`=3");
                     if($pro_id){
                          // 地面系数
                          $ground=$this->db->get_list('c_proportion_details',"`proportion_id`='".$pro_id['id']."' and `space_value`!=0 and `area_type`=1");
                          // 墙面系数
                          $wall=$this->db->get_list('c_proportion_details',"`proportion_id`='".$pro_id['id']."' and `space_value`!=0 and `area_type`=2");
                          $arr2=array();
                          if($house_type[0]!=0){
                              $arr2[]=$this->db->get_list('c_space',"`type`='室'",'space',0,$house_type[0],0,'type asc,intervene desc');
                          }
                          if($house_type[1]!=0){
                              $arr2[]=$this->db->get_list('c_space',"`type`='厅'",'space',0,$house_type[1],0,'type asc,intervene desc');
                          }
                          if($house_type[2]!=0){
                              $arr2[]=$this->db->get_list('c_space',"`type`='橱'",'space',0,$house_type[2],0,'type asc,intervene desc');
                          }
                          if($house_type[3]!=0){
                              $arr2[]=$this->db->get_list('c_space',"`type`='卫'",'space',0,$house_type[3],0,'type asc,intervene desc');
                          }
                          if($house_type[4]!=0){
                              $arr2[]=$this->db->get_list('c_space',"`type`='阳台'",'space',0,$house_type[4],0,'type asc,intervene desc');
                          }
                          $arr3=array();
                          foreach ($arr2 as $key => $value) {
                            foreach ($value as $k => $v) {
                                $arr3[]=$v;
                            }
                          }
                          foreach ($arr3 as $k3 => $v3) {
                            foreach ($ground as $key => $value) {
                                foreach ($wall as $k => $v) {
                                    if($value['space_id']==$v['space_id']){
                                         $spa=$this->db->get_one('c_space',"`id`='".$v['space_id']."'");
                                       if($spa['space']==$v3['space']){
                                         $arr3[$k3]['space']=$spa['space'];
                                         $arr3[$k3]['ground_value']=$value['space_value'];
                                         $arr3[$k3]['wall_value']=$v['space_value'];
                                       }
                                    }
                                }
                            }
                          }
                          // echo '<pre>';print_r($arr3);exit;
                          $array=array();
                          foreach ($arr3 as $key => $value) {
                            if($value['space']!='其他'){
                              $array[$value['space']]=$this->space_data($value['space'],$use_area,$value['ground_value'],$value['wall_value'],$city_xs);
                            }
                          }
                          $array['其他']=$this->space_data('其他',$use_area,$value['ground_value'],$value['wall_value'],$city_xs);
                          $data=array(
                               'area'=>$area,
                               'use_area'=>sprintf('%.1f',$use_area),
                               'city'=>$city,
                               'house'=>$house,
                               'data'=>$array,
                          );
                          $arr=explode('|',$data['house']);
                          foreach ($data['data'] as $key => $value) {
                              foreach ($value as $k => $v) {
                                  // 单个空间的总价
                                  $data['data'][$key]['total']+=$v['total'];
                              }
                          }
                          foreach ($data['data'] as $key => $value) {
                              $total_price+=$value['total'];
                          }
                           // 管理费
                          $manage_price=(float)$total_price*0.1;
                          $total_price=$total_price+$manage_price;
                          // 总钱数
                          // $total_price1=sprintf('%.1f',$total_price/10000);
                               foreach ($data['data'] as $key => $value) {
                               if($key=='其他'){
                                         $data['data'][$key]['其他']['data'][]=array(
                                                        'id' => 393,
                                                        'space_id' => 25,
                                                        'space_project' => '其他',
                                                        'project' => '管理费',
                                                        'unit_price' => '/',
                                                        'craft_standard' =>'<p>实际按当地标准收取（管理费=直接费*管理费率）。</p>',
                                                        'total_price' => $manage_price,
                                          );
                                         $data['data'][$key]['其他']['total']=$value['其他']['total']+$manage_price;
                                         $data['data'][$key]['total']=$value['total']+$manage_price;
                                      }
                               }
                          $data['total_price']=round($total_price);
                         // echo '<pre>';print_r($data);exit; 
                     }
                     break;
                   case 2:
                     $pro_id=$this->db->get_one('c_proportion',"`house_type`='".$house_type[0]."' and `type`=3");
                     if($pro_id){
                          // 地面系数
                          $ground=$this->db->get_list('c_proportion_details',"`proportion_id`='".$pro_id['id']."' and `space_value`!=0 and `area_type`=1");
                          // 墙面系数
                          $wall=$this->db->get_list('c_proportion_details',"`proportion_id`='".$pro_id['id']."' and `space_value`!=0 and `area_type`=2");
                          $arr2=array();
                          if($house_type[0]!=0){
                              $arr2[]=$this->db->get_list('c_space',"`type`='室'",'space',0,$house_type[0],0,'type asc,intervene desc');
                          }
                          if($house_type[1]!=0){
                              $arr2[]=$this->db->get_list('c_space',"`type`='厅'",'space',0,$house_type[1],0,'type asc,intervene desc');
                          }
                          if($house_type[2]!=0){
                              $arr2[]=$this->db->get_list('c_space',"`type`='橱'",'space',0,$house_type[2],0,'type asc,intervene desc');
                          }
                          if($house_type[3]!=0){
                              $arr2[]=$this->db->get_list('c_space',"`type`='卫'",'space',0,$house_type[3],0,'type asc,intervene desc');
                          }
                          if($house_type[4]!=0){
                              $arr2[]=$this->db->get_list('c_space',"`type`='阳台'",'space',0,$house_type[4],0,'type asc,intervene desc');
                          }
                          $arr3=array();
                          foreach ($arr2 as $key => $value) {
                            foreach ($value as $k => $v) {
                                $arr3[]=$v;
                            }
                          }
                          foreach ($arr3 as $k3 => $v3) {
                            foreach ($ground as $key => $value) {
                                foreach ($wall as $k => $v) {
                                    if($value['space_id']==$v['space_id']){
                                         $spa=$this->db->get_one('c_space',"`id`='".$v['space_id']."'");
                                       if($spa['space']==$v3['space']){
                                         $arr3[$k3]['space']=$spa['space'];
                                         $arr3[$k3]['ground_value']=$value['space_value'];
                                         $arr3[$k3]['wall_value']=$v['space_value'];
                                       }
                                    }
                                }
                            }
                          }
                          // echo '<pre>';print_r($arr3);exit;
                          $array=array();
                          foreach ($arr3 as $key => $value) {
                            if($value['space']!='其他'){
                              $array[$value['space']]=$this->space_data($value['space'],$use_area,$value['ground_value'],$value['wall_value'],$city_xs);
                            }
                          }
                          $array['其他']=$this->space_data('其他',$use_area,$value['ground_value'],$value['wall_value'],$city_xs);
                          $data=array(
                               'area'=>$area,
                               'use_area'=>sprintf('%.1f',$use_area),
                               'city'=>$city,
                               'house'=>$house,
                               'data'=>$array,
                          );
                          $arr=explode('|',$data['house']);
                          foreach ($data['data'] as $key => $value) {
                              foreach ($value as $k => $v) {
                                  // 单个空间的总价
                                  $data['data'][$key]['total']+=$v['total'];
                              }
                          }
                          foreach ($data['data'] as $key => $value) {
                              $total_price+=$value['total'];
                          }
                           // 管理费
                          $manage_price=(float)$total_price*0.1;
                          $total_price=$total_price+$manage_price;
                          // 总钱数
                          // $total_price1=sprintf('%.1f',$total_price/10000);
                               foreach ($data['data'] as $key => $value) {
                               if($key=='其他'){
                                         $data['data'][$key]['其他']['data'][]=array(
                                                        'id' => 393,
                                                        'space_id' => 25,
                                                        'space_project' => '其他',
                                                        'project' => '管理费',
                                                        'unit_price' => '/',
                                                        'craft_standard' =>'<p>实际按当地标准收取（管理费=直接费*管理费率）。</p>',
                                                        'total_price' => $manage_price,
                                          );
                                         $data['data'][$key]['其他']['total']=$value['其他']['total']+$manage_price;
                                         $data['data'][$key]['total']=$value['total']+$manage_price;
                                      }
                               }
                               $data['total_price']=round($total_price);
                         // echo '<pre>';print_r($data);exit; 
                     }
                     break;
                   case 3:
                     $pro_id=$this->db->get_one('c_proportion',"`house_type`='".$house_type[0]."' and `type`=3");
                     if($pro_id){
                          // 地面系数
                          $ground=$this->db->get_list('c_proportion_details',"`proportion_id`='".$pro_id['id']."' and `space_value`!=0 and `area_type`=1");
                          // 墙面系数
                          $wall=$this->db->get_list('c_proportion_details',"`proportion_id`='".$pro_id['id']."' and `space_value`!=0 and `area_type`=2");
                          $arr2=array();
                          if($house_type[0]!=0){
                              $arr2[]=$this->db->get_list('c_space',"`type`='室'",'space',0,$house_type[0],0,'type asc,intervene desc');
                          }
                          if($house_type[1]!=0){
                              $arr2[]=$this->db->get_list('c_space',"`type`='厅'",'space',0,$house_type[1],0,'type asc,intervene desc');
                          }
                          if($house_type[2]!=0){
                              $arr2[]=$this->db->get_list('c_space',"`type`='橱'",'space',0,$house_type[2],0,'type asc,intervene desc');
                          }
                          if($house_type[3]!=0){
                              $arr2[]=$this->db->get_list('c_space',"`type`='卫'",'space',0,$house_type[3],0,'type asc,intervene desc');
                          }
                          if($house_type[4]!=0){
                              $arr2[]=$this->db->get_list('c_space',"`type`='阳台'",'space',0,$house_type[4],0,'type asc,intervene desc');
                          }
                          $arr3=array();
                          foreach ($arr2 as $key => $value) {
                            foreach ($value as $k => $v) {
                                $arr3[]=$v;
                            }
                          }
                          foreach ($arr3 as $k3 => $v3) {
                            foreach ($ground as $key => $value) {
                                foreach ($wall as $k => $v) {
                                    if($value['space_id']==$v['space_id']){
                                         $spa=$this->db->get_one('c_space',"`id`='".$v['space_id']."'");
                                       if($spa['space']==$v3['space']){
                                         $arr3[$k3]['space']=$spa['space'];
                                         $arr3[$k3]['ground_value']=$value['space_value'];
                                         $arr3[$k3]['wall_value']=$v['space_value'];
                                       }
                                    }
                                }
                            }
                          }
                          // echo '<pre>';print_r($arr3);exit;
                          $array=array();
                          foreach ($arr3 as $key => $value) {
                            if($value['space']!='其他'){
                              $array[$value['space']]=$this->space_data($value['space'],$use_area,$value['ground_value'],$value['wall_value'],$city_xs);
                            }
                          }
                          $array['其他']=$this->space_data('其他',$use_area,$value['ground_value'],$value['wall_value'],$city_xs);
                          $data=array(
                               'area'=>$area,
                               'use_area'=>sprintf('%.1f',$use_area),
                               'city'=>$city,
                               'house'=>$house,
                               'data'=>$array,
                          );
                          $arr=explode('|',$data['house']);
                          foreach ($data['data'] as $key => $value) {
                              foreach ($value as $k => $v) {
                                  // 单个空间的总价
                                  $data['data'][$key]['total']+=$v['total'];
                              }
                          }
                          foreach ($data['data'] as $key => $value) {
                              $total_price+=$value['total'];
                          }
                           // 管理费
                            $manage_price=(float)$total_price*0.1;
                            $total_price=$total_price+$manage_price;
                            // 总钱数
                            // $total_price1=sprintf('%.1f',$total_price/10000);
                                 foreach ($data['data'] as $key => $value) {
                                 if($key=='其他'){
                                           $data['data'][$key]['其他']['data'][]=array(
                                                          'id' => 393,
                                                          'space_id' => 25,
                                                          'space_project' => '其他',
                                                          'project' => '管理费',
                                                          'unit_price' => '/',
                                                          'craft_standard' =>'<p>实际按当地标准收取（管理费=直接费*管理费率）。</p>',
                                                          'total_price' => $manage_price,
                                            );
                                           $data['data'][$key]['其他']['total']=$value['其他']['total']+$manage_price;
                                           $data['data'][$key]['total']=$value['total']+$manage_price;
                                        }
                                 }
                            $data['total_price']=round($total_price);
                         // echo '<pre>';print_r($data);exit; 
                        }
                     break;
                   case 4:
                      $pro_id=$this->db->get_one('c_proportion',"`house_type`='".$house_type[0]."' and `type`=3");
                     if($pro_id){
                          // 地面系数
                          $ground=$this->db->get_list('c_proportion_details',"`proportion_id`='".$pro_id['id']."' and `space_value`!=0 and `area_type`=1");
                          // 墙面系数
                          $wall=$this->db->get_list('c_proportion_details',"`proportion_id`='".$pro_id['id']."' and `space_value`!=0 and `area_type`=2");
                          $arr2=array();
                          if($house_type[0]!=0){
                              $arr2[]=$this->db->get_list('c_space',"`type`='室'",'space',0,$house_type[0],0,'type asc,intervene desc');
                          }
                          if($house_type[1]!=0){
                              $arr2[]=$this->db->get_list('c_space',"`type`='厅'",'space',0,$house_type[1],0,'type asc,intervene desc');
                          }
                          if($house_type[2]!=0){
                              $arr2[]=$this->db->get_list('c_space',"`type`='橱'",'space',0,$house_type[2],0,'type asc,intervene desc');
                          }
                          if($house_type[3]!=0){
                              $arr2[]=$this->db->get_list('c_space',"`type`='卫'",'space',0,$house_type[3],0,'type asc,intervene desc');
                          }
                          if($house_type[4]!=0){
                              $arr2[]=$this->db->get_list('c_space',"`type`='阳台'",'space',0,$house_type[4],0,'type asc,intervene desc');
                          }
                          $arr3=array();
                          foreach ($arr2 as $key => $value) {
                            foreach ($value as $k => $v) {
                                $arr3[]=$v;
                            }
                          }
                          foreach ($arr3 as $k3 => $v3) {
                            foreach ($ground as $key => $value) {
                                foreach ($wall as $k => $v) {
                                    if($value['space_id']==$v['space_id']){
                                         $spa=$this->db->get_one('c_space',"`id`='".$v['space_id']."'");
                                       if($spa['space']==$v3['space']){
                                         $arr3[$k3]['space']=$spa['space'];
                                         $arr3[$k3]['ground_value']=$value['space_value'];
                                         $arr3[$k3]['wall_value']=$v['space_value'];
                                       }
                                    }
                                }
                            }
                          }
                          $array=array();
                          foreach ($arr3 as $key => $value) {
                            if($value['space']!='其他'){
                              $array[$value['space']]=$this->space_data($value['space'],$use_area,$value['ground_value'],$value['wall_value'],$city_xs);
                            }
                          }
                          $array['其他']=$this->space_data('其他',$use_area,$value['ground_value'],$value['wall_value'],$city_xs);
                          // echo '<pre>';print_r($array);exit;
                          $data=array(
                               'area'=>$area,
                               'use_area'=>sprintf('%.1f',$use_area),
                               'city'=>$city,
                               'house'=>$house,
                               'data'=>$array,
                          );
                          $arr=explode('|',$data['house']);
                          foreach ($data['data'] as $key => $value) {
                              foreach ($value as $k => $v) {
                                  // 单个空间的总价
                                  $data['data'][$key]['total']+=$v['total'];
                              }
                          }
                          foreach ($data['data'] as $key => $value) {
                              $total_price+=$value['total'];
                          }
                           // 管理费
                          $manage_price=(float)$total_price*0.1;
                          $total_price=$total_price+$manage_price;
                          // 总钱数
                          // $total_price1=sprintf('%.1f',$total_price/10000);
                               foreach ($data['data'] as $key => $value) {
                               if($key=='其他'){
                                         $data['data'][$key]['其他']['data'][]=array(
                                                        'id' => 393,
                                                        'space_id' => 25,
                                                        'space_project' => '其他',
                                                        'project' => '管理费',
                                                        'unit_price' => '/',
                                                        'craft_standard' =>'<p>实际按当地标准收取（管理费=直接费*管理费率）。</p>',
                                                        'total_price' => $manage_price,
                                          );
                                         $data['data'][$key]['其他']['total']=$value['其他']['total']+$manage_price;
                                         $data['data'][$key]['total']=$value['total']+$manage_price;
                                      }
                               }
                          $data['total_price']=round($total_price);
                         // echo '<pre>';print_r($data);exit; 
                        }
                     break;
                   case 5:
                      $pro_id=$this->db->get_one('c_proportion',"`house_type`='".$house_type[0]."' and `type`=3");
                     if($pro_id){
                          // 地面系数
                          $ground=$this->db->get_list('c_proportion_details',"`proportion_id`='".$pro_id['id']."' and `space_value`!=0 and `area_type`=1");
                          // 墙面系数
                          $wall=$this->db->get_list('c_proportion_details',"`proportion_id`='".$pro_id['id']."' and `space_value`!=0 and `area_type`=2");
                          $arr2=array();
                          if($house_type[0]!=0){
                              $arr2[]=$this->db->get_list('c_space',"`type`='室'",'space',0,$house_type[0],0,'type asc,intervene desc');
                          }
                          if($house_type[1]!=0){
                              $arr2[]=$this->db->get_list('c_space',"`type`='厅'",'space',0,$house_type[1],0,'type asc,intervene desc');
                          }
                          if($house_type[2]!=0){
                              $arr2[]=$this->db->get_list('c_space',"`type`='橱'",'space',0,$house_type[2],0,'type asc,intervene desc');
                          }
                          if($house_type[3]!=0){
                              $arr2[]=$this->db->get_list('c_space',"`type`='卫'",'space',0,$house_type[3],0,'type asc,intervene desc');
                          }
                          if($house_type[4]!=0){
                              $arr2[]=$this->db->get_list('c_space',"`type`='阳台'",'space',0,$house_type[4],0,'type asc,intervene desc');
                          }
                          $arr3=array();
                          foreach ($arr2 as $key => $value) {
                            foreach ($value as $k => $v) {
                                $arr3[]=$v;
                            }
                          }
                          foreach ($arr3 as $k3 => $v3) {
                            foreach ($ground as $key => $value) {
                                foreach ($wall as $k => $v) {
                                    if($value['space_id']==$v['space_id']){
                                         $spa=$this->db->get_one('c_space',"`id`='".$v['space_id']."'");
                                       if($spa['space']==$v3['space']){
                                         $arr3[$k3]['space']=$spa['space'];
                                         $arr3[$k3]['ground_value']=$value['space_value'];
                                         $arr3[$k3]['wall_value']=$v['space_value'];
                                       }
                                    }
                                }
                            }
                          }
                          // echo '<pre>';print_r($arr3);exit;
                          $array=array();
                          foreach ($arr3 as $key => $value) {
                            if($value['space']!='其他'){
                              $array[$value['space']]=$this->space_data($value['space'],$use_area,$value['ground_value'],$value['wall_value'],$city_xs);
                            }
                          }
                          $array['其他']=$this->space_data('其他',$use_area,$value['ground_value'],$value['wall_value'],$city_xs);
                          $data=array(
                               'area'=>$area,
                               'use_area'=>sprintf('%.1f',$use_area),
                               'city'=>$city,
                               'house'=>$house,
                               'data'=>$array,
                          );
                          $arr=explode('|',$data['house']);
                          foreach ($data['data'] as $key => $value) {
                              foreach ($value as $k => $v) {
                                  // 单个空间的总价
                                  $data['data'][$key]['total']+=$v['total'];
                              }
                          }
                          foreach ($data['data'] as $key => $value) {
                              $total_price+=$value['total'];
                          }
                           // 管理费
                          $manage_price=(float)$total_price*0.1;
                          $total_price=$total_price+$manage_price;
                          // 总钱数
                          // $total_price1=sprintf('%.1f',$total_price/10000);
                               foreach ($data['data'] as $key => $value) {
                               if($key=='其他'){
                                         $data['data'][$key]['其他']['data'][]=array(
                                                        'id' => 393,
                                                        'space_id' => 25,
                                                        'space_project' => '其他',
                                                        'project' => '管理费',
                                                        'unit_price' => '/',
                                                        'craft_standard' =>'<p>实际按当地标准收取（管理费=直接费*管理费率）。</p>',
                                                        'total_price' => $manage_price,
                                          );
                                         $data['data'][$key]['其他']['total']=$value['其他']['total']+$manage_price;
                                         $data['data'][$key]['total']=$value['total']+$manage_price;
                                      }
                               }
                          $data['total_price']=round($total_price);
                         // echo '<pre>';print_r($data);exit; 
                        }
                     break;
                 }
             }
        }else{
              $area=remove_xss($GLOBALS['area']);
              $cityId=remove_xss($GLOBALS['city']);
              // 转换cityid
              $calculator_config=get_config('calculator_config');
              $city=$calculator_config[$cityId];
              $total_price=0;
              // 城市系数
              $xs=$this->db->get_one('c_area_coefficient',"`proportion_type`=2",'proportion_value');
              $city_xs=unserialize($xs['proportion_value']);
              $city_xs=$city_xs[$city];
              // 使用面积
              $pro=$this->db->get_one('c_area_coefficient',"`proportion_type`=1",'proportion_value');
              $use_area=$area*(float)$pro['proportion_value'];
              // 获取前台传过来的面积
              $edit_area=remove_xss($GLOBALS['edit_area']);
              $edit_area=explode('|',$edit_area);
              $house=remove_xss($GLOBALS['house_type']);
              $house_type=explode('|',$house);
              $total_area='';
              foreach($edit_area as $key => $value){
                  $total_area+=$value;
              }
              // 使用面积
              $pro=$this->db->get_one('c_area_coefficient',"`proportion_type`=1",'proportion_value');
              $use_area1=$total_area*(float)$pro['proportion_value'];
              // 户型
              $pro_id=$this->db->get_one('c_proportion',"`house_type`='".$house."' and `type`=2");
              if($pro_id){
                    // 地面系数
                    $ground=$this->db->get_list('c_proportion_details',"`proportion_id`='".$pro_id['id']."' and `space_value`!=0 and `area_type`=1");
                    $wall=$this->db->get_list('c_proportion_details',"`proportion_id`='".$pro_id['id']."' and `space_value`!=0 and `area_type`=2");
                    $arr=array();
                    foreach ($ground as $key => $value) {
                        foreach ($wall as $k => $v) {
                            if($value['space_id']==$v['space_id']){
                                 $spa=$this->db->get_one('c_space',"`id`='".$v['space_id']."'");
                                 $arr[$k]['space']=$spa['space'];
                                 $arr[$k]['ground_value']=$value['space_value'];
                                 $arr[$k]['wall_value']=$v['space_value'];
                            }
                        }
                    }
              }else{
                  $arr=$this->modify_area($house_type);
              } 

                foreach ($arr as $key => $value) {
                      foreach ($edit_area as $k => $v) {
                           if($key==$k){
                               $arr[$key]['area']=$v;
                           }
                      }
                    }
              // echo '<pre>';print_r($arr);exit;

                   $array=array();
                    foreach ($arr as $key => $value) {
                      if($value['space']!='其他'){
                        $array[$value['space']]=$this->space_data($value['space'],$value['area'],$value['ground_value'],$value['wall_value'],$city_xs,true);
                      }
                    }
                    $array['其他']=$this->space_data('其他',$use_area1,$value['ground_value'],$value['wall_value'],$city_xs);
                    $data=array(
                         'area'=>$area,
                         'use_area'=>sprintf('%.1f',$use_area),
                         'city'=>$cityId,
                         'house'=>$house,
                         'data'=>$array,
                      );
                    $arr=explode('|',$data['house']);
                    foreach ($data['data'] as $key => $value) {
                        foreach ($value as $k => $v) {
                            // 单个空间的总价
                            $data['data'][$key]['total']+=$v['total'];
                        }
                    }
                    foreach ($data['data'] as $key => $value) {
                        $total_price+=$value['total'];
                    }
                    // 管理费
                      $manage_price=(float)$total_price*0.1;
                      $total_price=$total_price+$manage_price;
                      // 总钱数
                      // $total_price1=sprintf('%.1f',$total_price/10000);
                           foreach ($data['data'] as $key => $value) {
                           if($key=='其他'){
                                     $data['data'][$key]['其他']['data'][]=array(
                                                    'id' => 393,
                                                    'space_id' => 25,
                                                    'space_project' => '其他',
                                                    'project' => '管理费',
                                                    'unit_price' => '/',
                                                    'craft_standard' =>'<p>实际按当地标准收取（管理费=直接费*管理费率）。</p>',
                                                    'total_price' => $manage_price,
                                      );
                                     $data['data'][$key]['其他']['total']=$value['其他']['total']+$manage_price;
                                     $data['data'][$key]['total']=$value['total']+$manage_price;
                                  }
                           } 
                    $data['total_price']=round($total_price);
        }
         // 相似案例 start
        $result1 = array();
        $a=(int)$area-5;
        $b=(int)$area+5;
        $query = $this->db->query("select id,name,cover,updatetime,designer from wz_m_picture where `status` = 1 and `area` between '".$a."' and '".$b."' and `housetype` = '".$house_type[0]."' order by updatetime DESC limit 0,2");
        while($data1 = $this->db->fetch_array($query)){
                $result1[] = $data1;
          }    
        // echo '<pre>';print_r($house_type[0]);exit;
        foreach ($result1 as $k1 => $v1) {
             $result1[$k1]['cover']=getMImgShow($v1['cover'],'original');
             $design1=$this->db->get_one("m_company_team",'`id`="'.$v1['designer'].'"','thumb,title,thumb1');
             $result1[$k1]['dname']=$design1['title'];
             if(isset($design1['thumb1'])&&!empty($design1['thumb1'])){
                $result1[$k1]['thumb']=getMImgShow($design1['thumb1'],'big_square'); 
             }else{
                $result1[$k1]['thumb']='http://www.uzhuang.com/image/big_square/'.$design1['thumb'];
             }
           }
        // 相似案例 end
        $resu['similar']=$result1;
        $resu['total_price']=$data['total_price'];
        $resu['data']=$this->dataFormat($data);
        // echo '<pre>';print_r($resu);exit;
        echo json_encode(array('code'=>1,'data'=>$resu,'message'=>'M站计算器各空间报价详情页','process_time'=>time()));
   }
   // 格式化详情页的数据
   public function dataFormat($data){
    
        $itemArr=array();
        foreach ($data['data'] as $key => $value) {
          $itemArr[$key]['total']=round($value['total']);
          // echo '<pre>';print_r($value);
          foreach ($value as $k => $v) {
             if($v['data']){
                foreach ($v['data'] as $k1 => $v1) {
                      // echo '<pre>';print_r($v1);
                      $v1['total_price']=round($v1['total_price']);
                      if($v1['project']=='门套打底'){
                          $v1['area']='1套';
                      }else if($v1['project']=='铺过门石'){
                          $v1['area']='1块';
                      }else if($v1['project']=="包立管"||$v1['space_project']=='其他'){
                          $v1['area']='1项';
                      }else{
                          $v1['area']=sprintf('%.1f',$v['area']).'m²';
                      }
                      $itemArr[$key]['data'][]=$v1;
                }
             }
           }
        }
        // echo '<pre>';print_r($itemArr);exit;
      return $itemArr;
   }
   // 修改户型及城市后的报价页及报价页
   public function quote_house(){
        $area = sql_replace(remove_xss($GLOBALS['area']));
        $cityId = sql_replace(remove_xss($GLOBALS['city']));
        $title = sql_replace(remove_xss($GLOBALS['name']));
        $telephone = sql_replace(remove_xss($GLOBALS['telephone']));
        $house = sql_replace(remove_xss($GLOBALS['house_type']));
        $newOrderId = '';
        $referer_id = $GLOBALS['id'];
        
        if (empty($area) || empty($cityId) || empty($title) || empty($telephone) || empty($house)) {
          echo json_encode(array('code'=>0,'data'=>null,'message'=>'数据错误','process_time'=>time()));exit;
        }
        // 发标 start
        if(!empty($GLOBALS['source'])&&isset($GLOBALS['source'])){
            $formdata=array();
            $formdata['title'] = $title;
            $formdata['telephone'] = $telephone;
            $formdata['areaid_2'] = $cityId;
            $formdata['addtime'] = date('Y-m-d G:i:s',time());
            $formdata['orderstatus'] = '正常';
            $formdata['cid'] = 135;
            $formdata['status'] = 1;
            if(isset($referer_id)&&!empty($referer_id)){
                $formdata['source']=$referer_id;
                $formdata['referer'] = remove_xss(HTTP_REFERER).'?id='.$referer_id;
            }else{
                $formdata['source']='M站-装修计算器';
                $formdata['referer'] = remove_xss(HTTP_REFERER);
            }
            $formdata['order_no'] = date('YmdH').rand(100,999).date('is');
            $formdata['nodeid'] =0;
            $formdata['nodename']='订单待确认';
            // 12小时，只允许提交一次
            $rd = $this->db->get_one('demand', "`telephone`='".$telephone."'",'*',0,'id desc');
            $addtime = SYS_TIME-43200;
            $rdtime =strtotime($rd['addtime']);
            // echo '<pre>';print_r($formdata);exit;
            if(!$rd||$rdtime<$addtime){
                $id = $this->db->insert('demand', $formdata);
                $newOrderId = $id;
                $order_no = '1'.str_pad($id,9,0,STR_PAD_LEFT);
                $this->db->update('demand',array('order_no'=>$order_no),array('id'=>$id));
            }
            
            
        }
        // 转换cityid
        $calculator_config=get_config('calculator_config');
        $city=$calculator_config[$cityId];
        // echo $city;exit;
        $total_price=0;
        // 城市系数
        $xs=$this->db->get_one('c_area_coefficient',"`proportion_type`=2",'proportion_value');
        $city_xs=unserialize($xs['proportion_value']);
        $city_xs=$city_xs[$city];
        // 使用面积
        $pro=$this->db->get_one('c_area_coefficient',"`proportion_type`=1",'proportion_value');
        $use_area=$area*(float)$pro['proportion_value'];
        
        // $house='5|2|1|2|1';
        $house_type=explode("|",$house);
        $pro_id=$this->db->get_one('c_proportion',"`house_type`='".$house."' and `type`=1");
        if($pro_id)//后台存在的数据
          {
              // 地面系数
              $ground=$this->db->get_list('c_proportion_details',"`proportion_id`='".$pro_id['id']."' and `space_value`!=0 and `area_type`=1");
              // 墙面系数
              $wall=$this->db->get_list('c_proportion_details',"`proportion_id`='".$pro_id['id']."' and `space_value`!=0 and `area_type`=2");
              $arr1=array();
              foreach ($ground as $key => $value) {
                  foreach ($wall as $k => $v) {
                      if($value['space_id']==$v['space_id']){
                           $spa=$this->db->get_one('c_space',"`id`='".$v['space_id']."'");
                           $arr1[$k]['space']=$spa['space'];
                           $arr1[$k]['ground_value']=$value['space_value'];
                           $arr1[$k]['wall_value']=$v['space_value'];
                      }
                  }
              }
              // 排序
              $arr3=array();
              $res=$this->db->get_list('c_space','','*',0,200,0,'type asc,intervene desc');
              foreach ($res as $key => $value) {
                 foreach ($arr1 as $k1 => $v1) {
                    if($v1['space']==$value['space']){
                        $arr3[$key]['space']=$v1['space'];
                        $arr3[$key]['ground_value']=$v1['ground_value'];
                        $arr3[$key]['wall_value']=$v1['wall_value'];
                    }
                 }
              }
              $array=array();
              foreach ($arr3 as $key => $value) {
                if($value['space']!='其他'){
                  $array[$value['space']]=$this->space_data($value['space'],$use_area,$value['ground_value'],$value['wall_value'],$city_xs);
                }
              }
              $array['其他']=$this->space_data('其他',$use_area,$value['ground_value'],$value['wall_value'],$city_xs);
              $data=array(
                   'area'=>$area,
                   'use_area'=>sprintf('%.1f',$use_area),
                   'city'=>$cityId,
                   'house'=>$house,
                   'data'=>$array,
                );
              $arr=explode('|',$data['house']);
              foreach ($data['data'] as $key => $value) {
                  foreach ($value as $k => $v) {
                      // 单个空间的总价
                      $data['data'][$key]['total']+=$v['total'];
                  }
              }
              foreach ($data['data'] as $key => $value) {
                  $total_price+=$value['total'];
              }
                // 管理费
                $manage_price=(float)$total_price*0.1;
                $total_price=$total_price+$manage_price;
                     foreach ($data['data'] as $key => $value) {
                     if($key=='其他'){
                               $data['data'][$key]['其他']['data'][]=array(
                                              'id' => 393,
                                              'space_id' => 25,
                                              'space_project' => '其他',
                                              'project' => '管理费',
                                              'unit_price' => '/',
                                              'craft_standard' =>'<p>实际按当地标准收取（管理费=直接费*管理费率）。</p>',
                                              'total_price' => $manage_price,
                                );
                               $data['data'][$key]['其他']['total']=$value['其他']['total']+$manage_price;
                               $data['data'][$key]['total']=$value['total']+$manage_price;
                            }
                     }
              $data['total_price']=sprintf('%.1f',$total_price/10000);
              $totalArr=array();
              foreach ($data['data'] as $key => $value) {
                 foreach ($value as $k => $v) {
                     if($k=='地面')$totalArr[$key]['area']=sprintf('%.1f',$v['area']);
                 }
                $totalArr[$key]['total']=round($value['total']);
              }
              $data['data']=$totalArr;
              // echo '<pre>';print_r($data['data']);exit;
         }else{//后台不存在时
             switch ($house_type[0]) {
               case 1:
                 $pro_id=$this->db->get_one('c_proportion',"`house_type`='".$house_type[0]."' and `type`=3");
                 if($pro_id){
                      // 地面系数
                      $ground=$this->db->get_list('c_proportion_details',"`proportion_id`='".$pro_id['id']."' and `space_value`!=0 and `area_type`=1");
                      // 墙面系数
                      $wall=$this->db->get_list('c_proportion_details',"`proportion_id`='".$pro_id['id']."' and `space_value`!=0 and `area_type`=2");
                      $arr2=array();
                      if($house_type[0]!=0){
                          $arr2[]=$this->db->get_list('c_space',"`type`='室'",'space',0,$house_type[0],0,'type asc,intervene desc');
                      }
                      if($house_type[1]!=0){
                          $arr2[]=$this->db->get_list('c_space',"`type`='厅'",'space',0,$house_type[1],0,'type asc,intervene desc');
                      }
                      if($house_type[2]!=0){
                          $arr2[]=$this->db->get_list('c_space',"`type`='橱'",'space',0,$house_type[2],0,'type asc,intervene desc');
                      }
                      if($house_type[3]!=0){
                          $arr2[]=$this->db->get_list('c_space',"`type`='卫'",'space',0,$house_type[3],0,'type asc,intervene desc');
                      }
                      if($house_type[4]!=0){
                          $arr2[]=$this->db->get_list('c_space',"`type`='阳台'",'space',0,$house_type[4],0,'type asc,intervene desc');
                      }
                      $arr3=array();
                      foreach ($arr2 as $key => $value) {
                        foreach ($value as $k => $v) {
                            $arr3[]=$v;
                        }
                      }
                      foreach ($arr3 as $k3 => $v3) {
                        foreach ($ground as $key => $value) {
                            foreach ($wall as $k => $v) {
                                if($value['space_id']==$v['space_id']){
                                     $spa=$this->db->get_one('c_space',"`id`='".$v['space_id']."'");
                                   if($spa['space']==$v3['space']){
                                     $arr3[$k3]['space']=$spa['space'];
                                     $arr3[$k3]['ground_value']=$value['space_value'];
                                     $arr3[$k3]['wall_value']=$v['space_value'];
                                   }
                                }
                            }
                        }
                      }
                      // echo '<pre>';print_r($arr3);exit;
                      $array=array();
                      foreach ($arr3 as $key => $value) {
                        if($value['space']!='其他'){
                          $array[$value['space']]=$this->space_data($value['space'],$use_area,$value['ground_value'],$value['wall_value'],$city_xs);
                        }
                      }
                      $array['其他']=$this->space_data('其他',$use_area,$value['ground_value'],$value['wall_value'],$city_xs);
                      $data=array(
                           'area'=>$area,
                           'use_area'=>sprintf('%.1f',$use_area),
                           'city'=>$cityId,
                           'house'=>$house,
                           'data'=>$array,
                      );
                      $arr=explode('|',$data['house']);
                      foreach ($data['data'] as $key => $value) {
                          foreach ($value as $k => $v) {
                              // 单个空间的总价
                              $data['data'][$key]['total']+=$v['total'];
                          }
                      }
                      foreach ($data['data'] as $key => $value) {
                          $total_price+=$value['total'];
                      }
                       // 管理费
                      $manage_price=(float)$total_price*0.1;
                      $total_price=$total_price+$manage_price;
                      // 总钱数
                      // $total_price1=sprintf('%.1f',$total_price/10000);
                           foreach ($data['data'] as $key => $value) {
                           if($key=='其他'){
                                     $data['data'][$key]['其他']['data'][]=array(
                                                    'id' => 393,
                                                    'space_id' => 25,
                                                    'space_project' => '其他',
                                                    'project' => '管理费',
                                                    'unit_price' => '/',
                                                    'craft_standard' =>'<p>实际按当地标准收取（管理费=直接费*管理费率）。</p>',
                                                    'total_price' => $manage_price,
                                      );
                                     $data['data'][$key]['其他']['total']=$value['其他']['total']+$manage_price;
                                     $data['data'][$key]['total']=$value['total']+$manage_price;
                                  }
                           }
                      $data['total_price']=sprintf('%.1f',$total_price/10000);
                      $totalArr=array();
                      foreach ($data['data'] as $key => $value) {
                         foreach ($value as $k => $v) {
                             if($k=='地面')$totalArr[$key]['area']=sprintf('%.1f',$v['area']);
                         }
                        $totalArr[$key]['total']=round($value['total']);
                      }
                      $data['data']=$totalArr;
                     // echo '<pre>';print_r($data);exit; 
                 }
                 break;
               case 2:
                 $pro_id=$this->db->get_one('c_proportion',"`house_type`='".$house_type[0]."' and `type`=3");
                 if($pro_id){
                      // 地面系数
                      $ground=$this->db->get_list('c_proportion_details',"`proportion_id`='".$pro_id['id']."' and `space_value`!=0 and `area_type`=1");
                      // 墙面系数
                      $wall=$this->db->get_list('c_proportion_details',"`proportion_id`='".$pro_id['id']."' and `space_value`!=0 and `area_type`=2");
                      $arr2=array();
                      if($house_type[0]!=0){
                          $arr2[]=$this->db->get_list('c_space',"`type`='室'",'space',0,$house_type[0],0,'type asc,intervene desc');
                      }
                      if($house_type[1]!=0){
                          $arr2[]=$this->db->get_list('c_space',"`type`='厅'",'space',0,$house_type[1],0,'type asc,intervene desc');
                      }
                      if($house_type[2]!=0){
                          $arr2[]=$this->db->get_list('c_space',"`type`='橱'",'space',0,$house_type[2],0,'type asc,intervene desc');
                      }
                      if($house_type[3]!=0){
                          $arr2[]=$this->db->get_list('c_space',"`type`='卫'",'space',0,$house_type[3],0,'type asc,intervene desc');
                      }
                      if($house_type[4]!=0){
                          $arr2[]=$this->db->get_list('c_space',"`type`='阳台'",'space',0,$house_type[4],0,'type asc,intervene desc');
                      }
                      $arr3=array();
                      foreach ($arr2 as $key => $value) {
                        foreach ($value as $k => $v) {
                            $arr3[]=$v;
                        }
                      }
                      foreach ($arr3 as $k3 => $v3) {
                        foreach ($ground as $key => $value) {
                            foreach ($wall as $k => $v) {
                                if($value['space_id']==$v['space_id']){
                                     $spa=$this->db->get_one('c_space',"`id`='".$v['space_id']."'");
                                   if($spa['space']==$v3['space']){
                                     $arr3[$k3]['space']=$spa['space'];
                                     $arr3[$k3]['ground_value']=$value['space_value'];
                                     $arr3[$k3]['wall_value']=$v['space_value'];
                                   }
                                }
                            }
                        }
                      }
                      // echo '<pre>';print_r($arr3);exit;
                      $array=array();
                      foreach ($arr3 as $key => $value) {
                        if($value['space']!='其他'){
                          $array[$value['space']]=$this->space_data($value['space'],$use_area,$value['ground_value'],$value['wall_value'],$city_xs);
                        }
                      }
                      $array['其他']=$this->space_data('其他',$use_area,$value['ground_value'],$value['wall_value'],$city_xs);
                      $data=array(
                           'area'=>$area,
                           'use_area'=>sprintf('%.1f',$use_area),
                           'city'=>$cityId,
                           'house'=>$house,
                           'data'=>$array,
                      );
                      $arr=explode('|',$data['house']);
                      foreach ($data['data'] as $key => $value) {
                          foreach ($value as $k => $v) {
                              // 单个空间的总价
                              $data['data'][$key]['total']+=$v['total'];
                          }
                      }
                      foreach ($data['data'] as $key => $value) {
                          $total_price+=$value['total'];
                      }
                       // 管理费
                      $manage_price=(float)$total_price*0.1;
                      $total_price=$total_price+$manage_price;
                      // 总钱数
                      // $total_price1=sprintf('%.1f',$total_price/10000);
                           foreach ($data['data'] as $key => $value) {
                           if($key=='其他'){
                                     $data['data'][$key]['其他']['data'][]=array(
                                                    'id' => 393,
                                                    'space_id' => 25,
                                                    'space_project' => '其他',
                                                    'project' => '管理费',
                                                    'unit_price' => '/',
                                                    'craft_standard' =>'<p>实际按当地标准收取（管理费=直接费*管理费率）。</p>',
                                                    'total_price' => $manage_price,
                                      );
                                     $data['data'][$key]['其他']['total']=$value['其他']['total']+$manage_price;
                                     $data['data'][$key]['total']=$value['total']+$manage_price;
                                  }
                           }
                           $data['total_price']=sprintf('%.1f',$total_price/10000);
                          $totalArr=array();
                          foreach ($data['data'] as $key => $value) {
                             foreach ($value as $k => $v) {
                                 if($k=='地面')$totalArr[$key]['area']=sprintf('%.1f',$v['area']);
                             }
                            $totalArr[$key]['total']=round($value['total']);
                          }
                          $data['data']=$totalArr;
                     // echo '<pre>';print_r($data);exit; 
                 }
                 break;
               case 3:
                 $pro_id=$this->db->get_one('c_proportion',"`house_type`='".$house_type[0]."' and `type`=3");
                 if($pro_id){
                      // 地面系数
                      $ground=$this->db->get_list('c_proportion_details',"`proportion_id`='".$pro_id['id']."' and `space_value`!=0 and `area_type`=1");
                      // 墙面系数
                      $wall=$this->db->get_list('c_proportion_details',"`proportion_id`='".$pro_id['id']."' and `space_value`!=0 and `area_type`=2");
                      $arr2=array();
                      if($house_type[0]!=0){
                          $arr2[]=$this->db->get_list('c_space',"`type`='室'",'space',0,$house_type[0],0,'type asc,intervene desc');
                      }
                      if($house_type[1]!=0){
                          $arr2[]=$this->db->get_list('c_space',"`type`='厅'",'space',0,$house_type[1],0,'type asc,intervene desc');
                      }
                      if($house_type[2]!=0){
                          $arr2[]=$this->db->get_list('c_space',"`type`='橱'",'space',0,$house_type[2],0,'type asc,intervene desc');
                      }
                      if($house_type[3]!=0){
                          $arr2[]=$this->db->get_list('c_space',"`type`='卫'",'space',0,$house_type[3],0,'type asc,intervene desc');
                      }
                      if($house_type[4]!=0){
                          $arr2[]=$this->db->get_list('c_space',"`type`='阳台'",'space',0,$house_type[4],0,'type asc,intervene desc');
                      }
                      $arr3=array();
                      foreach ($arr2 as $key => $value) {
                        foreach ($value as $k => $v) {
                            $arr3[]=$v;
                        }
                      }
                      foreach ($arr3 as $k3 => $v3) {
                        foreach ($ground as $key => $value) {
                            foreach ($wall as $k => $v) {
                                if($value['space_id']==$v['space_id']){
                                     $spa=$this->db->get_one('c_space',"`id`='".$v['space_id']."'");
                                   if($spa['space']==$v3['space']){
                                     $arr3[$k3]['space']=$spa['space'];
                                     $arr3[$k3]['ground_value']=$value['space_value'];
                                     $arr3[$k3]['wall_value']=$v['space_value'];
                                   }
                                }
                            }
                        }
                      }
                      // echo '<pre>';print_r($arr3);exit;
                      $array=array();
                      foreach ($arr3 as $key => $value) {
                        if($value['space']!='其他'){
                          $array[$value['space']]=$this->space_data($value['space'],$use_area,$value['ground_value'],$value['wall_value'],$city_xs);
                        }
                      }
                      $array['其他']=$this->space_data('其他',$use_area,$value['ground_value'],$value['wall_value'],$city_xs);
                      $data=array(
                           'area'=>$area,
                           'use_area'=>sprintf('%.1f',$use_area),
                           'city'=>$cityId,
                           'house'=>$house,
                           'data'=>$array,
                      );
                      $arr=explode('|',$data['house']);
                      foreach ($data['data'] as $key => $value) {
                          foreach ($value as $k => $v) {
                              // 单个空间的总价
                              $data['data'][$key]['total']+=$v['total'];
                          }
                      }
                      foreach ($data['data'] as $key => $value) {
                          $total_price+=$value['total'];
                      }
                       // 管理费
                        $manage_price=(float)$total_price*0.1;
                        $total_price=$total_price+$manage_price;
                        // 总钱数
                        // $total_price1=sprintf('%.1f',$total_price/10000);
                             foreach ($data['data'] as $key => $value) {
                             if($key=='其他'){
                                       $data['data'][$key]['其他']['data'][]=array(
                                                      'id' => 393,
                                                      'space_id' => 25,
                                                      'space_project' => '其他',
                                                      'project' => '管理费',
                                                      'unit_price' => '/',
                                                      'craft_standard' =>'<p>实际按当地标准收取（管理费=直接费*管理费率）。</p>',
                                                      'total_price' => $manage_price,
                                        );
                                       $data['data'][$key]['其他']['total']=$value['其他']['total']+$manage_price;
                                       $data['data'][$key]['total']=$value['total']+$manage_price;
                                    }
                             }
                        $data['total_price']=sprintf('%.1f',$total_price/10000);
                        $totalArr=array();
                        foreach ($data['data'] as $key => $value) {
                           foreach ($value as $k => $v) {
                               if($k=='地面')$totalArr[$key]['area']=sprintf('%.1f',$v['area']);
                           }
                          $totalArr[$key]['total']=round($value['total']);
                        }
                        $data['data']=$totalArr;
                     // echo '<pre>';print_r($data);exit; 
                    }
                 break;
               case 4:
                  $pro_id=$this->db->get_one('c_proportion',"`house_type`='".$house_type[0]."' and `type`=3");
                 if($pro_id){
                      // 地面系数
                      $ground=$this->db->get_list('c_proportion_details',"`proportion_id`='".$pro_id['id']."' and `space_value`!=0 and `area_type`=1");
                      // 墙面系数
                      $wall=$this->db->get_list('c_proportion_details',"`proportion_id`='".$pro_id['id']."' and `space_value`!=0 and `area_type`=2");
                      $arr2=array();
                      if($house_type[0]!=0){
                          $arr2[]=$this->db->get_list('c_space',"`type`='室'",'space',0,$house_type[0],0,'type asc,intervene desc');
                      }
                      if($house_type[1]!=0){
                          $arr2[]=$this->db->get_list('c_space',"`type`='厅'",'space',0,$house_type[1],0,'type asc,intervene desc');
                      }
                      if($house_type[2]!=0){
                          $arr2[]=$this->db->get_list('c_space',"`type`='橱'",'space',0,$house_type[2],0,'type asc,intervene desc');
                      }
                      if($house_type[3]!=0){
                          $arr2[]=$this->db->get_list('c_space',"`type`='卫'",'space',0,$house_type[3],0,'type asc,intervene desc');
                      }
                      if($house_type[4]!=0){
                          $arr2[]=$this->db->get_list('c_space',"`type`='阳台'",'space',0,$house_type[4],0,'type asc,intervene desc');
                      }
                      $arr3=array();
                      foreach ($arr2 as $key => $value) {
                        foreach ($value as $k => $v) {
                            $arr3[]=$v;
                        }
                      }
                      foreach ($arr3 as $k3 => $v3) {
                        foreach ($ground as $key => $value) {
                            foreach ($wall as $k => $v) {
                                if($value['space_id']==$v['space_id']){
                                     $spa=$this->db->get_one('c_space',"`id`='".$v['space_id']."'");
                                   if($spa['space']==$v3['space']){
                                     $arr3[$k3]['space']=$spa['space'];
                                     $arr3[$k3]['ground_value']=$value['space_value'];
                                     $arr3[$k3]['wall_value']=$v['space_value'];
                                   }
                                }
                            }
                        }
                      }
                      $array=array();
                      foreach ($arr3 as $key => $value) {
                        if($value['space']!='其他'){
                          $array[$value['space']]=$this->space_data($value['space'],$use_area,$value['ground_value'],$value['wall_value'],$city_xs);
                        }
                      }
                      $array['其他']=$this->space_data('其他',$use_area,$value['ground_value'],$value['wall_value'],$city_xs);
                      // echo '<pre>';print_r($array);exit;
                      $data=array(
                           'area'=>$area,
                           'use_area'=>sprintf('%.1f',$use_area),
                           'city'=>$cityId,
                           'house'=>$house,
                           'data'=>$array,
                      );
                      $arr=explode('|',$data['house']);
                      foreach ($data['data'] as $key => $value) {
                          foreach ($value as $k => $v) {
                              // 单个空间的总价
                              $data['data'][$key]['total']+=$v['total'];
                          }
                      }
                      foreach ($data['data'] as $key => $value) {
                          $total_price+=$value['total'];
                      }
                       // 管理费
                      $manage_price=(float)$total_price*0.1;
                      $total_price=$total_price+$manage_price;
                      // 总钱数
                      // $total_price1=sprintf('%.1f',$total_price/10000);
                           foreach ($data['data'] as $key => $value) {
                           if($key=='其他'){
                                     $data['data'][$key]['其他']['data'][]=array(
                                                    'id' => 393,
                                                    'space_id' => 25,
                                                    'space_project' => '其他',
                                                    'project' => '管理费',
                                                    'unit_price' => '/',
                                                    'craft_standard' =>'<p>实际按当地标准收取（管理费=直接费*管理费率）。</p>',
                                                    'total_price' => $manage_price,
                                      );
                                     $data['data'][$key]['其他']['total']=$value['其他']['total']+$manage_price;
                                     $data['data'][$key]['total']=$value['total']+$manage_price;
                                  }
                           }
                      $data['total_price']=sprintf('%.1f',$total_price/10000);
                      $totalArr=array();
                      foreach ($data['data'] as $key => $value) {
                         foreach ($value as $k => $v) {
                             if($k=='地面')$totalArr[$key]['area']=sprintf('%.1f',$v['area']);
                         }
                        $totalArr[$key]['total']=round($value['total']);
                      }
                      $data['data']=$totalArr;
                     // echo '<pre>';print_r($data);exit; 
                    }
                 break;
               case 5:
                  $pro_id=$this->db->get_one('c_proportion',"`house_type`='".$house_type[0]."' and `type`=3");
                 if($pro_id){
                      // 地面系数
                      $ground=$this->db->get_list('c_proportion_details',"`proportion_id`='".$pro_id['id']."' and `space_value`!=0 and `area_type`=1");
                      // 墙面系数
                      $wall=$this->db->get_list('c_proportion_details',"`proportion_id`='".$pro_id['id']."' and `space_value`!=0 and `area_type`=2");
                      $arr2=array();
                      if($house_type[0]!=0){
                          $arr2[]=$this->db->get_list('c_space',"`type`='室'",'space',0,$house_type[0],0,'type asc,intervene desc');
                      }
                      if($house_type[1]!=0){
                          $arr2[]=$this->db->get_list('c_space',"`type`='厅'",'space',0,$house_type[1],0,'type asc,intervene desc');
                      }
                      if($house_type[2]!=0){
                          $arr2[]=$this->db->get_list('c_space',"`type`='橱'",'space',0,$house_type[2],0,'type asc,intervene desc');
                      }
                      if($house_type[3]!=0){
                          $arr2[]=$this->db->get_list('c_space',"`type`='卫'",'space',0,$house_type[3],0,'type asc,intervene desc');
                      }
                      if($house_type[4]!=0){
                          $arr2[]=$this->db->get_list('c_space',"`type`='阳台'",'space',0,$house_type[4],0,'type asc,intervene desc');
                      }
                      $arr3=array();
                      foreach ($arr2 as $key => $value) {
                        foreach ($value as $k => $v) {
                            $arr3[]=$v;
                        }
                      }
                      foreach ($arr3 as $k3 => $v3) {
                        foreach ($ground as $key => $value) {
                            foreach ($wall as $k => $v) {
                                if($value['space_id']==$v['space_id']){
                                     $spa=$this->db->get_one('c_space',"`id`='".$v['space_id']."'");
                                   if($spa['space']==$v3['space']){
                                     $arr3[$k3]['space']=$spa['space'];
                                     $arr3[$k3]['ground_value']=$value['space_value'];
                                     $arr3[$k3]['wall_value']=$v['space_value'];
                                   }
                                }
                            }
                        }
                      }
                      // echo '<pre>';print_r($arr3);exit;
                      $array=array();
                      foreach ($arr3 as $key => $value) {
                        if($value['space']!='其他'){
                          $array[$value['space']]=$this->space_data($value['space'],$use_area,$value['ground_value'],$value['wall_value'],$city_xs);
                        }
                      }
                      $array['其他']=$this->space_data('其他',$use_area,$value['ground_value'],$value['wall_value'],$city_xs);
                      $data=array(
                           'area'=>$area,
                           'use_area'=>sprintf('%.1f',$use_area),
                           'city'=>$cityId,
                           'house'=>$house,
                           'data'=>$array,
                      );
                      $arr=explode('|',$data['house']);
                      foreach ($data['data'] as $key => $value) {
                          foreach ($value as $k => $v) {
                              // 单个空间的总价
                              $data['data'][$key]['total']+=$v['total'];
                          }
                      }
                      foreach ($data['data'] as $key => $value) {
                          $total_price+=$value['total'];
                      }
                       // 管理费
                      $manage_price=(float)$total_price*0.1;
                      $total_price=$total_price+$manage_price;
                      // 总钱数
                      // $total_price1=sprintf('%.1f',$total_price/10000);
                           foreach ($data['data'] as $key => $value) {
                           if($key=='其他'){
                                     $data['data'][$key]['其他']['data'][]=array(
                                                    'id' => 393,
                                                    'space_id' => 25,
                                                    'space_project' => '其他',
                                                    'project' => '管理费',
                                                    'unit_price' => '/',
                                                    'craft_standard' =>'<p>实际按当地标准收取（管理费=直接费*管理费率）。</p>',
                                                    'total_price' => $manage_price,
                                      );
                                     $data['data'][$key]['其他']['total']=$value['其他']['total']+$manage_price;
                                     $data['data'][$key]['total']=$value['total']+$manage_price;
                                  }
                           }
                      $data['total_price']=sprintf('%.1f',$total_price/10000);
                      $totalArr=array();
                      foreach ($data['data'] as $key => $value) {
                         foreach ($value as $k => $v) {
                             if($k=='地面')$totalArr[$key]['area']=sprintf('%.1f',$v['area']);
                         }
                        $totalArr[$key]['total']=round($value['total']);
                      }
                      $data['data']=$totalArr;
                     // echo '<pre>';print_r($data);exit; 
                    }
                 break;
             }
         }
      $houseStatus=$this->checkout($house_type,$area);
      $data['houseStatus']=$houseStatus;
      if($data['houseStatus']==0){
            $data['msg']='您填写的面积与实际存在差异，报价存在误差。建议调整后重新计算。';
      }
      if($data['houseStatus']==2){
         $data['msg']='您填写的户型与实际存在差异，报价存在误差。建议调整后重新计算。';
      }
      if($newOrderId){
        $phone = load_class('sendmessage');
        $msg = get_config('message_config');
        $msg = $msg['calculate'];
        $msg = str_replace('money',$data['total_price'],$msg);
        $sendRes = $phone->sendmessage($telephone,$msg);
      }

      // echo '<pre>';print_r($data);exit;
      echo json_encode(array('code'=>1,'data'=>$data,'message'=>'M站修改户型及城市后的报价页','process_time'=>time()));
   }
   // 修改面积后的报价页
   public function quote_area(){
        $area=remove_xss($GLOBALS['area']);
        $cityId=remove_xss($GLOBALS['city']);
        // 转换cityid
        $calculator_config=get_config('calculator_config');
        $city=$calculator_config[$cityId];
        $total_price=0;
        // 城市系数
        $xs=$this->db->get_one('c_area_coefficient',"`proportion_type`=2",'proportion_value');
        $city_xs=unserialize($xs['proportion_value']);
        $city_xs=$city_xs[$city];
        // 使用面积
        $pro=$this->db->get_one('c_area_coefficient',"`proportion_type`=1",'proportion_value');
        $use_area=$area*(float)$pro['proportion_value'];
        // 获取前台传过来的面积
        $edit_area=remove_xss($GLOBALS['edit_area']);
        $edit_area=explode('|',$edit_area);
        $house=remove_xss($GLOBALS['house_type']);
        $house_type=explode('|',$house);
        $total_area='';
        foreach($edit_area as $key => $value){
            $total_area+=$value;
        }
        // 使用面积
        $pro=$this->db->get_one('c_area_coefficient',"`proportion_type`=1",'proportion_value');
        $use_area1=$total_area*(float)$pro['proportion_value'];
        // 户型
        $pro_id=$this->db->get_one('c_proportion',"`house_type`='".$house."' and `type`=2");
        if($pro_id){
              // 地面系数
              $ground=$this->db->get_list('c_proportion_details',"`proportion_id`='".$pro_id['id']."' and `space_value`!=0 and `area_type`=1");
              $wall=$this->db->get_list('c_proportion_details',"`proportion_id`='".$pro_id['id']."' and `space_value`!=0 and `area_type`=2");
              $arr=array();
              foreach ($ground as $key => $value) {
                  foreach ($wall as $k => $v) {
                      if($value['space_id']==$v['space_id']){
                           $spa=$this->db->get_one('c_space',"`id`='".$v['space_id']."'");
                           $arr[$k]['space']=$spa['space'];
                           $arr[$k]['ground_value']=$value['space_value'];
                           $arr[$k]['wall_value']=$v['space_value'];
                      }
                  }
              }
        }else{
            $arr=$this->modify_area($house_type);
        } 

          foreach ($arr as $key => $value) {
                foreach ($edit_area as $k => $v) {
                     if($key==$k){
                         $arr[$key]['area']=$v;
                     }
                }
              }
        // echo '<pre>';print_r($arr);exit;

             $array=array();
              foreach ($arr as $key => $value) {
                if($value['space']!='其他'){
                  $array[$value['space']]=$this->space_data($value['space'],$value['area'],$value['ground_value'],$value['wall_value'],$city_xs,true);
                }
              }
              $array['其他']=$this->space_data('其他',$use_area1,$value['ground_value'],$value['wall_value'],$city_xs);
              $data=array(
                   'area'=>$area,
                   'use_area'=>sprintf('%.1f',$use_area),
                   'city'=>$cityId,
                   'house'=>$house,
                   'data'=>$array,
                );
              $arr=explode('|',$data['house']);
              foreach ($data['data'] as $key => $value) {
                  foreach ($value as $k => $v) {
                      // 单个空间的总价
                      $data['data'][$key]['total']+=$v['total'];
                  }
              }
              foreach ($data['data'] as $key => $value) {
                  $total_price+=$value['total'];
              }
              // 管理费
                $manage_price=(float)$total_price*0.1;
                $total_price=$total_price+$manage_price;
                // 总钱数
                // $total_price1=sprintf('%.1f',$total_price/10000);
                     foreach ($data['data'] as $key => $value) {
                     if($key=='其他'){
                               $data['data'][$key]['其他']['data'][]=array(
                                              'id' => 393,
                                              'space_id' => 25,
                                              'space_project' => '其他',
                                              'project' => '管理费',
                                              'unit_price' => '/',
                                              'craft_standard' =>'<p>实际按当地标准收取（管理费=直接费*管理费率）。</p>',
                                              'total_price' => $manage_price,
                                );
                               $data['data'][$key]['其他']['total']=$value['其他']['total']+$manage_price;
                               $data['data'][$key]['total']=$value['total']+$manage_price;
                            }
                     } 
              $data['total_price']=sprintf('%.1f',$total_price/10000);
        // echo "<pre>";print_r($data);exit;
              $totalArr=array();
              foreach ($data['data'] as $key => $value) {
                 foreach ($value as $k => $v) {
                     if($k=='地面')$totalArr[$key]['area']=sprintf('%.1f',$v['area']);
                 }
                $totalArr[$key]['total']=round($value['total']);
              }
              $data['data']=$totalArr;
        $areaStatus=$this->area_beyond($area,$edit_area);
        $data['areaStatus']=$areaStatus;
        echo json_encode(array('code'=>1,'data'=>$data,'message'=>'M站修改面积后的报价页','process_time'=>time()));
   }
   // 修改面积时 调用的
   public function modify_area($house_type){
        switch ($house_type[0]) {
                   case 1:
                     $pro_id=$this->db->get_one('c_proportion',"`house_type`='".$house_type[0]."' and `type`=3");
                     if($pro_id){
                          // 地面系数
                          $ground=$this->db->get_list('c_proportion_details',"`proportion_id`='".$pro_id['id']."' and `space_value`!=0 and `area_type`=1");
                          // 墙面系数
                          $wall=$this->db->get_list('c_proportion_details',"`proportion_id`='".$pro_id['id']."' and `space_value`!=0 and `area_type`=2");
                          $arr2=array();
                          if($house_type[0]!=0){
                              $arr2[]=$this->db->get_list('c_space',"`type`='室'",'space',0,$house_type[0],0,'type asc,intervene desc');
                          }
                          if($house_type[1]!=0){
                              $arr2[]=$this->db->get_list('c_space',"`type`='厅'",'space',0,$house_type[1],0,'type asc,intervene desc');
                          }
                          if($house_type[2]!=0){
                              $arr2[]=$this->db->get_list('c_space',"`type`='橱'",'space',0,$house_type[2],0,'type asc,intervene desc');
                          }
                          if($house_type[3]!=0){
                              $arr2[]=$this->db->get_list('c_space',"`type`='卫'",'space',0,$house_type[3],0,'type asc,intervene desc');
                          }
                          if($house_type[4]!=0){
                              $arr2[]=$this->db->get_list('c_space',"`type`='阳台'",'space',0,$house_type[4],0,'type asc,intervene desc');
                          }
                          $arr=array();
                          foreach ($arr2 as $key => $value) {
                            foreach ($value as $k => $v) {
                                $arr[]=$v;
                            }
                          }
                          foreach ($arr as $k3 => $v3) {
                            foreach ($ground as $key => $value) {
                                foreach ($wall as $k => $v) {
                                    if($value['space_id']==$v['space_id']){
                                         $spa=$this->db->get_one('c_space',"`id`='".$v['space_id']."'");
                                       if($spa['space']==$v3['space']){
                                         $arr[$k3]['space']=$spa['space'];
                                         $arr[$k3]['ground_value']=$value['space_value'];
                                         $arr[$k3]['wall_value']=$v['space_value'];
                                       }
                                    }
                                }
                            }
                          }
                     }
                     break;
                   case 2:
                     $pro_id=$this->db->get_one('c_proportion',"`house_type`='".$house_type[0]."' and `type`=3");
                     if($pro_id){
                          // 地面系数
                          $ground=$this->db->get_list('c_proportion_details',"`proportion_id`='".$pro_id['id']."' and `space_value`!=0 and `area_type`=1");
                          // 墙面系数
                          $wall=$this->db->get_list('c_proportion_details',"`proportion_id`='".$pro_id['id']."' and `space_value`!=0 and `area_type`=2");
                          $arr2=array();
                          if($house_type[0]!=0){
                              $arr2[]=$this->db->get_list('c_space',"`type`='室'",'space',0,$house_type[0],0,'type asc,intervene desc');
                          }
                          if($house_type[1]!=0){
                              $arr2[]=$this->db->get_list('c_space',"`type`='厅'",'space',0,$house_type[1],0,'type asc,intervene desc');
                          }
                          if($house_type[2]!=0){
                              $arr2[]=$this->db->get_list('c_space',"`type`='橱'",'space',0,$house_type[2],0,'type asc,intervene desc');
                          }
                          if($house_type[3]!=0){
                              $arr2[]=$this->db->get_list('c_space',"`type`='卫'",'space',0,$house_type[3],0,'type asc,intervene desc');
                          }
                          if($house_type[4]!=0){
                              $arr2[]=$this->db->get_list('c_space',"`type`='阳台'",'space',0,$house_type[4],0,'type asc,intervene desc');
                          }
                          $arr=array();
                          foreach ($arr2 as $key => $value) {
                            foreach ($value as $k => $v) {
                                $arr[]=$v;
                            }
                          }
                          foreach ($arr as $k3 => $v3) {
                            foreach ($ground as $key => $value) {
                                foreach ($wall as $k => $v) {
                                    if($value['space_id']==$v['space_id']){
                                         $spa=$this->db->get_one('c_space',"`id`='".$v['space_id']."'");
                                       if($spa['space']==$v3['space']){
                                         $arr[$k3]['space']=$spa['space'];
                                         $arr[$k3]['ground_value']=$value['space_value'];
                                         $arr[$k3]['wall_value']=$v['space_value'];
                                       }
                                    }
                                }
                            }
                          }
                     }
                     break;
                   case 3:
                     $pro_id=$this->db->get_one('c_proportion',"`house_type`='".$house_type[0]."' and `type`=3");
                     if($pro_id){
                          // 地面系数
                          $ground=$this->db->get_list('c_proportion_details',"`proportion_id`='".$pro_id['id']."' and `space_value`!=0 and `area_type`=1");
                          // 墙面系数
                          $wall=$this->db->get_list('c_proportion_details',"`proportion_id`='".$pro_id['id']."' and `space_value`!=0 and `area_type`=2");
                          $arr2=array();
                          if($house_type[0]!=0){
                              $arr2[]=$this->db->get_list('c_space',"`type`='室'",'space',0,$house_type[0],0,'type asc,intervene desc');
                          }
                          if($house_type[1]!=0){
                              $arr2[]=$this->db->get_list('c_space',"`type`='厅'",'space',0,$house_type[1],0,'type asc,intervene desc');
                          }
                          if($house_type[2]!=0){
                              $arr2[]=$this->db->get_list('c_space',"`type`='橱'",'space',0,$house_type[2],0,'type asc,intervene desc');
                          }
                          if($house_type[3]!=0){
                              $arr2[]=$this->db->get_list('c_space',"`type`='卫'",'space',0,$house_type[3],0,'type asc,intervene desc');
                          }
                          if($house_type[4]!=0){
                              $arr2[]=$this->db->get_list('c_space',"`type`='阳台'",'space',0,$house_type[4],0,'type asc,intervene desc');
                          }
                          $arr=array();
                          foreach ($arr2 as $key => $value) {
                            foreach ($value as $k => $v) {
                                $arr[]=$v;
                            }
                          }
                          foreach ($arr as $k3 => $v3) {
                            foreach ($ground as $key => $value) {
                                foreach ($wall as $k => $v) {
                                    if($value['space_id']==$v['space_id']){
                                         $spa=$this->db->get_one('c_space',"`id`='".$v['space_id']."'");
                                       if($spa['space']==$v3['space']){
                                         $arr[$k3]['space']=$spa['space'];
                                         $arr[$k3]['ground_value']=$value['space_value'];
                                         $arr[$k3]['wall_value']=$v['space_value'];
                                       }
                                    }
                                }
                            }
                          }
                        }
                     break;
                   case 4:
                      $pro_id=$this->db->get_one('c_proportion',"`house_type`='".$house_type[0]."' and `type`=3");
                     if($pro_id){
                          // 地面系数
                          $ground=$this->db->get_list('c_proportion_details',"`proportion_id`='".$pro_id['id']."' and `space_value`!=0 and `area_type`=1");
                          // 墙面系数
                          $wall=$this->db->get_list('c_proportion_details',"`proportion_id`='".$pro_id['id']."' and `space_value`!=0 and `area_type`=2");
                          $arr2=array();
                          if($house_type[0]!=0){
                              $arr2[]=$this->db->get_list('c_space',"`type`='室'",'space',0,$house_type[0],0,'type asc,intervene desc');
                          }
                          if($house_type[1]!=0){
                              $arr2[]=$this->db->get_list('c_space',"`type`='厅'",'space',0,$house_type[1],0,'type asc,intervene desc');
                          }
                          if($house_type[2]!=0){
                              $arr2[]=$this->db->get_list('c_space',"`type`='橱'",'space',0,$house_type[2],0,'type asc,intervene desc');
                          }
                          if($house_type[3]!=0){
                              $arr2[]=$this->db->get_list('c_space',"`type`='卫'",'space',0,$house_type[3],0,'type asc,intervene desc');
                          }
                          if($house_type[4]!=0){
                              $arr2[]=$this->db->get_list('c_space',"`type`='阳台'",'space',0,$house_type[4],0,'type asc,intervene desc');
                          }
                          $arr=array();
                          foreach ($arr2 as $key => $value) {
                            foreach ($value as $k => $v) {
                                $arr[]=$v;
                            }
                          }
                          foreach ($arr as $k3 => $v3) {
                            foreach ($ground as $key => $value) {
                                foreach ($wall as $k => $v) {
                                    if($value['space_id']==$v['space_id']){
                                         $spa=$this->db->get_one('c_space',"`id`='".$v['space_id']."'");
                                       if($spa['space']==$v3['space']){
                                         $arr[$k3]['space']=$spa['space'];
                                         $arr[$k3]['ground_value']=$value['space_value'];
                                         $arr[$k3]['wall_value']=$v['space_value'];
                                       }
                                    }
                                }
                            }
                          }
                        }
                     break;
                   case 5:
                      $pro_id=$this->db->get_one('c_proportion',"`house_type`='".$house_type[0]."' and `type`=3");
                     if($pro_id){
                          // 地面系数
                          $ground=$this->db->get_list('c_proportion_details',"`proportion_id`='".$pro_id['id']."' and `space_value`!=0 and `area_type`=1");
                          // 墙面系数
                          $wall=$this->db->get_list('c_proportion_details',"`proportion_id`='".$pro_id['id']."' and `space_value`!=0 and `area_type`=2");
                          $arr2=array();
                          if($house_type[0]!=0){
                              $arr2[]=$this->db->get_list('c_space',"`type`='室'",'space',0,$house_type[0],0,'type asc,intervene desc');
                          }
                          if($house_type[1]!=0){
                              $arr2[]=$this->db->get_list('c_space',"`type`='厅'",'space',0,$house_type[1],0,'type asc,intervene desc');
                          }
                          if($house_type[2]!=0){
                              $arr2[]=$this->db->get_list('c_space',"`type`='橱'",'space',0,$house_type[2],0,'type asc,intervene desc');
                          }
                          if($house_type[3]!=0){
                              $arr2[]=$this->db->get_list('c_space',"`type`='卫'",'space',0,$house_type[3],0,'type asc,intervene desc');
                          }
                          if($house_type[4]!=0){
                              $arr2[]=$this->db->get_list('c_space',"`type`='阳台'",'space',0,$house_type[4],0,'type asc,intervene desc');
                          }
                          $arr=array();
                          foreach ($arr2 as $key => $value) {
                            foreach ($value as $k => $v) {
                                $arr[]=$v;
                            }
                          }
                          foreach ($arr as $k3 => $v3) {
                            foreach ($ground as $key => $value) {
                                foreach ($wall as $k => $v) {
                                    if($value['space_id']==$v['space_id']){
                                         $spa=$this->db->get_one('c_space',"`id`='".$v['space_id']."'");
                                       if($spa['space']==$v3['space']){
                                         $arr[$k3]['space']=$spa['space'];
                                         $arr[$k3]['ground_value']=$value['space_value'];
                                         $arr[$k3]['wall_value']=$v['space_value'];
                                       }
                                    }
                                }
                            }
                          }
                        }
                     break;
                 }
        return $arr;
   }
    //判断用户选择的户型，是否存在
   public function checkout($house_type,$area){
        $house=implode('|',$house_type);
        $pro_id=$this->db->get_one('c_proportion',"`house_type`='".$house."'");
        if($pro_id){
           switch ($house_type[0]) {
              case 1:
                 if($area<10){
                    return 0;
                 }else{
                    return 1;
                 }
               break;
              case 2:
                 if($area<40){
                    return 0;
                 }else{
                    return 1;
                 }
               break;
              case 3:
                 if($area<60){
                    return 0;
                 }else{
                    return 1;
                 }
               break;
              case 4:
                  if($area<70){
                    return 0;
                 }else{
                    return 1;
                 }
               break;
              case 5:
                  if($area<90){
                    return 0;
                 }else{
                    return 1;
                 }
               break;
           }
        }else{
          return 2;
        }
   }
   // 判断面积是否超出
   public function area_beyond($area,$edit_area){
            $total_area='';
            foreach($edit_area as $key => $value){
                $total_area+=$value;
            }
            // 修改后的总面积超过填写的面积,报错
            if($total_area>$area){
                return 0;
            }else{
                return 1;
            }
   }
}



