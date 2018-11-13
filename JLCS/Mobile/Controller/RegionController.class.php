<?php
namespace Mobile\Controller;
use Think\Controller;
class RegionController extends Controller {



    public function check(){
        header("Content-type:text/php;charset=utf-8");
       $cat_part_mdl = M('cat_parts');
        if(is_numeric($_POST['id'])){
            $cat_parts = $cat_part_mdl->where(array('cat_id'=>$_POST['id']))->order('id asc')->select();
            if(!empty($cat_parts)){
                $returnData = json_encode($cat_parts);
                $this->ajaxReturn($returnData);
            }else{
                echo 'a';
            }
        }else{
            echo 'a';
        }

    }

    public function checkcat(){
        header("Content-type:text/php;charset=utf-8");
       $good_mdl = M('goods');
        $cat_part_mdl = M('cat_parts');
        if(is_numeric($_POST['id'])){
            $cat_parts = $cat_part_mdl->where(array('id'=>$_POST['id']))->find();
            $temples = $this->selecttemple($_POST['id']);
            //判断  若为镇海寺的，不需要按goods_name排序
            if($temples['id'] == 1){
                $goods = $good_mdl->where(array('own_name'=>$cat_parts['cat_part_name']))->order('goods_name asc')->select();
            }else{
                $goods = $good_mdl->where(array('own_name'=>$cat_parts['cat_part_name']))->select();
                foreach($goods as $key=>$val){
                    $goods[$key]['goods_name'] = $val['owns'].'-'.$val['goods_name'];
                }
            }
            if(!empty($goods)){
                $returnData = json_encode($goods);
                $this->ajaxReturn($returnData);
            }else{
                echo 'a';
            }
        }else{
            echo 'a';
        }

    }

    //寺庙查询接口
    public function selecttemple($id){
        $region_mdl = M('regions');
        $cat_mdl = M('cats');
        $cat_part_mdl = M('cat_parts');
        $temple_mdl = M('temples');
        $cat_parts = $cat_part_mdl->where(array('id'=>$id))->find();
        $cats = $cat_mdl->where(array('id'=>$cat_parts['cat_id']))->find();
        $regions = $region_mdl->where(array('id'=>$cats['region']))->find();
        $temples = $temple_mdl->where(array('id'=>$regions['temple']))->find();
        return $temples;
    }

    public function checklie(){
        header("Content-type:text/php;charset=utf-8");
        $product_mdl = M('products');
        $id = $_POST['id'];
        if(is_numeric($id)){
            $filter['_string'] = "FIND_IN_SET($id,goods_id)";
            $products = $product_mdl->where($filter)->order('id asc')->select();
            if(!empty($products)){
                $returnData = json_encode($products);
                $this->ajaxReturn($returnData);
            }else{
                echo 'a';
            }
        }else{
            echo 'a';
        }

    }

    public function checkcataa(){
        header("Content-type:text/php;charset=utf-8");
        $good_mdl = M('goods');
        $cat_part_mdl = M('cat_parts');
        $product_mdl = M('products');
        $id = $_POST['id'];
        if(is_numeric($id)){
            $cat_parts = $cat_part_mdl->where(array('id'=>$id))->find();
            $str = '皇家宗祠->'.$cat_parts['cat_part_name'];
            $goods = $good_mdl->where(array('own_name'=>$str))->select();
            foreach($goods as $key=>$val){
                $products =$product_mdl->where(array('goods_id'=>$val['goods_id']))->find();
                $productinfo[]=$products;
            }
            if(!empty($productinfo)){
                $returnData = json_encode($productinfo);
                $this->ajaxReturn($returnData);
            }else{
                echo 'a';
            }
        }else{
            echo 'a';
        }
    }







}