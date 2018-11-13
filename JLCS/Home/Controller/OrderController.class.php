<?php
namespace Home\Controller;
use Think\Controller;
class OrderController extends Controller {
    public function index($id=null){
        if(empty($_SESSION['name'])){
            $this->success('您还没登录',U('User/login'),3);
        }else{
            if(isset($id)){
                //实例化
                $product_mdl = M('products');
                $user_info_mdl = M('user_infos');
                $good_mdl = M('goods');
                $user_mdl = M('users');
                $users = $user_mdl->where(array('name'=>$_SESSION['name']))->find();
                //获取下单信息
                $user_infos = $user_info_mdl->where(array('user_id'=>$users['id']))->select();
                $filter['id'] = $id;
                $productinfo = $product_mdl->where($filter)->find();
                //判断当前商品是商城商品还是莲位
                if($productinfo['danshuang'] == 'shop'){
                    $sign = 1;
                    $this->assign('sign',$sign);
                }
                $goods = $good_mdl->where(array('goods_id'=>$productinfo['goods_id']))->find();
                if($goods['cat_id'] == 11 ||$goods['cat_id'] == 12 ||$goods['cat_id'] == 13||$goods['cat_id'] == 14){
                    $biaoshi = 1;
                }
                if($productinfo['now_price'] == 980000){
                    $productinfo['owns'] = '家族祠堂';
                }elseif($productinfo['danshuang']){
                    $productinfo['owns'] = $productinfo['product_name'];
                }else{
                    $productinfo['owns'] = '祈福莲位';
                }
                $goods = $good_mdl->where(array('goods_id'=>$productinfo['goods_id']))->find();
                $productinfo['own_name'] = $goods['own_name'];
                $productinfo['total'] = $productinfo['now_price'];
                $productinfo['nums'] = 1;
                $info[]=$productinfo;
                $this->assign('user_infos',$user_infos);
                $this->assign('agent',$user_infos[0]);
                $this->assign('info',$info);
                $this->assign('biaoshi',$biaoshi);
                $this->show();
            }else{
                $this->error('网页发生错误，将在3秒后调转到首页',U('Index/index'),3);
            }
        }

    }



    public  function addorder($data){
//        //实例化products表
//        $product_mdl = M('products');
//        $json = json_decode($data,true);
//        foreach($json as $key=>$val){
//            $filter['id'] = $val;
//            $products = $product_mdl->where($filter)->find();
//            $info[] = $products;
//        }
//        $this->assign('info',$info);
        $this->display('Order/index');
    }

    public  function ajax_order($id){
        $data = $_SESSION['name'];
        if(!$data){
            session('register','1');
            session('product_id',$id);
            echo 1;exit;
        }
        if($data){
            echo '111';
        }
        //实例化表
//        $products = M('products');
//            $filter['id']=$id;
//        $products->product_store = '0';
//        $data=$products->where($filter)->save();
//        if($data){
//            echo '111';
//        }else{
//            echo '222';
//        }
    }


    public function order_post(){
        if(empty($_SESSION['name'])){
            $this->success('您还没登录',U('User/login'),3);
        }else{
            $cart = substr($_POST['cartid'],1);
           $num = substr($_POST['numsid'],1);
            $var=explode(",",$cart);
            $varnum =explode(",",$num);
            //组装nums进数组
            $a = array();
            foreach($var as $k=>$v){
                $a[$k]['product_id'] = $v;
                $a[$k]['nums'] = $varnum[$k];
            }
            //实例化products表
            $product_mdl = M('products');
            $user_info_mdl = M('user_infos');
            $user_mdl = M('users');
            $goods_mdl = M('goods');
            $users = $user_mdl->where(array('name'=>$_SESSION['name']))->find();
            foreach($a as $key=>$val){
                $filter['id'] = $val['product_id'];
                $products = $product_mdl->where($filter)->find();
                if($products['now_price'] == 980000){
                    $products['owns'] = '家族祠堂';
                }elseif($products['danshuang'] == 'shop'){
                    $products['owns'] = $products['product_name'];
                    $products['sign'] = 1;
                }else{
                    $products['owns'] = '祈福莲位';
                }
                $goods = $goods_mdl->where(array('goods_id'=>$products['goods_id']))->find();
                $products['own_name'] = $goods['own_name'];
                $products['nums'] = $val['nums'];
                $products['total'] = $val['nums']*$products['now_price'];
                $info[] = $products;
            }
            //获取下单信息
            $user_infos = $user_info_mdl->where(array('user_id'=>$users['id']))->select();
//            echo '<pre>';print_r($info);exit;
            $this->assign('cartid',$cart);
            $this->assign('nums',$num);
            $this->assign('info',$info);
            $this->assign('user_infos',$user_infos);
            $this->display('Order/index');
        }

    }


    public function create_order(){
        //创建订单 获取各字段
        $product_mdl = M('products');
        $user_mdl = M('users');
        $order_mdl = M('orders');
        $order_detail_mdl = M('order_details');
        $user_info_mdl = M('user_infos');
        $cart_mdl = M('carts');
        $agreement_mdl = M('agrrements');
        if(empty($_SESSION['name'])){
            $this->success('您还没登录',U('User/login'),3);
        }else{
            $order_id = rand(1,1000)+time();   //订单号

            //订单完成才生成协议书编号
            //协议号自增+!
//            $agreement_ids = $agreement_mdl->order('id desc')->select();
//            $agreement_id = $agreement_ids[0]['agreement'];
//            $agreement_id += 1;
//            $agreement_add = $agreement_mdl->add(array('agreement'=>$agreement_id));
            //订单完成才生成协议书编号

            $cart = $_POST['cartid'];
            $var=explode(",",$cart);
            $num = substr($_POST['numsid'],1);
            $varnum =explode(",",$num);
           foreach($var as $k=>$v){
               $vara[$k]['cart_id']=$v;
               $vara[$k]['nums']=$varnum[$k];
           }
            $a = 0;
            $total = 0;
            if($_POST['id']){
                //商品数量
                $a = isset($_POST['num'])? $_POST['num']:1;
                $filter3['id'] = $_POST['id'];
                $products = $product_mdl->where($filter3)->find();
                if($products['product_store'] == 0){
                    $this->error('该商品已售出,请重新购买',U('Index/banner'),3);
                }elseif($products['danshuang'] == 'shop'){
                    $beizhu = '小商品';
                }
                $total = $products['now_price']*$a;
            }else{
                foreach($vara as $key=>$val){
                    $a += $val['nums'];
                    $filter['id'] = $val['cart_id'];
                    $products = $product_mdl->where($filter)->find();
                    if($products['danshuang'] == 'shop'){
                        $beizhu = '小商品';
                    }
                    $total += $products['now_price']*$val['nums'];
                }
            }
            $order_num = $a;                //总数
            $order_total_price = $total;  //总价
            $ordername = '常州九龙禅寺认捐佛像位';
            $orderdescr = '功德无量';
            $filter1['name'] = $_SESSION['name'];
            $users = $user_mdl->where($filter1)->find();
            $user_id = $users['id']; //用户id
            $status = '0';   //未付款
            $createtime = date('Y-m-d H:i:s',time());
            //获取收货地址
            $user_info_id = $_POST['addressid'];
            $user_infos = $user_info_mdl->where(array('id'=>$user_info_id))->find();
            //获取代理商
            $agent_aid = $user_infos['agent_aid'];
            $orderinfo = array(
                'order_id' => $order_id,
                'order_num' => $order_num,
                'order_total_price' => $order_total_price,
                'user_id' => $user_id,
                'status' => $status,
                'createtime' => $createtime,
                'agent_aid' => $agent_aid,
                'beizhu'=> $beizhu,
                'user_info_id' => $user_infos['id'],
                'phone' =>$user_infos['phone'],
            );
            $orders = $order_mdl->add($orderinfo);
            if($orders){
                if($_POST['id']){
                    $orderid = $orders;
                    $product_id = $_POST['id'];
                    //查询 生成供奉权证接口
                    $warrant_number = warrant_select($product_id);
                    //
                    $filter2['id'] = $_POST['id'];
                    $products = $product_mdl->where($filter2)->find();
                    $price = $products['now_price'];
                    $user_id = $users['id'];
                    $num = isset($_POST['num'])? $_POST['num']:1;
                    $order_details = array(
                        'orderid' => $orderid,
                        'product_id' => $product_id,
                        'num' => $num,
                        'price' => $price,
                        'user_id' => $user_id,
                        'description'=>$warrant_number,
                    );
                    $id = $order_detail_mdl->add($order_details);
                    if(!$id){
                        $this->error('订单生成失败',U('Order/checkorder'),3);
                    }
                }else{
                    foreach($vara as $key=>$val){
                        $orderid = $orders;
                        $product_id = $val['cart_id'];
                        //查询 生成供奉权证接口
                        $warrant_number = warrant_select($product_id);
                        $num = $val['nums'];
                        $filter2['id'] = $val['cart_id'];
                        $products = $product_mdl->where($filter2)->find();
                        $price = $products['now_price'];
                        $user_id = $users['id'];

                        $order_details = array(
                            'orderid' => $orderid,
                            'product_id' => $product_id,
                            'num' => $num,
                            'price' => $price,
                            'user_id' => $user_id,
                            'description'=>$warrant_number,
                        );
                        $id = $order_detail_mdl->add($order_details);
                        if(!$id){
                            $this->error('订单生成失败',U('Order/checkorder'),3);
                        }
                    }
                }

//                创建订单成功后删除购物车的数据
                $del['user_id'] = $user_id;
                foreach($vara as $key=>$val){
                    $del['products_id'] = $val['cart_id'];
                    $cart_mdl->where($del)->delete();
                }
                session('order_id',$order_id);
                session('total',$total);
                session('ordername',$ordername);
                session('orderdescr',$orderdescr);
                $this->success('订单生成成功',U('Order/checkorder'),2);
            }else{
                $this->error('订单生成失败,请重新购买',U('Order/checkorder'),3);
            }
        }


    }

    //生成二维码
    public function verify(){
                        //生成二维码图片
                include __ROOT__.'ThinkPHP/Library/Vendor/phpqrcode/phpqrcode.php';
                $errorLevel = "L";
                $data = $_POST['url'];
                $size = 4;
                $QRcode = new \QRcode();
                $path = __ROOT__."Public/images/code/";
                if(!file_exists($path)) {
                      mkdir($path, 0700);
                 }
                    // 生成的文件名
                 $fileName = $path.$_POST['imgname'].'.png';

                 ob_clean();
                header('Content-Type: image/png');
                $img = $QRcode->png($data,$fileName,$errorLevel,$size);
                if($img){
                    echo '1';
                }
    }

    public  function add_info(){

        $user_info_mdl = M('user_infos');
        $user_mdl = M('users');
        $agent_mdl = M('agents');
        $users = $user_mdl->where(array('name'=>$_SESSION['name']))->find();
        $user_id = $users['id'];
        $agent_aid = $_POST['agent_aid'];
        $userinfo =array(
            'agent_aid'=>$agent_aid,
        );
        $agents = $agent_mdl->where(array('agent_aid'=>$agent_aid))->find();
        //代理商不存在
        if(!$agents){
            echo 'c';exit;
        }
        $useragent = $user_info_mdl->where(array('user_id'=>$user_id))->find();
        //用户没有个人详情
        if(!$useragent){
            echo 'd';exit;
        }
        $user_infos = $user_info_mdl->where(array('user_id'=>$user_id))->save($userinfo);
        if($user_infos == 1){
           echo 'a';exit;
        }else{
           echo 'b';exit;
        }
    }

    public  function del_address($id){
        $user_info_mdl = M('user_infos');
        $filter['id'] = $id;
        $user_infos = $user_info_mdl->where($filter)->delete();
        if($user_infos){
            echo 'a';
        }else{
            echo 'b';
        }
    }
}