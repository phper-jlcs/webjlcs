<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/3/16
 * Time: 14:44
 */
namespace Admin\Controller;
use Think\Controller;

class UsercartController extends Controller {

    public function index(){
        $usercart_mdl = M('user_cartids');
        $_GET['p'] = isset($_GET['p'])? $_GET['p'] : '1';
        $usercartids = $usercart_mdl->page($_GET['p'],8)->select();
        $count = $usercart_mdl->count();
        $show = pagefenye($count);
        $this->assign('page',$show);
        $this->assign('count',$count);
        $this->assign('usercartids',$usercartids);
        $this->show();
    }

    public function look($id){
        $usercart_mdl = M('user_cartids');
        $user_mdl = M('users');
        $own_mdl = M('owns');
        $user_cartids = $usercart_mdl->where(array('id'=>$id))->find();
        $users = $user_mdl->where(array('user_cartid'=>$user_cartids['user_cartid']))->find();
        $owns = $own_mdl->where(array('user_id'=>$users['id']))->select();
        if($owns){
            foreach($owns as $key=>$val){
                //根据id生成供奉权证号
                $warrant = warrant_select($val['product_id']);
                $position = position_select($val['product_id']);
                $warrantall[] = $warrant;
                $positionall[] = $position['strname'];
            }
            $info = array(
                'user_cartid' => $users['user_cartid'],
                'name'=>  $users['name'],
                'phone' => $users['phone'],
                'warrant_number' =>$warrantall,
                'position' => $positionall,
            );
        }
        $this->assign('info',$info);
        $this->show();
    }
}


?>