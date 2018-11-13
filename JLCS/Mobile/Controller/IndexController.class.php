<?php
namespace Mobile\Controller;
use Think\Controller;
class IndexController extends Controller {
//    protected function _initialize(){
//        //判断当前登录设备为手机还是pc
//       if($this->isMobile()){
//           $this->redirect('Mobile/Index/index');
//       }else{
//           C('DEFAULT_MODULE','Home');
//       }
//    }

    public function index(){

        $this->display('Index/index');
    }

    function isMobile(){
        // 如果有HTTP_X_WAP_PROFILE则一定是移动设备
        if (isset ($_SERVER['HTTP_X_WAP_PROFILE']))
            return true;

        //此条摘自TPM智能切换模板引擎，适合TPM开发
        if(isset ($_SERVER['HTTP_CLIENT']) &&'PhoneClient'==$_SERVER['HTTP_CLIENT'])
            return true;
        //如果via信息含有wap则一定是移动设备,部分服务商会屏蔽该信息
        if (isset ($_SERVER['HTTP_VIA']))
            //找不到为flase,否则为true
            return stristr($_SERVER['HTTP_VIA'], 'wap') ? true : false;
        //判断手机发送的客户端标志,兼容性有待提高
        if (isset ($_SERVER['HTTP_USER_AGENT'])) {
            $clientkeywords = array(
                'nokia','sony','ericsson','mot','samsung','htc','sgh','lg','sharp','sie-','philips','panasonic','alcatel','lenovo','iphone','ipod','blackberry','meizu','android','netfront','symbian','ucweb','windowsce','palm','operamini','operamobi','openwave','nexusone','cldc','midp','wap','mobile'
            );
            //从HTTP_USER_AGENT中查找手机浏览器的关键字
            if (preg_match("/(" . implode('|', $clientkeywords) . ")/i", strtolower($_SERVER['HTTP_USER_AGENT']))) {
                return true;
            }
        }
        //协议法，因为有可能不准确，放到最后判断
        if (isset ($_SERVER['HTTP_ACCEPT'])) {
            // 如果只支持wml并且不支持html那一定是移动设备
            // 如果支持wml和html但是wml在html之前则是移动设备
            if ((strpos($_SERVER['HTTP_ACCEPT'], 'vnd.wap.wml') !== false) && (strpos($_SERVER['HTTP_ACCEPT'], 'text/html') === false || (strpos($_SERVER['HTTP_ACCEPT'], 'vnd.wap.wml') < strpos($_SERVER['HTTP_ACCEPT'], 'text/html')))) {
                return true;
            }
        }
        return false;
    }


    public function  product(){
        $this->show();

    }

    public function xuanwei($temple=null){
        $temple_mdl = M('temples');
        $region_mdl = M('regions');
        //判断当前寺庙在数据库中是否存在
        $temples = $temple_mdl->select();
        foreach($temples as $key=>$val){
                $temple_id = $val['id'];
                $temple_ids[] = $temple_id;
        }
        //存在
        if (in_array($temple, $temple_ids)){
            $temple_select = $temple_mdl->where(array('id'=>$temple))->find();
            $region_select = $region_mdl->where(array('temple'=>$temple))->select();
            $this->assign('region_select',$region_select);
            $this->assign('temple_select',$temple_select);
            $this->show();
        }else{
            echo "<script>alert('该寺庙开发中！');location.href='http://www.zgdigong.com';</script>";
        }

    }


    public function region($id=null){
        $region_mdl = M('regions');
        $temple_mdl = M('temples');
        $cat_mdl = M('cats');
        $cat_part_mdl = M('cat_parts');
        $good_mdl = M('goods');
        //判断当前殿堂在数据库中是否存在
        $regions = $region_mdl->select();
        foreach($regions as $key=>$val){
            $region_id = $val['id'];
            $region_ids[] = $region_id;
        }
        //存在
        if (in_array($id, $region_ids)){
            if($id == 2){
                $region_select = $region_mdl->where(array('id'=>$id))->find();
                $temple_select = $temple_mdl->where(array('id'=>$region_select['temple']))->find();
                $cat_select = $cat_mdl->where(array('region'=>$id))->select();
                $cat_part_select = $cat_part_mdl->where(array('cat_id'=>$cat_select[0]['id']))->select();
                $str = '皇家宗祠->'.$cat_part_select[0]['cat_part_name'];
                $good_select = $good_mdl->where(array('own_name'=>$str))->select();
                $region_select['good_select'] = $good_select;
                $region_select['cat_part'] = $cat_part_select;
                $region_select['palace'] = $cat_select;
                $region_select['temple_name'] = $temple_select['temple'];

                $this->assign('region_select',$region_select);
                $this->display('Index/hjzc');
            }else{
                $region_select = $region_mdl->where(array('id'=>$id))->find();
                $temple_select = $temple_mdl->where(array('id'=>$region_select['temple']))->find();
                $cat_select = $cat_mdl->where(array('region'=>$id))->select();
                $cat_part_select = $cat_part_mdl->where(array('cat_id'=>$cat_select[0]['id']))->select();
                $good_select = $good_mdl->where(array('own_name'=>$cat_part_select[0]['cat_part_name']))->select();
                $region_select['good_select'] = $good_select;
                $region_select['cat_part'] = $cat_part_select;
                $region_select['palace'] = $cat_select;
                $region_select['temple_name'] = $temple_select['temple'];
                $this->assign('region_select',$region_select);
                $this->assign('region',$id);
                $this->show();
            }
        }else{
            echo "<script>alert('该殿堂开发中！');location.href='http://www.zgdigong.com';</script>";
        }
    }


    public function content($id=null){
        //浏览记录 统计
        session('history',array('product_id'=>$_POST['lianwei']));
        //
        if($_GET['id']){
            $productinfo=$this->selectposition($_GET['id']);
        }else{
            $productinfo=$this->selectposition($_POST['lianwei']);
        }
        $this->assign('productinfo',$productinfo);
        $this->show();
    }

    public function content_tre($id=null){
        $productinfo=$this->selectposition($id);
        $this->assign('productinfo',$productinfo);
        $this->display('Index/content');
    }
    public function order($id=null){
        if($_SESSION['name']){
            $productinfo=$this->selectposition($id);
            $this->assign('productinfo',$productinfo);
            $this->show();
        }else{
            $this->error('您还没有登录,请前去登录',U('Personal/login'),1);
        }

    }

    public function checkorder(){
        $product_mdl = M('products');
        $order_mdl = M('orders');
        $order_detail_mdl = M('order_details');
        $user_info_mdl = M('user_infos');
        $products = $product_mdl->where(array('id'=>$_POST['product_id']))->find();
        //创建订单
        //1.创建订单 个人信息参数组
        if($_POST){
            //优先判断商品是否为已售
            if($products['product_store'] == 1){
                //拼接 地址
                $address = $_POST['s_province'].$_POST['s_city'].$_POST['s_county'].$_POST['address'];
                $user_info = array(
                    'user_id'=>$_SESSION['id'],
                    'agent_aid'=>$_POST['agent'],
                    'relname'=>$_POST['relname'],
                    'address'=>$address,
                    'phone'=>$_POST['phone'],
                    'cid'=>$_POST['cid'],
                );

                //插入个人信息
                $user_add = $user_info_mdl->add($user_info);
                if($user_add){
                    //2.创建订单表参数组
                    if($_POST['product_id']){
                        $order_id = rand(1,1000)+time();   //订单号
                        $num = 1;
                        $order_total =$products['now_price'];
                        $ordername = '常州九龙禅寺认捐佛像位';
                        $orderdescr = '功德无量';
                        $user_id = $_SESSION['id'];
                        $status = '0';   //未付款
                        $agent_aid = $_POST['agent'];
                        $user_info_id = $user_add;
                        $agreement_id = 111111;

                        $order_info = array(
                            'order_id'=>$order_id,
                            'order_num'=>$num,
                            'order_total_price'=>$order_total,
                            'user_id'=>$user_id,
                            'status'=>$status,
                            'createtime'=>date('Y-m-d H:i:s',time()),
                            'agent_aid'=>$agent_aid,
                            'user_info_id'=>$user_info_id,
                            'agreement_id'=>$agreement_id,
                            'phone' =>$_POST['phone'],
                        );
                        //生成订单
                        $orders = $order_mdl->add($order_info);

                        if($orders){
                            //
                            //查询 生成供奉权证接口
                            $warrant_number = warrant_select($_POST['product_id']);
                            //
                            //组建订单详情表的参数组
                            $order_detail_info = array(
                              'orderid'=>$orders,
                              'product_id'=>$_POST['product_id'],
                              'num'=>1,
                              'price'=>$products['now_price'],
                              'user_id'=>$_SESSION['id'],
                              'description'=>$warrant_number,
                            );

                            $id = $order_detail_mdl->add($order_detail_info);
                            if(!$id){
                                $this->error('订单生成失败',U('Index/order',array('id'=>$_POST['product_id'])),3);
                            }

                            session('order_id',$order_id);
                            session('total',$order_total);
                            session('ordername',$ordername);
                            session('orderdescr',$orderdescr);
                            $this->success('订单生成成功',U('Pay/pay',array('product_id'=>$_POST['product_id'],'orderid'=>$order_id,'price'=>$order_total)),2);

                        }

                    }
                }else{
                    $this->error('个人信息添加失败',U('Index/order',array('id'=>$_POST['product_id'])),1);
                }
            }else{
                $this->error('当前莲位已售，请勿购买',U('Index/index'),1);
            }




        }

    }

    public function choosepay(){
        $this->show();
    }
    public function selectposition($id){
        $product_mdl = M('products');
        $good_mdl = M('goods');
        $cat_part_mdl = M('cat_parts');
        $cat_mdl = M('cats');
        $region_mdl = M('regions');
        $temple_mdl = M('temples');
        $products = $product_mdl->where(array('id'=>$id))->find();
        $goods = $good_mdl->where(array('goods_id'=>$products['goods_id']))->find();
        //判断是否是皇家宗祠
        if(strstr($goods['own_name'],'皇家宗祠')){
            $str = str_replace('皇家宗祠->','',$goods['own_name']);
            $cat_parts = $cat_part_mdl->where(array('cat_part_name'=>$str))->find();
        }else{
            $cat_parts = $cat_part_mdl->where(array('cat_part_name'=>$goods['own_name']))->find();
        }
        $cats = $cat_mdl->where(array('id'=>$cat_parts['cat_id']))->find();
        $regions = $region_mdl->where(array('id'=>$cats['region']))->find();
        $temples = $temple_mdl->where(array('id'=>$regions['temple']))->find();
        $productinfo = array(
            'productid'=>$id,
            'temple'=>$temples['temple'],
            'templeid'=>$temples['id'],
            'region'=>$regions['region'],
            'palace'=>$cat_parts['cat_part_name'],
            'productname'=>$products['product_name'],
            'now_price'=>$products['now_price'],
            'old_price'=>$products['product_price'],
            'size'=>$products['size'],
        );
        return $productinfo;
    }

    public function pay_success(){
        $this->display('Pay/pay_success');
    }
    public function smgh(){
        $this->show();
    }

    public function smgf(){
        $this->show();
    }
    public function fjzh(){
        $this->show();
    }

}