<?php
namespace Admin\Controller;
use Think\Controller;
class StoreController extends Controller {
    public function index(){
        $cat_part_mdl = M('cat_parts');
        $cat_parts = $cat_part_mdl->field(array('id','cat_id','cat_part_name'))->select();
        foreach($cat_parts as $key=>$val){
            //$cat_parts['cat_part_name']= $val['cat_part_name'];
            //单位查询
            $danwei = $this->select_fl_dan(array('cat_part_name'=>$val['cat_part_name']));
            //双位查询
            $shuangwei = $this->select_fl_shuang(array('cat_part_name'=>$val['cat_part_name']));
            //已售未售统计
            $count_store= $this->count_store(array('cat_id'=>$val['cat_id'],'cat_part_name'=>$val['cat_part_name']));
            $cat_parts[$key]['f_dan'] = $danwei['f_count'];
            $cat_parts[$key]['l_dan'] = $danwei['l_count'];
            $cat_parts[$key]['f_shuangwei'] = $shuangwei['f_count'];
            $cat_parts[$key]['l_shuangwei'] = $shuangwei['l_count'];
            $cat_parts[$key]['store'] = $count_store['store'];
            $cat_parts[$key]['yishou'] = $count_store['yishou'];
            $cat_parts[$key]['weishou'] = $count_store['weishou'];
        }
        $this->assign('cat_parts',$cat_parts);
        $this->show();
    }


    public function showe($id=null){
        $cat_part_mdl = M('cat_parts');
        $good_mdl = M('goods');
        $product_mdl = M('products');
        $own_mdl = M('owns');
        $user_mdl = M('users');
        $cat_parts = $cat_part_mdl->where(array('id'=>$id))->find();
        $filter['own_name']= $cat_parts['cat_part_name'];
        $goods = $good_mdl->field('goods_id')->where($filter)->select();
        foreach($goods as $key=>$val){
            $info[] = $val['goods_id'];
        }

        $where['goods_id'] = array('in',$info);
        $where['product_store'] = 0;
        $products = $product_mdl->where($where)->select();
        //获取当前位置的认捐者
        foreach($products as $key=>$val){
            $owns = $own_mdl->where(array('product_id'=>$val['id']))->find();
            $users = $user_mdl->where(array('id'=>$owns['user_id']))->find();
            $products[$key]['own_id'] = $users['name'];
        }
        $this->assign('position',$cat_parts['cat_part_name']);
        $this->assign('products',$products);
        $this->display('Store/showe');
    }


    public function store(){
        $cat_part_mdl = M('cat_parts');
        $cat_parts = $cat_part_mdl->where(array('id'=>1))->find(); //默认是显示佛恩殿A的数据
        //单位查询
        $danwei = $this->select_fl_dan($cat_parts);
        //双位查询
        $shuangwei = $this->select_fl_shuang($cat_parts);
        //已售未售统计
        $count_store = $this->count_store($cat_parts);
        $cat_parts['store'] = $count_store['store'];
        $cat_parts['yishou'] = $count_store['yishou'];
        $cat_parts['weishou'] = $count_store['weishou'];
        $cat_part = $cat_part_mdl->select();
        $this->assign('info',$cat_parts);
        $this->assign('danwei',$danwei);
        $this->assign('shuangwei',$shuangwei);
        $this->assign('cat_parts',$cat_part);
        $this->show();
    }
    public function count_store($cat_parts){
        $good_mdl = M('goods');
        $product_mdl = M('products');
        //总goods
        $goods = $good_mdl->where(array('own_name'=>$cat_parts['cat_part_name']))->select(); //佛恩殿对应的goods信息
        //佛龛位
        $fokan_count = $product_mdl->where(array('danshuang'=>'佛龛','cat_id'=>$cat_parts['cat_id']))->count();
        $fokan = $fokan_count/2;
        if(!empty($goods)){
            $count = 0;
            $count_yishou = 0;
            foreach($goods as $key=>$val){
                $products = $product_mdl->where(array('goods_id'=>$val['goods_id']))->count();
                $info[] = $products;
                $product_yishou = $product_mdl->where(array('goods_id'=>$val['goods_id'],'product_store'=>0))->count();
                $count += $products;
                $count_yishou += $product_yishou;
            }
            $cat_part['yishou'] = $count_yishou;
            $cat_part['store'] = $count - $fokan;
            $cat_part['weishou'] = $count-$count_yishou;
        }
        return $cat_part;
    }
    public function select_fl_dan($cat_parts){
        $good_mdl = M('goods');
        $product_mdl = M('products');
        $goods = $good_mdl->where(array('own_name'=>$cat_parts['cat_part_name'],'danshuang'=>'单位'))->select();
        if(!empty($goods)){
            $count = 0;
            $l_count = 0;
            foreach($goods as $key=>$val){
                $products = $product_mdl->where(array('goods_id'=>$val['goods_id']))->count();//产品个数
                $l_products = $product_mdl->where(array('goods_id'=>$val['goods_id'],'type'=>1))->count();//种类等于1(莲位)的商品个数

                $l_count += $l_products;
                $count += $products;
            }
            $f_count = $count-$l_count;//总的单个产品数 - type等于1的产品数(莲位数) = 单个佛像的产品数
        }

        $total = array(
            'f_count'=>$f_count,
            'l_count'=>$l_count,
        );
        return $total;
    }


    public function select_fl_shuang($cat_parts){
        $good_mdl = M('goods');
        $product_mdl = M('products');
        $goods = $good_mdl->where(array('own_name'=>$cat_parts['cat_part_name']))->select();
        //总计列数，即莲花位数
        $count = count($goods);//总的莲位(包括单双位)154
        //总计单位列数A，
        $count_dan = $good_mdl->where(array('own_name'=>$cat_parts['cat_part_name'],'danshuang'=>'单位'))->count();
        //总计双位列数B
        $l_shuang = $count-$count_dan; //无论单双，其中都可能包含有佛龛位,佛龛位位于product表，不在goods表
        //总计双位数量（包含佛龛）
        $total_shuang = 8*$l_shuang;//每个莲位有8层，所以要计算双位总个数要乘以8
        if(!empty($goods)){
            foreach($goods as $key=>$val){
                if($val['danshuang'] !='单位'){  //排除掉单个的莲位，只是做双位的佛龛统计之条件
                    $info[] = $val['goods_id'];  
                }
            }
            $filter['goods_id'] = array('in',$info);
            $filter['danshuang'] = array('eq','佛龛');
            $count_fokan = $product_mdl->where($filter)->count(); //这里$count_fokan指的是双位的佛龛数目
            $f_shuang = $total_shuang-$count_fokan;//总的双位数 - 双位的佛龛数 = 双位的佛像数
        }
        $total = array(
            'l_count'=>$l_shuang,
            'f_count'=>$f_shuang,
        );
        return $total;
    }

    public function select(){
        $cat_part_mdl = M('cat_parts'); //区域，佛孝殿A区、B区等等
        $good_mdl = M('goods');  //某个殿下的某个区域(下属8层)
        $product_mdl = M('products'); //每一层里面的佛像位
        $cat_parts = $cat_part_mdl->where(array('id'=>$_POST['position']))->find();
        $goods = $good_mdl->where(array('own_name'=>$cat_parts['cat_part_name']))->select();
        //单位查询
        $danwei = $this->select_fl_dan($cat_parts);
        //双位查询
        $shuangwei = $this->select_fl_shuang($cat_parts);
        if(!empty($goods)){
            foreach($goods as $key=>$val){
                $info[] = $val['goods_id'];
            }
            $filter1['goods_id'] = array('in',$info);
            $products = $product_mdl->where($filter1)->count();
            $filter2['goods_id'] = array('in',$info);
            $filter2['product_store'] = 0;
            $yishou = $product_mdl->where($filter2)->count();
            $info = array();
            $cat_parts['store'] = $products;
            $cat_parts['yishou'] = $yishou;
            $cat_parts['weishou']= $products-$yishou;
        }
        $cat_part = $cat_part_mdl->select();
        $this->assign('danwei',$danwei);
        $this->assign('shuangwei',$shuangwei);
        $this->assign('cat_parts',$cat_part);
        $this->assign('info',$cat_parts);
        $this->assign('keyword',I('post.position'));
        $this->display('Store/store');
    }


    public function warrant(){
        $this->show();
    }

    public function selectwarrant(){
        $product_mdl = M('products');
        $warrant_number = $_POST['warrant_number'];
        $product_id = warrant_fanxiang($warrant_number);
        $products = $product_mdl->where(array('id'=>$product_id))->find();
        $status = $products['product_store']==1?'可售':'已售';
        $position = position_select($product_id);
        $position['warrant_number'] = $warrant_number;
        $position['product_id'] = $product_id;
        $position['status'] = $status;
        $this->assign('position',$position);
        $this->display('Store/warrant');
    }


}