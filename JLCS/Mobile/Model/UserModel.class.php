<?php
/**
 * Created by PhpStorm.
 * User: CS18070401
 * Date: 2018/11/15
 * Time: 22:58
 */

namespace Mobile\Model;


use Think\Model;

class UserModel extends Model
{
    protected $tableName = 'dis_user';
    public $User;
    public $errinfo = array();
    public function __construct()
    {
        $this->Dis_User = M('dis_user');
        $this->User = M('users');
    }

    /**
     * @param $data 分销商信息
     */
    public function reg_dis_user($phone,$user_id){
        $fiter =array('id'=>$user_id);
        $user_find = $this->User->where($fiter)->find();
        $msg = 'Nouser';
        if(!$user_id){
            return $msg;
        }
        $data = array(
          'user_id'=>$user_find['id'],
          'user_name'=>$user_find['name'],
          'phone'=>$phone,
          'level'=>3,
          'token'=>str_rand(),
        );
        $user_add = $this->Dis_User->add($data);
        if($user_add){
            return true;
        }
        return false;
    }

    public function check_dis($user_id){
        $fiter =array('user_id'=>$user_id);
        $user_find = $this->Dis_User->where($fiter)->find();
        if(!$user_find){
            return false;
        }
        return true;
    }
}