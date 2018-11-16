<?php
namespace Mobile\Controller;
use Think\Controller;

class ApiController extends Controller {

    public function __construct()
    {
        setAccess();
    }

    /**
     * 注册分销商接口
     */
    public function reg_dis_user(){
        $phone = I('post.phone');
        $user_id = I('post.user_id');
        check_is_null($phone,'手机号不能为空');
        check_is_null($user_id,'用户id不能为空');
        $User = new \Mobile\Model\UserModel();
        //检测是否已经是分销商
        $is_dis = $User->check_dis($user_id);
        if($is_dis){
            send_error_response('您已经是分销商了！无需再次注册！');
        }
        $user_reg = $User->reg_dis_user($phone,$user_id);
        if(!$user_reg){
            send_error_response('注册失败！');
        }
        send_ok_response($user_reg);
    }


}