<?php
namespace Adminagent\Controller;
use Think\Controller;
class AgentController extends Controller {
    public function index(){
        // var_dump(I('post.id'));exit;
        $agent_user_mdl = M('agent_users');
        $agent_mdl = M('agents');
        $agents = $agent_mdl->where(array('agent_name'=>$_SESSION['name']))->find();//查找当前登录用户的信息（唯一一条）
        //查询当前登录的代理商下的客户
        if($agents){
            if(I('post.id')){ //点击了头部栏的查询客户ID的情况，加入ID作为筛选条件
               $agents_check = $agent_user_mdl->where(array('agent_user_pid'=>$agents['id'],'id'=>I('post.id')))->select();
               $keyword = I('post.id');
            }else{
                $agents_check = $agent_user_mdl->where(array('agent_user_pid'=>$agents['id']))->select();
            }
            foreach($agents_check as $key=>$val){
               $time = strtotime($val['agent_user_regtime']);
                $agent_user_regtime = $time + 15552000;
                $agents_check[$key]['qutime'] = date('Y-m-d H:i:s',$agent_user_regtime);
                //判断当前时间是否大于注销时间
                if(time()>$agent_user_regtime){
                   $agent_user_mdl->where(array('id'=>$val['id']))->delete();
                }
            }
        }
        $this->assign('agent_aid',$agents['agent_aid']);
        $this->assign('agents',$agents_check);
        $this->assign('keyword',$keyword);
        $this->show();
    }

    public function add(){
        $agent_mdl = M('agents');
        $user_mdl = M('users');
        $agents = $agent_mdl->where(array('agent_name'=>$_SESSION['name']))->find();
        $this->assign('agents',$agents);
        $this->show();
    }

    public function doadd(){
        $agent_user_mdl = M('agent_users');
        $user_mdl = M('users');
        $info = array(
            'agent_user_pid'=>$_POST['agent_user_pid'],
            'agent_user_username'=>$_POST['agent_user_username'],
            'agent_user_name'=>$_POST['agent_user_name'],
            'agent_user_phone'=>$_POST['agent_user_phone'],
            'agent_user_cid'=>$_POST['agent_user_cid'],
            'agent_user_address'=>$_POST['agent_user_address'],
            'agent_user_regtime'=>date('Y-m-d H:i:s',time())
        );

        //判断注册的用户有没有在系统注册
        $users = $user_mdl->where(array('name'=>$_POST['agent_user_username']))->find();
        if($users){
            //判断当前注册用户有没有被其他代理商注册
            $agents = $agent_user_mdl->where(array('agent_user_cid'=>$_POST['agent_user_cid']))->find();
             if($agents){
                $this->error('添加失败，当前客户已被其他代理商报备',U('add'),2);
             }else{
                //满足各条件后给予报备
                $agents_check = $agent_user_mdl->add($info);
                 if($agents_check){
                        $this->success('添加成功,前去查看您的客户吧',U('index'),2);
                 }else{
                     $this->error('添加失败,请重新添加',U('add'),2);
                 }
             }
        }else{
           $this->error('很抱歉,当前客户没有在网站进行注册',U('add'),2);
        }
    }

    public function del($id){
        $agent_user_mdl = M('agent_users');
        $agents = $agent_user_mdl->where(array('id'=>$id))->delete();
        if($agents){
            $this->success('删除成功,前去查看您的客户吧',U('index'),2);
        }else{
            $this->error('删除失败,请重新删除',U('index'),2);
        }
    }

    public function update($id){
        $agent_user_mdl = M('agent_users');
        $agent_users = $agent_user_mdl->where(array('id'=>$id))->find();
        $this->assign('agents',$agent_users);
        $this->show();
    }


    public function doupdate(){
        $agent_user_mdl = M('agent_users');
        $info = array(
           'agent_user_name'=>$_POST['agent_user_name'],
           'agent_user_phone'=>$_POST['agent_user_phone'],
           'agent_user_cid'=>$_POST['agent_user_cid'],
           'agent_user_address'=>$_POST['agent_user_address'],
       );
        $agent_users = $agent_user_mdl->where(array('id'=>$_POST['id']))->save($info);
        if($agent_users == 1){
            $this->success('修改成功,前去查看您的客户吧',U('index'),2);
        }else{
            $this->error('修改失败,请重新修改',U('index'),2);
        }
    }
}