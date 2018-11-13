<?php
namespace Admin\Controller;
use Think\Controller;
class OrderController extends Controller {
    public function index($id=null){
        //实例化商品表
        $order_mdl = M('orders');
        $order_detail_mdl = M('order_details');
        $user_mdl = M('users');
        $_GET['p'] = isset($_GET['p']) ? $_GET['p'] : '1';
        //过滤订单数据 若为作废订单 不显示
        $filter['status'] = array('neq',5);
        $orders = $order_mdl->page($_GET['p'],8)->where($filter)->select();
        foreach($orders as $key=>$val){
            $order_details = $order_detail_mdl->where(array('orderid'=>$val['id'],'status'=>array('neq',5)))->select();
            foreach($order_details as $k=>$v){
                $orders[$key]['warrants'][] = $v['description'];
            }
            $users = $user_mdl->where(array('id'=>$val['user_id']))->find();
            $orders[$key]['name'] = $users['name'];
            $orders[$key]['user_cartid'] = $users['user_cartid'];
            //计算倒计时
            $type = $val['management_expense'];
            if($type == ''){
                $type = 1;
            }
            $time = $val['createtime'];
            $orders[$key]['count_down'] = $this->chkcontime($type,$time);
        }
        //查询订单详情 是否有多个供奉权证号
        $count = $order_mdl->count();
        $show = pagefenye($count);
        $this->assign('page',$show);
        $this->assign('count',$count);
        $this->assign('orders',$orders);
        $this->display();
    }

    //计算倒计时函数
    public function chkcontime($params=1,$time){
        switch($params){
            case 1:
                $now_time = time();
                $old_time = strtotime($time);
                $date1 = strtotime(date('Y-m-d', $now_time));
                $date2 = strtotime(date('Y-m-d', $old_time));
                $hastime = intval(($date1-$date2)/86400);
                $yeartime = 5*365;
                $shentime = $yeartime - $hastime;
                break;
            case 2:

                break;
            case 3:

                break;
        }
        return $shentime;
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
            'user_number'=>$_POST['user_cartid'],
            'ciny'=>$_POST['ciny'],
            'beizhu'=>$_POST['beizhu'],
            'management_expense'=>$_POST['manage_expense'],
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
                $saveinfo['product_id'] = $val['product_id'];
                $saveinfo['user_id'] = $val['user_id'];
                //判断当前属主是否已经被添加 防止管理员多次点击该处
                if(!$own_mdl->where(array('product_id'=>$saveinfo['product_id']))->find()){
                    $own_mdl->add($saveinfo);
                }
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

    public function add(){
        $this->display();
    }


    public function info($id){
        $filter['id'] = $id;
        $user_info_mdl = M('user_infos');
        $order_mdl = M('orders');
        $user_mdl = M('users');
        $orders = $order_mdl->where($filter)->find();
        $users = $user_mdl->where(array('user_id'=>$orders['user_id']))->find();

        $user_info_id = $orders['user_info_id'];

        $user_infos = $user_info_mdl->where(array('id'=>$user_info_id))->find();
        $this->assign('user_name',$users['name']);
        $this->assign('orders',$orders);
        $this->assign('user_infos',$user_infos);
        $this->display();
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

    public function do_info($id){
        $filter['id'] = $id;
        $user_info_mdl = M('user_infos');
        $order_mdl = M('orders');
        $orders = $order_mdl->where($filter)->find();
        $user_info_id = $orders['user_info_id'];
        $address = $_POST['address'];
        $phone = $_POST['phone'];
        $info = array(
            'address'=>$address,
            'phone'=>$phone,
        );

        $user_infos = $user_info_mdl->where(array('id'=>$user_info_id))->save($info);
        if($user_infos == 1){
            $this->success('修改成功', U('index'), 2);
        }else{
            $this->error('修改失败,请重新修改', U('info',array('id'=>$id)), 2);
        }
    }


    public function select($cat){
        switch($cat){
            case 'order':
                $selectkey = 'order_id';
                $this->selectAll($cat,$selectkey);
                break;
            case 'phone':
                $selectkey = 'phone';
                $this->selectAll($cat,$selectkey);
                break;
            case 'cid':
                $selectkey = 'agreement_id';
                $this->selectAll($cat,$selectkey);
                break;
        };
    }

    public function selectAll($cat,$selectkey){
        //实例化商品表
        $order_mdl = M('orders');
        $keywords = $_POST['keyword'];
        $user_mdl = M('users');
        $order_detail_mdl = M('order_details');
            $filter[$selectkey] = $keywords;
            $orders = $order_mdl->where($filter)->select();
            if(!empty($orders)){
                foreach($orders as $key=>$val){
                    $order_detail = $order_detail_mdl->where(array('orderid'=>$val['id']))->select();
                    foreach($order_detail as $K=>$v){
                        $orders[$key]['warrants'][] = $v['description'];
                    }
                    $users = $user_mdl->where(array('id'=>$val['user_id']))->find();
                    $orders[$key]['name'] = $users['name'];
                    $orders[$key]['user_cartid'] = $users['user_cartid'];
                }
            }
        switch($cat){
            case 'order':
                $this->assign('orders',$orders);
                $this->assign('keyword1',$keywords);
                $this->display('Order/index');
                break;
            case 'phone':
                $this->assign('orders',$orders);
                $this->assign('keyword2',$keywords);
                $this->display('Order/index');
                break;
            case 'cid':
                $this->assign('orders',$orders);
                $this->assign('keyword3',$keywords);
                $this->display('Order/index');
                break;
        }

    }


    public function select_order(){
        $order_mdl = M('orders');
        if($_POST['id'] == 1){
            $orders = $order_mdl->where(array('status'=>1))->page($_GET['p'],8)->select();
            $orders = $this->select_name($orders);
            if(!empty($orders)){
                $count = $order_mdl->where(array('status'=>1))->count();
                $show = pagefenye($count);
                $this->assign('page',$show);
                $this->assign('count',$count);
                $this->assign('orders',$orders);
                $this->display('ajax_show');
            }
        }elseif($_POST['id'] == 0){
            $orders = $order_mdl->where(array('status'=>0))->select();
            $orders = $this->select_name($orders);
            if(!empty($orders)){
                $this->assign('orders',$orders);
                $this->display('ajax_show');
            }
        }else{
            $orders = $order_mdl->select();
            $orders = $this->select_name($orders);
            if(!empty($orders)){
                $this->assign('orders',$orders);
                $this->display('ajax_show');
            }
        }
    }

    public function select_name($orders){
        $user_mdl = M('users');
        $order_detail_mdl = M('order_details');
        foreach($orders as $key=>$val){
            $order_details = $order_detail_mdl->where(array('orderid'=>$val['id']))->select();
            foreach($order_details as $k=>$v){
                $orders[$key]['warrants'][] = $v['description'];
            }
            $users = $user_mdl->where(array('id'=>$val['user_id']))->find();
            $orders[$key]['name'] = $users['name'];
            $orders[$key]['user_cartid'] = $users['user_cartid'];
        }
        return $orders;
    }

}