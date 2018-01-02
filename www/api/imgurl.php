<?php
header('Content-type:text/html;charset=utf-8');
header("Access-Control-Allow-Origin: *");
define('WWW_ROOT',substr(dirname(__FILE__), 0, -4).'/');
require '../configs/web_config.php';
require COREFRAME_ROOT.'core.php';
$action = $GLOBALS['action'];
if($action=='lst') {
    lst();
}
function lst(){
      $str=R;$newstr = substr($str,0,strlen($str)-5);
      $newstrs=trim($newstr,"http://");
       if($newstrs=="m.uzhuang.com"){
         die(json_encode('http://m.uzhuang.com/image/original/'));
       }else if($newstrs=="mdev.uz.com"){
         die(json_encode('http://m0.uz.com/image/original/'));
       }else if($newstrs=="mtest.uz.com"){
         die(json_encode('http://m1.uz.com/image/original/'));
       }else if($newstrs=="mpre.uz.com"){
         die(json_encode('http://m2.uz.com/image/original/'));
       }

}

