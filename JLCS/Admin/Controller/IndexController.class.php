<?php
namespace Admin\Controller;
use Think\Controller;
class IndexController extends Controller {
    public function index(){
        $user_mdl = M('users');
        if(empty($_SESSION['name'])){
            $this->redirect('login');
        }else{
            $filter['name'] = $_SESSION['name'];
            $filter['level'] = 1;
            $users = $user_mdl->where($filter)->find();
            //判断是否是超级管理员 老板账号
                if($users['id'] == 1){
                    $sign = 1;
                $this->assign('sign',$sign);
                }
            if($users){
                $this->assign('name',$_SESSION['name']);
                $this->display();
            }else{
                $this->error('您还没有权限登录',U('login',1));
            }
        }
    }
    public function url(){
        $this->redirect('Home/Index/index');
    }

    public function logout(){
        session(null);
        redirect(U('Index/login'), 2, '正在退出登录...');
    }
    public function login(){
        $this->display();
    }
    public function dologin(){
        if(IS_POST){
            //实例化Model users表
            $model = M('users');
            //查询条件
            $filter=array();
            $filter['name'] = $_POST['name'];
            $result = $model->where($filter)->find();
            if($result && md5($_POST['pwd']) == $result['password']){
                if($result['level'] == 1){
                    session('id', $result['id']);          // 当前用户id
                    session('name', $result['name']);   // 当前用户名
                    $this->success('欢迎登录后台管理系统', U('Index/index'));
                }else{
                    $this->error('您还没有权限登录',U('login',1));
                }
            }else{
                $this->error('登录失败,用户名或密码不正确!',U('login',1));
            }
        }else{
            $this->display();
        }

    }
//老板 独享专区
    public function main_list(){
        //已售数量 销售额
        $own_mdl = M('owns');
        $order_mdl = M('orders');
        $order_detail_mdl = M('order_details');
        $agent_mdl = M('agents');
        $user_mdl = M('users');
        //会员总数
        $users = $user_mdl->count();
        //代理商数量
        $agent = $agent_mdl->count();
        //已售数量
        $owns = $own_mdl->count();
        //销售额
        $orders = $order_mdl->where(array('status'=>1))->select();
        $Alltotal = 0;
        $a = 1;
        foreach($orders as $key=>$val){
            //统计售卖位置
            $order_details = $order_detail_mdl->where(array('orderid'=>$val['id']))->select();
            foreach($order_details as $k=>$v){

                $product_id = $v['product_id'];
                $position = position_select($product_id);
                $orders[$key]['position'] = $position['strname'];
                $orders[$key]['pri_key'] = $a;
                $a++;
            }
            //统计销售额
            $Alltotal += $val['order_total_price'];
        }
        $this->assign('orders',$orders);
        $this->assign('owns',$owns);
        $this->assign('users',$users);
        $this->assign('agent',$agent);
        $this->assign('total',$Alltotal);
        $this->show();
    }

}