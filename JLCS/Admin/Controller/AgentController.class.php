<?php
namespace Admin\Controller;
use Think\Controller;
class AgentController extends Controller {
    public function index(){
        $agent_mdl = M('agents');
        $order_mdl = M('orders');
        $_GET['p'] = isset($_GET['p'])? $_GET['p'] : '1';
        $agents = $agent_mdl->page($_GET['p'],7)->where('agent_level=1')->select();
        $count = $agent_mdl->where('agent_level=1')->count();
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
        //统计一级代理下面有多少个二级代理商 未付款订单 成交订单 总成交价
        $total = 0;
        foreach($agents as $key=>$val){
            $filter['pid'] = $val['agent_aid'];
            $agent_check = $agent_mdl->where($filter)->count();
            //模糊查询1级代理下面二级 三级代理的订单算在1级下面
            $like['agent_aid'] = array('like',$val['agent_aid'].'%');
            $like['status'] = 0;
            $order_check = $order_mdl->where($like)->count();
            $pay_like['agent_aid'] = array('like',$val['agent_aid'].'%');
            $pay_like['status'] = 1;
            $order_pay_check = $order_mdl->where($pay_like)->count();
            $order_total_check = $order_mdl->where($pay_like)->select();
            foreach($order_total_check as $key1=>$val1){
               $total += $val1['order_total_price'];
                $agents[$key]['agent_ordertotal'] = $total;
            }
            $agents[$key]['agent_nums'] = $agent_check;
            $agents[$key]['agent_orders_nopay'] = $order_check;
            $agents[$key]['agent_orders_pay'] = $order_pay_check;

        }
        $this->assign('agents',$agents);
        $this->show();
    }

    public function twoagent(){
        $agent_mdl = M('agents');
        $order_mdl = M('orders');
        $_GET['p'] = isset($_GET['p'])? $_GET['p'] : '1';
        $pid = isset($_POST['agent_aid'])?$_POST['agent_aid']:'A01';
        $filter['agent_level'] = 2;
        $filter['pid'] = $pid;
        $agents = $agent_mdl->page($_GET['p'],8)->where($filter)->select();
        $count = $agent_mdl->where($filter)->count();
        $Page = new\Think\Page($count,8);
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
        //统计二级代理下面有多少个三级代理商 未付款订单 成交订单 总成交价
        foreach($agents as $key=>$val){
            $agent_check = $agent_mdl->where(array('pid'=>$val['agent_aid']))->count();
            $like['agent_aid'] = array('like',$val['agent_aid']);
            $like['status'] = 0;
            $order_check = $order_mdl->where($like)->count();
            $pay_like['agent_aid'] = array('like',$val['agent_aid'].'%');
            $pay_like['status'] = 1;
            $order_pay_check = $order_mdl->where($pay_like)->count();
            $order_total_check = $order_mdl->where($pay_like)->select();
            foreach($order_total_check as $key1=>$val1){
                $total += $val1['order_total_price'];
                $agents[$key]['agent_ordertotal'] = $total;
            }
            $agents[$key]['agent_nums'] = $agent_check;
            $agents[$key]['agent_orders_nopay'] = $order_check;
            $agents[$key]['agent_orders_pay'] = $order_pay_check;
        }

        //查询一级代理
        $agent_first = $agent_mdl->where(array('agent_level'=>1))->select();
        $this->assign('cat_aid',$agent_first);
        $this->assign('agents',$agents);
        $this->show();
    }


    public function threeagent(){
        $agent_mdl = M('agents');
        $order_mdl = M('orders');
        $_GET['p'] = isset($_GET['p'])? $_GET['p'] : '1';
        $pid = isset($_POST['agent_aid'])?$_POST['agent_aid']:'A01b01';
        $agents = $agent_mdl->page($_GET['p'],8)->where(array('agent_level'=>3,'pid'=>$pid))->select();
        $count = $agent_mdl->where(array('agent_level'=>3,'pid'=>$pid))->count();
        $Page = new\Think\Page($count,8);
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
        //统计三级代理下方成交订单 未付款订单 总成交价格
        foreach($agents as $key=>$val){
            //未付款订单
            $order_check = $order_mdl->where(array('agent_aid'=>$val['agent_aid'],'status'=>0))->count();
            //已付款订单
            $order_pay_check = $order_mdl->where(array('agent_aid'=>$val['agent_aid'],'status'=>1))->count();
            //总价
            $order_total_check = $order_mdl->where(array('agent_aid'=>$val['agent_aid'],'status'=>1))->select();
            $total = 0;
            foreach($order_total_check as $key1=>$val1){
                $total += $val1['order_total_price'];
                $agents[$key]['agent_ordertotal'] = $total;
            }
            $agents[$key]['agent_nums'] = $val1['order_num'];
            $agents[$key]['agent_orders_nopay'] = $order_check;
            $agents[$key]['agent_orders_pay'] = $order_pay_check;
        }

        //查询二级代理
        $agent_first = $agent_mdl->where(array('agent_level'=>2))->select();
        $this->assign('cat_aid',$agent_first);
        $this->assign('agents',$agents);
        $this->show();
    }


    public function select(){
        $filter['agent_aid'] = $_POST['keyword'];
        $agent_mdl = M('agents');
        $_GET['p'] = isset($_GET['p'])? $_GET['p'] : '1';
        $agents = $agent_mdl->page($_GET['p'],8)->where($filter)->select();
        $count = $agent_mdl->where($filter)->count();
        $Page = new\Think\Page($count,8);
        $Page->lastSuffix=false;
//        $Page->setConfig('header','<li class="rows">共<b>%TOTAL_ROW%</b>条记录&nbsp;&nbsp;每页<b>4</b>条&nbsp;&nbsp;第<b>%NOW_PAGE%</b>页/共<b>%TOTAL_PAGE%</b>页</li>');
        $Page->setConfig('prev','上一页');
        $Page->setConfig('next','下一页');
        $Page->setConfig('last','末页');
        $Page->setConfig('first','首页');
        $Page->setConfig('theme','%FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END% %HEADER%');
        $show = $Page->show();
        $this->assign('keyword',$_POST['keyword']);
        $this->assign('page',$show);
        $this->assign('count',$count);
        $this->assign('agents',$agents);
        $this->display('Agent/index');
    }

    public function addagent(){
        $this->show();
    }

    public function doadd(){
        $user_mdl = M('users');
        $agent_mdl = M('agents');
        $info =array(
          'agent_aid' =>$_POST['agent_aid'],
          'agent_name' =>$_POST['agent_name'],
          'agent_level' =>$_POST['agent_level'],
          'agent_ciny' =>$_POST['agent_ciny'],
          'pid' =>$_POST['pid'],
        );
//        echo '<pre>';print_r($info);exit;
        //判断当前代理商编号是否已经注册
        $agent_check = $agent_mdl->where(array('agent_aid'=>$_POST['agent_aid']))->select();
//        echo '<pre>';print_r($agent_check);exit;
        $time = date('Y-m-d H:i:s',time());
        $user = array(
            'name' => $_POST['agent_name'],
            'password' => md5($_POST['pwd']),
            'regtime' => $time,
            'level' => 2,
            'agent' => $_POST['agent_aid'],
        );
        //判断代理商是否已经注册用户
        $user_check = $user_mdl->where(array('name'=>$_POST['agent_name']))->select();


        if(empty($agent_check)){
            if(empty($user_check)){
                $agents = $agent_mdl->add($info);
                $users = $user_mdl->add($user);
                if($agents && $users){
                    $this->success('添加成功，请去查看',U('index'), 2);
                }else{
                    $this->error('添加失败，请重新添加',U('addagent'), 2);
                }
            }else{
                $this->error('添加失败,该代理商已被注册，请换个名字',U('addagent'), 2);
            }
        }else{
            $this->error('添加失败,该代理商编号已被占用',U('addagent'), 2);
        }
    }
//删除代理商
    public function del($id){
        $agent_mdl = M('agents');
        $user_mdl = M('users');
        $agents = $agent_mdl->where(array('id'=>$id))->find();
        $user_name = $agents['agent_name'];
        $users = $user_mdl->where(array('name'=>$user_name))->delete();
        $agents_del = $agent_mdl->where(array('id'=>$id))->delete();
        if($agents_del && $users){
            $this->success('删除成功',U('index'),1);
        }else{
            $this->error('删除失败',U('index'),1);
        }
    }

    public function update($id){
        $agent_mdl = M('agents');
        $agents = $agent_mdl->where(array('id'=>$id))->find();
        $this->assign('agents',$agents);
       $this->show();
    }

    public function doupdate($id){
        $agent_mdl = M('agents');
        $info = array(
          'agent_ciny'=>$_POST['agent_ciny'],
        );
        $agents = $agent_mdl->where(array('id'=>$id))->save($info);
        if($agents == 1){
            $this->success('修改成功',U('index'),1);
        }else{
            $this->error('修改失败',U('index'),1);
        }
    }


    //代理商审核
    public function examine(){
        $agent_mdl = M('agents');
        $agents = $agent_mdl->where(array('examine'=>1))->select();
        $this->assign('agents',$agents);
        $this->show();
    }


    //操作审核
    public function doexamine($id){
        $agent_mdl = M('agents');
        $agents = $agent_mdl->where(array('id'=>$id))->find();
        $this->assign('agents',$agents);
        $this->show();
    }


    public function doexa($id){
        $agent_mdl = M('agents');
        if($_POST){
            //修改权限
            $examine = array(
              'examine'=>$_POST['examine'],
            );

            $agent_update = $agent_mdl->where(array('id'=>$id))->save($examine);
            if($agent_update == 1){
                $this->success('修改成功',U('examine'),1);
            }else{
                $this->error('修改失败',U('doexamine',array('id'=>$id)),1);
            }
        }
    }

}