<?php
namespace Admin\Controller;
use Think\Controller;
class InoutController extends Controller {
    public function index(){
        $this->show();
    }

    /**
     *导出订单
     */
    public function export(){
        $id_str = I('get.id_str','','addslashes');
        $id_str = trim($id_str,',');
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
//        $objPHPExcel->setActiveSheetIndex(0)
//            ->setCellValue('A1','订单号')
//            ->setCellValue('B1','认捐客户名称')
//            ->setCellValue('C1','认捐日期')
//            ->setCellValue('D1','付款人名称')
//            ->setCellValue('E1','客户身份证号')
//            ->setCellValue('F1','客户电话')
//            ->setCellValue('G1','认捐客户地址')
//            ->setCellValue('H1','协议书编号')
//            ->setCellValue('I1','区域')
//            ->setCellValue('J1','位置编号')
//            ->setCellValue('K1','接待人员')
//            ->setCellValue('L1','代理商')
//            ->setCellValue('M1','认捐款')
//            ->setCellValue('N1','寺庙留')
//            ->setCellValue('O1','佣金率')
//            ->setCellValue('P1','应付佣金')
//            ->setCellValue('Q1','收据编号')
//        ;

        //设置表格标题
        $objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A1','订单号')
            ->setCellValue('B1','认捐日期')
            ->setCellValue('C1','会员卡号')
            ->setCellValue('D1','供奉权证号')
            ->setCellValue('E1','姓名')
            ->setCellValue('F1','手机号码')
            ->setCellValue('G1','身份证号')
            ->setCellValue('H1','地址')
            ->setCellValue('I1','项目类别')
            ->setCellValue('J1','区域')
            ->setCellValue('K1','位置')
            ->setCellValue('L1','佛龛类别')
            ->setCellValue('M1','交易方式')
            ->setCellValue('N1','标准价格')
            ->setCellValue('O1','折扣率')
            ->setCellValue('P1','折扣后价格')
            ->setCellValue('Q1','销售模式')
            ->setCellValue('R1','管理费')
            ->setCellValue('S1','收据号')
            ->setCellValue('T1','备注')
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
            //订单属性（线上订单OR线下订单--->会员卡激活订单及后台手动付款订单）
            $Transaction_mode = $v['attr'] == 1?'线上':'线下';
            $Sales_method = isset($v['agent_aid'])?'1':'0';
            //代理商模式
            if($Sales_method == '1'){
                $agent_select = $agent_mdl->where(array('agent_aid'=>$v['agent_aid']))->find();
                $salemethod = $agent_select['relname'];
            }else{
                $salemethod = '自营';
            }
            //此处bug 若一个订单，2个莲位，应该有2个供奉权证号。  导出订单因为详情单
            $order_details = $order_detail_mdl->where(array('orderid'=>$v['id']))->select();
            foreach($order_details as $key=>$val){
                $warrant_number = $val['description'];
                $position = position_select($val['product_id']);
                $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue('A'.$i,$v['order_id'])
                    ->setCellValue('B'.$i,$v['createtime'])
                    ->setCellValue('C'.$i,$v['user_number'])
                    ->setCellValue('D'.$i,$warrant_number)
                    ->setCellValue('E'.$i,$v['relname'])
                    ->setCellValue('F'.$i,$v['phone'])
                    ->setCellValue('G'.$i,$v['cid'])
                    ->setCellValue('H'.$i,$v['address'])
                    ->setCellValue('I'.$i,$position['type'])
                    ->setCellValue('J'.$i,$position['quyu'])
                    ->setCellValue('K'.$i,$position['weizhi'])
                    ->setCellValue('L'.$i,$position['typesign'])
                    ->setCellValue('M'.$i,$Transaction_mode)
                    ->setCellValue('N'.$i,$val['price'])
                    ->setCellValue('O'.$i,$v['ciny'])
                    ->setCellValue('P'.$i,$val['price'])
                    ->setCellValue('Q'.$i,$salemethod)
                    ->setCellValue('R'.$i,$v['management_expense'])
                    ->setCellValue('S'.$i,$v['agreement_id'])
                    ->setCellValue('T'.$i,$v['beizhu'])
                ;
                $i++;
            }
            //
//            $objPHPExcel->setActiveSheetIndex(0)
//                ->setCellValue('A'.$i,$v['order_id'])
//                ->setCellValue('B'.$i,$v['name'])
//                ->setCellValue('C'.$i,$v['createtime'])
//                ->setCellValue('D'.$i,$v['relname'])
//                ->setCellValue('E'.$i,$v['cid'])
//                ->setCellValue('F'.$i,$v['phone'])
//                ->setCellValue('G'.$i,$v['address'])
//                ->setCellValue('H'.$i,$v['agreement_id'])
//                ->setCellValue('I'.$i,$v['quyu'])
//                ->setCellValue('J'.$i,$v['position'])
//                ->setCellValue('K'.$i,'')
//                ->setCellValue('L'.$i,$v['agent_aid'])
//                ->setCellValue('M'.$i,$v['order_total_price'])
//                ->setCellValue('O'.$i,$v['agent_ciny'])
//                ->setCellValue('P'.$i,$v['yinfu'])
//                ->setCellValue('Q'.$i,$v['simiao'])
//                ->setCellValue('R'.$i,'')
//            ;


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