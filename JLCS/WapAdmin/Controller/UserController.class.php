<?php
namespace WapAdmin\Controller;
use Think\Controller;
class UserController extends Controller {
    public function index(){
        //实例化会员表
        $_GET['p'] = isset($_GET['p'])? $_GET['p'] : '1';
        $user_mdl = M('weixin_users');
        if(I('post.name')){
            $user = $user_mdl->where(array('name'=>I('post.name')))->page($_GET['p'],7)->select();
            $count = $user_mdl->where(array('name'=>I('post.name')))->count();
        }else{
            $user = $user_mdl->page($_GET['p'],7)->select();
            $count = $user_mdl->count();
        }
        
        $Page = new\Think\Page($count,7);
        $Page->lastSuffix=false;
       //$Page->setConfig('header','<li class="rows">共<b>%TOTAL_ROW%</b>条记录&nbsp;&nbsp;每页<b>4</b>条&nbsp;&nbsp;第<b>%NOW_PAGE%</b>页/共<b>%TOTAL_PAGE%</b>页</li>');
        $Page->setConfig('prev','上一页');
        $Page->setConfig('next','下一页');
        $Page->setConfig('last','末页');
        $Page->setConfig('first','首页');
        $Page->setConfig('theme','%FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END% %HEADER%');
        $show = $Page->show();
        $this->assign('page',$show);
        $this->assign('count',$count);
        $this->assign('user',$user);
        $this->assign('keyword',I('post.name'));
        $this->display();
    }


    public function del($id){
        //实例化会员表
        $user_mdl = M('weixin_users');
        $filter['id'] = $id;
        $user = $user_mdl->where($filter)->delete();
        if($user == 1){
            $this->success('删除成功', U('index'), 2);
        }
    }


    public function edit($id=null){
        //实例化会员表
        $user_mdl = M('weixin_users');
        $filter['id'] = $id;

        $user = $user_mdl->where($filter)->find();
        $info['name'] = $user['name'];
        $info['id'] = $user['id'];
        $info['openid'] = $user['openid'];
        $this->assign('info',$info);
        $this->display();
    }

    public function doedit($id=null){
        //实例化会员表
        $user_mdl = M('users');
        $filter['id'] = $id;
        $user = $user_mdl->where($filter)->find();
        $updateinfo['name'] = $_POST['name'];
        $updateinfo['password'] = md5($_POST['password']);
        $updateinfo['level'] = $_POST['level'];
        $updateinfo['regtime'] = $user['regtime'];
        $data = $user_mdl->where($filter)->save($updateinfo);
        if($data == 1){
            $this->success('修改成功', U('index'), 2);
        }else{
            $this->error('修改失败,请重新修改', U('edit',array('id'=>$id)), 2);
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


}