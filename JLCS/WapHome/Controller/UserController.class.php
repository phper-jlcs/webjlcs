<?php
namespace WapHome\Controller;
use Think\Controller;
class UserController extends Controller {

    public function index(){
        $userinfo = array(
          'nickname'=>$_SESSION['nickname'],
          'headimgurl'=>$_SESSION['headimgurl'],
        );
        $this->assign('userinfo',$userinfo);
        $this->show();
    }


    public function order($value=null){
        $order_mdl = M('weixin_orders');
        $order_detail_mdl = M('weixin_order_details');
        $product_mdl = M('weixin_products');
        $user_id = $_SESSION['id'];
        //传输过来的筛选状态 value=1,2,3,4,5
        if($value && $value != 1){
            $orders = $order_mdl->where(array('user_id'=>$user_id,'order_status'=>0))->select();
        }else{
            $orders = $order_mdl->where(array('user_id'=>$user_id))->select();
        }
        foreach($orders as $key=>$val){
            $order_details = $order_detail_mdl->where(array('orderid'=>$val['order_id']))->select();
            //清空数组 以免存入前一条订单的信息
            $products_info = array();
            foreach($order_details as $key1=>$val1){
                $products = $product_mdl->where(array('id'=>$val1['product_id']))->find();
                $products_info[] = $products;
            }
            $info =array(
                'pay_status'=>$val['order_status'],
                'order_id'=>$val['order_id'],
                'total'=>$val['order_total_price'],
                'productinfo'=>$products_info,
            );
            $orderinfos[] = $info;

        }
       if($value && $value != 1){
//           echo '<pre>';print_r($orderinfos);exit;
           $this->assign('orderinfos',$orderinfos);
           $this->display('ajax_order');
       }else{
           $this->assign('orderinfos',$orderinfos);
           $this->show();

       }

    }


    public function ajax_order($value=null){
        $value = $_POST['value'];
        $this->order($value);
    }

    public function collection(){
        $user_id = $_SESSION['id'];
        $collect_mdl = M('weixin_collects');
        $product_mdl = M('weixin_products');
        $collects = $collect_mdl->where(array('user_id'=>$user_id))->select();
        if(!empty($collects)){
            foreach($collects as $key=>$val){
                $products = $product_mdl->where(array('id'=>$val['product_id']))->find();
                $products['shoucang_id'] = $val['id'];
                $collectinfo[] = $products;
            }
        }
        $this->assign('collectinfo',$collectinfo);
        $this->show();
    }





}