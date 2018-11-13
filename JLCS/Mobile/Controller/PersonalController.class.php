<?php
namespace Mobile\Controller;
use Think\Controller;
class PersonalController extends Controller{


    public function index(){
        if($_SESSION['id']){
            $this->display('Personal/geren');
        }else{
            session(null);
            session('login',array('islogin'=>'no'));
            $this->redirect('login',1);
        }
    }

    public function islogin(){
        if($_SESSION['name']){
            echo 'a';
        }else{
            //未登录
            echo 'b';
        }
    }


    function login(){
        //判断登录返回商品id
        if($_GET['id']){
            $this->assign('loginid',$_GET['id']);
            $this->show();
        }else{
            $this->show();
        }
    }


    public function dologin(){
            //判断提交方式
            if(IS_POST){
                //实例化Model users表
                $model = M('users');
                //查询条件
                $filter=array();
                $filter['name'] = $_POST['name'];
                $phone['phone'] = $_POST['name'];
                //判断客户当前使用何种方式登录
                $mode = is_numeric ($_POST['name']) ? true : false;
                //手机号
                if($mode){
                    $result = $model->where($phone)->find();
                }else{
                    $result = $model->where($filter)->find();
                }
                if($result && md5($_POST['password']) == $result['password']){
                    session('id', $result['id']);          // 当前用户id
                    session('name', $result['name']);   // 当前用户名
                    session('login',array('islogin'=>'yes'));
                    //各类页面传递的参数，若包含直接回调当页面。
                    if($_POST['productid']){
                        $this->redirect('Index/content_tre',array('id'=>$_POST['productid']));
                    }else if($_SESSION['login']['islogin'] == 'yes'){
                        $this->redirect('index');
                    }else{
                        $this->success('登录成功,正跳转至系统首页...', U('Index/index'));
                    }
                }else{
                    $this->error('登录失败,用户名或密码不正确!',U('login'),1);
                }
            }else{
                $this->display();
            }
    }


    public function regist(){
        $this->show();
    }

    public function doregist(){
        $user = array();
        if(IS_POST){
            //实例化user表
            $model = M('users');
            $user_info_mdl = M('user_infos');
            $code = $_POST["code"];
            //当前账号及手机号并未重名及注册
            $filter['phone'] = $_POST['phone'];
            $check['name'] = $_POST['username'];
            $name = $model->where($check)->find();
            $phone = $model->where($filter)->field('id','name','password','regtime')->find();
            if(isset($name)){
                $this->error('注册失败,用户名重名!',U('regist'),1);
            }
            if(isset($phone)){
                $this->error('注册失败,手机号已被注册，请换个号码!',U('regist'),1);
            }
            if($_POST['name'] == ''){
                $user['name'] = '居士';
            }else{
                $user['name'] = $_POST['name'];
            }
            $user['phone'] = $_POST['phone'];
            $user['password'] = md5($_POST['password']);
            $user['regtime'] = date("Y-m-d H:i:s",time());
            $user['level'] = 2;
            if($id = $model->add($user)){
                //创建userinfo表
                $user_infoData = array(
                    'user_id'=>$id,
                    'relname'=>$_POST['relname'],
                    'phone'=>$_POST['phone'],
                );
                $user_infos = $user_info_mdl->add($user_infoData);
                if($user_infos){
                    session('name', $user_infos['name']);   // 当前用户名
                    session('id', $user_infos['id']);
                        $this->success('注册成功', U('index'), 2);
                }else{
                    $this->success('注册成功,个人信息完善失败!请去个人中心完善!', U('index'), 2);
                }
            }else{
                $this->error('注册失败,系统异常',U('regist'),1);
            }
        }
    }

    public function verify(){
        $Verify = new \Think\Verify();
        $Verify->fontSize = 18;
        $Verify->length   = 4;
        $Verify->useNoise = false;
        $Verify->codeSet = '0123456789';
        $Verify->imageW = 130;
        $Verify->imageH = 50;
        $Verify->entry();
    }
//退出 清除Session
    public function clearsession(){
        session(null);
        if(!$_SESSION){
            echo '1';
        }else{
            echo '2';
        }
    }

    public function ajax_username(){
       if($_POST){
           $user_mdl = M('users');
           $users = $user_mdl->where(array('id'=>$_SESSION['id']))->save(array('name'=>$_POST['username']));
           if($users == 1){
               echo '1';
           }else{
               echo '0';
           }
       }
    }

    public function getopinion(){
        $opinion_mdl = M('opinions');
        if($_POST){
            $Data = array(
                'opinion'=>$_POST['opinion'],
                'email'=>$_POST['email'],
                'user_id'=>$_SESSION['id'],
        );
            $opinions = $opinion_mdl->add($Data);
            //
            if($opinions){
                $this->success('我们已收到您的反馈！',U('index'),1);
            }else{
                $this->error('提交失败，请重试！',U('getopinion'),1);
            }
        }

    }

    public function browse(){
       if($_SESSION['history']['product_id']){
           $product_mdl = M('products');
           $product_id = $_SESSION['history']['product_id'];
           //调取位置名
           $str = position_select($product_id);
           $products =$product_mdl->where(array('id'=>$product_id))->find();
           $products['str'] = 1;
            $this->assign('str',$str);
           $this->assign('products',$products);
           $this->show();
       }else{
           $this->show();
       }
    }

    //清除缓存
    public function clear(){

       if($_SESSION['history'] == ''){
           echo 0;
       }else{
           session('history',null);
           echo 1;
       }
    }

    public function personal(){
        $user_mdl = M('users');
        $users = $user_mdl->where(array('id'=>$_SESSION['id']))->find();
        $this->assign('users',$users);
        $this->show();
    }


}
