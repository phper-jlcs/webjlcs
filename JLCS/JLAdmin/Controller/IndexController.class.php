<?php
namespace JLAdmin\Controller;
use Think\Controller;
class IndexController extends Controller {
    public function index(){
        if(empty($_SESSION['name'])){
            $this->redirect('login');
        }else{
            $filter['name'] = $_SESSION['name'];
            $filter['level'] = 1;
            $user_mdl = M('users');
            $users = $user_mdl->where($filter)->find();
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

}