<?php
namespace WapHome\Controller;
use Think\Controller;
class ProductController extends Controller {
    public function index($id=null){
        $product_mdl = M('weixin_products');
        $collect_mdl = M('weixin_collects');
        $products = $product_mdl->where(array('id'=>$id))->find();
        $user_id = $_SESSION['id'];
       if($products){
           //判断该商品是否被收藏
           $collects = $collect_mdl->where(array('product_id'=>$id,'user_id'=>$user_id))->find();
           if($collects){
               $status = 1;
               $this->assign('collects',$collects);
               $this->assign('collect_status',$status);
           }
           $this->assign('products',$products);
           $this->show();
       }else{
           $this->error('没有找到该商品',U('Index/index'),1);
       }
    }

    public  function ajax_shoucang(){
        $collect_mdl = M('weixin_collects');
        $user_id = $_SESSION['id'];
        $info = array(
            'product_id'=>$_POST['id'],
            'createtime'=>date('Y-m-d H:i:s',time()),
            'user_id'=>$user_id,
        );
        $collects = $collect_mdl->add($info);
        if($collects){
            echo '1';
        }else{
            echo '2';
        }
    }

    public  function ajax_shoucang_del(){
        $collect_mdl = M('weixin_collects');
        $user_id = $_SESSION['id'];
        $collects = $collect_mdl->where(array('product_id'=>$_POST['id'],'user_id'=>$user_id))->delete();
        if($collects){
            echo '1';
        }else{
            echo '2';
        }
    }


    public function ajax_del_shoucang(){
        $collect_mdl = M('weixin_collects');
        $user_id = $_SESSION['id'];
       $collects = $collect_mdl->where(array('id'=>$_POST['id']))->delete();
        if($collects == 1){
            echo '1';
        }else{
            echo '2';
        }
    }




}