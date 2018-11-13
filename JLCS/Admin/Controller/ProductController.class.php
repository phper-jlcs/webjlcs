<?php
namespace Admin\Controller;
use Think\Controller;
class ProductController extends Controller {
    public function index($id=null){
        //实例化商品表
        $product_mdl = M('products');
        $good_mdl = M('goods');
        $filter['goods_id'] = 26;
        $_GET['p'] = isset($_GET['p']) ? $_GET['p'] : '1';
        $products = $product_mdl->where($filter)->page($_GET['p'].',4')->select();
        $goods = $good_mdl->where($filter)->find();
        foreach($products as $key=>$val){
            $products[$key]['position'] = $goods['own_name'];
        }
        $count = $product_mdl->where($filter)->count();
        $Page = new \Think\Page($count,4);
        $Page->lastSuffix=false;
//        $Page->setConfig('header','<li class="rows">共<b>%TOTAL_ROW%</b>条记录&nbsp;&nbsp;每页<b>4</b>条&nbsp;&nbsp;第<b>%NOW_PAGE%</b>页/共<b>%TOTAL_PAGE%</b>页</li>');
        $Page->setConfig('prev','上一页');
        $Page->setConfig('next','下一页');
        $Page->setConfig('last','末页');
        $Page->setConfig('first','首页');
        $Page->setConfig('theme','%FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END% %HEADER%');
        $show = $Page->show();
        $this->assign('page',$show);
        $this->assign('count',$count);
        $this->assign('products',$products);
        $this->display();
    }

    public function add(){
        $cat_mdl = M('cats');
        $cats = $cat_mdl->where(array('id'=>'15'))->find();
        $this->assign('cats',$cats);
        $this->show();
    }
    public function del($id){
        //实例化会员表
        $user_mdl = M('users');
        $filter['id'] = $id;
        $user = $user_mdl->where($filter)->delete();
        if($user == 1){
            $this->success('删除成功', U('index'), 2);
        }
    }


    public function edit($id=null){
        //实例化商品表
        $product_mdl = M('products');
        $filter['id'] = $id;
        $products = $product_mdl->where($filter)->find();
        $info['id'] = $products['id'];
        $info['product_name'] = $products['product_name'];
        $info['position'] = '佛孝殿A区';
        $info['now_price'] = $products['now_price'];
        $info['size'] = $products['size'];
        $info['product_store'] = $products['product_store'];
        $this->assign('info',$info);
        $this->display();
    }

    public function doedit($id){
        //实例化会员表
        $user_mdl = M('products');
        $filter['id'] = $id;
        $updateinfo['product_name'] = $_POST['product_name'];
        $updateinfo['product_store'] = $_POST['product_store'];
        $updateinfo['now_price'] = $_POST['now_price'];
        $updateinfo['size'] = $_POST['size'];
        $data = $user_mdl->where($filter)->save($updateinfo);
        if($data){
            $this->success('修改成功', U('index'), 2);
        }else{
            $this->error('修改失败,请重新修改', U('edit',array('id'=>$id)), 2);
        }
    }

    public function doadd(){
        //实例化商品表
        $product_mdl = M('products');
        $upload = new \Think\Upload();
        $upload->maxSize   =     3145728 ;
        $upload->exts      =     array('jpg', 'gif', 'png', 'jpeg');
        $upload->rootPath  =     './Public' ;
        $upload->savePath  =    '/uploads__/';
        $info   =   $upload->upload();
        if(!$info){
            $this->error($upload->getError());
        }else{
            //上传图片名
            $imagename = $info['filedata']['savename'];
            $path = $info['filedata']['savepath'].$info['filedata']['savename'];
        }
        //组装商品表数组
        $info = array(
            'product_name'=>$_POST['name'],
            'product_description'=>$_POST['descr'],
            'product_store'=>$_POST['store'],
            'product_image'=>$imagename,
            'product_price'=>999,
            'now_price'=>$_POST['price'],
            'cat_id'=>$_POST['owns'],
            'path'=>$path,
            'danshuang'=>'shop',
        );
        $products = $product_mdl->add($info);
        if($products){
            $this->success('添加成功',U('products'),2);
        }else{
            $this->error('添加失败',U('add'),2);
        }
    }


    public function products(){
        $xinpin_pro_mdl = M('products');
        $xinpin_pros = $xinpin_pro_mdl->where(array('danshuang'=>'shop'))->select();
        $this->assign('xinpin_pros',$xinpin_pros);
        $this->show();
    }

    public function delproduct($id=null){
        //实例化会员表
        $user_mdl = M('products');
        $order_mdl = M('orders');
        $order_detail_mdl = M('order_details');
        $filter['id'] = $id;
        //需要判断当前商品是否还存在订单，若存在不可删除
        $order_details = $order_detail_mdl->where(array('product_id'=>$id))->select();
        if($order_details){
            foreach($order_details as $key=>$val){
                $orders = $order_mdl->where(array('order_id'=>$val['orderid']))->find();
                //数据库状态为5 则该订单已经完成。可以删除该商品
                if($orders['order_status'] == 5){
                    $user = $user_mdl->where($filter)->delete();
                }else{
                    $this->error('该商品不能删除，还有订单未完成',U('products'),2);
                }
            }
        }else{
            $user = $user_mdl->where($filter)->delete();
        }
        if($user == 1){
            $this->success('删除成功', U('products'), 2);
        }else{
            $this->error('删除失败', U('products'), 2);
        }
    }

    public function editproduct($id=null){
        //实例化商品表
        $product_mdl = M('products');
        $cat_mdl = M('cats');
        $filter['id'] = $id;
        $products = $product_mdl->where($filter)->find();
        $cats = $cat_mdl->where(array('id'=>$products['cat_id']))->find();
        $this->assign('cats',$cats);
        $this->assign('products',$products);
        $this->display();
    }

    public function doeditproduct($id=null){
        //实例化会员表
        $user_mdl = M('products');
        //检测有没有图片被修改
        if($_FILES['filedata']['name'] == ''){
            $path = $_POST['filedata'];
            $imagename = $_POST['imagename'];
        }else{
            $upload = new \Think\Upload();
            $upload->maxSize   =     3145728 ;
            $upload->exts      =     array('jpg', 'gif', 'png', 'jpeg');
            $upload->rootPath  =     './Public';
            $upload->savePath  =    '/uploads__/';
            $info   =   $upload->upload();
            if(!$info){
                $this->error($upload->getError());

            }else{
                //上传图片名
                $imagename = $info['filedata']['savename'];
                $path = $info['filedata']['savepath'].$info['filedata']['savename'];
            }
        }

        //组装商品表数组
        $info = array(
            'product_name'=>$_POST['name'],
            'product_description'=>$_POST['descr'],
            'product_store'=>$_POST['store'],
            'product_image'=>$imagename,
            'product_price'=>999,
            'now_price'=>$_POST['price'],
            'cat_id'=>$_POST['owns'],
            'path'=>$path,
            'danshuang'=>'shop',
        );
        $data = $user_mdl->where(array('id'=>$id))->save($info);
        if($data == 1){
            $this->success('修改成功', U('products'), 2);
        }else{
            $this->error('修改失败,请重新修改', U('editproduct',array('id'=>$id)), 2);
        }
    }

    public function select(){
        $product_mdl = M('products');
        $products = $product_mdl->where(array('id'=>$_POST['keyword']))->select();
        if($products){
            $this->assign('keywords',$_POST['keyword']);
            $this->assign('products',$products);
            $this->display('Product/index');
        }else{
            $this->error('未找到您搜索的莲位',U('index'),2);
        }
    }

    public function selectproduct(){
        $product_mdl = M('products');
        $products = $product_mdl->where(array('id'=>$_POST['keyword']))->select();
        if(!empty($products)){
            $this->assign('keywords',$_POST['keyword']);
            $this->assign('xinpin_pros',$products);
            $this->display('Product/products');
        }else{
            $this->error('未找到您搜索的商品',U('products'),2);
        }
    }

}