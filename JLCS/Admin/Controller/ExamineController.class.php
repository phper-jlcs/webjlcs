<?php
namespace Admin\Controller;
use Think\Controller;
class ExamineController extends Controller {
    public function index(){
        //实例化会员表
        $_GET['p'] = isset($_GET['p'])? $_GET['p'] : '1';
        $examine_mdl = M('examines');
        $user_mdl = M('users');
        $user = $examine_mdl->page($_GET['p'],7)->select();
        foreach($user as $key=>$val){
            $users = $user_mdl->where(array('id'=>$val['user_id']))->find();
            $user[$key]['username'] = $users['name'];
        }
        $count = $examine_mdl->count();
        $Page = new\Think\Page($count,7);
        $Page->lastSuffix=false;
//        $Page->setConfig('header','<li class="rows">共<b>%TOTAL_ROW%</b>条记录&nbsp;&nbsp;每页<b>4</b>条&nbsp;&nbsp;第<b>%NOW_PAGE%</b>页/共<b>%TOTAL_PAGE%</b>页</li>');
        $Page->setConfig('prev','上一页');
        $Page->setConfig('next','下一页');
        $Page->setConfig('last','末页');
        $Page->setConfig('first','首页');
        $Page->setConfig('theme','%FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END% %HEADER%');
        $show = $Page->show();
        $this->assign('page',$show);
        $this->assign('count',$count);
        $this->assign('user',$user);
        $this->display();
    }


    public function del($id){
        $examine_mdl = M('examines');
        $filter['id'] = $id;
        $user = $examine_mdl->where($filter)->delete();
        if($user == 1){
            $this->success('删除成功', U('index'), 2);
        }else{
            $this->error('删除失败', U('index'), 2);
        }
    }


    public function edit($id){
        $examine_mdl = M('examines');
        $filter['id'] = $id;
        $examines = $examine_mdl->where($filter)->find();
        $this->assign('info',$examines);
        $this->display();
    }

    public function doedit($id){
        $examine_mdl = M('examines');
        $transfer_mdl = M('transfers');
        if($_POST){
            //判断当前状态 =1为同意 转入转让列表
            if($_POST['agree'] == 1){
                $examines = $examine_mdl->where(array('id'=>$id))->find();
                $info = array(
                    'name'=>$examines['name'],
                    'product_id'=>$examines['product_id'],
                    'user_id'=>$examines['user_id'],
                    'relname'=>$_POST['relname'],
                    'phone'=>$_POST['phone'],
                    'address'=>$_POST['address'],
                    'descr'=>$examines['descr'],
                    'time'=>$examines['time'],
                    'price'=>$examines['price'],
                );
                //判断重复么。
                    $transferscheck =$transfer_mdl->where(array('product_id'=>$examines['product_id']))->find();
                    if($transferscheck){
                        $examine_mdl->where(array('id'=>$id))->delete();
                        $this->success('该商品已经在转让列表',U('index'),1);exit;
                    }else{
                        $transfers = $transfer_mdl->add($info);
                    }
                //插入成功
                if($transfers){
                    //移除审核表中该商品
                    $examine_del = $examine_mdl->where(array('id'=>$id))->delete();
                    if($examine_del == 1){
                        $this->success('审核成功',U('index'),1);
                    }else{
                        $this->error('修改成功,移除失败',U('index'),1);
                    }
                }else{
                   $this->error('修改失败',U('edit',array('id'=>$id)),1);
                }
            }else{
                //不同意转让，作废
                $info = array(
                    'relname'=>$_POST['relname'],
                    'phone'=>$_POST['phone'],
                    'address'=>$_POST['address'],
                    'agree'=>0,
                );
                $examine_mdl->where(array('id'=>$id))->save($info);
               $this->error('审核失败',U('index'),2);
            }
        }
    }

    public function liste(){
        $transfer_mdl = M('transfers');
        $user_mdl = M('users');
        $transfers = $transfer_mdl->select();
        foreach($transfers as $key=>$val){
            $users = $user_mdl->where(array('id'=>$val['user_id']))->find();
            $transfers[$key]['username'] = $users['name'];
        }
        $this->assign('transfers',$transfers);
        $this->show();
    }


    public function dels($id=null){
        $examine_mdl = M('transfers');
        $filter['id'] = $id;
        $user = $examine_mdl->where($filter)->delete();
        if($user == 1){
            $this->success('删除成功', U('index'), 2);
        }else{
            $this->error('删除失败', U('index'), 2);
        }
    }

    public function edits($id=null){
        $examine_mdl = M('transfers');
        $filter['id'] = $id;
        $examines = $examine_mdl->where($filter)->find();
        $this->assign('info',$examines);
        $this->display();
    }

    public function doedits($id=null){
        $transfer_mdl = M('transfers');
        $info = array(
            'relname'=>$_POST['relname'],
            'phone'=>$_POST['phone'],
            'address'=>$_POST['address'],
            'descr'=>$_POST['descr'],
        );
        $transfers = $transfer_mdl->where(array('id'=>$id))->save($info);
        if($transfers == 1){
            $this->success('修改成功',U('liste'),2);
        }else{
            $this->error('修改失败',U('edits',array('id'=>$id)),2);
        }
    }

    public function agreement(){
        $opinion_mdl = M('opinions');
        $user_mdl = M('users');
        $opinions = $opinion_mdl->select();
        foreach($opinions as $Key=>$val){
            $users = $user_mdl->where(array('id'=>$val['user_id']))->find();
            $opinions[$Key]['username'] =$users['name'];
        }
        $this->assign('opinions',$opinions);
        $this->show();
    }


}