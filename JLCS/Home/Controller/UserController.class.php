<?php
namespace Home\Controller;
use Think\Controller;
class UserController extends Controller {
    public function index(){
        $this->show();
    }

    public function login(){
        if(isset($_GET['url'])){
            $url = $_GET['url'];
            $url1=str_replace('/index.php','',$url);
            $this->assign('url',$url1);
            $this->show();
        }elseif(isset($_GET['sign'])){
            $sign = $_GET['sign'];
            $this->assign('sign',$sign);
            $this->show();
        }else{
            if($_SESSION['zhuan'] == 1){
                $this->assign('zhuan',$_SESSION['zhuan']);
            }
            $this->show();
        }
    }

    public function  dologin(){
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
                //各类页面传递的参数，若包含直接回调当页面。
                if($_POST['url']){
                    $url=str_replace("/webjlcs/","",$_POST['url']);
                    //$this->redirect($url);    //这种写法有问题，会跳转到该模块下的该$url，可能会出现.html.html的情况
                    redirect(__ROOT__."/".$url);
                }elseif($_POST['zhuan']){
                    $this->redirect('Transfer/add');
                }elseif($_POST['sign']){
                    $this->redirect('User/info');
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

    public function dologot(){
        session(null);
        redirect(U('User/login'), 2, '正在退出登录...');
    }

    public function register(){
        $this->show();
    }

    public  function  doregister(){
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
                                       $this->error('注册失败,用户名重名!',U('register'),1);
                                   }
                                if(isset($phone)){
                                    $this->error('注册失败,手机号已被注册，请换个号码!',U('register'),1);
                                }
                                   $user['name'] = $_POST['username'];
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
                                           session('name', $_POST['username']);   // 当前用户名
                                           //判断当前session中是否存在register=1
                                           if($_SESSION['register'] == 1){
                                               $this->redirect('Product/details',array('id'=>$_SESSION['product_id']));
                                           }else{
                                               $this->success('注册成功', U('Index/index'), 2);
                                           }
                                       }else{
                                           $this->success('注册成功,个人信息完善失败!请去个人中心完善!', U('User/index'), 2);
                                       }
                                   }else{
                                       $this->error('注册失败,系统异常',U('register'),1);
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

    public function info(){
        if(!$_SESSION['name']){
           $this->success('您还没登录，请登录后再进入个人中心',U('login',array('sign'=>'allowlogin')),1);
        }else{
            $user_mdl = M('users');
            $order_mdl = M('orders');
            $own_mdl = M('owns');
            $user_info_mdl = M('user_infos');
            $users = $user_mdl->where(array('name'=>$_SESSION['name']))->find();
            $user_infos = $user_info_mdl->where(array('user_id'=>$_SESSION['id']))->find();
//            echo '<pre>';print_r($user_infos);exit;
            //认捐的位置
            $owns = $own_mdl->where(array('user_id'=>$_SESSION['id']))->select();
            foreach($owns as $key=>$val){
                $product_id = $val['product_id'];
                $position = position_select($product_id);
                $owns[$key]['position'] = $position['strname'];
                $warrant_number = warrant_select($product_id);
                $owns[$key]['warrant_number'] = $warrant_number;
            }
            $filter['user_id'] = $users['id'];
            $orders = $order_mdl->where($filter)->select();
            $this->assign('owns',$owns);
            $this->assign('users',$users);
            $this->assign('user_infos',$user_infos);
            $this->assign('orders',$orders);
            $this->show();
        }

    }

    public function edit_info(){
        $user_mdl = M('users');
        $user_mdl->startTrans();
        $user_info_mdl = M('user_infos');
        $users = $user_mdl->where(array('id'=>$_POST['id']))->find();
        $address = $_POST['s_province'].$_POST['s_city'].$_POST['s_county'].$_POST['address'];
        if(empty($_POST['password'])){  //要更改密码
            $password = $users['password'];
            $userData = array(
                'name'=> $_POST['name'],
                'password'=> $password,
                'phone'=> $_POST['phone'],
            );
            $userinfoData = array(
                'agent_aid'=> $_POST['agent'],
                'cid'=>$_POST['cid'],
                'address'=>$address,
                'phone'=>$_POST['phone'],
            );
        }else{  //不需要更改密码
            $userData = array(
                'name'=> $_POST['name'],
                'password'=> md5($_POST['password']),
                'phone'=> $_POST['phone'],
            );
            $userinfoData = array(
                'agent_aid'=> $_POST['agent'],
                'cid'=>$_POST['cid'],
                'address'=>$address,
                'phone'=>$_POST['phone'],
            );
        }

        //更新users表和userinfos表
        $user_insert = $user_mdl->where(array('id'=>$_POST['id']))->save($userData);
        //修复bug 若不存在则插入，存在修改
        $user_info_sele = $user_info_mdl->where(array('user_id'=>$_POST['id']))->find();
        //已存在
        if($user_info_sele){
            //修改
            $user_info_insert = $user_info_mdl->where(array('id'=>$user_info_sele['id']))->save($userinfoData);
        }else{
            $userinfoData['user_id'] = $_SESSION['id'];
            $user_info_insert = $user_info_mdl->add($userinfoData);
        }
        if($user_insert == 1 || $user_info_insert == 1){
            $user_mdl->commit();
            session_destroy();
            $this->success('修改成功,请重新登录您的新账号吧',U('User/login'),1);
        }else{
            $user_mdl->rollback();
            $this->error('修改失败',U('User/info'),1);
        }
    }

    //激活会员卡-----CJL-7000001
    public function activation(){
        $this->show();
    }
    //执行激活----->逻辑处理
    //  执行效果:
    //1:注册会员----- users
    //2：录入个人信息---- user_infos
    //3:根据供奉权证号，获取当前认捐位置  位置锁定（生成线下订单）
    public function doactivation(){
        //1.核对会员卡号是否正确(会员卡数据表)
        $user_cartid_mdl = M('user_cartids');
        $user_cartid_mdl->startTrans();
        $user_mdl = M('users');
        $user_mdl->startTrans();
        $user_info_mdl = M('user_infos');
        $user_info_mdl->startTrans();
        $product_mdl = M('products');
        $order_mdl = M('orders');
        $order_detail_mdl = M('order_details');
        $own_mdl = M('owns');
        $user_carts = $user_cartid_mdl->where(array('user_cartid'=>$_POST['user_cartid']))->find();
            //若会员卡存在数据表，则允许激活
            if($user_carts){
                //若不存在，则开始进行激活-------更新为一卡多单，一个会员卡可进行多次激活

                        //开始执行激活
                        $userData = array(
                            'name'=>$_POST['user_cartid'],
                            'password'=>md5($_POST['password']),
                            'regtime'=>date('Y-m-d H:i:s',time()),
                            'level'=>2,
                            'phone'=>$_POST['phone'],
                            'attr'=>1,
                            'user_cartid'=>$_POST['user_cartid'],
                        );
                    //判断当前手机号是否已经被注册过
                    $users_select = $user_mdl->field('phone')->select();
                    foreach($users_select as $key=>$val){
                        $info[] = $val['phone'];
                    }
                    if(in_array($_POST['phone'], $info)){
                        $this->error('当前手机号已被注册!',U('activation'),1);
                    }
                //判断当前会员卡是否已经激活完毕
                $users_select = $user_mdl->where(array('user_cartid'=>$_POST['user_cartid']))->find();
                //未注册过会员卡
                if(!$users_select){
                    $user_add = $user_mdl->add($userData);
                    $users = $user_mdl->where(array('id'=>$user_add))->find();
                    $user_cartid_mdl->where(array('user_cartid'=>$users['user_cartid']))->save(array('state'=>1));
                }else{
                    //已经注册过会员卡
                    $users = $users_select;
                }
                    //如果插入成功，则开始激活
                    if($users){
                        //生成订单个人信息 userinfos
                        $user_infoData = array(
                            'user_id'=>$users['id'],
                            'agent_aid'=>$_POST['agent'],
                            'relname'=>$_POST['relname'],
                            'phone'=>$_POST['phone'],
                        );
                        //判断当前用户是否已经添加过个人信息  一个用户可以拥有多条（不可重复）
                        $user_info_select = $user_info_mdl->where(array('user_id'=>$users['id']))->find();
                        //不存在
                        if(!$user_info_select){
                            $user_info_add = $user_info_mdl->add($user_infoData);
                            $user_infos = $user_info_mdl->where(array('id'=>$user_info_add))->find();
                        }else{
                            //存在 判断是否全部一致
                            if($user_info_select['relname'] == $_POST['relname'] && $user_info_select['phone'] == $_POST['phone']){
                                $user_infos = $user_info_select;
                            }else{
                                $user_info_add = $user_info_mdl->add($user_infoData);
                                $user_infos = $user_info_mdl->where(array('id'=>$user_info_add))->find();
                            }
                        }
                        //

                        //如果插入成功
                        if($user_infos['id']){
                            //根据供奉权证号，识别莲位 位置
                            $warrant = $_POST['gongfeng'];
                            $product_id = warrant_fanxiang($warrant);
                            //判断是否可以购买
                            if($product_id){
                                $user_mdl->commit();
                                $products = $product_mdl->where(array('id'=>$product_id))->find();
                            }else{
                                $user_mdl->rollback();
                                $this->error('供奉权证号有误!',U('activation'),1);
                            }
                            //存在
                            if($products){
                                //未售状态
                                if($products['product_store'] == 1){
                                    //生成订单
                                    $order_id = rand(1,1000)+time();   //订单号
                                    $agreement_id = 12345678;        //协议书号
                                    $order_num = 1;
                                    $order_total_price = $products['now_price']*$order_num;
                                    $user_id = $users['id'];
                                    $status = 1;
                                    $createtime = date('Y-m-d H:i:s',time());
                                    $agent_aid = $_POST['agent'];
                                    $user_info_id = $user_infos['id'];
                                    $attr = 2;

                                    //创建数组
                                    $orderData = array(
                                        'order_id'=>$order_id,
                                        'agreement_id'=>$agreement_id,
                                        'order_num'=>$order_num,
                                        'order_total_price'=>$order_total_price,
                                        'user_id'=>$user_id,
                                        'status'=>$status,
                                        'createtime'=>$createtime,
                                        'agent_aid'=>$agent_aid,
                                        'user_info_id'=>$user_info_id,
                                        'attr'=>$attr,
                                    );
                                    //创建订单
                                    $orders = $order_mdl->add($orderData);
                                    if($orders){
                                            //生成详情单
                                         $order_detailData = array(
                                            'orderid' => $orders,
                                            'product_id' => $product_id,
                                            'num' => $order_num,
                                            'price' => $products['now_price'],
                                            'user_id' => $user_id,
                                            'description'=>$warrant,
                                        );
                                        $id = $order_detail_mdl->add($order_detailData);
                                        if(!$id){
                                            $this->error('会员激活成功，供奉权证激活失败，请联系工作人员',U('activation'),1);
                                        }else{
                                            //修改库存  生成owns表
                                            $data = array(
                                                'product_store'=>0,
                                            );
                                            $product_save = $product_mdl->where(array('id'=>$product_id))->save($data);

                                            //库存修改成功
                                            if($product_save == 1){
                                                //增加归属表 owns
                                                $ownData = array(
                                                        'product_id'=>$product_id,
                                                        'user_id'=>$user_id,
                                                );
                                                $own_add = $own_mdl->add($ownData);
                                                //全部流程完毕

                                                if($own_add){
                                                    session('id', $users['id']);          // 当前用户id
                                                    session('name', $users['name']);   // 当前用户名
                                                    $this->success('恭喜您已完成会员卡激活，并激活莲花位成功!',U('User/info'));
                                                }else{
                                                    $this->error('会员激活成功，莲花位激活成功，可能出现一些小故障，请与工作人员联系!',U('activation'),1);
                                                }
                                            }
                                        }
                                    }else{
                                        $this->error('会员激活成功，供奉权证激活失败，请联系工作人员',U('activation'),1);
                                    }
                                }else{
                                    $this->error('很抱歉，当前供奉权证已被注册，请核对!',U('activation'),1);
                                }
                            }
                        }else{
                            $this->error('激活成功，信息添加失败',U('activation'),1);
                        }
                    }else{
                        $this->error('会员激活失败',U('activation'),1);
                    }

                }else{
                    $this->error('当前会员卡已激活完毕，请勿重复操作',U('activation'),1);
                }

    }


    public function checkwarrant(){
       $warrant = $_POST['id'];
        $product_id = warrant_fanxiang($warrant);
        if($product_id){
            echo 1;
        }else{
            echo 0;
        }
    }


    public function adduserinfo(){
        
    }


    public function obtaincode_ajax(){
        $phone = $_POST['phone'];
        $doobtain = obtain($phone);
        if($doobtain){
            echo json_encode($doobtain);
        }
    }

}