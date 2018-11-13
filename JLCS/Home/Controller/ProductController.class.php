<?php
namespace Home\Controller;
use Think\Controller;
class ProductController extends Controller {

    public  function index($cat_id=null,$img=null){
        //接收传递过来的墙面id
        //实例化商品表
        if($cat_id ==1 && $img == 'a'){
            $contents='佛恩殿->A区';
        }elseif($cat_id == 1 && $img == 'b' ){
            $contents='佛恩殿->B区';
        }elseif($cat_id == 2 && $img == 'c' ){
            $contents='佛孝殿->A区';
        }elseif($cat_id == 2 && $img == 'd' ){
            $contents='佛孝殿->B区';
        }elseif($cat_id == 4 && $img == 'e' ){
            $contents='佛裕殿->A区';
        }elseif($cat_id == 4 && $img == 'f' ){
            $contents='佛裕殿->B区';
        }elseif($cat_id == 4 && $img == 'g' ){
            $contents='佛裕殿->C区';
        }elseif($cat_id == 10 && $img == 'h' ){
            $contents='佛仁殿->A区';
        }elseif($cat_id == 10 && $img == 'i' ){
            $contents='佛仁殿->B区';
        }elseif($cat_id == 10 && $img == 'j' ){
            $contents='佛仁殿->C区';
        }elseif($cat_id == 5 && $img == 'k' ){
            $contents='佛光殿->A区';
        }elseif($cat_id == 5 && $img == 'l' ){
            $contents='佛光殿->B区';
        }elseif($cat_id == 5 && $img == 'm' ){
            $contents='佛光殿->C区';
        }elseif($cat_id == 6 && $img == 'n' ){
            $contents='佛仪殿->A区';
        }elseif($cat_id == 6 && $img == 'o' ){
            $contents='佛仪殿->B区';
        }elseif($cat_id == 7 && $img == 'p' ){
            $contents='佛泽殿->A区';
        }elseif($cat_id == 7 && $img == 'q' ){
            $contents='佛泽殿->B区';
        }elseif($cat_id == 7 && $img == 'r' ){
            $contents='佛泽殿->C区';
        }elseif($cat_id == 8 && $img == 's' ){
            $contents='佛照殿->A区';
        }elseif($cat_id == 8 && $img == 't' ){
            $contents='佛照殿->B区';
        }elseif($cat_id == 8 && $img == 'u' ){
            $contents='佛照殿->C区';
        }elseif($cat_id == 8 && $img == 'v' ){
            $contents='佛照殿->D区';
        }elseif($cat_id == 9 && $img == 'w' ){
            $contents='佛禄殿->A区';
        }elseif($cat_id == 9 && $img == 'x' ){
            $contents='佛禄殿->B区';
        }elseif($cat_id == 9 && $img == 'y' ){
            $contents='佛禄殿->C区';
        }elseif($cat_id == 9 && $img == 'z' ){
            $contents='佛禄殿->D区';
        }elseif($cat_id == 11 && $img == 'aa' ){
            $contents='福吉界';
            $biaoshi = 1 ;
        }elseif($cat_id == 12 && $img == 'bb' ){
            $contents='福顺界';
            $biaoshi = 1 ;
        }elseif($cat_id == 13 && $img == 'cc' ){
            $contents='福明界';
            $biaoshi = 1 ;
        }elseif($cat_id == 14 && $img == 'dd' ){
            $contents='福广界';
            $biaoshi = 1 ;
        }

        //分配数据
        $this->assign('biaoshi',$biaoshi);
        $this->assign('contents',$contents);
        $this->assign('img',$img);
        $this->assign('cat_id',$cat_id);
        $this->assign('data',$data);
        $this->assign('owns',$owns);
        $this->display();
    }

    public function  ajax_index($id){
        //接收传递过来的墙面id
        //实例化商品表

        $model =M('goods');
        $filter['owns'] = $id;
        $filter['cat_id'] = 1;

        $data = $model->where($filter)->select();

        echo $data;
        //分配数据
        $this->assign('data',$data);
        $this->assign('owns',$owns);
    }
    public  function details($id){
        //实例化商品表
        $product_mdl = M('products');
        $goods_mdl = M('goods');
        $filter['id'] = $id;
        $products = $product_mdl->where($filter)->find();
        //该莲位所在的楼层数字
        $floor = substr($products['product_name'], -1,1);
        //后期更新数据 去掉的缀与数据 需要过滤
        if(($products['goods_id'] == '') || ($products['danshuang'] == '佛龛')){  //是佛龛也不能打开这个页面
            echo "<script>alert('当前莲位不存在!请重新认捐');location.href='http://www.zgdigong.com';</script>";
        }
        $filter['goods_id'] = $products['goods_id'];
        $goods = $goods_mdl->where($filter)->find();
        if($goods['cat_id'] == 3){
            $image = 1;
        }elseif($goods['cat_id'] == 11 ||$goods['cat_id'] == 12 || $goods['cat_id'] == 13 || $goods['cat_id'] == 14){
            $biaoshi = 1 ;
        }
        $this->assign('image',$image);
        $this->assign('biaoshi',$biaoshi);
        $this->assign('owns',$goods['owns']);
        $this->assign('own_name',$goods['own_name']);
        $this->assign('products',$products);
        $this->assign('id',$id);
        $this->assign('floor',$floor);
        $this->display();
    }

    public function ajax_cart($id){
        $data = $_SESSION['name'];
        if(!$data){
            session('register','1');
            session('product_id',$id);
            echo 1;exit;
        }

        //实例化cart表
        $cart = M('carts');
        $goods = M('goods');
        $user_mdl= M('users');
        $filter['name'] = $_SESSION['name'];
        $users = $user_mdl->where($filter)->find();
        $num = isset($_POST['nums'])?$_POST['nums']:1;
        $products = M('products');
            $filter['id'] = $id;
            $goods_info = $products->where($filter)->find();
            $cart_info['user_id'] = $users['id'];
            $cart_info['products_id'] = $id;
            $cart_info['name'] = $goods_info['product_name'];
            $cart_info['price'] = $goods_info['now_price'];
            $time=date("Y-m-d H:i",time());
            $cart_info['cretime'] = $time;
            $cart_info['nums'] = $num;
            //判断加入购物车的时候，同一个人同一个商品只存在一条数据
            $old_data = $cart->where("user_id=".$users['id']." and products_id=".$goods_info['id'])->find();
////           //该商品已经存在 由于该商品只有一个库存只能加一次
            if($old_data){
                echo 2;exit;
            }
            $data = $cart->data($cart_info)->add();
            if($data){
                echo 3;
            }else{
                echo 4;
            }
    }

    public function session(){
        echo 'aa';
    }

    public  function ajax_check($id){
        //例化products表
        $products_mdl = M('products');
        $filter['_string'] = "FIND_IN_SET($id,goods_id)";
        $products = $products_mdl->where($filter)->order('id asc')->select();
        $this->assign('products',$products);
        $this->display('ajax_check');
}


    public function hjzc($owns=null,$cat_id=null){
        //接收传递过来的墙面id
        //实例化商品表
        $model =M('goods');
        $product_mdl = M('products');
        $filter['owns'] = $owns;
        $filter['cat_id'] = $cat_id;
        $data = $model->order('goods_id ASC')->where($filter)->select();
        foreach($data as $key=>$val){
            $id = $val['goods_id'];
            $filter1['goods_id'] = $id;
            $info = $product_mdl->where($filter1)->find();
            if($info){
                $data1[] = $info;
            }
        }


        $this->assign('data',$data1);
        $this->assign('owns',$owns);
        $this->display();
    }


    public function ajax_return($id){
        //实例化products表
        $product_mdl = M('products');
        $filter['goods_id'] = $id;
        $product = $product_mdl->where($filter)->find();
//        echo '<pre>';print_r($product);exit;
        if ($product['id']) {
            $returnData = json_encode($product['id']);
            $this->ajaxReturn($returnData);
        } else {
           echo 'a';
        }
    }


    public function ajax_show($own,$cat_id){
        $model =M('goods');
        $product_mdl = M('products');
        $filter['owns'] = $own;
        $filter['cat_id'] = $cat_id;
        //更改数据时，佛孝殿编号错误，按照goods_name排序。。。
        if($cat_id == 2){
            $data = $model->order('goods_name ASC')->where($filter)->select();
        }else{
            $data = $model->order('goods_id ASC')->where($filter)->select();
        }
        
        foreach($data as $key=>$val){
           $products = $product_mdl->where(array('goods_id'=>$val['goods_id']))->select();
            $data[$key]['Data'] = $products;
        }
        $this->assign('cat_id',$cat_id);
        $this->assign('data',$data);
        $this->display('ajax_show');
    }

    public function product($id=null){
        $pro_mdl = M('products');
        $pro = $pro_mdl->where(array('id'=>$id))->select();
        if($pro[0]['danshuang'] == 'shop'){
            $image = 2;
        }
        $this->assign('image',$image);
        $this->assign('pro',$pro);
        $this->assign('id',$id);
        $this->show();
    }

    public function transfer(){

        $this->show();
    }
}