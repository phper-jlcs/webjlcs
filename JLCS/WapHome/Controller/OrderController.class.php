<?php
namespace WapHome\Controller;
use Think\Controller;
class OrderController extends Controller {
    //立即购买
    public function index(){
        $product_mdl = M('weixin_products');
        $cart_mdl = M('weixin_carts');
        $address_mdl = M('weixin_address');
        $user_id = $_SESSION['id'];
        //显示默认收货地址

            $address = $address_mdl->where(array('user_id'=>$user_id,'moren'=>1))->find();

        //购物车结算的订单

        if($_POST['cartid']){
            $cart = $_POST['cartid'];
            $var=explode(",",$cart);
            array_shift($var);
            $num = 0;
            foreach($var as $key=>$val){
                $carts = $cart_mdl->where(array('id'=>$val))->find();
                $products = $product_mdl->where(array('id'=>$carts['products_id']))->find();
                $products['num'] = $carts['num'];
                $num += $carts['num'];
                $info[] = $products;
            }
            if(!empty($info)){
                //默认收货地址
                if($address){
                    $this->assign('address',$address);
                }
                $this->assign('nums',$num);
                $this->assign('cartid',$cart);
                $this->assign('total',$_POST['total']);
                $this->assign('products',$info);
                $this->show();
            }
        }else{
            //立即购买结算的订单
            $products = $product_mdl->where(array('id'=>$_POST['id']))->select();
            if(!empty($products)){
                //默认收货地址
                if($address){
                    $this->assign('address',$address);
                }
                $liji = 1;
                $this->assign('liji',$liji);
                $products[0]['num'] = $_POST['num'];
                $this->assign('productid',$_POST['id']);
                $this->assign('nums',$_POST['num']);
                $this->assign('total',$_POST['num']*$products[0]['now_price']);
                $this->assign('products',$products);
                $this->show();
            }
        }
    }

    //立即购买 生成订单
    public function create_order(){
        $order_mdl = M('weixin_orders');
        $order_detail_mdl = M('weixin_order_details');
        $product_mdl = M('weixin_products');
        //创建订单 字段
        $order_id = time()+rand(1,999);
        $order_num = $_POST['nums'];
        $product_id = $_POST['product_id'];
        $products =$product_mdl->where(array('id'=>$product_id))->find();
        $order_total_price = $products['now_price']*$order_num;
        $user_id = $_SESSION['id'];
        $order_status = 0;
        $createtime = date('Y-m-d H:i:s',time());
        $address_id = $_POST['addressid'];
        $liuyan = $_POST['liuyan'];
        $peisong = $_POST['peisong'];
        $info = array(
            'order_id'=>$order_id,
            'order_num'=>$order_num,
            'order_total_price'=>$order_total_price,
            'user_id'=>$user_id,
            'order_status'=>$order_status,
            'createtime'=>$createtime,
            'address_id'=>$address_id,
            'liuyan'=>$liuyan,
            'peisong'=>$peisong,
        );
        //写入订单表和订单详情表
        $orders = $order_mdl->add($info);
        $orderinfo = array(
            'orderid'=>$order_id,
            'product_id'=>$_POST['product_id'],
            'num'=>$order_num,
            'price'=>$order_total_price,
            'user_id'=>$user_id,
        );
        $order_details = $order_detail_mdl->add($orderinfo);
       if($orders){
           //详情单生成
           if($order_details){
               session('order_id',$order_id);
               session('total',$order_total_price);
                $this->redirect('submit_order');
           }

       }else{
           $this->success('订单生成失败',U('Order/index'),1);
       }
    }

    public function submit_order(){
        $this->display('Order/submit-order');
    }

    //购物车生成订单
    public function create_cart_order(){
        $order_mdl = M('weixin_orders');
        $order_detail_mdl = M('weixin_order_details');
        $product_mdl = M('weixin_products');
        $cart_mdl = M('weixin_carts');
        //生成订单
        if($_POST['cartid']){
            $var =explode(',',$_POST['cartid']);
            array_shift($var);
            $order_id = time()+rand(1,999);
            $user_id = $_SESSION['id'];
            $order_status = 0;
            $createtime = date('Y-m-d H:i:s',time());
            $address_id = $_POST['addressid'];
            $liuyan = $_POST['liuyan'];
            $peisong = $_POST['peisong'];
            $num = 0;
            $order_total_price = 0;
            foreach($var as $key=>$val){
                $carts = $cart_mdl->where(array('id'=>$val))->find();
                $products = $product_mdl->where(array('id'=>$carts['products_id']))->find();
                $num += $carts['num'];
                $order_total_price += $carts['num']*$products['now_price'];
            }
            $info = array(
                'order_id'=>$order_id,
                'order_num'=>$num,
                'order_total_price'=>$order_total_price,
                'user_id'=>$user_id,
                'order_status'=>$order_status,
                'createtime'=>$createtime,
                'address_id'=>$address_id,
                'liuyan'=>$liuyan,
                'peisong'=>$peisong,
            );
            //写入订单表和订单详情表
            $orders = $order_mdl->add($info);
            foreach($var as $key=>$val){
                $carts = $cart_mdl->where(array('id'=>$val))->find();
                $products = $product_mdl->where(array('id'=>$carts['products_id']))->find();
                $orderinfo = array(
                    'orderid'=>$order_id,
                    'product_id'=>$carts['products_id'],
                    'num'=>$carts['num'],
                    'price'=>$carts['num']*$products['now_price'],
                    'user_id'=>$user_id,
                );
                //下单后 删除购物车该商品
                $cart_mdl->where(array('id'=>$val))->delete();
                $order_details = $order_detail_mdl->add($orderinfo);
            }
            if($orders){
                if($order_details){
                    session('order_id',$order_id);
                    session('total',$order_total_price);
                    $this->redirect('submit_order');
                }
            }else{
                $this->success('订单生成失败',U('Order/index'),1);
            }
        }
    }

    //选择地址
    public function choiceaddress($id=null,$num=null){
        $address = M('weixin_address');
        $ad = $address->where(array('user_id'=>$_SESSION['id']))->select();
        $this->assign('ad',$ad);
        $this->assign('id',$id);
        $this->assign('num',$num);
        $this->display('Order/choice-address');
    }
    //管理地址
    public function address(){
        $addr = M('weixin_address');
        $add = $addr->where(array('user_id'=>$_SESSION['id']))->select();
        $this->assign('add',$add);
        $this->display('Order/address');
    }


    //删除地址
    public function del($id){
        $addr_mdl = M('weixin_address');
        $add_del = $addr_mdl->where(array('id'=>$id))->delete();
        if($add_del){
            $this->redirect('Order/address');
        }else{
            $this->redirect('Order/address');
        }
    }

    /**
     * 添加收货地址
     */
    public function add_address(){
        $this->display('Order/add-address');
    }
    public function do_address() {
        if(is_POST) {
            //实例化地址表
            $address_mdl = M('weixin_address');
            //每个人默认地址只有一个 默认值1 如果想要修改默认地址0
            $user_id = $_SESSION['id'];
            $info = array(
                'user_id'=>$user_id,
                'name'=>$_POST['name'],
                'address'=>$_POST['address'],
                'phone'=>$_POST['phone'],
                'moren'=>$_POST['is_default'],
            );
            if($_POST['is_default'] == 1){
                $xiugai = array('moren'=>0);
                $address_mdl->where(array('user_id'=>$user_id,'moren'=>1))->save($xiugai);
            }
            $address = $address_mdl->add($info);
            if($address){
                $this->redirect('address');
            }else{
                $this->redirect('add_address');
            }

        }
    }

    /**
     * 修改收货地址
     */
    public function editaddress($id) {
        //实例化地址表
        $address = M('weixin_address');
        $editaddress = $address->where(array('id'=>$id))->find();
        $this->assign('address_data',$editaddress);
        $this->show();
    }


    public function doedit($id){
        $address = M('weixin_address');
        $user_id = $_SESSION['id'];
        $info = array(
            'user_id'=>$user_id,
            'name'=>$_POST['name'],
            'address'=>$_POST['address'],
            'phone'=>$_POST['phone'],
            'moren'=>$_POST['is_default'],
        );
        if($_POST['is_default'] == 1){
            $xiugai = array('moren'=>0);
            $address->where(array('user_id'=>$user_id,'moren'=>1))->save($xiugai);
        }
        $editaddress = $address->where(array('id'=>$id))->save($info);

        if($editaddress == 1){
            $this->redirect('address');
        }else{
            $this->redirect('editaddress',array('id'=>$id));
        }
    }


    public function indexs(){
        $product_mdl = M('weixin_products');
        $cart_mdl = M('weixin_carts');
        $address_mdl = M('weixin_address');
        $user_id = $_SESSION['id'];
        //显示默认收货地址 若用户选择 显示该地址


            $address = $address_mdl->where(array('id'=>$_POST['addressid']))->find();
        //购物车结算的订单
        if(!$_POST['chuannum']){
            $cart = $_POST['chuanid'];
            $var=explode(",",$cart);
            array_shift($var);
            $num = 0;
            $total = 0;
            foreach($var as $key=>$val){
                $carts = $cart_mdl->where(array('id'=>$val))->find();
                $products = $product_mdl->where(array('id'=>$carts['products_id']))->find();
                $products['num'] = $carts['num'];
                $num += $carts['num'];
                $total += $products['num']*$products['now_price'];
                $info[] = $products;
            }
            if(!empty($info)){
                //默认收货地址
                if($address){
                    $this->assign('address',$address);
                }
                $this->assign('nums',$num);
                $this->assign('cartid',$cart);
                $this->assign('total',$total);
                $this->assign('products',$info);
                $this->show();
            }
        }else{
            //立即购买结算的订单
            $products = $product_mdl->where(array('id'=>$_POST['chuanid']))->select();
            if(!empty($products)){
                //默认收货地址
                if($address){
                    $this->assign('address',$address);
                }
                $liji = 1;
                $this->assign('liji',$liji);
                $products[0]['num'] = $_POST['chuannum'];
                $this->assign('productid',$_POST['chuanid']);
                $this->assign('nums',$_POST['chuannum']);
                $this->assign('total',$_POST['chuannum']*$products[0]['now_price']);
                $this->assign('products',$products);
                $this->show();
            }
        }
    }


}