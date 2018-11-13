<?php
namespace Admin\Controller;
use Think\Controller;
class UserController extends Controller {
    public function index(){
        //实例化会员表
        $_GET['p'] = isset($_GET['p'])? $_GET['p'] : '1';
        $user_mdl = M('users');
        $user = $user_mdl->page($_GET['p'],7)->select();

        $count = $user_mdl->count();
        $Page = new\Think\Page($count,7);
        $Page->lastSuffix=false;
//        $Page->setConfig('header','<li class="rows">共<b>%TOTAL_ROW%</b>条记录&nbsp;&nbsp;每页<b>4</b>条&nbsp;&nbsp;第<b>%NOW_PAGE%</b>页/共<b>%TOTAL_PAGE%</b>页</li>');
        $Page->setConfig('prev','上一页');
        $Page->setConfig('next','下一页');
        $Page->setConfig('last','末页');
        $Page->setConfig('first','首页');
        $Page->setConfig('theme','%FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END% %HEADER%');
        $show = $Page->show();
        $this->assign('page',$show);
        $this->assign('count',$count);
        $this->assign('user',$user);
        $this->display();
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


    public function edit($id){
        //实例化会员表
        $user_mdl = M('users');
        $filter['id'] = $id;
        $user = $user_mdl->where($filter)->find();
        $info['name'] = $user['name'];
        $info['level'] = $user['level'];
        $info['id'] = $user['id'];
        $this->assign('info',$info);
        $this->display();
    }

    public function doedit($id){
        //实例化会员表
        $user_mdl = M('users');
        $filter['id'] = $id;
        $updateinfo['name'] = $_POST['name'];
        $updateinfo['password'] = md5($_POST['pwd']);
        $updateinfo['level'] = $_POST['level'];
        $data = $user_mdl->where($filter)->save($updateinfo);
        if($data == 1){
            $this->success('修改成功', U('index'), 2);
        }else{
            $this->error('修改失败,请重新修改');//提示失败，还是停留在当前页面
        }
    }

    public function add(){

        $this->display();
    }

    public function doadd(){
        //实例化会员表
        $user_mdl = M('users');
        $userinfo['name'] = $_POST['name'];
        $userinfo['password'] = md5($_POST['pwd']);
        $userinfo['level'] = $_POST['level'];
        $userinfo['regtime'] = date("Y-m-d H:i:s",time());
        $result = $user_mdl->add($userinfo);
        if($result){
            $this->success('添加成功', U('index'), 2);
        }else{
            $this->error('添加失败,请重新添加', U('add'), 2);
        }
    }


    public function select(){
        $user_mdl = M('users');
        if($_POST){
            $like['name'] = array('like','%'.$_POST['keyword'].'%');
            $users = $user_mdl->where($like)->select();
            if(!empty($users)){
                $this->assign('keyword',$_POST['keyword']);
                $this->assign('user',$users);
                $this->display('User/index');
            }
        }
    }

}