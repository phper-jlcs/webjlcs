<?php
namespace Home\Controller;
use Think\Controller;
class TransferController extends Controller {
//    public function index(){
//        $transfer_mdl = M('transfers');
//        $product_mdl = M('products');
//        $good_mdl = M('goods');
//        $transfers = $transfer_mdl->select();
//        foreach($transfers as $key=>$val){
//            $products = $product_mdl->where(array('id'=>$val['product_id']))->find();
//
//                $goods = $good_mdl->where(array('goods_id'=>$products['goods_id']))->find();
//                $transfers[$key]['simiao'] = '九龙禅寺';
//                $transfers[$key]['quyu'] = '万佛堂';
//                $transfers[$key]['own_name'] = $goods['own_name'].$products['product_name'];
//                $transfers[$key]['price'] =$products['now_price'] ;
//
//
//        }
//        $this->assign('transfers',$transfers);
//        $this->show();
//    }
//
//
//
    public function index(){
        $product_mdl = M('products');
        $good_mdl = M('goods');
        $own_mdl = M('owns');

            //查询当前用户在归属表中是否存在商品
            $owns = $own_mdl->where(array('user_id'=>$_SESSION['id']))->select();
            if(!empty($owns)){
                foreach($owns as $key=>$val){
                    //查询用户的商品
                    $products = $product_mdl->where(array('id'=>$val['product_id']))->find();
                    $goods = $good_mdl->where(array('goods_id'=>$products['goods_id']))->find();
                    $str = $goods['own_name'].$products['product_name'];
                    $owns[$key]['str'] = $str;
                }
            }else{
                $owns[0]['str'] = '您还没有可以赠送的商品，前去认捐吧';
            }
        $this->assign('transfers',$owns);
        $this->display('Transfer/index');
    }
//
//    public function add(){
//        $product_mdl = M('products');
//        $good_mdl = M('goods');
//        $own_mdl = M('owns');
//        if($_SESSION['name'] == ''){
//            $_SESSION['zhuan'] = 1;
//            $this->error('请登录后再进行赠送',U('User/login'),2);
//        }else{
//            //查询当前用户在归属表中是否存在商品
//            $owns = $own_mdl->where(array('user_id'=>$_SESSION['id']))->select();
//            if(!empty($owns)){
//                foreach($owns as $key=>$val){
//                    //查询用户的商品
//                    $products = $product_mdl->where(array('id'=>$val['product_id']))->find();
//                    $goods = $good_mdl->where(array('goods_id'=>$products['goods_id']))->find();
//                    $str = $goods['own_name'].$products['product_name'];
//                    $owns[$key]['str'] = $str;
//                }
//            }else{
//                $owns[0]['str'] = '您还没有可以赠送的商品，前去认捐吧';
//            }
//        }
//        $this->assign('transfers',$owns);
//        $this->show();
//    }
//
//    public function details($id=null){
//        $transfer_mdl = M('transfers');
//        $product_mdl = M('products');
//        $good_mdl = M('goods');
//        $transfers = $transfer_mdl->where(array('id'=>$id))->select();
//        foreach($transfers as $key=>$val){
//            $products = $product_mdl->where(array('id'=>$val['product_id']))->find();
//            if($products['product_store'] == 1){
//                $goods = $good_mdl->where(array('goods_id'=>$products['goods_id']))->find();
//                $transfers[$key]['simiao'] = '九龙禅寺';
//                $transfers[$key]['quyu'] = '万佛堂';
//                $transfers[$key]['own_name'] = $goods['own_name'].$products['product_name'];
//            }
//
//        }
//        $this->assign('transfers',$transfers);
//        $this->show();
//    }
//
//    public function doadd(){
//        $examine_mdl = M('examines');
//        $transfer_mdl = M('transfers');
//        $product_mdl = M('products');
//        $good_mdl = M('goods');
//        //组装商品名字
//        $products = $product_mdl->where(array('id'=>$_POST['product_id']))->find();
//        if($products){
//                //查询用户的商品
//                $goods = $good_mdl->where(array('goods_id'=>$products['goods_id']))->find();
//                $str = $goods['own_name'].$products['product_name'];
//            }
//        $info = array(
//            'product_id'=>$_POST['product_id'],
//            'user_id'=>$_SESSION['id'],
//            'relname'=>$_POST['relname'],
//            'phone'=>$_POST['phone'],
//            'address'=>$_POST['address'],
//            'name'=>$str,
//            'descr'=>$_POST['descr'],
//            'price'=>$_POST['price'],
//            'time'=>date('Y-m-d H:i:s',time()),
//        );
//        //判断当前商品是否已经申请转让
//        $examines=$examine_mdl->where(array('product_id'=>$_POST['product_id']))->find();
//        if($examines){
//           $this->error('当前商品已经申请过，请勿多次添加',U('add'),2);
//        }
//         $transfers = $transfer_mdl->where(array('product_id'=>$_POST['product_id']))->find();
//        if($transfers){
//            $this->error('当前商品已经在赠送列表，请去查看吧',U('index'),2);
//        }
//        if($examine_mdl->add($info)){
//            $this->success('申请成功，请等待管理员审核',U('index'),2);
//        }else{
//            $this->error('申请失败，请重新提交',U('add'),2);
//        }
//    }


    public function dolist(){
        $transfer_order_mdl = M('transfer_orders');
        $own_mdl = M('owns');
        //检索warrant获取id值
        $product_id = warrant_fanxiang($_POST['warrant']);
        if(!$product_id){
           $this->error('您输入的供奉权证号有误！请核对',U('index'),1);
        }
        $Data = array(
            'relname'=>$_POST['relname'],
            'phone'=>$_POST['phone'],
            'price'=>$_POST['price'],
            'city'=>$_POST['city'],
            'time'=>date('Y-m-d H:i:s',time()),
            'warrant'=>$_POST['warrant'],
            'traname'=>$_POST['traname'],
            'traphone'=>$_POST['traphone'],
            'product_id'=>$product_id,
        );
        $transfer_orders = $transfer_order_mdl->add($Data);
        //
        //  修改属主表
        //  待确认流程
        //
        if($transfer_orders){
            $this->success('登记成功',U('index'),1);
        }else{
            $this->error('登记失败',U('index'),1);
        }
    }
}