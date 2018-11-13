<?php
namespace WapHome\Controller;
use Think\Controller;
class CartController extends Controller {
    public function index(){
        //获取用户id
        $user_id = $_SESSION['id'];
        $cart_mdl = M('weixin_carts');
        $product_mdl = M('weixin_products');
        $carts = $cart_mdl->where(array('user_id'=>$user_id))->select();
        foreach($carts as $key=>$val){
            $products = $product_mdl->where(array('id'=>$val['products_id']))->find();
            $products['num'] = $val['num'];
            $products['cat_id'] = $val['id'];
            $info[] = $products;
        }
        if(empty($info)){
            $status=1;
        }

        $this->assign('status',$status);
        $this->assign('carts',$info);
         $this->show();
    }

    public function doadd(){
        //$id 商品id $num 商品数量
        $user_id = $_SESSION['id'];
        $cart_mdl = M('weixin_carts');
        $product_mdl = M('weixin_products');
        $carts = $cart_mdl->where(array('user_id'=>$user_id))->select();
        foreach($carts as $key=>$val) {
            if ($val['products_id'] == $_POST['id']) {
               echo '2';exit;
            }
        }
            //添加时判断 如果增加的商品存在 提示。
            $info = array(
                'user_id'=>$user_id,
                'products_id'=>$_POST['id'],
                'createtime'=>date('Y-m-d H:i:s',time()),
                'num'=>$_POST['num'],
            );
            $add = $cart_mdl->add($info);
            if($add){
                echo '1';
            }
        }

    public function delcart(){
        header('Content-Type:text/php;charset=utf-8');
        $cart_mdl = M('weixin_carts');
       if($_POST['id']){
            $carts = $cart_mdl->where(array('id'=>$_POST['id']))->delete();
           if($carts == 1){
              echo 1;
           }else{
               echo 0;
           }
       }
    }



}