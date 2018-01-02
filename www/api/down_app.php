
<?php


$serverName = $_SERVER['SERVER_NAME'];

$filename = 'http://' . $serverName . '/apk/uz108.apk';
$content=file_get_contents('/uploads/uz108.apk');//将文件读入字符串
$length=strlen($content);//取得字符串长度，即文件大小，单位是字节
$encoded_filename = rawurlencode($filename);//采用rawurlencode避免空格被替换为+
$ua = $_SERVER["HTTP_USER_AGENT"];//获取用户浏览器UA信息

header('Content-Type: application/octet-stream');//告诉浏览器输出内容类型，必须
header('Content-Encoding: none');//内容不加密，gzip等，可选
header("Content-Transfer-Encoding: binary" );//文件传输方式是二进制，可选
header("Content-Length: ".$length);//告诉浏览器文件大小，可选
header('Content-Disposition: attachment; filename="wgt://data/down/uz.apk"');

if (preg_match("/MSIE/", $ua)) {//从UA中找到MSIE判断是IE
    header('Content-Disposition: attachment; filename="' . $encoded_filename . '"');
} else if (preg_match("/Firefox/", $ua)) {//同理判断火狐
    header('Content-Disposition: attachment; filename*="utf8\'\'' . $filename . '"');
} else {//其他情况，谷歌等
    header('Content-Disposition: attachment; filename="' . $filename . '"');
}
echo $content;
?>