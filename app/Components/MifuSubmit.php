<?php

namespace App\Components;

use Illuminate\Support\Str;
use Log;

/**
 * Class MifuSubmit
 *
 * @author  null
 *
 * @package App\Components
 */
class MifuSubmit
{
    var $api_gateway = "http://zhifu.neylab.com/pay/Pay"; //网关地址
    var $user_private_key = "";
    var $user_public_key = "";
    var $merchant_code = "";
    var $agent_code = "";
    var $amount = "";
    var $order_id = "";
    var $uer_id = "";
    var $pay_type = "";
    var $user_ip = "";
    var $front_callback = "";
    var $backend_callback = "";
    var $__platfrom_public_key = "MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEAperyEyqU72GxNNcb92Zxq/c8HbNKrYVgWcSH0GQ7trIqTzNn+GIfgJOvr8B7OUBksu4hhF0FRh6AGNfOvSdMzYtECuUUjoQdNk5gYXb7UcVnzJnc/aZuBHrA4FHxvGxm88vg8D2+PWvCUr1SgwuE2XAbynXbbmYZFHwr5RecFYpLbh/rGYw1S6wPwuWepYl//fkVXhI/E9EQ0UR8XKTeTO53KF+nZanI6YezECdWZYe6k4GC92YTuXglGTXK6SHqx2f0xIBf5XBViOEF+QQA8H8Dnx3vbR5PR87DuUi7qn6QXJv/Qha4acjDVmO81XmdsPnV5drLoIBf1ITms7FBMQIDAQAB";
    


    var $alipay_gateway_new = 'https://mapi.alipay.com/gateway.do?'; // 支付宝网关地址（新）
    var $sign_type = "MD5"; // 加密方式：MD5/RSA
    var $partner = "";
    var $md5_key = "";
    var $private_key = "";

    /**
     * @param amount 字符串 1.00 表示一元
     * @param pay_type ['alipay', 'wechat']
    */
    function __construct($user_public_key, $user_private_key, $merchant_code, $agent_code, $amount, $order_id, $user_id, $pay_type = "alipay")
    {

      $user_public_key = str_replace("-----BEGIN PUBLIC KEY-----", "", $user_public_key);
      $user_public_key = str_replace("-----END PUBLIC KEY-----", "", $user_public_key);
      $user_public_key = str_replace("\n", "", $user_public_key);
      $user_public_key = "-----BEGIN PUBLIC KEY-----" . PHP_EOL . wordwrap($user_public_key, 64, "\n", true) . PHP_EOL . "-----END PUBLIC KEY-----";
      $this->user_public_key = openssl_pkey_get_public($user_public_key);

      $user_private_key = str_replace("-----BEGIN RSA PRIVATE KEY-----", "", $user_private_key);
      $user_private_key = str_replace("-----END RSA PRIVATE KEY-----", "", $user_private_key);
      $user_private_key = str_replace("\n", "", $user_private_key);
      $user_private_key = "-----BEGIN RSA PRIVATE KEY-----" . PHP_EOL . wordwrap($user_private_key, 64, "\n", true) . PHP_EOL . "-----END RSA PRIVATE KEY-----";
      $this->user_private_key = openssl_pkey_get_private($user_private_key);

      Log::info("user_public_key_id:" . $this->user_public_key .   ", user_public_key"  . $user_public_key);
      Log::info("user_private_key_id:" . $this->user_private_key . ", user_private_key"  . $user_private_key);
      $this->merchant_code = $merchant_code;
      $this->agent_code = $agent_code;
      $this->amount = $amount;
      $this->order_id = $order_id;
      $this->user_id = $user_id;
      $this->pay_type = $pay_type;
    }

    function get_platform_public_key()
    {
      $publickey = $this->__platfrom_public_key;
      $publickey = chunk_split($publickey, 64, "\r\n"); //转换为pem格式的公钥
      $publickey = "-----BEGIN PUBLIC KEY-----\r\n" . $publickey . "-----END PUBLIC KEY-----\r\n";
      return openssl_pkey_get_public($publickey);
    }

    /**
     * 加密一段数据并返回base64_encode的结果
     */
    function aes_encrypt($input, $key)
    {
      return base64_encode( openssl_encrypt($input, "aes-128-ecb", $key, $options=OPENSSL_RAW_DATA) );
    }

    /**
     * 解密一段base64_ecnode后的加密数据
     */
    function aes_decrypt($input, $key)
    {
      return openssl_decrypt( base64_decode($input), 'aes-128-ecb', $key, $options=OPENSSL_RAW_DATA);
    }


    // private function pkcs5_pad($text, $blocksize)
    // {
    //     $pad = $blocksize - (strlen($text) % $blocksize);
    //     return $text . str_repeat(chr($pad), $pad);
    // }

    // private function hex2bin($data)
    // {
    //     $len = strlen($data);
    //     $newdata = '';
    //     for ($i = 0; $i < $len; $i += 2) {
    //         $newdata .= pack("C", hexdec(substr($data, $i, 2)));
    //     }
    //     return $newdata;
    // }

    /**
     * 构造请求订单生成的json串
     */
    public function build_json()
    {
      //数据填充
      $post_data = array();
      $post_data['agentCode']  =   $this->agent_code;
      $post_data['merchantCode']  =   $this->merchant_code;
      $post_data['downOrderNum']  =   $this->order_id;
      $post_data['totalAmount']  =   $this->amount;
      $post_data['channelCode']  =   'AX001';
      $post_data['interfaceType']  =   'P001'; //p001, 扫码, p006 h5支付
      $post_data['uniqueUserId']  =   $this->user_id;
      $post_data['payType']  =   "T001";
      if ($this->pay_type == "wechat"){
        $post_data['payType']  =   "T002";
      }
      $post_data['goodsName']  =   "网易商贸-" . $this->amount;
      $post_data['describe']  =   $post_data['goodsName'];
      $post_data['ip']  =   $this->user_ip;
      $post_data['successUrl']  =   $this->front_callback;
      $post_data['callBackUrl']  =   $this->backend_callback;

      //构造要提交的json串
      $postjson = json_encode($post_data,JSON_UNESCAPED_UNICODE);
      $mpAeskey = Str::random(16);
      openssl_public_encrypt($mpAeskey, $encryptKey,$this->get_platform_public_key());
      $encryptKey = base64_encode($encryptKey);
      $encryptData = $this->aes_encrypt($postjson,$mpAeskey,true);
      //签名加密，目前随意，网关不检查
      openssl_sign($postjson, $signvlue, $this->user_private_key);
      $signData = base64_encode($signvlue);

      //最终数据
      $post_info = array();
      $post_info["version"] = "3.0.0";
      $post_info["agentCode"] = $this->agent_code;
      $post_info["merchantCode"] =  $this->merchant_code;
      $post_info["encrtptKey"] = $encryptKey;
      $post_info["encryptData"] = $encryptData;
      $post_info["signData"] = $signData;
      $req_data_json = json_encode($post_info,JSON_UNESCAPED_UNICODE);
      Log::Info("user:" . $this->user_id . ",json:" . $postjson);
      Log::Info("user:" . $this->user_id . ",encrypt:" . $post_info);
      return $req_data_json;
    }

    /**
     * 通过curl提交请求, 生成支付链接
     */
    public function get_response_by_curl($req_data_json)
    {
      $headers = array("Content-Type: application/json","Accept: application/json");
      $url =  $this->api_gateway;
      $ch = curl_init();
      curl_setopt($ch, CURLOPT_URL, $url);
      curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
      curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
      curl_setopt($ch, CURLOPT_POST, 1);
      curl_setopt($ch, CURLOPT_POSTFIELDS, $req_data_json);
      $responseText = curl_exec($ch);
      Log::info("user:" . $this->user_id . ",mifu_response:" . $responseText);
      curl_close($ch);
      if (!$responseText){
          return "";
      } else {
        Log::error("user:" . $this->user_id . ",mifu request fail");
      }
      $replyvalue = json_decode($responseText, true, 512, JSON_BIGINT_AS_STRING);
      if (isset($replyvalue['encrtptKey'])) 
      {
          openssl_private_decrypt(base64_decode($replyvalue['encrtptKey']), $decryptedvalue, $this->user_private_key);
          $result = json_decode($this->aes_decrypt($replyvalue['encryptData'], $decryptedvalue, true), true);  
          Log::Info("user:" . $this->user_id . ",mifu_response_decode:" . $result);
          if (isset($result['code']) && $result['code'] == 20000) 
          {
            if(isset($result["data"]["payUrl"]))
            {
                return $result["data"]["payUrl"];
            }
          } else {
            Log::error("user:" . $this->user_id . ",mifu code not 20000" . $result);
          }
      } else {
        Log::error("user:" . $this->user_id . ",mifu response do not have encrypt key");
      }
      return "";
    }
}