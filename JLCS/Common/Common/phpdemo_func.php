<?php
/**
     * 模拟post进行url请求
     * @param string $url
     * @param array $post_data
     */
function request_post($url = '', $post_data = array()) {
    if (empty($url) || empty($post_data)) {
        return false;
    }
    
    $o = "";
    foreach ( $post_data as $k => $v ) 
    { 
        $o.= "$k=" . urlencode( $v ). "&" ;
    }
    $post_data = substr($o,0,-1);

    $postUrl = $url;
    $curlPost = $post_data;
    $ch = curl_init();//初始化curl
    curl_setopt($ch, CURLOPT_URL,$postUrl);//抓取指定网页
    curl_setopt($ch, CURLOPT_HEADER, 0);//设置header
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);//要求结果为字符串且输出到屏幕上
    curl_setopt($ch, CURLOPT_POST, 1);//post提交方式
    curl_setopt($ch, CURLOPT_POSTFIELDS, $curlPost);
    $data = curl_exec($ch);//运行curl
    curl_close($ch);
    
    return $data;
}


// XML格式转数组格式
function xml_to_array( $xml ) { 
    $reg = "/<(\w+)[^>]*>([\\x00-\\xFF]*)<\\/\\1>/"; 
    if(preg_match_all($reg, $xml, $matches)) { 
        $count = count($matches[0]); 
        for($i = 0; $i < $count; $i++) { 
            $subxml= $matches[2][$i]; 
            $key = $matches[1][$i]; 
            if(preg_match( $reg, $subxml )) { 
                $arr[$key] = xml_to_array( $subxml ); 
            } else {
                $arr[$key] = $subxml; 
            } 
        } 
    } 
    return $arr; 
} 

// 页面显示数组格式，用于调试
function echo_xmlarr($res) {
    $res = xml_to_array($res);
//    echo "<pre>";
//    print_r($res);
//    echo "</pre>";
    return $res;
}


?>