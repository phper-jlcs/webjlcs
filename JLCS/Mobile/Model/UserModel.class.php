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
        $this->User_info = M('user_infos');
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
            $id = $this->User->where(array('user_id'=>$user_find['id']))->save(array('is_dis'=>1));
            if($id){
                return true;
            }else{
                return false;
            }
        }
        return false;
    }

    public function check_dis($user_id){
        $fiter =array('user_id'=>$user_id);
        $user_find = $this->Dis_User->where($fiter)->find();
        if(!$user_find){
            return false;
        }
        return $user_find;
    }


    public function check_token($token){
        $fiter =array('token'=>$token);
        $user_select = $this->Dis_User->where($fiter)->find();
        if(!$user_select){
            return false;
        }
        return $user_select;
    }

    public function register_user($uer_info){
        //当前账号及手机号并未重名及注册
        $filter['phone'] = $uer_info['phone'];
        $check['name'] = $uer_info['name'];
        $name = $this->User->where($check)->find();
        $phone = $this->User->where($filter)->field('id','name','password','regtime')->find();
        if(isset($name)){
            return 'name repeat';
        }
        if(isset($phone)){
            return 'phone repeat';
        }
        if($id = $this->User->add($uer_info)){
            //创建userinfo表
            $user_infoData = array(
                'user_id'=>$id,
                'relname'=>'',
                'phone'=>$uer_info['phone'],
            );
            $user_infos = $this->User_info->add($user_infoData);
            if($user_infos){
                session('name', $uer_info['name']);   // 当前用户名
                return 'success';
            }else{
                return 'success -1';
            }
        }else{
            return false;
        }
    }

    public function check_user($user_id){
        $filter = array('user_id'=>$user_id);
        $user = $this->Dis_User->where($filter)->find();
        if($user){
            return $user;
        }
        return false;
    }

    public function get_user_list($user_id){
        $sql=" SELECT count(*) as count FROM dis_user as a LEFT JOIN users as b ON a.id = b.dis_user_id WHERE a.user_id = '{$user_id}'";
        $user = $this->db()->query($sql);
        $count = $user['count'];
        return $count;
    }




}