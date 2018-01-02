<?php
defined('IN_WZ') or exit('No direct script access allowed');
/**
 * $mail->sendMail(); //发送短信
 */
class WUZHI_sendmessage {

    protected $userName;
    protected $password;
    protected $url;
    protected $subid;

    public function __construct() {
        $this->userName = 'yzmj';
        $this->password = 'yzmj321';
        $this->url = 'http://115.28.112.245:8082/SendMT/SendMessage';
        $this->subid = '';
    }


    /**
     * 发送短信
     * @access public
     * @return boolean
     * $userphone接收短信的手机号
     * $message  接收短信的内容
     * $code     是否为验证码  默认为false
     */
    public function sendmessage($userphone,$message,$code=false) {
        if ($code) {
            $this->userName = 'yzmjhy';
            $this->password = 'yzmjhy888';
        }
        $message = urlencode($message);
        $params = 'UserName='.$this->userName.'&UserPass='.$this->password.'&subid='.$this->subid.'&Mobile='.$userphone.'&Content='.$message;

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_URL, $this->url);
        curl_setopt($ch,CURLOPT_POSTFIELDS,$params);
        curl_setopt($ch, CURLOPT_TIMEOUT,3);
        $data = curl_exec($ch);     
        curl_close ($ch);
        return $data;
    }
}