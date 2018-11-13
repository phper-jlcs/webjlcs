<?php
namespace Adminagent\Controller;
use Think\Controller;
class AgentuserController extends Controller {
    public function index(){
       if($_SESSION){
           $agent_mdl = M('agents');
           $order_mdl = M('orders');
           $_GET['p'] = isset($_GET['p'])? $_GET['p'] : '1';
           $agents = $agent_mdl->where(array('agent_name'=>$_SESSION['name']))->find();//一级代理的相关信息
           if($agents['agent_level'] == 3){
               $this->show();
           }else{
               if($agents){
                  if(I('post.id')){
                    $age_check['id'] = intval(I('post.id'));
                  }
                   $age_check['pid'] = array('like',$agents['agent_aid'].'%');
                   $agents = $agent_mdl->page($_GET['p'],8)->order('agent_aid asc')->where($age_check)->select();
                   $count = $agent_mdl->where($age_check)->count();
                   $Page = new\Think\Page($count,8);
                   $Page->lastSuffix=false;
                   $Page->setConfig('prev','上一页');
                   $Page->setConfig('next','下一页');
                   $Page->setConfig('last','末页');
                   $Page->setConfig('first','首页');
                   $Page->setConfig('theme','%FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END% %HEADER%');
                   $show = $Page->show();
                   $this->assign('page',$show);
                   $this->assign('count',$count);
                   //统计一级代理下面有多少个二级代理商 未付款订单 成交订单 总成交价
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
                       if(!empty($order_total_check)){
                            foreach($order_total_check as $key1=>$val1){
                              $total = 0;
                              $total += $val1['order_total_price'];
                              $agents[$key]['agent_ordertotal'] = $total;
                            }
                       }else{
                           $total = 0;
                           $agents[$key]['agent_ordertotal'] = $total;
                       }
                       $agents[$key]['agent_nums'] = $agent_check;
                       $agents[$key]['agent_orders_nopay'] = $order_check;
                       $agents[$key]['agent_orders_pay'] = $order_pay_check;

                   }
                   $this->assign('agents',$agents);
                   $this->assign('keyword',$age_check['id']);//ID搜素，把post过来的id传回页面
                   $this->show();
               }else{
                   $this->show();
               }
           }


       }
    }


    public function add(){
        $agent_mdl = M('agents');
        $agents = $agent_mdl->where(array('agent_name'=>$_SESSION['name']))->find();
        $this->assign('agents',$agents);
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
            'examine'=>1,
        );


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
                    $this->error('添加失败，请重新添加',U('add'), 2);
                }
            }else{
                $this->error('添加失败,该代理商名已被注册，请换个名字',U('add'), 2);
            }
        }else{
            $this->error('添加失败,该代理商编号已被占用',U('add'), 2);
        }
    }


    public function own(){
        if($_SESSION){
            $agent_mdl = M('agents');
            $user_mdl  = M('users');
            $order_mdl = M('orders');
            if(I('post.id')){
              $agents = $agent_mdl->where(array('id'=>I('post.id')))->find(); 
            }else{
              $agents = $agent_mdl->where(array('agent_name'=>$_SESSION['name']))->find(); 
            }
            $infoHref  = U('orderinfo',array('id'=>$agents['id'])); //查看详情的链接地址
           if($agents){
               $orders = $order_mdl->where(array('agent_aid'=>$agents['agent_aid']))->select();
//               echo '<pre>';print_r($orders);exit;
               if(!empty($orders)){
                   //统计未付款订单数
                   $order_check = $order_mdl->where(array('agent_aid'=>$agents['agent_aid'],'status'=>'0'))->count();
                  //付款订单数
                   $order_pay_check = $order_mdl->where(array('agent_aid'=>$agents['agent_aid'],'status'=>'1'))->count();
                   //总成交价
                   $order_pay_checks = $order_mdl->where(array('agent_aid'=>$agents['agent_aid'],'status'=>'1'))->select();
                   $total = 0;
                   foreach($order_pay_checks as $key=>$val){
                       $total += $val['order_total_price'];
                   }
//                   echo '<pre>';print_r($total);exit;
                   $agents['order_pay_nums'] = $order_pay_check;
                   $agents['order_nums'] = $order_check;
                   $this->assign('total',$total);
                   $this->assign('agents',$agents);
                   $this->assign('infoHref',$infoHref);
                   $this->assign('keyword',I('post.id'));
                   $this->display('Agentuser/own');
               }else{
                   $total = 0;
                   $agents['order_pay_nums'] = 0;
                   $agents['order_nums'] = 0;
                   $this->assign('total',$total);
                   $this->assign('agents',$agents);
                   $this->assign('infoHref',$infoHref);
                   $this->assign('keyword',I('post.id'));
                   $this->display('Agentuser/own');
               }
           }else{
               $this->assign('agents',$agents);
               $this->assign('infoHref',$infoHref);
               $this->assign('keyword',I('post.id'));
               $this->display('Agentuser/own');
           }
        }
    }


    public function update($id){
        $agent_mdl = M('agents');
        $agents = $agent_mdl->where(array('id'=>$id))->find();
        $this->assign('agents',$agents);
        $this->show();
    }

    public function doupdate(){
        $agent_mdl = M('agents');
        $info = array(
            'agent_ciny'=>$_POST['agent_ciny'],
        );
        $agents = $agent_mdl->where(array('id'=>$_POST['id']))->save($info);
        if($agents == 1){
            $this->success('修改成功',U('index'),1);
        }else{
            $this->error('修改失败',U('index'),1);
        }
    }

    public function orderInfo(){  //查看销售记录(查看详情)
      // echo "查看详情ing";echo I('get.id');exit;
      $agentId   = I('get.id');
      $agent_aid = M('agents')->where(array('id'=>$agentId))->getField('agent_aid'); //获取agent_aid
      $orders = M('orders')->where(array('agent_aid'=>$agent_aid))->field('order_id,user_number,phone,createtime,order_total_price,status')->select();
      $total = 0;
      foreach ($orders as $key => $value) {
        if($value['status'] == 1){
          $total += $value['order_total_price'];
        }
      }
      $this->assign('orders',$orders);
      $this->assign('total',$total);
      $this->display();
    }

}