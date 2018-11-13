<?php
namespace Mobile\Controller;
use Think\Controller;
class PayController extends Controller {

    public function choosepay(){
        $this->display('Pay/pay_success');
    }

    public function pay($product_id,$orderid,$price){
        $position = position_select($product_id);
        $position['orderid'] = $orderid;
        $position['price'] = $price;
        $this->assign('position',$position);
        $this->show();
    }

}