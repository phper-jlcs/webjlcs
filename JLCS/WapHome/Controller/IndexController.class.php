<?php
namespace WapHome\Controller;
use Think\Controller;
class IndexController extends Controller {
    public function index(){
        $product_mdl = M('weixin_products');
        //每日必看 龙脑系列 特色产品
        $products_meiri = $product_mdl->where(array('status'=>'每日'))->select();
        $products_tese = $product_mdl->where(array('status'=>'特色'))->select();
        $products_longnao = $product_mdl->where(array('status'=>'龙脑'))->select();
        $this->assign('products_meiri',$products_meiri);
        $this->assign('products_tese',$products_tese);
        $this->assign('products_longnao',$products_longnao);
        $this->display('Index/index');
    }

    public function sousuo(){
        header('Content-Type:text/php;charset=utf-8');
        $product_mdl = M('weixin_products');
        $filter['name'] = array('like','%'.$_POST['souname'].'%');
        $products = $product_mdl->where($filter)->select();
        if(empty($products)){
            $this->error('未找到您搜索的商品,请重试',U('index'),2);
        }else{
            $this->assign('products',$products);
            $this->display('Product/sousuo');
        }
    }

    public function pcenter(){
        $userinfo =array(
          'nickname'=>$_SESSION['nickname'],
          'headimgurl'=>$_SESSION['headimgurl'],
        );
        $this->assign('userinfo',$userinfo);
        $this->show();
    }



}