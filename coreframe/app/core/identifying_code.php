<?php
// +----------------------------------------------------------------------
// | wuzhicms [ 五指互联网站内容管理系统 ]
// | Copyright (c) 2014-2015 http://www.wuzhicms.com All rights reserved.
// | Licensed ( http://www.wuzhicms.com/licenses/ )
// | Author: wangcanjia <phpip@qq.com>
// +----------------------------------------------------------------------
defined('IN_WZ') or exit('No direct script access allowed');
/**
 * 网站首页
 */
load_class('session');
class identifying_code{
    public function __construct() {

    }
    public function init() {
        $identifying = load_class('identifying_code');
        $num1 = rand(1,9);
        $num2 = rand(1,9);
        while($num2 == $num1){
            $num2 = rand(1,9);
        }
        $flag = ['+','-'];
        shuffle($flag);
        $flag =$flag[0];
        $code = $num1.$flag.$num2.'=';
        if($flag == '+'){
            $res = $num1 + $num2;
        }else if($flag == '-') {
            $res = $num1 - $num2;
        }

        if(defined('PICTEST')) {
            $code = 'AAAA';
            $_SESSION['code'] = strtolower($code);
            header("Location:".R.'images/checkcode.png');
        } else {
            $_SESSION['code'] = $res;
            $w = isset($GLOBALS['w']) ? intval($GLOBALS['w']) : 120;
            $h = isset($GLOBALS['h']) ? intval($GLOBALS['h']) : 27;
            $identifying->image_one($code,$w,$h);
        }
    }
}
?>
