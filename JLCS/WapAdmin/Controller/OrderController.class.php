<?php
namespace WapAdmin\Controller;
use Think\Controller;
class OrderController extends Controller {
    public function index($id=null){

        //实例化商品表
        $order_mdl = M('weixin_orders');
        $user_mdl = M('weixin_users');
        $_GET['p'] = isset($_GET['p']) ? $_GET['p'] : '1';
        if(I('post.order_id') != ""){
            $orders = $order_mdl->where(array('order_id'=>I('post.order_id')))->page($_GET['p'],8)->select();
        }else{
            $orders = $order_mdl->page($_GET['p'],8)->select();
        }
        
        foreach($orders as $key=>$val){
            $users = $user_mdl->where(array('id'=>$val['user_id']))->find();
            $orders[$key]['name'] = $users['name'];
        }
        $count = $order_mdl->count();
        $Page = new \Think\Page($count,8);
        $Page->lastSuffix=false;
        $Page->setConfig('prev','上一页');
        $Page->setConfig('next','下一页');
        $Page->setConfig('last','末页');
        $Page->setConfig('first','首页');
        $Page->setConfig('theme','%FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END% %HEADER%');
        $show = $Page->show();
        $this->assign('page',$show);
        $this->assign('count',$count);
        $this->assign('orders',$orders);
        $this->assign('keyword',I('post.order_id'));
        $this->display();
    }


    public function del($id){
        //实例化会员表
        $user_mdl = M('users');
        $filter['id'] = $id;
        $user = $user_mdl->where($filter)->delete();
        if($user){
            $this->success('删除成功', U('index'), 2);
        }
    }


    public function edit($id=null){
        //实例化商品表
        $order_mdl = M('weixin_orders');
        $user_mdl = M('weixin_users');
        $order_detail_mdl =M('weixin_order_details');
        $filter['id'] = $id;
        $orders = $order_mdl->where($filter)->find();
        $users = $user_mdl->where(array('id'=>$orders['user_id']))->find();
        $order_details = $order_detail_mdl->where(array('orderid'=>$orders['order_id']))->select();
        foreach($order_details as $key=>$val){
            $orderinfo[] = $val['product_id'];
        }
        $orders['user_name'] = $users['name'];
        $this->assign('orderinfo',$orderinfo);
        $this->assign('info',$orders);
        $this->display();
    }

    public function doedit($id=null){
        //实例化会员表
        $order_mdl = M('weixin_orders');
        $filter['id'] = $id;
        $updateinfo['order_status'] = $_POST['status'];
        $updateinfo['peisong'] = $_POST['peisong'];
        $data = $order_mdl->where($filter)->save($updateinfo);
        if($data == 1){
            $this->success('修改成功', U('index'), 2);
        }else{
            $this->error('修改失败,请重新修改', U('edit',array('id'=>$id)), 2);
        }
    }

    public function add(){
        $this->display();
    }


    public function info($id){
        $filter['id'] = $id;
        $user_info_mdl = M('weixin_address');
        $order_mdl = M('weixin_orders');
        $user_mdl = M('weixin_users');
        $orders = $order_mdl->where($filter)->find();
        $users = $user_mdl->where(array('user_id'=>$orders['user_id']))->find();
        $address_id = $orders['address_id'];

        $user_infos = $user_info_mdl->where(array('id'=>$address_id))->find();
        $this->assign('user_name',$users['name']);
        $this->assign('orders',$orders);
        $this->assign('user_infos',$user_infos);
        $this->display();
    }

    public function do_info($id=null){
        $filter['id'] = $id;
        $user_info_mdl = M('weixin_address');
        $order_mdl = M('weixin_orders');
        $orders = $order_mdl->where($filter)->find();
        $address_id = $orders['address_id'];
        $address = $_POST['address'];
        $phone = $_POST['phone'];
        $name = $_POST['name'];
        $info = array(
            'address'=>$address,
            'phone'=>$phone,
            'name'=>$name,
        );
        $user_infos = $user_info_mdl->where(array('id'=>$address_id))->save($info);
        if($user_infos == 1){
            $this->success('修改成功', U('index'), 2);
        }else{
            $this->error('修改失败,请重新修改', U('info',array('id'=>$id)), 2);
        }
    }


    public function select(){
        $keywords = $_POST['keyword'];
        //实例化商品表
        $order_mdl = M('orders');
        $filter['order_id'] = $keywords;
        $orders = $order_mdl->where($filter)->select();
        $this->assign('orders',$orders);
        $this->assign('keyword',$keywords);
        $this->display('Order/index');
    }


    /**
     *导出订单
     */
    public function put_out(){
        $id_str = I('get.id_str','','addslashes');
        $id_str = rtrim($id_str,',');
        //实例化订单表
        $order_mdl = M('orders');
        $user_mol = M('users');
        $agent_mdl = M('agents');
        $user_info_mdl = M('user_infos');
        $order_detail_mdl = M('order_details');
        $product_mdl = M('products');
        $good_mdl = M('goods');
        $orders = $order_mdl->where('id in('.$id_str.')')->select();
        foreach ($orders as $key => $value) {
            //认捐客户名称
            $users = $user_mol->where(array('id'=>$value['user_id']))->find();
            $orders[$key]['name'] = $users['name'];
            //佣金率 寺庙留 应付佣金
            $agents = $agent_mdl->where(array('agent_aid'=>$value['agent_aid']))->find();
            $orders[$key]['agent_ciny'] = $agents['agent_ciny'];
            $orders[$key]['yinfu'] = $value['order_total_price']*$agents['agent_ciny'];
            $orders[$key]['simiao'] = $value['order_total_price']-$orders[$key]['yinfu'];
            //付款人名称 客户身份证 电话 地址
            $user_infos = $user_info_mdl->where(array('id'=>$value['user_info_id']))->find();
            $orders[$key]['relname'] = $user_infos['relname'];
            $orders[$key]['cid'] = $user_infos['cid'];
            $orders[$key]['phone'] = $user_infos['phone'];
            $orders[$key]['address'] = $user_infos['address'];
            //区域 、位置编号
            $order_details = $order_detail_mdl->where(array('orderid'=>$value['id']))->select();
            if(!empty($order_details)){
                foreach($order_details as $keyq=>$valq){
                    $products = $product_mdl->where(array('id'=>$valq['product_id']))->find();
                    $goods = $good_mdl->where(array('goods_id'=>$products['goods_id']))->find();
                    $orders[$key]['quyu'] = $goods['own_name'];
                    $orders[$key]['position'] = $products['product_name'];
                }
            }
        }
        //echo '<pre>';print_r($orders);exit;
        //引入框架核心类库
        Vendor('Excel.PHPExcel');
        //实例化类库
        $objPHPExcel=new \PHPExcel();
        //设置表格属性
        $objPHPExcel->getProperties()->setCreator('a')
            ->setLastModifiedBy('b')
            ->setTitle('标题')
            ->setSubject('主题')
            ->setDescription('描述')
            ->setKeywords('关键字')
            ->setCategory('c');
        //设置表格标题
        $objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A1','订单号')
            ->setCellValue('B1','认捐客户名称')
            ->setCellValue('C1','认捐日期')
            ->setCellValue('D1','付款人名称')
            ->setCellValue('E1','客户身份证号')
            ->setCellValue('F1','客户电话')
            ->setCellValue('G1','认捐客户地址')
            ->setCellValue('H1','协议书编号')
            ->setCellValue('I1','区域')
            ->setCellValue('J1','位置编号')
            ->setCellValue('K1','接待人员')
            ->setCellValue('L1','代理商')
            ->setCellValue('M1','认捐款')
            ->setCellValue('N1','寺庙留')
            ->setCellValue('O1','佣金率')
            ->setCellValue('P1','应付佣金')
            ->setCellValue('Q1','收据编号')
        ;
        $i=2;
        //print_r($orders);exit;
        foreach($orders as $k=>$v){
            if($v['status'] == 0) {
                $status = '未支付';
            }else if($v['status'] == 1) {
                $status = '已支付';
            }else {
                $status = '已收货';
            }
            $objPHPExcel->setActiveSheetIndex(0)
                ->setCellValue('A'.$i,$v['order_id'])
                ->setCellValue('B'.$i,$v['name'])
                ->setCellValue('C'.$i,$v['createtime'])
                ->setCellValue('D'.$i,$v['relname'])
                ->setCellValue('E'.$i,$v['cid'])
                ->setCellValue('F'.$i,$v['phone'])
                ->setCellValue('G'.$i,$v['address'])
                ->setCellValue('H'.$i,$v['agreement_id'])
                ->setCellValue('I'.$i,$v['quyu'])
                ->setCellValue('J'.$i,$v['position'])
                ->setCellValue('K'.$i,'')
                ->setCellValue('L'.$i,$v['agent_aid'])
                ->setCellValue('M'.$i,$v['order_total_price'])
                ->setCellValue('O'.$i,$v['agent_ciny'])
                ->setCellValue('P'.$i,$v['yinfu'])
                ->setCellValue('Q'.$i,$v['simiao'])
                ->setCellValue('R'.$i,'')
            ;
            $i++;
        }
        $objPHPExcel->getActiveSheet()->setTitle('订单管理');
        $objPHPExcel->setActiveSheetIndex(0);
        $filename=urlencode('订单信息统计表').'_'.date('Y-m-dHis');

        /*
         *生成xlsx文件
         header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
         header('Content-Disposition: attachment;filename="'.$filename.'.xlsx"');
         header('Cache-Control: max-age=0');
         $objWriter=PHPExcel_IOFactory::createWriter($objPHPExcel,'Excel2007');
        */

        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="'.$filename.'.xls"');
        header('Cache-Control: max-age=0');
        $objWriter = \PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');

        $objWriter->save('php://output');
        exit;

    }
}