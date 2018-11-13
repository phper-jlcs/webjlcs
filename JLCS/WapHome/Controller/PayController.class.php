<?php
namespace WapHome\Controller;
use Think\Controller;
class PayController extends Controller {
    public function index(){
        $total = $_POST['total'];
        $order_id = $_POST['order_id'];
        $pay = $_POST['pay'];
        switch($pay){
            case 1:
                echo $this->weixin();
                break;
            case 2:
                echo $this->alipay();
                break;
            case 3:
                echo $this->yinpay();
                break;
        }
    }

    public function weixin(){
        echo '这是微信支付方式';
    }

    public function alipay(){
        $alipay='这是支付宝支付方式';
        return $alipay;
    }

    public function yinpay(){
     echo '这是银联支付方式';
    }




}