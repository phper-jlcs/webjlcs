<?php
namespace Home\Controller;
use Think\Controller;
class PayController extends Controller {
    //在类初始化方法中，引入相关类库
    public function _initialize() {
        vendor('Alipay.Corefunction');
        vendor('Alipay.Md5function');
        vendor('Alipay.Notify');
        vendor('Alipay.Submit');
    }

    public function index(){
        $this->show();
    }

    public function doalipay(){
        //引入框架核心类库
        vendor('Alipay.Corefunction');
        vendor('Alipay.Md5function');
        vendor('Alipay.Notify');
        vendor('Alipay.Submit');
        //实例化类库
        /*********************************************************
        把alipayapi.php中复制过来的如下两段代码去掉，
        第一段是引入配置项，
        第二段是引入submit.class.php这个类。
        为什么要去掉？？
        第一，配置项的内容已经在项目的Config.php文件中进行了配置，我们只需用C函数进行调用即可；
        第二，这里调用的submit.class.php类库我们已经在PayAction的_initialize()中已经引入；所以这里不再需要；
         *****************************************************/
        // require_once("alipay.config.php");
        // require_once("lib/alipay_submit.class.php");

        //这里我们通过TP的C函数把配置项参数读出，赋给$alipay_config；
        $alipay_config=C('alipay_config');
        /**************************请求参数**************************/
        $payment_type = "1"; //支付类型 //必填，不能修改
        $notify_url = C('alipay.notify_url'); //服务器异步通知页面路径
        $return_url = C('alipay.return_url'); //页面跳转同步通知页面路径
        $seller_email = C('alipay.seller_email');//卖家支付宝帐户必填
        $out_trade_no = $_SESSION['order_id']?$_SESSION['order_id']:$_POST['order_id'];//商户订单号 通过支付页面的表单进行传递，注意要唯一！
        $subject = $_SESSION['ordername']?$_SESSION['ordername']:$_POST['ordername'];  //订单名称 //必填 通过支付页面的表单进行传递
        $total_fee = $_SESSION['total']?$_SESSION['total']:$_POST['total'];   //付款金额  //必填 通过支付页面的表单进行传递
        $body = $_SESSION['orderdescr']?$_SESSION['orderdescr']:$_POST['orderdescr'];  //订单描述 通过支付页面的表单进行传递
        $show_url = '';  //商品展示地址 通过支付页面的表单进行传递
        $anti_phishing_key = "";//防钓鱼时间戳 //若要使用请调用类文件submit中的query_timestamp函数
        $exter_invoke_ip = get_client_ip(); //客户端的IP地址
        /************************************************************/

        //构造要请求的参数数组，无需改动
        $parameter = array(
            "service" => "create_direct_pay_by_user",
            "partner" => trim($alipay_config['partner']),
            "payment_type"    => $payment_type,
            "notify_url"    => $notify_url,
            "return_url"    => $return_url,
            "seller_email"    => $seller_email,
            "out_trade_no"    => $out_trade_no,//订单号
            "subject"    => $subject, //订单名称
            "total_fee"    => $total_fee,//付款金额
            "body"            => $body,//订单描述
            "show_url"    => $show_url, //商品展示地址
            "anti_phishing_key"    => $anti_phishing_key, //防钓鱼时间戳
            "exter_invoke_ip"    => $exter_invoke_ip, //客户端IP地址
            "_input_charset"    => trim(strtolower($alipay_config['input_charset']))
        );
        //建立请求
        $alipaySubmit = new \AlipaySubmit($alipay_config);
        $html_text = $alipaySubmit->buildRequestForm($parameter,"post", "确认");
        echo $html_text;
    }

    /******************************
    服务器异步通知页面方法
    其实这里就是将notify_url.php文件中的代码复制过来进行处理

     *******************************/
    function notifyurl(){
        /*
        同理去掉以下两句代码；
        */
        //require_once("alipay.config.php");
        //require_once("lib/alipay_notify.class.php");
        vendor('Alipay.Corefunction');
        vendor('Alipay.Md5function');
        vendor('Alipay.Notify');
        vendor('Alipay.Submit');
        //这里还是通过C函数来读取配置项，赋值给$alipay_config
        $alipay_config=C('alipay_config');
        //计算得出通知验证结果
        $alipayNotify = new \AlipayNotify($alipay_config);
        $verify_result = $alipayNotify->verifyNotify();
        if($verify_result) {
            //验证成功
            //获取支付宝的通知返回参数，可参考技术文档中服务器异步通知参数列表
            $out_trade_no   = $_POST['out_trade_no'];      //商户订单号
            $trade_no       = $_POST['trade_no'];          //支付宝交易号
            $trade_status   = $_POST['trade_status'];      //交易状态
            $total_fee      = $_POST['total_fee'];         //交易金额
            $notify_id      = $_POST['notify_id'];         //通知校验ID。
            $notify_time    = $_POST['notify_time'];       //通知的发送时间。格式为yyyy-MM-dd HH:mm:ss。
            $buyer_email    = $_POST['buyer_email'];       //买家支付宝帐号；
            $parameter = array(
                "out_trade_no"     => $out_trade_no, //商户订单编号；
                "trade_no"     => $trade_no,     //支付宝交易号；
                "total_fee"     => $total_fee,    //交易金额；
                "trade_status"     => $trade_status, //交易状态
                "notify_id"     => $notify_id,    //通知校验ID。
                "notify_time"   => $notify_time,  //通知的发送时间。
                "buyer_email"   => $buyer_email,  //买家支付宝帐号；
            );
            if($_POST['trade_status'] == 'TRADE_FINISHED') {
                //
            }else if ($_POST['trade_status'] == 'TRADE_SUCCESS') {                           
                if(!checkorderstatus($out_trade_no)){
                    orderhandle($out_trade_no);
                    //进行订单处理，并传送从支付宝返回的参数；
                }
            }
            echo "success";        //请不要修改或删除
        }else {
            //验证失败
            echo "fail";
        }
    }


    /*
       页面跳转处理方法；
       这里其实就是将return_url.php这个文件中的代码复制过来，进行处理；
       */
    function returnurl(){
        vendor('Alipay.Corefunction');
        vendor('Alipay.Md5function');
        vendor('Alipay.Notify');
        vendor('Alipay.Submit');
        //头部的处理跟上面两个方法一样，这里不罗嗦了！
        $finance_mdl = M('finances');
        $alipay_config=C('alipay_config');
        $alipayNotify = new \AlipayNotify($alipay_config);//计算得出通知验证结果
        $verify_result = $alipayNotify->verifyReturn();
        if($verify_result) {
            //验证成功
            //获取支付宝的通知返回参数，可参考技术文档中页面跳转同步通知参数列表
            $out_trade_no   = $_GET['out_trade_no'];      //商户订单号
            $trade_no       = $_GET['trade_no'];          //支付宝交易号
            $trade_status   = $_GET['trade_status'];      //交易状态
            $total_fee      = $_GET['total_fee'];         //交易金额
            $notify_id      = $_GET['notify_id'];         //通知校验ID。
            $notify_time    = $_GET['notify_time'];       //通知的发送时间。
            $buyer_email    = $_GET['buyer_email'];       //买家支付宝帐号；

            $parameter = array(
                "out_trade_no"     => $out_trade_no,      //商户订单编号；
                "trade_no"     => $trade_no,          //支付宝交易号；
                "total_fee"      => $total_fee,         //交易金额；
                "trade_status"     => $trade_status,      //交易状态
                "notify_id"      => $notify_id,         //通知校验ID。
                "notify_time"    => $notify_time,       //通知的发送时间。
                "buyer_email"    => $buyer_email,       //买家支付宝帐号
            );

            if($_GET['trade_status'] == 'TRADE_FINISHED' || $_GET['trade_status'] == 'TRADE_SUCCESS') {

                //开始写处理订单逻辑
                //1.修改订单付款状态  2.修改商品库存 3.写入账单finances
                if(!$this->checkorderstatus($_GET['out_trade_no'])){
                    $this->orderhandle($_GET['out_trade_no']);
                };
                //
                $this->redirect(C('alipay.successpage'),array('order_id'=>$out_trade_no));//跳转到配置项中配置的支付成功页面；
            }else {
                echo "trade_status=".$_GET['trade_status'];
                $this->redirect(C('alipay.errorpage'));//跳转到配置项中配置的支付失败页面；
            }
        }else {
            //验证失败
            //如要调试，请看alipay_notify.php页面的verifyReturn函数
            echo "支付失败！";
        }
    }

//在线交易订单支付处理函数
//函数功能：根据支付接口传回的数据判断该订单是否已经支付成功；
//返回值：如果订单已经成功支付，返回true，否则返回false；
    function checkorderstatus($ordid){
        $Ord=M('orders');
        $ordstatus=$Ord->where('order_id='.$ordid)->getField('status');
        if($ordstatus==1){
            return true;
        }else{
            return false;
        }
    }
    //处理订单函数
//更新订单状态，写入订单支付后返回的数据
    function orderhandle($parameter){
        $Ord=M('orders');
        $product_mdl = M('products');
        $order_details_mdl = M('order_details');
        $finance_mdl = M('finaces');
        $own_mdl = M('owns');
        $orderid=$parameter;
        $data['status'] = 1;
        //事物回滚参数
        $allAdded = true;
        $own_mdl->startTrans(); //开启事物
        $status = $Ord->where(array('order_id'=>$orderid))->save($data);
        $orders = $Ord->where(array('order_id'=>$orderid))->find();
        if($status == 1){
            //改变商品数据库
            $order_details = $order_details_mdl->where(array('orderid'=>$orders['id']))->select();
            if(!empty($order_details)){
                foreach($order_details as $key=>$val){
                    //更新库存
                    $product_id = $val['product_id'];
                    $num =  $val['num'];
                    $info = $this->updatestore($product_id,$num);
                    $product_mdl->where(array('id'=>$product_id))->save($info);
                    //写入账单
                    $financeData = array(
                        'project'=>'商品售出',
                        'product_id'=>$product_id,
                        'num'=>$num,
                        'price'=>$num['price'],
                        'allprice'=>$num*$num['price'],
                        'time'=>date('Y-m-d H:i:s',time()),
                        'entry_mode'=>1,
                        'attr'=>1,
                    );
                    $finance_mdl->add($financeData);
                    //在这里改变商品归属权 当当前用户绑定在商品上
                    $saveown['user_id'] = $_SESSION['id'];
                    $saveown['product_id'] =$val['product_id'];
                    if(!$own_mdl->add($saveown)){
                        $own_mdl->rollback();
                        $allAdded = false;
                    };

                    //回滚
                    if($allAdded){
                        $own_mdl->commit();
                        // 如果allAdded为真则两条数据都成功；那么 commit事物提交
                        return true;
                    }else{
                        return false;
                    }
                }
            }
        }
    }

    public function updatestore($product_id,$num){
        $product_mdl = M('products');
        $inventory_record_mdl = M('inventory_records');
        //更改库存 应当判断当前商品为莲位还是shop商品，应当为-1
        $products = $product_mdl->where(array('id'=>$product_id))->find();
        if($products['danshuang'] == 'shop'){
            $info['product_store'] = $products['product_store']-$num;
            //新增库存记录录入
            $recordData = array(
                'product_id'=>$product_id,
                'status'=>'-'.$num,
                'time'=>date('Y-m-d H:i:s',time()),
                'remark'=>'商品售出',
            );

            $inventory_record_mdl->add($recordData);
            //
        }else{
            $info['product_store'] = 0;
        }
        return $info;
    }


//接受支付方式 判断支付方式
    public function pay_(){
        if($_POST){
            switch($_POST['myradio']){
                case 1:
                   echo $this->doalipay();
                    break;
                case 2:
                   echo $this->weixin();
                    break;
                case 3:
                   echo $this->yinpay();
                    break;
                case 4:
                    echo $this->xianjin();
                    break;
            }
        }
    }

    //微信支付
    public function weixin(){
        $user_mdl = M('users');
        $order_mdl = M('orders');
        $product_mdl = M('products');
        $order_detail_mdl = M('order_details');
        $users = $user_mdl->where(array('name'=>$_SESSION['name']))->find();
        $order_che = $order_mdl->where(array('order_id'=>$_SESSION['order_id']))->find();
        $order_details = $order_detail_mdl->where(array('orderid'=>$order_che['id']))->select();
        if($users['money']>$_SESSION['total']){
            if(!empty($order_details)){
                $store = array(
                    'product_store'=>0,
                );
                foreach($order_details as $key=>$val){
                   $product_mdl->where(array('id'=>$val['product_id']))->save($store);
                }
            }
            $money =  $users['money']-$_SESSION['total'];
            $info = array(
                'status'=>1,
            );
            $money_info = array(
                'money'=>$money,
            );
            $orders = $order_mdl->where(array('order_id'=>$_SESSION['order_id']))->save($info);
            $user_mdl->where(array('name'=>$_SESSION['name']))->save($money_info);
            if($orders == 1 &&$user_mdl == 1){
                $this->success('支付成功',U('gongde'),1);
            }else{
                $yemoney = $users['money']+$_SESSION['total'];
                $info = array(
                    'money'=>$yemoney,
                );
                //返回钱
                $user_mdl->where(array('name'=>$_SESSION['name']))->save($info);
                $this->success('支付异常,去个人中心查看吧',U('User/info'),1);
            }
        }else{
            $this->error('支付成功',U('Mobile/Index/pay_success'));
        }
    }
    //支付宝
    public function alipay(){
        $user_mdl = M('users');
        $order_mdl = M('orders');
        $product_mdl = M('products');
        $order_detail_mdl = M('order_details');
        $users = $user_mdl->where(array('name'=>$_SESSION['name']))->find();
        $order_che = $order_mdl->where(array('order_id'=>$_SESSION['order_id']))->find();
        $order_details = $order_detail_mdl->where(array('orderid'=>$order_che['id']))->select();
        if($users['money']>$_SESSION['total']){
            if(!empty($order_details)){
                $store = array(
                    'product_store'=>0,
                );
                foreach($order_details as $key=>$val){
                    $product_mdl->where(array('id'=>$val['product_id']))->save($store);
                }
            }
            $money =  $users['money']-$_SESSION['total'];
            $info = array(
                'status'=>1,
            );
            $money_info = array(
                'money'=>$money,
            );
            $orders = $order_mdl->where(array('order_id'=>$_SESSION['order_id']))->save($info);
            $user_mdl->where(array('name'=>$_SESSION['name']))->save($money_info);
            if($orders == 1 &&$user_mdl == 1){
                $this->success('支付成功',U('gongde'),1);
            }else{
                $yemoney = $users['money']+$_SESSION['total'];
                $info = array(
                    'money'=>$yemoney,
                );
                //返回钱
                $user_mdl->where(array('name'=>$_SESSION['name']))->save($info);
                $this->success('支付异常,去个人中心查看吧',U('User/info'),1);
            }
        }else{
            $this->error('您的余额不足了，请尽快充值吧!');
        }
    }
    //银联
    public function yinpay(){
        $user_mdl = M('users');
        $order_mdl = M('orders');
        $product_mdl = M('products');
        $order_detail_mdl = M('order_details');
        $users = $user_mdl->where(array('name'=>$_SESSION['name']))->find();
        $order_che = $order_mdl->where(array('order_id'=>$_SESSION['order_id']))->find();
        $order_details = $order_detail_mdl->where(array('orderid'=>$order_che['id']))->select();
        if($users['money']>$_SESSION['total']){
            if(!empty($order_details)){
                $store = array(
                    'product_store'=>0,
                );
                foreach($order_details as $key=>$val){
                    $product_mdl->where(array('id'=>$val['product_id']))->save($store);
                }
            }
            $money =  $users['money']-$_SESSION['total'];
            $info = array(
                'status'=>1,
            );
            $money_info = array(
                'money'=>$money,
            );
            $orders = $order_mdl->where(array('order_id'=>$_SESSION['order_id']))->save($info);
            $user_mdl->where(array('name'=>$_SESSION['name']))->save($money_info);
            if($orders == 1 &&$user_mdl == 1){
                $this->success('支付成功',U('gongde'),1);
            }else{
                $yemoney = $users['money']+$_SESSION['total'];
                $info = array(
                    'money'=>$yemoney,
                );
                //返回钱
                $user_mdl->where(array('name'=>$_SESSION['name']))->save($info);
                $this->success('支付异常,去个人中心查看吧',U('User/info'),1);
            }
        }else{
            $this->error('您的余额不足了，请尽快充值吧!');
        }
    }

    //现金支付
    public function xianjin(){
        $this->success('支付成功',U('gongde'),1);
    }

    public function gongde($order_id=null){
        $order_mdl = M('orders');
        $user_info_mdl = M('user_infos');
        $order_detail_mdl = M('order_details');
        $product_mdl = M('products');
        $good_mdl = M('goods');
        $orders = $order_mdl->where(array('order_id'=>$order_id))->find();

        $order_details = $order_detail_mdl->where(array('orderid'=>$orders['id']))->select();
        if(!empty($order_details)){
            foreach($order_details as $key=>$val){
                $products = $product_mdl->where(array('id'=>$val['product_id']))->find();
                $goods = $good_mdl->where(array('goods_id'=>$products['goods_id']))->field('cat_id')->find();
                if($goods['cat_id'] != 3){
                    $position = '佛像位';
                    $info[] = $position;
                }else{
                    $position = '皇族宗祠';
                    $info[] = $position;
                }
            }
        }

        $user_infos = $user_info_mdl->where(array('id'=>$orders['user_info_id']))->find();
        $this->assign('relname',$user_infos['relname']);
        $this->assign('position',$info);
        $this->assign('total',$orders['order_total_price']);
        $this->show();
    }

    public function info(){
        $info = $_POST;
        $ordername = '常州九龙禅寺认捐佛像位';
        $orderdescr = '功德无量';
        session('ordername',$ordername);
        session('orderdescr',$orderdescr);
        session('order_id',$_POST['order_id']);
        session('total',$_POST['order_total_price']);
        $this->assign('info',$info);
        $this->display('Order/info');
    }
}