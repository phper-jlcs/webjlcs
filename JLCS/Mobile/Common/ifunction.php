<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/3/13
 * Time: 14:36
 */

  function check_is_null($val,$msg){
    if(is_null($val) || $val === ''){
        $response['code'] = 300;
        $response['msg'] = $msg;
        echo (json_encode($response,JSON_UNESCAPED_SLASHES));
        // echo json_encode($this->response);exit;
    }
}

 function send_ok_response($data,$code = '200'){
    $response['code'] = $code;
    $response['result'] = $data;
    echo (json_encode($response,JSON_UNESCAPED_SLASHES));
    exit;
}

 function send_error_response($msg,$code = '300'){
    $response['code'] = $code;
    $response['msg'] = $msg;
    echo (json_encode($response));
    exit;
}

function setAccess(){
    header("Access-Control-Allow-Origin: *");
}

/*
3  * 生成随机字符串
4  * @param int $length 生成随机字符串的长度
5  * @param string $char 组成随机字符串的字符串
6  * @return string $string 生成的随机字符串
7  */
 function str_rand($length = 8, $char = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ') {
         if(!is_int($length) || $length < 0) {
                 return false;
    }
     $string = '';
     for($i = $length; $i > 0; $i--) {
                $string .= $char[mt_rand(0, strlen($char) - 1)];
     }

     return $string;
 }




?>