<?php
namespace Admin\Controller;
use Think\Controller;
class DisController extends Controller {
    public function index(){
        $dis_mdl = M('dis_user');
        $order_mdl = M('dis_orders');
        $_GET['p'] = isset($_GET['p'])? $_GET['p'] : '1';
        $dis_user = $dis_mdl->page($_GET['p'],7)->where('level=1')->select();
        $count = $dis_mdl->where('level=1')->count();
        $Page = new\Think\Page($count,7);
        $Page->lastSuffix=false;
        $Page->setConfig('prev','上一页');
        $Page->setConfig('next','下一页');
        $Page->setConfig('last','末页');
        $Page->setConfig('first','首页');
        $Page->setConfig('theme','%FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END% %HEADER%');
        $show = $Page->show();
        $this->assign('page',$show);
        $this->assign('count',$count);
        $total = 0;
        foreach($dis_user as $key=>$val){
            $filter['pid'] = $val['user_id'];
            $agent_check = $dis_mdl->where($filter)->count();
            $like['user_id'] = array('like',$val['user_id'].'%');
            $like['order_status'] = 0;
            $order_check = $order_mdl->where($like)->count();
            $pay_like['user_id'] = array('like',$val['user_id'].'%');
            $pay_like['order_status'] = 1;
            $order_pay_check = $order_mdl->where($pay_like)->count();
            $order_total_check = $order_mdl->where($pay_like)->select();
            foreach($order_total_check as $key1=>$val1){
               $total += $val1['order_total_price'];
                $dis_user[$key]['agent_ordertotal'] = $total;
            }
            $dis_user[$key]['agent_nums'] = $agent_check;
            $dis_user[$key]['agent_dis_orders_nopay'] = $order_check;
            $dis_user[$key]['agent_dis_orders_pay'] = $order_pay_check;

        }
        $this->assign('dis_user',$dis_user);
        $this->show();
    }


    public function select(){
        $filter['user_id'] = $_POST['keyword'];
        $dis_mdl = M('dis_user');
        $_GET['p'] = isset($_GET['p'])? $_GET['p'] : '1';
        $dis_user = $dis_mdl->page($_GET['p'],8)->where($filter)->select();
        $count = $dis_mdl->where($filter)->count();
        $Page = new\Think\Page($count,8);
        $Page->lastSuffix=false;
        $Page->setConfig('prev','上一页');
        $Page->setConfig('next','下一页');
        $Page->setConfig('last','末页');
        $Page->setConfig('first','首页');
        $Page->setConfig('theme','%FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END% %HEADER%');
        $show = $Page->show();
        $this->assign('keyword',$_POST['keyword']);
        $this->assign('page',$show);
        $this->assign('count',$count);
        $this->assign('dis_user',$dis_user);
        $this->display('Dis/index');
    }

    public function disorder($id=null){
    $order_mdl = M('dis_orders');
        $order_detail_mdl = M('order_details');
        $user_mdl = M('dis_user');
        $_GET['p'] = isset($_GET['p']) ? $_GET['p'] : '1';
        $filter['order_status'] = array('neq',5);
        $dis_orders = $order_mdl->page($_GET['p'],8)->where($filter)->select();
        foreach($dis_orders as $key=>$val){
            $order_details = $order_detail_mdl->where(array('uid'=>$val['id'],'order_status'=>array('neq',5)))->select();
            foreach($order_details as $k=>$v){
                $dis_orders[$key]['warrants'][] = $v['description'];
            }
            $dis_user = $user_mdl->where(array('id'=>$val['user_id']))->find();
            $dis_orders[$key]['name'] = $dis_user['name'];
            $dis_orders[$key]['user_id'] = $dis_user['user_id'];
            //计算倒计时
            $type = $val['management_expense'];
            if($type == ''){
                $type = 1;
            }
            $time = $val['createtime'];
            $dis_orders[$key]['count_down'] = $this->chkcontime($type,$time);
        }
        $count = $order_mdl->count();
        $show = pagefenye($count);
        $this->assign('page',$show);
        $this->assign('count',$count);
        $this->assign('dis_orders',$dis_orders);
        $this->display();
    }

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

 }
