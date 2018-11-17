<?php
namespace Mobile\Controller;
use Think\Controller;

class ApiController extends Controller {

//    const HOST_SHARE_URL = 'http://www.zztns.com/Mobile/Dis/share';
    const HOST_SHARE_URL = 'localhost/webjlcs/Mobile/Dis/share';
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
            send_error_response('您已经是分销商了！');
        }
        $user_reg = $User->reg_dis_user($phone,$user_id);
        if(!$user_reg){
            send_error_response('注册失败！');
        }
        send_ok_response($user_reg);
    }

    /**
     * 生成推广码
     */
    public function create_code()
    {
        $id = I('post.id');  //分销商id
        $id = 1;
        check_is_null($id,'分销商id不能为空');
        $User = D('User');
        $is_dis = $User->check_dis($id);
        if(!$is_dis){
            send_error_response('您还不是分销商！');
        }
        $token = $is_dis['token'];
        $share_url = self::HOST_SHARE_URL.'?token='.$token;
        $img_qrcode = qrcode($share_url);
        send_ok_response($img_qrcode);
    }


    /**
     * 新会员注册 建立关系
     *
     */
    public function make_connection()
    {

    }

    /**
     * 分销中心
     */
    public function dis_index()
    {

    }

    /**
     * 升级校验规则
     */
    public function get_sign_level()
    {

    }

}