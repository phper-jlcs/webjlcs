<?php
/**
 * Created by PhpStorm.
 * User: CS18070401
 * Date: 2018/11/15
 * Time: 22:58
 */

namespace Mobile\Model;


use Think\Model;

class OrderModel extends Model
{
    protected $tableName = 'dis_orders';
    public $User;
    public $errinfo = array();
    public function __construct()
    {
        $this->Dis_User = M('dis_user');
        $this->User = M('users');
        $this->User_info = M('user_infos');
        $this->Order = M('orders');
    }


    public function get_order_list($dis_user_id)
    {
        //数量统计
        $count = $this->count_list($dis_user_id);
        //列表统计
        //未付款订单
        $sql = " SELECT *  FROM orders as a WHERE a.is_dis = 1 and a.dis_user_id = '{$dis_user_id}' and a.status = 0 ";
        $order_list_0 = $this->db()->query($sql);
        //已付款订单
        $sql = " SELECT *  FROM orders as a WHERE a.is_dis = 1 and a.dis_user_id = '{$dis_user_id}' and a.status = 1 ";
        $order_list_1 = $this->db()->query($sql);
        $data = array(
            'order_list_0' =>   $order_list_0,
            'order_list_1' =>   $order_list_1,
            'count_no_pay' => $count['no_pay'],
            'count_pay' => $count['pay']
        );
        return $data;
    }

    public function count_list($dis_user_id){
        //未付款
        $sql = " SELECT count(*) as count FROM orders as a WHERE a.is_dis = 1 and a.dis_user_id = '{$dis_user_id}' and a.status = 0 ";
        $count_0 = $this->db()->query($sql);
        //已付款
        $sql = " SELECT count(*) as count FROM orders as a WHERE a.is_dis = 1 and a.dis_user_id = '{$dis_user_id}' and a.status = 1 ";
        $count_1 = $this->db()->query($sql);
        $total['no_pay'] = $count_0[0]['count'];
        $total['pay'] = $count_1[0]['count'];
    }

    public function get_finace($dis_user_id,$pid)
    {
        $sql = " SELECT sum(a.order_money) as total_money FROM dis_orders as a WHERE a.order_status = 1 and {$pid} = '{$dis_user_id}'";
        $result = $this->db()->query($sql);
        return $result[0]['total_money'];
    }




}