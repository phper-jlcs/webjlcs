<?php
namespace WapAdmin\Controller;
use Think\Controller;
class StoreController extends Controller {
    public function index(){
            $cat_part_mdl = M('cat_parts');
            $good_mdl = M('goods');
            $product_mdl = M('products');
            $cat_parts = $cat_part_mdl->select();
            $store = 0;
            foreach($cat_parts as $key=>$val){
                $filter['own_name'] = $val['cat_part_name'];
                $goods = $good_mdl->field('goods_id')->where($filter)->select();
                if(!empty($goods)){
                    foreach($goods as $key1=>$val1){
                        $info[]=$val1['goods_id'];
                    }
                    $filter1['goods_id'] = array('in',$info);
                    $products = $product_mdl->where($filter1)->count();
                    $filter2['goods_id'] = array('in',$info);
                    $filter2['product_store'] = 0;
                    $yishou = $product_mdl->where($filter2)->count();
                    $info = array();
                    $cat_parts[$key]['store'] = $products;
                    $cat_parts[$key]['yishou'] = $yishou;
                    $cat_parts[$key]['weishou']= $products-$yishou;
                }
            }
            $this->assign('info',$cat_parts);
            $this->display();
    }


    public function show($id=null){
        $cat_part_mdl = M('cat_parts');
        $good_mdl = M('goods');
        $product_mdl = M('products');
        $cat_parts = $cat_part_mdl->where(array('id'=>$id))->find();
        $filter['own_name']= $cat_parts['cat_part_name'];
        $goods = $good_mdl->field('goods_id')->where($filter)->select();
//        echo '<pre>';print_r($goods);exit;
        foreach($goods as $key=>$val){
            $info[] = $val['goods_id'];
        }

        $where['goods_id'] = array('in',$info);
        $where['product_store'] = 0;
        $products = $product_mdl->where($where)->select();
        $this->assign('position',$cat_parts['cat_part_name']);
        $this->assign('products',$products);
        $this->display('Store/show');
    }


}