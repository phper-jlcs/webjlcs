<?php
namespace Finance\Controller;
use Think\Controller;

class OrderController extends Controller{

    //订单列表
    public function index(){
    	$order_mdl = M('orders');
    	$order_detail_mdl = M('order_details');
    	$user_mdl = M('users');
    	
    	//过滤订单数据 若为作废订单 不显示
        $filter['status'] = array('neq',5);
        $filter['beizhu'] = '小商品';
        if(I('post.order_id')){
           $filter['order_id'] = I('post.order_id'); 
        }
        $orders = $order_mdl->where($filter)->select();
        foreach($orders as $key=>$val){
            $order_details = $order_detail_mdl->where(array('orderid'=>$val['id'],'status'=>array('neq',5)))->select();
            foreach($order_details as $k=>$v){
                $orders[$key]['warrants'][] = $v['description'];
            }
            $users = $user_mdl->where(array('id'=>$val['user_id']))->find();
            $orders[$key]['name'] = $users['name'];
            $orders[$key]['user_cartid'] = $users['user_cartid'];
        }
    	$this->assign('orders',$orders);
        $this->assign('keyword',$filter['order_id']);
        $this->display();
    }
    
    public function edit($id=null){
        //实例化商品表
        $order_mdl = M('orders');
        $user_mdl = M('users');
        $order_detail_mdl =M('order_details');
        $user_info_mdl = M('user_infos');
        $filter['id'] = $id;
        $orders = $order_mdl->where($filter)->find();
        $users = $user_mdl->where(array('id'=>$orders['user_id']))->find();
        $info['id'] = $orders['id'];
        $order_details = $order_detail_mdl->where(array('orderid'=>$orders['id']))->select();
        foreach($order_details as $key=>$val){
            //查询位置类型
            $product_id = $val['product_id'];
            $type = position_type($product_id);
            $types[] = $type;
            $orderinfo[] = $product_id;
            $warrant[] = $val['description'];
        }
        //查询 订单个人信息
        $user_infos = $user_info_mdl->where(array('id'=>$orders['user_info_id']))->find();
        //
        $info['order_id'] = $orders['order_id'];
        $info['user_name'] = $users['name'];
        $info['user_cartid'] = $users['user_cartid'];
        $info['order_num'] = $orders['order_num'];
        $info['order_total_price'] = $orders['order_total_price'];
        $info['createtime'] = $orders['createtime'];
        $info['status'] = $orders['status'];
        $info['agent_aid'] = $orders['agent_aid'];
        $info['ciny'] = $orders['ciny'];
        $info['beizhu'] = $orders['beizhu'];
        $this->assign('orderinfo',$orderinfo);
        $this->assign('warrant',$warrant);
        $this->assign('type',$types);
        $this->assign('info',$info);
        $this->assign('user_infos',$user_infos);
        $this->display();
    }
    
    
    public function doedit($id){
        //实例化会员表
        $order_mdl = M('orders');
        $order_details_mdl = M('order_details');
        $product_mdl = M('products');
        $own_mdl = M('owns');
        $user_mdl = M('users');
        $user_cartid_mdl = M('user_cartids');
        $user_info_mdl = M('user_infos');
        $filter['id'] = $id;
        $updateinfo = array(
            'status'=>$_POST['status'],
        );
        $user_infoData = array(
            'address'=>$_POST['address'],
            'phone'=>$_POST['phone'],
        );

        $orders = $order_mdl->where(array('id'=>$id))->find();
        //当后台主动修改订单状态时，将该订单的用户绑定在商品上，owns归属表
        if($updateinfo['status'] == 1){
            //更新订单模式----》线下付款
            if($orders['attr']==''){
               $order_mdl->where(array('id'=>$id))->save(array('attr'=>2));
            }
            //更新订单状态（已付款）  将商品库存更新为0 将商品绑定用户
            $order_details = $order_details_mdl->where(array('orderid'=>$id))->select();
            foreach($order_details as $key=>$val){
                //更新库存
                 $product_id = $val['product_id'];
                $num =  $val['num'];
                $info = updatestore($product_id,$num);
                $product_mdl->where(array('id'=>$product_id))->save($info);
                //更新属主
//                $saveinfo['product_id'] = $val['product_id'];
//                $saveinfo['user_id'] = $val['user_id'];
//                //判断当前属主是否已经被添加 防止管理员多次点击该处
//                if(!$own_mdl->where(array('product_id'=>$saveinfo['product_id']))->find()){
//                    $own_mdl->add($saveinfo);
//                }
            }
        }
        //更新会员卡表  1. 1个会员卡可以订购多个订单，因此不做限制。  2.1个会员卡只能绑定一个账号
        if($_POST['user_cartid']){
            $users = $user_mdl->where(array('user_cartid'=>$_POST['user_cartid']))->find();
            $user_id = $orders['user_id'];
            //存在 会员卡已被激活
            if($users){
                //判断是否是目标客户
                if($users['id'] == $user_id){
                    $user_cartid_save = 1;
                }else{
                    $this->error('很抱歉，该会员卡号已被激活!请换个卡号',U('edit',array('id'=>$id)), 1);
                }
            }else{
                //自行添加
                $users_edit = $user_mdl->where(array('id'=>$user_id))->save(array('user_cartid'=>$_POST['user_cartid']));
                //添加成功 修改状态
                if($users_edit == 1){
                    $user_cartid_save = $user_cartid_mdl->where(array('user_cartid'=>$_POST['user_cartid']))->save(array('state'=>1));
                }else{
                    $this->error('很抱歉，该会员卡号已被激活!请换个卡号!',U('edit',array('id'=>$id)),1);
                }
            }

        }else{
            $user_cartid_save =1;
        }

        if($user_cartid_save == 1){
            //修改订单表   修改信息表
            $data = $order_mdl->where(array('id'=>$id))->save($updateinfo);
            $user_info_save = $user_info_mdl->where(array('id'=>$orders['user_info_id']))->save($user_infoData);
        }else{
            $this->error('会员卡号添加失败，请核实!',U('edit',array('id'=>$id)),1);
        }
        if($data == 1 ||$user_info_save == 1){
            $this->success('修改成功', U('index'), 2);
        }else{
            $this->error('修改失败,请重新修改', U('edit',array('id'=>$id)), 2);
        }
    }

    
    //作废无效订单
    public function del_wuxiao($id){
        //修改订单支付状态为5，，，则视为无效订单，并不删除该订单
        $order_mdl = M('orders');
        $data = array(
            'status' => 5,
        );
        $orders = $order_mdl->where(array('id'=>$id))->find();
        if($orders['status'] != 1){
            $order_save = $order_mdl->where(array('id'=>$id))->save($data);
            if($order_save == 1){
                $this->success('订单作废成功！',U('index'),1);
            }else{
                $this->success('订单作废失败,请重试!！',U('index'),1);
            }
        }else{
            $this->success('该订单不能作废，为已付款订单!');
        }

    }

    public function select_order(){
        $order_mdl = M('orders');
        $user_mdl = M('users');
        if($_POST['id'] == 1){
            $orders = $order_mdl->where(array('status'=>1,'beizhu'=>'小商品'))->page($_GET['p'],8)->select();
            foreach($orders as $key=>$val){
                $users = $user_mdl->where(array('id'=>$val['user_id']))->find();
                $orders[$key]['name'] = $users['name'];
            }
            if(!empty($orders)){
                $count = $order_mdl->where(array('status'=>1,'beizhu'=>'小商品'))->count();
                $show = pagefenye($count);
                $this->assign('page',$show);
                $this->assign('count',$count);
                $this->assign('orders',$orders);
                $this->display('ajax_show');
            }
        }elseif($_POST['id'] == 0){
            $orders = $order_mdl->where(array('status'=>0,'beizhu'=>'小商品'))->select();
            foreach($orders as $key=>$val){
                $users = $user_mdl->where(array('id'=>$val['user_id']))->find();
                $orders[$key]['name'] = $users['name'];
            }
            if(!empty($orders)){
                $this->assign('orders',$orders);
                $this->display('ajax_show');
            }
        }else{
            $orders = $order_mdl->where(array('beizhu'=>'小商品'))->select();
            if(!empty($orders)){
                $this->assign('orders',$orders);
                $this->display('ajax_show');
            }
        }
    }
}