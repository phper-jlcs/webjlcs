<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/3/13
 * Time: 14:36
 */


//供奉权证正成接口  $product_id 为莲位id号
function warrant_select($product_id){
    header("Content-type: text/html; charset=utf-8");
    $product_mdl = M('products');
    $good_mdl = M('goods');
    $cat_mdl = M('cats');
    $region_mdl = M('regions');
    $temple_mdl = M('temples');

    $product_select = $product_mdl->where(array('id'=>$product_id))->find();
    if($product_select['goods_id']){
        $good_select = $good_mdl->where(array('goods_id'=>$product_select['goods_id']))->find();
        //抽A/B/C区。
        $own_name = $good_select['own_name'];
        //暂时仅限提取ABC区 不包含皇家宗祠
        $abc = mb_substr($own_name,3,1,'utf-8');
        $cat_select = $cat_mdl->where(array('id'=>$good_select['cat_id']))->find();
        $region_select = $region_mdl->where(array('id'=>$cat_select['region']))->find();
        $temple_select = $temple_mdl->where(array('id'=>$region_select['temple']))->find();
        $warrant_number = $temple_select['warrant'].'-'.$cat_select['warrant'].'-'.$abc.$product_select['product_name'];
        return $warrant_number;
    }
}

//反识别 通过供奉权证号获取id   $warrant为供奉权证号
function warrant_fanxiang($warrant){
    $product_mdl = M('products');
    $good_mdl = M('goods');
    $cat_mdl = M('cats');
    $explode = explode('-',$warrant);

    $cat_select = $cat_mdl->where(array('temple_sign'=>$explode[0],'warrant'=>$explode[1]))->find();
    if($cat_select['id']){
        //获取到A/B区
        $ab = substr($explode[2],0,1);
        $a=substr($explode[2],1);
        $product_name = $explode[3];
        //拼接殿区名
        $quyu = $cat_select['cat_name'].$ab.'区';
        //
        $filter['own_name'] = $quyu;
        $filter['goods_name']= $a;
        $good_select = $good_mdl->where($filter)->find();
        if($good_select['goods_id']){
            //拼接Product_name
            $product_name = $a.'-'.$product_name;
            $product_select = $product_mdl->where(array('goods_id'=>$good_select['goods_id'],'product_name'=>$product_name))->find();
        }else{
            echo '<script>alert("您输入的供奉权证号有误!");location.href=\'http://www.zgdigong.com/Home/User/activation\';</script>';
        }
        $product_id = $product_select['id'];
        return $product_id;
    }
}

//根据id查询认捐类型 通用function
function  position_type($product_id){
    $product_mdl = M('products');
    $good_mdl = M('goods');
    $cat_mdl = M('cats');
    $products = $product_mdl->where(array('id'=>$product_id))->find();
    $goods = $good_mdl->where(array('goods_id'=>$products['goods_id']))->find();
    $cats = $cat_mdl->where(array('id'=>$goods['cat_id']))->find();
    return $cats['type'];
}

//位置名字查询函数 根据id查询，，，
function  position_select($product_id){
    $product_mdl = M('products');
    $good_mdl = M('goods');
    $cat_mdl = M('cats');
    $region_mdl = M('regions');
    $temple_mdl = M('temples');
    $products = $product_mdl->where(array('id'=>$product_id))->find();
    $goods = $good_mdl->where(array('goods_id'=>$products['goods_id']))->find();
    $cats = $cat_mdl->where(array('id'=>$goods['cat_id']))->find();
    $regions =   $region_mdl->where(array('id'=>$cats['region']))->find();
    $temples = $temple_mdl->where(array('id'=>$regions['temple']))->find();
    $strname = $temples['temple'].$regions['region'].$goods['own_name'].$products['product_name'];
    $productname = $temples['temple'].$regions['region'].$goods['own_name'];
    $position = array(
        'productname'=>$productname,
        'simiao'=>$temples['temple'],
        'strname'=>$strname,
        'type'=>$regions['region'],
        'quyu'=>$goods['own_name'],
        'weizhi'=>$products['product_name'],
        'typesign'=>$goods['cat_id']==3?'皇家宗祠':'佛像位',
    );
    return $position;
}

//更新库存
function updatestore($product_id,$num){
    $product_mdl = M('products');
    //更改库存 应当判断当前商品为莲位还是shop商品，应当为-1
    $products = $product_mdl->where(array('id'=>$product_id))->find();
    if($products['danshuang'] == 'shop'){
        $info['product_store'] = $products['product_store']-$num;
    }else{
        $info['product_store'] = 0;
    }
    return $info;
}

//分页函数
 function pagefenye($count){
    $Page = new \Think\Page($count,8);
    $Page->lastSuffix=false;
    $Page->setConfig('prev','上一页');
    $Page->setConfig('next','下一页');
    $Page->setConfig('last','末页');
    $Page->setConfig('first','首页');
    $Page->setConfig('theme','%FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END% %HEADER%');
    $show = $Page->show();
     return $show;
}

//短信验证码服务
function obtain($phone){
    $now = gmdate("D, d M Y H:i:s") . " GMT";
    header("Date: $now");
    header("Expires: $now");
    header("Last-Modified: $now");
    header("Pragma: no-cache");
    header("Cache-Control: no-store, no-cache, max-age=0, must-revalidate");

    include_once("phpdemo_func.php");
    //服务器参数设置
    $svr_url = 'http://112.74.76.186:8030/service/httpService/httpInterface.do';   // 服务器接口路径
    $svr_param = array();
    $svr_param['username'] = 'JSM42398';    // 账号
    $svr_param['password'] = 'x07oyidu';    // 密码
    $svr_param['veryCode'] = 'mcln3akjrube';    // 通讯认证Key


    //验证码
    $srand = rand(1000,9999);
    $post_data = $svr_param;
    $post_data['method'] = 'sendMsg';
    $post_data['mobile'] = $phone;
    $post_data['content']= '@1@='.$srand;
    $post_data['msgtype']= '2';             // 1-普通短信，2-模板短信
    $post_data['tempid'] = 'JSM42398-0002'; // 模板编号
    $post_data['code']   = 'utf-8';         // utf-8,gbk
    $res = request_post($svr_url, $post_data);  // 如果账号开了免审，或者是做模板短信，将会按照规则正常发出，而不会进人工审核平台
    $status = echo_xmlarr($res);
    if($status['sms']['mt']['status'] == 0){
        return $srand;
    }
}
?>