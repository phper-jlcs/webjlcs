<?php
namespace WapHome\Controller;
use Think\Controller;
class CatController extends Controller {

    public function index(){
        $weixin_cat_mdl = M('weixin_cats');
        //一级分类
        $weixin_cats = $weixin_cat_mdl->where(array('pid'=>','))->select();
        foreach($weixin_cats as $key=>$val){
            $str = ','.$val['id'];
            $weixin_cats_two = $weixin_cat_mdl->where(array('pid'=>$str))->select();
            $weixin_cats[$key]['info'] = $weixin_cats_two;
        }
        $this->assign('weixin_cats',$weixin_cats);
        $this->show();
    }

    public function catinfo($cat_name=null){
        $product_mdl = M('weixin_products');
        $cat_mdl = M('weixin_cats');
        $cats = $cat_mdl->where(array('name'=>$cat_name))->find();
        $products = $product_mdl->where(array('cat_id'=>$cats['id']))->select();
        if(!empty($products)){
            $this->assign('cat_name',$cat_name);
            $this->assign('products',$products);
            $this->show();
        }else{
            $this->error('很抱歉，该类别下暂无商品');
        }

    }





}