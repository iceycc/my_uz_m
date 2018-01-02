<?php  
// +----------------------------------------------------------------------
// |  [ 主站app修版本信息 ]
// +----------------------------------------------------------------------
$serverName = $_SERVER['SERVER_NAME'];
$downLoderUrl = 'http://' . $serverName . '/apk/uz108.apk';
echo json_encode(array('version'=>'1.08','DownLoder'=>$downLoderUrl));