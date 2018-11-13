<?php
namespace Finance\Controller;
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
        //总利润----成本
        $finances = M('finances');
        $inventory_records = $finances->where(array('attr'=>1))->select();
        $inventory_record_other = $finances->where(array('attr'=>array('neq','1')))->select();
        //总利润
        $alltotal = 0;
        foreach($inventory_records as $key=>$val){
            $alltotal += $val['allprice'];
        }
        //成本
        $stocktotal = 0;
        foreach($inventory_record_other as $k=>$v){
            $stocktotal += $v['allprice'];
        }
        //利润
        $profit = $alltotal - $stocktotal;
        $Data = array(
            'alltotal'=> $alltotal,
            'stocktotal'=> $stocktotal,
            'profit'=> $profit,
        );
        $this->assign('Data',$Data);
        $this->show();
    }

}