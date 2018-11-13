<?php
namespace Home\Controller;
use Think\Controller;
class CartController extends Controller {
    public function index(){
        //实例化表
        $cart = M('carts');
        $goods_mdl = M('goods');
        $user_mdl = M('users');
        if(empty($_SESSION['name'])){
            $this->success('您还没登录',U('User/login'),3);
        }else{
            $filter['name'] = $_SESSION['name'];
            $users= $user_mdl->where($filter)->find();
            $products_mdl = M('products');
            $filter1['user_id'] = $users['id'];
            $carts = $cart->where($filter1)->select();
            foreach($carts as $key=>$val){
                $filter['id'] = $val['products_id'];
                if($val['price'] == 980000){
                    $carts[$key]['owns'] = '家族祠堂';
                }else{
                    $carts[$key]['owns'] = '祈福莲位';
                }
                $products = $products_mdl->where($filter)->find();
                //判断商品是商城物品还是莲位
                if($products['danshuang'] == 'shop'){
                    $carts[$key]['sign'] = 1;
                }
                $carts[$key]['product_store'] = $products['product_store'];

                $filter1['goods_id'] = $products['goods_id'];
                $goods = $goods_mdl->where($filter1)->find();
                $carts[$key]['own_name'] = $goods['own_name'];
                $price = $val['price'];
                $total += $price;
            }

            if(empty($carts)){
                $status=1;
            }

            $count = $cart->where($filter)->count();
            //分配数据
            $row=array('count'=>$count,'total'=>$total);
            $this->assign('status',$status);
            $this->assign('row',$row);
            $this->assign('carts',$carts);
            $this->display();
        }
    }



    public  function clear_cart(){
        $id = $_POST['id'];
        //实例化表
        $cart = M('carts');
        //删除购物车里的该商品
        $filter['cat_id']=$id;
        $status=$cart->where($filter)->delete();
       if($status == 1){
           echo 1;
       }else{
           echo 2;
       }
    }
}