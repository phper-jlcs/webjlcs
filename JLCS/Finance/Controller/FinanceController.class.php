<?php
namespace Finance\Controller;
use Think\Controller;

class FinanceController extends Controller{
    //盈利状态
    public function index(){
        //总利润----成本
        $finances = M('finances');
        $inventory_records = $finances->where(array('attr'=>1))->select();
        $inventory_record_other = $finances->where(array('attr'=>array('neq','1')))->select();
        //总利润
        $alltotal = 0;
        foreach($inventory_records as $key=>$val){
            $alltotal += $val['allprice'];
        }
        //成本
        $stocktotal = 0;
        foreach($inventory_record_other as $k=>$v){
            $stocktotal += $v['allprice'];
        }
        //利润
        $profit = $alltotal - $stocktotal;
        $Data = array(
          'alltotal'=> $alltotal,
          'stocktotal'=> $stocktotal,
          'profit'=> $profit,
        );
        $this->assign('Data',$Data);
        $this->show();
    }

    //进账
    public function in_account(){
        $finance_mdl = M('finances');
        $product_mdl = M('products');
        //进账
        if(I('post.month')){
            $map['attr'] = 1;
            $map['time'] = array("like","%-".I('post.month')."-%");
            $finances = $finance_mdl->where($map)->select();
        }else{
            $finances = $finance_mdl->where(array('attr'=>1))->select();
        }
        
        foreach($finances as $key=>$val){
            $products = $product_mdl->where(array('id'=>$val['product_id']))->find();
            $finances[$key]['product_name'] = $products['product_name'];
        }
        $this->assign('finances',$finances);
        $this->assign('month',I('post.month'));
        $this->show();
    }

    //出账
    public function out_account(){
        $product_mdl = M('products');
        $finance_mdl = M('finances');
        if(I('post.month')){
            $map['attr'] = 2;
            $map['time'] = array("like","%-".I('post.month')."-%");
            $finances = $finance_mdl->where($map)->order('time desc')->select();
        }else{
            $finances = $finance_mdl->where(array('attr'=>2))->order('time desc')->select();
        }
        
        foreach($finances as $key=>$val){
            if($val['product_id']){
                $products = $product_mdl->where(array('id'=>$val['product_id']))->find();
                $finances[$key]['product_name'] = $products['product_name'];
            }
            $finances[$key]['type'] = $val['project'];
        }
        $this->assign('stock_lists',$finances);
        $this->assign('month',I('post.month'));
        $this->show();
    }
    //其他账单
    public function other_account(){
        $this->show();
    }

    //其他账单报销
    public function insertothers(){
        $finance_mdl = M('finances');
        $Data = array(
            'project'=>$_POST['project'],
            'attr'=>$_POST['inout'],
            'allprice'=>$_POST['price'],
            'hand_man'=>$_POST['people'],
            'ways'=>$_POST['sign'],
            'time'=>date('Y-m-d H:i:s',time()),
        );
        if($finance_mdl->add($Data)){
            $this->success('添加成功',U('index'),1);
        }else{
            $this->error('添加失败',U('other_account'),1);
        }
    }

    //按月筛选  (转给in_account操作进行处理了，不用另开一个操作进行月份的筛选)
    // public function selectmonth(){
    //     $attr = intval(I('post.attr'));
    //     switch($attr){
    //         case 1:
    //             $this->selectall(1,I('post.month')); //  进账记录的月份筛选
    //             break;
    //         case 2:
    //             $this->selectall(2,I('post.month'));  //出账记录的月份筛选
    //             break;
    //     }
    // }

    // public function  selectall($attr,$month){
    //     echo '<pre>';
    //     $finance_mdl = M('finances');
    //     $product_mdl = M('products');
    //     $map['attr'] = $attr;
    //     $map['time'] = array("like","%-".$month."-%");
    //     $Data = $finance_mdl->field('id,time')->where($map)->order('time desc')->select();
    //     $filter_month = I('post.month');
    //     foreach($finances as $key=>$val){
    //         $filter = date('m',strtotime($val['time']));
    //         if($filter_month == $filter){
    //             //满足条件的id
    //             $finance_select = $finance_mdl->where(array('id'=>$val['id']))->find();
    //             $products = $product_mdl->where(array('id'=>$finance_select['product_id']))->find();
    //             $finance_select['product_name'] = $products['product_name'];
    //             $Data[] = $finance_select;
    //         }
    //     }
    //     if(!empty($Data)){
    //         $this->assign('data',$Data);
    //         $this->display('ajax_show');
    //     }
    // }

    public function selectallmonth(){
        $finance_mdl = M('finances');
        $finances = $finance_mdl->field('id,time,allprice')->where(array('attr'=>1))->select();
        $inventory_record_other = $finance_mdl->where(array('attr'=>array('neq','1')))->select();
        $filter_month = $_POST['month'];
        //总利润
        $alltotal = 0;
        if(!empty($finances)){
            foreach($finances as $key=>$val){
                $filter = date('m',strtotime($val['time']));
                if($filter_month == $filter){
                    $alltotal += $val['allprice'];
                }
            }
        }

        //成本
        $stocktotal = 0;
        if(!empty($inventory_record_other)){
            foreach($inventory_record_other as $k=>$v){
                $filter1 = date('m',strtotime($v['time']));
                if($filter_month == $filter1){
                    $stocktotal += $v['allprice'];
                }
            }
        }
        //利润
        $profit = $alltotal - $stocktotal;
        $Data = array(
            'alltotal'=> $alltotal,
            'stocktotal'=> $stocktotal,
            'profit'=> $profit,
        );
        if(!empty($Data)){
            $this->assign('data',$Data);
            $this->display('ajax_index');
        }
    }

    public function edit_account(){  //进账 or 出账记录->编辑
        $inAccount = M('finances')->where(array('id'=>I('get.id')))->field('id,project,num,price,allprice,time,ways,entry_mode,hand_man')->find();
        $this->assign('inAccount',$inAccount);
        $this->assign('attr',I('get.attr'));
        $this->show();
    }

    public function editSubmit_account(){    //进账 or 出账记录->编辑 页面提交数据的处理
        if(!is_numeric(I('post.num'))){
            $this->error('数目必须是整数！');
        }
        if(!is_numeric(I('post.price'))){
            $this->error('价格必须是数字类型！');
        }
        if(!is_numeric(I('post.allprice'))){
            $this->error('总价必须是数字类型！');
        }
        $project  = htmlspecialchars(I('post.project'));
        $hand_man = htmlspecialchars(I('post.hand_man'));
        $update = array(
            'project'    => $project,
            'num'        => I('post.num'),
            'price'      => I('post.price'),
            'allprice'   => I('post.allprice'),
            'time'       => date('Y-m-d H:i:s',strtotime('now')),
            'ways'       => I('post.ways'),
            'entry_mode' => I('post.entry_mode'),
            'hand_man'   => $hand_man
        );
        $result = M('finances')->where(array('id'=>I('post.id')))->save($update);
        if($result){
            if(I('post.attr') == '1'){
                $this->success('修改成功!',U('in_account'),1);
            }else{
                $this->success('修改成功!',U('out_account'),1);
            }
        }else{
            $this->error('发生错误，修改失败!');
        }
    }

    public function delete_account(){  //删除进账 or 出账记录
        $id = intval(I('get.id'));
        if($id){
            $finances = M('finances');
            $result = $finances->where(array('id'=>$id))->delete();
            if($result){
                
                if(I('get.attr') == '1'){
                    $this->success('删除该条进账记录成功！^_^',U('in_account'),1);
                }else{
                    $this->success('删除该条出账记录成功！^_^',U('out_account'),1);
                }
            }else{
                $this->error('删除该条进账记录失败了！');
            }
        }
    }

}