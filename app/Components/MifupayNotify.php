<?php

namespace App\Components;

/**
 * Class MifupayNotify
 *
 * @author  null
 *
 * @package App\Components
 */
class MifupayNotify
{
    private $https_verify_url = 'https://mapi.alipay.com/gateway.do?service=notify_verify&'; // HTTPS形式消息验证地址
    private $http_verify_url = 'http://notify.alipay.com/trade/notify_query.do?'; // HTTP形式消息验证地址
    private $sign_type = "MD5"; // 加密方式：MD5/RSA
    private $partner = "";
    private $md5_key = "";
    private $private_key = "";
    private $alipay_public_key = "";
    private $transport = "http";


    private $user_private_key = "";
    private $encrypt_key = "";
    private $encrypt_data = "";
    function __construct($user_private_key, $encrypt_key, $encrypt_data)
    {
      $user_private_key = str_replace("-----BEGIN RSA PRIVATE KEY-----", "", $user_private_key);
      $user_private_key = str_replace("-----END RSA PRIVATE KEY-----", "", $user_private_key);
      $user_private_key = str_replace("\n", "", $user_private_key);
      $user_private_key = "-----BEGIN RSA PRIVATE KEY-----" . PHP_EOL . wordwrap($user_private_key, 64, "\n", true) . PHP_EOL . "-----END RSA PRIVATE KEY-----";
      $this->user_private_key = openssl_pkey_get_private($user_private_key);
      $this->encrypt_key = $encrypt_key;
      $this->encrypt_data = $encrypt_data;
    }

    /**
     * 针对notify_url验证消息是否是支付宝发出的合法消息
     *
     * @return json data 验证结果
     */
    public function verify()
    {
      openssl_private_decrypt(base64_decode($this->encrypt_key), $aes_key, $this->user_private_key);
      $result = json_decode($this->aes_decrypt($this->encrypt_data, $aes_key), true);  
      return $result;
    }

    /**
     * 解密一段base64_ecnode后的加密数据
     */
    function aes_decrypt($input, $key)
    {
      return openssl_decrypt( base64_decode($input), 'aes-128-ecb', $key, $options=OPENSSL_RAW_DATA);
    }
}

?>
