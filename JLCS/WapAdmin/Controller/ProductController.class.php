<?php
namespace WapAdmin\Controller;
use Think\Controller;
class ProductController extends Controller {
    public function index($id=null){
        //实例化商品表
        $product_mdl = M('weixin_products');
        $cat_mdl = M('weixin_cats');
        $_GET['p'] = isset($_GET['p']) ? $_GET['p'] : '1';
        if(I('post.id')){
            $products = $product_mdl->where(array('id'=>intval(I('post.id'))))->page($_GET['p'].',6')->select();
        }else{
             $products = $product_mdl->page($_GET['p'].',6')->select();
        }
        foreach($products as $key=>$val){
            $cats = $cat_mdl->where(array('id'=>$val['cat_id']))->field('name')->find();
            $products[$key]['cat_name'] = $cats['name'];
        }
        $count = $product_mdl->count();
        $Page = new \Think\Page($count,6);
        $Page->lastSuffix=false;
        //$Page->setConfig('header','<li class="rows">共<b>%TOTAL_ROW%</b>条记录&nbsp;&nbsp;每页<b>4</b>条&nbsp;&nbsp;第<b>%NOW_PAGE%</b>页/共<b>%TOTAL_PAGE%</b>页</li>');
        $Page->setConfig('prev','上一页');
        $Page->setConfig('next','下一页');
        $Page->setConfig('last','末页');
        $Page->setConfig('first','首页');
        $Page->setConfig('theme','%FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END% %HEADER%');
        $show = $Page->show();
        $this->assign('page',$show);
        $this->assign('count',$count);
        $this->assign('products',$products);
        $this->assign('keyword',I('post.id'));
        $this->display();
    }


    public function del($id){
        //实例化会员表
        $user_mdl = M('weixin_products');
        $order_mdl = M('weixin_orders');
        $order_detail_mdl = M('weixin_order_details');
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
                    $this->error('该商品不能删除，还有订单未完成',U('index'),2);
                }
            }
        }else{
            $user = $user_mdl->where($filter)->delete();
        }
        if($user == 1){
            $this->success('删除成功', U('index'), 2);
        }else{
            $this->error('删除失败', U('index'), 2);
        }
    }


    public function edit($id=null){
        //实例化商品表
        $product_mdl = M('weixin_products');
        $cat_mdl = M('weixin_cats');
        $filter['id'] = $id;
        $products = $product_mdl->where($filter)->find();
        $cats = $cat_mdl->where(array('id'=>$products['cat_id']))->find();
        $products['own_name'] = $cats['name'];
        $cats = $cat_mdl->where(array('pid'=>','))->select();
        foreach($cats as $key=>$val){
            $str = ','.$val['id'];
            $cat_s = $cat_mdl->where(array('pid'=>$str))->select();
            $cats[$key]['catinfo'] = $cat_s;
        }
        $this->assign('cats',$cats);
        $this->assign('products',$products);
        $this->display();
    }

    public function doedit($id=null){
        //实例化会员表
        $user_mdl = M('weixin_products');
        //检测有没有图片被修改
        if($_FILES['filedata']['name'] == ''){
            $path = $_POST['filedata'];
            $imagename = $_POST['image'];
        }else{
            $upload = new \Think\Upload();
            $upload->maxSize   =     3145728 ;
            $upload->exts      =     array('jpg', 'gif', 'png', 'jpeg');
            $upload->rootPath  =     THINK_PATH;
            $upload->savePath  =    '../Public/Uploads/';
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
            'name'=>$_POST['name'],
            'description'=>$_POST['descr'],
            'store'=>$_POST['store'],
            'image'=>$imagename,
            'old_price'=>999,
            'now_price'=>$_POST['price'],
            'cat_id'=>$_POST['owns'],
            'path'=>$path,
        );
        $data = $user_mdl->where(array('id'=>$id))->save($info);
        if($data == 1){
            $this->success('修改成功', U('index'), 2);
        }else{
            $this->error('修改失败,请重新修改', U('edit',array('id'=>$id)), 2);
        }
    }

    public function add(){
        $cat_mdl = M('weixin_cats');
        $cats = $cat_mdl->where(array('pid'=>','))->select();
        foreach($cats as $key=>$val){
            $str = ','.$val['id'];
            $cat_s = $cat_mdl->where(array('pid'=>$str))->select();
            $cats[$key]['catinfo'] = $cat_s;
        }
        $this->assign('cats',$cats);
        $this->show();
    }

    public function doadd(){
        //实例化商品表
        $product_mdl = M('weixin_products');
        $upload = new \Think\Upload();
        $upload->maxSize   =     3145728 ;
        $upload->exts      =     array('jpg', 'gif', 'png', 'jpeg');
        $upload->rootPath  =     THINK_PATH;
        $upload->savePath  =    '../Public/Uploads/';
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
            'name'=>$_POST['name'],
            'description'=>$_POST['descr'],
            'store'=>$_POST['store'],
            'image'=>$imagename,
            'old_price'=>999,
            'now_price'=>$_POST['price'],
            'cat_id'=>$_POST['owns'],
            'path'=>$path,
        );
        $products = $product_mdl->add($info);
        if($products){
          $this->success('添加成功',U('index'),2);
        }else{
            $this->error('添加失败',U('add'),2);
        }
    }

    public function select(){
        $keywords = $_POST['keyword'];
        //实例化商品表
        $product_mdl = M('products');
//        $filter['id']=array('like','jb51%'); 模糊查询的条件
        $filter['id'] = $keywords;
        $products = $product_mdl->where($filter)->select();
        $this->assign('products',$products);
        $this->assign('keyword',$keywords);
        $this->display('Product/index');
    }


}